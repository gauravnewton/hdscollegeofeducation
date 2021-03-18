-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Sep 05, 2020 at 08:59 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leads`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Gaurav', 'gaurav.mute@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `api_service`
--

DROP TABLE IF EXISTS `api_service`;
CREATE TABLE IF NOT EXISTS `api_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `delay_between_posts` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `auth_token` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `hook_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `api_service`
--

INSERT INTO `api_service` (`id`, `name`, `delay_between_posts`, `auth_token`, `url`, `hook_type`) VALUES
(1, 'CLEAR_OUT_API', '1', 'vlrkjhtigiuhendwbeiuriuew', 'https://api.clearout.io/v2/email_verify/instant', 1),
(2, 'CLEAR_PHONE_API', '2', 'sajbddsafsdfgrrstgrsfgrsg', 'https://api.clearoutphone.io/v1/phonenumber/validate', 2),
(3, 'ZAPIER_BUSINESS_CAMPAGIN', '3', 'werwefweffefed', 'https://api.clearoutphone.io/v1/phonenumber/validate', 3),
(4, 'ZAPIER_EDU_FREE_MAIL', '4', 'fsedsgfdffgdfgdfgfdgrd', 'https://api.clearoutphone.io/v1/phonenumber/validate', 4),
(5, 'ZAPIER_EDU_COMPAGIN', '5', 'cvybiunefewfef', 'https://api.clearoutphone.io/v1/phonenumber/validate', 5),
(6, 'ZAPIER_HOME_CAMPAGIN', '6', 'fewefwefwefewfwefewfef', 'https://api.clearoutphone.io/v1/phonenumber/validate', 6),
(7, 'ZAPIER_RESEARCH_TASK_CAMPAGIN', '7', 'edtrfgyhujiko', 'https://api.clearoutphone.io/v1/phonenumber/validate', 7),
(8, 'ZAPIER_CALL_TASK_CAMPAGIN', '8', 'okay', 'https://api.clearoutphone.io/v1/phonenumber/validate', 8);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `brand_tag` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `county_position_in_template` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `email_position_in_template` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `telephone_position_in_template` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `creation_date_in_position` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `commercial_category` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `edu_category` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `home_category` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `template_url` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `file_format` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `has_sheets` tinyint(1) NOT NULL,
  `added_by` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `hide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_template`
--

DROP TABLE IF EXISTS `brand_template`;
CREATE TABLE IF NOT EXISTS `brand_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `position` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `header_title` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `hide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'DUPLICATE_CATEGORY'),
(2, 'PROBABLE_BUSINESS'),
(3, 'HOME_CATEGORY'),
(4, 'EDU_CATEGORY'),
(5, 'BUSINESS_CATEGORY'),
(6, 'DISCARDED_CATEGORY'),
(7, 'PHONE_API_RESPONSE_ERROR'),
(8, 'EMAIL_API_RESPONSE_ERROR'),
(9, 'FREE_MAILS'),
(10, 'EDU_DOMAIN');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ISO3166_1_alpha_2` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `ISO3166_1_alpha_3` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=250 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `ISO3166_1_alpha_2`, `ISO3166_1_alpha_3`, `country_name`) VALUES
(1, 'TW', 'TWN', 'Taiwan'),
(2, 'AF', 'AFG', 'Afghanistan'),
(3, 'AL', 'ALB', 'Albania'),
(4, 'DZ', 'DZA', 'Algeria'),
(5, 'AS', 'ASM', 'American Samoa'),
(6, 'AD', 'AND', 'Andorra'),
(7, 'AO', 'AGO', 'Angola'),
(8, 'AI', 'AIA', 'Anguilla'),
(9, 'AQ', 'ATA', 'Antarctica'),
(10, 'AG', 'ATG', 'Antigua & Barbuda'),
(11, 'AR', 'ARG', 'Argentina'),
(12, 'AM', 'ARM', 'Armenia'),
(13, 'AW', 'ABW', 'Aruba'),
(14, 'AU', 'AUS', 'Australia'),
(15, 'AT', 'AUT', 'Austria'),
(16, 'AZ', 'AZE', 'Azerbaijan'),
(17, 'BS', 'BHS', 'Bahamas'),
(18, 'BH', 'BHR', 'Bahrain'),
(19, 'BD', 'BGD', 'Bangladesh'),
(20, 'BB', 'BRB', 'Barbados'),
(21, 'BY', 'BLR', 'Belarus'),
(22, 'BE', 'BEL', 'Belgium'),
(23, 'BZ', 'BLZ', 'Belize'),
(24, 'BJ', 'BEN', 'Benin'),
(25, 'BM', 'BMU', 'Bermuda'),
(26, 'BT', 'BTN', 'Bhutan'),
(27, 'BO', 'BOL', 'Bolivia'),
(28, 'BQ', 'BES', 'Caribbean Netherlands'),
(29, 'BA', 'BIH', 'Bosnia'),
(30, 'BW', 'BWA', 'Botswana'),
(31, 'BV', 'BVT', 'Bouvet Island'),
(32, 'BR', 'BRA', 'Brazil'),
(33, 'IO', 'IOT', 'British Indian Ocean Territory'),
(34, 'VG', 'VGB', 'British Virgin Islands'),
(35, 'BN', 'BRN', 'Brunei'),
(36, 'BG', 'BGR', 'Bulgaria'),
(37, 'BF', 'BFA', 'Burkina Faso'),
(38, 'BI', 'BDI', 'Burundi'),
(39, 'CV', 'CPV', 'Cape Verde'),
(40, 'KH', 'KHM', 'Cambodia'),
(41, 'CM', 'CMR', 'Cameroon'),
(42, 'CA', 'CAN', 'Canada'),
(43, 'KY', 'CYM', 'Cayman Islands'),
(44, 'CF', 'CAF', 'Central African Republic'),
(45, 'TD', 'TCD', 'Chad'),
(46, 'CL', 'CHL', 'Chile'),
(47, 'CN', 'CHN', 'China'),
(48, 'HK', 'HKG', 'Hong Kong'),
(49, 'MO', 'MAC', 'Macau'),
(50, 'CX', 'CXR', 'Christmas Island'),
(51, 'CC', 'CCK', 'Cocos (Keeling) Islands'),
(52, 'CO', 'COL', 'Colombia'),
(53, 'KM', 'COM', 'Comoros'),
(54, 'CG', 'COG', 'Congo - Brazzaville'),
(55, 'CK', 'COK', 'Cook Islands'),
(56, 'CR', 'CRI', 'Costa Rica'),
(57, 'HR', 'HRV', 'Croatia'),
(58, 'CU', 'CUB', 'Cuba'),
(59, 'CW', 'CUW', 'Curaçao'),
(60, 'CY', 'CYP', 'Cyprus'),
(61, 'CZ', 'CZE', 'Czechia'),
(62, 'CI', 'CIV', 'Côte d’Ivoire'),
(63, 'KP', 'PRK', 'North Korea'),
(64, 'CD', 'COD', 'Congo - Kinshasa'),
(65, 'DK', 'DNK', 'Denmark'),
(66, 'DJ', 'DJI', 'Djibouti'),
(67, 'DM', 'DMA', 'Dominica'),
(68, 'DO', 'DOM', 'Dominican Republic'),
(69, 'EC', 'ECU', 'Ecuador'),
(70, 'EG', 'EGY', 'Egypt'),
(71, 'SV', 'SLV', 'El Salvador'),
(72, 'GQ', 'GNQ', 'Equatorial Guinea'),
(73, 'ER', 'ERI', 'Eritrea'),
(74, 'EE', 'EST', 'Estonia'),
(75, 'ET', 'ETH', 'Ethiopia'),
(76, 'FK', 'FLK', 'Falkland Islands'),
(77, 'FO', 'FRO', 'Faroe Islands'),
(78, 'FJ', 'FJI', 'Fiji'),
(79, 'FI', 'FIN', 'Finland'),
(80, 'FR', 'FRA', 'France'),
(81, 'GF', 'GUF', 'French Guiana'),
(82, 'PF', 'PYF', 'French Polynesia'),
(83, 'TF', 'ATF', 'French Southern Territories'),
(84, 'GA', 'GAB', 'Gabon'),
(85, 'GM', 'GMB', 'Gambia'),
(86, 'GE', 'GEO', 'Georgia'),
(87, 'DE', 'DEU', 'Germany'),
(88, 'GH', 'GHA', 'Ghana'),
(89, 'GI', 'GIB', 'Gibraltar'),
(90, 'GR', 'GRC', 'Greece'),
(91, 'GL', 'GRL', 'Greenland'),
(92, 'GD', 'GRD', 'Grenada'),
(93, 'GP', 'GLP', 'Guadeloupe'),
(94, 'GU', 'GUM', 'Guam'),
(95, 'GT', 'GTM', 'Guatemala'),
(96, 'GG', 'GGY', 'Guernsey'),
(97, 'GN', 'GIN', 'Guinea'),
(98, 'GW', 'GNB', 'Guinea-Bissau'),
(99, 'GY', 'GUY', 'Guyana'),
(100, 'HT', 'HTI', 'Haiti'),
(101, 'HM', 'HMD', 'Heard & McDonald Islands'),
(102, 'VA', 'VAT', 'Vatican City'),
(103, 'HN', 'HND', 'Honduras'),
(104, 'HU', 'HUN', 'Hungary'),
(105, 'IS', 'ISL', 'Iceland'),
(106, 'IN', 'IND', 'India'),
(107, 'ID', 'IDN', 'Indonesia'),
(108, 'IR', 'IRN', 'Iran'),
(109, 'IQ', 'IRQ', 'Iraq'),
(110, 'IE', 'IRL', 'Ireland'),
(111, 'IM', 'IMN', 'Isle of Man'),
(112, 'IL', 'ISR', 'Israel'),
(113, 'IT', 'ITA', 'Italy'),
(114, 'JM', 'JAM', 'Jamaica'),
(115, 'JP', 'JPN', 'Japan'),
(116, 'JE', 'JEY', 'Jersey'),
(117, 'JO', 'JOR', 'Jordan'),
(118, 'KZ', 'KAZ', 'Kazakhstan'),
(119, 'KE', 'KEN', 'Kenya'),
(120, 'KI', 'KIR', 'Kiribati'),
(121, 'KW', 'KWT', 'Kuwait'),
(122, 'KG', 'KGZ', 'Kyrgyzstan'),
(123, 'LA', 'LAO', 'Laos'),
(124, 'LV', 'LVA', 'Latvia'),
(125, 'LB', 'LBN', 'Lebanon'),
(126, 'LS', 'LSO', 'Lesotho'),
(127, 'LR', 'LBR', 'Liberia'),
(128, 'LY', 'LBY', 'Libya'),
(129, 'LI', 'LIE', 'Liechtenstein'),
(130, 'LT', 'LTU', 'Lithuania'),
(131, 'LU', 'LUX', 'Luxembourg'),
(132, 'MG', 'MDG', 'Madagascar'),
(133, 'MW', 'MWI', 'Malawi'),
(134, 'MY', 'MYS', 'Malaysia'),
(135, 'MV', 'MDV', 'Maldives'),
(136, 'ML', 'MLI', 'Mali'),
(137, 'MT', 'MLT', 'Malta'),
(138, 'MH', 'MHL', 'Marshall Islands'),
(139, 'MQ', 'MTQ', 'Martinique'),
(140, 'MR', 'MRT', 'Mauritania'),
(141, 'MU', 'MUS', 'Mauritius'),
(142, 'YT', 'MYT', 'Mayotte'),
(143, 'MX', 'MEX', 'Mexico'),
(144, 'FM', 'FSM', 'Micronesia'),
(145, 'MC', 'MCO', 'Monaco'),
(146, 'MN', 'MNG', 'Mongolia'),
(147, 'ME', 'MNE', 'Montenegro'),
(148, 'MS', 'MSR', 'Montserrat'),
(149, 'MA', 'MAR', 'Morocco'),
(150, 'MZ', 'MOZ', 'Mozambique'),
(151, 'MM', 'MMR', 'Myanmar'),
(152, 'NA', 'NAM', 'Namibia'),
(153, 'NR', 'NRU', 'Nauru'),
(154, 'NP', 'NPL', 'Nepal'),
(155, 'NL', 'NLD', 'Netherlands'),
(156, 'NC', 'NCL', 'New Caledonia'),
(157, 'NZ', 'NZL', 'New Zealand'),
(158, 'NI', 'NIC', 'Nicaragua'),
(159, 'NE', 'NER', 'Niger'),
(160, 'NG', 'NGA', 'Nigeria'),
(161, 'NU', 'NIU', 'Niue'),
(162, 'NF', 'NFK', 'Norfolk Island'),
(163, 'MP', 'MNP', 'Northern Mariana Islands'),
(164, 'NO', 'NOR', 'Norway'),
(165, 'OM', 'OMN', 'Oman'),
(166, 'PK', 'PAK', 'Pakistan'),
(167, 'PW', 'PLW', 'Palau'),
(168, 'PA', 'PAN', 'Panama'),
(169, 'PG', 'PNG', 'Papua New Guinea'),
(170, 'PY', 'PRY', 'Paraguay'),
(171, 'PE', 'PER', 'Peru'),
(172, 'PH', 'PHL', 'Philippines'),
(173, 'PN', 'PCN', 'Pitcairn Islands'),
(174, 'PL', 'POL', 'Poland'),
(175, 'PT', 'PRT', 'Portugal'),
(176, 'PR', 'PRI', 'Puerto Rico'),
(177, 'QA', 'QAT', 'Qatar'),
(178, 'KR', 'KOR', 'South Korea'),
(179, 'MD', 'MDA', 'Moldova'),
(180, 'RO', 'ROU', 'Romania'),
(181, 'RU', 'RUS', 'Russia'),
(182, 'RW', 'RWA', 'Rwanda'),
(183, 'RE', 'REU', 'Réunion'),
(184, 'BL', 'BLM', 'St. Barthélemy'),
(185, 'SH', 'SHN', 'St. Helena'),
(186, 'KN', 'KNA', 'St. Kitts & Nevis'),
(187, 'LC', 'LCA', 'St. Lucia'),
(188, 'MF', 'MAF', 'St. Martin'),
(189, 'PM', 'SPM', 'St. Pierre & Miquelon'),
(190, 'VC', 'VCT', 'St. Vincent & Grenadines'),
(191, 'WS', 'WSM', 'Samoa'),
(192, 'SM', 'SMR', 'San Marino'),
(193, 'ST', 'STP', 'São Tomé & Príncipe'),
(194, 'SA', 'SAU', 'Saudi Arabia'),
(195, 'SN', 'SEN', 'Senegal'),
(196, 'RS', 'SRB', 'Serbia'),
(197, 'SC', 'SYC', 'Seychelles'),
(198, 'SL', 'SLE', 'Sierra Leone'),
(199, 'SG', 'SGP', 'Singapore'),
(200, 'SX', 'SXM', 'Sint Maarten'),
(201, 'SK', 'SVK', 'Slovakia'),
(202, 'SI', 'SVN', 'Slovenia'),
(203, 'SB', 'SLB', 'Solomon Islands'),
(204, 'SO', 'SOM', 'Somalia'),
(205, 'ZA', 'ZAF', 'South Africa'),
(206, 'GS', 'SGS', 'South Georgia & South Sandwich Islands'),
(207, 'SS', 'SSD', 'South Sudan'),
(208, 'ES', 'ESP', 'Spain'),
(209, 'LK', 'LKA', 'Sri Lanka'),
(210, 'PS', 'PSE', 'Palestine'),
(211, 'SD', 'SDN', 'Sudan'),
(212, 'SR', 'SUR', 'Suriname'),
(213, 'SJ', 'SJM', 'Svalbard & Jan Mayen'),
(214, 'SZ', 'SWZ', 'Swaziland'),
(215, 'SE', 'SWE', 'Sweden'),
(216, 'CH', 'CHE', 'Switzerland'),
(217, 'SY', 'SYR', 'Syria'),
(218, 'TJ', 'TJK', 'Tajikistan'),
(219, 'TH', 'THA', 'Thailand'),
(220, 'MK', 'MKD', 'Macedonia'),
(221, 'TL', 'TLS', 'Timor-Leste'),
(222, 'TG', 'TGO', 'Togo'),
(223, 'TK', 'TKL', 'Tokelau'),
(224, 'TO', 'TON', 'Tonga'),
(225, 'TT', 'TTO', 'Trinidad & Tobago'),
(226, 'TN', 'TUN', 'Tunisia'),
(227, 'TR', 'TUR', 'Turkey'),
(228, 'TM', 'TKM', 'Turkmenistan'),
(229, 'TC', 'TCA', 'Turks & Caicos Islands'),
(230, 'TV', 'TUV', 'Tuvalu'),
(231, 'UG', 'UGA', 'Uganda'),
(232, 'UA', 'UKR', 'Ukraine'),
(233, 'AE', 'ARE', 'United Arab Emirates'),
(234, 'GB', 'GBR', 'UK'),
(235, 'TZ', 'TZA', 'Tanzania'),
(236, 'UM', 'UMI', 'U.S. Outlying Islands'),
(237, 'VI', 'VIR', 'U.S. Virgin Islands'),
(238, 'US', 'USA', 'US'),
(239, 'UY', 'URY', 'Uruguay'),
(240, 'UZ', 'UZB', 'Uzbekistan'),
(241, 'VU', 'VUT', 'Vanuatu'),
(242, 'VE', 'VEN', 'Venezuela'),
(243, 'VN', 'VNM', 'Vietnam'),
(244, 'WF', 'WLF', 'Wallis & Futuna'),
(245, 'EH', 'ESH', 'Western Sahara'),
(246, 'YE', 'YEM', 'Yemen'),
(247, 'ZM', 'ZMB', 'Zambia'),
(248, 'ZW', 'ZWE', 'Zimbabwe'),
(249, 'AX', 'ALA', 'Åland Islands');

-- --------------------------------------------------------

--
-- Table structure for table `import_batch`
--

DROP TABLE IF EXISTS `import_batch`;
CREATE TABLE IF NOT EXISTS `import_batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `brand_id` int(11) NOT NULL,
  `total_commercial` int(11) NOT NULL,
  `total_edu` int(11) NOT NULL,
  `total_duplicates` int(11) NOT NULL,
  `total_home` int(11) NOT NULL,
  `total_discard` int(11) NOT NULL,
  `total_business` int(11) NOT NULL,
  `records_process` int(11) NOT NULL,
  `total_records` int(11) NOT NULL,
  `total_email_error` int(11) NOT NULL,
  `total_phone_error` int(11) NOT NULL,
  `total_free_mails` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
CREATE TABLE IF NOT EXISTS `keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`id`, `category_id`, `name`, `status`) VALUES
(1, 4, 'estudiante', 1),
(2, 4, 'estudante', 1),
(3, 4, 'student', 1),
(4, 4, 'profesor', 1),
(5, 4, 'instructor', 1),
(6, 4, 'universidad', 1),
(7, 4, 'universitario', 1),
(8, 2, 'arquitecto', 1),
(9, 2, 'arq', 1),
(10, 2, 'ingeniero', 1),
(11, 9, 'hotmail.com', 1),
(12, 9, 'gmail.com ', 1),
(13, 9, 'yahoo.com.br', 1),
(14, 10, '.edu', 1),
(15, 10, '.edu.ar', 1),
(16, 10, '.edu.co', 1),
(17, 10, '.edu.br', 1),
(18, 10, '.uba.ar', 1),
(19, 3, 'hogar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
CREATE TABLE IF NOT EXISTS `record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `country` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `telephone` varchar(25) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `original_row` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research_task`
--

DROP TABLE IF EXISTS `research_task`;
CREATE TABLE IF NOT EXISTS `research_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `research_task`
--

INSERT INTO `research_task` (`id`, `record_id`, `comment`) VALUES
(1, 1, 'Find telephone and complete CRM data'),
(2, 2, 'Find telephone and complete CRM data'),
(3, 3, 'Find telephone and complete CRM data'),
(4, 4, 'Find telephone and complete CRM data'),
(5, 6, 'Find telephone and complete CRM data'),
(6, 7, 'Find telephone and complete CRM data'),
(7, 8, 'Find telephone and complete CRM data'),
(8, 9, 'Find telephone and complete CRM data'),
(9, 10, 'Find telephone and complete CRM data'),
(10, 11, 'Find telephone and complete CRM data'),
(11, 12, 'Find telephone and complete CRM data'),
(12, 13, 'Find telephone and complete CRM data'),
(13, 28, 'Find telephone and complete CRM data'),
(14, 29, 'Find telephone and complete CRM data'),
(15, 30, 'Find telephone and complete CRM data'),
(16, 31, 'Find telephone and complete CRM data'),
(17, 32, 'Find telephone and complete CRM data'),
(18, 33, 'Find telephone and complete CRM data'),
(19, 37, 'Find telephone and complete CRM data'),
(20, 38, 'Find telephone and complete CRM data'),
(21, 40, 'Find telephone and complete CRM data'),
(22, 41, 'Find telephone and complete CRM data'),
(23, 42, 'Find telephone and complete CRM data'),
(24, 43, 'Find telephone and complete CRM data'),
(25, 44, 'Find telephone and complete CRM data'),
(26, 45, 'Find telephone and complete CRM data'),
(27, 46, 'Find telephone and complete CRM data'),
(28, 47, 'Find telephone and complete CRM data'),
(29, 48, 'Find telephone and complete CRM data'),
(30, 50, 'Find telephone and complete CRM data'),
(31, 51, 'Find telephone and complete CRM data'),
(32, 52, 'Find telephone and complete CRM data'),
(33, 53, 'Find telephone and complete CRM data'),
(34, 54, 'Find telephone and complete CRM data'),
(35, 55, 'Find telephone and complete CRM data'),
(36, 56, 'Find telephone and complete CRM data'),
(37, 57, 'Find telephone and complete CRM data'),
(38, 58, 'Find telephone and complete CRM data'),
(39, 59, 'Find telephone and complete CRM data'),
(40, 60, 'Find telephone and complete CRM data'),
(41, 61, 'Find telephone and complete CRM data'),
(42, 62, 'Find telephone and complete CRM data'),
(43, 63, 'Find telephone and complete CRM data'),
(44, 66, 'Find telephone and complete CRM data'),
(45, 67, 'Find telephone and complete CRM data'),
(46, 68, 'Find telephone and complete CRM data'),
(47, 69, 'Find telephone and complete CRM data'),
(48, 70, 'Find telephone and complete CRM data'),
(49, 71, 'Find telephone and complete CRM data'),
(50, 72, 'Find telephone and complete CRM data'),
(51, 73, 'Find telephone and complete CRM data'),
(52, 74, 'Find telephone and complete CRM data'),
(53, 77, 'Find telephone and complete CRM data'),
(54, 78, 'Find telephone and complete CRM data'),
(55, 79, 'Find telephone and complete CRM data'),
(56, 80, 'Find telephone and complete CRM data'),
(57, 81, 'Find telephone and complete CRM data'),
(58, 82, 'Find telephone and complete CRM data'),
(59, 83, 'Find telephone and complete CRM data'),
(60, 84, 'Find telephone and complete CRM data'),
(61, 85, 'Find telephone and complete CRM data'),
(62, 86, 'Find telephone and complete CRM data'),
(63, 88, 'Find telephone and complete CRM data'),
(64, 89, 'Find telephone and complete CRM data'),
(65, 90, 'Find telephone and complete CRM data'),
(66, 91, 'Find telephone and complete CRM data'),
(67, 92, 'Find telephone and complete CRM data'),
(68, 93, 'Find telephone and complete CRM data'),
(69, 94, 'Find telephone and complete CRM data'),
(70, 96, 'Find telephone and complete CRM data'),
(71, 99, 'Find telephone and complete CRM data'),
(72, 100, 'Find telephone and complete CRM data'),
(73, 101, 'Find telephone and complete CRM data'),
(74, 102, 'Find telephone and complete CRM data'),
(75, 103, 'Find telephone and complete CRM data'),
(76, 104, 'Find telephone and complete CRM data'),
(77, 105, 'Find telephone and complete CRM data'),
(78, 106, 'Find telephone and complete CRM data'),
(79, 107, 'Find telephone and complete CRM data'),
(80, 108, 'Find telephone and complete CRM data'),
(81, 2, 'Find telephone and complete CRM data'),
(82, 3, 'Find telephone and complete CRM data'),
(83, 4, 'Find telephone and complete CRM data'),
(84, 5, 'Find telephone and complete CRM data'),
(85, 6, 'Find telephone and complete CRM data'),
(86, 7, 'Find telephone and complete CRM data'),
(87, 11, 'Find telephone and complete CRM data'),
(88, 12, 'Find telephone and complete CRM data'),
(89, 14, 'Find telephone and complete CRM data'),
(90, 15, 'Find telephone and complete CRM data'),
(91, 16, 'Find telephone and complete CRM data'),
(92, 17, 'Find telephone and complete CRM data'),
(93, 18, 'Find telephone and complete CRM data'),
(94, 19, 'Find telephone and complete CRM data'),
(95, 20, 'Find telephone and complete CRM data'),
(96, 21, 'Find telephone and complete CRM data'),
(97, 22, 'Find telephone and complete CRM data'),
(98, 24, 'Find telephone and complete CRM data'),
(99, 25, 'Find telephone and complete CRM data'),
(100, 26, 'Find telephone and complete CRM data'),
(101, 27, 'Find telephone and complete CRM data'),
(102, 28, 'Find telephone and complete CRM data'),
(103, 29, 'Find telephone and complete CRM data'),
(104, 30, 'Find telephone and complete CRM data'),
(105, 31, 'Find telephone and complete CRM data'),
(106, 32, 'Find telephone and complete CRM data'),
(107, 33, 'Find telephone and complete CRM data'),
(108, 34, 'Find telephone and complete CRM data'),
(109, 35, 'Find telephone and complete CRM data'),
(110, 36, 'Find telephone and complete CRM data'),
(111, 37, 'Find telephone and complete CRM data'),
(112, 40, 'Find telephone and complete CRM data'),
(113, 41, 'Find telephone and complete CRM data'),
(114, 42, 'Find telephone and complete CRM data'),
(115, 43, 'Find telephone and complete CRM data'),
(116, 44, 'Find telephone and complete CRM data'),
(117, 45, 'Find telephone and complete CRM data'),
(118, 46, 'Find telephone and complete CRM data'),
(119, 47, 'Find telephone and complete CRM data'),
(120, 48, 'Find telephone and complete CRM data'),
(121, 51, 'Find telephone and complete CRM data'),
(122, 52, 'Find telephone and complete CRM data'),
(123, 53, 'Find telephone and complete CRM data'),
(124, 54, 'Find telephone and complete CRM data'),
(125, 55, 'Find telephone and complete CRM data'),
(126, 56, 'Find telephone and complete CRM data'),
(127, 57, 'Find telephone and complete CRM data'),
(128, 58, 'Find telephone and complete CRM data'),
(129, 59, 'Find telephone and complete CRM data'),
(130, 60, 'Find telephone and complete CRM data'),
(131, 62, 'Find telephone and complete CRM data'),
(132, 63, 'Find telephone and complete CRM data'),
(133, 64, 'Find telephone and complete CRM data'),
(134, 65, 'Find telephone and complete CRM data'),
(135, 66, 'Find telephone and complete CRM data'),
(136, 67, 'Find telephone and complete CRM data'),
(137, 68, 'Find telephone and complete CRM data'),
(138, 70, 'Find telephone and complete CRM data'),
(139, 73, 'Find telephone and complete CRM data'),
(140, 74, 'Find telephone and complete CRM data'),
(141, 75, 'Find telephone and complete CRM data'),
(142, 76, 'Find telephone and complete CRM data'),
(143, 77, 'Find telephone and complete CRM data'),
(144, 78, 'Find telephone and complete CRM data'),
(145, 79, 'Find telephone and complete CRM data'),
(146, 80, 'Find telephone and complete CRM data'),
(147, 81, 'Find telephone and complete CRM data'),
(148, 82, 'Find telephone and complete CRM data'),
(149, 2, 'Find telephone and complete CRM data'),
(150, 11, 'Find telephone and complete CRM data'),
(151, 12, 'Find telephone and complete CRM data'),
(152, 13, 'Find telephone and complete CRM data'),
(153, 14, 'Find telephone and complete CRM data'),
(154, 16, 'Find telephone and complete CRM data'),
(155, 17, 'Find telephone and complete CRM data'),
(156, 18, 'Find telephone and complete CRM data'),
(157, 19, 'Find telephone and complete CRM data'),
(158, 20, 'Find telephone and complete CRM data'),
(159, 21, 'Find telephone and complete CRM data'),
(160, 22, 'Find telephone and complete CRM data'),
(161, 23, 'Find telephone and complete CRM data'),
(162, 1, 'Find telephone and complete CRM data'),
(163, 2, 'Find telephone and complete CRM data'),
(164, 3, 'Find telephone and complete CRM data'),
(165, 4, 'Find telephone and complete CRM data'),
(166, 6, 'Find telephone and complete CRM data'),
(167, 7, 'Find telephone and complete CRM data'),
(168, 8, 'Find telephone and complete CRM data'),
(169, 9, 'Find telephone and complete CRM data'),
(170, 10, 'Find telephone and complete CRM data'),
(171, 11, 'Find telephone and complete CRM data'),
(172, 12, 'Find telephone and complete CRM data'),
(173, 13, 'Find telephone and complete CRM data'),
(174, 2, 'Find telephone and complete CRM data'),
(175, 2, 'Find telephone and complete CRM data'),
(176, 2, 'Find telephone and complete CRM data'),
(177, 2, 'Find telephone and complete CRM data'),
(178, 2, 'Find telephone and complete CRM data'),
(179, 2, 'Find telephone and complete CRM data'),
(180, 2, 'Find telephone and complete CRM data'),
(181, 2, 'Find telephone and complete CRM data'),
(182, 2, 'Find telephone and complete CRM data'),
(183, 2, 'Find telephone and complete CRM data'),
(184, 2, 'Find telephone and complete CRM data'),
(185, 6, 'Find telephone and complete CRM data');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `apikey` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `roleId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
