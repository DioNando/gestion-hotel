<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\userModel;
use App\Models\chambreModel;
use App\Models\reservationNuitModel;
use App\Models\reservationDayModel;
use App\Models\concernerModel;
use App\Models\effectuerModel;
use App\Models\factureNuitModel;
use App\Models\factureDayModel;
use App\Models\planningModel;
use App\Models\archiveModel;
use App\Models\pourModel;
use App\Models\relierModel;

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
			$data = $this->infoDetails($_POST['ID_day']);
			$factures = new factureDayModel();
			$reservation = new reservationDayModel();
			$data['info'] = $reservation->where('reservation_day.ID_day', $_POST['ID_day'])->join('effectuer', 'effectuer.ID_day = reservation_day.ID_day')->join('user', 'effectuer.ID_user = user.ID_user')->first();
			$data['facture'] = $factures->select(['*', 'CONVERT(date_facture_day, DATE) AS date_facture_day'])->where('ID_day', $_POST['ID_day'])->first();
			echo view('reservation\infoDayDetails', $data);
			return ($data);
		}
		if (isset($_POST['updateDay'])) {

			$archives = new archiveModel();
			$relier = new relierModel();
			$reservationDay = new pourModel();
			$archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();


			$data['info'] = $this->infoSupplementaireDay($_POST['ID_day']);
			// $data['chambres'] = $this->infoDetails($_POST['ID_day']);
			$data['chambres'] = $reservationDay->where('ID_day', $_POST['ID_day'])->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->find();
			$data['listeChambres'] = $relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll();
		
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
					'heure_depart' => 'valid_date',
					'heure_arrive' => 'valid_date',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$user = $users->where('nom_user', $_POST['nom_user'])->first();
					$reservations = new reservationDayModel();
					$planning = new planningModel();
					$archives = new archiveModel();
					$archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();
					$facture = new factureDayModel();

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

					$newDataFacture = [
						'ID_day' => $id,
						'type_payement_day' => 'Autre',
					];

					$facture->save($newDataFacture);
					$id_facture = $facture->getInsertID();

					$newData = [
						'nom_client_day' => $_POST['nom_client_day'],
						'date_day' => $_POST['date_day'],
						'duree_day' => $_POST['duree_day'],
						'ID_user' => $user['ID_user'],
						'ID_day' => $id,
						'ID_planning' => $id_planning,
						'ID_archive' => $archive['ID_archive'],
						'ID_facture_day' => $id_facture,
					];

					$this->addEffectuer($id, $user['ID_user']);
					$this->addPour($id, $id_planning);
					$this->addConcerner($id_planning, $archive['ID_archive']);

					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Réservation réussie');
					// return redirect()->to('reservationDay');
					return redirect()->to('configReservationDay');
				}
			}
		endif;

		$chambres = new relierModel();
		$archives = new archiveModel();
		$archive = $archives->orderBy('ID_archive', 'desc')->first();

		$data['chambres'] = $chambres->select([
			'*', '(CASE 
			WHEN tarif_chambre < 5000 THEN "1"
			WHEN tarif_chambre >= 5000 AND tarif_chambre < 10000 THEN "2"
			WHEN tarif_chambre >= 10000 AND tarif_chambre < 20000 THEN "3"
			WHEN tarif_chambre >= 20000 THEN "4"
			END) AS prix'

		])->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll();
		echo view('templates\header');
		echo view('reservation\day', $data);
		echo view('templates\footer');
	}

	public function addEffectuer($ID_reservation, $ID_user)
	{
		$effectuer = new effectuerModel();
		$users = new userModel();
		$user = $users->where('ID_user', $ID_user)->first();
		$newData = [
			'ID_user' => $ID_user,
			'ID_day' => $ID_reservation,
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
		$effectuer->where('ID_day', $ID_reservation);
		$effectuer->update();
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

	public function addConcerner($ID_planning, $ID_archive)
	{
		$concerner = new concernerModel();
		$chambres = new chambreModel();
		if (isset($_POST['ID_chambre'])) {
			foreach ($_POST['ID_chambre'] as $valeur) {
				$newData = [
					'ID_planning' => $ID_planning,
					'ID_archive' => $ID_archive,
					'ID_chambre' => $valeur,
					'statut_chambre' => 'En attente',
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
		// $data['reservations'] = $reservations->select(['*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart'])->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->orderBy('reservation_day.ID_day', 'desc')->findAll();
		// $data['total'] = count($data['reservations']);

		$data = [
			'reservations' => $reservations->select([
				'*', 'DATE_FORMAT(heure_arrive, "%H:%i") AS heure_arrive', 'DATE_FORMAT(heure_depart, "%H:%i") AS heure_depart',
				'(CASE 
					WHEN heure_depart > NOW() AND heure_arrive > NOW() AND debut_sejour = CURDATE() THEN "1"
					WHEN heure_depart >= NOW() AND heure_arrive < NOW() AND debut_sejour = CURDATE() OR (heure_depart < heure_arrive AND debut_sejour = CURDATE()) THEN "2"
					WHEN fin_sejour < CURDATE() OR heure_arrive < NOW() THEN "3"
				END) AS etat'
			])
				->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->orderBy('reservation_day.ID_day', 'desc')->paginate(20, 'paginationResult'),
			'pager' => $reservations->pager,
			'total' => count($reservations->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->findAll()),
			'total_all' => count($reservations->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->findAll()),
			'enAttente' => count($reservations->where('heure_depart > NOW() AND heure_arrive > NOW()')->where('debut_sejour = CURDATE()')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll()),
			'enCours' => count($reservations->where('heure_depart >= NOW() AND heure_arrive < NOW()')->where('debut_sejour = CURDATE()')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll()),
			'termine' => count($reservations->where('fin_sejour < CURDATE() OR heure_arrive < NOW()')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll()),
		];

		return $data;
	}

	public function infoSupplementaireDay($ID_day)
	{
		$data = [];
		$reservations = new effectuerModel();
		$data = $reservations->select(['*', 'DATE_FORMAT(date_reservation_day, "%d %b %Y à %H:%i") AS date_reservation_day', 'DATE_FORMAT(date_modification_day, "%d %b %Y à %H:%i") AS date_modification_day'])->where('effectuer.ID_day', $ID_day)->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_day', 'effectuer.ID_day = reservation_day.ID_day')->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->first();
		return $data;
	}

	public function infoDetails($ID_day)
	{
		$data = [];
		$reservations = new pourModel();
		// $day = new reservationDayModel();
		// $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();
		$archive = $reservations->where('pour.ID_day', $ID_day)->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->first();
		$data['details'] = $reservations->select(['*', 'DATE_FORMAT(date_facture_day, "%d %b %Y à %H:%i") AS date_facture_day'])->where('pour.ID_day', $ID_day)->join('reservation_day', 'pour.ID_day = reservation_day.ID_day')->join('facture_day', 'facture_day.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->find();
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
					'duree_day' => 'required|is_natural_no_zero',
					'chambre_avant' => 'differs[chambre_apres]|permit_empty',
					'chambre_apres' => 'differs[chambre_avant]|permit_empty|is_unique[concerner.ID_chambre]',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$reservations = new reservationDayModel();
					$pour = new pourModel();
					$planning = new planningModel();
					$data = [
						'duree_day' => $_POST['duree_day'],
						'heure_arrive' => $_POST['heure_arrive'],
						'heure_depart' => $_POST['heure_depart'],
						'commentaire_day' => $_POST['commentaire_day'],
					];

					$id_planning = $pour->where('ID_day', $_POST['ID_day'])->first();

					if($_POST['chambre_avant'] != '' && $_POST['chambre_apres'] != '') {
						$concerner = new concernerModel();
						$transfert = [
							'ID_chambre' => $_POST['chambre_apres'],
						];
						$concerner->set($transfert);
						$concerner->where('ID_chambre', $_POST['chambre_avant'])->where('ID_planning', $id_planning['ID_planning']);
						$concerner->update();
					};

					$reservations->set($data);
					$planning->set($data);

					$reservations->where('ID_day', $_POST['ID_day']);
					$planning->where('ID_planning', $id_planning['ID_planning']);

					$reservations->update();
					$planning->update();

					$this->addEffectuerModif($_POST['ID_day'], $_POST['nom_user']);
					$session = session();
					$session->setFlashdata('update', 'La ligne a été modifié avec succès');
				}
			}
		endif;
	}

	public function delete()
	{
		$reservation = new reservationDayModel();
		// $reservation->delete(['ID_day' => $_POST['ID_day']]);
		// $reservation->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->delete(['ID_day' => $_POST['ID_day']]);
		// $reservation->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->delete(['reservation', 'pour', 'planning', 'concerner']);

		// $reservation = $reservation->join('pour', 'pour.ID_day = reservation_day.ID_day')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->find();
		// $reservation->delete(['ID_day' => $_POST['ID_day']]);
		// $pour->delete(['ID_day' => $reservation['ID_day']]);
		// $planning->delete(['ID_planning' => $reservation['ID_planning']]);
		// $concerner->delete(['ID_planning' => $reservation['ID_planning']]);

		$sql = "DELETE reservation_day, pour, planning, concerner, effectuer FROM reservation_day 
		INNER JOIN effectuer ON reservation_day.ID_day = effectuer.ID_day INNER JOIN pour ON reservation_day.ID_day = pour.ID_day INNER JOIN planning ON pour.ID_planning = planning.ID_planning INNER JOIN concerner ON concerner.ID_planning = planning.ID_planning WHERE reservation_day.ID_day = ?";

		$reservation->query($sql, array($_POST['ID_day']));

		$session = session();
		$session->setFlashdata('delete', 'La réservation a été supprimé avec succès');
	}
}
