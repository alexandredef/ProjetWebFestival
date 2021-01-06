-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 06 jan. 2021 à 20:16
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetfestivalbdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

DROP TABLE IF EXISTS `candidature`;
CREATE TABLE IF NOT EXISTS `candidature` (
  `id` int(10) NOT NULL,
  `nomgroupe` varchar(50) NOT NULL,
  `departement` varchar(50) NOT NULL,
  `typescene` int(10) NOT NULL,
  `representantgroupenom` varchar(150) NOT NULL,
  `representanttgroupeprenom` varchar(150) NOT NULL,
  `representanttgroupeadresse` varchar(150) NOT NULL,
  `representanttgroupecodepostal` int(10) NOT NULL,
  `representantGroupeEmail` varchar(150) NOT NULL,
  `representantGroupeTelephone` int(10) NOT NULL,
  `stylemusicale` varchar(50) NOT NULL,
  `annee` int(4) NOT NULL,
  `presentation` varchar(500) NOT NULL,
  `experience` varchar(500) NOT NULL,
  `siteinternet` varchar(150) NOT NULL,
  `adresseSoundcloud` varchar(150) NOT NULL,
  `adresseYoutube` varchar(150) NOT NULL,
  `membres` varchar(250) NOT NULL,
  `roles_membres` varchar(250) NOT NULL,
  `statutAssociatif` tinyint(1) NOT NULL,
  `inscritSACEM` tinyint(1) NOT NULL,
  `producteur` tinyint(1) NOT NULL,
  `fichierMP3` varchar(150) NOT NULL,
  `dossierpresse` varchar(150) NOT NULL,
  `photosgroupe` varchar(150) NOT NULL,
  `fichetechnique` varchar(150) NOT NULL,
  `documentsacem` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`) VALUES
(1, '01 - Ain - Bourg-en-bresse'),
(2, '02 - Aisne - Laon'),
(3, '03 - Allier - Moulins'),
(4, '04 - Alpes-de-Haute-Provence - Digne-les-bains'),
(5, '05 - Hautes-alpes - Gap'),
(6, '06 - Alpes-maritimes - Nice'),
(7, '07 - ArdÃ¨che - Privas'),
(8, '08 - Ardennes - Charleville-mÃ©ziÃ¨res'),
(9, '09 - AriÃ¨ge - Foix'),
(10, '10 - Aube - Troyes'),
(11, '11 - Aude - Carcassonne'),
(12, '12 - Aveyron - Rodez'),
(13, '13 - Bouches-du-RhÃ´ne - Marseille'),
(14, '14 - Calvados - Caen'),
(15, '15 - Cantal - Aurillac'),
(16, '16 - Charente - AngoulÃªme'),
(17, '17 - Charente-maritime - La rochelle'),
(18, '18 - Cher - Bourges'),
(19, '19 - CorrÃ¨ze - Tulle'),
(20, '2A - Corse-du-sud - Ajaccio'),
(21, '2B - Haute-Corse - Bastia'),
(22, '21 - Cote-dOr - Dijon'),
(23, '22 - Cotes-dArmor - Saint-brieuc'),
(24, '23 - Creuse - GuÃ©ret'),
(25, '24 - Dordogne - PÃ©rigueux'),
(26, '25 - Doubs - BesanÃ§on'),
(27, '26 - DrÃ´me - Valence'),
(28, '27 - Eure - Ã‰vreux'),
(29, '28 - Eure-et-loir - Chartres'),
(30, '29 - FinistÃ¨re - Quimper'),
(31, '30 - Gard - NÃ®mes'),
(32, '31 - Haute-garonne - Toulouse'),
(33, '32 - Gers - Auch'),
(34, '33 - Gironde - Bordeaux'),
(35, '34 - HÃ©rault - Montpellier'),
(36, '35 - Ille-et-vilaine - Rennes'),
(37, '36 - Indre - ChÃ¢teauroux'),
(38, '37 - Indre-et-loire - Tours'),
(39, '38 - IsÃ¨re - Grenoble'),
(40, '39 - Jura - Lons-le-saunier'),
(41, '40 - Landes - Mont-de-marsan'),
(42, '41 - Loir-et-cher - Blois'),
(43, '42 - Loire - Saint-Ã©tienne'),
(44, '43 - Haute-loire - Le puy-en-velay'),
(45, '44 - Loire-atlantique - Nantes'),
(46, '45 - Loiret - OrlÃ©ans'),
(47, '46 - Lot - Cahors'),
(48, '47 - Lot-et-garonne - Agen'),
(49, '48 - LozÃ¨re - Mende'),
(50, '49 - Maine-et-loire - Angers'),
(51, '50 - Manche - Saint-lÃ´'),
(52, '51 - Marne - ChÃ¢lons-en-champagne'),
(53, '52 - Haute-marne - Chaumont'),
(54, '53 - Mayenne - Laval'),
(55, '54 - Meurthe-et-moselle - Nancy'),
(56, '55 - Meuse - Bar-le-duc'),
(57, '56 - Morbihan - Vannes'),
(58, '57 - Moselle - Metz'),
(59, '58 - NiÃ¨vre - Nevers'),
(60, '59 - Nord - Lille'),
(61, '60 - Oise - Beauvais'),
(62, '61 - Orne - AlenÃ§on'),
(63, '62 - Pas-de-calais - Arras'),
(64, '63 - Puy-de-dÃ´me - Clermont-ferrand'),
(65, '64 - PyrÃ©nÃ©es-atlantiques - Pau'),
(66, '65 - Hautes-PyrÃ©nÃ©es - Tarbes'),
(67, '66 - PyrÃ©nÃ©es-orientales - Perpignan'),
(68, '67 - Bas-rhin - Strasbourg'),
(69, '68 - Haut-rhin - Colmar'),
(70, '69 - RhÃ´ne - Lyon'),
(71, '70 - Haute-saÃ´ne - Vesoul'),
(72, '71 - SaÃ´ne-et-loire - MÃ¢con'),
(73, '72 - Sarthe - Le mans'),
(74, '73 - Savoie - ChambÃ©ry'),
(75, '74 - Haute-savoie - Annecy'),
(76, '75 - Paris - Paris'),
(77, '76 - Seine-maritime - Rouen'),
(78, '77 - Seine-et-marne - Melun'),
(79, '78 - Yvelines - Versailles'),
(80, '79 - Deux-sÃ¨vres - Niort'),
(81, '80 - Somme - Amiens'),
(82, '81 - Tarn - Albi'),
(83, '82 - Tarn-et-Garonne - Montauban'),
(84, '83 - Var - Toulon'),
(85, '84 - Vaucluse - Avignon'),
(86, '85 - VendÃ©e - La roche-sur-yon'),
(87, '86 - Vienne - Poitiers'),
(88, '87 - Haute-vienne - Limoges'),
(89, '88 - Vosges - Ã‰pinal'),
(90, '89 - Yonne - Auxerre'),
(91, '90 - Territoire de belfort - Belfort'),
(92, '91 - Essonne - Ã‰vry'),
(93, '92 - Hauts-de-seine - Nanterre'),
(94, '93 - Seine-Saint-Denis - Bobigny'),
(95, '94 - Val-de-marne - CrÃ©teil'),
(96, '95 - Val-dOise - Cergy Pontoise'),
(97, '971 - Guadeloupe - Basse-terre'),
(98, '972 - Martinique - Fort-de-france'),
(99, '973 - Guyane - Cayenne'),
(100, '974 - La rÃ©union - Saint-denis'),
(101, '976 - Mayotte - Mamoudzou');

-- --------------------------------------------------------

--
-- Structure de la table `scene`
--

DROP TABLE IF EXISTS `scene`;
CREATE TABLE IF NOT EXISTS `scene` (
  `id` int(10) NOT NULL,
  `nom` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `estadmin` int(1) NOT NULL DEFAULT 0,
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`nom`, `email`, `motdepasse`, `estadmin`) VALUES
('admin', 'admin@admin.admin', '$2y$10$QgJbaMTsf8g0x1pfQXnmEe3lE6Si5DmVtdOTo8qDcTf3ilIuZ/ITW', 1),
('iojjiooijio', 'iojiooj@jikjj.lol', '$2y$10$10ruBWSf8lKrHXyZsnmPYeJ8BDZCu5ujv.e0Lz2EDbqH45zxe1s0.', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
