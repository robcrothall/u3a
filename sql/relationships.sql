-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2026 at 03:28 AM
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
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `id` int(11) NOT NULL,
  `primary_desc` varchar(50) NOT NULL,
  `secondary_desc` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `primary_desc`, `secondary_desc`, `user_id`, `changed`) VALUES
(15, 'Patient', 'Patient', 1, '2020-10-18 14:41:34'),
(16, 'Employee', 'Employer', 1, '2022-11-08 05:10:02'),
(17, 'Family', 'Family', 1, '2020-09-12 09:32:48'),
(18, 'Partner', 'Partner', 1, '2020-09-12 09:34:04'),
(19, 'Spouse', 'Spouse', 1, '2020-09-12 09:34:33'),
(36, 'Executor', 'Executor', 1, '2020-10-18 05:56:25'),
(37, 'Lawyer', 'Lawyer', 1, '2020-10-18 08:45:15'),
(38, 'Doctor', 'Doctor', 1, '2020-10-18 08:45:15'),
(39, 'Minister of Religion', 'Minister of Religion', 1, '2020-10-18 09:07:53'),
(41, 'Reports to', 'Employs', 1, '2022-11-08 05:20:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
