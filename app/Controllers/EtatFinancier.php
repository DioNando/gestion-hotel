<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\cardexModel;
use App\Models\userModel;
use App\Models\chambreModel;
use App\Models\reservationNuitModel;
use App\Models\reservationDayModel;
use App\Models\concernerModel;
use App\Models\effectuerModel;
use App\Models\planningModel;
use App\Models\archiveModel;
use App\Models\pourModel;
use App\Models\factureNuitModel;
use App\Models\historiqueModel;
use App\Models\stockerModel;
use App\Models\relierModel;

class EtatFinancier extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);
        $archives = new archiveModel();

        $data['day'] = $this->readDay();
        $data['nuit'] = $this->readNuit();
        $data['plannings'] = array_merge($data['nuit'], $data['day']);
        // $data['plannings'] = ksort($data['plannings']);

        $total = 0;
        foreach($data['plannings'] as $row) {
            $total = $total + $row['total'];
        }
        $data['total'] = $total;
        // $data['debut'] = '';
        // $data['fin'] = '';

        echo view('templates/header');
        echo view('dashboard/etatFinancier', $data);
        echo view('templates/footer');
    }

    function readDay()
    {
        $data = [];
        $pour = new pourModel();
        // $archives = new archiveModel();
        // $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('debut_sejour = CURDATE()')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();

        foreach ($tabPlanningDay as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_planning' => $row['ID_planning'],
                'debut' => $row['heure_arrive'],
                'fin' => $row['heure_depart'],
                'duree' => $row['duree_day'] . 'h',
                'offert' => '0',
                'remise' => '0',
                'montant' => $row['tarif_chambre'],
                'lit_sup' => $row['lit_sup'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => $row['total'] + $row['lit_sup'] * $row['tarif_lit_sup'],
                // 'statut_chambre' => $row['statut_chambre'],
                // 'ID_reservation' => $row['ID_day'],
                // 'motif' => $row['motif'],
                // 'nom' => $row['nom_client_day'],
                // 'commentaire' => $row['commentaire_day'],
            );
        }

        return $data;
    }

    function readNuit()
    {
        $data = [];
        $pour = new pourModel();
        // $archives = new archiveModel();
        // $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        $tabPlanningNuit = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('fin_sejour >= CURDATE() AND debut_sejour < CURDATE() + 1')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();

        foreach ($tabPlanningNuit as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_planning' => $row['ID_planning'],
                'debut' => $row['debut_sejour'],
                'fin' => $row['fin_sejour'],
                'duree' => $row['nbr_nuit'] . ' nuitées',
                'offert' => $row['offert'],
                'remise' => $row['remise'],
                'montant' => $row['tarif_chambre'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => ($row['total'] + $row['lit_sup'] * $row['tarif_lit_sup']) - $row['remise'] * $row['total'] / 100,
                // 'statut_chambre' => $row['statut_chambre'],
                // 'ID_reservation' => '',
                // 'motif' => $row['motif'],
                // 'nom' => $row['nom_client'],
                // 'commentaire' => $row['commentaire_nuit'],
                // 'total' => ($row['total'] + $row['lit_sup'] * $row['tarif_lit_sup']),
            );
        }

        return $data;
    }

    public function search()
    {
        $data = [];
        // $pour = new pourModel();

        $debut = $_POST['date_debut'];
        $fin = $_POST['date_fin'];

        if ($debut == '' AND $fin == '') {
			return redirect()->to('etatFinancier');
        }

        $data['day'] = $this->searchDay($debut, $fin);
        $data['nuit'] = $this->searchNuit($debut, $fin);
        $data['plannings'] = array_merge($data['nuit'], $data['day']);

        $total = 0;
        foreach($data['plannings'] as $row) {
            $total = $total + $row['total'];
        }
        $data['total'] = $total;
        
        if($_POST['date_debut'] != '') {
            $debut = date_create($debut);
            $data['debut'] = date_format($debut, 'd M Y');
        } else {
            $data['debut'] = 'Aujourd\'hui';
        }

        if($_POST['date_fin'] != '') {
            $fin = date_create($fin);
            $data['fin'] = date_format($fin, 'd M Y');
        } else {
            $data['fin'] = 'Aujourd\'hui';
        }

        echo view('templates/header');
        echo view('dashboard/etatFinancier', $data);
        echo view('templates/footer');
    }

    function searchDay($debut, $fin)
    {
        $data = [];
        $pour = new pourModel();

        if ($debut != '' and $fin != '') {
            $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('debut_sejour >= ', $debut)->where('debut_sejour <= ', $fin)->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();
        } else {
            if ($debut != '') {
                $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('debut_sejour >=', $debut)->where('debut_sejour <= CURDATE()')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();
            }
            if ($fin != '') {
                $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('debut_sejour >= CURDATE()')->where('debut_sejour <= ', $fin)->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();
            }
        }

        foreach ($tabPlanningDay as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_planning' => $row['ID_planning'],
                'debut' => $row['heure_arrive'],
                'fin' => $row['heure_depart'],
                'duree' => $row['duree_day'] . 'h',
                'offert' => '0',
                'remise' => '0',
                'montant' => $row['tarif_chambre'],
                'lit_sup' => $row['lit_sup'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => $row['total'] + $row['lit_sup'] * $row['tarif_lit_sup'],
                // 'statut_chambre' => $row['statut_chambre'],
                // 'ID_reservation' => $row['ID_day'],
                // 'motif' => $row['motif'],
                // 'nom' => $row['nom_client_day'],
                // 'commentaire' => $row['commentaire_day'],
            );
        }

        return $data;
    }

    function searchNuit($debut, $fin)
    {
        $data = [];
        $pour = new pourModel();

        if ($debut != '' and $fin != '') {
            $tabPlanningNuit = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('debut_sejour >= ', $_POST['date_debut'])->where('debut_sejour <= ', $_POST['date_fin'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();
        } else {
            if ($debut != '') {
                $tabPlanningNuit = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('debut_sejour >= ', $_POST['date_debut'])->where('debut_sejour <= CURDATE()')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();
            }
            if ($fin != '') {
                $tabPlanningNuit = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('debut_sejour >= CURDATE()')->where('debut_sejour <= ', $_POST['date_fin'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->findAll();
            }
        }

        foreach ($tabPlanningNuit as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_planning' => $row['ID_planning'],
                'debut' => $row['debut_sejour'],
                'fin' => $row['fin_sejour'],
                'duree' => $row['nbr_nuit'] . ' nuitées',
                'offert' => $row['offert'],
                'remise' => $row['remise'],
                'montant' => $row['tarif_chambre'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => ($row['total'] + $row['lit_sup'] * $row['tarif_lit_sup']) - $row['remise'] * $row['total'] / 100,
                // 'statut_chambre' => $row['statut_chambre'],
                // 'ID_reservation' => '',
                // 'motif' => $row['motif'],
                // 'nom' => $row['nom_client'],
                // 'commentaire' => $row['commentaire_nuit'],
                // 'total' => ($row['total'] + $row['lit_sup'] * $row['tarif_lit_sup']),
            );
        }

        return $data;
    }
}
