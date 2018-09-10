ALTER TABLE  `project_files` ADD  `section_id` INT NULL AFTER  `file_category_id`;
ALTER TABLE  `project_files` ADD  `parent_id` INT NULL AFTER  `section_id`;
ALTER TABLE  `project_files` DROP `file_name`;
ALTER TABLE  `project_files` CHANGE  `client_project_id`  `client_project_id` INT( 11 ) NULL;
