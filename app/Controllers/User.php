<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\reservationNuitModel;
use App\Models\reservationDayModel;

class User extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if (isset($_POST['type']) == 'update') {
            $data['info'] = $this->infoUpdate($_POST['ID_user']);
            echo view('user/updateUser', $data);
            return ($data);
        }
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
            echo view('templates/header');
            echo view('user/configUser', $data);
            echo view('templates/footer');
        } else {
            $data = $this->read();
            echo view('templates/header');
            echo view('user/configUser', $data);
            echo view('templates/footer');
        }
    }

    public function create()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_enregistrer'])) : {
                $rules = [
                    'nom_user' => 'required',
                    'prenom_user' => 'required',
                    'mdp_user' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $users = new userModel();
                    $newData = [
                        'nom_user' => $_POST['nom_user'],
                        'prenom_user' => $_POST['prenom_user'],
                        'mdp_user' => $_POST['mdp_user'],
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
                    'prenom_user' => 'required|min_length[1]',
                    'mdp_user' => 'required|min_length[1]',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $users = new userModel();
                    $newData = [
                        'nom_user' => $_POST['nom_user'],
                        'prenom_user' => $_POST['prenom_user'],
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

        echo view('templates/header');
        echo view('user/addUser', $data);
        echo view('templates/footer');
    }

    public function read()
    {
        $data = [];
        $users = new userModel();
        // $data['users'] = $users->findAll();

        $data = [
            'users' => $users->paginate(10, 'paginationResult'),
            'pager' => $users->pager,
            'total' => count($users->findAll()),
            'total_all' => count($users->findAll()),
            'administrateur' => count($users->where('droit_user', 'Administrateur')->findAll()),
            'controleur' => count($users->where('droit_user', 'Contrôleur')->findAll()),
            'utilisateur' => count($users->where('droit_user', 'Utilisateur')->findAll()),
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
                    'prenom_user' => 'required',
                ];

                if (!isset($_POST['mdp_user'])) {
                    $rules['mdp_user'] = 'required';
                    $rules['mdp_user_confirm'] = 'matches[mdp_user]';
                }

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $users = new userModel();

                    $newData = [
                        'nom_user' => $_POST['nom_user'],
                        'prenom_user' => $_POST['prenom_user'],
                        'droit_user' => $_POST['droit_user'],
                    ];

                    if ($_POST['mdp_user'] != '') {
                        $newData['mdp_user'] = $_POST['mdp_user'];
                    }

                    $users->set($newData);
                    $users->where('ID_user', $_POST['ID_user']);
                    $users->update();

                    $session = session();
                    $session->setFlashdata('success', 'La ligne a été modifié avec succès');
                    return redirect()->to('profil');
                }
            }
        endif;

        // if (isset($_POST['btn_modification'])) : {
        //         $rules = [
        //             'nom_user' => 'required',
        //         ];

        //         if (!$this->validate($rules)) {
        //             $data['validation'] = $this->validator;
        //         } else {
        //             $users = new userModel();
        //             $data = [
        //                 'nom_user' => $_POST['nom_user'],
        //                 'prenom_user' => $_POST['prenom_user'],
        //                 'droit_user' => $_POST['droit_user'],
        //             ];

        //             $users->set($data);
        //             $users->where('ID_user', $_POST['ID_user']);
        //             $users->update();
        //             $session = session();
        //             $session->setFlashdata('update', 'La ligne a été modifié avec succès');
        //         }
        //     }
        // endif;
    }

    public function infoUpdate($ID_user)
    {
        $data = [];
        $users = new userModel();
        $data = $users->where('ID_user', $ID_user)->first();
        return $data;
    }

    public function delete()
    {
        $users = new userModel();

        $this->deleteCascadeNuit($_POST['ID_user']);
        $this->deleteCascadeDay($_POST['ID_user']);
        $users->delete(['ID_user' => $_POST['ID_user']]);
        $session = session();
        $session->setFlashdata('delete', 'L\'utilisateur a été supprimé avec succès');
    }

    public function deleteCascadeNuit($id_user)
    {
        $reservation = new reservationNuitModel();

        $sql = "DELETE reservation_nuit, effectuer, pour, planning, concerner FROM reservation_nuit 
		INNER JOIN effectuer ON effectuer.ID_nuit = reservation_nuit.ID_nuit INNER JOIN pour ON reservation_nuit.ID_nuit = pour.ID_nuit INNER JOIN planning ON pour.ID_planning = planning.ID_planning INNER JOIN concerner ON concerner.ID_planning = planning.ID_planning WHERE effectuer.ID_user = ?";

        $reservation->query($sql, array($id_user));
    }

    public function deleteCascadeDay($id_user)
    {
        $reservation = new reservationDayModel();

        $sql = "DELETE reservation_day, effectuer, pour, planning, concerner FROM reservation_day 
		INNER JOIN effectuer ON effectuer.ID_day = reservation_day.ID_day INNER JOIN pour ON reservation_day.ID_day = pour.ID_day INNER JOIN planning ON pour.ID_planning = planning.ID_planning INNER JOIN concerner ON concerner.ID_planning = planning.ID_planning WHERE effectuer.ID_user = ?";

        $reservation->query($sql, array($id_user));
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

        echo view('templates/header', $data);
        echo view('user/profil.php');
        echo view('templates/footer');
    }

    public function search($element_recherche)
    {
        $data = [];
        $users = new userModel();
        // $data['users'] = $users->like('nom_user', $element_recherche, 'both')->orLike('prenom_user', $element_recherche, 'both')->find();
        $data = [
            'users' => $users->like('nom_user', $element_recherche, 'both')->orLike('prenom_user', $element_recherche, 'both')->paginate(10, 'paginationResult'),
            'pager' => $users->pager,
            'total' => count($users->like('nom_user', $element_recherche, 'both')->orLike('prenom_user', $element_recherche, 'both')->findAll()),
            'total_all' => count($users->findAll()),
            'administrateur' => count($users->where('droit_user', 'Administrateur')->findAll()),
            'controleur' => count($users->where('droit_user', 'Contrôleur')->findAll()),
            'utilisateur' => count($users->where('droit_user', 'Utilisateur')->findAll()),
        ];
        return $data;
    }
}
