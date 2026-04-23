-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2026 at 05:18 AM
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
-- Database: `rentride`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `vehicle_id`, `pickup_date`, `return_date`, `location`, `days`, `total_price`, `created_at`, `status`, `user_id`) VALUES
(3, 20, '2026-04-22', '2026-04-24', 'Durg', 2, 1198, '2026-04-20 10:46:48', 'Pending', 12),
(4, 27, '2026-04-22', '2026-04-23', 'bhilai', 1, 1299, '2026-04-20 10:48:53', 'Pending', 12),
(5, 34, '2026-04-22', '2026-04-27', 'raipur', 5, 2995, '2026-04-20 10:55:07', 'Pending', 12),
(6, 10, '2026-04-20', '2026-04-22', 'RamNagar', 2, 1798, '2026-04-20 11:30:05', 'Pending', 12),
(7, 30, '2026-04-23', '2026-04-25', 'raipur', 2, 1398, '2026-04-21 06:08:04', 'Pending', 12),
(8, 10, '2026-04-21', '2026-04-23', 'Raipur', 2, 1798, '2026-04-21 07:42:15', 'Pending', 12),
(9, 14, '2026-04-21', '2026-04-22', 'raipur', 1, 999, '2026-04-21 08:20:37', 'Pending', 12),
(10, 10, '2026-04-21', '2026-04-23', 'raipur', 2, 1798, '2026-04-21 08:27:46', 'Pending', 12),
(11, 14, '2026-04-24', '2026-04-26', 'durg', 2, 1998, '2026-04-21 08:55:24', 'Cancelled', 12),
(12, 27, '2026-04-21', '2026-04-23', 'Lakhenagar Raipur', 2, 2598, '2026-04-21 10:27:47', 'Confirmed', 14),
(13, 10, '2026-04-21', '2026-04-23', 'raipur ', 2, 1798, '2026-04-21 11:37:40', 'Confirmed', 14),
(14, 10, '2026-04-14', '2026-04-22', 'Raipur', 8, 7192, '2026-04-21 11:55:00', 'Confirmed', 16),
(15, 32, '2026-04-21', '2026-04-23', 'Raipur', 2, 1198, '2026-04-21 11:58:56', 'Confirmed', 16),
(16, 26, '2026-04-21', '2026-04-24', 'Raipur', 3, 2397, '2026-04-22 12:05:22', 'Confirmed', 12),
(17, 10, '2026-04-20', '2026-04-24', 'raipur', 4, 3596, '2026-04-22 12:16:13', 'Pending', 12);

-- --------------------------------------------------------

--
-- Table structure for table `brand_master`
--

CREATE TABLE `brand_master` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_master`
--

INSERT INTO `brand_master` (`id`, `brand`) VALUES
(3, 'Yamha'),
(4, 'Bajaj'),
(5, 'Royal Enfield '),
(6, 'Harly Devidson'),
(7, 'Jawa'),
(8, 'Hero Honda'),
(9, 'TVS'),
(10, 'Honda ');

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE `city_master` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`id`, `city`) VALUES
(1, 'Raipur'),
(2, 'bhilai'),
(6, 'Durg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `password`) VALUES
(12, 'Deekesh kumar', '8878545059', 'deekesh07@gmail.com', '1234'),
(13, 'Deekesh kumar', '8878545059', 'deekesh07@gmail.com', '1234'),
(14, 'Pushpendra ', '94755811256', 'pushpendra07@gmail.com', '1234'),
(15, 'Pushpendra', '9109085923', 'pushpendra@gmail.com', '1234'),
(16, 'Nipesh', '9770131555', 'nipeshp@gmail.com', 'Raipur'),
(17, 'Nipesh', '9770131555', 'nipeshp@gmail.com', 'Raipur');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `engine` varchar(100) DEFAULT NULL,
  `mileage` varchar(50) DEFAULT NULL,
  `fuel` varchar(50) DEFAULT NULL,
  `price` float NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `city`, `name`, `brand`, `engine`, `mileage`, `fuel`, `price`, `image`) VALUES
(10, '1', 'R15', '3', '150cc', '40', 'Petrol', 899, 'r15mmm'),
(14, '1', ' GT 650', '5', '650cc', '35', 'Petrol', 999, 'gt650'),
(20, '1', 'Splender plus', '8', '100cc', '60', 'Petrol', 599, 'splender plus'),
(26, '1', 'Avenger', '4', '150cc', '45', 'Petrol', 799, 'avenger.jpg'),
(27, '1', 'Harly Devidson', '6', '450cc', '35', 'Petrol', 1299, 'harly Davidson.avif'),
(28, '1', 'Jawa 350', '7', '350cc', '30', 'Petrol', 999, 'jawa.avif'),
(29, '1', 'Pulsar NS 200', '4', '200cc', '45', '', 799, 'ns200.jpg'),
(30, '1', 'Raider 125', '9', '125cc', '65', 'Petrol', 699, 'raider.jpg'),
(31, '1', 'Royal Enfield 350', '5', '350cc', '35', 'Petrol', 899, 'royal Enfield.avif'),
(32, '1', 'TVS Jupiter', '9', '125cc', '45', 'Petrol', 599, 'tvs-jupiter.avif'),
(33, '1', 'Royal enfield 350', '3', '350cc', '35', 'Petrol', 899, 'royal Enfield.avif'),
(34, '6', 'Activa 6G', '10', '125cc', '60', 'Petrol', 599, 'activa-6g-right-side-view-2.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_master`
--
ALTER TABLE `brand_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_master`
--
ALTER TABLE `city_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `brand_master`
--
ALTER TABLE `brand_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `city_master`
--
ALTER TABLE `city_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
