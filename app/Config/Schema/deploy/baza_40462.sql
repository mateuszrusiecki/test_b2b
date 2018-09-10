
CREATE TABLE IF NOT EXISTS `project_file_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `user_accessible` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `project_files` ADD  `project_file_category_id` INT NOT NULL AFTER  `client_project_id`;
ALTER TABLE  `project_file_categories` ADD  `slug` VARCHAR( 128 ) NULL AFTER  `name`;