<?php namespace app\models;

use CodeIgniter\Model;

class relierModel extends model {
    protected $table = 'relier';

    protected $allowedFields = ['ID_archive', 'ID_chambre', 'tarif_chambre'];
}