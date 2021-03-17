<?php

namespace App\Controllers;

use App\models\clientModel;

class Client extends BaseController
{
	public function index()
	{
		if(isset($_POST['btn_reservation'])) {
            $this->create();
            return redirect()->to('reservation');
        }
        
        elseif(isset($_POST['btn_modification'])) {
            $this->update();
            return redirect()->to('#');
        }
        
        elseif(isset($_POST['btn_suppression'])) {
            $this->delete();
            return redirect()->to('#');
        }

        else {      
            echo view('templates\header');
            echo view('client\reservation');
            echo view('templates\footer');
        }
	}

	public function create()
	{
		if(isset($_POST['btn_reservation'])) : {
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

	public function update()
	{

	}

	public function delete()
	{

	}
}
