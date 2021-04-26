<?php namespace app\models;

use CodeIgniter\Model;

class factureNuitModel extends model {
    protected $table = 'facture_nuit';

    protected $allowedFields = ['ID_facture_nuit', 'offert', 'remise', 'type_payement_nuit', 'ID_nuit'];
}