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

    public function __construct(
        int $id,
        string $type,
        string $url,
        ?string $predefined,
    ){
        $this->id = $id;
        $this->type = $type;
        $this->url = $url;
        $this->predefined = $predefined;
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
    public function createQrcode($url, $path): string
    {
        $qrCode = new QrCode('http://10.1.40.50:8080/' . $url);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $filePath = './img/qrCode' . $path . '.png';

        file_put_contents($filePath, $result->getString());
        $dataUri = $result->getDataUri();

        // Convert PNG to 1-bit hex array
        $im = imagecreatefrompng($filePath);
        $width = imagesx($im);
        $height = imagesy($im);

        $hex = '';

        for ($y = 0; $y < $height; $y++) {
            $byte = 0;
            $bit = 7;
            for ($x = 0; $x < $width; $x++) {
                $rgb = imagecolorat($im, $x, $y);
                $colors = imagecolorsforindex($im, $rgb);
                $luminance = ($colors['red'] + $colors['green'] + $colors['blue']) / 3;
                $pixel = $luminance < 128 ? 1 : 0;

                $byte |= ($pixel << $bit);
                $bit--;

                if ($bit < 0) {
                    $hex .= sprintf("0x%02X, ", $byte);
                    $bit = 7;
                    $byte = 0;
                }
            }
            // Padding last byte if needed
            if ($bit != 7) {
                $hex .= sprintf("0x%02X, ", $byte);
            }
        }

        imagedestroy($im);

        $this->hex = $hex;

        return $dataUri;
    }
    public function getHex():string|null
    {
        return $this->hex;
    }
    public function getPredefined():string|null
    {
        return $this->predefined;
    }
    function pngTo1bitHexArray(string $filePath): string {
    $im = imagecreatefrompng($filePath);
    $width = imagesx($im);
    $height = imagesy($im);
    
    $hex = '';
    
    for ($y = 0; $y < $height; $y++) {
        $byte = 0;
        $bit = 7;
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($im, $x, $y);
            $colors = imagecolorsforindex($im, $rgb);
            $luminance = ($colors['red'] + $colors['green'] + $colors['blue']) / 3;
            $pixel = $luminance < 128 ? 1 : 0; // noir ou blanc
            
            $byte |= ($pixel << $bit);
            $bit--;

            if ($bit < 0) {
                $hex .= sprintf("0x%02X, ", $byte);
                $bit = 7;
                $byte = 0;
            }
            }
            // Pad last byte if line width not divisible by 8
            if ($bit != 7) {
                $hex .= sprintf("0x%02X, ", $byte);
            }
        }

        imagedestroy($im);
        return $hex;
    }

}