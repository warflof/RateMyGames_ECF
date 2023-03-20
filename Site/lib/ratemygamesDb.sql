-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: ratemygames
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `actualite`
--

DROP TABLE IF EXISTS `actualite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actualite` (
  `id_actu` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(255) NOT NULL,
  `Texte` text NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id_actu`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actualite`
--

LOCK TABLES `actualite` WRITE;
/*!40000 ALTER TABLE `actualite` DISABLE KEYS */;
INSERT INTO `actualite` VALUES (6,'Test Refresh','ouiouiouoiouiouiiuiouoiuoiuo','6408717b9bc73-a-plague-tale-requiem5-webp','2023-03-08 11:28:59'),(7,'Test balises update 5','Salut <strong>Toi</strong>','6408716a3151d-horizon-forbiden-west-gif','2023-03-08 11:28:42'),(10,'Test Refresh','ouiouiouoiouiouiiuiouoiuoiuo','6408717b9bc73-a-plague-tale-requiem5-webp','2023-03-08 11:28:59'),(11,'Test balises update 5','Salut <strong>Toi</strong>','6408716a3151d-horizon-forbiden-west-gif','2023-03-08 11:28:42'),(16,'Test Refresh','ouiouiouoiouiouiiuiouoiuoiuo','6408717b9bc73-a-plague-tale-requiem5-webp','2023-03-08 11:28:59'),(17,'Test balises update 5','Salut <strong>Toi</strong>','6408716a3151d-horizon-forbiden-west-gif','2023-03-08 11:28:42'),(18,'Test Refresh','ouiouiouoiouiouiiuiouoiuoiuo','6408717b9bc73-a-plague-tale-requiem5-webp','2023-03-08 11:28:59'),(19,'Test balises update 5','Salut <strong>Toi</strong>','6408716a3151d-horizon-forbiden-west-gif','2023-03-08 11:28:42');
/*!40000 ALTER TABLE `actualite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jeu_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jeu_id` (`jeu_id`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (103,'64088c19128b3-a-plague-tale-requiem4-webp',160),(104,'64088c1912d7d-a-plague-tale-requiem5-webp',160),(105,'64088c1913157-a-plague-tale-requiem6-webp',160);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jeu`
--

DROP TABLE IF EXISTS `jeu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jeu` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jouable` int DEFAULT NULL,
  `id_moteur` int DEFAULT NULL,
  `score` int NOT NULL DEFAULT '0',
  `date_creation` date DEFAULT NULL,
  `date_last_maj` datetime DEFAULT NULL,
  `date_estimee_fin` date NOT NULL DEFAULT '2024-12-31',
  `budget` int NOT NULL,
  `createur_jeu_id` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Statut` (`jouable`) USING BTREE,
  KEY `moteur_id` (`id_moteur`),
  KEY `createur_jeu` (`createur_jeu_id`),
  CONSTRAINT `createur_jeu` FOREIGN KEY (`createur_jeu_id`) REFERENCES `utilisateur` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `jouable_id` FOREIGN KEY (`jouable`) REFERENCES `statut` (`id_jouable`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `moteur_id` FOREIGN KEY (`id_moteur`) REFERENCES `moteur` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jeu`
--

LOCK TABLES `jeu` WRITE;
/*!40000 ALTER TABLE `jeu` DISABLE KEYS */;
INSERT INTO `jeu` VALUES (7,'World of Warcraft: DragonFlight','World of Warcraft: DragonFlight tauren balipums catae loktar hogar','6405bda27b89f-world-of-warcraft-dragonflight-jpg',1,3,1,NULL,'2023-03-06 10:17:06','2024-12-31',300000,15),(143,'Horizon Forbiden West','Horizon borem pisae liputas machinox','6402420391332-a-plague-tale-requiem4-webp',1,1,1,'2023-01-09','2023-03-03 18:52:51','2023-02-23',20,5),(144,'Star Wars: Battlefront III','Star Wars: Battlefront III horem balipum catae fresheur gilodarae','640241f25858d-a-plague-tale-requiem5-webp',2,3,2,'2022-10-04','2023-03-03 18:52:34','2023-02-10',10000,NULL),(145,'World of Warcraft: DragonFlight 2','World of Warcraft: DragonFlight tauren balipums catae loktar hogar bawé test commentaire','640241bc65311-a-plague-tale-requiem6-webp',2,3,2,NULL,'2023-03-03 18:51:40','2025-01-05',7000,NULL),(154,'Atomic Earth','Atomic EarthAtomic EarthAtomic EarthAtomic EarthAtomic EarthAtomic Earth','6402416175b4b-a-plague-tale-requiem-gif',1,3,2,'2023-03-02','2023-03-03 18:50:09','2024-12-30',15,5),(155,'Hifi Rush','Hifi RushHifi RushHifi RushHifi RushHifi RushHifi RushHifi RushHifi Rush','6401ebedac3f7-horizon-forbiden-west-gif',1,1,2,'2023-03-02','2023-03-03 15:09:36','2024-12-20',20,5),(158,'Hifi Rush 2','Hifi RushHifi RushHifi RushHifi RushHifi RushHifi RushHifi RushHifi Rush','6401ebedac3f7-horizon-forbiden-west-gif',1,1,2,'2023-03-02','2023-03-03 15:09:36','2024-12-20',20,5),(159,'Star Wars: Battlefront II','Star Wars: Battlefront II horem balipum catae fresheur gilodarae','640241f25858d-a-plague-tale-requiem5-webp',2,3,2,'2022-10-04','2023-03-03 18:52:34','2023-02-10',10000,5),(160,'Atomic Earth 2','Atomic EarthAtomic EarthAtomic EarthAtomic EarthAtomic EarthAtomic Earth','6402416175b4b-a-plague-tale-requiem-gif',1,3,3,'2023-03-02','2023-03-08 16:14:43','2024-12-30',15,5);
/*!40000 ALTER TABLE `jeu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `jeu_createur_vw`
--

DROP TABLE IF EXISTS `jeu_createur_vw`;
/*!50001 DROP VIEW IF EXISTS `jeu_createur_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jeu_createur_vw` AS SELECT 
 1 AS `ID`,
 1 AS `Titre`,
 1 AS `createur_jeu_id`,
 1 AS `email`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `jeu_jouable_vw`
--

DROP TABLE IF EXISTS `jeu_jouable_vw`;
/*!50001 DROP VIEW IF EXISTS `jeu_jouable_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jeu_jouable_vw` AS SELECT 
 1 AS `Titre`,
 1 AS `jouable`,
 1 AS `Statut`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `jeu_moteur_vw`
--

DROP TABLE IF EXISTS `jeu_moteur_vw`;
/*!50001 DROP VIEW IF EXISTS `jeu_moteur_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jeu_moteur_vw` AS SELECT 
 1 AS `Titre`,
 1 AS `id_moteur`,
 1 AS `moteur_nom`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `jeu_nombre_joueur`
--

DROP TABLE IF EXISTS `jeu_nombre_joueur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jeu_nombre_joueur` (
  `jeu_id` int NOT NULL,
  `nombre_joueur_id` int NOT NULL,
  PRIMARY KEY (`jeu_id`,`nombre_joueur_id`),
  KEY `jeu_nombre_joueur_ibfk_2` (`nombre_joueur_id`),
  CONSTRAINT `jeu_nombre_joueur_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `jeu_nombre_joueur_ibfk_2` FOREIGN KEY (`nombre_joueur_id`) REFERENCES `nombre_joueur` (`id_nombre_joueur`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jeu_nombre_joueur`
--

LOCK TABLES `jeu_nombre_joueur` WRITE;
/*!40000 ALTER TABLE `jeu_nombre_joueur` DISABLE KEYS */;
INSERT INTO `jeu_nombre_joueur` VALUES (7,1),(143,1),(145,1),(154,1),(155,1),(160,1),(144,2),(145,2);
/*!40000 ALTER TABLE `jeu_nombre_joueur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `jeu_nombre_joueur_vw`
--

DROP TABLE IF EXISTS `jeu_nombre_joueur_vw`;
/*!50001 DROP VIEW IF EXISTS `jeu_nombre_joueur_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jeu_nombre_joueur_vw` AS SELECT 
 1 AS `ID`,
 1 AS `Titre`,
 1 AS `id_nombre_joueur`,
 1 AS `nom_nombre_joueur`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `jeu_style`
--

DROP TABLE IF EXISTS `jeu_style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jeu_style` (
  `jeu_id` int NOT NULL,
  `style_id` int NOT NULL,
  PRIMARY KEY (`jeu_id`,`style_id`),
  KEY `style_id` (`style_id`),
  CONSTRAINT `jeu_style_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `style_id` FOREIGN KEY (`style_id`) REFERENCES `style` (`id_style`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jeu_style`
--

LOCK TABLES `jeu_style` WRITE;
/*!40000 ALTER TABLE `jeu_style` DISABLE KEYS */;
INSERT INTO `jeu_style` VALUES (7,1),(143,2),(155,2),(160,2),(154,3),(145,8);
/*!40000 ALTER TABLE `jeu_style` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `jeu_style_vw`
--

DROP TABLE IF EXISTS `jeu_style_vw`;
/*!50001 DROP VIEW IF EXISTS `jeu_style_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jeu_style_vw` AS SELECT 
 1 AS `ID`,
 1 AS `Titre`,
 1 AS `id_style`,
 1 AS `style`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `jeu_support`
--

DROP TABLE IF EXISTS `jeu_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jeu_support` (
  `jeu_id` int NOT NULL,
  `support_id` int NOT NULL,
  PRIMARY KEY (`jeu_id`,`support_id`),
  KEY `jeu_support_ibfk_2` (`support_id`),
  CONSTRAINT `jeu_support_ibfk_1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `jeu_support_ibfk_2` FOREIGN KEY (`support_id`) REFERENCES `support` (`id_support`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jeu_support`
--

LOCK TABLES `jeu_support` WRITE;
/*!40000 ALTER TABLE `jeu_support` DISABLE KEYS */;
INSERT INTO `jeu_support` VALUES (7,1),(144,1),(145,1),(154,1),(155,1),(160,1),(143,2);
/*!40000 ALTER TABLE `jeu_support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `jeu_support_vw`
--

DROP TABLE IF EXISTS `jeu_support_vw`;
/*!50001 DROP VIEW IF EXISTS `jeu_support_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jeu_support_vw` AS SELECT 
 1 AS `ID`,
 1 AS `Titre`,
 1 AS `id_support`,
 1 AS `nom_support`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `last_maj`
--

DROP TABLE IF EXISTS `last_maj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `last_maj` (
  `id_modif` int NOT NULL AUTO_INCREMENT,
  `jeu_ID` int NOT NULL,
  `last_maj` datetime NOT NULL,
  `id_user` int NOT NULL,
  `commentaire` text,
  PRIMARY KEY (`id_modif`),
  KEY `id_user` (`id_user`),
  KEY `jeu_id` (`jeu_ID`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jeu_id` FOREIGN KEY (`jeu_ID`) REFERENCES `jeu` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `last_maj`
--

LOCK TABLES `last_maj` WRITE;
/*!40000 ALTER TABLE `last_maj` DISABLE KEYS */;
INSERT INTO `last_maj` VALUES (1,143,'2023-03-02 14:22:42',5,NULL),(2,145,'2023-03-02 14:27:23',5,NULL),(3,145,'2023-03-02 14:27:36',5,NULL),(4,145,'2023-03-02 15:04:01',15,'l\'équipe technique coûte un max !!!! '),(5,145,'2023-03-02 15:18:59',5,'On avait oublié de mettre le \"2\" à la fin du jeu ... Du coup ca faisait un peu tâche ! '),(6,155,'2023-03-03 12:45:33',5,''),(7,155,'2023-03-03 15:09:36',5,''),(8,154,'2023-03-03 18:50:09',5,''),(9,145,'2023-03-03 18:51:40',5,''),(10,144,'2023-03-03 18:51:58',5,''),(11,144,'2023-03-03 18:52:34',5,''),(12,143,'2023-03-03 18:52:51',5,''),(13,7,'2023-03-06 10:17:06',5,''),(14,160,'2023-03-08 13:22:33',5,''),(15,160,'2023-03-08 13:51:23',5,''),(16,160,'2023-03-08 15:53:57',5,''),(26,160,'2023-03-08 16:08:48',5,''),(27,160,'2023-03-08 16:11:03',5,''),(28,160,'2023-03-08 16:13:15',5,''),(29,160,'2023-03-08 16:13:46',5,''),(30,160,'2023-03-08 16:14:43',5,'');
/*!40000 ALTER TABLE `last_maj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `last_maj_user_vw`
--

DROP TABLE IF EXISTS `last_maj_user_vw`;
/*!50001 DROP VIEW IF EXISTS `last_maj_user_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `last_maj_user_vw` AS SELECT 
 1 AS `jeu_ID`,
 1 AS `last_maj`,
 1 AS `id_user`,
 1 AS `pseudo`,
 1 AS `commentaire`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `moteur`
--

DROP TABLE IF EXISTS `moteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `moteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `moteur_nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moteur`
--

LOCK TABLES `moteur` WRITE;
/*!40000 ALTER TABLE `moteur` DISABLE KEYS */;
INSERT INTO `moteur` VALUES (1,'Unity'),(2,'Unreal'),(3,'CryEngine');
/*!40000 ALTER TABLE `moteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nombre_joueur`
--

DROP TABLE IF EXISTS `nombre_joueur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nombre_joueur` (
  `id_nombre_joueur` int NOT NULL AUTO_INCREMENT,
  `nom_nombre_joueur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_nombre_joueur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nombre_joueur`
--

LOCK TABLES `nombre_joueur` WRITE;
/*!40000 ALTER TABLE `nombre_joueur` DISABLE KEYS */;
INSERT INTO `nombre_joueur` VALUES (1,'Solo'),(2,'Coop'),(3,'Multijoueur');
/*!40000 ALTER TABLE `nombre_joueur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(100) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrateur'),(2,'Producteur'),(5,'Community Manager'),(6,'Utilisateur');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statut`
--

DROP TABLE IF EXISTS `statut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statut` (
  `id_jouable` int NOT NULL,
  `Statut` varchar(55) NOT NULL,
  PRIMARY KEY (`id_jouable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statut`
--

LOCK TABLES `statut` WRITE;
/*!40000 ALTER TABLE `statut` DISABLE KEYS */;
INSERT INTO `statut` VALUES (1,'En cours de développement'),(2,'Jouable');
/*!40000 ALTER TABLE `statut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `style`
--

DROP TABLE IF EXISTS `style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `style` (
  `id_style` int NOT NULL AUTO_INCREMENT,
  `style` varchar(55) NOT NULL,
  PRIMARY KEY (`id_style`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `style`
--

LOCK TABLES `style` WRITE;
/*!40000 ALTER TABLE `style` DISABLE KEYS */;
INSERT INTO `style` VALUES (1,'Aventure'),(2,'Plateformer'),(3,'FPS'),(4,'MMORPG'),(5,'RPG'),(6,'MOBA'),(7,'RTS'),(8,'Horreur'),(9,'Survival'),(10,'Hack\'n Slash'),(11,'Simulation');
/*!40000 ALTER TABLE `style` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support` (
  `id_support` int NOT NULL AUTO_INCREMENT,
  `nom_support` varchar(55) NOT NULL,
  PRIMARY KEY (`id_support`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
INSERT INTO `support` VALUES (1,'PC'),(2,'Xboite');
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int NOT NULL,
  `token` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (5,'l.warflof@gmail.com','warflof','$2y$10$.n9OyMDHzaND9iCStj2PEObr86ZLocBwvOS/bKLrCBthG84Z8pd2y',1,'640a06a576a4e'),(11,'utilisateur@test.fr','x360xNoScop','$2y$10$q6UFV528ITkqPtRREol.he87PNuUfQ/hB5ADR541sTT/BbIh1JUrK',6,NULL),(15,'producer@test.fr','Rot$hield','$2y$10$sAqtv6Jw/KJGtMBIYskzFuyljyZtEObGPxTJ7gXVVphLlpfPQsFt.',2,NULL),(16,'cm@test.fr','st4gi4ir3','$2y$10$IZr1k3BVnKMxAmQSXjrgHeX/qTEFJQelD2iySLFd.eifYJkzZTzYi',5,NULL),(17,'warfahe@yopmail.com','Warfahe','$2y$10$O7bZnfTAWe8OTp1AJZIvsuV5oBWQnjm2lsLrPTErad/hK0Xos1dqW',6,NULL),(18,'geek@test.fr','G33k3000','$2y$10$eYhU5jvXC9/h0exnhLrmjOojTHIecTn.1u4VbEiZCoS0.QAG/cY1S',6,NULL),(19,'test@gmail.com','IcipourTester','$2y$10$SFuAV2Wr3k8S.kEUKlv0KexQURgBu4dHfRH0LTJRuC1PoIYnblTa2',6,NULL);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur_jeu`
--

DROP TABLE IF EXISTS `utilisateur_jeu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur_jeu` (
  `utilisateur_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jeu_id` int NOT NULL,
  PRIMARY KEY (`utilisateur_email`,`jeu_id`),
  KEY `jeu_id_ibfk1` (`jeu_id`),
  CONSTRAINT `jeu_id_ibfk1` FOREIGN KEY (`jeu_id`) REFERENCES `jeu` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur_jeu`
--

LOCK TABLES `utilisateur_jeu` WRITE;
/*!40000 ALTER TABLE `utilisateur_jeu` DISABLE KEYS */;
INSERT INTO `utilisateur_jeu` VALUES ('l.warflof@gmail.com',7),('producer@test.fr',143),('l.warflof@gmail.com',144),('user@test.fr',144),('cm@test.fr',145),('l.warflof@gmail.com',145),('l.warflof@gmail.com',154),('producer@test.fr',154),('l.warflof@gmail.com',155),('producer@test.fr',155),('l.warflof@gmail.com',160);
/*!40000 ALTER TABLE `utilisateur_jeu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `utilisateur_role_vw`
--

DROP TABLE IF EXISTS `utilisateur_role_vw`;
/*!50001 DROP VIEW IF EXISTS `utilisateur_role_vw`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `utilisateur_role_vw` AS SELECT 
 1 AS `email`,
 1 AS `role_id`,
 1 AS `nom_role`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `jeu_createur_vw`
--

/*!50001 DROP VIEW IF EXISTS `jeu_createur_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `jeu_createur_vw` AS select `jeu`.`ID` AS `ID`,`jeu`.`Titre` AS `Titre`,`jeu`.`createur_jeu_id` AS `createur_jeu_id`,`utilisateur`.`email` AS `email` from (`jeu` join `utilisateur` on((`jeu`.`createur_jeu_id` = `utilisateur`.`user_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `jeu_jouable_vw`
--

/*!50001 DROP VIEW IF EXISTS `jeu_jouable_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `jeu_jouable_vw` AS select `jeu`.`Titre` AS `Titre`,`jeu`.`jouable` AS `jouable`,`statut`.`Statut` AS `Statut` from (`jeu` join `statut` on((`jeu`.`jouable` = `statut`.`id_jouable`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `jeu_moteur_vw`
--

/*!50001 DROP VIEW IF EXISTS `jeu_moteur_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `jeu_moteur_vw` AS select `jeu`.`Titre` AS `Titre`,`jeu`.`id_moteur` AS `id_moteur`,`moteur`.`moteur_nom` AS `moteur_nom` from (`jeu` join `moteur` on((`jeu`.`id_moteur` = `moteur`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `jeu_nombre_joueur_vw`
--

/*!50001 DROP VIEW IF EXISTS `jeu_nombre_joueur_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `jeu_nombre_joueur_vw` AS select `jeu`.`ID` AS `ID`,`jeu`.`Titre` AS `Titre`,`nombre_joueur`.`id_nombre_joueur` AS `id_nombre_joueur`,`nombre_joueur`.`nom_nombre_joueur` AS `nom_nombre_joueur` from ((`jeu` join `jeu_nombre_joueur` on((`jeu`.`ID` = `jeu_nombre_joueur`.`jeu_id`))) join `nombre_joueur` on((`nombre_joueur`.`id_nombre_joueur` = `jeu_nombre_joueur`.`nombre_joueur_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `jeu_style_vw`
--

/*!50001 DROP VIEW IF EXISTS `jeu_style_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `jeu_style_vw` AS select `jeu`.`ID` AS `ID`,`jeu`.`Titre` AS `Titre`,`style`.`id_style` AS `id_style`,`style`.`style` AS `style` from ((`jeu` join `jeu_style` on((`jeu`.`ID` = `jeu_style`.`jeu_id`))) join `style` on((`jeu_style`.`style_id` = `style`.`id_style`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `jeu_support_vw`
--

/*!50001 DROP VIEW IF EXISTS `jeu_support_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `jeu_support_vw` AS select `jeu`.`ID` AS `ID`,`jeu`.`Titre` AS `Titre`,`support`.`id_support` AS `id_support`,`support`.`nom_support` AS `nom_support` from ((`jeu` join `jeu_support` on((`jeu`.`ID` = `jeu_support`.`jeu_id`))) join `support` on((`support`.`id_support` = `jeu_support`.`support_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `last_maj_user_vw`
--

/*!50001 DROP VIEW IF EXISTS `last_maj_user_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `last_maj_user_vw` AS select `last_maj`.`jeu_ID` AS `jeu_ID`,`last_maj`.`last_maj` AS `last_maj`,`last_maj`.`id_user` AS `id_user`,`utilisateur`.`pseudo` AS `pseudo`,`last_maj`.`commentaire` AS `commentaire` from (`last_maj` join `utilisateur` on((`last_maj`.`id_user` = `utilisateur`.`user_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `utilisateur_role_vw`
--

/*!50001 DROP VIEW IF EXISTS `utilisateur_role_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `utilisateur_role_vw` AS select `utilisateur`.`email` AS `email`,`utilisateur`.`role_id` AS `role_id`,`role`.`nom_role` AS `nom_role` from (`utilisateur` join `role` on((`utilisateur`.`role_id` = `role`.`id_role`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-17 11:25:24
