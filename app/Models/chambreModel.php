<?php namespace app\models;

use CodeIgniter\Model;

class chambreModel extends model {
    protected $table = 'chambre';
    protected $primaryKey = 'ID_chambre';

    protected $allowedFields = ['num_chambre', 'tarif_temp', 'tarif_ancien', 'description_chambre', 'statut_chambre'];
}