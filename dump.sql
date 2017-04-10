-- MySQL dump 10.14  Distrib 5.5.50-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: CS3380GRP23
-- ------------------------------------------------------
-- Server version	5.5.50-MariaDB

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
-- Table structure for table `Administrator`
--

DROP TABLE IF EXISTS `Administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Administrator` (
  `Admin_Role` tinyint(1) DEFAULT NULL,
  `Emp_ID` int(6) NOT NULL,
  `Emp_Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  KEY `Emp_ID` (`Emp_ID`),
  CONSTRAINT `Administrator_ibfk_1` FOREIGN KEY (`Emp_ID`) REFERENCES `Employee` (`Emp_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Administrator`
--

LOCK TABLES `Administrator` WRITE;
/*!40000 ALTER TABLE `Administrator` DISABLE KEYS */;
INSERT INTO `Administrator` VALUES (1,0,'Admin');
/*!40000 ALTER TABLE `Administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Certifications`
--

DROP TABLE IF EXISTS `Certifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Certifications` (
  `Emp_ID` int(11) NOT NULL,
  `Equip_Serial` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Emp_ID`,`Equip_Serial`),
  KEY `Equip_Serial` (`Equip_Serial`),
  CONSTRAINT `Certifications_ibfk_1` FOREIGN KEY (`Emp_ID`) REFERENCES `Pilot` (`Emp_ID`),
  CONSTRAINT `Certifications_ibfk_2` FOREIGN KEY (`Equip_Serial`) REFERENCES `Equipment` (`Equip_Serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Certifications`
--

LOCK TABLES `Certifications` WRITE;
/*!40000 ALTER TABLE `Certifications` DISABLE KEYS */;
INSERT INTO `Certifications` VALUES (123492,'N10998'),(123492,'N3847'),(123492,'N55521'),(123492,'N77837');
/*!40000 ALTER TABLE `Certifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customer`
--

DROP TABLE IF EXISTS `Customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customer` (
  `Cust_ID` int(11) NOT NULL DEFAULT '0',
  `Cust_First_Name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cust_Last_Name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cust_Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`Cust_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customer`
--

LOCK TABLES `Customer` WRITE;
/*!40000 ALTER TABLE `Customer` DISABLE KEYS */;
INSERT INTO `Customer` VALUES (313,'Ryan','Tedder',37),(3348,NULL,NULL,NULL),(6555,NULL,NULL,NULL),(8102,NULL,NULL,NULL),(8191,NULL,NULL,NULL),(8356,NULL,NULL,NULL),(8536,NULL,NULL,NULL),(9740,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Employee`
--

DROP TABLE IF EXISTS `Employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Employee` (
  `Emp_ID` int(6) NOT NULL,
  `Emp_Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Emp_Type` int(1) NOT NULL,
  `Emp_fname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Emp_lname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Emp_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (0,'Admin',0,'Paul','McCartney'),(111980,'12345678',2,'Hillary','Trump'),(123492,'12345678',1,'Mary','Seneca'),(388929,'12345678',1,'Sue','Grumman'),(483792,'12345678',1,'John','Piper'),(485932,'12345678',2,'Donald','Clinton'),(776573,'12345678',2,'Janet','Johnson'),(887362,'12345678',1,'Mark','Northrup');
/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Equipment`
--

DROP TABLE IF EXISTS `Equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Equipment` (
  `Equip_Num` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Equip_Name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Equip_Serial` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Equip_Pilots_Req` int(11) DEFAULT NULL,
  `Equip_Att_Req` int(11) DEFAULT NULL,
  `Equip_Seating` int(11) DEFAULT NULL,
  PRIMARY KEY (`Equip_Serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipment`
--

LOCK TABLES `Equipment` WRITE;
/*!40000 ALTER TABLE `Equipment` DISABLE KEYS */;
INSERT INTO `Equipment` VALUES ('N354','PeeBoy','H28K',1,1,3),('DC9','Douglas 9','N10998',1,2,150),('B737','Boeing 737','N21094',2,3,180),('A380','Airbus 380','N3029',2,3,290),('B747','Boeing 747','N3847',2,3,300),('A250','Airbus 250','N55521',2,3,175),('B727','Boeing','N5674',2,3,150),('A380','Airbus 380','N77837',2,3,290),('MD80','McDonnell 80','N77994',2,2,190);
/*!40000 ALTER TABLE `Equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Flight_Assign`
--

DROP TABLE IF EXISTS `Flight_Assign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Flight_Assign` (
  `Emp_ID` int(6) NOT NULL DEFAULT '0',
  `Fli_Num` int(11) NOT NULL,
  PRIMARY KEY (`Emp_ID`,`Fli_Num`),
  KEY `Fli_Num` (`Fli_Num`),
  CONSTRAINT `Flight_Assign_ibfk_1` FOREIGN KEY (`Emp_ID`) REFERENCES `Employee` (`Emp_ID`),
  CONSTRAINT `Flight_Assign_ibfk_2` FOREIGN KEY (`Fli_Num`) REFERENCES `Flights` (`Fli_Num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Flight_Assign`
--

LOCK TABLES `Flight_Assign` WRITE;
/*!40000 ALTER TABLE `Flight_Assign` DISABLE KEYS */;
/*!40000 ALTER TABLE `Flight_Assign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Flight_Att`
--

DROP TABLE IF EXISTS `Flight_Att`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Flight_Att` (
  `Att_Rank` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Emp_ID` int(6) NOT NULL,
  `Emp_Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Att_Hours` int(11) DEFAULT NULL,
  `Att_Status` int(1) DEFAULT NULL,
  KEY `Emp_ID` (`Emp_ID`),
  CONSTRAINT `Flight_Att_ibfk_1` FOREIGN KEY (`Emp_ID`) REFERENCES `Employee` (`Emp_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Flight_Att`
--

LOCK TABLES `Flight_Att` WRITE;
/*!40000 ALTER TABLE `Flight_Att` DISABLE KEYS */;
INSERT INTO `Flight_Att` VALUES ('Senior',776573,'12345678',7654,1),('Senior',111980,'12345678',13101,1),('Senior',485932,'12345678',8876,1);
/*!40000 ALTER TABLE `Flight_Att` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Flights`
--

DROP TABLE IF EXISTS `Flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Flights` (
  `Fli_Num` int(11) NOT NULL,
  `Fli_Dep_Time` time DEFAULT NULL,
  `Fli_Dep_Date` date DEFAULT NULL,
  `Fli_Availibility` tinyint(1) DEFAULT NULL,
  `Fli_Price` decimal(6,2) DEFAULT NULL,
  `Fli_Dep_City` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fli_Arr_City` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Equip_Serial` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fli_Arr_Time` time DEFAULT NULL,
  PRIMARY KEY (`Fli_Num`),
  KEY `Equip_Serial` (`Equip_Serial`),
  CONSTRAINT `Flights_ibfk_1` FOREIGN KEY (`Equip_Serial`) REFERENCES `Equipment` (`Equip_Serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Flights`
--

LOCK TABLES `Flights` WRITE;
/*!40000 ALTER TABLE `Flights` DISABLE KEYS */;
INSERT INTO `Flights` VALUES (1,'13:00:00','2016-01-01',0,130.00,'Abilene','Boston','N55521','15:00:00'),(2,'17:00:00','2006-03-13',1,180.00,'Austin','Cambridge','N55521','21:00:00'),(3,'15:00:00','1995-12-08',1,9999.00,'Saint','Columbia','N77837','17:30:00'),(454,'07:00:00','2016-11-19',0,1129.00,'Dallas','Paris','N3029','17:30:00'),(1234,'08:00:00','2016-08-19',1,100.00,'Sacremento','Chicago','N3029','09:30:00'),(1235,'01:00:00','2016-05-12',0,140.00,'Abilene','Albany','N77837','03:00:00');
/*!40000 ALTER TABLE `Flights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Log`
--

DROP TABLE IF EXISTS `Log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Log` (
  `Log_Num` int(11) NOT NULL AUTO_INCREMENT,
  `Log_IP_Address` int(11) NOT NULL,
  `Log_Date` date NOT NULL,
  `Log_Time` time NOT NULL,
  `Log_Action` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Log_User` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cust_ID` int(11) DEFAULT NULL,
  `Emp_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Log_Num`),
  KEY `Cust_ID` (`Cust_ID`),
  KEY `Emp_ID` (`Emp_ID`),
  CONSTRAINT `Log_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `Customer` (`Cust_ID`),
  CONSTRAINT `Log_ibfk_2` FOREIGN KEY (`Emp_ID`) REFERENCES `Employee` (`Emp_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Log`
--

LOCK TABLES `Log` WRITE;
/*!40000 ALTER TABLE `Log` DISABLE KEYS */;
INSERT INTO `Log` VALUES (2,24217,'2016-11-22','19:47:24','LOGIN','CUSTOMER',313,NULL),(3,24217,'2016-11-22','19:48:26','LOGIN','CUSTOMER',313,NULL),(4,24217,'2016-11-23','03:50:27','LOGIN','CUSTOMER',313,NULL),(5,24217,'2016-11-22','21:51:44','LOGIN','CUSTOMER',313,NULL),(6,24217,'2016-11-22','21:58:42','PROFILE UPDATE','CUSTOMER',313,NULL),(7,128206,'2016-11-23','09:24:01','LOGIN','CUSTOMER',313,NULL),(8,9791,'2016-11-23','10:32:15','NEW CUSTOMER MADE','CUSTOMER',3348,NULL),(9,9791,'2016-11-23','10:32:15','RESERVATION MADE','CUSTOMER',3348,NULL),(10,107,'2016-11-23','11:51:54','LOGIN','CUSTOMER',313,NULL),(12,107212,'2016-11-23','15:05:53','LOGIN','CUSTOMER',313,NULL),(13,107212,'2016-11-23','16:07:38','PROFILE UPDATE','CUSTOMER',313,NULL),(14,107212,'2016-11-23','16:15:29','PROFILE UPDATE','CUSTOMER',313,NULL),(15,107212,'2016-11-23','16:17:10','PROFILE UPDATE','CUSTOMER',313,NULL),(16,107212,'2016-11-23','16:17:31','PROFILE UPDATE','CUSTOMER',313,NULL),(17,107212,'2016-11-23','16:23:09','LOGIN','CUSTOMER',313,NULL),(18,107212,'2016-11-23','16:23:11','LOGOUT','CUSTOMER',313,NULL),(20,107212,'2016-11-23','16:42:25','LOGOUT','EMPLOYEE',NULL,123492),(21,107212,'2016-11-23','16:42:40','LOGIN','PILOT',NULL,123492),(22,107212,'2016-11-23','16:42:50','LOGOUT','EMPLOYEE',NULL,123492),(28,9791,'2016-11-23','20:19:00','LOGOUT','EMPLOYEE',NULL,0),(30,9791,'2016-11-23','20:21:43','LOGOUT','EMPLOYEE',NULL,0),(32,9791,'2016-11-23','20:22:55','LOGOUT','EMPLOYEE',NULL,0),(33,9791,'2016-11-23','20:22:59','LOGIN','ADMIN',NULL,0),(35,9791,'2016-11-23','20:24:00','LOGIN','ADMIN',NULL,0),(37,9791,'2016-11-23','20:26:11','LOGIN','ADMIN',NULL,0),(38,9791,'2016-11-24','01:21:12','LOGOUT','ADMIN',NULL,0),(39,9791,'2016-11-24','01:21:46','LOGIN','ADMIN',NULL,0),(40,9791,'2016-11-24','01:22:02','LOGOUT','ADMIN',NULL,0),(41,9791,'2016-11-24','01:22:08','LOGIN','PILOT',NULL,123492),(42,9791,'2016-11-24','01:23:08','LOGOUT','PILOT',NULL,123492),(43,9791,'2016-11-24','01:23:11','LOGIN','ADMIN',NULL,0),(44,76253,'2016-11-24','13:26:03','NEW CUSTOMER MADE','CUSTOMER',9740,NULL),(45,76253,'2016-11-24','13:26:03','RESERVATION MADE','CUSTOMER',9740,NULL),(46,76253,'2016-11-24','13:27:30','RESERVATION MADE','CUSTOMER',9740,NULL),(47,76253,'2016-11-24','13:27:47','LOGOUT','CUSTOMER',9740,NULL),(48,76253,'2016-11-24','13:28:05','LOGIN','ADMIN',NULL,0),(49,76253,'2016-11-24','13:29:42','LOGOUT','ADMIN',NULL,0),(50,76253,'2016-11-24','13:29:53','LOGIN','PILOT',NULL,123492),(51,9791,'2016-11-24','15:59:36','LOGIN','ADMIN',NULL,0),(52,107212,'2016-11-24','17:06:58','LOGIN','ADMIN',NULL,0),(53,107212,'2016-11-24','17:21:58','LOGOUT','ADMIN',NULL,0),(54,107212,'2016-11-24','17:22:39','LOGIN','CUSTOMER',313,NULL),(55,107212,'2016-11-24','17:23:06','RESERVATION MADE','CUSTOMER',313,NULL),(56,107212,'2016-11-24','18:28:25','LOGOUT','CUSTOMER',313,NULL),(58,107212,'2016-11-24','18:28:59','LOGOUT','ADMIN',NULL,0),(59,9791,'2016-11-25','02:00:40','LOGIN','ADMIN',NULL,0),(60,9791,'2016-11-25','02:08:38','LOGOUT','ADMIN',NULL,0),(61,9791,'2016-11-25','02:10:54','LOGIN','ADMIN',NULL,0),(62,13663,'2016-11-25','11:50:11','NEW CUSTOMER MADE','CUSTOMER',8536,NULL),(63,13663,'2016-11-25','11:50:11','RESERVATION MADE','CUSTOMER',8536,NULL),(64,13663,'2016-11-25','11:50:20','LOGOUT','CUSTOMER',8536,NULL),(65,13663,'2016-11-25','11:50:41','RESERVATION MADE','CUSTOMER',8536,NULL),(66,13663,'2016-11-25','11:51:43','LOGOUT','CUSTOMER',8536,NULL),(67,13663,'2016-11-25','11:51:58','NEW CUSTOMER MADE','CUSTOMER',8191,NULL),(68,13663,'2016-11-25','11:51:58','RESERVATION MADE','CUSTOMER',8191,NULL),(69,13663,'2016-11-25','12:02:29','LOGOUT','CUSTOMER',8191,NULL),(70,13663,'2016-11-25','12:02:36','LOGIN','CUSTOMER',8191,NULL),(71,13663,'2016-11-25','12:02:54','LOGOUT','CUSTOMER',8191,NULL),(72,13663,'2016-11-25','12:03:21','LOGIN','CUSTOMER',8191,NULL),(73,13663,'2016-11-25','13:07:12','LOGOUT','CUSTOMER',8191,NULL),(74,13663,'2016-11-25','13:07:21','LOGIN','ADMIN',NULL,0),(75,6745,'2016-11-25','16:32:24','LOGIN','ADMIN',NULL,0),(76,6745,'2016-11-25','16:32:41','LOGOUT','ADMIN',NULL,0),(77,6745,'2016-11-25','16:36:08','LOGIN','ADMIN',NULL,0),(78,6745,'2016-11-25','16:52:10','LOGOUT','ADMIN',NULL,0),(79,6745,'2016-11-25','16:52:15','LOGIN','PILOT',NULL,123492),(80,6745,'2016-11-25','16:53:17','LOGOUT','PILOT',NULL,123492),(81,6745,'2016-11-25','17:01:43','LOGIN','ADMIN',NULL,0),(82,24217,'2016-11-25','18:32:22','LOGIN','ADMIN',NULL,0),(83,6686,'2016-11-27','21:14:29','LOGIN','CUSTOMER',313,NULL),(84,6686,'2016-11-27','21:53:08','LOGIN','CUSTOMER',313,NULL),(85,6686,'2016-11-27','21:54:25','LOGIN','CUSTOMER',313,NULL);
/*!40000 ALTER TABLE `Log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pilot`
--

DROP TABLE IF EXISTS `Pilot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pilot` (
  `Emp_ID` int(6) NOT NULL,
  `Emp_Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pil_Status` int(1) NOT NULL,
  `Pil_Hours` int(11) DEFAULT NULL,
  `Pil_Rank` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `Emp_ID` (`Emp_ID`),
  CONSTRAINT `Pilot_ibfk_1` FOREIGN KEY (`Emp_ID`) REFERENCES `Employee` (`Emp_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pilot`
--

LOCK TABLES `Pilot` WRITE;
/*!40000 ALTER TABLE `Pilot` DISABLE KEYS */;
INSERT INTO `Pilot` VALUES (388929,'12345678',0,14799,'Captain'),(483792,'12345678',0,11870,'First Officer'),(887362,'12345678',1,21226,'Senior Captain'),(123492,'12345678',1,19433,'Senior Captain');
/*!40000 ALTER TABLE `Pilot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reservations`
--

DROP TABLE IF EXISTS `Reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reservations` (
  `Res_Day` date DEFAULT NULL,
  `Res_Num_Baggage` int(11) NOT NULL DEFAULT '0',
  `Cust_ID` int(11) NOT NULL,
  `Fli_Num` int(11) NOT NULL,
  `Res_Num` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Cust_ID`,`Fli_Num`,`Res_Num`),
  KEY `Fli_Num` (`Fli_Num`),
  CONSTRAINT `Reservations_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `Customer` (`Cust_ID`),
  CONSTRAINT `Reservations_ibfk_2` FOREIGN KEY (`Fli_Num`) REFERENCES `Flights` (`Fli_Num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservations`
--

LOCK TABLES `Reservations` WRITE;
/*!40000 ALTER TABLE `Reservations` DISABLE KEYS */;
INSERT INTO `Reservations` VALUES (NULL,2,313,454,'\'GYXH28\''),(NULL,2,313,1234,'BWS3XZ'),(NULL,2,313,1234,'YWVFCD'),(NULL,2,3348,454,'8CHJA9'),(NULL,2,6555,454,'LEP3SM'),(NULL,2,8102,1234,'KWQR39'),(NULL,2,8191,3,'ZNL6LC'),(NULL,1,8356,454,'\'BWHZTN\''),(NULL,2,8536,2,'MXVIO3'),(NULL,3,8536,1234,'8AA71W'),(NULL,0,9740,1234,'9YDKSV'),(NULL,0,9740,1235,'JF6OQ4');
/*!40000 ALTER TABLE `Reservations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-27 23:32:45
