ALTER TABLE  `lead_logs` ADD  `subject` VARCHAR( 255 ) NULL AFTER  `name` ,
ADD  `message` TEXT NULL AFTER  `subject` ,
ADD  `from` VARCHAR( 255 ) NULL AFTER  `message`