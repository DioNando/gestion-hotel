<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\chambreModel;
use App\models\reservationModel;
use App\models\reservationPassageModel;
use App\models\concernerModel;

class Reservation extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_reservation'])) {
			//$this->create();
			return redirect()->to('reservation');
		} elseif (isset($_POST['btn_modification'])) {
			//$this->update();
			return redirect()->to('configReservation');
		} elseif (isset($_POST['btn_suppression'])) {
			//$this->delete();
			return redirect()->to('configReservation');
		} else {
			$data = $this->read();
			echo view('templates\header');
			echo view('reservation\configReservation', $data);
			echo view('templates\footer');
		}
	}

	public function addReservationNuit()
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

	public function accueilClient()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_reservation'])) : {
				$rules = [
					'nom_client' => 'required|min_length[3]|max_length[30]',
					'prenom_client' => 'required|min_length[4]|max_length[255]',
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
		echo view('reservation\accueilClient', $data);
		echo view('templates\footer');
	}

	public function read()
	{
		$data = [];
		/*$clients = new clientModel();
		$users = new userModel();*/
		$reservations = new reservationModel();
		$data['reservations'] = $reservations->findAll();
		//$data['clients'] = $clients->where('ID_client', $reservations['ID_client'])->first();
		//$data['users'] = $users->where('ID_user', $reservations['ID_user'])->first();
		return $data;
	}
}
