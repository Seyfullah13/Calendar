-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: wave
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.22.04.1

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
-- Table structure for table `announcement_user`
--

DROP TABLE IF EXISTS `announcement_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement_user` (
  `announcement_id` int unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  KEY `announcement_user_announcement_id_index` (`announcement_id`),
  KEY `announcement_user_user_id_index` (`user_id`),
  CONSTRAINT `announcement_user_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `announcement_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement_user`
--

LOCK TABLES `announcement_user` WRITE;
/*!40000 ALTER TABLE `announcement_user` DISABLE KEYS */;
INSERT INTO `announcement_user` VALUES (1,12),(2,12),(1,1),(2,1);
/*!40000 ALTER TABLE `announcement_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'Wave 1.0 Released','We have just released the first official version of Wave. Click here to learn more!','<p>It\'s been a fun Journey creating this awesome SAAS starter kit and we are super excited to use it in many of our future projects. There are just so many features that Wave has that will make building the SAAS of your dreams easier than ever before.</p>\n<p>Make sure to stay up-to-date on our latest releases as we will be releasing many more features down the road :)</p>\n<p>Thanks! Talk to you soon.</p>','2018-05-20 23:19:00','2018-05-21 00:38:02'),(2,'Wave 2.0 Released','Wave V2 has been released with some awesome new features. Be sure to read up on what\'s new!','<p>This new version of Wave includes the following updates:</p><ul><li>Update to the latest version of Laravel</li><li>New Payment integration with Paddle</li><li>Rewritten theme support</li><li>Deployment integration</li><li>Much more awesomeness</li></ul><p>Be sure to check out the official Wave v2 page at <a href=\"https://devdojo.com/wave\">https://devdojo.com/wave</a></p>','2020-03-20 23:19:00','2020-03-21 00:38:02');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_keys`
--

DROP TABLE IF EXISTS `api_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_keys` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_tokens_token_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_keys`
--

LOCK TABLES `api_keys` WRITE;
/*!40000 ALTER TABLE `api_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message_id` bigint unsigned NOT NULL,
  `original_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stored_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `attachments_message_id_foreign` (`message_id`),
  CONSTRAINT `attachments_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_guests`
--

DROP TABLE IF EXISTS `booking_guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_guests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_guests`
--

LOCK TABLES `booking_guests` WRITE;
/*!40000 ALTER TABLE `booking_guests` DISABLE KEYS */;
INSERT INTO `booking_guests` VALUES (1,'Emilie-Rose','Ceresa','eceres.606363@guest.booking.com','+330673823154',NULL,'2024-08-09 19:24:18','2024-08-22 09:00:05'),(2,'Hamou','Firaz','hfiraz.582690@guest.booking.com','+49 176 93102159',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:06'),(3,'Mirza','Baig','mbaig.590361@guest.booking.com','+1 416 432 4551',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:07'),(4,'Aymane','Itoual','aitoua.753488@guest.booking.com','+212 644 611154',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:07'),(5,'Caputo','Beatrice','cbeatr.328592@guest.booking.com','+39 327 622 7299',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:08'),(6,'Evgvenii','Lavrenchuk','elavre.152310@guest.booking.com','+375293988176',NULL,'2024-08-09 19:24:57','2024-08-22 09:00:08'),(7,'Conchi','Bermúdez','cbermu.108775@guest.booking.com','+34 650 91 82 88',NULL,'2024-08-09 19:24:57','2024-08-22 09:00:16'),(8,'VITORINO','ILHEU','vilheu.728947@guest.booking.com','+212 661104737',NULL,'2024-08-09 19:24:58','2024-08-22 09:00:13'),(9,'yousef','Azzaoui','yazzao.571116@guest.booking.com','+32 751841873',NULL,'2024-08-09 19:24:58','2024-08-22 09:00:13'),(10,'Reda','Cherquy','rcherq.426049@guest.booking.com','+33 6 30 58 50 69',NULL,'2024-08-09 19:24:59','2024-08-22 09:00:14'),(11,'towana','tahir','ttahir.599723@guest.booking.com','+46 76 295 31 49',NULL,'2024-08-09 19:25:00','2024-08-22 09:00:15'),(12,'Sebastien','Boher','sboher.134678@guest.booking.com','+212631463913',NULL,'2024-08-09 19:25:00','2024-08-22 09:00:15'),(13,'Arnaud','Pignard','apignard@gmail.com','+33633590674',NULL,'2024-08-09 19:25:02','2024-08-22 09:00:17'),(14,'Cheikh','DIENG','Cheikh-tidiane.dieng@ugb.edu.sn','+221776335307',NULL,'2024-08-09 19:25:02','2024-08-22 09:00:18'),(15,'Alyae','Belhadj','','212622826635',NULL,'2024-08-09 19:25:03','2024-08-22 09:00:18'),(16,'Hassan','Sheekh','','4790290980',NULL,'2024-08-09 19:25:03','2024-08-22 09:00:19'),(17,'Anita','Saleh','','212638050968',NULL,'2024-08-09 19:25:04','2024-08-19 23:00:14'),(18,'Mustapha','Gourari','','34697837517',NULL,'2024-08-09 19:25:04','2024-08-22 09:00:20'),(19,'Hakim','Boubbiche','','33786374751',NULL,'2024-08-09 19:25:05','2024-08-22 09:00:26'),(20,'Susitha','Jayaratne','','17034081395',NULL,'2024-08-09 19:25:05','2024-08-22 09:00:21'),(21,'Boiarsky','Jerome','','33689155727',NULL,'2024-08-09 19:25:06','2024-08-22 09:00:22'),(22,'محمد','الراشد','','966598785979',NULL,'2024-08-09 19:25:06','2024-08-22 09:00:22'),(23,'Youssef','Lmajdoub','','33609370606',NULL,'2024-08-09 19:25:07','2024-08-22 09:00:24'),(24,'Lacey','Alexander','','18566301577',NULL,'2024-08-09 19:25:08','2024-08-17 23:00:21'),(25,'Abdelilah','Ajebbar','','212661989991',NULL,'2024-08-09 19:25:08','2024-08-22 09:00:24'),(26,'Ilka','Mouaq','','4915159097017',NULL,'2024-08-09 19:25:09','2024-08-22 09:00:25'),(27,'Yassine','Kassab','','221774715278',NULL,'2024-08-09 19:25:10','2024-08-22 09:00:26'),(28,'Sameer','Merchant','(noemailaliasavailable)','12812364801',NULL,'2024-08-09 19:25:10','2024-08-22 09:00:27'),(29,'Nacho','Moreno','natxo.moreno@gmail.com','+34646026312',NULL,'2024-08-09 19:25:11','2024-08-22 09:00:28'),(30,'Dilruba','Akhter','krishtiakhter90@hotmail.com','+61424187592',NULL,'2024-08-09 19:25:12','2024-08-22 09:00:28'),(31,'Yasuhiro','Ito','hiro1@itoyasu.co.jp','+819064657458',NULL,'2024-08-09 19:25:12','2024-08-22 09:00:29'),(32,'Olivier','Olivier','Jelbinihouda0@gmail.com','',NULL,'2024-08-09 19:25:12','2024-08-22 09:00:29'),(33,'Gaëtan','Honore','ghonore@cegetel.net','+33628547934',NULL,'2024-08-09 19:25:13','2024-08-22 09:00:30'),(34,'Lahcene','Baaziz','','',NULL,'2024-08-09 19:28:02','2024-08-22 09:00:32'),(35,'obisesan','adeyinka','oadeyi.809623@guest.booking.com','',NULL,'2024-08-09 19:28:03','2024-08-22 09:00:32'),(36,'Fatiha','Boubhri','fboubh.931286@guest.booking.com','+33 6 23 57 76 87',NULL,'2024-08-09 19:28:04','2024-08-22 09:00:33'),(37,'Chakib','Benseria','cbense.947496@guest.booking.com','+34 671 74 79 96',NULL,'2024-08-09 19:28:04','2024-08-22 09:00:33'),(38,'Kelvin','Omoijade','komoij.921420@guest.booking.com','+353 89 973 3681',NULL,'2024-08-09 19:28:05','2024-08-22 09:00:34'),(39,'Ghizlane','Toutouh','gtouto.791167@guest.booking.com','+212 655 576679',NULL,'2024-08-09 19:28:05','2024-08-22 09:00:34'),(40,'EDDAHDI','Younès','eyoune.119396@guest.booking.com','+33 7 53 58 42 59',NULL,'2024-08-09 19:28:06','2024-08-22 09:00:35'),(41,'Hafida','Buduh','hbuduh.539126@guest.booking.com','+32 494 34 28 10',NULL,'2024-08-09 19:28:06','2024-08-22 09:00:36'),(42,'Abdellah','Samlani','asamla.610873@guest.booking.com','+33 643326914',NULL,'2024-08-09 19:28:07','2024-08-22 09:00:36'),(43,'Amine','Izyajen','aizyaj.497045@guest.booking.com','+33 6 37 87 13 94',NULL,'2024-08-09 19:28:07','2024-08-22 09:00:37'),(44,'ayoube','bahoussi','abahou.689415@guest.booking.com','+212 212613437955',NULL,'2024-08-09 19:28:08','2024-08-22 09:00:38'),(45,'Benoit','Loyer','beaugruau@innocent.com','+14188372674',NULL,'2024-08-09 19:28:08','2024-08-22 09:00:39'),(46,'Mohamed','Wakrim','','33601366798',NULL,'2024-08-09 19:28:09','2024-08-22 09:00:39'),(47,'Alex','Daugherty','','19182321967',NULL,'2024-08-09 19:28:10','2024-08-22 09:00:40'),(48,'Soufiane','Massit','','212628554776',NULL,'2024-08-09 19:28:11','2024-08-22 09:00:51'),(49,'Mohammed','Alamk','','33749163428',NULL,'2024-08-09 19:28:11','2024-08-22 09:00:42'),(50,'Youssef','Aguilou','','37061379848',NULL,'2024-08-09 19:28:12','2024-08-22 09:00:43'),(51,'On','To','','447503955386',NULL,'2024-08-09 19:28:13','2024-08-22 09:00:43'),(52,'Saad','Keddar','','212669259663',NULL,'2024-08-09 19:28:14','2024-08-12 23:00:45'),(53,'Serena','Boukraa','','33762845488',NULL,'2024-08-09 19:28:14','2024-08-22 09:00:44'),(54,'Safia','Madani','','13146621123',NULL,'2024-08-09 19:28:15','2024-08-22 09:00:45'),(55,'Malak','Larsen','','4593936293',NULL,'2024-08-09 19:28:15','2024-08-22 09:00:46'),(56,'Kevin','Osminski','','447762326218',NULL,'2024-08-09 19:28:16','2024-08-19 23:00:43'),(57,'Jordan','Lorsold','','33778021523',NULL,'2024-08-09 19:28:16','2024-08-22 09:00:47'),(58,'Abdelali','Mahboub','','212665295862',NULL,'2024-08-09 19:28:17','2024-08-22 09:00:47'),(59,'Fatima','Hadih','','32487365599',NULL,'2024-08-09 19:28:18','2024-08-22 09:00:48'),(60,'Norddine','Akilani','','212769916603',NULL,'2024-08-09 19:28:18','2024-08-22 09:00:49'),(61,'Imane','Jabbouri','','212667969465',NULL,'2024-08-09 19:28:19','2024-08-09 19:28:19'),(62,'Mohssine','Maaroufi','','33745468107',NULL,'2024-08-09 19:28:19','2024-08-22 09:00:49'),(63,'Hasna','Boulahdrt','','33777819004',NULL,'2024-08-09 19:28:20','2024-08-22 09:00:50'),(64,'Alexandra','Vincent','','15147991725',NULL,'2024-08-09 19:28:21','2024-08-22 09:00:52'),(65,'Yasmine','Maknaoui','','212703255339',NULL,'2024-08-09 19:28:22','2024-08-20 23:00:57'),(66,'Prisca','Dablé','','33751401840',NULL,'2024-08-09 19:28:22','2024-08-22 09:00:53'),(67,'Laetitia','Lhor','Zina.laouina13@gmail.com','212762209318',NULL,'2024-08-09 19:28:23','2024-08-22 09:00:54'),(68,'Silvia','Zaconia','','393485692863',NULL,'2024-08-09 19:28:24','2024-08-22 09:00:55'),(69,'Kexin','Gui','guikexinfr@outlook.com','',NULL,'2024-08-09 19:28:24','2024-08-22 09:00:57'),(70,'Client','samsar','Jelbinihouda0@gmail.com','',NULL,'2024-08-09 19:28:25','2024-08-22 09:00:57'),(71,'Houda','Pignard','jelbinihouda03@gmail.com','+33776696997',NULL,'2024-08-09 19:28:26','2024-08-22 09:00:58'),(72,'Mehdy','Diabi','mdiabi.165721@guest.booking.com','+33 7 67 45 77 48',NULL,'2024-08-14 16:00:05','2024-08-22 09:00:05'),(73,'Laila','Balli','','33786416159',NULL,'2024-08-15 14:00:22','2024-08-22 09:00:23'),(74,'Naima','Rmidi','','33614857606',NULL,'2024-08-16 11:00:55','2024-08-22 09:00:55'),(75,'Ali','essakhi','aessak.717878@guest.booking.com','+212 679 823606',NULL,'2024-08-16 18:00:39','2024-08-22 09:00:38'),(76,'Sergio','Alvarez','','34698191843',NULL,'2024-08-20 19:00:55','2024-08-22 09:00:56'),(82,'khadi','DIALLO','khadi@gmail.com','+33751041040',NULL,'2024-08-21 12:15:37','2024-08-21 12:17:00'),(83,'josef','josef','josef@gmail.com','+33657884903',NULL,'2024-08-21 12:21:07','2024-08-21 12:21:07'),(84,'Mehdi','Dorbani','','33767041146',NULL,'2024-08-21 23:01:00','2024-08-22 09:00:53');
/*!40000 ALTER TABLE `booking_guests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_statuses`
--

DROP TABLE IF EXISTS `booking_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_statuses`
--

LOCK TABLES `booking_statuses` WRITE;
/*!40000 ALTER TABLE `booking_statuses` DISABLE KEYS */;
INSERT INTO `booking_statuses` VALUES (1,'En attente','2024-08-09 13:17:50','2024-08-09 13:17:50'),(2,'En cours de traitement','2024-08-09 13:17:50','2024-08-09 13:17:50'),(3,'Confirmé','2024-08-09 13:17:50','2024-08-09 13:17:50'),(4,'Annulée','2024-08-09 13:17:50','2024-08-09 13:17:50');
/*!40000 ALTER TABLE `booking_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint unsigned NOT NULL,
  `preparation_time` time DEFAULT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `number_of_nights` int NOT NULL,
  `number_of_guests` int DEFAULT NULL,
  `number_of_adults` int DEFAULT NULL,
  `number_of_children` int DEFAULT NULL,
  `number_of_animals` int DEFAULT NULL,
  `external_reservation_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fees` double DEFAULT NULL,
  `total_taxes` double DEFAULT NULL,
  `total_payout` double DEFAULT NULL,
  `booked_at` datetime NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `booking_guest_id` bigint unsigned DEFAULT NULL,
  `partenaire_id` bigint unsigned DEFAULT NULL,
  `booking_status_id` bigint unsigned DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_property_id_foreign` (`property_id`),
  KEY `bookings_booking_guest_id_foreign` (`booking_guest_id`),
  KEY `bookings_partenaire_id_foreign` (`partenaire_id`),
  KEY `bookings_booking_status_id_foreign` (`booking_status_id`),
  KEY `bookings_currency_id_foreign` (`currency_id`),
  CONSTRAINT `bookings_booking_guest_id_foreign` FOREIGN KEY (`booking_guest_id`) REFERENCES `booking_guests` (`id`),
  CONSTRAINT `bookings_booking_status_id_foreign` FOREIGN KEY (`booking_status_id`) REFERENCES `booking_statuses` (`id`),
  CONSTRAINT `bookings_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `bookings_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`),
  CONSTRAINT `bookings_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,1,'00:00:00','2024-05-18 15:00:00','2024-05-24 11:00:00',6,2,2,0,0,'5697efee-4576-45d0-93a7-08dcf01b0acc@reservations.hospitable.com','5697efee-4576-45d0-93a7-08dcf01b0acc@reservations.hospitable.com','Emilie-Rose Ceresa (4355029599)',0,0,0,'2024-08-22 09:00:06','250ee0d9e9f4391bf48e8aef09019805',NULL,'2024-08-09 19:24:55','2024-08-22 09:00:06',1,2,3,46),(2,1,'00:00:00','2024-08-13 15:00:00','2024-08-16 11:00:00',3,2,2,0,0,'1167f3a1-9411-4096-b0e9-96e3d53d0c16@reservations.hospitable.com','1167f3a1-9411-4096-b0e9-96e3d53d0c16@reservations.hospitable.com','Hamou Firaz (4399433144)',0,0,0,'2024-08-22 09:00:06','92f4a6eed3f44b64507c7befe93310a4',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:06',2,2,3,46),(3,1,'00:00:00','2024-04-28 15:00:00','2024-05-05 11:00:00',7,2,2,0,0,'7c81f0d6-4bf6-4cac-8e9a-8950a31aae29@reservations.hospitable.com','7c81f0d6-4bf6-4cac-8e9a-8950a31aae29@reservations.hospitable.com','Mirza Baig (4418217851)',0,0,0,'2024-08-22 09:00:07','24612b8e8736c25bb4d8c06e119134a2',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:07',3,2,3,46),(4,1,'00:00:00','2024-07-22 15:00:00','2024-07-28 11:00:00',6,3,3,0,0,'485304d7-ebf9-4367-abbc-a9fae7342d34@reservations.hospitable.com','485304d7-ebf9-4367-abbc-a9fae7342d34@reservations.hospitable.com','Aymane Itoual (4451335580)',0,0,0,'2024-08-22 09:00:07','0d0fbecfc021ef0e7d8e3b4932bbb005',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:07',4,2,3,46),(5,1,'00:00:00','2024-05-24 15:00:00','2024-05-31 11:00:00',7,2,2,0,0,'04dfcb6d-d248-47a1-88c8-5f01f9d7edbf@reservations.hospitable.com','04dfcb6d-d248-47a1-88c8-5f01f9d7edbf@reservations.hospitable.com','Caputo Beatrice (4482332334)',0,0,0,'2024-08-22 09:00:08','e3ad29be0cdc6df7a1aefa983396bba1',NULL,'2024-08-09 19:24:56','2024-08-22 09:00:08',5,2,3,46),(6,1,'00:00:00','2024-09-18 15:00:00','2024-09-21 11:00:00',3,2,2,0,0,'29510b4a-dd09-4d99-a754-a2d935bcecd2@reservations.hospitable.com','29510b4a-dd09-4d99-a754-a2d935bcecd2@reservations.hospitable.com','Evgvenii Lavrenchuk (4568404110)',0,0,0,'2024-08-22 09:00:09','5d1ce5296d9b036280bf4d0b5b537b1f',NULL,'2024-08-09 19:24:57','2024-08-22 09:00:09',6,2,3,46),(7,1,'00:00:00','2024-06-27 15:00:00','2024-07-01 11:00:00',4,2,2,0,0,'62fb35f6-4d32-40e1-973c-10d483d40a35@reservations.hospitable.com','62fb35f6-4d32-40e1-973c-10d483d40a35@reservations.hospitable.com','Conchi Bermúdez (4660469955)',0,0,0,'2024-08-22 09:00:12','d36e11a21d845f74313c8cd80ad41710',NULL,'2024-08-09 19:24:58','2024-08-22 09:00:12',7,2,3,46),(8,1,'00:00:00','2024-05-31 15:00:00','2024-06-02 11:00:00',2,2,2,0,0,'1e991c32-c6c7-4c46-9eeb-0c3332b87050@reservations.hospitable.com','1e991c32-c6c7-4c46-9eeb-0c3332b87050@reservations.hospitable.com','VITORINO ILHEU (4689742911)',0,0,0,'2024-08-22 09:00:13','b8d637d56f94207e6634a32c29153202',NULL,'2024-08-09 19:24:58','2024-08-22 09:00:13',8,2,3,46),(9,1,'00:00:00','2024-07-18 15:00:00','2024-07-20 11:00:00',2,2,2,0,0,'843247ec-26e5-4d7a-975b-949aace725b8@reservations.hospitable.com','843247ec-26e5-4d7a-975b-949aace725b8@reservations.hospitable.com','yousef El Azzaoui (4714119332)',0,0,0,'2024-08-22 09:00:14','c8d66d87f6717b2e9125d299d03ccb27',NULL,'2024-08-09 19:24:59','2024-08-22 09:00:14',9,2,3,46),(10,1,'00:00:00','2024-04-22 15:00:00','2024-04-25 11:00:00',3,2,2,0,0,'939e1093-71fb-4e2c-9a32-4d79813dc41a@reservations.hospitable.com','939e1093-71fb-4e2c-9a32-4d79813dc41a@reservations.hospitable.com','Reda Cherquy (4844795001)',0,0,0,'2024-08-22 09:00:14','cc68589db27775a412e0ddb742ba7248',NULL,'2024-08-09 19:24:59','2024-08-22 09:00:14',10,2,3,46),(11,1,'00:00:00','2024-07-04 15:00:00','2024-07-05 11:00:00',1,1,1,0,0,'2a1e6fc3-836a-438b-807a-53ba4fb96242@reservations.hospitable.com','2a1e6fc3-836a-438b-807a-53ba4fb96242@reservations.hospitable.com','towana tahir (4906651672)',0,0,0,'2024-08-22 09:00:15','f938e61bbacc724de6874d9a848e899c',NULL,'2024-08-09 19:25:00','2024-08-22 09:00:15',11,2,3,46),(12,1,'00:00:00','2024-07-16 15:00:00','2024-07-17 11:00:00',1,2,2,0,0,'7e5dae6e-db0a-408f-955b-2a4dce6f88f3@reservations.hospitable.com','7e5dae6e-db0a-408f-955b-2a4dce6f88f3@reservations.hospitable.com','Sebastien Boher (4924380802)',0,0,0,'2024-08-22 09:00:16','0310efb0b35e30bbeaae9051bf97388e',NULL,'2024-08-09 19:25:00','2024-08-22 09:00:16',12,2,3,46),(13,1,'00:00:00','2024-05-09 15:00:00','2024-05-13 11:00:00',4,2,2,0,0,'e716f967-82b7-4d7f-8d66-8c2f113fd06c@reservations.hospitable.com','e716f967-82b7-4d7f-8d66-8c2f113fd06c@reservations.hospitable.com','Conchi Bermúdez (4930834586)',0,0,0,'2024-08-22 09:00:17','d114931c12c33e25307f9cfe492c5dbe',NULL,'2024-08-09 19:25:01','2024-08-22 09:00:17',7,2,3,46),(14,1,'00:00:00','2024-06-18 15:00:00','2024-06-22 11:00:00',4,2,2,0,0,'d5ea393c-9e3c-468d-88e6-7e3e91d920d4@reservations.hospitable.com','d5ea393c-9e3c-468d-88e6-7e3e91d920d4@reservations.hospitable.com','Arnaud Pignard (6JYFM0)',0,0,0,'2024-08-22 09:00:17','cd16ae5420caae86f370f5d2900f7a55',NULL,'2024-08-09 19:25:02','2024-08-22 09:00:17',13,2,3,46),(15,1,'00:00:00','2024-08-26 15:00:00','2024-09-07 11:00:00',12,2,2,0,0,'158dd4ee-dfd1-4d8b-84ef-76f128204c2d@reservations.hospitable.com','158dd4ee-dfd1-4d8b-84ef-76f128204c2d@reservations.hospitable.com','Cheikh Tidiane DIENG (HCZB4L)',0,0,0,'2024-08-22 09:00:18','3912168eb3ec6a11231dffb65e33936e',NULL,'2024-08-09 19:25:03','2024-08-22 09:00:18',14,2,3,46),(16,1,'00:00:00','2024-06-07 15:00:00','2024-06-09 11:00:00',2,1,1,0,0,'473af253-ccfb-4e25-bb82-e280e47af674@reservations.hospitable.com','473af253-ccfb-4e25-bb82-e280e47af674@reservations.hospitable.com','Alyae Belhadj (HM25ZD4SYM)',0,0,0,'2024-08-22 09:00:19','26b4071e3cc2ce8469ae76d9bbff542f',NULL,'2024-08-09 19:25:03','2024-08-22 09:00:19',15,2,3,46),(17,1,'00:00:00','2024-05-15 15:00:00','2024-05-18 11:00:00',3,2,2,0,0,'28da3ce5-fbe3-448b-a5fb-d3b8ebbd5499@reservations.hospitable.com','28da3ce5-fbe3-448b-a5fb-d3b8ebbd5499@reservations.hospitable.com','Hassan Sheekh (HM4Y2FXKSA)',0,0,0,'2024-08-22 09:00:19','8be60a0454525f6849dc269e42eeb832',NULL,'2024-08-09 19:25:04','2024-08-22 09:00:19',16,2,3,46),(18,1,'00:00:00','2024-04-18 15:00:00','2024-04-20 11:00:00',2,2,2,0,0,'d68edd40-8e93-4ecc-a3e1-733535ccaedf@reservations.hospitable.com','d68edd40-8e93-4ecc-a3e1-733535ccaedf@reservations.hospitable.com','Anita Saleh (HM52TMSX2H)',0,0,0,'2024-08-19 23:00:15','85bdfc6b8c3f9a2d3d3c9f57fc0af9cb',NULL,'2024-08-09 19:25:04','2024-08-19 23:00:15',17,2,3,46),(19,1,'00:00:00','2024-06-02 15:00:00','2024-06-03 11:00:00',1,1,1,0,0,'ffce0ef0-a8a5-4ad6-a20d-36f581393e6b@reservations.hospitable.com','ffce0ef0-a8a5-4ad6-a20d-36f581393e6b@reservations.hospitable.com','Mustapha Lamraoui Gourari (HM8JBAKEZH)',0,0,0,'2024-08-22 09:00:20','7c2ab46a2f39425416e24d9c39272538',NULL,'2024-08-09 19:25:04','2024-08-22 09:00:20',18,2,3,46),(20,1,'00:00:00','2024-07-28 15:00:00','2024-08-06 11:00:00',9,2,2,0,0,'e310583c-1337-4fa8-b040-21116c22243a@reservations.hospitable.com','e310583c-1337-4fa8-b040-21116c22243a@reservations.hospitable.com','Hakim Boubbiche (HMAHZA9XY3)',0,0,0,'2024-08-22 09:00:21','fb636bf4f79b5b76d1f783deeca3958b',NULL,'2024-08-09 19:25:05','2024-08-22 09:00:21',19,2,3,46),(21,1,'00:00:00','2024-09-10 15:00:00','2024-09-13 11:00:00',3,2,2,0,0,'47e18183-4059-4116-b60b-ca8cb89f81c5@reservations.hospitable.com','47e18183-4059-4116-b60b-ca8cb89f81c5@reservations.hospitable.com','Susitha Jayaratne (HMFPXJYZNC)',0,0,0,'2024-08-22 09:00:21','f68ccc6f1c2a0eecfccee3916c8e0574',NULL,'2024-08-09 19:25:05','2024-08-22 09:00:21',20,2,3,46),(22,1,'00:00:00','2024-07-11 15:00:00','2024-07-12 11:00:00',1,2,2,0,0,'d6c3be3d-4400-4f10-9cc0-a6912ec9e1ad@reservations.hospitable.com','d6c3be3d-4400-4f10-9cc0-a6912ec9e1ad@reservations.hospitable.com','Boiarsky Jerome (HMHSZ8TRSY)',0,0,0,'2024-08-22 09:00:22','6ced139d3977e26fa62929c192221415',NULL,'2024-08-09 19:25:06','2024-08-22 09:00:22',21,2,3,46),(23,1,'00:00:00','2024-09-30 15:00:00','2024-10-04 11:00:00',4,2,2,0,0,'4d4139e0-4037-4a01-984d-c0396398c7f0@reservations.hospitable.com','4d4139e0-4037-4a01-984d-c0396398c7f0@reservations.hospitable.com','محمد الراشد (HMJ4J2SYAR)',0,0,0,'2024-08-22 09:00:23','bda96d25b740d6cda5b93c4dcba5173c',NULL,'2024-08-09 19:25:07','2024-08-22 09:00:23',22,2,3,46),(24,1,'00:00:00','2024-04-25 15:00:00','2024-04-28 11:00:00',3,1,1,0,0,'73259945-010f-4dd9-b40e-36fad04c88fe@reservations.hospitable.com','73259945-010f-4dd9-b40e-36fad04c88fe@reservations.hospitable.com','Youssef Lmajdoub (HMN3C2PBZM)',0,0,0,'2024-08-22 09:00:24','a0d4cb0038adb3bc0179bca8f6e3a36c',NULL,'2024-08-09 19:25:07','2024-08-22 09:00:24',23,2,3,46),(25,1,'00:00:00','2024-04-16 15:00:00','2024-04-18 11:00:00',2,1,1,0,0,'d353b74d-4fdf-476c-9cfa-4af9a0842e48@reservations.hospitable.com','d353b74d-4fdf-476c-9cfa-4af9a0842e48@reservations.hospitable.com','Lacey Alexander (HMPPT3HSZM)',0,0,0,'2024-08-17 23:00:22','d7030a41e8b9b1b7f9fc27f241cd8971',NULL,'2024-08-09 19:25:08','2024-08-17 23:00:22',24,2,3,46),(26,1,'00:00:00','2024-07-20 15:00:00','2024-07-21 11:00:00',1,2,2,0,0,'a28c9bd1-4e88-4812-b4f6-5972f075f46d@reservations.hospitable.com','a28c9bd1-4e88-4812-b4f6-5972f075f46d@reservations.hospitable.com','Abdelilah Ajebbar (HMPPYDXWN8)',0,0,0,'2024-08-22 09:00:25','85bd7778b1feb6f368a2f0e4ecb703e8',NULL,'2024-08-09 19:25:09','2024-08-22 09:00:25',25,2,3,46),(27,1,'00:00:00','2024-06-04 15:00:00','2024-06-07 11:00:00',3,2,2,0,0,'b8e7d602-6965-48cb-b47a-a10de7514320@reservations.hospitable.com','b8e7d602-6965-48cb-b47a-a10de7514320@reservations.hospitable.com','Ilka Benel Mouaq (HMQ2JSX3FK)',0,0,0,'2024-08-22 09:00:25','7eea3d7f5d7bdf7305882cea51804988',NULL,'2024-08-09 19:25:09','2024-08-22 09:00:25',26,2,3,46),(28,1,'00:00:00','2024-08-06 15:00:00','2024-08-13 11:00:00',7,1,1,0,0,'15c548ba-2be5-44c0-8847-d4ecf4f374c6@reservations.hospitable.com','15c548ba-2be5-44c0-8847-d4ecf4f374c6@reservations.hospitable.com','Hakim Boubbiche (HMQXDX825Y)',0,0,0,'2024-08-22 09:00:26','34d5af95e1e95b24328d0490197e1345',NULL,'2024-08-09 19:25:10','2024-08-22 09:00:26',19,2,3,46),(29,1,'00:00:00','2024-05-07 15:00:00','2024-05-09 11:00:00',2,2,2,0,0,'d820e9ac-c65c-481c-96a6-a14c6adf5ea5@reservations.hospitable.com','d820e9ac-c65c-481c-96a6-a14c6adf5ea5@reservations.hospitable.com','Yassine Kassab (HMXEDBP8SY)',0,0,0,'2024-08-22 09:00:26','01babf0505587ff85742ea6a3aaa9844',NULL,'2024-08-09 19:25:10','2024-08-22 09:00:26',27,2,3,46),(30,1,'00:00:00','2024-05-13 15:00:00','2024-05-15 11:00:00',2,1,1,0,0,'32832b6d-2850-4108-a0b6-116dd6404601@reservations.hospitable.com','32832b6d-2850-4108-a0b6-116dd6404601@reservations.hospitable.com','Sameer Merchant (HMZRYB3Y33)',0,0,0,'2024-08-22 09:00:27','969a3af747c24ae18f6fbf6fd1792c43',NULL,'2024-08-09 19:25:11','2024-08-22 09:00:27',28,2,3,46),(31,1,'00:00:00','2024-06-22 15:00:00','2024-06-25 11:00:00',3,2,2,0,0,'56d96898-1052-41aa-afdf-86ee2f56e31a@reservations.hospitable.com','56d96898-1052-41aa-afdf-86ee2f56e31a@reservations.hospitable.com','Nacho Moreno (JYNVGZ)',0,0,0,'2024-08-22 09:00:28','128576299d886ff539e214083348cca0',NULL,'2024-08-09 19:25:11','2024-08-22 09:00:28',29,2,3,46),(32,1,'00:00:00','2024-09-07 15:00:00','2024-09-09 11:00:00',2,3,3,0,0,'6914b1d1-98c3-41b8-88a3-848c55cf01c0@reservations.hospitable.com','6914b1d1-98c3-41b8-88a3-848c55cf01c0@reservations.hospitable.com','Dilruba Akhter (R6QVJH)',0,0,0,'2024-08-22 09:00:28','6256c4d862a80baf1854bf76cdc5115d',NULL,'2024-08-09 19:25:12','2024-08-22 09:00:28',30,2,3,46),(33,1,'00:00:00','2024-07-12 15:00:00','2024-07-15 11:00:00',3,2,2,0,0,'71ca681d-4ce2-4ee6-80cb-bd9cca07a6fb@reservations.hospitable.com','71ca681d-4ce2-4ee6-80cb-bd9cca07a6fb@reservations.hospitable.com','Yasuhiro Ito (UQ4FJR)',0,0,0,'2024-08-22 09:00:29','4e1af9698b743642d16a213732a216dd',NULL,'2024-08-09 19:25:12','2024-08-22 09:00:29',31,2,3,46),(34,1,'00:00:00','2024-05-05 15:00:00','2024-05-07 11:00:00',2,2,2,0,0,'3a21a131-5533-4450-8db0-95a4093c10e2@reservations.hospitable.com','3a21a131-5533-4450-8db0-95a4093c10e2@reservations.hospitable.com','Olivier  (XAY6TO)',0,0,0,'2024-08-22 09:00:30','7a7be9a0e015a62489d4dab9bc48e561',NULL,'2024-08-09 19:25:13','2024-08-22 09:00:30',32,2,3,46),(35,1,'00:00:00','2024-06-12 15:00:00','2024-06-17 11:00:00',5,2,2,0,0,'3497a037-fb8f-4a40-9cd0-7736efe02f79@reservations.hospitable.com','3497a037-fb8f-4a40-9cd0-7736efe02f79@reservations.hospitable.com','Gaëtan Honore (ZDYIGA)',0,0,0,'2024-08-22 09:00:30','863e42178fda9816e09925a63413fab9',NULL,'2024-08-09 19:25:13','2024-08-22 09:00:30',33,2,3,46),(36,2,'00:00:00','2024-07-29 15:00:00','2024-08-01 12:00:00',3,6,6,0,0,'98559f3f-87a3-49f1-a59b-0307a2a6e395@reservations.hospitable.com','98559f3f-87a3-49f1-a59b-0307a2a6e395@reservations.hospitable.com','Lahcene Baaziz (4080054311)',0,0,0,'2024-08-22 09:00:32','ce43ae0cbd7316346e5e6b527c9fb4b8',NULL,'2024-08-09 19:28:03','2024-08-22 09:00:32',34,2,3,46),(37,2,'00:00:00','2024-04-25 15:00:00','2024-05-01 12:00:00',6,3,3,0,0,'823d074b-0ac3-4d5e-a139-b58a8ea67003@reservations.hospitable.com','823d074b-0ac3-4d5e-a139-b58a8ea67003@reservations.hospitable.com','obisesan adeyinka (4284541823)',0,0,0,'2024-08-22 09:00:32','2c34fe48c720f41c2764c5be75ce5b6f',NULL,'2024-08-09 19:28:03','2024-08-22 09:00:32',35,2,3,46),(38,2,'00:00:00','2024-07-13 15:00:00','2024-07-18 12:00:00',5,5,3,2,0,'23121a9c-7b24-432f-a2ca-2aab55969074@reservations.hospitable.com','23121a9c-7b24-432f-a2ca-2aab55969074@reservations.hospitable.com','Fatiha Boubhri (4491517213)',0,0,0,'2024-08-22 09:00:33','e2d79dd836bf2229b878eb8f5ca1ed1a',NULL,'2024-08-09 19:28:04','2024-08-22 09:00:33',36,2,3,46),(39,2,'00:00:00','2024-05-14 15:00:00','2024-05-15 12:00:00',1,3,3,0,0,'2b6fb433-3af8-44c5-beba-13e7d9b73b83@reservations.hospitable.com','2b6fb433-3af8-44c5-beba-13e7d9b73b83@reservations.hospitable.com','Chakib Mounassib Benseria (4565301261)',0,0,0,'2024-08-22 09:00:33','27d221624369f024e49ec858c0780aae',NULL,'2024-08-09 19:28:04','2024-08-22 09:00:33',37,2,3,46),(40,2,'00:00:00','2024-07-19 15:00:00','2024-07-20 12:00:00',1,2,2,0,0,'96bd3c67-eeba-4c95-861e-09e27fb2e8c1@reservations.hospitable.com','96bd3c67-eeba-4c95-861e-09e27fb2e8c1@reservations.hospitable.com','Kelvin Omoijade (4625341519)',0,0,0,'2024-08-22 09:00:34','45087280d20f001d845fe6265e879427',NULL,'2024-08-09 19:28:05','2024-08-22 09:00:34',38,2,3,46),(41,2,'00:00:00','2024-06-30 15:00:00','2024-07-02 12:00:00',2,4,2,2,0,'f31dfb65-fd59-4e09-a7e5-dd4e12b6d03a@reservations.hospitable.com','f31dfb65-fd59-4e09-a7e5-dd4e12b6d03a@reservations.hospitable.com','Ghizlane Toutouh (4630653246)',0,0,0,'2024-08-22 09:00:35','2681778c738397680086ffe04b551cc3',NULL,'2024-08-09 19:28:05','2024-08-22 09:00:35',39,2,3,46),(42,2,'00:00:00','2024-08-08 15:00:00','2024-08-10 12:00:00',2,4,2,2,0,'be7a7707-57bc-45cd-ba85-6d64859ecbe6@reservations.hospitable.com','be7a7707-57bc-45cd-ba85-6d64859ecbe6@reservations.hospitable.com','EDDAHDI Younès (4672520542)',0,0,0,'2024-08-22 09:00:35','a7f9289a88bea038c30e3bce8086fa5e',NULL,'2024-08-09 19:28:06','2024-08-22 09:00:35',40,2,3,46),(43,2,'00:00:00','2024-07-20 15:00:00','2024-07-23 12:00:00',3,4,3,1,0,'9868a038-4ffb-4e13-8a80-785dfd0d0650@reservations.hospitable.com','9868a038-4ffb-4e13-8a80-785dfd0d0650@reservations.hospitable.com','Hafida Buduh (4703227420)',0,0,0,'2024-08-22 09:00:36','61cc5dd27f2e0056098577eae03c8d64',NULL,'2024-08-09 19:28:06','2024-08-22 09:00:36',41,2,3,46),(44,2,'00:00:00','2024-07-23 15:00:00','2024-07-25 12:00:00',2,5,2,3,0,'da591268-8390-4aa4-8868-d90bb18159b0@reservations.hospitable.com','da591268-8390-4aa4-8868-d90bb18159b0@reservations.hospitable.com','Abdellah Samlani (4714912394)',0,0,0,'2024-08-22 09:00:37','6ad689ca9fc7fcd71b356461036bef1d',NULL,'2024-08-09 19:28:07','2024-08-22 09:00:37',42,2,3,46),(45,2,'00:00:00','2024-07-06 15:00:00','2024-07-10 12:00:00',4,2,2,0,0,'7c5acf11-cc78-4224-a08a-3d9391b9d0be@reservations.hospitable.com','7c5acf11-cc78-4224-a08a-3d9391b9d0be@reservations.hospitable.com','Amine Izyajen (4716043171)',0,0,0,'2024-08-22 09:00:37','f3928a0ab8345463ff2e93a462a21589',NULL,'2024-08-09 19:28:08','2024-08-22 09:00:37',43,2,3,46),(46,2,'00:00:00','2024-08-01 15:00:00','2024-08-06 12:00:00',5,3,3,0,0,'10a53151-3df1-488b-a1f3-05429f8c453a@reservations.hospitable.com','10a53151-3df1-488b-a1f3-05429f8c453a@reservations.hospitable.com','ayoube bahoussi (4928352751)',0,0,0,'2024-08-22 09:00:38','491eeea525b4860b6b78f4ee7b163b22',NULL,'2024-08-09 19:28:08','2024-08-22 09:00:38',44,2,3,46),(47,2,'00:00:00','2024-09-24 15:00:00','2024-09-29 11:00:00',5,4,4,0,0,'94093a42-7dc0-43f0-a94e-b60ff518fc70@reservations.hospitable.com','94093a42-7dc0-43f0-a94e-b60ff518fc70@reservations.hospitable.com','Benoit Loyer (902JYB)',0,0,0,'2024-08-22 09:00:39','14d289857e39960c005b2f5065830edd',NULL,'2024-08-09 19:28:09','2024-08-22 09:00:39',45,2,3,46),(48,2,'00:00:00','2024-08-07 15:00:00','2024-08-08 11:00:00',1,4,2,2,0,'a9cf52a1-1c88-4329-b2a6-38ce2d2725d2@reservations.hospitable.com','a9cf52a1-1c88-4329-b2a6-38ce2d2725d2@reservations.hospitable.com','Mohamed Aït Wakrim (HM298TSHZX)',0,0,0,'2024-08-22 09:00:40','3b8aca4f2d1264c51c3a7e636bba5d2f',NULL,'2024-08-09 19:28:09','2024-08-22 09:00:40',46,2,3,46),(49,2,'00:00:00','2024-04-24 15:00:00','2024-04-25 11:00:00',1,2,2,0,0,'cb314162-d6ca-4a24-a12e-5224139e4437@reservations.hospitable.com','cb314162-d6ca-4a24-a12e-5224139e4437@reservations.hospitable.com','Alex Daugherty (HM4M52HXSX)',0,0,0,'2024-08-22 09:00:41','d1dc83049cbf510c41fd5635ad0f3eb3',NULL,'2024-08-09 19:28:10','2024-08-22 09:00:41',47,2,3,46),(50,2,'00:00:00','2024-05-19 15:00:00','2024-05-20 11:00:00',1,1,1,0,0,'54dd6699-31e3-4ded-861c-3440ba89da3e@reservations.hospitable.com','54dd6699-31e3-4ded-861c-3440ba89da3e@reservations.hospitable.com','Soufiane Massit (HM4PCE2BJE)',0,0,0,'2024-08-22 09:00:42','e70453a87fdb1916401ce20a871367af',NULL,'2024-08-09 19:28:11','2024-08-22 09:00:42',48,2,3,46),(51,2,'00:00:00','2024-08-10 15:00:00','2024-08-11 11:00:00',1,1,1,0,0,'eb6b61a1-17dd-497a-838f-07cdcbf7aa3a@reservations.hospitable.com','eb6b61a1-17dd-497a-838f-07cdcbf7aa3a@reservations.hospitable.com','Mohammed Talbi Alamk (HM52HSXF99)',0,0,0,'2024-08-22 09:00:42','e2f8552a134c206e46791699ba9dcaf1',NULL,'2024-08-09 19:28:12','2024-08-22 09:00:42',49,2,3,46),(52,2,'00:00:00','2024-07-27 15:00:00','2024-07-29 11:00:00',2,4,4,0,0,'71e2c3be-e982-486c-b28c-a4b859f07b51@reservations.hospitable.com','71e2c3be-e982-486c-b28c-a4b859f07b51@reservations.hospitable.com','Youssef Aguilou (HM84NY8SAN)',0,0,0,'2024-08-22 09:00:43','a7436d65f28fd0568367ad287d24f89d',NULL,'2024-08-09 19:28:13','2024-08-22 09:00:43',50,2,3,46),(53,2,'00:00:00','2024-07-05 15:00:00','2024-07-06 11:00:00',1,4,4,0,0,'7308e66f-2199-405f-a09e-d6c99ad01401@reservations.hospitable.com','7308e66f-2199-405f-a09e-d6c99ad01401@reservations.hospitable.com','On Yin To (HM94XZDWTH)',0,0,0,'2024-08-22 09:00:44','a12b72895d2fd818c02ba5ef2ec1d9c8',NULL,'2024-08-09 19:28:13','2024-08-22 09:00:44',51,2,3,46),(54,2,'00:00:00','2024-04-11 15:00:00','2024-04-13 11:00:00',2,5,3,2,0,'081b113c-03a6-4b91-aaeb-5966c1773e6e@reservations.hospitable.com','081b113c-03a6-4b91-aaeb-5966c1773e6e@reservations.hospitable.com','Saad Keddar (HM9AXNKQDN)',0,0,0,'2024-08-12 23:00:46','958e4d2c7c5472ddb44531fe57b683be',NULL,'2024-08-09 19:28:14','2024-08-12 23:00:46',52,2,3,46),(55,2,'00:00:00','2024-05-21 15:00:00','2024-06-06 11:00:00',16,2,2,0,0,'d0c14abe-9e54-4eb6-95a8-bca687864c72@reservations.hospitable.com','d0c14abe-9e54-4eb6-95a8-bca687864c72@reservations.hospitable.com','Serena Boukraa (HMBJZPNKKK)',0,0,0,'2024-08-22 09:00:44','f6aa4410159b9c7813fa738a2c50feb6',NULL,'2024-08-09 19:28:15','2024-08-22 09:00:44',53,2,3,46),(56,2,'00:00:00','2024-04-21 15:00:00','2024-04-23 11:00:00',2,2,2,0,0,'e546e79f-c162-4b43-b544-aeca5845d0e8@reservations.hospitable.com','e546e79f-c162-4b43-b544-aeca5845d0e8@reservations.hospitable.com','Safia Madani (HMEF2ASXEC)',0,0,0,'2024-08-22 09:00:45','d0e990a7a0800a31587f0704a5456538',NULL,'2024-08-09 19:28:15','2024-08-22 09:00:45',54,2,3,46),(57,2,'00:00:00','2024-06-16 15:00:00','2024-06-18 11:00:00',2,4,4,0,0,'92c5da49-77f3-4e56-bfc9-f2ebae95bc50@reservations.hospitable.com','92c5da49-77f3-4e56-bfc9-f2ebae95bc50@reservations.hospitable.com','Malak Larsen (HMEZDCCSAB)',0,0,0,'2024-08-22 09:00:46','7415f55d2f0c6c3646fa17e2d76d4c87',NULL,'2024-08-09 19:28:16','2024-08-22 09:00:46',55,2,3,46),(58,2,'00:00:00','2024-04-16 15:00:00','2024-04-20 11:00:00',4,3,3,0,0,'65406932-5849-4dec-abb9-5d0bc6a49159@reservations.hospitable.com','65406932-5849-4dec-abb9-5d0bc6a49159@reservations.hospitable.com','Kevin Osminski (HMF55TD5SH)',0,0,0,'2024-08-19 23:00:43','af0541f23a186af3f7c2a2c6696fa8d4',NULL,'2024-08-09 19:28:16','2024-08-19 23:00:43',56,2,3,46),(59,2,'00:00:00','2024-06-06 15:00:00','2024-06-08 11:00:00',2,3,3,0,0,'fa21dd96-023c-4a74-ac69-dc2ff4ef0f97@reservations.hospitable.com','fa21dd96-023c-4a74-ac69-dc2ff4ef0f97@reservations.hospitable.com','Jordan Lorsold (HMFJ3HFTRZ)',0,0,0,'2024-08-22 09:00:47','dedc82e6f09e7cc5daad34d5b4624be5',NULL,'2024-08-09 19:28:17','2024-08-22 09:00:47',57,2,3,46),(60,2,'00:00:00','2024-05-01 15:00:00','2024-05-05 11:00:00',4,3,3,0,0,'10045021-34e4-4785-bfaf-a321de040816@reservations.hospitable.com','10045021-34e4-4785-bfaf-a321de040816@reservations.hospitable.com','Abdelali Mahboub (HMJ3NBFZA9)',0,0,0,'2024-08-22 09:00:48','24e774d71ebb8933ecb70fdec3ed62ea',NULL,'2024-08-09 19:28:17','2024-08-22 09:00:48',58,2,3,46),(61,2,'00:00:00','2024-08-17 15:00:00','2024-08-22 11:00:00',5,5,5,0,0,'9c3171b9-4d33-4bb5-8db3-76687f8eaaf2@reservations.hospitable.com','9c3171b9-4d33-4bb5-8db3-76687f8eaaf2@reservations.hospitable.com','Fatima Hadih (HMJYXY3S4Q)',0,0,0,'2024-08-22 09:00:48','f77413aa6d573f6ccfdca73c4c8a7ac0',NULL,'2024-08-09 19:28:18','2024-08-22 09:00:48',59,2,3,46),(62,2,'00:00:00','2024-07-25 15:00:00','2024-07-27 11:00:00',2,6,3,3,0,'862d5de2-33dc-4e04-99ad-5411d2baf826@reservations.hospitable.com','862d5de2-33dc-4e04-99ad-5411d2baf826@reservations.hospitable.com','Norddine Akilani (HMKQ549WHK)',0,0,0,'2024-08-22 09:00:49','99c6ec79951d45ee5e41942c0959eca4',NULL,'2024-08-09 19:28:18','2024-08-22 09:00:49',60,2,3,46),(63,2,'00:00:00','2024-04-10 15:00:00','2024-04-11 11:00:00',1,5,4,1,0,'bf27babf-b6e9-4d62-ba07-f6e2e0e487b9@reservations.hospitable.com','bf27babf-b6e9-4d62-ba07-f6e2e0e487b9@reservations.hospitable.com','Imane Jabbouri (HMKX3SFB5D)',0,0,0,'2024-08-09 19:28:19','ce79d66430d0eb991a3084cf06dd6618',NULL,'2024-08-09 19:28:19','2024-08-09 19:28:19',61,2,3,46),(64,2,'00:00:00','2024-06-12 15:00:00','2024-06-16 11:00:00',4,2,2,0,0,'c0820127-3a2b-4ca2-b760-50268caa12fd@reservations.hospitable.com','c0820127-3a2b-4ca2-b760-50268caa12fd@reservations.hospitable.com','Mohssine Maaroufi (HMMFFSES9X)',0,0,0,'2024-08-22 09:00:50','fd74cda49f9c3b622a7c7f09f1e827d7',NULL,'2024-08-09 19:28:20','2024-08-22 09:00:50',62,2,3,46),(65,2,'00:00:00','2024-08-06 15:00:00','2024-08-07 11:00:00',1,4,2,2,0,'98f912d1-7bc8-4ee6-b40f-141be7b5ee1d@reservations.hospitable.com','98f912d1-7bc8-4ee6-b40f-141be7b5ee1d@reservations.hospitable.com','Hasna Hamouali Boulahdrt (HMMTP4ZN4P)',0,0,0,'2024-08-22 09:00:51','2214c786432276fe70b81812249cede9',NULL,'2024-08-09 19:28:20','2024-08-22 09:00:51',63,2,3,46),(66,2,'00:00:00','2024-05-16 15:00:00','2024-05-19 11:00:00',3,1,1,0,0,'39458b31-56d7-4b35-96ae-ce92bddc8a3b@reservations.hospitable.com','39458b31-56d7-4b35-96ae-ce92bddc8a3b@reservations.hospitable.com','Soufiane Massit (HMN8NKJMQ3)',0,0,0,'2024-08-22 09:00:51','c2b97fc08aae1d50c18aec58fb698734',NULL,'2024-08-09 19:28:21','2024-08-22 09:00:51',48,2,3,46),(67,2,'00:00:00','2024-05-06 15:00:00','2024-05-08 11:00:00',2,5,5,0,0,'11daa6ea-1981-4715-8393-3090078ca0dc@reservations.hospitable.com','11daa6ea-1981-4715-8393-3090078ca0dc@reservations.hospitable.com','Alexandra Vincent (HMP42TPDBA)',0,0,0,'2024-08-22 09:00:52','4e9f9267b8d32975e6895f93b1a3977f',NULL,'2024-08-09 19:28:22','2024-08-22 09:00:52',64,2,3,46),(68,2,'00:00:00','2024-04-20 15:00:00','2024-04-21 11:00:00',1,5,5,0,0,'56f9ac86-fe89-432f-8527-08cffd5855d2@reservations.hospitable.com','56f9ac86-fe89-432f-8527-08cffd5855d2@reservations.hospitable.com','Yasmine Maknaoui (HMPDNEQK2Y)',0,0,0,'2024-08-20 23:00:58','c75a00e51a764424910ba05e3f599a88',NULL,'2024-08-09 19:28:22','2024-08-20 23:00:58',65,2,3,46),(69,2,'00:00:00','2024-05-08 15:00:00','2024-05-14 11:00:00',6,4,2,2,0,'ae19afea-3781-4775-b8ff-690b4fa0ab78@reservations.hospitable.com','ae19afea-3781-4775-b8ff-690b4fa0ab78@reservations.hospitable.com','Prisca Dablé (HMREHYMFSE)',0,0,0,'2024-08-22 09:00:54','185372a2c0b40f5ee2bc451ae3dbd17a',NULL,'2024-08-09 19:28:23','2024-08-22 09:00:54',66,2,3,46),(70,2,'00:00:00','2024-07-10 15:00:00','2024-07-13 11:00:00',3,4,2,2,0,'844749a9-2b03-45f9-900c-ee94d393bb57@reservations.hospitable.com','844749a9-2b03-45f9-900c-ee94d393bb57@reservations.hospitable.com','Laetitia Lhor (HMRXFARJH4)',0,0,0,'2024-08-22 09:00:54','6a7fe4f342d28e6da056bd38bb7ac5c5',NULL,'2024-08-09 19:28:23','2024-08-22 09:00:54',67,2,3,46),(71,2,'00:00:00','2024-08-11 15:00:00','2024-08-16 11:00:00',5,2,2,0,0,'133d2e48-6267-4617-add7-bcd02f5754cb@reservations.hospitable.com','133d2e48-6267-4617-add7-bcd02f5754cb@reservations.hospitable.com','Silvia Zaconia (HMW5X9PCWY)',0,0,0,'2024-08-22 09:00:55','91d3a6ca5047653070f91eadbff1e239',NULL,'2024-08-09 19:28:24','2024-08-22 09:00:55',68,2,3,46),(72,2,'00:00:00','2025-02-05 15:00:00','2025-02-07 11:00:00',2,2,2,0,0,'b78f5026-66f0-4824-a883-1140b2a0daa3@reservations.hospitable.com','b78f5026-66f0-4824-a883-1140b2a0daa3@reservations.hospitable.com','Kexin Gui (OAJ7KD)',0,0,0,'2024-08-22 09:00:57','4fab34c3611562f30cafcf57a12d2d91',NULL,'2024-08-09 19:28:25','2024-08-22 09:00:57',69,2,3,46),(73,2,'00:00:00','2024-07-02 15:00:00','2024-07-05 11:00:00',3,2,2,0,0,'c39922b8-7e55-4ec2-bbb6-7dac7a55d442@reservations.hospitable.com','c39922b8-7e55-4ec2-bbb6-7dac7a55d442@reservations.hospitable.com','Client samsar (QICOCE)',0,0,0,'2024-08-22 09:00:58','1db79d1b0dabef23a7d14936c2fa6674',NULL,'2024-08-09 19:28:25','2024-08-22 09:00:58',70,2,3,46),(74,2,'00:00:00','2024-06-21 15:00:00','2024-06-27 11:00:00',6,3,3,0,0,'f8cc9be2-3273-4310-bb32-fd46cbdf0727@reservations.hospitable.com','f8cc9be2-3273-4310-bb32-fd46cbdf0727@reservations.hospitable.com','Houda Pignard (WPAHJV)',0,0,0,'2024-08-22 09:00:58','293d66ac05aa98b2f7e9031c25a9d96f',NULL,'2024-08-09 19:28:26','2024-08-22 09:00:58',71,2,3,46),(75,1,'00:00:00','2024-08-17 15:00:00','2024-08-24 11:00:00',7,1,1,0,0,'82c35030-b51d-44cf-ad10-35abcf3c7ad5@reservations.hospitable.com','82c35030-b51d-44cf-ad10-35abcf3c7ad5@reservations.hospitable.com','Mehdy Diabi (4342086355)',0,0,0,'2024-08-22 09:00:05','4762c8d0f8281e5719b346ce5291329d',NULL,'2024-08-14 16:00:06','2024-08-22 09:00:05',72,2,NULL,46),(76,1,'00:00:00','2024-08-16 15:00:00','2024-08-17 11:00:00',1,2,2,0,0,'d5ebe1e5-a885-41af-9ead-c0e6beacd5a5@reservations.hospitable.com','d5ebe1e5-a885-41af-9ead-c0e6beacd5a5@reservations.hospitable.com','Laila Balli (HMJHYDRZXX)',0,0,0,'2024-08-22 09:00:23','dab4023b13f49c41e9fb0a72fd522e7e',NULL,'2024-08-15 14:00:23','2024-08-22 09:00:23',73,2,NULL,46),(77,2,'00:00:00','2024-08-16 15:00:00','2024-08-17 11:00:00',1,5,5,0,0,'9a2ba5d5-f5f7-4d9f-bf65-cafb229ddef8@reservations.hospitable.com','9a2ba5d5-f5f7-4d9f-bf65-cafb229ddef8@reservations.hospitable.com','Naima Rmidi (HMXAR8E5MZ)',0,0,0,'2024-08-22 09:00:56','bebb00daefbfa68d06ef22a77b20c243',NULL,'2024-08-16 11:00:55','2024-08-22 09:00:56',74,2,NULL,46),(78,2,'00:00:00','2024-08-23 15:00:00','2024-08-24 12:00:00',1,6,3,3,0,'09c1087f-56dc-4baf-a006-7b03b5d1168c@reservations.hospitable.com','09c1087f-56dc-4baf-a006-7b03b5d1168c@reservations.hospitable.com','Ali essakhi (4832678152)',0,0,0,'2024-08-22 09:00:38','8ce2f51ea00370023d3d6f8cf1b52094',NULL,'2024-08-16 18:00:39','2024-08-22 09:00:38',75,2,NULL,46),(79,2,'00:00:00','2024-08-26 15:00:00','2024-08-30 11:00:00',4,3,3,0,0,'a0d7b856-629d-4a7e-9e37-2259e2eeb609@reservations.hospitable.com','a0d7b856-629d-4a7e-9e37-2259e2eeb609@reservations.hospitable.com','Sergio Casa Alvarez (HMYANFMKMB)',0,0,0,'2024-08-22 09:00:56','fc4bd0a92886cb44bf00eda454bbd610',NULL,'2024-08-20 19:00:55','2024-08-22 09:00:56',76,2,NULL,46),(81,1,'12:15:37','2025-08-15 00:00:00','2025-08-29 00:00:00',14,1,1,0,0,NULL,NULL,NULL,0,0,0,'2024-08-21 12:15:37',NULL,'','2024-08-21 12:15:37','2024-08-21 12:15:37',82,NULL,3,NULL),(82,1,'12:21:07','2025-06-11 15:00:00','2025-06-20 11:00:00',9,1,1,0,0,NULL,NULL,NULL,0,0,0,'2024-08-21 12:21:07',NULL,'','2024-08-21 12:21:07','2024-08-21 12:26:54',83,NULL,3,NULL),(83,2,'00:00:00','2024-08-22 15:00:00','2024-08-23 11:00:00',1,5,4,1,0,'8624739d-5562-4738-8c72-7f96e7405770@reservations.hospitable.com','8624739d-5562-4738-8c72-7f96e7405770@reservations.hospitable.com','Mehdi Dorbani (HMQARJRCTY)',0,0,0,'2024-08-22 09:00:53','a56878951b25e40aa186fc9959c6dbe2',NULL,'2024-08-21 23:01:00','2024-08-22 09:00:53',84,2,NULL,46);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,1,'Category 1','category-1','2017-11-21 16:23:22','2017-11-21 16:23:22'),(2,NULL,1,'Category 2','category-2','2017-11-21 16:23:22','2017-11-21 16:23:22');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_conversation`
--

DROP TABLE IF EXISTS `contact_conversation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_conversation` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` bigint unsigned NOT NULL,
  `conversation_id` bigint unsigned NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_conversation_contact_id_foreign` (`contact_id`),
  KEY `contact_conversation_conversation_id_foreign` (`conversation_id`),
  CONSTRAINT `contact_conversation_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `contact_conversation_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=526 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_conversation`
--

LOCK TABLES `contact_conversation` WRITE;
/*!40000 ALTER TABLE `contact_conversation` DISABLE KEYS */;
INSERT INTO `contact_conversation` VALUES (368,11,1,'2024-08-22 09:00:06',NULL,NULL),(369,82,1,'2024-08-22 09:00:06',NULL,NULL),(370,12,2,'2024-08-22 09:00:07',NULL,NULL),(371,82,2,'2024-08-22 09:00:07',NULL,NULL),(372,13,3,'2024-08-22 09:00:07',NULL,NULL),(373,82,3,'2024-08-22 09:00:07',NULL,NULL),(374,14,4,'2024-08-22 09:00:08',NULL,NULL),(375,82,4,'2024-08-22 09:00:08',NULL,NULL),(376,15,5,'2024-08-22 09:00:08',NULL,NULL),(377,82,5,'2024-08-22 09:00:08',NULL,NULL),(378,16,6,'2024-08-22 09:00:09',NULL,NULL),(379,82,6,'2024-08-22 09:00:09',NULL,NULL),(380,17,7,'2024-08-22 09:00:13',NULL,NULL),(381,82,7,'2024-08-22 09:00:13',NULL,NULL),(382,18,8,'2024-08-22 09:00:13',NULL,NULL),(383,82,8,'2024-08-22 09:00:13',NULL,NULL),(384,19,9,'2024-08-22 09:00:14',NULL,NULL),(385,82,9,'2024-08-22 09:00:14',NULL,NULL),(386,20,10,'2024-08-22 09:00:15',NULL,NULL),(387,82,10,'2024-08-22 09:00:15',NULL,NULL),(388,21,11,'2024-08-22 09:00:15',NULL,NULL),(389,82,11,'2024-08-22 09:00:15',NULL,NULL),(390,22,12,'2024-08-22 09:00:16',NULL,NULL),(391,82,12,'2024-08-22 09:00:16',NULL,NULL),(392,17,13,'2024-08-22 09:00:17',NULL,NULL),(393,82,13,'2024-08-22 09:00:17',NULL,NULL),(394,23,14,'2024-08-22 09:00:18',NULL,NULL),(395,82,14,'2024-08-22 09:00:18',NULL,NULL),(396,24,15,'2024-08-22 09:00:18',NULL,NULL),(397,82,15,'2024-08-22 09:00:18',NULL,NULL),(398,25,16,'2024-08-22 09:00:19',NULL,NULL),(399,82,16,'2024-08-22 09:00:19',NULL,NULL),(400,26,17,'2024-08-22 09:00:20',NULL,NULL),(401,82,17,'2024-08-22 09:00:20',NULL,NULL),(402,27,18,'2024-08-19 23:00:15',NULL,NULL),(403,82,18,'2024-08-19 23:00:15',NULL,NULL),(404,28,19,'2024-08-22 09:00:20',NULL,NULL),(405,82,19,'2024-08-22 09:00:20',NULL,NULL),(406,29,20,'2024-08-22 09:00:21',NULL,NULL),(407,82,20,'2024-08-22 09:00:21',NULL,NULL),(408,30,21,'2024-08-22 09:00:22',NULL,NULL),(409,82,21,'2024-08-22 09:00:22',NULL,NULL),(410,31,22,'2024-08-22 09:00:22',NULL,NULL),(411,82,22,'2024-08-22 09:00:22',NULL,NULL),(412,32,23,'2024-08-22 09:00:23',NULL,NULL),(413,82,23,'2024-08-22 09:00:23',NULL,NULL),(414,33,24,'2024-08-22 09:00:24',NULL,NULL),(415,82,24,'2024-08-22 09:00:24',NULL,NULL),(416,34,25,'2024-08-17 23:00:22',NULL,NULL),(417,82,25,'2024-08-17 23:00:22',NULL,NULL),(418,35,26,'2024-08-22 09:00:25',NULL,NULL),(419,82,26,'2024-08-22 09:00:25',NULL,NULL),(420,36,27,'2024-08-22 09:00:25',NULL,NULL),(421,82,27,'2024-08-22 09:00:26',NULL,NULL),(422,29,28,'2024-08-22 09:00:26',NULL,NULL),(423,82,28,'2024-08-22 09:00:26',NULL,NULL),(424,37,29,'2024-08-22 09:00:27',NULL,NULL),(425,82,29,'2024-08-22 09:00:27',NULL,NULL),(426,38,30,'2024-08-22 09:00:27',NULL,NULL),(427,82,30,'2024-08-22 09:00:27',NULL,NULL),(428,39,31,'2024-08-22 09:00:28',NULL,NULL),(429,82,31,'2024-08-22 09:00:28',NULL,NULL),(430,40,32,'2024-08-22 09:00:28',NULL,NULL),(431,82,32,'2024-08-22 09:00:28',NULL,NULL),(432,41,33,'2024-08-22 09:00:29',NULL,NULL),(433,82,33,'2024-08-22 09:00:29',NULL,NULL),(434,42,34,'2024-08-22 09:00:30',NULL,NULL),(435,82,34,'2024-08-22 09:00:30',NULL,NULL),(436,43,35,'2024-08-22 09:00:31',NULL,NULL),(437,82,35,'2024-08-22 09:00:31',NULL,NULL),(438,44,36,'2024-08-22 09:00:32',NULL,NULL),(439,82,36,'2024-08-22 09:00:32',NULL,NULL),(440,45,37,'2024-08-22 09:00:33',NULL,NULL),(441,82,37,'2024-08-22 09:00:33',NULL,NULL),(442,46,38,'2024-08-22 09:00:33',NULL,NULL),(443,82,38,'2024-08-22 09:00:33',NULL,NULL),(444,47,39,'2024-08-22 09:00:34',NULL,NULL),(445,82,39,'2024-08-22 09:00:34',NULL,NULL),(446,48,40,'2024-08-22 09:00:34',NULL,NULL),(447,82,40,'2024-08-22 09:00:34',NULL,NULL),(448,49,41,'2024-08-22 09:00:35',NULL,NULL),(449,82,41,'2024-08-22 09:00:35',NULL,NULL),(450,50,42,'2024-08-22 09:00:35',NULL,NULL),(451,82,42,'2024-08-22 09:00:35',NULL,NULL),(452,51,43,'2024-08-22 09:00:36',NULL,NULL),(453,82,43,'2024-08-22 09:00:36',NULL,NULL),(454,52,44,'2024-08-22 09:00:37',NULL,NULL),(455,82,44,'2024-08-22 09:00:37',NULL,NULL),(456,53,45,'2024-08-22 09:00:37',NULL,NULL),(457,82,45,'2024-08-22 09:00:38',NULL,NULL),(458,54,46,'2024-08-22 09:00:39',NULL,NULL),(459,82,46,'2024-08-22 09:00:39',NULL,NULL),(460,55,47,'2024-08-22 09:00:39',NULL,NULL),(461,82,47,'2024-08-22 09:00:39',NULL,NULL),(462,56,48,'2024-08-22 09:00:40',NULL,NULL),(463,82,48,'2024-08-22 09:00:40',NULL,NULL),(464,57,49,'2024-08-22 09:00:41',NULL,NULL),(465,82,49,'2024-08-22 09:00:41',NULL,NULL),(466,58,50,'2024-08-22 09:00:42',NULL,NULL),(467,82,50,'2024-08-22 09:00:42',NULL,NULL),(468,59,51,'2024-08-22 09:00:43',NULL,NULL),(469,82,51,'2024-08-22 09:00:43',NULL,NULL),(470,60,52,'2024-08-22 09:00:43',NULL,NULL),(471,82,52,'2024-08-22 09:00:43',NULL,NULL),(472,61,53,'2024-08-22 09:00:44',NULL,NULL),(473,82,53,'2024-08-22 09:00:44',NULL,NULL),(474,62,54,'2024-08-12 23:00:46',NULL,NULL),(475,82,54,'2024-08-12 23:00:46',NULL,NULL),(476,63,55,'2024-08-22 09:00:45',NULL,NULL),(477,82,55,'2024-08-22 09:00:45',NULL,NULL),(478,64,56,'2024-08-22 09:00:45',NULL,NULL),(479,82,56,'2024-08-22 09:00:45',NULL,NULL),(480,65,57,'2024-08-22 09:00:46',NULL,NULL),(481,82,57,'2024-08-22 09:00:46',NULL,NULL),(482,66,58,'2024-08-19 23:00:44',NULL,NULL),(483,82,58,'2024-08-19 23:00:44',NULL,NULL),(484,67,59,'2024-08-22 09:00:47',NULL,NULL),(485,82,59,'2024-08-22 09:00:47',NULL,NULL),(486,68,60,'2024-08-22 09:00:48',NULL,NULL),(487,82,60,'2024-08-22 09:00:48',NULL,NULL),(488,69,61,'2024-08-22 09:00:49',NULL,NULL),(489,82,61,'2024-08-22 09:00:49',NULL,NULL),(490,70,62,'2024-08-22 09:00:49',NULL,NULL),(491,82,62,'2024-08-22 09:00:49',NULL,NULL),(492,72,64,'2024-08-22 09:00:50',NULL,NULL),(493,82,64,'2024-08-22 09:00:50',NULL,NULL),(494,73,65,'2024-08-22 09:00:51',NULL,NULL),(495,82,65,'2024-08-22 09:00:51',NULL,NULL),(496,58,66,'2024-08-22 09:00:52',NULL,NULL),(497,82,66,'2024-08-22 09:00:52',NULL,NULL),(498,74,67,'2024-08-22 09:00:52',NULL,NULL),(499,82,67,'2024-08-22 09:00:52',NULL,NULL),(500,75,68,'2024-08-20 23:00:58',NULL,NULL),(501,82,68,'2024-08-20 23:00:58',NULL,NULL),(502,76,69,'2024-08-22 09:00:54',NULL,NULL),(503,82,69,'2024-08-22 09:00:54',NULL,NULL),(504,77,70,'2024-08-22 09:00:55',NULL,NULL),(505,82,70,'2024-08-22 09:00:55',NULL,NULL),(506,78,71,'2024-08-22 09:00:55',NULL,NULL),(507,82,71,'2024-08-22 09:00:55',NULL,NULL),(508,79,72,'2024-08-22 09:00:57',NULL,NULL),(509,82,72,'2024-08-22 09:00:57',NULL,NULL),(510,80,73,'2024-08-22 09:00:58',NULL,NULL),(511,82,73,'2024-08-22 09:00:58',NULL,NULL),(512,81,74,'2024-08-22 09:00:58',NULL,NULL),(513,82,74,'2024-08-22 09:00:59',NULL,NULL),(514,83,75,'2024-08-22 09:00:05',NULL,NULL),(515,82,75,'2024-08-22 09:00:05',NULL,NULL),(516,84,76,'2024-08-22 09:00:23',NULL,NULL),(517,82,76,'2024-08-22 09:00:24',NULL,NULL),(518,85,77,'2024-08-22 09:00:56',NULL,NULL),(519,82,77,'2024-08-22 09:00:56',NULL,NULL),(520,86,78,'2024-08-22 09:00:38',NULL,NULL),(521,82,78,'2024-08-22 09:00:38',NULL,NULL),(522,87,79,'2024-08-22 09:00:56',NULL,NULL),(523,82,79,'2024-08-22 09:00:57',NULL,NULL),(524,88,80,'2024-08-22 09:00:53',NULL,NULL),(525,82,80,'2024-08-22 09:00:53',NULL,NULL);
/*!40000 ALTER TABLE `contact_conversation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_message`
--

DROP TABLE IF EXISTS `contact_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_message` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` bigint unsigned NOT NULL,
  `message_id` bigint unsigned NOT NULL,
  `reaction_unicode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_message_contact_id_foreign` (`contact_id`),
  KEY `contact_message_message_id_foreign` (`message_id`),
  CONSTRAINT `contact_message_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `users` (`id`),
  CONSTRAINT `contact_message_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_message`
--

LOCK TABLES `contact_message` WRITE;
/*!40000 ALTER TABLE `contact_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_user_id_foreign` (`user_id`),
  CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'contact',1,'Wave','Wave Admin','admin@admin.com',NULL,NULL,'users/default.png',NULL,NULL,NULL,NULL,NULL),(2,'contact',2,'Mauricio','Mauricio Raynor','mauricio.raynor@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(3,'contact',3,'Maya','Maya Schultz','maya.schultz@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(4,'contact',4,'Destini','Destini Rowe','destini.rowe@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(5,'contact',5,'Rocio','Rocio Roberts DDS','rocio.roberts.dds@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(6,'contact',6,'Anibal','Anibal Marquardt','anibal.marquardt@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(7,'contact',7,'Jacinto','Jacinto Lubowitz','jacinto.lubowitz@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(8,'contact',8,'Adrain','Adrain Walker','adrain.walker@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(9,'contact',9,'Dr.','Dr. Margaretta Christiansen PhD','dr.margaretta.christiansen.phd@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(10,'contact',10,'Prof.','Prof. Natasha Russel Sr.','prof.natasha.russel.sr.@innovqube.com',NULL,NULL,'users/profile-picture-3.jpg',NULL,NULL,NULL,NULL,NULL),(11,NULL,NULL,'Emilie-Rose','Emilie-Rose Ceresa','eceres.606363@guest.booking.com','+330673823154',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:55','2024-08-22 09:00:06'),(12,NULL,NULL,'Hamou','Hamou Firaz','hfiraz.582690@guest.booking.com','+49 176 93102159',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:56','2024-08-22 09:00:06'),(13,NULL,NULL,'Mirza','Mirza Baig','mbaig.590361@guest.booking.com','+1 416 432 4551',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:56','2024-08-22 09:00:07'),(14,NULL,NULL,'Aymane','Aymane Itoual','aitoua.753488@guest.booking.com','+212 644 611154',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:56','2024-08-22 09:00:07'),(15,NULL,NULL,'Caputo','Caputo Beatrice','cbeatr.328592@guest.booking.com','+39 327 622 7299',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:56','2024-08-22 09:00:08'),(16,NULL,NULL,'Evgvenii','Evgvenii Lavrenchuk','elavre.152310@guest.booking.com','+375293988176',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:57','2024-08-22 09:00:08'),(17,NULL,NULL,'Conchi','Conchi Bermúdez','cbermu.108775@guest.booking.com','+34 650 91 82 88',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:58','2024-08-22 09:00:16'),(18,NULL,NULL,'VITORINO','VITORINO ILHEU','vilheu.728947@guest.booking.com','+212 661104737',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:58','2024-08-22 09:00:13'),(19,NULL,NULL,'yousef','yousef Azzaoui','yazzao.571116@guest.booking.com','+32 751841873',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:59','2024-08-22 09:00:14'),(20,NULL,NULL,'Reda','Reda Cherquy','rcherq.426049@guest.booking.com','+33 6 30 58 50 69',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:24:59','2024-08-22 09:00:14'),(21,NULL,NULL,'towana','towana tahir','ttahir.599723@guest.booking.com','+46 76 295 31 49',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:00','2024-08-22 09:00:15'),(22,NULL,NULL,'Sebastien','Sebastien Boher','sboher.134678@guest.booking.com','+212631463913',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:00','2024-08-22 09:00:15'),(23,NULL,NULL,'Arnaud','Arnaud Pignard','apignard@gmail.com','+33633590674',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:02','2024-08-22 09:00:17'),(24,NULL,NULL,'Cheikh','Cheikh DIENG','Cheikh-tidiane.dieng@ugb.edu.sn','+221776335307',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:02','2024-08-22 09:00:18'),(25,NULL,NULL,'Alyae','Alyae Belhadj','','212622826635',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:03','2024-08-22 09:00:19'),(26,NULL,NULL,'Hassan','Hassan Sheekh','','4790290980',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:03','2024-08-22 09:00:19'),(27,NULL,NULL,'Anita','Anita Saleh','','212638050968',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:04','2024-08-19 23:00:15'),(28,NULL,NULL,'Mustapha','Mustapha Gourari','','34697837517',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:04','2024-08-22 09:00:20'),(29,NULL,NULL,'Hakim','Hakim Boubbiche','','33786374751',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:05','2024-08-22 09:00:26'),(30,NULL,NULL,'Susitha','Susitha Jayaratne','','17034081395',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:05','2024-08-22 09:00:21'),(31,NULL,NULL,'Boiarsky','Boiarsky Jerome','','33689155727',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:06','2024-08-22 09:00:22'),(32,NULL,NULL,'محمد','محمد الراشد','','966598785979',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:07','2024-08-22 09:00:22'),(33,NULL,NULL,'Youssef','Youssef Lmajdoub','','33609370606',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:07','2024-08-22 09:00:24'),(34,NULL,NULL,'Lacey','Lacey Alexander','','18566301577',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:08','2024-08-17 23:00:22'),(35,NULL,NULL,'Abdelilah','Abdelilah Ajebbar','','212661989991',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:08','2024-08-22 09:00:24'),(36,NULL,NULL,'Ilka','Ilka Mouaq','','4915159097017',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:09','2024-08-22 09:00:25'),(37,NULL,NULL,'Yassine','Yassine Kassab','','221774715278',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:10','2024-08-22 09:00:26'),(38,NULL,NULL,'Sameer','Sameer Merchant','(noemailaliasavailable)','12812364801',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:11','2024-08-22 09:00:27'),(39,NULL,NULL,'Nacho','Nacho Moreno','natxo.moreno@gmail.com','+34646026312',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:11','2024-08-22 09:00:28'),(40,NULL,NULL,'Dilruba','Dilruba Akhter','krishtiakhter90@hotmail.com','+61424187592',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:12','2024-08-22 09:00:28'),(41,NULL,NULL,'Yasuhiro','Yasuhiro Ito','hiro1@itoyasu.co.jp','+819064657458',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:12','2024-08-22 09:00:29'),(42,NULL,NULL,'Olivier','Olivier Olivier','Jelbinihouda0@gmail.com','',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:13','2024-08-22 09:00:29'),(43,NULL,NULL,'Gaëtan','Gaëtan Honore','ghonore@cegetel.net','+33628547934',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:25:13','2024-08-22 09:00:30'),(44,NULL,NULL,'Lahcene','Lahcene Baaziz','','',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:02','2024-08-22 09:00:32'),(45,NULL,NULL,'obisesan','obisesan adeyinka','oadeyi.809623@guest.booking.com','',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:03','2024-08-22 09:00:32'),(46,NULL,NULL,'Fatiha','Fatiha Boubhri','fboubh.931286@guest.booking.com','+33 6 23 57 76 87',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:04','2024-08-22 09:00:33'),(47,NULL,NULL,'Chakib','Chakib Benseria','cbense.947496@guest.booking.com','+34 671 74 79 96',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:04','2024-08-22 09:00:33'),(48,NULL,NULL,'Kelvin','Kelvin Omoijade','komoij.921420@guest.booking.com','+353 89 973 3681',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:05','2024-08-22 09:00:34'),(49,NULL,NULL,'Ghizlane','Ghizlane Toutouh','gtouto.791167@guest.booking.com','+212 655 576679',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:05','2024-08-22 09:00:35'),(50,NULL,NULL,'EDDAHDI','EDDAHDI Younès','eyoune.119396@guest.booking.com','+33 7 53 58 42 59',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:06','2024-08-22 09:00:35'),(51,NULL,NULL,'Hafida','Hafida Buduh','hbuduh.539126@guest.booking.com','+32 494 34 28 10',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:06','2024-08-22 09:00:36'),(52,NULL,NULL,'Abdellah','Abdellah Samlani','asamla.610873@guest.booking.com','+33 643326914',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:07','2024-08-22 09:00:36'),(53,NULL,NULL,'Amine','Amine Izyajen','aizyaj.497045@guest.booking.com','+33 6 37 87 13 94',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:08','2024-08-22 09:00:37'),(54,NULL,NULL,'ayoube','ayoube bahoussi','abahou.689415@guest.booking.com','+212 212613437955',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:08','2024-08-22 09:00:38'),(55,NULL,NULL,'Benoit','Benoit Loyer','beaugruau@innocent.com','+14188372674',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:09','2024-08-22 09:00:39'),(56,NULL,NULL,'Mohamed','Mohamed Wakrim','','33601366798',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:09','2024-08-22 09:00:40'),(57,NULL,NULL,'Alex','Alex Daugherty','','19182321967',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:10','2024-08-22 09:00:41'),(58,NULL,NULL,'Soufiane','Soufiane Massit','','212628554776',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:11','2024-08-22 09:00:51'),(59,NULL,NULL,'Mohammed','Mohammed Alamk','','33749163428',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:12','2024-08-22 09:00:42'),(60,NULL,NULL,'Youssef','Youssef Aguilou','','37061379848',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:12','2024-08-22 09:00:43'),(61,NULL,NULL,'On','On To','','447503955386',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:13','2024-08-22 09:00:43'),(62,NULL,NULL,'Saad','Saad Keddar','','212669259663',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:14','2024-08-12 23:00:45'),(63,NULL,NULL,'Serena','Serena Boukraa','','33762845488',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:14','2024-08-22 09:00:44'),(64,NULL,NULL,'Safia','Safia Madani','','13146621123',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:15','2024-08-22 09:00:45'),(65,NULL,NULL,'Malak','Malak Larsen','','4593936293',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:16','2024-08-22 09:00:46'),(66,NULL,NULL,'Kevin','Kevin Osminski','','447762326218',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:16','2024-08-19 23:00:43'),(67,NULL,NULL,'Jordan','Jordan Lorsold','','33778021523',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:17','2024-08-22 09:00:47'),(68,NULL,NULL,'Abdelali','Abdelali Mahboub','','212665295862',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:17','2024-08-22 09:00:47'),(69,NULL,NULL,'Fatima','Fatima Hadih','','32487365599',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:18','2024-08-22 09:00:48'),(70,NULL,NULL,'Norddine','Norddine Akilani','','212769916603',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:18','2024-08-22 09:00:49'),(71,NULL,NULL,'Imane','Imane Jabbouri','','212667969465',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:19','2024-08-09 19:28:19'),(72,NULL,NULL,'Mohssine','Mohssine Maaroufi','','33745468107',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:20','2024-08-22 09:00:50'),(73,NULL,NULL,'Hasna','Hasna Boulahdrt','','33777819004',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:20','2024-08-22 09:00:51'),(74,NULL,NULL,'Alexandra','Alexandra Vincent','','15147991725',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:21','2024-08-22 09:00:52'),(75,NULL,NULL,'Yasmine','Yasmine Maknaoui','','212703255339',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:22','2024-08-20 23:00:58'),(76,NULL,NULL,'Prisca','Prisca Dablé','','33751401840',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:23','2024-08-22 09:00:53'),(77,NULL,NULL,'Laetitia','Laetitia Lhor','Zina.laouina13@gmail.com','212762209318',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:23','2024-08-22 09:00:54'),(78,NULL,NULL,'Silvia','Silvia Zaconia','','393485692863',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:24','2024-08-22 09:00:55'),(79,NULL,NULL,'Kexin','Kexin Gui','guikexinfr@outlook.com','',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:25','2024-08-22 09:00:57'),(80,NULL,NULL,'Client','Client samsar','Jelbinihouda0@gmail.com','',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:25','2024-08-22 09:00:58'),(81,NULL,NULL,'Houda','Houda Pignard','jelbinihouda03@gmail.com','+33776696997',NULL,NULL,NULL,NULL,NULL,'2024-08-09 19:28:26','2024-08-22 09:00:58'),(82,'contact',12,'Arnaud','Arnaud Pignard','dev@innovqube.com',NULL,NULL,'users/default.png',NULL,NULL,NULL,'2024-08-09 00:00:00',NULL),(83,NULL,NULL,'Mehdy','Mehdy Diabi','mdiabi.165721@guest.booking.com','+33 7 67 45 77 48',NULL,NULL,NULL,NULL,NULL,'2024-08-14 16:00:06','2024-08-22 09:00:05'),(84,NULL,NULL,'Laila','Laila Balli','','33786416159',NULL,NULL,NULL,NULL,NULL,'2024-08-15 14:00:23','2024-08-22 09:00:23'),(85,NULL,NULL,'Naima','Naima Rmidi','','33614857606',NULL,NULL,NULL,NULL,NULL,'2024-08-16 11:00:55','2024-08-22 09:00:55'),(86,NULL,NULL,'Ali','Ali essakhi','aessak.717878@guest.booking.com','+212 679 823606',NULL,NULL,NULL,NULL,NULL,'2024-08-16 18:00:39','2024-08-22 09:00:38'),(87,NULL,NULL,'Sergio','Sergio Alvarez','','34698191843',NULL,NULL,NULL,NULL,NULL,'2024-08-20 19:00:55','2024-08-22 09:00:56'),(88,NULL,NULL,'Mehdi','Mehdi Dorbani','','33767041146',NULL,NULL,NULL,NULL,NULL,'2024-08-21 23:01:00','2024-08-22 09:00:53');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversations_booking_id_foreign` (`booking_id`),
  CONSTRAINT `conversations_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` VALUES (1,1,'2024-08-22 09:00:06','2024-08-22 09:00:06',NULL),(2,2,'2024-08-22 09:00:06','2024-08-22 09:00:06',NULL),(3,3,'2024-08-22 09:00:07','2024-08-22 09:00:07',NULL),(4,4,'2024-08-22 09:00:07','2024-08-22 09:00:07',NULL),(5,5,'2024-08-22 09:00:08','2024-08-22 09:00:08',NULL),(6,6,'2024-08-22 09:00:09','2024-08-22 09:00:09',NULL),(7,7,'2024-08-22 09:00:12','2024-08-22 09:00:12',NULL),(8,8,'2024-08-22 09:00:13','2024-08-22 09:00:13',NULL),(9,9,'2024-08-22 09:00:14','2024-08-22 09:00:14',NULL),(10,10,'2024-08-22 09:00:14','2024-08-22 09:00:14',NULL),(11,11,'2024-08-22 09:00:15','2024-08-22 09:00:15',NULL),(12,12,'2024-08-22 09:00:16','2024-08-22 09:00:16',NULL),(13,13,'2024-08-22 09:00:17','2024-08-22 09:00:17',NULL),(14,14,'2024-08-22 09:00:17','2024-08-22 09:00:17',NULL),(15,15,'2024-08-22 09:00:18','2024-08-22 09:00:18',NULL),(16,16,'2024-08-22 09:00:19','2024-08-22 09:00:19',NULL),(17,17,'2024-08-22 09:00:20','2024-08-22 09:00:20',NULL),(18,18,'2024-08-19 23:00:15','2024-08-19 23:00:15',NULL),(19,19,'2024-08-22 09:00:20','2024-08-22 09:00:20',NULL),(20,20,'2024-08-22 09:00:21','2024-08-22 09:00:21',NULL),(21,21,'2024-08-22 09:00:22','2024-08-22 09:00:22',NULL),(22,22,'2024-08-22 09:00:22','2024-08-22 09:00:22',NULL),(23,23,'2024-08-22 09:00:23','2024-08-22 09:00:23',NULL),(24,24,'2024-08-22 09:00:24','2024-08-22 09:00:24',NULL),(25,25,'2024-08-17 23:00:22','2024-08-17 23:00:22',NULL),(26,26,'2024-08-22 09:00:25','2024-08-22 09:00:25',NULL),(27,27,'2024-08-22 09:00:25','2024-08-22 09:00:25',NULL),(28,28,'2024-08-22 09:00:26','2024-08-22 09:00:26',NULL),(29,29,'2024-08-22 09:00:26','2024-08-22 09:00:26',NULL),(30,30,'2024-08-22 09:00:27','2024-08-22 09:00:27',NULL),(31,31,'2024-08-22 09:00:28','2024-08-22 09:00:28',NULL),(32,32,'2024-08-22 09:00:28','2024-08-22 09:00:28',NULL),(33,33,'2024-08-22 09:00:29','2024-08-22 09:00:29',NULL),(34,34,'2024-08-22 09:00:30','2024-08-22 09:00:30',NULL),(35,35,'2024-08-22 09:00:30','2024-08-22 09:00:30',NULL),(36,36,'2024-08-22 09:00:32','2024-08-22 09:00:32',NULL),(37,37,'2024-08-22 09:00:32','2024-08-22 09:00:32',NULL),(38,38,'2024-08-22 09:00:33','2024-08-22 09:00:33',NULL),(39,39,'2024-08-22 09:00:34','2024-08-22 09:00:34',NULL),(40,40,'2024-08-22 09:00:34','2024-08-22 09:00:34',NULL),(41,41,'2024-08-22 09:00:35','2024-08-22 09:00:35',NULL),(42,42,'2024-08-22 09:00:35','2024-08-22 09:00:35',NULL),(43,43,'2024-08-22 09:00:36','2024-08-22 09:00:36',NULL),(44,44,'2024-08-22 09:00:37','2024-08-22 09:00:37',NULL),(45,45,'2024-08-22 09:00:37','2024-08-22 09:00:37',NULL),(46,46,'2024-08-22 09:00:39','2024-08-22 09:00:39',NULL),(47,47,'2024-08-22 09:00:39','2024-08-22 09:00:39',NULL),(48,48,'2024-08-22 09:00:40','2024-08-22 09:00:40',NULL),(49,49,'2024-08-22 09:00:41','2024-08-22 09:00:41',NULL),(50,50,'2024-08-22 09:00:42','2024-08-22 09:00:42',NULL),(51,51,'2024-08-22 09:00:42','2024-08-22 09:00:42',NULL),(52,52,'2024-08-22 09:00:43','2024-08-22 09:00:43',NULL),(53,53,'2024-08-22 09:00:44','2024-08-22 09:00:44',NULL),(54,54,'2024-08-12 23:00:46','2024-08-12 23:00:46',NULL),(55,55,'2024-08-22 09:00:44','2024-08-22 09:00:44',NULL),(56,56,'2024-08-22 09:00:45','2024-08-22 09:00:45',NULL),(57,57,'2024-08-22 09:00:46','2024-08-22 09:00:46',NULL),(58,58,'2024-08-19 23:00:43','2024-08-19 23:00:43',NULL),(59,59,'2024-08-22 09:00:47','2024-08-22 09:00:47',NULL),(60,60,'2024-08-22 09:00:48','2024-08-22 09:00:48',NULL),(61,61,'2024-08-22 09:00:48','2024-08-22 09:00:48',NULL),(62,62,'2024-08-22 09:00:49','2024-08-22 09:00:49',NULL),(63,63,'2024-08-09 19:28:19','2024-08-09 19:28:19',NULL),(64,64,'2024-08-22 09:00:50','2024-08-22 09:00:50',NULL),(65,65,'2024-08-22 09:00:51','2024-08-22 09:00:51',NULL),(66,66,'2024-08-22 09:00:52','2024-08-22 09:00:52',NULL),(67,67,'2024-08-22 09:00:52','2024-08-22 09:00:52',NULL),(68,68,'2024-08-20 23:00:58','2024-08-20 23:00:58',NULL),(69,69,'2024-08-22 09:00:54','2024-08-22 09:00:54',NULL),(70,70,'2024-08-22 09:00:54','2024-08-22 09:00:54',NULL),(71,71,'2024-08-22 09:00:55','2024-08-22 09:00:55',NULL),(72,72,'2024-08-22 09:00:57','2024-08-22 09:00:57',NULL),(73,73,'2024-08-22 09:00:58','2024-08-22 09:00:58',NULL),(74,74,'2024-08-22 09:00:58','2024-08-22 09:00:58',NULL),(75,75,'2024-08-22 09:00:05','2024-08-22 09:00:05',NULL),(76,76,'2024-08-22 09:00:23','2024-08-22 09:00:23',NULL),(77,77,'2024-08-22 09:00:56','2024-08-22 09:00:56',NULL),(78,78,'2024-08-22 09:00:38','2024-08-22 09:00:38',NULL),(79,79,'2024-08-22 09:00:56','2024-08-22 09:00:56',NULL),(80,83,'2024-08-22 09:00:53','2024-08-22 09:00:53',NULL);
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AD','Andorra',NULL,NULL),(2,'AE','United Arab Emirates',NULL,NULL),(3,'AF','Afghanistan',NULL,NULL),(4,'AG','Antigua and Barbuda',NULL,NULL),(5,'AI','Anguilla',NULL,NULL),(6,'AL','Albania',NULL,NULL),(7,'AM','Armenia',NULL,NULL),(8,'AO','Angola',NULL,NULL),(9,'AQ','Antarctica',NULL,NULL),(10,'AR','Argentina',NULL,NULL),(11,'AS','American Samoa',NULL,NULL),(12,'AT','Austria',NULL,NULL),(13,'AU','Australia',NULL,NULL),(14,'AW','Aruba',NULL,NULL),(15,'AX','Åland Islands',NULL,NULL),(16,'AZ','Azerbaijan',NULL,NULL),(17,'BA','Bosnia and Herzegovina',NULL,NULL),(18,'BB','Barbados',NULL,NULL),(19,'BD','Bangladesh',NULL,NULL),(20,'BE','Belgium',NULL,NULL),(21,'BF','Burkina Faso',NULL,NULL),(22,'BG','Bulgaria',NULL,NULL),(23,'BH','Bahrain',NULL,NULL),(24,'BI','Burundi',NULL,NULL),(25,'BJ','Benin',NULL,NULL),(26,'BL','Saint Barthélemy',NULL,NULL),(27,'BM','Bermuda',NULL,NULL),(28,'BN','Brunei Darussalam',NULL,NULL),(29,'BO','Bolivia (Plurinational State of)',NULL,NULL),(30,'BQ','Bonaire, Sint Eustatius and Saba',NULL,NULL),(31,'BR','Brazil',NULL,NULL),(32,'BS','Bahamas',NULL,NULL),(33,'BT','Bhutan',NULL,NULL),(34,'BV','Bouvet Island',NULL,NULL),(35,'BW','Botswana',NULL,NULL),(36,'BY','Belarus',NULL,NULL),(37,'BZ','Belize',NULL,NULL),(38,'CA','Canada',NULL,NULL),(39,'CC','Cocos (Keeling) Islands',NULL,NULL),(40,'CD','Congo (Democratic Republic of the)',NULL,NULL),(41,'CF','Central African Republic',NULL,NULL),(42,'CG','Congo',NULL,NULL),(43,'CH','Switzerland',NULL,NULL),(44,'CI','Côte d\'Ivoire',NULL,NULL),(45,'CK','Cook Islands',NULL,NULL),(46,'CL','Chile',NULL,NULL),(47,'CM','Cameroon',NULL,NULL),(48,'CN','China',NULL,NULL),(49,'CO','Colombia',NULL,NULL),(50,'CR','Costa Rica',NULL,NULL),(51,'CU','Cuba',NULL,NULL),(52,'CV','Cabo Verde',NULL,NULL),(53,'CW','Curaçao',NULL,NULL),(54,'CX','Christmas Island',NULL,NULL),(55,'CY','Cyprus',NULL,NULL),(56,'CZ','Czechia',NULL,NULL),(57,'DE','Germany',NULL,NULL),(58,'DJ','Djibouti',NULL,NULL),(59,'DK','Denmark',NULL,NULL),(60,'DM','Dominica',NULL,NULL),(61,'DO','Dominican Republic',NULL,NULL),(62,'DZ','Algeria',NULL,NULL),(63,'EC','Ecuador',NULL,NULL),(64,'EE','Estonia',NULL,NULL),(65,'EG','Egypt',NULL,NULL),(66,'EH','Western Sahara',NULL,NULL),(67,'ER','Eritrea',NULL,NULL),(68,'ES','Spain',NULL,NULL),(69,'ET','Ethiopia',NULL,NULL),(70,'FI','Finland',NULL,NULL),(71,'FJ','Fiji',NULL,NULL),(72,'FK','Falkland Islands (Malvinas)',NULL,NULL),(73,'FM','Micronesia (Federated States of)',NULL,NULL),(74,'FO','Faroe Islands',NULL,NULL),(75,'FR','France',NULL,NULL),(76,'GA','Gabon',NULL,NULL),(77,'GB','United Kingdom of Great Britain and Northern Ireland',NULL,NULL),(78,'GD','Grenada',NULL,NULL),(79,'GE','Georgia',NULL,NULL),(80,'GF','French Guiana',NULL,NULL),(81,'GG','Guernsey',NULL,NULL),(82,'GH','Ghana',NULL,NULL),(83,'GI','Gibraltar',NULL,NULL),(84,'GL','Greenland',NULL,NULL),(85,'GM','Gambia',NULL,NULL),(86,'GN','Guinea',NULL,NULL),(87,'GP','Guadeloupe',NULL,NULL),(88,'GQ','Equatorial Guinea',NULL,NULL),(89,'GR','Greece',NULL,NULL),(90,'GS','South Georgia and the South Sandwich Islands',NULL,NULL),(91,'GT','Guatemala',NULL,NULL),(92,'GU','Guam',NULL,NULL),(93,'GW','Guinea-Bissau',NULL,NULL),(94,'GY','Guyana',NULL,NULL),(95,'HK','Hong Kong',NULL,NULL),(96,'HM','Heard Island and McDonald Islands',NULL,NULL),(97,'HN','Honduras',NULL,NULL),(98,'HR','Croatia',NULL,NULL),(99,'HT','Haiti',NULL,NULL),(100,'HU','Hungary',NULL,NULL),(101,'ID','Indonesia',NULL,NULL),(102,'IE','Ireland',NULL,NULL),(103,'IL','Israel',NULL,NULL),(104,'IM','Isle of Man',NULL,NULL),(105,'IN','India',NULL,NULL),(106,'IO','British Indian Ocean Territory',NULL,NULL),(107,'IQ','Iraq',NULL,NULL),(108,'IR','Iran (Islamic Republic of)',NULL,NULL),(109,'IS','Iceland',NULL,NULL),(110,'IT','Italy',NULL,NULL),(111,'JE','Jersey',NULL,NULL),(112,'JM','Jamaica',NULL,NULL),(113,'JO','Jordan',NULL,NULL),(114,'JP','Japan',NULL,NULL),(115,'KE','Kenya',NULL,NULL),(116,'KG','Kyrgyzstan',NULL,NULL),(117,'KH','Cambodia',NULL,NULL),(118,'KI','Kiribati',NULL,NULL),(119,'KM','Comoros',NULL,NULL),(120,'KN','Saint Kitts and Nevis',NULL,NULL),(121,'KP','Korea (Democratic People\'s Republic of)',NULL,NULL),(122,'KR','Korea, Republic of',NULL,NULL),(123,'KW','Kuwait',NULL,NULL),(124,'KY','Cayman Islands',NULL,NULL),(125,'KZ','Kazakhstan',NULL,NULL),(126,'LA','Lao People\'s Democratic Republic',NULL,NULL),(127,'LB','Lebanon',NULL,NULL),(128,'LC','Saint Lucia',NULL,NULL),(129,'LI','Liechtenstein',NULL,NULL),(130,'LK','Sri Lanka',NULL,NULL),(131,'LR','Liberia',NULL,NULL),(132,'LS','Lesotho',NULL,NULL),(133,'LT','Lithuania',NULL,NULL),(134,'LU','Luxembourg',NULL,NULL),(135,'LV','Latvia',NULL,NULL),(136,'LY','Libya',NULL,NULL),(137,'MA','Morocco',NULL,NULL),(138,'MC','Monaco',NULL,NULL),(139,'MD','Moldova, Republic of',NULL,NULL),(140,'ME','Montenegro',NULL,NULL),(141,'MF','Saint Martin (French part)',NULL,NULL),(142,'MG','Madagascar',NULL,NULL),(143,'MH','Marshall Islands',NULL,NULL),(144,'MK','North Macedonia',NULL,NULL),(145,'ML','Mali',NULL,NULL),(146,'MM','Myanmar',NULL,NULL),(147,'MN','Mongolia',NULL,NULL),(148,'MO','Macao',NULL,NULL),(149,'MP','Northern Mariana Islands',NULL,NULL),(150,'MQ','Martinique',NULL,NULL),(151,'MR','Mauritania',NULL,NULL),(152,'MS','Montserrat',NULL,NULL),(153,'MT','Malta',NULL,NULL),(154,'MU','Mauritius',NULL,NULL),(155,'MV','Maldives',NULL,NULL),(156,'MW','Malawi',NULL,NULL),(157,'MX','Mexico',NULL,NULL),(158,'MY','Malaysia',NULL,NULL),(159,'MZ','Mozambique',NULL,NULL),(160,'NA','Namibia',NULL,NULL),(161,'NC','New Caledonia',NULL,NULL),(162,'NE','Niger',NULL,NULL),(163,'NF','Norfolk Island',NULL,NULL),(164,'NG','Nigeria',NULL,NULL),(165,'NI','Nicaragua',NULL,NULL),(166,'NL','Netherlands',NULL,NULL),(167,'NO','Norway',NULL,NULL),(168,'NP','Nepal',NULL,NULL),(169,'NR','Nauru',NULL,NULL),(170,'NU','Niue',NULL,NULL),(171,'NZ','New Zealand',NULL,NULL),(172,'OM','Oman',NULL,NULL),(173,'PA','Panama',NULL,NULL),(174,'PE','Peru',NULL,NULL),(175,'PF','French Polynesia',NULL,NULL),(176,'PG','Papua New Guinea',NULL,NULL),(177,'PH','Philippines',NULL,NULL),(178,'PK','Pakistan',NULL,NULL),(179,'PL','Poland',NULL,NULL),(180,'PM','Saint Pierre and Miquelon',NULL,NULL),(181,'PN','Pitcairn',NULL,NULL),(182,'PR','Puerto Rico',NULL,NULL),(183,'PS','Palestine, State of',NULL,NULL),(184,'PT','Portugal',NULL,NULL),(185,'PW','Palau',NULL,NULL),(186,'PY','Paraguay',NULL,NULL),(187,'QA','Qatar',NULL,NULL),(188,'RE','Réunion',NULL,NULL),(189,'RO','Romania',NULL,NULL),(190,'RS','Serbia',NULL,NULL),(191,'RU','Russian Federation',NULL,NULL),(192,'RW','Rwanda',NULL,NULL),(193,'SA','Saudi Arabia',NULL,NULL),(194,'SB','Solomon Islands',NULL,NULL),(195,'SC','Seychelles',NULL,NULL),(196,'SD','Sudan',NULL,NULL),(197,'SE','Sweden',NULL,NULL),(198,'SG','Singapore',NULL,NULL),(199,'SH','Saint Helena, Ascension and Tristan da Cunha',NULL,NULL),(200,'SI','Slovenia',NULL,NULL),(201,'SJ','Svalbard and Jan Mayen',NULL,NULL),(202,'SK','Slovakia',NULL,NULL),(203,'SL','Sierra Leone',NULL,NULL),(204,'SM','San Marino',NULL,NULL),(205,'SN','Senegal',NULL,NULL),(206,'SO','Somalia',NULL,NULL),(207,'SR','Suriname',NULL,NULL),(208,'SS','South Sudan',NULL,NULL),(209,'ST','Sao Tome and Principe',NULL,NULL),(210,'SV','El Salvador',NULL,NULL),(211,'SX','Sint Maarten (Dutch part)',NULL,NULL),(212,'SY','Syrian Arab Republic',NULL,NULL),(213,'SZ','Eswatini',NULL,NULL),(214,'TC','Turks and Caicos Islands',NULL,NULL),(215,'TD','Chad',NULL,NULL),(216,'TF','French Southern Territories',NULL,NULL),(217,'TG','Togo',NULL,NULL),(218,'TH','Thailand',NULL,NULL),(219,'TJ','Tajikistan',NULL,NULL),(220,'TK','Tokelau',NULL,NULL),(221,'TL','Timor-Leste',NULL,NULL),(222,'TM','Turkmenistan',NULL,NULL),(223,'TN','Tunisia',NULL,NULL),(224,'TO','Tonga',NULL,NULL),(225,'TR','Turkey',NULL,NULL),(226,'TT','Trinidad and Tobago',NULL,NULL),(227,'TV','Tuvalu',NULL,NULL),(228,'TW','Taiwan, Province of China',NULL,NULL),(229,'TZ','Tanzania, United Republic of',NULL,NULL),(230,'UA','Ukraine',NULL,NULL),(231,'UG','Uganda',NULL,NULL),(232,'UM','United States Minor Outlying Islands',NULL,NULL),(233,'US','United States of America',NULL,NULL),(234,'UY','Uruguay',NULL,NULL),(235,'UZ','Uzbekistan',NULL,NULL),(236,'VA','Holy See',NULL,NULL),(237,'VC','Saint Vincent and the Grenadines',NULL,NULL),(238,'VE','Venezuela (Bolivarian Republic of)',NULL,NULL),(239,'VG','Virgin Islands (British)',NULL,NULL),(240,'VI','Virgin Islands (U.S.)',NULL,NULL),(241,'VN','Viet Nam',NULL,NULL),(242,'VU','Vanuatu',NULL,NULL),(243,'WF','Wallis and Futuna',NULL,NULL),(244,'WS','Samoa',NULL,NULL),(245,'YE','Yemen',NULL,NULL),(246,'YT','Mayotte',NULL,NULL),(247,'ZA','South Africa',NULL,NULL),(248,'ZM','Zambia',NULL,NULL),(249,'ZW','Zimbabwe',NULL,NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_first` tinyint(1) NOT NULL,
  `symbol_espace` tinyint(1) NOT NULL,
  `decimal_mark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thousand_separator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'United Arab Emirates Dirham','AED','د.إ',1,0,'.',',','default.png'),(2,'Afghan Afghani','AFN','؋',1,0,'.',',','default.png'),(3,'Albanian Lek','ALL','L',0,1,'.',',','default.png'),(4,'Armenian Dram','AMD','֏',0,1,'.',',','default.png'),(5,'Netherlands Antillean Guilder','ANG','ƒ',1,0,'.',',','default.png'),(6,'Angolan Kwanza','AOA','Kz',0,1,'.',',','default.png'),(7,'Argentine Peso','ARS','$',1,0,'.',',','default.png'),(8,'Australian Dollar','AUD','$',1,0,'.',',','default.png'),(9,'Aruban Florin','AWG','ƒ',1,0,'.',',','default.png'),(10,'Azerbaijani Manat','AZN','₼',1,0,'.',',','default.png'),(11,'Bosnia-Herzegovina Convertible Mark','BAM','KM',1,1,'.',',','default.png'),(12,'Barbadian Dollar','BBD','$',1,0,'.',',','default.png'),(13,'Bangladeshi Taka','BDT','৳',1,0,'.',',','default.png'),(14,'Bulgarian Lev','BGN','лв',0,1,'.',',','default.png'),(15,'Bahraini Dinar','BHD','.د.ب',1,0,'.',',','default.png'),(16,'Burundian Franc','BIF','FBu',0,1,'.',',','default.png'),(17,'Bermudan Dollar','BMD','$',1,0,'.',',','default.png'),(18,'Brunei Dollar','BND','$',1,0,'.',',','default.png'),(19,'Bolivian Boliviano','BOB','Bs.',1,0,'.',',','default.png'),(20,'Brazilian Real','BRL','R$',1,0,'.',',','default.png'),(21,'Bahamian Dollar','BSD','$',1,0,'.',',','default.png'),(22,'Bitcoin','BTC','₿',1,0,'.',',','default.png'),(23,'Bhutanese Ngultrum','BTN','Nu.',1,1,'.',',','default.png'),(24,'Botswanan Pula','BWP','P',1,0,'.',',','default.png'),(25,'Belarusian Ruble','BYR','Br',0,1,'.',',','default.png'),(26,'Belize Dollar','BZD','$',1,0,'.',',','default.png'),(27,'Canadian Dollar','CAD','$',1,0,'.',',','default.png'),(28,'Congolese Franc','CDF','FC',0,1,'.',',','default.png'),(29,'Swiss Franc','CHF','CHF',1,1,'.',',','default.png'),(30,'Chilean Unit of Account (UF)','CLF','UF',1,1,'.',',','default.png'),(31,'Chilean Peso','CLP','$',1,0,'.',',','default.png'),(32,'Chinese Yuan','CNY','¥',1,0,'.',',','default.png'),(33,'Colombian Peso','COP','$',1,0,'.',',','default.png'),(34,'Costa Rican Colón','CRC','₡',1,0,'.',',','default.png'),(35,'Cuban Convertible Peso','CUC','$',1,0,'.',',','default.png'),(36,'Cuban Peso','CUP','$',1,0,'.',',','default.png'),(37,'Cape Verdean Escudo','CVE','$',1,1,'.',',','default.png'),(38,'Czech Republic Koruna','CZK','Kč',0,1,'.',',','default.png'),(39,'Djiboutian Franc','DJF','Fdj',0,1,'.',',','default.png'),(40,'Danish Krone','DKK','kr',0,1,'.',',','default.png'),(41,'Dominican Peso','DOP','$',1,0,'.',',','default.png'),(42,'Algerian Dinar','DZD','د.ج',0,0,'.',',','default.png'),(43,'Egyptian Pound','EGP','£',0,1,'.',',','default.png'),(44,'Eritrean Nakfa','ERN','Nfk',0,1,'.',',','default.png'),(45,'Ethiopian Birr','ETB','Br',0,1,'.',',','default.png'),(46,'Euro','EUR','€',1,0,'.',',','default.png'),(47,'Fijian Dollar','FJD','$',1,0,'.',',','default.png'),(48,'Falkland Islands Pound','FKP','£',1,0,'.',',','default.png'),(49,'British Pound Sterling','GBP','£',1,0,'.',',','default.png'),(50,'Georgian Lari','GEL','ლ',1,0,'.',',','default.png'),(51,'Guernsey Pound','GGP','£',1,0,'.',',','default.png'),(52,'Ghanaian Cedi','GHS','₵',1,0,'.',',','default.png'),(53,'Gibraltar Pound','GIP','£',1,0,'.',',','default.png'),(54,'Gambian Dalasi','GMD','D',1,0,'.',',','default.png'),(55,'Guinean Franc','GNF','FG',0,1,'.',',','default.png'),(56,'Guatemalan Quetzal','GTQ','Q',1,0,'.',',','default.png'),(57,'Guyanaese Dollar','GYD','$',1,0,'.',',','default.png'),(58,'Hong Kong Dollar','HKD','$',1,0,'.',',','default.png'),(59,'Honduran Lempira','HNL','L',1,1,'.',',','default.png'),(60,'Croatian Kuna','HRK','kn',0,1,'.',',','default.png'),(61,'Haitian Gourde','HTG','G',0,1,'.',',','default.png'),(62,'Hungarian Forint','HUF','Ft',0,1,'.',',','default.png'),(63,'Indonesian Rupiah','IDR','Rp',1,0,'.',',','default.png'),(64,'Israeli New Sheqel','ILS','₪',1,0,'.',',','default.png'),(65,'Manx pound','IMP','£',1,0,'.',',','default.png'),(66,'Indian Rupee','INR','₹',1,0,'.',',','default.png'),(67,'Iraqi Dinar','IQD','ع.د',0,1,'.',',','default.png'),(68,'Iranian Rial','IRR','﷼',1,0,'.',',','default.png'),(69,'Icelandic Króna','ISK','kr',1,1,'.',',','default.png'),(70,'Jersey Pound','JEP','£',1,0,'.',',','default.png'),(71,'Jamaican Dollar','JMD','J$',1,0,'.',',','default.png'),(72,'Jordanian Dinar','JOD','JD',0,1,'.',',','default.png'),(73,'Japanese Yen','JPY','¥',1,0,'.',',','default.png'),(74,'Kenyan Shilling','KES','KSh',0,1,'.',',','default.png'),(75,'Kyrgystani Som','KGS','сом',0,1,'.',',','default.png'),(76,'Cambodian Riel','KHR','៛',0,1,'.',',','default.png'),(77,'Comorian Franc','KMF','CF',0,1,'.',',','default.png'),(78,'North Korean Won','KPW','₩',1,0,'.',',','default.png'),(79,'South Korean Won','KRW','₩',1,0,'.',',','default.png'),(80,'Kuwaiti Dinar','KWD','KD',0,1,'.',',','default.png'),(81,'Cayman Islands Dollar','KYD','$',1,0,'.',',','default.png'),(82,'Kazakhstani Tenge','KZT','₸',1,0,'.',',','default.png'),(83,'Laotian Kip','LAK','₭',1,0,'.',',','default.png'),(84,'Lebanese Pound','LBP','ل.ل',0,1,'.',',','default.png'),(85,'Sri Lankan Rupee','LKR','Rs',1,0,'.',',','default.png'),(86,'Liberian Dollar','LRD','$',1,0,'.',',','default.png'),(87,'Lesotho Loti','LSL','L',1,1,'.',',','default.png'),(88,'Lithuanian Litas','LTL','Lt',0,1,'.',',','default.png'),(89,'Latvian Lats','LVL','Ls',0,1,'.',',','default.png'),(90,'Libyan Dinar','LYD','LD',1,1,'.',',','default.png'),(91,'Moroccan Dirham','MAD','د.م.',0,1,'.',',','default.png'),(92,'Moldovan Leu','MDL','L',1,1,'.',',','default.png'),(93,'Malagasy Ariary','MGA','Ar',1,0,'.',',','default.png'),(94,'Macedonian Denar','MKD','ден',0,1,'.',',','default.png'),(95,'Myanma Kyat','MMK','K',1,1,'.',',','default.png'),(96,'Mongolian Tugrik','MNT','₮',1,0,'.',',','default.png'),(97,'Macanese Pataca','MOP','MOP$',0,1,'.',',','default.png'),(98,'Mauritanian Ouguiya','MRO','UM',1,1,'.',',','default.png'),(99,'Mauritian Rupee','MUR','₨',1,0,'.',',','default.png'),(100,'Maldivian Rufiyaa','MVR','Rf',0,1,'.',',','default.png'),(101,'Malawian Kwacha','MWK','MK',1,1,'.',',','default.png'),(102,'Mexican Peso','MXN','$',1,0,'.',',','default.png'),(103,'Malaysian Ringgit','MYR','RM',1,1,'.',',','default.png'),(104,'Mozambican Metical','MZN','MT',1,1,'.',',','default.png'),(105,'Namibian Dollar','NAD','$',1,0,'.',',','default.png'),(106,'Nigerian Naira','NGN','₦',1,0,'.',',','default.png'),(107,'Nicaraguan Córdoba','NIO','C$',1,0,'.',',','default.png'),(108,'Norwegian Krone','NOK','kr',1,1,'.',',','default.png'),(109,'Nepalese Rupee','NPR','₨',1,0,'.',',','default.png'),(110,'New Zealand Dollar','NZD','$',1,0,'.',',','default.png'),(111,'Omani Rial','OMR','﷼',1,0,'.',',','default.png'),(112,'Panamanian Balboa','PAB','B/.',0,1,'.',',','default.png'),(113,'Peruvian Nuevo Sol','PEN','S/.',0,1,'.',',','default.png'),(114,'Papua New Guinean Kina','PGK','K',1,1,'.',',','default.png'),(115,'Philippine Peso','PHP','₱',1,0,'.',',','default.png'),(116,'Pakistani Rupee','PKR','₨',1,0,'.',',','default.png'),(117,'Polish Zloty','PLN','zł',0,1,'.',',','default.png'),(118,'Paraguayan Guarani','PYG','Gs',1,0,'.',',','default.png'),(119,'Qatari Rial','QAR','﷼',1,0,'.',',','default.png'),(120,'Romanian Leu','RON','lei',0,1,'.',',','default.png'),(121,'Serbian Dinar','RSD','дин',0,1,'.',',','default.png'),(122,'Russian Ruble','RUB','₽',1,0,'.',',','default.png'),(123,'Rwandan Franc','RWF','RF',1,0,'.',',','default.png'),(124,'Saudi Riyal','SAR','﷼',1,0,'.',',','default.png'),(125,'Solomon Islands Dollar','SBD','$',1,0,'.',',','default.png'),(126,'Seychellois Rupee','SCR','₨',1,0,'.',',','default.png'),(127,'Sudanese Pound','SDG','£',1,0,'.',',','default.png'),(128,'Swedish Krona','SEK','kr',0,1,'.',',','default.png'),(129,'Singapore Dollar','SGD','$',1,0,'.',',','default.png'),(130,'Saint Helena Pound','SHP','£',1,0,'.',',','default.png'),(131,'Sierra Leonean Leone','SLL','Le',1,1,'.',',','default.png'),(132,'Somali Shilling','SOS','Sh',1,1,'.',',','default.png'),(133,'Surinamese Dollar','SRD','$',1,0,'.',',','default.png'),(134,'São Tomé and Príncipe Dobra','STD','Db',1,1,'.',',','default.png'),(135,'Salvadoran Colón','SVC','₡',1,0,'.',',','default.png'),(136,'Syrian Pound','SYP','£S',1,1,'.',',','default.png'),(137,'Swazi Lilangeni','SZL','E',1,1,'.',',','default.png'),(138,'Thai Baht','THB','฿',1,0,'.',',','default.png'),(139,'Tajikistani Somoni','TJS','ЅМ',1,1,'.',',','default.png'),(140,'Turkmenistani Manat','TMT','m',1,1,'.',',','default.png'),(141,'Tunisian Dinar','TND','د.ت',0,1,'.',',','default.png'),(142,'Tongan Paʻanga','TOP','T$',1,1,'.',',','default.png'),(143,'Turkish Lira','TRY','₺',1,0,'.',',','default.png'),(144,'Trinidad and Tobago Dollar','TTD','TT$',1,0,'.',',','default.png'),(145,'New Taiwan Dollar','TWD','$',1,0,'.',',','default.png'),(146,'Tanzanian Shilling','TZS','Sh',1,1,'.',',','default.png'),(147,'Ukrainian Hryvnia','UAH','₴',1,0,'.',',','default.png'),(148,'Ugandan Shilling','UGX','USh',0,1,'.',',','default.png'),(149,'United States Dollar','USD','$',1,0,'.',',','default.png'),(150,'Uruguayan Peso','UYU','$U',1,1,'.',',','default.png'),(151,'Uzbekistan Som','UZS','лв',0,1,'.',',','default.png'),(152,'Venezuelan Bolívar Fuerte','VEF','Bs',1,1,'.',',','default.png'),(153,'Vietnamese Dong','VND','₫',1,0,'.',',','default.png'),(154,'Vanuatu Vatu','VUV','Vt',0,1,'.',',','default.png'),(155,'Samoan Tala','WST','WS$',1,1,'.',',','default.png'),(156,'CFA Franc BEAC','XAF','FCFA',1,1,'.',',','default.png'),(157,'Silver (troy ounce)','XAG','XAG',1,0,'.',',','default.png'),(158,'Gold (troy ounce)','XAU','XAU',1,0,'.',',','default.png'),(159,'East Caribbean Dollar','XCD','EC$',1,0,'.',',','default.png'),(160,'Special Drawing Rights','XDR','SDR',1,0,'.',',','default.png'),(161,'CFA Franc BCEAO','XOF','CFA',1,1,'.',',','default.png'),(162,'CFP Franc','XPF','CFPF',1,1,'.',',','default.png'),(163,'Yemeni Rial','YER','﷼',1,0,'.',',','default.png'),(164,'South African Rand','ZAR','R',1,1,'.',',','default.png'),(165,'Zambian Kwacha (pre-2013)','ZMK','ZK',1,1,'.',',','default.png'),(166,'Zambian Kwacha','ZMW','ZK',1,1,'.',',','default.png'),(167,'Zimbabwean Dollar','ZWL','Z$',1,0,'.',',','default.png');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_rows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int unsigned NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,'',1),(2,1,'author_id','text','Author',1,0,1,1,0,1,'',2),(3,1,'category_id','text','Category',1,0,1,1,1,0,'',3),(4,1,'title','text','Title',1,1,1,1,1,1,'',4),(5,1,'excerpt','text_area','excerpt',1,0,1,1,1,1,'',5),(6,1,'body','rich_text_box','Body',1,0,1,1,1,1,'',6),(7,1,'image','image','Post Image',0,1,1,1,1,1,'{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}',7),(8,1,'slug','text','slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true}}',8),(9,1,'meta_description','text_area','meta_description',1,0,1,1,1,1,'',9),(10,1,'meta_keywords','text_area','meta_keywords',1,0,1,1,1,1,'',10),(11,1,'status','select_dropdown','status',1,1,1,1,1,1,'{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}',11),(12,1,'created_at','timestamp','created_at',0,1,1,0,0,0,'',12),(13,1,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',13),(26,3,'id','number','id',1,0,0,0,0,0,NULL,1),(27,3,'name','text','name',1,1,1,1,1,1,NULL,2),(28,3,'email','text','email',1,1,1,1,1,1,NULL,3),(29,3,'password','password','password',1,0,0,1,1,0,NULL,5),(30,3,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"on\"}',11),(31,3,'remember_token','text','remember_token',0,0,0,0,0,0,NULL,6),(32,3,'created_at','timestamp','created_at',0,1,1,0,0,0,NULL,7),(33,3,'updated_at','timestamp','updated_at',0,0,0,0,0,0,NULL,8),(34,3,'avatar','image','avatar',0,1,1,1,1,1,NULL,9),(35,5,'id','number','id',1,0,0,0,0,0,'',1),(36,5,'name','text','name',1,1,1,1,1,1,'',2),(37,5,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),(38,5,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),(39,4,'id','number','id',1,0,0,0,0,0,'',1),(40,4,'parent_id','select_dropdown','parent_id',0,0,1,1,1,1,'{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2),(41,4,'order','text','order',1,1,1,1,1,1,'{\"default\":1}',3),(42,4,'name','text','name',1,1,1,1,1,1,'',4),(43,4,'slug','text','slug',1,1,1,1,1,1,'{\"slugify\":{\"origin\":\"name\"}}',5),(44,4,'created_at','timestamp','created_at',0,0,1,0,0,0,'',6),(45,4,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',7),(46,6,'id','number','id',1,0,0,0,0,0,'',1),(47,6,'name','text','Name',1,1,1,1,1,1,'',2),(48,6,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),(49,6,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),(50,6,'display_name','text','Display Name',1,1,1,1,1,1,'',5),(51,1,'seo_title','text','seo_title',0,1,1,1,1,1,'',14),(52,1,'featured','checkbox','featured',1,1,1,1,1,1,'',15),(53,3,'role_id','text','role_id',0,1,1,1,1,1,NULL,10),(54,3,'username','text','Username',1,1,1,1,1,1,NULL,4),(55,7,'id','hidden','Id',1,0,0,0,0,0,NULL,1),(56,7,'title','text','Title',1,1,1,1,1,1,NULL,2),(57,7,'description','text_area','Description (max 250 characters)',1,1,1,1,1,1,NULL,3),(58,7,'body','rich_text_box','Body',1,0,1,1,1,1,NULL,4),(59,7,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,5),(60,7,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,6),(61,3,'settings','hidden','Settings',0,1,1,1,1,1,NULL,9),(62,3,'user_belongstomany_role_relationship','relationship','Roles',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\"}',11),(63,3,'locale','text','Locale',0,1,1,1,1,0,'',12);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'posts','posts','Post','Posts','voyager-news','TCG\\Voyager\\Models\\Post','TCG\\Voyager\\Policies\\PostPolicy','','',1,0,NULL,'2017-11-21 16:23:22','2017-11-21 16:23:22'),(3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy',NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null}','2017-11-21 16:23:22','2018-06-22 20:29:47'),(4,'categories','categories','Category','Categories','voyager-categories','TCG\\Voyager\\Models\\Category',NULL,'','',1,0,NULL,'2017-11-21 16:23:22','2017-11-21 16:23:22'),(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,NULL,'2017-11-21 16:23:22','2017-11-21 16:23:22'),(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController','',1,0,NULL,'2017-11-21 16:23:22','2017-11-21 16:23:22'),(7,'announcements','announcements','Announcement','Announcements','voyager-megaphone','Wave\\Announcement',NULL,NULL,NULL,1,0,NULL,'2018-05-20 21:08:14','2018-05-20 21:08:14');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_availabilities`
--

DROP TABLE IF EXISTS `equipment_availabilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment_availabilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `horaire_start` time NOT NULL,
  `horaire_end` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_availabilities`
--

LOCK TABLES `equipment_availabilities` WRITE;
/*!40000 ALTER TABLE `equipment_availabilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_availabilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_dependencies`
--

DROP TABLE IF EXISTS `equipment_dependencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment_dependencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `child_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `equipment_dependencies_parent_id_foreign` (`parent_id`),
  KEY `equipment_dependencies_child_id_foreign` (`child_id`),
  CONSTRAINT `equipment_dependencies_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `equipments` (`id`),
  CONSTRAINT `equipment_dependencies_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `equipments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_dependencies`
--

LOCK TABLES `equipment_dependencies` WRITE;
/*!40000 ALTER TABLE `equipment_dependencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_dependencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_descriptions`
--

DROP TABLE IF EXISTS `equipment_descriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment_descriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_room` tinyint(1) NOT NULL,
  `is_furniture` tinyint(1) NOT NULL,
  `is_accesory` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_descriptions`
--

LOCK TABLES `equipment_descriptions` WRITE;
/*!40000 ALTER TABLE `equipment_descriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipments`
--

DROP TABLE IF EXISTS `equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipments`
--

LOCK TABLES `equipments` WRITE;
/*!40000 ALTER TABLE `equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_currencies`
--

DROP TABLE IF EXISTS `exchange_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exchange_currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `exchange_rate` decimal(15,8) NOT NULL,
  `currency_id` bigint unsigned NOT NULL,
  `day_of_exchange` date NOT NULL,
  `exchange_to` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exchange_currencies_currency_id_foreign` (`currency_id`),
  KEY `exchange_currencies_exchange_to_foreign` (`exchange_to`),
  CONSTRAINT `exchange_currencies_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `exchange_currencies_exchange_to_foreign` FOREIGN KEY (`exchange_to`) REFERENCES `currencies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_currencies`
--

LOCK TABLES `exchange_currencies` WRITE;
/*!40000 ALTER TABLE `exchange_currencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchange_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_properties`
--

DROP TABLE IF EXISTS `fees_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fees_properties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint unsigned NOT NULL,
  `property_fee_id` bigint unsigned NOT NULL,
  `amount` int NOT NULL,
  `operation` int NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fees_properties_property_id_foreign` (`property_id`),
  KEY `fees_properties_property_fee_id_foreign` (`property_fee_id`),
  CONSTRAINT `fees_properties_property_fee_id_foreign` FOREIGN KEY (`property_fee_id`) REFERENCES `property_fees` (`id`),
  CONSTRAINT `fees_properties_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_properties`
--

LOCK TABLES `fees_properties` WRITE;
/*!40000 ALTER TABLE `fees_properties` DISABLE KEYS */;
/*!40000 ALTER TABLE `fees_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filament_media_library`
--

DROP TABLE IF EXISTS `filament_media_library`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filament_media_library` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uploaded_by_user_id` bigint unsigned DEFAULT NULL,
  `caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filament_media_library_uploaded_by_user_id_foreign` (`uploaded_by_user_id`),
  KEY `filament_media_library_folder_id_foreign` (`folder_id`),
  CONSTRAINT `filament_media_library_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `filament_media_library_folders` (`id`),
  CONSTRAINT `filament_media_library_uploaded_by_user_id_foreign` FOREIGN KEY (`uploaded_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filament_media_library`
--

LOCK TABLES `filament_media_library` WRITE;
/*!40000 ALTER TABLE `filament_media_library` DISABLE KEYS */;
/*!40000 ALTER TABLE `filament_media_library` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filament_media_library_folders`
--

DROP TABLE IF EXISTS `filament_media_library_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filament_media_library_folders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filament_media_library_folders`
--

LOCK TABLES `filament_media_library_folders` WRITE;
/*!40000 ALTER TABLE `filament_media_library_folders` DISABLE KEYS */;
/*!40000 ALTER TABLE `filament_media_library_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `icals`
--

DROP TABLE IF EXISTS `icals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `icals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ical_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  `partenaire_id` bigint unsigned NOT NULL,
  `calendar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `icals_property_id_foreign` (`property_id`),
  KEY `icals_partenaire_id_foreign` (`partenaire_id`),
  CONSTRAINT `icals_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `icals_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `icals`
--

LOCK TABLES `icals` WRITE;
/*!40000 ALTER TABLE `icals` DISABLE KEYS */;
INSERT INTO `icals` VALUES (1,'https://api.hospitable.com/v1/properties/reservations.ics?key=1479146&token=64742f53-9c4d-4b9a-baae-aa529307b6c1&noCache',1,2,'ImportedCalendar','2024-08-09 19:14:32','2024-08-09 19:14:32'),(2,'https://api.hospitable.com/v1/properties/reservations.ics?key=1415444&token=bf5e0612-d0c6-47f0-9ac9-1edeb50b25f8&noCache',2,2,'Ain itti','2024-08-09 00:00:00',NULL);
/*!40000 ALTER TABLE `icals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2017-11-21 16:23:22','2017-11-21 16:23:22','voyager.dashboard',NULL),(2,1,'Media','','_self','voyager-images',NULL,NULL,5,'2017-11-21 16:23:22','2018-07-03 04:51:09','voyager.media.index',NULL),(3,1,'Posts','','_self','voyager-news',NULL,NULL,6,'2017-11-21 16:23:22','2018-07-03 04:51:09','voyager.posts.index',NULL),(4,1,'Users','','_self','voyager-person',NULL,NULL,4,'2017-11-21 16:23:22','2018-07-03 04:51:09','voyager.users.index',NULL),(5,1,'Categories','','_self','voyager-categories',NULL,NULL,8,'2017-11-21 16:23:22','2018-07-03 04:51:09','voyager.categories.index',NULL),(7,1,'Roles','','_self','voyager-lock',NULL,NULL,3,'2017-11-21 16:23:22','2018-07-03 04:51:09','voyager.roles.index',NULL),(8,1,'Tools','','_self','voyager-tools',NULL,NULL,10,'2017-11-21 16:23:22','2018-07-03 04:51:03',NULL,NULL),(9,1,'Menu Builder','','_self','voyager-list',NULL,8,1,'2017-11-21 16:23:22','2018-05-20 21:08:37','voyager.menus.index',NULL),(10,1,'Database','','_self','voyager-data',NULL,8,2,'2017-11-21 16:23:22','2018-05-20 21:08:37','voyager.database.index',NULL),(11,1,'Compass','/admin/compass','_self','voyager-compass',NULL,8,3,'2017-11-21 16:23:22','2018-05-20 21:08:37',NULL,NULL),(13,1,'Settings','','_self','voyager-settings',NULL,NULL,11,'2017-11-21 16:23:22','2018-07-03 04:51:04','voyager.settings.index',NULL),(14,1,'Themes','/admin/themes','_self','voyager-paint-bucket',NULL,NULL,12,'2017-11-21 16:31:00','2018-07-03 04:51:04',NULL,NULL),(15,2,'Dashboard','','_self','home','#000000',NULL,1,'2017-11-28 14:48:21','2018-03-23 16:25:44','wave.dashboard','null'),(16,2,'Resources','#_','_self','info','#000000',NULL,2,'2017-11-28 14:49:36','2017-11-28 15:11:13',NULL,''),(19,2,'Next Child','/next','_self',NULL,'#000000',18,1,'2017-11-28 14:56:58','2017-11-28 14:57:10',NULL,''),(20,2,'Next Child 2','/next','_self',NULL,'#000000',18,2,'2017-11-28 14:57:07','2017-11-28 14:57:12',NULL,''),(21,2,'Documentation','/docs','_self',NULL,'#000000',16,1,'2017-11-28 15:08:56','2017-11-28 15:09:14',NULL,''),(22,2,'Videos','https://devdojo.com/series/wave','_blank',NULL,'#000000',16,2,'2017-11-28 15:09:22','2017-11-28 15:09:25',NULL,''),(23,2,'Support','https://devdojo.com/forums/category/wave','_blank','lifesaver','#000000',NULL,3,'2017-11-28 15:09:56','2018-03-31 18:22:05',NULL,''),(25,2,'Blog','/blog','_self',NULL,'#000000',16,3,'2018-03-31 18:22:02','2018-03-31 18:22:08',NULL,''),(26,3,'Home','/#','_self',NULL,'#000000',NULL,99,'2018-04-13 22:29:33','2018-08-28 18:39:05',NULL,''),(27,3,'Features','/#features','_self',NULL,'#000000',NULL,100,'2018-04-13 22:30:26','2018-08-28 00:24:49',NULL,''),(28,3,'Testimonials','/#testimonials','_self',NULL,'#000000',NULL,101,'2018-04-13 22:31:03','2018-08-28 00:24:57',NULL,''),(29,3,'Pricing','/#pricing','_self',NULL,'#000000',NULL,102,'2018-04-13 22:31:52','2018-08-28 00:25:04',NULL,''),(30,1,'Announcements','/admin/announcements','_self','voyager-megaphone',NULL,NULL,9,'2018-05-20 21:08:14','2018-07-03 04:51:03',NULL,NULL),(31,1,'BREAD','','_self','voyager-bread','#000000',8,4,'2018-06-22 20:53:25','2018-06-22 20:54:13','voyager.bread.index',NULL),(33,3,'Blog','','_self',NULL,'#000000',NULL,103,'2018-08-24 19:41:14','2018-08-24 19:41:14','wave.blog',NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2017-11-21 16:23:22','2017-11-21 16:23:22'),(2,'authenticated-menu','2017-11-28 14:47:49','2018-04-13 22:25:28'),(3,'guest-menu','2018-04-13 22:25:37','2018-04-13 22:25:37');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reply_to_id` bigint unsigned DEFAULT NULL,
  `conversation_id` bigint unsigned NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `order` tinyint NOT NULL,
  `message_type` enum('message','notification') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'message',
  `message_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_conversation_id_foreign` (`conversation_id`),
  KEY `messages_reply_to_id_foreign` (`reply_to_id`),
  KEY `messages_contact_id_foreign` (`contact_id`),
  CONSTRAINT `messages_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_reply_to_id_foreign` FOREIGN KEY (`reply_to_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_01_01_000000_add_voyager_user_fields',1),(4,'2016_01_01_000000_create_data_types_table',1),(5,'2016_01_01_000000_create_pages_table',1),(6,'2016_01_01_000000_create_posts_table',1),(7,'2016_02_15_204651_create_categories_table',1),(8,'2016_05_19_173453_create_menu_table',1),(9,'2016_06_01_000001_create_oauth_auth_codes_table',1),(10,'2016_06_01_000002_create_oauth_access_tokens_table',1),(11,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(12,'2016_06_01_000004_create_oauth_clients_table',1),(13,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(14,'2016_10_21_190000_create_roles_table',1),(15,'2016_10_21_190000_create_settings_table',1),(16,'2016_11_30_135954_create_permission_table',1),(17,'2016_11_30_141208_create_permission_role_table',1),(18,'2016_12_26_201236_data_types__add__server_side',1),(19,'2017_01_13_000000_add_route_to_menu_items_table',1),(20,'2017_01_14_005015_create_translations_table',1),(21,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),(22,'2017_03_06_000000_add_controller_to_data_types_table',1),(23,'2017_04_11_000000_alter_post_nullable_fields_table',1),(24,'2017_04_21_000000_add_order_to_data_rows_table',1),(25,'2017_07_05_210000_add_policyname_to_data_types_table',1),(26,'2017_08_05_000000_add_group_to_settings_table',1),(27,'2017_11_26_013050_add_user_role_relationship',1),(28,'2017_11_26_015000_create_user_roles_table',1),(29,'2018_03_11_000000_add_user_settings',1),(30,'2018_03_14_000000_add_details_to_data_types_table',1),(31,'2018_03_16_000000_make_settings_value_nullable',1),(32,'2018_09_22_234251_add_permissions_group_id_to_permissions_table',1),(33,'2018_09_22_234251_add_username_billing_to_users',1),(34,'2018_09_22_234251_create_announcement_user_table',1),(35,'2018_09_22_234251_create_announcements_table',1),(36,'2018_09_22_234251_create_api_keys_table',1),(37,'2018_09_22_234251_create_notifications_table',1),(38,'2018_09_22_234251_create_permission_groups_table',1),(39,'2018_09_22_234251_create_plans_table',1),(40,'2018_09_22_234251_create_subscriptions_table',1),(41,'2018_09_22_234251_create_voyager_theme_options_table',1),(42,'2018_09_22_234251_create_voyager_themes_table',1),(43,'2018_09_22_234251_create_wave_key_values_table',1),(44,'2018_09_22_234252_add_foreign_keys_to_announcement_user_table',1),(45,'2018_09_22_234252_add_foreign_keys_to_plans_table',1),(46,'2020_03_30_032031_change_voyager_themes_table_name',1),(47,'2020_04_22_234252_add_foreign_keys_to_voyager_theme_options_table',1),(48,'2020_06_23_210721_add_stripe_status_column_to_subscriptions_table',1),(49,'2020_07_03_000003_create_subscription_items_table',1),(50,'2021_01_28_041011_create_paddle_subscriptions_table',1),(51,'2021_01_28_182638_removing_cashier_sub_tables',1),(52,'2021_01_29_173720_add_slug_column_to_plans_table',1),(53,'2022_05_12_011008_add_payment_dates_to_paddle_subscriptions',1),(54,'2024_04_10_073538_create_properties_table',1),(55,'2024_04_10_073912_create_property_attributes_table',1),(56,'2024_04_11_073841_create_property_addresses_table',1),(57,'2024_04_12_092326_create_property_fees_table',1),(58,'2024_04_16_073136_create_bookings_table',1),(59,'2024_04_16_090026_create_booking_guests_table',1),(60,'2024_04_16_092304_create_partenaires_table',1),(61,'2024_04_16_093931_create_booking_statuses_table',1),(62,'2024_04_16_094552_create_status_correspondances_table',1),(63,'2024_04_16_114753_create_property_photos_table',1),(64,'2024_04_16_133458_create_property_equipements_table',1),(65,'2024_04_22_165021_create_contacts_table',1),(66,'2024_04_23_131543_create_conversations_table',1),(67,'2024_04_23_131553_create_messages_table',1),(68,'2024_04_23_131554_create_contact_conversation_table',1),(69,'2024_05_09_143454_create_attachments_table',1),(70,'2024_05_24_141141_create_icals_table',1),(71,'2024_05_28_194001_create_permissions_table',1),(72,'2024_05_29_010432_create_teams_table',1),(73,'2024_05_29_010649_create_property_multi_unit_table',1),(74,'2024_05_30_140727_create_currencies_table',1),(75,'2024_06_10_142144_create_my_features_table',1),(76,'2024_06_10_142301_create_my_roles_table',1),(77,'2024_06_10_142425_create_my_role_permissions_table',1),(78,'2024_06_10_142659_create_property_teams_table',1),(79,'2024_06_10_142812_create_user_permissions_table',1),(80,'2024_06_10_142934_create_user_roles_table',1),(81,'2024_06_10_143202_create_notifications_table',1),(82,'2024_06_10_143317_create_notification_types_table',1),(83,'2024_06_10_143544_create_notification_roles_table',1),(84,'2024_06_10_143807_create_user_channels_table',1),(85,'2024_06_17_153114_create_property_types_table',1),(86,'2024_06_17_160138_create_timezones_table',1),(87,'2024_06_24_155939_create_media_table',1),(88,'2024_06_27_151850_create_property_partenaire_table',1),(89,'2024_07_18_092103_create_contact_message_table',1),(90,'2024_07_19_100908_create_sessions_table',1),(91,'2024_07_19_101111_create_cache_table',1),(92,'2024_07_19_101227_create_jobs_table',1),(93,'2024_07_19_101540_create_personal_access_tokens_table',1),(94,'2024_07_22_102714_create_filament_media_library_table',1),(95,'2024_07_22_102715_create_filament_media_library_folders_table',1),(96,'2024_07_25_082426_create_countries_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_features`
--

DROP TABLE IF EXISTS `my_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_features`
--

LOCK TABLES `my_features` WRITE;
/*!40000 ALTER TABLE `my_features` DISABLE KEYS */;
INSERT INTO `my_features` VALUES (1,'Inbox',NULL,NULL),(2,'Calendar',NULL,NULL),(3,'Teams',NULL,NULL);
/*!40000 ALTER TABLE `my_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_notifications`
--

DROP TABLE IF EXISTS `my_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `my_notifications_conversation_id_foreign` (`conversation_id`),
  KEY `my_notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `my_notifications_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`),
  CONSTRAINT `my_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_notifications`
--

LOCK TABLES `my_notifications` WRITE;
/*!40000 ALTER TABLE `my_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_permissions`
--

DROP TABLE IF EXISTS `my_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_permissions`
--

LOCK TABLES `my_permissions` WRITE;
/*!40000 ALTER TABLE `my_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_role_permissions`
--

DROP TABLE IF EXISTS `my_role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_role_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `my_role_id` bigint unsigned NOT NULL,
  `my_feature_id` bigint unsigned NOT NULL,
  `read` tinyint(1) NOT NULL,
  `write` tinyint(1) NOT NULL,
  `edit` tinyint(1) NOT NULL,
  `share` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  `privacy` tinyint(1) NOT NULL,
  `price` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `my_role_permissions_my_role_id_foreign` (`my_role_id`),
  KEY `my_role_permissions_my_feature_id_foreign` (`my_feature_id`),
  CONSTRAINT `my_role_permissions_my_feature_id_foreign` FOREIGN KEY (`my_feature_id`) REFERENCES `my_features` (`id`),
  CONSTRAINT `my_role_permissions_my_role_id_foreign` FOREIGN KEY (`my_role_id`) REFERENCES `my_roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_role_permissions`
--

LOCK TABLES `my_role_permissions` WRITE;
/*!40000 ALTER TABLE `my_role_permissions` DISABLE KEYS */;
INSERT INTO `my_role_permissions` VALUES (1,1,1,1,0,0,0,0,0,0,'2024-08-09 13:19:44','2024-08-09 13:19:44'),(2,1,2,1,0,0,0,0,0,0,'2024-08-09 13:19:44','2024-08-09 13:19:44'),(3,1,3,1,0,0,0,0,0,0,'2024-08-09 13:19:44','2024-08-09 13:19:44'),(4,2,1,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(5,2,2,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(6,2,3,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(7,3,1,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(8,3,2,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(9,3,3,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(10,4,1,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(11,4,2,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(12,4,3,1,0,0,0,0,0,0,'2024-08-09 13:19:45','2024-08-09 13:19:45'),(13,5,1,1,0,0,0,0,0,0,'2024-08-09 13:19:46','2024-08-09 13:19:46'),(14,5,2,1,0,0,0,0,0,0,'2024-08-09 13:19:46','2024-08-09 13:19:46'),(15,5,3,1,0,0,0,0,0,0,'2024-08-09 13:19:46','2024-08-09 13:19:46'),(16,6,1,1,0,0,0,0,0,0,'2024-08-09 13:19:46','2024-08-09 13:19:46'),(17,6,2,1,0,0,0,0,0,0,'2024-08-09 13:19:46','2024-08-09 13:19:46'),(18,6,3,1,0,0,0,0,0,0,'2024-08-09 13:19:46','2024-08-09 13:19:46'),(19,7,1,1,0,0,0,0,0,0,'2024-08-09 13:19:46','2024-08-09 13:19:46'),(20,7,2,1,0,0,0,0,0,0,'2024-08-09 13:19:47','2024-08-09 13:19:47'),(21,7,3,1,0,0,0,0,0,0,'2024-08-09 13:19:47','2024-08-09 13:19:47'),(22,8,1,1,0,0,0,0,0,0,'2024-08-09 13:19:47','2024-08-09 13:19:47'),(23,8,2,1,0,0,0,0,0,0,'2024-08-09 13:19:47','2024-08-09 13:19:47'),(24,8,3,1,0,0,0,0,0,0,'2024-08-09 13:19:47','2024-08-09 13:19:47'),(25,9,1,1,0,0,0,0,0,0,'2024-08-09 13:19:47','2024-08-09 13:19:47'),(26,9,2,1,0,0,0,0,0,0,'2024-08-09 13:19:47','2024-08-09 13:19:47'),(27,9,3,1,0,0,0,0,0,0,'2024-08-09 13:19:48','2024-08-09 13:19:48');
/*!40000 ALTER TABLE `my_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_roles`
--

DROP TABLE IF EXISTS `my_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_roles`
--

LOCK TABLES `my_roles` WRITE;
/*!40000 ALTER TABLE `my_roles` DISABLE KEYS */;
INSERT INTO `my_roles` VALUES (1,'Super Admin',1,NULL,NULL),(2,'Admin',2,NULL,NULL),(3,'Owner',3,NULL,NULL),(4,'Co-owner',4,NULL,NULL),(5,'Manager',5,NULL,NULL),(6,'Collaborator',6,NULL,NULL),(7,'Maid',7,NULL,NULL),(8,'Technician',8,NULL,NULL),(9,'Service Manager',9,NULL,NULL);
/*!40000 ALTER TABLE `my_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_user_permissions`
--

DROP TABLE IF EXISTS `my_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_user_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `my_feature_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `my_user_permissions_user_id_foreign` (`user_id`),
  KEY `my_user_permissions_my_feature_id_foreign` (`my_feature_id`),
  CONSTRAINT `my_user_permissions_my_feature_id_foreign` FOREIGN KEY (`my_feature_id`) REFERENCES `my_features` (`id`),
  CONSTRAINT `my_user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_user_permissions`
--

LOCK TABLES `my_user_permissions` WRITE;
/*!40000 ALTER TABLE `my_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_user_roles`
--

DROP TABLE IF EXISTS `my_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_user_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `my_role_id` bigint unsigned NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `my_user_roles_user_id_foreign` (`user_id`),
  KEY `my_user_roles_my_role_id_foreign` (`my_role_id`),
  KEY `my_user_roles_property_id_foreign` (`property_id`),
  CONSTRAINT `my_user_roles_my_role_id_foreign` FOREIGN KEY (`my_role_id`) REFERENCES `my_roles` (`id`),
  CONSTRAINT `my_user_roles_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  CONSTRAINT `my_user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_user_roles`
--

LOCK TABLES `my_user_roles` WRITE;
/*!40000 ALTER TABLE `my_user_roles` DISABLE KEYS */;
INSERT INTO `my_user_roles` VALUES (1,12,3,1,NULL,NULL),(2,12,3,2,NULL,NULL),(3,12,3,3,NULL,NULL);
/*!40000 ALTER TABLE `my_user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_roles`
--

DROP TABLE IF EXISTS `notification_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `notification_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_roles_notification_id_foreign` (`notification_id`),
  KEY `notification_roles_user_id_foreign` (`user_id`),
  CONSTRAINT `notification_roles_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `my_notifications` (`id`),
  CONSTRAINT `notification_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_roles`
--

LOCK TABLES `notification_roles` WRITE;
/*!40000 ALTER TABLE `notification_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_types`
--

DROP TABLE IF EXISTS `notification_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fournisseur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_types_notification_id_foreign` (`notification_id`),
  CONSTRAINT `notification_types_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `my_notifications` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_types`
--

LOCK TABLES `notification_types` WRITE;
/*!40000 ALTER TABLE `notification_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int unsigned NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paddle_subscriptions`
--

DROP TABLE IF EXISTS `paddle_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paddle_subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` int unsigned NOT NULL,
  `plan_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_payment_at` timestamp NULL DEFAULT NULL,
  `next_payment_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `paddle_subscriptions_subscription_id_unique` (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paddle_subscriptions`
--

LOCK TABLES `paddle_subscriptions` WRITE;
/*!40000 ALTER TABLE `paddle_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `paddle_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,1,'Hello World','Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.','<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','pages/page1.jpg','hello-world','Yar Meta Description','Keyword1, Keyword2','ACTIVE','2017-11-21 16:23:23','2017-11-21 16:23:23'),(2,1,'About','This is the about page.','<p>Wave is the ultimate&nbsp;Software as a Service Starter kit. If you\'ve ever wanted to create your own SAAS application, Wave can help save you hundreds of hours. Wave is one of a kind and it is built on top of Laravel and Voyager. Building your application is going to be funner&nbsp;than ever before... Funner may not be a real word, but you get where I\'m trying to go.</p>\n<p>Wave has a bunch of functionality built-in that will save you a bunch of time. Your users will be able to update their settings, billing information, profile information and so much more. You will also be able to accept&nbsp;payments from your user with multiple vendors.</p>\n<p>We want to help you build the SAAS of your dreams by making it easier and less time-consuming. Let\'s start creating some \"Waves\" and build out the SAAS in your particular niche... Sorry about that Wave pun...</p>',NULL,'about','About Wave','about, wave','ACTIVE','2018-03-30 03:04:51','2018-03-30 03:04:51');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partenaires`
--

DROP TABLE IF EXISTS `partenaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partenaires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_commercial` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_api` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `border_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partenaires`
--

LOCK TABLES `partenaires` WRITE;
/*!40000 ALTER TABLE `partenaires` DISABLE KEYS */;
INSERT INTO `partenaires` VALUES (1,'Airbnb','https://www.airbnb.com/','https://api.airbnb.com/','https://cdn.icon-icons.com/icons2/2699/PNG/512/airbnb_tile_logo_icon_168680.png','Airbnb is a platform for short-term rental accommodations.','#830000','#FFCBCD','2024-08-09 13:21:04','2024-08-09 13:21:04'),(2,'Hospitable','https://www.hospitable.com/','https://api.hospitable.com/','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6Ov5G8WRXQ6m4GSSy64g8z7c-RmvnfrJjzg&s','Hospitable offers vacation rental management services.','#003580','#AACDFF','2024-08-09 13:21:04','2024-08-09 13:21:04'),(3,'Travelnest','https://www.travelnest.com/','https://api.travelnest.com/','https://play-lh.googleusercontent.com/fi2B8nYvYc_zWcji3SCB80jW8wDU5H0uajEY7-VcRsrC2KDNUlYAVxWUdGFm2Qybrw=w240-h480-rw','Travelnest helps property managers market their vacation rentals.','#2D469B','#A5B9FF','2024-08-09 13:21:04','2024-08-09 13:21:04'),(4,'Booking','https://www.booking.com/','https://api.booking.com/','https://cdn.worldvectorlogo.com/logos/bookingcom-1.svg','Booking.com is one of the world leading online travel platforms,','#003580','#AACDFF','2024-08-09 13:21:04','2024-08-09 13:21:04'),(5,'inovRental','https','https','https:','ff','#003580','#AACDFF','2024-08-09 13:21:04','2024-08-09 13:21:04'),(6,'withoutBooking','https','https','https:','ff','','','2024-08-09 13:21:04','2024-08-09 13:21:04');
/*!40000 ALTER TABLE `partenaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_groups`
--

DROP TABLE IF EXISTS `permission_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_groups`
--

LOCK TABLES `permission_groups` WRITE;
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(6,2),(6,3),(6,4),(6,5),(7,1),(7,2),(7,3),(7,4),(7,5),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(16,3),(16,4),(16,5),(17,1),(17,3),(17,4),(17,5),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(26,2),(26,3),(26,4),(26,5),(27,1),(27,2),(27,3),(27,4),(27,5),(28,1),(29,1),(30,1),(31,1),(31,2),(31,3),(31,4),(31,5),(32,1),(32,2),(32,3),(32,4),(32,5),(33,1),(34,1),(35,1),(41,1),(42,1),(42,2),(42,3),(42,4),(42,5),(43,1),(43,2),(43,3),(43,4),(43,5),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(2,'browse_bread',NULL,'2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(3,'browse_database',NULL,'2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(4,'browse_media',NULL,'2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(5,'browse_compass',NULL,'2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(6,'browse_menus','menus','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(7,'read_menus','menus','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(8,'edit_menus','menus','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(9,'add_menus','menus','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(10,'delete_menus','menus','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(11,'browse_roles','roles','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(12,'read_roles','roles','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(13,'edit_roles','roles','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(14,'add_roles','roles','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(15,'delete_roles','roles','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(16,'browse_users','users','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(17,'read_users','users','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(18,'edit_users','users','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(19,'add_users','users','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(20,'delete_users','users','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(21,'browse_settings','settings','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(22,'read_settings','settings','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(23,'edit_settings','settings','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(24,'add_settings','settings','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(25,'delete_settings','settings','2018-06-22 20:15:45','2018-06-22 20:15:45',NULL),(26,'browse_categories','categories','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(27,'read_categories','categories','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(28,'edit_categories','categories','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(29,'add_categories','categories','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(30,'delete_categories','categories','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(31,'browse_posts','posts','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(32,'read_posts','posts','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(33,'edit_posts','posts','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(34,'add_posts','posts','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(35,'delete_posts','posts','2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(41,'browse_hooks',NULL,'2018-06-22 20:15:46','2018-06-22 20:15:46',NULL),(42,'browse_announcements','announcements','2018-05-20 21:08:14','2018-05-20 21:08:14',NULL),(43,'read_announcements','announcements','2018-05-20 21:08:14','2018-05-20 21:08:14',NULL),(44,'edit_announcements','announcements','2018-05-20 21:08:14','2018-05-20 21:08:14',NULL),(45,'add_announcements','announcements','2018-05-20 21:08:14','2018-05-20 21:08:14',NULL),(46,'delete_announcements','announcements','2018-05-20 21:08:14','2018-05-20 21:08:14',NULL),(47,'browse_themes','admin','2017-11-21 16:31:00','2017-11-21 16:31:00',NULL),(48,'browse_hooks','hooks','2018-06-22 13:55:03','2018-06-22 13:55:03',NULL),(49,'read_hooks','hooks','2018-06-22 13:55:03','2018-06-22 13:55:03',NULL),(50,'edit_hooks','hooks','2018-06-22 13:55:03','2018-06-22 13:55:03',NULL),(51,'add_hooks','hooks','2018-06-22 13:55:03','2018-06-22 13:55:03',NULL),(52,'delete_hooks','hooks','2018-06-22 13:55:03','2018-06-22 13:55:03',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (1,'property_images/01J4VR850B59W2XA4YQSW185EX.jpg',NULL,NULL,NULL,NULL,NULL),(2,'property_images/01J4VRDESVZG9CX75T8CHJJ5GG.jpg',NULL,NULL,NULL,NULL,NULL),(3,'property_images/01J4VRDESY9ESE8DPGY4Q29T43.jpg',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `role_id` bigint unsigned NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trial_days` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plans_slug_unique` (`slug`),
  KEY `plans_role_id_foreign` (`role_id`),
  CONSTRAINT `plans_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Basic','basic','Signup for the Basic User Plan to access all the basic features.','Basic Feature Example 1, Basic Feature Example 2, Basic Feature Example 3, Basic Feature Example 4','1',3,0,'5',0,'2018-07-03 05:03:56','2018-07-03 17:17:24'),(2,'Premium','premium','Signup for our premium plan to access all our Premium Features.','Premium Feature Example 1, Premium Feature Example 2, Premium Feature Example 3, Premium Feature Example 4','2',5,1,'8',0,'2018-07-03 16:29:46','2018-07-03 17:17:08'),(3,'Pro','pro','Gain access to our pro features with the pro plan.','Pro Feature Example 1, Pro Feature Example 2, Pro Feature Example 3, Pro Feature Example 4','3',4,0,'12',14,'2018-07-03 16:30:43','2018-08-22 22:26:19');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (5,1,1,'Best ways to market your application','Best ways to market your application',NULL,'<p>There are many different ways to market your application. First, let\'s start off at the beginning and then we will get more in-depth. You\'ll want to discover your target audience and after that, you\'ll want to run some ads.</p>\n<p>Let\'s not complicate things here, if you build a good product, you are going to have users. But you will need to let your users know where to find you. This is where social media and ads come in to play. You\'ll need to boast about your product and your app. If it\'s something that you really believe in, the odds are others will too.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src=\"/storage/posts/March2018/blog-1.jpg\" alt=\"blog\" /></p><p> Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful \"outside the box\" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric \"outside the box\" thinking. Interactively negotiate pandemic internal or \"organic\" sources whereas competitive relationships.</p>\n<figure><img src=\"/storage/posts/March2018/blog-2.jpg\" alt=\"wide\" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient \"outside the box\" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>','posts/March2018/h86hSqPMkT9oU8pjcrSu.jpg','best-ways-to-market-your-application','Find out the best ways to market your application in this article.','market, saas, market your app','PUBLISHED',0,'2018-03-26 02:55:01','2018-03-26 02:13:05'),(6,1,1,'Achieving your Dreams','Achieving your Dreams',NULL,'<p>What can be said about achieving your dreams? <br>Well... It\'s a good thing, and it\'s probably something you\'re dreaming of. Oh yeah, when you create an app and a product that you enjoy working on... You\'ll be pretty happy and your dreams will probably come true. Cool, right?</p>\n<p>I hope that you are ready for some cool stuff because there is some cool stuff right around the corner. By the time you\'ve reached the sky, you\'ll realize your true limits. That last sentence there... That was a little bit of jibberish, but I\'m trying to write about something cool. Bottom line is that Wave is going to help save you so much time.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src=\"/storage/posts/March2018/blog-1.jpg\" alt=\"blog\" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful \"outside the box\" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric \"outside the box\" thinking. Interactively negotiate pandemic internal or \"organic\" sources whereas competitive relationships.</p>\n<figure><img src=\"/storage/posts/March2018/blog-2.jpg\" alt=\"wide\" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient \"outside the box\" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>','posts/March2018/rU26aWVsZ2zocWGSTE7J.jpg','achieving-your-dreams','In this post, you\'ll learn about achieving your dreams by building the SAAS app of your dreams','saas app, dreams','PUBLISHED',0,'2018-03-26 02:50:18','2018-03-26 02:15:18'),(7,1,1,'Building a solid foundation','Building a solid foundation',NULL,'<p>The foundation is one of the most important aspects. You\'ll want to make sure that you build your application on a solid foundation because this is where every other feature will grow on top of.</p>\n<p>If the foundation is unstable the rest of the application will be so as well. But a solid foundation will make mediocre features seem amazing. So, if you want to save yourself some time you will build your application on a solid foundation of cool features, awesome jumps, and killer waves... I don\'t know what this paragraph is about anymore.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src=\"/storage/posts/March2018/blog-1.jpg\" alt=\"blog\" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful \"outside the box\" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric \"outside the box\" thinking. Interactively negotiate pandemic internal or \"organic\" sources whereas competitive relationships.</p>\n<figure><img src=\"/storage/posts/March2018/blog-2.jpg\" alt=\"wide\" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient \"outside the box\" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.&nbsp;</p>','posts/March2018/4vI1gzsAvMZ30yfDIe67.jpg','building-a-solid-foundation','Building a solid foundation for your application is super important. Read on below.','foundation, app foundation','PUBLISHED',0,'2018-03-26 02:24:43','2018-03-26 02:24:43'),(8,1,2,'Finding the solution that fits for you','Finding the solution that fits for you',NULL,'<p>There is a fit for each person. Depending on the service you may want to focus on what each person needs. When you find this you\'ll be able to segregate your application to fit each person\'s needs.</p>\n<p>This is really just an example post. I could write some stuff about how this and that, but it would probably only be information about this and that. Who am I kidding? This really isn\'t going to make some sense, but thanks for still reading. Are you still reading this article? That\'s awesome. Thanks for being interested.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src=\"/storage/posts/March2018/blog-1.jpg\" alt=\"blog\" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful \"outside the box\" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric \"outside the box\" thinking. Interactively negotiate pandemic internal or \"organic\" sources whereas competitive relationships.</p>\n<figure><img src=\"/storage/posts/March2018/blog-2.jpg\" alt=\"wide\" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient \"outside the box\" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.&nbsp;</p>','posts/March2018/hWOT5yqNmzCnLhVWXB2u.jpg','finding-the-solution-that-fits-for-you','How to build an app and find a solution that fits each users needs','solution, app solution','PUBLISHED',0,'2018-03-26 02:42:44','2018-03-26 02:42:44'),(9,1,2,'Creating something useful','Creating something useful',NULL,'<p>It\'s not enough nowadays to create something you want, instead you\'ll need to focus on what people need. If you find a need for something that isn\'t available... You should create it. Odds are someone will find it useful as well.</p>\n<p>When you focus your energy on building something that you are passionate about it\'s going to show. Your customers will buy because it\'s a great application, but also because they believe in what you are trying to achieve. So, continue to focus on making something that people need and find useful.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src=\"/storage/posts/March2018/blog-1.jpg\" alt=\"blog\" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful \"outside the box\" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric \"outside the box\" thinking. Interactively negotiate pandemic internal or \"organic\" sources whereas competitive relationships.</p>\n<figure><img src=\"/storage/posts/March2018/blog-2.jpg\" alt=\"wide\" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient \"outside the box\" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>','posts/March2018/weZwLLpaXnxyTR989iDk.jpg','creating-something-useful','Find out how to Create something useful','useful, create something useful','PUBLISHED',0,'2018-03-26 02:49:37','2018-03-26 02:56:38'),(10,1,1,'Never Stop Creating','Never Stop Creating',NULL,'<p>The reason why we are the way we are is... Because we are designed for a purpose. Some people are created to help or service, and others are created to... Well... Create. Are you a creator.</p>\n<p>If you have a passion for creating new things and bringing ideas to life. You\'ll want to save yourself some time by using Wave to build the foundation. Wave has so many built-in features including Billing, User Profiles, User Settings, an API, and so much more.</p>\n<blockquote>\n<p>You may have a need to only want to make money from your application, but if your application can help others achieve a goal and you can make money from it too, you have a gold-mine.</p>\n</blockquote>\n<p>Some more info on your awesome post here. After this sentence, it\'s just going to be a little bit of jibberish. But you get a general idea. You\'ll want to blog about stuff to get your customers interested in your application. With leverage existing reliable initiatives before leveraged ideas. Rapidiously develops equity invested expertise rather than enabled channels. Monotonectally intermediate distinctive networks before highly efficient core competencies.</p>\n<h2>Seamlessly promote flexible growth strategies.</h2>\n<p><img src=\"/storage/posts/March2018/blog-1.jpg\" alt=\"blog\" /></p><p>Dramatically harness extensive value through the fully researched human capital. Seamlessly transition premium schemas vis-a-vis efficient convergence. Intrinsically build competitive e-commerce with cross-unit information. Collaboratively e-enable real-time processes before extensive technology. Authoritatively fabricate efficient metrics through intuitive quality vectors.</p>\n<p>Collaboratively deliver optimal vortals whereas backward-compatible models. Globally syndicate diverse leadership rather than high-payoff experiences. Uniquely pontificate unique metrics for cross-media human capital. Completely procrastinate professional collaboration and idea-sharing rather than 24/365 paradigms. Phosfluorescently initiates multimedia based outsourcing for interoperable benefits.</p>\n<h3>Seamlessly promote flexible growth strategies.</h3>\n<p>Progressively leverage other\'s e-business functionalities through corporate e-markets. Holistic repurpose timely systems via seamless total linkage. Appropriately maximize impactful \"outside the box\" thinking vis-a-vis visionary value. Authoritatively deploy interdependent technology through process-centric \"outside the box\" thinking. Interactively negotiate pandemic internal or \"organic\" sources whereas competitive relationships.</p>\n<figure><img src=\"/storage/posts/March2018/blog-2.jpg\" alt=\"wide\" />\n<figcaption>Keep working until you find success.</figcaption>\n</figure>\n<p>Enthusiastically deliver viral potentialities through multidisciplinary products. Synergistically plagiarize client-focused partnerships for adaptive applications. Seamlessly morph process-centric synergy whereas bricks-and-clicks deliverables. Continually disintermediate holistic action items without distinctive customer service. Enthusiastically seize enterprise web-readiness without effective schemas.</p>\n<h4>Seamlessly promote flexible growth strategies.</h4>\n<p>Assertively restore installed base data before sustainable platforms. Globally recapitalize orthogonal systems via clicks-and-mortar web services. Efficiently grow visionary action items through collaborative e-commerce. Efficiently architect highly efficient \"outside the box\" thinking before customer directed infomediaries. Proactively mesh holistic human capital rather than exceptional niches.</p>\n<p>Intrinsically create innovative value and pandemic resources. Progressively productize turnkey e-markets and economically sound synergy. Objectively supply turnkey imperatives vis-a-vis high standards in outsourcing. Dynamically exploit unique imperatives with dynamic systems. Appropriately formulate technically sound users and excellent expertise.</p>\n<p>Competently redefine long-term high-impact relationships rather than effective metrics. Distinctively maintain impactful platforms after strategic imperatives. Intrinsically evolve mission-critical deliverables after multimedia based e-business. Interactively mesh cooperative benefits whereas distributed process improvements. Progressively monetize an expanded array of e-services whereas.</p>','posts/March2018/K804BvnOehlLao0XmI08.jpg','never-stop-creating','In this article you\'ll learn how important it is to never stop creating','creating, never stop','PUBLISHED',0,'2018-03-26 02:08:02','2018-06-28 06:14:31');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `properties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `external_id` bigint unsigned NOT NULL,
  `base_price` double DEFAULT NULL,
  `min_stay` int DEFAULT NULL,
  `max_stay` int DEFAULT NULL,
  `is_lead` tinyint(1) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `property_attribute_id` bigint unsigned NOT NULL,
  `property_address_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `properties_external_id_unique` (`external_id`),
  KEY `properties_property_attribute_id_foreign` (`property_attribute_id`),
  KEY `properties_property_address_id_foreign` (`property_address_id`),
  CONSTRAINT `properties_property_address_id_foreign` FOREIGN KEY (`property_address_id`) REFERENCES `property_addresses` (`id`),
  CONSTRAINT `properties_property_attribute_id_foreign` FOREIGN KEY (`property_attribute_id`) REFERENCES `property_attributes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (1,5963897866,NULL,NULL,NULL,0,1,NULL,NULL,1,1),(2,5285251389,NULL,NULL,NULL,0,1,NULL,NULL,2,2),(3,7179353007,NULL,NULL,NULL,0,0,NULL,NULL,3,3);
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_addresses`
--

DROP TABLE IF EXISTS `property_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_addresses_country_id_foreign` (`country_id`),
  CONSTRAINT `property_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_addresses`
--

LOCK TABLES `property_addresses` WRITE;
/*!40000 ALTER TABLE `property_addresses` DISABLE KEYS */;
INSERT INTO `property_addresses` VALUES (1,NULL,NULL,NULL,'99','rue de yougoslavie','Marrakech','Marrakech-Sa  fi','40000',31.63464700,-8.01423600,NULL,NULL,137),(2,NULL,NULL,NULL,'150','Route de Fès','Marrakech','Marrakech-Safi','40000',31.64407900,-7.97489200,NULL,NULL,137),(3,NULL,NULL,NULL,NULL,NULL,'Paris',NULL,NULL,NULL,NULL,NULL,NULL,75);
/*!40000 ALTER TABLE `property_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_attributes`
--

DROP TABLE IF EXISTS `property_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `square_metre` int DEFAULT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maximum_capacity` int DEFAULT NULL,
  `bedrooms` int DEFAULT NULL,
  `beds` int DEFAULT NULL,
  `bathrooms` int DEFAULT NULL,
  `pets` tinyint(1) NOT NULL DEFAULT '0',
  `smoking` tinyint(1) NOT NULL DEFAULT '0',
  `party` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` bigint unsigned NOT NULL DEFAULT '46',
  `property_type_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_attributes_currency_id_foreign` (`currency_id`),
  KEY `property_attributes_property_type_id_foreign` (`property_type_id`),
  CONSTRAINT `property_attributes_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `property_attributes_property_type_id_foreign` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_attributes`
--

LOCK TABLES `property_attributes` WRITE;
/*!40000 ALTER TABLE `property_attributes` DISABLE KEYS */;
INSERT INTO `property_attributes` VALUES (1,'Gueliz','Appartement plein centre ville',NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,0,0,0,NULL,NULL,46,2),(2,'Ain itti','Appartement moderne calme et proche centre ville',NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,0,0,0,NULL,NULL,46,NULL),(3,'Millenium',NULL,NULL,NULL,NULL,NULL,3,NULL,NULL,NULL,0,0,0,NULL,NULL,46,NULL);
/*!40000 ALTER TABLE `property_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_equipment_photo`
--

DROP TABLE IF EXISTS `property_equipment_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_equipment_photo` (
  `property_equipment_id` bigint unsigned NOT NULL,
  `photo_id` bigint unsigned NOT NULL,
  KEY `property_equipment_photo_property_equipment_id_foreign` (`property_equipment_id`),
  KEY `property_equipment_photo_photo_id_foreign` (`photo_id`),
  CONSTRAINT `property_equipment_photo_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`),
  CONSTRAINT `property_equipment_photo_property_equipment_id_foreign` FOREIGN KEY (`property_equipment_id`) REFERENCES `property_equipments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_equipment_photo`
--

LOCK TABLES `property_equipment_photo` WRITE;
/*!40000 ALTER TABLE `property_equipment_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_equipment_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_equipments`
--

DROP TABLE IF EXISTS `property_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_equipments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `private` tinyint(1) NOT NULL,
  `number` int NOT NULL,
  `order` int NOT NULL,
  `equipment_description_id` bigint unsigned NOT NULL,
  `equipment_availability_id` bigint unsigned DEFAULT NULL,
  `equipments_id` bigint unsigned NOT NULL,
  `property_equipments_parent_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_equipments_equipment_description_id_foreign` (`equipment_description_id`),
  KEY `property_equipments_equipment_availability_id_foreign` (`equipment_availability_id`),
  KEY `property_equipments_equipments_id_foreign` (`equipments_id`),
  KEY `property_equipments_property_equipments_parent_id_foreign` (`property_equipments_parent_id`),
  CONSTRAINT `property_equipments_equipment_availability_id_foreign` FOREIGN KEY (`equipment_availability_id`) REFERENCES `equipment_availabilities` (`id`),
  CONSTRAINT `property_equipments_equipment_description_id_foreign` FOREIGN KEY (`equipment_description_id`) REFERENCES `equipment_descriptions` (`id`),
  CONSTRAINT `property_equipments_equipments_id_foreign` FOREIGN KEY (`equipments_id`) REFERENCES `equipments` (`id`),
  CONSTRAINT `property_equipments_property_equipments_parent_id_foreign` FOREIGN KEY (`property_equipments_parent_id`) REFERENCES `property_equipments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_equipments`
--

LOCK TABLES `property_equipments` WRITE;
/*!40000 ALTER TABLE `property_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_fees`
--

DROP TABLE IF EXISTS `property_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guests_included` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_fees`
--

LOCK TABLES `property_fees` WRITE;
/*!40000 ALTER TABLE `property_fees` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_multi_units`
--

DROP TABLE IF EXISTS `property_multi_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_multi_units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_multi_units_property_id_foreign` (`property_id`),
  CONSTRAINT `property_multi_units_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_multi_units`
--

LOCK TABLES `property_multi_units` WRITE;
/*!40000 ALTER TABLE `property_multi_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_multi_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_partenaire`
--

DROP TABLE IF EXISTS `property_partenaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_partenaire` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint unsigned NOT NULL,
  `partenaire_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_partenaire_property_id_foreign` (`property_id`),
  KEY `property_partenaire_partenaire_id_foreign` (`partenaire_id`),
  CONSTRAINT `property_partenaire_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `property_partenaire_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_partenaire`
--

LOCK TABLES `property_partenaire` WRITE;
/*!40000 ALTER TABLE `property_partenaire` DISABLE KEYS */;
INSERT INTO `property_partenaire` VALUES (1,1,1),(2,1,2),(3,1,4),(4,2,1),(5,2,2),(6,2,4);
/*!40000 ALTER TABLE `property_partenaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_photo`
--

DROP TABLE IF EXISTS `property_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_photo` (
  `property_id` bigint unsigned NOT NULL,
  `photo_id` bigint unsigned NOT NULL,
  KEY `property_photo_property_id_foreign` (`property_id`),
  KEY `property_photo_photo_id_foreign` (`photo_id`),
  CONSTRAINT `property_photo_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`),
  CONSTRAINT `property_photo_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_photo`
--

LOCK TABLES `property_photo` WRITE;
/*!40000 ALTER TABLE `property_photo` DISABLE KEYS */;
INSERT INTO `property_photo` VALUES (1,1),(2,2),(2,3);
/*!40000 ALTER TABLE `property_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_property_equipment`
--

DROP TABLE IF EXISTS `property_property_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_property_equipment` (
  `property_equipment_id` bigint unsigned NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  KEY `property_property_equipment_property_equipment_id_foreign` (`property_equipment_id`),
  KEY `property_property_equipment_property_id_foreign` (`property_id`),
  CONSTRAINT `property_property_equipment_property_equipment_id_foreign` FOREIGN KEY (`property_equipment_id`) REFERENCES `property_equipments` (`id`),
  CONSTRAINT `property_property_equipment_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_property_equipment`
--

LOCK TABLES `property_property_equipment` WRITE;
/*!40000 ALTER TABLE `property_property_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_property_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_teams`
--

DROP TABLE IF EXISTS `property_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_teams_property_id_foreign` (`property_id`),
  KEY `property_teams_user_id_foreign` (`user_id`),
  CONSTRAINT `property_teams_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  CONSTRAINT `property_teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_teams`
--

LOCK TABLES `property_teams` WRITE;
/*!40000 ALTER TABLE `property_teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_types`
--

DROP TABLE IF EXISTS `property_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_types`
--

LOCK TABLES `property_types` WRITE;
/*!40000 ALTER TABLE `property_types` DISABLE KEYS */;
INSERT INTO `property_types` VALUES (1,'House','heroicon-o-home-modern','2024-08-09 13:20:25','2024-08-09 13:20:25'),(2,'Appartment','heroicon-o-building-office','2024-08-09 13:20:25','2024-08-09 13:20:25'),(3,'Bedroom','heroicon-o-home','2024-08-09 13:20:25','2024-08-09 13:20:25'),(4,'Hotel','heroicon-o-building-office-2','2024-08-09 13:20:25','2024-08-09 13:20:25');
/*!40000 ALTER TABLE `property_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin User','2017-11-21 16:23:22','2017-11-21 16:23:22'),(2,'trial','Free Trial','2017-11-21 16:23:22','2017-11-21 16:23:22'),(3,'basic','Basic Plan','2018-07-03 05:03:21','2018-07-03 17:28:44'),(4,'pro','Pro Plan','2018-07-03 16:27:16','2018-07-03 17:28:38'),(5,'premium','Premium Plan','2018-07-03 16:28:42','2018-07-03 17:28:32'),(6,'cancelled','Cancelled User','2018-07-03 16:28:42','2018-07-03 17:28:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '1',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site.title','Site Title','Wave','','text',1,'Site'),(2,'site.description','Site Description','The Software as a Service Starter Kit built on Laravel & Voyager','','text',2,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID',NULL,'','text',4,'Site'),(6,'admin.title','Admin Title','Wave','','text',1,'Admin'),(7,'admin.description','Admin Description','Create some waves and build your next great idea','','text',2,'Admin'),(8,'admin.loader','Admin Loader','','','image',3,'Admin'),(9,'admin.icon_image','Admin Icon Image','','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)','','','text',1,'Admin'),(11,'site.favicon','Favicon','',NULL,'image',6,'Site'),(12,'auth.dashboard_redirect','Homepage Redirect to Dashboard if Logged in','0',NULL,'checkbox',7,'Auth'),(13,'auth.email_or_username','Users Login with Email or Username','email','{\n\"default\" : \"email\",\n\"options\" : {\n\"email\": \"Email Address\",\n\"username\": \"Username\"\n}\n}','select_dropdown',8,'Auth'),(14,'auth.username_in_registration','Username when Registering','yes','{\n\"default\" : \"yes\",\n\"options\" : {\n\"yes\": \"Yes, Include the Username Field when Registering\",\n\"no\": \"No, Have it automatically generated\"\n}\n}','select_dropdown',9,'Auth'),(15,'auth.verify_email','Verify Email during Sign Up','0',NULL,'checkbox',10,'Auth'),(16,'billing.card_upfront','Require Credit Card Up Front','1','{\n\"on\" : \"Yes\",\n\"off\" : \"No\",\n\"checked\" : false\n}','checkbox',11,'Billing'),(17,'billing.trial_days','Trial Days when No Credit Card Up Front','-1',NULL,'text',12,'Billing');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_correspondances`
--

DROP TABLE IF EXISTS `status_correspondances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_correspondances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_status_id` bigint unsigned NOT NULL,
  `partenaire_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status_correspondances_booking_status_id_foreign` (`booking_status_id`),
  KEY `status_correspondances_partenaire_id_foreign` (`partenaire_id`),
  CONSTRAINT `status_correspondances_booking_status_id_foreign` FOREIGN KEY (`booking_status_id`) REFERENCES `booking_statuses` (`id`),
  CONSTRAINT `status_correspondances_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_correspondances`
--

LOCK TABLES `status_correspondances` WRITE;
/*!40000 ALTER TABLE `status_correspondances` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_correspondances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `my_permission_id` bigint unsigned NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_my_permission_id_foreign` (`my_permission_id`),
  KEY `teams_property_id_foreign` (`property_id`),
  KEY `teams_user_id_foreign` (`user_id`),
  CONSTRAINT `teams_my_permission_id_foreign` FOREIGN KEY (`my_permission_id`) REFERENCES `my_permissions` (`id`),
  CONSTRAINT `teams_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  CONSTRAINT `teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_options`
--

DROP TABLE IF EXISTS `theme_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `theme_options` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` int unsigned NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `voyager_theme_options_theme_id_index` (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_options`
--

LOCK TABLES `theme_options` WRITE;
/*!40000 ALTER TABLE `theme_options` DISABLE KEYS */;
INSERT INTO `theme_options` VALUES (17,1,'logo','','2017-11-22 16:54:46','2018-02-11 05:02:40'),(18,1,'home_headline','Welcome to Wave','2017-11-25 17:31:45','2018-08-28 00:17:41'),(19,1,'home_subheadline','Start crafting your next great idea.','2017-11-25 17:31:45','2017-11-26 07:11:47'),(20,1,'home_description','Wave will help you rapidly build a Software as a Service. Out of the box Authentication, Subscriptions, Invoices, Announcements, User Profiles, API, and so much more!','2017-11-25 17:31:45','2017-11-26 07:09:50'),(21,1,'home_cta','Signup','2017-11-25 20:02:29','2020-10-23 20:17:25'),(22,1,'home_cta_url','/register','2017-11-25 20:09:33','2017-11-26 16:12:41'),(23,1,'home_promo_image','themes/February2018/mFajn4fwpGFXzI1UsNH6.png','2017-11-25 21:36:46','2017-11-29 01:17:00'),(24,1,'footer_logo','themes/August2018/TksmVWMqp5JXUQj8C6Ct.png','2018-08-28 23:12:11','2018-08-28 23:12:11');
/*!40000 ALTER TABLE `theme_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voyager_themes_folder_unique` (`folder`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'Tailwind Theme','tailwind',1,'1.0','2020-08-23 08:06:45','2020-08-23 08:06:45');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timezones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timezones`
--

LOCK TABLES `timezones` WRITE;
/*!40000 ALTER TABLE `timezones` DISABLE KEYS */;
INSERT INTO `timezones` VALUES (1,'Europe/Paris','2024-08-09 13:20:28','2024-08-09 13:20:28'),(2,'America/New_York','2024-08-09 13:20:28','2024-08-09 13:20:28'),(3,'Asia/Tokyo','2024-08-09 13:20:28','2024-08-09 13:20:28'),(4,'Australia/Sydney','2024-08-09 13:20:28','2024-08-09 13:20:28'),(5,'UTC (Coordinated Universal Time)','2024-08-09 13:20:28','2024-08-09 13:20:28'),(6,'Africa/Cairo','2024-08-09 13:20:28','2024-08-09 13:20:28'),(7,'Asia/Dubai','2024-08-09 13:20:28','2024-08-09 13:20:28'),(8,'Pacific/Honolulu','2024-08-09 13:20:28','2024-08-09 13:20:28'),(9,'America/Los_Angeles','2024-08-09 13:20:28','2024-08-09 13:20:28'),(10,'Europe/London','2024-08-09 13:20:28','2024-08-09 13:20:28');
/*!40000 ALTER TABLE `timezones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'data_types','display_name_singular',1,'pt','Post','2017-11-21 16:23:23','2017-11-21 16:23:23'),(2,'data_types','display_name_singular',2,'pt','Página','2017-11-21 16:23:23','2017-11-21 16:23:23'),(3,'data_types','display_name_singular',3,'pt','Utilizador','2017-11-21 16:23:23','2017-11-21 16:23:23'),(4,'data_types','display_name_singular',4,'pt','Categoria','2017-11-21 16:23:23','2017-11-21 16:23:23'),(5,'data_types','display_name_singular',5,'pt','Menu','2017-11-21 16:23:23','2017-11-21 16:23:23'),(6,'data_types','display_name_singular',6,'pt','Função','2017-11-21 16:23:23','2017-11-21 16:23:23'),(7,'data_types','display_name_plural',1,'pt','Posts','2017-11-21 16:23:23','2017-11-21 16:23:23'),(8,'data_types','display_name_plural',2,'pt','Páginas','2017-11-21 16:23:23','2017-11-21 16:23:23'),(9,'data_types','display_name_plural',3,'pt','Utilizadores','2017-11-21 16:23:23','2017-11-21 16:23:23'),(10,'data_types','display_name_plural',4,'pt','Categorias','2017-11-21 16:23:23','2017-11-21 16:23:23'),(11,'data_types','display_name_plural',5,'pt','Menus','2017-11-21 16:23:23','2017-11-21 16:23:23'),(12,'data_types','display_name_plural',6,'pt','Funções','2017-11-21 16:23:23','2017-11-21 16:23:23'),(13,'categories','slug',1,'pt','categoria-1','2017-11-21 16:23:23','2017-11-21 16:23:23'),(14,'categories','name',1,'pt','Categoria 1','2017-11-21 16:23:23','2017-11-21 16:23:23'),(15,'categories','slug',2,'pt','categoria-2','2017-11-21 16:23:23','2017-11-21 16:23:23'),(16,'categories','name',2,'pt','Categoria 2','2017-11-21 16:23:23','2017-11-21 16:23:23'),(17,'pages','title',1,'pt','Olá Mundo','2017-11-21 16:23:23','2017-11-21 16:23:23'),(18,'pages','slug',1,'pt','ola-mundo','2017-11-21 16:23:23','2017-11-21 16:23:23'),(19,'pages','body',1,'pt','<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','2017-11-21 16:23:23','2017-11-21 16:23:23'),(20,'menu_items','title',1,'pt','Painel de Controle','2017-11-21 16:23:23','2017-11-21 16:23:23'),(21,'menu_items','title',2,'pt','Media','2017-11-21 16:23:23','2017-11-21 16:23:23'),(22,'menu_items','title',3,'pt','Publicações','2017-11-21 16:23:23','2017-11-21 16:23:23'),(23,'menu_items','title',4,'pt','Utilizadores','2017-11-21 16:23:23','2017-11-21 16:23:23'),(24,'menu_items','title',5,'pt','Categorias','2017-11-21 16:23:23','2017-11-21 16:23:23'),(25,'menu_items','title',6,'pt','Páginas','2017-11-21 16:23:23','2017-11-21 16:23:23'),(26,'menu_items','title',7,'pt','Funções','2017-11-21 16:23:23','2017-11-21 16:23:23'),(27,'menu_items','title',8,'pt','Ferramentas','2017-11-21 16:23:23','2017-11-21 16:23:23'),(28,'menu_items','title',9,'pt','Menus','2017-11-21 16:23:23','2017-11-21 16:23:23'),(29,'menu_items','title',10,'pt','Base de dados','2017-11-21 16:23:23','2017-11-21 16:23:23'),(30,'menu_items','title',13,'pt','Configurações','2017-11-21 16:23:23','2017-11-21 16:23:23');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_channels`
--

DROP TABLE IF EXISTS `user_channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_channels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `notification_type_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_channels_notification_type_id_foreign` (`notification_type_id`),
  KEY `user_channels_user_id_foreign` (`user_id`),
  CONSTRAINT `user_channels_notification_type_id_foreign` FOREIGN KEY (`notification_type_id`) REFERENCES `notification_types` (`id`),
  CONSTRAINT `user_channels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_channels`
--

LOCK TABLES `user_channels` WRITE;
/*!40000 ALTER TABLE `user_channels` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_channels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Wave Admin','admin@admin.com','users/default.png',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','yjboMXdshxs3ujv3aQ4bwtLXuFqKUh5nne8WB5Nq5gXjh9jDiCOHhoQfHbOt',NULL,'2017-11-21 16:07:22','2018-09-22 23:34:02','admin',NULL,NULL,NULL,NULL,NULL,1),(2,1,'Mauricio Raynor','mauricio.raynor@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Mauricio Raynor',NULL,NULL,NULL,NULL,NULL,1),(3,1,'Maya Schultz','maya.schultz@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Maya Schultz',NULL,NULL,NULL,NULL,NULL,1),(4,1,'Destini Rowe','destini.rowe@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Destini Rowe',NULL,NULL,NULL,NULL,NULL,1),(5,1,'Rocio Roberts DDS','rocio.roberts.dds@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Rocio Roberts DDS',NULL,NULL,NULL,NULL,NULL,1),(6,1,'Anibal Marquardt','anibal.marquardt@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Anibal Marquardt',NULL,NULL,NULL,NULL,NULL,1),(7,1,'Jacinto Lubowitz','jacinto.lubowitz@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Jacinto Lubowitz',NULL,NULL,NULL,NULL,NULL,1),(8,1,'Adrain Walker','adrain.walker@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Adrain Walker',NULL,NULL,NULL,NULL,NULL,1),(9,1,'Dr. Margaretta Christiansen PhD','dr.margaretta.christiansen.phd@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Dr. Margaretta Christiansen PhD',NULL,NULL,NULL,NULL,NULL,1),(10,1,'Prof. Natasha Russel Sr.','prof.natasha.russel.sr.@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:02',NULL,'Prof. Natasha Russel Sr.',NULL,NULL,NULL,NULL,NULL,1),(11,1,'Jorge Legros DVM','jorge.legros.dvm@innovqube.com','users/profile-picture-3.jpg',NULL,NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2','4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',NULL,'2024-08-09 13:21:03',NULL,'Jorge Legros DVM',NULL,NULL,NULL,NULL,NULL,1),(12,2,'devinnovqube','dev@innovqube.com','users/default.png',NULL,NULL,'$2y$10$LscLMXutl7ncMsXnT8/12.Il6tf9Ytyp2XceP68ikDFKMSVoaFgVq',NULL,NULL,'2024-08-09 13:23:35','2024-08-09 13:23:35','devinnovqube',NULL,NULL,NULL,NULL,NULL,NULL),(13,NULL,'Emilie-Rose Ceresa','eceres.606363@guest.booking.com','users/default.png','+330673823154',NULL,'$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2',NULL,NULL,'2024-08-09 19:24:18','2024-08-09 19:24:18','Emilie-Rose Ceresa',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wave_key_values`
--

DROP TABLE IF EXISTS `wave_key_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wave_key_values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyvalue_id` int unsigned NOT NULL,
  `keyvalue_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wave_key_values_keyvalue_id_keyvalue_type_key_unique` (`keyvalue_id`,`keyvalue_type`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wave_key_values`
--

LOCK TABLES `wave_key_values` WRITE;
/*!40000 ALTER TABLE `wave_key_values` DISABLE KEYS */;
INSERT INTO `wave_key_values` VALUES (10,'text_area',1,'users','about','Hello I am the admin user. You can update this information in the edit profile section. Hope you enjoy using Wave.');
/*!40000 ALTER TABLE `wave_key_values` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-22  9:11:22
