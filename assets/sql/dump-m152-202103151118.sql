-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: m152
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.27-MariaDB-0+deb10u1

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
-- Table structure for table `POST`
--

DROP TABLE IF EXISTS `POST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `POST` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(255) NOT NULL,
  `dateDeCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateDeModification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idPost`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `POST`
--

LOCK TABLES `POST` WRITE;
/*!40000 ALTER TABLE `POST` DISABLE KEYS */;
INSERT INTO `POST` VALUES (46,'Ceci est un post ','2021-03-08 07:42:23','2021-03-08 07:42:23'),(47,'salut emc comment ca va\r\n','2021-03-08 07:50:09','2021-03-08 07:50:09'),(49,'asd','2021-03-08 09:47:10','2021-03-08 09:47:10'),(50,'Ceci est un post avec une vidéo','2021-03-08 10:09:49','2021-03-08 10:09:49'),(51,'Image et vidéo','2021-03-08 10:29:52','2021-03-08 10:29:52'),(52,'Ca c&#39;st de la bonne musique','2021-03-15 07:39:52','2021-03-15 07:39:52'),(53,'C&#39;est trop cool les tamagochis','2021-03-15 10:17:14','2021-03-15 10:17:14');
/*!40000 ALTER TABLE `POST` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MEDIA`
--

DROP TABLE IF EXISTS `MEDIA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MEDIA` (
  `idMedia` int(11) NOT NULL AUTO_INCREMENT,
  `typeMedia` varchar(255) NOT NULL,
  `nomFichierMedia` varchar(255) NOT NULL,
  `dateDeCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `idPost` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMedia`),
  KEY `MEDIA_FK` (`idPost`),
  CONSTRAINT `MEDIA_FK` FOREIGN KEY (`idPost`) REFERENCES `POST` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MEDIA`
--

LOCK TABLES `MEDIA` WRITE;
/*!40000 ALTER TABLE `MEDIA` DISABLE KEYS */;
INSERT INTO `MEDIA` VALUES (11,'image/png','img_6045d5d7db2d51.07350812.png','2021-03-08 07:44:24',46),(12,'image/png','img_6045d7386c54b0.65496006.png','2021-03-08 07:50:16',47),(13,'image/svg+xml','media_6045f51f40e3f5.21516263.svg','2021-03-08 09:57:51',49),(14,'video/mp4','media_6045f7ed45a928.01185252.mp4','2021-03-08 10:09:49',50),(15,'video/mp4','media_6045fca016a293.83129181.mp4','2021-03-08 10:29:52',51),(16,'image/png','media_6045fca0179b67.36166025.png','2021-03-08 10:29:52',51),(17,'audio/mpeg','media_604f0f4876c062.12301823.mp3','2021-03-15 07:39:52',52),(18,'image/png','media_604f342a7ff592.81450656.png','2021-03-15 10:17:14',53),(19,'image/png','media_604f342a805a83.07507112.png','2021-03-15 10:17:14',53),(20,'image/png','media_604f342a8100b4.13286056.png','2021-03-15 10:17:14',53),(21,'image/png','media_604f342a814fc3.03599050.png','2021-03-15 10:17:14',53),(22,'image/png','media_604f342a81aa72.49095481.png','2021-03-15 10:17:14',53),(23,'image/png','media_604f342a81faa6.57008355.png','2021-03-15 10:17:14',53),(24,'image/png','media_604f342a825058.07210463.png','2021-03-15 10:17:14',53);
/*!40000 ALTER TABLE `MEDIA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'm152'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-15 11:18:18
