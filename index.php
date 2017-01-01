<?php
require_once 'config.php';


$controller = new Controller_Use();

$action = isset($_GET['action']) ? $_GET['action'] : false;

switch ($action){
    case 'article':
        $controller->getArticle();
        break;
    case 'resourses':
        $controller->resourses();
        break;
    case 'contact':
        $controller->contact();
        break;
    case 'search':
        $controller->search();
        break;
    case 'findajax':
        $controller->findAjax();
        break;
    default:
        $controller->homepage();
}
