-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2025 at 09:07 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_donations`
--

DROP TABLE IF EXISTS `blood_donations`;
CREATE TABLE IF NOT EXISTS `blood_donations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `blood_type` varchar(10) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `status` varchar(20) DEFAULT 'available',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blood_donations`
--

INSERT INTO `blood_donations` (`id`, `blood_type`, `location`, `quantity`, `status`) VALUES
(3, 'o+', 'kottayam', 2, 'available'),
(4, 'o+', 'kottayam', 23, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

DROP TABLE IF EXISTS `blood_requests`;
CREATE TABLE IF NOT EXISTS `blood_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('pending','fulfilled') DEFAULT 'pending',
  `blood_type` varchar(5) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `request_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

DROP TABLE IF EXISTS `donors`;
CREATE TABLE IF NOT EXISTS `donors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'abhijithmnair2002@gmail.com', 'abhijithmnair885@gmail.com', '$2y$10$chBlzm0Utz4ARgF3oyu3dO4P1KSsrTodY3D7nZwFUT5vUJWYM3zVa', 'user'),
(2, 'qwerty', 'abhijithmnair885@gmail.com', '$2y$10$rtVM0Bqj30HGF8yoMhFjyOwJgCKQN.ZW4NqK7TjGrIEaunPKILCDS', 'user'),
(3, 'qwerty', 'abhijithmnair885@gmail.com', '$2y$10$dQFoGY.Tgj.nh.Nc9vHHKONDfoSF7EUZZKhepYmUp.wosOhsqeheS', 'user'),
(4, 'qwerty', 'qwerty12@gmail.com', '$2y$10$FSwb.a.uv9G2EU9auS2pvO23y46MGGr82kwU1.Tq/By/70EZyGOua', 'user'),
(5, 'qwerty', 'qwerty12@gmail.com', '$2y$10$HIMllYuAq2GvoaLZQVryXerBBbsR5IygQN0rocslVbPwJxFfwJs1O', 'user'),
(6, 'qwerty123@gmail.com', 'qwerty123@gmail.com', '$2y$10$6eAgTlTdozh4WrdR5GK2pOQqdcdOsLSpUmGpEO4XjoFdPLlGf.KpW', 'user'),
(7, 'qwerty123@gmail.com', 'jojomanuelp543@gmail.com', '$2y$10$PCTGmIvc/Fm8rjIBdSxTX.GZdD6KvlsLSo6jjd29/rFw1nOfST4u.', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
