<?php

namespace App\Repository;

use App\Model\Database;
use App\Model\Campagn;
use App\Model\Field;
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

    public function createCampagn(string $type, string $url, ?string $predifine): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO CAMPAGNS (type_campagn, url_campagn, predefine_campagn) VALUES (:type, :url, :predifine)");
        $stmt->execute([':type' => $type, ':url' => $url, ':predifine' => $predifine]);
    }

    public function updateCampagn(int $id, string $type, string $url): void
    {
        $stmt = $this->pdo->prepare("UPDATE CAMPAGNS SET type_campagn = :type, url_campagn = :url WHERE id_campagn = :id");
        $stmt->execute([':id' => $id, ':type' => $type, ':url' => $url]);
    }
    
    public function getFieldsByCampagn($id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM FIELDS WHERE id_campagn = :id");
        $stmt->execute([':id' => $id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(fn($row) => new Field(
            $row['id_fields'],
            $row['name_fields'],
            $row['type_fields'],
            $row['id_campagn'],
        )  ,$results);
    }

    public function createField(string $name, string $type, int $id_campagn): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO FIELDS (name_fields, type_fields, id_campagn) VALUES (:name, :type, :id_campagn)");
        $stmt->execute([':name' => $name, ':type' => $type, ':id_campagn' => $id_campagn]);
    }

    public function getFields(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM FIELDS");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Field(
            $row['id_fields'],
            $row['name_fields'],
            $row['type_fields'],
            $row['id_campagn'],
        )  ,$results);
    }
    
    public function getCampagnByUrl(string $url): ?Campagn
    {
        $stmt = $this->pdo->prepare("SELECT * FROM CAMPAGNS WHERE url_campagn = :url");
        $stmt->execute([':url' => $url]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Campagn(
                $row['id_campagn'],
                $row['type_campagn'],
                $row['url_campagn'],
            );
        }
        return null;
    }
}