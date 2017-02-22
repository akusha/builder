
--
-- Структура таблицы `acount`
--

CREATE TABLE IF NOT EXISTS `acount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `rec` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `acount`
--

INSERT INTO `acount` (`id`, `name`, `rec`) VALUES
(1, 'карман', ''),
(2, 'карта сбербанк', '');

-- --------------------------------------------------------


--
-- Структура таблицы `kagent`
--

CREATE TABLE IF NOT EXISTS `kagent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `rec` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `kagent`
--

INSERT INTO `kagent` (`id`, `name`, `rec`) VALUES
(1, 'Булат', ''),
(2, 'Автомагазин', '');

-- --------------------------------------------------------


--
-- Структура таблицы `operation`
--

CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `value` int(11) NOT NULL,
  `s_id` int(11) DEFAULT NULL,
  `k_id` int(11) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `operation`
--

INSERT INTO `operation` (`id`, `date`, `value`, `s_id`, `k_id`, `a_id`, `type`, `u_id`) VALUES
(1, '2017-02-01', 1000, 1, 1, 1, -1, NULL),
(2, '2017-02-03', 2500, 1, 2, 2, -1, NULL),
(3, '2017-02-03', 2500, 2, 2, 1, -1, NULL),
(7, '2017-02-09', 1000, 2, 1, 1, 1, NULL),
(6, '2017-02-09', 1500, 1, 2, 1, -1, NULL),
(8, '2017-02-09', 3000, 1, 2, 2, -1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `state`
--

INSERT INTO `state` (`id`, `name`, `type`) VALUES
(1, 'Авто', -1),
(2, 'Связь', -1);

