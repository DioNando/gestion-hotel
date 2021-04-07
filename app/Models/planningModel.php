<?php namespace app\models;

use CodeIgniter\Model;

class planningModel extends model {
    protected $table = 'planning';
    protected $primaryKey = 'ID_planning';

    protected $allowedFields = ['debut_sejour', 'fin_sejour', 'heure_arrive', 'heure_depart', 'motif'];
}