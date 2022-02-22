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