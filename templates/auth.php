<?php if (!$params['auth']): ?>
    <h1>Вход</h1>
        <?php if (isset($_GET['authError'])): ?>
        <p class="auth-error"><?= $_GET['authError'] ?></p>
        <?php endif; ?>
    <form method="POST" class="signIn">
        <input class="feedback__input signIn__input" type="text" name="login" placeholder="Логин" required>
        <input class="feedback__input signIn__input" type="password" name="password" placeholder="Пароль" required>
        <label class="signIn__label">
            <input class="signIn__checkbox" type="checkbox" name="cookie">
            Запомнить
        </label>
        <input class="feedback__button" type="submit" value="Войти" name="auth">
        <a href="/signUp" class="feedback__button signUp">Регистрация</a>
    </form>
<?php else: ?>
    <h1>Добро пожаловать <?= $user ?>!</h1>
    <?php if (empty($params['orders'])): ?>
        <p>У вас пока ни одного заказа ¯\_(ツ)_/¯</p>
    <?php else: ?>
        <h2>Информация о заказах</h2>
        <br>
        <div class="orders-wrapper">
        <?php foreach ($params['orders'] as $order): ?>
            <div class="order-item order-item_flex-start" id="<?=$order['id']?>">
                <p class="order-item__text">Заказ #<i><?=$order['id']?></i></p>
                <p class="order-item__text">Имя заказчика: <?= $order['name'] ?></p>
                <p class="order-item__text">Телефон заказчика: <?= $order['number'] ?></p>
                <p class="order-item__text">Email заказчика:<?= $order['mail'] ?></p>
                <p class="order-item__text">Дата и время заказа: <i><?= $order['date'] ?></i></p>
                <p class="order-item__text">Статус заказа: <?= $order['order_status']?></p>
                <p class="order-item__text">Сумма заказа:&nbsp;<i><?= $order['total_amount'] ?></i> ₽</p>
                <?php if (isAdmin()): ?>
                    <div class="order__buttons-wrapper">
                        <a class="feedback__button" href="/updateOrder/?id=<?= $order['id'] ?>">Редактировать</a>
<!--                        <a class="feedback__button" href="/orderDetails/?id=--><? //= $order['id'] ?><!--">Детали заказа</a>-->
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <script defer type="text/javascript" src="js/service.js"></script>

<?php endif; ?>
