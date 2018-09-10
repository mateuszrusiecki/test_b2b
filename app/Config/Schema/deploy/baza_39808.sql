DROP TABLE events_defined;

CREATE TABLE IF NOT EXISTS `events_defined` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `month` int(10) NOT NULL,
  `day` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10;

INSERT INTO `events_defined` (`id`, `name`, `month`, `day`) VALUES
(1, 'Nowy Rok', 1, 1),
(2, 'Święto Trzech Króli', 1, 6),
(3, 'Święto Państwowe', 5, 1),
(4, 'Święto Narodowe Trzeciego Maja', 5, 3),
(5, 'Wniebowzięcie Najświętszej Maryi Panny', 8, 15),
(6, 'Wszystkich Świętych', 11, 1),
(7, 'Narodowe Święto Niepodległości', 11, 11),
(8, 'pierwszy dzień Bożego Narodzenia', 12, 25),
(9, 'drugi dzień Bożego Narodzenia', 12, 26);