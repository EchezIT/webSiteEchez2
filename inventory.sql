-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 08:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `alquilado`
--

CREATE TABLE `alquilado` (
  `Id` int(11) NOT NULL,
  `User_Name` varchar(255) DEFAULT NULL,
  `Serial` varchar(255) NOT NULL,
  `PC_Name` varchar(255) DEFAULT NULL,
  `Installation_Date` date DEFAULT NULL,
  `Plate_PC` float DEFAULT NULL,
  `Specifications` varchar(255) DEFAULT NULL,
  `Ram` varchar(255) DEFAULT NULL,
  `Desktop_Laptop` varchar(255) DEFAULT NULL,
  `Domain` varchar(255) DEFAULT NULL,
  `Status_PC` tinyint(1) NOT NULL,
  `dateUpdate_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alquilado`
--

INSERT INTO `alquilado` (`Id`, `User_Name`, `Serial`, `PC_Name`, `Installation_Date`, `Plate_PC`, `Specifications`, `Ram`, `Desktop_Laptop`, `Domain`, `Status_PC`, `dateUpdate_Date`) VALUES
(1, 'Adriana Lucia Prieto', 'CT0WGB3', 'ECHEZCOLWGB3A', '2023-11-15', 44155, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, '2023-11-30'),
(2, 'Alexandra Reinosa', '5CD209B7RT', 'ECHEZCOLB7RTA', '2023-11-15', 66374, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 0, '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `FkIdUsuario` int(11) DEFAULT NULL,
  `FkIdRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alquilado`
--
ALTER TABLE `alquilado`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD KEY `FkIdUsuario` (`FkIdUsuario`),
  ADD KEY `FkIdRol` (`FkIdRol`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alquilado`
--
ALTER TABLE `alquilado`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`FkIdUsuario`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`FkIdRol`) REFERENCES `rol` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
