<?php

namespace App\Controllers;

use App\models\clientModel;
use App\models\userModel;

class Planning extends BaseController
{
    public function index()
    {
        echo ('INDEX');
    }

    public function planningJour()
    {
        $data = [];
        helper(['form']);

        echo view('templates\header');
        echo view('planning\planningJour', $data);
        echo view('templates\footer');
    }

    public function planningMois()
    {
        $data = [];
        helper(['form']);

        echo view('templates\header');
        echo view('planning\planningMois', $data);
        echo view('templates\footer');
    }
}
