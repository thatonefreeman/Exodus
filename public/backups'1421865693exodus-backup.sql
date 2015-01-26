-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: kc_exodus
-- ------------------------------------------------------
-- Server version	5.6.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachements`
--

DROP TABLE IF EXISTS `attachements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment_name` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment_description` text COLLATE utf8_unicode_ci NOT NULL,
  `file_location` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachements`
--

LOCK TABLES `attachements` WRITE;
/*!40000 ALTER TABLE `attachements` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `client_company_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `client_number` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `client_address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `client_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `client_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (7,'Sue Higgins','North Grenville Public Library','(613) 258-4711','PO\r\nKemptville, ON\r\nK0G1J0','shiggins@ngpl.ca','','2014-12-13 03:47:34','2014-12-13 03:47:34');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_datetime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_company_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_comments` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `expense_payment_type` enum('Cash','Credit Card','eTransfer','Debit Card','Gift Card','Store Credit','Other') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (11,'1','2955 Highway 43 Kemptville ontario ','W. O Stinson & Son','01/11/2015 3:59 PM','25','2.88','AID0000002771010','Comment','2015-01-12 03:44:17','2015-01-12 03:44:17',NULL,'Debit Card'),(13,'2','2600 Highway 43 Kemptville ontario ','Mcdonalds store 29040','01/11/2015 11:52 AM','3.27','.16','899863765','Personal coffee','2015-01-12 04:02:12','2015-01-12 04:02:12',NULL,'Cash'),(14,'2','2600 Highway 43 Kemptville ontario ','Mcdonalds store 29040','01/05/2015 12:06 PM','7.75','1.01','899863765','One medium coffee for business,  the rest personal. ','2015-01-12 04:04:52','2015-01-12 04:04:52',NULL,'Debit Card'),(15,'2','309 colonnade drive unit 100','Subway #50070-0','01/12/2015 1:49 PM','4.50','.58','0','No gst number on receipt. ','2015-01-13 00:59:03','2015-01-13 00:59:03',NULL,'Cash'),(16,'2','2600 Highway 43 Kemptville ontario ','Mcdonalds store 29040','01/13/2015 4:12 PM','3.24','.16','899863765','Only one coffee claimable','2015-01-14 03:24:08','2015-01-14 03:24:08',NULL,'Cash'),(17,'2','2600 Highway 43 Kemptville ontario ','Mcdonalds store 29040','01/13/2015 12:14 PM','3.81','.19','899863765','','2015-01-14 03:25:25','2015-01-14 03:25:25',NULL,'Cash'),(19,'2','Canadaasd','asdasd','01/15/2015 7:21 PM','3434','3434','6514561468484','asdfsdf','2015-01-16 06:21:30','2015-01-16 06:21:41','2015-01-16 06:21:41','Gift Card');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses_attachment`
--

DROP TABLE IF EXISTS `expenses_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_attachment_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expenses_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses_attachment`
--

LOCK TABLES `expenses_attachment` WRITE;
/*!40000 ALTER TABLE `expenses_attachment` DISABLE KEYS */;
INSERT INTO `expenses_attachment` VALUES (4,'/uploads/expensestracker/ojsykC_1421012596076-488150903.jpg','11','2015-01-12 03:44:18','2015-01-12 03:44:18',NULL),(6,'/uploads/expensestracker/24YGij_14210136894112086414886.jpg','13','2015-01-12 04:02:12','2015-01-12 04:02:12',NULL),(7,'/uploads/expensestracker/WZOAt1_1421013837506530290576.jpg','14','2015-01-12 04:04:52','2015-01-12 04:04:52',NULL),(8,'/uploads/expensestracker/mxlbM0_1421089101922906884542.jpg','15','2015-01-13 00:59:03','2015-01-13 00:59:03',NULL),(9,'/uploads/expensestracker/Vd5mWh_1421184214484-650168835.jpg','16','2015-01-14 03:24:09','2015-01-14 03:24:09',NULL),(10,'/uploads/expensestracker/V9o2HJ_1421184301788-783628103.jpg','17','2015-01-14 03:25:25','2015-01-14 03:25:25',NULL),(11,'/uploads/expensestracker/pGw8Qu_1421243059183-672869623.jpg','18','2015-01-14 19:44:58','2015-01-14 19:44:58',NULL),(12,'/uploads/expensestracker/zRwe9A_water well-01.png','19','2015-01-16 06:21:30','2015-01-16 06:21:30',NULL);
/*!40000 ALTER TABLE `expenses_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses_category`
--

DROP TABLE IF EXISTS `expenses_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_category_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses_category`
--

LOCK TABLES `expenses_category` WRITE;
/*!40000 ALTER TABLE `expenses_category` DISABLE KEYS */;
INSERT INTO `expenses_category` VALUES (1,'Vehicle Fuel','Any gas/fuel that has been purchased for the use of travelling to/from company related trips.','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(2,'Food / Drink','Any meals or drinks purchased during business hours or for business related matters (like meetings with clients, on the job, etcetera).','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(3,'Cell Phone','Phone bills relating to devices used for the management and running of the company during business hours.','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(4,'Personal Withdrawal','Any transfers out of the company account for personal use.','2015-01-15 06:00:00','2015-01-15 06:00:00',NULL),(5,'Business Withdrawal ','Any transfers out of the account for use by the business.','2015-01-15 06:00:00','2015-01-15 06:00:00',NULL);
/*!40000 ALTER TABLE `expenses_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_12_01_201953_kc_exodus',1),('2014_12_01_205606_kc_exodus',2),('2014_12_12_204933_create_posts_table',3),('2014_12_12_210315_create_clients_table',3),('2014_12_12_214138_create_services_table',3),('2014_12_12_223710_create_tickets_table',4),('2014_12_12_223932_create_ticket_reply_table',4),('2015_01_03_025239_create_attachements_table',5),('2015_01_08_220653_confide_setup_users_table',6),('2015_01_09_024952_create_mileagetracker',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mileage_tracker`
--

DROP TABLE IF EXISTS `mileage_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mileage_tracker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `odometer_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `odometer_finish` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filling_up` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fuel_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_per_litre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `litres_purchased` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_fuel_cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `travel_reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `travel_origin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `travel_destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `travel_comments` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mileage_attachement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `log_datetime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mileage_tracker`
--

LOCK TABLES `mileage_tracker` WRITE;
/*!40000 ALTER TABLE `mileage_tracker` DISABLE KEYS */;
INSERT INTO `mileage_tracker` VALUES (18,'36707','36707','No','0','','','','End of Day','Matthew\'s House','Charles\' House','Return home after dropping off Matt from service call at Salamanders.','','',1,'2015-01-09 11:13:22','2015-01-09 11:13:22',NULL),(19,'36762','36781','No','0','','','','Start of Day','Charles\' House','First Service Call','','','',1,'2015-01-09 11:14:24','2015-01-09 11:14:24',NULL),(20,'36782','36863','No','0','','','','Service Call','Service Call 1','Service Call 2, dropping off laptop','check in on network at doctors office included (less than a kilometer away from each other.','','',1,'2015-01-09 11:16:00','2015-01-09 11:16:00',NULL),(21,'36966','36972','No','0','','','','End of Day','Third Service Call','Charles\' House','','','',1,'2015-01-09 11:18:00','2015-01-09 11:18:00',NULL),(22,'36972','37072','No','0','','','','Start of Day','Home','The Door Company','Roads were a pain in the ass, took longer.','','',1,'2015-01-10 08:16:34','2015-01-10 08:16:34',NULL),(23,'37072','37108','No','0','','','','Service Call','The Door Company','Kemptville Medical Center','','','',1,'2015-01-10 08:17:30','2015-01-10 08:17:30',NULL),(24,'37108','37113','No','0','','','','Service Call','Kemptville Medical Center','Janet Boehmer\'s house','','','',1,'2015-01-10 08:18:05','2015-01-10 08:18:05',NULL),(25,'37113','37118','No','Half Full','','','','End of Day','Janet Boehmers Home','Home','Tank slightly under half','','',1,'2015-01-10 08:19:21','2015-01-10 08:19:21',NULL),(27,'37118','37123','No','4','','','','Start of Day','Home','Service Call 1, french settlement road','','','',1,'2015-01-12 02:17:53','2015-01-12 02:17:53',NULL),(28,'37123','37149','No','4','','','','Service Call','Service Call 1, French Settlement Road','Service Call 2, Craig Road','Had to leave call 1 early to make call 2, call one was in the middle of a drive copy and was estimated to take some time anyway.','','',1,'2015-01-12 02:19:57','2015-01-12 02:19:57',NULL),(29,'37149','37168','No','3','','','','Service Call','Craig Road','`French Settlement Road','Returning to the first call after the second to finalize.','','',1,'2015-01-12 02:22:22','2015-01-12 02:22:22',NULL),(30,'37168','37173','No','3','','','','Service Call','Service Call 1, French Settlement Road','Service Call 3, Pine Hill Road','','','',1,'2015-01-12 02:23:30','2015-01-12 02:23:30',NULL),(31,'37173','37174','No','3','','','','Service Call','Service Call 3, Pine Hill Road','Home','returning home from final service call','','',1,'2015-01-12 02:24:46','2015-01-12 02:24:46',NULL),(32,'37174','37188','No','2','','','','Personal Use','Home','Home','Driving around doing groceries and errands at the end of the day.','','',1,'2015-01-12 02:25:42','2015-01-12 02:25:42',NULL),(33,'37188','37189','No','2','','','','Start of Day','Home','Service Cal 1, Vista Crescent','','','',1,'2015-01-12 02:26:49','2015-01-12 02:26:49',NULL),(34,'37189','37192','No','2','','','','Service Call','Service Call 1, Vista Crescent','Home','small detour included to get coffee.','','',1,'2015-01-12 02:28:11','2015-01-12 02:28:11',NULL),(35,'37192','37195','No','2','','','','Personal Use','Home','Tim Hortons','Driving spencer to work.','','',1,'2015-01-12 02:28:40','2015-01-12 02:28:40',NULL),(36,'37195','37198','No','2','','','','Personal Use','Tim Hortons','Home','When I got home from dropping off spencer at work.','','',1,'2015-01-12 02:29:14','2015-01-12 02:29:14',NULL),(37,'37198','37200','No','2','','','','Personal Use','Home','Tim Hortons','Dropping spencers phone off at work.','','',1,'2015-01-12 03:08:01','2015-01-12 03:08:01',NULL),(38,'37200','37202','Yes','10','82.3','30.16','25','Filling Up Car','Tim hortons','Stinsons Gas Station in Kemptville','Noticed tank was getting low, decided to fill before a day of service calls tomorrow.','','',1,'2015-01-12 03:09:37','2015-01-12 03:09:37',NULL),(39,'37202','37203','No','10','','','','Personal Use','Stinsons gas station','Home','','','',1,'2015-01-12 03:10:12','2015-01-12 03:10:12',NULL),(41,'37203','37206','No','10','','','','End of Day','Tim Hortons','Home','','','01/11/2015 8:57 PM',1,'2015-01-12 23:09:24','2015-01-12 23:09:24',NULL),(42,'37206','37211','No','10','','','','Start of Day','Home','Service call pat babin','','/uploads/mileagetracker/Sw1Wxw_IMG_20150112_091333.jpg','01/12/2015 9:15 AM',1,'2015-01-12 23:11:04','2015-01-12 23:11:04',NULL),(43,'37211','37213','No','10','','','','Start of Day','Service call 1, pat babin','Home','','/uploads/mileagetracker/ZxWGLr_IMG_20150112_100754.jpg','01/12/2015 10:09 AM',1,'2015-01-12 23:12:53','2015-01-12 23:12:53',NULL),(44,'37213','37214','No','10','','','','Service Call','Home','Designer consignor downtown kemptville ','Showed up for service call,  customer forgot.  Rescheduled for tomorrow. ','/uploads/mileagetracker/AwACFE_IMG_20150112_105829.jpg','01/12/2015 11:00 AM',1,'2015-01-12 23:14:41','2015-01-12 23:14:41',NULL),(45,'37214','37215','No','10','','','','Service Call','Bevs store','Home','','/uploads/mileagetracker/AZyooT_IMG_20150112_125716.jpg','01/12/2015 12:59 PM',1,'2015-01-13 05:34:04','2015-01-13 05:34:04',NULL),(46,'37215','37216','No','10','','','','Service Call','Home','Service call at elliot Street ','','/uploads/mileagetracker/IDd0Ky_IMG_20150112_134317.jpg','01/12/2015 1:45 PM',1,'2015-01-13 05:35:28','2015-01-13 05:35:28',NULL),(47,'37216','37218','No','10','','','','Personal Use','Service call on ellioy','Subway','Going to get lunch','/uploads/mileagetracker/VuyPsd_IMG_20150112_140009.jpg','01/12/2015 2:01 PM',1,'2015-01-13 05:37:04','2015-01-13 05:37:04',NULL),(48,'37218','37223','No','10','','','','Service Call','Subway ','Claire doyle house on dr Gordon Crescent ','','/uploads/mileagetracker/ZSfch4_IMG_20150112_143506.jpg','01/12/2015 2:36 PM',1,'2015-01-13 05:38:33','2015-01-13 05:38:33',NULL),(49,'37223','37225','No','10','','','','Service Call','Service call on dr Gordon Crescent ','North grenville public library ','Emergency call','','01/12/2015 2:45 PM',1,'2015-01-13 05:40:24','2015-01-13 05:40:24',NULL),(50,'37225','37228','No','10','','','','End of Day','North grenville public library ','Home','','','01/12/2015 3:00 PM',1,'2015-01-13 05:42:16','2015-01-13 05:42:16',NULL),(51,'37228','37231','No','10','','','','Personal Use','Home','Home','Driving spencer to and from haircut ','/uploads/mileagetracker/lF9YUc_IMG_20150112_165443.jpg','01/12/2015 4:43 PM',1,'2015-01-13 05:43:49','2015-01-13 05:43:49',NULL),(52,'37231','37232','No','10','','','','Start of Day','Home','Downtown kemptville ','Travel for both service calls 1 and 2 they are right next to each other. ','/uploads/mileagetracker/mFLXru_IMG_20150113_120831.jpg','01/13/2015 10:30 AM',1,'2015-01-14 03:30:52','2015-01-14 03:30:52',NULL),(53,'37232','37269','No','9','','','','Service Call','Downtown kemptville ','The Door Company','','/uploads/mileagetracker/4tHLow_IMG_20150113_140940.jpg','01/14/2015 12:48 PM',1,'2015-01-14 03:32:11','2015-01-14 03:32:11',NULL),(54,'37269','37296','No','9','','','','Service Call','The Door Company','Thompsons in osgoode','','/uploads/mileagetracker/UvjREf_IMG_20150113_143306.jpg','01/13/2015 2:34 PM',1,'2015-01-14 03:33:46','2015-01-14 03:33:46',NULL),(55,'37296','37315','No','8','','','','End of Day','Thompsons in Osgoode','Home','','/uploads/mileagetracker/ClCPgy_IMG_20150113_153517.jpg','01/13/2015 3:37 PM',1,'2015-01-14 03:36:24','2015-01-14 03:36:24',NULL),(56,'37315','37316','No','8','','','','Other','Home','Home','Getting mail','/uploads/mileagetracker/MFvZ3e_IMG_20150113_153838.jpg','01/13/2015 4:36 PM',1,'2015-01-14 03:37:36','2015-01-14 03:37:36',NULL),(57,'37316','37319','No','8','','','','Personal Use','Home','Home','Getting coffee ','/uploads/mileagetracker/pqSrZb_IMG_20150113_161735.jpg','01/13/2015 3:40 PM',1,'2015-01-14 03:38:47','2015-01-14 03:38:47',NULL),(58,'37319','37344','No','8','','','','Personal Use','Home','Home','Getting coffee and picking spencer up. ','/uploads/mileagetracker/VH4Bjf_IMG_20150113_231249.jpg','01/13/2015 11:14 PM',1,'2015-01-15 10:40:24','2015-01-15 10:40:24',NULL),(59,'37344','37347','No','7','','','','Service Call','Home','North grenville public library ','Got coffee as well','/uploads/mileagetracker/gYJn1O_IMG_20150114_130017.jpg','01/14/2015 1:01 PM',1,'2015-01-15 10:47:59','2015-01-15 10:47:59',NULL),(60,'37347','37348','No','7','','','','Start of Day','North grenville public library ','Home ','','/uploads/mileagetracker/lddXOp_IMG_20150114_130417.jpg','01/15/2015 1:05 PM',1,'2015-01-15 10:49:33','2015-01-15 10:49:33',NULL),(61,'37348','37384','No','6','','','','Service Call','Home','The Door Company','','/uploads/mileagetracker/eKLvtM_IMG_20150114_142006.jpg','01/15/2015 2:21 PM',1,'2015-01-15 10:50:53','2015-01-15 10:50:53',NULL),(62,'37348','37420','No','6','','','','Service Call','The Door Company','Home','','/uploads/mileagetracker/tfLFlU_IMG_20150114_150819.jpg','01/15/2015 3:10 PM',1,'2015-01-15 10:52:24','2015-01-15 10:52:24',NULL),(63,'37420','37420','No','6','','','','Service Call','Home','5pm service call address ','','','01/15/2015 4:56 PM',1,'2015-01-15 10:54:22','2015-01-20 04:36:34',NULL);
/*!40000 ALTER TABLE `mileage_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reminders`
--

DROP TABLE IF EXISTS `password_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reminders`
--

LOCK TABLES `password_reminders` WRITE;
/*!40000 ALTER TABLE `password_reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reminder_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reminder_body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reminder_alarm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reminder_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('c8a347c4fb6f157bed34d50201e47e27e232f938','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMmVwOHNxUElmV1h2Y1ppb3RHMmVNMU54RHVzQWpMVUlKTkNlc2V2SiI7czozOiJ1cmwiO2E6MDp7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO2k6MTtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQyMTg2NTY5MTtzOjE6ImMiO2k6MTQyMTg2Mzk3NztzOjE6ImwiO3M6MToiMCI7fX0=',1421865691);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_reply`
--

DROP TABLE IF EXISTS `ticket_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_reply_subject` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_reply_body` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_reply`
--

LOCK TABLES `ticket_reply` WRITE;
/*!40000 ALTER TABLE `ticket_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_subject` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_body` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_client_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_class_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Open','Closed','Resolved','Other','Pending') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Matthew','mattdavidf@gmail.com','$2y$10$Z9BhqwfBmWO5eJPby8abvOJa5gUmGsOGjARGkxTklyhruHrSxVQOS','c682e513b6d51fabbd664b1ebed4d744','K0rJgqA736EOTbiNg8kLrhNubhQMx59eChAfOgW9qamN9x8syZgW1tSm7GxB',1,'2015-01-09 03:08:46','2015-01-21 04:09:26'),(2,'RDBRULZ','clambton29@gmail.com','$2y$10$dc4PYRcxd3QSu5efWtvFs.ZIiJZ6U5UvskH9gBNsqpInYh6b8ip8K','1eb26cca61f8cf15840a45452c525e1b','Klz87zMRrnbew3T9VdrHOdUamzUqscZVBMpoMDp4jdLyZWrkelbz61zQFCXo',1,'2015-01-09 10:59:38','2015-01-09 11:02:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_license_plate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_make_model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_attachment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'Charles R Lambton','BPCP 549','Toyota Prius C','2013','','2015-01-10 17:00:00','2015-01-10 17:00:00');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-21 13:41:33
