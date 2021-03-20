<?php namespace app\models;

use CodeIgniter\Model;

class reservationModel extends model {
    protected $table = 'reservation';
    protected $primaryKey = 'ID_reservation';

    protected $allowedFields = ['nbr_personne', 'debut_sejour', 'fin_sejour', 'ID_client', 'ID_user', 'ID_chambre'];
}