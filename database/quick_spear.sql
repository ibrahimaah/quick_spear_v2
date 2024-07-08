-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 04:36 PM
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
(1, 'طبربور', '0780097333', '1', 'دوار الدبابه', 'عماره 110', 2, NULL, '2024-02-02 00:07:53', '2024-02-02 00:07:53', 0),
(2, 'Rooney Parrish', '+1 (388) 703-9615', '1', 'Do tempore molestia', 'Incidunt numquam am', 3, NULL, '2024-02-10 16:44:45', '2024-02-10 16:44:45', 0),
(3, 'Igor Sweet', '+1 (347) 286-2466', '1', 'Ut officia illum no', 'Cillum sunt est irur', 4, NULL, '2024-02-10 12:11:42', '2024-02-10 12:11:42', 0),
(5, 'Willa Brennan', '+1 (941) 246-9933', '2', 'Ex nesciunt obcaeca', 'Id porro sint porro', 4, NULL, '2024-02-10 16:15:39', '2024-02-10 16:15:39', 0),
(6, 'تمام حمود', '0935456789', '2', 'باء', 'وصف', 2, NULL, '2024-02-10 16:16:05', '2024-02-10 16:16:05', 0),
(7, 'William Haynes', '1324567893', '3', 'Molestias sit quia', 'Tempore id explicab', 4, NULL, '2024-02-14 17:30:21', '2024-02-14 17:30:21', 0),
(8, 'الهيثم للتجارة', '0912345678', '3', 'الوادي', 'بالقرب من العبارة', 4, NULL, '2024-03-26 18:01:34', '2024-03-26 18:01:34', 0),
(9, 'إياد', '9654123654', '1', 'المنطقة الصناعية', 'قرب المحولة', 4, NULL, '2024-03-26 19:34:39', '2024-03-26 19:34:39', 0),
(10, 'برهوم', '1234567896', '1', 'Iste ullamco ratione', 'Dolores anim ad exce', 4, NULL, '2024-03-31 04:56:00', '2024-03-31 04:56:00', 0),
(11, 'Kennedy Maxwell', '1234567896', '1', 'Perferendis dolores', 'Adipisicing incididu', 4, NULL, '2024-04-01 05:11:17', '2024-04-01 05:11:17', 0),
(12, 'qqqqq', '1234567894', '1', 'Itaque molestias inc', 'Dolorum veritatis su', 4, NULL, '2024-04-01 05:11:33', '2024-04-01 05:11:33', 0),
(15, 'Phillip Kane', '3216549875', '1', 'Beatae quidem dolore', 'Mollitia voluptas li', 1, NULL, '2024-04-01 05:27:02', '2024-04-01 05:27:02', 0),
(16, 'Keely Forbes', '3216549876', '1', 'Quia optio maxime n', 'Provident adipisici', 1, NULL, '2024-04-01 05:31:08', '2024-04-01 05:31:08', 0),
(17, 'Gwendolyn Morse', '1234567893', '1', 'Quia sunt sed animi', 'Ut veniam deserunt', 1, NULL, '2024-04-01 05:32:59', '2024-04-01 05:32:59', 0),
(18, 'Madeline Mcintosh', '3216549876', '2', 'Enim eius quidem sun', 'Aliquid nulla est e', 1, NULL, '2024-04-01 05:33:23', '2024-04-01 05:33:23', 0),
(19, 'Dillard', '1365478963', '1', 'منطقة', 'وصف', 1, NULL, '2024-04-13 16:20:52', '2024-04-13 16:20:52', 0),
(20, 'Yeo Combs', '1234567893', '1', 'Et aut obcaecati ame', 'Exercitation fugiat', NULL, 1, '2024-04-13 16:42:54', '2024-04-13 16:42:54', 0),
(21, 'Francis Tanner', '3216549873', '2', 'Laboris et in nulla', 'Eos ut consequuntur', NULL, 1, '2024-04-26 12:44:52', '2024-04-26 12:44:52', 0),
(22, 'متجر الدلفين', '2316549875', '2', 'المنطقة ش', 'وصف المنطقة', 4, NULL, '2024-04-26 13:07:42', '2024-04-26 13:07:42', 0),
(23, 'محلات الوادي', '1234567988', '2', 'شتىستنشى', 'نتىسؤىسن', 4, NULL, '2024-05-12 15:17:54', '2024-05-12 15:17:54', 0);

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
(1, 'Quickspear', 'Quickspear', '0798711008', '2024-02-01 22:17:49', '$2y$12$L7mYEAEjo/m2La4M9u0YDOwQYMQvgGdhkpcau1zKJt/WKQLjCKb5y', '0', NULL, '2024-02-01 22:17:49', '2024-04-19 10:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'عمان', 1, '2024-02-02 00:04:59', '2024-02-02 00:04:59'),
(2, 'الزرقاء', 1, '2024-02-02 00:05:12', '2024-02-02 00:05:12'),
(3, 'الكرك', 1, '2024-02-02 21:57:32', '2024-02-02 21:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `city_delegate`
--

CREATE TABLE `city_delegate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `delegate_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_delegate`
--

INSERT INTO `city_delegate` (`id`, `city_id`, `delegate_id`, `created_at`, `updated_at`) VALUES
(3, 2, 3, NULL, NULL),
(4, 1, 2, NULL, NULL),
(6, 3, 2, NULL, NULL),
(7, 2, 4, NULL, NULL);

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
-- Table structure for table `contact_expresses`
--

CREATE TABLE `contact_expresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `has_support_reply` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_expresses`
--

INSERT INTO `contact_expresses` (`id`, `user_id`, `name`, `email`, `phone`, `message`, `has_support_reply`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Diana Cruz', 'dianacruz.mkt@gmail.com', '1234567890', 'Hi team,\r\n\r\nI came across your Website, when searching on Google and noticed that you do not show in the organic listings.\r\n\r\nOur main focus will be to help generate more sales & online traffic.\r\n\r\nWe can place your website on Google\'s 1st page. We will improve your website’s position on Google and get more traffic.\r\n\r\nIf interested, kindly provide me your name, phone number, and email.\r\n\r\nYour sincerely,\r\nDiana', 0, 'PENDING', '2024-02-04 19:37:44', '2024-02-04 19:37:44'),
(2, NULL, 'Nishant Sharma', 'nishant.developer22@gmail.com', '1234567890', 'Hi,\r\n\r\nI was just browsing your website and I came up with a great plan to re-develop your website using the latest technology to generate additional revenue and beat your opponents. (quickspeardelivery.com)\r\n\r\nI\'m an excellent web developer capable of almost anything you can come up with, and my costs are affordable for nearly everyone.\r\n\r\nI would be happy to send you \"Quotes\", “Proposal” Past work Details, \"Our Packages\", and “Offers”!\r\n\r\nThanks in advance,\r\nNishant (Business Development Executive)', 0, 'PENDING', '2024-02-06 18:45:57', '2024-02-06 18:45:57');

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
(1, 'ابراهيم', '06599599', '2024-04-23 18:13:45', '2024-04-23 18:13:45'),
(2, 'احمد', '6565656', '2024-04-23 18:32:16', '2024-04-23 18:32:16'),
(3, 'Donovan', '2313213213', '2024-04-26 09:24:11', '2024-04-26 09:24:11'),
(4, 'يس بقوش', '0936987456', '2024-05-18 14:17:38', '2024-05-18 14:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `statusVerify` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edit_orders`
--

CREATE TABLE `edit_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shipment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edit_orders`
--

INSERT INTO `edit_orders` (`id`, `type`, `desc`, `user_id`, `shipment_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'تعديل بيانات الحساب الشخصي', 'شرح التعديلات المطلوبة <br /> الاسم : AHMAD ALAILA <br /> البريد الالكتروني : abulailaa12@gmail.com <br /> رقم الهاتف : 0798711008', 1, NULL, 0, '2024-02-02 22:07:11', '2024-02-02 22:07:11');

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
(7, '2022_05_10_213537_create_cities_table', 1),
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
(30, '2024_04_23_200950_create_city_delegate_table', 4),
(33, '2024_05_15_112555_create_shops_table', 5);

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
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `iban_or_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `pickups`
--

CREATE TABLE `pickups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) NOT NULL,
  `CollectionDate` datetime NOT NULL,
  `LastStatus` varchar(255) NOT NULL,
  `LastStatusDescription` text DEFAULT NULL,
  `shipper` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `consignee_country_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `consignee_city` bigint(20) UNSIGNED NOT NULL,
  `consignee_region` varchar(255) NOT NULL,
  `consignee_zip_code` varchar(255) NOT NULL,
  `shipping_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `accepted_by_admin_at` timestamp NULL DEFAULT NULL,
  `due_date` varchar(255) NOT NULL,
  `order_price` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value_on_delivery` varchar(255) DEFAULT NULL,
  `customer_notes` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delegate_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `shop_id`, `delegate_id`, `consignee_name`, `consignee_phone`, `consignee_phone_2`, `consignee_country_code`, `consignee_city`, `consignee_region`, `consignee_zip_code`, `shipping_date_time`, `accepted_by_admin_at`, `due_date`, `order_price`, `value_on_delivery`, `customer_notes`, `delegate_notes`, `created_at`, `updated_at`, `status`) VALUES
(28, 1, 1, 'شش', '3216549875', '13', 'JO', 2, 'Similique qui exerci', '', '2024-05-17 10:08:05', NULL, '2024-05-20 13:08:05', '818', '200', 'Esse fugit in et ex', 'Sit ea facilis labo', '2024-04-15 17:46:21', '2024-05-17 10:08:05', 4),
(34, 2, NULL, 'Lucas', '3216549875', '9', 'JO', 3, 'Vitae amet ea quod', '', '2024-05-17 09:56:10', NULL, '2024-04-29 16:09:07', '699', NULL, 'Aut quia hic id ulla', NULL, '2024-04-26 13:09:07', '2024-04-26 13:09:07', 0),
(35, 2, NULL, 'Jane Wright', '1234567891', '14', 'JO', 2, 'Est est nulla quisqu', '', '2024-05-17 09:56:10', NULL, '2024-04-29 16:11:39', '241', NULL, 'Et consectetur est', NULL, '2024-04-26 13:11:39', '2024-04-26 13:11:39', 0),
(36, 1, 1, 'Bo Bell', '2316549875', '8', 'JO', 3, 'Odio omnis ipsum la', '', '2024-05-17 10:02:43', NULL, '2024-05-20 13:02:43', '190', NULL, 'Maiores in dicta aut', NULL, '2024-04-26 13:26:32', '2024-05-17 10:02:43', 1),
(37, 2, 2, 'Hashim Hammond', '3215649873', '22', 'JO', 2, 'Est qui id quos vol', '', '2024-05-17 09:56:10', NULL, '2024-04-29 16:26:42', '428', NULL, 'Eiusmod et ullam eos', 'Ex non consectetur', '2024-04-26 13:26:42', '2024-04-26 13:26:42', 0),
(38, 2, NULL, 'اسماعيل', '3216549875', '14', 'JO', 1, 'Eum veniam reprehen', '', '2024-05-17 09:56:10', NULL, '2024-04-29 17:21:02', '356', NULL, 'Recusandae Consequa', NULL, '2024-04-26 14:21:02', '2024-04-26 14:21:02', 0),
(39, 2, 1, 'Madeline Pierce', '1234567895', '25', 'JO', 3, 'Architecto non dolor', '', '2024-05-17 09:56:10', NULL, '2024-05-15 18:52:02', '789', NULL, 'Dolorem ullam ut sol', NULL, '2024-04-26 14:22:31', '2024-05-12 15:52:02', 2),
(40, 2, NULL, 'Ashely Tanner', '4563217893', '82', 'JO', 3, 'Quia in aut sequi re', '', '2024-05-17 08:19:02', NULL, '2024-05-20 10:42:10', '625', NULL, 'Dicta eum dolore por', NULL, '2024-05-17 07:42:10', '2024-05-17 08:19:02', 0),
(41, 2, NULL, 'Larissa Vaughn', '3216548965', '42', 'JO', 3, 'Eum voluptatem numqu', '', '2024-05-17 07:42:10', NULL, '2024-05-20 10:42:10', '912', NULL, 'Ab sint asperiores', NULL, '2024-05-17 07:42:10', '2024-05-17 07:42:10', 0),
(42, 2, 1, 'Aiko Chang', '1234567896', '86', 'JO', 3, 'Officiis voluptatibu', '', '2024-05-17 10:08:51', NULL, '2024-05-20 13:08:51', '955', '900', 'Sint ipsum et harum', NULL, '2024-05-17 07:44:03', '2024-05-17 10:08:51', 0),
(43, 2, NULL, 'Amery Herrera', '1234567891', '32', 'JO', 1, 'Tempore est consec', '', '2024-05-17 08:20:10', NULL, '2024-05-20 11:09:42', '274', NULL, 'Odio laboris impedit', NULL, '2024-05-17 08:09:42', '2024-05-17 08:09:42', 3),
(46, 1, 1, 'تمام حميدان', '1593578416', '41', 'JO', 3, 'الوادي الاخضر', '', '2024-05-17 09:43:58', NULL, '2024-05-20 12:43:58', '64', NULL, 'Facere at fugiat dol', 'Reprehenderit eveni', '2024-05-17 09:43:58', '2024-05-17 09:43:58', 0),
(47, 3, NULL, 'علاء حمادة.', '3216549875', '1213213', 'JO', 2, 'شششش', '', '2024-05-18 14:08:05', NULL, '2024-05-21 17:02:28', '100', NULL, 'لا يوجد', NULL, '2024-05-18 14:02:28', '2024-05-18 14:08:05', 0),
(48, 3, 4, 'عمر عطالله', '6548963214', '12222', 'JO', 1, 'ااااا', '', '2024-05-18 14:18:20', NULL, '2024-05-21 17:03:06', '300', NULL, 'لا يوجد', NULL, '2024-05-18 14:03:06', '2024-05-18 14:18:20', 4),
(49, 3, 4, 'خالد السعداني', '3215649875', '23132132', 'JO', 3, 'الزبداني', '', '2024-05-18 14:26:23', '2024-05-18 14:26:23', '2024-05-21 17:26:23', '300', '100', 'قابل للكسر', 'يجب مراعاة كذا', '2024-05-18 14:10:51', '2024-05-18 14:26:23', 1);

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
(1, 1, 1, 0, 1.5, '2024-02-02 00:05:47', '2024-02-02 00:05:47'),
(2, 1, 2, 0, 2.5, '2024-02-02 00:05:59', '2024-02-02 00:05:59'),
(3, 1, 1, 2, 1, '2024-02-02 19:46:10', '2024-02-02 19:46:10'),
(4, 1, 2, 2, 2, '2024-02-02 19:46:39', '2024-02-02 19:46:39'),
(5, 3, 2, 0, 10, '2024-03-30 04:09:12', '2024-03-30 04:09:12'),
(6, 3, 2, 0, 20, '2024-03-30 04:09:31', '2024-03-30 04:09:31');

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
(1, 14, 'Lababidi-Bau', 3, 'اللمباد', 'مقابل البلدية', '2024-05-15 10:18:25', '2024-05-15 10:22:45'),
(2, 4, 'وايت', 2, 'جديدة عرطوز', 'جنوب ريف دمشق', NULL, NULL),
(3, 16, 'الأنوار', 2, 'وادي الشاطئ', 'بناء لطش', '2024-05-18 13:59:48', '2024-05-18 13:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `email` varchar(255) NOT NULL,
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
(1, 'AHMAD ALAILA', 'abulailaa12@gmail.com', '0798711008', '819', NULL, '$2y$10$2t.hRM.U5u5pTr2oBRBMf.WlObvrVNpAxRbk/gX10fRjuxsIQN1r.', 0, NULL, NULL, 'pqqfI4854kStRYX37b4z3YzDy5hfvRTHh2Q3dawNXMNux7BSPFseFV1x5H97', '2024-02-01 22:21:10', '2024-04-01 04:41:36'),
(2, 'محمد الشاويش', 'mhamadalshawesh101@gmail.com', '+962780997332', '757', NULL, '$2y$10$OK8dU48QCZ5uxoBTPphRtu2mpbm4Dp9uxHqxiOHUh3LB0dQ7lifIa', 0, NULL, NULL, 'gea1Y4BLrr5cWH291ob4uIjll2HgpWE2PUCed5OzaHPyuWtDt3Frao0i9hoP', '2024-02-02 00:07:11', '2024-04-01 04:41:36'),
(3, 'اختباروت', 'ibrahim.a.a.h.2017@gmail.com', '1236547895', '960', NULL, '$2y$10$BNoapVqJFzmQzbP3Zqkr2u1IXvpdp7CXLpMd5tI7OB.fyfD/9JLvC', 0, NULL, NULL, 'ioDqUHmIEEFpHGYwT1lF0wQgV1VC9wDsuY3k5GjYgII8cNLJUJDIeeDECNpZ', '2024-02-10 16:09:23', '2024-04-01 04:41:36'),
(4, 'Casey Mayo', 'zenynivuvu@mailinator.com', '1234567897', '408', NULL, '$2y$10$./bDST9LrkWSHGhi5eCK9.Gz.sbniWxTVH/ADLHFC.P4ksV7c59fO', 0, NULL, NULL, 'pC92RepORCdL5mICgFNz3UiYTNcS4t6O3VwJBjR1QoOTiIetedQzdRsD3vIb', '2024-02-10 10:55:26', '2024-04-01 04:41:36'),
(5, 'ابراهيم مصطفى', 'ib@gmail.com', '0956565656', '313', NULL, '$2y$10$xpxYyu6MPW4fzQ7Jl0Y1fOqh.lHuhZ7WHog9MAUnCXtnrrcc4geLu', 0, NULL, NULL, '7iTzjYx0i7XNt2mT4z8z4HWMVrl9JdnUllphPzzKHopU9ZtWjJCfuJ5OvFnZ', '2024-03-02 15:38:18', '2024-04-01 04:41:36'),
(6, 'testaaaaa', 'i@gmail.com', '12365478965', '594', NULL, '$2y$10$kKJPhD.bLNjYYLaodlGRfOWCbeXV9yC8TFWoX2grx2dZ36Xp8SI2O', 0, NULL, NULL, '0MIw0N7xVnWzmaqq0qqKo0Ob7gdx1Zpz4Q9OBy3pnQEkQ7xdwZFmse3vBldD', '2024-04-01 04:04:50', '2024-04-01 04:41:36'),
(7, 'Wing Sosa', 'cysomit@mailinator.com', '32132123', '426', NULL, '$2y$10$iG4NgEtpiDNjS57w7Q97x.vMCnliy/c1FB5s6bP3vQwULwwbGog2y', 0, NULL, NULL, NULL, '2024-05-07 15:03:05', '2024-05-07 15:03:05'),
(9, 'Helen Pace', 'hiwubufyw@mailinator.com', '32165497', '208', NULL, '$2y$10$GxnW4g9Xk82NK0WYhkwnleQZBDwjlxmSNZ4.szqi2j77hQCwNoyeS', 0, NULL, NULL, NULL, '2024-05-15 09:08:29', '2024-05-15 09:08:29'),
(10, 'Yoko Owens', 'takoruhi@mailinator.com', '2123132', '351', NULL, '$2y$10$iupzXoDlWYeg3BzCRr6ns./4o4ETrw431VJwd8utGnnm39iKzg6Ou', 0, NULL, NULL, NULL, '2024-05-15 09:15:33', '2024-05-15 09:15:33'),
(11, 'Victoria Paul', 'wunypewom@mailinator.com', '321654', '186', NULL, '$2y$10$L4K8vnJqnZKuq2sAPcAd.eh53HITKn9vjPgwTypVbAhDu2O6J.tSa', 0, NULL, NULL, NULL, '2024-05-15 09:16:12', '2024-05-15 09:16:12'),
(12, 'Simone Rowe', 'guva@mailinator.com', '12345', '986', NULL, '$2y$10$9iIzHppJdodiWasY5L736.J.C75DyUZi9iScXtBg1/teqvsYWNOQ2', 0, NULL, NULL, NULL, '2024-05-15 09:16:56', '2024-05-15 09:16:56'),
(13, 'Roth Phelps', 'nexifa@mailinator.com', '222222222', '925', NULL, '$2y$10$JFMAQuWXpgDHsR6PcpjWee0eah8yqbgEWm5o6jkG9UwZa0MFCOBAa', 0, NULL, NULL, NULL, '2024-05-15 09:17:36', '2024-05-15 10:09:29'),
(14, 'محمد لبابيدي.', 'mohaa@gmail.com', '09688888866', '561', NULL, '$2y$10$1ro4xST.mVWOxqr/wC3Z1.TCo2fbmU86LPGBuGPg.12UDuJ85iy6i', 0, NULL, NULL, NULL, '2024-05-15 10:18:25', '2024-05-15 10:22:44'),
(15, 'Ahmad Mohammad', 'ahm@gmail.com', '0912345678', '619', NULL, '$2y$10$gsGm6kz8cHKDfGr6DV2f/.Tc0uHZe.OdIxdKu4Ymlm38yCUAENZV2', 0, NULL, NULL, 'SwsEv22BxGAOchBrY8893Uho3yqWEu7qOWHxONQSMwgm5L95L76EVZadwLTV', '2024-05-18 13:42:58', '2024-05-18 13:42:58'),
(16, 'أحمد محمد', 'ah@gmail.com', '09123456789', '382', NULL, '$2y$10$GRBoSXJT4MsTzihLU6h8SOPtStTYW973CQ9yGr086BddDBQFacRkG', 0, NULL, NULL, 'GjtNsRvF2ATTpia5jfrO33eIyS9AKeCiZSl3MbDOZPAwgZUQk4kOsaQQJzRk', '2024-05-18 13:59:48', '2024-05-18 13:59:48');

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_delegate`
--
ALTER TABLE `city_delegate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_delegate_delegate_id_foreign` (`delegate_id`),
  ADD KEY `city_delegate_city_id_foreign` (`city_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_expresses`
--
ALTER TABLE `contact_expresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_expresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `delegates`
--
ALTER TABLE `delegates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delegates_phone_unique` (`phone`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edit_orders`
--
ALTER TABLE `edit_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `edit_orders_user_id_foreign` (`user_id`),
  ADD KEY `edit_orders_shipment_id_foreign` (`shipment_id`);

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
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_user_id_foreign` (`user_id`);

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
-- Indexes for table `pickups`
--
ALTER TABLE `pickups`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_members_email_unique` (`email`),
  ADD UNIQUE KEY `team_members_phone_unique` (`phone`),
  ADD UNIQUE KEY `team_members_account_number_unique` (`account_number`);

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
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city_delegate`
--
ALTER TABLE `city_delegate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_expresses`
--
ALTER TABLE `contact_expresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delegates`
--
ALTER TABLE `delegates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edit_orders`
--
ALTER TABLE `edit_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `pickups`
--
ALTER TABLE `pickups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `city_delegate`
--
ALTER TABLE `city_delegate`
  ADD CONSTRAINT `city_delegate_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `city_delegate_delegate_id_foreign` FOREIGN KEY (`delegate_id`) REFERENCES `delegates` (`id`);

--
-- Constraints for table `contact_expresses`
--
ALTER TABLE `contact_expresses`
  ADD CONSTRAINT `contact_expresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `edit_orders`
--
ALTER TABLE `edit_orders`
  ADD CONSTRAINT `edit_orders_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `edit_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment_rates`
--
ALTER TABLE `shipment_rates`
  ADD CONSTRAINT `shipment_rates_city_from_foreign` FOREIGN KEY (`city_from`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipment_rates_city_to_foreign` FOREIGN KEY (`city_to`) REFERENCES `cities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
