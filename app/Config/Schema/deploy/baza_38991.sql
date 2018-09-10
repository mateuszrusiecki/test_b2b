ALTER TABLE  `sections` ADD  `project_budget_costs_uneditable` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `supervisor`;

UPDATE  `sections` SET  `project_budget_costs_uneditable` =  '1' WHERE  `sections`.`id` =3;
UPDATE  `sections` SET  `project_budget_costs_uneditable` =  '1' WHERE  `sections`.`id` =4;
UPDATE  `sections` SET  `project_budget_costs_uneditable` =  '1' WHERE  `sections`.`id` =5;
UPDATE  `sections` SET  `project_budget_costs_uneditable` =  '1' WHERE  `sections`.`id` =6;