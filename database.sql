-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: library
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `isbn` char(13) NOT NULL,
  `book_name` varchar(256) NOT NULL,
  `book_cover_path` varchar(256) NOT NULL,
  `book_description` text,
  `copies` int unsigned NOT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES ('12','ab','/static/images/bookcover-1653912778663.png','aaa',43),('1212','1212','static/images/1657488776cat.jpg','1212',121),('213dsd','overlord 2 ','/static/images/bookcover-1654001992528.png','hehessd f sddsd',4),('23sdf','Overlord 3','/static/images/bookcover-1654017817623.png','aksdhkajsdh',8),('a1212','overlord','/static/images/bookcover-1654001969045.png','hehe',4),('aa12','aaa','/static/images/bookcover-1653912826114.png','aaa',0),('asdas','asdasd','/static/images/bookcover-1654337442043.png','asdasd',0);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cookies`
--

DROP TABLE IF EXISTS `cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cookies` (
  `sessionId` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cookies`
--

LOCK TABLES `cookies` WRITE;
/*!40000 ALTER TABLE `cookies` DISABLE KEYS */;
INSERT INTO `cookies` VALUES ('SCvLCvWqFjCCN9rpXessrg==','admin'),('xV0ntgcqazTIBgVIb/jwEg==','admin'),('fcVPRrrAokqNPaVAAuHMvw==','admin'),('kNm+r1GwKa8kBGve9ztc6g==','admin'),('MVyVZGrD1KjxvU8prgXafQ==','a'),('TEJuZnL8cOrsMIhyXLe9KA==','admin'),('/Zg3XCH5tnF3rvecHYjdkA==','admin'),('acmuLmhCIxEqTbAGwFlhsA==','admin'),('4GpRNMp9GsJIZcZrJn9drA==','a'),('PKHESlcN0g7lrHWX+FDfrg==','r'),('9vE5nVvq5OXbQOXytw0Lnw==','admin'),('CO6K9//f45zT+fDYp2hSUw==','admin'),('INBWJFBdD1pFaEuWlbS5fg==','admin'),('8wnEfE20nPROlfkn0CFmkw==','admin'),('pMNqI24gagJM/z/sbbX2hg==','admin'),('ayS6TrPEM2jxaJgTxLF1tA==','qq'),('6gCamgwr1lvqzovMEk9nOA==','admin'),('nEKTaTdcO5t6cfse/WA0jQ==','admin'),('HML5+1xZHhflB7thFA8RKg==','rt'),('QdGnGkJzD6MBTSzgjsARzQ==','aa');
/*!40000 ALTER TABLE `cookies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issued_books`
--

DROP TABLE IF EXISTS `issued_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `issued_books` (
  `isbn` char(13) NOT NULL,
  `username` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issued_books`
--

LOCK TABLES `issued_books` WRITE;
/*!40000 ALTER TABLE `issued_books` DISABLE KEYS */;
INSERT INTO `issued_books` VALUES ('213dsd','rt'),('23sdf','rt'),('12','aa');
/*!40000 ALTER TABLE `issued_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests` (
  `isbn` char(13) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES ('admin','r','return');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(256) NOT NULL,
  `salt` varchar(12) NOT NULL,
  `password` varchar(65) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('a','a4232019','P5bhOTuz0vhiTb3qPUuZUYgG0QWc/ao/ZnOhi9GyQNU=',0),('aa','b441460b','33e46960c7ddbefe69908ace830c770f813e2457bd02301d503be91c17e8a410',0),('admin','cecd26cd','312575295b0a27a2c7cea16f28ef9fd385dcaf6e34075ac2af121523ac59fa31',1),('asasasa','746c42d0','8820e04d600f014ed4d073df980e3192fbb6feaf5e17ee8df8ee0ca8c0e6bc39',0),('asasasasas','90e493a5','ef366ec81b9e4dfc763f4bb5fc70b091f3855e76dc4b76f755ad83203fa4a6a0',0),('asdasdas','2ef86423','e93f7427b6281d2c50d54d156c26be24f3869ba5ee207ef1f15a87f2861f35f4',0),('asddasdasd','f5a055f6','eee15f2a6c2b8ef480c9dff6947f30c5c3ddba60e1b3a7229d1803e65e5606d8',0),('ax','f94b6d17','93fca15e8bd8877b37c9d98de6dda743f056d3523733424cd037a74536da2a27',0),('m','742885e3','YnF63YMOcZevx5GZoDPxSN1ymT0gzkW+jJqrsEM4CnY=',0),('qq','ed8fd0f7','5ab31fe46e4900dabb3ad2f9e221ba4207e56d9b646e530f504a9e4f94a4898f',0),('r','f3d97e96','4wUG0egvMWSV4dM7O+S5N981T6axat2uAT0w/GffTQk=',0),('rt','bf021f69','64b68059f2c60f149af5d6b96cfd014b4a6cb7a613a068b5ebae3747b7d6abc1',0),('vv','5ee92e23','50dfcf9657ceef23522ac91ef457f07826218c0dce7107397b6ba03ce8831c9e',0),('xxc','070e776c','cc2b516d10b810660fe6d2568ac5bedeb54238c4cd227fd68c8c775329c299d1',0),('zz','a297e481','5646ed18557b2e245caad0933721087b82cfccd3ceb87bd099c50b495cef10df',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-11 22:21:25
