-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 11:48 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `usage_mbs` varchar(200) DEFAULT NULL,
  `due_amount` varchar(30) DEFAULT NULL,
  `late_amount` int(30) DEFAULT NULL,
  `due_date` varchar(30) DEFAULT NULL,
  `wh_tax` varchar(30) DEFAULT NULL,
  `service_tax` varchar(30) DEFAULT NULL,
  `arrears` varchar(30) DEFAULT NULL,
  `month` varchar(30) DEFAULT NULL,
  `credits` varchar(100) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `user_id`, `usage_mbs`, `due_amount`, `late_amount`, `due_date`, `wh_tax`, `service_tax`, `arrears`, `month`, `credits`, `image`, `status`, `created_at`, `updated_at`) VALUES
(7, 7, '6 mb', '1000', 1500, '2022-07-07', '10', '10', '10', 'August', '0', 'bill1656424804A PIC.jpg', 0, '2022/06/28 07:00:04 PM', '2022/06/28 07:00:04 PM');

-- --------------------------------------------------------

--
-- Table structure for table `compliants`
--

CREATE TABLE `compliants` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `reply` varchar(1000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compliants`
--

INSERT INTO `compliants` (`id`, `user_id`, `message`, `reply`, `status`, `created_at`, `updated_at`) VALUES
(5, 8, 'hi there', 'issue solved', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recovery`
--

CREATE TABLE `recovery` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `token` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recovery`
--

INSERT INTO `recovery` (`id`, `user_id`, `email`, `token`) VALUES
(4, 2, 'abdul@gmail.com', 'af096e4710b33c952e2549b2e6ae39fb'),
(5, 4, 'rimsha@gmail.com', 'e6cda347580750061184e3c5568bdd4f');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `speed` varchar(200) DEFAULT NULL,
  `price` varchar(30) DEFAULT NULL,
  `account_id` varchar(30) DEFAULT NULL,
  `issuance_date` varchar(30) DEFAULT NULL,
  `ptcl_number` varchar(30) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `speed`, `price`, `account_id`, `issuance_date`, `ptcl_number`, `status`, `created_at`, `updated_at`) VALUES
(7, 7, '6 mb', '500', '1000550052059', '', '', 0, '2022/06/28 07:00:32 PM', '2022/06/28 07:00:52 PM'),
(8, 8, '6 mb', NULL, NULL, NULL, NULL, 0, '2022/10/24 04:55:41 PM', '2022/10/24 04:55:41 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `cnic` varchar(30) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `about` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `cnic`, `address`, `about`, `status`, `role`, `created_at`, `updated_at`) VALUES
(7, 'abdul', 'Hannan', 'abdul', 'abdul@gmail.com', 'aa5f9f65b56c061344c609e01f3f021e', '+1 (302) 394-6938', '6565', '2055 Limestone Rd STE 200-C,<br> Wilmington, DE 19808', 'j', 1, 1, '2022/06/28 06:57:53 PM', '2022/06/28 06:57:53 PM'),
(8, 'Abdul', 'rafay', 'rafay', 'rafay@gmail.com', 'aa5f9f65b56c061344c609e01f3f021e', '03204322564', '123', 'nknjkn', 'Abdul', 1, 0, '2022/10/24 04:54:38 PM', '2022/10/24 04:54:38 PM');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `name`, `connection_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Connection establishment', 7, 'voucher1656424893A PIC.jpg', 0, '2022/06/28 07:01:09 PM', '2022/06/28 07:01:33 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliants`
--
ALTER TABLE `compliants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recovery`
--
ALTER TABLE `recovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `compliants`
--
ALTER TABLE `compliants`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recovery`
--
ALTER TABLE `recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
