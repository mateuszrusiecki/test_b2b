
CREATE TABLE IF NOT EXISTS `user_contract_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `state` varchar(255) NOT NULL COMMENT 'Etat',
  `position` varchar(255) DEFAULT NULL COMMENT 'Stanowisko',
  `salary` blob NOT NULL COMMENT 'Wynagrodzenie',
  `salary_net` blob COMMENT 'wynagrodzenie netto',
  `employment_start` date NOT NULL COMMENT 'czas trwania umowy od',
  `employment_end` date NOT NULL COMMENT 'czas trwania umowy do',
  `vacation_days` smallint(6) DEFAULT NULL COMMENT 'dni urlopu rocznie',
  `vacation_available` smallint(6) DEFAULT NULL,
  `period_of_employment` varchar(255) DEFAULT NULL COMMENT 'Okres zatrudnienia',
  `right_to_pension` tinyint(1) DEFAULT NULL COMMENT 'Prawo do renty / emerytury',
  `unemployed` tinyint(1) DEFAULT NULL COMMENT 'Bezrobotny / student',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Historia umów użytkowników';