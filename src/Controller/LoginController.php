<?php

namespace App\Controller;

use App\MoteurDeRendu;
use App\Repository\UserRepository;

class LoginController
{
    private MoteurDeRendu $moteur;
    private UserRepository $repository;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
        $this->repository = new UserRepository();

    }
    public function AfficherLogin()
    {

        echo $this->moteur->render('loginView');
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validation des données
            if (empty($username) || empty($password)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }

            $this->repository->logIn($username, $password);
            exit;
        } else {
            $contenu = $this->moteur->render('loginView');
        
            echo $this->moteur->render('indexView', [
                'contenu' => $contenu,
                'header' => $this->moteur->render('headerView'),
                'footer' => $this->moteur->render('footerView')
            ]);
        }
    }
}