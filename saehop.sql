-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 fév. 2026 à 15:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
  `ID` int(11) NOT NULL,
  `Nom` varchar(150) NOT NULL,
  `Description` text DEFAULT NULL,
  `Type_condition` enum('missions','points','streak','classement_mensuel') DEFAULT NULL,
  `Valeur_condition` int(11) DEFAULT NULL,
  `Est_temporaire` tinyint(1) DEFAULT 0,
  `Duree_jours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(150) NOT NULL,
  `Taille` int(11) DEFAULT NULL,
  `Date_creation` date DEFAULT NULL,
  `Total_points` int(11) DEFAULT 0,
  `Niveau_arene` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID`, `Nom`, `Taille`, `Date_creation`, `Total_points`, `Niveau_arene`) VALUES
(1, 'Entreprise', 1, '2026-02-13', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `ID` int(11) NOT NULL,
  `Titre` varchar(150) NOT NULL,
  `Description` text DEFAULT NULL,
  `Points_base` int(11) NOT NULL,
  `Difficulte` enum('facile','moyenne','difficile') NOT NULL,
  `Type_preuve` enum('aucune','photo','texte') DEFAULT 'aucune',
  `Active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission_assign`
--

CREATE TABLE `mission_assign` (
  `ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Mission_ID` int(11) NOT NULL,
  `Date_assignation` date NOT NULL,
  `Date_validation` datetime DEFAULT NULL,
  `Statut` enum('en_cours','validee','refusee') DEFAULT 'en_cours',
  `Preuve_url` varchar(255) DEFAULT NULL,
  `Preuve_texte` text DEFAULT NULL,
  `Points_gagnes` int(11) DEFAULT NULL,
  `Multiplicateur` float DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Role` enum('employe','admin') DEFAULT 'employe',
  `Entreprise_ID` int(11) NOT NULL,
  `Total_points` int(11) DEFAULT 0,
  `Missions_completees` int(11) DEFAULT 0,
  `Streak_courant` int(11) DEFAULT 0,
  `Streak_max` int(11) DEFAULT 0,
  `Derniere_mission_date` date DEFAULT NULL,
  `Date_inscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `Nom`, `Prenom`, `Email`, `Mdp`, `Role`, `Entreprise_ID`, `Total_points`, `Missions_completees`, `Streak_courant`, `Streak_max`, `Derniere_mission_date`, `Date_inscription`) VALUES
(2, 'admin', 'admin', 'admin@gmail.com', 'admin', 'employe', 1, 0, 0, 0, 0, NULL, '2026-02-13 14:39:28');

-- --------------------------------------------------------

--
-- Structure de la table `user_badge`
--

CREATE TABLE `user_badge` (
  `ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Badge_ID` int(11) NOT NULL,
  `Date_obtention` datetime DEFAULT current_timestamp(),
  `Date_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `mission_assign`
--
ALTER TABLE `mission_assign`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`User_ID`),
  ADD KEY `mission_id` (`Mission_ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `entreprise_id` (`Entreprise_ID`);

--
-- Index pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`User_ID`),
  ADD KEY `badge_id` (`Badge_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `badge`
--
ALTER TABLE `badge`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mission_assign`
--
ALTER TABLE `mission_assign`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_badge`
--
ALTER TABLE `user_badge`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
