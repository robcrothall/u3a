-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2026 at 03:13 AM
-- Server version: 10.6.27-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afpxyykk_sprv_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_type`
--

CREATE TABLE `address_type` (
  `id` int(11) NOT NULL,
  `addr_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `address_type`
--

INSERT INTO `address_type` (`id`, `addr_type`, `user_id`, `changed`) VALUES
(1, 'Physical', 1, '2020-05-09 08:24:56'),
(2, 'Postal', 1, '2020-05-09 08:24:28'),
(3, 'Delivery', 1, '2022-01-11 08:53:04'),
(4, 'Holiday', 1, '2022-01-27 09:53:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_type`
--
ALTER TABLE `address_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_type`
--
ALTER TABLE `address_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
