-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 12 Sie 2015, 11:30
-- Server version: 5.6.16
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `febdev_b2b-test`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`febdev_b2b-test`@`localhost` PROCEDURE `update_project_status`(IN projectId INT UNSIGNED)
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

CREATE DEFINER=`febdev_b2b-test`@`localhost` PROCEDURE `update_version_status`(IN versionId INT UNSIGNED)
BEGIN
    DECLARE commentCount INT;
    SET @commentCount = (SELECT count(*) FROM `comments` WHERE `version_id` = versionId);
    UPDATE `versions` SET `comment_count`=@commentCount WHERE `id`=versionId;
END$$

CREATE DEFINER=`febdev_b2b-test`@`localhost` PROCEDURE `update_view_status`(IN viewId INT UNSIGNED)
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
-- Struktura tabeli dla tabeli `project_mockups`
--

CREATE TABLE IF NOT EXISTS `project_mockups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version` int(10) unsigned NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `client_project_id` int(10) unsigned NOT NULL,
  `project_file_id` int(10) unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Path to index.html',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project_mockup_comments`
--

CREATE TABLE IF NOT EXISTS `project_mockup_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `project_mockup_id` int(10) unsigned NOT NULL,
  `project_mockup_node_id` int(11) unsigned NOT NULL,
  `user_id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `position` text COLLATE utf8_unicode_ci COMMENT 'JSON comment position',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project_mockup_nodes`
--

CREATE TABLE IF NOT EXISTS `project_mockup_nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_mockup_id` int(10) unsigned NOT NULL,
  `pageName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=191 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
