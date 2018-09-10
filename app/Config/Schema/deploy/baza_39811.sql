ALTER TABLE `events` ADD `profiles` VARCHAR( 255 ) NOT NULL;
ALTER TABLE `events` CHANGE `profiles` `profiles` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;