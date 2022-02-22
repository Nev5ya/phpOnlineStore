<?php

function prepareVariables($page, $action):array{
    $params['layout'] = 'main';
    $params['session_id'] = session_id();
    $params['count'] = getAllCartItemsCount($params['session_id']);

    if (isAuth()) {
        $params['auth'] = true;
        $params['user'] = getUser();
    }

//    $tableAlias = explode('/', $_SERVER['HTTP_REFERER'])[3];
//    $tableName = ['image' => 'item_feedback', 'feedback' => 'feedback'];
    switch ($page) {

        case 'auth':
            $params['layout'] = 'auth';
            if (isAdmin()) {
                $params['orders'] = getAllOrders();
            } else {
                if (isset($params['user'])) {
                    $params['orders'] = getOrdersByLogin($params['user']);
                }
            }
            break;

//todo [order-details]

//        case 'orderDetails':
//            $orderID = (INT)$_GET['id'];
//            $params['orderDetails'] = getOrderDetails($orderID, $params['user']);
//            break;

        case 'updateOrder':
            $id = (INT)$_GET['id'];
            if (isAdmin()) {
                $params['order'] = getOneOrder($id);
            }
            if (!empty($_POST) && isAdmin()) {
                $params['updated'] = updateOrderInfo($_POST);
            }
            break;

        case 'signUp':
            if (!empty($_POST)) {
                $params['error'] = validateData($_POST);
                if (!$params['error']) {
                    $params['signUp'] = signUp($_POST);
                }
            }
            break;

        case 'catalog':
            $params['layout'] = 'catalog';
            $params['catalog'] = getCatalog();
            break;

        case 'good':
            $id = (INT)$_GET['id'];
            $params['layout'] = 'catalog';
            $params['good'] = getOneGood($id);
            $params['feedback'] = getAllFeedback($id);
            break;

        case 'cart':
            $params['layout'] = 'catalog';
            $params['cart'] = getCart($params['session_id']);
            $params['total'] = getTotalPrice($params['cart']);
            if (isset($params['user'])) {
                $params['user_info'] = getAuthorizedUserInfo($params['user']);
            }
            break;

        case 'cartapi':
            cartAction($action, $params['session_id'], $params['user']);
            break;

        case 'image':
            $params['layout'] = 'gallery';
            $params['image'] = getOneImage((int)$_GET['id']);
//            $params['tableName'] = getAllFeedback('item_feedback');
            break;

        case 'addLike':
            $params['layout'] = 'catalog';
            addLikes((int)$_GET['id']);
            break;

        case 'gallery':
            if(isset($_POST['load'])){
                $params['errors'] = uploadImage();
            }
            $params['layout'] = 'gallery';
            $params['gallery'] = getGallery();
            break;

        case 'feedback':
            $params['layout'] = 'feedback';
            $params['feedback'] = getAllFeedback();
            break;

        case 'feedbackapi':
            feedbackAction($action);
            break;

        case 'calculator':
            if (!empty($_POST['output'])) {
                $params['output'] = parseOperations($_POST['output']);
            }
            $params['layout'] = 'calculator';
            break;

        case 'homework_3':
            $params['layout'] = 'homework_3';
            break;
    }
    return $params;
}

function render($page, $params){
    return renderTemplate(LAYOUTS_DIR . $params['layout'], [
            'content' => renderTemplate($page, $params),
            'menu' => renderTemplate('menu', $params),
        ]
    );
}

function renderTemplate($page, $params = []){
    ob_start();

    if (!is_null($params))
        extract($params);

    $fileName = TEMPLATES_DIR . $page . ".php";

    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die("Страницы {$fileName} не существует.");
    }

    return ob_get_clean();
}
