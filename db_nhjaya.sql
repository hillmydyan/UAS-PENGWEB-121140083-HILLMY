-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 12:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nhjaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang1`
--

CREATE TABLE `tb_barang1` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kode_huruf` varchar(50) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang1`
--

INSERT INTO `tb_barang1` (`id`, `nama_barang`, `kode_huruf`, `created_by`, `created_at`) VALUES
(4, 'Barang 4', 'A004', 1, '2024-12-23 03:03:00'),
(5, 'Barang 5', 'A005', 1, '2024-12-23 03:04:00'),
(7, 'Barang 7', 'A007', 1, '2024-12-23 03:06:00'),
(8, 'Barang 8', 'A008', 1, '2024-12-23 03:07:00'),
(9, 'Barang 9', 'A009', 1, '2024-12-23 03:08:00'),
(10, 'Barang 10', 'A010', 1, '2024-12-23 03:09:00'),
(12, 'pisau rangka ', 'IOA', 12, '2024-12-22 18:48:09'),
(13, 'kipas angin miyako berdiri', 'IAA', 12, '2024-12-22 18:48:40'),
(14, 'SG HAllO 22', 'COAs', 12, '2024-12-22 18:49:15'),
(15, 'SAS', 'ASCASC', 12, '2024-12-22 19:01:23'),
(36, 'sfaf', '12dad', 4, '2024-12-22 19:59:48'),
(37, 'sadada', 'asdasd', 4, '2024-12-23 02:46:48'),
(38, 'adA', 'Da', 4, '2024-12-23 02:49:48'),
(39, 'asasa', 'sdasd', 4, '2024-12-23 02:54:01'),
(41, 'miyako', 'CTRL', 4, '2024-12-23 04:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `phone`) VALUES
(1, 'admin', '$2y$10$examplehashedpassword', 'admin', '2024-12-22 15:13:22', NULL),
(2, 'user1', '$2y$10$', 'user', '2024-12-22 15:13:22', NULL),
(4, 'nando', '$2y$10$R7FWg/BG7j9S21WpEwSLm.YXEYYEIExm.fUnmy5Bh6vFuXSTTC9YC', 'admin', '2024-12-22 15:20:11', NULL),
(5, 'nandi', '$2y$10$6CA28F3sC9xMXUb1mm3TiemnJSDB6pu82g/ZWsr3MG7pSBtQcL5a2', 'user', '2024-12-22 15:47:44', NULL),
(6, 'hillmy', '$2y$10$l8XaKqH6OTLS2LHJSvI4GuQGYBigGGnr58KZUwSbIsr6GRyHtRrk6', 'admin', '2024-12-22 16:22:19', NULL),
(8, 'nandio', '$2y$10$IdseoTLQrj2kYmYIW09jbuEo6vNbtKtsi5M3b5cRVS0beWeAj0FKu', 'admin', '2024-12-22 17:55:15', '08211hsd'),
(10, 'nandi2', '$2y$10$tf46usE1K2705I3eAkyU..6vx9LJg6adkavq1ZUdIVzLozvwlqGse', 'user', '2024-12-22 18:10:14', '2143'),
(12, 'hillmy2', '$2y$10$QnHrxURbVwA5jDMWTpQIpeWyJSQklBBfiV21kggzE1EkM22LKCACS', 'admin', '2024-12-22 18:45:27', '085738474050'),
(13, 'nandoq', '$2y$10$Bk8gdlLWZ/mRooZyWleFoey.xFILY1HVIDX74I.5lWNhWmLd/YNRm', 'admin', '2024-12-23 07:18:55', '2039423753'),
(14, 'nandoc', '$2y$10$OKvrf2lLrdw/8qLgTsVY3Ou6IuRBN.Hd6oNTXMrz5ssFGI2EDpSGS', 'admin', '2024-12-23 07:28:49', '325235352'),
(15, 'dani', '$2y$10$eRswgPGODfg6HglVw4wdyuTkhi3LuOc2pPWCYUBPdu8Q1EumXAIIO', 'admin', '2024-12-23 07:31:12', '243567876532431');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang1`
--
ALTER TABLE `tb_barang1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

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
-- AUTO_INCREMENT for table `tb_barang1`
--
ALTER TABLE `tb_barang1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang1`
--
ALTER TABLE `tb_barang1`
  ADD CONSTRAINT `tb_barang1_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
