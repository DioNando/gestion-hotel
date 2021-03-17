<?php namespace app\models;

use CodeIgniter\Model;

class adminModel extends model {
    protected $table = 'admin';
    protected $primaryKey = 'ID_admin';

    protected $allowedFields = ['nom_admin', 'mdp_admin'];

    protected $beforeInsert = ['beforeInsert']; 
    protected $beforeUpdate = ['beforeUpdate'];
    
    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data)
    {
        if(isset($data['data']['mdp_admin']))
            $data['data']['mdp_admin'] = password_hash($data['data']['mdp_admin'], PASSWORD_DEFAULT);
        return $data;
    }
}