CREATE TABLE IF NOT EXISTS `acceptance_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` varchar(255) DEFAULT NULL,
  `client_project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_project_shedule_id` int(11) NOT NULL,
  `task_list` text NOT NULL,
  `opinion` text,
  `acceptance` tinyint(4) NOT NULL DEFAULT '0',
  `date_end` date DEFAULT NULL COMMENT 'data zakoñczenia kamienia milowego',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE  `acceptance_reports` ADD  `accept_date` DATE NULL COMMENT  'data zaakceptowania protoko³u' AFTER  `date_end`;
ALTER TABLE  `acceptance_reports` CHANGE  `task_list`  `task_list` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;