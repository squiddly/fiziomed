-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2014 at 10:30 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fiziomed`
--
CREATE DATABASE IF NOT EXISTS `fiziomed` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fiziomed`;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_pro_id` int(11) NOT NULL,
  `app_pat_id` int(11) NOT NULL,
  `app_start_date` timestamp NULL DEFAULT NULL,
  `app_pro_pat_number` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Number of patients',
  `app_pro_normal_duration` tinyint(4) NOT NULL DEFAULT '30' COMMENT 'In minutes',
  PRIMARY KEY (`app_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=98 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `app_pro_id`, `app_pat_id`, `app_start_date`, `app_pro_pat_number`, `app_pro_normal_duration`) VALUES
(1, 2, 1, '2013-12-06 14:20:14', 1, 30),
(2, 2, 20, '2013-12-11 18:30:00', 1, 20),
(3, 10, 3, '2013-12-11 11:00:00', 1, 20),
(4, 10, 4, '2013-12-11 11:20:00', 1, 30),
(5, 10, 4, '2013-12-11 11:50:00', 1, 30),
(6, 10, 5, '2013-12-11 12:30:00', 1, 30),
(7, 10, 6, '2013-12-11 13:00:00', 1, 30),
(8, 10, 7, '2013-12-11 13:30:00', 1, 30),
(9, 10, 8, '2013-12-11 14:00:00', 1, 30),
(10, 10, 9, '2013-12-11 14:30:00', 1, 30),
(11, 10, 11, '2013-12-11 15:00:00', 1, 30),
(12, 10, 12, '2013-12-11 17:00:00', 1, 30),
(13, 10, 13, '2013-12-11 17:40:00', 1, 30),
(14, 10, 14, '2013-12-11 18:30:00', 1, 30),
(15, 10, 14, '2013-12-11 19:00:00', 1, 30),
(16, 10, 15, '2013-12-11 19:30:00', 1, 30),
(17, 10, 16, '2013-12-11 20:00:00', 1, 30),
(18, 10, 18, '2013-12-11 20:40:00', 1, 20),
(19, 10, 19, '2013-12-11 21:00:00', 1, 30),
(20, 8, 21, '2013-12-11 14:20:00', 1, 10),
(21, 8, 15, '2013-12-11 18:50:00', 1, 10),
(22, 8, 22, '2013-12-11 19:30:00', 1, 10),
(23, 8, 18, '2013-12-11 20:30:00', 1, 10),
(24, 8, 23, '2013-12-11 21:20:00', 1, 10),
(25, 4, 5, '2013-12-11 11:10:00', 1, 20),
(26, 4, 24, '2013-12-11 11:50:00', 1, 20),
(27, 4, 10, '2013-12-11 12:10:00', 1, 20),
(28, 4, 9, '2013-12-11 13:50:00', 1, 20),
(29, 4, 8, '2013-12-11 14:10:00', 1, 20),
(30, 4, 13, '2013-12-11 17:30:00', 1, 20),
(31, 4, 16, '2013-12-11 19:10:00', 1, 20),
(32, 4, 18, '2013-12-11 20:11:00', 1, 20),
(33, 4, 19, '2013-12-11 20:50:00', 1, 10),
(34, 7, 25, '2013-12-11 12:00:00', 1, 10),
(35, 7, 24, '2013-12-11 12:10:00', 1, 10),
(36, 7, 26, '2013-12-11 12:50:00', 1, 10),
(37, 7, 8, '2013-12-11 13:20:00', 1, 10),
(38, 7, 27, '2013-12-11 15:10:00', 1, 10),
(39, 7, 12, '2013-12-11 17:30:00', 1, 10),
(40, 7, 28, '2013-12-11 17:40:00', 1, 10),
(41, 7, 20, '2013-12-11 18:00:00', 1, 10),
(42, 7, 14, '2013-12-11 18:20:00', 1, 10),
(43, 7, 15, '2013-12-11 18:40:00', 1, 10),
(44, 7, 22, '2013-12-11 19:10:00', 1, 10),
(45, 7, 16, '2013-12-11 19:20:00', 1, 10),
(46, 7, 19, '2013-12-11 20:10:00', 1, 10),
(47, 7, 23, '2013-12-11 21:10:00', 1, 10),
(48, 5, 4, '2013-12-11 11:00:00', 2, 20),
(49, 5, 5, '2013-12-11 11:20:00', 2, 10),
(50, 5, 5, '2013-12-11 11:30:00', 1, 10),
(51, 5, 24, '2013-12-11 11:30:00', 1, 10),
(52, 5, 25, '2013-12-11 11:40:00', 2, 20),
(53, 5, 24, '2013-12-11 12:00:00', 2, 10),
(54, 5, 29, '2013-12-11 12:10:00', 2, 20),
(55, 5, 26, '2013-12-11 12:30:00', 1, 10),
(56, 5, 26, '2013-12-11 12:40:00', 2, 10),
(57, 5, 10, '2013-12-11 12:30:00', 1, 10),
(58, 5, 10, '2013-12-11 13:00:00', 2, 10),
(59, 5, 8, '2013-12-11 13:10:00', 2, 10),
(60, 5, 9, '2013-12-11 13:20:00', 2, 10),
(61, 5, 8, '2013-12-11 13:30:00', 1, 10),
(62, 5, 7, '2013-12-11 13:30:00', 1, 10),
(63, 5, 7, '2013-12-11 13:40:00', 2, 10),
(64, 5, 21, '2013-12-11 14:00:00', 2, 20),
(65, 5, 11, '2013-12-11 14:20:00', 2, 20),
(66, 5, 27, '2013-12-11 14:40:00', 2, 30),
(67, 5, 13, '2013-12-11 17:00:00', 2, 20),
(68, 5, 28, '2013-12-11 17:30:00', 2, 10),
(69, 5, 20, '2013-12-11 17:40:00', 2, 20),
(70, 5, 14, '2013-12-11 18:00:00', 2, 20),
(71, 5, 15, '2013-12-11 18:30:00', 2, 10),
(72, 5, 22, '2013-12-11 18:50:00', 2, 20),
(73, 5, 19, '2013-12-11 20:00:00', 2, 10),
(74, 5, 18, '2013-12-11 20:20:00', 2, 10),
(75, 5, 23, '2013-12-11 21:00:00', 2, 10),
(76, 3, 30, '2013-12-11 17:30:00', 1, 10),
(77, 10, 3, '2013-12-11 11:20:00', 1, 20),
(78, 10, 4, '2013-12-11 11:40:00', 1, 50),
(79, 10, 29, '2013-12-11 12:30:00', 1, 40),
(80, 10, 6, '2013-12-11 13:10:00', 1, 40),
(81, 10, 7, '2013-12-11 13:50:00', 1, 50),
(82, 10, 11, '2013-12-11 14:40:00', 1, 50),
(83, 10, 31, '2013-12-11 15:40:00', 1, 50),
(84, 10, 32, '2013-12-11 16:30:00', 1, 30),
(85, 10, 33, '2013-12-11 17:00:00', 1, 40),
(86, 10, 34, '2013-12-11 17:40:00', 1, 50),
(87, 10, 35, '2013-12-11 18:30:00', 1, 50),
(88, 10, 36, '2013-12-11 19:20:00', 1, 40),
(89, 10, 16, '2013-12-11 20:00:00', 1, 50),
(90, 10, 17, '2013-12-11 20:50:00', 1, 40),
(91, 10, 18, '2013-12-11 21:30:00', 1, 30),
(92, 1, 29, '2013-12-11 12:00:00', 1, 10),
(93, 1, 25, '2013-12-11 12:10:00', 1, 10),
(94, 1, 26, '2013-12-11 13:00:00', 1, 10),
(95, 1, 21, '2013-12-11 14:30:00', 1, 10),
(96, 1, 12, '2013-12-11 17:40:00', 1, 10),
(97, 1, 28, '2013-12-11 17:50:00', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `pat_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_lastname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pat_firstname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pat_pnc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Personal Numerical Code',
  `pat_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pat_age` tinyint(4) NOT NULL COMMENT 'Age in years',
  `pat_zone` text COLLATE utf8_bin NOT NULL COMMENT 'Zone/neighbourhood',
  PRIMARY KEY (`pat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pat_id`, `pat_lastname`, `pat_firstname`, `pat_pnc`, `pat_address`, `pat_age`, `pat_zone`) VALUES
(2, 'Vasile', 'Bumbac', '111111111111', 'Str. Rea nr. 5', 30, 'Burdujeni'),
(1, 'Ion', 'Popescu', '1234567891011', 'Str. Buna nr.1', 40, 'Centru'),
(3, 'Airoaie', 'Cosmin', '12345678901', 'Str. Lunga nr.17', 39, 'Centru'),
(4, 'Todica', 'Alexandra', '22345678999', 'Str. Nivelului', 36, 'Itcani'),
(5, 'Anichitei', 'Ioan', '22345678978', 'Str. Rea nr.5', 27, 'Centru'),
(6, 'Alexandru', 'Constantin', '12345628901', 'Str. Raiului nr.2', 68, 'Centru'),
(7, 'Ivan', 'Claudiu', '12345678957', 'Str. Vacanta Mare nr.7', 43, 'Obcini'),
(8, 'Serediuc', 'Teodora', '12345678978', 'Str. Iadului nr.6', 65, 'Burdujeni'),
(9, 'Horodnicu', 'Monica', '22345678955', 'Str. Ploii nr.14', 45, 'Centru'),
(10, 'Sandu', 'Eugen', '12345678900', 'Str. Violentei nr.8', 17, 'Centru'),
(11, 'Rzesovski', 'Otilia', '22345678957', 'Str. Enigmei nr.8', 29, 'Vest'),
(12, 'Mazila', 'Ancuta', '22345678901', 'Str. Hanului nr.17', 36, 'Centru'),
(13, 'Guliciuc', 'Geta', '22755344213', 'Str. Ucrainei nr.12', 49, 'Centru'),
(14, 'Paranici', 'Radu', '12755344212', 'Str. Ariciului nr.78', 78, 'Bosanci'),
(15, 'Chiuchisan', 'Maria', '22755344244', 'Str. Japoneza nr.0', 55, 'Obcini'),
(16, 'Senciuc', 'Nicoleta', '22755344277', 'Str. Trei nr.4', 66, 'Centru'),
(17, 'Nahemeac', 'Andreea', '22755344277', 'Str. Catolica nr.4', 74, 'Burdujeni'),
(18, 'Sandu', 'Viorica', '22755344255', 'Str. Lunga nr.4', 43, 'Zamca'),
(19, 'Costiuc', 'Alexandru', '12755344211', 'Str. Cuceritorului nr.78', 35, 'Centru'),
(20, 'Lucan', 'Viorica', '22233344455', 'Str. Lucius nr.2', 53, 'Centru'),
(21, 'Hutan', 'Maria', '22233344478', 'Str. Granitei nr.3', 56, 'Siret'),
(22, 'Damian', 'Nicu', '122333444552', 'Str. Sfantului nr.8', 55, 'Centru'),
(23, 'Ancuta', 'Adrian', '12233344453', 'Str. Hanului nr.15', 46, 'Obcini'),
(24, 'Clim', 'Viorica', '22233344477', 'Str. Florii nr.77', 37, 'Burdujeni'),
(25, 'Hreciniuc', 'Liana', '22233344464', 'Str. Polona nr.7', 36, 'Burdujeni'),
(26, 'Parpanuta', 'Silvia', '22233344475', 'Str. Branzei nr.4', 37, 'Scheia'),
(27, 'Bigu', 'Razvan', '122233344453', 'Str. Salii nr.78', 66, 'Centru'),
(28, 'Melter', 'Rozalia', '22233344467', 'Str. Spaniola nr.8', 37, 'Burdujeni'),
(29, 'Vartic', 'Mihai', '12233344454', 'Str. Bobonete nr.7', 39, 'Centru'),
(30, 'Grigore', 'Carmen', '22233344431', 'Str. Iazului nr.8', 39, 'Burdujeni'),
(31, 'Vorniceanu', 'Cristina', '22233344458', 'Str. Batalionului nr.3', 45, 'Centru'),
(32, 'Visinar', 'Maria', '22233344411', 'Str. Fructului nr.8', 28, 'Centru'),
(33, 'Antonesi', 'Alexandru', '12233344453', 'Str. Revolutiei nr.99', 25, 'Centru'),
(34, 'Petrescu', 'Carina', '213348659934', 'Str. Luceafarului nr.3', 25, 'Burdujeni'),
(35, 'Antoneac', 'Gabi', '113348659933', 'Str. Arhanghelei nr.7', 29, 'Obcini'),
(36, 'Bute', 'Alin', '113348659933', 'Str. Florilor nr.14', 25, 'Obcini');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE IF NOT EXISTS `procedures` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_procedure_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pro_normal_duration` int(11) NOT NULL COMMENT 'In minutes',
  `pro_priority` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Procedure priority',
  `pro_pat_number` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Number of patients per procedure',
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`pro_id`, `pro_procedure_name`, `pro_normal_duration`, `pro_priority`, `pro_pat_number`) VALUES
(1, 'Unde scurte', 10, 1, 1),
(2, 'Baie galvanica', 20, 1, 1),
(3, 'Shockwave', 10, 1, 1),
(4, 'Parafina', 20, 1, 1),
(5, 'Electroterapie', 10, 1, 1),
(6, 'Magnetoterapie', 20, 1, 1),
(7, 'Ultrasunete', 10, 1, 1),
(8, 'Laser', 10, 1, 1),
(10, 'Masaj', 30, 99, 1),
(11, 'Kinetoterapie', 60, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`, `state`) VALUES
(2, 'admin', 'admin@admin.com', NULL, '$2y$14$Mv9u5iPIJaOVJrEob70id.ytqk70xwKNyPczbaJ7xaAXyQv9M2dHu', NULL);
