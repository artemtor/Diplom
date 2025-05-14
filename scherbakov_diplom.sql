-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2025 at 04:30 PM
-- Server version: 10.11.11-MariaDB-ubu2204
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scherbakov_diplom`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `count`, `order_id`, `product_id`) VALUES
(4, 3, 1, 3, 2),
(5, 3, 1, 3, 1),
(6, 3, 1, 4, 1),
(11, 3, 1, 5, 2),
(12, 3, 1, 5, 1),
(13, 3, 1, 6, 1),
(14, 3, 1, 7, 2),
(15, 3, 1, 8, 2),
(16, 3, 1, 10, 2),
(17, 3, 1, 11, 4),
(18, 3, 1, 12, 1),
(19, 3, 3, 13, 1),
(20, 6, 1, NULL, 1),
(21, 3, 3, 14, 1),
(22, 3, 4, 15, 6),
(23, 3, 1, 16, 1),
(24, 3, 1, 17, 2),
(25, 3, 1, 18, 4),
(26, 9, 1, 19, 3),
(27, 9, 1, 21, 2),
(28, 9, 1, 23, 2),
(29, 9, 1, 26, 1),
(30, 9, 1, 28, 1),
(31, 3, 1, 30, 2),
(32, 3, 1, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catergory`
--

CREATE TABLE `catergory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catergory`
--

INSERT INTO `catergory` (`id`, `name`) VALUES
(1, 'Головные уборы'),
(3, 'Сумки'),
(4, 'Мягкие игрушки');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `read` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `key`, `message`, `read`, `created_at`) VALUES
(1, 'new_order', 'order_5', 'Новый заказ #5', 1, '2025-03-30 17:52:40'),
(2, 'new_order', 'order_6', 'Новый заказ #6', 1, '2025-03-30 17:58:07'),
(3, 'new_order', 'order_7', 'Новый заказ #7', 1, '2025-03-30 18:01:26'),
(4, 'new_order', 'order_8', 'Новый заказ #8', 1, '2025-03-30 18:10:51'),
(5, 'new_order', 'order_9', 'Новый заказ #9', 1, '2025-03-30 18:10:52'),
(6, 'new_order', 'order_10', 'Новый заказ #10', 1, '2025-03-30 18:14:11'),
(7, 'new_order', 'order_11', 'Новый заказ #11', 1, '2025-03-30 18:16:07'),
(8, 'new_order', 'order_12', 'Новый заказ #12', 1, '2025-03-31 05:45:08'),
(9, 'new_order', 'order_13', 'Новый заказ #13', 1, '2025-04-14 12:11:42'),
(10, 'new_order', 'order_14', 'Новый заказ #14', 1, '2025-04-18 10:08:41'),
(11, 'new_order', 'order_15', 'Новый заказ #15', 1, '2025-04-18 10:10:02'),
(12, 'new_order', 'order_16', 'Новый заказ #16', 1, '2025-04-20 17:52:08'),
(13, 'new_order', 'order_17', 'Новый заказ #17', 1, '2025-04-20 17:54:43'),
(14, 'new_order', 'order_18', 'Новый заказ #18', 1, '2025-04-20 18:56:03'),
(15, 'new_order', 'order_19', 'Новый заказ #19', 1, '2025-04-20 19:03:48'),
(16, 'new_order', 'order_20', 'Новый заказ #20', 1, '2025-04-20 19:03:48'),
(17, 'new_order', 'order_21', 'Новый заказ #21', 1, '2025-04-20 19:04:47'),
(18, 'new_order', 'order_22', 'Новый заказ #22', 1, '2025-04-20 19:04:47'),
(19, 'new_order', 'order_23', 'Новый заказ #23', 1, '2025-04-20 19:07:34'),
(20, 'new_order', 'order_24', 'Новый заказ #24', 1, '2025-04-20 19:07:34'),
(21, 'new_order', 'order_25', 'Новый заказ #25', 1, '2025-04-20 19:07:36'),
(22, 'new_order', 'order_26', 'Новый заказ #26', 1, '2025-04-20 19:08:05'),
(23, 'new_order', 'order_27', 'Новый заказ #27', 1, '2025-04-20 19:08:05'),
(24, 'new_order', 'order_28', 'Новый заказ #28', 1, '2025-04-20 19:11:00'),
(25, 'new_order', 'order_29', 'Новый заказ #29', 1, '2025-04-20 19:11:00'),
(26, 'new_order', 'order_30', 'Новый заказ #30', 1, '2025-04-26 07:37:44'),
(27, 'new_order', 'order_31', 'Новый заказ #31', 1, '2025-04-26 07:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `adress` varchar(255) NOT NULL,
  `payment_method` enum('При получении по карте','При получении наличными') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `date`, `status_id`, `user_id`, `adress`, `payment_method`) VALUES
(3, '2025-03-25 12:00:52', 1, 3, 'пкгх', 'При получении наличными'),
(4, '2025-03-25 12:28:00', 2, 3, 'пкгх1', 'При получении по карте'),
(5, '2025-03-30 17:52:39', 1, 3, 'dddddd', 'При получении наличными'),
(6, '2025-03-30 17:58:07', 1, 3, 'dddddd1', 'При получении по карте'),
(7, '2025-03-30 18:01:26', 1, 3, '111', 'При получении наличными'),
(8, '2025-03-30 18:10:50', 1, 3, 'dddddd11', 'При получении по карте'),
(9, '2025-03-30 18:10:52', 1, 3, 'dddddd11', 'При получении по карте'),
(10, '2025-03-30 18:14:11', 1, 3, '12345', 'При получении по карте'),
(11, '2025-04-02 18:16:07', 1, 3, '567890', 'При получении по карте'),
(12, '2025-03-31 05:45:08', 4, 3, 'Щербаков переулок д 12', 'При получении по карте'),
(13, '2025-04-14 12:11:42', 1, 3, 'как', 'При получении наличными'),
(14, '2025-04-18 10:08:41', 1, 3, 'Щербаков переулок д 12', 'При получении по карте'),
(15, '2025-04-18 10:10:02', 1, 3, 'Щербаков переулок д 12', 'При получении наличными'),
(16, '2025-04-20 14:52:08', 1, 3, 'пкгх', 'При получении наличными'),
(17, '2025-04-20 14:54:43', 1, 3, '123', 'При получении по карте'),
(18, '2025-04-20 15:56:03', 1, 3, 'пкгж', 'При получении наличными'),
(19, '2025-04-20 16:03:48', 1, 9, 'пкшх', 'При получении наличными'),
(20, '2025-04-20 16:03:48', 1, 9, 'пкшх', 'При получении наличными'),
(21, '2025-04-20 16:04:47', 1, 9, 'пкгх', 'При получении по карте'),
(22, '2025-04-20 16:04:47', 1, 9, 'пкгх', 'При получении по карте'),
(23, '2025-04-20 16:07:34', 1, 9, '123', 'При получении по карте'),
(24, '2025-04-20 16:07:34', 1, 9, '123', 'При получении по карте'),
(25, '2025-04-20 16:07:36', 1, 9, '123', 'При получении по карте'),
(26, '2025-04-20 16:08:05', 1, 9, '123', 'При получении наличными'),
(27, '2025-04-20 16:08:05', 1, 9, '123', 'При получении наличными'),
(28, '2025-04-20 16:11:00', 1, 9, 'вчапс', 'При получении наличными'),
(29, '2025-04-20 16:11:00', 1, 9, 'вчапс', 'При получении наличными'),
(30, '2025-04-26 04:37:44', 1, 3, 'Щербаков переулок д 12', 'При получении наличными'),
(31, '2025-04-26 04:37:44', 1, 3, 'Щербаков переулок д 12', 'При получении наличными');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'новый'),
(2, 'подтвержден'),
(3, 'отменен'),
(4, 'доставлен');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `photo`, `name`, `price`, `color`, `date`, `category_id`) VALUES
(1, 'image/6.jpeg', 'Шапка вязанная розовая', 1505, 'Розовый', '2025-03-25 10:16:37', 1),
(2, 'image/9.jpeg', 'Шапка крупной вязки', 1200, 'Серый', '2025-03-25 10:18:40', 1),
(3, 'image/8.jpeg', 'Сумка крупной вязки', 3200, 'Коричневый', '2025-03-25 10:18:40', 3),
(4, 'image/7.jpeg', 'Сумка/косметичка', 2500, 'Бежевый', '2025-03-25 10:19:28', 3),
(5, 'image/HOj35vSus10djf6u4E-BIQ18bCxpvVK8yC6xq1yLX9DGxDMXk5.jpg', 'корзины для дома', 2200, 'Белый', '2025-03-26 12:25:00', 1),
(6, 'image/kW7t3G0ywr30fg6-HncK4oHpIawhbSpWX2oL7RTu_wBg05VY9b.jpeg', 'Мягкая игрушка Олененок', 1750, 'Коричневый', '2025-04-14 12:50:50', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `email`) VALUES
(1, 'nikitosik1@mail.ru'),
(2, 'lizaveta.esina@yandex.ru'),
(3, 'e5inaliz@uandex.ru'),
(4, 'artemspb05@mail.ru'),
(5, 'ilyashvecov05@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `adress` varchar(255) DEFAULT NULL,
  `fio` varchar(255) NOT NULL,
  `favorites` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_admin`, `adress`, `fio`, `favorites`) VALUES
(1, 'admin', '123', '1', 1, '1', '1', ''),
(2, 'lizza', '123', '123@mail.com', 0, NULL, 'Мясников Александр Евгеньевич', '[\"1\"]'),
(3, 'qwerty', '123', 'nikitosik1@mail.ru', 0, NULL, 'Есина Елизавета Дмитриевна', '[\"1\",\"3\",\"2\"]'),
(4, 'kaneva', '123arina', 'kaneca05arina07@gmail.com', 0, NULL, 'Канева Арина Сергеевна', NULL),
(5, 'artem', 'artem', 'artemspb05@mail.ru', 0, NULL, 'Щербаков Артём Сергеевич', NULL),
(6, 'onion', 'onion', 'on@io.n', 0, NULL, 'лук', '[\"1\"]'),
(7, 'Scher', '123', 'a@mail.ru', 0, NULL, 'Щербаков Артём Сергеевич', NULL),
(8, 'wiatrace', '123', '1234@mail.com', 0, NULL, 'Мясников Александр Евгеньевич', NULL),
(9, 'qwerty1', '123', '12345@mail.com', 0, NULL, 'Мясников Александр Евгеньевич', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`order_id`,`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `catergory`
--
ALTER TABLE `catergory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `catergory`
--
ALTER TABLE `catergory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `catergory` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
