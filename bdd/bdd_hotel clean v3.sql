-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 mai 2021 à 06:54
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'B02', 'Libre', 0, 15000, 'Lit double'),
(3, 'C03', 'Libre', 0, 15000, 'Lit simple\r\nWifi\r\nEau chaude'),
(4, 'C005', 'Libre', 0, 18000, 'Lit double\r\nWifi\r\nEau chaude'),
(5, 'D15', 'Libre', 0, 8500, 'Lit double'),
(6, 'E15', 'Libre', 0, 5000, 'Se trouve au rez-de-chaussé'),
(7, 'A2', 'Libre', 0, 6000, 'Lit simple'),
(8, 'F4', 'Libre', 0, 8000, 'Lit double séparés'),
(9, 'F12', 'Libre', 0, 11000, 'Lit simple séparés'),
(10, 'G13', 'Libre', 0, 25000, 'Suite royale'),
(11, 'H20', 'Libre', 0, 22500, 'Classe affaire'),
(12, 'E003', 'Libre', 0, 11000, 'Lit simple\r\nWifi\r\nEau chaude'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
(7, '2021-05-11 09:29:57', 8, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

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
