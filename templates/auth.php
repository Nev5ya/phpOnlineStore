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
    </form>
<?php else: ?>

<h1>Добро пожаловать <?= $user ?>!</h1>
    <p>Сделать админ панель</p>

    <script defer type="text/javascript" src="js/service.js"></script>

<?php endif; ?>
