ALTER TABLE  `profiles` ADD  `salary_net` VARCHAR( 255 ) NULL COMMENT  'wynagrodzenie netto' AFTER  `salary` ,
ADD  `employment_start` DATE NULL COMMENT  'czas trwania umowy od' AFTER  `salary_net` ,
ADD  `employment_end` DATE NULL COMMENT  'czas trwania umowy do' AFTER  `employment_start` ,
ADD  `vacation_days` SMALLINT NULL COMMENT  'dni urlopu rocznie' AFTER  `employment_end`;




CREATE TABLE IF NOT EXISTS `vacations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vacation_type_id` int(11) NOT NULL COMMENT 'rodzaj urlopu',
  `date_start` date DEFAULT NULL COMMENT 'dzieñ od',
  `date_end` date DEFAULT NULL COMMENT 'dzieñ do',
  `hour_start` date DEFAULT NULL COMMENT 'godzina od',
  `hour_end` date DEFAULT NULL COMMENT 'godzina do',
  `vacation_status_id` int(11) NOT NULL COMMENT 'status urlopu',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `vacation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `is_hours` tinyint(1) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `vacation_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;





CREATE TABLE IF NOT EXISTS `vacation_replaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vacation_id` int(11) NOT NULL,
  `user_id` char(36) COLLATE utf8_polish_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `no_project` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'bez projektu',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;



ALTER TABLE  `vacations` ADD  `user_id` CHAR( 36 ) NOT NULL AFTER  `id`;
