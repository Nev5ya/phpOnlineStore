<?php
function getGallery($path){
	return $images = array_splice(scandir($path), 2);
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
		
		$image = new SimpleImage();
		$image->load($path_big);
		$image->resizeToWidth(250);
		$image->save($path_small);
		header("Location: /?page=gallery");
	} else {
		echo "Ошибка ресайза файла<br>";
	}
}