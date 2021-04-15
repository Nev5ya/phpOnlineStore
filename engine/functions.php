<?php

function prepareVariables($page, $action):array{
    $params['layout'] = 'main';
    switch ($page) {

        case 'image':
            $params['layout'] = 'catalog';
            $params['image'] = getOneImage((int)$_GET['id']);
            break;

        case 'addLike':
            $params['layout'] = 'catalog';
            addLikes((int)$_GET['id']);
            break;

        case 'catalog':
            if(isset($_POST['load'])){
                $params['errors'] = uploadImage();
            }
            $params['layout'] = 'catalog';
            $params['catalog'] = getCatalog();
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
