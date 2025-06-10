<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\MoteurDeRendu;
use App\Mailer;

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
    public function EnvoieMail($id)
    {
        $user = $this->repository->getUser($id);
        if ($user) {
            $to = $user->getMail();
            $subject = 'Notification de sécurité';
            $body = 'Bonjour ' . $user->getName() . $user->getFirstname() . ',<br>Nous avons détecté une activité suspecte sur votre compte. Veuillez vérifier vos paramètres de sécurité.';

            if (Mailer::send($to, $subject, $body)) {
                echo "Email envoyé avec succès à " . htmlspecialchars($to);
            } else {
                echo "Échec de l'envoi de l'email.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    }
}

