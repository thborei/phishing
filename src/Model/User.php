<?php

namespace App\Model;
use App\Mailer;

class User
{
    private $id;
    private $name;
    private $firstname;
    private $mail;
    private $password;

    public function __construct(
        int $id,
        string $name,
        string $firstname,
        string $mail,
        string $password
    ){
        $this->id = $id;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->mail = $mail;
        $this->password = $password;
    }
    
    public function getId():int
    {
        return $this->id;
    }
    public function getName():string
    {
        return $this->name;
    }
    public function getFirstname():string
    {
        return $this->firstname;
    }
    public function getMail():string
    {
        return $this->mail;
    }
    public function getPassword():string
    {
        return $this->password;
    }
    public function EnvoieMail()
    {
        $to = $this->getMail();
        $subject = 'Notification de sécurité';
        $body = 'Bonjour ' . $this->getName() . ' ' . $this->getFirstname() . ',<br>Nous avons détecté une activité suspecte sur votre compte. Veuillez vérifier vos paramètres de sécurité.';

        if (Mailer::send($to, $subject, $body)) {
            echo "Email envoyé avec succès à " . htmlspecialchars($to);
        } else {
            echo "Échec de l'envoi de l'email.";
        }
    }
}