
CREATE TABLE IF NOT EXISTS `suggestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `type` varchar(50) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;