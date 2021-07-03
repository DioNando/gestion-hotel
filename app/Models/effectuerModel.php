<?php namespace app\models;

use CodeIgniter\Model;

class effectuerModel extends model {
    protected $table = 'effectuer';

    protected $allowedFields = ['ID_user', 'ID_nuit', 'ID_day', 'nom_user_modif', 'date_modif'];
}