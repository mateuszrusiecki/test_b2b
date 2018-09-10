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
  `user_id` varchar(128) NOT NULL,
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
  `manager_id` varchar(128) NOT NULL,
  `client_id` varchar(128) NOT NULL,
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
  `user_id` varchar(128) NOT NULL,
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
-- Ograniczenia dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `fk_comments_2` FOREIGN KEY (`user_id`) REFERENCES `user_users` (`id`),
  ADD CONSTRAINT `fk_comments_3` FOREIGN KEY (`version_id`) REFERENCES `versions` (`id`);

--
-- Ograniczenia dla tabeli `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `user_users` (`id`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `user_users` (`id`);

--
-- Ograniczenia dla tabeli `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `fk_regions_2` FOREIGN KEY (`version_id`) REFERENCES `versions` (`id`),
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_users` (`id`);