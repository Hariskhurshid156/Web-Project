-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 08:31 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fullname`, `email`, `password`, `type`, `status`, `created_by`, `updated_by`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'administrator', 'admin123@gmail.com', '8b283e8957f744ae5a1a6add05fc354f', 'admin', '1', 11, 11, '2019-06-19 05:35:08', '2019-06-19 15:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `counselor`
--

CREATE TABLE `counselor` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT '	images/people/blank.png',
  `name` varchar(100) NOT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `skype_id` varchar(255) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `average_rating` float DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counselor`
--

INSERT INTO `counselor` (`id`, `picture`, `name`, `qualification`, `department`, `email`, `password`, `skype_id`, `phone_number`, `average_rating`, `status`, `created_at`) VALUES
(2, '	images/people/blank.png', 'Talha Mubashar', 'Sofware Engineer', 'Computer Sciences', 'talhatalha0012@gmail.com', '1adea88d814b325fa4f7b1861527a062', 'talha123', '', 5, '1', '2019-07-17 06:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `body` varchar(300) NOT NULL,
  `date` date NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `subject`, `body`, `date`, `status`) VALUES
(1, 'Admission open', 'Admissions for Masters programs are open. Last date to register is Aug 10', '2019-06-30', '1'),
(2, 'Sports Week', 'Sport week is starting from 10th of August', '2019-06-30', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `std_id` varchar(50) NOT NULL,
  `counselor_id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `review` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `std_id`, `counselor_id`, `rating`, `review`, `created_at`) VALUES
(1, '123-asda/sdas/d13', 1, 5, 'good effort', '2019-07-16 17:51:36'),
(2, '078-fbas/bsit/f15', 2, 5, 'gghfhgf', '2019-07-17 06:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `registered_courses`
--

CREATE TABLE `registered_courses` (
  `id` int(11) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_courses`
--

INSERT INTO `registered_courses` (`id`, `reg_no`, `course_code`, `status`, `grade`, `semester`) VALUES
(1, '078-fbas/bsit/f15', 'cs-101', 'cleared', 'B+', 2),
(2, '078-fbas/bsit/f15', 'cs-102', 'cleared', 'A', 1),
(3, '078-fbas/bsit/f15', 'gc-102', 'cleared', 'B+', 1),
(4, '078-fbas/bsit/f15', 'ms-111', 'cleared', 'C', 1),
(5, '078-fbas/bsit/f15', 'ms-110', 'cleared', 'D', 1),
(6, '078-fbas/bsit/f15', 'gc-101', 'cleared', 'A', 2),
(7, '078-fbas/bsit/f15', 'cs-301', 'cleared', 'B', 2),
(8, '078-fbas/bsit/f15', 'cs-225', 'cleared', 'A', 2),
(9, '078-fbas/bsit/f15', 'gc-104', 'cleared', 'D+', 2),
(10, '123-asda/sdas/d13', 'cs-101', 'registered', NULL, 1),
(11, '123-asda/sdas/d13', 'cs-102', 'registered', NULL, 1),
(12, '123-asda/sdas/d13', 'gc-102', 'registered', NULL, 1),
(13, '123-asda/sdas/d13', 'ms-111', 'registered', NULL, 1),
(14, '123-asda/sdas/d13', 'ms-110', 'registered', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `reg_number` varchar(255) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `Status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `scholar_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `body` varchar(300) NOT NULL,
  `link` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `lastdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`scholar_id`, `subject`, `body`, `link`, `status`, `lastdate`) VALUES
(2, 'HEC need base', 'hec is offering a chance to get need base fund', 'hec.edu.pk', '1', '2019-08-30'),
(3, 'Benovalent Fund', 'benovalent fund is a government based scholarship for children of government  employees', 'benovalent.edu.pk', '1', '2019-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `picture` varchar(250) DEFAULT 'images/people/blank.png',
  `semester` int(11) NOT NULL,
  `skype_id` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `program` varchar(150) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `picture`, `semester`, `skype_id`, `phone_number`, `address`, `program`, `status`, `created_at`) VALUES
('023-fbas/bsit/f15', 'abc def', 'fdsfdsfdsfdsf@iiui.edu.pk', 'c98e3dde1049928dc9525d858e528591', 'images/people/blank.png', 1, NULL, NULL, NULL, 'Computer Sciences', '1', '2019-07-17 06:20:30'),
('078-fbas/bsit/f15', 'Rahila Ansar', 'Rahilaansar@iiui.edu.pk', 'bf73fc7d9a2649907944805fc1aa6c09', 'images/people/blank.png', 3, NULL, NULL, NULL, 'Computer Sciences', '1', '2019-07-16 07:20:23'),
('123-asda/sdas/d13', 'talha mubashar', 'talhamubashar0012@gmail.com', '3f1829cc74b7e860a269a2cef3967e45', 'images/people/blank.png', 1, NULL, NULL, NULL, 'Computer Sciences', '1', '2019-07-16 17:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `pre_requisites` varchar(255) DEFAULT NULL,
  `credit_hours` int(10) NOT NULL,
  `offered_sem` int(11) NOT NULL,
  `program` varchar(150) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_code`, `subject_name`, `pre_requisites`, `credit_hours`, `offered_sem`, `program`, `status`, `created_by`, `updated_by`, `created_date`, `updated_date`) VALUES
(1, 'cs-101', 'Introduction to Computing', '', 4, 1, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'cs-102', 'Discrete Structures', '', 3, 1, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'gc-102', 'English Composition & Comprehension', '', 3, 1, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'ms-111', 'Calculus & Analytical Geometry', '', 3, 1, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ms-110', 'Applied Physics', '', 3, 1, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'cs-111', 'Programming Fundamentals', 'cs-101', 4, 2, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'cs-225', 'Digital Logic and Design', 'ms-110', 4, 2, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'cs-301', 'Multivariable Caluculus', 'ms-111', 3, 2, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'gc-101', 'Understanding Quran-i', '', 3, 2, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'gc-104', 'Communication & Presentation Skills', 'gc-102', 3, 2, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'cs-211', 'Object Oriented Programming', 'cs-111', 4, 3, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'se-101', 'Introduction to Software Engineering', '', 3, 3, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'cs-324', 'Computer Organization and Assembly language', 'cs-225', 4, 3, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'gc-103', 'Understanding Quran-ii', '', 3, 3, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'ms-112', 'Linear Algebra', '', 3, 3, 'Computer Sciences', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counselor`
--
ALTER TABLE `counselor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`scholar_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counselor`
--
ALTER TABLE `counselor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registered_courses`
--
ALTER TABLE `registered_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `scholar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
