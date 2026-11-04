-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 04 2026 г., 14:36
-- Версия сервера: 9.6.0
-- Версия PHP: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `заказ`
--

CREATE TABLE `заказ` (
  `ID_заказа` int UNSIGNED NOT NULL,
  `ID_заказчика` int UNSIGNED NOT NULL,
  `Номер договора` varchar(20) NOT NULL,
  `ID_товара` int UNSIGNED NOT NULL,
  `Количество` smallint NOT NULL,
  `Дата заказа` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `заказ`
--

INSERT INTO `заказ` (`ID_заказа`, `ID_заказчика`, `Номер договора`, `ID_товара`, `Количество`, `Дата заказа`) VALUES
(1, 1, 'Д-2024-001', 2, 50, '2024-10-12'),
(2, 2, 'Д-2024-002', 2, 12, '2024-10-03'),
(3, 3, 'Д-2024-003', 3, 8, '2024-10-05'),
(4, 4, 'Д-2024-004', 4, 200, '2024-10-07'),
(5, 1, 'Д-2024-006', 6, 15, '2024-10-12'),
(6, 2, 'Д-2024-007', 7, 40, '2024-10-14'),
(7, 3, 'Д-2024-008', 8, 10, '2024-10-16'),
(9, 1, 'Д-2024-011', 8, 25, '2024-10-22'),
(10, 2, 'Д-2024-012', 4, 6, '2024-10-24'),
(12, 8, 'Д-2024-005', 5, 300, '2024-10-10'),
(13, 8, 'Д-2024-010', 2, 3, '2024-10-20');

-- --------------------------------------------------------

--
-- Структура таблицы `заказчик`
--

CREATE TABLE `заказчик` (
  `ID_заказчика` int UNSIGNED NOT NULL,
  `Наименование` varchar(50) NOT NULL,
  `ИНН` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Юридический адрес` varchar(50) NOT NULL,
  `Контактное лицо` varchar(50) NOT NULL,
  `Телефон` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `заказчик`
--

INSERT INTO `заказчик` (`ID_заказчика`, `Наименование`, `ИНН`, `Юридический адрес`, `Контактное лицо`, `Телефон`, `Email`) VALUES
(1, 'ООО \"СтройРесурс\"', '7701234567', 'г. Москва, ул. Промышленная, д. 18', 'Иванов Алексей Петрович', '+79011112233', 'a.ivanov@stroyresurs.ru'),
(2, 'ИП Смирнова Елена Викторовна', '502912345678', 'г. Химки, ул. Лесная, д. 5, оф. 12', 'Смирнова Елена Викторовна', '+79022223344', 'e.smirnova@mail.ru'),
(3, 'АО \"ПромДеталь\"', '7805678901', 'г. Санкт-Петербург, пр. Энгельса, д. 45', 'Петров Дмитрий Сергеевич', '+79033334455', 'd.petrov@promdetal.spb.ru'),
(4, 'ООО \"ЭкоТранс\"', '3401987654', 'г. Волгоград, ул. Мира, д. 20', 'Соколова Анна Владимировна', '+79044445566', 'a.sokolova@ecotrans.volg.ru'),
(8, 'ИП Козлов Максим Андреевич', '230987654321', 'г. Краснодар, ул. Северная, д. 8, кв. 3', 'Козлов Максим Андреевич', '+79055556677', 'm.kozlov@yandex.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `отгрузка`
--

CREATE TABLE `отгрузка` (
  `ID_отгрузки` int UNSIGNED NOT NULL,
  `ID_товара` int UNSIGNED NOT NULL,
  `Дата отгрузки` date NOT NULL,
  `Количество` smallint UNSIGNED NOT NULL DEFAULT '1',
  `Статус` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `отгрузка`
--

INSERT INTO `отгрузка` (`ID_отгрузки`, `ID_товара`, `Дата отгрузки`, `Количество`, `Статус`) VALUES
(2, 2, '2024-10-07', 12, 'Отгружено'),
(3, 3, '2026-10-10', 8, 'Не отгружено'),
(4, 4, '2024-10-12', 200, 'Отгружено'),
(5, 5, '2026-10-15', 3, 'Не отгружено'),
(6, 6, '2024-10-18', 15, 'Отгружено'),
(7, 7, '2024-10-20', 40, 'Отгружено'),
(8, 8, '2024-10-22', 10, 'Отгружено'),
(10, 1, '2026-10-28', 25, 'Не отгружено'),
(11, 6, '2026-10-29', 50, 'Не отгружено'),
(12, 1, '2026-10-05', 50, 'Не отгружено'),
(13, 10, '2024-10-10', 50, 'Отгружено');

-- --------------------------------------------------------

--
-- Структура таблицы `товар`
--

CREATE TABLE `товар` (
  `ID_товара` int UNSIGNED NOT NULL,
  `Наименование` varchar(50) NOT NULL,
  `Описание` varchar(100) NOT NULL,
  `Цена` smallint NOT NULL,
  `Размер` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `товар`
--

INSERT INTO `товар` (`ID_товара`, `Наименование`, `Описание`, `Цена`, `Размер`) VALUES
(1, 'Цемент М500', 'Мешок цемента', 450, 30),
(2, 'Песок строительный', 'Мешок с песком 50 кг', 350, 32),
(3, 'Щебень фракция 5-20', 'Мешок 40 кг', 480, 35),
(4, 'Арматура А500С', 'Прут 12 мм', 1200, 600),
(5, 'Доска обрезная', 'Сосна, сорт АВ, 25×150 мм', 850, 600),
(6, 'Кирпич керамический', 'Одинарный, полнотелый', 22, 25),
(7, 'Утеплитель минвата', 'Плита 1000×600', 320, 100),
(8, 'Профнастил С8', 'Оцинкованный', 1100, 200),
(10, 'Саморезы кровельные', '4.8×28 мм', 420, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `заказ`
--
ALTER TABLE `заказ`
  ADD PRIMARY KEY (`ID_заказа`),
  ADD KEY `ID_заказчика` (`ID_заказчика`),
  ADD KEY `ID_товара` (`ID_товара`);

--
-- Индексы таблицы `заказчик`
--
ALTER TABLE `заказчик`
  ADD PRIMARY KEY (`ID_заказчика`);

--
-- Индексы таблицы `отгрузка`
--
ALTER TABLE `отгрузка`
  ADD PRIMARY KEY (`ID_отгрузки`),
  ADD KEY `ID_товара` (`ID_товара`);

--
-- Индексы таблицы `товар`
--
ALTER TABLE `товар`
  ADD PRIMARY KEY (`ID_товара`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `заказ`
--
ALTER TABLE `заказ`
  MODIFY `ID_заказа` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `заказчик`
--
ALTER TABLE `заказчик`
  MODIFY `ID_заказчика` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `отгрузка`
--
ALTER TABLE `отгрузка`
  MODIFY `ID_отгрузки` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `товар`
--
ALTER TABLE `товар`
  MODIFY `ID_товара` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `заказ`
--
ALTER TABLE `заказ`
  ADD CONSTRAINT `заказ_ibfk_1` FOREIGN KEY (`ID_заказчика`) REFERENCES `заказчик` (`ID_заказчика`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `заказ_ibfk_2` FOREIGN KEY (`ID_товара`) REFERENCES `товар` (`ID_товара`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `отгрузка`
--
ALTER TABLE `отгрузка`
  ADD CONSTRAINT `отгрузка_ibfk_1` FOREIGN KEY (`ID_товара`) REFERENCES `товар` (`ID_товара`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
