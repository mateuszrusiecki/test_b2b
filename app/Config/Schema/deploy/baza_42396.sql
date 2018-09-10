ALTER TABLE  `project_issues` CHANGE  `user_id`  `user_id` CHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `sections` ADD  `hourly_rate` INT NULL AFTER  `project_budget_costs_uneditable`;
