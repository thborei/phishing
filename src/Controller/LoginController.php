<?php

namespace App\Controller;

use App\MoteurDeRendu;

class LoginController
{
    private MoteurDeRendu $moteur;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
    }
    public function AfficherLogin()
    {

        echo $this->moteur->render('loginView');
    }
}