ALTER TABLE  `user_users` CHANGE  `pass`  `pass` CHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  '';

ALTER TABLE  `user_contract_histories` ADD  `salary_adjustment` DECIMAL( 10, 2 ) NULL AFTER  `salary_net`;
ALTER TABLE  `user_contract_histories` ADD  `salary_date_from` DATE NOT NULL AFTER  `salary_adjustment` ,
ADD  `salary_date_to` DATE NOT NULL AFTER  `salary_date_from`;

ALTER TABLE  `user_contract_histories` ADD  `hourly_rate` BLOB NOT NULL AFTER  `salary_net`;
ALTER TABLE  `user_contract_histories` CHANGE  `working_time`  `working_time` VARCHAR( 8 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT  'wymiar czasu pracy';
ALTER TABLE  `user_contract_histories` CHANGE  `salary_date_from`  `salary_date_from` DATE NULL ,
CHANGE  `salary_date_to`  `salary_date_to` DATE NULL;