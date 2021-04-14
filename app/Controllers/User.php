<?php

namespace App\Controllers;

use App\models\userModel;

class User extends BaseController
{
    public function index()
    {

        if (isset($_POST['btn_enregistrer'])) {
            $this->create();
            return redirect()->to('configUser');
        }
        if (isset($_POST['btn_modification'])) {
            $this->update();
            return redirect()->to('configUser');
        }
        if (isset($_POST['btn_suppression'])) {
            $this->delete();
            return redirect()->to('configUser');
        }
        if (isset($_POST['btn_recherche']) and $_POST['element_recherche'] != NULL) {
            $data = $this->search($_POST['element_recherche']);
            echo view('templates\header');
            echo view('user\configUser', $data);
            echo view('templates\footer');
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

        // if (isset($_POST['type']) == 'user') {
        //     helper('form');
        //     echo view('user\addUser');
        //     return 0;
        // }

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
                        'prenom_user' => $_POST['prenom_user'],
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
                    return redirect()->to('configUser');
                }
            }
        endif;

        echo view('templates\header');
        echo view('user\addUser', $data);
        echo view('templates\footer');
    }

    public function read()
    {
        $data = [];
        $users = new userModel();
        // $data['users'] = $users->findAll();

        $data = [
            'users' => $users->paginate(10, 'paginationResult'),
            'pager' => $users->pager,
        ];

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

    public function profil()
    {
        $data = [];
        helper(['form']);
        $users = new userModel();

        if (isset($_POST['btn_modification_profil'])) : {
                $rules = [
                    'nom_user' => 'required',
                    'prenom_user' => 'required',
                ];

                if (!isset($_POST['mdp_user'])) {
                    $rules['mdp_user'] = 'required';
                    $rules['mdp_user_confirm'] = 'matches[mdp_user]';
                }

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $newData = [
                        'ID' => session()->get('ID'),
                        'nom_user' => $_POST['nom_user'],
                        'prenom_user' => $_POST['prenom_user'],
                    ];
                    session()->set($newData);

                    if ($_POST['mdp_user'] != '') {
                        $newData['mdp_user'] = $_POST['mdp_user'];
                    }

                    $users->set($newData);
                    $users->where('ID_user', session()->get('ID_user'));
                    $users->update();

                    $session = session();
                    $session->setFlashdata('success', 'Modification effectuée');
                    return redirect()->to('profil');
                }
            }
        endif;

        $data['user'] = $users->where('ID_user', session()->get('ID_user'))->first();

        echo view('templates\header', $data);
        echo view('user\profil.php');
        echo view('templates\footer');
    }

    public function search($element_recherche)
    {
        $data = [];
        $users = new userModel();
        // $data['users'] = $users->like('nom_user', $element_recherche, 'both')->orLike('prenom_user', $element_recherche, 'both')->find();
        $data = [
            'users' => $users->like('nom_user', $element_recherche, 'both')->orLike('prenom_user', $element_recherche, 'both')->paginate(10, 'paginationResult'),
            'pager' => $users->pager,
        ];
        return $data;
    }
}
