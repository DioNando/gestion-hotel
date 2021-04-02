<?php

namespace App\Controllers;

use App\models\clientModel;

class Cardex extends BaseController
{
	public function index()
	{	
		if (isset($_POST['btn_recherche']) AND $_POST['element_recherche'] != NULL) {
			$data = $this->search($_POST['element_recherche']);
			echo view('templates\header');
			echo view('client\ficheCardex', $data);
			echo view('templates\footer');
		} else {
			$data = $this->read();
			echo view('templates\header');
			echo view('client\ficheCardex', $data);
			echo view('templates\footer');
		}
	}

	public function read()
	{
		$data = [];
		$clients = new clientModel();
		$data['clients'] = $clients->orderBy('ID_client', 'asc')->findAll();
		return $data;
	}

	public function search($nom_client)
	{
		$data = [];
		$clients = new clientModel();
		$data['clients'] = $clients->where('nom_client', $nom_client)->find();
		return $data;
	}	

}
