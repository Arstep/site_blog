<?php
require( "config.php" );
session_start();

$adminName = isset($_SESSION['adminName']) ? $_SESSION['adminName'] : false;
if ( ! $adminName){
    (new Controller_Admin())->login();
    exit();
}


$controller = new Controller_Admin();

$action = isset($_GET['action']) ? $_GET['action'] : false;

switch ($action){
    case 'editArticle':
        $controller->editArticle();
        break;
    case 'newArticle':
        $controller->newArticle();
        break;
    case 'deleteArticle':
        $controller->deleteArticle();
        break;
    case 'deleteImg':
        $controller->deleteImg();
        break;
    default:
        $controller->listArticles(1000);
}

$dbPdo = null;