-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 20, 2022 lúc 09:55 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vietpro_k88`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Áo Nam', 0, '2020-10-08 20:08:56', '2020-10-08 20:08:56'),
(2, 'Áo Nữ', 0, '2020-10-08 20:09:16', '2020-10-08 20:09:16'),
(3, 'Áo khoác nam', 1, '2020-10-08 20:10:16', '2020-10-08 20:10:16'),
(4, 'Váy xòe', 2, '2020-10-08 20:41:08', '2020-10-08 20:41:08'),
(5, 'Áo Bò', 3, '2020-10-08 21:37:34', '2020-10-08 21:37:34'),
(6, 'Váy ngắn', 4, '2020-10-15 23:18:25', '2020-10-15 23:18:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `coupon_time` int(50) NOT NULL,
  `coupon_condition` int(11) NOT NULL,
  `coupon_number` int(11) NOT NULL,
  `coupon_code` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_name`, `coupon_time`, `coupon_condition`, `coupon_number`, `coupon_code`) VALUES
(1, 'Giảm giá 20%', 5, 1, 20, 'SALE20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2020_03_19_130302_create_categories_table', 2),
(9, '2020_03_19_130726_create_products_table', 2),
(10, '2020_03_19_131728_create_orders_table', 2),
(11, '2020_03_19_132050_create_order_details_table', 2),
(13, '2020_03_19_133057_edit_avatar_on_order_details_table', 3),
(14, '2020_05_14_122903_create_roles_table', 3),
(15, '2020_05_14_123227_create_user_role_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(15,2) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `shipper_id` bigint(20) DEFAULT NULL,
  `stockkepper_id` bigint(20) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dateAssign` timestamp NULL DEFAULT NULL,
  `dateHandOver` timestamp NULL DEFAULT NULL,
  `dateCollection` timestamp NULL DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `total`, `user_id`, `shipper_id`, `stockkepper_id`, `processed`, `created_at`, `updated_at`, `dateAssign`, `dateHandOver`, `dateCollection`, `coupon_id`) VALUES
(1, 'abccbâbc', 'abc@mail.com', '0202020202', 'hhghghghghghgh', '350000.00', 0, 9, 0, 3, '2020-11-13 21:47:35', '2021-12-23 08:35:28', NULL, '2020-12-01 09:57:05', NULL, 0),
(2, 'abcabcabcabc', 'aaa@mail.com', '6060606060', 'zxcvbnnm', '350000.00', 0, 8, 0, 3, '2020-11-13 21:47:37', '2021-12-23 09:40:35', NULL, '2021-12-08 09:18:35', '2021-12-23 09:40:35', 0),
(3, 'Baro', 'baro@gmail.com', '0904515270', 'Hanoi', '0.00', 0, 1, 0, 1, '2020-11-13 21:47:32', '2021-01-10 01:13:40', NULL, NULL, NULL, 0),
(4, 'Hieu Bui', 'hieubuimedia@gmail.com', '0904515270', 'Hanoi', '600.00', 12, 4, 0, 3, '2020-11-13 21:52:21', '2020-11-13 21:52:21', NULL, NULL, NULL, 0),
(5, 'Hieu Bui', 'hieubuimedia@gmail.com', '0904515270', 'Hanoi', '500.00', 12, 1, 0, 1, '2020-11-13 21:52:22', '2020-07-13 21:52:22', NULL, NULL, NULL, 0),
(6, 'Hieu Bui', 'hieubuimedia@gmail.com', '0904515270', 'Hanoi', '900.00', 12, 9, 0, 1, '2021-03-13 21:55:56', '2020-11-13 21:55:56', NULL, NULL, NULL, 0),
(7, 'Hieu Bui', 'hieubuimedia@gmail.com', '0904515270', 'Hanoi', '2240000.00', 12, 8, 0, 4, '2021-04-13 21:56:56', '2022-02-09 13:49:50', NULL, NULL, '2022-02-09 13:49:50', 0),
(8, 'Hieu Bui', 'hieubuimedia@gmail.com', '0904515270', 'Hanoi', '400000.00', 12, 1, 0, 2, '2021-06-14 06:20:56', '2021-01-10 01:13:04', NULL, NULL, NULL, 0),
(9, 'Baro', 'baro@gmail.com', '0123456789', '1 Dai Co Viet', '680000.00', 12, 4, 0, 0, '2021-07-19 03:26:37', '2021-07-19 03:26:37', NULL, NULL, NULL, 0),
(10, 'Jake', 'jake@gmail.com', '0987654321', '1 Tran Dai Nghia', '1740000.00', 12, 1, 0, 1, '2021-07-19 03:28:59', '2021-07-19 03:46:18', NULL, NULL, NULL, 0),
(11, 'Bùi Ngọc Hiếu', 'hieubui@mail.com', '0904515270', '1 Dai Co Viet', '848000.00', 12, 4, 0, 0, '2021-07-19 14:22:34', '2021-07-19 14:22:34', NULL, NULL, NULL, 0),
(12, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '464000.00', 12, NULL, NULL, 0, '2022-02-13 14:12:51', '2022-02-13 14:12:51', NULL, NULL, NULL, 1),
(13, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '0.00', 12, NULL, NULL, 0, '2022-02-13 14:14:44', '2022-02-13 14:14:44', NULL, NULL, NULL, 1),
(14, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '0.00', 12, NULL, NULL, 0, '2022-02-13 14:15:34', '2022-02-13 14:15:34', NULL, NULL, NULL, 1),
(15, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '580000.00', 12, NULL, NULL, 0, '2022-02-20 08:32:58', '2022-02-20 08:32:58', NULL, NULL, NULL, NULL),
(16, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '1120000.00', 12, NULL, NULL, 0, '2022-02-20 08:35:35', '2022-02-20 08:35:35', NULL, NULL, NULL, NULL),
(17, 'Iu Sờ', 'bun2809@gmail.com', '+84904515270', '1 Đại Cồ Việt', '1120000.00', 12, NULL, NULL, 0, '2022-02-20 08:48:25', '2022-02-20 08:48:25', NULL, NULL, NULL, NULL),
(18, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '896000.00', 12, NULL, NULL, 0, '2022-02-20 08:49:19', '2022-02-20 08:49:19', NULL, NULL, NULL, 1),
(19, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '896000.00', 12, NULL, NULL, 0, '2022-02-20 08:51:28', '2022-02-20 08:51:28', NULL, NULL, NULL, 1),
(20, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', '664000.00', 12, NULL, NULL, 0, '2022-02-20 08:52:18', '2022-02-20 08:52:18', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `quantity` int(10) UNSIGNED NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `sku`, `name`, `price`, `quantity`, `color`, `avatar`, `created_at`, `updated_at`, `brand`) VALUES
(1, 2, 1, 'sku001', NULL, '350000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8b8b3b07b.jpg', NULL, NULL, NULL),
(2, 6, 2, 'sku005', 'Tomas Cuban Shirt', '540000.00', 2, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8b8b3b07b.jpg', NULL, NULL, NULL),
(3, 6, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, NULL),
(4, 6, 4, 'sku007', 'Freedom T-shirt', '480000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8cba35914.jpg', NULL, NULL, NULL),
(5, 7, 2, 'sku005', 'Tomas Cuban Shirt', '540000.00', 2, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8b8b3b07b.jpg', NULL, NULL, NULL),
(6, 7, 4, 'sku007', 'Freedom T-shirt', '480000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8cba35914.jpg', NULL, NULL, NULL),
(7, 7, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, NULL),
(8, 8, 5, 'sku002', 'Áo hình thang', '200000.00', 2, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8da4a851da6.png', NULL, NULL, NULL),
(9, 9, 4, 'sku007', 'Freedom T-shirt', '480000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8cba35914.jpg', NULL, NULL, NULL),
(10, 9, 5, 'sku002', 'Áo hình thang', '200000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8da4a851da6.png', NULL, NULL, NULL),
(11, 10, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 3, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, NULL),
(12, 11, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, NULL),
(13, 11, 4, 'sku007', 'Freedom T-shirt', '480000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8cba35914.jpg', NULL, NULL, NULL),
(19, 7, 7, 'sku0017', 'Áo Nam', '100000.00', 1, NULL, NULL, NULL, NULL, NULL),
(20, 12, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 1, NULL, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, NULL),
(21, 17, 2, 'sku005', 'Tomas Cuban Shirt', '540000.00', 1, 'black', 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8b8b3b07b.jpg', NULL, NULL, 'highway'),
(22, 17, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 1, 'black', 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, 'highway'),
(23, 18, 2, 'sku005', 'Tomas Cuban Shirt', '540000.00', 1, 'black', 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8b8b3b07b.jpg', NULL, NULL, 'highway'),
(24, 18, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 1, 'black', 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, 'highway'),
(25, 19, 2, 'sku005', 'Tomas Cuban Shirt', '540000.00', 1, 'black', 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8b8b3b07b.jpg', NULL, NULL, 'highway'),
(26, 19, 3, 'sku006', 'Diego Cuban Shirt', '580000.00', 1, 'black', 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', NULL, NULL, 'highway'),
(27, 20, 4, 'sku007', 'Freedom T-shirt', '480000.00', 1, 'white', 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8cba35914.jpg', NULL, NULL, 'highway'),
(28, 20, 6, 'sku0078', 'Áo polo', '350000.00', 1, 'black', 'http://127.0.0.1:8000/files/images/products/vietpro_k8861d6690519a0b.jpg', NULL, NULL, 'coolmate');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `quantity`, `price`, `featured`, `avatar`, `description`, `detail`, `color`, `brand`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'Tomas Cuban Shirt', 'sku005', 500, '540000.00', 1, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8b8b3b07b.jpg', 'Áo sơ mi', 'Vải Polyester , Cotton', 'black', 'highway', 1, '2020-10-19 05:50:19', '2020-10-19 05:50:19'),
(3, 'Diego Cuban Shirt', 'sku006', 400, '580000.00', 1, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8c1521a5c.jpg', 'Áo sơ mi', 'Vải Polyester , Cotton', 'black', 'highway', 1, '2020-10-19 05:52:37', '2020-10-19 05:52:37'),
(4, 'Freedom T-shirt', 'sku007', 400, '480000.00', 1, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8d8cba35914.jpg', 'Áo phông', 'Vải Cotton', 'white', 'highway', 1, '2020-10-19 05:55:22', '2020-10-19 05:55:22'),
(5, 'Áo hình thang', 'sku002', 50, '200000.00', 1, 'http://127.0.0.1:8000/files/images/products/vietpro_k885f8da4a851da6.png', 'Màu trắng', 'Vải đũi', 'white', 'zara', 2, '2020-10-19 07:37:28', '2020-10-19 07:37:28'),
(6, 'Áo polo', 'sku0078', 150, '350000.00', 1, 'http://127.0.0.1:8000/files/images/products/vietpro_k8861d6690519a0b.jpg', 'Vải tre siêu thoáng mát', 'Áo khử mùi siêu chất', 'black', 'coolmate', 1, '2022-01-06 03:59:01', '2022-01-06 03:59:01'),
(7, 'Áo Nam', 'sku0017', 12, '100000.00', 0, NULL, NULL, NULL, 'đỏ', 'highway', 1, '2022-01-18 15:58:15', '2022-01-18 15:58:15'),
(8, 'Áo Nam', 'sku001345', 123, '1231243.00', 0, NULL, NULL, NULL, 'đỏ', 'highway', 3, '2022-01-27 13:27:10', '2022-01-27 13:27:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2020-05-14 05:50:28', '2020-05-14 05:50:28'),
(2, 'Mod', '2020-05-14 05:57:07', '2020-05-14 05:57:07'),
(3, 'Editor', '2020-05-14 05:57:12', '2020-05-14 05:57:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shippers`
--

CREATE TABLE `shippers` (
  `id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `shippers`
--

INSERT INTO `shippers` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Baro Kiteer', 'barok@mail.com', '0123123', 'HN', NULL, '2020-03-24 06:24:58', '2020-03-24 06:24:58'),
(4, 'Leoot', 'leo@mail.com', '0904515270', '24 ngõ TP', NULL, NULL, '2020-10-16 21:12:05'),
(8, 'Baro', 'baro@gmail.com', NULL, NULL, NULL, '2020-05-26 05:55:27', '2020-05-26 05:55:27'),
(9, 'Hieu Bui', 'hieubui@mail.com', '0904515270', 'Hanoi Vietnam', NULL, '2020-10-19 06:54:05', '2020-10-19 06:54:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Baro Kiteer', 'barok@mail.com', '0123123', 'HN', NULL, '123123123', 4, NULL, '2020-03-24 06:24:58', '2020-03-24 06:24:58'),
(4, 'Leoot', 'leo@mail.com', '0904515270', '24 ngõ TP', NULL, '123456', 4, NULL, NULL, '2020-10-16 21:12:05'),
(9, 'Hieu Bui', 'hieubui@mail.com', '0904515270', 'Hanoi Vietnam', NULL, '$2y$10$hhVetGU1RMDenPDgS78kDeUIoHHRx.f9JX8reFeF6DUkzz70QIyBS', 2, NULL, '2020-10-19 06:54:05', '2020-10-19 06:54:05'),
(10, 'Hieu Bui', 'hieubui1@mail.com', '0904515270', 'Hanoi Vietnam', NULL, '$2y$10$gQPblpf544p3dY8.IPG6EOO1C/GGUipl5YXqeLqLvWm0rLc0YW/H6', 4, NULL, '2022-01-02 03:50:54', '2022-01-02 03:50:54'),
(11, 'Át Min', 'admin@mail.com', '+84904515270', '1 Đại Cồ Việt', NULL, '$2y$10$ZhbINI3PQ3yp3Q2zCwYgpOVEV7YSmEMNpPM1cXkPoM5Yf37cQY.bG', 2, NULL, '2022-01-06 04:05:30', '2022-01-06 04:05:30'),
(12, 'Iu Sờ', 'user@mail.com', '+84904515270', '1 Đại Cồ Việt', NULL, '$2y$10$xSXpJe.uEaRlHYb9ZtPdsuxRITsJqwzXlWwU16GHFyMZRDXrI6l4u', 4, NULL, '2022-01-06 04:06:03', '2022-01-06 04:06:03'),
(13, 'Kíp Pờ', 'keeper@mail.com', '+84904515270', '1 Đại Cồ Việt', NULL, '$2y$10$Pcgb/ElktCamh/JRjsnA2O0i3gBgzEO/s0vKPPAe6evlc9JCLcgo.', 3, NULL, '2022-01-06 04:06:48', '2022-01-06 04:06:48'),
(14, 'Su Pờ Át Min', 'superadmin@mail.com', '+84904515270', '1 Đại Cồ Việt', NULL, '$2y$10$OPQRq3ViTeqiBSpvocb70uOs0jjB/bH4aEF7fZlMt5CpN6AFYrGjy', 1, NULL, '2022-01-06 04:26:09', '2022-01-06 04:26:09'),
(15, 'Thủ Kho', 'thukho@mail.com', '+84904515270', '1 dai co viet', NULL, '$2y$10$8fFjhYexJOAJISSiphklN.jFXi/.fZSypAg.LLVlQB8hc0hwqIa2W', 3, NULL, '2022-01-14 04:50:50', '2022-01-14 04:50:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_role`
--

CREATE TABLE `user_role` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, NULL),
(1, 3, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
