-- Дамп структуры для таблица app.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы app.categories: ~3 rows (приблизительно)
INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Мониторы'),
(2, 'Ноутбуки'),
(3, 'Смартфоны');

-- Дамп структуры для таблица app.goods
DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(50) NOT NULL,
    `price` varchar(50) NOT NULL,
    `category_id` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы app.goods: ~3 rows (приблизительно)
INSERT INTO `goods` (`id`, `title`, `price`, `category_id`) VALUES
(1, 'Lenovo', '100', 2),
(2, 'Samsung', '200', 2),
(3, 'Apple', '1000', 2);

-- Дамп структуры для таблица app.history
DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL DEFAULT 0,
    `url` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица app.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned DEFAULT NULL,
    `date` timestamp NULL DEFAULT current_timestamp(),
    `status` int(10) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица app.orders_goods
DROP TABLE IF EXISTS `orders_goods`;
CREATE TABLE IF NOT EXISTS `orders_goods` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `order_id` int(10) unsigned NOT NULL,
    `good_id` int(10) unsigned NOT NULL,
    `price` varchar(50) NOT NULL,
    `count` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица app.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `login` varchar(50) DEFAULT NULL,
    `pass` varchar(60) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы app.users: ~4 rows (приблизительно)
INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(1, 'root', '$2y$10$c7GOr5zRtGT5unEDek7OI.LTlP1Aa2DX7wPQe9xZZEPxWaJYlOfDC'),
(2, 'admin', '$2y$10$db5ZWgJmoD53rLR/a9Bbh.GENw3DiHgk1B9FB6VKTd3UqFticQdvq'),
(5, 'content', '$2y$10$rgnMCsa5ttKisZzzrPinR.KMoFLCq2eVcP9iCOFeIWjzcgkwMnC0G'),
(6, 'user', '$2y$10$fVGMMnQIylGbcNLx.rf7w.rSs061jBV1t7YlefmF.BKdzkmHWt10O');

-- Дамп структуры для таблица app.users_roles
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL DEFAULT 0,
    `role` int(10) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы app.users_roles: ~4 rows (приблизительно)
INSERT INTO `users_roles` (`id`, `user_id`, `role`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 5, 2),
(4, 2, 2);
