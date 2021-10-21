-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2021 at 01:16 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `mail` varchar(225) NOT NULL,
  `teacher_username` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `username`, `fullname`, `phone`, `mail`, `teacher_username`) VALUES
(7, 'nam123', 'Hoang Nam', '0998637465', 'nam@gmail.com', 'admin'),
(8, 'tuekn01', 'Khac Tue', '0993648264', 'tue@yahoo.com', 'admin'),
(9, 'Manhnq', 'Do Quang Manh', '0987656785', 'manh@hotmail.com', 'admin'),
(12, 'ductai123', 'Bui Duc Tai', '0987654321', 'ductai123@hotmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `username` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`username`, `name`) VALUES
('admin', 'Bui Duc Tai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `usertype` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `usertype`) VALUES
('admin', 'Admin123', 'teacher'),
('ductai123', 'Ductai123', 'student'),
('Manhnq', 'Manh1234', 'student'),
('nam123', 'Nam12345', 'student'),
('tuekn01', 'Tuekn123', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `username` (`username`),
  ADD KEY `teacher_username` (`teacher_username`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `student_ibfk_4` FOREIGN KEY (`teacher_username`) REFERENCES `teacher` (`username`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
