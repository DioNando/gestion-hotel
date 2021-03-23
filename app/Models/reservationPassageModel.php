<?php namespace app\models;

use CodeIgniter\Model;

class reservationPassageModel extends model {
    protected $table = 'reservation_passage';
    protected $primaryKey = 'ID_passage';

    protected $allowedFields = ['date_passage', 'heure_passage', 'duree_passage', 'ID_user'];
}