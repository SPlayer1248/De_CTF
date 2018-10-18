-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2018 at 08:09 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctf_web03`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `sender` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `title`, `content`, `sender`, `receiver`, `date`) VALUES
(1, 'Hello wolrd', 'Hello world from PHP', 'guest', 'test', '2018-10-18 22:25:46'),
(2, 'Hello', 'Hello nice to meet you', 'test', 'guest', '2018-10-18 22:25:46'),
(3, 'Hi', 'I am user1', 'user1', 'user2', '2018-10-18 22:25:46'),
(4, 'Hi user1!', 'My name is user2', 'user2', 'user1', '2018-10-18 22:25:46'),
(5, 'Konichiwa', 'Watashi wa guest desu', 'guest', 'user1', '2018-10-18 22:25:47'),
(6, 'Hajimemasute', 'Bokuwa user1', 'user1', 'guest', '2018-10-18 22:25:47'),
(7, 'Yamete', 'Yametekudasai', 'user2', 'test', '2018-10-18 22:25:47'),
(8, 'Kimochi', 'Kimochi kimochi', 'test', 'user2', '2018-10-18 22:25:47'),
(9, 'iku iku', 'iku hayaku', 'user1', 'test', '2018-10-18 22:25:47'),
(10, 'haizz', 'haizzzzzzz', 'test', 'user1', '2018-10-18 22:25:47'),
(11, 'Con ca vang', 'Con ca vang mau xanh la cay', 'test', 'guest', '2018-10-19 00:32:07'),
(12, 'Con ca vang', 'hoi no mau gi?', 'guest', 'test', '2018-10-19 00:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 1),
(2, 'guest', 'guest', 0),
(3, 'test', 'test', 0),
(4, 'user1', 'user1', 0),
(5, 'user2', '123456', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
