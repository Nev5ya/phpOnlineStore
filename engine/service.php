<?php

function isAdmin():bool {
    if (isset($_SESSION['login'])) {
        return (BOOL)getAssocResult("SELECT `role` FROM `users` WHERE `login` = '{$_SESSION['login']}'")[0]['role'];
    }
    return false;
}

function getOrdersByLogin($login):array {
    return getAssocResult("SELECT * FROM `orders` WHERE `login` = '{$login}'");
}

function getAuthorizedUserInfo($login):array {
    return getAssocResult("SELECT `full_name`, `phone`, `email` FROM `users` WHERE `login` = '{$login}'")[0];
}

function validateData($data) {
    $errorsTemplate = [
        "login" => "Логин уже занят!",
        "password" => "Пароли не совпадают!",
        "phone" => "Данный номер телефона зарегистрирован!",
        "email" => "Email уже зарегистрирован!"
    ];

    if ($data['password'] !== $data['password_confirm']) {
        return $errorsTemplate['password'];
    }
    if (getAssocResult("SELECT * FROM `users` WHERE `login` = '{$data['login']}'")) {
        return $errorsTemplate['login'];
    }
    if (getAssocResult("SELECT * FROM `users` WHERE `phone` = '{$data['phone']}'")) {
        return $errorsTemplate['phone'];
    }
    if (getAssocResult("SELECT * FROM `users` WHERE `email` = '{$data['email']}'")) {
        return $errorsTemplate['email'];
    }
    return false;
}

function signUp($data):bool {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    return executeQuery("INSERT INTO `users` (login, full_name, phone, email, password) VALUES ('{$data['login']}', '{$data['full_name']}', '{$data['phone']}', '{$data['email']}', '{$data['password']}')");
}

/*
 * actions for admin
 */

function getOneOrder($id):array {
    return getAssocResult("SELECT * FROM `orders` WHERE `id` = $id")[0];
}

function updateOrderInfo($info):bool {
    return executeQuery("UPDATE `orders` SET `name` = '{$info['name']}', `number` = '{$info['number']}', `mail` = '{$info['email']}', `order_status` = {$info['status']} WHERE `id` = {$info['id']}");
}

function getAllOrders():array{
    return getAssocResult("SELECT * FROM `orders`");
}

//todo [order-details]
//function getOrderDetails($orderID, $login):array {
//    if (isAdmin()) {
//        return getCart(getOrderSessionByID($orderID), 1);
//    }
//    return getCart(getOrderSessionByLogin($login), 1);
//}

//todo [order-details]

/* пример запроса, который мог бы решить проблему с корзинами, но необходим уникальный ключ для каждой
 * "SELECT DISTINCT orders.*, cart.good_id
 * FROM orders INNER JOIN cart ON orders.session_id = cart.session_id
 * INNER JOIN catalog ON cart.good_id = catalog.id
 * WHERE orders.id = 35"
 * */
//function getOrderSessionByLogin($login) {
//    return getAssocResult("SELECT session_id FROM `orders` WHERE login = '{$login}'")[0]['session_id'];
//}

//todo [order-details]
//function getOrderSessionByID($orderID) {
//    return getAssocResult("SELECT session_id FROM `orders` WHERE id = $orderID")[0]['session_id'];
//}