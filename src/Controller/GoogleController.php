<?php

namespace App\Controller;

use App\MoteurDeRendu;
use App\Repository\DataRepository;
use App\Repository\UserRepository;

class GoogleController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    private UserRepository $userRepository;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
        $this->repository = new DataRepository();
        $this->userRepository = new UserRepository();
    }
    public function AfficherGoogle()
    {
        echo $this->moteur->render('google');
    }

}