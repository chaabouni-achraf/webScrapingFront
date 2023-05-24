-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 19 nov. 2021 à 16:18
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dimazina_cs_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `In_menu` tinyint(1) NOT NULL DEFAULT 0,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `nom`, `In_menu`, `parent_id`) VALUES
(5, '2021-08-12 05:01:08', '2021-08-12 05:01:08', 'Maison&Décor', 1, NULL),
(6, '2021-08-12 05:01:08', '2021-08-12 05:01:08', 'Mode&Accessoires', 1, NULL),
(7, '2021-08-12 05:01:08', '2021-08-12 05:01:08', 'Art&Peinture', 1, NULL),
(8, '2021-08-12 05:01:08', '2021-08-12 05:01:08', 'Santé&Beauté', 1, NULL),
(9, '2021-08-12 05:01:08', '2021-08-12 05:01:08', 'Art de la table', 0, 5),
(10, '2021-09-07 05:04:10', '2021-09-07 05:04:10', 'Rangement', 0, 5),
(11, '2021-09-07 05:04:11', '2021-09-07 05:04:11', 'Luminaire', 0, 5),
(12, '2021-09-07 05:04:11', '2021-09-07 05:04:11', 'Tapis&Clim', 0, 5),
(13, '2021-09-07 05:04:11', '2021-09-07 05:04:11', 'Bois d\'olivier', 0, 5),
(14, '2021-09-07 05:04:12', '2021-09-07 05:04:12', 'Bijoux', 0, 6),
(15, '2021-09-07 05:04:12', '2021-09-07 05:04:12', 'Sacs', 0, 6),
(16, '2021-09-08 12:45:14', '2021-09-08 12:45:14', 'test', 0, 5),
(17, '2021-09-08 12:45:14', '2021-09-08 12:45:14', 'Rangement11', 0, 5),
(18, '2021-09-20 06:41:51', '2021-09-20 06:41:51', 'test', 0, 5),
(19, '2021-09-20 06:41:52', '2021-09-20 06:41:52', 'Photographie', 0, 7),
(20, '2021-09-20 06:41:52', '2021-09-20 06:41:52', 'Peinture', 0, 7),
(21, '2021-09-20 06:41:52', '2021-09-20 06:41:52', 'Collage et techniques mixtes', 0, 7),
(22, '2021-09-20 06:41:52', '2021-09-20 06:41:52', 'Sculpture', 0, 7),
(23, '2021-09-20 06:41:52', '2021-09-20 06:41:52', 'Art textile', 0, 7),
(24, '2021-09-20 06:41:52', '2021-09-20 06:41:52', 'Huiles essentielles', 0, 8),
(25, '2021-09-20 06:41:52', '2021-09-20 06:41:52', 'Produits cosmétiques', 0, 8);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(42, '2014_10_12_000000_create_users_table', 1),
(43, '2014_10_12_100000_create_password_resets_table', 1),
(44, '2019_08_19_000000_create_failed_jobs_table', 1),
(45, '2021_07_04_183657_create_produits_table', 1),
(46, '2021_08_11_081654_create_categories_table', 1),
(47, '2021_08_30_171305_add_category_id_produits_table', 1),
(48, '2021_09_06_151231_add_field_parent_id_categories_table', 1),
(49, '2021_10_11_092335_create_roles_table', 1),
(50, '2021_10_11_094245_create_role_user_table', 1),
(51, '2021_10_14_090149_add_user_id_produits_table', 1),
(52, '2021_11_09_132538_create_photoproduits_table', 1),
(53, '2021_11_10_174658_photoproduits_cascade', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photoproduits`
--

CREATE TABLE `photoproduits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `Photo_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photoproduits`
--

INSERT INTO `photoproduits` (`id`, `created_at`, `updated_at`, `produit_id`, `Photo_1`, `Photo_2`, `Photo_3`) VALUES
(1, '2021-11-15 11:22:17', '2021-11-15 11:22:17', 1, '', '', ''),
(2, '2021-11-18 07:25:14', '2021-11-18 07:25:14', 1, '', '', ''),
(3, '2021-11-19 09:49:48', '2021-11-19 09:49:48', 1, '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prix` double(8,2) NOT NULL,
  `Prix_euro` double(8,2) NOT NULL,
  `Prix_dollar` double(8,2) NOT NULL,
  `Qte` int(11) NOT NULL,
  `Photo_principale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `created_at`, `updated_at`, `nom`, `description`, `Prix`, `Prix_euro`, `Prix_dollar`, `Qte`, `Photo_principale`, `category_id`, `user_id`) VALUES
(1, '2021-11-15 11:22:17', '2021-11-15 11:22:17', 'hello', 'aaaa', 30.00, 20.00, 10.00, 13, '1636982537.png', 20, 1),
(2, '2021-11-18 07:25:14', '2021-11-18 07:25:14', 'achraf', 'dgshfkjk', 350.00, 0.00, 0.00, 3, '1637223913.jpg', 5, 15);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'artcreator', '2021-10-12 07:14:33', '2021-10-12 07:14:33'),
(2, 'frs', '2021-10-12 07:14:33', '2021-10-12 07:14:33'),
(3, 'clt', '2021-10-12 07:14:33', '2021-10-12 07:14:33'),
(4, 'admin', '2021-10-12 07:14:33', '2021-10-12 07:14:33'),
(5, 'office', '2021-10-12 07:14:34', '2021-10-12 07:14:34');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 5, NULL, NULL),
(5, 1, 6, NULL, NULL),
(6, 1, 7, NULL, NULL),
(7, 1, 8, NULL, NULL),
(8, 1, 9, NULL, NULL),
(9, 1, 11, NULL, NULL),
(10, 1, 15, NULL, NULL),
(11, 1, 16, NULL, NULL),
(12, 1, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adresse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ville` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Code_postal` int(100) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `avatar`, `Adresse`, `Ville`, `Code_postal`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'majd', 'majd@gmail.com', 23213744, NULL, '$2y$10$i9mAmaCUQa3kGj.UicuiDuXjEHl3Cg.nRzoUM7eeISPy7SK30Xq9G', 'photo.jpg', '', '', 0, NULL, '2021-11-15 11:14:56', '2021-11-15 11:14:56'),
(2, 'achraf', NULL, 232464265, NULL, '$2y$10$vOWXdKcASpT2pB4DtiFsqeGEou9HWCpFLtBeAD5ucquR5rI6WrgRu', 'photo.jpg', '', '', 0, NULL, '2021-11-15 12:02:55', '2021-11-15 12:02:55'),
(3, 'bassem', 'aa@gmail.com', 50486426, NULL, '$2y$10$WJzQT7OeYAoc5SgOeQ6OZOsfL9rFE0rcDwcNvG0DgxQJllQlHNSZ6', 'photo.jpg', '', '', 0, NULL, '2021-11-15 12:04:42', '2021-11-15 12:04:42'),
(5, 'finale', NULL, 50123456, NULL, '$2y$10$yoyyw/TtgEo3591flNKV4.7BD.pNVtu561QxWyvHh7DnEZwMYRmn2', 'photo.jpg', '', '', 0, NULL, '2021-11-15 13:04:20', '2021-11-15 13:04:20'),
(6, 'hello', NULL, 25486426, NULL, '$2y$10$tOocZWlsBbbgytmKXaCaz.fxx5zp2k78UyjchdB7sozi9TWA5gnrm', 'photo.jpg', '', '', 0, NULL, '2021-11-15 14:25:31', '2021-11-15 14:25:31'),
(7, 'achrafchaabouni', NULL, 23123123, NULL, '$2y$10$b344qr43uNx3oQr2y/cRCODyyrwUP3jPWzWdcv4Nrg614uTFxkusu', 'photo.jpg', '', '', 0, NULL, '2021-11-15 14:31:26', '2021-11-15 14:31:26'),
(8, 'achraf', '22asoft2018@gmail.com', 52613495, NULL, '$2y$10$1Ha.ytkIMsxBMFz7Sua7A.IyfKxxZhxs//3j8iyNuDINqR3N8pkWi', '1637280000.jpg', 'route de 3in klm6.5', 'sfax', 3062, NULL, '2021-11-16 07:26:35', '2021-11-19 14:04:59'),
(9, 'amine', NULL, 123456789, NULL, '$2y$10$OPOq5XlxvQ2i5f1Wl0O5tOsrJXVGIL5htlvglJe.BOWTef43iYEpC', 'photo.jpg', '', '', 0, NULL, '2021-11-16 12:08:05', '2021-11-16 12:08:05'),
(11, 'mohamed', 'majd5@gmail.com', 56123456, NULL, '$2y$10$AvKcsndL5YPVBU2U0RO2CO9uargu5Q3PXC6jAji5w.iN6OOfjrZhW', '1637107200.jpg', 'routr matar klm 6.5', 'Sfax', 3062, NULL, '2021-11-17 08:15:51', '2021-11-17 14:21:24'),
(15, 'hajer', NULL, 52777777, NULL, '$2y$10$HONy9TLcCqLEnihtn9s2g.1EbhqTUDPA8UMk3dv.6My.4GTVzTq4a', '1637193600.jpg', NULL, NULL, NULL, NULL, '2021-11-18 07:21:15', '2021-11-18 07:22:04'),
(16, 'Hajer', NULL, 21114716, NULL, '$2y$10$zW..e565qXP26Xb93x3rp.S1pdti..1xwLJP7EZXYZajZKFVhdWIy', 'photo.jpg', NULL, NULL, NULL, NULL, '2021-11-19 09:06:53', '2021-11-19 09:06:53'),
(18, 'HajerSah', '2hajer@gmail.com', 21114717, NULL, '$2y$10$YR91S32qWTj8N15jcCePX.ifPb6/uGiUt006Oca/LzscqG3wmMPCC', '1637280000.jpg', 'route de 3in klm6.5', 'sfaxx', 3061, NULL, '2021-11-19 09:30:13', '2021-11-19 13:01:36');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `photoproduits`
--
ALTER TABLE `photoproduits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photoproduits_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_category_id_foreign` (`category_id`),
  ADD KEY `produits_user_id_foreign` (`user_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `photoproduits`
--
ALTER TABLE `photoproduits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `photoproduits`
--
ALTER TABLE `photoproduits`
  ADD CONSTRAINT `photoproduits_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `produits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
