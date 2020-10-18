<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// define('IMG_BIG', ROOT . '/images/gallery_img/big');

define('IMG', $_SERVER['DOCUMENT_ROOT'] . '/public/images/gallery_img/big/');

// include ROOT . "/config/config.php";


$db = mysqli_connect('localhost', 'root', 'root', 'images');
$res = mysqli_query($db, "SELECT * FROM `images_info`");

if ($res->num_rows == 0) {
	echo "Таблица пустая. Заполнение данными об изображениях";
//INSERT INTO `images_info`(`filename`) VALUES
	$images = array_splice(scandir(IMG), 2);
	mysqli_query($db, "INSERT INTO `images_info`(`filename`) VALUES ('" . implode("'),('", $images) . "')");
} else {
	echo "Таблица заполнена";
}