<?php

namespace App\Controller;

use App\Repository\DataRepository;
use App\Repository\CampagnRepository;
use App\MoteurDeRendu;

class ListController
{
    private MoteurDeRendu $moteur;
    private DataRepository $repository;
    private CampagnRepository $campagnrepository;
    
    public function __construct()
    {
        $this->repository = new DataRepository();
        $this->moteur = new MoteurDeRendu();
        $this->campagnrepository = new CampagnRepository();
    }
    public function AfficherListe($id)
    {
        $data = $this->repository->getDataByUser($id);
        // $campagn = $this->campagnrepository->getCampagnById($id);
        
        $contenu = $this->moteur->render('listView', ['data' => $data]);//,'campagn'=>$campagn]);
        
        
        echo $this->moteur->render('indexView', [
            'contenu' => $contenu,
            'header' => $this->moteur->render('headerView'),
            'footer' => $this->moteur->render('footerView')
        ]);
    }
}

