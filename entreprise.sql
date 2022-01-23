-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 23 jan. 2022 à 20:39
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `entreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL,
  `code_postal` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `id_client`, `numero`, `rue`, `ville`, `code_postal`) VALUES
(4, 11, '06', 'Place Carnet', 'Marseille', 75000),
(8, 8, '06', 'Rue de la paix', 'Paris', 75000),
(11, 10, '05', 'Rue du Palais', 'Le Mans', 72000),
(14, 8, '09', 'Rue des fontaines', 'Le Mans', 72000),
(23, 17, '59', 'Place de la RÃ©publique', 'Le Mans', 72100),
(20, 14, '78', 'Place de la RÃ©publique', 'Le Mans', 72000),
(19, 0, '78', 'Place de la RÃ©publique', 'Le Mans', 72000),
(21, 0, '87', 'Rue des fontaines', 'Le Mans', 72000),
(22, 16, '87', 'Rue des fontaines', 'Le Mans', 72000);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_status_article` int(11) DEFAULT NULL,
  `intitule` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `promotion` int(11) DEFAULT NULL,
  `valeur_points` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `id_status_article` (`id_status_article`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `id_status_article`, `intitule`, `prix_unitaire`, `promotion`, `valeur_points`) VALUES
(1, 1, 'Creme Nivea', 10, 0, 10),
(2, 1, 'Gel Douche Garnier', 15, 0, 15);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `id_grade` int(11) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `remise_future` int(11) DEFAULT NULL,
  `adherent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  KEY `id_grade` (`id_grade`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `id_grade`, `nom`, `prenom`, `remise_future`, `adherent`) VALUES
(17, 2, 'Djerbi', 'MattÃ©o', 0, 1),
(14, 3, 'De Pasquale', 'Tom', 0, 1),
(16, 2, 'Soulan', 'Guilhem', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_status_commande` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `date_passage` date DEFAULT NULL,
  `date_validation` date DEFAULT NULL,
  `date_cloture` date DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_status_commande` (`id_status_commande`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_status_commande`, `id_client`, `date_passage`, `date_validation`, `date_cloture`) VALUES
(18, 2, 14, '2022-01-23', '2022-01-23', '2022-01-23'),
(17, 4, 16, '2022-01-23', NULL, NULL),
(16, 4, 14, '2022-01-23', NULL, NULL),
(14, 2, 14, '2022-01-23', '2022-01-23', '2022-01-23'),
(15, 1, 14, '2022-01-23', '2022-01-23', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `instagram` varchar(20) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_contact`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `id_client`, `email`, `instagram`, `facebook`) VALUES
(1, 3, 'matteodjerbi@hotmail.fr', '@djer_s', 'Matteo Djerbi'),
(13, 14, 'tomdepasquale1@gmail.com', 'Tom', 'Tom de Pasquale'),
(15, 16, 'guigui@gmail.com', '@Guigui', 'Guilhem'),
(16, 17, 'matteo@djerbi.fr', '@matt', 'MattÃ©o Djerbi');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) DEFAULT NULL,
  `date_facturation` date DEFAULT NULL,
  `frais_service` int(11) DEFAULT NULL,
  `frais_livraison` int(11) DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_facture`),
  KEY `id_commande` (`id_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `id_commande`, `date_facturation`, `frais_service`, `frais_livraison`, `remise`) VALUES
(17, 14, '2022-01-23', 10, 50, 50),
(19, 18, '2022-01-23', 20, 2000, 0),
(18, 15, '2022-01-23', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id_grade` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_grade` varchar(20) DEFAULT NULL,
  `min_depense` int(11) DEFAULT NULL,
  `max_depense` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_grade`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`id_grade`, `intitule_grade`, `min_depense`, `max_depense`) VALUES
(2, 'Silver', 1, 18),
(3, 'Gold', 19, 100),
(1, 'Sans grade', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `itemcommande`
--

DROP TABLE IF EXISTS `itemcommande`;
CREATE TABLE IF NOT EXISTS `itemcommande` (
  `id_item_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) DEFAULT NULL,
  `id_status_item_commande` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix_vendu` int(11) DEFAULT NULL,
  `id_facture` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_item_commande`),
  KEY `id_commande` (`id_commande`),
  KEY `id_status_item_commande` (`id_status_item_commande`),
  KEY `id_article` (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `itemcommande`
--

INSERT INTO `itemcommande` (`id_item_commande`, `id_commande`, `id_status_item_commande`, `id_article`, `quantite`, `prix_vendu`, `id_facture`) VALUES
(17, 11, 1, 1, 20, 10, 14),
(16, 10, 1, 2, 2, 15, 12),
(15, 10, 1, 1, 50, 10, 13),
(14, 9, 1, 2, 2, 15, 10),
(13, 9, 1, 1, 1, 10, 10),
(12, 0, 1, 1, 1, 10, NULL),
(11, 0, 1, 2, 2, 15, NULL),
(10, 0, 1, 1, 1, 10, NULL),
(18, 12, 1, 1, 3, 10, 15),
(19, 12, 1, 2, 2, 15, 15),
(20, 13, 1, 1, 2, 10, 16),
(21, 14, 1, 1, 5, 10, 17),
(22, 15, 1, 2, 1, 15, 18),
(23, 16, 1, 1, 1, 10, NULL),
(24, 16, 1, 2, 2, 15, NULL),
(25, 17, 1, 1, 5, 10, NULL),
(26, 18, 1, 1, 56, 10, 19),
(27, 18, 1, 2, -8, 15, 19);

-- --------------------------------------------------------

--
-- Structure de la table `numerotelephone`
--

DROP TABLE IF EXISTS `numerotelephone`;
CREATE TABLE IF NOT EXISTS `numerotelephone` (
  `id_numero_telephone` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_numero_telephone`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `numerotelephone`
--

INSERT INTO `numerotelephone` (`id_numero_telephone`, `id_client`, `numero`) VALUES
(17, 14, '07 83 56 78 95'),
(20, 17, '06 86 63 58 95'),
(19, 16, '06 25 95 63 12');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) DEFAULT NULL,
  `id_facture` int(11) DEFAULT NULL,
  `id_type_paiement` int(20) NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `date_paiement` date DEFAULT NULL,
  PRIMARY KEY (`id_paiement`),
  KEY `id_commande` (`id_commande`),
  KEY `id_type_paiement` (`id_type_paiement`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `id_commande`, `id_facture`, `id_type_paiement`, `montant`, `date_paiement`) VALUES
(37, 18, 19, 1, 2460, '2022-01-23'),
(35, 14, 17, 2, 60, '2022-01-23'),
(36, 15, 18, 3, 15, '2022-01-23');

-- --------------------------------------------------------

--
-- Structure de la table `soldepoint`
--

DROP TABLE IF EXISTS `soldepoint`;
CREATE TABLE IF NOT EXISTS `soldepoint` (
  `id_solde_point` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `id_valeur_point` int(11) DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `intitule` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_solde_point`),
  KEY `id_client` (`id_client`),
  KEY `id_valeur_point` (`id_valeur_point`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `soldepoint`
--

INSERT INTO `soldepoint` (`id_solde_point`, `id_client`, `id_valeur_point`, `date_expiration`, `quantite`, `intitule`) VALUES
(4, 14, 1, '2100-01-01', 200, 'FidÃ©litÃ©'),
(5, 16, 1, '2100-01-01', 20, 'FidÃ©litÃ©'),
(6, 17, 1, '2100-01-01', 0, 'FidÃ©litÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `statusarticle`
--

DROP TABLE IF EXISTS `statusarticle`;
CREATE TABLE IF NOT EXISTS `statusarticle` (
  `id_status_article` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_status_article` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_status_article`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statusarticle`
--

INSERT INTO `statusarticle` (`id_status_article`, `intitule_status_article`) VALUES
(1, 'Disponible'),
(2, 'Indisponible');

-- --------------------------------------------------------

--
-- Structure de la table `statuscommande`
--

DROP TABLE IF EXISTS `statuscommande`;
CREATE TABLE IF NOT EXISTS `statuscommande` (
  `id_status_commande` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_status_commande` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_status_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statuscommande`
--

INSERT INTO `statuscommande` (`id_status_commande`, `intitule_status_commande`) VALUES
(1, 'Commande en cours'),
(2, 'Commande livrée'),
(3, 'Commande annulée'),
(4, 'Attente validation');

-- --------------------------------------------------------

--
-- Structure de la table `statusitemcommande`
--

DROP TABLE IF EXISTS `statusitemcommande`;
CREATE TABLE IF NOT EXISTS `statusitemcommande` (
  `id_status_item_commande` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_status_item_commande` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_status_item_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statusitemcommande`
--

INSERT INTO `statusitemcommande` (`id_status_item_commande`, `intitule_status_item_commande`) VALUES
(1, 'Disponible'),
(2, 'Indisponible');

-- --------------------------------------------------------

--
-- Structure de la table `typepaiement`
--

DROP TABLE IF EXISTS `typepaiement`;
CREATE TABLE IF NOT EXISTS `typepaiement` (
  `id_type_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `type_paiement` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_type_paiement`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typepaiement`
--

INSERT INTO `typepaiement` (`id_type_paiement`, `type_paiement`) VALUES
(1, 'Cheque'),
(2, 'Espece'),
(3, 'Carte bancaire'),
(4, 'Points');

-- --------------------------------------------------------

--
-- Structure de la table `valeurpoint`
--

DROP TABLE IF EXISTS `valeurpoint`;
CREATE TABLE IF NOT EXISTS `valeurpoint` (
  `id_valeur_point` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` float DEFAULT NULL,
  PRIMARY KEY (`id_valeur_point`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `valeurpoint`
--

INSERT INTO `valeurpoint` (`id_valeur_point`, `valeur`) VALUES
(1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
