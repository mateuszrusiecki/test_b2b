
--
-- Struktura tabeli dla tabeli `briefs`
--

CREATE TABLE IF NOT EXISTS `briefs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Tytu³ briefa',
  `comment` text COMMENT 'SK¥D DOWIEDZIELI SIÊ PAÑSTWO O NASZEJ FIRMIE?',
  `hid` varchar(255) DEFAULT NULL COMMENT 'hid unikalne id',
  `user_id` char(36) NOT NULL COMMENT 'Opiekun klienta',
  `client_lead_id` int(11) DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brief_answers`
--

CREATE TABLE IF NOT EXISTS `brief_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `brief_question_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brief_default_questions`
--

CREATE TABLE IF NOT EXISTS `brief_default_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT 'treœæ pytania',
  `category_name` varchar(64) NOT NULL COMMENT 'sekcja pytania',
  `group_name` varchar(64) NOT NULL COMMENT 'grupa pytan(zawierea sekcje_',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brief_questions`
--

CREATE TABLE IF NOT EXISTS `brief_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brief_id` int(11) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL COMMENT 'kategoria pytania - nale¿y do grupy',
  `default` tinyint(1) DEFAULT '0' COMMENT 'mo¿e to sie przyda',
  `content` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;