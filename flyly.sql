-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2017 at 09:28 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
(5, 'one', 10, 11, '2017-04-16 13:26:20'),
(6, 'ptwo', 11, 10, '2017-04-16 13:28:42'),
(7, 'three', 11, 10, '2017-04-16 21:16:04'),
(8, 'four', 11, 10, '2017-04-16 21:17:06'),
(9, 'five', 10, 11, '2017-04-16 21:17:10'),
(10, '6', 11, 10, '2017-04-16 21:17:25'),
(11, '7', 11, 10, '2017-04-16 21:17:32'),
(12, '8', 11, 10, '2017-04-16 21:29:58'),
(13, 'nine', 11, 10, '2017-04-16 21:31:15'),
(14, 'ten', 10, 11, '2017-04-16 23:42:05'),
(15, 'eleven', 10, 11, '2017-04-16 23:42:23'),
(16, 'twelve', 10, 11, '2017-04-16 23:43:09');

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
(9, 'kashyap07', 'Suhas', 'Kashyap', 'kashyapsuhas07@localhost', '$2y$10$LepCribZnYejxvxA7e0w3eUKwJchshunF1dakgN42OGMFKuz19.W2'),
(10, 'hunter', 'Sriharsha', 'Hatwar', 'sriharsha02hatwar@localhost', '$2y$10$VomGAYK8jzRBY1TajjTQ6.bem35nB9fGNaMQOFQ6hh.0s1lenDWNe'),
(11, 'lolster', 'Sushrith', 'Arkal', 'sushi@localhost', '$2y$10$R9ttsdBZcdE6NdsHhPJpHu26qfWnyqwfYtiVyaJrSEEV0A/g6JQvm'),
(12, 'sreedhar', 'Sreedhar', 'Radhakrishnan', 'sreedhar@localhost', '$2y$10$bmNIdrlYEHu.hGlaoeAjRu8SkqT2VxdPCG1Tsu3dwfOVgLmb/nT4C'),
(13, 'vb1995', 'Varun', 'Bharadwaj', 'vb@localhost', '$2y$10$MGAHB6vG2izTBSRELWPROOtMJSjQ6mt6D6GEw1TVgMn87wGj3YHY2'),
(14, 'varunpikachu', 'Varun', 'M', 'varunpikachu@localhost', '$2y$10$RPJoBp9aZUvyL0mA3qOzg.Ql0xJwdNgsA9ElMBUHx7RH5bPKgFnlq');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`send_id`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`rcv_id`) REFERENCES `users` (`userid`);
