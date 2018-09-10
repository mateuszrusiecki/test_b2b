ALTER TABLE  `social_books` ADD  `about` TEXT NULL AFTER  `user_id` ,
ADD  `competence` TEXT NULL AFTER  `about` ,
ADD  `skype` VARCHAR( 255 ) NULL AFTER  `competence` ,
ADD  `website` VARCHAR( 255 ) NULL AFTER  `skype` ,
ADD  `facebook` VARCHAR( 255 ) NULL AFTER  `website` ,
ADD  `office_room` VARCHAR( 255 ) NULL AFTER  `facebook`;
