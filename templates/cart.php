<?php if (empty($cart)): echo 'В корзине ничего нет <br><br> ¯\_(ツ)_/¯'; ?>
<?php else: ?>
<div class="cart">
<?php foreach ($cart as $value): ?>
    <div class="catalog-item_wrapper" id="<?=$value['catalog_id']?>">
        <div class="catalog__item_small catalog__item_hover cart-item">
            <a href="/good/?id=<?=$value['catalog_id']?>" class="catalog__item-link">
                <img class="catalog__item-image" src="images/catalog_img/small/<?= $value['image'] ?>.jpg" alt="catalog-item">
            </a>
            <p class="catalog__item-text"><?= $value['name'] ?></p>
            <p class="catalog__item-text"><?= $value['price'] ?> ₽</p>
            <div class="cart-buttons_wrapper">
                <button class="catalog__item-button feedback__button cart__item-button" data-id="delete">&minus;</button>
                <p class="catalog__item-text cart-counter"><?= $value['count'] ?></p>
                <button class="catalog__item-button feedback__button cart__item-button" data-id="buy">&plus;</button>
            </div>
        </div>
        <hr>
    </div>
<?php endforeach; ?>
    <form method="POST" action="/order" class="checkout" id="checkout">
        <div class="checkout-info">
            <p class="checkout-info__text checkout-info__text_h">Сумма заказа</p>
            <?php foreach ($cart as $value): ?>
                <p class="checkout-info__text" id="checkoutID:<?= $value['catalog_id'] ?>"><b>Стоимость</b> <i><?= $value['name'] ?>: <?= $value['sub_total'] ?> </i>₽</p>
            <?php endforeach; ?>
            <p class="checkout-info__text"><b>Итого к оплате:</b> <i class="total"><?= $total ?> </i>₽</p>
        </div>
        <div class="checkout-buttons_wrapper">
            <input type="text" class="feedback__input checkout__input" placeholder="Ф.И.О" value="<?php if (isset($params['user_info'])) echo $params['user_info']['full_name']; ?>" required>
            <input type="text" class="feedback__input checkout__input" placeholder="7(999)-99-99" required value="<?php if (isset($params['user_info'])) echo $params['user_info']['phone']; ?>">
            <input type="email" class="feedback__input checkout__input" placeholder="E-mail" required value="<?php if (isset($params['user_info'])) echo $params['user_info']['email']; ?>">
            <input class="feedback__button checkout__button" type="submit" data-id="checkout" value="Оформить заказ">
        </div>
    </form>
</div>
<?php endif; ?>
