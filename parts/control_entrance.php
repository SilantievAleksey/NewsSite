<?php
    session_start();
    require_once 'connect.php';
    $errors = array();

    if (empty($_POST['login'])){
        $errors["login"] = "Логин не указан!";
        $errors['status'] = false;
    }

    if (empty($_POST['password'])){
        $errors["password"] = "Пароль не указан!";
        $errors['status'] = false;
    }

    if (empty($errors)){
        $login = htmlspecialchars($_POST['login']);
        $result = $link->query("SELECT * FROM `users-lab-two` WHERE `login` = '{$login}'");
        $user = $result->fetch_assoc();
        if (!empty($user)){
            $hash = $user['password'];
            $password = htmlspecialchars($_POST['password']);
            if (password_verify($password, $hash)){
                $errors["status"] = true;
                setcookie('login', $login, time() + 3600*24, '/');
                setcookie('password', $password, time() + 3600*24, '/');
                $_SESSION['auth'] = 'yes';
            }
            else{
                $errors["main"] = "Пароль или логин указан неверно!";
                $errors["status"] = false;
            }
        }
        else{
            $errors["main"] = "Пароль или логин указан неверно!";
            $errors["status"] = false;
        }

    }

    echo json_encode($errors);
