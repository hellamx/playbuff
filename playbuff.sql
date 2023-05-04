-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2023 г., 01:48
-- Версия сервера: 5.7.39
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `playbuff`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `keywords`, `description`, `alias`) VALUES
(2, 'Аркады', 'Аркады', 'Аркады', 'arcade'),
(3, 'Шутеры', 'Шутеры', 'Шутеры', 'shooters'),
(5, 'Гонки', 'Гонки', 'Гонки', 'race'),
(6, 'Спорт', 'Спорт', 'Спорт', 'sport'),
(7, 'Стратегии', 'Стратегии', 'Стратегии', 'strategies'),
(8, 'Инди', 'Инди', 'Инди', 'indi'),
(9, 'Файтинги', 'Файтинги', 'Файтинги', 'fighting'),
(10, 'Хоррор', 'Хоррор', 'Хоррор', 'horror');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `title`, `code`, `base`, `symbol`, `value`) VALUES
(1, 'рубль', 'RUB', '1', '₽', '1'),
(2, 'доллар', 'USD', '0', '$', '0.012242899118511');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `game_id` int(11) NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `game_id`, `src`, `alt`) VALUES
(1, 5, '111.webp', 'Hogwarts Legacy '),
(2, 5, '112.webp', 'Hogwarts Legacy '),
(4, 5, '114.webp', 'Hogwarts Legacy '),
(5, 5, '115.webp', 'Hogwarts Legacy '),
(8, 6, '21.webp', 'Dead Space Remake'),
(9, 6, '22.webp', 'Dead Space Remake'),
(10, 6, '23.webp', 'Dead Space Remake'),
(11, 7, '31.webp', 'Forspoken'),
(12, 7, '32.webp', 'Forspoken'),
(13, 7, '33.webp', 'Forspoken'),
(14, 7, '34.webp', 'Forspoken'),
(15, 7, '35.webp', 'Forspoken'),
(16, 8, '41.webp', 'Returnal '),
(17, 8, '42.webp', 'Returnal '),
(18, 8, '43.webp', 'Returnal '),
(19, 8, '44.webp', 'Returnal '),
(20, 8, '45.webp', 'Returnal '),
(21, 9, '51.webp', 'The Callisto Protocol'),
(22, 9, '52.webp', 'The Callisto Protocol'),
(25, 9, '53.webp', 'The Callisto Protocol'),
(26, 9, '54.webp', 'The Callisto Protocol'),
(27, 9, '55.webp', 'The Callisto Protocol'),
(28, 10, '61.webp', 'Need for Speed Unbound '),
(29, 10, '62.webp', 'Need for Speed Unbound '),
(30, 10, '63.webp', 'Need for Speed Unbound '),
(31, 10, '64.webp', 'Need for Speed Unbound '),
(32, 10, '65.webp', 'Need for Speed Unbound '),
(33, 11, '71.webp', '9 Childs Street '),
(34, 11, '72.webp', '9 Childs Street '),
(35, 11, '73.webp', '9 Childs Street '),
(36, 11, '74.webp', '9 Childs Street '),
(37, 11, '75.webp', '9 Childs Street '),
(38, 12, '81.webp', 'Pharaoh: A New Era '),
(39, 12, '82.webp', 'Pharaoh: A New Era '),
(40, 12, '83.webp', 'Pharaoh: A New Era '),
(41, 12, '84.webp', 'Pharaoh: A New Era '),
(42, 12, '85.webp', 'Pharaoh: A New Era '),
(44, 13, '91.webp', 'The Tales of Bayun'),
(45, 13, '92.webp', 'The Tales of Bayun'),
(46, 13, '93.webp', 'The Tales of Bayun'),
(47, 13, '94.webp', 'The Tales of Bayun'),
(48, 13, '95.webp', 'The Tales of Bayun'),
(49, 14, '101.webp', 'WILD HEARTS'),
(50, 14, '102.webp', 'WILD HEARTS'),
(51, 14, '103.webp', 'WILD HEARTS'),
(52, 14, '104.webp', 'WILD HEARTS'),
(53, 14, '105.webp', 'WILD HEARTS'),
(54, 15, 'atomic-1.webp', 'Atomic Heart'),
(55, 15, 'atomic-2.webp', 'Atomic Heart'),
(56, 15, 'atomic-3.webp', 'Atomic Heart'),
(57, 15, 'atomic-4.webp', 'Atomic Heart'),
(58, 16, 're4.webp', 'Resident Evil 4'),
(59, 16, 're42.webp', 'Resident Evil 4'),
(60, 16, 're43.webp', 'Resident Evil 4'),
(61, 16, 're44.webp', 'Resident Evil 4'),
(62, 16, 're45.webp', 'Resident evil 4'),
(63, 17, 'tu.webp', 'The Last of Us: Part I'),
(64, 17, 'tu2.webp', 'The Last of Us: Part I'),
(65, 17, 'tu3.webp', 'The Last of Us: Part I'),
(66, 17, 'tu4.webp', 'The Last of Us: Part I'),
(67, 17, 'tu5.webp', 'The Last of Us: Part I'),
(68, 18, 'cp1.webp', 'Contraband Police'),
(69, 18, 'cp2.webp', 'Contraband Police'),
(70, 18, 'cp3.webp', 'Contraband Police'),
(71, 18, 'cp4.webp', 'Contraband Police'),
(72, 19, 've1.webp', 'VALKYRIE ELYSIUM'),
(73, 19, 've2.webp', 'VALKYRIE ELYSIUM'),
(74, 19, 've3.webp', 'VALKYRIE ELYSIUM'),
(75, 19, 've4.webp', 'VALKYRIE ELYSIUM'),
(76, 20, 'twd1.webp', 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution'),
(77, 20, 'twd2.webp', 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution'),
(78, 20, 'twd3.webp', 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution'),
(79, 20, 'twd4.webp', 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution'),
(80, 20, 'twd5.webp', 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution'),
(81, 21, 'tn1.webp', 'Terra Nil'),
(82, 21, 'tn2.webp', 'Terra Nil'),
(83, 21, 'tn3.webp', 'Terra Nil'),
(84, 21, 'tn4.webp', 'Terra Nil'),
(85, 22, 'ww1.webp', 'Bleak Faith: Forsaken'),
(86, 22, 'ww2.webp', 'Bleak Faith: Forsaken'),
(87, 22, 'ww3.webp', 'Bleak Faith: Forsaken');

-- --------------------------------------------------------

--
-- Структура таблицы `game_keys`
--

CREATE TABLE `game_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `game_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `game_keys`
--

INSERT INTO `game_keys` (`id`, `game_id`, `platform`, `game_key`) VALUES
(7, '5', 'steam', 'a2092f63a2f91825e2c72496b104e027c2a5b0f0'),
(8, '5', 'steam', 'b6692ea5df920cad691c20319a6fffd7a4a766b8'),
(9, '5', 'steam', 'ef2afd226e3384e34d9833fe09cd123db498754c'),
(10, '5', 'origin', 'c67f59f04995ffb5b00a459b373681c0a6019d2e'),
(11, '7', 'steam', 'ffd353e719fdf52194a0c6d4ec269c049e9b93f3'),
(12, '7', 'origin', 'cad89aed066fb950a6e109860b8333c71575c903'),
(13, '14', 'steam', '09b6c96edff2f8667f7af5943e7d547185c88ff3'),
(14, '14', 'steam', 'd1be7673e8253db06005b4e0947c3ff539c40670'),
(15, '14', 'origin', '72c56504bddf4fcc34fc779fa1cea1d6aa67c2f3'),
(16, '14', 'steam', '40672aa2914ab56bba2d1d3bc7bce32aa0ce5999'),
(17, '14', 'origin', '6b0ccb2b5e32dee38e252895379ea1025a746a67'),
(18, '14', 'steam', '7bcab8fe6f9e73aa62c9193113a8ee34914d66d6'),
(19, '14', 'steam', 'a43a8abbb97af6934bdfbd32261b4b94bc22f5ec'),
(20, '13', 'origin', 'ade4b9464a2076f799ad8e9c561830ce57deca3d'),
(21, '12', 'origin', '09cfe43a4ab6df3e4dbc51410ce4c08cafd535ad'),
(22, '10', 'steam', 'b5d867cbb23e4797a23e138745a8d8d7b05b0212'),
(23, '9', 'steam', '9f3907b973bba2d17a7c2a5f85c224587c69abd3'),
(24, '9', 'origin', 'a374164baf2fc3c4de15fd6cc062ad7ca9c2db0e'),
(25, '8', 'steam', '7ef8dd90400ee71daf11f5c98ceb451caab779e1'),
(26, '8', 'origin', '9d40bde2f6289759fb9eac6c74d08e651265f9db'),
(27, '13', 'origin', '4ff1e8fee5b18026602554d591d43a29a7982e67'),
(28, '11', 'origin', '1232133'),
(29, '11', 'steam', 'ewrwer'),
(30, '11', 'origin', '1232133'),
(31, '11', 'steam', 'ewrwer'),
(32, '6', 'steam', 'steamsteam'),
(33, '6', 'steam', 'steamsteamsteam'),
(34, '6', 'steam', 'steamsteam'),
(35, '6', 'steam', 'steamsteamsteam'),
(36, '6', 'steam', 'steamsteam'),
(37, '6', 'steam', 'steam'),
(38, '6', 'steam', 'steamsteam'),
(39, '6', 'steam', 'steam'),
(40, '6', 'origin', 'originorigin'),
(41, '6', 'originorigin', 'originorigin'),
(42, '6', 'origin', 'originorigin'),
(43, '6', 'originorigin', 'originorigin'),
(44, '6', 'origin', 'originorigin'),
(45, '15', 'steam', 'steamsteam'),
(46, '15', 'steam', 'steamsteam'),
(47, '15', 'steam', 'steamsteam'),
(48, '15', 'steam', 'steamsteam'),
(49, '15', 'origin', 'originoriginorigin'),
(50, '15', 'origin', 'originorigin'),
(51, '16', 'steam', 'steamsteam'),
(52, '16', 'steam', 'steamsteam'),
(53, '16', 'steam', 'steamsteam'),
(54, '16', 'steam', 'steamsteam'),
(55, '16', 'steam', 'steam'),
(56, '16', 'steam', 'steamsteam'),
(57, '16', 'steam', 'steam'),
(58, '16', 'steam', 'steamsteam'),
(59, '16', 'steam', 'steamsteam'),
(60, '16', 'steam', 'steamsteam'),
(61, '16', 'steam', 'steamsteam'),
(62, '17', 'origin', 'originorigin'),
(63, '17', 'origin', 'origin'),
(64, '17', 'origin', 'originorigin'),
(65, '17', 'origin', 'originorigin'),
(66, '17', 'origin', 'originorigin'),
(67, '17', 'origin', 'originorigin'),
(68, '17', 'steam', 'steam'),
(69, '18', 'origin', 'originorigin'),
(70, '18', 'steam', 'steamsteam'),
(71, '19', 'steam', 'steamsteam'),
(72, '19', 'origin', 'originorigin'),
(73, '20', 'steam', 'steam'),
(74, '20', 'steam', 'steamsteam'),
(81, '22', 'steam', '646545464564564'),
(83, '5', 'steam', 'yryhrtyrjhryryrty'),
(85, '5', 'steam', 'yryryryrthrrthrt'),
(86, '5', 'steam', 'hrhrthrthrtyrtyrt'),
(87, '5', 'origin', 'yryrtyry45645'),
(89, '5', 'origin', '45654tt4yryr'),
(90, '5', 'origin', 'yrtyrtyrtyryrty'),
(91, '22', 'origin', 'eteteterterte'),
(92, '21', 'origin', 'teteterteterte'),
(93, '21', 'origin', 'tertretert345');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visits` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title_content`, `content`, `date`, `image`, `alias`, `visits`) VALUES
(1, 'GTX 660 и 8 ГБ ОЗУ — системные требования открытой беты Diablo 4', 'Открытая бета Diablo 4 пройдет 17-19 марта для предзаказавших, а 24-26 марта откроется доступ всем желающим. Игроки смогут прокачаться до 25 уровня и пройти пролог и первый акт. В катсценах игроки смогут наблюдать собственную модельку персонажа с выбранным снаряжением.\r\n\r\nПолноценный релиз Diablo 4 ожидается 6 июня на PC, PS4, PS5, Xbox One и Xbox Series.', '01.03.2023', 'news-1.webp', 'sistemnie-trebovaniya-otkritoy-beta-diablo-4', 2),
(2, 'Игра про ведьмочку-курьера Mika and the Witch\'s Mountain собрала на Kickstarter больше миллиона долларов', 'Инди-студия Chibig похвасталась достижениями симулятора ведьмы-курьера Mika and the Witch\'s Mountain. За четыре дня до конца кампании игры собрала на Kickstarter свыше миллиона долларов, хотя изначально разработчики рассчитывали на сорок тысяч.\r\n\r\nБлагодаря этому бэкеры выполнили все дополнительные цели и разблокировали компаньонов, питомцев, новые квесты и три подземелья в духе франшизы The Legend of Zelda.\r\nИстория игра началась в 2020 году, когда сотрудник студии по имени Абрахам Козар, вдохновленный мультфильмом студии Ghibli \"Ведьмина служба доставки\", создал простой прототип, позволявший летать на метле по открытому миру. Затем к делу подключился художник Эрнесто из Барселоны, инди-команда из двух человек Nukefist и несколько сотрудников Chibig.\r\n\r\nMika and the Witch\'s Mountain выйдет в октябре 2023 года на PC, PS4, PS5, Xbox One, Xbox Series и Nintendo Switch.', '01.03.2023', 'news-2.webp', 'igra-mika-and-witch-sobrala-bolshe-milliona-dollarov', 4),
(3, 'Steam-версия Resident Evil 5 лишилась Games for Windows Live и получила поддержку локального кооператива', 'Capcom внезапно выпустила обновление для Steam-версии Resident Evil 5, которое убрало из игры сервис Games for Windows Live. Вместе с этим экшен получил поддержку локального кооператива с разделенным экраном и правку некоторых багов.\r\n\r\nОбновления пришлось ждать почти 14 лет.\r\n\r\nОригинальный релиз PC-версии Resident Evil 5 состоялся в сентябре 2009 года.', '01.03.2023', 'news-3.webp', 'steam-versiya-resident-evil-5-lishilas-games-for-windows', 2),
(4, 'Экшен Strayed Lights про огненное существо выйдет в апреле', 'Студия Embers представила геймелейный трейлер экшена Strayed Lights про \"огонек, стремящийся к трансцендентности\". Игра выйдет 25 апреля на PC, PlayStation, Xbox и Switch.\r\n\r\nГлавной \"фишкой\" игры должна стать боевая система, завязанная на энергии. Игрокам предстоит \"переключаться\" между двумя состояниями своего персонажа прямо во время схваток и при помощи парирований поглощать энергию врагов, чтобы затем преобразовать ее в особо мощные атаки.\r\n\r\nМузыку для игры пишет Остин Уинтори, известный по саундтрекам к таким тайтлам, как Journey, ABZU и The Banner Saga.', '01.03.2023', 'news-4.webp', 'ekshen-strayed-lights-viydet-v-aprele', 8),
(5, 'Лучшей игрой для PS5 по версии игроков стала God of War Ragnarok', '11 февраля Sony объявила о старте опроса в блоге PlayStation. Компания попросила опытных геймеров и фанатов PlayStation посоветовать лучшие игры для PS5 новичкам. Сегодня стали известны результаты опроса.\r\n\r\nЛучшей игрой на PS5 геймеры назвали God of War Ragnarok, а любимой инди стала игра про котика Stray.', '01.03.2023', 'news-5.webp', 'lutshey-igroy-dlya-ps5-stala-god-of-war-ragnarok', 12),
(6, 'Разработчики Hitman работают над сетевой фэнтезийной RPG', 'IO Interactive, известная по франшизе Hitman, анонсировала разработку сетевой фэнтезийной ролевой игры. По словам разработчиков, они захотели создать что-то особенное.\r\n\r\nТакже команда показала и первый арт тайтла. На нем можно увидеть трех персонажей, которые смотрят куда-то вдаль, выходя из пещеры.\r\nПосле релиза IO Interactive будет постоянно обновлять будущую игру — разработчики собираются поддерживать ее постоянным новым контентом.\r\n\r\nНикаких других деталей игры нет. Неизвестна даже примерная дата выхода', '01.03.2023', 'news-6.webp', 'razrabotchiki-hitman-rabotayut-nad-setevoy-rpg', 8),
(7, 'Зомби, танки и крафт в первом трейлере MMOFPS The Front', 'Представлен первый трейлер The Front — необычной MMOFPS, в которой смешалось слишком много тем и жанров. Видео начинается с падения метеорита на Землю, а заканчивается масштабными схватками между игроками с использованием техники.\r\n\r\nСудя по видео, в игре будут: зомби, мутанты, артефакты, охота, добыча ресурсов, крафт, строительство зданий, вертолеты, зенитки, окопы, проведение энергии, все это еще и с путешествиями во времени — кажется, кто-то хотел собрать много тегов в Steam\r\nДействие происходит в альтернативной вселенной, в которой тираническое правительство контролирует человечество. Сопротивление отправляется в прошлое, чтобы спасти людей.\r\n\r\nИгроки смогут создавать базы, летать на вертолетах, бороться с клоунами-мутантами и участвовать в масштабных матчах.\r\n\r\nThe Front выйдет когда-нибудь на PC.', '23.02.2023', 'news-7.webp', 'zomby-tanki-i-kraft-v-pervom-trailere-mmofps-the-front', 17),
(8, 'Вторжение на Землю в трейлере сезона \"Сопротивление\" в Destiny 2', 'Bungie опубликовала трейлер сезона \"Сопротивление\", который стартует в Destiny 2 одновременно с запуском расширения Lightfall (\"Конец Света\"). Основные события сезона развернутся на Земле, куда вторгаются Калус и Свидетель.\r\n\r\nВ этот раз Стражам предстоит работать вместе с Девримом Кеем и Марой Сов.\r\nСезон \"Сопротивление\" привнесет в Destiny 2 новый сет брони для каждого класса, сезонное оружие, новое \"Поле сражений\", экзотический стазисный лук, а также социальную зону \"Ферма\" — ее игроки не видели уже довольно давно.', '28.02.2023', 'news-8.webp', 'vtorjenie-na-zemly-v-traile-sezona-soprotivlenie-v-destiny-2', 30),
(9, 'Студия Mad Head Games выпустила трейлер к релизу научно-фантастического экшен-шутера Scars Above. В ролике показали сюжетные и геймплейные фрагменты.', 'Студия Mad Head Games выпустила трейлер к релизу научно-фантастического экшен-шутера Scars Above. В ролике показали сюжетные и геймплейные фрагменты\r\nСюжет игры расскажет о том, как гигантский, таинственный инопланетный артефакт вышел на околоземную орбиту, вызвав всепланетный фурор. Земляне назвали артефакт метаэдром и отправили для его изучения отряд по изучению форм жизни и коммуникации, состоявший из ученых и инженеров. Игрокам предстоит сыграть за одного из членов этого отряда.', '01.03.2022', 'news-9.webp', 'relizniy-trailer-ekshena-scars-above', 74);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promocode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'нет'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `date`, `sum`, `products`, `user_email`, `pay_method`, `promocode`) VALUES
(1, 19, '2023-03-29 15:39:26', '2878.2:RUB', '14-steam-1;14-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(2, 19, '2023-03-29 15:47:25', '2878.2:RUB', '14-steam-1;14-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(3, 19, '2023-03-29 15:48:16', '2878.2:RUB', '14-steam-1;14-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(4, 19, '2023-03-29 15:48:19', '2878.2:RUB', '14-steam-1;14-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(5, 19, '2023-03-29 15:59:40', '2878.2:RUB', '14-steam-1;14-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(6, 19, '2023-03-29 16:02:00', '2878.2:RUB', '14-steam-1;14-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(7, 19, '2023-03-29 16:03:05', '2878.2:RUB', '14-steam-1;14-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(8, 19, '2023-03-29 16:03:42', '2649:RUB', '8-steam-1;12-origin-1;', 'bolsunovski.e2017@gmail.com', 'card', 'нет'),
(9, 19, '2023-03-29 16:32:19', '33.94:USD', '8-steam-1;12-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(10, 19, '2023-03-29 16:36:00', '33.94:USD', '8-steam-1;12-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', '10'),
(11, 19, '2023-03-29 16:40:27', '33.94:USD', '8-steam-1;12-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', '10'),
(12, 19, '2023-03-29 16:42:46', '33.94:USD', '8-steam-1;12-origin-1;', 'bolsunovski.e2017@gmail.com', 'balance', '10'),
(13, 19, '2023-03-29 16:46:17', '10.83:USD', '7-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', '10'),
(14, 22, '2023-03-29 20:46:18', '18.423:USD', '14-steam-1;', 'test1@mail.ru', 'balance', '10'),
(15, 19, '2023-03-29 21:54:44', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', '10'),
(16, 19, '2023-03-29 21:55:30', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(17, 19, '2023-03-29 21:56:22', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(18, 19, '2023-03-29 21:57:00', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(19, 19, '2023-03-29 21:58:04', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(20, 19, '2023-03-29 21:58:56', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(21, 19, '2023-03-29 21:59:27', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(22, 19, '2023-03-29 22:00:09', '1439.1:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(23, 19, '2023-03-29 22:00:37', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(24, 19, '2023-03-29 22:00:47', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(25, 19, '2023-03-29 22:00:58', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(26, 19, '2023-03-29 22:01:34', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(27, 19, '2023-03-29 22:02:28', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(28, 19, '2023-03-29 22:03:06', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(29, 19, '2023-03-29 22:03:13', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(30, 19, '2023-03-29 22:03:29', '1599:RUB', '14-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(32, 19, '2023-03-29 22:46:38', '10837.35:RUB', '14-steam-2;5-steam-1;5-origin-1;7-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', '10'),
(33, 19, '2023-04-04 21:55:41', '4835.07:RUB', '17-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(34, 19, '2023-04-04 21:56:01', '4835.07:RUB', '17-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет'),
(35, 19, '2023-04-06 19:43:54', '4835.07:RUB', '17-steam-1;', 'bolsunovski.e2017@gmail.com', 'balance', 'нет');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(10) UNSIGNED NOT NULL,
  `create_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_reset`
--

INSERT INTO `password_reset` (`id`, `create_date`, `expiration_date`, `hash_key`, `user_id`) VALUES
(29, '1678007411', '1678011011', '85daaf6f7055cd5736287faed9603d712920092c4f8fd0097ec3b650bf27530e', 2),
(55, '1680175909', '1680179509', '2f1d593cd98cb5bf81eb9d880221122342784ac5fb7f41f2b137006bafc92e39', 19),
(56, '1680452871', '1680456471', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no_image.jpg',
  `hit` int(11) NOT NULL DEFAULT '0',
  `release_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `alias`, `content`, `price`, `discount`, `keywords`, `description`, `main_image`, `hit`, `release_date`, `date_add`) VALUES
(5, 2, 'Hogwarts Legacy ', 'hogwarts-legacy ', 'Hogwarts Legacy (Хогвартс: Наследие) – крутой ролевой фэнтезийный приключенческий экшен с открытым миром, созданный на основе вселенной Гарри Поттера и предлагающий пуститься в новые приключения, переполненные магией, волшебством, проклятиями и многим другим…', 3999, 22, 'Hogwarts Legacy ', 'Hogwarts Legacy ', '1.webp', 1, '10 февраля 2023 г', '2023-03-27 19:30:24'),
(6, 3, 'Dead Space Remake', 'dead-space-remake', 'Dead Space Remake — это полностью переработанная версия научно-фантастического хоррор-шутера от третьего лица вышедшего в 2008 году. События разворачиваются в недалеком будущем, когда человечество создало небывалых размеров космические судна для доставки полезных ископаемых с далеких планет. ', 1899, 0, 'Dead Space Remake', 'Dead Space Remake', '2.webp', 1, '27 января 2023 г', '2023-03-27 19:30:24'),
(7, 3, 'Forspoken', 'forspoken', 'Forspoken рассказывает историю Фрей — нью-йоркской девушки, которая оказывается в прекрасной и жестокой Атии. Чтобы отыскать дорогу домой, Фрей предстоит путешествовать по безбрежным просторам нового мира и сражаться с чудовищами с помощью магии.', 890, 5, 'Forspoken', 'Forspoken', '3.webp', 1, '24 января 2023 г', '2023-01-27 19:30:24'),
(8, 3, 'Returnal ', 'returnal', 'Returnal — это оригинальный шутер от третьего лица с элементами рогалика, который позволит с головой погрузиться не только в красочный мир чужеродной планеты, но и насладиться запутанным научно-фантастическим сюжетом в духе фантастических книг середины XX века. История рассказывает о Селене, девушке-астронавте из компании ASTRA, которая была вынуждена совершить экстренную посадку на планете под названием Атропос.', 2350, 0, 'Returnal 2023', 'Returnal 2023', '4.webp', 0, '30 апреля 2021 г', '2023-01-27 19:30:24'),
(9, 10, 'The Callisto Protocol', 'the-callisto-protocol', 'The Callisto Protocol — будоражащий кровь проект в жанре survival horror от разработчиков Dead Space, который выводит жанр ужасов на новую высоту. Перенеситесь в будущее, в 2320 год. Джейкоб Ли, пилот грузового корабля, осуществляет доставку секретного груза на спутник Юпитера Каллисто. Здесь же , вдали от основных планет Солнечной системы, расположилась тюрьма для особо опасных преступников. К несчастью, судно главного героя терпит крушение, и в попытках отыскать помощь мужчина оказывается в исправительном учреждении, но совсем скоро становится ясно, что все люди мутировали и превратились в отвратительных и кровожадных существ.', 3400, 13, 'The Callisto Protocol', 'The Callisto Protocol', '5.webp', 1, '2 декабря 2022 г', '2023-01-27 19:30:24'),
(10, 5, 'Need for Speed Unbound ', 'need-for-speed-unbound ', 'Need for Speed Unbound — это захватывающее продолжении самой популярной серии гоночных игр. Откройте для себя уже знакомый, но в то же время совершенно новый мир стритрейсинга. Лейкшор-сити ждет легендарного героя и, кажется, вы вполне сойдете за него. После ограбления семейного автомагазина ваши пути с товарищем расходятся и вот вы готовы снова столкнуться с некогда лучшим другом, но уже на уличной трассе. Продемонстрируйте мастерство вождения, станьте королем улиц и заполучите драгоценное авто.\r\n', 1299, 0, 'Need for Speed Unbound ', 'Need for Speed Unbound ', '6.webp', 0, '29 ноября 2022 г', '2023-01-27 19:30:24'),
(11, 8, '9 Childs Street ', '9-childs-street ', '9 Childs Street - это инди хоррор игра от первого лица в жанре симулятор ходьбы. Основной акцент сделан на пугающей атмосфере и чувстве страха у игрока. В ходе прохождения вам придётся столкнуться с паранормальными явлениями и узнать ужасающую тайну хозяина дома.\r\n\r\nМесто действия- это дом через дорогу, в котором не так давно жил престарелый одинокий мужчина, но его перестали видеть, и в доме больше не загорается свет.', 479, 0, '9 Childs Street ', '9 Childs Street ', '7.webp', 0, '16 февраля 2023 г', '2023-01-27 19:30:24'),
(12, 7, 'Pharaoh: A New Era ', 'pharaoh-a-new-era ', 'Перенеситесь во времена Древнего Египта вместе с игрой Pharaoh: A New Era — переизданием игры Pharaoh (и дополнения Cleopatra: Queen of the Nile), одним из лучших симуляторов градостроения в золотую эпоху игр от Sierra Entertainment. Вас ждет 50 миссий и более 100 часов геймплея. Поэтапно возводите город и следите за всеми составляющими его развития, чтобы город преуспевал, а вас признали могущественным и почитаемым фараоном.', 499, 0, 'Pharaoh: A New Era ', 'Pharaoh: A New Era ', '8.webp', 0, '15 февраля 2023 г', '2023-01-27 19:30:24'),
(13, 8, 'The Tales of Bayun', 'the-tales-of-bayun', ' The Tales of Bayun — это эпизодическая нарративная ролевая игра с незаурядным сюжетом, который познакомит игроков с темной славянской мифологией. Погрузитесь в стоящую на трех демонах-медведях вселенную, где существуют богатыри и языческие боги, из болот встают лешие и водяные, а в глубинах горы затаился Змей Горыныч. Узнайте что скрывает каждый из героев и пронесите их историю через десятичасовой геймплей.', 739, 4, 'The Tales of Bayun', 'The Tales of Bayun', '9.webp', 0, '15 февраля 2023 г', '2023-01-27 19:30:24'),
(14, 3, 'WILD HEARTS', 'wild-hearts', 'WILD HEARTS — это увлекательный приключенческий экшен, где вашей главной задачей станет охота на гигантских монстров. Земли Азумы прославились не только красочными пейзажами, но и плодородными землями, привлекающими все больше туристов из других регионов. Местные жители не знали о горечи и проблемах, но так было лишь до недавнего времени. Появившиеся из ниоткуда кэмоно стремительно заполонили процветающие регионы, а их первобытный нрав стал причиной уничтожения многих местных жителей. Люди жили в страхе, но появилась надежда в лице отважного охотника, которому суждено положить конец правлению существ и вернуть мир в процветающий край.', 1599, 0, 'WILD HEARTS', 'WILD HEARTS', '10.webp', 1, '16 февраля 2023 г', '2023-03-25 21:00:00'),
(15, 3, 'Atomic Heart', 'atomic-heart', ' Atomic Heart – приключенческий шутер с видом от первого лица, в котором вы отправитесь в альтернативную вселенную, в которой Советский союз не только не развалился, но еще и освоил роботостроение…\r\n\r\nДавным-давно окончена Вторая мировая война, мир был на грани уничтожения, но внезапно все изменилось. Прошло много лет и СССР неутомимо развивался. В итоге было освоено роботостроение, и постепенно роботы заменили людей везде, где только могли. Так появилось и предприятие «3826», на котором начали производить бытовых роботов. Но внезапно случился сбой, роботы восстали и уничтожили весь здешний персонал.', 2999, 0, 'Atomic Heart', 'Atomic Heart', '2023-1.webp', 1, '15.03.2023', '2023-04-02 08:55:30'),
(16, 10, 'Resident Evil 4', 'resident-evil-4', 'Resident Evil 4 Remake — это культовый хоррор на выживание, ставший не просто классическим представителем своего жанра, а его основоположником. После инцидента в Раккун-Сити прошло шесть лет и на протяжении всего этого времени Леон С. Кеннеди работал в качестве секретного агента на правительство Соединенных Штатов. Отныне ситуация крайне деликатная: к вам обратился сам президент, чтобы вы помогли спасти его похищенную дочь. Расследование приводит вас в небольшую европейскую деревушку, где жители одержимы странным культом, а на улицах творится настоящий кошмар.', 599, 3, 'Resident Evil 4', 'Resident Evil 4', '2023-2.webp', 1, '02.04.2023', '2023-04-02 09:28:28'),
(17, 3, 'The Last of Us: Part I', 'the-last-of-us-part-I', 'The Last of Us: Part I Remake (Одни из нас. Часть I) — это обновленная версия нашумевшего приключенческого экшена в элементами хоррора на выживание. Действие происходит через двадцать лет после глобальной эпидемии, вызванной мутировавшим видом грибка кордицепс. Он превратил большую часть населения планеты в зомби и ужасных монстров. Оставшиеся люди уживаются в карантинных зонах под надзором военных в попытках уцелеть, ведь один укус или оказавшаяся в легких спора запросто отправит любого на тот свет. История разворачивается вокруг Джоэля, опытного контрабандиста потерявшего в начале пандемии свою дочь. Ему необходимо сопроводить девочку Элли через половину страны в заранее оговоренное место, но в ходе долгого путешествия двое незнакомцев становятся полноценной семьей, готовой справиться со всеми возникающими трудностями.', 5199, 8, 'The Last of Us: Part I', 'The Last of Us: Part I', '2023-3.webp', 0, '01.04.2023', '2023-04-02 10:22:41'),
(18, 2, 'Contraband Police', 'contraband-police', 'Contraband Police – это необычный, но очень интересный инди-симулятор, в котором вы отправитесь в коммунистическую страну 80-х годов и будете работать командиром пограничного поста…\r\n\r\nСобытия игры происходят в недавно образовавшейся в ходе очередной революции или войны стране, получившей название Акаристан. ну а окажитесь вы там в роли командира пограничного поста, следящего за границей на въезде-выезде и отслеживающего контрабанду. Вам предстоит ловить контрабандистов на границе, следить за тем, чтоб мимо вас ничего не прошло незамеченным, заниматься обысками, и делать многое другое. В общем, скучать точно не придется…', 849, 0, 'Contraband Police', 'Contraband Police', '2023-4.webp', 0, '02.04.2023', '2023-04-02 14:16:06'),
(19, 2, 'VALKYRIE ELYSIUM', 'valkyrie-elysium', 'Valkyrie Elysium — японский ролевой экшен с классическими элементами hack and slash. Случилось непредвиденное и Вальхалла пала, а вместе с этим в мир проникли сотни, если не тысячи опасных существ, сеющих разрушение и хаос на некогда процветающие земли. В роли единственной уцелевшей Валькирии отправляйтесь выполнять приказ Одина и зачистите территорию от скверы. Найдите причину произошедшей катастрофы и, возможно, вам удастся справиться с ее последствиями и найти способ вернуть все на свои места.\r\n\r\nДанная игра стала продолжением одноименной серии JRPG первая часть которой вышла в 1999 году, а последняя в 2008. Valkyrie Elysium стала своего рода перезапуском, которая запускает новый виток истории в масштабах уже сложившейся вселенной, а также вводит ряд игровых механик и особенностей при этом не забывая о своих оригинальных принципах. Одним из таких стал обширный и красочный мир с огромными локациями, чарующей музыкой и непередаваемым чувством грандиозного путешествия.', 1199, 0, 'VALKYRIE ELYSIUM', 'VALKYRIE ELYSIUM', '2023-5.webp', 0, '11.11.2022', '2023-04-02 14:34:04'),
(20, 2, 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution', 'the-walking-dead-saints-sinners-chapter-2-retribution', 'Преследуемый, казалось бы, неудержимым Топорщиком и противостоящий последнему стремлению Башни к полному господству, узнайте, что объединяет эти новые угрозы, пока не стало слишком поздно. Новые лица, места, оружие и снаряжение ждут вас на пути к финальной схватке за судьбу города.\r\n\r\nСразитесь с ужасающим новым врагом, более смертоносным, чем любой ходячий или отчаявшийся выживший. Решив разорвать вас на куски, вам придется сражаться изо всех сил или бежать, спасая свою жизнь, когда этот могучий преследователь придет за вами. Сможете ли вы разгадать тайну того, кем является этот постапокалиптический серийный слэшер, и положить конец их царству террора, или вы станете очередной жертвой на плахе?', 2159, 4, 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution', 'The Walking Dead: Saints & Sinners - Chapter 2: Retribution', '2023-6.webp', 0, '21.03.2023', '2023-04-02 15:28:27'),
(21, 2, 'Terra Nil', 'terra-nil', 'Terra Nil — это смесь из градостроительного симулятора и стратегии в реальном времени, где вам предстоит перенестись в удивительное место и вдохнуть новую жизнь в бесплодную пустошь, которая не в силах самостоятельно оправиться после серьезной техногенной катастрофы. Вам предстоит очистить каждый сантиметр почвы, выловить весь мусор в океане и фильтровать воду в источниках, сажать растительность и возродить фауну, чтобы в конце концов бесследно исчезнуть, не оставив единого намека на свое существование в этих краях.\r\n', 1729, 0, 'Terra Nil', 'Terra Nil', '2023-7.webp', 0, '28.03.2023', '2023-04-02 15:35:53'),
(22, 9, 'Bleak Faith: Forsaken', 'bleak-faith-forsaken', 'Отправляйтесь в огромный фэнтезийный мир, начав играть в Bleak Faith: Forsaken, постарайтесь узнать, что с ним случилось и откуда взялись все те ужасающие своим внешним видом твари, что охотятся на все живое, и постарайтесь просто выжить…\r\n\r\nСобытия игры происходят в необычном мире, вдохновленном стилистикой темного фэнтези. Этот мир уничтожен и на его месте теперь лишь руины. Он опасен и жесток, и все то живое, что вы тут найдете, может попытаться вас уничтожить. Ну а вам же предстоит научиться выживать в этом мире, отправиться в путешествие по нему и узнать, что изначально с ним случилось и что привело к его разрушению, и не только.', 849, 0, 'Bleak Faith: Forsaken', 'Bleak Faith: Forsaken', '2023-8.webp', 0, '10.03.2023', '2023-04-02 15:43:50');

-- --------------------------------------------------------

--
-- Структура таблицы `promocodes`
--

CREATE TABLE `promocodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `promocode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` int(10) UNSIGNED NOT NULL,
  `bonus` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `promocodes`
--

INSERT INTO `promocodes` (`id`, `promocode`, `available`, `bonus`) VALUES
(1, 'new20', 21, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `reference`
--

CREATE TABLE `reference` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `related_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reference`
--

INSERT INTO `reference` (`product_id`, `related_id`) VALUES
(5, 7),
(5, 11),
(5, 13),
(5, 14),
(6, 8),
(7, 11),
(8, 14),
(9, 10),
(10, 5),
(11, 5),
(12, 8),
(13, 6),
(14, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `roulette`
--

CREATE TABLE `roulette` (
  `id` int(10) UNSIGNED NOT NULL,
  `box` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roulette`
--

INSERT INTO `roulette` (`id`, `box`, `price`) VALUES
(1, 'common', 499),
(2, 'rare', 999),
(3, 'legend', 1299);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `time_cache` int(11) NOT NULL DEFAULT '3600',
  `time_cache_currency` int(11) NOT NULL DEFAULT '600',
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `games_perpage` int(11) NOT NULL DEFAULT '8',
  `news_perpage` int(11) NOT NULL DEFAULT '6'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `status`, `time_cache`, `time_cache_currency`, `api_key`, `games_perpage`, `news_perpage`) VALUES
(1, 1, 3600, 600, 'CECB353E-D7C7-4AB5-87ED-084410CB9252', 8, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `game_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `game_id`, `title`, `alias`) VALUES
(1, 5, 'Открытый мир', 'open-world'),
(2, 5, 'Приключения', 'adventures'),
(3, 5, 'Фэнтези', 'fantasy'),
(4, 5, 'RPG', 'rpg'),
(5, 6, 'Шутер', 'shooter'),
(6, 6, 'Выживание', 'survival'),
(7, 7, 'Файтинг', 'fighting'),
(8, 7, 'RPG', 'rpg'),
(9, 7, 'Шутер', 'shooter'),
(10, 7, 'Платформер', 'platformer'),
(11, 8, 'Шутер', 'shooter'),
(12, 8, 'Приключения', 'adventures'),
(13, 8, 'Подземелье', 'dungeon'),
(14, 9, 'Выживание', 'survival'),
(15, 9, 'Приключения', 'adventures'),
(16, 9, 'Файтинг', 'fighting '),
(17, 9, 'Шутер', 'shooter'),
(18, 10, 'Скорость', 'speed'),
(19, 10, 'Гонки', 'race'),
(20, 11, 'Ролевая', 'roleplay'),
(21, 11, 'Инди', 'indi'),
(22, 11, 'Гонки', 'race'),
(23, 11, 'Файтинг', 'fighting '),
(24, 12, 'Градостроительство', 'citybuilding'),
(25, 12, 'Стратегии', 'strategies'),
(26, 13, 'Приключения', 'adventures'),
(27, 13, 'Ролевая', 'roleplay'),
(28, 13, 'История', 'history'),
(29, 13, 'Сюжет', 'plot'),
(30, 14, 'Ролевая', 'roleplay'),
(31, 14, 'Шутер', 'shooter'),
(32, 14, 'Приключения', 'adventures'),
(33, 14, 'Файтинг', 'fighting'),
(34, 14, 'Монстры', 'monsters'),
(35, 14, 'Фантастика', 'fantasy');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `balance` float UNSIGNED NOT NULL DEFAULT '0',
  `date_signup` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ban` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `email`, `password`, `role`, `balance`, `date_signup`, `ban`) VALUES
(1, 'gellam', 'bolsunovski.e@gmail.com', '$2y$10$HVcfunkJL9d5o.nyqM99SeNyJZWHkRn/fC2GgHQD3KRRIsRhu4AD6', 0, 521.56, '2023-03-27 19:15:32', 0),
(3, 'hellam', 'gellam@gmail.com', '$2y$10$kgbt0usropjdb9okj2a9lu8bzi.jxa0fwkgjs0toownjtbe0deqhe', 0, 0, '2023-03-27 19:15:32', 0),
(4, 'jioerwoi', 'gyuiyguyigui@mail.ru', '$2y$10$n3Ps/UIJwm695jGycauMKOQBlpvceGREuplpXG8Mh.aVfzFYHDGfi', 0, 0, '2023-03-27 19:15:32', 0),
(5, 'hellamx', 'bolsunovski.ehht@gmail.com', '$2y$10$DYtSemYmRRyAsTaOUFlVM.xUXr.c6qi/qLMcTmfgVzlsm7bJd.MvC', 0, 0, '2023-03-27 19:15:32', 0),
(6, 'уацукаку', 'gellam@m45ail.ru', '$2y$10$m9KE1EvROw6Pq1rED.LnxeoJaKw1NU5fnYaQGFF2ldStR.IIbMidi', 0, 0, '2023-03-27 19:15:32', 0),
(7, 'jkrop', 'regjkpo@repo.ru', '$2y$10$O0hcQjMW3JmxVpxv1guxJebUcywUlZUcrs6p.VppHI.F2eVlAfPwK', 0, 0, '2023-03-21 19:15:32', 0),
(8, 'jroiejo', 'grgioj@mail.ru', '$2y$10$uf9akFHEMmdVh7/gU9WaRO2OFTVVLRf0NSVgkucQw68grqcQvth.K', 0, 0, '2023-03-27 19:15:32', 0),
(9, 'poerjripo123', 'tttr@mail.ru', '$2y$10$F3BDEMvYOOUk52h/KDe3huItxzqy.ssVH8wkjsLlmfc4QSIpRfEFS', 0, 0, '2023-03-27 19:15:32', 0),
(10, 'eruioo', 'ef@mail.ru', '$2y$10$NoTrNlLLtZ8OGsct2hjIoe5kKG6HQNGAWdkzto4T4qJNvCfJQnpzW', 0, 0, '2023-03-27 19:15:32', 0),
(11, 'ewrwerwe', 'e2f@mail.ru', '$2y$10$bpyVoiEsedNeMvEw2JhEROYv2n5ubFDDkUNkvHD5cxOjr6wj0lXHK', 0, 0, '2023-03-27 19:15:32', 0),
(12, '231irrii', 'rfhio@mail.ru', '$2y$10$JNDy2fC31WoyPMxWIDTQGe2pGlhGHEEO8eZXs5.J2yY71qBJtraaO', 0, 0, '2023-01-27 19:15:32', 0),
(13, 'gellam2', 'bolsunovski.e2020@gmail.com', '$2y$10$zG0S/gPEZlUiOGgCaWcYguU63LDxnRus8sIwLcJXE2S0b98mZcFHq', 0, 0, '2023-03-27 19:15:32', 0),
(14, 'egor2', 'egor2@gmail.ru', '$2y$10$oiYINc41S4QWKFmoj0fGo.q54gPr72z7Yqw9TADf25mL2810G2B6i', 0, 0, '2023-03-27 19:15:32', 0),
(15, 'egor3', 'egor3@mail.ru', '$2y$10$DbJ.Jnic1r6DVcMg3vxB/OM6XMJOup44MCjxR0fTqIbWMWWVKwE3W', 0, 0, '2023-03-27 19:15:32', 0),
(16, 'ego', 'egor34@mail.ru', '$2y$10$brUkW6qqpNEufoYRLeKlY.sgPGhQIVX/8GlnnHFcQo8xuV2G0b/hu', 0, 0, '2023-03-27 19:15:32', 0),
(17, 'rr44', '432423@mai.ru', '$2y$10$C1xgx5qqBhTYRCK4AXn30uRRNOnVZhwGawcJku72esOlajamU5rcO', 0, 0, '2023-03-27 19:15:32', 0),
(19, 'egor', 'bolsunovski.e2017@gmail.com', '$2y$10$COMR8pyyWMFD93IalUQcNu.bS3TnpJe5uEpxnr.i5hL1cfesvlJG2', 1, 4228400, '2023-03-27 19:15:32', 0),
(22, 'test111', 'test1@mail.ru', '$2y$10$mELXtPShl0A459lFHl1eRO5ZaNet.piNRYRTdXSBRYikE2n5EecTC', 0, 0, '2023-03-29 17:44:41', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `waitlist`
--

CREATE TABLE `waitlist` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `game_keys`
--
ALTER TABLE `game_keys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promocodes`
--
ALTER TABLE `promocodes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`product_id`,`related_id`);

--
-- Индексы таблицы `roulette`
--
ALTER TABLE `roulette`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `waitlist`
--
ALTER TABLE `waitlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `game_keys`
--
ALTER TABLE `game_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `promocodes`
--
ALTER TABLE `promocodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `roulette`
--
ALTER TABLE `roulette`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `waitlist`
--
ALTER TABLE `waitlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
