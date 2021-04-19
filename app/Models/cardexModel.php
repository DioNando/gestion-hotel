<?php namespace app\models;

use CodeIgniter\Model;

class cardexModel extends model {
    protected $table = 'cardex';
    protected $primaryKey = 'ID_cardex';

    protected $allowedFields = ['date_naissance', 'lieu_naissance', 'pere_client', 'mere_client', 'profession', 'domicile_habituel', 'nationalite', 'piece_identite', 'num_piece_identite', 'date_delivrance', 'lieu_delivrance', 'date_fin_validite', 'venant_de', 'allant_a', 'mode_transport', 'ID_client'];
}