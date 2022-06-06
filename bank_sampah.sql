-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2022 at 12:33 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank_sampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `atm`
--

CREATE TABLE `atm` (
  `id` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `atm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atm`
--

INSERT INTO `atm` (`id`, `id_user`, `atm`) VALUES
(4, 25, 12345677),
(5, 26, 999999);

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator Website'),
(2, 'nasabah', 'Nasabah Bank Sampah');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 3),
(1, 7),
(2, 25),
(2, 26);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'safisafic4@gmail.com', 2, '2022-05-12 22:45:03', 1),
(2, '::1', 'saficfabiq@gmail.com', 1, '2022-05-12 22:45:54', 0),
(3, '::1', 'saficfabiq@gmail.com', 3, '2022-05-12 22:46:46', 1),
(4, '::1', 'saficfabiq@gmail.com', 3, '2022-05-13 04:12:16', 1),
(5, '::1', 'admin', NULL, '2022-05-29 08:26:22', 0),
(6, '::1', 'admin', NULL, '2022-05-29 08:26:33', 0),
(7, '::1', 'admin', NULL, '2022-05-29 08:31:53', 0),
(8, '::1', 'admin', 4, '2022-05-29 08:32:04', 0),
(9, '::1', 'loro', 5, '2022-05-29 08:34:40', 0),
(10, '::1', 'fikri', NULL, '2022-05-29 08:37:23', 0),
(11, '::1', 'saficfabiq123@gmail.com', 7, '2022-05-29 08:38:18', 1),
(12, '::1', 'saficfabiq123@gmail.com', 7, '2022-05-30 10:40:46', 1),
(13, '::1', 'saficfabiq@gmail.com', 3, '2022-05-30 12:13:53', 1),
(14, '::1', 'admin', NULL, '2022-05-30 12:21:27', 0),
(15, '::1', 'admin', NULL, '2022-05-30 12:21:53', 0),
(16, '::1', 'fikri', NULL, '2022-05-30 12:22:05', 0),
(17, '::1', 'admin', NULL, '2022-05-30 12:22:39', 0),
(18, '::1', 'saficfabiq123@gmail.com', 7, '2022-05-31 02:54:16', 1),
(19, '::1', 'saficfabiq123@gmail.com', 7, '2022-05-31 09:49:19', 1),
(20, '::1', 'saficfabiq123@gmail.com', 7, '2022-05-31 22:16:23', 1),
(21, '::1', 'saficfabiq123@gmail.com', 7, '2022-05-31 22:49:08', 1),
(22, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-01 06:47:36', 1),
(23, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-01 08:49:00', 1),
(24, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-01 08:49:26', 1),
(25, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-01 08:49:53', 1),
(26, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-01 08:51:39', 1),
(27, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-01 08:57:10', 1),
(28, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-01 11:43:51', 1),
(29, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-02 04:44:55', 1),
(30, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-02 11:40:17', 1),
(31, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-03 05:37:20', 1),
(32, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-03 09:22:54', 1),
(33, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 03:45:30', 1),
(34, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 03:53:13', 1),
(35, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 03:56:45', 1),
(36, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 04:08:31', 1),
(37, '::1', 'admin', NULL, '2022-06-04 04:16:00', 0),
(38, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 04:16:08', 1),
(39, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 04:46:24', 1),
(40, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-04 04:56:52', 1),
(41, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 04:59:38', 1),
(42, '::1', 'saficfabiq123@gmail.com', 7, '2022-06-04 05:01:30', 1),
(43, '::1', 'fikrisabiq@labtiunsil.onmicrosoft.com', 8, '2022-06-05 04:44:50', 1),
(44, '::1', 'fauzan@gmail.com', 9, '2022-06-05 05:00:23', 1),
(45, '::1', 'kuru@gmail.com', 16, '2022-06-05 07:48:22', 1),
(46, '::1', 'kuru', NULL, '2022-06-05 07:48:46', 0),
(47, '::1', 'kuru@gmail.com', 16, '2022-06-05 07:49:11', 1),
(48, '::1', 'fauzansaw', NULL, '2022-06-05 07:50:44', 0),
(49, '::1', 'fauzansaw@gmail.com', 9, '2022-06-05 07:51:10', 1),
(50, '::1', 'kuru@gmail.com', 16, '2022-06-05 07:55:12', 1),
(51, '::1', 'saficfabiq@gmail.com', 3, '2022-06-05 09:17:42', 1),
(52, '::1', 'fikri', NULL, '2022-06-05 10:08:32', 0),
(53, '::1', 'saficfabiq@gmail.com', 3, '2022-06-05 10:08:40', 1),
(54, '::1', 'kara', 17, '2022-06-05 10:09:32', 0),
(55, '::1', 'saficfabiq@gmail.com', 3, '2022-06-05 10:12:13', 1),
(56, '::1', 'kara@gmail.com', 18, '2022-06-05 10:12:47', 1),
(57, '::1', 'kara@gmail.com', 18, '2022-06-05 14:06:13', 1),
(58, '::1', 'kara@gmail.com', 18, '2022-06-05 14:06:35', 1),
(59, '::1', 'saficfabiq@gmail.com', 3, '2022-06-05 14:30:54', 1),
(60, '::1', 'kuru@gmail.com', 19, '2022-06-05 14:41:51', 1),
(61, '::1', 'saficfabiq@gmail.com', 3, '2022-06-05 15:06:59', 1),
(62, '::1', 'saficfabiq@gmail.com', 3, '2022-06-05 22:12:32', 1),
(63, '::1', 'fauzan@gmail.com', 24, '2022-06-05 23:46:55', 1),
(64, '::1', 'saficfabiq@gmail.com', 3, '2022-06-05 23:55:30', 1),
(65, '::1', 'kara@gmail.com', 25, '2022-06-06 03:00:39', 1),
(66, '::1', 'saficfabiq@gmail.com', 3, '2022-06-06 03:06:15', 1),
(67, '::1', 'kara@gmail.com', 25, '2022-06-06 03:27:39', 1),
(68, '::1', 'kara@gmail.com', 25, '2022-06-06 03:43:24', 1),
(69, '::1', 'saficfabiq@gmail.com', 3, '2022-06-06 03:48:56', 1),
(70, '::1', 'saficfabiq@gmail.com', 3, '2022-06-06 04:08:58', 1),
(71, '::1', 'saficfabiq@gmail.com', 3, '2022-06-06 04:20:56', 1),
(72, '::1', 'kuru@gmail.com', 26, '2022-06-06 04:25:42', 1),
(73, '::1', 'fikrisabiq@gmail.com', NULL, '2022-06-06 04:42:52', 0),
(74, '::1', 'saficfabiq@gmail.com', 3, '2022-06-06 04:43:03', 1),
(75, '::1', 'saficfabiq@gmail.com', 3, '2022-06-06 04:48:04', 1),
(76, '::1', 'kara@gmail.com', 25, '2022-06-06 04:53:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `id_kategori`, `jumlah`, `harga_jual`, `harga_beli`, `created_at`, `updated_at`) VALUES
(1, 'Minuman Kecil', 25, 5, 1000, 1200, '2022-05-09 20:50:06', '2022-06-06 16:15:27'),
(3, 'Kaca', 26, 10, 2000, 2000, '2022-05-09 11:04:34', '2022-06-06 16:15:39'),
(4, 'A4', 27, 5, 1234, 7890, '2022-05-09 11:22:15', '2022-06-06 16:17:59'),
(5, 'A3', 27, 27, 200, 100, '2022-05-10 22:21:13', '2022-06-06 16:18:10'),
(10, 'Galon Aqua', 25, 7, 1000, 500, '2022-06-04 17:02:48', '2022-06-06 16:18:17'),
(11, 'Tahu', 28, 5, 2000, 1500, '2022-06-06 16:22:17', '2022-06-06 16:49:44'),
(12, 'Kelapa', 28, 3, 3000, 1000, '2022-06-06 16:50:21', '2022-06-06 16:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `barang_hist`
--

CREATE TABLE `barang_hist` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_hist`
--

INSERT INTO `barang_hist` (`id`, `nama`, `id_kategori`, `jumlah`, `harga_jual`, `harga_beli`, `created_at`, `updated_at`) VALUES
(1, 'Minuman Kecil', 25, 5, 1000, 1200, '2022-05-09 20:50:06', '2022-06-06 16:15:27'),
(3, 'Kaca', 26, 10, 2000, 2000, '2022-05-09 11:04:34', '2022-06-06 16:15:39'),
(4, 'A4', 27, 5, 1234, 7890, '2022-05-09 11:22:15', '2022-06-06 16:17:59'),
(5, 'A3', 27, 27, 200, 100, '2022-05-10 22:21:13', '2022-06-06 16:18:10'),
(6, 'Kresek 250g', 11, 7, 5000, 3000, NULL, NULL),
(7, 'Sedotan 250g', 11, 8, 1000, 500, NULL, NULL),
(8, 'Kresek 250g', 11, 7, 1000, 500, NULL, NULL),
(9, 'Kresek 500g', 11, 0, 5000, 120, NULL, NULL),
(10, 'Galon Aqua', 25, 7, 1000, 500, '2022-06-04 17:02:48', '2022-06-06 16:18:17'),
(11, 'Tahu', 28, 5, 2000, 1500, '2022-06-06 16:22:17', '2022-06-06 16:49:44'),
(12, 'Kelapa', 28, 3, 3000, 1000, '2022-06-06 16:50:21', '2022-06-06 16:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `detail_keluar`
--

CREATE TABLE `detail_keluar` (
  `id` int(11) NOT NULL,
  `id_tranksaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_keluar`
--

INSERT INTO `detail_keluar` (`id`, `id_tranksaksi`, `id_barang`, `jumlah`, `total`) VALUES
(1, 4, 1, 27, 27000),
(2, 4, 3, 21, 42000),
(3, 5, 1, 5, 5000),
(4, 5, 3, 5, 10000),
(5, 6, 3, 5, 10000),
(6, 6, 11, 5, 10000),
(7, 7, 11, 5, 10000),
(8, 7, 12, 2, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_masuk`
--

CREATE TABLE `detail_masuk` (
  `id` int(11) NOT NULL,
  `id_tranksaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_masuk`
--

INSERT INTO `detail_masuk` (`id`, `id_tranksaksi`, `id_barang`, `jumlah`, `total`) VALUES
(1, 2, 5, 5, 500),
(2, 2, 10, 5, 2500),
(3, 3, 3, 10, 20000),
(4, 3, 11, 10, 15000),
(5, 4, 3, 5, 10000),
(6, 4, 1, 5, 6000),
(7, 5, 11, 5, 7500),
(8, 5, 12, 5, 5000),
(9, 6, 4, 3, 23670),
(10, 6, 5, 10, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Lainnya'),
(11, 'Plastik'),
(25, 'Botol'),
(26, 'Berbahaya'),
(27, 'Kertas'),
(28, 'Limbah');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`id`, `id_users`, `id_barang`) VALUES
(10, 8, 3),
(19, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `koran`
--

CREATE TABLE `koran` (
  `id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`id`, `id_users`, `id_barang`) VALUES
(21, 8, 4),
(22, 8, 1),
(48, 3, 11),
(49, 3, 12),
(50, 25, 4),
(51, 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1652365220, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tranksaksi_keluar`
--

CREATE TABLE `tranksaksi_keluar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tranksaksi_keluar`
--

INSERT INTO `tranksaksi_keluar` (`id`, `nama`, `created_at`) VALUES
(4, 'Korang', '2022-06-06 13:05:53'),
(5, 'Xiaomay', '2022-06-06 13:13:59'),
(6, 'Fauzan', '2022-06-06 16:24:55'),
(7, 'Fikri', '2022-06-06 16:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `tranksaksi_masuk`
--

CREATE TABLE `tranksaksi_masuk` (
  `id` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tranksaksi_masuk`
--

INSERT INTO `tranksaksi_masuk` (`id`, `id_user`, `created_at`) VALUES
(2, 24, '2022-06-06 11:50:50'),
(3, 26, '2022-06-06 16:23:32'),
(4, 26, '2022-06-06 16:44:35'),
(5, 25, '2022-06-06 16:51:58'),
(6, 25, '2022-06-06 16:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `tunai`
--

CREATE TABLE `tunai` (
  `id` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `tunai` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tunai`
--

INSERT INTO `tunai` (`id`, `id_user`, `tunai`, `updated_at`) VALUES
(7, 25, 7500, '2022-06-06 15:00:10'),
(8, 26, 51000, '2022-06-06 16:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `tunai_hist`
--

CREATE TABLE `tunai_hist` (
  `id` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tunai_hist`
--

INSERT INTO `tunai_hist` (`id`, `id_user`, `total`, `created_at`) VALUES
(1, 24, 500, '2022-06-06 11:53:55'),
(2, 25, 5000, '2022-06-06 16:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'saficfabiq@gmail.com', 'fikri', '$2y$10$7iXb2QYZIJIS4.lQb1S/p.Q9EJdotcbhoHZbUpeumhcOnOUUk3NxK', NULL, '2022-06-05 09:17:30', NULL, NULL, NULL, NULL, 1, 0, '2022-05-12 22:46:33', '2022-06-05 09:17:30', NULL),
(7, 'saficfabiq123@gmail.com', 'admin', '$2y$10$xL0.ik4Uth42XKsIUoBGsu.KDIiBeW/0jWHzaEN.SO2dihn9txqAm', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-05-29 08:38:05', '2022-05-29 08:38:05', NULL),
(25, 'kara@gmail.com', 'karasa', '$2y$10$lIqcVPbAPu8vsex7g.hzfO7v0p/xBsMjo3jyM/QhxBllfNR6Q/Oda', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-06 03:00:10', '2022-06-06 04:53:59', NULL),
(26, 'kuru@gmail.com', 'kurusu', '$2y$10$VFgVlMRlz3kSqeGUlIrqleq0.q8aJoRBSvg6SH2uvLVuwM07Bh0fu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-06-06 04:12:46', '2022-06-06 04:26:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_hist`
--

CREATE TABLE `users_hist` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_hist`
--

INSERT INTO `users_hist` (`id`, `email`, `username`) VALUES
(3, 'saficfabiq@gmail.com', 'fikri'),
(7, 'saficfabiq123@gmail.com', 'admin'),
(24, 'fauzansaw@gmail.com', 'fauzan'),
(25, 'kara@gmail.com', 'karasa'),
(26, 'kuru@gmail.com', 'kurusu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atm`
--
ALTER TABLE `atm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `useratm` (`id_user`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kategori` (`id_kategori`);

--
-- Indexes for table `barang_hist`
--
ALTER TABLE `barang_hist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_keluar`
--
ALTER TABLE `detail_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tranksaksi_keluar` (`id_tranksaksi`),
  ADD KEY `barang_keluar` (`id_barang`);

--
-- Indexes for table `detail_masuk`
--
ALTER TABLE `detail_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tranksaksi_masuk` (`id_tranksaksi`),
  ADD KEY `barang_masuk` (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tranksaksi_keluar`
--
ALTER TABLE `tranksaksi_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tranksaksi_masuk`
--
ALTER TABLE `tranksaksi_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_masuk` (`id_user`);

--
-- Indexes for table `tunai`
--
ALTER TABLE `tunai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_tunai` (`id_user`);

--
-- Indexes for table `tunai_hist`
--
ALTER TABLE `tunai_hist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_history` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_hist`
--
ALTER TABLE `users_hist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atm`
--
ALTER TABLE `atm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `barang_hist`
--
ALTER TABLE `barang_hist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_keluar`
--
ALTER TABLE `detail_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_masuk`
--
ALTER TABLE `detail_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tranksaksi_keluar`
--
ALTER TABLE `tranksaksi_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tranksaksi_masuk`
--
ALTER TABLE `tranksaksi_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tunai`
--
ALTER TABLE `tunai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tunai_hist`
--
ALTER TABLE `tunai_hist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users_hist`
--
ALTER TABLE `users_hist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atm`
--
ALTER TABLE `atm`
  ADD CONSTRAINT `useratm` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `detail_keluar`
--
ALTER TABLE `detail_keluar`
  ADD CONSTRAINT `barang_keluar` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `tranksaksi_keluar` FOREIGN KEY (`id_tranksaksi`) REFERENCES `tranksaksi_keluar` (`id`);

--
-- Constraints for table `detail_masuk`
--
ALTER TABLE `detail_masuk`
  ADD CONSTRAINT `barang_masuk` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `tranksaksi_masuk` FOREIGN KEY (`id_tranksaksi`) REFERENCES `tranksaksi_masuk` (`id`);

--
-- Constraints for table `tranksaksi_masuk`
--
ALTER TABLE `tranksaksi_masuk`
  ADD CONSTRAINT `user_masuk` FOREIGN KEY (`id_user`) REFERENCES `users_hist` (`id`);

--
-- Constraints for table `tunai`
--
ALTER TABLE `tunai`
  ADD CONSTRAINT `user_tunai` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `tunai_hist`
--
ALTER TABLE `tunai_hist`
  ADD CONSTRAINT `user_history` FOREIGN KEY (`id_user`) REFERENCES `users_hist` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
