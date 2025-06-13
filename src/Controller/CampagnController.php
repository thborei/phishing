<?php

namespace App\Controller;

use App\Model\Field;
use App\Repository\CampagnRepository;
use App\Repository\FieldRepository;
use App\Repository\DataRepository;
use App\MoteurDeRendu;
use App\Repository\UserRepository;


class CampagnController
{
    private MoteurDeRendu $moteur;
    private CampagnRepository $repository;
    private FieldRepository $fieldRepository;
    private DataRepository $dataRepository;
    private UserRepository $userRepository;
    
    public function __construct()
    {
        $this->repository = new CampagnRepository();
        $this->moteur = new MoteurDeRendu();
        $this->fieldRepository = new FieldRepository();
        $this->dataRepository = new DataRepository();
        $this->userRepository = new UserRepository();
    }

    public function AfficherCampagn()
    {
        $campaigns = $this->repository->getCampaigns();

        $contenu = $this->moteur->render('campaigns/index', ['campaigns' => $campaigns]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'];
            $url = $_POST['url'] . "/";
            $predifine = $_POST['predefinedOptions'] ?? null; 
            $service = $_POST['service'] ?? null;
            $users = $_POST['users'] ?? [];
            $active = isset($_POST['active']) ? true : false;
            $displayed = isset($_POST['displayed']) ? true : false;
            // Validation des données
            if (empty($type) || empty($url)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }
             elseif (empty($users) && empty($service)) {
                echo "Veuillez sélectionner au moins un utilisateur.";
                return;
            }
            if (!empty($users) && empty($service)) {
                foreach ($users as $userId) {
                $this->userRepository->getUser($userId)->EnvoieMail();
            }
            }
            if (empty($users) && !empty($service)) {
            $users = $this->userRepository->getUsersByService($service);
            foreach ($users as $user) {
                $user -> EnvoieMail();
            }

            $this->repository->createCampagn($type, $url, $predifine, $active, $displayed);

            header('Location: /campaigns'); // Redirection après l'enregistrement
            exit;
        }
    } else {
            $users = $this->userRepository->getUsers();
            $services = $this->userRepository->getServices();
            $contenu = $this->moteur->render('campaigns/form', ['users' => $users, 'services' => $services]);

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
            $active = isset($_POST['active']) ? true : false;
            $displayed = isset($_POST['displayed']) ? true : false;

            // Validation des données
            if (empty($type) || empty($url)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }

            // Mise à jour dans la base de données
            $this->repository->updateCampagn($id, $type, $url, $active, $displayed);
            header('Location: /campaigns'); // Redirection après la mise à jour
            exit;
        } else {
            $contenu = $this->moteur->render('campaigns/form', ['campaign' => $campaign]);
        
            echo $this->moteur->render('indexView', [
                'contenu' => $contenu,
                'header' => $this->moteur->render('headerView'),
                'footer' => $this->moteur->render('footerView')
            ]);
        }
    }

    public function results($id) {
        $Data = $this->dataRepository->getDataByCampagn($id);

        $contenu = $this->moteur->render('dataFacebook', ['Data' => $Data,'id' => $id]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }

    public function formulaire($id) {
        $campaign = $this->repository->getCampagnById($id);
        $fields = $this->fieldRepository->getFieldsByCampagn($id);

        $contenu = $this->moteur->render('campaigns/formulaire/index', ['campaign' => $campaign, 'fields' => $fields]);

        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
    
    public function createFormulaire($id) {
        $campaign = $this->repository->getCampagnById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $type = $_POST['type'];
            $id_campagn = $campaign->getId();

            // Validation des données
            if (empty($type) || empty($name) || empty($id_campagn)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }

            // Enregistrement dans la base de données
            $this->repository->createField($name, $type, $id_campagn);
            header('Location: /campaigns/formulaire/'.$campaign->getId()); // Redirection après l'enregistrement
            exit;
        } else {
            $contenu = $this->moteur->render('campaigns/formulaire/form', ['campaign' => $campaign]);
        
            echo $this->moteur->render('indexView', [
                'contenu' => $contenu,
                'header' => $this->moteur->render('headerView'),
                'footer' => $this->moteur->render('footerView')
            ]);
        }
    }

    public function updateFormulaire($id) {
        $field = $this->fieldRepository->getFieldById($id);
        $campaign = $this->repository->getCampagnById($field->getId_campagn());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $type = $_POST['type'];
            $id_campagn = $field->getId_campagn();
            $id_field = $field->getId();

            // Validation des données
            if (empty($type) || empty($type)) {
                echo "Veuillez remplir tous les champs.";
                return;
            }

            // Enregistrement dans la base de données
            $this->fieldRepository->updateField($id_field, $name, $type, $id_campagn);
            header('Location: /campaigns/formulaire/'.$campaign->getId()); // Redirection après l'enregistrement
            exit;
        } else {
            $contenu = $this->moteur->render('campaigns/formulaire/form', ['field' => $field, 'campagn' => $campaign]);
        
            echo $this->moteur->render('indexView', [
                'contenu' => $contenu,
                'header' => $this->moteur->render('headerView'),
                'footer' => $this->moteur->render('footerView')
            ]);
        }
    }

    public function deleteFormulaire($id) {
        $field = $this->fieldRepository->getFieldById($id);
        $campaign = $this->repository->getCampagnById($field->getId_campagn());

        // Suppression du champ dans la base de données
        $this->fieldRepository->deleteField($id);

        header('Location: /campaigns/formulaire/'.$campaign->getId()); // Redirection après la suppression
        exit;
    }
    public function delete($id) {
        $this->repository->deleteCampagn($id);

        header('Location: /campaigns'); 
        exit;
    }
}