<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\connexionModel;

class Home extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);
		
		if(isset($_POST['btn_connexion'])) : {
				$rules = [
					'nom_user' => 'required',
					'mdp_user' => 'required|validateUser[nom_user,mdp_user]',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$connexion = new connexionModel();

					// $user = $users->where('nom_user', $_POST['nom_user'])
					// 	->first();

						$user = $users->like('CONCAT(nom_user, " ", prenom_user)', $_POST['nom_user'], 'both')->orLike('nom_user', $_POST['nom_user'], 'both')->orLike('prenom_user', $_POST['nom_user'], 'both')->first();

					
					$data = [
						'ID_user' => $user['ID_user'],
						'etat_connexion' => 1,
						'date_connexion' => date("Y-m-d H:i:s"),
					];

					$connexion->save($data);
					$id_connexion = $connexion->getInsertID();

					$this->setUserSession($user, $id_connexion);
					return redirect()->to('dashboard');
				}
			}
		endif;

		echo view('templates/header');
		echo view('login/login', $data);
		echo view('templates/footer');
	}

	public function logout()
	{
		$connexion = new connexionModel();

		$data = [
			'etat_connexion' => 0,
			'date_deconnexion' => date("Y-m-d H:i:s"),
		];
		$connexion->set($data);
		$connexion->where('ID_connexion', session()->get('ID_connexion'));
		$connexion->update();
		
		session()->destroy();
		return redirect()->to('index.php');
	}

	private function setUserSession($user, $id_connexion)
	{
		$data = [
			'ID_connexion' => $id_connexion,
			'ID_user' => $user['ID_user'],
			'nom_user' => $user['nom_user'],
			'prenom_user' => $user['prenom_user'],
			'isUser' => $user['droit_user'],
			'isLoggedIn' => true,
		];
		session()->set($data);
		return;
	}
}
