-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2026 at 11:32 AM
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
-- Database: `afpxyykk_sprv_v1`
--
CREATE DATABASE IF NOT EXISTS `afpxyykk_sprv_v1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `afpxyykk_sprv_v1`;

-- --------------------------------------------------------

--
-- Table structure for table `account_responsibility`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `account_responsibility`;
CREATE TABLE `account_responsibility` (
  `account_no` varchar(10) NOT NULL,
  `responsible_acct` varchar(10) NOT NULL,
  `effective_date` date NOT NULL,
  `expires` date NOT NULL DEFAULT '2050-12-31',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `address_line` varchar(100) NOT NULL COMMENT 'Encrypted',
  `address_line2` varchar(50) DEFAULT NULL,
  `suburb` varchar(50) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `province_id` int(8) DEFAULT NULL,
  `country_code` varchar(3) NOT NULL DEFAULT 'ZA',
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `address_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `address_type`;
CREATE TABLE `address_type` (
  `id` int(11) NOT NULL,
  `addr_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `asset_name` varchar(50) NOT NULL,
  `asset_seq` int(8) NOT NULL DEFAULT 0,
  `asset_type` int(11) NOT NULL,
  `asset_size` decimal(8,1) NOT NULL DEFAULT 0.0,
  `elec_id` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_phone`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `asset_phone`;
CREATE TABLE `asset_phone` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `descr` varchar(50) DEFAULT NULL,
  `account_no` varchar(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `asset_type`;
CREATE TABLE `asset_type` (
  `id` int(11) NOT NULL,
  `asset_description` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `going` varchar(50) DEFAULT NULL,
  `co2` varchar(50) DEFAULT NULL,
  `name_in` varchar(50) DEFAULT NULL,
  `visiting` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `intervention_id` int(8) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Calendar for events in assets';

-- --------------------------------------------------------

--
-- Table structure for table `calendar_assets`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `calendar_assets`;
CREATE TABLE `calendar_assets` (
  `id` int(8) NOT NULL,
  `asset_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_schedule`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `calendar_schedule`;
CREATE TABLE `calendar_schedule` (
  `id` int(8) NOT NULL,
  `event_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dates` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dow` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `wom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `moy` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `asset_id` int(8) NOT NULL,
  `resp_people_id` int(8) NOT NULL,
  `contact_people_id` int(8) NOT NULL,
  `private_event` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `co_name` varchar(50) NOT NULL,
  `co_phone` varchar(20) DEFAULT NULL,
  `co_email` varchar(256) DEFAULT NULL,
  `co_vat_no` varchar(20) DEFAULT NULL,
  `co_notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(3) NOT NULL,
  `country` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `dept`;
CREATE TABLE `dept` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `hod` int(11) NOT NULL,
  `task_email` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `changed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `docs`;
CREATE TABLE `docs` (
  `id` int(11) NOT NULL,
  `doc_group` varchar(50) NOT NULL,
  `doc_subgroup` varchar(50) DEFAULT NULL,
  `doc_name` varchar(50) NOT NULL,
  `doc_version` varchar(20) DEFAULT NULL,
  `doc_author` varchar(50) DEFAULT NULL,
  `doc_file` varchar(250) NOT NULL,
  `submitted` date DEFAULT NULL,
  `approved` date DEFAULT NULL,
  `review` date DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `electricity`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `electricity`;
CREATE TABLE `electricity` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `meter` varchar(20) NOT NULL,
  `open_reading` decimal(11,2) DEFAULT NULL,
  `close_reading` decimal(11,2) DEFAULT NULL,
  `reading_date` date NOT NULL,
  `cost` decimal(11,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_addresses`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `email_addresses`;
CREATE TABLE `email_addresses` (
  `user_id` int(8) NOT NULL,
  `id` int(8) NOT NULL,
  `people_id` int(11) NOT NULL,
  `text_type` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `clear_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `function_log`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `function_log`;
CREATE TABLE `function_log` (
  `id` int(8) NOT NULL,
  `function` varchar(50) DEFAULT NULL,
  `user_id` int(8) DEFAULT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Keep track of which functions are used';

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
  `welcome_email` text DEFAULT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `notes` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `int_category_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` varchar(3) NOT NULL DEFAULT 'en',
  `name` varchar(20) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logon_log`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `logon_log`;
CREATE TABLE `logon_log` (
  `id` int(11) NOT NULL,
  `user_name_given` varchar(255) DEFAULT NULL COMMENT 'Encrypted',
  `password_given` varchar(255) DEFAULT NULL COMMENT 'Encrypted',
  `success` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `med_history`;
CREATE TABLE `med_history` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `proc_date` date NOT NULL,
  `proc_time` time DEFAULT NULL,
  `proc_id` int(11) NOT NULL,
  `charge` decimal(7,2) NOT NULL DEFAULT 0.00,
  `metric` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_procedures`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `med_procedures`;
CREATE TABLE `med_procedures` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `memberships`;
CREATE TABLE `memberships` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
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
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `effective_date` date NOT NULL DEFAULT current_timestamp(),
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
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
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
-- Table structure for table `page_text`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `page_text`;
CREATE TABLE `page_text` (
  `module_id` varchar(50) NOT NULL,
  `text_id` varchar(20) NOT NULL,
  `lang_id` varchar(3) NOT NULL DEFAULT 'en',
  `text` varchar(500) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_submitted` timestamp NULL DEFAULT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `given_name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `title_id` int(8) NOT NULL DEFAULT 0,
  `account_no` varchar(10) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `race_id` int(8) NOT NULL DEFAULT 1,
  `checked` enum('Y','N','Query') NOT NULL DEFAULT 'N',
  `user_id` int(11) DEFAULT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='All people';

-- --------------------------------------------------------

--
-- Table structure for table `people_address`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_address`;
CREATE TABLE `people_address` (
  `people_id` int(8) NOT NULL,
  `address_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_asset`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_asset`;
CREATE TABLE `people_asset` (
  `people_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `billable` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_email`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_email`;
CREATE TABLE `people_email` (
  `id` int(8) NOT NULL,
  `people_id` int(8) NOT NULL,
  `text_id` int(8) NOT NULL,
  `text_type_id` int(8) NOT NULL,
  `disclose` enum('Y','N') NOT NULL DEFAULT 'N',
  `email` varchar(120) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `notes` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
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
  `id` int(11) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `given_name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `account_no` varchar(10) NOT NULL,
  `bd_disclose` enum('Y','N','?') NOT NULL DEFAULT 'Y',
  `sex` char(1) DEFAULT NULL,
  `race` varchar(20) DEFAULT NULL,
  `checked` enum('Y','N','Query') NOT NULL DEFAULT 'N',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='All people';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_phone`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_phone`;
CREATE TABLE `people_phone` (
  `id` int(8) NOT NULL,
  `ext` varchar(15) NOT NULL,
  `people_id` int(8) NOT NULL,
  `billable` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_related`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_related`;
CREATE TABLE `people_related` (
  `id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  `relationship` int(11) NOT NULL,
  `effective_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_text`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_text`;
CREATE TABLE `people_text` (
  `people_id` int(8) NOT NULL,
  `text_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people_vehicle`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `people_vehicle`;
CREATE TABLE `people_vehicle` (
  `people_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `acquired_date` date DEFAULT NULL,
  `disposed_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `pet_terminated` date DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `proj_name` varchar(80) NOT NULL,
  `proj_manager` int(8) DEFAULT 1081,
  `proj_start` date NOT NULL DEFAULT current_timestamp(),
  `proj_end` date DEFAULT NULL,
  `proj_status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `race`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `race`;
CREATE TABLE `race` (
  `id` int(8) NOT NULL,
  `race_name` varchar(20) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `id` int(8) NOT NULL,
  `region_name` varchar(50) NOT NULL,
  `country_code` varchar(3) NOT NULL DEFAULT 'ZA',
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `relationships`;
CREATE TABLE `relationships` (
  `id` int(11) NOT NULL,
  `primary_desc` varchar(50) NOT NULL,
  `secondary_desc` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_days` smallint(6) NOT NULL DEFAULT 365,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensitive_text`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `sensitive_text`;
CREATE TABLE `sensitive_text` (
  `id` int(8) NOT NULL,
  `people_id` int(11) NOT NULL,
  `text_type` int(11) NOT NULL,
  `encrypted_text` text NOT NULL COMMENT 'Encrypted',
  `disclose` varchar(1) NOT NULL DEFAULT '?',
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `sensitive_text_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `sensitive_text_type`;
CREATE TABLE `sensitive_text_type` (
  `id` int(8) NOT NULL,
  `text_description` varchar(50) NOT NULL,
  `data_type` varchar(20) NOT NULL DEFAULT 'text',
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `severity`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `severity`;
CREATE TABLE `severity` (
  `id` int(11) NOT NULL,
  `sev_description` varchar(30) NOT NULL,
  `hours` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `severity` int(11) DEFAULT NULL,
  `subject` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `criteria` text DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `discipline` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `create_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `read_date` timestamp NULL DEFAULT NULL,
  `print_date` timestamp NULL DEFAULT NULL,
  `est_hours` decimal(7,2) DEFAULT NULL,
  `sched_date` date DEFAULT NULL,
  `sched_time` time DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `actual_time` time DEFAULT NULL,
  `closed` timestamp NULL DEFAULT NULL,
  `actual_hours` decimal(7,2) NOT NULL DEFAULT 0.00,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks_assigned`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `tasks_assigned`;
CREATE TABLE `tasks_assigned` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `sched_date` date DEFAULT NULL,
  `sched_time` time DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `actual_time` time DEFAULT NULL,
  `est_hours` decimal(7,2) DEFAULT NULL,
  `actual_hours` decimal(7,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks_history`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `tasks_history`;
CREATE TABLE `tasks_history` (
  `id` int(11) NOT NULL,
  `originator_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `severity` int(11) DEFAULT NULL,
  `subject` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `criteria` text DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `discipline` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `create_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `read_date` timestamp NULL DEFAULT NULL,
  `print_date` int(11) DEFAULT NULL,
  `est_hours` decimal(7,2) DEFAULT NULL,
  `sched_date` date DEFAULT NULL,
  `sched_time` time DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `actual_time` time DEFAULT NULL,
  `closed` timestamp NULL DEFAULT NULL,
  `actual_hours` decimal(7,2) NOT NULL DEFAULT 0.00,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_severity`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `task_severity`;
CREATE TABLE `task_severity` (
  `id` int(8) NOT NULL,
  `severity` varchar(20) NOT NULL,
  `hours` int(11) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_type`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `task_type`;
CREATE TABLE `task_type` (
  `id` int(11) NOT NULL,
  `dept` int(8) NOT NULL DEFAULT 6,
  `description` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `title`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `title`;
CREATE TABLE `title` (
  `id` int(8) NOT NULL,
  `title` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_id` int(8) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `title_conversion`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `title_conversion`;
CREATE TABLE `title_conversion` (
  `id` int(8) NOT NULL,
  `old_title` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `new_title` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `town_load`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `town_load`;
CREATE TABLE `town_load` (
  `region` varchar(50) DEFAULT NULL,
  `region_code` int(8) DEFAULT NULL,
  `town` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `people_id` int(11) DEFAULT NULL,
  `expiry` date NOT NULL,
  `last_logon` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_dept`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `user_dept`;
CREATE TABLE `user_dept` (
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `changed_id` int(11) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Dept influenced by User';

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `expiry` date DEFAULT NULL,
  `changed_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `model_id` int(11) DEFAULT NULL,
  `colour_id` int(11) DEFAULT NULL,
  `license_no` varchar(20) DEFAULT NULL,
  `license_expiry` date DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_make`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `vehicle_make`;
CREATE TABLE `vehicle_make` (
  `id` int(11) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model`
--
-- Creation: Aug 20, 2024 at 02:07 PM
--

DROP TABLE IF EXISTS `vehicle_model`;
CREATE TABLE `vehicle_model` (
  `id` int(11) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `make_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `changed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_responsibility`
--
ALTER TABLE `account_responsibility`
  ADD PRIMARY KEY (`account_no`,`responsible_acct`),
  ADD KEY `ar_responsible` (`responsible_acct`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_user_id` (`user_id`),
  ADD KEY `ad_city_id` (`city_id`);

--
-- Indexes for table `address_type`
--
ALTER TABLE `address_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_type` (`asset_type`);

--
-- Indexes for table `asset_phone`
--
ALTER TABLE `asset_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ap_asset_id` (`asset_id`);

--
-- Indexes for table `asset_type`
--
ALTER TABLE `asset_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atg_load`
--
ALTER TABLE `atg_load`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `at_people_id` (`people_id`),
  ADD KEY `at_user_id` (`user_id`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar_assets`
--
ALTER TABLE `calendar_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar_schedule`
--
ALTER TABLE `calendar_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_receipts`
--
ALTER TABLE `cash_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cr_people_id` (`people_id`),
  ADD KEY `cr_user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_group`
--
ALTER TABLE `cat_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_user_id` (`user_id`);

--
-- Indexes for table `colour`
--
ALTER TABLE `colour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `colour_user_id` (`user_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_address`
--
ALTER TABLE `company_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_hod` (`hod`),
  ADD KEY `dept_user_id` (`user_id`);

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dis_user_id` (`user_id`);

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electricity`
--
ALTER TABLE `electricity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_asset_id` (`asset_id`),
  ADD KEY `el_user_id` (`user_id`);

--
-- Indexes for table `email_addresses`
--
ALTER TABLE `email_addresses`
  ADD PRIMARY KEY (`user_id`,`id`);

--
-- Indexes for table `email_type`
--
ALTER TABLE `email_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `et_user_id` (`user_id`);

--
-- Indexes for table `function_log`
--
ALTER TABLE `function_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `his_people_id` (`people_id`),
  ADD KEY `his_user_id` (`user_id`);

--
-- Indexes for table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `in_dept_id` (`dept_id`),
  ADD KEY `in_cat_id` (`int_category_id`),
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
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logon_log`
--
ALTER TABLE `logon_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ll_user_id` (`user_id`);

--
-- Indexes for table `med_category`
--
ALTER TABLE `med_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `med_history`
--
ALTER TABLE `med_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mh_people_id` (`people_id`),
  ADD KEY `mh_proc_id` (`proc_id`),
  ADD KEY `mh_user_id` (`user_id`);

--
-- Indexes for table `med_procedures`
--
ALTER TABLE `med_procedures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mp_cat` (`category_id`),
  ADD KEY `mp_user_id` (`user_id`);

--
-- Indexes for table `med_sched`
--
ALTER TABLE `med_sched`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ms_people_id` (`people_id`),
  ADD KEY `ms_proc_id` (`med_proc_id`),
  ADD KEY `ms_user_id` (`user_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `person_id` (`people_id`,`group_id`),
  ADD KEY `group_id_const` (`group_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `n_contact_id` (`contact_id`),
  ADD KEY `n_user_id` (`user_id`);

--
-- Indexes for table `news_users`
--
ALTER TABLE `news_users`
  ADD PRIMARY KEY (`news_id`,`user_id`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_text`
--
ALTER TABLE `page_text`
  ADD PRIMARY KEY (`module_id`,`text_id`,`lang_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_no` (`account_no`);

--
-- Indexes for table `people_address`
--
ALTER TABLE `people_address`
  ADD UNIQUE KEY `people_id` (`people_id`,`address_id`);

--
-- Indexes for table `people_asset`
--
ALTER TABLE `people_asset`
  ADD PRIMARY KEY (`people_id`,`asset_id`),
  ADD KEY `asset` (`asset_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people_interventions`
--
ALTER TABLE `people_interventions`
  ADD PRIMARY KEY (`people_id`,`int_id`);

--
-- Indexes for table `people_log`
--
ALTER TABLE `people_log`
  ADD PRIMARY KEY (`id`,`changed`),
  ADD UNIQUE KEY `account_no` (`account_no`);

--
-- Indexes for table `people_occupation`
--
ALTER TABLE `people_occupation`
  ADD PRIMARY KEY (`people_id`),
  ADD KEY `occupation_id` (`occupation_id`);

--
-- Indexes for table `people_phone`
--
ALTER TABLE `people_phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people_related`
--
ALTER TABLE `people_related`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pr_primary_person` (`people_id`),
  ADD KEY `pr_secondary_person` (`related_id`),
  ADD KEY `pr_user_id` (`user_id`);

--
-- Indexes for table `people_role`
--
ALTER TABLE `people_role`
  ADD KEY `people_role_constraint` (`people_id`),
  ADD KEY `role_constraint` (`role_id`);

--
-- Indexes for table `people_text`
--
ALTER TABLE `people_text`
  ADD UNIQUE KEY `people2id_u` (`people_id`,`text_id`);

--
-- Indexes for table `people_trip`
--
ALTER TABLE `people_trip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pt_people_id` (`people_id`);

--
-- Indexes for table `people_vehicle`
--
ALTER TABLE `people_vehicle`
  ADD PRIMARY KEY (`people_id`,`vehicle_id`),
  ADD KEY `pv_user_id` (`user_id`),
  ADD KEY `pv_vehicle_id` (`vehicle_id`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensitive_text`
--
ALTER TABLE `sensitive_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensitive_text_type`
--
ALTER TABLE `sensitive_text_type`
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
-- Indexes for table `tasks_assigned`
--
ALTER TABLE `tasks_assigned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tasks_history`
--
ALTER TABLE `tasks_history`
  ADD PRIMARY KEY (`id`,`changed`);

--
-- Indexes for table `task_severity`
--
ALTER TABLE `task_severity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_type`
--
ALTER TABLE `task_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tt_user_id` (`user_id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title_conversion`
--
ALTER TABLE `title_conversion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_person` (`people_id`),
  ADD KEY `users_user_id` (`user_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user_dept`
--
ALTER TABLE `user_dept`
  ADD PRIMARY KEY (`user_id`,`dept_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `ur_role_id` (`role_id`),
  ADD KEY `ur_changed_id` (`changed_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_reg_no` (`reg_no`);

--
-- Indexes for table `vehicle_make`
--
ALTER TABLE `vehicle_make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vm_make` (`make_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `address_type`
--
ALTER TABLE `address_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_phone`
--
ALTER TABLE `asset_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_type`
--
ALTER TABLE `asset_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atg_load`
--
ALTER TABLE `atg_load`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calendar_assets`
--
ALTER TABLE `calendar_assets`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calendar_schedule`
--
ALTER TABLE `calendar_schedule`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_receipts`
--
ALTER TABLE `cash_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cat_group`
--
ALTER TABLE `cat_group`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colour`
--
ALTER TABLE `colour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_address`
--
ALTER TABLE `company_address`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `electricity`
--
ALTER TABLE `electricity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_type`
--
ALTER TABLE `email_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `function_log`
--
ALTER TABLE `function_log`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
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
-- AUTO_INCREMENT for table `logon_log`
--
ALTER TABLE `logon_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `med_category`
--
ALTER TABLE `med_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `med_history`
--
ALTER TABLE `med_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `med_procedures`
--
ALTER TABLE `med_procedures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `med_sched`
--
ALTER TABLE `med_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_email`
--
ALTER TABLE `people_email`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_phone`
--
ALTER TABLE `people_phone`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people_related`
--
ALTER TABLE `people_related`
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
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `race`
--
ALTER TABLE `race`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sensitive_text`
--
ALTER TABLE `sensitive_text`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sensitive_text_type`
--
ALTER TABLE `sensitive_text_type`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `tasks_assigned`
--
ALTER TABLE `tasks_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_severity`
--
ALTER TABLE `task_severity`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_type`
--
ALTER TABLE `task_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `title_conversion`
--
ALTER TABLE `title_conversion`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_make`
--
ALTER TABLE `vehicle_make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_responsibility`
--
ALTER TABLE `account_responsibility`
  ADD CONSTRAINT `ar_account` FOREIGN KEY (`account_no`) REFERENCES `people` (`account_no`),
  ADD CONSTRAINT `ar_responsible` FOREIGN KEY (`responsible_acct`) REFERENCES `people` (`account_no`);

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `ad_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `ad_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_type` FOREIGN KEY (`asset_type`) REFERENCES `asset_type` (`id`);

--
-- Constraints for table `asset_phone`
--
ALTER TABLE `asset_phone`
  ADD CONSTRAINT `ap_asset_id` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`);

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `at_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `at_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `cash_receipts`
--
ALTER TABLE `cash_receipts`
  ADD CONSTRAINT `cr_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `cr_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `city_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `colour`
--
ALTER TABLE `colour`
  ADD CONSTRAINT `colour_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dept`
--
ALTER TABLE `dept`
  ADD CONSTRAINT `dept_hod` FOREIGN KEY (`hod`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `dept_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `discipline`
--
ALTER TABLE `discipline`
  ADD CONSTRAINT `dis_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `electricity`
--
ALTER TABLE `electricity`
  ADD CONSTRAINT `el_asset_id` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `el_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `email_type`
--
ALTER TABLE `email_type`
  ADD CONSTRAINT `et_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `his_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `his_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `interventions`
--
ALTER TABLE `interventions`
  ADD CONSTRAINT `in_cat_id` FOREIGN KEY (`int_category_id`) REFERENCES `int_category` (`id`),
  ADD CONSTRAINT `in_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `dept` (`id`),
  ADD CONSTRAINT `in_int_type` FOREIGN KEY (`int_type`) REFERENCES `int_type` (`id`),
  ADD CONSTRAINT `in_leader_id` FOREIGN KEY (`leader_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `in_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `med_history`
--
ALTER TABLE `med_history`
  ADD CONSTRAINT `mh_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `mh_proc_id` FOREIGN KEY (`proc_id`) REFERENCES `med_procedures` (`id`),
  ADD CONSTRAINT `mh_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `med_procedures`
--
ALTER TABLE `med_procedures`
  ADD CONSTRAINT `mp_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `med_sched`
--
ALTER TABLE `med_sched`
  ADD CONSTRAINT `ms_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `ms_proc_id` FOREIGN KEY (`med_proc_id`) REFERENCES `med_procedures` (`id`),
  ADD CONSTRAINT `ms_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `group_id_const` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `person_id_const` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `n_contact_id` FOREIGN KEY (`contact_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `n_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_asset`
--
ALTER TABLE `people_asset`
  ADD CONSTRAINT `asset` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `people` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_company`
--
ALTER TABLE `people_company`
  ADD CONSTRAINT `pc_co_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `pc_people_co` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `people_related`
--
ALTER TABLE `people_related`
  ADD CONSTRAINT `pr_primary_person` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `pr_secondary_person` FOREIGN KEY (`related_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `pr_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

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
-- Constraints for table `people_vehicle`
--
ALTER TABLE `people_vehicle`
  ADD CONSTRAINT `pv_people_id` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `pv_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `pv_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `severity`
--
ALTER TABLE `severity`
  ADD CONSTRAINT `sev_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `tasks_assigned`
--
ALTER TABLE `tasks_assigned`
  ADD CONSTRAINT `tasks_assigned_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `task_type`
--
ALTER TABLE `task_type`
  ADD CONSTRAINT `tt_user_id` FOREIGN KEY (`user_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `ur_changed_id` FOREIGN KEY (`changed_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ur_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `ur_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  ADD CONSTRAINT `vm_make` FOREIGN KEY (`make_id`) REFERENCES `vehicle_make` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
