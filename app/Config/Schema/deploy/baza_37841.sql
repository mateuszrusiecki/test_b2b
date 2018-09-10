
CREATE TABLE IF NOT EXISTS `client_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `client_lead_id` int(11) DEFAULT NULL,
  `user_id` char(36) COLLATE utf8_polish_ci DEFAULT NULL COMMENT 'kierownik projektu',
  `seo_domain` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `start_project` date DEFAULT NULL,
  `end_project` date DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

ALTER TABLE  `client_leads` ADD  `closing_date` DATETIME NULL ,
ADD  `modified` DATETIME NOT NULL ,
ADD  `created` DATETIME NOT NULL,
ADD  `comment` TEXT NULL AFTER  `user_id`;