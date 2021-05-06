<?php
function getCatalog():array {
    return getAssocResult("SELECT * FROM `catalog`");
}

function getOneGood($id){
    return getAssocResult("SELECT * FROM `catalog` WHERE id = {$id}")[0];
}

function cartAction($action, $session_id) {
    $id = (INT)$_GET['id'];
    switch ($action) {
        case 'add':
            echo json_encode(
                [
                    'added' => addToCart($id, $session_id),
                    'count' => getAllCartItemsCount($session_id),
                    'total' => getTotalPrice(getCart($session_id))
                ]
            );
            break;

        case 'delete':
            echo json_encode(
                [
                    'deleted' => deleteFromCart($id, $session_id),
                    'count' => getAllCartItemsCount($session_id),
                    'total' => getTotalPrice(getCart($session_id))
                ]
            );
            break;

        case 'checkout':

            echo json_encode(
                [
                    'ordered' => makeAnOrder($session_id),
                ]
            );
            break;
    }
    die();
}

function makeAnOrder($session_id):bool {
    $result = json_decode(file_get_contents('php://input'));
    executeQuery("UPDATE `cart` SET `cart_status` = 1 WHERE session_id = '{$session_id}'");
    return executeQuery("INSERT INTO `orders` (name, number, mail, session_id) VALUES ('{$result->name}', '{$result->number}', '{$result->email}', '{$session_id}')");
}

function getCart($session_id):array {

    $cart = getAssocResult("SELECT cart.id cart_id, catalog.image, catalog.id catalog_id, catalog.name, catalog.price FROM cart, catalog WHERE cart.good_id=catalog.id AND session_id = '{$session_id}' AND cart_status = 0");

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
    $sql = "INSERT INTO `cart` (good_id, session_id) VALUES ($id, '$session_id')";
    return executeQuery($sql);
}

function deleteFromCart($good_id, $session_id):bool {
    return executeQuery("DELETE FROM `cart` WHERE good_id = '{$good_id}' AND session_id = '{$session_id}' AND cart_status = 0 LIMIT 1");
}