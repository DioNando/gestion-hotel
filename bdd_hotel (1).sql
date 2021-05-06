-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 mai 2021 à 17:42
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `archive`
--

INSERT INTO `archive` (`ID_archive`, `date_archive`, `etat_archive`) VALUES
(1, '2021-05-03 09:17:14', 0),
(2, '2021-05-03 09:17:24', 0),
(3, '2021-05-03 09:20:50', 0),
(4, '2021-05-03 09:20:52', 0),
(5, '2021-05-03 09:50:31', 0),
(6, '2021-05-03 10:12:54', 0),
(7, '2021-05-03 14:50:51', 0),
(8, '2021-05-03 14:51:43', 0),
(15, '2021-05-04 11:16:36', 0),
(16, '2021-05-04 11:26:24', 0),
(17, '2021-05-04 11:26:51', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cardex`
--

INSERT INTO `cardex` (`ID_cardex`, `date_naissance`, `lieu_naissance`, `pere_client`, `mere_client`, `profession`, `domicile_habituel`, `nationalite`, `piece_identite`, `num_piece_identite`, `date_delivrance`, `lieu_delivrance`, `date_fin_validite`, `ID_client`, `etat_cardex`) VALUES
(1, '2021-04-14', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 80, 1),
(2, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 102, 0),
(3, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 104, 0),
(4, '1998-02-20', 'Merc', 'Morc', 'Mirc', 'Etudiant', 'La cité', 'Malagasy', 'CIN', '30115949664946121', '2016-06-16', 'WeK', '2021-04-30', 105, 1),
(5, '1999-02-12', 'Tam', 'Kobe', 'Kiba', 'Au DD', 'Paname', 'Terrien', 'Navigo', '611', '2007-11-03', 'Pom', '2024-12-31', 106, 0),
(6, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 107, 0),
(7, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 108, 0),
(8, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 109, 0),
(9, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 110, 0),
(10, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 111, 0),
(11, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 112, 0),
(12, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 113, 0),
(14, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 115, 0),
(15, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 116, 0),
(16, '2021-04-29', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 117, 1),
(17, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 118, 1),
(18, '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', 119, 0);

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `ID_chambre` int NOT NULL AUTO_INCREMENT,
  `statut_chambre` tinytext NOT NULL,
  PRIMARY KEY (`ID_chambre`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`ID_chambre`, `statut_chambre`) VALUES
(1, 'Occupée'),
(2, 'Libre'),
(3, 'Occupée'),
(4, 'Occupée'),
(5, 'En attente'),
(6, 'Libre'),
(7, 'Occupée'),
(8, 'Occupée'),
(9, 'Libre'),
(10, 'En attente'),
(11, 'En attente'),
(12, 'Libre'),
(13, 'En attente'),
(14, 'Libre'),
(15, 'Occupée'),
(16, 'Occupée'),
(17, 'Occupée'),
(18, 'En attente'),
(19, 'Occupée'),
(20, 'Libre'),
(21, 'Libre'),
(22, 'Libre'),
(23, 'Occupée'),
(24, 'Occupée'),
(25, 'Libre'),
(26, 'Occupée'),
(27, 'En attente');

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
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_client`, `nom_client`, `prenom_client`, `telephone_client`) VALUES
(1, 'Levi', 'Love', '+1 (859) 439-7652'),
(2, 'Jinx', 'Jinx', '888'),
(8, 'One', 'Punch', ''),
(10, 'Homer', 'Simpson', ''),
(11, 'Luffy', 'Mugi', ''),
(12, 'Kal', 'Cool', ''),
(14, 'Id nesciunt occaeca', 'Molestiae fugiat mol', ''),
(16, 'Rem dolore quaerat a', 'Dolorum sed sint mi', ''),
(17, 'Animi sit aliqua ', 'Nostrum a ullam elit', ''),
(19, 'bbbbb', 'bbbbb', ''),
(20, 'Bonne', 'Nuit', ''),
(21, 'Bon', 'Jour', ''),
(22, 'GGG', 'EZZZ', ''),
(23, 'alive', 'yeah', ''),
(24, 'yessss', 'noooo', ''),
(26, 'zfzfa', 'fzefze', ''),
(28, 'FISHHH', 'TIGERR', ''),
(29, 'Last', 'Jedi', ''),
(30, 'zfzfz', 'fegzee', ''),
(31, 'GGGG', 'EZZZZZ', ''),
(32, 'JIMMM', 'Tresss', ''),
(33, 'AZAEA', 'azzfe', ''),
(34, 'skflsjfsf', 'ffkmjefef', ''),
(35, 'zfzfzf', 'fezfeff', ''),
(36, 'zfzfzfzfzff', 'fezfeff', ''),
(37, 'zfzfzfzfzff', 'fezfeff', ''),
(38, 'rrrrrrrrr&', 'feefeef', ''),
(39, 'fzggee', 'efefefe', ''),
(40, 'Test', 'Reset', ''),
(43, 'Vin', 'Sanji', ''),
(45, 'Armin', 'Arlet', ''),
(50, 'dgsdgds', 'jtjtrtr', '+1 (879) 988-8287'),
(51, 'dggr', 'ehehe', ''),
(52, '96666', 'Nyan', ''),
(53, 'Homz', 'land', ''),
(56, 'fzfzfzzzz', 'fegegegerg', ''),
(57, 'Kali', 'Linux', ''),
(58, 'Arsh', 'Jinnn', ''),
(59, 'Kylian', 'Mbappe', ''),
(60, 'Alex', 'Caruso', ''),
(61, 'Tray', 'Young', ''),
(62, 'Bob', 'Marley', '+1 (211) 603-6114'),
(63, 'Pre', 'Malone', '+1 (301) 586-3997'),
(64, 'Bron', 'Bronny', ''),
(67, 'Jaaaam', 'Rooock', ''),
(68, 'Tom', 'Hanks', '+1 (917) 964-9389'),
(69, 'fgege', 'zfeege', ''),
(70, 'zefjele', 'pjegepgzeg', ''),
(72, 'erregerge', 'gegergg', ''),
(73, 'Rachel', 'Mendes', '+1 (911) 472-9306'),
(76, 'zgjekmgj', 'fkfeef', ''),
(77, 'Jimbo', 'Chum', ''),
(79, 'Orion', 'Star', '+1 (639) 525-2201'),
(80, 'Bran', 'J', '+1 (639) 525-2201'),
(81, 'Jerry', 'Holmes', '+1 (639) 525-2201'),
(82, 'Basta', 'Puma', '+1 (911) 472-9306'),
(84, 'Gun', 'B', '+1 (324) 236-9796'),
(86, 'Yo', 'Yeah', '+1 (405) 479-6273'),
(88, 'Mac', 'Book', '48464'),
(92, 'grgr', 'rrrr', '56'),
(93, 'Yuuu', 'gggg', '+1 (911) 472-9306'),
(94, 'Bugs', 'Bunny', '1324567'),
(95, 'USH', 'MASH', '789'),
(96, 'Cardi', 'Ex', ''),
(97, 'Cardio', 'Pop', ''),
(98, 'Rom', 'Ram', ''),
(99, 'Tsunami', 'Bra', ''),
(102, 'Dua', 'Lipa', ''),
(104, 'Rome', 'Toma', '321548'),
(105, 'Marc', 'Murc', '+1 (324) 236-9796'),
(106, 'Koba', 'La D', '78945'),
(107, 'Ma', 'Guy', '0320012399'),
(108, 'Jon', 'Bovin', '987'),
(110, 'Kra', 'Tos', '4567'),
(111, 'Steve', 'Brad', '45687'),
(112, 'Khalid', 'Wiz', '147'),
(113, 'Eva', 'Ivo', '15916'),
(116, 'Kata', 'Kama', '456498'),
(117, 'Gia', 'Der', '+1 (911) 472-9306'),
(118, 'Seth', 'Carl', '56484848'),
(119, 'Mik', 'Red', '2191191981'),
(120, 'Ico', 'Ne', '4564489'),
(121, 'Kyle', 'Ub', '+1 (639) 525-2201'),
(122, 'Tony', 'Montanna', '667');

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
(1, 45, 8, 0, 0),
(1, 74, 8, 1, 320),
(2, 45, 8, 0, 0),
(2, 57, 8, 0, 0),
(2, 58, 8, 0, 0),
(2, 64, 8, 0, 0),
(2, 71, 8, 0, 0),
(4, 66, 8, 0, 0),
(5, 73, 8, 0, 0),
(6, 13, 8, 0, 0),
(6, 45, 8, 0, 0),
(6, 72, 8, 0, 0),
(7, 6, 8, 0, 0),
(7, 65, 8, 3, 100),
(7, 74, 8, 1, 50),
(7, 75, 8, 0, 0),
(8, 65, 8, 0, 0),
(8, 81, 17, 0, 0),
(9, 69, 8, 0, 0),
(10, 53, 8, 0, 0),
(10, 73, 8, 0, 0),
(10, 81, 17, 3, 630),
(11, 52, 8, 0, 0),
(11, 74, 8, 0, 0),
(13, 6, 8, 0, 0),
(15, 53, 8, 0, 0),
(15, 77, 8, 0, 0),
(16, 54, 8, 0, 0),
(17, 9, 8, 0, 0),
(18, 81, 17, 0, 0),
(21, 6, 8, 0, 0),
(22, 54, 8, 0, 0),
(23, 6, 8, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`ID_connexion`, `date_connexion`, `ID_user`, `etat_connexion`) VALUES
(1, '2021-04-11 10:57:02', 1, 0),
(2, '2021-04-11 11:09:17', 1, 0),
(4, '2021-04-11 11:13:29', 1, 0),
(5, '2021-04-11 11:13:45', 1, 0),
(6, '2021-04-11 11:25:23', 1, 0),
(8, '2021-04-11 12:46:29', 1, 0),
(9, '2021-04-11 12:59:54', 1, 0),
(10, '2021-04-11 14:30:04', 1, 1),
(11, '2021-04-11 14:48:22', 1, 0),
(13, '2021-04-11 16:04:04', 1, 0),
(14, '2021-04-11 16:15:45', 1, 0),
(15, '2021-04-11 16:29:53', 1, 0),
(16, '2021-04-11 16:32:29', 1, 0),
(17, '2021-04-11 16:32:43', 1, 1),
(18, '2021-04-11 16:36:53', 1, 1),
(19, '2021-04-11 16:45:57', 1, 1),
(20, '2021-04-11 20:57:36', 1, 1),
(21, '2021-04-11 23:26:42', 1, 1),
(22, '2021-04-12 08:31:39', 1, 0),
(23, '2021-04-12 08:59:13', 1, 0),
(24, '2021-04-12 09:40:15', 1, 0),
(31, '2021-04-12 10:59:21', 1, 0),
(32, '2021-04-12 11:12:41', 1, 1),
(33, '2021-04-12 14:14:39', 1, 1),
(34, '2021-04-13 08:24:41', 1, 1),
(35, '2021-04-13 08:49:10', 1, 0),
(36, '2021-04-13 11:48:53', 1, 1),
(37, '2021-04-13 11:53:35', 1, 1),
(38, '2021-04-13 11:59:06', 1, 1),
(39, '2021-04-13 14:16:17', 1, 1),
(40, '2021-04-13 14:16:56', 1, 1),
(41, '2021-04-13 16:16:52', 1, 1),
(42, '2021-04-13 16:24:51', 1, 0),
(43, '2021-04-13 16:48:22', 1, 0),
(44, '2021-04-13 16:51:37', 1, 0),
(45, '2021-04-13 17:06:22', 1, 0),
(46, '2021-04-13 17:26:25', 1, 1),
(47, '2021-04-13 19:30:01', 1, 1),
(48, '2021-04-14 08:18:27', 1, 0),
(49, '2021-04-14 10:58:31', 1, 0),
(51, '2021-04-14 11:04:29', 1, 0),
(52, '2021-04-14 11:10:38', 46, 0),
(53, '2021-04-14 11:10:48', 1, 0),
(54, '2021-04-14 11:15:29', 49, 0),
(55, '2021-04-14 11:15:50', 1, 0),
(56, '2021-04-14 14:23:05', 1, 0),
(57, '2021-04-14 14:33:08', 1, 0),
(58, '2021-04-14 14:33:27', 50, 0),
(59, '2021-04-14 16:28:52', 1, 0),
(60, '2021-04-15 08:18:51', 1, 0),
(61, '2021-04-15 08:26:02', 1, 0),
(62, '2021-04-15 10:39:13', 1, 0),
(63, '2021-04-15 10:43:09', 1, 0),
(64, '2021-04-15 14:25:02', 1, 0),
(65, '2021-04-16 08:17:51', 1, 0),
(66, '2021-04-16 09:32:34', 1, 0),
(67, '2021-04-16 09:42:27', 1, 1),
(68, '2021-04-16 11:52:27', 1, 1),
(69, '2021-04-16 14:18:03', 1, 0),
(70, '2021-04-16 15:39:50', 1, 0),
(71, '2021-04-16 17:32:23', 1, 1),
(72, '2021-04-17 09:16:53', 1, 0),
(73, '2021-04-17 09:51:30', 1, 1),
(74, '2021-04-19 08:15:24', 1, 1),
(75, '2021-04-19 09:17:51', 1, 1),
(76, '2021-04-19 10:05:56', 1, 1),
(77, '2021-04-19 10:21:15', 1, 1),
(78, '2021-04-20 08:16:34', 1, 0),
(79, '2021-04-20 09:50:11', 8, 0),
(80, '2021-04-20 09:50:48', 22, 0),
(81, '2021-04-20 09:51:26', 8, 0),
(82, '2021-04-20 10:07:25', 11, 0),
(83, '2021-04-20 10:07:36', 22, 0),
(84, '2021-04-20 10:10:06', 11, 0),
(85, '2021-04-20 10:10:21', 22, 0),
(86, '2021-04-20 10:11:17', 22, 0),
(87, '2021-04-20 10:11:28', 1, 0),
(88, '2021-04-20 10:12:01', 1, 1),
(89, '2021-04-20 11:27:01', 1, 0),
(90, '2021-04-20 14:15:11', 1, 1),
(91, '2021-04-21 08:24:05', 1, 0),
(92, '2021-04-21 09:55:53', 22, 1),
(93, '2021-04-21 14:20:03', 1, 0),
(94, '2021-04-21 16:50:07', 1, 1),
(95, '2021-04-22 08:58:02', 1, 0),
(96, '2021-04-22 09:13:06', 5, 0),
(97, '2021-04-22 09:13:26', 1, 0),
(98, '2021-04-22 09:13:49', 5, 1),
(99, '2021-04-22 09:14:25', 1, 1),
(100, '2021-04-22 14:14:50', 1, 1),
(101, '2021-04-22 15:18:29', 1, 1),
(102, '2021-04-23 08:14:03', 1, 1),
(103, '2021-04-23 09:08:31', 1, 1),
(104, '2021-04-23 09:37:26', 1, 1),
(105, '2021-04-23 10:00:25', 1, 1),
(106, '2021-04-23 10:04:55', 1, 1),
(107, '2021-04-23 12:01:50', 1, 1),
(108, '2021-04-23 19:58:29', 1, 1),
(109, '2021-04-23 20:33:18', 1, 1),
(110, '2021-04-23 21:17:06', 1, 1),
(111, '2021-04-24 14:52:37', 1, 1),
(112, '2021-04-26 14:44:26', 1, 1),
(113, '2021-04-26 17:07:56', 1, 1),
(114, '2021-04-26 18:28:59', 1, 0),
(115, '2021-04-26 20:24:20', 1, 1),
(116, '2021-04-27 08:13:06', 1, 0),
(117, '2021-04-27 11:09:20', 25, 1),
(118, '2021-04-27 11:18:38', 1, 0),
(119, '2021-04-27 13:56:44', 1, 1),
(120, '2021-04-27 19:47:43', 1, 1),
(121, '2021-04-28 08:10:27', 1, 0),
(122, '2021-04-28 08:33:43', 1, 0),
(123, '2021-04-28 08:33:59', 1, 0),
(124, '2021-04-28 08:34:25', 30, 0),
(125, '2021-04-28 08:35:00', 1, 1),
(126, '2021-04-28 15:31:46', 1, 1),
(127, '2021-04-28 15:43:27', 1, 0),
(128, '2021-04-28 17:12:42', 1, 1),
(129, '2021-04-29 08:29:30', 1, 1),
(130, '2021-04-29 12:03:39', 1, 1),
(131, '2021-04-29 14:17:34', 1, 1),
(132, '2021-04-29 15:54:47', 1, 1),
(133, '2021-04-29 17:12:23', 1, 1),
(134, '2021-04-29 17:14:02', 1, 0),
(135, '2021-04-29 18:51:41', 1, 1),
(136, '2021-04-29 20:12:03', 1, 1),
(137, '2021-04-29 21:13:47', 1, 1),
(138, '2021-04-29 22:06:37', 1, 1),
(139, '2021-04-29 22:08:40', 1, 1),
(140, '2021-04-29 22:29:41', 1, 1),
(141, '2021-04-29 23:00:17', 1, 1),
(142, '2021-04-29 23:23:40', 1, 1),
(143, '2021-04-29 23:30:26', 1, 0),
(144, '2021-04-30 00:07:04', 1, 1),
(145, '2021-04-30 00:19:51', 1, 0),
(146, '2021-04-30 08:32:35', 1, 1),
(147, '2021-04-30 08:53:18', 1, 0),
(148, '2021-04-30 10:40:12', 1, 1),
(149, '2021-04-30 11:24:06', 1, 0),
(150, '2021-04-30 13:46:02', 1, 0),
(151, '2021-04-30 17:28:29', 1, 1),
(152, '2021-04-30 22:13:03', 1, 1),
(153, '2021-04-30 22:55:33', 1, 1),
(154, '2021-04-30 23:53:12', 1, 0),
(155, '2021-05-01 00:20:31', 1, 0),
(156, '2021-05-01 00:25:37', 53, 0),
(157, '2021-05-01 00:25:45', 54, 0),
(158, '2021-05-04 10:06:00', 1, 0),
(159, '2021-05-04 15:12:22', 1, 0),
(160, '2021-05-04 20:17:59', 1, 0);

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
(1, 0, 11, 'Dio'),
(1, 0, 12, 'Dio'),
(1, 0, 13, 'Dio'),
(1, 0, 14, 'Dio'),
(1, 0, 16, 'Dio'),
(1, 0, 18, 'Dio'),
(1, 0, 19, 'Dio'),
(1, 0, 20, 'Dio'),
(1, 0, 21, 'Dio'),
(1, 0, 22, 'Jhon'),
(1, 0, 23, 'Dio'),
(1, 0, 24, 'Dio'),
(1, 0, 25, 'Dio'),
(1, 0, 26, 'Dio'),
(1, 0, 27, 'Dio'),
(1, 0, 28, 'Dio'),
(1, 0, 29, 'Dio'),
(1, 0, 30, 'Dio'),
(1, 0, 31, 'Dio'),
(1, 0, 32, 'Dio'),
(1, 0, 33, 'Dio'),
(1, 0, 34, 'Dio'),
(1, 0, 36, 'Dio'),
(1, 0, 37, 'Dio'),
(1, 0, 38, 'Dio'),
(1, 0, 39, 'Dio'),
(1, 5, 0, 'Dio'),
(1, 6, 0, 'Dio'),
(1, 7, 0, 'Dio'),
(1, 8, 0, 'Dio'),
(1, 9, 0, 'Dio'),
(1, 10, 0, 'Dio'),
(1, 11, 0, 'Dio'),
(1, 12, 0, 'Dio'),
(1, 13, 0, 'Dio'),
(1, 14, 0, 'Dio'),
(1, 15, 0, 'Dio'),
(1, 16, 0, 'Dio'),
(1, 23, 0, 'Dio'),
(1, 24, 0, 'Dio'),
(1, 25, 0, 'Dio'),
(1, 26, 0, 'Dio'),
(1, 27, 0, 'Dio'),
(1, 28, 0, 'Dio'),
(1, 29, 0, 'Dio'),
(1, 30, 0, 'Dio'),
(1, 32, 0, 'Jhon'),
(1, 33, 0, 'Dio'),
(1, 34, 0, 'Dio'),
(1, 35, 0, 'Dio'),
(1, 36, 0, 'Dio'),
(1, 37, 0, 'Dio'),
(1, 38, 0, 'Dio'),
(1, 39, 0, 'Dio'),
(1, 40, 0, 'Dio'),
(1, 41, 0, 'Dio'),
(1, 42, 0, 'Dio'),
(1, 43, 0, 'Dio'),
(1, 44, 0, 'Dio'),
(1, 45, 0, 'Dio'),
(1, 46, 0, 'Dio'),
(1, 47, 0, 'Dio'),
(1, 48, 0, 'Dio'),
(1, 50, 0, 'Dio'),
(1, 51, 0, 'Dio'),
(1, 56, 0, 'Dio');

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
  `type_payement_day` varchar(50) NOT NULL,
  `ID_day` int NOT NULL,
  PRIMARY KEY (`ID_facture_day`),
  KEY `ID_day` (`ID_day`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture_day`
--

INSERT INTO `facture_day` (`ID_facture_day`, `date_facture_day`, `type_payement_day`, `ID_day`) VALUES
(5, '2021-04-21 16:35:16', '', 23),
(8, '2021-04-22 10:25:56', 'Espece', 26),
(9, '2021-04-23 08:51:14', 'Airtel Money', 27),
(10, '2021-04-23 14:08:14', 'Espece', 28),
(13, '2021-04-27 14:52:30', 'Espece', 31),
(14, '2021-04-27 22:24:42', 'Espece', 32),
(16, '2021-04-28 14:47:36', '', 34),
(18, '2021-04-29 09:47:32', 'Espece', 36),
(19, '2021-04-29 10:21:10', '', 37),
(20, '2021-04-29 19:09:04', 'Espece', 38),
(21, '2021-04-30 08:41:04', 'Espece', 39);

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
  `type_payement_nuit` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ID_nuit` int NOT NULL,
  PRIMARY KEY (`ID_facture_nuit`),
  KEY `ID_nuit` (`ID_nuit`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture_nuit`
--

INSERT INTO `facture_nuit` (`ID_facture_nuit`, `offert`, `remise`, `type_payement_nuit`, `ID_nuit`) VALUES
(26, 0, 0, '', 43),
(27, 0, 0, '', 44),
(31, 0, 12, 'Espece', 48),
(33, 0, 5, 'VISA', 50),
(34, 0, 0, 'Espece', 51),
(36, 0, 0, 'Espece', 53),
(37, 0, 10, 'Espece', 54),
(38, 0, 10, 'Espece', 55),
(39, 0, 5, 'VISA', 56);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `ID_historique` int NOT NULL AUTO_INCREMENT,
  `ID_chambre_ancien` int NOT NULL,
  `tarif_chambre_ancien` int NOT NULL,
  PRIMARY KEY (`ID_historique`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`ID_historique`, `ID_chambre_ancien`, `tarif_chambre_ancien`) VALUES
(10, 2, 15000),
(11, 2, 15000),
(12, 2, 15000),
(13, 6, 5000),
(14, 11, 5000),
(15, 9, 30000),
(16, 9, 30000),
(17, 10, 25000),
(18, 19, 9000),
(19, 27, 1000),
(20, 16, 3000),
(21, 2, 15000),
(22, 4, 5000),
(23, 2, 15000),
(24, 2, 15000),
(25, 2, 15000),
(26, 2, 15000),
(27, 2, 15000),
(28, 2, 15000),
(29, 7, 15000),
(30, 8, 18500),
(31, 6, 5000),
(32, 5, 12000),
(33, 10, 25000),
(34, 1, 20000),
(35, 7, 15000),
(36, 11, 5000),
(37, 8, 18500),
(38, 1, 20000),
(39, 5, 12000),
(40, 8, 18500);

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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`ID_planning`, `debut_sejour`, `fin_sejour`, `heure_arrive`, `heure_depart`, `motif`) VALUES
(6, '2021-04-15', '2021-04-15', '11:37:00', '16:37:00', 'Day use'),
(9, '2021-04-15', '2021-04-15', '14:33:00', '16:33:00', 'Day use'),
(10, '2021-04-15', '2021-04-15', '14:34:00', '17:34:00', 'Day use'),
(13, '2021-04-16', '2021-04-16', '09:38:00', '12:38:00', 'Day use'),
(25, '2021-04-20', '2021-04-22', '00:00:00', '00:00:00', 'Nuitée'),
(26, '2021-04-20', '2021-04-22', '00:00:00', '00:00:00', 'Nuitée'),
(27, '2021-04-20', '2021-04-22', '00:00:00', '00:00:00', 'Nuitée'),
(28, '2021-04-20', '2021-04-24', '00:00:00', '00:00:00', 'Nuitée'),
(29, '2021-04-20', '2021-04-24', '00:00:00', '00:00:00', 'Nuitée'),
(30, '2021-04-20', '2021-04-24', '00:00:00', '00:00:00', 'Nuitée'),
(39, '2021-04-24', '2021-04-30', '00:00:00', '00:00:00', 'Nuitée'),
(41, '2021-04-22', '2021-04-25', '00:00:00', '00:00:00', 'Nuitée'),
(42, '2021-04-22', '2021-04-25', '00:00:00', '00:00:00', 'Nuitée'),
(43, '2021-04-22', '2021-04-25', '00:00:00', '00:00:00', 'Nuitée'),
(45, '2021-04-21', '2021-04-21', '16:35:00', '20:35:00', 'Day use'),
(52, '2021-04-22', '2021-04-22', '13:25:00', '15:25:00', 'Day use'),
(53, '2021-04-23', '2021-04-23', '09:00:00', '11:51:00', 'Day use'),
(54, '2021-04-23', '2021-04-23', '17:08:00', '19:08:00', 'Day use'),
(57, '2021-04-23', '2021-04-28', '00:00:00', '00:00:00', 'Nuitée'),
(58, '2021-04-23', '2021-04-29', '00:00:00', '00:00:00', 'Nuitée'),
(64, '2021-04-27', '2021-04-27', '14:52:00', '17:52:00', 'Day use'),
(65, '2021-04-30', '2021-05-06', '00:00:00', '00:00:00', 'Nuitée'),
(66, '2021-04-27', '2021-04-27', '22:24:00', '01:24:00', 'Day use'),
(69, '2021-04-28', '2021-04-28', '16:47:00', '18:47:00', 'Day use'),
(71, '2021-04-29', '2021-04-29', '13:49:00', '15:47:00', 'Day use'),
(72, '2021-04-29', '2021-04-29', '19:23:00', '22:49:00', 'Day use'),
(73, '2021-04-29', '2021-05-01', '00:00:00', '00:00:00', 'Nuitée'),
(74, '2021-05-01', '2021-05-04', '00:00:00', '00:00:00', 'Nuitée'),
(75, '2021-04-29', '2021-04-29', '20:08:00', '01:08:00', 'Day use'),
(77, '2021-04-30', '2021-04-30', '10:40:00', '12:40:00', 'Day use'),
(81, '2021-05-04', '2021-05-10', '00:00:00', '00:00:00', 'Nuitée');

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
(6, 0, 13),
(9, 0, 16),
(13, 0, 18),
(45, 0, 23),
(52, 0, 26),
(53, 0, 27),
(54, 0, 28),
(57, 43, 0),
(58, 44, 0),
(64, 0, 31),
(65, 48, 0),
(66, 0, 32),
(69, 0, 34),
(71, 0, 36),
(72, 0, 37),
(73, 50, 0),
(74, 51, 0),
(75, 0, 38),
(77, 0, 39),
(81, 56, 0);

-- --------------------------------------------------------

--
-- Structure de la table `relier`
--

DROP TABLE IF EXISTS `relier`;
CREATE TABLE IF NOT EXISTS `relier` (
  `ID_archive` int NOT NULL,
  `ID_chambre` int NOT NULL,
  `tarif_chambre` int NOT NULL,
  `description_chambre` text NOT NULL,
  PRIMARY KEY (`ID_archive`,`ID_chambre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relier`
--

INSERT INTO `relier` (`ID_archive`, `ID_chambre`, `tarif_chambre`, `description_chambre`) VALUES
(7, 1, 2000, 'Lit triple'),
(7, 2, 15000, ''),
(7, 3, 16999, 'Rien'),
(7, 4, 5000, 'Avec Wifi'),
(7, 5, 12000, ''),
(7, 6, 4999, 'Lit simpleeeee'),
(7, 7, 15000, 'Eau chaude'),
(7, 8, 18500, ''),
(7, 9, 29999, ''),
(7, 10, 25000, ''),
(7, 11, 5000, ''),
(7, 12, 7500, ''),
(7, 13, 6000, ''),
(7, 14, 4000, ''),
(7, 15, 4500, ''),
(7, 16, 3000, ''),
(7, 17, 5500, ''),
(7, 18, 8000, ''),
(7, 19, 9000, ''),
(7, 20, 1500, ''),
(7, 21, 555, ''),
(7, 22, 670, ''),
(7, 23, 777, ''),
(7, 24, 888, ''),
(7, 25, 4000, ''),
(7, 26, 5000, 'Eau chaude'),
(7, 27, 1000, 'Eau froide'),
(7, 28, 55555, 'Suite royale\r\nAvec vue sur la plage'),
(8, 1, 14500, 'Lit triple'),
(8, 2, 15000, ''),
(8, 3, 16999, 'Rien'),
(8, 4, 5000, 'Avec Wifi'),
(8, 5, 12000, ''),
(8, 6, 4999, 'Lit simple'),
(8, 7, 15000, 'Eau chaude'),
(8, 8, 18500, ''),
(8, 9, 29999, ''),
(8, 10, 25000, ''),
(8, 11, 5000, ''),
(8, 12, 7500, ''),
(8, 13, 6000, ''),
(8, 14, 4000, ''),
(8, 15, 4500, ''),
(8, 16, 3000, ''),
(8, 17, 5500, ''),
(8, 18, 8000, ''),
(8, 19, 9000, ''),
(8, 20, 1500, ''),
(8, 21, 555, ''),
(8, 22, 670, ''),
(8, 23, 777, ''),
(8, 24, 888, ''),
(8, 25, 4000, ''),
(8, 26, 5000, 'Eau chaude'),
(8, 27, 1000, 'Eau froide'),
(8, 28, 500000, 'Suite royale\r\nAvec vue sur la plage'),
(15, 1, 14500, 'Lit triple'),
(15, 2, 15000, ''),
(15, 3, 16999, 'Rien'),
(15, 4, 5000, 'Avec Wifi'),
(15, 5, 12000, ''),
(15, 6, 4999, 'Lit simple'),
(15, 7, 15000, 'Eau chaude'),
(15, 8, 18500, ''),
(15, 9, 29999, ''),
(15, 10, 25000, ''),
(15, 11, 5000, ''),
(15, 12, 7500, ''),
(15, 13, 6000, ''),
(15, 14, 4000, ''),
(15, 15, 4500, ''),
(15, 16, 3000, ''),
(15, 17, 5500, ''),
(15, 18, 8000, ''),
(15, 19, 9000, ''),
(15, 20, 1500, ''),
(15, 21, 555, ''),
(15, 22, 670, ''),
(15, 23, 777, ''),
(15, 24, 888, ''),
(15, 25, 4000, ''),
(15, 26, 5000, 'Eau chaude'),
(15, 27, 1000, 'Eau froide'),
(16, 1, 14500, 'Lit triple'),
(16, 2, 15000, ''),
(16, 3, 16999, 'Rien'),
(16, 4, 5000, 'Avec Wifi'),
(16, 5, 12000, ''),
(16, 6, 4999, 'Lit simple'),
(16, 7, 15000, 'Eau chaude'),
(16, 8, 18500, ''),
(16, 9, 29999, ''),
(16, 10, 25000, ''),
(16, 11, 5000, ''),
(16, 12, 7500, ''),
(16, 13, 6000, ''),
(16, 14, 4000, ''),
(16, 15, 4500, ''),
(16, 16, 3000, ''),
(16, 17, 5500, ''),
(16, 18, 8000, ''),
(16, 19, 9000, ''),
(16, 20, 1500, ''),
(16, 21, 555, ''),
(16, 22, 670, ''),
(16, 23, 777, ''),
(16, 24, 888, ''),
(16, 25, 4000, ''),
(16, 26, 5000, 'Eau chaude'),
(16, 27, 1000, 'Eau froide'),
(17, 1, 14500, 'Lit triple'),
(17, 2, 15000, ''),
(17, 3, 16999, 'Rien'),
(17, 4, 5000, 'Avec Wifi'),
(17, 5, 12000, ''),
(17, 6, 4999, 'Lit simple'),
(17, 7, 15000, 'Eau chaude'),
(17, 8, 18500, ''),
(17, 9, 29999, ''),
(17, 10, 25000, ''),
(17, 11, 5000, ''),
(17, 12, 7500, ''),
(17, 13, 6000, ''),
(17, 14, 4000, ''),
(17, 15, 4500, ''),
(17, 16, 3000, ''),
(17, 17, 5500, ''),
(17, 18, 8000, ''),
(17, 19, 9000, ''),
(17, 20, 1500, ''),
(17, 21, 555, ''),
(17, 22, 670, ''),
(17, 23, 777, ''),
(17, 24, 888, ''),
(17, 25, 4000, ''),
(17, 26, 5000, 'Eau chaude'),
(17, 27, 1000, 'Eau froide');

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation_day`
--

INSERT INTO `reservation_day` (`ID_day`, `nom_client_day`, `duree_day`, `date_reservation_day`, `commentaire_day`) VALUES
(10, 'Aya', 5, '2021-04-14 11:18:46', ''),
(13, 'Louis', 5, '2021-04-15 11:38:13', ''),
(16, 'fzfz', 2, '2021-04-15 14:34:17', ''),
(17, 'raaa', 3, '2021-04-15 14:34:51', ''),
(18, 'Jhon', 3, '2021-04-16 09:38:24', ''),
(23, 'Brad', 4, '2021-04-21 16:35:16', ''),
(26, 'Alone', 2, '2021-04-22 10:25:56', 'Casse'),
(27, 'Big', 3, '2021-04-23 08:51:14', ''),
(28, 'Ace', 2, '2021-04-23 14:08:14', ''),
(31, 'Mei', 3, '2021-04-27 14:52:30', ''),
(32, 'Nar', 3, '2021-04-27 22:24:42', ''),
(34, 'Curt', 2, '2021-04-28 14:47:36', ''),
(36, 'Alpa', 2, '2021-04-29 09:47:32', 'La réservation a été repoussé'),
(37, 'Yaq', 3, '2021-04-29 10:21:10', ''),
(38, 'Tyy', 5, '2021-04-29 19:09:04', ''),
(39, 'Bob', 2, '2021-04-30 08:41:04', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation_nuit`
--

INSERT INTO `reservation_nuit` (`ID_nuit`, `nbr_personne`, `nbr_nuit`, `type_reservation`, `ID_client`, `ID_etat_reservation`, `remarque_reservation`, `date_reservation_nuit`, `venant_de`, `allant_a`, `mode_transport`, `commentaire_nuit`) VALUES
(43, 1, 5, 'Réception', 113, 1, '', '2021-04-23 22:00:40', '', '', 'Autre', ''),
(44, 1, 6, 'Réception', 113, 4, '', '2021-04-23 22:01:52', '', '', 'Autre', ''),
(48, 3, 6, 'Réception', 116, 2, 'Test 2', '2021-04-27 14:53:25', '', '', 'Moto', ''),
(50, 3, 2, 'Téléphone', 116, 1, 'Cocktail offert', '2021-04-29 15:14:12', '', '', '', ''),
(51, 3, 3, 'Réception', 118, 2, 'Cafetiere', '2021-04-29 19:00:10', '', '', '', ''),
(56, 4, 6, 'Réception', 106, 1, 'Bedodo', '2021-05-04 15:20:43', '', '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID_user`, `nom_user`, `prenom_user`, `droit_user`, `mdp_user`) VALUES
(1, 'Dio', 'Nando', 'Administrateur', '$2y$10$lX7Mt6HaT5Xt40WbUhLYM..3.EGRfFll9HbgnXS7w.IpF9o49dkQi'),
(5, 'Mal', 'En', 'Contrôleur', '$2y$10$rXFIze7jjQgLjVms754Ff.sYwWdiaK4P7KyXZzqJ.TJP29RCcF3S.'),
(8, 'Mama', 'Mia', 'Administrateur', '$2y$10$zN9OVEhWy1AMaHYOtAZa8ejL3/6TuMrOWGSvKRqDaEI65JipFwmX6'),
(11, 'Smile', 'Cry', 'Utilisateur', '$2y$10$y6s5pIuBsuwdmwGKnOBjMuefG5IZyDQHxAZ2Jb2QrZ7kaMqRv2rHm'),
(22, 'Jhon', 'Wick', 'Administrateur', '$2y$10$InugSKkdIZBh79FybrJMTea8V40vQp9.LcBziSNyTpbFGc3cXmVma'),
(25, 'Tracer', 'Over', 'Contrôleur', '$2y$10$xtGyoR0ftFnMffCECFJpCezH0wCcrs0Th4sDVkrKfEgo019TCECTe'),
(29, 'Annie', 'Leon', 'Contrôleur', '$2y$10$GvHu3a2QrEO8xAgQrVj9feRx4h.ntIppGspVKG05lWmccxbiWBBGy'),
(30, 'D', 'Nio', 'Utilisateur', '$2y$10$WwdXCYrFIwyeplJ8ylVn4OSCdtpqqQE.vmKB.u1FalVxiU5WHpZKG'),
(32, 'root', 'admin', 'Administrateur', '$2y$10$9mlKEYJvib1dE/IonBwq0uZxuV1jngyD9hqby6mKeJdP//Qk9er4u'),
(33, 'Kim', 'Ka', 'Utilisateur', '$2y$10$Qx1G7dCXze4LES0yEgocT.MTHLhehKNXFbkp1i9/dICVuZYNu3h9i'),
(35, 'Bil', '', 'Utilisateur', ''),
(36, 'Hhh', 'KKK', 'Utilisateur', ''),
(37, 'JJ', 'JJ', 'Utilisateur', ''),
(38, 'effe', 'eger', 'Utilisateur', ''),
(39, 'grger', '', 'Utilisateur', '$2y$10$xp/kZC2kHV9VuFiv43/Y9Oj2GOkqjRqHGZO5o.PDNCMr1Wqgbo4LK'),
(40, 'grg', 'ttttt', 'Utilisateur', ''),
(41, 'Arthur', 'Blood', 'Utilisateur', ''),
(42, 'egekgek', '', 'Utilisateur', '$2y$10$YGl/KPiA265v.Co3V43ymuVmh9zMERev9TWGkWwzlDB2AKXGt6INW'),
(43, 'fefee', 'fefe', 'Utilisateur', ''),
(45, 'Yun', 'Ou', 'Utilisateur', ''),
(46, 'ui', '', 'Utilisateur', '$2y$10$xzK1Q6hoZi8MdMaRdiDHbOhUTUN1CEZhdqOklvmsa.kFAIa1jBvyO'),
(47, 'gege', 'egee', 'Utilisateur', ''),
(48, 'erfef', 'fege', 'Utilisateur', ''),
(49, 'test', 'test', 'Utilisateur', '$2y$10$lDGqVPMYyDBoEqICZOmhN.eyU17hEuqpecvF1LVShCcqz8sx7kE6y'),
(50, 'Light', 'Dark', 'Utilisateur', '$2y$10$vWhcnRg7vN1VE5JzH6KqWOy0qlOuKKt4rAnUeXEmD4pbS/cCC8B.y'),
(51, 'Mel', 'On', 'Controleur', '$2y$10$uVcF6TDkc8qRvTmbR2UYNepvfeecph/sYrLziealspiQ6srZijrqC'),
(52, 'TTT', '420', 'Controleur', '$2y$10$Y5naOp7Zd10IdBuKtqbWaeayynM/X6/MT94nUkDyYeyqVA4g0X1Re'),
(53, 'Admin', 'Admin', 'Administrateur', '$2y$10$5BVZO38/Oabv7OyIptKyNOfAupvE2sB.Rpyu06L/6bNJf8ivxjAaG'),
(54, 'Simple', 'Uti', 'Utilisateur', '$2y$10$0ExO4rk.tRucZ9DU8/Nj0./13gBoTlb19iAhf2qTKHthITAN02pMi'),
(55, 'P', 'V', 'Controleur', '$2y$10$kZeJTxcCQ/37wiVuswJ.7OiJuhgPWiz83dRHjVPg5bawZak0tlOkK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
