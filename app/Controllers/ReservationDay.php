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

		if (isset($_POST['btn_reservation'])) {
			//$this->create();
			return redirect()->to('reservation');
		} elseif (isset($_POST['btn_modification'])) {
			//$this->update();
			return redirect()->to('configReservationDay');
		} elseif (isset($_POST['btn_suppression'])) {
			//$this->delete();
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

		if (isset($_POST['btn_reservation'])) : {
				$rules = [
					'date_day' => 'required',
					'heure_day' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationDayModel();
					$newData = [
						'date_day' => $_POST['date_day'],
						'heure_day' => $_POST['heure_day'],
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
		// $reservations = new reservationDayModel();
		// $data['reservations'] = $reservations->join('user', 'reservation_day.ID_user = user.ID_user')->findAll();

		$reservations = new effectuerModel();
		$data['reservations'] = $reservations->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->orderBy('reservation_day.ID_day', 'desc')->findAll();
		return $data;
	}
}
