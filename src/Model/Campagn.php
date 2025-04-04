<?php

namespace App\Model;

class Campagn
{
    private $id;
    private $type;
    private $url;

    public function __construct(
        int $id,
        string $type,
        string $url,
    ){
        $this->id = $id;
        $this->type = $type;
        $this->url = $url;
    }
    
    public function getId():int
    {
        return $this->id;
    }
    public function getType():string
    {
        return $this->type;
    }
    public function getUrl():string
    {
        return $this->url;
    }
}