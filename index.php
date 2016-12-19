<?php
require_once 'config.php';

function __autoload($className)
{
    $name = explode('_', $className);
    switch ($name[0]){
        case 'Controller':
            require_once 'controllers/' . $name[0] . $name[1] . '.php';
            break;
        case 'Model':
            require_once 'models/' . $name[0] . $name[1] . '.php';
    }
}



$dbPdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

$controller = new Controller_Use();

$action = isset($_GET['action']) ? $_GET['action'] : false;

switch ($action){
    case 'article':
        $controller->getArticle();
        break;
    default:
        $controller->homepage();
}





echo "<a href='index.php?action=article&id=3'>Test index.php?action=article&id=3</a>";