<?php

namespace App\Controllers;

use App\models\chambreModel;
use App\models\concernerModel;

class Chambre extends BaseController
{
    public function index()
    {
        if (isset($_POST['type']) == 'update') {
            $data['info'] = $this->infoUpdate($_POST['ID_chambre']);
            echo view('chambre\updateChambre', $data);
            return ($data);
        }
        if (isset($_POST['btn_enregistrer'])) {
            $this->create();
            return redirect()->to('configChambre');
        }
        if (isset($_POST['btn_modification'])) {
            $this->update();
            return redirect()->to('configChambre');
        }
        if (isset($_POST['btn_suppression'])) {
            $this->delete();
            return redirect()->to('configChambre');
        }
        if (isset($_POST['btn_recherche']) and $_POST['element_recherche'] != NULL) {
            $data = $this->search($_POST['element_recherche']);
            echo view('templates\header');
            echo view('chambre\configChambre', $data);
            echo view('templates\footer');
        } else {
            $data = $this->read();
            echo view('templates\header');
            echo view('chambre\configChambre', $data);
            echo view('templates\footer');
        }
    }

    public function create()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_enregistrer'])) : {
                $rules = [
                    'tarif_chambre' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $chambres = new chambreModel();
                    $newData = [
                        'description_chambre' => $_POST['description_chambre'],
                        'tarif_chambre' => $_POST['tarif_chambre'],
                        'statut_chambre' => $_POST['statut_chambre'],
                    ];

                    $chambres->set($newData);
                    $chambres->insert();
                    $session = session();
                    $session->setFlashdata('success', 'L\'utilisateur a été ajouté avec succès');
                }
            }
        endif;
    }

    public function addChambre()
    {
        $data = [];
        helper(['form']);

        if (isset($_POST['btn_enregistrer'])) : {
                $rules = [
                    'tarif_chambre' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $chambres = new chambreModel();
                    $newData = [
                        'description_chambre' => $_POST['description_chambre'],
                        'tarif_chambre' => $_POST['tarif_chambre'],
                        'statut_chambre' => $_POST['statut_chambre'],
                    ];

                    $chambres->save($newData);
                    $session = session();
                    $session->setFlashdata('success', 'Création réussie');
                    return redirect()->to('configChambre');
                }
            }
        endif;

        echo view('templates/header');
        echo view('chambre/addChambre', $data);
        echo view('templates/footer');
    }

    public function read()
    {
        $data = [];
        $chambres = new chambreModel();
        // $data['chambres'] = $chambres->findAll();

        $data = [
            'chambres' => $chambres->paginate(15, 'paginationResult'),
            'pager' => $chambres->pager,
            'total' => count($chambres->findAll()),
            'total_all' => count($chambres->findAll()),
            'libre' => count($chambres->where('statut_chambre', 'Libre')->findAll()),
            'enAttente' => count($chambres->where('statut_chambre', 'En attente')->findAll()),
            'occupee' => count($chambres->where('statut_chambre', 'Occupée')->findAll()),
            'jsonChambre' => json_encode($chambres->findAll()),
        ];
        return $data;
    }

    public function update()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_modification'])) : {
                $rules = [
                    'tarif_chambre' => 'required|is_natural',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $chambres = new chambreModel();
                    $data = [
                        'description_chambre' => $_POST['description_chambre'],
                        'tarif_chambre' => $_POST['tarif_chambre'],
                        'statut_chambre' => $_POST['statut_chambre'],
                    ];

                    $chambres->set($data);
                    $chambres->where('ID_chambre', $_POST['ID_chambre']);
                    $chambres->update();
                    $session = session();
                    $session->setFlashdata('update', 'La ligne a été modifié avec succès');
                }
            }
        endif;
    }

    public function updateChambreReservation()
    {
        $concerner = new concernerModel();
        $data['info'] = $concerner->where('ID_planning', $_POST['ID_planning'])->where('concerner.ID_chambre', $_POST['ID_chambre'])->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->first();
        echo view('chambre\updateChambreReservation', $data);
        return ($data);
    }

    public function addBed()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_modification'])) : {
                $rules = [
                    'lit_sup' => 'required|is_natural',
                    'tarif_lit_sup' => 'required|is_natural',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $concerner = new concernerModel();
                    $data = [
                        'lit_sup' => $_POST['lit_sup'],
                        'tarif_lit_sup' => $_POST['tarif_lit_sup'],
                    ];

                    $concerner->set($data);
                    $concerner->where('ID_planning', $_POST['ID_planning'])->where('ID_chambre', $_POST['ID_chambre']);
                    $concerner->update();
                    $session = session();
                    $session->setFlashdata('update', 'Lit supplémentaire ajouté');
                    return redirect()->to('planningJour');
                }
            }
        endif;
    }

    public function infoUpdate($ID_chambre)
    {
        $data = [];
        $chambres = new chambreModel();
        $data = $chambres->where('ID_chambre', $ID_chambre)->first();
        return $data;
    }

    public function delete()
    {
        $chambres = new chambreModel();
        $chambres->delete(['ID_chambre' => $_POST['ID_chambre']]);
        $session = session();
        $session->setFlashdata('delete', 'La chambre a été supprimé avec succès');
    }

    public function search($element_recherche)
    {
        $data = [];
        $chambres = new chambreModel();
        // $data['chambres'] = $chambres->like('tarif_chambre', $element_recherche, 'both')->orLike('statut_chambre', $element_recherche, 'both')->find();
        $data = [
            'chambres' => $chambres->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_chambre', $element_recherche, 'both')->paginate(15, 'paginationResult'),
            'pager' => $chambres->pager,
            'total' => count($chambres->like('tarif_chambre', $element_recherche, 'both')->orLike('statut_chambre', $element_recherche, 'both')->findAll()),
            'total_all' => count($chambres->findAll()),
            'libre' => count($chambres->where('statut_chambre', 'Libre')->findAll()),
            'enAttente' => count($chambres->where('statut_chambre', 'En attente')->findAll()),
            'occupee' => count($chambres->where('statut_chambre', 'Occupée')->findAll()),
        ];
        return $data;
    }

    public function saveTarif()
    {
        $data = [];
        if (isset($_POST['dataJSON'])) {
            $obj = json_decode($_POST['dataJSON'], true);

            foreach ($obj as $element) {
                $data = [
                    'ID_chambre' => $element['ID_chambre'],
                    'description_chambre' => $element['description_chambre'],
                    'statut_chambre' => $element['statut_chambre'],
                    'tarif_chambre' => $element['tarif_chambre'],
                ];
            };

            return json_encode($data);
        }
    }
}
