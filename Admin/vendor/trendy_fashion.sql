-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 06:36 PM
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
-- Database: `trendy_fashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `email`, `password`, `username`, `image`) VALUES
(1, 'trendy@gmail.com', 'trendy1234', 'Trendy Fashion', 'girl1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `title`, `image`, `sub_id`) VALUES
(6, 'zsd', 'viber_image_2024-07-24_16-26-57-234.jpg,viber_image_2024-07-24_16-26-58-204.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `d_id`, `quantity`) VALUES
(17, 7, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'BKK Brand'),
(3, 'Local Brand');

-- --------------------------------------------------------

--
-- Table structure for table `collaboration`
--

CREATE TABLE `collaboration` (
  `col_id` int(11) NOT NULL,
  `info` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collaboration`
--

INSERT INTO `collaboration` (`col_id`, `info`) VALUES
(1, '<div>Order Status</div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas iusto, alias, tempora fuga quam eveniet neque excepturi aliquid. Eligendi, mollitia.</div><div><br></div><div>Shipping &amp; Delivery</div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam voluptatibus, incidunt similique nobis sint quisquam nam ab error consequuntur sit ullam ex eum exercitationem, excepturi explicabo beatae eos aspernatur odit ad perspiciatis, neque saepe magni enim. Maiores quia, quae sequi.</div><div><br></div><div>Payments</div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus repellat id, laboriosam ipsa repudiandae quisquam, suscipit officiis, praesentium itaque facilis distinctio dolorum. Velit reiciendis libero laudantium corporis, delectus impedit sunt.</div><div><br></div><div>Returns &amp; Exchanges</div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam eaque nam, ab voluptas et debitis sint hic vel ratione dignissimos.</div><div><br></div><div>Privacy Policy</div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae blanditiis quod saepe, inventore ipsum sint cum iste quae ratione nobis laborum minima autem totam similique, quia neque deleniti! Provident, suscipit.</div>');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`customer_id`, `username`, `email`, `password`, `phone`) VALUES
(6, 'Khin2', 'khin22@gmail.com', 'khin123', '0924745146'),
(7, 'su', 'su@gmail.com', '123', '09978313769'),
(8, 'SuLatt', 'sulatt@gmail.com', '123', '09781243250'),
(9, 'Miya', 'miya@gmail.com', '123', '09781243250'),
(10, 'Layla', 'layla@gmail.com', '123', '09123456789'),
(11, 'Zilong', 'zilong@gmail.com', '123', '09123456789'),
(12, 'Khamoom Chai', 'chai@gmail.com', '111111', '09978313769');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deli_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `shipping_date` date DEFAULT NULL,
  `delivered_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deli_id`, `invoice_id`, `shipping_date`, `delivered_date`, `status`) VALUES
(18, 26, '2024-07-23', NULL, 'shipped'),
(19, 27, NULL, NULL, 'processing'),
(20, 28, NULL, '2024-07-24', 'delivered'),
(21, 29, '2024-07-23', NULL, 'shipped'),
(22, 30, NULL, NULL, 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `deli_fee`
--

CREATE TABLE `deli_fee` (
  `fee_id` int(11) NOT NULL,
  `fee` text NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deli_fee`
--

INSERT INTO `deli_fee` (`fee_id`, `fee`, `location_id`) VALUES
(1, '2000', 1),
(10, '2000', 2),
(11, '2000', 3),
(12, '2000', 4),
(13, '3000', 5),
(14, '3500', 6),
(15, '2000', 32),
(17, '5000', 7),
(20, '1000', 36),
(21, '1000', 37),
(22, '1000', 38),
(23, '1000', 39),
(24, '2000', 40),
(25, '1000', 41),
(26, '1000', 42),
(27, '2000', 43),
(28, '1000', 44),
(29, '2000', 45),
(30, '2000', 46),
(31, '2000', 47),
(32, '2000', 48),
(33, '2000', 49),
(34, '2000', 50),
(35, '2000', 51),
(36, '2000', 52),
(37, '2000', 53),
(38, '1000', 54),
(39, '2000', 55),
(40, '2000', 8),
(41, '2000', 9),
(42, '2000', 10),
(43, '2000', 11),
(44, '2000', 12),
(45, '2000', 13),
(46, '1000', 14),
(47, '2000', 21),
(48, '2000', 16),
(49, '2000', 17),
(50, '2000', 19),
(51, '2000', 20);

-- --------------------------------------------------------

--
-- Table structure for table `deli_info`
--

CREATE TABLE `deli_info` (
  `deli_info_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `address_details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deli_info`
--

INSERT INTO `deli_info` (`deli_info_id`, `name`, `email`, `phone`, `location_id`, `address_details`) VALUES
(30, 'Su Latt', 'sulatt@gmail.com', '09978313769', 12, '502 D2 '),
(31, 'Su Latt', 'sulatt@gmail.com', '09781243250', 12, '502 D2 '),
(32, 'Su Mon', 'sulatt@gmail.com', '09781243250', 14, 'address'),
(33, 'Ma Miya', 'miya@gmail.com', '09123456789', 14, 'Mobile Legend'),
(34, 'Layla', 'layla@gmail.com', '09978313769', 16, '502 D2 '),
(35, 'Zilong', 'zilong@gmail.com', '09123456789', 7, '502 D2 ');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `dis_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discount_price` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `deli_info_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_no`, `customer_id`, `deli_info_id`, `fee_id`, `total`, `invoice_date`) VALUES
(26, 1001, 8, 31, 44, '26000', '2024-07-24'),
(27, 1002, 8, 32, 46, '8000', '2024-07-24'),
(28, 1003, 9, 33, 46, '4000', '2024-07-24'),
(29, 1004, 10, 34, 48, '4000', '2024-07-24'),
(30, 1005, 11, 35, 17, '13000', '2024-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `township` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `city`, `township`) VALUES
(1, 'Dagon Myothit', 'Dagon Seikkan - North'),
(2, 'Dagon Myothit', 'Dagon Seikkan - South'),
(3, 'Dagon Myothit', 'Dagon Seikkan'),
(4, 'Dagon Myothit', 'North Dagon Bohmu Ba Htoo Road - Ba Yint Naung Road'),
(5, 'Dagon Myothit', 'East Dagon'),
(6, 'Dagon Myothit', 'North Dagon Bohmu Ba Htoo Road - Pyi Htaung Su Main Road'),
(7, 'Dagon Myothit', 'North Dagon Bohmu Ba Htoo Road - U Wisara Road'),
(8, 'Dagon Myothit', 'North Dagon Min Ye Kyaw Swar Road - Ba Yint Naung Road'),
(9, 'Dagon Myothit', 'North Dagon Min Ye Kyaw Swar Road - Pyi Htaung Su Main Road'),
(10, 'Dagon Myothit', 'North Dagon Min Ye Kyaw Swar Road - U Wisara Road'),
(11, 'Dagon Myothit', 'North Dagon Pinlon Hospital'),
(12, 'Dagon Myothit', 'North Dagon Pinlon Hospital- Pyi Htaung Su Main Road'),
(13, 'Dagon Myothit', 'North Dagon Pinlon Hospital - U Wisara Road'),
(14, 'Dagon Myothit', 'North Dagon Pinlon Hospital - U Wisara Road - Ba Yint Naung Road'),
(16, 'Dagon Myothit', 'North Dagon Tapin Shwe Htee Road - Pyi Htaung Su Main Road'),
(17, 'Dagon Myothit', 'North Dagon Post Office'),
(19, 'Dagon Myothit', 'North Dagon Tapin Shwe Htee Road - Ba Yint Naung Road'),
(20, 'Dagon Myothit', 'North Dagon Tapin Shwe Htee Road - U Wisara'),
(21, 'Dagon Myothit', 'South Dagon'),
(32, 'Yangon City', 'Ahlone'),
(36, 'Yangon City', 'Bahan Golden Valley'),
(37, 'Yangon City', 'Bahan Kabar Aye Pagoda Road'),
(38, 'Yangon City', 'Bahan Kan Daw Gyi'),
(39, 'Yangon City', 'Bahan Myanmar Plaza'),
(40, 'Yangon City', 'Bahan Saya San Road'),
(41, 'Yangon', 'Shwe Gone Taing Road'),
(42, 'Yangon City', 'Bahan U Chi Mg Road'),
(43, 'Yangon', 'Bahan University Avenue Road'),
(44, 'Yangon City', 'Botataung'),
(45, 'Yangon City', 'Dagon Downtown'),
(46, 'Yangon City', 'Dawbon'),
(47, 'Yangon City', 'Hlaing Baho Road'),
(48, 'Yangon City', 'Hlaing Market'),
(49, 'Yangon City', 'Hlaing Parami Road'),
(50, 'Yangon City', 'Hlaing Pyay Road'),
(51, 'Yangon City', 'Hlaingthaya'),
(52, 'Yangon City', 'Hlaing Thiri Mingalar Market'),
(53, 'Yangon City', 'Insein Aung San Market'),
(54, 'Yangon City', 'Hlaing University'),
(55, 'Yangon City', 'Insein Bayint Naung Road');

-- --------------------------------------------------------

--
-- Table structure for table `place_order`
--

CREATE TABLE `place_order` (
  `order_id` int(11) NOT NULL,
  `product_detail_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `cus_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_order`
--

INSERT INTO `place_order` (`order_id`, `product_detail_id`, `quantity`, `invoice_id`, `cus_status`) VALUES
(20, 28, '2', 26, 'order'),
(21, 31, '2', 27, 'order'),
(22, 24, '1', 28, 'order'),
(23, 27, '1', 29, 'order'),
(24, 29, '1', 30, 'order');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `price`, `status`, `type_id`, `sub_id`, `state`, `date`) VALUES
(16, 'Baimon Ribbon Top', 'des', '4000', '1', 2, 1, 'New Arrival', '23-07-2024 13:20'),
(17, 'Flower Short Dress', 'des', '13000', '1', 2, 5, 'New Arrival', '23-07-2024 13:23'),
(18, 'Pinky Skirt', 'des', '4000', '1', 2, 5, 'New Arrival', '23-07-2024 13:27'),
(19, 'Style Pant', 'popular style jean pant', '12000', '1', 2, 5, 'New Arrival', '24-07-2024 13:42'),
(20, 'White Shirt', 'White Mommy Favious', '23000', '1', 2, 5, 'New Arrival', '24-07-2024 13:44'),
(21, 'Lover Girl Shirt', 'Lovely and Powerfull Lady', '23000', '1', 2, 5, 'New Arrival', '24-07-2024 13:46'),
(22, 'Linen Summer Dress', 'Stay cool and stylish this summer with our Linen Summer Dress. Made from 100% natural linen, this breezy dress features a flattering A-line silhouette, a V-neckline,', '12000', '1', 2, 4, 'Popular', '24-07-2024 15:06'),
(23, 'Silk Blouse', 'Add elegance to your ensemble with our Silk Blouse. Crafted from luxurious silk, it features a sleek silhouette and delicate details.', '4000', '1', 6, 2, 'New Arrival', '24-07-2024 15:20'),
(24, 'Women\'s Floral Maxi Dress', 'Embrace femininity in our Floral Maxi Dress. With a flowing silhouette and vibrant floral print, it\'s perfect for special occasions.', '10900', '1', 3, 1, 'None', '24-07-2024 15:22'),
(25, 'Women\'s Pashmina Shawl', 'Add a touch of elegance with our Pashmina Shawl. Made from fine pashmina wool, it drapes beautifully and enhances any outfit.', '13000', '1', 1, 3, 'None', '24-07-2024 15:24'),
(26, 'Leather Jacket', 'Make a statement with our Leather Jacket. Crafted from genuine leather, it combines classic style with durability for a timeless look.', '13000', '1', 6, 1, 'Best Seller', '24-07-2024 15:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `color_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`color_id`, `color`) VALUES
(1, 'Pink'),
(2, 'Black'),
(3, 'White'),
(4, 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `d_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`d_id`, `product_id`, `color`, `size`, `qty`) VALUES
(23, 15, '2', '4', '5'),
(24, 16, '4', '7', '3'),
(25, 16, '3', '3', '10'),
(26, 16, '2', '4', '10'),
(27, 16, '2', '3', '9'),
(28, 17, '4', '7', '2'),
(29, 17, '3', '3', '9'),
(30, 18, '4', '7', '9'),
(31, 18, '4', '3', '8'),
(32, 18, '2', '4', '10'),
(33, 19, '3', '7', '10'),
(34, 20, '3', '7', '10'),
(35, 21, '4', '7', '10'),
(36, 22, '4', '7', '10'),
(37, 24, '4', '7', '10'),
(38, 23, '4', '7', '10'),
(39, 25, '4', '7', '10'),
(40, 26, '4', '7', '10');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `image_name`, `product_id`) VALUES
(28, '1720489819_modal-product.jpg', 15),
(29, '669f923bea1ee_product-1.jpg', 16),
(30, '669f923bf0568_product-2.jpg', 16),
(31, '669f923bf217f_product-3.jpg', 16),
(32, '669f92dc2301a_product-7.jpg', 17),
(33, '669f92dc2b873_product-8.jpg', 17),
(34, '669f92dc2d331_product-9.jpg', 17),
(35, '669f93b410619_product-4.jpg', 18),
(36, '669f93b412f32_product-5.jpg', 18),
(37, '669f93b414b37_product-6.jpg', 18),
(38, '66a0e8c69fd6e_product-5.jpg', 19),
(39, '66a0e928cfec4_product-9.jpg', 20),
(40, '66a0e99b37782_product-4.jpg', 21),
(41, '66a0ff17205e1_product-1.jpg', 22),
(42, '66a0ffc74156b_product-2.jpg', 23),
(43, '66a1002d69ce6_product-6.jpg', 24),
(44, '66a10082883cc_product-5.jpg', 25),
(45, '66a100d47340e_product-3.jpg', 26);

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `size_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`size_id`, `size`) VALUES
(3, 'S'),
(4, 'M'),
(5, 'L'),
(6, 'XL'),
(7, 'Free');

-- --------------------------------------------------------

--
-- Table structure for table `shop_info`
--

CREATE TABLE `shop_info` (
  `shop_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `viber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `close_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Dumping data for table `shop_info`
--

INSERT INTO `shop_info` (`shop_id`, `name`, `phone`, `viber`, `address`, `open_time`, `close_time`) VALUES
(2, 'Shop', '0998689406', '09445225028', 'Ygn', '08:00', '03:00'),
(3, 'Shop1', '0998689406', '09445225028', 'Mdy', '08:00', '17:00'),
(13, 'Shop2', '0998689406', '09445225028', 'Ygn', '08:00', '03:00');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `social_id` int(11) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `tiktok` varchar(255) NOT NULL,
  `insta` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_520_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`social_id`, `fb`, `tiktok`, `insta`, `phone`) VALUES
(1, 'facebook', 'example@tiktok.com', 'example@instagram.com', '09986894706');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_id`, `brand_name`, `category_id`) VALUES
(1, 'Baimon', 1),
(2, 'Pond', 1),
(3, 'Navia', 1),
(4, 'Kay Kay', 3),
(5, 'Tinkora', 3);

-- --------------------------------------------------------

--
-- Table structure for table `temp_product`
--

CREATE TABLE `temp_product` (
  `id` int(11) NOT NULL,
  `color_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `size_id` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `name`) VALUES
(1, 'shirt'),
(2, 'pant'),
(3, 'Dress'),
(4, 'Top'),
(5, 'Skirt'),
(6, 'Jean');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_ibfk_1` (`customer_id`),
  ADD KEY `cart_ibfk_2` (`d_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `collaboration`
--
ALTER TABLE `collaboration`
  ADD PRIMARY KEY (`col_id`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deli_id`),
  ADD KEY `order_id` (`invoice_id`);

--
-- Indexes for table `deli_fee`
--
ALTER TABLE `deli_fee`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `deli_fee_ibfk_1` (`location_id`);

--
-- Indexes for table `deli_info`
--
ALTER TABLE `deli_info`
  ADD PRIMARY KEY (`deli_info_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`dis_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `fee_id` (`fee_id`),
  ADD KEY `invoice_ibfk_2` (`deli_info_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `place_order`
--
ALTER TABLE `place_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `product_detail_id` (`product_detail_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_ibfk_1` (`sub_id`),
  ADD KEY `product_ibfk_2` (`type_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `product_detail_ibfk_1` (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_image_ibfk_1` (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `temp_product`
--
ALTER TABLE `temp_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collaboration`
--
ALTER TABLE `collaboration`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `deli_fee`
--
ALTER TABLE `deli_fee`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `deli_info`
--
ALTER TABLE `deli_info`
  MODIFY `deli_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `place_order`
--
ALTER TABLE `place_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp_product`
--
ALTER TABLE `temp_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `sub_category` (`sub_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_account` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `product_detail` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deli_fee`
--
ALTER TABLE `deli_fee`
  ADD CONSTRAINT `deli_fee_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Constraints for table `deli_info`
--
ALTER TABLE `deli_info`
  ADD CONSTRAINT `deli_info_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_account` (`customer_id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`deli_info_id`) REFERENCES `deli_info` (`deli_info_id`),
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`fee_id`) REFERENCES `deli_fee` (`fee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
