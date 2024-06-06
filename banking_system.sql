-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 12:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` decimal(10,2) DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `balance`, `created_at`) VALUES
(1, 9, 988.00, '2024-06-06 00:11:43'),
(2, 10, 400.00, '2024-06-06 00:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_type` int(11) DEFAULT NULL COMMENT '1.Credit 2.Debit',
  `amount` double DEFAULT NULL,
  `cheque_number` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1.Pending 2.Approve 3.Cancel\r\n',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `account_id`, `transaction_type`, `amount`, `cheque_number`, `status`, `created_at`) VALUES
(1, 9, 1, 111, '123', 2, '2024-06-04 19:24:26'),
(2, 9, 2, 450, '30037474938', 3, '2024-06-05 19:26:17'),
(3, 10, 2, 100, '1007839547', 2, '2024-06-06 07:53:59'),
(4, 9, 2, 123, '78782462425', 2, '2024-06-06 07:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `account_type` tinyint(4) DEFAULT NULL,
  `aadhar` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1.Approved 2.Pending 3.Rejected\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_no`, `username`, `password`, `role`, `name`, `email`, `mobile`, `account_type`, `aadhar`, `token`, `status`) VALUES
(2, NULL, 'admin', '$2y$10$sniOQQL0QeA4NLq.Eg2ozuWCWHaWka9YU0Ek7Ll9/FK0i5Fo2YR2C', 'admin', 'Admin', 'admin@admin.com', 8009798890, NULL, NULL, '7bd00be38b34f223feebc4a931bdb2e356b3f2ad84dc7b2ec42e01d4572f9adf', 1),
(9, '278317212822', 'bikash@gmail.com', '$2y$10$sniOQQL0QeA4NLq.Eg2ozuWCWHaWka9YU0Ek7Ll9/FK0i5Fo2YR2C', 'customer', 'Bikash Das', 'bikashdasok@gmail.com', 7008275352, 1, 2147483647, 'ffea975428f3d3990a6d95e299c94fd124ccab8df1bd8751618377dfa679cf70', 1),
(10, '312627880604', 'deba@gmail.com', '$2y$10$sniOQQL0QeA4NLq.Eg2ozuWCWHaWka9YU0Ek7Ll9/FK0i5Fo2YR2C', 'customer', 'Deba Das', 'deba@gmail.com', 7008275351, 1, 2147480647, '2a9ffc10344e085a4d09a366674543312788e18dd8c27af752f375953ae4f3a2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
