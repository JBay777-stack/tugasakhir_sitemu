-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 04:03 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitemuu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` bigint UNSIGNED NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `nama_pengklaim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `item_type`, `item_id`, `nama_pengklaim`, `kontak`, `status`, `created_at`, `updated_at`, `foto_bukti`) VALUES
(1, 'found', 1, 'Tito', '+62 899-6745-353', 'approved', '2026-01-13 22:07:22', '2026-01-13 22:39:36', 'klaim/v7DhpVxaZorNsycsNx4wKZF3t6zDxjkOmerShMsC.jpg'),
(2, 'lost', 3, 'bayu', '085601111361', 'approved', '2026-01-13 23:26:14', '2026-01-13 23:27:07', 'klaim/kKTrie2SFxLL8Dv5iFNFL7dRWm0gYy0uo24yiERQ.jpg'),
(3, 'found', 2, 'Ezzar', '+62 812-3316-0442', 'approved', '2026-01-16 00:08:07', '2026-01-16 07:39:48', 'klaim/A7D0U07RgRHgenEbAdBoL7e1RLfncI2UV1YPq8SR.jpg'),
(4, 'lost', 4, 'Tito', '+62 899-6745-353', 'rejected', '2026-01-16 07:47:56', '2026-01-16 07:52:30', 'klaim/qyKrfzVlU1vxAsVH8AnKeKbuquIOE8FrQjQSUShD.jpg'),
(5, 'found', 3, 'Yusril', '+62 822-3743-0002', 'approved', '2026-01-16 07:50:46', '2026-01-16 07:51:39', 'klaim/SJcT8y0HqGY8yY3rmtQoZtJNQtFWdB5OWkxsPzQA.png'),
(6, 'lost', 6, 'RYEN', '+62 857-0609-2634', 'approved', '2026-01-18 05:42:34', '2026-01-18 05:43:02', 'klaim/LJHKuZQYWhaTvaW1AsTewrZ0qJYcm0f7Rx3t4zIv.webp'),
(7, 'found', 4, 'RYEN', '+62 857-0609-2634', 'rejected', '2026-01-18 05:49:51', '2026-01-18 05:51:51', 'klaim/LaBzltf3u2ISGMW1LHBzkEH5OgKnMJysojcmKtz0.webp'),
(8, 'found', 5, 'Ezzar', '+62 815-1539-5721', 'approved', '2026-01-18 05:50:24', '2026-01-18 05:51:57', 'klaim/BBJDJj4jVPnIIF9FcGvW4mysXMlogCtNxxVHV5V6.jpg'),
(9, 'lost', 7, 'Ezzar', '+62 815-1539-5721', 'approved', '2026-01-18 18:19:32', '2026-01-18 18:19:57', 'klaim/zGvypWKMyBrK6K4U5lf1otHLQKOaiw6zmWS6ayeQ.jpg'),
(10, 'lost', 5, 'Tito', '0856345828', 'rejected', '2026-01-18 18:52:36', '2026-01-18 18:52:47', 'klaim/QaImYcu20enBuEuI5sJc56QzoQrCyFVg6gP0GHTo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `found_items`
--

CREATE TABLE `found_items` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pelapor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `found_items`
--

INSERT INTO `found_items` (`id`, `nama_pelapor`, `kontak`, `lokasi`, `deskripsi`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ivan', '+62 895-8032-99415', 'Lab DKV 1', 'lwkxdojemfchwoi;sce;oifwf', 'found_items/E1MW8EqJ6pZNpwNpBrmGF3Z6fydHDfCoV7SDs4M7.jpg', 'selesai', '2026-01-13 21:28:04', '2026-01-13 22:39:36'),
(2, 'Gilang', '+62 816-1598-8648', 'Samping Gazebo Musholla', 'swkwkncbjd qsjl', 'found_items/WRcDGPkzDH3Fozv7DBARz8VZPwtTvo4gsMWZ7M74.webp', 'selesai', '2026-01-13 21:33:13', '2026-01-16 07:39:48'),
(3, 'Gilang', '+62 816-1598-8648', 'Samping Gazebo Musholla', 'FlashDisk Sandisk Dengan Gantungan', 'found_items/xeGFymWTQJmtSie6woZfULmjssiQZqTrE75dCgk3.jpg', 'selesai', '2026-01-16 07:44:18', '2026-01-16 07:51:39'),
(4, 'vico', '+62 858-5618-1748', 'Samping Gazebo Musholla', 'Sepatu vantovel, hanya sebelah kiri. ukuran 42 dengan kaos kaki hitam', 'found_items/nMVEib6KtobS0oGQEMdsDjCg3tpRbwW6UTwnQkUW.jpg', 'terverifikasi', '2026-01-18 05:26:14', '2026-01-18 05:27:17'),
(5, 'Rian', '+62 857-0609-2633', 'zwdxqerjn', 'fdweg5yhtgrcf3gv', 'found_items/7yFFkhGzzdY2yFrtTqUigr9I0oCMP8OTdIFtmsBT.jpg', 'selesai', '2026-01-18 05:40:51', '2026-01-18 05:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
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
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pelapor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imbalan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`id`, `nama_pelapor`, `kontak`, `nama_barang`, `deskripsi`, `foto`, `imbalan`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Ivan', '+62 895-8032-99415', 'Charger HP', 'cfrvgwrhbjdscr', 'lost_items/X1yCqyiVNM4cq6N5D5kbswz8AQXldG4LAjNEywPP.jpg', '2000', 'terverifikasi', '2026-01-13 21:34:09', '2026-01-13 21:44:43'),
(3, 'Bu Supri', '+62 895-8032-99415', 'Charger HP', 'Lab Com', 'lost_items/v1gpvIQ54t70A9IKYcq54pfh8Mxl0lcKK6iBpamA.jpg', NULL, 'selesai', '2026-01-13 23:24:26', '2026-01-13 23:27:07'),
(4, 'Reja', '+62 858-1599-7598', 'Sepatu', 'Sepatu di Musholla', 'lost_items/fBun8XN2LpAemWvdK6zoES5tS109n5NsTNbSvSfH.jpg', '5000', 'terverifikasi', '2026-01-16 07:43:00', '2026-01-16 07:44:41'),
(5, 'Putri', '+62 858-1205-9496', 'Flasdisk Sandisk', 'Flashdisk warna merah dengan gantungan kunci, terakhir di lab dkv 1', 'lost_items/Z8hcIVJIFS91aDO6ZyEqt13xJTlBmKLcwieu81NL.webp', '5000', 'terverifikasi', '2026-01-18 05:23:51', '2026-01-18 05:27:03'),
(6, 'Habib', '+62 857-5575-6389', 'Charger HP', 'xdqeegcewge45hveftrgv', 'lost_items/w5971QMK0LCuK8iOrVGrbrZlFmhRdUtWGEe5jF7F.jpg', NULL, 'selesai', '2026-01-18 05:28:35', '2026-01-18 05:43:02'),
(7, 'RYan', '+62 857-0609-2634', 'xcesvdtnm', 'cgbjutrycegxdvh', 'lost_items/bLKT0vQRltx2K5l1bActeRpHvn2nXLbAYpjMSodx.jpg', '8000', 'selesai', '2026-01-18 05:40:10', '2026-01-18 18:19:57');

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
(4, '2025_12_30_035000_create_lost_items_table', 1),
(5, '2025_12_30_054119_create_found_items_table', 1),
(6, '2026_01_01_122054_create_claims_table', 1),
(7, '2026_01_02_071002_add_foto_bukti_to_claims_table', 1);

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
('tXBa0IEP8cj79cIPu46fEHghUegQRG2FfKjwTDGd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkRtaVpUNGZYOUlCTGFDa2JwVUxnU0ZVTG81aTNTdHhRMHFKbXp4dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9rbGFpbS8zL2V4cG9ydC1wZGYiO3M6NToicm91dGUiO3M6MjI6ImFkbWluLmtsYWltLmV4cG9ydC1wZGYiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1768792481);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@sitemu.test', NULL, '$2y$12$k2YtmygXVHJR1SQU4jxDdeIz97f.50h1atwH1/NLgyQ48w2om0edm', NULL, '2026-01-13 21:26:13', '2026-01-13 21:26:13');

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
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `found_items`
--
ALTER TABLE `found_items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `found_items`
--
ALTER TABLE `found_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
