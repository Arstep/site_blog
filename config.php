<?php
/*
 *
 * */


const LOT_ARTICLES = 4; // количество своих статей в меню на главной странице
const LOT_LINKS = 6; // количество ссылок на внешние статьи в меню на главной странице
const DB_DSN = "mysql:host=localhost;dbname=site_blog;charset=utf8";
const DB_USERNAME = 'blog';
const DB_PASSWORD = 'blog';

$dbPdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

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

