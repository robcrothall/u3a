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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_days` smallint(6) NOT NULL DEFAULT 365,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_days`, `user_id`, `changed`) VALUES
(1, 'ADMIN', 10000, 1, '2019-01-21 22:00:00'),
(2, 'STAFF', 10000, 1, '2019-01-21 22:00:00'),
(3, 'MEMBER', 365, 1, '2019-01-22 12:37:24'),
(4, 'Chairman', 0, 1, '2020-05-09 10:28:32'),
(5, 'CC', 365, 1, '2020-12-26 15:51:09'),
(6, '/sprv/ctl/users.php', 365, 1, '2020-07-18 14:36:18'),
(7, '/sprv/ctl/medhist.php', 365, 1, '2020-07-18 19:56:18'),
(8, 'RESIDENT', 365, 1, '2020-12-26 15:36:58'),
(9, 'FINANCE', 365, 1, '2020-12-26 15:48:02'),
(10, 'FACILITIES', 365, 1, '2020-12-26 15:48:02'),
(11, 'SALES', 365, 1, '2020-12-26 15:48:48'),
(13, 'HR', 365, 1, '2020-12-26 15:49:15'),
(14, 'PR', 365, 1, '2020-12-26 15:49:15'),
(15, 'BOARD', 365, 1, '2020-12-26 15:49:59'),
(16, 'ASSOCIATE', 365, 1, '2020-12-26 15:49:59'),
(17, 'SUPPLIER', 365, 1, '2020-12-26 15:50:33'),
(23, 'VISITOR', 0, 1, '2020-12-27 08:10:56'),
(25, 'LIBRARY', 365, 1, '2022-01-08 19:30:25'),
(26, 'HIBISCUS', 365, 1, '2022-07-10 13:11:21'),
(27, 'CALENDAR', 365, 1, '2022-10-17 07:03:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
