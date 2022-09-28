-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2022 at 01:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gowisata_gowisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_bookings`
--

CREATE TABLE `event_bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kamar_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_id` bigint(20) DEFAULT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_campings`
--

CREATE TABLE `event_campings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `camp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `event_campings`
--

INSERT INTO `event_campings` (`id`, `title`, `camp_id`, `kode`, `date`, `tempat_id`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'C001', 'LT-1630b6343265ae', '2022-08-28 ', 3, '2022-08-28 12:44:51', '2022-08-28 12:44:51'),
(2, 'pending', 'C001', 'LT-1630b6343265ae', '2022-08-29 ', 3, '2022-08-28 12:44:51', '2022-08-28 12:44:51'),
(3, 'pending', 'C001', 'LT-2630b6b901bdc4', '2022-08-28 ', 3, '2022-08-28 13:20:16', '2022-08-28 13:20:16'),
(4, 'pending', 'C001', 'LT-2630b6b901bdc4', '2022-08-29 ', 3, '2022-08-28 13:20:16', '2022-08-28 13:20:16'),
(5, 'pending', 'C001', 'LT-9630eba1b1dedc', '2022-08-31 ', 3, '2022-08-31 01:32:11', '2022-08-31 01:32:11'),
(6, 'pending', 'C001', 'LT-9630eba1b1dedc', '2022-09-01 ', 3, '2022-08-31 01:32:11', '2022-08-31 01:32:11'),
(7, 'pending', 'C001', 'LT-19631629429d7e1', '2022-09-05 ', 3, '2022-09-05 16:52:18', '2022-09-05 16:52:18'),
(8, 'pending', 'C001', 'LT-19631629429d7e1', '2022-09-06 ', 3, '2022-09-05 16:52:18', '2022-09-05 16:52:18'),
(9, 'pending', 'C001', 'LT-2063162b2b7c365', '2022-09-05 ', 3, '2022-09-05 17:00:27', '2022-09-05 17:00:27'),
(10, 'pending', 'C001', 'LT-2063162b2b7c365', '2022-09-06 ', 3, '2022-09-05 17:00:27', '2022-09-05 17:00:27'),
(11, 'pending', 'C001', 'LT-236316792c7b46d', '2022-09-06 ', 3, '2022-09-05 22:33:16', '2022-09-05 22:33:16'),
(12, 'pending', 'C001', 'LT-236316792c7b46d', '2022-09-07 ', 3, '2022-09-05 22:33:16', '2022-09-05 22:33:16'),
(13, 'pending', 'C001', 'LT-2463167a9391867', '2022-09-07 ', 3, '2022-09-05 22:39:15', '2022-09-05 22:39:15'),
(14, 'pending', 'C001', 'LT-2463167a9391867', '2022-09-08 ', 3, '2022-09-05 22:39:15', '2022-09-05 22:39:15'),
(15, 'pending', 'C001', 'LT-2563167aebc6118', '2022-09-06 ', 3, '2022-09-05 22:40:43', '2022-09-05 22:40:43'),
(16, 'pending', 'C001', 'LT-2563167aebc6118', '2022-09-07 ', 3, '2022-09-05 22:40:43', '2022-09-05 22:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `event_kegiatan`
--

CREATE TABLE `event_kegiatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_051759_create_tb_role_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_04_19_051917_create_tb_tempat_table', 1),
(6, '2021_04_26_035742_create_tb_tiket_table', 1),
(7, '2021_05_29_070749_create_tb_blog_table', 1),
(8, '2021_06_10_033810_create_tb_pay_table', 1),
(9, '2021_06_15_032318_create_tb_camp_table', 1),
(10, '2021_06_15_033018_create_tb_wahana_table', 1),
(11, '2021_06_17_045444_create_tb_kuliner_table', 1),
(12, '2021_06_20_044335_create_tb_detailtransaksi_table', 1),
(13, '2021_06_25_152144_create_tb_pencairan_table', 1),
(14, '2021_06_26_022121_create_tb_detailcamp_table', 1),
(15, '2021_06_29_035839_create_tb_kamar_table', 1),
(16, '2021_06_30_034536_create_tb_detailbooking_table', 1),
(17, '2021_07_11_121732_create_event_bookings_table', 1),
(18, '2021_07_25_125215_create_event_campings_table', 1),
(19, '2021_08_01_234051_create_table_setting', 1),
(20, '2021_08_12_031553_create_tb_kegiatan_table', 1),
(21, '2021_08_12_125845_create_event_kegiatan_table', 1),
(22, '2022_04_07_064902_create_tb_kategorievent_table', 1),
(23, '2022_04_07_074056_create_tb_event_table', 1),
(24, '2022_05_12_130019_create_top_ups_table', 1),
(25, '2022_05_12_132848_add_balance_to_users_table', 1),
(26, '2022_04_15_074647_create_tb_bookingevent_table', 2),
(27, '2022_04_16_065809_create_tb_pesertaevent_table', 2),
(29, '2022_06_19_102632_create_tb_review_event_table', 3),
(30, '2022_06_27_125006_create_top_up_table', 4),
(31, '2022_06_27_130833_create_mutasi_rekening_table', 4),
(32, '2022_06_28_141112_add_status_to_top_up_table', 5),
(33, '2022_07_04_112020_add_type_bayar_to_detail_transaksi', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_bank`
--

CREATE TABLE `mutasi_bank` (
  `id` int(11) NOT NULL,
  `bank` varchar(32) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `norek` varchar(16) COLLATE utf8mb4_swedish_ci NOT NULL,
  `tanggal` varchar(32) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `ket` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL,
  `tanggal_insert` datetime DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `reff` varchar(64) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `opr` varchar(64) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `tanggal_valid` datetime DEFAULT NULL,
  `ket_valid` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_rekening`
--

CREATE TABLE `mutasi_rekening` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kredit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nurridwan498@gmail.com', '$2y$10$Km22eILqKNs5W0okcVCk/e4RlPDnLUWxkxNdm9v8ObFAcw6E.H/g6', '2022-06-30 02:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `table_setting`
--

CREATE TABLE `table_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `table_setting`
--

INSERT INTO `table_setting` (`id`, `home1`, `about1`, `about2`, `video`, `sponsor1`, `sponsor2`, `sponsor3`, `sponsor4`, `experience1`, `experience2`, `created_at`, `updated_at`) VALUES
(1, 'hRerEpZiBh7zZ7QMpresz6JRrudtI51TdCCZouTu.jpg', '1658142075.png', '1635820863.png', 'fVkMCnIag5hJBmcib1DbxLyVZpnf3THM7NbqjvdX.m4v', NULL, 'M6tArxfpgeFQwhH1w1BfRTE8MyNY0EwB6TK9juEM.png', 'T64pdhTeyN3z7t1mrGc5pI9FmYbcm25NVDh32Ilg.png', 'jjKyps3S0KTtltllnk6NwUTOHCCduRNCcgEfxPlQ.png', 'bSce8EQdWA1uCax5AFdY9zPJSY4KU3TaRVXTsQWg.jpg', 'evZ9hldbe01WUiByRGPT6GSNOkW0mQ0wkO9H3GSc.jpg', NULL, '2022-07-26 16:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog`
--

CREATE TABLE `tb_blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bookingevent`
--

CREATE TABLE `tb_bookingevent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_booking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_orang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `checkin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_bookingevent`
--

INSERT INTO `tb_bookingevent` (`id`, `kode_tiket`, `kode_booking`, `nama`, `jml_orang`, `biaya`, `status`, `checkin`, `checkout`, `user_id`, `event_id`, `created_at`, `updated_at`) VALUES
(1, 'LT-8830', 'BE0001', 'DINDA PUTRI RESTIKA', '2', '10000', 2, '2022-08-31 20:16:19', NULL, 8, 1, '2022-08-30 16:30:38', '2022-08-31 13:16:19'),
(2, 'LT-9831', 'BE0002', 'DINDA PUTRI RESTIKA', '2', '10000', 1, NULL, NULL, 8, 1, '2022-08-31 13:07:18', '2022-08-31 13:07:18'),
(3, 'LT-12802', 'BE0003', 'DINDA PUTRI RESTIKA', '2', '10000', 1, NULL, NULL, 8, 2, '2022-09-02 09:41:47', '2022-09-02 09:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bookingtempatsewa`
--

CREATE TABLE `tb_bookingtempatsewa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_booking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_orang` int(11) DEFAULT NULL,
  `checkin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkinn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkoutt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ruang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_bookingtempatsewa`
--

INSERT INTO `tb_bookingtempatsewa` (`id`, `kode_tiket`, `kode_booking`, `title`, `nama`, `telp`, `nik`, `keperluan`, `jml_orang`, `checkin`, `checkinn`, `checkout`, `checkoutt`, `durasi`, `biaya`, `status`, `user_id`, `ruang_id`, `created_at`, `updated_at`) VALUES
(1, 'LT-7830', 'BT0001', NULL, 'Dinda', '0271647658', '33141', 'Acara ulang tahun', 100, '2022-08-31 08:00', NULL, '2022-08-31 10:30', NULL, '2 jam 30 menit', '250000', 1, 8, 1, '2022-08-30 16:29:30', '2022-08-30 16:29:30'),
(2, 'LT-11831', 'BT0002', NULL, 'Dinda', '0271647658', '33141', 'Wedding', 2, '2022-09-01 08:00', NULL, '2022-09-01 10:30', NULL, '2 jam 30 menit', '250000', 1, 8, 1, '2022-08-31 13:12:29', '2022-08-31 13:12:29'),
(3, 'LT-13802', 'BT0003', NULL, 'Dinda', '0271647658', '33141', 'Meeting', 10, '2022-09-02 10:00', NULL, '2022-09-02 12:00', NULL, '2 jam 0 menit', '50000', 1, 8, 2, '2022-09-02 09:47:30', '2022-09-02 09:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bookingvilla`
--

CREATE TABLE `tb_bookingvilla` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_booking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tempat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkinn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkoutt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_orang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kartu_identitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `villa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_camp`
--

CREATE TABLE `tb_camp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_camp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_camp`
--

INSERT INTO `tb_camp` (`id`, `tempat_id`, `name`, `jumlah`, `deskripsi`, `image`, `harga`, `status`, `created_at`, `updated_at`, `kode_camp`, `deskripsi_harga`, `kategori`) VALUES
(1, 3, 'Camp Pelataran', NULL, 'Camp ini akan diadakan serentak untuk warga Karanganyar.', 'I6ITBw9myx0sxud65sflOJpPbkdpSPjxi8GbOUN2.jpg', '15000', 1, '2022-08-21 12:43:38', '2022-08-21 12:43:38', 'C001', 'Per orang', 'alat'),
(2, 3, 'Camp Desa Karang', NULL, 'Menyediakan tempat camp', '5m1dq0yQ1bBziqoZ9DqzKT5prcZy4OrO3gfA8VNR.jpg', '10000', 1, '2022-08-21 12:45:55', '2022-08-21 12:45:55', 'C002', 'Per orang', 'paket');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailbooking`
--

CREATE TABLE `tb_detailbooking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_booking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `tempat_id` bigint(20) NOT NULL,
  `tempat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkinn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkoutt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `kamar_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `subtotal` int(25) NOT NULL,
  `status` int(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailcamp`
--

CREATE TABLE `tb_detailcamp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `tempat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_orang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `makan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_tenda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `makan_durasi` int(11) DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_kembaliin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_camping` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_detailcamp`
--

INSERT INTO `tb_detailcamp` (`id`, `kode_tiket`, `name`, `user_id`, `tempat_id`, `tempat_name`, `date`, `date2`, `jumlah_orang`, `makan`, `durasi`, `alat_id`, `jumlah_tenda`, `makan_durasi`, `harga`, `status`, `tgl_kembaliin`, `kode_camping`, `created_at`, `updated_at`) VALUES
(1, 'LT-2063162b2b7c365', 'DINDA PUTRI RESTIKA', 8, 3, 'Wisata Watu Gambir', '2022-09-05 00:00:00', '2022-09-06 00:00:00', '1', 'exclude', '1', 'C001', '1', 1, '15000', 0, NULL, 'DC0001', '2022-09-05 17:00:27', '2022-09-05 17:00:27'),
(2, 'LT-236316792c7b46d', 'DINDA PUTRI RESTIKA', 8, 3, 'Wisata Watu Gambir', '2022-09-06 00:00:00', '2022-09-07 00:00:00', '1', 'exclude', '1', 'C001', '1', 1, '15000', 0, NULL, 'DC0002', '2022-09-05 22:33:16', '2022-09-05 22:33:16'),
(3, 'LT-2463167a9391867', 'DINDA PUTRI RESTIKA', 8, 3, 'Wisata Watu Gambir', '2022-09-07 00:00:00', '2022-09-08 00:00:00', '1', 'exclude', '1', 'C001', '1', 1, '15000', 0, NULL, 'DC0003', '2022-09-05 22:39:15', '2022-09-05 22:39:15'),
(4, 'LT-2563167aebc6118', 'DINDA PUTRI RESTIKA', 8, 3, 'Wisata Watu Gambir', '2022-09-06 00:00:00', '2022-09-07 00:00:00', '1', 'exclude', '1', 'C001', '1', 1, '15000', 0, NULL, 'DC0004', '2022-09-05 22:40:43', '2022-09-05 22:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailtransaksi`
--

CREATE TABLE `tb_detailtransaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kedatangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_detailtransaksi`
--

INSERT INTO `tb_detailtransaksi` (`id`, `name`, `durasi`, `tanggal_a`, `tanggal_b`, `kode_tiket`, `id_produk`, `booking_id`, `harga`, `jumlah`, `status`, `kedatangan`, `user_id`, `kategori`, `tempat_id`, `created_at`, `updated_at`, `type_bayar`, `count`) VALUES
(1, 'Reservasi Ballroom', '2 jam 30 menit', '2022-08-31', '2022-08-31', 'LT-7830', '1', 'BT0001', 250000, '100', NULL, '0', 8, 'tempat sewa', 2, '2022-08-30 16:29:30', '2022-08-30 16:29:30', NULL, NULL),
(3, 'Event Pameran Wayang', '1', '2022-08-21', '2022-08-21', 'LT-9831', '1', 'BE0002', 10000, '2', NULL, '0', 8, 'events', 2, '2022-08-31 13:07:18', '2022-08-31 13:07:18', NULL, NULL),
(5, 'Event Pameran Seni ISI Surakarta', '1', '2022-09-02', '2022-09-02', 'LT-12802', '2', 'BE0003', 10000, '2', '1', '0', 8, 'events', 2, '2022-09-02 09:41:47', '2022-09-02 09:43:38', NULL, NULL),
(6, 'Reservasi Ruang Meeting', '2 jam 0 menit', '2022-09-02', '2022-09-02', 'LT-13802', '1', 'BT0003', 50000, '10', '1', '0', 8, 'tempat sewa', 2, '2022-09-02 09:47:30', '2022-09-02 09:49:04', NULL, NULL),
(7, 'Tiket Wisata Watu Gambir', '1', '2022-09-05', '0', 'LT-176316283ac5682', '3', NULL, 10000, '1', '1', '0', 8, 'tiket', 3, '2022-09-05 16:47:54', '2022-09-05 16:47:54', 'Bayar Langsung', 1),
(8, 'Tiket Wisata Watu Gambir', '1', '2022-09-05', '0', 'LT-186316286c9cf8f', '3', NULL, 10000, '1', '1', '0', 8, 'tiket', 3, '2022-09-05 16:48:44', '2022-09-05 16:50:40', 'Transfer', 1),
(9, 'Paket Camping', '1', '2022-09-05 00:00:00', '2022-09-06 00:00:00', 'LT-2063162b2b7c365', 'C001', NULL, 15000, '1', NULL, '0', 8, 'camping', 3, '2022-09-05 17:00:27', '2022-09-05 17:00:27', 'Bayar Langsung', 1),
(10, 'Tiket Wahana Arum Jeram', '1', '2022-09-06', '0', 'LT-21631631b02db6a', 'W001', NULL, 20000, '1', '1', '0', 8, 'wahana', 3, '2022-09-05 17:28:16', '2022-09-05 17:28:16', 'Bayar Langsung', 1),
(11, 'Tiket Wahana Arum Jeram', '1', '2022-09-06', '0', 'LT-22631631ca6d130', 'W001', NULL, 20000, '1', NULL, '0', 8, 'wahana', 3, '2022-09-05 17:28:42', '2022-09-05 17:28:42', 'Transfer', 1),
(12, 'Paket Camping', '1', '2022-09-06 00:00:00', '2022-09-07 00:00:00', 'LT-236316792c7b46d', 'C001', NULL, 15000, '1', NULL, '0', 8, 'camping', 3, '2022-09-05 22:33:16', '2022-09-05 22:33:16', NULL, 1),
(13, 'Paket Camping', '1', '2022-09-07 00:00:00', '2022-09-08 00:00:00', 'LT-2463167a9391867', 'C001', NULL, 15000, '1', NULL, '0', 8, 'camping', 3, '2022-09-05 22:39:15', '2022-09-05 22:39:15', 'Bayar Langsung', 1),
(14, 'Paket Camping', '1', '2022-09-06 00:00:00', '2022-09-07 00:00:00', 'LT-2563167aebc6118', 'C001', NULL, 15000, '1', NULL, '0', 8, 'camping', 3, '2022-09-05 22:40:43', '2022-09-05 22:40:43', 'Bayar Langsung', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_selesai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buka` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_tutup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas_awal` int(11) NOT NULL,
  `kapasitas_akhir` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `kategorievent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`id`, `kode_event`, `nama`, `deskripsi`, `lokasi`, `waktu_mulai`, `waktu_selesai`, `tgl_buka`, `tgl_tutup`, `harga`, `foto`, `link_video`, `kapasitas_awal`, `kapasitas_akhir`, `status`, `kategorievent_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'EK0001', 'Pameran Wayang', 'Pameran yang memamerkan berbagai jenis wayang mulai dari wayang kulit, wayang golek, serta wayang suket (rumput) tersebut sebagai bentuk upaya untuk menjaga tradisi dan kebudayaan Indonesia dengan cara menampilkan wayang kepada masyarakat luas terutama generasi milennial dan generasi Z dengan kemasan yang menarik dan relevan dengan fenomena yang dihadapi saat ini.', 'Watu Gambir', '09:00', '15:00', '2022-08-21', '2022-08-21', '5000', '2jTi9l9dCxzrleAdQimhmIWicsuqhg1ES7kvfK9h.jpg', 'https://www.youtube.com/embed/L0MK7qz13bU', 100, 2, 1, 5, '2022-08-21 10:35:13', '2022-08-31 12:58:57', 7),
(2, 'EK0002', 'Pameran Seni ISI Surakarta', 'lorem ipsum............................................', 'Watu Gambir', '12:00', '15:00', '2022-09-02', '2022-09-02', '5000', 'VnSyM8vqjygBB3yTFau3iNgCJAvBD98w9UemrUw5.jpg', 'https://www.youtube.com/embed/L0MK7qz13bU', 100, 2, 1, 5, '2022-09-02 09:31:45', '2022-09-02 09:43:38', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hotel`
--

CREATE TABLE `tb_hotel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_hotel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_hotel`
--

INSERT INTO `tb_hotel` (`id`, `tempat_id`, `user_id`, `kode_hotel`, `nama`, `deskripsi`, `lokasi`, `telp`, `foto`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(1, '4', '4', 'HT0001', 'Hotel A', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Watu Gambir, Karanganyar', '0271647658', 'CxoMYo60VE56qN3bUgE5ZPpoC4D6g65RZwEhaE5v.png', 1, 'hotel-a', '2022-09-05 22:46:46', '2022-09-05 22:46:46'),
(2, '4', '4', 'HT0002', 'Hotel B', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Watu Gambir', '0271647658', 'kGgUkJGmSqZmG6FnpaqjYCECsP7WfFCaF9fnv22S.png', 1, 'hotel-b', '2022-09-05 23:04:06', '2022-09-05 23:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `dipakai` int(25) NOT NULL DEFAULT 0,
  `kode_kamar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kamar`
--

INSERT INTO `tb_kamar` (`id`, `hotel_id`, `tempat_id`, `name`, `image`, `harga`, `kapasitas`, `type`, `deskripsi`, `deskripsi_harga`, `status`, `dipakai`, `kode_kamar`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Kamar 01', 'vVDSma0juD6AdSXXBE1H0CpXy68DUZwKYN2fwjDZ.jpg', '100000', 3, 'standard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Per Malam', 1, 0, 'K001', '2022-09-05 23:03:42', '2022-09-05 23:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategorievent`
--

CREATE TABLE `tb_kategorievent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategorievent`
--

INSERT INTO `tb_kategorievent` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Acara Bisnis', '2022-06-08 22:16:37', '2022-06-08 22:16:37'),
(2, 'Pertunjukan', '2022-06-08 22:16:47', '2022-06-08 22:16:47'),
(3, 'Acara Olahraga', '2022-06-08 22:16:59', '2022-06-08 22:16:59'),
(4, 'Acara Musik', '2022-06-08 22:17:09', '2022-06-08 22:17:09'),
(5, 'Pameran', '2022-06-08 22:17:19', '2022-06-08 22:17:19'),
(6, 'Acara Komedi', '2022-06-08 22:18:14', '2022-06-08 22:18:14'),
(7, 'Webinar', '2022-06-08 22:18:25', '2022-06-08 22:18:25'),
(8, 'Seminar', '2022-06-08 22:18:32', '2022-06-08 22:18:32'),
(9, 'Lomba', '2022-06-08 22:19:25', '2022-06-08 22:19:25'),
(10, 'Rapat', '2022-07-29 09:09:46', '2022-07-29 09:10:20'),
(12, 'Ramadhan', '2022-09-02 09:29:51', '2022-09-02 09:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` bigint(20) UNSIGNED ZEROFILL NOT NULL,
  `kode_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jambuka` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jamtutup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `kapasitas` int(11) NOT NULL,
  `kapasitas_b` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuliner`
--

CREATE TABLE `tb_kuliner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_kuliner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pay`
--

CREATE TABLE `tb_pay` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `va_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `va_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kodeku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_pay`
--

INSERT INTO `tb_pay` (`id`, `status_message`, `order_id`, `payment_type`, `transaction_time`, `transaction_status`, `va_number`, `va_bank`, `kodeku`, `created_at`, `updated_at`, `_token`) VALUES
('LT-12802', 'settlement', 'LT-12802', 'bank_transfer', '2022-09-02 16:42:42', 'settlement', '9880258580071173', 'bni', 'LT-12802', '2022-09-02 09:43:03', '2022-09-02 09:43:38', 'mShnIsT8Ujaogldj83fSzVsdDYPuQ8UcgzTxahZP'),
('LT-13802', 'settlement', 'LT-13802', 'bank_transfer', '2022-09-02 16:48:15', 'settlement', '9880258565538247', 'bni', 'LT-13802', '2022-09-02 09:48:40', '2022-09-02 09:49:04', 'mShnIsT8Ujaogldj83fSzVsdDYPuQ8UcgzTxahZP'),
('LT-186316286c9cf8f', 'settlement', 'LT-186316286c9cf8f', 'bank_transfer', '2022-09-05 23:48:41', 'settlement', '9880258550294384', 'bni', 'LT-186316286c9cf8f', '2022-09-05 16:49:00', '2022-09-05 16:50:40', 'PUtAGKgeSM9dFPKghXhHZKg51nYGSeo4tUzCpeoC'),
('LT-22631631ca6d130', 'pending', 'LT-22631631ca6d130', 'bank_transfer', '2022-09-06 00:28:36', 'pending', '9880258565543403', 'bni', 'LT-22631631ca6d130', '2022-09-05 17:28:54', '2022-09-05 17:28:54', NULL),
('LT-236316792c7b46d', 'pending', 'LT-236316792c7b46d', 'bank_transfer', '2022-09-06 05:33:14', 'pending', '9880258512088296', 'bni', 'LT-236316792c7b46d', '2022-09-05 22:33:37', '2022-09-05 22:33:37', NULL),
('LT-7830', 'pending', 'LT-7830', 'bank_transfer', '2022-08-30 23:29:41', 'pending', '9880258549386553', 'bni', 'LT-7830', '2022-08-30 16:30:00', '2022-08-31 12:58:51', 'eTfbuixiHXCKmdHdWGTgcoC96EPcRIYsjCm289sd'),
('LT-8830', 'settlement', 'LT-8830', 'bank_transfer', '2022-08-31 19:58:05', 'settlement', '9880258564773846', 'bni', 'LT-8830', '2022-08-31 12:58:24', '2022-08-31 12:58:57', 'eTfbuixiHXCKmdHdWGTgcoC96EPcRIYsjCm289sd'),
('LT-9831', 'pending', 'LT-9831', 'bank_transfer', '2022-08-31 20:07:31', 'pending', '9880258592943204', 'bni', 'LT-9831', '2022-08-31 13:07:57', '2022-08-31 13:08:14', 'eTfbuixiHXCKmdHdWGTgcoC96EPcRIYsjCm289sd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pencairan`
--

CREATE TABLE `tb_pencairan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesertaevent`
--

CREATE TABLE `tb_pesertaevent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_peserta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_booking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `kedatangan` int(11) NOT NULL DEFAULT 0,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pesertaevent`
--

INSERT INTO `tb_pesertaevent` (`id`, `kode_peserta`, `kode_booking`, `nama_peserta`, `email`, `telp`, `status`, `kedatangan`, `event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'PE-11630e3b2191893', 'BE0001', 'Dinda', 'dindarestika@student.uns.ac.id', '0271647658', 1, 0, 1, 8, '2022-08-30 16:30:38', '2022-08-30 16:30:38'),
(2, 'PE-12630e3b21921f0', 'BE0001', 'Bagus', 'bagus@gmail.com', '0271647658', 1, 0, 1, 8, '2022-08-30 16:30:38', '2022-08-30 16:30:38'),
(3, 'PE-11630f5cd34c799', 'BE0002', 'Dinda', 'dindarestika@student.uns.ac.id', '0271647658', 1, 0, 1, 8, '2022-08-31 13:07:18', '2022-08-31 13:07:18'),
(4, 'PE-12630f5cd34cf48', 'BE0002', 'Bagus', 'bagus@gmail.com', '0271647658', 1, 0, 1, 8, '2022-08-31 13:07:18', '2022-08-31 13:07:18'),
(5, 'PE-116311cfb501b6c', 'BE0003', 'Sisca', 'sisca@student.uns.ac.id', '0271647658', 1, 0, 2, 8, '2022-09-02 09:41:47', '2022-09-02 09:41:47'),
(6, 'PE-126311cfb5025a5', 'BE0003', 'Bibi', 'bii@gmail.com', '0271647658', 1, 0, 2, 8, '2022-09-02 09:41:47', '2022-09-02 09:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_review_event`
--

CREATE TABLE `tb_review_event` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_review_event`
--

INSERT INTO `tb_review_event` (`id`, `nama`, `rating`, `comment`, `kode_tiket`, `event_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Anonymous', 4, 'Bagus', 'LT-8830', 1, 8, '1', '2022-08-31 12:58:57', '2022-08-31 13:09:04'),
(2, 'Anonymous', 4, 'Acara bagus', 'LT-12802', 2, 8, '1', '2022-09-02 09:43:38', '2022-09-02 09:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_review_tempatsewa`
--

CREATE TABLE `tb_review_tempatsewa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempatsewa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_review_tempatsewa`
--

INSERT INTO `tb_review_tempatsewa` (`id`, `nama`, `rating`, `comment`, `kode_tiket`, `tempatsewa_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Anonymous', 4, 'good', 'LT-13802', 1, 8, '1', '2022-09-02 09:49:04', '2022-09-02 09:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_review_villa`
--

CREATE TABLE `tb_review_villa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_tiket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `villa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-05-25 07:23:50', '2022-05-25 07:23:50'),
(2, 'wisata', '2022-05-25 07:23:50', '2022-05-25 07:23:50'),
(3, 'kuliner', '2022-05-25 07:23:50', '2022-05-25 07:23:50'),
(4, 'penginapan', '2022-05-25 07:23:50', '2022-05-25 07:23:50'),
(5, 'pelanggan', '2022-05-25 07:23:50', '2022-05-25 07:23:50'),
(6, 'desa', '2022-05-25 07:23:50', '2022-05-25 07:23:50'),
(7, 'event & sewa tempat', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruang`
--

CREATE TABLE `tb_ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempatsewa_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_ruang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_ruang`
--

INSERT INTO `tb_ruang` (`id`, `tempat_id`, `tempatsewa_id`, `user_id`, `kode_ruang`, `nama`, `deskripsi`, `foto`, `status`, `harga`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '7', 'R001', 'Ballroom', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'hUtxohjOcLwBQGs2kzsM2cPM0QERl8rP6GCScapB.jpg', 1, '100000', 1000, '2022-08-30 16:27:33', '2022-08-30 16:27:33'),
(2, '2', '1', '7', 'R002', 'Ruang Meeting', 'lorem ipsum.......', 'oVwP2lgbACRr5C0srrr57Zp1nhveJ7UoB43oqw3W.jpg', 1, '25000', 1000, '2022-09-02 09:34:58', '2022-09-02 09:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempat`
--

CREATE TABLE `tb_tempat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sosmed` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `galeri` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `htm` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jambuka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jamtutup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gmaps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dana` int(11) DEFAULT NULL,
  `induk_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `open` int(11) DEFAULT 0,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_tempat`
--

INSERT INTO `tb_tempat` (`id`, `user_id`, `kategori`, `name`, `deskripsi`, `alamat`, `email`, `telp`, `sosmed`, `galeri`, `status`, `htm`, `created_at`, `updated_at`, `image`, `image2`, `jambuka`, `jamtutup`, `gmaps`, `dana`, `induk_id`, `open`, `video`, `slug`) VALUES
(1, 'D006', 'desa', 'Desa Watu Gambir', 'Desa Watu Gambir adalah desa yang terletak di Karanganyar, Jawa Tengah.', 'Karanganyar, Jawa Tengah', 'watugambir@gmail.com', '081216213301', NULL, NULL, 1, 0, '2022-08-21 09:29:52', '2022-08-21 09:29:52', 'bPSuGGz5muR0omsFj0XQExAheeJH3k6siBerj2oC.jpg', 'ZmrmGa8bQEW4OqDMRJugSrbYy8nKc3obq3NTZL1k.jpg', NULL, NULL, NULL, NULL, NULL, 0, 'pKmCYqP4Bxq32cZ5Hb48Tl7EZvyNrX5Sz980QjYl.m4v', 'desa-watu-gambir'),
(2, 'D007', 'event & sewa tempat', 'Event Desa Watu Gambir', 'Desa Watu Gambir adalah desa yang terletak di Karanganyar, Jawa Tengah.', 'Karanganyar, Jawa Tengah', 'eventwatugambir@gmail.com', '0271647658', NULL, NULL, 1, 0, '2022-08-21 09:51:54', '2022-08-21 09:51:54', 'ifBHbfsuCEpKhcCd5Z3NvuchI6icINggxzNasjy9.jpg', 'Sy9qrxk3zY7PQYHqI5simTHJfjAjfvsuhx2aWFf8.jpg', NULL, NULL, NULL, NULL, '1', 0, 'TxAwkY4m8uVoiev32yyvBipmm1VJOYiOIrcjr2Rh.m4v', 'event-desa-watu-gambir'),
(3, 'D002', 'wisata', 'Wisata Watu Gambir', 'Tempat wisata di daerah tawangmangu yang keren :)', 'Karanganyar, Jawa Tengah', 'wisatawatugambir@gmail.com', '0271647658', NULL, NULL, 1, 10000, '2022-08-21 09:56:45', '2022-09-05 07:52:36', 'smuS6ZmLeq9GGlc4Gr3pAs0Dhryz7gKQt7JKkclo.jpg', '7mWOwfogo2Cti75FtFkpDcsOQ9khLOzWtWdAttBP.jpg', NULL, NULL, NULL, 0, '1', 0, 'Q8MgB3Ji7od8QOG68rFog6RMGUdZfKI0Hndh6tBd.m4v', 'wisata-watu-gambir'),
(4, 'D004', 'penginapan', 'Penginapan Watu Gambir', 'Penginapan untuk menginap di Watu Gambir', 'Karanganyar', 'penginapanwatugambir@gmail.com', '0271647658', NULL, NULL, 1, 0, '2022-08-21 10:27:41', '2022-08-21 10:27:41', 'DGqa1JTtYrlwPhDvZycIWSQihwAgRdnsBSZj2nC1.jpg', '3YWhb7sP6C5YKStczIyvIDdj88dnRwlDNlvZGLUo.jpg', NULL, NULL, NULL, NULL, '1', 0, 'ghSLUxI0haduM2GHPWRRFSsnqnSwG5Py7oK5QvnJ.m4v', 'penginapan-watu-gambir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempatsewa`
--

CREATE TABLE `tb_tempatsewa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_tempatsewa`
--

INSERT INTO `tb_tempatsewa` (`id`, `tempat_id`, `user_id`, `nama`, `deskripsi`, `lokasi`, `telp`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', '7', 'Dandang Gulo Caffe', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Tawangmangu', '081216213301', 'S2M0JJmt2BCLsc3Ioe76AJWkFwaEmezsIJG3ymnh.png', 1, '2022-08-30 16:25:45', '2022-08-30 16:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tiket`
--

CREATE TABLE `tb_tiket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `check` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_tiket`
--

INSERT INTO `tb_tiket` (`id`, `kode`, `user_id`, `tempat_id`, `check`, `name`, `email`, `telp`, `harga`, `status`, `created_at`, `updated_at`, `token`, `type_bayar`) VALUES
(1, 'LT-1630b6343265ae', 5, NULL, NULL, 'customer', 'customer@gmail.com', NULL, 15000, 0, '2022-08-28 12:44:51', '2022-08-28 12:44:51', NULL, 'Bayar Langsung'),
(2, 'LT-2630b6b901bdc4', 5, NULL, NULL, 'customer', 'customer@gmail.com', NULL, 15000, 0, '2022-08-28 13:20:16', '2022-08-28 13:20:16', NULL, 'Bayar Langsung'),
(3, 'LT-3630b71dd9f0a3', 5, NULL, NULL, 'customer', 'customer@gmail.com', NULL, 20000, 0, '2022-08-28 13:47:09', '2022-08-28 13:47:09', NULL, 'Bayar Langsung'),
(4, 'LT-4630b726a3d62b', 5, NULL, NULL, 'customer', 'customer@gmail.com', NULL, 20000, 0, '2022-08-28 13:49:30', '2022-08-28 13:49:30', NULL, 'Bayar Langsung'),
(5, 'LT-5630b961898730', 5, NULL, NULL, 'customer', 'customer@gmail.com', NULL, 20000, 0, '2022-08-28 16:21:44', '2022-08-28 16:21:44', NULL, NULL),
(6, 'LT-6630b9635e44f2', 5, NULL, NULL, 'customer', 'customer@gmail.com', NULL, 20000, 0, '2022-08-28 16:22:13', '2022-08-28 16:22:13', NULL, NULL),
(7, 'LT-7830', 8, 2, 'pending', 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 250000, 1, '2022-08-30 16:29:30', '2022-08-31 12:58:51', NULL, NULL),
(10, 'LT-9831', 8, 2, 'pending', 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 10000, 1, '2022-08-31 13:07:18', '2022-08-31 13:08:14', NULL, NULL),
(12, 'LT-12802', 8, 2, 'settlement', 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 10000, 1, '2022-09-02 09:41:47', '2022-09-02 09:43:38', NULL, NULL),
(13, 'LT-13802', 8, 2, 'settlement', 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 50000, 1, '2022-09-02 09:47:30', '2022-09-02 09:49:04', NULL, NULL),
(14, 'LT-1463161313a3c79', 5, NULL, NULL, 'customer', 'customer@gmail.com', NULL, 10000, 0, '2022-09-05 15:17:39', '2022-09-05 15:17:39', NULL, NULL),
(15, 'LT-156316269659cc4', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 10000, 0, '2022-09-05 16:40:54', '2022-09-05 16:40:54', NULL, 'Bayar Langsung'),
(16, 'LT-16631627e0be2ef', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 10000, 0, '2022-09-05 16:46:24', '2022-09-05 16:46:24', NULL, 'Bayar Langsung'),
(17, 'LT-176316283ac5682', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 10000, 0, '2022-09-05 16:47:54', '2022-09-05 16:47:54', NULL, 'Bayar Langsung'),
(18, 'LT-186316286c9cf8f', 8, NULL, 'settlement', 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 10000, 1, '2022-09-05 16:48:44', '2022-09-05 16:50:40', NULL, NULL),
(19, 'LT-19631629429d7e1', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 15000, 0, '2022-09-05 16:52:18', '2022-09-05 16:52:18', NULL, 'Bayar Langsung'),
(20, 'LT-2063162b2b7c365', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 15000, 0, '2022-09-05 17:00:27', '2022-09-05 17:00:27', NULL, 'Bayar Langsung'),
(21, 'LT-21631631b02db6a', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 20000, 0, '2022-09-05 17:28:16', '2022-09-05 17:28:16', NULL, 'Bayar Langsung'),
(22, 'LT-22631631ca6d130', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 20000, 1, '2022-09-05 17:28:42', '2022-09-05 17:28:54', NULL, NULL),
(23, 'LT-236316792c7b46d', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 15000, 1, '2022-09-05 22:33:16', '2022-09-05 22:33:37', NULL, NULL),
(24, 'LT-2463167a9391867', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 15000, 0, '2022-09-05 22:39:15', '2022-09-05 22:39:15', NULL, 'Bayar Langsung'),
(25, 'LT-2563167aebc6118', 8, NULL, NULL, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', '081216213301', 15000, 0, '2022-09-05 22:40:43', '2022-09-05 22:40:43', NULL, 'Bayar Langsung');

-- --------------------------------------------------------

--
-- Table structure for table `tb_villa`
--

CREATE TABLE `tb_villa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `kode_tempat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `harga` int(11) NOT NULL DEFAULT 0,
  `kapasitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_villa`
--

INSERT INTO `tb_villa` (`id`, `user_id`, `kode_tempat`, `nama`, `deskripsi`, `lokasi`, `maps`, `telp`, `foto`, `status`, `harga`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 4, 'TS0001', 'Vila Delima', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Watu Gambir, Karanganyar', 'https://goo.gl/maps/XmTd7UTgtKAsRAgW6', '0271647658', '2PO8hnQFhFfqr3csut87tng1gcq6qwQgbhgAH8du.png', 1, 100000, '5', '2022-09-05 22:47:37', '2022-09-05 22:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wahana`
--

CREATE TABLE `tb_wahana` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tempat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `kode_wahana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deskripsi_harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_wahana`
--

INSERT INTO `tb_wahana` (`id`, `tempat_id`, `name`, `image`, `deskripsi`, `harga`, `status`, `kode_wahana`, `created_at`, `updated_at`, `deskripsi_harga`) VALUES
(1, 3, 'Arum Jeram', 'SvidJ9mL43zIamj8g2MrDmYszgSNkyMMB1sJ4SMe.jpg', 'Arum jeram ini bla bla bla bla', '20000', 1, 'W001', '2022-08-21 12:48:26', '2022-08-21 12:48:26', 'Perorang');

-- --------------------------------------------------------

--
-- Table structure for table `top_up`
--

CREATE TABLE `top_up` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kode_unik` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `nominal_ditransfer` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `top_up`
--

INSERT INTO `top_up` (`id`, `user_id`, `kode_unik`, `name`, `bank`, `nominal`, `nominal_ditransfer`, `keterangan`, `created_at`, `updated_at`, `status`) VALUES
(1, 5, 1, 'Customer', NULL, 100000, 100001, 'Pembayaran Sedang Diproses, Silahkan Menunggu Email Sukses Pembayaran', '2022-09-05 15:53:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 5,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `petugas_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desa_id` int(11) DEFAULT NULL,
  `tempat_id` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `jk`, `alamat`, `telp`, `image`, `role_id`, `status`, `remember_token`, `created_at`, `updated_at`, `petugas_id`, `desa_id`, `tempat_id`, `balance`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$0LHKlsY20lsv5ZIgTyq4g.yHL1u1QYMeX2R.bQT/GkThIfbBJeJy6', 'pria', NULL, NULL, 'PTvKEmp5pDSQkZeTRTNteIlZCGSsVdE4hA3Qdmsv.jpg', 1, '1', NULL, '2022-05-25 07:23:50', '2022-07-04 06:52:22', 'D001', NULL, NULL, NULL),
(2, 'admwisataa', 'wisataa@gmail.com', NULL, '$2y$10$Kj7.zu0yLuUt5mEw.DQ0LO0UVsaIMDHobUEnGWZKlOIT8HNP97cfS', 'pria', NULL, NULL, 'AAKEXlUXOwPFUQ0sgslWrEjFMY00UqDroLJNpG6G.jpg', 2, '1', NULL, '2022-05-25 07:23:50', '2022-08-21 09:57:09', 'D002', 1, 3, NULL),
(3, 'admrestauranta', 'restauranta@gmail.com', NULL, '$2y$10$zEPH2/.r8A/k1GPhJrvH0eLOHRAudXGll5Y160wsgloRfrUwmM9Sy', NULL, NULL, NULL, NULL, 3, '1', NULL, '2022-05-25 07:23:50', '2022-05-25 07:23:50', 'D003', NULL, NULL, NULL),
(4, 'Admin Penginapan A', 'hotela@gmail.com', NULL, '$2y$10$mPv6im8nkJpOv8kuZwVQCuyvSZDXqIvmak.gE9Jj5LQ4DyNeZ5JX2', 'wanita', 'Pokoh', '081216213301', NULL, 4, '1', NULL, '2021-05-28 02:04:12', '2022-08-21 10:28:15', 'D004', 1, 4, NULL),
(5, 'Customer', 'customer@gmail.com', NULL, '$2y$10$dEzxdhPvX2GMpPbSbZR/6uqm/bpgTRKrllC8FPQ8N9M7xpnrBjyDW', 'wanita', 'Sragen', '081216213301', 'VKbbhis5aHQMw184sg71yHKDZPYvuR7EMefJJM4D.jpg', 5, '1', NULL, '2022-05-25 07:23:50', '2022-09-05 23:32:07', 'D005', NULL, NULL, NULL),
(6, 'admdesaa', 'desa@gmail.com', NULL, '$2y$10$1jtUPNrDl2XpEoJ/6JlzsOSccP1l7Bdam1t6nRnV8PBvy36eGF4RK', NULL, NULL, NULL, NULL, 6, '1', NULL, '2022-05-25 07:23:50', '2022-08-21 09:49:42', 'D006', 1, 1, NULL),
(7, 'Admin Event & Sewa Tempat', 'event_sewatempat@gmail.com', NULL, '$2y$10$960dtHT9NS5/JhiO5wzmhuH6hFBztdsnhvNZhMWwfOrE9fqta5C0.', 'pria', 'Sragen', '081216213301', 'p0GwxrQ7JC83ebAlvoFjvWI1GL9hpHL1f1AtNTjv.jpg', 7, '1', NULL, '2022-06-18 03:49:27', '2022-09-02 09:15:55', 'D007', 1, 2, NULL),
(8, 'DINDA PUTRI RESTIKA', 'dindaputri060892@gmail.com', NULL, '$2y$10$dshJzpEiElgbEuaDBma/RO/XfS3z8W4yP/q0uqmEC4gy1GaudmzRO', NULL, NULL, '081216213301', 'A81P7E8iv5AOv44jDO5ckTvfVzU9HqHN8NsRwWNG.jpg', 5, '1', NULL, '2022-08-21 09:17:02', '2022-09-05 16:48:21', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_tiket` (`kode_tiket`),
  ADD KEY `kamar_id` (`kamar_id`),
  ADD KEY `tempat_id` (`tempat_id`);

--
-- Indexes for table `event_campings`
--
ALTER TABLE `event_campings`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `event_campings_tempat_id_foreign` (`tempat_id`) USING BTREE;

--
-- Indexes for table `event_kegiatan`
--
ALTER TABLE `event_kegiatan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `mutasi_bank`
--
ALTER TABLE `mutasi_bank`
  ADD PRIMARY KEY (`id`,`norek`) USING BTREE;

--
-- Indexes for table `mutasi_rekening`
--
ALTER TABLE `mutasi_rekening`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`) USING BTREE;

--
-- Indexes for table `table_setting`
--
ALTER TABLE `table_setting`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_blog`
--
ALTER TABLE `tb_blog`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_blog_petugas_id_foreign` (`petugas_id`) USING BTREE;

--
-- Indexes for table `tb_bookingevent`
--
ALTER TABLE `tb_bookingevent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign` (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `tb_bookingtempatsewa`
--
ALTER TABLE `tb_bookingtempatsewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bookingvilla`
--
ALTER TABLE `tb_bookingvilla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign` (`user_id`,`villa_id`),
  ADD KEY `tempatsewa_id` (`villa_id`);

--
-- Indexes for table `tb_camp`
--
ALTER TABLE `tb_camp`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_camp_tempat_id_foreign` (`tempat_id`) USING BTREE;

--
-- Indexes for table `tb_detailbooking`
--
ALTER TABLE `tb_detailbooking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_tiket` (`kode_tiket`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tempat_id` (`tempat_id`),
  ADD KEY `kamar_id` (`kamar_id`);

--
-- Indexes for table `tb_detailcamp`
--
ALTER TABLE `tb_detailcamp`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_detailcamp_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `tb_detailcamp_tempat_id_foreign` (`tempat_id`) USING BTREE;

--
-- Indexes for table `tb_detailtransaksi`
--
ALTER TABLE `tb_detailtransaksi`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_detailtransaksi_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `tb_detailtransaksi_tempat_id_foreign` (`tempat_id`) USING BTREE;

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign` (`kategorievent_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempat_id` (`tempat_id`),
  ADD KEY `kode_kamar` (`kode_kamar`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `tb_kategorievent`
--
ALTER TABLE `tb_kategorievent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_kegiatan_tempat_id_foreign` (`tempat_id`) USING BTREE,
  ADD KEY `tb_kegiatan_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `tb_kuliner`
--
ALTER TABLE `tb_kuliner`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_kuliner_tempat_id_foreign` (`tempat_id`) USING BTREE;

--
-- Indexes for table `tb_pay`
--
ALTER TABLE `tb_pay`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_pencairan`
--
ALTER TABLE `tb_pencairan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_pencairan_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `tb_pencairan_tempat_id_foreign` (`tempat_id`) USING BTREE;

--
-- Indexes for table `tb_pesertaevent`
--
ALTER TABLE `tb_pesertaevent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_review_event`
--
ALTER TABLE `tb_review_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_review_tempatsewa`
--
ALTER TABLE `tb_review_tempatsewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_review_villa`
--
ALTER TABLE `tb_review_villa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_ruang`
--
ALTER TABLE `tb_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tempat`
--
ALTER TABLE `tb_tempat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_tempatsewa`
--
ALTER TABLE `tb_tempatsewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_tiket_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `tb_tiket_tempat_id_foreign` (`tempat_id`) USING BTREE,
  ADD KEY `tb_tiket_kode_index` (`kode`) USING BTREE;

--
-- Indexes for table `tb_villa`
--
ALTER TABLE `tb_villa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign` (`user_id`);

--
-- Indexes for table `tb_wahana`
--
ALTER TABLE `tb_wahana`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tb_wahana_tempat_id_foreign` (`tempat_id`) USING BTREE;

--
-- Indexes for table `top_up`
--
ALTER TABLE `top_up`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `top_up_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE,
  ADD KEY `users_role_id_foreign` (`role_id`) USING BTREE,
  ADD KEY `users_petugas_id_index` (`petugas_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_bookings`
--
ALTER TABLE `event_bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_campings`
--
ALTER TABLE `event_campings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `event_kegiatan`
--
ALTER TABLE `event_kegiatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `mutasi_bank`
--
ALTER TABLE `mutasi_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mutasi_rekening`
--
ALTER TABLE `mutasi_rekening`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_setting`
--
ALTER TABLE `table_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_blog`
--
ALTER TABLE `tb_blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_bookingevent`
--
ALTER TABLE `tb_bookingevent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_bookingtempatsewa`
--
ALTER TABLE `tb_bookingtempatsewa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_bookingvilla`
--
ALTER TABLE `tb_bookingvilla`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_camp`
--
ALTER TABLE `tb_camp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_detailbooking`
--
ALTER TABLE `tb_detailbooking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_detailcamp`
--
ALTER TABLE `tb_detailcamp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_detailtransaksi`
--
ALTER TABLE `tb_detailtransaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kategorievent`
--
ALTER TABLE `tb_kategorievent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` bigint(20) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kuliner`
--
ALTER TABLE `tb_kuliner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pencairan`
--
ALTER TABLE `tb_pencairan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pesertaevent`
--
ALTER TABLE `tb_pesertaevent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_review_event`
--
ALTER TABLE `tb_review_event`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_review_tempatsewa`
--
ALTER TABLE `tb_review_tempatsewa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_review_villa`
--
ALTER TABLE `tb_review_villa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_ruang`
--
ALTER TABLE `tb_ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tempat`
--
ALTER TABLE `tb_tempat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_tempatsewa`
--
ALTER TABLE `tb_tempatsewa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_villa`
--
ALTER TABLE `tb_villa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_wahana`
--
ALTER TABLE `tb_wahana`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `top_up`
--
ALTER TABLE `top_up`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_campings`
--
ALTER TABLE `event_campings`
  ADD CONSTRAINT `event_campings_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_blog`
--
ALTER TABLE `tb_blog`
  ADD CONSTRAINT `tb_blog_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_camp`
--
ALTER TABLE `tb_camp`
  ADD CONSTRAINT `tb_camp_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detailcamp`
--
ALTER TABLE `tb_detailcamp`
  ADD CONSTRAINT `tb_detailcamp_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detailcamp_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detailtransaksi`
--
ALTER TABLE `tb_detailtransaksi`
  ADD CONSTRAINT `tb_detailtransaksi_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detailtransaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD CONSTRAINT `tb_kegiatan_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kegiatan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kuliner`
--
ALTER TABLE `tb_kuliner`
  ADD CONSTRAINT `tb_kuliner_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pencairan`
--
ALTER TABLE `tb_pencairan`
  ADD CONSTRAINT `tb_pencairan_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pencairan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD CONSTRAINT `tb_tiket_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_tiket_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_wahana`
--
ALTER TABLE `tb_wahana`
  ADD CONSTRAINT `tb_wahana_tempat_id_foreign` FOREIGN KEY (`tempat_id`) REFERENCES `tb_tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `top_up`
--
ALTER TABLE `top_up`
  ADD CONSTRAINT `top_up_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
