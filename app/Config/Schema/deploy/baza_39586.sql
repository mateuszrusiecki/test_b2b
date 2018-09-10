--
-- Struktura tabeli dla  `calendars`
--

CREATE TABLE IF NOT EXISTS `calendars` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `year` int(10) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;