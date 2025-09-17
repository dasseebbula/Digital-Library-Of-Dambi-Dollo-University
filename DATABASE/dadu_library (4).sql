-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 10:05 AM
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
  `quantity` int(255) NOT NULL,
  `available_qty` int(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('available','on_hold','borrowed','checked_out') DEFAULT 'available',
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `isbn`, `edition`, `publisher`, `department`, `quantity`, `available_qty`, `cover_image`, `status`, `upload_date`) VALUES
(6, 'udufydyufyd', 'uhhyyyyyyy', '33333333333333333333', '', '', 'health', 10, 0, NULL, '', '2024-12-28 20:18:21'),
(8, 'computer2', 'dr timber2', '98775635262327', '', '', '', 10, -16, NULL, 'on_hold', '2024-12-28 20:35:04'),
(9, 'organicchemistry', 'dr tortoran', '98733333333333333', '', '', '', 0, 0, NULL, '', '2024-12-28 20:46:52'),
(11, 'organicchemistry123', 'dr tortoran123', '98733333333333333', '', '', 'Health', 0, 0, NULL, 'on_hold', '2024-12-28 21:04:58'),
(12, 'Javat', 'timb', '98733555677899', '', '', 'computerscience', 60, -1, NULL, 'checked_out', '2024-12-28 21:07:36'),
(13, 'databases', 'dr timber', '98733333333333333', '', '', 'computerscience', 0, 0, NULL, 'on_hold', '2024-12-31 14:06:50'),
(14, 'ffffflll', 'edfkdmf', '03232333', '', '', 'health', 0, 0, NULL, 'available', '2025-04-06 16:03:23'),
(15, 'javascript', 'Dbb', '7897387342562', '', 'the millionaire', 'computer scince', 10, 0, NULL, 'on_hold', '2025-04-24 20:58:41'),
(16, 'Introduction to Quantum Mechanics', 'A.C.phillips', '470853239', '', '2003', 'Physics', 10, -26, NULL, 'available', '2025-04-30 16:47:12'),
(17, 'Modern Physics', 'Serway/ Moses/Moyer', '9788131517482', '', '2018', 'Physics', 10, -24, NULL, 'on_hold', '2025-04-30 17:13:52'),
(18, 'c++', 'eddd', '9788131517482', '3', '2003', 'computerscience', 10, 8, NULL, 'on_hold', '2025-05-01 09:37:04'),
(19, 'c++', 'eddd', '9788131517482', '3', '2003', 'computerscience', 10, -1, NULL, 'on_hold', '2025-05-01 09:38:37'),
(20, 'C#', 'Serway/ Moses/Moyer', '9788131517482', '3', '2003', 'computerscience', 10, -14, 'Screenshot (3).png', 'checked_out', '2025-06-01 05:17:56'),
(21, 'python', 'gggg', '6667899000', '4', 'hhha', 'computerscience', 10, 10, 'Screenshot (5).png', '', '2025-06-01 07:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `book_holds`
--

CREATE TABLE `book_holds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `hold_date` datetime NOT NULL,
  `status` enum('borrowed','checked_out','on_hold','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_holds`
--

INSERT INTO `book_holds` (`id`, `user_id`, `book_id`, `hold_date`, `status`) VALUES
(2, 12, 16, '2025-07-04 21:46:02', 'borrowed'),
(4, 12, 17, '2025-07-04 21:50:20', 'borrowed'),
(5, 12, 11, '2025-07-04 23:09:09', 'borrowed'),
(7, 12, 13, '2025-07-04 23:25:38', 'borrowed'),
(8, 24, 12, '2025-07-04 23:27:24', 'checked_out'),
(10, 12, 16, '2025-07-04 23:37:48', 'borrowed'),
(11, 12, 19, '2025-07-04 23:40:04', 'borrowed'),
(12, 12, 14, '2025-07-04 23:48:58', 'borrowed'),
(14, 12, 8, '2025-07-05 00:23:41', 'borrowed'),
(16, 12, 11, '2025-07-05 00:45:27', 'borrowed'),
(17, 12, 19, '2025-07-05 00:45:40', 'borrowed'),
(18, 12, 14, '2025-07-05 00:55:19', 'borrowed'),
(19, 22, 20, '2025-07-05 00:55:31', 'checked_out'),
(20, 12, 16, '2025-07-05 00:57:37', 'borrowed'),
(21, 12, 17, '2025-07-05 00:57:50', 'borrowed'),
(22, 12, 11, '2025-07-07 11:03:09', 'borrowed'),
(23, 12, 13, '2025-07-07 11:06:56', 'borrowed'),
(24, 26, 11, '2025-07-07 11:19:12', 'checked_out'),
(25, 12, 8, '2025-07-14 08:41:39', 'borrowed'),
(28, 12, 8, '2025-07-16 10:00:13', 'borrowed'),
(29, 12, 14, '2025-07-16 10:00:25', 'borrowed'),
(30, 12, 8, '2025-07-16 10:12:17', 'on_hold'),
(31, 12, 11, '2025-07-16 10:13:23', 'on_hold'),
(34, 12, 14, '2025-07-16 10:56:31', 'borrowed');

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
(350, 12, 9, '2025-05-01', '2025-06-01', '130.00'),
(351, 12, 11, '2025-05-01', '2025-05-21', '75.00'),
(352, 12, NULL, '2025-05-08', NULL, '0.00'),
(353, 12, NULL, '2025-05-21', NULL, '0.00'),
(354, 12, NULL, '2025-05-21', NULL, '0.00'),
(355, 12, 12, '2025-05-21', '2025-05-21', '0.00'),
(356, 12, NULL, '2025-06-01', NULL, '0.00'),
(357, 26, 21, '2025-06-01', '2025-06-01', '0.00'),
(358, 26, NULL, '2025-06-01', NULL, '0.00'),
(359, 26, NULL, '2025-06-01', NULL, '0.00'),
(360, 26, NULL, '2025-06-01', NULL, '0.00'),
(361, 26, 8, '2025-06-01', '2025-06-16', '50.00'),
(362, 12, 11, '2025-06-03', '2025-06-16', '40.00'),
(363, 12, NULL, '2025-06-03', NULL, '0.00'),
(364, 12, 12, '2025-06-03', '2025-06-16', '40.00'),
(365, 12, NULL, '2025-06-03', NULL, '0.00'),
(366, 12, NULL, '2025-06-03', NULL, '0.00'),
(367, 12, NULL, '2025-06-03', NULL, '0.00'),
(368, 12, NULL, '2025-06-03', NULL, '0.00'),
(369, 12, NULL, '2025-06-03', NULL, '0.00'),
(370, 13, NULL, '2025-06-03', NULL, '0.00'),
(371, 12, 13, '2025-06-15', '2025-06-26', '30.00'),
(372, 13, NULL, '2025-06-16', NULL, '0.00'),
(373, 12, 14, '2025-06-16', '2025-07-04', '65.00'),
(374, 12, 16, '2025-06-16', '2025-06-16', '0.00'),
(375, 12, NULL, '2025-06-16', NULL, '0.00'),
(376, 12, NULL, '2025-06-16', NULL, '0.00'),
(377, 12, 15, '2025-06-16', '2025-07-03', '60.00'),
(378, 12, NULL, '2025-06-16', NULL, '0.00'),
(379, 12, 17, '2025-06-16', '2025-06-16', '0.00'),
(380, 12, NULL, '2025-06-16', NULL, '0.00'),
(381, 12, 18, '2025-06-16', '2025-06-16', '0.00'),
(382, 12, 19, '2025-06-16', '2025-07-04', '65.00'),
(383, 12, NULL, '2025-06-25', NULL, '0.00'),
(384, 12, 8, '2025-06-25', '2025-06-26', '-20.00'),
(385, 12, 11, '2025-06-25', '2025-06-26', '-20.00'),
(386, 12, NULL, '2025-06-25', NULL, '0.00'),
(387, 12, NULL, '2025-06-25', NULL, '0.00'),
(388, 12, NULL, '2025-06-25', NULL, '0.00'),
(389, 12, 12, '2025-06-25', '2025-06-26', '-20.00'),
(390, 12, NULL, '2025-06-26', NULL, '0.00'),
(391, 12, NULL, '2025-06-26', NULL, '0.00'),
(392, 12, NULL, '2025-06-26', NULL, '0.00'),
(393, 13, NULL, '2025-06-26', NULL, '0.00'),
(394, 12, NULL, '2025-06-26', NULL, '0.00'),
(395, 12, NULL, '2025-06-27', NULL, '0.00'),
(396, 12, NULL, '2025-07-03', NULL, '0.00'),
(397, 12, 12, '2025-07-03', '2025-07-03', '0.00'),
(398, 12, NULL, '2025-07-03', NULL, '0.00'),
(399, 12, 12, '2025-07-03', '2025-07-04', '-20.00'),
(400, 12, NULL, '2025-07-03', NULL, '0.00'),
(401, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(402, 12, NULL, '2025-07-04', NULL, '0.00'),
(403, 12, 12, '2025-07-04', '2025-07-04', '0.00'),
(404, 12, 11, '2025-07-04', '2025-07-04', '0.00'),
(405, 12, 13, '2025-07-04', '2025-07-04', '0.00'),
(406, 12, 14, '2025-07-04', '2025-07-04', '65.00'),
(407, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(408, 12, 18, '2025-07-04', '2025-07-04', '0.00'),
(409, 12, 17, '2025-07-04', '2025-07-04', '0.00'),
(410, 12, 11, '2025-07-04', '2025-07-04', '0.00'),
(411, 12, 12, '2025-07-04', '2025-07-04', '0.00'),
(412, 12, 13, '2025-07-04', '2025-07-04', '0.00'),
(413, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(414, 12, 17, '2025-07-04', '2025-07-04', '0.00'),
(415, 12, 18, '2025-07-04', '2025-07-04', '0.00'),
(416, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(417, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(418, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(419, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(420, 12, 17, '2025-07-04', '2025-07-04', '0.00'),
(425, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(426, 13, 20, '2025-07-04', '2025-07-04', '0.00'),
(427, 13, NULL, '2025-07-04', NULL, '0.00'),
(428, 12, NULL, '2025-07-04', NULL, '0.00'),
(429, 12, 14, '2025-07-04', '2025-07-04', '0.00'),
(430, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(431, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(432, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(433, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(434, 12, 19, '2025-07-04', '2025-07-04', '0.00'),
(435, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(436, 12, 19, '2025-07-04', '2025-07-04', '0.00'),
(437, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(438, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(439, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(440, 12, 11, '2025-07-04', '2025-07-04', '0.00'),
(441, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(442, 12, 14, '2025-07-04', '2025-07-04', '0.00'),
(443, 12, 17, '2025-07-04', '2025-07-04', '0.00'),
(444, 12, 16, '2025-07-04', '2025-07-04', '0.00'),
(445, 12, 20, '2025-07-04', '2025-07-04', '0.00'),
(446, 12, 11, '2025-07-04', '2025-07-07', '-10.00'),
(447, 12, 19, '2025-07-04', '2025-07-07', '-10.00'),
(448, 13, 13, '2025-07-04', '2025-07-07', '-10.00'),
(449, 13, 13, '2025-07-04', '2025-07-07', '-10.00'),
(450, 13, 13, '2025-07-04', '2025-07-07', '-10.00'),
(451, 12, 13, '2025-07-04', '2025-07-07', '-10.00'),
(452, 12, 17, '2025-07-04', '2025-07-07', '-10.00'),
(453, 12, 11, '2025-07-07', '2025-07-07', '0.00'),
(454, 12, 13, '2025-07-07', '2025-07-07', '0.00'),
(455, 12, 11, '2025-07-07', '2025-07-10', '-10.00'),
(456, 12, 8, '2025-07-10', '2025-07-10', '0.00'),
(457, 12, NULL, '2025-07-10', NULL, '0.00'),
(458, 12, NULL, '2025-07-10', NULL, '0.00'),
(459, 12, 12, '2025-07-10', '2025-07-16', '5.00'),
(460, 12, 14, '2025-07-10', '2025-07-10', '0.00'),
(461, 12, 15, '2025-07-10', '2025-07-16', '5.00'),
(462, 12, 16, '2025-07-10', '2025-07-16', '5.00'),
(463, 13, NULL, '2025-07-10', NULL, '0.00'),
(464, 12, 11, '2025-07-10', '2025-07-10', '0.00'),
(465, 12, 11, '2025-07-10', '2025-07-10', '0.00'),
(466, 12, 11, '2025-07-10', '2025-07-10', '0.00'),
(467, 12, 11, '2025-07-10', '2025-07-16', '5.00'),
(468, 12, 11, '2025-07-14', '2025-07-16', '5.00'),
(469, 12, 8, '2025-07-14', '2025-07-14', '0.00'),
(470, 12, 11, '2025-07-14', '2025-07-16', '5.00'),
(471, 12, 11, '2025-07-16', '2025-07-16', '5.00'),
(472, 12, 11, '2025-07-16', '2025-07-16', '0.00'),
(473, 12, 14, '2025-07-16', '2025-07-16', '0.00'),
(474, 12, 8, '2025-07-16', '2025-07-16', '0.00'),
(475, 12, 16, '2025-07-16', '2025-07-16', '5.00'),
(476, 12, 14, '2025-07-16', '2025-07-16', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `checkout_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `checkout_date` date NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `name`, `student_id`, `phone`, `checkout_date`, `due_date`) VALUES
(26, 'dassee bekele', '4455', '09776576465', '2025-06-26', '2025-07-01'),
(28, 'eba', '768', '0887898', '2025-06-26', '2025-07-01'),
(29, 'eba', '768', '0887898', '2025-06-26', '2025-07-01'),
(30, 'eba', '768', '0887898', '2025-06-26', '2025-07-01'),
(32, 'dassee bekeledddd', '4455', '0676756764', '2025-07-03', '2025-07-08'),
(34, 'dassee bekele', '4455', '09776576465', '2025-07-04', '2025-07-04'),
(36, 'dassee bekele', '4455', '09776576465', '2025-07-04', '2025-07-04'),
(37, 'ffffffffffffffffff', '4455', '0676756764', '2025-07-04', '2025-07-04'),
(38, 'ttttttttttttttttttttt', '4455', '0676756764', '2025-07-04', '2025-07-04'),
(39, 'vvvvvvvvvvvvv', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(40, 'vvvvvvvvvvvvv', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(41, 'qqqqqqqqqqqqqqq', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(42, 'ggggggggggg', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(43, 'ggggggggggg', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(44, 'ffffffffffffffffff', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(45, 'dassee bekele', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(46, 'dassee bekele', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(47, 'ddddddddddddddddddddddd', '4455', '0676756764', '2025-07-04', '2025-07-05'),
(48, 'ddddddddddddddddddddddd', '4455', '0676756764', '2025-07-07', '2025-07-07'),
(49, 'ddddddddddddddddddddddd', '4455', '0676756764', '2025-07-07', '2025-07-07'),
(50, 'ddddddddddddddddddddddd', '4455', '0676756764', '2025-07-07', '2025-07-07'),
(51, 'gggggddd', '4455', '0676756764', '2025-07-14', '2025-07-14'),
(52, 'gggggddd', '4455', '0676756764', '2025-07-14', '2025-07-14'),
(53, 'gggggddd', '4455', '0676756764', '2025-07-16', '2025-07-16'),
(54, 'gggggddd', '4455', '0676756764', '2025-07-16', '2025-07-16'),
(55, 'gggggddd', '4455', '0676756764', '2025-07-16', '2025-07-17'),
(56, 'gggggddd', '4455', '0676756764', '2025-07-16', '2025-07-16'),
(57, 'qy', '4455', '0676756764', '2025-07-16', '2025-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_details`
--

CREATE TABLE `checkout_details` (
  `checkout_detail_id` int(11) NOT NULL,
  `checkout_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout_details`
--

INSERT INTO `checkout_details` (`checkout_detail_id`, `checkout_id`, `book_id`, `quantity`) VALUES
(38, 29, 8, 1),
(39, 30, 8, 1),
(41, 32, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `percent_given` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `email`, `comment`, `percent_given`, `created_at`) VALUES
(1, 'desalegnbekele2016@gmail.com', 'Exellent System', '', '2025-05-19 11:23:12'),
(2, 'borufan55@gmail.com', 'Thank you for your service', '', '2025-05-19 11:26:50'),
(3, 'borufan55@gmail.com', 'good service', '', '2025-05-21 09:40:24'),
(4, 'borufan55@gmail.com', 'tajaajila keesssanitti quufeera', '', '2025-06-01 07:42:46'),
(5, 'tt@gmail.com', 'tajaajila keesssanitti quufeera', '100', '2025-06-03 12:40:58'),
(6, 'borufan55@gmail.com', 'done', '100', '2025-06-03 12:41:15');

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
(13, 0, 'jjjj', 1, '0000-00-00'),
(14, 0, 'yeroo kee xumurtetta', 1, '0000-00-00'),
(15, 0, 'm,efme,f', 1, '0000-00-00'),
(16, 0, 'yeroo kee xumurtetta', 1, '0000-00-00'),
(17, 0, 'jjjj', 1, '0000-00-00'),
(18, 0, 'kkkkkkkk', 1, '0000-00-00'),
(19, 0, 'iiiiiiiiiiiiiiii', 1, '0000-00-00'),
(20, 0, 'jjjjjjjjjjjjjjjjj', 1, '0000-00-00');

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
(12, 'Bonsa', 'C', 'dytrtrutr5', '', 'biology', 'dbnhj6@gmail.com', 'student', '$2y$10$3iSnwQSrAqtv5ChRCBk/nOl8N1z5V6gHppIQyEEU0PGNXaQmsL6Y2', 'student'),
(13, 'Tola', 'P', '4768ghgfh', '', 'IT', 'desalegnbekele2016@gmail.com', 'hurube', '$2y$10$uCz8dvUFRGm/CYDrQEZS8uHgP2hB.3wdmQOMTxegZ.eiBAE4kiBg2', 'circulation'),
(22, 'Gemechis', 'Zaarihun', '2233', '2025-05-22', 'computerscience', 'gjj@gmail.com', 'Geme', '$2y$10$lhPWPV3UEgbtsMwpF0E26ebLlN4i6sfOV4rFYnfwML4Bqo6.pqidK', 'admin'),
(24, 'chala', 'b', '6575', '2025-06-18', 'computerscience', 'gga@gmail.com', 'chalab', '$2y$10$wJb8u43exOBL6AlqfG0/kegDkOiWtK3EB/iGwE8fhQvLvGvSbz8pC', 'circulation'),
(25, 'Chaltu', 'Dirriba', '6575', '2025-06-18', 'computerscience', 'chaltu@gmail.com', 'chaltu', '$2y$10$JM74GtrO3S/J7oFWda2FdumH6PBfVd2VFXMMZT5RmbyN4wMxmLmh6', 'circulation'),
(26, 'tole', 't', '6990', '2025-06-19', 'computerscience', 'tt@gmail.com', 'tolet', '$2y$10$nQ24aud2R0SoGtyY8yZzVegUNK1odPZ8qokjxSuI0QDsdudpz0L1a', 'admin'),
(27, 'tolashi', 'ts', '6990', '2025-06-19', 'computerscience', 'af@gmail.com', 'tolashi', '$2y$10$6nzHqG4Onwj4lxsCJft45OK30OaidIEzYGnOClulvKqyWFQuQkjUy', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_holds`
--
ALTER TABLE `book_holds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD PRIMARY KEY (`checkout_detail_id`),
  ADD KEY `checkout_id` (`checkout_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `book_holds`
--
ALTER TABLE `book_holds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `checkout_details`
--
ALTER TABLE `checkout_details`
  MODIFY `checkout_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `notificationss`
--
ALTER TABLE `notificationss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_holds`
--
ALTER TABLE `book_holds`
  ADD CONSTRAINT `book_holds_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `book_holds_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD CONSTRAINT `checkout_details_ibfk_1` FOREIGN KEY (`checkout_id`) REFERENCES `checkouts` (`checkout_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checkout_details_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

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
