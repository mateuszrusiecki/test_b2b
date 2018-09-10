CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(10) NOT NULL,
  `event_type_id` int(10) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `event_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `event_types` (`id`, `name`) VALUES
(1, 'Badanie'),
(2, 'Dzień wolny'),
(3, 'Szkolenie');
