<?php

date_default_timezone_set('Europe/Moscow');


function handleException($e)
{
    $d = date('Y-m-d H:i:s');
    $string = "$d:\r\n(EXCEPTION) FILE: " .$e->getFile(). "   LINE: " .$e->getLine(). "   MESSAGE: " .$e->getMessage(). "\r\n";

    $f = fopen('handle_err.txt', 'a');
    fwrite($f, $string);
    fclose($f);
}

function handleError($errno, $errfile, $errstr, $errline)
{
    $d = date('Y-m-d H:i:s');
    $string = "$d:\r\n(ERROR) errNO: " .$errno. "   errFILE: " .$errfile. "   errSTR: " .$errstr. "   errLINE: " .$errline. "\r\n";

    $f = fopen('handle_err.txt', 'a');
    fwrite($f, $string);
    fclose($f);

    /* Не запускаем внутренний обработчик ошибок PHP */
    return true;
}

set_exception_handler('handleException');
set_error_handler('handleError');



const DS = DIRECTORY_SEPARATOR;
define('SITE_PATH', realpath(__DIR__) .DS);

const LOT_ARTICLES = 4; // количество своих статей в меню на главной странице
const LOT_LINKS = 6; // количество ссылок на внешние статьи в меню на главной странице

const DB_DSN = "mysql:host=localhost;dbname=yachting;charset=utf8";
const DB_USERNAME = 'blog';
const DB_PASSWORD = 'blog';

/*
 * В константе DATA_IMG_PATH путь указан без первого слэша - потому, что при перемещении файла в файловой
 * системе командой move_uploaded_file() перед ней подставляется полный путь до папки сайта (иначе получится
 * путь от корня диска).
 * При отображении картинок - лидирующий слэш приходится дополнять во вьюхах, чтобы браузер искал картинки от
 * корня сайта, а не приклеивал путь к строке запроса текущей страницы.
 * */
const DATA_IMG_PATH = 'data/img_database/';
const VIEWS_INDEX = 'views' .DS. 'views_index' .DS;
const VIEWS_ADMIN = 'views' .DS. 'views_admin' .DS;

const SOAP_WDSL_CBR = 'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL';

const ADMIN_NAME = 'blog';
const ADMIN_PASSWORD = 'blog';

const E_ADRESS_ADMIN = 'adress@mail.ru';
const E_THEMA_MESSAGE = 'Форма с сайта яхтинга';


