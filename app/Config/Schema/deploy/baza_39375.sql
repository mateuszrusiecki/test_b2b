
CREATE TABLE IF NOT EXISTS `invoice_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'nazwa towaru lub us³ugi',
  `symbol` int(11) DEFAULT NULL COMMENT 'symbol PKWiU',
  `jm` varchar(32) DEFAULT NULL COMMENT 'jednostak miary',
  `quantity` int(11) NOT NULL,
  `unit_price` int(10) NOT NULL COMMENT 'cena jednostkowa bez podatku',
  `net_value` decimal(10,2) NOT NULL COMMENT 'wartoœæ towaru bez podatku',
  `tax` int(11) NOT NULL,
  `tax_value` decimal(10,2) NOT NULL,
  `gross_value` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_project_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(11) NOT NULL COMMENT 'klient wybrany z crm',
  `user_id` varchar(36) NOT NULL,
  `invoice_nr` varchar(255) NOT NULL,
  `month` varchar(2) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1 faktura sprzeda¿owa, 2 faktura zakupowa, etc.',
  `payment_type` enum('cash','transfer') NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `net_price` decimal(10,2) NOT NULL COMMENT 'kwota netto',
  `gross_price` decimal(10,2) NOT NULL COMMENT 'kwota brutto',
  `vat_rate` int(11) NOT NULL COMMENT 'Stawka VAT',
  `vat_amount` decimal(10,2) NOT NULL COMMENT 'kwota VAT',
  `place` varchar(255) DEFAULT NULL,
  `payment_date` date NOT NULL COMMENT 'data p³atnoœci',
  `paid` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'faktura op³acona',
  `file` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT 'notatka/opis faktury',
  `created` datetime NOT NULL COMMENT 'data wystawienia',
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `invoices`
--
