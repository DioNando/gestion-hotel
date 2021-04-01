<?php 

namespace App\Validation;

use App\models\userModel;
use App\models\clientModel;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new userModel();
        $user = $model->where('nom_user', $data['nom_user']) 
                      ->first();

        if (!$user)
            return false;
        return password_verify($data['mdp_user'], $user['mdp_user']);
    }
    
    public function validateClient(string $nom_client)
    {
        $model = new clientModel();
        $user = $model->where('nom_client', $nom_client) 
                      ->first();
                      
        if (!$user)
            return false;
    }
}
