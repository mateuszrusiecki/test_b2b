ALTER TABLE  `briefs` CHANGE  `user_id`  `user_id` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT  'twórca briefa';
ALTER TABLE  `briefs` ADD  `guardian_id` INT NULL COMMENT  'opiekun klienta' AFTER  `user_id`;
ALTER TABLE  `briefs` CHANGE  `guardian_id`  `guardian_id` CHAR( 36 ) NULL DEFAULT NULL COMMENT  'opiekun klienta';
ALTER TABLE  `brief_answers` CHANGE  `user_id`  `user_id` CHAR( 36 ) NULL;