ALTER TABLE `payments` CHANGE `price` `price` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'warto��';
ALTER TABLE  `client_project_budgets` CHANGE  `buffer_value`  `buffer_value` DECIMAL( 10, 2 ) NULL DEFAULT NULL COMMENT  'warto�� buforu',
CHANGE  `margin_value`  `margin_value` DECIMAL( 10, 2 ) NULL DEFAULT NULL COMMENT  'warto�� mar�y';

ALTER TABLE  `invoice_positions` CHANGE  `unit_price`  `unit_price` DECIMAL( 10, 2 ) NOT NULL COMMENT  'cena jednostkowa bez podatku';