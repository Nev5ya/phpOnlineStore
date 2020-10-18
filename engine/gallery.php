<?php
function getGallery($path){
	return getAssocResult("SELECT * FROM `images_info` ORDER BY views DESC");
}

function getOneImage($id){
	return getAssocResult("SELECT * FROM `images_info` WHERE id = {$id}")[0];
}

function addLikes($id){
	executeQuery("UPDATE `images_info` SET views = views + 1 WHERE id = {$id}");
}

function uploadImage(){
	$path_big = IMG_BIG . $_FILES['image']['name'];
	$path_small = IMG_SMALL . $_FILES['image']['name'];

	$image_info = getimagesize($_FILES['image']['tmp_name']);

	if ($image_info['mime'] != 'image/png' && $image_info['mime'] != 'image/gif' && $image_info['mime'] != 'image/jpeg') {
		echo "Можно загружать только jpg/png/gif/jpeg - файлы<br>";
		exit;
	}

	if ($_FILES['image']['size'] > 1024 * 5 * 1024) {
		echo "Размер файла не более 5 Мб<br>";
		exit;
	}

	$blacklist = ['.php', '.phtml', '.php3', '.php4'];
	foreach ($blacklist as $item) {
		if(preg_match("/$item\$/i", $_FILES['image']['name'])){
			echo "Загрузка php-файлов запрещена<br>";
			exit;
		}
	}

	if (move_uploaded_file($_FILES['image']['tmp_name'], $path_big)) {

		$filename = mysqli_real_escape_string(getDb(), $_FILES['image']['name']);
		executeQuery("INSERT INTO `images_info` (`filename`) VALUES ('{$filename}')");

		$image = new SimpleImage();
		$image->load($path_big);
		$image->resizeToWidth(250);
		$image->save($path_small);
		header("Location: /gallery");
	} else {
		echo "Ошибка ресайза файла<br>";
	}
}