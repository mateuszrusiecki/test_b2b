ALTER TABLE  `client_domains` ADD  `site_id` INT NULL COMMENT  'Id site_id z aplikcaji stat4seo.pl (seo.feb.net.pl/api/client.php?domain=[base64])' AFTER  `client_id`;
ALTER TABLE  `project_files` ADD  `client_domain_id` INT NULL AFTER  `project_file_category_id`;
