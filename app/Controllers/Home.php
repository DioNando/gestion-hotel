<?php

namespace App\Controllers;

use App\models\userModel;
use App\models\adminModel;

class Home extends BaseController
{
	public function index()
	{
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
		echo view('login/login');
		echo view('templates/footer');
	}

	public function loginAdmin()
	{
		if(isset($_POST['btn_connexion'])) : {
				$rules = [
					'nom_admin' => 'required',
					'mdp_admin' => 'required|validateAdmin[nom_admin,mdp_admin]',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$admins = new adminModel();
					$admin = $admins->where('nom_admin', $_POST['nom_admin'])
						->first();

					$this->setAdminSession($admin);
					return redirect()->to('dashboard');
				}
			}
		endif;

		echo view('templates/header');
		echo view('login/loginAdmin');
		echo view('templates/footer');
	}

	public function register()
	{
		if(isset($_POST['btn_enregistrer'])) : {
				$rules = [
					'nom_user' => 'required|min_length[3]|max_length[30]',
					'mdp_user' => 'required|min_length[4]|max_length[255]',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new userModel();
					$newData = [
						'nom_user' => $_POST['nom_user'],
						'mdp_user' => $_POST['mdp_user'],
					];

					$users->save($newData);
					$session = session();
					$session->setFlashdata('success', 'Enregistrement réussie');
					return redirect()->to('register');
				}
			}
		endif;

		echo view('templates/header');
		echo view('login/register');
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
			'isUser' => true,
			'isLoggedIn' => true,
		];
		session()->set($data);
		return;
	}
	
	private function setAdminSession($admin)
	{
		$data = [
			'ID_admin' => $admin['ID_admin'],
			'nom_admin' => $admin['nom_admin'],
			'isAdmin' => true,
			'isLoggedIn' => true,
		];
		session()->set($data);
		return;
	}
}
