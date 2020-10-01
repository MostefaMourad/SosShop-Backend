-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2020 at 07:48 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.0.33-29+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SosShop`
--

-- --------------------------------------------------------

--
-- Table structure for table `acheteurs`
--

CREATE TABLE `acheteurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_sup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre` tinyint(1) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acheteurs`
--

INSERT INTO `acheteurs` (`id`, `email`, `password`, `nom`, `prenom`, `telephone`, `telephone_sup`, `region`, `ville`, `adresse`, `genre`, `date_naissance`) VALUES
(1, 'hm_mostefa@esi.dz', 'cacaca', 'Mostefa', 'Mourad', '0781872253', NULL, 'Chlef', 'Chlef', 'R17 , 327', 1, '1999-07-13'),
(2, 'ha_bouali@esi.dz', 'cacaca', 'Bouali', 'Abdelhadi', '0781872253', NULL, 'Chlef', 'Chlef', 'zone 5', 1, '1999-07-13'),
(3, 'hm_mostefa@esi.dzaaa', '$2y$10$7sOXreaKRqk5cExdiwvTyOrCkTLApeSxu2CyPElxetLESKc.gbAAe', 'aaaaaaaa', 'aaaaaaaa', '0781872253', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'hm_mostefa@esi.dza', '$2y$10$ZE0GAkYfyeopDKUWYaqDDuZSHVjiVzt.gmmXN0QM0TWHeoOskXcj.', 'mourad', 'mostefa', '0551547862', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_produits` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `nombre_produits`) VALUES
(1, 'Informatique', 0),
(2, 'Electroménger', 0),
(3, 'Santé', 0);

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `etat` enum('panier','livraison') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'panier',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panier_id` int(10) UNSIGNED DEFAULT NULL,
  `livraison_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `quantite`, `product_id`, `etat`, `image`, `panier_id`, `livraison_id`) VALUES
(1, 2, 1, 'panier', '\"\"', 1, 1),
(2, 2, 2, 'panier', '\"\"', 1, 1),
(3, 1, 3, 'panier', '\"\"', 1, 1),
(4, 2, 3, 'panier', '\"\"', 2, 2),
(5, 2, 4, 'panier', '\"\"', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `espace_vendeurs`
--

CREATE TABLE `espace_vendeurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `produits_vendus` int(11) NOT NULL DEFAULT '0',
  `nombre_produits` int(11) NOT NULL DEFAULT '0',
  `vendeur_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `espace_vendeurs`
--

INSERT INTO `espace_vendeurs` (`id`, `produits_vendus`, `nombre_produits`, `vendeur_id`) VALUES
(1, 0, 0, 1),
(2, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `reponse`) VALUES
(1, 'q4', 'r4'),
(2, 'q2', 'r2'),
(3, 'q4', 'q55555555');

-- --------------------------------------------------------

--
-- Table structure for table `livraisons`
--

CREATE TABLE `livraisons` (
  `id` int(10) UNSIGNED NOT NULL,
  `acheteur_id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livraisons`
--

INSERT INTO `livraisons` (`id`, `acheteur_id`, `nom`, `prenom`, `numero`, `adresse`, `region`, `ville`, `etat`, `image`) VALUES
(1, 1, 'Mostefa', 'Mourad', '0781872253', 'R17 , 327', 'Chlef', 'Chlef', 'Commande passee', ''),
(2, 2, 'Mostefa', 'Mourad', '0781872253', 'R17 , 327', 'Chlef', 'Chlef', 'Expedition et Livraison', '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom_complet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_commande` int(11) NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `nom_complet`, `email`, `num_commande`, `sujet`, `message`) VALUES
(2, 'aaaaa', 'aaaa1@aaaa', 1111111, 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(3, 'aaaaa', 'aaaa3@aaaa', 1111111, 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_07_23_010442_create_vendeurs_table', 1),
(10, '2020_07_23_010534_create_acheteurs_table', 1),
(11, '2020_07_23_011346_create_paniers_table', 1),
(12, '2020_07_23_011445_create_espace_vendeurs_table', 1),
(13, '2020_07_23_180612_create_categories_table', 1),
(14, '2020_07_23_225100_create_sous_categories_table', 1),
(15, '2020_07_23_232431_create_commandes_table', 1),
(16, '2020_07_23_232507_create_produits_table', 1),
(17, '2020_09_06_192534_create_services_table', 1),
(18, '2020_09_06_192621_create_publicites_table', 1),
(19, '2020_09_06_192629_create_faqs_table', 1),
(20, '2020_09_06_192911_create_messages_table', 1),
(21, '2020_09_06_234136_create_livraisons_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0367e651a7962fbe307595e872bd45dfc7fb9e951d6046621408a550779f19d70d15d0c0259a90af', 3, 1, 'My Acheteur', '[]', 0, '2020-09-22 13:21:06', '2020-09-22 13:21:06', '2021-09-22 14:21:06'),
('277be62a0204e88850ef8b7fe94876368b7976429d0b5c0b4ed00f439d1c0c63d29976e0a756e768', 6, 1, 'My Acheteur', '[]', 0, '2020-09-22 13:53:22', '2020-09-22 13:53:22', '2021-09-22 14:53:22'),
('2ba175d86e63dac9007a92b2a0243f362a928a99c41c477b531070ebcd48eed823dd0fc8512815b6', 1, 1, 'My Vendeur', '[]', 0, '2020-09-12 19:45:21', '2020-09-12 19:45:21', '2021-09-12 20:45:21'),
('41a182ee6cfd004e74aa782ba2a0cb81a0880935c23eb5744c0054e06bd2163f37dae16de15ffb51', 8, 1, 'My Acheteur', '[]', 0, '2020-09-22 13:58:52', '2020-09-22 13:58:52', '2021-09-22 14:58:52'),
('4c174d9c272cceb74c67351aed182b9b216394ee015e1670a8f8b45a0d1b8f6f36a93ff689f01a92', 8, 1, 'My Acheteur', '[]', 0, '2020-09-22 14:09:07', '2020-09-22 14:09:07', '2021-09-22 15:09:07'),
('70a108c43bcce53a44dfee3567ca8ba03f2306c02f43ece3f515e8b718d42fb98c978153b54ecdc4', 8, 1, 'My Acheteur', '[]', 0, '2020-09-22 14:09:55', '2020-09-22 14:09:55', '2021-09-22 15:09:55'),
('8986fb2fa2344b1b28ff50e6af72fee545e80ace63fa1617d159a03f6573677d63f640898e1e1842', 4, 1, 'My Acheteur', '[]', 0, '2020-09-22 13:22:34', '2020-09-22 13:22:34', '2021-09-22 14:22:34'),
('9173a2e10af3fa26194c1194b7fe1c0262fa4fc6f61b3a23cf74c7e32a92002cbebb2d9134143850', 5, 1, 'My Acheteur', '[]', 0, '2020-09-22 13:49:39', '2020-09-22 13:49:39', '2021-09-22 14:49:39'),
('a87c154aece340da3ea531a50893ead5c9d3cd668083c6a4dc6b184c96183dee2f0e8e1e3a19a2a8', 8, 1, 'My Acheteur', '[]', 0, '2020-09-22 14:27:39', '2020-09-22 14:27:39', '2021-09-22 15:27:39'),
('ef665cb657ef7040d6caa7fb51fa998ae4e214a730374b8e0a5f8e17f7b28aef4f8041c7d9ab9ce6', 7, 1, 'My Acheteur', '[]', 0, '2020-09-22 13:56:49', '2020-09-22 13:56:49', '2021-09-22 14:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'fnWzYCswZATaQYOCkbwsfC64GeaVKyfWtoL2QyF9', NULL, 'http://localhost', 1, 0, 0, '2020-09-12 19:35:54', '2020-09-12 19:35:54'),
(2, NULL, 'Laravel Password Grant Client', 'RkMqNng2FytK1QM4xPvq1swsdmRjDmmI1vZRxZkN', 'users', 'http://localhost', 0, 1, 0, '2020-09-12 19:35:54', '2020-09-12 19:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-09-12 19:35:54', '2020-09-12 19:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paniers`
--

CREATE TABLE `paniers` (
  `id` int(10) UNSIGNED NOT NULL,
  `commandes` int(11) NOT NULL DEFAULT '0',
  `annule` int(11) NOT NULL DEFAULT '0',
  `complete` int(11) NOT NULL DEFAULT '0',
  `acheteur_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paniers`
--

INSERT INTO `paniers` (`id`, `commandes`, `annule`, `complete`, `acheteur_id`) VALUES
(1, 0, 0, 0, 1),
(2, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double(8,2) NOT NULL,
  `prix_promotionnel` double(8,2) NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longueur` double(8,2) NOT NULL,
  `largeur` double(8,2) NOT NULL,
  `hauteur` double(8,2) NOT NULL,
  `poids` double(8,2) NOT NULL,
  `images` json NOT NULL,
  `espace_vendeur_id` int(10) UNSIGNED NOT NULL,
  `categorie_id` int(10) UNSIGNED NOT NULL,
  `sous_categorie_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `titre`, `description`, `prix`, `prix_promotionnel`, `marque`, `quantite`, `couleur`, `longueur`, `largeur`, `hauteur`, `poids`, `images`, `espace_vendeur_id`, `categorie_id`, `sous_categorie_id`) VALUES
(1, 'Iphone1', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2),
(2, 'Iphone2', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 1, 1, 2),
(3, 'Iphone3', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2),
(4, 'Iphone4', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 2, 5),
(5, 'Iphone5', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2),
(6, 'Iphone6', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2),
(7, 'Iphone7', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 3),
(8, 'sneakers8', 'ajadgG', 12000.00, 12000.00, 'nike', 1, 'Noir', 1.00, 1.00, 1.00, 1.00, '[]', 1, 2, 6),
(9, 'Iphone9', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 3),
(10, 'Bag10', 'meeeesteeeky aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaa aaaaaaaaaa aaaaa aaaaaaa aaaa aaa aaaaaaaaaa aaaaaaaaaaa aaaaaa aaaaaaaa aaaaaaaa aaaaaaa aaaaaaaaa aaaaaaa aa \n', 350.00, 350.00, 'Nike', 17, 'Noir', 1.00, 1.00, 1.00, 1.00, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 1, 1, 3),
(11, 'Iphone11', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 3),
(12, 'Iphone12', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 3),
(13, 'Iphone13', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 6),
(14, 'Iphone14', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 6),
(15, 'Iphone15', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 1, 1, 6),
(16, 'Iphone16', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 6),
(17, 'Iphone17', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 2, 5),
(18, 'Iphone18', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 5),
(19, 'Iphone19', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 5),
(20, 'Iphone20', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 5),
(21, 'sneakers21', 'ajadgG', 12000.00, 12000.00, 'nike', 1, 'Noir', 1.00, 1.00, 1.00, 1.00, '[]', 1, 2, 9),
(22, 'Iphone22', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 9),
(23, 'Bag23', 'meeeesteeekyaaaaa', 350.00, 350.00, 'Nike', 17, 'Noir', 1.00, 1.00, 1.00, 1.00, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 1, 1, 9),
(24, 'Iphone24', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 9),
(25, 'Iphone25', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 9),
(26, 'Iphone26', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2),
(27, 'Iphone27', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2),
(28, 'Bag28', 'meeeesteeekyaaaaa', 350.00, 350.00, 'Nike', 17, 'Noir', 1.00, 1.00, 1.00, 1.00, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 1, 1, 2),
(29, 'Iphone29', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2),
(30, 'Iphone30', 'de best', 12000.00, 12000.00, 'Apple', 5, 'Blanche', 0.02, 0.02, 0.02, 0.10, '[\"ImagesProduits/MrorSW7FSrf0T1awdlVg3ggprL7Gy35MNYEI822j.jpeg\", \"ImagesProduits/ICroF1UNzViLwIfiiW8fBm4RrxEV8YW0tUZuOr3d.jpeg\", \"ImagesProduits/7r3aWZyEaVKhLDd4QFY348fmDQGHSIaB8mKq5yox.jpeg\", \"ImagesProduits/HzYKbFbqS1r27MznLQoBXn8Pxv9m1pQSgF5y4j2b.jpeg\"]', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `publicites`
--

CREATE TABLE `publicites` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sous_titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('first','second','third') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publicites`
--

INSERT INTO `publicites` (`id`, `titre`, `sous_titre`, `type`, `image`) VALUES
(2, 'Cov-19', 'Protéction', 'first', 'ImagesPublicites/LFSbML70ZspodW4K7rgacFkpeEuNp8GSFhFRyBFR.jpeg'),
(3, 'Corabica', 'this is fascinating', 'first', 'ImagesPublicites/nHo8TngaeSf1REe996AmGFuZxbt731U06I5Tubil.jpeg'),
(4, 'Badroom', 'it\'s relaxing', 'second', 'ImagesPublicites/DM7DJn4V75oMzsS34vWbMwdl97pcLrR4sSHfC54E.jpeg'),
(5, 'Travel', 'discover the world', 'third', 'ImagesPublicites/kpSh6JYnaKxqBuPDFWTrS4BwGaR3sHzitwmtX6Af.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partenaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `titre`, `description`, `partenaire`, `numero`, `prix`, `image`) VALUES
(1, 'réparation', 'aaaaaaaaaaaaaaaaaaa', 'djezzy', '0781872253', 3000.00, ''),
(2, 'Répa', 'de best', 'PLumbers Dz', '05541232', 4444.00, 'ImagesServices/8S6rEEuucMUW6r5XWDnghOdJ63hjxyhUw7Te9TtO.png');

-- --------------------------------------------------------

--
-- Table structure for table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_produits` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`, `categorie_id`, `image`, `nombre_produits`) VALUES
(2, 'Informatique', 1, 'ImagesSousCategories/g1HT9kjhxHwMjhfRTS98YYenRrCoH6NsgC5adieD.jpeg', 0),
(3, 'Téléphones Portables', 1, 'ImagesSousCategories/r3oIVKNMYPkdC0jcdQBW1JTzSd46BOF4jy7ynnTk.jpeg', 0),
(5, 'Santé', 1, '', 0),
(6, 'Beauté', 2, 'ImagesSousCategories/h2GhyXqe65KWcmWAkvApwSfoymiMGqLCtjSqrprM.jpeg', 0),
(9, 'Véhicules', 1, 'ImagesServices/aAM0c3YsF2odNUIcxYa8kOTKotOGaluaWtrWB5eJ.jpeg', 0);

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SosShop', 'contact@sosbusiness.dz', NULL, '$2y$10$vOLsc1ZBuu2l6U/tVpPlWuZIZUk7jlPy.tws6pJ/QsyD9VLsSyLVK', 'ALUz1SGHc3a1Ggnt4UoLEmrSgYu11hIBNDVTSk6pG8Tmg2CUFV3QVQnuKz55', '2020-09-12 19:43:57', '2020-09-12 19:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `vendeurs`
--

CREATE TABLE `vendeurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_sup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `image_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_boutique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inscription_complete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendeurs`
--

INSERT INTO `vendeurs` (`id`, `email`, `password`, `nom`, `prenom`, `telephone`, `telephone_sup`, `adresse`, `date_naissance`, `image_profil`, `nom_boutique`, `description`, `inscription_complete`) VALUES
(1, 'contact@sosbusiness.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'SosShop', 'SosShop', '0558687379', NULL, 'SosShop', '2020-10-01', NULL, 'SosShop', NULL, 0),
(2, 'hm_mostefa@esi.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'Mostefa', 'Mourad', '0558687379', NULL, 'SosShop', '2020-10-01', NULL, 'SosShop', NULL, 0),
(3, 'hm_mostefa1@esi.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'Mostefa1', 'Mourad1', '0558687379', NULL, 'Boutique1', '2020-10-01', NULL, 'Boutique1', NULL, 0),
(4, 'hm_mostefa2@esi.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'Mostefa2', 'Mourad2', '0558687379', NULL, 'Boutique2', '2020-10-01', NULL, 'Boutique2', NULL, 0),
(5, 'hm_mostefa3@esi.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'Mostefa3', 'Mourad3', '0558687379', NULL, 'Boutique3', '2020-10-01', NULL, 'Boutique3', NULL, 0),
(6, 'hm_mostefa4@esi.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'Mostefa4', 'Mourad4', '0558687379', NULL, 'Boutique4', '2020-10-01', NULL, 'Boutique4', NULL, 0),
(7, 'hm_mostefa5@esi.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'Mostefa5', 'Mourad5', '0558687379', NULL, 'Boutique5', '2020-10-01', NULL, 'Boutique5', NULL, 0),
(8, 'hm_mostefa6@esi.dz', '$2y$10$Yu1J.6eIZD4.0976nE/AyOT.MOcNZTBxXAoqkfkNp0uxO0DKwisuO', 'Mostefa6', 'Mourad6', '0558687379', NULL, 'Boutique6', '2020-10-01', NULL, 'Boutique6', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acheteurs`
--
ALTER TABLE `acheteurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acheteurs_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commandes_panier_id_foreign` (`panier_id`);

--
-- Indexes for table `espace_vendeurs`
--
ALTER TABLE `espace_vendeurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `espace_vendeurs_vendeur_id_foreign` (`vendeur_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraisons_acheteur_id_foreign` (`acheteur_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paniers_acheteur_id_foreign` (`acheteur_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_espace_vendeur_id_foreign` (`espace_vendeur_id`),
  ADD KEY `produits_categorie_id_foreign` (`categorie_id`),
  ADD KEY `produits_sous_categorie_id_foreign` (`sous_categorie_id`);

--
-- Indexes for table `publicites`
--
ALTER TABLE `publicites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sous_categories_categorie_id_foreign` (`categorie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendeurs`
--
ALTER TABLE `vendeurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendeurs_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acheteurs`
--
ALTER TABLE `acheteurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `espace_vendeurs`
--
ALTER TABLE `espace_vendeurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `livraisons`
--
ALTER TABLE `livraisons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `publicites`
--
ALTER TABLE `publicites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sous_categories`
--
ALTER TABLE `sous_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendeurs`
--
ALTER TABLE `vendeurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_panier_id_foreign` FOREIGN KEY (`panier_id`) REFERENCES `paniers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `espace_vendeurs`
--
ALTER TABLE `espace_vendeurs`
  ADD CONSTRAINT `espace_vendeurs_vendeur_id_foreign` FOREIGN KEY (`vendeur_id`) REFERENCES `vendeurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `livraisons`
--
ALTER TABLE `livraisons`
  ADD CONSTRAINT `livraisons_acheteur_id_foreign` FOREIGN KEY (`acheteur_id`) REFERENCES `acheteurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `paniers_acheteur_id_foreign` FOREIGN KEY (`acheteur_id`) REFERENCES `acheteurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produits_espace_vendeur_id_foreign` FOREIGN KEY (`espace_vendeur_id`) REFERENCES `espace_vendeurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produits_sous_categorie_id_foreign` FOREIGN KEY (`sous_categorie_id`) REFERENCES `sous_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `sous_categories_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
