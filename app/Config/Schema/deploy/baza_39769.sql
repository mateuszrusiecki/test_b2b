CREATE TABLE IF NOT EXISTS `code_errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  `message` text,
  `url` varchar(255) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE  `suggestions` ADD  `href` VARCHAR( 255 ) NULL AFTER  `user_id`;
