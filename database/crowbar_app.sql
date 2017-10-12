-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2017 at 09:24 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `crowbar_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `t0011_admin`
--

CREATE TABLE `t0011_admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t0011_admin`
--

INSERT INTO `t0011_admin` (`id`, `name`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gan Chu Hang', NULL, 'hgun77', '$2y$10$dE2/VC1EQhIsz3DrdslJ2eauZCrUfsCk0eFIdf3gPGbjO9nxKsg2.', 'e3xrGxPI2gfoHJxnq5VIyX7MGP1J1w52XVnh36O9Zg82q2v6yHxFfOMSFHTe', '2017-05-23 19:16:08', '2017-05-23 19:16:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t0012_admin_external_id`
--

CREATE TABLE `t0012_admin_external_id` (
  `id` int(11) UNSIGNED NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t0012_admin_external_id`
--

INSERT INTO `t0012_admin_external_id` (`id`, `admin_id`, `facebook`, `google`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, '2017-05-23 19:16:08', '2017-05-23 19:16:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t0101_user`
--

CREATE TABLE `t0101_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` enum('generic','customer') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'generic',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t0102_user_external_id`
--

CREATE TABLE `t0102_user_external_id` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t0104_user_setting`
--

CREATE TABLE `t0104_user_setting` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `language` enum('english','chinese','malay') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `currency` enum('$','MYR') COLLATE utf8_unicode_ci NOT NULL DEFAULT '$',
  `p_sports_expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t0201_category_main`
--

CREATE TABLE `t0201_category_main` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t0201_category_main`
--

INSERT INTO `t0201_category_main` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Advertising', '2017-05-19 17:34:27', '2017-05-23 03:08:56', NULL),
(2, 'Branding', '2017-05-19 17:34:27', '2017-05-22 12:30:23', NULL),
(3, 'Design', '2017-05-19 17:34:41', '2017-05-22 12:30:29', NULL),
(4, 'Digital', '2017-05-19 17:34:41', '2017-05-22 12:30:37', NULL),
(5, 'Film', '2017-05-19 17:34:55', '2017-05-22 12:30:44', NULL),
(6, 'Innovation & Technology', '2017-05-19 17:34:55', '2017-05-22 12:30:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t0202_category_sub`
--

CREATE TABLE `t0202_category_sub` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_main_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t0202_category_sub`
--

INSERT INTO `t0202_category_sub` (`id`, `category_main_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Activation', '2017-04-30 16:00:00', NULL, NULL),
(2, 1, 'Advertising for Good', '2017-04-30 16:00:00', NULL, NULL),
(3, 1, 'Direct Marketing', '2017-04-30 16:00:00', NULL, NULL),
(4, 1, 'Film', '2017-04-30 16:00:00', NULL, NULL),
(5, 1, 'Integrated', '2017-04-30 16:00:00', NULL, NULL),
(6, 1, 'Outdoor', '2017-04-30 16:00:00', NULL, NULL),
(7, 1, 'Print', '2017-04-30 16:00:00', NULL, NULL),
(8, 1, 'CRAFT - Art Direction', '2017-04-30 16:00:00', NULL, NULL),
(9, 1, 'CRAFT - Design', '2017-04-30 16:00:00', NULL, NULL),
(10, 1, 'CRAFT - Illustration & Graphic Design', '2017-04-30 16:00:00', NULL, NULL),
(11, 1, 'CRAFT - Photography', '2017-04-30 16:00:00', NULL, NULL),
(12, 2, 'Activation', '2017-04-30 16:00:00', NULL, NULL),
(13, 2, 'Below-The-Line Collaterals', '2017-04-30 16:00:00', NULL, NULL),
(14, 2, 'Business Proposal', '2017-04-30 16:00:00', NULL, NULL),
(15, 2, 'Branding for Good', '2017-04-30 16:00:00', NULL, NULL),
(16, 2, 'Corporate & Brand Identity', '2017-04-30 16:00:00', NULL, NULL),
(17, 2, 'Editorial Publication', '2017-04-30 16:00:00', NULL, NULL),
(18, 2, 'CRAFT - Art Direction', '2017-04-30 16:00:00', NULL, NULL),
(19, 2, 'CRAFT - Design', '2017-04-30 16:00:00', NULL, NULL),
(20, 2, 'CRAFT - Illustration & Graphic Design', '2017-04-30 16:00:00', NULL, NULL),
(21, 2, 'CRAFT - Photography', '2017-04-30 16:00:00', NULL, NULL),
(22, 2, 'CRAFT - Typography', '2017-04-30 16:00:00', NULL, NULL),
(23, 3, 'Branding, CI, Stationery', '2017-04-30 16:00:00', NULL, NULL),
(24, 3, 'Book Design', '2017-04-30 16:00:00', NULL, NULL),
(25, 3, 'Design for Good', '2017-05-22 12:39:43', NULL, NULL),
(26, 3, 'Logo Design', '2017-05-22 12:39:43', NULL, NULL),
(27, 3, 'Mobile Applications', '2017-05-22 12:39:58', NULL, NULL),
(28, 3, 'Spatial & Experiential', '2017-05-22 12:39:58', NULL, NULL),
(29, 3, 'Packaging', '2017-05-22 12:40:25', NULL, NULL),
(30, 3, 'Others', '2017-05-22 12:40:25', NULL, NULL),
(31, 3, 'Website & Microsite', '2017-05-22 12:40:47', NULL, NULL),
(32, 3, 'CRAFT - Art Direction', '2017-05-22 12:40:47', NULL, NULL),
(33, 3, 'CRAFT - Design', '2017-05-22 12:40:47', NULL, NULL),
(34, 3, 'CRAFT - Illustration & Graphic Design', '2017-05-22 12:40:47', NULL, NULL),
(35, 3, 'CRAFT - Photography', '2017-05-22 12:40:47', NULL, NULL),
(36, 4, 'Applications', '2017-05-22 12:40:47', NULL, NULL),
(37, 4, 'Digital for Good', '2017-05-22 12:43:53', NULL, NULL),
(38, 4, 'Digital Billboard', '2017-05-22 12:43:53', NULL, NULL),
(39, 4, 'Digital Installation', '2017-05-22 12:44:07', NULL, NULL),
(40, 4, 'Integrated', '2017-05-22 12:44:07', NULL, NULL),
(41, 4, 'Mobile', '2017-05-22 12:44:24', NULL, NULL),
(42, 4, 'Online Advertising', '2017-05-22 12:44:24', NULL, NULL),
(43, 4, 'Online Film', '2017-05-22 12:44:53', NULL, NULL),
(44, 4, 'CRAFT - Animation & Motion Graphics', '2017-05-22 12:44:53', NULL, NULL),
(45, 4, 'CRAFT - Art Direction', '2017-04-30 16:00:00', NULL, NULL),
(46, 4, 'CRAFT - Design', '2017-04-30 16:00:00', NULL, NULL),
(47, 4, 'CRAFT - Illustration & Graphic Design', '2017-04-30 16:00:00', NULL, NULL),
(48, 4, 'CRAFT - Photography', '2017-04-30 16:00:00', NULL, NULL),
(49, 4, 'CRAFT - Soundtrack & Music', '2017-04-30 16:00:00', NULL, NULL),
(50, 4, 'CRAFT - Typography', '2017-04-30 16:00:00', NULL, NULL),
(51, 5, 'Branded Film Content& Entertainment', '2017-05-22 12:46:43', NULL, NULL),
(52, 5, 'Film for Good', '2017-05-22 12:46:43', NULL, NULL),
(53, 5, 'Documentary', '2017-05-22 12:46:56', NULL, NULL),
(54, 5, 'Music Video', '2017-05-22 12:46:56', NULL, NULL),
(55, 5, 'Online Film', '2017-05-22 12:47:15', NULL, NULL),
(56, 5, 'CRAFT - Animation', '2017-05-22 12:47:15', NULL, NULL),
(57, 5, 'CRAFT - Art Direction', '2017-04-30 16:00:00', NULL, NULL),
(58, 5, 'CRAFT - Directing', '2017-04-30 16:00:00', NULL, NULL),
(59, 5, 'CRAFT - Editing', '2017-04-30 16:00:00', NULL, NULL),
(60, 5, 'CRAFT - Cinematography', '2017-04-30 16:00:00', NULL, NULL),
(61, 5, 'CRAFT - Scripting', '2017-04-30 16:00:00', NULL, NULL),
(62, 6, 'Activation', '2017-05-22 12:48:33', NULL, NULL),
(63, 6, 'Applications', '2017-05-22 12:48:33', NULL, NULL),
(64, 6, 'Games', '2017-05-22 12:48:33', NULL, NULL),
(65, 6, 'Integrated', '2017-05-22 13:00:18', NULL, NULL),
(66, 6, 'IT for Good', '2017-05-22 13:00:18', NULL, NULL),
(67, 6, 'Mobile', '2017-05-22 13:00:38', NULL, NULL),
(68, 6, 'Product', '2017-05-22 13:00:38', NULL, NULL),
(69, 6, 'CRAFT - Animation & Motion Graphics', '2017-05-22 12:40:47', NULL, NULL),
(70, 6, 'CRAFT - Art Direction', '2017-05-22 12:40:47', NULL, NULL),
(71, 6, 'CRAFT - Design', '2017-05-22 12:40:47', NULL, NULL),
(72, 6, 'CRAFT - Illustration & Graphic D', '2017-05-22 12:40:47', NULL, NULL),
(73, 6, 'CRAFT - Photography', '2017-04-30 16:00:00', NULL, NULL),
(74, 6, 'CRAFT - Typography', '2017-04-30 16:00:00', NULL, NULL),
(75, 6, 'CRAFT - User Experience', '2017-04-30 16:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t0211_submission`
--

CREATE TABLE `t0211_submission` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_main_id` int(11) NOT NULL,
  `category_sub_id` int(11) NOT NULL,
  `zip_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_filesize` decimal(10,6) DEFAULT NULL COMMENT 'mb',
  `zip_s3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t8000_oauth_access_tokens`
--

CREATE TABLE `t8000_oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t8000_oauth_access_tokens`
--

INSERT INTO `t8000_oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('f8d122eb5caa439a704b15fa0fcd3948ae9992e07562186c94f7414551cce2a3abeee7e62843d613', 1, 1, 'Crowbar! Personal Access Client', '[]', 0, '2017-05-23 18:28:47', '2017-05-23 18:28:47', '2018-05-24 02:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `t8000_oauth_auth_codes`
--

CREATE TABLE `t8000_oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t8000_oauth_clients`
--

CREATE TABLE `t8000_oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t8000_oauth_clients`
--

INSERT INTO `t8000_oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Crowbar 2017 Personal Access Client', 'XGVD1tzDCMZSVoCERcHseFDo3hyEM0HVDCT07ZRh', 'http://localhost', 1, 0, 0, '2017-05-23 18:28:04', '2017-05-23 18:28:04'),
(2, NULL, 'Crowbar 2017 Password Grant Client', 'pu83uIdKEMwLSI83V9XIVswa32Indd80afsjiBLP', 'http://localhost', 0, 1, 0, '2017-05-23 18:28:04', '2017-05-23 18:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `t8000_oauth_personal_access_clients`
--

CREATE TABLE `t8000_oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t8000_oauth_personal_access_clients`
--

INSERT INTO `t8000_oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-05-23 18:28:04', '2017-05-23 18:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `t8000_oauth_refresh_tokens`
--

CREATE TABLE `t8000_oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t9011_password_resets_admin`
--

CREATE TABLE `t9011_password_resets_admin` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t9101_password_resets_user`
--

CREATE TABLE `t9101_password_resets_user` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t9401_log_general`
--

CREATE TABLE `t9401_log_general` (
  `id` int(11) UNSIGNED NOT NULL,
  `level_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `environment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t9411_log_insert`
--

CREATE TABLE `t9411_log_insert` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_type` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `table_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `t9412_log_update`
--

CREATE TABLE `t9412_log_update` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_type` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `table_id` int(11) NOT NULL,
  `content_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t0011_admin`
--
ALTER TABLE `t0011_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`deleted_at`);

--
-- Indexes for table `t0012_admin_external_id`
--
ALTER TABLE `t0012_admin_external_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0101_user`
--
ALTER TABLE `t0101_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`deleted_at`);

--
-- Indexes for table `t0102_user_external_id`
--
ALTER TABLE `t0102_user_external_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0104_user_setting`
--
ALTER TABLE `t0104_user_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0201_category_main`
--
ALTER TABLE `t0201_category_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0202_category_sub`
--
ALTER TABLE `t0202_category_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t0211_submission`
--
ALTER TABLE `t0211_submission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_main_id` (`category_main_id`),
  ADD KEY `category_sub_id` (`category_sub_id`),
  ADD KEY `zip_filesize` (`zip_filesize`);

--
-- Indexes for table `t8000_oauth_access_tokens`
--
ALTER TABLE `t8000_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `t8000_oauth_auth_codes`
--
ALTER TABLE `t8000_oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t8000_oauth_clients`
--
ALTER TABLE `t8000_oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `t8000_oauth_personal_access_clients`
--
ALTER TABLE `t8000_oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `t8000_oauth_refresh_tokens`
--
ALTER TABLE `t8000_oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `t9011_password_resets_admin`
--
ALTER TABLE `t9011_password_resets_admin`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `t9101_password_resets_user`
--
ALTER TABLE `t9101_password_resets_user`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `t9401_log_general`
--
ALTER TABLE `t9401_log_general`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t9411_log_insert`
--
ALTER TABLE `t9411_log_insert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t9412_log_update`
--
ALTER TABLE `t9412_log_update`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t0011_admin`
--
ALTER TABLE `t0011_admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t0012_admin_external_id`
--
ALTER TABLE `t0012_admin_external_id`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t0101_user`
--
ALTER TABLE `t0101_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t0102_user_external_id`
--
ALTER TABLE `t0102_user_external_id`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t0104_user_setting`
--
ALTER TABLE `t0104_user_setting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t0201_category_main`
--
ALTER TABLE `t0201_category_main`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `t0202_category_sub`
--
ALTER TABLE `t0202_category_sub`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `t0211_submission`
--
ALTER TABLE `t0211_submission`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t8000_oauth_clients`
--
ALTER TABLE `t8000_oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t8000_oauth_personal_access_clients`
--
ALTER TABLE `t8000_oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;