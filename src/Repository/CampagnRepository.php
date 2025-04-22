<?php

namespace App\Repository;

use App\Model\Database;
use App\Model\Campagn;
use PDO;

class CampagnRepository
{
    private PDO $pdo;

    protected const TYPES = [
        'pre-defined' => 'Pré-définie',
        'custom' => 'Personnalisée',
    ];

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
    
    public function getCampaigns(): array
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

    public function createCampagn(string $type, string $url): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO CAMPAGNS (type_campagn, url_campagn) VALUES (:type, :url)");
        $stmt->execute([':type' => $type, ':url' => $url]);
    }

    public function updateCampagn(int $id, string $type, string $url): void
    {
        $stmt = $this->pdo->prepare("UPDATE CAMPAGNS SET type_campagn = :type, url_campagn = :url WHERE id_campagn = :id");
        $stmt->execute([':id' => $id, ':type' => $type, ':url' => $url]);
    }
    
}