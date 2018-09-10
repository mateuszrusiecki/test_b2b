CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `original` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `base_project_id` int(11) DEFAULT NULL,
  `_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `w` int(11) DEFAULT NULL,
  `order` int(6) unsigned NOT NULL DEFAULT '2',
  `_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  `pagep_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Dowiazane fotografie do modeli' AUTO_INCREMENT=1211;