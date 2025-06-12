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
        // Récupérer les campagnes affichées
        $campaign = $this->campaignRepository->getDisplayedCampaign();

        echo $campaign->getHex();
    }
}