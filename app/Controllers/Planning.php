<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\planningModel;
use App\models\pourModel;
use App\models\chambreModel;
use App\models\concernerModel;

class Planning extends BaseController
{
    public function index()
    {
        $data = [];
        // $planning = [];
        helper(['form']);

        if (isset($_POST['planning'])) {
            $var = new pourModel();
            $planningNuit = $var->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->findAll();
            $planningDay = $var->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->findAll();

            foreach ($planningNuit as $row) {
                $data[] = array(
                    'id' => $row['ID_planning'],
                    'title' => $row['nom_client'] . ' ' . $row['prenom_client'] . ' : ' . $row['nbr_nuit'] . ' ' . $row['motif'],
                    'start' => $row['debut_sejour'] . ' ' . $row['heure_arrive'],
                    'end' => $row['fin_sejour'] . ' ' . $row['heure_depart'],
                );
            }

            foreach ($planningDay as $row) {
                $data[] = array(
                    'id' => $row['ID_planning'],
                    'title' => $row['nom_client_day'] . ' : ' . $row['duree_day'] . 'h ' . $row['motif'],
                    'start' => $row['debut_sejour'] . ' ' . $row['heure_arrive'],
                    'end' => $row['fin_sejour'] . ' ' . $row['heure_depart'],
                );
            }
            echo json_encode($data);
        }

        if (isset($_POST['chart'])) {
            if ($_POST['chart'] == 'chart1') {
                $var = new chambreModel();
                $planning = $var->select(['*', 'COUNT(statut_chambre) AS nombre'])->groupBy('statut_chambre')->findAll();

                foreach ($planning as $row) {
                    $data[] = array(
                        'nombre' => $row['nombre'],
                        'statut' => $row['statut_chambre'],
                    );
                }
                echo json_encode($data);
            }
            if ($_POST['chart'] == 'chart2') {
                $var = new planningModel();
                $planningDay = $var->select(['*', 'COUNT(motif) AS nombre', 'DATE_FORMAT(debut_sejour, "%d %b") AS date'])->where('motif', 'Day use')->groupBy('debut_sejour')->findAll();
                $planningNuit = $var->select(['*', 'COUNT(motif) AS nombre', 'DATE_FORMAT(debut_sejour, "%d %b") AS date'])->where('motif', 'Nuitée')->groupBy('debut_sejour')->findAll();

                foreach ($planningDay as $row) {
                    $data[] = array(
                        'nombre' => $row['nombre'],
                        'date' => $row['date'],
                        'motif' => $row['motif'],
                    );
                }

                foreach ($planningNuit as $row) {
                    $data[] = array(
                        'nombre' => $row['nombre'],
                        'date' => $row['date'],
                        'motif' => $row['motif'],
                    );
                }
                echo json_encode($data);
            }
        }
    }

    public function planningJour()
    {
        $data = [];
        helper(['form']);
        $data['chambres'] = $this->read();

        echo view('templates\header');
        echo view('planning\planningJour', $data);
        echo view('templates\footer');
    }

    public function planningMois()
    {
        $data = [];
        helper(['form']);

        echo view('templates\header');
        echo view('planning\planningMois', $data);
        echo view('templates\footer');
    }

    function read() {
        $data = [];
        $concerner = new concernerModel();
        $data = $concerner->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('planning', 'concerner.ID_planning = planning.ID_planning')->findAll();
        return $data;
    }
}
