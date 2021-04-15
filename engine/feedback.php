<?php

function getAllFeedback():array{
    $sql = "SELECT * FROM `feedback` ORDER BY id";
    return getAssocResult($sql);
}

function feedbackAction($action = '') {
    switch ($action) {
        case 'create':
            $data = readFeedback();
            $id = createFeedback($data->name, $data->feedback);

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
            $data = readFeedback();
            $response = updateFeedback($data);
            echo json_encode(['updated' => $response]);
            break;

        case 'delete':
            $data = json_decode(file_get_contents('php://input'));
            $response = deleteFeedback($data);
            echo json_encode(['deleted' => $response]);
            break;
    }
    die();
}

function createFeedback($name, $feedback) {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $name)));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $feedback)));
    $sql = "INSERT INTO `feedback` (`name`, `feedback`) VALUES ('{$name}', '{$feedback}');";
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