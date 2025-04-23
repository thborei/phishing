<?php

namespace App\Repository;

use App\Model\Database;
use App\Model\Field;
use PDO;

class FieldRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
    
    public function getFieldById(int $id): ?Field
    {
        $stmt = $this->pdo->prepare("SELECT * FROM FIELDS WHERE id_field = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new Field(
            $row['id_field'],
            $row['name_field'],
            $row['type_field'],
            $row['id_campagn']
        ) : null ;
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

}