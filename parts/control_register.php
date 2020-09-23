<?php
    session_start();
    require_once 'connect.php';
    $errors = array();

    if (empty($_POST['login'])){
        $errors["login"] = "Логин не указан!";
        $errors['status'] = false;
    }
    else{
        $login = htmlspecialchars($_POST['login']);
        $result = $link->query("SELECT * FROM `users-lab-two` WHERE `login` = '{$login}'");
        if ($result->num_rows >= 1){
            $errors["login"] = "Введенный логин уже существует!";
            $errors["status"] = false;
        }
    }

    if (empty($_POST['password'])){
        $errors["password"] = "Пароль не указан!";
        $errors['status'] = false;
    }

    if (empty($_POST['confirm_password'])){
        $errors["confirm_password"] = "Пароль не подтвержден!";
        $errors['status'] = false;
    }
    else{
        $password = htmlspecialchars($_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);
        if ($confirm_password !== $password){
            $errors["confirm_password"] = "Пароли не совпадают!";
            $errors["status"] = false;
        }
    }

    if (empty($errors)){
        $hash = $link->real_escape_string(password_hash($password, PASSWORD_DEFAULT));
        $date = date("Y-m-d H:i:s");
        $link->query("INSERT INTO `users-lab-two` (`login`, `password`, `date_register`, `id_role`) VALUES ('{$login}','{$hash}', '{$date}', 2) ");
        $errors["status"] = true;
        setcookie('login', $login, time() + 3600*24, '/');
        setcookie('password', $password, time() + 3600*24, '/');
        $_SESSION['auth'] = 'yes';
    }

    echo json_encode($errors);