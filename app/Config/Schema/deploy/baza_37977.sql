ALTER TABLE  `sections` ADD  `user_id` CHAR( 36 ) NULL COMMENT  'supervisor prze³o¿ony' AFTER  `name`;

ALTER TABLE  `sections` CHANGE  `user_id`  `supervisor` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NULL DEFAULT NULL COMMENT  'supervisor prze³o¿ony';

