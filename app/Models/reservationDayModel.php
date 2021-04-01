<?php namespace app\models;

use CodeIgniter\Model;

class reservationDayModel extends model {
    protected $table = 'reservation_day';
    protected $primaryKey = 'ID_day';

    protected $allowedFields = ['date_day', 'heure_arrive', 'heure_depart', 'duree_day'];
}