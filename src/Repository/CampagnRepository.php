<?php

namespace App\Repository;

use App\Model\Database;
use App\Model\Campagn;
use PDO;

class CampagnRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // public function getCampagn()
    // {
    //     $query = 'SELECT * FROM CAMPAGNS';
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // } V1
    
    public function getCampagn(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM CAMPAGNS");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Campagn(
            $row['id_campagn'],
            $row['type_campagn'],
            $row['url_campagn'],
        )  ,$results);
    }


    public function getCampagnById(int $id): ?Campagn
    {
        $stmt = $this->pdo->prepare("SELECT * FROM CAMPAGNS WHERE id_campagn = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Campagn(
            $row['id_campagn'],
            $row['type_campagn'],
            $row['url_campagn'],
        );
    }
}