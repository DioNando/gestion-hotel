<?php 

namespace App\Validation;

use App\models\userModel;
use App\models\adminModel;

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
    
    public function validateAdmin(string $str, string $fields, array $data)
    {
        $model = new adminModel();
        $user = $model->where('nom_admin', $data['nom_admin']) 
                      ->first();

        if (!$user)
            return false;
        return password_verify($data['mdp_admin'], $user['mdp_admin']);
    }
}
