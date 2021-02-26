-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 26 fév. 2021 à 21:42
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsp`
--

-- --------------------------------------------------------

--
-- Structure de la table `accordations`
--

CREATE TABLE `accordations` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `fonction` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `adresse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `nom`, `prenom`, `fonction`, `username`, `password`, `role`, `adresse`) VALUES
(1, 'haje', 'malik', 'technicien', 'emp1', '8cb2237d0679ca88db6464eac60da96345513964', 1, 'Teyarett');

-- --------------------------------------------------------

--
-- Structure de la table `obtenir_accordation`
--

CREATE TABLE `obtenir_accordation` (
  `id` int(11) NOT NULL,
  `id_accordation` int(11) NOT NULL,
  `id_emps` int(11) NOT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pointage`
--

CREATE TABLE `pointage` (
  `id` int(11) NOT NULL,
  `heure_arriver` datetime DEFAULT NULL,
  `heure_descente` datetime DEFAULT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pointage`
--

INSERT INTO `pointage` (`id`, `heure_arriver`, `heure_descente`, `id_emp`) VALUES
(1, '2021-02-10 23:22:37', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accordations`
--
ALTER TABLE `accordations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `obtenir_accordation`
--
ALTER TABLE `obtenir_accordation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_accordation` (`id_accordation`),
  ADD KEY `id_emps` (`id_emps`);

--
-- Index pour la table `pointage`
--
ALTER TABLE `pointage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_emp` (`id_emp`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accordations`
--
ALTER TABLE `accordations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `obtenir_accordation`
--
ALTER TABLE `obtenir_accordation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pointage`
--
ALTER TABLE `pointage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `obtenir_accordation`
--
ALTER TABLE `obtenir_accordation`
  ADD CONSTRAINT `obtenir_accordation_ibfk_1` FOREIGN KEY (`id_accordation`) REFERENCES `accordations` (`id`),
  ADD CONSTRAINT `obtenir_accordation_ibfk_2` FOREIGN KEY (`id_emps`) REFERENCES `employees` (`id`);

--
-- Contraintes pour la table `pointage`
--
ALTER TABLE `pointage`
  ADD CONSTRAINT `pointage_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
