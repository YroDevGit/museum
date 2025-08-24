-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for album
CREATE DATABASE IF NOT EXISTS `album` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `album`;

-- Dumping structure for table album.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.admin: ~1 rows (approximately)
REPLACE INTO `admin` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'admin');

-- Dumping structure for table album.album
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remote_id` int(11) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `date_over` datetime DEFAULT NULL,
  `date_upd` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('live','longterm') NOT NULL DEFAULT 'live',
  `venue_id` int(11) NOT NULL,
  `log` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.album: ~0 rows (approximately)
REPLACE INTO `album` (`id`, `remote_id`, `date_add`, `date_over`, `date_upd`, `status`, `venue_id`, `log`) VALUES
	(91, 117, '2025-08-24 11:52:39', '2025-08-24 11:52:39', '2025-08-24 19:53:06', 'longterm', 1, 1);

-- Dumping structure for table album.authentications
CREATE TABLE IF NOT EXISTS `authentications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `authentications_token_unique` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.authentications: ~0 rows (approximately)

-- Dumping structure for table album.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.cache: ~0 rows (approximately)

-- Dumping structure for table album.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.cache_locks: ~0 rows (approximately)

-- Dumping structure for table album.capture
CREATE TABLE IF NOT EXISTS `capture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `photobooth_id` int(11) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `capture_time` datetime NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.capture: ~0 rows (approximately)

-- Dumping structure for table album.cookies
CREATE TABLE IF NOT EXISTS `cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `remotetoken` text DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `token` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.cookies: ~17 rows (approximately)
REPLACE INTO `cookies` (`id`, `album`, `user`, `remote_id`, `remotetoken`, `date_created`, `status`, `token`) VALUES
	(15, 73, 132, 117, '31bb2073555a73b5', '2025-08-24 10:41:01', 1, '774a1e2dc984563c'),
	(16, 74, 133, 117, '31bb2073555a73b5', '2025-08-24 10:45:34', 1, 'af900f0100f25e61'),
	(17, 76, 135, 117, '31bb2073555a73b5', '2025-08-24 10:50:52', 1, 'b6f66c0f32e6bdc5'),
	(18, 77, 136, 117, '31bb2073555a73b5', '2025-08-24 10:56:13', 1, '3276c923362bfd0f'),
	(19, 78, 137, 117, '31bb2073555a73b5', '2025-08-24 10:58:06', 1, '9967c8c4d48ba949'),
	(20, 80, 139, 117, '31bb2073555a73b5', '2025-08-24 11:01:36', 1, '073b51468632a153'),
	(21, 81, 140, 117, '31bb2073555a73b5', '2025-08-24 11:03:04', 1, '65fbd82718e27fc8'),
	(22, 82, 141, 117, '31bb2073555a73b5', '2025-08-24 11:14:42', 1, '1e874a5b2c27e517'),
	(23, 85, 144, 117, '31bb2073555a73b5', '2025-08-24 11:17:36', 1, 'ff756dbd87a7fe2e'),
	(24, 86, 145, 117, '31bb2073555a73b5', '2025-08-24 11:21:20', 1, '60d028d75ad3a59f'),
	(25, 87, 146, 117, '31bb2073555a73b5', '2025-08-24 11:23:03', 1, '29c147baff07aca1'),
	(26, 88, 147, 117, '31bb2073555a73b5', '2025-08-24 11:30:14', 1, '7ebfd534647ae348'),
	(27, 88, 147, 117, '31bb2073555a73b5', '2025-08-24 11:51:55', 1, '7ebfd534647ae348'),
	(28, 91, 150, 117, '31bb2073555a73b5', '2025-08-24 11:53:06', 1, 'e30d6f8551c8b036'),
	(29, 91, 150, 117, '31bb2073555a73b5', '2025-08-24 11:53:33', 1, 'e30d6f8551c8b036'),
	(30, 91, 150, 117, '31bb2073555a73b5', '2025-08-24 11:53:51', 1, 'e30d6f8551c8b036'),
	(31, 91, 150, 117, '31bb2073555a73b5', '2025-08-24 11:54:50', 1, 'e30d6f8551c8b036'),
	(32, 91, 150, 117, '31bb2073555a73b5', '2025-08-24 11:57:20', 1, 'e30d6f8551c8b036'),
	(33, 91, 150, 117, '31bb2073555a73b5', '2025-08-24 11:57:35', 1, 'e30d6f8551c8b036'),
	(34, 91, 150, 117, '31bb2073555a73b5', '2025-08-24 11:59:54', 1, 'e30d6f8551c8b036');

-- Dumping structure for table album.devices
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) DEFAULT NULL,
  `device` text DEFAULT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.devices: ~2 rows (approximately)
REPLACE INTO `devices` (`id`, `device`, `token`) VALUES
	(117, 'Device 1', 'tokrn1'),
	(277, 'Main Device', '3433dd');

-- Dumping structure for table album.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table album.invite_token
CREATE TABLE IF NOT EXISTS `invite_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remote_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `remote_token` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `token` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.invite_token: ~7 rows (approximately)
REPLACE INTO `invite_token` (`id`, `remote_id`, `album_id`, `remote_token`, `date_added`, `status`, `token`) VALUES
	(5, 119, 38, '5fb60d75ce6763d7', '2025-07-30 06:42:01', 0, '0a23f727e9ed8c82'),
	(6, 119, 38, '5fb60d75ce6763d7', '2025-07-30 06:49:06', 0, '0a23f727e9ed8c82'),
	(7, 119, 39, '5fb60d75ce6763d7', '2025-07-30 08:21:41', 0, '0a23f727e9ed8c82'),
	(8, 119, 42, '5fb60d75ce6763d7', '2025-08-01 10:30:32', 0, '0a23f727e9ed8c82'),
	(9, 119, 70, '5fb60d75ce6763d7', '2025-08-04 12:53:26', 0, '34f05f39c1394d39'),
	(10, 119, 70, '5fb60d75ce6763d7', '2025-08-04 13:02:28', 0, '34f05f39c1394d39'),
	(11, 119, 71, '5fb60d75ce6763d7', '2025-08-04 13:44:24', 0, '34f05f39c1394d39');

-- Dumping structure for table album.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.jobs: ~0 rows (approximately)

-- Dumping structure for table album.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.job_batches: ~0 rows (approximately)

-- Dumping structure for table album.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.migrations: ~5 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_07_25_020725_create_authentications_table', 2),
	(5, '2025_07_25_021149_create_authentications_table', 3);

-- Dumping structure for table album.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table album.photobooth
CREATE TABLE IF NOT EXISTS `photobooth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venue_id` (`venue_id`),
  CONSTRAINT `photobooth_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.photobooth: ~0 rows (approximately)

-- Dumping structure for table album.remote
CREATE TABLE IF NOT EXISTS `remote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `venue_id` (`venue_id`),
  CONSTRAINT `remote_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.remote: ~9 rows (approximately)
REPLACE INTO `remote` (`id`, `venue_id`, `status`) VALUES
	(117, 1, 1),
	(118, 1, 1),
	(119, 1, 1),
	(120, 1, 1),
	(122, 1, 1),
	(150, 1, 0),
	(153, 1, 0),
	(158, 1, 0),
	(277, 2, 0);

-- Dumping structure for table album.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.sessions: ~3 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('3qdiE10C1brsBZtI9UZBYQpXleqRJ5UT1HQ2v6ZG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZVYzMVJCZkJ4Nm9oS05TR2NXRWRZZ2NrSE40c0I1R1RaU3pQRWludSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYWQuanBnIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756037079),
	('Nijg6Mk5R3NWSklzVIKXsKBGRfhncGm3ov9HZjiv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUFlbUd3SUNXeWVEaFNZVkdBTXM4RmNVcGs5akFYT3FpUXlseE9IdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1756037095),
	('OzfpOnMbBkH1DTqaf7iZuusy9A3OeYr3Z0v9IkoA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZm5uNkJTaHZmQjE1Q2x4RG9jTlhKeXFuNTJwQldSeTBMUlh5SGtjOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYWQuanBnIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756036801);

-- Dumping structure for table album.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `album_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `log` text DEFAULT NULL,
  `org` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.user: ~1 rows (approximately)
REPLACE INTO `user` (`id`, `date_add`, `album_id`, `email`, `name`, `log`, `org`) VALUES
	(150, '2025-08-24 11:52:39', 91, 'tyronemalocon@gmail.com', 'Tyrone Malocon Malocon', '', 1);

-- Dumping structure for table album.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table album.users: ~0 rows (approximately)

-- Dumping structure for table album.venue
CREATE TABLE IF NOT EXISTS `venue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table album.venue: ~2 rows (approximately)
REPLACE INTO `venue` (`id`, `name`) VALUES
	(1, 'Venue1'),
	(2, 'Venue2');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
