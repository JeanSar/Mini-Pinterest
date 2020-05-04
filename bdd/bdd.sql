-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 04 mai 2020 à 11:54
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mini-pinterest`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `catId` int(10) NOT NULL,
  `nomCat` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`catId`, `nomCat`) VALUES
(1, 'Fruit'),
(2, 'Legume'),
(3, 'Féculent'),
(4, 'Avion');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `photoId` int(10) UNSIGNED NOT NULL,
  `nomFich` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `catId` int(10) NOT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `Nom` varchar(250) DEFAULT NULL,
  `afficher` tinyint(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`photoId`, `nomFich`, `description`, `catId`, `titre`, `Nom`, `afficher`) VALUES
(48, 'DSC1.jpeg', 'Photo de fraises', 1, 'Fraise', 'Dieu', 1),
(49, 'DSC49.jpeg', 'Avion stylé', 4, 'Avion', 'Deloin Gaspar', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `droit` tinyint(1) DEFAULT NULL,
  `Nom` varchar(250) NOT NULL,
  `pseudo` varchar(250) NOT NULL,
  `motdepasse` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`droit`, `Nom`, `pseudo`, `motdepasse`) VALUES
(0, 'Deloin Gaspar', 'Hipole', '1'),
(0, 'Deloin Gaspouille', 'Pere Noel', '123'),
(1, 'Dieu', 'admin', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photoId`),
  ADD KEY `catId` (`catId`),
  ADD KEY `Nom` (`Nom`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Nom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `catId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `photoId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `categorie` (`catId`),
  ADD CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`Nom`) REFERENCES `utilisateur` (`Nom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
