
CREATE TABLE IF NOT EXISTS `votes` (
  `vot_id` int(11) NOT NULL AUTO_INCREMENT,
  `vot_vote_option_id` int(11) NOT NULL,
  `vot_mem_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `vote_option` (
  `vop_id` int(11) NOT NULL AUTO_INCREMENT,
  `vop_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vop_pos_id` int(11) DEFAULT NULL,
  `vop_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`vop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
