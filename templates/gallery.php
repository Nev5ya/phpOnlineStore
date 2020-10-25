<div class="gallery_wrapper">
	<?php foreach ($gallery as $item): ?> 
		<div class="gallery_block">
			<img class="gallery_img modal" src="images/gallery_img/big/<?= $item['filename'] ?>" alt="photo">
			<div class="gallery_img-text_wrapper">
				<a href="/image/?id=<?= $item['id'] ?>" class="gallery_img-full_view gallery_img-text_block">Полный размер</a>
				<a href="/addLike/?id=<?= $item['id'] ?>" class="gallery_img-vote gallery_img-text_block">Голосовать</a>
			</div>
			<span class="image-views"><?= $item['views'] ?></span>
		</div>
	<? endforeach; ?>
</div>
<p class="error"><?= $errors ?></p>
<form method="POST" enctype="multipart/form-data" class="upload_image">
	<div class="form-group">
	  <label class="label">
	    <i class="material-icons">attach_file</i>
	    <span class="title">Загрузить изображение</span>
	    <input type="file" name="image" />
	  </label>
	</div>
	<input type="submit" name="load" value="Загрузить" class="submit_button">
</form>