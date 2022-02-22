-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 13 2021 г., 02:03
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int UNSIGNED NOT NULL,
  `good_id` int UNSIGNED NOT NULL COMMENT 'Идентификатор товара',
  `session_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Идентификатор сессии',
  `cart_status` int NOT NULL DEFAULT '0' COMMENT 'Статус заказа в корзине(в корзине/ заказано)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `good_id`, `session_id`, `cart_status`) VALUES
(304, 6, '520der7t6kjs9jvt13v3grmj69s7ql91', 1),
(305, 7, '520der7t6kjs9jvt13v3grmj69s7ql91', 1),
(306, 1, 'n52hg9ske7fsuqs85m66g9phmdpaubtd', 1),
(307, 1, 'n52hg9ske7fsuqs85m66g9phmdpaubtd', 1),
(308, 1, 'n52hg9ske7fsuqs85m66g9phmdpaubtd', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int UNSIGNED NOT NULL COMMENT 'Идентификатор товара',
  `name` varchar(65) NOT NULL COMMENT 'Наименование товара',
  `description` text NOT NULL COMMENT 'Описание товара',
  `price` text NOT NULL COMMENT 'Цена товара',
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Изображение товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Honor 30', 'Смартфон HONOR 30 поддерживает подключение к сети 5G, а также режим работы двух SIM-карт, в котором основная SIM-карта подключена к сети 5G, а вторая SIM-карта — к сетям 4G, 3G и 2G5. Мощный процессор Kirin 985 будет выполнять все задачи быстро и плавно. Безрамочный дисплей с разрешением 2400х1080 порадует вас яркими, сочными красками. Смартфон обладает четырьмя основными камерами 40+8+8+2 Мп, позволяющими делать отличные снимки с 5-кратный оптическим и 10-кратный гибридный зумом, и записывать видео 4К. Фронтальная камера 32 Мп использует алгоритмы украшения на базе искусственного интеллекта.', '31 990', 'honor'),
(2, 'Apple iPhone 11 Pro Max', 'Смартфон Apple iPhone 11 Pro обладает тремя основными камерами 12+12+12 Мп с оптической стабилизацией, позволяющими делать отличные портреты, панорамные и ночные снимки, фотографии с эффектом боке, снимать удалённые объекты, а также записывать видео 4К со скоростью до 60 кад./c. Благодаря фронтальной камере 12 Мп с автоматической стабилизацией изображения и встроенной вспышкой вы сможете делать прекрасные селфи, снимать видео 4К и вести замедленную съёмку со скоростью до 120 кад./c. Процессор A13 Bionic открывает невероятные возможности в области игр, дополненной реальности и др. Благодаря функции распознавания лица Face ID ваши личные данные будут в полной безопасности. Смартфон защищён от пыли и влаги по стандарту IP68, что позволяет погружаться с ним под воду на глубину до 4 м.', '119 990', 'iphone'),
(3, 'Samsung Galaxy Z Fold 2', 'Samsung Galaxy Fold2 - вторая версия инновационной раскладной модели смартфона с двумя экранами: внешним 6.23\" и внутренним гибким 7,6\" с частотой обновления изображения 120 Гц и врезанной фронтальной камерой на 10 Мп. Шарнирный механизм, спрятанный за логотипом Samsung на задней панели, позволяет устройству плавно раскрываться и складываться. Основной модуль камер представлен тремя датчиками по 12 Мп каждый. Оснащен мощным процессором Qualcomm Snapdragon 865+, 12 Гб оперативной и 256 Гб встроенной памятью. Смартфон поддерживает быструю проводную зарядку мощностью 25 Вт, и беспроводную 15 Вт, а заодно способен выполнять роль пауэрбанка, подзаряжая различные аксессуары и другие гаджеты.', '149 990', 'samsung'),
(6, 'OPPO Reno5 Lite', 'OPPO Reno5 Lite обладает 4 основными камерами 48+8+2+2 Мп, позволяющими снимать видео 4К, делать четкие и яркие фотографии, великолепные панорамные снимки, портреты с эффектом боке, вести ночную и макросъёмку. Фронтальная камера 16 Мп позволит вам делать прекрасные селфи. Мощный 8-ядерный процессор обеспечит высокую производительность устройства и позволит играть в современные игры. Дисплей AMOLED с разрешением 2400х1080 и соотношением сторон 20:9 обеспечит яркое и четкое изображение. Сканер отпечатков пальцев и функция распознавания лица надёжно защитят ваши личные данные. Аккумулятор 4220 мАч обеспечит длительное время работы смартфона, а поддержка быстрой зарядки 30 Вт позволит быстро восполнить энергию.', '25 990', 'oppo'),
(7, 'Huawei Mate 40 Pro', 'Huawei Mate 40 Pro обладает четырьмя основными камерами Leica 50+20+12+ToF Мп с оптической стабилизацией и 5-кратным оптическим зумом, позволяющими делать фотографии с высокой детализацией, отличные снимки с эффектом боке и панорамные фотографии, вести съёмку удалённых объектов, а также записывать видео 4К на 60 кадрах в секунду. Благодаря фронтальной камере 13+TоF Мп у вас получатся прекрасные селфи. Смартфон получил новейший процессор Kirin 9000, который обеспечит высокую производительность. Сканер отпечатков пальцев и функция распознавания лица защитят ваши личные данные.', '85 990', 'huawei'),
(8, 'POCO X3 Pro', 'Смартфон POCO X3 Pro оснащен мощным процессором Snapdragon 860, который легко справится с любыми сложными задачами и самыми требовательными играми. Высокоэффективная система охлаждения обеспечит высокую производительность в течении длительного времени. Дисплей 6.67\" с разрешением 2340х1080 и частотой обновления 120 Гц позволит насладиться плавностью картинки в динамичных играх или скроллинге в интернете. Эффект полного погружения создадут встроенные стереодинамики. Система четырех камер 48+8+2+2 Мп позволит делать фотографии с высоким разрешением даже ночью, а так же снимать видео 4К. Основная и селфи камера 20 Мп могут одновременно записывать видео, чтобы запечатлеть происходящее с обеих сторон. Аккумулятор 5160 мАч обеспечит 11 часов игр, 18 часов просмотра видео и 110 часов музыки.', '25 990', 'poco');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL COMMENT 'Идентификатор отзыва',
  `name` varchar(65) NOT NULL COMMENT 'Имя пользователя',
  `feedback` text NOT NULL COMMENT 'Текст отзыва',
  `product_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Идентификатор товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`, `product_id`) VALUES
(40, 'Vladilen', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, exercitationem illo laboriosam minus modi    numquam pariatur placeat tempora unde velit!', 0),
(41, 'Ann', 'Accusamus atque cumque doloremque eaque id in ipsa iure laboriosam libero, maiores modi molestiae molestias nostrum\nnulla obcaecati odio officia placeat quaerat quasi quis repudiandae soluta tenetur unde ut veniam.', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL COMMENT 'Идентификатор изображения',
  `filename` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Название изображения',
  `views` int NOT NULL DEFAULT '0' COMMENT 'Количество просмотров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `filename`, `views`) VALUES
(9, 'n_70.jpg', 8),
(10, 'n_72.jpg', 7),
(11, 'n_73.jpg', 2),
(12, 'n_76.jpg', 0),
(13, 'n_82.jpg', 2),
(14, 'n_95.jpg', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `item_feedback`
--

CREATE TABLE `item_feedback` (
  `id` int UNSIGNED NOT NULL COMMENT 'Идентификатор отзыва',
  `name` varchar(65) NOT NULL COMMENT 'Имя пользователя',
  `feedback` text NOT NULL COMMENT 'Текст отзыва',
  `product_id` int UNSIGNED NOT NULL COMMENT 'Идентификатор товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL COMMENT 'Идентификатор заказа',
  `login` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'not_registered' COMMENT 'Логин пользователя',
  `name` varchar(64) NOT NULL COMMENT 'Имя пользователя',
  `number` text NOT NULL COMMENT 'Номер телефона пользователя',
  `mail` text NOT NULL COMMENT 'E-mail пользователя',
  `session_id` text NOT NULL COMMENT 'Идентификатор сессии',
  `date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Дата и время заказа',
  `order_status` int NOT NULL DEFAULT '1' COMMENT 'Статус заказа',
  `total_amount` text NOT NULL COMMENT 'Сумма заказа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `login`, `name`, `number`, `mail`, `session_id`, `date`, `order_status`, `total_amount`) VALUES
(34, 'nvs', 'Петров Василий Фёдорович', '79152341214', 'petrov_342@yandex.ru', '520der7t6kjs9jvt13v3grmj69s7ql91', '2021-05-14 04:21', 1, '25990'),
(35, 'nvs', 'Петров Василий Фёдорович', '79152341214', 'petrov_342@yandex.ru', '520der7t6kjs9jvt13v3grmj69s7ql91', '2021-05-14 04:32', 1, '85990'),
(36, 'not_registered', 'Volodya', '89998882211', 'volodya@vlds.vs', 'n52hg9ske7fsuqs85m66g9phmdpaubtd', '2021-05-16 21:05', 1, '63980'),
(37, 'admin', 'Nevsen Frmg', '79663452417', 'email@email.com', 'n52hg9ske7fsuqs85m66g9phmdpaubtd', '2021-05-16 21:35', 1, '31990');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL COMMENT 'Идентификатор пользователя',
  `login` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Имя/логин пользователя',
  `full_name` text NOT NULL COMMENT 'Ф.И.О пользователя',
  `phone` text NOT NULL COMMENT 'Телефон пользователя',
  `email` text NOT NULL COMMENT 'Электронная почта пользователя',
  `password` text NOT NULL COMMENT 'Пароль пользователя',
  `hash` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Хэш пароля',
  `role` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Роль пользователя(1 - администратор. 0 - пользователь)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `full_name`, `phone`, `email`, `password`, `hash`, `role`) VALUES
(1, 'admin', 'Adminov Admin Adminovich', '79998887766', 'email@email.com', '$2y$10$04rHAITNtzTMzjScmmsQC.A3vQvT6pwUFe.dX20fk5yw4PEezH3vK', '2066348783608ea98863fcb7.73348521', 1),
(2, 'petrov', 'Петров Василий Фёдорович', '78881112233', 'petrov_123@yandex.ru', '$2y$10$XpOJcKYZLF1Cr3J0Q8j71ekPt110IbRoBHil4CaDPc7USwT0iHlIO', NULL, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `item_feedback`
--
ALTER TABLE `item_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор товара', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор отзыва', AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор изображения', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `item_feedback`
--
ALTER TABLE `item_feedback`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор отзыва';

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор заказа', AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор пользователя', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
