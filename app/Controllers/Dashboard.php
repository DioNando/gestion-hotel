<?php

namespace App\Controllers;

use App\models\userModel;
use App\models\adminModel;
use App\models\clientModel;
use App\models\chambreModel;
use App\models\reservationModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = $this->read();
		echo view('templates/header');
		echo view('dashboard', $data);
		echo view('templates/footer');
	}

	public function read()
    {
        $data = [];
        $clients = new clientModel();
        $data['clients'] = $clients->findAll();
        return $data;
    }
}
