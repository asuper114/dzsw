-- MySQL dump 10.13  Distrib 5.5.34, for Win32 (x86)
--
-- Host: localhost    Database: dzsw
-- ------------------------------------------------------
-- Server version	5.5.34

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
-- Table structure for table `dzsw_address_book`
--

DROP TABLE IF EXISTS `dzsw_address_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_address_book` (
  `abid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL DEFAULT '',
  `street_address` varchar(64) NOT NULL DEFAULT '',
  `suburb` varchar(32) DEFAULT NULL,
  `postcode` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `city` varchar(32) NOT NULL DEFAULT '',
  `province` varchar(32) DEFAULT NULL,
  `country` varchar(32) NOT NULL DEFAULT '0',
  `tel_regular` varchar(32) NOT NULL DEFAULT '',
  `tel_mobile` varchar(32) NOT NULL DEFAULT '',
  `qq` varchar(15) NOT NULL DEFAULT '',
  `msn` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`abid`),
  KEY `idx_ab_cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_address_book`
--

LOCK TABLES `dzsw_address_book` WRITE;
/*!40000 ALTER TABLE `dzsw_address_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_address_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_admingroups`
--

DROP TABLE IF EXISTS `dzsw_admingroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_admingroups` (
  `admingroupsid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `classes` enum('admin','operator') NOT NULL DEFAULT 'admin',
  `grouptitle` varchar(30) NOT NULL DEFAULT '',
  `allow_class_see` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_class_edit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_class_add` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_class_delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_product_see` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_product_edit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_product_add` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_product_delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_order_see` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_customer_see` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_customer_edit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_customer_add` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_customer_delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_news_edit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_news_add` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_news_delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_gbook_edit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_gbook_delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_gbook_reply` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_links_edit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_links_add` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_links_delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_sendmail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_orderstatus` varchar(200) NOT NULL DEFAULT '',
  `allow_orderstatus_g` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`admingroupsid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_admingroups`
--

LOCK TABLES `dzsw_admingroups` WRITE;
/*!40000 ALTER TABLE `dzsw_admingroups` DISABLE KEYS */;
INSERT INTO `dzsw_admingroups` VALUES (1,'admin','',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'noauditing,auditing,waitforpay,partpay,allpay,makesurepay,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,over,getexchange,payback','noauditing,auditing,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,allpay,makesurepay,over,getexchange,payback'),(2,'operator','',0,1,1,1,0,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,'noauditing,auditing,waitforpay,partpay,allpay,makesurepay,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,over,getexchange,payback','noauditing,auditing,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,allpay,makesurepay,over,getexchange,payback'),(3,'operator','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'waitforpay,partpay,allpay,makesurepay,payback','makesurepay,payback'),(4,'operator','',0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'getexchange','getexchange'),(5,'operator','',0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,'shipping,waitforsend,partsend,allsend,sendsuccess,sendfail','shipping,waitforsend,allsend,sendsuccess,sendfail,allpay'),(6,'operator','',0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'noauditing,auditing,cancel,over','noauditing,auditing,cancel,over');
/*!40000 ALTER TABLE `dzsw_admingroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_admins`
--

DROP TABLE IF EXISTS `dzsw_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_admins` (
  `adminid` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(96) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `admingroupsid` smallint(4) unsigned NOT NULL DEFAULT '0',
  `createdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_admins`
--

LOCK TABLES `dzsw_admins` WRITE;
/*!40000 ALTER TABLE `dzsw_admins` DISABLE KEYS */;
INSERT INTO `dzsw_admins` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e',1,1460476913,1460476913);
/*!40000 ALTER TABLE `dzsw_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_area`
--

DROP TABLE IF EXISTS `dzsw_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_area` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinytext NOT NULL,
  `parentid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=407 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_area`
--

LOCK TABLES `dzsw_area` WRITE;
/*!40000 ALTER TABLE `dzsw_area` DISABLE KEYS */;
INSERT INTO `dzsw_area` VALUES (1,'0',0,''),(2,'1',1,''),(3,'2',2,''),(4,'2',2,''),(5,'2',2,''),(6,'2',2,''),(7,'2',2,''),(8,'2',2,''),(9,'2',2,''),(10,'2',2,''),(11,'2',2,''),(12,'2',2,''),(13,'2',2,''),(14,'2',2,''),(15,'2',2,''),(16,'2',2,'ͭ'),(17,'2',2,''),(18,'2',2,''),(19,'2',2,''),(20,'1',1,''),(21,'2',20,''),(22,'2',20,''),(23,'1',1,''),(24,'2',23,''),(25,'2',23,''),(26,'2',23,''),(27,'2',23,''),(28,'2',23,''),(29,'2',23,'Ȫ'),(30,'2',23,''),(31,'2',23,''),(32,'2',23,''),(33,'1',1,''),(34,'2',33,''),(35,'2',33,''),(36,'2',33,''),(37,'2',33,''),(38,'2',33,''),(39,'2',33,''),(40,'2',33,''),(41,'2',33,''),(42,'2',33,'¤'),(43,'2',33,'ƽ'),(44,'2',33,''),(45,'2',33,''),(46,'2',33,''),(47,'2',33,''),(48,'1',1,''),(49,'2',48,''),(50,'2',48,''),(51,'2',48,''),(52,'2',48,''),(53,'2',48,''),(54,'2',48,''),(55,'2',48,''),(56,'2',48,''),(57,'2',48,'ï'),(58,'2',48,'÷'),(59,'2',48,''),(60,'2',48,''),(61,'2',48,''),(62,'2',48,''),(63,'2',48,''),(64,'2',48,''),(65,'2',48,''),(66,'2',48,'տ'),(67,'2',48,''),(68,'2',48,''),(69,'2',48,''),(70,'1',1,''),(71,'2',70,''),(72,'2',70,''),(73,'2',70,''),(74,'2',70,''),(75,'2',70,''),(76,'2',70,''),(77,'2',70,''),(78,'2',70,''),(79,'2',70,''),(80,'2',70,''),(81,'2',70,''),(82,'2',70,''),(83,'2',70,''),(84,'2',70,''),(85,'1',1,''),(86,'2',85,''),(87,'2',85,''),(88,'2',85,''),(89,'2',85,''),(90,'2',85,'ǭ'),(91,'2',85,'ǭ'),(92,'2',85,'ǭ'),(93,'2',85,'ͭ'),(94,'2',85,''),(95,'1',1,''),(96,'2',95,''),(97,'2',95,''),(98,'2',95,''),(99,'2',95,''),(100,'2',95,''),(101,'2',95,''),(102,'2',95,''),(103,'2',95,''),(104,'2',95,''),(105,'2',95,''),(106,'2',95,''),(107,'2',95,''),(108,'2',95,''),(109,'2',95,''),(110,'2',95,''),(111,'2',95,''),(112,'2',95,''),(113,'2',95,''),(114,'1',1,''),(115,'2',114,''),(116,'2',114,''),(117,'2',114,''),(118,'2',114,''),(119,'2',114,''),(120,'2',114,''),(121,'2',114,''),(122,'2',114,'ʯ'),(123,'2',114,''),(124,'2',114,''),(125,'2',114,''),(126,'1',1,''),(127,'2',126,''),(128,'2',126,''),(129,'2',126,''),(130,'2',126,''),(131,'2',126,''),(132,'2',126,''),(133,'2',126,''),(134,'2',126,'ƽ'),(135,'2',126,''),(136,'2',126,''),(137,'2',126,''),(138,'2',126,''),(139,'2',126,''),(140,'2',126,'֣'),(141,'2',126,''),(142,'2',126,'פ'),(143,'2',126,''),(144,'2',126,''),(145,'1',1,''),(146,'2',145,''),(147,'2',145,''),(148,'2',145,''),(149,'2',145,''),(150,'2',145,''),(151,'2',145,''),(152,'2',145,''),(153,'2',145,'ĵ'),(154,'2',145,''),(155,'2',145,''),(156,'2',145,'˫Ѽɽ'),(157,'2',145,''),(158,'2',145,''),(159,'1',1,''),(160,'2',159,''),(161,'2',159,''),(162,'2',159,''),(163,'2',159,''),(164,'2',159,''),(165,'2',159,''),(166,'2',159,'Ǳ'),(167,'2',159,''),(168,'2',159,'ʮ'),(169,'2',159,''),(170,'2',159,''),(171,'2',159,''),(172,'2',159,''),(173,'2',159,''),(174,'2',159,''),(175,'2',159,'Т'),(176,'2',159,''),(177,'1',1,''),(178,'2',177,''),(179,'2',177,''),(180,'2',177,''),(181,'2',177,''),(182,'2',177,''),(183,'2',177,'¦'),(184,'2',177,''),(185,'2',177,''),(186,'2',177,''),(187,'2',177,''),(188,'2',177,''),(189,'2',177,''),(190,'2',177,''),(191,'2',177,''),(192,'1',1,''),(193,'2',192,''),(194,'2',192,''),(195,'2',192,''),(196,'2',192,''),(197,'2',192,''),(198,'2',192,''),(199,'2',192,''),(200,'2',192,'ͨ'),(201,'2',192,''),(202,'1',1,''),(203,'2',202,''),(204,'2',202,''),(205,'2',202,''),(206,'2',202,''),(207,'2',202,''),(208,'2',202,''),(209,'2',202,''),(210,'2',202,'̩'),(211,'2',202,''),(212,'2',202,''),(213,'2',202,''),(214,'2',202,''),(215,'2',202,''),(216,'1',1,''),(217,'2',216,''),(218,'2',216,''),(219,'2',216,''),(220,'2',216,''),(221,'2',216,''),(222,'2',216,''),(223,'2',216,'Ƽ'),(224,'2',216,''),(225,'2',216,''),(226,'2',216,''),(227,'2',216,'ӥ̶'),(228,'1',1,''),(229,'2',228,''),(230,'2',228,''),(231,'2',228,''),(232,'2',228,''),(233,'2',228,''),(234,'2',228,''),(235,'2',228,''),(236,'2',228,''),(237,'2',228,''),(238,'2',228,''),(239,'2',228,''),(240,'2',228,''),(241,'2',228,''),(242,'2',228,'Ӫ'),(243,'1',1,''),(244,'2',243,''),(245,'2',243,''),(246,'2',243,''),(247,'2',243,''),(248,'2',243,''),(249,'2',243,''),(250,'2',243,''),(251,'2',243,'ͨ'),(252,'2',243,''),(253,'2',243,''),(254,'2',243,''),(255,'2',243,''),(256,'1',1,''),(257,'2',256,''),(258,'2',256,'ʯ'),(259,'2',256,''),(260,'2',256,''),(261,'1',1,''),(262,'2',261,''),(263,'2',261,''),(264,'2',261,''),(265,'2',261,''),(266,'2',261,''),(267,'2',261,''),(268,'2',261,''),(269,'2',261,''),(270,'1',1,'ɽ'),(271,'2',270,''),(272,'2',270,''),(273,'2',270,''),(274,'2',270,''),(275,'2',270,''),(276,'2',270,''),(277,'2',270,''),(278,'2',270,''),(279,'2',270,''),(280,'2',270,''),(281,'2',270,''),(282,'2',270,'̩'),(283,'2',270,''),(284,'2',270,'Ϋ'),(285,'2',270,''),(286,'2',270,''),(287,'2',270,''),(288,'1',1,'ɽ'),(289,'2',288,''),(290,'2',288,''),(291,'2',288,''),(292,'2',288,''),(293,'2',288,''),(294,'2',288,''),(295,'2',288,'˷'),(296,'2',288,'̫ԭ'),(297,'2',288,''),(298,'2',288,''),(299,'2',288,''),(300,'1',1,''),(301,'2',300,''),(302,'2',300,''),(303,'2',300,''),(304,'2',300,''),(305,'2',300,'ͭ'),(306,'2',300,'μ'),(307,'2',300,''),(308,'2',300,''),(309,'2',300,''),(310,'2',300,''),(311,'1',1,''),(312,'2',311,''),(313,'2',311,''),(314,'1',1,''),(315,'2',314,''),(316,'2',314,''),(317,'2',314,''),(318,'2',314,''),(319,'2',314,''),(320,'2',314,''),(321,'2',314,''),(322,'2',314,''),(323,'2',314,''),(324,'2',314,''),(325,'2',314,'üɽ'),(326,'2',314,''),(327,'2',314,''),(328,'2',314,''),(329,'2',314,''),(330,'2',314,''),(331,'2',314,''),(332,'2',314,''),(333,'2',314,''),(334,'2',314,''),(335,'2',314,''),(336,'1',1,''),(337,'2',336,''),(338,'2',336,''),(339,'1',1,''),(340,'2',339,''),(341,'2',339,''),(342,'2',339,''),(343,'2',339,''),(344,'2',339,''),(345,'2',339,''),(346,'2',339,'ɽ'),(347,'1',1,''),(348,'2',347,''),(349,'2',347,''),(350,'2',347,''),(351,'2',347,''),(352,'2',347,''),(353,'2',347,''),(354,'2',347,''),(355,'2',347,''),(356,'2',347,''),(357,'2',347,''),(358,'2',347,'ʯ'),(359,'2',347,'ͼľ'),(360,'2',347,''),(361,'2',347,''),(362,'2',347,''),(363,'2',347,''),(364,'1',1,''),(365,'2',364,''),(366,'2',364,''),(367,'2',364,''),(368,'2',364,''),(369,'2',364,''),(370,'2',364,''),(371,'2',364,''),(372,'2',364,''),(373,'2',364,''),(374,'2',364,'ŭ'),(375,'2',364,''),(376,'2',364,'˼é'),(377,'2',364,''),(378,'2',364,''),(379,'2',364,''),(380,'2',364,''),(381,'1',1,''),(382,'2',381,''),(383,'2',381,''),(384,'2',381,''),(385,'2',381,''),(386,'2',381,''),(387,'2',381,''),(388,'2',381,''),(389,'2',381,'̨'),(390,'2',381,''),(391,'2',381,''),(392,'2',381,''),(393,'1',1,''),(394,'2',393,''),(395,'2',393,''),(396,'1',1,''),(397,'2',396,''),(398,'2',396,''),(399,'1',1,'̨'),(400,'2',399,'̨'),(401,'0',0,''),(402,'1',401,''),(403,'2',402,''),(404,'0',0,''),(405,'1',404,''),(406,'2',405,'');
/*!40000 ALTER TABLE `dzsw_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_classes`
--

DROP TABLE IF EXISTS `dzsw_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_classes` (
  `classes_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `classes` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(100) NOT NULL DEFAULT '',
  `parent_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `showinheader` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`classes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_classes`
--

LOCK TABLES `dzsw_classes` WRITE;
/*!40000 ALTER TABLE `dzsw_classes` DISABLE KEYS */;
INSERT INTO `dzsw_classes` VALUES (3,2,'二级分类2',9,1,1,5),(5,2,'二级分类3',9,34,1,7),(9,1,'分类1',0,0,1,0),(10,2,'二级分类1',9,0,1,0),(11,3,'三级分类1',3,0,1,0);
/*!40000 ALTER TABLE `dzsw_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_customers`
--

DROP TABLE IF EXISTS `dzsw_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_customers` (
  `customers_id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(96) NOT NULL DEFAULT '',
  `groupid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `shipto` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `billto` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `deli_s_bill` tinyint(1) NOT NULL DEFAULT '1',
  `shipping_method` varchar(32) NOT NULL DEFAULT '0',
  `payment_method` varchar(32) NOT NULL DEFAULT '0',
  `password` varchar(40) NOT NULL DEFAULT '',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `order_total` smallint(6) unsigned NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `credit` int(11) NOT NULL DEFAULT '0',
  `money` decimal(15,2) NOT NULL DEFAULT '0.00',
  `qq` varchar(20) NOT NULL DEFAULT '',
  `msn` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`customers_id`),
  UNIQUE KEY `email_address` (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_customers`
--

LOCK TABLES `dzsw_customers` WRITE;
/*!40000 ALTER TABLE `dzsw_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_gbook`
--

DROP TABLE IF EXISTS `dzsw_gbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_gbook` (
  `gid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `date_added` int(10) unsigned NOT NULL DEFAULT '0',
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_gbook`
--

LOCK TABLES `dzsw_gbook` WRITE;
/*!40000 ALTER TABLE `dzsw_gbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_gbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_gbookreply`
--

DROP TABLE IF EXISTS `dzsw_gbookreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_gbookreply` (
  `grid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `adminid` mediumint(8) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `date_added` int(10) unsigned NOT NULL DEFAULT '0',
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`grid`),
  UNIQUE KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_gbookreply`
--

LOCK TABLES `dzsw_gbookreply` WRITE;
/*!40000 ALTER TABLE `dzsw_gbookreply` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_gbookreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_links`
--

DROP TABLE IF EXISTS `dzsw_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_links` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `ordernum` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `logo` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_links`
--

LOCK TABLES `dzsw_links` WRITE;
/*!40000 ALTER TABLE `dzsw_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_lossremark`
--

DROP TABLE IF EXISTS `dzsw_lossremark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_lossremark` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL DEFAULT '',
  `product_name` varchar(200) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date_add` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_lossremark`
--

LOCK TABLES `dzsw_lossremark` WRITE;
/*!40000 ALTER TABLE `dzsw_lossremark` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_lossremark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_news`
--

DROP TABLE IF EXISTS `dzsw_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_news` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL DEFAULT '',
  `editer` varchar(100) NOT NULL DEFAULT '',
  `date_add` int(10) unsigned NOT NULL DEFAULT '0',
  `last_edit` int(10) unsigned NOT NULL DEFAULT '0',
  `text` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_news`
--

LOCK TABLES `dzsw_news` WRITE;
/*!40000 ALTER TABLE `dzsw_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_orders`
--

DROP TABLE IF EXISTS `dzsw_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_orders` (
  `orders_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `c_email` varchar(64) NOT NULL DEFAULT '',
  `d_name` varchar(64) NOT NULL DEFAULT '',
  `d_street_address` varchar(160) NOT NULL DEFAULT '',
  `d_suburb` varchar(32) NOT NULL DEFAULT '',
  `d_city` varchar(32) NOT NULL DEFAULT '',
  `d_postcode` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `d_tel_regular` varchar(32) NOT NULL DEFAULT '',
  `d_tel_mobile` varchar(32) NOT NULL DEFAULT '',
  `d_qq` varchar(20) NOT NULL DEFAULT '',
  `d_msn` varchar(100) NOT NULL DEFAULT '',
  `d_province` varchar(32) NOT NULL DEFAULT '',
  `d_country` varchar(32) NOT NULL DEFAULT '',
  `b_name` varchar(64) NOT NULL DEFAULT '',
  `b_street_address` varchar(160) NOT NULL DEFAULT '',
  `b_suburb` varchar(32) NOT NULL DEFAULT '',
  `b_city` varchar(32) NOT NULL DEFAULT '',
  `b_postcode` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `b_province` varchar(32) NOT NULL DEFAULT '',
  `b_country` varchar(32) NOT NULL DEFAULT '',
  `b_tel_mobile` varchar(32) NOT NULL DEFAULT '',
  `b_tel_regular` varchar(32) NOT NULL DEFAULT '',
  `b_qq` varchar(20) NOT NULL DEFAULT '',
  `b_msn` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `deli_s_bill` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  `date_purchased` int(10) unsigned NOT NULL DEFAULT '0',
  `ordersd_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `orders_date_finished` int(10) unsigned NOT NULL DEFAULT '0',
  `payment_method` varchar(32) NOT NULL DEFAULT '',
  `shipping_method` varchar(32) NOT NULL DEFAULT '',
  `do_mark` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orders_status` varchar(100) NOT NULL DEFAULT 'noauditing',
  PRIMARY KEY (`orders_id`),
  KEY `c_id` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_orders`
--

LOCK TABLES `dzsw_orders` WRITE;
/*!40000 ALTER TABLE `dzsw_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_orders_history`
--

DROP TABLE IF EXISTS `dzsw_orders_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_orders_history` (
  `ohid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(10) unsigned NOT NULL DEFAULT '0',
  `orders_status` varchar(100) NOT NULL DEFAULT 'noauditing',
  `date_added` int(10) unsigned NOT NULL DEFAULT '0',
  `notified` tinyint(1) unsigned DEFAULT '0',
  `operator` varchar(150) DEFAULT NULL,
  `total_mark` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paidnum` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `paid_type` char(1) NOT NULL DEFAULT '',
  `payment_type` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`ohid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_orders_history`
--

LOCK TABLES `dzsw_orders_history` WRITE;
/*!40000 ALTER TABLE `dzsw_orders_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_orders_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_orders_products`
--

DROP TABLE IF EXISTS `dzsw_orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_orders_products` (
  `opid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(10) unsigned NOT NULL DEFAULT '0',
  `products_id` int(10) unsigned NOT NULL DEFAULT '0',
  `model` varchar(32) DEFAULT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `final_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `quantity` smallint(6) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`opid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_orders_products`
--

LOCK TABLES `dzsw_orders_products` WRITE;
/*!40000 ALTER TABLE `dzsw_orders_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_orders_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_orders_total`
--

DROP TABLE IF EXISTS `dzsw_orders_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_orders_total` (
  `otid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `value` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `classes` enum('product','shipping','total','leaverpay','mustpay','paid','othor') NOT NULL DEFAULT 'product',
  PRIMARY KEY (`otid`),
  KEY `idx_otid_oid` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_orders_total`
--

LOCK TABLES `dzsw_orders_total` WRITE;
/*!40000 ALTER TABLE `dzsw_orders_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_orders_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_payback`
--

DROP TABLE IF EXISTS `dzsw_payback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_payback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL DEFAULT '0',
  `payreturn` varchar(100) NOT NULL DEFAULT '',
  `payback` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `cartnum` varchar(100) NOT NULL DEFAULT '',
  `bankname` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_payback`
--

LOCK TABLES `dzsw_payback` WRITE;
/*!40000 ALTER TABLE `dzsw_payback` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_payback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_payment`
--

DROP TABLE IF EXISTS `dzsw_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `pay_key` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` tinyint(3) NOT NULL DEFAULT '0',
  `showchild` tinyint(1) NOT NULL DEFAULT '1',
  `type` enum('system','define') NOT NULL DEFAULT 'system',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pay_key` (`pay_key`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_payment`
--

LOCK TABLES `dzsw_payment` WRITE;
/*!40000 ALTER TABLE `dzsw_payment` DISABLE KEYS */;
INSERT INTO `dzsw_payment` VALUES (1,0,'goodsarrivepay','','',1,0,0,'system'),(2,0,'postpay','','',1,1,1,'system'),(3,0,'banktransfer','','',1,2,0,'system'),(4,0,'online','','',1,3,0,'system'),(5,4,'westpay','','',1,0,1,'system'),(6,4,'chinabank','','',1,0,1,'system'),(7,3,'construction','','',1,0,1,'system'),(9,4,'alipay','֧','֧',1,0,1,'system'),(20,3,'icbc','','',1,0,1,'system'),(21,3,'merchants','','',1,0,1,'system');
/*!40000 ALTER TABLE `dzsw_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_payment_a`
--

DROP TABLE IF EXISTS `dzsw_payment_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_payment_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `pakey` varchar(200) NOT NULL DEFAULT '',
  `pvalue` text NOT NULL,
  `sort_order` tinyint(3) NOT NULL DEFAULT '0',
  `type` enum('system','define') NOT NULL DEFAULT 'system',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_payment_a`
--

LOCK TABLES `dzsw_payment_a` WRITE;
/*!40000 ALTER TABLE `dzsw_payment_a` DISABLE KEYS */;
INSERT INTO `dzsw_payment_a` VALUES (2,5,'','account','www.soobic.com',0,'system'),(3,7,'','cartnum','1234 5678 1234 1234 567',1,'system'),(4,7,'','manname','dzsw',2,'system'),(6,2,'','address','*****************',1,'system'),(7,2,'','postcode','100000',2,'system'),(8,2,'','manname','dzsw',3,'system'),(9,9,'','account','dzsw@dzsw.com',0,'system'),(10,9,'','safenum','ib8no1mg1l6rk1khkeetw8nvsngs7fdu',0,'system'),(14,6,'','v_mid','41383',0,'system'),(15,6,'','style','0',0,'system'),(17,6,'','v_moneytype','0',0,'system'),(18,6,'','md5key','chinabank353638773',0,'system'),(30,20,'','cartnum','1234 5678 1234 1234 567',0,'define'),(31,20,'','manname','dzsw',0,'define'),(34,21,'','cartnum','1234 5678 1234 1234 567',0,'define'),(35,21,'','manname','dzsw',0,'define');
/*!40000 ALTER TABLE `dzsw_payment_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_products`
--

DROP TABLE IF EXISTS `dzsw_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_products` (
  `products_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `classes_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type22` enum('common','specials','good') NOT NULL DEFAULT 'common',
  `name` varchar(64) NOT NULL DEFAULT '',
  `quantity` smallint(6) unsigned NOT NULL DEFAULT '0',
  `model` varchar(12) NOT NULL DEFAULT '',
  `image` mediumint(8) NOT NULL DEFAULT '0',
  `price` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `s_p` enum('2','1','0') NOT NULL DEFAULT '0',
  `weight` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `available` enum('1','0') NOT NULL DEFAULT '1',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `base_info` text NOT NULL,
  `description` text NOT NULL,
  `manufacturer` varchar(200) NOT NULL DEFAULT '',
  `mid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `ordered` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `viewed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date_added` int(10) unsigned NOT NULL DEFAULT '0',
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`products_id`),
  KEY `s_pa` (`s_p`,`available`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_products`
--

LOCK TABLES `dzsw_products` WRITE;
/*!40000 ALTER TABLE `dzsw_products` DISABLE KEYS */;
INSERT INTO `dzsw_products` VALUES (8,0,'common','测试1',10,'v1.6.0',28,24.00,'1',0.50,'1','1','','<P>Ĭ','dzsw',0,107,224,1136186718,1460561021),(21,0,'common','测试产品2',10,'v1.6.0',0,24.00,'0',0.50,'1','1','','<P>Ĭ','dzsw',0,0,0,1146443307,1460561054);
/*!40000 ALTER TABLE `dzsw_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_ptoc`
--

DROP TABLE IF EXISTS `dzsw_ptoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_ptoc` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) NOT NULL DEFAULT '0',
  `cid` mediumint(8) NOT NULL DEFAULT '0',
  `dateadd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_ptoc`
--

LOCK TABLES `dzsw_ptoc` WRITE;
/*!40000 ALTER TABLE `dzsw_ptoc` DISABLE KEYS */;
INSERT INTO `dzsw_ptoc` VALUES (5,7,3,1136186745),(26,8,3,1146443195),(27,8,5,1146443204),(28,21,5,1146443307),(29,21,3,1146443372);
/*!40000 ALTER TABLE `dzsw_ptoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_reviews`
--

DROP TABLE IF EXISTS `dzsw_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_reviews` (
  `rid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `products_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(128) NOT NULL DEFAULT '',
  `review` text NOT NULL,
  `rating` tinyint(1) unsigned DEFAULT '1',
  `date_added` int(10) unsigned NOT NULL DEFAULT '0',
  `last_modified` int(10) unsigned NOT NULL DEFAULT '0',
  `viewed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_reviews`
--

LOCK TABLES `dzsw_reviews` WRITE;
/*!40000 ALTER TABLE `dzsw_reviews` DISABLE KEYS */;
INSERT INTO `dzsw_reviews` VALUES (1,8,'','Ĭ',5,1142309502,1142309502,0),(2,8,'','Ĭ',4,1142309517,1142309517,0);
/*!40000 ALTER TABLE `dzsw_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_settings`
--

DROP TABLE IF EXISTS `dzsw_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_settings` (
  `settings_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `settings_key` varchar(64) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `set_function` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`settings_id`),
  UNIQUE KEY `settings_key` (`settings_key`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_settings`
--

LOCK TABLES `dzsw_settings` WRITE;
/*!40000 ALTER TABLE `dzsw_settings` DISABLE KEYS */;
INSERT INTO `dzsw_settings` VALUES (1,'store_version','V1.0',0,0,''),(2,'default_discount','9.2',6,0,''),(3,'store_name','电子商城',1,1,''),(4,'storeurl','',1,3,''),(5,'server_email','',1,5,''),(6,'server_tel','010 - 123456',1,7,''),(7,'server_address','*********************',1,9,''),(8,'server_postcode','434000',1,11,''),(9,'server_manname','dzsw',1,13,''),(10,'gzip_compression','false',2,1,'settings_radio(array(\'true\', \'false\'),'),(11,'display_pageparseinfo','false',2,3,'settings_radio(array(\'true\', \'false\'),'),(12,'stock_check','true',2,5,'settings_radio(array(\'true\', \'false\'),'),(13,'stock_limitshow','true',2,7,'settings_radio(array(\'true\', \'false\'),'),(14,'create_smallimage','false',2,9,'settings_radio(array(\'true\', \'false\'),'),(15,'orders_savetime','200',2,11,''),(16,'user_checknum_inheader','true',2,13,'settings_radio(array(\'true\', \'false\'),'),(17,'user_checknum_infooter','false',2,15,'settings_radio(array(\'true\', \'false\'),'),(18,'sendmail_createorder','false',3,1,'settings_radio(array(\'true\', \'false\'),'),(19,'sendmail_createaccount','true',3,3,'settings_radio(array(\'true\', \'false\'),'),(20,'email_adminer','',3,5,''),(21,'email_from','',3,7,''),(22,'email_transport','sendmail',3,9,'settings_radio(array(\'sendmail\', \'smtp\', \'other\'),'),(23,'email_smtp_host','mail.yoursite.com',3,11,''),(24,'email_smtp_port','25',3,13,''),(25,'email_othor_host','smtp.163.com',3,14,''),(26,'email_othor_port','25',3,15,''),(27,'email_othor_auth','true',3,17,'settings_radio(array(\'true\', \'false\'),'),(28,'email_othor_username','account',3,19,''),(29,'email_othor_password','password',3,21,''),(30,'store_style','1',4,1,'settings_styles('),(31,'stock_limitsign','***',4,3,''),(32,'index_new_productid','',4,5,''),(33,'index_s_productid','',4,7,''),(34,'header_classnum','10',4,9,''),(35,'date_format','Y-m-d',4,11,''),(36,'time_ofset','0',4,13,''),(37,'show_country','true',4,15,'settings_radio(array(\'true\', \'false\'),'),(38,'country_default','1',4,17,'settings_country_default('),(39,'show_qq','true',4,19,'settings_radio(array(\'true\', \'false\'),'),(40,'show_msn','true',4,21,'settings_radio(array(\'true\', \'false\'),'),(41,'smallimage_width','138',5,1,''),(43,'smallimage_width2','150',5,11,''),(44,'reviews_shownum','10',5,15,''),(45,'index_productnumarow','5',5,17,''),(46,'index_newproductnumofrow','3',5,19,''),(47,'index_sproductnumofrow','1',5,29,''),(49,'index_newsshownum','4',5,37,''),(50,'productlist_numofrow','16',5,39,''),(51,'gbook_numofrow','16',5,59,''),(52,'customer_mark','true',6,1,'settings_radio(array(\'true\', \'false\'),'),(53,'nt_tomark','10',6,3,''),(54,'user_leavepay','true',6,5,'settings_radio(array(\'true\', \'false\'),'),(56,'renzheng_code','',0,0,''),(58,'email_othor_from','',3,18,''),(59,'sendmail_cancelorder','true',3,2,'settings_radio(array(\'true\', \'false\'),'),(60,'picture_savepath','default',2,0,''),(61,'user_lossremark','true',6,66,'settings_radio(array(\'true\', \'false\'),'),(62,'seo_title','',7,1,''),(63,'seo_keywords','',7,6,''),(64,'seo_othor','',7,8,''),(65,'seo_description','',7,7,'');
/*!40000 ALTER TABLE `dzsw_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_shipping`
--

DROP TABLE IF EXISTS `dzsw_shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_shipping` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL DEFAULT '',
  `type` enum('system','define') NOT NULL DEFAULT 'system',
  `areatype` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `sortorder` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `desc_faq` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_shipping`
--

LOCK TABLES `dzsw_shipping` WRITE;
/*!40000 ALTER TABLE `dzsw_shipping` DISABLE KEYS */;
INSERT INTO `dzsw_shipping` VALUES (1,'goodsself','system',2,'','Ŀǰ',1,1,''),(2,'commonpost','system',1,'','',2,1,''),(3,'quick','system',1,'','',3,1,''),(4,'chinapostems','system',1,'','',4,1,'');
/*!40000 ALTER TABLE `dzsw_shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_shipping_fee`
--

DROP TABLE IF EXISTS `dzsw_shipping_fee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_shipping_fee` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `shippingid` tinytext NOT NULL,
  `area` text NOT NULL,
  `fee` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_shipping_fee`
--

LOCK TABLES `dzsw_shipping_fee` WRITE;
/*!40000 ALTER TABLE `dzsw_shipping_fee` DISABLE KEYS */;
INSERT INTO `dzsw_shipping_fee` VALUES (1,'1','21,22','8'),(13,'4','2,20,23,33,48,70,85,95,114,126,159,177,202,216,228,243,256,261,270,288,300,311,314,336,364,381,393','0.5:0.5:20:6'),(14,'4','192,339,145','0.5:0.5:20:9'),(16,'3','314,85','1:5:0.5:9:4:2'),(17,'4','347','0.5:0.5:20:15'),(22,'1','171','6'),(26,'3','126','1:5:0.5:6:2.5:1.5'),(27,'3','300,33,256,216,159','1:5:0.5:8:3.5:2'),(28,'3','20,114,336,288','1:5:0.5:5:2:1'),(29,'3','243,270,228','1:5:0.5:6:2.5:1.2'),(30,'3','202,311,2,192','1:5:0.5:7:2.6:1.5'),(31,'3','381,177','1:5:0.5:8:3.5:2'),(32,'3','23,261,95,70,48','1:5:0.5:10:4.5:2.5'),(33,'3','145','1:5:0.5:7:3:1.8'),(34,'3','347,339,364','1:5:0.5:12:6:3.5'),(35,'4','396','0.5:0.5:20:30'),(36,'4','399','0.5:0.5:20:40'),(37,'4','401,404','0.5:0.5:20:45'),(38,'3','396','1:5:0.5:25:15:10'),(39,'3','399','1:5:0.5:30:15:10'),(40,'2','300,33,256,216,159','2.5'),(41,'2','314,85','3.8'),(42,'2','126','1.6'),(43,'2','20,114,336,288','0.7'),(44,'2','243,270,228','1.3'),(45,'2','202,311,2,192','2'),(46,'2','381,177','2.8'),(47,'2','23,261,95,70,48','4'),(48,'2','347,339,364','5.1'),(49,'2','145','2.6'),(50,'2','396','6'),(51,'2','399','7');
/*!40000 ALTER TABLE `dzsw_shipping_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_source`
--

DROP TABLE IF EXISTS `dzsw_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_source` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('1','0') NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `extension` varchar(10) NOT NULL DEFAULT '',
  `path` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `pid` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `dateadd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_source`
--

LOCK TABLES `dzsw_source` WRITE;
/*!40000 ALTER TABLE `dzsw_source` DISABLE KEYS */;
/*!40000 ALTER TABLE `dzsw_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_specials`
--

DROP TABLE IF EXISTS `dzsw_specials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_specials` (
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `s_price` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_specials`
--

LOCK TABLES `dzsw_specials` WRITE;
/*!40000 ALTER TABLE `dzsw_specials` DISABLE KEYS */;
INSERT INTO `dzsw_specials` VALUES (8,1.00,0);
/*!40000 ALTER TABLE `dzsw_specials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_styles`
--

DROP TABLE IF EXISTS `dzsw_styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_styles` (
  `styleid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(22) NOT NULL DEFAULT '',
  `tid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `imagedir` varchar(100) NOT NULL DEFAULT '',
  `cssfilename` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`styleid`),
  KEY `themename` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_styles`
--

LOCK TABLES `dzsw_styles` WRITE;
/*!40000 ALTER TABLE `dzsw_styles` DISABLE KEYS */;
INSERT INTO `dzsw_styles` VALUES (1,'Default',1,'images/default','default.css');
/*!40000 ALTER TABLE `dzsw_styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_templates`
--

DROP TABLE IF EXISTS `dzsw_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_templates` (
  `tid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL DEFAULT '',
  `directory` varchar(100) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_templates`
--

LOCK TABLES `dzsw_templates` WRITE;
/*!40000 ALTER TABLE `dzsw_templates` DISABLE KEYS */;
INSERT INTO `dzsw_templates` VALUES (1,'Default','default','');
/*!40000 ALTER TABLE `dzsw_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzsw_usergroups`
--

DROP TABLE IF EXISTS `dzsw_usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzsw_usergroups` (
  `groupid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `classes` enum('Guest','Member','Specials') NOT NULL DEFAULT 'Member',
  `grouptitle` varchar(30) NOT NULL DEFAULT '',
  `creditshigher` int(10) NOT NULL DEFAULT '0',
  `creditslower` int(10) NOT NULL DEFAULT '0',
  `groupdiscount` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`),
  KEY `status` (`classes`),
  KEY `creditshigher` (`creditshigher`),
  KEY `creditslower` (`creditslower`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzsw_usergroups`
--

LOCK TABLES `dzsw_usergroups` WRITE;
/*!40000 ALTER TABLE `dzsw_usergroups` DISABLE KEYS */;
INSERT INTO `dzsw_usergroups` VALUES (1,'Guest','',0,0,10),(2,'Member','',0,999,9.2),(3,'Member','',1000,2999,9),(4,'Member','',3000,9999,8.5),(5,'Specials','VIP',0,0,8);
/*!40000 ALTER TABLE `dzsw_usergroups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-15  0:20:57
