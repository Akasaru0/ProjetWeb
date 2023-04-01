-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 01 avr. 2023 à 23:40
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `climbingbdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `bloc`
--

CREATE TABLE `bloc` (
  `id` int(11) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `id_couleur` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 1,
  `id_salle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bloc`
--

INSERT INTO `bloc` (`id`, `img_path`, `description`, `id_couleur`, `etat`, `id_salle`) VALUES
(1, NULL, 'Burden of Dreams', 1, 1, 1),
(2, NULL, 'Return of the Sleepwalker', 1, 1, 1),
(3, NULL, 'Soudain Seul', 6, 1, 1),
(4, NULL, 'Floatin', 2, 1, 1),
(5, NULL, 'Gioia ', 3, 1, 1),
(6, NULL, 'Nexus ', 4, 1, 1),
(7, NULL, 'United ', 5, 1, 1),
(8, NULL, 'Big Z', 3, 1, 1),
(9, NULL, 'Hypnotized Minds', 6, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `id_bloc` int(11) NOT NULL,
  `libelle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_user`, `date_creation`, `id_bloc`, `libelle`) VALUES
(1, 31, '2023-03-09 09:11:38', 7, 'Nul le bloc 7'),
(2, 31, '2023-03-09 09:12:11', 3, 'Pas mal le bloc 3');

-- --------------------------------------------------------

--
-- Structure de la table `cotation`
--

CREATE TABLE `cotation` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cotation`
--

INSERT INTO `cotation` (`id`, `libelle`, `valeur`) VALUES
(1, 'Très difficile', 5),
(2, 'Difficile', 4),
(3, 'Neutre', 3),
(4, 'Facile', 2),
(5, 'Très facile', 1);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE `couleur` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `rgb_code` varchar(20) NOT NULL,
  `valeur` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `libelle`, `rgb_code`, `valeur`) VALUES
(1, 'jaune', '255,255,0', 1),
(2, 'vert', '0,255,0', 2),
(3, 'bleu', '0,0,255', 3),
(4, 'rouge', '255,0,0', 4),
(5, 'noir', '0,0,0', 5),
(6, 'violet', '127,0,255', 6);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `nom`, `adresse`, `image_path`) VALUES
(1, 'Climb UP', 'Limoges', NULL),
(2, 'Salle gravite', 'Paris', NULL),
(3, 'PlaneteGrimpe', 'Nantes', 'NULL'),
(4, 'Grimpeur', 'Auxerre', 'non'),
(6, 'LaVerticale', 'Berk', 'NULL'),
(8, 'Altissimo', 'Rouen', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL DEFAULT 'USER',
  `activation_token` varchar(255) DEFAULT '',
  `change_password` tinyint(1) NOT NULL DEFAULT 0,
  `activated` tinyint(1) NOT NULL DEFAULT 0,
  `derniere_connexion` datetime NOT NULL DEFAULT current_timestamp(),
  `is_connecte` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `mail`, `username`, `password`, `roles`, `activation_token`, `change_password`, `activated`, `derniere_connexion`, `is_connecte`) VALUES
(31, 'todit59591@bymercy.com', 'todit59591', '$2y$10$g4liDg35USI1Y3ZwLSK.bO2pQK3QSJ8Jkt41.TZfCMQIJYn1NvanK', 'USER;EDITOR;ADMIN', '4d9e83a3550d9d5a8802b3a11cb46d36c5963588', 0, 1, '2023-03-21 10:23:28', 1),
(42, 'jaberop355@necktai.com', 'jaberop355', '$2y$10$2gSyo2yqRhuXwKY9JsZim.Kw/smOByn725DGeMIgFU8ZMWkx89A2W', 'USER', 'cb4a59f2d479ce47d6a6f9d0d37121028b68ce7d', 0, 1, '2023-03-20 19:53:07', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bloc` int(11) NOT NULL,
  `id_cotation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id`, `id_user`, `id_bloc`, `id_cotation`) VALUES
(1, 31, 6, 4),
(2, 31, 7, 1),
(3, 31, 3, 2),
(6, 31, 8, 1),
(7, 31, 9, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bloc`
--
ALTER TABLE `bloc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `COULEUR_CONSTRAINT` (`id_couleur`),
  ADD KEY `SALLE_CONSTRAINT` (`id_salle`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `USER_FKEY` (`id_user`),
  ADD KEY `BLOC_FKEY` (`id_bloc`);

--
-- Index pour la table `cotation`
--
ALTER TABLE `cotation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `couleur`
--
ALTER TABLE `couleur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_NOM_SALLE` (`nom`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_USER_BLOC` (`id_user`,`id_bloc`),
  ADD KEY `COTATION_FKEY` (`id_cotation`),
  ADD KEY `BLOC_FOKEY` (`id_bloc`),
  ADD KEY `USER_FOKEY` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bloc`
--
ALTER TABLE `bloc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cotation`
--
ALTER TABLE `cotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `couleur`
--
ALTER TABLE `couleur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bloc`
--
ALTER TABLE `bloc`
  ADD CONSTRAINT `COULEUR_CONSTRAINT` FOREIGN KEY (`id_couleur`) REFERENCES `couleur` (`id`),
  ADD CONSTRAINT `SALLE_CONSTRAINT` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `BLOC_FKEY` FOREIGN KEY (`id_bloc`) REFERENCES `bloc` (`id`),
  ADD CONSTRAINT `USER_FKEY` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `BLOC_FOKEY` FOREIGN KEY (`id_bloc`) REFERENCES `bloc` (`id`),
  ADD CONSTRAINT `COTATION_FKEY` FOREIGN KEY (`id_cotation`) REFERENCES `cotation` (`id`),
  ADD CONSTRAINT `USER_FOKEY` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
