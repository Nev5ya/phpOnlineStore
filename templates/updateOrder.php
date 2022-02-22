<?php if (!isset($params['updated'])): ?>
<form method="POST" class="order-item">
    <input type="hidden" name="id" value="<?=$order['id']?>">
    <p class="order-item__text">Заказ #<i><?=$order['id']?></i></p>
    <label class="order-item__text">Имя заказчика:
        <input type="text" name="name" class="feedback__input checkout__input order-item__input" value="<?= $order['name'] ?>">
    </label>

    <label class="order-item__text">Телефон заказчика:
        <input type="text" name="number" class="feedback__input checkout__input order-item__input" value="<?= $order['number'] ?>">
    </label>

    <label class="order-item__text">Email заказчика:
        <input type="email" name="email" class="feedback__input checkout__input order-item__input" value="<?= $order['mail'] ?>">
    </label>
    <p class="order-item__text">Дата и время заказа: <i><?= $order['date'] ?></i></p>
    <label class="order-item__text">Статус заказа:
        <select name="status" id="status" class="feedback__input">
            <option <?php if ($order['order_status'] == 0)  echo 'selected';?> value="0">Заказ отменен</option>
            <option <?php if ($order['order_status'] == 1) echo 'selected';?> value="1">Заказ принят</option>
            <option <?php if ($order['order_status'] == 2) echo 'selected';?> value="2">Заказ в обработке</option>
            <option <?php if($order['order_status'] == 3) echo 'selected';?> value="3">Заказ отправлен</option>
            <option <?php if($order['order_status'] == 4) echo 'selected';?> value="4">Заказ завершен</option>
        </select>
    </label>
    <p class="order-item__text">Сумма заказа:&nbsp;<i><?= $order['total_amount'] ?></i> ₽</p>
    <input class="feedback__button" data-id="updateOrder" type="submit" value="Сохранить">
</form>
<?php else: ?>
    <br>
    <br>
    <h1>Сохранено!</h1>
    <br>
    <a href="/auth" class="feedback__button">Назад</a>
<?php endif; ?>
