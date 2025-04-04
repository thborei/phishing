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
        return $row ? $this->createInstance($row) : null;
    }
}
