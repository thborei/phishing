<?php

namespace App\Model;

class Data
{
    private int $id;
    private string $json;
    private string $date;
    private int $idcamp;
    private ?int $iduser;

    public function __construct(
        int $id,
        string $json,
        string $date,
        int $idcamp,
        ?int $iduser

    ) {
        $this->id = $id;
        $this->json = $json;
        $this->date = $date;
        $this->idcamp = $idcamp;
        $this->iduser = $iduser;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getJson(): array|null
    {
        $json = json_decode($this->json, true);
        return $json;
    }
    public function getJsonName(): string|null
    {
        $json = $this->getJson();
        $string = trim(($json['Name'] ?? "") . ' ' . ($json['Firstname'] ?? ""));

        if (!$string) {
            return "Pas renseigné";
        }
        
        return $string;
    }
    public function getJsonMail(): string|null
    {
        $json = $this->getJson();
        return $json['Mail'] ?? "Pas de mail renseigné";
    }
    public function getJsonPassword(): string|null
    {
        $json = $this->getJson();
        return "Mot de passe renseigné" ?? "Pas de mot de passe renseigné";
    }

    public function getDate(): string
    {
        return $this->date;
    }
    public function getIdcamp(): int
    {
        return $this->idcamp;
    }
    public function getIduser(): ?int
    {
        return $this->iduser;
    }
}
