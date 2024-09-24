-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 11:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quick_spear`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `name`, `phone`, `city`, `region`, `desc`, `user_id`, `admin_id`, `created_at`, `updated_at`, `type`) VALUES
(20, 'Yeo Combs', '1234567893', '1', 'Et aut obcaecati ame', 'Exercitation fugiat', NULL, 1, '2024-04-13 16:42:54', '2024-04-13 16:42:54', 0),
(21, 'Francis Tanner', '3216549873', '2', 'Laboris et in nulla', 'Eos ut consequuntur', NULL, 1, '2024-04-26 12:44:52', '2024-04-26 12:44:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `dark` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `dark`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Quickspear', 'Quickspear', '0798711008', '2024-02-01 22:17:49', '$2y$12$L7mYEAEjo/m2La4M9u0YDOwQYMQvgGdhkpcau1zKJt/WKQLjCKb5y', '0', NULL, '2024-02-01 22:17:49', '2024-07-08 10:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `delegate_id` bigint(20) UNSIGNED NOT NULL,
  `consignee_name` varchar(255) DEFAULT NULL,
  `consignee_phone` varchar(255) NOT NULL,
  `consignee_city` bigint(20) UNSIGNED NOT NULL,
  `consignee_region` bigint(20) UNSIGNED NOT NULL,
  `order_price` decimal(8,2) NOT NULL,
  `value_on_delivery` decimal(8,3) NOT NULL DEFAULT 0.000,
  `customer_delivery_price` decimal(8,2) NOT NULL,
  `customer_notes` text DEFAULT NULL,
  `delegate_notes` text DEFAULT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `shipment_status_id` bigint(20) UNSIGNED NOT NULL,
  `deportation_group_id` bigint(20) UNSIGNED NOT NULL,
  `bill_tracking_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `shop_id`, `delegate_id`, `consignee_name`, `consignee_phone`, `consignee_city`, `consignee_region`, `order_price`, `value_on_delivery`, `customer_delivery_price`, `customer_notes`, `delegate_notes`, `is_returned`, `shipment_status_id`, `deportation_group_id`, `bill_tracking_id`, `created_at`, `updated_at`) VALUES
(1, 7, 24, 'Nathaniel Rush', '6549873216', 8, 10, '212.00', '0.000', '2.00', 'Quia irure non aut v', 'Dolore laborum Recu', 0, 4, 1, 9, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(2, 7, 24, 'Nita Branch', '9518476235', 5, 4, '205.00', '205.000', '3.00', 'Veritatis velit maxi', 'Ut sint libero magna', 0, 3, 1, 9, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(3, 7, 24, 'alaa', '0938258963', 6, 5, '20.00', '20.000', '2.00', NULL, 'Fuga Enim velit au', 1, 3, 1, 9, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(4, 7, 24, 'Guinevere Young', '1346794625', 5, 9, '80.00', '0.000', '3.00', 'Aliquid voluptatem r', NULL, 1, 8, 1, 9, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(5, 7, 24, 'حمد', '1034567896', 5, 8, '50.00', '50.000', '3.00', NULL, NULL, 0, 3, 1, 9, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(6, 8, 24, 'aaaaaaaa', '1234567896', 5, 4, '15.00', '1.500', '6.00', 'no comments', 'bbb', 1, 5, 1, 10, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(7, 8, 24, 'Serina Waters', '1236549875', 5, 4, '427.00', '427.000', '6.00', 'Qui esse et qui ear', NULL, 0, 5, 1, 10, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(8, 8, 24, 'Claudia Weeks', '3216549870', 5, 4, '376.00', '376.000', '6.00', 'Id ullamco ut adipis', NULL, 0, 3, 1, 10, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(9, 4, 24, 'محمد', '1236048972', 5, 8, '30.00', '30.000', '6.00', NULL, NULL, 0, 3, 1, 11, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(10, 4, 24, 'مصطفى', '1234560096', 6, 5, '10.00', '10.000', '1.00', NULL, NULL, 0, 3, 1, 11, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(11, 4, 24, 'أبو صطيف', '1202567896', 5, 4, '12.00', '12.000', '2.00', NULL, NULL, 0, 3, 1, 11, '2024-09-24 20:50:24', '2024-09-24 20:50:24'),
(12, 7, 27, NULL, '2316549874', 5, 6, '10.00', '10.000', '3.00', 'Suscipit et corporis', NULL, 0, 3, 1, 9, '2024-09-24 20:51:03', '2024-09-24 20:51:03'),
(13, 4, 27, 'أحمد', '1234567896', 5, 7, '20.00', '20.000', '6.00', NULL, NULL, 0, 3, 1, 11, '2024-09-24 20:51:03', '2024-09-24 20:51:03'),
(14, 4, 25, 'Herman Mcdonald', '1234567896', 5, 4, '25.00', '25.000', '2.00', 'Excepteur repudianda', 'In eius est et dign', 0, 3, 1, 11, '2024-09-24 20:52:21', '2024-09-24 20:52:21'),
(15, 4, 25, NULL, '3211475555', 5, 8, '30.00', '30.000', '6.00', NULL, NULL, 1, 3, 1, 11, '2024-09-24 20:52:22', '2024-09-24 20:52:22'),
(16, 7, 25, 'Dolan Vazquez', '9517538526', 5, 4, '660.00', '0.000', '3.00', 'Eiusmod sit repudia', 'Architecto quibusdam', 0, 4, 1, 9, '2024-09-24 20:52:22', '2024-09-24 20:52:22'),
(17, 7, 25, 'Orlando Dean', '1034567896', 5, 4, '20.00', '0.000', '3.00', NULL, NULL, 0, 8, 1, 9, '2024-09-24 20:52:22', '2024-09-24 20:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `bills_tracking`
--

CREATE TABLE `bills_tracking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `bill_number` varchar(255) NOT NULL,
  `bill_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bill_status_id` bigint(20) UNSIGNED NOT NULL,
  `deportation_group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills_tracking`
--

INSERT INTO `bills_tracking` (`id`, `shop_id`, `bill_number`, `bill_date`, `bill_status_id`, `deportation_group_id`, `created_at`, `updated_at`) VALUES
(9, 7, 'BILL-7B1', '2024-09-24 20:52:22', 1, 1, '2024-09-24 20:50:24', '2024-09-24 20:52:22'),
(10, 8, 'BILL-8B1', '2024-09-24 20:52:22', 1, 1, '2024-09-24 20:50:24', '2024-09-24 20:52:22'),
(11, 4, 'BILL-4B1', '2024-09-24 20:52:22', 1, 1, '2024-09-24 20:50:24', '2024-09-24 20:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `bill_statuses`
--

CREATE TABLE `bill_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_statuses`
--

INSERT INTO `bill_statuses` (`id`, `name`) VALUES
(3, 'Canceled'),
(2, 'Payment Made'),
(4, 'Pending'),
(1, 'Under Review');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `territory_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `territory_id`) VALUES
(5, 'عمان', 2),
(6, 'السلط', 2),
(7, 'مادبا', 2),
(8, 'الزرقاء', 2),
(9, 'المفرق', 1),
(10, 'الرمثا', 1),
(11, 'اربد', 1),
(12, 'عجلون', 1),
(13, 'جرش', 1),
(14, 'الشونه الشماليه', 1),
(15, 'الشونه الجنوبيه', 3),
(16, 'العقبه', 3),
(17, 'معان', 3),
(18, 'الطفيله', 3),
(19, 'الكرك', 3),
(20, 'الشوبك', 3);

-- --------------------------------------------------------

--
-- Table structure for table `city_delegate`
--

CREATE TABLE `city_delegate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `delegate_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_delegate`
--

INSERT INTO `city_delegate` (`id`, `city_id`, `delegate_id`, `price`, `created_at`, `updated_at`) VALUES
(46, 6, 26, '2.000', '2024-07-21 10:41:14', '2024-07-21 10:41:14'),
(49, 6, 24, '1.520', '2024-07-29 16:53:15', '2024-07-29 16:57:01'),
(50, 5, 24, '2.000', '2024-07-29 16:53:15', '2024-07-29 16:57:01'),
(51, 8, 25, '3.000', '2024-07-29 16:54:50', '2024-07-29 16:54:50'),
(52, 8, 24, '1.000', '2024-07-29 16:57:02', '2024-07-29 16:57:02'),
(53, 5, 27, '1.000', '2024-07-29 16:57:49', '2024-07-29 16:57:49'),
(54, 6, 27, '2.000', '2024-07-29 16:57:49', '2024-07-29 16:57:49'),
(55, 8, 27, '8.000', '2024-07-29 16:57:49', '2024-07-29 16:57:49'),
(56, 9, 28, '3.000', '2024-07-30 16:44:23', '2024-07-30 16:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `AccountNumber` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `AccountPin` varchar(255) NOT NULL,
  `AccountEntity` varchar(255) NOT NULL DEFAULT 'AMM',
  `AccountCountryCode` varchar(255) NOT NULL DEFAULT 'JO',
  `Version` varchar(255) NOT NULL DEFAULT 'v1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delegates`
--

CREATE TABLE `delegates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delegates`
--

INSERT INTO `delegates` (`id`, `name`, `phone`, `created_at`, `updated_at`) VALUES
(24, 'Gavin Buck', '0778974561', '2024-07-19 06:23:09', '2024-07-19 06:23:09'),
(25, 'Aubrey Lang', '0778970561', '2024-07-20 10:11:56', '2024-07-20 10:11:56'),
(26, 'Essa', '0778974501', '2024-07-21 10:41:14', '2024-07-21 10:41:14'),
(27, 'Eugenia Marshall', '0784567893', '2024-07-29 16:57:49', '2024-07-29 16:57:49'),
(28, 'Halee Norris', '0770004561', '2024-07-30 16:44:22', '2024-07-30 16:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_prices`
--

CREATE TABLE `delivery_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `location_type` varchar(255) NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_prices`
--

INSERT INTO `delivery_prices` (`id`, `shop_id`, `location_type`, `location_id`, `price`, `created_at`, `updated_at`) VALUES
(5, 8, 'App\\Models\\City', 5, '2.75', '2024-07-21 12:04:51', '2024-07-21 12:05:25'),
(7, 8, 'App\\Models\\City', 6, '1.00', '2024-07-22 08:37:57', '2024-07-22 08:37:57'),
(8, 8, 'App\\Models\\Region', 4, '6.00', NULL, NULL),
(9, 8, 'App\\Models\\Region', 6, '6.00', NULL, NULL),
(11, 4, 'App\\Models\\Region', 4, '2.00', NULL, NULL),
(13, 7, 'App\\Models\\City', 8, '2.00', NULL, NULL),
(14, 4, 'App\\Models\\City', 5, '6.00', NULL, NULL),
(15, 7, 'App\\Models\\City', 5, '3.00', NULL, NULL),
(16, 7, 'App\\Models\\City', 6, '2.00', NULL, NULL),
(17, 4, 'App\\Models\\City', 6, '1.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_deportation_logs`
--

CREATE TABLE `last_deportation_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_deporation_time` timestamp NULL DEFAULT NULL,
  `current_deportation_group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `last_deportation_logs`
--

INSERT INTO `last_deportation_logs` (`id`, `last_deporation_time`, `current_deportation_group_id`, `created_at`, `updated_at`) VALUES
(1, '2024-09-24 20:52:22', 2, '2024-09-20 09:50:21', '2024-09-24 20:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_29_075832_create_admins_table', 1),
(6, '2022_05_10_112053_create_addresses_table', 1),
(8, '2022_05_10_213727_create_shipments_table', 1),
(9, '2022_05_10_214259_create_shipment_rates_table', 1),
(10, '2022_05_10_214355_create_payment_methods_table', 1),
(11, '2022_05_10_214438_create_edit_orders_table', 1),
(12, '2022_05_19_183419_create_settings_table', 1),
(13, '2022_05_24_182922_create_transactions_table', 1),
(14, '2022_05_24_182923_add_photo_payment_requests_table', 1),
(15, '2022_05_24_182923_create_payment_requests_table', 1),
(16, '2022_05_24_185604_create_shipment_imports_table', 1),
(17, '2022_06_14_115242_create_team_members_table', 1),
(18, '2022_06_24_222358_create_documents_table', 1),
(19, '2022_06_24_223230_create_companies_table', 1),
(20, '2022_07_04_221834_create_contact_expresses_table', 1),
(21, '2022_07_13_180805_add_status_to_shipments', 1),
(22, '2022_07_13_180805_create_pickups_table', 1),
(23, '2022_07_14_180805_add_user_id_to_pickups', 1),
(24, '2022_09_01_142658_create_notifications_table', 1),
(25, '2022_10_13_180805_add_type_to_addresses', 1),
(26, '2022_12_02_033735_create_jobs_table', 1),
(27, '2024_04_19_115306_create_delegates_table', 2),
(28, '2024_04_19_115307_create_delegates_table', 3),
(29, '2024_04_19_115309_create_delegates_table', 4),
(34, '2024_04_23_200950_create_city_delegate_table', 6),
(35, '2024_06_25_082334_create_shipment_statuses_table', 7),
(36, '2024_06_28_081434_create_territories_table', 8),
(37, '2022_05_10_213537_create_cities_table', 9),
(38, '2024_06_28_083357_create_regions_table', 10),
(40, '2024_07_07_084222_create_delivery_prices_table', 11),
(41, '2024_05_15_112555_create_shops_table', 12),
(47, '2024_08_24_120914_create_bill_statuses_table', 14),
(54, '2024_09_19_222125_create_deportation_logs_table', 19),
(60, '2024_09_20_120139_create_last_deportation_logs_table', 20),
(62, '2024_08_25_191754_create_bills_table', 22),
(64, '2024_07_06_122804_create_bills_tracking_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID_id` bigint(20) UNSIGNED NOT NULL,
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID_id`, `id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'fea51c5f-2a76-4ece-b65e-5474423123fa', 'App\\Notifications\\NewUserNotification', 'App\\Models\\Admin', 1, '{\"user_id\":1,\"body\":\"\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f : AHMAD ALAILA\",\"link\":\"https:\\/\\/quickspear.metafortech.com\\/superAdmin\\/admin\\/dashboard\\/users\\/1\"}', '2024-02-01 22:27:08', '2024-02-01 22:21:10', '2024-02-01 22:27:08'),
(2, '86d3d737-8f6b-47c2-820e-b17a59c87988', 'App\\Notifications\\NewUserNotification', 'App\\Models\\Admin', 1, '{\"user_id\":2,\"body\":\"\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f : \\u0645\\u062d\\u0645\\u062f \\u0627\\u0644\\u0634\\u0627\\u0648\\u064a\\u0634\",\"link\":\"https:\\/\\/quickspear.metafortech.com\\/superAdmin\\/admin\\/dashboard\\/users\\/2\"}', '2024-02-02 00:08:20', '2024-02-02 00:07:11', '2024-02-02 00:08:20'),
(3, '0b11994e-2fb2-463e-a94b-fda473a3a5d7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\Admin', 1, '{\"user_id\":3,\"body\":\"\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f : \\u0627\\u062e\\u062a\\u0628\\u0627\\u0631\\u0648\\u062a\",\"link\":\"https:\\/\\/quickspeardelivery.com\\/superAdmin\\/admin\\/dashboard\\/users\\/3\"}', '2024-02-10 13:22:55', '2024-02-10 16:09:23', '2024-02-10 13:22:55'),
(4, 'd0f58494-2fe1-4480-ab55-fe1d9ebefeb4', 'App\\Notifications\\NewUserNotification', 'App\\Models\\Admin', 1, '{\"user_id\":4,\"body\":\"\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f : Casey Mayo\",\"link\":\"http:\\/\\/localhost:8000\\/superAdmin\\/admin\\/dashboard\\/users\\/4\"}', '2024-02-10 13:22:55', '2024-02-10 10:55:26', '2024-02-10 13:22:55'),
(5, 'b35b9d02-5cd5-47a7-bf8a-d42dd1dac1a1', 'App\\Notifications\\OrderNotification', 'App\\Models\\Admin', 1, '{\"user_id\":4,\"type\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0634\\u062d\\u0646\\u0629\",\"shipment_id\":\"1\",\"body\":\"\\u0627\\u064a \\u0648\\u0627\\u0644\\u0644\\u0647\"}', '2024-02-10 13:24:21', '2024-02-10 13:24:19', '2024-02-10 13:24:21'),
(6, '1665e7a7-754f-489b-81ce-121876906626', 'App\\Notifications\\OrderNotification', 'App\\Models\\Admin', 1, '{\"user_id\":4,\"type\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0634\\u062d\\u0646\\u0629\",\"shipment_id\":\"9\",\"body\":\"a\"}', '2024-02-14 17:32:40', '2024-02-14 12:40:01', '2024-02-14 17:32:40'),
(7, '733abcbc-4651-4825-beef-d5038eaa6016', 'App\\Notifications\\NewUserNotification', 'App\\Models\\Admin', 1, '{\"user_id\":5,\"body\":\"\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f : \\u0627\\u0628\\u0631\\u0627\\u0647\\u064a\\u0645 \\u0645\\u0635\\u0637\\u0641\\u0649\",\"link\":\"http:\\/\\/localhost:8000\\/superAdmin\\/admin\\/dashboard\\/users\\/5\"}', '2024-03-02 15:39:16', '2024-03-02 15:38:20', '2024-03-02 15:39:16'),
(8, '4a1204aa-de6a-43c6-9bf7-b4674fae7724', 'App\\Notifications\\NewUserNotification', 'App\\Models\\Admin', 1, '{\"user_id\":6,\"body\":\"\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f : testaaaaa\",\"link\":\"http:\\/\\/localhost:8000\\/superAdmin\\/admin\\/dashboard\\/users\\/6\"}', '2024-04-01 04:34:11', '2024-04-01 04:04:56', '2024-04-01 04:34:11'),
(9, 'd9e08a2d-16a9-4ede-ba92-f82a463cc59e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\Admin', 1, '{\"user_id\":15,\"body\":\"\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f : Ahmad Mohammad\",\"link\":\"http:\\/\\/localhost:8000\\/superAdmin\\/admin\\/dashboard\\/users\\/15\"}', '2024-05-18 13:58:27', '2024-05-18 13:43:00', '2024-05-18 13:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `city_id`) VALUES
(4, 'جبل طارق', 5),
(5, 'تدمر', 6),
(6, 'المنطقة الصناعية', 5),
(7, 'الضفة', 5),
(8, 'م1', 5),
(9, 'م2', 5),
(10, 'زرقاوي', 8),
(11, 'tmpoo', 11);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `website_name` varchar(255) NOT NULL,
  `website_logo` varchar(255) NOT NULL,
  `website_email` varchar(255) NOT NULL,
  `first_char_account_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `website_name`, `website_logo`, `website_email`, `first_char_account_number`, `created_at`, `updated_at`) VALUES
(1, 'Quick Spear for Delivery', 'images/logo/MJ3VXtGwuDlxZrq0pAmd1bJDe4FBNu7XfKGEWItP.png', 'info@donmin.com', 'QS', '2024-02-01 21:37:11', '2024-02-01 23:49:45'),
(2, 'none', 'none', 'none', 'none', '2024-02-01 23:34:13', '2024-02-01 23:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `delegate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `consignee_name` varchar(255) DEFAULT NULL,
  `consignee_phone` varchar(255) NOT NULL,
  `consignee_phone_2` varchar(255) DEFAULT NULL,
  `consignee_city` bigint(20) UNSIGNED NOT NULL,
  `consignee_region` bigint(20) UNSIGNED NOT NULL,
  `consignee_zip_code` varchar(255) DEFAULT NULL,
  `shipping_date_time` timestamp NULL DEFAULT NULL,
  `accepted_by_admin_at` timestamp NULL DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `order_price` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value_on_delivery` decimal(8,3) DEFAULT 0.000,
  `customer_notes` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delegate_notes` text DEFAULT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `is_deported` tinyint(1) NOT NULL DEFAULT 0,
  `deported_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipment_status_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `shop_id`, `delegate_id`, `consignee_name`, `consignee_phone`, `consignee_phone_2`, `consignee_city`, `consignee_region`, `consignee_zip_code`, `shipping_date_time`, `accepted_by_admin_at`, `due_date`, `order_price`, `value_on_delivery`, `customer_notes`, `delegate_notes`, `is_returned`, `is_deported`, `deported_at`, `created_at`, `updated_at`, `shipment_status_id`) VALUES
(15, 4, 25, 'Herman Mcdonald', '1234567896', '68', 5, 4, NULL, '2024-07-20 10:27:11', NULL, '2024-07-23 13:12:11', '25', '25.000', 'Excepteur repudianda', 'In eius est et dign', 0, 1, NULL, '2024-07-20 10:12:11', '2024-09-24 20:52:21', 3),
(16, 7, 25, 'Dolan Vazquez', '9517538526', '66', 5, 4, NULL, '2024-07-20 10:49:28', NULL, '2024-07-23 13:49:28', '660', '0.000', 'Eiusmod sit repudia', 'Architecto quibusdam', 0, 1, NULL, '2024-07-20 10:49:28', '2024-09-24 20:52:22', 4),
(17, 7, 24, 'Nathaniel Rush', '6549873216', '98', 8, 10, NULL, '2024-07-20 10:50:37', NULL, '2024-07-23 13:50:37', '212', '0.000', 'Quia irure non aut v', 'Dolore laborum Recu', 0, 1, NULL, '2024-07-20 10:50:37', '2024-09-24 20:50:24', 4),
(18, 8, 24, 'aaaaaaaa', '1234567896', '44', 5, 4, NULL, '2024-07-20 13:13:50', '2024-07-20 13:12:57', NULL, '15', '1.500', 'no comments', 'bbb', 1, 1, NULL, '2024-07-20 13:04:36', '2024-09-24 20:50:24', 5),
(21, 7, 25, 'Orlando Dean', '1034567896', NULL, 5, 4, NULL, NULL, NULL, NULL, '20', '0.000', NULL, NULL, 0, 1, NULL, '2024-07-20 14:14:33', '2024-09-24 20:52:22', 8),
(22, 7, 24, 'Odessa Wells', '3216548523', '29', 5, 4, NULL, NULL, NULL, NULL, '12.75', '0.000', 'Id voluptates est n', 'Omnis expedita place', 1, 0, NULL, '2024-07-20 14:32:26', '2024-09-24 21:08:07', 8),
(23, 7, 24, 'Nita Branch', '9518476235', '44', 5, 4, NULL, NULL, NULL, NULL, '205', '205.000', 'Veritatis velit maxi', 'Ut sint libero magna', 0, 1, NULL, '2024-07-21 09:08:15', '2024-09-24 20:50:24', 3),
(24, 8, 24, 'Serina Waters', '1236549875', '15', 5, 4, NULL, NULL, NULL, NULL, '427', '427.000', 'Qui esse et qui ear', NULL, 0, 1, NULL, '2024-07-21 09:20:22', '2024-09-24 20:50:24', 5),
(25, 8, 24, 'Claudia Weeks', '3216549870', '27', 5, 4, NULL, NULL, NULL, NULL, '376', '376.000', 'Id ullamco ut adipis', NULL, 0, 1, NULL, '2024-07-21 09:23:28', '2024-09-24 20:50:24', 3),
(27, 7, 24, 'alaa', '0938258963', NULL, 6, 5, NULL, NULL, NULL, NULL, '20', '20.000', NULL, 'Fuga Enim velit au', 1, 1, NULL, '2024-07-21 10:04:36', '2024-09-24 20:50:24', 3),
(28, 4, 25, NULL, '3211475555', NULL, 5, 8, NULL, NULL, NULL, NULL, '30', '30.000', NULL, NULL, 1, 1, NULL, '2024-07-27 06:45:51', '2024-09-24 20:52:22', 3),
(29, 7, 24, 'Guinevere Young', '1346794625', '95', 5, 9, NULL, NULL, NULL, NULL, '80', '0.000', 'Aliquid voluptatem r', NULL, 1, 1, NULL, '2024-07-30 16:55:42', '2024-09-24 20:50:24', 8),
(30, 7, 27, NULL, '2316549874', '56', 5, 6, NULL, NULL, NULL, NULL, '10', '10.000', 'Suscipit et corporis', NULL, 0, 1, NULL, '2024-09-03 13:54:03', '2024-09-24 20:51:03', 3),
(31, 4, 27, 'أحمد', '1234567896', NULL, 5, 7, NULL, NULL, NULL, NULL, '20', '20.000', NULL, NULL, 0, 1, NULL, '2024-09-20 12:27:18', '2024-09-24 20:51:03', 3),
(32, 4, 24, 'محمد', '1236048972', NULL, 5, 8, NULL, NULL, NULL, NULL, '30', '30.000', NULL, NULL, 0, 1, NULL, '2024-09-20 12:27:48', '2024-09-24 20:50:24', 3),
(33, 7, 24, 'حمد', '1034567896', NULL, 5, 8, NULL, NULL, NULL, NULL, '50', '50.000', NULL, NULL, 0, 1, NULL, '2024-09-20 12:30:40', '2024-09-24 20:50:24', 3),
(34, 4, 24, 'مصطفى', '1234560096', NULL, 6, 5, NULL, NULL, NULL, NULL, '10', '10.000', NULL, NULL, 0, 1, NULL, '2024-09-20 14:14:47', '2024-09-24 20:50:24', 3),
(35, 4, 24, 'أبو صطيف', '1202567896', NULL, 5, 4, NULL, NULL, NULL, NULL, '12', '12.000', NULL, NULL, 0, 1, NULL, '2024-09-20 14:36:12', '2024-09-24 20:50:24', 3),
(36, 4, 24, 'Cody Pugh', '2316549875', '1', 5, 4, NULL, NULL, NULL, NULL, '9', '0.000', 'Harum vel voluptatum', NULL, 1, 0, NULL, '2024-09-24 20:53:13', '2024-09-24 21:08:14', 8);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_imports`
--

CREATE TABLE `shipment_imports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `AWB` varchar(255) NOT NULL,
  `CODValue` varchar(255) NOT NULL,
  `ShipperNumber` varchar(255) DEFAULT NULL,
  `ShipperReference` varchar(255) DEFAULT NULL,
  `ShipperReference2` varchar(255) DEFAULT NULL,
  `ShipperName` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_rates`
--

CREATE TABLE `shipment_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_from` bigint(20) UNSIGNED NOT NULL,
  `city_to` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_rates`
--

INSERT INTO `shipment_rates` (`id`, `city_from`, `city_to`, `user_id`, `rate`, `created_at`, `updated_at`) VALUES
(5, 3, 2, 0, 10, '2024-03-30 04:09:12', '2024-03-30 04:09:12'),
(6, 3, 2, 0, 20, '2024-03-30 04:09:31', '2024-03-30 04:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_statuses`
--

CREATE TABLE `shipment_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_statuses`
--

INSERT INTO `shipment_statuses` (`id`, `name`) VALUES
(8, 'Canceled'),
(3, 'Delivered'),
(7, 'No Response'),
(6, 'Postponed'),
(5, 'Rejected With Pay'),
(4, 'Rejected Without Pay'),
(2, 'Under Delivery'),
(1, 'Under Review');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `region` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `user_id`, `name`, `city_id`, `region`, `description`, `created_at`, `updated_at`) VALUES
(4, 17, 'pink she in jo', 5, 'طبربور', 'حي الاتراك _ خلف مدارس المنار', '2024-07-18 00:32:11', '2024-07-18 00:32:11'),
(7, 20, 'Raja Patterson', 11, 'Consequatur nulla r', 'Aut rerum qui sunt e', '2024-07-20 10:48:50', '2024-07-20 10:48:50'),
(8, 21, 'Emerson Merritt', 19, 'Aut quis nisi rerum', 'Perspiciatis ea qui', '2024-07-20 11:00:20', '2024-07-20 11:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `territories`
--

CREATE TABLE `territories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `territories`
--

INSERT INTO `territories` (`id`, `name`) VALUES
(3, 'إقليم الجنوب'),
(1, 'إقليم الشمال'),
(2, 'إقليم الوسط');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` double NOT NULL,
  `notes` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `codeVerfiy` int(11) DEFAULT NULL,
  `codeForget` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `account_number`, `email_verified_at`, `password`, `status`, `codeVerfiy`, `codeForget`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'بتول ابو ليلى', 'www.0792841453@yahoo', '0792841453', '503', NULL, '$2y$10$/yRLdOOVkLykuFZtEJylae41Rn/iRinCOvwXrQZ5qUymlUfh5k0pS', 0, NULL, NULL, NULL, '2024-07-18 03:32:11', '2024-07-18 03:32:11'),
(20, 'Noah Parrish', 'racyfy@mailinator.com', '0784567893', '108', NULL, '$2y$10$8a3skhztf8eHNPkrOHbPWObBykMLhH00HxFt/z95k5RJFoBVxSvXy', 0, NULL, NULL, NULL, '2024-07-20 10:48:50', '2024-07-20 10:48:50'),
(21, 'Harlan Mcconnell', 'ibrahim@gmail.com', '0791234567', '402', NULL, '$2y$10$kUkzF/SS1KdW0cyuJ5JVyetPXM3UFOxtdlC52hAyZfhdEbdkelazS', 0, NULL, NULL, 'DUw9iau4o7pHm8Mkrvu473zyQ4qdrr0GNZn3BpK7h40a8Hkt8pGCWmrXlqfi', '2024-07-20 11:00:20', '2024-07-20 11:00:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_consignee_city_foreign` (`consignee_city`),
  ADD KEY `bills_consignee_region_foreign` (`consignee_region`),
  ADD KEY `bills_delegate_id_foreign` (`delegate_id`),
  ADD KEY `bills_shop_id_foreign` (`shop_id`),
  ADD KEY `bills_shipment_status_id_foreign` (`shipment_status_id`),
  ADD KEY `bills_bill_tracking_id_foreign` (`bill_tracking_id`);

--
-- Indexes for table `bills_tracking`
--
ALTER TABLE `bills_tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bills_tracking_bill_number_unique` (`bill_number`),
  ADD KEY `bills_tracking_shop_id_foreign` (`shop_id`),
  ADD KEY `bills_tracking_bill_status_id_foreign` (`bill_status_id`);

--
-- Indexes for table `bill_statuses`
--
ALTER TABLE `bill_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_statuses_name_unique` (`name`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_territory_id_foreign` (`territory_id`);

--
-- Indexes for table `city_delegate`
--
ALTER TABLE `city_delegate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_delegate_delegate_id_city_id_unique` (`delegate_id`,`city_id`),
  ADD KEY `city_delegate_city_id_foreign` (`city_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delegates`
--
ALTER TABLE `delegates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delegates_phone_unique` (`phone`);

--
-- Indexes for table `delivery_prices`
--
ALTER TABLE `delivery_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery_prices_shop_id_location_type_location_id_unique` (`shop_id`,`location_type`,`location_id`),
  ADD KEY `delivery_prices_location_type_location_id_index` (`location_type`,`location_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `last_deportation_logs`
--
ALTER TABLE `last_deportation_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID_id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_city_id_foreign` (`city_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_imports`
--
ALTER TABLE `shipment_imports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_rates`
--
ALTER TABLE `shipment_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_rates_city_from_foreign` (`city_from`),
  ADD KEY `shipment_rates_city_to_foreign` (`city_to`);

--
-- Indexes for table `shipment_statuses`
--
ALTER TABLE `shipment_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipment_statuses_name_unique` (`name`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shops_user_id_foreign` (`user_id`);

--
-- Indexes for table `territories`
--
ALTER TABLE `territories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `territories_name_unique` (`name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_account_number_unique` (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bills_tracking`
--
ALTER TABLE `bills_tracking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bill_statuses`
--
ALTER TABLE `bill_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `city_delegate`
--
ALTER TABLE `city_delegate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delegates`
--
ALTER TABLE `delegates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `delivery_prices`
--
ALTER TABLE `delivery_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_deportation_logs`
--
ALTER TABLE `last_deportation_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shipment_imports`
--
ALTER TABLE `shipment_imports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipment_rates`
--
ALTER TABLE `shipment_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipment_statuses`
--
ALTER TABLE `shipment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `territories`
--
ALTER TABLE `territories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_bill_tracking_id_foreign` FOREIGN KEY (`bill_tracking_id`) REFERENCES `bills_tracking` (`id`),
  ADD CONSTRAINT `bills_consignee_city_foreign` FOREIGN KEY (`consignee_city`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `bills_consignee_region_foreign` FOREIGN KEY (`consignee_region`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `bills_delegate_id_foreign` FOREIGN KEY (`delegate_id`) REFERENCES `delegates` (`id`),
  ADD CONSTRAINT `bills_shipment_status_id_foreign` FOREIGN KEY (`shipment_status_id`) REFERENCES `shipment_statuses` (`id`),
  ADD CONSTRAINT `bills_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- Constraints for table `bills_tracking`
--
ALTER TABLE `bills_tracking`
  ADD CONSTRAINT `bills_tracking_bill_status_id_foreign` FOREIGN KEY (`bill_status_id`) REFERENCES `bill_statuses` (`id`),
  ADD CONSTRAINT `bills_tracking_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_territory_id_foreign` FOREIGN KEY (`territory_id`) REFERENCES `territories` (`id`);

--
-- Constraints for table `city_delegate`
--
ALTER TABLE `city_delegate`
  ADD CONSTRAINT `city_delegate_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `city_delegate_delegate_id_foreign` FOREIGN KEY (`delegate_id`) REFERENCES `delegates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery_prices`
--
ALTER TABLE `delivery_prices`
  ADD CONSTRAINT `delivery_prices_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment_rates`
--
ALTER TABLE `shipment_rates`
  ADD CONSTRAINT `shipment_rates_city_from_foreign` FOREIGN KEY (`city_from`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipment_rates_city_to_foreign` FOREIGN KEY (`city_to`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
