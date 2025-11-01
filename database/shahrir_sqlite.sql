--
-- Converted from MySQL to SQLite3 for Laravel
--

--
-- Table structure for table `cache`
--
CREATE TABLE "cache" (
  "key" varchar(255) NOT NULL,
  "value" TEXT NOT NULL,
  "expiration" INTEGER NOT NULL,
  PRIMARY KEY ("key")
);

--
-- Table structure for table `cache_locks`
--
CREATE TABLE "cache_locks" (
  "key" varchar(255) NOT NULL,
  "owner" varchar(255) NOT NULL,
  "expiration" INTEGER NOT NULL,
  PRIMARY KEY ("key")
);

--
-- Table structure for table `failed_jobs`
--
CREATE TABLE "failed_jobs" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "uuid" varchar(255) NOT NULL UNIQUE,
  "connection" TEXT NOT NULL,
  "queue" TEXT NOT NULL,
  "payload" TEXT NOT NULL,
  "exception" TEXT NOT NULL,
  "failed_at" datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Table structure for table `jobs`
--
CREATE TABLE "jobs" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "queue" varchar(255) NOT NULL,
  "payload" TEXT NOT NULL,
  "attempts" INTEGER NOT NULL,
  "reserved_at" INTEGER DEFAULT NULL,
  "available_at" INTEGER NOT NULL,
  "created_at" INTEGER NOT NULL
);

--
-- Dumping data for table `jobs`
--
INSERT INTO "jobs" ("id", "queue", "payload", "attempts", "reserved_at", "available_at", "created_at") VALUES
(1, 'default', '{"uuid":"20b425b8-0c5f-4529-994e-b9a55f9c96d5","displayName":"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob","command":"O:58:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\":6:{s:14:\"\u0000*\u0000conversions\";O:52:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\ConversionCollection\":2:{s:8:\"\u0000*\u0000items\";a:1:{i:0;O:42:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Conversion\":11:{s:12:\"\u0000*\u0000fileNamer\";O:54:\"Spatie\\\\MediaLibrary\\\\Support\\\\FileNamer\\\\DefaultFileNamer\":0:{}s:28:\"\u0000*\u0000extractVideoFrameAtSecond\";d:0;s:16:\"\u0000*\u0000manipulations\";O:45:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Manipulations\":1:{s:16:\"\u0000*\u0000manipulations\";a:5:{s:8:\"optimize\";a:1:{i:0;O:36:\"Spatie\\\\ImageOptimizer\\\\OptimizerChain\":3:{s:13:\"\u0000*\u0000optimizers\";a:7:{i:0;O:42:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Jpegoptim\":5:{s:7:\"options\";a:4:{i:0;s:4:\"-m85\";i:1;s:7:\"--force\";i:2;s:11:\"--strip-all\";i:3;s:17:\"--all-progressive\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:9:\"jpegoptim\";}i:1;O:41:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Pngquant\":5:{s:7:\"options\";a:1:{i:0;s:7:\"--force\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:8:\"pngquant\";}i:2;O:40:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Optipng\":5:{s:7:\"options\";a:3:{i:0;s:3:\"-i0\";i:1;s:3:\"-o2\";i:2;s:6:\"-quiet\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:7:\"optipng\";}i:3;O:37:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Svgo\":5:{s:7:\"options\";a:1:{i:0;s:20:\"--disable=cleanupIDs\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:4:\"svgo\";}i:4;O:41:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Gifsicle\":5:{s:7:\"options\";a:2:{i:0;s:2:\"-b\";i:1;s:3:\"-O3\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:8:\"gifsicle\";}i:5;O:38:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Cwebp\":5:{s:7:\"options\";a:4:{i:0;s:4:\"-m 6\";i:1;s:8:\"-pass 10\";i:2;s:3:\"-mt\";i:3;s:5:\"-q 90\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:5:\"cwebp\";}i:6;O:40:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Avifenc\":6:{s:7:\"options\";a:8:{i:0;s:14:\"-a cq-level=23\";i:1;s:6:\"-j all\";i:2;s:7:\"--min 0\";i:3;s:8:\"--max 63\";i:4;s:12:\"--minalpha 0\";i:5;s:13:\"--maxalpha 63\";i:6;s:14:\"-a end-usage=q\";i:7;s:12:\"-a tune=ssim\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:7:\"avifenc\";s:16:\"decodeBinaryName\";s:7:\"avifdec\";}}s:9:\"\u0000*\u0000logger\";O:33:\"Spatie\\\\ImageOptimizer\\\\DummyLogger\":0:{}s:10:\"\u0000*\u0000timeout\";i:60;}}s:6:\"format\";a:1:{i:0;s:3:\"jpg\";}s:5:\"width\";a:1:{i:0;i:800;}s:6:\"height\";a:1:{i:0;i:600;}s:7:\"sharpen\";a:1:{i:0;i:10;}}}s:23:\"\u0000*\u0000performOnCollections\";a:0:{}s:17:\"\u0000*\u0000performOnQueue\";b:1;s:26:\"\u0000*\u0000keepOriginalImageFormat\";b:0;s:27:\"\u0000*\u0000generateResponsiveImages\";b:0;s:18:\"\u0000*\u0000widthCalculator\";N;s:24:\"\u0000*\u0000loadingAttributeValue\";N;s:16:\"\u0000*\u0000pdfPageNumber\";i:1;s:7:\"\u0000*\u0000name\";s:16:\"main-page-medium\";}}s:28:\"\u0000*\u0000escapeWhenCastingToString\";b:0;}s:8:\"\u0000*\u0000media\";O:45:\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\":5:{s:5:\"class\";s:49:\"Spatie\\\\MediaLibrary\\\\MediaCollections\\\\Models\\\\Media\";s:2:\"id\";i:1;s:9:\"relations\";a:0:{}s:10:\"connection\";s:5:\"mysql\";s:15:\"collectionClass\";N;}s:14:\"\u0000*\u0000onlyMissing\";b:0;s:10:\"connection\";s:8:\"database\";s:5:\"queue\";s:0:\"\";s:11:\"afterCommit\";b:1;}\"}', 0, NULL, 1760440967, 1760440967),
(2, 'default', '{"uuid":"57de967f-ef77-4cf5-b0f0-9a85097c432f","displayName":"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob","command":"O:58:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Jobs\\\\PerformConversionsJob\":6:{s:14:\"\u0000*\u0000conversions\";O:52:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\ConversionCollection\":2:{s:8:\"\u0000*\u0000items\";a:1:{i:0;O:42:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Conversion\":11:{s:12:\"\u0000*\u0000fileNamer\";O:54:\"Spatie\\\\MediaLibrary\\\\Support\\\\FileNamer\\\\DefaultFileNamer\":0:{}s:28:\"\u0000*\u0000extractVideoFrameAtSecond\";d:0;s:16:\"\u0000*\u0000manipulations\";O:45:\"Spatie\\\\MediaLibrary\\\\Conversions\\\\Manipulations\":1:{s:16:\"\u0000*\u0000manipulations\";a:5:{s:8:\"optimize\";a:1:{i:0;O:36:\"Spatie\\\\ImageOptimizer\\\\OptimizerChain\":3:{s:13:\"\u0000*\u0000optimizers\";a:7:{i:0;O:42:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Jpegoptim\":5:{s:7:\"options\";a:4:{i:0;s:4:\"-m85\";i:1;s:7:\"--force\";i:2;s:11:\"--strip-all\";i:3;s:17:\"--all-progressive\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:9:\"jpegoptim\";}i:1;O:41:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Pngquant\":5:{s:7:\"options\";a:1:{i:0;s:7:\"--force\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:8:\"pngquant\";}i:2;O:40:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Optipng\":5:{s:7:\"options\";a:3:{i:0;s:3:\"-i0\";i:1;s:3:\"-o2\";i:2;s:6:\"-quiet\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:7:\"optipng\";}i:3;O:37:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Svgo\":5:{s:7:\"options\";a:1:{i:0;s:20:\"--disable=cleanupIDs\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:4:\"svgo\";}i:4;O:41:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Gifsicle\":5:{s:7:\"options\";a:2:{i:0;s:2:\"-b\";i:1;s:3:\"-O3\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:8:\"gifsicle\";}i:5;O:38:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Cwebp\":5:{s:7:\"options\";a:4:{i:0;s:4:\"-m 6\";i:1;s:8:\"-pass 10\";i:2;s:3:\"-mt\";i:3;s:5:\"-q 90\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:5:\"cwebp\";}i:6;O:40:\"Spatie\\\\ImageOptimizer\\\\Optimizers\\\\Avifenc\":6:{s:7:\"options\";a:8:{i:0;s:14:\"-a cq-level=23\";i:1;s:6:\"-j all\";i:2;s:7:\"--min 0\";i:3;s:8:\"--max 63\";i:4;s:12:\"--minalpha 0\";i:5;s:13:\"--maxalpha 63\";i:6;s:14:\"-a end-usage=q\";i:7;s:12:\"-a tune=ssim\";}s:9:\"imagePath\";s:0:\"\";s:10:\"binaryPath\";s:0:\"\";s:7:\"tmpPath\";N;s:10:\"binaryName\";s:7:\"avifenc\";s:16:\"decodeBinaryName\";s:7:\"avifdec\";}}s:9:\"\u0000*\u0000logger\";O:33:\"Spatie\\\\ImageOptimizer\\\\DummyLogger\":0:{}s:10:\"\u0000*\u0000timeout\";i:60;}}s:6:\"format\";a:1:{i:0;s:3:\"jpg\";}s:5:\"width\";a:1:{i:0;i:800;}s:6:\"height\";a:1:{i:0;i:600;}s:7:\"sharpen\";a:1:{i:0;i:10;}}}s:23:\"\u0000*\u0000performOnCollections\";a:0:{}s:17:\"\u0000*\u0000performOnQueue\";b:1;s:26:\"\u0000*\u0000keepOriginalImageFormat\";b:0;s:27:\"\u0000*\u0000generateResponsiveImages\";b:0;s:18:\"\u0000*\u0000widthCalculator\";N;s:24:\"\u0000*\u0000loadingAttributeValue\";N;s:16:\"\u0000*\u0000pdfPageNumber\";i:1;s:7:\"\u0000*\u0000name\";s:16:\"main-page-medium\";}}s:28:\"\u0000*\u0000escapeWhenCastingToString\";b:0;}s:8:\"\u0000*\u0000media\";O:45:\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\":5:{s:5:\"class\";s:49:\"Spatie\\\\MediaLibrary\\\\MediaCollections\\\\Models\\\\Media\";s:2:\"id\";i:2;s:9:\"relations\";a:0:{}s:10:\"connection\";s:5:\"mysql\";s:15:\"collectionClass\";N;}s:14:\"\u0000*\u0000onlyMissing\";b:0;s:10:\"connection\";s:8:\"database\";s:5:\"queue\";s:0:\"\";s:11:\"afterCommit\";b:1;}\"}', 0, NULL, 1760441058, 1760441058);

--
-- Table structure for table `job_batches`
--
CREATE TABLE "job_batches" (
  "id" varchar(255) NOT NULL,
  "name" varchar(255) NOT NULL,
  "total_jobs" INTEGER NOT NULL,
  "pending_jobs" INTEGER NOT NULL,
  "failed_jobs" INTEGER NOT NULL,
  "failed_job_ids" TEXT NOT NULL,
  "options" TEXT DEFAULT NULL,
  "cancelled_at" INTEGER DEFAULT NULL,
  "created_at" INTEGER NOT NULL,
  "finished_at" INTEGER DEFAULT NULL,
  PRIMARY KEY ("id")
);

--
-- Table structure for table `landing_pages`
--
CREATE TABLE "landing_pages" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "image" varchar(255) DEFAULT NULL,
  "created_at" datetime DEFAULT NULL,
  "updated_at" datetime DEFAULT NULL
);

--
-- Dumping data for table `landing_pages`
--
INSERT INTO "landing_pages" ("id", "image", "created_at", "updated_at") VALUES
(1, NULL, '2025-10-14 05:22:47', '2025-10-14 05:22:47');

--
-- Table structure for table `main_pages`
--
CREATE TABLE "main_pages" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "banner_text" TEXT NOT NULL,
  "moto" TEXT NOT NULL,
  "experience" INTEGER NOT NULL DEFAULT 11,
  "projects" INTEGER NOT NULL DEFAULT 10,
  "certification" INTEGER NOT NULL DEFAULT 6,
  "article" INTEGER NOT NULL DEFAULT 1,
  "books" INTEGER NOT NULL DEFAULT 1,
  "mentoring" INTEGER NOT NULL DEFAULT 1,
  "created_at" datetime DEFAULT NULL,
  "updated_at" datetime DEFAULT NULL
);

--
-- Dumping data for table `main_pages`
--
INSERT INTO "main_pages" ("id", "banner_text", "moto", "experience", "projects", "certification", "article", "books", "mentoring", "created_at", "updated_at") VALUES
(1, 'Embrace the extraordinary.<br/>Live your fullest life.', 'Connecting brands & people through experiences.', 11, 10, 6, 3, 1, 15, '2025-10-14 05:22:16', '2025-10-14 05:22:16');

--
-- Table structure for table `media`
--
CREATE TABLE "media" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "model_type" varchar(255) NOT NULL,
  "model_id" INTEGER NOT NULL,
  "uuid" char(36) UNIQUE DEFAULT NULL,
  "collection_name" varchar(255) NOT NULL,
  "name" varchar(255) NOT NULL,
  "file_name" varchar(255) NOT NULL,
  "mime_type" varchar(255) DEFAULT NULL,
  "disk" varchar(255) NOT NULL,
  "conversions_disk" varchar(255) DEFAULT NULL,
  "size" INTEGER NOT NULL,
  "manipulations" TEXT NOT NULL,
  "custom_properties" TEXT NOT NULL,
  "generated_conversions" TEXT NOT NULL,
  "responsive_images" TEXT NOT NULL,
  "order_column" INTEGER DEFAULT NULL,
  "created_at" datetime DEFAULT NULL,
  "updated_at" datetime DEFAULT NULL
);

--
-- Dumping data for table `media`
--
INSERT INTO "media" ("id", "model_type", "model_id", "uuid", "collection_name", "name", "file_name", "mime_type", "disk", "conversions_disk", "size", "manipulations", "custom_properties", "generated_conversions", "responsive_images", "order_column", "created_at", "updated_at") VALUES
(2, 'App\\Models\\LandingPage', 1, 'cc4a9bba-bb91-4eec-932a-5e554c5b4fe1', 'images', 'WhatsApp Image 2025-10-12 at 11.09.36 AM', '1760441058.jpeg', 'image/jpeg', 'public', 'public', 189937, '[]', '{"optimized":true}', '[]', '[]', 1, '2025-10-14 05:24:18', '2025-10-14 05:24:18');

--
-- Table structure for table `migrations`
--
CREATE TABLE "migrations" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "migration" varchar(255) NOT NULL,
  "batch" INTEGER NOT NULL
);

--
-- Dumping data for table `migrations`
--
INSERT INTO "migrations" ("id", "migration", "batch") VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_14_094859_create_main_pages_table', 1),
(5, '2025_10_14_101530_create_media_table', 1),
(6, '2025_10_14_110507_create_landing_pages_table', 1);

--
-- Table structure for table `password_reset_tokens`
--
CREATE TABLE "password_reset_tokens" (
  "email" varchar(255) PRIMARY KEY,
  "token" varchar(255) NOT NULL,
  "created_at" datetime DEFAULT NULL
);

--
-- Table structure for table `sessions`
--
CREATE TABLE "sessions" (
  "id" varchar(255) PRIMARY KEY,
  "user_id" INTEGER DEFAULT NULL,
  "ip_address" varchar(45) DEFAULT NULL,
  "user_agent" TEXT DEFAULT NULL,
  "payload" TEXT NOT NULL,
  "last_activity" INTEGER NOT NULL
);

--
-- Dumping data for table `sessions`
--
INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES
('dPDkxUArMMIQB7g4CGGnzwSV62cMUyeY7OJ1TVcW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWDNobmFHT3lnT3huNVJ5M09CcnlhTXRTeWpCQnN4bFk0OHliRTR6ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZS9sYW5kaW5nLXBhZ2UiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjI6IlBIUERFQlVHQkFSX1NUQUNLX0RBVEEiO2E6MDp7fX0=', 1760441689);

--
-- Table structure for table `users`
--
CREATE TABLE "users" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT,
  "name" varchar(255) NOT NULL,
  "email" varchar(255) NOT NULL UNIQUE,
  "email_verified_at" datetime DEFAULT NULL,
  "password" varchar(255) NOT NULL,
  "remember_token" varchar(100) DEFAULT NULL,
  "created_at" datetime DEFAULT NULL,
  "updated_at" datetime DEFAULT NULL
);

--
-- Dumping data for table `users`
--
INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at") VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, '$2y$12$RQ1NnKUSF3CFun1UxCIqGeXOQWS/WdFZ5u2KjoqKUujYHZA6KUmEa', NULL, '2025-10-14 05:19:23', '2025-10-14 05:19:23');

--
-- Indexes (Added directly to CREATE TABLE or defined as separate UNIQUE)
--
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" ON "failed_jobs" ("uuid");
CREATE INDEX "jobs_queue_index" ON "jobs" ("queue");
CREATE UNIQUE INDEX "media_uuid_unique" ON "media" ("uuid");
CREATE INDEX "media_model_type_model_id_index" ON "media" ("model_type", "model_id");
CREATE INDEX "media_order_column_index" ON "media" ("order_column");
CREATE INDEX "sessions_user_id_index" ON "sessions" ("user_id");
CREATE INDEX "sessions_last_activity_index" ON "sessions" ("last_activity");
