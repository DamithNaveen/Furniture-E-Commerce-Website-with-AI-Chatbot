-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2025 at 04:54 AM
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
-- Database: `myshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'abc@gmail.com', 'abc'),
(2, 'def@gmail.com', 'def');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(10) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(2, 'ASPENHOME'),
(3, 'AMERICAN DREW'),
(4, 'BEST HOME FURNISHINGS'),
(5, 'BRENTWOOD CLASSICS'),
(7, 'BEDGEAR'),
(8, 'AMANA');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(2, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'SOFAS & LOUNGERS'),
(3, 'WARDROBES'),
(4, 'DINING SETS'),
(5, 'SHOE RACKS'),
(6, 'STUDY TABLES\r\n'),
(7, 'LAPTOP TABLES'),
(8, 'OFFICE CHAIRS'),
(10, 'BEDS'),
(16, 'Sweet Bed'),
(17, 'g');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` text NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`) VALUES
(1, 'Haymant Mangla', 'haymant_1998@outlook.com', 'admin', 'India', 'Moga', '8968687874', 'adadm', 'photo.jpg', '::1'),
(3, 'Sandun Warnasooriya', 'sandunwarnasooreya345@gmail.com', '123457890', 'Western', 'Colombo', '0754794145', '30/g Galmaduw Waththa Kundasalaya', '5.PNG', '::1'),
(4, 'devika', 'def@gmail.com', '1234567890', 'Northern', 'Kilinochchi', '07657654745', 'gdtestet', '', '::1'),
(5, 'Sandun Warnasooriya', 'sandunwarnasooreya345@gmail.com', '1234567890', 'Eastern', 'Batticaloa', '0754794145', '30/g Galmaduw Waththa Kundasalaya', '473005864_122197318124229615_1709937341070981078_n.jpg', '::1'),
(6, 'Sandun Warnasooriya', 'sandunwarnasooreya345@gmail.com', '1234567890', 'Northern', 'Jaffna', '0754794145', '30/g Galmaduw Waththa Kundasalaya', '473005864_122197318124229615_1709937341070981078_n.jpg', '::1'),
(7, 'Sandun Warnasooriya', 'sandunwarnasooreya345@gmail.com', '12345678890', 'Eastern', 'Trincomalee', '0754794145', '30/g Galmaduw Waththa Kundasalaya', '94710689707_status_e80b7454460a40479225cc6bfcd190f2.jpg', '::1'),
(8, 'devika', 'def1@gmail.com', '12345', 'North Western', 'Kurunegala', '0754794145', 'gdtestet', '????????? 2025-09-05 170150.png', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `total_products` int(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES
(25, 1, 349, 3957, 1, '2025-09-06 08:57:02', 'Complete'),
(26, 1, 27232, 8838, 1, '2025-09-06 16:39:40', 'Complete'),
(27, 1, 14900, 5529, 1, '2025-09-06 16:41:25', 'Complete'),
(28, 1, 1828, 7136, 2, '2025-09-06 10:19:45', 'Pending'),
(29, 1, 1479, 1985, 1, '2025-09-06 10:21:19', 'Pending'),
(30, 1, 27871, 9104, 3, '2025-09-06 10:21:52', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `furniture_customizations`
--

CREATE TABLE `furniture_customizations` (
  `id` int(11) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `furniture_name` varchar(255) NOT NULL,
  `furniture_type` varchar(100) NOT NULL,
  `wood_type` varchar(100) NOT NULL,
  `size` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `admin_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture_customizations`
--

INSERT INTO `furniture_customizations` (`id`, `customer_email`, `furniture_name`, `furniture_type`, `wood_type`, `size`, `color`, `notes`, `image`, `status`, `admin_price`, `created_at`) VALUES
(1, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Chair', 'Mahogany', '500', 'iyiy', 'iyiyi', '473047453_122197318178229615_6047025687093806361_n.jpg', 'Approved', NULL, '2025-09-06 09:42:43'),
(2, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Chair', 'Mahogany', '500', 'iuiu', 'igig', '', 'Approved', NULL, '2025-09-06 09:50:18'),
(3, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Chair', 'Mahogany', '500', 'iuiu', 'igig', '', 'Approved', NULL, '2025-09-06 09:54:36'),
(4, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Table', 'Mahogany', 'ouo', 'ouo', 'ouou', '', 'Rejected', NULL, '2025-09-06 09:54:46'),
(5, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Chair', 'Oak', 'lj', 'lj', 'lj', '473081252_122197318292229615_8571917445412570367_n.jpg', 'Rejected', 7567575.00, '2025-09-06 09:57:34'),
(6, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Sofa', 'Mahogany', 'ouo', 'pip', 'ipi', '473047453_122197318178229615_6047025687093806361_n.jpg', 'Approved', NULL, '2025-09-06 10:08:26'),
(7, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Chair', 'Mahogany', 'pkp', 'pkp', 'pkpk', 'red-sofa-living-room-design-interior-idea-marcel-wanders-1.jpg', 'Approved', NULL, '2025-09-06 11:35:23'),
(8, 'sandunwarnasooreya345@gmail.com', 'ugu', 'Chair', 'Mahogany', '[o', '[o', '[o[', '473047453_122197318178229615_6047025687093806361_n.jpg', 'Rejected', NULL, '2025-09-06 11:37:27'),
(9, 'sandunwarnasooreya345@gmail.com', '[l[', 'Table', 'Teak', '[lo[l', '[l[l', '[l[l', '94710689707_status_e80b7454460a40479225cc6bfcd190f2.jpg', 'Approved', 76767676.00, '2025-09-06 11:39:31'),
(10, 'sandunwarnasooreya345@gmail.com', 'jh', 'jh', 'jh', 'jh', 'jh', NULL, 'red-sofa-living-room-design-interior-idea-marcel-wanders-1.jpg', 'Rejected', NULL, '2025-09-06 11:42:27'),
(11, 'def1@gmail.com', 'yryr', 'Cabinet', 'Mahogany', 'yryr', 'ryr', 'yryr', '', 'Approved', NULL, '2025-09-06 14:00:19'),
(12, 'sandunwarnasooreya345@gmail.com', '[l[', 'Sofa', 'Oak', '[lo[l', 'po', 'popo', '', 'Approved', 5000.00, '2025-09-06 16:40:48'),
(13, 'sandunwarnasooreya345@gmail.com', '[l[', 'Chair', 'Mahogany', '400+87+87', 'green', 'hghg', '', 'Approved', 5600.00, '2025-09-06 17:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `payment_mode` text NOT NULL,
  `ref_no` int(10) NOT NULL,
  `code` int(10) NOT NULL,
  `payment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `invoice_no`, `amount`, `payment_mode`, `ref_no`, `code`, `payment_date`) VALUES
(1, 0, 0, 'Select Payment', 0, 0, ''),
(2, 0, 0, 'Select Payment', 0, 0, ''),
(3, 0, 0, 'Select Payment', 0, 0, ''),
(4, 0, 76767, 'Bank Transfer', 86, 68, ''),
(5, 0, 76767, 'Easypay/UBL Transfer', 86, 68, '86'),
(6, 0, 0, 'Bank Transfer', 0, 0, 'jhj'),
(7, 0, 0, 'Western Union', 0, 0, '98000'),
(8, 7676, 646464, 'Bank Transfer', 64, 64, '2025/09/22'),
(9, 7676, 646464, 'Bank Transfer', 64, 64, '2025/09/22');

-- --------------------------------------------------------

--
-- Table structure for table `pending_order`
--

CREATE TABLE `pending_order` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pending_order`
--

INSERT INTO `pending_order` (`order_id`, `customer_id`, `invoice_no`, `product_id`, `qty`, `order_status`) VALUES
(1, 1, 382, 7, 1, 'Complete'),
(2, 1, 706, 8, 1, 'Complete'),
(3, 1, 381, 7, 1, 'Pending'),
(5, 1, 179, 3, 1, 'Pending'),
(6, 1, 801, 8, 1, 'Pending'),
(7, 1, 891, 0, 1, 'Pending'),
(8, 1, 735, 0, 1, 'Pending'),
(9, 1, 730, 5, 1, 'Pending'),
(10, 1, 806, 9, 1, 'Pending'),
(12, 1, 204, 0, 1, 'Pending'),
(13, 1, 669, 7, 1, 'Pending'),
(14, 1, 623, 5, 1, 'Pending'),
(15, 1, 252, 6, 1, 'Pending'),
(16, 1, 696, 0, 1, 'Pending'),
(17, 1, 54, 2, 1, 'Pending'),
(18, 1, 218, 5, 1, 'Pending'),
(19, 1, 916, 3, 1, 'Pending'),
(20, 1, 558, 2, 1, 'Pending'),
(21, 1, 3190, 2, 1, 'Pending'),
(22, 1, 3437, 5, 1, 'Pending'),
(23, 1, 3352, 3, 1, 'Pending'),
(24, 1, 3352, 4, 1, 'Pending'),
(25, 1, 9584, 4, 1, 'Complete'),
(26, 1, 3957, 7, 1, 'Complete'),
(27, 1, 8838, 10, 1, 'Complete'),
(28, 1, 5529, 2, 1, 'Pending'),
(29, 1, 7136, 4, 1, 'Pending'),
(30, 1, 7136, 7, 1, 'Pending'),
(31, 1, 1985, 4, 1, 'Pending'),
(32, 1, 9104, 5, 1, 'Pending'),
(33, 1, 9104, 8, 1, 'Pending'),
(34, 1, 9104, 10, 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `brand_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` text NOT NULL,
  `status` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_desc` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `brand_id`, `date`, `product_title`, `status`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`, `product_keywords`) VALUES
(2, 6, 3, '2025-09-04 13:32:37', 'Leiko Study Desk with Book Shelf in Nut Brown Finish', 'on', 'prod 2-1.png', 'prod 2-2.png', 'prod 2-3.png', 14900, 'Mintwud presents a wide showcase of modern furniture thats designed to seamlessly blend with your interiors. Crafted for compact homes, the range is clean and convenient. All the collections have an understated design aesthetic that adapt to any space. The designs represent the ideals of cutting excess, practicality and an absence of decoration.', 'study table'),
(3, 5, 4, '2019-03-17 11:02:38', 'Aperi Solid Wood Shoe Rack With Center shelf in Provincial Teak Finish ', 'on', 'prod 3-1.png', 'prod 3-2.png', 'prod 3-3.png', 148, 'Contemporary Furniture reflects designs that are current or en vogue. It doesnt necessarily reference historical design styles and often provides a feeling of everything in its place.', 'shoe rack'),
(4, 4, 5, '2019-03-17 11:02:49', 'Tiber Solid Wood Six Seater Dining Set in Premium Acacia Finish', 'on', 'prod 4-1.png', 'prod 4-2.png', 'prod 4-3.png', 1479, 'Rustic, rich & retreat. An undeniably dramatic Acacia wood collection which adds to your vanity.\r\n\r\nReflecting designs that are Classic and Contemporary; Woodsworth delivers the right blend of aesthetics and functionality, as well as comfort and promised quality.', 'dining sets'),
(5, 3, 1, '2019-03-17 11:03:04', 'Kosmo Grace Three Door Wardrobe with Drawer & Locker in Rigato Walnut Finish', 'on', 'prod 5-1.png', 'prod 5-2.png', 'prod 5-3.png', 290, 'Modern Furniture reflects the design philosophy of form following function prevalent in modernism. These designs represent the ideals of cutting excess, practicality and an absence of decoration.\r\n\r\nThe forms of furniture are visually light (like in the use of polished metal and engineered wood) and follow minimalist principles of design which are influenced by architectural concepts like the cantilever. Modern furniture fits best in open floor plans with clean lines that thrive in the absence of clutter.', 'Kosmo Grace Three Door Wardrobe'),
(6, 7, 3, '2019-03-17 11:01:48', 'Half and Half Portable Folding multipurpose Laptop cum Study Table in Green Colour', 'on', 'prod 6-1.png', 'prod 6-2.png', 'prod 6-3.png', 159, 'Sattva Portable Folding Laptop table is made of high quality pine wood material with exquisiteWorkmanship makes it durable and light enough to carry easily.', 'study table, laptop table'),
(7, 1, 1, '2019-03-17 11:01:19', 'Stanfield Solid Wood Queen Size Bed in Honey oak Finish', 'on', 'prod 7-1.png', 'prod 7-2.png', 'prod 7-3.png', 349, 'Colonial Style Furniture is graceful and refined, often characterized by the use of turnings, curved legs and motifs to present an elegant appearance. Colonial Style Furniture on Pepperfry sees Indian craftsmen interpreting European period styles (such as the Queen Anne and Georgian styles) in indigenous woods like Sheesham and Mango.', 'beds, '),
(8, 2, 2, '2019-03-17 11:01:33', 'Cielo One Seater Sofa in Chestnut Brown Colour', 'on', 'prod 8-1.png', 'prod 8-2.png', 'prod 8-3.png', 349, 'Robust & Well Crafted.\r\nCrafted with a neat silhouette, Cielo makes for an enduring sofa with its deep-set seat and styling.\r\nCasaCraft offers the best in comfort, with elan. The collections are a series of modern designs, which are simple yet striking and represent the ideals of minimalism and cutting excess. The designs are a perfect blend of functionality and exceptional aesthetics. Each piece is crafted with passion and reflects quality and style, addressing the needs of a wide range of audience.', 'sofas,'),
(10, 2, 2, '2025-09-04 11:15:57', 'Red sofa', 'on', 'red-sofa-living-room-design-interior-idea-marcel-wanders-1.jpg', '', '', 27232, 'ygtrt', 'rerer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `furniture_customizations`
--
ALTER TABLE `furniture_customizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pending_order`
--
ALTER TABLE `pending_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `furniture_customizations`
--
ALTER TABLE `furniture_customizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pending_order`
--
ALTER TABLE `pending_order`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
