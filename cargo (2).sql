-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 03:50 PM
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
-- Database: `cargo`
--

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
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` bigint(10) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `code_name` varchar(150) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `code_name`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'PT.GEODIS WILSON INDOENSIA', 'GEO', 'JAKARTA', '2024-12-03 11:52:16', '2024-12-24 06:47:08'),
(2, 'PT. MAERSK LOGISTIC INDONESIA', 'MLI', 'SURABAYA', '2024-12-03 11:52:30', '2024-12-24 06:47:21'),
(4, 'PT. RHENUS LOGISTICS INDONESIA', 'RLI', '-', '2024-12-06 12:30:09', '2024-12-24 06:47:28'),
(5, 'PT. PINDO DELI PULP AND PAPER MILLS', '-', '-', '2024-12-06 12:30:32', '2024-12-06 12:30:32'),
(6, 'PT. MAKAYOA TRANS KHATULISTIWA', '-', '-', '2024-12-06 12:30:54', '2024-12-06 12:30:54'),
(7, 'PT. MILITZER AND MUENCH INDONESIA', '-', '-', '2024-12-06 12:31:25', '2024-12-06 12:31:25'),
(8, 'PT. MORA JOSE LOGISTICS', '-', '-', '2024-12-06 12:53:46', '2024-12-06 12:53:46'),
(9, 'PT.INDAH KIAT PULP & PAPER TBK.', '-', '-', '2024-12-06 12:54:02', '2024-12-06 12:54:02'),
(10, 'PT.SINAR MAS SPECIALTY MINERALS', '-', '-', '2024-12-06 12:54:17', '2024-12-06 12:54:17'),
(11, 'PT.LOGWIN AIR & OCEAN INDONESIA', '-', '-', '2024-12-06 12:54:30', '2024-12-06 12:54:30'),
(12, 'PT.KATI KARTIKA MURNI', '-', '-', '2024-12-06 12:54:41', '2024-12-06 12:54:41'),
(14, 'NEW COMPANY', 'NCM', '082784292', '2025-01-06 13:14:19', '2025-01-06 13:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `consigne`
--

CREATE TABLE `consigne` (
  `consigne_id` int(10) NOT NULL,
  `nama_consigne` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consigne`
--

INSERT INTO `consigne` (`consigne_id`, `nama_consigne`, `created_at`, `updated_at`) VALUES
(1, 'CX780/01', '2024-12-08 15:13:43', '2024-12-08 15:13:43'),
(2, 'NINGBO VOYAGER 2403S', '2024-12-08 15:13:54', '2024-12-08 15:13:54'),
(3, 'KMTC MANILA 2408S', '2024-12-08 15:14:01', '2024-12-08 15:14:01'),
(4, 'SEASPON KYOTO 116S', '2024-12-08 15:14:10', '2024-12-08 15:14:10'),
(5, 'SAWASDEE XIAMEN 2412S', '2024-12-08 15:14:20', '2024-12-08 15:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `cost_id` int(50) NOT NULL,
  `transaction_id` varchar(15) NOT NULL,
  `nama_Item` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  `total_cost` float NOT NULL,
  `gross_profit` float NOT NULL,
  `pph` float NOT NULL,
  `profit` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `transaction_id`, `nama_Item`, `amount`, `price`, `total_cost`, `gross_profit`, `pph`, `profit`, `created_at`, `updated_at`) VALUES
(18, 'B000163', 'Dokumen', 1, 15000, 15000, 8500, 8500, 8500, '2024-12-24 09:16:31', '2024-12-24 09:16:31'),
(19, 'B000165', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2024-12-24 14:38:18', '2024-12-24 14:38:18'),
(20, 'B000166', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2024-12-24 14:44:23', '2024-12-24 14:44:23'),
(21, 'B000167', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2024-12-24 14:50:56', '2024-12-24 14:50:56'),
(22, 'B000168', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2024-12-24 15:09:53', '2024-12-24 15:09:53'),
(23, 'B000169', 'TRUCKING', 1, 500000, 500000, 8500, 8500, 8500, '2024-12-24 15:11:30', '2024-12-24 15:11:30'),
(24, 'B000170', 'Dokumen', 1, 15000, 15000, 8500, 8500, 8500, '2024-12-31 03:06:10', '2024-12-31 03:06:10'),
(25, 'B000171', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2024-12-31 05:18:28', '2024-12-31 05:18:28'),
(26, 'B000172', 'Dokumen', 1, 15000, 15000, 8500, 8500, 8500, '2024-12-31 05:21:58', '2024-12-31 05:21:58'),
(27, 'B2400001', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2024-12-31 05:45:30', '2024-12-31 05:45:30'),
(28, 'A2500001', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2025-01-05 10:07:51', '2025-01-05 10:07:51'),
(29, 'A2500002', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2025-01-05 10:16:12', '2025-01-05 10:16:12'),
(30, 'B2500001', 'TRUCKING', 1, 10000, 10000, 8500, 8500, 8500, '2025-01-05 11:13:08', '2025-01-05 11:13:08'),
(31, 'B2500003', 'Dokumen', 1, 10000, 10000, 8500, 8500, 8500, '2025-01-05 13:51:09', '2025-01-05 13:51:09');

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
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(10) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `qty` int(50) NOT NULL,
  `satuan` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `nama_item`, `qty`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'Dokumen', 1000, 'Lembar', '2024-12-21 12:52:43', '2024-12-21 12:52:43'),
(2, 'TRUCKING', 100, '-', '2024-12-21 12:52:52', '2024-12-21 12:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` bigint(10) NOT NULL,
  `job_name` varchar(100) NOT NULL,
  `job_code` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_name`, `job_code`, `created_at`, `updated_at`) VALUES
(1, 'Ob', 'OB', '2024-12-13 09:35:58', '2024-12-13 09:35:58'),
(2, 'at', 'at', '2024-12-13 09:36:17', '2024-12-13 09:36:17'),
(3, 'hj', 'hj', '2024-12-13 09:36:26', '2024-12-13 09:36:26'),
(4, 'Custom Clearance', 'CS', '2024-12-24 07:32:22', '2024-12-24 07:32:22');

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
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(25) NOT NULL,
  `transaction_id` varchar(15) NOT NULL,
  `job_type` varchar(150) NOT NULL,
  `job_no` varchar(150) NOT NULL,
  `job_ref` varchar(150) NOT NULL,
  `flight_date` varchar(150) NOT NULL,
  `destination` varchar(150) NOT NULL,
  `mawb` varchar(150) NOT NULL,
  `hawb` varchar(150) NOT NULL,
  `consigne` varchar(150) NOT NULL,
  `shipper` varchar(150) NOT NULL,
  `detail` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `transaction_id`, `job_type`, `job_no`, `job_ref`, `flight_date`, `destination`, `mawb`, `hawb`, `consigne`, `shipper`, `detail`, `created_at`, `updated_at`) VALUES
(25, 'B000163', 'CS', '0001/MLI-CS/2412', 'contoh', 'contoh', 'contoh', 'contoh', 'contoh', 'CX780/01', 'contoh', '-', '2024-12-24 09:16:31', '2024-12-24 09:16:31'),
(26, 'B000165', 'CS', '0001/GEO-CS/2412', 'sample', 'sample', 'sample', 'sample', 'sample', 'CX780/01', 'sample', '-', '2024-12-24 14:38:18', '2024-12-24 14:38:18'),
(27, 'B000166', 'OB', '0002/GEO-OB/2412', 'sample', 'sample', 'sample', 'sample', 'sample', 'CX780/01', 'sample', '-', '2024-12-24 14:44:23', '2024-12-24 14:44:23'),
(28, 'B000167', 'CS', '0001/GEO-CS/2412', '4363BTH', '46576TK8Y', 'CGK/JPN', '452357', '26786', 'SEASPON KYOTO 116S', 'GRAND TURISMO', '-', '2024-12-24 14:50:56', '2024-12-24 14:50:56'),
(29, 'B000168', 'CS', '0002/GEO-CS/2412', 'sample', 'sample', 'sample', 'sample', 'sample', 'CX780/01', 'sample', '-', '2024-12-24 15:09:53', '2024-12-24 15:09:53'),
(30, 'B000169', 'at', '0001/RLI-at/2412', 'exam', 'exam', 'exam', 'exam', 'exam', 'CX780/01', 'exam', '-', '2024-12-24 15:11:30', '2024-12-24 15:11:30'),
(31, 'B000170', 'CS', '0003/GEO-CS/2412', '123IHOID', '46576TK8Y', 'JPN/IDN', '452357', '26786', 'CX780/01', 'GRAND TURISMO', '-', '2024-12-31 03:06:10', '2024-12-31 03:06:10'),
(32, 'B000171', 'OB', '0003/GEO-OB/2412', 'sample', 'sample', 'sample', 'sample', 'sample', 'CX780/01', 'sample', '-', '2024-12-31 05:18:28', '2024-12-31 05:18:28'),
(33, 'B000172', 'CS', '0004/MLI-CS/2412', 'albe', 'albe', 'albe', 'albe', 'albe', 'SEASPON KYOTO 116S', 'albe', '-', '2024-12-31 05:21:58', '2024-12-31 05:21:58'),
(34, 'B2400001', 'CS', '0005/MLI-CS/2412', 'coba', 'coba', 'coba', 'coba', 'coba', 'CX780/01', 'coba', '-', '2024-12-31 05:45:30', '2024-12-31 05:45:30'),
(35, 'A2500001', 'OB', 'AT/2501/0001', '123IHOID', '299BFHDUS', 'CGK/JPN', '452357', '26786', 'CX780/01', 'GRAND TURISMO', '-', '2025-01-05 10:07:51', '2025-01-05 10:07:51'),
(36, 'A2500002', 'CS', 'AT/2501/0002', '123IHOID', '4646TK8Y', 'CGK/JPN', '15656', '87455', 'CX780/01', 'TITANIC', '-', '2025-01-05 10:16:12', '2025-01-05 10:16:12'),
(37, 'B2500001', 'OB', 'AT/2501/0003', 'testing', 'testing', 'testing', 'testing', 'testing', 'CX780/01', 'testing', 'testing', '2025-01-05 11:13:08', '2025-01-05 11:13:08'),
(38, 'B2500003', 'OB', 'AT/2501/0004', 'sample', 'sample', 'sample', 'sample', 'sample', 'CX780/01', 'sample', 'sample', '2025-01-05 13:51:09', '2025-01-05 13:51:09');

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
('0MnxaqZ165DjQvXNQNaKBNdUVaiDtHhbebgL9eoj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiSE1BWWFvYTd5cHhqWU9ueGNITGxYYUNEZ3hxQnBWMVp5NUZlV0I4cSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdHJhbnNhY3Rpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToicm9sZV9uYW1lIjtzOjU6IkFkbWluIjtzOjEwOiJjYXJ0X2l0ZW1zIjthOjI6e2k6MDthOjU6e3M6NzoiaXRlbV9pZCI7czoxOiIxIjtzOjk6Im5hbWFfaXRlbSI7czo3OiJEb2t1bWVuIjtzOjM6InF0eSI7aToxO3M6Njoic2F0dWFuIjtzOjY6IkxlbWJhciI7czo1OiJwcmljZSI7czo0OiI1MDAwIjt9aToxO2E6NTp7czo3OiJpdGVtX2lkIjtzOjE6IjIiO3M6OToibmFtYV9pdGVtIjtzOjg6IlRSVUNLSU5HIjtzOjM6InF0eSI7aToxO3M6Njoic2F0dWFuIjtzOjE6Ii0iO3M6NToicHJpY2UiO3M6NDoiNTAwMCI7fX19', 1736693072);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` varchar(15) NOT NULL,
  `name` varchar(225) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `stsfaktur` int(10) NOT NULL,
  `faktur` int(150) NOT NULL,
  `date_payment` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `name`, `company_name`, `status`, `stsfaktur`, `faktur`, `date_payment`, `created_at`, `updated_at`) VALUES
('A2500001', 'Ruben', 'PT.LOGWIN AIR & OCEAN INDONESIA', 1, 0, 0, NULL, '2025-01-05 10:07:51', '2025-01-05 10:07:51'),
('A2500002', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 0, 0, NULL, '2025-01-05 10:16:12', '2025-01-05 10:16:12'),
('B000163', 'Ruben', 'PT. MAERSK LOGISTIC INDONESIA', 2, 0, 0, '2025-01-05', '2024-12-24 09:16:31', '2024-12-24 16:56:49'),
('B000165', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 0, 0, NULL, '2024-12-24 14:38:18', '2024-12-24 14:38:18'),
('B000166', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 0, 0, NULL, '2024-12-24 14:44:23', '2024-12-24 14:44:23'),
('B000167', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 1, 784511515, NULL, '2024-12-24 14:50:56', '2025-01-05 06:57:22'),
('B000168', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 1, 643634, NULL, '2024-12-24 15:09:53', '2024-12-31 04:54:41'),
('B000169', 'Ruben', 'PT. RHENUS LOGISTICS INDONESIA', 2, 1, 0, '2025-01-05', '2024-12-24 15:11:30', '2025-01-05 09:19:03'),
('B000170', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 1, 43634563, NULL, '2024-12-31 03:06:10', '2024-12-31 04:50:17'),
('B000171', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 0, 0, NULL, '2024-12-31 05:18:28', '2024-12-31 05:18:28'),
('B000172', 'Ruben', 'PT. MAERSK LOGISTIC INDONESIA', 2, 1, 0, '2025-01-04', '2024-12-31 05:21:58', '2025-01-04 13:51:04'),
('B2400001', 'Ruben', 'PT. MAERSK LOGISTIC INDONESIA', 2, 1, 0, '2025-01-03', '2024-12-31 05:45:30', '2025-01-04 16:17:14'),
('B2500001', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 1, 0, NULL, '2025-01-05 11:13:08', '2025-01-05 11:13:08'),
('B2500002', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 1, 0, NULL, '2025-01-05 13:50:29', '2025-01-05 13:50:29'),
('B2500003', 'Ruben', 'PT.GEODIS WILSON INDOENSIA', 1, 1, 0, NULL, '2025-01-05 13:51:09', '2025-01-05 13:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(50) NOT NULL,
  `transaction_id` varchar(15) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  `tax` float NOT NULL,
  `tax_price` float NOT NULL,
  `total_price` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `nama_item`, `amount`, `price`, `tax`, `tax_price`, `total_price`, `created_at`, `updated_at`) VALUES
(37, 'B000149', 'Dokumen', 1, 60000, 16500, 0, 60000, '2024-12-22 06:28:56', '2024-12-22 06:28:56'),
(38, 'B000150', 'Dokumen', 1, 150000, 16500, 0, 150000, '2024-12-22 07:34:18', '2024-12-22 07:34:18'),
(39, 'B000150', 'TRUCKING', 1, 50000, 16500, 0, 50000, '2024-12-22 07:34:18', '2024-12-22 07:34:18'),
(40, 'B000151', 'Dokumen', 1, 850000, 16500, 0, 850000, '2024-12-22 07:36:12', '2024-12-22 07:36:12'),
(41, 'B000151', 'TRUCKING', 1, 45000, 16500, 0, 45000, '2024-12-22 07:36:12', '2024-12-22 07:36:12'),
(42, 'B000152', 'Dokumen', 1, 50000, 6600, 0, 50000, '2024-12-23 03:52:59', '2024-12-23 03:52:59'),
(51, 'B000158', 'Dokumen', 1, 59000, 0, 0, 59000, '2024-12-23 04:16:50', '2024-12-23 04:16:50'),
(52, 'B000158', 'TRUCKING', 1, 100000, 0, 0, 100000, '2024-12-23 04:16:50', '2024-12-23 04:16:50'),
(53, 'B000159', 'Dokumen', 1, 50000, 0, 0, 50000, '2024-12-24 06:57:35', '2024-12-24 06:57:35'),
(54, 'B000160', 'Dokumen', 1, 60000, 0, 0, 60000, '2024-12-24 07:37:12', '2024-12-24 07:37:12'),
(55, 'B000161', 'Dokumen', 1, 100000, 0, 0, 100000, '2024-12-24 07:41:03', '2024-12-24 07:41:03'),
(56, 'B000162', 'Dokumen', 1, 50000, 0, 0, 50000, '2024-12-24 08:02:49', '2024-12-24 08:02:49'),
(57, 'B000163', 'Dokumen', 1, 150000, 0, 0, 150000, '2024-12-24 09:16:31', '2024-12-24 09:16:31'),
(58, 'B000164', 'Dokumen', 1, 50000, 0, 0, 50000, '2024-12-24 14:37:56', '2024-12-24 14:37:56'),
(59, 'B000165', 'Dokumen', 1, 50000, 0, 0, 50000, '2024-12-24 14:38:18', '2024-12-24 14:38:18'),
(60, 'B000166', 'Dokumen', 1, 50000, 0, 0, 50000, '2024-12-24 14:44:23', '2024-12-24 14:44:23'),
(61, 'B000167', 'TRUCKING', 1, 80000, 0, 0, 80000, '2024-12-24 14:50:56', '2024-12-24 14:50:56'),
(62, 'B000167', 'Dokumen', 1, 100000, 0, 0, 100000, '2024-12-24 14:50:56', '2024-12-24 14:50:56'),
(63, 'B000168', 'Dokumen', 1, 50000, 0, 0, 50000, '2024-12-24 15:09:53', '2024-12-24 15:09:53'),
(64, 'B000169', 'TRUCKING', 1, 800000, 0, 0, 800000, '2024-12-24 15:11:30', '2024-12-24 15:11:30'),
(65, 'B000170', 'Dokumen', 1, 150000, 0, 0, 150000, '2024-12-31 03:06:10', '2024-12-31 03:06:10'),
(66, 'B000171', 'Dokumen', 1, 50000, 0, 0, 50000, '2024-12-31 05:18:28', '2024-12-31 05:18:28'),
(67, 'B000172', 'Dokumen', 1, 65000, 0, 0, 65000, '2024-12-31 05:21:58', '2024-12-31 05:21:58'),
(68, 'B2400001', 'Dokumen', 1, 60000, 0, 0, 60000, '2024-12-31 05:45:30', '2024-12-31 05:45:30'),
(69, 'A2500001', 'Dokumen', 1, 50000, 0, 0, 50000, '2025-01-05 10:07:51', '2025-01-05 10:07:51'),
(70, 'A2500002', 'Dokumen', 1, 70000, 0, 0, 70000, '2025-01-05 10:16:12', '2025-01-05 10:16:12'),
(71, 'B2500001', 'TRUCKING', 1, 200000, 11, 0, 200000, '2025-01-05 11:13:08', '2025-01-05 11:13:08'),
(72, 'B2500003', 'Dokumen', 1, 200000, 1.1, 2200, 200000, '2025-01-05 13:51:09', '2025-01-05 13:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ruben', 'admin@gmail.com', 2, NULL, '$2y$12$FQbD98KjhIcUbbKQRdqaJePzqhX9QwJlewwVos5jnaAEZJ0Ag/NSi', '1XvLhBSgD2uEe6Ygfg8UFXtx48zPbkwsTn8Cxa9T6fVSjfcnLbOCtV76MoQd', '2024-12-03 01:31:38', '2024-12-03 11:59:39'),
(4, 'Albe', 'albe@gmail.com', 2, NULL, '$2y$12$1fMv3KHdn39pRjtcmHoQRe8QxvQhVHDB5T58ywS5KO2gM9p7Xp0cm', NULL, '2024-12-03 22:19:08', '2024-12-20 10:18:33'),
(5, 'bram', 'bram@gmail.com', 2, NULL, '$2y$12$XVmZdZLYbPzue/3KLXNFFu5IiSODhHB218wuLHa3bWhkUOg/hnBDS', NULL, '2024-12-03 22:22:19', '2024-12-04 08:45:21'),
(10, 'cargo', 'cargo@gmail.com', 3, NULL, '$2y$12$WxcoaSkHWNj9kKtOxyNY2.HGFVWX7Ig3T3WhYzIs2pcj/O0CusX/i', NULL, '2024-12-03 22:36:37', '2024-12-03 22:37:46');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `consigne`
--
ALTER TABLE `consigne`
  ADD PRIMARY KEY (`consigne_id`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`cost_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
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
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `consigne`
--
ALTER TABLE `consigne`
  MODIFY `consigne_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `cost_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
