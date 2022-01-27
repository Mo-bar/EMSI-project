-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 01:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int(20) NOT NULL,
  `intitule` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id_cours`, `intitule`) VALUES
(7, 'POO'),
(11, 'PHP'),
(12, 'Data Base'),
(13, 'ENG'),
(14, 'Francais');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id_depart` int(11) NOT NULL,
  `nom_depart` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id_depart`, `nom_depart`) VALUES
(37, 'salle 1'),
(39, 'Salle 2'),
(40, 'Salle 3'),
(41, 'Salle 4');

-- --------------------------------------------------------

--
-- Table structure for table `login_ser`
--

CREATE TABLE `login_ser` (
  `login` varchar(30) NOT NULL,
  `pw` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_ser`
--

INSERT INTO `login_ser` (`login`, `pw`) VALUES
('admin', 'admin'),
('admin1', 'admin1'),
('admin2', 'admin2'),
('hhhhh', 'jjjjj');

-- --------------------------------------------------------

--
-- Table structure for table `prof`
--

CREATE TABLE `prof` (
  `id_prof` int(20) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `date_recrutement` date NOT NULL,
  `id_cours` int(11) NOT NULL,
  `id_depart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_depart`);

--
-- Indexes for table `login_ser`
--
ALTER TABLE `login_ser`
  ADD PRIMARY KEY (`login`);

--
-- Indexes for table `prof`
--
ALTER TABLE `prof`
  ADD UNIQUE KEY `id_prof` (`id_prof`),
  ADD KEY `id_cours` (`id_cours`),
  ADD KEY `id_depart` (`id_depart`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_depart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prof`
--
ALTER TABLE `prof`
  ADD CONSTRAINT `prof_ibfk_1` FOREIGN KEY (`id_depart`) REFERENCES `departement` (`id_depart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prof_ibfk_2` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
