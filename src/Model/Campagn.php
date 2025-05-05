<?php

namespace App\Model;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Campagn
{
    private $id;
    private $type;
    private $url;
    private $hex;

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
        $qrCode = new QrCode('http://10.1.40.50:8080/'.$url);
    
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $filePath = './img/qrCode' . $path . '.png';

        file_put_contents($filePath, $result->getString());
        $dataUri = $result->getDataUri();

        $bin = file_get_contents($filePath);
        $hexArray = str_split(bin2hex($bin),2);
        $hex = "";
        foreach($hexArray as $byte){
            $hex .= "0x$byte, ";
        }
        $this->hex = $hex;
        return $dataUri;
    }
    public function getHex():string|null
    {
        return $this->hex;
    }

}