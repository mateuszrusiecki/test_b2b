ALTER TABLE  `invoices` CHANGE  `invoice_nr`  `invoice_nr` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

ALTER TABLE  `invoices` CHANGE  `net_price`  `net_price` DECIMAL( 10, 2 ) NULL COMMENT  'kwota netto',
CHANGE  `gross_price`  `gross_price` DECIMAL( 10, 2 ) NULL COMMENT  'kwota brutto',
CHANGE  `vat_rate`  `vat_rate` INT( 11 ) NULL COMMENT  'Stawka VAT',
CHANGE  `vat_amount`  `vat_amount` DECIMAL( 10, 2 ) NULL COMMENT  'kwota VAT',
CHANGE  `payment_date`  `payment_date` DATE NULL COMMENT  'data p³atnoœci';

ALTER TABLE  `invoices` ADD  `payment_id` INT( 11 ) NULL AFTER  `user_id`;

ALTER TABLE  `payments` ADD  `payment_type` INT( 11 ) NULL COMMENT  'null - brak, 1- faktura do wystawienia, 2- faktura wystawiona, 3- faktura op³acona' AFTER  `payment_done`;