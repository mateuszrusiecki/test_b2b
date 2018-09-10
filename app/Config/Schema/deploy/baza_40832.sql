ALTER TABLE `comments` ADD `email_confirmed` TINYINT( 1 ) NOT NULL;
ALTER TABLE `comments` CHANGE `email_confirmed` `email_confirmed` TINYINT( 1 ) NOT NULL DEFAULT '0';