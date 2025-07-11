<?php

namespace App\Controller;

use App\Model\Field;
use App\MoteurDeRendu;
use App\Repository\FieldRepository;
use App\Repository\UserRepository;
use App\Repository\DataRepository;

class CustomController
{
    private MoteurDeRendu $moteur;
    private FieldRepository $repository;
    private UserRepository $userRepository;
    private DataRepository $dataRepository;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
        $this->repository = new FieldRepository();
        $this->userRepository = new UserRepository();
        $this->dataRepository = new DataRepository();
    }
    public function AfficherCustom($id)
    {
        $custom = $this->repository->getFieldsByCampagn($id);
        $id_camp = $id;
        
        echo $this->moteur->render('custom', ['fields' => $custom, 'id_camp' => $id_camp]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $fieldCamp = $this->repository->getFieldsByCampagn($_POST['id_camp']);
           foreach ($fieldCamp as $field) {
                if ($field->getType() == "email") {
                    if (isset($_POST['email'])) {
                        $user = $this->userRepository->getUserByEmail($_POST['email']);
                        $id_user =$user->getId();
                        $email = $_POST['email'];
                    }else {
                        $id_user = null;
                        $email = $_POST['email'];
                    }
                }
                if ($field->getType() == "password") {
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                }
                if ($field->getType() == "text") {
                    $name = $_POST['name'];
                }

            }
            if (isset($name, $email, $password)) {
                $json = json_encode(["Name" => $name, "Mail" => $email, "Password" => $password]);
            } elseif (isset($email, $password)) {
                $json = json_encode(["Mail" => $email, "Password" => $password]);
            }
            $id_camp = $_POST['id_camp'];

            // Enregistrement dans la base de données
            $this->dataRepository->createData($json, $id_camp, $id_user);
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

