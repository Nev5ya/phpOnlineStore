<h1>Каталог</h1>
<div class="catalog">
<?php foreach ($catalog as $value): ?>
    <div class="catalog__item_small catalog__item_hover" id="<?=$value['id']?>">
        <a href="/good/?id=<?=$value['id']?>" class="catalog__item-link">
            <img class="catalog__item-image" src="images/catalog_img/small/<?= $value['image'] ?>.jpg" alt="catalog-item">
        </a>
        <p class="catalog__item-text"><?= $value['name'] ?></p>
        <p class="catalog__item-text">Цена:&nbsp;<?= $value['price'] ?> ₽</p>
        <button class="catalog__item-button feedback__button" data-id="buy">Купить</button>
    </div>
<?php endforeach; ?>
</div>