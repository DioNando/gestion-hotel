<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\cardexModel;
use App\Models\userModel;
use App\Models\chambreModel;
use App\Models\reservationNuitModel;
use App\Models\reservationDayModel;
use App\Models\concernerModel;
use App\Models\effectuerModel;
use App\Models\planningModel;
use App\Models\archiveModel;
use App\Models\pourModel;
use App\Models\factureNuitModel;
use App\Models\historiqueModel;
use App\Models\stockerModel;
use App\Models\relierModel;

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
			$data['chambres'] = $this->infoDetails($_POST['ID_nuit']);
			echo view('reservation\infoReservationNuit', $data);
			return ($data);
		}
		if (isset($_POST['infoDetails'])) {
			$data['details'] = $this->infoDetails($_POST['ID_nuit']);
			$factures = new factureNuitModel();
			$reservation = new reservationNuitModel();
			$data['info'] = $reservation->where('reservation_nuit.ID_nuit', $_POST['ID_nuit'])->join('client', 'client.ID_client = reservation_nuit.ID_client')->join('effectuer', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('user', 'effectuer.ID_user = user.ID_user')->first();
			$data['facture'] = $factures->select(['*', 'CONVERT(date_facture_nuit, DATE) AS date_facture_nuit'])->where('ID_nuit', $_POST['ID_nuit'])->first();
			echo view('reservation\infoNuitDetails', $data);
			return ($data);
		}
		if (isset($_POST['updateNuit'])) {

			$archives = new archiveModel();
			$relier = new relierModel();
			$archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

			$data['info'] = $this->infoSupplementaireNuit($_POST['ID_nuit']);
			$data['chambres'] = $this->infoDetails($_POST['ID_nuit']);
			$data['listeChambres'] = $relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll();
			
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
					// 'telephone_client' => 'required',
					'nbr_nuit' => 'is_natural_no_zero',
					'ID_chambre' => 'required',
					'debut_sejour' => 'valid_date',
					'fin_sejour' => 'valid_date',
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

					// $historique = new historiqueModel();
					$reservations = new reservationNuitModel();
					$planning = new planningModel();
					$archives = new archiveModel();
					$archive = $archives->orderBy('ID_archive', 'desc')->first();
					$facture = new factureNuitModel();

					$newData = [
						'nbr_personne' => $_POST['nbr_personne'],
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

					// $dataHistorique = [
					// 	'ID_client' => $client['ID_client'],
					// 	'ID_nuit' => $id,
					// ];

					// $historique->insert($dataHistorique);

					$newDataFacture = [
						'offert' => $_POST['offert_sejour'],
						'remise' => $_POST['remise'],
						'ID_nuit' => $id,
						'type_payement_nuit' => 'Autre',
					];

					$facture->save($newDataFacture);
					$id_facture = $facture->getInsertID();

					$newData = [
						'nbr_personne' => $_POST['nbr_personne'],
						'nbr_nuit' => $_POST['nbr_nuit'],
						'ID_client' => $client['ID_client'],
						'ID_etat_reservation' => $etat,
						'type_reservation' => $_POST['type_reservation'],
						'remarque_reservation' => $_POST['remarque_reservation'],
						'offert' => $_POST['offert_sejour'],
						'remise' => $_POST['remise'],
						'ID_nuit' => $id,
						'ID_planning' => $id_planning,
						'ID_facture_nuit' => $id_facture,
						'ID_archive' => $archive['ID_archive'],
					];

					$this->addEffectuer($id, $user['ID_user']);
					// $this->addStocker($client['ID_client'], $id);
					$this->addPour($id, $id_planning);
					$this->addConcerner($id_planning, $archive['ID_archive']);

					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Réservation réussie');
					// return redirect()->to('reservationNuit');
					return redirect()->to('configReservationNuit');
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

	// public function addStocker($ID_client, $ID_reservation)
	// {
	// 	$historique = new historiqueModel();
	// 	$stocker = new stockerModel();
	// 	$chambres = new chambreModel();

	// 	foreach ($_POST['ID_chambre'] as $valeur) {
	// 		$chambre = $chambres->where('ID_chambre', $valeur)->first();
	// 		$newHistorique = [
	// 			'ID_chambre_ancien' => $chambre['ID_chambre'],
	// 			'tarif_chambre_ancien' => $chambre['tarif_chambre'],
	// 		];
	// 		$historique->save($newHistorique);

	// 		$ID_historique = $historique->getInsertID();

	// 		$newData = [
	// 			'ID_historique' => $ID_historique,
	// 			'ID_client' => $ID_client,
	// 			'ID_reservation' => $ID_reservation,
	// 		];

	// 		$stocker->save($newData);
	// 	}
	// }

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

	public function accueilClient()
	{
		$data = [];
		helper(['form']);

		if (isset($_POST['btn_validation'])) : {
				$rules = [
					'nom_client' => 'required|min_length[1]',
					'prenom_client' => 'required|min_length[1]',
					'telephone_client' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$clients = new clientModel();
					$cardex = new cardexModel();
					$newData = [
						'nom_client' => $_POST['nom_client'],
						'prenom_client' => $_POST['prenom_client'],
						'telephone_client' => $_POST['telephone_client'],
					];

					$clients->save($newData);

					$dataCardex = [
						'ID_client' => $clients->getInsertID(),
					];

					$cardex->save($dataCardex);
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
		// $data['reservations'] = $reservations->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour'])->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->orderBy('reservation_nuit.ID_nuit', 'desc')->findAll();
		// $data['total'] = count($data['reservations']);

		$data = [
			'reservations' => $reservations->select([
				'*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour',
				'(CASE 
					WHEN debut_sejour > CURDATE() AND fin_sejour > CURDATE() THEN "1"
					WHEN fin_sejour >= CURDATE() AND debut_sejour < CURDATE() + 1 THEN "2"
					WHEN fin_sejour < CURDATE() THEN "3"
				END) AS etat'

			])->join('user', 'effectuer.ID_user = user.ID_user')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')->join('client', 'reservation_nuit.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->orderBy('reservation_nuit.ID_nuit', 'desc')->paginate(20, 'paginationResult'),
			'pager' => $reservations->pager,
			'total' => count($reservations->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->findAll()),
			'total_all' => count($reservations->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->findAll()),
			'enAttente' => count($reservations->where('debut_sejour > CURDATE() AND fin_sejour > CURDATE()')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll()),
			'enCours' => count($reservations->where('fin_sejour >= CURDATE() AND debut_sejour < CURDATE() + 1')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll()),
			'termine' => count($reservations->where('fin_sejour < CURDATE()')->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->findAll()),
		];


		return $data;
	}

	public function infoSupplementaireNuit($ID_nuit)
	{
		$data = [];
		$reservations = new effectuerModel();

		$data = $reservations
			->select(['*', 'DATE_FORMAT(date_reservation_nuit, "%d %b %Y à %H:%i") AS date_reservation_nuit', 'DATE_FORMAT(date_modification_nuit, "%d %b %Y à %H:%i") AS date_modification_nuit'])
			->where('effectuer.ID_nuit', $ID_nuit)->join('user', 'effectuer.ID_user = user.ID_user')
			->join('reservation_nuit', 'effectuer.ID_nuit = reservation_nuit.ID_nuit')
			->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')
			->join('client', 'reservation_nuit.ID_client = client.ID_client')
			->join('cardex', 'cardex.ID_client = client.ID_client')
			->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')
			->join('planning', 'pour.ID_planning = planning.ID_planning')->first();
		return $data;
	}

	public function infoDetails($ID_nuit)
	{
		$data = [];
		$reservations = new pourModel();
		// $archives = new archiveModel();
		// $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

		$archive = $reservations->where('pour.ID_nuit', $ID_nuit)->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->first();

		$data = $reservations->select(['*', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', 'DATE_FORMAT(date_facture_nuit, "%d %b %Y à %H:%i") AS date_facture_nuit'])->where('pour.ID_nuit', $ID_nuit)->join('reservation_nuit', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('etat', 'etat.ID_etat_reservation = reservation_nuit.ID_etat_reservation')->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->find();
		return $data;
	}

	public function search($element_recherche)
	{
		$clients = new clientModel();
		$client = $clients->like('CONCAT(nom_client, " ", prenom_client)', $element_recherche, 'both')->orLike('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->join('cardex', 'cardex.ID_client = client.ID_client')->orderby('cardex.ID_client', 'asc')->first();


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
					'chambre_avant' => 'differs[chambre_apres]|permit_empty',
					'chambre_apres' => 'differs[chambre_avant]|permit_empty|is_unique[concerner.ID_chambre]',
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
						'ID_etat_reservation' => $this->etat($_POST['etat_client'], $_POST['confirmation_reservation']),
						'commentaire_nuit' => $_POST['commentaire_nuit'],
						'venant_de' => $_POST['venant_de'],
						'allant_a' => $_POST['allant_a'],
						'mode_transport' => $_POST['mode_transport'],
					];

					$id_planning = $pour->where('ID_nuit', $_POST['ID_nuit'])->first();

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
		// $reservation->delete(['ID_nuit' => $_POST['ID_nuit']]);

		$sql = "DELETE reservation_nuit, pour, planning, concerner, effectuer FROM reservation_nuit 
		INNER JOIN effectuer ON reservation_nuit.ID_nuit = effectuer.ID_nuit INNER JOIN pour ON reservation_nuit.ID_nuit = pour.ID_nuit INNER JOIN planning ON pour.ID_planning = planning.ID_planning INNER JOIN concerner ON concerner.ID_planning = planning.ID_planning WHERE reservation_nuit.ID_nuit = ?";

		$reservation->query($sql, array($_POST['ID_nuit']));

		$session = session();
		$session->setFlashdata('delete', 'La réservation a été supprimé avec succès');
	}

	private function etat($etat_client, $confirmation_reservation)
	{
		if ($etat_client == 1 and $confirmation_reservation == 1) return 1;
		if ($etat_client == 0 and $confirmation_reservation == 1) return 2;
		if ($etat_client == 0 and $confirmation_reservation == 0) return 3;
		if ($etat_client == 1 and $confirmation_reservation == 0) return 4;
	}
}
