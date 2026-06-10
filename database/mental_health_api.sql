-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2026 at 02:46 PM
-- Server version: 8.4.3
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mental_health_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_score` int NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_scores` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `user_id`, `total_score`, `level`, `category_scores`, `created_at`, `updated_at`) VALUES
(1, 2, 40, 'Berat', '{\"burnout\": 12, \"depresi\": 12, \"kecemasan\": 16}', '2026-05-23 08:00:28', '2026-05-23 08:00:28'),
(2, 2, 0, 'Ringan', '{\"burnout\": 0, \"depresi\": 0, \"kecemasan\": 0}', '2026-05-26 01:44:00', '2026-05-26 01:44:00'),
(3, 2, 0, 'Ringan', '{\"burnout\": 0, \"depresi\": 0, \"kecemasan\": 0}', '2026-05-26 01:44:00', '2026-05-26 01:44:00'),
(4, 2, 18, 'Sedang', '{\"burnout\": 3, \"depresi\": 9, \"kecemasan\": 6}', '2026-06-03 20:19:29', '2026-06-03 20:19:29'),
(5, 2, 0, 'Ringan', '{\"burnout\": 0, \"depresi\": 0, \"kecemasan\": 0}', '2026-06-03 20:21:19', '2026-06-03 20:21:19'),
(6, 5, 0, 'Ringan', '{\"burnout\": 0, \"depresi\": 0, \"kecemasan\": 0}', '2026-06-03 23:39:57', '2026-06-03 23:39:57'),
(7, 5, 40, 'Berat', '{\"burnout\": 12, \"depresi\": 12, \"kecemasan\": 16}', '2026-06-03 23:40:14', '2026-06-03 23:40:14'),
(8, 6, 18, 'Sedang', '{\"burnout\": 7, \"depresi\": 6, \"kecemasan\": 5}', '2026-06-04 09:31:18', '2026-06-04 09:31:18'),
(9, 2, 14, 'Sedang', '{\"burnout\": 3, \"depresi\": 4, \"kecemasan\": 7}', '2026-06-04 09:37:54', '2026-06-04 09:37:54'),
(10, 2, 16, 'Sedang', '{\"burnout\": 5, \"depresi\": 1, \"kecemasan\": 10}', '2026-06-04 09:38:18', '2026-06-04 09:38:18'),
(11, 2, 16, 'Sedang', '{\"burnout\": 5, \"depresi\": 1, \"kecemasan\": 10}', '2026-06-04 09:38:19', '2026-06-04 09:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `therapist_id` bigint UNSIGNED NOT NULL,
  `status` enum('active','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_20_132206_create_moods_table', 1),
(5, '2026_05_20_135112_create_personal_access_tokens_table', 2),
(6, '2026_05_21_000001_create_assessments_table', 3),
(7, '2026_06_10_000001_add_role_fields_to_users_table', 4),
(8, '2026_06_10_000002_create_news_table', 4),
(9, '2026_06_10_000003_create_chat_rooms_table', 4),
(10, '2026_06_10_000004_create_messages_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `moods`
--

CREATE TABLE `moods` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `score` int NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moods`
--

INSERT INTO `moods` (`id`, `user_id`, `score`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 10, NULL, '2026-05-20 07:05:15', '2026-05-20 07:05:15'),
(2, 1, 10, 'banyak tugas', '2026-05-20 07:05:48', '2026-05-20 07:05:48'),
(3, 2, 6, 'test', '2026-05-20 15:29:21', '2026-05-20 15:29:21'),
(4, 2, 10, NULL, '2026-05-20 17:45:16', '2026-05-20 17:45:16'),
(5, 2, 1, NULL, '2026-05-20 17:45:20', '2026-05-20 17:45:20'),
(6, 2, 5, NULL, '2026-05-20 19:32:40', '2026-05-20 19:32:40'),
(7, 2, 10, 'sad', '2026-05-20 19:37:45', '2026-05-20 19:37:45'),
(8, 2, 10, 'sedihahwhah', '2026-05-20 19:40:43', '2026-05-20 19:40:43'),
(9, 2, 3, NULL, '2026-05-20 19:58:08', '2026-05-20 19:58:08'),
(10, 2, 3, NULL, '2026-05-20 19:58:10', '2026-05-20 19:58:10'),
(11, 2, 3, NULL, '2026-05-20 19:58:12', '2026-05-20 19:58:12'),
(12, 2, 3, NULL, '2026-05-20 19:58:16', '2026-05-20 19:58:16'),
(13, 2, 1, NULL, '2026-05-20 20:45:32', '2026-05-20 20:45:32'),
(14, 2, 1, NULL, '2026-05-20 20:45:34', '2026-05-20 20:45:34'),
(15, 2, 1, NULL, '2026-05-20 20:45:37', '2026-05-20 20:45:37'),
(16, 2, 1, NULL, '2026-05-20 20:45:41', '2026-05-20 20:45:41'),
(17, 2, 1, NULL, '2026-05-20 20:45:47', '2026-05-20 20:45:47'),
(19, 2, 5, 'dfhdnx hbz', '2026-05-20 20:46:17', '2026-05-20 20:46:17'),
(20, 3, 10, 'aku sedih', '2026-05-20 22:31:32', '2026-05-20 22:31:32'),
(21, 3, 1, NULL, '2026-05-20 22:31:42', '2026-05-20 22:31:42'),
(22, 3, 1, NULL, '2026-05-20 22:31:44', '2026-05-20 22:31:44'),
(23, 3, 1, NULL, '2026-05-20 22:31:46', '2026-05-20 22:31:46'),
(24, 2, 6, 'adadad', '2026-05-26 01:43:32', '2026-05-26 01:43:32'),
(25, 4, 10, 'hari ini aku uas api', '2026-06-03 20:13:53', '2026-06-03 20:13:53'),
(26, 2, 10, NULL, '2026-06-03 20:18:24', '2026-06-03 20:18:24'),
(27, 2, 10, NULL, '2026-06-03 20:18:28', '2026-06-03 20:18:28'),
(28, 2, 10, NULL, '2026-06-03 20:18:35', '2026-06-03 20:18:35'),
(29, 5, 10, 'presentasi api', '2026-06-03 23:38:46', '2026-06-03 23:38:46'),
(30, 5, 1, NULL, '2026-06-03 23:38:55', '2026-06-03 23:38:55'),
(31, 5, 9, NULL, '2026-06-03 23:39:05', '2026-06-03 23:39:05'),
(32, 5, 10, NULL, '2026-06-03 23:39:08', '2026-06-03 23:39:08'),
(33, 5, 1, NULL, '2026-06-03 23:39:24', '2026-06-03 23:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aV8FeQY5TSQ3A6oZBRH4RGYWBHRXTZCXECt7eC0g', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ2dVpjU1RhVTVhb0s5ZmhQalRIandaeEN0cnlYcWFHS3Z0SmVVcExVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9lZHVjYXRpb24iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780295072),
('eqNukhrRQnz6DIvJodmLsMSboMC4rEVzJFlCGuBP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI3QzlNbWgwNVVnVGpMdTNibWFlUHNlMjBBWUNaSG9MOUE0c0Jxb0NyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9lZHVjYXRpb24iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780245943),
('fG8mB9um5Ag23Q0CqPcDaCiu5CmZIflh18wynuMT', NULL, '127.0.0.1', 'PostmanRuntime/7.54.0', 'eyJfdG9rZW4iOiJoc2lNRkR0dU1IMUxKSTRGY1hxUTU1MzV6aXVGbEszb3RaOUJ5T1hKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780590814),
('kT4XobraKfwtykCVlmY2p2MDODIieIAGrol1f0K3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ5RkdIemtwQTB3dVRUcHNsSXltMHN6aEE0TDE2RmRkSWFrWkFEYXhMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9lZHVjYXRpb24iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780246050),
('L6g7FhiOmcJhBB6MikZ5Y9hsvDaWjDXz7lOlnDqY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJLWEhaNXE1S2E0S3BVclpuTGNNVjlnWENkRm1Bd3REUHVIS0RZMEpqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9lZHVjYXRpb24iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780485733),
('LbqWRoi8eiqVo80iUyegayxPlG4dMUJiwEHqRYWr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJPY2UyQ1JFblFrNTdqcHlURU5ZdWV1RHNDYVlVcGVXa2VUSGhXbDd4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780542505),
('soGWLxKnVooSgCZsbtZ5JikY6jlkR3GyMgqPZpCU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJRMGNTN3N5Q3B1TVpneWY1MThqVDNrVnU5WGVIMm9sSDl0blUyQ3k4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780409735),
('sQ8pjH808OGYe75EU5Zswf2SYRpxIiEnwxZnwu0n', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI4TUtiWGRrNmZRNENDd2h2SUpHMEJTQ2VtS3pwQXhQTUNRY3ZzV0NwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9lZHVjYXRpb24iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780542504),
('UgbmHVDFbkIhHtNlv4fPt7csNt5ITPDblB1ry7Kr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJhVHZnRGJHSEgzRk9hVG9qMzBCZU1aTk9tUjFZQW1rRkZQZHoxcmxpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780542504),
('UKhAhoNxsDLyjFmQlfCgggDY5kakeeWvIYcrHnNx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJzU2xLOFNDOEFoa3VrdElGZ0lJbXhBbmJvd1dlWXFqQTVnUEplQlRRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9lZHVjYXRpb24iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780110220),
('uldTB3tkrgjCJNbyKvC93OHIn4Ng7b0aVgaVsMZf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ2U2ttVzdxQlR1b3hhdmtaQnVyOVdpZE41Q2VYNTdrNEZqemNPMWtrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780330290),
('yABzwqAzdpQllJPOD7iv1EhqJRdiY9rkBXG60HmT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJlV29iT2ppM0xienBlSlFYd1FSV21Ub0VHOUdhb0JydmJ0ekM1UlRjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9nYW1lc1wvcHV6emxlIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1780591180),
('YjxTYfj8hkKom52SlR3EzdB8Wa3MMT85g1jkGHwS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJBZG5IUUEwejhHdENGYkh3RUoyQ1dXcEhMYzFRRWpZdXU4bVNjamRSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1780556117),
('Z8WyD3WB0Z2f7evR5pYU4sUcyFvBNRPxUtRlml2J', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJyemhyNVhXVDR5MlNwdmpnTnE4RWp6T2lyTFNSTlBwekk3eXBkdEQyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1780106558);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','therapist','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','pending','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `address` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `status`, `address`, `avatar`, `bio`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Budi Mahasiswa', 'budi@kampus.com', 'user', 'active', NULL, NULL, NULL, NULL, '$2y$12$uxIJqsU.uVpaN8zOKwcYFu4hR88HrwAA/Bm5SD/ygNG.EAt8Z3MQW', NULL, '2026-05-20 07:01:54', '2026-05-20 07:01:54'),
(2, 'tester', 'tester@gmail.com', 'user', 'active', NULL, NULL, NULL, NULL, '$2y$12$XfYgw1Syy2OeY3ugNvbDyO65N3mJJL7jq5CPGM1fK7sqagO.jiPYC', NULL, '2026-05-20 15:28:39', '2026-05-20 15:28:39'),
(3, 'hakim', 'hakim@gmail.com', 'admin', 'active', NULL, NULL, NULL, NULL, '$2y$12$27TIQ/ktzO9TKc4je0/aOOWXVYkp7Vcl3SSj6RyVz7fDh24dLlCQm', NULL, '2026-05-20 22:30:37', '2026-05-20 22:30:37'),
(4, 'hahawdf', 'adadw@gmail.com', 'user', 'active', NULL, NULL, NULL, NULL, '$2y$12$cdpm/hvgFv1mnWvxHveekOfh1wjHsDCHYAiNk0lYw7lac7ozHJEQO', NULL, '2026-06-03 20:12:00', '2026-06-03 20:12:00'),
(5, 'jevi', 'jevi@gmail.com', 'user', 'active', NULL, NULL, NULL, NULL, '$2y$12$UGHfhJ4pFiZSe0ABYCQtCOlJ3K3fTqM9yQr1bzFWPCEs5nBHqmc4.', NULL, '2026-06-03 23:37:55', '2026-06-03 23:37:55'),
(6, 'Tester', 'tester@test.com', 'user', 'active', NULL, NULL, NULL, NULL, '$2y$12$/YCeSTGeoBLR6T.g2StiruvTxbG5Fqco0ll7WnHFXYz13g0NSsI8O', NULL, '2026-06-04 09:15:55', '2026-06-04 09:15:55'),
(7, 'hakim', 'hakim12@gmail.com', 'therapist', 'active', NULL, NULL, NULL, NULL, '$2y$12$RQu2ms8NwND6linNSqkN7uV2ekvIXXTm4e5.wzHkVF5plJgKhm1Ja', NULL, '2026-06-10 04:48:55', '2026-06-10 07:44:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessments_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_rooms_user_id_foreign` (`user_id`),
  ADD KEY `chat_rooms_therapist_id_foreign` (`therapist_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_room_id_foreign` (`room_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moods`
--
ALTER TABLE `moods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moods_user_id_foreign` (`user_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_author_id_foreign` (`author_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `moods`
--
ALTER TABLE `moods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD CONSTRAINT `chat_rooms_therapist_id_foreign` FOREIGN KEY (`therapist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `moods`
--
ALTER TABLE `moods`
  ADD CONSTRAINT `moods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
