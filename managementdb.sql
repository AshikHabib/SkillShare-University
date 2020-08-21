-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2019 at 03:52 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `managementdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course-id` int(15) NOT NULL,
  `course-name` varchar(200) NOT NULL,
  `credit` varchar(10) NOT NULL,
  `course-teacher` varchar(200) NOT NULL,
  `tchr-username` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course-id`, `course-name`, `credit`, `course-teacher`, `tchr-username`) VALUES
(1, 'English-1', '3', 'Shafiul Meznebin', 'shafiul'),
(2, 'English-2', '3', 'Asif Rahman', 'asifrahman'),
(3, 'Math-1', '3', 'Sharmin Juthi', 'sharmin'),
(4, 'Math-2', '3', 'Shafiul Meznebin', 'shafiul'),
(5, 'Physics-1', '3', 'Asif Rahman', 'asifrahman'),
(6, 'Physics-2', '3', 'Asif Rahman', 'asifrahman'),
(7, 'Webtech', '3', 'Ehtesham Chowdhury', 'ehtesham');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(15) NOT NULL,
  `std-username` varchar(200) NOT NULL,
  `ac_holder` varchar(200) NOT NULL,
  `credit` int(10) NOT NULL,
  `semester` varchar(200) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `std-username`, `ac_holder`, `credit`, `semester`, `status`) VALUES
(1, 'fuzail', 'Akash', 9, 'fall', 'PAID'),
(2, 'sajid123', 'Habibul', 9, 'fall', 'PAID'),
(3, 'maishaatin', 'akash', 9, 'fall', 'PAID'),
(4, 'turas', '', 3, 'fall', 'DUE'),
(5, 'aslam', 'Masum', 6, 'summer', 'PAID'),
(6, 'fuzail', 'Akash', 3, 'summer', 'PAID'),
(7, 'turas', '', 3, 'fall', 'DUE'),
(8, 'aslam', '', 3, 'fall', 'DUE');

-- --------------------------------------------------------

--
-- Table structure for table `student-courses`
--

CREATE TABLE `student-courses` (
  `id` int(15) NOT NULL,
  `std-username` varchar(200) NOT NULL,
  `course-name` varchar(200) NOT NULL,
  `course-teacher` varchar(200) NOT NULL,
  `tchr-username` varchar(200) NOT NULL,
  `credit` int(10) NOT NULL,
  `semester` varchar(200) NOT NULL,
  `gpa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student-courses`
--

INSERT INTO `student-courses` (`id`, `std-username`, `course-name`, `course-teacher`, `tchr-username`, `credit`, `semester`, `gpa`) VALUES
(1, 'sajid123', 'English-1', 'Shafiul Meznebin', 'shafiul', 3, 'fall', 'B+'),
(2, 'sajid123', 'English-2', 'Asif Rahman', 'asifrahman', 3, 'fall', 'A'),
(3, 'sajid123', 'Math-1', 'Sharmin Juthi', 'sharmin', 3, 'fall', 'A'),
(4, 'fuzail', 'English-1', 'Shafiul Meznebin', 'shafiul', 3, 'fall', 'A'),
(5, 'fuzail', 'English-2', 'Asif Rahman', 'asifrahman', 3, 'fall', 'A'),
(6, 'fuzail', 'Math-1', 'Sharmin Juthi', 'sharmin', 3, 'fall', 'A+'),
(7, 'maishaatin', 'English-1', 'Shafiul Meznebin', 'shafiul', 3, 'fall', 'C+'),
(8, 'maishaatin', 'English-2', 'Asif Rahman', 'asifrahman', 3, 'fall', ' '),
(9, 'maishaatin', 'Math-1', 'Sharmin Juthi', 'sharmin', 3, 'fall', ' '),
(10, 'turas', 'English-1', 'Shafiul Meznebin', 'shafiul', 3, 'fall', 'A+'),
(11, 'aslam', 'English-1', 'Shafiul Meznebin', 'shafiul', 3, 'summer', 'A+'),
(12, 'aslam', 'Math-1', 'Sharmin Juthi', 'sharmin', 3, 'summer', 'A'),
(13, 'fuzail', 'Webtech', 'Ehtesham Chowdhury', 'ehtesham', 3, 'summer', 'A'),
(14, 'turas', 'Webtech', 'Ehtesham Chowdhury', 'ehtesham', 3, 'fall', ' '),
(15, 'aslam', 'Webtech', 'Ehtesham Chowdhury', 'ehtesham', 3, 'fall', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(15) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `user_id`, `address`, `email`, `password`, `job`) VALUES
(1, 'Ashik', 'Habib', 'Ashik-Habib', 'Dhaka', 'habib@gmail.com', '123', 'admin'),
(2, 'Maisha', 'Atin', 'maishaatin', 'Bogra', 'atin@gmail.com', '1234', 'student'),
(3, 'Shafiul', 'Meznebin', 'shafiul', 'Naogaon', 'shafiul@gmail.com', '12345', 'teacher'),
(4, 'Asif', 'Rahman', 'asifrahman', 'Dhaka', 'asif@gmail.com', '12345', 'teacher'),
(5, 'Sharmin', 'Juthi', 'sharmin', 'Tangail', 'juthi@gamil.com', '12345', 'teacher'),
(6, 'Abu', 'Fuzail', 'fuzail', 'Bogra', 'fuzail@gmail.com', '1234', 'student'),
(7, 'Sajid', 'Shahriar', 'sajid123', 'Bogra', 'sajid@gmail.com', '1234', 'student'),
(8, 'Turas', 'Haque', 'turas', 'Dhaka', 'turas@gmail.com', '1234', 'student'),
(9, 'Aslam', 'Habib', 'aslam', 'Bogura', 'aslam@gmail.com', '1234', 'student'),
(10, 'Ehtesham', 'Chowdhury', 'ehtesham', 'Dhaka', 'ehtesham@gmail.com', '12345', 'teacher'),
(11, 'Rakib', 'Abir', 'abir12', 'Dhaka', 'abir@gmail.com', '1234', 'student'),
(12, 'Tony', 'Roy', 'tony123', 'Dhaka', 'tony@gmail.com', '1234', 'teacher'),
(13, 'Hasan', 'Chisty', 'hasan', 'Voirob', 'hasan@gmail.com', '1234', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course-id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student-courses`
--
ALTER TABLE `student-courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
