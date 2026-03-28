-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 28 mars 2026 à 21:00
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hop`
--

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

CREATE TABLE `badge` (
  `id` int(11) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `badge`
--

INSERT INTO `badge` (`id`, `chemin`, `nom`, `description`) VALUES
(3, 'IMG/badges/badge1.svg', 'Niveau 1', 'Vous avez atteint le niveau 1 !'),
(4, 'IMG/badges/badge2.svg', 'Niveau 2', 'Vous avez atteint le niveau 2 !'),
(5, 'IMG/badges/badge3.svg', 'Niveau 3', 'Vous avez atteint le niveau 3 !'),
(6, 'IMG/badges/badge4.svg', 'Niveau 4', 'Vous avez atteint le niveau 4 !'),
(7, 'IMG/badges/badge5.svg', 'Niveau 5', 'Vous avez atteint le niveau 5 !'),
(8, 'IMG/badges/badge6.svg', 'Niveau 6', 'Vous avez atteint le niveau 6 !'),
(9, 'IMG/badges/badge7.svg', 'Niveau 7', 'Vous avez atteint le niveau 7 !'),
(10, 'IMG/badges/badge8.svg', 'Niveau 8', 'Vous avez atteint le niveau 8 !'),
(11, 'IMG/badges/badge9.svg', 'Niveau 9', 'Vous avez atteint le niveau 9 !');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `secteur_activite` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code_unique` varchar(4) NOT NULL,
  `photo_profil` varchar(255) DEFAULT 'default.png',
  `total_points` int(11) DEFAULT 0,
  `niveau_arene` int(11) DEFAULT 1,
  `role` varchar(20) NOT NULL DEFAULT 'entreprise'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `secteur_activite`, `email`, `password`, `code_unique`, `photo_profil`, `total_points`, `niveau_arene`, `role`) VALUES
(17, 'Apple', 'Informatique', 'admin@apple.com', '$2y$10$EIPfZdne5vGw57/a8/nM3u71SbPRujy/.siOnd8tKNlqSM2puGA9q', 'HFHR', '../../uploads/6e60c6788fb3823e8ba5ce7d523a9f1d.jpg', 0, 1, 'entreprise'),
(18, 'Google', 'Informatique', 'admin@google.com', '$2y$10$yrK7amrqufhcn8GQ9FWJq.2Qg/nZd2J.Hv39w9ylkNxlK1ByOoI1y', 'AVOJ', '../../uploads/google.png', 0, 1, 'entreprise');

-- --------------------------------------------------------

--
-- Structure de la table `feed`
--

CREATE TABLE `feed` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nb_likes` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `feed`
--

INSERT INTO `feed` (`id`, `id_utilisateur`, `description`, `image`, `nb_likes`, `date`) VALUES
(1, 22, 'mef\r\n', '../../uploads/feed/b2fc83124723bd42c613b0338fad66c2.jpg', 0, '2026-03-28 17:34:07'),
(3, 22, 'Bah super la polution...', '../../uploads/feed/3752de78438033c487948e7ebd860e03.jpg', 0, '2026-03-28 18:00:52'),
(4, 45, 'J\'adore l\'IAAA', '../../uploads/feed/6ebdf1eec07f3c542707079f314ea3ee.jpg', 0, '2026-03-28 18:02:43');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `points_base` int(11) NOT NULL,
  `difficulte` enum('facile','moyenne','difficile') NOT NULL,
  `type_preuve` enum('aucune','photo','texte') DEFAULT 'aucune',
  `active` tinyint(1) DEFAULT 1,
  `frequence` varchar(20) DEFAULT 'journalière'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id`, `titre`, `description`, `points_base`, `difficulte`, `type_preuve`, `active`, `frequence`) VALUES
(1, 'Extinction totale', 'Éteindre les lumières inutiles.', 10, 'facile', 'aucune', 1, 'journaliere'),
(2, 'Zéro veille', 'Éteindre mon écran le soir.', 10, 'facile', 'aucune', 1, 'journaliere'),
(3, 'Mail malin', 'Supprimer dix vieux emails.', 15, 'moyenne', 'texte', 1, 'journaliere'),
(4, 'Tri sélectif', 'Jeter mes déchets correctement.', 10, 'facile', 'photo', 1, 'journaliere'),
(5, 'Escaliers', 'Éviter l\'ascenseur aujourd\'hui.', 20, 'difficile', 'aucune', 1, 'journaliere'),
(6, 'Gourde attitude', 'Utiliser une gourde réutilisable.', 10, 'facile', 'photo', 1, 'journaliere'),
(7, 'Chauffage éco', 'Baisser le thermostat (19°C).', 15, 'moyenne', 'aucune', 1, 'journaliere'),
(8, 'Onglets propres', 'Fermer les onglets inutilisés.', 5, 'facile', 'aucune', 1, 'journaliere'),
(9, 'Partage local', 'Donner un objet inutile.', 25, 'difficile', 'photo', 1, 'journaliere'),
(10, 'Plante heureuse', 'Arroser une plante verte.', 5, 'facile', 'aucune', 1, 'journaliere'),
(11, 'Semaine Végé', 'Ne consommer aucune viande pendant 7 jours.', 120, 'difficile', 'aucune', 1, 'hebdomadaire'),
(12, '100% Mobilité douce', 'Venir au travail sans voiture solo toute la semaine.', 150, 'difficile', 'aucune', 1, 'hebdomadaire'),
(13, 'Zéro Plastique', 'N’utiliser aucune bouteille ou contenant jetable.', 100, 'moyenne', 'aucune', 1, 'hebdomadaire'),
(14, 'Nettoyage Numérique', 'Supprimer 500 emails inutiles ou fichiers lourds.', 80, 'moyenne', 'aucune', 1, 'hebdomadaire'),
(15, 'Escaliers Uniquement', 'Bannir l’ascenseur au bureau toute la semaine.', 90, 'moyenne', 'aucune', 1, 'hebdomadaire'),
(16, 'Expert du Tri', 'Vérifier et corriger le tri du bac commun chaque jour.', 110, 'difficile', 'aucune', 1, 'hebdomadaire'),
(17, 'Zéro Veille', 'Éteindre tous les appareils du bureau chaque soir.', 100, 'moyenne', 'aucune', 1, 'hebdomadaire'),
(18, 'Repas Locaux', 'Manger uniquement des produits locaux et de saison.', 130, 'difficile', 'aucune', 1, 'hebdomadaire'),
(19, 'Ambassadeur Hop', 'Parrainer un collègue pour sa première mission.', 100, 'moyenne', 'aucune', 1, 'hebdomadaire'),
(20, 'Stop Gaspillage', 'Finir tous ses repas sans aucun reste alimentaire.', 90, 'moyenne', 'aucune', 1, 'hebdomadaire');

-- --------------------------------------------------------

--
-- Structure de la table `mission_assign`
--

CREATE TABLE `mission_assign` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `date_assignation` date NOT NULL,
  `date_validation` datetime DEFAULT NULL,
  `statut` enum('en_cours','validee','refusee') DEFAULT 'en_cours',
  `preuve_url` varchar(255) DEFAULT NULL,
  `preuve_texte` text DEFAULT NULL,
  `points_gagnes` int(11) DEFAULT NULL,
  `multiplicateur` float DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mission_assign`
--

INSERT INTO `mission_assign` (`id`, `user_id`, `mission_id`, `date_assignation`, `date_validation`, `statut`, `preuve_url`, `preuve_texte`, `points_gagnes`, `multiplicateur`) VALUES
(46, 44, 10, '2026-03-25', NULL, 'validee', NULL, NULL, NULL, 1),
(47, 44, 2, '2026-03-25', NULL, 'validee', NULL, NULL, NULL, 1),
(48, 44, 5, '2026-03-25', NULL, 'validee', NULL, NULL, NULL, 1),
(49, 44, 15, '2026-03-25', NULL, 'validee', NULL, NULL, NULL, 1),
(50, 44, 20, '2026-03-25', NULL, 'validee', NULL, NULL, NULL, 1),
(51, 44, 18, '2026-03-25', NULL, 'validee', NULL, NULL, NULL, 1),
(52, 22, 1, '2026-03-25', NULL, 'en_cours', NULL, NULL, NULL, 1),
(53, 22, 9, '2026-03-25', NULL, 'en_cours', NULL, NULL, NULL, 1),
(54, 22, 7, '2026-03-25', NULL, 'en_cours', NULL, NULL, NULL, 1),
(55, 22, 20, '2026-03-25', NULL, 'en_cours', NULL, NULL, NULL, 1),
(56, 22, 19, '2026-03-25', NULL, 'en_cours', NULL, NULL, NULL, 1),
(57, 22, 13, '2026-03-25', NULL, 'en_cours', NULL, NULL, NULL, 1),
(58, 22, 9, '2026-03-26', NULL, 'validee', NULL, NULL, NULL, 1),
(59, 22, 1, '2026-03-26', NULL, 'validee', NULL, NULL, NULL, 1),
(60, 22, 4, '2026-03-26', NULL, 'validee', NULL, NULL, NULL, 1),
(61, 22, 12, '2026-03-26', NULL, 'en_cours', NULL, NULL, NULL, 1),
(62, 22, 20, '2026-03-26', NULL, 'en_cours', NULL, NULL, NULL, 1),
(63, 22, 18, '2026-03-26', NULL, 'en_cours', NULL, NULL, NULL, 1),
(64, 22, 4, '2026-03-27', NULL, 'validee', NULL, NULL, NULL, 1),
(65, 22, 5, '2026-03-27', NULL, 'validee', NULL, NULL, NULL, 1),
(66, 22, 10, '2026-03-27', NULL, 'validee', NULL, NULL, NULL, 1),
(67, 22, 18, '2026-03-27', NULL, 'en_cours', NULL, NULL, NULL, 1),
(68, 22, 19, '2026-03-27', NULL, 'en_cours', NULL, NULL, NULL, 1),
(69, 22, 15, '2026-03-27', NULL, 'en_cours', NULL, NULL, NULL, 1),
(70, 22, 8, '2026-03-28', NULL, 'validee', NULL, NULL, NULL, 1),
(71, 22, 2, '2026-03-28', NULL, 'validee', NULL, NULL, NULL, 1),
(72, 22, 4, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(73, 22, 11, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(74, 22, 15, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(75, 22, 12, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(76, 45, 8, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(77, 45, 7, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(78, 45, 5, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(79, 45, 19, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(80, 45, 13, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1),
(81, 45, 14, '2026-03-28', NULL, 'en_cours', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('collaborateur','admin','entreprise') DEFAULT 'collaborateur',
  `entreprise_id` int(11) NOT NULL DEFAULT 0,
  `photo_profil` varchar(255) NOT NULL,
  `total_points` int(11) DEFAULT 0,
  `missions_completees` int(11) DEFAULT 0,
  `streak` int(11) DEFAULT 0,
  `streak_max` int(11) DEFAULT 0,
  `derniere_mission_date` date DEFAULT NULL,
  `date_inscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `role`, `entreprise_id`, `photo_profil`, `total_points`, `missions_completees`, `streak`, `streak_max`, `derniere_mission_date`, `date_inscription`) VALUES
(22, 'Delavenay', 'Baptiste', 'bdelavenay78@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEXx51JV6rmM.', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 550, 0, 0, 0, NULL, '2026-03-13 14:18:57'),
(23, 'Dupont', 'Jean', 'j.dupont@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 518, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(24, 'Martin', 'Alice', 'a.martin@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 692, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(25, 'Lefebvre', 'Thomas', 't.lefebvre@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 907, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(26, 'Bernard', 'Chloé', 'c.bernard@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 557, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(27, 'Petit', 'Lucas', 'l.petit@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 865, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(28, 'Robert', 'Emma', 'e.robert@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 751, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(29, 'Richard', 'Hugo', 'h.richard@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 163, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(30, 'Durand', 'Manon', 'm.durand@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 262, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(31, 'Dubois', 'Nathan', 'n.dubois@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 721, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(32, 'Moreau', 'Léa', 'l.moreau@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 917, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(33, 'Laurent', 'Enzo', 'e.laurent@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 522, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(34, 'Simon', 'Sarah', 's.simon@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 659, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(35, 'Michel', 'Louis', 'l.michel@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 729, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(36, 'Garcia', 'Jade', 'j.garcia@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 669, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(37, 'David', 'Arthur', 'a.david@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 158, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(38, 'Bertrand', 'Inès', 'i.bertrand@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 485, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(39, 'Roux', 'Gabriel', 'g.roux@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 951, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(40, 'Vincent', 'Zoé', 'z.vincent@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 499, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(41, 'Fournier', 'Jules', 'j.fournier@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 440, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(42, 'Morel', 'Louna', 'l.morel@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 606, 0, 0, 0, NULL, '2026-03-13 15:03:24'),
(44, 'Corvol', 'Math&eacute;o', 'corvomat@gmail.com', '$2y$10$KuxgJ2fGsx5hi87J9PTaCOUmjPmBHr4do7923OAVrla40S2OVEfi.', 'collaborateur', 17, '../../uploads/01a31144f1fc880f5ff32c4985b0209e.jpg', 395, 0, 0, 0, NULL, '2026-03-19 21:20:39'),
(45, 'Jawish', 'Jan', 'janjawish@gmail.com', '$2y$10$ETWpXhYW59Hhj2hx3vV.S.vgCxwF/xZIAit2kW4u9SkDJkl6szEPy', 'collaborateur', 18, '../../uploads/f1e1b507d72b1809dab9c55149f8642b.jpg', 0, 0, 0, 0, NULL, '2026-03-28 19:02:02');

-- --------------------------------------------------------

--
-- Structure de la table `user_badge`
--

CREATE TABLE `user_badge` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `date_obtention` datetime DEFAULT current_timestamp(),
  `date_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission_assign`
--
ALTER TABLE `mission_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `entreprise_id` (`entreprise_id`);

--
-- Index pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `badge_id` (`badge_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `badge`
--
ALTER TABLE `badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `mission_assign`
--
ALTER TABLE `mission_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `user_badge`
--
ALTER TABLE `user_badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `mission_assign`
--
ALTER TABLE `mission_assign`
  ADD CONSTRAINT `mission_assign_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mission_assign_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `user_badge_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_badge_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
