ALTER TABLE  `briefs` ADD  `completed` TINYINT NOT NULL DEFAULT  '0' AFTER  `client_lead_id`;
ALTER TABLE  `messages` ADD  `link` VARCHAR( 255 ) NULL AFTER  `body`;