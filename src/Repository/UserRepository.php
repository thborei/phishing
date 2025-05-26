<?php

namespace App\Repository;

use App\Model\Database;
use App\Model\User;
use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getUsers()
    {
        $query = 'SELECT * FROM USERS';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return array_map(fn($row) => new User(
            $row['id_user'],        
            $row['name_user'],      
            $row['firstname_user'], 
            $row['mail_user'],      
            $row['password_user']   
        ), $results);
    }

    public function getUser(int $id): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM USERS WHERE id_user = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new User(
            $row['id_user'],
            $row['name_user'],
            $row['firstname_user'],
            $row['mail_user'],
            $row['password_user'],
        );
    }
    public function LogIn(string $mail, string $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Login WHERE mail_login = :mail LIMIT 1");
        $stmt->execute([':mail' => $mail]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password_login'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /acceuil');
        } else {
            die("Mauvais identifiants !");
            $message = 'Mauvais identifiants';
        }
    }

    public function Logout()
    {
        session_destroy();
        header('Location: /login');
    }

    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM USERS WHERE mail_user = :email LIMIT 1");
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User(
                $row['id_user'],
                $row['name_user'],
                $row['firstname_user'],
                $row['mail_user'],
                $row['password_user']
            );
        }
        return null;
    }

}
