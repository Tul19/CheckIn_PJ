-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2024 at 07:21 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21922441_userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `check_ins`
--

CREATE TABLE `check_ins` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `check_in_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `check_ins`
--

INSERT INTO `check_ins` (`id`, `student_id`, `teacher_id`, `class_time`, `check_in_time`) VALUES
(1, 4, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(2, 6, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(3, 4, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(4, 11, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(5, 12, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(6, 16, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(7, 9, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(8, 18, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(9, 20, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(10, 23, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(11, 18, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(12, 18, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(13, 4, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(14, 16, 2, '2024-03-04 06:40:37', '2024-03-04 06:40:37'),
(15, 4, 2, '2024-03-04 14:13:41', '2024-03-04 14:14:06'),
(16, 11, 2, '2024-03-04 14:13:41', '2024-03-04 14:14:44'),
(17, 12, 2, '2024-03-04 14:13:41', '2024-03-04 14:17:40'),
(18, 18, 2, '2024-03-04 14:13:41', '2024-03-04 14:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `class_status` enum('OPEN','CLOSE') DEFAULT 'OPEN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `teacher_id`, `class_time`, `class_status`) VALUES
(1, 2, '2024-03-04 06:26:01', 'CLOSE'),
(2, 2, '2024-03-04 06:26:01', 'CLOSE'),
(3, 2, '2024-03-04 06:26:01', 'CLOSE'),
(4, 2, '2024-03-04 06:26:01', 'CLOSE'),
(5, 2, '2024-03-04 06:26:01', 'CLOSE'),
(6, 2, '2024-03-04 06:26:01', 'CLOSE'),
(7, 2, '2024-03-04 06:26:01', 'CLOSE'),
(8, 2, '2024-03-04 06:26:01', 'CLOSE'),
(9, 2, '2024-03-04 06:26:01', 'CLOSE'),
(10, 10, '2024-03-04 06:26:01', 'CLOSE'),
(11, 2, '2024-03-04 06:26:01', 'CLOSE'),
(12, 2, '2024-03-04 06:26:01', 'CLOSE'),
(13, 2, '2024-03-04 06:26:26', 'CLOSE'),
(14, 2, '2024-03-04 06:29:59', 'CLOSE'),
(15, 2, '2024-03-04 06:37:05', 'CLOSE'),
(16, 2, '2024-03-04 06:54:42', 'CLOSE'),
(17, 2, '2024-03-04 14:12:59', 'CLOSE'),
(18, 2, '2024-03-04 14:13:41', 'CLOSE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT 'student',
  `class_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `class_status`) VALUES
(1, 'exampleuser', '$2y$10$AptetDoAffJoSy109W/T7u9pgpTk0jTA58dckHxUOvMcAmk69QVk2', 'student', NULL),
(2, 'sm', '$2y$10$s.Kfj/hlIYjB/QL/x3OAEe4DO6hd8ZWS8aLp.VLRjOVcT85ybhCYO', 'teacher', 'CLOSE'),
(4, 'raiden', '$2y$10$5K1TQxRkZJYaGn.w9sjeMOjyfmsncivferAgmRp0IdP/FvxDMTs4i', 'student', NULL),
(6, 'shogun', '$2y$10$xiiKUjNPFaB/65Cp1OPvrutU/uQqdJPVOLir/cQgZ1B2oppjvvwUe', 'student', NULL),
(9, 'shogu', '$2y$10$XVh1LQKGElK1Puv/wamqb.0ttNlmaGcPkyo6rPeaL3.6nAQbXLijK', 'student', NULL),
(10, 'june', '$2y$10$YimJZggVY/m3nI4KkmXIH.ow9bNEG0k0ZT5G3nd18UwdYkw8BDIJm', 'teacher', 'CLOSE'),
(11, 'june1', '$2y$10$BKK6fbkZ9L/eR.5549lfR.cj9PnUcnN2MLMPeUrxuIS94vXUvMm7y', 'student', NULL),
(12, 'june2', '$2y$10$BimV4PXOJIL7JQWO/d15c.J.uLJU/gcZITA3oFMkSXZMhPzKC62wa', 'student', NULL),
(16, 'Tul', '$2y$10$vy4d5dbZEnLOeuWlCPmPzeG4oQV7.atY3Xtfal2S8Aa4Fg5PCku0C', 'student', NULL),
(17, 'shsjsj', '$2y$10$gHzvS2wI3m67d3oUhz4bkO9TkUrIxcALKxBELMfpLU.nH7a/bqDwa', 'student', NULL),
(18, 'male', '$2y$10$MaQbYLS.Ew9JnC2QYpBkhOVYhpNeI.VaE6DJfVXouZdet.uZ5oB4S', 'student', NULL),
(19, '65010094', '$2y$10$XQsE6/LvIFjy7vCHeEBCe.pvkf/uvfn/CxRuRIlQI9YPVBr9LG26m', 'student', NULL),
(20, '65010095', '$2y$10$ykxSdX.qj27TBRHD9ZIt1eFOvdDHuEESORuIYTdgp.q6xSTqZejZC', 'student', NULL),
(21, '65011046', '$2y$10$RnxRrxkd.tHeQNJvwB/Mx.eyouhd9aSLO7lCkv5NuMFTjfiuDUc1O', 'student', NULL),
(22, 'q', '$2y$10$eNSkgGBAkhGubMfBRfvYKOItK0NG9syAAVHoDGgzkTQ6epkBW0HA2', 'student', NULL),
(23, 'mello', '$2y$10$9PzyI3FPul5KsRCnRE4PReDNPXkNBjTdxoSmTXrMleXwuAqK4rcfS', 'student', NULL),
(24, 'banana', '$2y$10$aFqF1olmaLKC0RVP5OcubuUDIgVQAyCNiR64T49XEblt9rW9cioBy', 'student', NULL),
(25, 'qwerty', '$2y$10$szw/VD6EOi1b.Cttjpxn3uGEJ5UY8RcjZnPlrB3qcN/JrhrTz01VK', 'student', NULL),
(26, 'tul2', '$2y$10$ZiOFgmoZQdOL5S2ZlJL61OWnNXq8gqaMm2hBfgAOwIgf/L68xdX.C', 'student', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE `user_location` (
  `id` int(11) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_location`
--

INSERT INTO `user_location` (`id`, `latitude`, `longitude`, `user_id`) VALUES
(1, 13.76682000, 100.80296000, 2),
(2, 13.76694000, 100.80304000, 10),
(3, 13.76696000, 100.80310000, 4),
(4, 37.42200000, -122.08400000, 6),
(5, 13.64581000, 100.68092000, 16),
(6, 13.76705000, 100.80303000, 20),
(7, 13.76695000, 100.80302000, 18),
(8, 13.72730000, 100.77261000, 21),
(9, 13.72019000, 100.79332000, 24),
(10, 13.76692000, 100.80302000, 11),
(11, 13.76691000, 100.80301000, 12),
(12, 37.42200000, -122.08400000, 9),
(13, 13.76702000, 100.80323000, 23),
(14, 37.42209000, -122.08392000, 25),
(15, 13.64581000, 100.68092000, 26);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_ins`
--
ALTER TABLE `check_ins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_location`
--
ALTER TABLE `user_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_ins`
--
ALTER TABLE `check_ins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_location`
--
ALTER TABLE `user_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `check_ins`
--
ALTER TABLE `check_ins`
  ADD CONSTRAINT `check_ins_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `check_ins_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_location`
--
ALTER TABLE `user_location`
  ADD CONSTRAINT `user_location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
