-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 06 jan. 2022 à 15:39
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
  `id_adresse` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `numéro` varchar(20) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_status_article` int(11) DEFAULT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `promotion` int(11) DEFAULT NULL,
  `valeur_points` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `id_status_article` (`id_status_article`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL,
  `id_grade` int(11) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `total_depensé` int(11) DEFAULT NULL,
  `remise_future` int(11) DEFAULT NULL,
  `adhérent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  KEY `id_grade` (`id_grade`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `id_grade`, `nom`, `prenom`, `total_depensé`, `remise_future`, `adhérent`) VALUES
(1, 1, 'oui', 'oui', 1, 1, 1);

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
  `date_arrivée` date DEFAULT NULL,
  `prix_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_status_commande` (`id_status_commande`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `prix_facture` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_facture`),
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`id_grade`, `intitule_grade`, `min_dépense`, `max_dépense`) VALUES
(1, 'oui', 14, 18);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `id_facture` int(11) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `date_paiement` date DEFAULT NULL,
  PRIMARY KEY (`id_paiement`),
  KEY `id_facture` (`id_facture`),
  KEY `id_commande` (`id_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statuscommande`
--

DROP TABLE IF EXISTS `statuscommande`;
CREATE TABLE IF NOT EXISTS `statuscommande` (
  `id_status_commande` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_status_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statusitemcommande`
--

DROP TABLE IF EXISTS `statusitemcommande`;
CREATE TABLE IF NOT EXISTS `statusitemcommande` (
  `id_status_item_commande` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_status_item_commande` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_status_item_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typepaiement`
--

DROP TABLE IF EXISTS `typepaiement`;
CREATE TABLE IF NOT EXISTS `typepaiement` (
  `id_type_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `id_paiement` int(11) DEFAULT NULL,
  `type_paiement` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_type_paiement`),
  KEY `id_paiement` (`id_paiement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
