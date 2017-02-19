-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 18 2017 г., 21:17
-- Версия сервера: 5.1.62-community
-- Версия PHP: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `acount`
--

CREATE TABLE IF NOT EXISTS `acount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `rec` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `acount`
--

INSERT INTO `acount` (`id`, `name`, `rec`) VALUES
(1, 'карман', ''),
(2, 'карта сбербанк', '');

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_ob` int(4) NOT NULL,
  `nic` varchar(30) CHARACTER SET utf8 NOT NULL,
  `DATE` date NOT NULL,
  `star` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`ID`, `id_ob`, `nic`, `DATE`, `star`, `hour`) VALUES
(1, 1, '1000', '2017-01-04', 0, 0),
(2, 2, '500', '2017-01-06', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `kagent`
--

CREATE TABLE IF NOT EXISTS `kagent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `rec` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `kagent`
--

INSERT INTO `kagent` (`id`, `name`, `rec`) VALUES
(1, 'Булат', ''),
(2, 'Автомагазин', '');

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `adress` text NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `name`, `adress`, `start`, `finish`) VALUES
(1, 'крыша умбалая', 'Малыгина', '2015-11-30', '2015-12-31'),
(3, 'крыша 007', 'Череповецк', '2016-03-25', '2016-05-12'),
(4, 'колодец', 'акуша', '2017-01-11', '2017-01-22'),
(5, 'беседка', 'Шамхал_15', '2016-03-25', '2016-05-12');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `state`
--

INSERT INTO `state` (`id`, `name`, `type`) VALUES
(1, 'Авто', -1),
(2, 'Связь', -1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` varchar(30) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `fam` varchar(30) DEFAULT NULL,
  `im` varchar(30) DEFAULT NULL,
  `nic` varchar(30) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `log` (`log`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `log`, `pass`, `fam`, `im`, `nic`, `tel`, `mail`) VALUES
(1, 'akusha', 'b706835de79a2b4e80506f582af3676a', NULL, '', NULL, NULL, NULL),
(4, 'jony', 'f1c1592588411002af340cbaedd6fc33', NULL, NULL, '777', NULL, NULL),
(5, 'akusha260', 'a6e4f250fb5c56aaf215a236c64e5b0a', NULL, NULL, 'nitti', NULL, NULL),
(6, 'petro', 'e3e330499348f791337e9da6b534a386', NULL, NULL, 'petrosyan', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE IF NOT EXISTS `workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_id` int(11) DEFAULT NULL,
  `nic` varchar(30) NOT NULL,
  `fam` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `mail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `work_id`, `nic`, `fam`, `name`, `tel`, `mail`) VALUES
(1, NULL, 'mmk', 'Магомедов', 'Магомед', '896345698213', 'akusha@mail.com'),
(2, NULL, 'Gas', 'Гасайниев', 'Гасан', '895123458796', 'donkihot@mail.ru');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
