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
        $planning = [];
        helper(['form']);

        if (isset($_POST['planning'])) {
            $var = new pourModel();
            $planning = $var->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll();

            foreach ($planning as $row) {
                $data[] = array(
                    'id' => $row['ID_planning'],
                    'title' => $row['motif'],
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
                $planning = $var->select(['*', 'COUNT(motif) AS nombre', 'DATE_FORMAT(debut_sejour, "%d %b") AS date'])->groupBy('debut_sejour')->findAll();

                foreach ($planning as $row) {
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
}
