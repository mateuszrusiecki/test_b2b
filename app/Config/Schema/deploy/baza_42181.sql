--
-- Struktura tabeli dla tabeli `i18n_messages`
--

CREATE TABLE IF NOT EXISTS `i18n_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgctxt` varchar(255) DEFAULT NULL,
  `msgid` text,
  `msgstr` text,
  `user_id` char(36) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `lang` char(3) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

