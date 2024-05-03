-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: milk_management
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `milk` varchar(10) NOT NULL,
  `quantity` int NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `cart-milk-fk_idx` (`milk`),
  KEY `cart-user-fk_idx` (`user`),
  CONSTRAINT `cart-milk-fk` FOREIGN KEY (`milk`) REFERENCES `milk` (`id`),
  CONSTRAINT `cart-user-fk` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (2,1,'SUA-AAA',1,_binary '\0'),(19,1,'SUA-ABA',1,_binary '\0'),(20,1,'SUA-ABB',1,_binary '\0'),(21,8,'SUA-ABB',1,_binary '\0'),(22,1,'SUA-AAA',1,_binary '\0'),(23,8,'SUA-AAA',4,_binary '\0'),(24,1,'SUA-AAA',2,_binary '\0');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `milk`
--

DROP TABLE IF EXISTS `milk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `milk` (
  `id` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `brand` varchar(5) NOT NULL,
  `type` varchar(40) NOT NULL,
  `weight` int NOT NULL,
  `price` int NOT NULL,
  `nutritionalIngredients` varchar(255) DEFAULT NULL,
  `benefit` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `milk-brand-fk_idx` (`brand`),
  CONSTRAINT `milk-brand-fk` FOREIGN KEY (`brand`) REFERENCES `milk_brand` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `milk`
--

LOCK TABLES `milk` WRITE;
/*!40000 ALTER TABLE `milk` DISABLE KEYS */;
INSERT INTO `milk` VALUES ('SUA-AAA','Sữa ZZZ','ABC','Sữa bột',180,180000,'','','hyperledger_logo_icon_170005-1700588862031.png',_binary ''),('SUA-ABA','Sữa ABA','ABC','Sữa nước',180,180000,'Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon','Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon Ngon','image-1700581210021.png',_binary ''),('SUA-ABB','Sữa ABB','ABC','Sữa bột',180,180000,'','','default.jpg',_binary ''),('SUA-ABC','Sữa SUAA','ABC','Sữa bột',180,180000,'','','image-1700561181104.png',_binary '');
/*!40000 ALTER TABLE `milk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `milk_brand`
--

DROP TABLE IF EXISTS `milk_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `milk_brand` (
  `id` varchar(5) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `milk_brand`
--

LOCK TABLES `milk_brand` WRITE;
/*!40000 ALTER TABLE `milk_brand` DISABLE KEYS */;
INSERT INTO `milk_brand` VALUES ('ABC','ABCDE','18C Cô Đơ','1234567891','abc@gmail.com',_binary ''),('DEC','Hãng DECI','18C Cô Đa','1234567891','dec@gmail.com',_binary ''),('KLM','Hãng KLM','19 Linh Ca','03939393321','klm@gmail.com',_binary ''),('XYZ','Hãng XYZ','19 Linh Trung','03939393939','sasasa@gmail.com',_binary '');
/*!40000 ALTER TABLE `milk_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `total` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `carts` varchar(255) NOT NULL,
  `address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order-user-fk_idx` (`user`),
  CONSTRAINT `order-user-fk` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,2,180000,3,'2','','','',''),(2,1,180000,0,'19','','','',''),(3,1,180000,0,'20','','','',''),(4,8,180000,0,'21','Hồ Chí Minh','123454321','sasa@gmail.com','Pham Doan Sasasa'),(5,1,180000,0,'22','Gò vấp','070807321','khoi021@gmail.com','Nguyễn Đình Khôi'),(6,8,720000,2,'23','Hồ Chí Minh','123454321','sasa@gmail.com','Pham Doan Sasasa'),(7,1,360000,3,'24','Hồ Chí Minh','123454321','sasa@gmail.com','Pham Doan Sasasa');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sex` int NOT NULL DEFAULT '1',
  `address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '123456',
  `role` int NOT NULL DEFAULT '0',
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Phạm Văn Admin',1,'Cong Hoa','0392831234','admin@gmail.com','123456',1,_binary ''),(2,'Nguyễn Đình Khôi',1,'Gò Vấp','0708076321','khoi020401@gmail.com','123456',0,_binary ''),(3,'Pham Doan Kiem',1,'17A Cong Hoa','03739265642','kiem@gmail.com','123456',0,_binary ''),(4,'Nguyễn Đình Khôi',0,'Gò Vấp','0708076321','khoi020401@gmail.com','123456',0,_binary ''),(5,'Nguyễn Thị Bai',0,'Cong Hoa','03739265642','b@gmail.com','123456',0,_binary ''),(6,'Nguyễn Thị Ca',1,'Cong Hoa','03739265642','c@gmail.com','123456',0,_binary ''),(7,'Phan Văn Dao',1,'Gò Vấp','0392817384','dao@gmail.com','123456',0,_binary ''),(8,'Pham Doan Sasasa',1,'Hồ Chí Minh','123454321','sasa@gmail.com','123456',0,_binary '');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-26 17:38:32
