ALTER TABLE  `clients` ADD  `nip` VARCHAR( 16 ) NULL AFTER  `email`;
ALTER TABLE `project_issues` CHANGE `projects_id` `client_project_id` INT(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE  `invoices` ADD  `issue_date` DATE NULL COMMENT  'Data wystawienia faktury' AFTER  `payment_date`;
ALTER TABLE  `invoices` ADD  `paid_amount` DECIMAL(10,2) NULL DEFAULT  '0' COMMENT  'Kwota zap³acona' AFTER  `paid`;