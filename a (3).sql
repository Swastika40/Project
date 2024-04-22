-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 05:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `oid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `name`, `contact`, `address`, `total`, `product_name`, `date`) VALUES
(16, 'Orbit', '21121', 'asdf', '1240', 'chamal', '2022-05-26 17:09:28'),
(17, 'okendra', '9128393891', 'asfd', '465', 'chamal', '2022-06-02 10:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `location`, `price`) VALUES
(1, 'hariyo kerau', '1pexels-r-khalil-768092.jpg', 195),
(3, 'gahu', '4kodo.jpg', 233),
(4, 'chamal', '4rice.jpg', 155),
(5, 'soya', '3soyabean.jpg', 245),
(6, 'millet', '8mill.png', 342),
(7, 'Local Dhan', '61.jpg', 180),
(8, 'Red Beans', '1beans.jpg', 210),
(9, 'Brown Beans', '2a.jpg', 180),
(10, 'Chana', '9cha.jpg', 120),
(11, 'Phapar', '1pexels-north-1296262.jpg', 150),
(12, 'Local Soya', '7Soya Beana.jpg', 135),
(13, 'Gahu', '4wheat.jpg', 115),
(15, 'Local Makai', '0Makai.jpg', 85),
(16, 'Bodii', '9Bodii.jpg', 65),
(17, 'Rato Makai', '4Rato Makai.jpg', 95),
(18, 'kwati', '5M.jpg', 150);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rid`, `pid`, `uid`, `rating`) VALUES
(1, 1, 1, 3),
(2, 6, 1, 5),
(3, 2, 1, 4),
(4, 5, 1, 2),
(5, 3, 1, 4),
(6, 6, 6, 3),
(7, 2, 7, 3),
(8, 6, 7, 4),
(9, 2, 8, 4),
(10, 1, 7, 4),
(11, 8, 1, 4),
(12, 9, 1, 3),
(13, 10, 1, 3),
(14, 11, 1, 4),
(15, 12, 1, 4),
(16, 17, 1, 4),
(17, 15, 1, 4),
(18, 16, 1, 5),
(19, 18, 1, 5),
(20, 3, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`) VALUES
(1, 'okendra', 'admin', '$2y$10$i0ZY54zUOfYtleDGpoBwuuXWHvasRfQH0YUMWyue9pxmVkNsVKZ1e'),
(5, 'praful', 'admin', '$2y$10$GL52v8xaH0kd2gbe3e0GX.OONNzfsG4eFxMpeGbqoA8kVM0eUy2tS'),
(7, 'he', 'user', '$2y$10$W/T/PSDvEWYWYUBQlnjGcunWl9sY5OwW7RTsvuSno59KjdDgc2ORy'),
(10, 'Orbit', 'user', '$2y$10$37ea3vStHIqdLzPDlup0pOMIxoaUbrWQWH2ug77PPizXIi29nPpeq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
