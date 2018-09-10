CREATE TABLE IF NOT EXISTS `user_work_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` smallint(6) NOT NULL,
  `user_contract_history_id` int(11) DEFAULT NULL,
  `hours_worked` smallint(6) DEFAULT NULL,
  `overtime` smallint(6) DEFAULT NULL,
  `total_overtime` smallint(6) DEFAULT NULL,
  `vacations` smallint(6) DEFAULT NULL,
  `sick_leave` smallint(6) DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;