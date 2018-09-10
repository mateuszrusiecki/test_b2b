ALTER TABLE  `client_projects` ADD  `warranty` INT NULL AFTER  `end_project`;
ALTER TABLE  `client_projects` DROP  `end_warranty` ;