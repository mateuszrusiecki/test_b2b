ALTER TABLE  `client_projects` ADD  `color` VARCHAR( 20 ) NOT NULL COMMENT  'kolor projektu' AFTER  `end_project` ,
ADD  `notes` TEXT NOT NULL COMMENT  'uwagi do projektu' AFTER  `color` ,
ADD  `email` VARCHAR( 255 ) NOT NULL AFTER  `notes` ,
ADD  `shedule_PDF` VARCHAR( 255 ) NOT NULL COMMENT  'link do wygenerowanego PDF' AFTER  `email` ,
ADD  `agreement_id` INT NOT NULL COMMENT  'umowa' AFTER  `shedule_PDF` ,
ADD  `finish_confirmation` TINYINT NOT NULL COMMENT  'potwierdzenie odbioru' AFTER  `agreement_id` ,
ADD  `share` TINYINT NOT NULL COMMENT  'czy udostępnione klientowi' AFTER  `finish_confirmation`
