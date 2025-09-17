-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 01:45 PM
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
  `publisher` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `status` enum('available','borrowed') DEFAULT 'available',
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `isbn`, `publisher`, `department`, `cover_image`, `filename`, `status`, `upload_date`) VALUES
(6, 'udufydyufyd', 'uhhyyyyyyy', '33333333333333333333', '', '', 'Screenshot (2).png', '', 'borrowed', '2024-12-28 20:18:21'),
(8, 'computer2', 'dr timber2', '98775635262327', '', '', NULL, 'NGAT02042816_result.pdf', 'borrowed', '2024-12-28 20:35:04'),
(9, 'organicchemistry', 'dr tortoran', '98733333333333333', '', '', NULL, 'Yonas Balcha.pdf', 'borrowed', '2024-12-28 20:46:52'),
(11, 'organicchemistry123', 'dr tortoran123', '98733333333333333', '', '', NULL, 'Yonas Balcha.pdf', 'available', '2024-12-28 21:04:58'),
(12, 'Java', 'timb', '98733555677899', '', '', NULL, 'model exam  easy or simply .pdf', 'available', '2024-12-28 21:07:36'),
(13, 'databases', 'dr timber', '98733333333333333', '', '', NULL, 'Yonas Balcha.pdf', 'available', '2024-12-31 14:06:50'),
(14, 'ffffflll', 'edfkdmf', '03232333', '', '', 'Banner.jpg', 'letter.pdf', 'available', '2025-04-06 16:03:23'),
(15, 'javascript', 'Dbb', '7897387342562', 'the millionaire', 'computerscience', '396723547_122119107470062357_26393585355319506_n.jpg', 'Kallattii .pdf', 'borrowed', '2025-04-24 20:58:41');

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
(283, 12, NULL, '2025-04-24', NULL, '0.00'),
(284, 12, 6, '2025-04-24', NULL, '0.00'),
(285, 12, 8, '2025-04-24', NULL, '0.00'),
(286, 12, 9, '2025-04-24', NULL, '0.00'),
(287, 12, 15, '2025-04-24', '2025-04-24', '0.00'),
(288, 12, NULL, '2025-04-24', NULL, '0.00'),
(289, 12, 15, '2025-04-24', NULL, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `educationallevel` varchar(250) DEFAULT NULL,
  `position` varchar(250) DEFAULT NULL,
  `reference` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `role` enum('admin','staff','manager','Expert') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `fname`, `lname`, `gender`, `department`, `educationallevel`, `position`, `reference`, `password`, `username`, `role`) VALUES
(28, 'Desalegn', 'Bekele', 'm', 'LDSD', 'BSc Computer Science', 'DL TL', 'Almaz', 'dassee2016', 'dassee2016', 'admin'),
(29, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', '123', 'hurube', 'Expert'),
(30, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', '', '', 'admin'),
(31, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', NULL, NULL, 'admin'),
(32, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', NULL, NULL, 'admin'),
(33, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', NULL, NULL, 'admin'),
(34, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', NULL, NULL, 'manager'),
(35, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', NULL, NULL, 'manager'),
(36, 'Hurube', ' Tesfaye', 'female', 'LDSD', 'BSc IT', 'DL Assistant', 'RRR', NULL, NULL, 'manager'),
(37, 'kkk', ' klkl', 'k', 'ict', 'kk', 'jkjklk', 'llllkl', NULL, NULL, 'Expert');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `book_id`, `message`, `created_at`) VALUES
(1, 11, 13, 'return the book time is up', '2025-04-17 15:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `department`, `book_title`, `quantity`, `order_date`) VALUES
(1, '666878', 'history', 'african history', 1, '2025-04-06 17:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','circulation','student') NOT NULL DEFAULT 'circulation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(9, 'admin', '$2y$10$hUwCKVbzSlqB8da16BM.5ujM8YblPAZWmtAjWmuNPsgS12CD1mQS2', 'admin'),
(10, 'circulation', '$2y$10$VWQNP32HDWZi3px.8dBa6elY0v1LtyeXZCg1ufof6Nr8p6UUcFGnG', 'circulation'),
(11, 'circulation', '$2y$10$D62n2l00b4k.vlofHdL72OCZwdTMbrpyfFSExSkaCWhESuQqkF9QO', 'circulation'),
(12, 'student', '$2y$10$3iSnwQSrAqtv5ChRCBk/nOl8N1z5V6gHppIQyEEU0PGNXaQmsL6Y2', 'student'),
(13, 'hurube', '$2y$10$uCz8dvUFRGm/CYDrQEZS8uHgP2hB.3wdmQOMTxegZ.eiBAE4kiBg2', 'circulation'),
(14, 'director', '$2y$10$3LRimnAWquZonoX6npWjP.TeZbH3j3RxsnGIGHyeFiinIvYnIK/IS', 'admin'),
(16, 'Circulation', '$2y$10$X8ECn2sinIFJU7noxDXq3u8QnlAoYKfvyFspN0x49ENPY/bTHjCGO', 'circulation'),
(17, 'Circulation', '$2y$10$CzbtK03lQlJOfHFD6CLDreSL3Dp9hStlXKMrCR2KLaUxvhV6VUk3i', 'circulation'),
(18, 'Circulation', '$2y$10$GYBgYsXXBqo1kUown5Q0Jeq9gv3b12KNGJUwuipUoexW71reiVrJK', 'circulation'),
(19, 'Ayyee', '$2y$10$kdSwMiTn7gkLvMth8pXRpu2q7xvBcJAF0mL71teQWqQ968nmzydy2', 'circulation');

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
