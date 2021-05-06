<?php

namespace App\Controllers;

use App\models\chambreModel;
use App\models\concernerModel;
use App\models\relierModel;
use App\models\archiveModel;

class Chambre extends BaseController
{
    public function index()
    {
        if (isset($_POST['type']) == 'update') {
            $data['info'] = $this->infoUpdate($_POST['ID_chambre']);
            echo view('chambre\updateChambre', $data);
            return ($data);
        }
        if (isset($_POST['btn_modification'])) {
            $this->update();
            return redirect()->to('configTarif');
        }
        if (isset($_POST['btn_suppression'])) {
            $this->delete();
            return redirect()->to('configTarif');
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

    public function configTarif()
    {
        if (isset($_POST['btn_enregistrer'])) {
            $this->create();
            return redirect()->to('configTarif');
        }
        if (isset($_POST['btn_recherche']) and $_POST['element_recherche'] != NULL) {
            $data = $this->searchTarif($_POST['element_recherche']);
            echo view('templates\header');
            echo view('chambre\configTarif', $data);
            echo view('templates\footer');
        } else {
            $data = $this->readTarif();
            echo view('templates\header');
            echo view('chambre\configTarif', $data);
            echo view('templates\footer');
        }
    }

    public function create()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_enregistrer'])) : {
                $rules = [
                    'tarif_temp' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $chambres = new chambreModel();
                    $newData = [
                        'tarif_ancien' => $_POST['tarif_temp'],
                        'tarif_temp' => 0,
                        // 'tarif_temp' => $_POST['tarif_temp'],
                        'description_chambre' => $_POST['description_chambre'],
                        'statut_chambre' => $_POST['statut_chambre'],
                    ];

                    $chambres->save($newData);
                    $session = session();
                    $session->setFlashdata('success', 'La chambre a été ajouté avec succès');
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
                    'tarif_temp' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $chambres = new chambreModel();
                    $newData = [
                        'tarif_ancien' => $_POST['tarif_temp'],
                        'tarif_temp' => 0,
                        // 'tarif_temp' => $_POST['tarif_temp'],
                        'description_chambre' => $_POST['description_chambre'],
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
        $relier = new relierModel();
        $archives = new archiveModel();
        $archive = $archives->orderBy('ID_archive', 'desc')->first();

        // $archive = $archives->orderBy('ID_archive', 'desc')->first();

        $data = [
            'chambres' => $relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->paginate(15, 'paginationResult'),
            'pager' => $relier->pager,
            'total' => count($relier->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('relier.ID_archive', $archive['ID_archive'])->findAll()),
            'total_all' => count($relier->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('relier.ID_archive', $archive['ID_archive'])->findAll()),
            'libre' => count($relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('statut_chambre', 'Libre')->findAll()),
            'enAttente' => count($relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('statut_chambre', 'En attente')->findAll()),
            'occupee' => count($relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('statut_chambre', 'Occupée')->findAll()),
            'jsonChambre' => json_encode($chambres->findAll()),
            // 'jsonChambre' => json_encode($relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll()),
        ];
        return $data;
    }

    public function readTarif()
    {
        $data = [];
        $chambres = new chambreModel();
        $relier = new relierModel();
        $archives = new archiveModel();
        $archive = $archives->orderBy('ID_archive', 'desc')->first();

        // $archive = $archives->orderBy('ID_archive', 'desc')->first();

        $data = [
            // 'chambres' => $relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->paginate(15, 'paginationResult'),
            'temps' => $chambres->paginate(15, 'paginationResult'),
            'pager' => $chambres->pager,
            'total' => count($chambres->findAll()),
            'total_all' => count($chambres->findAll()),
            'libre' => count($chambres->where('statut_chambre', 'Libre')->findAll()),
            'enAttente' => count($chambres->where('statut_chambre', 'En attente')->findAll()),
            'occupee' => count($chambres->where('statut_chambre', 'Occupée')->findAll()),
            'jsonChambre' => json_encode($chambres->findAll()),
            // 'jsonChambre' => json_encode($relier->where('relier.ID_archive', $archive['ID_archive'])->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll()),
        ];
        return $data;
    }

    public function update()
    {
        $data = [];
        helper('form');

        if (isset($_POST['btn_modification'])) : {
                $rules = [
                    // 'tarif_chambre' => 'required|is_natural',
                    'statut_chambre' => 'required',
                ];

                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $chambres = new chambreModel();
                    $data = [
                        'description_chambre' => $_POST['description_chambre'],
                        'tarif_temp' => $_POST['tarif_temp'],
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
        $archives = new archiveModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        $data['info'] = $concerner->where('ID_planning', $_POST['ID_planning'])->where('concerner.ID_chambre', $_POST['ID_chambre'])->join('chambre', 'concerner.ID_chambre = chambre.ID_chambre')->join('relier', 'relier.ID_chambre = chambre.ID_chambre')->join('archive', 'relier.ID_archive = archive.ID_archive')->where('archive.ID_archive', $archive['ID_archive'])->first();
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
        $archives = new archiveModel();
        $relier = new relierModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        // $data['chambres'] = $chambres->like('tarif_chambre', $element_recherche, 'both')->orLike('statut_chambre', $element_recherche, 'both')->find();
        $data = [
            // 'chambres' => $chambres->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_chambre', $element_recherche, 'both')->paginate(15, 'paginationResult'),
            'chambres' => $relier->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_chambre', $element_recherche, 'both')->where('archive.ID_archive', $archive['ID_archive'])->paginate(15, 'paginationResult'),
            // 'temps' => $chambres->findAll(),
            'pager' => $relier->pager,
            // 'total' => count($relier->join('archive', 'relier.ID_archive =  archive.ID_archive')->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_chambre', $element_recherche, 'both')->where('relier.ID_archive', $archive['ID_archive'])->findAll()),
            'total' => count($relier->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_chambre', $element_recherche, 'both')->where('relier.ID_archive', $archive['ID_archive'])->findAll()),
            'total_all' => count($relier->where('relier.ID_archive', $archive['ID_archive'])->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->findAll()),
            'libre' => count($relier->where('relier.ID_archive', $archive['ID_archive'])->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('statut_chambre', 'Libre')->findAll()),
            'enAttente' => count($relier->where('relier.ID_archive', $archive['ID_archive'])->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('statut_chambre', 'En attente')->findAll()),
            'occupee' => count($relier->where('relier.ID_archive', $archive['ID_archive'])->join('chambre', 'relier.ID_chambre = chambre.ID_chambre')->where('statut_chambre', 'Occupée')->findAll()),
            'jsonChambre' => json_encode($chambres->findAll()),
        ];
        return $data;
    }

    public function searchTarif($element_recherche)
    {
        $data = [];
        $chambres = new chambreModel();
        $archives = new archiveModel();
        $relier = new relierModel();
        $archive = $archives->where('etat_archive', 1)->orderBy('ID_archive', 'desc')->first();

        $data = [
            // 'chambres' => $chambres->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_chambre', $element_recherche, 'both')->paginate(15, 'paginationResult'),
            'temps' => $chambres->like('statut_chambre', $element_recherche, 'both')->orLike('tarif_temp', $element_recherche, 'both')->orLike('tarif_ancien', $element_recherche, 'both')->paginate(15, 'paginationResult'),
            // 'temps' => $chambres->findAll(),
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

    public function saveTarif()
    {
        $data = [];
        if (isset($_POST['dataJSON'])) {
            $obj = json_decode($_POST['dataJSON'], true);
            $archive = new archiveModel();
            $relier = new relierModel();
            $chambres = new chambreModel();
            $data = [
                'etat_archive' => 0,
            ];

            $archive->set($data);
            $archive->where('etat_archive', 1);
            $archive->update();

            $data = [
                'etat_archive' => 1,
            ];

            $archive->save($data);
            $ID_archive = $archive->getInsertID();


            foreach ($obj as $element) {
                if ($element['tarif_temp'] != 0) {
                    $data = [
                        'ID_chambre' => $element['ID_chambre'],
                        'ID_archive' => $ID_archive,
                        'tarif_chambre' => $element['tarif_temp'],
                    ];
                    $relier->save($data);

                    $dataOld = [
                        'tarif_ancien' => $element['tarif_temp'],
                        'tarif_temp' => 0,
                    ];
                    $chambres->set($dataOld);
                    $chambres->where('ID_chambre', $element['ID_chambre']);
                    $chambres->update();
                } else {

                    $data = [
                        'ID_chambre' => $element['ID_chambre'],
                        'ID_archive' => $ID_archive,
                        'tarif_chambre' => $element['tarif_ancien'],
                    ];
                    $relier->save($data);
                }
            };
            return 1;
        }
    }
}
