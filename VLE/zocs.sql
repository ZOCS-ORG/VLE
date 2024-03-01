-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 02:37 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zocs`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountants`
--

CREATE TABLE `accountants` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `salary` double NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accountants`
--

INSERT INTO `accountants` (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `salary`, `img`) VALUES
(1, 'Douglas Mwansa', 'acc', '202cb962ac59075b964b07152d234b70', '0965454321', 'acc@school.com', 'Salama Park', 'Male', '1993-02-09', '2021-02-09', 22000, 'Douglas Mwimba_431341.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `phone`, `email`, `dob`, `hiredate`, `address`, `sex`, `img`) VALUES
(5, 'Admin', 'admin', '202cb962ac59075b964b07152d234b70', '0971212121', 'admin@ad.min.com', '1997-11-26', '2021-01-06', 'Mansa', 'Male', '_576418.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(350) NOT NULL,
  `name` text NOT NULL,
  `audience` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `assFile` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `graded` varchar(11) NOT NULL,
  `late` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `question_id`, `student_id`, `subject_id`, `assFile`, `date`, `graded`, `late`, `comment`) VALUES
(7, 1, 363, 5, '363_1_5_Quotation.pdf', '2021-03-03', 'yes', '', ''),
(17, 2, 364, 12, '__12_TPIN Registration Certificate.pdf', '2021-03-06', 'yes', 'In Time', ''),
(19, 3, 364, 12, '_3_12_melvin work.docx', '2021-03-29', 'yes', 'In Time', ''),
(24, 1, 364, 5, '_1_5_melvin work.docx', '2021-03-29', '0', 'In Time', ''),
(25, 2, 363, 12, '_2_12_Invoice.pdf', '2021-03-29', 'yes', 'Late', '');

-- --------------------------------------------------------

--
-- Table structure for table `ass_notice`
--

CREATE TABLE `ass_notice` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `assFile` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_due` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ass_notice`
--

INSERT INTO `ass_notice` (`id`, `question`, `name`, `class_id`, `subject_id`, `teacher_id`, `assFile`, `date`, `date_due`, `marks`) VALUES
(1, 'With practical examples, clearly explain why you would like to study physics. ', 'Assignment 1', 42, 5, 7, '', '01-03-2021', '2021-03-02', 40),
(2, 'What is the difference between a musician and a dancer? Give examples.', 'Music Assignment 1 updated', 42, 12, 11, '', '05-03-2021', '2021-03-04', 30),
(6, 'question to the new assignment', 'The new assignment', 42, 12, 11, 'ZAGO Website Outline.pdf', '08-07-2021', '2021-07-09', 45);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `class_id`, `student_id`, `teacher_id`, `status`, `date`) VALUES
(72, 43, 367, 11, 'Present', '2021-02-18'),
(73, 43, 368, 11, 'Present', '2021-02-18'),
(74, 43, 369, 11, 'Present', '2021-02-18'),
(75, 43, 370, 11, 'Absent', '2021-02-18'),
(76, 43, 371, 11, 'Present', '2021-02-18'),
(78, 42, 364, 7, 'Present', '2021-02-18'),
(79, 42, 365, 7, 'Absent', '2021-02-18'),
(80, 42, 366, 7, 'Present', '2021-02-18'),
(82, 42, 364, 7, 'Present', '2021-06-18'),
(83, 42, 365, 7, 'Present', '2021-06-18'),
(84, 42, 366, 7, 'Present', '2021-06-18'),
(85, 42, 371, 7, 'Absent', '2021-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `availablecourse`
--

CREATE TABLE `availablecourse` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `classid` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `branch`, `account_no`, `account_name`) VALUES
(23, 'Cavmont Bank', 'Nakonde Branch', '0021298735410004', 'Library Acc'),
(24, 'ZBA', 'Mansa Branch', '2200007382919309', 'Accademic ofiice acc');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `type`, `name`, `description`, `start_date`, `end_date`, `created`, `created_by`, `status`) VALUES
(1, 'Final test', 'Some event', 'Yall will be writing a test on monday', '2021-02-09 14:20:00', '2021-02-10 17:20:00', '0000-00-00 00:00:00', 7, 1),
(2, 'IDK', 'others', 'new stuff going on', '2021-06-03 10:1:00', ' 14:30:00', '0000-00-00 00:00:00', 1, 1),
(3, 'test', 'test', 'test', '2024-01-28 14:20:00', '2024-01-31 17:20:00', '0000-00-00 00:00:00', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `monitor_id` int(11) NOT NULL,
  `room` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `teacher_id`, `monitor_id`, `room`) VALUES
(42, '10 A', 7, 366, '01'),
(43, '10 B', 11, 367, '02');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `teacher_id`, `program_id`) VALUES
(1, 'Macro Economics', 'ECE-M 101', 7, 1),
(321, 'Introduction to Indu', 'PSG I/O 10', 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `examschedule`
--

CREATE TABLE `examschedule` (
  `id` varchar(20) NOT NULL,
  `examdate` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `courseid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `examschedule`
--

INSERT INTO `examschedule` (`id`, `examdate`, `time`, `courseid`) VALUES
('145', '2016-05-06', '2:00-4:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paid_by` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `notes` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `bank_acc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `amount`, `paid_by`, `description`, `notes`, `date`, `method`, `bank_acc`) VALUES
(3, 9700, '', 'Paid to schools union', '', '2021-03-16', 'Bank', 24),
(4, 2900, '1', 'Bus fuel', 'So bus needs to move', '0000-00-00', 'Bank', 24),
(5, 255, 'Douglas Mwansa', 'Bus fuel', 'notes', '2021-03-24', 'Cash', 0),
(6, 8000, 'Douglas Mwansa', 'Plane ticket', 'Boss went out of town', '2021-03-17', '1', 0),
(7, 8000, 'Douglas Mwansa', 'Plane ticket', 'Boss went out of town', '2021-03-31', '2', 24);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dean_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `dean_id`) VALUES
(1, 'Humanities', 7),
(2, 'Natural Sciences', 8);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date_paid` date NOT NULL,
  `term` varchar(255) NOT NULL,
  `year` int(5) NOT NULL,
  `method` varchar(255) DEFAULT NULL,
  `recieved_by` int(11) DEFAULT NULL,
  `bank_acc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `amount`, `date_paid`, `term`, `year`, `method`, `recieved_by`, `bank_acc`) VALUES
(4, 364, 2500, '2021-02-10', '1', 2021, 'Bank', NULL, '24'),
(5, 364, 3000, '2021-02-02', '1', 2021, 'Cash', 1, NULL),
(6, 364, 2320.54, '2021-04-01', '2', 2021, 'Bank', NULL, '24'),
(7, 364, 1220.2, '2021-04-08', '2', 2021, 'Cash', 1, NULL),
(8, 364, 1200, '2021-02-11', '1', 2021, 'Bank', NULL, '23'),
(9, 365, 6500, '2021-02-12', '2', 2021, 'Bank', NULL, '23'),
(11, 371, 6500, '2021-02-15', '2', 2021, 'Bank', NULL, '23'),
(12, 369, 5400, '2021-02-18', '1', 2021, 'Bank', 0, '23');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `min_value` int(11) NOT NULL,
  `max_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `min_value`, `max_value`) VALUES
(1, 'A+', 90, 100),
(2, 'A', 80, 89),
(3, 'B+', 70, 79),
(4, 'B', 60, 69),
(5, 'C+', 50, 59),
(7, 'C', 45, 49),
(8, 'D', 40, 44),
(9, 'F', 0, 39);

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `beds` varchar(20) NOT NULL,
  `patreon` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`id`, `name`, `beds`, `patreon`) VALUES
(1, 'Zambezi hostel', '232', 'tea-123-0'),
(3, 'JUMBOO hostel', '363', 'tea-123-0'),
(9, 'Zambezi hostel bloc ', '45', 'tea-123-1');

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `salary` double NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `salary`, `img`) VALUES
(2, 'Kasazi Lungu', 'noni_Bitshhh_365', 'd41d8cd98f00b204e980', '2211345', 'stu@uni.co', 'lusaka', 'Female', '1997-09-26', '2021-02-04', 15400, 'Kasazi Lungu_368019.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `img`) VALUES
(1, 'Chilekwa M.J', 'man', '202cb962ac59075b964b07152d234b70', '0971212121', 'dechan@gmail.com', 'Chifubu', 'Male', '1978-08-23', '2021-02-04', 'Chilekwa Mwinga_421164.jpg'),
(2, 'Umang Sighn', 'Lily', '202cb962ac59075b964b07152d234b70', '0971212121', 'gkaunda@hotmail.com', 'Luangwa', 'Female', '2014-03-11', '2021-03-17', '_721860.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `moe_uploads`
--

CREATE TABLE `moe_uploads` (
  `upload_id` int(12) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `file` text NOT NULL,
  `uploaded_by` int(12) NOT NULL,
  `date_added` date NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moe_uploads`
--

INSERT INTO `moe_uploads` (`upload_id`, `title`, `description`, `file`, `uploaded_by`, `date_added`, `url`) VALUES
(6, 'National Education\r\nPolicy 2023', 'National Curriculum Framework\r\nNational Education\r\nPolicy 2023', 'NEP_Final_English_0.pdf', 28, '2024-01-28', ''),
(7, 'National Curriculum Framework\r\nfor School Education\r\n2023', 'National Curriculum Framework\r\nfor School Education\r\n2023', 'NEP_Final_English_0.pdf', 28, '2024-01-28', ''),
(8, 'Draft Education and Skills Sector Plan', 'Draft Education and Skills Sector Plan', 'Review of the Ministry of Education Sector Plan.pdf', 28, '2024-01-28', 'http://elibrary.clce.ac.zm:8080/jspui/bitstream/123456789/45/1/Review%20of%20the%20Ministry%20of%20Education%20Sector%20Plan.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `yt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `teacher_id`, `class`, `subject_id`, `name`, `title`, `file`, `video`, `date`, `audio`, `yt`) VALUES
(1, 7, 42, 0, 'Assignment due date has been extended to next week', '', '', '', 'March 2, 2021, 5:33 pm', NULL, NULL),
(3, 7, 5, 0, 'Here is a new notification for class 10 B Physics students.', '', '', '', 'March 31, 2021, 12:52 pm', NULL, NULL),
(4, 7, 43, 5, 'Here is another notification for class 10 A Physics students.\r\n\r\nThis one also has file to back it up\r\n\r\n', '', 'New Doc 2018-08-04.pdf', '', 'March 31, 2021, 12:54 pm', NULL, NULL),
(6, 7, 42, 5, 'Here is another notification for class 10 A Physics students.\r\n\r\nThis one also has file to back it up\r\n\r\n', '', 'New Doc 2018-08-04.pdf', '', 'March 31, 2021, 1:08 pm', NULL, NULL),
(8, 7, 42, 5, 'Be informed that there will be a test in Monday and yall must show up to write', 'Test on monday', '', '', 'March 31, 2021, 1:20 pm', NULL, NULL),
(20, 11, 42, 12, 'eeeeeeeeeeeeeeeeeeeeeeeeeee', 'New video tuts', 'ZAGO Website Outline.pdf', '404 Not Found.mp4', 'July 9, 2021, 6:09 pm', '', ''),
(23, 11, 42, 12, 'This is a new notice', 'New Notice', '', '', 'July 9, 2021, 6:23 pm', '', 'XqZsoesa55w');

-- --------------------------------------------------------

--
-- Table structure for table `other_staff`
--

CREATE TABLE `other_staff` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `other_staff`
--

INSERT INTO `other_staff` (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `img`) VALUES
(1, 'totallykds two', 'others', '202cb962ac59075b964b07152d234b70', '0777190130', 'totallykids.daycare.nursery@gmail.com', 'Plot 1872M 3rd street, Ibex Hill', '', '0000-00-00', '0000-00-00', 'totallykds two_200641.jpg'),
(2, 'totallykds', '7', '202cb962ac59075b964b07152d234b70', '0777190130', 'totallykids.daycare.nursery@gmail.com', 'Plot 1872M 3rd street, Ibex Hill', 'Male', '2020-06-01', '2021-06-15', 'totallykds_211901.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fathername` varchar(20) NOT NULL,
  `mothername` varchar(20) NOT NULL,
  `fatherphone` varchar(13) NOT NULL,
  `motherphone` varchar(13) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `username`, `email`, `password`, `fathername`, `mothername`, `fatherphone`, `motherphone`, `address`) VALUES
(7, 'parents', 'email@parents.com', 'd41d8cd98f00b204e980', 'Luke Chisanga', 'Daph Chisanga', '11223343', '00998877', 'Luangwa'),
(8, 'thesofias', 'thesofias@email.com', 'd41d8cd98f00b204e980', 'John Sofia', 'Theresa Sofia', '11223344', '00998877', 'Luangwa'),
(9, 'jc', 'joe@yahoo.com', '202cb962ac59075b964b', 'Joe Chibangu', 'Mary Chibangu', '11223344', '00998877', 'Luangwa'),
(10, 'mj', 'mule@hotmail.com', '202cb962ac59075b964b', 'Monde Zimba', 'Mule Zimba', '11223344', '00998877', 'Chifubu'),
(11, 'the_queen_median', 'stuparent@uni.com', '202cb962ac59075b964b', 'Marvin Nyerenda', 'Janice Nchonga', '11223344', '00998874', 'Chifubu');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paid_by` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `notes` text NOT NULL,
  `date_paid` date NOT NULL,
  `method` varchar(255) NOT NULL,
  `recieved_by` int(11) NOT NULL,
  `bank_acc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `paid_by`, `description`, `notes`, `date_paid`, `method`, `recieved_by`, `bank_acc`) VALUES
(1, 2000, 'Tina Ozzy', 'Bus fuel', 'Bus need fuel', '2021-03-19', 'Bank', 0, 24),
(2, 200000, 'Xandi', 'HFLP', 'Health and financial Literacy program', '2021-03-20', 'Bank', 0, 24);

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE `payment_modes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `name`) VALUES
(1, 'Cash'),
(2, 'Bank');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `teacherid` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `courseid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `marks` double NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `class_id`, `subject_id`, `marks`, `name`, `date`, `comment`) VALUES
(173, 364, 42, 12, 98, 'Mid term test', '2021-02-18', 'Great work Noni'),
(174, 365, 42, 12, 45, 'Mid term test', '2021-02-18', 'Work Harder, Jeromy'),
(175, 366, 42, 12, 76, 'Mid term test', '2021-02-18', 'Alright kate, keep it up'),
(176, 367, 43, 12, 76, 'Mid term test', '2021-02-18', 'Alright mel! keep it up'),
(177, 368, 43, 12, 23, 'Mid term test', '2021-02-18', 'You have failed cave boy'),
(178, 369, 43, 12, 65, 'Mid term test', '2021-02-18', 'Cool mike. 65 is not that bad'),
(179, 370, 43, 12, 88, 'Mid term test', '2021-02-18', 'Good job, keep it up though, Zulu'),
(180, 371, 43, 12, 49, 'Mid term test', '2021-02-18', 'Bellow average'),
(182, 364, 42, 5, 85, 'Mid term test', '2021-02-18', 'Great work, noni'),
(183, 365, 42, 5, 90, 'Mid term test', '2021-02-18', 'awesome work, jery'),
(184, 366, 42, 5, 100, 'Mid term test', '2021-02-18', 'Fantastic! cate.'),
(185, 367, 43, 5, 38, 'Mid term test', '2021-02-18', 'mel is failing'),
(186, 368, 43, 5, 48, 'Mid term test', '2021-02-18', 'cave is failing, too'),
(187, 369, 43, 5, 58, 'Mid term test', '2021-02-18', 'mike is av. but must do better'),
(188, 370, 43, 5, 68, 'Mid term test', '2021-02-18', 'zulu is getting bettter'),
(189, 371, 43, 5, 78, 'Mid term test', '2021-02-18', 'joma tech has improved'),
(196, 364, 42, 12, 98, 'Music Assignment 1', '2021-03-30', 'Great work ZahZhi... Keep it up'),
(198, 364, 42, 12, 79, 'Music Assignment Two', '2021-03-31', 'OKAY work on ass two muzik. 79 not bad zazi');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(12) NOT NULL,
  `name` text NOT NULL,
  `province` text NOT NULL,
  `district` text NOT NULL,
  `address` text NOT NULL,
  `gps_lat` text NOT NULL,
  `gps_long` text NOT NULL,
  `emis_number` text NOT NULL,
  `sch_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `name`, `province`, `district`, `address`, `gps_lat`, `gps_long`, `emis_number`, `sch_type`) VALUES
(4, 'Choma Community School', 'Southern Province', 'Choma', 'Choma', '000213311', '0.256885', '0.2665566', 'Community School'),
(5, 'Kabwe Community School', 'Central Province', 'Kabwe', 'Kabwe Central', '0002133113', '0.253', '0.26653', 'University');

-- --------------------------------------------------------

--
-- Table structure for table `school_info`
--

CREATE TABLE `school_info` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tag` varchar(120) NOT NULL,
  `dn` varchar(11) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `address` varchar(35) NOT NULL,
  `phone` int(13) NOT NULL,
  `email` varchar(35) NOT NULL,
  `est` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_info`
--

INSERT INTO `school_info` (`id`, `name`, `tag`, `dn`, `logo`, `location`, `address`, `phone`, `email`, `est`) VALUES
(2, 'ZOCS-VLE', 'Redefining learning in the modern world.', 'ManCityAcc', 'logo_386167.jpg', 'Mansa', '232rd Meanwood ext.', 971212121, 'stu@uni.co', '2011-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `total_term_fees` double NOT NULL,
  `date_due_1` varchar(10) NOT NULL,
  `date_due_2` varchar(10) NOT NULL,
  `date_due_3` varchar(10) NOT NULL,
  `currency` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `total_term_fees`, `date_due_1`, `date_due_2`, `date_due_3`, `currency`) VALUES
(1, 6000, '01-1', '06-1', '09-1', 'ZMW');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `address` varchar(30) NOT NULL,
  `salary` double NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `addmissiondate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `parentid` int(20) NOT NULL,
  `class_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `username`, `password`, `phone`, `email`, `sex`, `dob`, `addmissiondate`, `address`, `parentid`, `class_id`, `img`) VALUES
(364, 'Kasazi Lungu', 'noni', '202cb962ac59075b964b07152d234b70', '0965157033', 'student@university-3.com', 'Female', '1999-07-21', '2021-02-10', 'Mansa', 7, 42, '_736568.jpg'),
(365, 'Jeromy Mumba', 'jeromy', '202cb962ac59075b964b07152d234b70', '0950482937', 'student@uni.com', 'Male', '1999-06-23', '2021-02-10', 'ndola', 7, 42, 'Jeromy Mumba_426695.jpg'),
(366, 'Catherine Chomba', 'muta', '202cb962ac59075b964b07152d234b70', '2211345', 'stu@uni-highschool.co', '', '1992-07-31', '2021-02-10', 'lusaka', 6, 42, 'Catherine Comba_340228.jpg'),
(367, 'Melvin Nkandu', 'mel', '202cb962ac59075b964b07152d234b70', '09890987', 'student@uni.com', 'Male', '2004-02-11', '2021-02-02', 'ndola', 7, 43, 'Melvin Nkandu_546186.jpg'),
(368, 'Kelvin Pule', 'kp', '202cb962ac59075b964b07152d234b70', '09890987', 'student@university.com', 'Male', '1995-02-07', '2021-02-15', 'lusaka west', 10, 43, 'Kelvin Pule_567902.jpg'),
(369, 'Mike Kapaya', 'mk', '202cb962ac59075b964b07152d234b70', '09890987', 'student@university.com', 'Male', '2000-09-28', '2021-02-15', 'Makeni west', 9, 43, 'Mike Kapaya_315567.jpg'),
(370, 'Zulu lombe', 'zezulu', '202cb962ac59075b964b07152d234b70', '0976564321', 'student@highschool.com', 'Female', '1999-09-25', '2021-02-15', 'Ndola central', 7, 43, 'Zulu lombe_274194.jpg'),
(371, 'Joma Musonda', 'jmuzo', '202cb962ac59075b964b07152d234b70', '0965482937', 'student@university.com', 'Male', '2012-02-15', '2021-02-15', 'lusaka west', 7, 42, 'Joma Musonda_810919.jpg'),
(372, '', 'admin', '202cb962ac59075b964b07152d234b70', '', '', '', '0000-00-00', '0000-00-00', '', 7, 42, ''),
(373, '', 'admin', '202cb962ac59075b964b07152d234b70', '', '', '', '0000-00-00', '0000-00-00', '', 7, 42, '');

-- --------------------------------------------------------

--
-- Table structure for table `student_notices`
--

CREATE TABLE `student_notices` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `audio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_notices`
--

INSERT INTO `student_notices` (`id`, `student_id`, `class`, `subject_id`, `name`, `title`, `file`, `video`, `date`, `audio`) VALUES
(1, 0, 42, 5, 'Some notice', 'Parents Vid 1', 'Teacher - Chesco School Management System (1).pdf', '404 Not Found.mp4', 'June 17, 2021, 6:06 pm', NULL),
(2, 0, 42, 5, 'here is the audio of a kid saying stuff', 'New audio file', '', '', 'June 19, 2021, 9:13 pm', NULL),
(4, 0, 42, 5, 'here is the audio of a kid saying cool stuff', 'New audio file 2', '', '', 'June 19, 2021, 9:30 pm', '02 The Wave.mp3'),
(5, 363, 42, 6, 'student id', 'Is Student working', '', '', 'June 28, 2021, 8:06 pm', ''),
(6, 363, 42, 12, 'student in music', 'student in music', 'ZAGO Website Outline.pdf', '', 'June 28, 2021, 8:09 pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`id`, `student_id`, `subject_id`) VALUES
(189, 366, 5),
(190, 366, 6),
(191, 366, 7),
(192, 366, 8),
(193, 366, 9),
(194, 366, 10),
(195, 366, 11),
(196, 366, 12),
(197, 367, 5),
(198, 367, 6),
(199, 367, 7),
(200, 367, 8),
(201, 367, 10),
(202, 367, 12),
(203, 367, 14),
(204, 368, 5),
(205, 368, 6),
(206, 368, 7),
(207, 368, 8),
(208, 368, 9),
(209, 368, 10),
(210, 368, 13),
(211, 368, 15),
(212, 369, 5),
(213, 369, 6),
(214, 369, 7),
(215, 369, 8),
(216, 369, 9),
(217, 369, 10),
(218, 369, 11),
(219, 369, 12),
(220, 369, 13),
(221, 369, 14),
(222, 369, 15),
(223, 370, 5),
(224, 370, 6),
(225, 370, 7),
(226, 370, 8),
(227, 370, 10),
(228, 370, 11),
(229, 370, 12),
(230, 370, 15),
(258, 371, 5),
(259, 371, 6),
(260, 371, 7),
(261, 371, 8),
(262, 371, 9),
(263, 371, 10),
(264, 371, 11),
(273, 365, 5),
(274, 365, 6),
(275, 365, 7),
(276, 365, 8),
(277, 365, 10),
(278, 365, 12),
(279, 365, 13),
(280, 365, 14),
(281, 364, 5),
(282, 364, 6),
(283, 364, 7),
(284, 364, 8),
(285, 364, 10),
(286, 364, 12),
(287, 364, 15),
(288, 364, 16);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(5, 'Physics'),
(6, 'Art and Design'),
(7, 'Chemistry'),
(8, 'Mathermatics'),
(9, 'Commerce'),
(10, 'English'),
(11, 'Psychology'),
(12, 'Music'),
(13, 'Political Science'),
(14, 'SDS'),
(15, 'Biology'),
(16, 'Mathermatics');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(30) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `salary` double NOT NULL,
  `img` varchar(100) NOT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `salary`, `img`, `user_type`) VALUES
(7, 'Marys Magambo', 'teacher-mary', '3544848f820b9d94a3f3871a382cf138', '0971212121', 'dechan@gmail.com', 'Luangwa', 'Female', '2020-08-04', '0000-00-00', 25400, 'Mary Magambo_230080.jpg', ''),
(8, 'Rudo Mwewa Phiri', 'rudophiri', '202cb962ac59075b964b07152d234b70', '2211345', 'dechan@gmail.com', 'Chifubu', 'Male', '1997-01-07', '0000-00-00', 19000, 'Proff Rudo Phiri_325762.jpg', ''),
(11, 'Money Banda', 'teacher-banda', 'd41d8cd98f00b204e9800998ecf8427e', '2211345', 'email@ad.me.com', 'chamba valley 2', 'Male', '2021-01-25', '2020-12-24', 25400, '_872317.jpg', ''),
(13, 'Nyirenda Musunga', 'mss_msunda21', 'd41d8cd98f00b204e9800998ecf8427e', '0971212121', 'gkaunda@hotmail.com', 'Muchinga', 'Female', '2021-02-16', '2021-02-03', 19000, 'Nyirenda Musunga_418207.jpg', ''),
(16, 'zocs', 'zocs', '3544848f820b9d94a3f3871a382cf138', '09875552', 'choolwe1992@gmail.com', 'Lusaka.', 'Male', '0000-00-00', '0000-00-00', 0, 'zocs_350384.jpg', ''),
(28, 'choolwe ngandu', 'support', '3f0ab42d59ea29fbbbc50175c7de6781', '0955104708', 'choolwe1992@gmail.com', 'Lusaka.', 'Male', '0000-00-00', '0000-00-00', 0, 'choolwe ngandu_325410.jpg', 'MOE');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject_class`
--

CREATE TABLE `teacher_subject_class` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_subject_class`
--

INSERT INTO `teacher_subject_class` (`id`, `teacher_id`, `subject_id`, `class_id`) VALUES
(21, 7, 5, 42),
(22, 7, 5, 43),
(23, 11, 12, 42),
(24, 11, 12, 43);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(155) NOT NULL,
  `user_role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `name`, `username`, `password`, `user_role`) VALUES
(7, 'tea_8', 'Rudo Mwewa Phiri', 'rudophiri', '202cb962ac59075b964b07152d234b70', 'teacher'),
(24, 'tea_11', 'Money Banda', 'teacher-banda', 'd41d8cd98f00b204e9800998ecf8427e', 'teacher'),
(33, 'acc_1', 'Douglas Mwansa', 'acc', '202cb962ac59075b964b07152d234b70', 'accountant'),
(34, 'man_1', 'totallykds two', 'man', '202cb962ac59075b964b07152d234b70', 'manager'),
(37, 'stu_364', 'Kasazi Lungu', 'noni', '202cb962ac59075b964b07152d234b70', 'student'),
(38, 'stu_365', 'Jeromy Mumba', 'jeromy', '202cb962ac59075b964b07152d234b70', 'student'),
(39, 'stu_366', 'Catherine Chomba', 'muta', '202cb962ac59075b964b07152d234b70', 'student'),
(40, 'pa_7', 'Daph Chisanga', 'parents', 'd41d8cd98f00b204e9800998ecf8427e', 'parent'),
(44, 'ad_5', 'Admin', 'admin', '202cb962ac59075b964b07152d234b70', 'admin'),
(45, 'stu_367', 'Melvin Nkandu', 'mel', '202cb962ac59075b964b07152d234b70', 'student'),
(46, 'pa_8', 'Theresa Sofia', 'thesofias', 'd41d8cd98f00b204e9800998ecf8427e', 'parent'),
(47, 'pa_9', 'Mary Chibangu', 'jc', '202cb962ac59075b964b07152d234b70', 'parent'),
(48, 'pa_10', 'Mule Zimba', 'mj', '202cb962ac59075b964b07152d234b70', 'parent'),
(49, 'stu_368', 'Kelvin Pule', 'kp', '202cb962ac59075b964b07152d234b70', 'student'),
(50, 'stu_369', 'Mike Kapaya', 'mk', '202cb962ac59075b964b07152d234b70', 'student'),
(51, 'stu_370', 'Zulu lombe', 'zezulu', '202cb962ac59075b964b07152d234b70', 'student'),
(52, 'stu_371', 'Joma Musonda', 'jmuzo', '202cb962ac59075b964b07152d234b70', 'student'),
(53, 'pa_11', 'Janice Nchonga', 'the_queen_median', '202cb962ac59075b964b07152d234b70', 'parent'),
(54, 'man_2', 'Umang Sighn', 'Lily', '202cb962ac59075b964b07152d234b70', 'manager'),
(59, 'tea_16', 'zocs', 'zocs', '202cb962ac59075b964b07152d234b70', 'ZOCS'),
(68, 'tea_28', 'choolwe ngandu', 'support', '3f0ab42d59ea29fbbbc50175c7de6781', 'MOE');

-- --------------------------------------------------------

--
-- Table structure for table `_keys`
--

CREATE TABLE `_keys` (
  `id` int(11) NOT NULL,
  `_key` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_keys`
--

INSERT INTO `_keys` (`id`, `_key`, `date`) VALUES
(11, '1613-5053-0365-0200-2021', '2021-10-05 07:31:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountants`
--
ALTER TABLE `accountants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ass_notice`
--
ALTER TABLE `ass_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_student` (`student_id`),
  ADD KEY `attendance_teacher` (`teacher_id`),
  ADD KEY `attendance_class_id` (`class_id`);

--
-- Indexes for table `availablecourse`
--
ALTER TABLE `availablecourse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_student` (`monitor_id`),
  ADD KEY `class_teacher` (`teacher_id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_students_class_id` (`class_id`),
  ADD KEY `class_students_student_id` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dean_id` (`dean_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moe_uploads`
--
ALTER TABLE `moe_uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_staff`
--
ALTER TABLE `other_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_modes`
--
ALTER TABLE `payment_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_result_id` (`student_id`),
  ADD KEY `class_results` (`class_id`),
  ADD KEY `subject_results_id` (`subject_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `school_info`
--
ALTER TABLE `school_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`),
  ADD KEY `class_student_id` (`class_id`),
  ADD KEY `parent_student_id_foreign` (`parentid`);

--
-- Indexes for table `student_notices`
--
ALTER TABLE `student_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_subject_student_id` (`student_id`),
  ADD KEY `student_subject_subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `teacher_subject_class`
--
ALTER TABLE `teacher_subject_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_subject_teacherID` (`teacher_id`),
  ADD KEY `teacher_subjectID` (`subject_id`),
  ADD KEY `teacher_subject_classID` (`class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_keys`
--
ALTER TABLE `_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `_key` (`_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountants`
--
ALTER TABLE `accountants`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ass_notice`
--
ALTER TABLE `ass_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `availablecourse`
--
ALTER TABLE `availablecourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `moe_uploads`
--
ALTER TABLE `moe_uploads`
  MODIFY `upload_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `other_staff`
--
ALTER TABLE `other_staff`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_modes`
--
ALTER TABLE `payment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `school_info`
--
ALTER TABLE `school_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `student_notices`
--
ALTER TABLE `student_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_subjects`
--
ALTER TABLE `student_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `teacher_subject_class`
--
ALTER TABLE `teacher_subject_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `_keys`
--
ALTER TABLE `_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_class_id` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_students`
--
ALTER TABLE `class_students`
  ADD CONSTRAINT `class_students_class_id` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_students_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculty_teacher` FOREIGN KEY (`dean_id`) REFERENCES `teachers` (`id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `class_results` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_result_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_results_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD CONSTRAINT `student_subject_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_subject_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_subject_class`
--
ALTER TABLE `teacher_subject_class`
  ADD CONSTRAINT `teacher_subjectID` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_subject_classID` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_subject_teacherID` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
