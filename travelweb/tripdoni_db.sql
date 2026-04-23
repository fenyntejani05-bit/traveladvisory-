-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tripdoni_db
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
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `date_posted` date DEFAULT NULL,
  `read_time` varchar(20) DEFAULT NULL,
  `author_name` varchar(100) DEFAULT NULL,
  `author_image` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,'Panduan Packing Praktis: 10 Tips','Tips','2025-11-18','6 MIN READ','Doni Admin','https://randomuser.me/api/portraits/men/32.jpg','https://images.unsplash.com/photo-1501785888041-af3ef285b470'),(2,'Liburan Mewah tapi Hemat?','Budget','2025-11-16','5 MIN READ','Siti Nurhaliza','https://randomuser.me/api/portraits/women/44.jpg','https://images.unsplash.com/photo-1507608616759-54f48f0af0ee'),(3,'Menjelajahi Surga Tersembunyi','Discovery','2025-11-10','8 MIN READ','Rizky Billar','https://randomuser.me/api/portraits/men/85.jpg','https://images.unsplash.com/photo-1596423736112-c7d004c6147a');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `rating` float DEFAULT 0,
  `km` varchar(50) DEFAULT NULL,
  `transmission` varchar(50) DEFAULT NULL,
  `seats` varchar(50) DEFAULT NULL,
  `fuel` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'Mercedes-Benz G-Class','Bali & Jakarta',7500000.00,4.98,'4k km','Automatic','5 Seats','Pertamax Turbo','https://images.unsplash.com/photo-1609521263047-f8f205293f24?auto=format&fit=crop&w=600&q=80'),(2,'Mini Cooper S Cabrio','Bandung City',2500000.00,4.85,'12k km','Automatic','4 Seats','Pertamax','https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=600&q=80'),(3,'Toyota Alphard','Semua Kota',3500000.00,5,'5k km','Automatic','7 Seats','Pertamax','https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&w=600&q=80');
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_type` enum('tour','hotel','car') DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `image_url` varchar(255) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (3,4,3,'tour','Green Canyon',1150000.00,1,'https://i0.wp.com/www.pakettourbelitung.net/wp-content/uploads/2019/02/Green-Canyon.jpg?resize=728%2C424&ssl=1',NULL,NULL,'2025-11-13 10:23:25');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `tours_count` int(11) DEFAULT 0,
  `activities_count` int(11) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Beach',356,248,'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=400&q=80'),(2,'Temples',120,50,'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=400&q=80'),(3,'Yacht',85,20,'https://moonen.com/wp-content/uploads/2024/12/Superyacht-BOTTI-Built-by-Moonen-Yachts.jpg'),(4,'Valley',200,150,'https://images.unsplash.com/photo-1470770903676-69b98201ea1c?auto=format&fit=crop&w=400&q=80'),(5,'Mountain',410,300,'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=400&q=80');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `rating` float DEFAULT 0,
  `reviews` int(11) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (1,'California Sunset Resort','Pangandaran, Indonesia',750000.00,4.96,672,'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=600&q=80'),(2,'The Allure Villas','Pangandaran, Indonesia',1200000.00,4.92,572,'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=600&q=80'),(3,'Grand Canyon Hotel','Cijulang, Indonesia',450000.00,4.85,320,'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80');
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Amanda Putri','Jakarta, Indonesia','Sistem Booking Tercepat!','DoniTrip membuat perencanaan liburan saya sangat mudah. Semua terorganisir dengan rapi.',5,'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80'),(2,'Bayu Nugraha','Surabaya, Indonesia','Layanan Prima!','Saya sering mencari promo, dan DoniTrip selalu menawarkan harga yang paling kompetitif.',5,'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80'),(3,'Citra Dewi','Medan, Indonesia','Impian Jadi Nyata!','Berkat DoniTrip, saya bisa mewujudkan impian liburan ke Bali dengan mudah.',5,'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT 'Indonesia',
  `duration` varchar(50) DEFAULT NULL,
  `guests` varchar(50) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `rating` float DEFAULT 0,
  `reviews` int(11) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `badge_text` varchar(50) DEFAULT NULL,
  `badge_class` varchar(50) DEFAULT NULL,
  `climate` varchar(50) DEFAULT NULL,
  `budget` varchar(50) DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_category_id` (`category_id`),
  CONSTRAINT `fk_tours_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tours`
--

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` VALUES (6,2,'Taj Mahal','Agra, Uttar Pradesh','3 days 2 nights','2-4 people',4500.00,4.95,1250,'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=800&q=80','World Wonder','text-danger border-danger','Moderate','Medium','Heritage'),(7,1,'Goa Beaches','Goa','4 days 3 nights','2-6 people',5500.00,4.8,890,'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=800&q=80','Party Capital','text-warning border-warning','Tropical','High','Relaxing'),(8,2,'Jaipur Forts','Rajasthan','3 days 2 nights','2-4 people',6000.00,4.88,950,'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&w=800&q=80','Royal Heritage','text-success border-success','Moderate','Medium','Heritage'),(9,3,'Kerala Backwaters','Kerala','3 days 2 nights','2 people',8500.00,4.96,620,'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=800&q=80','Relaxing','text-info border-info','Tropical','High','Relaxing'),(10,2,'Varanasi Ghats','Uttar Pradesh','2 days 1 night','2-4 people',3000.00,4.85,1100,'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?auto=format&fit=crop&w=800&q=80','Spiritual','text-danger border-danger','Tropical','Low','Heritage'),(11,5,'Leh Ladakh Highlights','Ladakh','6 days 5 nights','2-4 people',15000.00,4.98,780,'https://images.unsplash.com/photo-1581793746485-04698e79a4e8?auto=format&fit=crop&w=800&q=80','Adventure','text-success border-success','Cold','High','Adventure'),(12,4,'Ranthambore Safari','Rajasthan','2 days 1 night','2-6 people',7500.00,4.75,430,'https://images.unsplash.com/photo-1517513006821-654b9d0dc6b6?auto=format&fit=crop&w=800&q=80','Wildlife','text-warning border-warning','Moderate','Medium','Wildlife'),(13,5,'Rishikesh Adventure','Uttarakhand','3 days 2 nights','4-8 people',4000.00,4.82,850,'https://images.unsplash.com/photo-1600713783478-f0270aefb4e4?auto=format&fit=crop&w=800&q=80','Best Sale','text-success border-success','Moderate','Low','Adventure'),(14,4,'Udaipur Palaces','Rajasthan','3 days 2 nights','2 people',7000.00,4.9,670,'https://images.unsplash.com/photo-1596700078044-c7ef54caadd8?auto=format&fit=crop&w=800&q=80','Romantic','text-danger border-danger','Moderate','High','Heritage'),(15,5,'Munnar Tea Gardens','Kerala','4 days 3 nights','2-4 people',6500.00,4.89,540,'https://images.unsplash.com/photo-1593693397690-362cb9628af3?auto=format&fit=crop&w=800&q=80','Top Rated','text-warning border-warning','Moderate','Medium','Relaxing'),(16,1,'Andaman Island Tour','Andaman','5 days 4 nights','2-4 people',18000.00,4.95,300,'https://images.unsplash.com/photo-1620302788556-91e0a29ba526?auto=format&fit=crop&w=800&q=80','Tropical','text-info border-info','Tropical','High','Relaxing'),(17,2,'Hampi Ruins','Karnataka','2 days 2 nights','2-6 people',3500.00,4.78,420,'https://images.unsplash.com/photo-1600100397608-4100dc89635e?auto=format&fit=crop&w=800&q=80','Historic','text-secondary border-secondary','Tropical','Low','Heritage'),(18,5,'Darjeeling Highlights','West Bengal','4 days 3 nights','2-4 people',8000.00,4.85,600,'https://images.unsplash.com/photo-1544634076-a90160ddf44e?auto=format&fit=crop&w=800&q=80','Scenic','text-success border-success','Cold','Medium','Relaxing'),(19,5,'Shimla Snow Tour','Himachal Pradesh','3 days 2 nights','2-4 people',7000.00,4.8,750,'https://images.unsplash.com/photo-1562635900-58d04ebd4fc9?auto=format&fit=crop&w=800&q=80','Winter Fun','text-info border-info','Cold','Medium','Adventure'),(20,5,'Manali Retreat','Himachal Pradesh','4 days 3 nights','2-6 people',8500.00,4.92,1050,'https://images.unsplash.com/photo-1605640840605-14ac1855827b?auto=format&fit=crop&w=800&q=80','Top Rated','text-warning border-warning','Cold','Medium','Relaxing'),(21,5,'Ooty Hill Station','Tamil Nadu','3 days 2 nights','2-4 people',6000.00,4.88,500,'https://images.unsplash.com/photo-1598811804961-d7790b8f1bc4?auto=format&fit=crop&w=800&q=80','Top Rated','text-warning border-warning','Cold','Medium','Relaxing'),(22,4,'Coorg Plantations','Karnataka','2 days 1 night','2 people',5000.00,4.85,450,'https://images.unsplash.com/photo-1598091383021-15ddea10925d?auto=format&fit=crop&w=800&q=80','Scenic','text-success border-success','Moderate','Medium','Relaxing'),(23,4,'Jaisalmer Desert Safari','Rajasthan','3 days 2 nights','2-6 people',7000.00,4.9,600,'https://images.unsplash.com/photo-1519962551779-514d15ebd473?auto=format&fit=crop&w=800&q=80','Adventure','text-danger border-danger','Moderate','Medium','Adventure'),(24,4,'Kashmir Valley Retreat','Jammu & Kashmir','5 days 4 nights','2-4 people',16000.00,4.98,850,'https://images.unsplash.com/photo-1595815771614-ade9d652762a?auto=format&fit=crop&w=800&q=80','Paradise','text-info border-info','Cold','High','Relaxing'),(25,5,'Auli Skiing Expedition','Uttarakhand','4 days 3 nights','2-4 people',14000.00,4.95,400,'https://images.unsplash.com/photo-1520023646673-c6c74ad53dc5?auto=format&fit=crop&w=800&q=80','Thrilling','text-danger border-danger','Cold','High','Adventure'),(26,1,'Kanyakumari Coast','Tamil Nadu','2 days 1 night','2-6 people',4000.00,4.8,520,'https://images.unsplash.com/photo-1610444391694-8451f28ff11e?auto=format&fit=crop&w=800&q=80','Land\'s End','text-primary border-primary','Tropical','Low','Relaxing'),(27,4,'Sundarbans Mangrove','West Bengal','3 days 2 nights','4-8 people',8000.00,4.88,300,'https://images.unsplash.com/photo-1590494483756-318e80556209?auto=format&fit=crop&w=800&q=80','Wildlife','text-warning border-warning','Tropical','Medium','Wildlife'),(28,5,'Meghalaya Root Bridges','Meghalaya','4 days 3 nights','2-4 people',4500.00,4.92,450,'https://images.unsplash.com/photo-1616496668729-1a067ed3fa9e?auto=format&fit=crop&w=800&q=80','Nature','text-success border-success','Moderate','Low','Adventure'),(29,2,'Mysore Palaces','Karnataka','2 days 1 night','2-6 people',3500.00,4.85,700,'https://images.unsplash.com/photo-1600100397608-4100dc89635e?auto=format&fit=crop&w=800&q=80','Heritage','text-secondary border-secondary','Moderate','Low','Heritage'),(30,5,'Mahabaleshwar Getaway','Maharashtra','3 days 2 nights','2-4 people',5500.00,4.86,620,'https://images.unsplash.com/photo-1596423736112-c7d004c6147a?auto=format&fit=crop&w=800&q=80','Scenic','text-success border-success','Moderate','Medium','Relaxing');
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_details`
--

DROP TABLE IF EXISTS `transaction_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`),
  CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_details`
--

LOCK TABLES `transaction_details` WRITE;
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT INTO `transaction_details` VALUES (3,4,3,'tour','Green Canyon',1150000.00,1,1150000.00),(4,5,1,'tour','Pantai Pangandaran',650000.00,1,650000.00),(5,6,2,'tour','Pantai Madasari',850000.00,1,850000.00),(6,7,2,'tour','Pantai Madasari',850000.00,1,850000.00),(7,8,2,'tour','Pantai Madasari',850000.00,1,850000.00);
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` enum('pending','paid','cancelled') DEFAULT 'pending',
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (4,'TRV-176302288544',3,'Akmal celiboy','digital@gmail.com','089887667554',1150000.00,'E-Wallet','paid','2025-11-13 08:34:45'),(5,'TRV-176332176231',5,'Cici Candrawati','cici@gmail.com','085217208593',650000.00,'Bank Transfer','paid','2025-11-16 19:36:02'),(6,'TRV-176339317759',6,'Doni Wahyono','doni@trip.com','089887667554',850000.00,'Bank Transfer','paid','2025-11-17 15:26:17'),(7,'TRV-176340172584',6,'Doni Wahyono','doni@trip.com','089887667554',850000.00,'Bank Transfer','paid','2025-11-17 17:48:45'),(8,'TRV-176341362651',5,'Cici Candrawati','cici@gmail.com','089887667554',850000.00,'Bank Transfer','paid','2025-11-17 21:07:06');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `image_url` varchar(255) DEFAULT 'default.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@donitrip.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'admin','default.jpg','2025-11-13 07:16:42'),(2,'Doni User','user@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'user','default.jpg','2025-11-13 07:16:42'),(3,'Akmal celiboy','digital@gmail.com','$2y$10$POsGaVVmhXRI7yqNaK3HaukvF7iSUL7yuuhOl5DcuSWXfmDjkTcpW',NULL,'user','default.jpg','2025-11-13 08:14:24'),(4,'Putri Cinderella','putri@gmail.com','$2y$10$L5x/sZ.u6acdhoABmeX3se0NP1nrVnufKcqnJgUxg3c2BhYgoXV7S',NULL,'user','default.jpg','2025-11-13 10:22:54'),(5,'Cici Candrawati','cici@gmail.com','$2y$10$qmh7o6.X8t3oQha32dVNPeTeVoFE.MYAV7LWTyxp2wtoLZ3N7AbWq',NULL,'user','default.jpg','2025-11-16 19:34:54'),(6,'Doni Wahyono','doni@trip.com','$2y$10$xj7PTbcmDgll6Qri6ixE5e0xUt54eW5z2kqVO9edHVRKyKSBnLqYm',NULL,'user','default.jpg','2025-11-17 15:22:06');
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

-- Dump completed on 2026-04-19 10:36:47
