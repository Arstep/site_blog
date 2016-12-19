<?php

require( "config.php" );
session_start();



$controller = new Controller_Admin();

$action = isset($_GET['action']) ? $_GET['action'] : false;

switch ($action){
    case 'list':
        $controller->listArticles(1000);
        break;
    default:
        $controller->homepage();
}