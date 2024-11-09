<?php

include("routage/HttpParam.php");

// Controllers
include("controller/AccueilController.php");
include("controller/DescriptionController.php");
include("controller/CompteController.php");
include("controller/ContactController.php");

class Router{

    public function route($dataBaseSource){

        $controllerName = HttpParam::getParam("controller") ?: 'Accueil';
        $controllerQualifiedName = $controllerName . "Controller";
        $controller = new $controllerQualifiedName();

        $action = HttpParam::getParam("action") ?: 'index';

        session_start();
      
        if ($dataBaseSource != null) {
            $view = $controller->$action($dataBaseSource->getPdo());
        } else {
            $view = $controller->$action();
        }

        $view->render();
    }
}