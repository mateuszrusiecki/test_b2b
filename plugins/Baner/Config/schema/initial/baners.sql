CREATE TABLE IF NOT EXISTS `feb_baners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `clicks_counter` int(10) NOT NULL DEFAULT '0',
  `shows_counter` int(11) NOT NULL DEFAULT '0',
  `html_code` text,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `clicks_limit` int(10) DEFAULT NULL,
  `date_limit` datetime DEFAULT NULL,
  `shows_limit` int(11) DEFAULT NULL,
  `group` varchar(60) NOT NULL,
  `publish_date` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `feb_baner_clicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `baner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `baner_id` (`baner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `feb_baner_shows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `baner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `baner_id` (`baner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
