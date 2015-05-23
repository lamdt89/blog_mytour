

CREATE TABLE IF NOT EXISTS `admin_translate` (
  `tra_keyword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tra_text` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `tra_source` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`tra_keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `admin_user` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_loginname` varchar(100) DEFAULT NULL,
  `adm_password` varchar(100) DEFAULT NULL,
  `adm_name` varchar(255) DEFAULT NULL,
  `adm_email` varchar(255) DEFAULT NULL,
  `adm_address` varchar(255) DEFAULT NULL,
  `adm_phone` varchar(255) DEFAULT NULL,
  `adm_mobile` varchar(255) DEFAULT NULL,
  `adm_access_module` varchar(255) DEFAULT NULL,
  `adm_access_category` text,
  `adm_date` int(11) DEFAULT '0',
  `adm_isadmin` tinyint(1) DEFAULT '0',
  `adm_active` tinyint(1) DEFAULT '1',
  `lang_id` tinyint(1) DEFAULT '1',
  `adm_delete` int(11) DEFAULT '0',
  `adm_all_category` int(1) DEFAULT NULL,
  `adm_edit_all` int(1) DEFAULT '0',
  `admin_id` int(1) DEFAULT '0',
  PRIMARY KEY (`adm_id`),
  KEY `adm_date` (`adm_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=32 ;

CREATE TABLE IF NOT EXISTS `admin_user_category` (
  `auc_admin_id` int(11) NOT NULL DEFAULT '0',
  `auc_category_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `admin_user_language` (
  `aul_admin_id` int(11) NOT NULL DEFAULT '0',
  `aul_lang_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aul_admin_id`,`aul_lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `admin_user_right` (
  `adu_id` int(11) NOT NULL AUTO_INCREMENT,
  `adu_admin_id` int(11) NOT NULL,
  `adu_admin_module_id` int(11) NOT NULL DEFAULT '0',
  `adu_add` int(1) DEFAULT '0',
  `adu_edit` int(1) DEFAULT '0',
  `adu_delete` int(1) DEFAULT '0',
  `adu_view` int(1) DEFAULT '0',
  PRIMARY KEY (`adu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

CREATE TABLE IF NOT EXISTS `article_tag_cloud` (
  `atc_tag_cloud_id` int(11) NOT NULL AUTO_INCREMENT,
  `atc_pos_id` int(11) DEFAULT NULL,
  `atc_tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`atc_tag_cloud_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_show_menu` int(1) DEFAULT '1',
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_has_child` int(1) DEFAULT NULL,
  `cat_active` int(1) DEFAULT NULL,
  `cat_is_login` bit(1) DEFAULT NULL,
  `cat_has_it` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `comments` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_content` text COLLATE utf8_unicode_ci,
  `cmt_time` int(11) DEFAULT NULL,
  `cmt_pos_id` int(11) DEFAULT NULL,
  `cmt_mem_id` int(11) DEFAULT NULL,
  `cmt_like` text COLLATE utf8_unicode_ci,
  `cmt_active` bit(1) DEFAULT NULL,
  `cmt_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `configuration` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dasdsadsa',
  `con_page_size` varchar(10) DEFAULT NULL,
  `con_left_size` varchar(10) DEFAULT NULL,
  `con_right_size` varchar(10) DEFAULT NULL,
  `con_admin_email` varchar(255) DEFAULT NULL,
  `con_site_title` varchar(255) DEFAULT NULL,
  `con_meta_description` text,
  `con_meta_keywords` text,
  `con_currency` varchar(20) DEFAULT NULL,
  `con_exchange` double DEFAULT '0',
  `con_mod_rewrite` tinyint(1) DEFAULT '0',
  `con_lang_id` int(11) DEFAULT '1',
  `con_extenstion` varchar(20) DEFAULT 'html',
  `con_support_online` text,
  `lang_id` int(11) DEFAULT '1',
  `con_list_currency` varchar(255) DEFAULT 'USD',
  `con_product_page` int(11) DEFAULT '10',
  `con_gmail_name` varchar(255) DEFAULT NULL,
  `con_gmail_pass` varchar(255) DEFAULT NULL,
  `con_gmail_subject` varchar(255) DEFAULT NULL,
  `con_filename` varchar(255) DEFAULT NULL,
  `con_news_page` int(11) DEFAULT '0',
  `con_static_footer` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `ip_deny` (
  `ip_ip` int(11) NOT NULL,
  `ip_last_update` int(11) DEFAULT '0',
  `ip_count` int(11) DEFAULT '0',
  PRIMARY KEY (`ip_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `kdims` (
  `dkm_id` int(11) NOT NULL DEFAULT '0',
  `dkm_key` text,
  `dkm_domain` varchar(40) DEFAULT NULL,
  `dkm_hash` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`dkm_id`),
  UNIQUE KEY `dkm_domain` (`dkm_domain`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `languages` (
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `lang_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_path` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'home',
  `lang_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `members` (
  `mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_active` int(11) DEFAULT '0',
  `mem_login` varchar(100) DEFAULT NULL,
  `mem_password` varchar(50) DEFAULT NULL,
  `mem_first_name` varchar(50) DEFAULT NULL,
  `mem_last_name` varchar(50) DEFAULT NULL,
  `mem_birthdays` varchar(10) DEFAULT NULL,
  `mem_gender` int(11) DEFAULT '0',
  `mem_phone` varchar(20) DEFAULT NULL,
  `mem_fax` varchar(20) DEFAULT NULL,
  `mem_email` varchar(100) DEFAULT NULL,
  `mem_address` varchar(255) DEFAULT NULL,
  `mem_join_date` int(11) DEFAULT '0',
  `mem_dep_id` int(11) DEFAULT '0',
  `mem_name` varchar(255) DEFAULT NULL,
  `mem_admin` int(11) DEFAULT '0',
  `mem_type` int(11) DEFAULT '0',
  `mem_avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20025 ;

CREATE TABLE IF NOT EXISTS `modules` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(100) DEFAULT NULL,
  `mod_path` varchar(255) DEFAULT NULL,
  `mod_listname` varchar(100) DEFAULT NULL,
  `mod_listfile` varchar(100) DEFAULT NULL,
  `mod_order` int(11) DEFAULT '0',
  `mod_help` mediumtext,
  `lang_id` int(11) DEFAULT '1',
  `mod_checkloca` int(11) DEFAULT '0',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `posts` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `pos_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos_content` text COLLATE utf8_unicode_ci,
  `pos_time` int(11) DEFAULT NULL,
  `pos_mem_id` int(11) DEFAULT NULL,
  `pos_cat_id` int(11) DEFAULT NULL,
  `pos_active` bit(1) DEFAULT NULL,
  `pos_search` text COLLATE utf8_unicode_ci,
  `pos_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos_att_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `statics_multi` (
  `sta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sta_category_id` int(11) DEFAULT '0',
  `sta_title` varchar(255) DEFAULT NULL,
  `sta_order` double DEFAULT '0',
  `sta_description` text,
  `sta_date` int(11) DEFAULT '0',
  `lang_id` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`sta_id`),
  KEY `sta_category_id` (`sta_category_id`),
  KEY `sta_order` (`sta_order`),
  KEY `sta_date` (`sta_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=17 ;

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tag_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `visited` (
  `vis_counter` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
