<?php

namespace App\Controller;

use App\Repository\CampagnRepository;
use App\MoteurDeRendu;

class CampagnController
{
    private MoteurDeRendu $moteur;
    private CampagnRepository $repository;
    
    public function __construct()
    {
        $this->repository = new CampagnRepository();
        $this->moteur = new MoteurDeRendu();
    }
    public function AfficherCampagn()
    {
        $campagns = $this->repository->getCampagn();

        $contenu = $this->moteur->render('campagnView', ['campagns' => $campagns]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}
