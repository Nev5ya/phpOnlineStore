<div class="catalog__item_small catalog__item_big" id="<?=$good['id']?>">
    <a href="/good/?id=<?=$good['id']?>" class="catalog__item-link">
        <img class="catalog__item-image" src="../images/catalog_img/big/<?= $good['image'] ?>.jpg" alt="catalog-item">
    </a>
    <div class="catalog__item_side-wrapper">
        <p class="catalog__item-text"><?= $good['name'] ?></p>
        <p class="catalog__item-text catalog__item-text_left"><?= $good['description'] ?></p>
        <p class="catalog__item-text">Цена:&nbsp;<?= $good['price'] ?> р</p>
        <button class="catalog__item-button feedback__button" data-id="buy">Купить</button>
    </div>
</div>
<br>
<br>
<h1>Отзывы</h1>
<div class="feedback-wrapper">
    <div class="feedback">
        <input required class="feedback__input" type="text" placeholder="Введите имя" value="">
        <textarea required class="feedback__input feedback__input_textarea" placeholder="Ваш отзыв"></textarea>
        <button class="feedback__button" type="button" id="create">Отправить</button>
    </div>
    <div class="feedback-side <?php if (empty($feedback)) echo 'feedback-side_display'; ?>">
        <?php foreach ($feedback as $value): ?>
            <div class="feedback-side__item" id='<?= $value['id'] ?>'>
                <p class="feedback-side__p"><?= $value['name'] ?></p>
                <p class="feedback-side__p"><?= $value['feedback'] ?></p>
                <div class="feedback-button_wrapper">
                    <button class="feedback-side__button feedback__button" id="read">&#9998;</button>
                    <button class="feedback-side__button feedback__button" id="delete">&#10008;</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script defer type="text/javascript" src="../js/feedback.js"></script>