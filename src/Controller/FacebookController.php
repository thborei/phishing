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

        $contenu = $this->moteur->render('facebook');
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

