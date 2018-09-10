-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 23 Cze 2015, 15:13
-- Wersja serwera: 5.5.12
-- Wersja PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `feb_b2b`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `crons`
--

CREATE TABLE IF NOT EXISTS `crons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `N` varchar(255) DEFAULT NULL COMMENT 'dni tygodnia',
  `m` varchar(255) DEFAULT NULL COMMENT 'miesiąc',
  `d` varchar(255) DEFAULT NULL COMMENT 'dzień',
  `H` varchar(255) DEFAULT NULL COMMENT 'godzina',
  `i` varchar(255) DEFAULT NULL COMMENT 'minuta',
  `url` varchar(255) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `crons`
--

INSERT INTO `crons` (`id`, `active`, `name`, `N`, `m`, `d`, `H`, `i`, `url`, `modified`, `created`) VALUES
(1, 1, 'Pobieranie raportów', '', '*', '1', '4', '52', '/client_domains/cron', '2015-06-23 12:12:26', '2015-06-23 12:12:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
