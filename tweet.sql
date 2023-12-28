-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2023 at 06:43 PM
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
(71, 16, 15, '2023-12-22 03:54:55'),
(72, 15, 7, '2023-12-22 07:49:51'),
(73, 16, 7, '2023-12-24 16:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `title`, `content`, `created_at`) VALUES
(1, 16, 'Coba', 'mau coba post', '2023-12-20 16:00:55'),
(2, 16, 'coba 2', 'test coba 2', '2023-12-20 16:16:40'),
(3, 16, 'Coba 3', 'test post 3\r\n', '2023-12-20 16:53:05'),
(4, 16, 'coba 4', 'test postingan', '2023-12-20 16:53:22'),
(5, 15, 'Test post', 'coba post di akun laen', '2023-12-20 16:59:27'),
(6, 15, 'Testing', 'testing post hari ini', '2023-12-22 04:13:13'),
(7, 16, 'Talking to the moon', 'create post', '2023-12-28 17:20:32'),
(8, 16, 'Senja', 'rintik hujan', '2023-12-28 17:41:45');

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
(15, 'Rizki Kadafi', 'rizkikadafi11', 'rizkikadafi11@gmail.com', NULL, 'my first account', 'https://res.cloudinary.com/dk0kmgvb7/image/upload/v1703781017/_35f8f184-5e2d-471e-8c53-efecb3fd4174.jpeg.jpg', '2023-12-20 14:13:22'),
(16, 'Muhamad Rizki Kadafi', 'rizki', 'bbb@gmail.com', '$2y$10$P649il1XuSp2NKf5jG97We3pecYhakyv6E6qYG.6D21BT0/MQx8DS', 'Cuaca cerah', 'https://res.cloudinary.com/dk0kmgvb7/image/upload/v1703781226/_a3687921-ceb8-4495-b12d-64b86e3557c1.jpeg.jpg', '2023-12-20 15:44:39'),
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
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
