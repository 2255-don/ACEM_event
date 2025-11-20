-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 20 nov. 2025 à 09:49
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
-- Base de données : `acem_event`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--
USE 'acem_event';

CREATE TABLE `abonnements` (
  `id` char(36) NOT NULL,
  `start_date` date DEFAULT NULL,
  `montant_par_semaine` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `abonnements`
--

INSERT INTO `abonnements` (`id`, `start_date`, `montant_par_semaine`, `created_at`, `updated_at`, `users_id`) VALUES
('019a923f-8666-71b1-ae41-21b50904ca14', '2025-10-26', '500', '2025-11-17 14:37:08', '2025-11-17 14:37:08', '019a922c-f34c-71b4-9d03-8d0d4a93cd9d'),
('019a9d03-c164-72e0-a6a3-02099d106b4b', '2025-10-26', '500', '2025-11-19 16:47:40', '2025-11-19 16:47:40', '019a9cd5-986f-7246-a72e-085ea005d08a'),
('019a9d0f-3ad8-7083-8f1a-04524f4913ec', '2025-10-26', '500', '2025-11-19 17:00:12', '2025-11-19 17:00:12', '019a9cd4-dbf1-70b9-bd59-0cf295d88b9e');

-- --------------------------------------------------------

--
-- Structure de la table `caisses`
--

CREATE TABLE `caisses` (
  `id` char(36) NOT NULL,
  `montant` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paiements_id` char(36) NOT NULL,
  `types` varchar(45) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `balance_after` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `caisses`
--

INSERT INTO `caisses` (`id`, `montant`, `created_at`, `updated_at`, `paiements_id`, `types`, `description`, `balance_after`) VALUES
('019a9d0e-d933-7127-96ef-d6ef918b4ba4', 1500, '2025-11-19 16:59:47', '2025-11-19 16:59:47', '019a9d0e-d924-71c2-82eb-1cbfc3ba1dad', 'in', 'Paiement admin pour user 019a9cd5-986f-7246-a72e-085ea005d08a - paiements_id 019a9d0e-d924-71c2-82eb-1cbfc3ba1dad', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` char(36) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `montant` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` char(36) NOT NULL,
  `reste_a_payer` int DEFAULT NULL,
  `weeks_covered` varchar(45) DEFAULT NULL,
  `commentaire` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `status`, `montant`, `created_at`, `updated_at`, `users_id`, `reste_a_payer`, `weeks_covered`, `commentaire`) VALUES
('019a9d0e-d924-71c2-82eb-1cbfc3ba1dad', 'recorded', 1500, '2025-11-19 16:59:47', '2025-11-19 16:59:47', '019a9cd5-986f-7246-a72e-085ea005d08a', 500, '3', 'Paiement enregistré manuellement par admin le 2025-11-19 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `paiement_semaines`
--

CREATE TABLE `paiement_semaines` (
  `id` char(36) NOT NULL,
  `sunday_date` date DEFAULT NULL,
  `montant_applique` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` char(36) NOT NULL,
  `paiements_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `paiement_semaines`
--

INSERT INTO `paiement_semaines` (`id`, `sunday_date`, `montant_applique`, `created_at`, `updated_at`, `users_id`, `paiements_id`) VALUES
('019a9d0e-d929-7114-be19-f272e51b5df2', '2025-10-26', '500', '2025-11-19 16:59:47', '2025-11-19 16:59:47', '019a9cd5-986f-7246-a72e-085ea005d08a', '019a9d0e-d924-71c2-82eb-1cbfc3ba1dad'),
('019a9d0e-d92b-701b-89d4-1176add68757', '2025-11-02', '500', '2025-11-19 16:59:47', '2025-11-19 16:59:47', '019a9cd5-986f-7246-a72e-085ea005d08a', '019a9d0e-d924-71c2-82eb-1cbfc3ba1dad'),
('019a9d0e-d92b-701b-89d4-1176aebd7101', '2025-11-09', '500', '2025-11-19 16:59:47', '2025-11-19 16:59:47', '019a9cd5-986f-7246-a72e-085ea005d08a', '019a9d0e-d924-71c2-82eb-1cbfc3ba1dad');

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id` char(36) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
('019a9226-eb77-7354-818e-fa08017e39f7', 'Super-admin', '2025-11-17 14:10:15', '2025-11-17 14:10:15'),
('019a9294-20f1-7043-b634-2ef4fdbdc4db', 'admin', '2025-11-17 16:09:32', '2025-11-17 16:09:32'),
('019a9cc0-8138-7077-a7bd-aa112f92a80f', 'membre', '2025-11-19 15:34:13', '2025-11-19 15:34:13');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(100) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profils_id` char(36) NOT NULL,
  `password_changed` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `created_at`, `updated_at`, `profils_id`, `password_changed`) VALUES
('019a922c-f34c-71b4-9d03-8d0d4a93cd9d', 'Jouanelle', 'Traore Don Manuel', 'traore@gmail.com', '$2y$12$yMRpJcMVLsGPk3CtpP/rm.ZqaN8wVlRqR/9tZgQJtj/R36j4pskR2', '2025-11-17 14:16:50', '2025-11-19 21:46:36', '019a9226-eb77-7354-818e-fa08017e39f7', 1),
('019a9cd4-dbf1-70b9-bd59-0cf295d88b9e', 'Coulibaly', 'Modibo', 'coulibalymodibo@gmail.com', '$2y$12$vIoGcoeV2E7YxuOedCg7aO7ElHfBnMIpZjU.8jzS1oSvUifXcf6Oe', '2025-11-19 15:56:26', '2025-11-19 16:31:44', '019a9294-20f1-7043-b634-2ef4fdbdc4db', 0),
('019a9cd5-986f-7246-a72e-085ea005d08a', 'Dakouo', 'Yves', 'yvedakouo@gmail.com', '$2y$12$.n8G9dd4HDtXLcN2pHuE3u11ezFGDX7nl4cefAwJsR9pF3xEzRuJe', '2025-11-19 15:57:15', '2025-11-20 09:39:12', '019a9cc0-8138-7077-a7bd-aa112f92a80f', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_abonnements_users1_idx` (`users_id`);

--
-- Index pour la table `caisses`
--
ALTER TABLE `caisses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caisses_paiements1_idx` (`paiements_id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paiements_users1_idx` (`users_id`);

--
-- Index pour la table `paiement_semaines`
--
ALTER TABLE `paiement_semaines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paiement_semaines_users1_idx` (`users_id`),
  ADD KEY `fk_paiement_semaines_paiements1_idx` (`paiements_id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_profils_idx` (`profils_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD CONSTRAINT `fk_abonnements_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `caisses`
--
ALTER TABLE `caisses`
  ADD CONSTRAINT `fk_caisses_paiements1` FOREIGN KEY (`paiements_id`) REFERENCES `paiements` (`id`);

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `fk_paiements_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `paiement_semaines`
--
ALTER TABLE `paiement_semaines`
  ADD CONSTRAINT `fk_paiement_semaines_paiements1` FOREIGN KEY (`paiements_id`) REFERENCES `paiements` (`id`),
  ADD CONSTRAINT `fk_paiement_semaines_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profils` FOREIGN KEY (`profils_id`) REFERENCES `profils` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
