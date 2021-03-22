<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\chambreModel;
use App\models\reservationModel;
use App\models\concernerModel;

class Reservation extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_reservation'])) : {
				$rules = [
					'nom_client' => 'required|min_length[3]|max_length[30]',
					'prenom_client' => 'required|min_length[4]|max_length[255]',
					'debut_sejour' => 'required',
					'fin_sejour' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$clients = new clientModel();
					$client = $clients->where('nom_client', $_POST['nom_client'])->first();
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationModel();
					$newData = [
						'nbr_personne' => $_POST['nbr_personne'],
						'debut_sejour' => $_POST['debut_sejour'],
						'fin_sejour' => $_POST['fin_sejour'],
						'ID_client' => $client['ID_client'],
						'ID_user' => $user['ID_user'],
					];
					$reservations->save($newData);
					$id = $reservations->getInsertID();
					$this->addConcerner($id);
					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Réservation réussie');
					return redirect()->to('reservationNuit');
				}
			}
		endif;

		$chambres = new chambreModel();
        $data['chambres'] = $chambres->findAll();
		echo view('templates\header');
		echo view('reservation\nuit', $data);
		echo view('templates\footer');
	}

	public function addConcerner($ID)
	{
		$concerner = new concernerModel();
		if (isset($_POST['ID_chambre'])) {
			foreach ($_POST['ID_chambre'] as $valeur) {
				$newData = [
					'ID_chambre' => $valeur,
					'ID_reservation' => $ID,
				];
				$concerner->save($newData);
			}
		}
	}

	public function addClient()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_reservation'])) : {
				$rules = [
					'nom_client' => 'required|min_length[3]|max_length[30]|is_unique[client.nom_client]',
					'prenom_client' => 'required|min_length[4]|max_length[255]|is_unique[client.prenom_client]',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$clients = new clientModel();
					$newData = [
						'nom_client' => $_POST['nom_client'],
						'prenom_client' => $_POST['prenom_client'],
					];

					$clients->save($newData);
					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Enregistrement réussie');
					return redirect()->to('reservationNuit');
				}
			}
		endif;

		echo view('templates\header');
		echo view('client\addClient', $data);
		echo view('templates\footer');
	}
}
