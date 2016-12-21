<?php

require( "config.php" );
session_start();



$controller = new Controller_Admin();

$action = isset($_GET['action']) ? $_GET['action'] : false;

switch ($action){
    case 'editArticle':
        $controller->editArticle();
        break;
    case 'newArticle':
        $controller->newArticle();
        break;
    default:
        $controller->listArticles(1000);
}

$dbPdo = null;