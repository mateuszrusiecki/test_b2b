CREATE TABLE IF NOT EXISTS `base_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `foundations` varchar(255) NOT NULL,
  `project_id` int(10) NOT NULL,
  `repository_type` varchar(255) NOT NULL,
  `repository_path` varchar(255) NOT NULL,
  `coordinator_contact` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `base_modules` CHANGE `project_id` `client_project_id` INT( 10 ) NOT NULL;
ALTER TABLE `base_modules` CHANGE `client_project_id` `client_project_id` CHAR( 36 ) NOT NULL;

ALTER TABLE `base_modules` ADD `category` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ADD `name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ADD `specification` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ADD `pictures` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ADD `languages` TINYINT( 1 ) NOT NULL ,
ADD `programmer_contact` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ADD `comments` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

ALTER TABLE `base_modules` CHANGE `foundations` `foundations` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; 
ALTER TABLE `base_modules` CHANGE `comments` `comments` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `base_modules` CHANGE `specification` `specification` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL; 