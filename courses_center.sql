-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2018 at 02:53 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courses_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_price` int(11) UNSIGNED NOT NULL,
  `course_sessions` int(11) UNSIGNED NOT NULL,
  `course_start_date` date NOT NULL,
  `course_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_price`, `course_sessions`, `course_start_date`, `course_end_date`) VALUES
(1, 'Maths', 50, 10, '2018-05-31', '2018-06-30'),
(2, 'Science', 100, 20, '2018-06-14', '2018-07-11'),
(3, 'English', 150, 15, '2018-05-30', '2018-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `is_manager` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `user_id`, `is_manager`) VALUES
(1, 50, 0),
(2, 51, 0);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `session_num` int(11) UNSIGNED NOT NULL,
  `session_date` date NOT NULL,
  `session_time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`) VALUES
(23, 45),
(24, 48),
(26, 53),
(27, 54),
(28, 55);

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollment`
--

CREATE TABLE `student_enrollment` (
  `student_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_enrollment`
--

INSERT INTO `student_enrollment` (`student_id`, `course_id`, `teacher_id`) VALUES
(23, 2, 16),
(28, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `teacher_earnings` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `user_id`, `teacher_earnings`) VALUES
(15, 46, 0),
(16, 47, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_enrollment`
--

CREATE TABLE `teacher_enrollment` (
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `course_students` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_enrollment`
--

INSERT INTO `teacher_enrollment` (`teacher_id`, `course_id`, `course_students`) VALUES
(15, 1, 0),
(16, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(15) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_type` enum('s','e','t') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `first_name`, `last_name`, `user_phone`, `user_type`) VALUES
(45, 'ahmed2lbadry@gmail.com', '1111', 'Ahmed', 'El Badry', '01149505873', 's'),
(46, 'mena@gmail.com', '1111', 'Mena', 'Fayez', '0125656564', 't'),
(47, 'khaled@gmail.com', '1111', 'Khaled', 'Mohamed', '01145278242', 't'),
(48, 'remon@gmail.com', '1111', 'Remon', 'Fawzy', '0124527145', 's'),
(50, 'admin@gmail.com', '1111', 'admin', 'admin', '011111111', 'e'),
(51, 'hassan@gmail.com', '1111', 'Hassan', 'Raafat', '01152452256', 'e'),
(53, 'mo@gmail.com', '1111', 'Mohamed', 'Salah', '011011011011', 's'),
(54, 'islam@gmail.com', '1111', 'islam', 'mohamed', '0101411041', 's'),
(55, 'abdo@gmail.com', '1111', 'abdo', 'mohamed', '01424754', 's');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `contacts_after_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
  
  IF(NEW.user_type = 's') THEN
    INSERT INTO student
    ( user_id )
    VALUES
    (NEW.user_id);

  ELSEIF(NEW.user_type = 't') THEN
    INSERT INTO teacher
    ( user_id )
    VALUES
    (NEW.user_id);

  ELSEIF(NEW.user_type = 'e') THEN
    INSERT INTO employee
    ( user_id )
    VALUES
    (NEW.user_id);

  END IF;

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_ibfk_1` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD PRIMARY KEY (`student_id`,`course_id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`,`teacher_id`) USING BTREE;

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher_enrollment`
--
ALTER TABLE `teacher_enrollment`
  ADD PRIMARY KEY (`teacher_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`) USING BTREE,
  ADD UNIQUE KEY `user_phone` (`user_phone`),
  ADD KEY `u_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD CONSTRAINT `student_enrollment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_enrollment_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_enrollment_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `teacher_enrollment`
--
ALTER TABLE `teacher_enrollment`
  ADD CONSTRAINT `teacher_enrollment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_enrollment_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
