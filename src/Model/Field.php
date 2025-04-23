<?php

namespace App\Model;

class Field
{
    private $id;
    private $name;
    private $type;
    private $id_campagn;

    public function __construct(
        int $id,
        string $name,
        string $type,
        string $id_campagn,
    ){
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->id_campagn = $id_campagn;
    }
    
    public function getId():int
    {
        return $this->id;
    }
    public function getName():string
    {
        return $this->name;
    }
    public function getType():string
    {
        return $this->type;
    }
    public function getId_campagn():int
    {
        return $this->id_campagn;
    }
}