
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_project_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(11) NOT NULL COMMENT 'klient wybrany z crm',
  `invoice_nr` varchar(255) NOT NULL,
  `month` varchar(2) NOT NULL,
  `year` year(4) NOT NULL,
  `type` int(11) DEFAULT NULL COMMENT 'faktura zakupowa, sprzeda¿owa etc.',
  `payment_type` enum('cash','transfer') NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `net_price` varchar(20) NOT NULL COMMENT 'kwota netto',
  `gross_price` varchar(20) NOT NULL COMMENT 'kwota brutto',
  `vat_rate` int(11) NOT NULL COMMENT 'Stawka VAT',
  `vat_amount` int(11) NOT NULL COMMENT 'kwota VAT',
  `place` varchar(255) DEFAULT NULL,
  `payment_date` date NOT NULL COMMENT 'data p³atnoœci',
  `paid` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'faktura op³acona',
  `file` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT 'notatka/opis faktury',
  `created` datetime NOT NULL COMMENT 'data wystawienia',
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE  `client_projects` CHANGE  `total_development_costs`  `total_development_costs` DECIMAL( 10, 2 ) NULL DEFAULT  '0' COMMENT  'suma kosztów projektowych',
CHANGE  `total_buffer`  `total_buffer` DECIMAL( 10, 2 ) NULL DEFAULT  '0' COMMENT  'suma buforów w projekcie',
CHANGE  `total_costs_sum`  `total_costs_sum` DECIMAL( 10, 2 ) NULL DEFAULT  '0' COMMENT  'aktualna suma wydatków poniesionych w projekcie';

ALTER TABLE  `invoices` ADD  `user_id` VARCHAR( 36 ) NOT NULL AFTER  `client_id`;
ALTER TABLE  `invoices` CHANGE  `vat_amount`  `vat_amount` DECIMAL( 10, 2 ) NOT NULL COMMENT  'kwota VAT';
ALTER TABLE  `invoices` CHANGE  `gross_price`  `gross_price` DECIMAL( 10, 2 ) NOT NULL COMMENT  'kwota brutto';
ALTER TABLE  `invoices` CHANGE  `net_price`  `net_price` DECIMAL( 10, 2 ) NOT NULL COMMENT  'kwota netto';
ALTER TABLE  `invoices` CHANGE  `month`  `month` VARCHAR( 2 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
CHANGE  `year`  `year` YEAR( 4 ) NULL