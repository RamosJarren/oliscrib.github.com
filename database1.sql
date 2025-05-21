-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 02:38 AM
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
-- Database: `database1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `id` int(10) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `part` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id`, `brand`, `model`, `part`, `type`, `price`, `stock`, `image`) VALUES
(1, 'Shimano', 'Dura Ace Di Groupset TT', 'Groupset', 'best', 160000, 6, 'bike_682cfe84386cd_ramosA.jpg'),
(2, 'Shimano', 'Dura Ace Di Groupset Disc Road', 'Groupset', 'best', 133000, 4, ''),
(3, 'Shimano', 'Dura Ace Power Meter Crank', 'Pedal', 'ess', 65000, 7, ''),
(4, 'Shimano', 'GRX 610 2X12 Groupset', 'Groupset', 'best', 37000, 9, ''),
(5, 'Shimano', 'GRX 610 1X12 Groupset', 'Groupset', 'best', 35000, 4, ''),
(6, 'Shimano', 'GRX 600 2X12 STI with Calipers', 'Handlebar', 'ess', 20000, 8, ''),
(7, 'Shimano', 'Saint M820 Quad piston brakeset', 'Handlebar', 'ess', 16000, 7, ''),
(8, 'Shimano', 'XTR M9120 Quad piston brakeset', 'Handlebar', 'ess', 23000, 9, ''),
(9, 'Shimano', 'XTR 1x Crankset', 'Pedal', 'ess', 16500, 7, ''),
(10, 'Shimano', 'XTR 2x Crankset with FD', 'Pedal', 'ess', 12500, 10, ''),
(11, 'Elilee', 'x310 Crankset', 'Pedal', 'ess', 23850, 11, ''),
(12, 'Magene', 'Power Meter Crankset', 'Pedal', 'ess', 13700, 12, ''),
(13, 'Favero', 'Assioma Pro MX1', 'Pedal', 'ess', 27000, 13, ''),
(14, 'Favero', 'Assioma Pro MX2', 'Pedal', 'best', 43000, 14, ''),
(15, 'Continental', 'GP5000S TR Tires 28C ', 'Tire', 'best', 8200, 15, ''),
(16, 'Continental', 'GP5000S TR Tires 30C ', 'Tire', 'new', 8200, 16, ''),
(17, 'Farsports', 'Evo S6 Wheelset 60mm', 'Tire', 'new', 87500, 5, ''),
(18, 'Dare', 'VSRu Frameset Aero', 'Frame', 'new', 63000, 18, ''),
(19, 'Cervelo', 'R-series Disc Frameset with Ceramicspeed', 'Frame', 'new', 100000, 20, ''),
(20, 'Elves Avari', 'Frameset Rim Medium with Cockpit', 'Frame', 'new', 28000, 20, ''),
(21, 'Manitou', 'Manitou Markhor 29er', 'Frame', 'new', 8800, 22, ''),
(22, 'SR Suntour', 'Suntour Epixon 29er', 'Frame', 'new', 7300, 22, ''),
(23, 'Shokz', 'Open Fit Black', 'Accessories', 'acc', 10900, 23, ''),
(24, 'Shokz', 'Open Fit Beige', 'Accessories', 'acc', 10900, 24, '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `fullname`, `items`, `price`, `reference`, `proof`, `time`, `status`) VALUES
(1, 'Administrator', '1,2', 293300, '', '', '2025-05-04 17:03:08', ''),
(2, 'Administrator', '19,22,8,7', 146600, '', '', '2025-05-04 17:16:18', ''),
(70, 'Administrator', '19,22,8,7', 146600, 'aaaa', 'uploads/682371ba57a5f-ramosA.jpg', '2025-05-13 18:22:11', 'paid'),
(71, 'Administrator', '19,22,8,7', 146600, 'a', 'uploads/682421ae3e917-ramosA.jpg', '2025-05-14 06:52:21', 'paid'),
(74, 'Administrator', '19,22,8,7', 146600, 'aaaa', 'uploads/682581f7ca27f-ramosA.jpg', '2025-05-15 07:54:52', 'paid'),
(76, 'Administrator', '19,22,8,7', 146600, 'aaa', 'uploads/682a2087ed53d-ramosA.jpg', '2025-05-18 20:00:33', 'paid'),
(88, 'Administrator', '19,22,7,5', 158600, 'asd', 'C:\\xampp\\htdocs\\OLIsCRIB\\modules/uploads/682c9d568db85-ramosA.jpg', '2025-05-20 17:18:38', 'paid'),
(105, 'aaa', '1', 160000, 'aaa', 'uploads/proof_682cb13b0f074.jpg', '2025-05-20 18:43:39', 'delivery'),
(106, 'aaa', '3', 65000, 'aaa', 'uploads/proof_682cb2ebcbf89.jpg', '2025-05-20 18:50:51', 'delivery'),
(107, 'aaa', '5', 140000, 'aaa', 'uploads/proof_682cb38f7d1a4.jpg', '2025-05-20 18:53:35', 'delivery'),
(108, 'z', '1', 960000, 'z', 'uploads/del_682cb921e10a3.jpg', '2025-05-20 19:17:21', 'delivery'),
(109, 'z', '4', 333000, 'z', 'uploads/del_682d089019fee.jpg', '2025-05-21 00:56:16', 'delivery'),
(110, 'Administrator', '19,22,7,5', 158600, 'aaaa', 'C:\\xampp\\htdocs\\OLIsCRIB\\modules/uploads/cus_682d08fba9e81-ramosA.jpg', '2025-05-21 00:57:56', 'paid'),
(111, 'Administrator', '19,22,7,5', 158600, 'aaaa', 'C:\\xampp\\htdocs\\OLIsCRIB\\modules/uploads/cus_682d09121d1af-ramosA.jpg', '2025-05-21 00:58:20', 'paid'),
(112, 'aaa', '3', 455000, 'aaa', 'uploads/del_682d1c81313b2.jpg', '2025-05-21 02:21:21', 'delivery'),
(113, 'Administrator', '19,22,7,5', 158600, '', '', '2025-05-21 02:21:33', 'pending'),
(114, 'Administrator', '19,22,7,5', 158600, '', '', '2025-05-21 02:24:02', 'pending'),
(115, 'asd', '1', 960000, 'asd', 'del_682d1e053c7fa.jpg', '2025-05-21 02:27:49', 'delivery'),
(116, 'asd', '7', 112000, 'asd', 'C:\\xampp\\htdocs\\OLIsCRIB\\modules/uploads/del_682d1f094f7b4.jpg', '2025-05-21 02:32:09', 'delivery');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `attempt` int(10) NOT NULL,
  `accstatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `profile`, `address`, `roles`, `items`, `attempt`, `accstatus`) VALUES
(1, 'useradmin', 'adminpass', 'Administrator', 'acc_682cfd855693f_ramosA.jpg', '', 'admin\r\n', ',19,22,7,5', 0, 'active'),
(2, 'client', 'client', 'client', '', 'clientaaa', 'client', ',3,19', 0, 'active'),
(3, 'iyen', 'jarren', 'Jarren Ramos', '', '', 'client', ',2,9,9', 0, 'active'),
(5, 'aaa', 'aaa', 'aaa', '682c4c9a1d3c7_ramosA.jpg', 'aaa', 'client', '', 0, 'active'),
(8, 'aa', 'aa', 'aa', '', 'aa', 'client', '', 0, 'active'),
(9, 'aaaa', 'aaaa', 'aaaa', '682c4d5b42d7e_ramosA.jpg', 'aaaa', 'client', '', 0, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
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
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
