-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 07 2020 г., 22:35
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
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
