<?php

namespace App\Controller;

use App\MoteurDeRendu;
use App\Repository\CampagnRepository;

class QRCodeController
{
    private MoteurDeRendu $moteur;
    private CampagnRepository $campaignRepository;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
        $this->campaignRepository = new CampagnRepository();
    }
 public function get()
{
    $campaign = $this->campaignRepository->getDisplayedCampaign();
    $campaign->createQrcode($campaign->getUrl(), $campaign->getId());

    $hexData = $campaign->getHex(); // chaîne hex textuelle, ex: "FF00A1..."

    // Supposons que $hexData soit une chaîne hex sans espaces ni préfixes 0x
    // Si ce n'est pas le cas, il faudra nettoyer $hexData avant
    $binaryData = hex2bin($hexData);

    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . strlen($binaryData));
    header('Connection: close');

    echo $binaryData;
    exit;
}

}