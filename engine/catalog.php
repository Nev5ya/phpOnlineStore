<?php
function getCatalog():array {
    return getAssocResult("SELECT * FROM `catalog`");
}

function getOneGood($id){
    return getAssocResult("SELECT * FROM `catalog` WHERE id = {$id}")[0];
}

function cartAction($action, $session_id, $login) {
    $id = (INT)$_GET['id'];
    if (empty($login)) {
        $login = 'not_registered';
    }
    $total = getTotalPrice(getCart($session_id));
    $count = getAllCartItemsCount($session_id);
    switch ($action) {
        case 'add':
            echo json_encode(
                [
                    'added' => addToCart($id, $session_id),
                    'count' => ++$count,
                    'total' => $total
                ]
            );
            break;

        case 'delete':
            echo json_encode(
                [
                    'deleted' => deleteFromCart($id, $session_id),
                    'count' => --$count,
                    'total' => $total
                ]
            );
            break;

        case 'checkout':

            echo json_encode(
                [
                    'ordered' => makeAnOrder($session_id, $total, $login),
                ]
            );
            break;
    }
    die();
}

function makeAnOrder($session_id, $total, $login):bool {
    $result = json_decode(file_get_contents('php://input'));
    $date = date("Y-m-d H:i");
    executeQuery("UPDATE `cart` SET `cart_status` = 1 WHERE session_id = '{$session_id}'");
    return executeQuery("INSERT INTO `orders` (login, name, number, mail, session_id, date, total_amount) VALUES ( '{$login}','{$result->name}', '{$result->number}', '{$result->email}', '{$session_id}', '{$date}', '{$total}')");
}

function getCart($session_id, $cart_status = 0):array {

    $cart = getAssocResult("SELECT cart.id cart_id, catalog.image, catalog.id catalog_id, catalog.name, catalog.price FROM cart, catalog WHERE cart.good_id=catalog.id AND session_id = '{$session_id}' AND cart_status = {$cart_status}");

    $each = getEachCartItemsCount($session_id);

    $tmp = [];
    $unique = [];

    foreach ($cart as $good) {
        if (!in_array($good['catalog_id'], $tmp)) {
            $unique[] = $good;
            $tmp[] = $good['catalog_id'];
        }
    }

    function replace($a, $b) {
        if ($a['catalog_id'] === $b['catalog_id']) {
            $a['count'] = $b['count'];
        }

        $a['sub_total'] = (INT)str_replace(' ', '', $a['price']) * $b['count'];
        return $a;
    }

    return array_map('replace', $unique, $each);
}

function getAllCartItemsCount($session_id):string {
    return getAssocResult("SELECT COUNT(id) as count FROM `cart` WHERE `session_id`='{$session_id}' AND cart_status = 0")[0]['count'];
}

function getEachCartItemsCount($session_id):array {
//    $sql =  "SELECT `catalog`.id AS good_id, SUM(`catalog`.price) AS total FROM `cart` INNER JOIN `catalog` ON `catalog`.id = `cart`.good_id GROUP BY `cart`.id";
    return getAssocResult("SELECT `good_id` AS `catalog_id` , COUNT(`good_id`) AS count FROM `cart` WHERE `session_id` = '$session_id' AND cart_status = 0 GROUP BY (good_id)");
}

function getTotalPrice($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['sub_total'];
    }
    return $total;
}

function addToCart($id, $session_id):bool {
    return executeQuery("INSERT INTO `cart` (good_id, session_id) VALUES ($id, '$session_id')");
}

function deleteFromCart($good_id, $session_id):bool {
    return executeQuery("DELETE FROM `cart` WHERE good_id = '{$good_id}' AND session_id = '{$session_id}' AND cart_status = 0 LIMIT 1");
}