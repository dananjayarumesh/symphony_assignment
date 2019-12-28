-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2019 at 08:33 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symphony_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `category_id`, `name`, `isbn`, `price`, `qty`, `active`) VALUES
(1, 2, 'Seasick \r\n', '978-3-16-148410-0', 1500, 0, 1),
(2, 2, 'Horrid Henry and the football fiend \r\n', '978-3-16-148410-1', 1000, 0, 1),
(3, 2, 'Corn flakes for dinner : a heartbreaking comedy about family life \r\n', '978-3-16-148410-2', 1500, 0, 1),
(4, 2, 'The last straw \r\n', '978-3-16-148410-3', 750, 0, 1),
(5, 2, 'Cabin fever : diary of a wimpy kid [6] \r\n', '978-3-16-148410-4', 1500, 0, 1),
(6, 2, 'Horrid Henry\'s underpants \r\n', '978-3-16-148410-5', 1200, 0, 1),
(7, 2, 'Old school : diary of a wimpy kid [10] \r\n', '978-3-16-148410-6', 1900, 0, 1),
(8, 2, 'DogZombies rule (for now) \r\n', '978-3-16-148410-7', 1500, 0, 1),
(9, 2, 'The Witches \r\n', '978-3-16-148410-8', 5000, 0, 1),
(10, 2, 'Lying in wait \r\n', '978-3-16-148410-9', 500, 0, 1),
(11, 2, 'Match! : joke book! \r\n', '978-3-16-148411-0', 3600, 0, 1),
(12, 2, 'Stand by me \r\n', '978-3-16-148411-1', 4850, 0, 1),
(13, 2, 'The 13-storey treehouse \r\n', '978-3-16-148411-2', 650, 0, 1),
(14, 2, 'An eagle in the snow \r\n', '978-3-16-148411-3', 2200, 0, 1),
(15, 2, 'Seasick \r\n', '978-3-16-148410-0', 1500, 0, 1),
(16, 2, 'Horrid Henry and the football fiend \r\n', '978-3-16-148410-1', 1000, 0, 1),
(17, 2, 'Corn flakes for dinner : a heartbreaking comedy about family life \r\n', '978-3-16-148410-2', 1500, 0, 1),
(18, 2, 'The last straw \r\n', '978-3-16-148410-3', 750, 0, 1),
(19, 2, 'Cabin fever : diary of a wimpy kid [6] \r\n', '978-3-16-148410-4', 1500, 0, 1),
(20, 2, 'Horrid Henry\'s underpants \r\n', '978-3-16-148410-5', 1200, 0, 1),
(21, 2, 'Old school : diary of a wimpy kid [10] \r\n', '978-3-16-148410-6', 1900, 0, 1),
(22, 2, 'DogZombies rule (for now) \r\n', '978-3-16-148410-7', 1500, 0, 1),
(23, 2, 'The Witches \r\n', '978-3-16-148410-8', 5000, 0, 1),
(24, 2, 'Lying in wait \r\n', '978-3-16-148410-9', 500, 0, 1),
(25, 2, 'Match! : joke book! \r\n', '978-3-16-148411-0', 3600, 0, 1),
(26, 2, 'Stand by me \r\n', '978-3-16-148411-1', 4850, 0, 1),
(27, 2, 'The 13-storey treehouse \r\n', '978-3-16-148411-2', 650, 0, 1),
(28, 2, 'An eagle in the snow \r\n', '978-3-16-148411-3', 2200, 0, 1),
(29, 1, 'Two kinds of truth \r\n', '978-3-16-148510-5', 260, 0, 1),
(30, 1, 'Holly Webb\'s puppy friends \r\n', '978-3-16-148510-6', 300, 0, 1),
(31, 1, 'The crossing \r\n', '978-3-16-148510-7', 800, 0, 1),
(32, 1, 'Summer at Stonehenge. \r\n', '978-3-16-148510-8', 760, 0, 1),
(33, 1, 'Where\'s Mrs Ladybird \r\n', '978-3-16-148510-9', 2000, 0, 1),
(34, 1, 'Dog days \r\n', '978-3-16-148511-0', 670, 0, 1),
(35, 1, 'The late show \r\n', '978-3-16-148511-1', 1500, 0, 1),
(36, 1, 'Old School:   Diary of a Wimpy Kid [10] \r\n', '978-3-16-148511-2', 3200, 0, 1),
(37, 1, 'Kung Fu Panda : ready, set, Po! \r\n', '978-3-16-148511-3', 6800, 0, 1),
(38, 1, 'Everything\'s amazing (sort of) : Tom Gates [3] \r\n', '978-3-16-148511-4', 690, 0, 1),
(39, 1, 'Demi the Dressing-Up Fairy \r\n', '978-3-16-148511-5', 740, 0, 1),
(40, 1, 'Horrid Henry\'s homework \r\n', '978-3-16-148511-6', 500, 0, 1),
(41, 1, 'Footballers \r\n', '978-3-16-148511-7', 800, 0, 1),
(42, 1, 'Matilda \r\n', '978-3-16-148511-8', 500, 0, 1),
(43, 1, 'Pokemon Black and White 6 \r\n', '978-3-16-148511-9', 380, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `active`) VALUES
(1, 'Children', 1),
(2, 'Fiction', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `rate`, `active`) VALUES
(1, 'CLMVBG', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191228173042', '2019-12-28 17:31:00'),
('20191228174610', '2019-12-28 17:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `ref_no` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` tinytext COLLATE utf8mb4_unicode_ci,
  `last_name` tinytext COLLATE utf8mb4_unicode_ci,
  `phone` tinytext COLLATE utf8mb4_unicode_ci,
  `address_line_1` tinytext COLLATE utf8mb4_unicode_ci,
  `address_line_2` tinytext COLLATE utf8mb4_unicode_ci,
  `city` tinytext COLLATE utf8mb4_unicode_ci,
  `note` tinytext COLLATE utf8mb4_unicode_ci,
  `gross_total` double DEFAULT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `coupon_discount` double NOT NULL DEFAULT '0',
  `net_total` double NOT NULL DEFAULT '0',
  `email` tinytext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CBE5A33112469DE2` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F529939866C5951B` (`coupon_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_52EA1F098D9F6D38` (`order_id`),
  ADD KEY `IDX_52EA1F0916A2B381` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_CBE5A33112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F529939866C5951B` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_52EA1F0916A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `FK_52EA1F098D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
