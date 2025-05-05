<?php

namespace App\Controller;

use App\Model\Field;
use App\MoteurDeRendu;
use App\Repository\FieldRepository;

class CustomController
{
    private MoteurDeRendu $moteur;
    private FieldRepository $repository;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
        $this->repository = new FieldRepository();
    }
    public function AfficherCustom($id)
    {
        $custom = $this->repository->getFieldsByCampagn($id);
        
        echo $this->moteur->render('custom', ['fields' => $custom]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = $_POST['json'];
            $url = $_POST['url'];

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

