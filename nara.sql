-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2026 at 11:47 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nara`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password_hash`, `is_active`, `created_at`) VALUES
(1, 'Administrator', 'admin@nara-hr.com', '$2y$10$A/DV.AsvzOPH/c/OFAhqluM5rB3EqYbCxXrqWdRGfyMygynv8nGmO', 1, '2026-05-23 22:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `external_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ProleadIndonesia.com',
  `published_at` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `summary`, `external_url`, `source`, `published_at`, `is_active`) VALUES
(1, 'PT Pan Brothers Tbk dan Group Buka Lowongan Strategis di Tangerang', 'Informasi peluang karir strategis untuk profesional industri manufaktur.', 'https://proleadindonesia.com/2026/05/17/pt-pan-brothers-tbk-dan-group-buka-lowongan-strategis-di-tangerang-cari-profesional-berpengalaman-di-industri-manufaktur/', 'ProleadIndonesia.com', '2026-05-17', 1),
(2, 'Disiplin Sehat Ala Pemimpin Pintar', 'Cara melatih diri menyukai makanan sehat sebagai bagian dari disiplin kepemimpinan.', 'https://proleadindonesia.com/2026/05/08/disiplin-sehat-ala-pemimpin-pintar-cara-melatih-diri-menyukai-makanan-sehat/', 'ProleadIndonesia.com', '2026-05-08', 1),
(3, 'Cara Membangun Jiwa Pemimpin Saat Masih Jadi Bawahan', 'Insight praktis membangun leadership sebelum memegang jabatan formal.', 'https://proleadindonesia.com/2026/03/31/cara-membangun-jiwa-pemimpin-saat-masih-jadi-bawahan/', 'ProleadIndonesia.com', '2026-03-31', 1),
(4, 'Kepemimpinan yang Ditakuti Tak Membangun Wibawa', 'Mengapa rasa hormat lebih kuat daripada rasa takut dalam kepemimpinan.', 'https://proleadindonesia.com/2026/04/13/kepemimpinan-yang-ditakuti-tak-membangun-wibawa-mengapa-rasa-hormat-lebih-kuat-daripada-rasa-takut/', 'ProleadIndonesia.com', '2026-04-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `logo_path`, `official_url`, `note`, `sort_order`, `is_active`) VALUES
(1, 'UIN Jakarta Faculty of Psychology', 'uploads/logos/logo-uinjkt-fpsi-color-20260605193405.png', '', 'Logo resmi fakultas', 1, 1),
(2, 'YARSI University Faculty of Medical', 'uploads/logos/universitas-yarsi-20260605193416.jpg', '', 'Logo universitas', 2, 1),
(3, 'Permata Bank', 'uploads/logos/permata-20260524061554.png', '', 'Logo terbaru', 3, 1),
(4, 'Alfamart', 'uploads/logos/alfamart-logo-baru-20260605193428.png', '', 'Logo resmi', 4, 1),
(5, 'Ace Hardware Indonesia', 'uploads/logos/ace-hardware-logo-20260605193440.png', '', 'Rebrand ke Azko di beberapa tempat', 5, 1),
(6, 'Toys Kingdom', 'uploads/logos/toys-logo-20260605193454.png', '', 'Logo resmi', 6, 1),
(7, 'Office 1 Superstore', 'uploads/logos/office-1-superstore-logo-20260605193517.png', '', 'Vector', 7, 1),
(8, 'Informa', 'uploads/logos/informa-logo-20260605193551.png', '', 'Situs resmi', 8, 1),
(9, 'Takenaka Indonesia, PT', 'uploads/logos/takenaka-20260605193614.png', '', 'https://takenaka.asia/indonesia/contact', 9, 1),
(10, 'BPJS Ketenagakerjaan', 'uploads/logos/bpjs-ketenagakerjaan-logo-20260605193627.png', '', 'Logo resmi', 10, 1),
(11, 'Kemenkeu RI', 'uploads/logos/logo-atas-20260605193659.png', '', 'Logo resmi', 11, 1),
(13, 'Ciputra Group', 'uploads/logos/ciputra-logo-png-seeklogo-169199-20260605193741.png', '', 'Logo resmi', 13, 1),
(14, 'Huawei Indonesia', 'uploads/logos/huawei-logo-20260605193753.png', '', 'Logo resmi', 14, 1),
(15, 'PLN', 'uploads/logos/logo-pln-20260605193805.png', '', 'Perusahaan Listrik Negara', 15, 1),
(16, 'Krakatau Steel', 'uploads/logos/logo-krakatau-steel-2020-20260605193821.png', '', '', 16, 1),
(17, 'Bina Sarana Informatika', 'uploads/logos/logo-ubsi-20260524054130.png', '', 'bsi.ac.id', 17, 1),
(18, 'JNE Expedition', 'uploads/logos/gkl1-jne-express-koleksilogo-com-20260605193833.jpg', '', 'Logo resmi', 18, 1),
(19, 'Grab Indonesia', 'uploads/logos/grab-logo-20260605193846.png', '', '', 19, 1),
(20, 'Panasonic', 'uploads/logos/panasonic-logo-png-seeklogo-105708-20260605193902.png', '', '', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('baru','dihubungi','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baru',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_slides`
--

CREATE TABLE `home_slides` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_slides`
--

INSERT INTO `home_slides` (`id`, `title`, `image_path`, `alt_text`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Dokumentasi Kegiatan Pelatihan', 'uploads/slides/headline-utama-2-20260605204247.jpg', 'Dokumentasi kegiatan pelatihan Nara-HR', 1, 1, '2026-05-24 09:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_training`
--

CREATE TABLE `jadwal_training` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `flyer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal_training`
--

INSERT INTO `jadwal_training` (`id`, `judul`, `kategori`, `flyer`, `created_at`) VALUES
(2, 'contoh', 'In-House Training', 'a90132ea1c48e9c65994011f6a4d2c4d.png', '2026-07-01 21:00:24'),
(3, 'contoh', 'Short Training', 'b1c2fc0cb4213223e13791df4f600eca.png', '2026-07-01 21:00:36'),
(4, 'contoh', 'In-House Training', '7a3ac008243d9f5bf5cb46a71f8d8cb6.png', '2026-07-01 21:30:26'),
(5, 'contoh', 'In-House Training', '9259d9bd31212589a98927a4d9c83f14.png', '2026-07-01 21:30:36'),
(6, 'contoh', 'In-House Training', '968a58f6fb7f0c83e7e23981d4f87eeb.png', '2026-07-01 21:30:45'),
(7, 'contoh', 'In-House Training', '89bb5af253e8191d9ec4f7cbe055ffe1.png', '2026-07-01 21:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `market_segments`
--

CREATE TABLE `market_segments` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_segments`
--

INSERT INTO `market_segments` (`id`, `name`, `description`, `sort_order`, `is_active`) VALUES
(1, 'HRD Staff / Non HR', 'Peserta dari tim HRD staff maupun fungsi non-HR yang membutuhkan pemahaman HR dasar.', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int UNSIGNED NOT NULL,
  `full_name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_normalized` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `full_name`, `institution`, `email`, `phone`, `phone_normalized`, `password_hash`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'sriyadi', 'UBSI', 'sriyadisoloraya@gmail.com', '08111028851', '628111028851', '$2y$10$A/DV.AsvzOPH/c/OFAhqluM5rB3EqYbCxXrqWdRGfyMygynv8nGmO', 1, '2026-06-06 06:48:25', '2026-06-06 07:07:43'),
(2, 'Leni', 'Nara HR', 'lelono.dw@gmail.com', '08568837800', '628568837800', '$2y$10$2fuLAK8Sapks1jQ0v/3Pfex3gTR6wcXfcgNIHNT7DrwWCKX7.nNSG', 1, '2026-06-06 07:10:12', '2026-06-06 07:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `participant_programs`
--

CREATE TABLE `participant_programs` (
  `id` int UNSIGNED NOT NULL,
  `participant_id` int UNSIGNED NOT NULL,
  `program_id` int UNSIGNED DEFAULT NULL,
  `training_id` int UNSIGNED DEFAULT NULL,
  `program_name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attended_at` date NOT NULL,
  `certificate_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participant_programs`
--

INSERT INTO `participant_programs` (`id`, `participant_id`, `program_id`, `training_id`, `program_name`, `attended_at`, `certificate_path`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, 'Training dan Sertifikasi Resource Manager', '2026-06-06', 'uploads/certificates/indoceiss-20260606064825.png', 1, '2026-06-06 06:48:25', NULL),
(2, 1, 5, 2, 'Training dan Sertifikasi Resource officer', '2026-06-01', 'uploads/certificates/2025-2nd-bts-virtual-background-zoom-20260606065730.jpg', 1, '2026-06-06 06:57:30', NULL),
(3, 1, 3, 1, 'Training dan Sertifikasi Resource Manager', '2026-05-26', 'uploads/certificates/daftar-cpns-20260606070743.png', 1, '2026-06-06 07:07:43', NULL),
(4, 2, 4, 2, 'Training dan Sertifikasi Resource officer', '2026-05-20', 'uploads/certificates/bayara-20260606071012.jpeg', 1, '2026-06-06 07:10:12', NULL),
(5, 2, NULL, 3, 'sertfikasi resource supervisor', '2026-06-06', 'uploads/certificates/sk-kurikulum-kampus-utama-2023-20260606071217.pdf', 1, '2026-06-06 07:12:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poster_clicks`
--

CREATE TABLE `poster_clicks` (
  `id` bigint UNSIGNED NOT NULL,
  `poster_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster_key` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster_name` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_hash` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clicked_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poster_clicks`
--

INSERT INTO `poster_clicks` (`id`, `poster_type`, `poster_key`, `poster_name`, `page_path`, `visitor_hash`, `user_agent`, `clicked_at`) VALUES
(2, 'program', 'program-1', 'Training dan Sertifikasi Resource Supervisor', '/sahabat_nara/', '36a6ba1496e1e2a04a1ef2d312b8a343b2db516176982d0e9f0eddd0226056ab', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-13 20:50:45'),
(3, 'program', 'program-3', 'Internasional Human Capital', '/sahabat_nara/', '36a6ba1496e1e2a04a1ef2d312b8a343b2db516176982d0e9f0eddd0226056ab', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-13 20:50:50'),
(4, 'program', 'program-17', 'human resource', '/sahabat_nara/', '36a6ba1496e1e2a04a1ef2d312b8a343b2db516176982d0e9f0eddd0226056ab', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-13 20:51:13'),
(5, 'program', 'program-17', 'human resource', '/sahabat_nara/', 'b8ac0f2f5c50a2df2aa5c7fdb8cd9336ece1224b20c2bc259df1f2ab108d7778', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-14 20:52:54'),
(6, 'why_us', 'why-us-5-5.png', 'Why Us 5', '/', '7da02d90758e6d271796e4d3117f760316fb25ee0af46dc4a8ae244e9ba9d935', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-29 10:45:02'),
(7, 'program', 'program-22', 'Training dan Sertifikasi', '/', '7da02d90758e6d271796e4d3117f760316fb25ee0af46dc4a8ae244e9ba9d935', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 20:45:46'),
(8, 'program', 'program-22', 'Training dan Sertifikasi', '/', '7da02d90758e6d271796e4d3117f760316fb25ee0af46dc4a8ae244e9ba9d935', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-02 01:40:33'),
(9, 'program', 'program-21', 'International Trainer Master Class', '/', '7da02d90758e6d271796e4d3117f760316fb25ee0af46dc4a8ae244e9ba9d935', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-02 01:42:55'),
(10, 'program', 'program-22', 'Training dan Sertifikasi', '/', '7da02d90758e6d271796e4d3117f760316fb25ee0af46dc4a8ae244e9ba9d935', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-02 01:50:07'),
(11, 'program', 'program-22', 'Training dan Sertifikasi', '/', '7da02d90758e6d271796e4d3117f760316fb25ee0af46dc4a8ae244e9ba9d935', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-02 04:33:50'),
(12, 'program', 'program-20', 'Internasional Human Capital', '/', '5e9da7306fda43ab27bdf19cd9e0d9b70d6648ee0c0c97ddb7b9e0561370451f', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', '2026-07-02 05:17:17'),
(13, 'why_us', 'why-us-6-6.png', 'Why Us 6', '/', '0483c1ecbac6661651c5cc2e8ec445f5a7b5b4889bbb5d240e70f2b34e8e5bbe', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-12 11:28:16'),
(14, 'program', 'program-20', 'Internasional Human Capital', '/', '0483c1ecbac6661651c5cc2e8ec445f5a7b5b4889bbb5d240e70f2b34e8e5bbe', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-12 11:28:20'),
(15, 'gallery', 'gallery-Class Training11.jpg', 'Galeri 4', '/galeri', '0483c1ecbac6661651c5cc2e8ec445f5a7b5b4889bbb5d240e70f2b34e8e5bbe', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-12 11:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int UNSIGNED NOT NULL,
  `service_id` int UNSIGNED DEFAULT NULL,
  `category_id` int UNSIGNED DEFAULT NULL,
  `category` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mode` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flyer_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `service_id`, `category_id`, `category`, `title`, `slug`, `description`, `mode`, `flyer_path`, `price`, `sort_order`, `is_active`, `created_at`) VALUES
(18, 1, 1, 'short_training', 'Training dan Sertifikasi Resource Supervisor', 'training-dan-sertifikasi-resource-supervisor', 'Pelatihan singkat intensif dengan materi padat, praktis, dan langsung diterapkan.', 'Online / Offline', 'uploads/flyers/06d625574052bcd11e5edb73f8e10e0d.png', NULL, 1, 1, '2026-06-29 01:15:53'),
(19, 1, 2, 'in_house', 'Training dan Sertifikasi Resource Officer', 'training-dan-sertifikasi-resource-officer', 'Program pelatihan eksklusif yang disesuaikan dengan kebutuhan dan budaya perusahaan.', 'Online / Offline', 'uploads/flyers/899ef000d1ebab16860217bca7af687a.png', NULL, 2, 1, '2026-06-29 01:18:29'),
(20, 1, 3, 'bnsp', 'Internasional Human Capital', 'internasional-human-capital', 'Sertifikasi resmi untuk meningkatkan kredibilitas dan kompetensi profesional HR.', 'Offline', 'uploads/flyers/e3b306a3f656e4fdaeff63bf69221da6.png', NULL, 3, 1, '2026-06-29 01:20:49'),
(21, 1, 4, 'kan_iaf', 'International Trainer Master Class', 'international-trainer-master-class', 'Program internasional seperti IHCM dan ITM untuk penguatan kompetensi global.', 'Online / Offline', 'uploads/flyers/ae61fbfcc2b85fd1a4a959f1832c5112.png', NULL, 4, 1, '2026-06-29 01:24:41'),
(22, 1, 5, 'consulting', 'Training dan Sertifikasi', 'training-dan-sertifikasi', 'Pendampingan SOP HR, struktur organisasi, performance management, dan talent development.', 'Konsultasi', 'uploads/flyers/c483613bd10fff19533f387a05682368.png', NULL, 5, 1, '2026-06-29 01:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `program_categories`
--

CREATE TABLE `program_categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_categories`
--

INSERT INTO `program_categories` (`id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Short Training', 'short_training', NULL, 1, 1, '2026-05-24 08:55:48'),
(2, 'In-House', 'in_house', NULL, 2, 1, '2026-05-24 08:55:48'),
(3, 'BNSP', 'bnsp', NULL, 3, 1, '2026-05-24 08:55:48'),
(4, 'KAN - IAF', 'kan_iaf', NULL, 4, 1, '2026-05-24 08:55:48'),
(5, 'Consulting', 'consulting', NULL, 5, 1, '2026-05-24 08:55:48'),
(6, 'Short Cut', 'short-cut', 'testing', 6, 1, '2026-05-24 09:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int UNSIGNED NOT NULL,
  `program_id` int UNSIGNED NOT NULL,
  `training_id` int UNSIGNED DEFAULT NULL,
  `agenda_id` int UNSIGNED DEFAULT NULL,
  `full_name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `participant_count` int NOT NULL DEFAULT '1',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delivery_channel` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Grup WhatsApp',
  `status` enum('baru','dihubungi','masuk_grup_wa','selesai','batal') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baru',
  `admin_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `program_id`, `training_id`, `agenda_id`, `full_name`, `email`, `phone`, `institution`, `position`, `participant_count`, `message`, `delivery_channel`, `status`, `admin_note`, `created_at`, `updated_at`) VALUES
(10, 21, 6, 7, 'Tomy radea andrian aditama', 'tio@gmail.com', '081234565656', 'asasaswewewe', 'IT Support', 1, 'dfsfsdfsdfsdfsf', 'Grup WhatsApp', 'baru', NULL, '2026-07-12 11:53:43', NULL),
(11, 21, 6, 9, 'Tomy radea andrian aditama', 'sintawisyaasih@gmail.com', '+6281586233942', 'asasaswewewe', 'IT Support', 1, 'asasasas', 'Grup WhatsApp', 'baru', NULL, '2026-07-12 12:21:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikasi`
--

CREATE TABLE `sertifikasi` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `flyer` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sertifikasi`
--

INSERT INTO `sertifikasi` (`id`, `judul`, `kategori`, `deskripsi`, `flyer`, `is_active`, `created_at`) VALUES
(1, 'contoh', 'Sertifikasi Nasional', 'contoh', 'cd8acca78aa402b1e9dd8eb3e28e66b6.png', 1, '2026-06-30 14:22:57'),
(2, 'contoh', 'Sertifikasi Internasional', 'contoh', 'dc934e2270c6bea1a73fc3acf5732d3d.png', 1, '2026-06-30 14:26:38'),
(4, 'contoh', 'Mini Course', 'contoh', '096f0bce16d64a1f8570a6ddc42f6a4b.png', 1, '2026-06-30 15:35:59'),
(5, 'contoh', 'Sertifikasi Nasional', 'contoh', '8d65a2270967787706bcc4be6ace862a.png', 1, '2026-07-01 16:31:07'),
(6, 'contoh', 'Sertifikasi Nasional', 'contoh', '4c9acfe9a4d34ae1ab0a92cbd246d126.png', 1, '2026-07-01 16:31:25'),
(7, 'contoh', 'Sertifikasi Nasional', 'contoh', '17979d2bd8316214b6a3d4be9a975a9a.png', 1, '2026-07-01 16:32:10'),
(9, 'contoh', 'Sertifikasi Nasional', 'contoh', 'ea223c2caceb7f1260c786fdc2c9f1a2.png', 1, '2026-07-01 16:40:25'),
(10, 'contoh', 'Sertifikasi Internasional', 'contoh', 'cbf77a70c8fa34f40cd0e3dbe1b3f1b2.png', 1, '2026-07-01 16:40:35'),
(11, 'contoh', 'Sertifikasi Internasional', 'contoh', '1a797b6a15d171ae4366124ff7af0ebd.png', 1, '2026-07-01 16:40:52'),
(12, 'contoh', 'Sertifikasi Internasional', 'contoh', '239201efb8d4f016b5289508f7a58967.png', 1, '2026-07-01 16:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'HR Training', 'hr-training', 'Layanan pelatihan Human Resources untuk staf HR maupun non-HR.', 1, 1, '2026-05-23 23:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int UNSIGNED NOT NULL,
  `setting_key` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `setting_key`, `setting_value`) VALUES
(1, 'site_name', 'Sahabat Nara'),
(2, 'whatsapp_number', '+62 856-8837-800'),
(3, 'tagline', 'Nara-HR.com - We Make People Grow');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int UNSIGNED NOT NULL,
  `platform` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `profile_url`, `icon_path`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Traininghr.nara', 'https://www.instagram.com/traininghr.nara?igsh=MW9zY2N0czBld3dveA==', 'uploads/socials/instag-20260524060159.png', 1, 1, '2026-05-24 13:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expertise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `role`, `expertise`, `bio`, `photo_path`, `sort_order`, `is_active`) VALUES
(1, 'Dr. Dasep Suryanto Ph.D', 'Chairman PT. Nara Pratama Nusantara', 'HR Strategist, Leadership Communication, HR Business Partner', 'Praktisi dan konsultan pengembangan organisasi serta kepemimpinan.', 'uploads/trainers/dasep-20260523155316.png', 1, 1),
(2, 'Kiagus Rifdan Anshori S.Psi, MM', 'Direktur Utama PT. Nara Pratama Nusantara', 'Learning and Development, Project Direction', 'Berpengalaman dalam pengembangan program learning dan akademi profesional.', 'uploads/trainers/kiagus-20260523155337.png', 2, 1),
(3, 'Ahmad Bayhaqi S.Psi M.Psi Psikolog', 'Psikolog Industri dan Organisasi', 'Recruitment and Selection', 'Konsultan asesmen, rekrutmen, dan seleksi berbasis kompetensi.', 'uploads/trainers/bayhaqi-20260523155348.png', 3, 1),
(4, 'EY Eka Kurniawan S.Psi M.Psi Psikolog', 'Department Head Human Resources', 'Organization Development', 'Praktisi HR untuk pengembangan organisasi dan sistem SDM.', 'uploads/trainers/ey-eka-20260523155403.jpeg', 4, 1),
(5, 'Angga Liberty Pratama S.Pd, M.Pd', 'Direktur Utama Garis Kreasi', 'HR Information and Multimedia', 'Spesialis informasi, multimedia, dan pembelajaran digital HR.', 'uploads/trainers/angga-20260523155434.jpg', 5, 1),
(6, 'Prof. Dr. Pribadiono Ir, M.S', 'Founder PT. Quantum HRM International', 'Organization and People Development', 'Pakar pengembangan organisasi dan manusia.', 'uploads/trainers/prof-pribadiono-20260523155448.png', 6, 1),
(7, 'Brett Mc Guire', 'Business and Legal Consultant', 'Business, Legal, Commercial', 'Konsultan bisnis dan legal berpengalaman di kawasan Asia.', 'uploads/trainers/brett-fixed-20260523155514.png', 7, 1),
(8, 'Kimble Nicholes', 'Educator, Trainer, Consultant', 'Training Design, Project Risk Analysis', 'Trainer dan konsultan desain pelatihan serta analisis risiko proyek.', 'uploads/trainers/kimble-20260523155500.png', 8, 1),
(17, 'Anton Pranowo', 'Trainer Human Resources', 'Human Resource Management Generalist', 'Trainer HR untuk penguatan kompetensi dasar manajemen SDM.', 'uploads/trainers/ams-20260524004710.jpeg', 0, 1),
(20, 'Arnold Darmanto', 'Trainer Human Resources', 'Future Competencies & Workforce Readiness', '', 'uploads/trainers/zaenal-removebg-preview-20260524034558.png', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int UNSIGNED NOT NULL,
  `program_id` int UNSIGNED NOT NULL,
  `trainer_id` int UNSIGNED DEFAULT NULL,
  `market_segment_id` int UNSIGNED DEFAULT NULL,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_label` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_method` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Online',
  `duration_minutes` int UNSIGNED DEFAULT NULL,
  `flyer_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quota` int DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `program_id`, `trainer_id`, `market_segment_id`, `title`, `schedule_label`, `venue_method`, `duration_minutes`, `flyer_path`, `description`, `quota`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 21, 1, 1, 'International Human Capital', '7-9 Juli 2026', 'Offline', 180, 'uploads/flyers/946218c2c74bbe365a839f683e958343.png', '', NULL, 1, 1, '2026-06-29 10:38:51', '2026-07-02 01:34:18'),
(7, 21, 8, 1, 'World Class Certified', '21 Juli 2026', 'Offline', 180, 'uploads/flyers/51aff26359c573847ac37ef9c537a609.png', '', NULL, 2, 1, '2026-06-29 10:44:16', '2026-06-29 12:13:05'),
(8, 22, 2, 1, 'Training dan Sertifikasi Resource Officer', '29 Agustus 2026', 'Hybrid', 120, 'uploads/flyers/2de31215e8490716ae27ae486fef05f2.png', '', NULL, 3, 1, '2026-06-29 10:48:11', NULL),
(9, 22, 3, 1, 'Training dan Sertifikasi Resource Supervisor', '5 September 2026', 'Hybrid', 120, 'uploads/flyers/21128009652fe071db84d7c9acc2d142.png', '', NULL, 4, 1, '2026-06-29 10:53:48', NULL),
(10, 22, 1, 1, 'Training dan Sertifikasi Resource Resource Manager', '12 September 2026', 'Hybrid', 120, 'uploads/flyers/6b75bcf88d7eb682f9641f25f6d4d2f2.png', '', NULL, 5, 1, '2026-06-29 10:54:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `training_agendas`
--

CREATE TABLE `training_agendas` (
  `id` int UNSIGNED NOT NULL,
  `program_id` int UNSIGNED NOT NULL,
  `title` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `mode` enum('Online','Offline','Hybrid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Online',
  `location` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flyer_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quota` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_agendas`
--

INSERT INTO `training_agendas` (`id`, `program_id`, `title`, `start_date`, `end_date`, `mode`, `location`, `flyer_path`, `quota`, `is_active`, `created_at`) VALUES
(7, 18, 'Batch Training Resource Supervisor Agustus 2026', '2026-08-05', '2026-08-06', 'Online', 'Zoom Meeting', NULL, 40, 1, '2026-07-12 11:52:37'),
(8, 20, 'Batch Internasional Human Capital September 2026', '2026-09-10', '2026-09-12', 'Offline', 'Jakarta', NULL, 30, 1, '2026-07-12 11:52:37'),
(9, 22, 'Batch Konsultansi SDM Q3 2026', '2026-08-20', '2026-08-22', 'Online', 'Zoom Meeting', NULL, 25, 1, '2026-07-12 11:52:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_articles_external_url` (`external_url`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_clients_name` (`name`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_slides`
--
ALTER TABLE `home_slides`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_home_slides_image` (`image_path`);

--
-- Indexes for table `jadwal_training`
--
ALTER TABLE `jadwal_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_segments`
--
ALTER TABLE `market_segments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_normalized` (`phone_normalized`);

--
-- Indexes for table `participant_programs`
--
ALTER TABLE `participant_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_participant_program_participant` (`participant_id`),
  ADD KEY `idx_participant_program_program` (`program_id`),
  ADD KEY `idx_participant_program_training` (`training_id`);

--
-- Indexes for table `poster_clicks`
--
ALTER TABLE `poster_clicks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_poster_clicks_key` (`poster_key`),
  ADD KEY `idx_poster_clicks_clicked_at` (`clicked_at`),
  ADD KEY `idx_poster_clicks_visitor` (`visitor_hash`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_program_service` (`service_id`);

--
-- Indexes for table `program_categories`
--
ALTER TABLE `program_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registration_program` (`program_id`),
  ADD KEY `fk_registration_agenda` (`agenda_id`),
  ADD KEY `fk_registration_training` (`training_id`);

--
-- Indexes for table `sertifikasi`
--
ALTER TABLE `sertifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_social_links_platform` (`platform`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_trainers_name` (`name`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_training_program_title` (`program_id`,`title`),
  ADD KEY `fk_training_trainer` (`trainer_id`),
  ADD KEY `fk_training_segment` (`market_segment_id`);

--
-- Indexes for table `training_agendas`
--
ALTER TABLE `training_agendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_agenda_title_date` (`title`,`start_date`),
  ADD KEY `fk_agenda_program` (`program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_slides`
--
ALTER TABLE `home_slides`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal_training`
--
ALTER TABLE `jadwal_training`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `market_segments`
--
ALTER TABLE `market_segments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `participant_programs`
--
ALTER TABLE `participant_programs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poster_clicks`
--
ALTER TABLE `poster_clicks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `program_categories`
--
ALTER TABLE `program_categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sertifikasi`
--
ALTER TABLE `sertifikasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `training_agendas`
--
ALTER TABLE `training_agendas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `fk_program_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `fk_registration_agenda` FOREIGN KEY (`agenda_id`) REFERENCES `training_agendas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registration_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registration_training` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `fk_training_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_training_segment` FOREIGN KEY (`market_segment_id`) REFERENCES `market_segments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_training_trainer` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `training_agendas`
--
ALTER TABLE `training_agendas`
  ADD CONSTRAINT `fk_agenda_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
