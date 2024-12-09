-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2024 pada 17.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('customer@gmail.com|127.0.0.1', 'i:4;', 1733231741),
('customer@gmail.com|127.0.0.1:timer', 'i:1733231741;', 1733231741),
('supervisor@gmail.co|127.0.0.1', 'i:2;', 1733327029),
('supervisor@gmail.co|127.0.0.1:timer', 'i:1733327029;', 1733327029),
('user@gmail.com|127.0.0.1', 'i:1;', 1733292348),
('user@gmail.com|127.0.0.1:timer', 'i:1733292348;', 1733292348);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE `company` (
  `company_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`company_id`, `name`, `address`, `city`, `created_at`, `updated_at`) VALUES
(1, 'PT.GEODIS WILSON INDOENSIA', 'JL. INDONESIA MERDEKA', 'JAKARTA', '2024-12-03 11:52:16', '2024-12-03 11:52:16'),
(2, 'PT. MAERSK LOGISTIC INDONESIA', 'JL. PAHLAWAN', 'SURABAYA', '2024-12-03 11:52:30', '2024-12-03 11:52:30'),
(4, 'PT. RHENUS LOGISTICS INDONESIA', '-', '-', '2024-12-06 12:30:09', '2024-12-06 12:30:09'),
(5, 'PT. PINDO DELI PULP AND PAPER MILLS', '-', '-', '2024-12-06 12:30:32', '2024-12-06 12:30:32'),
(6, 'PT. MAKAYOA TRANS KHATULISTIWA', '-', '-', '2024-12-06 12:30:54', '2024-12-06 12:30:54'),
(7, 'PT. MILITZER AND MUENCH INDONESIA', '-', '-', '2024-12-06 12:31:25', '2024-12-06 12:31:25'),
(8, 'PT. MORA JOSE LOGISTICS', '-', '-', '2024-12-06 12:53:46', '2024-12-06 12:53:46'),
(9, 'PT.INDAH KIAT PULP & PAPER TBK.', '-', '-', '2024-12-06 12:54:02', '2024-12-06 12:54:02'),
(10, 'PT.SINAR MAS SPECIALTY MINERALS', '-', '-', '2024-12-06 12:54:17', '2024-12-06 12:54:17'),
(11, 'PT.LOGWIN AIR & OCEAN INDONESIA', '-', '-', '2024-12-06 12:54:30', '2024-12-06 12:54:30'),
(12, 'PT.KATI KARTIKA MURNI', '-', '-', '2024-12-06 12:54:41', '2024-12-06 12:54:41'),
(13, 'PT.LONTAR PAPYRUS PULP&PAPER INDUSTRY', '-', '-', '2024-12-06 12:54:55', '2024-12-06 12:54:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `item_id` int(10) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `satuan` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`item_id`, `nama_item`, `qty`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'Dokumen', 1000, 'Lembar', '2024-12-04 15:27:14', '2024-12-04 15:29:07'),
(2, 'TRUCKING', 1000, 'Lembar', '2024-12-06 14:15:54', '2024-12-06 14:15:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `job`
--

CREATE TABLE `job` (
  `job_id` int(10) NOT NULL,
  `name_job` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `kapal`
--

CREATE TABLE `kapal` (
  `kapal_id` int(10) NOT NULL,
  `nama_kapal` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kapal`
--

INSERT INTO `kapal` (`kapal_id`, `nama_kapal`, `created_at`, `updated_at`) VALUES
(1, 'CX780/01', '2024-12-08 15:13:43', '2024-12-08 15:13:43'),
(2, 'NINGBO VOYAGER 2403S', '2024-12-08 15:13:54', '2024-12-08 15:13:54'),
(3, 'KMTC MANILA 2408S', '2024-12-08 15:14:01', '2024-12-08 15:14:01'),
(4, 'SEASPON KYOTO 116S', '2024-12-08 15:14:10', '2024-12-08 15:14:10'),
(5, 'SAWASDEE XIAMEN 2412S', '2024-12-08 15:14:20', '2024-12-08 15:14:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bauhi63Co0PtsZ3mCiTYAsYRJjw6tGYAr45HxVvZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 OPR/114.0.0.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiQ1I4eVF4bVV4d2w1SEExcHFEbUJRYUZNY3gwMVVubWI2VlBwZnhKcyI7czozOiJ1cmwiO2E6MDp7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJyb2xlX25hbWUiO3M6NToiQWRtaW4iO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW52b2ljZSI7fXM6MTA6ImNhcnRfaXRlbXMiO2E6MTp7aTowO2E6NTp7czo3OiJpdGVtX2lkIjtzOjE6IjEiO3M6OToibmFtYV9pdGVtIjtzOjc6IkRva3VtZW4iO3M6MzoicXR5IjtzOjE6IjIiO3M6Njoic2F0dWFuIjtzOjY6IkxlbWJhciI7czo1OiJwcmljZSI7czo0OiI1MDAwIjt9fX0=', 1733762512);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ruben', 'admin@gmail.com', 2, NULL, '$2y$12$FQbD98KjhIcUbbKQRdqaJePzqhX9QwJlewwVos5jnaAEZJ0Ag/NSi', 'LJIeR01ap9OSoTsQesoMNoYkfooFjEs5oxnrgtDfvYVubGPhXgc0cApfWoYO', '2024-12-03 01:31:38', '2024-12-03 11:59:39'),
(2, 'Domi', 'supervisor@gmail.com', 3, NULL, '$2y$12$LmSqYq1hmPC8o8iD3Mr4DuDnKPs2uKweH8R80BDHN4FdmkrXQys7G', NULL, '2024-12-03 11:02:21', '2024-12-03 22:00:26'),
(4, 'Albe', 'albe@gmail.com', 1, NULL, '$2y$12$1fMv3KHdn39pRjtcmHoQRe8QxvQhVHDB5T58ywS5KO2gM9p7Xp0cm', NULL, '2024-12-03 22:19:08', '2024-12-03 22:20:04'),
(5, 'bram', 'bram@gmail.com', 2, NULL, '$2y$12$XVmZdZLYbPzue/3KLXNFFu5IiSODhHB218wuLHa3bWhkUOg/hnBDS', NULL, '2024-12-03 22:22:19', '2024-12-04 08:45:21'),
(10, 'cargo', 'cargo@gmail.com', 3, NULL, '$2y$12$WxcoaSkHWNj9kKtOxyNY2.HGFVWX7Ig3T3WhYzIs2pcj/O0CusX/i', NULL, '2024-12-03 22:36:37', '2024-12-03 22:37:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indeks untuk tabel `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kapal`
--
ALTER TABLE `kapal`
  ADD PRIMARY KEY (`kapal_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kapal`
--
ALTER TABLE `kapal`
  MODIFY `kapal_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
