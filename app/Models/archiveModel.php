<?php namespace app\models;

use CodeIgniter\Model;

class archiveModel extends model {
    protected $table = 'archive';
    protected $primaryKey = 'ID_archive';

    protected $allowedFields = ['etat_archive'];
}