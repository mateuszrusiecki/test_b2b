CREATE TABLE IF NOT EXISTS `client_domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `domain` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `client_project_domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `client_domain_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `clinet_domain_id` (`client_domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `client_projects` DROP `seo_domain`;

CREATE TABLE IF NOT EXISTS `hr_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `margin` int(11) DEFAULT NULL,
  `buffer` int(11) DEFAULT NULL,
  `it_rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `project_files` ADD `file_name` VARCHAR(255) NOT NULL AFTER `file`;