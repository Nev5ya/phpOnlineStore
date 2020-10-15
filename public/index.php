<?php

include $_SERVER['$DOCUMENT_ROOT'] . "../config/config.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

$params = [];
$layout = 'main';

switch ($page) {
	case 'index':
		break;
	case 'gallery':
	
		if(isset($_POST['load'])){
			uploadImage();
		}

		$layout = 'gallery';
		$params['gallery'] = getGallery(IMG_BIG);
		break;
	case 'homework_3':
		$layout = 'homework_3';
		break;
}
// _log($params, 'params');
echo render($page, $params, $layout);