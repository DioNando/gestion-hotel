<?php

namespace App\Controllers;

class Statistique extends BaseController
{
    public function index()
    {   
        echo view('templates/header');
		echo view('dashboard/statistique');
		echo view('templates/footer');
    }

    public function read()
    {
        
    }    
}
