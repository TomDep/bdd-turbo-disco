-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 jan. 2022 à 13:15
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
  `code_postal` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `id_client`, `numero`, `rue`, `ville`, `code_postal`) VALUES
(4, 11, '06', 'Place Carnet', 'Marseille', '75000'),
(8, 8, '06', 'Rue de la paix', 'Paris', '75000'),
(11, 10, '05', 'Rue du Palais', 'Le Mans', '72000'),
(12, 3, '26', 'Rue jean jaures', 'Angers', '49000'),
(14, 8, '09', 'Rue des fontaines', 'Le Mans', '72000'),
(15, 3, '06', 'Le tertre', 'Lieu-dit', '53160');

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `id_grade`, `nom`, `prenom`, `remise_future`, `adherent`) VALUES
(10, 2, 'Lebrun', 'Jean', 0, 0),
(3, 3, 'Djerbi', 'Matteo', 0, 0),
(8, 3, 'Marc', 'Belin', 0, 0),
(11, 1, 'Soulan', 'Guilhem', 0, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_status_commande`, `id_client`, `date_passage`, `date_validation`, `date_cloture`) VALUES
(10, 4, 3, '2022-01-21', NULL, NULL),
(9, 1, 3, '2022-01-21', NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `id_client`, `email`, `instagram`, `facebook`) VALUES
(1, 3, 'matteodjerbi@hotmail.fr', '@djer_s', 'Matteo Djerbi'),
(3, 8, 'lemec@hotmail.fr', 'mattbg53', 'mattbg'),
(5, 10, 'matteodjerbi@hotmail.com', '@jlbbb', 'Jean Lebrun'),
(6, 11, 'zreez@hotmail.com', 'refefr', '@zboob');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) DEFAULT NULL,
  `id_paiement` int(11) DEFAULT NULL,
  `date_facturation` date DEFAULT NULL,
  `frais_service` int(11) DEFAULT NULL,
  `frais_livraison` int(11) DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  `prix_facture` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_facture`),
  UNIQUE KEY `id_paiement` (`id_paiement`),
  KEY `id_commande` (`id_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id_grade` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_grade` varchar(20) DEFAULT NULL,
  `min_dépense` int(11) DEFAULT NULL,
  `max_dépense` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_grade`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`id_grade`, `intitule_grade`, `min_dépense`, `max_dépense`) VALUES
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
  PRIMARY KEY (`id_item_commande`),
  KEY `id_commande` (`id_commande`),
  KEY `id_status_item_commande` (`id_status_item_commande`),
  KEY `id_article` (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `itemcommande`
--

INSERT INTO `itemcommande` (`id_item_commande`, `id_commande`, `id_status_item_commande`, `id_article`, `quantite`, `prix_vendu`) VALUES
(16, 10, 1, 2, 2, 15),
(15, 10, 1, 1, 50, 10),
(14, 9, 1, 2, 2, 15),
(13, 9, 1, 1, 1, 10),
(12, 0, 1, 1, 1, 10),
(11, 0, 1, 2, 2, 15),
(10, 0, 1, 1, 1, 10);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `numerotelephone`
--

INSERT INTO `numerotelephone` (`id_numero_telephone`, `id_client`, `numero`) VALUES
(2, 8, '0785968555'),
(3, 10, '0711592275'),
(4, 11, '06'),
(8, 3, '0668269608');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) DEFAULT NULL,
  `id_type_paiement` int(20) NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `date_paiement` date DEFAULT NULL,
  PRIMARY KEY (`id_paiement`),
  KEY `id_commande` (`id_commande`),
  KEY `id_type_paiement` (`id_type_paiement`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `id_commande`, `id_type_paiement`, `montant`, `date_paiement`) VALUES
(11, 10, 2, 275, '2022-01-21'),
(10, 9, 3, 20, '2022-01-21'),
(9, 0, 2, 20, '2022-01-21');

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
  `quantité` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_solde_point`),
  KEY `id_client` (`id_client`),
  KEY `id_valeur_point` (`id_valeur_point`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `intitule_paiement` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_status_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statuscommande`
--

INSERT INTO `statuscommande` (`id_status_commande`, `intitule_paiement`) VALUES
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typepaiement`
--

INSERT INTO `typepaiement` (`id_type_paiement`, `type_paiement`) VALUES
(1, 'Cheque'),
(2, 'Espece'),
(3, 'Carte bancaire');

-- --------------------------------------------------------

--
-- Structure de la table `valeurpoint`
--

DROP TABLE IF EXISTS `valeurpoint`;
CREATE TABLE IF NOT EXISTS `valeurpoint` (
  `id_valeur_point` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_valeur_point`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
