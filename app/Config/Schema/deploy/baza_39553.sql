--
-- Struktura tabeli dla  `message_types`
--

CREATE TABLE IF NOT EXISTS `message_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `message_types`
--

INSERT INTO `message_types` (`id`, `name`) VALUES
(1, 'info'),
(2, 'alert'),
(3, 'danger');

--
-- Struktura tabeli dla  `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `message_type_id` int(10) NOT NULL,
  `body` varchar(255) CHARACTER SET utf8 NOT NULL,
  `received` datetime NOT NULL,
  `readed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;