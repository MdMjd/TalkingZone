-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2017 at 10:29 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talkingzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ca_id` int(11) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `ca_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ca_id`, `ca_name`, `ca_description`) VALUES
(1, 'Web Programming', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed est quis eros posuere ornare. Fusce felis mi, tincidunt et erat quis, viverra rutrum velit. Donec lectus risus, fringilla quis luctus a, bibendum vitae felis.'),
(2, 'Web Design', 'Donec laoreet purus neque, sit amet facilisis arcu ultrices a. Maecenas aliquet aliquam nulla, et aliquet dui lacinia non.');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `rep_id` int(11) NOT NULL,
  `tpc_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `rep_body` text NOT NULL,
  `rep_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`rep_id`, `tpc_id`, `usr_id`, `rep_body`, `rep_create_date`) VALUES
(1, 2, 2, 'I like Django', '2017-07-05 13:15:04'),
(2, 2, 1, 'I like PHP', '2017-07-05 13:18:04'),
(3, 2, 5, '<p>I love <strong>PHP</strong> with Javascript</p>', '2017-07-08 14:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `tpc_id` int(11) NOT NULL,
  `ca_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `tpc_title` varchar(100) NOT NULL,
  `tpc_body` text NOT NULL,
  `tpc_last_activity` datetime NOT NULL,
  `tpc_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`tpc_id`, `ca_id`, `usr_id`, `tpc_title`, `tpc_body`, `tpc_last_activity`, `tpc_create_date`) VALUES
(1, 1, 2, 'Favourite Server Side Language', 'What is your favourite server side language?', '2017-07-07 06:00:00', '2017-07-04 09:46:29'),
(2, 2, 3, 'What is your favourite language or framework?', 'Nunc pellentesque ex ante, eget bibendum dui accumsan non. Aenean vel lacinia felis, ut lacinia diam. Interdum et malesuada fames ac ante ipsum primis in faucibus.', '2017-07-07 15:00:00', '2017-07-04 09:46:29'),
(3, 1, 5, 'What are the differences in the new HTML5 and CSS3', 'Lorem Ipsum..', '2017-07-08 21:44:55', '2017-07-08 13:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `usr_name` varchar(100) NOT NULL,
  `usr_email` varchar(100) NOT NULL,
  `usr_avatar` varchar(100) NOT NULL,
  `usr_username` varchar(10) NOT NULL,
  `usr_password` varchar(64) NOT NULL,
  `usr_about` text NOT NULL,
  `usr_last_activity` datetime NOT NULL,
  `usr_join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_email`, `usr_avatar`, `usr_username`, `usr_password`, `usr_about`, `usr_last_activity`, `usr_join_date`) VALUES
(1, 'Bob Richardson', 'techguy@gmail.com', 'avatar1.jpg', 'BobR', '123', 'Im a web developer from Singapore', '2017-07-05 07:00:00', '2017-07-04 09:41:52'),
(2, 'Mark Lee', 'markthecoder@gmail.com', 'avatar1.jpg', 'MarkL', '123456', 'Looking to improve my skills', '2017-07-12 05:13:10', '2017-07-05 13:02:04'),
(3, 'Salim Johnson', 'salimja@gmail.com', 'man1.png', 'SalimJ', '32250170a0dca92d53ec9624f336ca24', 'I would like to share my experiences and talk to people', '2017-07-06 16:23:38', '2017-07-06 08:23:38'),
(4, 'Muhammad Majeed', 'noemail@gmail.com', 'man2.png', 'MdMjd', '32250170a0dca92d53ec9624f336ca24', 'Interesting Perspective', '2017-07-06 17:15:52', '2017-07-06 09:15:52'),
(5, 'Mr Johnson', 'johjohn@gmail.com', 'man3.png', 'MrTest', 'e10adc3949ba59abbe56e057f20f883e', 'I like to see the end of this project.', '2017-07-08 18:15:45', '2017-07-08 10:15:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`rep_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`tpc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `tpc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
