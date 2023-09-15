-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 04:47 PM
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
-- Table structure for table `appointment_bill_tbl`
--

CREATE TABLE `appointment_bill_tbl` (
  `appointment_bill_id` int(11) NOT NULL,
  `appointment_idfk` int(11) NOT NULL,
  `appointment_bill_total` double(11,2) NOT NULL,
  `appointment_bill_payment` double(11,2) NOT NULL,
  `appointment_bill_bal` double(11,2) NOT NULL,
  `appon_bill_comment` varchar(255) NOT NULL,
  `appointment_bill_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_bill_tbl`
--

INSERT INTO `appointment_bill_tbl` (`appointment_bill_id`, `appointment_idfk`, `appointment_bill_total`, `appointment_bill_payment`, `appointment_bill_bal`, `appon_bill_comment`, `appointment_bill_dor`) VALUES
(37, 179, 1500.00, 2000.00, 500.00, 'may utang pa', '2023-07-30'),
(38, 180, 2000.00, 2000.00, 0.00, 'may utang ka pa', '2023-07-30'),
(39, 181, 1500.00, 1000.00, -500.00, 'assddddsssddd', '2023-07-30'),
(40, 190, 100.00, 300.00, 200.00, 'tangina moren', '2023-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_completed_tbl`
--

CREATE TABLE `appointment_completed_tbl` (
  `appointment_completed_id` int(11) NOT NULL,
  `appointment_completed_idfk` int(11) NOT NULL,
  `appointment_services_idfk` int(11) NOT NULL,
  `app_com_price` double(11,2) NOT NULL,
  `appointment_completed_qty` int(11) NOT NULL,
  `appointment_completed_amount` double(11,2) NOT NULL,
  `user_add` int(11) NOT NULL,
  `app_complete_comment` varchar(255) NOT NULL,
  `appointment_payment_dor` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_completed_tbl`
--

INSERT INTO `appointment_completed_tbl` (`appointment_completed_id`, `appointment_completed_idfk`, `appointment_services_idfk`, `app_com_price`, `appointment_completed_qty`, `appointment_completed_amount`, `user_add`, `app_complete_comment`, `appointment_payment_dor`) VALUES
(261, 179, 1, 100.00, 1, 100.00, 239794, '', '2023-07-30 15:16:51'),
(262, 179, 15, 800.00, 1, 800.00, 239794, '', '2023-07-30 15:16:51'),
(263, 179, 13, 250.00, 1, 250.00, 239794, '', '2023-07-30 15:16:51'),
(264, 179, 18, 350.00, 1, 350.00, 239794, '', '2023-07-30 15:16:51'),
(265, 180, 10, 2000.00, 1, 2000.00, 278648, '', '2023-07-30 15:17:48'),
(266, 181, 1, 100.00, 1, 100.00, 433632, '', '2023-07-30 17:28:48'),
(267, 181, 15, 800.00, 1, 800.00, 433632, '', '2023-07-30 17:28:48'),
(268, 181, 13, 250.00, 1, 250.00, 433632, '', '2023-07-30 17:28:48'),
(269, 181, 18, 350.00, 1, 350.00, 433632, '', '2023-07-30 17:28:48'),
(270, 190, 1, 100.00, 1, 100.00, 906845, '', '2023-09-05 00:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tbl`
--

CREATE TABLE `appointment_tbl` (
  `appointment_payment_id` int(11) NOT NULL,
  `appointment_payment_same` int(11) NOT NULL,
  `appointment_payment_proof` varchar(250) NOT NULL,
  `appointment_date` int(11) NOT NULL,
  `appointment_payment_status` varchar(15) NOT NULL DEFAULT 'pending',
  `pet_ownerid` int(11) NOT NULL,
  `appointment_branch` int(11) NOT NULL,
  `appointment_coment` varchar(255) NOT NULL DEFAULT 'none',
  `appointment_payment_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_tbl`
--

INSERT INTO `appointment_tbl` (`appointment_payment_id`, `appointment_payment_same`, `appointment_payment_proof`, `appointment_date`, `appointment_payment_status`, `pet_ownerid`, `appointment_branch`, `appointment_coment`, `appointment_payment_dor`) VALUES
(179, 239794, 'gcashProofOfPayment-64c607295795e.jpg', 45, 'completed', 54, 8, 'none', '2023-07-30'),
(180, 278648, 'gcashProofOfPayment-64c60de46ee8a.jpg', 45, 'completed', 54, 8, 'none', '2023-07-30'),
(181, 433632, 'gcashProofOfPayment-64c62a82044e1.jpg', 45, 'completed', 54, 8, 'assddddsssddd', '2023-07-30'),
(182, 436896, '265971219_1254946065025920_2732222141938030163_n-64f55b214fa8f.png', 47, 'cancel', 60, 2, 'none', '2023-09-04'),
(183, 199565, '331071578_1905981169737742_6950448939031653227_n-64f55b4639215.jpg', 47, 'approved', 60, 2, '', '2023-09-04'),
(184, 127538, '331071578_1905981169737742_6950448939031653227_n-64f55b4d7935e.jpg', 47, 'cancel', 60, 2, 'none', '2023-09-04'),
(185, 492239, '346118392_508997227979629_3158509736187805000_n-64f55bb023d5e.jpg', 47, 'approved', 60, 2, '', '2023-09-04'),
(186, 601211, '367825498_279791558018935_6101178687688711885_n-64f56027dfebe.jpg', 47, 'cancel', 61, 2, 'none', '2023-09-04'),
(187, 392200, '367825498_279791558018935_6101178687688711885_n-64f5602da348e.jpg', 47, 'approved', 61, 2, 'tangina gumana rin', '2023-09-04'),
(188, 694817, '367825498_279791558018935_6101178687688711885_n (1)-64f560b988ccf.jpg', 47, 'approved', 61, 2, 'approve test notif', '2023-09-04'),
(189, 704814, '367825498_279791558018935_6101178687688711885_n (1)-64f5610d833b1.jpg', 47, 'cancel', 61, 2, 'none', '2023-09-04'),
(190, 906845, '367825498_279791558018935_6101178687688711885_n (1)-64f5611659511.jpg', 47, 'completed', 61, 2, 'tangina moren', '2023-09-04'),
(191, 344566, '318594138_2277251895792436_9140798039711393827_n-64f5629092fb7.png', 47, 'cancel', 61, 2, 'none', '2023-09-04'),
(192, 254869, '318594138_2277251895792436_9140798039711393827_n-64f563f028bf3.png', 49, 'approved', 62, 2, 'notif', '2023-09-04'),
(193, 475347, '367825498_279791558018935_6101178687688711885_n (1)-64f57630298b8.jpg', 48, 'approved', 62, 1, 'tangina mo', '2023-09-04'),
(194, 824345, '367825498_279791558018935_6101178687688711885_n (1)-64f576dfef55f.jpg', 48, 'pending', 62, 1, 'none', '2023-09-04'),
(195, 274, 'Walkin', 46, 'approved', 64, 2, 'none', '2023-09-04'),
(196, 904435, 'image_2023-09-04_225436607-64f5efafbdc4e.png', 47, 'approved', 65, 2, 'tangina', '2023-09-04'),
(197, 728019, '367825498_279791558018935_6101178687688711885_n (1)-64f5efe13fce2.jpg', 47, 'approved', 65, 2, 'tae', '2023-09-04'),
(198, 23366, '367825498_279791558018935_6101178687688711885_n (1)-64f5f74a9acaa.jpg', 47, 'approved', 65, 2, 'tangina', '2023-09-04'),
(199, 439479, '367825498_279791558018935_6101178687688711885_n (1)-64f5fb6e365c2.jpg', 47, 'approved', 65, 2, '', '2023-09-04'),
(200, 352312, '367825498_279791558018935_6101178687688711885_n (1)-64f5fc88b7024.jpg', 47, 'approved', 65, 2, '', '2023-09-04'),
(203, 861744, '367825498_279791558018935_6101178687688711885_n (1)-64f6110a735d6.jpg', 49, 'approved', 65, 2, 'tangina mo', '2023-09-05'),
(227, 93221, '367825498_279791558018935_6101178687688711885_n (1)-64f6173e3d0c4.jpg', 48, 'pending', 66, 1, 'none', '2023-09-05'),
(229, 478025, '367825498_279791558018935_6101178687688711885_n (1)-64f61808a060e.jpg', 51, 'pending', 66, 2, 'none', '2023-09-05'),
(230, 800459, '367825498_279791558018935_6101178687688711885_n (1)-64f61867efa94.jpg', 51, 'pending', 66, 2, 'none', '2023-09-05'),
(232, 596344, '367825498_279791558018935_6101178687688711885_n (1)-64f618cae9640.jpg', 51, 'approved', 66, 2, 'hayop alas dos na pala', '2023-09-05'),
(233, 514664, 'proof-64f733d4747fd.jpg', 48, 'approved', 67, 1, 'Please come before your schedule. Thanks', '2023-09-05');

--
-- Triggers `appointment_tbl`
--
DELIMITER $$
CREATE TRIGGER `copy_data_to_notification` AFTER INSERT ON `appointment_tbl` FOR EACH ROW BEGIN
    INSERT INTO notification (user_petnotifid, n_sub, n_msg)
    VALUES (NEW.pet_ownerid, NEW.appointment_payment_status, NEW.appointment_coment);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `branch_tbl`
--

CREATE TABLE `branch_tbl` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_isactive` int(11) NOT NULL DEFAULT 1,
  `branch_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_tbl`
--

INSERT INTO `branch_tbl` (`branch_id`, `branch_name`, `branch_isactive`, `branch_dor`) VALUES
(1, 'Balagtas', 1, '2023-06-15'),
(2, 'Marilao', 1, '2023-06-15'),
(3, 'Main', 1, '2023-06-21'),
(8, 'Bocaue', 1, '2023-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_isactive` int(11) NOT NULL DEFAULT 1,
  `category_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`category_id`, `category_name`, `category_isactive`, `category_dor`) VALUES
(1, 'CheckUp', 1, '2023-06-15'),
(2, 'Deworming for Cats', 1, '2023-06-15'),
(3, 'Deworming for Dogs', 1, '2023-06-15'),
(4, 'Vaccines', 1, '2023-06-15'),
(5, 'Wound Repair', 1, '2023-06-15'),
(6, 'Castration', 1, '2023-06-15'),
(7, 'Cs/Pyometra/Stone Removal', 1, '2023-06-15'),
(8, 'Treatment', 1, '2023-06-15'),
(9, 'Spay', 1, '2023-06-15'),
(10, 'Cherry Eye', 1, '2023-06-15'),
(11, 'Eyeball Removal', 1, '2023-06-15'),
(12, 'Tail Dock', 1, '2023-06-15'),
(13, 'Tumor Removal', 1, '2023-06-15'),
(14, 'Auricular', 1, '2023-06-15'),
(15, 'Shampoo', 1, '2023-07-24'),
(16, 'Soap', 1, '2023-07-24'),
(17, 'Fish food', 1, '2023-07-25'),
(18, 'X-ray', 1, '2023-07-25'),
(19, 'grooming 23', 1, '2023-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `end_user_tbl`
--

CREATE TABLE `end_user_tbl` (
  `end_user_id` int(11) NOT NULL,
  `end_user_name` varchar(50) NOT NULL,
  `end_user_lname` varchar(50) NOT NULL,
  `end_user_email` varchar(50) NOT NULL,
  `end_user_pass` varchar(70) NOT NULL,
  `end_user_isactive` int(11) NOT NULL DEFAULT 1,
  `end_user_type` varchar(15) NOT NULL,
  `end_user_branch` int(11) NOT NULL,
  `end_user_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `end_user_tbl`
--

INSERT INTO `end_user_tbl` (`end_user_id`, `end_user_name`, `end_user_lname`, `end_user_email`, `end_user_pass`, `end_user_isactive`, `end_user_type`, `end_user_branch`, `end_user_date`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '1234', 1, '0', 1, '2023-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `item_category_tbl`
--

CREATE TABLE `item_category_tbl` (
  `item_category_id` int(11) NOT NULL,
  `item_category_name` varchar(25) NOT NULL,
  `item_category_branch` int(11) NOT NULL,
  `item_category_isactive` int(11) NOT NULL DEFAULT 1,
  `item_category_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_category_tbl`
--

INSERT INTO `item_category_tbl` (`item_category_id`, `item_category_name`, `item_category_branch`, `item_category_isactive`, `item_category_dor`) VALUES
(1, 'Oral Medication', 1, 1, '2023-06-25'),
(3, 'Vitamins and Minerals', 1, 1, '2023-06-25'),
(4, 'Oral Medication', 2, 1, '2023-06-25'),
(6, 'Calcium Suplement', 1, 1, '2023-06-25'),
(7, 'dog food', 2, 1, '2023-07-21'),
(8, 'Perfume', 1, 1, '2023-07-24'),
(9, 'collar', 1, 1, '2023-07-25'),
(10, 'medicine', 1, 1, '2023-07-25'),
(11, 'shampoo123', 1, 1, '2023-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `item_tbl`
--

CREATE TABLE `item_tbl` (
  `item_id` int(11) NOT NULL,
  `item_code` varchar(25) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_categoryidfk` int(11) NOT NULL,
  `item_buying_price` double(11,2) NOT NULL,
  `item_selling_price` double(11,2) NOT NULL,
  `item_stock` int(11) NOT NULL,
  `item_status` varchar(25) NOT NULL,
  `item_expiration` date NOT NULL,
  `item_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_tbl`
--

INSERT INTO `item_tbl` (`item_id`, `item_code`, `item_name`, `item_categoryidfk`, `item_buying_price`, `item_selling_price`, `item_stock`, `item_status`, `item_expiration`, `item_dor`) VALUES
(1, 'ITM-00001', 'Mucotan', 1, 198.50, 350.00, 7, 'Critical Level', '0000-00-00', '2023-06-25'),
(5, 'ITM-00002', 'Animal Science Immune Health Tablet', 3, 5.60, 10.00, 4, 'Critical Level', '0000-00-00', '2023-06-25'),
(6, 'ITM-00003', 'Animal Science Calcium Tablet', 6, 5.50, 8.00, 0, 'Out of Stock', '0000-00-00', '2023-06-25'),
(8, 'ITM-00005', 'Mucotan', 4, 198.50, 350.00, 983, 'High Stock', '0000-00-00', '2023-06-25'),
(12, 'ITM-00006', 'special dog', 7, 100.00, 110.00, 90, 'High Stock', '0000-00-00', '2023-07-21'),
(13, 'ITM-00007', 'bench', 8, 150.00, 200.00, 49, 'High Stock', '2023-07-25', '2023-07-24'),
(14, 'ITM-00008', 'Red collar', 9, 50.00, 80.00, 50, 'High Stock', '0000-00-00', '2023-07-25'),
(15, 'ITM-00009', 'ibuprofen', 10, 100.00, 200.00, 10, 'Critical Level', '2023-11-22', '2023-07-25'),
(16, 'ITM-00010', 'selecta 123', 1, 20.00, 10.00, 20, 'High Stock', '0000-00-00', '2023-09-06');

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
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`n_id`, `user_petnotifid`, `n_sub`, `n_msg`) VALUES
(1, 66, 'approved', 'hayop alas dos na pala'),
(3, 66, 'approved', 'hayop alas dos na pala'),
(4, 67, 'approved', 'Please come before your schedule. Thanks');

-- --------------------------------------------------------

--
-- Table structure for table `ordernum_tbl`
--

CREATE TABLE `ordernum_tbl` (
  `ordernum_id` int(11) NOT NULL,
  `ordernum_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordernum_tbl`
--

INSERT INTO `ordernum_tbl` (`ordernum_id`, `ordernum_count`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `pet_user_id` int(11) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_gender` varchar(50) NOT NULL,
  `pet_dob` date NOT NULL,
  `pet_age` int(11) NOT NULL,
  `pet_sevice` varchar(50) NOT NULL,
  `pet_type` varchar(50) NOT NULL,
  `pet_breed` varchar(50) NOT NULL,
  `appointmentChek` int(11) NOT NULL,
  `pet_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_user_id`, `pet_name`, `pet_gender`, `pet_dob`, `pet_age`, `pet_sevice`, `pet_type`, `pet_breed`, `appointmentChek`, `pet_dor`) VALUES
(255, 54, 'naruto', 'male', '2023-01-30', 6, '', 'dog', 'Chiwawa', 0, '2023-07-30'),
(256, 54, 'sasuke', 'female', '2023-03-30', 4, '', 'cat', 'Pusakal', 0, '2023-07-30'),
(257, 54, 'aaaaa', 'female', '2023-01-30', 6, '', 'cat', 'Chiwawa', 0, '2023-07-30'),
(258, 54, 'bbbb', 'male', '2023-07-16', 0, '', 'cat', 'Pusakal', 0, '2023-07-30'),
(259, 60, 'Azumo', 'male', '2023-08-27', 1, '', 'fish', 'koi', 0, '2023-09-04'),
(260, 60, 'Sukuna', 'male', '2023-08-27', 1, '', 'bird', 'love bird', 0, '2023-09-04'),
(261, 60, 'Sukuna', 'male', '2023-08-27', 1, '', 'bird', 'love bird', 0, '2023-09-04'),
(262, 60, 'bulinggit', 'male', '2023-08-06', 1, '', 'reptile', 'crocodile', 0, '2023-09-04'),
(263, 61, 'alter', 'male', '2023-08-06', 1, '', 'bird', 'love bird', 0, '2023-09-04'),
(264, 61, 'alter', 'male', '2023-08-06', 1, '', 'bird', 'love bird', 0, '2023-09-04'),
(265, 61, 'bulinggit', 'female', '2023-07-23', 2, '', 'cat', 'persian', 0, '2023-09-04'),
(266, 61, 'Sneak', 'male', '2023-08-13', 1, '', 'dog', 'siberian husky', 0, '2023-09-04'),
(267, 61, 'Sneak', 'male', '2023-08-13', 1, '', 'dog', 'siberian husky', 0, '2023-09-04'),
(268, 61, 'Azumo', 'male', '2023-08-20', 1, '', 'bird', 'hungarian', 0, '2023-09-04'),
(269, 62, 'sabado', 'male', '2023-07-31', 2, '', 'bird', 'love bird', 0, '2023-09-04'),
(270, 63, 'luffy', 'male', '2023-08-20', 1, '', '', 'Aspin', 0, '2023-09-04'),
(271, 62, 'Azumo', 'male', '2023-08-21', 1, '', 'dog', 'persian', 0, '2023-09-04'),
(272, 62, 'eak', 'male', '2023-08-21', 1, '', 'cat', 'hungarian', 0, '2023-09-04'),
(273, 64, 'luffy', 'female', '2023-08-20', 1, '', 'Dog', 'Aspin', 0, '2023-09-04'),
(274, 65, 'Azumo', 'male', '2023-08-20', 1, '', 'dog', 'siberian husky', 0, '2023-09-04'),
(275, 65, 'eak', 'female', '2023-08-28', 1, '', 'cat', 'siberian husky', 0, '2023-09-04'),
(276, 65, 'Sukuna', 'male', '2023-08-29', 1, '', 'dog', 'siamese', 0, '2023-09-04'),
(277, 65, 'eak', 'male', '2023-08-29', 1, '', 'dog', 'siamese', 0, '2023-09-04'),
(278, 65, 'bulinggit', 'female', '2023-08-27', 1, '', 'cat', 'persian', 0, '2023-09-04'),
(279, 65, 'tagfa', 'female', '2023-08-27', 1, '', 'cat', 'persian', 0, '2023-09-05'),
(280, 65, 'tagfa', 'female', '2023-08-27', 1, '', 'cat', 'persian', 0, '2023-09-05'),
(281, 65, 'tamana', 'male', '2023-07-16', 2, '', 'dog', 'siberian husky', 0, '2023-09-05'),
(282, 65, 'Chase', 'male', '2023-07-03', 2, '', 'cat', 'persian', 0, '2023-09-05'),
(283, 65, 'Chase', 'male', '2023-07-03', 2, '', 'cat', 'persian', 0, '2023-09-05'),
(284, 65, 'Sneak', 'male', '2023-09-17', 0, '', 'dog', 'love bird', 0, '2023-09-05'),
(285, 65, 'Azumo', 'male', '2023-08-27', 1, '', 'cat', 'persian', 0, '2023-09-05'),
(286, 66, 'bulinggit', 'female', '2023-09-03', 0, '', 'cat', 'persian', 0, '2023-09-05'),
(287, 66, 'bulinggit', 'female', '2023-09-03', 0, '', 'cat', 'persian', 0, '2023-09-05'),
(288, 66, 'bulinggit', 'male', '2023-08-27', 1, '', 'cat', 'persian', 0, '2023-09-05'),
(289, 66, 'bulinggit', 'male', '2023-08-27', 1, '', 'cat', 'persian', 0, '2023-09-05'),
(290, 66, 'bulinggit', 'male', '2023-08-27', 1, '', 'cat', 'persian', 0, '2023-09-05'),
(291, 67, 'Goku', 'male', '2022-12-12', 9, '', 'dog', 'Husky', 0, '2023-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `pet_services_his_tbl`
--

CREATE TABLE `pet_services_his_tbl` (
  `pet_services_his_id` int(11) NOT NULL,
  `pet_services_his_servidfk` int(11) NOT NULL,
  `pet_services_his_name` int(11) NOT NULL,
  `pet_services_his_status` varchar(50) NOT NULL DEFAULT 'pending',
  `pet_services_his_amount` double(11,2) NOT NULL,
  `pet_services_his_sameappoint` int(11) NOT NULL,
  `user_petownerid` int(11) NOT NULL,
  `history_coment` varchar(255) NOT NULL DEFAULT 'none',
  `pet_services_his_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_services_his_tbl`
--

INSERT INTO `pet_services_his_tbl` (`pet_services_his_id`, `pet_services_his_servidfk`, `pet_services_his_name`, `pet_services_his_status`, `pet_services_his_amount`, `pet_services_his_sameappoint`, `user_petownerid`, `history_coment`, `pet_services_his_dor`) VALUES
(568, 254, 1, 'pending', 0.00, 239794, 54, 'none', '2023-07-30'),
(569, 254, 15, 'pending', 0.00, 239794, 54, 'none', '2023-07-30'),
(570, 255, 13, 'pending', 0.00, 239794, 54, 'none ', '2023-07-30'),
(571, 255, 18, 'pending', 0.00, 239794, 54, 'none', '2023-07-30'),
(572, 256, 10, 'pending', 0.00, 278648, 54, 'none', '2023-07-30'),
(573, 257, 1, 'pending', 0.00, 433632, 54, 'none', '2023-07-30'),
(574, 257, 15, 'pending', 0.00, 433632, 54, 'none', '2023-07-30'),
(575, 258, 13, 'pending', 0.00, 433632, 54, 'none', '2023-07-30'),
(576, 258, 18, 'pending', 0.00, 433632, 54, 'none', '2023-07-30'),
(577, 259, 1, 'pending', 0.00, 436896, 60, 'none', '2023-09-04'),
(578, 260, 2, 'pending', 0.00, 199565, 60, 'none', '2023-09-04'),
(579, 261, 2, 'pending', 0.00, 127538, 60, 'none', '2023-09-04'),
(580, 262, 1, 'pending', 0.00, 492239, 60, 'none', '2023-09-04'),
(581, 263, 1, 'pending', 0.00, 601211, 61, 'none', '2023-09-04'),
(582, 264, 1, 'pending', 0.00, 392200, 61, 'none', '2023-09-04'),
(583, 265, 1, 'pending', 0.00, 694817, 61, 'none', '2023-09-04'),
(584, 266, 1, 'pending', 0.00, 704814, 61, 'none', '2023-09-04'),
(585, 267, 1, 'pending', 0.00, 906845, 61, 'none', '2023-09-04'),
(586, 268, 1, 'pending', 0.00, 344566, 61, 'none', '2023-09-04'),
(587, 269, 1, 'pending', 0.00, 254869, 62, 'none', '2023-09-04'),
(588, 271, 1, 'pending', 0.00, 475347, 62, 'none', '2023-09-04'),
(589, 272, 1, 'pending', 0.00, 824345, 62, 'none', '2023-09-04'),
(590, 273, 2, 'pending', 0.00, 274, 64, 'none', '2023-09-04'),
(591, 273, 1, 'pending', 0.00, 274, 64, 'none', '2023-09-04'),
(592, 274, 1, 'pending', 0.00, 904435, 65, 'none', '2023-09-04'),
(593, 275, 1, 'pending', 0.00, 728019, 65, 'none', '2023-09-04'),
(594, 276, 1, 'pending', 0.00, 23366, 65, 'none', '2023-09-04'),
(595, 277, 1, 'pending', 0.00, 439479, 65, 'none', '2023-09-04'),
(596, 278, 1, 'pending', 0.00, 352312, 65, 'none', '2023-09-04'),
(597, 279, 15, 'pending', 0.00, 283258, 65, 'none', '2023-09-05'),
(598, 280, 15, 'pending', 0.00, 769673, 65, 'none', '2023-09-05'),
(599, 281, 1, 'pending', 0.00, 861744, 65, 'none', '2023-09-05'),
(600, 282, 1, 'pending', 0.00, 329425, 65, 'none', '2023-09-05'),
(601, 283, 1, 'pending', 0.00, 95492, 65, 'none', '2023-09-05'),
(602, 284, 1, 'pending', 0.00, 650455, 65, 'none', '2023-09-05'),
(603, 285, 1, 'pending', 0.00, 955894, 65, 'none', '2023-09-05'),
(605, 287, 1, 'pending', 0.00, 165279, 65, 'none', '2023-09-05'),
(606, 288, 1, 'pending', 0.00, 292743, 66, 'none', '2023-09-05'),
(607, 289, 1, 'pending', 0.00, 70544, 66, 'none', '2023-09-05'),
(608, 290, 2, 'pending', 0.00, 750696, 66, 'none', '2023-09-05'),
(609, 291, 13, 'pending', 0.00, 486943, 66, 'none', '2023-09-05'),
(610, 291, 2, 'pending', 0.00, 486943, 66, 'none', '2023-09-05'),
(611, 292, 13, 'pending', 0.00, 26344, 66, 'none', '2023-09-05'),
(612, 292, 2, 'pending', 0.00, 26344, 66, 'none', '2023-09-05'),
(613, 293, 1, 'pending', 0.00, 546652, 66, 'none', '2023-09-05'),
(614, 294, 1, 'pending', 0.00, 952776, 66, 'none', '2023-09-05'),
(615, 295, 1, 'pending', 0.00, 665338, 66, 'none', '2023-09-05'),
(616, 296, 2, 'pending', 0.00, 838659, 66, 'none', '2023-09-05'),
(617, 296, 4, 'pending', 0.00, 838659, 66, 'none', '2023-09-05'),
(618, 297, 2, 'pending', 0.00, 818227, 66, 'none', '2023-09-05'),
(619, 297, 4, 'pending', 0.00, 818227, 66, 'none', '2023-09-05'),
(620, 298, 2, 'pending', 0.00, 917344, 66, 'none', '2023-09-05'),
(621, 298, 4, 'pending', 0.00, 917344, 66, 'none', '2023-09-05'),
(622, 299, 2, 'pending', 0.00, 972798, 66, 'none', '2023-09-05'),
(623, 299, 4, 'pending', 0.00, 972798, 66, 'none', '2023-09-05'),
(624, 300, 2, 'pending', 0.00, 418259, 66, 'none', '2023-09-05'),
(625, 300, 4, 'pending', 0.00, 418259, 66, 'none', '2023-09-05'),
(626, 301, 2, 'pending', 0.00, 254615, 66, 'none', '2023-09-05'),
(627, 301, 4, 'pending', 0.00, 254615, 66, 'none', '2023-09-05'),
(628, 302, 2, 'pending', 0.00, 709839, 66, 'none', '2023-09-05'),
(629, 302, 4, 'pending', 0.00, 709839, 66, 'none', '2023-09-05'),
(630, 303, 2, 'pending', 0.00, 364989, 66, 'none', '2023-09-05'),
(631, 303, 4, 'pending', 0.00, 364989, 66, 'none', '2023-09-05'),
(632, 304, 2, 'pending', 0.00, 98450, 66, 'none', '2023-09-05'),
(633, 304, 4, 'pending', 0.00, 98450, 66, 'none', '2023-09-05'),
(634, 305, 2, 'pending', 0.00, 936383, 66, 'none', '2023-09-05'),
(635, 305, 4, 'pending', 0.00, 936383, 66, 'none', '2023-09-05'),
(636, 306, 1, 'pending', 0.00, 93221, 66, 'none', '2023-09-05'),
(638, 308, 1, 'pending', 0.00, 802229, 66, 'none', '2023-09-05'),
(639, 309, 1, 'pending', 0.00, 478025, 66, 'none', '2023-09-05'),
(640, 310, 1, 'pending', 0.00, 800459, 66, 'none', '2023-09-05'),
(641, 311, 1, 'pending', 0.00, 358327, 66, 'none', '2023-09-05'),
(642, 312, 1, 'pending', 0.00, 596344, 66, 'none', '2023-09-05'),
(643, 313, 3, 'pending', 0.00, 514664, 67, 'none', '2023-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `pet_services_tbl`
--

CREATE TABLE `pet_services_tbl` (
  `pet_services_id` int(11) NOT NULL,
  `pet_name_id` int(11) NOT NULL,
  `pet_service_cat` int(11) NOT NULL,
  `pet_services_name` varchar(50) NOT NULL,
  `pet_sevice_status` varchar(50) NOT NULL DEFAULT 'pending',
  `pet_services_branchidfk` int(11) NOT NULL,
  `pet_service_idowner` int(11) NOT NULL,
  `pet_service_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_services_tbl`
--

INSERT INTO `pet_services_tbl` (`pet_services_id`, `pet_name_id`, `pet_service_cat`, `pet_services_name`, `pet_sevice_status`, `pet_services_branchidfk`, `pet_service_idowner`, `pet_service_dor`) VALUES
(254, 255, 239794, 'Check up,Vcheck', 'pending', 8, 54, '2023-07-30'),
(255, 256, 239794, 'anal sac drain,Full body', 'pending', 8, 54, '2023-07-30'),
(256, 255, 278648, '1eye', 'pending', 8, 54, '2023-07-30'),
(257, 257, 433632, 'Check up,Vcheck', 'pending', 8, 54, '2023-07-30'),
(258, 258, 433632, 'anal sac drain,Full body', 'pending', 8, 54, '2023-07-30'),
(259, 259, 436896, 'Check up', 'pending', 2, 60, '2023-09-04'),
(260, 260, 199565, 'upto 2kg', 'pending', 2, 60, '2023-09-04'),
(261, 261, 127538, 'upto 2kg', 'pending', 2, 60, '2023-09-04'),
(262, 262, 492239, 'Check up', 'pending', 2, 60, '2023-09-04'),
(263, 263, 601211, 'Check up', 'pending', 2, 61, '2023-09-04'),
(264, 264, 392200, 'Check up', 'pending', 2, 61, '2023-09-04'),
(265, 265, 694817, 'Check up', 'pending', 2, 61, '2023-09-04'),
(266, 266, 704814, 'Check up', 'pending', 2, 61, '2023-09-04'),
(267, 267, 906845, 'Check up', 'pending', 2, 61, '2023-09-04'),
(268, 268, 344566, 'Check up', 'pending', 2, 61, '2023-09-04'),
(269, 269, 254869, 'Check up', 'pending', 2, 62, '2023-09-04'),
(271, 271, 475347, 'Check up', 'pending', 1, 62, '2023-09-04'),
(272, 272, 824345, 'Check up', 'pending', 1, 62, '2023-09-04'),
(273, 273, 274, 'upto 2kg,Check up', 'pending', 2, 64, '2023-09-04'),
(274, 274, 904435, 'Check up', 'pending', 2, 65, '2023-09-04'),
(275, 275, 728019, 'Check up', 'pending', 2, 65, '2023-09-04'),
(276, 276, 23366, 'Check up', 'pending', 2, 65, '2023-09-04'),
(277, 277, 439479, 'Check up', 'pending', 2, 65, '2023-09-04'),
(278, 278, 352312, 'Check up', 'pending', 2, 65, '2023-09-04'),
(279, 279, 283258, 'Vcheck', 'pending', 2, 65, '2023-09-05'),
(280, 280, 769673, 'Vcheck', 'pending', 2, 65, '2023-09-05'),
(281, 281, 861744, 'Check up', 'pending', 2, 65, '2023-09-05'),
(282, 282, 329425, 'Check up', 'pending', 2, 65, '2023-09-05'),
(283, 283, 95492, 'Check up', 'pending', 2, 65, '2023-09-05'),
(284, 284, 650455, 'Check up', 'pending', 2, 65, '2023-09-05'),
(285, 285, 955894, 'Check up', 'pending', 2, 65, '2023-09-05'),
(286, 275, 346955, '', 'pending', 2, 65, '2023-09-05'),
(287, 275, 165279, 'Check up', 'pending', 2, 65, '2023-09-05'),
(288, 286, 292743, 'Check up', 'pending', 2, 66, '2023-09-05'),
(289, 287, 70544, 'Check up', 'pending', 2, 66, '2023-09-05'),
(290, 288, 750696, 'upto 2kg', 'pending', 2, 66, '2023-09-05'),
(291, 289, 486943, 'anal sac drain,upto 2kg', 'pending', 2, 66, '2023-09-05'),
(292, 290, 26344, 'anal sac drain,upto 2kg', 'pending', 2, 66, '2023-09-05'),
(293, 288, 546652, 'Check up', 'pending', 2, 66, '2023-09-05'),
(294, 290, 952776, 'Check up', 'pending', 2, 66, '2023-09-05'),
(295, 288, 665338, 'Check up', 'pending', 2, 66, '2023-09-05'),
(296, 287, 838659, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(297, 287, 818227, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(298, 287, 917344, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(299, 287, 972798, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(300, 287, 418259, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(301, 287, 254615, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(302, 287, 709839, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(303, 287, 364989, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(304, 287, 98450, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(305, 287, 936383, 'upto 2kg,upto 2kg', 'pending', 1, 66, '2023-09-05'),
(306, 290, 93221, 'Check up', 'pending', 1, 66, '2023-09-05'),
(307, 290, 448308, '', 'pending', 1, 66, '2023-09-05'),
(308, 290, 802229, 'Check up', 'pending', 1, 66, '2023-09-05'),
(309, 288, 478025, 'Check up', 'pending', 2, 66, '2023-09-05'),
(310, 289, 800459, 'Check up', 'pending', 2, 66, '2023-09-05'),
(311, 290, 358327, 'Check up', 'pending', 2, 66, '2023-09-05'),
(312, 289, 596344, 'Check up', 'pending', 2, 66, '2023-09-05'),
(313, 291, 514664, 'upto 2kg', 'pending', 1, 67, '2023-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `pos_ordered_tbl`
--

CREATE TABLE `pos_ordered_tbl` (
  `pos_ordered_id` int(11) NOT NULL,
  `pos_ordered_numidfk` varchar(100) NOT NULL,
  `pos_ordered_totalamnt` double(11,2) NOT NULL,
  `pos_ordered_payment` double(11,2) NOT NULL,
  `pos_ordered_change` double(11,2) NOT NULL,
  `pos_ordered_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_ordered_tbl`
--

INSERT INTO `pos_ordered_tbl` (`pos_ordered_id`, `pos_ordered_numidfk`, `pos_ordered_totalamnt`, `pos_ordered_payment`, `pos_ordered_change`, `pos_ordered_dor`) VALUES
(23, '2105690849', 350.00, 400.00, 50.00, '2023-06-27'),
(24, '8026168381', 700.00, 1000.00, 300.00, '2023-06-27'),
(25, '7917585809', 718.00, 1000.00, 282.00, '2023-06-27'),
(26, '8043357029', 700.00, 1000.00, 300.00, '2023-06-27'),
(27, '1641081753', 1.00, 1800.00, 50.00, '2023-06-27'),
(28, '5756401111', 1.00, 1100.00, 50.00, '2023-06-28'),
(29, '276382433', 1.00, 1500.00, 90.00, '2023-06-28'),
(30, '9855157569', 4.00, 4300.00, 70.00, '2023-07-18'),
(31, '6092852464', 80.00, 100.00, 20.00, '2023-07-18'),
(32, '687733083', 350.00, 500.00, 150.00, '2023-07-21'),
(33, '5433976791', 1.00, 2000.00, 250.00, '2023-07-21'),
(34, '8636948282', 1.00, 2000.00, 950.00, '2023-07-24'),
(35, '102849998', 350.00, 500.00, 150.00, '2023-07-24'),
(36, '8374236384', 420.00, 500.00, 80.00, '2023-07-24'),
(37, '3585692084', 400.00, 500.00, 100.00, '2023-07-25'),
(38, '9636998875', 10.00, 20.00, 10.00, '2023-07-26'),
(39, '29', 50.00, 40.00, -10.00, '2023-07-26'),
(40, '29', 50.00, 40.00, -10.00, '2023-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_list_tbl`
--

CREATE TABLE `pos_order_list_tbl` (
  `pos_order_list_id` int(11) NOT NULL,
  `pos_order_list_itemidfk` int(11) NOT NULL,
  `pos_order_list_itemName` varchar(50) NOT NULL,
  `pos_order_list_itemprice` double(11,2) NOT NULL,
  `pos_order_list_itemqty` int(11) NOT NULL DEFAULT 1,
  `pos_order_list_itemamt` double(11,2) NOT NULL,
  `pos_order_list_ordernum` int(11) NOT NULL,
  `pos_order_list_itmstock` int(11) NOT NULL,
  `pos_order_list_visble` int(11) NOT NULL DEFAULT 1,
  `pos_order_list_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_order_list_tbl`
--

INSERT INTO `pos_order_list_tbl` (`pos_order_list_id`, `pos_order_list_itemidfk`, `pos_order_list_itemName`, `pos_order_list_itemprice`, `pos_order_list_itemqty`, `pos_order_list_itemamt`, `pos_order_list_ordernum`, `pos_order_list_itmstock`, `pos_order_list_visble`, `pos_order_list_dor`) VALUES
(483, 1, 'Mucotan', 350.00, 1, 0.00, 2147483647, 7, 1, '2023-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `pos_purchase_his_tbl`
--

CREATE TABLE `pos_purchase_his_tbl` (
  `pos_purchase_his_id` int(11) NOT NULL,
  `pos_purchase_hisitemidfk` int(11) NOT NULL,
  `pos_purchase_hisitemname` varchar(50) NOT NULL,
  `pos_purchase_hisitemprice` double(11,2) NOT NULL,
  `pos_purchase_hisitemqty` int(11) NOT NULL,
  `pos_purchase_hisitemtotalAmt` double(11,2) NOT NULL,
  `pos_purchase_hisordrnum` varchar(100) NOT NULL,
  `pos_hisorder_list_idfk` int(11) NOT NULL,
  `lastid` int(11) NOT NULL,
  `isProceed` int(11) NOT NULL,
  `pos_purchase_his_enduser` int(11) NOT NULL,
  `pos_purchasehis_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_purchase_his_tbl`
--

INSERT INTO `pos_purchase_his_tbl` (`pos_purchase_his_id`, `pos_purchase_hisitemidfk`, `pos_purchase_hisitemname`, `pos_purchase_hisitemprice`, `pos_purchase_hisitemqty`, `pos_purchase_hisitemtotalAmt`, `pos_purchase_hisordrnum`, `pos_hisorder_list_idfk`, `lastid`, `isProceed`, `pos_purchase_his_enduser`, `pos_purchasehis_dor`) VALUES
(76, 8, 'Mucotan', 350.00, 1, 350.00, '2105690849', 392, 274, 1, 12, '2023-06-17'),
(77, 8, 'Mucotan', 350.00, 2, 700.00, '8026168381', 396, 275, 1, 12, '2023-06-29'),
(78, 5, 'Animal Science Immune Health Tablet', 10.00, 1, 10.00, '7917585809', 397, 276, 1, 2, '2023-06-27'),
(79, 6, 'Animal Science Calcium Tablet', 8.00, 1, 8.00, '7917585809', 398, 277, 1, 2, '2023-06-27'),
(80, 8, 'Mucotan', 350.00, 1, 350.00, '7917585809', 399, 278, 1, 2, '2023-06-27'),
(81, 1, 'Mucotan', 350.00, 1, 350.00, '7917585809', 400, 279, 1, 2, '2023-06-27'),
(82, 8, 'Mucotan', 350.00, 2, 700.00, '8043357029', 401, 280, 1, 12, '2023-06-27'),
(83, 8, 'Mucotan', 350.00, 5, 1750.00, '1641081753', 402, 281, 1, 12, '2023-06-27'),
(84, 1, 'Mucotan', 350.00, 3, 1050.00, '5756401111', 403, 282, 1, 2, '2023-06-28'),
(85, 1, 'Mucotan', 350.00, 3, 1050.00, '276382433', 405, 283, 1, 2, '2023-06-28'),
(86, 5, 'Animal Science Immune Health Tablet', 10.00, 1, 10.00, '276382433', 404, 284, 1, 2, '2023-06-28'),
(87, 8, 'Mucotan', 350.00, 1, 350.00, '276382433', 406, 285, 1, 2, '2023-06-28'),
(88, 5, 'Animal Science Immune Health Tablet', 10.00, 2, 20.00, '9036123061', 407, 286, 0, 2, '2023-07-14'),
(89, 1, 'Mucotan', 350.00, 7, 2450.00, '9855157569', 408, 287, 1, 2, '2023-07-18'),
(90, 8, 'Mucotan', 350.00, 5, 1750.00, '9855157569', 409, 288, 1, 2, '2023-07-18'),
(91, 5, 'Animal Science Immune Health Tablet', 10.00, 3, 30.00, '9855157569', 410, 289, 1, 2, '2023-07-18'),
(92, 6, 'Animal Science Calcium Tablet', 8.00, 10, 80.00, '6092852464', 412, 290, 1, 2, '2023-07-18'),
(93, 8, 'Mucotan', 350.00, 1, 350.00, '687733083', 414, 291, 1, 2, '2023-07-21'),
(94, 1, 'Mucotan', 350.00, 1, 350.00, '1990782713', 418, 292, 0, 2, '2023-07-21'),
(95, 1, 'Mucotan', 350.00, 1, 350.00, '309745047', 419, 293, 0, 2, '2023-07-21'),
(96, 1, 'Mucotan', 350.00, 5, 1750.00, '5433976791', 420, 294, 1, 2, '2023-07-21'),
(97, 1, 'Mucotan', 350.00, 3, 1050.00, '8636948282', 425, 295, 1, 2, '2023-07-24'),
(98, 1, 'Mucotan', 350.00, 1, 350.00, '102849998', 426, 296, 1, 2, '2023-07-24'),
(102, 12, 'special dog', 110.00, 2, 220.00, '8374236384', 432, 300, 1, 21, '2023-07-24'),
(103, 13, 'bench', 200.00, 1, 200.00, '8374236384', 433, 301, 1, 21, '2023-07-24'),
(105, 14, 'Red collar', 80.00, 5, 400.00, '3585692084', 436, 303, 1, 23, '2023-07-25'),
(106, 5, 'Animal Science Immune Health Tablet', 10.00, 1, 10.00, '9636998875', 449, 304, 1, 2, '2023-07-26'),
(107, 5, 'Animal Science Immune Health Tablet', 10.00, 1, 10.00, '5954159202', 468, 305, 0, 21, '2023-07-28'),
(108, 1, 'Mucotan', 350.00, 1, 350.00, '5954159202', 469, 306, 0, 21, '2023-07-28'),
(109, 14, 'Red collar', 80.00, 1, 80.00, '5954159202', 470, 307, 0, 21, '2023-07-28'),
(110, 1, 'Mucotan', 350.00, 1, 350.00, '6118717674', 482, 308, 0, 21, '2023-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `pos_purchase_tbl`
--

CREATE TABLE `pos_purchase_tbl` (
  `pos_purchase_id` int(11) NOT NULL,
  `pos_purchase_itemidfk` int(11) NOT NULL,
  `pos_purchase_itemname` varchar(50) NOT NULL,
  `pos_purchase_itemprice` double(11,2) NOT NULL,
  `pos_purchase_itemqty` int(11) NOT NULL,
  `pos_purchase_itemtotalAmt` double(11,2) NOT NULL,
  `pos_purchase_ordrnum` int(11) NOT NULL,
  `pos_order_list_idfk` int(11) NOT NULL,
  `pos_purchase_dor` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_trans_tbl`
--

CREATE TABLE `pos_trans_tbl` (
  `pos_trans_id` int(11) NOT NULL,
  `pos_trans_totalPurchase` double(11,2) NOT NULL,
  `pos_trans_payment` double(11,2) NOT NULL,
  `pos_trans_change/bal` double(11,2) NOT NULL,
  `pos_purchase_idfk` int(11) NOT NULL,
  `pos_trans_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sample_tbl`
--

CREATE TABLE `sample_tbl` (
  `sample_id` int(11) NOT NULL,
  `sample_services` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `petname` varchar(60) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `petype` varchar(60) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `bday` varchar(50) NOT NULL,
  `dateToday` varchar(20) NOT NULL,
  `staff` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `duration` varchar(25) NOT NULL,
  `endtime` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sample_tbl`
--

INSERT INTO `sample_tbl` (`sample_id`, `sample_services`, `fname`, `lname`, `email`, `petname`, `breed`, `petype`, `gender`, `bday`, `dateToday`, `staff`, `time`, `duration`, `endtime`) VALUES
(99, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(100, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(101, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(102, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(103, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(104, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(105, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(106, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(107, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(108, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(109, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(110, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(111, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(112, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(113, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(114, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(115, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(116, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(117, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(118, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(119, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(120, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(121, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(122, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(123, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(124, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(125, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(126, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(127, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(128, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(129, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(130, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(131, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-20', '25', '14', '12:30', '135', '14:45:00'),
(132, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '25', '14', '13:08', '135', '15:23:00'),
(133, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '25', '14', '13:08', '135', '15:23:00'),
(134, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '25', '14', '13:08', '135', '15:23:00'),
(135, '11', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '25', '14', '13:08', '135', '15:23:00'),
(136, '12', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '25', '14', '13:08', '135', '15:23:00'),
(137, '13', 'JEN', 'NEBRIDA', 'jennifernebrida2811@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '25', '14', '13:08', '135', '15:23:00'),
(138, '13', 'JEN', 'NEBRIDA', 'jennifernebrida28112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '25', '14', '02:08', '15', '02:23:00'),
(139, '11', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'luffy', 'goma', 'monkey', 'male', '2023-01-03', '28', '', '', '60', '02:00:00'),
(140, '11', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '29', '14', '08:32', '75', '09:47:00'),
(141, '13', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '29', '14', '08:32', '75', '09:47:00'),
(142, '12', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '<br />\r\n<b>Warning</', '14', '08:10', '60', '09:10:00'),
(143, '12', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '', '<br />\r\n<b>Warning</', '14', '08:10', '60', '09:10:00'),
(144, '14', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-21', '24', '14', '08:17', '130', '10:27:00'),
(145, '10', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-21', '24', '14', '08:17', '130', '10:27:00'),
(146, '12', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-21', '31', '14', '08:40', '75', '09:55:00'),
(147, '13', 'JEN', 'NEBRIDA', 'jennifernebrida282112@gmail.com', 'jen', 'wawachi', 'dog', 'male', '2023-01-21', '31', '14', '08:40', '75', '09:55:00'),
(148, '10', 'JEN', 'NEBRIDA', 'jennifernebrida28112@gmail.com', 'luffy', 'wawachi', 'monkey', 'female', '2023-01-21', '31', '14', '08:55', '80', '10:15:00'),
(149, '11', 'jerome', 'guil', 'guillermojerome.pdm@gmail.com', 'luffy', 'goma', 'dog', 'male', '2023-01-21', '36', '14', '09:49', '60', '10:49:00'),
(150, '11', 'jerome', 'guil', 'guillermojerome.pdm@gmail.com', 'luffy', 'goma', 'dog', 'male', '2023-01-21', '33', '12', '05:54', '60', '06:54:00'),
(151, '11', 'jerome', 'guil', 'guillermojeroame.pdm@gmail.com', 'luffy', 'goma', 'dog', 'male', '2023-01-21', '33', '11', '11:54', '60', '12:54:00'),
(152, '12', 'Jerome', 'guil', 'guillermojessromaer.pdm@gmail.com', 'luffy', 'Goma', 'Monkey', 'male', '2023-07-31', '33', '11', '06:19', '60', '07:19:00'),
(153, '12', 'Jerome', 'guil', 'guillermojeromer.pdm@gmail.com', 'luffy', 'Goma', 'Monkey', 'male', '2023-07-24', '33', '11', '07:10', '60', '08:10:00'),
(154, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-04-05', '34', '18', '21:22', '65', '22:27:00'),
(155, '4', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-04-05', '34', '18', '21:22', '65', '22:27:00'),
(156, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-04-05', '34', '18', '21:22', '65', '22:27:00'),
(157, '4', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-04-05', '34', '18', '21:22', '65', '22:27:00'),
(158, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-04-05', '34', '18', '21:23', '65', '22:28:00'),
(159, '4', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-04-05', '34', '18', '21:23', '65', '22:28:00'),
(160, '5', 'Jerwin', 'Tugas', 'kaidojer@gmail.com', 'Sabrina', 'Husky', 'Dog', 'female', '2021-06-01', '34', '18', '21:27', '50', '22:17:00'),
(161, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-07-24', '34', '12', '21:28', '45', '22:13:00'),
(162, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-07-24', '34', '12', '21:29', '45', '22:14:00'),
(163, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-07-24', '34', '12', '21:29', '45', '22:14:00'),
(164, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-07-24', '34', '12', '21:29', '45', '22:14:00'),
(165, '1', 'Alex', 'Inciong', 'aceunitro55@gmail.com', 'kenma', 'persian', 'cat', 'male', '2023-07-24', '34', '12', '21:32', '45', '22:17:00'),
(166, '3', 'Jennisa', 'Lingamen', 'kaidojer@gmail.com', 'Sabrina', 'doberman', 'dog', 'male', '2023-07-05', '43', '23', '13:26', '45', '14:11:00'),
(167, '3', 'Jennisa', 'Lingamen', 'aceunitro55@gmail.com', 'Sabrina', 'doberman', 'dog', 'male', '2023-07-05', '43', '23', '13:28', '45', '14:13:00'),
(168, '16', 'aaa', 'asas', 'asasa@gmail.com', 'asa', 'sadsa', 'sad', 'female', '2023-07-25', '43', '24', '08:30', '50', '09:20:00'),
(169, '18', 'aaa', 'asas', 'asasa@gmail.com', 'asa', 'sadsa', 'sad', 'female', '2023-07-25', '43', '24', '08:30', '50', '09:20:00'),
(170, '13', 'aaa', 'asas', 'aaa@gmail.com', 'aaaa', 'aa', 'aaa', 'male', '2023-07-17', '43', '23', '08:10', '15', '08:25:00'),
(171, '13', 'aaa', 'asas', 'aa1a@gmail.com', 'aaaa', 'aa', 'aaa', 'male', '2023-07-17', '43', '23', '08:10', '15', '08:25:00'),
(172, '1', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Aspin', '', 'male', '2023-08-20', '46', 'Choose', '13:41', '45', '14:26:00'),
(173, '1', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Aspin', '', 'male', '2023-08-20', '46', '20', '13:41', '45', '14:26:00'),
(174, '1', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Puspin', 'Fish', 'male', '2023-08-20', '50', '21', '14:24', '45', '15:09:00'),
(175, '1', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Puspin', 'Fish', 'male', '2023-08-20', '50', '21', '14:24', '45', '15:09:00'),
(176, '1', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Puspin', 'Fish', 'male', '2023-08-20', '50', '21', '14:24', '45', '15:09:00'),
(177, '2', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Aspin', 'Dog', 'female', '2023-08-20', '46', '20', '14:25', '90', '15:55:00'),
(178, '1', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Aspin', 'Dog', 'female', '2023-08-20', '46', '20', '14:25', '90', '15:55:00'),
(179, '2', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Aspin', 'Dog', 'female', '2023-08-20', '46', '20', '14:25', '90', '15:55:00'),
(180, '1', 'Alex', 'inciong', 'xname@gmail.com', 'luffy', 'Aspin', 'Dog', 'female', '2023-08-20', '46', '20', '14:25', '90', '15:55:00'),
(181, '2', 'Alex', 'inciong', 'jamiel.kaylor@feerock.com', 'luffy', 'Aspin', 'Dog', 'female', '2023-08-20', '46', '20', '14:25', '90', '15:55:00'),
(182, '1', 'Alex', 'inciong', 'jamiel.kaylor@feerock.com', 'luffy', 'Aspin', 'Dog', 'female', '2023-08-20', '46', '20', '14:25', '90', '15:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_tbl`
--

CREATE TABLE `schedule_tbl` (
  `schedule_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_startTime` time NOT NULL DEFAULT '08:00:00',
  `schedule_endTime` time NOT NULL DEFAULT '17:00:00',
  `schedule_isavail` int(11) NOT NULL DEFAULT 1,
  `schedule_branch` int(11) NOT NULL,
  `scheduledate_count` int(11) NOT NULL,
  `scheduledate_full` int(11) NOT NULL,
  `schedule_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_tbl`
--

INSERT INTO `schedule_tbl` (`schedule_id`, `schedule_date`, `schedule_startTime`, `schedule_endTime`, `schedule_isavail`, `schedule_branch`, `scheduledate_count`, `scheduledate_full`, `schedule_dor`) VALUES
(32, '2023-07-22', '08:00:00', '17:00:00', 0, 2, 0, 0, '2023-07-21'),
(33, '2023-07-21', '08:00:00', '17:00:00', 1, 2, 0, 0, '2023-07-21'),
(34, '2023-07-24', '08:00:00', '17:00:00', 1, 2, 0, 0, '2023-07-21'),
(35, '2023-07-25', '08:00:00', '17:00:00', 1, 1, 0, 0, '2023-07-21'),
(36, '2023-07-21', '08:00:00', '17:00:00', 1, 1, 0, 0, '2023-07-21'),
(37, '2023-07-25', '08:00:00', '17:00:00', 1, 2, 0, 0, '2023-07-24'),
(38, '2023-07-28', '08:00:00', '17:00:00', 1, 2, 1, 0, '2023-07-24'),
(39, '2023-07-27', '08:00:00', '17:00:00', 1, 2, 0, 0, '2023-07-24'),
(40, '2023-07-26', '08:00:00', '17:00:00', 0, 1, 0, 0, '2023-07-24'),
(41, '2023-07-31', '08:00:00', '17:00:00', 1, 1, 2, 0, '2023-07-25'),
(42, '2023-07-31', '08:00:00', '17:00:00', 1, 8, 4, 0, '2023-07-25'),
(43, '2023-07-25', '08:00:00', '17:00:00', 1, 8, 0, 0, '2023-07-25'),
(44, '2023-07-28', '08:00:00', '17:00:00', 1, 1, 0, 0, '2023-07-26'),
(45, '2023-08-01', '08:00:00', '17:00:00', 1, 8, 0, 0, '2023-07-30'),
(46, '2023-09-04', '08:00:00', '17:00:00', 1, 2, 0, 0, '2023-09-04'),
(47, '2023-09-11', '08:00:00', '17:00:00', 1, 2, -5, 0, '2023-09-04'),
(48, '2023-09-18', '08:00:00', '17:00:00', 1, 1, 0, 0, '2023-09-04'),
(49, '2023-09-22', '08:00:00', '17:00:00', 1, 2, 0, 0, '2023-09-04'),
(50, '2023-09-04', '08:00:00', '17:00:00', 1, 1, 0, 0, '2023-09-04'),
(51, '2023-09-13', '08:00:00', '17:00:00', 1, 2, 0, 0, '2023-09-05'),
(52, '2023-09-06', '08:00:00', '17:00:00', 1, 1, 0, 0, '2023-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `services_tbl`
--

CREATE TABLE `services_tbl` (
  `services_id` int(11) NOT NULL,
  `category_idfk` int(11) NOT NULL,
  `services_name` varchar(50) NOT NULL,
  `services_descrip` varchar(50) NOT NULL,
  `services_tconsume` int(11) NOT NULL,
  `services_price` double(11,2) NOT NULL,
  `services_isactive` int(11) NOT NULL DEFAULT 1,
  `services_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_tbl`
--

INSERT INTO `services_tbl` (`services_id`, `category_idfk`, `services_name`, `services_descrip`, `services_tconsume`, `services_price`, `services_isactive`, `services_dor`) VALUES
(1, 1, 'Check up', 'Check up', 45, 100.00, 1, '2023-06-15'),
(2, 2, 'upto 2kg', 'upto 2kg', 45, 150.00, 1, '2023-06-15'),
(3, 3, 'upto 2kg', 'upto 2kg', 45, 100.00, 1, '2023-06-15'),
(4, 5, 'upto 2kg', 'upto 2kg', 20, 2000.00, 1, '2023-06-15'),
(5, 6, 'upto 2kg', 'upto 2kg', 50, 1200.00, 1, '2023-06-15'),
(6, 7, '5kg below', '5kg below', 30, 6000.00, 1, '2023-06-15'),
(7, 4, '5in1', '5in1', 15, 450.00, 1, '2023-06-15'),
(8, 8, 'autohemo', 'autohemo', 30, 350.00, 1, '2023-06-15'),
(9, 9, 'upto 2kg', 'upto 2kg', 20, 3000.00, 1, '2023-06-15'),
(10, 10, '1eye', '1eye', 80, 2000.00, 1, '2023-06-15'),
(11, 11, 'upto 5kg', 'upto 5kg', 60, 4000.00, 1, '2023-06-15'),
(12, 12, 'upto 5kg', 'upto 5kg', 60, 2500.00, 1, '2023-06-15'),
(13, 13, 'anal sac drain', 'anal sac drain', 15, 250.00, 1, '2023-06-15'),
(14, 14, 'upto 5kg', 'upto 5kg', 50, 3000.00, 1, '2023-06-15'),
(15, 1, 'Vcheck', 'Vcheck', 60, 800.00, 1, '2023-06-15'),
(18, 18, 'Full body', 'for injured', 30, 350.00, 1, '2023-07-25'),
(19, 19, 'kamote23', 'sikret23', 20, 23.00, 1, '2023-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `staff_schedule_tbl`
--

CREATE TABLE `staff_schedule_tbl` (
  `staff_schedule_id` int(11) NOT NULL,
  `staff_idfk` int(11) NOT NULL,
  `appointment_idfk` int(11) NOT NULL,
  `schedule_date_idfk` int(11) NOT NULL,
  `staff_schedule_status` varchar(50) NOT NULL DEFAULT 'assign',
  `staff_schedule_isactive` int(11) NOT NULL DEFAULT 1,
  `staff_schedule_time` time NOT NULL,
  `staff_schedule_dura` varchar(25) NOT NULL,
  `staff_schedule_endtime` time NOT NULL,
  `staff_schedule_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_schedule_tbl`
--

INSERT INTO `staff_schedule_tbl` (`staff_schedule_id`, `staff_idfk`, `appointment_idfk`, `schedule_date_idfk`, `staff_schedule_status`, `staff_schedule_isactive`, `staff_schedule_time`, `staff_schedule_dura`, `staff_schedule_endtime`, `staff_schedule_dor`) VALUES
(132, 23, 179, 45, 'completed', 1, '08:15:00', '150', '10:45:00', '2023-07-30'),
(133, 23, 180, 45, 'completed', 1, '11:00:00', '80', '12:20:00', '2023-07-30'),
(134, 23, 181, 45, 'completed', 1, '08:15:00', '150', '10:45:00', '2023-07-30'),
(135, 20, 182, 47, 'cancel', 1, '08:00:00', '45', '08:45:00', '2023-09-04'),
(137, 20, 184, 47, 'cancel', 1, '09:00:00', '45', '09:45:00', '2023-09-04'),
(138, 20, 185, 47, 'assigned', 1, '10:00:00', '45', '10:45:00', '2023-09-04'),
(140, 20, 187, 47, 'assigned', 1, '11:00:00', '45', '11:45:00', '2023-09-04'),
(143, 20, 190, 47, 'completed', 1, '12:00:00', '45', '12:45:00', '2023-09-04'),
(145, 20, 192, 49, 'assigned', 1, '08:00:00', '45', '08:45:00', '2023-09-04'),
(146, 21, 193, 48, 'assigned', 1, '11:30:00', '45', '12:15:00', '2023-09-04'),
(147, 21, 194, 48, 'assign', 1, '08:00:00', '45', '08:45:00', '2023-09-04'),
(148, 20, 195, 46, 'assign', 1, '14:25:00', '90', '15:55:00', '2023-09-04'),
(150, 20, 197, 47, 'assigned', 1, '15:00:00', '45', '15:45:00', '2023-09-04'),
(151, 20, 198, 47, 'assigned', 1, '14:30:00', '45', '15:15:00', '2023-09-04'),
(152, 20, 199, 47, 'assigned', 1, '16:30:00', '45', '17:15:00', '2023-09-04'),
(153, 20, 200, 47, 'assigned', 1, '14:00:00', '45', '14:45:00', '2023-09-04'),
(154, 20, 203, 49, 'assigned', 1, '13:00:00', '45', '13:45:00', '2023-09-05'),
(155, 21, 227, 48, 'assign', 1, '14:45:00', '45', '15:30:00', '2023-09-05'),
(156, 26, 229, 51, 'assign', 1, '12:15:00', '45', '13:00:00', '2023-09-05'),
(157, 26, 230, 51, 'assign', 1, '08:00:00', '45', '08:45:00', '2023-09-05'),
(158, 26, 232, 51, 'assigned', 1, '15:15:00', '45', '16:00:00', '2023-09-05'),
(159, 21, 233, 48, 'assigned', 1, '09:00:00', '45', '09:45:00', '2023-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `staff_id` int(11) NOT NULL,
  `staff_fname` varchar(50) NOT NULL,
  `staff_lname` varchar(50) NOT NULL,
  `staff_branch` int(11) NOT NULL,
  `staff_email` varchar(50) NOT NULL,
  `staff_pass` varchar(70) NOT NULL,
  `staff_isactive` int(11) NOT NULL DEFAULT 1,
  `staff_type` int(11) NOT NULL DEFAULT 2,
  `staff_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`staff_id`, `staff_fname`, `staff_lname`, `staff_branch`, `staff_email`, `staff_pass`, `staff_isactive`, `staff_type`, `staff_dor`) VALUES
(2, 'admin', 'admin', 3, 'admin@gmail.com', 'pogiako', 1, 0, '2023-06-21'),
(20, 'David', 'Torres', 2, 'torresdavidjonathan.pdm@gmail.com', '123', 1, 1, '2023-07-24'),
(21, 'jerwin', 'Tugas', 1, 'jerwinlas@gmail.com', '12345', 1, 1, '2023-07-24'),
(23, 'Alex', 'Inciong', 8, 'shin73@gmail.com', '123', 1, 1, '2023-07-25'),
(25, 'staff11', 'staff11', 8, '', '', 1, 2, '2023-07-27'),
(26, 'Alex', 'inciong', 2, 'xnamecf04@gmail.com', '12345', 1, 1, '2023-09-05'),
(27, 'jerwin23', 'Tugas23', 1, '', '', 1, 2, '2023-09-06'),
(28, 'Ayen', 'Mallorca', 1, 'ayen@gmail.com', '123', 1, 1, '2023-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `time_sched_tbl`
--

CREATE TABLE `time_sched_tbl` (
  `time_sched_id` int(11) NOT NULL,
  `time_sched` time NOT NULL,
  `time_sched_stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_sched_tbl`
--

INSERT INTO `time_sched_tbl` (`time_sched_id`, `time_sched`, `time_sched_stat`) VALUES
(8, '09:15:00', 0),
(9, '09:30:00', 0),
(10, '09:45:00', 0),
(11, '10:00:00', 0),
(12, '10:15:00', 0),
(13, '10:30:00', 0),
(14, '10:45:00', 0),
(15, '11:00:00', 0),
(16, '11:15:00', 0),
(17, '11:30:00', 0),
(18, '11:45:00', 0),
(19, '12:00:00', 0),
(24, '13:15:00', 0),
(25, '13:30:00', 0),
(26, '13:45:00', 0),
(27, '14:00:00', 0),
(28, '14:15:00', 0),
(29, '14:30:00', 0),
(30, '14:45:00', 0),
(35, '16:00:00', 0),
(36, '16:15:00', 0),
(37, '16:30:00', 0),
(38, '16:45:00', 0),
(39, '17:00:00', 0),
(40, '08:00:00', 0),
(41, '08:15:00', 0),
(42, '08:30:00', 0),
(43, '08:45:00', 0),
(44, '09:15:00', 0),
(45, '09:30:00', 0),
(46, '09:45:00', 0),
(47, '10:00:00', 0),
(48, '10:15:00', 0),
(49, '10:30:00', 0),
(50, '10:45:00', 0),
(51, '11:00:00', 0),
(52, '11:15:00', 0),
(53, '11:30:00', 0),
(54, '11:45:00', 0),
(55, '12:00:00', 0),
(56, '12:15:00', 0),
(57, '12:30:00', 0),
(58, '12:45:00', 0),
(59, '13:00:00', 0),
(60, '13:15:00', 0),
(61, '13:30:00', 0),
(62, '13:45:00', 0),
(63, '14:00:00', 0),
(64, '14:15:00', 0),
(65, '14:30:00', 0),
(66, '14:45:00', 0),
(67, '15:00:00', 0),
(68, '15:15:00', 0),
(69, '15:30:00', 0),
(70, '15:45:00', 0),
(71, '16:00:00', 0),
(72, '16:15:00', 0),
(73, '16:30:00', 0),
(74, '16:45:00', 0),
(75, '17:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_balagtas`
--

CREATE TABLE `users_balagtas` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `password` varchar(70) NOT NULL,
  `user_branch` int(11) NOT NULL,
  `user_isactive` int(11) NOT NULL DEFAULT 1,
  `user_status` varchar(15) NOT NULL DEFAULT 'active',
  `user_dor` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_balagtas`
--

INSERT INTO `users_balagtas` (`id`, `user_id`, `email`, `user_name`, `last_name`, `password`, `user_branch`, `user_isactive`, `user_status`, `user_dor`) VALUES
(52, '6483668400', 'aceunitro55@gmail.com', 'Alex', 'Inciong', '12345', 0, 1, 'active', '2023-07-24'),
(53, '4544161114', 'kaidojer@gmail.com', 'Jerwin', 'Tugas', '5313900106', 0, 1, 'active', '2023-07-24'),
(54, '8966646961', 'guillermojerome.pdm@gmail.com', 'Jerwin', 'Tugas', '123', 0, 1, 'active', '2023-07-25'),
(60, '1909957804', 'mantra.kayon@feerock.com', 'Mazel', 'kenming', '48654d07074efab8d33c138781af58cd', 0, 1, 'active', '2023-09-04'),
(61, '6738230714', 'celso.harlyn@feerock.com', 'cheese', 'piattos', '48654d07074efab8d33c138781af58cd', 0, 1, 'active', '2023-09-04'),
(62, '7466575905', 'fintan.paton@feerock.com', 'tete', 'tata', '48654d07074efab8d33c138781af58cd', 0, 1, 'active', '2023-09-04'),
(63, '3472421015', 'xname@gmail.com', 'Alex', 'inciong', '6040779063', 0, 1, 'active', '2023-09-04'),
(64, '5164105561', 'jamiel.kaylor@feerock.com', 'Alex', 'inciong', '2039073218', 0, 1, 'active', '2023-09-04'),
(65, '5585363436', 'dezion.calum@feerock.com', 'Mazel', 'Junio', '48654d07074efab8d33c138781af58cd', 0, 1, 'active', '2023-09-04'),
(66, '3307697273', 'jamien.ram@feerock.com', 'Mazel', 'Inciong', '48654d07074efab8d33c138781af58cd', 0, 1, 'active', '2023-09-05'),
(67, '5038051085', 'jerwinlas@gmail.com', 'Bernaldo', 'Ayen', '2d26c50263d00bea93b03ff9d70ba23f', 0, 1, 'active', '2023-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `your_table_name`
--

CREATE TABLE `your_table_name` (
  `petnamedd` int(11) NOT NULL,
  `petname` varchar(45) NOT NULL,
  `services` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_bill_tbl`
--
ALTER TABLE `appointment_bill_tbl`
  ADD PRIMARY KEY (`appointment_bill_id`),
  ADD KEY `appointment_idfk` (`appointment_idfk`),
  ADD KEY `appon_bill_comment` (`appon_bill_comment`);

--
-- Indexes for table `appointment_completed_tbl`
--
ALTER TABLE `appointment_completed_tbl`
  ADD PRIMARY KEY (`appointment_completed_id`),
  ADD KEY `appointment_completed_idfk` (`appointment_completed_idfk`),
  ADD KEY `app_complete_comment` (`app_complete_comment`);

--
-- Indexes for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD PRIMARY KEY (`appointment_payment_id`),
  ADD KEY `pet_ownerid` (`pet_ownerid`),
  ADD KEY `appointment_date` (`appointment_date`),
  ADD KEY `appointment_branch` (`appointment_branch`),
  ADD KEY `appointment_payment_same` (`appointment_payment_same`),
  ADD KEY `appointment_payment_status` (`appointment_payment_status`),
  ADD KEY `appointment_coment` (`appointment_coment`),
  ADD KEY `pet_ownerid_2` (`pet_ownerid`);

--
-- Indexes for table `branch_tbl`
--
ALTER TABLE `branch_tbl`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `end_user_tbl`
--
ALTER TABLE `end_user_tbl`
  ADD PRIMARY KEY (`end_user_id`),
  ADD KEY `end_user_branch` (`end_user_branch`);

--
-- Indexes for table `item_category_tbl`
--
ALTER TABLE `item_category_tbl`
  ADD PRIMARY KEY (`item_category_id`);

--
-- Indexes for table `item_tbl`
--
ALTER TABLE `item_tbl`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `n_sub` (`n_sub`),
  ADD KEY `n_msg` (`n_msg`),
  ADD KEY `user_petnotifid` (`user_petnotifid`);

--
-- Indexes for table `ordernum_tbl`
--
ALTER TABLE `ordernum_tbl`
  ADD PRIMARY KEY (`ordernum_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_user_id` (`pet_user_id`);

--
-- Indexes for table `pet_services_his_tbl`
--
ALTER TABLE `pet_services_his_tbl`
  ADD PRIMARY KEY (`pet_services_his_id`),
  ADD KEY `pet_services_his_name` (`pet_services_his_name`),
  ADD KEY `user_petownerid` (`user_petownerid`),
  ADD KEY `pet_services_his_servidfk` (`pet_services_his_servidfk`),
  ADD KEY `pet_services_his_sameappoint` (`pet_services_his_sameappoint`);

--
-- Indexes for table `pet_services_tbl`
--
ALTER TABLE `pet_services_tbl`
  ADD PRIMARY KEY (`pet_services_id`),
  ADD KEY `pet_service_idowner` (`pet_service_idowner`),
  ADD KEY `pet_services_branchidfk` (`pet_services_branchidfk`),
  ADD KEY `pet_name_id` (`pet_name_id`),
  ADD KEY `pet_service_cat` (`pet_service_cat`);

--
-- Indexes for table `pos_ordered_tbl`
--
ALTER TABLE `pos_ordered_tbl`
  ADD PRIMARY KEY (`pos_ordered_id`);

--
-- Indexes for table `pos_order_list_tbl`
--
ALTER TABLE `pos_order_list_tbl`
  ADD PRIMARY KEY (`pos_order_list_id`);

--
-- Indexes for table `pos_purchase_his_tbl`
--
ALTER TABLE `pos_purchase_his_tbl`
  ADD PRIMARY KEY (`pos_purchase_his_id`);

--
-- Indexes for table `pos_purchase_tbl`
--
ALTER TABLE `pos_purchase_tbl`
  ADD PRIMARY KEY (`pos_purchase_id`);

--
-- Indexes for table `pos_trans_tbl`
--
ALTER TABLE `pos_trans_tbl`
  ADD PRIMARY KEY (`pos_trans_id`);

--
-- Indexes for table `sample_tbl`
--
ALTER TABLE `sample_tbl`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `schedule_tbl`
--
ALTER TABLE `schedule_tbl`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `services_tbl`
--
ALTER TABLE `services_tbl`
  ADD PRIMARY KEY (`services_id`),
  ADD KEY `category_idfk` (`category_idfk`);

--
-- Indexes for table `staff_schedule_tbl`
--
ALTER TABLE `staff_schedule_tbl`
  ADD PRIMARY KEY (`staff_schedule_id`),
  ADD KEY `staff_idfk` (`staff_idfk`),
  ADD KEY `appointment_idfk` (`appointment_idfk`),
  ADD KEY `schedule_date_idfk` (`schedule_date_idfk`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `staff_branch` (`staff_branch`);

--
-- Indexes for table `time_sched_tbl`
--
ALTER TABLE `time_sched_tbl`
  ADD PRIMARY KEY (`time_sched_id`);

--
-- Indexes for table `users_balagtas`
--
ALTER TABLE `users_balagtas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `your_table_name`
--
ALTER TABLE `your_table_name`
  ADD PRIMARY KEY (`petnamedd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_bill_tbl`
--
ALTER TABLE `appointment_bill_tbl`
  MODIFY `appointment_bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `appointment_completed_tbl`
--
ALTER TABLE `appointment_completed_tbl`
  MODIFY `appointment_completed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  MODIFY `appointment_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `branch_tbl`
--
ALTER TABLE `branch_tbl`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `end_user_tbl`
--
ALTER TABLE `end_user_tbl`
  MODIFY `end_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_category_tbl`
--
ALTER TABLE `item_category_tbl`
  MODIFY `item_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_tbl`
--
ALTER TABLE `item_tbl`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordernum_tbl`
--
ALTER TABLE `ordernum_tbl`
  MODIFY `ordernum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `pet_services_his_tbl`
--
ALTER TABLE `pet_services_his_tbl`
  MODIFY `pet_services_his_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=644;

--
-- AUTO_INCREMENT for table `pet_services_tbl`
--
ALTER TABLE `pet_services_tbl`
  MODIFY `pet_services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `pos_ordered_tbl`
--
ALTER TABLE `pos_ordered_tbl`
  MODIFY `pos_ordered_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pos_order_list_tbl`
--
ALTER TABLE `pos_order_list_tbl`
  MODIFY `pos_order_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT for table `pos_purchase_his_tbl`
--
ALTER TABLE `pos_purchase_his_tbl`
  MODIFY `pos_purchase_his_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `pos_purchase_tbl`
--
ALTER TABLE `pos_purchase_tbl`
  MODIFY `pos_purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `pos_trans_tbl`
--
ALTER TABLE `pos_trans_tbl`
  MODIFY `pos_trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sample_tbl`
--
ALTER TABLE `sample_tbl`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `schedule_tbl`
--
ALTER TABLE `schedule_tbl`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `services_tbl`
--
ALTER TABLE `services_tbl`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `staff_schedule_tbl`
--
ALTER TABLE `staff_schedule_tbl`
  MODIFY `staff_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `time_sched_tbl`
--
ALTER TABLE `time_sched_tbl`
  MODIFY `time_sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users_balagtas`
--
ALTER TABLE `users_balagtas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `your_table_name`
--
ALTER TABLE `your_table_name`
  MODIFY `petnamedd` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_bill_tbl`
--
ALTER TABLE `appointment_bill_tbl`
  ADD CONSTRAINT `appointment_bill_tbl_ibfk_1` FOREIGN KEY (`appointment_idfk`) REFERENCES `appointment_tbl` (`appointment_payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment_completed_tbl`
--
ALTER TABLE `appointment_completed_tbl`
  ADD CONSTRAINT `appointment_completed_tbl_ibfk_1` FOREIGN KEY (`appointment_completed_idfk`) REFERENCES `appointment_tbl` (`appointment_payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD CONSTRAINT `appointment_tbl_ibfk_1` FOREIGN KEY (`pet_ownerid`) REFERENCES `users_balagtas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_tbl_ibfk_2` FOREIGN KEY (`appointment_date`) REFERENCES `schedule_tbl` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_tbl_ibfk_3` FOREIGN KEY (`appointment_branch`) REFERENCES `branch_tbl` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_tbl_ibfk_4` FOREIGN KEY (`appointment_payment_same`) REFERENCES `pet_services_tbl` (`pet_service_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `end_user_tbl`
--
ALTER TABLE `end_user_tbl`
  ADD CONSTRAINT `end_user_tbl_ibfk_1` FOREIGN KEY (`end_user_branch`) REFERENCES `branch_tbl` (`branch_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `n_msg` FOREIGN KEY (`n_msg`) REFERENCES `appointment_tbl` (`appointment_coment`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `n_sub` FOREIGN KEY (`n_sub`) REFERENCES `appointment_tbl` (`appointment_payment_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_petnotifid` FOREIGN KEY (`user_petnotifid`) REFERENCES `appointment_tbl` (`pet_ownerid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`pet_user_id`) REFERENCES `users_balagtas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_services_his_tbl`
--
ALTER TABLE `pet_services_his_tbl`
  ADD CONSTRAINT `pet_services_his_tbl_ibfk_1` FOREIGN KEY (`pet_services_his_name`) REFERENCES `services_tbl` (`services_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_services_his_tbl_ibfk_2` FOREIGN KEY (`user_petownerid`) REFERENCES `users_balagtas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_services_his_tbl_ibfk_3` FOREIGN KEY (`pet_services_his_servidfk`) REFERENCES `pet_services_tbl` (`pet_services_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_services_his_tbl_ibfk_4` FOREIGN KEY (`pet_services_his_sameappoint`) REFERENCES `pet_services_tbl` (`pet_service_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_services_tbl`
--
ALTER TABLE `pet_services_tbl`
  ADD CONSTRAINT `pet_services_tbl_ibfk_1` FOREIGN KEY (`pet_service_idowner`) REFERENCES `users_balagtas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_services_tbl_ibfk_2` FOREIGN KEY (`pet_services_branchidfk`) REFERENCES `branch_tbl` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_services_tbl_ibfk_3` FOREIGN KEY (`pet_name_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services_tbl`
--
ALTER TABLE `services_tbl`
  ADD CONSTRAINT `services_tbl_ibfk_1` FOREIGN KEY (`category_idfk`) REFERENCES `category_tbl` (`category_id`);

--
-- Constraints for table `staff_schedule_tbl`
--
ALTER TABLE `staff_schedule_tbl`
  ADD CONSTRAINT `staff_schedule_tbl_ibfk_1` FOREIGN KEY (`staff_idfk`) REFERENCES `staff_tbl` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_schedule_tbl_ibfk_2` FOREIGN KEY (`appointment_idfk`) REFERENCES `appointment_tbl` (`appointment_payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_schedule_tbl_ibfk_3` FOREIGN KEY (`schedule_date_idfk`) REFERENCES `schedule_tbl` (`schedule_id`);

--
-- Constraints for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD CONSTRAINT `staff_tbl_ibfk_1` FOREIGN KEY (`staff_branch`) REFERENCES `branch_tbl` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
