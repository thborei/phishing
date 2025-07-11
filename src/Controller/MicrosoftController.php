<?php

namespace App\Controller;

use App\MoteurDeRendu;
use App\Repository\DataRepository;
use App\Repository\UserRepository;

class MicrosoftController
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
    public function AfficherMicrosoft()
    {
        echo $this->moteur->render('microsoft');
    }

    public function AfficherMicrosoftCamp($id)
    {
        $id_camp = $id;
        echo $this->moteur->render('microsoft', [
            'id_camp' => $id_camp]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['email'])) {
                $user = $this->userRepository->getUserByEmail($_POST['email']);
                if (isset($user)) {
                    $id_user = $user->getId();
                } else {
                    $id_user = null;
                }
            } else {
                $id_user = null;
            }
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $json = json_encode(["Mail" => $email, "Password" => $password]);
            $id_camp = $_POST['id_camp'];

            // Validation des données
            if (empty($email) || empty($password)) {
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