-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 19, 2020 at 02:00 PM
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
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `delay_between_posts` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `auth_token` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
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
-- Table structure for table `async_record_processor_data`
--

DROP TABLE IF EXISTS `async_record_processor_data`;
CREATE TABLE IF NOT EXISTS `async_record_processor_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `original_row` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `processed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `async_record_processor_data`
--

INSERT INTO `async_record_processor_data` (`id`, `batch_id`, `brand_id`, `original_row`, `processed`) VALUES
(1, 1, 3, '{\"A\":\"AGUSTINA\",\"B\":\"Rhino\",\"C\":\"Argentina\",\"D\":\"STUDENT\",\"E\":null,\"F\":\"Education\",\"G\":\"08\\/13\\/2020\",\"H\":\"amagustinamarquez@gmail.com\"}', 1),
(2, 1, 3, '{\"A\":\"alezio\",\"B\":\"CATIA\",\"C\":\"Argentina\",\"D\":\"magicalien\",\"E\":231715462610,\"F\":\"Education\",\"G\":\"08\\/13\\/2020\",\"H\":\"alesiozunino3@gmail.com\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `brand_tag` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `first_name_position_in_template` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `last_name_position_in_template` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `organization_position_in_template` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_tag`, `first_name_position_in_template`, `last_name_position_in_template`, `organization_position_in_template`, `county_position_in_template`, `email_position_in_template`, `telephone_position_in_template`, `creation_date_in_position`, `commercial_category`, `edu_category`, `home_category`, `template_url`, `file_format`, `has_sheets`, `added_by`, `hide`) VALUES
(1, 'Google', 'SEO,Google', 'A', 'B', 'D', 'D', 'I', 'F', 'H', 'Commercial Cat', 'Edu Cat', 'Home cat', 'LATAM_(1)4.xls', 'XLS', 6, '(admin)', 0),
(2, 'Zapier Tech', 'zapier,auth,token', 'A', 'B', 'E', 'D', 'I', 'F', 'H', 'Commercial Cat', 'Edu Cat', 'Home cat', 'LATAM_(1)3.xls', 'XLS', 6, '(admin)', 0),
(3, 'Brand CSV', 'CSV BRANDS', 'A', '', 'D', 'C', 'H', 'E', 'G', 'Commercial Cat', 'Edu Cat', 'Home cat', 'Reports30.csv', 'CSV', 1, '(admin)', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `brand_template`
--

INSERT INTO `brand_template` (`id`, `brand_id`, `position`, `header_title`, `hide`) VALUES
(1, 1, 'A', 'First Name', 1),
(2, 1, 'B', 'Modeling Software', 1),
(3, 1, 'C', 'Country', 1),
(4, 1, 'D', 'Company / Account', 1),
(5, 1, 'E', 'Phone', 1),
(6, 1, 'F', 'Industry', 1),
(7, 1, 'G', 'Create Date', 1),
(8, 1, 'H', 'Email', 1),
(9, 2, 'A', 'First Name', 1),
(10, 2, 'B', 'Modeling Software', 1),
(11, 2, 'C', 'Country', 1),
(12, 2, 'D', 'Company / Account', 1),
(13, 2, 'E', 'Phone', 1),
(14, 2, 'F', 'Industry', 1),
(15, 2, 'G', 'Create Date', 1),
(16, 2, 'H', 'Email', 1),
(17, 1, 'A', 'First Name', 1),
(18, 1, 'B', 'Last Name', 1),
(19, 1, 'C', 'Modeling Software', 1),
(20, 1, 'D', 'Country', 1),
(21, 1, 'E', 'Company / Account', 1),
(22, 1, 'F', 'Phone', 1),
(23, 1, 'G', 'Industry', 1),
(24, 1, 'H', 'Create Date', 1),
(25, 1, 'I', 'Email', 1),
(26, 1, 'A', 'First Name', 1),
(27, 1, 'B', 'Last Name', 1),
(28, 1, 'C', 'Modeling Software', 1),
(29, 1, 'D', 'Country', 1),
(30, 1, 'E', 'Company / Account', 1),
(31, 1, 'F', 'Phone', 1),
(32, 1, 'G', 'Industry', 1),
(33, 1, 'H', 'Create Date', 1),
(34, 1, 'I', 'Email', 1),
(35, 1, 'A', 'First Name', 1),
(36, 1, 'B', 'Modeling Software', 1),
(37, 1, 'C', 'Country', 1),
(38, 1, 'D', 'Company / Account', 1),
(39, 1, 'E', 'Phone', 1),
(40, 1, 'F', 'Industry', 1),
(41, 1, 'G', 'Create Date', 1),
(42, 1, 'H', 'Email', 1),
(43, 2, 'A', 'First Name', 0),
(44, 2, 'B', 'Last Name', 0),
(45, 2, 'C', 'Modeling Software', 0),
(46, 2, 'D', 'Country', 0),
(47, 2, 'E', 'Company / Account', 0),
(48, 2, 'F', 'Phone', 0),
(49, 2, 'G', 'Industry', 0),
(50, 2, 'H', 'Create Date', 0),
(51, 2, 'I', 'Email', 0),
(52, 1, 'A', 'First Name', 1),
(53, 1, 'B', 'Modeling Software', 1),
(54, 1, 'C', 'Country', 1),
(55, 1, 'D', 'Company / Account', 1),
(56, 1, 'E', 'Phone', 1),
(57, 1, 'F', 'Industry', 1),
(58, 1, 'G', 'Create Date', 1),
(59, 1, 'H', 'Email', 1),
(60, 1, 'A', 'First Name', 0),
(61, 1, 'B', 'Last Name', 0),
(62, 1, 'C', 'Modeling Software', 0),
(63, 1, 'D', 'Country', 0),
(64, 1, 'E', 'Company / Account', 0),
(65, 1, 'F', 'Phone', 0),
(66, 1, 'G', 'Industry', 0),
(67, 1, 'H', 'Create Date', 0),
(68, 1, 'I', 'Email', 0),
(69, 3, 'A', 'First Name', 0),
(70, 3, 'B', 'Modeling Software', 0),
(71, 3, 'C', 'Country', 0),
(72, 3, 'D', 'Company / Account', 0),
(73, 3, 'E', 'Phone', 0),
(74, 3, 'F', 'Industry', 0),
(75, 3, 'G', 'Create Date', 0),
(76, 3, 'H', 'Email', 0);

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
  `is_processed_by_cron` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `import_batch`
--

INSERT INTO `import_batch` (`id`, `date_start`, `date_end`, `brand_id`, `total_commercial`, `total_edu`, `total_duplicates`, `total_home`, `total_discard`, `total_business`, `records_process`, `total_records`, `total_email_error`, `total_phone_error`, `total_free_mails`, `is_processed_by_cron`) VALUES
(1, '2020-08-13', '2020-08-13', 3, 0, 2, 0, -1, 0, 2, 2, 2, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
CREATE TABLE IF NOT EXISTS `keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
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
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `event_type` varchar(1024) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `request_payload` varchar(1024) COLLATE utf32_unicode_ci NOT NULL,
  `response_payload` varchar(1024) COLLATE utf32_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `record_id`, `event_type`, `request_payload`, `response_payload`, `timestamp`) VALUES
(1, 'N/A', 'Clear Out Email API Call', 'amagustinamarquez@gmail.com', '{\"status\":\"success\",\"data\":{\"email_address\":\"palomanesd@gmail.com\",\"status\":\"valid\",\"verified_on\":\"2020-08-14T14:01:39.767Z\",\"time_taken\":1062,\"sub_status\":{\"code\":200,\"desc\":\"Success\"},\"detail_info\":{\"account\":\"palomanesd\",\"domain\":\"gmail.com\"},\"disposable\":\"no\",\"free\":\"no\",\"role\":\"no\",\"suggested_email_address\":\"\",\"profile\":\"\",\"score\":1,\"bounce_type\":\"\",\"safe_to_send\":\"yes\",\"deliverability_score\":100}}', '2020-10-14 21:37:02'),
(2, '1', 'EDU Category', '{\"date\":\"2020-08-13\",\"country\":\"11\",\"email\":\"amagustinamarquez@gmail.com\",\"telephone\":\"N\\/A\",\"category_id\":4,\"brand_id\":\"3\",\"batch_id\":\"1\",\"original_row\":\"{\\\"First Name\\\":\\\"AGUSTINA\\\",\\\"Tags\\\":\\\"CSV BRANDS\\\",\\\"commercialCampaign\\\":\\\"Commercial Cat\\\",\\\"eduCampaign\\\":\\\"Edu Cat\\\",\\\"homeCampaign\\\":\\\"Home cat\\\",\\\"Modeling Software\\\":\\\"Rhino\\\",\\\"Country\\\":\\\"Argentina\\\",\\\"Company \\\\\\/ Account\\\":\\\"STUDENT\\\",\\\"Phone\\\":null,\\\"Industry\\\":\\\"Education\\\",\\\"Create Date\\\":\\\"2020-08-13\\\",\\\"Email\\\":\\\"amagustinamarquez@gmail.com\\\"}\",\"async_record_id\":\"1\"}', 'Preserving as EDU Category', '2020-10-14 21:37:02'),
(3, '1', 'Zapier EDU free email Send Campaign Webhook', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-14 21:37:14'),
(4, 'N/A', 'Clear Out Email API Call', 'alesiozunino3@gmail.com', '{\"status\":\"success\",\"data\":{\"email_address\":\"palomanesd@gmail.com\",\"status\":\"valid\",\"verified_on\":\"2020-08-14T14:01:39.767Z\",\"time_taken\":1062,\"sub_status\":{\"code\":200,\"desc\":\"Success\"},\"detail_info\":{\"account\":\"palomanesd\",\"domain\":\"gmail.com\"},\"disposable\":\"no\",\"free\":\"no\",\"role\":\"no\",\"suggested_email_address\":\"\",\"profile\":\"\",\"score\":1,\"bounce_type\":\"\",\"safe_to_send\":\"yes\",\"deliverability_score\":100}}', '2020-10-14 21:37:14'),
(5, '2', 'Business Category', '{\"date\":\"2020-08-13\",\"country\":\"11\",\"email\":\"alesiozunino3@gmail.com\",\"telephone\":231715462610,\"category_id\":5,\"brand_id\":\"3\",\"batch_id\":\"1\",\"original_row\":\"{\\\"First Name\\\":\\\"alezio\\\",\\\"Tags\\\":\\\"CSV BRANDS\\\",\\\"commercialCampaign\\\":\\\"Commercial Cat\\\",\\\"eduCampaign\\\":\\\"Edu Cat\\\",\\\"homeCampaign\\\":\\\"Home cat\\\",\\\"Modeling Software\\\":\\\"CATIA\\\",\\\"Country\\\":\\\"Argentina\\\",\\\"Company \\\\\\/ Account\\\":\\\"magicalien\\\",\\\"Phone\\\":231715462610,\\\"Industry\\\":\\\"Education\\\",\\\"Create Date\\\":\\\"2020-08-13\\\",\\\"Email\\\":\\\"alesiozunino3@gmail.com\\\"}\",\"async_record_id\":\"2\"}', 'Preserved as Business Category', '2020-10-14 21:37:14'),
(6, 'N/A', 'Zapier Business Send Campaign webhook', '{\"First Name\":\"alezio\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"CATIA\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"magicalien\",\"Phone\":231715462610,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"alesiozunino3@gmail.com\"}', 'false', '2020-10-14 21:37:17'),
(7, '2', 'Invalid phone number', '231715462610', '{\"status\":\"success\",\"data\":{\"status\":\"invalid\",\"line_type\":\"mobile\",\"carrier\":\"\",\"location\":\"Mendoza, Mendoza\",\"country_name\":\"Argentina\",\"country_timezone\":\"America\\/Buenos_Aires\",\"country_code\":\"AR\",\"international_format\":\"+54 9 261 525-7156\",\"local_format\":\"0261 15-525-7156\",\"e164_format\":\"+5492615257156\",\"can_be_internationally_dialled\":\"yes\"}}', '2020-10-14 21:37:17'),
(8, '1', 'Clear Out Email API call during Manual category change', '[{\"id\":\"1\",\"date\":\"2020-08-13\",\"country\":\"11\",\"email\":\"amagustinamarquez@gmail.com\",\"telephone\":\"N\\/A\",\"category_id\":\"4\",\"brand_id\":\"3\",\"batch_id\":\"1\",\"original_row\":\"{\\\"First Name\\\":\\\"AGUSTINA\\\",\\\"Tags\\\":\\\"CSV BRANDS\\\",\\\"commercialCampaign\\\":\\\"Commercial Cat\\\",\\\"eduCampaign\\\":\\\"Edu Cat\\\",\\\"homeCampaign\\\":\\\"Home cat\\\",\\\"Modeling Software\\\":\\\"Rhino\\\",\\\"Country\\\":\\\"Argentina\\\",\\\"Company \\\\\\/ Account\\\":\\\"STUDENT\\\",\\\"Phone\\\":null,\\\"Industry\\\":\\\"Education\\\",\\\"Create Date\\\":\\\"2020-08-13\\\",\\\"Email\\\":\\\"amagustinamarquez@gmail.com\\\"}\",\"async_record_id\":\"1\"}]', '{\"status\":\"success\",\"data\":{\"email_address\":\"palomanesd@gmail.com\",\"status\":\"valid\",\"verified_on\":\"2020-08-14T14:01:39.767Z\",\"time_taken\":1062,\"sub_status\":{\"code\":200,\"desc\":\"Success\"},\"detail_info\":{\"account\":\"palomanesd\",\"domain\":\"gmail.com\"},\"disposable\":\"no\",\"free\":\"no\",\"role\":\"no\",\"suggested_email_address\":\"\",\"profile\":\"\",\"score\":1,\"bounce_type\":\"\",\"safe_to_send\":\"yes\",\"deliverability_score\":100}}', '2020-10-14 21:40:15'),
(9, '1', 'Manual category changed to EDU category', '{\"category_id\":10}', 'Record persisted as EDU Category', '2020-10-14 21:40:15'),
(10, '1', 'Zapier EDU free email send campagin webhook call during manual category change', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-14 21:40:19'),
(11, '1', 'Clear Out Email API call during Manual category change', '[{\"id\":\"1\",\"date\":\"2020-08-13\",\"country\":\"11\",\"email\":\"amagustinamarquez@gmail.com\",\"telephone\":\"N\\/A\",\"category_id\":\"10\",\"brand_id\":\"3\",\"batch_id\":\"1\",\"original_row\":\"{\\\"First Name\\\":\\\"AGUSTINA\\\",\\\"Tags\\\":\\\"CSV BRANDS\\\",\\\"commercialCampaign\\\":\\\"Commercial Cat\\\",\\\"eduCampaign\\\":\\\"Edu Cat\\\",\\\"homeCampaign\\\":\\\"Home cat\\\",\\\"Modeling Software\\\":\\\"Rhino\\\",\\\"Country\\\":\\\"Argentina\\\",\\\"Company \\\\\\/ Account\\\":\\\"STUDENT\\\",\\\"Phone\\\":null,\\\"Industry\\\":\\\"Education\\\",\\\"Create Date\\\":\\\"2020-08-13\\\",\\\"Email\\\":\\\"amagustinamarquez@gmail.com\\\"}\",\"async_record_id\":\"1\"}]', '{\"status\":\"success\",\"data\":{\"email_address\":\"palomanesd@gmail.com\",\"status\":\"valid\",\"verified_on\":\"2020-08-14T14:01:39.767Z\",\"time_taken\":1062,\"sub_status\":{\"code\":200,\"desc\":\"Success\"},\"detail_info\":{\"account\":\"palomanesd\",\"domain\":\"gmail.com\"},\"disposable\":\"no\",\"free\":\"no\",\"role\":\"no\",\"suggested_email_address\":\"\",\"profile\":\"\",\"score\":1,\"bounce_type\":\"\",\"safe_to_send\":\"yes\",\"deliverability_score\":100}}', '2020-10-14 21:40:34'),
(12, '1', 'Manual category changed to EDU category', '{\"category_id\":10}', 'Record persisted as EDU Category', '2020-10-14 21:40:34'),
(13, '1', 'Zapier EDU free email send campagin webhook call during manual category change', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-14 21:40:38'),
(14, '1', 'Clear Out Email API call during Manual category change', '[{\"id\":\"1\",\"date\":\"2020-08-13\",\"country\":\"11\",\"email\":\"amagustinamarquez@gmail.com\",\"telephone\":\"N\\/A\",\"category_id\":\"10\",\"brand_id\":\"3\",\"batch_id\":\"1\",\"original_row\":\"{\\\"First Name\\\":\\\"AGUSTINA\\\",\\\"Tags\\\":\\\"CSV BRANDS\\\",\\\"commercialCampaign\\\":\\\"Commercial Cat\\\",\\\"eduCampaign\\\":\\\"Edu Cat\\\",\\\"homeCampaign\\\":\\\"Home cat\\\",\\\"Modeling Software\\\":\\\"Rhino\\\",\\\"Country\\\":\\\"Argentina\\\",\\\"Company \\\\\\/ Account\\\":\\\"STUDENT\\\",\\\"Phone\\\":null,\\\"Industry\\\":\\\"Education\\\",\\\"Create Date\\\":\\\"2020-08-13\\\",\\\"Email\\\":\\\"amagustinamarquez@gmail.com\\\"}\",\"async_record_id\":\"1\"}]', '{\"status\":\"success\",\"data\":{\"email_address\":\"palomanesd@gmail.com\",\"status\":\"valid\",\"verified_on\":\"2020-08-14T14:01:39.767Z\",\"time_taken\":1062,\"sub_status\":{\"code\":200,\"desc\":\"Success\"},\"detail_info\":{\"account\":\"palomanesd\",\"domain\":\"gmail.com\"},\"disposable\":\"no\",\"free\":\"no\",\"role\":\"no\",\"suggested_email_address\":\"\",\"profile\":\"\",\"score\":1,\"bounce_type\":\"\",\"safe_to_send\":\"yes\",\"deliverability_score\":100}}', '2020-10-14 21:43:14'),
(15, '1', 'Manual category changed to EDU category', '{\"category_id\":10}', 'Record persisted as EDU Category', '2020-10-14 21:43:14'),
(16, '1', 'Zapier EDU free email send campagin webhook call during manual category change', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-14 21:43:19'),
(17, '1', 'Clear Out Email API call during Manual category change', '[{\"id\":\"1\",\"date\":\"2020-08-13\",\"country\":\"11\",\"email\":\"amagustinamarquez@gmail.com\",\"telephone\":\"N\\/A\",\"category_id\":\"10\",\"brand_id\":\"3\",\"batch_id\":\"1\",\"original_row\":\"{\\\"First Name\\\":\\\"AGUSTINA\\\",\\\"Tags\\\":\\\"CSV BRANDS\\\",\\\"commercialCampaign\\\":\\\"Commercial Cat\\\",\\\"eduCampaign\\\":\\\"Edu Cat\\\",\\\"homeCampaign\\\":\\\"Home cat\\\",\\\"Modeling Software\\\":\\\"Rhino\\\",\\\"Country\\\":\\\"Argentina\\\",\\\"Company \\\\\\/ Account\\\":\\\"STUDENT\\\",\\\"Phone\\\":null,\\\"Industry\\\":\\\"Education\\\",\\\"Create Date\\\":\\\"2020-08-13\\\",\\\"Email\\\":\\\"amagustinamarquez@gmail.com\\\"}\",\"async_record_id\":\"1\"}]', '{\"status\":\"success\",\"data\":{\"email_address\":\"palomanesd@gmail.com\",\"status\":\"valid\",\"verified_on\":\"2020-08-14T14:01:39.767Z\",\"time_taken\":1062,\"sub_status\":{\"code\":200,\"desc\":\"Success\"},\"detail_info\":{\"account\":\"palomanesd\",\"domain\":\"gmail.com\"},\"disposable\":\"no\",\"free\":\"no\",\"role\":\"no\",\"suggested_email_address\":\"\",\"profile\":\"\",\"score\":1,\"bounce_type\":\"\",\"safe_to_send\":\"yes\",\"deliverability_score\":100}}', '2020-10-14 21:43:23'),
(18, '1', 'Manual category changed to EDU category', '{\"category_id\":10}', 'Record persisted as EDU Category', '2020-10-14 21:43:23'),
(19, '1', 'Zapier EDU free email send campagin webhook call during manual category change', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-14 21:43:27'),
(20, '1', 'Manual category changed to Home category', '{\"category_id\":3}', 'Record persisted as Home Category', '2020-10-18 20:19:04'),
(21, '1', 'Zapier EDU category webhook API call during manual category change', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-18 20:20:15'),
(22, '1', 'Manual category changed to EDU category', '{\"category_id\":4}', 'Record persisted as EDU Category', '2020-10-18 20:20:15'),
(23, '1', 'Manual category changed to Home category', '{\"category_id\":3}', 'Record persisted as Home Category', '2020-10-18 20:21:04'),
(24, '1', 'Zapier EDU category webhook API call during manual category change', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-18 20:21:34'),
(25, '1', 'Manual category changed to EDU category', '{\"category_id\":4}', 'Record persisted as EDU Category', '2020-10-18 20:21:34'),
(26, '1', 'Zapier Probable business webhook call during manual category changed', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-18 20:22:22'),
(27, '1', 'Zapier Probable business webhook call during manual category changed', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-18 20:22:22'),
(28, '1', 'Zapier Probable business webhook call during manual category changed', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-18 20:22:23'),
(29, '1', 'Zapier Probable business webhook call during manual category changed', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-18 20:22:23'),
(30, '1', 'Zapier EDU category webhook API call during manual category change', '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 'false', '2020-10-18 20:22:48'),
(31, '1', 'Manual category changed to EDU category', '{\"category_id\":4}', 'Record persisted as EDU Category', '2020-10-18 20:22:48');

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
  `async_record_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id`, `date`, `country`, `email`, `telephone`, `category_id`, `brand_id`, `batch_id`, `original_row`, `async_record_id`) VALUES
(1, '2020-08-13', 11, 'amagustinamarquez@gmail.com', 'N/A', 4, 3, 1, '{\"First Name\":\"AGUSTINA\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"Rhino\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"STUDENT\",\"Phone\":null,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"amagustinamarquez@gmail.com\"}', 1),
(2, '2020-08-13', 11, 'alesiozunino3@gmail.com', '231715462610', 5, 3, 1, '{\"First Name\":\"alezio\",\"Tags\":\"CSV BRANDS\",\"commercialCampaign\":\"Commercial Cat\",\"eduCampaign\":\"Edu Cat\",\"homeCampaign\":\"Home cat\",\"Modeling Software\":\"CATIA\",\"Country\":\"Argentina\",\"Company \\/ Account\":\"magicalien\",\"Phone\":231715462610,\"Industry\":\"Education\",\"Create Date\":\"2020-08-13\",\"Email\":\"alesiozunino3@gmail.com\"}', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `research_task`
--

INSERT INTO `research_task` (`id`, `record_id`, `comment`) VALUES
(1, 2, 'Find telephone and complete CRM data'),
(2, 2, 'Probable business research task'),
(3, 2, 'Find telephone and complete CRM data'),
(4, 2, 'Find telephone and complete CRM data'),
(5, 1, 'Probable business research task'),
(6, 1, 'Probable business research task');

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
