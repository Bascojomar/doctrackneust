/*
SQLyog Ultimate v8.55 
MySQL - 5.5.5-10.4.32-MariaDB : Database - edoctrack
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`edoctrack` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `edoctrack`;

/*Table structure for table `accesstype` */

DROP TABLE IF EXISTS `accesstype`;

CREATE TABLE `accesstype` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `accessName` varchar(35) NOT NULL,
  `accessDesc` varchar(50) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `accesstype` */

insert  into `accesstype`(`acc_id`,`accessName`,`accessDesc`,`dateCreated`) values (1,'Super Admin','Super Admin ','2024-05-27 09:47:55'),(2,'Campus Records','Records','2024-06-06 22:35:04'),(4,'Offices','Offices','2024-05-27 09:48:18'),(5,'Procurment','Procurment','2024-05-27 09:48:34'),(6,'Main Record','Main Record','2024-06-06 22:33:30');

/*Table structure for table `campus` */

DROP TABLE IF EXISTS `campus`;

CREATE TABLE `campus` (
  `campus_id` int(11) NOT NULL AUTO_INCREMENT,
  `campusName` varchar(75) NOT NULL,
  `campusCode` varchar(15) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`campus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `campus` */

insert  into `campus`(`campus_id`,`campusName`,`campusCode`,`dateCreated`) values (1,'Gen. Tinio Campus','GTC','2024-05-28 16:16:49'),(2,'Sumacab Campus','SC','2024-05-28 15:56:08'),(3,'Talavera Off-Campus','MGT','2024-05-28 16:10:25');

/*Table structure for table `docktype` */

DROP TABLE IF EXISTS `docktype`;

CREATE TABLE `docktype` (
  `dt_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctypeName` varchar(50) NOT NULL,
  `doctypeCode` varchar(20) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`dt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `docktype` */

insert  into `docktype`(`dt_id`,`doctypeName`,`doctypeCode`,`dateCreated`) values (1,'Communication Letter','Cletter','2024-05-29 08:33:33'),(2,'Purchase request','PR','2024-05-29 08:33:33'),(3,'Voucher','VO','2024-05-29 10:05:33');

/*Table structure for table `documentdetails` */

DROP TABLE IF EXISTS `documentdetails`;

CREATE TABLE `documentdetails` (
  `dd_id` int(11) NOT NULL AUTO_INCREMENT,
  `referenceNo` varchar(128) NOT NULL,
  `office_tag` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `indexing` int(11) NOT NULL,
  `remarks` longtext NOT NULL,
  `dateRecieved` date NOT NULL,
  `dateSigned` date NOT NULL,
  `dateRelease` date NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`dd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `documentdetails` */

insert  into `documentdetails`(`dd_id`,`referenceNo`,`office_tag`,`status`,`indexing`,`remarks`,`dateRecieved`,`dateSigned`,`dateRelease`,`dateCreated`) values (3,'824070400A01',1,0,1,'','0000-00-00','0000-00-00','0000-00-00','2024-07-04 10:00:09'),(4,'824070400A01',2,0,2,'','0000-00-00','0000-00-00','0000-00-00','2024-07-04 10:00:09'),(5,'824070400A01',3,0,3,'','0000-00-00','0000-00-00','0000-00-00','2024-07-04 10:00:09'),(9,'824070408424',1,0,1,'','0000-00-00','0000-00-00','0000-00-00','2024-07-04 20:41:57'),(10,'824070408424',2,0,2,'','0000-00-00','0000-00-00','0000-00-00','2024-07-04 20:41:57'),(11,'824070408424',5,0,3,'','0000-00-00','0000-00-00','0000-00-00','2024-07-04 20:41:57'),(12,'824070408424',3,0,4,'','0000-00-00','0000-00-00','0000-00-00','2024-07-04 20:41:57');

/*Table structure for table `documenttransac` */

DROP TABLE IF EXISTS `documenttransac`;

CREATE TABLE `documenttransac` (
  `docu_id` int(11) NOT NULL AUTO_INCREMENT,
  `documentCode` varchar(128) NOT NULL,
  `referenceNo` varchar(128) NOT NULL,
  `officeCreated` int(11) NOT NULL,
  `othersCreated` int(11) DEFAULT NULL,
  `documentSubject` varchar(256) NOT NULL,
  `dt_id` int(11) NOT NULL,
  `is_voucher` int(11) NOT NULL DEFAULT 0,
  `newUpload` varchar(256) DEFAULT NULL,
  `fileUpload` varchar(256) NOT NULL,
  `remarks` varchar(128) DEFAULT NULL,
  `statusID` int(11) NOT NULL DEFAULT 0,
  `is_mainRecord` int(11) DEFAULT 0,
  `dateRelease` date DEFAULT NULL,
  `dateDone` date DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `recieveBy` varchar(128) DEFAULT NULL,
  `contactNo` varchar(50) DEFAULT NULL,
  `dateRecievedby` date DEFAULT NULL,
  `userCreated` int(11) NOT NULL,
  `dateDeleted` date DEFAULT NULL,
  PRIMARY KEY (`docu_id`),
  KEY `dt_id` (`dt_id`),
  KEY `officeCreated` (`officeCreated`),
  KEY `userCreated` (`userCreated`),
  CONSTRAINT `documenttransac_ibfk_1` FOREIGN KEY (`dt_id`) REFERENCES `docktype` (`dt_id`),
  CONSTRAINT `documenttransac_ibfk_2` FOREIGN KEY (`officeCreated`) REFERENCES `offices` (`office_id`),
  CONSTRAINT `documenttransac_ibfk_3` FOREIGN KEY (`userCreated`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `documenttransac` */

insert  into `documenttransac`(`docu_id`,`documentCode`,`referenceNo`,`officeCreated`,`othersCreated`,`documentSubject`,`dt_id`,`is_voucher`,`newUpload`,`fileUpload`,`remarks`,`statusID`,`is_mainRecord`,`dateRelease`,`dateDone`,`dateCreated`,`recieveBy`,`contactNo`,`dateRecievedby`,`userCreated`,`dateDeleted`) values (1,'NEUST240704-8-23870','824070400A01',8,NULL,'HUMAN SAMPLE',1,0,NULL,'Study-Guide-2022.pdf',NULL,0,0,NULL,NULL,'2024-07-04 09:32:59',NULL,NULL,NULL,10,NULL),(2,'NEUST240704-8-1307E','824070408424',8,NULL,'GGGG',1,0,NULL,'Study-Guide-2022.pdf',NULL,0,0,NULL,NULL,'2024-07-04 09:44:44',NULL,NULL,NULL,10,NULL);

/*Table structure for table `documentvoucher` */

DROP TABLE IF EXISTS `documentvoucher`;

CREATE TABLE `documentvoucher` (
  `dv_id` int(11) NOT NULL AUTO_INCREMENT,
  `referenceNo` varchar(128) NOT NULL,
  `vType` varchar(128) NOT NULL,
  `Vnumber` varchar(128) NOT NULL,
  `vAmmount` varchar(128) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateDeleted` date DEFAULT NULL,
  PRIMARY KEY (`dv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `documentvoucher` */

insert  into `documentvoucher`(`dv_id`,`referenceNo`,`vType`,`Vnumber`,`vAmmount`,`dateCreated`,`dateDeleted`) values (1,'8240606CC1AC','2','12345','123456','2024-06-06 20:51:09',NULL);

/*Table structure for table `offices` */

DROP TABLE IF EXISTS `offices`;

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL AUTO_INCREMENT,
  `officeName` varchar(50) NOT NULL,
  `officeCode` varchar(25) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `campus` int(11) NOT NULL,
  PRIMARY KEY (`office_id`),
  KEY `campus` (`campus`),
  CONSTRAINT `offices_ibfk_1` FOREIGN KEY (`campus`) REFERENCES `campus` (`campus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `offices` */

insert  into `offices`(`office_id`,`officeName`,`officeCode`,`dateCreated`,`campus`) values (5,'All Office','AllOffice','2024-05-27 19:08:11',1),(6,'Office of the President','President','2024-05-27 19:08:37',1),(7,'University Cyber Center','UCC','2024-05-28 09:35:38',2),(8,'Human Resourses','HR','2024-05-28 09:35:38',1),(9,'Office of Director - MGT','MGT','2024-06-13 09:46:59',3);

/*Table structure for table `officesignatory` */

DROP TABLE IF EXISTS `officesignatory`;

CREATE TABLE `officesignatory` (
  `os_id` int(11) NOT NULL AUTO_INCREMENT,
  `signatory` varchar(100) NOT NULL,
  `position_id` int(11) DEFAULT 0,
  `office_id` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`os_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `officesignatory` */

insert  into `officesignatory`(`os_id`,`signatory`,`position_id`,`office_id`,`dateCreated`,`is_active`) values (1,'Marlon',3,6,'2024-07-07 16:03:42',1),(2,'Ron',0,7,'2024-07-03 23:10:57',1),(3,'Mark',0,5,'2024-07-03 23:11:06',1),(4,'Reyjohn',0,5,'2024-07-03 23:11:18',1),(5,'Darren',0,7,'2024-07-03 23:11:21',1);

/*Table structure for table `position` */

DROP TABLE IF EXISTS `position`;

CREATE TABLE `position` (
  `positionID` int(11) NOT NULL AUTO_INCREMENT,
  `positionTitle` varchar(100) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`positionID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `position` */

insert  into `position`(`positionID`,`positionTitle`,`dateCreated`,`status`) values (1,'University President','2024-07-05 07:23:40',1),(2,'Vice President for Academic Affair','2024-07-05 07:23:40',1),(3,'Director','2024-07-05 09:09:49',1),(4,'Deans','2024-07-05 09:09:49',1);

/*Table structure for table `request` */

DROP TABLE IF EXISTS `request`;

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `request` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(75) NOT NULL,
  `userPassword` varchar(128) NOT NULL,
  `pic` varchar(128) NOT NULL,
  `accesstype` int(11) NOT NULL,
  `userStatus` int(11) NOT NULL DEFAULT 1,
  `offices` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_online` int(11) DEFAULT NULL,
  `sessionCode` varchar(128) DEFAULT NULL,
  `dateDeleted` date DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `accesstype` (`accesstype`),
  KEY `offices` (`offices`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`accesstype`) REFERENCES `accesstype` (`acc_id`),
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`offices`) REFERENCES `offices` (`office_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`fullname`,`email`,`userPassword`,`pic`,`accesstype`,`userStatus`,`offices`,`dateCreated`,`is_online`,`sessionCode`,`dateDeleted`) values (2,'Rey John P. Aguilar','admin@gmail.com','6e9c053712b4e7da4a4ae86d6faa30db','admin.jpg',1,1,NULL,'2024-06-10 10:29:44',NULL,NULL,NULL),(3,'Rhodora R. Jugo','vpaa@gmail.com','123','pic.jpg',4,1,8,'2024-06-13 22:10:21',NULL,NULL,NULL),(10,'Darren Acuna','pogireyjohn70@gmail.com','202cb962ac59075b964b07152d234b70','pic.jpg',1,1,5,'2024-07-07 16:01:18',1,'mufj5c3b2v5rvkgp33a5r28so6668536a75149b9.94771194',NULL),(11,'Jomar Castro','reyjohnaguilar70@gmail.com','6ddb051078469914fb7d37a4f0df7c0e','FINAL PACK.jpg',4,1,7,'2024-05-28 10:07:33',NULL,NULL,NULL),(12,'Jomar DJ. Basco','bascojomar02@gmail.com','202cb962ac59075b964b07152d234b70','IMG_2542.JPG',4,1,9,'2024-06-13 09:48:31',1,'ha2cbdlb5v2057gvn1ugkmn47v6661cf81510cb5.61028394',NULL),(13,'June Bernard Tayupon','jedirang6@gmail.com','202cb962ac59075b964b07152d234b70','IMG_2542.JPG',2,1,9,'2024-06-14 10:32:17',1,'mjeu8u35nfhs2jsto6nmm046n1666bababd10720.91081996',NULL),(14,'June Bernard Tayupon','jedirang6@gmail.com','c20e311b48095e41094c7f953bd283ca','IMG_2542.JPG',6,1,5,'2024-06-10 10:35:37',NULL,NULL,'2024-06-10'),(15,'Main Record','nstpreyjohn70@gmail.com','202cb962ac59075b964b07152d234b70','IMG_2542 (1).JPG',6,1,5,'2024-06-10 10:34:17',NULL,NULL,NULL);

/*Table structure for table `vouchertype` */

DROP TABLE IF EXISTS `vouchertype`;

CREATE TABLE `vouchertype` (
  `vt_id` int(11) NOT NULL AUTO_INCREMENT,
  `vtName` varchar(50) NOT NULL,
  `vtDesc` varchar(50) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`vt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `vouchertype` */

insert  into `vouchertype`(`vt_id`,`vtName`,`vtDesc`,`DateCreated`) values (1,'MDS','MDS','2024-06-06 20:40:42'),(2,'CHECK','CHECK','2024-06-06 20:40:42');

/*Table structure for table `z_tmp_signatory10` */

DROP TABLE IF EXISTS `z_tmp_signatory10`;

CREATE TABLE `z_tmp_signatory10` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `os_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `z_tmp_signatory10` */

insert  into `z_tmp_signatory10`(`id`,`os_id`) values (1,1),(2,2),(3,5),(4,3);

/*Table structure for table `z_tmp_signatory16` */

DROP TABLE IF EXISTS `z_tmp_signatory16`;

CREATE TABLE `z_tmp_signatory16` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `os_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `z_tmp_signatory16` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
