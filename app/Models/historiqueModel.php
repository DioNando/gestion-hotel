<?php namespace app\models;

use CodeIgniter\Model;

class historiqueModel extends model {
    protected $table = 'historique';
    protected $primaryKey = 'ID_historique';

    protected $allowedFields = ['ID_historique', 'ID_chambre_ancien', 'tarif_chambre_ancien'];
}