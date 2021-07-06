-- MySQL dump 10.13  Distrib 8.0.25, for macos11.3 (x86_64)
--
-- Host: 127.0.0.1    Database: realstate
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (1,'Casa'),(2,'Terreno');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Feature`
--

DROP TABLE IF EXISTS `Feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Feature` (
  `feature_id` int NOT NULL AUTO_INCREMENT,
  `feature_content` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Feature`
--

LOCK TABLES `Feature` WRITE;
/*!40000 ALTER TABLE `Feature` DISABLE KEYS */;
/*!40000 ALTER TABLE `Feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Image`
--

DROP TABLE IF EXISTS `Image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Image` (
  `img_id` int NOT NULL AUTO_INCREMENT,
  `img_path` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Image`
--

LOCK TABLES `Image` WRITE;
/*!40000 ALTER TABLE `Image` DISABLE KEYS */;

/*!40000 ALTER TABLE `Image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location`
--

DROP TABLE IF EXISTS `Location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Location` (
  `lo_id` int NOT NULL AUTO_INCREMENT,
  `lo_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lo_id`),
  UNIQUE KEY `lo_name` (`lo_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Property`
--

DROP TABLE IF EXISTS `Property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Property` (
  `prop_id` varchar(32) NOT NULL,
  `prop_name` varchar(100) NOT NULL DEFAULT '-',
  `prop_address` varchar(100) NOT NULL DEFAULT '-',
  `prop_location` int NOT NULL,
  `prop_description` text,
  `prop_area` float DEFAULT NULL,
  `prop_price` double NOT NULL DEFAULT '0',
  `prop_pubDate` datetime DEFAULT NULL,
  `prop_isHidden` int DEFAULT NULL,
  `prop_category` int DEFAULT NULL,
  PRIMARY KEY (`prop_id`),
  UNIQUE KEY `prop_pubDate` (`prop_pubDate`),
  KEY `prop_location` (`prop_location`),
  KEY `property_ibfi_2` (`prop_category`),
  CONSTRAINT `property_ibfk_1` FOREIGN KEY (`prop_location`) REFERENCES `Location` (`lo_id`),
  CONSTRAINT `property_ibfk_2` FOREIGN KEY (`prop_category`) REFERENCES `Category` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property`
--

LOCK TABLES `Property` WRITE;
/*!40000 ALTER TABLE `Property` DISABLE KEYS */;
/*!40000 ALTER TABLE `Property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Property_Feature`
--

DROP TABLE IF EXISTS `Property_Feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Property_Feature` (
  `propFeature_prop_id` varchar(32) DEFAULT NULL,
  `propFeatureg_feature_id` int DEFAULT NULL,
  KEY `propFeature_prop_id` (`propFeature_prop_id`),
  KEY `propFeatureg_feature_id` (`propFeatureg_feature_id`),
  CONSTRAINT `property_feature_ibfk_1` FOREIGN KEY (`propFeature_prop_id`) REFERENCES `Property` (`prop_id`),
  CONSTRAINT `property_feature_ibfk_2` FOREIGN KEY (`propFeatureg_feature_id`) REFERENCES `Feature` (`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property_Feature`
--

LOCK TABLES `Property_Feature` WRITE;
/*!40000 ALTER TABLE `Property_Feature` DISABLE KEYS */;
/*!40000 ALTER TABLE `Property_Feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Property_Image`
--

DROP TABLE IF EXISTS `Property_Image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Property_Image` (
  `propImg_prop_id` varchar(32) DEFAULT NULL,
  `propImg_img_id` int DEFAULT NULL,
  KEY `propImg_prop_id` (`propImg_prop_id`),
  KEY `propImg_img_id` (`propImg_img_id`),
  CONSTRAINT `property_image_ibfk_1` FOREIGN KEY (`propImg_prop_id`) REFERENCES `Property` (`prop_id`),
  CONSTRAINT `property_image_ibfk_2` FOREIGN KEY (`propImg_img_id`) REFERENCES `Image` (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property_Image`
--

LOCK TABLES `Property_Image` WRITE;
/*!40000 ALTER TABLE `Property_Image` DISABLE KEYS */;
/*!40000 ALTER TABLE `Property_Image` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-06  0:11:43
