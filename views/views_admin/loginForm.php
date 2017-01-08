<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <meta name="viewport" content="width=1000">

    <title>Вход для администратора</title>

    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="/views/css/admin.css">
    <link rel="icon" href="/views/ico/sailboat.ico" type="image/gif">
    
    <style>
        table.signup {
            margin: 100px auto;
            background: #fff4cf;
            width: 350px;
        }
        .signup td {
            text-align: center;
        }
        #denied {
            color: red;
            font-size: 0.8em;
        }
        .signup tr:hover{
            background: #fff4cf;
        }
    </style>
    <script>
        function validate(form) {
            if (/[^a-zA-Z0-9]/.test(form.name.value) || /[^a-zA-Z0-9]/.test(form.password.value)){
                alert('Поля содержат недопустимые символы');
                return false;
            }
            else return true;
        }
    </script>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li>
                    <a href="/">Переход на сайт</a>
                </li>
            </ul>
        </nav>
    </header>

<section>
    <table class="signup">
        <th colspan="2">Вход для администратора</th>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" onsubmit="return validate(this)">

            <?php if (isset($result['error'])){?>
            <tr>
                <td colspan="2" id="denied"><?php echo $result['error']?></td>
            </tr>
            <?php }?>

            <tr>
                <td>Имя</td>
                <td><input type="text" maxlength="32" name="name"></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input type="password" maxlength="12" name="password"></td>
            </tr>
            <tr>
                <td colspan="2"><input class="signup" type="submit" value="Войти"></td>
            </tr>
        </form>
    </table>
</section>
</body>
</html>