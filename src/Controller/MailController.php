<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\MoteurDeRendu;

class MailController
{
    private MoteurDeRendu $moteur;
    private UserRepository $repository;
    
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->moteur = new MoteurDeRendu();
    }
    public function showMailForm($id)
{
    $user = $this->repository->getUser($id);

    $contenu = $this->moteur->render('mail', ['user' => $user]);

    echo $this->moteur->render('indexView', [
        'contenu' => $contenu,
        'header' => $this->moteur->render('headerView'),
        'footer' => $this->moteur->render('footerView')
    ]);
}
public function sendMail($id)
{
    $user = $this->repository->getUser($id);

    $subject = $_POST['subject'] ?? '';
    $body = $_POST['body'] ?? '';

    if (empty($subject) || empty($body)) {
        echo "Veuillez remplir tous les champs.";
        return;
    }

    $user->EnvoieMailCustom($subject, $body);
    header('Location: /liste-des-utilisateurs'); // ou la page précédente
    exit;
}
}


