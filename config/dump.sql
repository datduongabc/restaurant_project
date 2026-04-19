-- MySQL dump 10.13  Distrib 8.4.8, for Win64 (x86_64)
--
-- Host: localhost    Database: food_ordering_db
-- ------------------------------------------------------
-- Server version	8.4.8

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
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_Id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` tinyint DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_cart_items_user_Id_users` (`user_Id`),
  KEY `fk_cart_items_product_id_products` (`product_id`),
  CONSTRAINT `fk_cart_items_product_id_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_cart_items_user_Id_users` FOREIGN KEY (`user_Id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Starters','starters','2026-04-16 06:22:59','2026-04-16 06:22:59',NULL),(2,'Main Dishes','main_dishes','2026-04-16 06:22:59','2026-04-19 03:56:29',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Ascent Restaurant - District 1','123 Le Loi Street, Ben Thanh Ward, District 1, Ho Chi Minh City','https://maps.app.goo.gl/District1Branch'),(2,'Ascent Restaurant - District 7','456 Nguyen Van Linh Street, Tan Phong Ward, District 7, Ho Chi Minh City','https://maps.app.goo.gl/District7Branch'),(3,'Ascent Restaurant - Thu Duc','789 Vo Van Ngan Street, Linh Chieu Ward, Thu Duc City, Ho Chi Minh City','https://maps.app.goo.gl/ThuDucBranch');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price_at_purchase` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_order_items_order_id_orders` (`order_id`),
  KEY `fk_order_items_product_id_products` (`product_id`),
  CONSTRAINT `fk_order_items_order_id_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_items_product_id_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,12.50,2),(2,1,13,28.00,1),(3,2,15,24.50,1),(4,3,20,29.50,1),(5,3,5,6.00,2),(6,4,23,45.00,1),(7,5,10,14.00,1),(8,6,12,10.50,1),(9,6,18,38.00,1);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_order_item_insert` AFTER INSERT ON `order_items` FOR EACH ROW BEGIN
    UPDATE orders
    SET total_price = total_price + (NEW.price_at_purchase * NEW.quantity)
    WHERE id = NEW.order_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('PENDING','CONFIRMED','COMPLETED','CANCELLED') DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_orders_user_id_users` (`user_id`),
  CONSTRAINT `fk_orders_user_id_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,53.00,'COMPLETED','2026-04-16 07:06:43'),(2,2,24.50,'PENDING','2026-04-16 07:06:43'),(3,5,41.50,'CONFIRMED','2026-04-16 07:06:43'),(4,10,45.00,'COMPLETED','2026-04-16 07:06:43'),(5,15,14.00,'CANCELLED','2026-04-16 07:06:43'),(6,4,48.50,'COMPLETED','2026-04-16 07:16:04'),(7,2,0.00,'COMPLETED','2026-04-16 07:17:27'),(8,5,0.00,'COMPLETED','2026-04-16 07:17:27'),(9,8,0.00,'COMPLETED','2026-04-16 07:17:27'),(10,12,0.00,'COMPLETED','2026-04-16 07:17:27'),(11,15,0.00,'COMPLETED','2026-04-16 07:17:27');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` char(64) NOT NULL,
  `type` enum('FORGOT_PASSWORD','REMEMBER_ME','EMAIL_VERIFICATION','CHANGE_PASSWORD') DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `attempts` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_password_resets_user_id_users` (`user_id`),
  CONSTRAINT `fk_password_resets_user_id_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `password_resets_chk_1` CHECK ((`attempts` <= 5))
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES (4,29,'$2y$10$wtFcVj7BVHVjMjwTqLF9J.2ZMEFClt.YbO9gA/KDNCjhC5LMJmFDK','EMAIL_VERIFICATION','2026-04-17 11:31:53',0,'2026-04-17 04:16:53',NULL),(5,30,'$2y$10$aVId83BURYXrPFCjqMSSmOXZwbIwAqskXov7XcPYJux2dDeKxIDri','EMAIL_VERIFICATION','2026-04-17 11:41:04',0,'2026-04-17 04:26:04',NULL),(9,34,'$2y$10$Y/5Cu9Uzufe9kr9LKTl6le//zgQNosGpL/wt3Jthxntkly47aMFvC','EMAIL_VERIFICATION','2026-04-17 16:50:13',0,'2026-04-17 09:35:13',NULL),(29,37,'$2y$10$lpGo.mo1L.1iburrh.CVKON24MFlHKkG15tKcDpWhUHra.ckiJ34q','EMAIL_VERIFICATION','2026-04-19 12:02:48',0,'2026-04-19 04:47:48',NULL),(30,36,'$2y$10$yajQNEPqqsH/zy4ik0tGqeLuOEWX01gEBuSNVkTaOSZ6u/SfhJpIW','CHANGE_PASSWORD','2026-04-19 12:26:15',0,'2026-04-19 05:11:15',NULL),(31,42,'$2y$10$dpHX9yw7orOihWGirLHBPej6U5RkP3uck3iZ9SdaoYwVGgomI4Byq','EMAIL_VERIFICATION','2026-04-19 12:59:15',0,'2026-04-19 05:44:15',NULL);
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_availabilities`
--

DROP TABLE IF EXISTS `product_availabilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_availabilities` (
  `product_id` int NOT NULL,
  `location_id` int NOT NULL,
  PRIMARY KEY (`product_id`,`location_id`),
  KEY `fk_product_availability_location_id_locations` (`location_id`),
  CONSTRAINT `fk_product_availability_location_id_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_product_availability_product_id_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_availabilities`
--

LOCK TABLES `product_availabilities` WRITE;
/*!40000 ALTER TABLE `product_availabilities` DISABLE KEYS */;
INSERT INTO `product_availabilities` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(1,3),(2,3),(3,3),(4,3),(5,3),(6,3),(7,3),(8,3),(9,3),(10,3),(11,3),(12,3),(13,3),(14,3),(15,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(22,3),(23,3),(24,3),(25,3),(26,3),(27,3),(28,3),(29,3),(30,3);
/*!40000 ALTER TABLE `product_availabilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `average_rating` decimal(3,2) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `fk_products_category_id_categories` (`category_id`),
  CONSTRAINT `fk_products_category_id_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'caesar_salad.webp','Classic Caesar Salad','Crisp romaine lettuce tossed in house-made creamy Caesar dressing. Topped with buttery croutons, aged Parmesan, and black pepper. A refreshing light start.',12.50,NULL,'caesar-salad','2026-04-16 06:27:39',NULL),(2,1,'crab_corn_chicken_soup.webp','Crab, Corn & Chicken Soup','Thick Asian-style soup with fresh crab meat, sweet corn, and tender chicken. Simmered in rich broth and finished with a hint of sesame oil for a warm palate.',10.00,NULL,'crab-corn-chicken-soup','2026-04-16 06:27:39',NULL),(3,1,'fish_sauce_chicken_wings.webp','Fish Sauce Chicken Wings','Golden fried chicken wings glazed in a savory and sweet garlic-infused fish sauce reduction. A perfect balance of salty and tangy flavors with a crispy finish.',14.50,NULL,'fish-sauce-chicken-wings','2026-04-16 06:27:39',NULL),(4,1,'french_onion_soup.webp','French Onion Soup','Rich, slow-simmered onion broth topped with toasted artisan baguette and a thick layer of melted, bubbly Gruyere cheese. A classic Parisian comfort dish.',11.00,NULL,'french-onion-soup','2026-04-16 06:27:39',NULL),(5,1,'garlic_butter_bread.webp','Garlic Butter Bread','Artisan baguette slices toasted with house-blended garlic butter made from premium butter, roasted garlic, and fresh parsley. Irresistibly crunchy and savory.',6.00,NULL,'garlic-butter-bread','2026-04-16 06:27:39',NULL),(6,1,'herb_potato_wedges.webp','Herb Potato Wedges','Thick-cut potato wedges roasted with Mediterranean herbs like rosemary and thyme. Crispy on the outside and fluffy inside. Served with spicy garlic mayo.',8.50,NULL,'herb-potato-wedges','2026-04-16 06:27:39',NULL),(7,1,'nha_trang_grilled_pork.webp','Nha Trang Grilled Pork','Skewers of lean pork marinated in lemongrass and local spices, grilled over charcoal for a smoky aroma. Served with traditional peanut dipping sauce.',15.00,NULL,'nha-trang-grilled-pork','2026-04-16 06:27:39',NULL),(8,1,'papaya_salad_dried_beef.webp','Papaya Salad with Dried Beef','Crunchy green papaya and aromatic herbs tossed in zesty lime vinaigrette. Topped with savory dried beef and roasted peanuts for an explosion of textures.',13.00,NULL,'papaya-salad-dried-beef','2026-04-16 06:27:39',NULL),(9,1,'seafood_spring_rolls_mayo.webp','Seafood Spring Rolls with Mayo','Crispy spring rolls stuffed with premium shrimp, squid, and taro. Served with a smooth, tangy Japanese mayonnaise dipping sauce for a rich seafood experience.',12.00,NULL,'seafood-spring-rolls-mayo','2026-04-16 06:27:39',NULL),(10,1,'seaweed_flying_fish_roe_salad.webp','Seaweed & Roe Salad','Nutrient-rich chilled seaweed marinated in sesame oil and vinegar. Topped with crunchy flying fish roe that pops with every bite. Fresh and nutty flavor.',14.00,NULL,'seaweed-roe-salad','2026-04-16 06:27:39',NULL),(11,1,'shrimp_pork_spring_rolls.webp','Shrimp & Pork Spring Rolls','Fresh rice paper rolls with poached tiger prawns, pork belly, vermicelli, and fresh mint. Served with a rich hoisin-peanut dipping sauce. Light and healthy.',9.50,NULL,'shrimp-pork-spring-rolls','2026-04-16 06:27:39',NULL),(12,1,'silken_tofu_pork_floss_salted_egg.webp','Silken Tofu with Salted Egg','Velvety smooth silken tofu topped with rich salted egg yolk sauce, premium pork floss, and scallion oil. A unique contrast of cool tofu and savory toppings.',10.50,NULL,'silken-tofu-salted-egg','2026-04-16 06:27:39',NULL),(13,2,'bbq_grilled_pork_ribs.webp','BBQ Grilled Pork Ribs','Fall-off-the-bone tender baby back ribs glazed in smoky hickory BBQ sauce. Grilled over an open flame and served with creamy coleslaw and buttered corn.',28.00,NULL,'bbq-grilled-pork-ribs','2026-04-16 06:27:39',NULL),(14,2,'beef_steak_red_wine.webp','Beef Steak in Red Wine','Premium center-cut beef tenderloin seared to perfection and drizzled with a luxurious Cabernet Sauvignon reduction. Served with garlic mashed potatoes.',35.00,NULL,'beef-steak-red-wine','2026-04-16 06:27:39',NULL),(15,2,'chicken_breast_rolled_with_mushrooms_in_cream_sauce.webp','Mushroom Cream Chicken Roll','Chicken breast rolled with sautéed wild mushrooms and herbs, oven-baked and smothered in a velvety Chardonnay cream sauce. Served with roasted vegetables.',24.50,NULL,'mushroom-cream-chicken','2026-04-16 06:27:39',NULL),(16,2,'crispy_fried_noodles_with_seafood.webp','Crispy Seafood Fried Noodles','Bird’s nest crispy egg noodles topped with stir-fried tiger prawns, squid, and seasonal vegetables in a savory ginger-soy gravy. A delightful mix of textures.',18.00,NULL,'crispy-seafood-noodles','2026-04-16 06:27:39',NULL),(17,2,'crispy_fried_stuffed_squid.webp','Crispy Stuffed Squid','Large fresh squid stuffed with seasoned minced pork and wood-ear mushrooms, fried until golden. Served with sweet chili sauce and fresh cucumbers.',22.00,NULL,'crispy-stuffed-squid','2026-04-16 06:27:39',NULL),(18,2,'german_braised_pork_knuckle.webp','German Braised Pork Knuckle','Authentic Bavarian pork knuckle braised in dark beer and roasted until skin is crackling crisp. Served with sauerkraut, potato dumplings, and rich gravy.',32.00,NULL,'german-pork-knuckle','2026-04-16 06:27:39',NULL),(19,2,'grilled_chicken_with_wild_honey.webp','Wild Honey Grilled Chicken','Half chicken marinated in wild mountain honey and garden herbs, grilled slowly for caramelized skin and juicy meat. Served with jasmine rice and ginger sauce.',20.00,NULL,'wild-honey-grilled-chicken','2026-04-16 06:27:39',NULL),(20,2,'herb_grilled_lamb.webp','Herb Grilled Lamb Chops','Premium lamb chops marinated in rosemary and extra virgin olive oil. Char-broiled and served with mint jelly, roasted root vegetables, and red wine jus.',38.00,NULL,'herb-grilled-lamb','2026-04-16 06:27:39',NULL),(21,2,'hong_kong_style_steamed_sea_bass.webp','HK Style Steamed Sea Bass','Fresh sea bass steamed with julienned ginger and scallions. Finished with sizzling premium soy sauce and hot peanut oil to release aromatic flavors.',30.00,NULL,'hk-steamed-sea-bass','2026-04-16 06:27:39',NULL),(22,2,'pan_seared_salmon_with_passion_fruit_sauce.webp','Passion Fruit Salmon','Pan-seared Atlantic salmon fillet with crispy skin and flaky center. Balanced by a bright passion fruit reduction. Served on baby spinach and quinoa.',29.50,NULL,'passion-fruit-salmon','2026-04-16 06:27:39',NULL),(23,2,'peking_roast_duck.webp','Peking Roast Duck','World-famous delicacy with thin, honey-glazed crispy skin. Served with warm handmade pancakes, scallions, cucumbers, and sweet hoisin dipping sauce.',45.00,NULL,'peking-roast-duck','2026-04-16 06:27:39',NULL),(24,2,'royal_seafood_fried_rice.webp','Royal Seafood Fried Rice','Fragrant jasmine rice stir-fried with shrimp, squid, and scallops. Infused with natural golden turmeric and topped with crispy shallots and scallions.',16.50,NULL,'royal-seafood-fried-rice','2026-04-16 06:27:39',NULL),(25,2,'seafood_cheese_pizza.webp','Seafood Cheese Pizza','Stone-baked thin crust pizza topped with San Marzano tomato sauce, Mozzarella, tiger prawns, and squid rings. Finished with dried oregano and chili flakes.',19.00,NULL,'seafood-cheese-pizza','2026-04-16 06:27:39',NULL),(26,2,'shaking_beef_with_french_fries.webp','Shaking Beef with Fries','Premium beef tenderloin cubes wok-tossed with red onions and a savory soy-butter glaze. Served with fresh salad and crispy golden-brown French fries.',26.00,NULL,'shaking-beef-fries','2026-04-16 06:27:39',NULL),(27,2,'spaghetti_bolognese.webp','Classic Spaghetti Bolognese','Al dente spaghetti smothered in a deep, rich meat sauce slow-simmered for eight hours with premium beef and vine-ripened tomatoes. Topped with parmesan.',15.50,NULL,'spaghetti-bolognese','2026-04-16 06:27:39',NULL),(28,2,'steamed_giant_prawns_with_coconut_water.webp','Coconut Steamed Prawns','Jumbo tiger prawns steamed inside a fresh young coconut to infuse natural sweetness. Served with a zesty green chili and lime dipping sauce.',25.00,NULL,'coconut-steamed-prawns','2026-04-16 06:27:39',NULL),(29,2,'thai_green_chicken_curry.webp','Thai Green Chicken Curry','Aromatic and spicy classic curry with tender chicken, coconut milk, lemongrass, and Thai basil. Best enjoyed with fragrant jasmine rice.',18.50,NULL,'thai-green-curry','2026-04-16 06:27:39',NULL),(30,2,'thai_spicy_and_sour_seafood_hot_pot.webp','Thai Spicy Seafood Hot Pot','Grand pot of spicy Tom Yum broth packed with tiger prawns, squid, and fish. A perfect balance of spicy, sour, and savory flavors designed for sharing.',42.00,NULL,'thai-seafood-hotpot','2026-04-16 06:27:39',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `location_id` int NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `guest_count` tinyint NOT NULL DEFAULT '1',
  `special_requests` text,
  `status` enum('PENDING','CONFIRMED','COMPLETED','CANCELLED') DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_reservations_user_id_users` (`user_id`),
  KEY `fk_reservations_location_id_locations` (`location_id`),
  CONSTRAINT `fk_reservations_location_id_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reservations_user_id_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,36,1,'DUONG NGUYEN TAN DAT','0819152362','2026-04-20','10:10:00',3,'No comment here.','PENDING','2026-04-19 04:37:53',NULL);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` tinyint DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_reviews_user_id_users` (`user_id`),
  KEY `fk_reviews_product_id_products` (`product_id`),
  CONSTRAINT `fk_reviews_product_id_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reviews_user_id_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_chk_1` CHECK ((`rating` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (6,1,1,5,'Excellent Caesar Salad! The greens are very fresh and the dressing is so rich.','2026-04-16 07:22:36'),(7,1,13,5,'The BBQ grilled ribs are tender, flavorful, and definitely worth the money.','2026-04-16 07:22:36'),(8,10,23,4,'Peking Duck has crispy skin, but it is a bit greasy.','2026-04-16 07:22:36'),(9,4,12,5,'Salted egg silken tofu is rich and creamy, with a very beautiful presentation.','2026-04-16 07:22:36'),(10,4,18,5,'Herb-grilled lamb chops are incredibly aromatic, cooked perfectly, and very juicy.','2026-04-16 07:22:36'),(11,2,14,5,'Steak is buttery soft, the red wine sauce is divine. Extremely satisfied!','2026-04-16 07:23:33'),(12,2,1,4,'Fresh salad, Caesar sauce is delicious but could use more croutons.','2026-04-16 07:23:33'),(13,5,21,5,'Very fresh sea bass, aromatic ginger and scallions. Authentic HK style.','2026-04-16 07:23:33'),(14,8,23,5,'Crispy skin duck and sweet meat, amazing when wrapped with rice paper.','2026-04-16 07:23:33'),(15,12,13,5,'BBQ grilled ribs are fragrant, the meat is tender and falls off the bone.','2026-04-16 07:23:33'),(16,15,30,3,'The Thai hot pot is a bit too spicy for me, but the seafood is fresh.','2026-04-16 07:23:33');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_review_insert` AFTER INSERT ON `reviews` FOR EACH ROW BEGIN
    UPDATE products
    SET average_rating = (SELECT AVG(rating) FROM reviews WHERE product_id = NEW.product_id)
    WHERE id = NEW.product_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('CUSTOMER','ADMIN') NOT NULL DEFAULT 'CUSTOMER',
  `phone` char(10) NOT NULL,
  `is_email_verified` tinyint DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'User 1','mockuser1@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000001',0,NULL,'2026-04-16 06:40:39',NULL),(2,'User 2','mockuser2@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000002',0,NULL,'2026-04-16 06:40:39',NULL),(3,'User 3','mockuser3@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000003',0,NULL,'2026-04-16 06:40:39',NULL),(4,'User 4','mockuser4@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000004',0,NULL,'2026-04-16 06:40:39',NULL),(5,'User 5','mockuser5@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000005',0,NULL,'2026-04-16 06:40:39',NULL),(6,'User 6','mockuser6@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000006',0,NULL,'2026-04-16 06:40:39',NULL),(7,'User 7','mockuser7@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000007',0,NULL,'2026-04-16 06:40:39',NULL),(8,'User 8','mockuser8@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000008',0,NULL,'2026-04-16 06:40:39',NULL),(9,'User 9','mockuser9@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000009',0,NULL,'2026-04-16 06:40:39',NULL),(10,'User 10','mockuser10@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000010',0,NULL,'2026-04-16 06:40:39',NULL),(11,'User 11','mockuser11@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000011',0,NULL,'2026-04-16 06:40:39',NULL),(12,'User 12','mockuser12@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000012',0,NULL,'2026-04-16 06:40:39',NULL),(13,'User 13','mockuser13@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000013',0,NULL,'2026-04-16 06:40:39',NULL),(14,'User 14','mockuser14@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000014',0,NULL,'2026-04-16 06:40:39',NULL),(15,'User 15','mockuser15@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000015',0,NULL,'2026-04-16 06:40:39',NULL),(16,'User 16','mockuser16@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000016',0,NULL,'2026-04-16 06:40:39',NULL),(17,'User 17','mockuser17@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000017',0,NULL,'2026-04-16 06:40:39',NULL),(18,'User 18','mockuser18@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000018',0,NULL,'2026-04-16 06:40:39',NULL),(19,'User 19','mockuser19@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000019',0,NULL,'2026-04-16 06:40:39',NULL),(20,'User 20','mockuser20@test.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','CUSTOMER','0000000020',0,NULL,'2026-04-16 06:40:39',NULL),(29,'ádadsads','dat@vn.com','$2y$10$xe9K3zVRg/cCO4IKo/AWzOMHDgkIjdWQaeKAQ2QGsWJEwFx8KJPVG','CUSTOMER','0819152363',0,NULL,'2026-04-17 04:16:53',NULL),(30,'DUONG NGUYEN TAN TRI','tandat@deptrai.com','$2y$10$rWWJCM3.gE4wZD4oZ92bTu.6r9OrA8cU86dJfWwXaJfq3kqwS6ykS','CUSTOMER','0987933926',0,NULL,'2026-04-17 04:26:04',NULL),(34,'Khai','quangkhaisaigonhcm@gmail.com','$2y$10$XXz0O.YTKB1hLnz39dhrnOcGScH2Wj/GRN6JELLIPmYGOw5EXjWGa','CUSTOMER','0987654323',0,NULL,'2026-04-17 09:35:13',NULL),(36,'DUONG NGUYEN TAN DAT','dat.duongtandat385@hcmut.edu.vn','$2y$10$KnKAKH0TW8Gw5CCdwjDcxuXGZ.LWNFvLvEB46VqCBYxuk7csNcJ5O','CUSTOMER','0819152362',1,'2026-04-19 03:32:13','2026-04-19 03:31:06',NULL),(37,'DUONG NGUYEN TAN TRI','admin@nhahang.com','$2y$10$ZGbNMZBvXQ/m1R5aDOKUqulhZeOJ2jLx3OUrFDWcW4GSvMvKcDlg.','CUSTOMER','0111111111',0,NULL,'2026-04-19 04:47:48',NULL),(38,'Administrator','admin@dateno.com','$2y$10$8K.u5O8Q6hK8L6hK8L6hKuX6V0W6hK8L6hK8L6hK8L6hK8L6hK8L6','ADMIN','0909123456',1,'2026-04-19 05:18:02','2026-04-19 05:18:02',NULL),(40,'Administrator','admintest@dateno.com','$2y$10$n9WfP.A/v8p7V6i1j5bKueWfW2v2XfP/v8p7V6i1j5bKueWfW2v2Xf','ADMIN','0909123457',1,'2026-04-19 05:19:45','2026-04-19 05:19:45',NULL),(41,'Administrator','admintest2@dateno.com','$2y$10$6ziuWnX00v9nPQcsO5INluh6bm7U4ApRpfD4I8YOZAsDhELAVhhPe','ADMIN','0909123458',1,'2026-04-19 05:20:39','2026-04-19 05:20:39',NULL),(42,'Test Happy Path','adad@gmail.com','$2y$10$gq7x4EjSphmFChgaCRiZ6emkoN3cSUDvmbrv72H5zbe10ifmyPP/i','CUSTOMER','0322343221',0,NULL,'2026-04-19 05:44:15',NULL);
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

-- Dump completed on 2026-04-19 17:43:29
