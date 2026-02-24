-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2026 at 04:42 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parkir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_area_parkir`
--

CREATE TABLE `tb_area_parkir` (
  `id_area` int NOT NULL,
  `nama_area` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kapasitas` int NOT NULL,
  `terisi` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(1, 'Lantai 1 (Mobil)', 50, 2),
(2, 'Lantai 2 (Motor)', 100, 1),
(3, 'Basement (Truk/Bus)', 20, 2),
(4, 'Basemet 2 (Elf)', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int NOT NULL,
  `plat_nomor` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kendaraan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `warna` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pemilik` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `warna`, `pemilik`, `id_user`) VALUES
(1, 'J 7237 HUI', 'Mobil', 'Hitam', 'Administrator', 1),
(2, 'G 2737 AW', 'Motor', 'Putih', 'Administrator', 1),
(4, 'Q 7283 YTE', 'Mobil', 'Merah', 'Administrator', 1),
(5, 'Y 8294 YAW', 'Mobil', 'Putih', 'Administrator', 1),
(6, 'F 8349 UFI', 'Mobil', 'Hijau', 'Administrator', 1),
(7, 'D 2020 UFI', 'Truk/Bus', 'Merah', 'Administrator', 1),
(8, 'H 8488 YAW', 'Mobil', 'Hitam', 'Administrator', 1),
(9, 'F 7485 KAU', 'Truk/Bus', 'Hitam', 'Administrator', 1),
(10, 'H 6384 UYA', 'Truk/Bus', 'Ungu', 'Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int NOT NULL,
  `id_user` int NOT NULL,
  `aktivitas` text COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_aktivitas` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu_aktivitas`) VALUES
(1, 1, 'Login ke sistem', '2026-02-23 17:06:48'),
(2, 1, 'Logout dari sistem', '2026-02-23 17:12:55'),
(3, 2, 'Login ke sistem', '2026-02-23 17:13:03'),
(4, 2, 'Logout dari sistem', '2026-02-23 17:13:13'),
(5, 1, 'Login ke sistem', '2026-02-23 17:13:18'),
(6, 1, 'Logout dari sistem', '2026-02-23 17:14:03'),
(7, 2, 'Login ke sistem', '2026-02-23 17:14:11'),
(8, 2, 'Logout dari sistem', '2026-02-23 17:14:38'),
(9, 3, 'Login ke sistem', '2026-02-23 17:14:44'),
(10, 3, 'Logout dari sistem', '2026-02-23 17:20:33'),
(11, 2, 'Login ke sistem', '2026-02-23 17:20:47'),
(12, 2, 'Logout dari sistem', '2026-02-23 17:21:12'),
(13, 1, 'Login ke sistem', '2026-02-23 17:21:17'),
(14, 1, 'Logout dari sistem', '2026-02-23 17:36:19'),
(15, 3, 'Login ke sistem', '2026-02-23 17:36:26'),
(16, 3, 'Logout dari sistem', '2026-02-23 17:51:09'),
(17, 2, 'Login ke sistem', '2026-02-23 17:51:21'),
(18, 2, 'Logout dari sistem', '2026-02-23 17:53:57'),
(19, 1, 'Login ke sistem', '2026-02-23 17:54:04'),
(20, 1, 'Logout dari sistem', '2026-02-23 18:09:06'),
(21, 2, 'Login ke sistem', '2026-02-23 18:09:13'),
(22, 2, 'Logout dari sistem', '2026-02-23 18:17:26'),
(23, 1, 'Login ke sistem', '2026-02-23 18:17:32'),
(24, 1, 'Logout dari sistem', '2026-02-23 18:18:06'),
(25, 2, 'Login ke sistem', '2026-02-23 18:18:15'),
(26, 2, 'Logout dari sistem', '2026-02-23 18:57:19'),
(27, 1, 'Login ke sistem', '2026-02-23 18:57:36'),
(28, 1, 'Logout dari sistem', '2026-02-23 18:58:39'),
(29, 2, 'Login ke sistem', '2026-02-23 18:58:45'),
(30, 2, 'Logout dari sistem', '2026-02-23 19:05:14'),
(31, 1, 'Login ke sistem', '2026-02-23 19:05:19'),
(32, 1, 'Logout dari sistem', '2026-02-23 19:05:51'),
(33, 2, 'Login ke sistem', '2026-02-23 19:05:59'),
(34, 2, 'Login ke sistem', '2026-02-23 19:12:25'),
(35, 2, 'Logout dari sistem', '2026-02-23 19:12:44'),
(36, 1, 'Login ke sistem', '2026-02-23 19:12:49'),
(37, 1, 'Logout dari sistem', '2026-02-23 19:14:57'),
(38, 2, 'Login ke sistem', '2026-02-23 19:23:03'),
(39, 2, 'Logout dari sistem', '2026-02-23 19:23:22'),
(40, 3, 'Login ke sistem', '2026-02-23 19:23:32'),
(41, 3, 'Logout dari sistem', '2026-02-23 19:24:36'),
(42, 1, 'Login ke sistem', '2026-02-23 19:24:43'),
(43, 1, 'Logout dari sistem', '2026-02-23 19:33:25'),
(44, 2, 'Login ke sistem', '2026-02-23 19:33:32'),
(45, 2, 'Logout dari sistem', '2026-02-23 19:45:18'),
(46, 3, 'Login ke sistem', '2026-02-23 19:45:25'),
(47, 3, 'Logout dari sistem', '2026-02-23 19:45:47'),
(48, 2, 'Login ke sistem', '2026-02-23 19:46:02'),
(49, 1, 'Login ke sistem', '2026-02-24 11:34:13'),
(50, 1, 'Login ke sistem', '2026-02-24 11:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int NOT NULL,
  `jenis_kendaraan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tarif_per_jam` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`) VALUES
(1, 'motor', 3000),
(2, 'mobil', 3000),
(3, 'truk/bus', 5000),
(5, 'Elf', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int NOT NULL,
  `id_kendaraan` int NOT NULL,
  `id_area` int NOT NULL,
  `waktu_masuk` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_keluar` datetime DEFAULT NULL,
  `biaya_total` int DEFAULT '0',
  `metode_bayar` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'Tunai',
  `status` enum('masuk','keluar') COLLATE utf8mb4_general_ci DEFAULT 'masuk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `id_kendaraan`, `id_area`, `waktu_masuk`, `waktu_keluar`, `biaya_total`, `metode_bayar`, `status`) VALUES
(1, 6, 1, '2026-02-23 17:13:22', '2026-02-23 17:21:04', 3000, 'DEBIT', 'keluar'),
(2, 5, 1, '2026-02-23 17:13:27', '2026-02-23 19:23:10', 9000, 'CASH', 'keluar'),
(3, 4, 1, '2026-02-23 17:13:31', '2026-02-23 19:23:15', 9000, 'CASH', 'keluar'),
(4, 2, 2, '2026-02-23 17:13:36', NULL, 0, 'Tunai', 'masuk'),
(5, 1, 1, '2026-02-23 17:13:40', NULL, 0, 'Tunai', 'masuk'),
(6, 7, 3, '2026-02-23 18:08:50', NULL, 0, 'Tunai', 'masuk'),
(7, 8, 1, '2026-02-23 18:18:03', NULL, 0, 'Tunai', 'masuk'),
(8, 9, 3, '2026-02-23 18:58:35', NULL, 0, 'Tunai', 'masuk'),
(9, 10, 3, '2026-02-23 19:05:46', '2026-02-23 19:45:14', 3000, 'CASH', 'keluar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','petugas','owner') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `role`) VALUES
(1, 'admin', '222', 'Administrator', 'admin'),
(2, 'petugas', '333', 'Petugas Parkir', 'petugas'),
(3, 'owner', '111', 'Owner Parkir', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `plat_nomor` (`plat_nomor`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `id_area` (`id_area`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  MODIFY `id_area` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD CONSTRAINT `fk_kendaraan_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE SET NULL;

--
-- Constraints for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `fk_log_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `fk_transaksi_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
