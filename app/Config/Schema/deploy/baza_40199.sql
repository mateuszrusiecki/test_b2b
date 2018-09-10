-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 27 Maj 2015, 09:32
-- Wersja serwera: 5.5.12
-- Wersja PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Struktura tabeli dla tabeli `checklist_positions`
--

CREATE TABLE IF NOT EXISTS `checklist_positions` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Struktura tabeli dla tabeli `checklist_position_groups`
--

CREATE TABLE IF NOT EXISTS `checklist_position_groups` (
  `id` int(11) NOT NULL,
  `group_id` char(36) NOT NULL,
  `checklist_position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
