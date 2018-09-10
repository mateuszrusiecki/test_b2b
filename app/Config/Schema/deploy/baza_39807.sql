CREATE TABLE IF NOT EXISTS `events_defined` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `month` int(10) NOT NULL,
  `day` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `events_defined` (`id`, `name`, `month`, `day`) VALUES
(1, 'Wigilia', 1, 24),
(2, 'Boże Narodzenie', 1, 25);