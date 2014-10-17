CREATE DATABASE  IF NOT EXISTS `tud` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tud`;
-- MySQL dump 10.13  Distrib 5.6.17, for osx10.6 (i386)
--
-- Host: localhost    Database: tud
-- ------------------------------------------------------
-- Server version	5.5.38

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
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station` (
  `stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `stat_nom` varchar(45) NOT NULL,
  `stat_svg_x` decimal(15,5) NOT NULL,
  `stat_svg_y` decimal(15,5) NOT NULL,
  `stat_key` varchar(45) NOT NULL,
  PRIMARY KEY (`stat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station`
--

LOCK TABLES `station` WRITE;
/*!40000 ALTER TABLE `station` DISABLE KEYS */;
INSERT INTO `station` VALUES (1,'Gare',861.38855,634.79059,'gare'),(2,'Avenue de la Gare',889.67285,559.28168,'avgare'),(3,'Pré Guillaume',831.58905,541.35144,'preguillaume'),(4,'Rue du Stand',701.27936,553.72583,'stand'),(5,'Centre Sportif Blancherie',613.90118,645.14465,'blancherie'),(6,'Parc Gros-Pré',539.14990,607.26392,'grospre'),(7,'Hôpital',463.38846,301.69278,'hopital'),(8,'Merret-Openheim',369.44427,366.84760,'merretop'),(9,'Chemin du Pallastre',283.83383,403.97070,'palastre'),(10,'Rue du Poujet',388.63718,444.63936,'poujet'),(11,'Hôme La Promenade',527.53314,492.35910,'promenade'),(12,'Centre l\'Avenir',1072.00000,470.71429,'avenir'),(13,'Rue des Primevères',1107.71420,399.99997,'primeveres'),(14,'Usine à Gaz',1180.57140,351.42859,'gaz'),(15,'Morépont',1093.42860,237.85716,'morepont'),(16,'Rue des Moissons',1016.99990,162.14287,'moissons'),(17,'Rue des Bordgeais',1087.71440,92.14287,'bordgeais'),(18,'Cras des Fourches',1084.85720,6.42858,'crasfourches'),(19,'Sous-Mexique',982.00006,20.71429,'sousmexique'),(20,'Rue des Andains',921.28571,55.71428,'andains'),(21,'Giratoire Vorbourg',890.57141,107.85714,'giravorbourg'),(22,'Rue des Martins',872.71429,201.42857,'martins'),(23,'Chapelle Montcroix',735.57135,318.57144,'montcroix'),(24,'Salle St-Georges',743.42853,418.57144,'stgeorges'),(25,'Le Ticle',826.28577,405.00000,'ticle');
/*!40000 ALTER TABLE `station` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-16 22:33:50
