<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\chambreModel;
use App\models\reservationNuitModel;
use App\models\reservationDayModel;
use App\models\concernerModel;
use App\models\effectuerModel;

class ReservationDay extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['infoDay'])) {
			$data['info'] = $this->infoSupplementaireDay($_POST['ID_day']);
			echo view('reservation\infoReservationDay', $data);
			return ($data);
		}
		if (isset($_POST['infoDetails'])) {
			$data['info'] = $this->infoSupplementaireDay($_POST['ID_day']);
			echo view('reservation\infoDayDetails', $data);
			return ($data);
		}
		if (isset($_POST['btn_modification'])) {
			$this->update();
			return redirect()->to('configReservationDay');
		} 
		if (isset($_POST['btn_suppression'])) {
			$this->delete();
			return redirect()->to('configReservationDay');
		} else {
			$data = $this->read();
			echo view('templates\header');
			echo view('reservation\configReservationDay', $data);
			echo view('templates\footer');
		}
	}

	

	public function addReservationDay()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_validation'])) : {
				$rules = [
					'nom_client_day' => 'required',
					'date_day' => 'required',
					'duree_day' => 'required|is_natural_no_zero',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationDayModel();
					$newData = [
						'nom_client_day' => $_POST['nom_client_day'],
						'date_day' => $_POST['date_day'],
						'heure_arrive' => $_POST['heure_arrive'],
						'heure_depart' => $_POST['heure_depart'],
						'duree_day' => $_POST['duree_day'],
						'ID_user' => $user['ID_user'],
					];
					$reservations->save($newData);
					$id = $reservations->getInsertID();
					$this->addConcerner($id);
					$this->addEffectuer($id, $user['ID_user']);
					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Réservation réussie');
					return redirect()->to('reservationDay');
				}
			}
		endif;

		$chambres = new chambreModel();
		$data['chambres'] = $chambres->findAll();
		echo view('templates\header');
		echo view('reservation\day', $data);
		echo view('templates\footer');
	}

	public function addEffectuer($ID_reservation, $ID_user)
	{
		$effectuer = new effectuerModel();
		$newData = [
			'ID_user' => $ID_user,
			'ID_day' => $ID_reservation,
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
					'ID_day' => $ID_reservation,
					'statut_chambre' => 'Occupée',
				];

				$chambres->set($newData);
				$chambres->where('ID_chambre', $valeur);
				$chambres->update();
				$concerner->save($newData);
			}
		}
	}

	public function read()
	{
		$data = [];
	
		$reservations = new effectuerModel();
		$data['reservations'] = $reservations->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->orderBy('reservation_day.ID_day', 'desc')->findAll();
		return $data;
	}

	public function infoSupplementaireDay($ID_day)
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->where('effectuer.ID_day', $ID_day)->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->first();
		return $data;
	}

	public function update()
	{
		$data = [];
		helper('form');

		if (isset($_POST['btn_modification'])) : {
			$rules = [
					'nom_client_day' => 'required',
					'date_day' => 'required',
					'duree_day' => 'required|is_natural_no_zero',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationDayModel();
					$data = [
						'nom_client_day' => $_POST['nom_client_day'],
						'date_day' => $_POST['date_day'],
						'heure_arrive' => $_POST['heure_arrive'],
						'heure_depart' => $_POST['heure_depart'],
						'duree_day' => $_POST['duree_day'],
						'ID_user' => $user['ID_user'],
					];

					$reservations->set($data);
					$reservations->where('ID_day', $_POST['ID_day']);
					$reservations->update();
					$session = session();
					$session->setFlashdata('update', 'La ligne a été modifié avec succès');
				}
			}
		endif;
	}

	public function delete()
	{
		$reservation = new reservationDayModel();
		$reservation->delete(['ID_day' => $_POST['ID_day']]);
		$session = session();
		$session->setFlashdata('delete', 'La réservation a été supprimé avec succès');
	}
}
