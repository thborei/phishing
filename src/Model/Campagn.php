<?php

namespace App\Model;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Campagn
{
    private $id;
    private $type;
    private $url;
    private $predefined;
    private $hex;
    private $active;
    private $displayed;

    public function __construct(
        int $id,
        string $type,
        string $url,
        ?string $predefined,
        ?bool $active = true,
        ?bool $displayed = true
    ){
        $this->id = $id;
        $this->type = $type;
        $this->url = $url;
        $this->predefined = $predefined;
        $this->active = $active;
        $this->displayed = $displayed;
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
    public function getPredefined():?string
    {
        return $this->predefined;
    }
    public function isActive():bool
    {
        return $this->active;
    }
    public function isDisplayed():bool
    {
        return $this->displayed;
    }
public function createQrcode($url, $path): string
{
    $qrCode = new QrCode('http://10.1.40.50:8080/' . $url);

    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    $filePath = './img/qrCode' . $path . '.png';

    // On enregistre toujours le PNG
    file_put_contents($filePath, $result->getString());
    $dataUri = $result->getDataUri();

    // Traitement de l'image en mémoire
    $im = imagecreatefrompng($filePath);
    $width = imagesx($im);
    $height = imagesy($im);

    $binary = '';
    for ($y = 0; $y < $height; $y++) {
        $byte = 0;
        $bit = 7;
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($im, $x, $y);
            $colors = imagecolorsforindex($im, $rgb);
            $luminance = ($colors['red'] + $colors['green'] + $colors['blue']) / 3;
            $pixel = $luminance < 128 ? 0 : 1;

            $byte |= ($pixel << $bit);
            $bit--;

            if ($bit < 0) {
                $binary .= chr($byte);
                $bit = 7;
                $byte = 0;
            }
        }
        if ($bit != 7) {
            $binary .= chr($byte);
        }
    }

    imagedestroy($im);

    // Option 1: stocker la chaîne brute (binaire) si ton API accepte l'encodage binaire direct
    $this->hex = $binary;

    // Option 2: si tu veux l'envoyer en hex (lisible et JSON-safe)
    // $this->hex = bin2hex($binary); // => "ffffff0000f0..."

    return $dataUri;
}

    public function getHex():string|null
    {
        return $this->hex;
    }
}