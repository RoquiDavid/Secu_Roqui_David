-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Sam 20 Novembre 2021 à 10:02
-- Version du serveur :  5.7.36-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `secu`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `Date_Create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `User_Name`, `User_Password`, `Date_Create`) VALUES
(92, 'a', 'a', '2021-10-28'),
(100, 'Ririshouba', '*A431C1253CB4945959222F5ADCF56B4763D72B76', '2021-11-14'),
(101, 'andrusiasse', '*A431C1253CB4945959222F5ADCF56B4763D72B76', '2021-11-18'),
(102, 'ezezezezezezeze', '*A431C1253CB4945959222F5ADCF56B4763D72B76', '2021-11-18'),
(103, 'andrusiassee', '*A431C1253CB4945959222F5ADCF56B4763D72B76', '2021-11-19'),
(104, 'andrusiasseeee', '*A431C1253CB4945959222F5ADCF56B4763D72B76', '2021-11-19');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
