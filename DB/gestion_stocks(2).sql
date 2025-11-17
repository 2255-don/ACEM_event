-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 07 oct. 2025 à 12:57
-- Version du serveur : 8.0.43-0ubuntu0.22.04.2
-- Version de PHP : 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stocks`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

use gestion_stocks;

CREATE TABLE `categories` (
  `id` char(36) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL,
  `entreprises_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `libelle`, `entreprises_id`, `created_at`, `updated_at`) VALUES
('0197f951-16a5-73e2-8381-3696e5a8505c', 'CUISINE', '01980afa-91e2-710b-a231-9beb5f532895', '2025-07-11 11:48:50', '2025-09-01 17:09:26'),
('0198329d-0904-7361-be62-920b56b54018', 'VIN', '01980afa-91e2-710b-a231-9beb5f532895', '2025-07-22 14:50:09', '2025-09-01 17:06:41'),
('01990131-f607-72fc-bf2d-8cf5f46546df', 'BIERE', '01980afa-91e2-710b-a231-9beb5f532895', '2025-08-31 17:34:35', '2025-08-31 17:34:35'),
('01990134-5ca2-7114-b433-9d875eb33db9', 'CANETTES - EAU', '01980afa-91e2-710b-a231-9beb5f532895', '2025-08-31 17:37:12', '2025-08-31 17:37:12'),
('0199064b-21cb-709d-8bb2-c29c12355561', 'LOCATION COUR', '01980afa-91e2-710b-a231-9beb5f532895', '2025-09-01 17:20:11', '2025-09-01 17:20:11'),
('0199064c-1024-705c-aeb9-e577dcf9667f', 'CHAMBRES', '01980afa-91e2-710b-a231-9beb5f532895', '2025-09-01 17:21:12', '2025-09-01 17:21:12'),
('0199064c-619c-70ae-9699-3c51419acafe', 'ALCOOLS CONSO', '01980afa-91e2-710b-a231-9beb5f532895', '2025-09-01 17:21:33', '2025-09-01 17:21:33'),
('0199064c-b611-7141-9494-1214d044ff2d', 'ALCOOLS', '01980afa-91e2-710b-a231-9beb5f532895', '2025-09-01 17:21:54', '2025-09-01 17:21:54');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` char(36) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprises_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` char(36) NOT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprises_id` char(36) DEFAULT NULL,
  `demandes_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `statut`, `created_at`, `updated_at`, `entreprises_id`, `demandes_id`) VALUES
('019837a7-7d0d-723a-9f67-43d406e19dd1', 'partiellement_livree', '2025-07-23 14:19:40', '2025-07-30 13:23:09', NULL, NULL),
('019837ea-1236-730e-b3d3-bd0ea0c49559', 'livree', '2025-07-23 15:32:23', '2025-10-06 13:05:46', '01980afa-91e2-710b-a231-9beb5f532895', NULL),
('019902aa-e867-701d-bc33-e0ba713c827f', 'livree', '2025-09-01 00:26:19', '2025-09-01 01:33:08', '01980afa-91e2-710b-a231-9beb5f532895', NULL),
('019911db-d3d3-70cc-a0ae-e422b01148e7', 'livree', '2025-09-03 23:14:03', '2025-10-06 15:32:53', '01980afa-91e2-710b-a231-9beb5f532895', NULL),
('0199bac4-86e9-7140-a60b-a78bce6c04bf', 'livree', '2025-10-06 18:24:25', '2025-10-06 18:24:38', '01980afa-91e2-710b-a231-9beb5f532895', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprises_id` char(36) DEFAULT NULL,
  `users_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id`, `created_at`, `updated_at`, `entreprises_id`, `users_id`) VALUES
('019832ac-7628-708d-bcfe-9881f6163a10', '2025-07-22 15:07:00', '2025-07-22 15:07:00', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('019832ad-0252-71f2-b468-973dab6e3bbb', '2025-07-22 15:07:35', '2025-07-22 15:07:35', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('019832dd-2fb6-708c-812a-461406a0a051', '2025-07-22 16:00:13', '2025-07-22 16:00:13', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987cc9-a165-7165-8eda-ce0a71d8a922', '2025-08-06 00:30:45', '2025-08-06 00:30:45', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987cd5-1199-72cb-9cc7-6592a949d437', '2025-08-06 00:43:15', '2025-08-06 00:43:15', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987cd6-6cc8-70ef-9631-f7ed2f997f3a', '2025-08-06 00:44:44', '2025-08-06 00:44:44', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987cd8-8b89-708a-b08e-f6d600e4d539', '2025-08-06 00:47:03', '2025-08-06 00:47:03', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987cf0-b0f4-73d8-b97f-031ee760061b', '2025-08-06 01:13:25', '2025-08-06 01:13:25', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987cf5-1d5d-7178-b445-720c0f53c774', '2025-08-06 01:18:15', '2025-08-06 01:18:15', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987d02-a163-70ce-b462-73715dd86bfe', '2025-08-06 01:33:01', '2025-08-06 01:33:01', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01987d05-e0b5-72e9-a6ff-2f45bfadf3c1', '2025-08-06 01:36:33', '2025-08-06 01:36:33', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('01990286-24c3-7125-82f9-bd6175c2b3d0', '2025-08-31 23:46:09', '2025-08-31 23:46:09', NULL, '0197d218-e9cd-71f4-bd92-49486c1e6872'),
('019911db-41d6-71bb-82b5-2d681f2e52be', '2025-09-03 23:13:25', '2025-09-03 23:13:25', '01980afa-91e2-710b-a231-9beb5f532895', '01980afa-92c7-71fa-95ad-c18e08bf75ec');

-- --------------------------------------------------------

--
-- Structure de la table `demande_details`
--

CREATE TABLE `demande_details` (
  `id` char(36) NOT NULL,
  `quantite` int DEFAULT NULL,
  `commentaire` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `demandes_id` char(36) NOT NULL,
  `statut` varchar(45) DEFAULT NULL,
  `produits_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demande_details`
--

INSERT INTO `demande_details` (`id`, `quantite`, `commentaire`, `created_at`, `updated_at`, `demandes_id`, `statut`, `produits_id`) VALUES
('019832ac-7634-707b-b7af-c165b8ff1014', 25, 'urgent', '2025-07-22 15:07:00', '2025-07-22 15:44:27', '019832ac-7628-708d-bcfe-9881f6163a10', 'accepter', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('019832ac-7635-7360-b35d-d279ac804ed0', 3, 'tres tres urgent', '2025-07-22 15:07:00', '2025-07-22 15:45:10', '019832ac-7628-708d-bcfe-9881f6163a10', 'valider', '0198329d-c8a2-713e-ba28-07cd93fa55dd'),
('019832ad-0255-7228-b540-66c357a2e86f', 25, 'urgent', '2025-07-22 15:07:35', '2025-07-22 15:45:14', '019832ad-0252-71f2-b468-973dab6e3bbb', 'rejeter', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('019832ad-0256-73e4-8f94-c8385409b5ac', 3, 'tres tres urgent', '2025-07-22 15:07:35', '2025-08-06 00:21:28', '019832ad-0252-71f2-b468-973dab6e3bbb', 'valider', '0198329d-c8a2-713e-ba28-07cd93fa55dd'),
('019832dd-2fb8-7188-b6fd-3adc24ee2ecc', 25, 'tres tres urgent', '2025-07-22 16:00:13', '2025-08-06 00:22:58', '019832dd-2fb6-708c-812a-461406a0a051', 'valider', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('01987cc9-a16a-731a-b583-60582c4f9f2d', 20, 'hdhhhd', '2025-08-06 00:30:45', '2025-08-06 00:30:48', '01987cc9-a165-7165-8eda-ce0a71d8a922', 'valider', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('01987cd5-11a0-713c-8012-fa7302f868ba', 200, NULL, '2025-08-06 00:43:15', '2025-08-06 00:43:17', '01987cd5-1199-72cb-9cc7-6592a949d437', 'valider', '0198329d-c8a2-713e-ba28-07cd93fa55dd'),
('01987cd6-6ccf-71c0-b8d2-4ca3f02df96c', 200, NULL, '2025-08-06 00:44:44', '2025-08-06 00:44:46', '01987cd6-6cc8-70ef-9631-f7ed2f997f3a', 'valider', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('01987cd8-8b90-70b0-9578-60b68b7924df', 20, NULL, '2025-08-06 00:47:03', '2025-08-06 00:47:04', '01987cd8-8b89-708a-b08e-f6d600e4d539', 'valider', '0198329d-c8a2-713e-ba28-07cd93fa55dd'),
('01987cf0-b0f8-7193-8a38-eab6df8ffe37', 200, NULL, '2025-08-06 01:13:25', '2025-08-06 01:13:27', '01987cf0-b0f4-73d8-b97f-031ee760061b', 'valider', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c'),
('01987cf5-1d61-71fb-bdca-1395bae25d8f', 200, NULL, '2025-08-06 01:18:15', '2025-08-06 01:18:17', '01987cf5-1d5d-7178-b445-720c0f53c774', 'valider', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c'),
('01987d02-a169-7122-b5fb-816ac567af6c', 200, NULL, '2025-08-06 01:33:01', '2025-08-06 01:33:03', '01987d02-a163-70ce-b462-73715dd86bfe', 'valider', '0198329d-c8a2-713e-ba28-07cd93fa55dd'),
('01987d05-e0bb-7120-b25d-5ca03909eb06', 200, NULL, '2025-08-06 01:36:33', '2025-08-06 01:36:36', '01987d05-e0b5-72e9-a6ff-2f45bfadf3c1', 'valider', '0198329d-c8a2-713e-ba28-07cd93fa55dd'),
('01990286-24ca-7107-a3d4-6a6106b7fe17', 12, 'urgent', '2025-08-31 23:46:09', '2025-08-31 23:46:12', '01990286-24c3-7125-82f9-bd6175c2b3d0', 'valider', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('019911db-41f4-709f-9852-7259b7414912', 200, 'urgent', '2025-09-03 23:13:26', '2025-09-03 23:13:35', '019911db-41d6-71bb-82b5-2d681f2e52be', 'valider', '0199065b-0c77-712e-be2f-4a0d4a2df12d');

-- --------------------------------------------------------

--
-- Structure de la table `detail_commandes`
--

CREATE TABLE `detail_commandes` (
  `id` char(36) NOT NULL,
  `quantite` int DEFAULT NULL,
  `prix_unitaire` decimal(10,0) DEFAULT NULL,
  `frais_reduc` varchar(45) DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  `statut_livraison` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commandes_id` char(36) NOT NULL,
  `fournisseurs_id` char(36) NOT NULL,
  `produits_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `detail_commandes`
--

INSERT INTO `detail_commandes` (`id`, `quantite`, `prix_unitaire`, `frais_reduc`, `prix`, `statut_livraison`, `created_at`, `updated_at`, `commandes_id`, `fournisseurs_id`, `produits_id`) VALUES
('01985bcc-2b65-7386-bc5a-8b52cadd3383', 400, '500', '0', '200000', 'livrée', '2025-07-30 14:46:03', '2025-07-30 14:46:03', '019837a7-7d0d-723a-9f67-43d406e19dd1', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('01985bcc-2b6d-731f-b15a-e73eb02b4027', 10, '600', '0', '6000', 'en_attente', '2025-07-30 14:46:03', '2025-07-30 14:46:03', '019837a7-7d0d-723a-9f67-43d406e19dd1', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('01985bcc-2b6e-7336-8b65-c63ad916d74c', 25, '6550', '0', '163750', 'en_attente', '2025-07-30 14:46:03', '2025-07-30 14:46:03', '019837a7-7d0d-723a-9f67-43d406e19dd1', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('019905a9-25b4-722e-bf31-5f7e10ba979d', 500, '1000', '10000', '490000', 'livrée', '2025-09-01 14:23:15', '2025-09-01 14:23:15', '019902aa-e867-701d-bc33-e0ba713c827f', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('0199b9a0-cbf8-70eb-9b2b-11ff5e06e1d9', 280, '200', '800', '55200', 'livrée', '2025-10-06 13:05:47', '2025-10-06 13:05:47', '019837ea-1236-730e-b3d3-bd0ea0c49559', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('0199ba27-7c41-71ca-887b-cad4143a8255', 200, '5000', '800', '999200', 'livrée', '2025-10-06 15:32:53', '2025-10-06 15:32:53', '019911db-d3d3-70cc-a0ae-e422b01148e7', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('0199bac4-ba09-7325-a825-5b8b5c09fd04', 50, '200', '100', '9900', 'livrée', '2025-10-06 18:24:38', '2025-10-06 18:24:38', '0199bac4-86e9-7140-a60b-a78bce6c04bf', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98'),
('0199bac4-ba0d-70db-b115-75bb274881ea', 56, '500', '100', '27900', 'livrée', '2025-10-06 18:24:38', '2025-10-06 18:24:38', '0199bac4-86e9-7140-a60b-a78bce6c04bf', '019832fa-c755-7015-8bfa-0e9104e48a0a', '0197f9b4-eda0-736f-8166-647b43f5bd98');

-- --------------------------------------------------------

--
-- Structure de la table `entrees`
--

CREATE TABLE `entrees` (
  `id` char(36) NOT NULL,
  `quantite` int DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `produits_id` char(36) NOT NULL,
  `entreprises_id` char(36) DEFAULT NULL,
  `detail_commandes_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entrees`
--

INSERT INTO `entrees` (`id`, `quantite`, `prix`, `created_at`, `updated_at`, `produits_id`, `entreprises_id`, `detail_commandes_id`) VALUES
('0197fa2d-4e7a-715c-bd6f-91eb1d6ca035', 200, '569', '2025-07-11 15:49:22', '2025-08-05 22:17:53', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895', NULL),
('01987c70-e940-70d4-a175-4b9f22c17176', 20, '200', '2025-08-05 22:53:51', '2025-08-05 22:54:33', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', '01980afa-91e2-710b-a231-9beb5f532895', NULL),
('019902e8-17ad-7173-9ed6-88af404825df', 500, '490000', '2025-08-30 01:33:08', '2025-09-01 01:33:08', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895', NULL),
('019905a9-25bf-72ab-9141-428b603c993b', 500, '490000', '2025-08-30 14:23:15', '2025-09-01 14:23:15', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895', '019905a9-25b4-722e-bf31-5f7e10ba979d'),
('019905ab-f355-7389-b16c-a129db13d442', 50, '5000000', '2025-09-01 14:26:19', '2025-09-01 14:52:00', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', '01980afa-91e2-710b-a231-9beb5f532895', NULL),
('0199b9a0-cbfb-723d-afb6-e414ab854af8', 280, '55200', '2025-10-06 13:05:47', '2025-10-06 13:05:47', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895', '0199b9a0-cbf8-70eb-9b2b-11ff5e06e1d9'),
('0199ba27-7c42-735e-8e76-822e86ea746c', 200, '999200', '2025-10-06 15:32:53', '2025-10-06 15:32:53', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895', '0199ba27-7c41-71ca-887b-cad4143a8255'),
('0199bac4-ba0a-7087-8421-6732a3d90d9d', 50, '9900', '2025-10-06 18:24:38', '2025-10-06 18:24:38', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895', '0199bac4-ba09-7325-a825-5b8b5c09fd04'),
('0199bac4-ba0e-739b-8d5a-e80fdbad8cc4', 56, '27900', '2025-10-06 18:24:38', '2025-10-06 18:24:38', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895', '0199bac4-ba0d-70db-b115-75bb274881ea');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` char(36) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `email`, `telephone`, `adresse`, `logo`, `created_at`, `updated_at`) VALUES
('01980afa-91e2-710b-a231-9beb5f532895', 'Jouan Enterprise', 'Traorejouanelle22@gmail.com', '66759131', 'azzerr', '1752681860_6877cd84a68d1.png', '2025-07-14 22:07:30', '2025-07-24 13:17:26');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` char(36) NOT NULL,
  `numero_facture` int DEFAULT NULL,
  `montant_total` decimal(10,0) DEFAULT NULL,
  `statut` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ventes_id` char(36) NOT NULL,
  `entreprises_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` char(36) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprises_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `email`, `telephone`, `adresse`, `created_at`, `updated_at`, `entreprises_id`) VALUES
('019832fa-c755-7015-8bfa-0e9104e48a0a', 'Laravel', 'traore@gmail.com', '77887788', 'Baco-djicoron', '2025-07-22 16:32:32', '2025-07-22 16:47:33', '01980afa-91e2-710b-a231-9beb5f532895'),
('019832fb-973f-70f1-a8f3-266ed3a1ac47', 'Don', 'undefined', '77887788', 'Baco-djicoron', '2025-07-22 16:33:25', '2025-07-22 16:33:25', '01980afa-91e2-710b-a231-9beb5f532895'),
('01983301-682a-72e3-a312-f354efb3b8a3', 'Jouanelle', 'undefined', '00112244', 'Baco-djicoron', '2025-07-22 16:39:46', '2025-07-22 16:39:46', '01980afa-91e2-710b-a231-9beb5f532895'),
('01983303-ab3f-70b4-9746-366d8b066811', 'sbn', 'undefined', '77887788', 'Baco-djicoron', '2025-07-22 16:42:15', '2025-07-22 16:42:15', '01980afa-91e2-710b-a231-9beb5f532895');

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

CREATE TABLE `historiques` (
  `id` char(36) NOT NULL,
  `type` enum('entree','sortie') DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `commentaire` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `produits_id` char(36) NOT NULL,
  `entreprises_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `historiques`
--

INSERT INTO `historiques` (`id`, `type`, `quantite`, `commentaire`, `created_at`, `updated_at`, `produits_id`, `entreprises_id`) VALUES
('0198722e-0e36-7156-8134-29597d8e83df', NULL, NULL, 'une entree a ete effectuer sur cet produit.', '2025-08-03 23:04:37', '2025-08-03 23:04:37', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('0198722e-924e-7313-901a-62e52000ac42', NULL, NULL, 'une entree a ete effectuer sur cet produit.', '2025-08-03 23:05:11', '2025-08-03 23:05:11', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987230-0b7d-7258-ade1-abb556f2d760', NULL, NULL, 'une entree a ete effectuer sur cet produit.', '2025-08-03 23:06:48', '2025-08-03 23:06:48', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987569-bfa4-70fd-ab6b-3df70ea5d737', NULL, NULL, 'une sortie a ete modifiée sur cet produit.', '2025-08-04 14:08:41', '2025-08-04 14:08:41', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('0198756b-9cfd-709b-8427-103e9cb0153d', NULL, NULL, 'une sortie a ete modifiée sur cet produit.', '2025-08-04 14:10:43', '2025-08-04 14:10:43', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987c4e-4f00-714d-bf6e-ce0942de5dbf', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:16:03', '2025-08-05 22:16:03', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987c4f-1f91-7144-bc70-b4eea0cd7c52', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:16:56', '2025-08-05 22:16:56', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987c4f-fe27-7194-b4ae-5c0bfbd98a7d', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:17:53', '2025-08-05 22:17:53', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987c50-96d6-7181-9831-8da82ed16d14', NULL, NULL, 'une entrée a été effectuer sur cet produit.', '2025-08-05 22:18:33', '2025-08-05 22:18:33', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c52-3f67-723a-be6c-c1b4a81580ce', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:20:21', '2025-08-05 22:20:21', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('01987c55-1d6c-7303-ae7f-ca6909a00aef', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:23:29', '2025-08-05 22:23:29', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('01987c59-fece-72fe-9f72-fa04fc8e843b', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:28:49', '2025-08-05 22:28:49', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c5f-3038-72fe-ac08-58c2ae10c6ed', NULL, NULL, 'une entrée a été effectuer sur cet produit.', '2025-08-05 22:34:29', '2025-08-05 22:34:29', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c60-48d2-7320-83ba-2ca4b9185ba2', NULL, NULL, 'une entrée a été effectuer sur cet produit.', '2025-08-05 22:35:41', '2025-08-05 22:35:41', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('01987c61-4147-70a9-8355-2a09a8fca32f', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:36:45', '2025-08-05 22:36:45', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c61-9d50-73a7-9dee-a04685dfd9dd', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:37:08', '2025-08-05 22:37:08', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('01987c62-deb2-7260-881e-e66ca439546d', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:38:31', '2025-08-05 22:38:31', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('01987c64-5217-7328-9a20-2e37ad66c2c3', NULL, NULL, 'une entrée a été effectuer sur cet produit.', '2025-08-05 22:40:06', '2025-08-05 22:40:06', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c64-ad59-724f-a7fe-a0352bd25710', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:40:29', '2025-08-05 22:40:29', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c65-0084-71c4-8101-9b54f064bac3', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:40:50', '2025-08-05 22:40:50', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c65-980d-724a-b5e2-744a72c69bb8', NULL, NULL, 'une entrée a été effectuer sur cet produit.', '2025-08-05 22:41:29', '2025-08-05 22:41:29', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c65-e7c4-713e-b81b-25fe091ad970', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:41:50', '2025-08-05 22:41:50', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('01987c70-e942-72dd-a059-050c5022662c', NULL, NULL, 'une entrée a été effectuer sur cet produit.', '2025-08-05 22:53:51', '2025-08-05 22:53:51', '0198329d-c8a2-713e-ba28-07cd93fa55dd', NULL),
('01987c71-8f53-71d6-bf17-4a15c8604a16', NULL, NULL, 'une entrée a été modifiée sur cet produit.', '2025-08-05 22:54:33', '2025-08-05 22:54:33', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('01987c76-de18-70ee-8c92-2687c5e24350', NULL, NULL, 'une sortie a ete modifiée sur cet produit.', '2025-08-05 23:00:21', '2025-08-05 23:00:21', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987d13-7a70-72c8-970a-3ceff4c991ab', NULL, NULL, 'une sortie a ete effectuer sur cet produit.', '2025-08-06 01:51:25', '2025-08-06 01:51:25', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987d15-7561-70e6-b571-3d41934dab73', NULL, NULL, 'une sortie a ete effectuer sur cet produit.', '2025-08-06 01:53:35', '2025-08-06 01:53:35', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987d16-a4cf-73a6-834e-c356b1366ec5', NULL, NULL, 'une sortie a ete effectuer sur cet produit.', '2025-08-06 01:54:52', '2025-08-06 01:54:52', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01987d1b-9c29-73c7-b99a-46efb346f5d3', NULL, NULL, 'une sortie a ete effectuer sur cet produit.', '2025-08-06 02:00:18', '2025-08-06 02:00:18', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('019902e8-17b9-728f-a646-eb91cfc13258', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-09-01 01:33:08', '2025-09-01 01:33:08', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('019902ea-e597-72f7-bbc5-30e6719be878', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-09-01 01:36:12', '2025-09-01 01:36:12', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01990301-2173-70a9-b80f-b9a00134f454', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-09-01 02:00:29', '2025-09-01 02:00:29', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('01990311-b6ba-7298-b56c-7f994df31201', 'sortie', 500, 'entrée annulée suite à modification de commande.', '2025-09-01 02:18:36', '2025-09-01 02:18:36', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('019905a9-25c9-73aa-8a9c-e15e38aff3dd', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-09-01 14:23:15', '2025-09-01 14:23:15', '0197f9b4-eda0-736f-8166-647b43f5bd98', NULL),
('019905ab-f35d-71a7-8fff-8b8b0efe3447', 'sortie', NULL, 'une entrée a été effectuer sur cet produit.', '2025-09-01 14:26:19', '2025-09-01 14:26:19', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('019905bd-5044-7068-8f2f-58da8b080114', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-09-01 14:45:16', '2025-09-01 14:45:16', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('019905c1-5d50-7362-97ec-1193ccbc4e10', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-09-01 14:49:42', '2025-09-01 14:49:42', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('019905c3-7749-70e3-b4ca-5fc8601d5876', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-09-01 14:52:00', '2025-09-01 14:52:00', '01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', NULL),
('0199b9a0-cc0e-7114-9b4b-745585d89822', 'sortie', NULL, 'une entrée a été modifiée sur cet produit.', '2025-10-06 13:05:47', '2025-10-06 13:05:47', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba27-7c45-720c-82dc-743b7c70f21e', 'entree', NULL, 'une entrée a été modifiée sur cet produit.', '2025-10-06 15:32:53', '2025-10-06 15:32:53', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba2f-cb48-73c4-83c3-8d6183b9b48a', 'sortie', NULL, 'une sortie a ete effectuer sur cet produit.', '2025-10-06 15:41:58', '2025-10-06 15:41:58', '0198329d-c8a2-713e-ba28-07cd93fa55dd', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba3c-f270-7182-83cf-56865d226ce7', 'sortie', NULL, 'une sortie a ete effectuer sur cet produit.', '2025-10-06 15:56:20', '2025-10-06 15:56:20', '0198329d-c8a2-713e-ba28-07cd93fa55dd', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba3d-18cd-722a-9f4a-988ae544bd2e', 'sortie', NULL, 'une sortie a ete effectuer sur cet produit.', '2025-10-06 15:56:30', '2025-10-06 15:56:30', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba55-ed32-7021-99ec-6c1b50e5e0bd', 'sortie', NULL, 'une sortie a ete effectuer sur cet produit.', '2025-10-06 16:23:37', '2025-10-06 16:23:37', '0198329d-c8a2-713e-ba28-07cd93fa55dd', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba5d-272c-7182-9c1d-0ec016271045', 'sortie', NULL, 'une sortie a ete effectuer sur cet produit.', '2025-10-06 16:31:31', '2025-10-06 16:31:31', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba71-36cc-7044-85d4-dc1b120dcabd', 'sortie', 2158, 'une sortie a ete modifiée sur cet produit.', '2025-10-06 16:53:25', '2025-10-06 16:53:25', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199baac-8242-730b-a2f3-77fd8d59e474', 'sortie', 17, 'une sortie a ete modifiée sur cet produit.', '2025-10-06 17:58:11', '2025-10-06 17:58:11', '0198329d-c8a2-713e-ba28-07cd93fa55dd', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199bac4-ba0d-70db-b115-75bb26ec5146', 'entree', NULL, 'une entrée a été modifiée sur cet produit.', '2025-10-06 18:24:38', '2025-10-06 18:24:38', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199bac4-ba10-7331-80a7-f4ec8e4bb9de', 'entree', NULL, 'une entrée a été modifiée sur cet produit.', '2025-10-06 18:24:38', '2025-10-06 18:24:38', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895');

-- --------------------------------------------------------

--
-- Structure de la table `journal_activites`
--

CREATE TABLE `journal_activites` (
  `id` char(36) NOT NULL,
  `type_action` enum('creation','modification','supression','autre') DEFAULT NULL,
  `module` varchar(45) DEFAULT NULL,
  `element_id` char(36) DEFAULT NULL,
  `commentaire` varchar(45) DEFAULT NULL,
  `adresse_id` varchar(45) DEFAULT NULL,
  `user_agent` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprises_id` char(36) NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `licences`
--

CREATE TABLE `licences` (
  `id` char(36) NOT NULL,
  `cle_licance` char(36) DEFAULT NULL,
  `date_debut` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `date_fin` timestamp NULL DEFAULT NULL,
  `etat` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprises_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `licences`
--

INSERT INTO `licences` (`id`, `cle_licance`, `date_debut`, `created_at`, `date_fin`, `etat`, `updated_at`, `entreprises_id`) VALUES
('01980b20-241c-70ef-98fe-2237f5fa36a7', '5b81f9e4-18bd-4b1a-be1f-5603e14e82b8', '2025-07-14 22:48:32', '2025-07-14 22:48:32', '2025-10-14 22:48:32', 'active', '2025-08-31 16:12:01', '01980afa-91e2-710b-a231-9beb5f532895');

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

CREATE TABLE `livraisons` (
  `id` char(36) NOT NULL,
  `statut` varchar(45) DEFAULT NULL,
  `commentaire` varchar(45) DEFAULT NULL,
  `date_arrive` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commandes_id` char(36) NOT NULL,
  `entreprises_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` char(36) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL,
  `image` varchar(205) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `prix_unitaire` decimal(10,0) DEFAULT NULL,
  `prix_total` decimal(10,0) DEFAULT NULL,
  `seuil_min` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categories_id` char(36) NOT NULL,
  `entreprises_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `libelle`, `image`, `stock`, `prix_unitaire`, `prix_total`, `seuil_min`, `created_at`, `updated_at`, `categories_id`, `entreprises_id`) VALUES
('0197f9b4-eda0-736f-8166-647b43f5bd98', 'CASTEL', '1752674451_6877b09316ada.png', 2264, '1500', '3396000', 30, '2025-07-11 13:37:53', '2025-10-06 18:24:38', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('0198329d-c8a2-713e-ba28-07cd93fa55dd', 'DESPERADOS', '1753195858_687fa5520deb0.png', 17, '2000', '34000', 30, '2025-07-22 14:50:58', '2025-10-06 17:58:11', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('01987c51-f4f5-72c7-88d5-9f69d7f4ad5c', 'FLAG', '1754432402_689283929f5c7.png', 70, '1500', '7000', 30, '2025-08-05 22:20:02', '2025-09-01 17:26:13', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('01987c8f-253a-7304-a2bc-0329f02332ee', 'BF', '1759839456_68e504e019e02.png', NULL, '1000', NULL, 24, '2025-08-05 23:26:52', '2025-10-07 12:17:36', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('01987c90-3589-71b9-b903-11f98aa4d9a7', 'GUINNESS', NULL, NULL, '1500', NULL, 24, '2025-08-05 23:28:02', '2025-09-01 17:25:30', '0197f951-16a5-73e2-8381-3696e5a8505c', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990656-d342-72e7-aa4d-ea9b988fb686', 'SUCRERIE', NULL, NULL, '1000', NULL, 60, '2025-09-01 17:32:57', '2025-09-01 17:32:57', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990658-b33b-7235-952a-d69fa59b0176', 'HEINEKEN', NULL, NULL, '1500', NULL, 30, '2025-09-01 17:35:00', '2025-09-01 17:35:00', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990659-bf31-73f8-9157-8065fb614ac0', 'BLACK POWER', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:36:09', '2025-09-01 17:36:09', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065a-8935-71e2-86a0-1e1ac6d624af', 'DOPEL', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:37:00', '2025-09-01 17:37:00', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065b-0c77-712e-be2f-4a0d4a2df12d', 'DASSA', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:37:34', '2025-09-01 17:37:34', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065b-a2f2-72e5-a105-7dd530482a3b', 'BAV. 8/6', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:38:12', '2025-09-01 17:38:12', '01990131-f607-72fc-bf2d-8cf5f46546df', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065c-2669-72d5-883d-55891efcff27', 'ROX', NULL, NULL, '1500', NULL, 30, '2025-09-01 17:38:46', '2025-09-01 17:38:46', '01990134-5ca2-7114-b433-9d875eb33db9', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065c-b678-73b4-b959-830144bfc89a', 'DOUBLE 7', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:39:23', '2025-09-01 17:39:23', '01990134-5ca2-7114-b433-9d875eb33db9', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065d-2eab-73d5-b6b7-3c42771b0edb', 'VODY', NULL, NULL, '30', NULL, 1500, '2025-09-01 17:39:54', '2025-09-01 17:39:54', '01990134-5ca2-7114-b433-9d875eb33db9', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065d-9f1c-72e4-b45b-3d627d381f10', 'COCA ZERO', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:40:22', '2025-09-01 17:40:22', '01990134-5ca2-7114-b433-9d875eb33db9', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065e-032e-70bc-a8cc-175f03e23bf7', 'JUS IRA', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:40:48', '2025-09-01 17:40:48', '01990134-5ca2-7114-b433-9d875eb33db9', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199065e-736f-73df-be8b-be07a6ad86fe', 'IVORIO', NULL, NULL, '1000', NULL, 30, '2025-09-01 17:41:17', '2025-09-01 17:41:17', '01990134-5ca2-7114-b433-9d875eb33db9', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990667-8f1c-717e-9c96-ddfd12b85aa8', 'EAU MINERALE 0,5', NULL, NULL, '500', NULL, 30, '2025-09-01 17:51:14', '2025-09-01 17:51:14', '01990134-5ca2-7114-b433-9d875eb33db9', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990668-0fb4-73f7-96cb-fb6996db3092', 'TALENTUS ROUGE', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:51:47', '2025-09-01 17:51:47', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990668-c9da-73ee-b056-65f126c9e69c', 'TALENTUS BLANC', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:52:34', '2025-09-01 17:52:34', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990669-2e98-7195-bb30-30b396770bc3', 'ADEGA ROUGE', NULL, NULL, '10000', NULL, 10, '2025-09-01 17:53:00', '2025-09-01 17:53:00', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('01990669-a303-735c-80bb-98433e10c912', 'ADEGA ROSE', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:53:30', '2025-09-01 17:53:30', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066a-0d51-72d7-84ae-7de4b22c45cf', 'SCANSIO', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:53:57', '2025-09-01 17:53:57', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066a-7071-721d-97e8-e4a0ad5f93f5', 'Dornfelder Bleu', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:54:22', '2025-09-01 17:54:22', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066a-caf4-70eb-9e6e-03806948fcc9', 'Dornfelder Rouge', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:54:46', '2025-09-01 17:54:46', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066b-2f2c-7239-abf1-1153fffdd9f3', 'Muscador', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:55:11', '2025-09-01 17:55:11', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066b-8f4c-739d-a3f8-2e7510d7bb62', 'JP chenet', NULL, NULL, '12000', NULL, 5, '2025-09-01 17:55:36', '2025-09-01 17:56:21', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066b-f7ce-7244-9f07-95bbe2cbbb02', 'Café Nespresso', NULL, NULL, '10000', NULL, 5, '2025-09-01 17:56:03', '2025-09-01 17:56:03', '0198329d-0904-7361-be62-920b56b54018', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066c-e9d1-710d-b2c3-bc87c791e831', 'BLACK LABEL', NULL, NULL, '33000', NULL, 5, '2025-09-01 17:57:05', '2025-09-01 17:57:05', '0199064c-b611-7141-9494-1214d044ff2d', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066d-80ac-7120-93ad-ce9a60e8b2eb', 'CHIVAS', NULL, NULL, '330000', NULL, 5, '2025-09-01 17:57:43', '2025-09-01 17:58:05', '0199064c-b611-7141-9494-1214d044ff2d', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199066e-30d4-737b-938d-b54055c3409c', 'JACK DANIEL', NULL, NULL, '23000', NULL, 5, '2025-09-01 17:58:28', '2025-09-01 17:58:28', '0199064c-b611-7141-9494-1214d044ff2d', '01980afa-91e2-710b-a231-9beb5f532895');

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id` char(36) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
('0197c138-76b8-7340-b82a-b7b4cbe0922c', 'Super-admin', '2025-06-30 14:23:12', '2025-06-30 14:23:12'),
('0197c139-8282-7286-8906-d5e6786f3025', 'Admin', '2025-06-30 14:24:21', '2025-06-30 14:24:21'),
('0197c139-de79-719d-ac68-813aeca94466', 'Employer', '2025-06-30 14:24:44', '2025-07-30 11:38:29');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`, `created_at`, `updated_at`) VALUES
('0197c156-cb17-71df-a1d2-e13f2aa7d4d2', 'Gestion utilisateur', '2025-06-30 14:56:20', '2025-07-30 11:38:08');

-- --------------------------------------------------------

--
-- Structure de la table `role_details`
--

CREATE TABLE `role_details` (
  `id` char(36) NOT NULL,
  `users_id` char(36) NOT NULL,
  `roles_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role_details`
--

INSERT INTO `role_details` (`id`, `users_id`, `roles_id`, `created_at`, `updated_at`) VALUES
('0197d218-e9e3-71b9-87dd-451282b6b4d4', '0197d218-e9cd-71f4-bd92-49486c1e6872', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-07-03 21:02:17', '2025-07-03 21:02:17'),
('01980afa-92da-728d-b408-163a2d4ecd82', '01980afa-92c7-71fa-95ad-c18e08bf75ec', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-07-14 22:07:30', '2025-07-14 22:07:30'),
('01980afd-9bb6-702f-89cb-08abe4c522f0', '01980afd-9bb3-709b-89a8-f9cb8aea4fdb', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-07-14 22:10:49', '2025-07-14 22:10:49'),
('01980b01-b9d6-72bd-a3b4-1e5f9f624e4a', '01980b01-b9d4-7278-8f7a-1dea5bc14872', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-07-14 22:15:19', '2025-07-14 22:15:19'),
('01980b03-029a-7063-b17c-c12b46d2956f', '01980b03-0298-7253-8056-979a4d43d823', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-07-14 22:16:43', '2025-07-14 22:16:43'),
('019813d6-1566-7207-87db-3530f69f43ca', '019813d6-1511-7091-8164-a1455329b0bf', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-07-16 15:24:14', '2025-07-16 15:24:14'),
('019813dd-44ae-7320-ba0a-fd29ba5c279d', '019813dd-44a6-720b-9a76-81015f62bade', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-07-16 15:32:04', '2025-07-16 15:32:04'),
('01987d3f-4f35-701c-8ad1-88ebf20da63f', '01987d3f-4f2f-7194-94c2-9bacc0cd7efc', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', '2025-08-06 02:39:17', '2025-08-06 02:39:17'),
('df354ge44gg4etg-1t64-h', 'df354ge44gg4etg-1t64-h', '0197c156-cb17-71df-a1d2-e13f2aa7d4d2', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sorties`
--

CREATE TABLE `sorties` (
  `id` char(36) NOT NULL,
  `quantite` int DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `produits_id` char(36) NOT NULL,
  `entreprises_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sorties`
--

INSERT INTO `sorties` (`id`, `quantite`, `prix`, `created_at`, `updated_at`, `produits_id`, `entreprises_id`) VALUES
('0197fa30-f452-7101-b367-e7c38f0e6a8d', 5, '10000', '2025-07-11 15:53:21', '2025-10-06 17:58:11', '0198329d-c8a2-713e-ba28-07cd93fa55dd', '01980afa-91e2-710b-a231-9beb5f532895'),
('01987d16-a4c9-7270-b6ac-8ff0af959a68', 20, '30000', '2025-08-06 01:54:52', '2025-10-06 16:53:25', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba3c-f26d-72c4-8452-d42efbfa0b78', 2, '4000', '2025-10-06 15:56:20', '2025-10-06 15:56:20', '0198329d-c8a2-713e-ba28-07cd93fa55dd', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba3d-18c9-7220-a229-b7e20bc4d3e7', 1, '1500', '2025-10-06 15:56:30', '2025-10-06 15:56:30', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba55-ed2f-71a4-a99a-24a2390697da', 1, '2000', '2025-10-06 16:23:37', '2025-10-06 16:23:37', '0198329d-c8a2-713e-ba28-07cd93fa55dd', '01980afa-91e2-710b-a231-9beb5f532895'),
('0199ba5d-2727-70ac-83d5-9c206aa8bcbf', 1, '1500', '2025-10-06 16:31:31', '2025-10-06 16:31:31', '0197f9b4-eda0-736f-8166-647b43f5bd98', '01980afa-91e2-710b-a231-9beb5f532895');

-- --------------------------------------------------------

--
-- Structure de la table `tentatives_acces`
--

CREATE TABLE `tentatives_acces` (
  `id` char(36) NOT NULL,
  `adresse_id` varchar(45) DEFAULT NULL,
  `user_agent` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprises_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remenber_token` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profils_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `entreprises_id` char(36) DEFAULT NULL,
  `password_changed` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `remenber_token`, `created_at`, `updated_at`, `profils_id`, `entreprises_id`, `password_changed`) VALUES
('0197d218-e9cd-71f4-bd92-49486c1e6872', 'Jouanelle', 'Don Manuel', 'Traorevetio22@gmail.com', '$2y$12$fKhRPAhO08zsW3FRMAR22OH87DoH4foNL0NjGhwrUWP.EyacMaptW', NULL, '2025-07-03 21:02:17', '2025-07-10 12:05:35', '0197c138-76b8-7340-b82a-b7b4cbe0922c', NULL, 1),
('01980afa-92c7-71fa-95ad-c18e08bf75ec', 'Jouan Enterprise', NULL, 'Traorejouanelle22@gmail.com', '$2y$12$Ta55bQrstcIdkHAZ6NZxjumEYSFw5zblpKAPZhMDNnd2/YLuTH.EW', NULL, '2025-07-14 22:07:30', '2025-10-07 12:14:28', '0197c139-8282-7286-8906-d5e6786f3025', '01980afa-91e2-710b-a231-9beb5f532895', 1),
('01987d3f-4f2f-7194-94c2-9bacc0cd7efc', 'test', 'test', 'tro@gmail.com', '$2y$12$RxWQ149RD//eTmdB7MTtuul7qhU8QFVNs4Nd.L6VuTHbKUSagJcwC', NULL, '2025-08-06 02:39:17', '2025-08-06 02:49:47', '0197c139-de79-719d-ac68-813aeca94466', '01980afa-91e2-710b-a231-9beb5f532895', 1),
('df354ge44gg4etg-1t64-h', 'donn', 'Manuel', 'traore@gmail.com', '$2y$12$fKhRPAhO08zsW3FRMAR22OH87DoH4foNL0NjGhwrUWP.EyacMaptW', NULL, NULL, '2025-08-06 02:36:05', '0197c139-de79-719d-ac68-813aeca94466', '01980afa-91e2-710b-a231-9beb5f532895', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` char(36) NOT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `mode_paiment` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `clients_id` char(36) NOT NULL,
  `entreprises_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vente_details`
--

CREATE TABLE `vente_details` (
  `id` char(36) NOT NULL,
  `quantite` int DEFAULT NULL,
  `prix_unitaire` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `produits_id` bigint UNSIGNED NOT NULL,
  `ventes_id` char(36) NOT NULL,
  `produits_id1` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categories_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clients_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commandes_entreprises1_idx` (`entreprises_id`),
  ADD KEY `fk_commandes_demandes1_idx` (`demandes_id`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_demandes_entreprises1_idx` (`entreprises_id`),
  ADD KEY `fk_demandes_users1_idx` (`users_id`);

--
-- Index pour la table `demande_details`
--
ALTER TABLE `demande_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_demande_details_demandes1_idx` (`demandes_id`),
  ADD KEY `fk_demande_details_produits1_idx` (`produits_id`);

--
-- Index pour la table `detail_commandes`
--
ALTER TABLE `detail_commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_details_commandes_commandes1_idx` (`commandes_id`),
  ADD KEY `fk_details_commandes_fournisseurs1_idx` (`fournisseurs_id`),
  ADD KEY `fk_detail_commandes_produits1_idx` (`produits_id`);

--
-- Index pour la table `entrees`
--
ALTER TABLE `entrees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entrees_produits1_idx` (`produits_id`),
  ADD KEY `fk_entrees_entreprises1_idx` (`entreprises_id`),
  ADD KEY `fk_entrees_detail_commandes1_idx` (`detail_commandes_id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facture_ventes1_idx` (`ventes_id`),
  ADD KEY `fk_facture_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fournisseurs_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_historiques_produits1_idx` (`produits_id`),
  ADD KEY `fk_historiques_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `journal_activites`
--
ALTER TABLE `journal_activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_journal_activites_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `licences`
--
ALTER TABLE `licences`
  ADD PRIMARY KEY (`id`,`created_at`),
  ADD KEY `fk_licences_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_livraisons_commandes1_idx` (`commandes_id`),
  ADD KEY `fk_livraisons_entreprises1_idx` (`entreprises_id`);

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
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produits_categories1_idx` (`categories_id`),
  ADD KEY `fk_produits_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_details`
--
ALTER TABLE `role_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_details_users1_idx` (`users_id`),
  ADD KEY `fk_role_details_roles1_idx` (`roles_id`);

--
-- Index pour la table `sorties`
--
ALTER TABLE `sorties`
  ADD KEY `fk_sorties_produits1_idx` (`produits_id`),
  ADD KEY `fk_sorties_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `tentatives_acces`
--
ALTER TABLE `tentatives_acces`
  ADD PRIMARY KEY (`id`,`entreprises_id`),
  ADD KEY `fk_tentatives_acces_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_profils1_idx` (`profils_id`),
  ADD KEY `fk_users_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ventes_clients1_idx` (`clients_id`),
  ADD KEY `fk_ventes_entreprises1_idx` (`entreprises_id`);

--
-- Index pour la table `vente_details`
--
ALTER TABLE `vente_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vente_details_ventes1_idx` (`ventes_id`),
  ADD KEY `fk_vente_details_produits1_idx` (`produits_id1`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_clients_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_commandes_demandes1` FOREIGN KEY (`demandes_id`) REFERENCES `demandes` (`id`),
  ADD CONSTRAINT `fk_commandes_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `fk_demandes_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `demande_details`
--
ALTER TABLE `demande_details`
  ADD CONSTRAINT `fk_demande_details_demandes1` FOREIGN KEY (`demandes_id`) REFERENCES `demandes` (`id`),
  ADD CONSTRAINT `fk_demande_details_produits1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `detail_commandes`
--
ALTER TABLE `detail_commandes`
  ADD CONSTRAINT `fk_detail_commandes_produits1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `fk_details_commandes_commandes1` FOREIGN KEY (`commandes_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `fk_details_commandes_fournisseurs1` FOREIGN KEY (`fournisseurs_id`) REFERENCES `fournisseurs` (`id`);

--
-- Contraintes pour la table `entrees`
--
ALTER TABLE `entrees`
  ADD CONSTRAINT `fk_entrees_detail_commandes1` FOREIGN KEY (`detail_commandes_id`) REFERENCES `detail_commandes` (`id`),
  ADD CONSTRAINT `fk_entrees_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `fk_entrees_produits1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_facture_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `fk_facture_ventes1` FOREIGN KEY (`ventes_id`) REFERENCES `ventes` (`id`);

--
-- Contraintes pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD CONSTRAINT `fk_fournisseurs_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD CONSTRAINT `fk_historiques_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `fk_historiques_produits1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `journal_activites`
--
ALTER TABLE `journal_activites`
  ADD CONSTRAINT `fk_journal_activites_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `licences`
--
ALTER TABLE `licences`
  ADD CONSTRAINT `fk_licences_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `livraisons`
--
ALTER TABLE `livraisons`
  ADD CONSTRAINT `fk_livraisons_commandes1` FOREIGN KEY (`commandes_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `fk_livraisons_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_produits_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_produits_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `role_details`
--
ALTER TABLE `role_details`
  ADD CONSTRAINT `fk_role_details_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_role_details_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `sorties`
--
ALTER TABLE `sorties`
  ADD CONSTRAINT `fk_sorties_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `fk_sorties_produits1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `tentatives_acces`
--
ALTER TABLE `tentatives_acces`
  ADD CONSTRAINT `fk_tentatives_acces_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `fk_users_profils1` FOREIGN KEY (`profils_id`) REFERENCES `profils` (`id`);

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `fk_ventes_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `fk_ventes_entreprises1` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `vente_details`
--
ALTER TABLE `vente_details`
  ADD CONSTRAINT `fk_vente_details_produits1` FOREIGN KEY (`produits_id1`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `fk_vente_details_ventes1` FOREIGN KEY (`ventes_id`) REFERENCES `ventes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
