<?php

namespace App\Controllers;

use App\models\userModel;
use App\models\adminModel;
use App\models\clientModel;
use App\models\chambreModel;
use App\models\reservationNuitModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = $this->read();
		echo view('templates/header');
		echo view('dashboard/dashboard', $data);
		echo view('templates/footer');
	}

	public function read()
    {
        $data = [];
        $clients = new clientModel();
        $data['clients'] = $clients->findAll();
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
