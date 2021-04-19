<?php namespace app\models;

use CodeIgniter\Model;

class chambreModel extends model {
    protected $table = 'chambre';
    protected $primaryKey = 'ID_chambre';

    protected $allowedFields = ['description_chambre', 'tarif_chambre', 'statut_chambre'];
}