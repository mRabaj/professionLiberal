-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 déc. 2020 à 16:03
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `idDocument` int(11) NOT NULL,
  `idPatient` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `date_expiration` date NOT NULL,
  `file_blob` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `mutuelle`
--

CREATE TABLE `mutuelle` (
  `idMutuelle` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `code_postal` varchar(6) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mutuelle`
--

INSERT INTO `mutuelle` (`idMutuelle`, `nom`, `adresse`, `code_postal`, `ville`, `email`, `telephone`) VALUES
(1, 'MACIF', '90, rue du Général Ailleret', '97142', 'LES ABYMES', 'MACIF@MACIF.fr', '0452369587'),
(2, 'Harmonie', '57, avenue Jean Portalis', '10000', 'TROYES', 'Harmonie@Harmonie.fr', '0785463259'),
(3, 'Vittavi', '36, Rue St Ferréol', '92360', 'MEUDON-LA-FORÊT', 'Vittavi@Vittavi.fr', '0265321596');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `idPatient` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `nom_naissance` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone_portable` varchar(100) NOT NULL,
  `telephone_fixe` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `adresse1` varchar(250) NOT NULL,
  `adresse2` varchar(250) NOT NULL,
  `code_postal` varchar(6) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `numero-securite_sociale` int(20) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `idMutuelle` int(11) NOT NULL,
  `idPraticien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`idPatient`, `nom`, `prenom`, `sexe`, `nom_naissance`, `date_naissance`, `telephone_portable`, `telephone_fixe`, `email`, `adresse1`, `adresse2`, `code_postal`, `ville`, `pays`, `numero-securite_sociale`, `mot_de_passe`, `idMutuelle`, `idPraticien`) VALUES
(1, 'Porqueres', 'Esteban', 'M', 'Porqueres', '1976-02-25', '0611243500', '', 'esteban@esteban.fr', '13 rue du moulin', '', '12000', 'RODEZ', 'france', 2147483647, 'motDePasse', 2, 2),
(2, 'Chaloux', 'Archard', 'M', 'Chaloux', '1980-11-14', '0754916340', '', 'archard@archard.fr', '75, Square de la Couronne', '', '01100', 'OYONNAX', 'france', 2147483647, 'motDePasse', 1, 3),
(3, 'Benton', 'Estelle', 'M', 'Benton', '1987-10-21', '0145369847', '', 'Estelle@Estelle.fr', '72, boulevard d\'Alsace', '', '92170', 'VANVES', 'france', 2147483647, 'motDePasse', 2, 1),
(4, 'Tessier', 'Odelette', 'F', 'Tessier', '1955-02-04', '0611243500', '', 'Odelette@Odelette.fr', '88, Chemin des Bateliers', '', '73100', 'AIX-LES-BAINS', 'france', 2147483647, 'motDePasse', 3, 2),
(5, 'Ricard', 'Arlette', 'F', 'Ricard', '1992-04-24', '0426985315', '', 'Arlette@Arlette.fr', '28, rue du Faubourg National', '', '65000', 'TARBES', 'france', 2147483647, 'motDePasse', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `praticien`
--

CREATE TABLE `praticien` (
  `idPraticien` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adresse1` varchar(100) NOT NULL,
  `adresse2` varchar(100) NOT NULL,
  `code_postal` varchar(6) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `code_rpps` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `praticien`
--

INSERT INTO `praticien` (`idPraticien`, `nom`, `prenom`, `telephone`, `email`, `adresse1`, `adresse2`, `code_postal`, `ville`, `pays`, `mot_de_passe`, `code_rpps`) VALUES
(1, 'Poulin', 'Léon', '0565352585', 'Léon@Léon.fr', '65, rue Pierre De Coubertin', '', '31200', 'TOULOUSE', 'France', 'motDePasse', 2147483647),
(2, 'Pelletier', 'Raina', '0256348955', 'Raina@Raina.fr', '26, quai Saint-Nicolas', '', '59200', 'TOURCOING', 'France', 'motDePasse', 2147483647),
(3, 'Ruel', 'Amélie', '0485632489', 'Amélie@Amélie.fr', '44, Rue Frédéric Chopin', '', '70000', 'VESOUL', 'France', 'motDePasse', 2147483647);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `idRdv` int(11) NOT NULL,
  `idPatient` int(11) NOT NULL,
  `idPraticien` int(11) NOT NULL,
  `date_heure_debut` datetime NOT NULL,
  `date_heure_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`idRdv`, `idPatient`, `idPraticien`, `date_heure_debut`, `date_heure_fin`) VALUES
(1, 3, 2, '2020-12-20 14:00:00', '2020-12-20 16:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `mutuelle`
--
ALTER TABLE `mutuelle`
  ADD PRIMARY KEY (`idMutuelle`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`idPatient`);

--
-- Index pour la table `praticien`
--
ALTER TABLE `praticien`
  ADD PRIMARY KEY (`idPraticien`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`idRdv`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `mutuelle`
--
ALTER TABLE `mutuelle`
  MODIFY `idMutuelle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `idPatient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `praticien`
--
ALTER TABLE `praticien`
  MODIFY `idPraticien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `idRdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
