<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$channel = $path[3] ?? '';
$action = $_SERVER['REQUEST_METHOD'];

include("../routage/DataBaseSource.php");
include("../service/DescriptionService.php");

$descriptionService = new DescriptionService();

$dataBaseSource = new DataBaseSource(
    $host = 'mysql-vins.alwaysdata.net',
    $port = '3306',
    $db = 'vins_mcr',
    $user = 'vins',
    $pass = 'mcrroot'
);
$pdo = $dataBaseSource->getPDO();

## Gestion des channel de l'API
switch ($channel) {

    case 'article':

        switch($action){

            case 'POST':
                $articles = $descriptionService->getArticles($pdo);
                echo json_encode($articles);
                break;

            default:
                echo json_encode(["error" => "Channel non valide"]);

        }
        break;

    default:
        echo json_encode(["error" => "Channel non valide"]);
}
