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

    $hexData = $campaign->getHex();

    header('Content-Type: text/plain');
    header('Content-Length: ' . strlen($hexData));
    header('Connection: close');

    echo $hexData;
    exit;
    }
}