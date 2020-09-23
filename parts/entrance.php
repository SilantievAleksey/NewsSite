<?php session_start(); ?>
<?php
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === 'yes'){
        header('Location: administration.php');
        die();
    }
?>
<?php require_once 'connect.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница входа</title>
    <link rel="stylesheet" href="../css/entrance.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../images/general/Logotip.ico" type="image/x-icon">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <section class="content">
        <div class="container">
            <div class="main">
                <div class="entrance">
                    <p id="error_main"></p>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                        <fieldset>
                            <legend>Вход</legend>
                            <div class="entrance_part">
                                <p>
                                    <label for="login">Логин: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                                    <input type="text" name="login" id="login" value="<?php if (isset($_COOKIE['login'])) echo $_COOKIE['login']; ?>">
                                </p>
                                <span id="error_login"></span>
                            </div>
                            <div class="entrance_part">
                                <p>
                                    <label for="password">Пароль: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                                    <input type="password" name="password" id="password" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>">
                                </p>
                                <span id="error_password"></span>
                            </div>
                            <button type="submit" name="sign" id="sign">Войти</button>
                            <a href="register.php">Зарегистрироваться</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/entrance.js"></script>
<script src="../scripts/news.js"></script>
</body>
</html>