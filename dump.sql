-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2017 г., 12:48
-- Версия сервера: 5.7.16
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `math`
--
CREATE DATABASE IF NOT EXISTS `math` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `math`;

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id_city` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `city` char(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id_city`, `id_country`, `city`) VALUES
(1, 1, 'Kiev'),
(2, 1, 'Dnipro'),
(3, 1, 'Odessa'),
(4, 4, 'Moscow'),
(5, 4, 'Perm'),
(6, 3, 'Minsk'),
(7, 3, 'Borisov'),
(8, 2, 'Warshav'),
(9, 2, 'Zakopane'),
(10, 1, 'New'),
(11, 6, 'Kishinev');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE `country` (
  `id_country` int(11) NOT NULL,
  `country` char(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id_country`, `country`) VALUES
(1, 'Ukraine'),
(2, 'Poland'),
(3, 'Belarus'),
(4, 'Russia'),
(5, 'Germany'),
(6, 'Moldova'),
(9, 'Neww');

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE `language` (
  `id_language` int(11) NOT NULL,
  `language` char(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id_language`, `language`) VALUES
(1, 'Ukranian'),
(2, 'Russian'),
(3, 'Belorussian'),
(4, 'Polish'),
(5, 'English'),
(8, 'afrol');

-- --------------------------------------------------------

--
-- Структура таблицы `talk`
--

CREATE TABLE `talk` (
  `id` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `talk`
--

INSERT INTO `talk` (`id`, `id_country`, `id_city`, `id_language`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 5),
(4, 1, 2, 1),
(5, 1, 3, 1),
(6, 2, 8, 4),
(7, 2, 9, 4),
(8, 2, 8, 5),
(9, 3, 6, 3),
(10, 3, 6, 2),
(11, 3, 6, 5),
(12, 3, 7, 3),
(13, 4, 4, 2),
(14, 4, 5, 2),
(15, 4, 4, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `email`, `name`, `password`) VALUES
(1, 'pavel@gmail.com', 'pavel', '69572c2c210fce608e4269c0e537f749');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`);

--
-- Индексы таблицы `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id_country`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id_language`);

--
-- Индексы таблицы `talk`
--
ALTER TABLE `talk`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `country`
--
ALTER TABLE `country`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
  MODIFY `id_language` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `talk`
--
ALTER TABLE `talk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
