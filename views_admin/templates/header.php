<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <meta name="viewport" content="width=1000">

    <title>Администрирование сайта</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="css/admin_style.css">
    <link rel="icon" href="ico/sailboat.ico" type="image/gif">
</head>

<body>

<header>
    <nav>
        <ul>

            <li>
                <a href="index.php">Переход на сайт</a>
            </li>

            <li>
                <a href="<?php echo $_SERVER['PHP_SELF']?>">Список статей</a>
            </li>

            <li>
                <a href="<?php echo $_SERVER['PHP_SELF']?>?action=logout"
                   onclick="return confirm('Выйти из авторизации?')">Выход</a>
            </li>

        </ul>
    </nav>
</header>

<section>
    <h1>Администрирование сайта</h1>
    <h5>Вы вошли как <b><?php echo $_SESSION['adminName']?></b></h5>
