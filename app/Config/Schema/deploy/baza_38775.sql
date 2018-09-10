
ALTER TABLE  `project_files` ADD  `user_id` VARCHAR( 36 ) NOT NULL AFTER  `client_project_id`;
ALTER TABLE  `client_projects` ADD  `close_realization` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - projekt otwarty, 1 - projekt zamkniêty' AFTER  `active`;
ALTER TABLE  `client_projects` ADD `close_financing` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - projekt otwarty, 1 - p³atnoœc za projekt zakoñczona, 2 - projekt zamkniety bez p³atnoœci' AFTER  `close_realization`;
ALTER TABLE  `client_projects` ADD `acceptance_report` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'protokó³ odbioru' AFTER  `close_financing`;
ALTER TABLE  `client_projects` ADD  `project_database` TINYINT( 1 ) NULL AFTER  `acceptance_report`;

ALTER TABLE  `client_projects` ADD `agreement` tinyint(1) NOT NULL DEFAULT '0';

ALTER TABLE  `hr_settings` ADD `hostname` varchar(255) DEFAULT NULL;
ALTER TABLE  `hr_settings` ADD `username` varchar(128) DEFAULT NULL;
ALTER TABLE  `hr_settings` ADD `password` varchar(128) DEFAULT NULL;
 
ALTER TABLE `client_projects` CHANGE `budget` `budget` DECIMAL(10,2) NULL DEFAULT NULL;
ALTER TABLE  `client_projects` ADD  `total_development_costs` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'suma kosztów projektowych';
ALTER TABLE  `client_projects` ADD  `total_buffer` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'suma buforów w projekcie';
ALTER TABLE  `client_projects` ADD  `total_costs_sum` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'aktualna suma wydatków poniesionych w projekcie' AFTER  `total_buffer`;

ALTER TABLE  `client_project_logs` CHANGE  `message`  `message` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
ALTER TABLE  `lead_logs` CHANGE  `message`  `message` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL

--
-- Struktura tabeli dla tabeli `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_id` int(11) DEFAULT NULL,
  `module_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` text,
  `img` varchar(255) DEFAULT NULL,
  `lang` tinyint(1) DEFAULT '0' COMMENT 'Czy jest wielo jezykowe',
  `manager_user_id` char(36) DEFAULT NULL COMMENT 'Kierownik porjektu',
  `contact_user_id` char(36) DEFAULT NULL COMMENT 'Programista kontakowy',
  ` comments` text,
  `rep_type` int(11) DEFAULT NULL COMMENT 'typ repozytorium',
  `rep_path` varchar(255) DEFAULT NULL COMMENT 'scie¿ka do repozytorium',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `module_categories`
--

CREATE TABLE IF NOT EXISTS `module_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;