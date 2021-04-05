<?php namespace app\models;

use CodeIgniter\Model;

class pourModel extends model {
    protected $table = 'pour';

    protected $allowedFields = ['ID_planning', 'ID_nuit', 'ID_day'];
}