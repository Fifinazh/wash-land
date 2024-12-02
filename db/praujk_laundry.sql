-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 10:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praujk_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `phone`, `address`, `created_at`, `update_at`) VALUES
(8, 'cleo', '0812346597', 'jakarta', '2024-12-02 04:09:16', '2024-12-02 04:10:11'),
(9, 'montiss', '012345', 'jakarta', '2024-12-02 08:33:46', '2024-12-02 08:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama_level`, `created_at`, `update_at`) VALUES
(1, 'administrator', '2024-11-13 06:20:24', '2024-11-13 06:20:24'),
(2, 'operator', '2024-11-13 06:20:24', '2024-11-13 06:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `trans_laundry_pickup`
--

CREATE TABLE `trans_laundry_pickup` (
  `id` int(11) NOT NULL,
  `id_order` int(30) NOT NULL,
  `id_customer` int(30) NOT NULL,
  `pickup_date` date NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_laundry_pickup`
--

INSERT INTO `trans_laundry_pickup` (`id`, `id_order`, `id_customer`, `pickup_date`, `note`, `created_at`, `updated_at`) VALUES
(8, 35, 4, '2024-11-21', '', '2024-11-21 06:44:41', '2024-11-21 06:44:41'),
(10, 38, 1, '2024-12-01', '', '2024-12-01 07:44:17', '2024-12-01 07:44:17'),
(11, 37, 5, '2024-12-01', '', '2024-12-01 07:44:30', '2024-12-01 07:44:30'),
(13, 41, 6, '2024-12-01', '', '2024-12-01 09:28:07', '2024-12-01 09:28:07'),
(14, 40, 2, '2024-12-01', '', '2024-12-01 10:53:55', '2024-12-01 10:53:55'),
(16, 43, 6, '2024-12-01', '', '2024-12-01 11:00:01', '2024-12-01 11:00:01'),
(17, 46, 6, '2024-12-01', '', '2024-12-01 12:13:46', '2024-12-01 12:13:46'),
(18, 47, 2, '2024-12-01', '', '2024-12-01 12:22:46', '2024-12-01 12:22:46'),
(19, 50, 4, '2024-12-01', '', '2024-12-01 12:30:55', '2024-12-01 12:30:55'),
(20, 51, 6, '2024-12-01', '', '2024-12-01 12:45:20', '2024-12-01 12:45:20'),
(21, 52, 1, '2024-12-01', '', '2024-12-01 12:51:48', '2024-12-01 12:51:48'),
(22, 53, 1, '2024-12-01', '', '2024-12-01 12:53:50', '2024-12-01 12:53:50'),
(23, 57, 2, '2024-12-02', '', '2024-12-02 05:37:46', '2024-12-02 05:37:46'),
(24, 56, 1, '2024-12-02', '', '2024-12-02 06:03:59', '2024-12-02 06:03:59'),
(25, 56, 1, '2024-12-02', '', '2024-12-02 06:04:51', '2024-12-02 06:04:51'),
(26, 59, 2, '2024-12-02', '', '2024-12-02 06:07:33', '2024-12-02 06:07:33'),
(27, 60, 2, '2024-12-02', '', '2024-12-02 06:36:12', '2024-12-02 06:36:12'),
(28, 61, 6, '2024-12-02', '', '2024-12-02 06:39:42', '2024-12-02 06:39:42'),
(29, 43, 8, '2024-12-02', '', '2024-12-02 08:15:48', '2024-12-02 08:15:48'),
(30, 46, 9, '2024-12-02', '', '2024-12-02 08:38:38', '2024-12-02 08:38:38'),
(31, 45, 8, '2024-12-02', '', '2024-12-02 08:38:59', '2024-12-02 08:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `trans_order`
--

CREATE TABLE `trans_order` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `order_end_date` date DEFAULT NULL,
  `order_status` tinyint(11) NOT NULL DEFAULT 0,
  `total_price` int(11) NOT NULL,
  `order_pay` int(11) DEFAULT NULL,
  `order_change` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order`
--

INSERT INTO `trans_order` (`id`, `id_customer`, `order_code`, `order_date`, `order_end_date`, `order_status`, `total_price`, `order_pay`, `order_change`, `created_at`, `updated_at`, `deleted_at`) VALUES
(45, 8, 'INV/021224-0001', '2024-12-02', '2024-12-03', 1, 0, 10000, 500, '2024-12-02 08:21:46', '2024-12-02 08:38:59', 0),
(48, 9, 'INV/021224-00048', '2024-12-03', '2024-12-08', 0, 0, 0, 0, '2024-12-02 08:59:00', '2024-12-02 08:59:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trans_order_detail`
--

CREATE TABLE `trans_order_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order_detail`
--

INSERT INTO `trans_order_detail` (`id`, `id_order`, `id_service`, `qty`, `subtotal`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(51, 45, 4, 1, 4500, NULL, '2024-12-02 08:21:46', '2024-12-02 08:21:46', 0),
(52, 45, 5, 1, 5000, NULL, '2024-12-02 08:21:46', '2024-12-02 08:21:46', 0),
(53, 46, 4, 3, 13500, NULL, '2024-12-02 08:33:57', '2024-12-02 08:33:57', 0),
(54, 47, 6, 1, 7000, NULL, '2024-12-02 08:50:40', '2024-12-02 08:50:40', 0),
(55, 48, 4, 5, 22500, NULL, '2024-12-02 08:59:00', '2024-12-02 08:59:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_of_service`
--

CREATE TABLE `type_of_service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(155) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_of_service`
--

INSERT INTO `type_of_service` (`id`, `service_name`, `price`, `description`, `created_at`, `update_at`) VALUES
(4, 'Hanya Cuci', 4500.00, '<p>nyuci aja gosok sendiri</p>', '2024-11-14 08:30:53', '2024-11-14 08:30:53'),
(5, 'Hanya Gosok', 5000.00, '<p>males nyuci gosok disini ajahh</p>', '2024-11-14 08:32:36', '2024-11-14 08:32:36'),
(6, 'laundry item besar', 7000.00, '<p>Seperti selimut, karpet,&nbsp;<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">mantel dan sprei my love</span></p>', '2024-11-15 01:23:46', '2024-11-15 04:34:41'),
(7, 'Cuci dan Gosok', 5000.00, 'Baju rapih dan wangi', '2024-12-02 04:18:11', '2024-12-02 04:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `nama`, `email`, `username`, `password`, `foto`, `created_at`, `update_at`) VALUES
(2, 1, 'fifi', 'fifi@gmail.com', 'fifiaja', '123', '', '2024-11-13 06:44:49', '2024-11-14 05:04:42'),
(5, 2, 'pipi', 'pipi@gmail.com', 'pipiaja', '123', '', '2024-11-14 05:04:13', '2024-11-14 05:04:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `trans_order`
--
ALTER TABLE `trans_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_service`
--
ALTER TABLE `type_of_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `trans_order`
--
ALTER TABLE `trans_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `type_of_service`
--
ALTER TABLE `type_of_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
