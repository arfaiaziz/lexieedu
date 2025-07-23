/*
 Navicat Premium Dump SQL

 Source Server         : localhost_3307
 Source Server Type    : MySQL
 Source Server Version : 110502 (11.5.2-MariaDB)
 Source Host           : 127.0.0.1:3307
 Source Schema         : pa_arfai

 Target Server Type    : MySQL
 Target Server Version : 110502 (11.5.2-MariaDB)
 File Encoding         : 65001

 Date: 21/07/2025 00:33:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for instansi
-- ----------------------------
DROP TABLE IF EXISTS `instansi`;
CREATE TABLE `instansi` (
  `id_instansi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `jumlah_sesi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of instansi
-- ----------------------------
BEGIN;
INSERT INTO `instansi` (`id_instansi`, `nama_instansi`, `tgl_mulai`, `tgl_berakhir`, `jumlah_sesi`, `created_at`, `updated_at`) VALUES (2, 'PT Jaya Makmur Nusantara Abadi Senusa', '2025-06-05', '2025-06-30', 1, NULL, '2025-06-05 05:11:55');
INSERT INTO `instansi` (`id_instansi`, `nama_instansi`, `tgl_mulai`, `tgl_berakhir`, `jumlah_sesi`, `created_at`, `updated_at`) VALUES (3, 'Pertamina', '2025-06-05', '2025-06-07', 34, '2025-06-05 05:02:19', '2025-06-05 05:02:19');
INSERT INTO `instansi` (`id_instansi`, `nama_instansi`, `tgl_mulai`, `tgl_berakhir`, `jumlah_sesi`, `created_at`, `updated_at`) VALUES (5, 'SMP 1 PANDAU', '2025-06-05', '2025-06-30', 2, '2025-06-05 09:03:29', '2025-06-05 09:03:29');
COMMIT;

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_batches
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2025_06_04_072418_create_instansi_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2025_06_04_074105_create_level_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2025_06_04_074524_create_soal_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2025_06_04_075002_create_transaksi_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2025_06_04_075220_create_peserta_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2025_06_09_084431_create_tes_table', 2);
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for peserta
-- ----------------------------
DROP TABLE IF EXISTS `peserta`;
CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peserta` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `id_instansi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_peserta`),
  KEY `peserta_id_level_foreign` (`level`),
  KEY `peserta_id_instansi_foreign` (`id_instansi`),
  CONSTRAINT `peserta_id_instansi_foreign` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of peserta
-- ----------------------------
BEGIN;
INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `umur`, `alamat`, `email`, `tgl_daftar`, `level`, `id_instansi`, `created_at`, `updated_at`) VALUES (27, 'Sinta', 34, 'sdff', 'endru1@gmail.com', '2025-06-23', 'A1', 3, '2025-06-23 15:59:34', '2025-07-01 06:25:00');
INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `umur`, `alamat`, `email`, `tgl_daftar`, `level`, `id_instansi`, `created_at`, `updated_at`) VALUES (28, 'sdss', 232, 'sdad', 'herupranata8@gmail.com', '2025-07-01', 'A1', 2, '2025-07-01 06:13:46', '2025-07-01 06:13:47');
INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `umur`, `alamat`, `email`, `tgl_daftar`, `level`, `id_instansi`, `created_at`, `updated_at`) VALUES (29, 'Desi', 20, 'pku city', 'desi@gmail.com', '2025-07-20', 'A1', 3, '2025-07-20 16:38:41', '2025-07-20 16:38:41');
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('HeBpw34ONBs3kq9a60qbXVxRxIQ66JcjBjyNRm0m', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3hMd0ZubUxaZk9QMWlLRkpLb0xabVF4MGdZcmUzNEpYZEhxUDNZRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdWRpby1zb2FsLzhhOWJhOTI3LTkyMjMtNDVmNi05Zjc5LWExZmVlZTM5ZWYwNy5tcDMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753032755);
COMMIT;

-- ----------------------------
-- Table structure for soal
-- ----------------------------
DROP TABLE IF EXISTS `soal`;
CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` text NOT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `a` varchar(255) NOT NULL,
  `b` varchar(255) NOT NULL,
  `c` varchar(255) NOT NULL,
  `d` varchar(255) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of soal
-- ----------------------------
BEGIN;
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (4, 'Apa negara yang terletak dibenua eropa', '7d3eb240-4f40-41e9-a0f8-80394e1f4a57.mp3', 'Amerika', 'Inggris', 'Canada', 'kolombia', 'A', '2025-06-09 07:28:43', '2025-07-20 17:19:08');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (5, 'Bagaimana cara mengatasi agar tidak mengantuk', NULL, 'Makan', 'Minum', 'Tidur', 'Berdiri', 'C', '2025-06-09 07:29:09', '2025-06-09 07:29:09');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (6, 'Apa yang terjadi jika kamu lapar?', NULL, 'Marah', 'Lapar', 'Ketiduran', 'Lainya', 'A', '2025-06-09 07:29:55', '2025-06-09 07:29:55');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (7, 'benda apa yang bisa melayang?', NULL, 'Pesawat', 'Bom', 'Mobil', 'Motor', 'A', '2025-06-23 15:53:33', '2025-06-23 15:53:33');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (8, 'Dimana Benua Amerik', NULL, 'Duni', 'Planet', 'Mars', 'Bulan', 'A', '2025-06-23 15:53:54', '2025-06-23 15:53:54');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (9, 'Siapa yang menemukan buah mangga', NULL, 'dedi', 'dani', 'deri', 'mari', 'A', '2025-06-23 15:54:16', '2025-06-23 15:54:16');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (10, 'Berapa jumlah bulan?', NULL, '1', '2', '3', '4', 'A', '2025-06-23 15:54:34', '2025-06-23 15:54:34');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (11, 'Berapa 1+1', NULL, '2', '3', '4', '5', 'A', '2025-06-23 15:54:47', '2025-06-23 15:54:47');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (13, 'suara apakah ini?', 'audio_soal/7db1ed52-c4cd-41cf-b683-a98de51baff8.mp3', 'burung', 'buaya', 'babi', 'rusa', 'A', '2025-07-20 16:51:51', '2025-07-20 16:51:51');
INSERT INTO `soal` (`id_soal`, `pertanyaan`, `audio`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES (14, 'kucing', 'audio_soal/8a9ba927-9223-45f6-9f79-a1feee39ef07.mp3', 'sas', 'asa', 'as', 'assa', 'A', '2025-07-20 17:14:04', '2025-07-20 17:14:04');
COMMIT;

-- ----------------------------
-- Table structure for tes
-- ----------------------------
DROP TABLE IF EXISTS `tes`;
CREATE TABLE `tes` (
  `id_tes` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_tes` date NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `nama_soal` varchar(255) NOT NULL,
  `jawaban_soal` varchar(255) NOT NULL,
  `jawaban_peserta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tes`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tes
-- ----------------------------
BEGIN;
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (3, '2025-06-09', 9, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'B', '2025-06-09 09:28:25', '2025-06-09 09:28:25');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (4, '2025-06-09', 9, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'D', '2025-06-09 09:28:25', '2025-06-09 09:28:25');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (5, '2025-06-09', 11, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'B', '2025-06-09 13:17:27', '2025-06-09 13:17:27');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (27, '2025-06-10', 20, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-10 01:59:12', '2025-06-10 01:59:12');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (28, '2025-06-10', 20, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'B', '2025-06-10 01:59:12', '2025-06-10 01:59:12');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (29, '2025-06-10', 20, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'B', '2025-06-10 01:59:12', '2025-06-10 01:59:12');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (30, '2025-06-10', 21, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-10 03:31:08', '2025-06-10 03:31:08');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (31, '2025-06-10', 21, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'D', '2025-06-10 03:31:08', '2025-06-10 03:31:08');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (32, '2025-06-10', 21, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'A', '2025-06-10 03:31:08', '2025-06-10 03:31:08');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (33, '2025-06-23', 22, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-23 15:39:45', '2025-06-23 15:39:45');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (34, '2025-06-23', 22, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'B', '2025-06-23 15:39:45', '2025-06-23 15:39:45');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (35, '2025-06-23', 22, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'D', '2025-06-23 15:39:45', '2025-06-23 15:39:45');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (36, '2025-06-23', 23, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-23 15:44:54', '2025-06-23 15:44:54');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (37, '2025-06-23', 23, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'A', '2025-06-23 15:44:54', '2025-06-23 15:44:54');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (38, '2025-06-23', 23, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'A', '2025-06-23 15:44:54', '2025-06-23 15:44:54');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (39, '2025-06-23', 24, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (40, '2025-06-23', 24, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (41, '2025-06-23', 24, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (42, '2025-06-23', 24, 7, 'benda apa yang bisa melayang?', 'A', 'D', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (43, '2025-06-23', 24, 8, 'Dimana Benua Amerik', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (44, '2025-06-23', 24, 9, 'Siapa yang menemukan buah mangga', 'A', 'D', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (45, '2025-06-23', 24, 10, 'Berapa jumlah bulan?', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (46, '2025-06-23', 24, 11, 'Berapa 1+1', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (47, '2025-06-23', 25, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (48, '2025-06-23', 25, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (49, '2025-06-23', 25, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (50, '2025-06-23', 25, 7, 'benda apa yang bisa melayang?', 'A', 'D', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (51, '2025-06-23', 25, 8, 'Dimana Benua Amerik', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (52, '2025-06-23', 25, 9, 'Siapa yang menemukan buah mangga', 'A', 'D', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (53, '2025-06-23', 25, 10, 'Berapa jumlah bulan?', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (54, '2025-06-23', 25, 11, 'Berapa 1+1', 'A', 'B', '2025-06-23 15:57:30', '2025-06-23 15:57:30');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (55, '2025-06-23', 26, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-23 15:58:22', '2025-06-23 15:58:22');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (56, '2025-06-23', 26, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'B', '2025-06-23 15:58:22', '2025-06-23 15:58:22');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (57, '2025-06-23', 27, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-06-23 15:59:34', '2025-06-23 15:59:34');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (58, '2025-06-23', 27, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'A', '2025-06-23 15:59:35', '2025-06-23 15:59:35');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (59, '2025-06-23', 27, 7, 'benda apa yang bisa melayang?', 'A', 'B', '2025-06-23 15:59:35', '2025-06-23 15:59:35');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (60, '2025-06-23', 27, 8, 'Dimana Benua Amerik', 'A', 'D', '2025-06-23 15:59:35', '2025-06-23 15:59:35');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (61, '2025-06-23', 27, 9, 'Siapa yang menemukan buah mangga', 'A', 'B', '2025-06-23 15:59:35', '2025-06-23 15:59:35');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (62, '2025-06-23', 27, 10, 'Berapa jumlah bulan?', 'A', 'A', '2025-06-23 15:59:35', '2025-06-23 15:59:35');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (63, '2025-07-01', 28, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (64, '2025-07-01', 28, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'B', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (65, '2025-07-01', 28, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'D', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (66, '2025-07-01', 28, 7, 'benda apa yang bisa melayang?', 'A', 'B', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (67, '2025-07-01', 28, 8, 'Dimana Benua Amerik', 'A', 'D', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (68, '2025-07-01', 28, 9, 'Siapa yang menemukan buah mangga', 'A', 'B', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (69, '2025-07-01', 28, 10, 'Berapa jumlah bulan?', 'A', 'D', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (70, '2025-07-01', 28, 11, 'Berapa 1+1', 'A', 'D', '2025-07-01 06:13:46', '2025-07-01 06:13:46');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (71, '2025-07-20', 29, 4, 'Apa negara yang terletak dibenua eropa', 'A', 'A', '2025-07-20 16:38:41', '2025-07-20 16:38:41');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (72, '2025-07-20', 29, 5, 'Bagaimana cara mengatasi agar tidak mengantuk', 'C', 'B', '2025-07-20 16:38:41', '2025-07-20 16:38:41');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (73, '2025-07-20', 29, 6, 'Apa yang terjadi jika kamu lapar?', 'A', 'C', '2025-07-20 16:38:41', '2025-07-20 16:38:41');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (74, '2025-07-20', 29, 7, 'benda apa yang bisa melayang?', 'A', 'B', '2025-07-20 16:38:41', '2025-07-20 16:38:41');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (75, '2025-07-20', 29, 8, 'Dimana Benua Amerik', 'A', 'D', '2025-07-20 16:38:41', '2025-07-20 16:38:41');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (76, '2025-07-20', 29, 9, 'Siapa yang menemukan buah mangga', 'A', 'B', '2025-07-20 16:38:41', '2025-07-20 16:38:41');
INSERT INTO `tes` (`id_tes`, `tgl_tes`, `id_peserta`, `id_soal`, `nama_soal`, `jawaban_soal`, `jawaban_peserta`, `created_at`, `updated_at`) VALUES (77, '2025-07-20', 29, 10, 'Berapa jumlah bulan?', 'A', 'D', '2025-07-20 16:38:41', '2025-07-20 16:38:41');
COMMIT;

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_transaksi` date NOT NULL,
  `via_pembayaran` varchar(255) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
BEGIN;
INSERT INTO `transaksi` (`id_transaksi`, `nama`, `tgl_transaksi`, `via_pembayaran`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES (1, 'Rafi Anugrah', '2025-06-05', 'transfer bank mandiri', 3400000.00, 'bayar uang test', '2025-06-05 09:30:08', '2025-06-05 09:30:08');
INSERT INTO `transaksi` (`id_transaksi`, `nama`, `tgl_transaksi`, `via_pembayaran`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES (3, 'Aulia Diva', '2025-06-02', 'debit', 2300000.00, 'bayar test coba', '2025-06-05 09:33:23', '2025-06-05 09:33:32');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `email`, `no_hp`, `alamat`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'arfai', 'arfai@gmail.com', '0873373839', 'Jl. Pelajar', NULL, '$2y$12$0kbwpfRP00z3rYcMe2R8xOwO592RxJqnqyQLzq3sNtyZoEaySSdsa', 'admin', NULL, '2025-06-06 04:43:09', '2025-06-06 05:00:46');
INSERT INTO `users` (`id`, `name`, `email`, `no_hp`, `alamat`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'dodit santoso', 'dodit@gmail.com', '08393783', 'jl. perbaungan', NULL, '$2y$12$2HpGUcTUYINyzvF43tuxpOsAwgXPfyO3g06XSasHHp4AV7FAmJwmq', NULL, NULL, '2025-06-06 04:48:11', '2025-06-06 04:48:26');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
