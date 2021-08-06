-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2020 at 01:34 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merge_lucid`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_history`
--

CREATE TABLE `account_history` (
  `id` int(11) NOT NULL,
  `sync` varchar(20) NOT NULL,
  `ref_admission_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `wallet_balance` varchar(80) NOT NULL,
  `credit` varchar(50) NOT NULL,
  `debit` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_history`
--

INSERT INTO `account_history` (`id`, `sync`, `ref_admission_id`, `patient_id`, `wallet_balance`, `credit`, `debit`, `date`) VALUES
(1, 'off', 1, 1, '7200', '', '1800', '2020-02-25 00:00:00'),
(2, 'off', 2, 3, '2200', '', '1800', '2020-02-25 00:00:00'),
(3, 'off', 2, 3, '300', '', '1900', '2020-02-25 00:00:00'),
(4, 'off', 2, 3, '-200', '', '500', '2020-02-25 00:00:00'),
(5, 'off', 2, 3, '-1400', '', '1200', '2020-02-25 00:00:00'),
(6, 'off', 2, 3, '-10900', '', '9500', '2020-02-26 00:00:00'),
(7, 'off', 2, 3, '-14900', '', '4000', '2020-02-26 00:00:00'),
(8, 'off', 2, 3, '-17400', '', '2500', '2020-02-27 00:00:00'),
(9, 'off', 2, 3, '-20200', '', '2800', '2020-02-27 00:00:00'),
(10, 'off', 2, 3, '-28200', '', '8000', '2020-02-27 17:16:32'),
(11, 'off', 4, 6, '8200', '', '1800', '2020-03-01 16:20:13'),
(12, 'off', 2, 3, '-32700', '', '4500', '2020-03-02 09:15:13'),
(13, 'off', 2, 3, '-38200', '', '5500', '2020-03-02 09:16:48'),
(14, 'off', 2, 3, '-38220', '', '20', '2020-03-02 09:18:36'),
(15, 'off', 4, 6, '6400', '', '1800', '2020-03-06 10:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `next_app` varchar(50) NOT NULL,
  `app_date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `sub_clinic_id` int(11) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `sync`, `next_app`, `app_date`, `patient_id`, `waiting_list_id`, `sub_clinic_id`, `consultant`, `status`, `date`) VALUES
(1, 'off', '25/6', '0000-00-00', 2, 2, 1, 'Tom James', 'OPEN', '2020-02-24 09:34:31'),
(2, 'off', '25/6', '0000-00-00', 5, 5, 1, 'admin user', 'OPEN', '2020-02-25 16:38:44'),
(3, 'off', '2/7', '0000-00-00', 6, 8, 1, 'Tom James', 'OPEN', '2020-02-26 15:37:08'),
(4, 'off', '2/14', '0000-00-00', 4, 9, 1, 'Tom James', 'OPEN', '2020-02-27 08:58:51'),
(5, 'off', '2/14', '0000-00-00', 4, 9, 1, 'Tom James', 'PENDING', '2020-02-27 08:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(11) NOT NULL,
  `bed_location_id` varchar(250) NOT NULL,
  `ward_id` varchar(250) NOT NULL,
  `room_number` varchar(100) NOT NULL,
  `bed_no_to` varchar(100) NOT NULL,
  `bed_no_from` varchar(100) NOT NULL,
  `occupied_status` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `bed_location_id`, `ward_id`, `room_number`, `bed_no_to`, `bed_no_from`, `occupied_status`) VALUES
(1, '1', '1', 'GW1', '1', '9', 0),
(2, '2', '2', 'MW1', '1', '6', 0),
(3, '3', '3', 'AEW', '1', '8', 0),
(4, '4', '4', 'OW1', '1', '10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bed_list`
--

CREATE TABLE `bed_list` (
  `id` int(11) NOT NULL,
  `bed_location_id` varchar(250) NOT NULL,
  `ward_id` varchar(250) NOT NULL,
  `room_number` varchar(100) NOT NULL,
  `bed_no` varchar(100) NOT NULL,
  `bed_id` varchar(100) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `occupied_bed_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bed_list`
--

INSERT INTO `bed_list` (`id`, `bed_location_id`, `ward_id`, `room_number`, `bed_no`, `bed_id`, `patient_id`, `occupied_bed_status`) VALUES
(1, '1', '1', 'GW1', '1', '1', '8', 1),
(2, '1', '1', 'GW1', '2', '1', '6', 1),
(3, '1', '1', 'GW1', '3', '1', '', 0),
(4, '1', '1', 'GW1', '4', '1', '', 0),
(5, '1', '1', 'GW1', '5', '1', '', 0),
(6, '2', '2', 'MW1', '1', '2', '7', 1),
(7, '2', '2', 'MW1', '2', '2', '', 0),
(8, '2', '2', 'MW1', '3', '2', '', 0),
(9, '2', '2', 'MW1', '4', '2', '', 0),
(10, '2', '2', 'MW1', '5', '2', '', 0),
(11, '2', '2', 'MW1', '6', '2', '', 0),
(12, '3', '3', 'AEW', '1', '3', '', 0),
(13, '3', '3', 'AEW', '2', '3', '', 0),
(14, '3', '3', 'AEW', '3', '3', '', 0),
(15, '3', '3', 'AEW', '4', '3', '', 0),
(16, '3', '3', 'AEW', '5', '3', '', 0),
(17, '3', '3', 'AEW', '6', '3', '', 0),
(18, '3', '3', 'AEW', '7', '3', '', 0),
(19, '3', '3', 'AEW', '8', '3', '', 0),
(20, '4', '4', 'OW1', '1', '4', '', 0),
(21, '4', '4', 'OW1', '2', '4', '', 0),
(22, '4', '4', 'OW1', '3', '4', '', 0),
(23, '4', '4', 'OW1', '4', '4', '', 0),
(24, '4', '4', 'OW1', '5', '4', '', 0),
(25, '4', '4', 'OW1', '6', '4', '', 0),
(26, '4', '4', 'OW1', '7', '4', '', 0),
(27, '4', '4', 'OW1', '8', '4', '', 0),
(28, '4', '4', 'OW1', '9', '4', '', 0),
(29, '4', '4', 'OW1', '10', '4', '', 0),
(33, '1', '1', 'GW1', '5', '1', '', 0),
(34, '1', '1', 'GW1', '6', '1', '', 0),
(36, '1', '1', 'GW1', '7', '1', '', 0),
(37, '1', '1', 'GW1', '8', '1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `bill_number` varchar(50) NOT NULL,
  `exempted_by` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `revenues` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `consultant` varchar(80) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost_by` varchar(50) NOT NULL,
  `revenue_officer` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `date_only` date NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `sync`, `bill_number`, `exempted_by`, `payment_type`, `patient_id`, `first_name`, `last_name`, `revenues`, `total_price`, `consultant`, `quantity`, `cost_by`, `revenue_officer`, `status`, `receipt`, `dept`, `date_only`, `date`) VALUES
(1, 'unsync', '200222010001', '', '', 0, 'Seyi', 'Adebayo', 'Folder', 800, '', 1, 'admin user', 'admin user', 'PAID', '908764', 'Records', '2020-02-22', '2020-02-22 17:37:18'),
(2, 'unsync', '200223010001', '', '', 1, 'Seyi', 'Adebayo', '', 9000, '', 1, '', 'admin user', 'CLEARED', '857650', 'Records', '2020-02-23', '2020-02-23 00:04:11'),
(3, 'unsync', '200223010002', '', '', 1, 'Seyi', 'Adebayo', '', 0, '', 0, '', 'admin user', '', '', '', '0000-00-00', '0000-00-00 00:00:00'),
(4, 'unsync', '200223010003', '', '', 0, 'Kemi', 'Nelson', 'Folder', 800, '', 1, 'admin user', 'admin user', 'PAID', '320947', 'Records', '2020-02-23', '2020-02-23 19:25:30'),
(5, 'unsync', '200224010001', '', '', 1, 'Seyi', 'Adebayo', '', 1000, '', 1, '', 'admin user', 'CLEARED', '1000', 'Records', '2020-02-24', '2020-02-24 08:32:40'),
(6, 'unsync', '200224010002', '', '', 0, 'Ade', 'Banjo', 'Folder', 800, '', 1, 'admin user', 'admin user', 'PAID', '098765', 'Records', '2020-02-24', '2020-02-24 09:24:15'),
(7, 'unsync', '200224010003', '', '', 0, 'Rita', 'Patrick', 'Folder', 400, '', 1, 'admin user', 'admin user', 'PAID', '430455', 'Records', '2020-02-24', '2020-02-24 09:28:22'),
(8, 'unsync', '200224010004', '', '', 3, 'Ade', 'Banjo', '', 0, '', 0, '', 'admin user', '', '', '', '0000-00-00', '0000-00-00 00:00:00'),
(9, 'unsync', '200224010005', '', '', 3, 'Ade', 'Banjo', '', 0, '', 0, '', 'admin user', '', '', '', '0000-00-00', '0000-00-00 00:00:00'),
(10, 'unsync', '200224010006', '', '', 3, 'Ade', 'Banjo', '', 0, '', 0, '', 'admin user', '', '', '', '0000-00-00', '0000-00-00 00:00:00'),
(11, 'unsync', '200224010007', '', '', 3, 'Ade', 'Banjo', '', 4000, '', 1, '', 'admin user', 'CLEARED', '242345', 'Records', '2020-02-24', '2020-02-24 10:48:51'),
(12, 'unsync', '200224010008', '', '', 3, 'Ade', 'Banjo', '[\"PCV\"]', 1000, '', 1, 'AO Abobarin', 'AO Abobarin', 'billed', '', 'lab', '2020-02-24', '2020-02-24 11:13:44'),
(13, 'unsync', '200224010009', '', '', 3, 'Ade', 'Banjo', '[\"Sodium\",\"CSF\"]', 4300, '', 2, 'admin user', 'admin user', 'billed', '', 'lab', '2020-02-24', '2020-02-24 13:19:17'),
(14, 'unsync', '200224010010', '', '', 3, 'Ade', 'Banjo', '[\"Pelvimetry\",\"Lumbo-sacral\"]', 12500, '', 2, 'admin user', 'admin user', 'billed', '', 'scan', '2020-02-24', '2020-02-24 13:25:22'),
(15, 'unsync', '200224010011', '', '', 3, 'Ade', 'Banjo', '[\"Acetazolamide 250mg\",\"Albendazole 200mg\"]', 90, '', 2, 'admin user', 'admin user', 'PAID', '24121', 'drug', '2020-02-24', '2020-02-24 15:06:10'),
(16, 'unsync', '200224010012', '', '', 4, 'Rita', 'Patrick', '', 6500, '', 1, '', 'admin user', 'CLEARED', '097878', 'Records', '2020-02-24', '2020-02-24 16:36:39'),
(17, 'unsync', '200224010013', '', '', 4, 'Rita', 'Patrick', '', 4000, '', 1, '', 'admin user', 'CLEARED', '', 'Records', '2020-02-24', '2020-02-24 16:40:31'),
(18, 'unsync', '200224010014', '', '', 4, 'Rita', 'Patrick', '[\"Rbe Count\",\"Retics\"]', 1200, '', 2, 'AO Abobarin', 'AO Abobarin', 'PAID', '342345', 'lab', '2020-02-24', '2020-02-24 16:49:27'),
(19, 'unsync', '200224010015', '', '', 4, 'Rita', 'Patrick', '', 0, '27', 1, '', '27', 'SETTLE', '4343', 'Records', '0000-00-00', '2020-02-24 16:54:52'),
(20, 'unsync', '200225010001', '', '', 2, 'Kemi', 'Nelson', '[\"PCV\",\"Hb\"]', 1800, '', 2, 'admin user', 'admin user', 'billed', '', 'lab', '2020-02-25', '2020-02-25 15:20:48'),
(21, 'unsync', '200225010002', '', '', 3, 'Ade', 'Banjo', '[\"MCHC\",\"MCH\",\"WBC\"]', 3050, '', 3, 'admin user', 'admin user', 'billed', '', 'lab', '2020-02-25', '2020-02-25 16:09:03'),
(22, 'unsync', '200225010003', '', '', 0, 'Kayode', 'Bankole', 'Folder', 800, '', 1, 'admin user', 'admin user', 'PAID', '436546', 'Records', '2020-02-25', '2020-02-25 16:31:50'),
(23, 'unsync', '200225010004', '', '', 5, 'Kayode', 'Bankole', '[\"LFT\",\"CSF\",\"Sodium\"]', 7300, '', 3, 'admin user', 'admin user', 'billed', '', 'lab', '2020-02-25', '2020-02-25 16:40:49'),
(24, 'unsync', '200226010001', '', '', 5, 'Kayode', 'Bankole', 'Consultation', 800, '', 1, 'John Allison', 'John Allison', 'PAID', '675888', 'Records', '2020-02-26', '2020-02-26 10:29:47'),
(25, 'unsync', '200226010002', '', '', 5, 'Kayode', 'Bankole', '[\"LFT\",\"Lipid Profile\",\"CSF\",\"Sodium\"]', 9800, '', 4, 'John Allison', 'John Allison', 'PAID', '43543', 'lab', '2020-02-26', '2020-02-26 10:41:21'),
(26, 'unsync', '200226010003', '', '', 3, 'Ade', 'Banjo', '[\"Arm\",\"Lumbo-sacral\"]', 11000, '', 2, 'John Allison', 'John Allison', 'PAID', '454466', 'scan', '2020-02-26', '2020-02-26 13:52:08'),
(27, 'unsync', '200226010004', '', '', 0, 'Joy', 'Mba', 'Folder', 800, '', 1, 'admin user', 'admin user', 'PAID', '348932', 'Records', '2020-02-26', '2020-02-26 15:20:55'),
(28, 'unsync', '200226010005', '', '', 6, 'Joy', 'Mba', '[\"PCV\",\"Hb\"]', 1800, '', 2, 'AO Abobarin', 'AO Abobarin', 'PAID', '34355', 'lab', '2020-02-26', '2020-02-26 16:06:15'),
(29, 'unsync', '200227010001', '', '', 4, 'Rita', 'Patrick', '', -2000, '27', 1, '', '27', 'SETTLE', '4343', 'Records', '0000-00-00', '2020-02-27 08:42:10'),
(30, 'unsync', '200227010002', '', '', 4, 'Rita', 'Patrick', 'Folder', 400, '', 1, 'admin user', 'admin user', 'PAID', '987651', 'Records', '2020-02-27', '2020-02-27 08:54:09'),
(31, 'unsync', '200227010003', '', '', 4, 'Rita', 'Patrick', '[\"Blood Group\",\"PCV\"]', 1800, '', 2, 'John Allison', 'John Allison', 'PAID', '230532', 'lab', '2020-02-27', '2020-02-27 09:01:23'),
(32, 'unsync', '200227010004', '', '', 4, 'Rita', 'Patrick', '[\"Ankle\",\"Lumbo-sacral\"]', 11000, '', 2, 'John Allison', 'John Allison', 'PAID', '57657', 'scan', '2020-02-27', '2020-02-27 09:05:41'),
(33, 'unsync', '200227010005', '', '', 1, 'Seyi', 'Adebayo', '', 7200, '26', 1, '', '26', 'REFUND', '4343', 'Records', '0000-00-00', '2020-02-27 10:55:27'),
(34, 'unsync', '200227010006', '', '', 3, 'Ade', 'Banjo', '[\"Pelvic Scan\",\"Breast\"]', 9500, '', 2, 'Seun Omisore', 'Seun Omisore', 'PAID', '234534', 'scan', '2020-02-27', '2020-02-27 10:58:32'),
(35, 'unsync', '200227010007', '', '', 4, 'Rita', 'Patrick', '[\"Acetazolamide 250mg\"]', 20, '', 1, 'admin user', 'admin user', 'billed', '', 'drug', '2020-02-27', '2020-02-27 13:57:21'),
(36, 'unsync', '200227010008', '', '', 6, 'Joy', 'Mba', '[\"Acetazolamide 250mg\"]', 20, '', 1, 'admin user', 'admin user', 'billed', '', 'drug', '2020-02-27', '2020-02-27 14:04:01'),
(37, 'unsync', '200227010009', '', '', 3, 'Ade', 'Banjo', '[\"Acyclovir 200mg\",\"Acetazolamide 250mg\"]', 140, '', 2, 'admin user', 'admin user', 'billed', '', 'drug', '2020-02-27', '2020-02-27 14:25:17'),
(38, 'unsync', '200227010010', '', '', 3, 'Ade', 'Banjo', '[\"Acetazolamide 250mg\",\"Acyclovir 200mg\"]', 140, '', 2, 'admin user', 'admin user', 'billed', '', 'drug', '2020-02-27', '2020-02-27 14:28:32'),
(39, 'unsync', '200227010011', '', '', 3, 'Ade', 'Banjo', '[\"PCV\",\"Hb\"]', 1800, '', 2, 'admin user', 'admin user', 'billed', '', 'lab', '2020-02-27', '2020-02-27 14:42:54'),
(40, 'unsync', '200227010012', '', '', 3, 'Ade', 'Banjo', '[\"Acetazolamide 250mg\"]', 20, '', 1, 'admin user', 'admin user', 'billed', '', 'drug', '2020-02-27', '2020-02-27 15:25:35'),
(41, 'unsync', '200227010013', '', '', 3, 'Ade', 'Banjo', '[\"Acetazolamide 250mg\"]', 20, '', 1, 'admin user', 'admin user', 'billed', '', 'drug', '2020-02-27', '2020-02-27 15:37:35'),
(42, 'unsync', '200227010014', '', '', 3, 'Ade', 'Banjo', '[\"PCV\",\"Hb\",\"Rbe Count\"]', 2300, '', 3, 'admin user', 'admin user', 'PAID', '35345', 'lab', '2020-02-27', '2020-02-27 15:38:14'),
(43, 'unsync', '200227010015', '', '', 3, 'Ade', 'Banjo', '[\"Ankle\",\"Arm\",\"Lumbo-sacral\"]', 15000, '', 3, 'admin user', 'admin user', 'billed', '', 'scan', '2020-02-27', '2020-02-27 15:39:37'),
(44, 'unsync', '200227010016', '', '', 3, 'Ade', 'Banjo', '[\"Acetazolamide 250mg\",\"Albendazole 200mg\"]', 90, '', 2, 'admin user', 'admin user', 'DISPENSED', '32423452', 'drug', '2020-02-27', '2020-02-27 15:42:24'),
(45, 'unsync', '200227010017', '', '', 3, 'Ade', 'Banjo', '[\"Ankle\"]', 4000, '', 1, 'admin user', 'admin user', 'PAID', '32345', 'scan', '2020-02-27', '2020-02-27 15:46:52'),
(46, 'unsync', '200227010018', '', '', 5, 'Kayode', 'Bankole', 'Consultation', 800, '', 1, 'admin user', 'admin user', 'PAID', '787654', 'Records', '2020-02-27', '2020-02-27 16:12:55'),
(47, 'unsync', '200227010019', '', '', 3, 'Ade', 'Banjo', '[\"PCV\",\"Hb\"]', 1800, '', 2, 'admin user', 'admin user', 'PAID', '34235', 'lab', '2020-02-27', '2020-02-27 17:14:56'),
(48, 'unsync', '200227010020', '', '', 3, 'Ade', 'Banjo', '[\"Acetazolamide 250mg\"]', 20, '', 1, 'admin user', 'admin user', 'PAID', '35345', 'drug', '2020-02-27', '2020-02-27 17:17:44'),
(49, 'unsync', '200227010021', '', '', 3, 'Ade', 'Banjo', '', 10000, '', 1, '', 'admin user', 'CLEARED', '345243', 'Records', '2020-02-27', '2020-02-27 17:30:49'),
(50, 'unsync', '200228010001', '', '', 6, 'Joy', 'Mba', 'Consultation', 800, '', 1, 'admin user', 'admin user', 'PAID', '676568', 'Records', '2020-02-28', '2020-02-28 13:18:56'),
(51, 'unsync', '200228010002', '', '', 6, 'Joy', 'Mba', '', 10000, '', 1, '', 'admin user', 'CLEARED', '241324', 'Records', '2020-02-28', '2020-02-28 14:55:28'),
(52, 'unsync', '200301010001', '', '', 6, 'Joy', 'Mba', '[\"Ankle\",\"Arm\"]', 8000, '', 2, 'admin user', 'admin user', 'PAID', '099876', 'scan', '2020-03-01', '2020-03-01 16:43:08'),
(53, 'unsync', '200301010002', '', '', 6, 'Joy', 'Mba', '[\"LFT\"]', 3000, '', 1, 'admin user', 'admin user', 'billed', '', 'lab', '2020-03-01', '2020-03-01 16:46:40'),
(54, 'unsync', '200301010003', '', '', 6, 'Joy', 'Mba', '[\"Acetazolamide 250mg\",\"Acyclovir 200mg\"]', 140, '', 2, 'admin user', 'admin user', 'billed', '', 'drug', '2020-03-01', '2020-03-01 16:52:01'),
(55, 'unsync', '200301010004', '', '', 2, 'Kemi', 'Nelson', 'Consultation', 800, '', 1, 'admin user', 'admin user', 'PAID', '43635', 'Records', '2020-03-01', '2020-03-01 16:59:37'),
(56, 'unsync', '200301010005', '', '', 2, 'Kemi', 'Nelson', '[\"Acetazolamide 250mg\",\"Albendazole 200mg\"]', 90, '', 2, 'admin user', 'admin user', 'billed', '', 'drug', '2020-03-01', '2020-03-01 17:04:30'),
(57, 'unsync', '200301010006', '', '', 2, 'Kemi', 'Nelson', '[\"MP\",\"Widal\"]', 1000, '', 2, 'admin user', 'admin user', 'billed', '', 'lab', '2020-03-01', '2020-03-01 17:05:06'),
(58, 'unsync', '200301010007', '', '', 2, 'Kemi', 'Nelson', '[\"Pelvic Scan\",\"Transvaginal\"]', 4000, '', 2, 'admin user', 'admin user', 'billed', '', 'scan', '2020-03-01', '2020-03-01 17:10:41'),
(59, 'unsync', '200302010001', '', '', 3, 'Ade', 'Banjo', '[\"Hb\"]', 800, '', 1, 'admin user', 'admin user', 'billed', '', 'lab', '2020-03-02', '2020-03-02 09:15:56'),
(60, 'unsync', '200302010002', '', '', 3, 'Ade', 'Banjo', '[\"Arm\"]', 4000, '', 1, 'admin user', 'admin user', 'billed', '', 'scan', '2020-03-02', '2020-03-02 09:17:29'),
(61, 'unsync', '200302010003', '', '', 3, 'Ade', 'Banjo', '[\"Albendazole 200mg\"]', 70, '', 1, 'admin user', 'admin user', 'billed', '', 'drug', '2020-03-02', '2020-03-02 09:19:52'),
(62, 'unsync', '200302010004', '', '', 3, 'Ade', 'Banjo', '', -38220, '27', 1, '', '27', 'SETTLE', '123456', 'Records', '0000-00-00', '2020-03-02 09:27:19'),
(63, 'unsync', '200306010001', '', '', 0, 'New', 'Demo', 'Consultation', 800, '', 1, 'admin user', 'admin user', 'PAID', '774411', 'Records', '2020-03-06', '2020-03-06 09:51:52'),
(64, 'unsync', '200306010002', '', '', 6, 'Joy', 'Mba', '', 5000, '', 1, '', 'admin user', 'CLEARED', '456456', 'Records', '2020-03-06', '2020-03-06 10:00:22'),
(65, 'unsync', '200306010003', '', '', 7, 'New', 'Demo', '', 5000, '', 1, '', 'admin user', 'CLEARED', '456456', 'Records', '2020-03-06', '2020-03-06 14:51:20'),
(66, 'unsync', '200306010004', '', '', 0, 'aman', 'sdfd', 'Consultation', 800, '', 1, 'Tom James', 'Tom James', 'PAID', '556688', 'Records', '2020-03-06', '2020-03-06 15:19:58'),
(67, 'unsync', '200306010005', '', '', 0, 'Demo', 'Demo2', 'Consultation', 800, '', 1, 'Tom James', 'Tom James', 'PAID', '123456', 'Records', '2020-03-06', '2020-03-06 16:18:18'),
(68, 'unsync', '200306010006', '', '', 8, 'aman', 'sdfd', '', 6000, '', 1, '', 'admin user', 'CLEARED', '123456', 'Records', '2020-03-06', '2020-03-06 16:23:53'),
(69, 'unsync', '200311010001', '', '', 4, 'Rita', 'Patrick', 'Consultation', 400, '', 1, 'admin user', 'admin user', 'PAID', '111111', 'Records', '2020-03-11', '2020-03-11 08:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `body_part`
--

CREATE TABLE `body_part` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` tinyint(2) DEFAULT '0',
  `used_status` tinyint(2) DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `body_part`
--

INSERT INTO `body_part` (`id`, `name`, `status`, `used_status`, `created`) VALUES
(1, 'Head', 1, 0, '2020-02-07 08:07:44'),
(2, 'Chest', 0, 0, '0000-00-00 00:00:00'),
(3, 'Neck', 1, 1, '2020-02-07 08:07:56'),
(5, 'Nose', 1, 0, '2020-03-04 09:32:41'),
(6, 'Stomach', 1, 0, '2020-03-04 09:34:49'),
(7, 'Upper arm', 1, 0, '2020-03-04 09:38:06'),
(8, 'Knee', 1, 0, '2020-03-04 09:40:22'),
(9, 'Forearm', 1, 0, '2020-03-04 10:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `cancle_admission`
--

CREATE TABLE `cancle_admission` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `cancel_by_id` varchar(50) NOT NULL,
  `reason` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `casenote`
--

CREATE TABLE `casenote` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `sub_clinic_id` int(11) NOT NULL,
  `subjective` text NOT NULL,
  `objective` text NOT NULL,
  `assessment` text NOT NULL,
  `plan` text NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casenote`
--

INSERT INTO `casenote` (`id`, `sync`, `patient_id`, `waiting_list_id`, `sub_clinic_id`, `subjective`, `objective`, `assessment`, `plan`, `consultant`, `status`, `date`) VALUES
(1, 'off', 2, 2, 1, 'Globally, urban renewÂ­al has been embarked upon by public offiÂ­cials and private inÂ­stitutions to improve citiesâ€™ structures and to enhance their economic, cultural and social qualities.', 'Globally, urban renewÂ­al has been embarked upon by public offiÂ­cials and private inÂ­stitutions to improve citiesâ€™ structures and to enhance their economic, cultural and social qualities.', 'Globally, urban renewÂ­al has been embarked upon by public offiÂ­cials and private inÂ­stitutions to improve citiesâ€™ structures and to enhance their economic, cultural and social qualities.', 'Globally, urban renewÂ­al has been embarked upon by public offiÂ­cials and private inÂ­stitutions to improve citiesâ€™ structures and to enhance their economic, cultural and social qualities.', 'Tom James', 'OPEN', '2020-02-24 09:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `case_notes_doctor`
--

CREATE TABLE `case_notes_doctor` (
  `id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `comment` text NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `case_notes_nurse`
--

CREATE TABLE `case_notes_nurse` (
  `id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `comment` text NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created`) VALUES
(1, 'Emzor', '2019-04-02 12:33:47'),
(2, 'Smithkline Beecham', '2019-04-02 12:34:15'),
(3, 'M&amp;B', '2019-04-02 12:37:28'),
(4, 'Caploux', '2020-01-28 16:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`id`, `name`, `date`) VALUES
(1, 'GOPD', '2019-11-15 12:00:52'),
(2, 'MOPD', '2019-11-15 12:01:09'),
(3, 'SOPD', '2019-11-15 12:01:17'),
(4, 'DERMATOLOGY', '2019-11-15 12:01:32'),
(5, 'GYNAE ONCOLOGY', '2019-11-15 12:04:25'),
(6, 'HAEMATOLOGY', '2019-11-15 12:04:57'),
(7, 'FAMILY PLANNING', '2019-11-15 12:05:21'),
(8, 'STAFF CLINIC', '2019-11-15 12:05:43'),
(9, 'ENDOSCOPY', '2019-11-15 12:05:59'),
(10, 'DENTAL', '2019-11-15 12:06:51'),
(11, 'VIROLOGY', '2019-11-15 12:07:03'),
(12, 'ENT', '2019-11-15 12:07:23'),
(13, 'OPHTHALMOLOGY', '2019-11-15 12:08:52'),
(14, 'PAEDIATRICS', '2019-11-15 12:09:20'),
(15, 'ORTHOPAEDICS', '2019-11-15 12:09:42'),
(16, 'PHYSIOTHERAPY', '2019-11-15 12:11:06'),
(17, 'PAEDIATRICS SURGICAL', '2019-11-15 12:15:57'),
(18, 'ANTENATAL &amp; POS-NATAL', '2019-11-15 12:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `patient_id` varchar(200) NOT NULL,
  `nurse_id` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `status` tinyint(2) DEFAULT '0',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dispensed`
--

CREATE TABLE `dispensed` (
  `id` int(11) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `pharm_id` int(11) NOT NULL,
  `pharm` varchar(80) NOT NULL,
  `product_id` int(11) NOT NULL,
  `drugName` varchar(80) NOT NULL,
  `unit` int(11) NOT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dispensehistory`
--

CREATE TABLE `dispensehistory` (
  `id` int(11) NOT NULL,
  `items` text NOT NULL,
  `item_count` int(11) NOT NULL,
  `dispenser` varchar(80) NOT NULL,
  `dispense_to` varchar(80) NOT NULL,
  `pharmacy_station_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drug_request`
--

CREATE TABLE `drug_request` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `drugs_no` int(11) NOT NULL,
  `not_available` int(11) NOT NULL,
  `doc_com` text NOT NULL,
  `pharm_com` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drug_request`
--

INSERT INTO `drug_request` (`id`, `sync`, `waiting_list_id`, `ward_id`, `bill_id`, `patient_id`, `consultant`, `drugs_no`, `not_available`, `doc_com`, `pharm_com`, `status`, `receipt`, `date`) VALUES
(1, '', 10, 0, 0, 5, 'Tom James', 2, 2, '', '', 'awaiting_costing', '', '2020-02-27 16:23:25'),
(2, '', 3, 3, 48, 3, 'Tom James', 1, 0, '', '', 'PAID', '35345', '2020-02-27 17:14:14'),
(3, '', 0, 1, 54, 6, 'Tom James', 2, 0, '', '', 'billed', '', '2020-02-28 17:36:07'),
(4, '', 12, 0, 56, 2, 'Tom James', 2, 0, '', '', 'billed', '', '2020-03-01 17:03:24'),
(5, '', 0, 3, 0, 3, 'Tom James', 1, 1, '', '', 'awaiting_costing', '', '2020-03-02 09:18:16'),
(6, '', 0, 3, 61, 3, 'Tom James', 1, 0, '', '', 'billed', '', '2020-03-02 09:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `drug_service`
--

CREATE TABLE `drug_service` (
  `id` int(11) NOT NULL,
  `sync` varchar(20) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `drug_request_id` int(11) NOT NULL,
  `ward_clinic` varchar(100) NOT NULL,
  `services` text NOT NULL,
  `unit` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drug_service`
--

INSERT INTO `drug_service` (`id`, `sync`, `bill_id`, `drug_request_id`, `ward_clinic`, `services`, `unit`, `status`, `date`) VALUES
(1, 'off', 48, 2, 'ACCIDENT & EMERGENCY', '[\"Acetazolamide 250mg\"]', '1', 'CLEARED', '2020-02-27 17:17:44'),
(2, 'off', 54, 3, 'GYNAE WARD', '[\"Acetazolamide 250mg\",\"Acyclovir 200mg\"]', '2', 'billed', '2020-03-01 16:52:02'),
(3, 'off', 56, 4, 'GOPD', '[\"Acetazolamide 250mg\",\"Albendazole 200mg\"]', '2', 'billed', '2020-03-01 17:04:30'),
(4, 'off', 0, 5, 'ACCIDENT & EMERGENCY', '[\"Acetazolamide 250mg\"]', '1', 'CLEARED', '2020-03-02 09:18:36'),
(5, 'off', 61, 6, 'ACCIDENT & EMERGENCY', '[\"Albendazole 200mg\"]', '1', 'billed', '2020-03-02 09:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `eachdrug`
--

CREATE TABLE `eachdrug` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `test_payment_amount` int(11) NOT NULL,
  `drug_request_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `dosage` varchar(50) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `pharmacy` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `drug_payment_status` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eachdrug`
--

INSERT INTO `eachdrug` (`id`, `sync`, `product_id`, `test_payment_amount`, `drug_request_id`, `product_name`, `quantity`, `dosage`, `consultant`, `pharmacy`, `status`, `date`, `drug_payment_status`) VALUES
(1, '', 1, 0, 1, 'Acetazolamide 250mg', '1', '1', 'Tom James', '', 'OPEN', '2020-02-27 16:23:25', 0),
(2, '', 3, 0, 1, 'Albendazole 200mg', '1', '1', 'Tom James', '', 'OPEN', '2020-02-27 16:23:25', 0),
(3, '', 1, 0, 2, 'Acetazolamide 250mg', '1', '1', 'Tom James', '', 'COSTED', '2020-02-27 17:14:14', 0),
(4, '', 1, 0, 3, 'Acetazolamide 250mg', '1', '1', 'Tom James', '', 'COSTED', '2020-02-28 17:36:07', 0),
(5, '', 2, 0, 3, 'Acyclovir 200mg', '1', '1', 'Tom James', '', 'COSTED', '2020-02-28 17:36:07', 0),
(6, '', 1, 0, 4, 'Acetazolamide 250mg', '1', '1', 'Tom James', '', 'COSTED', '2020-03-01 17:03:24', 0),
(7, '', 3, 0, 4, 'Albendazole 200mg', '1', '1', 'Tom James', '', 'COSTED', '2020-03-01 17:03:24', 0),
(8, '', 1, 0, 5, 'Acetazolamide 250mg', '1', '1', 'Tom James', '', 'OPEN', '2020-03-02 09:18:16', 0),
(9, '', 3, 0, 6, 'Albendazole 200mg', '1', '1', 'Tom James', '', 'COSTED', '2020-03-02 09:19:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `eachscan`
--

CREATE TABLE `eachscan` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `scan_id` int(11) NOT NULL,
  `scan_request_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `scan_name` varchar(80) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `scanResult` text NOT NULL,
  `scientist` varchar(50) NOT NULL,
  `radiologist` varchar(50) NOT NULL,
  `test_payment_amount` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `ipd_status` tinyint(2) DEFAULT '0',
  `scan_payment_status` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eachscan`
--

INSERT INTO `eachscan` (`id`, `sync`, `scan_id`, `scan_request_id`, `quantity`, `scan_name`, `consultant`, `scanResult`, `scientist`, `radiologist`, `test_payment_amount`, `status`, `date`, `ipd_status`, `scan_payment_status`) VALUES
(1, 'off', 15, 1, 1, 'Ankle', 'Tom James', '', '', '', 0, 'OPEN', '2020-02-27 16:23:09', 0, 0),
(2, 'off', 16, 1, 1, 'Arm', 'Tom James', '', '', '', 0, 'OPEN', '2020-02-27 16:23:09', 0, 0),
(3, 'off', 15, 2, 1, 'Ankle', 'Tom James', '', '', '', 0, 'COSTED', '2020-02-27 17:14:04', 1, 0),
(4, 'off', 16, 2, 1, 'Arm', 'Tom James', '', '', '', 0, 'COSTED', '2020-02-27 17:14:04', 1, 0),
(5, 'off', 15, 3, 1, 'Ankle', 'Tom James', '', '', '', 0, 'COSTED', '2020-02-28 17:33:31', 1, 0),
(6, 'off', 16, 3, 1, 'Arm', 'Tom James', '', '', '', 0, 'COSTED', '2020-02-28 17:33:31', 1, 0),
(7, 'off', 19, 4, 1, 'Pelvic Scan', 'Tom James', '', '', '', 0, 'COSTED', '2020-03-01 17:03:02', 0, 0),
(8, 'off', 21, 4, 1, 'Transvaginal', 'Tom James', '', '', '', 0, 'COSTED', '2020-03-01 17:03:03', 0, 0),
(9, 'off', 19, 5, 1, 'Pelvic Scan', 'Tom James', '', '', '', 0, 'COSTED', '2020-03-02 09:16:21', 1, 0),
(10, 'off', 15, 5, 1, 'Ankle', 'Tom James', '', '', '', 0, 'COSTED', '2020-03-02 09:16:22', 1, 0),
(11, 'off', 16, 6, 1, 'Arm', 'Tom James', '', '', '', 0, 'COSTED', '2020-03-02 09:17:18', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eachtest`
--

CREATE TABLE `eachtest` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `test_payment_amount` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `test_request_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `test_name` varchar(80) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `testResult` text NOT NULL,
  `scientist` varchar(50) NOT NULL,
  `pathologist` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `ipd_status` tinyint(2) DEFAULT '0',
  `test_payment_status` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eachtest`
--

INSERT INTO `eachtest` (`id`, `sync`, `test_payment_amount`, `test_id`, `test_request_id`, `quantity`, `test_name`, `consultant`, `testResult`, `scientist`, `pathologist`, `status`, `date`, `ipd_status`, `test_payment_status`) VALUES
(1, 'off', 0, 1, 1, 1, 'PCV', 'Tom James', '', '', '', 'OPEN', '2020-02-27 16:23:02', 0, 0),
(2, 'off', 0, 3, 1, 1, 'Rbe Count', 'Tom James', '', '', '', 'OPEN', '2020-02-27 16:23:02', 0, 0),
(3, 'off', 0, 1, 2, 1, 'PCV', 'Tom James', '', '', '', 'COSTED', '2020-02-27 17:13:57', 1, 0),
(4, 'off', 0, 2, 2, 1, 'Hb', 'Tom James', '', '', '', 'COSTED', '2020-02-27 17:13:57', 1, 0),
(5, 'off', 0, 1, 3, 1, 'PCV', 'Tom James', '', '', '', 'COSTED', '2020-02-28 17:33:00', 1, 0),
(6, 'off', 0, 2, 3, 1, 'Hb', 'Tom James', '', '', '', 'COSTED', '2020-02-28 17:33:00', 1, 0),
(7, 'off', 0, 8, 4, 1, 'LFT', 'Tom James', '', '', '', 'COSTED', '2020-03-01 16:26:22', 1, 0),
(8, 'off', 0, 11, 5, 1, 'MP', 'Tom James', '', '', '', 'COSTED', '2020-03-01 17:02:49', 0, 0),
(9, 'off', 0, 12, 5, 1, 'Widal', 'Tom James', '', '', '', 'COSTED', '2020-03-01 17:02:49', 0, 0),
(10, 'off', 0, 8, 6, 1, 'LFT', 'Tom James', '', '', '', 'COSTED', '2020-03-02 09:14:54', 1, 0),
(11, 'off', 0, 11, 6, 1, 'MP', 'Tom James', '', '', '', 'COSTED', '2020-03-02 09:14:55', 1, 0),
(12, 'off', 0, 1, 6, 1, 'PCV', 'Tom James', '', '', '', 'COSTED', '2020-03-02 09:14:55', 1, 0),
(13, 'off', 0, 2, 7, 1, 'Hb', 'Tom James', '', '', '', 'COSTED', '2020-03-02 09:15:41', 1, 0),
(14, 'off', 0, 1, 8, 1, 'PCV', 'admin user', '', '', '', 'OPEN', '2020-03-06 09:34:00', 1, 0),
(15, 'off', 0, 2, 8, 1, 'Hb', 'admin user', '', '', '', 'OPEN', '2020-03-06 09:34:00', 1, 0),
(16, 'off', 0, 2, 9, 1, 'Hb', 'Tom James', '', '', '', 'COSTED', '2020-03-06 10:57:15', 1, 0),
(17, 'off', 0, 1, 9, 1, 'PCV', 'Tom James', '', '', '', 'COSTED', '2020-03-06 10:57:15', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `emergency_no` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `encounter`
--

CREATE TABLE `encounter` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `case_note` text NOT NULL,
  `next_appointment` varchar(80) NOT NULL,
  `status` varchar(50) NOT NULL,
  `drug` varchar(50) NOT NULL,
  `lab` varchar(50) NOT NULL,
  `scan` varchar(50) NOT NULL,
  `date_only` date NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `encounter`
--

INSERT INTO `encounter` (`id`, `sync`, `patient_id`, `consultant`, `case_note`, `next_appointment`, `status`, `drug`, `lab`, `scan`, `date_only`, `date`) VALUES
(1, 'unsync', 3, 'Temidayo Avwioro', '', '', 'OPEN', 'REQUEST', 'REQUEST', 'REQUEST', '2019-12-02', '2019-12-02 12:57:30'),
(2, 'unsync', 2, 'Oyebimpe Adeniyi', 'hfghfghf', '01/09/2020', 'OPEN', 'NIL', 'billed', 'billed', '2020-01-08', '2020-01-08 07:53:27'),
(3, 'unsync', 2, 'Oyebimpe Adeniyi', '', '', 'OPEN', 'NIL', 'NIL', 'NIL', '2020-01-08', '2020-01-08 07:53:43'),
(4, 'unsync', 4, 'Oyebimpe Adeniyi', 'cgxfx', '01/08/2020', 'OPEN', 'REQUEST', 'REQUEST', 'REQUEST', '2020-01-08', '2020-01-08 07:55:33'),
(5, 'unsync', 5, 'Oyebimpe Adeniyi', 'dgxfcbc', '01/08/2020', 'OPEN', 'NIL', 'billed', 'billed', '2020-01-08', '2020-01-08 08:00:34'),
(6, 'unsync', 1, 'Amupitan Adewale', 'zvbgxdgd', '01/08/2020', 'OPEN', 'NIL', 'REQUEST', 'billed', '2020-01-08', '2020-01-08 08:03:18'),
(16, 'unsync', 13, 'admin user', '', '', 'OPEN', 'billed', 'billed', 'REQUEST', '2020-01-29', '2020-01-29 11:11:34'),
(17, 'unsync', 12, 'Seun Omisore', '', '', 'OPEN', '', 'billed', '', '2020-01-31', '2020-01-31 08:23:01'),
(18, 'unsync', 6, 'Tom James', '', '', 'OPEN', 'REQUEST', 'REQUEST', 'REQUEST', '2020-01-31', '2020-01-31 11:51:21'),
(19, 'unsync', 11, 'Seun Omisore', '', '', 'OPEN', 'billed', 'billed', 'billed', '2020-02-03', '2020-02-03 13:33:16'),
(20, 'unsync', 16, 'Seun Omisore', '', '', 'OPEN', 'billed', 'billed', 'billed', '2020-02-03', '2020-02-03 14:41:10'),
(21, 'unsync', 18, 'Seun Omisore', '', '', 'OPEN', 'billed', 'billed', 'billed', '2020-02-21', '2020-02-21 09:57:06'),
(22, 'unsync', 20, 'Tom James', '', '', 'OPEN', 'REQUEST', 'REQUEST', 'REQUEST', '2020-02-21', '2020-02-21 13:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `enrollee`
--

CREATE TABLE `enrollee` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `nhis_number` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` datetime NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `contact_address` text NOT NULL,
  `hmo` varchar(50) NOT NULL,
  `reg_date` datetime NOT NULL,
  `exp_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrollee_patient`
--

CREATE TABLE `enrollee_patient` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `enrollee_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `nhis_number` varchar(50) NOT NULL,
  `folder_number` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrollee_sub`
--

CREATE TABLE `enrollee_sub` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `enrollee_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `investigations`
--

CREATE TABLE `investigations` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `bill_id` varchar(50) NOT NULL,
  `revenueHead_id` varchar(50) NOT NULL,
  `revenueNames` varchar(80) NOT NULL,
  `unit` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date_generated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_service`
--

CREATE TABLE `ipd_service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(200) NOT NULL,
  `daily_charges` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ipd_service`
--

INSERT INTO `ipd_service` (`id`, `service_name`, `daily_charges`, `date_created`) VALUES
(1, 'Accommodation', '1000', '0000-00-00 00:00:00'),
(2, 'Diet', '800', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ipd_service_log`
--

CREATE TABLE `ipd_service_log` (
  `id` int(11) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `patient_id` varchar(250) NOT NULL,
  `ipd_service_id` varchar(250) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_service`
--

CREATE TABLE `lab_service` (
  `id` int(11) NOT NULL,
  `sync` varchar(20) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `test_request_id` int(11) NOT NULL,
  `ward_clinic` varchar(100) NOT NULL,
  `services` text NOT NULL,
  `unit` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_service`
--

INSERT INTO `lab_service` (`id`, `sync`, `bill_id`, `test_request_id`, `ward_clinic`, `services`, `unit`, `status`, `date`) VALUES
(1, 'off', 47, 2, 'ACCIDENT & EMERGENCY', '[\"PCV\",\"Hb\"]', '2', 'CLEARED', '2020-02-27 17:14:56'),
(2, 'off', 0, 3, 'GYNAE WARD', '[\"PCV\",\"Hb\"]', '2', 'CLEARED', '2020-03-01 16:20:13'),
(3, 'off', 53, 4, 'GYNAE WARD', '[\"LFT\"]', '1', 'billed', '2020-03-01 16:46:40'),
(4, 'off', 57, 5, 'GOPD', '[\"MP\",\"Widal\"]', '2', 'billed', '2020-03-01 17:05:06'),
(5, 'off', 0, 6, 'ACCIDENT & EMERGENCY', '[\"LFT\",\"MP\",\"PCV\"]', '3', 'CLEARED', '2020-03-02 09:15:13'),
(6, 'off', 59, 7, 'ACCIDENT & EMERGENCY', '[\"Hb\"]', '1', 'billed', '2020-03-02 09:15:57'),
(7, 'off', 0, 9, 'GYNAE WARD', '[\"Hb\",\"PCV\"]', '2', 'CLEARED', '2020-03-06 10:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location_name`) VALUES
(1, 'Phase 1'),
(2, 'Phase 2'),
(3, 'Phase 3'),
(4, 'Phase 4');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `value` varchar(80) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `name`, `value`, `date`) VALUES
(1, 'expiryPeriod', '6', '2019-08-19 13:00:48'),
(2, 'reOrderLevel', '65', '2019-08-19 13:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salesperson` varchar(30) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_type` varchar(30) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `folder_number` varchar(50) NOT NULL,
  `tracking_no` varchar(50) NOT NULL,
  `nhis_no` varchar(50) NOT NULL,
  `nhis_reg_date` datetime NOT NULL,
  `nhis_eligibility` varchar(50) NOT NULL,
  `title` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `dob` datetime NOT NULL,
  `age` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `blood_group` varchar(30) NOT NULL,
  `genotype` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(180) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `other_nation` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL,
  `english` varchar(50) NOT NULL,
  `pidgin` varchar(50) NOT NULL,
  `hausa` varchar(50) NOT NULL,
  `yoruba` varchar(50) NOT NULL,
  `igbo` varchar(50) NOT NULL,
  `other_lang` varchar(50) NOT NULL,
  `next_kin_surname` varchar(50) NOT NULL,
  `next_kin_other_names` varchar(80) NOT NULL,
  `next_kin_relationship` varchar(50) NOT NULL,
  `next_kin_phone` varchar(50) NOT NULL,
  `next_kin_address` varchar(180) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `folder_number`, `tracking_no`, `nhis_no`, `nhis_reg_date`, `nhis_eligibility`, `title`, `first_name`, `last_name`, `dob`, `age`, `gender`, `blood_group`, `genotype`, `phone_number`, `email`, `address`, `occupation`, `marital_status`, `nationality`, `other_nation`, `state`, `lga`, `religion`, `language`, `english`, `pidgin`, `hausa`, `yoruba`, `igbo`, `other_lang`, `next_kin_surname`, `next_kin_other_names`, `next_kin_relationship`, `next_kin_phone`, `next_kin_address`, `status`, `date_registered`) VALUES
(1, '301406', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Mr', 'Seyi', 'Adebayo', '1990-12-20 00:00:00', '', 'Male', '', '', '08023348564', 'seyi@yahoo.com', '12 Lag Str', 'Lawyer', 'Single', 'Nigerian', '', 'Ogun', 'Abeokuta', 'Christian', '', 'English', 'Pidgin', '', '', '', '', 'Remi', '', 'Brother', '08036201231', '12 Lag Str', 'OPEN', '2020-02-22 17:42:03'),
(2, '301409', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Miss', 'Kemi', 'Nelson', '1996-09-15 00:00:00', '', 'Female', '', '', '08023348564', 'kemi@yahoo.com', '12 Lagos', 'Lawyer', 'Single', 'Nigerian', '', 'Lagos', 'Ikeja', 'Christian', '', 'English', 'Pidgin', '', '', '', '', 'Remi', '', 'Sister', '08036201231', '12 Lagos', 'OPEN', '2020-02-23 19:29:27'),
(3, '540149', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Mr', 'Ade', 'Banjo', '1996-12-20 00:00:00', '', 'Male', '', '', '080293475757', 'ade@yahoo.com', '12 lag', 'Lawyer', 'Single', 'Nigerian', '', 'Lagos', 'Ikeja', 'Muslim', '', 'English', '', '', 'Yoruba', '', '', 'Remi', '', 'Brother', '08036201231', '12 lag', 'OPEN', '2020-02-24 09:26:52'),
(4, '640149', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Miss', 'Rita', 'Patrick', '2010-08-14 00:00:00', '', 'Female', '', '', '08014937364', 'rita@yahoo.com', '12 Asaba road', 'Student', 'Single', 'Nigerian', '', 'Delta', 'Asaba', 'Christian', '', 'English', 'Pidgin', '', '', '', '', 'Joy', '', 'Mother', '08036201231', '12 Asaba road', 'OPEN', '2020-02-24 09:30:15'),
(5, '301906', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Mr', 'Kayode', 'Bankole', '1998-12-26 00:00:00', '', 'Male', '', '', '080235345543', 'kayode@yahoo.com', '12 lag', 'Lawyer', 'Single', 'Nigerian', '', 'Lagos', 'Ikeja', 'Muslim', '', 'English', 'Pidgin', '', 'Yoruba', '', '', 'Kay', '', 'Brother', '08036201231', '12 lag', 'OPEN', '2020-02-25 16:34:33'),
(6, '381409', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Miss', 'Joy', 'Mba', '1992-12-24 00:00:00', '', 'Male', '', '', '08014937364', 'joy@yahoo.com', '12 As', 'Lawyer', 'Single', 'Nigerian', '', 'Delta', 'Asaba', 'Christian', '', 'English', '', '', '', 'Igbo', '', 'Remi', '', 'Sister', '08036201234', '12 As', 'OPEN', '2020-02-26 15:24:47'),
(7, 'hjghjgkj', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Mr', 'New', 'Demo', '1996-02-15 00:00:00', '', 'Male', '', '', '7894561320', 'hjgh@yhk.dhfg', 'hjghjf', 'hgjgkjgj', 'Single', 'Nigerian', '', 'Ekiti', 'hg', 'Christian', '', 'English', '', '', '', '', '', 'mnbczgvxdf', '', 'xmzjdhjs', '794561320', 'kljdghdyfug', 'OPEN', '2020-03-06 10:27:20'),
(8, 'ds;lfkdsf', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Mr', 'aman', 'sdfd', '1999-01-12 00:00:00', '', 'Male', '', '', '7894561320', 'dfklj@hjsdf.sdf', 'dfkljggdfkj', 'ldfgjkd', 'Single', 'Nigerian', '', 'Edo', 'sdfdsj', 'Christian', '', 'English', '', '', '', '', '', 'dsfdhkj', '', 'sjdgfk', '7894561320', 'dfkjghdjkghdfkj', 'OPEN', '2020-03-06 15:21:21'),
(9, 'xdgzdx', 'Tracking Number', '', '0000-00-00 00:00:00', '', 'Mr', 'Ade', 'Banjo', '1995-03-16 00:00:00', '', 'Male', '', '', '42145224724', 'dfsbghdfhdz@fgvdx.com', 'dsgdxszxetvyredydrx', 'fdzxtgdx', 'Single', 'Nigerian', '', 'FCT', 'dcsghx', 'Christian', '', 'English', '', '', '', '', '', 'dfhbxdtgd', '', 'dfhxdydsx', '42242242422', 'dfxbyfthfh', 'OPEN', '2020-03-06 16:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `patient_consult_rooms`
--

CREATE TABLE `patient_consult_rooms` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_consult_rooms`
--

INSERT INTO `patient_consult_rooms` (`id`, `patient_id`, `room_id`, `clinic_id`, `date`) VALUES
(1, 9, 6, 1, '2020-03-06 16:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `patient_subclinic`
--

CREATE TABLE `patient_subclinic` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `sub_clinic_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `clinic_number` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_subclinic`
--

INSERT INTO `patient_subclinic` (`id`, `patient_id`, `sub_clinic_id`, `clinic_id`, `clinic_number`, `date`) VALUES
(23, 1, 1, 1, 'GPD023', '2020-02-22 17:42:03'),
(24, 2, 1, 1, 'GPD024', '2020-02-23 19:29:27'),
(25, 3, 1, 1, 'GPD046', '2020-02-24 09:26:53'),
(26, 4, 1, 1, 'GPD092', '2020-02-24 09:30:15'),
(27, 5, 1, 1, 'GPD005', '2020-02-25 16:34:33'),
(28, 6, 1, 1, 'GPD105', '2020-02-26 15:24:47'),
(29, 7, 1, 1, 'y ggj', '2020-03-06 10:27:20'),
(30, 8, 1, 1, 'sdfdsf', '2020-03-06 15:21:21'),
(31, 9, 1, 1, 'dvgdxstgd', '2020-03-06 16:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_station`
--

CREATE TABLE `pharmacy_station` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy_station`
--

INSERT INTO `pharmacy_station` (`id`, `name`, `created`) VALUES
(1, 'Pharmacy Shop', '2020-02-21 17:01:08'),
(2, 'Phase II Dispensary', '2020-02-21 17:01:21'),
(3, 'NHIS Dispensary', '2020-02-21 17:01:33'),
(4, 'A &amp; E Dispensary', '2020-02-21 17:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `prescribed`
--

CREATE TABLE `prescribed` (
  `id` int(11) NOT NULL,
  `encounter_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `unit` int(11) NOT NULL,
  `cost_price` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `dosage` varchar(50) NOT NULL,
  `period` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescribed`
--

INSERT INTO `prescribed` (`id`, `encounter_id`, `bill_id`, `product_id`, `product_name`, `unit`, `cost_price`, `unit_price`, `total_price`, `dosage`, `period`, `dept`, `status`, `receipt`, `date`) VALUES
(1, 1, 0, 1, 'Paracetamol', 1, '', '20', '20', '', '', 'drug', 'REQUEST', '', '2019-12-02 12:57:31'),
(2, 1, 0, 2, 'Easidor', 1, '', '25', '25', '', '', 'drug', 'REQUEST', '', '2019-12-02 12:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `prescription_no` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `no_drugs` varchar(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pre_reg`
--

CREATE TABLE `pre_reg` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `bill_number` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `revenue` varchar(80) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `auth_code` varchar(50) NOT NULL,
  `officer` varchar(80) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `productType_id` int(11) NOT NULL,
  `cost_price` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `batch_no` varchar(50) NOT NULL,
  `man_date` datetime NOT NULL,
  `exp_date` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `barcode`, `category_id`, `productType_id`, `cost_price`, `price`, `quantity`, `total_quantity`, `description`, `batch_no`, `man_date`, `exp_date`, `created`) VALUES
(1, 'Acetazolamide 250mg', '8271286821', 0, 1, '0', '20', 0, 265, '', 'B10275', '2018-07-11 00:00:00', '2021-07-10 00:00:00', '2020-01-28 17:23:48'),
(2, 'Acyclovir 200mg', '9871567998', 0, 1, '0', '120', 0, 285, '', 'B10276', '2020-01-01 00:00:00', '2022-01-19 00:00:00', '2020-01-29 10:50:25'),
(3, 'Albendazole 200mg', '9874567921', 0, 1, '0', '70', 0, 250, '', 'B10277', '2019-04-10 00:00:00', '2021-04-09 00:00:00', '2020-01-29 10:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`id`, `name`, `created`) VALUES
(1, 'Tablets and Capsules', '2020-01-28 14:38:28'),
(2, 'Pessaries', '2020-01-28 14:38:49'),
(3, 'Injectables and Infusions', '2020-01-28 14:39:06'),
(4, 'Topicals', '2020-01-28 14:39:44'),
(5, 'Inhalers and Nebules', '2020-01-28 14:40:03'),
(6, 'Ophthalmics and Ear Drops', '2020-01-28 14:40:29'),
(7, 'Syrups and Suspensions', '2020-01-28 14:41:00'),
(8, 'Medical Consumables and Disposables', '2020-01-28 14:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_pharmacy_station`
--

CREATE TABLE `product_pharmacy_station` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pharmacy_station_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `body_part_id` varchar(200) NOT NULL,
  `body_part_symptom_id` varchar(255) DEFAULT NULL,
  `minimum_marks` varchar(200) DEFAULT NULL,
  `total_marks` varchar(200) DEFAULT NULL,
  `question` text NOT NULL,
  `options` longtext,
  `answer_label` longtext,
  `answer_value` longtext,
  `type` varchar(100) NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  `used_status` tinyint(2) DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `gender`, `body_part_id`, `body_part_symptom_id`, `minimum_marks`, `total_marks`, `question`, `options`, `answer_label`, `answer_value`, `type`, `status`, `used_status`, `created`) VALUES
(15, '', '', '', '2', '6', 'How strong is your headache?', '[\"Mild - 3\",\"Medium - 6\",\"Unbearable - 9\",\"Other - 3\"]', '[\"Mild \",\"Medium \",\"Unbearable\"]', '[\" 2\",\" 4\",\" 6\"]', 'radio', 1, 0, '2020-03-05 13:22:18'),
(16, '', '', '', '2', '9', 'How long have you been experiencing these headaches?', NULL, '[\"Less than 3 months\",\"More than 3 months\"]', '[\"2\",\"6\"]', 'radio', 1, 0, '2020-03-04 10:56:10'),
(17, '', '', '', '0', '4', 'Did your headache start suddenly and reach its peak in a couple of seconds or minutes?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 10:58:10'),
(18, '', '', '', '2', '9', 'How long do your headaches usually last?', NULL, '[\"Seconds to minutes\",\"From a few minutes to 4 hours\",\"From 4 hours to 3 days\",\"Over 3 days\"]', '[\"2\",\"3\",\"5\",\"7\"]', 'radio', 1, 0, '2020-03-04 11:00:09'),
(19, '', '', '', '3', '4', 'Where is your headache located?', NULL, '[\"All over\",\"On one side of my head\",\"Front of my head\",\"Back of my head\",\"In the temple area\"]', '[\"3\",\"3\",\"4\",\"3\",\"3\"]', 'radio', 1, 0, '2020-03-04 11:03:55'),
(20, '', '', '', '0', '4', 'Do you have a fever?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:04:54'),
(21, '', '', '', '4', '5', 'How would you describe your headache?', NULL, '[\"Throbbing or pulsating\",\"Stabbing or piercing\"]', '[\"4\",\"4\"]', 'radio', 1, 0, '2020-03-04 11:06:46'),
(22, '', '', '', '0', '3', 'Do you experience sleeping disturbances: sleep more or less than you used to, or you have trouble falling asleep or staying asleep?', NULL, '[\"yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:08:20'),
(23, '', '', '', '3', '4', 'How would you describe your chest pain?', '[\"Severe - 3\",\"Stabbing - 3\",\"Burning - 3\"]', '[\"Severe \",\"Stabbing \",\"Burning \"]', '[\" 4\",\" 3\",\" 4\"]', 'radio', 1, 0, '2020-03-05 13:25:10'),
(24, '', '', '', '2', '6', 'How long has your chest pain lasted?', NULL, '[\"Less than 30 minutes\",\"Between 30 minutes and 8 hours\",\"Over 8 hours\"]', '[\"2\",\"4\",\"6\"]', 'radio', 1, 0, '2020-03-04 11:25:21'),
(25, '', '', '', '3', '4', 'How would you describe localization and radiation of your chest pain?', NULL, '[\"All over\",\"Located behind breastbone\",\"Radiates between shoulder blades\",\"Radiates to neck\"]', '[\"3\",\"3\",\"4\",\"4\"]', 'radio', 1, 0, '2020-03-04 11:28:58'),
(26, '', '', '', '2', '14', 'What worsens your chest pain?', NULL, '[\"Stress\",\"Exercising or moving\",\"Breathing deeply or coughing\",\"Pressing on chest\",\"Lying down\"]', '[\"2\",\"3\",\"3\",\"3\",\"3\"]', 'checkbox', 1, 0, '2020-03-04 11:33:18'),
(27, '', '', '', '0', '6', 'Have you been diagnosed with asthma?', NULL, '[\"Yes\",\"No\"]', '[\"6\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:50:32'),
(28, '', '', '', '0', '4', 'Have you had recent contact with something you are allergic to such as food, chemicals, pollen, pets, etc.?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:51:17'),
(29, '', '', '', '0', '4', 'Have you been wheezing â€” making a continuous high-pitched whistling sound while breathing?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:52:36'),
(30, '', '', '', '0', '4', 'Have you had chest pain or discomfort like this before?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:53:27'),
(31, '', '', '', '0', '3', 'Do you have a cough?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:53:53'),
(32, '', '', '', '3', '7', 'How long have you had a cough?', NULL, '[\"Less than 3 weeks\",\"Between 3 and 8 weeks\",\"More than 8 weeks\"]', '[\"3\",\"5\",\"7\"]', 'radio', 1, 0, '2020-03-04 11:54:59'),
(33, '', '', '', '4', '6', 'How would you describe your cough?', NULL, '[\"Dry cough, without phlegm or mucus\",\"Wet cough, with phlegm or mucus\"]', '[\"6\",\"4\"]', 'radio', 1, 0, '2020-03-04 11:55:52'),
(34, '', '', '', '0', '4', 'Do you feel creaking of joint during movement', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 11:59:49'),
(35, '', '', '', '0', '4', 'Did your joint pain start suddenly?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 12:00:23'),
(36, '', '', '', '0', '3', 'Do you have a sore throat?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 12:01:04'),
(37, '', '', '', '0', '3', 'Do you have weakness in your legs or arms where you can\'t move them even if you try?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 12:01:46'),
(38, '', '', '', '0', '3', 'Are your muscles weaker than usual?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 12:02:14'),
(39, '', '', '', '0', '3', 'Did the muscle weakness start in the lower parts of your body and spread upwards towards your head?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 12:02:46'),
(40, '', '', '', '0', '4', 'Does your shoulder hurt when you try to move it?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 12:03:38'),
(41, '', '', '', '3', '4', 'Does the weakness involve mainly the muscles of the upper arms or thighs?', NULL, '[\"Thighs\",\"Arms\"]', '[\"3\",\"4\"]', 'radio', 1, 0, '2020-03-04 12:05:13'),
(42, '', '', '', '0', '4', 'Do you have neck pain?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 12:06:10'),
(43, '', '', '', '2', '13', 'Do you have any of the following symptoms?', NULL, '[\"Nasal voice\",\"Sneeze\",\"Impaired smell\",\"Facial pain\",\"Itchy throat or nose\",\"Swelling around the eyes\"]', '[\"2\",\"2\",\"2\",\"2\",\"2\",\"3\"]', 'checkbox', 1, 0, '2020-03-04 15:28:07'),
(44, '', '', '', '0', '5', 'Has your nose been congested for more than three months?', NULL, '[\"Yes\",\"No\"]', '[\"5\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:29:01'),
(45, '', '', '', '0', '4', 'Is your throat red?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:29:39'),
(46, '', '', '', '0', '5', 'Do you have pain or pressure in your sinuses, in the region next to your nose under the eyes or above your eyebrows?', NULL, '[\"Yes\",\"No\"]', '[\"5\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:30:14'),
(47, '', '', '', '0', '4', 'Do you have sneezing attacks?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:30:53'),
(48, '', '', '', '0', '4', 'Do you have pain when swallowing?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:31:58'),
(49, '', '', '', '0', '6', 'What is your body temperature?', NULL, '[\"Between 98.6 and 100.4 \\u00b0F or 37 and 38 \\u00b0C\",\"Between 100.4 and 104 \\u00b0F or 38 and 40 \\u00b0C\",\"Greater than 104 \\u00b0F or 40 \\u00b0C\",\"I haven\\u2019t checked the temperature\"]', '[\"2\",\"4\",\"6\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:33:57'),
(50, '', '', '', '0', '4', 'Do you have Increased abdominal size', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:41:34'),
(51, '', '', '', '0', '5', 'Do you have Diarrhea or Sickness or both?', NULL, '[\"Diarrhea\",\"Sickness\",\"Both\",\"Nothing\"]', '[\"3\",\"3\",\"5\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:43:49'),
(52, '', '', '', '0', '6', 'Do you have stomach pain after eating or painful bowel movements or both', NULL, '[\"stomach pain after eating\",\"painful bowel movements\",\"Both\",\"Nothing\"]', '[\"3\",\"4\",\"6\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:45:20'),
(53, '', '', '', '2', '6', 'How strong is your abdominal pain?', NULL, '[\"Mild\",\"Medium\",\"Unbearable\"]', '[\"2\",\"4\",\"6\"]', 'radio', 1, 0, '2020-03-04 15:46:33'),
(54, '', '', '', '3', '5', 'How long have you had diarrhea?', NULL, '[\"Less than 2 weeks\",\"More than 2 weeks\"]', '[\"3\",\"5\"]', 'radio', 1, 0, '2020-03-04 15:47:22'),
(55, '', '', '', '3', '4', 'Where is your abdominal pain located?', NULL, '[\"All over the abdomen\",\"In a part of the abdomen\"]', '[\"3\",\"4\"]', 'radio', 1, 0, '2020-03-04 15:48:15'),
(56, '', '', '', '3', '6', 'How long have you been experiencing abdominal pain?', NULL, '[\"Less than 2 days\",\"2 to 7 days\",\"8 to 14 days\",\"Over 2 weeks\"]', '[\"3\",\"4\",\"5\",\"6\"]', 'radio', 1, 0, '2020-03-04 15:49:53'),
(57, '', '', '', '0', '4', 'Do your symptoms occur shortly after you eat or drink dairy products like milk, ice cream, or cheese?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:50:32'),
(58, '', '', '', '0', '3', 'Has your appendix been removed?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:51:01'),
(59, '', '', '', '0', '6', 'Do you have Deformed joint or Creaking of joint during movement or both', NULL, '[\"Deformed joint\",\"Creaking of joint during movement\",\"Both\",\"Nothing\"]', '[\"3\",\"4\",\"6\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:56:31'),
(60, '', '', '', '0', '4', 'Do you have newly deformed bones?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:57:16'),
(61, '', '', '', '0', '3', 'Does your knee hurt when you try to move it?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:58:26'),
(62, '', '', '', '0', '4', 'Have you recently lost the ability to stand on one or both of your feet as a result of an injury?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:59:07'),
(63, '', '', '', '0', '3', 'Do you have severe joint pain due to an injury?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 15:59:39'),
(64, '', '', '', '0', '5', 'Do you have Sudden joint pain or Joint swelling or both', NULL, '[\"Sudden joint pain\",\"Joint swelling\",\"Both\",\"Nothing\"]', '[\"2\",\"3\",\"5\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:02:33'),
(65, '', '', '', '0', '6', 'Do you have Deformed joint or Skin changes or both?', NULL, '[\"Deformed joint\",\"Skin changes\",\"Both\",\"Nothing\"]', '[\"4\",\"3\",\"6\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:03:50'),
(66, '', '', '', '0', '3', 'Is your shoulder swollen?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:04:26'),
(67, '', '', '', '0', '3', 'Does your shoulder hurt when you try to move it?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:04:52'),
(68, '', '', '', '0', '3', 'Do you have any joints that are hard to move?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:05:30'),
(69, '', '', '', '0', '3', 'Do you have joints that creak or crack when you move?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:06:24'),
(70, '', '', '', '0', '4', 'Do you have weakness in your legs or arms where you can\'t move them even if you try?', NULL, '[\"Yes\",\"No\"]', '[\"4\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:07:07'),
(71, '', '', '', '0', '3', 'Do you feel pain in both of your legs?', NULL, '[\"Yes\",\"No\"]', '[\"3\",\"0\"]', 'radio', 1, 0, '2020-03-04 16:08:23'),
(72, '', '', '', '0', '5', 'Do you Smoke?', '[\"Yes - 5\",\"No - 0\"]', '[\"Yes \",\"No \"]', '[\" 5\",\" 0\"]', 'radio', 1, 0, '2020-03-06 11:16:37'),
(73, '', '', '', '2', '6', 'How strong is your headache?', '[\"Mild - 2\",\"Medium - 4\",\"Unbearable - 6\"]', '[\"Mild \",\"Medium \",\"Unbearable \"]', '[\" 2\",\" 4\",\" 6\"]', 'radio', 1, 0, '2020-03-11 07:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `question_mapping`
--

CREATE TABLE `question_mapping` (
  `id` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `age_group_to` varchar(200) NOT NULL,
  `age_group_from` varchar(200) NOT NULL,
  `section_name` varchar(200) NOT NULL,
  `body_part_id` varchar(200) NOT NULL,
  `body_part_id_symptom_id` varchar(255) DEFAULT NULL,
  `question_id` longtext NOT NULL,
  `another_question` longtext,
  `question_map_id` longtext NOT NULL,
  `result_status` longtext NOT NULL,
  `result_status_value` longtext,
  `result_description` longtext NOT NULL,
  `result_precaution` longtext NOT NULL,
  `result_remedies` longtext NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_mapping`
--

INSERT INTO `question_mapping` (`id`, `gender`, `age_group_to`, `age_group_from`, `section_name`, `body_part_id`, `body_part_id_symptom_id`, `question_id`, `another_question`, `question_map_id`, `result_status`, `result_status_value`, `result_description`, `result_precaution`, `result_remedies`, `status`, `created`) VALUES
(8, 'male', '5', '45', 'Head', '[\"1\"]', '[\"2\",\"4\"]', '[\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Alarming Symptom - Stress Headache -> Self Treatment may be enough\",\"Alarming Symptom - Severe Headache -> See a Doctor within 24 hours\",\"Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department\"]', '[\"20\",\"30\",\"40\"]', '[\"Recommendation\\r\\nUsually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\",\"Recommendation\\r\\nSee a doctor within 24 hours\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\",\"Recommendation\\r\\nGo to the nearest emergency department\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\"]', '[\"The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"The lab test below are related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"There might be a lot of these but Doctor will be able to tell after few tests.\\r\\n\"]', '[\"Avoid stress & have proper bed rest.\",\"Get checked with your Doctor for these \\r\\nCluster headaches- Strong evidence\\r\\nMigraine- Strong evidence\",\"Get checked with your Doctor for these \\r\\nHemorrhagic stroke- Moderate evidence\\r\\nTemporal giant cell arteritis- Moderate evidence\\r\\nMigraine- Strong evidence\"]', 1, '2020-03-06 08:12:48'),
(9, 'male', '5', '45', 'Head', '[\"1\"]', '[\"2\",\"3\"]', '[\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Alarming Symptom - Stress Headache -> Self Treatment may be enough\",\"Alarming Symptom - Severe Headache -> See a Doctor within 24 hours\",\"Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department\"]', '[\"20\",\"30\",\"40\"]', '[\"Recommendation\\r\\nUsually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\",\"Recommendation\\r\\nSee a doctor within 24 hours\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\",\"Recommendation\\r\\nGo to the nearest emergency department\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\"]', '[\"The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"The lab test below are related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"There might be a lot of these but Doctor will be able to tell after few tests.\\r\\n\"]', '[\"Avoid stress & have proper bed rest.\",\"Get checked with your Doctor for these \\r\\nCluster headaches- Strong evidence\\r\\nMigraine- Strong evidence\",\"Get checked with your Doctor for these \\r\\nHemorrhagic stroke- Moderate evidence\\r\\nTemporal giant cell arteritis- Moderate evidence\\r\\nMigraine- Strong evidence\"]', 1, '2020-03-06 08:12:48'),
(10, 'male', '5', '45', 'Head', '[\"1\"]', '[\"2\",\"5\"]', '[\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Alarming Symptom - Stress Headache -> Self Treatment may be enough\",\"Alarming Symptom - Severe Headache -> See a Doctor within 24 hours\",\"Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department\"]', '[\"20\",\"30\",\"40\"]', '[\"Recommendation\\r\\nUsually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\",\"Recommendation\\r\\nSee a doctor within 24 hours\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\",\"Recommendation\\r\\nGo to the nearest emergency department\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\"]', '[\"The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"The lab test below are related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"There might be a lot of these but Doctor will be able to tell after few tests.\\r\\n\"]', '[\"Avoid stress & have proper bed rest.\",\"Get checked with your Doctor for these \\r\\nCluster headaches- Strong evidence\\r\\nMigraine- Strong evidence\",\"Get checked with your Doctor for these \\r\\nHemorrhagic stroke- Moderate evidence\\r\\nTemporal giant cell arteritis- Moderate evidence\\r\\nMigraine- Strong evidence\"]', 1, '2020-03-06 08:12:48'),
(11, 'male', '5', '45', 'Head', '[\"1\"]', '[\"2\",\"6\"]', '[\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Alarming Symptom - Stress Headache -> Self Treatment may be enough\",\"Alarming Symptom - Severe Headache -> See a Doctor within 24 hours\",\"Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department\"]', '[\"20\",\"30\",\"40\"]', '[\"Recommendation\\r\\nUsually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\",\"Recommendation\\r\\nSee a doctor within 24 hours\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\",\"Recommendation\\r\\nGo to the nearest emergency department\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\"]', '[\"The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"The lab test below are related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"There might be a lot of these but Doctor will be able to tell after few tests.\\r\\n\"]', '[\"Avoid stress & have proper bed rest.\",\"Get checked with your Doctor for these \\r\\nCluster headaches- Strong evidence\\r\\nMigraine- Strong evidence\",\"Get checked with your Doctor for these \\r\\nHemorrhagic stroke- Moderate evidence\\r\\nTemporal giant cell arteritis- Moderate evidence\\r\\nMigraine- Strong evidence\"]', 1, '2020-03-06 08:12:48'),
(12, 'male', '5', '45', 'Head', '[\"1\"]', '[\"2\"]', '[\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Alarming Symptom - Stress Headache -> Self Treatment may be enough\",\"Alarming Symptom - Severe Headache -> See a Doctor within 24 hours\",\"Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department\"]', '[\"20\",\"30\",\"40\"]', '[\"Recommendation\\r\\nUsually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\",\"Recommendation\\r\\nSee a doctor within 24 hours\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\",\"Recommendation\\r\\nGo to the nearest emergency department\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\"]', '[\"The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"The lab test below are related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"There might be a lot of these but Doctor will be able to tell after few tests.\\r\\n\"]', '[\"Avoid stress & have proper bed rest.\",\"Get checked with your Doctor for these \\r\\nCluster headaches- Strong evidence\\r\\nMigraine- Strong evidence\",\"Get checked with your Doctor for these \\r\\nHemorrhagic stroke- Moderate evidence\\r\\nTemporal giant cell arteritis- Moderate evidence\\r\\nMigraine- Strong evidence\"]', 1, '2020-03-06 08:12:48'),
(13, 'male', '5', '45', 'Head', '[\"1\"]', '[\"2\",\"3\",\"4\"]', '[\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Alarming Symptom - Stress Headache -> Self Treatment may be enough\",\"Alarming Symptom - Severe Headache -> See a Doctor within 24 hours\",\"Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department\"]', '[\"20\",\"30\",\"40\"]', '[\"Recommendation\\r\\nUsually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\",\"Recommendation\\r\\nSee a doctor within 24 hours\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\",\"Recommendation\\r\\nGo to the nearest emergency department\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\"]', '[\"The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"The lab test below are related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"There might be a lot of these but Doctor will be able to tell after few tests.\\r\\n\"]', '[\"Avoid stress & have proper bed rest.\",\"Get checked with your Doctor for these \\r\\nCluster headaches- Strong evidence\\r\\nMigraine- Strong evidence\",\"Get checked with your Doctor for these \\r\\nHemorrhagic stroke- Moderate evidence\\r\\nTemporal giant cell arteritis- Moderate evidence\\r\\nMigraine- Strong evidence\"]', 1, '2020-03-06 08:12:48'),
(14, 'male', '5', '45', 'Head', '[\"1\"]', '[\"2\",\"4\",\"5\"]', '[\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Alarming Symptom - Stress Headache -> Self Treatment may be enough\",\"Alarming Symptom - Severe Headache -> See a Doctor within 24 hours\",\"Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department\"]', '[\"20\",\"30\",\"40\"]', '[\"Recommendation\\r\\nUsually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\",\"Recommendation\\r\\nSee a doctor within 24 hours\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\",\"Recommendation\\r\\nGo to the nearest emergency department\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\"]', '[\"The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"The lab test below are related to your symptoms. However, they are recommended due to your risk profile\\r\\n1. Morphology and urinalysis\\r\\n2. Total cholesterol\",\"There might be a lot of these but Doctor will be able to tell after few tests.\\r\\n\"]', '[\"Avoid stress & have proper bed rest.\",\"Get checked with your Doctor for these \\r\\nCluster headaches- Strong evidence\\r\\nMigraine- Strong evidence\",\"Get checked with your Doctor for these \\r\\nHemorrhagic stroke- Moderate evidence\\r\\nTemporal giant cell arteritis- Moderate evidence\\r\\nMigraine- Strong evidence\"]', 1, '2020-03-06 08:12:48'),
(15, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(16, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"8\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(17, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"9\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(18, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"8\",\"9\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(19, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"10\",\"9\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53');
INSERT INTO `question_mapping` (`id`, `gender`, `age_group_to`, `age_group_from`, `section_name`, `body_part_id`, `body_part_id_symptom_id`, `question_id`, `another_question`, `question_map_id`, `result_status`, `result_status_value`, `result_description`, `result_precaution`, `result_remedies`, `status`, `created`) VALUES
(20, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"10\",\"8\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(21, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"10\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(22, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"11\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(23, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"10\",\"11\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(24, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"7\",\"8\",\"9\",\"10\",\"11\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(25, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"26\",\"24\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(26, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"26\",\"25\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(27, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"25\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(28, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"24\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(29, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"24\",\"25\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(30, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"26\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(31, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"27\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(32, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"27\",\"28\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50');
INSERT INTO `question_mapping` (`id`, `gender`, `age_group_to`, `age_group_from`, `section_name`, `body_part_id`, `body_part_id_symptom_id`, `question_id`, `another_question`, `question_map_id`, `result_status`, `result_status_value`, `result_description`, `result_precaution`, `result_remedies`, `status`, `created`) VALUES
(33, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"28\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(34, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"28\",\"26\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(35, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"24\",\"27\",\"28\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(36, 'male', '5', '50', 'Nose', '[\"5\"]', '[\"24\",\"25\",\"26\",\"27\",\"28\"]', '[\"43\",\"44\",\"20\",\"45\",\"46\",\"47\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\"]', '[\"Self-treatment may be enough\",\"See a doctor within 24 hours\"]', '[\"13\",\"35\"]', '[\"Usually, your symptoms don\\u2019t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis- > Strong evidence\",\"Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nCommon cold->Strong evidence\\r\\n\\r\\nAcute sinusitis-> Strong evidence\\r\\n\\r\\nPneumonia-> Strong evidence\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Rheumatology blood tests panel\"]', '[\"\\r\\nPreventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Total cholesterol\\r\\n\\r\\nLab tests\\r\\nRecommended\\r\\nLab tests recommended in further diagnostic process.\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n\\r\\n+ Inflammation panel\\r\\n\\r\\n+ Abdominal ailments panel\"]', '[\"Proper Rest\",\"Proper Rest\"]', 1, '2020-03-06 13:17:50'),
(37, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"8\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(38, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"10\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(39, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"9\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(40, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"11\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(41, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"11\",\"9\",\"10\"]', '[\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53'),
(42, 'male', '5', '45', 'Chest', '[\"2\"]', '[\"11\",\"9\",\"10\",\"8\"]', '[\"24\",\"23\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', '[]', '[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"33\"]', '[\"Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours\",\"Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours\",\"Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance\"]', '[\"20\",\"35\",\"55\"]', '[\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are worrisome and you may require urgent care. If you can\\u2019t get to an emergency department, please call an ambulance.\\r\\n\\r\\nAsthma\\r\\nStrong evidence\\r\\n\\r\\nCostochondritis\\r\\nModerate evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\\r\\n\\r\\nPneumonia\\r\\nModerate evidence\\r\\n\\r\\nAcute bronchitis\\r\\nModerate evidence\\r\\n\\r\\nThoracic aortic dissection\\r\\nWeak evidence\",\"Results\\r\\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\\r\\nYour symptoms are very serious, and you may require emergency care.\\r\\n\\r\\nHeart attack\\r\\nStrong evidence\\r\\n\\r\\nUnstable angina pectoris\\r\\nStrong evidence\\r\\n\\r\\nIntercostal neuralgia\\r\\nModerate evidence\"]', '[\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Lipid profile\\r\\n\",\"Preventive\\r\\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\\r\\n\\r\\n+ Morphology and urinalysis\\r\\n+ Lipid profile\"]', '[\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\",\"Medications\\r\\nDrugs used to treat some of the most common causes of chest pain include:\\r\\n\\r\\nArtery relaxers. Nitroglycerin \\u2014 usually taken as a tablet under the tongue \\u2014 relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\\r\\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\\r\\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\\r\\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\\r\\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\\r\\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.\"]', 1, '2020-03-06 11:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `radio_service`
--

CREATE TABLE `radio_service` (
  `id` int(11) NOT NULL,
  `sync` varchar(20) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `scan_request_id` int(11) NOT NULL,
  `ward_clinic` varchar(100) NOT NULL,
  `services` text NOT NULL,
  `unit` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radio_service`
--

INSERT INTO `radio_service` (`id`, `sync`, `bill_id`, `scan_request_id`, `ward_clinic`, `services`, `unit`, `status`, `date`) VALUES
(1, 'off', 0, 2, 'ACCIDENT & EMERGENCY', '[\"Ankle\",\"Arm\"]', '2', 'CLEARED', '2020-02-27 17:16:32'),
(2, 'off', 52, 3, 'GYNAE WARD', '[\"Ankle\",\"Arm\"]', '2', 'CLEARED', '2020-03-01 16:43:08'),
(3, 'off', 58, 4, 'GOPD', '[\"Pelvic Scan\",\"Transvaginal\"]', '2', 'billed', '2020-03-01 17:10:41'),
(4, 'off', 0, 5, 'ACCIDENT & EMERGENCY', '[\"Pelvic Scan\",\"Ankle\"]', '2', 'CLEARED', '2020-03-02 09:16:48'),
(5, 'off', 60, 6, 'ACCIDENT & EMERGENCY', '[\"Arm\"]', '1', 'billed', '2020-03-02 09:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `current_sub_clinic_id` int(11) NOT NULL,
  `referred_sub_clinic_id` int(11) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `referral_note` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `sync`, `bill_id`, `patient_id`, `waiting_list_id`, `current_sub_clinic_id`, `referred_sub_clinic_id`, `consultant`, `referral_note`, `status`, `date`) VALUES
(1, 'off', 0, 2, 2, 1, 3, 'Tom James', 'please this take this patient in', 'OPEN', '2020-02-24 09:35:01'),
(2, 'off', 0, 5, 5, 1, 3, 'admin user', 'dxmfdsjgfd;g', 'OPEN', '2020-02-25 16:38:56'),
(3, 'off', 0, 6, 8, 1, 3, 'Tom James', 'klsdlfk;l;', 'OPEN', '2020-02-26 15:37:27'),
(4, 'off', 0, 4, 9, 1, 10, 'Tom James', 'djhdfbksjdfhbskdjfkjsdfjkdskds', 'OPEN', '2020-02-27 08:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `refer_admission`
--

CREATE TABLE `refer_admission` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `in_patient_id` varchar(255) NOT NULL,
  `settle_status` varchar(255) NOT NULL,
  `discount_status` tinyint(2) DEFAULT '0',
  `refer_status` tinyint(255) DEFAULT '0',
  `Consultantdr` varchar(50) NOT NULL,
  `nurse_id` varchar(200) NOT NULL,
  `discharge_doct` tinyint(2) DEFAULT '0',
  `discharge_nurse` tinyint(2) DEFAULT '0',
  `cancel_status` tinyint(2) DEFAULT '0',
  `adm_date` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `ward_no` varchar(50) NOT NULL,
  `room_no` varchar(30) NOT NULL,
  `bed_no` varchar(50) NOT NULL,
  `m_s` varchar(80) NOT NULL,
  `adm_purpose` datetime NOT NULL,
  `ipd_service` varchar(255) NOT NULL,
  `payment_type` varchar(30) NOT NULL,
  `add_wall_balance` varchar(30) NOT NULL,
  `wall_balance` varchar(30) NOT NULL,
  `remark` text NOT NULL,
  `remark_nurse` text NOT NULL,
  `pat_category` varchar(100) NOT NULL,
  `discharge_date` date NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer_admission`
--

INSERT INTO `refer_admission` (`id`, `patient_id`, `in_patient_id`, `settle_status`, `discount_status`, `refer_status`, `Consultantdr`, `nurse_id`, `discharge_doct`, `discharge_nurse`, `cancel_status`, `adm_date`, `location`, `ward_no`, `room_no`, `bed_no`, `m_s`, `adm_purpose`, `ipd_service`, `payment_type`, `add_wall_balance`, `wall_balance`, `remark`, `remark_nurse`, `pat_category`, `discharge_date`, `created`) VALUES
(1, '1', '001', 'REFUND', 0, 1, '2', '26', 1, 1, 0, '2020-02-22', '2', '2', '2', '2', 'Non-Surgical', '0000-00-00 00:00:00', '[\"1\",\"2\"]', 'Cash', '0', '0', 'This patient needs to be admitted urgently', 'Patient has been admitted', 'General', '2020-02-27', '2020-02-23 12:10:10'),
(2, '3', '002', 'SETTLE', 0, 1, '2', '27', 1, 1, 0, '2020-02-24', '3', '3', '3', '4', 'Non-Surgical', '0000-00-00 00:00:00', '[\"1\",\"2\"]', 'Cash', '0', '0', 'Take him now', 'Taken', 'General', '2020-03-02', '2020-02-24 10:55:19'),
(3, '4', '003', 'SETTLE', 0, 1, '2', '27', 1, 1, 0, '2020-02-24 ', '3', '3', '3', '8', 'Non-Surgical', '0000-00-00 00:00:00', '[\"1\",\"2\"]', 'Cash', '', '0', 'usdjfkgsldgdf', 'admit', 'General', '2020-02-27', '2020-02-24 04:47:01'),
(4, '6', '004', '', 0, 0, '2', '25', 0, 0, 0, '2020-02-28 00:02:00', '1', '1', '1', '2', 'Non-Surgical', '0000-00-00 00:00:00', '[\"1\",\"2\"]', 'Cash', '', '6400', 'This is doctor\'s remark', 'This patient has been taken in', 'General', '0000-00-00', '2020-03-05 07:44:19'),
(5, '7', '005', '', 0, 0, '2', '26', 0, 0, 0, '2020-03-06 ', '2', '2', '2', '1', 'Surgical', '0000-00-00 00:00:00', '[\"1\"]', 'Cash', '0', '5000', 'Please Admit', 'Admitted.', 'General', '0000-00-00', '2020-03-06 02:51:31'),
(6, '8', '006', '', 0, 0, '2', '25', 0, 0, 0, '1970-01-01 ', '1', '1', '1', '1', 'Non-Surgical', '0000-00-00 00:00:00', '[\"1\"]', 'Cash', '', '6000', 'admit ', 'sef', 'VIP', '0000-00-00', '2020-03-11 06:05:16'),
(7, '4', '007', '', 0, 0, '1', '0', 0, 0, 0, '03/02/2020 ', '2', '2', '-- No Room Found --', '', '', '0000-00-00 00:00:00', 'null', 'Cash', '', '', 'sf dsfd sf', '', 'VIP', '0000-00-00', '2020-03-11 11:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `exempted_by` varchar(50) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `lab_no` varchar(50) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `test_request_id` int(11) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `clinic` varchar(50) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `test` text NOT NULL,
  `specimen` text NOT NULL,
  `date_col` datetime NOT NULL,
  `date_rec` datetime NOT NULL,
  `time_col` time NOT NULL,
  `time_rec` time NOT NULL,
  `sample_col_by` varchar(50) NOT NULL,
  `sample_rec_by` varchar(50) NOT NULL,
  `doctor_note` text NOT NULL,
  `scientist_note` text NOT NULL,
  `path_note` text NOT NULL,
  `dept` varchar(50) NOT NULL,
  `resultData` text NOT NULL,
  `scientist` varchar(50) NOT NULL,
  `pathologist` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `revenueheads`
--

CREATE TABLE `revenueheads` (
  `id` int(11) NOT NULL,
  `revenue_code` varchar(50) NOT NULL,
  `revenue_name` varchar(80) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `revenueheads`
--

INSERT INTO `revenueheads` (`id`, `revenue_code`, `revenue_name`, `created_by`, `date_created`, `date_modified`) VALUES
(1, '', 'Pharmacy', '', '2019-04-16 13:04:15', '2019-04-16 13:04:15'),
(2, '', 'Laboratory', '', '2019-04-16 13:04:32', '2019-04-16 13:04:32'),
(3, '', 'Radiology', '', '2019-04-16 13:04:39', '2019-04-16 13:04:39'),
(4, '', 'Ultrasound', '', '2019-04-16 13:04:51', '2019-04-16 13:04:51'),
(5, '', 'Medical Records', '', '2019-10-28 13:38:17', '2019-10-28 13:38:17'),
(6, '', 'Admission', '', '2020-01-10 15:13:02', '2020-01-10 15:13:02'),
(7, '', '', '', '2020-01-16 10:20:07', '2020-01-16 10:20:07'),
(8, '', '', '', '2020-01-16 10:21:39', '2020-01-16 10:21:39'),
(9, '', '', '', '2020-01-16 10:22:19', '2020-01-16 10:22:19'),
(10, '', '', '', '2020-01-16 10:22:25', '2020-01-16 10:22:25'),
(11, '', '', '', '2020-01-16 10:23:03', '2020-01-16 10:23:03'),
(12, '', '', '', '2020-01-17 10:58:12', '2020-01-17 10:58:12'),
(13, '', '', '', '2020-01-17 10:58:59', '2020-01-17 10:58:59'),
(14, '', '', '', '2020-01-17 12:16:58', '2020-01-17 12:16:58'),
(15, '', '', '', '2020-01-17 12:17:18', '2020-01-17 12:17:18'),
(16, '', '', '', '2020-01-17 12:18:34', '2020-01-17 12:18:34'),
(17, '', '', '', '2020-01-23 08:22:08', '2020-01-23 08:22:08'),
(18, '', '', '', '2020-01-23 08:22:32', '2020-01-23 08:22:32'),
(19, '', '', '', '2020-01-23 08:23:09', '2020-01-23 08:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_no` varchar(50) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `clinic_id`, `date`) VALUES
(1, 'MOP001', 2, '2019-11-27 18:39:11'),
(2, 'MOP002', 2, '2019-11-27 18:39:27'),
(3, 'MOP003', 2, '2019-11-27 18:39:38'),
(4, 'MOP004', 2, '2019-11-27 18:39:48'),
(5, 'MOP005', 2, '2019-11-27 18:40:05'),
(6, 'GOP001', 1, '2019-11-28 09:46:02'),
(7, 'GOP002', 1, '2019-11-28 09:46:19'),
(8, 'SOP001', 3, '2020-01-08 07:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `scanresult`
--

CREATE TABLE `scanresult` (
  `id` int(11) NOT NULL,
  `exempted_by` varchar(50) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `xray_no` varchar(50) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `scan_request_id` int(11) NOT NULL,
  `ward` varchar(80) NOT NULL,
  `clinic` varchar(80) NOT NULL,
  `doctor` varchar(80) NOT NULL,
  `consultant` varchar(80) NOT NULL,
  `scan` text NOT NULL,
  `date_ex` datetime NOT NULL,
  `time_ex` time NOT NULL,
  `doctor_note` text NOT NULL,
  `radiologist_note` text NOT NULL,
  `resultData` text NOT NULL,
  `clinical` text NOT NULL,
  `diagnosis` text NOT NULL,
  `radiology` varchar(50) NOT NULL,
  `ultrasound` varchar(50) NOT NULL,
  `radiologist` varchar(80) NOT NULL,
  `dept` varchar(80) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scan_request`
--

CREATE TABLE `scan_request` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `scan_no` int(11) NOT NULL,
  `not_done` int(11) NOT NULL,
  `doc_com` text NOT NULL,
  `scan_com` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scan_request`
--

INSERT INTO `scan_request` (`id`, `sync`, `waiting_list_id`, `ward_id`, `patient_id`, `bill_id`, `consultant`, `scan_no`, `not_done`, `doc_com`, `scan_com`, `status`, `receipt`, `date`) VALUES
(1, '', 10, 0, 5, 0, 'Tom James', 2, 2, '', '', 'awaiting_costing', '', '2020-02-27 16:23:09'),
(2, '', 3, 3, 3, 0, 'Tom James', 2, 0, '', '', 'billed', '', '2020-02-27 17:14:04'),
(3, '', 0, 1, 6, 52, 'Tom James', 2, 0, '', '', 'PAID', '099876', '2020-02-28 17:33:31'),
(4, '', 12, 0, 2, 58, 'Tom James', 2, 0, '', '', 'billed', '', '2020-03-01 17:03:02'),
(5, '', 0, 3, 3, 0, 'Tom James', 2, 0, '', '', 'billed', '', '2020-03-02 09:16:21'),
(6, '', 0, 3, 3, 60, 'Tom James', 1, 0, '', '', 'billed', '', '2020-03-02 09:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `settlement`
--

CREATE TABLE `settlement` (
  `id` int(11) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `patient_id` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `status` tinyint(2) DEFAULT '0',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settlement`
--

INSERT INTO `settlement` (`id`, `amount`, `patient_id`, `type`, `status`, `date_created`) VALUES
(1, '', '4', 'SETTLE', 1, '2020-02-24 16:54:52'),
(2, '-2000', '4', 'SETTLE', 1, '2020-02-27 08:42:10'),
(3, '7200', '1', 'REFUND', 1, '2020-02-27 10:55:27'),
(4, '-38220', '3', 'SETTLE', 1, '2020-03-02 09:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id` int(11) NOT NULL,
  `dispenser` varchar(50) NOT NULL,
  `reliever` varchar(50) NOT NULL,
  `pharm_id` int(11) NOT NULL,
  `pharm` varchar(80) NOT NULL,
  `no_of_drug` varchar(50) NOT NULL,
  `time_dis` time NOT NULL,
  `time_relieved` time NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_clinic`
--

CREATE TABLE `sub_clinic` (
  `id` int(11) NOT NULL,
  `clinic_id` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_clinic`
--

INSERT INTO `sub_clinic` (`id`, `clinic_id`, `name`, `date`) VALUES
(1, '1', 'GOPD', '2019-11-15 12:31:13'),
(2, '2', 'GASTRO-INTESTINAL TRACT', '2019-11-15 12:35:58'),
(3, '2', 'CARDIO', '2019-11-15 12:36:18'),
(4, '2', 'ENDOCRINOLOGY', '2019-11-15 12:36:48'),
(5, '2', 'PSYCHIATRICS', '2019-11-15 12:37:12'),
(6, '2', 'RESPIRATORY/CHEST', '2019-11-15 12:37:41'),
(7, '2', 'NEUROLOGY', '2019-11-15 12:39:30'),
(8, '2', 'RENAL/NEPHRO', '2019-11-15 12:39:51'),
(9, '3', 'UROLOGY', '2019-11-15 12:40:52'),
(10, '3', 'SOP', '2019-11-15 12:41:18'),
(11, '3', 'CARDIOTHORAXIC', '2019-11-15 12:41:53'),
(12, '3', 'PLASTIC SURGERY', '2019-11-15 12:43:06'),
(13, '3', 'ONCOLOGY', '2019-11-15 12:43:25'),
(14, '4', 'DERMATOLOGY', '2019-11-15 12:44:16'),
(15, '5', 'GYNAE ONCOLOGY', '2019-11-15 12:44:32'),
(16, '6', 'HAEMATOLOGY', '2019-11-15 12:44:41'),
(17, '7', 'FAMILY PLANNING', '2019-11-15 12:44:49'),
(18, '8', 'STAFF CLINIC', '2019-11-15 12:45:04'),
(19, '9', 'ENDOSCOPY', '2019-11-15 12:45:15'),
(20, '10', 'DENTAL', '2019-11-15 12:45:27'),
(21, '11', 'VIROLOGY', '2019-11-15 12:46:01'),
(22, '12', 'ENT', '2019-11-15 12:46:30'),
(23, '13', 'OPHTHALMOLOGY', '2019-11-15 12:46:41'),
(24, '14', 'PAEDIATRICS', '2019-11-15 12:46:52'),
(25, '15', 'ORTHOPAEDICS', '2019-11-15 12:47:04'),
(26, '16', 'PHYSIOTHERAPY', '2019-11-15 12:47:18'),
(27, '17', 'PAEDIATRICS SURGICAL', '2019-11-15 12:48:55'),
(28, '18', 'ANTENATAL &amp; POS-NATAL', '2019-11-15 12:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `symptom`
--

CREATE TABLE `symptom` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `body_part_id` varchar(200) NOT NULL,
  `body_part_name` varchar(200) NOT NULL,
  `status` tinyint(2) DEFAULT '0',
  `used_status` tinyint(2) DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptom`
--

INSERT INTO `symptom` (`id`, `name`, `body_part_id`, `body_part_name`, `status`, `used_status`, `created`) VALUES
(2, 'Headache', '1', 'Head', 1, 0, '2020-02-07 09:42:19'),
(3, 'Facial pain', '1', 'Head', 1, 0, '2020-02-07 09:42:32'),
(4, 'Fever', '1', 'Head', 1, 0, '2020-02-07 09:42:40'),
(5, 'Face swelling', '1', 'Head', 1, 0, '2020-02-07 09:42:50'),
(6, 'Facial muscle weakness', '1', 'Head', 1, 0, '2020-02-07 09:43:02'),
(7, 'Chest pain', '2', 'Chest', 1, 0, '2020-02-07 09:43:22'),
(8, 'Chest pain, radiating to left upper limb', '2', 'Chest', 1, 0, '2020-02-07 09:43:33'),
(9, 'Pressing chest pains', '2', 'Chest', 0, 0, '0000-00-00 00:00:00'),
(10, 'Heartburn', '2', 'Chest', 1, 0, '2020-02-07 09:43:48'),
(11, 'Palpitations', '2', 'Chest', 1, 0, '2020-02-07 09:44:06'),
(12, 'Sore throat', '3', 'Neck', 1, 0, '2020-02-07 09:44:27'),
(13, 'Painful swallowing', '3', 'Neck', 1, 0, '2020-02-07 09:44:37'),
(14, 'Difficulty swallowing', '3', 'Neck', 1, 0, '2020-02-07 09:44:47'),
(15, 'Red throat', '3', 'Neck', 1, 0, '2020-02-07 09:44:55'),
(16, 'Cough', '3', 'Neck', 1, 0, '2020-02-07 09:45:13'),
(24, 'Nose pain', '5', 'Nose', 1, 0, '2020-03-04 09:33:13'),
(25, 'Swollen nose', '5', 'Nose', 1, 0, '2020-03-04 09:33:25'),
(26, 'Runny nose', '5', 'Nose', 1, 0, '2020-03-04 09:33:49'),
(27, 'Stuffy nose', '5', 'Nose', 1, 0, '2020-03-04 09:33:56'),
(28, 'Itchy throat or nose', '5', 'Nose', 1, 0, '2020-03-04 09:34:15'),
(29, 'Stomach pain', '6', 'Stomach', 1, 0, '2020-03-04 09:35:33'),
(30, 'Burning or gnawing stomach pain', '6', 'Stomach', 1, 0, '2020-03-04 09:35:53'),
(31, 'Pain when pressing abdomen', '6', 'Stomach', 1, 0, '2020-03-04 09:36:10'),
(32, 'Bloating', '6', 'Stomach', 1, 0, '2020-03-04 09:36:20'),
(33, 'Constipation', '6', 'Stomach', 1, 0, '2020-03-04 09:36:28'),
(34, 'Diarrhea', '6', 'Stomach', 1, 0, '2020-03-04 09:36:36'),
(35, 'Vomiting', '6', 'Stomach', 1, 0, '2020-03-04 09:36:44'),
(36, 'Feeling sick', '6', 'Stomach', 1, 0, '2020-03-04 09:36:52'),
(37, 'Pain in upper limb', '7', 'Upper arm', 1, 0, '2020-03-04 09:38:36'),
(38, 'Shoulder pain', '7', 'Upper arm', 1, 0, '2020-03-04 09:38:48'),
(39, 'Shoulder pain while moving', '7', 'Upper arm', 1, 0, '2020-03-04 09:38:58'),
(40, 'Loss of feeling in both arms', '7', 'Upper arm', 1, 0, '2020-03-04 09:39:19'),
(41, 'Restricted range of joint motion', '7', 'Upper arm', 1, 0, '2020-03-04 09:39:40'),
(42, 'Knee pain', '8', 'Knee', 1, 0, '2020-03-04 09:41:34'),
(43, 'Knee pain while moving', '8', 'Knee', 1, 0, '2020-03-04 09:41:42'),
(44, 'Joint pain while touching', '8', 'Knee', 1, 0, '2020-03-04 09:41:53'),
(45, 'Stiff joints', '8', 'Knee', 1, 0, '2020-03-04 09:42:02'),
(46, 'Swollen knee', '8', 'Knee', 1, 0, '2020-03-04 09:42:12'),
(47, 'Knee injury', '8', 'Knee', 1, 0, '2020-03-04 09:42:22'),
(48, 'Forearm pain', '9', 'Forearm', 1, 0, '2020-03-04 10:23:57'),
(49, 'Elbow swelling', '9', 'Forearm', 1, 0, '2020-03-04 10:24:11'),
(50, 'Wrist pain', '9', 'Forearm', 1, 0, '2020-03-04 10:24:24'),
(51, 'Loss of feeling in both arms', '9', 'Forearm', 1, 0, '2020-03-04 10:24:42'),
(52, 'Wrist pain while moving', '9', 'Forearm', 1, 0, '2020-03-04 10:24:55'),
(59, '', '', '', 1, 0, '2020-03-11 07:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `symptom_answer`
--

CREATE TABLE `symptom_answer` (
  `id` int(11) NOT NULL,
  `question_id` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  `created` datetime NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `symptom_check_status` tinyint(2) DEFAULT '1',
  `gender` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptom_answer`
--

INSERT INTO `symptom_answer` (`id`, `question_id`, `answer`, `status`, `created`, `user_id`, `symptom_check_status`, `gender`) VALUES
(1, '15', '[\"6\"]', 1, '2020-03-05 11:29:23', '', 0, ''),
(2, '16', '[\"2\"]', 1, '2020-03-05 11:29:41', '', 0, ''),
(3, '17', '[\"4\"]', 1, '2020-03-05 11:29:45', '', 0, ''),
(4, '37', '[\"5\"]', 1, '2020-03-05 11:29:48', '', 0, ''),
(5, '19', '[\"5\"]', 1, '2020-03-05 11:29:54', '', 0, ''),
(6, '21', '[\"6\"]', 1, '2020-03-05 11:29:59', '', 0, ''),
(7, '22', '[\"5\"]', 1, '2020-03-05 11:30:02', '', 0, ''),
(8, '20', '[\"5\"]', 1, '2020-03-05 11:30:05', '', 0, ''),
(9, '15', '[\"6\"]', 1, '2020-03-05 11:36:03', '', 0, ''),
(10, '16', '[\"2\"]', 1, '2020-03-05 11:36:05', '', 0, ''),
(11, '17', '[\"4\"]', 1, '2020-03-05 11:36:08', '', 0, ''),
(12, '37', '[\"5\"]', 1, '2020-03-05 11:36:10', '', 0, ''),
(13, '19', '[\"5\"]', 1, '2020-03-05 11:36:12', '', 0, ''),
(14, '21', '[\"6\"]', 1, '2020-03-05 11:36:16', '', 0, ''),
(15, '22', '[\"5\"]', 1, '2020-03-05 11:36:19', '', 0, ''),
(16, '20', '[\"5\"]', 1, '2020-03-05 11:36:21', '', 0, ''),
(17, '15', '[\"6\"]', 1, '2020-03-05 11:44:58', '', 0, ''),
(18, '16', '[\"2\"]', 1, '2020-03-05 11:45:11', '', 0, ''),
(19, '17', '[\"4\"]', 1, '2020-03-05 11:45:14', '', 0, ''),
(20, '37', '[\"5\"]', 1, '2020-03-05 11:45:16', '', 0, ''),
(21, '19', '[\"5\"]', 1, '2020-03-05 11:45:19', '', 0, ''),
(22, '21', '[\"6\"]', 1, '2020-03-05 11:45:24', '', 0, ''),
(23, '22', '[\"5\"]', 1, '2020-03-05 11:45:27', '', 0, ''),
(24, '20', '[\"5\"]', 1, '2020-03-05 11:45:30', '', 0, ''),
(25, '15', '[\"6\"]', 1, '2020-03-05 11:46:33', '', 0, ''),
(26, '16', '[\"2\"]', 1, '2020-03-05 11:46:37', '', 0, ''),
(27, '17', '[\"4\"]', 1, '2020-03-05 11:46:39', '', 0, ''),
(28, '37', '[\"5\"]', 1, '2020-03-05 11:46:42', '', 0, ''),
(29, '19', '[\"5\"]', 1, '2020-03-05 11:46:46', '', 0, ''),
(30, '21', '[\"6\"]', 1, '2020-03-05 11:46:49', '', 0, ''),
(31, '22', '[\"5\"]', 1, '2020-03-05 11:46:52', '', 0, ''),
(32, '20', '[\"5\"]', 1, '2020-03-05 11:46:56', '', 0, ''),
(33, '15', '[\" 4\"]', 1, '2020-03-05 15:35:25', '', 0, ''),
(34, '17', '[\"4\"]', 1, '2020-03-05 15:35:31', '', 0, ''),
(35, '19', '[\"3\"]', 1, '2020-03-05 15:35:35', '', 0, ''),
(36, '22', '[\"3\"]', 1, '2020-03-05 15:35:41', '', 0, ''),
(37, '16', '[\"2\"]', 1, '2020-03-05 15:35:51', '', 0, ''),
(38, '15', '[\" 4\"]', 1, '2020-03-05 15:55:49', '', 0, ''),
(39, '17', '[\"4\"]', 1, '2020-03-05 15:55:51', '', 0, ''),
(40, '19', '[\"3\"]', 1, '2020-03-05 15:55:54', '', 0, ''),
(41, '22', '[\"3\"]', 1, '2020-03-05 15:55:56', '', 0, ''),
(42, '16', '[\"2\"]', 1, '2020-03-05 15:56:00', '', 0, ''),
(43, '15', '[\" 4\"]', 1, '2020-03-05 15:56:21', '', 0, ''),
(44, '17', '[\"4\"]', 1, '2020-03-05 15:56:25', '', 0, ''),
(45, '19', '[\"3\"]', 1, '2020-03-05 15:56:32', '', 0, ''),
(46, '22', '[\"3\"]', 1, '2020-03-05 15:56:36', '', 0, ''),
(47, '16', '[\"6\"]', 1, '2020-03-05 15:56:40', '', 0, ''),
(48, '15', '[\" 4\"]', 1, '2020-03-05 15:57:56', '', 0, ''),
(49, '17', '[\"4\"]', 1, '2020-03-05 15:57:59', '', 0, ''),
(50, '19', '[\"3\"]', 1, '2020-03-05 15:58:04', '', 0, ''),
(51, '22', '[\"0\"]', 1, '2020-03-05 15:58:08', '', 0, ''),
(52, '16', '[\"2\"]', 1, '2020-03-05 15:58:12', '', 0, ''),
(53, '15', '[\" 4\"]', 1, '2020-03-05 15:59:03', '', 0, ''),
(54, '15', '[\" 2\"]', 1, '2020-03-05 15:59:22', '', 0, ''),
(55, '15', '[\" 6\"]', 1, '2020-03-05 15:59:40', '', 0, ''),
(56, '15', '[\" 2\"]', 1, '2020-03-06 08:14:03', '', 0, ''),
(57, '16', '[\"2\"]', 1, '2020-03-06 08:14:06', '', 0, ''),
(58, '17', '[\"0\"]', 1, '2020-03-06 08:14:14', '', 0, ''),
(59, '18', '[\"2\"]', 1, '2020-03-06 08:14:17', '', 0, ''),
(60, '19', '[\"3\"]', 1, '2020-03-06 08:14:21', '', 0, ''),
(61, '20', '[\"4\"]', 1, '2020-03-06 08:14:24', '', 0, ''),
(62, '21', '[\"4\"]', 1, '2020-03-06 08:14:28', '', 0, ''),
(63, '22', '[\"3\"]', 1, '2020-03-06 08:14:33', '', 0, ''),
(64, '15', '[\" 2\"]', 1, '2020-03-06 08:15:01', '', 0, ''),
(65, '16', '[\"2\"]', 1, '2020-03-06 08:15:05', '', 0, ''),
(66, '17', '[\"0\"]', 1, '2020-03-06 08:15:07', '', 0, ''),
(67, '18', '[\"3\"]', 1, '2020-03-06 08:15:15', '', 0, ''),
(68, '19', '[\"3\"]', 1, '2020-03-06 08:15:22', '', 0, ''),
(69, '20', '[\"0\"]', 1, '2020-03-06 08:15:25', '', 0, ''),
(70, '21', '[\"4\"]', 1, '2020-03-06 08:15:28', '', 0, ''),
(71, '22', '[\"0\"]', 1, '2020-03-06 08:15:31', '', 0, ''),
(72, '15', '[\" 2\"]', 1, '2020-03-06 08:23:03', '', 0, ''),
(73, '16', '[\"6\"]', 1, '2020-03-06 08:23:08', '', 0, ''),
(74, '17', '[\"0\"]', 1, '2020-03-06 08:23:11', '', 0, ''),
(75, '18', '[\"7\"]', 1, '2020-03-06 08:23:14', '', 0, ''),
(76, '19', '[\"3\"]', 1, '2020-03-06 08:23:17', '', 0, ''),
(77, '20', '[\"4\"]', 1, '2020-03-06 08:23:20', '', 0, ''),
(78, '21', '[\"4\"]', 1, '2020-03-06 08:23:22', '', 0, ''),
(79, '22', '[\"0\"]', 1, '2020-03-06 08:23:33', '', 0, ''),
(80, '15', '[\" 2\"]', 1, '2020-03-06 10:50:14', '7', 0, 'male'),
(81, '16', '[\"2\"]', 1, '2020-03-06 10:50:17', '7', 0, 'male'),
(82, '17', '[\"4\"]', 1, '2020-03-06 10:50:20', '7', 0, 'male'),
(83, '18', '[\"2\"]', 1, '2020-03-06 10:50:24', '7', 0, 'male'),
(84, '19', '[\"3\"]', 1, '2020-03-06 10:50:27', '7', 0, 'male'),
(85, '20', '[\"4\"]', 1, '2020-03-06 10:50:31', '7', 0, 'male'),
(86, '21', '[\"4\"]', 1, '2020-03-06 10:50:34', '7', 0, 'male'),
(87, '22', '[\"3\"]', 1, '2020-03-06 10:50:38', '7', 0, 'male'),
(88, '15', '[\" 2\"]', 1, '2020-03-06 10:52:09', '6', 0, 'male'),
(89, '16', '[\"2\"]', 1, '2020-03-06 10:52:13', '6', 0, 'male'),
(90, '17', '[\"4\"]', 1, '2020-03-06 10:52:15', '6', 0, 'male'),
(91, '18', '[\"2\"]', 1, '2020-03-06 10:52:17', '6', 0, 'male'),
(92, '19', '[\"3\"]', 1, '2020-03-06 10:52:18', '6', 0, 'male'),
(93, '20', '[\"4\"]', 1, '2020-03-06 10:52:20', '6', 0, 'male'),
(94, '21', '[\"4\"]', 1, '2020-03-06 10:52:22', '6', 0, 'male'),
(95, '22', '[\"3\"]', 1, '2020-03-06 10:52:24', '6', 0, 'male'),
(96, '23', '[\" 4\"]', 1, '2020-03-06 12:05:44', '', 0, ''),
(97, '24', '[\"2\"]', 1, '2020-03-06 12:05:47', '', 0, ''),
(98, '25', '[\"3\"]', 1, '2020-03-06 12:05:50', '', 0, ''),
(99, '26', '[\"2\",\"3\",\"3\",\"3\",\"3\"]', 1, '2020-03-06 12:05:57', '', 0, ''),
(100, '27', '[\"6\"]', 1, '2020-03-06 12:06:00', '', 0, ''),
(101, '28', '[\"4\"]', 1, '2020-03-06 12:06:04', '', 0, ''),
(102, '29', '[\"4\"]', 1, '2020-03-06 12:06:08', '', 0, ''),
(103, '30', '[\"4\"]', 1, '2020-03-06 12:06:11', '', 0, ''),
(104, '31', '[\"3\"]', 1, '2020-03-06 12:06:14', '', 0, ''),
(105, '23', '[\" 4\"]', 1, '2020-03-06 12:07:21', '', 0, ''),
(106, '24', '[\"4\"]', 1, '2020-03-06 12:07:25', '', 0, ''),
(107, '25', '[\"3\"]', 1, '2020-03-06 12:07:31', '', 0, ''),
(108, '26', '[\"3\",\"3\"]', 1, '2020-03-06 12:07:38', '', 0, ''),
(109, '27', '[\"0\"]', 1, '2020-03-06 12:07:43', '', 0, ''),
(110, '28', '[\"4\"]', 1, '2020-03-06 12:07:46', '', 0, ''),
(111, '29', '[\"4\"]', 1, '2020-03-06 12:07:49', '', 0, ''),
(112, '30', '[\"0\"]', 1, '2020-03-06 12:07:51', '', 0, ''),
(113, '31', '[\"0\"]', 1, '2020-03-06 12:07:54', '', 0, ''),
(114, '23', '[\" 3\"]', 1, '2020-03-06 12:09:38', '', 0, ''),
(115, '24', '[\"4\"]', 1, '2020-03-06 12:09:41', '', 0, ''),
(116, '25', '[\"4\"]', 1, '2020-03-06 12:09:45', '', 0, ''),
(117, '26', '[\"2\",\"3\",\"3\",\"3\",\"3\"]', 1, '2020-03-06 12:09:51', '', 0, ''),
(118, '27', '[\"6\"]', 1, '2020-03-06 12:09:55', '', 0, ''),
(119, '28', '[\"4\"]', 1, '2020-03-06 12:09:58', '', 0, ''),
(120, '29', '[\"4\"]', 1, '2020-03-06 12:10:00', '', 0, ''),
(121, '30', '[\"4\"]', 1, '2020-03-06 12:10:03', '', 0, ''),
(122, '31', '[\"3\"]', 1, '2020-03-06 12:10:06', '', 0, ''),
(123, '23', '[\" 4\"]', 1, '2020-03-06 12:11:50', '', 0, ''),
(124, '24', '[\"2\"]', 1, '2020-03-06 12:11:53', '', 0, ''),
(125, '25', '[\"3\"]', 1, '2020-03-06 12:11:56', '', 0, ''),
(126, '26', '[\"2\"]', 1, '2020-03-06 12:11:59', '', 0, ''),
(127, '27', '[\"0\"]', 1, '2020-03-06 12:12:02', '', 0, ''),
(128, '28', '[\"0\"]', 1, '2020-03-06 12:12:04', '', 0, ''),
(129, '29', '[\"0\"]', 1, '2020-03-06 12:12:07', '', 0, ''),
(130, '30', '[\"0\"]', 1, '2020-03-06 12:12:10', '', 0, ''),
(131, '31', '[\"0\"]', 1, '2020-03-06 12:12:13', '', 0, ''),
(132, '15', '[\" 2\"]', 1, '2020-03-06 12:26:52', '6', 0, 'male'),
(133, '15', '[\" 2\"]', 1, '2020-03-06 12:46:49', '7', 0, 'male'),
(134, '16', '[\"2\"]', 1, '2020-03-06 12:46:51', '7', 0, 'male'),
(135, '17', '[\"4\"]', 1, '2020-03-06 12:46:53', '7', 0, 'male'),
(136, '18', '[\"2\"]', 1, '2020-03-06 12:46:57', '7', 0, 'male'),
(137, '19', '[\"3\"]', 1, '2020-03-06 12:46:59', '7', 0, 'male'),
(138, '20', '[\"4\"]', 1, '2020-03-06 12:47:22', '7', 0, 'male'),
(139, '21', '[\"4\"]', 1, '2020-03-06 12:47:27', '7', 0, 'male'),
(140, '22', '[\"3\"]', 1, '2020-03-06 12:47:30', '7', 0, 'male'),
(141, '15', '[\" 4\"]', 1, '2020-03-06 14:16:57', '6', 0, 'male'),
(142, '16', '[\"2\"]', 1, '2020-03-06 14:17:01', '6', 0, 'male'),
(143, '17', '[\"4\"]', 1, '2020-03-06 14:17:06', '6', 0, 'male'),
(144, '18', '[\"3\"]', 1, '2020-03-06 14:17:16', '6', 0, 'male'),
(145, '19', '[\"3\"]', 1, '2020-03-06 14:17:30', '6', 0, 'male'),
(146, '20', '[\"4\"]', 1, '2020-03-06 14:17:37', '6', 0, 'male'),
(147, '21', '[\"4\"]', 1, '2020-03-06 14:17:47', '6', 0, 'male'),
(148, '22', '[\"3\"]', 1, '2020-03-06 14:17:57', '6', 0, 'male'),
(149, '23', '[\" 3\"]', 1, '2020-03-06 14:26:05', '7', 0, 'male'),
(150, '24', '[\"4\"]', 1, '2020-03-06 14:26:10', '7', 0, 'male'),
(151, '25', '[\"3\"]', 1, '2020-03-06 14:26:15', '7', 0, 'male'),
(152, '26', '[\"2\",\"3\",\"3\",\"3\"]', 1, '2020-03-06 14:26:27', '7', 0, 'male'),
(153, '27', '[\"6\"]', 1, '2020-03-06 14:26:33', '7', 0, 'male'),
(154, '28', '[\"0\"]', 1, '2020-03-06 14:27:34', '7', 0, 'male'),
(155, '28', '[\"3\"]', 1, '2020-03-06 14:28:24', '7', 0, 'male'),
(156, '27', '[\"6\",\"2\",\"3\",\"3\"]', 1, '2020-03-06 14:28:30', '7', 0, 'male'),
(157, '27', '[\"6\"]', 1, '2020-03-06 14:28:36', '7', 0, 'male'),
(158, '28', '[\"4\"]', 1, '2020-03-06 14:28:42', '7', 0, 'male'),
(159, '23', '[\" 3\"]', 1, '2020-03-06 14:29:03', '7', 0, 'male'),
(160, '24', '[\"4\"]', 1, '2020-03-06 14:29:08', '7', 0, 'male'),
(161, '25', '[\"3\"]', 1, '2020-03-06 14:29:51', '7', 0, 'male'),
(162, '26', '[\"2\",\"3\",\"3\",\"3\"]', 1, '2020-03-06 14:29:57', '7', 0, 'male'),
(163, '27', '[\"6\"]', 1, '2020-03-06 14:30:00', '7', 0, 'male'),
(164, '28', '[\"4\"]', 1, '2020-03-06 14:30:04', '7', 0, 'male'),
(165, '29', '[\"4\"]', 1, '2020-03-06 14:30:11', '7', 0, 'male'),
(166, '30', '[\"4\"]', 1, '2020-03-06 14:30:16', '7', 0, 'male'),
(167, '31', '[\"3\"]', 1, '2020-03-06 14:30:19', '7', 0, 'male'),
(168, '15', '[\" 2\"]', 1, '2020-03-06 15:35:10', '8', 0, 'male'),
(169, '16', '[\"2\"]', 1, '2020-03-06 15:35:13', '8', 0, 'male'),
(170, '17', '[\"4\"]', 1, '2020-03-06 15:36:13', '8', 0, 'male'),
(171, '18', '[\"2\"]', 1, '2020-03-06 15:36:16', '8', 0, 'male'),
(172, '19', '[\"3\"]', 1, '2020-03-06 15:36:17', '8', 0, 'male'),
(173, '20', '[\"4\"]', 1, '2020-03-06 15:36:19', '8', 0, 'male'),
(174, '21', '[\"4\"]', 1, '2020-03-06 15:36:20', '8', 0, 'male'),
(175, '22', '[\"3\"]', 1, '2020-03-06 15:36:23', '8', 0, 'male'),
(176, '43', '[\"2\",\"2\",\"2\",\"2\",\"2\",\"3\"]', 1, '2020-03-06 16:03:52', '8', 0, 'male'),
(177, '44', '[\"5\"]', 1, '2020-03-06 16:03:56', '8', 0, 'male'),
(178, '20', '[\"4\"]', 1, '2020-03-06 16:03:59', '8', 0, 'male'),
(179, '45', '[\"4\"]', 1, '2020-03-06 16:04:03', '8', 0, 'male'),
(180, '46', '[\"5\"]', 1, '2020-03-06 16:04:09', '8', 0, 'male'),
(181, '47', '[\"4\"]', 1, '2020-03-06 16:04:12', '8', 0, 'male'),
(182, '43', '[\"2\",\"2\",\"2\",\"2\",\"2\"]', 1, '2020-03-06 16:16:55', '6', 0, 'male'),
(183, '44', '[\"5\"]', 1, '2020-03-06 16:16:57', '6', 0, 'male'),
(184, '20', '[\"4\"]', 1, '2020-03-06 16:16:59', '6', 0, 'male'),
(185, '45', '[\"4\"]', 1, '2020-03-06 16:17:01', '6', 0, 'male'),
(186, '46', '[\"5\"]', 1, '2020-03-06 16:17:03', '6', 0, 'male'),
(187, '47', '[\"4\"]', 1, '2020-03-06 16:17:05', '6', 0, 'male'),
(188, '23', '[\" 3\"]', 1, '2020-03-06 16:21:19', '9', 0, 'male'),
(189, '24', '[\"2\"]', 1, '2020-03-06 16:21:21', '9', 0, 'male'),
(190, '25', '[\"3\"]', 1, '2020-03-06 16:21:24', '9', 0, 'male'),
(191, '26', '[\"2\"]', 1, '2020-03-06 16:21:27', '9', 0, 'male'),
(192, '27', '[\"6\"]', 1, '2020-03-06 16:21:29', '9', 0, 'male'),
(193, '28', '[\"4\"]', 1, '2020-03-06 16:21:31', '9', 0, 'male'),
(194, '29', '[\"4\"]', 1, '2020-03-06 16:21:33', '9', 0, 'male'),
(195, '30', '[\"4\"]', 1, '2020-03-06 16:21:35', '9', 0, 'male'),
(196, '31', '[\"3\"]', 1, '2020-03-06 16:21:38', '9', 0, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `symptom_result`
--

CREATE TABLE `symptom_result` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `result_status_value` varchar(250) NOT NULL,
  `result_status` varchar(250) NOT NULL,
  `result_desc` text NOT NULL,
  `result_precau` text NOT NULL,
  `result_remedies` text NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptom_result`
--

INSERT INTO `symptom_result` (`id`, `user_id`, `result_status_value`, `result_status`, `result_desc`, `result_precau`, `result_remedies`, `status`, `created`) VALUES
(1, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(2, '', '', 'Alarming Symptom - Severe Headache -> See a doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(3, '', '', 'Alarming Symptom - Limb paralysis ->Go to the nearest emergency department', 'Recommendation\r\nGo to the nearest emergency department\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.', 'There might be a lot of these but Doctor will be able to tell after few tests.\r\n', 'Get checked with your Doctor for these \r\nHemorrhagic stroke- Moderate evidence\r\nTemporal giant cell arteritis- Moderate evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(4, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(5, '', '', 'Alarming Symptom - Severe Headache -> See a doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(6, '', '', 'Alarming Symptom - Limb paralysis ->Go to the nearest emergency department', 'Recommendation\r\nGo to the nearest emergency department\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.', 'There might be a lot of these but Doctor will be able to tell after few tests.\r\n', 'Get checked with your Doctor for these \r\nHemorrhagic stroke- Moderate evidence\r\nTemporal giant cell arteritis- Moderate evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(7, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(8, '', '', 'Alarming Symptom - Severe Headache -> See a doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(9, '', '', 'Alarming Symptom - Limb paralysis ->Go to the nearest emergency department', 'Recommendation\r\nGo to the nearest emergency department\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.', 'There might be a lot of these but Doctor will be able to tell after few tests.\r\n', 'Get checked with your Doctor for these \r\nHemorrhagic stroke- Moderate evidence\r\nTemporal giant cell arteritis- Moderate evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(10, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(11, '', '', 'Alarming Symptom - Severe Headache -> See a doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(12, '', '', 'Alarming Symptom - Limb paralysis ->Go to the nearest emergency department', 'Recommendation\r\nGo to the nearest emergency department\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.', 'There might be a lot of these but Doctor will be able to tell after few tests.\r\n', 'Get checked with your Doctor for these \r\nHemorrhagic stroke- Moderate evidence\r\nTemporal giant cell arteritis- Moderate evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(13, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(14, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(15, '', '', 'Alarming Symptom - Severe Headache -> See a doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(16, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(17, '', '', 'Alarming Symptom - Severe Headache -> See a doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(18, '', '', 'Alarming Symptom - Stress Headache -> Self-treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-05 00:00:00'),
(19, '', '', 'Alarming Symptom - Severe Headache -> See a doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-05 00:00:00'),
(20, '', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(21, '', '', 'Alarming Symptom - Severe Headache -> See a Doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(22, '', '', 'Alarming Symptom - Limb Paralysis -> Go to the nearest emergency department', 'Recommendation\r\nGo to the nearest emergency department\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.', 'There might be a lot of these but Doctor will be able to tell after few tests.\r\n', 'Get checked with your Doctor for these \r\nHemorrhagic stroke- Moderate evidence\r\nTemporal giant cell arteritis- Moderate evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(23, '', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(24, '', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(25, '', '', 'Alarming Symptom - Severe Headache -> See a Doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(26, '7', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(27, '7', '', 'Alarming Symptom - Severe Headache -> See a Doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(28, '6', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(29, '6', '', 'Alarming Symptom - Severe Headache -> See a Doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(30, '', '', 'Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.\r\n\r\nAsthma\r\nStrong evidence\r\n\r\nCostochondritis\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(31, '', '', 'Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\r\n\r\nPneumonia\r\nModerate evidence\r\n\r\nAcute bronchitis\r\nModerate evidence\r\n\r\nThoracic aortic dissection\r\nWeak evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(32, '', '', 'Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.\r\n\r\nAsthma\r\nStrong evidence\r\n\r\nCostochondritis\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(33, '', '', 'Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\r\n\r\nPneumonia\r\nModerate evidence\r\n\r\nAcute bronchitis\r\nModerate evidence\r\n\r\nThoracic aortic dissection\r\nWeak evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(34, '', '', 'Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.\r\n\r\nAsthma\r\nStrong evidence\r\n\r\nCostochondritis\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(35, '', '', 'Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\r\n\r\nPneumonia\r\nModerate evidence\r\n\r\nAcute bronchitis\r\nModerate evidence\r\n\r\nThoracic aortic dissection\r\nWeak evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(36, '', '', 'Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are very serious, and you may require emergency care.\r\n\r\nHeart attack\r\nStrong evidence\r\n\r\nUnstable angina pectoris\r\nStrong evidence\r\n\r\nIntercostal neuralgia\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Morphology and urinalysis\r\n+ Lipid profile', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(37, '', '', 'Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.\r\n\r\nAsthma\r\nStrong evidence\r\n\r\nCostochondritis\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(38, '7', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(39, '7', '', 'Alarming Symptom - Severe Headache -> See a Doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(40, '6', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(41, '6', '', 'Alarming Symptom - Severe Headache -> See a Doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(42, '7', '', 'Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.\r\n\r\nAsthma\r\nStrong evidence\r\n\r\nCostochondritis\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(43, '7', '', 'Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\r\n\r\nPneumonia\r\nModerate evidence\r\n\r\nAcute bronchitis\r\nModerate evidence\r\n\r\nThoracic aortic dissection\r\nWeak evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(44, '7', '', 'Alarming symptoms Chest pain, radiating to left upper limb Severe chest pain Pressing chest pain -> Call an ambulance', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are very serious, and you may require emergency care.\r\n\r\nHeart attack\r\nStrong evidence\r\n\r\nUnstable angina pectoris\r\nStrong evidence\r\n\r\nIntercostal neuralgia\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Morphology and urinalysis\r\n+ Lipid profile', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(45, '8', '', 'Alarming Symptom - Stress Headache -> Self Treatment may be enough', 'Recommendation\r\nUsually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.', 'The lab test below are not related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol1. Morphology and urinalysis\r\n2. Total cholesterol', 'Avoid stress & have proper bed rest.', 1, '2020-03-06 00:00:00'),
(46, '8', '', 'Alarming Symptom - Severe Headache -> See a Doctor within 24 hours', 'Recommendation\r\nSee a doctor within 24 hours\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.', 'The lab test below are related to your symptoms. However, they are recommended due to your risk profile\r\n1. Morphology and urinalysis\r\n2. Total cholesterol', 'Get checked with your Doctor for these \r\nCluster headaches- Strong evidence\r\nMigraine- Strong evidence', 1, '2020-03-06 00:00:00'),
(47, '8', '', 'Self-treatment may be enough', 'Usually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nCommon cold->Strong evidence\r\n\r\nAcute sinusitis- > Strong evidence', '\r\nPreventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Total cholesterol\r\n\r\nLab tests\r\nRecommended\r\nLab tests recommended in further diagnostic process.\r\n\r\n+ Morphology and urinalysis\r\n\r\n+ Inflammation panel\r\n\r\n+ Abdominal ailments panel', 'Proper Rest', 1, '2020-03-06 00:00:00'),
(48, '8', '', 'See a doctor within 24 hours', 'Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\r\n\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nCommon cold->Strong evidence\r\n\r\nAcute sinusitis-> Strong evidence\r\n\r\nPneumonia-> Strong evidence\r\n\r\nLab tests\r\nRecommended\r\nLab tests recommended in further diagnostic process.\r\n\r\n+ Morphology and urinalysis\r\n\r\n+ Inflammation panel\r\n\r\n+ Rheumatology blood tests panel', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Total cholesterol\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Total cholesterol\r\n\r\nLab tests\r\nRecommended\r\nLab tests recommended in further diagnostic process.\r\n\r\n+ Morphology and urinalysis\r\n\r\n+ Inflammation panel\r\n\r\n+ Abdominal ailments panel', 'Proper Rest', 1, '2020-03-06 00:00:00'),
(49, '6', '', 'Self-treatment may be enough', 'Usually, your symptoms donâ€™t require medical care and they may resolve on their own. You may try to manage your condition with home remedies. If your symptoms get worse or new symptoms appear, consult a doctor immediately.\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nCommon cold->Strong evidence\r\n\r\nAcute sinusitis- > Strong evidence', '\r\nPreventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Total cholesterol\r\n\r\nLab tests\r\nRecommended\r\nLab tests recommended in further diagnostic process.\r\n\r\n+ Morphology and urinalysis\r\n\r\n+ Inflammation panel\r\n\r\n+ Abdominal ailments panel', 'Proper Rest', 1, '2020-03-06 00:00:00'),
(50, '6', '', 'See a doctor within 24 hours', 'Your symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\r\n\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nCommon cold->Strong evidence\r\n\r\nAcute sinusitis-> Strong evidence\r\n\r\nPneumonia-> Strong evidence\r\n\r\nLab tests\r\nRecommended\r\nLab tests recommended in further diagnostic process.\r\n\r\n+ Morphology and urinalysis\r\n\r\n+ Inflammation panel\r\n\r\n+ Rheumatology blood tests panel', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Total cholesterol\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Total cholesterol\r\n\r\nLab tests\r\nRecommended\r\nLab tests recommended in further diagnostic process.\r\n\r\n+ Morphology and urinalysis\r\n\r\n+ Inflammation panel\r\n\r\n+ Abdominal ailments panel', 'Proper Rest', 1, '2020-03-06 00:00:00'),
(51, '9', '', 'Alarming Symptom - Pressing chest pain -> See a Doctor within 24 hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms are worrisome and you may require urgent care. If you canâ€™t get to an emergency department, please call an ambulance.\r\n\r\nAsthma\r\nStrong evidence\r\n\r\nCostochondritis\r\nModerate evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00'),
(52, '9', '', 'Alarming Symptom 1. Severe chest pain 2. Severe and sudden coughing attacks 3. Shortness of breath   -> See the Doctor within 12 Hours', 'Results\r\nPlease note that the list below may not be complete and is provided solely for informational purposes and is not a qualified medical opinion.\r\nYour symptoms may require prompt medical evaluation. If your symptoms suddenly get worse, go to the nearest emergency department.\r\n\r\nPneumonia\r\nModerate evidence\r\n\r\nAcute bronchitis\r\nModerate evidence\r\n\r\nThoracic aortic dissection\r\nWeak evidence', 'Preventive\r\nThe lab test below are not related to your symptoms. However, they are recommended due to your risk profile (e.g. age).\r\n\r\n+ Lipid profile\r\n', 'Medications\r\nDrugs used to treat some of the most common causes of chest pain include:\r\n\r\nArtery relaxers. Nitroglycerin â€” usually taken as a tablet under the tongue â€” relaxes heart arteries, so blood can flow more easily through the narrowed spaces. Some blood pressure medicines also relax and widen blood vessels.\r\nAspirin. If doctors suspect that your chest pain is related to your heart, you\'ll likely be given aspirin.\r\nThrombolytic drugs. If you are having a heart attack, you may receive these clot-busting drugs. These work to dissolve the clot that is blocking blood from reaching your heart muscle.\r\nBlood thinners. If you have a clot in an artery feeding your heart or lungs, you\'ll be given drugs that inhibit blood clotting to prevent the formation of more clots.\r\nAcid-suppressing medications. If your chest pain is caused by stomach acid splashing into your esophagus, the doctor may suggest medications that reduce the amount of acid in your stomach.\r\nAntidepressants. If you\'re experiencing panic attacks, your doctor may prescribe antidepressants to help control your symptoms. Psychological therapy, such as cognitive behavioral therapy, also might be recommended.', 1, '2020-03-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `revenue_code` varchar(50) NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `revenueHead_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `reference` varchar(80) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `revenue_code`, `unit_id`, `revenueHead_id`, `name`, `reference`, `price`, `quantity`, `created_by`, `date_created`, `date_modified`) VALUES
(1, '', '1', 2, 'PCV', '40 - 50%', 1000, 1, '', '2019-04-16 16:41:41', '2019-04-16 16:41:41'),
(2, '', '1', 2, 'Hb', '13.7-18.5', 800, 1, '', '2019-04-16 16:46:53', '2019-04-16 16:46:53'),
(3, '', '1', 2, 'Rbe Count', '4.5-6.5', 500, 1, '', '2019-04-16 16:48:19', '2019-04-16 16:48:19'),
(4, '', '1', 2, 'Retics', '0.2-2%', 700, 1, '', '2019-04-16 16:49:08', '2019-04-16 16:49:08'),
(5, '', '1', 2, 'MCHC', '32-37g/dl', 1200, 0, '', '2019-04-29 09:11:06', '2019-04-29 09:11:06'),
(6, '', '1', 2, 'MCH', '27-32pg', 850, 0, '', '2019-04-29 09:12:47', '2019-04-29 09:12:47'),
(7, '', '1', 2, 'WBC', '4-11 x 10^9/L', 1000, 0, '', '2019-04-29 09:15:49', '2019-04-29 09:15:49'),
(8, '', '2', 2, 'LFT', 'NIL', 3000, 0, '', '2019-05-19 00:53:07', '2019-05-19 00:53:07'),
(9, '', '2', 2, 'Lipid Profile', 'NIL', 2500, 0, '', '2019-05-19 00:53:53', '2019-05-19 00:53:53'),
(10, '', '2', 2, 'CSF', 'NIL', 3500, 0, '', '2019-05-19 12:35:12', '2019-05-19 12:35:12'),
(11, '', '3', 2, 'MP', 'NIL', 500, 0, '', '2019-05-19 12:35:50', '2019-05-19 12:35:50'),
(12, '', '3', 2, 'Widal', 'NIL', 500, 0, '', '2019-05-19 12:36:12', '2019-05-19 12:36:12'),
(13, '', '3', 2, 'Urinalysis', 'NIL', 1000, 0, '', '2019-05-19 12:36:35', '2019-05-19 12:36:35'),
(14, '', '3', 2, 'Urine mcs', 'NIL', 2500, 0, '', '2019-05-19 12:37:14', '2019-05-19 12:37:14'),
(15, '', '4', 3, 'Ankle', 'NIL', 4000, 0, '', '2019-05-21 15:17:21', '2019-05-21 15:17:21'),
(16, '', '4', 3, 'Arm', 'NIL', 4000, 0, '', '2019-05-21 16:02:38', '2019-05-21 16:02:38'),
(17, '', '4', 3, 'Lumbo-sacral', 'NIL', 7000, 0, '', '2019-05-21 16:03:41', '2019-05-21 16:03:41'),
(18, '', '4', 3, 'Pelvimetry', 'NIL', 5500, 0, '', '2019-05-21 16:04:27', '2019-05-21 16:04:27'),
(19, '', '5', 4, 'Pelvic Scan', 'NIL', 1500, 0, '', '2019-05-21 16:11:38', '2019-05-21 16:11:38'),
(20, '', '5', 4, 'Breast', 'NIL', 8000, 0, '', '2019-05-21 16:12:39', '2019-05-21 16:12:39'),
(21, '', '5', 4, 'Transvaginal', 'NIL', 2500, 0, '', '2019-05-21 16:14:27', '2019-05-21 16:14:27'),
(22, '', '1', 2, 'Genotype', 'NIL', 1000, 0, '', '2019-07-29 02:09:51', '2019-07-29 02:09:51'),
(23, '', '1', 2, 'Blood Group', 'NIL', 800, 0, '', '2019-07-29 02:11:01', '2019-07-29 02:11:01'),
(24, '', '2', 2, 'RBS', '3.6-7.8mmol/L', 1500, 0, '', '2019-07-29 02:12:16', '2019-07-29 02:12:16'),
(25, '', '2', 2, 'Sodium', '130-150mEq/L', 800, 0, '', '2019-07-29 02:13:31', '2019-07-29 02:13:31'),
(26, '', '2', 2, 'Acid Phosphate', 'U/L1', 2000, 0, '', '2019-07-29 02:14:22', '2019-07-29 02:14:22'),
(27, '', '2', 2, 'Protein', 'NIL', 1500, 0, '', '2019-07-29 02:14:58', '2019-07-29 02:14:58'),
(28, '', '3', 2, 'Albumin', 'NIL', 1000, 0, '', '2019-07-29 02:15:43', '2019-07-29 02:15:43'),
(29, '', '3', 2, 'Stool mcs', 'NIL', 1500, 0, '', '2019-07-29 02:16:29', '2019-07-29 02:16:29'),
(30, '', '2', 2, 'PSA', 'NIL', 2000, 0, '', '2019-10-28 16:14:22', '2019-10-28 16:14:22'),
(31, '', '6', 5, 'Folder', 'NIL', 800, 0, '', '2019-10-29 12:18:51', '2019-10-29 12:18:51'),
(32, '', '6', 5, 'Consultation', 'NIL', 800, 0, '', '2019-10-29 12:19:14', '2019-10-29 12:19:14'),
(34, '', '6', 5, 'Admission Deposit', 'NIL', 0, 0, '', '2020-01-10 15:15:22', '2020-01-10 15:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `testresult`
--

CREATE TABLE `testresult` (
  `id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `auth_code` int(11) NOT NULL,
  `pcv` varchar(50) NOT NULL,
  `mch` varchar(50) NOT NULL,
  `mchc` varchar(50) NOT NULL,
  `mcv` varchar(50) NOT NULL,
  `retics` varchar(50) NOT NULL,
  `retics_index` varchar(50) NOT NULL,
  `hb` varchar(50) NOT NULL,
  `wbc` varchar(50) NOT NULL,
  `platelet` varchar(50) NOT NULL,
  `hb_genotype` varchar(50) NOT NULL,
  `esr` varchar(50) NOT NULL,
  `finger_prick` varchar(50) NOT NULL,
  `clotted_blood` varchar(50) NOT NULL,
  `blood_cit` varchar(50) NOT NULL,
  `blood_seq` varchar(50) NOT NULL,
  `marrow` varchar(50) NOT NULL,
  `spec_others` varchar(50) NOT NULL,
  `exam_req` varchar(50) NOT NULL,
  `haem_com` varchar(50) NOT NULL,
  `film_app` varchar(50) NOT NULL,
  `ani` varchar(50) NOT NULL,
  `poikil` varchar(50) NOT NULL,
  `poly` varchar(50) NOT NULL,
  `macro` varchar(50) NOT NULL,
  `micro` varchar(50) NOT NULL,
  `hypo` varchar(50) NOT NULL,
  `sickle_cells` varchar(50) NOT NULL,
  `target_cells` varchar(50) NOT NULL,
  `spherocytes` varchar(50) NOT NULL,
  `nucleated` varchar(50) NOT NULL,
  `inclusion` varchar(50) NOT NULL,
  `film_others` varchar(50) NOT NULL,
  `blast` varchar(50) NOT NULL,
  `others` varchar(50) NOT NULL,
  `promyelocyre` varchar(50) NOT NULL,
  `myel` varchar(50) NOT NULL,
  `neutrophil` varchar(50) NOT NULL,
  `eosinophil` varchar(50) NOT NULL,
  `basophil` varchar(50) NOT NULL,
  `lymphocyte` varchar(50) NOT NULL,
  `monocyte` varchar(50) NOT NULL,
  `diff_others` varchar(50) NOT NULL,
  `pt` varchar(50) NOT NULL,
  `inr` varchar(50) NOT NULL,
  `ptt` varchar(50) NOT NULL,
  `pt_control` varchar(50) NOT NULL,
  `ptt_control` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `sodium` varchar(50) NOT NULL,
  `potassium` varchar(50) NOT NULL,
  `bicarbonate` varchar(50) NOT NULL,
  `chloride` varchar(50) NOT NULL,
  `calcium` varchar(50) NOT NULL,
  `magnessium` varchar(50) NOT NULL,
  `phosphorus` varchar(50) NOT NULL,
  `urea` varchar(50) NOT NULL,
  `creatinine` varchar(50) NOT NULL,
  `creatinine_clearance` varchar(50) NOT NULL,
  `uric_acid` varchar(50) NOT NULL,
  `fasting_glucose` varchar(50) NOT NULL,
  `hpp` varchar(50) NOT NULL,
  `random_glucose` varchar(50) NOT NULL,
  `ogtt` varchar(50) NOT NULL,
  `fasting` varchar(50) NOT NULL,
  `thirty_min` varchar(50) NOT NULL,
  `ninety_min` varchar(50) NOT NULL,
  `one_hour` varchar(50) NOT NULL,
  `two_hours` varchar(50) NOT NULL,
  `three_hours` varchar(50) NOT NULL,
  `hbA` varchar(50) NOT NULL,
  `total_protein` varchar(50) NOT NULL,
  `albumin` varchar(50) NOT NULL,
  `total_bilirubin` varchar(50) NOT NULL,
  `conj_bilirubin` varchar(50) NOT NULL,
  `ast` varchar(50) NOT NULL,
  `alt` varchar(50) NOT NULL,
  `alk_phosphate` varchar(50) NOT NULL,
  `urinary_protein` varchar(50) NOT NULL,
  `urinary_creatinine` varchar(50) NOT NULL,
  `urine_volume` varchar(50) NOT NULL,
  `albumin_ratio` varchar(50) NOT NULL,
  `gamma_gt` varchar(50) NOT NULL,
  `acid_phosphate` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `prostatic` varchar(50) NOT NULL,
  `ck_mb` varchar(50) NOT NULL,
  `ldh` varchar(50) NOT NULL,
  `amylase` varchar(50) NOT NULL,
  `cholinesterase` varchar(50) NOT NULL,
  `total_cholesterol` varchar(50) NOT NULL,
  `hdl_cholesterol` varchar(50) NOT NULL,
  `ldl_cholesterol` varchar(50) NOT NULL,
  `vldl_cholesterol` varchar(50) NOT NULL,
  `triglycerides` varchar(50) NOT NULL,
  `csf` varchar(50) NOT NULL,
  `csf_glucose` varchar(50) NOT NULL,
  `csf_protein` varchar(50) NOT NULL,
  `csf_chloride` varchar(50) NOT NULL,
  `urine` varchar(50) NOT NULL,
  `electrolytes` varchar(50) NOT NULL,
  `protein` varchar(50) NOT NULL,
  `macroscopy` varchar(50) NOT NULL,
  `blood` varchar(50) NOT NULL,
  `mucus` varchar(50) NOT NULL,
  `worms` varchar(50) NOT NULL,
  `pus_cells` varchar(50) NOT NULL,
  `red_blood_cells` varchar(50) NOT NULL,
  `starch_granules` varchar(50) NOT NULL,
  `occult_blood_comment` varchar(100) NOT NULL,
  `ova` varchar(50) NOT NULL,
  `cysts` varchar(50) NOT NULL,
  `plasmodium` varchar(50) NOT NULL,
  `trypanosomes` varchar(50) NOT NULL,
  `skin_snip` varchar(50) NOT NULL,
  `blood_film` varchar(50) NOT NULL,
  `microfilaria` varchar(50) NOT NULL,
  `tested_by` varchar(50) NOT NULL,
  `reviewed_by` varchar(50) NOT NULL,
  `para_density` varchar(50) NOT NULL,
  `species` varchar(50) NOT NULL,
  `stages` varchar(50) NOT NULL,
  `colour` varchar(50) NOT NULL,
  `ph` varchar(50) NOT NULL,
  `glucose` varchar(50) NOT NULL,
  `ketones` varchar(50) NOT NULL,
  `bilirubin` varchar(50) NOT NULL,
  `rbc` varchar(50) NOT NULL,
  `crystals` varchar(50) NOT NULL,
  `haematobium` varchar(50) NOT NULL,
  `yeast` varchar(50) NOT NULL,
  `appearance` varchar(50) NOT NULL,
  `sg` varchar(50) NOT NULL,
  `protein_para` varchar(50) NOT NULL,
  `urobilinogen` varchar(50) NOT NULL,
  `wbc_para` varchar(50) NOT NULL,
  `epith_cells` varchar(50) NOT NULL,
  `casts` varchar(50) NOT NULL,
  `bacteria` varchar(50) NOT NULL,
  `t_vaginals` varchar(50) NOT NULL,
  `blood_urine` varchar(50) NOT NULL,
  `nitrite` varchar(50) NOT NULL,
  `leucocyte` varchar(50) NOT NULL,
  `macroscopy_micro` varchar(180) NOT NULL,
  `colour_micro` varchar(180) NOT NULL,
  `albumin_micro` varchar(180) NOT NULL,
  `pus_cell` varchar(180) NOT NULL,
  `rbcs` varchar(50) NOT NULL,
  `epith_cell` varchar(50) NOT NULL,
  `yeast_cell` varchar(50) NOT NULL,
  `bacteria_micro` varchar(50) NOT NULL,
  `xtals` varchar(50) NOT NULL,
  `hyaline` varchar(50) NOT NULL,
  `granular` varchar(50) NOT NULL,
  `cellular` varchar(50) NOT NULL,
  `parasites` varchar(180) NOT NULL,
  `wbc_micro` varchar(50) NOT NULL,
  `polymorphs` varchar(50) NOT NULL,
  `lymphoetes` varchar(50) NOT NULL,
  `culture_isolates_1` varchar(180) NOT NULL,
  `culture_isolates_2` varchar(180) NOT NULL,
  `culture_isolates_3` varchar(180) NOT NULL,
  `culture_isolates_4` varchar(180) NOT NULL,
  `culture_isolates_5` varchar(180) NOT NULL,
  `amc` varchar(50) NOT NULL,
  `cro` varchar(50) NOT NULL,
  `caz` varchar(50) NOT NULL,
  `d` varchar(50) NOT NULL,
  `cpd` varchar(50) NOT NULL,
  `fep` varchar(50) NOT NULL,
  `mem` varchar(50) NOT NULL,
  `e` varchar(50) NOT NULL,
  `tzp` varchar(50) NOT NULL,
  `amp` varchar(50) NOT NULL,
  `le` varchar(50) NOT NULL,
  `cn` varchar(50) NOT NULL,
  `cxm` varchar(50) NOT NULL,
  `cot` varchar(50) NOT NULL,
  `nitro` varchar(50) NOT NULL,
  `cip` varchar(50) NOT NULL,
  `ofl` varchar(50) NOT NULL,
  `az` varchar(50) NOT NULL,
  `cl` varchar(50) NOT NULL,
  `do` varchar(50) NOT NULL,
  `amc2` varchar(50) NOT NULL,
  `cro2` varchar(50) NOT NULL,
  `caz2` varchar(50) NOT NULL,
  `d2` varchar(50) NOT NULL,
  `cpd2` varchar(50) NOT NULL,
  `fep2` varchar(50) NOT NULL,
  `mem2` varchar(50) NOT NULL,
  `e2` varchar(50) NOT NULL,
  `tzp2` varchar(50) NOT NULL,
  `amp2` varchar(50) NOT NULL,
  `le2` varchar(50) NOT NULL,
  `cn2` varchar(50) NOT NULL,
  `cxm2` varchar(50) NOT NULL,
  `cot2` varchar(50) NOT NULL,
  `nitro2` varchar(50) NOT NULL,
  `cip2` varchar(50) NOT NULL,
  `ofl2` varchar(50) NOT NULL,
  `az2` varchar(50) NOT NULL,
  `cl2` varchar(50) NOT NULL,
  `do2` varchar(50) NOT NULL,
  `amc3` varchar(50) NOT NULL,
  `cro3` varchar(50) NOT NULL,
  `caz3` varchar(50) NOT NULL,
  `d3` varchar(50) NOT NULL,
  `cpd3` varchar(50) NOT NULL,
  `fep3` varchar(50) NOT NULL,
  `mem3` varchar(50) NOT NULL,
  `e3` varchar(50) NOT NULL,
  `tzp3` varchar(50) NOT NULL,
  `amp3` varchar(50) NOT NULL,
  `le3` varchar(50) NOT NULL,
  `cn3` varchar(50) NOT NULL,
  `cxm3` varchar(50) NOT NULL,
  `cot3` varchar(50) NOT NULL,
  `nitro3` varchar(50) NOT NULL,
  `cip3` varchar(50) NOT NULL,
  `ofl3` varchar(50) NOT NULL,
  `az3` varchar(50) NOT NULL,
  `cl3` varchar(50) NOT NULL,
  `do3` varchar(50) NOT NULL,
  `amc4` varchar(50) NOT NULL,
  `cro4` varchar(50) NOT NULL,
  `caz4` varchar(50) NOT NULL,
  `d4` varchar(50) NOT NULL,
  `cpd4` varchar(50) NOT NULL,
  `fep4` varchar(50) NOT NULL,
  `mem4` varchar(50) NOT NULL,
  `e4` varchar(50) NOT NULL,
  `tzp4` varchar(50) NOT NULL,
  `amp4` varchar(50) NOT NULL,
  `le4` varchar(50) NOT NULL,
  `cn4` varchar(50) NOT NULL,
  `cxm4` varchar(50) NOT NULL,
  `cot4` varchar(50) NOT NULL,
  `nitro4` varchar(50) NOT NULL,
  `cip4` varchar(50) NOT NULL,
  `ofl4` varchar(50) NOT NULL,
  `az4` varchar(50) NOT NULL,
  `cl4` varchar(50) NOT NULL,
  `do4` varchar(50) NOT NULL,
  `amc5` varchar(50) NOT NULL,
  `cro5` varchar(50) NOT NULL,
  `caz5` varchar(50) NOT NULL,
  `d5` varchar(50) NOT NULL,
  `cpd5` varchar(50) NOT NULL,
  `fep5` varchar(50) NOT NULL,
  `mem5` varchar(50) NOT NULL,
  `e5` varchar(50) NOT NULL,
  `tzp5` varchar(50) NOT NULL,
  `amp5` varchar(50) NOT NULL,
  `le5` varchar(50) NOT NULL,
  `cn5` varchar(50) NOT NULL,
  `cxm5` varchar(50) NOT NULL,
  `cot5` varchar(50) NOT NULL,
  `nitro5` varchar(50) NOT NULL,
  `cip5` varchar(50) NOT NULL,
  `ofl5` varchar(50) NOT NULL,
  `az5` varchar(50) NOT NULL,
  `cl5` varchar(50) NOT NULL,
  `do5` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `samp_rec_by` varchar(50) DEFAULT NULL,
  `other_spec` varchar(50) DEFAULT NULL,
  `direct_gram` varchar(180) DEFAULT NULL,
  `days_of_ab` varchar(50) NOT NULL,
  `mode_of_prod` varchar(50) NOT NULL,
  `time_prod` time NOT NULL,
  `time_rec` time NOT NULL,
  `time_ex` time NOT NULL,
  `volume` varchar(50) NOT NULL,
  `semen_colour` varchar(50) NOT NULL,
  `viscosity` varchar(50) NOT NULL,
  `liq` varchar(50) NOT NULL,
  `ph_micro` varchar(50) NOT NULL,
  `motility` varchar(50) NOT NULL,
  `percent_motility` varchar(50) NOT NULL,
  `morphology` varchar(50) NOT NULL,
  `pus_gel` varchar(50) NOT NULL,
  `semen_epith_cell` varchar(50) NOT NULL,
  `rbc_micro` varchar(50) NOT NULL,
  `others_micro` varchar(50) NOT NULL,
  `sperm_conc` varchar(50) NOT NULL,
  `total_conc` varchar(50) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `sal_typh` varchar(50) NOT NULL,
  `sal_typh_a` varchar(50) NOT NULL,
  `sal_typh_b` varchar(50) NOT NULL,
  `sal_typh_c` varchar(50) NOT NULL,
  `widal_test` varchar(50) NOT NULL,
  `pregnancy_test` varchar(50) NOT NULL,
  `vdrl_test` varchar(50) NOT NULL,
  `mantoux_test` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `date_ex` datetime NOT NULL,
  `date_admin` datetime NOT NULL,
  `widal_kit_used` varchar(50) NOT NULL,
  `preg_kit_used` varchar(50) NOT NULL,
  `type_of_reagent` varchar(50) NOT NULL,
  `vdrl_kit_used` varchar(50) NOT NULL,
  `mantoux_kit_used` varchar(50) NOT NULL,
  `prog` varchar(50) NOT NULL,
  `non_prog` varchar(50) NOT NULL,
  `imm` varchar(50) NOT NULL,
  `igg` varchar(50) NOT NULL,
  `igm` varchar(50) NOT NULL,
  `salmo_d_o` varchar(50) NOT NULL,
  `salmo_d_h` varchar(50) NOT NULL,
  `salmo_a_o` varchar(50) NOT NULL,
  `salmo_a_h` varchar(50) NOT NULL,
  `salmo_b_o` varchar(50) NOT NULL,
  `salmo_b_h` varchar(180) NOT NULL,
  `salmo_c_o` varchar(50) NOT NULL,
  `salmo_c_h` varchar(50) NOT NULL,
  `org_first_param` varchar(50) NOT NULL,
  `org_second_param` varchar(50) NOT NULL,
  `org_third_param` varchar(50) NOT NULL,
  `org_first` varchar(50) NOT NULL,
  `org_second` varchar(50) NOT NULL,
  `org_third` varchar(50) NOT NULL,
  `org_first2` varchar(50) NOT NULL,
  `org_second2` varchar(50) NOT NULL,
  `org_third2` varchar(50) NOT NULL,
  `org_first3` varchar(50) NOT NULL,
  `org_second3` varchar(50) NOT NULL,
  `org_third3` varchar(50) NOT NULL,
  `org_first4` varchar(50) NOT NULL,
  `org_second4` varchar(50) NOT NULL,
  `org_third4` varchar(50) NOT NULL,
  `org_first5` varchar(50) NOT NULL,
  `org_second5` varchar(50) NOT NULL,
  `org_third5` varchar(50) NOT NULL,
  `notes` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_request`
--

CREATE TABLE `test_request` (
  `id` int(11) NOT NULL,
  `sync` varchar(50) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `test_no` int(11) NOT NULL,
  `not_done` int(11) NOT NULL,
  `doc_com` text NOT NULL,
  `lab_com` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `receipt` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_request`
--

INSERT INTO `test_request` (`id`, `sync`, `waiting_list_id`, `ward_id`, `bill_id`, `patient_id`, `consultant`, `test_no`, `not_done`, `doc_com`, `lab_com`, `status`, `receipt`, `date`) VALUES
(1, 'off', 10, 0, 0, 5, 'Tom James', 2, 2, '', '', 'awaiting_costing', '', '2020-02-27 16:23:02'),
(2, 'off', 3, 3, 47, 3, 'Tom James', 2, 0, '', '', 'PAID', '34235', '2020-02-27 17:13:57'),
(3, 'off', 0, 1, 0, 6, 'Tom James', 2, 0, '', '', 'billed', '', '2020-02-28 17:33:00'),
(4, 'off', 0, 1, 53, 6, 'Tom James', 1, 0, '', '', 'billed', '', '2020-03-01 16:26:22'),
(5, 'off', 12, 0, 57, 2, 'Tom James', 2, 0, '', '', 'billed', '', '2020-03-01 17:02:49'),
(6, 'off', 0, 3, 0, 3, 'Tom James', 3, 0, '', '', 'billed', '', '2020-03-02 09:14:54'),
(7, 'off', 0, 3, 59, 3, 'Tom James', 1, 0, '', '', 'billed', '', '2020-03-02 09:15:41'),
(8, 'off', 0, 1, 0, 6, 'admin user', 2, 2, 'fhf hdfh f', '', 'awaiting_costing', '', '2020-03-06 09:34:00'),
(9, 'off', 0, 1, 0, 6, 'Tom James', 2, 0, 'd,f.gjk gdghk', '', 'billed', '', '2020-03-06 10:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `revenueHead_id` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `revenueHead_id`, `name`, `date`) VALUES
(1, '2', 'Haematology', '2019-04-16 14:12:54'),
(2, '2', 'Chemical Pathology', '2019-04-16 14:13:30'),
(3, '2', 'Microbiology', '2019-04-16 14:13:49'),
(4, '3', 'Radiology', '2019-05-21 15:03:28'),
(5, '4', 'Ultrasound', '2019-05-21 15:03:40'),
(6, '5', 'Medical Records', '2019-10-29 12:17:52'),
(7, '5', 'Folder', '2019-11-15 10:44:32'),
(8, '5', 'Consultation', '2019-11-15 10:44:49'),
(9, '6', 'AdmDeposit', '2020-01-10 15:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profession` varchar(80) NOT NULL,
  `department` varchar(80) NOT NULL,
  `sub_clinic_id` int(11) NOT NULL,
  `ward_id` varchar(100) DEFAULT NULL,
  `ward_name` varchar(255) DEFAULT NULL,
  `role` varchar(80) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `profession`, `department`, `sub_clinic_id`, `ward_id`, `ward_name`, `role`, `date`) VALUES
(1, 'admin', 'user', 'admin', 'password1!', '', 'ICT', 0, NULL, NULL, 'Super Admin', '2019-06-25 19:50:37'),
(2, 'Tom', 'James', 'James', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-06-26 15:32:42'),
(3, 'Ayo', 'Brown', 'brown', '123456', 'Dispensary', 'Pharmacy', 0, NULL, NULL, 'User', '2019-06-26 15:44:19'),
(4, 'Emmanuel', 'Etim', 'Emmanuel', '123456', '', 'Laboratory', 0, NULL, NULL, 'User', '2019-06-26 15:45:20'),
(5, 'John', 'Smith', 'John', '123456', '', 'Radiology/Scan', 0, NULL, NULL, 'User', '2019-07-09 11:04:36'),
(6, 'Adams', 'Lennon', 'Adams', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-07-09 12:38:58'),
(7, 'Ken', 'Graig', 'Ken', '123456', '', 'Account', 0, NULL, NULL, 'User', '2019-07-09 12:40:47'),
(8, 'Paul', 'Fisher', 'Paul', '123456', '', 'ICT', 0, NULL, NULL, 'admin', '2019-07-10 12:24:00'),
(9, 'Segun', 'Oluwa', 'General', '123456', '', 'ICT', 0, NULL, NULL, 'User', '2019-07-11 14:52:33'),
(10, 'Gbenga', 'Bello', 'MrB', '123456', 'Storage', 'Pharmacy', 0, NULL, NULL, 'User', '2019-07-17 09:57:37'),
(11, 'Derick', 'Manuel', 'Dem', '123456', 'Dispensary', 'Pharmacy', 0, NULL, NULL, 'User', '2019-07-17 09:58:19'),
(12, 'Ayo', 'Balogun', 'ayo', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-05 07:43:32'),
(13, 'SO', 'AJAYI', 'ajayi', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-05 10:51:38'),
(14, 'OE', 'OLALUDE', 'olalude', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-05 10:52:15'),
(15, 'IDOWU', 'ADEWUMI', 'adewumi', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-05 10:53:12'),
(16, 'AJISAFE', 'DAMOLA', 'ajisafe', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-05 10:53:50'),
(17, 'M', 'ADELEKAN', 'adelekan', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-05 10:54:32'),
(18, 'Kemi', 'Ajisafe', 'kemi', '123456', '', 'Nursing', 26, '0', '', 'User', '2019-11-05 22:36:15'),
(19, 'Temidayo', 'Avwioro', 'temidayo', '123456', '', 'Nursing', 7, NULL, NULL, 'User', '2019-11-06 10:26:24'),
(21, 'John', 'Allison', 'allison', '123456', '', 'Nursing', 1, NULL, NULL, 'User', '2019-11-06 10:28:51'),
(22, 'Temitope', 'Olaolu', 'olaolu', '123456', '', 'Nursing', 11, NULL, NULL, 'User', '2019-11-06 10:30:00'),
(23, 'Oluwaseun', 'Oguntoye', 'oguntoye', '123456', '', 'Nursing', 7, NULL, NULL, 'User', '2019-11-06 10:31:03'),
(24, 'Bosede', 'Ogunode', 'ogunode', '123456', '', 'Nursing', 3, NULL, NULL, 'User', '2019-11-06 10:32:31'),
(25, 'Olawumi', 'Aduragbemi', 'aduragbemi', '123456', '', 'Nursing', 0, '1', 'A112W', 'User', '2019-11-06 10:34:00'),
(26, 'Seun', 'Omisore', 'omisore', '123456', '', 'Nursing', 0, '1', 'J11789', 'User', '2019-11-06 10:34:56'),
(27, 'AO', 'Abobarin', 'abobarin', '123456', '', 'Nursing', 0, '1', '', 'User', '2019-11-06 10:56:39'),
(28, 'Kayode', 'Faseyi', 'faseyi', '123456', '', 'Laboratory', 0, NULL, NULL, 'User', '2019-11-07 09:59:36'),
(29, 'Rafiu', 'Abdulkadir', 'abdulkadir', '123456', '', 'Laboratory', 0, NULL, NULL, 'User', '2019-11-07 10:01:09'),
(30, 'W', 'Lamidi', 'lamidi', '123456', '', 'Radiology/Scan', 0, NULL, NULL, 'User', '2019-11-07 10:56:52'),
(31, 'Rosline', 'Eschief', 'Eschief', '123456', '', 'Radiology/Scan', 0, NULL, NULL, 'User', '2019-11-07 11:00:11'),
(32, 'GI', 'Oladele', 'Oladele', '123456', '', 'Laboratory', 0, NULL, NULL, 'User', '2019-11-07 11:02:18'),
(33, 'OO', 'Sanyaolu', 'Sanyaolu', '123456', '', 'Laboratory', 0, NULL, NULL, 'User', '2019-11-07 11:03:16'),
(34, 'SK', 'Adeboye', 'Adeboye', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-07 11:04:35'),
(35, 'DE', 'Adediwura', 'Adediwura', '123456', '', 'Laboratory', 0, NULL, NULL, 'User', '2019-11-07 11:05:41'),
(36, 'AA', 'Adeshina', 'Adeshina', '123456', '', 'Medical Records', 0, NULL, NULL, 'User', '2019-11-07 11:06:30'),
(37, 'PHARM', 'Omilakin', 'Omilakin', '123456', '', 'Pharmacy', 0, NULL, NULL, 'User', '2019-11-08 11:04:01'),
(38, 'PHARM', 'Ibikunle', 'Ibikunle', '123456', '', 'Pharmacy', 0, NULL, NULL, 'User', '2019-11-08 11:04:34'),
(39, 'AA', 'Lanrewaju', 'Lanrewaju', '123456', '', 'Pharmacy', 0, NULL, NULL, 'User', '2019-11-08 11:05:03'),
(40, 'CT', 'Akosile', 'Akosile', '123456', '', 'Pharmacy', 0, NULL, NULL, 'User', '2019-11-08 11:05:53'),
(41, 'Amupitan', 'Adewale', 'adewale', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:30:54'),
(42, 'Omoyiola', 'Oludolapo', 'omoyiola', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:31:57'),
(43, 'Oyebimpe', 'Adeniyi', 'adeniyi', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:32:53'),
(44, 'Akinfademi', 'Damilola', 'damilola', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:33:42'),
(45, 'Owojuyigbe', 'TO', 'owojuyigbe', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:34:39'),
(46, 'Adefehinti', 'O', 'adefehinti', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:39:04'),
(47, 'Omoyiola', 'Oluwatosin', 'oluwatosin', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:40:31'),
(48, 'Akinde', 'Mobolade', 'akinde', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 10:41:18'),
(49, 'Soyoye', 'DO', 'soyoye', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 11:07:47'),
(50, 'Awowole', 'IO', 'awowole', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 11:08:42'),
(52, 'Adeniyi', 'OA', 'OA', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 11:10:39'),
(53, 'TOSIN', 'ALADE', 'alade', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 11:19:54'),
(54, 'SA', 'AMEYE', 'ameye', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 11:24:56'),
(55, 'SMITH', 'OLUFEMI', 'olufemi', '123456', '', 'Consultancy', 0, NULL, NULL, 'User', '2019-11-12 11:25:47'),
(56, 'Mohit', 'Sharma', 'Mohit', '123456', '', 'Nursing', 0, '1', '', 'User', '2020-01-23 10:50:11'),
(57, 'James', 'Bond', 'Bond', '123456', '', 'Nursing', 0, '1', '', 'User', '2020-01-23 11:39:42'),
(58, 'Lela', 'Lela', 'Lela', '123456', '', 'Nursing', 0, '1', '', 'User', '2020-01-23 11:41:54'),
(59, 'Pragya', 'D', 'Pragya', '123456', '', 'Nursing', 0, '1', '', 'User', '2020-01-23 11:46:25'),
(60, 'Doctor', 'D', 'Doctor', '123456', '', 'Consultancy', 0, '', '', 'User', '2020-01-23 11:48:47'),
(61, 'nursea', 'admin', 'nuradmin', '123456', '', 'Nursing', 0, '1', '', 'admin', '2020-02-03 11:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_multi_ward`
--

CREATE TABLE `user_multi_ward` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `ward_name` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_multi_ward`
--

INSERT INTO `user_multi_ward` (`id`, `user_id`, `ward_id`, `ward_name`, `date`) VALUES
(1, 26, 2, 'MALE SURGICAL WARD 1', '2020-02-22 23:31:00'),
(2, 27, 3, 'ACCIDENT &amp;amp; EMERGENCY', '2020-02-24 09:40:00'),
(3, 25, 1, 'GYNAE WARD', '2020-02-28 13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_clinic`
--

CREATE TABLE `user_sub_clinic` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_clinic_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_clinic`
--

INSERT INTO `user_sub_clinic` (`id`, `user_id`, `sub_clinic_id`, `clinic_id`, `date`) VALUES
(1, 2, 1, 1, '2019-11-30 16:08:46'),
(2, 41, 1, 1, '2019-12-02 10:29:33'),
(3, 2, 2, 2, '2019-12-02 10:29:44'),
(4, 2, 9, 3, '2020-01-06 07:41:40'),
(5, 2, 1, 1, '2020-01-07 12:52:40'),
(6, 42, 3, 2, '2020-01-07 13:02:45'),
(7, 41, 3, 2, '2020-01-07 16:35:00'),
(8, 43, 2, 2, '2020-01-08 07:49:22'),
(9, 43, 3, 2, '2020-01-08 07:49:35'),
(10, 43, 5, 2, '2020-01-08 07:49:52'),
(11, 2, 22, 12, '2020-01-17 06:37:37'),
(12, 2, 25, 15, '2020-01-17 06:37:49'),
(13, 60, 0, 1, '2020-01-23 11:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE `vitals` (
  `id` int(11) NOT NULL,
  `nurse` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `sub_clinic_id` int(11) NOT NULL,
  `waiting_list_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `temperature` varchar(50) NOT NULL,
  `pulse` varchar(50) NOT NULL,
  `resp_rate` varchar(50) NOT NULL,
  `pressure` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `pain` varchar(80) NOT NULL,
  `urinalysis` varchar(80) NOT NULL,
  `rbs` varchar(80) NOT NULL,
  `clinical_vitals` text NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vitals`
--

INSERT INTO `vitals` (`id`, `nurse`, `patient_id`, `sub_clinic_id`, `waiting_list_id`, `ward_id`, `temperature`, `pulse`, `resp_rate`, `pressure`, `weight`, `height`, `pain`, `urinalysis`, `rbs`, `clinical_vitals`, `comment`, `status`, `date`) VALUES
(1, 'John Allison', 2, 1, 2, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '+ve', '', '', 'vital very okay', 'waiting', '2020-02-23 19:32:15'),
(2, 'John Allison', 3, 1, 3, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '+ve', '', '', 'mdcsdc', 'waiting', '2020-02-24 09:27:46'),
(3, 'John Allison', 4, 1, 4, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '+ve', '', '', 'let go there', 'waiting', '2020-02-24 09:32:14'),
(4, 'John Allison', 5, 1, 5, 0, '36Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '+ve', '', '', 'asddsfddddddd', 'waiting', '2020-02-25 16:35:47'),
(5, 'John Allison', 5, 1, 6, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '', '', '', 'very nice', 'waiting', '2020-02-26 10:32:33'),
(6, 'John Allison', 6, 1, 8, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '', '', '', 'skjlasks', 'waiting', '2020-02-26 15:26:54'),
(7, 'John Allison', 4, 1, 9, 0, '36Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '+ve', '', '', 'dfsddfdfmllmsdflvlkk', 'waiting', '2020-02-27 08:57:17'),
(8, 'John Allison', 5, 1, 10, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '+ve', '', '', 'hjkkljhgghjjkkasdtryioo', 'waiting', '2020-02-27 16:16:07'),
(9, 'John Allison', 6, 1, 11, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '+ve', '', '', 'kdsfklfdgodfogopsdfjkdfs', 'waiting', '2020-02-28 13:21:46'),
(10, 'John Allison', 2, 1, 12, 0, '36.5Â°C', '75beat per minute', '', '120/90 mm Hg', '75kg', '6.2feets', 'no pain', '', '', '', 'sdfkslkfklkds', 'waiting', '2020-03-01 17:01:31'),
(11, 'John Allison', 7, 1, 13, 0, 'kjsdfgkq', 'djshb', '', 'kjsdh', 'jhdfkj', 'kjdsh', 'kjhdkjsh', 'kjhdgfkj', '', '', 'kjdsghdfkjghdfkj kjg hkj', 'waiting', '2020-03-06 10:28:09'),
(12, 'John Allison', 8, 1, 14, 0, 'vhdjsk', 'jhf', '', 'hjdgfhj', 'hjgfj', 'dhfj', 'jdhfkj', 'kjhdhj', '', '', 'kjdhfbgkjdhf gkjdfgkdf jgkd', 'waiting', '2020-03-06 15:22:04'),
(13, 'John Allison', 9, 1, 15, 0, 'hyhoi', 'joiuij', '', 'jb', 'hj', 'huj', 'hj', 'h', '', '', 'bh', 'waiting', '2020-03-06 16:20:11'),
(14, 'John Allison', 4, 1, 16, 0, 't54gtrb', 'bfgb', '', 'bgf', 'dbdgfb dfg', 'f bgfbfb', 'dfbf f gb', 'b gfgb', 'bg df', '', 'rtyryre', 'waiting', '2020-03-11 08:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_list`
--

CREATE TABLE `waiting_list` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `wait_status` tinyint(2) DEFAULT '0',
  `clinic_id` int(11) NOT NULL,
  `sub_clinic_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `officer` varchar(50) NOT NULL,
  `vitals` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waiting_list`
--

INSERT INTO `waiting_list` (`id`, `patient_id`, `wait_status`, `clinic_id`, `sub_clinic_id`, `room_id`, `officer`, `vitals`, `status`, `date`) VALUES
(1, 1, 1, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-22 17:42:03'),
(2, 2, 0, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-23 19:29:27'),
(3, 3, 1, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-24 09:26:53'),
(4, 4, 1, 1, 1, 7, 'admin user', 'CLEARED', 'consultation done', '2020-02-24 09:30:15'),
(5, 5, 0, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-25 16:34:34'),
(6, 5, 0, 1, 1, 6, 'John Allison', 'CLEARED', 'consultation done', '2020-02-26 10:30:32'),
(8, 6, 0, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-26 15:24:47'),
(9, 4, 0, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-27 08:56:04'),
(10, 5, 0, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-27 16:14:05'),
(11, 6, 1, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-02-28 13:20:43'),
(12, 2, 0, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-03-01 17:00:27'),
(13, 7, 1, 1, 1, 6, 'Tom James', 'CLEARED', 'consultation done', '2020-03-06 10:27:20'),
(14, 8, 1, 1, 1, 6, 'Tom James', 'CLEARED', 'consultation done', '2020-03-06 15:21:21'),
(15, 9, 0, 1, 1, 6, 'Tom James', 'CLEARED', 'consultant', '2020-03-06 16:19:31'),
(16, 4, 1, 1, 1, 6, 'admin user', 'CLEARED', 'consultation done', '2020-03-11 08:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `id` int(11) NOT NULL,
  `location_id` varchar(250) NOT NULL,
  `ward_number` varchar(250) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `ward_status` tinyint(2) DEFAULT '0',
  `ward_assign_status` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `location_id`, `ward_number`, `gender`, `ward_status`, `ward_assign_status`) VALUES
(1, '1', 'GYNAE WARD', 'female', 1, 0),
(2, '2', 'MALE SURGICAL WARD 1', 'male', 1, 0),
(3, '3', 'ACCIDENT & EMERGENCY', 'both', 0, 0),
(4, '4', 'OPTHALMOLOGY', 'male', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_history`
--
ALTER TABLE `account_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_list`
--
ALTER TABLE `bed_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_number` (`bill_number`);

--
-- Indexes for table `body_part`
--
ALTER TABLE `body_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancle_admission`
--
ALTER TABLE `cancle_admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `casenote`
--
ALTER TABLE `casenote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_notes_doctor`
--
ALTER TABLE `case_notes_doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_notes_nurse`
--
ALTER TABLE `case_notes_nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispensed`
--
ALTER TABLE `dispensed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispensehistory`
--
ALTER TABLE `dispensehistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_request`
--
ALTER TABLE `drug_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_service`
--
ALTER TABLE `drug_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eachdrug`
--
ALTER TABLE `eachdrug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eachscan`
--
ALTER TABLE `eachscan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eachtest`
--
ALTER TABLE `eachtest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encounter`
--
ALTER TABLE `encounter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollee`
--
ALTER TABLE `enrollee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollee_patient`
--
ALTER TABLE `enrollee_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollee_sub`
--
ALTER TABLE `enrollee_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investigations`
--
ALTER TABLE `investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipd_service`
--
ALTER TABLE `ipd_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipd_service_log`
--
ALTER TABLE `ipd_service_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_service`
--
ALTER TABLE `lab_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `folder_number` (`folder_number`);

--
-- Indexes for table `patient_consult_rooms`
--
ALTER TABLE `patient_consult_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_subclinic`
--
ALTER TABLE `patient_subclinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_station`
--
ALTER TABLE `pharmacy_station`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `prescribed`
--
ALTER TABLE `prescribed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_reg`
--
ALTER TABLE `pre_reg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_number` (`bill_number`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `product_pharmacy_station`
--
ALTER TABLE `product_pharmacy_station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_mapping`
--
ALTER TABLE `question_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radio_service`
--
ALTER TABLE `radio_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refer_admission`
--
ALTER TABLE `refer_admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenueheads`
--
ALTER TABLE `revenueheads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scanresult`
--
ALTER TABLE `scanresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scan_request`
--
ALTER TABLE `scan_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settlement`
--
ALTER TABLE `settlement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_clinic`
--
ALTER TABLE `sub_clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptom`
--
ALTER TABLE `symptom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptom_answer`
--
ALTER TABLE `symptom_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptom_result`
--
ALTER TABLE `symptom_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testresult`
--
ALTER TABLE `testresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_request`
--
ALTER TABLE `test_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_multi_ward`
--
ALTER TABLE `user_multi_ward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_clinic`
--
ALTER TABLE `user_sub_clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_history`
--
ALTER TABLE `account_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bed_list`
--
ALTER TABLE `bed_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `body_part`
--
ALTER TABLE `body_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `cancle_admission`
--
ALTER TABLE `cancle_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `casenote`
--
ALTER TABLE `casenote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `case_notes_doctor`
--
ALTER TABLE `case_notes_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `case_notes_nurse`
--
ALTER TABLE `case_notes_nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dispensed`
--
ALTER TABLE `dispensed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dispensehistory`
--
ALTER TABLE `dispensehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drug_request`
--
ALTER TABLE `drug_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `drug_service`
--
ALTER TABLE `drug_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `eachdrug`
--
ALTER TABLE `eachdrug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `eachscan`
--
ALTER TABLE `eachscan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `eachtest`
--
ALTER TABLE `eachtest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `encounter`
--
ALTER TABLE `encounter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `enrollee`
--
ALTER TABLE `enrollee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enrollee_patient`
--
ALTER TABLE `enrollee_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enrollee_sub`
--
ALTER TABLE `enrollee_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `investigations`
--
ALTER TABLE `investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ipd_service`
--
ALTER TABLE `ipd_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ipd_service_log`
--
ALTER TABLE `ipd_service_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_service`
--
ALTER TABLE `lab_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `patient_consult_rooms`
--
ALTER TABLE `patient_consult_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `patient_subclinic`
--
ALTER TABLE `patient_subclinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `pharmacy_station`
--
ALTER TABLE `pharmacy_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `prescribed`
--
ALTER TABLE `prescribed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_reg`
--
ALTER TABLE `pre_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_pharmacy_station`
--
ALTER TABLE `product_pharmacy_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `question_mapping`
--
ALTER TABLE `question_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `radio_service`
--
ALTER TABLE `radio_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `refer_admission`
--
ALTER TABLE `refer_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `revenueheads`
--
ALTER TABLE `revenueheads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `scanresult`
--
ALTER TABLE `scanresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scan_request`
--
ALTER TABLE `scan_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `settlement`
--
ALTER TABLE `settlement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_clinic`
--
ALTER TABLE `sub_clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `symptom`
--
ALTER TABLE `symptom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `symptom_answer`
--
ALTER TABLE `symptom_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `symptom_result`
--
ALTER TABLE `symptom_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `testresult`
--
ALTER TABLE `testresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test_request`
--
ALTER TABLE `test_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `user_multi_ward`
--
ALTER TABLE `user_multi_ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_sub_clinic`
--
ALTER TABLE `user_sub_clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `waiting_list`
--
ALTER TABLE `waiting_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
