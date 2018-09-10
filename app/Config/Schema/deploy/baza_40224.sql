ALTER TABLE  `checklist_positions` CHANGE  `name`  `name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `checklist_positions` ADD PRIMARY KEY (  `id` );
ALTER TABLE  `checklist_positions` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `checklist_position_groups` ADD PRIMARY KEY (  `id` );
ALTER TABLE  `checklist_position_groups` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT;
