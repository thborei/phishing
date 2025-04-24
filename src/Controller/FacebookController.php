<?php

namespace App\Controller;

use App\MoteurDeRendu;

class FacebookController
{
    private MoteurDeRendu $moteur;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
    }
    public function AfficherFacebook()
    {
   
        echo $this->moteur->render('facebook', [
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

