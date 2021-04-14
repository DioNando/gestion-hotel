<?php

namespace App\Controllers;

use App\models\clientModel;

class Facture extends BaseController
{
	public function index()
	{
		echo view('templates\header');
		echo view('templates\footer');
	}

	public function factureNuit()
	{
		echo view('templates\header');
		echo view('facture\factureNuit');
		echo view('templates\footer');
	}

	public function factureDay()
	{
		echo view('templates\header');
		echo view('facture\factureDay');
		echo view('templates\footer');	
	}
}
