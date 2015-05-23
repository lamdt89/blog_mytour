/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 5.6.21 : Database - blog_v3
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`blog_v3` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `blog_v3`;

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `modules` */

insert  into `modules`(`mod_id`,`mod_name`,`mod_path`,`mod_listname`,`mod_listfile`,`mod_order`,`mod_help`,`lang_id`,`mod_checkloca`) values (1,'Danh mục','categories_multi','Thêm mới|Danh sách','add.php|listing.php',0,NULL,1,0),(7,'Phân quyền quản trị','admin_user','Thêm mới|Danh sách','add.php|listing.php',7,NULL,1,0),(12,'Cấu hình','configuration','Cấu hình website','configuration.php',8,NULL,1,0),(2,'Bình luận','comments','Danh sách','listing.php',12,NULL,1,0),(3,'Bài viết','post','Danh sách|Thống kê','listing.php|statistic.php',0,NULL,1,0),(4,'Thành viên','members','Thêm mới|Danh sách','add.php|listing.php',0,NULL,1,0),(30,'Thể loại','category_post','Thêm mới|Danh sách','add.php|listing.php',0,NULL,1,0),(32,'Phòng ban','department','Thêm mới|Danh sách','add.php|listing.php',0,NULL,1,0),(33,'Tags','tags','Thêm mới|Danh sách','add.php|listing.php',0,NULL,1,0),(34,'Thảo luận','votes','Thêm mới|Danh sách','add.php|listing.php',0,NULL,1,0);

/*Table structure for table `vote_option` */

DROP TABLE IF EXISTS `vote_option`;

CREATE TABLE `vote_option` (
  `vop_id` int(11) NOT NULL AUTO_INCREMENT,
  `vop_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vop_vote_id` int(11) DEFAULT NULL,
  `vop_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`vop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `vote_option` */

insert  into `vote_option`(`vop_id`,`vop_name`,`vop_vote_id`,`vop_user_id`) values (7,'test07',7,NULL),(8,'test07',7,NULL),(9,'test07',7,NULL);

/*Table structure for table `votes` */

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes` (
  `vot_id` int(11) NOT NULL AUTO_INCREMENT,
  `vot_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vot_content` text COLLATE utf8_unicode_ci,
  `vot_active` bit(1) DEFAULT b'0',
  PRIMARY KEY (`vot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `votes` */

insert  into `votes`(`vot_id`,`vot_name`,`vot_content`,`vot_active`) values (2,'test02','test02','\0'),(3,'test03','test03','\0'),(4,'test04','test04','\0'),(5,'test05','test05','\0'),(6,'test06','test06','\0'),(7,'test07','test07','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
