<?php 

namespace App\Validation;

use App\Models\userModel;
use App\Models\clientModel;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new userModel();
        $user = $model->where('nom_user', $data['nom_user']) 
                      ->first();
        // $user = $model->like('CONCAT(nom_user, " ", prenom_user)', $data['nom_user'], 'both')->orLike('nom_user', $data['nom_user'], 'both')->orLike('prenom_user', $data['nom_user'], 'both')->first();

        if (!$user)
            return false;
        return password_verify($data['mdp_user'], $user['mdp_user']);
    }
    
    public function validateClient(string $nom_client)
    {
        $model = new clientModel();
        $client = $model->like('CONCAT(nom_client, " ", prenom_client)', $nom_client, 'both')->orLike('nom_client', $nom_client, 'both')->orLike('prenom_client', $nom_client, 'both')->first();
                      
        if (!$client)
            return false;
    }
}
