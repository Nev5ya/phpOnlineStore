<?php
function getCatalog():array{
	return getAssocResult("SELECT * FROM `catalog` ORDER BY views DESC");
}

function getOneImage($id){
	return getAssocResult("SELECT * FROM `catalog` WHERE id = {$id}")[0];
}

function addLikes($id){
	executeQuery("UPDATE `catalog` SET views = views + 1 WHERE id = {$id}");
}

function uploadImage():string{
	$path_big = IMG_BIG . $_FILES['image']['name'];
	$path_small = IMG_SMALL . $_FILES['image']['name'];

	$image_info = getimagesize($_FILES['image']['tmp_name']);

	if ($image_info['mime'] != 'image/png' && $image_info['mime'] != 'image/gif' && $image_info['mime'] != 'image/jpeg') {
		return "Можно загружать только jpg/png/gif/jpeg - файлы";
	}

	if ($_FILES['image']['size'] > 1024 * 5 * 1024) {
		return "Размер файла не более 5 Мб";
	}

	$blacklist = ['.php', '.phtml', '.php3', '.php4'];
	foreach ($blacklist as $item) {
		if(preg_match("/$item\$/i", $_FILES['image']['name'])){
			return "Загрузка php-файлов запрещена";
		}
	}

	if (move_uploaded_file($_FILES['image']['tmp_name'], $path_big)) {

		$filename = mysqli_real_escape_string(getDb(), $_FILES['image']['name']);
		executeQuery("INSERT INTO `catalog` (`filename`) VALUES ('{$filename}')");

		$image = new SimpleImage();
		$image->load($path_big);
		$image->resizeToWidth(250);
		$image->save($path_small);
		header("Location: /catalog");
	} else {
		return "Ошибка ресайза файла";
	}
}