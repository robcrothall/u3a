-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2026 at 11:30 AM
-- Server version: 10.6.26-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afpxyykk_sprv`
--
CREATE DATABASE IF NOT EXISTS `afpxyykk_sprv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `afpxyykk_sprv`;

-- --------------------------------------------------------

--
-- Table structure for table `account_responsibility`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `account_responsibility`;
CREATE TABLE `account_responsibility` (
  `account_no` varchar(10) NOT NULL,
  `responsible_account` varchar(10) NOT NULL,
  `effective_date` date NOT NULL,
  `expires` date NOT NULL DEFAULT '2050-12-31',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(8) NOT NULL,
  `person_id` int(8) NOT NULL,
  `addr_type` int(8) NOT NULL,
  `addr_line` varchar(50) NOT NULL,
  `addr_line2` varchar(50) DEFAULT NULL,
  `place_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `address_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `address_type`;
CREATE TABLE `address_type` (
  `id` int(8) NOT NULL,
  `addr_type` varchar(20) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset` (
  `id` int(8) NOT NULL,
  `asset_name` varchar(20) NOT NULL,
  `asset_seq` int(8) DEFAULT 0,
  `asset_type` int(8) NOT NULL DEFAULT 1,
  `asset_type_char` varchar(20) DEFAULT NULL,
  `asset_no` int(8) DEFAULT NULL,
  `asset_suffix` varchar(10) DEFAULT NULL,
  `asset_size` decimal(8,3) DEFAULT NULL,
  `elec_id` varchar(20) DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_phone`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `asset_phone`;
CREATE TABLE `asset_phone` (
  `id` int(8) NOT NULL,
  `asset_id` int(8) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `descr` varchar(50) DEFAULT NULL,
  `account_no` varchar(10) DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Unattended phones in buildings';

-- --------------------------------------------------------

--
-- Table structure for table `asset_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `asset_type`;
CREATE TABLE `asset_type` (
  `id` int(8) NOT NULL,
  `asset_description` varchar(20) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `atg_load`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `atg_load`;
CREATE TABLE `atg_load` (
  `id` int(11) NOT NULL,
  `direction` varchar(5) DEFAULT NULL,
  `license` varchar(250) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `co` varchar(50) DEFAULT NULL,
  `cat` varchar(20) DEFAULT NULL,
  `lic2` varchar(50) DEFAULT NULL,
  `cre8` varchar(20) DEFAULT NULL,
  `cre8_date` varchar(10) DEFAULT NULL,
  `cre8_time` varchar(8) DEFAULT NULL,
  `scan_time` varchar(20) DEFAULT NULL,
  `connected` varchar(20) DEFAULT NULL,
  `trip_duration` varchar(10) DEFAULT NULL,
  `device` varchar(20) DEFAULT NULL,
  `profile` varchar(30) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `incidents` varchar(255) DEFAULT NULL,
  `drv_lic_in` varchar(50) DEFAULT NULL,
  `co_name_in` varchar(50) DEFAULT NULL,
  `passengers_in` varchar(50) DEFAULT NULL,
  `passengers_out` varchar(50) DEFAULT NULL,
  `name_out` varchar(50) DEFAULT NULL,
  `going` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `co2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name_in` varchar(50) DEFAULT NULL,
  `visiting` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `attendees`;
CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `intervention_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `atthegate`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `atthegate`;
CREATE TABLE `atthegate` (
  `direction` varchar(10) DEFAULT NULL,
  `license` varchar(150) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `dr_license` varchar(50) DEFAULT NULL,
  `creation` varchar(20) DEFAULT NULL,
  `recdate` varchar(10) DEFAULT NULL,
  `rectime` varchar(10) DEFAULT NULL,
  `profile` varchar(20) DEFAULT NULL,
  `incidents` varchar(150) DEFAULT NULL,
  `dr_name` varchar(50) DEFAULT NULL,
  `name_in` varchar(50) DEFAULT NULL,
  `name_out` varchar(50) DEFAULT NULL,
  `going` varchar(50) DEFAULT NULL,
  `company2` varchar(50) DEFAULT NULL,
  `visiting` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `atthegate2`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `atthegate2`;
CREATE TABLE `atthegate2` (
  `id` int(8) NOT NULL,
  `id_no` varchar(13) DEFAULT NULL,
  `lic_no` varchar(20) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `company_id` int(8) DEFAULT NULL,
  `visiting` varchar(20) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `profile` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `audit`;
CREATE TABLE `audit` (
  `id` int(8) NOT NULL,
  `program` varchar(50) NOT NULL,
  `field` varchar(50) NOT NULL,
  `old` varchar(255) NOT NULL,
  `new` varchar(255) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `audit_log`;
CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `program` varchar(50) NOT NULL,
  `field` varchar(50) NOT NULL,
  `old_value` varchar(255) NOT NULL,
  `new_value` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE `calendar` (
  `id` int(8) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `asset_id` int(8) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `resp_people_id` int(8) DEFAULT NULL,
  `contact_people_id` int(8) DEFAULT NULL,
  `private_event` enum('Y','N') NOT NULL DEFAULT 'N',
  `notes` text DEFAULT NULL,
  `schedule_id` int(8) NOT NULL DEFAULT 0,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Calendar for events in assets';

-- --------------------------------------------------------

--
-- Table structure for table `calendar_assets`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `calendar_assets`;
CREATE TABLE `calendar_assets` (
  `id` int(8) NOT NULL,
  `asset_name` varchar(50) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Assets for Calendar';

-- --------------------------------------------------------

--
-- Table structure for table `calendar_schedule`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `calendar_schedule`;
CREATE TABLE `calendar_schedule` (
  `id` int(8) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `dates` varchar(255) DEFAULT NULL,
  `dow` varchar(255) DEFAULT NULL,
  `wom` varchar(255) DEFAULT NULL,
  `moy` varchar(255) DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `asset_id` int(8) NOT NULL,
  `resp_people_id` int(8) NOT NULL,
  `contact_people_id` int(8) NOT NULL,
  `private_event` enum('Y','N') NOT NULL,
  `notes` text NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Schedule recurring events';

-- --------------------------------------------------------

--
-- Table structure for table `cash_receipts`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `cash_receipts`;
CREATE TABLE `cash_receipts` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `receipt_date` date NOT NULL DEFAULT current_timestamp(),
  `notes` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(8) NOT NULL,
  `cat_descr` varchar(50) NOT NULL,
  `cat_group` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cat_group`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `cat_group`;
CREATE TABLE `cat_group` (
  `id` int(8) NOT NULL,
  `group_descr` varchar(50) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `region_code` int(8) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colour`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `colour`;
CREATE TABLE `colour` (
  `id` int(11) NOT NULL,
  `colour` varchar(50) NOT NULL,
  `hex_value` varchar(10) DEFAULT NULL,
  `rgb_value` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_address`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `company_address`;
CREATE TABLE `company_address` (
  `id` int(8) NOT NULL,
  `company_id` int(8) NOT NULL,
  `address_id` int(8) NOT NULL,
  `address_type_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(8) NOT NULL,
  `country_code` varchar(3) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `dates`;
CREATE TABLE `dates` (
  `id` int(8) NOT NULL,
  `person_id` int(8) NOT NULL,
  `date_type` varchar(20) NOT NULL,
  `actual_date` date NOT NULL,
  `notes` varchar(60) DEFAULT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dept2`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `dept2`;
CREATE TABLE `dept2` (
  `id` int(8) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_manager_id` int(8) DEFAULT NULL,
  `job_email` varchar(250) DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dept_role`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `dept_role`;
CREATE TABLE `dept_role` (
  `user_id` int(8) NOT NULL,
  `dept_id` int(8) NOT NULL,
  `changed_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `discipline`;
CREATE TABLE `discipline` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changes` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `docs`;
CREATE TABLE `docs` (
  `id` int(8) NOT NULL,
  `doc_group` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `doc_subgroup` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doc_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `doc_file` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `submitted` date NOT NULL,
  `approved` date DEFAULT NULL,
  `review` date DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `electricity`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `electricity`;
CREATE TABLE `electricity` (
  `id` int(8) NOT NULL,
  `cottage` varchar(20) DEFAULT NULL,
  `meter` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `open_reading` int(8) DEFAULT NULL,
  `close_reading` int(8) DEFAULT NULL,
  `reading_date` date DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `user_id` int(8) DEFAULT 1,
  `changed` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elec_load`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `elec_load`;
CREATE TABLE `elec_load` (
  `cottage` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meter_start` int(8) DEFAULT NULL,
  `meter_end` int(8) DEFAULT NULL,
  `reading_date` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `email_type`;
CREATE TABLE `email_type` (
  `id` int(11) NOT NULL,
  `email_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp01`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `emp01`;
CREATE TABLE `emp01` (
  `id` int(8) NOT NULL,
  `emp_no` varchar(6) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `id_no` varchar(15) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `drivers_lic` varchar(20) DEFAULT NULL,
  `vehicle_reg` varchar(12) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(8) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  `fee_reqd` enum('Y','N') NOT NULL DEFAULT 'N',
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration_in_months` int(8) NOT NULL DEFAULT 12,
  `start_month` int(8) NOT NULL DEFAULT 3,
  `description` text NOT NULL,
  `welcome_email` text NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups_old`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `groups_old`;
CREATE TABLE `groups_old` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `event_date` date NOT NULL,
  `place_id` int(8) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `id_docs`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `id_docs`;
CREATE TABLE `id_docs` (
  `people_id` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `id_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `id_type`;
CREATE TABLE `id_type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interventions`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `interventions`;
CREATE TABLE `interventions` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `int_type` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL DEFAULT '08:00:00',
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `description` varchar(250) NOT NULL,
  `unit_cost` decimal(11,2) NOT NULL DEFAULT 0.00,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_category`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `int_category`;
CREATE TABLE `int_category` (
  `id` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `int_type`;
CREATE TABLE `int_type` (
  `id` int(11) NOT NULL,
  `description` varchar(120) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(8) NOT NULL,
  `originator_id` int(8) NOT NULL,
  `dept_id` int(8) NOT NULL,
  `severity` varchar(20) NOT NULL DEFAULT '"02 - Low"' COMMENT 'Low, Normal, Urgent, Critical',
  `subject` varchar(120) NOT NULL,
  `description` varchar(750) NOT NULL,
  `criteria` varchar(750) DEFAULT NULL,
  `asset_id` int(8) NOT NULL,
  `discipline` varchar(20) NOT NULL DEFAULT '"Not specified"' COMMENT 'Not specified,Carpenter,Electrical,Painter,Plumber,External',
  `type` varchar(25) NOT NULL DEFAULT '"Material Failure"' COMMENT 'Planned Maintenance,Material Failure,Change request,Enhancement',
  `create_id` int(8) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL DEFAULT '0000-00-00',
  `read_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `assigned_to` int(8) NOT NULL DEFAULT 0,
  `date_assigned` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estimated_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `sched_date` date NOT NULL DEFAULT '0000-00-00',
  `sched_time` time NOT NULL DEFAULT '00:00:00',
  `actual_date` date NOT NULL DEFAULT '0000-00-00',
  `actual_time` time NOT NULL DEFAULT '00:00:00',
  `date_closed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `actual_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `project_id` int(8) NOT NULL DEFAULT 0,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_hist`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `jobs_hist`;
CREATE TABLE `jobs_hist` (
  `id` int(8) NOT NULL,
  `field` varchar(30) NOT NULL,
  `value` varchar(750) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `jobs_history`;
CREATE TABLE `jobs_history` (
  `id` int(8) NOT NULL,
  `originator_id` int(8) NOT NULL,
  `dept_id` int(8) NOT NULL,
  `severity` varchar(20) NOT NULL COMMENT 'Low, Normal, Urgent, Critical',
  `subject` varchar(80) NOT NULL,
  `description` varchar(750) NOT NULL,
  `asset_id` int(8) NOT NULL,
  `discipline` varchar(20) NOT NULL COMMENT 'Not specified,Carpenter,Electrical,Painter,Plumber,External',
  `type` varchar(25) NOT NULL COMMENT 'Planned Maintenance,Material Failure,Change request,Enhancement',
  `create_id` int(8) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `read_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `assigned_to` int(8) NOT NULL DEFAULT 0,
  `date_assigned` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estimated_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `sched_date` date NOT NULL DEFAULT '0000-00-00',
  `sched_time` time NOT NULL DEFAULT '00:00:00',
  `actual_date` date NOT NULL DEFAULT '0000-00-00',
  `actual_time` time NOT NULL DEFAULT '00:00:00',
  `date_closed` date NOT NULL DEFAULT '0000-00-00',
  `actual_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `project_id` int(8) NOT NULL DEFAULT 0,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logon_log`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `logon_log`;
CREATE TABLE `logon_log` (
  `id` int(8) NOT NULL,
  `user_name_given` varchar(255) DEFAULT NULL,
  `password_given` varchar(50) DEFAULT NULL,
  `success` tinyint(1) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_category`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `med_category`;
CREATE TABLE `med_category` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `med_history`;
CREATE TABLE `med_history` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `proc_date` date NOT NULL,
  `med_proc_id` int(8) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `value` varchar(20) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_procedures`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `med_procedures`;
CREATE TABLE `med_procedures` (
  `id` int(8) NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `category` int(8) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_sched`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `med_sched`;
CREATE TABLE `med_sched` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `med_proc_id` int(11) NOT NULL,
  `sched_date` date NOT NULL,
  `sched_time` time NOT NULL,
  `actual_date` date DEFAULT NULL,
  `actual_time` time DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `memberships`;
CREATE TABLE `memberships` (
  `id` int(8) NOT NULL,
  `person_id` int(8) NOT NULL,
  `group_id` int(8) NOT NULL,
  `is_manager` enum('Y','N') NOT NULL DEFAULT 'N',
  `join_date` date NOT NULL DEFAULT '1900-01-01',
  `expiry_date` date NOT NULL DEFAULT '1900-01-01',
  `status` enum('Validated','Terminated','Excluded') NOT NULL DEFAULT 'Validated',
  `status_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Membership of Groups';

-- --------------------------------------------------------

--
-- Table structure for table `news`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(8) NOT NULL,
  `title` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `effective_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `contact_id` int(8) NOT NULL DEFAULT 0,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_users`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `news_users`;
CREATE TABLE `news_users` (
  `news_id` int(8) NOT NULL,
  `users_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `occupation`;
CREATE TABLE `occupation` (
  `id` int(8) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parms_char`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `parms_char`;
CREATE TABLE `parms_char` (
  `id` int(8) NOT NULL,
  `parm_name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_local_id` int(8) DEFAULT NULL,
  `parm_value` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `parm_num` decimal(10,2) NOT NULL DEFAULT 0.00,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(8) NOT NULL,
  `person_id` int(8) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_date` date NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peoplex`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `peoplex`;
CREATE TABLE `peoplex` (
  `id` int(8) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `given_name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `marital_status` varchar(1) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `status_date` date DEFAULT NULL,
  `id_no` varchar(15) DEFAULT NULL,
  `account_no` varchar(10) DEFAULT NULL,
  `acc_pref` int(2) NOT NULL DEFAULT 0,
  `old_account_no` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `bd_disclose` enum('Y','N','?') DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `hp_disclose` enum('Y','N','?') NOT NULL DEFAULT 'Y',
  `work_phone` varchar(20) DEFAULT NULL,
  `wp_disclose` enum('Y','N','?') NOT NULL DEFAULT 'Y',
  `mobile_phone` varchar(20) DEFAULT NULL,
  `mp_disclose` enum('Y','N','?') DEFAULT NULL,
  `whatsapp` varchar(1) DEFAULT NULL,
  `work_email` varchar(50) DEFAULT NULL,
  `home_email` varchar(50) DEFAULT NULL,
  `he_disclose` enum('Y','N','?') DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `passport_expiry` date DEFAULT NULL,
  `driver_lic` varchar(20) DEFAULT NULL,
  `driver_expiry` date DEFAULT NULL,
  `company_id` int(8) DEFAULT 0,
  `occupation_id` int(8) DEFAULT 0,
  `race` varchar(20) DEFAULT NULL,
  `rs_rep` int(8) DEFAULT 0,
  `cottage` varchar(10) DEFAULT NULL,
  `cottage_id` int(8) NOT NULL DEFAULT 0,
  `an_disclose` enum('Y','N','?') NOT NULL DEFAULT '?' COMMENT 'Disclose Aniversary',
  `checked` varchar(6) DEFAULT 'N',
  `notes` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_asset`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_asset`;
CREATE TABLE `people_asset` (
  `id` int(8) NOT NULL,
  `asset_id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_bak`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_bak`;
CREATE TABLE `people_bak` (
  `id` int(8) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `given_name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `marital_status` varchar(1) DEFAULT NULL,
  `id_no` varchar(15) DEFAULT NULL,
  `account_no` varchar(10) DEFAULT NULL,
  `old_account_no` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `work_phone` varchar(20) DEFAULT NULL,
  `mobile_phone` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(1) DEFAULT NULL,
  `work_email` varchar(50) DEFAULT NULL,
  `home_email` varchar(50) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `passport_expiry` date DEFAULT NULL,
  `driver_lic` varchar(20) DEFAULT NULL,
  `driver_expiry` date DEFAULT NULL,
  `company_id` int(8) NOT NULL DEFAULT 0,
  `occupation_id` int(8) NOT NULL DEFAULT 0,
  `rs_rep` int(8) NOT NULL DEFAULT 0,
  `cottage` varchar(10) DEFAULT NULL,
  `checked` varchar(6) DEFAULT 'N',
  `notes` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_category`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_category`;
CREATE TABLE `people_category` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_company`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_company`;
CREATE TABLE `people_company` (
  `people_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `joined` date DEFAULT NULL,
  `exited` date DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_discipline`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_discipline`;
CREATE TABLE `people_discipline` (
  `people_id` int(8) NOT NULL,
  `discipline_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_email`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_email`;
CREATE TABLE `people_email` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `email_type` int(11) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_groups`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_groups`;
CREATE TABLE `people_groups` (
  `people_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `expires` date NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_interventions`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_interventions`;
CREATE TABLE `people_interventions` (
  `people_id` int(11) NOT NULL,
  `int_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_jobs`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_jobs`;
CREATE TABLE `people_jobs` (
  `job_id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `planned hours` decimal(7,2) NOT NULL DEFAULT 0.00,
  `actual_hours` decimal(7,2) NOT NULL DEFAULT 0.00,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_log`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_log`;
CREATE TABLE `people_log` (
  `id` int(8) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `given_name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `marital_status` varchar(1) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `status_date` date DEFAULT NULL,
  `id_no` varchar(15) DEFAULT NULL,
  `account_no` varchar(10) DEFAULT NULL,
  `acc_pref` int(2) NOT NULL DEFAULT 0,
  `old_account_no` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `bd_disclose` enum('Y','N','?') DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `hp_disclose` enum('Y','N','?') NOT NULL DEFAULT 'Y',
  `work_phone` varchar(20) DEFAULT NULL,
  `wp_disclose` enum('Y','N','?') NOT NULL DEFAULT 'Y',
  `mobile_phone` varchar(20) DEFAULT NULL,
  `mp_disclose` enum('Y','N','?') DEFAULT NULL,
  `whatsapp` varchar(1) DEFAULT NULL,
  `work_email` varchar(50) DEFAULT NULL,
  `home_email` varchar(50) DEFAULT NULL,
  `he_disclose` enum('Y','N','?') DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `passport_expiry` date DEFAULT NULL,
  `driver_lic` varchar(20) DEFAULT NULL,
  `driver_expiry` date DEFAULT NULL,
  `company_id` int(8) DEFAULT 0,
  `occupation_id` int(8) DEFAULT 0,
  `race` varchar(20) DEFAULT NULL,
  `rs_rep` int(8) DEFAULT 0,
  `cottage` varchar(10) DEFAULT NULL,
  `cottage_id` int(8) NOT NULL DEFAULT 0,
  `an_disclose` enum('Y','N','?') NOT NULL DEFAULT '?',
  `checked` varchar(6) DEFAULT 'N',
  `notes` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_news`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_news`;
CREATE TABLE `people_news` (
  `person_id` int(8) NOT NULL,
  `news_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_occupation`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_occupation`;
CREATE TABLE `people_occupation` (
  `people_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_phone`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_phone`;
CREATE TABLE `people_phone` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `phone_type` int(11) NOT NULL,
  `country_code` varchar(10) NOT NULL DEFAULT '+27',
  `phone_no` varchar(20) NOT NULL,
  `disclose` enum('Y','N','?') NOT NULL DEFAULT '?',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_related`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_related`;
CREATE TABLE `people_related` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `related_id` int(8) NOT NULL,
  `relationship` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Spouse',
  `relationship_date` date NOT NULL DEFAULT '1900-01-01',
  `notes` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_role`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_role`;
CREATE TABLE `people_role` (
  `people_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `expires` date NOT NULL DEFAULT '2050-12-31',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_roles`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_roles`;
CREATE TABLE `people_roles` (
  `people_id` int(8) NOT NULL,
  `role_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_rs`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_rs`;
CREATE TABLE `people_rs` (
  `people_id` int(8) NOT NULL,
  `rs_id` int(11) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_skills`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_skills`;
CREATE TABLE `people_skills` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `skill_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_trip`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_trip`;
CREATE TABLE `people_trip` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `direction` varchar(5) NOT NULL,
  `cre8_date` date NOT NULL,
  `cre8_time` time NOT NULL,
  `scan_time` time NOT NULL,
  `trip_duration` time DEFAULT NULL,
  `profile` varchar(30) DEFAULT NULL,
  `visiting` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_trips`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_trips`;
CREATE TABLE `people_trips` (
  `people_id` int(8) NOT NULL,
  `trips` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_vehicle`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_vehicle`;
CREATE TABLE `people_vehicle` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `vehicle_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `pets`;
CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_yob` date NOT NULL,
  `pet_description` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `phone_history`;
CREATE TABLE `phone_history` (
  `id` int(11) NOT NULL,
  `ext` varchar(16) NOT NULL,
  `dialed` varchar(15) NOT NULL,
  `area` varchar(15) DEFAULT NULL,
  `call_date` date NOT NULL,
  `call_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `cost` decimal(7,2) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `phone_type`;
CREATE TABLE `phone_type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` int(8) NOT NULL,
  `place` varchar(50) NOT NULL,
  `postal_code` varchar(12) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `region_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(8) NOT NULL,
  `proj_name` varchar(80) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(8) NOT NULL,
  `region` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `country_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `relationships`;
CREATE TABLE `relationships` (
  `id` int(8) NOT NULL,
  `person_id` int(8) NOT NULL,
  `other_id` int(8) NOT NULL,
  `type` varchar(20) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res01`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `res01`;
CREATE TABLE `res01` (
  `id` int(8) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `given_name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `account_id` varchar(8) DEFAULT NULL,
  `id_no` varchar(15) DEFAULT NULL,
  `physical_address` varchar(50) DEFAULT NULL,
  `postal_address` varchar(50) DEFAULT NULL,
  `home_phone` varchar(20) DEFAULT NULL,
  `work_phone` varchar(20) DEFAULT NULL,
  `mobile_phone` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(1) DEFAULT NULL,
  `work_email` varchar(50) DEFAULT NULL,
  `home_email` varchar(50) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `passport_expiry` date DEFAULT NULL,
  `driver_lic` varchar(20) DEFAULT NULL,
  `driver_expiry` date DEFAULT NULL,
  `company_id` int(8) DEFAULT NULL,
  `occupation_id` int(8) DEFAULT NULL,
  `rs_rep_name` varchar(50) DEFAULT NULL,
  `rs_rep` int(8) DEFAULT NULL,
  `cottage` varchar(10) DEFAULT NULL,
  `people_id` int(8) DEFAULT NULL,
  `checked` varchar(6) DEFAULT 'N',
  `notes` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res02`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `res02`;
CREATE TABLE `res02` (
  `id` int(8) NOT NULL,
  `cottage` varchar(8) DEFAULT NULL,
  `suffix` varchar(5) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `id_no` varchar(15) DEFAULT NULL,
  `marital_status` varchar(2) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(8) NOT NULL,
  `role_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `role_days` smallint(6) NOT NULL DEFAULT 0,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rs_members`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `rs_members`;
CREATE TABLE `rs_members` (
  `rs_id` int(8) NOT NULL,
  `role_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rs_reps`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `rs_reps`;
CREATE TABLE `rs_reps` (
  `resident` int(8) NOT NULL,
  `rs_rep` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `severity`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `severity`;
CREATE TABLE `severity` (
  `id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL,
  `hours` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` int(8) NOT NULL,
  `skill_name` varchar(50) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sql_log`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `sql_log`;
CREATE TABLE `sql_log` (
  `id` int(8) NOT NULL,
  `cmd` varchar(255) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  `user_id` int(8) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `originator_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `severity` int(11) NOT NULL,
  `subject` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `criteria` text DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `discipline` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL DEFAULT '0000-00-00',
  `read_date` timestamp NULL DEFAULT NULL,
  `print_date` int(11) DEFAULT NULL,
  `est_hours` decimal(7,2) DEFAULT NULL,
  `sched_date` date DEFAULT NULL,
  `sched_time` time DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `actual_time` time DEFAULT NULL,
  `closed` timestamp NULL DEFAULT NULL,
  `actual_hours` decimal(7,2) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_assigned`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `task_assigned`;
CREATE TABLE `task_assigned` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `sched_date` date DEFAULT NULL,
  `sched_time` time DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `actual_time` time DEFAULT NULL,
  `est_hours` decimal(7,2) DEFAULT NULL,
  `actual_hours` decimal(7,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `task_history`;
CREATE TABLE `task_history` (
  `id` int(11) NOT NULL,
  `originator_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `severity` int(11) NOT NULL,
  `subject` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `criteria` text DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `discipline` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL DEFAULT '0000-00-00',
  `read_date` timestamp NULL DEFAULT NULL,
  `print_date` int(11) DEFAULT NULL,
  `est_hours` decimal(7,2) DEFAULT NULL,
  `sched_date` date DEFAULT NULL,
  `sched_time` time DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `actual_time` time DEFAULT NULL,
  `closed` timestamp NULL DEFAULT NULL,
  `actual_hours` decimal(7,2) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `task_type`;
CREATE TABLE `task_type` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(8) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `person_id` int(8) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `member_exp` date NOT NULL,
  `last_logon` date NOT NULL,
  `user_role` varchar(20) NOT NULL DEFAULT 'VISITOR',
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `user_id` int(8) NOT NULL,
  `role_id` int(8) NOT NULL,
  `role_expiry` date DEFAULT NULL,
  `changed_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `valid_accounts`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `valid_accounts`;
CREATE TABLE `valid_accounts` (
  `acc` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `f3` varchar(20) DEFAULT NULL,
  `f4` varchar(20) DEFAULT NULL,
  `f5` varchar(20) DEFAULT NULL,
  `f6` varchar(20) DEFAULT NULL,
  `f7` varchar(20) DEFAULT NULL,
  `f8` varchar(20) DEFAULT NULL,
  `f9` varchar(20) DEFAULT NULL,
  `f10` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `veh01`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `veh01`;
CREATE TABLE `veh01` (
  `surname` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `regno` varchar(20) DEFAULT NULL,
  `cottage` varchar(30) DEFAULT NULL,
  `people_id` int(8) DEFAULT NULL,
  `people_cottage` varchar(10) DEFAULT NULL,
  `vehicle_id` int(8) DEFAULT NULL,
  `id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `veh01_bak`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `veh01_bak`;
CREATE TABLE `veh01_bak` (
  `surname` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `cottage_no` varchar(20) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `regno` varchar(20) DEFAULT NULL,
  `cottage` varchar(30) DEFAULT NULL,
  `people_id` int(8) DEFAULT NULL,
  `people_cottage` varchar(10) DEFAULT NULL,
  `vehicle_id` int(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE `vehicle` (
  `id` int(8) NOT NULL,
  `reg_no` varchar(12) NOT NULL,
  `model` int(8) DEFAULT NULL,
  `colour` int(8) DEFAULT NULL,
  `license` varchar(20) DEFAULT NULL,
  `license_exp` date DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `make` int(11) DEFAULT NULL,
  `model` int(11) DEFAULT NULL,
  `colour` int(11) DEFAULT NULL,
  `license_no` varchar(20) DEFAULT NULL,
  `license_expiry` date DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_make`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `vehicle_make`;
CREATE TABLE `vehicle_make` (
  `id` int(8) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model`
--
-- Creation: Aug 20, 2024 at 02:07 PM
-- Last update: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `vehicle_model`;
CREATE TABLE `vehicle_model` (
  `id` int(8) NOT NULL,
  `model_name` varchar(20) NOT NULL,
  `make` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atg_load`
--
ALTER TABLE `atg_load`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atthegate2`
--
ALTER TABLE `atthegate2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dis_user_id` (`user_id`);

--
-- Indexes for table `email_type`
--
ALTER TABLE `email_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `et_user_id` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_old`
--
ALTER TABLE `groups_old`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gp_user_id` (`user_id`);

--
-- Indexes for table `id_docs`
--
ALTER TABLE `id_docs`
  ADD PRIMARY KEY (`people_id`,`id_type`),
  ADD KEY `id_doc_type` (`id_type`);

--
-- Indexes for table `id_type`
--
ALTER TABLE `id_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `in_dept_id` (`dept_id`),
  ADD KEY `in_cat_id` (`category_id`),
  ADD KEY `in_int_type` (`int_type`),
  ADD KEY `in_leader_id` (`leader_id`),
  ADD KEY `in_user_id` (`user_id`);

--
-- Indexes for table `int_category`
--
ALTER TABLE `int_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_type`
--
ALTER TABLE `int_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `med_category`
--
ALTER TABLE `med_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `med_sched`
--
ALTER TABLE `med_sched`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ms_people_id` (`people_id`),
  ADD KEY `ms_proc_id` (`med_proc_id`),
  ADD KEY `ms_user_id` (`user_id`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peoplex`
--
ALTER TABLE `peoplex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people_category`
--
ALTER TABLE `people_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pcat_user_id` (`user_id`);

--
-- Indexes for table `people_company`
--
ALTER TABLE `people_company`
  ADD PRIMARY KEY (`people_id`,`company_id`),
  ADD KEY `pc_co_id` (`company_id`);

--
-- Indexes for table `people_email`
--
ALTER TABLE `people_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pe_people_id` (`people_id`),
  ADD KEY `pe_email_type` (`email_type`),
  ADD KEY `pe_user_id` (`user_id`);

--
-- Indexes for table `people_groups`
--
ALTER TABLE `people_groups`
  ADD PRIMARY KEY (`people_id`,`group_id`),
  ADD KEY `pg_user_id` (`user_id`),
  ADD KEY `pg_group_id` (`group_id`);

--
-- Indexes for table `people_interventions`
--
ALTER TABLE `people_interventions`
  ADD PRIMARY KEY (`people_id`,`int_id`);

--
-- Indexes for table `people_occupation`
--
ALTER TABLE `people_occupation`
  ADD PRIMARY KEY (`people_id`,`occupation_id`),
  ADD KEY `po_occ_id` (`occupation_id`),
  ADD KEY `po_user_id` (`user_id`);

--
-- Indexes for table `people_phone`
--
ALTER TABLE `people_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_constraint` (`people_id`),
  ADD KEY `phone_type` (`phone_type`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `people_role`
--
ALTER TABLE `people_role`
  ADD KEY `people_role_constraint` (`people_id`),
  ADD KEY `role_constraint` (`role_id`);

--
-- Indexes for table `people_trip`
--
ALTER TABLE `people_trip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pt_people_id` (`people_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_history`
--
ALTER TABLE `phone_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_type`
--
ALTER TABLE `phone_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `severity`
--
ALTER TABLE `severity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sev_user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_assigned`
--
ALTER TABLE `task_assigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_history`
--
ALTER TABLE `task_history`
  ADD PRIMARY KEY (`id`,`changed`);

--
-- Indexes for table `task_type`
--
ALTER TABLE `task_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tt_user_id` (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_reg_no` (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atg_load`
--
ALTER TABLE `atg_load`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_type`
--
ALTER TABLE `email_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups_old`
--
ALTER TABLE `groups_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_type`
--
ALTER TABLE `id_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_category`
--
ALTER TABLE `int_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_type`
--
ALTER TABLE `int_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `med_category`
--
ALTER TABLE `med_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `med_sched`
--
ALTER TABLE `med_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_category`
--
ALTER TABLE `people_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_email`
--
ALTER TABLE `people_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_phone`
--
ALTER TABLE `people_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_trip`
--
ALTER TABLE `people_trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_history`
--
ALTER TABLE `phone_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_type`
--
ALTER TABLE `phone_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `severity`
--
ALTER TABLE `severity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_assigned`
--
ALTER TABLE `task_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_type`
--
ALTER TABLE `task_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discipline`
--
ALTER TABLE `discipline`
  ADD CONSTRAINT `dis_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `email_type`
--
ALTER TABLE `email_type`
  ADD CONSTRAINT `et_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `groups_old`
--
ALTER TABLE `groups_old`
  ADD CONSTRAINT `gp_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `id_docs`
--
ALTER TABLE `id_docs`
  ADD CONSTRAINT `id_doc_person` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `id_doc_type` FOREIGN KEY (`id_type`) REFERENCES `id_type` (`id`);

--
-- Constraints for table `interventions`
--
ALTER TABLE `interventions`
  ADD CONSTRAINT `in_cat_id` FOREIGN KEY (`category_id`) REFERENCES `int_category` (`id`),
  ADD CONSTRAINT `in_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `dept` (`id`),
  ADD CONSTRAINT `in_int_type` FOREIGN KEY (`int_type`) REFERENCES `int_type` (`id`),
  ADD CONSTRAINT `in_leader_id` FOREIGN KEY (`leader_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `in_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `med_sched`
--
ALTER TABLE `med_sched`
  ADD CONSTRAINT `ms_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `ms_proc_id` FOREIGN KEY (`med_proc_id`) REFERENCES `med_procedures` (`id`),
  ADD CONSTRAINT `ms_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_category`
--
ALTER TABLE `people_category`
  ADD CONSTRAINT `pcat_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_company`
--
ALTER TABLE `people_company`
  ADD CONSTRAINT `pc_co_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `pc_people_co` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_email`
--
ALTER TABLE `people_email`
  ADD CONSTRAINT `pe_email_type` FOREIGN KEY (`email_type`) REFERENCES `email_type` (`id`),
  ADD CONSTRAINT `pe_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `pe_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_groups`
--
ALTER TABLE `people_groups`
  ADD CONSTRAINT `pg_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `pg_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `pg_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_occupation`
--
ALTER TABLE `people_occupation`
  ADD CONSTRAINT `po_occ_id` FOREIGN KEY (`occupation_id`) REFERENCES `occupation` (`id`),
  ADD CONSTRAINT `po_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `po_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_phone`
--
ALTER TABLE `people_phone`
  ADD CONSTRAINT `people_constraint` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `phone_type` FOREIGN KEY (`phone_type`) REFERENCES `phone_type` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_role`
--
ALTER TABLE `people_role`
  ADD CONSTRAINT `people_role_constraint` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `role_constraint` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `people_trip`
--
ALTER TABLE `people_trip`
  ADD CONSTRAINT `pt_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `severity`
--
ALTER TABLE `severity`
  ADD CONSTRAINT `sev_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `task_type`
--
ALTER TABLE `task_type`
  ADD CONSTRAINT `tt_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
