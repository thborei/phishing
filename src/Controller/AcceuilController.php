<?php

namespace App\Controller;

use App\Repository\DataRepository;
use App\MoteurDeRendu;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class AcceuilController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    
    public function __construct()
    {
        $this->repository = new DataRepository();
        $this->moteur = new MoteurDeRendu();
    }
    public function AfficherAcceuil()
    {
        $qrCode = new QrCode('Ceci est un QR code de test 🚀');
    
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $dataUri = $result->getDataUri();

        $users = $this->repository->getLastDataPhished();

        $contenu = $this->moteur->render('acceuilView', ['users' => $users, 'qrCode' => $dataUri]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

