<?php

namespace App\Controllers;

use App\Models\factureNuitModel;
use App\Models\factureDayModel;
use App\Models\pourModel;
use App\Models\effectuerModel;
use App\Models\reservationNuitModel;
use App\Models\reservationDayModel;

class Facture extends BaseController
{
	public function index()
	{
		if (isset($_POST['btn_facture_nuit'])) {
			$this->addFactureNuit($_POST['ID_facture_nuit']);
			return redirect()->to('configReservationNuit');
		}
		if (isset($_POST['btn_facture_day'])) {
			$this->addFactureDay($_POST['ID_facture_day']);
			return redirect()->to('configReservationDay');
		}
	}

	public function addFactureNuit($ID_facture)
	{
		$data = [];
		helper(['form']);
		
		$facture = new factureNuitModel();
		$fac = $facture->where('ID_facture_nuit', $ID_facture)->first();
		
		$data = [
			'type_payement_nuit' => $_POST['type_payement'],
			'date_facture_nuit' => $_POST['date_facture_nuit'],
			'somme_donne_nuit' => $_POST['somme_donne_nuit'] + $fac['somme_donne_nuit'],
		];
		
		$facture->set($data);
		$facture->where('ID_facture_nuit', $ID_facture);
		$facture->update();
		
		$this->addEffectuerModif($ID_facture, session()->get('nom_user'), 'Nuitée');
		
		$session = session();
		$session->setFlashdata('update', 'La facture a été sauvegardé');
	}
	
	public function addFactureDay($ID_facture)
	{
		$data = [];
		helper(['form']);
		
		$facture = new factureDayModel();
		$fac = $facture->where('ID_facture_day', $ID_facture)->first();
		
		$data = [
			'type_payement_day' => $_POST['type_payement'],
			'date_facture_day' => $_POST['date_facture_day'],
			'somme_donne_day' => $_POST['somme_donne_day'] + $fac['somme_donne_day'],
		];

		$facture->set($data);
		$facture->where('ID_facture_day', $ID_facture);
		$facture->update();

		$this->addEffectuerModif($ID_facture, session()->get('nom_user'), 'Day use');

		$session = session();
		$session->setFlashdata('update', 'La facture a été sauvegardé');
	}

	public function infoDetailsNuit($ID_nuit, $ID_archive)
	{
		$data = [];
		$reservations = new pourModel();
		$data = $reservations->where('pour.ID_nuit', $ID_nuit)->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('relier.ID_archive', $ID_archive)->find();
		return $data;
	}

	public function infoDetailsDay($ID_day, $ID_archive)
	{
		$data = [];
		$reservations = new pourModel();
		// $data = $reservations->where('pour.ID_day', $ID_day)->where('archive.ID_archive', $archive['ID_archive'])->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('archive', 'concerner.ID_archive = archive.ID_archive')->join('relier', 'relier.ID_archive = archive.ID_archive')->find();
		$data = $reservations->where('pour.ID_day', $ID_day)->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('relier.ID_archive', $ID_archive)->find();
		return $data;
	}

	public function addEffectuerModif($ID_facture, $nom_user, $motif)
	{
		$effectuer = new effectuerModel();

		$newData = [
			'nom_user_modif' => $nom_user,
		];

		if ($motif == 'Nuitée') {
			$factureN = new factureNuitModel();
			// $reservations = new reservationNuitModel();
			$nuit = $factureN->where('ID_facture_nuit', $ID_facture)->join('reservation_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->first();
			
			// $reservations->where('ID_nuit', $nuit['ID_nuit']);
			// $reservations->update();

			$effectuer->set($newData);
			$effectuer->where('ID_nuit', $nuit['ID_nuit']);
			$effectuer->update();
		}
		
		if ($motif == 'Day use') {
			$factureD = new factureDayModel();
			// $reservations = new reservationDayModel();
			$day = $factureD->where('ID_facture_day', $ID_facture)->join('reservation_day', 'facture_day.ID_day = reservation_day.ID_day')->first();

			// $reservations->where('ID_day', $day['ID_day']);
			// $reservations->update();
			
			$effectuer->set($newData);
			$effectuer->where('ID_day', $day['ID_day']);
			$effectuer->update();
		}
	}

	// public function factureNuit()
	// {
	// 	$data = [];
	// 	helper('form');
	// 	$facture = new factureNuitModel();
	// 	$data['facture'] = $facture->where('ID_facture_nuit', session()->get('ID_facture_nuit'))->first();
	// 	$data['details'] = $this->infoDetailsNuit(session()->get('ID_nuit'), session()->get('ID_archive'));
	// 	echo view('templates\header');
	// 	echo view('facture\factureNuit', $data);
	// 	echo view('templates\footer');
	// }

	// public function factureDay()
	// {
	// 	$data = [];
	// 	helper('form');
	// 	$data['details'] = $this->infoDetailsDay(session()->get('ID_day'), session()->get('ID_archive'));
	// 	echo view('templates\header');
	// 	echo view('facture\factureDay', $data);
	// 	echo view('templates\footer');
	// }
}
