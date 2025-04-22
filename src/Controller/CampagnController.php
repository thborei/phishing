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

        $contenu = $this->moteur->render('campaigns/index', ['campagns' => $campagns]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
                die;
            $type = $_POST['type'];
            $url = $_POST['url'];

            // Validation des données
            if (empty($type) || empty($url)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }

            // Enregistrement dans la base de données
            $this->repository->createCampagn($type, $url);
            header('Location: /campaigns'); // Redirection après l'enregistrement
        } else {
            $contenu = $this->moteur->render('campaigns/form');
        
            echo $this->moteur->render('indexView', [
                'contenu' => $contenu,
                'header' => $this->moteur->render('headerView'),
                'footer' => $this->moteur->render('footerView')
            ]);
        }
    }

    public function update($id) {
        $campaign = $this->repository->getCampagnById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'];
            $url = $_POST['url'];

            // Validation des données
            if (empty($type) || empty($url)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }

            // Mise à jour dans la base de données
            $this->repository->updateCampagn($id, $type, $url);
            header('Location: /campaigns'); // Redirection après la mise à jour
        } else {
            $contenu = $this->moteur->render('campaigns/form', ['campaign' => $campaign]);
        
            echo $this->moteur->render('indexView', [
                'contenu' => $contenu,
                'header' => $this->moteur->render('headerView'),
                'footer' => $this->moteur->render('footerView')
            ]);
        }
    }

    public function result($id) {
        // afficher les résultats de la campagne
    }
    
}
