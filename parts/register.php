<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../images/general/Logotip.ico" type="image/x-icon">
</head>
<body>

<?php require_once 'header.php'; ?>

<section class="content">
    <div class="container">

        <div class="main">
            <h1>Регистрация</h1>
            <div class="register">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                    <p>
                        <label for="login">Логин: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <input type="text" name="login" id="login">
                        <span id="error_login"></span>
                    </p>
                    <p>
                        <label for="password">Пароль: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <input type="password" name="password" id="password">
                        <span id="error_password"></span>
                    </p>
                    <p>
                        <label for="confirm_password">Повторите пароль: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <input type="password" name="confirm_password" id="confirm_password">
                        <span id="error_confirm_password"></span>
                    </p>
                    <button name="register" type="submit" id="register">Зарегистрироваться</button>
                    <a href="entrance.php">Вернуться к входу</a>
                </form>
            </div>
        </div>

    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/register.js"></script>
</body>
</html>