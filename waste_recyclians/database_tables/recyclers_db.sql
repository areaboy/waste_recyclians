-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: recyclers_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `timer1` varchar(100) DEFAULT NULL,
  `userid` text DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` varchar(400) DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (18,12,'hello','1726946370','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png',NULL),(19,13,'nice one','1726953776','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png',NULL),(20,21,'Nice Recyclings','1727034455','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png',NULL),(21,22,'Good Recycling. I will get back to you','1727247430','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_desc` varchar(300) DEFAULT NULL,
  `created_time` varchar(200) DEFAULT NULL,
  `timing` varchar(200) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (7,'example@gmail.com','Green Hill Recycling','Greenhill Recycling is a social enterprise born out of the urgent need to address the growing pollution crisis across the African continent.  ','Saturday, September 21, 2024, 2:31 pm','1726943482','66ef10fa6547417269434821aa56542105c4ce25af741265904991fwaste1.png','No 6 PFN Close, Mechanic Village Rd, Oshodi-Isolo, Lagos 102214, Lagos',6.527437,3.307276,'Nigeria','Nigeria','https://ghrng.com/'),(8,'example2@gmail.com','Agoa Waste Management Company Limited','\r\nAgoa waste management company (AWMC) is a firm that started business in Nigeria in 2006 and operates in areas of Drainage Management, Environmental & Industrial Waste Recyclings','Saturday, September 21, 2024, 2:54 pm','1726944892','66ef167cda2951726944892a43bce306438a823859928e75fb5245fwaste5.png','No. 124 A, Ayilara Bus Stop, By UBA Bank, Ojuelegba Rd, Lagos',6.511821,3.343678,'Nigeria','Nigeria','https://www.agoawaste.com/');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userid` text DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `reciever_id` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `timing` varchar(100) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title_seo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (61,'21','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','unread','post','1727034382','Waste Recycling by Esedo Fredrick','66f0740e3148b1727034382bc7339278fa6d35ba29ec32605309946'),(62,'21','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','unread','comment','1727034455','Waste Recycling by Esedo Fredrick','66f0740e3148b1727034382bc7339278fa6d35ba29ec32605309946'),(63,'22','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','unread','post','1727034606','Waste Recycling by Esedo Fredrick','66f074ee9f14e1727034606b91d2c9b3e41fe5e46b192719f29ea3a'),(64,'22','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','unread','post_like','1727034636','Waste Recycling by Esedo Fredrick','66f074ee9f14e1727034606b91d2c9b3e41fe5e46b192719f29ea3a'),(65,'22','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','unread','comment','1727247430','Waste Recycling by Esedo Fredrick','66f074ee9f14e1727034606b91d2c9b3e41fe5e46b192719f29ea3a');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `like_count` text DEFAULT NULL,
  `timer1` varchar(100) DEFAULT NULL,
  `userid` text DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_like`
--

LOCK TABLES `post_like` WRITE;
/*!40000 ALTER TABLE `post_like` DISABLE KEYS */;
INSERT INTO `post_like` VALUES (16,12,'1','1726946411','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png'),(17,13,'1','1726953783','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png'),(18,22,'1','1727034636','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png');
/*!40000 ALTER TABLE `post_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title_seo` varchar(200) DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timer` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `userphoto` varchar(300) DEFAULT NULL,
  `userid` text DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  `total_comments` varchar(100) DEFAULT NULL,
  `total_like` varchar(20) DEFAULT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  `country_nickname` varchar(100) DEFAULT NULL,
  `reward_type` varchar(100) DEFAULT NULL,
  `ai_model` varchar(100) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL,
  `recycle_image` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (21,'Waste Recycling by Esedo Fredrick','66f0740e3148b1727034382bc7339278fa6d35ba29ec32605309946','The image contains 5 plastic water bottles.','1727034382','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','200','1','0','Nigeria','Nigerians','Cash','Google Gemini AI',NULL,'66f0740e3148b1727034382bc7339278fa6d35ba29ec32605309946waste3.png'),(22,'Waste Recycling by Esedo Fredrick','66f074ee9f14e1727034606b91d2c9b3e41fe5e46b192719f29ea3a','The image contains three crumpled plastic water bottles.','1727034606','Esedo Fredrick','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','200','1','1','Nigeria','Nigerians','Gift','OpenAI ChatGPT',NULL,'66f074ee9f14e1727034606b91d2c9b3e41fe5e46b192719f29ea3awaste5.png');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created_time` varchar(200) DEFAULT NULL,
  `timing` varchar(200) DEFAULT NULL,
  `userid` varchar(300) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lat` varchar(30) DEFAULT NULL,
  `lng` varchar(30) DEFAULT NULL,
  `map_zoom` varchar(10) DEFAULT NULL,
  `country_nickname` varchar(30) DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (14,'nigeria_test@gmail.com','Esedo Fredrick','$2y$04$VvlE2.y.Y4oJLwHXyfhE5.DR4GXzNb7m1O1KKcddT1Xpz/rgh0cUS','Saturday, September 21, 2024, 2:41 pm','1726944118','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406b','66ef1376c104b1726944118739209c23d124903cb8823e4fcde406bAnnBall.png','Nigeria','No 14 independent Layout, Abapa, Enugu State, Nigeria ','9.081999','8.675277','7','Nigerians','200');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'recyclers_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-25 14:39:47
