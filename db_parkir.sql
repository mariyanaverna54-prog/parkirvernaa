-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2026 at 02:10 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `nama_area` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kapasitas` int NOT NULL,
  `terisi` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(1, 'Lantai 1 (Mobil)', 50, 0),
(2, 'Lantai 2 (Motor)', 100, 0),
(3, 'Basement (Truk)', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int NOT NULL,
  `plat_nomor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kendaraan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `warna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pemilik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `warna`, `pemilik`, `id_user`) VALUES
(4, 'Q 7283 YTE', 'Mobil', 'Merah', 'Administrator', 1),
(5, 'Y 8294 YAW', 'Mobil', 'Putih', 'Administrator', 1),
(6, 'F 8349 UFI', 'Mobil', 'Hijau', 'Administrator', 1),
(7, 'D 2020 UFI', 'Truk/Bus', 'Merah', 'Administrator', 1),
(8, 'H 8488 YAW', 'Mobil', 'Hitam', 'Administrator', 1),
(9, 'F 7485 KAU', 'Truk/Bus', 'Hitam', 'Administrator', 1),
(10, 'H 6384 UYA', 'Truk/Bus', 'Ungu', 'Administrator', 1),
(11, 'H 7384 UHY', 'Mobil', 'HItam', 'Administrator', 1),
(12, 'G 7645 HUI', 'Motor', 'Hitam', 'Administrator', 1),
(13, 'H 6373 UHY', 'Truk', 'Hitam', 'Administrator', 1),
(14, 'ZZZ123', 'Motor', 'transparan', 'Administrator', 1),
(15, 'D 4432 UFN', 'Mobil', 'hitam', 'Administrator', 1),
(16, 'B 5555 UUU', 'Motor', 'putih', 'Administrator', 1),
(17, 'B 7887 HUY', 'Truk', 'Merah', 'Administrator', 1),
(18, 'H 7787 HIII', 'mobil', 'Pink', NULL, 1),
(19, 'J 6753 GAK', 'Truk', 'Hitam', 'Administrator', 1),
(20, 'Y  8888 YYY', 'Truk', 'Merah', 'Administrator', 1),
(21, 'T 5555 RAW', 'Truk', 'Hitam', NULL, 1),
(22, 'Y 7373 HII', 'Truk', 'Putih', 'Administrator', 1),
(23, 'U 7653 TRUK', 'Mobil', 'Hitam', NULL, 1),
(24, 'B 7777 GGG', 'Truk', 'Hitam', 'Administrator', 1),
(25, 'R 555 TOR', 'Motor', 'Pink', 'Administrator', 1),
(26, 'L 888 BIL', 'Mobil', 'Hitam', 'Administrator', 1),
(27, 'K 7778 RUK', 'Truk', 'Kuning', NULL, 1),
(28, 'K 888 TRU', 'Truk', 'HItam', 'Administrator', 1),
(29, 'M 6776 TOR', 'Motor', 'Putih', 'Administrator', 1),
(30, 'M 7623 BIL', 'Mobil', 'Oren', 'Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int NOT NULL,
  `id_user` int NOT NULL,
  `aktivitas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
(50, 1, 'Login ke sistem', '2026-02-24 11:37:19'),
(51, 1, 'Login ke sistem', '2026-02-24 18:34:35'),
(52, 1, 'Logout dari sistem', '2026-02-24 18:35:16'),
(53, 2, 'Login ke sistem', '2026-02-24 18:35:22'),
(54, 2, 'Logout dari sistem', '2026-02-24 18:35:53'),
(55, 3, 'Login ke sistem', '2026-02-24 18:35:58'),
(56, 3, 'Logout dari sistem', '2026-02-24 18:36:30'),
(57, 1, 'Login ke sistem', '2026-02-24 21:23:44'),
(58, 1, 'Login ke sistem', '2026-02-25 06:49:08'),
(59, 1, 'Logout dari sistem', '2026-02-25 06:49:28'),
(60, 1, 'Login ke sistem', '2026-03-09 08:39:44'),
(61, 1, 'Logout dari sistem', '2026-03-09 08:40:42'),
(62, 2, 'Login ke sistem', '2026-03-09 08:40:50'),
(63, 2, 'Logout dari sistem', '2026-03-09 08:41:05'),
(64, 3, 'Login ke sistem', '2026-03-09 08:41:15'),
(65, 3, 'Logout dari sistem', '2026-03-09 10:53:51'),
(66, 1, 'Login ke sistem', '2026-03-09 10:53:58'),
(67, 1, 'Login ke sistem', '2026-03-10 16:25:20'),
(68, 1, 'Logout dari sistem', '2026-03-10 16:35:08'),
(69, 2, 'Login ke sistem', '2026-03-10 18:01:56'),
(70, 2, 'Logout dari sistem', '2026-03-10 19:27:51'),
(71, 1, 'Login ke sistem', '2026-03-10 19:27:59'),
(72, 1, 'Login ke sistem', '2026-03-11 09:17:31'),
(73, 1, 'Logout dari sistem', '2026-03-11 09:17:49'),
(74, 2, 'Login ke sistem', '2026-03-11 09:18:01'),
(75, 2, 'Logout dari sistem', '2026-03-11 09:18:26'),
(76, 3, 'Login ke sistem', '2026-03-11 09:18:51'),
(77, 3, 'Logout dari sistem', '2026-03-11 09:53:34'),
(78, 1, 'Login ke sistem', '2026-03-11 09:53:43'),
(79, 1, 'Logout dari sistem', '2026-03-11 10:41:04'),
(80, 2, 'Login ke sistem', '2026-03-11 10:41:10'),
(81, 2, 'Logout dari sistem', '2026-03-11 10:41:15'),
(82, 2, 'Login ke sistem', '2026-03-11 10:41:20'),
(83, 2, 'Logout dari sistem', '2026-03-11 11:43:27'),
(84, 1, 'Login ke sistem', '2026-03-11 11:43:36'),
(85, 3, 'Login ke sistem', '2026-03-11 12:02:30'),
(86, 1, 'Login ke sistem', '2026-03-11 16:26:09'),
(87, 2, 'Login ke sistem', '2026-03-31 06:46:19'),
(88, 2, 'Logout dari sistem', '2026-03-31 06:51:17'),
(89, 2, 'Login ke sistem', '2026-03-31 06:52:49'),
(90, 2, 'Logout dari sistem', '2026-03-31 06:55:04'),
(91, 2, 'Login ke sistem', '2026-03-31 07:38:19'),
(92, 2, 'Logout dari sistem', '2026-03-31 07:38:34'),
(93, 1, 'Login ke sistem', '2026-03-31 07:38:40'),
(94, 1, 'Logout dari sistem', '2026-03-31 07:40:34'),
(95, 2, 'Login ke sistem', '2026-03-31 07:40:49'),
(96, 2, 'Logout dari sistem', '2026-03-31 07:43:22'),
(97, 3, 'Login ke sistem', '2026-03-31 07:43:32'),
(98, 3, 'Logout dari sistem', '2026-03-31 11:23:47'),
(99, 2, 'Login ke sistem', '2026-03-31 11:23:57'),
(100, 2, 'Logout dari sistem', '2026-03-31 11:24:16'),
(101, 3, 'Login ke sistem', '2026-03-31 11:24:31'),
(102, 3, 'Logout dari sistem', '2026-03-31 11:24:47'),
(103, 2, 'Login ke sistem', '2026-03-31 11:24:53'),
(104, 2, 'Logout dari sistem', '2026-03-31 11:25:26'),
(105, 3, 'Login ke sistem', '2026-03-31 11:25:34'),
(106, 3, 'Logout dari sistem', '2026-03-31 11:25:52'),
(107, 2, 'Login ke sistem', '2026-03-31 11:26:02'),
(108, 2, 'Logout dari sistem', '2026-03-31 11:26:16'),
(109, 3, 'Login ke sistem', '2026-03-31 11:26:21'),
(110, 1, 'Login ke sistem', '2026-04-01 18:59:05'),
(111, 1, 'Logout dari sistem', '2026-04-01 18:59:20'),
(112, 1, 'Login ke sistem', '2026-04-07 08:24:49'),
(113, 1, 'Login ke sistem', '2026-04-07 11:06:42'),
(114, 1, 'Logout dari sistem', '2026-04-07 11:19:32'),
(115, 1, 'Login ke sistem', '2026-04-07 11:19:43'),
(116, 1, 'Logout dari sistem', '2026-04-07 11:20:12'),
(117, 2, 'Login ke sistem', '2026-04-07 11:20:20'),
(118, 2, 'Logout dari sistem', '2026-04-07 11:23:46'),
(119, 3, 'Login ke sistem', '2026-04-07 11:23:57'),
(120, 3, 'Logout dari sistem', '2026-04-07 11:26:05'),
(121, 1, 'Login ke sistem', '2026-04-07 11:26:22'),
(122, 1, 'Login ke sistem', '2026-04-08 06:49:43'),
(123, 1, 'Logout dari sistem', '2026-04-08 07:03:54'),
(124, 1, 'Login ke sistem', '2026-04-08 07:04:02'),
(125, 1, 'Logout dari sistem', '2026-04-08 07:04:19'),
(126, 2, 'Login ke sistem', '2026-04-08 07:04:26'),
(127, 2, 'Login ke sistem', '2026-04-08 07:04:28'),
(128, 2, 'Logout dari sistem', '2026-04-08 07:04:47'),
(129, 1, 'Login ke sistem', '2026-04-08 07:04:55'),
(130, 1, 'Logout dari sistem', '2026-04-08 07:12:57'),
(131, 2, 'Login ke sistem', '2026-04-08 07:13:06'),
(132, 2, 'Logout dari sistem', '2026-04-08 07:50:23'),
(133, 1, 'Login ke sistem', '2026-04-08 07:50:33'),
(134, 1, 'Login ke sistem', '2026-04-08 11:19:18'),
(135, 1, 'Logout dari sistem', '2026-04-08 11:20:39'),
(136, 2, 'Login ke sistem', '2026-04-08 11:20:46'),
(137, 2, 'Logout dari sistem', '2026-04-08 11:41:11'),
(138, 1, 'Login ke sistem', '2026-04-08 11:41:20'),
(139, 1, 'Login ke sistem', '2026-04-10 07:50:24'),
(140, 1, 'Logout dari sistem', '2026-04-10 07:50:36'),
(141, 2, 'Login ke sistem', '2026-04-10 07:50:42'),
(142, 2, 'Logout dari sistem', '2026-04-10 08:02:24'),
(143, 1, 'Login ke sistem', '2026-04-10 08:02:32'),
(144, 1, 'Logout dari sistem', '2026-04-10 08:39:59'),
(145, 3, 'Login ke sistem', '2026-04-10 08:40:07'),
(146, 1, 'Login ke sistem', '2026-04-10 18:12:33'),
(147, 1, 'Logout dari sistem', '2026-04-10 18:18:29'),
(148, 2, 'Login ke sistem', '2026-04-10 18:19:17'),
(149, 2, 'Logout dari sistem', '2026-04-10 18:20:40'),
(150, 3, 'Login ke sistem', '2026-04-10 18:20:56'),
(151, 3, 'Logout dari sistem', '2026-04-10 18:22:35'),
(152, 1, 'Login ke sistem', '2026-04-10 18:22:47'),
(153, 1, 'Logout dari sistem', '2026-04-10 18:27:16'),
(154, 2, 'Login ke sistem', '2026-04-10 18:27:24'),
(155, 2, 'Logout dari sistem', '2026-04-10 18:28:04'),
(156, 3, 'Login ke sistem', '2026-04-10 18:28:13'),
(157, 3, 'Logout dari sistem', '2026-04-10 18:28:40'),
(158, 2, 'Login ke sistem', '2026-04-10 18:28:48'),
(159, 2, 'Logout dari sistem', '2026-04-10 18:29:32'),
(160, 3, 'Login ke sistem', '2026-04-10 18:29:39'),
(161, 3, 'Logout dari sistem', '2026-04-10 18:36:17'),
(162, 1, 'Login ke sistem', '2026-04-10 18:36:26'),
(163, 1, 'Logout dari sistem', '2026-04-10 18:37:53'),
(164, 2, 'Login ke sistem', '2026-04-10 18:38:00'),
(165, 2, 'Logout dari sistem', '2026-04-10 18:38:14'),
(166, 3, 'Login ke sistem', '2026-04-10 18:38:19'),
(167, 3, 'Logout dari sistem', '2026-04-10 18:39:05'),
(168, 1, 'Login ke sistem', '2026-04-10 18:39:17'),
(169, 1, 'Logout dari sistem', '2026-04-10 18:41:21'),
(170, 1, 'Login ke sistem', '2026-04-10 18:41:35'),
(171, 1, 'Logout dari sistem', '2026-04-10 18:41:41'),
(172, 2, 'Login ke sistem', '2026-04-10 18:41:53'),
(173, 2, 'Logout dari sistem', '2026-04-10 18:42:07'),
(174, 3, 'Login ke sistem', '2026-04-10 18:42:16'),
(175, 3, 'Logout dari sistem', '2026-04-10 18:46:20'),
(176, 1, 'Login ke sistem', '2026-04-10 18:46:28'),
(177, 1, 'Logout dari sistem', '2026-04-10 18:47:42'),
(178, 3, 'Login ke sistem', '2026-04-10 18:47:47'),
(179, 3, 'Logout dari sistem', '2026-04-10 18:48:04'),
(180, 2, 'Login ke sistem', '2026-04-10 18:48:12'),
(181, 2, 'Logout dari sistem', '2026-04-10 18:48:41'),
(182, 1, 'Login ke sistem', '2026-04-10 18:48:51'),
(183, 1, 'Logout dari sistem', '2026-04-10 19:07:42'),
(184, 2, 'Login ke sistem', '2026-04-10 19:07:52'),
(185, 2, 'Logout dari sistem', '2026-04-10 19:08:10'),
(186, 3, 'Login ke sistem', '2026-04-10 19:08:18'),
(187, 3, 'Logout dari sistem', '2026-04-10 19:08:31'),
(188, 2, 'Login ke sistem', '2026-04-10 19:08:36'),
(189, 2, 'Logout dari sistem', '2026-04-10 19:08:49'),
(190, 3, 'Login ke sistem', '2026-04-10 19:08:58'),
(191, 3, 'Logout dari sistem', '2026-04-10 19:09:07'),
(192, 1, 'Login ke sistem', '2026-04-10 19:09:19'),
(193, 1, 'Logout dari sistem', '2026-04-10 19:37:44'),
(194, 3, 'Login ke sistem', '2026-04-10 19:37:54'),
(195, 3, 'Logout dari sistem', '2026-04-10 19:38:02'),
(196, 1, 'Login ke sistem', '2026-04-10 19:38:10'),
(197, 1, 'Logout dari sistem', '2026-04-10 19:38:54'),
(198, 2, 'Login ke sistem', '2026-04-10 19:39:02'),
(199, 2, 'Logout dari sistem', '2026-04-10 19:39:39'),
(200, 3, 'Login ke sistem', '2026-04-10 19:39:48'),
(201, 3, 'Logout dari sistem', '2026-04-10 19:39:54'),
(202, 2, 'Login ke sistem', '2026-04-10 19:40:06'),
(203, 2, 'Logout dari sistem', '2026-04-10 19:40:34'),
(204, 3, 'Login ke sistem', '2026-04-10 19:40:54'),
(205, 3, 'Logout dari sistem', '2026-04-10 19:41:03'),
(206, 1, 'Login ke sistem', '2026-04-10 19:41:08'),
(207, 1, 'Logout dari sistem', '2026-04-10 19:43:58'),
(208, 2, 'Login ke sistem', '2026-04-10 19:44:04'),
(209, 2, 'Logout dari sistem', '2026-04-10 19:51:28'),
(210, 1, 'Login ke sistem', '2026-04-10 19:51:38'),
(211, 1, 'Logout dari sistem', '2026-04-10 19:57:32'),
(212, 2, 'Login ke sistem', '2026-04-10 19:57:42'),
(213, 2, 'Logout dari sistem', '2026-04-10 19:58:37'),
(214, 1, 'Login ke sistem', '2026-04-10 19:58:44'),
(215, 1, 'Logout dari sistem', '2026-04-10 20:10:04'),
(216, 7, 'Login ke sistem', '2026-04-10 20:10:14'),
(217, 7, 'Logout dari sistem', '2026-04-10 20:10:25'),
(218, 1, 'Login ke sistem', '2026-04-10 20:10:31'),
(219, 1, 'Logout dari sistem', '2026-04-10 20:15:29'),
(220, 2, 'Login ke sistem', '2026-04-10 20:15:42'),
(221, 2, 'Logout dari sistem', '2026-04-10 20:19:56'),
(222, 3, 'Login ke sistem', '2026-04-10 20:20:05'),
(223, 3, 'Logout dari sistem', '2026-04-10 20:22:07'),
(224, 1, 'Login ke sistem', '2026-04-10 20:22:18'),
(225, 1, 'Logout dari sistem', '2026-04-10 20:26:27'),
(226, 2, 'Login ke sistem', '2026-04-10 20:26:35'),
(227, 2, 'Logout dari sistem', '2026-04-10 20:48:57'),
(228, 3, 'Login ke sistem', '2026-04-10 20:49:07'),
(229, 3, 'Logout dari sistem', '2026-04-10 20:49:35'),
(230, 2, 'Login ke sistem', '2026-04-10 20:49:40'),
(231, 2, 'Logout dari sistem', '2026-04-10 20:49:55'),
(232, 1, 'Login ke sistem', '2026-04-10 20:50:14'),
(233, 1, 'Logout dari sistem', '2026-04-10 20:53:45'),
(234, 2, 'Login ke sistem', '2026-04-10 20:53:55'),
(235, 2, 'Logout dari sistem', '2026-04-10 20:54:30'),
(236, 3, 'Login ke sistem', '2026-04-10 20:54:34'),
(237, 3, 'Logout dari sistem', '2026-04-10 20:54:42'),
(238, 1, 'Login ke sistem', '2026-04-10 20:54:56'),
(239, 1, 'Logout dari sistem', '2026-04-10 20:55:17'),
(240, 2, 'Login ke sistem', '2026-04-10 20:55:24'),
(241, 2, 'Logout dari sistem', '2026-04-10 21:00:48'),
(242, 2, 'Login ke sistem', '2026-04-10 21:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int NOT NULL,
  `jenis_kendaraan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tarif_per_jam` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`) VALUES
(1, 'motor', '3000'),
(2, 'mobil', '3000'),
(3, 'Truk', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int NOT NULL,
  `id_kendaraan` int NOT NULL,
  `id_area` int NOT NULL,
  `id_tarif` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `waktu_masuk` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_keluar` datetime DEFAULT NULL,
  `durasi_jam` int DEFAULT NULL,
  `biaya_total` decimal(10,0) DEFAULT '0',
  `metode_bayar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Tunai',
  `status` enum('masuk','keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'masuk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `id_kendaraan`, `id_area`, `id_tarif`, `id_user`, `waktu_masuk`, `waktu_keluar`, `durasi_jam`, `biaya_total`, `metode_bayar`, `status`) VALUES
(1, 6, 1, NULL, NULL, '2026-02-23 17:13:22', '2026-02-23 17:21:04', NULL, '3000', 'DEBIT', 'keluar'),
(2, 5, 1, NULL, NULL, '2026-02-23 17:13:27', '2026-02-23 19:23:10', NULL, '9000', 'CASH', 'keluar'),
(3, 4, 1, NULL, NULL, '2026-02-23 17:13:31', '2026-02-23 19:23:15', NULL, '9000', 'CASH', 'keluar'),
(6, 7, 3, NULL, NULL, '2026-02-23 18:08:50', '2026-04-10 18:20:09', NULL, '3315000', 'QRIS', 'keluar'),
(7, 8, 1, NULL, NULL, '2026-02-23 18:18:03', '2026-02-24 18:35:49', NULL, '75000', 'CASH', 'keluar'),
(8, 9, 3, NULL, NULL, '2026-02-23 18:58:35', '2026-04-10 18:20:16', NULL, '3312000', 'CASH', 'keluar'),
(9, 10, 3, NULL, NULL, '2026-02-23 19:05:46', '2026-02-23 19:45:14', NULL, '3000', 'CASH', 'keluar'),
(10, 11, 1, NULL, NULL, '2026-02-24 18:35:09', '2026-03-31 11:26:13', NULL, '2499000', 'CASH', 'keluar'),
(11, 12, 2, NULL, NULL, '2026-02-24 21:24:48', '2026-03-31 11:25:20', NULL, '2493000', 'CASH', 'keluar'),
(12, 13, 3, NULL, NULL, '2026-03-31 07:40:20', '2026-03-31 11:24:08', NULL, '12000', 'CASH', 'keluar'),
(13, 14, 2, NULL, NULL, '2026-04-07 11:27:37', '2026-04-10 18:20:24', NULL, '237000', 'QRIS', 'keluar'),
(14, 15, 1, NULL, NULL, '2026-04-08 06:51:16', '2026-04-10 18:20:33', NULL, '180000', 'DEBIT', 'keluar'),
(15, 16, 2, NULL, NULL, '2026-04-08 06:54:44', '2026-04-08 07:04:42', NULL, '3000', 'DEBIT', 'keluar'),
(16, 17, 3, NULL, NULL, '2026-04-08 07:12:52', NULL, NULL, '0', 'Tunai', 'masuk'),
(17, 18, 2, NULL, NULL, '2026-04-08 11:55:03', NULL, NULL, '0', 'Tunai', 'masuk'),
(18, 19, 3, NULL, NULL, '2026-04-08 11:57:05', NULL, NULL, '0', 'Tunai', 'masuk'),
(19, 20, 3, NULL, NULL, '2026-04-10 18:25:18', '2026-04-10 18:29:26', NULL, '3000', 'CASH', 'keluar'),
(20, 21, 3, NULL, NULL, '2026-04-10 18:36:55', '2026-04-10 18:38:09', NULL, '3000', 'CASH', 'keluar'),
(21, 22, 3, NULL, NULL, '2026-04-10 18:39:40', '2026-04-10 18:42:03', NULL, '3000', 'CASH', 'keluar'),
(22, 23, 3, NULL, NULL, '2026-04-10 18:46:56', NULL, NULL, '0', 'Tunai', 'masuk'),
(23, 24, 3, NULL, NULL, '2026-04-10 19:07:37', '2026-04-10 19:08:44', NULL, '6000', 'CASH', 'keluar'),
(24, 25, 2, NULL, NULL, '2026-04-10 19:36:20', '2026-04-10 19:40:31', NULL, '3000', 'QRIS', 'keluar'),
(25, 26, 1, NULL, NULL, '2026-04-10 19:36:50', '2026-04-10 19:40:21', NULL, '3000', 'DEBIT', 'keluar'),
(26, 27, 3, NULL, NULL, '2026-04-10 19:37:26', '2026-04-10 19:39:35', NULL, '6000', 'CASH', 'keluar'),
(27, 28, 3, NULL, NULL, '2026-04-10 19:54:16', NULL, NULL, '0', 'Tunai', 'masuk'),
(28, 29, 2, NULL, NULL, '2026-04-10 19:55:56', NULL, NULL, '0', 'Tunai', 'masuk'),
(29, 30, 1, NULL, NULL, '2026-04-10 19:56:48', NULL, NULL, '0', 'Tunai', 'masuk');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','petugas','owner') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_aksi` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `role`, `status_aksi`) VALUES
(1, 'admin', '222', 'Administrator', 'admin', 1),
(2, 'petugas', '333', 'Petugas Parkir', 'petugas', 1),
(3, 'owner', '111', 'Owner Parkir', 'owner', 1);

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
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_tarif` (`id_tarif`),
  ADD KEY `fk_transaksi_user` (`id_user`);

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
  MODIFY `id_kendaraan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `fk_transaksi_area` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_tarif` FOREIGN KEY (`id_tarif`) REFERENCES `tb_tarif` (`id_tarif`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_tarif`) REFERENCES `tb_tarif` (`id_tarif`),
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
