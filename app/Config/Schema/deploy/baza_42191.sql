CREATE TABLE IF NOT EXISTS `base_projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `client_project_id` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `coordinator_contact` int(10) NOT NULL,
  `programmer_contact` int(10) NOT NULL,
  `pictures` varchar(255) NOT NULL,
  `languages` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;