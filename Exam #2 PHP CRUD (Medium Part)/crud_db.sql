-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 02:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees_tbl`
--

CREATE TABLE `employees_tbl` (
  `ID` int(11) NOT NULL,
  `emp_firstname` varchar(100) NOT NULL,
  `emp_lastname` varchar(100) NOT NULL,
  `emp_age` int(11) NOT NULL,
  `emp_gender` varchar(100) NOT NULL,
  `emp_position` int(11) NOT NULL,
  `emp_address` varchar(150) NOT NULL,
  `emp_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees_tbl`
--

INSERT INTO `employees_tbl` (`ID`, `emp_firstname`, `emp_lastname`, `emp_age`, `emp_gender`, `emp_position`, `emp_address`, `emp_status`) VALUES
(2, 'Albert', 'Gaces', 22, 'Male', 2, '#123 Gran Avila Subd.', 'Employed'),
(3, 'Gaces', 'Albert', 32, 'Male', 1, '#124 Gran Avila Subd.', 'Resigned');

-- --------------------------------------------------------

--
-- Table structure for table `emp_pos_tbl`
--

CREATE TABLE `emp_pos_tbl` (
  `ID` int(11) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_pos_tbl`
--

INSERT INTO `emp_pos_tbl` (`ID`, `position`) VALUES
(1, 'Programmer'),
(2, 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foreign_emp_pos` (`emp_position`);

--
-- Indexes for table `emp_pos_tbl`
--
ALTER TABLE `emp_pos_tbl`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_pos_tbl`
--
ALTER TABLE `emp_pos_tbl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  ADD CONSTRAINT `foreign_emp_pos` FOREIGN KEY (`emp_position`) REFERENCES `emp_pos_tbl` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
