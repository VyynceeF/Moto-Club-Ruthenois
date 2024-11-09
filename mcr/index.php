<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/print.css" media="print">
        <link rel="stylesheet" type="text/css" href="./css/police.css">
        <link rel="stylesheet" type="text/css" href="./css/form.css">
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/mediaQueries.css">
    </head>
    <body>

<?php 

ini_set('display_errors', 'on');

// Elements required
include("routage/View.php");
include("routage/DataBaseSource.php");

// To route
include("routage/Router.php");

$dataBaseSource = new DataBaseSource(
    $host = 'mysql-vins.alwaysdata.net',
    $port = '3306',
    $db = 'vins_mcr',
    $user = 'vins',
    $pass = 'mcrroot'
);

$router = new Router();
$router->route($dataBaseSource);
?>

    </body>
</html>