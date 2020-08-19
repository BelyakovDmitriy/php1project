-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 19 2020 г., 08:25
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson8`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id_basket` int NOT NULL,
  `id_goods` int NOT NULL,
  `qantity` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `category_goods`
--

CREATE TABLE `category_goods` (
  `id_category` int NOT NULL,
  `name_category` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `category_goods`
--

INSERT INTO `category_goods` (`id_category`, `name_category`) VALUES
(0, 'Футболка'),
(1, 'Брюки'),
(2, 'Кофта'),
(3, 'Кепка');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id_goods` int NOT NULL,
  `name_goods` varchar(128) COLLATE utf8_bin NOT NULL,
  `description_goods` varchar(512) COLLATE utf8_bin NOT NULL,
  `price_goods` decimal(10,2) NOT NULL,
  `id_category` int NOT NULL,
  `view_goods` int NOT NULL,
  `sale_goods` int NOT NULL,
  `date_goods` date NOT NULL,
  `image_goods` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id_goods`, `name_goods`, `description_goods`, `price_goods`, `id_category`, `view_goods`, `sale_goods`, `date_goods`, `image_goods`) VALUES
(1, 'Товар №1', 'Описание товара №1', '100.00', 0, 3, 15, '2020-08-10', ''),
(3, 'Товар №2', 'Описание товара №2', '200.00', 1, 10, 0, '2020-08-01', ''),
(4, 'Товар №3', 'Описание товара №3', '300.00', 2, 11, 20, '2020-07-01', ''),
(5, 'Товар №4', 'Описание товара №4', '400.00', 3, 1, 0, '2020-08-03', ''),
(6, 'Товар №5', 'Описание товара №5', '500.00', 0, 0, 30, '2020-01-01', ''),
(7, 'Товар №6', 'Описание товара №6', '300.00', 1, 10, 0, '2020-08-01', ''),
(8, 'Товар №7', 'Описание товара №7', '200.00', 2, 5, 10, '2020-03-01', ''),
(9, 'Товар №8', 'Описание товара №8', '500.00', 3, 20, 0, '2020-08-01', ''),
(10, 'Товар №9', 'Описание товара №9', '100.00', 0, 10, 0, '2020-08-01', ''),
(11, 'Товар №10', 'Описание товара №10', '400.00', 1, 10, 0, '2020-06-01', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_users` int NOT NULL,
  `users` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_users`, `users`, `password`) VALUES
(1596383347, 'mr.dim', '$2y$09$7O/.2DWVJA5WrC/FC.72r.wAuWDdnhemLBh4ilGyGoRIdGuZmQEQK'),
(1596383348, 'mr.dim2', '$2y$09$WJo.Wi/OJ.UyBMyaoQYhs.zl.0Ep7LJKB2VG1qAAvHWFFV6hAJaaS');

-- --------------------------------------------------------

--
-- Структура таблицы `users_auth`
--

CREATE TABLE `users_auth` (
  `id_users` int NOT NULL,
  `id_users_session` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_agent` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `users_auth`
--

INSERT INTO `users_auth` (`id_users`, `id_users_session`, `user_agent`, `date`) VALUES
(1596383347, '$2y$09$mT4Xl1rCn2JPYKBOuH8LjOhOSf6eZvj0ERWczUZQkNN4XTjZzTxjC', '$2y$09$1.0kzDVw8Vs1cjQf9KoKSOAjGCEtnpZhA3K3VtLf.1nDCfBhaNfkO', '2020-08-10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id_basket`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id_goods`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id_basket` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id_goods` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
