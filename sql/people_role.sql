-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2026 at 03:27 AM
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
-- Table structure for table `people_role`
--

CREATE TABLE `people_role` (
  `people_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `expires` date NOT NULL DEFAULT '2050-12-31',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people_role`
--
ALTER TABLE `people_role`
  ADD KEY `people_role_constraint` (`people_id`),
  ADD KEY `role_constraint` (`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `people_role`
--
ALTER TABLE `people_role`
  ADD CONSTRAINT `people_role_constraint` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `role_constraint` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
