<?php

include("service/AccueilService.php");

class AccueilController{

    private $accueilService;

    public function __construct(){
        $this->accueilService = new AccueilService();
    }

    public function index($pdo) {

        $infos = $this->accueilService->getInfosClub($pdo);

        $view = new View("accueil");

        foreach($infos as $info){
            $view->addValue("mail", $info['mail']);
            $view->addValue("insta", $info['insta']);
            $view->addValue("facebook", $info['facebook']);
            $view->addValue("description", $info['description']);
            $view->addValue("nom", $info['nom']);
        }

        return $view;
    }
}