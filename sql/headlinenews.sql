-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2019 at 03:52 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `headlinenews`
--
CREATE DATABASE IF NOT EXISTS `headlinenews` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `headlinenews`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `regtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastlogintime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store info of accounts';

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `type`, `regtime`, `lastlogintime`) VALUES
(8, 'admin', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', 'admin', '2019-03-30 15:45:26', '2019-03-30 15:45:26'),
(9, 'free user', '202cb962ac59075b964b07152d234b70', 'paid@gmail.com', 'paid', '2019-03-30 15:51:06', '2019-03-30 15:51:06'),
(10, 'free user 1', '202cb962ac59075b964b07152d234b70', 'free1@gmail.com', 'free', '2019-03-31 22:38:47', '2019-03-31 22:38:47'),
(11, 'free user 3', '202cb962ac59075b964b07152d234b70', 'free3@gmail.com', 'free', '2019-03-31 22:45:02', '2019-03-31 22:45:02'),
(12, 'free user 4', '202cb962ac59075b964b07152d234b70', 'free4@gmail.com', 'free', '2019-03-31 22:45:41', '2019-03-31 22:45:41'),
(13, 'free user 5', '202cb962ac59075b964b07152d234b70', 'free5@gmail.com', 'free', '2019-03-31 22:46:02', '2019-03-31 22:46:02'),
(14, 'free user 6', '202cb962ac59075b964b07152d234b70', 'free6@gmail.com', 'free', '2019-03-31 22:46:38', '2019-03-31 22:46:38'),
(15, 'free user 7', '202cb962ac59075b964b07152d234b70', 'free7@gmail.com', 'free', '2019-04-01 00:27:24', '2019-04-01 00:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `ch_id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `source` varchar(100) NOT NULL,
  `location` varchar(30) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`ch_id`, `name`, `source`, `location`, `icon`, `category`) VALUES
(20, 'Le Monde', 'le-monde', 'Europe', 'LeMondeAPI.png', NULL),
(21, 'Google News (Australia)', 'google-news-au', 'Australia', 'GoogleNews(Australia)API.png', NULL),
(25, 'GÃ¶teborgs-Posten', 'goteborgs-posten', 'Europe', 'GÃ¶teborgs-PostenAPI.png', NULL),
(29, 'News.com.au', 'news-com-au', 'Australia', 'News.com.auAPI.png', NULL),
(30, 'Australian Financial Review', 'australian-financial-review', 'Australia', 'AustralianFinancialReviewAPI.png', NULL),
(31, 'ABC News', 'abc-news', 'American', 'ABCNewsAPI.png', NULL),
(32, 'ABC News (AU)', 'abc-news-au', 'Australia', 'ABCNews(AU)API.png', NULL),
(33, 'Aftenposten', 'aftenposten', 'Europe', 'AftenpostenAPI.png', NULL),
(34, 'Al Jazeera English', 'al-jazeera-english', 'Asia', 'AlJazeeraEnglishAPI.png', NULL),
(35, 'ANSA.it', 'ansa', 'Europe', 'ANSA.itAPI.png', NULL),
(36, 'Argaam', 'argaam', 'Asia', 'ArgaamAPI.png', NULL),
(37, 'Ars Technica', 'ars-technica', 'Asia', 'ArsTechnicaAPI.png', NULL),
(38, 'Ary News', 'ary-news', 'Australia', 'AryNewsAPI.png', NULL),
(39, 'Associated Press', 'associated-press', 'American', 'AssociatedPressAPI.png', NULL),
(40, 'Axios', 'axios', 'Asia', 'AxiosAPI.png', NULL),
(41, 'BBC New', 'bbc-news', 'Europe', 'BBCNewsAPI.png', NULL),
(42, 'BBC Sport', 'bbc-sport', 'Europe', 'BBCSportAPI.png', NULL),
(43, 'Bild', 'bild', 'Europe', 'BildAPI.png', NULL),
(44, 'Blasting News (BR)', 'blasting-news-br', 'Europe', 'BlastingNews(BR)API.png', NULL),
(45, 'Bleacher Report', 'bleacher-report', 'Europe', 'BleacherReportAPI.png', NULL),
(46, 'Bloomberg', 'bloomberg', 'American', 'BloombergAPI.png', NULL),
(47, 'Breitbart News', 'breitbart-news', 'American', 'BreitbartNewsAPI.png', NULL),
(48, 'Business Insider', 'business-insider', 'Europe', 'BusinessInsiderAPI.png', NULL),
(49, 'Business Insider (UK)', 'business-insider-uk', 'Europe', 'BusinessInsider(UK)API.png', NULL),
(50, 'Buzzfeed', 'buzzfeed', 'American', 'BuzzfeedAPI.png', NULL),
(51, 'CBC News', 'cbc-news', 'American', 'CBCNewsAPI.png', NULL),
(53, 'CNBC', 'cnbc', 'American', 'CNBCAPI.png', NULL),
(54, 'CNN API', 'cnn', 'American', 'CNNAPI.png', NULL),
(55, 'CNN Spanish', 'cnn-es', 'Europe', 'CNNSpanishAPI.png', NULL),
(56, 'Daily Mail', 'daily-mail', 'American', 'DailyMailAPI.png', NULL),
(57, 'Die Zeit', 'die-zeit', 'Europe', 'DieZeitAPI.png', NULL),
(58, 'El Mundo', 'el-mundo', 'Europe', 'ElMundoAPI.png', NULL),
(59, 'Engadget', 'engadget', 'Europe', 'EngadgetAPI.png', NULL),
(60, 'Entertainment Weekly', 'entertainment-weekly', 'American', 'EntertainmentWeeklyAPI.png', NULL),
(61, 'ESPN', 'espn', 'Europe', 'ESPNAPI.png', NULL),
(62, 'ESPN Cric Info', 'espn-cric-info', 'Europe', 'ESPNCricInfoAPI.png', NULL),
(63, 'Financial Post', 'financial-post', 'American', 'FinancialPostAPI.png', NULL),
(64, 'Financial Times', 'financial-times', 'Europe', 'FinancialTimesAPI.png', NULL),
(65, 'Focus', 'focus', 'Europe', 'FocusAPI.png', NULL),
(66, 'Football Italia', 'football-italia', 'Europe', 'FootballItaliaAPI.png', NULL),
(67, 'Fortune', 'fortune', 'American', 'FortuneAPI.png', NULL),
(68, 'FourFourTwo', 'four-four-two', 'American', 'FourFourTwoAPI.png', NULL),
(69, 'Fox News', 'fox-news', 'American', 'FoxNewsAPI.png', NULL),
(70, 'Fox Sports', 'fox-sports', 'American', 'FoxSportsAPI.png', NULL),
(71, 'Globo', 'globo', 'American', 'GloboAPI.png', NULL),
(72, 'Google News', 'google-news', 'American', 'GoogleNewsAPI.png', NULL),
(73, 'Google News (Argentina)', 'google-news-ar', 'American', 'GoogleNews(Argentina)API.png', NULL),
(74, 'Google News (Brasil)', 'google-news-br', 'American', 'GoogleNews(Brasil)API.png', NULL),
(75, 'Google News (Canada)', 'google-news-ca', 'American', 'GoogleNews(Canada)API.png', NULL),
(76, 'Google News (France)', 'google-news-fr', 'Europe', 'GoogleNews(France)API.png', NULL),
(77, 'Google News (India)', 'google-news-in', 'Asia', 'GoogleNews(India)API.png', NULL),
(78, 'Google News (Israel)', 'google-news-is', 'Asia', 'GoogleNews(Israel)API.png', NULL),
(79, 'Google News (Italy)', 'google-news-it', 'Europe', 'GoogleNews(Italy)API.png', NULL),
(80, 'Google News (Russia)', 'google-news-ru', 'Europe', 'GoogleNews(Russia)API.png', NULL),
(81, 'Google News (Saudi Arabia)', 'google-news-sa', 'Asia', 'GoogleNews(SaudiArabia)API.png', NULL),
(82, 'Google News (UK)', 'google-news-uk', 'Europe', 'GoogleNews(UK)API.png', NULL),
(83, 'Gruenderszene', 'gruenderszene', 'Europe', 'GruenderszeneAPI.png', NULL),
(84, 'Hacker News', 'hacker-news', 'American', 'HackerNewsAPI.png', NULL),
(85, 'IGN API', 'ign', 'American', 'IGNAPI.png', NULL),
(86, 'Il Sole 24 Ore', 'il-sole-24-ore', 'Europe', 'IlSole24OreAPI.png', NULL),
(87, 'Independent', 'independent', 'Europe', 'IndependentAPI.png', NULL),
(88, 'Infobae', 'infobae', 'American', 'InfobaeAPI.png', NULL),
(89, 'InfoMoney', 'info-money', 'American', 'InfoMoneyAPI.png', NULL),
(90, 'La Gaceta', 'la-gaceta', 'American', 'LaGacetaAPI.png', NULL),
(91, 'La Nacion', 'la-nacion', 'American', 'LaNacionAPI.png', NULL),
(93, 'La Repubblica', 'la-repubblica', 'Europe', 'LaRepubblicaAPI.png', NULL),
(94, 'Lenta', 'lenta', 'Europe', 'LentaAPI.png', NULL),
(95, 'L\'equipe', 'lequipe', 'Europe', 'L\'equipeAPI.png', NULL),
(96, 'Les Echos', 'les-echos', 'Europe', 'LesEchosAPI.png', NULL),
(97, 'LibÃ©ration', 'liberation', 'Europe', 'LibÃ©rationAPI.png', NULL),
(98, 'Marca', 'marca', 'Europe', 'MarcaAPI.png', NULL),
(99, 'Mashable', 'mashable', 'American', 'MashableAPI.png', NULL),
(100, 'Medical News Today', 'medical-news-today', 'American', 'MedicalNewsTodayAPI.png', NULL),
(101, 'Metro', 'metro', 'American', 'MetroAPI.png', NULL),
(102, 'Mirror', 'mirror', 'Europe', 'MirrorAPI.png', NULL),
(103, 'MSNBC', 'msnbc', 'American', 'MSNBCAPI.png', NULL),
(104, 'MTV News', 'mtv-news', 'American', 'MTVNewsAPI.png', NULL),
(105, 'MTV News (UK)', 'mtv-news-uk', 'Europe', 'MTVNews(UK)API.png', NULL),
(106, 'National Geographic', 'national-geographic', 'American', 'NationalGeographicAPI.png', NULL),
(107, 'National Review', 'national-review', 'American', 'NationalReviewAPI.png', NULL),
(108, 'NBC News', 'nbc-news', 'American', 'NBCNewsAPI.png', NULL),
(109, 'New Scientist', 'new-scientist', 'American', 'NewScientist.png', NULL),
(110, 'Newsweek', 'newsweek', 'American', 'Newsweek.png', NULL),
(111, 'New York Magazine', 'new-york-magazine', 'American', 'NewYorkMagazine.png', NULL),
(112, 'Next Big Future', 'next-big-future', 'American', 'NextBigFuture.png', NULL),
(113, 'NFL News', 'nfl-news', 'American', 'NFLNews.png', NULL),
(114, 'NHL News', 'nhl-news', 'American', 'NHLNews.png', NULL),
(115, 'NRK', 'nrk', 'Europe', 'NRK.png', NULL),
(116, 'Politico', 'politico', 'American', 'Politico.png', NULL),
(117, 'Polygon', 'polygon', 'American', 'Polygon.png', NULL),
(119, 'RBC', 'rbc', 'Europe', 'RBC.png', NULL),
(120, 'Recode', 'recode', 'American', 'Recode.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(4) NOT NULL,
  `ch_id` int(4) NOT NULL,
  `createtime` datetime NOT NULL,
  `closetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To store history info';

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `ch_id`, `createtime`, `closetime`) VALUES
(9, 39, '2019-03-30 11:06:00', 0),
(10, 31, '2019-03-31 18:24:49', 0),
(10, 37, '2019-03-31 16:39:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscript`
--

CREATE TABLE `subscript` (
  `id` int(4) NOT NULL,
  `ch_id` int(4) NOT NULL,
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To store subscript info';

--
-- Dumping data for table `subscript`
--

INSERT INTO `subscript` (`id`, `ch_id`, `createtime`) VALUES
(9, 31, '2019-03-31 20:05:11'),
(9, 46, '2019-03-31 20:05:11'),
(9, 68, '2019-03-31 20:05:11'),
(9, 90, '2019-03-31 20:05:11'),
(9, 111, '2019-03-31 20:05:11'),
(10, 30, '2019-03-31 18:26:05'),
(10, 110, '2019-03-31 18:26:05'),
(10, 112, '2019-03-31 18:26:05'),
(10, 114, '2019-03-31 18:26:05'),
(10, 120, '2019-03-31 18:26:05'),
(13, 39, '2019-03-31 16:46:12'),
(13, 46, '2019-03-31 16:46:12'),
(13, 47, '2019-03-31 16:46:12'),
(13, 50, '2019-03-31 16:46:12'),
(13, 69, '2019-03-31 16:46:12'),
(14, 67, '2019-03-31 16:46:58'),
(14, 84, '2019-03-31 16:46:58'),
(14, 104, '2019-03-31 16:46:58'),
(14, 114, '2019-03-31 16:46:58'),
(14, 116, '2019-03-31 16:46:58'),
(15, 31, '2019-03-31 18:28:31'),
(15, 39, '2019-03-31 18:28:31'),
(15, 114, '2019-03-31 18:28:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`ch_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`,`ch_id`,`createtime`);

--
-- Indexes for table `subscript`
--
ALTER TABLE `subscript`
  ADD PRIMARY KEY (`id`,`ch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `ch_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
