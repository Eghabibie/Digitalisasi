-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2025 at 04:09 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_digitalisasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `alats`
--

CREATE TABLE `alats` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `merek` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_pengadaan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alats`
--

INSERT INTO `alats` (`id`, `nama`, `images`, `volume`, `kondisi`, `stok`, `merek`, `tahun_pengadaan`, `created_at`, `updated_at`) VALUES
(3, 'wdadw', '[\"alat-images\\/01K2FE2X7PKXSVCBT738CE47W8.png\"]', 'fesffs', 'Rusak Ringan', 4, '-', '-', '2025-08-06 03:36:07', '2025-08-15 08:34:39'),
(4, 'AE 86 TUreno', '[\"alat-images\\/01K2FE5X71VEK55PDKQHKEVTXB.png\"]', '250ml', 'Baik', 5, 'TOYOTA', '1985', '2025-08-07 19:20:12', '2025-08-12 08:25:30'),
(5, 'blue eyes white dragon', '[\"alat-images\\/01K2FE6FGDHYQE7D7GSNKSY1ES.png\"]', '250ml', 'Rusak Berat', 5, 'Yu-Gi-Oh!', '1996', '2025-08-07 19:23:36', '2025-08-12 08:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_cairan_lamas`
--

CREATE TABLE `bahan_cairan_lamas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rumus_kimia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sisa_bahan` decimal(8,2) DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_cas` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemilik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_pengadaan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merek` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_cairan_lamas`
--

INSERT INTO `bahan_cairan_lamas` (`id`, `nama`, `rumus_kimia`, `sisa_bahan`, `unit`, `nomor_cas`, `letak`, `pemilik`, `tahun_pengadaan`, `expired`, `merek`, `created_at`, `updated_at`) VALUES
(79, 'Asam Sulfat', 'H2SO4', '1250.00', 'ml', '7664-93-9', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'Asam Klorida', 'HCL', '800.00', 'ml', '7647-01-0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Asam Nitrat', 'HNO3', '400.00', 'ml', '7697-37-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'Asam Asetat', 'CH3COOH', '400.00', 'ml', '64-19-7', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'Asam Formiat', 'CH2O2', '200.00', 'ml', '64-18-6', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-12 04:18:55'),
(84, 'Ammonia', 'NH3', '100.00', 'mL', '7664-41-7', '-', '-', '2020', '2025-08-30', '-', NULL, '2025-08-07 18:16:24'),
(85, 'Ammonium Hidroksida', 'NH4OH', '400.00', 'ml', '1336-21-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'Aseton', 'C3H6O', '250.00', 'ml', '67-64-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'Butanol', 'C4H10O', '500.00', 'ml', '71-36-3', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'Benzil Alkohol', 'C7H8O', '500.00', 'ml', '100-51-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'Benedit', '', '0.00', 'ml', '63126-89-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'Diklorometana', 'CH2CL2', '0.00', 'ml', '200-838-9', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'Etanol', 'C2H6O', '0.00', 'ml', '64-17-5', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'Etil Asetat', 'C4H8O2', '0.00', 'ml', '141-78-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'Fehling A', 'CUH2O4S', '0.00', 'ml', '7758-98-7', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'Fehling B', 'CUS04', '0.00', 'ml', '6381-59-5', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'Formaldehid', 'CH2O', '1000.00', 'ml', '50-00-0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'Gliserol', 'C3H8O3', '1000.00', 'ml', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'Hidrogen Peroxide', 'H2O2', '500.00', 'ml', '7722-84-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'Iodium', 'I2', '0.00', 'ml', '7553-56-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'Kloroform', 'CHCL2', '300.00', 'ml', '67-66-3', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Metanol', 'CH3OH', '900.00', 'ml', '67-56-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'Natrium hipoklorida', 'NaCIO', '1000.00', 'ml', '7681-52-9', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'N-heksana', 'C6H14', '500.00', 'ml', '110-54-3', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'p- xilena', 'C8H10', '500.00', 'ml', '95-47-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'spiritus', 'CH3OH', '200.00', 'ml', '', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-11 06:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_padats`
--

CREATE TABLE `bahan_padats` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rumus_kimia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sisa_bahan` decimal(8,2) DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_cas` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemilik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_pengadaan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merek` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_padats`
--

INSERT INTO `bahan_padats` (`id`, `nama`, `rumus_kimia`, `sisa_bahan`, `unit`, `nomor_cas`, `letak`, `pemilik`, `tahun_pengadaan`, `expired`, `merek`, `created_at`, `updated_at`) VALUES
(2, 'Amonium Klorida', 'NH4Cl', '800.00', 'g', '7664-93-9', 'adwad', '-', '2200', '2025-07-16', 'wadwad', '2025-08-07 18:08:03', '2025-08-15 08:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1755012388),
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1755012388;', 1755012388),
('laravel_cache_5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1755271932),
('laravel_cache_5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1755271932;', 1755271932),
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1755271939),
('laravel_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1755271939;', 1755271939);

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
(4, '2025_05_26_012157_create_bahan_cairan_lamas_table', 1),
(5, '2025_06_01_111551_create_bahan_padats_table', 1),
(6, '2025_06_11_020345_create_alats_table', 1),
(7, '2025_07_01_072816_add_images_column_to_alats_table', 1),
(8, '2025_07_08_160049_create_peminjamen_table', 1),
(9, '2025_07_13_124325_add_stok_column_to_alats_table', 1),
(10, '2025_07_13_132452_add_unit_column_to_bahan_padats_table', 1),
(11, '2025_07_13_140554_add_unit_column_to_bahan_cairs_table', 1),
(13, '2025_07_13_161439_reorder_columns_in_bahan_padats_table', 2),
(14, '2025_07_13_161612_reorder_columns_in_bahan_cairan_lamas_table', 2),
(15, '2025_07_14_054714_add_no_hp_to_peminjamans_table', 2),
(16, '2025_07_14_082546_remove_jumlah_column_from_alats_table', 2),
(17, '2025_08_12_143029_create_surat_bebas_labs_table', 3);

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
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peminjamable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peminjamable_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('Menunggu Persetujuan','Disetujui','Ditolak','Dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Persetujuan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `nama_peminjam`, `nim_peminjam`, `no_hp`, `peminjamable_type`, `peminjamable_id`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_at`, `updated_at`) VALUES
(20, 'egi disa habibie', '12312321', '08122415151', 'App\\Models\\Alat', 4, 1, '2025-08-12', '2025-08-12', 'Dikembalikan', '2025-08-12 06:16:42', '2025-08-12 06:35:08'),
(21, 'egi disa habibie', '12312321', '08122415151', 'App\\Models\\Alat', 5, 2, NULL, NULL, 'Ditolak', '2025-08-12 08:26:28', '2025-08-12 08:27:01'),
(22, 'egi disa habibie', '12312321', '08122415151', 'App\\Models\\Alat', 3, 1, '2025-08-15', '2025-08-15', 'Dikembalikan', '2025-08-15 08:31:13', '2025-08-15 08:34:39'),
(23, 'egi disa habibie', '12312321', '08122415151', 'App\\Models\\BahanPadat', 2, 400, '2025-08-15', '2025-08-15', 'Dikembalikan', '2025-08-15 08:31:14', '2025-08-15 08:34:43');

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
('BdZAEIpORVywrndUTB1SVtZV2ONT8QL901xNvBcW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkFiYlJBVFZha3F0MVlCWWtTSFdYNHR2U25sQVZIdUtLSmcycnlWSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755176517),
('ImChC6nisz4Skfzh5Z1yEHhik0CZzg2ETldOC5DH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiTEx5dHg0RXJacWtRcHpqcjVlQ052WVZocUVwejZnRk9mZksyZ21QMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIka3VwVmY2LlN3MHBTVFh3VlQxQ0oxZTVBelp6Mi8wZjlWR2JDWWFpLy5DQkpFRFk3VjdkLnEiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1755012425),
('S9ACFisunK79FgyN2VLt6W2tLUXIIV8GWHTRrK3z', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRFByZmliSVVKaWtkOWNCV3Y2aE55Z0RYMDZOUmRtRERWNVFGRkYyQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIka3VwVmY2LlN3MHBTVFh3VlQxQ0oxZTVBelp6Mi8wZjlWR2JDWWFpLy5DQkpFRFk3VjdkLnEiO30=', 1755274157);

-- --------------------------------------------------------

--
-- Table structure for table `surat_bebas_labs`
--

CREATE TABLE `surat_bebas_labs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'admin', 'admin@admin.com', NULL, '$2y$12$kupVf6.Sw0pSTXwVT1CJ1e5AzZz2/0f9VGbCYai/.CBJEDY7V7d.q', NULL, '2025-08-05 19:35:39', '2025-08-05 19:35:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alats`
--
ALTER TABLE `alats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan_cairan_lamas`
--
ALTER TABLE `bahan_cairan_lamas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan_padats`
--
ALTER TABLE `bahan_padats`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_peminjamable_type_peminjamable_id_index` (`peminjamable_type`,`peminjamable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `surat_bebas_labs`
--
ALTER TABLE `surat_bebas_labs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `alats`
--
ALTER TABLE `alats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bahan_cairan_lamas`
--
ALTER TABLE `bahan_cairan_lamas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `bahan_padats`
--
ALTER TABLE `bahan_padats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `surat_bebas_labs`
--
ALTER TABLE `surat_bebas_labs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
