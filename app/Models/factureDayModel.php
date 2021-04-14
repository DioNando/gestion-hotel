<?php namespace app\models;

use CodeIgniter\Model;

class factureDayModel extends model {
    protected $table = 'facture_day';

    protected $allowedFields = ['ID_facture_day', 'ID_day'];
}