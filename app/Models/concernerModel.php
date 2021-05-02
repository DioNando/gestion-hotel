<?php namespace app\models;

use CodeIgniter\Model;

class concernerModel extends model {
    protected $table = 'concerner';

    protected $allowedFields = ['ID_chambre', 'ID_planning', 'lit_sup', 'tarif_lit_sup'];
}