	
	CREATE TABLE `forms` (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `from_name` varchar(32) DEFAULT NULL,
	  `from_email` varchar(32) DEFAULT NULL,
	  `object_name` varchar(64) DEFAULT NULL,
	  `object_type` varchar(32) DEFAULT NULL,
	  `message` text,
	  `create_time` datetime DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;