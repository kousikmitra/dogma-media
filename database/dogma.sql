-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2019 at 12:29 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dogma`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `users_id`, `sent_to`, `message`, `sent_on`) VALUES
(7, 2, 3, 'hello', '2019-06-14 06:39:11'),
(8, 3, 2, 'hello back', '2019-06-14 06:40:27'),
(9, 2, 4, 'hi to test2', '2019-06-14 06:41:58'),
(10, 4, 2, 'hi kousik', '2019-06-14 06:42:11'),
(11, 4, 3, 'hi first test', '2019-06-14 06:42:23'),
(12, 3, 4, 'hi test2 from test1', '2019-06-14 06:42:54'),
(13, 3, 2, 'hi again', '2019-06-14 07:31:30'),
(14, 3, 2, 'hi', '2019-06-14 07:31:52'),
(15, 2, 3, 'hello', '2019-06-14 07:32:19'),
(16, 2, 3, 'hello', '2019-06-14 07:32:29'),
(17, 2, 3, 'hello', '2019-06-14 07:32:33'),
(18, 2, 3, 'hello', '2019-06-14 07:32:35'),
(19, 2, 3, 'hello', '2019-06-14 07:32:37'),
(20, 2, 3, 'hello', '2019-06-14 08:04:25'),
(21, 2, 3, 'again', '2019-06-14 08:05:10'),
(22, 2, 3, 'ok done', '2019-06-14 08:29:06'),
(23, 2, 3, 'hello', '2019-06-14 08:47:15'),
(24, 2, 3, 'hi', '2019-06-14 08:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` date NOT NULL,
  `comment_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `posts_id`, `users_id`, `comment`, `comment_date`, `comment_time`) VALUES
(1, 5, 2, 'really beautiful', '2019-06-12', '15:07:12'),
(2, 5, 2, 'Darjeeling is beautiful', '2019-06-12', '16:35:50'),
(3, 4, 2, 'nice foggy photos', '2019-06-12', '16:37:04'),
(4, 6, 2, 'beautiful photo', '2019-06-13', '11:52:10'),
(5, 6, 3, 'its beautiful', '2019-06-13', '15:46:22'),
(6, 3, 3, 'its a comment', '2019-06-13', '15:48:50'),
(7, 4, 3, 'wow', '2019-06-13', '15:50:46'),
(8, 5, 3, 'amazing beauty', '2019-06-13', '15:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `follows` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `users_id`, `follows`) VALUES
(8, 3, 2),
(9, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `posts_id`, `users_id`) VALUES
(53, 3, 2),
(63, 4, 2),
(67, 6, 3),
(68, 5, 3),
(73, 5, 2),
(75, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_data` text DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_time` time NOT NULL,
  `total_likes` int(11) NOT NULL DEFAULT 0,
  `total_comments` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `users_id`, `post_title`, `post_data`, `post_date`, `post_time`, `total_likes`, `total_comments`) VALUES
(3, 2, 'Hello This is my first post', 'Here are some beautiful images', '2019-06-12', '14:09:22', 1, 1),
(4, 2, 'This one is another test', 'hello here are some other images', '2019-06-12', '14:15:06', 1, 2),
(5, 2, 'Another test', 'here is some images like', '2019-06-12', '14:22:32', 2, 3),
(6, 2, 'test post', 'some images', '2019-06-12', '14:39:54', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `posts_id`, `images`) VALUES
(1, 3, './photo_gallery/IMG_20190605_125604.jpg;./photo_gallery/IMG_20190605_125602.jpg;./photo_gallery/IMG_20190605_114350.jpg'),
(2, 4, './photo_gallery/20190604_150434.jpg;./photo_gallery/20190604_150428.jpg'),
(3, 5, './photo_gallery/20190603_115035.jpg;./photo_gallery/20190603_115018.jpg;./photo_gallery/20190603_114817.jpg'),
(4, 6, './photo_gallery/20190604_072224.jpg;./photo_gallery/20190604_072200.jpg;./photo_gallery/20190604_071232.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `bio` text DEFAULT NULL,
  `works` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `followers` int(11) NOT NULL DEFAULT 0,
  `following` int(11) NOT NULL DEFAULT 0,
  `profile_photo` text DEFAULT '\'profile-icon.png\''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `users_id`, `bio`, `works`, `address`, `phone`, `dob`, `followers`, `following`, `profile_photo`) VALUES
(1, 2, 'here is an introduction of me', 'Intern', 'Kolkata, India', NULL, NULL, 1, 1, 'profile-icon.png'),
(2, 3, NULL, NULL, NULL, NULL, NULL, 1, 1, 'profile-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `reg_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `verified`, `reg_time`) VALUES
(2, 'kousik-mitra', 'Kousik Mitra', 'kousikmitra12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2019-06-11 18:48:51'),
(3, 'test-user', 'Test User', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2019-06-13 10:01:14'),
(4, 'test2', 'test user 2', 'test2@gmail.com', '123456', 1, '2019-06-14 06:41:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `sent_to` (`sent_to`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `follows` (`follows`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`users_id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`sent_to`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`follows`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
