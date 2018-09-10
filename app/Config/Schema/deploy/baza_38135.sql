ALTER TABLE  `client_projects` ADD  `auto_project` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `end_project`;
ALTER TABLE  `client_projects` ADD  `interval_project` INT NULL AFTER  `auto_project`;
ALTER TABLE  `client_projects` ADD  `active` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `id`;