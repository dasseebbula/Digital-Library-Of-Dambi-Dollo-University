-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 09:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dadu_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `edition` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('available','borrowed') DEFAULT 'available',
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `isbn`, `edition`, `publisher`, `department`, `cover_image`, `status`, `upload_date`) VALUES
(6, 'udufydyufyd', 'uhhyyyyyyy', '33333333333333333333', '', '', '', NULL, 'available', '2024-12-28 20:18:21'),
(8, 'computer2', 'dr timber2', '98775635262327', '', '', '', NULL, 'available', '2024-12-28 20:35:04'),
(9, 'organicchemistry', 'dr tortoran', '98733333333333333', '', '', '', NULL, 'borrowed', '2024-12-28 20:46:52'),
(11, 'organicchemistry123', 'dr tortoran123', '98733333333333333', '', '', '', NULL, 'borrowed', '2024-12-28 21:04:58'),
(12, 'Java', 'timb', '98733555677899', '', '', '', NULL, 'available', '2024-12-28 21:07:36'),
(13, 'databases', 'dr timber', '98733333333333333', '', '', '', NULL, 'available', '2024-12-31 14:06:50'),
(14, 'ffffflll', 'edfkdmf', '03232333', '', '', '', NULL, 'available', '2025-04-06 16:03:23'),
(15, 'javascript', 'Dbb', '7897387342562', '', 'the millionaire', 'computerscience', NULL, 'available', '2025-04-24 20:58:41'),
(16, 'Introduction to Quantum Mechanics', 'A.C.phillips', '470853239', '', '2003', 'Physics', NULL, 'available', '2025-04-30 16:47:12'),
(17, 'Modern Physics', 'Serway/ Moses/Moyer', '9788131517482', '', '2018', 'Physics', NULL, 'available', '2025-04-30 17:13:52'),
(18, 'c++', 'eddd', '9788131517482', '3', '2003', 'computerscience', NULL, 'available', '2025-05-01 09:37:04'),
(19, 'c++', 'eddd', '9788131517482', '3', '2003', 'computerscience', NULL, 'available', '2025-05-01 09:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrow_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `borrow_date` date NOT NULL DEFAULT current_timestamp(),
  `return_date` date DEFAULT NULL,
  `penalty` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`borrow_id`, `user_id`, `book_id`, `borrow_date`, `return_date`, `penalty`) VALUES
(340, 12, 6, '2025-05-01', '2025-05-01', '0.00'),
(341, 12, 6, '2025-04-01', '2025-05-01', '125.00'),
(342, 12, 8, '2025-04-23', '2025-05-01', '15.00'),
(343, 12, 9, '2025-04-10', '2025-05-01', '80.00'),
(345, 12, 6, '2025-04-16', '2025-05-01', '50.00'),
(346, 12, 11, '2025-01-16', '2025-05-01', '499.79'),
(347, 12, 8, '2025-05-01', '2025-05-01', '0.00'),
(348, 12, 6, '2025-05-01', '2025-05-01', '0.00'),
(349, 12, 8, '2025-05-01', '2025-05-01', '0.00'),
(350, 12, 9, '2025-05-01', NULL, '0.00'),
(351, 12, 11, '2025-05-01', NULL, '0.00'),
(352, 12, NULL, '2025-05-08', NULL, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `borrow_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `read_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `username`, `borrow_id`, `message`, `read_status`) VALUES
(1, 12, 'student', 340, 'time is up ', 1),
(2, 12, 'student', 341, 'time is up ', 1),
(3, 12, 'student', 342, 'time is up ', 1),
(4, 12, 'student', 343, 'time is up ', 1),
(5, 12, 'student', 345, 'time is up ', 1),
(6, 12, 'student', 346, 'time is up ', 1),
(7, 12, 'student', 347, 'time is up ', 1),
(8, 12, 'student', 348, 'time is up ', 1),
(9, 12, 'student', 349, 'time is up ', 1),
(10, 12, 'student', 350, 'time is up ', 1),
(11, 12, 'student', 351, 'time is up ', 1),
(12, 12, 'student', 340, 'return on time', 1),
(13, 12, 'student', 341, 'return on time', 1),
(14, 12, 'student', 342, 'return on time', 1),
(15, 12, 'student', 343, 'return on time', 1),
(16, 12, 'student', 345, 'return on time', 1),
(17, 12, 'student', 346, 'return on time', 1),
(18, 12, 'student', 347, 'return on time', 1),
(19, 12, 'student', 348, 'return on time', 1),
(20, 12, 'student', 349, 'return on time', 1),
(21, 12, 'student', 350, 'return on time', 1),
(22, 12, 'student', 351, 'return on time', 1),
(23, 12, 'student', 340, 'kjjef', 1),
(24, 12, 'student', 341, 'kjjef', 1),
(25, 12, 'student', 342, 'kjjef', 1),
(26, 12, 'student', 343, 'kjjef', 1),
(27, 12, 'student', 345, 'kjjef', 1),
(28, 12, 'student', 346, 'kjjef', 1),
(29, 12, 'student', 347, 'kjjef', 1),
(30, 12, 'student', 348, 'kjjef', 1),
(31, 12, 'student', 349, 'kjjef', 1),
(32, 12, 'student', 350, 'kjjef', 1),
(33, 12, 'student', 351, 'kjjef', 1),
(34, 12, 'student', 340, 'ejhjjrhe', 1),
(35, 12, 'student', 341, 'ejhjjrhe', 1),
(36, 12, 'student', 342, 'ejhjjrhe', 1),
(37, 12, 'student', 343, 'ejhjjrhe', 1),
(38, 12, 'student', 345, 'ejhjjrhe', 1),
(39, 12, 'student', 346, 'ejhjjrhe', 1),
(40, 12, 'student', 347, 'ejhjjrhe', 1),
(41, 12, 'student', 348, 'ejhjjrhe', 1),
(42, 12, 'student', 349, 'ejhjjrhe', 1),
(43, 12, 'student', 350, 'ejhjjrhe', 1),
(44, 12, 'student', 351, 'ejhjjrhe', 1),
(45, 12, 'student', 340, 'hello', 1),
(46, 12, 'student', 341, 'hello', 1),
(47, 12, 'student', 342, 'hello', 1),
(48, 12, 'student', 343, 'hello', 1),
(49, 12, 'student', 345, 'hello', 1),
(50, 12, 'student', 346, 'hello', 1),
(51, 12, 'student', 347, 'hello', 1),
(52, 12, 'student', 348, 'hello', 1),
(53, 12, 'student', 349, 'hello', 1),
(54, 12, 'student', 350, 'hello', 1),
(55, 12, 'student', 351, 'hello', 1),
(56, 12, 'student', 340, 'hhhhhh', 1),
(57, 12, 'student', 341, 'hhhhhh', 1),
(58, 12, 'student', 342, 'hhhhhh', 1),
(59, 12, 'student', 343, 'hhhhhh', 1),
(60, 12, 'student', 345, 'hhhhhh', 1),
(61, 12, 'student', 346, 'hhhhhh', 1),
(62, 12, 'student', 347, 'hhhhhh', 1),
(63, 12, 'student', 348, 'hhhhhh', 1),
(64, 12, 'student', 349, 'hhhhhh', 1),
(65, 12, 'student', 350, 'hhhhhh', 1),
(66, 12, 'student', 351, 'hhhhhh', 1),
(67, 12, 'student', 340, 'uhuhkj', 1),
(68, 12, 'student', 341, 'uhuhkj', 1),
(69, 12, 'student', 342, 'uhuhkj', 1),
(70, 12, 'student', 343, 'uhuhkj', 1),
(71, 12, 'student', 345, 'uhuhkj', 1),
(72, 12, 'student', 346, 'uhuhkj', 1),
(73, 12, 'student', 347, 'uhuhkj', 1),
(74, 12, 'student', 348, 'uhuhkj', 1),
(75, 12, 'student', 349, 'uhuhkj', 1),
(76, 12, 'student', 350, 'uhuhkj', 1),
(77, 12, 'student', 351, 'uhuhkj', 1),
(78, 12, 'student', 340, 'klkl;k;lk;', 1),
(79, 12, 'student', 341, 'klkl;k;lk;', 1),
(80, 12, 'student', 342, 'klkl;k;lk;', 1),
(81, 12, 'student', 343, 'klkl;k;lk;', 1),
(82, 12, 'student', 345, 'klkl;k;lk;', 1),
(83, 12, 'student', 346, 'klkl;k;lk;', 1),
(84, 12, 'student', 347, 'klkl;k;lk;', 1),
(85, 12, 'student', 348, 'klkl;k;lk;', 1),
(86, 12, 'student', 349, 'klkl;k;lk;', 1),
(87, 12, 'student', 350, 'klkl;k;lk;', 1),
(88, 12, 'student', 351, 'klkl;k;lk;', 1),
(89, 12, 'student', 340, 'iokhl', 1),
(90, 12, 'student', 341, 'iokhl', 1),
(91, 12, 'student', 342, 'iokhl', 1),
(92, 12, 'student', 343, 'iokhl', 1),
(93, 12, 'student', 345, 'iokhl', 1),
(94, 12, 'student', 346, 'iokhl', 1),
(95, 12, 'student', 347, 'iokhl', 1),
(96, 12, 'student', 348, 'iokhl', 1),
(97, 12, 'student', 349, 'iokhl', 1),
(98, 12, 'student', 350, 'iokhl', 1),
(99, 12, 'student', 351, 'iokhl', 1),
(100, 12, 'student', 340, 'kk', 0),
(101, 12, 'student', 341, 'kk', 0),
(102, 12, 'student', 342, 'kk', 0),
(103, 12, 'student', 343, 'kk', 0),
(104, 12, 'student', 345, 'kk', 0),
(105, 12, 'student', 346, 'kk', 0),
(106, 12, 'student', 347, 'kk', 0),
(107, 12, 'student', 348, 'kk', 0),
(108, 12, 'student', 349, 'kk', 0),
(109, 12, 'student', 350, 'kk', 0),
(110, 12, 'student', 351, 'kk', 0),
(111, 12, 'student', 340, 'ggg', 0),
(112, 12, 'student', 341, 'ggg', 0),
(113, 12, 'student', 342, 'ggg', 0),
(114, 12, 'student', 343, 'ggg', 0),
(115, 12, 'student', 345, 'ggg', 0),
(116, 12, 'student', 346, 'ggg', 0),
(117, 12, 'student', 347, 'ggg', 0),
(118, 12, 'student', 348, 'ggg', 0),
(119, 12, 'student', 349, 'ggg', 0),
(120, 12, 'student', 350, 'ggg', 0),
(121, 12, 'student', 351, 'ggg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notificationss`
--

CREATE TABLE `notificationss` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `read_status` tinyint(4) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notificationss`
--

INSERT INTO `notificationss` (`id`, `user_id`, `message`, `read_status`, `created_at`) VALUES
(3, 0, 'time is up', 1, '0000-00-00'),
(12, 0, 'jepkf', 1, '0000-00-00'),
(13, 0, 'jjjj', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `idnum` varchar(255) NOT NULL,
  `entry_date` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','circulation','student') NOT NULL DEFAULT 'circulation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `idnum`, `entry_date`, `department`, `email`, `username`, `password`, `role`) VALUES
(9, 'Abdi', 'D', 'fdrt56', '', 'chemitry', 'des@gmail.com', 'admin', '$2y$10$hUwCKVbzSlqB8da16BM.5ujM8YblPAZWmtAjWmuNPsgS12CD1mQS2', 'admin'),
(12, 'Bonsa', 'C', 'dytrtrutr5', '', 'biology', 'dbnhj6@gmail.com', 'student', '$2y$10$3iSnwQSrAqtv5ChRCBk/nOl8N1z5V6gHppIQyEEU0PGNXaQmsL6Y2', 'student'),
(13, 'Tola', 'P', '4768ghgfh', '', 'IT', 'desalegnbekele2016@gmail.com', 'hurube', '$2y$10$uCz8dvUFRGm/CYDrQEZS8uHgP2hB.3wdmQOMTxegZ.eiBAE4kiBg2', 'circulation'),
(21, 'Ayyoo', 'kenea', '789374gsdsbd', '2025-04-10', 'Physics', 'desalegnbekele2016@gmail.com', 'Ayyoo', '$2y$10$2owjGtdYEwkmR2pcrfQukeLFbRriTbFGF3Vs0v7pxns3hnQKX5OPW', 'circulation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `borrow_id` (`borrow_id`);

--
-- Indexes for table `notificationss`
--
ALTER TABLE `notificationss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `notificationss`
--
ALTER TABLE `notificationss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`borrow_id`) REFERENCES `borrows` (`borrow_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
