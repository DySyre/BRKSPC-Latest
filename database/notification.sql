-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 07:33 AM
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
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `n_id` int(11) NOT NULL,
  `user_petnotifid` int(11) NOT NULL,
  `n_sub` varchar(15) NOT NULL,
  `n_msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`),
  ADD UNIQUE KEY `user_petnotifid` (`user_petnotifid`),
  ADD KEY `n_sub` (`n_sub`),
  ADD KEY `n_msg` (`n_msg`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `n_msg` FOREIGN KEY (`n_msg`) REFERENCES `appointment_tbl` (`appointment_coment`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `n_sub` FOREIGN KEY (`n_sub`) REFERENCES `appointment_tbl` (`appointment_payment_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_petnotifid` FOREIGN KEY (`user_petnotifid`) REFERENCES `users_balagtas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
