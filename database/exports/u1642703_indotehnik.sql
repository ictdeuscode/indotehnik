-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2023 at 01:12 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1642703_indotehnik`
--

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
-- Table structure for table `history_gudangs`
--

CREATE TABLE `history_gudangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_preorder` varchar(500) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_mesins`
--

CREATE TABLE `history_mesins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mesin` varchar(500) DEFAULT NULL,
  `no_surat` varchar(500) DEFAULT NULL,
  `nama_operator` varchar(500) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `poin` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_operators`
--

CREATE TABLE `history_operators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_mesin` varchar(500) DEFAULT NULL,
  `nama_barang` varchar(500) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_poins`
--

CREATE TABLE `history_poins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_history_surat` int(11) DEFAULT NULL,
  `poin` int(11) NOT NULL DEFAULT 0,
  `posisi` enum('D','K') NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_reject_customers`
--

CREATE TABLE `history_reject_customers` (
  `id` int(11) NOT NULL,
  `id_surat` int(11) DEFAULT NULL,
  `keterangan_reject` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_surats`
--

CREATE TABLE `history_surats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(500) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `nama_mesin` varchar(500) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `keterangan_proses` text DEFAULT NULL,
  `nama_operator` varchar(500) DEFAULT NULL,
  `nama_operator_keluar` varchar(500) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `id_surat` int(11) DEFAULT NULL,
  `id_mesin` int(11) DEFAULT NULL,
  `id_operator` int(11) DEFAULT NULL,
  `is_approve` int(11) DEFAULT 0,
  `is_reject` int(11) DEFAULT 0,
  `tanggal_reject` timestamp NULL DEFAULT NULL,
  `keterangan_reject` text DEFAULT NULL,
  `tipe_reject` int(11) DEFAULT NULL COMMENT '1 = get point, 2 = not get point',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_surats`
--

INSERT INTO `history_surats` (`id`, `no_surat`, `tanggal`, `tanggal_keluar`, `nama_mesin`, `keterangan`, `keterangan_proses`, `nama_operator`, `nama_operator_keluar`, `image`, `id_surat`, `id_mesin`, `id_operator`, `is_approve`, `is_reject`, `tanggal_reject`, `keterangan_reject`, `tipe_reject`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2310326', '2023-10-05', '2023-10-05', '0202 - Mesin Milling Universal', NULL, 'Ok', 'OKIK WAHYU CANDRA PAMUNGKAS', NULL, NULL, 5, 14, 29, 0, 0, NULL, NULL, NULL, '2023-10-05 06:53:32', '2023-10-05 06:56:00', NULL),
(2, '2310326', '2023-10-05', NULL, '0405 - Mesin Hobbing Seiwa', NULL, 'Ok', 'HENGKY WIJANANTO', NULL, NULL, 5, 42, 19, 0, 0, NULL, NULL, NULL, '2023-10-05 06:56:00', '2023-10-05 06:56:00', NULL),
(3, '2311354', '2023-10-05', NULL, '0204 - Mesin Milling Stik', NULL, 'Ok', 'Andi Setiawan', NULL, NULL, 18, 16, 1, 0, 0, NULL, NULL, NULL, '2023-10-05 07:25:22', '2023-10-05 07:25:22', NULL),
(4, '2311418', '2023-10-16', '2023-10-19', '0102 - Mesin Bubut 1 meter Howa', NULL, 'Proses 1 bubut', 'RAHMAD AMANAN', NULL, NULL, 106, 6, 30, 0, 0, NULL, NULL, NULL, '2023-10-16 04:35:08', '2023-10-19 04:34:43', NULL),
(5, '2320974', '2023-10-16', NULL, '0104 - Mesin Bubut', NULL, 'Finishing', 'BISMA SETYAWAN', NULL, NULL, 51, 8, 15, 0, 0, NULL, NULL, NULL, '2023-10-16 04:39:20', '2023-10-16 04:39:20', NULL),
(6, '2311349', '2023-10-16', NULL, '0104 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 13, 8, 15, 0, 0, NULL, NULL, NULL, '2023-10-16 04:41:11', '2023-10-16 04:41:11', NULL),
(7, '2311394', '2023-10-16', '2023-10-16', '0104 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 82, 8, 15, 0, 0, NULL, NULL, NULL, '2023-10-16 04:42:50', '2023-10-16 07:45:52', NULL),
(8, '2311350', '2023-10-16', '2023-10-26', '0105 - Mesin Bubut 1 meter Wisser', NULL, 'Proses 1', 'SADERI', NULL, NULL, 14, 9, 32, 0, 0, NULL, NULL, NULL, '2023-10-16 04:44:49', '2023-10-26 02:29:58', NULL),
(9, '2311398', '2023-10-16', '2023-10-26', '0105 - Mesin Bubut 1 meter Wisser', NULL, 'Proses 1', 'SADERI', NULL, NULL, 86, 9, 32, 0, 0, NULL, NULL, NULL, '2023-10-16 04:46:58', '2023-10-26 02:36:55', NULL),
(10, '2321011', '2023-10-16', '2023-10-20', '0203 - Mesin Milling Vertikal', NULL, 'Proses 1', 'HARI SUYANTO', NULL, NULL, 143, 15, 18, 0, 0, NULL, NULL, NULL, '2023-10-16 04:49:33', '2023-10-20 01:35:43', NULL),
(11, '2321006', '2023-10-16', '2023-10-19', '0106 - Mesin Bubut 2 meter Baoji', NULL, 'Proses 1', 'SADERI', NULL, NULL, 138, 10, 32, 0, 0, NULL, NULL, NULL, '2023-10-16 04:51:07', '2023-10-19 04:36:25', NULL),
(12, '2311411', '2023-10-16', NULL, '0205 - Mesin Milling Universal', NULL, 'Proses 1 bubut\nPrises 2 bortap', 'ARIF NURFIANTO', NULL, NULL, 99, 17, 7, 0, 0, NULL, NULL, NULL, '2023-10-16 04:53:15', '2023-10-16 04:53:15', NULL),
(13, '2311412', '2023-10-16', '2023-10-16', '0103 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 100, 7, 15, 0, 0, NULL, NULL, NULL, '2023-10-16 04:54:21', '2023-10-16 04:55:25', NULL),
(14, '2311412', '2023-10-16', NULL, '0205 - Mesin Milling Universal', NULL, 'Proses 2', 'ARIF NURFIANTO', NULL, NULL, 100, 17, 7, 0, 0, NULL, NULL, NULL, '2023-10-16 04:55:25', '2023-10-16 04:55:25', NULL),
(15, '2311401', '2023-10-16', '2023-10-16', '0605 - Mesin CNC Bubut Worm', NULL, 'Proses 2', 'ACHMAD IVAN RIZKY', NULL, NULL, 89, 57, 8, 0, 0, NULL, NULL, NULL, '2023-10-16 06:46:56', '2023-10-16 06:48:54', NULL),
(16, '2311401', '2023-10-16', '2023-10-17', '0103 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 89, 7, 15, 0, 0, NULL, NULL, NULL, '2023-10-16 06:48:54', '2023-10-17 02:43:09', NULL),
(17, '2321005', '2023-10-16', '2023-10-19', '0604 - Mesin CNC Bubut 1500', NULL, 'Proses 1', 'SUNARTO', NULL, NULL, 137, 56, 33, 0, 0, NULL, NULL, NULL, '2023-10-16 06:51:10', '2023-10-19 04:37:57', NULL),
(18, '2311407', '2023-10-16', '2023-10-19', '0606 - Mesin CNC Milling Hartford', NULL, 'Proses 3', 'ALFIN EKO SAPUTRO', NULL, NULL, 95, 78, 13, 0, 0, NULL, NULL, NULL, '2023-10-16 06:53:33', '2023-10-19 04:48:30', NULL),
(19, '2311394', '2023-10-16', '2023-10-18', '0103 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 82, 7, 15, 0, 0, NULL, NULL, NULL, '2023-10-16 07:45:52', '2023-10-18 06:16:01', NULL),
(20, '2311401', '2023-10-17', NULL, '0605 - Mesin CNC Bubut Worm', NULL, 'Proses 3', 'ACHMAD IVAN RIZKY', NULL, NULL, 89, 57, 8, 0, 0, NULL, NULL, NULL, '2023-10-17 02:43:09', '2023-10-17 02:43:09', NULL),
(21, '2311385', '2023-10-17', NULL, '0102 - Mesin Bubut 1 meter Howa', NULL, 'Proses 1', 'RAHMAD AMANAN', NULL, NULL, 49, 6, 30, 0, 0, NULL, NULL, NULL, '2023-10-17 06:36:10', '2023-10-17 06:36:10', NULL),
(22, '2311391', '2023-10-18', NULL, '0102 - Mesin Bubut 1 meter Howa', NULL, 'Proses 1', 'RAHMAD AMANAN', NULL, NULL, 79, 6, 30, 0, 0, NULL, NULL, NULL, '2023-10-18 01:54:17', '2023-10-18 01:54:17', NULL),
(23, '2311402', '2023-10-18', NULL, '0104 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 90, 8, 15, 0, 0, NULL, NULL, NULL, '2023-10-18 02:10:16', '2023-10-18 02:10:16', NULL),
(24, '2311425', '2023-10-18', NULL, '0106 - Mesin Bubut 2 meter Baoji', NULL, 'Proses 1', 'SADERI', NULL, NULL, 113, 10, 32, 0, 0, NULL, NULL, NULL, '2023-10-18 02:29:14', '2023-10-18 02:29:14', NULL),
(25, '2311395', '2023-10-18', NULL, '0203 - Mesin Milling Vertikal', NULL, 'Proses 2', 'ARIF NURFIANTO', NULL, NULL, 83, 15, 7, 0, 0, NULL, NULL, NULL, '2023-10-18 02:32:29', '2023-10-18 02:32:29', NULL),
(26, '2311394', '2023-10-18', '2023-10-18', '0405 - Mesin Hobbing Seiwa', NULL, 'Proses 2', 'JEFRY ARKADIA SANDY', NULL, NULL, 82, 42, 22, 0, 0, NULL, NULL, NULL, '2023-10-18 06:16:01', '2023-10-18 06:17:24', NULL),
(27, '2311394', '2023-10-18', NULL, '0104 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 82, 8, 15, 0, 0, NULL, NULL, NULL, '2023-10-18 06:17:24', '2023-10-18 06:17:24', NULL),
(28, '2311393', '2023-10-19', '2023-10-23', '0101 - Mesin Bubut 1 meter Cina', NULL, 'Proses 1', 'ARIF WINARDI', NULL, NULL, 81, 5, 6, 0, 0, NULL, NULL, NULL, '2023-10-19 04:14:46', '2023-10-23 03:45:37', NULL),
(29, '2311450', '2023-10-19', '2023-10-19', '0405 - Mesin Hobbing Seiwa', NULL, 'Proses 1', 'JEFRY ARKADIA SANDY', NULL, NULL, 152, 42, 22, 0, 0, NULL, NULL, NULL, '2023-10-19 04:29:51', '2023-10-19 04:29:51', NULL),
(30, '2311450', '2023-10-19', '2023-10-19', '0405 - Mesin Hobbing Seiwa', NULL, 'Proses 1', 'JEFRY ARKADIA SANDY', NULL, NULL, 152, 42, 22, 0, 0, NULL, NULL, NULL, '2023-10-19 04:29:51', '2023-10-19 04:29:51', NULL),
(31, '2311450', '2023-10-19', NULL, '0405 - Mesin Hobbing Seiwa', NULL, 'Proses 1', 'JEFRY ARKADIA SANDY', NULL, NULL, 152, 42, 22, 0, 0, NULL, NULL, NULL, '2023-10-19 04:29:51', '2023-10-19 04:29:51', NULL),
(32, '2311418', '2023-10-19', '2023-10-26', '0404 - Mesin Hobbing Pfauter 1000', NULL, 'Proses 2', 'MOCHAMAD ARIFIN', NULL, NULL, 106, 41, 25, 0, 0, NULL, NULL, NULL, '2023-10-19 04:34:43', '2023-10-26 06:43:53', NULL),
(33, '2321006', '2023-10-19', NULL, '0404 - Mesin Hobbing Pfauter 1000', NULL, 'Proses 2', 'MOCHAMAD ARIFIN', NULL, NULL, 138, 41, 25, 0, 0, NULL, NULL, NULL, '2023-10-19 04:36:25', '2023-10-19 04:36:25', NULL),
(34, '2321005', '2023-10-19', '2023-10-19', '0404 - Mesin Hobbing Pfauter 1000', NULL, 'Proses 2', 'MOCHAMAD ARIFIN', NULL, NULL, 137, 41, 25, 0, 0, NULL, NULL, NULL, '2023-10-19 04:37:57', '2023-10-19 04:38:54', NULL),
(35, '2321005', '2023-10-19', '2023-10-26', '0604 - Mesin CNC Bubut 1500', NULL, 'Proses 1', 'SUNARTO', NULL, NULL, 137, 56, 33, 0, 0, NULL, NULL, NULL, '2023-10-19 04:38:54', '2023-10-26 05:24:49', NULL),
(36, '2311475', '2023-10-19', NULL, '0603 - Mesin CNC Bubut 500 Leadwell', NULL, 'Proses 1', 'ITHAF AQIL AMRULLOH', NULL, NULL, 185, 55, 20, 0, 0, NULL, NULL, NULL, '2023-10-19 04:45:29', '2023-10-19 04:45:29', NULL),
(37, '2311473', '2023-10-19', NULL, '0603 - Mesin CNC Bubut 500 Leadwell', NULL, 'Proses 1', 'ITHAF AQIL AMRULLOH', NULL, NULL, 183, 55, 20, 0, 0, NULL, NULL, NULL, '2023-10-19 04:46:32', '2023-10-19 04:46:32', NULL),
(38, '2311407', '2023-10-19', '2023-10-19', '0607 - Mesin CNC Milling Haas', NULL, 'Proses 1 body army', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-19 04:48:30', '2023-10-19 04:48:30', NULL),
(39, '2311407', '2023-10-19', '2023-10-19', '0607 - Mesin CNC Milling Haas', NULL, 'Proses 1 body army', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-19 04:48:30', '2023-10-19 04:48:30', NULL),
(40, '2311407', '2023-10-19', '2023-10-19', '0607 - Mesin CNC Milling Haas', NULL, 'Proses 1 body army', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-19 04:48:30', '2023-10-19 04:48:30', NULL),
(41, '2311407', '2023-10-19', '2023-10-19', '0607 - Mesin CNC Milling Haas', NULL, 'Proses 1 body army', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-19 04:48:30', '2023-10-19 04:48:32', NULL),
(42, '2311407', '2023-10-19', '2023-10-19', '0607 - Mesin CNC Milling Haas', NULL, 'Proses 1 body army', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-19 04:48:32', '2023-10-19 04:48:33', NULL),
(43, '2311407', '2023-10-19', '2023-10-19', '0607 - Mesin CNC Milling Haas', NULL, 'Proses 1 body army', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-19 04:48:33', '2023-10-19 04:48:34', NULL),
(44, '2311407', '2023-10-19', '2023-10-26', '0607 - Mesin CNC Milling Haas', NULL, 'Proses 1 body army', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-19 04:48:34', '2023-10-26 02:32:47', NULL),
(45, '2321018', '2023-10-19', '2023-10-19', '0606 - Mesin CNC Milling Hartford', NULL, 'Proses 2', 'ALFIN EKO SAPUTRO', NULL, NULL, 171, 78, 13, 0, 0, NULL, NULL, NULL, '2023-10-19 04:50:18', '2023-10-19 04:50:18', NULL),
(46, '2321018', '2023-10-19', '2023-10-19', '0606 - Mesin CNC Milling Hartford', NULL, 'Proses 2', 'ALFIN EKO SAPUTRO', NULL, NULL, 171, 78, 13, 0, 0, NULL, NULL, NULL, '2023-10-19 04:50:18', '2023-10-19 04:50:18', NULL),
(47, '2321018', '2023-10-19', NULL, '0606 - Mesin CNC Milling Hartford', NULL, 'Proses 2', 'ALFIN EKO SAPUTRO', NULL, NULL, 171, 78, 13, 0, 0, NULL, NULL, NULL, '2023-10-19 04:50:18', '2023-10-19 04:50:18', NULL),
(48, '2321016', '2023-10-19', '2023-10-19', '0605 - Mesin CNC Bubut Worm', NULL, 'Proses 2', 'ACHMAD IVAN RIZKY', NULL, NULL, 169, 57, 8, 0, 0, NULL, NULL, NULL, '2023-10-19 04:51:26', '2023-10-19 04:51:56', NULL),
(49, '2321016', '2023-10-19', NULL, '0605 - Mesin CNC Bubut Worm', NULL, 'Proses 2', 'ACHMAD IVAN RIZKY', NULL, NULL, 169, 57, 8, 0, 0, NULL, NULL, NULL, '2023-10-19 04:51:56', '2023-10-19 04:51:56', NULL),
(50, '2311403', '2023-10-19', '2023-10-19', '0203 - Mesin Milling Vertikal', NULL, 'Proses miling', 'ARIF NURFIANTO', NULL, NULL, 91, 15, 7, 0, 0, NULL, NULL, NULL, '2023-10-19 06:19:36', '2023-10-19 08:06:01', NULL),
(51, '2311403', '2023-10-19', NULL, '0203 - Mesin Milling Vertikal', NULL, 'Proses 3', 'ARIF NURFIANTO', NULL, NULL, 91, 15, 7, 0, 0, NULL, NULL, NULL, '2023-10-19 08:06:01', '2023-10-19 08:06:01', NULL),
(52, '2311449', '2023-10-19', '2023-10-20', '0604 - Mesin CNC Bubut 1500', NULL, 'Proses 1', 'SUNARTO', NULL, NULL, 151, 56, 33, 0, 0, NULL, NULL, NULL, '2023-10-19 08:08:55', '2023-10-20 01:55:05', NULL),
(53, '2311474', '2023-10-19', NULL, '0603 - Mesin CNC Bubut 500 Leadwell', NULL, 'Proses 1', 'ITHAF AQIL AMRULLOH', NULL, NULL, 184, 55, 20, 0, 0, NULL, NULL, NULL, '2023-10-19 08:10:50', '2023-10-19 08:10:50', NULL),
(54, '2311423', '2023-10-20', NULL, '0102 - Mesin Bubut 1 meter Howa', NULL, 'Proses 1', 'RAHMAD AMANAN', NULL, NULL, 111, 6, 30, 0, 0, NULL, NULL, NULL, '2023-10-20 01:21:16', '2023-10-20 01:21:16', NULL),
(55, '2311427', '2023-10-20', '2023-10-20', '0106 - Mesin Bubut 2 meter Baoji', NULL, 'Proses 1', 'SADERI', NULL, NULL, 115, 10, 32, 0, 0, NULL, NULL, NULL, '2023-10-20 01:33:42', '2023-10-20 06:28:42', NULL),
(56, '2321011', '2023-10-20', NULL, '0205 - Mesin Milling Universal', NULL, 'Proses 2', 'HARI SUYANTO', NULL, NULL, 143, 17, 18, 0, 0, NULL, NULL, NULL, '2023-10-20 01:35:43', '2023-10-20 01:35:43', NULL),
(57, '2311449', '2023-10-20', NULL, '0604 - Mesin CNC Bubut 1500', NULL, 'Proses 1', 'SUNARTO', NULL, NULL, 151, 56, 33, 0, 0, NULL, NULL, NULL, '2023-10-20 01:55:05', '2023-10-20 01:55:05', NULL),
(58, '2311429', '2023-10-20', '2023-10-20', '0108 - Mesin Bubut', NULL, 'Proses 1', 'M. ERFANDI', NULL, NULL, 117, 12, 26, 0, 0, NULL, NULL, NULL, '2023-10-20 02:07:29', '2023-10-20 07:30:03', NULL),
(59, '2321024', '2023-10-20', '2023-10-20', '0103 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 195, 7, 15, 0, 0, NULL, NULL, NULL, '2023-10-20 02:38:39', '2023-10-20 06:23:30', NULL),
(60, '2321024', '2023-10-20', '2023-10-20', '0103 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 195, 7, 15, 0, 0, NULL, NULL, NULL, '2023-10-20 06:23:30', '2023-10-20 08:20:21', NULL),
(61, '2311422', '2023-10-20', NULL, '0103 - Mesin Bubut', NULL, 'Proses 1', 'BUDI PRASTIYONO', NULL, NULL, 110, 7, 14, 0, 0, NULL, NULL, NULL, '2023-10-20 06:25:28', '2023-10-20 06:25:28', NULL),
(62, '2311427', '2023-10-20', '2023-10-26', '0105 - Mesin Bubut 1 meter Wisser', NULL, 'Proses 1', 'SADERI', NULL, NULL, 115, 9, 32, 0, 0, NULL, NULL, NULL, '2023-10-20 06:28:42', '2023-10-26 06:40:10', NULL),
(63, '2311429', '2023-10-20', NULL, '0108 - Mesin Bubut', NULL, 'Proses 1', 'M. ERFANDI', NULL, NULL, 117, 12, 26, 0, 0, NULL, NULL, NULL, '2023-10-20 07:30:03', '2023-10-20 07:30:03', NULL),
(64, '2321023', '2023-10-20', NULL, '0103 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 194, 7, 15, 0, 0, NULL, NULL, NULL, '2023-10-20 08:19:02', '2023-10-20 08:19:02', NULL),
(65, '2321024', '2023-10-20', NULL, '0405 - Mesin Hobbing Seiwa', NULL, 'Proses 2', 'JEFRY ARKADIA SANDY', NULL, NULL, 195, 42, 22, 0, 0, NULL, NULL, NULL, '2023-10-20 08:20:21', '2023-10-20 08:20:21', NULL),
(66, '2311393', '2023-10-23', '2023-10-23', '0101 - Mesin Bubut 1 meter Cina', NULL, 'Proses 1', 'ARIF WINARDI', NULL, NULL, 81, 5, 6, 0, 0, NULL, NULL, NULL, '2023-10-23 03:45:37', '2023-10-23 03:47:07', NULL),
(67, '2311393', '2023-10-23', '2023-10-26', '1102 - Mesin Las Argon', NULL, 'Proses 2', 'KARSONO', NULL, NULL, 81, 76, 24, 0, 0, NULL, NULL, NULL, '2023-10-23 03:47:07', '2023-10-26 05:12:43', NULL),
(68, '2321013', '2023-10-23', '2023-10-26', '0103 - Mesin Bubut', NULL, 'Proses 1', 'BUDI PRASTIYONO', NULL, NULL, 166, 7, 14, 0, 0, NULL, NULL, NULL, '2023-10-23 03:49:44', '2023-10-26 06:49:09', NULL),
(73, '2311470', '2023-10-26', NULL, '0103 - Mesin Bubut', NULL, 'Proses 1', 'BISMA SETYAWAN', NULL, NULL, 180, 7, 15, 0, 0, NULL, NULL, NULL, '2023-10-26 01:35:07', '2023-10-26 01:35:07', NULL),
(74, '2311350', '2023-10-26', '2023-10-26', '0606 - Mesin CNC Milling Hartford', NULL, 'Proses 2', 'ALFIN EKO SAPUTRO', NULL, NULL, 14, 78, 13, 0, 0, NULL, NULL, NULL, '2023-10-26 02:29:58', '2023-10-26 06:41:37', NULL),
(75, '2311407', '2023-10-26', NULL, '0607 - Mesin CNC Milling Haas', NULL, 'Body army proses 2 dan 3', 'YANUAR RUDIYANTO', NULL, NULL, 95, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-26 02:32:47', '2023-10-26 02:32:47', NULL),
(76, '2311398', '2023-10-26', NULL, '0607 - Mesin CNC Milling Haas', NULL, 'Proses 2', 'YANUAR RUDIYANTO', NULL, NULL, 86, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-26 02:36:55', '2023-10-26 02:36:55', NULL),
(77, '2311439', '2023-10-26', NULL, '0702 - Mesin Gergaji Bandsaw 400', NULL, 'Proses 1', 'RIAMAN', NULL, NULL, 127, 62, 31, 0, 0, NULL, NULL, NULL, '2023-10-26 02:40:28', '2023-10-26 02:40:28', NULL),
(78, '2311433', '2023-10-26', '2023-10-26', '0102 - Mesin Bubut 1 meter Howa', NULL, 'Proses 1', 'RAHMAD AMANAN', NULL, NULL, 121, 6, 30, 0, 0, NULL, NULL, NULL, '2023-10-26 03:07:02', '2023-10-26 03:08:12', NULL),
(79, '2311433', '2023-10-26', NULL, '0308 - Mesin Bor Vertikal', NULL, 'Proses 2 peringan', 'JAMAL', NULL, NULL, 121, 37, 21, 0, 0, NULL, NULL, NULL, '2023-10-26 03:08:12', '2023-10-26 03:08:12', NULL),
(80, '2311478', '2023-10-26', NULL, '0101 - Mesin Bubut 1 meter Cina', NULL, 'Proses 1', 'ARIF WINARDI', NULL, NULL, 188, 5, 6, 0, 0, NULL, NULL, NULL, '2023-10-26 03:57:04', '2023-10-26 03:57:04', NULL),
(81, '2311393', '2023-10-26', NULL, '0405 - Mesin Hobbing Seiwa', NULL, 'Proses 2', 'JEFRY ARKADIA SANDY', NULL, NULL, 81, 42, 22, 0, 0, NULL, NULL, NULL, '2023-10-26 05:12:43', '2023-10-26 05:12:43', NULL),
(82, '2321005', '2023-10-26', NULL, '0205 - Mesin Milling Universal', NULL, 'Proses 4', 'ARIF NURFIANTO', NULL, NULL, 137, 17, 7, 0, 0, NULL, NULL, NULL, '2023-10-26 05:24:49', '2023-10-26 05:24:49', NULL),
(83, '2311419', '2023-10-26', NULL, '0103 - Mesin Bubut', NULL, 'Proses 5', 'BUDI PRASTIYONO', NULL, NULL, 107, 7, 14, 0, 0, NULL, NULL, NULL, '2023-10-26 05:30:51', '2023-10-26 05:30:51', NULL),
(84, '2311427', '2023-10-26', NULL, '0215 - Mesin Milling Vertikal', NULL, 'Proses 2', 'OKIK WAHYU CANDRA PAMUNGKAS', NULL, NULL, 115, 27, 29, 0, 0, NULL, NULL, NULL, '2023-10-26 06:40:10', '2023-10-26 06:40:10', NULL),
(85, '2311350', '2023-10-26', NULL, '0606 - Mesin CNC Milling Hartford', NULL, 'Proses 2', 'ALFIN EKO SAPUTRO', NULL, NULL, 14, 78, 13, 0, 0, NULL, NULL, NULL, '2023-10-26 06:41:37', '2023-10-26 06:41:37', NULL),
(86, '2311418', '2023-10-26', NULL, '0607 - Mesin CNC Milling Haas', NULL, 'Proses 4', 'YANUAR RUDIYANTO', NULL, NULL, 106, 58, 34, 0, 0, NULL, NULL, NULL, '2023-10-26 06:43:53', '2023-10-26 06:43:53', NULL),
(87, '2321013', '2023-10-26', NULL, '0307 - Mesin Bor Vertikal', NULL, 'Proses 2', 'DWI NURDIAN', NULL, NULL, 166, 36, 16, 0, 0, NULL, NULL, NULL, '2023-10-26 06:49:09', '2023-10-26 06:49:09', NULL),
(88, '2321017', '2023-10-26', NULL, '0203 - Mesin Milling Vertikal', NULL, 'Proses 2', 'HARI SUYANTO', NULL, NULL, 170, 15, 18, 0, 0, NULL, NULL, NULL, '2023-10-26 07:06:04', '2023-10-26 07:06:04', NULL),
(89, '2311481', '2023-10-26', NULL, '0105 - Mesin Bubut 1 meter Wisser', NULL, 'Proses 1', 'SADERI', NULL, NULL, 200, 9, 32, 0, 0, NULL, NULL, NULL, '2023-10-26 07:29:04', '2023-10-26 07:29:04', NULL),
(90, '2311482', '2023-10-26', NULL, '0105 - Mesin Bubut 1 meter Wisser', NULL, 'Proses 1', 'SADERI', NULL, NULL, 201, 9, 32, 0, 0, NULL, NULL, NULL, '2023-10-26 07:30:47', '2023-10-26 07:30:47', NULL),
(91, '2311480', '2023-10-26', NULL, '0604 - Mesin CNC Bubut 1500', NULL, 'Proses 1', 'SUNARTO', NULL, NULL, 190, 56, 33, 0, 0, NULL, NULL, NULL, '2023-10-26 07:32:31', '2023-10-26 07:32:31', NULL),
(92, '2311483', '2023-10-26', NULL, '0603 - Mesin CNC Bubut 500 Leadwell', NULL, 'Proses 2', 'ITHAF AQIL AMRULLOH', NULL, NULL, 202, 55, 20, 0, 0, NULL, NULL, NULL, '2023-10-26 07:36:49', '2023-10-26 07:36:49', NULL),
(93, '2311486', '2023-10-26', '2023-10-26', '0108 - Mesin Bubut', NULL, 'Proses 2', 'M. ERFANDI', NULL, NULL, 205, 12, 26, 0, 0, NULL, NULL, NULL, '2023-10-26 07:38:47', '2023-10-26 07:40:18', NULL),
(94, '2311486', '2023-10-26', '2023-10-26', '0701 - Mesin Gergaji Bandsaw 200', NULL, 'Proses 1', 'RIAMAN', NULL, NULL, 205, 61, 31, 0, 0, NULL, NULL, NULL, '2023-10-26 07:40:18', '2023-10-26 07:41:45', NULL),
(95, '2311486', '2023-10-26', NULL, '0406 - Mesin Hobbing Nihon Kikkai', NULL, 'Proses 3', 'JEFRY ARKADIA SANDY', NULL, NULL, 205, 43, 22, 0, 0, NULL, NULL, NULL, '2023-10-26 07:41:45', '2023-10-26 07:41:45', NULL),
(96, '2311488', '2023-10-26', '2023-10-26', '0103 - Mesin Bubut', NULL, 'Proses 1', 'BUDI PRASTIYONO', NULL, NULL, 207, 7, 14, 0, 0, NULL, NULL, NULL, '2023-10-26 07:43:01', '2023-10-26 07:44:27', NULL),
(97, '2311488', '2023-10-26', '2023-10-26', '0702 - Mesin Gergaji Bandsaw 400', NULL, 'Proses 1 yang potong ngingas', 'RIAMAN', NULL, NULL, 207, 62, 31, 0, 0, NULL, NULL, NULL, '2023-10-26 07:44:27', '2023-10-26 07:45:13', NULL),
(98, '2311488', '2023-10-26', NULL, '0103 - Mesin Bubut', NULL, 'Proses 2', 'BUDI PRASTIYONO', NULL, NULL, 207, 7, 14, 0, 0, NULL, NULL, NULL, '2023-10-26 07:45:13', '2023-10-26 07:45:13', NULL),
(99, '2311491', '2023-10-26', NULL, '0701 - Mesin Gergaji Bandsaw 200', NULL, 'Proses 1', 'RIAMAN', NULL, NULL, 210, 61, 31, 0, 0, NULL, NULL, NULL, '2023-10-26 07:46:33', '2023-10-26 07:46:33', NULL),
(100, '2311492', '2023-10-26', NULL, '0102 - Mesin Bubut 1 meter Howa', NULL, 'Proses 1 ke proses 2', 'RAHMAD AMANAN', NULL, NULL, 211, 6, 30, 0, 0, NULL, NULL, NULL, '2023-10-26 07:48:12', '2023-10-26 07:48:12', NULL),
(101, '2311493', '2023-10-26', NULL, '0102 - Mesin Bubut 1 meter Howa', NULL, 'Proses 1 ke 2', 'RAHMAD AMANAN', NULL, NULL, 212, 6, 30, 0, 0, NULL, NULL, NULL, '2023-10-26 07:49:06', '2023-10-26 07:49:06', NULL),
(102, '2311495', '2023-10-26', NULL, '0701 - Mesin Gergaji Bandsaw 200', NULL, 'Proses 1', 'RIAMAN', NULL, NULL, 214, 61, 31, 0, 0, NULL, NULL, NULL, '2023-10-26 07:50:10', '2023-10-26 07:50:10', NULL),
(103, '2311503', '2023-10-26', NULL, '0608 - Mesin CNC Laser Marking', NULL, 'Proses 5', 'DWI NURDIAN', NULL, NULL, 222, 59, 16, 0, 0, NULL, NULL, NULL, '2023-10-26 07:52:46', '2023-10-26 07:52:46', NULL),
(104, '2321029', '2023-10-26', NULL, '0606 - Mesin CNC Milling Hartford', NULL, 'Proses 1', 'ALFIN EKO SAPUTRO', NULL, NULL, 236, 78, 13, 0, 0, NULL, NULL, NULL, '2023-10-26 08:10:24', '2023-10-26 08:10:24', NULL),
(105, '2311479', '2023-10-27', '2023-10-27', '0108 - Mesin Bubut', NULL, 'Proses 1 ke 2', 'M. ERFANDI', NULL, NULL, 189, 12, 26, 0, 0, NULL, NULL, NULL, '2023-10-27 02:21:37', '2023-10-27 02:23:27', NULL),
(106, '2311479', '2023-10-27', NULL, '0108 - Mesin Bubut', NULL, 'Proses 2', 'M. ERFANDI', NULL, NULL, 189, 12, 26, 0, 0, NULL, NULL, NULL, '2023-10-27 02:23:27', '2023-10-27 02:23:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history_surat_photos`
--

CREATE TABLE `history_surat_photos` (
  `id` int(11) NOT NULL,
  `id_history_surat` int(11) DEFAULT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history_surat_photos`
--

INSERT INTO `history_surat_photos` (`id`, `id_history_surat`, `url`) VALUES
(1, 1, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/YRMrh.jpg'),
(2, 2, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/ofbLJ.jpg'),
(3, 3, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/tgYfj.jpg'),
(4, 3, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/7sYRX.jpg'),
(5, 4, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/eYkEU.jpg'),
(6, 4, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/kTVkq.jpg'),
(7, 5, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/MIjw7.jpg'),
(8, 6, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/KzaWr.jpg'),
(9, 6, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/TpYoq.jpg'),
(10, 7, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/RDP9b.jpg'),
(11, 8, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/JVrfN.jpg'),
(12, 9, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/K8UuL.jpg'),
(13, 10, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/chhI1.jpg'),
(14, 10, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/WcvXp.jpg'),
(15, 11, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/lM2Ma.jpg'),
(16, 12, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/NLXtb.jpg'),
(17, 12, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/qbhfm.jpg'),
(18, 13, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/vRMFx.jpg'),
(19, 14, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/2MkKg.jpg'),
(20, 14, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Z3NIm.jpg'),
(21, 15, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Og0nm.jpg'),
(22, 16, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/yiyDS.jpg'),
(23, 17, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/I4nOK.jpg'),
(24, 17, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/PhWKU.jpg'),
(25, 18, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/VARFk.jpg'),
(26, 20, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/xVzG6.jpg'),
(27, 21, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/VYARd.jpg'),
(28, 21, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/l2pFH.jpg'),
(29, 22, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/385CD.jpg'),
(30, 22, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/WS01v.jpg'),
(31, 23, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/WDy7J.jpg'),
(32, 24, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/jSFz1.jpg'),
(33, 25, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/t02m1.jpg'),
(34, 25, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/jIgB9.jpg'),
(35, 26, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/QB9ML.jpg'),
(36, 27, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/YV0js.jpg'),
(37, 27, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/qFs9Z.jpg'),
(38, 28, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/XZAjW.jpg'),
(39, 30, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/HrSC9.jpg'),
(40, 31, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/yohMT.jpg'),
(41, 30, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/iU5Eo.jpg'),
(42, 31, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/7zsTE.jpg'),
(43, 29, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/WEnDa.jpg'),
(44, 29, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/MkcFH.jpg'),
(45, 32, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/uGopI.jpg'),
(46, 33, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/EpIZQ.jpg'),
(47, 34, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Qx1g1.jpg'),
(48, 34, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/itsVA.jpg'),
(49, 35, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/R7pWf.jpg'),
(50, 36, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Kmknm.jpg'),
(51, 37, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/yJwig.jpg'),
(52, 39, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/egyna.jpg'),
(53, 41, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/2ksXd.jpg'),
(54, 38, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/zWPFR.jpg'),
(55, 42, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/y85zX.jpg'),
(56, 40, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/RUiX8.jpg'),
(57, 43, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/qihxA.jpg'),
(58, 44, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/zoOe4.jpg'),
(59, 45, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Js8it.jpg'),
(60, 47, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/2gL8d.jpg'),
(61, 46, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/my0Xm.jpg'),
(62, 48, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/4sDxb.jpg'),
(63, 48, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Sxn5m.jpg'),
(64, 50, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/bLkR9.jpg'),
(65, 51, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/BI8Hk.jpg'),
(66, 52, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/gEUhb.jpg'),
(67, 53, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/PIzs1.jpg'),
(68, 54, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/UCVCz.jpg'),
(69, 54, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/kTafB.jpg'),
(70, 55, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/oWZxP.jpg'),
(71, 56, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/mokSz.jpg'),
(72, 57, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/NouRF.jpg'),
(73, 57, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/q3cY6.jpg'),
(74, 58, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/KcQBv.jpg'),
(75, 59, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/qWzQR.jpg'),
(76, 60, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/k7P6q.jpg'),
(77, 61, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/ERzVO.jpg'),
(78, 61, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/rBzzB.jpg'),
(79, 61, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/EGu9o.jpg'),
(80, 62, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Y62jf.jpg'),
(81, 62, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/DfHod.jpg'),
(82, 63, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/WnXts.jpg'),
(83, 64, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/rAAUE.jpg'),
(84, 65, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/aF2ob.jpg'),
(85, 66, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/zSHfa.jpg'),
(86, 66, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/LRyxf.jpg'),
(87, 67, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/WWo9b.jpg'),
(88, 68, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/YVGmn.jpg'),
(89, 68, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/GgcA5.jpg'),
(90, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/svv1s.jpg'),
(91, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/kcDoK.jpg'),
(92, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/yfx7A.jpg'),
(93, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/lpx99.jpg'),
(94, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/vwyXs.jpg'),
(95, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/3iZm7.jpg'),
(96, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/JLR3R.jpg'),
(97, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/RpeYg.jpg'),
(98, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/5x0DD.jpg'),
(99, 69, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/cNkwl.jpg'),
(100, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/fTE5I.jpg'),
(101, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/qg0p8.jpg'),
(102, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/SZ7Hc.jpg'),
(103, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Babdh.jpg'),
(104, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/CEPXa.jpg'),
(105, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/d2ISB.jpg'),
(106, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/xtenC.jpg'),
(107, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/ei8KU.jpg'),
(108, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Mah9j.jpg'),
(109, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Qbpp2.jpg'),
(110, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/xU62V.jpg'),
(111, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/2Dtod.jpg'),
(112, 70, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/wCSwt.jpg'),
(113, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/SXFzZ.jpg'),
(114, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/dPYyO.jpg'),
(115, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/RUxNQ.jpg'),
(116, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/IaOpm.jpg'),
(117, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/61eCh.jpg'),
(118, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/jum3p.jpg'),
(119, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/vhcAE.jpg'),
(120, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/eYY1U.jpg'),
(121, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/abV7l.jpg'),
(122, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/CYc2Q.jpg'),
(123, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/SbLqH.jpg'),
(124, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/C7T5M.jpg'),
(125, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/B8XhE.jpg'),
(126, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/0qk2D.jpg'),
(127, 71, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/prZrS.jpg'),
(128, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/SW1xs.jpg'),
(129, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/AtJ0j.jpg'),
(130, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/63Bry.jpg'),
(131, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/9xLbP.jpg'),
(132, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/X6QUi.jpg'),
(133, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/R1pjD.jpg'),
(134, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/41rzx.jpg'),
(135, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/COgUd.jpg'),
(136, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/cIOpY.jpg'),
(137, 72, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/4C8FB.jpg'),
(138, 73, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/scsJ5.jpg'),
(139, 74, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/zhY3R.jpg'),
(140, 75, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/sDDi2.jpg'),
(141, 75, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/3W5Ej.jpg'),
(142, 76, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/azhP0.jpg'),
(143, 77, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/gelng.jpg'),
(144, 78, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/J2y0m.jpg'),
(145, 79, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Yhfyo.jpg'),
(146, 80, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/CncV2.jpg'),
(147, 81, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/EQmqN.jpg'),
(148, 82, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/MF1Mm.jpg'),
(149, 83, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/4Vpgo.jpg'),
(150, 84, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/amEXD.jpg'),
(151, 85, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/TxEss.jpg'),
(152, 86, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/ocwVI.jpg'),
(153, 87, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/7bLcX.jpg'),
(154, 88, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/gh5C9.jpg'),
(155, 89, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/2xbZu.jpg'),
(156, 90, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/fHdBo.jpg'),
(157, 91, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/boYB6.jpg'),
(158, 92, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/NzaPr.jpg'),
(159, 93, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/Hn4WQ.jpg'),
(160, 94, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/k0Ess.jpg'),
(161, 95, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/fuOjj.jpg'),
(162, 96, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/zWDK5.jpg'),
(163, 97, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/ouMWx.jpg'),
(164, 98, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/VcBgF.jpg'),
(165, 99, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/lRZ97.jpg'),
(166, 100, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/oAe5e.jpg'),
(167, 101, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/YCqlS.jpg'),
(168, 102, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/mmbgk.jpg'),
(169, 103, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/pyOUg.jpg'),
(170, 104, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/7MhOe.jpg'),
(171, 105, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/8SXmi.jpg'),
(172, 106, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-proses/22BMy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `master_mesins`
--

CREATE TABLE `master_mesins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `keterangan` text NOT NULL,
  `poin` int(11) NOT NULL DEFAULT 1,
  `is_gudang_finish` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_mesins`
--

INSERT INTO `master_mesins` (`id`, `kode`, `nama`, `keterangan`, `poin`, `is_gudang_finish`, `created_at`, `updated_at`) VALUES
(1, '123-456-789', 'ABC-10', 'berfungsi dengan lancar', 1, 0, '2023-05-26 02:51:47', '2023-05-26 02:51:47'),
(2, '488-789-123', 'BCA-22', 'berfungsi dengan lancar', 1, 0, '2023-05-26 02:51:47', '2023-05-26 02:51:47'),
(4, '000xx', 'Gudang Finish', 'Finsih', 1, 1, '2023-09-21 09:03:16', '2023-09-23 03:32:44'),
(5, '0101', '0101 - Mesin Bubut 1 meter Cina', '-', 1, 0, '2023-09-29 02:43:04', '2023-09-29 06:52:31'),
(6, '0102', '0102 - Mesin Bubut 1 meter Howa', '-', 1, 0, '2023-09-29 02:44:46', '2023-09-29 06:53:05'),
(7, '0103', '0103 - Mesin Bubut', '-', 1, 0, '2023-09-29 02:45:40', '2023-09-29 06:53:20'),
(8, '0104', '0104 - Mesin Bubut', '-', 1, 0, '2023-09-29 02:46:10', '2023-09-29 06:53:36'),
(9, '0105', '0105 - Mesin Bubut 1 meter Wisser', '-', 1, 0, '2023-09-29 02:46:39', '2023-09-29 06:53:48'),
(10, '0106', '0106 - Mesin Bubut 2 meter Baoji', '-', 1, 0, '2023-09-29 02:47:09', '2023-09-29 06:53:59'),
(11, '0107', '0107 - Mesin Bubut 4 meter', '-', 1, 0, '2023-09-29 02:47:31', '2023-09-29 06:54:13'),
(12, '0108', '0108 - Mesin Bubut', '-', 1, 0, '2023-09-29 02:48:24', '2023-09-29 06:54:32'),
(13, '0201', '0201 - Mesin Milling Vertikal', '-', 1, 0, '2023-09-29 02:49:02', '2023-09-29 06:54:42'),
(14, '0202', '0202 - Mesin Milling Universal', '-', 1, 0, '2023-09-29 02:49:36', '2023-09-29 06:55:01'),
(15, '0203', '0203 - Mesin Milling Vertikal', '-', 1, 0, '2023-09-29 02:49:52', '2023-09-29 06:55:17'),
(16, '0204', '0204 - Mesin Milling Stik', '-', 1, 0, '2023-09-29 02:50:24', '2023-09-29 06:55:48'),
(17, '0205', '0205 - Mesin Milling Universal', '-', 1, 0, '2023-09-29 02:50:41', '2023-09-29 06:55:30'),
(18, '0206', '0206 - Mesin Milling Spiral', '-', 1, 0, '2023-09-29 02:51:11', '2023-09-29 06:56:11'),
(19, '0207', '0207 - Mesin Milling Bevel', '-', 1, 0, '2023-09-29 02:51:35', '2023-09-29 07:25:23'),
(20, '0208', '0208 - Mesin Milling Rack Gear', '-', 1, 0, '2023-09-29 02:51:52', '2023-09-29 06:56:45'),
(21, '0209', '0209 - Mesin Milling Bevel', '-', 1, 0, '2023-09-29 02:52:22', '2023-09-29 06:57:00'),
(22, '0210', '0210 - Mesin Milling Bevel', '-', 1, 0, '2023-09-29 02:52:42', '2023-09-29 06:57:10'),
(23, '0211', '0211 - Mesin Milling', '-', 1, 0, '2023-09-29 02:53:53', '2023-09-29 06:57:20'),
(24, '0212', '0212 - Mesin Milling', '-', 1, 0, '2023-09-29 02:54:19', '2023-09-29 06:57:32'),
(25, '0213', '0213 - Mesin Milling', '-', 1, 0, '2023-09-29 02:54:42', '2023-09-29 06:57:47'),
(26, '0214', '0214 - Mesin Milling Horisontal', '-', 1, 0, '2023-09-29 02:55:10', '2023-09-29 06:58:01'),
(27, '0215', '0215 - Mesin Milling Vertikal', '-', 1, 0, '2023-09-29 02:55:32', '2023-09-29 06:58:40'),
(28, '0216', '0216 - Mesin Milling Universal', '-', 1, 0, '2023-09-29 02:56:16', '2023-09-29 06:58:52'),
(29, '0217', '0217 - Mesin Milling Vertikal 2 meter', '-', 1, 0, '2023-09-29 02:57:01', '2023-09-29 06:59:07'),
(30, '0301', '0301 - Mesin Bor Tap Matic', '-', 1, 0, '2023-09-29 02:57:50', '2023-09-29 06:59:18'),
(31, '0302', '0302 - Mesin Bor Tap', '-', 1, 0, '2023-09-29 02:58:17', '2023-09-29 06:59:27'),
(32, '0303', '0303 - Mesin Bor Tap', '-', 1, 0, '2023-09-29 02:58:38', '2023-09-29 06:59:40'),
(33, '0304', '0304 - Mesin Bor Tap', '-', 1, 0, '2023-09-29 02:58:59', '2023-09-29 06:59:55'),
(34, '0305', '0305 - Mesin Bor Radial Besar', '-', 1, 0, '2023-09-29 02:59:19', '2023-09-29 07:00:07'),
(35, '0306', '0306 - Mesin Bor Radial Kecil', '-', 1, 0, '2023-09-29 03:00:31', '2023-09-29 07:00:17'),
(36, '0307', '0307 - Mesin Bor Vertikal', '-', 1, 0, '2023-09-29 03:00:55', '2023-09-29 07:00:27'),
(37, '0308', '0308 - Mesin Bor Vertikal', '-', 1, 0, '2023-09-29 03:01:11', '2023-09-29 07:00:37'),
(38, '0401', '0401 - Mesin Hobbing Kashifuji', '-', 1, 0, '2023-09-29 03:01:45', '2023-09-29 07:00:47'),
(39, '0402', '0402 - Mesin Hobbing Pfauter 600', '-', 1, 0, '2023-09-29 03:02:00', '2023-09-29 07:00:58'),
(40, '0403', '0403 - Mesin Hobbing Shaping', '-', 1, 0, '2023-09-29 03:02:15', '2023-09-29 07:01:08'),
(41, '0404', '0404 - Mesin Hobbing Pfauter 1000', '-', 1, 0, '2023-09-29 03:02:29', '2023-09-29 07:01:18'),
(42, '0405', '0405 - Mesin Hobbing Seiwa', '-', 1, 0, '2023-09-29 03:02:54', '2023-09-29 07:01:33'),
(43, '0406', '0406 - Mesin Hobbing Nihon Kikkai', '-', 1, 0, '2023-09-29 03:03:08', '2023-09-29 07:01:46'),
(44, '0407', '0407 - Mesin Hobbing Kashifuji', '-', 1, 0, '2023-09-29 03:03:28', '2023-09-29 07:02:00'),
(45, '0408', '0408 - Mesin Hobbing Hoblon Kecil', '-', 1, 0, '2023-09-29 03:04:14', '2023-09-29 07:02:17'),
(46, '0409', '0409 - Mesin Hobbing Karatsu 2 meter', '-', 1, 0, '2023-09-29 03:04:30', '2023-09-29 07:02:28'),
(47, '0501', '0501 - Mesin Stik Lubang/ Internal', '-', 1, 0, '2023-09-29 03:05:12', '2023-09-29 07:04:01'),
(48, '0502', '0502 - Mesin Stik Lubang/ Internal', '-', 1, 0, '2023-09-29 03:05:33', '2023-09-29 07:04:23'),
(49, '0503', '0503 - Mesin Skrap', '-', 1, 0, '2023-09-29 03:05:52', '2023-09-29 07:04:33'),
(50, '0504', '0504 - Mesin Skrap', '-', 1, 0, '2023-09-29 03:06:08', '2023-09-29 07:04:45'),
(51, '0505', '0505 - Mesin Skrap', '-', 1, 0, '2023-09-29 03:06:23', '2023-09-29 07:06:40'),
(52, '0506', '0506 - Mesin Skrap', '-', 1, 0, '2023-09-29 03:06:45', '2023-09-29 07:06:57'),
(53, '0601', '0601 - Mesin CNC Bubut 1500', '-', 1, 0, '2023-09-29 03:07:21', '2023-09-29 07:07:16'),
(54, '0602', '0602 - Mesin CNC Bubut 1500', '-', 1, 0, '2023-09-29 03:07:40', '2023-09-29 07:13:25'),
(55, '0603', '0603 - Mesin CNC Bubut 500 Leadwell', '-', 1, 0, '2023-09-29 03:07:58', '2023-09-29 07:13:37'),
(56, '0604', '0604 - Mesin CNC Bubut 1500', '-', 1, 0, '2023-09-29 03:08:15', '2023-09-29 07:13:46'),
(57, '0605', '0605 - Mesin CNC Bubut Worm', '-', 1, 0, '2023-09-29 03:08:30', '2023-09-30 02:02:14'),
(58, '0607', '0607 - Mesin CNC Milling Haas', '-', 1, 0, '2023-09-29 03:08:43', '2023-09-29 07:14:15'),
(59, '0608', '0608 - Mesin CNC Laser Marking', '-', 1, 0, '2023-09-29 03:09:00', '2023-09-29 07:14:35'),
(60, '0609', '0609 - Mesin CNC Wirecut', '-', 1, 0, '2023-09-29 03:09:14', '2023-09-29 07:14:46'),
(61, '0701', '0701 - Mesin Gergaji Bandsaw 200', '-', 1, 0, '2023-09-29 03:09:38', '2023-09-29 07:14:57'),
(62, '0702', '0702 - Mesin Gergaji Bandsaw 400', '-', 1, 0, '2023-09-29 03:09:50', '2023-09-29 07:15:07'),
(63, '0703', '0703 - Mesin Gergaji Bandsaw Spie', '-', 1, 0, '2023-09-29 03:10:03', '2023-09-29 07:15:18'),
(64, '0704', '0704 - Mesin Gergaji Bandsaw Feeder 400', '-', 1, 0, '2023-09-29 03:10:16', '2023-09-29 07:15:31'),
(65, '0705', '0705 - Mesin Gergaji Bandsaw Feeder 250', '-', 1, 0, '2023-09-29 03:10:30', '2023-09-29 07:15:51'),
(66, '0801', '0801 - Mesin Grinding Pisau Hobbing', '-', 1, 0, '2023-09-29 03:10:53', '2023-09-29 07:16:04'),
(67, '0802', '0802 - Mesin Grinding Shaft', '-', 1, 0, '2023-09-29 03:11:04', '2023-09-29 07:16:16'),
(68, '0803', '0803 - Mesin Grinding Surface', '-', 1, 0, '2023-09-29 03:11:16', '2023-09-29 07:16:26'),
(69, '0804', '0804 - Mesin Grinding Asah Pisau Panjang', '-', 1, 0, '2023-09-29 03:11:28', '2023-09-29 07:16:37'),
(70, '0901', '0901 - Mesin Hardening Oven Furnace Full Hardened', '-', 1, 0, '2023-09-29 03:12:02', '2023-09-29 07:16:55'),
(71, '0902', '0902 - Mesin Hardening Induction 25 KW', '-', 1, 0, '2023-09-29 03:12:20', '2023-09-29 07:17:07'),
(72, '0903', '0903 - Mesin Hardening Induction 120 KW', '-', 1, 0, '2023-09-29 03:12:37', '2023-09-29 07:11:33'),
(73, '1001', '1001 - Mesin Sandblast', '-', 1, 0, '2023-09-29 03:13:06', '2023-09-29 07:11:44'),
(74, '1002', '1002 - Mesin Sandblasting', '-', 1, 0, '2023-09-29 03:13:19', '2023-09-29 07:12:23'),
(75, '1101', '1101 - Mesin Press 50T', '-', 1, 0, '2023-09-29 03:13:40', '2023-09-29 07:12:37'),
(76, '1102', '1102 - Mesin Las Argon', '-', 1, 0, '2023-09-29 03:13:52', '2023-09-29 07:12:53'),
(77, '1201', '1201 - Mesin Broaching', '-', 1, 0, '2023-09-29 03:14:15', '2023-09-29 07:13:11'),
(78, '0606', '0606 - Mesin CNC Milling Hartford', '-', 1, 0, '2023-09-30 02:01:46', '2023-09-30 02:03:32'),
(79, '0000', 'Gudang Finish', '-', 1, 1, '2023-10-16 03:44:22', '2023-10-16 03:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `master_operators`
--

CREATE TABLE `master_operators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `NPWP` varchar(500) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `jenis_operator` varchar(500) NOT NULL,
  `scan_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_operators`
--

INSERT INTO `master_operators` (`id`, `kode`, `nama`, `NPWP`, `alamat`, `jenis_operator`, `scan_count`, `created_at`, `updated_at`) VALUES
(1, 'AS02', 'Andi Setiawan', '1224234-234', 'Jalan Basuki Rahmat no. 8–12, Jalan Embong Malang no. 1–31', 'mesin bubut', 26, '2023-05-26 02:51:47', '2023-10-05 06:39:00'),
(2, 'AS01', 'Bagas Bagus', '1224234-234', 'Jalan Siwalankerto No. 121-131 Wonocolo', 'mesin pencampur', 13, '2023-05-26 02:51:47', '2023-08-31 10:04:13'),
(3, 'AS03', 'Wong Fei Hung', '122222', 'Dimana saja', '?', 0, '2023-09-14 01:26:44', '2023-09-14 01:26:44'),
(4, '-', 'Adi', '-', '-', 'Mesin', 1, '2023-09-23 03:22:21', '2023-10-05 07:52:45'),
(5, 'A001', 'AL MUKMIN CHAKIM', '-', 'Rungkut Kidul Pesantren no 14A', '-', 6, '2023-09-23 03:58:29', '2023-10-13 06:59:55'),
(6, 'A002', 'ARIF WINARDI', '-', 'Bebekan Pereng', '-', 3, '2023-09-23 03:59:52', '2023-10-13 07:00:21'),
(7, 'A003', 'ARIF NURFIANTO', '-', 'Dsn Sumber RT31 RW06 Kel Garon Kec Balerejo', '-', 3, '2023-09-23 04:00:42', '2023-10-13 07:00:51'),
(8, 'A004', 'ACHMAD IVAN RIZKY', '-', 'Jl. Kali Ngebel, Pakunden - Sukorejo', '-', 2, '2023-09-23 04:01:31', '2023-10-13 07:01:17'),
(9, 'A005', 'AJI ACHMAD SAKIR', '-', 'JL. Rungkut Kidul 5 Majemuk No. 3', '-', 2, '2023-09-23 04:02:17', '2023-10-13 07:01:41'),
(10, 'A006', 'AJI BUDI WIBOWO', '-', 'Dsn Sewan Ds. Palrejo RT01/RW01, Sumobito', '-', 2, '2023-09-23 04:03:00', '2023-10-13 07:02:04'),
(11, 'A007', 'ARIS MUJIANTO', '-', 'JL Tenggunung Karya 3/20', '-', 2, '2023-09-23 04:05:42', '2023-10-13 07:02:30'),
(12, 'A008', 'ACHMAD HAKAM RIZA', '-', 'DSN KEJAMBON', '-', 2, '2023-09-23 04:06:31', '2023-10-13 07:02:52'),
(13, 'A009', 'ALFIN EKO SAPUTRO', '-', 'DSN KARANGSARI, DESA BLIMBINGSARI, SOOKO', '-', 2, '2023-09-23 04:06:57', '2023-10-13 07:03:15'),
(14, 'B001', 'BUDI PRASTIYONO', '-', 'Jl. Kedung Mangu Selatan IIA /27A', '-', 2, '2023-09-23 04:07:35', '2023-10-13 07:03:40'),
(15, 'B002', 'BISMA SETYAWAN', '-', 'Dsn Turus RT031/RW008, Kel.Ternyang, Sumber Pucung', '-', 2, '2023-09-23 04:08:07', '2023-10-13 07:04:04'),
(16, 'D001', 'DWI NURDIAN', '-', 'Jl. Kedung Mangu Selatan IIA /31', '-', 2, '2023-09-23 04:09:20', '2023-10-13 07:04:24'),
(18, 'H001', 'HARI SUYANTO', '-', 'Dusun Sewan Ds Palrejo Kec Sumobito- Jombang', '-', 2, '2023-09-23 04:10:40', '2023-10-13 07:04:46'),
(19, 'H002', 'HENGKY WIJANANTO', '-', 'JL.Pilang Madya 15 RT1 RW1 Kel Pilangmbargo Kec Katoharjo', '-', 3, '2023-09-23 04:11:31', '2023-10-13 07:05:17'),
(20, 'I001', 'ITHAF AQIL AMRULLOH', '-', 'DSN. CARUK WETAN', '-', 2, '2023-09-23 04:12:19', '2023-10-13 07:05:43'),
(21, 'J001', 'JAMAL', '-', 'JL. Raya Slorok RT015 RW04 Kronengan', '-', 2, '2023-09-23 04:12:43', '2023-10-13 07:06:06'),
(22, 'J002', 'JEFRY ARKADIA SANDY', '-', 'KRAJAN', '-', 2, '2023-09-23 04:13:20', '2023-10-13 07:06:25'),
(23, 'K001', 'KHUSNUL QOMAR', '-', 'Raya Benowo 24', '-', 2, '2023-09-23 04:13:42', '2023-10-13 07:06:47'),
(24, 'K002', 'KARSONO', '-', 'Dusun Karangtalun RT004/RW004', '-', 2, '2023-09-23 04:14:03', '2023-10-13 07:07:07'),
(25, 'M001', 'MOCHAMAD ARIFIN', '-', 'Dsn Juwet - Dukuh Dimoro RT003 RW09 Mojoagung - Jombang', '-', 2, '2023-09-23 04:14:37', '2023-10-13 07:07:27'),
(26, 'M002', 'M. ERFANDI', '-', 'Kedung Mangu Selatan gg IIA/27', '-', 2, '2023-09-23 04:15:25', '2023-10-13 07:07:48'),
(27, 'M003', 'MOCH. HADI SUYANTO', '-', 'JL.Dsn. Sewan Ds. Palrejo Kec.Sumobito Kab.Jombang', '-', 2, '2023-09-23 04:15:42', '2023-10-13 07:08:12'),
(28, 'M004', 'MOHAMMAD ADAM MAULANA', '-', 'KLEPEK UTARA RT009 RW004 KEL.SUKOIBER KEC. GUDO, JOMBANG', '-', 2, '2023-09-23 04:16:29', '2023-10-13 07:08:36'),
(29, 'O001', 'OKIK WAHYU CANDRA PAMUNGKAS', '-', 'Ds. Mojorejo RT16 RW03', '-', 3, '2023-09-23 04:16:57', '2023-10-13 07:09:15'),
(30, 'R001', 'RAHMAD AMANAN', '-', 'Dusun  Simbar II RT/RW 01/01, Desa Tampo Cluring Banyuwangi', '-', 2, '2023-09-23 04:17:18', '2023-10-13 07:09:50'),
(31, 'R002', 'RIAMAN', '-', 'Glagah Ds. Banyulegi Kec. Dawarblandong- Mojokerto', '-', 2, '2023-09-23 04:17:38', '2023-10-13 07:10:10'),
(32, 'S001', 'SADERI', '-', 'Lingkungan Sutojayan RT01 RW01 Kec Sutojayan Blitar', '-', 2, '2023-09-23 04:18:05', '2023-10-13 07:10:33'),
(33, 'S002', 'SUNARTO', '-', 'GLONGGONG RT017 RW004, TEMPURSARI, WUNGU', '-', 3, '2023-09-23 04:18:24', '2023-10-13 07:11:05'),
(34, 'Y001', 'YANUAR RUDIYANTO', '-', 'JL Ikan Gurami 3/6 Surabaya', '-', 3, '2023-09-23 04:19:17', '2023-10-13 07:11:39'),
(35, 'S003', 'SUPRIHADI', '-', 'Kedungboto RT016/003', '-', 3, '2023-09-23 04:19:36', '2023-10-13 07:12:03'),
(37, 'T001', 'TEDDY FIRJATULLOH', '-', 'Dsn Cangkringmalang RT002 RW005 Ds Sidomulyo Kec. Megaluh, Kab Jombang, 61457', '-', 4, '2023-09-25 01:12:43', '2023-10-13 07:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `master_pegawais`
--

CREATE TABLE `master_pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `NPWP` varchar(500) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `provinsi` varchar(500) NOT NULL,
  `kota` varchar(500) NOT NULL,
  `kecamatan` varchar(500) NOT NULL,
  `kelurahan` varchar(500) NOT NULL,
  `kode_pos` varchar(500) NOT NULL,
  `no_telp` varchar(500) NOT NULL,
  `fax` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `kontak` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_pegawais`
--

INSERT INTO `master_pegawais` (`id`, `kode`, `nama`, `NPWP`, `alamat`, `provinsi`, `kota`, `kecamatan`, `kelurahan`, `kode_pos`, `no_telp`, `fax`, `email`, `kontak`, `password`, `created_at`, `updated_at`) VALUES
(1, 'AS02', 'Andi Setiawan', '1224234-234', 'taman alamanda blok d. 27', 'jawa timur', 'surabaya', 'sidoarjo', 'Buduran', '34535', '083123234', '45456', 'tes1@gmail.com', '1956234345', 'MakanSateEnak_22', '2023-05-26 02:51:47', '2023-05-26 02:51:47'),
(2, 'BB01', 'Bagas Bagus', '1224234-234', 'Jalan Siwalankerto No. 121-131 Wonocolo', 'jawa timur', 'surabaya', 'wonocolo', '-', '1235', '083123234', '45456', 'tes2@gmail.com', '0813666345', 'SukaMakanRujak_69', '2023-05-26 02:51:47', '2023-05-26 02:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `master_poins`
--

CREATE TABLE `master_poins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(500) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `keterangan` text NOT NULL,
  `scan_count` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_preorders`
--

CREATE TABLE `master_preorders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(500) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_barang` varchar(500) DEFAULT NULL,
  `customer` varchar(500) DEFAULT NULL,
  `quantity` varchar(500) DEFAULT NULL,
  `satuan` varchar(500) DEFAULT NULL,
  `explanation` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_preorders`
--

INSERT INTO `master_preorders` (`id`, `nomor`, `tanggal`, `nama_barang`, `customer`, `quantity`, `satuan`, `explanation`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '2310322', '2023-01-03', 'Gear 1', 'PT. KARUNIA ALAM SEGAR', '9', 'Set', 'Slitter N22 Fuji Versi Ori', 'Tidak ada catatan khusus di IRCII', '2023-05-26 02:51:47', '2023-09-14 00:48:22'),
(2, '2310323', '2023-01-03', 'Gear 2', 'CV. CIPTA AGUNG', '2', 'Pcs', 'Buat Baru Lock Nut ID=65 D=98mm T=20mm mat. S45C', 'Tidak ada catatan khusus di IRCII', '2023-05-26 02:51:47', '2023-09-14 00:51:37'),
(3, '2310324', '2023-02-03', 'Gear 3', 'CV. Jaya Lestari', '3', 'Pcs', 'Key 8 x 8 x 300', 'Tidak ada catatan khusus di IRCII', '2023-05-26 02:51:47', '2023-09-14 00:51:48'),
(4, '2310325', '2023-03-03', 'Gear 4', 'CV. CIPTA AGUNG', '2', 'Pcs', 'Buat Baru Lock Nut ID=65 D=98mm T=20mm mat. S45C', 'Tidak ada catatan khusus di IRCII', '2023-06-20 11:28:40', '2023-09-14 00:51:56'),
(5, '2310326', '2023-03-04', 'Gear 5', 'PT. UNTUNG MEGA PERKASA', '6', 'Pcs', 'Flange Tapper Penekan Roll mat. S45C', 'Tidak ada catatan khusus di IRCII', '2023-06-20 11:28:40', '2023-09-14 00:52:04'),
(6, '2310327', '2023-03-05', 'Gear 6', 'PT. Indofood CBP Sukses Makmur Tbk - Tugurejo', '24', 'Pcs', 'Gear - Bevel Z=16 MOD-20', 'Tidak ada catatan khusus di IRCII', '2023-06-20 11:28:40', '2023-09-14 00:52:12'),
(7, '2310328', '2023-03-06', 'Gear 7', 'PT. Indofood CBP Sukses Makmur Tbk - Tugurejo', '8', 'Pcs', 'Gear - Bevel Z=18', 'Tidak ada catatan khusus di IRCII', '2023-06-20 11:28:40', '2023-09-14 00:52:19'),
(8, '2310329', '2023-03-07', 'Gear 8', 'PT. Bintang Mulia Tehnik', '2', 'Pcs', 'Shaft Spline 8T (Profil Normal) Include Nut mat. VCN Induction', 'Tidak ada catatan khusus di IRCII', '2023-06-20 11:28:40', '2023-09-14 00:52:27'),
(9, '2310330', '2023-03-08', 'Gear 9', 'PT. Bintang Mulia Tehnik', '2', 'Pcs', 'Bush Splint 8T (Profil Normal) mat. VCN Induction', 'Tidak ada catatan khusus di IRCII', '2023-06-20 11:28:40', '2023-09-14 00:52:35'),
(10, '2310331', '2023-03-09', 'Gear 10', 'PT. Tri Ratna Diesel Indonesia', '2', 'Pcs', 'Jasa Induction Sprocket 10T', 'Tidak ada catatan khusus di IRCII', '2023-06-20 11:28:40', '2023-09-14 00:52:43'),
(11, '2311338', '2023-09-21', 'Rumah Bearing Roll Atas Cutt Slitter 302 S45C', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit III', '4', 'pcs', '-', '418434 ; U/ Roll Cutting Slitter 302 ; Sama Seperti Order 2311212', '2023-09-25 01:24:55', '2023-09-25 01:24:55'),
(12, '2311348', '2023-09-25', 'Pinion Gear 15T mat. SCM440 Induction', 'PT. PANCA TEHNIK', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(13, '2311349', '2023-09-25', 'Ring Gear 103T mat. S50C Induction', 'PT. PANCA TEHNIK', '1', 'Pcs', 'OD=420', 'OD=420', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(14, '2311350', '2023-09-25', 'Ring Slewing OD=418 mat. S45C Induction', 'PT. PANCA TEHNIK', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(15, '2311351', '2023-09-25', 'Shaft Joint 8/8/6T As Gearbox Implement Stable Saver', 'PT. KARYA MAJU LESTARI', '1', 'Pcs', '-', 'Set Terdiri Dari : Pinch Roller As Dan Pinch Roller Bearing (Pattern Kotak Dan Pattern Horizontal)', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(16, '2311352', '2023-09-25', 'Pinch Roller Omori Belakang', 'PT. Indofood CBP Sukses Makmur Tbk - Tambakaji', '4', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(17, '2311353', '2023-09-25', 'Plug In Pinion mat. VCN Induction', 'PT. WAHANA LENTERA RAYA', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(18, '2311354', '2023-09-26', 'Sok As Distributor SS Dia. 64 x 45mm', 'PT. KARUNIA ALAM SEGAR', '3', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(19, '2311355', '2023-09-26', 'Worm Gear Z=30 M=3 Lb As 25 (Pack PWD)', 'PT. KARUNIA ALAM SEGAR', '10', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(20, '2311356', '2023-09-26', 'Grip Tensile 100T Full Harden SKD11', 'CV. Mitra Jaya', '4', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(21, '2311357', '2023-09-26', 'Grip Tensile 50T Full Harden SKD11', 'CV. Mitra Jaya', '4', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-09-29 03:19:33', '2023-09-29 03:19:33'),
(22, '2311358', '2023-09-27', 'Perbaikan Lubang Snap Body Gearbox Sew 7,5KW', 'PT. Indofood Sukses Makmur Tbk Bogasari Division', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(23, '2311359', '2023-09-27', 'Pembuatan Wheel Helical Gear Z=23 mat. VCN150', 'PT. Indofood Sukses Makmur Tbk Bogasari Division', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(24, '2311360', '2023-09-27', 'Pembuatan Wheel Helical Gear Z=38 mat. VCN150', 'PT. Indofood Sukses Makmur Tbk Bogasari Division', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(25, '2311361', '2023-09-29', 'Worm Gear 20T S45C', 'PT. Kedawung Subur', '7', 'Pcs', '-', '1Pcs Worm + 1Pcs As Ulir', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(26, '2311362', '2023-09-29', 'Worm Shaft VCN Induction', 'PT. Kedawung Subur', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(27, '2311363', '2023-09-29', 'Worm Gear Laminasi mat. Bronze', 'CV. Putra Mitra Jaya', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(28, '2311364', '2023-09-04', 'Nylon Plate', 'PT. UNTUNG MEGA PERKASA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(29, '2311365', '2023-10-02', 'Helical Gear Z=40 D=87 x 25mm', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit VI', '1', 'Pcs', '-', '416765 ; U/ Mesin Circle', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(30, '2311366', '2023-10-02', 'Worm Gear 17T x M=3 D=62 x 43mm', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit VI', '1', 'Pcs', '-', '419812 ; U/ Mesin Circle', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(31, '2311367', '2023-10-02', 'Shaft Gear Worm K1', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit VI', '1', 'Pcs', '-', '423957 ; U/ Mesin Circle', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(32, '2311368', '2023-10-02', 'Sprocket RS60B1-032 Repair Harden', 'PT. Prima Untung Bersama ', '6', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(33, '2311369', '2023-10-02', 'Roda Gigi Z=21 Plastik (TWS)', 'PT. MEPOLY INDUSTRY', '2', 'Unit', '-', 'mat. S45C', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(34, '2311370', '2023-10-03', 'Crank Shaft Tokiwa', 'PT. KARUNIA ALAM SEGAR', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(35, '2311371', '2023-10-03', 'Roll Conveyor Pasang Mie', 'PT. KARUNIA ALAM SEGAR', '20', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(36, '2311372', '2023-10-03', 'Spur Gear Slitter CCK M=4 Z=31', 'PT. KARUNIA ALAM SEGAR', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(37, '2311373', '2023-10-03', 'V Pulley Air Expel Brush 45 x 28', 'PT. KARUNIA ALAM SEGAR', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(38, '2311374', '2023-10-03', 'Folding Clamp (Tucker Blade) For Cocktail Size : 23cm x 23cm Uk. 135 x 39 x 3mm mat. Nylon PA-6', 'PT. Suparma Tbk', '40', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(39, '2311375', '2023-10-03', 'Shaft Gear M=4 17T Induction VCN150 Berat 4,65Kg/Pcs ', 'CV. Mitra Jaya', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(40, '2311376', '2023-10-03', 'Induction Harden Bevel Gear Z=23 M=6', 'PT. Wings Surya', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(41, '2311377', '2023-10-03', 'Induction Harden Sub Gear Z=18 M=6,1', 'PT. Wings Surya', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(42, '2311378', '2023-10-03', 'Induction Harden Drive Gear Z=13 M=4', 'PT. Wings Surya', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(43, '2311379', '2023-10-03', 'Induction Harden Planet Gear Z=26 M=6,1', 'PT. Wings Surya', '6', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(44, '2311380', '2023-10-03', 'Induction Harden Planet Gear Z=26 M=5', 'PT. Wings Surya', '6', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(45, '2311381', '2023-10-04', 'Retainer Buat Sesuai Contoh', 'CV. Putra Mitra Jaya', '6', 'Pcs', '-', 'Baut S45C', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(46, '2311382', '2023-10-04', 'Roda Gigi OD=56 x ID=30 x T=40 x Z=20 mat. Bronze', 'PT. DOMUSINDO PERDANA', '1', 'Pcs', '-', 'Worm Wheel', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(47, '2311383', '2023-10-04', 'Gear - Bevel Z=36 Sealer 040', 'PT. Indofood CBP Sukses Makmur Tbk - Purwakarta', '20', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(48, '2311384', '2023-10-04', 'Helical Gear Induction Bagian Gigi S45C Berat 3,20Kg/Pcs', 'CV. Mitra Jaya', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(49, '2311385', '2023-10-05', 'Double Pulley 2B D=100 As=30 mat. S45C + Finishing Galvanized', 'PT. Roman Ceramic International', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(50, '2311386', '2023-10-05', 'Left Side Bean Chain Grate SPS-23-08-BB-016', 'PT. AJM GLOBAL PRATAMA', '20', 'Set', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(51, '2320974', '2023-10-02', 'Gear Dia. 15cm 13 Gigi  mat. S45C Induction', 'Bpk. Yohanes', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(52, '2320975', '2023-10-02', 'Gear Dia. 22cm 20 Gigi  mat. S45C Induction', 'Bpk. Yohanes', '3', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(53, '2320976', '2023-10-02', 'Gear Belahan Induction AISI4140 Berat 39,45Kg', 'MANDIRI RAYA TEKNIK', '1', 'Set', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(54, '2320977', '2023-10-03', 'As Rotor Ganti As', 'Bpk. Harun', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(55, '2320978', '2023-10-03', 'Ring D=52 x D=38.2 x 15 (Spie Contoh) mat. S45C', 'PT. KUSUMA TEKNIK PERSADA', '4', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(56, '2320979', '2023-10-03', 'Ring D=75 x D=55.1 x 10 (Spie Contoh) mat. S45C', 'PT. KUSUMA TEKNIK PERSADA', '3', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(57, '2320980', '2023-10-03', 'Spur Gear Z=30 M=2,5 Tebal 25 Spie 6 x 10', 'PT. Wirapetro Plastindo', '6', 'Pcs', '-', 'mat. SCM440 ; Ukuran Spie 6 x 5', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(58, '2320981', '2023-10-04', 'Spur Gear 32T mat S45C Induction Harden', 'PT. SIDO REJO PANGAN', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(59, '2320982', '2023-10-04', 'Timing Pulley 20T S45C (Ukuran Lubang Mengikuti Gambar)', 'Bpk. Pranoto', '10', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(60, '2320983', '2023-10-04', 'Plat Kotak + Baut + Bushing Nylon Besi UCP', 'Bpk. Pranoto', '30', 'Set', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(61, '2320984', '2023-10-05', 'Roda Crane Machining Lubang', 'CV. GRACIA PERTAMA', '3', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(62, '2320985', '2023-10-05', 'Pisau Hobbing M=4 Jasa Slep', 'PT. EFOD CIPTA SOLUSINDO', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(63, '2320986', '2023-10-05', 'Pisau Hobbing M=3,5 Jasa Slep', 'PT. EFOD CIPTA SOLUSINDO', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(64, '2320987', '2023-10-05', 'Pisau Hobbing M=3 Jasa Slep', 'PT. EFOD CIPTA SOLUSINDO', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(65, '2320988', '2023-10-05', 'Pisau Hobbing M=2,5 Jasa Slep', 'PT. EFOD CIPTA SOLUSINDO', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(66, '2320989', '2023-10-05', 'Pisau Hobbing M=2 Jasa Slep', 'PT. EFOD CIPTA SOLUSINDO', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(67, '2320990', '2023-10-05', 'Spur Gear 17T mat. VCN150 Induction Hardened (Posisi Gear)', 'PT. TIARA ABADI NUSANTARA JAYA', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(68, '2320991', '2023-10-05', 'Gigi Laminate Z=38 M=4 Kanan Kiri mat. Bronze', 'PT. KARYA MURNI INDOCIPTA', '2', 'Pcs', '-', '1Pcs Kanan + 1Pcs Kiri', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(69, '2320992', '2023-10-05', 'Pisau Potong Plastik Uk. 137,5 x 72 x 16mm mat. S50C', 'Karya Usaha Tehnik', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(70, '2320993', '2023-10-05', 'Pisau Hobbing M=10 Jasa Slep', 'PT. FASKIN MODUL PUTRA', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(71, '2320994', '2023-10-05', 'Pisau Hobbing RS120 Jasa Slep', 'PT. FASKIN MODUL PUTRA', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(72, '2320995', '2023-10-05', 'Pisau Hobbing M=15 Jasa Slep', 'PT. FASKIN MODUL PUTRA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(73, '2320996', '2023-10-05', 'Lock Pin D=20 P=260mm SCM440 Induction', 'Empat Jaya Lima Perkasa', '5', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(74, '2320997', '2023-10-05', 'Sprocket S45C Induction Berat 7,8Kg', 'Bpk. Eko', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-06 02:56:55', '2023-10-06 02:56:55'),
(75, '2311387', '2023-10-05', 'Helical Gear Induction Bagian Gigi S45C', 'CV. Mitra Jaya', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(76, '2311388', '2023-10-06', 'Folding Clamp (Tucker Blade) For Cocktail Size : 22cm x 22cm Uk. 130 x 34 x 3mm mat. Nylon PA-6', 'PT. Suparma Tbk', '20', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(77, '2311389', '2023-10-06', 'Timing Pulley 64-5M-25 Bore 10mm mat. S45C', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(78, '2311390', '2023-10-06', 'Timing Pulley 33-5M-25 Bore 10mm mat. S45C', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(79, '2311391', '2023-10-06', 'V-Pulley 1-A-OD 60mm mat. FC35', 'PT. Prima Untung Bersama ', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(80, '2311392', '2023-10-06', 'Joint Pipe Jasa Machining mat. SUS dari PT. CARBON', 'PT. CARBON & ELECTRIC', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(81, '2311393', '2023-10-09', 'Timing Pulley 40-T10-25 mat. Nylon + SUS304', 'PT. Prima Untung Bersama ', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(82, '2311394', '2023-10-09', 'Shaft Timing Pulley 37-T10-11 mat. SUS304', 'PT. Prima Untung Bersama ', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(83, '2311395', '2023-10-09', 'V-Pulley 12-SPA-212 Hole Bush 3535 mat. Cast Iron', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(84, '2311396', '2023-10-09', 'Balancing Pulley', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(85, '2311397', '2023-10-09', 'V-Pulley 3-B-OD=225 Hole Bush 2517 mat. Cast Iron', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(86, '2311398', '2023-10-09', 'Sprocket RS120B1-040 mat. S45C Harden', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(87, '2311399', '2023-10-09', 'Sprocket RS120B1-015 Bore 60mm mat. S45C Harden', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(88, '2311400', '2023-10-09', 'Jasa Buat Pulley D=115 x 190 x P=908,35mm', 'PT. ADYA BUANA PERSADA', '2', 'Pcs', '-', 'mat. Dari Adya Buana', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(89, '2311401', '2023-10-09', 'Worm Uk. OD=30mm x ID=14mm x L=113mm Teeth 4 mat. S45C', 'PT. Suparma Tbk', '3', 'Pcs', '-', 'Worm For Gearbox Bottom Slitter PM5 (Drawing PM0510028 Item No. 1 Rev 2)', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(90, '2311402', '2023-10-09', 'Worm Gear Uk. OD=45 x ID=19 x L=30 mat. S45C + AB2', 'PT. Suparma Tbk', '3', 'Pcs', '-', 'Worm For Gearbox Bottom Slitter PM5 (Drawing PM0510028 Item No. 2 Rev 2)', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(91, '2311403', '2023-10-09', 'Pen As Weigh Roll Corr V mat. VCN Induction (Profil Dudukan)', 'PT. Surya Rengo Containers', '10', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(92, '2311404', '2023-10-09', 'Hollow Bronze AB2 OD=85 ID=60 P=125mm', 'Maspion Unit I Divisi Stromking/BLG', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(93, '2311405', '2023-10-09', 'Modif Main Gearbox Cadangan Mesin R9', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit II', '1', 'Pcs', '-', 'Detail pengerjaan : Support Housing Bearing 2Pcs ; Tutup Kiri Gearbox 1Pcs ; Shaft Pendek OD=65 x 235mm 1Pcs ; Flange Kiri 1Pcs ; Flange Sisi Dalam 1Pcs', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(94, '2311406', '2023-10-09', 'Gigi Penghubung Speedometer Delta V82 mat. Shaft Gear Worm 19T SCM440 + PL', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit I', '2', 'Pcs', '-', '414541', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(95, '2311407', '2023-10-09', 'Flange Coupling Glue Roll B/F', 'PT. Surya Rengo Containers', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(96, '2311408', '2023-10-05', 'Pembuatan Helical Shaft 15T mat. AISI4140 Induction', 'PT. FOKUS JASA MITRA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(97, '2311409', '2023-10-05', 'Assy Rakit (Tidak Termasuk Bearing dan Seal)', 'PT. FOKUS JASA MITRA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(98, '2311410', '2023-10-10', 'Machining Plate Uk. 750 x 560 x 15mm', 'PT. Philip Armijn Teknik', '1', 'Pcs', '-', 'Machining 1 Sisi Sampai Tebal 15 / Sampai Rata ; Machining Dengan CNC Milling ; Termasuk Bor Tap 4 x M12', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(99, '2311411', '2023-10-10', 'Pulley 5M 36T Grinding Unit', 'PT. MADUKORO ENGINEERING', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(100, '2311412', '2023-10-10', 'Pulley 5M 44T Grinding Unit', 'PT. MADUKORO ENGINEERING', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(101, '2311413', '2023-10-10', 'Timing Pulley Gear 14M 34T mat. S45C Induction', 'PT. MITRA USAHA ABADI', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(102, '2311414', '2023-10-10', 'Jasa Machining Sleeve OD=71,9', 'PT. CARBON & ELECTRIC', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(103, '2311415', '2023-10-10', 'Jasa Machining Sleeve OD=51,9', 'PT. CARBON & ELECTRIC', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(104, '2311416', '2023-10-04', 'Rack Gear M=4 17T Induction VCN150 Berat 3Kg', 'CV. Mitra Jaya', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(105, '2311417', '2023-10-09', 'Helical Gear DUS 130 Induction SCM440 3Pcs', 'CV. Mitra Jaya', '1', 'Lot', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(106, '2311418', '2023-10-11', 'KTC-05-01 Sprocket RS50 60T mat. S45C Induction', 'PT. MADUKORO ENGINEERING', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(107, '2311419', '2023-10-11', 'Sprocket 12B2-027 Bore 45mm mat. S45C Harden', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(108, '2311420', '2023-10-03', 'As Rotor Ganti As', 'PT. SINCOZA JAYA INDONESIA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(109, '2311421', '2023-10-11', 'Spur Gear 68T PN.5G0132977 mat. SCM440', 'PT. Excellence Qualities Yarn', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(110, '2311422', '2023-10-11', 'Coupling Trasco GRMP 100/110 AA Modif Lubang PCD 135 + Modif Hole Bushing 2517', 'PT. Prima Untung Bersama ', '2', 'Set', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(111, '2311423', '2023-10-11', 'Plat Baja 20mm', 'PT. Indofood CBP Sukses Makmur Tbk - Tambakaji', '2', 'Pcs', '-', 'Flange Roll Press OD=340 ID=75 Tebal 20mm mat. S45C Round Bar', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(112, '2311424', '2023-10-12', 'Fix dan Moveable Plat Machining dan Profil Alur', 'PT. TENTREM SEJAHTERA', '1', 'Set', '-', '1 Set terdiri dari 1 Fix Plate dan 1 Moveable Plate', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(113, '2311425', '2023-10-12', 'Helical Gear 67T mat. S45C Induction', 'PT. MAHAKARYA NUSANTARA SEJAHTERA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(114, '2311426', '2023-10-12', 'Helical Shaft 14T mat. SCM440 Induction', 'PT. MAHAKARYA NUSANTARA SEJAHTERA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(115, '2311427', '2023-10-12', 'SPLINT SHAFT 24T MAT.SCM440 INDUCTION HARDENED', 'PT. MAHAKARYA NUSANTARA SEJAHTERA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(116, '2311428', '2023-10-12', 'BIAYA ASSEMBLY BONGKAR PASANG', 'PT. MAHAKARYA NUSANTARA SEJAHTERA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(117, '2311429', '2023-10-12', 'COUPLING 2XV019A MAT. AB2', 'PT. Surya Rengo Containers', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(118, '2311430', '2023-10-13', 'Jasa Induction Tail Round Sprocket', 'PT. TRI RATNA DIESEL INDONESIA', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(119, '2311431', '2023-10-13', 'Body Encoder For CP Loader', 'PT. INDOFOOD CBP SUKSES MAKMUR Tbk - Banyuasin', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(120, '2311432', '2023-10-14', 'REKONDISI HOUSING / DUDUKAN BEARING IMPELLER UNT BLOWER DAN BALANCING IMPELER 1500 rpm MAT.S45C', 'PT. KINGDOM INDAH', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(121, '2311433', '2023-10-14', 'SPUR GEAR M10 Z31 D,330 T60 D.AS80', 'PT. KARUNIA ALAM SEGAR', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(122, '2311434', '2023-10-14', 'Roll Conveyor Checker', 'PT. KARUNIA ALAM SEGAR', '7', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(123, '2311435', '2023-10-14', 'Worm Gear Follow Up Tokiwa', 'PT. KARUNIA ALAM SEGAR', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(124, '2311436', '2023-10-14', 'WORM GEAR Z30 M3 LbgAs 25 (PACK PWD)', 'PT. KARUNIA ALAM SEGAR', '10', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(125, '2311437', '2023-10-14', 'Slitter N22 Fuji Versi Ori', 'PT. KARUNIA ALAM SEGAR', '8', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(126, '2311438', '2023-10-14', 'BEVEL GEAR KAPALAN Z60', 'PT. KARUNIA ALAM SEGAR', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(127, '2311439', '2023-10-14', 'SPUR GEAR DF M8 Z27 D,50 TBL 60 SP 16X7', 'PT. KARUNIA ALAM SEGAR', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(128, '2311440', '2023-10-12', 'Roll Induction SCM440 Berat 58,40Kg/Pcs', 'CV. SEJAHTERA ABADI TEHNIK', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(129, '2311441', '2023-10-12', 'Roll Induction SCM440 Berat 90,75Kg/Pcs', 'CV. SEJAHTERA ABADI TEHNIK', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(130, '2320998', '2023-10-09', 'Worm Wheel Z=30 mat. S45C Induction', 'Bpk. Mauluddin', '1', 'Pcs', '-', '1Pcs Contoh Worm + 1Pcs As Worm', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(131, '2320999', '2023-10-09', 'As Rotor 16T mat. VCN Induction (Termasuk Pasang Presfit Pada Body Motor)', 'PT. KENCANA TEKNIKATAMA SENTOSA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(132, '2321000', '2023-10-09', 'Shaft Gear 13/6T mat. VCN Induction', 'PT. KENCANA TEKNIKATAMA SENTOSA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(133, '2321001', '2023-10-09', 'As Worm Bikin Ulir & Stik Gigi Dalam & Induction', 'Bengkel Alok / Bpk. Alex', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(134, '2321002', '2023-10-09', 'Worm Wheel Fraiz Z=40', 'Bengkel Alok / Bpk. Alex', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(135, '2321003', '2023-10-06', 'Gear 30T D=512 x 136mm S45C Induction Berat 114,30Kg/Pcs', 'BENGKEL MESIN DIAN', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(136, '2321004', '2023-10-06', 'Ring Plong D=167 x 44 Assab88 Induction Berat 1,20Kg', 'BENGKEL MESIN DIAN', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(137, '2321005', '2023-10-11', 'Sprocket RS100 20T Type A 1 mat. S45C Induction', 'Bpk. Herman - Malang', '15', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(138, '2321006', '2023-10-11', 'Sprocket RS100 30T Type A 1 mat. S45C Induction', 'Bpk. Herman - Malang', '15', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(139, '2321007', '2023-10-11', 'Shaft Helical Gear Induction SCM440 Berat 15,05Kg', 'Ibu Yani', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(140, '2321008', '2023-10-12', 'SPROCKET INDUCTION ', 'Bpk. ROCHIM', '13', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(141, '2321009', '2023-10-12', 'BIAYA SETTING', 'Bpk. ROCHIM', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(142, '2321010', '2023-10-12', 'Jasa machining roll potong 1mm kiri kanan', 'Bpk. Sularto', '96', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(143, '2321011', '2023-10-13', 'AS HEXAGON KUNCI 100 X L1200MM MAT.S45C', 'SEDERHANA TEKNIK (Bpk. Imam Muhsin)', '6', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-16 03:11:41', '2023-10-16 03:11:41'),
(144, '2311442', '2023-10-16', 'Helical Gear DUS 130 Induction SCM440 3Pcs', 'CV. Mitra Jaya', '1', 'Lot', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(145, '2311443', '2023-10-16', 'Rumah Bearing 22214 Bawah Aluminium + Cover', 'PT. Indofood CBP Sukses Makmur Tbk - Tambakaji', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(146, '2311444', '2023-10-16', 'Rumah Bearing 22213 Atas Aluminium + Cover', 'PT. Indofood CBP Sukses Makmur Tbk - Tambakaji', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(147, '2311445', '2023-10-16', 'Helical Gear 48T mat. 7210 Carburizing', 'PT. Prima Untung Bersama ', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(148, '2311446', '2023-10-16', 'Helical Shaft 8T mat. 7210 Carburizing', 'PT. Prima Untung Bersama ', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(149, '2311447', '2023-10-16', 'Timing Pulley 50-AT10K13-40 Bore 62mm mat. Aluminium', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(150, '2311448', '2023-10-16', 'Timing Pulley 50-AT10K13-40 Bore 35mm mat. Aluminium', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(151, '2311449', '2023-10-16', 'Sprocket 60T mat. SCM440 Induction', 'GOOD YEAR', '10', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(152, '2311450', '2023-10-16', 'Sprocket 19T mat. SCM440 Induction', 'GOOD YEAR', '10', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(153, '2311451', '2023-10-16', 'Sarangan Hammermill 650 x 510', 'PT. ADYA BUANA PERSADA', '7', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(154, '2311452', '2023-10-16', 'As Roller BT P=36 D=12 x 17 x 10', 'PT. ADYA BUANA PERSADA', '60', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(155, '2311453', '2023-10-16', 'Machining Housing Crane dan Repair Sock Gear', 'PT. LOGAMINDO SARIMULIA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(156, '2311454', '2023-10-16', 'Induction Harden Driven Gear Z=47 M=4', 'PT. Wings Surya', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(157, '2311455', '2023-10-16', 'Induction Harden Planet Gear Z=26 M=6,1', 'PT. Wings Surya', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(158, '2311456', '2023-10-16', 'Spiral Bevel Gear 28T Part 01', 'PT. MADUKORO ENGINEERING', '2', 'Pcs', '-', 'HCF-07-A', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(159, '2311457', '2023-10-16', 'Spiral Bevel Gear 28T Part 02', 'PT. MADUKORO ENGINEERING', '2', 'Pcs', '-', 'HCF-07-A', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(160, '2311458', '2023-10-16', 'Timing Pulley 19L 19 Aluminium', 'PT. MADUKORO ENGINEERING', '10', 'Pcs', '-', 'INME-SGL-01-01-12', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(161, '2311459', '2023-10-16', 'Timing Pulley Type L 13T Aluminium', 'PT. MADUKORO ENGINEERING', '10', 'Pcs', '-', 'INME-SGL-01-01-33-02', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(162, '2311460', '2023-10-17', 'Sepatu LID F Heater (Diral)', 'PT. KARUNIA ALAM SEGAR', '6', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(163, '2311461', '2023-10-17', 'Gear - Bevel Z=18', 'PT. INDOFOOD CBP SUKSES MAKMUR Tbk - Banyuasin', '27', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(164, '2311462', '2023-10-17', 'Gear - Bevel Z=36 Sealer 040', 'PT. INDOFOOD CBP SUKSES MAKMUR Tbk - Banyuasin', '18', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(165, '2321012', '2023-10-16', 'Gear 62T mat. S45C', 'Bpk. Stefanus', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(166, '2321013', '2023-10-16', 'Flends D=340 x D=150 x 24mm', 'PT. KUSUMA TEKNIK PERSADA', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(167, '2321014', '2023-10-16', 'Helical Gear Z=54 Induction Bagian Gigi Plat Berat 14,15Kg', 'Jaya Putramas', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(168, '2321015', '2023-10-16', 'As Helical Induction Bagian Gigi Plat Berat 5,05Kg', 'Jaya Putramas', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(169, '2321016', '2023-10-16', 'Worm Gear D=133,5mm Z=14 Fraiz + Lb Spie', 'BENGKEL MESIN DIAN', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(170, '2321017', '2023-10-16', 'Pegangan Honing Modif Panjang Gear', 'PT. INTERATLAS MURNI', '4', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(171, '2321018', '2023-10-17', 'Jasa Master EDM Clamp Mould Hangar', 'PT. GARUDA TOP PLASINDO', '1', 'Pcs', '-', 'mat. Tembaga Dari Pemesan', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(172, '2321019', '2023-10-17', 'Helical Gear Z=95 Induction S45C Berat 4kg/Pcs', 'Bengkel Orion', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-17 07:06:32', '2023-10-17 07:06:32'),
(173, '2311463', '2023-10-17', 'Sock Coupling Motor Hoist MPC 3,2T', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit VI', '1', 'Pcs', '-', '416489', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(174, '2311464', '2023-10-17', 'Gigi Pinion Z=23 MPC 3,2Ton', 'PT. Steel Pipe Industry Of Indonesia Tbk (PT. SPINDO Tbk) Unit VI', '2', 'Pcs', '-', '408261', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(175, '2311465', '2023-10-18', 'Jasa Sandblast Powerlock CL200 x 260D', 'PT. Prima Untung Bersama ', '1', 'Set', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(176, '2311466', '2023-10-18', 'Jasa Sandblast Powerlock CL090 x 130', 'PT. Prima Untung Bersama ', '14', 'Set', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(177, '2311467', '2023-10-18', 'Jasa Sandblast Powerlock CL160 x 210B', 'PT. Prima Untung Bersama ', '2', 'Set', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(178, '2311468', '2023-10-18', 'Jasa Sandblast Powerlock CL042 x 72B', 'PT. Prima Untung Bersama ', '1', 'Set', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(179, '2311469', '2023-10-18', 'Jasa Sandblast Powerlock CL038 x 63B', 'PT. Prima Untung Bersama ', '1', 'Set', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(180, '2311470', '2023-10-18', 'Timing Pulley 56-AT10-19 Bore 25mm mat. Cast Iron', 'PT. Prima Untung Bersama ', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(181, '2311471', '2023-10-18', 'Helical Gear 48T mat. 7210 Carburizing', 'PT. Prima Untung Bersama ', '3', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(182, '2311472', '2023-10-18', 'Helical Shaft 8T mat. 7210 Carburizing', 'PT. Prima Untung Bersama ', '7', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(183, '2311473', '2023-10-18', 'Ulir Shoulder Jasa Machining Sesuai Gambar', 'CV. Putra Mitra Jaya', '2', 'Pcs', '-', 'mat. Tembaga (Pemesan)', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(184, '2311474', '2023-10-18', 'Ring Penahan Jasa Machining Sesuai Gambar', 'CV. Putra Mitra Jaya', '24', 'Pcs', '-', 'mat. Aluminium Seri 6 (Pemesan)', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(185, '2311475', '2023-10-18', 'Bushing Penarik Jasa Machining Sesuai Gambar', 'CV. Putra Mitra Jaya', '8', 'Pcs', '-', 'mat. VCN150 (Pemesan)', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(186, '2311476', '2023-10-18', 'Pin 257 Buat Sesuai Contoh Include Material', 'CV. Putra Mitra Jaya', '10', 'Pcs', '-', 'mat. S45C', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(187, '2311477', '2023-10-18', 'Coupling Gear 50T Jasa Machining Profil Gear Dalam', 'PT. RAJA BESI', '8', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(188, '2311478', '2023-10-18', 'Spur Gear Kopling 50T mat. Assab705 Induction', 'PT. RAJA BESI', '2', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(189, '2311479', '2023-10-18', 'Helical Gear 37T mat. Assab705 Induction', 'PT. RAJA BESI', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(190, '2311480', '2023-10-18', 'Shaft Helical Gear mat. Assab705 Induction (Dudukan Motor Dirubah Dia. 30)', 'PT. RAJA BESI', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(191, '2321020', '2023-10-18', 'Main Shaft (Gigi Susun) Induction Bagian Gigi 2 Tempat Berat 3,15Kg', 'Jaya Putramas', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(192, '2321021', '2023-10-18', 'Machining Bubut + Bor Tanpa Kupingan Flange D=940 x 55 mat. Pemesan', 'Bpk. Agus Raharjo', '1', 'Pcs', '-', 'mat. Casting S45C (Pemesan)', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(193, '2321022', '2023-10-18', 'Rack Gear 92T mat S45C Induction', 'CV. WIJAYA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(194, '2321023', '2023-10-18', 'Pinion Shaft 14T mat SCM440 Induction', 'CV. WIJAYA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(195, '2321024', '2023-10-18', 'As Gigi Z=13 mat. SCM440', 'PURNAMADIA JAYA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-18 07:53:16', '2023-10-18 07:53:16'),
(196, '2321025', '2023-10-18', 'Pangkon Milling Bagian Atas', 'PURNAMADIA JAYA', '3', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-18 07:53:17', '2023-10-18 07:53:17'),
(197, '2321026', '2023-10-18', 'Pisau Hobbing M=3 Jasa Slep', 'Bpk. Gunawan', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(198, '2321027', '2023-10-18', 'Pisau Hobbing M=2,5 Jasa Slep', 'Bpk. Gunawan', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(199, '2321028', '2023-10-18', 'Pisau Hobbing M=5 Jasa Slep', 'Bpk. Gunawan', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(200, '2311481', '2023-10-19', 'Gear Cylinder D=610 x 96 x 120L Steel Alloy mat. ST60', 'AWECO INDOSTEEL PERKASA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(201, '2311482', '2023-10-19', 'Gear Cylinder D=610 x 96 x 80L Steel Alloy mat. ST60', 'AWECO INDOSTEEL PERKASA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(202, '2311483', '2023-10-19', 'Timing Pulley 12T10 Aluminium 6061 ', 'Weiss Tech', '6', 'Pcs', '-', '(22SJA-ROV M00 00 08)', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(203, '2311484', '2023-10-19', 'Timing Pulley 20T10 Polos Aluminium 6061 ', 'Weiss Tech', '2', 'Pcs', '-', '(22SJA-ROV M00 00 09)', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(204, '2311485', '2023-10-19', 'Timing Pulley 20T10 Konde Aluminium 6061 ', 'Weiss Tech', '2', 'Pcs', '-', '(22SJA-ROV M00 00 10)', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(205, '2311486', '2023-10-19', 'Gear - Spur Besi T30 W800 (M=2,5 D=80 x 25 mat. ST60 Induction Harden)', 'PT. Indofood CBP Sukses Makmur Tbk - Tambakaji', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-19 06:51:30', '2023-10-19 06:51:30'),
(206, '2311487', '2023-10-20', 'Helical Gear Dia. 54 x 30 Z=26', 'PT. KARUNIA ALAM SEGAR', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(207, '2311488', '2023-10-20', 'Sprocket 500C-Z=15 Bore 55mm mat. S45C Harden', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(208, '2311489', '2023-10-20', 'Spiral Bevel Gear Shaft 17/6T mat. VCN150 Harden', 'PT. RAJA BESI', '6', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(209, '2311490', '2023-10-20', 'Plat Bor Lubang 60mm', 'PT. SIER', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(210, '2311491', '2023-10-20', 'Timing Pulley 32-T10-23 Hole Bush 1210 mat. S45C', 'PT. Prima Untung Bersama ', '4', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(211, '2311492', '2023-10-20', 'Shaft Helical Gear 44T mat. 7210 Carburizing', 'PT. RAJA BESI', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(212, '2311493', '2023-10-20', 'Helical Gear 33T mat. 7210 Carburizing', 'PT. RAJA BESI', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(213, '2311494', '2023-10-21', 'Roda Gigi / Gear mat. VCN Uk. 2,5\" x 210cm Untuk Mesin Sandblast', 'AWECO INDOSTEEL PERKASA', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(214, '2311495', '2023-10-21', 'Bushing Drat Setelan mat. 4140', 'CV. CIPTA AGUNG', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(215, '2311496', '2023-10-23', 'Pembuatan Pinion Gear 32T mat. SCM440 Induction', 'PT. KINGDOM INDAH', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(216, '2311497', '2023-10-23', 'Pembuatan Pin D=12 x 61 mat. SCM440 Induction', 'PT. KINGDOM INDAH', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(217, '2311498', '2023-10-23', 'Pembuatan Shaft Gear 24T L180 mat. SCM440 Induction', 'PT. KINGDOM INDAH', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(218, '2311499', '2023-10-23', 'Pembuatan Helical Shaft Pinion 14T mat. SCM440 Induction', 'PT. KINGDOM INDAH', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(219, '2311500', '2023-10-23', 'Pembuatan Housing Bushing P220 mat. S45C', 'PT. KINGDOM INDAH', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(220, '2311501', '2023-10-24', 'Idle Shaft D=30 x 35 x 1092mm mat. ST60', 'PT. Roman Ceramic International', '25', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(221, '2311502', '2023-10-24', 'Power Shaft D=25 x 30 x 35 x 1262mm mat. ST60', 'PT. Roman Ceramic International', '15', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(222, '2311503', '2023-10-24', 'Spur Gear Z=50 Tebal 10mm', 'PT. KARUNIA ALAM SEGAR', '6', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(223, '2311504', '2023-10-24', 'Spur Gear Z=25 Gandeng Sprocket RS35 Z=20', 'PT. KARUNIA ALAM SEGAR', '10', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(224, '2311505', '2023-10-24', 'As Baling-Baling Agitator Powder', 'PT. KARUNIA ALAM SEGAR', '15', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(225, '2311506', '2023-10-24', 'As Baling-Baling Agitator Powder Baru', 'PT. KARUNIA ALAM SEGAR', '15', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(226, '2311507', '2023-10-24', 'Spur Gear Follow Up M=2 Z=12', 'PT. KARUNIA ALAM SEGAR', '5', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(227, '2311508', '2023-10-24', 'Perbaikan Flange Coupling Glue Roll', 'PT. Surya Rengo Containers', '1', 'Unit', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(228, '2311509', '2023-10-25', 'V Pulley 3-SPB-112 Hole Bush 1610 mat. Cast Iron', 'PT. Prima Untung Bersama ', '1', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(229, '2311510', '2023-10-25', 'Gear - Bevel Z=18', 'PT. INDOFOOD CBP SUKSES MAKMUR Tbk - Banyuasin', '27', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(230, '2311511', '2023-10-25', 'Gear - Bevel Z=36 Sealer 040', 'PT. INDOFOOD CBP SUKSES MAKMUR Tbk - Banyuasin', '18', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(231, '2311512', '2023-10-25', 'Gear Spiral Z=14 Kanan', 'PT. Indofood CBP Sukses Makmur Tbk - Purwakarta', '10', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(232, '2311513', '2023-10-25', 'Gear Spiral Z=14 Kanan + Sock', 'PT. Indofood CBP Sukses Makmur Tbk - Purwakarta', '10', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(233, '2311514', '2023-10-25', 'Jasa Induction Pin 45 x 83', 'CV. AB HYDRAULIC', '56', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(234, '2311515', '2023-10-25', 'Jasa Induction Pin 42 x 103', 'CV. AB HYDRAULIC', '68', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(235, '2311516', '2023-10-25', 'Jasa Induction Pin 45 x 108', 'CV. AB HYDRAULIC', '28', 'Pcs', '-', 'Tidak ada catatan khusus di CRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(236, '2321029', '2023-10-19', 'Plat Bor 228 Lubang', 'PT. SUMBER DINGIN', '1', 'Set', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(237, '2321030', '2023-10-20', 'Spur Gear Z=77 mat. S45C Induction', 'Bpk. Herman - Malang', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(238, '2321031', '2023-10-20', 'Spur Gear Z=23 mat. SCM440 Induction', 'Bpk. Herman - Malang', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(239, '2321032', '2023-10-20', 'Mata Punch Baut (mat. DC53 Astra Daido)', 'Bpk. Herman (CV. Tri Jaya Rolling)', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(240, '2321033', '2023-10-20', 'Plat Kotak + Baut + Bushing Nylon Besi', 'Bpk. Pranoto', '20', 'Set', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(241, '2321034', '2023-10-21', 'Bushing Bronze Jasa Buat Drat Dalam', 'Sumber Jaya', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(242, '2321035', '2023-10-24', 'Thread Roll Knife Panjang mat. DC53', 'Bpk. Herman (CV. Tri Jaya Rolling)', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(243, '2321036', '2023-10-24', 'Thread Roll Knife Pendek mat. DC53', 'Bpk. Herman (CV. Tri Jaya Rolling)', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(244, '2321037', '2023-10-24', 'Holder Poket D=38 x 25mm mat. Pemesan', 'CV. ANUGERAH SEJAHTERA TEKNINDO', '30', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(245, '2321038', '2023-10-24', 'As Hexagon 60 x 1250mm mat. S45C', 'SEDERHANA TEKNIK (Bpk. Imam Muhsin)', '2', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(246, '2321039', '2023-10-24', 'Sok Gear 22T mat. SCM', 'Empat Jaya Lima Perkasa', '1', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40'),
(247, '2321040', '2023-10-24', 'As Punch SCM440 Induction', 'DWI TUNGGAL PERKASA', '10', 'Pcs', '-', 'Tidak ada catatan khusus di IRCII', '2023-10-26 03:08:40', '2023-10-26 03:08:40');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_11_012131_master_pegawai_table', 1),
(6, '2023_03_11_012152_master_operator_table', 1),
(7, '2023_03_11_012204_master_mesin_table', 1),
(8, '2023_03_16_134636_create_scanns_table', 1),
(9, '2023_03_31_144018_master_preorder_table', 1),
(10, '2023_04_05_213500_history_mesin_table', 1),
(11, '2023_04_05_213814_history_surat_table', 1),
(12, '2023_04_05_213835_history_operator_table', 1),
(13, '2023_04_12_205206_history_gudang_table', 1),
(14, '2023_04_14_112239_create_scann_mesins_table', 1),
(15, '2023_04_19_200843_master_poin_table', 1),
(16, '2023_05_20_164639_history_poin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scanns`
--

CREATE TABLE `scanns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(500) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scann_mesins`
--

CREATE TABLE `scann_mesins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(500) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `remember_token` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin1@gmail.test', '2023-05-26 02:51:47', '$2y$10$P4ZuezrqqPOMx0VQVrDqmeFdzsgThJUnb7vpX7seRe8sXzG9vK3O6', 'U70Avd3scHeJCdmMRfZ7G9cEYhrkP5KpibnfUYdtDYzIkEuyZK5y80SIUmsf', '2023-05-26 02:51:47', '2023-05-26 02:51:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_gudangs`
--
ALTER TABLE `history_gudangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_mesins`
--
ALTER TABLE `history_mesins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_operators`
--
ALTER TABLE `history_operators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_poins`
--
ALTER TABLE `history_poins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_reject_customers`
--
ALTER TABLE `history_reject_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_surats`
--
ALTER TABLE `history_surats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_surat_photos`
--
ALTER TABLE `history_surat_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_mesins`
--
ALTER TABLE `master_mesins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_operators`
--
ALTER TABLE `master_operators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pegawais`
--
ALTER TABLE `master_pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_poins`
--
ALTER TABLE `master_poins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_preorders`
--
ALTER TABLE `master_preorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `scanns`
--
ALTER TABLE `scanns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scann_mesins`
--
ALTER TABLE `scann_mesins`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_gudangs`
--
ALTER TABLE `history_gudangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_mesins`
--
ALTER TABLE `history_mesins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_operators`
--
ALTER TABLE `history_operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_poins`
--
ALTER TABLE `history_poins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_reject_customers`
--
ALTER TABLE `history_reject_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_surats`
--
ALTER TABLE `history_surats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `history_surat_photos`
--
ALTER TABLE `history_surat_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `master_mesins`
--
ALTER TABLE `master_mesins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `master_operators`
--
ALTER TABLE `master_operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `master_pegawais`
--
ALTER TABLE `master_pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_poins`
--
ALTER TABLE `master_poins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_preorders`
--
ALTER TABLE `master_preorders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scanns`
--
ALTER TABLE `scanns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scann_mesins`
--
ALTER TABLE `scann_mesins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
