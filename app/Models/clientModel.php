<?php namespace app\models;

use CodeIgniter\Model;

class clientModel extends model {
    protected $table = 'client';
    protected $primaryKey = 'ID_client';

    protected $allowedFields = ['nom_client', 'prenom_client'];
}