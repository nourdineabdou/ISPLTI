-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 16 nov. 2025 à 16:43
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
-- Structure de la table `compétences_professeurs`
--

CREATE TABLE `compétences_professeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professeur_id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pdf_profes`
--

CREATE TABLE `pdf_profes` (
  `id` int(11) NOT NULL,
  `matiere_id` int(11) DEFAULT NULL,
  `specialite_id` int(11) DEFAULT NULL,
  `chemain_pde` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeur_experiences`
--

CREATE TABLE `professeur_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professeur_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(150) NOT NULL,
  `institution` varchar(200) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeur_languages`
--

CREATE TABLE `professeur_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professeur_id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(100) NOT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compétences_professeurs`
--
ALTER TABLE `compétences_professeurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pdf_profes`
--
ALTER TABLE `pdf_profes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `professeur_experiences`
--
ALTER TABLE `professeur_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `professeur_languages`
--
ALTER TABLE `professeur_languages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compétences_professeurs`
--
ALTER TABLE `compétences_professeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pdf_profes`
--
ALTER TABLE `pdf_profes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professeur_experiences`
--
ALTER TABLE `professeur_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professeur_languages`
--
ALTER TABLE `professeur_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
