<?php namespace app\models;

use CodeIgniter\Model;

class factureDayModel extends model {
    protected $table = 'facture_day';

    protected $allowedFields = ['ID_facture_day', 'date_facture_day', 'somme_donne_day', 'type_payement_day', 'ID_day'];
}