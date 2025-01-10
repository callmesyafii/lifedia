-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 09:20 AM
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
-- Database: `rpl_lifedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `Id` int(11) NOT NULL,
  `NamaLengkap` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NomorTelepon` varchar(20) DEFAULT NULL,
  `TanggalLahir` date DEFAULT NULL,
  `JenisKelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `Tinggi` decimal(5,2) DEFAULT NULL,
  `BeratBadan` decimal(5,2) DEFAULT NULL,
  `IndeksMasaTubuh` decimal(5,2) DEFAULT NULL,
  `Minat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `NamaLengkap` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NomorTelepon` varchar(20) DEFAULT NULL,
  `TanggalLahir` date DEFAULT NULL,
  `JenisKelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `Tinggi` decimal(5,2) DEFAULT NULL,
  `BeratBadan` decimal(5,2) DEFAULT NULL,
  `IndeksMasaTubuh` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyediaasuransi`
--

CREATE TABLE `penyediaasuransi` (
  `Id` int(11) NOT NULL,
  `NamaMerek` varchar(100) NOT NULL,
  `PaketAsuransi` varchar(100) NOT NULL,
  `BesaranPolis` decimal(10,2) DEFAULT NULL,
  `BesaranTanggungan` decimal(10,2) DEFAULT NULL,
  `Logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `penyediaasuransi`
--
ALTER TABLE `penyediaasuransi`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyediaasuransi`
--
ALTER TABLE `penyediaasuransi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
