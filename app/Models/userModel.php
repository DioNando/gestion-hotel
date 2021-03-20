<?php namespace app\models;

use CodeIgniter\Model;

class userModel extends model {
    protected $table = 'user';
    protected $primaryKey = 'ID_user';

    protected $allowedFields = ['nom_user', 'droit_user','mdp_user'];

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
        if(isset($data['data']['mdp_user']))
            $data['data']['mdp_user'] = password_hash($data['data']['mdp_user'], PASSWORD_DEFAULT);
        return $data;
    }
}