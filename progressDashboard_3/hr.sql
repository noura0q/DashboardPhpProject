-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 01:01 PM
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
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` int(11) NOT NULL,
  `learner_id` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certificate_id`, `learner_id`, `issue_date`) VALUES
(1, 1, '2023-03-02'),
(2, 2, '2023-04-11'),
(3, 4, '2023-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `education_details`
--

CREATE TABLE `education_details` (
  `id` int(11) NOT NULL,
  `education_level` varchar(50) NOT NULL,
  `number_of_learners` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_details`
--

INSERT INTO `education_details` (`id`, `education_level`, `number_of_learners`) VALUES
(1, 'Primary School', 500),
(2, 'High School', 800),
(3, 'Bachelor Degree', 1200),
(4, 'Master Degree', 600),
(5, 'PhD', 100);

-- --------------------------------------------------------

--
-- Table structure for table `gender_distribution`
--

CREATE TABLE `gender_distribution` (
  `id` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `percentage` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender_distribution`
--

INSERT INTO `gender_distribution` (`id`, `gender`, `percentage`) VALUES
(1, 'Male', 60),
(2, 'Female', 40);

-- --------------------------------------------------------

--
-- Table structure for table `hr_enrollment_completion`
--

CREATE TABLE `hr_enrollment_completion` (
  `id` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `enrolled` int(11) NOT NULL,
  `completed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hr_enrollment_completion`
--

INSERT INTO `hr_enrollment_completion` (`id`, `month`, `enrolled`, `completed`) VALUES
(1, 'Jan', 100, 80),
(2, 'Feb', 120, 90),
(3, 'Mar', 110, 85),
(4, 'Apr', 105, 82),
(5, 'May', 95, 78),
(6, 'Jun', 130, 92),
(7, 'Jul', 140, 95),
(8, 'Aug', 125, 88),
(9, 'Sep', 115, 86),
(10, 'Oct', 112, 84),
(11, 'Nov', 102, 79),
(12, 'Dec', 108, 81);

-- --------------------------------------------------------

--
-- Table structure for table `kpis`
--

CREATE TABLE `kpis` (
  `kpi_id` int(11) NOT NULL,
  `learners_registered` int(11) DEFAULT NULL,
  `certificates_issued` int(11) DEFAULT NULL,
  `learners_active` int(11) DEFAULT NULL,
  `learners_inactive` int(11) DEFAULT NULL,
  `avg_time` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpis`
--

INSERT INTO `kpis` (`kpi_id`, `learners_registered`, `certificates_issued`, `learners_active`, `learners_inactive`, `avg_time`) VALUES
(1, 5, 3, 3, 2, 30.25);

-- --------------------------------------------------------

--
-- Table structure for table `ksa_region_distribution`
--

CREATE TABLE `ksa_region_distribution` (
  `id` int(11) NOT NULL,
  `region_name` varchar(50) NOT NULL,
  `number_of_learners` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ksa_region_distribution`
--

INSERT INTO `ksa_region_distribution` (`id`, `region_name`, `number_of_learners`) VALUES
(1, 'Riyadh', 1200),
(2, 'Jeddah', 900),
(3, 'Dammam', 800),
(4, 'Makkah', 700),
(5, 'Madinah', 500);

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

CREATE TABLE `learners` (
  `learner_id` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `course_enrollment_date` date DEFAULT NULL,
  `course_completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learners`
--

INSERT INTO `learners` (`learner_id`, `registration_date`, `is_active`, `years_of_experience`, `course_enrollment_date`, `course_completion_date`) VALUES
(1, '2023-01-15', 1, 2, '2023-02-01', '2023-03-01'),
(2, '2023-02-20', 0, 5, '2023-03-05', '2023-04-10'),
(3, '2023-03-10', 1, 3, '2023-03-15', NULL),
(4, '2023-04-05', 0, 1, '2023-04-10', '2023-05-15'),
(5, '2023-05-01', 1, 4, '2023-05-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `learners_experience`
--

CREATE TABLE `learners_experience` (
  `id` int(11) NOT NULL,
  `experience_category` varchar(10) NOT NULL,
  `learner_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learners_experience`
--

INSERT INTO `learners_experience` (`id`, `experience_category`, `learner_count`) VALUES
(1, '0-2', 2000),
(2, '3-4', 1000),
(3, '5-10', 3000),
(4, '10+', 4000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`),
  ADD KEY `learner_id` (`learner_id`);

--
-- Indexes for table `education_details`
--
ALTER TABLE `education_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender_distribution`
--
ALTER TABLE `gender_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_enrollment_completion`
--
ALTER TABLE `hr_enrollment_completion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpis`
--
ALTER TABLE `kpis`
  ADD PRIMARY KEY (`kpi_id`);

--
-- Indexes for table `ksa_region_distribution`
--
ALTER TABLE `ksa_region_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learners`
--
ALTER TABLE `learners`
  ADD PRIMARY KEY (`learner_id`);

--
-- Indexes for table `learners_experience`
--
ALTER TABLE `learners_experience`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education_details`
--
ALTER TABLE `education_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gender_distribution`
--
ALTER TABLE `gender_distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_enrollment_completion`
--
ALTER TABLE `hr_enrollment_completion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kpis`
--
ALTER TABLE `kpis`
  MODIFY `kpi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ksa_region_distribution`
--
ALTER TABLE `ksa_region_distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `learner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `learners_experience`
--
ALTER TABLE `learners_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`learner_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
