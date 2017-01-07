<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <meta name="viewport" content="width=1000">

    <title>Парусный яхтинг</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="/views/css/blog_style.css">
    <link rel="icon" href="/views/ico/sailboat.ico" type="image/gif">

    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="/views/js/blog_js.js"></script>
</head>

<body>
    <header>
        <nav>
            <ul>

                <li <?php if ($navMark == 'homepage') echo " id=\"navMark\""?>>
                    <a  href="/">Главная</a>
                </li>

                <li <?php if ($navMark == 'resourses') echo " id=\"navMark\""?>>
                    <a  href="/index/resourses">Ресурсы</a>
                </li>

                <li <?php if ($navMark == 'search') echo " id=\"navMark\""?>>
                    <a  href="/index/search">Поиск</a>
                </li>

                <li <?php if ($navMark == 'contact') echo " id=\"navMark\""?>>
                    <a  href="/index/contact">Связь</a>
                </li>

            </ul>
        </nav>
    </header>
    


