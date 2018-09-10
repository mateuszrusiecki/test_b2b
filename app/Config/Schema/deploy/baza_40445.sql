ALTER TABLE `user_users` ADD `status` TINYINT(1) NOT NULL;
UPDATE user_users SET STATUS = 1;