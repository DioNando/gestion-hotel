<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\userModel;
use App\Models\planningModel;
use App\Models\pourModel;
use App\Models\chambreModel;
use App\Models\concernerModel;
use App\Models\reservationNuitModel;
use App\Models\reservationDayModel;
use App\Models\effectuerModel;
use App\Models\archiveModel;
use App\Models\relierModel;

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
                    'title' => $row['nom_client'] . ' ' . $row['prenom_client'] . ' : ' . $row['nbr_nuit'] . ' nuitées',
                    'start' => $row['debut_sejour'] . ' ' . $row['heure_arrive'],
                    'end' => $row['fin_sejour'] . ' ' . $row['heure_depart'],
                    'allDay' => 'false',
                    'backgroundColor' => '#283e51',
                    'textColor' => 'white',
                    'borderColor' => '#283e51',
                    'ID_reservation' => $row['ID_nuit'],
                    'motif' => $row['motif'],
                );
            }

            foreach ($planningDay as $row) {
                $data[] = array(
                    'id' => $row['ID_planning'],
                    'title' => $row['nom_client_day'] . ' : ' . $row['duree_day'] . 'h ',
                    'start' => $row['debut_sejour'] . ' ' . $row['heure_arrive'],
                    'end' => $row['fin_sejour'] . ' ' . $row['heure_depart'],
                    'backgroundColor' => '#ff5f6d',
                    'textColor' => 'white',
                    'borderColor' => '#ff5f6d',
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

                // foreach ($planningDay as $row) {
                //     $day[] = array(
                //         'reservation' => $row['nombre_reservation'],
                //         // 'date' => $row['date_reservation_day'],
                //         'motif' => $row['motif'],
                //         'week' => $row['week'],
                //     );
                // }

                // foreach ($planningNuit as $row) {
                //     $nuit[] = array(
                //         'reservation' => $row['nombre_reservation'],
                //         // 'date' => $row['date_reservation_nuit'],
                //         'motif' => $row['motif'],
                //         'week' => $row['week'],
                //     );
                // }

                // $week[] = array(
                //     '1' => 'Dim',
                //     '2' => 'Lun',
                //     '3' => 'Mar',
                //     '4' => 'Mer',
                //     '5' => 'Jeu',
                //     '6' => 'Ven',
                //     '7' => 'Sam',
                // );
                $week = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];

                for ($i = 1; $i < 8; $i++) {
                    foreach ($planningDay as $row) {
                        if ($row['week'] == $i) {
                            $day[] = array(
                                'reservation' => $row['nombre_reservation'],
                                'motif' => $row['motif'],
                                'id' => $i,
                                'week' => $week[$i - 1],
                            );
                        }
                        // else {
                            //     $day[] = array(
                                //         'reservation' => 0,
                                //         'motif' => $row['motif'],
                                //         'id' => $i,
                                //     );
                                // }
                            }
                        }
                        
                        for ($i = 1; $i < 8; $i++) {
                            foreach ($planningNuit as $row) {
                                if ($row['week'] == $i) {
                            $nuit[] = array(
                                'reservation' => $row['nombre_reservation'],
                                'motif' => $row['motif'],
                                'id' => $i,
                                'week' => $week[$i - 1],
                            );
                        }
                        //  else {
                        //     $nuit[] = array(
                        //         'reservation' => 0,
                        //         'motif' => $row['motif'],
                        //         'id' => $i,
                        //     );
                        // }
                    };
                }

                for ($i = 1; $i < 8; $i++) {
                    $jour[] = array(
                        'id' => $i,
                    );
                }

                echo json_encode([$nuit, $day, $jour]);
            }
        }
    }

    public function planningJour()
    {
        $data = [];
        helper(['form']);
        $chambres = new relierModel();
        $archives = new archiveModel();
        $archive = $archives->orderBy('ID_archive', 'desc')->first();
        // $chambres = new chambreModel();

        $data['day'] = $this->readDay();
        $data['nuit'] = $this->readNuit();
        $data['libre'] = $this->readLibre();
        $data['plannings'] = array_merge($data['nuit'], $data['day'], $data['libre']);
        $data['chambres'] = $chambres->select([
			'*', '(CASE 
			WHEN tarif_chambre < 5000 THEN "1"
			WHEN tarif_chambre >= 5000 AND tarif_chambre < 10000 THEN "2"
			WHEN tarif_chambre >= 10000 AND tarif_chambre < 20000 THEN "3"
			WHEN tarif_chambre >= 20000 THEN "4"
			END) AS prix'

		])->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll();

        // $data['plannings'] = array_merge($data['nuit'], $data['day'], $data['libre']);
        // ksort($data['plannings'], SORT_NUMERIC);

        echo view('templates\header');
        echo view('planning\planningJour', $data);
        echo view('templates\footer');
    }

    public function planningMois()
    {
        $data = [];
        helper(['form']);

        // $chambres = new chambreModel();
        // $data['chambres'] = $chambres->where('MONTH(debut_sejour) = MONTH(CURDATE())')->join('concerner', 'concerner.ID_chambre = chambre.ID_chambre')->join('planning', 'concerner.ID_planning = planning.ID_planning')->join('pour', 'pour.ID_planning = planning.ID_planning')->findAll();
      
        $pour = new pourModel();
        $archives = new archiveModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        $data['chambres'] = $pour->where('MONTH(debut_sejour) = MONTH(CURDATE())')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('relier.ID_archive', $archive['ID_archive'])->findAll();
      
        echo view('templates\header');
        echo view('planning\planningMois', $data);
        echo view('templates\footer');
    }

    function readDay()
    {
        $data = [];
        $pour = new pourModel();
        $archives = new archiveModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();
        
        $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('debut_sejour = CURDATE()')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('relier.ID_archive', $archive['ID_archive'])->findAll();
        // $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('debut_sejour = CURDATE()')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();
        
        foreach ($tabPlanningDay as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_planning' => $row['ID_planning'],
                'statut_chambre' => $row['statut_chambre'],
                'ID_reservation' => $row['ID_day'],
                'motif' => $row['motif'],
                'nom' => $row['nom_client_day'],
                'debut' => $row['heure_arrive'],
                'fin' => $row['heure_depart'],
                'duree' => $row['duree_day'] . 'h',
                'commentaire' => $row['commentaire_day'],
                'montant' => $row['tarif_chambre'],
                'lit_sup' => $row['lit_sup'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => $row['total'] + $row['lit_sup'] * $row['tarif_lit_sup'],
            );
        }

        return $data;
    }

    function readNuit()
    {
        $data = [];
        $pour = new pourModel();
        $archives = new archiveModel();
        $relier = new relierModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        $tabPlanningNuit = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('fin_sejour >= CURDATE() AND debut_sejour < CURDATE() + 1')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('relier.ID_archive', $archive['ID_archive'])->findAll();

        foreach ($tabPlanningNuit as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_planning' => $row['ID_planning'],
                'statut_chambre' => $row['statut_chambre'],
                'ID_reservation' => '',
                'motif' => $row['motif'],
                'nom' => $row['nom_client'],
                'debut' => $row['debut_sejour'],
                'fin' => $row['fin_sejour'],
                'duree' => $row['nbr_nuit'] . ' nuitées',
                'commentaire' => $row['commentaire_nuit'],
                'montant' => $row['tarif_chambre'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => ($row['total'] + $row['lit_sup'] * $row['tarif_lit_sup']) - $row['remise'] * $row['total'] / 100,
                // 'total' => ($row['total'] + $row['lit_sup'] * $row['tarif_lit_sup']),
            );
        }

        return $data;
    }

    function readLibre()
    {
        $data = [];
        $chambres = new chambreModel();
        $relier = new relierModel();
        $archives = new archiveModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        $tabPlanningLibre = $chambres->where('statut_chambre', 'Libre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('relier.ID_archive', $archive['ID_archive'])->findAll();
        
        // $tabPlanningLibre = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('fin_sejour >= CURDATE() AND debut_sejour < CURDATE() + 1')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('relier.ID_archive', $archive['ID_archive'])->findAll();
        foreach ($tabPlanningLibre as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_planning' => '',
                'statut_chambre' => $row['statut_chambre'],
                'ID_reservation' => '',
                'motif' => '',
                'nom' => '',
                'debut' => '',
                'fin' => '',
                'duree' => '',
                'commentaire' => '',
                'montant' => $row['tarif_chambre'],
                'surplus' => 0,
                'total' => $row['tarif_chambre'],
                // 'total' => ($row['total'] + $row['lit_sup'] * $row['tarif_lit_sup']),
            );
        }

        return $data;
    }

// AFFICHAGE RESOURCE

    public function planningChambre()
    {
        $data = [];
        // $planning = [];
        helper(['form']);

        if (isset($_POST['planning'])) {
            $relier = new relierModel();
            $planning = new planningModel();
            $archives = new archiveModel();
            $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

            $tabChambres = $relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll();

            foreach ($tabChambres as $row) {
                $resources[] = array(
                    'id' => $row['ID_chambre'],
                    'title' => $row['ID_chambre'],
                );
            }

            // $tabPlanning = $planning->where('relier.ID_archive', $archive['ID_archive'])->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive =  archive.ID_archive')->findAll();
            $tabPlanningNuit = $planning->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('pour', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->findAll();
            foreach ($tabPlanningNuit as $row) {
                $events[] = array(
                    'id' => $row['ID_chambre'] . $row['ID_planning'],
                    'resourceId' => $row['ID_chambre'],
                    'title' => $row['motif'],
                    'start' => $row['debut_sejour'] . ' ' . $row['heure_arrive'],
                    'end' => $row['fin_sejour'] . ' ' . $row['heure_depart'],
                    'allDay' => 'false',
                    'backgroundColor' => '#283e51',
                    'textColor' => 'white',
                    'borderColor' => '#283e51',
                );
            }

            $tabPlanningDay = $planning->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('pour', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->findAll();
            foreach ($tabPlanningDay as $row) {
                $events[] = array(
                    'id' => $row['ID_chambre'] . $row['ID_planning'],
                    'resourceId' => $row['ID_chambre'],
                    // 'title' => $row['motif'],
                    'start' => $row['debut_sejour'] . ' ' . $row['heure_arrive'],
                    'end' => $row['fin_sejour'] . ' ' . $row['heure_depart'],
                    'backgroundColor' => '#ff5f6d',
                    'textColor' => 'white',
                    'borderColor' => '#ff5f6d',
                );
            }

            echo json_encode([$resources, $events]);
        }
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

        if ($_POST['motif'] == 'Nuitée') {
            // $data['detail'] = $pour->where('pour.ID_planning', $_POST['ID_planning'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->first();
            // $archives = new archiveModel();
            // $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();
            
            $concerner = new concernerModel();
            $archive = $concerner->where('ID_planning', $_POST['ID_planning'])->join('archive', 'concerner.ID_archive = archive.ID_archive')->first();

            $data['details'] = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(date_facture_nuit, "%d %b %Y") AS date_facture_nuit'])->where('pour.ID_planning', $_POST['ID_planning'])->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->find();
            // $data['details'] = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(date_facture_nuit, "%d %b %Y à %H:%i") AS date_facture_nuit'])->where('pour.ID_planning', $_POST['ID_planning'])->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->find();

            // $nuit = new reservationNuitModel();
            $nuit = new effectuerModel();

            // $data['info'] = $nuit->where('ID_nuit', $_POST['ID_reservation'])->first();
            $data['info'] = $nuit->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', 'DATE_FORMAT(date_reservation_nuit, "%d %b %Y à %H:%i") AS date_reservation_nuit', 'DATE_FORMAT(date_modification_nuit, "%d %b %Y à %H:%i") AS date_modification_nuit'])
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

        if ($_POST['motif'] == 'Day use') {
            // $data['detail'] = $pour->where('pour.ID_planning', $_POST['ID_planning'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->first();
            // $archives = new archiveModel();
            // $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

            $concerner = new concernerModel();
            $archive = $concerner->where('ID_planning', $_POST['ID_planning'])->join('archive', 'concerner.ID_archive = archive.ID_archive')->first();



            // $data['details'] = $pour->select(['*', 'DATE_FORMAT(date_facture_day, "%d %b %Y à %H:%i") AS date_facture_day'])->where('pour.ID_planning', $_POST['ID_planning'])->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->find();
            $data['details'] = $pour->select(['*', 'DATE_FORMAT(date_facture_day, "%d %b %Y) AS date_facture_day'])->where('pour.ID_planning', $_POST['ID_planning'])->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->find();

            $day = new effectuerModel();

            $data['info'] = $day->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', 'DATE_FORMAT(date_reservation_day, "%d %b %Y à %H:%i") AS date_reservation_day', 'DATE_FORMAT(date_modification_day, "%d %b %Y à %H:%i") AS date_modification_day'])->where('effectuer.ID_day', $_POST['ID_reservation'])->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->first();

            // $data['info'] = $day->where('ID_day', $_POST['ID_reservation'])->first();

            echo view('planning\infoPlanningDay', $data);
            return ($data);
            // echo json_encode($data);
        }
    }
}
