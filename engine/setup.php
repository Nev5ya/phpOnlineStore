<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// define('IMG_BIG', ROOT . '/images/gallery_img/big');

define('IMG', $_SERVER['DOCUMENT_ROOT'] . '/public/images/gallery_img/big/');

// include ROOT . "/config/config.php";


$db = mysqli_connect('localhost', 'root', 'root', 'php1');
$res = mysqli_query($db, "SELECT * FROM `gallery`");

if ($res->num_rows == 0) {
	echo "Таблица пустая. Заполнение данными об изображениях";
	$imgs = scandir(IMG);
	$images = array_splice($imgs, 2);
	mysqli_query($db, "INSERT INTO `gallery`(`filename`) VALUES ('" . implode("'),('", $images) . "')");
} else {
	echo "Таблица заполнена";
}