-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 27 fév. 2026 à 16:01
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
-- Base de données : `saehop`
--

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

CREATE TABLE `badge` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `type_condition` enum('missions','points','streak','classement_mensuel') DEFAULT NULL,
  `valeur_condition` int(11) DEFAULT NULL,
  `est_temporaire` tinyint(1) DEFAULT 0,
  `duree_jour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `photo_profil` varchar(255) DEFAULT 'default.png',
  `total_points` int(11) DEFAULT 0,
  `niveau_arene` int(11) DEFAULT 1,
  `role` varchar(20) NOT NULL DEFAULT 'entreprise'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `secteur_activite`, `email`, `password`, `photo_profil`, `total_points`, `niveau_arene`, `role`) VALUES
(14, 'Macdo', 'FastFood', 'admin@mcdo.com', '$2y$10$eTPfRlTtKdXWlxKXbcbOnefGoh6RFSg/MeU/1J4xtT6p1/ulxjO.C', '../../uploads/a85bd98ff6eb266c653793a133065528.png', 0, 1, 'entreprise'),
(15, 'Google', 'informatique', 'admin@google.com', '$2y$10$EJoZb/YWooRhMFzNs2Xhbe6m0pE7TqA1mKm.hX1pPH4eDKVjPKrkG', '../../uploads/ed6bf5448a04c801c5c1d2ac01811a68.png', 0, 1, 'entreprise'),
(16, 'Nike', 'Vetements', 'admin@nike.com', '$2y$10$6aXR.G4hcAjVabN4zI95PuQqIL.V8NBYTGxFQFUCDimfnzdaLgIWS', '../../uploads/684709970db84768e0aa909db19711b0.jpg', 0, 1, 'entreprise');

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
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(19, 'Delavenay', 'Baptiste', 'bdelavenay78@gmail.com', '$2y$10$IKbCRXFLyfUwHz.Z3cQZAOsWSiNpdlA9TZEKToW.wfp6hYoldeoC.', 'collaborateur', 15, '../../uploads/4c93cf1094e5d5b578d281964786039e.jpg', 0, 0, 0, 0, NULL, '2026-02-26 22:58:53');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mission_assign`
--
ALTER TABLE `mission_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  ADD CONSTRAINT `mission_assign_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mission_assign_ibfk_2` FOREIGN KEY (`Mission_ID`) REFERENCES `mission` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `user_badge_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_badge_ibfk_2` FOREIGN KEY (`Badge_ID`) REFERENCES `badge` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
