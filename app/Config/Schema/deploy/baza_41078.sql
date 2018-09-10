CREATE TABLE IF NOT EXISTS `text_documents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL,
  `lead_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `share_link` varchar(255) NOT NULL,
  `share_block` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `doc_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;