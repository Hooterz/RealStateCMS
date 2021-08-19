DROP DATABASE IF EXISTS realstate;
CREATE DATABASE realstate;
USE realstate;

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
);
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
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
);
/*!40101 SET character_set_client = @saved_cs_client */;


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
);
/*!40101 SET character_set_client = @saved_cs_client */;


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
);
/*!40101 SET character_set_client = @saved_cs_client */;


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
);
/*!40101 SET character_set_client = @saved_cs_client */;


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
);
/*!40101 SET character_set_client = @saved_cs_client */;
