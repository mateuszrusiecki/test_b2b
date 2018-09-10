ALTER TABLE  `user_work_times` CHANGE  `hours_worked`  `hours_worked` DECIMAL( 10, 2 ) NULL DEFAULT NULL ,
CHANGE  `overtime`  `overtime` DECIMAL( 10, 2 ) NULL DEFAULT NULL ,
CHANGE  `total_overtime`  `total_overtime` DECIMAL( 10, 2 ) NULL DEFAULT NULL;
ALTER TABLE  `user_work_times` ADD  `hours_to_work` INT NULL AFTER  `contract_summary`;