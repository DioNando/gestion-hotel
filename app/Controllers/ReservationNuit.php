<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\chambreModel;
use App\models\reservationNuitModel;
use App\models\reservationDayModel;
use App\models\concernerModel;
use App\models\effectuerModel;

class ReservationNuit extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['infoClient'])) {
			$data['info'] = $this->infoReservationNuit($_POST['ID_nuit']);
			echo view('reservation\infoReservationClient', $data);
			return ($data);
		}
		if (isset($_POST['infoNuit'])) {
			$data['info'] = $this->infoReservationNuit($_POST['ID_nuit']);
			echo view('reservation\infoReservationClient', $data);
			return ($data);
		}
		if (isset($_POST['btn_modification'])) {
			//$this->update();
			return redirect()->to('configReservationNuit');
		}
		if (isset($_POST['btn_suppression'])) {
			$this->delete();
			return redirect()->to('configReservationNuit');
		}
		else {
			$data = $this->read();
			echo view('templates\header');
			echo view('reservation\configReservationNuit', $data);
			echo view('templates\footer');
		}
	}

	public function addReservationNuit()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_attente']) or isset($_POST['btn_arrive'])) : {
				$rules = [
					'nom_client' => 'required|min_length[3]|max_length[30]',
					'prenom_client' => 'required|min_length[4]|max_length[255]',
					'debut_sejour' => 'required',
					'fin_sejour' => 'required',
					'nbr_nuit' => 'is_natural'
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$clients = new clientModel();
					$client = $clients->where('nom_client', $_POST['nom_client'])->first();
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();

					if (isset($_POST['btn_attente'])) { //etat_reservation = 0
						if (isset($_POST['confirmation_reservation']))
							$etat = 2;
						else
							$etat = 3;
					}
					if (isset($_POST['btn_arrive'])) { //etat_reservation = 1
						if (isset($_POST['confirmation_reservation']))
							$etat = 1;
						else
							$etat = 4;
					}

					$reservations = new reservationNuitModel();
					$newData = [
						'nbr_personne' => $_POST['nbr_personne'],
						'debut_sejour' => $_POST['debut_sejour'],
						'fin_sejour' => $_POST['fin_sejour'],
						'nbr_nuit' => $_POST['nbr_nuit'],
						'ID_client' => $client['ID_client'],
						'ID_etat_reservation' => $etat,
						'type_reservation' => $_POST['type_reservation'],
						'remarque_reservation' => $_POST['remarque_reservation'],
					];
					$reservations->save($newData);
					$id = $reservations->getInsertID();
					$this->addConcerner($id);
					$this->addEffectuer($id, $user['ID_user']);
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

	public function addEffectuer($ID_reservation, $ID_user)
	{
		$effectuer = new effectuerModel();
		$newData = [
			'ID_user' => $ID_user,
			'ID_nuit' => $ID_reservation,
		];
		$effectuer->save($newData);
	}

	public function addConcerner($ID_reservation)
	{
		$concerner = new concernerModel();
		$chambres = new chambreModel();
		if (isset($_POST['ID_chambre'])) {
			foreach ($_POST['ID_chambre'] as $valeur) {
				$newData = [
					'ID_chambre' => $valeur,
					'ID_nuit' => $ID_reservation,
					'statut_chambre' => 'Occupée',
				];
				$chambres->set($newData);
				$chambres->where('ID_chambre', $valeur);
				$chambres->update();
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
						'telephone_client' => $_POST['telephone_client'],
					];

					$clients->save($newData);
					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Enregistrement réussie');
					return redirect()->to('reservationNuit');
				}
			}
		endif;

		if (isset($_POST['btn_recherche'])) : {
				$rules = [
					'element_recherche' => 'required|validateClient',
				];

				if (!$this->validate($rules)) {
					$data['validation_recherche'] = $this->validator;
				} else {
					$data = $this->search($_POST['element_recherche']);
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
		$reservations = new effectuerModel();
		$data['reservations'] = $reservations->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->orderBy('reservation_nuit.ID_nuit', 'desc')->findAll();
		return $data;
	}

	public function infoReservationNuit($ID_nuit)
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->where('effectuer.ID_nuit', $ID_nuit)->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->orderBy('reservation_nuit.ID_nuit', 'desc')->first();
		return $data;
	}

	public function search($nom_client)
	{
		$clients = new clientModel();
		$client = $clients->where('nom_client', $nom_client)->first();

		$newData = [
			'nom_client' => $client['nom_client'],
			'prenom_client' => $client['prenom_client'],
		];
		$session = session();
		$session->set($newData);
	}

	public function delete()
	{
		$reservation = new reservationNuitModel();
		$reservation->delete(['ID_nuit' => $_POST['ID_nuit']]);
		$session = session();
		$session->setFlashdata('delete', 'La réservation a été supprimé avec succès');
	}
}
