-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 26 Lut 2015, 12:20
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
-- Struktura tabeli dla tabeli `client_contact_client_leads`
--

CREATE TABLE IF NOT EXISTS `client_contact_client_leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_lead_id` int(11) NOT NULL,
  `client_contact_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `client_contact_client_leads`
--

INSERT INTO `client_contact_client_leads` (`id`, `client_lead_id`, `client_contact_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `client_leads`
--

CREATE TABLE IF NOT EXISTS `client_leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL COMMENT 'Nazwa leadu',
  `client_id` int(11) NOT NULL COMMENT 'ID klienta',
  `lead_category_id` int(11) NOT NULL COMMENT 'ID kategorii',
  `lead_status_id` int(11) NOT NULL COMMENT 'ID statusu',
  `probability` int(3) NOT NULL COMMENT 'Prawdopodobieństwo',
  `amount` int(11) NOT NULL COMMENT 'Wartość',
  `currency_id` int(11) NOT NULL COMMENT 'ID waluty',
  `user_id` char(36) COLLATE utf8_polish_ci NOT NULL COMMENT 'ID handlowca',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Leady klienta' AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `client_leads`
--

INSERT INTO `client_leads` (`id`, `name`, `client_id`, `lead_category_id`, `lead_status_id`, `probability`, `amount`, `currency_id`, `user_id`) VALUES
(1, 'Przykładowa nazwa leadu', 1, 2, 1, 50, 1000, 1, '3a38ee92-6934-102d-9f80-579a023712b2'),
(3, 'Testowy', 1, 1, 1, 20, 123, 1, '3a38ee92-6934-102d-9f80-579a023712b2'),
(4, 'test', 1, 1, 1, 30, 123, 1, '3a38ee92-6934-102d-9f80-579a023712b2'),
(5, '1231', 1, 1, 1, 30, 23, 1, '3a38ee92-6934-102d-9f80-579a023712b2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `code` char(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`) VALUES
(1, 'Złoty', 'PLN'),
(2, 'Euro', 'EUR'),
(3, 'Dolar', 'USD'),
(4, 'Funt', 'GBP');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lead_categories`
--

CREATE TABLE IF NOT EXISTS `lead_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Kategorie do leadów' AUTO_INCREMENT=37 ;

--
-- Zrzut danych tabeli `lead_categories`
--

INSERT INTO `lead_categories` (`id`, `name`) VALUES
(1, 'Administracja'),
(2, 'Adwords Google'),
(3, 'Aktualizacja'),
(4, 'Analizy i opracowania'),
(5, 'Aplikacja mobilna'),
(6, 'Aplikacje FB'),
(7, 'Buzz marketing'),
(8, 'Copywriting'),
(9, 'Domena'),
(10, 'Gadżety'),
(11, 'Gry'),
(12, 'Hosting'),
(13, 'Kampania'),
(14, 'Konferencja'),
(15, 'Konkursy'),
(16, 'Kurs komputerowy'),
(17, 'Mailing'),
(18, 'Marketing'),
(19, 'Marketing zintegrowany'),
(20, 'Mobile aps'),
(21, 'Oprogramowanie'),
(22, 'Partnerzy i sponsorzy'),
(23, 'Poligrafia'),
(24, 'Pozycjonowanie'),
(25, 'Premium SMS'),
(26, 'Projekty graficzne'),
(27, 'Ślubowisko.pl'),
(28, 'Social media'),
(29, 'System FEB CMS'),
(30, 'Transport'),
(31, 'Wsparcie'),
(32, 'Współpraca'),
(33, 'WWW'),
(34, 'Wydruk'),
(35, 'Wynajem komputerów'),
(36, 'Zdjęcia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lead_statuses`
--

CREATE TABLE IF NOT EXISTS `lead_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Statusy do leadów' AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `lead_statuses`
--

INSERT INTO `lead_statuses` (`id`, `name`) VALUES
(1, 'Nowy'),
(2, 'Brief'),
(3, 'Oferta'),
(4, 'W toku'),
(5, 'Negocjacje'),
(6, 'Wygrany'),
(7, 'Przegrany');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
