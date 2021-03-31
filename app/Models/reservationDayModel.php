<?php namespace app\models;

use CodeIgniter\Model;

class reservationDayModel extends model {
    protected $table = 'reservation_day';
    protected $primaryKey = 'ID_day';

    protected $allowedFields = ['date_day', 'heure_day', 'duree_day'];
}