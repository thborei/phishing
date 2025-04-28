<?php

namespace App\Controller;

use App\Repository\DataRepository;
use App\MoteurDeRendu;
use App\Controller\CampagnController;

class AcceuilController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    private CampagnController $campagnController;
    
    public function __construct()
    {
        $this->repository = new DataRepository();
        $this->moteur = new MoteurDeRendu();
        $this->campagnController = new CampagnController();
    }
    public function AfficherAcceuil()
    {
        $users = $this->repository->getLastDataPhished();
        $mdp = 'password';
        echo password_hash($mdp, PASSWORD_BCRYPT);

        $contenu = $this->moteur->render('acceuilView', ['users' => $users]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

