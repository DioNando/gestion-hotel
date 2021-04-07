<?php

namespace App\Controllers;

use App\models\userModel;
use App\models\adminModel;
use App\models\clientModel;
use App\models\chambreModel;
use App\models\reservationNuitModel;
use App\models\effectuerModel;

class Dashboard extends BaseController
{
	public function index()
	{
		session();
		$data['detailsNuit'] = $this->infoDetailsNuit();
		$data['detailsDay'] = $this->infoDetailsDay();
		$data['user'] = $this->readUser(session()->get('nom_user'));
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

	public function infoDetailsNuit()
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll();
		return $data;
	}

	public function infoDetailsDay()
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll();
		return $data;
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
}
