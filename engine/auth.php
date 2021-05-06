<?php

if (isset($_POST['auth'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (!auth($login, $password)) {
        $_GET['authError'] = "Неверный логин/пароль!";
    } else {
        if (isset($_POST['cookie'])) {
            /** @var Stringable $hash */
            $hash = uniqid(rand(), true);
            $id = (INT)$_SESSION['id'];
            executeQuery("UPDATE `users` SET `hash` = '{$hash}' WHERE id = {$id}");
            setcookie("hash", $hash, time() + 36000, '/');
        }

        header("Location:" . $_SERVER["HTTP_REFERER"]);
    }

}

function auth($login, $password):bool {
    $login = mysqli_real_escape_string(getDb(), strip_tags(stripcslashes($login)));
    $passDb = getAssocResult("SELECT * FROM `users` WHERE login = '{$login}'")[0];

    if (password_verify($password, $passDb['password'])) {
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $passDb['id'];
        return true;
    }
    return false;
}

function isAuth():bool {
    if (isset($_COOKIE['hash']) && !isset($_SESSION['login'])) {
        $hash = $_COOKIE['hash'];
        $user = getAssocResult("SELECT * FROM `users` WHERE `hash` = '{$hash}'")[0]['login'];
        if (!empty($user)) {
            $_SESSION['login'] = $user;
        }
    }
    return isset($_SESSION['login']);
}

function getUser() {
    return $_SESSION['login'];
}

if (isset($_GET['logout'])) {
    session_destroy();
    setcookie('hash', '', time() - 36000, '/');
    header('Location: /');
}