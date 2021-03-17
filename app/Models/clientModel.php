<?php namespace app\models;

use CodeIgniter\Model;

class clientModel extends model {
    protected $table = 'client';
    protected $primaryKey = 'ID_client';

    protected $allowedFields = ['nom_client', 'mdp_client'];

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
        if(isset($data['data']['mdp_client']))
            $data['data']['mdp_client'] = password_hash($data['data']['mdp_client'], PASSWORD_DEFAULT);
        return $data;
    }
}