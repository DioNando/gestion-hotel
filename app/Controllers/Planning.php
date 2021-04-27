<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\planningModel;
use App\models\pourModel;
use App\models\chambreModel;
use App\models\concernerModel;
use App\models\reservationNuitModel;
use App\models\reservationDayModel;
use App\models\effectuerModel;

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
                    'allDay' => 'false',
                    'backgroundColor' => '#ff7c1f',
                    'textColor' => 'black',
                    'borderColor' => '#ff7c1f',
                    'ID_reservation' => $row['ID_nuit'],
                    'motif' => $row['motif'],
                );
            }
            
            foreach ($planningDay as $row) {
                $data[] = array(
                    'id' => $row['ID_planning'],
                    'title' => $row['nom_client_day'] . ' : ' . $row['duree_day'] . 'h ' . $row['motif'],
                    'start' => $row['debut_sejour'] . ' ' . $row['heure_arrive'],
                    'end' => $row['fin_sejour'] . ' ' . $row['heure_depart'],
                    'backgroundColor' => '#84ff3d',
                    'textColor' => 'black',
                    'borderColor' => '#84ff3d',
                    'ID_reservation' => $row['ID_day'],
                    'motif' => $row['motif'],
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
                $pour = new pourModel();
                // $planningDay = $pour->select(['*', 'COUNT(motif) AS nombre', 'DATE_FORMAT(debut_sejour, "%d %b") AS date'])->where('motif', 'Day use')->groupBy('debut_sejour')->findAll();
                // $planningNuit = $pour->select(['*', 'COUNT(motif) AS nombre', 'DATE_FORMAT(debut_sejour, "%d %b") AS date'])->where('motif', 'Nuitée')->groupBy('debut_sejour')->findAll();
                // $planningDay = $pour->where('date_reservation_day = CONVERT(CURDATE(), DATE)')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->findAll();
                // $planningNuit = $pour->where('date_reservation_nuit = CONVERT(CURDATE(), DATE)')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->findAll();
                $planningDay = $pour->select(['*', 'COUNT(pour.ID_day) AS nombre_reservation', 'DAYOFWEEK(date_reservation_day) AS week'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->groupBy('week')->findAll();
                $planningNuit = $pour->select(['*', 'COUNT(pour.ID_nuit) AS nombre_reservation', 'DAYOFWEEK(date_reservation_nuit) AS week'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->groupBy('week')->findAll();
                // $planningDay = $pour->select(['*', 'COUNT(ID_day) AS nombre'])->where('motif', 'Day use')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->groupBy('date_reservation_day')->findAll();
                // $planningNuit = $pour->select(['*', 'COUNT(ID_nuit) AS nombre'])->where('motif', 'Nuitée')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->groupBy('date_reservation_nuit')->findAll();
                // $planningDay = $pour->select(['*', 'COUNT(ID_day) AS nombre'])->where('fin_sejour >= CONVERT(CURDATE(), DATE) AND debut_sejour < CONVERT(CURDATE() + 8, DATE)')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->findAll();
                // $planningNuit = $pour->select(['*', 'COUNT(ID_nuit) AS nombre'])->where('fin_sejour >= CONVERT(CURDATE(), DATE) AND debut_sejour < CONVERT(CURDATE() + 8, DATE)')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_day = reservation_nuit.ID_nuit')->findAll();

                foreach ($planningDay as $row) {
                    $data[] = array(
                        'reservation' => $row['nombre_reservation'],
                        // 'date' => $row['date_reservation_day'],
                        'motif' => $row['motif'],
                        'week' => $row['week'],
                    );
                }

                foreach ($planningNuit as $row) {
                    $data[] = array(
                        'reservation' => $row['nombre_reservation'],
                        // 'date' => $row['date_reservation_nuit'],
                        'motif' => $row['motif'],
                        'week' => $row['week'],
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
        $data['day'] = $this->readDay();
        $data['nuit'] = $this->readNuit();
        $data['plannings'] = array_merge($data['nuit'], $data['day']);

        echo view('templates\header');
        echo view('planning\planningJour', $data);
        echo view('templates\footer');
    }

    public function planningMois()
    {
        $data = [];
        helper(['form']);

        $chambres = new chambreModel();
        $data['chambres'] = $chambres->where('MONTH(debut_sejour) = MONTH(CURDATE())')->join('concerner', 'concerner.ID_chambre = chambre.ID_chambre')->join('planning', 'concerner.ID_planning = planning.ID_planning')->join('pour', 'pour.ID_planning = planning.ID_planning')->findAll();
        // $data['chambres'] = $chambres->where('MONTH(debut_sejour) >= MONTH(CURDATE()) + 1 AND MONTH(debut_sejour) < MONTH(CURDATE()) + 2')->join('concerner', 'concerner.ID_chambre = chambre.ID_chambre')->join('planning', 'concerner.ID_planning = planning.ID_planning')->findAll();
        // $data['chambres'] = $chambres->where('fin_sejour >= CONVERT(CURDATE(), DATE) AND debut_sejour < CONVERT(CURDATE() + 5, DATE)')->join('concerner', 'concerner.ID_chambre = chambre.ID_chambre')->join('planning', 'concerner.ID_planning = planning.ID_planning')->findAll();
        // $data['chambres'] = $chambres->where('fin_sejour >= CONVERT(CURDATE(), DATE) AND debut_sejour < CONVERT(CURDATE() + 17, DATE)')->join('concerner', 'concerner.ID_chambre = chambre.ID_chambre')->join('planning', 'concerner.ID_planning = planning.ID_planning')->groupBy('chambre.ID_chambre')->findAll();

        echo view('templates\header');
        echo view('planning\planningMois', $data);
        echo view('templates\footer');
    }

    function readDay()
    {
        $data = [];
        $pour = new pourModel();
        $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('fin_sejour >= CONVERT(CURDATE(), DATE) AND debut_sejour < CONVERT(CURDATE() + 1, DATE)')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('chambre.ID_chambre')->findAll();

        foreach ($tabPlanningDay as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_reservation' => $row['ID_day'],
                'motif' => $row['motif'],
                'nom' => $row['nom_client_day'],
                'debut' => $row['heure_arrive'],
                'fin' => $row['heure_depart'],
                'duree' => $row['duree_day'] . 'h',
                'commentaire' => $row['commentaire_day'],
                'montant' => $row['tarif_chambre'],
                'surplus' => '0',
                'total' => $row['total'],
            );
        }

        return $data;
    }

    function readNuit()
    {
        $data = [];
        $pour = new pourModel();
        $tabPlanningNuit = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('fin_sejour >= CONVERT(CURDATE(), DATE) AND debut_sejour < CONVERT(CURDATE() + 1, DATE)')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('chambre.ID_chambre')->findAll();

        foreach ($tabPlanningNuit as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_reservation' => $row['ID_nuit'],
                'motif' => $row['motif'],
                'nom' => $row['nom_client'],
                'debut' => $row['debut_sejour'],
                'fin' => $row['fin_sejour'],
                'duree' => $row['nbr_nuit'],
                'commentaire' => $row['commentaire_nuit'],
                'montant' => $row['tarif_chambre'],
                'surplus' => '0',
                'total' => $row['total'],
            );
        }

        return $data;
    }

    // AJAX POUR AFFICHER LE TABLEAU

    public function tabPlanningJour()
    {
        $data = [];
        helper(['form']);

        $tabPlanningDay = $this->readDay();
        $tabPlanningNuit = $this->readNuit();

        foreach ($tabPlanningDay as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_reservation' => $row['ID_day'],
                'motif' => $row['motif'],
                'nom' => $row['nom_client_day'],
                'debut' => $row['heure_arrive'],
                'fin' => $row['heure_depart'],
                'duree' => $row['duree_day'] . 'h',
            );
        }

        foreach ($tabPlanningNuit as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_reservation' => $row['ID_nuit'],
                'motif' => $row['motif'],
                'nom' => $row['nom_client'],
                'debut' => $row['debut_sejour'],
                'fin' => $row['fin_sejour'],
                'duree' => $row['nbr_nuit'],
            );
        }

        echo json_encode($data);
    }
    
    public function ajaxPlanning()
    {
        $pour = new pourModel();
        
        if($_POST['motif'] == 'Nuitée') {           
            // $data['detail'] = $pour->where('pour.ID_planning', $_POST['ID_planning'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->first();
            $data['details'] = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(date_facture_nuit, "%d %b %Y à %H:%i") AS date_facture_nuit'])->where('pour.ID_planning', $_POST['ID_planning'])->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('concerner.ID_chambre')->find();

            // $nuit = new reservationNuitModel();
            $nuit = new effectuerModel();

            // $data['info'] = $nuit->where('ID_nuit', $_POST['ID_reservation'])->first();
            $data['info'] = $nuit->select(['*', 'DATE_FORMAT(date_reservation_nuit, "%d %b %Y à %H:%i") AS date_reservation_nuit', 'DATE_FORMAT(date_modification_nuit, "%d %b %Y à %H:%i") AS date_modification_nuit'])
			->where('effectuer.ID_nuit', $_POST['ID_reservation'])->join('user', 'effectuer.ID_user = user.ID_user')
			->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')
			->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')
			->join('client', 'reservation_nuit.ID_client = client.ID_client')
			->join('cardex', 'cardex.ID_client = client.ID_client')
			->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')
			->join('planning', 'pour.ID_planning = planning.ID_planning')->first();
            // $data['info'] = $nuit->where('reservation_nuit.ID_nuit', $_POST['ID_reservation'])->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')->first();

            echo view('planning\infoPlanningNuit', $data);
            return ($data);
            // echo json_encode($data);
        }
        
        if($_POST['motif'] == 'Day use') {         
            // $data['detail'] = $pour->where('pour.ID_planning', $_POST['ID_planning'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->first();
            $data['details'] = $pour->select(['*', 'DATE_FORMAT(date_facture_day, "%d %b %Y à %H:%i") AS date_facture_day'])->where('pour.ID_planning', $_POST['ID_planning'])->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('concerner.ID_chambre')->find();
            
            // $day = new reservationDayModel();
            $day = new effectuerModel();    
            
            $data['info'] = $day->select(['*', 'DATE_FORMAT(date_reservation_day, "%d %b %Y à %H:%i") AS date_reservation_day', 'DATE_FORMAT(date_modification_day, "%d %b %Y à %H:%i") AS date_modification_day'])->where('effectuer.ID_day', $_POST['ID_reservation'])->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->first();
            
            // $data['info'] = $day->where('ID_day', $_POST['ID_reservation'])->first();

            echo view('planning\infoPlanningDay', $data);
            return ($data);
            // echo json_encode($data);
        }

    }
}
