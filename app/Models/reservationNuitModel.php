<?php namespace app\models;

use CodeIgniter\Model;

class reservationNuitModel extends model {
    protected $table = 'reservation_nuit';
    protected $primaryKey = 'ID_nuit';

    // protected $allowedFields = ['nbr_personne', 'debut_sejour', 'fin_sejour', 'nbr_nuit', 'type_reservation', 'ID_client', 'ID_etat_reservation', 'remarque_reservation'];
    protected $allowedFields = ['nbr_personne', 'nbr_nuit', 'type_reservation', 'ID_client', 'ID_etat_reservation', 'remarque_reservation', 'commentaire_nuit', 'venant_de', 'allant_a', 'mode_transport'];
}