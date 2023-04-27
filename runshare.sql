-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 27 Avril 2023 à 12:42
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `runshare`
--
CREATE DATABASE IF NOT EXISTS `runshare` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `runshare`;

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

DROP TABLE IF EXISTS `abonne`;
CREATE TABLE IF NOT EXISTS `abonne` (
  `ID_suivie` int(11) NOT NULL,
  `ID_suiveur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `abonne`
--

INSERT INTO `abonne` (`ID_suivie`, `ID_suiveur`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(1, 2),
(3, 2),
(1, 3),
(2, 3),
(1, 4),
(12, 7),
(3, 12),
(7, 12),
(33, 12),
(12, 33);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID_post` int(11) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `texte` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`ID_post`, `ID_utilisateur`, `date`, `texte`) VALUES
(1, 2, '2023-03-28 08:36:00', 'FÃ©licitations pour la performance !'),
(1, 3, '2023-03-28 08:36:00', 'Belle performance !'),
(1, 5, '2023-03-28 08:36:00', 'Incroyable performance !'),
(2, 1, '2023-03-28 08:36:00', 'Superbe effort !'),
(2, 4, '2023-03-28 08:36:00', 'Bravo pour la performance !'),
(3, 1, '2023-03-28 08:36:00', 'Impressionnant !'),
(3, 3, '2023-03-28 08:36:00', 'Tres belle performance !'),
(4, 5, '2023-03-28 08:36:00', 'Super !'),
(5, 2, '2023-03-28 08:36:00', 'Une performance solide !'),
(5, 4, '2023-03-28 08:36:00', 'C''est incroyable !'),
(6, 1, '2023-03-28 08:36:00', 'Bravo pour cette course !'),
(7, 3, '2023-03-28 08:36:00', 'Tu es un vrai champion !'),
(8, 2, '2023-03-28 08:36:00', 'Une performance remarquable !'),
(9, 5, '2023-03-28 08:36:00', 'C''est fantastique !'),
(10, 4, '2023-03-28 08:36:00', 'Excellent travail !'),
(17, 12, '2023-04-27 10:38:02', 'Super course !!'),
(23, 12, '2023-04-27 12:36:07', 'tu n''as pas mis de description Eve ?'),
(33, 33, '2023-04-27 12:40:35', 'tu gÃ¨res !!'),
(37, 12, '2023-04-26 18:35:22', 'Woow trop bien !!'),
(37, 12, '2023-04-26 18:35:42', 'ooooh'),
(37, 33, '2023-04-27 12:39:05', 't''es vraiment trop fort !!'),
(38, 12, '2023-04-12 09:27:18', 'Woow trop bien !!'),
(38, 33, '2023-04-27 12:39:23', 'woaw ce site est vraiment trop bien fait !!'),
(48, 12, '2023-04-27 10:38:25', 'Bien jouÃ©'),
(48, 32, '2023-04-26 08:18:17', 'Woow trop bien !!'),
(48, 33, '2023-04-27 12:40:01', 'Tu pourrais faire un peu plus la prochaine fois...');

-- --------------------------------------------------------

--
-- Structure de la table `liker`
--

DROP TABLE IF EXISTS `liker`;
CREATE TABLE IF NOT EXISTS `liker` (
  `ID_post` int(11) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `liker`
--

INSERT INTO `liker` (`ID_post`, `ID_utilisateur`) VALUES
(1, 1),
(3, 1),
(5, 1),
(9, 1),
(10, 1),
(1, 2),
(2, 2),
(5, 2),
(7, 2),
(9, 2),
(2, 3),
(4, 3),
(5, 3),
(10, 3),
(2, 4),
(8, 4),
(10, 4),
(2, 5),
(3, 5),
(10, 5),
(2, 6),
(3, 6),
(6, 6),
(9, 6),
(2, 7),
(6, 7),
(9, 7),
(2, 8),
(4, 8),
(6, 8),
(9, 8),
(2, 9),
(4, 9),
(7, 9),
(8, 9),
(1, 10),
(2, 10),
(4, 10),
(8, 10),
(16, 12),
(37, 12),
(38, 12),
(48, 12),
(32, 33),
(33, 33),
(37, 33),
(38, 33),
(48, 33);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
`ID_post` int(11) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL,
  `date` date NOT NULL,
  `distance` int(11) NOT NULL,
  `temps` time NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`ID_post`, `ID_utilisateur`, `date`, `distance`, `temps`, `lieu`, `description`) VALUES
(1, 1, '2023-01-01', 5000, '00:35:00', 'Central Park', 'Belle aprem pour courir !'),
(2, 1, '2023-01-03', 8000, '01:00:00', 'Brooklyn Bridge', 'J''ai rÃ©ussi a battre mon record personnel !'),
(3, 1, '2023-01-05', 10000, '01:15:00', 'Hudson River Park', 'Je suis mort, mais content de l''avoir fait.'),
(4, 1, '2023-01-07', 6000, '00:45:00', 'Central Park', 'Superbe vue sur l''Hudson River !'),
(5, 1, '2023-01-09', 9000, '01:20:00', 'Prospect Park', 'J''ai pris mon temps et j''ai vraiment pris du plaisir.'),
(6, 2, '2023-01-01', 4000, '00:30:00', 'Coney Island', 'Le vent m''a ralenti, mais j''ai quand mÃªme rÃ©ussi a finir ma course.'),
(7, 2, '2023-01-03', 7000, '00:50:00', 'Battery Park', 'Il faisait chaud aujourd''hui, mais j''ai quand mÃªme rÃ©ussi a faire ma course.'),
(8, 2, '2023-01-05', 9000, '01:10:00', 'Central Park', 'Je me suis reveiller tot pour courir, et j''ai vraiment apprÃ©ciÃ© la tranquillitÃ© du parc.'),
(9, 2, '2023-01-07', 6000, '00:45:00', 'Hudson River Park', 'Je suis content de ma course, mais je suis vraiment fatiguÃ© maintenant.'),
(10, 2, '2023-01-09', 8000, '01:00:00', 'Brooklyn Bridge', 'J''ai couru avec mon ami aujourd''hui, c''etait super motivant.'),
(11, 3, '2023-02-01', 7000, '00:50:00', 'Central Park', 'Je suis heureux d''avoir fini ma course malgrÃ© la pluie.'),
(12, 3, '2023-02-03', 10000, '01:15:00', 'Empire State Building', 'J''ai couru un peu plus lentement aujourd''hui, mais c''Ã©tait toujours agrÃ©able.'),
(13, 3, '2023-02-05', 12000, '01:30:00', 'Statue of Liberty', 'Je suis content d''avoir couru malgre ma mauvaise humeur ce matin.'),
(14, 3, '2023-02-07', 8000, '01:00:00', 'Times Square', 'Les couleurs de l''automne etaient magnifiques pendant ma course aujourd''hui.'),
(15, 3, '2023-02-09', 11000, '01:35:00', 'Brooklyn Bridge', 'J''ai bien couru, mais j''ai oublier d''apporter de l''eau.'),
(16, 3, '2023-02-11', 6000, '00:45:00', 'Grand Central Terminal', 'Je suis fier de moi pour avoir fini ma premiere course de 10 km.'),
(17, 3, '2023-02-13', 9000, '01:20:00', 'Washington Square Park', 'Je me suis blesser pendant ma course, mais heureusement ce n''etait rien de grave.'),
(18, 4, '2023-02-01', 7000, '00:50:00', 'Central Park', NULL),
(19, 4, '2023-02-03', 10000, '01:15:00', 'Empire State Building', NULL),
(20, 4, '2023-02-05', 12000, '01:30:00', 'Statue of Liberty', NULL),
(21, 4, '2023-02-07', 8000, '01:00:00', 'Times Square', NULL),
(22, 4, '2023-02-09', 11000, '01:35:00', 'Brooklyn Bridge', NULL),
(23, 4, '2023-02-11', 6000, '00:45:00', 'Grand Central Terminal', NULL),
(24, 4, '2023-02-13', 9000, '01:20:00', 'Washington Square Park', NULL),
(32, 12, '2023-04-04', 5000, '00:15:00', 'Belfort - Sevenans', '1ere course !!'),
(33, 12, '2023-04-06', 10011, '00:30:00', 'Belfort', '2e course !!'),
(37, 12, '2023-04-11', 3500, '00:36:00', 'Belfort - Sevenans', 'toujours bon'),
(38, 12, '2023-04-11', 150000, '22:00:00', 'Alsace', 'Wow ca en fait des km'),
(48, 32, '2023-04-26', 3000, '00:20:00', 'Rouffach', 'c''Ã©tait fatiguant');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
`ID_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_inscription` date NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `date_naissance`, `date_inscription`, `avatar`) VALUES
(1, 'Doe', 'John', 'johndoe@example.com', '7c6a180b36896a0a8c02787eeafb0e4c', '1980-01-01', '2022-01-01', './Icones/Avatars/avatar1.png'),
(2, 'Doe', 'Jane', 'janedoe@example.com', '6cb75f652a9b52798eb6cf2201057c73', '1985-01-01', '2022-01-02', './Icones/Avatars/avatar2.png'),
(3, 'Smith', 'Adam', 'adamsmith@example.com', '819b0643d6b89dc9b579fdfc9094f28e', '1990-01-01', '2022-01-03', './Icones/Avatars/default.png'),
(4, 'Smith', 'Eve', 'evesmith@example.com', '34cc93ece0ba9e3f6f235d4af979b16c', '1995-01-01', '2022-01-04', './Icones/Avatars/avatar3.png'),
(5, 'Johnson', 'David', 'davidjohnson@example.com', 'db0edd04aaac4506f7edab03ac855d56', '2000-01-01', '2022-01-05', './Icones/Avatars/default.png'),
(6, 'Johnson', 'Emily', 'emilyjohnson@example.com', '218dd27aebeccecae69ad8408d9a36bf', '2005-01-01', '2022-01-06', './Icones/Avatars/default.png'),
(7, 'Garcia', 'Juan', 'juangarcia@example.com', '00cdb7bb942cf6b290ceb97d6aca64a3', '2010-01-01', '2022-01-07', './Icones/Avatars/default.png'),
(8, 'Garcia', 'Maria', 'mariagarcia@example.com', 'b25ef06be3b6948c0bc431da46c2c738', '2015-01-01', '2022-01-08', './Icones/Avatars/avatar2.png'),
(9, 'Kim', 'Sung', 'sungkim@example.com', '5d69dd95ac183c9643780ed7027d128a', '2020-01-01', '2022-01-09', './Icones/Avatars/avatar1.png'),
(10, 'Kim', 'Ji', 'jikim@example.com', '87e897e3b54a405da144968b2ca19b45', '2025-01-01', '2022-01-10', './Icones/Avatars/default.png'),
(11, 'Brichet', 'Clement', 'clement.brichet@utbm.fr', '236e92bcf7c04d8d7ff3f798b537823f', '2003-03-07', '2023-03-31', './Icones/Avatars/default.png'),
(12, 'Maurer', 'Gilles', 'gilles.maurer@utbm.fr', 'e543fdb4737f66b96e764d7303a15ae8', '2003-03-26', '2023-03-31', './Icones/Avatars/gilles.png'),
(32, 'Daway', 'Osman', 'daway@gmail.com', 'eb62f6b9306db575c2d596b1279627a4', '2002-04-01', '2023-04-26', './Icones/Avatars/default.png'),
(33, 'Savin', 'Leanne', 'leanneSavin@gmail.com', 'e6ba6a95e92ab02920655918863e5bf8', '2001-09-21', '2023-04-26', './Icones/Avatars/64499d7422a71_Savin.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abonne`
--
ALTER TABLE `abonne`
 ADD PRIMARY KEY (`ID_suivie`,`ID_suiveur`), ADD KEY `ID_suiveur` (`ID_suiveur`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
 ADD PRIMARY KEY (`ID_post`,`ID_utilisateur`,`date`), ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `liker`
--
ALTER TABLE `liker`
 ADD PRIMARY KEY (`ID_post`,`ID_utilisateur`), ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`ID_post`), ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`ID_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
MODIFY `ID_post` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abonne`
--
ALTER TABLE `abonne`
ADD CONSTRAINT `abonne_ibfk_1` FOREIGN KEY (`ID_suivie`) REFERENCES `utilisateur` (`ID_utilisateur`),
ADD CONSTRAINT `abonne_ibfk_2` FOREIGN KEY (`ID_suiveur`) REFERENCES `utilisateur` (`ID_utilisateur`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ID_post`) REFERENCES `post` (`ID_post`),
ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`);

--
-- Contraintes pour la table `liker`
--
ALTER TABLE `liker`
ADD CONSTRAINT `liker_ibfk_1` FOREIGN KEY (`ID_post`) REFERENCES `post` (`ID_post`),
ADD CONSTRAINT `liker_ibfk_2` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
