<?php
function __autoload($className)
{
    $name = strtolower($className);
    $expName = explode('_', $name);

    if ( ! isset($expName[1])){
        // если имя класса из одного слова, то
        $folder = 'classes';
    } else {

        switch ($expName[0]){

            case 'controller':
                $folder = 'controllers';
                break;

            case 'model':
                $folder = 'models';
                break;

            default:
                $folder = 'classes';
        }

    }

    // полный путь к файлу с классом
    $file = SITE_PATH. $folder .DS. $name. '.php';

    if (file_exists($file))
        include_once ($file);
    else {
        include(SITE_PATH . 'views' . DS . 'errors' . DS . '404.php');
        throw new Exception('Не найден файл - ' .$file. ' с классом - ' . $className);
    }
}