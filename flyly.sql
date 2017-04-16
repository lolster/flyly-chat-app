-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2017 at 06:18 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flyly`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `send_id` int(11) NOT NULL,
  `rcv_id` int(11) NOT NULL,
  `msgTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `send_id`, `rcv_id`, `msgTime`) VALUES
(1, 'test message please ignore', 9, 10, '2017-04-11 18:44:55'),
(2, 'this is a pretty good idea', 10, 9, '2017-04-11 18:45:11'),
(3, 'How do i include long messages?', 9, 11, '2017-04-11 18:46:00'),
(4, '```css\r\ntext-overflow: ellipsis;\r\noverflow: hidden;\r\n```', 11, 9, '2017-04-11 18:46:03'),
(5, 'this is trippy', 10, 11, '2017-04-16 13:26:20'),
(6, 'phpmyadmin sql editor is retarded', 11, 10, '2017-04-16 13:28:42'),
(7, 'I think we\'ve taken up too big a project', 11, 10, '2017-04-16 14:28:42'),
(8, 'Hey check out this cool car', 9, 11, '2017-04-16 15:21:42'),
(9, 'also check out this cool dog', 9, 11, '2017-04-16 15:22:12'),
(10, 'cool!', 11, 9, '2017-04-16 15:22:52'),
(11, 'test message', 12, 10, '2017-04-16 15:22:52'),
(12, 'this is a test message as well', 13, 10, '2017-04-16 15:23:12'),
(13, 'flyly works!', 14, 10, '2017-04-16 15:23:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_id` (`send_id`),
  ADD KEY `rcv_id` (`rcv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`send_id`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`rcv_id`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
