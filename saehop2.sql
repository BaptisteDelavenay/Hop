-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 mars 2026 à 15:43
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
-- Base de données : `saehop2`
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
(18, 'Google', 'Informatique', 'admin@google.com', '$2y$10$yrK7amrqufhcn8GQ9FWJq.2Qg/nZd2J.Hv39w9ylkNxlK1ByOoI1y', 'AVOJ', '../../uploads/131b3beac165e955d712c357c332614d.png', 0, 1, 'entreprise');

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

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id`, `titre`, `description`, `points_base`, `difficulte`, `type_preuve`, `active`) VALUES
(1, 'Extinction totale', 'Éteindre les lumières inutiles.', 10, 'facile', 'aucune', 1),
(2, 'Zéro veille', 'Éteindre mon écran le soir.', 10, 'facile', 'aucune', 1),
(3, 'Mail malin', 'Supprimer dix vieux emails.', 15, 'facile', 'texte', 1),
(4, 'Tri sélectif', 'Jeter mes déchets correctement.', 10, 'facile', 'photo', 1),
(5, 'Escaliers', 'Éviter l\'ascenseur aujourd\'hui.', 20, 'facile', 'aucune', 1),
(6, 'Gourde attitude', 'Utiliser une gourde réutilisable.', 10, 'facile', 'photo', 1),
(7, 'Chauffage éco', 'Baisser le thermostat (19°C).', 15, 'facile', 'aucune', 1),
(8, 'Onglets propres', 'Fermer les onglets inutilisés.', 5, 'facile', 'aucune', 1),
(9, 'Partage local', 'Donner un objet inutile.', 25, 'facile', 'photo', 1),
(10, 'Plante heureuse', 'Arroser une plante verte.', 5, 'facile', 'aucune', 1);

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
(13, 22, 4, '2026-03-13', NULL, 'en_cours', NULL, NULL, NULL, 1),
(14, 22, 1, '2026-03-13', NULL, 'en_cours', NULL, NULL, NULL, 1),
(15, 22, 6, '2026-03-13', NULL, 'en_cours', NULL, NULL, NULL, 1);

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
(22, 'Delavenay', 'Baptiste', 'bdelavenay78@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEXx51JV6rmM.', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 0, 0, 0, 0, NULL, '2026-03-13 14:18:57'),
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
(42, 'Morel', 'Louna', 'l.morel@gmail.com', '$2y$10$cJX1nX10Z7i7CNIkbmjS9eIKqiTuhoiUqVD2lfIzZEX', 'collaborateur', 18, '../../uploads/db472279cc11aafa835153b792a4cfb3.jpg', 606, 0, 0, 0, NULL, '2026-03-13 15:03:24');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `mission_assign`
--
ALTER TABLE `mission_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
