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

    $binaryData = $campaign->getHex(); // contient déjà du binaire brut !

    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . strlen($binaryData));
    header('Connection: close');

    echo $binaryData;
    exit;
}


}