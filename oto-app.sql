-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 13, 2024 at 09:25 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oto-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hộp Số', '2024-07-01 01:09:12', '2024-07-01 01:09:12'),
(2, 'Phanh Tay', '2024-07-01 01:09:22', '2024-07-01 01:09:22'),
(3, 'Nhiên Liệu', '2024-07-01 01:09:30', '2024-07-01 01:09:30'),
(4, 'ODO', '2024-07-01 01:09:39', '2024-07-01 01:09:39'),
(5, 'Tiêu Thụ Nhiên Liệu', '2024-07-01 01:09:47', '2024-07-01 01:09:47'),
(6, 'Số Chỗ', '2024-07-01 01:10:07', '2024-07-01 01:10:07'),
(7, 'Màu Sơn', '2024-07-01 01:10:16', '2024-07-01 01:10:16'),
(8, 'Túi Khí', '2024-07-01 01:10:33', '2024-07-01 01:10:33'),
(9, 'Cảm biến', '2024-07-02 08:03:25', '2024-07-02 08:03:25'),
(10, 'Cốp Điện', '2024-07-02 08:05:46', '2024-07-02 08:05:46'),
(11, 'Adap', '2024-08-06 09:14:48', '2024-08-06 09:14:48'),
(12, 'Cruise Control', '2024-08-06 09:14:55', '2024-08-06 09:14:55'),
(13, 'Năm SX', '2024-08-06 21:11:07', '2024-08-06 21:11:07'),
(14, 'Xuất xứ', '2024-08-06 21:14:28', '2024-08-06 21:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_spec`
--

CREATE TABLE `attribute_spec` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_spec`
--

INSERT INTO `attribute_spec` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Số Sàn', '2024-07-01 01:11:26', '2024-07-01 01:11:26'),
(2, 1, 'Số Tự Động', '2024-07-01 01:11:34', '2024-07-01 01:11:34'),
(3, 2, 'Cơ', '2024-07-01 01:11:48', '2024-07-01 01:11:48'),
(4, 2, 'Điện Tử', '2024-07-01 01:11:56', '2024-07-01 01:11:56'),
(5, 3, 'Xăng', '2024-07-01 01:12:08', '2024-07-01 01:12:08'),
(6, 3, 'Dầu', '2024-07-01 01:12:14', '2024-07-01 01:12:14'),
(7, 3, 'Điện', '2024-07-01 01:12:20', '2024-07-01 01:12:20'),
(8, 4, '30000 KM', '2024-07-01 01:12:39', '2024-07-01 01:12:39'),
(9, 4, '50000 KM', '2024-07-01 01:12:48', '2024-07-01 01:12:48'),
(10, 4, '10000 KM', '2024-07-01 01:13:00', '2024-07-01 01:13:00'),
(11, 5, '6L/100 KM', '2024-07-01 01:13:18', '2024-07-01 01:13:18'),
(12, 5, '8L/100 KM', '2024-07-01 01:13:27', '2024-07-01 01:13:27'),
(13, 5, '10L/100 KM', '2024-07-01 01:13:39', '2024-07-01 01:13:39'),
(14, 6, '5 Chỗ', '2024-07-01 01:14:00', '2024-07-01 01:14:00'),
(15, 6, '7 Chỗ', '2024-07-01 01:14:09', '2024-07-01 01:14:09'),
(16, 6, '2 Chỗ', '2024-07-01 01:14:18', '2024-07-01 01:14:18'),
(17, 7, 'Đen', '2024-07-01 01:14:32', '2024-07-01 01:14:32'),
(18, 7, 'Trắng', '2024-07-01 01:14:39', '2024-07-01 01:14:39'),
(19, 7, 'Xám', '2024-07-01 01:14:45', '2024-07-01 01:14:45'),
(20, 7, 'Đỏ', '2024-07-01 01:14:51', '2024-07-01 01:14:51'),
(21, 7, 'Nâu', '2024-07-01 01:15:01', '2024-07-01 01:15:01'),
(22, 8, '8', '2024-07-01 01:15:16', '2024-07-01 01:15:16'),
(23, 8, '2', '2024-07-01 01:15:22', '2024-07-01 01:15:22'),
(24, 8, '4', '2024-07-01 01:15:28', '2024-07-01 01:15:28'),
(25, 8, '6', '2024-07-01 01:15:34', '2024-07-01 01:15:34'),
(26, 8, '10', '2024-07-01 01:15:40', '2024-07-01 01:15:40'),
(27, 4, '12000 KM', '2024-07-02 08:17:28', '2024-07-02 08:17:28'),
(28, 7, 'Xanh', '2024-07-02 10:56:51', '2024-07-02 10:56:51'),
(39, 9, '7', '2024-08-06 09:05:22', '2024-08-06 09:05:22'),
(40, 10, 'Không', '2024-08-06 09:05:31', '2024-08-06 09:05:31'),
(41, 9, '4', '2024-08-06 09:06:14', '2024-08-06 09:06:14'),
(42, 9, '6', '2024-08-06 09:12:53', '2024-08-06 09:12:53'),
(43, 9, '2', '2024-08-06 09:13:40', '2024-08-06 09:13:40'),
(44, 9, '1', '2024-08-06 09:13:49', '2024-08-06 09:13:49'),
(45, 9, '5', '2024-08-06 09:13:54', '2024-08-06 09:13:54'),
(46, 8, '1', '2024-08-06 09:14:05', '2024-08-06 09:14:05'),
(47, 8, '3', '2024-08-06 09:14:10', '2024-08-06 09:14:10'),
(48, 10, 'Có', '2024-08-06 09:15:01', '2024-08-06 09:16:55'),
(49, 11, 'Có', '2024-08-06 09:15:15', '2024-08-06 09:15:15'),
(50, 11, 'Không', '2024-08-06 09:15:20', '2024-08-06 09:15:20'),
(51, 12, 'Có', '2024-08-06 09:15:25', '2024-08-06 09:15:25'),
(52, 12, 'Không', '2024-08-06 09:15:29', '2024-08-06 09:15:29'),
(53, 13, '2019', '2024-08-06 21:11:14', '2024-08-06 21:11:14'),
(54, 14, 'Nhập khẩu', '2024-08-06 21:15:04', '2024-08-06 21:15:04'),
(55, 13, '2021', '2024-08-08 03:08:18', '2024-08-08 03:08:18'),
(56, 14, 'SX Trong Nước', '2024-08-08 03:08:34', '2024-08-08 03:08:34'),
(57, 13, '2020', '2024-08-11 08:13:49', '2024-08-11 08:13:49'),
(58, 4, '40000 KM', '2024-08-13 06:43:37', '2024-08-13 06:43:37'),
(59, 5, '7L/100 KM', '2024-08-13 06:43:54', '2024-08-13 06:43:54'),
(60, 9, '8', '2024-08-13 06:44:12', '2024-08-13 06:44:12'),
(61, 13, '2022', '2024-08-13 06:44:23', '2024-08-13 06:44:23'),
(62, 13, '2018', '2024-08-13 06:47:58', '2024-08-13 06:47:58'),
(63, 4, 'Mới', '2024-08-13 06:51:00', '2024-08-13 06:51:00'),
(64, 13, '2024', '2024-08-13 06:51:31', '2024-08-13 06:51:31'),
(65, 5, '18KW/100 KM', '2024-08-13 06:54:22', '2024-08-13 06:54:22'),
(66, 4, '14000KM', '2024-08-14 09:17:08', '2024-08-14 09:17:08'),
(67, 13, '2023', '2024-08-14 09:17:21', '2024-08-14 09:17:21'),
(68, 9, '12', '2024-08-17 08:54:44', '2024-08-17 08:54:44'),
(69, 13, '2015', '2024-08-17 08:55:06', '2024-08-17 08:55:06'),
(70, 5, '10KW/100 KM', '2024-10-05 08:28:59', '2024-10-05 08:28:59'),
(71, 7, 'Vàng Sa Mạc', '2024-10-05 08:29:16', '2024-10-05 08:29:16'),
(72, 9, '4', '2024-10-05 08:29:32', '2024-10-05 08:29:32'),
(73, 7, 'Xanh Dương', '2024-10-05 09:20:06', '2024-10-05 09:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Sedan (Hạng C)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-27 07:58:16', '2024-10-05 09:41:52'),
(2, 'SUV (Hạng B)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-27 07:59:27', '2024-06-28 02:38:24'),
(5, 'Hatback (Hạng A)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-27 08:07:47', '2024-08-15 22:01:00'),
(6, 'Bán Tải (Pick Up)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-27 08:15:21', '2024-06-27 09:14:17'),
(7, 'Sedan (Hạng D)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-27 08:34:09', '2024-06-27 08:34:09'),
(8, 'Sedan (Hạng B)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-27 19:15:17', '2024-06-27 19:15:17'),
(9, 'Sedan (Hạng E)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-27 19:17:09', '2024-06-27 19:17:09'),
(15, 'Sedan (Hạng S)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-28 02:17:50', '2024-06-28 02:17:50'),
(19, 'SUV (Hạng D)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-06-28 02:42:28', '2024-06-28 02:42:28'),
(20, 'SUV (Hạng C)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-08-13 06:52:18', '2024-08-15 22:02:41'),
(21, 'Xe Tải', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-08-15 21:48:32', '2024-08-15 22:04:10'),
(24, 'Xe Khách (16 Chỗ)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-08-15 22:06:43', '2024-08-15 22:06:43'),
(25, 'Xe Khách (29 Chỗ)', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-08-15 22:07:13', '2024-08-15 22:07:13'),
(26, 'Mini Hatback', 'upload/category/f69543a0f1b1c844dbd3eeee30ea0404.jpg', '2024-10-05 08:27:09', '2024-10-05 08:27:09');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_01_000000_create_user_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2024_06_25_064938_create_category_table', 1),
(6, '2024_06_25_064951_create_producer_table', 1),
(7, '2024_06_25_065005_create_attribute_table', 1),
(8, '2024_06_25_065014_create_attribute_spec_table', 1),
(9, '2024_06_25_065028_create_product_status_table', 1),
(10, '2024_06_25_065051_create_product_table', 1),
(11, '2024_06_25_065058_create_product_attribute_table', 1),
(12, '2024_06_25_065118_create_social_account_table', 1),
(13, '2024_06_25_065139_create_service_table', 1),
(14, '2024_06_27_140817_create_personal_access_tokens_table', 1),
(15, '2024_08_09_032141_add_facebook_id_to_users_table', 2),
(16, '2024_08_09_032858_add_facebook_columns_to_users_table', 3),
(17, '2024_08_09_040309_add_google_id_to_users_table', 4),
(18, '2024_08_09_085608_create_verification_codes_table', 5),
(19, '2024_08_09_093532_add_otp_fields_to_users_table', 6),
(20, '2024_08_09_101847_create_verification_codes_table', 7),
(21, '2024_08_09_152657_add_otp_fields_to_users_table', 8),
(22, '2024_08_10_075358_add_otp_columns_to_users_table', 9),
(23, '2024_06_25_064958_create_product_model_table', 10),
(24, '2024_08_13_145526_add_model_id_to_product_table', 11);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'auth_token', 'be09ca8bdc9c46dc4e7aeaec7cd06a5d4e3c6d7706a697df19f7488bcae0859a', '[\"*\"]', NULL, NULL, '2024-06-27 07:12:52', '2024-06-27 07:12:52'),
(2, 'App\\Models\\User', 2, 'auth_token', '44d4573afebbcb77e6818b67f6c95cc54af49d2b7a0a5e3b3cbe3bdea6af916f', '[\"*\"]', NULL, NULL, '2024-06-27 07:14:42', '2024-06-27 07:14:42'),
(3, 'App\\Models\\User', 2, 'auth_token', '3c7c651dca7e852ee4511373bbaff5d1155b8b4360b1ecca7ec1c9225cf5f063', '[\"*\"]', NULL, NULL, '2024-06-27 07:16:19', '2024-06-27 07:16:19'),
(4, 'App\\Models\\User', 2, 'auth_token', 'fa4c5a990c6b4aa3caa020d7a2f7a47dec46be24661809e33c7ecd213872470c', '[\"*\"]', NULL, NULL, '2024-06-27 07:16:58', '2024-06-27 07:16:58'),
(5, 'App\\Models\\User', 2, 'auth_token', '81aa3ec7ac62827abf379ff4550c67e68a10cacae0547a111abfdb7dd7de08aa', '[\"*\"]', NULL, NULL, '2024-06-27 07:17:33', '2024-06-27 07:17:33'),
(6, 'App\\Models\\User', 2, 'auth_token', '69284d6b646a06409a19e12c294251cdb9574074580cb2a71e5e89aa79a2c90f', '[\"*\"]', NULL, NULL, '2024-06-27 07:19:12', '2024-06-27 07:19:12'),
(7, 'App\\Models\\User', 2, 'auth_token', 'cf6acb1bc4b5684d0f0ab2e9dabc7ea832cd2d5926ec27489cb87c6d3048cf3c', '[\"*\"]', NULL, NULL, '2024-06-27 07:20:08', '2024-06-27 07:20:08'),
(8, 'App\\Models\\User', 2, 'auth_token', 'ce29fbdecae6d43d631906a6fa6959eb68db47987a682ca1dc707fd355d45b48', '[\"*\"]', NULL, NULL, '2024-06-27 07:20:19', '2024-06-27 07:20:19'),
(9, 'App\\Models\\User', 2, 'auth_token', '9abd7e9185f98f7fcb03873ad4bcac1166585ed97a58489df9964c13ce66296e', '[\"*\"]', NULL, NULL, '2024-06-27 07:23:57', '2024-06-27 07:23:57'),
(10, 'App\\Models\\User', 2, 'auth_token', '4b4f67f7d6c65cd53f51b3b7dd9c577bec407f927d5c2906679a8f954b8481c6', '[\"*\"]', NULL, NULL, '2024-06-27 07:25:08', '2024-06-27 07:25:08'),
(11, 'App\\Models\\User', 2, 'auth_token', '0283344601609932e5e647b3c37cdaa4802b9dedcb946c2d528a4390d877bbe4', '[\"*\"]', '2024-06-27 07:59:27', NULL, '2024-06-27 07:27:23', '2024-06-27 07:59:27'),
(12, 'App\\Models\\User', 2, 'auth_token', 'eebb843c5fc33fc24f17f2199e479dc0ec19f5623ab072a4c33548a2d6159bd7', '[\"*\"]', '2024-06-27 09:16:32', NULL, '2024-06-27 08:03:22', '2024-06-27 09:16:32'),
(13, 'App\\Models\\User', 3, 'auth_token', '87031f9da697062b142288cae0c6a05359a79f6dae8f0da1fc1ba2342be3cd3c', '[\"*\"]', NULL, NULL, '2024-06-27 09:18:18', '2024-06-27 09:18:18'),
(14, 'App\\Models\\User', 2, 'auth_token', 'b0819bc772372e61ab8e79a2f2f0273af886b0a000561c38b08354e9758b1fff', '[\"*\"]', '2024-06-28 02:15:25', NULL, '2024-06-27 09:18:35', '2024-06-28 02:15:25'),
(15, 'App\\Models\\User', 2, 'auth_token', '4083c88b7a0e23b223662f764fa05ae8f735873c38803394486acc06f27d6b96', '[\"*\"]', '2024-07-02 10:51:49', NULL, '2024-06-28 02:16:12', '2024-07-02 10:51:49'),
(16, 'App\\Models\\User', 1, 'auth_token', 'c5c0877971392e8001cb71ce004d61f67e3645ab4350279568c56e9fe76c9443', '[\"*\"]', '2024-07-02 11:00:34', NULL, '2024-07-02 10:56:03', '2024-07-02 11:00:34'),
(17, 'App\\Models\\User', 1, 'auth_token', '65a2acc6021efbe4e44c0a165e089f488884f52251cded31bd564338253ab4a4', '[\"*\"]', '2024-08-08 02:34:55', NULL, '2024-07-02 21:00:23', '2024-08-08 02:34:55'),
(18, 'App\\Models\\User', 1, 'auth_token', '4746aef8f441f07b738ea5c4f7a6234b97c06fa990be2dfc3fe676a1b44e63ae', '[\"*\"]', '2024-08-08 20:14:10', NULL, '2024-08-08 02:36:26', '2024-08-08 20:14:10'),
(19, 'App\\Models\\User', 1, 'auth_token', '450042b06b3df39910a875d7e1ae5fcf06162adecd09ac552d3a7bde014e4a4d', '[\"*\"]', NULL, NULL, '2024-08-08 21:14:49', '2024-08-08 21:14:49'),
(20, 'App\\Models\\User', 1, 'auth_token', 'e80204096bf6b69011848fdcfac9f2cb8afa935af218567d144ba572ede33558', '[\"*\"]', NULL, NULL, '2024-08-08 21:15:51', '2024-08-08 21:15:51'),
(21, 'App\\Models\\User', 1, 'auth_token', '1942ebfeac82328d74f2a31e5205488ac3b360768dc24fc7bbc0aba644a982c6', '[\"*\"]', NULL, NULL, '2024-08-08 21:21:19', '2024-08-08 21:21:19'),
(22, 'App\\Models\\User', 1, 'auth_token', '4026b46771b6d8beee667ce49353bdabfc2ee43fe2042b89d46c83c966e14a9f', '[\"*\"]', NULL, NULL, '2024-08-08 21:28:33', '2024-08-08 21:28:33'),
(23, 'App\\Models\\User', 1, 'auth_token', '6ee34a577c22295a4ceccde275cdcb6d0325257ceb74eee71b31e047f7f81b4a', '[\"*\"]', NULL, NULL, '2024-08-08 21:29:16', '2024-08-08 21:29:16'),
(24, 'App\\Models\\User', 1, 'auth_token', '2e255779b850a66ce1e41da3c0dfffbe814dbf7a5e58c56a4da5f5602b33698f', '[\"*\"]', NULL, NULL, '2024-08-08 21:37:29', '2024-08-08 21:37:29'),
(25, 'App\\Models\\User', 1, 'auth_token', 'ceed60eee1fc1a416a7e48881fbd8b13dccc57ae7e025030395ee11c7d084147', '[\"*\"]', NULL, NULL, '2024-08-08 21:39:13', '2024-08-08 21:39:13'),
(26, 'App\\Models\\User', 1, 'auth_token', '7c1eae7de2a05095ca8b8b381dcb2908d283a2e389688144fcf66e203ffaba4f', '[\"*\"]', NULL, NULL, '2024-08-08 21:41:33', '2024-08-08 21:41:33'),
(27, 'App\\Models\\User', 1, 'auth_token', '061312a0175a9c9a074e426878bb6582d99b994b4d378d19d7cd5bedfb97a364', '[\"*\"]', NULL, NULL, '2024-08-08 21:44:46', '2024-08-08 21:44:46'),
(28, 'App\\Models\\User', 1, 'auth_token', '3577fad98266f33617b0579049bae37fbf6d881b4ff32870ac4b4d0ebe4c7828', '[\"*\"]', NULL, NULL, '2024-08-08 21:47:57', '2024-08-08 21:47:57'),
(29, 'App\\Models\\User', 1, 'auth_token', '82a223c695400f628e646ee802c8a9d92b3a9594326cbb1c03960eebf5508106', '[\"*\"]', NULL, NULL, '2024-08-08 21:51:11', '2024-08-08 21:51:11'),
(30, 'App\\Models\\User', 1, 'auth_token', '24b2f84fcd7d300f65d004b384d70c3e3c5af794d65d837b12e6f65db6b5fad4', '[\"*\"]', NULL, NULL, '2024-08-08 22:52:14', '2024-08-08 22:52:14'),
(31, 'App\\Models\\User', 1, 'auth_token', '35494459a153ed02c29324ab6185b420ad8b53c4409ec49c1866189639597a8a', '[\"*\"]', NULL, NULL, '2024-08-08 22:57:38', '2024-08-08 22:57:38'),
(32, 'App\\Models\\User', 1, 'auth_token', '1be1438e854dfa48cf647aef459661ab5ee9d2d0dc5c38440908b06f1e5ed690', '[\"*\"]', NULL, NULL, '2024-08-08 22:57:41', '2024-08-08 22:57:41'),
(33, 'App\\Models\\User', 1, 'auth_token', '2ed4b434202c8fe6e32b7df797f1d6d2063ba07626dab521c48519ca56c59092', '[\"*\"]', NULL, NULL, '2024-08-08 22:58:15', '2024-08-08 22:58:15'),
(34, 'App\\Models\\User', 4, 'auth_token', 'e27fbc1d9223b3976873d0b3daa3e98d876b84d23c7f2e3780832c0d0970035a', '[\"*\"]', NULL, NULL, '2024-08-09 00:03:02', '2024-08-09 00:03:02'),
(35, 'App\\Models\\User', 1, 'auth_token', '06f5656dbcd6b7fdb257ec75c3df609ff8a5add11790db032f30473fa08ad0dc', '[\"*\"]', NULL, NULL, '2024-08-09 00:14:39', '2024-08-09 00:14:39'),
(36, 'App\\Models\\User', 1, 'auth_token', 'a1ee3496f2a5d24c27a576eff13385770ccfcfd399815cfcc7fe72733682fc55', '[\"*\"]', NULL, NULL, '2024-08-09 00:15:04', '2024-08-09 00:15:04'),
(37, 'App\\Models\\User', 10, 'auth_token', '6b552243063f9a68809fa3fa2c3b318e620835b702f3603b2e45eb6b30f456c0', '[\"*\"]', NULL, NULL, '2024-08-09 03:01:20', '2024-08-09 03:01:20'),
(38, 'App\\Models\\User', 1, 'auth_token', '8c03881629e83e8122932c73241d04cf6adc665c80b17c55cddbcf03d91b2744', '[\"*\"]', '2024-08-09 03:02:41', NULL, '2024-08-09 03:01:48', '2024-08-09 03:02:41'),
(39, 'App\\Models\\User', 10, 'auth_token', '33ef86702f59b1a5408d7a93fd4cc1328272863d22aff314b9f4014d271c6c12', '[\"*\"]', NULL, NULL, '2024-08-09 03:03:00', '2024-08-09 03:03:00'),
(40, 'App\\Models\\User', 1, 'auth_token', 'f0fcc3280f17924be49eb34fa0adcc2eafb271cfe29f6b2417cf6d40683e4324', '[\"*\"]', '2024-08-10 08:07:00', NULL, '2024-08-10 07:44:50', '2024-08-10 08:07:00'),
(41, 'App\\Models\\User', 28, 'auth_token', '4b4bbc45ca0929ea588e993485875eae950afd28ea2cab3926f23e35c631bcd0', '[\"*\"]', NULL, NULL, '2024-08-10 10:49:24', '2024-08-10 10:49:24'),
(42, 'App\\Models\\User', 28, 'auth_token', 'd5ab1eb2b43aa6695f92a459de17600567a25ff26ed74c15a9c0ad2d04486819', '[\"*\"]', NULL, NULL, '2024-08-10 10:56:19', '2024-08-10 10:56:19'),
(43, 'App\\Models\\User', 28, 'auth_token', 'e4430d156967e978b445706e70aabe13d2650aee4c384a9ad5f160d11f5c12d7', '[\"*\"]', NULL, NULL, '2024-08-10 11:54:19', '2024-08-10 11:54:19'),
(44, 'App\\Models\\User', 28, 'auth_token', 'bea57bb8974bb1a3d70a1ab1fa1387326eb3663c608282bb27321761e646e8ec', '[\"*\"]', NULL, NULL, '2024-08-10 11:56:46', '2024-08-10 11:56:46'),
(45, 'App\\Models\\User', 28, 'auth_token', 'b7c98ce02266ad1c4288e682d763b3313a82f3ab79dbd0e6fbbc8da610a7d0fe', '[\"*\"]', '2024-08-12 02:53:08', NULL, '2024-08-11 07:55:33', '2024-08-12 02:53:08'),
(46, 'App\\Models\\User', 28, 'auth_token', '860c0ab8ceafab0b3015a497e353640a4f7882b81ebfcbb11bb98056fc9f655f', '[\"*\"]', NULL, NULL, '2024-08-13 03:27:23', '2024-08-13 03:27:23'),
(47, 'App\\Models\\User', 28, 'auth_token', '5c1bd18b21b2a1849ac9312dc30a2c108c82861b8bd9a619da77f58427c50778', '[\"*\"]', '2024-08-13 10:05:01', NULL, '2024-08-13 06:40:54', '2024-08-13 10:05:01'),
(48, 'App\\Models\\User', 28, 'auth_token', '06e9d935c3e44d2a61c97370c779f738fdf9b6763decd730d6b5d2130235728e', '[\"*\"]', '2024-08-13 11:44:51', NULL, '2024-08-13 11:39:04', '2024-08-13 11:44:51'),
(49, 'App\\Models\\User', 1, 'auth_token', '87fb850bcc3129bf7f0bea95f449511f3b6271bf400466f57a6ccb41db2c346b', '[\"*\"]', NULL, NULL, '2024-08-13 11:45:34', '2024-08-13 11:45:34'),
(50, 'App\\Models\\User', 28, 'auth_token', '2c1b3d9907ab4e3a600462f026dca3c23689bcd8ea38db853b4d40a1fdc852cd', '[\"*\"]', '2024-08-13 19:38:20', NULL, '2024-08-13 19:37:57', '2024-08-13 19:38:20'),
(51, 'App\\Models\\User', 28, 'auth_token', 'f964f60cb38e1a8eec37e5a4d85433cecf47f65a75b1eabe1f710a197ae95b25', '[\"*\"]', '2024-08-13 23:26:04', NULL, '2024-08-13 23:04:59', '2024-08-13 23:26:04'),
(52, 'App\\Models\\User', 28, 'auth_token', 'f58c64224acb4b48fa0ff05fdaa6c5271db84d0ea8d23bbb922f6f149ede2c08', '[\"*\"]', NULL, NULL, '2024-08-14 08:16:34', '2024-08-14 08:16:34'),
(53, 'App\\Models\\User', 28, 'auth_token', '9db7fb575560ed685f55d0ab46873c6146c1924ddcbec836e19eb8b22fbf8fb9', '[\"*\"]', NULL, NULL, '2024-08-14 08:31:34', '2024-08-14 08:31:34'),
(54, 'App\\Models\\User', 28, 'auth_token', '84b63b17ac178fc3c7763ad84330c446ea324495ec173efbdf3a1d3d247745d4', '[\"*\"]', '2024-08-14 08:49:12', NULL, '2024-08-14 08:48:45', '2024-08-14 08:49:12'),
(55, 'App\\Models\\User', 27, 'auth_token', 'f0154b33ab65eec1890b9e06c67896f26ad8acc496068174a5bd40201a00428c', '[\"*\"]', '2024-08-14 09:17:30', NULL, '2024-08-14 09:01:17', '2024-08-14 09:17:30'),
(56, 'App\\Models\\User', 27, 'auth_token', 'ba78d71e1b1295238587f12aa07c24b01ed85aee914b5f6b960ad39bb8912328', '[\"*\"]', NULL, NULL, '2024-08-14 09:21:46', '2024-08-14 09:21:46'),
(57, 'App\\Models\\User', 27, 'auth_token', '4cf8d5dfa3bc761152c89584916e3ef607063e2618fdc538dae683d12c0b42c6', '[\"*\"]', '2024-08-14 09:28:41', NULL, '2024-08-14 09:23:42', '2024-08-14 09:28:41'),
(58, 'App\\Models\\User', 27, 'auth_token', '7b13bc0f67f63288f191dee50fa47843391fc67c1db75727a382028f5bc07197', '[\"*\"]', NULL, NULL, '2024-08-15 07:32:56', '2024-08-15 07:32:56'),
(59, 'App\\Models\\User', 27, 'auth_token', '7ee5bfcda35df9479c72f3a0286ce7901363dd32da30c21f92c573615af63ee2', '[\"*\"]', NULL, NULL, '2024-08-15 07:35:55', '2024-08-15 07:35:55'),
(60, 'App\\Models\\User', 27, 'auth_token', 'a06540eeb4a15fe4940b25ec2440b52de569ca42edb548d0d54017b03045987f', '[\"*\"]', NULL, NULL, '2024-08-15 09:30:45', '2024-08-15 09:30:45'),
(61, 'App\\Models\\User', 27, 'auth_token', '5c47b1ae9edad84d26771c5bfffa4b88be28caa14cc8a68f7a1be391ff98ee8e', '[\"*\"]', '2024-08-15 22:07:13', NULL, '2024-08-15 20:15:52', '2024-08-15 22:07:13'),
(62, 'App\\Models\\User', 28, 'auth_token', 'f9356a5f0ee9c2381d1ff02f26566f31c9f62525d1e65338bff2ced4676f38a4', '[\"*\"]', NULL, NULL, '2024-08-15 23:26:40', '2024-08-15 23:26:40'),
(63, 'App\\Models\\User', 27, 'auth_token', '17e27e41a18efbb5fc0757543cec402a6ffa0f1d70d8cd7e536a54a2c64addb9', '[\"*\"]', '2024-08-17 08:57:57', NULL, '2024-08-17 08:43:42', '2024-08-17 08:57:57'),
(64, 'App\\Models\\User', 28, 'auth_token', 'd39d705bcde968dc922ba64a28a931dabb46a571461fae9738c502036d48782c', '[\"*\"]', '2024-08-17 09:33:18', NULL, '2024-08-17 09:31:36', '2024-08-17 09:33:18'),
(65, 'App\\Models\\User', 28, 'auth_token', '9040e79ecb7b5bf6349c0fd4a6726be5106e477a9d8cacfe0dead3b041677ded', '[\"*\"]', '2024-08-17 10:45:28', NULL, '2024-08-17 09:42:35', '2024-08-17 10:45:28'),
(66, 'App\\Models\\User', 28, 'auth_token', 'bef1cdba8ba628e96288a5cfbffa05566ea942344a0fd9297eda0769a189b98e', '[\"*\"]', '2024-08-22 03:14:30', NULL, '2024-08-22 03:02:42', '2024-08-22 03:14:30'),
(67, 'App\\Models\\User', 28, 'auth_token', 'f532c2a3f31c49e013eba82dea9a55c2384798f47898147f422cc39ed9643f41', '[\"*\"]', '2024-09-17 21:29:46', NULL, '2024-09-17 21:17:51', '2024-09-17 21:29:46'),
(68, 'App\\Models\\User', 28, 'auth_token', '0146c0d872960198eba13b13400d492c14a22f3f5c3dd9d080c6714f63c4488e', '[\"*\"]', '2024-09-24 00:05:23', NULL, '2024-09-23 23:53:47', '2024-09-24 00:05:23'),
(69, 'App\\Models\\User', 28, 'auth_token', '50815acd0b0e336cff39dc30481b9b2cddccd6fb7c46b9f29a7c4e217155067c', '[\"*\"]', '2024-10-01 06:51:59', NULL, '2024-10-01 06:50:56', '2024-10-01 06:51:59'),
(70, 'App\\Models\\User', 28, 'auth_token', 'a9abf3c27b20fc16e82b3110667021c2b4382eb23ab6d3d9b57cc785c01d08ea', '[\"*\"]', '2024-10-03 19:42:27', NULL, '2024-10-03 19:41:24', '2024-10-03 19:42:27'),
(71, 'App\\Models\\User', 28, 'auth_token', '6ee31f0d8b9b8f08c3c734967c71015be84c09b2c09c0d04e748511de2f37ac0', '[\"*\"]', NULL, NULL, '2024-10-05 08:13:54', '2024-10-05 08:13:54'),
(72, 'App\\Models\\User', 28, 'auth_token', '37996938a9d69248241e570b1bfb96c601e6286b3af7f492430eb5491587e393', '[\"*\"]', '2024-10-05 09:41:52', NULL, '2024-10-05 08:18:48', '2024-10-05 09:41:52'),
(73, 'App\\Models\\User', 28, 'auth_token', 'c53211c48591ba0739d10f7d760a58c123aa49f7638b829e713d1495336c65b1', '[\"*\"]', NULL, NULL, '2024-10-05 10:38:42', '2024-10-05 10:38:42'),
(74, 'App\\Models\\User', 28, 'auth_token', 'df144e50ef041c1fe8e6d3703976caecb88fd80176a9e48a34ddf121b052ccf2', '[\"*\"]', '2024-10-06 08:30:44', NULL, '2024-10-06 07:40:13', '2024-10-06 08:30:44'),
(75, 'App\\Models\\User', 28, 'auth_token', '03bd00547bac1e0e428149234fa928a20bb8c684f97001a3d353ae41a73431cc', '[\"*\"]', NULL, NULL, '2024-10-06 08:56:16', '2024-10-06 08:56:16'),
(76, 'App\\Models\\User', 28, 'auth_token', '180b3fba3e3c4e23bc9aca94b08f96a15aba69aea6f6d10f76d6780ffac56596', '[\"*\"]', '2024-10-06 08:59:36', NULL, '2024-10-06 08:57:52', '2024-10-06 08:59:36'),
(77, 'App\\Models\\User', 28, 'auth_token', '18ebd4743f53ef698037d94f7a96c84cec297915dbe2feaae22920dfc3fd5f3b', '[\"*\"]', NULL, NULL, '2024-10-06 09:00:24', '2024-10-06 09:00:24'),
(78, 'App\\Models\\User', 28, 'auth_token', 'e7fce5d3cf2d21785549eb6b283400a0235c68360cdeaa6fe88b0adfc69a655d', '[\"*\"]', NULL, NULL, '2024-10-06 09:05:20', '2024-10-06 09:05:20'),
(79, 'App\\Models\\User', 28, 'auth_token', 'f648ed68341cf87114a12a6600bd2f2ab07e790c94e8db0940ef3ba1f49c75ae', '[\"*\"]', NULL, NULL, '2024-10-06 09:08:32', '2024-10-06 09:08:32'),
(80, 'App\\Models\\User', 28, 'auth_token', 'ba7948377e382ec74552e9abb74ebfe43521e0cf773127820dadf536f3b236cd', '[\"*\"]', NULL, NULL, '2024-10-06 09:09:29', '2024-10-06 09:09:29'),
(81, 'App\\Models\\User', 28, 'auth_token', '0bf7bedc216c1d61f599a1ac39a1107639bf468f87ecfeb6f8a49b7f282bf680', '[\"*\"]', NULL, NULL, '2024-10-06 09:11:56', '2024-10-06 09:11:56'),
(82, 'App\\Models\\User', 28, 'auth_token', '26a0b41d841b85fc8ddfa03f1bfa1933b5158d39a4835e8078c8df90edd80292', '[\"*\"]', NULL, NULL, '2024-10-06 09:16:16', '2024-10-06 09:16:16'),
(83, 'App\\Models\\User', 28, 'auth_token', 'e0e52141ff88c1a44dd921549180555a842f6de9b31b1521fa7348c099dea659', '[\"*\"]', NULL, NULL, '2024-10-06 09:17:59', '2024-10-06 09:17:59'),
(84, 'App\\Models\\User', 28, 'auth_token', 'a022f262012e449e607baa12e7b4a7cd4b10f88b0f2d6b6af22bbb44e8ee8046', '[\"*\"]', '2024-10-07 00:48:05', NULL, '2024-10-07 00:48:03', '2024-10-07 00:48:05'),
(85, 'App\\Models\\User', 28, 'auth_token', '7da17245cff24590a9628561232f792c8359c6c25a76f3caab575f2c0a2517a3', '[\"*\"]', '2024-10-07 00:56:41', NULL, '2024-10-07 00:48:54', '2024-10-07 00:56:41'),
(86, 'App\\Models\\User', 29, 'auth_token', '10d98d059f3984288c2adec7ab9b9ac9426f872b257bb4aa8141efacf261e1b8', '[\"*\"]', '2024-10-07 03:10:01', NULL, '2024-10-07 02:47:07', '2024-10-07 03:10:01'),
(87, 'App\\Models\\User', 29, 'auth_token', 'ff309f224f81f94ca546f07832dee6e97f2521cc9b9a9604bf916f3c65350657', '[\"*\"]', '2024-10-07 03:21:18', NULL, '2024-10-07 03:10:43', '2024-10-07 03:21:18'),
(88, 'App\\Models\\User', 28, 'auth_token', '5212a30a7898b6eb8d81f21fdcece769cf073c3b6d4e003c00ffe6c7a4867094', '[\"*\"]', '2024-10-07 23:19:53', NULL, '2024-10-07 23:14:50', '2024-10-07 23:19:53'),
(89, 'App\\Models\\User', 28, 'auth_token', '1a573f9b974387f601b6d5d1fc2f5d909cac647d57358127eb35c665ff75e769', '[\"*\"]', '2024-10-07 23:31:51', NULL, '2024-10-07 23:20:58', '2024-10-07 23:31:51'),
(90, 'App\\Models\\User', 28, 'auth_token', '7fd7d99dd52981f091cbb4b7954aaac3f00e992378dc2a1bf4f4d2949034fcd2', '[\"*\"]', '2024-10-08 00:06:57', NULL, '2024-10-07 23:33:25', '2024-10-08 00:06:57'),
(91, 'App\\Models\\User', 29, 'auth_token', 'f5d922cd5ba8470e636f036b4835b20305093454302ec6ea931914a6f7667dfe', '[\"*\"]', '2024-10-08 01:00:30', NULL, '2024-10-08 00:07:52', '2024-10-08 01:00:30'),
(92, 'App\\Models\\User', 28, 'auth_token', 'b99f382e55e05a385934c83c139bb662edad0c57dcca13525d577ce67dc59f7f', '[\"*\"]', '2024-10-08 03:09:47', NULL, '2024-10-08 02:55:03', '2024-10-08 03:09:47'),
(93, 'App\\Models\\User', 28, 'auth_token', '89309db7514e47121cdfb3f9cab778e1ed41ce4f55f620c05f86dca9db70ad38', '[\"*\"]', '2024-10-09 00:00:23', NULL, '2024-10-08 19:27:43', '2024-10-09 00:00:23'),
(94, 'App\\Models\\User', 28, 'auth_token', 'b221edf1bc0082c538bb78ac88b222cee55fa93111a8d6b945832667a3922bf9', '[\"*\"]', '2024-10-09 03:16:11', NULL, '2024-10-09 00:19:11', '2024-10-09 03:16:11'),
(95, 'App\\Models\\User', 28, 'auth_token', '01906bb94bd96bb7b00680e7aa721e629b677f7d9f858a53253d759fd555c013', '[\"*\"]', '2024-10-09 23:38:22', NULL, '2024-10-09 23:38:17', '2024-10-09 23:38:22'),
(96, 'App\\Models\\User', 20, 'auth_token', 'd8e375aa3ea0adbcda28703d51018c2a85f62d9801439bab0f5ebe0c74fbf203', '[\"*\"]', '2024-10-09 23:39:41', NULL, '2024-10-09 23:38:52', '2024-10-09 23:39:41'),
(97, 'App\\Models\\User', 20, 'auth_token', 'a2d1462919cea5a3e879c90e5a38258752d6c5103a1c731206473362af857035', '[\"*\"]', '2024-10-09 23:39:57', NULL, '2024-10-09 23:39:56', '2024-10-09 23:39:57'),
(98, 'App\\Models\\User', 28, 'auth_token', 'd1d581cab49e9d40c297fbd332567f408dd3665ad10388cd891fb300d06618d1', '[\"*\"]', '2024-10-10 01:35:36', NULL, '2024-10-09 23:40:33', '2024-10-10 01:35:36'),
(99, 'App\\Models\\User', 28, 'auth_token', '6123ea109bd4e4baf5320e8d173dc5201e706857166542702402586401300ca7', '[\"*\"]', '2024-10-10 00:20:40', NULL, '2024-10-10 00:14:22', '2024-10-10 00:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `producer`
--

CREATE TABLE `producer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producer`
--

INSERT INTO `producer` (`id`, `name`, `logo`, `created_at`, `updated_at`) VALUES
(2, 'Toyota', 'upload/producer/dc16622ddc767e6bc1200fe5df2fbdfb.png', '2024-06-27 20:16:05', '2024-10-05 09:38:02'),
(3, 'Huyndai', 'upload/producer/c6d6445d97e06d08b60853156601cf58.jpg', '2024-06-27 20:21:53', '2024-10-05 09:38:19'),
(4, 'Kia', 'upload/producer/9d8df73a3cfbf3c5b47bc9b50f214aff.jpg', '2024-06-27 20:22:05', '2024-10-05 09:38:46'),
(5, 'Nissan', 'upload/producer/2a8a812400df8963b2e2ac0ed01b07b8.png', '2024-06-27 20:22:22', '2024-10-05 09:39:03'),
(6, 'Mecerdes Bens', 'upload/producer/37e7897f62e8d91b1ce60515829ca282.png', '2024-06-27 20:22:40', '2024-10-05 09:39:15'),
(7, 'Mitsubitshi', 'upload/producer/49c0b9d84c2a16fcaf9d25694fda75e1.png', '2024-06-27 20:23:15', '2024-10-05 09:39:38'),
(8, 'Chervolet', 'upload/producer/42778ef0b5805a96f9511e20b5611fce.webp', '2024-06-27 20:23:26', '2024-10-05 09:40:06'),
(9, 'BMW', 'upload/producer/05a5cf06982ba7892ed2a6d38fe832d6.png', '2024-06-27 20:23:43', '2024-10-05 09:40:19'),
(10, 'Audi', 'upload/producer/bf9ce4f69ab045fb497f79b7b5d7622e.png', '2024-06-27 20:23:58', '2024-10-05 09:40:34'),
(11, 'Ford', 'upload/producer/766d856ef1a6b02f93d894415e6bfa0e.jpg', '2024-06-27 20:24:44', '2024-10-05 09:40:47'),
(12, 'Honda', 'upload/producer/1b72746255ef01f9d75400995c62ea12.webp', '2024-06-27 21:17:55', '2024-10-05 09:40:58'),
(13, 'VinFast', 'upload/producer/8c3039bd5842dca3d944faab91447818.jpg', '2024-08-07 09:16:44', '2024-10-05 09:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `producer_id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `producer_id`, `model_id`, `status_id`, `name`, `price`, `thumbnail`, `gallery`, `description`, `created_at`, `updated_at`) VALUES
(14, 20, 6, 7, 1, 'Mercedes Benz GLC 300 4Matic 2018', '1.240.000.000 ₫', 'upload/product/thumbnail/9afe487de556e59e6db6c862adfe25a4.jpeg', '|upload/product/gallery/5df0385cba256a135be596dbe28fa7aa.jpeg|upload/product/gallery/d60678e8f2ba9c540798ebbde31177e8.jpeg|upload/product/gallery/838f14a84363d9a7ac1b06ad63fc6fb5.jpeg|upload/product/gallery/da647c549dde572c2c5edc4f5bef039c.jpeg|upload/product/gallery/5dca4c6b9e244d24a30b4c45601d9720.jpeg|upload/product/gallery/7a5200e5e9b3a893e1c2b0ccba7dd72f.jpeg|upload/product/gallery/84c6494d30851c63a55cdb8cb047fadd.jpeg|upload/product/gallery/17f98ddf040204eda0af36a108cbdea4.jpeg', 'Nhập team Mer GLC 300 4Matic 2018  xe đã chạy hơn 3vạn Miles cực mới xe đã kiểm tra check test đầy đủ chứng chỉ việc chén . Mời Các Chủ tịch .\r\nACE kết nối có khách cùng bán. Thank’s!\r\nỞ đâu giá tốt đây sẽ tốt hơn. Giá rất linh động miễn sao vào việc trôi được xe', '2024-08-06 21:15:19', '2024-10-05 09:14:48'),
(15, 6, 11, 16, 1, 'Ford Ranger Raptor 2.0L 4x4 AT 2019', '995.000.000 ₫', 'upload/product/thumbnail/58aaee7ae94b52697ad3b9275d46ec7f.jpg', '|upload/product/gallery/6a6e3ec7373f2a5d2fdb3e4e5b80debd.jpg|upload/product/gallery/28498620653e59a7e22c2b50748e2766.jpg|upload/product/gallery/ca4b33532855080dfa79cf8a925d146d.jpg|upload/product/gallery/0660895c22f8a14eb039bfb9beb0778f.jpg|upload/product/gallery/7eb532aef980c36170c0b4426f082b87.jpg|upload/product/gallery/a0046ad4c1bafc4ef04e41e755f28368.jpg|upload/product/gallery/3d8a0e750ff4f9b65d2c112a7095d1ce.jpg', 'Ford ranger Raptor 2019 ko niên hạn, Odo 53.000km cực mới\r\n- Trang bị:\r\n+ Vô lăng 4 chấu bọc da khỏe khoắn, tích hợp nhiều phím chức năng. Lẫy chuyển số\r\n+ Điều hòa tự động 2 vùng độc lập\r\n+ Màn hình cảm ứng 8 inch\r\n+ Dàn âm thanh 6 loa\r\n+ Ra lệnh giọng nói SYNC 3', '2024-08-08 02:58:51', '2024-10-05 09:20:19'),
(16, 1, 13, 9, 1, 'Xe VinFast Lux A 2.0 Tiêu chuẩn 2022', '605.000.000 ₫', 'upload/product/thumbnail/05b8caaf6ba6f4bdb68675ab8b893bda.jpg', '|upload/product/gallery/82356b37a12462391abf004c8362d389.jpg|upload/product/gallery/0e230b1a582d76526b7ad7fc62ae937d.jpg|upload/product/gallery/33c5f5bff65aa05a8cd3e5d2597f44ae.jpg|upload/product/gallery/c850c535b6b72487b20cee5d7434506d.jpg', 'Lux A Base Xám 2022\r\nTư nhân 1 chủ, odo hơn 3v km rất mới\r\nXe đã phay vành, dán phim sàn kata đầy đủ\r\nBao check test mọi gara theo yêu cầu', '2024-08-08 03:08:40', '2024-10-05 09:22:44'),
(17, 19, 3, 10, 1, 'Xe Hyundai SantaFe 2.4L HTRAC 2020', '889.000.000 ₫', 'upload/product/thumbnail/255ea887b8bca36797426dfb35a809cc.jpg', '|upload/product/gallery/22722a343513ed45f14905eb07621686.jpg|upload/product/gallery/838e8afb1ca34354ac209f53d90c3a43.jpg|upload/product/gallery/a5e308070bd6dd3cc56283f2313522de.jpg|upload/product/gallery/cfcce0621b49c983991ead4c3d4d3b6b.jpg|upload/product/gallery/fdc42b6b0ee16a2f866281508ef56730.jpg|upload/product/gallery/331cc28f8747a032890d0429b5a5f0e5.jpg|upload/product/gallery/565e8a413d0562de9ee4378402d2b481.jpg|upload/product/gallery/8208974663db80265e9bfe7b222dcb18.jpg|upload/product/gallery/58ec998e5f04921d22afdd67759db6e4.jpg', 'Hyundai Santafe 2022 máy xăng bản đặc biệt\r\nXe chạy hơn 6v km\r\nXe còn rất mới\r\nMột chủ từ mới\r\nGiá thì êm ru luôn\r\nAlo là mua được xe\r\nCam kết chất lượng\r\nBao test toàn quốc', '2024-08-11 08:13:56', '2024-10-05 09:25:27'),
(18, 1, 4, 1, 1, 'Xe Kia K3 Premium 2.0 AT 2022', '595.000.000 ₫', 'upload/product/thumbnail/e93028bdc1aacdfb3687181f2031765d.jpg', '|upload/product/gallery/a3a3e8b30dd6eadfc78c77bb2b8e6b60.jpg|upload/product/gallery/561918f13a2832726ec7f2e16ecd76c1.jpg|upload/product/gallery/dccb1c3a558c50d389c24d69a9856730.jpg|upload/product/gallery/81baadacf39a11c56ee30acd5455fced.jpg|upload/product/gallery/88cf91a1aef212f3c2cd12406983427d.jpg|upload/product/gallery/92f54963fc39a9d87c2253186808ea61.jpg|upload/product/gallery/2b763288faedb7707c0748abe015ab6c.jpg|upload/product/gallery/a9fb9e6ef40426e9add520623d521ab8.jpg|upload/product/gallery/dab10c50dc668cd8560df444ff3a4227.jpg', 'Kia k3 2.0 2022 premium màu trắng\r\nCửa nóc . Đề nổ . Màn hình cam lùi . Điều hoà tự động nhớ ghế\r\n\r\nXe máy móc nguyên bản.\r\nĐảm bảo không đâm đụng ngập nước.', '2024-08-13 06:44:32', '2024-10-08 02:56:45'),
(20, 19, 7, 11, 1, 'Xe Mitsubishi Xforce Exceed 2024', '576.000.000 ₫', 'upload/product/thumbnail/16105fb9cc614fc29e1bda00dab60d41.jpg', '|upload/product/gallery/0cb5ebb1b34ec343dfe135db691e4a85.jpg|upload/product/gallery/3e33b970f21d2fc65096871ea0d2c6e4.jpg|upload/product/gallery/6bb56208f672af0dd65451f869fedfd9.jpg|upload/product/gallery/8ab9bb97ce35080338be74dc6375e0ed.jpg|upload/product/gallery/e48382353dc6c66379fb8e1ebf48c5e8.jpg|upload/product/gallery/d8330f857a17c53d217014ee776bfd50.jpg|upload/product/gallery/a36e841c5230a79c2102036d2e259848.jpg|upload/product/gallery/1f187c8bc462403c4646ab271007edf4.jpg|upload/product/gallery/4dbf29d90d5780cab50897fb955e4373.jpg', 'Điểm nổi bật của Mitsubishi Xforce:\r\n- Kích thước lớn nhất phân khúc, khoảng sáng gầm 222 mm\r\n- Ngoại thất: hệ thống chiếu sáng LED, mâm 18 inch\r\n- Nội thất: màn hình 12,3 inch cảm ứng, âm thanh Yamaha Premium, điều hoà tự động 2 vùng, lọc không khí\r\n- Động cơ 1.5L, hộp số CVT, dẫn động cầu trước, 4 chế độ lái theo địa hình\r\n- Công nghệ an toàn: hệ thống cảnh báo va chạm, hỗ trợ phanh khẩn cấp và điều khiển hành trình thích ứng giúp duy trì an toàn trong suốt hành trình, cảnh báo điểm mù và cảnh báo phương tiện cắt ngang khi lùi xe…\r\n- Nhập khẩu Indonesia\r\nLiên hệ ngay để nhận báo giá lăn bánh tốt nhất cho từng phiên bản.', '2024-08-13 06:51:37', '2024-10-05 09:31:48'),
(21, 20, 13, 12, 1, 'Xe VinFast VF7 Plus 2024', '999.000.000 ₫', 'upload/product/thumbnail/45e81409831b77407fbc22afc09f0d78.jpg', '|upload/product/gallery/64f173a41d2ffa62f98c0cfec53b43c5.jpg|upload/product/gallery/093b60fd0557804c8ba0cbf1453da22f.jpg|upload/product/gallery/d210cf373cf002a04ec72ee395f66306.jpg|upload/product/gallery/62f91ce9b820a491ee78c108636db089.jpg', 'VINFAST VF7 - Giao xe ngay, đủ màu lựa chọn!\r\nCHÍNH SÁCH ưu đãi ngắn hạn\r\n• Thời gian áp dụng: Từ ngày 25/07 – 31/08/2024\r\n• Tặng 02 năm bảo hiểm thân vỏ và PIN, và 10 triệu VNĐ trong ví\r\nVinclub (có hiệu lực kể từ ngày ra mắt Vinclub, có thể dùng đặt phụ kiện dịch vụ VINFAST, VINPEARL, VINMEC…)', '2024-08-13 06:54:39', '2024-10-05 09:16:55'),
(22, 6, 7, 13, 1, 'Xe Mitsubishi Triton Athlete 4x2 AT 2023', '660.000.000 ₫', 'upload/product/thumbnail/ff1d4796fe85a21ba86081db7bf2196b.jpg', '|upload/product/gallery/d1ff1ec86b62cd5f3903ff19c3a326b2.jpg|upload/product/gallery/584b98aac2dddf59ee2cf19ca4ccb75e.jpg|upload/product/gallery/18085327b86002fc604c323b9a07f997.jpg|upload/product/gallery/15a50c8ba6a0002a2fa7e5d8c0a40bd9.jpg|upload/product/gallery/62db9e3397c76207a687c360e0243317.jpg', 'Triton Athele 4x2 sản xuất 2023 chạy chuẩn 14.000 km \" full lịch sử hãng sai tặng xe “\r\nXe như mới lốp theo xe cả dàn , sơ cua chưa hạ\r\n- Xe cam kết không đâm đụng, không ngập nước, bao check hãng toàn quốc.\r\n- Hỗ trợ sang tên đổi chủ, thủ tục giấy tờ pháp lý rõng ràng.\r\n- Chế độ bảo hành hậu mãi, chăm sóc xe miễn phí sau khi mua xe\r\nLiên hệ để biết thêm thông tin xe', '2024-08-14 09:12:19', '2024-10-05 09:29:50'),
(23, 1, 6, 14, 1, 'Xe Mercedes Benz C class C200 2015', '580.000.000 ₫', 'upload/product/thumbnail/4be5a36cbaca8ab9d2066debfe4e65c1.jpg', '|upload/product/gallery/23ad3e314e2a2b43b4c720507cec0723.jpg|upload/product/gallery/ce840aa9583592e71f3db26ee6e41703.jpg|upload/product/gallery/9d86d83f925f2149e9edb0ac3b49229c.jpg|upload/product/gallery/a7eb3f86b0d99361a5053a41d7d38576.jpg|upload/product/gallery/2d579dc29360d8bbfbb4aa541de5afa9.jpg|upload/product/gallery/69d658d0b2859e32cd4dc3b970c8496c.jpg|upload/product/gallery/0f0d67e214f9fef69b278e3d08114da9.jpg|upload/product/gallery/fe51510c80bfd6e5d78a164cd5b1f688.jpg|upload/product/gallery/c5cc17e395d3049b03e0f1ccebb02b4d.jpg', 'Bán nhanh c200 siêu mới giá êm, hỗ trợ bank ạ', '2024-08-17 08:55:15', '2024-10-05 09:08:43'),
(24, 26, 13, 15, 1, 'VinFast VF3', '320.000.000 ₫', 'upload/product/thumbnail/1b62ff22e70a7197fa1f3f34fa2b7f65.jpg', 'upload/product/gallery/ddf354219aac374f1d40b7e760ee5bb7.jpg|upload/product/gallery/7364e0bb7f15ebfbc9e12d5b13f51a02.jpg|upload/product/gallery/58ae23d878a47004366189884c2f8440.jpg', 'VF3 mới 100% bản mua pin', '2024-10-05 08:32:07', '2024-10-05 08:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_spec_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `product_id`, `attribute_spec_id`, `created_at`, `updated_at`) VALUES
(627, 24, 2, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(628, 24, 4, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(629, 24, 7, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(630, 24, 63, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(631, 24, 70, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(632, 24, 14, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(633, 24, 71, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(634, 24, 23, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(635, 24, 72, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(636, 24, 40, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(637, 24, 49, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(638, 24, 51, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(639, 24, 64, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(640, 24, 56, '2024-10-05 08:32:07', '2024-10-05 08:32:07'),
(725, 23, 2, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(726, 23, 4, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(727, 23, 5, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(728, 23, 9, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(729, 23, 12, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(730, 23, 14, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(731, 23, 18, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(732, 23, 26, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(733, 23, 68, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(734, 23, 48, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(735, 23, 49, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(736, 23, 51, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(737, 23, 69, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(738, 23, 54, '2024-10-05 09:08:43', '2024-10-05 09:08:43'),
(739, 14, 2, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(740, 14, 4, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(741, 14, 5, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(742, 14, 9, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(743, 14, 12, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(744, 14, 14, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(745, 14, 18, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(746, 14, 26, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(747, 14, 39, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(748, 14, 48, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(749, 14, 49, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(750, 14, 51, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(751, 14, 62, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(752, 14, 54, '2024-10-05 09:14:48', '2024-10-05 09:14:48'),
(753, 21, 2, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(754, 21, 4, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(755, 21, 7, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(756, 21, 63, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(757, 21, 65, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(758, 21, 14, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(759, 21, 18, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(760, 21, 22, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(761, 21, 60, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(762, 21, 48, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(763, 21, 49, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(764, 21, 51, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(765, 21, 64, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(766, 21, 56, '2024-10-05 09:16:55', '2024-10-05 09:16:55'),
(767, 15, 2, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(768, 15, 4, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(769, 15, 6, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(770, 15, 9, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(771, 15, 12, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(772, 15, 14, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(773, 15, 73, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(774, 15, 22, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(775, 15, 42, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(776, 15, 48, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(777, 15, 50, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(778, 15, 51, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(779, 15, 53, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(780, 15, 54, '2024-10-05 09:20:19', '2024-10-05 09:20:19'),
(781, 16, 2, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(782, 16, 4, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(783, 16, 5, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(784, 16, 8, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(785, 16, 12, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(786, 16, 14, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(787, 16, 18, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(788, 16, 22, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(789, 16, 42, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(790, 16, 48, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(791, 16, 49, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(792, 16, 51, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(793, 16, 55, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(794, 16, 56, '2024-10-05 09:22:44', '2024-10-05 09:22:44'),
(795, 17, 2, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(796, 17, 4, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(797, 17, 6, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(798, 17, 9, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(799, 17, 12, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(800, 17, 15, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(801, 17, 18, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(802, 17, 22, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(803, 17, 42, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(804, 17, 48, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(805, 17, 50, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(806, 17, 51, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(807, 17, 57, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(808, 17, 54, '2024-10-05 09:25:27', '2024-10-05 09:25:27'),
(823, 22, 2, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(824, 22, 3, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(825, 22, 6, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(826, 22, 66, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(827, 22, 12, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(828, 22, 14, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(829, 22, 18, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(830, 22, 25, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(831, 22, 42, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(832, 22, 40, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(833, 22, 50, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(834, 22, 51, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(835, 22, 67, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(836, 22, 54, '2024-10-05 09:29:50', '2024-10-05 09:29:50'),
(837, 20, 2, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(838, 20, 4, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(839, 20, 5, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(840, 20, 63, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(841, 20, 59, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(842, 20, 14, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(843, 20, 17, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(844, 20, 22, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(845, 20, 60, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(846, 20, 48, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(847, 20, 49, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(848, 20, 51, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(849, 20, 64, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(850, 20, 54, '2024-10-05 09:31:48', '2024-10-05 09:31:48'),
(851, 18, 2, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(852, 18, 4, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(853, 18, 5, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(854, 18, 58, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(855, 18, 59, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(856, 18, 14, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(857, 18, 18, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(858, 18, 25, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(859, 18, 60, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(860, 18, 40, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(861, 18, 50, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(862, 18, 51, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(863, 18, 61, '2024-10-08 02:56:45', '2024-10-08 02:56:45'),
(864, 18, 56, '2024-10-08 02:56:45', '2024-10-08 02:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_model`
--

CREATE TABLE `product_model` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_model`
--

INSERT INTO `product_model` (`id`, `producer_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 4, 'K3', '2024-08-13 14:58:21', '2024-08-13 08:19:59'),
(3, 4, 'Cerato', '2024-08-13 08:12:07', '2024-08-13 08:12:07'),
(4, 4, 'K5', '2024-08-13 08:15:46', '2024-08-13 08:15:46'),
(5, 2, 'Inova', '2024-08-13 09:36:17', '2024-08-13 09:36:17'),
(7, 6, 'GLC 300', '2024-08-13 10:00:25', '2024-08-13 10:00:25'),
(8, 11, 'Ranger', '2024-08-13 10:02:01', '2024-08-13 10:02:01'),
(9, 13, 'Lux A', '2024-08-13 10:02:45', '2024-08-13 10:02:45'),
(10, 3, 'Santafe', '2024-08-13 10:03:10', '2024-08-13 10:03:10'),
(11, 7, 'Exforce', '2024-08-13 10:04:05', '2024-08-13 10:04:05'),
(12, 13, 'VF7', '2024-08-13 10:04:27', '2024-08-13 10:04:27'),
(13, 7, 'Tritton', '2024-08-14 09:05:13', '2024-08-14 09:05:13'),
(14, 6, 'C200', '2024-08-17 08:53:47', '2024-08-17 08:53:47'),
(15, 13, 'VF3', '2024-10-05 08:27:25', '2024-10-05 08:27:25'),
(16, 11, 'Raptor', '2024-10-05 09:18:56', '2024-10-05 09:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mới về', '2024-07-01 01:08:13', '2024-07-01 01:08:13'),
(2, 'Đã Nhận Cọc', '2024-07-01 01:08:22', '2024-07-01 01:08:22'),
(3, 'Cắt Lỗ', '2024-07-01 01:08:31', '2024-07-01 01:08:31'),
(4, 'Chờ Giao', '2024-07-01 01:08:39', '2024-07-01 01:08:39'),
(5, 'Rút Hồ Sơ', '2024-07-01 01:08:47', '2024-07-01 01:08:47'),
(6, 'Đã Bán', '2024-08-07 09:17:44', '2024-08-07 09:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `param` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3kgN0WiZqG2cv6ua6UNwqwB6JLXyCDeu3ROebIhH', 28, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoieEVkekpWUzFPeXhDYTE2ZHVFMUQ4Y1ZvS0FnaXlEMFhQTEhUUnJlMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0LWxpc3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyODtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3Mjg1NDI0MzM7fXM6OToiand0X3Rva2VuIjtzOjUxOiI5OHxLb3dnRUhKdWZISWtsdUNrYzFvS0FlYVBuY01uWGZVdTJZMzdpcE8zYzRlZTExMjIiO30=', 1728549335),
('ElfDjNF4oDjpn8bmtLECwOdghAflB869ch0kz8p3', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEhTdmZodW1kN3lCZnpLbXF5aUhEdmpTY0RTNTJMd29KY1E5ZHZEeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xYTY4LTJhMDktYmFjMS03YWEwLTUwLTAwLTI0Ny1iZC5uZ3Jvay1mcmVlLmFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1728544339),
('FuIonugIiyQto2XUZUp5PjoSI2ZachPhy0Q3l82b', NULL, '127.0.0.1', '', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZDVZcWY1NGdLYjlYWXNNNzNkMU85U2hIMlNhSUJrMTJ6YWkxTndIRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1728544393),
('gTChWzY0K5dGrWHIwT68BgNoDCvsoJjmxCaM2nTu', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFlwR1VTOGZoWmZEcWMxQTRETkxpOVp1dWQyMFdSVEgyeENFdFNweSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9iMzFmLTJhMDktYmFjMS03YWEwLTUwLTAwLTI0Ny1iZC5uZ3Jvay1mcmVlLmFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1728543996),
('muoPuF75IDizxs78M3ar7COVtl4lGc8WAQzzig0e', 28, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.0.1 Mobile/15E148 Safari/604.1', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidDdTZkh1d3B1M24xaGdNSlVqT1BRWHFFWUVxNmg2VURnRlZ1Rk1DMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHA6Ly8xYTY4LTJhMDktYmFjMS03YWEwLTUwLTAwLTI0Ny1iZC5uZ3Jvay1mcmVlLmFwcC9hZG1pbi9mYWNlYm9vay1pbnRlZ3JhdGlvbi1wb3N0P3BhZ2U9MiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI4O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTcyODU0NDQ2Mjt9czo5OiJqd3RfdG9rZW4iO3M6NTE6Ijk5fHBheDgwTno2R3pXWlp0eTg5d3FEVlNFMGxuZVFRdmR3U0RmQThsZjllY2QzYzQ4ZSI7fQ==', 1728544847);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `roles_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_token` text COLLATE utf8mb4_unicode_ci,
  `facebook_refresh_token` text COLLATE utf8mb4_unicode_ci,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expiry` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles_id`, `remember_token`, `created_at`, `updated_at`, `facebook_id`, `facebook_token`, `facebook_refresh_token`, `google_id`, `avatar`, `otp`, `otp_expiry`) VALUES
(20, 'Thu Hiền', 'Hienco120699@gmail.com', NULL, '$2y$12$ba.K9SemiIPkLbKy5X8ApO2TI2cdwO6nvaq.2xVl/hUo29ZzVt3kK', 1, NULL, '2024-08-10 03:40:02', '2024-10-09 23:39:40', NULL, NULL, NULL, NULL, 'upload/user/1db3fa8e5bbd04882892f478a301a311.webp', NULL, NULL),
(28, 'Nguyễn Văn Tùng', 'ntung2912699@gmail.com', NULL, '$2y$12$OfTQiZN.seFLvUunN7u/ku8hzN6aYuKdhv0s7u4JhBO0K3/DX4ZNO', 11, 'NfQ0zalU8ozRdRZoWac4NtjO5qSvixqELFJZ1MB7lYwfNo0a5MDIvc7omvuA', '2024-08-10 09:40:08', '2024-10-10 00:15:21', NULL, NULL, NULL, '110274837145677691818', 'upload/user/29c0c0ee223856f336d7ea8052057753.jpeg', NULL, NULL),
(29, 'Nguyễn Văn Tùng', 'ntung9921@gmail.com', NULL, '$2y$12$un/LkWxfxFmkT9XzLtAi8OIH0AbMXC9CiMTJc5Jut7HnTBST5.dZ2', 11, 'bQAj5cVR3dhlX9gQRHBbVC0z25xPT4neSaWkJn0MNL5IW02F7DitMfKkYG6K', '2024-10-03 21:26:22', '2024-10-07 03:10:00', NULL, NULL, NULL, NULL, 'upload/user/0b33f2e8843e8b440dd8caf7086995b0.webp', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'USER', '2024-06-27 14:04:18', '2024-06-27 14:04:18'),
(11, 'ADMIN', '2024-06-27 14:04:18', '2024-06-27 14:04:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_name_unique` (`name`);

--
-- Indexes for table `attribute_spec`
--
ALTER TABLE `attribute_spec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_spec_attribute_id_foreign` (`attribute_id`);

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name_unique` (`name`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producer_name_unique` (`name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_foreign` (`category_id`),
  ADD KEY `product_producer_id_foreign` (`producer_id`),
  ADD KEY `product_status_id_foreign` (`status_id`),
  ADD KEY `product_model_id_foreign` (`model_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_product_id_foreign` (`product_id`),
  ADD KEY `product_attribute_attribute_spec_id_foreign` (`attribute_spec_id`);

--
-- Indexes for table `product_model`
--
ALTER TABLE `product_model`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_model_name_unique` (`name`),
  ADD KEY `product_model_producer_id_foreign` (`producer_id`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_status_name_unique` (`name`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_facebook_id_unique` (`facebook_id`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`),
  ADD KEY `users_roles_id_foreign` (`roles_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `attribute_spec`
--
ALTER TABLE `attribute_spec`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `producer`
--
ALTER TABLE `producer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=865;

--
-- AUTO_INCREMENT for table `product_model`
--
ALTER TABLE `product_model`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_spec`
--
ALTER TABLE `attribute_spec`
  ADD CONSTRAINT `attribute_spec_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `product_model` (`id`),
  ADD CONSTRAINT `product_producer_id_foreign` FOREIGN KEY (`producer_id`) REFERENCES `producer` (`id`),
  ADD CONSTRAINT `product_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `product_status` (`id`);

--
-- Constraints for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_attribute_spec_id_foreign` FOREIGN KEY (`attribute_spec_id`) REFERENCES `attribute_spec` (`id`),
  ADD CONSTRAINT `product_attribute_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_model`
--
ALTER TABLE `product_model`
  ADD CONSTRAINT `product_model_producer_id_foreign` FOREIGN KEY (`producer_id`) REFERENCES `producer` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `user_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
