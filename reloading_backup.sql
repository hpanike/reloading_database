-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: reloading
-- ------------------------------------------------------
-- Server version	5.5.40-0+wheezy1

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
-- Table structure for table `Brush`
--

DROP TABLE IF EXISTS `Brush`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Brush` (
  `brush_id` int(11) NOT NULL AUTO_INCREMENT,
  `caliber` float DEFAULT NULL,
  `thread` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `handle` int(11) DEFAULT NULL,
  PRIMARY KEY (`brush_id`),
  KEY `handle` (`handle`),
  CONSTRAINT `Brush_ibfk_1` FOREIGN KEY (`handle`) REFERENCES `Handle` (`handle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Brush`
--

LOCK TABLES `Brush` WRITE;
/*!40000 ALTER TABLE `Brush` DISABLE KEYS */;
/*!40000 ALTER TABLE `Brush` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bullet`
--

DROP TABLE IF EXISTS `Bullet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bullet` (
  `bullet_id` int(11) NOT NULL AUTO_INCREMENT,
  `bullet_name` varchar(255) DEFAULT NULL,
  `caliber` float DEFAULT NULL,
  `bullet_type` varchar(255) DEFAULT NULL,
  `manufacture` varchar(255) DEFAULT NULL,
  `grain` int(11) DEFAULT NULL,
  `ballistic_coefficient` float DEFAULT NULL,
  `cost_per_bullet` float DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bullet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bullet`
--

LOCK TABLES `Bullet` WRITE;
/*!40000 ALTER TABLE `Bullet` DISABLE KEYS */;
INSERT INTO `Bullet` VALUES (1,'SMK BTHP 168',0.308,'BTHP','SMK',168,0.462,0.35,100,'Copper - Lead');
/*!40000 ALTER TABLE `Bullet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cartridge`
--

DROP TABLE IF EXISTS `Cartridge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cartridge` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `year_created` int(11) DEFAULT NULL,
  `average_cost` float DEFAULT NULL,
  `availability` char(4) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cartridge`
--

LOCK TABLES `Cartridge` WRITE;
/*!40000 ALTER TABLE `Cartridge` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cartridge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Casing`
--

DROP TABLE IF EXISTS `Casing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Casing` (
  `casing_id` int(11) NOT NULL AUTO_INCREMENT,
  `casing_name` varchar(255) DEFAULT NULL,
  `caliber` float DEFAULT NULL,
  `wall_thickness` float DEFAULT NULL,
  `use_expectancy` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `cost_per_casing` float DEFAULT NULL,
  `pocket_size` char(4) DEFAULT NULL,
  PRIMARY KEY (`casing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Casing`
--

LOCK TABLES `Casing` WRITE;
/*!40000 ALTER TABLE `Casing` DISABLE KEYS */;
INSERT INTO `Casing` VALUES (1,'.308 Winchester',0.308,NULL,5,100,0.35,'LR');
/*!40000 ALTER TABLE `Casing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Casing_Trimmer`
--

DROP TABLE IF EXISTS `Casing_Trimmer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Casing_Trimmer` (
  `casing_trimmer_id` int(11) NOT NULL AUTO_INCREMENT,
  `casing_trimmer_type` char(4) DEFAULT NULL,
  PRIMARY KEY (`casing_trimmer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Casing_Trimmer`
--

LOCK TABLES `Casing_Trimmer` WRITE;
/*!40000 ALTER TABLE `Casing_Trimmer` DISABLE KEYS */;
/*!40000 ALTER TABLE `Casing_Trimmer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cleaning_Solution`
--

DROP TABLE IF EXISTS `Cleaning_Solution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cleaning_Solution` (
  `solution_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacture` varchar(255) DEFAULT NULL,
  `formula` varchar(255) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `ultrasonic_cleaner` int(11) DEFAULT NULL,
  PRIMARY KEY (`solution_id`),
  KEY `ultrasonic_cleaner` (`ultrasonic_cleaner`),
  CONSTRAINT `Cleaning_Solution_ibfk_1` FOREIGN KEY (`ultrasonic_cleaner`) REFERENCES `Ultrasonic_Cleaner` (`ultrasonic_cleaner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cleaning_Solution`
--

LOCK TABLES `Cleaning_Solution` WRITE;
/*!40000 ALTER TABLE `Cleaning_Solution` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cleaning_Solution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Die`
--

DROP TABLE IF EXISTS `Die`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Die` (
  `die_id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` char(4) DEFAULT NULL,
  `manufacture` varchar(255) DEFAULT NULL,
  `die_type` varchar(255) DEFAULT NULL,
  `caliber` float DEFAULT NULL,
  `press` int(11) DEFAULT NULL,
  PRIMARY KEY (`die_id`),
  KEY `press` (`press`),
  CONSTRAINT `Die_ibfk_1` FOREIGN KEY (`press`) REFERENCES `Press` (`press_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Die`
--

LOCK TABLES `Die` WRITE;
/*!40000 ALTER TABLE `Die` DISABLE KEYS */;
/*!40000 ALTER TABLE `Die` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Hand_Primer`
--

DROP TABLE IF EXISTS `Hand_Primer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Hand_Primer` (
  `manufacture` varchar(255) NOT NULL,
  PRIMARY KEY (`manufacture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Hand_Primer`
--

LOCK TABLES `Hand_Primer` WRITE;
/*!40000 ALTER TABLE `Hand_Primer` DISABLE KEYS */;
/*!40000 ALTER TABLE `Hand_Primer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Handle`
--

DROP TABLE IF EXISTS `Handle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Handle` (
  `handle_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacture` varchar(255) DEFAULT NULL,
  `thread` varchar(255) NOT NULL,
  PRIMARY KEY (`handle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Handle`
--

LOCK TABLES `Handle` WRITE;
/*!40000 ALTER TABLE `Handle` DISABLE KEYS */;
/*!40000 ALTER TABLE `Handle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pocket_Cleaner`
--

DROP TABLE IF EXISTS `Pocket_Cleaner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pocket_Cleaner` (
  `pocket_cleaner_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacture` varchar(255) DEFAULT NULL,
  `pocket_cleaner_size` char(4) DEFAULT NULL,
  `pocket_cleaner_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pocket_cleaner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pocket_Cleaner`
--

LOCK TABLES `Pocket_Cleaner` WRITE;
/*!40000 ALTER TABLE `Pocket_Cleaner` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pocket_Cleaner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Powder`
--

DROP TABLE IF EXISTS `Powder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Powder` (
  `powder_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `powder_type` varchar(255) DEFAULT NULL,
  `burn_rate` varchar(255) DEFAULT NULL,
  `quantity_in_grains` float DEFAULT NULL,
  `cost_per_grain` float DEFAULT NULL,
  PRIMARY KEY (`powder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Powder`
--

LOCK TABLES `Powder` WRITE;
/*!40000 ALTER TABLE `Powder` DISABLE KEYS */;
INSERT INTO `Powder` VALUES (1,'IMR 4096','Non Magnum','Medium',7006.13,0.0658);
/*!40000 ALTER TABLE `Powder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Powder_Dispenser`
--

DROP TABLE IF EXISTS `Powder_Dispenser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Powder_Dispenser` (
  `powder_dispenser_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacture` varchar(255) DEFAULT NULL,
  `pdispenser_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`powder_dispenser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Powder_Dispenser`
--

LOCK TABLES `Powder_Dispenser` WRITE;
/*!40000 ALTER TABLE `Powder_Dispenser` DISABLE KEYS */;
/*!40000 ALTER TABLE `Powder_Dispenser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Press`
--

DROP TABLE IF EXISTS `Press`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Press` (
  `press_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacture` varchar(255) DEFAULT NULL,
  `production_rate` int(11) DEFAULT NULL,
  `press_type` char(4) DEFAULT NULL,
  `thread` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`press_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Press`
--

LOCK TABLES `Press` WRITE;
/*!40000 ALTER TABLE `Press` DISABLE KEYS */;
/*!40000 ALTER TABLE `Press` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Primer`
--

DROP TABLE IF EXISTS `Primer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Primer` (
  `primer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `manufacture` varchar(255) DEFAULT NULL,
  `primer_size` char(4) DEFAULT NULL,
  `quanity` int(11) DEFAULT NULL,
  `cost_per_primer` float DEFAULT NULL,
  PRIMARY KEY (`primer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Primer`
--

LOCK TABLES `Primer` WRITE;
/*!40000 ALTER TABLE `Primer` DISABLE KEYS */;
INSERT INTO `Primer` VALUES (1,'CCI 200','CCI','LR',1000,0.028);
/*!40000 ALTER TABLE `Primer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Recipe`
--

DROP TABLE IF EXISTS `Recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Recipe` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(255) DEFAULT NULL,
  `bullet` int(11) DEFAULT NULL,
  `powder` int(11) DEFAULT NULL,
  `powder_amount_in_grains` float DEFAULT NULL,
  `casing` int(11) DEFAULT NULL,
  `primer` int(11) DEFAULT NULL,
  `ballistic_data` varchar(255) DEFAULT NULL,
  `cost_per_bullet` float DEFAULT NULL,
  `amount_available` int(11) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `powder` (`powder`),
  KEY `casing` (`casing`),
  KEY `primer` (`primer`),
  KEY `bullet` (`bullet`),
  CONSTRAINT `Recipe_ibfk_1` FOREIGN KEY (`powder`) REFERENCES `Powder` (`powder_id`),
  CONSTRAINT `Recipe_ibfk_2` FOREIGN KEY (`casing`) REFERENCES `Casing` (`casing_id`),
  CONSTRAINT `Recipe_ibfk_3` FOREIGN KEY (`primer`) REFERENCES `Primer` (`primer_id`),
  CONSTRAINT `Recipe_ibfk_4` FOREIGN KEY (`bullet`) REFERENCES `Bullet` (`bullet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Recipe`
--

LOCK TABLES `Recipe` WRITE;
/*!40000 ALTER TABLE `Recipe` DISABLE KEYS */;
INSERT INTO `Recipe` VALUES (1,'Hayden\'s Rem 700 Fav',1,1,44.1,1,1,'',0,0);
/*!40000 ALTER TABLE `Recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shell_Holder`
--

DROP TABLE IF EXISTS `Shell_Holder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Shell_Holder` (
  `shell_holder_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacture` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`shell_holder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shell_Holder`
--

LOCK TABLES `Shell_Holder` WRITE;
/*!40000 ALTER TABLE `Shell_Holder` DISABLE KEYS */;
/*!40000 ALTER TABLE `Shell_Holder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ultrasonic_Cleaner`
--

DROP TABLE IF EXISTS `Ultrasonic_Cleaner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ultrasonic_Cleaner` (
  `ultrasonic_cleaner_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacture` varchar(255) DEFAULT NULL,
  `ultrasonic_cleaner_size` varchar(255) DEFAULT NULL,
  `ultrasonic_cleaner_type` char(4) DEFAULT NULL,
  PRIMARY KEY (`ultrasonic_cleaner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ultrasonic_Cleaner`
--

LOCK TABLES `Ultrasonic_Cleaner` WRITE;
/*!40000 ALTER TABLE `Ultrasonic_Cleaner` DISABLE KEYS */;
/*!40000 ALTER TABLE `Ultrasonic_Cleaner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Work_Bench`
--

DROP TABLE IF EXISTS `Work_Bench`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Work_Bench` (
  `work_bench_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `work_bench_type` varchar(255) DEFAULT NULL,
  `wwork_bench_size` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`work_bench_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Work_Bench`
--

LOCK TABLES `Work_Bench` WRITE;
/*!40000 ALTER TABLE `Work_Bench` DISABLE KEYS */;
/*!40000 ALTER TABLE `Work_Bench` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-09 12:34:17
