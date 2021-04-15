<?php

namespace App\Controllers;

use App\models\clientModel;

class Cardex extends BaseController
{
	public function index()
	{			
		if (isset($_POST['type']) == 'update') {
			$data['info'] = $this->infoUpdate($_POST['ID_client']);
			echo view('client\updateCardex', $data);
			return ($data);
		}
		if (isset($_POST['btn_modification'])) {
			$this->update();
			return redirect()->to('ficheCardex');
		}
		if (isset($_POST['btn_recherche']) and $_POST['element_recherche'] != NULL) {
			$data = $this->search($_POST['element_recherche']);
			echo view('templates\header');
			echo view('client\ficheCardex', $data);
			echo view('templates\footer');
		} 
		if (isset($_POST['ID_client'])) {
			$data['client'] = $this->ficheCardex($_POST['ID_client']);
			echo view('client\Cardex', $data);
			return ($data);
		}
		else {
			$data = $this->read();
			echo view('templates\header');
			echo view('client\ficheCardex', $data);
			echo view('templates\footer');
		}
	}

	public function read()
	{
		$data = [];
		$clients = new clientModel();
		// $data['clients'] = $clients->orderBy('ID_client', 'asc')->findAll();

		$data = [
            'clients' => $clients->paginate(20, 'paginationResult'),
            'pager' => $clients->pager,
        ];
		return $data;
	}

	public function search($element_recherche)
	{
		$data = [];
		$clients = new clientModel();
		// $data['clients'] = $clients->like('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->find();

		$data = [
            'clients' => $clients->like('nom_client', $element_recherche, 'both')->orLike('prenom_client', $element_recherche, 'both')->paginate(20, 'paginationResult'),
            'pager' => $clients->pager,
        ];
		return $data;
	}

	public function ficheCardex($ID_client)
	{
		$data = [];
		$clients = new clientModel();
		$data = $clients->where('ID_client', $ID_client)->first();
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
						// 'telephone_client' => $_POST['telephone_client'],
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
}
