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
        // $qrCode = new QrCode('https://10.1.40.50/facebook');
    
        // $writer = new PngWriter();
        // $result = $writer->write($qrCode);
        // $filePath = './img/qrCode.png';

        // file_put_contents($filePath, $result->getString());

        // $dataUri = $result->getDataUri();

        $users = $this->repository->getLastDataPhished();

        $contenu = $this->moteur->render('acceuilView', ['users' => $users]);//, 'qrCode' => $dataUri]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

