<?php

function getAllFeedback($product_id = 0):array{
    return getAssocResult("SELECT * FROM `feedback` WHERE product_id = $product_id ORDER BY id");
}

function feedbackAction($action) {
    $data = readFeedback();
    switch ($action) {
        case 'create':
            $id = createFeedback($data->name, $data->feedback, $data->good_ID);
            $response = [
                'id' => $id,
                'name' => $data->name,
                'feedback' => $data->feedback
            ];

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'read':
            echo json_encode(getOneFeedback(), JSON_UNESCAPED_UNICODE);
            break;

        case 'update':
            $response = updateFeedback($data);
            echo json_encode(['updated' => $response]);
            break;

        case 'delete':
            $response = deleteFeedback($data);
            echo json_encode(['deleted' => $response]);
            break;
    }
    die();
}

function createFeedback($name, $feedback, $product_id) {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $name)));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $feedback)));
    $sql = "INSERT INTO `feedback` (`name`, `feedback`, `product_id`) VALUES ('{$name}', '{$feedback}', '{$product_id}');";
    executeQuery($sql);
    return mysqli_insert_id(getDb());
}

function readFeedback() {
    return json_decode(file_get_contents('php://input'));
}

function updateFeedback($data):bool {
    return executeQuery("UPDATE `feedback` SET `name` = '{$data->name}', `feedback` = '{$data->feedback}' WHERE `feedback`.`id` = {$data->id}");
}

function deleteFeedback($id):bool {
    $id = (INT)$id;
    return executeQuery("DELETE FROM `feedback` WHERE `feedback`.`id` = {$id}");
}

function getOneFeedback():array {
    $id = (INT)json_decode(file_get_contents('php://input'));
    $sql = "SELECT * FROM feedback WHERE id = {$id}";
    return getAssocResult($sql)[0];

}