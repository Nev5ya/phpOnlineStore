<?php

function prepareVariables($page){
    $params['layout'] = 'main';
    switch ($page) {

        case 'image':
            $params['layout'] = 'gallery';
            $params['image'] = getOneImage((int)$_GET['id']);
            break;

        case 'addLike':
            $params['layout'] = 'gallery';
            addLikes((int)$_GET['id']);
            break;

        case 'gallery':
        
            if(isset($_POST['load'])){
                uploadImage();
            }

            $params['layout'] = 'gallery';
            $params['gallery'] = getGallery(IMG_BIG);
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
            'menu' => renderTemplate('menu'),
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