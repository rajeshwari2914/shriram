-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2022 at 05:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shriram`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_07_21_070051_create_products_table', 1),
(2, '2022_09_13_144610_create_tbl_shrirams_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hsn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `features` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_sale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_purchase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `margin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safety_information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `legal_disclaimer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brands` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shrirams`
--

CREATE TABLE `tbl_shrirams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ring` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advance_amt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coller_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bound_patti_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_shrirams`
--

INSERT INTO `tbl_shrirams` (`id`, `name`, `mobile`, `desc`, `estri`, `ring`, `pendri`, `order_date`, `delivery_date`, `material`, `material_qty`, `total_amt`, `advance_amt`, `coller_size`, `bound_patti_size`, `created_at`, `updated_at`) VALUES
(1, 'abc', '1212121212', 'hjhj', 'no', 'no', 'no', '2022-09-12', '2022-09-10', 'Shirt', '1', '350', '100', '', '', '2022-09-29 12:09:19', '2022-09-29 12:09:19'),
(2, 'xyz', '9834734303', '12-1/2 123 123 123\r\n12-1/2 23-1/24', 'CD उभी इस्त्री', '10', '20', '2022-09-30', '2022-09-30', 'Paint', '2', '800', '320', 'no', 'no', '2022-09-30 02:39:17', '2022-10-08 09:29:09'),
(3, 'Ramesh Gajul', '9767532433', '42-1/2 34-3/4 39-/ 18-/ \r\n     22-/\r\n23-/ 31-3/4 11-/ 10-3/4', 'no', 'no', 'no', '2022-10-04', '2022-10-06', 'Shirt', '3', '1050', '200', '10', 'no', '2022-10-04 09:32:39', '2022-10-07 09:49:37'),
(4, 'Rani Ganji', '9767532433', '21-1/2 10-1/2 56\r\n20-1/2 12', 'no', 'no', 'no', '2022-10-08', '2022-10-10', 'Shirt', '2', '700', '300', '32', 'no', '2022-10-08 08:45:34', '2022-10-08 08:45:34'),
(6, 'rano', '1212121212', '21-1/2 20 23-1/2\r\n20 25', 'no', 'no', 'no', '2022-10-08', '2022-08-10', 'Kurta', '2', '700', '0', 'no', '10', '2022-10-08 08:54:44', '2022-10-08 08:54:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shrirams`
--
ALTER TABLE `tbl_shrirams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shrirams`
--
ALTER TABLE `tbl_shrirams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
