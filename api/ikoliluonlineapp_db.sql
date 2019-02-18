-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2017 at 11:43 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikoliluonlineapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mytesttb`
--

CREATE TABLE `mytesttb` (
  `myfield` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `open_application_tb`
--

CREATE TABLE `open_application_tb` (
  `id` int(11) NOT NULL,
  `sz_schoolid` varchar(15) NOT NULL,
  `sz_schoolname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open_application_tb`
--

INSERT INTO `open_application_tb` (`id`, `sz_schoolid`, `sz_schoolname`) VALUES
(1, 'SMU01', 'Sikkim Manipal University'),
(2, 'ATI01', 'Accra Telecommunication Institute'),
(3, 'ACCRAPOLY01', 'Accra Polytechnic'),
(6, 'UNIZIK01', 'Nnamdi Azikiwe University'),
(7, 'UNIPORT01', 'University of Porthacourt'),
(8, 'UNN01', 'University of Nigeria, Nsukka');

-- --------------------------------------------------------

--
-- Table structure for table `reg_code_tb`
--

CREATE TABLE `reg_code_tb` (
  `id` int(11) NOT NULL,
  `reg_code` varchar(15) NOT NULL,
  `sz_schoolid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_code_tb`
--

INSERT INTO `reg_code_tb` (`id`, `reg_code`, `sz_schoolid`) VALUES
(1, 'JWKJXUE745T3ECS', 'SMU01'),
(2, 'X344HTYEUDNNSBE', 'UNIZIK01');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `reg_code` varchar(200) NOT NULL,
  `sz_schoolid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`id`, `user_name`, `user_email`, `user_pass`, `reg_code`, `sz_schoolid`) VALUES
(2, 'Okpala Chinedu Ekene', 'nedu63ima@gmail.com', '12345', 'XMDKEEJ4582US1', 'UNIZIK01,SMU01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `open_application_tb`
--
ALTER TABLE `open_application_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `szschool_id` (`sz_schoolid`);

--
-- Indexes for table `reg_code_tb`
--
ALTER TABLE `reg_code_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_code` (`reg_code`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `open_application_tb`
--
ALTER TABLE `open_application_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reg_code_tb`
--
ALTER TABLE `reg_code_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
