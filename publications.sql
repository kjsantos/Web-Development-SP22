-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2016 at 11:50 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `publications`
--
CREATE DATABASE IF NOT EXISTS `publications` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `publications`;

-- --------------------------------------------------------

--
-- Table structure for table `classics`
--

DROP TABLE IF EXISTS `classics`;
CREATE TABLE IF NOT EXISTS `classics` (
  `author` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `category` varchar(16) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `isbn` char(13) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classics`
--

INSERT INTO `classics` (`author`, `title`, `category`, `year`, `isbn`) VALUES
('Charles Dickens', 'The Old Curiosity Shop', 'Fiction', 1841, '9780099533474'),
('Charles Dickens', 'Little Dorrit', 'Fiction', 1857, '9780141439969'),
('William Shakespeare', 'Romeo and Juliet', 'Play', 1594, '9780192814968'),
('Charles Darwin', 'The Origin of Species', 'Non-Fiction', 1856, '9780517123201'),
('Jane Austen', 'Pride and Prejudice', 'Fiction', 1811, '9780582506206'),
('Mark Twain', 'The Adventures of Tom Sawyer', 'Fiction', 1876, '9781598184891');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `name` varchar(128) DEFAULT NULL,
  `isbn` char(13) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`name`, `isbn`) VALUES
('Joe Bloggs', '9780099533474'),
('Jack Wilson', '9780517123201'),
('Mary Smith', '9780582506206');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classics`
--
ALTER TABLE `classics`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `author` (`author`(20)),
  ADD KEY `title` (`title`(20)),
  ADD KEY `category` (`category`(4)),
  ADD KEY `year` (`year`),
  ADD FULLTEXT KEY `author_2` (`author`,`title`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`isbn`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `classics` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
