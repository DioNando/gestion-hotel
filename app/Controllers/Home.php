<?php

namespace App\Controllers;

use App\models\userModel;

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
					$user = $users->where('nom_user', $_POST['nom_user'])
						->first();

					$this->setUserSession($user);
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
		session()->destroy();
		return redirect()->to('index.php');
	}

	private function setUserSession($user)
	{
		$data = [
			'ID_user' => $user['ID_user'],
			'nom_user' => $user['nom_user'],
			'isUser' => $user['droit_user'],
			'isLoggedIn' => true,
		];
		session()->set($data);
		return;
	}
}
