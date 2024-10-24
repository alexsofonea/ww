-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2024 at 11:18 PM
-- Server version: 10.11.6-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ww`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` varchar(60) NOT NULL,
  `publicId` varchar(50) NOT NULL,
  `mail` varchar(320) NOT NULL,
  `password` varchar(500) NOT NULL,
  `name` varchar(300) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `confirm` int(1) NOT NULL,
  `code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

CREATE TABLE `capabilities` (
  `id` varchar(100) NOT NULL,
  `capId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hosting`
--

CREATE TABLE `hosting` (
  `id` varchar(50) NOT NULL,
  `v` varchar(10) NOT NULL,
  `root` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` varchar(200) NOT NULL,
  `accountId` varchar(200) NOT NULL,
  `projectId` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `publicKey` varchar(1000) NOT NULL,
  `use` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` varchar(60) NOT NULL,
  `publicId` varchar(100) NOT NULL,
  `ownerName` text NOT NULL,
  `owner` varchar(60) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `picture` varchar(100) NOT NULL,
  `domain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` varchar(100) NOT NULL,
  `projectId` varchar(100) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` varchar(60) NOT NULL,
  `accountId` varchar(60) NOT NULL,
  `ip` varchar(80) NOT NULL,
  `lon` double NOT NULL,
  `lat` double NOT NULL,
  `device` varchar(100) NOT NULL,
  `deviceId` varchar(100) NOT NULL,
  `date` int(15) NOT NULL,
  `expiration` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwAccounts`
--

CREATE TABLE `wwAccounts` (
  `for` varchar(50) NOT NULL,
  `id` varchar(60) NOT NULL,
  `publicId` varchar(50) NOT NULL,
  `mail` varchar(320) NOT NULL,
  `password` varchar(500) NOT NULL,
  `name` varchar(300) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `confirm` int(1) NOT NULL,
  `code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwAccountsConfig`
--

CREATE TABLE `wwAccountsConfig` (
  `projectId` varchar(100) NOT NULL,
  `entry` varchar(300) NOT NULL,
  `method` int(1) NOT NULL,
  `payment` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwConnect`
--

CREATE TABLE `wwConnect` (
  `id` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `server` varchar(100) NOT NULL,
  `project` varchar(100) NOT NULL,
  `forId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwDesign`
--

CREATE TABLE `wwDesign` (
  `id` varchar(100) NOT NULL,
  `category` int(2) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `style` varchar(50) NOT NULL,
  `html` text NOT NULL,
  `css` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`css`)),
  `js` text NOT NULL,
  `aditionalJs` text NOT NULL,
  `variables` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwDesignCathegory`
--

CREATE TABLE `wwDesignCathegory` (
  `id` int(2) NOT NULL,
  `name` varchar(200) NOT NULL,
  `font` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwDesignTypes`
--

CREATE TABLE `wwDesignTypes` (
  `id` int(2) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wwLiveSocketServer`
--

CREATE TABLE `wwLiveSocketServer` (
  `id` varchar(50) NOT NULL,
  `project` varchar(100) NOT NULL,
  `server` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wwAccounts`
--
ALTER TABLE `wwAccounts`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `wwConnect`
--
ALTER TABLE `wwConnect`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wwDesign`
--
ALTER TABLE `wwDesign`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wwDesignCathegory`
--
ALTER TABLE `wwDesignCathegory`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wwDesignTypes`
--
ALTER TABLE `wwDesignTypes`
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
