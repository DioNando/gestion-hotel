-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 mai 2021 à 09:09
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

DROP TABLE IF EXISTS `archive`;
CREATE TABLE IF NOT EXISTS `archive` (
  `ID_archive` int NOT NULL AUTO_INCREMENT,
  `date_archive` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat_archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_archive`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `archive`
--

INSERT INTO `archive` (`ID_archive`, `date_archive`, `etat_archive`) VALUES
(1, '2021-05-11 10:43:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cardex`
--

DROP TABLE IF EXISTS `cardex`;
CREATE TABLE IF NOT EXISTS `cardex` (
  `ID_cardex` int NOT NULL AUTO_INCREMENT,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(50) NOT NULL,
  `pere_client` varchar(50) NOT NULL,
  `mere_client` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `domicile_habituel` varchar(35) NOT NULL,
  `nationalite` varchar(20) NOT NULL,
  `piece_identite` varchar(20) NOT NULL,
  `num_piece_identite` varchar(25) NOT NULL,
  `date_delivrance` date NOT NULL,
  `lieu_delivrance` varchar(50) NOT NULL,
  `date_fin_validite` date NOT NULL,
  `ID_client` int NOT NULL,
  `etat_cardex` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_cardex`),
  KEY `ID_client` (`ID_client`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cardex`
--

INSERT INTO `cardex` (`ID_cardex`, `date_naissance`, `lieu_naissance`, `pere_client`, `mere_client`, `profession`, `domicile_habituel`, `nationalite`, `piece_identite`, `num_piece_identite`, `date_delivrance`, `lieu_delivrance`, `date_fin_validite`, `ID_client`, `etat_cardex`) VALUES
(1, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 1, 0),
(2, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 2, 0),
(3, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 3, 0),
(4, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 4, 0),
(5, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 5, 0),
(6, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 6, 0),
(7, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 7, 0),
(8, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 8, 0),
(9, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 9, 0),
(10, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 10, 0),
(11, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 11, 0),
(12, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 12, 0),
(13, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 13, 0),
(14, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 14, 0),
(15, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 15, 0),
(16, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 16, 0),
(17, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 17, 0),
(18, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 18, 0),
(19, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 19, 0),
(20, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 20, 0),
(21, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 21, 0),
(22, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 22, 0),
(23, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 23, 0),
(24, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 24, 0),
(25, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 25, 0),
(26, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 26, 0),
(27, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 27, 0),
(28, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 28, 0),
(29, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 29, 0),
(30, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 30, 0),
(31, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 31, 0),
(32, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 32, 0),
(33, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 33, 0),
(34, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 34, 0),
(35, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 35, 0),
(36, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 36, 0),
(37, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 37, 0),
(38, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 38, 0),
(39, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 39, 0),
(40, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 40, 0),
(41, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 41, 0),
(42, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 42, 0),
(43, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 43, 0);

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `ID_chambre` int NOT NULL AUTO_INCREMENT,
  `num_chambre` varchar(50) NOT NULL,
  `statut_chambre` tinytext NOT NULL,
  `tarif_temp` int NOT NULL,
  `tarif_ancien` int NOT NULL,
  `description_chambre` text NOT NULL,
  PRIMARY KEY (`ID_chambre`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`ID_chambre`, `num_chambre`, `statut_chambre`, `tarif_temp`, `tarif_ancien`, `description_chambre`) VALUES
(1, 'A001', 'Libre', 0, 5000, 'Lit simple'),
(2, 'B02', 'En attente', 0, 15000, 'Lit double'),
(3, 'C03', 'En attente', 0, 15000, 'Lit simple\r\nWifi\r\nEau chaude'),
(4, 'C005', 'Occupée', 0, 18000, 'Lit double\r\nWifi\r\nEau chaude'),
(5, 'D15', 'En attente', 0, 8500, 'Lit double'),
(6, 'E15', 'En attente', 0, 5000, 'Se trouve au rez-de-chaussé'),
(7, 'A2', 'En attente', 0, 6000, 'Lit simple'),
(8, 'F4', 'En attente', 0, 8000, 'Lit double séparés'),
(9, 'F12', 'Libre', 0, 11000, 'Lit simple séparés'),
(10, 'G13', 'Libre', 0, 25000, 'Suite royale'),
(11, 'H20', 'En attente', 0, 22500, 'Classe affaire'),
(12, 'E003', 'En attente', 0, 11000, 'Lit simple\r\nWifi\r\nEau chaude'),
(13, 'B15', 'Libre', 0, 9500, 'Vue sur la piscine'),
(14, 'A6', 'Libre', 0, 23000, 'Lit double'),
(15, 'G20', 'Libre', 0, 2000, 'Ne possède pas de lit'),
(16, 'C7', 'Libre', 0, 3500, 'Ne possède pas de douche'),
(17, 'E9', 'Libre', 0, 4700, 'Lit double\r\nSans wifi'),
(18, 'G502', 'Libre', 0, 13000, 'Lit double\r\nSans eau chaude');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `ID_client` int NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(30) NOT NULL,
  `prenom_client` varchar(50) NOT NULL,
  `telephone_client` tinytext NOT NULL,
  PRIMARY KEY (`ID_client`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_client`, `nom_client`, `prenom_client`, `telephone_client`) VALUES
(1, 'Alain', 'Jules', '+1 (181) 332-1869'),
(2, 'Agathe', 'Claire', '+1 (659) 322-9308'),
(3, 'Guillaume', 'Ber', '+1 (862) 952-8281'),
(4, 'Alexandre', 'Morgan', '+1 (645) 579-7935'),
(5, 'Julia', 'Esma', '+1 (617) 716-1939'),
(6, 'Mael', 'Ulrich', '+1 (588) 893-1153'),
(7, 'Hugo', 'Thomas', '+1 (288) 795-9254'),
(8, 'Mathilde', 'Noemie', '+1 (805) 224-8514'),
(9, 'Yasmine', 'Candice', '+1 (378) 319-4684'),
(10, 'Tony', 'Paul', '+1 (325) 892-9676'),
(11, 'Carla', 'Clara', '+1 (454) 381-1169'),
(12, 'Pierre', 'Rafael', '+1 (663) 888-4798'),
(13, 'Victoire', 'Camille', '+1 (965) 275-5713'),
(14, 'Claude', 'Math', '+1 (592) 746-2184'),
(15, 'Mathéo', 'Logan', '+1 (814) 227-4138'),
(16, 'Arthur', 'Morgan', '+1 (477) 647-7554'),
(17, 'Yann', 'Maxime', '+1 (845) 124-9057'),
(18, 'Elise', 'Lucy', '+1 (369) 202-5903'),
(19, 'Clemence', 'Lucile', '+1 (585) 229-7409'),
(20, 'Olivia', 'Chloe', '+1 (616) 831-3928'),
(21, 'Anais', 'Celia', '+1 (308) 514-4872'),
(22, 'Sasha', 'Axel', '+1 (533) 446-1997'),
(23, 'Clement', 'Constance', '+1 (706) 265-1414'),
(24, 'François', 'Greg', '+1 (944) 877-9031'),
(25, 'Jean', 'Kevin', '+1 (574) 283-4212'),
(26, 'Alexis', 'Bryan', '+1 (175) 119-9699'),
(27, 'Sarah', 'Zoe', '+1 (153) 325-6701'),
(28, 'Jade', 'Rose', '+1 (273) 617-8925'),
(29, 'Antonin', 'Victor', '+1 (908) 744-3378'),
(30, 'Leonie', 'Lola', '+1 (136) 255-5432'),
(31, 'Dylan', 'Florian', '+1 (554) 864-6683'),
(32, 'Ayoub', 'Valentin', '+1 (793) 606-5689'),
(33, 'Laura', 'Elo', '+1 (891) 158-7549'),
(34, 'Enzo', 'Quentin', '+1 (318) 491-3236'),
(35, 'Elodie', 'Seraphine', '+1 (723) 568-8549'),
(36, 'Xavier', 'Charles', '+1 (375) 862-8212'),
(37, 'Benjamin', 'Gaspard', '+1 (893) 286-7115'),
(38, 'Morganne', 'Ambre', '+1 (361) 378-3052'),
(39, 'Audrey', 'Julia', '+1 (317) 974-1349'),
(40, 'Julien', 'Claude', '+1 (356) 147-2212'),
(41, 'Elsa', 'Inès', '+1 (408) 853-6051'),
(42, 'Tom', 'Evan', '+1 (302) 579-1374'),
(43, 'Amelie', 'Romane', '+1 (686) 634-8534');

-- --------------------------------------------------------

--
-- Structure de la table `concerner`
--

DROP TABLE IF EXISTS `concerner`;
CREATE TABLE IF NOT EXISTS `concerner` (
  `ID_chambre` int NOT NULL,
  `ID_planning` int NOT NULL,
  `ID_archive` int NOT NULL,
  `lit_sup` int NOT NULL,
  `tarif_lit_sup` int NOT NULL,
  PRIMARY KEY (`ID_chambre`,`ID_planning`,`ID_archive`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `concerner`
--

INSERT INTO `concerner` (`ID_chambre`, `ID_planning`, `ID_archive`, `lit_sup`, `tarif_lit_sup`) VALUES
(2, 103, 1, 0, 0),
(2, 111, 1, 0, 0),
(4, 104, 1, 0, 0),
(5, 110, 1, 1, 1500),
(6, 105, 1, 0, 0),
(7, 107, 1, 1, 2500),
(8, 107, 1, 0, 0),
(11, 106, 1, 0, 0),
(12, 109, 1, 2, 3000),
(13, 111, 1, 0, 0),
(18, 108, 1, 0, 0),
(18, 111, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion` (
  `ID_connexion` int NOT NULL AUTO_INCREMENT,
  `date_connexion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_deconnexion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_user` int NOT NULL,
  `etat_connexion` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_connexion`),
  KEY `ID_user` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`ID_connexion`, `date_connexion`, `ID_user`, `etat_connexion`) VALUES
(1, '2021-05-11 09:09:52', 25, 0),
(2, '2021-05-11 09:11:10', 5, 0),
(3, '2021-05-11 09:11:24', 8, 0),
(4, '2021-05-11 09:20:42', 50, 0),
(5, '2021-05-11 09:21:20', 30, 0),
(6, '2021-05-11 09:27:47', 1, 0),
(7, '2021-05-11 09:29:57', 8, 0),
(8, '2021-05-11 10:05:25', 51, 0),
(9, '2021-05-11 10:42:51', 1, 1),
(10, '2021-05-11 12:08:09', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `effectuer`
--

DROP TABLE IF EXISTS `effectuer`;
CREATE TABLE IF NOT EXISTS `effectuer` (
  `ID_user` int NOT NULL,
  `ID_nuit` int NOT NULL,
  `ID_day` int NOT NULL,
  `nom_user_modif` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_user`,`ID_nuit`,`ID_day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `effectuer`
--

INSERT INTO `effectuer` (`ID_user`, `ID_nuit`, `ID_day`, `nom_user_modif`) VALUES
(1, 0, 49, 'Dio'),
(1, 0, 50, 'Dio'),
(1, 0, 51, 'Dio'),
(1, 0, 52, 'Dio'),
(1, 69, 0, 'Dio'),
(1, 70, 0, 'Dio'),
(1, 71, 0, 'Dio'),
(1, 72, 0, 'Dio'),
(1, 73, 0, 'Dio');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `ID_etat_reservation` int NOT NULL AUTO_INCREMENT,
  `etat_client` tinyint(1) NOT NULL,
  `confirmation_reservation` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_etat_reservation`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`ID_etat_reservation`, `etat_client`, `confirmation_reservation`) VALUES
(1, 1, 1),
(2, 0, 1),
(3, 0, 0),
(4, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `facture_day`
--

DROP TABLE IF EXISTS `facture_day`;
CREATE TABLE IF NOT EXISTS `facture_day` (
  `ID_facture_day` int NOT NULL AUTO_INCREMENT,
  `date_facture_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `somme_donne_day` int NOT NULL,
  `type_payement_day` varchar(50) NOT NULL,
  `ID_day` int NOT NULL,
  PRIMARY KEY (`ID_facture_day`),
  KEY `ID_day` (`ID_day`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture_day`
--

INSERT INTO `facture_day` (`ID_facture_day`, `date_facture_day`, `somme_donne_day`, `type_payement_day`, `ID_day`) VALUES
(1, '2021-05-11 00:00:00', 31500, 'Autre', 49),
(2, '2021-05-11 10:45:40', 0, 'Autre', 50),
(3, '2021-05-11 10:46:17', 0, 'Autre', 51),
(4, '2021-05-11 00:00:00', 50000, 'VISA', 52);

-- --------------------------------------------------------

--
-- Structure de la table `facture_nuit`
--

DROP TABLE IF EXISTS `facture_nuit`;
CREATE TABLE IF NOT EXISTS `facture_nuit` (
  `ID_facture_nuit` int NOT NULL AUTO_INCREMENT,
  `date_facture_nuit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `offert` tinyint(1) NOT NULL,
  `remise` int NOT NULL,
  `somme_donne_nuit` int NOT NULL,
  `type_payement_nuit` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ID_nuit` int NOT NULL,
  PRIMARY KEY (`ID_facture_nuit`),
  KEY `ID_nuit` (`ID_nuit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture_nuit`
--

INSERT INTO `facture_nuit` (`ID_facture_nuit`, `offert`, `remise`, `somme_donne_nuit`, `type_payement_nuit`, `ID_nuit`) VALUES
(1, 0, 5, 15000, 'Cheque', 69),
(2, 0, 0, 0, 'Autre', 70),
(3, 0, 12, 0, 'Autre', 71),
(4, 0, 0, 20000, 'Autre', 72),
(5, 0, 7, 160000, 'Espece', 73);

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

DROP TABLE IF EXISTS `planning`;
CREATE TABLE IF NOT EXISTS `planning` (
  `ID_planning` int NOT NULL AUTO_INCREMENT,
  `debut_sejour` date NOT NULL,
  `fin_sejour` date NOT NULL,
  `heure_arrive` time NOT NULL,
  `heure_depart` time NOT NULL,
  `motif` tinytext NOT NULL,
  PRIMARY KEY (`ID_planning`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`ID_planning`, `debut_sejour`, `fin_sejour`, `heure_arrive`, `heure_depart`, `motif`) VALUES
(103, '2021-05-11', '2021-05-11', '11:44:00', '13:47:00', 'Day use'),
(104, '2021-05-11', '2021-05-11', '08:45:00', '14:50:00', 'Day use'),
(105, '2021-05-11', '2021-05-11', '09:45:00', '10:45:00', 'Day use'),
(106, '2021-05-11', '2021-05-11', '15:00:00', '21:00:00', 'Day use'),
(107, '2021-05-11', '2021-05-14', '00:00:00', '00:00:00', 'Nuitée'),
(108, '2021-05-13', '2021-05-15', '00:00:00', '00:00:00', 'Nuitée'),
(109, '2021-05-11', '2021-05-16', '00:00:00', '00:00:00', 'Nuitée'),
(110, '2021-05-11', '2021-05-12', '00:00:00', '00:00:00', 'Nuitée'),
(111, '2021-05-13', '2021-05-18', '00:00:00', '00:00:00', 'Nuitée');

-- --------------------------------------------------------

--
-- Structure de la table `pour`
--

DROP TABLE IF EXISTS `pour`;
CREATE TABLE IF NOT EXISTS `pour` (
  `ID_planning` int NOT NULL,
  `ID_nuit` int NOT NULL,
  `ID_day` int NOT NULL,
  PRIMARY KEY (`ID_planning`,`ID_nuit`,`ID_day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pour`
--

INSERT INTO `pour` (`ID_planning`, `ID_nuit`, `ID_day`) VALUES
(103, 0, 49),
(104, 0, 50),
(105, 0, 51),
(106, 0, 52),
(107, 69, 0),
(108, 70, 0),
(109, 71, 0),
(110, 72, 0),
(111, 73, 0);

-- --------------------------------------------------------

--
-- Structure de la table `relier`
--

DROP TABLE IF EXISTS `relier`;
CREATE TABLE IF NOT EXISTS `relier` (
  `ID_archive` int NOT NULL,
  `ID_chambre` int NOT NULL,
  `tarif_chambre` int NOT NULL,
  PRIMARY KEY (`ID_archive`,`ID_chambre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relier`
--

INSERT INTO `relier` (`ID_archive`, `ID_chambre`, `tarif_chambre`) VALUES
(1, 1, 5000),
(1, 2, 15000),
(1, 3, 15000),
(1, 4, 18000),
(1, 5, 8500),
(1, 6, 5000),
(1, 7, 6000),
(1, 8, 8000),
(1, 9, 11000),
(1, 10, 25000),
(1, 11, 22500),
(1, 12, 11000),
(1, 13, 9500),
(1, 14, 23000),
(1, 15, 2000),
(1, 16, 3500),
(1, 17, 4700),
(1, 18, 13000);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_day`
--

DROP TABLE IF EXISTS `reservation_day`;
CREATE TABLE IF NOT EXISTS `reservation_day` (
  `ID_day` int NOT NULL AUTO_INCREMENT,
  `nom_client_day` varchar(50) NOT NULL,
  `duree_day` tinyint NOT NULL,
  `date_reservation_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentaire_day` mediumtext NOT NULL,
  PRIMARY KEY (`ID_day`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation_day`
--

INSERT INTO `reservation_day` (`ID_day`, `nom_client_day`, `duree_day`, `date_reservation_day`, `commentaire_day`) VALUES
(49, 'Maxime', 2, '2021-05-11 10:45:01', ''),
(50, 'Alice', 6, '2021-05-11 10:45:40', ''),
(51, 'Youssouf', 1, '2021-05-11 10:46:17', ''),
(52, 'Claire', 6, '2021-05-11 10:46:58', '');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_nuit`
--

DROP TABLE IF EXISTS `reservation_nuit`;
CREATE TABLE IF NOT EXISTS `reservation_nuit` (
  `ID_nuit` int NOT NULL AUTO_INCREMENT,
  `nbr_personne` int NOT NULL,
  `nbr_nuit` int NOT NULL,
  `type_reservation` varchar(50) NOT NULL,
  `ID_client` int NOT NULL,
  `ID_etat_reservation` int NOT NULL,
  `remarque_reservation` text NOT NULL,
  `date_reservation_nuit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification_nuit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `venant_de` varchar(50) NOT NULL,
  `allant_a` varchar(50) NOT NULL,
  `mode_transport` varchar(50) NOT NULL,
  `commentaire_nuit` mediumtext NOT NULL,
  PRIMARY KEY (`ID_nuit`),
  KEY `ID_client` (`ID_client`),
  KEY `ID_etat_reservation` (`ID_etat_reservation`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation_nuit`
--

INSERT INTO `reservation_nuit` (`ID_nuit`, `nbr_personne`, `nbr_nuit`, `type_reservation`, `ID_client`, `ID_etat_reservation`, `remarque_reservation`, `date_reservation_nuit`, `venant_de`, `allant_a`, `mode_transport`, `commentaire_nuit`) VALUES
(69, 3, 3, 'Téléphone', 20, 3, '', '2021-05-11 10:49:48', '', '', '', ''),
(70, 1, 2, 'Mail', 1, 2, 'Voyage d\'affaire', '2021-05-11 10:51:04', '', '', '', ''),
(71, 4, 5, 'Réception', 31, 1, 'Eau chaude à l\'arrivée prêt  ', '2021-05-11 10:53:18', '', '', '', ''),
(72, 2, 1, 'Téléphone', 5, 3, '', '2021-05-11 10:54:22', '', '', '', ''),
(73, 5, 5, 'Mail', 6, 1, 'Lit supplémentaire nécessaire', '2021-05-11 10:56:43', '', '', 'Auto', 'Transfert de la chambre 3 à la chambre 13');

-- --------------------------------------------------------

--
-- Structure de la table `stocker`
--

DROP TABLE IF EXISTS `stocker`;
CREATE TABLE IF NOT EXISTS `stocker` (
  `ID_historique` int NOT NULL,
  `ID_client` int NOT NULL,
  `ID_reservation` int NOT NULL,
  PRIMARY KEY (`ID_historique`,`ID_client`,`ID_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `droit_user` tinytext NOT NULL,
  `mdp_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID_user`, `nom_user`, `prenom_user`, `droit_user`, `mdp_user`) VALUES
(1, 'Dio', 'Nando', 'Administrateur', '$2y$10$lX7Mt6HaT5Xt40WbUhLYM..3.EGRfFll9HbgnXS7w.IpF9o49dkQi'),
(5, 'Live', 'Chico', 'Administrateur', '$2y$10$lZGfoF/m0SEyKPPnn5vt4unmfJQba4aa6CbLqteYZdCtzNSdT5mSi'),
(8, 'Annie', 'Leon', 'Controleur', '$2y$10$LfKA86Yb22/GTyyaEjEQ6O/zGmMpsirPTiMtUv3zYecZn.nxKDPHe'),
(11, 'Ben', 'Hur', 'Utilisateur', '$2y$10$7K7ZG7fSMDxfTFnX0vy2tO0OicgfyxljvsywpKxO2ntpn.bGTKgy.'),
(22, 'Remi', 'Marh', 'Controleur', '$2y$10$1zfJCREX26ke/IH4c55iFuJgWc4hVd22XndCtrQ0rNhTqurVAhPs2'),
(25, 'Admin', 'Admin', 'Administrateur', '$2y$10$LdPGFxoG.dRLrHJs0TYRUuyWStmv16g36ZMBEzGCKMrr1t8JSiVRS'),
(30, 'Contro', 'Contro', 'Controleur', '$2y$10$kvNZ7142C1J5pALHtA7bSecvaNYgpwPG19Jo9UuRxNW/IgYvVvS3W'),
(50, 'User', 'User', 'Utilisateur', '$2y$10$4edOOcetFPMpSmotKTQjs.JkJovO7xomcVxXRZxsDsADlKEV9O2ji'),
(51, 'Orel', 'San', 'Utilisateur', '$2y$10$Y7CmWWAA.3knQkUciX8TEOBS2JAoVtwtk2ptO5g1bT/CqQ5J/nyhe'),
(56, 'Yuri', 'On', 'Utilisateur', '$2y$10$gbAPUuWfC52yn1SKoULowu7osesLFhdWVCA8WU8iASn1MTVkX1OMy');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
