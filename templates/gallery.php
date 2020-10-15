<div class="gallery_wrapper">
<?php foreach ($gallery as $id => $fileName): ?> 
<div class="gallery_block"><img class="gallery_img modal" src="images/gallery_img/big/<?= $fileName ?>" alt="photo" data-id="<?=$id?>"></div>
<? endforeach; ?>
</div>
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