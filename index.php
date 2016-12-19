<?php
require_once 'config.php';


$controller = new Controller_Use();

$action = isset($_GET['action']) ? $_GET['action'] : false;

switch ($action){
    case 'article':
        $controller->getArticle();
        break;
    case 'contact':
        $controller->contact();
        break;
    default:
        $controller->homepage();
}
