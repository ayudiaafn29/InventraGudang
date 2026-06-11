-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 02:56 PM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventra_gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `supplier_id`, `kode_barang`, `nama_barang`, `jenis_barang`, `created_at`, `updated_at`) VALUES
(1, 1, 'BRG0001', 'Beras Premium', 'Sembako', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(2, 1, 'BRG0002', 'Minyak Goreng', 'Sembako', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(3, 2, 'BRG0003', 'Gula Pasir', 'Sembako', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(4, 2, 'BRG0004', 'Coklat Silverqueen', 'Makanan', '2025-08-06 23:12:44', '2025-08-06 23:12:44'),
(5, 2, 'BRG0005', 'Coklat Dilan', 'Makanan', '2025-08-06 23:13:47', '2025-08-06 23:13:47'),
(6, 1, 'BRG0006', 'Tv Polytron', 'Elektronik', '2025-08-06 23:16:32', '2025-08-06 23:16:32'),
(7, 1, 'BRG0007', 'Coklat Silverqueen', 'Makanan', '2025-08-07 01:35:26', '2025-08-07 01:35:26'),
(8, 2, 'BRG0008', 'Parcetamol', 'Obat', '2025-08-07 01:51:58', '2025-08-07 01:51:58'),
(9, 2, 'BRG0009', 'Parcetamol', 'Obat', '2025-08-07 01:54:01', '2025-08-07 01:54:01'),
(10, 2, 'BRG0010', 'Chitato', 'Makanan', '2025-08-07 02:38:49', '2025-08-07 02:38:49'),
(11, 2, 'BRG0011', 'Coklat BengBeng', 'Makanan', '2025-08-07 02:42:28', '2025-08-07 02:42:28'),
(12, 2, 'BRG0012', 'Chiki Lays', 'Makanan', '2025-08-07 02:47:32', '2025-08-07 02:47:32');

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
(4, '2025_07_20_051536_create_permission_tables', 1),
(5, '2025_07_20_062309_create_suppliers_table', 1),
(6, '2025_07_20_062550_create_barangs_table', 1),
(7, '2025_07_20_062631_create_penerimaan_barangs_table', 1),
(8, '2025_07_20_084040_create_penyimpanan_barang_table', 1),
(9, '2025_07_20_095924_create_permintaan_barang_table', 1),
(10, '2025_07_20_103002_create_pengemasan_barang_table', 1),
(11, '2025_07_20_105721_create_pengiriman_barang_table', 1),
(12, '2025_07_22_102017_add_role_to_users_table', 1),
(13, '2025_07_22_102507_add_role_to_users_table', 1),
(14, '2025_07_24_083007_add_kode_barang_to_barang_table', 1),
(15, '2025_07_24_115136_drop_jumlah_barang_from_barang_table', 1),
(16, '2025_07_24_233905_add_tanggal_kadaluarsa_to_penerimaan_barang_table', 1),
(17, '2025_07_25_061231_add_petugas_id_to_penyimpanan_barang_table', 1),
(18, '2025_08_06_124115_add_tujuan_pengiriman_to_permintaan_barang_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 6);

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
-- Table structure for table `penerimaan_barang`
--

CREATE TABLE `penerimaan_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_diterima` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status_verifikasi` varchar(255) NOT NULL DEFAULT 'pending',
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerimaan_barang`
--

INSERT INTO `penerimaan_barang` (`id`, `barang_id`, `supplier_id`, `petugas_id`, `jumlah_diterima`, `tanggal_masuk`, `status_verifikasi`, `tanggal_kadaluarsa`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 1200, '2029-01-07', 'Terverifikasi', '2029-01-07', '2025-08-06 23:12:44', '2025-08-06 23:13:12'),
(7, 10, 2, 1, 1200, '2027-01-01', 'Terverifikasi', '2027-01-01', '2025-08-07 02:38:49', '2025-08-07 02:39:02'),
(8, 11, 2, 1, 1000, '2028-01-01', 'Terverifikasi', '2028-01-01', '2025-08-07 02:42:28', '2025-08-07 02:42:45'),
(9, 12, 2, 1, 1200, '2027-08-07', 'Terverifikasi', '2027-08-07', '2025-08-07 02:47:32', '2025-08-07 02:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `pengemasan_barang`
--

CREATE TABLE `pengemasan_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permintaan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_barang_dikemas` int(11) NOT NULL,
  `tujuan_pengiriman` varchar(255) NOT NULL,
  `tanggal_pengemasan` date NOT NULL,
  `status_pengemasan` varchar(255) NOT NULL DEFAULT 'proses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_barang`
--

CREATE TABLE `pengiriman_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengemasan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `status_pengiriman` varchar(255) NOT NULL DEFAULT 'pending',
  `tanggal_dikirim` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyimpanan_barang`
--

CREATE TABLE `penyimpanan_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penerimaan_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_penyimpanan` varchar(255) NOT NULL,
  `kategori_barang` varchar(255) NOT NULL,
  `kapasitas_rak` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `status_barang` varchar(255) NOT NULL DEFAULT 'Belum Tersimpan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang`
--

CREATE TABLE `permintaan_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penyimpanan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang_diminta` varchar(255) NOT NULL,
  `jumlah_barang_diminta` int(11) NOT NULL,
  `status_permintaan` varchar(255) NOT NULL DEFAULT 'pending',
  `tujuan_pengiriman` varchar(255) NOT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manager_gudang', 'web', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(2, 'petugas_penerimaan', 'web', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(3, 'petugas_penyimpanan', 'web', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(4, 'petugas_pengemasan', 'web', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(5, 'petugas_pengantar', 'web', '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(6, 'permintaan_barang', 'web', '2025-08-06 23:07:07', '2025-08-06 23:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
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
('s2Now6knILcrUNSJ7FUtHlsABSvUIxFrhoEXF92I', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2JrYnBpSmRGdkVvbDVPaDRoQ3lYQ2J6a1JwWER5ZzRhMUJERGNRRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769854836),
('stbJPpaUP37Ky3MxcPkqQMAkWH5wEmcpZNwCnHBH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiejBFTmZPVllaZkkzSmhhR2xHa2VNRWFHWXkyOHoyRllwcjFxdVVreCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5lcmltYWFuX2JhcmFuZyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1754560456);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat_supplier` varchar(255) NOT NULL,
  `kontak_supplier` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`, `alamat_supplier`, `kontak_supplier`, `created_at`, `updated_at`) VALUES
(1, 'PT. Maju Jaya', 'Jl. Merdeka No. 10', NULL, '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(2, 'CV. Sumber Rejeki', 'Jl. Sudirman No. 25', NULL, '2025-08-06 23:07:07', '2025-08-06 23:07:07');

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
  `role` enum('manager','penerimaan','penyimpanan','permintaan','pengemasan','pengiriman') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Manager Gudang', 'manager@gudang.com', NULL, '$2y$12$WtoqNxfPz6RWsi54/.EWSOCENUbmLLs96csTcXE41yJaBORTW5RUq', 'manager', NULL, '2025-08-06 23:07:07', '2025-08-06 23:07:07'),
(2, 'Petugas Penerimaan', 'penerimaan@gudang.com', NULL, '$2y$12$s9otYAfzVS.Ot9CgeTRiZeiR3g3XORi7TCsyjUHv6CbiUum8.cx5m', 'manager', NULL, '2025-08-06 23:07:08', '2025-08-06 23:07:08'),
(3, 'Petugas Penyimpanan', 'penyimpanan@gudang.com', NULL, '$2y$12$ww6Xsw/wt30YH7h0mJ49/OpCjzlWGK7EwcuvicOVmkkqSKnUWIxUi', 'manager', NULL, '2025-08-06 23:07:08', '2025-08-06 23:07:08'),
(4, 'Petugas Pengemasan', 'pengemasan@gudang.com', NULL, '$2y$12$OMouxyi9EXcDMqhJrJZ5Y.M08GUTYgHRpfBaXoLJTWy85SXqq8SwO', 'manager', NULL, '2025-08-06 23:07:08', '2025-08-06 23:07:08'),
(5, 'Petugas Pengantar', 'pengantar@gudang.com', NULL, '$2y$12$cYyeNFbAkakPm9kIpI8CEOnEnha69sfFBML6AN4GawgRFAVfaYPNu', 'manager', NULL, '2025-08-06 23:07:08', '2025-08-06 23:07:08'),
(6, 'Permintaan Barang', 'permintaan@gudang.com', NULL, '$2y$12$UGZ8XVKCQHoiQAhpuehfH.Kcwv5hL92cN4UUFHZEgxA/0/PHArusi', 'manager', NULL, '2025-08-06 23:07:09', '2025-08-06 23:07:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_kode_barang_unique` (`kode_barang`),
  ADD KEY `barang_supplier_id_foreign` (`supplier_id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penerimaan_barang_barang_id_foreign` (`barang_id`),
  ADD KEY `penerimaan_barang_supplier_id_foreign` (`supplier_id`),
  ADD KEY `penerimaan_barang_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `pengemasan_barang`
--
ALTER TABLE `pengemasan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengemasan_barang_permintaan_id_foreign` (`permintaan_id`);

--
-- Indexes for table `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengiriman_barang_pengemasan_id_foreign` (`pengemasan_id`);

--
-- Indexes for table `penyimpanan_barang`
--
ALTER TABLE `penyimpanan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyimpanan_barang_penerimaan_id_foreign` (`penerimaan_id`),
  ADD KEY `penyimpanan_barang_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_barang_penyimpanan_id_foreign` (`penyimpanan_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengemasan_barang`
--
ALTER TABLE `pengemasan_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penyimpanan_barang`
--
ALTER TABLE `penyimpanan_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD CONSTRAINT `penerimaan_barang_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penerimaan_barang_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penerimaan_barang_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengemasan_barang`
--
ALTER TABLE `pengemasan_barang`
  ADD CONSTRAINT `pengemasan_barang_permintaan_id_foreign` FOREIGN KEY (`permintaan_id`) REFERENCES `permintaan_barang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  ADD CONSTRAINT `pengiriman_barang_pengemasan_id_foreign` FOREIGN KEY (`pengemasan_id`) REFERENCES `pengemasan_barang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penyimpanan_barang`
--
ALTER TABLE `penyimpanan_barang`
  ADD CONSTRAINT `penyimpanan_barang_penerimaan_id_foreign` FOREIGN KEY (`penerimaan_id`) REFERENCES `penerimaan_barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penyimpanan_barang_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD CONSTRAINT `permintaan_barang_penyimpanan_id_foreign` FOREIGN KEY (`penyimpanan_id`) REFERENCES `penyimpanan_barang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
