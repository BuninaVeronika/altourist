-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2021 at 10:38 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `altouruist_degree_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `deferred_quests`
--

CREATE TABLE `deferred_quests` (
  `deferred_id` int(11) NOT NULL,
  `id_t` int(11) NOT NULL,
  `id_quests` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deferred_quests`
--

INSERT INTO `deferred_quests` (`deferred_id`, `id_t`, `id_quests`) VALUES
(25, 101, 390);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id_location` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `sity` varchar(50) NOT NULL,
  `carta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id_location`, `location_name`, `sity`, `carta`) VALUES
(1, 'Город', 'Курск', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/8/kursk/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\"></a><a href=\"https://yandex.ru/maps/8/kursk/geo/mikrorayon_severo_zapadny/53177466/?ll=36.136587%2C51.738706&source=wizgeo&utm_medium=mapframe&utm_source=maps&z=14\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\"></a><iframe src=\"https://yandex.ru/map-widget/v1/-/CCUU4-Gn~A\" frameborder=\"1\" allowfullscreen=\"true\" class=\'map_quest\'></iframe></div>'),
(2, 'Центральный округ', 'Курск', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/8/kursk/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\"></a><a href=\"https://yandex.ru/maps/8/kursk/geo/tsentralny_okrug/53177082/?ll=36.146244%2C51.765828&source=wizgeo&utm_medium=mapframe&utm_source=maps&z=12\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\"></a><iframe src=\"https://yandex.ru/map-widget/v1/-/CCUU4-cX-C\" frameborder=\"1\" allowfullscreen=\"true\" class=\'map_quest\'></iframe></div>'),
(3, 'Северо-Западный район', 'Курск', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/8/kursk/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\"></a><a href=\"https://yandex.ru/maps/geo/kursk/53057385/?ll=36.182231%2C51.722267&source=wizgeo&utm_medium=mapframe&utm_source=maps&z=11\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\"></a><iframe src=\"https://yandex.ru/map-widget/v1/-/CCUU4-gV8B\" frameborder=\"1\" allowfullscreen=\"true\" class=\'map_quest\'></iframe></div>'),
(4, 'Сеймский округ', 'Курск', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/8/kursk/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\"></a><a href=\"https://yandex.ru/maps/8/kursk/geo/seymskiy_okrug/53177083/?ll=36.135213%2C51.669305&source=wizgeo&utm_medium=mapframe&utm_source=maps&z=12\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\"></a><iframe src=\"https://yandex.ru/map-widget/v1/-/CCUU4-Do8D\"  frameborder=\"1\" allowfullscreen=\"true\" class=\'map_quest\'></iframe></div>'),
(5, 'Железнодорожный округ', 'Курск', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/8/kursk/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\">Курск</a><a href=\"https://yandex.ru/maps/8/kursk/geo/zheleznodorozhny_okrug/53177081/?ll=36.245351%2C51.730439&source=wizgeo&utm_medium=mapframe&utm_source=maps&z=12\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\">Железнодорожный округ</a><iframe src=\"https://yandex.ru/map-widget/v1/-/CCUU4-TQCD\" frameborder=\"1\" allowfullscreen=\"true\" class=\'map_quest\'></iframe></div>'),
(6, 'Твоя локация', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mailing_email`
--

CREATE TABLE `mailing_email` (
  `email_t` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mailing_email`
--

INSERT INTO `mailing_email` (`email_t`) VALUES
('adminbun@gmail.com'),
('FerenicaVV0@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `passing`
--

CREATE TABLE `passing` (
  `id_t` int(11) NOT NULL,
  `id_task_passing` int(11) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quests_altrst`
--

CREATE TABLE `quests_altrst` (
  `id_quests` int(11) NOT NULL,
  `quests_name` varchar(250) DEFAULT NULL COMMENT 'название квеста',
  `text_quests` text COMMENT 'описание квеста',
  `reiting` varchar(9) DEFAULT NULL COMMENT 'рейтинг голосов за квест',
  `file` text,
  `age` varchar(2) DEFAULT NULL COMMENT 'возрастное ограничение',
  `sale` varchar(5) DEFAULT NULL COMMENT 'стоимость',
  `time` varchar(5) DEFAULT NULL COMMENT 'время прохождения',
  `distance` varchar(15) DEFAULT NULL,
  `man` varchar(2) DEFAULT NULL,
  `complication` varchar(11) DEFAULT NULL COMMENT 'сложность',
  `status` int(11) DEFAULT NULL COMMENT 'одобрен ли квест',
  `tegi` varchar(250) DEFAULT NULL COMMENT 'теги зависят от задач',
  `technical` varchar(250) DEFAULT NULL COMMENT ' технические требования',
  `id_location` int(11) DEFAULT NULL,
  `id_section` int(11) DEFAULT NULL,
  `id_t` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quests_altrst`
--

INSERT INTO `quests_altrst` (`id_quests`, `quests_name`, `text_quests`, `reiting`, `file`, `age`, `sale`, `time`, `distance`, `man`, `complication`, `status`, `tegi`, `technical`, `id_location`, `id_section`, `id_t`) VALUES
(390, 'О школе и жизни после выпускного', 'Говорят, что надо мыслить шире, тянуться к звёздам. И после этого запирают нас на 12 лет, указывают, где сидеть, куда писать и как думать. А потом нам исполняется 18  и несмотря на то, что у нас в голове ещё не было ни одной собственной мысли, нас заставляют принимать самые важные решения в жизни. И если у тебя нет денег и с оценками не очень, то большинство решений принимается за тебя.', '5', 'image/quest/11.04.2021_04.15.06IMG_5596.JPG', '16', '50', '50', '3.5', '3', '5', 1, NULL, NULL, 1, 1, 98),
(391, 'Из начала 9-й кассеты', 'Мне были нужны перемены, мне нужно было стать кем-то новым. У тебя было такое чувство? Я больше не хотела быть невидимой. Я собиралась всё изменить. Оторвать прошлое и оставить позади. Я хотела работать усерднее, стать умнее и сильнее. Ведь ты не можешь изменить других, а изменить себя можешь.', '0', 'image/quest/11.04.2021_04.17.44IMG_5699.JPG', '12', '150', '45', '3', '3', '5', 1, NULL, NULL, 2, 1, 98),
(392, 'Ханна Бейкер', 'У меня плохо с математикой, но одно я точно знаю. Один плюс один плюс один - это непростое уравнение. Алекс ушел первым. Он нашел других друзей. Променял нас. Мы улыбались друг другу при встрече и на этом все. Мы с Джессикой остались вдвоем. Но потом... Джессика тоже перестала приходить. Мы все пошли разными дорогами. Мне так казалось.', '4', 'image/quest/11.04.2021_04.19.32IMG_5858.JPG', '10', '140', '120', '2', '2', '5', 1, NULL, NULL, 3, 2, 98),
(393, 'Ярлыки на девушек, лол', 'Такова жизнь девушек.&#13;&#10;Люди осуждают тебя за внешность, за то, что о тебе говорят. Они вешают на тебя ярлыки.&#13;&#10;Мне кажется, мальчики сами определяют себя. Выбирают себе облик, за которым могут спрятаться большинство мальчиков.&#13;&#10;Думаю, некоторые из них понимают, каково это  бояться, чувствовать, будто мир повесил на тебя ярлык, с которым ты должна жить всю оставшуюся жизнь.&#13;&#10;Все девочки сталкиваются с этим, но далеко не все мальчики.&#13;&#10;Мы ожидаем, что на нас навесят ярлык и мы сами с этим справляемся.', '0', 'image/quest/11.04.2021_04.22.15IMG_5467.JPG', '10', '100', '100', '4', '3', '3', 1, NULL, NULL, 4, 3, 98),
(394, 'Ханна Бейкер', 'Привет, это Ханна. Ханна Бейкер. Всё правильно. Просто не выключайте свой... то, на чем вы это слушаете. Это я  живая и в стерео. Никаких обязательств, никакого вызова на бис, и в этот раз совершенно никаких просьб. Возьмите перекус и устраивайтесь поудобнее. Потому что я собираюсь рассказать вам историю всей своей жизни. Точнее того, как она закончилась. И если вы слушаете эту кассету, значит, вы одна из причин почему.', '0', 'image/quest/11.04.2021_04.25.39IMG_4479.JPG', '45', '4', '5', '4', '4', '7', 1, NULL, NULL, 5, 3, 98),
(395, 'Оливия Бейкер', 'Она мечтала поехать в Нью-Йорк и стать писательницей. Точно не знаю, когда эта мечта стала для неё недостижимой. Ханна... была моей мечтой. И теперь мне приходиться мечтать и за Ханну, и за себя... Как и всем вам. Так что, прошу... мечтайте. Мечтайте! И за Ханну тоже. Никому не позволяйте у вас это отнять. Никогда.', '3', 'image/quest/11.04.2021_04.27.2920190927_121846.jpg', '41', '120', '1', '1', '1', '1', 1, NULL, NULL, 6, 4, 98),
(396, 'Майк Ханниган', 'Если бы я знал, когда видел тебя в последний раз, что это последний раз, я бы постарался запомнить твое лицо, твою походку, все, связанное с тобой. И, если бы я знал, когда в последний раз тебя целовал, что это последний раз, я бы никогда не остановился.', '0', 'image/quest/11.04.2021_04.52.5720190930_010548.jpg', '15', '40', '100', '4', '5', '2', 1, NULL, NULL, 4, 6, 98),
(397, 'Жизнь как один день', 'Ты хотел изменить свою жизнь, но не мог этого сделать сам. Я то, кем ты хотел бы быть. Я выгляжу так, как ты мечтаешь выглядеть. Я трахаюсь так, как ты мечтаешь трахаться. Я умён, талантлив и, самое главное, свободен от всего, что сковывает тебя.', '0', 'image/quest/11.04.2021_08.10.35IMG_6014.JPG', '12', '10', '74', '1,2', '4', '12', 1, NULL, NULL, 2, 5, 98),
(398, 'Чак Паланик. Бойцовский клуб', 'Первое правило Бойцовского клуба никому не рассказывать о Бойцовском клубе. Второе правило Бойцовского клуба никогда никому не рассказывать о Бойцовском клубе. Третье правило Бойцовского клуба в схватке участвуют только двое. Четвертое правило Бойцовского клуба не более одного поединка за один раз. Пятое правило Бойцовского клуба бойцы сражаются без обуви и голые по пояс. Шестое правило Бойцовского клуба поединок продолжается столько, сколько потребуется. Седьмое правило Бойцовского клуба если противник потерял сознание или делает вид, что потерял, или говорит Хватит поединок окончен. Восьмое и последнее правило Бойцовского клуба новичок обязан принять бой.', '0', 'image/quest/11.04.2021_08.10.35IMG_6014.JPG', '2', '2', '2', '2', '2', '2', 1, NULL, NULL, 2, 7, 98),
(399, 'Портрет Дориана Грея', 'Так пользуйтесь же своей молодостью, пока она не ушла. Не тратьте понапрасну золотые дни, слушая нудных святош, не пытайтесь исправлять то, что неисправимо, не отдавайте свою жизнь невеждам, пошлякам и ничтожествам, следуя ложным идеям и нездоровым стремлениям нашей эпохи. Живите! Живите той чудесной жизнью, что скрыта в вас. Ничего не упускайте, вечно ищите все новых ощущений! Ничего не бойтесь!', '0', 'image/quest/11.04.2021_08.17.52IMG_5991.JPG', '7', '77', '77', '7', '2', '7', 1, NULL, NULL, 1, 8, 98),
(400, 'Портрет Дориана Грея Чувства', 'Только людям ограниченным нужны годы, чтобы отделаться от какого-нибудь чувства или впечатления. А человек, умеющий собой владеть, способен покончить с печалью так же легко, как найти новую радость. Я не желаю быть рабом своих переживаний. Я хочу ими насладиться, извлечь из них все, что можно. Хочу властвовать над своими чувствами.', '0', 'image/quest/11.04.2021_08.19.50IMG_6084.JPG', '12', '20', '120', '5', '5', '8', 1, NULL, NULL, 4, 9, 98),
(402, 'рауеееее', 'Просто так и так и так вот тва фырутащф ырщ фывуацщ уцамфвт ууугфвртмущцмфв увгмфрипуцщрфигуц ммвуыыыыыыыыыыыыыыыыыыыыыы фму ыцгшрпмфгуц мвуцроимвуц умвфгршрфтрфгу увмммммммммммргоугцрчгуцш вуфмрцигшрмвгуцпшрмишгуц афувиолггрфвуйгш уавифшугшув уавцигшупгиауцгш уавфгшарпшгпц', '0', 'image/quest/22.04.2021_10.34.40Di15khilygs.jpg', '8', '8', '8', '8', '8', '8', 0, NULL, NULL, 0, 0, 101);

-- --------------------------------------------------------

--
-- Table structure for table `quest_purchases`
--

CREATE TABLE `quest_purchases` (
  `purchases_id` int(11) NOT NULL,
  `id_t` int(11) NOT NULL,
  `id_quests` int(11) NOT NULL,
  `data_price` datetime NOT NULL,
  `number_operation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quest_purchases`
--

INSERT INTO `quest_purchases` (`purchases_id`, `id_t`, `id_quests`, `data_price`, `number_operation`) VALUES
(1, 98, 384, '2021-04-09 22:33:07', NULL),
(2, 98, 389, '2021-04-10 19:44:11', NULL),
(3, 98, 386, '2021-04-10 23:23:28', NULL),
(4, 98, 390, '2021-04-11 16:42:08', NULL),
(5, 98, 391, '2021-04-11 16:42:48', NULL),
(6, 98, 394, '2021-04-11 16:43:39', NULL),
(7, 98, 392, '2021-04-11 16:50:22', NULL),
(8, 98, 398, '2021-04-11 20:28:16', NULL),
(9, 98, 393, '2021-04-11 22:22:16', NULL),
(10, 98, 397, '2021-04-11 22:26:28', NULL),
(11, 98, 395, '2021-04-11 22:27:54', NULL),
(12, 101, 395, '2021-04-21 22:28:52', NULL),
(13, 101, 395, '2021-04-21 22:52:31', NULL),
(14, 101, 390, '2021-04-21 22:52:35', NULL),
(15, 101, 392, '2021-04-21 22:58:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `id_t` int(11) NOT NULL,
  `id_quests` int(11) NOT NULL,
  `assessment` int(2) DEFAULT NULL COMMENT 'Оценка',
  `text_quests` text COMMENT 'Текст рецензии',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `id_t`, `id_quests`, `assessment`, `text_quests`, `date`) VALUES
(1, 101, 390, 5, 'Привет мир, я для тебя и для себя и куда-то там', '2021-04-22'),
(2, 101, 392, 4, 'А я не рассчитываю, что так должно быть, может и не для этого надо было', '2021-04-22'),
(3, 101, 395, 3, 'Это просто история о нас и о том, что мы устроили, а куда-то там бежали и искади', '2021-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id_section` int(11) NOT NULL,
  `section_name` varchar(250) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id_section`, `section_name`, `file`) VALUES
(1, 'Спортивные', './image/section/4397840.jpg'),
(2, 'Исторические', './image/section/2350368.jpg'),
(3, 'Архитектурные', './image/section/4916671.jpg'),
(4, 'Домашние', './image/section/4352247.jpg'),
(5, 'Умственные', './image/section/3166839.jpg'),
(6, 'Праздничные', './image/section/3951652.jpg'),
(7, 'Детские', './image/section/1857157.jpg'),
(8, 'Велосипедные', './image/section/3370153.jpg'),
(9, 'Автомобильные', './image/section/2303781.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id_task_passing` int(11) NOT NULL,
  `id_task` int(11) DEFAULT NULL,
  `id_quests` int(11) DEFAULT NULL,
  `inf_task_text` text COMMENT 'описание задания',
  `answer` varchar(150) DEFAULT NULL COMMENT 'ответ',
  `hint` varchar(250) DEFAULT NULL COMMENT 'подсказка',
  `status` int(11) DEFAULT NULL COMMENT 'подтвержден ли',
  `time` varchar(3) DEFAULT NULL,
  `coordinates` varchar(250) DEFAULT NULL,
  `file_url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id_task_passing`, `id_task`, `id_quests`, `inf_task_text`, `answer`, `hint`, `status`, `time`, `coordinates`, `file_url`) VALUES
(136, 1, 390, '5', '', '', 0, '5', '|', ''),
(137, 2, 390, '5', '4', '4', 0, '4', '|', ''),
(138, 3, 390, '5', '8', '7', 0, '8', '|', ''),
(139, 3, 390, '5', '8', '7', 0, '8', '|', ''),
(140, 4, 390, '7', '', '7', 0, '7', '|', ''),
(141, 5, 390, '5', '', '8', 0, '7', '|', ''),
(142, 6, 390, '89', '9', '9', 0, '9', '|', ''),
(143, 7, 390, '8596', '98', '9', 0, '9', '|', ''),
(144, 1, 391, '85', '', '', 0, '5', '|', ''),
(145, 2, 391, '58', '5', '8', 0, '8', '|', ''),
(146, 3, 391, '8585', '8', '5', 0, '5', '|', ''),
(147, 7, 391, '8547', '785', '785', 0, '7', '|', ''),
(148, 1, 391, '785', '785', '75', 0, '75', '|', ''),
(149, 1, 392, '4', '', '', 0, '4', '|', ''),
(150, 2, 392, '424', '24', '4', 0, '4', '|', ''),
(151, 4, 392, '42', '', '42', 0, '424', '|', ''),
(152, 6, 392, '42444444', '4', '41', 0, '4', '|', ''),
(153, 1, 393, '4854785', '785', '785', 0, '758', '|', ''),
(154, 2, 393, '785', '7', '758', 0, '75', '|', ''),
(155, 4, 393, '74544', '', '745', 0, '475', '|', ''),
(156, 6, 393, '7454', '75', '74', 0, '75', '|', ''),
(157, 1, 393, 'уацывау', '213', '13', 0, '12', '|', ''),
(158, 1, 394, '54', '', '', 0, '7', '|', ''),
(159, 5, 394, '74', '', '74', 0, '47', '|', ''),
(160, 3, 394, '74', '7', '74', 0, '74', '|', ''),
(161, 3, 394, '7474', '47', '74', 0, '74', '|', ''),
(162, 7, 394, '7447', '74', '74', 0, '74', '|', ''),
(163, 4, 395, '41', '', '42', 0, '42', '|', ''),
(164, 7, 395, '4212', '424', '42', 0, '41', '|', ''),
(165, 5, 395, '421', '', '42', 0, '421', '|', ''),
(166, 2, 395, '41221', '54', '4142', 0, '54', '|', ''),
(167, 3, 396, '544', '4', '4', 0, '45', '|', ''),
(168, 2, 396, '47', '7', '7', 0, '5', '|', ''),
(169, 1, 397, 'Это твоя жизнь, и она становится короче каждую минуту.', '5', '5', 0, '5', '|', ''),
(170, 1, 397, 'Это твоя жизнь, и она становится короче каждую минуту.', '5', '5', 0, '5', '|', ''),
(171, 2, 397, 'К черту совершенство. Не надо его добиваться. Надо развиваться. Пусть фишки ложатся как ложатся.', '9', '9', 0, '9', '|', ''),
(172, 7, 397, 'Мы были на волосок от жизни!', '4', '4', 0, '4', '|', ''),
(173, 1, 398, '5', '5', '5', 0, '5', '|', ''),
(174, 3, 398, '7', '7', '7', 0, '7', '|', ''),
(175, 6, 398, '78', '8', '8', 0, '8', '|', ''),
(176, 2, 398, '87', '7', '7', 0, '7', '|', ''),
(177, 6, 398, '78', '7', '7', 0, '7', '|', ''),
(178, 1, 399, '78676', '8', '786', 0, '8', '|', ''),
(179, 1, 399, '7865', '786', '86', 0, '786', '|', ''),
(180, 6, 399, '786', '867', '76', 0, '786', '|', ''),
(181, 1, 399, '7688', '76', '786', 0, '76', '|', ''),
(182, 2, 399, '7867', '78', '687', 0, '768', '|', ''),
(183, 1, 400, '78545786', '86', '876', 0, '8', '|', ''),
(184, 3, 400, '78674', '786', '76', 0, '768', '|', ''),
(185, 7, 400, '7865487', '78', '786', 0, '768', '|', ''),
(186, 5, 402, '12', '', '12', 0, '1', '|', ''),
(187, 6, 402, '1', '1', '1', 0, '1', '|', '');

-- --------------------------------------------------------

--
-- Table structure for table `type_task`
--

CREATE TABLE `type_task` (
  `id_task` int(11) NOT NULL,
  `type_icon` varchar(10) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'вид задания',
  `info_task` varchar(350) NOT NULL COMMENT 'описания вида'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_task`
--

INSERT INTO `type_task` (`id_task`, `type_icon`, `type`, `info_task`) VALUES
(1, '&#xe805;', 'Простая фотография', 'Бывает такое, что ты просто хочешь чтобы люди осмотрелись и сфотографировали то, что им действительно нравится.\r\nСуть задания состоит, как раз в этом. Ты можешь о чем то рассказать или попросить сфотографировать что-то конкретное, но в конечном итоге, пользователь сам решает, что ему запечатлеть, чтобы перейти к следующему заданию.'),
(2, '&#xe805;', 'Распознание текста на фотографии', 'Название улиц или магазинные вывески, если что-то кажется тебе настолько важным, чтобы проверить текст не ручным набором а распознанием текста на фотографии, это как раз тот вариант.\r\nСмелее пиши ответ на вопрос, функция же сравнит его с текстом на фото, но учти это займет какое-то время.'),
(3, '&#xe805;', 'Распознание лиц на фотографии', 'В прогулке с друзьями всегда нужно найти время сделать совместное фото, хотя лица есть и у статуй.\r\nНапиши же, сколько наш алгоритм должен найти лиц на фотографии.'),
(4, '&#xe805;', 'Геоданные', 'Какой-же квест-тур без переходов на искомые точки. Придется попотеть, чтобы найти назначенную координату, но ты знаешь, как лучше сформулировать вопрос, чтобы у пользователя все получилось играючи.'),
(5, '&#xe805;', 'Сравнение изображений', 'Функция сравнивает искомое изображение с фотографией пользователя, но будьте осторожны, потому что в основном сравниваются цветовые характеристики, подберите такой вариант, который легко можно будет повторить.'),
(6, '&#xe805;', 'Распознание QR кода', 'Введите ключевую фразу в ответ и сохраните сформированный qr код, чтобы в дальнейшем - пользователь смог распознать фразу на расположенных по вашему усмотрению сохраненных изображениях.'),
(7, '&#xe805;', 'Голосовое распознование', 'В эмоциональные моменты хочется что-то крикнуть, выразить свое восхищение, да и просто сказать ответ на вопрос другу.\r\nЭта функция, взаимодействует с предложениями, напиши свой ответ словом или фразой.'),
(8, '&#xe805;', 'Проверка текста', 'Классическая схема \"вопрос-ответ\", не надо что-то придумать, мы просто сравним две строки.');

-- --------------------------------------------------------

--
-- Table structure for table `user_tourist`
--

CREATE TABLE `user_tourist` (
  `id_t` int(11) NOT NULL COMMENT 'ид',
  `name_t` varchar(100) NOT NULL COMMENT 'имя для сайта',
  `email_t` varchar(250) NOT NULL,
  `password_t` varchar(255) DEFAULT NULL COMMENT 'пароль',
  `number_t` varchar(20) NOT NULL,
  `cookies_hash` varchar(255) DEFAULT NULL COMMENT 'для безопасной авторизации без пароля',
  `rating` int(10) DEFAULT NULL COMMENT 'рейтинг по прохождениям',
  `avatar` text COMMENT 'путь к аватарке',
  `email_confirmation` varchar(250) DEFAULT NULL COMMENT 'подверждение почты',
  `number_confirmation` int(15) NOT NULL,
  `repassword_t` varchar(250) DEFAULT NULL COMMENT 'хеш сумма для восстановления пароля',
  `date_of_visit` date DEFAULT NULL COMMENT 'дата визита',
  `role_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_tourist`
--

INSERT INTO `user_tourist` (`id_t`, `name_t`, `email_t`, `password_t`, `number_t`, `cookies_hash`, `rating`, `avatar`, `email_confirmation`, `number_confirmation`, `repassword_t`, `date_of_visit`, `role_admin`) VALUES
(101, 'Вероника Владимировна Бунина', 'FerenicaVV@gmail.com', '$2y$10$GHgxtjxIRdgcF2j9yHeHt.pCI3R5YpqN6bRzrDn2K3FNe6tFubHiO', '+79207097169', '$2y$10$feuYLoRVMAJZvZruOKCJBuQxmSGiAMOvuUG3ZTGP5CN6cWi.lDLG2', 0, 'image/avatar/1.jpg', '1', 1, NULL, '2021-04-21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deferred_quests`
--
ALTER TABLE `deferred_quests`
  ADD PRIMARY KEY (`deferred_id`),
  ADD KEY `id_t` (`id_t`),
  ADD KEY `id_quests` (`id_quests`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`);

--
-- Indexes for table `mailing_email`
--
ALTER TABLE `mailing_email`
  ADD UNIQUE KEY `email_t` (`email_t`);

--
-- Indexes for table `passing`
--
ALTER TABLE `passing`
  ADD KEY `id_t` (`id_t`),
  ADD KEY `id_task_passing` (`id_task_passing`);

--
-- Indexes for table `quests_altrst`
--
ALTER TABLE `quests_altrst`
  ADD PRIMARY KEY (`id_quests`),
  ADD KEY `id_location` (`id_location`),
  ADD KEY `id_section` (`id_section`),
  ADD KEY `id_t` (`id_t`);

--
-- Indexes for table `quest_purchases`
--
ALTER TABLE `quest_purchases`
  ADD PRIMARY KEY (`purchases_id`),
  ADD KEY `id_t` (`id_t`),
  ADD KEY `id_quests` (`id_quests`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_t` (`id_t`),
  ADD KEY `id_quests` (`id_quests`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task_passing`),
  ADD KEY `id_task` (`id_task`),
  ADD KEY `id_quests` (`id_quests`);

--
-- Indexes for table `type_task`
--
ALTER TABLE `type_task`
  ADD PRIMARY KEY (`id_task`);

--
-- Indexes for table `user_tourist`
--
ALTER TABLE `user_tourist`
  ADD PRIMARY KEY (`id_t`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deferred_quests`
--
ALTER TABLE `deferred_quests`
  MODIFY `deferred_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quests_altrst`
--
ALTER TABLE `quests_altrst`
  MODIFY `id_quests` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `quest_purchases`
--
ALTER TABLE `quest_purchases`
  MODIFY `purchases_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id_task_passing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `type_task`
--
ALTER TABLE `type_task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tourist`
--
ALTER TABLE `user_tourist`
  MODIFY `id_t` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ид', AUTO_INCREMENT=102;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deferred_quests`
--
ALTER TABLE `deferred_quests`
  ADD CONSTRAINT `deferred_quests_ibfk_1` FOREIGN KEY (`id_quests`) REFERENCES `quests_altrst` (`id_quests`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deferred_quests_ibfk_2` FOREIGN KEY (`id_t`) REFERENCES `user_tourist` (`id_t`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passing`
--
ALTER TABLE `passing`
  ADD CONSTRAINT `passing_ibfk_1` FOREIGN KEY (`id_t`) REFERENCES `user_tourist` (`id_t`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passing_ibfk_2` FOREIGN KEY (`id_task_passing`) REFERENCES `task` (`id_task_passing`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_quests`) REFERENCES `quests_altrst` (`id_quests`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_t`) REFERENCES `user_tourist` (`id_t`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`id_quests`) REFERENCES `quests_altrst` (`id_quests`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`id_task`) REFERENCES `type_task` (`id_task`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
