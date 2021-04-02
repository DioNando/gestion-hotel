-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 avr. 2021 à 08:54
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
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `ID_chambre` int NOT NULL AUTO_INCREMENT,
  `tarif_chambre` int NOT NULL,
  `statut_chambre` tinytext NOT NULL,
  PRIMARY KEY (`ID_chambre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`ID_chambre`, `tarif_chambre`, `statut_chambre`) VALUES
(1, 20000, 'Occupée'),
(2, 15000, 'Occupée'),
(3, 17000, 'Occupée'),
(4, 10000, 'Libre'),
(5, 12000, 'Occupée'),
(6, 5000, 'Occupée'),
(7, 15000, 'En attente'),
(8, 18500, 'Occupée'),
(9, 30000, 'En attente'),
(10, 25000, 'Libre');

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_client`, `nom_client`, `prenom_client`, `telephone_client`) VALUES
(1, 'Levi', 'fefee', ''),
(2, 'Jinx', 'yun', ''),
(7, 'Crush', 'crush', ''),
(8, 'One', 'Punch', ''),
(9, 'Fuga Sapiente fugia', 'Aut rerum nisi ipsam', ''),
(10, 'Homer', 'Simpson', ''),
(11, 'Luffy', 'Mugi', ''),
(12, 'Header', 'Footer', ''),
(13, 'Laborum eveniet qui', 'Repellendus Rem mol', ''),
(14, 'Id nesciunt occaeca', 'Molestiae fugiat mol', ''),
(16, 'Rem dolore quaerat a', 'Dolorum sed sint mi', ''),
(17, 'Animi sit aliqua ', 'Nostrum a ullam elit', ''),
(18, 'aaaaaa', 'aaaaa', ''),
(19, 'bbbbb', 'bbbbb', ''),
(20, 'Bonne', 'Nuit', ''),
(21, 'Bon', 'Jour', ''),
(22, 'GGG', 'EZZZ', ''),
(23, 'alive', 'yeah', ''),
(24, 'yessss', 'noooo', ''),
(25, 'postttt', 'getttt', ''),
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
(41, 'Crushvv', 'sfsggs', ''),
(42, 'Crushvv', 'sfsggs', ''),
(43, 'Vin', 'Sanji', ''),
(45, 'Armin', 'Arlet', ''),
(46, 'Bil', 'Kidd', ''),
(50, 'dgsdgds', 'jtjtrtr', ''),
(51, 'dggr', 'ehehe', ''),
(52, '96666', 'Nyan', ''),
(53, 'Homz', 'land', ''),
(56, 'fzfzfzzzz', 'fegegegerg', ''),
(57, 'Kali', 'Linux', ''),
(58, 'Arsh', 'Jinnn', ''),
(59, 'Kylian', 'Mbappe', ''),
(60, 'Alex', 'Caruso', ''),
(61, 'Tray', 'Young', ''),
(62, 'Bob', 'bobb', ''),
(63, 'Pre', 'Malone', ''),
(64, 'Bron', 'Bronny', ''),
(65, 'Post', 'Malone', ''),
(66, 'Gollum', 'Ereh', ''),
(67, 'Jaaaam', 'Rooock', ''),
(68, 'Tom', 'Hanks', '+1 (917) 964-9389'),
(69, 'fgege', 'zfeege', ''),
(70, 'zefjele', 'pjegepgzeg', ''),
(72, 'erregerge', 'gegergg', ''),
(73, 'Rachel', 'Mendes', ''),
(76, 'zgjekmgj', 'fkfeef', ''),
(77, 'Jimbo', 'Chum', ''),
(79, 'Orion', 'Omega', '+1 (639) 525-2201'),
(80, 'Viande', 'Cuit', ''),
(81, 'Jerry', 'Holmes', ''),
(82, 'Basta', 'Puma', '+1 (911) 472-9306'),
(83, 'Naruto', 'Uzumaki', '+1 (301) 586-3997');

-- --------------------------------------------------------

--
-- Structure de la table `concerner`
--

DROP TABLE IF EXISTS `concerner`;
CREATE TABLE IF NOT EXISTS `concerner` (
  `ID_chambre` int NOT NULL,
  `ID_nuit` int NOT NULL,
  `ID_day` int NOT NULL,
  PRIMARY KEY (`ID_chambre`,`ID_nuit`,`ID_day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `concerner`
--

INSERT INTO `concerner` (`ID_chambre`, `ID_nuit`, `ID_day`) VALUES
(1, 0, 6),
(1, 0, 7),
(1, 0, 9),
(1, 0, 10),
(1, 0, 16),
(1, 72, 0),
(2, 0, 11),
(2, 72, 0),
(3, 0, 11),
(3, 0, 14),
(3, 2, 0),
(3, 72, 0),
(4, 0, 6),
(4, 79, 0),
(5, 0, 1),
(5, 76, 0),
(7, 0, 10),
(7, 22, 0),
(8, 0, 6),
(8, 0, 10);

-- --------------------------------------------------------

--
-- Structure de la table `effectuer`
--

DROP TABLE IF EXISTS `effectuer`;
CREATE TABLE IF NOT EXISTS `effectuer` (
  `ID_user` int NOT NULL,
  `ID_nuit` int NOT NULL,
  `ID_day` int NOT NULL,
  PRIMARY KEY (`ID_user`,`ID_nuit`,`ID_day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `effectuer`
--

INSERT INTO `effectuer` (`ID_user`, `ID_nuit`, `ID_day`) VALUES
(1, 0, 1),
(1, 0, 5),
(1, 0, 6),
(1, 0, 7),
(1, 0, 8),
(1, 0, 16),
(1, 1, 0),
(1, 2, 0),
(1, 5, 0),
(1, 6, 0),
(1, 21, 0),
(1, 23, 0),
(28, 0, 2),
(28, 0, 3),
(28, 0, 4),
(28, 5, 0),
(28, 6, 0),
(28, 7, 0),
(28, 8, 0),
(28, 9, 0),
(28, 10, 0),
(28, 11, 0),
(28, 12, 0),
(28, 13, 0),
(28, 14, 0),
(28, 15, 0),
(28, 16, 0),
(28, 17, 0),
(28, 18, 0),
(28, 19, 0),
(28, 20, 0);

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
-- Structure de la table `pour`
--

DROP TABLE IF EXISTS `pour`;
CREATE TABLE IF NOT EXISTS `pour` (
  `ID_planning` int NOT NULL,
  `ID_nuit` int NOT NULL,
  `ID_day` int NOT NULL,
  PRIMARY KEY (`ID_planning`,`ID_nuit`,`ID_day`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation_day`
--

DROP TABLE IF EXISTS `reservation_day`;
CREATE TABLE IF NOT EXISTS `reservation_day` (
  `ID_day` int NOT NULL AUTO_INCREMENT,
  `date_day` date NOT NULL,
  `heure_arrive` time NOT NULL,
  `heure_depart` time NOT NULL,
  `duree_day` tinyint NOT NULL,
  `date_reservation_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_day`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation_day`
--

INSERT INTO `reservation_day` (`ID_day`, `date_day`, `heure_arrive`, `heure_depart`, `duree_day`, `date_reservation_day`, `date_modification_day`) VALUES
(6, '2021-03-31', '15:34:00', '19:34:00', 4, '2021-03-31 15:35:01', '2021-03-31 15:35:01'),
(7, '2021-03-31', '15:36:00', '21:36:00', 6, '2021-03-31 15:36:24', '2021-03-31 15:36:24'),
(8, '2021-04-02', '11:06:00', '14:06:00', 3, '2021-04-02 11:06:12', '2021-04-02 11:06:12');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_nuit`
--

DROP TABLE IF EXISTS `reservation_nuit`;
CREATE TABLE IF NOT EXISTS `reservation_nuit` (
  `ID_nuit` int NOT NULL AUTO_INCREMENT,
  `nbr_personne` int NOT NULL,
  `debut_sejour` date NOT NULL,
  `fin_sejour` date NOT NULL,
  `nbr_nuit` int NOT NULL,
  `type_reservation` varchar(50) NOT NULL,
  `ID_client` int NOT NULL,
  `ID_etat_reservation` int NOT NULL,
  `remarque_reservation` text NOT NULL,
  `date_reservation_nuit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification_nuit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_nuit`),
  KEY `ID_client` (`ID_client`),
  KEY `ID_etat_reservation` (`ID_etat_reservation`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation_nuit`
--

INSERT INTO `reservation_nuit` (`ID_nuit`, `nbr_personne`, `debut_sejour`, `fin_sejour`, `nbr_nuit`, `type_reservation`, `ID_client`, `ID_etat_reservation`, `remarque_reservation`, `date_reservation_nuit`, `date_modification_nuit`) VALUES
(1, 1, '2021-03-31', '2021-04-04', 4, '', 68, 1, '', '2021-03-31 09:20:19', '2021-03-31 09:20:19'),
(2, 7, '2021-04-02', '2021-04-09', 7, '', 81, 1, '', '2021-03-31 09:41:26', '2021-03-31 09:41:26'),
(4, 11, '2021-04-09', '2021-04-11', 2, '', 81, 2, '', '2021-03-31 10:15:51', '2021-03-31 10:15:51'),
(7, 1, '2021-03-31', '2021-04-04', 4, '', 82, 2, '', '2021-03-31 10:22:30', '2021-03-31 10:22:30'),
(9, 1, '2021-03-31', '2021-04-02', 2, '', 82, 2, '', '2021-03-31 10:23:16', '2021-03-31 10:23:16'),
(10, 1, '2021-03-31', '2021-03-31', 0, '', 82, 2, '', '2021-03-31 10:23:45', '2021-03-31 10:23:45'),
(13, 1, '2021-03-31', '2021-03-31', 0, '', 68, 4, '', '2021-03-31 10:52:42', '2021-03-31 10:52:42'),
(14, 1, '2021-03-31', '2021-03-31', 0, '', 68, 4, '', '2021-03-31 10:52:49', '2021-03-31 10:52:49'),
(18, 1, '2021-03-31', '2021-03-31', 0, '', 68, 3, '', '2021-03-31 11:12:32', '2021-03-31 11:12:32'),
(19, 1, '2021-03-31', '2021-03-31', 0, '', 68, 4, 'OUIIIIII', '2021-03-31 11:14:18', '2021-03-31 11:14:18'),
(21, 1, '2021-03-31', '2021-04-21', 21, 'reception', 68, 2, 'Nothing', '2021-03-31 15:09:41', '2021-03-31 15:09:41'),
(22, 3, '2021-04-17', '2021-04-20', 3, 'telephone', 83, 2, 'Payement en 3 tranches', '2021-04-02 08:35:10', '2021-04-02 08:35:10'),
(23, 3, '2021-05-01', '2021-05-05', 4, 'telephone', 83, 2, 'Payement en 2 tranches', '2021-04-02 08:41:16', '2021-04-02 08:41:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID_user`, `nom_user`, `prenom_user`, `droit_user`, `mdp_user`) VALUES
(1, 'Dio', 'Nando', 'Administrateur', '$2y$10$wuwOO6BSIOTYrkSSnfq7w.3vC0ayxCb74xafIOXPJ7h/piIZ5tip6'),
(5, 'Geralt', 'Of Rivia', 'Administrateur', '$2y$10$pIVJazA7G0NcoaEfj1kW4e.O1nEk7Dxwj6cnnzVNLskxB2W/Cw9Ai'),
(8, 'tita', '0', 'Utilisateur', '$2y$10$teY7CtcdEddsqcyj1pkSau8SdGkoM25RxtZX5AGjJOpNf/WShcTMu'),
(11, 'Smile', 'Or Sad', 'Administrateur', '$2y$10$11dt5/V8/Mjui3PHXFGGueQyeumJxx75sz4iqau9e4LPOmdBzcwWS'),
(22, 'Jhon', '0', 'Utilisateur', '$2y$10$4gXeNHj9gcIBkTmarmRPquaHzR/L2N6e59pqSCpW93nCaRmfNeMtO'),
(25, 'Tracer', '0', 'Utilisateur', '$2y$10$d2/Ynk89tRJe9ur7t/V3WuTiX2zIXW7n.h2TSK1gqSohIH8unFaNG'),
(27, 'Fer', '0', 'Utilisateur', '$2y$10$nAAtsYV2HmtEDFi43xj3DOV.QDkFFH9RHvyaamGluRhKNnOVR8oHm'),
(28, 'Cry', 'Baby', 'Administrateur', '$2y$10$Q2WO5/olJMSGP.eLP/n.N.Ei5Z/U0KxDZEs0.SQGSD2Ww2uFigPEm'),
(29, 'Doc', 'Guero', 'Administrateur', '$2y$10$GvHu3a2QrEO8xAgQrVj9feRx4h.ntIppGspVKG05lWmccxbiWBBGy'),
(30, 'Dio', 'Nio', 'Utilisateur', '$2y$10$BubX4DpATIWzoBPPcS1tk.wG2NJm1/TjY.UHHXxiyHKzQLZ721X3K'),
(31, 'levi', '0', 'Utilisateur', '$2y$10$GTUUbNcsWcB3cnNL5WyMfuchb0D7ueDN5XK92dAJDeW1qR8ke4bFy'),
(32, 'root', 'admin', 'Administrateur', '$2y$10$9mlKEYJvib1dE/IonBwq0uZxuV1jngyD9hqby6mKeJdP//Qk9er4u');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation_nuit`
--
ALTER TABLE `reservation_nuit`
  ADD CONSTRAINT `reservation_nuit_ibfk_1` FOREIGN KEY (`ID_client`) REFERENCES `client` (`ID_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_nuit_ibfk_2` FOREIGN KEY (`ID_etat_reservation`) REFERENCES `etat` (`ID_etat_reservation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
