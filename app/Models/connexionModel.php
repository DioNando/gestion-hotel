<?php namespace app\models;

use CodeIgniter\Model;

class connexionModel extends model {
    protected $table = 'connexion';
    protected $primaryKey = 'ID_connexion';

    protected $allowedFields = ['ID_user', 'etat_connexion'];
}