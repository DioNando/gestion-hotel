<?php

namespace App\Controllers;

use App\models\userModel;

class User extends BaseController
{
    public function index()
    {

        if (isset($_POST['btn_enregistrer'])) {
            $this->create();
            return redirect()->to('addUser');
        } elseif (isset($_POST['btn_modification'])) {
            $this->update();
            return redirect()->to('configUser');
        } elseif (isset($_POST['btn_suppression'])) {
            $this->delete();
            return redirect()->to('configUser');
        } else {
            $data = $this->read();
            echo view('templates\header');
            echo view('user\configUser', $data);
            echo view('templates\footer');
        }
    }

    public function create()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_enregistrer'])) : {
                $rules = [
                    'nom_user' => 'required',
                    'mdp_user' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $users = new userModel();
                    $newData = [
                        'nom_user' => $_POST['nom_user'],
                        'droit_user' => $_POST['droit_user'],
                    ];

                    $users->set($newData);
                    $users->insert();
                    $session = session();
                    $session->setFlashdata('success', 'L\'utilisateur a été ajouté avec succès');
                }
            }
        endif;
    }

    public function addUser()
    {
        $data = [];
        helper(['form']);

        if (isset($_POST['btn_enregistrer'])) : {
                $rules = [
                    'nom_user' => 'required|min_length[1]',
                    'mdp_user' => 'required|min_length[1]',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $users = new userModel();
                    $newData = [
                        'nom_user' => $_POST['nom_user'],
                        'mdp_user' => $_POST['mdp_user'],
                        'droit_user' => $_POST['droit_user'],
                    ];

                    $users->save($newData);
                    $session = session();
                    $session->setFlashdata('success', 'Enregistrement réussie');
                    return redirect()->to('addUser');
                }
            }
        endif;

        echo view('templates/header');
        echo view('user/addUser', $data);
        echo view('templates/footer');
    }

    public function read()
    {
        $data = [];
        $users = new userModel();
        $data['users'] = $users->findAll();
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
                    $users = new userModel();
                    $data = [
                        'nom_user' => $_POST['nom_user'],
                        'prenom_user' => $_POST['prenom_user'],
                        'droit_user' => $_POST['droit_user'],
                    ];

                    $users->set($data);
                    $users->where('ID_user', $_POST['ID_user']);
                    $users->update();
                    $session = session();
                    $session->setFlashdata('update', 'La ligne a été modifié avec succès');
                }
            }
        endif;
    }

    public function delete()
    {
        $users = new userModel();
        $users->delete(['ID_user' => $_POST['ID_user']]);
        $session = session();
        $session->setFlashdata('delete', 'L\'utilisateur a été supprimé avec succès');
    }
}
