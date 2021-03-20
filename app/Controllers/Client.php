<?php

namespace App\Controllers;

use App\models\clientModel;

class Client extends BaseController
{
	public function index()
	{
		if (isset($_POST['btn_reservation'])) {
			$this->create();
			return redirect()->to('reservation');
		} elseif (isset($_POST['btn_modification'])) {
			$this->update();
			return redirect()->to('configClient');
		} elseif (isset($_POST['btn_suppression'])) {
			$this->delete();
			return redirect()->to('configClient');
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
					];

					$clients->save($newData);
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
		$data['clients'] = $clients->orderBy('ID_client', 'desc')->findAll();
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
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$clients = new clientModel();
					$data = [
						'nom_client' => $_POST['nom_client'],
						'prenom_client' => $_POST['prenom_client'],
					];

					$clients->set($data);
					$clients->where('ID_client', $_POST['ID_client']);
					$clients->update();
					$session = session();
					$session->setFlashdata('update', 'La ligne a été modifié avec succès');
				}
			}
		endif;
	}

	public function delete()
	{
		$clients = new clientModel();
		$clients->delete(['ID_client' => $_POST['ID_client']]);
		$session = session();
		$session->setFlashdata('delete', 'Le client a été supprimé avec succès');
	}
}

	/*public function reservation()
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
					];

					$clients->save($newData);
					$session = session();
					$session->setFlashdata('success', 'Réservation réussie');
					return redirect()->to('reservation');
				}
			}
		endif;

		echo view('templates\header');
		echo view('client\reservation', $data);
		echo view('templates\footer');
	}*/
