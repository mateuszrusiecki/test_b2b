ALTER TABLE `user_users` ADD `role` VARCHAR( 255 ) NOT NULL;
UPDATE user_users SET role = 'manager';
RENAME TABLE `projects` TO `projects_tmp`;

-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 02 Cze 2015, 10:00
-- Wersja serwera: 5.5.16
-- Wersja PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `mbienia`
--

DELIMITER $$
--
-- Procedury
--
DROP PROCEDURE IF EXISTS `update_project_status`$$
CREATE DEFINER=`feb`@`%` PROCEDURE `update_project_status`(IN projectId INT UNSIGNED)
BEGIN
    DECLARE viewCount INT;
    DECLARE acceptedViewCount INT;
    DECLARE rejectedViewCount INT;
    DECLARE acceptanceStatus TINYINT;

    SET @viewCount = (SELECT count(*) FROM `views` WHERE `project_id` = projectId);
    SET @acceptedViewCount = (SELECT count(*) FROM `views` WHERE `project_id` = projectId AND `acceptance_status`=1);
    SET @rejectedViewCount = (SELECT count(*) FROM `views` WHERE `project_id` = projectId AND `acceptance_status`=2);
    SET @acceptanceStatus = 0;
    IF @acceptedViewCount >= @viewCount THEN
        SET @acceptanceStatus = 1;
    END IF;
    UPDATE `projects` SET `view_count`=@viewCount, `accepted_view_count`=@acceptedViewCount, `acceptance_status`=@acceptanceStatus WHERE `id`=projectId;
END$$

DROP PROCEDURE IF EXISTS `update_version_status`$$
CREATE DEFINER=`feb`@`%` PROCEDURE `update_version_status`(IN versionId INT UNSIGNED)
BEGIN
    DECLARE commentCount INT;
    SET @commentCount = (SELECT count(*) FROM `comments` WHERE `version_id` = versionId);
    UPDATE `versions` SET `comment_count`=@commentCount WHERE `id`=versionId;
END$$

DROP PROCEDURE IF EXISTS `update_view_status`$$
CREATE DEFINER=`feb`@`%` PROCEDURE `update_view_status`(IN viewId INT UNSIGNED)
BEGIN
    DECLARE acceptedVersionCount INT;
    DECLARE rejectedVersionCount INT;
    DECLARE versionCount INT;
    DECLARE acceptanceStatus TINYINT;
    DECLARE commentCount INT;

    SET @versionCount = (SELECT count(*) FROM `versions` WHERE `view_id` = viewId AND `visible`=1);
    SET @commentCount = (SELECT sum(comment_count) FROM `versions` WHERE `view_id`=viewId AND `visible`=1);
    SET @acceptedVersionCount = (SELECT count(*) FROM `versions` WHERE `view_id`=viewId AND `acceptance_status`=1 AND `visible`=1);
    SET @rejectedVersionCount = (SELECT count(*) FROM `versions` WHERE `view_id`=viewId AND `acceptance_status`=2 AND `visible`=1);
    SET @acceptanceStatus = 0;
    IF @rejectedVersionCount = @versionCount THEN
        SET @acceptanceStatus = 2;
    END IF;
    IF @acceptedVersionCount > 0 THEN
        SET @acceptanceStatus = 1;
    END IF;
    # - wybór miniaturki
    SET @thumbPath = (SELECT thumb_path FROM `versions` WHERE `view_id`=viewId ORDER BY `number` DESC LIMIT 1);
    SET @thumbPathClient = (SELECT thumb_path FROM `versions` WHERE `view_id`=viewId AND `visible` = 1 ORDER BY `number` DESC LIMIT 1);

    UPDATE `views` SET
        `version_count`=@versionCount, `accepted_version_count`=@acceptedVersionCount, `acceptance_status`=@acceptanceStatus,
        `thumb_path`=@thumbPath, `thumb_path_client`=@thumbPathClient, `comment_count`=@commentCount
        WHERE `id`=viewId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `cake_sessions`
--

DROP TABLE IF EXISTS `cake_sessions`;
CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `ordernum` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index3` (`project_id`,`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `project_id`, `title`, `ordernum`, `created`, `modified`) VALUES
(1, 1, 'Strona www', 1, '2014-11-24 10:05:56', '2014-11-24 10:05:56'),
(2, 2, 'Strona główna', 2, '2014-12-03 16:39:14', '2014-12-03 16:39:14'),
(3, 2, 'Mailing', 3, '2014-12-03 16:39:24', '2014-12-03 16:39:24'),
(4, 3, 'Strona główna', 4, '2014-12-03 16:44:13', '2014-12-03 16:44:13'),
(5, 1, 'Kategoria testowa 2', 5, '2014-12-03 18:37:42', '2014-12-03 18:37:42'),
(6, 1, 'Kategoria testowa 3', 6, '2014-12-03 18:37:52', '2014-12-03 18:37:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `region_id` int(10) unsigned DEFAULT NULL,
  `version_id` int(10) unsigned DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_1` (`region_id`),
  KEY `fk_comments_2` (`user_id`),
  KEY `fk_comments_3` (`version_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `region_id`, `version_id`, `content`, `created`, `modified`) VALUES
(1, 9, 2, 3, 'opis', '2014-11-24 10:31:00', '2014-11-24 10:29:49'),
(2, 9, 1, 3, 'opis', '2014-11-24 10:32:00', '2014-11-24 10:31:25'),
(3, 9, 3, 3, 'dadad', '2014-11-24 10:32:00', '2014-11-24 10:31:34'),
(4, 9, 1, 3, 'nie jednak nie juz mi sie odwidziało', '2014-11-24 10:45:00', '2014-11-24 10:44:11'),
(5, 9, NULL, 3, 'test', '2014-11-25 11:51:00', '2014-11-25 11:50:05'),
(6, 9, 15, 3, 'text', '2014-11-26 09:34:00', '2014-11-26 09:32:25'),
(7, 9, 2, 3, 'nieaktualne', '2014-11-26 09:36:00', '2014-11-26 09:34:02'),
(8, 13, 1, 3, 'Test DP', '2014-12-03 19:27:00', '2014-12-03 19:25:25'),
(9, 13, 18, 3, 'Nowy zaznaczony obszar nr 5', '2014-12-03 20:10:00', '2014-12-03 20:07:02'),
(10, 13, 18, 3, 'Nowy komentarz', '2014-12-03 20:13:00', '2014-12-03 20:10:31'),
(11, 13, NULL, 3, 'Taaaaka', '2014-12-03 20:27:00', '2014-12-03 20:24:07'),
(12, 13, NULL, 2, '111', '2014-12-03 21:06:00', '2014-12-03 21:04:00'),
(13, 13, NULL, 2, '2222', '2014-12-03 21:06:00', '2014-12-03 21:04:08'),
(14, 13, 19, 4, 'Raz dwa trzy próba komentarza...', '2014-12-03 21:59:00', '2014-12-03 21:56:20'),
(15, 13, NULL, 4, 'Nowy bez obszaru', '2014-12-03 22:05:00', '2014-12-03 22:02:14'),
(16, 6, 20, 1, 'lkzjxcklxzjcklxzjclzjkxcklxzc', '2014-12-30 14:32:00', '2014-12-30 14:32:19');

--
-- Wyzwalacze `comments`
--
DROP TRIGGER IF EXISTS `comments_AINS`;
DELIMITER //
CREATE TRIGGER `comments_AINS` AFTER INSERT ON `comments`
 FOR EACH ROW BEGIN
    CALL update_version_status(NEW.version_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `comments_AUPD`;
DELIMITER //
CREATE TRIGGER `comments_AUPD` AFTER UPDATE ON `comments`
 FOR EACH ROW BEGIN
    CALL update_version_status(NEW.version_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `comments_ADEL`;
DELIMITER //
CREATE TRIGGER `comments_ADEL` AFTER DELETE ON `comments`
 FOR EACH ROW BEGIN
    CALL update_version_status(OLD.version_id);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `archived` tinyint(4) NOT NULL DEFAULT '0',
  `acceptance_status` tinyint(4) NOT NULL DEFAULT '0',
  `accepted_view_count` int(11) DEFAULT '0',
  `view_count` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projects_1` (`manager_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `projects`
--

INSERT INTO `projects` (`id`, `manager_id`, `client_id`, `title`, `archived`, `acceptance_status`, `accepted_view_count`, `view_count`, `created`, `modified`) VALUES
(1, 6, 10, 'Budvar-www', 0, 0, 0, 10, '2014-11-24 10:05:34', '2014-11-24 10:05:34'),
(2, 13, 12, 'Metalexport www', 0, 0, 0, 0, '2014-12-03 16:38:59', '2014-12-03 16:38:59'),
(3, 13, 12, 'Metalexport', 0, 0, 0, 1, '2014-12-03 16:44:00', '2014-12-03 16:44:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `version_id` int(10) unsigned NOT NULL,
  `number` int(11) DEFAULT NULL,
  `top` int(11) DEFAULT NULL,
  `left` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_regions_2` (`version_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Zrzut danych tabeli `regions`
--

INSERT INTO `regions` (`id`, `user_id`, `version_id`, `number`, `top`, `left`, `width`, `height`, `created`, `modified`) VALUES
(1, 9, 3, 1, 188, 710, 759, 532, '2014-11-24 10:29:31', '2014-11-24 10:29:31'),
(2, 9, 3, 2, 342, 1033, 132, 111, '2014-11-24 10:29:45', '2014-11-24 10:29:45'),
(3, 9, 3, 3, 603, 1376, 222, 217, '2014-11-24 10:31:31', '2014-11-24 10:31:31'),
(7, 6, 4, 1, 185, 886, 352, 276, '2014-11-24 13:47:19', '2014-11-24 13:47:19'),
(8, 6, 4, 2, 334, 618, 205, 193, '2014-11-24 13:47:27', '2014-11-24 13:47:27'),
(9, 6, 4, 3, 427, 613, 392, 154, '2014-11-24 13:47:42', '2014-11-24 13:47:42'),
(10, 9, 4, 4, 822, 1301, 386, 529, '2014-11-25 08:48:45', '2014-11-25 08:48:45'),
(15, 9, 3, 4, 459, 963, 0, 0, '2014-11-26 09:32:21', '2014-11-26 09:32:21'),
(18, 13, 3, 5, 356, 635, 449, 375, '2014-12-03 20:06:14', '2014-12-03 20:06:14'),
(19, 13, 4, 5, 495, 578, 30, 33, '2014-12-03 21:53:43', '2014-12-03 21:53:43'),
(20, 6, 1, 1, 183, 1037, 314, 241, '2014-12-30 14:32:15', '2014-12-30 14:32:15'),
(21, 6, 3, 6, 61, 627, 256, 196, '2015-05-28 08:29:22', '2015-05-28 08:29:22'),
(22, 6, 2, 1, 71, 896, 158, 126, '2015-05-28 11:44:12', '2015-05-28 11:44:12'),
(23, 6, 3, 7, 575, 489, 403, 282, '2015-05-29 13:15:13', '2015-05-29 13:15:13'),
(24, 6, 3, 8, 179, 485, 130, 72, '2015-05-29 13:17:59', '2015-05-29 13:17:59'),
(25, 6, 3, 9, 42, 687, 268, 81, '2015-06-01 14:04:51', '2015-06-01 14:04:51'),
(26, 6, 3, 10, 127, 857, 235, 166, '2015-06-01 14:47:34', '2015-06-01 14:47:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `clearpassword` varchar(128) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `phone` varchar(36) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `role` varchar(64) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `clearpassword`, `name`, `phone`, `email`, `role`, `created`, `modified`, `status`) VALUES
(6, 'a.dziki@feb.net.pl', '$2a$10$N62z6yaKvVscOwg6KX3wq.3cxem8CjSSGbRgSu7VT6GsgVUjYH9LC', NULL, 'Arek Dziki', '792 42 69 11 ', 'a.dziki@feb.net.pl', 'manager', '2014-09-22 20:27:33', '2014-09-22 20:27:33', 1),
(9, 'l.wozniak@feb.net.pl', '$2a$10$jfvXibg1oHuFW3yEiO6NIum/8FTxO4BiCHvzGfJgiJ93v.QxeiY1O', NULL, 'Łukasz Woźniak', NULL, 'l.wozniak@feb.net.pl', 'manager', '2014-11-24 10:03:45', '2014-11-24 10:03:45', 1),
(10, 'm.mencel@budvar.pl', '$2a$10$NQdy65syRVhh.eweh.k6yOxWTptJIuUzGhMcOatosmApdDVZrp7fS', 'budvar-www', 'Budvar', '+48 665 996 057', 'm.mencel@budvar.pl', 'client', '2014-11-24 10:05:31', '2014-11-24 10:05:31', 1),
(11, 'lukaszwozniak2304@gmail.com', '$2a$10$W8wf4XLn8JoAqH04aEK9T.c3D70qZDbMY999RHPr9lDfiT5uU6rXS', NULL, 'Budvar', 'l.wozniak@feb.net.pl', 'lukaszwozniak2304@gmail.com', 'manager', '2014-11-24 10:06:12', '2014-11-24 10:06:12', 1),
(12, 'pwrzesien@metalexport-s.com', '$2a$10$PvydKnCRn9G99al.3g9U8.EZ9NJCLb9WoHXRHSKRS8Beq0nsd2OZ6', 'qwerty', 'Piotr Wrzesień, Metalexport', '666777888', 'pwrzesien@metalexport-s.com', 'client', '2014-12-03 16:38:32', '2014-12-03 16:38:32', 1),
(13, 'd.pelka@feb.net.pl', '$2a$10$ovDxrkrqy1qJZjRJ5n2iZO01A/t1p2CUD/DzAszGOOjOzpzgyuZLC', NULL, 'Dariusz Pełka', NULL, 'd.pelka@feb.net.pl', 'manager', '2014-12-03 16:38:56', '2014-12-03 16:38:56', 1),
(14, 'm.bienia@febdev.pl', '$2a$10$Y37qF7Lxt3yJ4.GcqRt9He2WpLt/3Xn54QYDq3yyXy927wKqoz4lO', NULL, 'Maciej Bienia', '661941686', 'm.bienia@febdev.pl', 'manager', NULL, NULL, 1),
(16, 'm.bienia@febdev.pl', '!', '', 'Maciej Bienia', '661941686', 'm.bienia@febdev.pl', 'manager', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `versions`
--

DROP TABLE IF EXISTS `versions`;
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
(1, 1, 1, 1416575996, 2, 1, 1, 'Budvar/Budvar-www/Strona_www/Strona_glowna/a6.jpg', 'thumbs/1.jpg', '2014-11-24 10:23:18', '2014-11-24 10:23:19'),
(2, 1, 2, 1416577428, 2, 2, 0, 'Budvar/Budvar-www/Strona_www/Strona_glowna/a7.jpg', 'thumbs/2.jpg', '2014-11-24 10:23:19', '2014-11-24 10:23:19'),
(3, 1, 3, 1416577432, 1, 11, 0, 'Budvar/Budvar-www/Strona_www/Strona_glowna/a8.jpg', 'thumbs/3.jpg', '2014-11-24 10:23:19', '2014-11-24 10:23:19'),
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `acceptance_status` tinyint(4) NOT NULL DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `version_count` int(11) DEFAULT '0',
  `accepted_version_count` int(11) DEFAULT '0',
  `comment_count` int(11) DEFAULT '0',
  `image_path` varchar(1024) DEFAULT NULL,
  `thumb_path` varchar(1024) DEFAULT NULL,
  `thumb_path_client` varchar(1024) DEFAULT NULL,
  `ordernum` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index3` (`category_id`,`name`),
  KEY `fk_views_2` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `views`
--

INSERT INTO `views` (`id`, `project_id`, `category_id`, `name`, `acceptance_status`, `visible`, `version_count`, `accepted_version_count`, `comment_count`, `image_path`, `thumb_path`, `thumb_path_client`, `ordernum`, `created`, `modified`) VALUES
(1, 1, 1, 'Strona główna', 2, 1, 1, 0, 1, '', 'thumbs/3.jpg', 'thumbs/1.jpg', 1, '2014-11-24 10:06:05', '2014-11-24 10:06:05'),
(2, 1, 1, 'Strona produktowa', 2, 1, 0, 0, NULL, NULL, 'thumbs/4.jpg', NULL, 2, '2014-11-24 10:06:15', '2014-11-24 10:06:15'),
(3, 1, 1, 'Strona kontakt', 0, 1, 0, 0, 0, NULL, NULL, NULL, 3, '2014-11-24 10:06:41', '2014-11-24 10:06:41'),
(4, 1, 1, 'Strona tekstowa (edytowalna)', 0, 1, 0, 0, 0, NULL, NULL, NULL, 4, '2014-11-24 10:07:03', '2014-11-24 10:07:03'),
(5, 3, 4, 'g01', 0, 1, 0, 0, 0, NULL, NULL, NULL, 5, '2014-12-03 16:44:30', '2014-12-03 16:44:30'),
(6, 1, 5, 'Widok 2.1', 0, 1, 0, 0, 0, NULL, NULL, NULL, 6, '2014-12-03 18:38:09', '2014-12-03 18:38:09'),
(7, 1, 5, 'Widok 2.2', 0, 1, 0, 0, 0, NULL, NULL, NULL, 7, '2014-12-03 18:38:19', '2014-12-03 18:38:19'),
(8, 1, 5, 'Widok 2.3', 0, 1, 0, 0, 0, '', '', '', 8, '2014-12-03 18:38:29', '2014-12-03 18:38:29'),
(9, 1, 6, 'Widok 3.1', 0, 1, 0, 0, 0, NULL, NULL, NULL, 9, '2014-12-03 18:38:39', '2014-12-03 18:38:39'),
(10, 1, 6, 'Widok 3.2', 0, 1, 0, 0, 0, NULL, NULL, NULL, 10, '2014-12-03 18:38:45', '2014-12-03 18:38:45'),
(11, 1, 6, 'Widok 3.3', 0, 1, 0, 0, 0, NULL, NULL, NULL, 11, '2014-12-03 18:38:51', '2014-12-03 18:38:51');

--
-- Wyzwalacze `views`
--
DROP TRIGGER IF EXISTS `views_AINS`;
DELIMITER //
CREATE TRIGGER `views_AINS` AFTER INSERT ON `views`
 FOR EACH ROW BEGIN
    CALL update_project_status(NEW.project_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `views_AUPD`;
DELIMITER //
CREATE TRIGGER `views_AUPD` AFTER UPDATE ON `views`
 FOR EACH ROW BEGIN
    CALL update_project_status(NEW.project_id);
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `views_ADEL`;
DELIMITER //
CREATE TRIGGER `views_ADEL` AFTER DELETE ON `views`
 FOR EACH ROW BEGIN
    CALL update_project_status(OLD.project_id);
END
//
DELIMITER ;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `fk_comments_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_comments_3` FOREIGN KEY (`version_id`) REFERENCES `versions` (`id`);

--
-- Ograniczenia dla tabeli `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `fk_regions_2` FOREIGN KEY (`version_id`) REFERENCES `versions` (`id`),
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `versions`
--
ALTER TABLE `versions`
  ADD CONSTRAINT `fk_versions_1` FOREIGN KEY (`view_id`) REFERENCES `views` (`id`);

--
-- Ograniczenia dla tabeli `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `fk_views_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_views_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
