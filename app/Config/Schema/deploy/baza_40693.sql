ALTER TABLE  `project_issues` ADD  `year` CHAR( 4 ) NULL ,
ADD  `month` CHAR( 2 ) NULL;

ALTER TABLE  `project_issues` CHANGE  `id`  `id` BIGINT NOT NULL AUTO_INCREMENT;