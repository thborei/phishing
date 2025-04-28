<?php

namespace App\Model;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

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
    public function createQrcode($url, $path):string
    {
        var_dump($url);
        var_dump($path);
        $qrCode = new QrCode('http://10.1.40.50:8080/'.$url);
    
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $filePath = './img/qrCode' . $path . '.png';

        file_put_contents($filePath, $result->getString());
        $dataUri = $result->getDataUri();

        return $dataUri;
    }

}