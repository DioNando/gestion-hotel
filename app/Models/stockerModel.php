<?php namespace app\models;

use CodeIgniter\Model;

class stockerModel extends model {
    protected $table = 'stocker';

    protected $allowedFields = ['ID_historique', 'ID_client', 'ID_reservation'];
}