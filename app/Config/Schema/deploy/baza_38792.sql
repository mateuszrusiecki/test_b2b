ALTER TABLE  `modules` CHANGE  ` comments`  `comments` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `modules` CHANGE  `rep_type`  `rep_type` CHAR( 100 ) NULL DEFAULT NULL COMMENT  'typ repozytorium';

CREATE TABLE IF NOT EXISTS `module_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `data` mediumblob,
  `type` varchar(10) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;