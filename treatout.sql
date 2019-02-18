-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for treatout
CREATE DATABASE IF NOT EXISTS `treatout` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `treatout`;

-- Dumping structure for table treatout.places
CREATE TABLE IF NOT EXISTS `places` (
  `place_id` varchar(155) DEFAULT NULL,
  `rate_min` decimal(10,2) unsigned DEFAULT NULL,
  `rate_max` decimal(10,2) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table treatout.places: ~1 rows (approximately)
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` (`place_id`, `rate_min`, `rate_max`) VALUES
	('chikininisatite69', 500.00, 1000.00);
/*!40000 ALTER TABLE `places` ENABLE KEYS */;

-- Dumping structure for table treatout.place_tags
CREATE TABLE IF NOT EXISTS `place_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int(10) unsigned DEFAULT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table treatout.place_tags: ~4 rows (approximately)
/*!40000 ALTER TABLE `place_tags` DISABLE KEYS */;
INSERT INTO `place_tags` (`id`, `place_id`, `tag_id`, `created_at`, `updated_at`) VALUES
	(1, 19, 2, '2018-07-08 13:47:48', '2018-07-08 13:47:48'),
	(2, 24, 2, '2018-07-08 13:47:48', '2018-07-08 13:47:48'),
	(3, 41, 3, '2018-07-08 13:47:48', '2018-07-08 13:47:48'),
	(4, 19, 3, '2018-07-26 14:35:09', '2018-07-26 14:35:09');
/*!40000 ALTER TABLE `place_tags` ENABLE KEYS */;

-- Dumping structure for table treatout.routes
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` int(11) unsigned DEFAULT NULL,
  `trans_id` int(11) unsigned DEFAULT NULL,
  `fare_rate_min` decimal(10,2) DEFAULT NULL,
  `fare_rate_max` decimal(10,2) unsigned NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_start` decimal(10,7) DEFAULT NULL,
  `latitude_start` decimal(10,7) DEFAULT NULL,
  `distance` decimal(10,2) DEFAULT NULL,
  `longitude_end` decimal(10,7) DEFAULT NULL,
  `latitude_end` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table treatout.routes: ~1 rows (approximately)
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` (`id`, `place_id`, `trans_id`, `fare_rate_min`, `fare_rate_max`, `description`, `longitude_start`, `latitude_start`, `distance`, `longitude_end`, `latitude_end`, `created_at`, `updated_at`) VALUES
	(2, 1, 2, 7.50, 0.00, NULL, 122.9614600, 10.6830640, 10.66, 122.9598440, 10.6867940, '2018-07-08 19:51:32', '2018-07-08 19:51:32');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;

-- Dumping structure for table treatout.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table treatout.tags: ~3 rows (approximately)
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`tag_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Backribs', '2018-07-08 19:53:11', '2018-07-08 19:53:11'),
	(2, 'Sisig', '2018-07-08 19:53:11', '2018-07-08 19:53:11'),
	(3, 'Beach Resort', '2018-07-08 19:53:11', '2018-07-08 19:53:11');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Dumping structure for table treatout.transportation
CREATE TABLE IF NOT EXISTS `transportation` (
  `trans_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `trans_type_id` int(10) unsigned NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table treatout.transportation: ~2 rows (approximately)
/*!40000 ALTER TABLE `transportation` DISABLE KEYS */;
INSERT INTO `transportation` (`trans_id`, `name`, `trans_type_id`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Bata - Libertad', 1, NULL, '2018-07-08 19:53:53', '2018-07-08 19:53:53'),
	(2, 'Mandalagan - Libertad', 1, NULL, '2018-07-08 19:53:53', '2018-07-08 19:53:53');
/*!40000 ALTER TABLE `transportation` ENABLE KEYS */;

-- Dumping structure for table treatout.transportation_type
CREATE TABLE IF NOT EXISTS `transportation_type` (
  `trans_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trans_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table treatout.transportation_type: ~4 rows (approximately)
/*!40000 ALTER TABLE `transportation_type` DISABLE KEYS */;
INSERT INTO `transportation_type` (`trans_type_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Jeep', '2018-07-26 15:50:06', '2018-07-26 15:50:06'),
	(2, 'Tricycle', '2018-07-26 15:50:24', '2018-07-26 15:50:24'),
	(3, 'Trisikad', '2018-07-26 15:51:20', '2018-07-26 15:51:20'),
	(4, 'Bus', '2018-07-26 15:51:35', '2018-07-26 15:51:35');
/*!40000 ALTER TABLE `transportation_type` ENABLE KEYS */;

-- Dumping structure for table treatout.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table treatout.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `latitude`, `longitude`, `remember_token`, `is_admin`, `created_at`, `updated_at`) VALUES
	(46, 'Rainy Day', 'treatout@example.com', '200820e3227815ed1756a6b531e7e0d2', NULL, NULL, NULL, 1, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
