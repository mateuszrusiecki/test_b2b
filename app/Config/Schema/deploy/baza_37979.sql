CREATE TABLE IF NOT EXISTS `work_holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `month` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'nazwa œwiêta(opcjonalne)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='dni wolne od pracy w danym roku';

CREATE TABLE IF NOT EXISTS `work_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `work_hours` int(11) NOT NULL,
  `work_days` int(11) DEFAULT NULL,
  `days_off` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='zestawienie wymiaru czasu pracy w poszczególnych miesi¹cach';