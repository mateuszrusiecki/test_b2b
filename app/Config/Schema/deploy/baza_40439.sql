ALTER TABLE  `clients` ADD  `account_manager_id` CHAR( 36 ) NULL AFTER  `user_id`;
ALTER TABLE  `clients` CHANGE  `user_id`  `user_id` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT  'Id user_user';
ALTER TABLE  `clients` CHANGE  `account_manager_id`  `account_manager_id` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT  'ID Handlowca FEB odpowiedzialnego za klienta';

ALTER TABLE `user_users`
  DROP `facebook_id`,
  DROP `login`,
  DROP `name`,
  DROP `section_id`,
  DROP `menu`,
  DROP `failed_loginss`,
  DROP `date_locked`;
DROP TABLE  `user_clients`;