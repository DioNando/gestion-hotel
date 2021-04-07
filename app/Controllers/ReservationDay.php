<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;
use App\models\chambreModel;
use App\models\reservationNuitModel;
use App\models\reservationDayModel;
use App\models\concernerModel;
use App\models\effectuerModel;
use App\models\planningModel;
use App\models\pourModel;

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
			// $data['info'] = $this->infoDetails($_POST['ID_day']);
			$data = $this->infoDetails($_POST['ID_day']);
			echo view('reservation\infoDayDetails', $data);
			return ($data);
		}
		if (isset($_POST['updateDay'])) {
			$data['info'] = $this->infoSupplementaireDay($_POST['ID_day']);
			echo view('reservation\updateDay', $data);
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
					'ID_chambre' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationDayModel();
					$planning = new planningModel();

					$newData = [
						'nom_client_day' => $_POST['nom_client_day'],
						'date_day' => $_POST['date_day'],
						'duree_day' => $_POST['duree_day'],
						'ID_user' => $user['ID_user'],
					];

					$newDataPlanning = [
						'debut_sejour' => $_POST['date_day'],
						'fin_sejour' => $_POST['date_day'],
						'heure_arrive' => $_POST['heure_arrive'],
						'heure_depart' => $_POST['heure_depart'],
						'motif' => 'Day use',
					];

					$reservations->save($newData);
					$id = $reservations->getInsertID();
					$planning->save($newDataPlanning);
					$id_planning = $planning->getInsertID();

					$this->addEffectuer($id, $user['ID_user']);
					$this->addPour($id, $id_planning);
					$this->addConcerner($id_planning);
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

	public function addPour($ID_reservation, $ID_planning)
	{
		$pour = new pourModel();
		$newData = [
			'ID_day' => $ID_reservation,
			'ID_planning' => $ID_planning,
		];
		$pour->save($newData);
	}

	public function addConcerner($ID_planning)
	{
		$concerner = new concernerModel();
		$chambres = new chambreModel();
		if (isset($_POST['ID_chambre'])) {
			foreach ($_POST['ID_chambre'] as $valeur) {
				$newData = [
					'ID_chambre' => $valeur,
					'ID_planning' => $ID_planning,
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
		$data['reservations'] = $reservations->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->orderBy('reservation_day.ID_day', 'desc')->findAll();
		return $data;
	}

	public function infoSupplementaireDay($ID_day)
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->where('effectuer.ID_day', $ID_day)->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->first();
		return $data;
	}

	public function infoDetails($ID_day)
	{
		$data = [];
		$reservations = new pourModel();
		// $data = $reservations->where('pour.ID_day', $ID_day)->join('planning', 'pour.ID_day = planning.ID_day')->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('chambre.ID_chambre')->first();
		// $data['details'] = $reservations->where('pour.ID_day', $ID_day)->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('chambre.ID_chambre')->findAll();
		$data['details'] = $reservations->where('pour.ID_day', $ID_day)->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('concerner.ID_chambre')->find();
		
		// $data['total'] = $reservations->select()->where('pour.ID_day', $ID_day)->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('concerner.ID_chambre')->find();
		return $data;
	}

	public function update()
	{
		$data = [];
		helper('form');

		if (isset($_POST['btn_modification'])) : {
				$rules = [
					'ID_day' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					// $users = new userModel();
					// $user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationDayModel();
					$data = [
						// 'nom_client_day' => $_POST['nom_client_day'],
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
