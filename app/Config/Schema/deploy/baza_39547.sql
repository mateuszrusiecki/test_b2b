ALTER TABLE  `menus` ADD  `group_id` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER  `parent_id`;
ALTER TABLE  `menus` ADD  `icon` VARCHAR( 255 ) NULL AFTER  `id`;

