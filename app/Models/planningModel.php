<?php namespace app\models;

use CodeIgniter\Model;

class planningModel extends model {
    protected $table = 'planning';
    protected $primaryKey = 'ID_planning';

    protected $allowedFields = ['date_affectation_debut', 'date_affectation_fin', 'motif'];
}