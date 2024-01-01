-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2023 at 11:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tweet`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `friendship_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`friendship_id`, `user_id`, `friend_id`, `created_at`) VALUES
(70, 15, 16, '2023-12-22 03:54:08'),
(74, 16, 15, '2023-12-29 07:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `like_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`, `like_at`) VALUES
(7, 16, 6, '2023-12-31 01:48:02'),
(10, 15, 6, '2023-12-31 01:49:03'),
(18, 16, 19, '2023-12-31 10:33:53'),
(19, 15, 19, '2023-12-31 10:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('new','edited') NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `title`, `content`, `created_at`, `updated_at`, `status`) VALUES
(6, 15, 'Testing', 'edit posting', '2023-12-22 04:13:13', '2023-12-31 10:35:37', 'edited'),
(18, 16, 'void', 'console.log(print)\r\ngtk install', '2023-12-31 09:59:35', '2023-12-31 10:00:03', 'edited'),
(19, 16, 'hello world', 'fn main() {\r\n    println!(\"Hello World!\");\r\n}', '2023-12-31 10:08:35', '2023-12-31 10:08:35', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `username`, `email`, `password`, `description`, `picture`, `created_at`) VALUES
(7, NULL, 'user34041', 'name@example.com', '$2y$10$wwQ7.EEaFvNDeBOYL32Y6eUREmyJqr6B4JH3DhYu/Ff3EhlURMhlG', NULL, NULL, '2023-12-20 14:11:38'),
(8, NULL, 'user75136', 'aaa@hmail.com', '$2y$10$xjLyvjAyVdHF8jF1w5sdluTdUCReZNW5iTxGkTVlYJGbAvha8FhJe', NULL, NULL, '2023-12-20 14:11:38'),
(15, 'Rizki Kadafi', 'rizkikadafi11', 'rizkikadafi11@gmail.com', NULL, 'new year', 'https://res.cloudinary.com/dk0kmgvb7/image/upload/v1703781017/_35f8f184-5e2d-471e-8c53-efecb3fd4174.jpeg.jpg', '2023-12-20 14:13:22'),
(16, 'Muhamad Rizki Kadafi', 'rizki', 'bbb@gmail.com', '$2y$10$P649il1XuSp2NKf5jG97We3pecYhakyv6E6qYG.6D21BT0/MQx8DS', 'Lorem Ipsum dolor sit amet', 'https://res.cloudinary.com/dk0kmgvb7/image/upload/v1703832546/_7a82f513-2c8e-494d-afea-fc9d4f04c713.jpeg.jpg', '2023-12-20 15:44:39'),
(17, NULL, 'user127917', 'dummy@gmail.com', '$2y$10$9N.nVdfa5VwfHLxrHepmAO0kZmQ.GaYLMF/XfbkltbdJBfilk9DEy', NULL, NULL, '2023-12-21 00:50:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`friendship_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `likes_ibfk_2` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `fk_friend_id` FOREIGN KEY (`friend_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
