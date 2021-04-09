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

class ReservationNuit extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['infoClient'])) {
			$data['info'] = $this->infoSupplementaireNuit($_POST['ID_nuit']);
			echo view('reservation\infoReservationClient', $data);
			return ($data);
		}
		if (isset($_POST['infoNuit'])) {
			$data['info'] = $this->infoSupplementaireNuit($_POST['ID_nuit']);
			echo view('reservation\infoReservationNuit', $data);
			return ($data);
		}
		if (isset($_POST['infoDetails'])) {
			$data = $this->infoDetails($_POST['ID_nuit']);
			echo view('reservation\infoNuitDetails', $data);
			return ($data);
		}
		if (isset($_POST['updateNuit'])) {
			$data['info'] = $this->infoSupplementaireNuit($_POST['ID_nuit']);
			echo view('reservation\updateNuit', $data);
			return ($data);
		}
		if (isset($_POST['btn_modification'])) {
			$this->update();
			return redirect()->to('configReservationNuit');
		}
		if (isset($_POST['btn_suppression'])) {
			$this->delete();
			return redirect()->to('configReservationNuit');
		} else {
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
					'nom_client' => 'required|min_length[1]',
					'prenom_client' => 'required|min_length[1]',
					'telephone_client' => 'required',
					'nbr_nuit' => 'is_natural',
					'ID_chambre' => 'required',
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
					$planning = new planningModel();

					$newData = [
						'nbr_personne' => $_POST['nbr_personne'],
						// 'debut_sejour' => $_POST['debut_sejour'],
						// 'fin_sejour' => $_POST['fin_sejour'],
						'nbr_nuit' => $_POST['nbr_nuit'],
						'ID_client' => $client['ID_client'],
						'ID_etat_reservation' => $etat,
						'type_reservation' => $_POST['type_reservation'],
						'remarque_reservation' => $_POST['remarque_reservation'],
					];

					$newDataPlanning = [
						'debut_sejour' => $_POST['debut_sejour'],
						'fin_sejour' => $_POST['fin_sejour'],
						'motif' => 'Nuitée',
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
		$users = new userModel();
		$user = $users->where('ID_user', $ID_user)->first();
		$newData = [
			'ID_nuit' => $ID_reservation,
			'ID_user' => $ID_user,
			'nom_user_modif' => $user['nom_user'],
		];
		$effectuer->save($newData);
	}

	public function addEffectuerModif($ID_reservation, $nom_user)
	{
		$effectuer = new effectuerModel();
		// $users = new userModel();
		// $user = $users->where('ID_user', $ID_user)->first();
		$newData = [
			'nom_user_modif' => $nom_user,
		];

		$effectuer->set($newData);
		$effectuer->where('ID_nuit', $ID_reservation);
		$effectuer->update();
	}

	public function addPour($ID_reservation, $ID_planning)
	{
		$pour = new pourModel();
		$newData = [
			'ID_nuit' => $ID_reservation,
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
					'statut_chambre' => 'En attente',
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

		if (isset($_POST['btn_validation'])) : {
				$rules = [
					'nom_client' => 'required|min_length[1]',
					'prenom_client' => 'required|min_length[1]',
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
		$data['reservations'] = $reservations->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour'])->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->orderBy('reservation_nuit.ID_nuit', 'desc')->findAll();
		return $data;
	}

	public function infoSupplementaireNuit($ID_nuit)
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->select(['*', 'DATE_FORMAT(date_reservation_nuit, "%d %b %Y à %H:%i") AS date_reservation_nuit', 'DATE_FORMAT(date_modification_nuit, "%d %b %Y à %H:%i") AS date_modification_nuit'])->where('effectuer.ID_nuit', $ID_nuit)->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->first();
		return $data;
	}

	public function infoDetails($ID_nuit)
	{
		$data = [];
		$reservations = new pourModel();
		$data['details'] = $reservations->where('pour.ID_nuit', $ID_nuit)->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('concerner.ID_chambre')->find();
		return $data;
	}

	public function search($element_recherche)
	{
		$clients = new clientModel();
		$client = $clients->like('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->first();


		$newData = [
			'nom_client' => $client['nom_client'],
			'prenom_client' => $client['prenom_client'],
			'telephone_client' => $client['telephone_client'],
		];
		$session = session();
		$session->set($newData);
	}

	public function update()
	{
		$data = [];
		helper('form');

		if (isset($_POST['btn_modification'])) : {
				$rules = [
					'ID_nuit' => 'required',
					'nbr_nuit' => 'is_natural_no_zero',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$reservations = new reservationNuitModel();
					$pour = new pourModel();
					$planning = new planningModel();
					$data = [
						'nbr_nuit' => $_POST['nbr_nuit'],
						'debut_sejour' => $_POST['debut_sejour'],
						'fin_sejour' => $_POST['fin_sejour'],
					];

					$id_planning = $pour->where('ID_nuit', $_POST['ID_nuit'])->first();

					$reservations->set($data);
					$planning->set($data);

					$reservations->where('ID_nuit', $_POST['ID_nuit']);
					$planning->where('ID_planning', $id_planning['ID_planning']);

					$reservations->update();
					$planning->update();

					$this->addEffectuerModif($_POST['ID_nuit'], $_POST['nom_user']);
					$session = session();
					$session->setFlashdata('update', 'La ligne a été modifié avec succès');
				}
			}
		endif;
	}

	public function delete()
	{
		$reservation = new reservationNuitModel();
		$reservation->delete(['ID_nuit' => $_POST['ID_nuit']]);
		$session = session();
		$session->setFlashdata('delete', 'La réservation a été supprimé avec succès');
	}
}
