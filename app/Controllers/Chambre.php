<?php

namespace App\Controllers;

use App\models\chambreModel;

class Chambre extends BaseController
{
    public function index()
    {

        if (isset($_POST['btn_enregistrer'])) {
            $this->create();
            return redirect()->to('configChambre');
        } elseif (isset($_POST['btn_modification'])) {
            $this->update();
            return redirect()->to('configChambre');
        } elseif (isset($_POST['btn_suppression'])) {
            $this->delete();
            return redirect()->to('configChambre');
        }
        if (isset($_POST['btn_recherche']) AND $_POST['element_recherche'] != NULL) {
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
            'chambres' => $chambres->paginate(10, 'paginationResult'),
            'pager' => $chambres->pager,
        ];
        return $data;
    }

    public function update()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_modification'])) : {
                $rules = [
                    'tarif_chambre' => 'required',
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
            'chambres' => $chambres->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_chambre', $element_recherche, 'both')->paginate(10, 'paginationResult'),
            'pager' => $chambres->pager,
        ];
        return $data;
	}
}
