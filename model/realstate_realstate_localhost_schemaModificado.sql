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
-- Dumping data for table `Feature`
--

LOCK TABLES `Feature` WRITE;
/*!40000 ALTER TABLE `Feature` DISABLE KEYS */;
INSERT INTO `Feature` VALUES (50,'Habitaciones: 3'),(51,'Baños: 1'),(52,'Lotes de estacionamiento: 2'),(53,'Habitaciones: 2'),(54,'Baños: 1'),(55,'Lotes de estacionamiento: 2'),(59,'Habitaciones: 10'),(60,'Baños: 3'),(61,'Lotes de estacionamiento: 0'),(62,'Habitaciones: 0'),(63,'Baños: 0'),(64,'Lotes de estacionamiento: 0'),(65,'Habitaciones: 0'),(66,'Baños: 0'),(67,'Lotes de estacionamiento: 0'),(68,'Habitaciones: 0'),(69,'Baños: 0'),(70,'Lotes de estacionamiento: 0'),(71,'Habitaciones: 012'),(72,'Baños: 024'),(73,'Lotes de estacionamiento: 20'),(74,'Habitaciones: 012'),(75,'Baños: 024'),(76,'Lotes de estacionamiento: 20'),(79,'El infierno arde con ellos'),(80,'Fueeeeeeego'),(81,'Fiiiiiire'),(82,'Candela'),(88,'Habitaciones: 3'),(89,'Baños: 3'),(90,'Lotes de estacionamiento: 5'),(91,'Habitaciones: 3'),(92,'Baños: 2'),(93,'Lotes de estacionamiento: 2'),(101,'Es bonito'),(102,'Es bueno'),(103,'Es barato'),(104,'Quizá no tanto'),(105,'Feature extra'),(106,'Es mi casa'),(107,'Me da la gana'),(108,'asfasf'),(109,'asfaf');
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
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Image`
--

LOCK TABLES `Image` WRITE;
/*!40000 ALTER TABLE `Image` DISABLE KEYS */;
INSERT INTO `Image` VALUES (60,'http://localhost:8000/media/Properties_img/mini-testimonial-1_RESIZED.png'),(61,'http://localhost:8000/media/Properties_img/mini-testimonial-2_RESIZED.png'),(66,'http://192.168.39.112:8000/media/Properties_img/A04A807D-6EB1-49CE-B395-8F744125306D_RESIZED.png'),(67,'http://192.168.39.112:8000/media/Properties_img/F0273294-E35E-4FBF-8512-26633291A737_RESIZED.png'),(68,'http://192.168.39.112:8000/media/Properties_img/27648FD3-A0E3-4691-A463-1B774BAE25BB_RESIZED.png'),(69,'http://192.168.39.112:8000/media/Properties_img/'),(70,'http://192.168.39.112:8000/media/Properties_img/'),(71,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-9.29.27-2-_RESIZED.png'),(72,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-10.26.41_RESIZED.png'),(73,'http://localhost:8000/media/Properties_img/'),(74,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-9.29.26-2-_RESIZED.png'),(75,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-9.29.26-2-_RESIZED_1.png'),(77,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-9.29.21_RESIZED.png'),(78,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-9.29.21-2-_RESIZED.png'),(79,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-10.26.41_RESIZED.png'),(81,'http://192.168.0.3:8000/media/Properties_img/A69F3D7A-339F-4194-A143-A764CF85B40F_RESIZED.png'),(83,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-9.29.24-2-_RESIZED.png'),(84,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-9.29.27-2-_RESIZED.png'),(85,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-06-a-la-s-10.26.41_RESIZED.png'),(86,'http://localhost:8000/media/Properties_img/Captura-de-Pantalla-2021-07-26-a-la-s-15.23.43_RESIZED.png');
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
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
INSERT INTO `Location` VALUES (19,'Boom Island'),(20,'Cancún'),(22,'El infierno'),(23,'La Habana'),(24,'Mi macbook');
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
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property`
--

LOCK TABLES `Property` WRITE;
/*!40000 ALTER TABLE `Property` DISABLE KEYS */;
INSERT INTO `Property` VALUES ('1cd77452aee4f04d25f33297db6efc18','Aaaa','Hjkkk',20,'El gobierno de cuba no se debe al estado que está dura en el estado y el de reconciliación y la reconciliación en la materia de los países de los estados miembros y que se creen en el futuro y el futuro del país y a los países del estado de cuba en el futuro de cuba y el futuro del caribe para la región del norte y de la región del país donde el gobierno de cuba es un país de donde ha sido la región más importante ',6655,6778,'2021-07-12 05:02:28',0,1),('47d989b703e07f97e303229af99cd812','Una casa','Por ahi en el walmart',20,'afasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasf afasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasf afasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasf',475,125125,'2021-07-19 19:18:43',0,1),('4e2ab3c220e87cb4525b2583fc7c21de','Sfasf','afasf',20,'asfasfasf',2424,2424,'2021-07-12 07:01:46',0,1),('687cbb8c9c9822ac5065f07e237f479d','Jhggg','Jjj',22,'Hhvb',9,6,'2021-07-12 05:03:52',0,1),('a7a0acda5eea1112128b93ee18872f17','El durmiente ','Detrás del muro',19,'Lol',10000,9999,'2021-07-12 04:52:24',0,1),('c7f560d383de27359d6a92149451cffb','Asffasfasfasfas','asfasf',24,'asfasfasf',2424,2424,'2021-07-26 15:24:24',0,2),('d3c2aa727d3fa875e820770104488a33','Mi nueva último terreno','Gouicuría #761',23,'Es mi casa, si te vas a Cuba alguna vez tienes posada xD',40,1000,'2021-07-25 18:38:45',0,2),('e30cc40df3b9869a2769714addbe88f6','Casa abuela','SM 15 MZ 1 condomio Alhambra ',20,'Hola hola ',50,13000,'2021-07-22 11:49:23',0,1),('e74c5939b5e22d67c5664ca9ab1e4fd5','Pegboard Fields','Al ladito de Satán',22,'Pegboard Nerds es un dúo de disc jockeys y productores de música electrónica, formado por Alexander Odden (proveniente de Hamar, Noruega), y Michael Parsberg (nacido en Copenhague, Dinamarca).1​\r\n\r\nActualmente, sus canciones son grabadas y producidas por la discográfica canadiense Monstercat, con la cual ya ha sacado 4 discos. Es considerada una de las bandas más exitosas de música electrónica y sus derivaciones, en especial EDM (música electrónica de baile), a pesar del poco tiempo en escena. ',12,2000,'2021-07-12 04:32:38',0,2),('f593c24e6f48dcc6c57c7e443892d529','Una casa','Por ahi en el walmart',20,'afasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasf afasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasf afasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasfafasfsfasfasfafsasfasf',475,12512555,'2021-07-19 19:19:57',0,1),('f744954c96a9758b13c048f7371561b3','Tomorrowland Mainstage','En el mejor lugar del mundo',19,'Tomorrowland es un festival de música electrónica de baile celebrado anualmente en la localidad de Boom (Bélgica). El festival es organizado por las empresas propias del festival (We Are One World y Tomorrowland Foundation) en conjunción con la promotora estadounidense LiveStyle, y se calcula que anualmente acuden más de 400.000 personas de casi 200 nacionalidades distintas.1​ Es oficialmente el festival más grande del planeta',10000,600,'2021-07-12 04:17:29',0,1),('fc5a16e37fccc78c14afe3e57e2d2ba9','La última propiedad','En el fin',20,'La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. La descripción es muy importante. ',6789,12345123,'2021-07-23 13:46:26',0,2);
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
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property_Feature`
--

LOCK TABLES `Property_Feature` WRITE;
/*!40000 ALTER TABLE `Property_Feature` DISABLE KEYS */;
INSERT INTO `Property_Feature` VALUES ('a7a0acda5eea1112128b93ee18872f17',59),('a7a0acda5eea1112128b93ee18872f17',60),('a7a0acda5eea1112128b93ee18872f17',61),('1cd77452aee4f04d25f33297db6efc18',62),('1cd77452aee4f04d25f33297db6efc18',63),('1cd77452aee4f04d25f33297db6efc18',64),('687cbb8c9c9822ac5065f07e237f479d',65),('687cbb8c9c9822ac5065f07e237f479d',66),('687cbb8c9c9822ac5065f07e237f479d',67),('4e2ab3c220e87cb4525b2583fc7c21de',68),('4e2ab3c220e87cb4525b2583fc7c21de',69),('4e2ab3c220e87cb4525b2583fc7c21de',70),('47d989b703e07f97e303229af99cd812',71),('47d989b703e07f97e303229af99cd812',72),('47d989b703e07f97e303229af99cd812',73),('f593c24e6f48dcc6c57c7e443892d529',74),('f593c24e6f48dcc6c57c7e443892d529',75),('f593c24e6f48dcc6c57c7e443892d529',76),('e74c5939b5e22d67c5664ca9ab1e4fd5',79),('e74c5939b5e22d67c5664ca9ab1e4fd5',80),('e74c5939b5e22d67c5664ca9ab1e4fd5',81),('e74c5939b5e22d67c5664ca9ab1e4fd5',82),('f744954c96a9758b13c048f7371561b3',88),('f744954c96a9758b13c048f7371561b3',89),('f744954c96a9758b13c048f7371561b3',90),('e30cc40df3b9869a2769714addbe88f6',91),('e30cc40df3b9869a2769714addbe88f6',92),('e30cc40df3b9869a2769714addbe88f6',93),('fc5a16e37fccc78c14afe3e57e2d2ba9',101),('fc5a16e37fccc78c14afe3e57e2d2ba9',102),('fc5a16e37fccc78c14afe3e57e2d2ba9',103),('fc5a16e37fccc78c14afe3e57e2d2ba9',104),('fc5a16e37fccc78c14afe3e57e2d2ba9',105),('d3c2aa727d3fa875e820770104488a33',106),('d3c2aa727d3fa875e820770104488a33',107),('c7f560d383de27359d6a92149451cffb',108),('c7f560d383de27359d6a92149451cffb',109);
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
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property_Image`
--

LOCK TABLES `Property_Image` WRITE;
/*!40000 ALTER TABLE `Property_Image` DISABLE KEYS */;
INSERT INTO `Property_Image` VALUES ('1cd77452aee4f04d25f33297db6efc18',66),('1cd77452aee4f04d25f33297db6efc18',67),('1cd77452aee4f04d25f33297db6efc18',68),('687cbb8c9c9822ac5065f07e237f479d',69),('687cbb8c9c9822ac5065f07e237f479d',70),('4e2ab3c220e87cb4525b2583fc7c21de',71),('4e2ab3c220e87cb4525b2583fc7c21de',72),('47d989b703e07f97e303229af99cd812',73),('f593c24e6f48dcc6c57c7e443892d529',74),('f744954c96a9758b13c048f7371561b3',77),('e74c5939b5e22d67c5664ca9ab1e4fd5',78),('a7a0acda5eea1112128b93ee18872f17',79),('e30cc40df3b9869a2769714addbe88f6',81),('fc5a16e37fccc78c14afe3e57e2d2ba9',83),('d3c2aa727d3fa875e820770104488a33',84),('c7f560d383de27359d6a92149451cffb',85),('c7f560d383de27359d6a92149451cffb',86);
/*!40000 ALTER TABLE `Property_Image` ENABLE KEYS */;
UNLOCK TABLES;
