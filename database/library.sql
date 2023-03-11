-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 11:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'Admin', '136cc11fa7d699eb38e87f403b7f7703');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `img`, `writer`, `genre`, `page`, `stock`, `enabled`) VALUES
(1, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 500, 12, 1),
(2, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 23, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `randr`
--

CREATE TABLE `randr` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `BookID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `date_rented` datetime DEFAULT NULL,
  `date_recived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `randr`
--

INSERT INTO `randr` (`id`, `name`, `img`, `writer`, `genre`, `BookID`, `UserID`, `date_rented`, `date_recived`) VALUES
(1, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 06:50:56', '2023-03-06 06:52:51'),
(2, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 06:22:50', '2023-03-06 06:53:01'),
(3, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 06:26:41', '2023-03-06 06:53:09'),
(4, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 06:47:00', '2023-03-06 06:53:14'),
(5, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 06:53:22', '2023-03-06 06:53:25'),
(6, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 06:53:23', '2023-03-06 06:53:33'),
(7, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 06:53:28', '2023-03-06 06:53:30'),
(8, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 06:54:39', '2023-03-06 06:54:44'),
(9, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 06:54:40', '2023-03-06 06:54:48'),
(10, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 06:54:41', '2023-03-06 06:54:53'),
(11, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 06:54:56', '2023-03-06 06:54:59'),
(12, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 10:26:32', '2023-03-06 10:26:44'),
(13, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 10:26:34', '2023-03-06 10:26:46'),
(14, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 10:26:36', '2023-03-06 10:26:46'),
(15, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 10:26:36', '2023-03-06 10:26:47'),
(16, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 10:49:23', '2023-03-06 10:49:32'),
(17, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 10:49:25', '2023-03-06 10:49:33'),
(18, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 10:49:26', '2023-03-06 10:49:35'),
(19, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 10:49:27', '2023-03-06 10:49:35'),
(20, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 10:49:28', '2023-03-06 10:49:36'),
(21, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 11:52:01', '2023-03-06 11:57:29'),
(22, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 11:57:08', '2023-03-06 11:57:30'),
(23, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 11:57:09', '2023-03-06 11:57:31'),
(24, 'The Gambler', 'Fyodor Dostoyevsky.jpg', 'Fyodor Dostoyevsky', 'classic', 1, 1, '2023-03-06 11:58:32', NULL),
(25, 'the IT', 'It_cover.jpg', 'Stephen Edwin King', 'tars', 2, 1, '2023-03-06 11:58:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `del` tinyint(1) DEFAULT 0,
  `rented` int(11) DEFAULT 0,
  `varify` tinyint(1) NOT NULL DEFAULT 0,
  `permission` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `img`, `del`, `rented`, `varify`, `permission`) VALUES
(1, 'mehran', 'mmehran292@gmail.com', '3c26ccd1fb986ce4597417ad0bd107f8', 'avatar-1aba94575af6a90c8300d1cd7a636350.jpg', 0, 2, 1, 1),
(2, 'test', 'test@gmail.com', 'c97a79941ac195d6b54bea9f82427fab', 'avatar-57913e5860dcc8a1dc690d7c0136797d.jpg', 0, 0, 1, 1),
(3, 'moien', 'moien@gmail.com', 'b72743cf3e0a2f9db5e10e2357912982', 'avatar-377ff8680f59f83eedecc6df15ba8e48.jpg', 0, 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `randr`
--
ALTER TABLE `randr`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `randr`
--
ALTER TABLE `randr`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
