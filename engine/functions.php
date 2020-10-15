<?php

function render($page, $params = [], $layout = 'main'){
    return renderTemplate(LAYOUTS_DIR . $layout, [
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