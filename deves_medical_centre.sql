-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Січ 05 2026 р., 15:20
-- Версія сервера: 10.4.32-MariaDB
-- Версія PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `deves_medical_centre`
--

-- --------------------------------------------------------

--
-- Структура таблиці `admin`
--

CREATE TABLE `admin` (
  `NameAdmin` varchar(255) NOT NULL,
  `PasswordAdmin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `admin`
--

INSERT INTO `admin` (`NameAdmin`, `PasswordAdmin`) VALUES
('Колесів Анна Денисівна', 'anna123');

-- --------------------------------------------------------

--
-- Структура таблиці `analysis_result`
--

CREATE TABLE `analysis_result` (
  `NameUser` varchar(255) NOT NULL,
  `analysisDate` varchar(255) NOT NULL,
  `analysisName` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `analysis_result`
--

INSERT INTO `analysis_result` (`NameUser`, `analysisDate`, `analysisName`, `result`) VALUES
('Кушнір Денис Романович', '2024-06-05', 'Загальний аналіз крові', '| Гемоглобін (Hb): 14.5 г/дл | Еритроцити (RBC): 5.2 млн/мкл | Гематокрит (HCT): 45% | Лейкоцити (WBC): 8.3 тис./мкл | Тромбоцити (PLT): 220 тис./мкл | Середній об\'єм еритроцитів (MCV): 88 фл | Середній вміст гемоглобіну в еритроциті (MCH): 30 пг |'),
('Максимів Вікторія Денисівна', '2024-06-03', 'Гормональні дослідження', ' | Тиреотропний гормон (TSH): 2.5 мкМЕ/мл (нормальний діапазон: 0.4-4.0 мкМЕ/мл) | Тироксин (T4): 8 мкг/дл (нормальний діапазон: 4.5-12.0 мкг/дл) | Трийодтиронін (T3): 100 нг/дл (нормальний діапазон: 80-200 нг/дл) | Естрогени (Estradiol): 50 пг/мл (нормал'),
('Кавісова Анна Василівна', '2024-06-02', 'Бактеріальний посів сечі', '| Виявлені мікроорганізми: Escherichia coli кількість: помірна, чутливість до антибіотиків: Амоксицилін, Цефтріаксон | Staphylococcus saprophyticus кількість: слабка, чутливість до антибіотиків: Налідіксова кислота, Фосфоміцин |');

-- --------------------------------------------------------

--
-- Структура таблиці `appointments`
--

CREATE TABLE `appointments` (
  `direction` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(2552) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `appointments`
--

INSERT INTO `appointments` (`direction`, `doctor`, `date`, `time`, `name`, `phone`) VALUES
('Гінекологія', 'Козлова Тетяна Михайлівна', '2024-06-05', '10:00', 'Антонова Катерина Василівна', '+380985673801'),
('Педіатрія', 'Сидоренко Анна Михайлівна', '2024-06-05', '12:00', 'Протальчук Роман Володимирович', '+380984736123'),
('Стоматологія', 'Савченко Дмитро Миколайович', '2024-06-05', '10:00', 'Антонів Василь Романович', '+380447610293'),
('Хірургія', 'Козак Олексій Ігорович', '2024-06-05', '09:00', 'Максов Денис Данилович', '+380981234123'),
('Терапія', 'Кузьменко Лариса Максимівна', '2024-06-05', '12:00', 'Кавісова Анна Василівна', '+380961254111'),
('Урологія', 'Крако Олександр Вікторович', '2024-06-19', '10:00', 'Кушнір Денис Романович', '+380987099855'),
('Кардіологія', 'Семенов Павло Вікторович', '2026-01-10', '15:00', 'Антонов Антон Антонович', '+380987099851');

-- --------------------------------------------------------

--
-- Структура таблиці `contact_messages`
--

CREATE TABLE `contact_messages` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `NameUser` varchar(255) NOT NULL,
  `PasswordUser` varchar(255) NOT NULL,
  `PhoneUser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`NameUser`, `PasswordUser`, `PhoneUser`) VALUES
('Кушнір Денис Романович', '$2y$10$FNVy9rJTzKicQmi6hglWMu8QLeuLYQehb7xevMAE.WIuYjlqgDyFe', '+380987099855'),
('Антонов Віктор Антонович', '$2y$10$LJm3ovQpb.BZlXYygwrCweEfYTl03PEQoCVk9sXaTVUwBPJHEFTUa', '+380984581375'),
('Колеснікова Вікторія Вікторівна', '$2y$10$TpeB6iE67F/BONrYR.f2oeDo8vDh92iYg8xlx0/Gs33hCVqeO9/pa', '+380983918255'),
('Вастон Данило Вікторович', '$2y$10$WmJFJ0LvGIIv9PKV4Bx7guhgpN1RbarmxxPXNUri6feRsI2Dk4Ori', '+380987099877'),
('Короп Олег Олегович', '$2y$10$c5EaHt/IM4L/bVJNgAMKIunEFpIU8l92VLFnzuE1.7hO4ftS7tptW', '+380986971488'),
('Антонов Антон Антонович', '$2y$10$sjQ8HVo4APugESnI6cLEiOqfHq4ZIiDGon.1Hdy5ScVmqc8PW1xv2', '+380987099851');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
