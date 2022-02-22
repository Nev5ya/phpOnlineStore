<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
$url_array = explode('/', $_SERVER['REQUEST_URI']);

$action = $url_array[2];
if ($url_array[1] == '') {
	$page = 'index';
} else {
	$page = $url_array[1];
}
$params = prepareVariables($page, $action);
echo render($page, $params);

//todo-1 [order-details] осталась проблема с корзиной по причине плохой проектировки и невозможности идентифицировать и сопоставить
// конкретную корзину с конкретным пользователем, откуда вытекает проблема в административном плане просмотра товаров
// в корзине , а также переиспользование и редактирование оной

//todo-2 split admin panel from auth page