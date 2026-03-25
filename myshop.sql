-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 25 mars 2026 à 07:32
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `add_product_history`
--

DROP TABLE IF EXISTS `add_product_history`;
CREATE TABLE IF NOT EXISTS `add_product_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL,
  `created_at` datetime NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EDEB7BDE4584665A` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `add_product_history`
--

INSERT INTO `add_product_history` (`id`, `quantity`, `created_at`, `product_id`) VALUES
(1, 20, '2026-03-03 13:52:17', 13),
(2, 1, '2026-03-03 14:42:12', 14),
(3, 1, '2026-03-03 14:45:01', 15),
(4, 2, '2026-03-04 09:28:27', 1),
(5, 3, '2026-03-04 09:28:41', 1),
(6, 5, '2026-03-04 09:31:42', 1),
(7, 6, '2026-03-04 09:34:49', 13),
(8, 2, '2026-03-16 08:30:12', 16),
(9, 1, '2026-03-17 08:28:12', 17),
(10, 1, '2026-03-17 08:28:43', 18),
(11, 1, '2026-03-17 08:29:12', 19),
(12, 1, '2026-03-17 08:29:54', 20),
(13, 1, '2026-03-17 08:30:08', 21),
(14, 1, '2026-03-17 08:32:28', 22),
(15, 1, '2026-03-17 08:33:52', 23),
(16, 1, '2026-03-17 08:34:18', 24),
(17, 1, '2026-03-17 08:34:39', 25),
(18, 1, '2026-03-17 08:36:19', 26),
(19, 1, '2026-03-17 08:36:37', 27),
(20, 1, '2026-03-17 08:37:33', 28),
(21, 1, '2026-03-17 08:46:53', 29),
(22, 1, '2026-03-17 08:47:13', 30),
(23, 1, '2026-03-17 08:48:34', 31),
(24, 6, '2026-03-17 12:03:29', 32),
(25, 7, '2026-03-17 12:03:57', 33),
(26, 10, '2026-03-17 12:04:24', 34),
(27, 12, '2026-03-17 12:04:45', 35),
(28, 10, '2026-03-17 12:06:14', 36);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(180) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_64C19C15E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(4, 'Chemise'),
(2, 'Complément Alimentaire'),
(3, 'Injection'),
(8, 'Merchandising');

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shipping_cost` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `name`, `shipping_cost`) VALUES
(1, 'Merignac', 0.5),
(2, 'Sainte-Rose', 9.71),
(3, 'Fort-de-France', 9.72),
(4, 'Tourcoing', 10.22),
(5, 'Tokyo', 27.29);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260302093413', '2026-03-02 09:37:07', 165),
('DoctrineMigrations\\Version20260302125254', '2026-03-02 12:53:13', 125),
('DoctrineMigrations\\Version20260302130459', '2026-03-02 13:05:07', 105),
('DoctrineMigrations\\Version20260302142010', '2026-03-02 14:20:16', 262),
('DoctrineMigrations\\Version20260302142350', '2026-03-02 14:23:58', 169),
('DoctrineMigrations\\Version20260303104648', '2026-03-03 10:46:55', 306),
('DoctrineMigrations\\Version20260303125703', '2026-03-03 12:58:42', 85),
('DoctrineMigrations\\Version20260303131557', '2026-03-03 13:16:07', 157),
('DoctrineMigrations\\Version20260317121908', '2026-03-17 12:19:46', 147),
('DoctrineMigrations\\Version20260317131116', '2026-03-17 13:11:26', 128),
('DoctrineMigrations\\Version20260323073908', '2026-03-23 07:40:55', 184),
('DoctrineMigrations\\Version20260323092241', '2026-03-23 09:23:08', 252),
('DoctrineMigrations\\Version20260324104025', '2026-03-24 10:40:49', 279);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `city_id` int DEFAULT NULL,
  `pay_on_delivery` tinyint NOT NULL,
  `total_price` double NOT NULL,
  `is_completed` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F52993988BAC62AF` (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `first_name`, `last_name`, `phone`, `adress`, `created_at`, `city_id`, `pay_on_delivery`, `total_price`, `is_completed`) VALUES
(11, 'ROKUSASU', 'Sora', '0613010111', 'Place de la Fontaine', '2026-03-24 14:23:26', 1, 1, 41, 1),
(12, 'ROKUSASU', 'Sora', '0613010111', 'Place de la Fontaine', '2026-03-24 14:24:01', 3, 1, 7, 1),
(10, 'ROKUSASU', 'Sora', '0613010111', 'Place de la Fontaine', '2026-03-24 14:21:51', 1, 1, 14, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qte` int NOT NULL,
  `_order_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5242B8EBA35F2858` (`_order_id`),
  KEY `IDX_5242B8EB4584665A` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `order_products`
--

INSERT INTO `order_products` (`id`, `qte`, `_order_id`, `product_id`) VALUES
(9, 1, 11, 34),
(8, 2, 11, 35),
(7, 2, 10, 36),
(11, 1, 12, 36),
(10, 1, 11, 33);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(180) NOT NULL,
  `description` longtext,
  `price` int NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D34A04AD5E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `images`, `stock`) VALUES
(1, 'Orchis mâle', 'Grrrrr!!!!', 3, 'template-69b94185afa47.jpg', 22),
(2, 'Miel', 'Sneaker de ville grise', 45, 'template-69b941a1038b6.jpg', 3),
(12, 'Berce', 'Chaussure confort de ville', 2, 'template-69b941a920316.jpg', 5),
(13, 'Giroglier', 'Feel stylish and fresh with the New Panteher Max', 89, 'template-69b941c59af8d.jpg', 26),
(15, 'Ginseng asiatique', 'ouillle ouille ouille', 1, 'template-69b941d830f81.jpg', 1),
(16, 'Saffran', NULL, 3, 'template-69b941df223da.jpg', 2),
(17, 'Alpha Genesis', 'Gamme \"Domination & Performance\" (Testostérone) :\nLe fer de lance. Un mélange puissant de Tribulus terrestre et de Maca pour stimuler la vitalité hormonale naturelle.', 5, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c59ad966.webp', 1),
(18, 'Testo-Peak Gold', 'Gamme \"Domination & Performance\" (Testostérone) :\nÀ base de Luzerne et d’Orchis mâle, conçu pour ceux qui veulent maximiser leur potentiel physique.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c6d2adaa.webp', 1),
(19, 'T-Drive Intense', 'Gamme \"Domination & Performance\" (Testostérone) :\nUne combinaison de Terminalia chebula et de Gingembre pour soutenir le métabolisme actif et la vigueur.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c73353f4.webp', 1),
(20, 'Titan Strength', 'Gamme \"Domination & Performance\" (Testostérone) :\nConcentré de Berce et de Ginseng asiatique, pour une force brute et une résilience à toute épreuve.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c790d523.webp', 1),
(21, 'Root of Power', 'Gamme \"Domination & Performance\" (Testostérone) :\nUn gummy mono-extrait de Maca noire hautement concentrée, la racine sacrée de la virilité.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c7da9a57.webp', 1),
(22, 'Nitro-Flow Max', 'Gamme \"Flux & Énergie\" (Vascularité & Assurance) : \nBoosté à l\'Oxyde nitrique et au Giroflier, ce gummy favorise une circulation optimale pour une présence physique imposante.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c81daa6f.webp', 1),
(23, 'Vaso-Master', 'Gamme \"Flux & Énergie\" (Vascularité & Assurance) : \nL\'alliance du Gingembre et de l\'Oxyde nitrique pour une congestion musculaire visible et une énergie débordante.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c865b6a2.webp', 1),
(24, 'Iron Pulse', 'Gamme \"Flux & Énergie\" (Vascularité & Assurance) : \nUn mélange de Terminalia chebula et de Luzerne pour purifier le corps tout en maintenant un flux énergétique constant.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c8b7fd2a.webp', 1),
(25, 'Vigor Blast', 'Gamme \"Flux & Énergie\" (Vascularité & Assurance) : \nGiroflier et Ginseng, le duo de choc pour une réactivité immédiate et un dynamisme sans faille.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c9008969.webp', 1),
(26, 'Mood Monarch', 'Gamme \"Éclat Social\" (Confiance en soi & Mental)\nInfusé au Safran précieux, ce gummy régule l\'humeur et booste la confiance en soi lors des interactions sociales.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c9b28bde.webp', 1),
(27, 'Zen Commander', 'Gamme \"Éclat Social\" (Confiance en soi & Mental)\nGinseng asiatique et Safran, pour un esprit calme dans un corps puissant. L\'assurance tranquille du leader.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92c9fdcfea.webp', 1),
(28, 'Focus Alpha :', 'Gamme \"Éclat Social\" (Confiance en soi & Mental)\nGingembre et Luzerne, pour une clarté mentale qui impose le respect lors des prises de parole.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92ccdeb793.webp', 1),
(29, 'Primal Seed', 'Gamme \"Héritage\" (Fertilité & Vitalité)\nUn complexe de Tribulus et d\'Orchis mâle dédié à la santé reproductive et à la vitalité profonde.', 1, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92cd0bb993.webp', 1),
(30, 'Essence Ancestrale', 'Gamme \"Héritage\" (Fertilité & Vitalité)\nMaca et Berce, une recette inspirée des remèdes anciens pour fortifier la lignée et la vigueur intime.', 18, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92ce5bac27.webp', 1),
(31, 'Vital Link', 'Gamme \"Héritage\" (Fertilité & Vitalité)\nTerminalia chebula associé au Ginseng, pour un équilibre global du système reproducteur et une longévité accrue.', 8, 'fdd2248d5d36442cf71734a73385ae75-gummiesh4cbd-69b92ce9c0eb6.webp', 1),
(32, 'Tribulus terrestre', NULL, 3, 'template-69b94311097c9.jpg', 6),
(33, 'Terminalia chebula', NULL, 10, 'template-69b9432dc0391.jpg', 7),
(34, 'Maca', NULL, 9, 'template-69b943486ad63.jpg', 10),
(35, 'Gingembre', NULL, 11, 'template-69b9435d76396.jpg', 12),
(36, 'Oxyde nitrique', NULL, 7, 'template-69b943b6610f0.jpg', 10);

-- --------------------------------------------------------

--
-- Structure de la table `product_sub_category`
--

DROP TABLE IF EXISTS `product_sub_category`;
CREATE TABLE IF NOT EXISTS `product_sub_category` (
  `product_id` int NOT NULL,
  `sub_category_id` int NOT NULL,
  PRIMARY KEY (`product_id`,`sub_category_id`),
  KEY `IDX_3147D5F34584665A` (`product_id`),
  KEY `IDX_3147D5F3F7BFE87C` (`sub_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product_sub_category`
--

INSERT INTO `product_sub_category` (`product_id`, `sub_category_id`) VALUES
(1, 1),
(2, 1),
(12, 1),
(13, 1),
(15, 1),
(16, 1),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(180) NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCE3F79812469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category_id`) VALUES
(1, 'Comprimé', 2),
(2, 'Gummies', 2),
(3, 'Shaker', 2),
(4, 'Pas encore trouver', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`) VALUES
(1, 'testclient1@test.com', '[\"ROLE_ADMIN\", \"ROLE_EDITOR\", \"ROLE_USER\"]', '$2y$13$RDz9jYOGBSykNHcfHiEEJ.d3BFcoZLypF1mi2mwFMM9KiSiAqGu0m', 'Jean', 'VALJEAN'),
(2, 'clientnumero2@hotmail.fr', '[\"ROLE_EDITOR\", \"ROLE_USER\"]', '$2y$13$Pp5Uk8mpKVgrCZxLB2EHwObqfzdfX8Q89JNU92YgsfCiUgYdJVdQO', 'Armi', 'STICE');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `product_sub_category`
--
ALTER TABLE `product_sub_category`
  ADD CONSTRAINT `FK_3147D5F34584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3147D5F3F7BFE87C` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `FK_BCE3F79812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
