<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\pourModel;

class Facture extends BaseController
{
	public function index()
	{
		echo view('templates\header');
		echo view('templates\footer');
	}

	public function factureNuit()
	{
		$data = [];
		helper('form');
		$data = $this->infoDetailsNuit(session()->get('ID_nuit'));
		echo view('templates\header');
		echo view('facture\factureNuit', $data);
		echo view('templates\footer');
	}
	
	public function factureDay()
	{
		$data = [];
		helper('form');
		$data = $this->infoDetailsDay(session()->get('ID_day'));
		echo view('templates\header');
		echo view('facture\factureDay', $data);
		echo view('templates\footer');	
	}

	public function infoDetailsNuit($ID_nuit)
	{
		$data = [];
		$reservations = new pourModel();
		$data['details'] = $reservations->where('pour.ID_nuit', $ID_nuit)->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('concerner.ID_chambre')->find();
		return $data;
	}

	public function infoDetailsDay($ID_day)
	{
		$data = [];
		$reservations = new pourModel();
		$data['details'] = $reservations->where('pour.ID_day', $ID_day)->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('concerner.ID_chambre')->find();
		return $data;
	}
}
