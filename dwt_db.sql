-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2018 at 03:41 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dwt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_tbl`
--

DROP TABLE IF EXISTS `menu_tbl`;
CREATE TABLE IF NOT EXISTS `menu_tbl` (
  `restaurant_name` varchar(50) DEFAULT NULL,
  `menu_item` varchar(50) DEFAULT NULL,
  `item_dec` text,
  `item_price` text,
  `Item_id` int(20) NOT NULL AUTO_INCREMENT,
  `last_update` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7248 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
