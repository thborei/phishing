<?php

namespace App\Controller;

use App\Repository\DataRepository;
use App\MoteurDeRendu;

class AcceuilController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    
    public function __construct()
    {
        $this->repository = new DataRepository();
        $this->moteur = new MoteurDeRendu();
    }
    public function AfficherAcceuil()
    {
        $users = $this->repository->getLastDataPhished();

        $contenu = $this->moteur->render('acceuilView', ['users' => $users]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

