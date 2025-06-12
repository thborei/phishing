<?php

namespace App\Controller;

use App\MoteurDeRendu;
use App\Repository\CampagnRepository;
use App\Repository\DataRepository;

class QRCodeController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    private CampagnRepository $campaignRepository;
    
    public function __construct()
    {
        $this->moteur = new MoteurDeRendu();
        $this->repository = new DataRepository();
        $this->campaignRepository = new CampagnRepository();
    }
    public function get()
    {
        // Récupérer les campagnes affichées
        $campaign = $this->campaignRepository->getDisplayedCampaign();

        echo $campaign->getHex();
    }
}