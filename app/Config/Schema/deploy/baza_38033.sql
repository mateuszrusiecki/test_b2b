CREATE TABLE IF NOT EXISTS `project_contact_peoples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `project_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `file_category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;




CREATE TABLE IF NOT EXISTS `client_project_budgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_id` int(11) NOT NULL,
  `project_costs` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `buffer` int(11) NOT NULL,
  `margin` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;




CREATE TABLE IF NOT EXISTS `budget_agreements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_budget_id` int(11) NOT NULL,
  `deparment_id` int(11) NOT NULL COMMENT 'id działu',
  `department_boss` varchar(255) COLLATE utf8_polish_ci NOT NULL COMMENT 'imię, nazwisko szefa działu',
  `activity_name` varchar(255) COLLATE utf8_polish_ci NOT NULL COMMENT 'nazwa działania',
  `PM_link` int(11) DEFAULT NULL COMMENT 'link do PM',
  `buffer_percentage` int(11) NOT NULL COMMENT '% buforu',
  `buffer_value` int(11) NOT NULL COMMENT 'wartość buforu',
  `margin_percentage` int(11) NOT NULL COMMENT '% marży',
  `margin_valy` int(11) NOT NULL COMMENT 'wartość marży',
  `position_cost` decimal(10,0) NOT NULL COMMENT 'koszt pozycji budżetowej',
  `position_value` decimal(10,0) NOT NULL COMMENT 'wartość pozycji budżetowej',
  `agreement_start` datetime NOT NULL,
  `agreement_end` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;





CREATE TABLE IF NOT EXISTS `agreement_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_agreement_id` int(11) NOT NULL,
  `position_name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `position_quantity` int(11) NOT NULL,
  `position_cost` decimal(10,0) NOT NULL,
  `total_cost` decimal(10,0) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) NOT NULL,
  `payment_name` varchar(255) COLLATE utf8_polish_ci NOT NULL COMMENT 'nazwa platnosci',
  `date_start` date NOT NULL COMMENT 'data platnosci',
  `date_end` date DEFAULT NULL COMMENT 'data do - gdy cykliczna',
  `type` tinyint(4) NOT NULL COMMENT 'czy cykliczna',
  `value` decimal(10,0) NOT NULL COMMENT 'wartość',
  `currency` int(11) NOT NULL COMMENT 'waluta',
  `interval` int(11) DEFAULT NULL COMMENT 'okres',
  `payment_day` int(11) DEFAULT NULL COMMENT 'dzien platnosci, przy cyklicznym',
  `payment_done` tinyint(4) NOT NULL COMMENT 'czy platnosc zrealizowana',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `client_project_shedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `project_shedule_agreement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_project_shedule_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `shedule_agreement_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_shedule_agreement_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT 'typ- czy etap, czy kamien milowy',
  `status` tinyint(4) NOT NULL COMMENT 'zakonczony, nie ',
  `cyclic` tinyint(4) NOT NULL COMMENT 'wydarzenie cykliczne',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;



ALTER TABLE  `vacations` ADD  `time_start` TIME NULL 
ALTER TABLE  `vacations` ADD  `time_end` TIME NULL 
ALTER TABLE  `vacations` ADD  `private_time` TIME NULL