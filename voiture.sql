-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 08 juil. 2025 à 07:20
-- Version du serveur : 8.0.29
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `voiture`
--

-- --------------------------------------------------------

--
-- Structure de la table `Couleur`
--

CREATE TABLE `Couleur` (
  `id_couleur` int NOT NULL,
  `nom_couleur` varchar(256) DEFAULT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `Couleur`
--

INSERT INTO `Couleur` (`id_couleur`, `nom_couleur`) VALUES
(1, 'Rouge'),
(2, 'Vert'),
(3, 'Bleu'),
(4, 'Noir'),
(5, 'Blanc'),
(6, 'Jaune');

-- --------------------------------------------------------

--
-- Structure de la table `TypeVehicule`
--

CREATE TABLE `TypeVehicule` (
  `id_type` int NOT NULL,
  `nom_type` varchar(256) DEFAULT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `TypeVehicule`
--

INSERT INTO `TypeVehicule` (`id_type`, `nom_type`) VALUES
(1, 'Voiture'),
(2, 'Moto');

-- --------------------------------------------------------

--
-- Structure de la table `Vehicule`
--

CREATE TABLE `Vehicule` (
  `id_vehicule` int NOT NULL,
  `Immatriculation` varchar(256) NOT NULL,
  `Type` int NOT NULL,
  `Couleur` int NOT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `Vehicule`
--

INSERT INTO `Vehicule` (`id_vehicule`, `Immatriculation`, `Type`, `Couleur`) VALUES
(1, 'FD-544-GF', 1, 4),
(2, 'FD-654-DS', 1, 4),
(3, 'ZE-321-FS', 1, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Couleur`
--
ALTER TABLE `Couleur`
  ADD PRIMARY KEY (`id_couleur`);

--
-- Index pour la table `TypeVehicule`
--
ALTER TABLE `TypeVehicule`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `Vehicule`
--
ALTER TABLE `Vehicule`
  ADD PRIMARY KEY (`id_vehicule`),
  ADD KEY `FK_Vehicule_id_type` (`Couleur`),
  ADD KEY `FK_Vehicule_id_couleur` (`Type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Couleur`
--
ALTER TABLE `Couleur`
  MODIFY `id_couleur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `TypeVehicule`
--
ALTER TABLE `TypeVehicule`
  MODIFY `id_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Vehicule`
--
ALTER TABLE `Vehicule`
  MODIFY `id_vehicule` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Vehicule`
--
ALTER TABLE `Vehicule`
  ADD CONSTRAINT `FK_Vehicule_id_couleur` FOREIGN KEY (`Type`) REFERENCES `TypeVehicule` (`id_type`),
  ADD CONSTRAINT `FK_Vehicule_id_type` FOREIGN KEY (`Couleur`) REFERENCES `Couleur` (`id_couleur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
