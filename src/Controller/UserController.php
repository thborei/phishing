<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\MoteurDeRendu;

class UserController
{
    private MoteurDeRendu $moteur;
    private UserRepository $repository;
    
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->moteur = new MoteurDeRendu();
    }
    public function AfficherUser()
    {
        $users = $this->repository->getUsers();

        $contenu = $this->moteur->render('userView', ['users' => $users]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

