-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 14, 2022 at 05:57 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_log`
--

CREATE TABLE `auction_log` (
  `bid_id` smallint(5) UNSIGNED NOT NULL,
  `item_id` smallint(5) UNSIGNED NOT NULL,
  `buyer_username` varchar(30) NOT NULL,
  `bid` decimal(8,2) UNSIGNED NOT NULL,
  `bid_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auction_log`
--

INSERT INTO `auction_log` (`bid_id`, `item_id`, `buyer_username`, `bid`, `bid_datetime`) VALUES
(1, 1, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(2, 1, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(3, 1, 'buyer1', '310.00', '2022-11-30 12:10:10'),
(4, 1, 'buyer2', '320.00', '2022-11-30 14:10:10'),
(5, 2, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(6, 2, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(7, 3, 'buyer1', '110.00', '2022-11-30 10:10:10'),
(8, 3, 'buyer2', '120.00', '2022-12-01 10:10:10'),
(9, 4, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(10, 4, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(11, 5, 'buyer1', '160.00', '2022-11-30 10:10:10'),
(12, 5, 'buyer2', '170.00', '2022-12-01 10:10:10'),
(13, 6, 'buyer1', '101.00', '2022-11-30 10:10:10'),
(14, 6, 'buyer2', '102.00', '2022-12-01 10:10:10'),
(15, 7, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(16, 7, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(17, 8, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(18, 8, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(19, 9, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(20, 9, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(21, 10, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(22, 10, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(23, 11, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(24, 11, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(25, 12, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(26, 12, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(27, 13, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(28, 13, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(29, 14, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(30, 14, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(31, 15, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(32, 15, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(33, 16, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(34, 16, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(35, 17, 'buyer1', '310.00', '2022-11-30 10:10:10'),
(36, 17, 'buyer2', '320.00', '2022-12-01 10:10:10'),
(37, 18, 'buyer1', '600.00', '2022-11-30 10:10:10'),
(38, 18, 'buyer2', '700.00', '2022-12-01 10:10:10'),
(39, 19, 'buyer1', '11000.00', '2022-11-30 10:10:10'),
(40, 19, 'buyer2', '12000.00', '2022-12-01 10:10:10'),
(65, 21, 'buyer2', '30.00', '2022-12-13 17:09:55'),
(66, 22, 'buyer2', '30.00', '2022-12-13 17:14:27'),
(67, 22, 'buyer1', '40.00', '2022-12-13 17:17:21'),
(68, 22, 'buyer3', '50.00', '2022-12-13 17:20:40'),
(69, 10, 'buyer2', '330.00', '2022-12-13 17:36:59'),
(70, 21, 'buyer2', '40.00', '2022-12-13 17:51:05'),
(71, 22, 'buyer2', '60.00', '2022-12-13 18:00:22'),
(72, 22, 'buyer3', '70.00', '2022-12-13 18:38:51'),
(73, 1, 'buyer3', '24.00', '2022-11-30 10:10:10'),
(74, 24, 'buyer3', '310.00', '2022-11-30 10:10:10'),
(75, 21, 'buyer3', '50.00', '2022-12-13 18:47:50'),
(76, 22, 'buyer3', '80.00', '2022-12-13 18:49:44'),
(77, 16, 'buyer2', '330.00', '2022-12-13 18:56:30'),
(78, 16, 'buyer2', '340.00', '2022-12-13 18:57:56'),
(79, 22, 'buyer2', '90.00', '2022-12-13 18:58:42'),
(80, 16, 'buyer3', '350.00', '2022-12-13 19:02:49'),
(81, 22, 'buyer3', '100.00', '2022-12-13 19:03:09'),
(82, 22, 'buyer3', '110.00', '2022-12-13 19:13:32'),
(83, 16, 'buyer3', '360.00', '2022-12-13 19:18:00'),
(84, 22, 'buyer3', '120.00', '2022-12-13 19:18:29'),
(85, 22, 'buyer3', '130.00', '2022-12-13 19:22:18'),
(86, 22, 'buyer3', '140.00', '2022-12-13 19:22:33'),
(87, 27, 'buyer3', '40.00', '2022-12-13 19:29:47'),
(88, 28, 'buyer3', '40.00', '2022-12-13 19:39:51'),
(89, 29, 'buyer3', '50.00', '2022-12-13 19:43:58'),
(90, 30, 'buyer3', '40.00', '2022-12-13 19:46:37'),
(91, 31, 'buyer3', '40.00', '2022-12-13 19:47:59'),
(92, 16, 'buyer3', '390.00', '2022-12-13 19:50:06'),
(93, 22, 'buyer3', '150.00', '2022-12-13 19:50:29'),
(94, 22, 'buyer3', '160.00', '2022-12-13 20:00:25'),
(95, 33, 'buyer3', '40.00', '2022-12-13 20:01:38'),
(96, 16, 'buyer3', '400.00', '2022-12-13 20:02:46'),
(97, 16, 'buyer3', '410.00', '2022-12-13 20:02:59'),
(98, 16, 'buyer3', '500.00', '2022-12-13 20:04:35'),
(99, 16, 'buyer3', '520.00', '2022-12-13 20:05:13'),
(100, 22, 'buyer3', '170.00', '2022-12-13 20:05:40'),
(101, 23, 'buyer3', '30.00', '2022-12-13 20:06:24'),
(102, 23, 'buyer3', '40.00', '2022-12-13 20:06:28'),
(103, 22, 'buyer3', '190.00', '2022-12-13 20:11:53'),
(104, 36, 'buyer3', '40.00', '2022-12-13 20:14:43'),
(105, 22, 'buyer3', '200.00', '2022-12-13 20:26:41'),
(106, 38, 'buyer3', '50.00', '2022-12-13 20:27:53'),
(107, 16, 'buyer3', '550.00', '2022-12-13 20:37:03'),
(108, 22, 'buyer3', '220.00', '2022-12-13 20:37:27'),
(109, 16, 'buyer3', '590.00', '2022-12-13 20:57:08'),
(110, 16, 'buyer3', '600.00', '2022-12-13 21:19:59'),
(111, 16, 'buyer3', '700.00', '2022-12-13 21:23:58'),
(112, 16, 'buyer3', '800.00', '2022-12-13 21:25:24'),
(113, 22, 'buyer3', '300.00', '2022-12-13 21:25:49'),
(114, 22, 'buyer3', '400.00', '2022-12-13 21:35:20'),
(115, 16, 'buyer3', '900.00', '2022-12-13 21:37:42'),
(116, 22, 'buyer3', '500.00', '2022-12-13 21:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` smallint(5) UNSIGNED NOT NULL,
  `seller_username` varchar(20) NOT NULL,
  `category` enum('Fashion','Electronic','Travel','Education','Food','Transport','Sport','Music','Other') NOT NULL,
  `create_datetime` datetime NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `reserve_price` decimal(8,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `opening_price` decimal(8,2) UNSIGNED NOT NULL,
  `end_datetime` datetime NOT NULL,
  `email_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0'' -> unsent, ''1'' -> sent.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `seller_username`, `category`, `create_datetime`, `item_name`, `description`, `reserve_price`, `opening_price`, `end_datetime`, `email_status`) VALUES
(1, 'seller1', 'Electronic', '2022-11-11 10:00:00', 'MacBook Air', 'M1\r\n2022\r\nNew', '0.00', '300.00', '2022-12-01 11:29:54', '1'),
(2, 'seller1', 'Electronic', '2022-11-11 10:00:00', 'TV', 'sony\r\n2020\r\nused', '250.00', '200.00', '2022-12-02 11:30:33', '1'),
(3, 'seller1', 'Electronic', '2022-11-11 10:00:00', 'Monitor', '99% new', '10000.00', '100.00', '2022-12-03 00:00:00', '1'),
(4, 'seller2', 'Transport', '2022-11-11 10:00:00', 'Bike', 'Electronic bike', '0.00', '20.00', '2022-12-04 00:00:00', '1'),
(5, 'seller2', 'Electronic', '2022-11-11 10:00:00', 'macbookPro', 'New', '200.00', '150.00', '2022-12-05 11:15:00', '1'),
(6, 'seller2', 'Electronic', '2022-11-11 10:00:00', 'iphone14', 'used', '120.00', '100.00', '2022-12-06 11:16:00', '1'),
(7, 'seller2', 'Electronic', '2022-11-11 10:00:00', 'air pod', 'new   ', '0.00', '50.00', '2022-12-07 15:38:00', '1'),
(8, 'seller1', 'Food', '2022-11-11 10:00:00', 'beer', 'taste nice\r\n20 bottles', '10.00', '30.00', '2022-12-18 00:00:00', '0'),
(9, 'seller1', 'Sport', '2022-11-11 10:00:00', 'Snowboard', 'New adjustable snowbaoard', '6.00', '1.00', '2022-12-19 14:07:00', '0'),
(10, 'seller2', 'Music', '2022-11-11 10:00:00', 'CD', 'CD from 1980s.', '80.00', '20.00', '2022-12-20 14:00:00', '0'),
(11, 'seller1', 'Education', '2022-11-11 10:00:00', 'Python', 'Python for dummies book', '20.00', '10.00', '2023-12-11 14:00:00', '0'),
(12, 'seller1', 'Education', '2022-11-11 10:00:00', 'Java', 'Java for dummies book', '20.00', '10.00', '2023-12-12 14:00:00', '0'),
(13, 'seller1', 'Fashion', '2022-11-11 10:00:00', 'Jacket', 'Warm, nice', '30.00', '20.00', '2023-12-13 17:41:00', '0'),
(14, 'seller1', 'Fashion', '2022-11-11 10:00:00', 'Nike shoes', 'Waterproof', '20.00', '10.00', '2023-12-14 16:31:50', '0'),
(15, 'seller2', 'Fashion', '2022-11-11 10:00:00', 'Coat', 'Nice coat', '39.98', '20.00', '2023-12-15 17:02:00', '0'),
(16, 'seller2', 'Education', '2022-11-11 10:00:00', 'Notebook', 'A4 size', '20.00', '10.00', '2023-12-16 19:14:00', '0'),
(17, 'seller2', 'Music', '2022-11-11 10:00:00', 'Guitar', 'Owned by Freddie Mercury', '90.00', '80.00', '2023-12-17 00:00:00', '0'),
(18, 'seller2', 'Travel', '2022-11-11 10:00:00', 'Spanish Villa to rent', 'Available on 1 week basis', '800.00', '550.00', '2023-12-18 00:00:00', '0'),
(19, 'seller2', 'Music', '2022-11-11 10:00:00', 'Bechstein Grand Piano', 'Beautiful Rosewood case', '15000.00', '10000.00', '2023-12-19 00:00:00', '0'),
(21, 'seller3', 'Fashion', '2022-12-13 16:59:46', 'Gloves', 'Warm', '40.00', '20.00', '2022-12-16 16:00:00', '0'),
(22, 'seller3', 'Fashion', '2022-12-13 17:00:56', 'Yellow Jacket', 'New', '40.00', '20.00', '2022-12-16 17:00:00', '0'),
(23, 'seller4', 'Fashion', '2022-12-13 18:37:00', 'Blue Jacket', 'new and warm', '60.00', '20.00', '2022-12-15 18:36:00', '0'),
(24, 'seller1', 'Electronic', '2022-11-11 10:00:00', 'Mouse', 'M1\r\n2022\r\nNew', '0.00', '20.00', '2022-12-01 11:29:54', '1'),
(25, 'seller5', 'Music', '2022-12-13 19:12:29', 'Guitar', 'New guitar', '600.00', '400.00', '2022-12-23 19:12:00', '0'),
(26, 'seller6', 'Music', '2022-12-13 19:21:28', 'Guitar 1', 'new guitar', '400.00', '200.00', '2022-12-16 19:21:00', '0'),
(27, 'seller3', 'Fashion', '2022-12-13 19:29:26', 'Ring', 'new ring', '30.00', '20.00', '2022-12-13 19:31:00', '1'),
(28, 'seller3', 'Fashion', '2022-12-13 19:39:37', 'dress', 'black', '40.00', '20.00', '2022-12-13 19:41:00', '1'),
(29, 'seller3', 'Fashion', '2022-12-13 19:43:43', 'dress', 'nice ', '30.00', '20.00', '2022-12-13 19:44:00', '1'),
(30, 'seller3', 'Fashion', '2022-12-13 19:46:23', 'black dress', '', '20.00', '10.00', '2022-12-13 19:47:00', '1'),
(31, 'seller3', 'Fashion', '2022-12-13 19:47:46', 'Nice dress', '', '20.00', '10.00', '2022-12-13 19:48:00', '1'),
(32, 'seller7', 'Fashion', '2022-12-13 19:59:22', 'Blue Jacket', 'blue', '40.00', '20.00', '2022-12-17 19:59:00', '0'),
(33, 'seller3', 'Fashion', '2022-12-13 20:01:25', 'yellow dress', 'yellow', '30.00', '10.00', '2022-12-13 20:02:00', '1'),
(34, 'seller8', 'Music', '2022-12-13 20:10:55', 'Guitar ', 'new ', '60.00', '30.00', '2022-12-16 20:10:00', '0'),
(35, 'seller3', 'Fashion', '2022-12-13 20:12:50', 'dress', 'dress', '20.00', '10.00', '2022-12-13 20:13:00', '0'),
(36, 'seller3', 'Fashion', '2022-12-13 20:14:30', 'white dress', '', '30.00', '10.00', '2022-12-13 20:15:00', '1'),
(37, 'seller9', 'Fashion', '2022-12-13 20:25:39', 'Jacket', 'jacket', '40.00', '20.00', '2022-12-30 20:25:00', '0'),
(38, 'seller3', 'Fashion', '2022-12-13 20:27:38', 'dress', 'dress', '20.00', '10.00', '2022-12-13 20:28:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `profile` enum('buyer','seller') NOT NULL DEFAULT 'buyer',
  `password` char(32) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `familyname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `country` enum('UK','US') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `profile`, `password`, `firstname`, `familyname`, `email`, `tel`, `address`, `country`) VALUES
('buyer1', 'buyer', '5cbd9d629096842872fdc665d2d03ba3', 'buyer1', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('buyer2', 'buyer', 'ba71d29d4efdd8753c516db594fab6d8', 'James', 'Smith', 'ucaby93@ucl.ac.uk', '8282839', 'Room502, No.18', 'UK'),
('buyer3', 'buyer', '3cb52c98f366dad959eb21181107c7a7', 'Yulu', 'Wang', 'ucaby93@ucl.ac.uk', '3211233', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('seller1', 'buyer', '95caed8e60e15871a6d12fe5505db2db', 'Penny', 'Dress', 'yulu.wang.22@gmail.com', '342334', '109 Camden Road', 'UK'),
('seller2', 'buyer', 'c30248d146039dd086b12f18154863e1', 'Swema', 'Malik', 'ucaby93@ucl.ac.uk', '743801', 'Nottingham Trent University', 'UK'),
('seller3', 'seller', 'ece5ae58b2d51c16c5b61e1266dca96c', 'Yulu', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('seller4', 'seller', '180620f2a84c186d56e0023b3fca2061', 'Yulu', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('seller5', 'seller', '7ef27adce92dd21b4a7e827e4ad374fc', 'Yulu', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('seller6', 'seller', '35cc54686e0fe0cfe17e9f4625a3cbd8', 'Yulu', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('seller7', 'seller', '99b8345763c682ac6d923b3958d85485', 'Yulu', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('seller8', 'seller', 'f05e805efceef64793c0fcf8119ce3ac', 'Yulu', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK'),
('seller9', 'seller', 'a168cffb5929adfd10baa9060a2b71f5', 'Yulu', 'Wang', 'wangyulu980131@gmail.com', '123456', 'Study Inn Loughborough, 2 Lemy', 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `username` varchar(30) NOT NULL,
  `item_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`username`, `item_id`) VALUES
('buyer2', 16),
('buyer2', 22),
('buyer3', 32),
('buyer3', 34),
('buyer3', 37);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction_log`
--
ALTER TABLE `auction_log`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD UNIQUE KEY `username` (`username`,`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction_log`
--
ALTER TABLE `auction_log`
  MODIFY `bid_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
