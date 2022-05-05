-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2022 at 08:29 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `museum_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_donations`
--

CREATE TABLE `all_donations` (
  `donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `name`, `address`) VALUES
(1, 'John Davis', '111, tree st.'),
(2, 'Margaret Haynes', '28, long ln.');

-- --------------------------------------------------------

--
-- Table structure for table `item_donations`
--

CREATE TABLE `item_donations` (
  `donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `money_donations`
--

CREATE TABLE `money_donations` (
  `donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money_donations`
--

INSERT INTO `money_donations` (`donation_id`, `donor_id`, `amount`, `date`) VALUES
(1, 1, 25, '2022-03-08'),
(3, 1, 1000, '2014-04-07'),
(5, 2, 500000, '2014-07-11'),
(7, 2, 273461, '2014-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `record_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `year` int(4) NOT NULL,
  `exhibit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `name`, `type`, `description`, `year`, `exhibit`) VALUES
(1, 'Art Piece 1', 'Painting', 'painted', 1980, 'the one'),
(2, 'Art Piece 2', 'Sculpture', 'sculpted', 1672, 'the one'),
(3, 'Art Piece 3', 'Photo', 'shot', 1923, 'the two'),
(4, 'Art Piece 4', 'Painting', 'painted', 1340, 'the one'),
(5, 'Art Piece 5', 'Sculpture', 'sculpted', 1980, 'the two');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_donations`
--
ALTER TABLE `all_donations`
  ADD UNIQUE KEY `donation_id_2` (`donation_id`),
  ADD KEY `donation_id` (`donation_id`,`donor_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `item_donations`
--
ALTER TABLE `item_donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `money_donations`
--
ALTER TABLE `money_donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_donations`
--
ALTER TABLE `item_donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `money_donations`
--
ALTER TABLE `money_donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_donations`
--
ALTER TABLE `all_donations`
  ADD CONSTRAINT `all_donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`donor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `all_donations_ibfk_2` FOREIGN KEY (`donation_id`) REFERENCES `item_donations` (`donation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `all_donations_ibfk_3` FOREIGN KEY (`donation_id`) REFERENCES `money_donations` (`donation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_donations`
--
ALTER TABLE `item_donations`
  ADD CONSTRAINT `item_donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`donor_id`),
  ADD CONSTRAINT `item_donations_ibfk_2` FOREIGN KEY (`record_id`) REFERENCES `records` (`record_id`);

--
-- Constraints for table `money_donations`
--
ALTER TABLE `money_donations`
  ADD CONSTRAINT `money_donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`donor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
