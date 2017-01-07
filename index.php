<?php
include_once ('config.php');

$dbPdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

// Подключаем autoload
include_once (SITE_PATH .DS. 'classes' .DS. 'autoload.php');

// Разбираем строку запроса
$router = Router::getInstance();

// Выполняем контроллер и метод
$router->start();
