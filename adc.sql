-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 09:19 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adc`
--

-- --------------------------------------------------------

--
-- Table structure for table `aadhar_details`
--

CREATE TABLE `aadhar_details` (
  `uid` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aadhar_details`
--

INSERT INTO `aadhar_details` (`uid`, `name`, `dob`, `gender`, `address`) VALUES
(123567831673, 'jhonny', '2018-03-24', 'male', 'yuwe,ewew,ewwe');

-- --------------------------------------------------------

--
-- Table structure for table `death_certificate`
--

CREATE TABLE `death_certificate` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `certificate_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE `doctor_details` (
  `id` int(11) NOT NULL,
  `license_no` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phn_no` bigint(20) NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `temp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_details`
--

INSERT INTO `doctor_details` (`id`, `license_no`, `name`, `phn_no`, `lat`, `lon`, `temp`) VALUES
(1, 123456, 'Hesen', 8190038383, 22.6941, 88.3785, 111.073);

-- --------------------------------------------------------

--
-- Table structure for table `driver_details`
--

CREATE TABLE `driver_details` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `license_no` varchar(20) NOT NULL,
  `van_type` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_details`
--

INSERT INTO `driver_details` (`id`, `username`, `password`, `name`, `uid`, `contact_no`, `license_no`, `van_type`, `latitude`, `longitude`) VALUES
(9, 'hesen', 'hai', 'hesen', 122121, 8190048383, 'eddewee', '', 13.0827, 80.2707);

-- --------------------------------------------------------

--
-- Table structure for table `forensic_doctor_details`
--

CREATE TABLE `forensic_doctor_details` (
  `id` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forensic_doctor_details`
--

INSERT INTO `forensic_doctor_details` (`id`, `password`, `name`) VALUES
(1601009, 'nivas', 'Hesen');

-- --------------------------------------------------------

--
-- Table structure for table `forensic_table`
--

CREATE TABLE `forensic_table` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forensic_table`
--

INSERT INTO `forensic_table` (`id`, `uid`, `name`) VALUES
(1, 123567831673, 'sample');

-- --------------------------------------------------------

--
-- Table structure for table `general_doctor_details`
--

CREATE TABLE `general_doctor_details` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_doctor_details`
--

INSERT INTO `general_doctor_details` (`id`, `name`, `password`) VALUES
(1601015, 'Aravind', 'aravind');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_claim`
--

CREATE TABLE `insurance_claim` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `policy_id` bigint(20) NOT NULL,
  `agency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organ_donation`
--

CREATE TABLE `organ_donation` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `donor_id` bigint(20) NOT NULL,
  `donor_agency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `driver_uid` bigint(20) NOT NULL DEFAULT '0',
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `phn_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `uid`, `driver_uid`, `lat`, `lon`, `phn_no`) VALUES
(1, 334350409079, 122121, 22.694, 88.3787, 0),
(6, 625753433893, 123412341234, 22.694, 88.3787, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aadhar_details`
--
ALTER TABLE `aadhar_details`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `death_certificate`
--
ALTER TABLE `death_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_details`
--
ALTER TABLE `driver_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forensic_doctor_details`
--
ALTER TABLE `forensic_doctor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forensic_table`
--
ALTER TABLE `forensic_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_doctor_details`
--
ALTER TABLE `general_doctor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance_claim`
--
ALTER TABLE `insurance_claim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organ_donation`
--
ALTER TABLE `organ_donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `death_certificate`
--
ALTER TABLE `death_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_details`
--
ALTER TABLE `doctor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_details`
--
ALTER TABLE `driver_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `forensic_table`
--
ALTER TABLE `forensic_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insurance_claim`
--
ALTER TABLE `insurance_claim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organ_donation`
--
ALTER TABLE `organ_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
