-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2017 at 06:57 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'hello hello1', 1, 8, '2017-04-11 18:44:55'),
(2, 'yello hunter, how many medals tody?', 8, 1, '2017-04-11 18:45:11'),
(3, 'this is hunter here I got over 9000 medals today', 1, 8, '2017-04-11 18:46:00'),
(4, 'woowoow', 8, 1, '2017-04-11 18:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'hunter', 'Sriharsha', 'Hatwar', 'sriharsha@localhost', '$2y$10$0.MmgYAWfFvosiHp522LZO0viLtNE9eekBlvlzH56v4wvq.wwBYe2'),
(4, 'randomGuy', 'Suhas', 'kashyap', 'suhaskashyap@localhost.com', '$2y$10$BSvIkKGmyBteA28P/I6bmePjDODZcAaoX.Is4TuvRJn1fDetu1iKa'),
(5, 'hunterFan', 'Suhass', 'Kashy', 'hunterFan@il.com', '$2y$10$7dFdzXa.Nk/FzqIPcahrX.rQHvuguE.KD5OwsfqziJQlgmgEsn8Qi'),
(6, 'lolster', 'Sushrith', 'Arkal', 'sush@gmail.com', '$2y$10$evIKN7Cq4.M6fshJef11f.QEfC9jyKn/t0vpFui.1u0EQ1NCzNk4S'),
(7, 'hello', 'Sriharsha', 'hatwar', 'sriharsha02hatwar+c9@gmail.com', '$2y$10$/VW868N2WeRlLhX449wXOepQTRobrdiF/SKaqyS4.4cTjqH7v2932'),
(8, 'hello1', 'Sriharsha', 'hatwar', 'sriharsha02hatwa2r+c9@gmail.com', '$2y$10$ZEWLkkPmRW9DWiwFPCjh7.PKhOT73pUUpymZ.fF8CpZHyBxdDhisi');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`send_id`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`rcv_id`) REFERENCES `users` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
