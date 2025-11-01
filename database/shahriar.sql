-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 06:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shahriar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"20b425b8-0c5f-4529-994e-b9a55f9c96d5\",\"displayName\":\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\",\"command\":\"O:58:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\\\":6:{s:14:\\\"\\u0000*\\u0000conversions\\\";O:52:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\ConversionCollection\\\":2:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;O:42:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Conversion\\\":11:{s:12:\\\"\\u0000*\\u0000fileNamer\\\";O:54:\\\"Spatie\\\\MediaLibrary\\\\Support\\\\FileNamer\\\\DefaultFileNamer\\\":0:{}s:28:\\\"\\u0000*\\u0000extractVideoFrameAtSecond\\\";d:0;s:16:\\\"\\u0000*\\u0000manipulations\\\";O:45:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Manipulations\\\":1:{s:16:\\\"\\u0000*\\u0000manipulations\\\";a:5:{s:8:\\\"optimize\\\";a:1:{i:0;O:36:\\\"Spatie\\\\ImageOptimizer\\\\OptimizerChain\\\":3:{s:13:\\\"\\u0000*\\u0000optimizers\\\";a:7:{i:0;O:42:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Jpegoptim\\\":5:{s:7:\\\"options\\\";a:4:{i:0;s:4:\\\"-m85\\\";i:1;s:7:\\\"--force\\\";i:2;s:11:\\\"--strip-all\\\";i:3;s:17:\\\"--all-progressive\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:9:\\\"jpegoptim\\\";}i:1;O:41:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Pngquant\\\":5:{s:7:\\\"options\\\";a:1:{i:0;s:7:\\\"--force\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:8:\\\"pngquant\\\";}i:2;O:40:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Optipng\\\":5:{s:7:\\\"options\\\";a:3:{i:0;s:3:\\\"-i0\\\";i:1;s:3:\\\"-o2\\\";i:2;s:6:\\\"-quiet\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:7:\\\"optipng\\\";}i:3;O:37:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Svgo\\\":5:{s:7:\\\"options\\\";a:1:{i:0;s:20:\\\"--disable=cleanupIDs\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:4:\\\"svgo\\\";}i:4;O:41:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Gifsicle\\\":5:{s:7:\\\"options\\\";a:2:{i:0;s:2:\\\"-b\\\";i:1;s:3:\\\"-O3\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:8:\\\"gifsicle\\\";}i:5;O:38:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Cwebp\\\":5:{s:7:\\\"options\\\";a:4:{i:0;s:4:\\\"-m 6\\\";i:1;s:8:\\\"-pass 10\\\";i:2;s:3:\\\"-mt\\\";i:3;s:5:\\\"-q 90\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:5:\\\"cwebp\\\";}i:6;O:40:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Avifenc\\\":6:{s:7:\\\"options\\\";a:8:{i:0;s:14:\\\"-a cq-level=23\\\";i:1;s:6:\\\"-j all\\\";i:2;s:7:\\\"--min 0\\\";i:3;s:8:\\\"--max 63\\\";i:4;s:12:\\\"--minalpha 0\\\";i:5;s:13:\\\"--maxalpha 63\\\";i:6;s:14:\\\"-a end-usage=q\\\";i:7;s:12:\\\"-a tune=ssim\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:7:\\\"avifenc\\\";s:16:\\\"decodeBinaryName\\\";s:7:\\\"avifdec\\\";}}s:9:\\\"\\u0000*\\u0000logger\\\";O:33:\\\"Spatie\\\\ImageOptimizer\\\\DummyLogger\\\":0:{}s:10:\\\"\\u0000*\\u0000timeout\\\";i:60;}}s:6:\\\"format\\\";a:1:{i:0;s:3:\\\"jpg\\\";}s:5:\\\"width\\\";a:1:{i:0;i:800;}s:6:\\\"height\\\";a:1:{i:0;i:600;}s:7:\\\"sharpen\\\";a:1:{i:0;i:10;}}}s:23:\\\"\\u0000*\\u0000performOnCollections\\\";a:0:{}s:17:\\\"\\u0000*\\u0000performOnQueue\\\";b:1;s:26:\\\"\\u0000*\\u0000keepOriginalImageFormat\\\";b:0;s:27:\\\"\\u0000*\\u0000generateResponsiveImages\\\";b:0;s:18:\\\"\\u0000*\\u0000widthCalculator\\\";N;s:24:\\\"\\u0000*\\u0000loadingAttributeValue\\\";N;s:16:\\\"\\u0000*\\u0000pdfPageNumber\\\";i:1;s:7:\\\"\\u0000*\\u0000name\\\";s:16:\\\"main-page-medium\\\";}}s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;}s:8:\\\"\\u0000*\\u0000media\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:49:\\\"Spatie\\\\MediaLibrary\\\\MediaCollections\\\\Models\\\\Media\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:14:\\\"\\u0000*\\u0000onlyMissing\\\";b:0;s:10:\\\"connection\\\";s:8:\\\"database\\\";s:5:\\\"queue\\\";s:0:\\\"\\\";s:11:\\\"afterCommit\\\";b:1;}\"},\"createdAt\":1760440967,\"delay\":null}', 0, NULL, 1760440967, 1760440967),
(2, 'default', '{\"uuid\":\"57de967f-ef77-4cf5-b0f0-9a85097c432f\",\"displayName\":\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\",\"command\":\"O:58:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\\\":6:{s:14:\\\"\\u0000*\\u0000conversions\\\";O:52:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\ConversionCollection\\\":2:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;O:42:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Conversion\\\":11:{s:12:\\\"\\u0000*\\u0000fileNamer\\\";O:54:\\\"Spatie\\\\MediaLibrary\\\\Support\\\\FileNamer\\\\DefaultFileNamer\\\":0:{}s:28:\\\"\\u0000*\\u0000extractVideoFrameAtSecond\\\";d:0;s:16:\\\"\\u0000*\\u0000manipulations\\\";O:45:\\\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Manipulations\\\":1:{s:16:\\\"\\u0000*\\u0000manipulations\\\";a:5:{s:8:\\\"optimize\\\";a:1:{i:0;O:36:\\\"Spatie\\\\ImageOptimizer\\\\OptimizerChain\\\":3:{s:13:\\\"\\u0000*\\u0000optimizers\\\";a:7:{i:0;O:42:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Jpegoptim\\\":5:{s:7:\\\"options\\\";a:4:{i:0;s:4:\\\"-m85\\\";i:1;s:7:\\\"--force\\\";i:2;s:11:\\\"--strip-all\\\";i:3;s:17:\\\"--all-progressive\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:9:\\\"jpegoptim\\\";}i:1;O:41:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Pngquant\\\":5:{s:7:\\\"options\\\";a:1:{i:0;s:7:\\\"--force\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:8:\\\"pngquant\\\";}i:2;O:40:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Optipng\\\":5:{s:7:\\\"options\\\";a:3:{i:0;s:3:\\\"-i0\\\";i:1;s:3:\\\"-o2\\\";i:2;s:6:\\\"-quiet\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:7:\\\"optipng\\\";}i:3;O:37:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Svgo\\\":5:{s:7:\\\"options\\\";a:1:{i:0;s:20:\\\"--disable=cleanupIDs\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:4:\\\"svgo\\\";}i:4;O:41:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Gifsicle\\\":5:{s:7:\\\"options\\\";a:2:{i:0;s:2:\\\"-b\\\";i:1;s:3:\\\"-O3\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:8:\\\"gifsicle\\\";}i:5;O:38:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Cwebp\\\":5:{s:7:\\\"options\\\";a:4:{i:0;s:4:\\\"-m 6\\\";i:1;s:8:\\\"-pass 10\\\";i:2;s:3:\\\"-mt\\\";i:3;s:5:\\\"-q 90\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:5:\\\"cwebp\\\";}i:6;O:40:\\\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Avifenc\\\":6:{s:7:\\\"options\\\";a:8:{i:0;s:14:\\\"-a cq-level=23\\\";i:1;s:6:\\\"-j all\\\";i:2;s:7:\\\"--min 0\\\";i:3;s:8:\\\"--max 63\\\";i:4;s:12:\\\"--minalpha 0\\\";i:5;s:13:\\\"--maxalpha 63\\\";i:6;s:14:\\\"-a end-usage=q\\\";i:7;s:12:\\\"-a tune=ssim\\\";}s:9:\\\"imagePath\\\";s:0:\\\"\\\";s:10:\\\"binaryPath\\\";s:0:\\\"\\\";s:7:\\\"tmpPath\\\";N;s:10:\\\"binaryName\\\";s:7:\\\"avifenc\\\";s:16:\\\"decodeBinaryName\\\";s:7:\\\"avifdec\\\";}}s:9:\\\"\\u0000*\\u0000logger\\\";O:33:\\\"Spatie\\\\ImageOptimizer\\\\DummyLogger\\\":0:{}s:10:\\\"\\u0000*\\u0000timeout\\\";i:60;}}s:6:\\\"format\\\";a:1:{i:0;s:3:\\\"jpg\\\";}s:5:\\\"width\\\";a:1:{i:0;i:800;}s:6:\\\"height\\\";a:1:{i:0;i:600;}s:7:\\\"sharpen\\\";a:1:{i:0;i:10;}}}s:23:\\\"\\u0000*\\u0000performOnCollections\\\";a:0:{}s:17:\\\"\\u0000*\\u0000performOnQueue\\\";b:1;s:26:\\\"\\u0000*\\u0000keepOriginalImageFormat\\\";b:0;s:27:\\\"\\u0000*\\u0000generateResponsiveImages\\\";b:0;s:18:\\\"\\u0000*\\u0000widthCalculator\\\";N;s:24:\\\"\\u0000*\\u0000loadingAttributeValue\\\";N;s:16:\\\"\\u0000*\\u0000pdfPageNumber\\\";i:1;s:7:\\\"\\u0000*\\u0000name\\\";s:16:\\\"main-page-medium\\\";}}s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;}s:8:\\\"\\u0000*\\u0000media\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:49:\\\"Spatie\\\\MediaLibrary\\\\MediaCollections\\\\Models\\\\Media\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:14:\\\"\\u0000*\\u0000onlyMissing\\\";b:0;s:10:\\\"connection\\\";s:8:\\\"database\\\";s:5:\\\"queue\\\";s:0:\\\"\\\";s:11:\\\"afterCommit\\\";b:1;}\"},\"createdAt\":1760441058,\"delay\":null}', 0, NULL, 1760441058, 1760441058);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_pages`
--

CREATE TABLE `landing_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_pages`
--

INSERT INTO `landing_pages` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, '2025-10-14 05:22:47', '2025-10-14 05:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `main_pages`
--

CREATE TABLE `main_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_text` text NOT NULL,
  `moto` text NOT NULL,
  `experience` smallint(5) UNSIGNED NOT NULL DEFAULT 11,
  `projects` smallint(5) UNSIGNED NOT NULL DEFAULT 10,
  `certification` smallint(5) UNSIGNED NOT NULL DEFAULT 6,
  `article` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `books` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `mentoring` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_pages`
--

INSERT INTO `main_pages` (`id`, `banner_text`, `moto`, `experience`, `projects`, `certification`, `article`, `books`, `mentoring`, `created_at`, `updated_at`) VALUES
(1, 'Embrace the extraordinary.<br/>Live your fullest life.', 'Connecting brands & people through experiences.', 11, 10, 6, 3, 1, 15, '2025-10-14 05:22:16', '2025-10-14 05:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\LandingPage', 1, 'cc4a9bba-bb91-4eec-932a-5e554c5b4fe1', 'images', 'WhatsApp Image 2025-10-12 at 11.09.36 AM', '1760441058.jpeg', 'image/jpeg', 'public', 'public', 189937, '[]', '{\"optimized\":true}', '[]', '[]', 1, '2025-10-14 05:24:18', '2025-10-14 05:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_14_094859_create_main_pages_table', 1),
(5, '2025_10_14_101530_create_media_table', 1),
(6, '2025_10_14_110507_create_landing_pages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dPDkxUArMMIQB7g4CGGnzwSV62cMUyeY7OJ1TVcW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWDNobmFHT3lnT3huNVJ5M09CcnlhTXRTeWpCQnN4bFk0OHliRTR6ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZS9sYW5kaW5nLXBhZ2UiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjI6IlBIUERFQlVHQkFSX1NUQUNLX0RBVEEiO2E6MDp7fX0=', 1760441689);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, '$2y$12$RQ1NnKUSF3CFun1UxCIqGeXOQWS/WdFZ5u2KjoqKUujYHZA6KUmEa', NULL, '2025-10-14 05:19:23', '2025-10-14 05:19:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_pages`
--
ALTER TABLE `main_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `landing_pages`
--
ALTER TABLE `landing_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `main_pages`
--
ALTER TABLE `main_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
