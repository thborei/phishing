<?php

namespace App\Repository;

use App\Model\Database;
use App\Model\Data;
use PDO;

class DataRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
    
    public function getDataById(int $id): ?Data
    {
        $stmt = $this->pdo->prepare("SELECT * FROM DATA_PHISHINGS WHERE id_phishing = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new Data(
            $row['id_phishing'],
            $row['json_phishing'],
            $row['date_phishing'],
            $row['id_campagn'],
            $row['id_user']
        ) : null ;
    }
    
    public function getDataByCampagn($campagnid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM DATA_PHISHINGS WHERE id_campagn = :id");
        $stmt->execute([':id' => $campagnid]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Data(
            $row['id_phishing'],
            $row['json_phishing'],
            $row['date_phishing'],
            $row['id_campagn'],
            $row['id_user']
        )  ,$results);
    }

    public function getDataByUser(int $id)
    {
        $query = 'SELECT * FROM DATA_PHISHINGS where id_user = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($results);
        die;
    
        return array_map(fn($row) => new Data(
            $row['id_phishing'],
            $row['json_phishing'],
            $row['date_phishing'],
            $row['id_campagn'],
            $row['id_user']
        )  ,$results);
    }

    public function getLastDataPhished()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM DATA_PHISHINGS ORDER BY id_phishing DESC LIMIT 10");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Data(
            $row['id_phishing'],
            $row['json_phishing'],
            $row['date_phishing'],
            $row['id_campagn'],
            $row['id_user']
        )  ,$results);
    }
}