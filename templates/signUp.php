<h1>Регистрация</h1>
<?php if (!$params['signUp']): ?>
<p class="signUp-errors"><?= $params['error'] ?></p>
<form method="POST" class="signIn signUp">
    <input class="feedback__input signIn__input" type="text" name="login" placeholder="Логин" value="<?= $_POST['login'] ?>" required>
    <input class="feedback__input signIn__input" type="text" name="full_name" placeholder="Ф.И.О" value="<?= $_POST['full_name'] ?>" required>
    <input class="feedback__input signIn__input" type="password" name="password" placeholder="Пароль" required>
    <input class="feedback__input signIn__input" type="password" name="password_confirm" placeholder="Подтверждение пароля" required>
    <input class="feedback__input signIn__input" type="text" name="phone" placeholder="Телефон" value="<?= $_POST['phone'] ?>" required>
    <input class="feedback__input signIn__input" type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?>" required>
    <input class="feedback__button signUp__button signUp_align" type="submit" value="Зарегистрироваться" name="signUp">
</form>
<?php else: ?>
    <br>
    <h1>Вы успешно зарегистрировались!</h1>
    <br>
    <br>
    <a href="/auth" class="feedback__button">В кабинет</a>
<?php endif; ?>
