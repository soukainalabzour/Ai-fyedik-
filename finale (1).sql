-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 01:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finale`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `NOM_ADMIN` varchar(30) DEFAULT NULL,
  `PRENOM_ADMIN` varchar(30) DEFAULT NULL,
  `EMAIL_ADMIN` varchar(30) DEFAULT NULL,
  `PASSWORD_ADMIN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID_CATEGORY` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CATEGORY` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID_CATEGORY`, `NOM_CATEGORY`) VALUES
(1, ' Music & Audio'),
(2, ' Writing & Translation'),
(3, ' Video & Animation'),
(4, ' Programming & Tech'),
(5, ' Graphics & Design');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CLIENT` varchar(30) DEFAULT NULL,
  `PRENOM_CLIENT` varchar(30) DEFAULT NULL,
  `LANGUAGE_CLIENT` varchar(30) DEFAULT NULL,
  `EMAIL_CLIENT` varchar(30) DEFAULT NULL,
  `PAYS_CLIENT` varchar(30) DEFAULT NULL,
  `VILLE_CLIENT` varchar(30) DEFAULT NULL,
  `ADRESSE_CLIENT` varchar(30) DEFAULT NULL,
  `NUM_CLIENT` int(11) DEFAULT NULL,
  `PROFILE_CLIENT` varchar(30) DEFAULT NULL,
  `PASSWORD_CLIENT` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `LANGUAGE_CLIENT`, `EMAIL_CLIENT`, `PAYS_CLIENT`, `VILLE_CLIENT`, `ADRESSE_CLIENT`, `NUM_CLIENT`, `PROFILE_CLIENT`, `PASSWORD_CLIENT`) VALUES
(1, 'soukaina', 'labzour', 'arabe', 'labzoursoukaina@gmail.com', 'morocco', 'Tanger', 'boukhalef', 617373801, NULL, '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `ID_CLIENT` int(11) NOT NULL,
  `ID_SELLER` int(11) NOT NULL,
  `ID_DISCUSSION` int(11) NOT NULL,
  `DATE_DISCUSSION` timestamp NULL DEFAULT NULL,
  `MSG_DISCUSSION` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `ID_CLIENT` int(11) NOT NULL,
  `ID_SERVICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `langue`
--

CREATE TABLE `langue` (
  `ID_LANGUE` int(11) NOT NULL,
  `NOM_LANGUE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `langue`
--

INSERT INTO `langue` (`ID_LANGUE`, `NOM_LANGUE`) VALUES
(1, 'English'),
(2, 'Arabe'),
(3, 'Frensh'),
(4, 'Germany'),
(5, 'Spanish'),
(6, 'Italy'),
(7, 'Chine'),
(8, 'amazigh'),
(9, 'Japan'),
(10, 'Kuwait');

-- --------------------------------------------------------

--
-- Table structure for table `langue_seller`
--

CREATE TABLE `langue_seller` (
  `ID_SELLER` int(11) NOT NULL,
  `ID_LANGUE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_categories`
--

CREATE TABLE `manage_categories` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_CATEGORY` int(11) NOT NULL,
  `ADMIN_CATEGORY` timestamp NULL DEFAULT NULL,
  `TYPE_MCATEGORIES` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_client1`
--

CREATE TABLE `manage_client1` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `ADMIN_CLIENT` timestamp NULL DEFAULT NULL,
  `TYPE_MC` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_langue1`
--

CREATE TABLE `manage_langue1` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_LANGUE` int(11) NOT NULL,
  `ADMIN_LANGUE` timestamp NULL DEFAULT NULL,
  `TYPE_MLANGUE` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_seller1`
--

CREATE TABLE `manage_seller1` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_SELLER` int(11) NOT NULL,
  `ADMIN_SELLER` timestamp NULL DEFAULT NULL,
  `TYPE_MSELLER` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_service1`
--

CREATE TABLE `manage_service1` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_SERVICE` int(11) NOT NULL,
  `ADMIN_SERVICE` timestamp NULL DEFAULT NULL,
  `TYPE_MSERVICE` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_skills`
--

CREATE TABLE `manage_skills` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_SKILLS` int(11) NOT NULL,
  `ADMIN_SKILL` timestamp NULL DEFAULT NULL,
  `TYPE_MSKILL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `ID_NEWS` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `TITRE_NEWS` varchar(150) DEFAULT NULL,
  `IMG_NEWS` varchar(250) DEFAULT NULL,
  `LIEN_NEWS` varchar(200) DEFAULT NULL,
  `DATE_POSTE` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `ID_ORDER` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_SERVICE` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `DATE_ORDER` timestamp NULL DEFAULT NULL,
  `ETAT_ORDER` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presente`
--

CREATE TABLE `presente` (
  `ID_SELLER` int(11) NOT NULL,
  `ID_SERVICE` int(11) NOT NULL,
  `IMG_SERVICE` varchar(250) DEFAULT NULL,
  `TITLE_SERVICE` varchar(100) DEFAULT NULL,
  `PRICE_SERVICE` decimal(19,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `ID_SELLER` int(11) NOT NULL,
  `NOM_SELLER` varchar(50) DEFAULT NULL,
  `PRENOM_SELLER` varchar(50) DEFAULT NULL,
  `DESCRIPTION_SELLER` varchar(50) DEFAULT NULL,
  `LIEN_SELLER` varchar(50) DEFAULT NULL,
  `PASSWORD_SELLER` varchar(50) DEFAULT NULL,
  `EMAIL_SELLER` varchar(50) DEFAULT NULL,
  `PHOTO_SELLER` varchar(50) DEFAULT NULL,
  `COVER_SELLER` varchar(50) DEFAULT NULL,
  `NUM_SELLER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`ID_SELLER`, `NOM_SELLER`, `PRENOM_SELLER`, `DESCRIPTION_SELLER`, `LIEN_SELLER`, `PASSWORD_SELLER`, `EMAIL_SELLER`, `PHOTO_SELLER`, `COVER_SELLER`, `NUM_SELLER`) VALUES
(1, NULL, NULL, NULL, NULL, '11111111', 'mohamedsaalali@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ID_SERVICE` int(11) NOT NULL,
  `ID_CATEGORY` int(11) NOT NULL,
  `NOM_SERVICE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `ID_SKILLS` int(11) NOT NULL,
  `NAME_SKILL` varchar(50) DEFAULT NULL,
  `SKILL_DESCRIPTION` varchar(50) DEFAULT NULL,
  `STATUT` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skill_seller`
--

CREATE TABLE `skill_seller` (
  `ID_SELLER` int(11) NOT NULL,
  `ID_SKILLS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID_CATEGORY`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`ID_DISCUSSION`),
  ADD KEY `FK_DISCUSSION_CLIENT` (`ID_CLIENT`),
  ADD KEY `FK_DISCUSSION_SELLER` (`ID_SELLER`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD KEY `FK_FAVORITE_CLIENT` (`ID_CLIENT`),
  ADD KEY `FK_FAVORITE_SERVICE` (`ID_SERVICE`);

--
-- Indexes for table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`ID_LANGUE`);

--
-- Indexes for table `langue_seller`
--
ALTER TABLE `langue_seller`
  ADD KEY `FK_LANGUE_SELLER_SELLER` (`ID_SELLER`),
  ADD KEY `FK_LANGUE_SELLER_LANGUE` (`ID_LANGUE`);

--
-- Indexes for table `manage_categories`
--
ALTER TABLE `manage_categories`
  ADD KEY `FK_MANAGE_CATEGORIES_ADMIN` (`ID_ADMIN`),
  ADD KEY `FK_MANAGE_CATEGORIES_CATEGORY` (`ID_CATEGORY`);

--
-- Indexes for table `manage_client1`
--
ALTER TABLE `manage_client1`
  ADD KEY `FK_MANAGE_CLIENT1_ADMIN` (`ID_ADMIN`),
  ADD KEY `FK_MANAGE_CLIENT1_CLIENT` (`ID_CLIENT`);

--
-- Indexes for table `manage_langue1`
--
ALTER TABLE `manage_langue1`
  ADD KEY `FK_MANAGE_LANGUE1_ADMIN` (`ID_ADMIN`),
  ADD KEY `FK_MANAGE_LANGUE1_LANGUE` (`ID_LANGUE`);

--
-- Indexes for table `manage_seller1`
--
ALTER TABLE `manage_seller1`
  ADD KEY `FK_MANAGE_SELLER1_ADMIN` (`ID_ADMIN`),
  ADD KEY `FK_MANAGE_SELLER1_SELLER` (`ID_SELLER`);

--
-- Indexes for table `manage_service1`
--
ALTER TABLE `manage_service1`
  ADD KEY `FK_MANAGE_SERVICE1_ADMIN` (`ID_ADMIN`),
  ADD KEY `FK_MANAGE_SERVICE1_SERVICE` (`ID_SERVICE`);

--
-- Indexes for table `manage_skills`
--
ALTER TABLE `manage_skills`
  ADD KEY `FK_MANAGE_SKILLS_ADMIN` (`ID_ADMIN`),
  ADD KEY `FK_MANAGE_SKILLS_SKILLS` (`ID_SKILLS`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID_NEWS`),
  ADD KEY `FK_NEWS_ADMIN` (`ID_ADMIN`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ID_ORDER`),
  ADD KEY `FK_ORDER_CLIENT` (`ID_CLIENT`),
  ADD KEY `FK_ORDER_SERVICE` (`ID_SERVICE`),
  ADD KEY `FK_ORDER_ADMIN` (`ID_ADMIN`);

--
-- Indexes for table `presente`
--
ALTER TABLE `presente`
  ADD KEY `FK_PRESENTE_SELLER` (`ID_SELLER`),
  ADD KEY `FK_PRESENTE_SERVICE` (`ID_SERVICE`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`ID_SELLER`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID_SERVICE`),
  ADD KEY `FK_SERVICE_CATEGORY` (`ID_CATEGORY`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`ID_SKILLS`);

--
-- Indexes for table `skill_seller`
--
ALTER TABLE `skill_seller`
  ADD KEY `FK_SKILL_SELLER_SELLER` (`ID_SELLER`),
  ADD KEY `FK_SKILL_SELLER_SKILLS` (`ID_SKILLS`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID_CATEGORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `langue`
--
ALTER TABLE `langue`
  MODIFY `ID_LANGUE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `ID_SELLER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `ID_SERVICE` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `FK_DISCUSSION_CLIENT` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`),
  ADD CONSTRAINT `FK_DISCUSSION_SELLER` FOREIGN KEY (`ID_SELLER`) REFERENCES `seller` (`ID_SELLER`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `FK_FAVORITE_CLIENT` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`),
  ADD CONSTRAINT `FK_FAVORITE_SERVICE` FOREIGN KEY (`ID_SERVICE`) REFERENCES `service` (`ID_SERVICE`);

--
-- Constraints for table `langue_seller`
--
ALTER TABLE `langue_seller`
  ADD CONSTRAINT `FK_LANGUE_SELLER_LANGUE` FOREIGN KEY (`ID_LANGUE`) REFERENCES `langue` (`ID_LANGUE`),
  ADD CONSTRAINT `FK_LANGUE_SELLER_SELLER` FOREIGN KEY (`ID_SELLER`) REFERENCES `seller` (`ID_SELLER`);

--
-- Constraints for table `manage_categories`
--
ALTER TABLE `manage_categories`
  ADD CONSTRAINT `FK_MANAGE_CATEGORIES_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_MANAGE_CATEGORIES_CATEGORY` FOREIGN KEY (`ID_CATEGORY`) REFERENCES `category` (`ID_CATEGORY`);

--
-- Constraints for table `manage_client1`
--
ALTER TABLE `manage_client1`
  ADD CONSTRAINT `FK_MANAGE_CLIENT1_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_MANAGE_CLIENT1_CLIENT` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`);

--
-- Constraints for table `manage_langue1`
--
ALTER TABLE `manage_langue1`
  ADD CONSTRAINT `FK_MANAGE_LANGUE1_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_MANAGE_LANGUE1_LANGUE` FOREIGN KEY (`ID_LANGUE`) REFERENCES `langue` (`ID_LANGUE`);

--
-- Constraints for table `manage_seller1`
--
ALTER TABLE `manage_seller1`
  ADD CONSTRAINT `FK_MANAGE_SELLER1_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_MANAGE_SELLER1_SELLER` FOREIGN KEY (`ID_SELLER`) REFERENCES `seller` (`ID_SELLER`);

--
-- Constraints for table `manage_service1`
--
ALTER TABLE `manage_service1`
  ADD CONSTRAINT `FK_MANAGE_SERVICE1_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_MANAGE_SERVICE1_SERVICE` FOREIGN KEY (`ID_SERVICE`) REFERENCES `service` (`ID_SERVICE`);

--
-- Constraints for table `manage_skills`
--
ALTER TABLE `manage_skills`
  ADD CONSTRAINT `FK_MANAGE_SKILLS_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_MANAGE_SKILLS_SKILLS` FOREIGN KEY (`ID_SKILLS`) REFERENCES `skills` (`ID_SKILLS`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_NEWS_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_ORDER_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`),
  ADD CONSTRAINT `FK_ORDER_CLIENT` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`),
  ADD CONSTRAINT `FK_ORDER_SERVICE` FOREIGN KEY (`ID_SERVICE`) REFERENCES `service` (`ID_SERVICE`);

--
-- Constraints for table `presente`
--
ALTER TABLE `presente`
  ADD CONSTRAINT `FK_PRESENTE_SELLER` FOREIGN KEY (`ID_SELLER`) REFERENCES `seller` (`ID_SELLER`),
  ADD CONSTRAINT `FK_PRESENTE_SERVICE` FOREIGN KEY (`ID_SERVICE`) REFERENCES `service` (`ID_SERVICE`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_SERVICE_CATEGORY` FOREIGN KEY (`ID_CATEGORY`) REFERENCES `category` (`ID_CATEGORY`);

--
-- Constraints for table `skill_seller`
--
ALTER TABLE `skill_seller`
  ADD CONSTRAINT `FK_SKILL_SELLER_SELLER` FOREIGN KEY (`ID_SELLER`) REFERENCES `seller` (`ID_SELLER`),
  ADD CONSTRAINT `FK_SKILL_SELLER_SKILLS` FOREIGN KEY (`ID_SKILLS`) REFERENCES `skills` (`ID_SKILLS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
