-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 09:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it28-ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `rrp` decimal(10,0) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(13, 'watches', 'This multi-piece case and bezel come in a brushed silver finish with light yellow gold center links and bezel.', '1200', '1200', 1, 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/ML763_VW_34FR+watch-case-45-stainless-gold-s9_VW_34FR+watch-face-45-stainless-gold-s9_VW_34FR?wid=750&hei=712&trim=1%2C0&fmt=p-jpg&qlt=95&.v=1694507905569', '2024-05-27 15:16:00'),
(14, 'watches', 'a wristwatch whose movement is enclosed in a case in which the openings for the winding and cover are sealed with gaskets and able to withstand pressures equal to several fathoms of submersion.', '2000', '2000', 1, 'https://watchesbysjx.com/wp-content/uploads/2018/05/Tudor-Black-Bay-Steel-water-testing.jpg', '2024-05-27 15:18:04'),
(15, 'silver watch', 'multi function', '2000', '2000', 1, 'https://i.ebayimg.com/images/g/fpEAAOSwKFVlNrr0/s-l1200.webp', '2024-05-27 15:22:27'),
(16, 'sport watches', 'red', '1000', '1000', 1, 'https://m.media-amazon.com/images/I/61fyBGuO18L._AC_UY1000_.jpg', '2024-05-27 15:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$kGp4g1TjBK4XwLIwRbBHSeZ4W5FpPbYoB1ap5NfFUjUPAcE3KR5QG', '2024-04-29 16:39:58'),
(0, 'jimjim', '$2y$10$MBe5y9.ZFkpJZnLImk8VoODPlNAHmLo4bACZtk/kdyqsixB7nU3hC', '2024-05-24 22:15:50'),
(0, 'jim', '$2y$10$X//sBW8xjgFshs3GOfJAbeeGoufNHrBJUIZzmsIJkaeKqMTt3KnWq', '2024-05-24 22:17:14'),
(0, 'admin11', '$2y$10$vrDO0OMbqLTT6MsAvo4rrO/4KgWmKCFzNDML9ZDISOEApzUpPPkny', '2024-05-24 22:18:34'),
(0, 'admin111', '$2y$10$mrKCeKgVRI4uM1iBBhlxWuRX2zW6ZwQIaKyyc9ZtvDnzPOVkhMR56', '2024-05-27 15:11:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
