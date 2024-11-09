<?php

include("service/CompteService.php");

class CompteController{

    private $compteService;

    public function __construct(){
        $this->compteService = new CompteService();
    }

    /**
     * To log an account
     */
    public function login($pdo){

        $pass = htmlspecialchars(HttpParam::getParam("password"));
        $mail = htmlspecialchars(HttpParam::getParam("email"));

        $util = $this->compteService->login($pdo, $pass, $mail);

        if(empty($util)){
            $view = new View("connexion");
            $view->addValue("state",true);
            return $view;
        }

        foreach($util as $key => $value){
            $_SESSION["$key"] = $value;
        }
        $_SESSION["id"] = session_id();

        $accueilController = new AccueilController();

        $view = $accueilController->index($pdo);
        return $view;
    }

    public function exit($pdo){
        session_destroy();
        $accueil = new AccueilController();
        return $accueil->index($pdo);
    }

    public function index() {
        $view = new View("connexion");
        $view->addValue("state",false);
        return $view;
    }
}
