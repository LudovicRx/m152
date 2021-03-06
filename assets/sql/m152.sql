-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 08 fév. 2021 à 08:12
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP : 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `m152`
--
CREATE DATABASE IF NOT EXISTS `m152` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `m152`;

-- --------------------------------------------------------

--
-- Structure de la table `MEDIA`
--

CREATE TABLE `MEDIA` (
  `idMedia` int(11) NOT NULL,
  `typeMedia` varchar(255) NOT NULL,
  `nomFichierMedia` varchar(255) NOT NULL,
  `dateDeCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `idPost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `MEDIA`
--

INSERT INTO `MEDIA` (`idMedia`, `typeMedia`, `nomFichierMedia`, `dateDeCreation`, `idPost`) VALUES
(1, 'image/png', 'Capture d’écran 2020-12-09 150956.png', '2021-02-01 10:31:35', 11),
(2, 'image/png', 'Capture d’écran 2020-12-09 150529.png', '2021-02-01 10:31:45', 11);

-- --------------------------------------------------------

--
-- Structure de la table `POST`
--

CREATE TABLE `POST` (
  `idPost` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `dateDeCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateDeModification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `POST`
--

INSERT INTO `POST` (`idPost`, `commentaire`, `dateDeCreation`, `dateDeModification`) VALUES
(1, 'Ceci est un post trop cool', '2021-02-01 09:57:46', '2021-02-01 09:57:46'),
(2, 'Ceci est un post trop cool', '2021-02-01 09:59:56', '2021-02-01 09:59:56'),
(3, 'Ceci est un post trop cool', '2021-02-01 10:08:43', '2021-02-01 10:08:43'),
(4, 'Ceci est un post trop cool', '2021-02-01 10:11:39', '2021-02-01 10:11:39'),
(5, 'yoyoyou', '2021-02-01 10:21:24', '2021-02-01 10:21:24'),
(6, 'yoyoyou', '2021-02-01 10:21:38', '2021-02-01 10:21:38'),
(7, 'yoyoyou', '2021-02-01 10:21:51', '2021-02-01 10:21:51'),
(8, 'yoyoyou', '2021-02-01 10:22:33', '2021-02-01 10:22:33'),
(9, 'yoyoyou', '2021-02-01 10:23:59', '2021-02-01 10:23:59'),
(10, 'yoyoyou', '2021-02-01 10:24:40', '2021-02-01 10:24:40'),
(11, 'yoyoyou', '2021-02-01 10:31:32', '2021-02-01 10:31:32');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  ADD PRIMARY KEY (`idMedia`),
  ADD KEY `idPost` (`idPost`);

--
-- Index pour la table `POST`
--
ALTER TABLE `POST`
  ADD PRIMARY KEY (`idPost`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `POST`
--
ALTER TABLE `POST`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  ADD CONSTRAINT `MEDIA_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `POST` (`idPost`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
