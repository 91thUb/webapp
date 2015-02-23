/*
SQLyog Community v11.31 (32 bit)
MySQL - 5.1.41 : Database - core_app
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`core_app` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `core_app`;

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`name`,`description`,`url`,`parent`) values (1,'Web Configuration','Module untuk konfigurasi global aplikasi','-',0),(2,'Master Data','Module untuk master data','-',0),(3,'Web Service','Module web service','-',0),(6,'Module Management','Module Management','moduleManagement',1),(7,'User Management','User Management','userManagement',1),(10,'User Level','User Level Management','userLevel',1),(22,'Tanaman','Mengelola data tanaman','tanaman',2),(28,'Tanaman','Mengelola koleksi tanaman ','-',0);

/*Table structure for table `module_privilage` */

DROP TABLE IF EXISTS `module_privilage`;

CREATE TABLE `module_privilage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_module_privilage_to_user_level` (`user_level_id`),
  KEY `FK_module_privilage_to_module` (`module_id`),
  CONSTRAINT `FK_module_privilage_to_module` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_module_privilage_to_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

/*Data for the table `module_privilage` */

insert  into `module_privilage`(`id`,`module_id`,`user_level_id`) values (119,6,1),(142,10,1),(156,7,1),(157,7,2),(159,22,1);

/*Table structure for table `option` */

DROP TABLE IF EXISTS `option`;

CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `option` */

insert  into `option`(`id`,`name`,`value`,`enable`,`description`) values (1,'Application Name','Core App',1,''),(2,'Enable Backend','Core App',1,'true'),(3,'Enable Frontend','Core App',1,'true'),(4,'Maintenance Mode','Core App',1,'true');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_passwd` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `register_by` int(11) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_ip_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user` (`user_level_id`),
  CONSTRAINT `FK_user` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`user_name`,`user_passwd`,`email`,`register_date`,`register_by`,`user_level_id`,`last_login_date`,`last_ip_address`) values (234,'Asep Rahmat Ginanjar','admin','21232f297a57a5a743894a0e4a801fc3','anjar@local.com',NULL,NULL,1,'2015-02-23 11:19:42','::1'),(240,'asnie','asnie9','11d8c28a64490a987612f2332502467f','anjar@local.com','2012-08-02 16:19:28',NULL,3,NULL,NULL);

/*Table structure for table `user_level` */

DROP TABLE IF EXISTS `user_level`;

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `user_level` */

insert  into `user_level`(`id`,`name`,`description`,`parent`) values (1,'administrator','Administrator User',0),(2,'normal user','Non Administratif User',0),(3,'sub admin 1','sub admin 1',1),(4,'sub admin 2','sub admin 2',1),(7,'asd','asd',0),(8,'er','User Manager',3),(10,'sub sub admin','polkiolll',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
