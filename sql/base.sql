-- phpMyAdmin SQL Dump
-- version 4.0.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2014 at 07:10 PM
-- Server version: 5.5.31-0+wheezy1
-- PHP Version: 5.4.15-1~dotdeb.2

CREATE DATABASE IF NOT EXISTS ppij;
USE ppij;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `base`
--

-- --------------------------------------------------------

--
-- Table structure for table `HighScore`
--

CREATE TABLE IF NOT EXISTS `HighScore` (
  `id` int(12) PRIMARY KEY AUTO_INCREMENT,
  `userId` int(12) NOT NULL,
  `levelId` int(12) NOT NULL,
  `timeScore` int(16) NOT NULL,
  `stateScore` int(16) NOT NULL,
  `transitionScore` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Level`
--

CREATE TABLE IF NOT EXISTS `Level` (
  `id` int(12) PRIMARY KEY AUTO_INCREMENT,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `passhash` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `User`
--
ALTER TABLE `HighScore`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `levelId` FOREIGN KEY (`levelIid`) REFERENCES `Level` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
