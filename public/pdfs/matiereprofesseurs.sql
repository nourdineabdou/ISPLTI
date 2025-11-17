-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 15 nov. 2025 à 22:43
-- Version du serveur : 11.4.9-MariaDB
-- Version de PHP : 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sc8jtln1121_ispndb`
--

-- --------------------------------------------------------

--
-- Structure de la table `matiereprofesseurs`
--

CREATE TABLE `matiereprofesseurs` (
  `id` int(11) NOT NULL,
  `professeur_id` int(11) DEFAULT NULL,
  `matiere_id` int(11) DEFAULT NULL,
  `code_specialite` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT 1,
  `libelle` int(11) DEFAULT NULL,
  `nbreEtudiant` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `matiereprofesseurs`
--
ALTER TABLE `matiereprofesseurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `matiereprofesseurs`
--
ALTER TABLE `matiereprofesseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
