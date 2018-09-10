-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 03 Cze 2015, 14:58
-- Wersja serwera: 5.5.16
-- Wersja PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `b2b`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `versions`
--

CREATE TABLE IF NOT EXISTS `versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `view_id` int(10) unsigned NOT NULL,
  `number` int(11) NOT NULL DEFAULT '1',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  `acceptance_status` tinyint(4) NOT NULL DEFAULT '0',
  `comment_count` int(10) unsigned DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `image_path` varchar(1024) DEFAULT NULL,
  `thumb_path` varchar(1024) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_versions_1` (`view_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `versions`
--

INSERT INTO `versions` (`id`, `view_id`, `number`, `mtime`, `acceptance_status`, `comment_count`, `visible`, `image_path`, `thumb_path`, `created`, `modified`) VALUES
(1, 1, 1, 1416575996, 1, 1, 1, 'Budvar/Budvar-www/Strona_www/Strona_glowna/a6.jpg', 'thumbs/1.jpg', '2014-11-24 10:23:18', '2014-11-24 10:23:19'),
(2, 1, 2, 1416577428, 2, 3, 0, 'Budvar/Budvar-www/Strona_www/Strona_glowna/a7.jpg', 'thumbs/2.jpg', '2014-11-24 10:23:19', '2014-11-24 10:23:19'),
(3, 1, 3, 1416577432, 1, 17, 1, 'Budvar/Budvar-www/Strona_www/Strona_glowna/a8.jpg', 'thumbs/3.jpg', '2014-11-24 10:23:19', '2014-11-24 10:23:19'),
(4, 2, 1, 1416560056, 0, 2, 0, 'Budvar/Budvar-www/Strona_www/Strona_produktowa/a3.jpg', 'thumbs/4.jpg', '2014-11-24 10:29:25', '2014-11-24 10:29:25');

--
-- Wyzwalacze `versions`
--
DROP TRIGGER IF EXISTS `versions_AINS`;
DELIMITER //
CREATE TRIGGER `versions_AINS` AFTER INSERT ON `versions`
 FOR EACH ROW BEGIN
    CALL update_view_status(NEW.view_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `versions_AUPD`;
DELIMITER //
CREATE TRIGGER `versions_AUPD` AFTER UPDATE ON `versions`
 FOR EACH ROW BEGIN
    CALL update_view_status(NEW.view_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `versions_ADEL`;
DELIMITER //
CREATE TRIGGER `versions_ADEL` AFTER DELETE ON `versions`
 FOR EACH ROW BEGIN
    CALL update_view_status(OLD.view_id);
END
//
DELIMITER ;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `versions`
--
ALTER TABLE `versions`
  ADD CONSTRAINT `fk_versions_1` FOREIGN KEY (`view_id`) REFERENCES `views` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

