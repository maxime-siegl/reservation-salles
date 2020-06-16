-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 16 juin 2020 à 07:00
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
-- Base de données :  `reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES
(2, 'Reunion syndicat', 'Discussion organisee autour de la bonne ambiance entre amis', '2020-06-16 12:00:00', '2020-06-16 13:00:00', 2),
(3, 'Reunion syndicat', 'Il faut 2heures pour bien discuter (et boire)', '2020-06-16 11:00:00', '2020-06-16 12:00:00', 2),
(4, 'Atelier cirque', 'Atelier, decouverte, magie pour les cm2 de l\'école primaire', '2020-06-17 09:00:00', '2020-06-17 10:00:00', 3),
(5, 'Pot de dÃ©part de Jaqueline', 'Apres 25 ans Ã  la mairie Jaqueline decide desormais de bosser !!', '2020-06-17 14:00:00', '2020-06-17 15:00:00', 1),
(6, 'Reunion de crise', 'Retour de notre bon vieux confinement !! il faut etre en securite on a dit.', '2020-06-17 19:00:00', '2020-06-17 20:00:00', 1),
(7, 'Bingo', 'Pleins de choses Ã  gagner', '2020-06-18 10:00:00', '2020-06-18 11:00:00', 1),
(8, 'Kermess', 'Car c est deja la fin de l annee', '2020-06-19 11:00:00', '2020-06-19 12:00:00', 1),
(9, 'Fin du monde', 'Homer nous tue tous dans un malencontreux gestes qui lui fera appuyer sur le bouton rouge', '2020-06-19 18:00:00', '2020-06-19 19:00:00', 1),
(10, 'Discours de TRUMP', 'Il va annoncer qu en fait il est d origine mexicaine, c est sur !', '2020-06-19 19:00:00', '2020-06-19 20:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$DMfA5HROHU8/CSmxKy6THe44lVG97s.Rwzye6e1bTHN40zS.MgIWu'),
(2, 'test', '$2y$10$jx73LhGPNIaSkGBd.1SGUOTJn7YISuksVQ4h9olAzbqhu6fA58xu6'),
(3, 'Maxime', '$2y$10$7d32Xs7H9UimAYRTVrG3Qekp/tFjX.nFfdv16C9.4gMs4LYklVogO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
