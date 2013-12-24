-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2013 at 11:37 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bestway`
--

-- --------------------------------------------------------

--
-- Table structure for table `cust_login`
--

CREATE TABLE IF NOT EXISTS `cust_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`CompanyName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cust_login`
--

INSERT INTO `cust_login` (`id`, `username`, `password`, `CompanyName`) VALUES
(1, 'mayline', '$2y$10$GgNT8UTGuBSwCOm7GHFYjuFSv2wKQhlpE37dc3n8cynOUntkawDdm', 'Mayline Industries'),
(2, 'Bradley', '$2y$10$73.B2QnULooBnpkaM2u0xOTz6mR2oIl.prHfCqjhhKHhtbRU69y82', 'Bradley Corporation'),
(3, 'asitech', '$2y$10$yArgBf2pXEzedowAYvRK1uVVTOwyvPg5cDtCCUx7tCtLygV60C06u', 'ASI Technologies'),
(4, 'apatar', '$2y$10$i7LlQy1pChGpGS8V7Vodn.sAvD5E5bjLtZ8BMVIFTSdc7F0iZChGq', 'Apatar'),
(5, 'jrsdist', '$2y$10$tCvYZ2mPb0hyuNvz9XvrPerXeq1jT.i1FbPyxRvZ0poH6NlXBQ.0e', 'JRS Distributions'),
(6, 'cooper', '$2y$10$/DJyP3P5MlUOdXilq7nGR.pWEshe.1wy468bDU118ifWfqdVFao1C', 'Cooper Power Systems'),
(7, 'sellars', '$2y$10$OJbhNYDbLWwCxUTkVx281uBzr17g1jwWme//fSq7JfJ38RZK1WSZm', 'Sellars Absorbents');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_info`
--

CREATE TABLE IF NOT EXISTS `shipment_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Client_Name` varchar(255) NOT NULL,
  `ProNumber` int(11) NOT NULL,
  `Service` varchar(10) NOT NULL,
  `Equipment` varchar(10) NOT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `Pickup_Location` varchar(255) NOT NULL,
  `Delivery_Location` varchar(255) NOT NULL,
  `CurrentLocationCity` varchar(255) NOT NULL,
  `CurrentLocationState` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shipment_info`
--

INSERT INTO `shipment_info` (`id`, `Client_Name`, `ProNumber`, `Service`, `Equipment`, `Status`, `Pickup_Location`, `Delivery_Location`, `CurrentLocationCity`, `CurrentLocationState`) VALUES
(1, 'Staples', 1050, 'Short Haul', 'Flatbed', 'Delivered', 'Oil City, PA', 'Miami, FL', 'Miami', 'FL'),
(2, 'staples', 1051, 'Long Haul', 'Conestoga', 'Picked Up', 'oil city, pa', 'somewhere, NC', 'oil city', 'PA'),
(3, 'staples', 1052, 'Long Haul', 'Flatbed', 'In Transit', 'Franklin, PA', 'somewhere, NC', 'oil city', 'PA');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ProNumber` int(255) NOT NULL,
  `Document_Type` varchar(3) NOT NULL,
  `Location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ProNumber` (`ProNumber`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `ProNumber`, `Document_Type`, `Location`) VALUES
(2, 1050, 'BOL', '1050_BOL_Micheal-Mueller-Resume.pdf'),
(5, 1050, 'POD', '1050_POD_Micheal-Mueller-Resume.pdf'),
(6, 1050, 'INV', '1050_INV_Micheal-Mueller-Resume.pdf'),
(7, 1051, 'BOL', '1051_BOL_Micheal-Mueller-Resume.pdf'),
(8, 1051, 'POD', '1051_POD_Screen to access BOL.jpg'),
(9, 1051, 'INV', '1051_INV_Micheal-Mueller-Resume.pdf');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
