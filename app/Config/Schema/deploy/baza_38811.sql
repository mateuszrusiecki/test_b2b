ALTER TABLE  `user_sections` CHANGE  `created`  `created` DATETIME NULL;

ALTER TABLE  `user_sections` CHANGE  `modified`  `modified` DATETIME NULL;

--
-- Struktura tabeli dla tabeli `client_project_users`
--

CREATE TABLE IF NOT EXISTS `client_project_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL,
  `client_project_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `client_project_users`
--
