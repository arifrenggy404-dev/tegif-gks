-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 04:54 PM
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
-- Database: `gereja_tegif`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_gereja`
--

CREATE TABLE `asset_gereja` (
  `id_asset` bigint(20) UNSIGNED NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` enum('layak','kurang_layak','tidak_layak') NOT NULL DEFAULT 'layak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-login:mario|127.0.0.1', 'i:1;', 1781517839),
('laravel-cache-login:mario|127.0.0.1:timer', 'i:1781517839;', 1781517839);

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
-- Table structure for table `jadwal_ibadah_minggu`
--

CREATE TABLE `jadwal_ibadah_minggu` (
  `id_ibadah` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_pelayan` bigint(20) UNSIGNED NOT NULL,
  `id_pendamping` bigint(20) UNSIGNED NOT NULL,
  `tema` varchar(255) DEFAULT NULL,
  `ayat_bacaan` varchar(255) NOT NULL,
  `nats_pembimbing` varchar(255) DEFAULT NULL,
  `ayat_firman` varchar(255) DEFAULT NULL,
  `berita_anugerah` text DEFAULT NULL,
  `petunjuk_hidup_baru` text DEFAULT NULL,
  `waktu` datetime NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kesasi`
--

CREATE TABLE `jadwal_kesasi` (
  `id_kesasi` bigint(20) UNSIGNED NOT NULL,
  `id_pengajar` bigint(20) UNSIGNED NOT NULL,
  `waktu` datetime NOT NULL,
  `materi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelayanan_pa`
--

CREATE TABLE `jadwal_pelayanan_pa` (
  `id_pelayanan_pa` bigint(20) UNSIGNED NOT NULL,
  `id_wilayah` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_penerima_pa` varchar(255) NOT NULL,
  `id_pelayan` bigint(20) UNSIGNED NOT NULL,
  `id_pendamping` bigint(20) UNSIGNED NOT NULL,
  `ayat` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_pelayanan_pa`
--

INSERT INTO `jadwal_pelayanan_pa` (`id_pelayanan_pa`, `id_wilayah`, `id_user`, `nama_penerima_pa`, `id_pelayan`, `id_pendamping`, `ayat`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mario chalvino', 1, 2, 'Matius 18:1-12', '2026-06-13 10:49:00', '2026-06-12 18:50:03', '2026-06-12 18:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `jemaat`
--

CREATE TABLE `jemaat` (
  `id_jemaat` bigint(20) UNSIGNED NOT NULL,
  `nama_jemaat` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_baptis` varchar(255) DEFAULT NULL,
  `tanggal_baptis` date DEFAULT NULL,
  `tempat_sidi` varchar(255) DEFAULT NULL,
  `tanggal_sidi` date DEFAULT NULL,
  `tempat_nikah` varchar(255) DEFAULT NULL,
  `tanggal_nikah` date DEFAULT NULL,
  `pekerjaan` enum('petani','nelayan','tukang','buruh','pns','pt','swasta','tni_polri','pensiun','lainnya') DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `status_dalam_jemaat` enum('sidi','baptis','belum_baptis','simpatisan') NOT NULL DEFAULT 'belum_baptis',
  `hubungan_keluarga` varchar(255) DEFAULT NULL,
  `pendidikan_terakhir` enum('SD','SMP','SMA','D3','S1','S2') DEFAULT NULL,
  `id_wilayah` bigint(20) UNSIGNED NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `status_jemaat` enum('aktif','tidak_aktif','pindah','meninggal') NOT NULL DEFAULT 'aktif',
  `status_pernikahan` enum('belum_menikah','menikah','duda','janda') NOT NULL DEFAULT 'belum_menikah',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jemaat`
--

INSERT INTO `jemaat` (`id_jemaat`, `nama_jemaat`, `tempat_lahir`, `tanggal_lahir`, `tempat_baptis`, `tanggal_baptis`, `tempat_sidi`, `tanggal_sidi`, `tempat_nikah`, `tanggal_nikah`, `pekerjaan`, `jenis_kelamin`, `status_dalam_jemaat`, `hubungan_keluarga`, `pendidikan_terakhir`, `id_wilayah`, `alamat`, `no_hp`, `status_jemaat`, `status_pernikahan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Mario chalvino', 'Palakalumbang', '2026-06-13', 'Kanatang', '2026-06-13', 'Kanatang', '2026-06-13', NULL, NULL, 'lainnya', 'L', 'sidi', 'Anak', 'S1', 1, 'Parunu, RT.006, RW.003 Temu, Kanatang, 87153\r\nwaingapu', '085138928216', 'aktif', 'belum_menikah', NULL, '2026-06-12 18:49:22', '2026-06-12 18:49:22'),
(2, 'Yance', 'Wgp', '2026-06-13', 'Kanatang', '2026-06-13', 'Kanatang', '2026-06-13', 'Kanatang', '2026-06-13', 'pns', 'L', 'sidi', 'Ayah', 'S1', 2, 'Kanatang', '1234456768', 'aktif', 'menikah', NULL, '2026-06-12 19:17:34', '2026-06-12 19:17:34');

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
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id_keuangan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `jenis_transaksi` enum('pemasukan','pengeluaran') NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id_keuangan`, `id_user`, `jenis_transaksi`, `tanggal_transaksi`, `total`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 3, 'pemasukan', '2026-06-15', 100000.00, 'Persembahan', '2026-06-15 02:14:25', '2026-06-15 02:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` bigint(20) UNSIGNED NOT NULL,
  `tujuan` text NOT NULL,
  `waktu_kunjungan` datetime NOT NULL,
  `id_wilayah` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2026_06_01_020400_create_wilayah_table', 1),
(5, '2026_06_01_020426_create_pelayan_table', 1),
(6, '2026_06_01_020449_create_jemaat_table', 1),
(7, '2026_06_01_020506_create_jadwal_ibadah_minggu_table', 1),
(8, '2026_06_01_020522_create_jadwal_pelayanan_pa_table', 1),
(9, '2026_06_01_020538_create_jadwal_kesasi_table', 1),
(10, '2026_06_01_020609_create_keuangan_table', 1),
(11, '2026_06_01_020624_create_kunjungan_table', 1),
(12, '2026_06_01_020637_create_wartamimbar_table', 1),
(13, '2026_06_01_020648_create_asset_gereja_table', 1),
(14, '2026_06_04_053017_add_bendahara_to_users_role_column', 1);

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
-- Table structure for table `pelayan`
--

CREATE TABLE `pelayan` (
  `id_pelayan` bigint(20) UNSIGNED NOT NULL,
  `nama_pelayan` varchar(255) NOT NULL,
  `jenis` enum('pendeta','mejelis','vikaris') NOT NULL DEFAULT 'pendeta',
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelayan`
--

INSERT INTO `pelayan` (`id_pelayan`, `nama_pelayan`, `jenis`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 'Pdt.Mario Chalvino', 'pendeta', 1, '2026-06-12 18:49:34', '2026-06-12 18:49:34'),
(2, 'vic.try', 'vikaris', 1, '2026-06-12 18:49:43', '2026-06-12 18:49:43');

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
('KSR6DUZXLICnjNKCYU35mWq2QI7ObBRp1Bv2HokV', 3, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidEFOeWRsNGNPYmRsUFNmYzBOSTVPUjVQend0V1ZFbFZ6OXIzOVlZMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9iZW5kYWhhcmEvbGFwb3JhbiI7czo1OiJyb3V0ZSI7czoyMzoiYmVuZGFoYXJhLmxhcG9yYW4uaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1781518538);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pengurus','bendahara') NOT NULL DEFAULT 'pengurus',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'admin@tegif-gks.id', '$2y$12$mZEw7dkIOQUyMZYPt96Mp.rOB.jwXHQ9UXijoUArbmUkCEiFbKXEe', 'admin', NULL, '2026-06-12 04:55:32', '2026-06-12 04:55:32'),
(2, 'Mario', 'Mario', 'alvinomario28@gmail.com', '$2y$12$Xi0MzR/r2NcueJ7vPiTv7OrUzVARA5n3FQ9IkXqzEZNRCaK/b5lwW', 'admin', NULL, '2026-06-12 04:56:08', '2026-06-12 04:56:08'),
(3, 'Alvin', 'Alvin', 'Alvin@gmail.com', '$2y$12$s16xPl24PvQvAxcJBt.BueNqoHwyq.eGK.H.CK.YMJXwGenv1fhBS', 'bendahara', NULL, '2026-06-12 15:23:11', '2026-06-12 15:23:11'),
(4, 'Mar', 'Mar', 'mar@gmail.com', '$2y$12$ifN72/CUxQTAIO9lhgKhBONoCdWOZiOZcYkBQqeMq/oQt70Dzbb7u', 'pengurus', NULL, '2026-06-12 15:24:26', '2026-06-12 15:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `wartamimbar`
--

CREATE TABLE `wartamimbar` (
  `id_wartamimbar` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_ibadah` bigint(20) UNSIGNED NOT NULL,
  `id_pelayanan_pa` bigint(20) UNSIGNED NOT NULL,
  `informasi` text NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` bigint(20) UNSIGNED NOT NULL,
  `nama_wilayah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `nama_wilayah`, `created_at`, `updated_at`) VALUES
(1, 'Taimanu', '2026-06-12 18:48:24', '2026-06-12 18:48:24'),
(2, 'Temu A 1', '2026-06-12 18:48:39', '2026-06-12 18:48:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_gereja`
--
ALTER TABLE `asset_gereja`
  ADD PRIMARY KEY (`id_asset`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_ibadah_minggu`
--
ALTER TABLE `jadwal_ibadah_minggu`
  ADD PRIMARY KEY (`id_ibadah`),
  ADD KEY `jadwal_ibadah_minggu_id_user_foreign` (`id_user`),
  ADD KEY `jadwal_ibadah_minggu_id_pelayan_foreign` (`id_pelayan`),
  ADD KEY `jadwal_ibadah_minggu_id_pendamping_foreign` (`id_pendamping`);

--
-- Indexes for table `jadwal_kesasi`
--
ALTER TABLE `jadwal_kesasi`
  ADD PRIMARY KEY (`id_kesasi`),
  ADD KEY `jadwal_kesasi_id_pengajar_foreign` (`id_pengajar`);

--
-- Indexes for table `jadwal_pelayanan_pa`
--
ALTER TABLE `jadwal_pelayanan_pa`
  ADD PRIMARY KEY (`id_pelayanan_pa`),
  ADD KEY `jadwal_pelayanan_pa_id_wilayah_foreign` (`id_wilayah`),
  ADD KEY `jadwal_pelayanan_pa_id_user_foreign` (`id_user`),
  ADD KEY `jadwal_pelayanan_pa_id_pelayan_foreign` (`id_pelayan`),
  ADD KEY `jadwal_pelayanan_pa_id_pendamping_foreign` (`id_pendamping`);

--
-- Indexes for table `jemaat`
--
ALTER TABLE `jemaat`
  ADD PRIMARY KEY (`id_jemaat`),
  ADD KEY `jemaat_id_wilayah_foreign` (`id_wilayah`);

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
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id_keuangan`),
  ADD KEY `keuangan_id_user_foreign` (`id_user`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `kunjungan_id_wilayah_foreign` (`id_wilayah`);

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
-- Indexes for table `pelayan`
--
ALTER TABLE `pelayan`
  ADD PRIMARY KEY (`id_pelayan`);

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
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wartamimbar`
--
ALTER TABLE `wartamimbar`
  ADD PRIMARY KEY (`id_wartamimbar`),
  ADD KEY `wartamimbar_id_user_foreign` (`id_user`),
  ADD KEY `wartamimbar_id_ibadah_foreign` (`id_ibadah`),
  ADD KEY `wartamimbar_id_pelayanan_pa_foreign` (`id_pelayanan_pa`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_gereja`
--
ALTER TABLE `asset_gereja`
  MODIFY `id_asset` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_ibadah_minggu`
--
ALTER TABLE `jadwal_ibadah_minggu`
  MODIFY `id_ibadah` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_kesasi`
--
ALTER TABLE `jadwal_kesasi`
  MODIFY `id_kesasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_pelayanan_pa`
--
ALTER TABLE `jadwal_pelayanan_pa`
  MODIFY `id_pelayanan_pa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jemaat`
--
ALTER TABLE `jemaat`
  MODIFY `id_jemaat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id_keuangan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pelayan`
--
ALTER TABLE `pelayan`
  MODIFY `id_pelayan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wartamimbar`
--
ALTER TABLE `wartamimbar`
  MODIFY `id_wartamimbar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_ibadah_minggu`
--
ALTER TABLE `jadwal_ibadah_minggu`
  ADD CONSTRAINT `jadwal_ibadah_minggu_id_pelayan_foreign` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan` (`id_pelayan`),
  ADD CONSTRAINT `jadwal_ibadah_minggu_id_pendamping_foreign` FOREIGN KEY (`id_pendamping`) REFERENCES `pelayan` (`id_pelayan`),
  ADD CONSTRAINT `jadwal_ibadah_minggu_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_kesasi`
--
ALTER TABLE `jadwal_kesasi`
  ADD CONSTRAINT `jadwal_kesasi_id_pengajar_foreign` FOREIGN KEY (`id_pengajar`) REFERENCES `pelayan` (`id_pelayan`);

--
-- Constraints for table `jadwal_pelayanan_pa`
--
ALTER TABLE `jadwal_pelayanan_pa`
  ADD CONSTRAINT `jadwal_pelayanan_pa_id_pelayan_foreign` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan` (`id_pelayan`),
  ADD CONSTRAINT `jadwal_pelayanan_pa_id_pendamping_foreign` FOREIGN KEY (`id_pendamping`) REFERENCES `pelayan` (`id_pelayan`),
  ADD CONSTRAINT `jadwal_pelayanan_pa_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_pelayanan_pa_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `jemaat`
--
ALTER TABLE `jemaat`
  ADD CONSTRAINT `jemaat_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE CASCADE;

--
-- Constraints for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `keuangan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `wartamimbar`
--
ALTER TABLE `wartamimbar`
  ADD CONSTRAINT `wartamimbar_id_ibadah_foreign` FOREIGN KEY (`id_ibadah`) REFERENCES `jadwal_ibadah_minggu` (`id_ibadah`),
  ADD CONSTRAINT `wartamimbar_id_pelayanan_pa_foreign` FOREIGN KEY (`id_pelayanan_pa`) REFERENCES `jadwal_pelayanan_pa` (`id_pelayanan_pa`),
  ADD CONSTRAINT `wartamimbar_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
