-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2018 at 01:04 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` smallint(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `stateId` smallint(5) NOT NULL,
  `patientId` mediumint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address`, `stateId`, `patientId`) VALUES
(3, 'Basilica of the Most Holy Trinity Compound', 4, 1),
(4, '8 Magazine Ave', 4, 13),
(5, 'Basilica of the most holy trinity compound', 4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `admitted`
--

CREATE TABLE `admitted` (
  `id` int(11) NOT NULL,
  `patientId` smallint(5) NOT NULL,
  `dateAdmitted` date NOT NULL,
  `physicianId` smallint(5) NOT NULL,
  `wardId` smallint(5) NOT NULL,
  `dateDischarged` date NOT NULL,
  `status` enum('Cured','ISQ','Worse','Died') NOT NULL DEFAULT 'Cured',
  `visitId` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `allergy`
--

CREATE TABLE `allergy` (
  `id` mediumint(11) NOT NULL,
  `allergy` text NOT NULL,
  `patientId` mediumint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allergy`
--

INSERT INTO `allergy` (`id`, `allergy`, `patientId`) VALUES
(11, 'Chloroquin', 1),
(12, 'Sun Flower', 1),
(13, 'Calcium', 14),
(16, 'Magnessium', 14);

-- --------------------------------------------------------

--
-- Table structure for table `bloodgroup`
--

CREATE TABLE `bloodgroup` (
  `id` smallint(5) NOT NULL,
  `bloodGroup` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bloodgroup`
--

INSERT INTO `bloodgroup` (`id`, `bloodGroup`) VALUES
(1, 'A'),
(2, 'AB'),
(3, 'B'),
(4, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `clinicalchemlab`
--

CREATE TABLE `clinicalchemlab` (
  `id` smallint(5) NOT NULL,
  `patientId` smallint(5) NOT NULL,
  `testId` smallint(5) NOT NULL,
  `result` smallint(5) NOT NULL,
  `dateTested` date NOT NULL,
  `staffId` smallint(5) NOT NULL,
  `clinicalDetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` mediumint(11) NOT NULL,
  `patientId` smallint(11) NOT NULL,
  `diagnosis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `patientId`, `diagnosis`) VALUES
(1, 1, 'Sleep apnea is a reduction or cessation of breathing during sleep. There are three types of sleep apnea. The most common is obstructive sleep apnea (OSA). OSA is caused by the collapse of the airway during sleep. There are many complications related to OSA. Treatments are surgical and non-surgical.');

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
  `id` int(11) NOT NULL,
  `drugName` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drug`
--

INSERT INTO `drug` (`id`, `drugName`, `price`) VALUES
(1, 'Sudrex', 1800),
(2, 'Bosca', 1000),
(3, 'Panadol', 450),
(4, 'Cypron', 2800),
(5, 'Chemiron', 1400),
(6, 'para', 1222),
(7, 'k', 88888);

-- --------------------------------------------------------

--
-- Table structure for table `ethnic`
--

CREATE TABLE `ethnic` (
  `id` smallint(5) NOT NULL,
  `ethnic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ethnic`
--

INSERT INTO `ethnic` (`id`, `ethnic`) VALUES
(1, 'Igbo'),
(2, 'Hausa'),
(3, 'Yoruba'),
(4, 'Ijaw'),
(5, 'Ibibio'),
(6, 'Edo'),
(7, 'Efik'),
(8, 'Idoma'),
(9, 'Igala'),
(10, 'Ikwere'),
(11, 'Itsekiri'),
(12, 'Kanuri'),
(13, 'Nupe'),
(14, 'Tiv'),
(15, 'Urhobo'),
(16, 'Isoko');

-- --------------------------------------------------------

--
-- Table structure for table `faeces`
--

CREATE TABLE `faeces` (
  `id` smallint(5) NOT NULL,
  `xracteristics` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faeces`
--

INSERT INTO `faeces` (`id`, `xracteristics`) VALUES
(1, 'Appearance'),
(2, 'Microscopy'),
(3, 'Parasites'),
(4, 'Ova'),
(5, 'Cysts'),
(6, 'Occult Blood'),
(7, 'Larva'),
(8, 'WBC'),
(9, 'RBC');

-- --------------------------------------------------------

--
-- Table structure for table `genotype`
--

CREATE TABLE `genotype` (
  `id` smallint(5) NOT NULL,
  `genotype` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genotype`
--

INSERT INTO `genotype` (`id`, `genotype`) VALUES
(1, 'AA'),
(2, 'AB'),
(3, 'AO'),
(4, 'BB'),
(5, 'BO'),
(6, 'OO');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` mediumint(11) NOT NULL,
  `patientId` mediumint(11) NOT NULL,
  `dateAttended` date NOT NULL,
  `dateAdmitted` date NOT NULL,
  `refferedBy` text NOT NULL,
  `physicianId` smallint(5) NOT NULL,
  `wardId` smallint(5) NOT NULL,
  `dateDischarged` date NOT NULL,
  `dischargedTo` varchar(255) NOT NULL,
  `status` enum('Cured','ISQ','Worse','Died') NOT NULL DEFAULT 'Cured'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` smallint(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `logo`) VALUES
(1, 'ANGELS OF GOD HOSPITAL', '');

-- --------------------------------------------------------

--
-- Table structure for table `nok`
--

CREATE TABLE `nok` (
  `id` smallint(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `stateId` smallint(5) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `patientId` mediumint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nok`
--

INSERT INTO `nok` (`id`, `firstname`, `surname`, `address`, `stateId`, `phone`, `patientId`) VALUES
(2, 'EbeleChukwu', 'Chukwu', '26 Uzoegwu Street, Nkpor', 4, '08012345678', 14);

-- --------------------------------------------------------

--
-- Table structure for table `parastofaeces`
--

CREATE TABLE `parastofaeces` (
  `id` smallint(5) NOT NULL,
  `parastoLabId` smallint(5) NOT NULL,
  `faecesId` smallint(5) NOT NULL,
  `value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parastolab`
--

CREATE TABLE `parastolab` (
  `id` smallint(5) NOT NULL,
  `patientId` smallint(5) NOT NULL,
  `visitId` smallint(5) NOT NULL,
  `staffId` smallint(5) NOT NULL,
  `dateTested` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parasturine`
--

CREATE TABLE `parasturine` (
  `id` smallint(5) NOT NULL,
  `parastoLabId` smallint(5) NOT NULL,
  `urineId` smallint(5) NOT NULL,
  `value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` mediumint(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `othername` varchar(100) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `ethnicId` smallint(5) DEFAULT NULL,
  `bloodGroupId` smallint(5) DEFAULT NULL,
  `genotypeId` smallint(5) DEFAULT NULL,
  `dob` date NOT NULL,
  `stateId` smallint(5) NOT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `religionId` smallint(5) DEFAULT NULL,
  `dateReg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `surname`, `firstname`, `othername`, `phone`, `ethnicId`, `bloodGroupId`, `genotypeId`, `dob`, `stateId`, `occupation`, `religionId`, `dateReg`) VALUES
(14, 'chukwu', 'chigozie', 'Evelyn', '08160164113', 1, 4, 6, '2017-10-12', 4, 'Educator', 1, '2017-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `patientvisit`
--

CREATE TABLE `patientvisit` (
  `id` int(11) NOT NULL,
  `patientId` smallint(5) NOT NULL,
  `dateVisited` date NOT NULL,
  `physicianId` smallint(11) NOT NULL,
  `surgeryId` smallint(5) DEFAULT '0',
  `diagnosis` text,
  `admittedId` smallint(5) DEFAULT '0',
  `fee` int(10) NOT NULL,
  `paid` int(10) NOT NULL,
  `consultancyFee` smallint(5) NOT NULL,
  `consultancyFeePaid` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patientvisit`
--

INSERT INTO `patientvisit` (`id`, `patientId`, `dateVisited`, `physicianId`, `surgeryId`, `diagnosis`, `admittedId`, `fee`, `paid`, `consultancyFee`, `consultancyFeePaid`) VALUES
(1, 14, '2017-10-02', 1, 0, 'she is sick', 0, 4000, 8200, 3000, 'Y'),
(2, 14, '2017-10-12', 0, 0, NULL, 0, 0, 0, 0, 'N'),
(3, 14, '2018-05-21', 0, 0, NULL, 0, 0, 0, 0, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `patientvisitcycle`
--

CREATE TABLE `patientvisitcycle` (
  `id` int(11) NOT NULL,
  `patientVisitId` int(11) NOT NULL,
  `see` smallint(5) NOT NULL DEFAULT '0',
  `seen` enum('Y','N') NOT NULL DEFAULT 'N',
  `sentIn` enum('Y','N') NOT NULL DEFAULT 'N',
  `sentToDr` enum('Y','N') NOT NULL DEFAULT 'N',
  `seePharm` enum('Y','N') NOT NULL DEFAULT 'N',
  `seenPharm` enum('Y','N') NOT NULL DEFAULT 'N',
  `seeLab` enum('Y','N') NOT NULL DEFAULT 'N',
  `seenLab` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patientvisitcycle`
--

INSERT INTO `patientvisitcycle` (`id`, `patientVisitId`, `see`, `seen`, `sentIn`, `sentToDr`, `seePharm`, `seenPharm`, `seeLab`, `seenLab`) VALUES
(1, 1, 1, 'Y', 'Y', 'Y', 'N', 'N', 'N', 'N'),
(2, 2, 0, 'N', 'N', 'N', 'Y', 'N', 'N', 'N'),
(3, 3, 1, 'N', 'Y', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `patientvisitdrug`
--

CREATE TABLE `patientvisitdrug` (
  `id` smallint(6) NOT NULL,
  `patientVisitId` smallint(6) NOT NULL,
  `drugId` smallint(10) DEFAULT NULL,
  `paid` enum('Y','N') NOT NULL DEFAULT 'N',
  `issued` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patientvisitdrug`
--

INSERT INTO `patientvisitdrug` (`id`, `patientVisitId`, `drugId`, `paid`, `issued`) VALUES
(1, 1, 2, 'Y', 'Y'),
(2, 1, 5, 'Y', 'Y'),
(3, 1, 4, 'Y', 'Y'),
(4, 1, 2, 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` smallint(5) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position`) VALUES
(1, 'Doctor'),
(2, 'Nurse'),
(3, 'Lab Attendant'),
(4, 'Receptionist'),
(5, 'Pharmacist');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE `religion` (
  `id` smallint(5) NOT NULL,
  `religion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `religion`) VALUES
(1, 'Christian'),
(2, 'Islam');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `othername` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `positionId` smallint(5) NOT NULL,
  `superUser` enum('Y','N') NOT NULL DEFAULT 'N',
  `code` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `stateId` smallint(5) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `othername`, `email`, `phone`, `positionId`, `superUser`, `code`, `address`, `stateId`, `dob`) VALUES
(1, 'Chukwuebuka', 'Lawrence', 'L', 'goziechukwu@gmail.com', '08138184403', 1, 'Y', '12345678AB', '', 0, '2017-09-21'),
(2, 'Amaka', 'Obizor', 'Mary', '', '08234567891', 4, 'N', '63474460KY', '14 ibegbu Str', 4, '1981-04-18'),
(3, 'Okwudili', 'Okwu', 'Ben', '', '08012345678', 1, 'N', '35829374UH', '14 ibegbu Str', 4, '1981-04-18'),
(4, 'Oby', 'Uchebo', 'Angela', '', '08012345678', 5, 'N', '81761325YO', '14 ibegbu Str', 4, '1981-04-18'),
(5, 'Cynthia', 'uchechi', 'l', '', '44444444444', 3, 'N', '07391246DA', '36 Angels of God street Awasda', 16, '2017-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` smallint(5) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Akwa Ibom'),
(4, 'Anambra'),
(5, 'Bauchi'),
(6, 'Bayelsa'),
(7, 'Benue'),
(8, 'Borno'),
(9, 'Cross River'),
(10, 'Delta'),
(11, 'Ebonyi'),
(12, 'Edo'),
(13, 'Ekiti'),
(14, 'Enugu'),
(15, 'Federal Capital Territory'),
(16, 'Gombe'),
(17, 'Imo'),
(18, 'Jigawa'),
(19, 'Kaduna'),
(20, 'Kano'),
(21, 'Katsina'),
(22, 'Kebbi'),
(23, 'Kogi'),
(24, 'Kwara'),
(25, 'Lagos'),
(26, 'Nasarawa'),
(27, 'Niger'),
(28, 'Ogun'),
(29, 'Ondo'),
(30, 'Osun'),
(31, 'Oyo'),
(32, 'Plateau'),
(33, 'Rivers'),
(34, 'Sokoto'),
(35, 'Taraba'),
(36, 'Yobe'),
(37, 'Zamfara');

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE `surgery` (
  `id` mediumint(11) NOT NULL,
  `visitId` smallint(5) NOT NULL,
  `surgery` varchar(80) NOT NULL,
  `notesProg` text,
  `surgDate` date NOT NULL,
  `physicianId` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` smallint(5) NOT NULL,
  `test` varchar(50) NOT NULL,
  `normalValue` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `test`, `normalValue`) VALUES
(1, 'Total Bilirubin', '0.1-1.0 (mg/100ml)'),
(2, 'Conjugated Bilirubin', ''),
(3, 'Aspartate SGOT', '3-12 (1.u/1)'),
(4, 'Alanine SGOT', '3-12 (1.u/1)'),
(5, 'Alkaline Phosphate', '25-92 (1.u/1)'),
(6, 'Acid Phosphate', '<7.2  (1.u/1)'),
(7, 'Total Cholesterol', '100-230 (g/100ml)'),
(8, 'Triglycerides', '<150g/100ml'),
(9, 'Total Protein', '6-8 (g/100ml)'),
(10, 'Albumin', '3.2-4.8 (g/100ml)'),
(11, 'Globulin', '1.8-3.8 (g/100ml)'),
(12, 'Sugar', '60-100 (mg/100ml)'),
(13, 'Sugar (Fasting)', '60-120'),
(14, 'Uric Acid', '2-7 (1.u/1)'),
(15, 'Amylase', '200-400 (mg/100ml)'),
(16, 'Urea', '0.5-4.0 (mg/100ml)'),
(17, 'Creatinine', '1-1.5 (mg/100ml)'),
(18, 'Calcium', '9-11 (mmo/n)'),
(19, 'Na+ ', '(135-150 (mmo/n)'),
(20, 'K+', '3.8-5.0 (mmo/n)'),
(21, 'CL-', '95-150 (mmo/n)'),
(22, 'HCO- 3', '24-30 (mmo/n)'),
(23, 'Inorganic Phosphate', '2-4.5 (g/100ml)'),
(24, 'HDL', '<40(g/100ml)(f) <60(g/100ml)(m)'),
(25, 'LDL', '<100 (g/100ml)');

-- --------------------------------------------------------

--
-- Table structure for table `urine`
--

CREATE TABLE `urine` (
  `id` smallint(5) NOT NULL,
  `xracteristics` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urine`
--

INSERT INTO `urine` (`id`, `xracteristics`) VALUES
(1, 'Appearance'),
(2, 'Specific Gravity'),
(3, 'Reaction'),
(4, 'Protien'),
(5, 'Sugar'),
(6, 'Bill'),
(7, 'WBC (Mm3/HPF)'),
(8, 'RBC (Mm3/HPF)'),
(9, 'Casts (LPF)'),
(10, 'Yeast Cells'),
(11, 'Ketones'),
(12, 'Urobilinogen');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `id` smallint(5) NOT NULL,
  `ward` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `ward`) VALUES
(1, 'Ward1'),
(2, 'Ward2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admitted`
--
ALTER TABLE `admitted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allergy`
--
ALTER TABLE `allergy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloodgroup`
--
ALTER TABLE `bloodgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinicalchemlab`
--
ALTER TABLE `clinicalchemlab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ethnic`
--
ALTER TABLE `ethnic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faeces`
--
ALTER TABLE `faeces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genotype`
--
ALTER TABLE `genotype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nok`
--
ALTER TABLE `nok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parastofaeces`
--
ALTER TABLE `parastofaeces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parastolab`
--
ALTER TABLE `parastolab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parasturine`
--
ALTER TABLE `parasturine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientvisit`
--
ALTER TABLE `patientvisit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientvisitcycle`
--
ALTER TABLE `patientvisitcycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientvisitdrug`
--
ALTER TABLE `patientvisitdrug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religion`
--
ALTER TABLE `religion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surgery`
--
ALTER TABLE `surgery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urine`
--
ALTER TABLE `urine`
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
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admitted`
--
ALTER TABLE `admitted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allergy`
--
ALTER TABLE `allergy`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bloodgroup`
--
ALTER TABLE `bloodgroup`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clinicalchemlab`
--
ALTER TABLE `clinicalchemlab`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ethnic`
--
ALTER TABLE `ethnic`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `faeces`
--
ALTER TABLE `faeces`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genotype`
--
ALTER TABLE `genotype`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nok`
--
ALTER TABLE `nok`
  MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parastofaeces`
--
ALTER TABLE `parastofaeces`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parastolab`
--
ALTER TABLE `parastolab`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parasturine`
--
ALTER TABLE `parasturine`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patientvisit`
--
ALTER TABLE `patientvisit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patientvisitcycle`
--
ALTER TABLE `patientvisitcycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patientvisitdrug`
--
ALTER TABLE `patientvisitdrug`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `religion`
--
ALTER TABLE `religion`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `urine`
--
ALTER TABLE `urine`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
