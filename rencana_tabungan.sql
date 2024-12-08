-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2024 pada 01.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rencana_tabungan`
--

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
-- Struktur dari tabel `menabung`
--

CREATE TABLE `menabung` (
  `id_menabung` bigint(20) UNSIGNED NOT NULL,
  `id_tabungan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_menabung` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menabung`
--

INSERT INTO `menabung` (`id_menabung`, `id_tabungan`, `id_user`, `nominal`, `tanggal_menabung`, `created_at`, `updated_at`) VALUES
(10, 6, 1, 5000000, '2024-12-07', '2024-12-07 05:39:51', '2024-12-07 05:39:51'),
(11, 8, 1, 9000000, '2024-12-07', '2024-12-07 05:43:20', '2024-12-07 05:43:20'),
(12, 7, 1, 10000, '2024-12-07', '2024-12-07 05:43:46', '2024-12-07 05:43:46'),
(13, 9, 1, 1000000, '2024-12-07', '2024-12-07 05:44:01', '2024-12-07 05:44:01'),
(14, 12, 2, 2500000, '2024-12-07', '2024-12-07 05:48:43', '2024-12-07 05:48:43'),
(15, 11, 2, 5000000, '2024-12-07', '2024-12-07 05:49:16', '2024-12-07 05:49:16'),
(16, 7, 1, 4990000, '2024-12-07', '2024-12-07 05:51:45', '2024-12-07 05:51:45');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_05_122306_create_table_user', 1),
(6, '2024_12_05_122450_create_tabungan_table', 1),
(7, '2024_12_05_122614_create_menabung_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabungan`
--

CREATE TABLE `tabungan` (
  `id_tabungan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `judul_tabungan` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `target_nominal` int(11) NOT NULL,
  `target_tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('Tercapai','Belum Tercapai') NOT NULL DEFAULT 'Belum Tercapai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tabungan`
--

INSERT INTO `tabungan` (`id_tabungan`, `id_user`, `judul_tabungan`, `foto`, `target_nominal`, `target_tanggal`, `nominal`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'Japan', 'tabungan/1733575162_WhatsApp Image 2024-12-07 at 19.37.10.jpeg', 25000000, '2024-12-31', 5000000, 'Belum Tercapai', '2024-12-07 05:39:22', '2024-12-07 07:28:10'),
(7, 1, 'Skincare', 'tabungan/1733575225_WhatsApp Image 2024-12-07 at 19.37.11 (1).jpeg', 5000000, '2024-12-30', 5000000, 'Tercapai', '2024-12-07 05:40:25', '2024-12-07 05:51:45'),
(8, 1, 'Meet with him', 'tabungan/1733575265_WhatsApp Image 2024-12-07 at 19.37.12.jpeg', 15000000, '2024-12-21', 9000000, 'Belum Tercapai', '2024-12-07 05:41:05', '2024-12-07 05:43:20'),
(9, 1, 'New Handphone', 'tabungan/1733575299_WhatsApp Image 2024-12-07 at 19.37.11 (2).jpeg', 15000000, '2025-01-01', 1000000, 'Belum Tercapai', '2024-12-07 05:41:39', '2024-12-07 05:44:01'),
(10, 2, 'motorcycle', 'tabungan/1733575574_WhatsApp Image 2024-12-07 at 19.37.13.jpeg', 60000000, '2025-01-11', 0, 'Belum Tercapai', '2024-12-07 05:46:14', '2024-12-07 05:46:14'),
(11, 2, 'Paris', 'tabungan/1733575616_WhatsApp Image 2024-12-07 at 19.37.13 (1).jpeg', 30000000, '2025-01-09', 5000000, 'Belum Tercapai', '2024-12-07 05:46:56', '2024-12-07 05:49:16'),
(12, 2, 'Date?', 'tabungan/1733575645_WhatsApp Image 2024-12-07 at 19.37.14.jpeg', 5000000, '2024-12-28', 2500000, 'Belum Tercapai', '2024-12-07 05:47:25', '2024-12-07 05:48:43'),
(13, 2, 'Guitar', 'tabungan/1733575674_WhatsApp Image 2024-12-07 at 19.37.12 (1).jpeg', 25000000, '2024-12-22', 0, 'Belum Tercapai', '2024-12-07 05:47:54', '2024-12-07 05:47:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Fenty', 'fenty@gmail.com', '$2y$10$llc0khhJLO.m8SHG2OXhae2zhh7jC.CZLzCqm2S/P7eyfznbV7d3y', '2024-12-05 06:29:39', '2024-12-05 06:29:39'),
(2, 'abcdef', 'abcdef@gmail.com', '$2y$10$GAJ0.HxCXWz.68q7wiPW2eUaRYvmKIhVWJqsv1UTUVXHVleHMh1HG', '2024-12-05 06:55:32', '2024-12-05 06:55:32'),
(3, 'afnirahma', 'afni@gmail.com', '$2y$10$Bx1G81amvliqqM0k2oEuw.c4Kw4RDzAc3S6vbgw5jzknSfGXi6MLK', '2024-12-07 07:19:36', '2024-12-07 07:19:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `menabung`
--
ALTER TABLE `menabung`
  ADD PRIMARY KEY (`id_menabung`),
  ADD KEY `menabung_id_tabungan_foreign` (`id_tabungan`),
  ADD KEY `menabung_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_tabungan`),
  ADD KEY `tabungan_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

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
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menabung`
--
ALTER TABLE `menabung`
  MODIFY `id_menabung` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_tabungan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menabung`
--
ALTER TABLE `menabung`
  ADD CONSTRAINT `menabung_id_tabungan_foreign` FOREIGN KEY (`id_tabungan`) REFERENCES `tabungan` (`id_tabungan`) ON DELETE CASCADE,
  ADD CONSTRAINT `menabung_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `tabungan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
