-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2024 at 11:37 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u264447598_vbms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblannounce`
--

CREATE TABLE `tblannounce` (
  `annid` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subj` varchar(255) NOT NULL,
  `dt_ann` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblannounce`
--

INSERT INTO `tblannounce` (`annid`, `title`, `subj`, `dt_ann`) VALUES
(1, 'sample', 'sample', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblreserve`
--

CREATE TABLE `tblreserve` (
  `reserveid` bigint(20) NOT NULL,
  `vehicle_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `from1` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `departure` varchar(255) NOT NULL,
  `returned` varchar(255) NOT NULL,
  `passenger` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `dt_reserve` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreserve`
--

INSERT INTO `tblreserve` (`reserveid`, `vehicle_id`, `user_id`, `from1`, `destination`, `departure`, `returned`, `passenger`, `status`, `dt_reserve`) VALUES
(12, 3, 1, 'qq', 'qqq', '2024-04-24', '2024-04-25', '1', 'Cancelled', '2024-04-24 10:46:15'),
(13, 4, 1, 'zz', 'zzz', '2024-04-25', '2024-04-26', '11', 'Approved', '2024-04-24 10:47:20'),
(14, 6, 1, 'fg', 'gfg', '2024-04-24', '2024-04-25', '2', 'Cancelled', '2024-04-24 11:48:09'),
(15, 5, 1, 'final', 'test', '2024-04-26', '2024-04-27', '6', 'Cancelled', '2024-04-24 11:52:08'),
(16, 3, 1, 'vd', 'cdf', '2024-04-30', '2024-04-30', '22', 'Approved', '2024-04-24 12:00:43'),
(17, 6, 1, 'sdd', 'sdsds', '2024-04-24', '2024-04-25', '33', 'Cancelled', '2024-04-24 12:47:25'),
(18, 6, 1, 'bvbvbv', 'vbvbvb', '2024-04-25', '2024-04-26', '6', 'Approved', '2024-04-24 12:48:24'),
(19, 5, 1, 'vvvvv', 'vvvvvvvvvvv', '2024-04-25', '2024-04-26', '9', 'Cancelled', '2024-04-24 12:49:00'),
(20, 5, 1, 'vd', 'vdf', '2024-04-25', '2024-04-26', '5', 'Cancelled', '2024-04-24 16:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id_user` bigint(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `dt_user` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id_user`, `firstname`, `lastname`, `address`, `bday`, `age`, `sex`, `username`, `passw`, `role`, `dt_user`) VALUES
(1, 'Administrator', 'Administrator', 'Administrator', 'Administrator', 'Administrator', 'Administrator', 'admin', '12341234', '0', '2024-04-22 13:28:27'),
(3, 'User2', 'User', 'Davao', '2018-06-22', '10', '', 'sampleuser@gmail.com', '12341234', '1', '2024-04-25 16:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicle`
--

CREATE TABLE `tblvehicle` (
  `vehicleid` bigint(20) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `plate` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `renatal` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `dt_vehicle` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblvehicle`
--

INSERT INTO `tblvehicle` (`vehicleid`, `vehicle_type`, `plate`, `color`, `capacity`, `renatal`, `image`, `dt_vehicle`) VALUES
(3, 'Mini Van', '123456', 'BLACK', '6', '2000', 'minivan.jpg', '2024-04-24 07:12:15'),
(4, 'Van', '789456', 'Silver', '20', '5000', 'van.jpg', '2024-04-23 09:37:19'),
(5, 'SUVs', '45454', 'blue', '12', '5000', 'icons8-eggplant-100.png', '2024-04-23 23:39:44'),
(6, 'Elf Truck', '4556', 'fg', '56', '3000', 'ceda56b5-122c-4c24-96ee-a62b65f928b3 (1).jpg', '2024-04-24 10:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblannounce`
--
ALTER TABLE `tblannounce`
  ADD PRIMARY KEY (`annid`);

--
-- Indexes for table `tblreserve`
--
ALTER TABLE `tblreserve`
  ADD PRIMARY KEY (`reserveid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  ADD PRIMARY KEY (`vehicleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblannounce`
--
ALTER TABLE `tblannounce`
  MODIFY `annid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblreserve`
--
ALTER TABLE `tblreserve`
  MODIFY `reserveid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  MODIFY `vehicleid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
