ALTER TABLE `client_projects` ADD `modules_database` TINYINT NOT NULL DEFAULT '0' COMMENT 'baza modu��w' AFTER `project_database` ;

ALTER TABLE `payments` CHANGE `price` `price` FLOAT(10,2) NULL DEFAULT NULL COMMENT 'warto��';

ALTER TABLE  `client_projects` CHANGE  `project_database`  `project_database` TINYINT( 1 ) NULL DEFAULT  '0' COMMENT  'project dodany do bazy projekt�w'