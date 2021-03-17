<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\adminModel;

class Home extends BaseController
{
	public function index()
	{
		if ($this->request->getMethod() == 'post') : {
				$rules = [
					'nom_client' => 'required',
					'mdp_client' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new clientModel();
					$user = $users->where('nom_client', $this->request->getVar('nom_client'))
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
		if ($this->request->getMethod() == 'post') : {
				$rules = [
					'nom_admin' => 'required',
					'mdp_admin' => 'required',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$admins = new adminModel();
					$admin = $admins->where('nom_admin', $this->request->getVar('nom_admin'))
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
		if ($this->request->getMethod() == 'post') : {
				$rules = [
					'nom_client' => 'required|min_length[3]|max_length[30]',
					'mdp_client' => 'required|min_length[4]|max_length[255]',
				];

				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$users = new clientModel();
					$newData = [
						'nom_client' => $this->request->getVar('nom_client'),
						'mdp_client' => $this->request->getVar('mdp_client'),
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
			'ID_client' => $user['ID_client'],
			'nom_client' => $user['nom_client'],
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
