<?php


const LOT_ARTICLES = 4; // количество своих статей в меню на главной странице
const LOT_LINKS = 6; // количество ссылок на внешние статьи в меню на главной странице

const DB_DSN = "mysql:host=localhost;dbname=yachting;charset=utf8";
const IMG_PATH = 'img/';
const VIEWS_SITE = 'views_site/';
const VIEWS_ADMIN = 'views_admin/';

const SOAP_WDSL_CBR = 'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL';

const DB_USERNAME = 'blog';
const DB_PASSWORD = 'blog';

const ADMIN_NAME = 'blog';
const ADMIN_PASSWORD = 'blog';

const E_ADRESS_ADMIN = 'adress@mail.ru';
const E_THEMA_MESSAGE = 'Forma yachting site';



date_default_timezone_set('Europe/Moscow');


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

//function handleException($e)
//{
//    echo "Сорри, возникла проблема. Попробуйте еще раз позже";
//    error_log($e->getMessage());
//}
//
//set_exception_handler('handleException');



