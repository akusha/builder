-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 09 2017 г., 20:36
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
(2, 2, '500', '2017-01-06', 0, 0),
(3, 3, '3500', '2017-01-15', 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `name`, `adress`, `start`, `finish`) VALUES
(1, 'ремонт', '', '0000-00-00', '0000-00-00'),
(2, 'тюнинг', '', '0000-00-00', '0000-00-00');

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
  `mail` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `log` (`log`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `log`, `pass`, `fam`, `im`, `nic`, `tel`, `mail`) VALUES
(1, 'akusha', '999', NULL, '', NULL, NULL, NULL),
(2, 'daisha', '888', NULL, '', NULL, NULL, NULL),
(3, 'joy', '666', NULL, NULL, 'cazino', NULL, ''),
(4, 'jony', '777', NULL, NULL, '777', NULL, ''),
(5, 'akusha260', '6163', NULL, NULL, 'nitti', NULL, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `work_id`, `nic`, `fam`, `name`, `tel`, `mail`) VALUES
(1, NULL, 'cazino', 'Магомедов', 'Магомед', '896345698213', 'akusha@mail.com'),
(2, NULL, 'Gas', 'Гасайниев', 'Гасан', '895123458796', 'donkihot@mail.ru');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
