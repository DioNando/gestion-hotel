<?php

namespace App\Controllers;

use App\Models\clientModel;
use App\Models\cardexModel;
use App\Models\reservationNuitModel;

class Client extends BaseController
{
	public function index()
	{
		if (isset($_POST['type']) == 'update') {
			$data['info'] = $this->infoUpdate($_POST['ID_client']);
			echo view('client\updateClient', $data);
			return ($data);
		}
		if (isset($_POST['btn_validation'])) {
			$this->create();
			return redirect()->to('reservation');
		}
		if (isset($_POST['btn_modification'])) {
			$this->update();
			return redirect()->to('configClient');
		}
		if (isset($_POST['btn_suppression'])) {
			$this->delete();
			return redirect()->to('configClient');
		}
		if (isset($_POST['btn_recherche']) and $_POST['element_recherche'] != NULL) {
			$data = $this->search($_POST['element_recherche']);
			echo view('templates\header');
			echo view('client\configClient', $data);
			echo view('templates\footer');
		} else {
			$data = $this->read();
			echo view('templates\header');
			echo view('client\configClient', $data);
			echo view('templates\footer');
		}
	}

	public function create()
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
					$session->setFlashdata('success', 'Création réussie');
				}
			}
		endif;
	}

	public function read()
	{
		$data = [];
		$clients = new clientModel();
		// $data['clients'] = $clients->orderBy('ID_client', 'desc')->findAll();

		$data = [
			'clients' => $clients->orderBy('ID_client', 'desc')->paginate(20, 'paginationResult'),
			'pager' => $clients->pager,
			'total' => count($clients->findAll()),
			'total_all' => count($clients->findAll()),
		];
		return $data;
	}
	
	public function search($element_recherche)
	{
		$data = [];
		$clients = new clientModel();
		// $data['clients'] = $clients->where('nom_client', $nom_client)->find();
		
		$data = [
			'clients' => $clients->like('CONCAT(nom_client, " ", prenom_client)', $_POST['element_recherche'], 'both')->orLike('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->paginate(20, 'paginationResult'),
			'pager' => $clients->pager,
			'total' => count($clients->like('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->findAll()),
			'total_all' => count($clients->findAll()),
		];

		return $data;
	}

	public function liveSearch()
	{
		$data = [];
		$clients = new clientModel();		
		$data = [
			'clients' => $clients->like('CONCAT(nom_client, " ", prenom_client)', $_POST['element_recherche'], 'both')->orLike('nom_client', $_POST['element_recherche'], 'both')->orLike('prenom_client', $_POST['element_recherche'], 'both')->join('cardex', 'cardex.ID_client = client.ID_client')->orderby('cardex.ID_client', 'asc')->limit(10)->find(),
			// 'clients' => $clients->like('CONCAT(nom_client, " ", prenom_client)', $_POST['element_recherche'], 'both')->orLike('nom_client', $_POST['element_recherche'], 'both')->orLike('prenom_client', $_POST['element_recherche'], 'both')->join('cardex', 'cardex.ID_client = client.ID_client')->limit(5)->find(),
		];
		return json_encode($data);
	}

	public function update()
	{
		$data = [];
		helper('form');

		if (isset($_POST['btn_modification'])) : {
				$rules = [
					'nom_client' => 'required',
					'prenom_client' => 'required',
					'telephone_client' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$clients = new clientModel();
					$data = [
						'nom_client' => $_POST['nom_client'],
						'prenom_client' => $_POST['prenom_client'],
						'telephone_client' => $_POST['telephone_client'],
					];

					$clients->set($data);
					$clients->where('ID_client', $_POST['ID_client']);
					$clients->update();
					session()->set($data);
					$session = session();
					$session->setFlashdata('update', 'La ligne a été modifié avec succès');
				}
			}
		endif;
	}

	public function infoUpdate($ID_client) {
        $data = [];
		$clients = new clientModel();
        $data = $clients->where('ID_client', $ID_client)->first();
        return $data;
    }

	public function delete()
	{
		$clients = new clientModel();

		$this->deleteCascade($_POST['ID_client']);
		$clients->delete(['ID_client' => $_POST['ID_client']]);
		$session = session();
		$session->setFlashdata('delete', 'Le client a été supprimé avec succès');
	}

	public function deleteCascade($id_client)
	{
		$reservation = new reservationNuitModel();

		$sql = "DELETE reservation_nuit, pour, planning, concerner FROM reservation_nuit 
		INNER JOIN pour ON reservation_nuit.ID_nuit = pour.ID_nuit INNER JOIN planning ON pour.ID_planning = planning.ID_planning INNER JOIN concerner ON concerner.ID_planning = planning.ID_planning WHERE reservation_nuit.ID_client = ?";

		$reservation->query($sql, array($id_client));
	}

	public function addClient()
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

					$clients->save($newData);
					$dataCardex = [
						'ID_client' => $clients->getInsertID(),
					];

					$cardex->save($dataCardex);
					$session = session();
					$session->set($newData);
					$session->setFlashdata('success', 'Ajout réussie');
					return redirect()->to('configClient');
				}
			}
		endif;

		echo view('templates\header');
		echo view('client\addClient', $data);
		echo view('templates\footer');
	}
}
