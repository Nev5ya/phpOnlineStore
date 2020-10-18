<?php
define('ROOT', dirname(__DIR__));
define('IMG_BIG', $_SERVER['DOCUMENT_ROOT'] . '/images/gallery_img/big/');
define('IMG_SMALL', $_SERVER['DOCUMENT_ROOT'] . '/images/gallery_img/small/');
define('TEMPLATES_DIR', ROOT . '/templates/');
define('LAYOUTS_DIR', 'layouts/');

/* DB config */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'images');

include ROOT . "/engine/db.php";
include ROOT . "/engine/functions.php";
include ROOT . "/engine/log.php";
include ROOT . "/engine/gallery.php";
include ROOT . "/engine/classSimpleImage.php";