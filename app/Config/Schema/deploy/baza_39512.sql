ALTER TABLE  `profiles` ADD  `hourly_rate` DECIMAL( 10, 2 ) NULL COMMENT  'Stawka godzinowa' AFTER  `salary_net`;
ALTER TABLE  `grindstones` ADD  `user_id` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_bin NULL AFTER  `project_user_name`;
ALTER TABLE  `project_issues` ADD  `user_id` CHAR( 36 ) NULL AFTER  `project_users_name`;