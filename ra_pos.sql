-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 03:13 PM
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
-- Database: `ra_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `category`, `name`, `price`, `image`, `created_at`) VALUES
(1, 'Fruits ', 'Banana', 50.00, 'uploads/banana.jpg', '2024-11-26 12:31:39'),
(2, 'Vegetables', 'Cabbage', 150.00, 'uploads/cabbage.jpg', '2024-11-26 12:33:34'),
(3, 'Vegetables', 'Eggplant', 80.00, 'uploads/eggplant.jpg', '2024-11-26 12:33:57'),
(4, 'Fruits ', 'Orange', 25.00, 'uploads/orange.jpg', '2024-11-26 12:34:21'),
(5, 'Fruits ', 'Pineapple', 90.00, 'uploads/pineapple.jpg', '2024-11-26 15:49:40'),
(6, 'Fruits ', 'Apple', 30.00, 'uploads/apple.jpg', '2024-11-26 17:07:43'),
(8, 'Fruits ', 'Dragon Fruit', 200.00, 'uploads/dragonfruit.jpg', '2024-11-26 17:08:42'),
(9, 'Fruits ', 'Jackfruit', 175.00, 'uploads/jackfruit.jpg', '2024-11-26 17:10:11'),
(10, 'Fruits ', 'Mangosteen', 350.00, 'uploads/mangosteen.jpg', '2024-11-26 17:10:49'),
(11, 'Fruits ', 'Durian', 85.00, 'uploads/durian.jpg', '2024-11-26 17:11:19'),
(12, 'Fruits ', 'Lemon', 150.00, 'uploads/rambutan.jpg', '2024-11-26 17:11:52'),
(13, 'Fruits ', 'Peras', 20.00, 'uploads/peras.jpg', '2024-11-26 17:12:21'),
(14, 'Fruits ', 'Papaya', 80.00, 'uploads/papaya.jpg', '2024-11-26 17:12:46'),
(15, 'Fruits ', 'Persimon', 150.00, 'uploads/persimon.jpg', '2024-11-26 17:13:10'),
(16, 'Fruits ', 'Kamote', 70.00, 'uploads/kamote.jpg', '2024-11-26 17:13:38'),
(18, 'Fruits', 'Melon', 90.00, 'uploads/melon.jpg', '2024-11-27 09:18:55'),
(19, 'Fruits', 'Mango', 150.00, 'uploads/mango.jpg', '2024-11-27 09:19:22'),
(20, 'Vegetables', 'Pechay', 90.00, 'uploads/Pechay-Tagalog-bg.jpg', '2024-11-27 09:20:39'),
(21, 'Vegetables', 'Chayote', 75.00, 'uploads/sayote.jpg', '2024-11-27 09:22:00'),
(22, 'Vegetables', 'Potato', 75.00, 'uploads/potato.jpg', '2024-11-27 09:22:30'),
(23, 'Vegetables', 'Ampalaya', 85.00, 'uploads/ampalaya.jpg', '2024-11-27 09:22:52'),
(24, 'Vegetables', 'Onion', 180.00, 'uploads/sibuyas.jpg', '2024-11-27 09:24:37'),
(25, 'Vegetables', 'Garlic', 190.00, 'uploads/Bawang.jpg', '2024-11-27 09:26:17'),
(26, 'Vegetables', 'calamondin', 70.00, 'uploads/calamansi.jpg', '2024-11-27 09:26:59'),
(27, 'Vegetables', 'String Bean', 90.00, 'uploads/sitaw.jpg', '2024-11-27 09:27:42'),
(28, 'Vegetables', 'Tomato', 60.00, 'uploads/kamatis.jpg', '2024-11-27 09:28:15'),
(29, 'Vegetables', 'Beans', 100.00, 'uploads/beans.jpg', '2024-11-27 09:29:31'),
(30, 'Vegetables', 'Cauliflower', 200.00, 'uploads/cauliflower.jpg', '2024-11-27 09:30:03'),
(31, 'Vegetables', 'Brocolli', 250.00, 'uploads/brocolli.jpg', '2024-11-27 09:30:26'),
(32, 'Vegetables', 'Wild Chili', 160.00, 'uploads/sili.jpg', '2024-11-27 09:31:37'),
(33, 'Vegetables', 'Bell pepper', 100.00, 'uploads/bell pepper.jpg', '2024-11-27 09:32:07'),
(34, 'Vegetables', 'Ginger', 95.00, 'uploads/luya.jpg', '2024-11-27 09:32:31'),
(35, 'Vegetables', 'Carrots', 90.00, 'uploads/carrots.jpg', '2024-11-27 09:33:01'),
(36, 'Vegetables', 'Cucumber', 60.00, 'uploads/pipino.jpg', '2024-11-27 09:33:31'),
(37, 'Vegetables', 'Lettuce', 95.00, 'uploads/lettuce.jpg', '2024-11-27 09:35:05'),
(38, 'Vegetables', 'Calabaza', 60.00, 'uploads/kalabasa.jpg', '2024-11-27 09:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
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
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
