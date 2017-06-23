CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(333) NOT NULL,
  `description` text default '',
  `price` decimal(8,2) unsigned NOT NULL,
  `weight` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--
INSERT INTO `product` (`name`, `description`, `price`, `weight`, `width`, `height`) VALUES
  ('Продукт 1', 'опсание', 12.3, 22, 7, 12),
  ('Продукт 2', 'опание длиннее', 10, 12, 14, 14),
  ('Продукт 3', 'ещё большее описание', 1.376, 53, 22, 18);
