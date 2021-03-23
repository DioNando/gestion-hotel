<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\chambreModel;
use App\models\reservationModel;
use App\models\reservationPassageModel;
use App\models\concernerModel;

class ReservationPassage extends BaseController
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
			return redirect()->to('configReservationPassage');
		} elseif (isset($_POST['btn_suppression'])) {
			//$this->delete();
			return redirect()->to('configReservationPassage');
		} else {
			$data = $this->read();
			echo view('templates\header');
			echo view('reservation\configReservationPassage', $data);
			echo view('templates\footer');
		}
	}

	

	public function addReservationPassage()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_reservation'])) : {
				$rules = [
					'date_passage' => 'required',
					'heure_passage' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationPassageModel();
					$newData = [
						'date_passage' => $_POST['date_passage'],
						'heure_passage' => $_POST['heure_passage'],
						'duree_passage' => $_POST['duree_passage'],
						'ID_user' => $user['ID_user'],
					];
					$reservations->save($newData);
					$id = $reservations->getInsertID();
					$this->addConcerner($id);
					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Réservation réussie');
					return redirect()->to('reservationPassage');
				}
			}
		endif;

		$chambres = new chambreModel();
		$data['chambres'] = $chambres->findAll();
		echo view('templates\header');
		echo view('reservation\passage', $data);
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

	public function read()
	{
		$data = [];
		$reservations = new reservationPassageModel();
		$data['reservations'] = $reservations->findAll();
		return $data;
	}
}
