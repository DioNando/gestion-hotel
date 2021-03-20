<?php

namespace App\Controllers;

use App\models\userModel;

class Admin extends BaseController
{
    public function index()
    {   
        if(isset($_POST['btn_modification'])) {
            $this->update();
            return redirect()->to('configAdmin');
        }
        
        elseif(isset($_POST['btn_suppression'])) {
            $this->delete();
            return redirect()->to('configAdmin');
        }

        else {      
            $data = $this->read();
            echo view('templates\header');
            echo view('admin\configAdmin', $data);
            echo view('templates\footer');
        }
    }

    public function read()
    {
        $data = [];
        $admins = new userModel();
        $data['admins'] = $admins->where('droit_user', 'administrateur')
        ->findAll();
        return $data;
    }

    public function update()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_modification'])) : {
                $rules = [
                    'nom_user' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $admins = new userModel();
                    $data = [
                        'nom_user' => $_POST['nom_user'],                    ];

                    $admins->set($data);
                    $admins->where('ID_user', $_POST['ID_user']);
                    $admins->update();
                    $session = session();
					$session->setFlashdata('update', 'La ligne a été modifié avec succès');
                }
            }
        endif;
    }

    public function delete()
    {
        $admins = new userModel();
		$admins->delete(['ID_user' => $_POST['ID_user']]);
        $session = session();
		$session->setFlashdata('delete', 'L\'administrateur a été supprimé avec succès');
    }
}
