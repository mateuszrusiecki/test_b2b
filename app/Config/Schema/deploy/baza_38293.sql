CREATE TABLE IF NOT EXISTS `client_project_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` char(36) COLLATE utf8_general_ci NOT NULL,
  `user_name` varchar(128) COLLATE utf8_general_ci NOT NULL,
  `content` text COLLATE utf8_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Notatki do projektu';

CREATE TABLE IF NOT EXISTS  `client_project_logs` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
 `client_project_id` INT( 11 ) NOT NULL ,
 `type_log_id` INT( 11 ) NOT NULL ,
 `name` VARCHAR( 255 ) CHARACTER SET utf8 DEFAULT NULL ,
 `subject` VARCHAR( 255 ) CHARACTER SET utf8 DEFAULT NULL ,
 `message` TEXT CHARACTER SET utf8,
 `from` VARCHAR( 255 ) CHARACTER SET utf8 DEFAULT NULL ,
 `user_id` CHAR( 36 ) CHARACTER SET utf8 NOT NULL ,
 `email_date` DATETIME DEFAULT NULL ,
 `created` DATETIME NOT NULL ,
 `modified` DATETIME NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci;