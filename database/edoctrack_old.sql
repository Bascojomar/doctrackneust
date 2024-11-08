-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 04:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edoctrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesstype`
--

CREATE TABLE `accesstype` (
  `acc_id` int(11) NOT NULL,
  `accessName` varchar(35) NOT NULL,
  `accessDesc` varchar(50) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accesstype`
--

INSERT INTO `accesstype` (`acc_id`, `accessName`, `accessDesc`, `dateCreated`) VALUES
(1, 'Super Admin', 'Super Admin ', '2024-05-27 01:47:55'),
(2, 'Campus Records', 'Records', '2024-06-06 14:35:04'),
(4, 'Offices', 'Offices', '2024-05-27 01:48:18'),
(5, 'Procurment', 'Procurment', '2024-05-27 01:48:34'),
(6, 'Main Record', 'Main Record', '2024-06-06 14:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `campus_id` int(11) NOT NULL,
  `campusName` varchar(75) NOT NULL,
  `campusCode` varchar(15) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`campus_id`, `campusName`, `campusCode`, `dateCreated`) VALUES
(1, 'Gen. Tinio Campus', 'GTC', '2024-05-28 08:16:49'),
(2, 'Sumacab Campus', 'SC', '2024-05-28 07:56:08'),
(3, 'Talavera Off-Campus', 'MGT', '2024-05-28 08:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `docktype`
--

CREATE TABLE `docktype` (
  `dt_id` int(11) NOT NULL,
  `doctypeName` varchar(50) NOT NULL,
  `doctypeCode` varchar(20) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `docktype`
--

INSERT INTO `docktype` (`dt_id`, `doctypeName`, `doctypeCode`, `dateCreated`) VALUES
(1, 'Communication Letter', 'Cletter', '2024-05-29 00:33:33'),
(2, 'Purchase request', 'PR', '2024-05-29 00:33:33'),
(3, 'Voucher', 'VO', '2024-05-29 02:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `documentdetails`
--

CREATE TABLE `documentdetails` (
  `dd_id` int(11) NOT NULL,
  `referenceNo` varchar(128) NOT NULL,
  `office_tag` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `indexing` int(11) NOT NULL,
  `remarks` longtext NOT NULL,
  `dateRecieved` date NOT NULL,
  `dateSigned` date NOT NULL,
  `dateRelease` date NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documenttransac`
--

CREATE TABLE `documenttransac` (
  `docu_id` int(11) NOT NULL,
  `documentCode` varchar(128) NOT NULL,
  `referenceNo` varchar(128) NOT NULL,
  `officeCreated` int(11) NOT NULL,
  `othersCreated` int(11) DEFAULT NULL,
  `documentSubject` varchar(256) NOT NULL,
  `dt_id` int(11) NOT NULL,
  `is_voucher` int(11) NOT NULL DEFAULT 0,
  `newUpload` varchar(256) DEFAULT NULL,
  `fileUpload` varchar(256) NOT NULL,
  `remarks` varchar(128) DEFAULT NULL,
  `statusID` int(11) NOT NULL DEFAULT 0,
  `is_mainRecord` int(11) DEFAULT 0,
  `dateRelease` date DEFAULT NULL,
  `dateDone` date DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `recieveBy` varchar(128) DEFAULT NULL,
  `contactNo` varchar(50) DEFAULT NULL,
  `dateRecievedby` date DEFAULT NULL,
  `userCreated` int(11) NOT NULL,
  `dateDeleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documenttransac`
--

INSERT INTO `documenttransac` (`docu_id`, `documentCode`, `referenceNo`, `officeCreated`, `othersCreated`, `documentSubject`, `dt_id`, `is_voucher`, `newUpload`, `fileUpload`, `remarks`, `statusID`, `is_mainRecord`, `dateRelease`, `dateDone`, `dateCreated`, `recieveBy`, `contactNo`, `dateRecievedby`, `userCreated`, `dateDeleted`) VALUES
(28, 'NEUST240613-8-1523E', '824061364462', 8, NULL, 'SAMPLE', 1, 0, NULL, 'tor.pdf', NULL, 0, 1, NULL, NULL, '2024-06-13 01:36:42', NULL, NULL, NULL, 10, NULL),
(29, 'NEUST240613-9-829C6', '9240613C1B4A', 9, NULL, 'SAMPLE 123', 1, 0, NULL, 'IT-IPT01-BSIT 3D.pdf', NULL, 0, 1, NULL, NULL, '2024-06-13 02:10:42', NULL, NULL, NULL, 12, NULL),
(30, 'NEUST240613-7-09478', '72406133E176', 7, NULL, 'CSSFDXCGH', 1, 0, NULL, 'Instruction-for-finals-requirement.pdf', NULL, 0, 1, NULL, NULL, '2024-06-13 02:21:55', NULL, NULL, NULL, 10, NULL),
(31, 'NEUST240613-9-06EC1', '924061351169', 9, NULL, 'ADFSGDHFJGKHJL', 1, 0, NULL, 'IT-IPT01-BSIT 3D.pdf', NULL, 0, 1, NULL, NULL, '2024-06-13 02:24:43', NULL, NULL, NULL, 12, NULL),
(32, 'NEUST240614-9-35541', '924061492692', 9, NULL, 'SAMPLE 101', 1, 0, NULL, 'IT-WS05-BSIT 3F.pdf', NULL, 0, 1, NULL, NULL, '2024-06-14 02:35:13', NULL, NULL, NULL, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documentvoucher`
--

CREATE TABLE `documentvoucher` (
  `dv_id` int(11) NOT NULL,
  `referenceNo` varchar(128) NOT NULL,
  `vType` varchar(128) NOT NULL,
  `Vnumber` varchar(128) NOT NULL,
  `vAmmount` varchar(128) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateDeleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentvoucher`
--

INSERT INTO `documentvoucher` (`dv_id`, `referenceNo`, `vType`, `Vnumber`, `vAmmount`, `dateCreated`, `dateDeleted`) VALUES
(1, '8240606CC1AC', '2', '12345', '123456', '2024-06-06 12:51:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `officeName` varchar(50) NOT NULL,
  `officeCode` varchar(25) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `campus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `officeName`, `officeCode`, `dateCreated`, `campus`) VALUES
(5, 'All Office', 'AllOffice', '2024-05-27 11:08:11', 1),
(6, 'Office of the President', 'President', '2024-05-27 11:08:37', 1),
(7, 'University Cyber Center', 'UCC', '2024-05-28 01:35:38', 2),
(8, 'Human Resourses', 'HR', '2024-05-28 01:35:38', 1),
(9, 'Office of Director - MGT', 'MGT', '2024-06-13 01:46:59', 3);

-- --------------------------------------------------------

--
-- Table structure for table `officesignatory`
--

CREATE TABLE `officesignatory` (
  `os_id` int(11) NOT NULL,
  `signatory` varchar(100) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `office_id` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officesignatory`
--

INSERT INTO `officesignatory` (`os_id`, `signatory`, `Position`, `office_id`, `dateCreated`) VALUES
(1, 'Marlon', 'Director', 5, '2024-06-07 05:13:57'),
(2, 'Ron', 'MIS', 7, '2024-06-07 05:14:10'),
(3, 'Mark', 'MIS', 5, '2024-06-07 05:26:44'),
(4, 'Reyjohn', 'MIS', 5, '2024-06-07 05:26:55'),
(5, 'Darren', 'MIS', 7, '2024-06-07 05:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(75) NOT NULL,
  `userPassword` varchar(128) NOT NULL,
  `pic` varchar(128) NOT NULL,
  `accesstype` int(11) NOT NULL,
  `userStatus` int(11) NOT NULL DEFAULT 1,
  `offices` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_online` int(11) DEFAULT NULL,
  `sessionCode` varchar(128) DEFAULT NULL,
  `dateDeleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `userPassword`, `pic`, `accesstype`, `userStatus`, `offices`, `dateCreated`, `is_online`, `sessionCode`, `dateDeleted`) VALUES
(2, 'Rey John P. Aguilar', 'admin@gmail.com', '6e9c053712b4e7da4a4ae86d6faa30db', 'admin.jpg', 1, 1, NULL, '2024-06-10 02:29:44', NULL, NULL, NULL),
(3, 'Rhodora R. Jugo', 'vpaa@gmail.com', '123', 'pic.jpg', 4, 1, 8, '2024-06-13 14:10:21', NULL, NULL, NULL),
(10, 'Darren Acuna', 'pogireyjohn70@gmail.com', '202cb962ac59075b964b07152d234b70', 'pic.jpg', 1, 1, 5, '2024-06-14 00:11:58', 1, 'vv27grtq2cbqk9jgqftdn9qrdq6661cfa8361574.82056653', NULL),
(11, 'Jomar Castro', 'reyjohnaguilar70@gmail.com', '6ddb051078469914fb7d37a4f0df7c0e', 'FINAL PACK.jpg', 4, 1, 7, '2024-05-28 02:07:33', NULL, NULL, NULL),
(12, 'Jomar DJ. Basco', 'bascojomar02@gmail.com', '202cb962ac59075b964b07152d234b70', 'IMG_2542.JPG', 4, 1, 9, '2024-06-13 01:48:31', 1, 'ha2cbdlb5v2057gvn1ugkmn47v6661cf81510cb5.61028394', NULL),
(13, 'June Bernard Tayupon', 'jedirang6@gmail.com', '202cb962ac59075b964b07152d234b70', 'IMG_2542.JPG', 2, 1, 9, '2024-06-14 02:32:17', 1, 'mjeu8u35nfhs2jsto6nmm046n1666bababd10720.91081996', NULL),
(14, 'June Bernard Tayupon', 'jedirang6@gmail.com', 'c20e311b48095e41094c7f953bd283ca', 'IMG_2542.JPG', 6, 1, 5, '2024-06-10 02:35:37', NULL, NULL, '2024-06-10'),
(15, 'Main Record', 'nstpreyjohn70@gmail.com', '202cb962ac59075b964b07152d234b70', 'IMG_2542 (1).JPG', 6, 1, 5, '2024-06-10 02:34:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vouchertype`
--

CREATE TABLE `vouchertype` (
  `vt_id` int(11) NOT NULL,
  `vtName` varchar(50) NOT NULL,
  `vtDesc` varchar(50) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vouchertype`
--

INSERT INTO `vouchertype` (`vt_id`, `vtName`, `vtDesc`, `DateCreated`) VALUES
(1, 'MDS', 'MDS', '2024-06-06 12:40:42'),
(2, 'CHECK', 'CHECK', '2024-06-06 12:40:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesstype`
--
ALTER TABLE `accesstype`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`campus_id`);

--
-- Indexes for table `docktype`
--
ALTER TABLE `docktype`
  ADD PRIMARY KEY (`dt_id`);

--
-- Indexes for table `documentdetails`
--
ALTER TABLE `documentdetails`
  ADD PRIMARY KEY (`dd_id`);

--
-- Indexes for table `documenttransac`
--
ALTER TABLE `documenttransac`
  ADD PRIMARY KEY (`docu_id`),
  ADD KEY `dt_id` (`dt_id`),
  ADD KEY `officeCreated` (`officeCreated`),
  ADD KEY `userCreated` (`userCreated`);

--
-- Indexes for table `documentvoucher`
--
ALTER TABLE `documentvoucher`
  ADD PRIMARY KEY (`dv_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`office_id`),
  ADD KEY `campus` (`campus`);

--
-- Indexes for table `officesignatory`
--
ALTER TABLE `officesignatory`
  ADD PRIMARY KEY (`os_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `accesstype` (`accesstype`),
  ADD KEY `offices` (`offices`);

--
-- Indexes for table `vouchertype`
--
ALTER TABLE `vouchertype`
  ADD PRIMARY KEY (`vt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesstype`
--
ALTER TABLE `accesstype`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `campus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `docktype`
--
ALTER TABLE `docktype`
  MODIFY `dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documentdetails`
--
ALTER TABLE `documentdetails`
  MODIFY `dd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documenttransac`
--
ALTER TABLE `documenttransac`
  MODIFY `docu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `documentvoucher`
--
ALTER TABLE `documentvoucher`
  MODIFY `dv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `officesignatory`
--
ALTER TABLE `officesignatory`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vouchertype`
--
ALTER TABLE `vouchertype`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documenttransac`
--
ALTER TABLE `documenttransac`
  ADD CONSTRAINT `documenttransac_ibfk_1` FOREIGN KEY (`dt_id`) REFERENCES `docktype` (`dt_id`),
  ADD CONSTRAINT `documenttransac_ibfk_2` FOREIGN KEY (`officeCreated`) REFERENCES `offices` (`office_id`),
  ADD CONSTRAINT `documenttransac_ibfk_3` FOREIGN KEY (`userCreated`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `offices_ibfk_1` FOREIGN KEY (`campus`) REFERENCES `campus` (`campus_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`accesstype`) REFERENCES `accesstype` (`acc_id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`offices`) REFERENCES `offices` (`office_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
