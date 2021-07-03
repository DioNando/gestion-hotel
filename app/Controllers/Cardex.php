<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\reservationNuitModel;
use App\Models\cardexModel;
use App\Models\pourModel;
use App\Models\archiveModel;

class Cardex extends BaseController
{
	public function index()
	{
		if (isset($_POST['type'])) {
			if ($_POST['type'] == 'update') {
				$data['info'] = $this->infoUpdate($_POST['ID_client']);
				echo view('client/updateCardex', $data);
				return ($data);
			}
			if ($_POST['type'] == 'historique') {
				$data = [];
				$data = $this->historique($_POST['ID_client']);
				echo view('client/historique', $data);
				return ($data);
			}
		}
		if (isset($_POST['btn_modification'])) {
			$this->update();
			return redirect()->to('ficheCardex');
		}
		if (isset($_POST['ID_client'])) {
			$data['client'] = $this->ficheCardex($_POST['ID_client']);
			echo view('client/cardex', $data);
			return ($data);
		}
		if (isset($_POST['btn_recherche']) and $_POST['element_recherche'] != NULL) {
			$data = $this->search($_POST['element_recherche']);
			echo view('templates/header');
			echo view('client/ficheCardex', $data);
			echo view('templates/footer');
		} else {
			$data = $this->read();
			echo view('templates/header');
			echo view('client/ficheCardex', $data);
			echo view('templates/footer');
		}
	}

	public function read()
	{
		$data = [];
		$clients = new clientModel();
		// $data['clients'] = $clients->orderBy('ID_client', 'asc')->findAll();

		$data = [
			'clients' => $clients->join('cardex', 'cardex.ID_client = client.ID_client')->orderby('client.ID_client', 'desc')->paginate(20, 'paginationResult'),
			'pager' => $clients->pager,
			'total' => count($clients->join('cardex', 'cardex.ID_client = client.ID_client')->findAll()),
			'total_all' => count($clients->join('cardex', 'cardex.ID_client = client.ID_client')->findAll()),
			'cardex_vide' => count($clients->where('etat_cardex', 0)->join('cardex', 'cardex.ID_client = client.ID_client')->findAll()),
			'cardex_rempli' => count($clients->where('etat_cardex', 1)->join('cardex', 'cardex.ID_client = client.ID_client')->findAll()),
		];
		return $data;
	}
	
	public function search($element_recherche)
	{
		$data = [];
		$clients = new clientModel();
		// $data['clients'] = $clients->like('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->find();
		
		$data = [
			'clients' => $clients->join('cardex', 'cardex.ID_client = client.ID_client')->like('CONCAT(nom_client, " ", prenom_client)', $_POST['element_recherche'], 'both')->orLike('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->paginate(20, 'paginationResult'),
			'pager' => $clients->pager,
			'total' => count($clients->join('cardex', 'cardex.ID_client = client.ID_client')->like('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->findAll()),
			'total_all' => count($clients->join('cardex', 'cardex.ID_client = client.ID_client')->findAll()),
			'cardex_vide' => count($clients->where('etat_cardex', 0)->join('cardex', 'cardex.ID_client = client.ID_client')->findAll()),
			'cardex_rempli' => count($clients->where('etat_cardex', 1)->join('cardex', 'cardex.ID_client = client.ID_client')->findAll()),	
		];
		return $data;
	}

	public function ficheCardex($ID_client)
	{
		$data = [];
		$clients = new clientModel();
		$data = $clients->where('client.ID_client', $ID_client)->join('cardex', 'cardex.ID_client = client.ID_client')->first();
		return $data;
	}

	public function historique($ID_client)
	{
		$data = [];
		$reservations = new reservationNuitModel();
		$clients = new clientModel();
		$client = $clients->where('ID_client', $ID_client)->first();
		$data = [
			
			'infos' => $reservations->select(['*', 'DATE_FORMAT(date_reservation_nuit, "%d %b %Y") AS date_reservation_nuit', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', 'DATE_FORMAT(date_facture_nuit, "%d %b %Y à %H:%i") AS date_facture_nuit'])->where('reservation_nuit.ID_client', $ID_client)->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'client.ID_client = reservation_nuit.ID_client')->join('cardex', 'cardex.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->groupBy('reservation_nuit.ID_nuit')->findAll(),
			'chambres' => $reservations->select(['*', 'DATE_FORMAT(date_reservation_nuit, "%d %b %Y") AS date_reservation_nuit', 'DATE_FORMAT(debut_sejour, "%d %b %Y") AS debut_sejour', 'DATE_FORMAT(fin_sejour, "%d %b %Y") AS fin_sejour', 'DATE_FORMAT(date_facture_nuit, "%d %b %Y à %H:%i") AS date_facture_nuit'])->where('reservation_nuit.ID_client', $ID_client)->join('facture_nuit', 'facture_nuit.ID_nuit = reservation_nuit.ID_nuit')->join('client', 'client.ID_client = reservation_nuit.ID_client')->join('cardex', 'cardex.ID_client = client.ID_client')->join('pour', 'pour.ID_nuit = reservation_nuit.ID_nuit')->join('planning', 'pour.ID_planning = planning.ID_planning')->join('concerner', 'concerner.ID_planning = planning.ID_planning')->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = concerner.ID_archive')->groupBy('chambre.ID_chambre')->findAll(),
			'nom' => $client['nom_client'],
			'prenom' => $client['prenom_client'],
		];
			return $data;
	}

	public function update()
	{
		$data = [];
		helper('form');

		if (isset($_POST['btn_modification'])) : {
				$rules = [
					'nom_client' => 'required',
					'prenom_client' => 'required',
					'date_naissance' => 'required|valid_date',
					'lieu_naissance' => 'required',
					'pere_client' => 'required|string',
					'mere_client' => 'required|string',
					'profession' => 'required',
					'domicile_habituel' => 'required',
					'nationalite' => 'required|string',
					'piece_identite' => 'required',
					'num_piece_identite' => 'required|numeric',
					'date_delivrance' => 'required|valid_date',
					'lieu_delivrance' => 'required',
					'date_fin_validite' => 'required|valid_date',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$clients = new clientModel();
					$cardex = new cardexModel();

					$data = [
						'nom_client' => $_POST['nom_client'],
						'prenom_client' => $_POST['prenom_client'],
						'date_naissance' => $_POST['date_naissance'],
						'lieu_naissance' => $_POST['lieu_naissance'],
						'pere_client' => $_POST['pere_client'],
						'mere_client' => $_POST['mere_client'],
						'profession' => $_POST['profession'],
						'domicile_habituel' => $_POST['domicile_habituel'],
						'nationalite' => $_POST['nationalite'],
						'piece_identite' => $_POST['piece_identite'],
						'num_piece_identite' => $_POST['num_piece_identite'],
						'date_delivrance' => $_POST['date_delivrance'],
						'lieu_delivrance' => $_POST['lieu_delivrance'],
						'date_fin_validite' => $_POST['date_fin_validite'],
						'etat_cardex' => 1,
					];

					$clients->set($data);
					$clients->where('ID_client', $_POST['ID_client']);
					$clients->update();

					$cardex->set($data);
					$cardex->where('ID_client', $_POST['ID_client']);
					$cardex->update();

					session()->set($data);
					$session = session();
					$session->setFlashdata('update', 'La ligne a été modifié avec succès');
				}
			}
		endif;
	}

	public function infoUpdate($ID_client)
	{
		$data = [];
		$clients = new clientModel();
		$data = $clients->where('client.ID_client', $ID_client)->join('cardex', 'cardex.ID_client = client.ID_client')->first();
		return $data;
	}

}
