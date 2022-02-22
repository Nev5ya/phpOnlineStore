<?php
/* Define the main system constants */
define("ROOT", dirname(__DIR__));
define('IMG_BIG', $_SERVER['DOCUMENT_ROOT'] . '/images/gallery_img/big/');
define('IMG_SMALL', $_SERVER['DOCUMENT_ROOT'] . '/images/gallery_img/small/');
const TEMPLATES_DIR = ROOT . '/templates/';
const LAYOUTS_DIR = 'layouts/';

/* DB config */
const HOST = 'localhost';
const USER = 'root';
const PASS = 'root';
const DB = 'php1';

/* Including engine libraries*/
include ROOT . "/engine/db.php";
include ROOT . "/engine/functions.php";
include ROOT . "/engine/log.php";
include ROOT . "/engine/gallery.php";
include ROOT . "/engine/catalog.php";
include ROOT . "/engine/calculator.php";
include ROOT . "/engine/classSimpleImage.php";
include ROOT . "/engine/feedback.php";
include ROOT . "/engine/auth.php";
include ROOT . "/engine/service.php";