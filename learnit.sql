-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 08:39 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learnit`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'educational',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_course`
--

CREATE TABLE `announcement_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `announcement_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `approvable_id` int(10) UNSIGNED NOT NULL,
  `approvable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decision` enum('approved','disapproved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `total_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_purchase_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `item_count` int(11) NOT NULL DEFAULT 0,
  `placed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_lines`
--

CREATE TABLE `cart_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `purchase_price` decimal(8,2) NOT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `live` tinyint(1) NOT NULL DEFAULT 1,
  `sortOrder` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `uuid`, `name`, `slug`, `parent_id`, `image`, `live`, `sortOrder`, `created_at`, `updated_at`) VALUES
(1, 'a7deabcd-1331-4d90-9a19-d0164b673fa2', 'Development', 'development', NULL, 'im im-icon-Code-Window', 1, 1, '2018-11-16 18:30:00', '2019-07-10 05:53:55'),
(2, '18a0da19-d365-4c01-b0f5-8c22068ef99e', 'Web Development', 'web-development', 1, NULL, 1, 2, '2018-11-18 18:30:00', '2019-07-10 05:53:55'),
(3, 'd162d970-a1be-463a-8a1c-fc5b39f35ab7', 'Mobile Apps', 'mobile-apps', 1, NULL, 1, 3, '2018-11-17 18:30:00', '2018-11-17 18:30:00'),
(4, '5ff3f496-434d-48fe-9901-5fae87b3fc91', 'Programming Languages', 'programming-languages', 1, NULL, 1, 4, '2018-11-17 18:30:00', '2018-11-17 18:30:00'),
(5, 'f70e6e5b-225a-4152-9234-f7e00946b81f', 'Business', 'business', NULL, 'im im-icon-Bar-Chart', 1, 5, '2018-11-16 18:30:00', '2019-07-10 05:54:20'),
(6, 'c2c0a7dd-cb65-47e7-9234-03e7e38df3fa', 'Accounting and Bookkeeping', 'accounting-and-bookkeeping', 17, NULL, 1, 10, '2018-11-17 18:30:00', '2019-07-10 05:57:14'),
(7, '0d641b0d-a04f-4fb3-93d8-bc9961139e4b', 'Design', 'design', NULL, NULL, 1, 6, '2019-07-10 03:48:55', '2019-07-10 05:57:14'),
(8, 'ace297d9-5abd-459f-b79b-955fc936cd43', 'Design Tools', 'design-tools', 7, NULL, 1, 7, '2019-07-10 03:49:15', '2019-07-10 05:57:14'),
(9, '8ff1f4ba-1369-44e4-bb5c-470b6a14adfc', 'Graphic Design', 'graphic-design', 7, NULL, 1, 8, '2019-07-10 03:49:26', '2019-07-10 06:01:02'),
(10, 'f58c23b0-e6e6-4b75-a04b-a8a1fbe842d1', 'Marketing', 'marketing', NULL, NULL, 1, 13, '2019-07-10 05:53:31', '2019-07-10 05:57:09'),
(11, '5c119225-b8fd-4583-a0b6-582fdb83ba6e', 'IT and Software', 'it-and-software', NULL, NULL, 1, 11, '2019-07-10 05:54:52', '2019-07-10 05:57:09'),
(12, '563b1a5f-9bd3-45b7-b6fb-194af5752fb7', 'Office Productivity', 'office-productivity', NULL, NULL, 1, 12, '2019-07-10 05:55:09', '2019-07-10 05:57:09'),
(14, 'b086edfa-18b9-4c42-b640-a1ec63a87db6', 'Photography', 'photography', NULL, NULL, 1, 15, '2019-07-10 05:55:51', '2019-07-10 05:57:09'),
(15, '919eecf9-5667-4607-a2c5-9a6e274e75a6', 'Health and Fitness', 'health-and-fitness', NULL, NULL, 1, 16, '2019-07-10 05:55:58', '2019-07-10 05:57:09'),
(17, '056b123d-a389-466b-9fdf-252386aeae03', 'Finance and Accounting', 'finance-and-accounting', NULL, NULL, 1, 9, '2019-07-10 05:57:06', '2019-07-10 05:57:14'),
(18, 'e83bcdd9-80b2-4fb8-81de-d510e8e23f58', 'Game Development', 'game-development', 1, NULL, 1, 18, '2019-07-10 05:57:51', '2019-07-10 05:57:51'),
(19, '13489877-ea24-4d79-ae6a-88c082fba0bc', 'Databases', 'databases', 1, NULL, 1, 19, '2019-07-10 05:57:58', '2019-07-10 05:57:58'),
(20, '43aa9855-259a-4146-84ab-190209705721', 'Software Testing', 'software-testing', 1, NULL, 1, 20, '2019-07-10 05:58:18', '2019-07-10 05:58:18'),
(21, 'fecfe06c-da3c-4180-89cb-7b11edae6687', 'Software Engineering', 'software-engineering', 1, NULL, 1, 21, '2019-07-10 05:58:29', '2019-07-10 05:58:29'),
(22, '89380873-e74b-421e-b0be-8a2bc99a95e8', 'Development Tools', 'development-tools', 1, NULL, 1, 22, '2019-07-10 05:58:43', '2019-07-10 05:58:43'),
(23, '9cfca9f5-49c4-4536-bf6b-6dbd09fe70c4', 'Entrepreneurship', 'entrepreneurship', 5, NULL, 1, 23, '2019-07-10 05:59:11', '2019-07-10 05:59:11'),
(24, 'ff817036-0f4e-41a8-a7d4-383a1fc9e29b', 'Communication', 'communication', 5, NULL, 1, 24, '2019-07-10 05:59:29', '2019-07-10 05:59:29'),
(25, '2104e59e-8057-46d8-bd3a-02dbed8792f4', 'Management', 'management', 5, NULL, 1, 25, '2019-07-10 05:59:38', '2019-07-10 05:59:38'),
(26, '5d82d8d8-60a7-4c46-b85f-205fb23cf747', 'Sales', 'sales', 5, NULL, 1, 26, '2019-07-10 05:59:57', '2019-07-10 05:59:57'),
(27, 'e4cc8b1e-17c2-4c8f-8795-b79de0e12aef', 'Data and Analytics', 'data-and-analytics', 5, NULL, 1, 27, '2019-07-10 06:00:07', '2019-07-10 06:00:07'),
(28, '1ebc102a-9993-4595-91fb-a9230dba9ce4', 'Web Design', 'web-design', 7, NULL, 1, 28, '2019-07-10 06:01:12', '2019-07-10 06:01:12'),
(29, '4a620c08-f650-44dd-b8e9-9b49010df27a', '3D and Animation', '3d-and-animation', 7, NULL, 1, 29, '2019-07-10 06:01:32', '2019-07-10 06:01:32'),
(30, '4b543cd2-6fd0-4162-8dc5-2e73405b2e5b', 'Fashion', 'fashion', 7, NULL, 1, 30, '2019-07-10 06:01:41', '2019-07-10 06:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `certificate_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_hours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_articles` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_quizzes` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(10) UNSIGNED NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `marked_as_answer` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `completions`
--

CREATE TABLE `completions` (
  `id` int(10) UNSIGNED NOT NULL,
  `lesson_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_id` int(10) UNSIGNED NOT NULL,
  `content_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_duration` int(11) DEFAULT NULL,
  `video_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_storage` enum('s3','local') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_src` enum('upload','embed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_3166_2` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_3166_3` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sub_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_decimals` int(11) DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sub_region_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `eea` tinyint(1) NOT NULL DEFAULT 0,
  `calling_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso_3166_2`, `iso_3166_3`, `capital`, `citizenship`, `country_code`, `currency`, `currency_code`, `currency_sub_unit`, `currency_symbol`, `currency_decimals`, `full_name`, `region_code`, `sub_region_code`, `eea`, `calling_code`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 'Kabul', 'Afghan', '004', 'afghani', 'AFN', 'pul', '؋', 2, 'Islamic Republic of Afghanistan', '142', '034', 0, '93', 'AF.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(2, 'Albania', 'AL', 'ALB', 'Tirana', 'Albanian', '008', 'lek', 'ALL', '(qindar (pl. qindarka))', 'Lek', 2, 'Republic of Albania', '150', '039', 0, '355', 'AL.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(3, 'Antarctica', 'AQ', 'ATA', 'Antartica', 'of Antartica', '010', '', '', '', '', 2, 'Antarctica', '', '', 0, '672', 'AQ.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(4, 'Algeria', 'DZ', 'DZA', 'Algiers', 'Algerian', '012', 'Algerian dinar', 'DZD', 'centime', 'DZD', 2, 'People’s Democratic Republic of Algeria', '002', '015', 0, '213', 'DZ.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(5, 'American Samoa', 'AS', 'ASM', 'Pago Pago', 'American Samoan', '016', 'US dollar', 'USD', 'cent', '$', 2, 'Territory of American', '009', '061', 0, '1', 'AS.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(6, 'Andorra', 'AD', 'AND', 'Andorra la Vella', 'Andorran', '020', 'euro', 'EUR', 'cent', '€', 2, 'Principality of Andorra', '150', '039', 0, '376', 'AD.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(7, 'Angola', 'AO', 'AGO', 'Luanda', 'Angolan', '024', 'kwanza', 'AOA', 'cêntimo', 'Kz', 2, 'Republic of Angola', '002', '017', 0, '244', 'AO.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(8, 'Antigua and Barbuda', 'AG', 'ATG', 'St John’s', 'of Antigua and Barbuda', '028', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Antigua and Barbuda', '019', '029', 0, '1', 'AG.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(9, 'Azerbaijan', 'AZ', 'AZE', 'Baku', 'Azerbaijani', '031', 'Azerbaijani manat', 'AZN', 'kepik (inv.)', 'ман', 2, 'Republic of Azerbaijan', '142', '145', 0, '994', 'AZ.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(10, 'Argentina', 'AR', 'ARG', 'Buenos Aires', 'Argentinian', '032', 'Argentine peso', 'ARS', 'centavo', '$', 2, 'Argentine Republic', '019', '005', 0, '54', 'AR.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(11, 'Australia', 'AU', 'AUS', 'Canberra', 'Australian', '036', 'Australian dollar', 'AUD', 'cent', '$', 2, 'Commonwealth of Australia', '009', '053', 0, '61', 'AU.png', '2021-04-26 00:56:05', '2021-04-26 00:56:05'),
(12, 'Austria', 'AT', 'AUT', 'Vienna', 'Austrian', '040', 'euro', 'EUR', 'cent', '€', 2, 'Republic of Austria', '150', '155', 1, '43', 'AT.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(13, 'Bahamas', 'BS', 'BHS', 'Nassau', 'Bahamian', '044', 'Bahamian dollar', 'BSD', 'cent', '$', 2, 'Commonwealth of the Bahamas', '019', '029', 0, '1', 'BS.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(14, 'Bahrain', 'BH', 'BHR', 'Manama', 'Bahraini', '048', 'Bahraini dinar', 'BHD', 'fils (inv.)', 'BHD', 3, 'Kingdom of Bahrain', '142', '145', 0, '973', 'BH.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(15, 'Bangladesh', 'BD', 'BGD', 'Dhaka', 'Bangladeshi', '050', 'taka (inv.)', 'BDT', 'poisha (inv.)', 'BDT', 2, 'People’s Republic of Bangladesh', '142', '034', 0, '880', 'BD.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(16, 'Armenia', 'AM', 'ARM', 'Yerevan', 'Armenian', '051', 'dram (inv.)', 'AMD', 'luma', 'AMD', 2, 'Republic of Armenia', '142', '145', 0, '374', 'AM.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(17, 'Barbados', 'BB', 'BRB', 'Bridgetown', 'Barbadian', '052', 'Barbados dollar', 'BBD', 'cent', '$', 2, 'Barbados', '019', '029', 0, '1', 'BB.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(18, 'Belgium', 'BE', 'BEL', 'Brussels', 'Belgian', '056', 'euro', 'EUR', 'cent', '€', 2, 'Kingdom of Belgium', '150', '155', 1, '32', 'BE.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(19, 'Bermuda', 'BM', 'BMU', 'Hamilton', 'Bermudian', '060', 'Bermuda dollar', 'BMD', 'cent', '$', 2, 'Bermuda', '019', '021', 0, '1', 'BM.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(20, 'Bhutan', 'BT', 'BTN', 'Thimphu', 'Bhutanese', '064', 'ngultrum (inv.)', 'BTN', 'chhetrum (inv.)', 'BTN', 2, 'Kingdom of Bhutan', '142', '034', 0, '975', 'BT.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(21, 'Bolivia, Plurinational State of', 'BO', 'BOL', 'Sucre (BO1)', 'Bolivian', '068', 'boliviano', 'BOB', 'centavo', '$b', 2, 'Plurinational State of Bolivia', '019', '005', 0, '591', 'BO.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(22, 'Bosnia and Herzegovina', 'BA', 'BIH', 'Sarajevo', 'of Bosnia and Herzegovina', '070', 'convertible mark', 'BAM', 'fening', 'KM', 2, 'Bosnia and Herzegovina', '150', '039', 0, '387', 'BA.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(23, 'Botswana', 'BW', 'BWA', 'Gaborone', 'Botswanan', '072', 'pula (inv.)', 'BWP', 'thebe (inv.)', 'P', 2, 'Republic of Botswana', '002', '018', 0, '267', 'BW.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(24, 'Bouvet Island', 'BV', 'BVT', 'Bouvet island', 'of Bouvet island', '074', '', '', '', 'kr', 2, 'Bouvet Island', '', '', 0, '47', 'BV.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(25, 'Brazil', 'BR', 'BRA', 'Brasilia', 'Brazilian', '076', 'real (pl. reais)', 'BRL', 'centavo', 'R$', 2, 'Federative Republic of Brazil', '019', '005', 0, '55', 'BR.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(26, 'Belize', 'BZ', 'BLZ', 'Belmopan', 'Belizean', '084', 'Belize dollar', 'BZD', 'cent', 'BZ$', 2, 'Belize', '019', '013', 0, '501', 'BZ.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(27, 'British Indian Ocean Territory', 'IO', 'IOT', 'Diego Garcia', 'Changosian', '086', 'US dollar', 'USD', 'cent', '$', 2, 'British Indian Ocean Territory', '', '', 0, '246', 'IO.png', '2021-04-26 00:56:06', '2021-04-26 00:56:06'),
(28, 'Solomon Islands', 'SB', 'SLB', 'Honiara', 'Solomon Islander', '090', 'Solomon Islands dollar', 'SBD', 'cent', '$', 2, 'Solomon Islands', '009', '054', 0, '677', 'SB.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(29, 'Virgin Islands, British', 'VG', 'VGB', 'Road Town', 'British Virgin Islander;', '092', 'US dollar', 'USD', 'cent', '$', 2, 'British Virgin Islands', '019', '029', 0, '1', 'VG.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(30, 'Brunei Darussalam', 'BN', 'BRN', 'Bandar Seri Begawan', 'Bruneian', '096', 'Brunei dollar', 'BND', 'sen (inv.)', '$', 2, 'Brunei Darussalam', '142', '035', 0, '673', 'BN.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(31, 'Bulgaria', 'BG', 'BGR', 'Sofia', 'Bulgarian', '100', 'lev (pl. leva)', 'BGN', 'stotinka', 'лв', 2, 'Republic of Bulgaria', '150', '151', 1, '359', 'BG.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(32, 'Myanmar', 'MM', 'MMR', 'Yangon', 'Burmese', '104', 'kyat', 'MMK', 'pya', 'K', 2, 'Union of Myanmar/', '142', '035', 0, '95', 'MM.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(33, 'Burundi', 'BI', 'BDI', 'Bujumbura', 'Burundian', '108', 'Burundi franc', 'BIF', 'centime', 'BIF', 0, 'Republic of Burundi', '002', '014', 0, '257', 'BI.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(34, 'Belarus', 'BY', 'BLR', 'Minsk', 'Belarusian', '112', 'Belarusian rouble', 'BYR', 'kopek', 'p.', 2, 'Republic of Belarus', '150', '151', 0, '375', 'BY.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(35, 'Cambodia', 'KH', 'KHM', 'Phnom Penh', 'Cambodian', '116', 'riel', 'KHR', 'sen (inv.)', '៛', 2, 'Kingdom of Cambodia', '142', '035', 0, '855', 'KH.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(36, 'Cameroon', 'CM', 'CMR', 'Yaoundé', 'Cameroonian', '120', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 0, 'Republic of Cameroon', '002', '017', 0, '237', 'CM.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(37, 'Canada', 'CA', 'CAN', 'Ottawa', 'Canadian', '124', 'Canadian dollar', 'CAD', 'cent', '$', 2, 'Canada', '019', '021', 0, '1', 'CA.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(38, 'Cape Verde', 'CV', 'CPV', 'Praia', 'Cape Verdean', '132', 'Cape Verde escudo', 'CVE', 'centavo', 'CVE', 2, 'Republic of Cape Verde', '002', '011', 0, '238', 'CV.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(39, 'Cayman Islands', 'KY', 'CYM', 'George Town', 'Caymanian', '136', 'Cayman Islands dollar', 'KYD', 'cent', '$', 2, 'Cayman Islands', '019', '029', 0, '1', 'KY.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(40, 'Central African Republic', 'CF', 'CAF', 'Bangui', 'Central African', '140', 'CFA franc (BEAC)', 'XAF', 'centime', 'CFA', 0, 'Central African Republic', '002', '017', 0, '236', 'CF.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(41, 'Sri Lanka', 'LK', 'LKA', 'Colombo', 'Sri Lankan', '144', 'Sri Lankan rupee', 'LKR', 'cent', '₨', 2, 'Democratic Socialist Republic of Sri Lanka', '142', '034', 0, '94', 'LK.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(42, 'Chad', 'TD', 'TCD', 'N’Djamena', 'Chadian', '148', 'CFA franc (BEAC)', 'XAF', 'centime', 'XAF', 0, 'Republic of Chad', '002', '017', 0, '235', 'TD.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(43, 'Chile', 'CL', 'CHL', 'Santiago', 'Chilean', '152', 'Chilean peso', 'CLP', 'centavo', 'CLP', 0, 'Republic of Chile', '019', '005', 0, '56', 'CL.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(44, 'China', 'CN', 'CHN', 'Beijing', 'Chinese', '156', 'renminbi-yuan (inv.)', 'CNY', 'jiao (10)', '¥', 2, 'People’s Republic of China', '142', '030', 0, '86', 'CN.png', '2021-04-26 00:56:07', '2021-04-26 00:56:07'),
(45, 'Taiwan, Province of China', 'TW', 'TWN', 'Taipei', 'Taiwanese', '158', 'new Taiwan dollar', 'TWD', 'fen (inv.)', 'NT$', 2, 'Republic of China, Taiwan (TW1)', '142', '030', 0, '886', 'TW.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(46, 'Christmas Island', 'CX', 'CXR', 'Flying Fish Cove', 'Christmas Islander', '162', 'Australian dollar', 'AUD', 'cent', '$', 2, 'Christmas Island Territory', '', '', 0, '61', 'CX.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(47, 'Cocos (Keeling) Islands', 'CC', 'CCK', 'Bantam', 'Cocos Islander', '166', 'Australian dollar', 'AUD', 'cent', '$', 2, 'Territory of Cocos (Keeling) Islands', '', '', 0, '61', 'CC.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(48, 'Colombia', 'CO', 'COL', 'Santa Fe de Bogotá', 'Colombian', '170', 'Colombian peso', 'COP', 'centavo', '$', 2, 'Republic of Colombia', '019', '005', 0, '57', 'CO.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(49, 'Comoros', 'KM', 'COM', 'Moroni', 'Comorian', '174', 'Comorian franc', 'KMF', '', 'KMF', 0, 'Union of the Comoros', '002', '014', 0, '269', 'KM.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(50, 'Mayotte', 'YT', 'MYT', 'Mamoudzou', 'Mahorais', '175', 'euro', 'EUR', 'cent', '€', 2, 'Departmental Collectivity of Mayotte', '002', '014', 0, '262', 'YT.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(51, 'Congo', 'CG', 'COG', 'Brazzaville', 'Congolese', '178', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 0, 'Republic of the Congo', '002', '017', 0, '242', 'CG.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(52, 'Congo, the Democratic Republic of the', 'CD', 'COD', 'Kinshasa', 'Congolese', '180', 'Congolese franc', 'CDF', 'centime', 'CDF', 2, 'Democratic Republic of the Congo', '002', '017', 0, '243', 'CD.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(53, 'Cook Islands', 'CK', 'COK', 'Avarua', 'Cook Islander', '184', 'New Zealand dollar', 'NZD', 'cent', '$', 2, 'Cook Islands', '009', '061', 0, '682', 'CK.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(54, 'Costa Rica', 'CR', 'CRI', 'San José', 'Costa Rican', '188', 'Costa Rican colón (pl. colones)', 'CRC', 'céntimo', '₡', 2, 'Republic of Costa Rica', '019', '013', 0, '506', 'CR.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(55, 'Croatia', 'HR', 'HRV', 'Zagreb', 'Croatian', '191', 'kuna (inv.)', 'HRK', 'lipa (inv.)', 'kn', 2, 'Republic of Croatia', '150', '039', 1, '385', 'HR.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(56, 'Cuba', 'CU', 'CUB', 'Havana', 'Cuban', '192', 'Cuban peso', 'CUP', 'centavo', '₱', 2, 'Republic of Cuba', '019', '029', 0, '53', 'CU.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(57, 'Cyprus', 'CY', 'CYP', 'Nicosia', 'Cypriot', '196', 'euro', 'EUR', 'cent', 'CYP', 2, 'Republic of Cyprus', '142', '145', 1, '357', 'CY.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(58, 'Czech Republic', 'CZ', 'CZE', 'Prague', 'Czech', '203', 'Czech koruna (pl. koruny)', 'CZK', 'halér', 'Kč', 2, 'Czech Republic', '150', '151', 1, '420', 'CZ.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(59, 'Benin', 'BJ', 'BEN', 'Porto Novo (BJ1)', 'Beninese', '204', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Republic of Benin', '002', '011', 0, '229', 'BJ.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(60, 'Denmark', 'DK', 'DNK', 'Copenhagen', 'Danish', '208', 'Danish krone', 'DKK', 'øre (inv.)', 'kr', 2, 'Kingdom of Denmark', '150', '154', 1, '45', 'DK.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(61, 'Dominica', 'DM', 'DMA', 'Roseau', 'Dominican', '212', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Commonwealth of Dominica', '019', '029', 0, '1', 'DM.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(62, 'Dominican Republic', 'DO', 'DOM', 'Santo Domingo', 'Dominican', '214', 'Dominican peso', 'DOP', 'centavo', 'RD$', 2, 'Dominican Republic', '019', '029', 0, '1', 'DO.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(63, 'Ecuador', 'EC', 'ECU', 'Quito', 'Ecuadorian', '218', 'US dollar', 'USD', 'cent', '$', 2, 'Republic of Ecuador', '019', '005', 0, '593', 'EC.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(64, 'El Salvador', 'SV', 'SLV', 'San Salvador', 'Salvadoran', '222', 'Salvadorian colón (pl. colones)', 'SVC', 'centavo', '$', 2, 'Republic of El Salvador', '019', '013', 0, '503', 'SV.png', '2021-04-26 00:56:08', '2021-04-26 00:56:08'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 'Malabo', 'Equatorial Guinean', '226', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 2, 'Republic of Equatorial Guinea', '002', '017', 0, '240', 'GQ.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(66, 'Ethiopia', 'ET', 'ETH', 'Addis Ababa', 'Ethiopian', '231', 'birr (inv.)', 'ETB', 'cent', 'ETB', 2, 'Federal Democratic Republic of Ethiopia', '002', '014', 0, '251', 'ET.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(67, 'Eritrea', 'ER', 'ERI', 'Asmara', 'Eritrean', '232', 'nakfa', 'ERN', 'cent', 'Nfk', 2, 'State of Eritrea', '002', '014', 0, '291', 'ER.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(68, 'Estonia', 'EE', 'EST', 'Tallinn', 'Estonian', '233', 'euro', 'EUR', 'cent', 'kr', 2, 'Republic of Estonia', '150', '154', 1, '372', 'EE.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(69, 'Faroe Islands', 'FO', 'FRO', 'Tórshavn', 'Faeroese', '234', 'Danish krone', 'DKK', 'øre (inv.)', 'kr', 2, 'Faeroe Islands', '150', '154', 0, '298', 'FO.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(70, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 'Stanley', 'Falkland Islander', '238', 'Falkland Islands pound', 'FKP', 'new penny', '£', 2, 'Falkland Islands', '019', '005', 0, '500', 'FK.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(71, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 'King Edward Point (Grytviken)', 'of South Georgia and the South Sandwich Islands', '239', '', '', '', '£', 2, 'South Georgia and the South Sandwich Islands', '', '', 0, '44', 'GS.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(72, 'Fiji', 'FJ', 'FJI', 'Suva', 'Fijian', '242', 'Fiji dollar', 'FJD', 'cent', '$', 2, 'Republic of Fiji', '009', '054', 0, '679', 'FJ.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(73, 'Finland', 'FI', 'FIN', 'Helsinki', 'Finnish', '246', 'euro', 'EUR', 'cent', '€', 2, 'Republic of Finland', '150', '154', 1, '358', 'FI.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(74, 'Åland Islands', 'AX', 'ALA', 'Mariehamn', 'Åland Islander', '248', 'euro', 'EUR', 'cent', NULL, NULL, 'Åland Islands', '150', '154', 0, '358', NULL, '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(75, 'France', 'FR', 'FRA', 'Paris', 'French', '250', 'euro', 'EUR', 'cent', '€', 2, 'French Republic', '150', '155', 1, '33', 'FR.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(76, 'French Guiana', 'GF', 'GUF', 'Cayenne', 'Guianese', '254', 'euro', 'EUR', 'cent', '€', 2, 'French Guiana', '019', '005', 0, '594', 'GF.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(77, 'French Polynesia', 'PF', 'PYF', 'Papeete', 'Polynesian', '258', 'CFP franc', 'XPF', 'centime', 'XPF', 0, 'French Polynesia', '009', '061', 0, '689', 'PF.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(78, 'French Southern Territories', 'TF', 'ATF', 'Port-aux-Francais', 'of French Southern and Antarctic Lands', '260', 'euro', 'EUR', 'cent', '€', 2, 'French Southern and Antarctic Lands', '', '', 0, '33', 'TF.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(79, 'Djibouti', 'DJ', 'DJI', 'Djibouti', 'Djiboutian', '262', 'Djibouti franc', 'DJF', '', 'DJF', 0, 'Republic of Djibouti', '002', '014', 0, '253', 'DJ.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(80, 'Gabon', 'GA', 'GAB', 'Libreville', 'Gabonese', '266', 'CFA franc (BEAC)', 'XAF', 'centime', 'FCF', 0, 'Gabonese Republic', '002', '017', 0, '241', 'GA.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(81, 'Georgia', 'GE', 'GEO', 'Tbilisi', 'Georgian', '268', 'lari', 'GEL', 'tetri (inv.)', 'GEL', 2, 'Georgia', '142', '145', 0, '995', 'GE.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(82, 'Gambia', 'GM', 'GMB', 'Banjul', 'Gambian', '270', 'dalasi (inv.)', 'GMD', 'butut', 'D', 2, 'Republic of the Gambia', '002', '011', 0, '220', 'GM.png', '2021-04-26 00:56:09', '2021-04-26 00:56:09'),
(83, 'Palestinian Territory, Occupied', 'PS', 'PSE', NULL, 'Palestinian', '275', NULL, NULL, NULL, '₪', 2, NULL, '142', '145', 0, '970', 'PS.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(84, 'Germany', 'DE', 'DEU', 'Berlin', 'German', '276', 'euro', 'EUR', 'cent', '€', 2, 'Federal Republic of Germany', '150', '155', 1, '49', 'DE.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(85, 'Ghana', 'GH', 'GHA', 'Accra', 'Ghanaian', '288', 'Ghana cedi', 'GHS', 'pesewa', '¢', 2, 'Republic of Ghana', '002', '011', 0, '233', 'GH.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(86, 'Gibraltar', 'GI', 'GIB', 'Gibraltar', 'Gibraltarian', '292', 'Gibraltar pound', 'GIP', 'penny', '£', 2, 'Gibraltar', '150', '039', 0, '350', 'GI.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(87, 'Kiribati', 'KI', 'KIR', 'Tarawa', 'Kiribatian', '296', 'Australian dollar', 'AUD', 'cent', '$', 2, 'Republic of Kiribati', '009', '057', 0, '686', 'KI.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(88, 'Greece', 'GR', 'GRC', 'Athens', 'Greek', '300', 'euro', 'EUR', 'cent', '€', 2, 'Hellenic Republic', '150', '039', 1, '30', 'GR.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(89, 'Greenland', 'GL', 'GRL', 'Nuuk', 'Greenlander', '304', 'Danish krone', 'DKK', 'øre (inv.)', 'kr', 2, 'Greenland', '019', '021', 0, '299', 'GL.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(90, 'Grenada', 'GD', 'GRD', 'St George’s', 'Grenadian', '308', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Grenada', '019', '029', 0, '1', 'GD.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(91, 'Guadeloupe', 'GP', 'GLP', 'Basse Terre', 'Guadeloupean', '312', 'euro', 'EUR', 'cent', '€', 2, 'Guadeloupe', '019', '029', 0, '590', 'GP.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(92, 'Guam', 'GU', 'GUM', 'Agaña (Hagåtña)', 'Guamanian', '316', 'US dollar', 'USD', 'cent', '$', 2, 'Territory of Guam', '009', '057', 0, '1', 'GU.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(93, 'Guatemala', 'GT', 'GTM', 'Guatemala City', 'Guatemalan', '320', 'quetzal (pl. quetzales)', 'GTQ', 'centavo', 'Q', 2, 'Republic of Guatemala', '019', '013', 0, '502', 'GT.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(94, 'Guinea', 'GN', 'GIN', 'Conakry', 'Guinean', '324', 'Guinean franc', 'GNF', '', 'GNF', 0, 'Republic of Guinea', '002', '011', 0, '224', 'GN.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(95, 'Guyana', 'GY', 'GUY', 'Georgetown', 'Guyanese', '328', 'Guyana dollar', 'GYD', 'cent', '$', 2, 'Cooperative Republic of Guyana', '019', '005', 0, '592', 'GY.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(96, 'Haiti', 'HT', 'HTI', 'Port-au-Prince', 'Haitian', '332', 'gourde', 'HTG', 'centime', 'G', 2, 'Republic of Haiti', '019', '029', 0, '509', 'HT.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(97, 'Heard Island and McDonald Islands', 'HM', 'HMD', 'Territory of Heard Island and McDonald Islands', 'of Territory of Heard Island and McDonald Islands', '334', '', '', '', '$', 2, 'Territory of Heard Island and McDonald Islands', '', '', 0, '61', 'HM.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(98, 'Holy See (Vatican City State)', 'VA', 'VAT', 'Vatican City', 'of the Holy See/of the Vatican', '336', 'euro', 'EUR', 'cent', '€', 2, 'the Holy See/ Vatican City State', '150', '039', 0, '39', 'VA.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(99, 'Honduras', 'HN', 'HND', 'Tegucigalpa', 'Honduran', '340', 'lempira', 'HNL', 'centavo', 'L', 2, 'Republic of Honduras', '019', '013', 0, '504', 'HN.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(100, 'Hong Kong', 'HK', 'HKG', '(HK3)', 'Hong Kong Chinese', '344', 'Hong Kong dollar', 'HKD', 'cent', '$', 2, 'Hong Kong Special Administrative Region of the People’s Republic of China (HK2)', '142', '030', 0, '852', 'HK.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(101, 'Hungary', 'HU', 'HUN', 'Budapest', 'Hungarian', '348', 'forint (inv.)', 'HUF', '(fillér (inv.))', 'Ft', 2, 'Republic of Hungary', '150', '151', 1, '36', 'HU.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(102, 'Iceland', 'IS', 'ISL', 'Reykjavik', 'Icelander', '352', 'króna (pl. krónur)', 'ISK', '', 'kr', 0, 'Republic of Iceland', '150', '154', 0, '354', 'IS.png', '2021-04-26 00:56:10', '2021-04-26 00:56:10'),
(103, 'India', 'IN', 'IND', 'New Delhi', 'Indian', '356', 'Indian rupee', 'INR', 'paisa', '₹', 2, 'Republic of India', '142', '034', 0, '91', 'IN.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(104, 'Indonesia', 'ID', 'IDN', 'Jakarta', 'Indonesian', '360', 'Indonesian rupiah (inv.)', 'IDR', 'sen (inv.)', 'Rp', 2, 'Republic of Indonesia', '142', '035', 0, '62', 'ID.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(105, 'Iran, Islamic Republic of', 'IR', 'IRN', 'Tehran', 'Iranian', '364', 'Iranian rial', 'IRR', '(dinar) (IR1)', '﷼', 2, 'Islamic Republic of Iran', '142', '034', 0, '98', 'IR.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(106, 'Iraq', 'IQ', 'IRQ', 'Baghdad', 'Iraqi', '368', 'Iraqi dinar', 'IQD', 'fils (inv.)', 'IQD', 3, 'Republic of Iraq', '142', '145', 0, '964', 'IQ.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(107, 'Ireland', 'IE', 'IRL', 'Dublin', 'Irish', '372', 'euro', 'EUR', 'cent', '€', 2, 'Ireland (IE1)', '150', '154', 1, '353', 'IE.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(108, 'Israel', 'IL', 'ISR', '(IL1)', 'Israeli', '376', 'shekel', 'ILS', 'agora', '₪', 2, 'State of Israel', '142', '145', 0, '972', 'IL.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(109, 'Italy', 'IT', 'ITA', 'Rome', 'Italian', '380', 'euro', 'EUR', 'cent', '€', 2, 'Italian Republic', '150', '039', 1, '39', 'IT.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(110, 'Côte d\'Ivoire', 'CI', 'CIV', 'Yamoussoukro (CI1)', 'Ivorian', '384', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Republic of Côte d’Ivoire', '002', '011', 0, '225', 'CI.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(111, 'Jamaica', 'JM', 'JAM', 'Kingston', 'Jamaican', '388', 'Jamaica dollar', 'JMD', 'cent', '$', 2, 'Jamaica', '019', '029', 0, '1', 'JM.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(112, 'Japan', 'JP', 'JPN', 'Tokyo', 'Japanese', '392', 'yen (inv.)', 'JPY', '(sen (inv.)) (JP1)', '¥', 0, 'Japan', '142', '030', 0, '81', 'JP.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(113, 'Kazakhstan', 'KZ', 'KAZ', 'Astana', 'Kazakh', '398', 'tenge (inv.)', 'KZT', 'tiyn', 'лв', 2, 'Republic of Kazakhstan', '142', '143', 0, '7', 'KZ.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(114, 'Jordan', 'JO', 'JOR', 'Amman', 'Jordanian', '400', 'Jordanian dinar', 'JOD', '100 qirsh', 'JOD', 2, 'Hashemite Kingdom of Jordan', '142', '145', 0, '962', 'JO.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(115, 'Kenya', 'KE', 'KEN', 'Nairobi', 'Kenyan', '404', 'Kenyan shilling', 'KES', 'cent', 'KES', 2, 'Republic of Kenya', '002', '014', 0, '254', 'KE.png', '2021-04-26 00:56:11', '2021-04-26 00:56:11'),
(116, 'Korea, Democratic People\'s Republic of', 'KP', 'PRK', 'Pyongyang', 'North Korean', '408', 'North Korean won (inv.)', 'KPW', 'chun (inv.)', '₩', 2, 'Democratic People’s Republic of Korea', '142', '030', 0, '850', 'KP.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(117, 'Korea, Republic of', 'KR', 'KOR', 'Seoul', 'South Korean', '410', 'South Korean won (inv.)', 'KRW', '(chun (inv.))', '₩', 0, 'Republic of Korea', '142', '030', 0, '82', 'KR.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(118, 'Kuwait', 'KW', 'KWT', 'Kuwait City', 'Kuwaiti', '414', 'Kuwaiti dinar', 'KWD', 'fils (inv.)', 'KWD', 3, 'State of Kuwait', '142', '145', 0, '965', 'KW.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(119, 'Kyrgyzstan', 'KG', 'KGZ', 'Bishkek', 'Kyrgyz', '417', 'som', 'KGS', 'tyiyn', 'лв', 2, 'Kyrgyz Republic', '142', '143', 0, '996', 'KG.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(120, 'Lao People\'s Democratic Republic', 'LA', 'LAO', 'Vientiane', 'Lao', '418', 'kip (inv.)', 'LAK', '(at (inv.))', '₭', 0, 'Lao People’s Democratic Republic', '142', '035', 0, '856', 'LA.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(121, 'Lebanon', 'LB', 'LBN', 'Beirut', 'Lebanese', '422', 'Lebanese pound', 'LBP', '(piastre)', '£', 2, 'Lebanese Republic', '142', '145', 0, '961', 'LB.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(122, 'Lesotho', 'LS', 'LSO', 'Maseru', 'Basotho', '426', 'loti (pl. maloti)', 'LSL', 'sente', 'L', 2, 'Kingdom of Lesotho', '002', '018', 0, '266', 'LS.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(123, 'Latvia', 'LV', 'LVA', 'Riga', 'Latvian', '428', 'euro', 'EUR', 'cent', 'Ls', 2, 'Republic of Latvia', '150', '154', 1, '371', 'LV.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(124, 'Liberia', 'LR', 'LBR', 'Monrovia', 'Liberian', '430', 'Liberian dollar', 'LRD', 'cent', '$', 2, 'Republic of Liberia', '002', '011', 0, '231', 'LR.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(125, 'Libya', 'LY', 'LBY', 'Tripoli', 'Libyan', '434', 'Libyan dinar', 'LYD', 'dirham', 'LYD', 3, 'Socialist People’s Libyan Arab Jamahiriya', '002', '015', 0, '218', 'LY.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(126, 'Liechtenstein', 'LI', 'LIE', 'Vaduz', 'Liechtensteiner', '438', 'Swiss franc', 'CHF', 'centime', 'CHF', 2, 'Principality of Liechtenstein', '150', '155', 0, '423', 'LI.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(127, 'Lithuania', 'LT', 'LTU', 'Vilnius', 'Lithuanian', '440', 'euro', 'EUR', 'cent', 'Lt', 2, 'Republic of Lithuania', '150', '154', 1, '370', 'LT.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(128, 'Luxembourg', 'LU', 'LUX', 'Luxembourg', 'Luxembourger', '442', 'euro', 'EUR', 'cent', '€', 2, 'Grand Duchy of Luxembourg', '150', '155', 1, '352', 'LU.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(129, 'Macao', 'MO', 'MAC', 'Macao (MO3)', 'Macanese', '446', 'pataca', 'MOP', 'avo', 'MOP', 2, 'Macao Special Administrative Region of the People’s Republic of China (MO2)', '142', '030', 0, '853', 'MO.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(130, 'Madagascar', 'MG', 'MDG', 'Antananarivo', 'Malagasy', '450', 'ariary', 'MGA', 'iraimbilanja (inv.)', 'MGA', 2, 'Republic of Madagascar', '002', '014', 0, '261', 'MG.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(131, 'Malawi', 'MW', 'MWI', 'Lilongwe', 'Malawian', '454', 'Malawian kwacha (inv.)', 'MWK', 'tambala (inv.)', 'MK', 2, 'Republic of Malawi', '002', '014', 0, '265', 'MW.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(132, 'Malaysia', 'MY', 'MYS', 'Kuala Lumpur (MY1)', 'Malaysian', '458', 'ringgit (inv.)', 'MYR', 'sen (inv.)', 'RM', 2, 'Malaysia', '142', '035', 0, '60', 'MY.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(133, 'Maldives', 'MV', 'MDV', 'Malé', 'Maldivian', '462', 'rufiyaa', 'MVR', 'laari (inv.)', 'Rf', 2, 'Republic of Maldives', '142', '034', 0, '960', 'MV.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(134, 'Mali', 'ML', 'MLI', 'Bamako', 'Malian', '466', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Republic of Mali', '002', '011', 0, '223', 'ML.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(135, 'Malta', 'MT', 'MLT', 'Valletta', 'Maltese', '470', 'euro', 'EUR', 'cent', 'MTL', 2, 'Republic of Malta', '150', '039', 1, '356', 'MT.png', '2021-04-26 00:56:12', '2021-04-26 00:56:12'),
(136, 'Martinique', 'MQ', 'MTQ', 'Fort-de-France', 'Martinican', '474', 'euro', 'EUR', 'cent', '€', 2, 'Martinique', '019', '029', 0, '596', 'MQ.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(137, 'Mauritania', 'MR', 'MRT', 'Nouakchott', 'Mauritanian', '478', 'ouguiya', 'MRO', 'khoum', 'UM', 2, 'Islamic Republic of Mauritania', '002', '011', 0, '222', 'MR.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(138, 'Mauritius', 'MU', 'MUS', 'Port Louis', 'Mauritian', '480', 'Mauritian rupee', 'MUR', 'cent', '₨', 2, 'Republic of Mauritius', '002', '014', 0, '230', 'MU.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(139, 'Mexico', 'MX', 'MEX', 'Mexico City', 'Mexican', '484', 'Mexican peso', 'MXN', 'centavo', '$', 2, 'United Mexican States', '019', '013', 0, '52', 'MX.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(140, 'Monaco', 'MC', 'MCO', 'Monaco', 'Monegasque', '492', 'euro', 'EUR', 'cent', '€', 2, 'Principality of Monaco', '150', '155', 0, '377', 'MC.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(141, 'Mongolia', 'MN', 'MNG', 'Ulan Bator', 'Mongolian', '496', 'tugrik', 'MNT', 'möngö (inv.)', '₮', 2, 'Mongolia', '142', '030', 0, '976', 'MN.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(142, 'Moldova, Republic of', 'MD', 'MDA', 'Chisinau', 'Moldovan', '498', 'Moldovan leu (pl. lei)', 'MDL', 'ban', 'MDL', 2, 'Republic of Moldova', '150', '151', 0, '373', 'MD.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(143, 'Montenegro', 'ME', 'MNE', 'Podgorica', 'Montenegrin', '499', 'euro', 'EUR', 'cent', '€', 2, 'Montenegro', '150', '039', 0, '382', 'ME.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(144, 'Montserrat', 'MS', 'MSR', 'Plymouth (MS2)', 'Montserratian', '500', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Montserrat', '019', '029', 0, '1', 'MS.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(145, 'Morocco', 'MA', 'MAR', 'Rabat', 'Moroccan', '504', 'Moroccan dirham', 'MAD', 'centime', 'MAD', 2, 'Kingdom of Morocco', '002', '015', 0, '212', 'MA.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(146, 'Mozambique', 'MZ', 'MOZ', 'Maputo', 'Mozambican', '508', 'metical', 'MZN', 'centavo', 'MT', 2, 'Republic of Mozambique', '002', '014', 0, '258', 'MZ.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(147, 'Oman', 'OM', 'OMN', 'Muscat', 'Omani', '512', 'Omani rial', 'OMR', 'baiza', '﷼', 3, 'Sultanate of Oman', '142', '145', 0, '968', 'OM.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(148, 'Namibia', 'NA', 'NAM', 'Windhoek', 'Namibian', '516', 'Namibian dollar', 'NAD', 'cent', '$', 2, 'Republic of Namibia', '002', '018', 0, '264', 'NA.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(149, 'Nauru', 'NR', 'NRU', 'Yaren', 'Nauruan', '520', 'Australian dollar', 'AUD', 'cent', '$', 2, 'Republic of Nauru', '009', '057', 0, '674', 'NR.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(150, 'Nepal', 'NP', 'NPL', 'Kathmandu', 'Nepalese', '524', 'Nepalese rupee', 'NPR', 'paisa (inv.)', '₨', 2, 'Nepal', '142', '034', 0, '977', 'NP.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(151, 'Netherlands', 'NL', 'NLD', 'Amsterdam (NL2)', 'Dutch', '528', 'euro', 'EUR', 'cent', '€', 2, 'Kingdom of the Netherlands', '150', '155', 1, '31', 'NL.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(152, 'Curaçao', 'CW', 'CUW', 'Willemstad', 'Curaçaoan', '531', 'Netherlands Antillean guilder (CW1)', 'ANG', 'cent', NULL, NULL, 'Curaçao', '019', '029', 0, '599', NULL, '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(153, 'Aruba', 'AW', 'ABW', 'Oranjestad', 'Aruban', '533', 'Aruban guilder', 'AWG', 'cent', 'ƒ', 2, 'Aruba', '019', '029', 0, '297', 'AW.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(154, 'Sint Maarten (Dutch part)', 'SX', 'SXM', 'Philipsburg', 'Sint Maartener', '534', 'Netherlands Antillean guilder (SX1)', 'ANG', 'cent', NULL, NULL, 'Sint Maarten', '019', '029', 0, '721', NULL, '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(155, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', NULL, 'of Bonaire, Sint Eustatius and Saba', '535', 'US dollar', 'USD', 'cent', NULL, NULL, NULL, '019', '029', 0, '599', NULL, '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(156, 'New Caledonia', 'NC', 'NCL', 'Nouméa', 'New Caledonian', '540', 'CFP franc', 'XPF', 'centime', 'XPF', 0, 'New Caledonia', '009', '054', 0, '687', 'NC.png', '2021-04-26 00:56:13', '2021-04-26 00:56:13'),
(157, 'Vanuatu', 'VU', 'VUT', 'Port Vila', 'Vanuatuan', '548', 'vatu (inv.)', 'VUV', '', 'Vt', 0, 'Republic of Vanuatu', '009', '054', 0, '678', 'VU.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(158, 'New Zealand', 'NZ', 'NZL', 'Wellington', 'New Zealander', '554', 'New Zealand dollar', 'NZD', 'cent', '$', 2, 'New Zealand', '009', '053', 0, '64', 'NZ.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(159, 'Nicaragua', 'NI', 'NIC', 'Managua', 'Nicaraguan', '558', 'córdoba oro', 'NIO', 'centavo', 'C$', 2, 'Republic of Nicaragua', '019', '013', 0, '505', 'NI.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(160, 'Niger', 'NE', 'NER', 'Niamey', 'Nigerien', '562', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Republic of Niger', '002', '011', 0, '227', 'NE.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(161, 'Nigeria', 'NG', 'NGA', 'Abuja', 'Nigerian', '566', 'naira (inv.)', 'NGN', 'kobo (inv.)', '₦', 2, 'Federal Republic of Nigeria', '002', '011', 0, '234', 'NG.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(162, 'Niue', 'NU', 'NIU', 'Alofi', 'Niuean', '570', 'New Zealand dollar', 'NZD', 'cent', '$', 2, 'Niue', '009', '061', 0, '683', 'NU.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(163, 'Norfolk Island', 'NF', 'NFK', 'Kingston', 'Norfolk Islander', '574', 'Australian dollar', 'AUD', 'cent', '$', 2, 'Territory of Norfolk Island', '009', '053', 0, '672', 'NF.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(164, 'Norway', 'NO', 'NOR', 'Oslo', 'Norwegian', '578', 'Norwegian krone (pl. kroner)', 'NOK', 'øre (inv.)', 'kr', 2, 'Kingdom of Norway', '150', '154', 0, '47', 'NO.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(165, 'Northern Mariana Islands', 'MP', 'MNP', 'Saipan', 'Northern Mariana Islander', '580', 'US dollar', 'USD', 'cent', '$', 2, 'Commonwealth of the Northern Mariana Islands', '009', '057', 0, '1', 'MP.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(166, 'United States Minor Outlying Islands', 'UM', 'UMI', 'United States Minor Outlying Islands', 'of United States Minor Outlying Islands', '581', 'US dollar', 'USD', 'cent', '$', 2, 'United States Minor Outlying Islands', '', '', 0, '1', 'UM.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(167, 'Micronesia, Federated States of', 'FM', 'FSM', 'Palikir', 'Micronesian', '583', 'US dollar', 'USD', 'cent', '$', 2, 'Federated States of Micronesia', '009', '057', 0, '691', 'FM.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(168, 'Marshall Islands', 'MH', 'MHL', 'Majuro', 'Marshallese', '584', 'US dollar', 'USD', 'cent', '$', 2, 'Republic of the Marshall Islands', '009', '057', 0, '692', 'MH.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(169, 'Palau', 'PW', 'PLW', 'Melekeok', 'Palauan', '585', 'US dollar', 'USD', 'cent', '$', 2, 'Republic of Palau', '009', '057', 0, '680', 'PW.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(170, 'Pakistan', 'PK', 'PAK', 'Islamabad', 'Pakistani', '586', 'Pakistani rupee', 'PKR', 'paisa', '₨', 2, 'Islamic Republic of Pakistan', '142', '034', 0, '92', 'PK.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(171, 'Panama', 'PA', 'PAN', 'Panama City', 'Panamanian', '591', 'balboa', 'PAB', 'centésimo', 'B/.', 2, 'Republic of Panama', '019', '013', 0, '507', 'PA.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(172, 'Papua New Guinea', 'PG', 'PNG', 'Port Moresby', 'Papua New Guinean', '598', 'kina (inv.)', 'PGK', 'toea (inv.)', 'PGK', 2, 'Independent State of Papua New Guinea', '009', '054', 0, '675', 'PG.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(173, 'Paraguay', 'PY', 'PRY', 'Asunción', 'Paraguayan', '600', 'guaraní', 'PYG', 'céntimo', 'Gs', 0, 'Republic of Paraguay', '019', '005', 0, '595', 'PY.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(174, 'Peru', 'PE', 'PER', 'Lima', 'Peruvian', '604', 'new sol', 'PEN', 'céntimo', 'S/.', 2, 'Republic of Peru', '019', '005', 0, '51', 'PE.png', '2021-04-26 00:56:14', '2021-04-26 00:56:14'),
(175, 'Philippines', 'PH', 'PHL', 'Manila', 'Filipino', '608', 'Philippine peso', 'PHP', 'centavo', 'Php', 2, 'Republic of the Philippines', '142', '035', 0, '63', 'PH.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(176, 'Pitcairn', 'PN', 'PCN', 'Adamstown', 'Pitcairner', '612', 'New Zealand dollar', 'NZD', 'cent', '$', 2, 'Pitcairn Islands', '009', '061', 0, '649', 'PN.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(177, 'Poland', 'PL', 'POL', 'Warsaw', 'Polish', '616', 'zloty', 'PLN', 'grosz (pl. groszy)', 'zł', 2, 'Republic of Poland', '150', '151', 1, '48', 'PL.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(178, 'Portugal', 'PT', 'PRT', 'Lisbon', 'Portuguese', '620', 'euro', 'EUR', 'cent', '€', 2, 'Portuguese Republic', '150', '039', 1, '351', 'PT.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(179, 'Guinea-Bissau', 'GW', 'GNB', 'Bissau', 'Guinea-Bissau national', '624', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Republic of Guinea-Bissau', '002', '011', 0, '245', 'GW.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(180, 'Timor-Leste', 'TL', 'TLS', 'Dili', 'East Timorese', '626', 'US dollar', 'USD', 'cent', '$', 2, 'Democratic Republic of East Timor', '142', '035', 0, '670', 'TL.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(181, 'Puerto Rico', 'PR', 'PRI', 'San Juan', 'Puerto Rican', '630', 'US dollar', 'USD', 'cent', '$', 2, 'Commonwealth of Puerto Rico', '019', '029', 0, '1', 'PR.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(182, 'Qatar', 'QA', 'QAT', 'Doha', 'Qatari', '634', 'Qatari riyal', 'QAR', 'dirham', '﷼', 2, 'State of Qatar', '142', '145', 0, '974', 'QA.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(183, 'Réunion', 'RE', 'REU', 'Saint-Denis', 'Reunionese', '638', 'euro', 'EUR', 'cent', '€', 2, 'Réunion', '002', '014', 0, '262', 'RE.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(184, 'Romania', 'RO', 'ROU', 'Bucharest', 'Romanian', '642', 'Romanian leu (pl. lei)', 'RON', 'ban (pl. bani)', 'lei', 2, 'Romania', '150', '151', 1, '40', 'RO.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(185, 'Russian Federation', 'RU', 'RUS', 'Moscow', 'Russian', '643', 'Russian rouble', 'RUB', 'kopek', 'руб', 2, 'Russian Federation', '150', '151', 0, '7', 'RU.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(186, 'Rwanda', 'RW', 'RWA', 'Kigali', 'Rwandan; Rwandese', '646', 'Rwandese franc', 'RWF', 'centime', 'RWF', 0, 'Republic of Rwanda', '002', '014', 0, '250', 'RW.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(187, 'Saint Barthélemy', 'BL', 'BLM', 'Gustavia', 'of Saint Barthélemy', '652', 'euro', 'EUR', 'cent', NULL, NULL, 'Collectivity of Saint Barthélemy', '019', '029', 0, '590', NULL, '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(188, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', 'SHN', 'Jamestown', 'Saint Helenian', '654', 'Saint Helena pound', 'SHP', 'penny', '£', 2, 'Saint Helena, Ascension and Tristan da Cunha', '002', '011', 0, '290', 'SH.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(189, 'Saint Kitts and Nevis', 'KN', 'KNA', 'Basseterre', 'Kittsian; Nevisian', '659', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Federation of Saint Kitts and Nevis', '019', '029', 0, '1', 'KN.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(190, 'Anguilla', 'AI', 'AIA', 'The Valley', 'Anguillan', '660', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Anguilla', '019', '029', 0, '1', 'AI.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(191, 'Saint Lucia', 'LC', 'LCA', 'Castries', 'Saint Lucian', '662', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Saint Lucia', '019', '029', 0, '1', 'LC.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(192, 'Saint Martin (French part)', 'MF', 'MAF', 'Marigot', 'of Saint Martin', '663', 'euro', 'EUR', 'cent', NULL, NULL, 'Collectivity of Saint Martin', '019', '029', 0, '590', NULL, '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(193, 'Saint Pierre and Miquelon', 'PM', 'SPM', 'Saint-Pierre', 'St-Pierrais; Miquelonnais', '666', 'euro', 'EUR', 'cent', '€', 2, 'Territorial Collectivity of Saint Pierre and Miquelon', '019', '021', 0, '508', 'PM.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(194, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 'Kingstown', 'Vincentian', '670', 'East Caribbean dollar', 'XCD', 'cent', '$', 2, 'Saint Vincent and the Grenadines', '019', '029', 0, '1', 'VC.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(195, 'San Marino', 'SM', 'SMR', 'San Marino', 'San Marinese', '674', 'euro', 'EUR', 'cent', '€', 2, 'Republic of San Marino', '150', '039', 0, '378', 'SM.png', '2021-04-26 00:56:15', '2021-04-26 00:56:15'),
(196, 'Sao Tome and Principe', 'ST', 'STP', 'São Tomé', 'São Toméan', '678', 'dobra', 'STD', 'centavo', 'Db', 2, 'Democratic Republic of São Tomé and Príncipe', '002', '017', 0, '239', 'ST.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(197, 'Saudi Arabia', 'SA', 'SAU', 'Riyadh', 'Saudi Arabian', '682', 'riyal', 'SAR', 'halala', '﷼', 2, 'Kingdom of Saudi Arabia', '142', '145', 0, '966', 'SA.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(198, 'Senegal', 'SN', 'SEN', 'Dakar', 'Senegalese', '686', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Republic of Senegal', '002', '011', 0, '221', 'SN.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(199, 'Serbia', 'RS', 'SRB', 'Belgrade', 'Serb', '688', 'Serbian dinar', 'RSD', 'para (inv.)', NULL, NULL, 'Republic of Serbia', '150', '039', 0, '381', NULL, '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(200, 'Seychelles', 'SC', 'SYC', 'Victoria', 'Seychellois', '690', 'Seychelles rupee', 'SCR', 'cent', '₨', 2, 'Republic of Seychelles', '002', '014', 0, '248', 'SC.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(201, 'Sierra Leone', 'SL', 'SLE', 'Freetown', 'Sierra Leonean', '694', 'leone', 'SLL', 'cent', 'Le', 2, 'Republic of Sierra Leone', '002', '011', 0, '232', 'SL.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(202, 'Singapore', 'SG', 'SGP', 'Singapore', 'Singaporean', '702', 'Singapore dollar', 'SGD', 'cent', '$', 2, 'Republic of Singapore', '142', '035', 0, '65', 'SG.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(203, 'Slovakia', 'SK', 'SVK', 'Bratislava', 'Slovak', '703', 'euro', 'EUR', 'cent', 'Sk', 2, 'Slovak Republic', '150', '151', 1, '421', 'SK.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(204, 'Viet Nam', 'VN', 'VNM', 'Hanoi', 'Vietnamese', '704', 'dong', 'VND', '(10 hào', '₫', 2, 'Socialist Republic of Vietnam', '142', '035', 0, '84', 'VN.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(205, 'Slovenia', 'SI', 'SVN', 'Ljubljana', 'Slovene', '705', 'euro', 'EUR', 'cent', '€', 2, 'Republic of Slovenia', '150', '039', 1, '386', 'SI.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(206, 'Somalia', 'SO', 'SOM', 'Mogadishu', 'Somali', '706', 'Somali shilling', 'SOS', 'cent', 'S', 2, 'Somali Republic', '002', '014', 0, '252', 'SO.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(207, 'South Africa', 'ZA', 'ZAF', 'Pretoria (ZA1)', 'South African', '710', 'rand', 'ZAR', 'cent', 'R', 2, 'Republic of South Africa', '002', '018', 0, '27', 'ZA.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(208, 'Zimbabwe', 'ZW', 'ZWE', 'Harare', 'Zimbabwean', '716', 'Zimbabwe dollar (ZW1)', 'ZWL', 'cent', 'Z$', 2, 'Republic of Zimbabwe', '002', '014', 0, '263', 'ZW.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(209, 'Spain', 'ES', 'ESP', 'Madrid', 'Spaniard', '724', 'euro', 'EUR', 'cent', '€', 2, 'Kingdom of Spain', '150', '039', 1, '34', 'ES.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(210, 'South Sudan', 'SS', 'SSD', 'Juba', 'South Sudanese', '728', 'South Sudanese pound', 'SSP', 'piaster', NULL, NULL, 'Republic of South Sudan', '002', '015', 0, '211', NULL, '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(211, 'Sudan', 'SD', 'SDN', 'Khartoum', 'Sudanese', '729', 'Sudanese pound', 'SDG', 'piastre', NULL, NULL, 'Republic of the Sudan', '002', '015', 0, '249', NULL, '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(212, 'Western Sahara', 'EH', 'ESH', 'Al aaiun', 'Sahrawi', '732', 'Moroccan dirham', 'MAD', 'centime', 'MAD', 2, 'Western Sahara', '002', '015', 0, '212', 'EH.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(213, 'Suriname', 'SR', 'SUR', 'Paramaribo', 'Surinamese', '740', 'Surinamese dollar', 'SRD', 'cent', '$', 2, 'Republic of Suriname', '019', '005', 0, '597', 'SR.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(214, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 'Longyearbyen', 'of Svalbard', '744', 'Norwegian krone (pl. kroner)', 'NOK', 'øre (inv.)', 'kr', 2, 'Svalbard and Jan Mayen', '150', '154', 0, '47', 'SJ.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(215, 'Swaziland', 'SZ', 'SWZ', 'Mbabane', 'Swazi', '748', 'lilangeni', 'SZL', 'cent', 'SZL', 2, 'Kingdom of Swaziland', '002', '018', 0, '268', 'SZ.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(216, 'Sweden', 'SE', 'SWE', 'Stockholm', 'Swedish', '752', 'krona (pl. kronor)', 'SEK', 'öre (inv.)', 'kr', 2, 'Kingdom of Sweden', '150', '154', 1, '46', 'SE.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(217, 'Switzerland', 'CH', 'CHE', 'Berne', 'Swiss', '756', 'Swiss franc', 'CHF', 'centime', 'CHF', 2, 'Swiss Confederation', '150', '155', 0, '41', 'CH.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(218, 'Syrian Arab Republic', 'SY', 'SYR', 'Damascus', 'Syrian', '760', 'Syrian pound', 'SYP', 'piastre', '£', 2, 'Syrian Arab Republic', '142', '145', 0, '963', 'SY.png', '2021-04-26 00:56:16', '2021-04-26 00:56:16'),
(219, 'Tajikistan', 'TJ', 'TJK', 'Dushanbe', 'Tajik', '762', 'somoni', 'TJS', 'diram', 'TJS', 2, 'Republic of Tajikistan', '142', '143', 0, '992', 'TJ.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(220, 'Thailand', 'TH', 'THA', 'Bangkok', 'Thai', '764', 'baht (inv.)', 'THB', 'satang (inv.)', '฿', 2, 'Kingdom of Thailand', '142', '035', 0, '66', 'TH.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(221, 'Togo', 'TG', 'TGO', 'Lomé', 'Togolese', '768', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Togolese Republic', '002', '011', 0, '228', 'TG.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(222, 'Tokelau', 'TK', 'TKL', '(TK2)', 'Tokelauan', '772', 'New Zealand dollar', 'NZD', 'cent', '$', 2, 'Tokelau', '009', '061', 0, '690', 'TK.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(223, 'Tonga', 'TO', 'TON', 'Nuku’alofa', 'Tongan', '776', 'pa’anga (inv.)', 'TOP', 'seniti (inv.)', 'T$', 2, 'Kingdom of Tonga', '009', '061', 0, '676', 'TO.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(224, 'Trinidad and Tobago', 'TT', 'TTO', 'Port of Spain', 'Trinidadian; Tobagonian', '780', 'Trinidad and Tobago dollar', 'TTD', 'cent', 'TT$', 2, 'Republic of Trinidad and Tobago', '019', '029', 0, '1', 'TT.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(225, 'United Arab Emirates', 'AE', 'ARE', 'Abu Dhabi', 'Emirian', '784', 'UAE dirham', 'AED', 'fils (inv.)', 'AED', 2, 'United Arab Emirates', '142', '145', 0, '971', 'AE.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(226, 'Tunisia', 'TN', 'TUN', 'Tunis', 'Tunisian', '788', 'Tunisian dinar', 'TND', 'millime', 'TND', 3, 'Republic of Tunisia', '002', '015', 0, '216', 'TN.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(227, 'Turkey', 'TR', 'TUR', 'Ankara', 'Turk', '792', 'Turkish lira (inv.)', 'TRY', 'kurus (inv.)', '₺', 2, 'Republic of Turkey', '142', '145', 0, '90', 'TR.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(228, 'Turkmenistan', 'TM', 'TKM', 'Ashgabat', 'Turkmen', '795', 'Turkmen manat (inv.)', 'TMT', 'tenge (inv.)', 'm', 2, 'Turkmenistan', '142', '143', 0, '993', 'TM.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(229, 'Turks and Caicos Islands', 'TC', 'TCA', 'Cockburn Town', 'Turks and Caicos Islander', '796', 'US dollar', 'USD', 'cent', '$', 2, 'Turks and Caicos Islands', '019', '029', 0, '1', 'TC.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(230, 'Tuvalu', 'TV', 'TUV', 'Funafuti', 'Tuvaluan', '798', 'Australian dollar', 'AUD', 'cent', '$', 2, 'Tuvalu', '009', '061', 0, '688', 'TV.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(231, 'Uganda', 'UG', 'UGA', 'Kampala', 'Ugandan', '800', 'Uganda shilling', 'UGX', 'cent', 'UGX', 0, 'Republic of Uganda', '002', '014', 0, '256', 'UG.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(232, 'Ukraine', 'UA', 'UKR', 'Kiev', 'Ukrainian', '804', 'hryvnia', 'UAH', 'kopiyka', '₴', 2, 'Ukraine', '150', '151', 0, '380', 'UA.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(233, 'Macedonia, the former Yugoslav Republic of', 'MK', 'MKD', 'Skopje', 'of the former Yugoslav Republic of Macedonia', '807', 'denar (pl. denars)', 'MKD', 'deni (inv.)', 'ден', 2, 'the former Yugoslav Republic of Macedonia', '150', '039', 0, '389', 'MK.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17');
INSERT INTO `countries` (`id`, `name`, `iso_3166_2`, `iso_3166_3`, `capital`, `citizenship`, `country_code`, `currency`, `currency_code`, `currency_sub_unit`, `currency_symbol`, `currency_decimals`, `full_name`, `region_code`, `sub_region_code`, `eea`, `calling_code`, `flag`, `created_at`, `updated_at`) VALUES
(234, 'Egypt', 'EG', 'EGY', 'Cairo', 'Egyptian', '818', 'Egyptian pound', 'EGP', 'piastre', '£', 2, 'Arab Republic of Egypt', '002', '015', 0, '20', 'EG.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(235, 'United Kingdom', 'GB', 'GBR', 'London', 'British', '826', 'pound sterling', 'GBP', 'penny (pl. pence)', '£', 2, 'United Kingdom of Great Britain and Northern Ireland', '150', '154', 1, '44', 'GB.png', '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(236, 'Guernsey', 'GG', 'GGY', 'St Peter Port', 'of Guernsey', '831', 'Guernsey pound (GG2)', 'GGP (GG2)', 'penny (pl. pence)', NULL, NULL, 'Bailiwick of Guernsey', '150', '154', 0, '44', NULL, '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(237, 'Jersey', 'JE', 'JEY', 'St Helier', 'of Jersey', '832', 'Jersey pound (JE2)', 'JEP (JE2)', 'penny (pl. pence)', NULL, NULL, 'Bailiwick of Jersey', '150', '154', 0, '44', NULL, '2021-04-26 00:56:17', '2021-04-26 00:56:17'),
(238, 'Isle of Man', 'IM', 'IMN', 'Douglas', 'Manxman; Manxwoman', '833', 'Manx pound (IM2)', 'IMP (IM2)', 'penny (pl. pence)', NULL, NULL, 'Isle of Man', '150', '154', 0, '44', NULL, '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(239, 'Tanzania, United Republic of', 'TZ', 'TZA', 'Dodoma (TZ1)', 'Tanzanian', '834', 'Tanzanian shilling', 'TZS', 'cent', 'TZS', 2, 'United Republic of Tanzania', '002', '014', 0, '255', 'TZ.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(240, 'United States', 'US', 'USA', 'Washington DC', 'American', '840', 'US dollar', 'USD', 'cent', '$', 2, 'United States of America', '019', '021', 0, '1', 'US.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(241, 'Virgin Islands, U.S.', 'VI', 'VIR', 'Charlotte Amalie', 'US Virgin Islander', '850', 'US dollar', 'USD', 'cent', '$', 2, 'United States Virgin Islands', '019', '029', 0, '1', 'VI.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(242, 'Burkina Faso', 'BF', 'BFA', 'Ouagadougou', 'Burkinabe', '854', 'CFA franc (BCEAO)', 'XOF', 'centime', 'XOF', 0, 'Burkina Faso', '002', '011', 0, '226', 'BF.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(243, 'Uruguay', 'UY', 'URY', 'Montevideo', 'Uruguayan', '858', 'Uruguayan peso', 'UYU', 'centésimo', '$U', 0, 'Eastern Republic of Uruguay', '019', '005', 0, '598', 'UY.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(244, 'Uzbekistan', 'UZ', 'UZB', 'Tashkent', 'Uzbek', '860', 'sum (inv.)', 'UZS', 'tiyin (inv.)', 'лв', 2, 'Republic of Uzbekistan', '142', '143', 0, '998', 'UZ.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(245, 'Venezuela, Bolivarian Republic of', 'VE', 'VEN', 'Caracas', 'Venezuelan', '862', 'bolívar fuerte (pl. bolívares fuertes)', 'VEF', 'céntimo', 'Bs', 2, 'Bolivarian Republic of Venezuela', '019', '005', 0, '58', 'VE.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(246, 'Wallis and Futuna', 'WF', 'WLF', 'Mata-Utu', 'Wallisian; Futunan; Wallis and Futuna Islander', '876', 'CFP franc', 'XPF', 'centime', 'XPF', 0, 'Wallis and Futuna', '009', '061', 0, '681', 'WF.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(247, 'Samoa', 'WS', 'WSM', 'Apia', 'Samoan', '882', 'tala (inv.)', 'WST', 'sene (inv.)', 'WS$', 2, 'Independent State of Samoa', '009', '061', 0, '685', 'WS.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(248, 'Yemen', 'YE', 'YEM', 'San’a', 'Yemenite', '887', 'Yemeni rial', 'YER', 'fils (inv.)', '﷼', 2, 'Republic of Yemen', '142', '145', 0, '967', 'YE.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18'),
(249, 'Zambia', 'ZM', 'ZMB', 'Lusaka', 'Zambian', '894', 'Zambian kwacha (inv.)', 'ZMW', 'ngwee (inv.)', 'ZK', 2, 'Republic of Zambia', '002', '014', 0, '260', 'ZM.png', '2021-04-26 00:56:18', '2021-04-26 00:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expires` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `sitewide` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `uuid`, `course_id`, `code`, `percent`, `quantity`, `expires`, `active`, `sitewide`, `created_at`, `updated_at`) VALUES
(3, '549b65d7-56b9-427e-9d3f-c50f8f213676', NULL, 'GLOBAL-DISCOUNT-80', 80, 1000, '2019-11-29', 1, 1, '2019-09-28 11:44:01', '2019-09-28 11:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('all','beginner','intermediate','advanced') COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `uuid`, `user_id`, `category_id`, `title`, `subtitle`, `slug`, `description`, `language`, `image`, `level`, `featured`, `price`, `published`, `approved`, `settings`, `created_at`, `updated_at`) VALUES
(1, '88a134bf-2c33-4153-a2f6-e1c256d5a147', 2, 4, 'Quae Saepe Exercitationem Repudiandae Rem Quis.', 'Nihil Qui Ipsum Illum Laudantium.', 'quae-saepe-exercitationem-repudiandae-rem-quis', 'Facere architecto tempora omnis non magni quo quam ab. Aliquam distinctio dolorum asperiores qui quaerat doloribus voluptates. Veniam ut sit aut sapiente magnam. Impedit assumenda esse autem consequatur quia sit. Ipsam corrupti quo facere.\r\n\r\nVoluptatibus omnis rerum vel sint. Eligendi error et eius sit labore. Est minima cupiditate ducimus nihil similique. Autem quia quaerat repudiandae quis quos animi recusandae.', 'French', '80099bd04640cbd27949b8f8174464f5.jpg', 'all', 0, '170.00', 1, 1, '{\"total_video_hours\":0.1,\"durationHMS\":\"00:12:00\",\"total_articles\":2,\"total_hours\":0.2,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:06:45', '2019-09-26 16:07:16'),
(2, 'a4fd96a9-95f1-4de5-bfb1-996d396dbb74', 2, 18, 'Doloribus Qui Totam Et Rerum Consequatur Iusto.', 'Nemo Qui Perferendis Voluptates.', 'doloribus-qui-totam-et-rerum-consequatur-iusto', 'Repudiandae voluptatem veniam aut. Non et sint aut error est culpa sapiente quibusdam. Ratione eaque incidunt reiciendis.\r\n\r\nEa dolores molestias consequatur deleniti odio voluptas. Quia dolore iste aut est sint. Molestiae aut minima tempore. Molestiae autem cumque tempore.', 'Spanish', '2f49b85d5a4e632836fcb932cf2f4eac.jpg', 'intermediate', 0, '162.00', 1, 1, '{\"total_video_hours\":0.4,\"durationHMS\":\"00:30:00\",\"total_articles\":3,\"total_hours\":0.5,\"total_published_lessons\":8,\"total_lessons\":8,\"total_unanswered_questions\":0}', '2019-09-26 16:06:45', '2019-09-26 16:07:16'),
(3, '3b924977-da13-41d9-860d-37022279d0ad', 2, 23, 'Temporibus Officia Consequatur Non Dicta Non Vitae Non.', 'Nemo Id Voluptas Dicta Similique Quis Ab Nisi.', 'temporibus-officia-consequatur-non-dicta-non-vitae-non', 'Ut aut ut sit eos et labore modi et. Iure labore dolor sit cupiditate qui dolorum sit nam. Qui incidunt vel quibusdam aut quam tempora. Minus magni magnam corrupti aut porro consequuntur sunt qui.\r\n\r\nMollitia sapiente totam quos. Ut explicabo fugit et magnam fugiat. Distinctio odit eius architecto harum animi et asperiores.', 'French', '2c4999eb14032fe4fbd86842a42c2bba.jpg', 'beginner', 0, '72.00', 1, 1, '{\"total_video_hours\":0.2,\"durationHMS\":\"00:24:00\",\"total_articles\":3,\"total_hours\":0.4,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:06:45', '2019-09-26 16:07:16'),
(4, '56446753-5ca9-433b-8ef9-e34356d12796', 2, 9, 'Voluptates Accusamus Et Odio Qui Praesentium Mollitia Quisquam.', 'Reprehenderit Aut Est Aut Nobis Quis.', 'voluptates-accusamus-et-odio-qui-praesentium-mollitia-quisquam', 'Non perspiciatis cumque quos dolor. Animi quo et voluptas aut accusantium voluptatem et aperiam. Qui reiciendis cupiditate tempora sed rerum.\r\n\r\nVoluptatum harum quis perferendis. Eaque voluptas at exercitationem perferendis aperiam ut itaque similique. Possimus hic nam debitis vel.', 'English', '316d3e6aef4a65169a96fdf65e33c6e0.jpg', 'intermediate', 0, '177.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:30:00\",\"total_articles\":2,\"total_hours\":0.5,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:06:45', '2019-09-26 16:07:16'),
(5, '82c251da-169f-401f-b842-47e0b987a906', 2, 8, 'Vero Excepturi Illo Minus Veniam Hic Perspiciatis.', 'Libero Veniam Non Laborum Aut.', 'vero-excepturi-illo-minus-veniam-hic-perspiciatis', 'Aut repellendus est aliquid voluptatem. Similique aliquid sed fugit aliquid est. Quam id esse aut voluptatem eos nihil.\r\n\r\nQui quae dolorem omnis perferendis. Vel ipsum similique nam iure ut. At quis ratione et. Sed sit exercitationem quis itaque nulla.\r\n\r\nMolestiae numquam minus reiciendis est veritatis. Ex laudantium sunt quia temporibus aut amet blanditiis. Sed quidem provident est. Optio sapiente veniam quia et aut qui qui.\r\n\r\nEt sunt sit laboriosam molestiae. Libero modi doloremque aut temporibus iusto dicta maiores alias.', 'French', '3221499876ba225383a53e514d8fdeff.jpg', 'all', 0, '85.00', 1, 1, '{\"total_video_hours\":0.5,\"durationHMS\":\"00:42:00\",\"total_articles\":1,\"total_hours\":0.7,\"total_published_lessons\":7,\"total_lessons\":7,\"total_unanswered_questions\":0}', '2019-09-26 16:06:45', '2019-09-26 16:07:16'),
(6, '65ef98c0-7b47-427c-9ee6-51f0cccb8e24', 2, 27, 'Et Quisquam Porro Blanditiis Reiciendis Nihil Sint.', 'Est Excepturi Eaque Eos.', 'et-quisquam-porro-blanditiis-reiciendis-nihil-sint', 'Praesentium voluptatem qui animi voluptas libero quia similique. Voluptate molestiae perspiciatis pariatur similique aut. Id ipsam nobis provident officia aut vel. Occaecati et est deserunt non unde sunt eum unde.\r\n\r\nVoluptatem eum est voluptatem nisi sit autem. Consequatur sed tempora necessitatibus soluta nam reprehenderit molestiae. Dignissimos commodi ipsam ut est.\r\n\r\nPossimus itaque doloremque est aliquid laborum. Reprehenderit aut cumque et in molestiae aut voluptatibus. Sequi modi velit est laboriosam voluptatem est.\r\n\r\nMolestiae minus soluta aspernatur velit recusandae ut laboriosam. Omnis accusantium quidem et cumque. Deserunt quisquam ipsa et inventore distinctio fugiat blanditiis. Sed cumque ea quia minima nesciunt ipsa nulla.', 'Spanish', '239c334e5bd24876f479cc2f1023c21a.jpg', 'intermediate', 0, '161.00', 1, 1, '{\"total_video_hours\":0.5,\"durationHMS\":\"00:42:00\",\"total_articles\":2,\"total_hours\":0.7,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:06:45', '2019-09-26 16:07:16'),
(7, '07fa6d94-7dda-455f-933f-a928117e0f78', 2, 22, 'Et Aut Dolore Consequatur Atque In Illum Enim.', 'Et Qui Voluptas Aperiam Ut.', 'et-aut-dolore-consequatur-atque-in-illum-enim', 'Repellendus ut beatae sed adipisci. Aut voluptas voluptas debitis ipsa. Architecto reprehenderit qui sapiente. Neque eum delectus illo dolor. Quibusdam voluptatum beatae corporis.\r\n\r\nReiciendis hic sit aut rem quibusdam perferendis et. Sunt minima possimus quisquam rerum quo omnis hic. Aut laudantium omnis aspernatur ducimus nesciunt.', 'English', '211b77234ace3e13d5675bb36a8de9a5.jpg', 'advanced', 0, '2.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:18:00\",\"total_articles\":0,\"total_hours\":0.3,\"total_published_lessons\":4,\"total_lessons\":4,\"total_unanswered_questions\":0}', '2019-09-26 16:06:45', '2019-09-26 16:07:16'),
(8, 'c529f5bc-b697-41ea-bf67-81a53fdc26bb', 3, 4, 'Adipisci Nulla Ad Accusamus In Est.', 'Quae Facere Perspiciatis Aut Ut.', 'adipisci-nulla-ad-accusamus-in-est', 'Qui amet quaerat aut cumque ut. Et molestias est aut explicabo vel.\r\n\r\nId suscipit voluptatem perferendis sint itaque. Non sapiente nemo repellendus nostrum repudiandae. Corporis est sed vitae et aut. Ab molestiae reprehenderit aut velit ipsum est consequatur.\r\n\r\nEnim et et ipsa voluptas. Est dolor laborum quasi vel. Est omnis autem recusandae iure vero ad. Ad enim corporis et necessitatibus similique sint. Enim distinctio optio sequi omnis iure sapiente.', 'English', '99d816467acf76dbc324ec040696a55f.jpg', 'beginner', 0, '13.00', 1, 1, '{\"total_video_hours\":0,\"durationHMS\":\"00:36:00\",\"total_articles\":4,\"total_hours\":0.6,\"total_published_lessons\":4,\"total_lessons\":4,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(9, '77dd01b7-7b38-4542-8bc7-01fe4011b0d5', 3, 21, 'Eos Sit Modi Sed.', 'Ipsam Est Illo Ea Quisquam.', 'eos-sit-modi-sed', 'Placeat sint laudantium consequuntur dolorem sequi commodi. Exercitationem ut in ducimus. Harum ut officia non soluta quod.\r\n\r\nLaborum nam ab veritatis qui ullam qui enim. Nihil quia debitis aut quibusdam quos. Molestiae facere culpa soluta sed. Numquam eos sit aut aut alias.\r\n\r\nQuaerat vel odio ex consequuntur. Nulla aut accusamus ea voluptates placeat. Voluptas nesciunt voluptate culpa numquam sunt ipsum dolor. Voluptatem molestias quae voluptate id deleniti voluptatem est totam.\r\n\r\nHic rem dignissimos ullam ut consequatur. Ea et ullam eum enim veniam dolorem. Accusamus magnam fugit dolorem qui repudiandae ut.', 'English', '5045651da37ec50f924fe93a64dba6fc.jpg', 'advanced', 0, '44.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:42:00\",\"total_articles\":3,\"total_hours\":0.7,\"total_published_lessons\":7,\"total_lessons\":7,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(10, '0c5373e3-1064-4583-8b14-f7b48ab00207', 3, 3, 'Sint Et Ipsam Molestiae Eos Non Veniam Error.', 'Voluptates Voluptatem Repudiandae Odio Consequatur Explicabo Omnis Natus.', 'sint-et-ipsam-molestiae-eos-non-veniam-error', 'Enim in ea vel. Ut sit nisi in nulla blanditiis quia laborum voluptate. A sed excepturi laudantium magnam et soluta ut.\r\n\r\nAliquid inventore autem qui corrupti eum sit expedita. Est eaque minus exercitationem nesciunt quaerat saepe neque. Libero est error voluptatem ut ut autem quos quia.\r\n\r\nEst magnam cum sunt rerum ipsam quis. Laborum deleniti eaque hic. Sunt cupiditate ut enim dolorem sit. Ratione aut a consequuntur sunt doloremque. Nam in fuga impedit harum.\r\n\r\nConsectetur quo est qui sint quae. Maiores quod tempore quia dicta occaecati. Dignissimos voluptas praesentium dignissimos iste aperiam voluptatem quibusdam.', 'English', 'd635cb2ca27cf6a7147724bd9cfb4846.jpg', 'all', 0, '56.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:36:00\",\"total_articles\":2,\"total_hours\":0.6,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(11, 'e4bf0f5a-717f-4e66-a1b7-4550cf5ae8d7', 3, 18, 'Nihil Animi Facere Quis Rerum Nihil Odio.', 'Et Voluptatum Voluptatem Saepe Aperiam Nemo Quo Sapiente Suscipit.', 'nihil-animi-facere-quis-rerum-nihil-odio', 'Ut omnis et odio. Ut accusantium fugiat dolor. Nobis ut dolores eum saepe iure esse quasi. Dolorum quaerat voluptatibus id id voluptas.\r\n\r\nLaudantium nemo soluta recusandae alias dolor. Quod aperiam quo quam accusamus sit sunt ipsa fugit. Voluptatem et aut quis laboriosam id vel sit. Qui sed quas aspernatur voluptas.\r\n\r\nRatione necessitatibus totam eum iusto voluptatem nemo rem. Et quam sunt sequi. Quisquam iste cupiditate fugit dolor in quia molestias. Est optio minima velit doloribus dolorem non voluptatem molestias.', 'English', '43174a2dc2eafde92cf8b0671736d641.jpg', 'beginner', 0, '142.00', 1, 1, '{\"total_video_hours\":0.2,\"durationHMS\":\"00:24:00\",\"total_articles\":2,\"total_hours\":0.4,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(12, 'f3686554-43da-49ec-989b-58ead750394d', 3, 22, 'Qui Enim Ut Neque Quia Quia.', 'Et Fugit Soluta Placeat Blanditiis.', 'qui-enim-ut-neque-quia-quia', 'Molestias est itaque assumenda dolorem perferendis. Sequi quia repudiandae repudiandae odio ad modi. Consectetur aspernatur non hic dolor ipsa. Voluptatem quae consequatur adipisci eligendi repudiandae. Ipsam quas aut vero velit asperiores.\r\n\r\nTenetur eveniet autem consequuntur. Qui asperiores vitae atque et repellendus modi fugiat. Tempora dolores perspiciatis sit velit repellendus voluptatem. Omnis illum sint aut et.\r\n\r\nConsectetur excepturi ut labore nobis. Ullam molestias assumenda quis ea molestias. Veniam est est ab sed ut delectus.', 'English', '898c8796d4711bf50e5eb74b646ea503.jpg', 'all', 0, '128.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:36:00\",\"total_articles\":3,\"total_hours\":0.6,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(13, 'f002a9d1-dcf3-41ac-b80b-494c1d46b8ee', 3, 2, 'Voluptatibus Sunt Dolor Rerum Necessitatibus Officia.', 'Dicta Consequatur Asperiores Non Quia Ut Error.', 'voluptatibus-sunt-dolor-rerum-necessitatibus-officia', 'Ea eos consequuntur ut sint. Nobis odio qui illo provident perspiciatis. Quae laboriosam quisquam ea ipsum odio rerum. Odit explicabo molestiae et.\r\n\r\nDoloremque non quia qui accusantium. Molestias inventore quis molestiae rerum esse veritatis ipsam. Totam neque est eos et dignissimos magni. Sed doloribus eligendi molestias autem ab voluptatem porro.\r\n\r\nEt facilis sapiente quas ex quae. Et velit accusamus culpa cumque exercitationem. Suscipit aut voluptates deserunt quod in architecto. Corporis eveniet modi hic autem laborum aliquam blanditiis.', 'French', 'e6eb87f12106113752a5d623836d84b5.jpg', 'beginner', 0, '131.00', 1, 1, '{\"total_video_hours\":0.2,\"durationHMS\":\"00:30:00\",\"total_articles\":3,\"total_hours\":0.5,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(14, 'd1dbfd30-b757-4898-8285-bc337083a508', 3, 23, 'Culpa Aut Dolor Dolores.', 'Perspiciatis Illo Reiciendis Est Impedit.', 'culpa-aut-dolor-dolores', 'Saepe non quo ut dolore numquam. Autem voluptatem suscipit id doloribus vel dignissimos nihil. Aut distinctio autem cumque ut iure.\r\n\r\nLaborum aperiam magnam odit commodi quidem corporis consequatur facilis. Aut illum eaque sapiente aspernatur repudiandae dolore. Rerum mollitia omnis odio nemo.', 'English', '5f3410208dbe130948365f5d3f378670.jpg', 'intermediate', 0, '39.00', 1, 1, '{\"total_video_hours\":0.4,\"durationHMS\":\"00:30:00\",\"total_articles\":1,\"total_hours\":0.5,\"total_published_lessons\":7,\"total_lessons\":7,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(15, '7d96e391-fa6b-47f7-8056-8d4f523185b5', 3, 28, 'Autem Non Non Voluptas Quisquam Aut.', 'Perferendis Qui Expedita Molestiae Tempora Voluptas.', 'autem-non-non-voluptas-quisquam-aut', 'Qui architecto molestias animi consectetur. Ut eos quod ipsa aliquid magni placeat. Ipsa error accusamus vel ex eum eos laborum.\r\n\r\nSequi repellendus cum autem expedita. Eos sit ratione nemo. Vero voluptatum molestiae aut praesentium earum impedit. Consequatur rerum illum dolores non culpa ab consequatur.\r\n\r\nTotam quia cupiditate quod perferendis repellendus autem voluptatem. Ut similique quia sed architecto odio sunt ut. Dolores consequuntur dicta tenetur sint est et doloribus deserunt.\r\n\r\nOdio soluta eaque officiis quis laboriosam. Consequatur iusto aut dolores. Ipsum voluptas quaerat et sit soluta aut illum.', 'English', '7b661004efdfe377332a603bb1c5d90d.jpg', 'intermediate', 0, '42.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:30:00\",\"total_articles\":4,\"total_hours\":0.5,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:06:58', '2019-09-26 16:07:16'),
(16, 'd520bf67-7cfd-4d68-a5f7-e4243df3d3e8', 4, 22, 'Inventore Distinctio Sint Sunt Consequuntur Aut In.', 'Quis Illum Qui Inventore Qui Autem.', 'inventore-distinctio-sint-sunt-consequuntur-aut-in', 'Vero quidem et modi commodi cupiditate. Quia laboriosam voluptatem illo animi. Inventore totam id unde officia vel sunt. Dicta et et architecto est dolorem.\r\n\r\nInventore velit perspiciatis nihil. Vero est recusandae et. Unde ducimus quia expedita rem assumenda similique.', 'Spanish', '885f663afef03496e73709ce4d96740f.jpg', 'advanced', 0, '94.00', 1, 1, '{\"total_video_hours\":0.1,\"durationHMS\":\"00:30:00\",\"total_articles\":3,\"total_hours\":0.5,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:07:05', '2019-09-26 16:07:16'),
(17, 'ca085f73-2832-4202-984c-0923588993dd', 4, 2, 'Sint Totam Odio Animi Vitae Facere Aspernatur Molestiae Velit.', 'Est Voluptatem Consequuntur Quibusdam Ut.', 'sint-totam-odio-animi-vitae-facere-aspernatur-molestiae-velit', 'Commodi sed sint aut amet at est voluptatem. Architecto numquam non architecto id sed nulla doloremque. Debitis ab amet unde fuga dolor voluptas. Est omnis et et possimus ad error et.\r\n\r\nMinima ipsum distinctio beatae accusantium ut deleniti ex molestiae. Aut est minus in facere velit sit voluptas sit. Explicabo et delectus tempora qui autem assumenda aliquid. Illum aspernatur dolores itaque deleniti sed et nulla.\r\n\r\nCupiditate corrupti et occaecati maiores ut. Quo sequi nisi ea voluptatibus quae. Qui magni magnam rerum nostrum. Neque in rem qui est et ut fuga voluptatem.\r\n\r\nEt officiis culpa dolor et quae culpa quas. Error omnis laborum necessitatibus occaecati facere optio excepturi ab. Eaque non explicabo voluptas molestiae veniam. Facilis optio culpa voluptatibus.', 'French', '46511a1f7e053efc52423599f3343853.jpg', 'intermediate', 0, '151.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:24:00\",\"total_articles\":2,\"total_hours\":0.4,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:07:05', '2019-09-26 16:07:16'),
(18, '438a03fa-136e-4d05-ac69-91bf4d4018aa', 4, 3, 'Voluptatum Est Quod Eveniet Officia Id Consequuntur.', 'Aliquid Consequuntur Doloremque Tenetur Ut Sint.', 'voluptatum-est-quod-eveniet-officia-id-consequuntur', 'Eos et et quam in incidunt facere in. Soluta sed sint numquam illum aut. Aut corrupti amet omnis delectus et. Harum labore ab doloremque laboriosam fugit unde sint.\r\n\r\nExercitationem a consequatur ipsa. Sunt perferendis qui maxime quisquam culpa sapiente et.', 'Spanish', '473ce42a66aea9f05ee62ca1ca494955.jpg', 'advanced', 0, '177.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:30:00\",\"total_articles\":1,\"total_hours\":0.5,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:07:05', '2019-09-26 16:07:16'),
(19, '34b3d390-558c-4216-8a36-fa28f00091f1', 4, 22, 'Minima Quia Maiores Reiciendis Accusantium Ducimus Corporis Nulla.', 'Doloribus Tempora Saepe Eos Qui Officia.', 'minima-quia-maiores-reiciendis-accusantium-ducimus-corporis-nulla', 'Sit quia placeat quisquam natus et mollitia beatae et. Quod minus sunt ut dignissimos tempore eligendi. Provident reprehenderit molestiae praesentium culpa id. Qui a qui culpa est. Id omnis aliquam vero eveniet.\r\n\r\nExplicabo dolor maxime magnam sed nobis molestiae perferendis. Exercitationem quis et earum quis et. Est suscipit rerum et et. Ullam dolorem numquam numquam recusandae dolorem tempora. Ex natus dolorem corporis dolor nesciunt.\r\n\r\nDolorem provident exercitationem et dicta saepe. Adipisci itaque sit voluptatum aliquam voluptas sunt omnis. Dolorum ut sunt voluptatem ex dolorem nihil. Facere non at quia dolor expedita exercitationem.', 'English', '4eb8eedf20b694db1e5604770e07ce08.jpg', 'all', 0, '143.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:30:00\",\"total_articles\":1,\"total_hours\":0.5,\"total_published_lessons\":7,\"total_lessons\":7,\"total_unanswered_questions\":0}', '2019-09-26 16:07:05', '2019-09-26 16:07:16'),
(20, 'bd3418e8-3bfd-4da1-b3ae-94678cb70437', 4, 29, 'Quos Delectus Suscipit Reprehenderit Et Id Ad.', 'Alias Numquam Libero Nesciunt Tenetur Aut.', 'quos-delectus-suscipit-reprehenderit-et-id-ad', 'Voluptatum explicabo quisquam iusto perferendis suscipit. Est et deleniti sunt amet dolores. Nihil in delectus nihil assumenda quam exercitationem.\r\n\r\nPerspiciatis quis qui ipsa aliquam velit unde reprehenderit. Aspernatur repudiandae beatae ut. Necessitatibus iste amet perspiciatis perspiciatis dolorem. Quis nihil velit sapiente itaque pariatur laboriosam.\r\n\r\nMaiores commodi et quos et dolore distinctio error tempora. Est commodi facere fugiat aut optio ut distinctio. Enim vel quibusdam voluptas. Molestias sit consectetur facere labore qui sed facilis consequuntur.', 'French', '61201e4e497b32144030c957b3865802.jpg', 'beginner', 0, '123.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:18:00\",\"total_articles\":2,\"total_hours\":0.3,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:07:05', '2019-09-26 16:07:16'),
(21, '80491c46-11dd-4973-93c5-958ea5b278f3', 5, 22, 'Aliquam Consequuntur Ab Et Veritatis Quibusdam Laborum.', 'Quos Non Beatae Nemo.', 'aliquam-consequuntur-ab-et-veritatis-quibusdam-laborum', 'Dolor qui qui voluptatem. Reprehenderit accusamus alias sunt quae praesentium similique placeat.\r\n\r\nNobis quia molestiae quia. Aliquam rerum ex omnis harum. Repellendus corrupti eveniet eligendi voluptatem iure ipsam. Sit enim modi est iure.\r\n\r\nHarum nisi quos tempore excepturi doloremque officia omnis. Voluptatem maiores ad nostrum sed possimus. Fuga hic est non ipsa possimus.', 'French', 'aebfe7ab578ff0aad92a511b54d48368.jpg', 'advanced', 0, '121.00', 1, 1, '{\"total_video_hours\":0.4,\"durationHMS\":\"00:30:00\",\"total_articles\":1,\"total_hours\":0.5,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:07:15', '2019-09-26 16:07:16'),
(22, '4e844243-0726-4fb8-89bf-afd4628c78b1', 5, 20, 'Hic Voluptas Id Est Saepe Maxime Nostrum.', 'Vitae A Laborum Expedita Et.', 'hic-voluptas-id-est-saepe-maxime-nostrum', 'Sint reprehenderit velit voluptatem minima. Commodi nihil et soluta voluptates. Assumenda aut aut sapiente eum dolores nesciunt est.\r\n\r\nQuia nam provident eligendi accusamus consectetur nemo. Qui et dolorem sint ea placeat omnis quae. Et deleniti quisquam illo facere nulla et dolores dolores. Distinctio neque accusamus esse. Dignissimos cum aut consequatur consectetur a corrupti nihil ipsum.\r\n\r\nVoluptatem aut quia voluptas quidem porro totam necessitatibus. Qui et impedit repudiandae repellat voluptas reprehenderit architecto. Dolor sed ex doloremque. Corrupti magnam totam facere corporis a reiciendis quasi.\r\n\r\nQuisquam sint eos non quia et. Alias est dicta quasi. Iure accusantium commodi quia unde vitae sapiente.', 'French', '819a83e69afe83abb28d2246167694b6.jpg', 'intermediate', 0, '108.00', 1, 1, '{\"total_video_hours\":0.4,\"durationHMS\":\"00:30:00\",\"total_articles\":1,\"total_hours\":0.5,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:07:15', '2019-09-26 16:07:16'),
(23, '76cfed64-2b56-47d5-a62d-ed8390890e76', 5, 8, 'Sed Ea Vel Et Nulla Neque Non.', 'Optio Inventore Maiores Beatae Quasi.', 'sed-ea-vel-et-nulla-neque-non', 'Repudiandae et ut quidem itaque voluptatem doloremque. Quidem non beatae quis. Qui sapiente ratione dolore mollitia voluptas iusto. Nulla et quia qui corrupti quo delectus commodi.\r\n\r\nEt facilis veniam deleniti ipsum. Est aliquid qui fuga. Nulla dolor laboriosam quod ipsum cumque.\r\n\r\nQuo vel earum harum. Quo eos quisquam totam sint sit qui. Veniam sed sed qui. Nobis reiciendis eius odit reprehenderit fuga deleniti pariatur.\r\n\r\nIllum nam quia atque dolorem eligendi eaque. Voluptas quod in ab harum quidem ipsum ut. Dolorem consequatur odit nemo ad voluptatum non earum laudantium.', 'Spanish', 'e83b351965b90d3deb5ffe3d08dc3f6b.jpg', 'all', 0, '179.00', 1, 1, '{\"total_video_hours\":0.2,\"durationHMS\":\"00:24:00\",\"total_articles\":3,\"total_hours\":0.4,\"total_published_lessons\":6,\"total_lessons\":6,\"total_unanswered_questions\":0}', '2019-09-26 16:07:15', '2019-09-26 16:07:16'),
(24, '7e8a40ca-6ba6-45cc-8ceb-87b1a4451223', 5, 24, 'Architecto In Ullam Dicta Qui.', 'Explicabo Sapiente Velit Et Rerum.', 'architecto-in-ullam-dicta-qui', 'Voluptatum aperiam laudantium asperiores tempora illum quos sed. Dolor dolor omnis sint velit deserunt incidunt ad. Officiis sit qui qui incidunt sed iure.\r\n\r\nBlanditiis facere quasi aut ipsum in qui aut impedit. Non omnis aut ea similique. Recusandae eos qui explicabo.\r\n\r\nDolores atque et quis. Iusto molestiae quae numquam voluptatem doloremque eius. Odio aut beatae et est est vel. Ipsam laudantium voluptatum dolor ut magnam laboriosam reprehenderit veniam. Excepturi et ut molestiae nulla praesentium minus.\r\n\r\nQuibusdam ut doloribus illum eaque dolorem ullam distinctio. Et illum tenetur esse eos neque sunt velit. Totam vitae minus quia ipsum quasi.', 'French', 'a075cc7640a58b7ec34c1fd313c3c61c.jpg', 'intermediate', 0, '196.00', 1, 1, '{\"total_video_hours\":0.1,\"durationHMS\":\"00:24:00\",\"total_articles\":2,\"total_hours\":0.4,\"total_published_lessons\":4,\"total_lessons\":4,\"total_unanswered_questions\":0}', '2019-09-26 16:07:15', '2019-09-26 16:07:16'),
(25, '34ead754-4b36-4a4d-9575-22fa716f059e', 5, 29, 'Amet Delectus Dolorem Dolor A Rerum Ut.', 'Fuga Velit Sit Adipisci Dolorem Eos.', 'amet-delectus-dolorem-dolor-a-rerum-ut', 'Natus ipsam id soluta molestiae. Vitae adipisci officia eum. Consequatur unde aut quisquam esse nostrum debitis molestiae. Ex corporis officia quae omnis est.\r\n\r\nSimilique sint rerum sint qui. Autem vel voluptas illo dolor et. Quia qui excepturi sit reiciendis atque amet numquam. Porro explicabo molestiae accusamus.', 'French', 'bb2d1aca89511b48822f930053fc334a.jpg', 'advanced', 0, '197.00', 1, 1, '{\"total_video_hours\":0.4,\"durationHMS\":\"00:30:00\",\"total_articles\":1,\"total_hours\":0.5,\"total_published_lessons\":5,\"total_lessons\":5,\"total_unanswered_questions\":0}', '2019-09-26 16:07:15', '2019-09-26 16:07:16'),
(26, '07d9b1fb-4693-4742-b552-199c4ac9edec', 5, 18, 'Quidem Perferendis Fugit Labore Modi.', 'Est Magnam Voluptatibus Ut Repellat.', 'quidem-perferendis-fugit-labore-modi', 'Et facere aut aut debitis doloremque aliquam. Quae voluptas qui tempore est aut. Quos consequatur quam nihil fugit. Officiis sunt magni aut autem ab vel vel.\r\n\r\nDolores numquam odit voluptas et. Delectus sunt sint sapiente blanditiis nihil ipsum ducimus.', 'Spanish', 'bac074211f0495dfbae83752a796fd63.jpg', 'intermediate', 0, '145.00', 1, 1, '{\"total_video_hours\":0.7,\"durationHMS\":\"00:54:00\",\"total_articles\":1,\"total_hours\":0.9,\"total_published_lessons\":8,\"total_lessons\":8,\"total_unanswered_questions\":0}', '2019-09-26 16:07:15', '2019-09-26 16:07:16'),
(27, '02af2484-8914-403a-943c-740160c69ab0', 5, 3, 'Et Voluptas Delectus Culpa Et.', 'Quasi Et Ipsa Vel.', 'et-voluptas-delectus-culpa-et', 'Et aut qui magni dolorem. Blanditiis et qui consequatur optio ipsa et. Exercitationem rerum ex molestias accusamus. Dolores nisi quod earum cum eum hic excepturi natus.\r\n\r\nIn facere laudantium porro sed officia totam et. Dolor dolorum suscipit minima sint provident.', 'French', '16b9cd9e1535f64c47d40ff2ad7ab8ae.jpg', 'advanced', 0, '109.00', 1, 1, '{\"total_video_hours\":0.3,\"durationHMS\":\"00:48:00\",\"total_articles\":4,\"total_hours\":0.8,\"total_published_lessons\":7,\"total_lessons\":7,\"total_unanswered_questions\":0}', '2019-09-26 16:07:15', '2019-09-26 16:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_targets`
--

CREATE TABLE `course_targets` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `type` enum('requirement','what_to_learn','target_student') COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortOrder` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_targets`
--

INSERT INTO `course_targets` (`id`, `uuid`, `course_id`, `type`, `text`, `sortOrder`, `created_at`, `updated_at`) VALUES
(1, 'e0e90365-f991-4052-880a-828f6b691109', 1, 'requirement', 'Eveniet architecto qui ipsa qui quasi ea similique quisquam.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(2, '3714ab4a-3c40-4795-85b3-f5c174ec07cf', 1, 'requirement', 'Illum soluta pariatur non dolor aliquid corrupti.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(3, 'a3c40487-3175-4aa4-a8ef-ce2a2a927d6f', 1, 'requirement', 'Repudiandae aut amet et eos quis.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(4, '5f1ae0b0-dcab-479c-90b3-683a53b771c8', 1, 'requirement', 'Tenetur quia et impedit maxime consequatur doloribus cum.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(5, 'f429511c-e232-47a1-8c2e-e2fc393a0a30', 1, 'target_student', 'Est natus sit et ea consequatur.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(6, 'ce6ae714-71ca-4250-950b-8ccd750e6266', 1, 'target_student', 'Doloribus nemo facilis quas soluta.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(7, 'ccf186ef-7e29-4529-89c2-466db7ca4a94', 1, 'target_student', 'Architecto atque facilis esse officiis eum ut ad quo.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(8, 'bd3329e2-0748-415a-a3c5-d8931611a98f', 1, 'what_to_learn', 'Placeat tempora labore at natus facere ducimus est.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(9, '3cb07ecc-7c6c-49d0-ab69-5e43afabd8d4', 1, 'what_to_learn', 'Veniam laboriosam et cum blanditiis odio numquam.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(10, '79d0e833-db20-469e-9afa-1ff066442fdd', 1, 'what_to_learn', 'Minima quo officia tenetur et.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(11, '0fda28b1-b474-42f3-bdd9-2c31f21deb42', 1, 'what_to_learn', 'Libero fuga maxime aut eos sit reiciendis quia.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(12, 'b0b722da-336b-46ba-a22f-12eb7fbe43d3', 2, 'requirement', 'Magni dignissimos eligendi occaecati quisquam fugiat tenetur.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(13, '01a4ac15-a223-40ef-87d3-b7f91f3ba4dd', 2, 'requirement', 'Pariatur consequatur quae sit est quae vel facilis.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(14, '7e8fc6ed-0c3d-4a30-bec9-2db1f3cbbcb4', 2, 'requirement', 'Illum non voluptatum et.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(15, '82b4f5f7-e85c-464d-9d20-1171a5d363c3', 2, 'requirement', 'Praesentium eligendi et maiores minima ab.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(16, 'dddfbfee-58dc-4edf-b519-0442964c0189', 2, 'target_student', 'Id doloribus temporibus quidem architecto fuga debitis deserunt.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(17, '2b95c88c-fcb1-4531-bfef-1510c4163202', 2, 'target_student', 'Facilis amet nam sint at amet autem est.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(18, '8e6408f5-c3e8-4e41-abae-6fcdf73cebe4', 2, 'target_student', 'Iure ut officia eos suscipit nemo.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(19, '9ac8b54d-9cda-49b0-979b-522e35850547', 2, 'target_student', 'Quia qui odit consectetur.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(20, '4ae75c76-b5c2-4610-8df6-eefbeaa46c27', 2, 'what_to_learn', 'Voluptatem et laboriosam vero et.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(21, '31ae9956-f89a-4197-a648-c2e1c5969178', 2, 'what_to_learn', 'Non eveniet quisquam dolorum aliquid.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(22, 'a69658f2-5c8b-47aa-8bbd-cb0a34241567', 2, 'what_to_learn', 'Molestiae consequatur in culpa et.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(23, '00217c36-0bbb-4c2c-8e38-c3c068f64932', 3, 'requirement', 'At culpa quis vero enim consequuntur.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(24, 'aa1dd1b7-3be8-4ee8-863e-0015d486af18', 3, 'requirement', 'Modi ex veritatis eum ducimus sunt non.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(25, '0c68e32c-de4b-40e6-a402-b20b1e9e4780', 3, 'requirement', 'Qui corporis qui quas consequuntur nihil.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(26, 'ac3b2f30-a49e-4e12-a3f0-cc1b2c399c54', 3, 'requirement', 'Et distinctio consequatur eum illo quidem omnis.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(27, 'dece9e7c-cf48-4b40-8470-db691d7ac554', 3, 'target_student', 'Laboriosam nihil error aspernatur aut.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(28, '8c841a90-d314-4cb9-adba-e4a59179a141', 3, 'target_student', 'Voluptate nulla aut veniam libero vel inventore molestias.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(29, '8a956261-6fa0-4197-9134-958622094198', 3, 'target_student', 'Recusandae ullam in et vero ut.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(30, '98521b02-9f47-4612-b109-95b8dfec197f', 3, 'target_student', 'Deleniti laboriosam deserunt iusto.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(31, '33c05ad5-738d-45fc-bca8-8f176c2331b5', 3, 'what_to_learn', 'Quo quaerat nisi distinctio voluptas.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(32, 'd1cf960b-b834-4816-8fb6-792e90cc41db', 3, 'what_to_learn', 'Enim modi reiciendis est et exercitationem et dolores in.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(33, '5b1ab725-cd9c-4d18-8a29-303e02286b43', 3, 'what_to_learn', 'Voluptatem voluptates hic molestias.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(34, 'd0236ae5-e9d9-4ce5-9039-e8a05e0fc766', 3, 'what_to_learn', 'Tempore vel ex velit.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(35, 'd0f514f5-d085-4d11-8ca4-903c78de8a2f', 4, 'requirement', 'Suscipit sequi explicabo porro voluptas asperiores.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(36, 'b7ff27e1-a79c-4ec6-9a31-d1f6854b95e2', 4, 'requirement', 'Rerum dolore nihil facilis delectus consequatur.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(37, '8654a661-15a2-4804-ae96-bc2e6c69fca5', 4, 'requirement', 'Deserunt voluptas molestiae ut tempora aliquam.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(38, '780dde87-078f-4449-a6e2-6c284a5626a9', 4, 'target_student', 'Voluptates eum fuga itaque dolorum voluptatem non.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(39, 'b47c0d98-661c-438d-a230-9c51fcda059d', 4, 'target_student', 'Sunt eligendi qui labore perferendis.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(40, '719ed242-c415-4e93-afa1-a53771bbf0ae', 4, 'target_student', 'Facilis ex amet quia.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(41, 'c14e418b-da5d-489e-bd85-2dcc6084d82b', 4, 'target_student', 'Magni excepturi aut cum minima.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(42, 'b55014a2-b4e5-4b05-908b-7d9c1ad7124f', 4, 'what_to_learn', 'Quo eos quis amet consequatur natus rerum ex.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(43, '032efaf5-e21c-4a32-a631-2fca5e445916', 4, 'what_to_learn', 'Voluptatum iusto quo molestiae nisi.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(44, '72fdc72d-b2cb-47bd-8911-6ba0882133cf', 4, 'what_to_learn', 'Quia voluptate dignissimos maiores quis illum commodi voluptatem.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(45, '04e3a1bb-13a6-4ad5-879c-5a1c34ba850d', 5, 'requirement', 'Vel tenetur et ex deserunt impedit illum beatae.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(46, '1e240442-fb45-4aa7-a5c1-337ba736205e', 5, 'requirement', 'Distinctio sint aut dolorem voluptate praesentium voluptas.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(47, '47c7b92f-3171-4340-b966-a0fec8da575f', 5, 'requirement', 'Quisquam ratione ipsam natus eius animi quas.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(48, 'eb063310-7f1f-4967-adbb-cdc8945300b2', 5, 'requirement', 'Ea fugiat ipsum magni quasi nam et.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(49, '24a3a2ad-0537-476f-9d4f-29e99e21dd05', 5, 'target_student', 'Expedita consectetur provident dolor aliquid error natus illo corporis.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(50, 'ed596f52-2828-47d1-a962-fc41235637b8', 5, 'target_student', 'Sint non rerum quibusdam at officia dolorem.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(51, '0dd5deb0-1526-473a-bbef-e8ca5c550d88', 5, 'target_student', 'Atque sint aperiam vel aut debitis quis quasi.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(52, 'a5d84cba-9600-4ba6-bab0-f5779236347b', 5, 'what_to_learn', 'Est est a nam delectus sapiente dolor quisquam culpa.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(53, '532fb23b-93af-4b0a-93e3-6cf1a55bc218', 5, 'what_to_learn', 'Libero eum cum voluptates corporis.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(54, '92c0ef14-7e75-4550-a069-93c47583c92c', 5, 'what_to_learn', 'Explicabo quas commodi minus quia.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(55, '5a74435f-721a-4d10-ae9e-4067ccb5a2ea', 5, 'what_to_learn', 'Recusandae expedita voluptatem quam quisquam blanditiis minus qui.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(56, '9b83692c-b911-43de-9c09-b8e6b1a20acb', 6, 'requirement', 'Autem aliquid et architecto consequatur.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(57, 'be1a7a1e-067b-416f-b2b7-d16ea214f615', 6, 'requirement', 'Tempora eius reprehenderit voluptas reprehenderit.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(58, '46302f80-7cf9-416f-806f-c740dccc917e', 6, 'requirement', 'Aut cum cupiditate culpa itaque voluptatem ipsa accusantium.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(59, 'efe3ab56-992a-4257-ba45-fed2fcedc4c1', 6, 'requirement', 'Quae autem iste modi impedit impedit.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(60, '9cf7e917-fe62-4e84-986c-a34616608263', 6, 'target_student', 'Aut et quibusdam qui fugiat laboriosam esse delectus enim.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(61, 'a4521a3b-70dd-4f4d-bbf8-cb038268cf4c', 6, 'target_student', 'Velit sed ullam ipsum molestiae maiores aliquid architecto.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(62, 'fa47808f-82e5-407e-a4e3-6036343e120a', 6, 'target_student', 'Reprehenderit fuga delectus et in qui.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(63, '8a6b99e2-8fe2-4d79-8b55-91ff8d702675', 6, 'target_student', 'Rerum non fugiat soluta voluptas totam labore.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(64, '3da0ab47-0660-4cbc-9286-9636596f5a55', 6, 'what_to_learn', 'Tenetur ratione et nobis delectus maiores.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(65, '848ab49b-16f9-4ba2-acff-343383ddfaa2', 6, 'what_to_learn', 'Maxime veniam dicta iste sunt.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(66, '50035a20-9761-4be8-8db2-1017a291ac4f', 6, 'what_to_learn', 'Sunt quam ratione eum rem.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(67, 'bbf6aa70-c2c1-4400-a865-63075f76e88b', 7, 'requirement', 'Vel amet temporibus vel et perspiciatis ipsa sed cum.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(68, '30b9816c-62ae-4442-9c04-29c4225d9ce8', 7, 'requirement', 'Vel assumenda possimus quasi officiis aut et.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(69, 'bd692f2c-8c71-4e9e-a982-5b80e9ca07cd', 7, 'requirement', 'Magni culpa id corrupti facilis minima modi illo.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(70, '81db3013-0494-40f4-ad3f-66a207f3e2f9', 7, 'target_student', 'Voluptatibus voluptas quisquam quia qui ipsam.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(71, 'a8328da3-280e-457f-85c1-9fac8f3e87b5', 7, 'target_student', 'Hic incidunt est voluptatem recusandae labore exercitationem.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(72, '3ecdc4f1-95af-487c-85e7-9c9fcef3d3d0', 7, 'target_student', 'Fugit qui dolorem impedit a.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(73, '70bfcc07-9f2a-4b22-aab7-74d5f69fafd9', 7, 'target_student', 'Id id cum et.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(74, '2bfbde3c-eac5-41ac-b004-f2f519c030b9', 7, 'what_to_learn', 'Eum ratione suscipit aut perspiciatis veniam.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(75, 'cb5da8f9-60b1-4f33-a005-f502c3ec6d99', 7, 'what_to_learn', 'Vitae exercitationem eligendi ut nemo aut.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(76, '94dd8798-45bf-435e-9865-0aa3f70ea425', 7, 'what_to_learn', 'Placeat quo quidem nihil voluptas assumenda nam.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(77, '1fd66f76-562e-47fd-8c21-c20c0ad51097', 7, 'what_to_learn', 'Tenetur aut est sint atque unde culpa qui.', 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(78, '28168d0a-99ee-4c18-a93e-d55ced02c842', 8, 'requirement', 'Aut molestiae esse aliquid qui.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(79, '49316a05-1ef9-450f-9744-3dce5f2e7e3c', 8, 'requirement', 'Aliquam rem recusandae maiores est animi repellat ab.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(80, '958657f5-6ab0-41b7-b70b-e91be0c3d3c0', 8, 'requirement', 'Totam nihil sed ducimus dolorem animi eum.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(81, '9516d50e-2ce7-47cd-926b-77f1de98330f', 8, 'target_student', 'Qui error impedit blanditiis veritatis eaque.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(82, '5f92f234-1a64-4f9b-b5b4-d65134063927', 8, 'target_student', 'Id quia autem aut nisi in alias.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(83, '4c2c2f28-be57-4efd-b541-8e16b96f5c1b', 8, 'target_student', 'Amet est cupiditate quia eaque.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(84, '871d4b0a-7119-4f86-8c91-077269bfa277', 8, 'what_to_learn', 'Rerum quia ducimus id.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(85, '44b72e61-42d8-4cf6-a04e-e978e31e7bda', 8, 'what_to_learn', 'Earum et ut voluptatem perferendis necessitatibus vitae corrupti voluptatibus.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(86, '5196befc-8e28-4ce5-bb2e-98e32e799a6c', 8, 'what_to_learn', 'Nulla ut iure voluptatem.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(87, 'd0565c8d-b6ce-461a-99f0-987ad1f200e3', 9, 'requirement', 'Nobis enim et architecto amet rerum et.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(88, '02e7f64b-1162-4908-9242-e6fa7ab4bca6', 9, 'requirement', 'Possimus nam sapiente enim corrupti facilis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(89, '471227d7-e2d1-4d00-ab7e-e385eb2503a3', 9, 'requirement', 'Qui magni ut voluptatem vel est.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(90, 'f57d17d8-3800-403b-b1ab-c3504bbafe11', 9, 'requirement', 'Qui in deserunt vel.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(91, '7344f202-4bba-4d5c-bf06-3e96e3a460aa', 9, 'target_student', 'Exercitationem voluptates eius illum modi.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(92, 'a3647722-9b05-4faf-bab3-b693d257272f', 9, 'target_student', 'Sit veritatis quam eum quibusdam officiis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(93, '7447214c-223d-4203-ae96-9c0ff5382776', 9, 'target_student', 'A delectus porro itaque deserunt magnam reiciendis iusto voluptate.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(94, 'b5092478-6988-424d-abef-c9d64f9d12ce', 9, 'what_to_learn', 'Autem doloremque unde magni sit.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(95, '6ff60b81-141a-44af-8ae1-824632bdefc4', 9, 'what_to_learn', 'Libero provident molestias illum quaerat in.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(96, '89c4fcbe-330f-4537-afdd-a69c38df3aa5', 9, 'what_to_learn', 'Itaque cupiditate molestiae eos ut impedit.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(97, '6fb78b00-6fe4-44aa-bbb8-a900c34963af', 10, 'requirement', 'Debitis ratione quo vero doloremque reiciendis reiciendis facilis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(98, 'd38a049d-2f76-424f-8b1b-2424ea6bef75', 10, 'requirement', 'Autem alias adipisci voluptatem aut sapiente praesentium incidunt.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(99, '0758a597-d009-42b0-9b1f-abab232cc3de', 10, 'requirement', 'Hic eligendi quis repudiandae eaque aut distinctio omnis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(100, '40105569-775e-4000-ba39-02c0713a0dab', 10, 'requirement', 'Fugit qui quasi nesciunt dolor sunt.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(101, '5d1cbfdc-1dfa-4cd9-8c64-d5152fcd7ff2', 10, 'target_student', 'Est possimus explicabo dolorum quod.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(102, '0321c783-ab60-461b-b0fb-cfebaaf7060c', 10, 'target_student', 'Ut qui autem et.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(103, '3992d6cc-58ff-4ac9-93cd-3ad7553feb41', 10, 'target_student', 'Ipsum labore dolores sed nemo facilis et dolorum.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(104, '86db36d9-e3bc-44f0-ac33-d64512624922', 10, 'what_to_learn', 'Beatae porro amet voluptas voluptatem.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(105, '2e06af9b-3f83-4744-8a2a-f1941452d1fc', 10, 'what_to_learn', 'Neque eaque odit doloribus soluta est.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(106, '0bdaa15f-9def-47aa-8e83-ca60d9a0da13', 10, 'what_to_learn', 'Est minus consequuntur deleniti et.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(107, '1d60e609-9b42-489e-9f2e-a90e8d6eec0f', 11, 'requirement', 'Est delectus et qui.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(108, '580482c3-8e67-4196-ab57-fde540e5deb9', 11, 'requirement', 'Deserunt aut unde animi quo repellendus.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(109, '46cf2f9b-ede0-4917-ad46-6d0f00efc4a9', 11, 'requirement', 'Deserunt omnis distinctio doloremque in.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(110, 'be2ae56f-bbc6-481c-91e2-3b0e08570b4a', 11, 'requirement', 'Itaque rerum perferendis magnam optio nobis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(111, '7cf3e20c-311a-4a1c-b55f-63ead4123761', 11, 'target_student', 'Perferendis nesciunt non harum et unde placeat.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(112, '38b3fd01-ab68-4295-8f79-a1f17716e440', 11, 'target_student', 'Quia enim velit et molestiae quidem possimus.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(113, '5aecbbbc-16b3-4f6a-bf1d-735f86b2531c', 11, 'target_student', 'Placeat in harum magnam et voluptates quis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(114, 'b598a1ee-8ca9-4d42-a5ef-fa84cc96b82a', 11, 'target_student', 'Reiciendis non dolores assumenda omnis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(115, '80ebf7c8-343b-418e-ac6a-0b2de8c0582d', 11, 'what_to_learn', 'Quibusdam nam eveniet facere et labore.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(116, '9c78c686-7f72-4a01-af85-4946f01c95e3', 11, 'what_to_learn', 'Exercitationem ipsa quas cupiditate quisquam dolore.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(117, 'b1d66d73-e094-4a84-9517-1e5307468450', 11, 'what_to_learn', 'Et ducimus facere illum sunt.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(118, '1c7ca2db-7b2d-4c7f-a57a-b0eb32dc1e94', 12, 'requirement', 'Non sequi quam temporibus sed.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(119, '80509030-8856-4d57-8261-2e762e9140dd', 12, 'requirement', 'Facilis dolor error ut natus.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(120, '278ca2ba-8c95-474b-b5ca-99f99b274853', 12, 'requirement', 'Dicta ut doloribus nam.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(121, 'd709a20c-1d80-4552-befd-a51a85b80703', 12, 'target_student', 'In sint soluta voluptatem voluptatem qui.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(122, '281fa47d-d19e-43fb-8d05-8dafda59b813', 12, 'target_student', 'Et delectus voluptate et rerum alias.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(123, '5f97565a-f89c-4c7f-9d1d-9d3dddbe0fdf', 12, 'target_student', 'Labore unde sunt veniam.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(124, '2edf7d5a-30fd-4efe-89ef-d52e5f8725df', 12, 'target_student', 'Necessitatibus dolore ullam distinctio tenetur aut aliquid dolores similique.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(125, 'eddfbc2e-65f4-4044-8416-ed5865d803ef', 12, 'what_to_learn', 'Quis inventore vitae alias consectetur in corrupti eligendi.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(126, '98ede1a6-7511-41bb-817f-2f1cd78365eb', 12, 'what_to_learn', 'Amet qui adipisci quia rerum iure.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(127, '8ab8da2a-5c9b-45da-bcf3-1f13197d912e', 12, 'what_to_learn', 'Voluptas quaerat occaecati quisquam molestias.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(128, '42255343-6ea4-437d-82a4-cfde858185df', 12, 'what_to_learn', 'Facilis illo voluptas tempore harum deleniti autem alias possimus.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(129, '85756451-32de-46e3-a0d6-aed0f5872cbc', 13, 'requirement', 'Ut doloribus autem est dolores tempore et.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(130, '066e1d66-ce1a-4845-abf6-755f4378cee0', 13, 'requirement', 'Soluta accusantium aut ullam voluptatum sed ex.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(131, 'f342ffe6-d008-4239-92b9-292e9bf54d91', 13, 'requirement', 'Quisquam perferendis aut sunt doloribus.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(132, '3c0885e0-7da3-4337-8557-e6378baf7d8f', 13, 'target_student', 'Et delectus iure cum voluptatem omnis voluptatibus.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(133, '1735e296-3056-4187-8aa2-2eb473b11aab', 13, 'target_student', 'Harum laboriosam quis reiciendis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(134, '078b7613-4381-45b6-88e4-e944d3f85126', 13, 'target_student', 'Ut debitis qui quaerat pariatur omnis omnis aut.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(135, '7dce90e1-00a3-4097-85a9-7642373e027f', 13, 'target_student', 'Expedita excepturi minima est nesciunt eius provident.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(136, '5388c6ff-1227-4d25-aae5-226162680d91', 13, 'what_to_learn', 'Molestiae consequuntur sed magni et fuga non.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(137, '81c79838-7489-4679-a930-05882045cd1b', 13, 'what_to_learn', 'Aut enim ut suscipit explicabo praesentium suscipit corporis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(138, 'cbafff53-9616-4d2e-8fb5-0982078a60d3', 13, 'what_to_learn', 'Labore repellendus deserunt aut voluptatum est impedit porro.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(139, 'a70d7acb-6717-4c08-a857-c843e26e0d51', 13, 'what_to_learn', 'Et officiis omnis vitae.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(140, '995af93a-873a-49e5-b824-ba7d3c9bad34', 14, 'requirement', 'Eligendi ullam dolorem aut magni omnis.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(141, '42778523-e8a8-47da-b8cd-c39ebfceb807', 14, 'requirement', 'Numquam necessitatibus ipsa sequi.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(142, 'c3318f3d-293f-4629-aaa4-af2935ddcd95', 14, 'requirement', 'Iure maiores consequatur quibusdam consequatur dolor.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(143, '14f1af56-08eb-4281-ae62-d0ac0ab9f9af', 14, 'target_student', 'Nihil ut aut velit at non ab earum.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(144, 'b90f7089-7884-481a-88ea-8527fa8c69d2', 14, 'target_student', 'Beatae et et vel doloremque quibusdam modi.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(145, '3f62383a-55ea-459b-ab6d-0c53aa8bf59b', 14, 'target_student', 'Ut laboriosam eos dolorem ducimus molestias atque eaque.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(146, 'ea93ae05-b3fd-4a65-82a6-3958f89835e1', 14, 'target_student', 'Natus omnis ipsa sit.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(147, 'd153e51b-03bd-4cec-9d79-2b3551a46434', 14, 'what_to_learn', 'Doloribus illum aut temporibus sit.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(148, 'fa9cfb58-16e6-4288-a898-e5184adb4751', 14, 'what_to_learn', 'Eos officia enim et id.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(149, '50e7d498-f606-4efe-85af-7c30577a0693', 14, 'what_to_learn', 'Quas maiores odit blanditiis nostrum laudantium.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(150, '2702c6a7-43ab-4c92-8643-95a2dbce9f07', 15, 'requirement', 'Quia sed similique debitis in alias.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(151, 'b2154a24-52ea-45b5-be31-4e7f5b424b26', 15, 'requirement', 'Maxime laudantium qui tempora.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(152, '1e72b380-87ec-4024-b799-f5a4fa44e34e', 15, 'requirement', 'Harum incidunt sequi culpa fuga est quod non.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(153, '3683ca6c-d1c9-4f21-84c0-a59ec599edc0', 15, 'requirement', 'Sint voluptatibus totam necessitatibus illum repellendus est ea commodi.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(154, 'c853d8b0-11d7-4cda-b56b-514ac81d9672', 15, 'target_student', 'Explicabo et rem tempora iure quidem qui.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(155, '6fd7c179-100c-4f75-ada2-78e46300cf99', 15, 'target_student', 'Enim quia at doloribus accusantium qui asperiores.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(156, 'b191c59f-9f65-4de8-aa82-df935dea1e6d', 15, 'target_student', 'Voluptatem quibusdam earum est nulla dolorem qui dolorem.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(157, '073d2e78-5161-48c8-9d2d-cc8bedcf1d80', 15, 'what_to_learn', 'Nam atque voluptatum eos voluptatem dicta consequuntur consequatur saepe.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(158, 'b4f3bb89-3cf1-47b3-9d34-386e9bb9b01c', 15, 'what_to_learn', 'Architecto id vel architecto.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(159, 'b82f7883-023b-4308-b6d1-05eebea029e5', 15, 'what_to_learn', 'Eos atque fuga quia id.', 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(160, '1c7390ee-2d4b-4573-96bd-65048ab30153', 16, 'requirement', 'Quaerat a qui voluptas nesciunt quibusdam nostrum ea.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(161, '227db4ad-8048-4ed8-8b4e-c92d998cc957', 16, 'requirement', 'Nam perferendis voluptas sit ut.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(162, '4472607c-add3-4c74-aa45-90e7335a975c', 16, 'requirement', 'Sed aliquam non aut.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(163, '3a161e2d-29ec-4377-8dc9-ee5d1c0c07ae', 16, 'target_student', 'Molestiae iste non doloribus enim fugit in repellat.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(164, 'e51acc91-410c-4bc8-8ed1-404d0f63c554', 16, 'target_student', 'Sunt in eos atque quibusdam.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(165, 'cc48fe72-2bb0-4e60-873e-dd18d6270168', 16, 'target_student', 'Suscipit sit autem pariatur voluptas quod.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(166, 'd0d36d1b-1ec2-4cb2-80bd-faf5bd2b2417', 16, 'target_student', 'Minus harum quo placeat pariatur.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(167, 'c1ae6b57-46e4-4345-b542-773d413c57be', 16, 'what_to_learn', 'Iure commodi et aperiam.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(168, '90794224-843b-491b-8f8b-3c42d43835c1', 16, 'what_to_learn', 'Itaque et corporis atque aut similique.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(169, 'cbacaff6-3de0-41de-9971-f1c1269a766a', 16, 'what_to_learn', 'Ullam accusantium quibusdam laborum deleniti fuga dignissimos modi.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(170, '625f7f2a-ae85-41ea-9ba5-6c99e371bcc7', 16, 'what_to_learn', 'Rerum laudantium atque fuga voluptatum voluptas sunt.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(171, 'd6e87493-7ba9-4292-a21d-73d5fb7d921c', 17, 'requirement', 'Dignissimos rem quas dolores id.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(172, '89bf3e6c-ade5-44b4-9e67-06b47f3ae10e', 17, 'requirement', 'Earum amet natus nisi.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(173, '6558062c-d8fc-40f4-af15-271ed87bc7cc', 17, 'requirement', 'Laborum et quis nisi pariatur.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(174, '8cd76e9d-2d55-489e-bce8-053768cace85', 17, 'requirement', 'Quibusdam ut iste hic mollitia.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(175, '0e53633a-5e51-409e-ae36-3222a16dcd21', 17, 'target_student', 'Quae in est est.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(176, '487b6d37-7fa8-436b-8dd3-bcc46dd28ffe', 17, 'target_student', 'Qui repellat doloribus harum voluptatibus qui quos quia.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(177, '68e498e2-e46d-4782-8467-8d2cf59d6d77', 17, 'target_student', 'Maxime voluptatem molestias sunt.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(178, 'b5d45baa-69fa-4aa3-be5a-6172eb766607', 17, 'what_to_learn', 'Id officiis voluptatem assumenda aut illum consequuntur.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(179, 'f921af32-66c5-482b-997e-ce0d698eb7e6', 17, 'what_to_learn', 'Nam velit veritatis praesentium asperiores.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(180, '03870964-8fc1-4783-9fae-28f4f894c8cf', 17, 'what_to_learn', 'Voluptas voluptas labore at eos ut.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(181, 'ac8cf480-bc2c-4eaa-b6f7-01cf6450ebc2', 17, 'what_to_learn', 'Hic impedit quis quia praesentium et enim ad.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(182, 'f2d5fdac-871d-4740-b091-947a67bf6558', 18, 'requirement', 'Dolorem hic autem nesciunt est.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(183, '17f715d0-2dec-4dc8-8cea-7169bd925429', 18, 'requirement', 'Quae officia ab dolorem ut.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(184, '050fa639-d766-4e3c-b1ef-b71149561f04', 18, 'requirement', 'Consectetur ut dolorem doloremque voluptatem possimus quisquam.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(185, '72a86186-272c-4490-ac7d-e25301ec5758', 18, 'requirement', 'Perspiciatis qui assumenda corrupti esse fuga aut molestiae.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(186, 'daf85b92-cf55-486a-bae4-f9f04c281016', 18, 'target_student', 'Totam repudiandae culpa repellat sequi et doloribus.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(187, 'ae34fc90-c070-4278-8e87-d62f9b945991', 18, 'target_student', 'Aut est placeat sed omnis voluptas ex.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(188, 'ae03cb97-9b98-4889-82ae-71b1d61ffe49', 18, 'target_student', 'Amet deleniti eum cum eos facilis.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(189, '55aafeda-2ffe-4359-abcc-ece6f6fcf2b3', 18, 'what_to_learn', 'Temporibus ut qui quaerat ullam.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(190, 'def049f3-9c36-44c0-bec5-360123c3dd3a', 18, 'what_to_learn', 'Facilis ex reiciendis ut ut quia ea.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(191, '9be17d71-5eb9-4720-a6b5-16bf485364fb', 18, 'what_to_learn', 'Et necessitatibus mollitia ullam est et placeat.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(192, '2ae9d40c-3156-4dc2-bfd4-703ec677c5e3', 19, 'requirement', 'Earum voluptatibus enim hic veniam consequuntur non.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(193, 'de9c972e-c946-4edd-8165-507928511d00', 19, 'requirement', 'Et qui ducimus quas.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(194, '893b697d-ac48-4523-b442-067bae7aa8a6', 19, 'requirement', 'Asperiores odio ratione aut quae.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(195, 'e5566024-4997-416f-a27a-5e726930770c', 19, 'requirement', 'Temporibus maiores mollitia fuga sit est quaerat.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(196, '983a817b-9686-4368-b8e7-ecf52c436d9e', 19, 'target_student', 'Quasi voluptatem asperiores quia quidem maxime.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(197, '43b2a40c-e549-4748-a392-252e8ca9592c', 19, 'target_student', 'Optio nobis odit et sit sit.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(198, 'f8dba042-b8c9-47f2-98f5-09fbc3166f6c', 19, 'target_student', 'Impedit suscipit omnis atque cupiditate ullam ut ut reprehenderit.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(199, 'aae3aceb-db2c-4fcd-b732-1795d4a80b96', 19, 'what_to_learn', 'Facilis omnis provident officia est.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(200, '63146262-4420-4241-b32b-efd16b36060c', 19, 'what_to_learn', 'Nihil assumenda reprehenderit aut nobis omnis.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(201, 'a175ff5f-78f2-4e8d-b2d7-dd2360c00272', 19, 'what_to_learn', 'Molestias cumque hic culpa ad.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(202, 'a941f7b2-80c6-472d-a189-2388482a96ca', 20, 'requirement', 'Id sunt blanditiis perspiciatis modi quos iusto.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(203, '101c42b8-7260-4478-9fb1-91b96f736e77', 20, 'requirement', 'Est totam eum eos aperiam eius.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(204, '2989cdfe-2311-4912-bca2-26d142267f93', 20, 'requirement', 'Qui voluptate consequatur quia perspiciatis.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(205, '50c15f0a-de1a-4a58-a028-bf1a91ffa7ca', 20, 'requirement', 'Ut velit sit maxime dolorem quas ipsam perferendis.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(206, '695579c1-5ed6-48f8-97d8-e76bb3b2fe02', 20, 'target_student', 'Odio sunt tempora eaque pariatur placeat illo ut expedita.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(207, '289f401b-ab63-465d-a52d-f345a69390e3', 20, 'target_student', 'Veritatis consequatur facilis veniam quis qui reprehenderit.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(208, 'fd73fb62-9be0-4b82-8ede-4d9e5f52d8a0', 20, 'target_student', 'Cum sit aut quisquam et accusantium necessitatibus tempora.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(209, '30b15f68-2a27-4f45-94ef-a52d88a605ad', 20, 'target_student', 'Ipsa quia labore eum culpa deserunt quia eos in.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(210, '87e8239a-f583-418c-8915-26bf3c583be5', 20, 'what_to_learn', 'Quibusdam rerum sunt repellendus aspernatur.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(211, '29586c2e-1079-403c-a3ce-f4c82b86e6fe', 20, 'what_to_learn', 'Recusandae rem doloremque rerum.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(212, '68f347a9-6a9f-49b8-acac-21ede6626f9b', 20, 'what_to_learn', 'Odio accusamus tempora eaque ut.', 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(213, 'eb8c0bf8-cded-4915-b11e-face0ffbf703', 21, 'requirement', 'Ipsam dolorum repudiandae saepe aspernatur iure voluptatibus sequi.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(214, '12313fe4-6b80-4fbf-b700-b2cd9512242b', 21, 'requirement', 'Laudantium omnis expedita et iste vitae.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(215, 'e95f0819-0716-4aef-890e-294861fda1e2', 21, 'requirement', 'Debitis dolores ipsam unde qui quibusdam.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(216, '09cce9e3-c650-4fdf-8d3b-5b3009a55f5c', 21, 'target_student', 'Veniam commodi sit omnis.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(217, '49491a6c-6a94-4f7f-b093-262fbae74745', 21, 'target_student', 'Suscipit aut doloremque ipsa inventore sed atque omnis.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(218, '38d0c66c-d363-4a67-9d21-f12e62b96de9', 21, 'target_student', 'Deleniti magnam pariatur consequuntur natus et officia.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(219, 'd8fe5c33-23d7-4aaf-9232-c4b6a989215c', 21, 'what_to_learn', 'Earum iste quam voluptas cumque.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(220, 'b19d2004-f1cd-40e1-910d-d8b1bad06c5b', 21, 'what_to_learn', 'Odio dolorem aspernatur eaque consequatur officia autem molestiae.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(221, '5fa2b91c-ff66-472a-92f8-ced473d64501', 21, 'what_to_learn', 'Illo libero perferendis quaerat qui.', 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(222, 'a672b6a3-8eef-4adb-a49b-9ff2732d31ff', 22, 'requirement', 'Pariatur ab explicabo tempore autem dolor ipsa inventore.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(223, '7f30f282-7a0e-481d-8544-57aaa6cc5240', 22, 'requirement', 'Quos delectus autem ipsum magnam.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(224, 'a1c90869-aee6-45ac-8e73-116a112be3ab', 22, 'requirement', 'Ut dignissimos voluptas est et deleniti eos.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(225, '0225ac28-40bf-40dc-b30e-0de594cf0f3d', 22, 'target_student', 'Quia ducimus quia molestias.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(226, '6ed54e21-fd02-43f4-b4cf-deb6bdf865c2', 22, 'target_student', 'Et est dolores cumque dignissimos ea minima.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(227, '4121ce96-7f73-49a2-8bd9-14a7c02916eb', 22, 'target_student', 'Est qui sit blanditiis aut culpa ea illo et.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(228, '5623798d-a3f8-417f-9f6b-f7492b149f57', 22, 'what_to_learn', 'Sapiente soluta qui nesciunt id cum adipisci unde.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(229, '5e6aedff-048f-41ec-ac04-efa89f3e7df7', 22, 'what_to_learn', 'Et aliquid ut qui commodi dolorum.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(230, 'a80dc72c-3bb3-4883-b2c3-03f000ab4911', 22, 'what_to_learn', 'Quasi nemo quas expedita molestiae.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(231, 'a27bcb88-c775-408a-a3c7-60e5f7bd4961', 23, 'requirement', 'Aut et harum impedit eos eligendi et suscipit.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(232, '921c2147-29e4-420a-83cd-3c36d3ececc7', 23, 'requirement', 'Ipsam facere aut et et eos consequatur.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(233, 'c27aa003-8c69-42c5-9c61-1a75f47e79ca', 23, 'requirement', 'Voluptas ut fuga quod nostrum voluptates ut dolor.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(234, '9ca0a7ca-bbe6-42e4-a0b3-e467429180a7', 23, 'requirement', 'Omnis unde molestiae hic qui tempore.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(235, 'd6f58cad-6964-4ce3-9400-d2dfa3f8d2de', 23, 'target_student', 'Doloremque inventore molestiae consequatur odio.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(236, '064bb049-4f84-4c8c-9ca6-47a3d212aca2', 23, 'target_student', 'Quasi labore aut aut distinctio est recusandae.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(237, 'e3c5d0fc-17ef-4930-abd0-b049faaf35d9', 23, 'target_student', 'Beatae placeat dolorum minus voluptatem officiis nulla numquam.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(238, 'b8b4eb3a-0361-4a1d-98ea-2e55cfdf4693', 23, 'what_to_learn', 'Hic sit deleniti sit quis optio.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(239, '5ece4a16-efa0-483b-b7da-078b95deea6f', 23, 'what_to_learn', 'Sapiente quam impedit occaecati possimus laboriosam voluptatibus.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(240, '0bba80f2-1d91-4852-8842-b38da447a13c', 23, 'what_to_learn', 'Nostrum est aperiam corporis id.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(241, '186db8c9-4eca-48c7-9947-1d9ebaf5d5be', 24, 'requirement', 'Adipisci cumque aut quis non repudiandae.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(242, 'e1ec1874-4223-4208-b2af-825f27a95ed8', 24, 'requirement', 'Sint ducimus sunt consectetur nisi labore.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(243, '489b6b0a-ac83-445f-8626-1ee05127ea4d', 24, 'requirement', 'Quibusdam ratione suscipit quaerat voluptatum.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(244, '6ac0fe44-11e1-4afc-91e1-91dbef8dd6c8', 24, 'target_student', 'Voluptatem perspiciatis quod a.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(245, 'a855e869-779c-4e52-a6af-6226a58ebf57', 24, 'target_student', 'Pariatur ut sit fugit et sapiente cumque quasi.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(246, 'c982035b-2a71-48a9-b638-7fe301058ddc', 24, 'target_student', 'Voluptatem id quibusdam nihil provident praesentium.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(247, 'd523fc36-723b-4815-bb76-1dbf44952b55', 24, 'target_student', 'Eaque molestiae ea maxime accusantium excepturi nemo.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(248, 'b3cde771-0d6e-4cc4-b64f-79621ffa459b', 24, 'what_to_learn', 'Quis laudantium aut officia occaecati.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(249, '8bc3fa08-7092-4f1c-9afc-cf0b37a2c988', 24, 'what_to_learn', 'Sapiente aut incidunt perspiciatis eaque quam aperiam maxime.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(250, '5863382c-34b2-46fa-8634-2cf295f03d1f', 24, 'what_to_learn', 'Laboriosam porro facilis non autem et.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(251, 'cb1dff2d-86ac-46ea-a9df-0baa8cac0ee6', 25, 'requirement', 'Incidunt laborum omnis non et cumque.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(252, 'ee75785f-a95e-4bcf-8c8f-5815c5b983d3', 25, 'requirement', 'Corporis omnis iure voluptatem.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(253, '18fe07d1-56a1-4c5d-b346-d793145f2fab', 25, 'requirement', 'Sed incidunt fugiat sint ea ut dolorem optio.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(254, '62d42ad8-fc83-4516-91de-548b6050092c', 25, 'requirement', 'Qui quos velit inventore dolorem sint.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(255, 'b190497a-8e93-4187-a0eb-68d5e5421713', 25, 'target_student', 'Illo et nemo earum eius quam vel dicta.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(256, '57d064ce-cf19-49a9-b258-b7a9142efacb', 25, 'target_student', 'Necessitatibus quod doloremque accusamus laboriosam molestias eum.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(257, '873e22c2-06b8-43ff-b3d1-e764f4774af5', 25, 'target_student', 'Fugit dolorem voluptatum eligendi excepturi.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(258, '55091ec4-c62e-4c1f-bbd9-9d86e053e842', 25, 'target_student', 'Consequatur perferendis rerum sed quasi.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(259, '94279be3-7e4a-4292-8b9c-c2a60c8f22e1', 25, 'what_to_learn', 'Nihil quas occaecati neque non inventore voluptatibus odit.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(260, '0514ba34-b629-42f9-abde-9928d12b51b8', 25, 'what_to_learn', 'Nostrum ullam ullam unde ipsa.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(261, '8f6a28b7-da6c-4fbd-9a3a-d2ab2ad6c114', 25, 'what_to_learn', 'Consequuntur voluptas explicabo impedit incidunt nisi temporibus voluptas.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(262, '9cbf120c-44c0-4ffc-b88d-caa452e75a53', 26, 'requirement', 'Sint dolor ut omnis et.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(263, '843f62a8-8e38-4d2d-97b3-fe9a6ce59e45', 26, 'requirement', 'Iusto praesentium minus quo sed architecto et aliquid.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(264, 'c30b2966-3783-42cf-98ad-97445c25a462', 26, 'requirement', 'Ut similique nihil id quia voluptas laudantium ipsum.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(265, '3edfc7ca-d1d0-425f-92e9-dad9aa2f62fb', 26, 'target_student', 'Atque aut et id natus.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(266, '46084a20-e98d-42ba-8962-e52be8d97ece', 26, 'target_student', 'Ut voluptatem consequatur voluptas magnam ducimus.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(267, 'fba8f239-65e6-4ce7-9ec9-506f599d6663', 26, 'target_student', 'Commodi earum commodi nemo vitae consequuntur et.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(268, '6cc7d924-30d9-4e2a-aeb5-daffdd5d9e7b', 26, 'what_to_learn', 'Consequatur sit aspernatur atque voluptates.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(269, 'ebdef8b1-4a59-4b3d-b6f0-fb563e20e772', 26, 'what_to_learn', 'Incidunt cum eveniet cupiditate dignissimos.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(270, 'd164cc19-fc4f-4325-ab3a-a4a59fd1fb13', 26, 'what_to_learn', 'Sit et enim qui doloremque.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(271, 'eef1117c-9966-4c9f-accc-ab8d35c40c85', 27, 'requirement', 'Est numquam eaque est et ut.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(272, 'e1209aa6-71b9-43ab-adcf-4680311f5844', 27, 'requirement', 'Quos est quae facilis doloremque.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(273, '9a84e1b6-6673-4d98-99e2-bec7567b2191', 27, 'requirement', 'Ut quis dolorem soluta accusantium debitis repudiandae.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(274, '81854458-8cfd-490c-a1b1-1cf30bccbdaa', 27, 'target_student', 'Qui doloremque dolorem dolorum molestias itaque.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(275, '4a6fae99-d922-4983-bdce-9f82519eba5c', 27, 'target_student', 'Id error enim fuga ratione aut sit.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(276, 'b49bf4b5-9f19-42f1-a55c-7edbcca2c949', 27, 'target_student', 'Labore et sit eaque totam consequatur sapiente non.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(277, 'a2415d47-1765-42c9-8e13-71103ac9cd0e', 27, 'what_to_learn', 'Et aliquid odio ut voluptatem et aliquid.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(278, 'e211fad5-d3d8-4ca5-a783-cde487976942', 27, 'what_to_learn', 'Sint ex dicta commodi et commodi aut.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(279, 'cdc9d4d7-ab79-4f98-861b-84f0e6babcb5', 27, 'what_to_learn', 'Blanditiis voluptatem odit eum voluptatibus provident eum facilis.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(280, '5affef71-72e7-4571-a832-382d820bc100', 27, 'what_to_learn', 'Non harum nobis reiciendis rerum sapiente inventore.', 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'left',
  `conversion_rate` double(15,8) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(4) NOT NULL DEFAULT 0,
  `space_between` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `symbol_position`, `conversion_rate`, `is_primary`, `enabled`, `space_between`, `created_at`, `updated_at`) VALUES
(1, 'US Dollars', 'USD', '$', 'left', 1.00000000, 1, 1, 0, '2019-08-28 03:44:08', '2019-08-28 03:45:08'),
(2, 'Swiss Francs', 'CHF', 'CHF', 'left', 1.20000000, 0, 1, 0, '2019-08-28 03:44:59', '2019-08-28 03:47:52'),
(3, 'Euro', 'EUR', '€', 'left', 1.10000000, 0, 1, 0, '2019-08-28 03:46:31', '2019-08-28 03:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `carbon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `php_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_rtl` tinyint(1) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `carbon_code`, `php_code`, `name`, `is_rtl`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ar', 'ar_AR', 'Arabic', 1, 0, 0, '2019-10-12 07:28:20', '2019-10-13 08:06:31'),
(2, 'az', 'az_AZ', 'Azerbaijan', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-13 06:35:30'),
(3, 'da', 'da_DK', 'Danish', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(4, 'de', 'de_DE', 'German', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(5, 'el', 'el_GR', 'Greek', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(6, 'en', 'en_US', 'English', 0, 1, 1, '2019-10-12 07:28:20', '2019-10-13 06:35:25'),
(7, 'es', 'es_ES', 'Spanish', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(8, 'fa', 'fa_IR', 'Persian', 1, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(9, 'fr', 'fr_FR', 'French', 0, 0, 1, '2019-10-12 07:28:20', '2019-10-13 07:03:06'),
(10, 'he', 'he_IL', 'Hebrew', 1, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(11, 'id', 'id_ID', 'Indonesian', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(12, 'it', 'it_IT', 'Italian', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(13, 'ja', 'ja-JP', 'Japanese', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(14, 'nl', 'nl_NL', 'Dutch', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(15, 'no', 'no_NO', 'Norwegian', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(16, 'pt_BR', 'pt_BR', 'Brazilian Portuguese', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-13 06:35:32'),
(17, 'ru', 'ru-RU', 'Russian', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(18, 'sv', 'sv_SE', 'Swedish', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(19, 'th', 'th_TH', 'Thai', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(20, 'tr', 'tr_TR', 'Turkish', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(21, 'uk', 'uk-UA', 'Ukrainian', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20'),
(22, 'zh', 'zh-CN', 'Chinese', 0, 0, 0, '2019-10-12 07:28:20', '2019-10-12 07:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `recordable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recordable_id` bigint(20) UNSIGNED NOT NULL,
  `context` tinyint(3) UNSIGNED NOT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pivot` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `lesson_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lecture',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_type` enum('video','youtube','article','quiz') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` decimal(8,2) NOT NULL DEFAULT 0.00,
  `article_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview` tinyint(1) NOT NULL DEFAULT 0,
  `sortOrder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `uuid`, `section_id`, `course_id`, `lesson_type`, `title`, `description`, `content_type`, `duration`, `article_body`, `preview`, `sortOrder`, `created_at`, `updated_at`) VALUES
(1, '85cf86c3-fe42-4e11-9249-6257004f5278', 1, 1, 'lecture', 'Iste Fugiat Facere Ut Aut.', 'Assumenda fuga possimus illo sapiente. Magni eveniet corporis ut fugit molestiae ipsum unde. Harum voluptatem voluptatem quo aperiam. Sed ab magni sed odit voluptates inventore qui.', 'article', '3.90', '<p>Ullam architecto omnis quas aut nihil. Fuga est iusto consequatur voluptatem deleniti debitis. Dolorum rerum fuga quo. Id pariatur voluptates veniam facilis quia. Inventore occaecati ad aliquid ut. Animi suscipit eos omnis eligendi alias est. Id incidunt nemo quia rerum excepturi culpa est. Similique blanditiis dicta magnam iusto.</p><p>Commodi aspernatur repellendus vel qui enim alias. Eos vero in libero. Praesentium illo odio reprehenderit quia.</p>', 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(2, '00409306-2260-41f7-b5a6-5d2c3707a0f7', 1, 1, 'lecture', 'Libero Consequatur Omnis Sint Et Dolore Qui Quia Quaerat.', 'In est voluptatem dolor quia ea voluptatum eveniet. Suscipit dolorem et est quo.', 'article', '0.95', '<p>Non inventore sed reiciendis officiis quo eius. Tenetur nesciunt eos eaque qui eos rerum sed voluptatem. Consequuntur et nihil tempore aut maxime. Et vero totam blanditiis facere autem quia. Non qui qui porro. Rerum id eos quasi autem similique quia est. Delectus facilis asperiores voluptas quos et. Recusandae veritatis qui cum vel voluptatum. Perferendis porro aut eos aut. Et ex sequi quia iusto quaerat sapiente. Asperiores et nihil fugiat vel. Ad architecto nihil ipsam aut error exercitationem consectetur. Corporis non delectus dolorem facilis in. Sit laborum adipisci recusandae mollitia exercitationem.</p><p>Deleniti qui nihil sunt ut provident. Ea commodi quod occaecati dignissimos et ut reiciendis. Corrupti est aut nostrum molestiae qui.</p>', 1, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(3, 'fdc5e617-6fc8-49d9-bcac-0365a86a5623', 2, 1, 'lecture', 'Maxime Ut Qui Cumque Incidunt.', 'Et ut omnis necessitatibus explicabo sit earum molestias. Architecto fugiat assumenda et aspernatur nam. Modi ut porro et ex sed laborum quia.', 'video', '3.17', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(4, '81f4715a-71b8-4068-9b1a-b16d44b85cb5', 2, 1, 'lecture', 'Sequi Fuga Nihil Aut Itaque.', 'Sapiente non est numquam similique ipsa dicta. Qui velit esse enim at dicta a iusto qui. Ut libero et nihil magni. Doloribus amet ex et.', 'video', '1.73', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(5, 'b31fde0a-6a75-4fb8-ad2a-0f7348fdf6aa', 2, 1, 'lecture', 'Explicabo Aliquid Officiis Voluptas.', 'Omnis rerum sed nihil et earum. Itaque veritatis laborum velit eveniet autem. Ut a nihil nesciunt doloremque ea blanditiis. Minima voluptate ea velit perferendis et.', 'video', '1.49', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(6, 'd5656df9-6bc8-4deb-b3e8-e7573991c288', 3, 2, 'lecture', 'Esse Porro Tempora Similique Voluptas Dolorum Reprehenderit Quo Cupiditate.', 'Quod provident ut et iusto minus tempora sunt. Maiores totam praesentium rerum repellendus deserunt asperiores est vel. Blanditiis et debitis nisi aspernatur corrupti repudiandae quis ratione.', 'article', '1.91', '<p>A occaecati laudantium nobis reiciendis eum quam sit. Eum magni placeat sed aliquid. Et veniam laboriosam iure ullam eum sed maiores. Omnis nihil ut blanditiis recusandae.</p><p>Nemo assumenda magnam qui rerum aut perferendis nam. Enim ea voluptatum et aperiam. Voluptas illum aut sit.</p>', 1, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(7, 'c71345e7-d2db-49d6-8177-1bb82cb5b1ae', 3, 2, 'lecture', 'Officiis Necessitatibus Ducimus Ratione Ducimus Ut Explicabo Voluptates.', 'Dignissimos atque voluptatibus non qui et. Fugit pariatur sit et maiores non eos. Dolor iste distinctio iusto consequuntur voluptatem laboriosam nihil accusamus. Laborum perspiciatis non vero aut magnam rem.', 'video', '2.01', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(8, 'c230a35a-49cc-496c-8b6e-248f49bf55da', 3, 2, 'lecture', 'Omnis Veniam Voluptate Quod Aliquam Perspiciatis Blanditiis.', 'Ea necessitatibus quia eum esse eaque harum. Vitae occaecati ea alias sed earum vitae quia. Qui sunt nobis saepe voluptas vel sed atque. Vel beatae perspiciatis velit ut. Ducimus eum voluptatem quod enim.', 'video', '3.08', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(9, '56841d23-2e8a-42f1-86b8-5fd18a8c5f62', 3, 2, 'lecture', 'Est Repellat Voluptatum Aut Voluptatem Vel Quam Ratione Perspiciatis.', 'Non maxime quos similique esse quod ex eveniet doloremque. Sed possimus voluptatem blanditiis consequuntur aperiam minima. Dignissimos laudantium optio beatae. Non non qui aut totam ullam.', 'youtube', '4.01', NULL, 0, 4, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(10, 'f05947f6-9537-4834-a78a-6b6b7629f6d7', 4, 2, 'lecture', 'Cum Vel Voluptatem Assumenda Consectetur Nisi Provident.', 'Vitae in repudiandae debitis doloremque nam vel et. Beatae aut accusantium ab quae. Autem non velit nihil expedita at odio.', 'article', '2.94', '<p>Natus neque provident omnis consequatur rem molestias. Eum nostrum libero est quia beatae velit. Vel aut et libero. Quo commodi dicta voluptatem facilis. Sapiente tempore est sapiente placeat optio minus. Aut est repudiandae aut sed est voluptatem. Autem enim in eum corporis eos. Molestiae itaque aut nisi maiores aliquam sunt qui. Cupiditate natus magnam molestias. Nesciunt tenetur eveniet vitae et eum dolor consequatur quis. Sunt et quasi saepe eligendi expedita qui.</p><p>Enim accusamus facere consequuntur odit et. Corrupti ea eligendi ducimus aut incidunt vitae. Magni iusto non voluptatem ullam est voluptate. In molestias voluptatem eligendi veniam. Illum nihil sunt in est esse sunt. Qui mollitia repellat est blanditiis nam reiciendis quos.</p>', 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(11, '9f14e73c-168f-4ff3-8c5c-5babcc35d99a', 4, 2, 'lecture', 'Provident Architecto Illum Et Cumque Cumque Omnis Magni.', 'Rerum occaecati est molestiae voluptatem. Ut tempore dolores autem possimus. Animi alias tenetur aliquid ducimus excepturi fugiat. Quia sapiente consequuntur tenetur repudiandae ut esse perferendis.', 'video', '7.44', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(12, '51a70dae-ed16-42da-a0ef-6723a0905b47', 4, 2, 'lecture', 'Ex Beatae Quia Molestiae Voluptatem Quia Aut.', 'Ipsam minima dolore inventore est ratione dolorem iste. Voluptas autem voluptatibus quaerat quos ut.', 'video', '6.57', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(13, '97bbb483-2289-40e2-859b-fa45bb279674', 4, 2, 'lecture', 'Sunt Et Et Distinctio Rerum Quia Iusto.', 'Necessitatibus voluptas consequatur eaque. Minima laborum qui officia dolor et vel ipsa. Nisi ea inventore non quis perspiciatis voluptas aut itaque. Qui debitis facilis odit asperiores ipsam.', 'article', '0.57', '<p>Dolor repellat illum dolores consequatur et distinctio ut aut. Sunt fuga laudantium architecto voluptatum optio impedit. Quasi incidunt vel totam consequatur est alias. Accusantium facilis ut perferendis impedit delectus quas. Omnis dicta non recusandae eos ducimus. Laboriosam est optio hic accusamus ut iste esse perspiciatis.</p><p>Iusto cum pariatur dolore similique voluptas ut fugiat. Ipsum inventore qui quidem repudiandae adipisci fugit. Et ut maiores cum. Et adipisci quo inventore voluptate consequatur. Non in rem est cum. Deleniti est labore quidem officia dolores sed. Laborum modi ut ut. Magnam magnam ut nihil aut. Id suscipit a nam saepe occaecati repudiandae.</p>', 0, 4, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(14, 'b4a4a953-acd2-41aa-90a0-6624f222d751', 5, 3, 'lecture', 'Hic Rerum Quia Ratione Expedita Et Non Ducimus.', 'Sunt nihil veritatis totam. Natus est et corrupti numquam. Non itaque autem molestiae ratione amet repudiandae.', 'article', '4.68', '<p>Soluta necessitatibus sed voluptatem quia. Sint magni temporibus tenetur non reiciendis voluptas. Eos ex autem quia est rerum placeat nam. Doloribus quaerat corrupti tempora vero adipisci consequatur. Minus autem reprehenderit sunt optio iste et est. Illo ut qui cum ut.</p><p>Temporibus neque corrupti iure magnam unde. Et sed amet quasi nostrum id. Deserunt ipsam omnis et tenetur sed in odio. Voluptatum voluptas quis ipsa commodi iure praesentium. Delectus itaque iste qui nam iure alias. Quasi labore aut harum perspiciatis. Quibusdam omnis sunt debitis et voluptas perferendis. Est veritatis velit sed similique dolore et officia. Qui magni delectus labore et.</p>', 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(15, '81a0ac04-9f30-4300-9288-650b632b5edd', 5, 3, 'lecture', 'Rerum Harum Accusantium Ad Pariatur Vel Aut Iste.', 'Pariatur veniam velit tenetur est. Autem sit aliquam quis. Veniam unde minima molestiae quia provident et qui. Eum fuga quod aut sunt hic. Aut ducimus iusto voluptatem dolores atque quidem.', 'article', '2.51', '<p>Velit laborum saepe qui ea quod repellat asperiores. Assumenda aut rerum non earum at ab eum. Distinctio id nemo aut. Consequuntur ea eveniet nemo. Itaque consectetur quas eos eum voluptatem quae. Velit alias impedit fugit ipsum veritatis eum perspiciatis. Incidunt commodi hic magnam ut. Dolorem at et sed non recusandae enim sint. Aut cupiditate officia quia odit aliquam ad quo. Libero quam nostrum maiores.</p><p>Adipisci qui a harum voluptatem distinctio. Excepturi dolore accusantium aliquam velit praesentium autem magni voluptatem. Suscipit non nam vero id.</p>', 1, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(16, 'e00b98e7-a274-4c95-baca-764c0f648d5a', 5, 3, 'lecture', 'Atque Quia Non Itaque Laudantium.', 'Nam modi velit vero velit aut. Nisi ea ex eum facere non aut. Voluptas reiciendis reiciendis possimus. Ullam quis corporis debitis libero aliquam cumque.', 'video', '4.55', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(17, '8e993807-dff4-40d2-92f1-aab399583ab6', 6, 3, 'lecture', 'Necessitatibus Sint Consequatur Sit Possimus.', 'Dolorem dicta veniam et aut. Qui architecto dolor perferendis a at occaecati sapiente. Velit dolorem et quia hic. Voluptas quia at nobis. Porro voluptatem quia deleniti vero et fugit.', 'video', '1.65', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(18, 'b77edcde-77ed-4c2e-a9db-34f6e81100b6', 6, 3, 'lecture', 'Molestias Non Non Molestiae.', 'Quaerat qui quis consectetur eum tenetur. Eos ex nulla impedit soluta repellat. Rerum iste rerum delectus quaerat in.', 'youtube', '7.39', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(19, '83d220c3-c157-48dc-b8fb-eaa6b079f361', 6, 3, 'lecture', 'Nulla Suscipit Voluptates Architecto Incidunt Non Tenetur.', 'Enim provident repellendus quis delectus praesentium ipsam. Incidunt dignissimos veritatis quam at. Eum ut incidunt aliquid nesciunt amet quibusdam. Unde vitae beatae labore ullam vero ut voluptate.', 'article', '5.80', '<p>Enim voluptatem est ex dolorum. Sit et voluptatum qui illum. Repudiandae nesciunt dolores molestias ea cupiditate dicta ducimus. Sit odit cumque delectus excepturi. Ipsam maxime cumque harum eum dolores. Ad pariatur incidunt numquam voluptas exercitationem numquam sed possimus.</p><p>Mollitia veritatis assumenda sint sunt. Officia accusantium deleniti assumenda sit. Ut assumenda dolorum velit iusto voluptatibus. Nam dolores nesciunt dolorum. Eius placeat beatae et minima. Et dignissimos dolor rem eum sint placeat similique. Veritatis aut dolor praesentium beatae inventore eum. Ut similique ratione nostrum animi eligendi omnis ex. Libero tenetur quis numquam dolorem molestiae.</p>', 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(20, '5392cafe-0f0b-4b21-b17a-5432d7736fb6', 7, 4, 'lecture', 'Aut Est Omnis Culpa Sunt.', 'Accusantium delectus aliquid voluptatem mollitia. Iste commodi ad officia consequatur inventore. Sed et commodi et quod.', 'article', '7.42', '<p>Temporibus quis omnis quia voluptatem dolorem similique expedita. Culpa eos voluptas delectus laborum sequi et debitis. Nam qui qui explicabo neque. Et quia iure ipsum dicta adipisci similique.</p><p>Tenetur voluptas possimus neque recusandae non dolor est. Aperiam saepe enim similique veniam. Est temporibus tenetur qui quia omnis. Dolore est eveniet nesciunt non temporibus blanditiis eum. Rerum neque distinctio quia autem quod. Alias sed ducimus eos consequatur. Vitae vel vitae totam et eos.</p>', 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(21, '957cdb71-2ca6-4d5c-bc40-c1f23c7ebb99', 7, 4, 'lecture', 'Deleniti Dicta Cum Cupiditate.', 'Sint nemo quae repudiandae nemo nemo atque dolor vel. Fugit ullam quisquam voluptatibus voluptates quaerat. Repellat est quam quia eos.', 'article', '4.98', '<p>Est eligendi incidunt vitae voluptatem ullam ipsa aspernatur. Aut consectetur nulla vel maxime. Totam ipsam enim quibusdam aliquam minus architecto exercitationem. Atque aut odit iste eum quia ex. Voluptas ut omnis voluptatum. Consequatur earum voluptas consequatur neque aut. Dolores temporibus error maiores nobis laboriosam consequatur. Reiciendis ut earum quis omnis perspiciatis praesentium sed numquam.</p><p>Dolore non expedita in pariatur voluptatibus non. Recusandae et aliquam excepturi distinctio voluptate corrupti alias.</p>', 1, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(22, 'b1e961af-6835-4581-84ca-fed8d5d11cde', 7, 4, 'lecture', 'Quas Expedita Magnam Pariatur Placeat Doloribus.', 'Quasi omnis quo dicta qui commodi quo. Ab molestias fugiat et vitae. Voluptatem necessitatibus quasi fugit non.', 'youtube', '7.23', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(23, 'd2d15df1-78f7-4f17-8443-673c3813a12e', 8, 4, 'lecture', 'Nisi Porro Perspiciatis Sunt Odio Ut Ut Et.', 'Minus voluptatum eveniet sint et. In adipisci voluptas quis nobis optio voluptatem. Dignissimos assumenda nihil et eveniet aut sunt. Rerum voluptas beatae sint aut ratione inventore ullam.', 'youtube', '8.82', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(24, '437ac4b8-5b8f-441a-ae82-e0300807f918', 8, 4, 'lecture', 'Eligendi Consectetur Saepe Voluptates Facilis Inventore.', 'Sint sed beatae quas enim quas cum. Est at nostrum tenetur. Tempora aperiam dolorem illo in assumenda et. Suscipit sit corrupti ab repudiandae.', 'youtube', '3.55', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(25, '344b87cb-1bb4-4d96-9fe8-8aa49025b831', 9, 5, 'lecture', 'Est Earum Ut Qui Qui Aut Harum Optio.', 'Numquam omnis sed ut quasi non dolorum. Cumque mollitia et libero quia aliquam ipsum.', 'video', '1.00', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(26, '8da5e585-2c1c-4abb-a754-28c6403fa8cc', 9, 5, 'lecture', 'Aut Voluptatum Omnis Consectetur Mollitia Alias At Ullam Aliquam.', 'Perferendis qui sapiente quia libero expedita incidunt nihil. Natus consequatur et nulla non omnis minus. Quaerat culpa voluptatibus aut et quia odit quis repudiandae. Repellendus molestiae minima dolores laudantium in tempore optio quis.', 'video', '1.68', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(27, 'df2d8436-186a-43e2-922d-ff359b052eb3', 9, 5, 'lecture', 'Ut Nam Quos Fugiat Incidunt Voluptatum Nemo.', 'Eum repellat optio accusantium labore incidunt. Non inventore impedit accusamus aut. Est et voluptatem cumque. Et eveniet ipsam qui iusto totam culpa perferendis.', 'video', '7.97', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(28, '20c5e265-8a99-497e-999b-b45ad7bc1be6', 9, 5, 'lecture', 'Accusamus Consectetur Impedit Ut Maiores Quibusdam Omnis.', 'Accusantium voluptatem minima error numquam molestiae perspiciatis qui similique. Ullam voluptatum enim ut doloremque architecto tenetur dolor. Non iusto hic excepturi repellendus vitae veritatis.', 'article', '9.29', '<p>Expedita ut sint eos ad architecto. Excepturi sed aut voluptates sit natus qui. Nihil a illum at id. Rem praesentium vitae vitae ea tempora autem et.</p><p>Aliquid ut distinctio consequatur consequatur at natus. Assumenda provident repudiandae et quas. Non ipsam quas voluptatem voluptas dolorem doloribus. Voluptatem labore sit doloremque recusandae deserunt hic omnis. Quia et quam quod nobis amet in. Beatae adipisci mollitia odio deleniti velit et nulla.</p>', 1, 4, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(29, 'eac14df0-6a70-4b44-8072-efdbc693a247', 10, 5, 'lecture', 'Quasi Architecto Qui Veritatis Et.', 'Repellendus illum ut accusantium architecto ea alias explicabo. Ipsa voluptatem hic hic.', 'video', '9.98', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(30, '92a25a3e-6f9b-4409-8781-cd1e2c7b56f9', 10, 5, 'lecture', 'Eum Excepturi Rerum Neque Vel Aliquam.', 'Est provident autem quia est dolorem laudantium. Enim veritatis illo omnis voluptatem. Repudiandae odio perferendis ut expedita deleniti hic eveniet.', 'youtube', '4.84', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(31, 'a531b1fa-cc93-419f-832e-cfa6e72c63e3', 10, 5, 'lecture', 'Eum Aliquid Necessitatibus Recusandae Aspernatur.', 'Repellendus atque at tenetur accusantium qui distinctio. Similique mollitia eum sint quo aut est voluptates. Corporis facere quidem et repellat. Dolores voluptas voluptatem non qui magni qui harum.', 'youtube', '7.16', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(32, '09667c2f-0292-4ed1-9458-e9cbb596bc1c', 11, 6, 'lecture', 'Ut Sunt Ratione Voluptatem Beatae.', 'Animi tempore facilis nesciunt voluptatem qui. In fugit error in tenetur et eius omnis.', 'article', '4.31', '<p>Aliquam nulla facilis doloribus est possimus accusantium officia. Autem iusto et omnis dolorem. Eum cupiditate cumque nemo commodi nisi corrupti ut et. Officia temporibus soluta eos quisquam temporibus et vitae. Nobis voluptas aut in hic. Quisquam ea cupiditate est aut dolorum nesciunt.</p><p>Magnam cumque voluptas excepturi labore pariatur. Officia vitae voluptas tempora id. Totam nobis dolore quae ad sint quisquam iusto. Facilis totam sit eaque sequi id minus molestiae. Enim veniam adipisci totam dolores quia. Nihil animi temporibus fugiat dolore qui. Rerum ex delectus nesciunt eos neque voluptatibus voluptas.</p>', 1, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(33, 'e6fbf6de-1285-44b5-9134-f24c8f83cb59', 11, 6, 'lecture', 'Consequuntur Quis Sit Quasi Ea Esse Aut Voluptatibus.', 'Repellat sit ullam ullam provident totam. Omnis ipsam iure quia corrupti aut cumque. Qui temporibus dolorem voluptatum quia. Qui magnam beatae occaecati vel voluptas quia.', 'article', '7.34', '<p>Quam ipsa dignissimos nostrum reiciendis quasi dolores ut. Ut rerum error accusantium minus inventore.</p><p>Iusto eaque aut aperiam culpa quasi. Nesciunt deleniti est optio itaque eos quisquam cum. Fugit fugit cum expedita vel. Possimus pariatur quam nam. Aut voluptas ut quia vel quas. Non aut veritatis veritatis nesciunt quia sunt architecto. Error aperiam in repellendus ad quas in. Fugit itaque incidunt dolorum occaecati.</p>', 1, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(34, 'f6a3fa27-5503-4e61-a251-e65b02702bb6', 11, 6, 'lecture', 'Architecto Officia Quasi Dolores Illo Aut Voluptates Aliquam.', 'Sed et sint iste corporis. Qui totam enim ipsa optio illo illum. Corporis amet suscipit amet error unde eligendi quo molestiae. Sequi vel dolore expedita. Fugit reprehenderit delectus ut quia suscipit.', 'video', '9.86', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(35, '3f42b63d-5ee8-41c3-9bb0-6a89f3ca8cbd', 12, 6, 'lecture', 'Incidunt Ut Ut Rerum Omnis Rerum Ratione Quia Ut.', 'Officia qui aut rerum natus eligendi in illo nam. Quidem praesentium voluptate explicabo repellendus sed. Exercitationem ea ratione in adipisci rem.', 'video', '4.71', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(36, 'a7f35956-79fd-4275-9935-6082608b6449', 12, 6, 'lecture', 'Ipsum Placeat Dolore Quia Officia Dolor Facere.', 'Sint optio ea odit voluptas nemo doloremque. Ea excepturi consequatur rerum repellat vero. A architecto molestiae dicta repudiandae illum pariatur. Est itaque fugiat molestias ipsum dolorem. Quisquam deserunt doloribus aut reprehenderit sunt voluptatem voluptas.', 'video', '8.38', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(37, '1e191b5a-c27b-4317-a60c-0693eebb6814', 12, 6, 'lecture', 'Quasi Ut Esse Voluptatibus Pariatur Corporis Cupiditate.', 'Soluta voluptas dolor excepturi molestiae officia eveniet. Magni quia cupiditate dolorem quia qui fugit tempore reiciendis. Ipsum sed voluptas nam laborum error assumenda ut. Aliquam sed dignissimos velit voluptatem eveniet quaerat.', 'video', '8.50', NULL, 0, 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(38, '9a343939-354c-48cf-abea-d23912e10415', 13, 7, 'lecture', 'Et Nihil Quibusdam Repudiandae Autem Porro Amet Qui.', 'Quas nam ipsum cupiditate. Aliquid officiis est et enim id dolorem. Eos explicabo sed veritatis reiciendis odio.', 'youtube', '0.82', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(39, 'cd017281-9c8e-40ad-ae20-4952f115f117', 13, 7, 'lecture', 'Perspiciatis Optio Omnis Omnis Repellat Quas Est Non.', 'Nemo et maiores libero quia ipsa amet. Dolorem ut animi dolorem beatae quibusdam cumque. Aliquid sunt rem similique delectus dicta voluptates et odio. Eos occaecati ducimus itaque odit saepe ut magnam ex.', 'video', '8.55', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(40, '04426ea5-8671-4193-ad2b-e69b2cdfb0f7', 14, 7, 'lecture', 'Id Deleniti Eos Et Aperiam.', 'Quia ut voluptas delectus sapiente fugit nihil. Ipsa optio qui voluptatem alias voluptatum deleniti facere. Quas sunt cupiditate voluptas. Mollitia debitis veniam debitis ut ut numquam quia.', 'video', '3.55', NULL, 0, 1, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(41, '2ced1638-3b9e-43bb-bb5c-da581c27f8eb', 14, 7, 'lecture', 'Dolore Repudiandae Qui Cumque Aut Quo Accusantium Voluptas.', 'Tempora est id fugit temporibus ex quibusdam inventore magnam. Repellendus eos qui omnis sit. Consequuntur laborum vero iusto dolores neque ab.', 'youtube', '6.32', NULL, 0, 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(42, '4bbc2b66-463c-4f55-804b-53222a1aa558', 15, 8, 'lecture', 'Qui Nihil Eligendi Quasi Quo Porro Harum Et.', 'Doloremque et quos aut quas labore et. Ea id optio at sit. Nobis sunt eveniet officiis inventore et rem hic.', 'article', '6.18', '<p>Voluptas omnis voluptate fugit ea aut quis recusandae. Enim et ipsum laudantium nihil. Illum optio dolorum sapiente est aliquid facilis. Atque magni ut laboriosam reiciendis quod rerum consectetur ipsam. Assumenda ex vitae aut rerum est a pariatur. Nisi voluptatibus fugiat consequatur illo occaecati. Quos ea sunt rerum est ducimus. Tenetur repellat beatae voluptate modi assumenda perspiciatis.</p><p>Et a autem molestias ducimus quis itaque. Et similique eum culpa voluptas. Accusamus asperiores nihil at voluptatum fugiat. Quisquam quae quis quia qui architecto fugit ab expedita. Velit dicta voluptas laborum atque qui est. Qui qui praesentium libero sapiente nemo. Ut qui delectus ducimus fugiat esse.</p>', 1, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(43, '57a52ec2-7f81-4829-90d0-4c1bb3e51dab', 15, 8, 'lecture', 'Id Suscipit Commodi Deleniti Maxime Ut.', 'Dolor dolores possimus voluptatem rerum. Debitis quis modi quod officia. Quo expedita esse quo quas et. Sit consequatur exercitationem est inventore quia nam.', 'article', '7.97', '<p>Nesciunt molestiae eum autem facilis unde autem. Vero aut quis consequatur sit quae reprehenderit et. Fugit dolore quaerat fugiat maxime ab enim ipsam. Dolorum minima tempora ad quod magnam. Numquam repellendus ab pariatur sit aliquam deserunt fugit. Commodi facere perspiciatis harum ut esse necessitatibus doloribus ea. A eaque quos eum nostrum et neque aut.</p><p>Laudantium et est voluptates officiis ex. Non incidunt enim corporis id. Occaecati tempora non temporibus nobis.</p>', 1, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(44, 'fe82fe8b-b93d-44d1-866d-d82ce75fcf32', 16, 8, 'lecture', 'Ut Dicta Autem Omnis Odio.', 'Laborum et laborum sunt voluptatem ut qui nihil. Et autem qui culpa cupiditate. Quis inventore est tempore temporibus magnam perspiciatis aspernatur sint.', 'article', '9.40', '<p>Doloremque unde corporis et. Ea fugit assumenda voluptatem aut. Nulla nihil vero beatae. Est non deleniti labore. Assumenda quis repellendus eos distinctio in cupiditate voluptas deleniti. Necessitatibus adipisci nihil omnis rem. Et explicabo maxime sed aliquid occaecati. Unde quidem aperiam magnam qui quia aut sunt.</p><p>Sit illum possimus quo rerum tenetur in dolorum. Voluptas et odio facilis. Maiores et excepturi ut aspernatur enim quis. Eaque est autem blanditiis eos voluptatem. Explicabo modi deserunt et quia qui consequuntur nulla.</p>', 1, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(45, '524cc47a-02ff-4136-92a3-56fd3038fd4c', 16, 8, 'lecture', 'Beatae Omnis Rerum Earum.', 'Sit cumque assumenda explicabo at tempore deleniti. Consectetur qui sit corporis excepturi ut quasi sunt tempora.', 'article', '9.99', '<p>Aut ipsa molestias soluta sit repellendus qui. Excepturi pariatur veniam et labore quis. Natus inventore et fugit quod est. Facilis omnis incidunt delectus aut nostrum fugit. Sunt non tempore tempore qui. A ipsum dolorum sed at et non. Aut voluptas dolorem qui sed omnis sit saepe. Quos officiis non consequatur. Molestiae ut quidem sit ad deleniti ad ut consectetur. Nostrum illum dolore numquam molestiae totam provident.</p><p>Voluptatem nihil iste repellat. Sint soluta illum delectus pariatur amet. Rem recusandae incidunt autem eligendi consequuntur natus vitae. Omnis similique nihil ullam natus voluptatem a neque. Id repudiandae ea dolores vel voluptatem commodi molestias voluptatem. Quos dolorum quibusdam debitis qui enim optio officiis. Rem repudiandae ea aliquam in. Aut non voluptate voluptatem et.</p>', 1, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(46, 'c57e84a8-86e3-4e8c-bd77-30a8c76c7c6f', 17, 9, 'lecture', 'Mollitia Natus Doloribus Quia.', 'Eveniet in et maiores doloribus ab ut qui quis. Fugiat cupiditate ratione sed eos.', 'video', '9.58', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(47, '349df033-42f8-4339-950b-3cb3123d9277', 17, 9, 'lecture', 'Sed Corrupti Eligendi Omnis Laudantium Voluptas Odit Omnis.', 'Ex id ut libero fugit dolore quia. Amet voluptatum eos ut. Ut sequi officia incidunt tempora debitis. Vero sed dolores odit illo et ducimus occaecati non.', 'video', '0.67', NULL, 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(48, '0af34279-66a6-4495-a661-952f32fc0bf1', 17, 9, 'lecture', 'Quia Officiis Commodi Reiciendis Et.', 'Dolores et quaerat eveniet magnam et in. Eaque eos quia quaerat sunt.', 'article', '9.41', '<p>Consequuntur optio sequi est delectus et. Quasi repellendus hic veritatis. Ut voluptas excepturi sed ut.</p><p>Qui odio nihil dignissimos ducimus laboriosam voluptatibus dolorum ut. Facilis consectetur non cupiditate quia quasi consequuntur facilis. Totam consequatur quibusdam dolor. Dolorum voluptatum officiis ea et aut omnis recusandae. Et quasi iure voluptate commodi. In veniam blanditiis aut sit doloremque.</p>', 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(49, 'd9222753-211a-4c60-8beb-07cb327fd2ad', 17, 9, 'lecture', 'Ratione Sapiente Officiis Debitis Dolor Rerum Officia Repellendus.', 'Omnis eaque aut repellat nihil. In nulla ut voluptatem hic rem numquam eum voluptas. Aut totam eos dignissimos sunt.', 'youtube', '4.30', NULL, 0, 4, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(50, '08007471-51eb-4fd0-96e6-3a3f2f4d8a58', 18, 9, 'lecture', 'Placeat In Qui Aspernatur Minus Ex.', 'Minima quae magni quis consectetur delectus non. Aut nihil in minima est est. Enim repellendus expedita placeat omnis sint omnis.', 'video', '5.67', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(51, '8cf44766-25ec-43df-ba83-fc98ea370fa7', 18, 9, 'lecture', 'Pariatur Distinctio Corrupti Accusamus Voluptas Qui At.', 'Nemo quam asperiores delectus sint quam eligendi quibusdam. Velit ad maxime ipsa eos. Accusamus totam et exercitationem veritatis ut non. Autem tenetur et deserunt illum. Vel quae praesentium at dicta.', 'article', '4.64', '<p>Ad eos pariatur dignissimos quia iste quidem. Consequatur laborum voluptatum dolores cupiditate et corrupti debitis. Ea aut nostrum et quos quae modi quaerat id. Et dolorem labore laudantium. Explicabo accusantium iusto incidunt aperiam illum animi tempore. Tempora est inventore eius ut. Qui consectetur aliquam laboriosam. Et natus exercitationem atque consequatur fugit. Dolorem sed cum reiciendis non blanditiis et. Maxime facere earum amet non temporibus et at.</p><p>Quia aliquam deleniti enim expedita et maxime cum qui. Nostrum nam iusto quia repudiandae ratione officia. Eligendi excepturi modi fugit veritatis.</p>', 1, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(52, '4043d156-00af-4738-983f-76f3a695bd6d', 18, 9, 'lecture', 'Quia Cupiditate Tempore Laboriosam Iste.', 'Nisi facere aut natus nisi corporis. Velit labore in dolore aut. Molestiae voluptates delectus magnam ex perferendis.', 'article', '8.26', '<p>Minus quas id et id voluptas. Nulla fugiat dolorem qui libero aspernatur ut libero. Facilis est ut voluptatem est. Non sit non aut et.</p><p>Aperiam similique consequuntur consectetur repudiandae est et. Hic in accusamus et nulla quaerat. Illum odio nesciunt possimus perferendis fugit nisi ea dicta.</p>', 1, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(53, '2ae20763-279c-4008-8f55-ae1b2100cdf6', 19, 10, 'lecture', 'Omnis Quia Ipsum Voluptates Harum Dignissimos.', 'Et error omnis magni libero suscipit veritatis quia. Ut sit qui qui laborum voluptas dolor. Et neque quas enim nesciunt asperiores vel. Non animi sit facere ut cum possimus.', 'video', '2.99', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(54, 'fdf36784-3306-4637-9c19-8fcc46c7762b', 19, 10, 'lecture', 'Autem Cum Facere Neque Occaecati Sequi Dolor.', 'Animi saepe aut adipisci dolores est. Sit quam praesentium sunt culpa laudantium sed consequuntur. Rerum ut quasi quia quis quisquam.', 'article', '9.24', '<p>Nulla aut consequuntur rerum aut ducimus consequatur. Et et similique veritatis assumenda magni. Facilis et omnis similique veritatis.</p><p>Consequatur autem non impedit rerum a delectus repellendus. Rerum non dolore quisquam accusantium rem exercitationem consequatur. Voluptas ad est velit labore ad quidem neque.</p>', 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(55, '6e1e7a61-015e-4a17-948f-b926824c92fb', 19, 10, 'lecture', 'Sint Ipsa Ut Fugit Eligendi Iusto Aut In.', 'Quos accusamus quo deleniti voluptas nihil dolores aut corporis. Fugit molestias ab esse. Est repellat et quidem minima nihil.', 'youtube', '6.94', NULL, 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(56, '2ee557c3-9bf9-49c5-83c5-7b88250055ec', 19, 10, 'lecture', 'Explicabo Quidem Rerum Ab.', 'Quis quibusdam minima enim ratione recusandae. Atque sit eos provident et in saepe ducimus. Voluptates ut sapiente aliquid ipsam placeat.', 'video', '3.02', NULL, 0, 4, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(57, '9c3d7826-81b6-4bb3-9620-f1aa1a86b794', 20, 10, 'lecture', 'Ut Commodi Consequatur Laborum Eaque.', 'Esse velit quod nam nihil ad veniam voluptatem. Fugit asperiores eveniet sunt officia illo. Assumenda aut fugit voluptatem reiciendis neque soluta voluptas. Ab sapiente quae occaecati molestias fuga. Et nemo aut sit quis iusto.', 'youtube', '4.81', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(58, 'c5a0e208-4c84-46fe-a38c-6336c0e70ed6', 20, 10, 'lecture', 'Labore Vero Nulla Est Deserunt.', 'Soluta quo ut consequatur eaque. Corrupti voluptatem eius minus enim est. Quasi vero fuga laudantium natus similique. Tempore sint qui qui sunt harum inventore. Voluptates tempore officia et fuga illum non expedita sint.', 'article', '7.29', '<p>Quae veniam consequatur doloremque aut. Laudantium error atque neque et dolor. Nihil fuga veniam placeat voluptatibus aliquid. Veniam illo blanditiis et deserunt. Nemo sint hic ad velit ullam odio. Doloremque aliquid veritatis dolorum. Laborum natus ipsum nesciunt eius eius. Consectetur impedit ea dolorem est. Ut temporibus et deleniti et molestias et. Quisquam laborum vel illo. Ea dicta adipisci quia veritatis sed optio.</p><p>Est amet eos minima corporis qui unde. Nam eum non qui minus. Quia placeat ipsa in facere nisi. Numquam maiores possimus provident aspernatur at. Ut non quod consectetur voluptas minima sed praesentium. Et illum dolores et fugit. Sed accusamus ut ut aliquam quas nisi. Nam ut et officiis unde ipsam et. Sunt possimus natus ea. Nisi vel ut inventore error nostrum. Aut incidunt nihil dolores adipisci at aut.</p>', 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(59, '6273fe1c-6a9a-450d-bc19-a3a3ddd61d92', 21, 11, 'lecture', 'Qui Qui A Nihil Suscipit Voluptatibus Quaerat.', 'Illo laudantium et facere nostrum inventore ut. Dignissimos ut facere vel dicta architecto rerum sunt tempora. Fugiat molestiae dolor odit consequatur voluptatem eos. Quam nisi occaecati qui quo.', 'youtube', '4.12', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(60, '98ed4515-3565-46ac-a619-6bb87a9fc381', 21, 11, 'lecture', 'Veniam Distinctio Molestias Quia In Sint Non.', 'Et in sed quis occaecati amet recusandae repellat. Consequatur reprehenderit voluptatem numquam quidem. Quasi dolorum quo quasi.', 'youtube', '0.90', NULL, 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(61, '80c7af6c-bb2b-48aa-bd1b-4c936b6129f0', 21, 11, 'lecture', 'Culpa Aut Sint Officiis Voluptatibus Amet Natus.', 'Minus minima odio est voluptatem odio alias quod laudantium. Ea aut ducimus voluptas odit tenetur odio distinctio. In maiores sit quis consequatur sapiente est deleniti. Quia ratione in dolores.', 'article', '3.26', '<p>Qui qui facilis repellat aut doloribus. Temporibus veniam expedita sed enim sed ut voluptas repellat. Sit voluptas perferendis doloribus debitis accusamus quisquam. Sint laudantium aliquid et ipsum nisi a corrupti consequatur. Sapiente commodi sit id. Quasi ratione esse temporibus modi neque non. Quas eos quia recusandae.</p><p>Harum voluptas facilis laborum vero hic ut sit est. Aut voluptatem reprehenderit libero blanditiis.</p>', 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(62, 'bd2556c7-25cb-449d-b445-727288af1382', 22, 11, 'lecture', 'Quisquam Esse Voluptates Fugit Consectetur Illo Corporis Enim.', 'Dolor atque eum ab quisquam ullam aut recusandae ut. Aut minima autem quo error illum sunt.', 'youtube', '8.77', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(63, 'b71fc46f-94bc-440d-b4a0-50718a74c2f8', 22, 11, 'lecture', 'Sint Ea Laborum Quo Est Omnis Debitis Recusandae.', 'Hic autem aut suscipit fuga voluptatem saepe omnis. Autem qui quos ut. Excepturi vel eos sit vel ut.', 'article', '8.12', '<p>Iure asperiores repellat error voluptas consequatur et minima rerum. Ut atque quaerat ex commodi quisquam voluptatem. Ex omnis nesciunt mollitia qui temporibus. Commodi ipsum fuga nulla voluptatem quis odit provident. Ut illo eum deleniti et quo.</p><p>Eum quis deleniti officiis. Non non ipsa totam omnis perferendis odit. Expedita a iusto officia rerum. Ipsam aut qui impedit ratione accusantium voluptatem numquam. Rem delectus in est sit cum itaque ducimus. Facilis animi nesciunt consequatur.</p>', 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(64, '46aa064f-526f-46df-8bb7-5c9600bd967d', 23, 12, 'lecture', 'Repellendus Autem Sed Deserunt Quia Et Ullam.', 'Odit possimus et fugiat dolorem. Ut laudantium illo consectetur rerum nihil.', 'video', '4.54', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(65, '33f9e637-fddb-4ae3-ad39-da97b9dda8be', 23, 12, 'lecture', 'Minus Qui Exercitationem Beatae Tempore Dignissimos.', 'Aut voluptatum corporis accusamus velit voluptatum sequi. Aut saepe qui laboriosam ducimus eius. Eum dolores pariatur vero quia. Non velit iusto asperiores atque laudantium.', 'article', '3.30', '<p>Est velit excepturi placeat aut omnis quisquam. Aut occaecati debitis amet suscipit sequi. Quidem qui deserunt impedit ipsam.</p><p>Quisquam tenetur ea dolorem quasi explicabo. Et ipsam cumque quibusdam animi. Minus perferendis minus maiores laudantium. Enim perspiciatis quas ipsum eum. Quod dolores tempore impedit in qui possimus. Ad modi dolores cum facilis exercitationem. Repellendus culpa architecto placeat ut. Quos sit enim eius cum odio numquam. Sit maiores corporis repudiandae unde autem quia. Eveniet occaecati similique veniam ut recusandae. Adipisci deleniti nostrum est sunt.</p>', 1, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(66, '52dd1a15-228a-4535-a2c0-b5d4324d4d8b', 23, 12, 'lecture', 'Perferendis Recusandae Est Voluptate Reiciendis.', 'Perspiciatis velit aliquam odio dolor. Molestias quos sit architecto porro aperiam inventore. Consequatur nobis sit nobis sint odit dolor perspiciatis.', 'youtube', '5.49', NULL, 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(67, '52fa7f1a-21cb-4dc6-b60d-af2d0fa7ebb4', 24, 12, 'lecture', 'Quo Explicabo Unde Odit Voluptate Id.', 'Aliquam minus quia beatae consequuntur rem. Et nemo pariatur minus ut sed.', 'article', '6.10', '<p>Temporibus temporibus dignissimos est necessitatibus voluptate ab numquam. Possimus et harum id et saepe repellat aliquid. Saepe voluptas eius facere accusantium. Voluptates omnis ea consequatur eius. Et rem sequi voluptate placeat inventore autem. Ea iure blanditiis natus quod. Hic quidem nihil nihil ullam aliquam. Eius iure deleniti ut nesciunt quibusdam. Quo voluptas labore rerum at. Ut ab aliquam optio quod.</p><p>Cupiditate minus veniam labore. Impedit quaerat doloribus modi. Voluptatem illum nemo ratione non vero consequatur. Nihil praesentium ut eum sunt minima perspiciatis. Aut sunt dolorum consequuntur natus illum alias quibusdam numquam. Illo voluptates sunt doloremque iste mollitia incidunt. Distinctio vel velit ea neque.</p>', 1, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(68, '0e4bce1b-a70a-4480-9442-7eeb0a462cf9', 24, 12, 'lecture', 'Velit Hic Ad Quis Et Earum.', 'Facere recusandae eaque dolore earum. Voluptatem minus maiores reiciendis et maxime sed nemo commodi. Occaecati nesciunt delectus est sed omnis. Nobis vero excepturi officiis aut quaerat ratione.', 'article', '7.45', '<p>Quis ducimus in omnis architecto assumenda sequi nobis. Rem beatae sed at quia ea eum. Consequatur doloribus aperiam magnam sunt odio quas ut. Deserunt molestiae ut sapiente perspiciatis hic sed repellendus illo. Earum exercitationem quia aut ipsum impedit est. Sunt ducimus rem omnis. Praesentium velit id libero repellendus assumenda non aperiam et. Corporis est rerum sunt delectus exercitationem officiis. Mollitia eaque cum eveniet excepturi omnis aut sed dolorum. Perspiciatis aut sed aut laboriosam vitae natus. Omnis quos fuga sint voluptatem explicabo quaerat. Deleniti iusto molestias et. Consequuntur commodi eveniet ratione.</p><p>Optio a non recusandae modi ut ipsa. Nam quas ut nesciunt voluptas enim temporibus itaque et. Distinctio alias repudiandae sed quae. Et voluptas culpa sequi quaerat quia earum optio similique. Repellendus eligendi facilis quis sit minima necessitatibus quam. Et necessitatibus voluptatem voluptas facere rerum quam ducimus ea. Velit dolore praesentium ut cum eum velit.</p>', 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(69, '850195be-c429-4bce-9f1c-fa1ec25bc29a', 24, 12, 'lecture', 'Excepturi Quo Ad Repudiandae Est Ut.', 'Ad ab corporis maxime repellat quia non illum voluptas. Unde est dolor labore. Numquam id odit quia natus voluptatem aut sunt. Aut nihil voluptatibus ut id molestiae. Et cupiditate quia magni reiciendis voluptate nesciunt.', 'youtube', '6.35', NULL, 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(70, '6c4d19ff-340c-4cda-829f-eb0b9924f49e', 25, 13, 'lecture', 'Quia Voluptatem Nostrum Dolores Officia Sunt Accusantium.', 'Quis ipsam est impedit. Earum ducimus illum error ut vel qui iusto. Quaerat quae saepe incidunt voluptatem.', 'article', '6.75', '<p>Expedita praesentium odit consequatur nihil illo nulla. Id tempora assumenda explicabo laboriosam tempora tempora doloribus. Quis necessitatibus voluptatem numquam nihil illo. Porro aliquam in rerum impedit assumenda. Saepe fugiat similique quisquam saepe. Cumque facere ratione expedita dolorem deleniti.</p><p>Quo id non odio aut rerum molestias. Cum vel est delectus sed tempore voluptas. Placeat dolor dicta labore adipisci consequatur. Porro ut quisquam aut. Aspernatur fugit dolor beatae eos pariatur dignissimos. Rerum est et at voluptatum. Quis et non sed quasi tempore quisquam occaecati cum. Inventore repellendus quia ullam placeat id et est.</p>', 1, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(71, 'c0bedeff-812a-4329-b970-09797c60948d', 25, 13, 'lecture', 'Cum Omnis Est Eaque Aut Sint.', 'Optio minus qui provident sint odit eos. Veniam recusandae magnam labore non. Eos inventore deleniti sit at exercitationem repellendus incidunt nesciunt.', 'video', '1.52', NULL, 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(72, '6a5a33d7-eb4a-4803-826a-7f023450284e', 25, 13, 'lecture', 'Et Officiis Quia Pariatur Aut Quis Voluptas Ipsam.', 'Fuga non et rem beatae labore ex maiores. Nostrum et in quaerat quisquam illo. Quis ab minima voluptate doloremque.', 'youtube', '6.32', NULL, 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(73, '04a251f0-a12a-4928-81a5-7e85bde8a00b', 26, 13, 'lecture', 'Quis Quas In Sit Est Nisi.', 'Cupiditate reprehenderit fugiat cum. Aut itaque cumque a velit. Nulla odio velit consectetur molestiae incidunt fuga impedit sed. Itaque eos iste sunt quibusdam.', 'video', '5.79', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(74, 'af76b7fe-415f-43f2-90bb-5a34efb42c7e', 26, 13, 'lecture', 'Laborum Velit Rerum Non Modi Molestiae.', 'Et repudiandae id aspernatur et iusto ut. Eveniet vel eligendi ullam quia. Nostrum eos eos eos provident voluptas laborum eaque.', 'article', '5.38', '<p>Sit ipsam voluptas aut fugit minima quam harum sed. Laboriosam illum exercitationem et ipsa consequatur. Id commodi at non deleniti possimus consequatur. In voluptatem et aperiam repudiandae illo est. Laudantium et sed iste quod corporis. Autem quaerat explicabo vel sint dolorum dolorum. Asperiores reiciendis beatae et minima ullam. Qui et voluptatibus sit exercitationem aut facilis odit. Aut aut et necessitatibus ducimus consequatur sunt illum. Sunt occaecati neque autem natus cum. Eos quae molestiae minus neque eum similique ea. Hic minus et cum ipsum magnam. Beatae est soluta ratione sed.</p><p>Ut nihil recusandae laborum nemo nesciunt similique. Voluptatem a sint quam velit laboriosam. Eos quae sed voluptas aut consectetur est. Eligendi rerum ipsam et ea eum aut nam in. Necessitatibus rem qui odit rem. Ratione sit blanditiis optio officiis dolor ipsam quibusdam. Omnis corrupti numquam laudantium reiciendis qui. Delectus id quis quisquam sint error similique.</p>', 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(75, 'd657f1ab-77c4-4033-9d83-c4cdc1ca4f2f', 26, 13, 'lecture', 'Quia Voluptatem Repellat Et Sed Debitis Necessitatibus Ipsa Aliquam.', 'Doloremque iure consequatur accusantium est. At dolorem dolorem eveniet voluptas. Blanditiis nostrum harum molestiae ut veritatis iure est.', 'article', '3.31', '<p>Veritatis commodi nostrum dolorem quidem nobis. Reiciendis accusamus omnis labore rerum laborum. Ipsum impedit itaque voluptate maxime. Non placeat molestiae distinctio mollitia non minima corporis. Sed excepturi et impedit aut similique sit et. Ipsa qui et sit. Perspiciatis eos similique sed minus voluptate quibusdam. Porro qui delectus totam laudantium dolores. Unde ducimus suscipit ut. Voluptatem possimus ex ipsum eveniet sit. Molestiae suscipit optio eos atque molestias quam impedit error. Minus facere nisi dolor laborum magnam. Culpa dolor commodi rerum ea quis.</p><p>Similique recusandae molestiae labore voluptates libero est. Et eveniet possimus neque ea cumque ut incidunt. Quia temporibus omnis error occaecati nulla consequatur. Voluptatem illo minus magni quibusdam quod quia perspiciatis. Quia modi quae illo et modi voluptatem. Rerum quo quia rerum laboriosam.</p>', 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(76, '063cfbdd-6554-46ad-8c51-7db39b70a8be', 27, 14, 'lecture', 'Placeat Dolore Odit Ipsam.', 'Error nihil dignissimos dolore cum error nostrum enim. Rerum quo enim aut repudiandae. Sint et officia et praesentium ad temporibus aut. Nam accusamus delectus aperiam quasi dicta.', 'video', '5.62', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(77, 'def0c5bc-3c54-4bdb-ae33-cff49ffd2419', 27, 14, 'lecture', 'Id Et Voluptas Voluptatem Quos Non.', 'Nemo iusto corrupti ex nisi debitis quasi. Architecto aut assumenda impedit totam laboriosam aut voluptas. Quam et minus velit officia eaque quas qui aliquam. Maxime fugiat dolorem tenetur ab ut asperiores libero.', 'youtube', '1.64', NULL, 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(78, '53d548ae-10f5-4211-9b75-7d9e57970851', 27, 14, 'lecture', 'Iure Quis Itaque Reiciendis Temporibus Consequatur Recusandae.', 'Quod sed atque omnis nisi non. Incidunt sunt iusto nobis similique modi eos aut nostrum. Nihil ab impedit sint at ullam.', 'article', '7.37', '<p>Architecto odit rem similique. Et maiores esse dolorem nesciunt aliquam ipsa. Suscipit modi vel magni quos officia. Facilis nesciunt voluptas libero explicabo. Cum qui iure et incidunt. Architecto eaque officiis dolorem est saepe cum accusamus.</p><p>At qui neque aliquid vel quis. Dolorum temporibus aut veritatis quibusdam quas molestias. Ab quae iure sint accusamus.</p>', 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(79, '769198d2-661e-47b4-947f-c4019484cfcf', 28, 14, 'lecture', 'Cumque Tenetur Enim Vel Sed Amet Similique.', 'Quod totam natus eum voluptas sint labore. Minima corporis laudantium et est voluptatem. Tempore dolores laudantium sint sapiente dolores.', 'youtube', '1.01', NULL, 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(80, '16171cbd-36cc-429e-b267-83b58855381d', 28, 14, 'lecture', 'Rerum Est Consequuntur Alias Alias Ab Ut Totam In.', 'Doloremque non quaerat impedit minima est reiciendis quisquam. Ab repellendus eius qui harum. Et aliquid corrupti dolorem porro voluptatibus sed sint facilis.', 'video', '5.60', NULL, 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(81, 'ff1e8022-f5df-4d26-93be-d33b3956db54', 28, 14, 'lecture', 'Officiis Et Quasi Velit Culpa Voluptate Laudantium.', 'Placeat vero aut aspernatur facilis sit ex sit minus. Sed ab error velit reiciendis. Maxime error recusandae minima veritatis ullam vel quaerat repellat. Est et qui occaecati tenetur et voluptatibus.', 'youtube', '4.03', NULL, 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(82, 'a75c32e8-56eb-49af-9c6e-084002fdbbf3', 28, 14, 'lecture', 'Ad Optio Aut Explicabo Laudantium.', 'Ad esse cum rem vitae numquam quasi molestiae. Et quaerat sint maxime voluptatem est. Repudiandae est aut tempora. Est ut odit necessitatibus fuga illo nulla quaerat.', 'youtube', '5.48', NULL, 0, 4, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(83, '4cb1aa9d-8a96-4758-8d62-7c675241a5e4', 29, 15, 'lecture', 'Aut Debitis Sed Minima Aut Vel Quos Modi.', 'Et velit explicabo veritatis aut porro saepe modi quisquam. Sit aut ut corporis consequuntur et. Sunt adipisci aperiam expedita aut. Voluptas eligendi ullam voluptas rem.', 'article', '2.14', '<p>Ut voluptate velit laboriosam voluptatem doloremque debitis in. In tenetur architecto sit ut. Atque nostrum numquam facere et in sed velit tempora. Ipsam suscipit tenetur corrupti occaecati voluptatem nam voluptas. Labore delectus provident eum eaque veritatis. Qui explicabo sit voluptatibus voluptatibus pariatur labore. Ratione molestias impedit veniam maiores. Numquam qui tenetur est. Architecto dolorem quo voluptatem aliquid voluptatem eos. Dolorem modi aliquid quidem consequatur libero illo.</p><p>Assumenda ex soluta vel ducimus veritatis animi debitis voluptatibus. Est neque dolores ipsa rerum et a. Aut libero saepe enim deleniti possimus. Accusantium voluptatem sunt explicabo in. Magni nobis earum similique mollitia debitis qui aliquam. Maxime officiis eum nemo repellendus voluptates temporibus voluptatem. Nemo laboriosam sed aut et molestias. Sunt eos nesciunt nulla delectus. Quas alias molestiae libero beatae dolores. Sit exercitationem rerum cumque libero velit. Ab modi qui et consequatur. Dolorem sit et quam voluptates sint fugit.</p>', 0, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(84, '09ed3720-9759-4a53-8fc6-341c190ce777', 29, 15, 'lecture', 'Aut Rerum Repellat Quis Odit Quas.', 'Maiores exercitationem harum impedit quo quia dolores. Labore et soluta voluptatem officia autem voluptatem reprehenderit. Autem qui impedit eveniet et. Occaecati molestiae saepe sunt saepe delectus sit.', 'youtube', '8.02', NULL, 0, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(85, '7fc903b5-bbb7-43a2-97ba-01d757fd77d7', 29, 15, 'lecture', 'Reprehenderit Necessitatibus Asperiores Doloremque Quidem Iusto Id.', 'Ipsam natus nisi praesentium at debitis sapiente corporis sapiente. Modi aut doloremque voluptates. Sit dolore maxime autem.', 'article', '3.72', '<p>Vel hic consequatur sed consequatur. Ab quidem consequuntur quae accusantium laboriosam. Explicabo neque et quidem rem odio architecto. Illum vero rerum aliquam. Molestiae mollitia voluptatem doloremque iusto et iure eos. Illum veniam quod eum non laborum possimus.</p><p>Quia est aspernatur suscipit distinctio facilis maxime. Quidem velit saepe sed laborum magnam consequuntur dolorum. Sit est non asperiores reiciendis sed recusandae. Ea ullam quas qui. Necessitatibus eos non odit et ut est. Illum unde sit aut iste aliquam.</p>', 1, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58');
INSERT INTO `lessons` (`id`, `uuid`, `section_id`, `course_id`, `lesson_type`, `title`, `description`, `content_type`, `duration`, `article_body`, `preview`, `sortOrder`, `created_at`, `updated_at`) VALUES
(86, 'ac529907-4590-4a05-beaa-9b96e9ec44a2', 30, 15, 'lecture', 'Reiciendis Quod Quia Harum Aut Animi Necessitatibus Perferendis.', 'Vel accusantium voluptas consequatur. Dolor velit ipsa ullam aspernatur aspernatur quis qui. Neque suscipit sed aut placeat. Non autem ea autem repellendus sed.', 'article', '5.31', '<p>Commodi laboriosam dolore tenetur harum. Recusandae ut doloremque perferendis sapiente quasi sed. Similique non qui asperiores provident sint voluptatem sint. Placeat ut et et omnis. Id enim voluptatem aut voluptatem. Voluptatem consequatur ea non voluptate. Autem eius veniam placeat consequatur rerum illo et. Aliquam et voluptates molestias quo quia accusantium. Ea odio officiis quis sunt libero recusandae. Est rerum necessitatibus quisquam quod. Molestiae distinctio aut ut odio aliquid. Totam quam modi maiores in. Nulla et dolorem inventore sit totam atque.</p><p>Corporis quis reiciendis et quod et doloribus. Eligendi fuga amet ex error. Alias cupiditate possimus laudantium similique rem veniam in. Inventore distinctio at hic commodi ut. Repellendus optio temporibus dolor vel qui velit. Est debitis ea quos doloremque optio libero iure. Minus officia aliquid dolorem ducimus eveniet iure maiores. Est odio accusamus blanditiis. Possimus quae velit consequatur iusto ipsum sed. Deleniti omnis et eos autem accusamus. Hic molestiae ut id modi pariatur dolorem reprehenderit.</p>', 1, 1, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(87, 'eb9b1c65-a0ac-4abe-a015-7265ffddaf42', 30, 15, 'lecture', 'Nostrum Et Autem Quia Dolores Omnis At.', 'Earum repellat tenetur necessitatibus in. Accusamus dolore harum ratione est neque. Molestiae mollitia a nemo voluptate.', 'article', '3.41', '<p>Molestias sit sint similique at est. Quo sit quae maxime qui. Expedita ea dignissimos ullam libero consequuntur eum est. Sed et rem vero quia ullam accusamus. Et quo beatae quis omnis numquam nesciunt possimus. Eveniet et repudiandae pariatur.</p><p>Voluptatum consequatur omnis rerum cupiditate ut recusandae molestiae totam. Incidunt eum et eum necessitatibus dolorem sit nihil. Natus odio voluptas cum facilis magnam. Ea doloribus quia maiores ab.</p>', 1, 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(88, '0dac3bc8-ea5f-427f-8d5e-ee02f7d1ab56', 30, 15, 'lecture', 'Ex Commodi Expedita Hic Cumque Velit.', 'Qui nulla et est repellendus. Non sequi tempore enim consequatur consequuntur aut. Qui voluptas dignissimos officiis eligendi eum.', 'youtube', '8.07', NULL, 0, 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(89, 'c732175e-9309-418c-8140-5f7616ab5835', 31, 16, 'lecture', 'Odio Cumque Officiis Dolorem Doloribus.', 'Voluptatum ut illo ratione quae. Est et modi error tempore blanditiis est. Ab nam quasi quidem harum. Error laudantium aut enim iure.', 'youtube', '0.50', NULL, 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(90, '38f4cc23-7e2d-4471-821e-d2634e890baa', 31, 16, 'lecture', 'Praesentium Repudiandae Voluptas Sint Rerum Soluta Distinctio.', 'Quas quaerat tempora et et assumenda voluptas natus. Qui autem fuga quasi reprehenderit quasi ut rerum. Provident omnis et consequuntur.', 'article', '6.35', '<p>Et corporis placeat in. Ad dicta non voluptatum et aperiam quia ratione tempore. Numquam beatae quaerat quis velit aut excepturi. Explicabo sit et praesentium.</p><p>Reprehenderit non consequuntur dolorum eum. Quia esse cum eius quia temporibus. Voluptas est a cupiditate dolore quos.</p>', 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(91, '72d26934-11c2-44cc-b0f8-b6de7fd0dd55', 31, 16, 'lecture', 'Qui Incidunt Voluptatem Quisquam Et Aut Veritatis Placeat.', 'Sed culpa odio et quidem. Vel quia animi ut odit dolorem. Pariatur voluptatem ad et culpa id debitis suscipit. Quia quae non sint maiores in.', 'article', '6.78', '<p>Fugiat consequuntur nemo quae ea esse. Corrupti ipsa fugit mollitia consequatur necessitatibus aut voluptatem. Qui ut culpa molestiae eos assumenda non ipsum.</p><p>Laboriosam consequatur iste ut ipsa sit animi. Minima eaque autem voluptas sunt quo. Delectus eos beatae quo omnis eveniet non. Expedita deserunt sit in illum esse. Aspernatur ipsa quod repellendus laboriosam vel suscipit a et. Corrupti similique ut facilis fugit expedita illum deleniti.</p>', 1, 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(92, '369d47d2-ba94-4d58-ba33-045e34652540', 31, 16, 'lecture', 'Nisi Occaecati Beatae Et Qui Officia.', 'Accusamus omnis voluptatum iure id optio cupiditate libero totam. Id eligendi consequatur dolores similique. Ut veritatis expedita consequatur vero. Animi sint necessitatibus doloribus in consequatur.', 'youtube', '2.31', NULL, 0, 4, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(93, 'c7ae0ea3-6263-4273-b9bf-d52822df051d', 32, 16, 'lecture', 'Animi Repellendus Ratione Veniam.', 'Autem non velit et dolor. Voluptatem est occaecati vel repellendus provident aspernatur error. Fugiat possimus deleniti voluptas id provident.', 'youtube', '5.17', NULL, 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(94, '1a10762d-0e16-4a86-87b6-1526732307bc', 32, 16, 'lecture', 'Sit Ratione In Perferendis Et.', 'Totam animi id molestiae tempore dolore harum. Quia rerum illo eos soluta velit. Et tempora quo quisquam ut. Maiores voluptatem aut repudiandae assumenda id.', 'article', '8.87', '<p>Labore beatae distinctio quae qui aliquam. Facere expedita sunt labore porro ipsum magni voluptatibus. Ducimus nam vero ex quis non. Consequatur cumque nihil illo provident asperiores eos totam. Explicabo adipisci odit ut dolorem est sint. Quidem quia quae atque porro dolores ipsam. Quisquam commodi ipsa quidem itaque velit at. In ut provident quis ullam.</p><p>Deleniti veritatis dignissimos odit ratione quo aliquid voluptas. Recusandae eveniet aliquid tempore nisi.</p>', 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(95, '91182da2-750b-45a8-a82a-0432c7b78a7a', 33, 17, 'lecture', 'Autem At Sapiente Id Iusto Et Magnam.', 'Dolore sit dignissimos non iure nihil porro eum qui. Minus dolor provident voluptatum corrupti. Non error non dolores voluptates. Minima ipsa illum repellendus quas et aut sint.', 'article', '4.62', '<p>Dolorem dolores totam illum voluptas est delectus. Eos aut dolor aut sint qui amet consectetur. Iste aut quo vitae non omnis error. Explicabo corrupti numquam aut non et. Ut excepturi est vel id dolorum ut esse. Vel voluptatem sint assumenda quis. Totam non illo voluptas rerum totam consequatur.</p><p>Ea aspernatur odio placeat tempora dolorum. Nihil totam ut voluptate ab sunt harum voluptas. Ipsam officia dicta voluptate provident.</p>', 1, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(96, '0dcf79c2-48ab-4db9-8182-42340b8b2153', 33, 17, 'lecture', 'Optio Qui Numquam Totam Vel Modi Illum.', 'Nisi consequuntur similique rerum consectetur corrupti debitis qui voluptatem. Cupiditate voluptate aperiam deserunt non magnam dicta ipsam pariatur. Enim omnis assumenda non nostrum. Autem accusantium modi enim.', 'youtube', '1.69', NULL, 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(97, 'c30dad9a-72ec-4b39-8457-488c80c551c7', 33, 17, 'lecture', 'Dolores Minima Praesentium Rem Ea Incidunt Reprehenderit Ad Nemo.', 'Officiis aut quae consequatur quo deserunt recusandae. Qui ut aperiam perferendis qui quod iure. Quia qui voluptatibus et.', 'youtube', '8.18', NULL, 0, 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(98, '88bedd31-7769-4de0-a0c8-6eba9ce490d8', 34, 17, 'lecture', 'Et Odit Tempore Culpa Porro Accusamus Laudantium Ratione.', 'Delectus harum qui ut quia. Consectetur maiores occaecati laboriosam est iste impedit sint nesciunt. Quaerat iusto adipisci quia sequi impedit. Et voluptate dignissimos sequi aperiam repudiandae quia.', 'article', '2.32', '<p>Qui illo voluptas cupiditate aut non maiores ad. Occaecati voluptatum et quis modi suscipit. Dolores quas aut libero.</p><p>Voluptates velit ut voluptatem nobis pariatur ut. Dolores recusandae enim quos qui consectetur neque labore. Nulla quas necessitatibus aspernatur sit. Laborum ipsam deleniti consequatur ad. Deserunt eum ducimus velit itaque quia et.</p>', 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(99, 'f285f0f2-a0b2-4135-a0c3-9114f831dc21', 34, 17, 'lecture', 'Possimus Explicabo Et Qui Ipsam Accusantium Et Quibusdam Natus.', 'Aspernatur est veritatis omnis harum et culpa. Est ut recusandae dolores perspiciatis numquam est et quis. Est in voluptatum quas. Similique molestiae ut distinctio dolorum.', 'youtube', '7.24', NULL, 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(100, '8b92c995-a76d-4c80-b39e-4f699157ff3e', 35, 18, 'lecture', 'Totam Ut Recusandae Et Accusamus Est Non Doloribus.', 'Quis rerum sint fuga consequatur. Nam magni occaecati sit dolorem pariatur aliquid.', 'youtube', '4.08', NULL, 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(101, 'b82fd233-53a1-4f94-98ba-c38678457aa0', 35, 18, 'lecture', 'Enim Qui Illo Necessitatibus Omnis.', 'Cumque quos expedita omnis voluptas. Pariatur aut aliquid deleniti consequatur id ipsam maiores. Corrupti ea non totam minima magnam quae sequi.', 'video', '9.71', NULL, 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(102, 'fec823f7-c91c-498a-9175-fc3048b3d8f7', 35, 18, 'lecture', 'Sit Sit Ex Ullam Veniam Similique.', 'Id laudantium dolores ut voluptate voluptatem. Rem soluta soluta et quia velit optio non sunt. Eum occaecati molestiae et. Laborum sit repudiandae rerum facere reiciendis dolorum aliquid.', 'article', '8.32', '<p>Esse totam et recusandae soluta et illum. Exercitationem aut qui rem rem molestiae reprehenderit. Aut similique omnis libero excepturi ab voluptatem sint quae. Vitae repellat quo eos est amet sint.</p><p>Vel facere voluptatibus aut qui dolorem. Ut perspiciatis dolorem atque rerum nihil perspiciatis commodi. Qui sint deleniti ut nobis. Qui voluptatem tempore labore praesentium consequatur. Ut ducimus quia consectetur. At vero consequatur commodi qui.</p>', 0, 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(103, 'd267bb01-0142-47ea-aba1-bd008035fead', 36, 18, 'lecture', 'In Voluptates Dolores Fugiat Eligendi.', 'Quis ex magnam est occaecati. Neque aut voluptates qui fugit tempore.', 'youtube', '4.22', NULL, 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(104, 'f573e902-016e-474f-8db2-d9bb36510b87', 36, 18, 'lecture', 'Provident Odio Fuga Inventore Velit Rerum Quaerat.', 'Cumque laudantium excepturi perspiciatis rerum dicta ut temporibus laboriosam. Ea odio quae rem eum ut. Aut alias vitae quae facilis sed amet. At sint sed qui cumque perspiciatis est quos.', 'youtube', '1.64', NULL, 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(105, '2d87e8ca-dd18-40a5-a18b-1478dc667dcf', 37, 19, 'lecture', 'Aperiam Quos Pariatur Autem Ut Nulla Rerum Voluptas.', 'Tenetur enim cum aspernatur voluptatibus. Sapiente earum neque vel et dignissimos. Amet vero sequi vitae unde ad.', 'youtube', '7.19', NULL, 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(106, '731e9843-c969-408a-82fa-604486b28bc6', 37, 19, 'lecture', 'Dolor Voluptas Ea Vel Et Maiores.', 'Molestiae voluptatem expedita inventore enim facere aut voluptate. Eveniet hic non facere fuga. Enim molestiae id exercitationem sequi non quia. Officia eligendi fugit ullam aut magnam eos dicta. Optio laboriosam dicta enim quos quasi maiores.', 'article', '7.15', '<p>Iure corporis consequatur rerum tempore expedita. Sit corporis tempore amet eum corrupti laboriosam. Quos autem doloremque quaerat. Maiores id ipsam facere beatae. Maiores architecto eum molestiae cupiditate rerum assumenda laudantium qui. Aspernatur et quo officiis nobis earum dignissimos qui. Ea commodi a velit accusantium tempora. Incidunt voluptas molestiae omnis aut. Non veritatis doloribus ipsam modi labore quas asperiores. Qui eaque sed quae sint rem sed.</p><p>Ipsum dolorem perferendis aut sed sit commodi quia aperiam. Qui distinctio alias adipisci rerum aspernatur quas sint fuga. Ut ut accusantium optio maxime voluptas. Voluptatibus odit dolorem aut et facere distinctio provident. Quibusdam dolor est et voluptatem est iure. Et quo sed corrupti asperiores.</p>', 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(107, '56952f47-fa16-445e-836e-0c9b80d16d62', 37, 19, 'lecture', 'Eligendi Placeat Quia Enim.', 'Nesciunt quis sit corporis est veritatis. Inventore facilis et enim et temporibus. Ut voluptatum cum voluptatem eum. Dolorem nisi dolorum temporibus. Nihil repellat hic placeat accusantium.', 'youtube', '2.10', NULL, 0, 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(108, '3eb8ed23-52a3-4bd5-9885-760487d526d1', 38, 19, 'lecture', 'Et Enim In Autem Aliquid Nam Ratione Quasi Debitis.', 'Perspiciatis enim facilis placeat. Blanditiis amet consequatur doloremque nihil voluptatem totam. Ex et quam quos occaecati ut et necessitatibus.', 'video', '4.31', NULL, 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(109, '642e4381-53c7-440d-bcaa-f1d2bc2ff00a', 38, 19, 'lecture', 'Dolore Ut A Esse Error.', 'Voluptatem est iusto corrupti enim nostrum nihil. Et modi nam dolores libero commodi omnis. Consequatur est iste amet magnam iure voluptatem voluptas.', 'video', '3.12', NULL, 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(110, 'e2bbd121-a23c-4109-9429-2debf0c17ae0', 38, 19, 'lecture', 'Rerum Rerum Ut Nostrum A.', 'Non impedit natus facilis voluptatem et inventore. Sint culpa minima accusamus enim hic omnis. Et nobis ut est quisquam.', 'video', '1.62', NULL, 0, 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(111, 'aa2b0871-86be-4419-b9fa-c7c5aa448419', 38, 19, 'lecture', 'Qui Sed Fuga Neque Aspernatur.', 'Perspiciatis qui neque quis ipsam eligendi et. Aut sed modi nisi velit dolores voluptate. Deserunt vel quibusdam minus ut.', 'youtube', '1.88', NULL, 0, 4, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(112, 'c6866df8-0a4b-4010-b22b-bd5925ce0109', 39, 20, 'lecture', 'Sunt Molestiae Aspernatur Qui.', 'Et distinctio voluptate tenetur sint maiores maxime blanditiis. Magni sapiente rem rerum velit voluptate. Vel quam omnis id dolor ut laudantium voluptates fugit. Excepturi minus iste et explicabo aut nostrum.', 'article', '1.88', '<p>Similique ut fuga molestiae dolorem. Nobis quia omnis sapiente omnis sint facilis. Commodi et quaerat nostrum libero. Veritatis esse eligendi earum iste quos. Dolor neque quasi doloremque omnis qui laboriosam. Libero cupiditate maxime aut quidem aliquam qui. Quia expedita facere rerum odit sit. Voluptatem molestias et animi deserunt. Quae inventore et officiis. Ratione quia asperiores eum non modi. Cupiditate quis repudiandae maxime possimus harum eligendi.</p><p>Dolorem quam illum modi quaerat magni. Corrupti itaque recusandae facilis quo sit numquam facilis molestias.</p>', 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(113, '3fc3b358-f35a-4fe2-861d-9e4ae9252ad4', 39, 20, 'lecture', 'Repudiandae Enim Perferendis Voluptas Quia.', 'Quo ea incidunt non eum. Libero velit rerum ipsam nisi.', 'youtube', '8.74', NULL, 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(114, '609a692b-c7a1-4312-9b54-bb38b04a3790', 40, 20, 'lecture', 'Quo Velit Voluptatem Veniam Id Iusto.', 'Recusandae omnis maiores hic qui. Dolores qui error voluptatem delectus. Possimus molestiae et doloribus voluptas aperiam.', 'youtube', '1.21', NULL, 0, 1, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(115, '681aa9ec-f0e0-4286-bc7e-7ff29d995782', 40, 20, 'lecture', 'Doloremque Consequatur Ut Natus Quia Quas A.', 'Et a architecto sit quisquam. Quis aut hic provident qui. Doloremque doloribus odio necessitatibus quos distinctio.', 'video', '6.10', NULL, 0, 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(116, 'cf61a06d-e026-4bde-b922-184c4990af91', 40, 20, 'lecture', 'Mollitia Velit Dolores Qui Architecto Quia.', 'Ipsum sit cumque ipsam error beatae. Iusto natus minima perspiciatis consequuntur. Ea et vel molestiae ipsa beatae. Harum blanditiis nemo nesciunt illum praesentium rerum alias.', 'article', '2.93', '<p>Nulla et sed eius aut. Consequuntur quae sunt dolor molestiae voluptatem ratione assumenda. Sequi aut dolore cum veritatis magnam aut. Et ratione beatae enim dolores in occaecati dolor. Temporibus quia maxime dolorem. Consequatur enim repudiandae est et. Alias atque harum nulla. Saepe deleniti non sapiente sed aut. Doloremque esse rerum earum ipsam possimus voluptatibus odio. Rem culpa cum ratione et velit autem. Adipisci illum rerum sequi culpa repudiandae dignissimos itaque. Architecto dolor unde exercitationem rem ipsa sunt. Suscipit dolor ut labore. Sed sit aliquam rerum.</p><p>Qui enim ratione rerum esse nemo aut inventore. Esse qui voluptatem exercitationem alias. Autem sed veritatis hic fugiat est et asperiores. Consequatur laborum nostrum error nesciunt ut recusandae facere. Quia et dicta et dolore minima aut. Nulla consequatur placeat dicta aut eum.</p>', 1, 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(117, '414b953e-5b1d-407b-89ec-b9968cef3f58', 41, 21, 'lecture', 'Omnis Et Aliquam Qui Neque Cupiditate.', 'Et neque ut enim omnis sequi aut ex. Voluptatem culpa maiores quaerat modi magni hic. Quae et est ipsam est. Aspernatur eos minus dolorum et id maxime nulla.', 'youtube', '6.89', NULL, 0, 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(118, '4fd002f5-d440-47ae-a707-ae9a2646c459', 41, 21, 'lecture', 'Quos Nihil Ex Occaecati Doloribus Optio Nulla Praesentium.', 'Eligendi explicabo totam qui ut consequatur sint optio voluptatibus. Praesentium corrupti facere temporibus iusto voluptates. Consectetur voluptatibus unde deleniti officiis omnis consequatur quasi. Distinctio illum molestias magni repudiandae unde. Earum molestias est sint incidunt quae eveniet et.', 'youtube', '6.59', NULL, 0, 2, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(119, '80e2a03b-e73a-45ff-b656-c5a8b015e6f1', 41, 21, 'lecture', 'Inventore Et Eius Consequuntur Animi.', 'Maiores aut voluptatibus delectus repellat. Quae vitae ut et sit veritatis consequatur modi.', 'video', '6.10', NULL, 0, 3, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(120, '0f8045c7-0ad2-4706-8282-fec69ea7b5c2', 42, 21, 'lecture', 'Repellat Minus At Adipisci Corporis Libero Nam Asperiores Eaque.', 'Et laborum quia quisquam soluta quo est deleniti. Est placeat quo dignissimos recusandae. Odio consequatur libero placeat voluptatum. Nesciunt earum temporibus qui optio qui ut recusandae voluptas.', 'video', '7.22', NULL, 0, 1, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(121, 'f101803e-603d-4c62-9aca-7bd932f92265', 42, 21, 'lecture', 'Nemo Nulla Ut Praesentium Rerum Aut.', 'Quis et ipsam cum quasi sit aut. Sunt sequi minus cumque optio. Repellendus dolores aut omnis quod soluta aut voluptas.', 'article', '5.60', '<p>Accusamus iusto atque voluptatem et assumenda. Deserunt ut quae perferendis consectetur enim. Nam impedit quas inventore sed ratione nihil nesciunt. Totam molestiae ut nihil ipsam sequi earum voluptate molestias. Voluptas ea odio voluptatem omnis.</p><p>Dolor quam architecto id rem. Ut aut eum aliquam labore. Dolorum rem recusandae sed in minima sint velit. Repellat quis magnam ad quisquam quia nisi deleniti. Ipsum a magni nemo ut minus molestiae rerum. Aut possimus accusamus error est eaque quidem eum. Necessitatibus alias perspiciatis in. Quibusdam dolorum occaecati ipsum. Sit exercitationem modi ad nemo enim.</p>', 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(122, '89f6dbbc-0148-4f45-b910-c0ded73a9d45', 43, 22, 'lecture', 'Ab Quae Sed Sequi Rerum.', 'Blanditiis nihil facilis itaque incidunt molestiae minus velit. Autem iste eveniet qui cupiditate aperiam aliquid. Sed possimus velit autem neque. Unde neque molestias laboriosam eum numquam excepturi.', 'video', '1.55', NULL, 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(123, 'f147e01a-1927-4f57-845c-a832cde71c31', 43, 22, 'lecture', 'Ex Sunt Totam Eius Veritatis Harum.', 'Sint vero itaque accusantium excepturi in sint ut. Impedit est est tenetur omnis molestiae. Delectus quo minus mollitia vel dolores qui quas.', 'video', '5.20', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(124, '774a6a3a-cad6-4d73-9a5a-80625ed1c994', 43, 22, 'lecture', 'Modi Nesciunt Sunt Tempore.', 'Id quidem nisi suscipit minus esse sit optio. Magni ut sunt unde voluptatem nihil deserunt repellendus at. Ex ullam repudiandae ipsam exercitationem dicta. Et eos blanditiis ut sint sed earum.', 'youtube', '9.95', NULL, 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(125, '9319cc61-cd41-411a-b4ba-64989b1738fb', 44, 22, 'lecture', 'Sint Sit Suscipit Libero Ipsum Ipsum Id Et Officia.', 'Totam vel excepturi tempore ipsa omnis cum. Blanditiis architecto et porro est rem non. Reiciendis et non dolores occaecati sed.', 'article', '6.05', '<p>Quasi natus fuga iste corrupti. Odio quasi natus recusandae enim facere. Ducimus dolores expedita dolorem itaque magnam.</p><p>Nostrum sunt eos sit quia voluptas et. Rem at nihil dolore et id autem accusamus. Suscipit ut autem ad aut. Voluptatem et architecto quia sequi. Omnis placeat quis rem. Aut et est id. Fuga dignissimos nam quis corporis facere. Tempora magni laudantium et quisquam ut quia. Reiciendis placeat laborum praesentium aliquid quae ut sint aliquid. Fugiat corrupti odit dicta nihil. Amet nam distinctio quia illum non corporis earum.</p>', 1, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(126, '079762c6-1ca2-44f0-8e3e-6aaba3e3e88a', 44, 22, 'lecture', 'Sint At Aperiam Dignissimos Non.', 'Consequatur architecto et minima rem numquam doloremque. Sequi ipsum et quis dolor excepturi.', 'video', '1.48', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(127, '1b0f18b2-1ff9-4b0c-bcd7-2c96210625bd', 44, 22, 'lecture', 'Quis Corrupti Minus Sed Fuga.', 'Corporis eos expedita quasi animi. Aut nulla non minima voluptas enim. Debitis omnis ut debitis maiores possimus. Veniam ut id laboriosam ut cum illo.', 'youtube', '7.20', NULL, 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(128, '3242a2f2-8b6e-4183-9eb6-daaccb73eaa5', 45, 23, 'lecture', 'Nulla Ut Quisquam Qui.', 'Dolores impedit voluptate nesciunt et nihil modi. Non maxime quos laboriosam. Perferendis qui unde voluptas officia.', 'article', '1.55', '<p>Quos debitis minima alias quis. Natus rem non voluptas qui voluptatibus. Et dignissimos enim et ut totam ea dolores. Doloribus earum voluptas rerum impedit veniam.</p><p>Voluptatem velit voluptatem et eaque delectus tenetur ab. Perferendis corporis maxime et ullam soluta animi. Reiciendis sed quod id alias occaecati minima. Aut officiis quam commodi quo molestiae quis. Incidunt quia rerum omnis itaque hic nobis placeat sed. Blanditiis cupiditate consequatur accusamus voluptatem voluptas quo officiis.</p>', 1, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(129, 'c26f1b56-87a4-4de1-83d2-b7535ce6933a', 45, 23, 'lecture', 'Nihil Modi Minima Eligendi Veniam Molestiae Quis.', 'Quis consequatur omnis reprehenderit sint libero. Repudiandae soluta ut mollitia consequuntur odio adipisci. Vel aperiam dolor quis quo eos.', 'youtube', '5.90', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(130, 'ed7c13fb-a9a7-4f9e-bfaa-0bb679fb14ed', 45, 23, 'lecture', 'Sint Neque Corporis Consequuntur Consectetur Assumenda Quaerat Fuga.', 'Molestiae voluptates et aut mollitia aliquam molestiae neque asperiores. Distinctio qui rem voluptas voluptas doloribus animi non esse. Eveniet rerum dolorem distinctio neque. Repudiandae fuga repellat id ipsa officiis voluptas.', 'video', '1.90', NULL, 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(131, '429bc95e-fd7f-42b5-81b9-042cd5b3f26c', 45, 23, 'lecture', 'Nemo Consequatur Distinctio Culpa Qui.', 'Et praesentium mollitia et dolores ullam eum sit. Aut modi dicta laborum. Rem ea dolore consequatur possimus et aut cum. Placeat exercitationem aut facere soluta eius.', 'article', '2.49', '<p>Numquam accusantium amet est et nihil vel. Aliquid quia qui natus explicabo molestiae. Sint eum nisi qui similique iste facilis consequatur culpa.</p><p>Expedita beatae iusto quidem qui sit nostrum est. Consequatur consequatur consequatur dolorem voluptatum. Minus repellendus ut laboriosam.</p>', 1, 4, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(132, '59e72c06-6788-4e03-853c-4c6d3ce7b78c', 46, 23, 'lecture', 'Dolor Consequatur Voluptate Rerum Id Ipsam Dolorem Cum.', 'Vel et porro vero voluptatem laboriosam. Laudantium facere sint omnis est magnam. Qui eaque minima animi.', 'article', '8.12', '<p>Qui vel facere omnis ut. Beatae voluptatem sunt beatae dolorem aut quod. Ratione ut dolores accusamus debitis.</p><p>Velit et earum sint molestias facere atque. Explicabo aut tempora magni quod et sit saepe et. Itaque quo atque eos autem labore dolor. Fugit nulla perspiciatis illum illo consectetur id. Culpa eligendi deserunt sunt. Officia suscipit ut sunt sunt sit. Sunt quis aut necessitatibus voluptas dolorem voluptatem molestiae. Dolor est aut et minima sed. Et ab excepturi corrupti praesentium voluptatem. Velit rerum repellat necessitatibus quia dolor. Nesciunt soluta ex quia dolorem. Qui adipisci soluta voluptatem rerum fuga tenetur aut. Et delectus dolorum illo. Non voluptas dolore ex expedita voluptatum placeat.</p>', 1, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(133, '05e5da93-a86a-4a8f-8860-3b05caa6056d', 46, 23, 'lecture', 'Asperiores Quo Ut Velit Fugiat.', 'Ut unde delectus suscipit minima vero consequuntur. Inventore et voluptas deserunt sunt quos dolor sint. Sint minus hic ut eveniet. Quidem accusantium voluptas blanditiis facilis veniam.', 'video', '4.19', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(134, 'e0f3deed-9414-46c7-ba2d-96c721660ec1', 47, 24, 'lecture', 'Molestiae Nihil Consequuntur Est Maxime Odio.', 'Facere at voluptatem dicta fugiat. Qui ut sint quaerat dolorem placeat atque. Architecto vel fuga voluptas illum.', 'article', '9.49', '<p>Omnis rerum et ipsum. Magnam voluptatum laudantium perspiciatis et ipsam. Nihil vitae rerum voluptatem autem molestiae cupiditate voluptates.</p><p>Et animi vel voluptas. Magnam exercitationem ut est suscipit nisi dolorem.</p>', 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(135, '74441e3a-5313-453f-8e8d-aa2a71b89823', 47, 24, 'lecture', 'Eum Rerum Voluptatem Ut Consequatur.', 'Ducimus et iure aut. Voluptas veniam dolores quibusdam sit alias reprehenderit. Fugit totam deleniti rerum officiis.', 'youtube', '5.77', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(136, '8f8fc8fb-eacc-4801-9ff8-784f1d411442', 48, 24, 'lecture', 'Et Est Illum Iure Qui.', 'At tempora nulla saepe aliquid et modi. Et vero sunt placeat. Eos magnam ut ut.', 'article', '5.90', '<p>Repudiandae sed quo earum minima. Adipisci repudiandae incidunt mollitia et eum ipsa quidem. Iste praesentium perspiciatis praesentium qui sequi molestias at qui. Commodi aliquid suscipit nihil quibusdam sunt rerum. Vero saepe quia debitis sit qui. Ducimus rerum molestias dignissimos libero ipsa minus aperiam. Omnis at facere cumque dolorem. Id nulla labore odit placeat praesentium. Consequatur aliquam explicabo quasi eum aut sit.</p><p>Sed minus delectus expedita eum reiciendis minima. Dolores aperiam et ut et. Fugit est quis et vel molestias laudantium.</p>', 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(137, '4089ef59-407e-42f0-8742-a9de30c8896d', 48, 24, 'lecture', 'Et A Aut Eos Et Recusandae.', 'Consequatur veniam sed fuga. Voluptate sed possimus ut unde repudiandae eveniet. Voluptatibus facilis dolor vel vitae rem et iure. Repellat eaque a quidem corporis voluptas nihil.', 'youtube', '2.59', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(138, '017a355d-9596-4f6f-b975-1723e88c3d5e', 49, 25, 'lecture', 'Totam Ratione Ut Quis Maxime Quos.', 'Corporis ipsum tempora quia corrupti fugit. Voluptas culpa quia et aut qui. Doloribus repellat facilis eos rerum.', 'video', '6.41', NULL, 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(139, '5517389a-4cb0-46eb-919e-734214962bc1', 49, 25, 'lecture', 'Praesentium Aliquid Aut Recusandae Adipisci Aut Assumenda Praesentium Consequuntur.', 'Accusantium earum labore eos dignissimos. Est vel rerum qui et cum impedit aut vel. Consequuntur labore explicabo animi a. Enim aut odit ducimus expedita quo.', 'youtube', '7.85', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(140, '52ebe731-7239-48a8-b0f6-5e864b5897a7', 49, 25, 'lecture', 'Esse Ea Sit Aliquid Aut.', 'Enim distinctio suscipit sapiente ea accusantium aut. Fugit itaque qui dolores inventore facere adipisci eveniet. Dignissimos ratione molestiae in qui voluptatibus tempora. Pariatur sit et suscipit enim.', 'video', '5.51', NULL, 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(141, 'd8228432-96a1-4f71-a487-905dcf3b500a', 50, 25, 'lecture', 'Consequuntur Repellat Provident Rerum Et Occaecati Quam.', 'Qui sint non sapiente aspernatur illum illo laborum repellendus. Doloribus perspiciatis qui sed placeat. Assumenda eius labore qui officiis.', 'video', '2.36', NULL, 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(142, '44bd3848-9ba7-497a-8d4c-080f1db1012e', 50, 25, 'lecture', 'Vel Est Aut Ipsam Maiores.', 'Eos placeat numquam ullam dolores. Esse veritatis nihil mollitia in quo excepturi. Quis ipsa eos sed culpa sit.', 'article', '8.30', '<p>Delectus natus dolorum facilis iste voluptatem aperiam. Voluptatem blanditiis fuga voluptatem dolor veritatis voluptates mollitia. Laudantium reiciendis et est dolore.</p><p>Consequatur ad fugit repellendus veritatis quia et. Molestiae repellendus eligendi quam qui tempore omnis. Vitae sit qui ratione fugit possimus quae. Quis rerum dolores dolor totam quia voluptas.</p>', 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(143, 'be3d0a02-5ea8-43c5-8842-0eafd64f81d5', 51, 26, 'lecture', 'Similique Nesciunt Impedit Recusandae Eum.', 'Quaerat praesentium aut molestiae dignissimos. Perferendis provident quos quae ea quo enim. Ipsa praesentium et est laborum rem voluptatem rerum.', 'video', '6.39', NULL, 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(144, '11fcb843-ab86-4376-a866-237ff495cfbe', 51, 26, 'lecture', 'Rerum Soluta Reprehenderit Impedit Quibusdam Assumenda.', 'Non est culpa dolor ut error. In dolores voluptas consequatur voluptatem natus. Vel quod eveniet officia quo est. Veniam sed hic modi laudantium dolor et.', 'video', '0.98', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(145, '37d52f77-7921-4a36-b503-8984cd227e16', 51, 26, 'lecture', 'Dolores Molestiae Nobis Nihil Qui Ut Unde Perspiciatis Adipisci.', 'Et omnis voluptatem nam recusandae velit necessitatibus voluptatem. Non repudiandae placeat eos consequatur expedita et et. Et doloremque voluptas ea laboriosam et possimus.', 'youtube', '7.09', NULL, 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(146, '8d16ac4c-6e57-4b99-9df4-52e32fc5e3fa', 51, 26, 'lecture', 'Suscipit Fugiat Atque Quis Nulla Ab Dolores Sit Aut.', 'Non voluptate maiores ratione quasi porro sed. Molestias officiis eaque sunt eveniet est. Molestias quam fugiat ut voluptas facilis. Dolorem qui nemo culpa et.', 'youtube', '9.86', NULL, 0, 4, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(147, '68a11b5d-edff-4e9e-abdd-1786858d7647', 52, 26, 'lecture', 'Odio Vero Odio Qui Cumque Ad Aut Quidem.', 'Perspiciatis totam et in non et. Optio rerum omnis eius perspiciatis. Id soluta exercitationem consequatur adipisci sed dolorem est. Voluptatum quia illum qui alias blanditiis.', 'article', '9.88', '<p>Ea dolor aspernatur enim eum rerum dolorum aut fuga. Est illo consequuntur et inventore. Voluptas et eum rerum. Et repellendus consequatur facere qui ipsa quis. Odio nisi atque nisi et itaque voluptatum ipsam molestias. Delectus est ad eaque eos. Sit id fugiat et ut occaecati. Aliquid tempore voluptatem sapiente quo.</p><p>Eos maiores accusantium beatae et. Asperiores cum omnis dolorem delectus. Quia dolor dolorem officia consequuntur itaque commodi eligendi. Minima facere magni quidem necessitatibus quo. Ut occaecati a repellendus aut voluptatem. Deserunt aliquam eligendi incidunt laborum veritatis dolores sed dicta.</p>', 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(148, 'c69ffa22-ef2e-45c3-862e-762cc9b380ee', 52, 26, 'lecture', 'Necessitatibus Voluptatem Architecto Dolore Ipsa Non Non.', 'Minima aut non quia eos quaerat ut. Consequatur numquam adipisci optio corrupti aut perspiciatis. Magni et voluptates ut laboriosam et ut odit. Fuga aliquam ea eligendi dolorem ut. Nesciunt voluptatum modi maiores sed molestias.', 'video', '9.99', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(149, '717e47bc-7398-4613-8c3f-0f883cfee651', 52, 26, 'lecture', 'Ut Aut Id Blanditiis Harum Soluta.', 'Eligendi aut quaerat consequuntur expedita. Quia voluptatum culpa ex quia voluptas inventore. Sapiente officia quasi molestiae quidem doloremque odio. Excepturi labore eveniet qui.', 'video', '2.75', NULL, 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(150, 'bbd1370e-e85f-417d-9f41-4eaa2fa61e51', 52, 26, 'lecture', 'Cupiditate Consequatur Reprehenderit Sed.', 'Eius ut explicabo nihil ut. Maiores velit ea ut quaerat. Dicta praesentium illo ut eaque omnis voluptatem. Consectetur quis reprehenderit voluptas quis in similique voluptatum.', 'youtube', '7.35', NULL, 0, 4, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(151, 'dc9182cd-fa9b-47fe-89ed-4b34379039bf', 53, 27, 'lecture', 'Consequatur Non Earum Dolor Qui Et.', 'Ut illo eligendi neque sit. Eos qui quisquam commodi aspernatur. Molestiae consequatur omnis porro et non eveniet quia corporis.', 'article', '6.88', '<p>Et inventore ullam hic eos. Saepe totam vel sed. Id rerum deleniti voluptate. Ipsum ipsum rerum numquam qui suscipit. Eum ut beatae velit et illo sit ad.</p><p>Perspiciatis aliquam pariatur cupiditate aut. Totam culpa ullam quis enim quas. Ut dolor id rem in. Nihil laboriosam esse vero porro et recusandae est. Fugiat deserunt reprehenderit repudiandae praesentium. Illo non beatae et repudiandae aut molestiae quasi. Eius qui mollitia ipsa facilis qui. Qui modi quis corrupti vitae consequatur quos possimus quisquam. Omnis quia culpa nemo sunt voluptate reiciendis dolores.</p>', 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(152, 'ca1a5fe8-5cca-4778-99f4-2e8a11b8cacd', 53, 27, 'lecture', 'Recusandae Sit Labore Vel Qui Illum.', 'Ea voluptate voluptatem veritatis illo similique dolor. Et expedita quaerat omnis praesentium numquam nihil. Aperiam voluptatum quibusdam consequatur adipisci facere dolores doloremque. Iusto quo vero culpa qui officia nihil.', 'youtube', '9.45', NULL, 0, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(153, 'd55dc576-6b2b-47a3-85d2-bc924c28d41b', 53, 27, 'lecture', 'Id Ex Ut Reprehenderit Deleniti Quo Harum.', 'Quia modi quasi harum id magnam ipsum vel quia. Commodi tempora ipsa dignissimos accusamus. Error aut quisquam ipsam tempora aut impedit deserunt.', 'video', '5.20', NULL, 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(154, '6e1bae1c-5a1e-4fe6-844b-da4845761e3e', 53, 27, 'lecture', 'Accusamus Quae Eos Et Ullam Velit Delectus.', 'Iure tenetur iure quibusdam sint et. Assumenda iusto placeat quo placeat et corrupti. Quibusdam facere consectetur occaecati.', 'article', '8.04', '<p>Quos cumque ipsam nulla quia quas alias. At doloremque qui beatae voluptas voluptate cumque. Architecto delectus pariatur ratione ex qui nisi iure. Consequatur doloremque iure placeat laboriosam. Aspernatur dignissimos sed voluptatem illum magnam. Voluptates enim ut qui explicabo pariatur odit. Voluptatem provident assumenda minima quia quo eveniet sint. Et maxime dolor optio ut.</p><p>Hic nostrum et totam vitae soluta accusamus repellat. Quia soluta iusto perspiciatis dolorem. Facilis veritatis fuga esse facere vitae in et at. Repellat dolorem quasi voluptatibus quibusdam saepe. Culpa ad perferendis tenetur earum sunt et consequatur tempora. Dolorum eaque est explicabo corporis omnis odio.</p>', 1, 4, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(155, '10836f0a-cac7-4435-b025-939854428718', 54, 27, 'lecture', 'Aliquam Eum Voluptates Et.', 'Sed soluta quia cupiditate. Reprehenderit dolores quam enim et et tempore consequuntur. Illo aut distinctio dolores rerum delectus dolor natus. Debitis accusamus labore rerum non. Sapiente perferendis explicabo officiis rem architecto et officiis.', 'video', '4.34', NULL, 0, 1, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(156, '485041f9-c328-43a4-9dc7-a51208f0aafe', 54, 27, 'lecture', 'Saepe Tempora Dicta Est Itaque.', 'Doloribus quod aliquam ab autem accusamus consequatur. Commodi id impedit enim rerum. Reiciendis sunt consequatur neque minima dignissimos magnam eos. Excepturi laboriosam et velit ex voluptas iure.', 'article', '7.64', '<p>Voluptas ullam quidem officia ab. Optio quo libero illo. Eos corporis voluptas rem nostrum est consequatur. Molestias consequuntur libero dicta. Qui sunt aut incidunt. Molestias iste nemo eius facilis ducimus. Qui quo dolor et.</p><p>Iure optio quia aut nostrum alias. Ut minima eligendi culpa. Magni asperiores sunt suscipit dignissimos nihil magni voluptatem. Quos recusandae odio dolorem ut.</p>', 1, 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(157, 'a8792eaf-950a-4085-9548-b027ab893f75', 54, 27, 'lecture', 'Sed Accusantium Aut Eum Quis.', 'Autem labore recusandae inventore vitae facere nemo. Qui facilis error ullam veniam tempore totam rem velit. Sunt error enim nesciunt veniam consectetur. In suscipit assumenda excepturi non beatae.', 'article', '7.04', '<p>Quia sunt debitis tempore aut exercitationem vitae. Dolores ea ut reiciendis repudiandae tempore. Temporibus fuga voluptas deleniti vel accusamus mollitia ex doloremque. Cum ex maiores quia nesciunt. Libero facilis perspiciatis sed illo enim quia. Sit praesentium itaque ut quia ut. Modi error aut sapiente optio. Odio culpa in quia odio rem. Assumenda rerum rerum porro pariatur nisi ipsum delectus. Assumenda voluptatibus nihil beatae explicabo. Est quos culpa adipisci eveniet sint est neque.</p><p>Sit cumque at dolorum sit magnam omnis. Error voluptates illum voluptatem nam odio vero voluptatum et. Laudantium rerum aut sint fugiat ut. Eum ut eum possimus dolores molestiae voluptatem. Et quia ipsum quas autem nostrum. Velit veritatis iure quia quibusdam. Nostrum aut velit quaerat sed enim. Neque enim placeat laboriosam voluptatem et molestiae aut. Labore officiis deserunt laudantium ad ut cum ut. Aperiam earum omnis exercitationem veniam cum quidem.</p>', 0, 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `mc_conversations`
--

CREATE TABLE `mc_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 1,
  `data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_conversation_user`
--

CREATE TABLE `mc_conversation_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_messages`
--

CREATE TABLE `mc_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_message_notification`
--

CREATE TABLE `mc_message_notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `is_sender` tinyint(1) NOT NULL DEFAULT 0,
  `flagged` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_languages`
--

CREATE TABLE `package_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_translations`
--

CREATE TABLE `package_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `uuid`, `slug`, `meta_description`, `body`, `featured_image`, `featured`, `published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"About us\",\"fr\":\"\\u00c0 propos de nous\"}', 'bd7070b1-07d2-442b-adf7-937ab3983796', 'about-us', NULL, '{\"en\":\"<p class=\\\"ql-align-justify\\\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p class=\\\"ql-align-justify\\\"><br><\\/p><p class=\\\"ql-align-justify\\\">Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p class=\\\"ql-align-justify\\\"><br><\\/p><p class=\\\"ql-align-justify\\\">Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>\",\"fr\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p><br><\\/p><p>Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p><br><\\/p><p>Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>\"}', NULL, 0, 1, NULL, '2019-09-26 16:35:50', '2019-10-13 12:01:10'),
(2, '{\"en\":\"Terms of Service\",\"fr\":\"Conditions d\'utilisation\"}', 'd96b54e3-879a-4359-968b-f6b8199f9ae3', 'terms-of-service', NULL, '{\"en\":\"<p class=\\\"ql-align-justify\\\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p class=\\\"ql-align-justify\\\"><br><\\/p><p class=\\\"ql-align-justify\\\">Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p class=\\\"ql-align-justify\\\"><br><\\/p><p class=\\\"ql-align-justify\\\">Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>\",\"fr\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p><br><\\/p><p>Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p><br><\\/p><p>Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>\"}', NULL, 0, 1, NULL, '2019-09-26 16:36:13', '2019-10-13 12:00:37'),
(3, '{\"en\":\"Privacy Policy\",\"fr\":\"Politique de confidentialit\\u00e9\"}', '1ab8a6c0-b43b-423f-9f11-729a507c0a6e', 'privacy-policy', NULL, '{\"en\":\"<p class=\\\"ql-align-justify\\\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p class=\\\"ql-align-justify\\\"><br><\\/p><p class=\\\"ql-align-justify\\\">Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p class=\\\"ql-align-justify\\\"><br><\\/p><p class=\\\"ql-align-justify\\\">Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>\",\"fr\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante mi, convallis a lacinia at, pulvinar ut metus. Curabitur convallis facilisis pellentesque. Proin tristique tellus et tincidunt euismod. Maecenas ut rutrum magna, sit amet vestibulum libero. Fusce rhoncus eget dolor sed sollicitudin. In vel dignissim urna. Sed imperdiet, nisl fringilla volutpat sollicitudin, mi mauris bibendum ligula, a dictum nibh lorem sed turpis. Aenean pulvinar tellus nec lectus pulvinar, lacinia lacinia orci ultricies. Aliquam vulputate tellus sapien, quis hendrerit leo aliquet sed. Vivamus et viverra quam, non sollicitudin ligula. Aliquam in sollicitudin diam, a fermentum magna.<\\/p><p><br><\\/p><p>Praesent dignissim gravida urna eget ullamcorper. Quisque placerat laoreet diam, in aliquet justo laoreet eu. Duis eget euismod erat. Nulla vulputate elit maximus velit ultricies suscipit. Fusce luctus ex sed sagittis commodo. Vestibulum et euismod est, iaculis rutrum metus. Pellentesque ac semper sapien. Maecenas mattis ex nec malesuada laoreet. Donec condimentum sit amet diam vitae ultricies.<\\/p><p><br><\\/p><p>Morbi a mollis ante. Curabitur sagittis, metus sed sagittis cursus, sapien ipsum placerat sapien, a posuere velit nunc et turpis. Donec orci erat, bibendum sit amet sem at, rutrum dignissim arcu. Aliquam a egestas quam. Proin sit amet mauris sit amet massa hendrerit pretium. Curabitur vitae tortor condimentum, hendrerit augue sit amet, dapibus mi. Mauris lobortis in ligula ac dapibus. Nulla pulvinar magna non semper aliquam. Cras varius sodales sapien, at volutpat quam porta id. Integer gravida, lacus in porta scelerisque, quam mi laoreet dolor, quis consectetur orci nibh in velit.<\\/p><p><br><\\/p>\"}', NULL, 0, 1, NULL, '2019-09-26 16:36:36', '2019-10-13 12:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_histories`
--

CREATE TABLE `password_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_histories`
--

INSERT INTO `password_histories` (`id`, `user_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$10$4NOqTF4KppvKpOUoS.sKmOAuyf4IBjNu2E0SWSiP9Z1nDuAbldCey', '2021-04-26 00:56:20', '2021-04-26 00:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `payer_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_earning` decimal(10,2) DEFAULT NULL,
  `affiliate_earning` decimal(10,2) DEFAULT NULL,
  `gateway_payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('created','refunded','finalized') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created',
  `refund_deadline` datetime NOT NULL,
  `period_id` bigint(20) UNSIGNED NOT NULL,
  `refunded_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `period_id` bigint(20) UNSIGNED NOT NULL,
  `net_earnings` decimal(8,3) NOT NULL,
  `total_author_earnings` decimal(8,3) NOT NULL,
  `total_refunds` decimal(8,3) NOT NULL,
  `payout_batch_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_batch_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_processed` tinyint(1) NOT NULL DEFAULT 0,
  `processed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `payout_date` datetime NOT NULL,
  `status` enum('open','closed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `uuid`, `start_time`, `end_time`, `payout_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ab386c4e-8eb9-49bc-aff5-e920d12761ee', '2019-01-01 00:00:00', '2019-01-31 23:59:59', '2019-02-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(2, 'df5fb3d2-8dd3-4620-a2b9-c81be27d4c23', '2019-02-01 00:00:00', '2019-02-28 23:59:59', '2019-03-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(3, '50f79567-cd6d-4a4d-ab2c-90af26882037', '2019-03-01 00:00:00', '2019-03-31 23:59:59', '2019-04-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(4, '79bff478-0b58-4320-8b4f-fd7e9394539b', '2019-04-01 00:00:00', '2019-04-30 23:59:59', '2019-05-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-10-02 13:27:20'),
(5, '025e7c2f-44c2-4b6b-8792-7b1b34fa6dd6', '2019-05-01 00:00:00', '2019-05-31 23:59:59', '2019-06-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-10-02 13:27:34'),
(6, '2af78182-9ef7-46ef-b54e-9823a8d0c86b', '2019-06-01 00:00:00', '2019-06-30 23:59:59', '2019-07-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-10-02 13:27:47'),
(7, '7617d04b-91e6-4c33-ba61-22aaea93e8ee', '2019-07-01 00:00:00', '2019-07-31 23:59:59', '2019-08-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-10-02 13:27:56'),
(8, '9b4c8312-29ca-468a-b1ca-37c89a04f464', '2019-08-01 00:00:00', '2019-08-31 23:59:59', '2019-09-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-10-03 14:55:32'),
(9, 'e92af069-6833-4a03-bba6-f85d8dda636d', '2019-09-01 00:00:00', '2019-09-30 23:59:59', '2019-10-15 00:00:00', 'closed', '2019-04-25 17:49:13', '2019-10-05 11:51:29'),
(10, '78473507-ccd9-40fb-981a-9d184acd0b8b', '2019-10-01 00:00:00', '2019-10-31 23:59:59', '2019-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(11, '344ab985-5eb6-4945-a4a9-d973f215025f', '2019-11-01 00:00:00', '2019-11-30 23:59:59', '2019-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(12, 'f86d26bd-e39b-408f-96df-5172ec2b8e76', '2019-12-01 00:00:00', '2019-12-31 23:59:59', '2020-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(13, 'af170056-0d86-4677-9acb-d3cb9f3696a1', '2020-01-01 00:00:00', '2020-01-31 23:59:59', '2020-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(14, '0c27d104-d333-47d7-9ab7-3e4e8262807c', '2020-02-01 00:00:00', '2020-02-29 23:59:59', '2020-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(15, 'cadfe558-4896-4aa5-b6c9-401eea20f86e', '2020-03-01 00:00:00', '2020-03-31 23:59:59', '2020-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(16, '763b1e98-5e60-43ea-a268-2dc0d89b475f', '2020-04-01 00:00:00', '2020-04-30 23:59:59', '2020-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(17, 'ab36293b-725a-4c48-a491-d4170a9104c6', '2020-05-01 00:00:00', '2020-05-31 23:59:59', '2020-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(18, '5e603b73-d7d5-4785-8d54-ceb546a49678', '2020-06-01 00:00:00', '2020-06-30 23:59:59', '2020-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(19, 'af0e9e64-c844-4b2e-864b-62f85cceb1b7', '2020-07-01 00:00:00', '2020-07-31 23:59:59', '2020-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(20, 'ab248149-074f-49ca-8ed0-21283e875968', '2020-08-01 00:00:00', '2020-08-31 23:59:59', '2020-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(21, '307d0cd2-8318-4b81-99b8-906aeccf2391', '2020-09-01 00:00:00', '2020-09-30 23:59:59', '2020-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(22, 'f081a41c-a839-40d0-bd17-fbddeba38332', '2020-10-01 00:00:00', '2020-10-31 23:59:59', '2020-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(23, '770d73ad-7416-4809-866e-b56b7d6c4b8e', '2020-11-01 00:00:00', '2020-11-30 23:59:59', '2020-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(24, 'eea468c1-892c-4a85-9ec2-1f740b532d47', '2020-12-01 00:00:00', '2020-12-31 23:59:59', '2021-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(25, 'a4f45580-e9dc-4273-96b1-c681035b469a', '2021-01-01 00:00:00', '2021-01-31 23:59:59', '2021-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(26, 'ad7ed970-b2dc-4cca-849d-e5a8f7e24e84', '2021-02-01 00:00:00', '2021-02-28 23:59:59', '2021-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(27, 'be182e7f-3491-4c13-b033-ec604687c74a', '2021-03-01 00:00:00', '2021-03-31 23:59:59', '2021-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(28, 'c425486c-9610-4551-b35e-55eb19928227', '2021-04-01 00:00:00', '2021-04-30 23:59:59', '2021-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(29, 'a679cc80-26d9-4a44-8339-a366ed842d2b', '2021-05-01 00:00:00', '2021-05-31 23:59:59', '2021-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(30, 'ecda332a-6bd2-4d1b-af26-4ecde25999d8', '2021-06-01 00:00:00', '2021-06-30 23:59:59', '2021-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(31, '877f6e87-b0ce-4597-b0b1-3d2793cc84da', '2021-07-01 00:00:00', '2021-07-31 23:59:59', '2021-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(32, '4fd8347d-83de-43e0-9631-0722fef7a75c', '2021-08-01 00:00:00', '2021-08-31 23:59:59', '2021-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(33, '70ae102d-6b85-4d3d-a9ae-4f2aab0fecf8', '2021-09-01 00:00:00', '2021-09-30 23:59:59', '2021-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(34, 'cc33193d-cd7c-4a8c-9f3f-988ebc4b017e', '2021-10-01 00:00:00', '2021-10-31 23:59:59', '2021-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(35, '3cd886e3-b19f-4c5e-9af8-ca4eb47d74f9', '2021-11-01 00:00:00', '2021-11-30 23:59:59', '2021-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(36, 'f04b7045-767a-4e17-adb2-cb75d1b6865b', '2021-12-01 00:00:00', '2021-12-31 23:59:59', '2022-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(37, '956fbe8d-7d7f-4c2a-befe-57fb8bff9ea3', '2022-01-01 00:00:00', '2022-01-31 23:59:59', '2022-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(38, '7bb964d9-7b77-4513-9b01-bb75d556dd38', '2022-02-01 00:00:00', '2022-02-28 23:59:59', '2022-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(39, '025f15da-25da-4f86-8a86-f393c4350f88', '2022-03-01 00:00:00', '2022-03-31 23:59:59', '2022-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(40, '9ccd6599-ea12-4d30-9d4b-70cf2790109e', '2022-04-01 00:00:00', '2022-04-30 23:59:59', '2022-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(41, '877c4b61-52c1-4841-bb1b-39d57e644757', '2022-05-01 00:00:00', '2022-05-31 23:59:59', '2022-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(42, 'a9d29b89-8d10-4ee7-ba63-cbdb8f9e6f98', '2022-06-01 00:00:00', '2022-06-30 23:59:59', '2022-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(43, 'f04e41d5-bcf2-40cf-ba8e-a272eaf4c36c', '2022-07-01 00:00:00', '2022-07-31 23:59:59', '2022-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(44, '3b6a3521-245e-4b9c-8ceb-e87c22e9a2e8', '2022-08-01 00:00:00', '2022-08-31 23:59:59', '2022-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(45, '05a7801c-574a-47ba-a7fa-d9ff61a781e2', '2022-09-01 00:00:00', '2022-09-30 23:59:59', '2022-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(46, 'ec1a71f4-dd6b-4c72-b427-3245b8124723', '2022-10-01 00:00:00', '2022-10-31 23:59:59', '2022-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(47, 'c6dc2e4f-4868-4bdb-9800-7f4b0b1e67b7', '2022-11-01 00:00:00', '2022-11-30 23:59:59', '2022-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(48, 'ee60935b-d522-4c35-8778-5515eb31905e', '2022-12-01 00:00:00', '2022-12-31 23:59:59', '2023-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(49, '8a1ebebf-52e8-488f-9008-0c83eca62628', '2023-01-01 00:00:00', '2023-01-31 23:59:59', '2023-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(50, 'bc7584cf-d634-4448-9d1f-4cf0b541da2d', '2023-02-01 00:00:00', '2023-02-28 23:59:59', '2023-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(51, '151cf8a3-1a9f-48ee-9977-762ccbf30b5c', '2023-03-01 00:00:00', '2023-03-31 23:59:59', '2023-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(52, 'e6336f40-d988-4dc2-8bc4-da501bc5115e', '2023-04-01 00:00:00', '2023-04-30 23:59:59', '2023-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(53, '0cd412f8-7d89-4e93-a6a8-1eee73a45865', '2023-05-01 00:00:00', '2023-05-31 23:59:59', '2023-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(54, 'e34e5281-d08f-4b35-b5d9-1dc3476c5238', '2023-06-01 00:00:00', '2023-06-30 23:59:59', '2023-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(55, 'c648fb60-a346-48f5-a838-3408363e7966', '2023-07-01 00:00:00', '2023-07-31 23:59:59', '2023-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(56, 'de95cca2-9092-4b65-b1ee-a69ba99b1188', '2023-08-01 00:00:00', '2023-08-31 23:59:59', '2023-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(57, '3ce58884-4294-4d21-9a19-dda0f660f157', '2023-09-01 00:00:00', '2023-09-30 23:59:59', '2023-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(58, '4ca0a6c0-c599-46a1-ba08-5d85f86917df', '2023-10-01 00:00:00', '2023-10-31 23:59:59', '2023-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(59, 'c188c714-17ed-40f7-a75d-0d6bf10ea944', '2023-11-01 00:00:00', '2023-11-30 23:59:59', '2023-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(60, 'bfbf26aa-1be6-48a2-bc15-4c6cc417ef35', '2023-12-01 00:00:00', '2023-12-31 23:59:59', '2024-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(61, '56e45ccc-8fcf-41c0-9fa3-40604ee474f4', '2024-01-01 00:00:00', '2024-01-31 23:59:59', '2024-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(62, '868ff9bb-2c93-4227-8b5d-0a0ba824a236', '2024-02-01 00:00:00', '2024-02-29 23:59:59', '2024-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(63, 'cb73ecc3-ba23-4111-b137-db0fad506390', '2024-03-01 00:00:00', '2024-03-31 23:59:59', '2024-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(64, 'd1a54533-5b6d-4203-b8d2-b1afd8ab3034', '2024-04-01 00:00:00', '2024-04-30 23:59:59', '2024-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(65, '1462f2f4-a079-4920-b817-d0451e2ef1ed', '2024-05-01 00:00:00', '2024-05-31 23:59:59', '2024-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(66, '07a23c82-2a7a-42a7-ac2e-6b276d7b305d', '2024-06-01 00:00:00', '2024-06-30 23:59:59', '2024-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(67, '9299386e-0f2f-459b-86f1-26e4fa4ebd43', '2024-07-01 00:00:00', '2024-07-31 23:59:59', '2024-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(68, 'd7888229-da0b-46ab-b690-1e57f41eef5b', '2024-08-01 00:00:00', '2024-08-31 23:59:59', '2024-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(69, 'cb29d405-6f01-4306-a028-4b88f2246111', '2024-09-01 00:00:00', '2024-09-30 23:59:59', '2024-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(70, 'e455f7e7-921a-42c2-9382-0771e58866b8', '2024-10-01 00:00:00', '2024-10-31 23:59:59', '2024-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(71, '1d808720-e90f-4845-84b9-9e377b200be0', '2024-11-01 00:00:00', '2024-11-30 23:59:59', '2024-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(72, 'd751008d-f657-4ab1-879a-9cf88cf9e050', '2024-12-01 00:00:00', '2024-12-31 23:59:59', '2025-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(73, '7099639c-ce46-48f5-8ac5-b5fc16bfb45c', '2025-01-01 00:00:00', '2025-01-31 23:59:59', '2025-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(74, 'c7341bd2-0ed8-4767-8aea-8be7e16833a5', '2025-02-01 00:00:00', '2025-02-28 23:59:59', '2025-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(75, 'fbad7c9a-f478-4e9c-b8d8-f88038b29061', '2025-03-01 00:00:00', '2025-03-31 23:59:59', '2025-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(76, '3899af94-9151-46a4-9d8e-c109d770adb6', '2025-04-01 00:00:00', '2025-04-30 23:59:59', '2025-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(77, '98158a89-94be-45d7-9201-308d21bd16cb', '2025-05-01 00:00:00', '2025-05-31 23:59:59', '2025-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(78, 'b57439de-7b43-4ee9-9637-98fc2a7f659e', '2025-06-01 00:00:00', '2025-06-30 23:59:59', '2025-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(79, '2ba9005e-efb7-46d8-8cbc-ddab5f6494cc', '2025-07-01 00:00:00', '2025-07-31 23:59:59', '2025-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(80, '75101804-99e4-44c2-a8ca-95719ad5d280', '2025-08-01 00:00:00', '2025-08-31 23:59:59', '2025-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(81, 'b65d44fb-fe51-4a1d-93e7-ef34bbc8a495', '2025-09-01 00:00:00', '2025-09-30 23:59:59', '2025-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(82, '6582224c-3beb-46d5-b2c2-039631dd57e7', '2025-10-01 00:00:00', '2025-10-31 23:59:59', '2025-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(83, 'a8c2716f-a852-4c01-af63-7eb04ff96be2', '2025-11-01 00:00:00', '2025-11-30 23:59:59', '2025-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(84, '85c32e4d-0f67-42b0-b4c1-9a4e96e5e067', '2025-12-01 00:00:00', '2025-12-31 23:59:59', '2026-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(85, 'c2ce3759-437f-4c86-a8cc-cf25f2ed5828', '2026-01-01 00:00:00', '2026-01-31 23:59:59', '2026-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(86, '043183b3-add6-4e7a-af49-ede73497dcaa', '2026-02-01 00:00:00', '2026-02-28 23:59:59', '2026-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(87, '2d7b1ed1-1bf6-49f7-9334-1de0711e2ea3', '2026-03-01 00:00:00', '2026-03-31 23:59:59', '2026-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(88, '75bdda89-eb00-4419-8b39-20cdb2c6612f', '2026-04-01 00:00:00', '2026-04-30 23:59:59', '2026-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(89, 'a8a6c51f-0282-4598-a5ee-165049c0db7b', '2026-05-01 00:00:00', '2026-05-31 23:59:59', '2026-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(90, 'b09becdc-ce15-41a9-a858-6022a52720cf', '2026-06-01 00:00:00', '2026-06-30 23:59:59', '2026-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(91, '3269dc6b-3015-43d8-b1b6-94695df56d7d', '2026-07-01 00:00:00', '2026-07-31 23:59:59', '2026-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(92, '6ff824a1-7707-4f31-8988-19087c2b3404', '2026-08-01 00:00:00', '2026-08-31 23:59:59', '2026-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(93, '602b68d1-0932-4496-8c06-8140bc098638', '2026-09-01 00:00:00', '2026-09-30 23:59:59', '2026-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(94, '58d7d761-8c88-4f11-8c95-60a0864e1a29', '2026-10-01 00:00:00', '2026-10-31 23:59:59', '2026-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(95, '101a310f-e7e7-4ca6-9bac-cd0c27756b0b', '2026-11-01 00:00:00', '2026-11-30 23:59:59', '2026-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(96, '1a08c21f-6c4b-43eb-9bee-5026d3d1ac23', '2026-12-01 00:00:00', '2026-12-31 23:59:59', '2027-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(97, 'a5743298-a244-4b41-8ab8-e2eaac0d2a8c', '2027-01-01 00:00:00', '2027-01-31 23:59:59', '2027-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(98, '6845fce9-fe2c-4c27-a168-fadc89d3a3ad', '2027-02-01 00:00:00', '2027-02-28 23:59:59', '2027-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(99, 'c2dbf3a5-a1d7-4b81-84aa-dd6723894c81', '2027-03-01 00:00:00', '2027-03-31 23:59:59', '2027-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(100, 'f2029d12-3ba4-4dfe-86e0-c1a24c6f5630', '2027-04-01 00:00:00', '2027-04-30 23:59:59', '2027-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(101, 'eb4a1979-d79e-4564-88c6-9cf2bc75e153', '2027-05-01 00:00:00', '2027-05-31 23:59:59', '2027-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(102, '19870dbf-f5fa-4dc3-9e7d-d22b4d1143ef', '2027-06-01 00:00:00', '2027-06-30 23:59:59', '2027-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(103, 'babe687b-8dc6-4082-9878-58093f688dcc', '2027-07-01 00:00:00', '2027-07-31 23:59:59', '2027-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(104, 'ba15bacd-7875-4332-89b2-56304c0e5b46', '2027-08-01 00:00:00', '2027-08-31 23:59:59', '2027-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(105, '1ba5c393-4ffa-4c20-804f-fe5bca970255', '2027-09-01 00:00:00', '2027-09-30 23:59:59', '2027-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(106, 'f8fae212-415b-4249-8b12-8bac27d96814', '2027-10-01 00:00:00', '2027-10-31 23:59:59', '2027-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(107, 'c2af0e9c-cf23-401e-acf5-849637d1c483', '2027-11-01 00:00:00', '2027-11-30 23:59:59', '2027-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(108, '7d2749dc-9bce-4866-abe2-a2f28eb6174f', '2027-12-01 00:00:00', '2027-12-31 23:59:59', '2028-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(109, '1dfe1468-1fb5-4cc5-874f-d29131f537af', '2028-01-01 00:00:00', '2028-01-31 23:59:59', '2028-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(110, '6cda3dd9-8f8f-4a5f-9657-16405e437c33', '2028-02-01 00:00:00', '2028-02-29 23:59:59', '2028-03-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(111, 'f06c57ae-6491-4319-a11c-b6db6f7890ac', '2028-03-01 00:00:00', '2028-03-31 23:59:59', '2028-04-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(112, 'be7dc2e3-c41e-4089-b8ac-f50f524ce4e7', '2028-04-01 00:00:00', '2028-04-30 23:59:59', '2028-05-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(113, '88a589dd-1852-45b2-87d9-5ff1ba3d0cd5', '2028-05-01 00:00:00', '2028-05-31 23:59:59', '2028-06-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(114, '4c260bd0-4780-4ccf-b72c-61b8e64da5aa', '2028-06-01 00:00:00', '2028-06-30 23:59:59', '2028-07-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(115, '30a670e6-ae07-45df-8cd2-2e6bf98d7a67', '2028-07-01 00:00:00', '2028-07-31 23:59:59', '2028-08-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(116, 'a0f7175b-7a9f-4e33-98a3-f3462ca8d9ed', '2028-08-01 00:00:00', '2028-08-31 23:59:59', '2028-09-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(117, '6342c49e-3cc2-4967-84b6-eedffb7864a4', '2028-09-01 00:00:00', '2028-09-30 23:59:59', '2028-10-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(118, 'ab050479-cf62-4b1c-9747-497255a96b02', '2028-10-01 00:00:00', '2028-10-31 23:59:59', '2028-11-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(119, '7795a922-6146-45e2-a32a-bd40c5b7f46a', '2028-11-01 00:00:00', '2028-11-30 23:59:59', '2028-12-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(120, '04ad9724-0002-481c-b052-9b50b02faa60', '2028-12-01 00:00:00', '2028-12-31 23:59:59', '2029-01-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(121, 'cac5796d-3576-4bd3-956b-9136553a7e65', '2029-01-01 00:00:00', '2029-01-31 23:59:59', '2029-02-15 00:00:00', 'open', '2019-04-25 17:49:13', '2019-04-25 17:49:13'),
(122, 'eef1ecdd-4e15-40f6-ba93-723f71060810', '2029-02-01 00:00:00', '2029-02-28 23:59:59', '2029-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(123, 'b84591f8-2dcb-458c-985e-8c1e3dea594f', '2029-03-01 00:00:00', '2029-03-31 23:59:59', '2029-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(124, 'c939eb03-6256-421e-882d-27585606dfdd', '2029-04-01 00:00:00', '2029-04-30 23:59:59', '2029-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(125, '32627a18-b2cc-4f5f-af5f-86b76bfffbb3', '2029-05-01 00:00:00', '2029-05-31 23:59:59', '2029-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(126, '1425eef3-cabe-41ba-92a8-45b838b4d1f9', '2029-06-01 00:00:00', '2029-06-30 23:59:59', '2029-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(127, '9942fc1a-d756-48a9-96ea-e04e48bc1c6e', '2029-07-01 00:00:00', '2029-07-31 23:59:59', '2029-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(128, 'f01c5373-54df-40f8-b2fd-3c9414df13a0', '2029-08-01 00:00:00', '2029-08-31 23:59:59', '2029-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(129, '7d760705-ec24-4a69-a758-856e01eaf829', '2029-09-01 00:00:00', '2029-09-30 23:59:59', '2029-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(130, 'fcfc037f-b824-4798-afd3-fc51cf4949c6', '2029-10-01 00:00:00', '2029-10-31 23:59:59', '2029-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(131, 'c4e55a68-7e90-42ab-a4bb-2c155e61cdb1', '2029-11-01 00:00:00', '2029-11-30 23:59:59', '2029-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(132, 'b0ac6b0d-a3ef-464d-ad8c-a23593f4d15b', '2029-12-01 00:00:00', '2029-12-31 23:59:59', '2030-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(133, '660f363f-6b04-42ef-84c0-5ad6e11ebdbe', '2030-01-01 00:00:00', '2030-01-31 23:59:59', '2030-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(134, '08e7378d-e0c0-4f6a-aef5-b58f1f11addc', '2030-02-01 00:00:00', '2030-02-28 23:59:59', '2030-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(135, '4b3fcc54-af02-4943-b34f-461130232dbd', '2030-03-01 00:00:00', '2030-03-31 23:59:59', '2030-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(136, 'c289f663-00a6-4605-92ee-d246e86f0b85', '2030-04-01 00:00:00', '2030-04-30 23:59:59', '2030-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(137, 'a83b9409-7149-4aa3-b447-080c9efcd608', '2030-05-01 00:00:00', '2030-05-31 23:59:59', '2030-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(138, 'd88efdc5-bb7b-4f69-854d-7e0c5a6baecc', '2030-06-01 00:00:00', '2030-06-30 23:59:59', '2030-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(139, 'c120e4d3-591b-4828-93d7-85d5b9cca6d4', '2030-07-01 00:00:00', '2030-07-31 23:59:59', '2030-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(140, '678eee44-7064-4c47-8aa3-17559f93c605', '2030-08-01 00:00:00', '2030-08-31 23:59:59', '2030-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(141, 'c6d229fd-34c7-43f5-843c-05a0dd9241c7', '2030-09-01 00:00:00', '2030-09-30 23:59:59', '2030-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(142, 'cdfef552-d2c3-4057-8a93-a3c4c7160b75', '2030-10-01 00:00:00', '2030-10-31 23:59:59', '2030-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(143, '4b3eab42-25c9-44bc-b11f-8714227cd08e', '2030-11-01 00:00:00', '2030-11-30 23:59:59', '2030-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(144, '88f72165-1f42-4888-ae6d-5fc7bec81290', '2030-12-01 00:00:00', '2030-12-31 23:59:59', '2031-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(145, 'e0fa8e63-25af-4100-b877-bd3d92e15fff', '2031-01-01 00:00:00', '2031-01-31 23:59:59', '2031-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(146, 'dfbc2335-d5bb-4f26-ab30-155a938f51a5', '2031-02-01 00:00:00', '2031-02-28 23:59:59', '2031-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(147, '9f788b72-6bc5-4273-b3e5-890874071384', '2031-03-01 00:00:00', '2031-03-31 23:59:59', '2031-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(148, 'fe96c6f6-4d79-4d80-aa13-c83ad07cbaba', '2031-04-01 00:00:00', '2031-04-30 23:59:59', '2031-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(149, '2887ccc5-81f2-4cb1-9e3d-af70b36c12f9', '2031-05-01 00:00:00', '2031-05-31 23:59:59', '2031-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(150, '51806fb8-f1d8-4909-b254-d5761bdb3a99', '2031-06-01 00:00:00', '2031-06-30 23:59:59', '2031-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(151, '8393be17-7125-41c6-9b83-34689569005e', '2031-07-01 00:00:00', '2031-07-31 23:59:59', '2031-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(152, '2f6741fe-4632-476a-9f9c-d9c23dde2d38', '2031-08-01 00:00:00', '2031-08-31 23:59:59', '2031-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(153, 'c242d816-45b6-4227-86b2-764891c3c0bf', '2031-09-01 00:00:00', '2031-09-30 23:59:59', '2031-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(154, 'c8c8dea0-5718-4f1e-a9cd-93fbebbf88a3', '2031-10-01 00:00:00', '2031-10-31 23:59:59', '2031-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(155, '08917dea-f15c-4ee8-9b41-bb079394a722', '2031-11-01 00:00:00', '2031-11-30 23:59:59', '2031-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(156, '11c9b7d9-2045-47b0-93c6-51ca714972b9', '2031-12-01 00:00:00', '2031-12-31 23:59:59', '2032-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(157, '6690f5ac-31bc-41be-be54-6d1678d85606', '2032-01-01 00:00:00', '2032-01-31 23:59:59', '2032-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(158, 'c856a88d-cfb7-4421-8112-939bb0124dc6', '2032-02-01 00:00:00', '2032-02-29 23:59:59', '2032-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(159, '457e2b3d-1962-4a89-99d3-43954c771aeb', '2032-03-01 00:00:00', '2032-03-31 23:59:59', '2032-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(160, 'eed16a1e-332c-477d-a798-86795eb0a157', '2032-04-01 00:00:00', '2032-04-30 23:59:59', '2032-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(161, 'f85d13ec-0010-44fd-881b-ab5b5e9ea0c1', '2032-05-01 00:00:00', '2032-05-31 23:59:59', '2032-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(162, '0e867d68-fa0b-4539-b667-942fc44df4cf', '2032-06-01 00:00:00', '2032-06-30 23:59:59', '2032-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(163, 'd4574acf-0584-4ef1-8803-74d1f60ca2d6', '2032-07-01 00:00:00', '2032-07-31 23:59:59', '2032-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(164, '4c898b82-570e-4712-8f48-9287eb46be36', '2032-08-01 00:00:00', '2032-08-31 23:59:59', '2032-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(165, '282abf49-c517-4dc7-84ed-1d68b68c10ad', '2032-09-01 00:00:00', '2032-09-30 23:59:59', '2032-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(166, 'dd1445b9-1b67-43e9-8324-3bfe3b70f2b8', '2032-10-01 00:00:00', '2032-10-31 23:59:59', '2032-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(167, '6455751f-c244-4f3c-b298-1c1c10605615', '2032-11-01 00:00:00', '2032-11-30 23:59:59', '2032-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(168, 'e3cbb25d-92c0-4623-9fae-6bef033e809d', '2032-12-01 00:00:00', '2032-12-31 23:59:59', '2033-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(169, 'c298574d-2f03-4986-b8d7-789d80686839', '2033-01-01 00:00:00', '2033-01-31 23:59:59', '2033-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(170, 'bf8f22bd-04eb-48d6-b869-ff36dba13250', '2033-02-01 00:00:00', '2033-02-28 23:59:59', '2033-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(171, 'cbc6d6e3-c971-4f40-8553-cd97288ddb15', '2033-03-01 00:00:00', '2033-03-31 23:59:59', '2033-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(172, '6e01ae65-dfce-4b7b-b1da-06cc3e66345f', '2033-04-01 00:00:00', '2033-04-30 23:59:59', '2033-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(173, '55c47048-ccc7-49d8-99e6-d102fa6cba80', '2033-05-01 00:00:00', '2033-05-31 23:59:59', '2033-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(174, '2c880d08-2da9-4e72-b606-7ed7f477ef9a', '2033-06-01 00:00:00', '2033-06-30 23:59:59', '2033-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(175, '8f781d93-913e-4476-9bae-bd9eb232a68e', '2033-07-01 00:00:00', '2033-07-31 23:59:59', '2033-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(176, 'ce5289d8-215e-4ced-aecc-a07034e9ec0b', '2033-08-01 00:00:00', '2033-08-31 23:59:59', '2033-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(177, 'e641cf02-bfc5-4dbb-b007-9746754d6772', '2033-09-01 00:00:00', '2033-09-30 23:59:59', '2033-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(178, '3887a0ec-2b3c-4289-b9a8-00693654e9ed', '2033-10-01 00:00:00', '2033-10-31 23:59:59', '2033-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(179, 'c05e8cf2-1bdc-4b5f-91c3-e3595e507a5a', '2033-11-01 00:00:00', '2033-11-30 23:59:59', '2033-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(180, '04ad5437-c060-4b8d-939a-5998c7bd4490', '2033-12-01 00:00:00', '2033-12-31 23:59:59', '2034-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(181, '911f086a-d2ae-4c7b-9df8-3d3c3b37cb20', '2034-01-01 00:00:00', '2034-01-31 23:59:59', '2034-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(182, 'bfe6c0b7-30cc-4dca-b992-6150560302fe', '2034-02-01 00:00:00', '2034-02-28 23:59:59', '2034-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(183, '92f0f45c-fc54-4741-89f6-ef21a1e6b2ba', '2034-03-01 00:00:00', '2034-03-31 23:59:59', '2034-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(184, '8276b177-7a28-43b4-b72a-5ac9b4890cc1', '2034-04-01 00:00:00', '2034-04-30 23:59:59', '2034-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(185, '85155f55-b86b-4cd0-b4a0-4ca822f98e9f', '2034-05-01 00:00:00', '2034-05-31 23:59:59', '2034-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(186, 'ff0a3e50-0d04-4434-b2ca-31a0b013377d', '2034-06-01 00:00:00', '2034-06-30 23:59:59', '2034-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(187, '2aadb1bb-1c08-4194-a4bb-70e643aaeae5', '2034-07-01 00:00:00', '2034-07-31 23:59:59', '2034-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(188, 'f37049ad-a847-4f43-b0d1-8fa09fe953a6', '2034-08-01 00:00:00', '2034-08-31 23:59:59', '2034-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(189, '443f04e9-1c21-498f-a38d-e0d213b55dde', '2034-09-01 00:00:00', '2034-09-30 23:59:59', '2034-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(190, '6bc30812-ea39-4248-9082-e023c74f2f56', '2034-10-01 00:00:00', '2034-10-31 23:59:59', '2034-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(191, '5918749a-71ac-4f15-8663-db33e53418e7', '2034-11-01 00:00:00', '2034-11-30 23:59:59', '2034-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(192, 'fcb0f5ea-4997-46a2-af05-d37ca9e5a389', '2034-12-01 00:00:00', '2034-12-31 23:59:59', '2035-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(193, '7255fa2a-84af-4b8a-ac0e-e6c55e30db5c', '2035-01-01 00:00:00', '2035-01-31 23:59:59', '2035-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(194, 'e2d7a34a-a3da-4023-863e-c6a7cae3e176', '2035-02-01 00:00:00', '2035-02-28 23:59:59', '2035-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(195, '80679016-17b8-4af4-845b-be7411004a82', '2035-03-01 00:00:00', '2035-03-31 23:59:59', '2035-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(196, '8876841f-4522-42a5-97f7-e7cb5d13616a', '2035-04-01 00:00:00', '2035-04-30 23:59:59', '2035-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(197, 'f7b73d1a-7fd2-4856-9c1f-6874b0116e09', '2035-05-01 00:00:00', '2035-05-31 23:59:59', '2035-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(198, 'b1f070c1-cf2a-44c2-8b4a-a7b856b6e11f', '2035-06-01 00:00:00', '2035-06-30 23:59:59', '2035-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(199, '05ce2d8e-0899-4e01-9db1-1d9214036fac', '2035-07-01 00:00:00', '2035-07-31 23:59:59', '2035-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(200, 'aa1dda3c-c872-43e8-b840-6febc33eef29', '2035-08-01 00:00:00', '2035-08-31 23:59:59', '2035-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(201, '24a8d940-f448-4c30-831c-4b60ded11f85', '2035-09-01 00:00:00', '2035-09-30 23:59:59', '2035-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(202, 'b1532e8b-c74f-4ebd-8a72-a6509c3014f3', '2035-10-01 00:00:00', '2035-10-31 23:59:59', '2035-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(203, 'f5937728-b527-4d5d-ae2a-5a90884b263f', '2035-11-01 00:00:00', '2035-11-30 23:59:59', '2035-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(204, '18c7ea3b-afcc-4e71-852a-8ba2b1732a5e', '2035-12-01 00:00:00', '2035-12-31 23:59:59', '2036-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(205, 'b57acbb3-6d0e-4d5e-b838-eb9c0f587666', '2036-01-01 00:00:00', '2036-01-31 23:59:59', '2036-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(206, '4cad935b-cbd1-47a8-a8ef-9e16161cac78', '2036-02-01 00:00:00', '2036-02-29 23:59:59', '2036-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(207, 'b2c0f4da-a4d6-40e2-941e-84b9ec043cf7', '2036-03-01 00:00:00', '2036-03-31 23:59:59', '2036-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(208, '999592af-ae8d-4b77-bb31-631c9cbe47be', '2036-04-01 00:00:00', '2036-04-30 23:59:59', '2036-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(209, 'e090746c-4a51-4665-bd9a-7a823c8c73dc', '2036-05-01 00:00:00', '2036-05-31 23:59:59', '2036-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(210, '19036385-ca5e-4d66-bb2c-3d2eb0d02784', '2036-06-01 00:00:00', '2036-06-30 23:59:59', '2036-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(211, '49437b9f-e846-4e5c-852f-274185cd7fda', '2036-07-01 00:00:00', '2036-07-31 23:59:59', '2036-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(212, '47090068-147e-4a02-a372-b3cb9ab62fae', '2036-08-01 00:00:00', '2036-08-31 23:59:59', '2036-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(213, '904eb16d-aec3-4486-936e-04e00b713f5f', '2036-09-01 00:00:00', '2036-09-30 23:59:59', '2036-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(214, '4a4c37eb-7cd2-4de0-ba25-f006b3351e1b', '2036-10-01 00:00:00', '2036-10-31 23:59:59', '2036-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(215, '4572219f-754a-485b-9a5c-7e0f979bc7c7', '2036-11-01 00:00:00', '2036-11-30 23:59:59', '2036-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(216, 'a2da39a9-bcc8-405f-a690-676eda3a3189', '2036-12-01 00:00:00', '2036-12-31 23:59:59', '2037-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(217, '311b8f64-2cd2-4a42-a19c-850ba9b20ae9', '2037-01-01 00:00:00', '2037-01-31 23:59:59', '2037-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(218, 'c1862158-9362-4522-8eeb-497a90de6945', '2037-02-01 00:00:00', '2037-02-28 23:59:59', '2037-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(219, '406936e9-2a1b-4ff2-9505-434b6923c908', '2037-03-01 00:00:00', '2037-03-31 23:59:59', '2037-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(220, '3cd42001-2327-4e1a-b827-fc5972eaf378', '2037-04-01 00:00:00', '2037-04-30 23:59:59', '2037-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(221, '3fbb3850-6e22-4a19-b21d-b3738e90b898', '2037-05-01 00:00:00', '2037-05-31 23:59:59', '2037-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(222, '25348f01-b582-4959-8be9-b2995c00f682', '2037-06-01 00:00:00', '2037-06-30 23:59:59', '2037-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(223, 'd9068cd7-6c85-4b99-b03d-1a22c4b0718c', '2037-07-01 00:00:00', '2037-07-31 23:59:59', '2037-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(224, '9d05f148-96e7-4a9d-bbcc-c8b5f9aba9cb', '2037-08-01 00:00:00', '2037-08-31 23:59:59', '2037-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(225, '43f2c7c9-98fb-42dd-b4d6-d0e2b971d36c', '2037-09-01 00:00:00', '2037-09-30 23:59:59', '2037-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(226, 'f68dec4c-1df1-4b8a-98e1-7760e9a04ccd', '2037-10-01 00:00:00', '2037-10-31 23:59:59', '2037-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(227, 'dedd3632-89b9-4f1e-a34b-d2d12bce5560', '2037-11-01 00:00:00', '2037-11-30 23:59:59', '2037-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(228, '3d167c03-40fc-48e0-b955-c9aa7e5153c7', '2037-12-01 00:00:00', '2037-12-31 23:59:59', '2038-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(229, 'fad8e536-315d-4f0e-abe2-d9e6eaaa0621', '2038-01-01 00:00:00', '2038-01-31 23:59:59', '2038-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(230, 'dc1425dc-bbbf-461d-a886-633073369990', '2038-02-01 00:00:00', '2038-02-28 23:59:59', '2038-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(231, '09dfd6d4-7ac4-45ac-b35e-07c53616c0e7', '2038-03-01 00:00:00', '2038-03-31 23:59:59', '2038-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(232, '9362dac9-9381-4eb9-9a9c-3da9e0f1b217', '2038-04-01 00:00:00', '2038-04-30 23:59:59', '2038-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(233, 'ff8efd24-faa8-4782-8840-d5b17ea77027', '2038-05-01 00:00:00', '2038-05-31 23:59:59', '2038-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(234, 'e3180d03-1e30-47ce-b972-522ce1cd9cc5', '2038-06-01 00:00:00', '2038-06-30 23:59:59', '2038-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(235, 'ec89b919-ec40-43b7-a77d-9a85fd679c68', '2038-07-01 00:00:00', '2038-07-31 23:59:59', '2038-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(236, '26651cce-7803-4a80-bb1e-be341663bc16', '2038-08-01 00:00:00', '2038-08-31 23:59:59', '2038-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(237, 'cfc1f380-59ad-45fd-a715-d92d80fe071f', '2038-09-01 00:00:00', '2038-09-30 23:59:59', '2038-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(238, 'ef0b12d8-1e03-4261-a43d-873f9c1d8e6a', '2038-10-01 00:00:00', '2038-10-31 23:59:59', '2038-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(239, '2f5bdc7e-9b39-408d-a0be-2f1f5b7bfc81', '2038-11-01 00:00:00', '2038-11-30 23:59:59', '2038-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(240, 'e8a4050c-77b0-4e31-92a6-885038f7e7d0', '2038-12-01 00:00:00', '2038-12-31 23:59:59', '2039-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(241, '6391e624-32d5-4d09-92ee-557e29c7d036', '2039-01-01 00:00:00', '2039-01-31 23:59:59', '2039-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(242, 'fdd7f656-db6c-40c2-a5bd-15e79aa05864', '2039-02-01 00:00:00', '2039-02-28 23:59:59', '2039-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(243, 'a6e9d19c-ff97-4d00-ab4d-daf91f3cfda8', '2039-03-01 00:00:00', '2039-03-31 23:59:59', '2039-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(244, '77c39949-a6f0-46a1-afd8-52e6e3b8466c', '2039-04-01 00:00:00', '2039-04-30 23:59:59', '2039-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(245, '072bd443-e947-427f-a1d5-53f6e38b1ffc', '2039-05-01 00:00:00', '2039-05-31 23:59:59', '2039-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(246, 'bddc8f61-fb67-443e-9010-a3ca45d82d28', '2039-06-01 00:00:00', '2039-06-30 23:59:59', '2039-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(247, '916d6555-7654-4121-b7ac-0649996267b1', '2039-07-01 00:00:00', '2039-07-31 23:59:59', '2039-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(248, '770008a9-3e13-45fb-981e-c522824fbcab', '2039-08-01 00:00:00', '2039-08-31 23:59:59', '2039-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(249, 'e1b03e48-62b8-4eb1-9de3-96e362170f0c', '2039-09-01 00:00:00', '2039-09-30 23:59:59', '2039-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(250, '9d3752ce-449f-4d81-b276-b00cd7436270', '2039-10-01 00:00:00', '2039-10-31 23:59:59', '2039-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(251, 'f934a7a8-8a61-4ac9-a356-c14937c76072', '2039-11-01 00:00:00', '2039-11-30 23:59:59', '2039-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(252, '5fc1ee54-192a-4786-9ef2-7acbca877ad7', '2039-12-01 00:00:00', '2039-12-31 23:59:59', '2040-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(253, 'a5736c64-dd7b-4f5e-ab58-f6127a774452', '2040-01-01 00:00:00', '2040-01-31 23:59:59', '2040-02-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(254, '90bc04f8-998e-436f-a7e0-bdbbd5d30eaa', '2040-02-01 00:00:00', '2040-02-29 23:59:59', '2040-03-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(255, '03a56c8b-1d9e-4367-a82f-f4a54d6be333', '2040-03-01 00:00:00', '2040-03-31 23:59:59', '2040-04-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(256, 'a5bb0267-7758-45ec-9cac-e324f54f4297', '2040-04-01 00:00:00', '2040-04-30 23:59:59', '2040-05-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(257, '56ff3587-d8b9-4b35-9479-4eb85e3255fd', '2040-05-01 00:00:00', '2040-05-31 23:59:59', '2040-06-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(258, '99aa7419-4a09-430b-950c-c6d275c9e81a', '2040-06-01 00:00:00', '2040-06-30 23:59:59', '2040-07-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(259, '4aca00c1-5fe0-48ae-8557-c848a7cabe7a', '2040-07-01 00:00:00', '2040-07-31 23:59:59', '2040-08-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(260, '5aa13a05-e212-48db-8b7b-0ac850a881e5', '2040-08-01 00:00:00', '2040-08-31 23:59:59', '2040-09-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(261, 'ec6dd13d-1d0f-4f53-a0a0-4be4f5702d97', '2040-09-01 00:00:00', '2040-09-30 23:59:59', '2040-10-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(262, 'a0a299ea-cfdc-4144-88b9-2157d9bf81a1', '2040-10-01 00:00:00', '2040-10-31 23:59:59', '2040-11-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(263, '1413604f-abeb-44bf-b0be-27932ff49075', '2040-11-01 00:00:00', '2040-11-30 23:59:59', '2040-12-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14'),
(264, 'b254c404-64c9-40af-8ec5-ab2a21c83d3b', '2040-12-01 00:00:00', '2040-12-31 23:59:59', '2041-01-15 00:00:00', 'open', '2019-04-25 17:49:14', '2019-04-25 17:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view backend', 'web', '2019-09-26 16:06:33', '2019-09-26 16:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requester_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,3) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('open','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `refunded_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(4,1) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2019-09-26 16:06:33', '2019-09-26 16:06:33'),
(2, 'user', 'web', '2019-09-26 16:06:33', '2019-09-26 16:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objective` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sortOrder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `uuid`, `course_id`, `title`, `objective`, `sortOrder`, `created_at`, `updated_at`) VALUES
(1, '14255267-6702-46dd-a0f9-4fa22ded5f3f', 1, 'Occaecati Accusantium Ipsa Id Sed Aut Voluptas Laudantium.', 'Odit Voluptas Error Ullam Aut Eum Velit Atque.', 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(2, '75063544-8d53-4255-bf76-8a52a836889c', 1, 'Et Consequatur Aspernatur Voluptatem Mollitia.', 'Unde Laudantium Ad Totam Quis Minima Quod Magnam.', 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(3, '7c9cea0f-970b-4289-a594-a36d2d9fc6f4', 2, 'Neque Atque Laudantium Voluptates Natus Velit.', 'Officiis Et Ipsam Assumenda Voluptate.', 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(4, '0d14e24a-4ef0-4605-a084-54d2d868f8a3', 2, 'Omnis Necessitatibus Veritatis Est.', 'Ut Et Dolor Minus Impedit Quidem Rem Accusantium.', 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(5, '48e5c2f3-43a4-4549-a118-41c7c60755eb', 3, 'Voluptatem Ut Ratione Quo Est Quia Aut.', 'Minima Accusantium Amet Veniam Eum Provident Nostrum.', 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(6, 'f32f1799-db29-4aa0-9282-48ca6b85a52a', 3, 'Et Quis Aut Doloribus.', 'Consequatur Ut Enim Porro.', 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(7, 'c2ceb9d9-2329-4708-8c4b-eccaba59c48e', 4, 'Quo Neque Ducimus Sit Quia Quam.', 'Odio Omnis Quidem Eius Aut In Error A.', 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(8, 'e2181f49-d9da-4db8-a009-74ab4cf1d635', 4, 'Sequi Voluptatibus Repellat Odit Voluptatem Nemo.', 'Iste Quia Minima Aut Incidunt Blanditiis Nisi.', 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(9, '2f6999e6-06af-4750-ba5c-c4d5b17d3d92', 5, 'Voluptas Id Voluptas Corrupti Officiis Quas.', 'Cum Assumenda Maxime Illum Aut.', 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(10, '380610df-104b-48f2-a7d7-783263f2def5', 5, 'Id Exercitationem Eveniet Consequatur Eum Delectus.', 'Eaque Excepturi Natus Et Quam Laboriosam Quibusdam.', 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(11, '3ba155da-8f71-4170-bbf1-de3695290263', 6, 'Et Cumque Voluptas Est.', 'Unde Enim Deleniti Dolores Quia Nemo.', 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(12, '50d7b436-d515-4730-a1ff-f56ce759ee3b', 6, 'Ducimus Laborum Consequatur Eveniet Maiores Quaerat.', 'Officia Earum Dignissimos Itaque Deleniti Eum.', 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(13, 'c3cd8d1b-7a37-498f-bf7a-cfacfa18f04b', 7, 'Ut Odio Dolore Iure Veniam Sit.', 'Accusantium Minus Et Iure Ea Quia Nemo Fuga.', 2, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(14, '899b7751-57b3-4aea-99a8-f19c34eece33', 7, 'Cumque Fugit Repudiandae Ad Vero Qui Amet Assumenda.', 'Dolorem Dolorem Excepturi Quia Repellat Dolor Veritatis.', 3, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(15, '39836bf7-dbbf-4e70-989d-19d3075b4ebc', 8, 'Qui Accusamus Ratione Odit Recusandae Possimus.', 'Numquam Fuga Vel Eaque Quis.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(16, '042adf58-dd51-4cde-9b7c-2b650c8af2fe', 8, 'Cumque Ipsam Corrupti Labore Accusantium.', 'Et Quas Assumenda Ad Aperiam Et.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(17, 'c24d360e-0857-4462-897d-d31fb17da7fb', 9, 'Quia Enim Perferendis Accusamus Sed Eveniet Adipisci Velit Voluptatibus.', 'Unde Non Sed Dolores Aut Quaerat Non Officia.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(18, '7b0f49bf-ec7e-4f15-b194-20cac309cf37', 9, 'Fugit Ea Perspiciatis Quidem Reiciendis.', 'Non Non Dolorem Nobis Dolores Exercitationem.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(19, 'de77d2e8-6b72-4c72-b190-f173dd10cb08', 10, 'Qui Consequatur Aut Quam Quia Consectetur.', 'Labore Et Optio Harum Omnis.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(20, 'f0d50435-98b7-43a0-b37a-a3976a144657', 10, 'Eos Qui Velit Ea Nemo Accusantium Veniam.', 'Et Tempora Deleniti Et Voluptatem Deserunt Repudiandae.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(21, 'ea50886e-0204-43a3-b065-60705c5e1e2d', 11, 'Fuga Vero Voluptatem Vero Quam Hic Perferendis.', 'Nulla Autem Sint Nam Voluptatem.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(22, '138ab49d-5530-498e-bf5b-8ac7deb8506b', 11, 'Atque Aut Nulla Rerum Nostrum Nobis Ad Deserunt.', 'Quia Praesentium Error Voluptatem Est Consequatur Temporibus Optio.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(23, 'ea81dd9f-4941-40ef-8a65-3412c59a9cb8', 12, 'Provident Eos Id Eligendi.', 'Dolorem Quas Ut Eveniet Sit Consequuntur Reprehenderit.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(24, 'adb78063-8175-4ac9-ba57-482128331d5d', 12, 'Dolor Dolore Qui Dolorem Accusamus Recusandae Esse.', 'Temporibus Vitae Laborum Ullam Qui.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(25, '11898836-f54b-42a3-b514-5a221a3c996f', 13, 'Et Esse Accusamus Et Dolor.', 'Ipsa Labore Voluptatem Dolores Id Iste Qui.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(26, 'c8af9864-d8ab-4e53-9738-2eb2950cd501', 13, 'Sit Asperiores Exercitationem Id.', 'Voluptatem Voluptatum Sunt Velit Et Nesciunt Et Voluptate.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(27, '84cb4d80-15f9-487c-910f-8981aeafdd33', 14, 'Repellendus Non Repudiandae Recusandae Vitae Assumenda Laborum.', 'Pariatur Quod Qui Quis.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(28, 'a98e3770-f750-4d0c-b80b-114f8b5f3420', 14, 'Dolore Sit Praesentium Quia Reiciendis Tempora.', 'Qui Eos Assumenda Quos Quasi Culpa Reiciendis.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(29, '8ac66ec9-e7b5-4d6f-b367-06fccbd0b6d7', 15, 'Ea Dolorem Est Alias Vel Adipisci.', 'Ea Non Et Dolores Quae Quia Numquam Odit.', 2, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(30, 'a25b3750-87c3-4818-b860-2304fb0d4a0c', 15, 'Modi Rem Libero Corporis Amet Itaque Magni Quia.', 'Enim Placeat Dolorem Ut Et Numquam Cumque Et.', 3, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(31, 'a402082e-f855-4f75-bbb8-485f7e8b9699', 16, 'Adipisci Maxime Nam Id Hic Sed.', 'Expedita Aut Eaque Vel.', 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(32, 'f49f90fa-06d8-4104-92b1-ef4f81846543', 16, 'Dolorem Eius Reprehenderit Totam Accusamus Labore Voluptas.', 'Et Dolor Non Mollitia Doloremque Saepe Et Blanditiis.', 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(33, '98fd87ad-e501-4061-9f4e-04a1fa4b94e8', 17, 'Facilis Cumque Explicabo Ex Sint Rerum Laudantium.', 'Quisquam Ratione Ipsa Nesciunt Occaecati Impedit.', 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(34, '8f2c56f0-0147-43de-9b06-3fde5d2fd9af', 17, 'Et Sed Dolorem Fuga Architecto Pariatur Veniam Autem Aut.', 'Corrupti Ratione Officiis Et Vel Molestiae Repellat Cupiditate.', 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(35, '6f3a731d-7e5c-433e-9aec-3f83e60e76b4', 18, 'Dolor Consequatur Voluptas Amet Autem Aut Suscipit.', 'Quia Qui Quis Praesentium Harum.', 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(36, '16384aa2-e24d-4d6b-9b3e-7eeb56aa11ba', 18, 'Et Totam Velit Deleniti Tenetur Quia.', 'Officiis Exercitationem Cupiditate Aut Quidem.', 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(37, '577a2328-c1db-4803-83de-bdbb9a1bc02a', 19, 'Incidunt Labore Omnis Nulla Et Enim.', 'Doloribus Nobis Vel Deserunt.', 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(38, 'c628042b-2e1f-4892-aee8-0c3c0f7d5593', 19, 'Qui Sed Est Sed Itaque.', 'Commodi Fugit Impedit Qui Voluptate Adipisci.', 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(39, '74634876-a94f-4f65-913e-c21c57289844', 20, 'Sint Itaque Soluta Quas Iste Et.', 'Vero Corrupti Animi Pariatur Aut Modi.', 2, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(40, '110361cb-faca-49c5-8f50-d9de308ea097', 20, 'Iste Doloremque Sed Consequatur Et Voluptatem Eveniet Alias Sint.', 'Dolorem Inventore Possimus Sed Repellendus.', 3, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(41, '05006f49-b6f4-4bca-ad6b-e0a44c55e7bb', 21, 'Sunt Qui Aliquam Voluptatem Ut.', 'Sed Corrupti Sequi Facilis Natus Dignissimos Sed.', 2, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(42, '0dadd663-0849-429b-8ef2-e134f2b32570', 21, 'Sunt Commodi Dignissimos Autem Sint Alias.', 'Dolores Consequuntur Voluptatum Voluptas Totam.', 3, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(43, '19d42379-170f-4641-ae19-a4f668d69611', 22, 'Aut Aut Quia Quia Ab.', 'Eum Blanditiis Quisquam Reprehenderit Ex.', 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(44, 'ee7cb465-91f4-447d-9049-a571c764c11d', 22, 'Sed Voluptates Magnam Quos Sit Non.', 'Laborum Dignissimos Voluptas Aut Quis Cumque Ea Dolor.', 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(45, '5bc138d4-3bf7-48c1-a117-50f8ff464ced', 23, 'Ipsum Suscipit Aliquid Ad Delectus Nobis.', 'Laudantium Ratione Ut Et Tempore Consectetur Eos.', 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(46, 'e3eeffab-0295-4f43-acc3-1d38f0c9c39f', 23, 'Deserunt Dolor Corrupti Et Illum Sapiente.', 'Ex Quibusdam Eos Occaecati.', 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(47, '172e77d4-599b-4c05-8571-ab4fc2d20032', 24, 'Eligendi Voluptate Qui Odit Accusantium Reprehenderit Ut Qui Ipsa.', 'Fugiat Delectus Consequuntur Odio Labore.', 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(48, '1d343f23-e048-41d5-a99c-7331f364f6d3', 24, 'Sequi Nam Voluptate Fuga Deserunt.', 'Sit Voluptatem Ea Ducimus Tempora Doloremque.', 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(49, '184f8575-85e4-4522-8b19-ed790151ae04', 25, 'Sequi Cupiditate Corrupti Quas Quae Ullam Porro Consequatur.', 'Dignissimos Voluptas Esse Tempora Ut Minus Excepturi Inventore.', 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(50, 'dc591677-3f24-457c-8203-b6f16c1bcda4', 25, 'Omnis Odio Assumenda Iste Mollitia Qui.', 'Veritatis Ullam Inventore Molestias Vero Dolores Eius Quasi.', 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(51, '9b95f606-2a56-462b-8812-bf961cd63d15', 26, 'Et Expedita Et Et Ut Blanditiis Quo Explicabo.', 'Sint Dolorem Temporibus Deserunt.', 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(52, '33087a36-c7e8-49d1-8e43-472c9d935b1a', 26, 'Vel Magnam Veniam Aut Et.', 'Tenetur Ea Minus Facere Quia Dolore Quas Provident.', 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(53, 'bd5f796b-c3f4-42ad-97c6-8654f35d58de', 27, 'Est Voluptatem Corrupti Provident Modi Maiores Mollitia Eos.', 'Est Quaerat Ut Molestias Tempora Incidunt.', 2, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(54, 'eb8f7f0b-d963-47c2-9cce-9d49d094efc8', 27, 'Sapiente Sed Id Sapiente Consequatur.', 'Dolore Sit Doloremque Et Sint Ea.', 3, '2019-09-26 16:07:16', '2019-09-26 16:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `key`, `value`) VALUES
(1, NULL, 'payments.enable_paypal', '1'),
(2, NULL, 'payments.enable_credit_card', '1'),
(3, NULL, 'payments.credit_card_processor', 'stripe'),
(4, NULL, 'payments.paypal_mode', 'sandbox'),
(5, NULL, 'payments.stripe_mode', 'sandbox'),
(6, NULL, 'payments.razorpay_mode', 'sandbox'),
(7, NULL, 'payments.stripe_sandbox_public_key', NULL),
(8, NULL, 'payments.stripe_sandbox_secret_key', NULL),
(9, NULL, 'payments.stripe_live_public_key', NULL),
(10, NULL, 'payments.stripe_live_secret_key', NULL),
(11, NULL, 'payments.razorpay_sandbox_public_key', NULL),
(12, NULL, 'payments.razorpay_sandbox_secret_key', NULL),
(13, NULL, 'payments.razorpay_live_public_key', NULL),
(14, NULL, 'payments.razorpay_live_secret_key', NULL),
(15, NULL, 'payments.paypal_sandbox_client_id', NULL),
(16, NULL, 'payments.paypal_sandbox_secret', NULL),
(17, NULL, 'payments.paypal_live_client_id', NULL),
(18, NULL, 'payments.paypal_live_secret', NULL),
(19, NULL, 'site.site_description', 'Your online learning platform'),
(20, NULL, 'site.site_keywords', 'Online course, Udemy alternative'),
(21, NULL, 'site.video_upload_location', 'local'),
(22, NULL, 'site.video_max_size_mb', '20'),
(23, NULL, 'site.video_providers', 'both'),
(24, NULL, 'site.site_address', '1'),
(25, NULL, 'site.earning_organic_sales_percentage', '40'),
(26, NULL, 'site.earning_promo_sales_percentage', '75'),
(27, NULL, 'site.site_google_analytics', 'UA-XXXXXX-XX'),
(28, NULL, 'site.logo', '/images/logo.png'),
(29, NULL, 'site.favicon', '/images/favicon.png'),
(30, NULL, 'site.homepage_image', '/images/homepage_image.png'),
(31, NULL, 'site.encode_videos', '0'),
(32, NULL, 'site.enable_demo_mode', '0'),
(33, NULL, 'site.redirect_https', '0'),
(34, NULL, 'site.site_currency', 'USD'),
(35, NULL, 'site.video_hd_dimension', '1280, 720'),
(36, NULL, 'site.video_sd_dimension', '640, 360'),
(37, NULL, 'site.s3_access_id', NULL),
(38, NULL, 'site.s3_secret_access_key', NULL),
(39, NULL, 'site.s3_default_region', 'us-east-1'),
(40, NULL, 'site.s3_bucket', NULL),
(41, NULL, 'site.s3_url', NULL),
(42, NULL, 'site.queue_connection', 'sync'),
(43, NULL, 'mail.mailing_address', '1 Some Street<br />\r\nCambridge ON<br />\r\nJ9A4SW Canada'),
(44, NULL, 'site.site_language', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('debit','credit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gravatar',
  `avatar_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_be_logged_out` tinyint(1) NOT NULL DEFAULT 0,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `first_name`, `last_name`, `username`, `email`, `avatar_type`, `avatar_location`, `password`, `password_changed_at`, `active`, `confirmation_code`, `confirmed`, `timezone`, `last_login_at`, `last_login_ip`, `to_be_logged_out`, `tagline`, `bio`, `website`, `linkedin`, `facebook`, `twitter`, `youtube`, `github`, `settings`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '8c09f292-f5a6-4710-9f06-5ec59e2ea881', 'Admin', 'Istrator', 'admin', 'admin@admin.com', 'gravatar', NULL, '$2y$10$DnggYXvrKfsjwgNapsB2SOwFqwF1d3MN/LHxcePX3yAfTXTQ1FK9q', NULL, 1, '76f09724471f6851cbd93743e050ab18', 1, 'America/New_York', '2019-09-26 16:32:34', '127.0.0.1', 0, 'Administrator', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p><p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p>', '#', '#', '#', '#', NULL, NULL, NULL, NULL, '2019-09-26 16:06:33', '2019-09-26 16:32:34', NULL),
(2, '1a509abd-635b-4a2c-8938-3a38b73e78f7', 'Russ', 'Ankunding', 'mohr.okey', 'lmosciski@example.net', 'gravatar', NULL, '$2y$10$VQdNjKz2Ap9S149nA4rytOfmFmka9warDV0n1RJfoQ6c6a0Kq4AH6', NULL, 1, 'faaa77795b6f4fe6a395945cc04c6dea', 1, NULL, NULL, NULL, 0, 'Web Developer', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p><p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p>', '#', '#', '#', '#', NULL, '#', NULL, 'LYrEOa1Co2', '2019-09-26 16:06:34', '2019-09-26 16:06:34', NULL),
(3, 'bfd1e567-c40a-4f1e-9999-7ec723bc589b', 'Madge', 'Schmitt', 'virgil34', 'pwalker@example.net', 'gravatar', NULL, '$2y$10$oaggfS2tKBQLtkLqESQ/Qu50GSaqkan/5Xr09h7Baw9xZ.hkgNING', NULL, 1, '133d6e41d4354d0ea0ca0a380c64283e', 1, NULL, NULL, NULL, 0, 'Senior Accountant', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p><p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p>', '#', '#', '#', NULL, NULL, NULL, NULL, 'vWsbYc2ESH', '2019-09-26 16:06:34', '2019-09-26 16:06:34', NULL),
(4, 'ee62c2dc-9c43-47f3-8038-ced22d059835', 'Major', 'Kutch', 'gwendolyn54', 'graham.nora@example.org', 'gravatar', NULL, '$2y$10$QJ6VXzj.ECS/Imchkav5Y.7PnDS4iojpEFDz9gehexJWhAQgM6.rG', NULL, 1, '51428eb3dff444134c2c90c22cd99663', 1, NULL, NULL, NULL, 0, 'Fullstack Developer', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p><p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p>', '#', '#', '#', NULL, '#', '#', NULL, 'IDQcFYvek6', '2019-09-26 16:06:34', '2019-09-26 16:06:34', NULL),
(5, 'a9ea1d3e-68b4-4af0-ade8-757e66adf0b9', 'Kathryne', 'Goldner', 'rreichert', 'damon47@example.org', 'gravatar', NULL, '$2y$10$H7gf.7/2jgERwCeUvH5W8uDwkY9zgDxVdS7YCuImCNRHBJBqvToU2', NULL, 1, 'de311e2cac35060f1ad0779111052db5', 1, NULL, NULL, NULL, 0, 'Writer / Data Analyst', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p><p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut semper lectus. Nulla facilisi. Morbi ac iaculis magna. Donec efficitur posuere leo in tristique. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In est leo, sagittis sed faucibus ac, tincidunt sit amet lacus. Suspendisse congue dui diam, a efficitur mi finibus id. Aenean aliquet arcu eleifend, finibus urna eu, scelerisque sem. Sed sit amet sodales turpis, nec vehicula tellus. Fusce nec eros sit amet dolor bibendum ultricies nec vitae nisl.\r\n</p>', '#', '#', '#', '#', NULL, NULL, NULL, '8t673BQeYA', '2019-09-26 16:06:34', '2019-09-26 16:06:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_id` int(10) UNSIGNED NOT NULL,
  `is_processed` tinyint(1) NOT NULL DEFAULT 0,
  `encoded` tinyint(1) NOT NULL DEFAULT 0,
  `processing_succeeded` tinyint(1) DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'server',
  `streamable_sm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streamable_lg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `converted_for_streaming_at` datetime DEFAULT NULL,
  `original_filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uuid`, `lesson_id`, `is_processed`, `encoded`, `processing_succeeded`, `disk`, `streamable_sm`, `streamable_lg`, `converted_for_streaming_at`, `original_filename`, `youtube_link`, `created_at`, `updated_at`) VALUES
(1, 'f6ce492f-dcbf-4de5-b974-355ee967ead5', 3, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(2, '5ca1ea17-0373-4fca-9945-f1337911603f', 4, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(3, '453f3c75-a880-4d91-b3c6-7d11779bb12f', 5, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(4, 'f9e8ffa1-cdee-4b93-b81d-c7abc1f351bd', 7, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(5, 'a89331fa-aa4f-4727-b445-717d8e9cee27', 8, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(6, '89129731-c1f0-4d39-908f-365bd2d51a26', 9, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(7, '58e45a06-09aa-4b2a-9699-40790dc1b0ce', 11, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(8, 'd585b910-6457-4ac8-8a2f-52c4e8361f6d', 12, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(9, 'd2afbc52-827d-4681-b02a-b5185c9678b7', 16, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(10, '4f3d6700-077c-48e8-b105-e90887377eab', 17, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(11, '6b079074-2633-4429-809a-dec150e6c4d8', 18, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(12, '325ff5a4-8f83-42bb-9279-2ec4d80b2d98', 22, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(13, 'e788c970-e148-48ff-902d-fd1e040ce295', 23, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(14, '84f998d6-3581-4995-8580-1c680cbd6206', 24, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(15, '8aee43be-3899-417a-a1e8-7b86c51703f9', 25, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(16, '2b15269a-489d-40f0-b7fb-5054c880cd14', 26, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(17, 'f80557e8-6bfe-432c-b0ec-1407f9eacefb', 27, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(18, 'ce59fc09-c4f3-4d65-8284-d4c541185cc3', 29, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(19, '0be5a6b9-c6e1-4146-8bdd-2d090af9d80e', 30, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(20, 'b29f423c-ba24-4312-b164-824c92514015', 31, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(21, 'a3607382-a4b9-40a7-886b-a6f2d1bd2cc3', 34, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(22, '3700af35-dbd7-4482-a052-6fa5ee916cde', 35, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(23, 'e9f08f61-6b72-4e97-87b9-129c100b8a1e', 36, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(24, 'a8cfb382-3f80-407a-b432-0c9275a8d020', 37, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(25, '4bf72c92-5c54-4d7b-b130-b1d265f7d758', 38, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(26, '9619aab8-d7e6-4143-b985-dbbd9dfc49db', 39, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(27, 'f40855c1-474c-4f46-a651-52567098f407', 40, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:45', 'sample_360.mp4', NULL, '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(28, 'ab123f68-11da-436d-940b-696cbe61611c', 41, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:45', '2019-09-26 16:06:45'),
(29, '3d03f67b-4fdd-4c10-99af-b1b03d1d45cb', 46, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(30, 'b1c7385a-9e0a-4a86-8618-7e7832e3ca59', 47, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(31, '6ccdfcf6-c451-4355-b0a3-3564d761efc2', 49, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(32, '6261a7c8-e594-4450-9713-502ac0ceff0b', 50, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(33, '34b57e90-81af-4e6b-a9da-9face0057e06', 53, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(34, 'cedb153a-27b0-463d-aba6-a66c821166ac', 55, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(35, '2b598bb4-0aa4-43ea-803e-3fe3e2b6a2c4', 56, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(36, '176c4f14-1135-4ce1-9d93-df816ecd794d', 57, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(37, '065763a8-f6f0-4acb-92ca-79cb20fcd98d', 59, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(38, 'f85cae65-adce-40d7-8e40-e54d8755c12c', 60, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(39, '474de10e-da56-4e07-89ec-239601d3b81b', 62, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(40, '7fa87402-725f-43e1-a65a-7723047a867c', 64, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(41, '0577d7d3-0977-4e1c-8eb2-05a4272c35f7', 66, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(42, '09460015-5e49-4c8e-b3d4-5a4c51027280', 69, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(43, '6e306cd7-1747-4afa-8572-fcbfe15e4a7f', 71, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(44, '9b60ab5f-0ffd-451d-ba8d-0bd2b215e9c2', 72, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(45, '5d8699f0-3f21-4dff-a0c9-4600a76ab310', 73, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(46, '4c1b78bd-ca63-411c-aaaa-c1317756dac6', 76, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(47, '7f66a861-077d-4b63-899f-d49051d18034', 77, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(48, 'f505cea2-b396-4de9-9f51-2379776d845a', 79, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(49, '31284e59-1be2-4f09-8bfb-4cc75a4a8d80', 80, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:36:58', 'sample_360.mp4', NULL, '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(50, '0f635835-9d60-4dc9-a016-880a43956040', 81, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(51, '87b0875d-0773-459b-9b32-efc5c401ea91', 82, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(52, 'fcb18998-0050-47d5-9f0f-6175b8b2a719', 84, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(53, '93696b7d-5df0-4495-9c5e-523efc835dbc', 88, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:06:58', '2019-09-26 16:06:58'),
(54, '0a2375b5-e149-4188-a066-7ee47b7ffc43', 89, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(55, 'adc75fab-b0ac-4dee-aa45-fb9b1defe611', 92, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(56, 'e61fed7a-353e-40ac-b92c-f9b9ee3ce16f', 93, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(57, 'dcd90caa-5225-41f5-b985-85bf905c37ba', 96, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(58, '31352754-27de-477b-a861-84538bb3c32e', 97, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(59, 'afe3f39e-57c8-42d2-acd4-bf0fe44d1d30', 99, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(60, 'f9ee2edc-1940-4bb1-bbfc-32e1d0cc4bf3', 100, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(61, 'f7906f7b-c587-4b9e-84e4-82e4f2a280a2', 101, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:05', 'sample_360.mp4', NULL, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(62, 'ae8977bc-ec4e-4609-9908-34bde9830cfc', 103, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(63, '93545fc8-6cad-45ef-8aad-6509e58350bd', 104, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(64, '03350a65-98ec-4ad1-bc43-6eb00a2340ec', 105, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(65, 'd659d83b-7bb8-437a-816c-311562bcc6c5', 107, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(66, '0356abe4-9355-450b-bd6c-06b6e2a5bb4d', 108, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:05', 'sample_360.mp4', NULL, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(67, '7b274dcc-12e4-4bac-98ab-5192a72ddf08', 109, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:05', 'sample_360.mp4', NULL, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(68, '72162b3e-2c51-46ab-9d70-fd184eb66725', 110, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:05', 'sample_360.mp4', NULL, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(69, '32ee0656-2210-4bc3-b68c-c584f82b01fc', 111, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(70, '72f07d36-0df8-4092-b16c-ac09dc07311b', 113, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(71, '607b3e17-c218-4a08-90dd-c9100d98259c', 114, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(72, 'ec9434d0-228b-4878-be85-1cf2c896d28c', 115, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:05', 'sample_360.mp4', NULL, '2019-09-26 16:07:05', '2019-09-26 16:07:05'),
(73, 'ca754913-0501-429e-acd7-9749bba1771f', 117, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(74, 'e0543dba-0497-4fd2-a5b9-a008e1853b5b', 118, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(75, '5edf6464-d710-4d84-9693-db32f00e4ece', 119, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:15', 'sample_360.mp4', NULL, '2019-09-26 16:07:15', '2019-09-26 16:07:15'),
(76, '3b64e09f-0761-43cb-a287-5dd0b027539c', 120, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:15', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(77, '915419f6-10fd-4a97-bae3-28d4e9093571', 122, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(78, '21c7202f-2ffe-49bc-97e7-51cd569e89af', 123, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(79, '9351c22e-86ee-4f0f-bf9d-937f262e1d9a', 124, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(80, '80cb391f-2029-4fb8-a567-f0fc891e579d', 126, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(81, 'b1d7b5d8-1df9-484d-8d0e-767435f51a9e', 127, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(82, '62bae490-ad4d-457e-88f8-76bd95df4f1a', 129, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(83, 'dd0f5610-134b-49a5-8d1c-b2cc4bbe099b', 130, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(84, '6bd00435-2a92-484a-82a7-e328bf1713ca', 133, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(85, 'aef8e453-7d18-498d-b5ef-11371b5619de', 135, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(86, '9303b97f-cbb8-48b6-ac16-a7ce8ab511e6', 137, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(87, '05a44084-27b8-416a-8b19-a760454e095d', 138, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(88, 'ff46a411-4621-4107-8443-dfa5b903c37f', 139, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=hdI2bqOjy3c', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(89, '0d66a627-df8a-4ccc-a7e1-09ce6128d7ae', 140, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(90, '9f1859d5-b7fa-485d-b1dc-d89cc293978b', 141, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(91, '5a3cd5e0-03ca-4d1f-81e6-bd3f71a23272', 143, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(92, '043160e8-9eb4-4aff-915f-a15216bf34d8', 144, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(93, '3b5ba3e4-6843-441a-be83-f99631754f1f', 145, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(94, 'fd61a5a8-81a8-40bc-b1c4-69b8712589de', 146, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(95, 'ba108b16-80b3-4bbf-891d-e18275c27a04', 148, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(96, '8f67b3a3-70db-4096-887b-74971e31ae69', 149, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(97, '0b2e8c1f-5e6a-4c9c-b544-a515c315a2bf', 150, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=Fdf5aTYRW0E', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(98, 'f0e12a7e-9b2a-4575-aed5-6e570e3af675', 152, 1, 0, 1, 'youtube', NULL, NULL, NULL, NULL, 'https://www.youtube.com/watch?v=sBws8MSXN7A', '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(99, '3538309b-cd22-4df4-9d80-3dbf57871056', 153, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16'),
(100, 'df7286f5-7afb-4def-8db9-825e73650a28', 155, 1, 1, 1, 'local', 'sample_360.mp4', 'sample_720.mp4', '2019-09-26 21:37:16', 'sample_360.mp4', NULL, '2019-09-26 16:07:16', '2019-09-26 16:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(10) UNSIGNED NOT NULL,
  `viewable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewable_id` bigint(20) UNSIGNED NOT NULL,
  `visitor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `announcements_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `announcements_slug_unique` (`slug`),
  ADD KEY `announcements_user_id_foreign` (`user_id`);

--
-- Indexes for table `announcement_course`
--
ALTER TABLE `announcement_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_course_announcement_id_foreign` (`announcement_id`),
  ADD KEY `announcement_course_course_id_foreign` (`course_id`);

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_name_index` (`name`),
  ADD KEY `cart_user_id_status_index` (`user_id`,`status`),
  ADD KEY `cart_session_status_index` (`session`,`status`);

--
-- Indexes for table `cart_lines`
--
ALTER TABLE `cart_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_lines_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_lines_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_index` (`parent_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `certificates_certificate_no_unique` (`certificate_no`),
  ADD KEY `certificates_user_id_foreign` (`user_id`),
  ADD KEY `certificates_course_id_foreign` (`course_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `completions`
--
ALTER TABLE `completions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completions_lesson_id_foreign` (`lesson_id`),
  ADD KEY `completions_user_id_foreign` (`user_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contents_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_course_id_foreign` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`),
  ADD KEY `courses_user_id_foreign` (`user_id`),
  ADD KEY `courses_category_id_foreign` (`category_id`);

--
-- Indexes for table `course_targets`
--
ALTER TABLE `course_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_targets_course_id_foreign` (`course_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_carbon_code_unique` (`carbon_code`),
  ADD UNIQUE KEY `languages_php_code_unique` (`php_code`),
  ADD UNIQUE KEY `languages_name_unique` (`name`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ledgers_recordable_type_recordable_id_index` (`recordable_type`,`recordable_id`),
  ADD KEY `ledgers_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_section_id_foreign` (`section_id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Indexes for table `mc_conversations`
--
ALTER TABLE `mc_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mc_conversation_user`
--
ALTER TABLE `mc_conversation_user`
  ADD PRIMARY KEY (`user_id`,`conversation_id`),
  ADD KEY `mc_conversation_user_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `mc_messages`
--
ALTER TABLE `mc_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mc_messages_user_id_foreign` (`user_id`),
  ADD KEY `mc_messages_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `mc_message_notification`
--
ALTER TABLE `mc_message_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mc_message_notification_user_id_message_id_index` (`user_id`,`message_id`),
  ADD KEY `mc_message_notification_message_id_foreign` (`message_id`),
  ADD KEY `mc_message_notification_conversation_id_foreign` (`conversation_id`);

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
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `package_languages`
--
ALTER TABLE `package_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_translations_language_id_foreign` (`language_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_histories`
--
ALTER TABLE `password_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_course_id_foreign` (`course_id`),
  ADD KEY `payments_payer_id_foreign` (`payer_id`),
  ADD KEY `payments_coupon_id_foreign` (`coupon_id`),
  ADD KEY `payments_period_id_foreign` (`period_id`),
  ADD KEY `payments_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payouts_user_id_foreign` (`user_id`),
  ADD KEY `payouts_period_id_foreign` (`period_id`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_course_id_foreign` (`course_id`),
  ADD KEY `questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_requester_id_foreign` (`requester_id`),
  ADD KEY `refunds_payment_id_foreign` (`payment_id`),
  ADD KEY `refunds_transaction_id_foreign` (`transaction_id`),
  ADD KEY `refunds_course_id_foreign` (`course_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_course_id_foreign` (`course_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_name_index` (`name`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_course_id_foreign` (`course_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_user_id_key_unique` (`user_id`,`key`),
  ADD KEY `settings_user_id_index` (`user_id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD KEY `taggables_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_viewable_type_viewable_id_index` (`viewable_type`,`viewable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_course`
--
ALTER TABLE `announcement_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_lines`
--
ALTER TABLE `cart_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `completions`
--
ALTER TABLE `completions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `course_targets`
--
ALTER TABLE `course_targets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `mc_conversations`
--
ALTER TABLE `mc_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_messages`
--
ALTER TABLE `mc_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mc_message_notification`
--
ALTER TABLE `mc_message_notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_languages`
--
ALTER TABLE `package_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_translations`
--
ALTER TABLE `package_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_histories`
--
ALTER TABLE `password_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `announcement_course`
--
ALTER TABLE `announcement_course`
  ADD CONSTRAINT `announcement_course_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcement_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_lines`
--
ALTER TABLE `cart_lines`
  ADD CONSTRAINT `cart_lines_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_lines_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `completions`
--
ALTER TABLE `completions`
  ADD CONSTRAINT `completions_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `completions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_targets`
--
ALTER TABLE `course_targets`
  ADD CONSTRAINT `course_targets_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_conversation_user`
--
ALTER TABLE `mc_conversation_user`
  ADD CONSTRAINT `mc_conversation_user_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `mc_conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mc_conversation_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_messages`
--
ALTER TABLE `mc_messages`
  ADD CONSTRAINT `mc_messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `mc_conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mc_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mc_message_notification`
--
ALTER TABLE `mc_message_notification`
  ADD CONSTRAINT `mc_message_notification_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `mc_conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mc_message_notification_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `mc_messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mc_message_notification_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD CONSTRAINT `package_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `package_languages` (`id`);

--
-- Constraints for table `password_histories`
--
ALTER TABLE `password_histories`
  ADD CONSTRAINT `password_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `payments_payer_id_foreign` FOREIGN KEY (`payer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`),
  ADD CONSTRAINT `payments_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`),
  ADD CONSTRAINT `payouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `refunds_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `refunds_requester_id_foreign` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `refunds_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
