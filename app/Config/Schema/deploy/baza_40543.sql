CREATE TABLE IF NOT EXISTS `views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `graphic_project_id` int(10) NOT NULL,
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

INSERT INTO `views` (`id`, `graphic_project_id`, `project_id`, `category_id`, `name`, `acceptance_status`, `visible`, `version_count`, `accepted_version_count`, `comment_count`, `image_path`, `thumb_path`, `thumb_path_client`, `ordernum`, `created`, `modified`) VALUES
(1, 0, 1, 1, 'Strona główna', 1, 1, 2, 2, 18, '', 'thumbs/3.jpg', 'thumbs/3.jpg', 1, '2014-11-24 10:06:05', '2014-11-24 10:06:05'),
(2, 0, 1, 1, 'Strona produktowa', 2, 1, 0, 0, NULL, NULL, 'thumbs/4.jpg', NULL, 2, '2014-11-24 10:06:15', '2014-11-24 10:06:15'),
(3, 0, 1, 1, 'Strona kontakt', 0, 1, 0, 0, 0, NULL, NULL, NULL, 3, '2014-11-24 10:06:41', '2014-11-24 10:06:41'),
(4, 0, 1, 1, 'Strona tekstowa (edytowalna)', 0, 1, 0, 0, 0, NULL, NULL, NULL, 4, '2014-11-24 10:07:03', '2014-11-24 10:07:03'),
(5, 0, 3, 4, 'g01', 0, 1, 0, 0, 0, NULL, NULL, NULL, 5, '2014-12-03 16:44:30', '2014-12-03 16:44:30'),
(6, 0, 1, 5, 'Widok 2.1', 0, 1, 0, 0, 0, NULL, NULL, NULL, 6, '2014-12-03 18:38:09', '2014-12-03 18:38:09'),
(7, 0, 1, 5, 'Widok 2.2', 0, 1, 0, 0, 0, NULL, NULL, NULL, 7, '2014-12-03 18:38:19', '2014-12-03 18:38:19'),
(8, 0, 1, 5, 'Widok 2.3', 0, 1, 0, 0, 0, '', '', '', 8, '2014-12-03 18:38:29', '2014-12-03 18:38:29'),
(9, 0, 1, 6, 'Widok 3.1', 0, 1, 0, 0, 0, NULL, NULL, NULL, 9, '2014-12-03 18:38:39', '2014-12-03 18:38:39'),
(10, 0, 1, 6, 'Widok 3.2', 0, 1, 0, 0, 0, NULL, NULL, NULL, 10, '2014-12-03 18:38:45', '2014-12-03 18:38:45'),
(11, 0, 1, 6, 'Widok 3.3', 0, 1, 0, 0, 0, NULL, NULL, NULL, 11, '2014-12-03 18:38:51', '2014-12-03 18:38:51');

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