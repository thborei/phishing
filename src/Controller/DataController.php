<?php

namespace App\Controller;

use App\Repository\DataRepository;
use App\MoteurDeRendu;

class DataController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    
    public function __construct()
    {
        $this->repository = new DataRepository();
        $this->moteur = new MoteurDeRendu();
    }
    public function AfficherData($id)
    {
        $Data = $this->repository->getDataByCampagn($id);

        $contenu = $this->moteur->render('dataView', ['Data' => $Data,'id' => $id]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

