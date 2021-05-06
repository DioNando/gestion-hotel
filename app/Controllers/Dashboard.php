<?php

namespace App\Controllers;

use App\models\userModel;
use App\models\adminModel;
use App\models\clientModel;
use App\models\chambreModel;
use App\models\reservationNuitModel;
use App\models\reservationDayModel;
use App\models\effectuerModel;
use App\models\pourModel;
use App\models\archiveModel;
use App\models\relierModel;

class Dashboard extends BaseController
{
	public function index()
	{
		session();
		$data['detailsNuit'] = $this->infoDetailsNuit();
		$data['detailsDay'] = $this->infoDetailsDay();
		$data['nombresNuitDay'] = $this->nombreReservationMois();
		$data['user'] = $this->readUser(session()->get('nom_user'));
		$data['chambres'] = $this->readChambre();
		$data['day'] = $this->readDay();
        $data['nuit'] = $this->readNuit();
        $data['plannings'] = array_merge($data['nuit'], $data['day']);
	
		echo view('templates/header');
		echo view('dashboard/dashboard', $data);
		echo view('templates/footer');
	}

	public function readReservation()
	{
		$data = [];
		$clients = new clientModel();
		$data = $clients->findAll();
		return $data;
	}

	public function readUser($nom_user)
	{
		$data = [];
		$user = new userModel();
		$data = $user->where('nom_user', $nom_user)->first();
		return $data;
	}

	
	public function readChambre()
	{
		$data = [];
		$chambres = new chambreModel();
		// $data = $clients->orderBy('ID_client', 'desc')->limit(10)->find();
		$data = $chambres->findAll();
		return $data;
	}

	public function infoDetailsNuit()
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->where('fin_sejour >= CURDATE() AND debut_sejour < CURDATE() + 1')->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll();
		return $data;
	}

	public function infoDetailsDay()
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->where('DAY(debut_sejour) = DAY(CURDATE())')->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll();
		return $data;
	}

	public function nombreReservationMois()
    {
        $data = [];
        $reservations = new effectuerModel();
		$data['nbrNuit'] = $reservations->where('MONTH(debut_sejour) = MONTH(CURDATE())')->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll();
		$data['nbrDay'] = $reservations->where('MONTH(debut_sejour) = MONTH(CURDATE())')->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll();
		return count($data['nbrDay']) + count($data['nbrNuit']);
    }

	public function etatFinancier()
	{
		echo view('templates/header');
		echo view('dashboard/etatFinancier');
		echo view('templates/footer');
	}

	public function statistique()
	{
		echo view('templates/header');
		echo view('dashboard/statistique');
		echo view('templates/footer');
	}

	function readDay()
    {
        $data = [];
        $pour = new pourModel();
		$archives = new archiveModel();
        $relier = new relierModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();
        $tabPlanningDay = $pour->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart', '(tarif_chambre * duree_day) AS total'])->where('debut_sejour = CURDATE()')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->findAll();

        foreach ($tabPlanningDay as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_reservation' => $row['ID_day'],
                'ID_planning' => $row['ID_planning'],
                'motif' => $row['motif'],
                'nom' => $row['nom_client_day'],
                'description_chambre' => $row['description_chambre'],
                'tarif_chambre' => $row['tarif_chambre'],
                'statut_chambre' => $row['statut_chambre'],
                'commentaire' => $row['commentaire_day'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => $row['total'],
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

        $tabPlanningNuit = $pour->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', '(tarif_chambre * nbr_nuit) AS total'])->where('fin_sejour >= CURDATE() AND debut_sejour < CURDATE() + 1')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->findAll();

        foreach ($tabPlanningNuit as $row) {
            $data[] = array(
                'ID_chambre' => $row['ID_chambre'],
                'ID_reservation' => $row['ID_nuit'],
                'ID_planning' => $row['ID_planning'],
                'motif' => $row['motif'],
                'nom' => $row['nom_client'],
                'description_chambre' => $row['description_chambre'],
                'tarif_chambre' => $row['tarif_chambre'],
                'statut_chambre' => $row['statut_chambre'],
                'commentaire' => $row['commentaire_nuit'],
                'surplus' => $row['lit_sup'] * $row['tarif_lit_sup'],
                'total' => $row['total'],
            );
        }

        return $data;
    }
}
