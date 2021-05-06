<?php

namespace App\Controllers;

use App\models\factureNuitModel;
use App\models\factureDayModel;
use App\models\pourModel;

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

		$data = [
			'type_payement_nuit' => $_POST['type_payement'],
		];

		$facture->set($data);
		$facture->where('ID_facture_nuit', $ID_facture);
		$facture->update();
		$session = session();
		$session->setFlashdata('update', 'La facture a été sauvegardé');
	}

	public function addFactureDay($ID_facture)
	{
		$data = [];
		helper(['form']);

		$facture = new factureDayModel();

		$data = [
			'type_payement_day' => $_POST['type_payement'],
		];

		$facture->set($data);
		$facture->where('ID_facture_day', $ID_facture);
		$facture->update();

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
