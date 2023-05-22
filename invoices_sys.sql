-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2023 at 11:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoices_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `address`, `notes`, `email`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'client-1', '+734543', 'address - 1', NULL, NULL, 1, '2023-03-25 06:44:51', '2023-03-25 06:44:51'),
(2, 'client-2', '+234567', 'address - 2', NULL, NULL, 2, '2023-03-25 06:44:51', '2023-03-25 06:44:51'),
(3, 'client-3', '+09876', 'address - 3', NULL, NULL, 3, '2023-03-25 06:44:51', '2023-03-25 06:44:51'),
(4, 'client-4', '+65432', 'address - 4', NULL, NULL, 4, '2023-03-25 06:44:51', '2023-03-25 06:44:51'),
(5, 'client-5', '+66542', 'address - 4', NULL, NULL, 5, '2023-03-25 06:44:51', '2023-03-25 06:44:51'),
(6, 'client-6', '+222662', 'address - 4', NULL, NULL, 6, '2023-03-25 06:44:51', '2023-03-25 06:44:51'),
(7, 'client-7', '+8765', 'address - 4', NULL, NULL, 7, '2023-03-25 06:44:51', '2023-03-25 06:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `client_invoices`
--

CREATE TABLE `client_invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `client_invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_invoice_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `total_inc_vat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `part_paid_inc_vat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `payment_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_invoices`
--

INSERT INTO `client_invoices` (`id`, `client_invoice_number`, `client_invoice_date`, `due_date`, `section_id`, `client_id`, `total_inc_vat`, `part_paid_inc_vat`, `status`, `note`, `payment_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'C-00000001', '2023-03-25', '2022-07-31', 1, 1, '745.56', '0.00', 4, NULL, '2023-03-21', '2023-03-25 16:29:20', '2023-03-25 15:59:55', '2023-03-25 16:29:20'),
(7, 'C00000007', '2023-03-12', '2022-06-30', 2, 2, '466.26', '0.00', 4, NULL, '2023-03-26', '2023-03-25 16:31:58', '2023-03-25 16:00:16', '2023-03-25 16:31:58'),
(8, 'C-00000001', '2023-03-25', '2023-03-26', 2, 2, '300.96', '300.96', 2, NULL, '2023-03-26', NULL, '2023-03-25 16:35:10', '2023-03-25 17:14:44'),
(9, 'C00000009', '2023-03-05', '2023-03-26', 2, 2, '1470.60', '0.00', 1, NULL, '2023-03-26', NULL, '2023-03-25 17:16:36', '2023-03-25 17:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `client_invoice_attachments`
--

CREATE TABLE `client_invoice_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_invoice_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_invoice_details`
--

CREATE TABLE `client_invoice_details` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `client_invoice_id` bigint UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_status` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_invoice_product`
--

CREATE TABLE `client_invoice_product` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `client_invoice_id` bigint UNSIGNED NOT NULL,
  `qty` bigint UNSIGNED NOT NULL DEFAULT '1',
  `product_price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `total_inc_vat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('unpaid','paid','partially_paid','returned','partially_returned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_invoice_product`
--

INSERT INTO `client_invoice_product` (`id`, `product_id`, `client_invoice_id`, `qty`, `product_price`, `total_inc_vat`, `status`, `created_at`, `updated_at`) VALUES
(21, 5, 8, 3, 34, '116.28', 'unpaid', '2023-03-25 16:35:10', '2023-03-25 16:42:02'),
(22, 6, 8, 3, 54, '184.68', 'partially_returned', '2023-03-25 16:35:10', '2023-03-25 16:45:42'),
(23, 6, 9, 1, 54, '61.56', 'unpaid', '2023-03-25 17:16:36', '2023-03-25 18:01:15'),
(24, 7, 9, 1, 75, '85.50', 'unpaid', '2023-03-25 17:47:09', '2023-03-25 18:01:15'),
(25, 8, 9, 1, 334, '380.76', 'unpaid', '2023-03-25 18:01:15', '2023-03-25 18:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_03_19_142455_create_sections_table', 1),
(6, '2021_03_19_142643_create_suppliers_table', 1),
(7, '2022_03_19_142628_create_clients_table', 1),
(8, '2023_03_19_142448_create_products_table', 1),
(9, '2023_03_19_142512_create_supplier_invoices_table', 1),
(10, '2023_03_19_142519_create_client_invoices_table', 1),
(11, '2023_03_19_142550_create_supplier_invoice_attachments_table', 1),
(12, '2023_03_19_142558_create_supplier_invoice_details_table', 1),
(13, '2023_03_19_142609_create_client_invoice_attachments_table', 1),
(14, '2023_03_19_142616_create_client_invoice_details_table', 1),
(15, '2023_03_19_142824_create_permission_tables', 1),
(16, '2023_03_20_063613_create_client_invoice_product_table', 1),
(17, '2023_03_20_063645_create_product_supplier_invoice_table', 1),
(18, '2023_03_22_100041_create_return_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `store_amount` bigint UNSIGNED NOT NULL,
  `unit` enum('متر','كجم') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `price`, `section_id`, `supplier_id`, `store_amount`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'product-1-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '300.00', 1, 1, 1006, 'متر', '2023-03-25 06:44:56', '2023-03-25 18:16:19'),
(2, 'product-2-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '665.00', 1, 2, 1000, 'كجم', '2023-03-25 06:44:56', '2023-03-25 13:15:24'),
(3, 'product-3-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '654.00', 1, 3, 999, 'متر', '2023-03-25 06:44:56', '2023-03-25 18:16:47'),
(4, 'product-4-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '34.00', 1, 4, 1009, 'كجم', '2023-03-25 06:44:56', '2023-03-25 18:09:37'),
(5, 'product-1-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '33.00', 2, 2, 997, 'متر', '2023-03-25 06:44:56', '2023-03-26 05:48:39'),
(6, 'product-2-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '54.00', 2, 2, 987, 'كجم', '2023-03-25 06:44:56', '2023-03-25 18:01:15'),
(7, 'product-3-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '75.00', 2, 3, 990, NULL, '2023-03-25 06:44:56', '2023-03-25 18:01:15'),
(8, 'product-4-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '334.00', 2, 4, 999, NULL, '2023-03-25 06:44:56', '2023-03-25 18:01:15'),
(9, 'product-1-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '300.00', 3, 1, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(10, 'product-2-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '54.00', 3, 2, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(11, 'product-3-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '33.00', 3, 3, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(12, 'product-4-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '22.00', 3, 4, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(13, 'product-1-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '66.00', 3, 1, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(14, 'product-2-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '876.00', 3, 2, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(15, 'product-3-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '543.00', 3, 3, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(16, 'product-4-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '344.00', 3, 4, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(17, 'product-1-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '654.00', 3, 1, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(18, 'product-2-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '543.00', 3, 2, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(19, 'product-3-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '65.00', 3, 3, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(20, 'product-4-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '7654.00', 3, 4, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(21, 'product-1-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '43.00', 3, 1, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(22, 'product-2-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '43.00', 3, 2, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(23, 'product-3-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '439.00', 3, 3, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(24, 'product-4-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '123.00', 3, 4, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(25, 'product-1-6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '54.00', 3, 1, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(26, 'product-2-6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '788.00', 3, 2, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(27, 'product-3-6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '99.00', 3, 3, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(28, 'product-4-6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '35.00', 3, 4, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(29, 'product-1-7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '370.00', 3, 1, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(30, 'product-2-7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '600.00', 3, 2, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(31, 'product-3-7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '400.00', 3, 3, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(32, 'product-4-7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '200.00', 3, 4, 1000, NULL, '2023-03-25 06:44:56', '2023-03-25 06:44:56'),
(33, 'Noelani Mcdowell', 'فقثبصث', '722.00', 1, 1, 42, 'متر', '2023-03-26 05:31:24', '2023-03-26 05:31:24'),
(34, 'product-1-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '300.00', 1, 1, 1006, 'متر', '2023-03-26 05:44:36', '2023-03-26 05:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_supplier_invoice`
--

CREATE TABLE `product_supplier_invoice` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `supplier_invoice_id` bigint UNSIGNED NOT NULL,
  `qty` bigint UNSIGNED NOT NULL DEFAULT '1',
  `product_price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `total_inc_vat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('unpaid','paid','partially_paid','returned','partially_returned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_supplier_invoice`
--

INSERT INTO `product_supplier_invoice` (`id`, `product_id`, `supplier_invoice_id`, `qty`, `product_price`, `total_inc_vat`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 3, 5, 300, '1710.00', 'partially_returned', '2023-03-25 17:15:56', '2023-03-25 18:16:19'),
(7, 4, 3, 10, 34, '387.60', 'unpaid', '2023-03-25 18:03:44', '2023-03-25 18:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2023-03-25 06:44:53', '2023-03-25 06:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint UNSIGNED NOT NULL,
  `section_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'section-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ahmed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(2, 'section-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'mohhamed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(3, 'section-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ali', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(4, 'section-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'mohammed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(5, 'section-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ahmed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(6, 'section-6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'mohhamed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(7, 'section-7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ali', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(8, 'section-8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'mohammed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(9, 'section-9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ahmed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(10, 'section-10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'mohhamed', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(11, 'section-11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ali', '2023-03-25 06:44:49', '2023-03-25 06:44:49'),
(12, 'section-12', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'mohammed', '2023-03-25 06:44:49', '2023-03-25 06:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `notes`, `email`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'Supp-1', '+734543', 'address - 1', NULL, NULL, 1, '2023-03-25 06:44:50', '2023-03-25 06:44:50'),
(2, 'Supp-2', '+234567', 'address - 2', NULL, NULL, 2, '2023-03-25 06:44:50', '2023-03-25 06:44:50'),
(3, 'Supp-3', '+09876', 'address - 3', NULL, NULL, 3, '2023-03-25 06:44:50', '2023-03-25 06:44:50'),
(4, 'Supp-4', '+65432', 'address - 4', NULL, NULL, 4, '2023-03-25 06:44:50', '2023-03-25 06:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoices`
--

CREATE TABLE `supplier_invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `supplier_invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_invoice_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `total_inc_vat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `part_paid_inc_vat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `payment_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_invoices`
--

INSERT INTO `supplier_invoices` (`id`, `supplier_invoice_number`, `supplier_invoice_date`, `due_date`, `section_id`, `supplier_id`, `total_inc_vat`, `part_paid_inc_vat`, `status`, `note`, `payment_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'S-00000001', '2023-03-25', '2023-03-26', 1, 1, '500.00', '0.00', 1, NULL, '2023-03-26', '2023-03-25 18:12:18', '2023-03-25 09:11:41', '2023-03-25 18:12:18'),
(2, 'S-00000002', '2023-03-25', '2023-03-26', 1, 1, '700.00', '0.00', 1, NULL, '2023-03-26', '2023-03-25 09:25:34', '2023-03-25 09:23:02', '2023-03-25 09:25:34'),
(3, 'S-00000002', '2023-03-13', '2023-05-28', 1, 1, '2097.60', '500.00', 3, NULL, '2023-03-26', NULL, '2023-03-25 17:15:56', '2023-03-25 18:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoice_attachments`
--

CREATE TABLE `supplier_invoice_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_invoice_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoice_details`
--

CREATE TABLE `supplier_invoice_details` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `supplier_invoice_id` bigint UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_status` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `roles_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', NULL, '$2y$10$/DdVHa1xFnILKxTtrf0yFuMz64dZp5.FwxhH/MJRu.A3HDu9zZ20y', NULL, '[\"owner\"]', '1', '2023-03-25 06:44:53', '2023-03-25 06:44:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_phone_unique` (`phone`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD KEY `clients_section_id_foreign` (`section_id`);

--
-- Indexes for table `client_invoices`
--
ALTER TABLE `client_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_invoices_section_id_foreign` (`section_id`),
  ADD KEY `client_invoices_client_id_foreign` (`client_id`);

--
-- Indexes for table `client_invoice_attachments`
--
ALTER TABLE `client_invoice_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_invoice_attachments_client_invoice_id_foreign` (`client_invoice_id`);

--
-- Indexes for table `client_invoice_details`
--
ALTER TABLE `client_invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_invoice_details_section_id_foreign` (`section_id`),
  ADD KEY `client_invoice_details_product_id_foreign` (`product_id`),
  ADD KEY `client_invoice_details_client_invoice_id_foreign` (`client_invoice_id`);

--
-- Indexes for table `client_invoice_product`
--
ALTER TABLE `client_invoice_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_invoice_product_product_id_foreign` (`product_id`),
  ADD KEY `client_invoice_product_client_invoice_id_foreign` (`client_invoice_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_section_id_foreign` (`section_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `product_supplier_invoice`
--
ALTER TABLE `product_supplier_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_supplier_invoice_product_id_foreign` (`product_id`),
  ADD KEY `product_supplier_invoice_supplier_invoice_id_foreign` (`supplier_invoice_id`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_phone_unique` (`phone`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`),
  ADD KEY `suppliers_section_id_foreign` (`section_id`);

--
-- Indexes for table `supplier_invoices`
--
ALTER TABLE `supplier_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_invoices_section_id_foreign` (`section_id`),
  ADD KEY `supplier_invoices_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `supplier_invoice_attachments`
--
ALTER TABLE `supplier_invoice_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_invoice_attachments_supplier_invoice_id_foreign` (`supplier_invoice_id`);

--
-- Indexes for table `supplier_invoice_details`
--
ALTER TABLE `supplier_invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_invoice_details_section_id_foreign` (`section_id`),
  ADD KEY `supplier_invoice_details_product_id_foreign` (`product_id`),
  ADD KEY `supplier_invoice_details_supplier_invoice_id_foreign` (`supplier_invoice_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client_invoices`
--
ALTER TABLE `client_invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_invoice_attachments`
--
ALTER TABLE `client_invoice_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_invoice_details`
--
ALTER TABLE `client_invoice_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_invoice_product`
--
ALTER TABLE `client_invoice_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_supplier_invoice`
--
ALTER TABLE `product_supplier_invoice`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `return_items`
--
ALTER TABLE `return_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier_invoices`
--
ALTER TABLE `supplier_invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier_invoice_attachments`
--
ALTER TABLE `supplier_invoice_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_invoice_details`
--
ALTER TABLE `supplier_invoice_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_invoices`
--
ALTER TABLE `client_invoices`
  ADD CONSTRAINT `client_invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_invoices_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_invoice_attachments`
--
ALTER TABLE `client_invoice_attachments`
  ADD CONSTRAINT `client_invoice_attachments_client_invoice_id_foreign` FOREIGN KEY (`client_invoice_id`) REFERENCES `client_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_invoice_details`
--
ALTER TABLE `client_invoice_details`
  ADD CONSTRAINT `client_invoice_details_client_invoice_id_foreign` FOREIGN KEY (`client_invoice_id`) REFERENCES `client_invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_invoice_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_invoice_details_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_invoice_product`
--
ALTER TABLE `client_invoice_product`
  ADD CONSTRAINT `client_invoice_product_client_invoice_id_foreign` FOREIGN KEY (`client_invoice_id`) REFERENCES `client_invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_invoice_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_supplier_invoice`
--
ALTER TABLE `product_supplier_invoice`
  ADD CONSTRAINT `product_supplier_invoice_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_supplier_invoice_supplier_invoice_id_foreign` FOREIGN KEY (`supplier_invoice_id`) REFERENCES `supplier_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplier_invoices`
--
ALTER TABLE `supplier_invoices`
  ADD CONSTRAINT `supplier_invoices_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplier_invoices_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplier_invoice_attachments`
--
ALTER TABLE `supplier_invoice_attachments`
  ADD CONSTRAINT `supplier_invoice_attachments_supplier_invoice_id_foreign` FOREIGN KEY (`supplier_invoice_id`) REFERENCES `supplier_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplier_invoice_details`
--
ALTER TABLE `supplier_invoice_details`
  ADD CONSTRAINT `supplier_invoice_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplier_invoice_details_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplier_invoice_details_supplier_invoice_id_foreign` FOREIGN KEY (`supplier_invoice_id`) REFERENCES `supplier_invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
