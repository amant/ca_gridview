-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2011 at 06:09 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `datagrid`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_3_code` varchar(3) NOT NULL,
  `country_2_code` varchar(3) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=227 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `region_id`, `country_name`, `country_3_code`, `country_2_code`) VALUES
(1, 7, 'Afganistan', '', 'AF'),
(2, 1, 'Albania', '', 'AL'),
(3, 1, 'Algeria', '', 'DZ'),
(4, 1, 'American Samoa', '', 'AS'),
(5, 1, 'Andorra', '', 'AD'),
(6, 1, 'Angola', '', 'AO'),
(7, 1, 'Anguilla', '', 'AI'),
(8, 1, 'Antigua', '', 'AG'),
(9, 1, 'Argentina', '', 'AR'),
(10, 1, 'Armenia', '', 'AM'),
(11, 1, 'Aruba', '', 'AW'),
(12, 1, 'Australia', '', 'AU'),
(13, 1, 'Austria', '', 'AT'),
(14, 1, 'Azerbaijan', '', 'AZ'),
(15, 1, 'Bahamas', '', 'BS'),
(16, 1, 'Bahrain', '', 'BH'),
(17, 1, 'Bangladesh', '', 'BD'),
(18, 1, 'Barbados', '', 'BB'),
(19, 1, 'Belarus', '', 'BY'),
(20, 1, 'Belgium', '', 'BE'),
(21, 1, 'Belize', '', 'BZ'),
(22, 1, 'Benin', '', 'BJ'),
(23, 1, 'Bermuda', '', 'BM'),
(24, 1, 'Bhutan', '', 'BT'),
(25, 1, 'Bolivia', '', 'BO'),
(26, 1, 'Bonaire', '', 'AN'),
(27, 1, 'Bosnia and Herzegovina', '', 'BA'),
(28, 1, 'Botswana', '', 'BW'),
(29, 1, 'Brazil', '', 'BR'),
(30, 1, 'Brunei Darussalam', '', 'BN'),
(31, 1, 'Bulgaria', '', 'BG'),
(32, 1, 'Burkina Faso', '', 'BF'),
(33, 1, 'Burundi', '', 'BI'),
(34, 1, 'Cambodia', '', 'KH'),
(35, 1, 'Cameroon', '', 'CM'),
(36, 1, 'Canada', '', 'CA'),
(38, 1, 'Cape Verde', '', 'CV'),
(39, 1, 'Cayman Islands', '', 'KY'),
(40, 1, 'Central African Republic', '', 'CF'),
(41, 1, 'Chad', '', 'TD'),
(42, 1, 'Chile', '', 'CL'),
(43, 1, 'China', '', 'CN'),
(44, 1, 'Colombia', '', 'CO'),
(45, 1, 'Comoros', '', 'KM'),
(47, 1, 'Congo, The Democratic Republic of', '', 'CD'),
(48, 1, 'Cook Islands', '', 'CK'),
(49, 1, 'Costa Rica', '', 'CR'),
(50, 1, 'CÃƒÂ´te d''Ivoire', '', 'CI'),
(51, 1, 'Croatia', '', 'HR'),
(52, 1, 'Cuba', '', 'CU'),
(54, 1, 'Cyprus', '', 'CY'),
(55, 1, 'Czech Republic', '', 'CZ'),
(56, 1, 'Denmark', '', 'DK'),
(57, 1, 'Djibouti', '', 'DJ'),
(58, 1, 'Dominica', '', 'DM'),
(59, 1, 'Dominican Republic', '', 'DO'),
(60, 1, 'East Timor', '', 'TP'),
(61, 1, 'Ecuador', '', 'EC'),
(62, 1, 'Egypt', '', 'EG'),
(63, 1, 'El Salvador', '', 'SV'),
(64, 1, 'Equatorial Guinea', '', 'GQ'),
(65, 1, 'Eritrea', '', 'ER'),
(66, 1, 'Estonia', '', 'EE'),
(67, 1, 'Ethiopia', '', 'ET'),
(68, 1, 'Falkland Islands', '', 'FK'),
(69, 1, 'Faroe Islands', '', 'FO'),
(70, 1, 'Fiji', '', 'FJ'),
(71, 1, 'Finland', '', 'FI'),
(72, 1, 'France', '', 'FR'),
(73, 1, 'French Guiana', '', 'GF'),
(74, 1, 'Gabon', '', 'GA'),
(75, 1, 'Gambia', '', 'GM'),
(76, 1, 'Georgia', '', 'GE'),
(77, 1, 'Germany', '', 'DE'),
(78, 1, 'Ghana', '', 'GH'),
(79, 1, 'Gibraltar', '', 'GI'),
(80, 1, 'Greece', '', 'GR'),
(81, 1, 'Greenland', '', 'GL'),
(82, 1, 'Grenada', '', 'GD'),
(83, 1, 'Guadeloupe', '', 'GP'),
(84, 1, 'Guam', '', 'GU'),
(85, 1, 'Guatemala', '', 'GT'),
(86, 1, 'Guernsey', '', 'GG'),
(87, 1, 'Guinea Republic', '', 'GN'),
(88, 1, 'Guinea-Bissau', '', 'GW'),
(90, 1, 'Haiti', '', 'HT'),
(91, 1, 'Honduras', '', 'HN'),
(92, 1, 'Hong Kong', '', 'HK'),
(93, 1, 'Hungary', '', 'HU'),
(94, 1, 'Iceland', '', 'IS'),
(95, 1, 'India', '', 'IN'),
(96, 1, 'Indonesia', '', 'ID'),
(97, 1, 'Iran, Islamic Republic of', '', 'IR'),
(98, 1, 'Iraq', '', 'IQ'),
(99, 1, 'Ireland, Republic of', '', 'IE'),
(100, 1, 'Israel', '', 'IL'),
(101, 1, 'Italy', '', 'IT'),
(102, 1, 'Jamaica', '', 'JM'),
(103, 1, 'Japan', '', 'JP'),
(104, 1, 'Jersey', '', 'JE'),
(105, 1, 'Jordan', '', 'JO'),
(106, 1, 'Kazakhstan', '', 'KZ'),
(107, 1, 'Kenya', '', 'KE'),
(108, 1, 'Kiribati', '', 'KI'),
(109, 1, 'Korea, North', '', 'KP'),
(110, 1, 'Korea, South', '', 'KR'),
(111, 1, 'Kuwait', '', 'KW'),
(112, 1, 'Kyrgyzstan', '', 'KG'),
(113, 1, 'Lao People''s Democratic Republic', '', 'LA'),
(114, 1, 'Latvia', '', 'LV'),
(115, 1, 'Lebanon', '', 'LB'),
(116, 1, 'Lesotho', '', 'LS'),
(117, 1, 'Liberia', '', 'LR'),
(118, 1, 'Libya', '', 'LY'),
(119, 1, 'Liechtenstein', '', 'LI'),
(120, 1, 'Lithuania', '', 'LT'),
(121, 1, 'Luxembourg', '', 'LU'),
(122, 1, 'Macau', '', 'MO'),
(123, 1, 'Macedonia, Republic of', '', 'MK'),
(124, 1, 'Madagascar', '', 'MG'),
(125, 1, 'Malawi', '', 'MW'),
(126, 1, 'Malaysia', '', 'MY'),
(127, 1, 'Maldives', '', 'MV'),
(128, 1, 'Mali', '', 'ML'),
(129, 1, 'Malta', '', 'MT'),
(130, 1, 'Marshall Islands', '', 'MH'),
(131, 1, 'Martinique', '', 'MQ'),
(132, 1, 'Mauritania', '', 'MR'),
(133, 1, 'Mauritius', '', 'MU'),
(134, 1, 'Mexico', '', 'MX'),
(135, 1, 'Moldova, Republic of', '', 'MD'),
(136, 1, 'Monaco', '', 'MC'),
(137, 1, 'Mongolia', '', 'MN'),
(138, 1, 'Montserrat', '', 'MS'),
(139, 1, 'Morocco', '', 'MA'),
(140, 1, 'Mozambique', '', 'MZ'),
(141, 1, 'Myanmar', '', 'MM'),
(142, 1, 'Namibia', '', 'NA'),
(143, 1, 'Nauru, Republic of', '', 'NR'),
(144, 1, 'Netherlands, The', '', 'NL'),
(145, 1, 'Nevis', '', 'KN'),
(146, 1, 'New Caledonia', '', 'NC'),
(147, 1, 'New Zealand', '', 'NZ'),
(148, 1, 'Nicaragua', '', 'NI'),
(149, 1, 'Niger', '', 'NE'),
(150, 1, 'Nigeria', '', 'NG'),
(151, 1, 'Niue', '', 'NU'),
(152, 1, 'Norway', '', 'NO'),
(153, 1, 'Oman', '', 'OM'),
(154, 1, 'Pakistan', '', 'PK'),
(155, 1, 'Panama', '', 'PA'),
(156, 1, 'Papua New Guinea', '', 'PG'),
(157, 1, 'Paraguay', '', 'PY'),
(158, 1, 'Peru', '', 'PE'),
(159, 1, 'Philippines, The', '', 'PH'),
(160, 1, 'Poland', '', 'PL'),
(161, 1, 'Portugal', '', 'PT'),
(162, 1, 'Puerto Rico', '', 'PR'),
(163, 1, 'Qatar', '', 'QA'),
(165, 1, 'Romania', '', 'RO'),
(166, 1, 'Russain Federation, The', '', 'RU'),
(167, 1, 'Rwanda', '', 'RW'),
(169, 1, 'Samoa', '', 'WS'),
(170, 1, 'Sao Tome and Principe', '', 'ST'),
(171, 1, 'Saudi Arabia', '', 'SA'),
(172, 1, 'Senegal', '', 'SN'),
(173, 1, 'Seychelles', '', 'SC'),
(174, 1, 'Sierra Leone', '', 'SL'),
(175, 1, 'Singapore', '', 'SG'),
(176, 1, 'Slovakia', '', 'SK'),
(178, 1, 'Solomon Islands', '', 'SB'),
(179, 1, 'Somalia', '', 'SO'),
(181, 1, 'South Africa', '', 'ZA'),
(182, 1, 'Spain', '', 'ES'),
(183, 1, 'Sri Lanka', '', 'LK'),
(184, 1, 'St. Barthelemy', '', 'BL'),
(187, 1, 'St. Lucia', '', 'LC'),
(189, 1, 'St. Vincent', '', 'VC'),
(190, 1, 'Sudan', '', 'SD'),
(191, 1, 'Suriname', '', 'SR'),
(192, 1, 'Swaziland', '', 'SZ'),
(193, 1, 'Sweden', '', 'SE'),
(194, 1, 'Switzerland', '', 'CH'),
(195, 1, 'Syria', '', 'SY'),
(197, 1, 'Taiwan', '', 'TW'),
(198, 1, 'Tajikistan', '', 'TJ'),
(199, 1, 'Tanzania', '', 'TZ'),
(200, 1, 'Thailand', '', 'TH'),
(201, 1, 'Togo', '', 'TG'),
(202, 1, 'Tonga', '', 'TO'),
(203, 1, 'Trinidad and Tobago', '', 'TT'),
(204, 1, 'Tunisia', '', 'TN'),
(205, 1, 'Turkey', '', 'TR'),
(206, 1, 'Turkmenistan', '', 'TM'),
(207, 1, 'Turks and Caicos Islands', '', 'TC'),
(208, 1, 'Tuvalu', '', 'TV'),
(209, 1, 'Uganda', '', 'UG'),
(210, 1, 'Ukraine', '', 'UA'),
(211, 1, 'United Arab Emirates', '', 'AE'),
(212, 1, 'United Kingdom', '', 'UK'),
(213, 1, 'United States of America', '', 'US'),
(214, 1, 'Uruguay', '', 'UY'),
(215, 1, 'Uzbekistan', '', 'UZ'),
(216, 1, 'Vanuatu', '', 'VU'),
(217, 1, 'Venezuela', '', 'VE'),
(218, 1, 'Vietnam', '', 'VN'),
(219, 1, 'Virgin Islands (British)', '', 'VG'),
(220, 1, 'Virgin Islands (US)', '', 'VI'),
(221, 1, 'Yemen', '', 'YE'),
(222, 1, 'Yugoslavia', '', 'YU'),
(223, 1, 'Zambia', '', 'ZM'),
(224, 1, 'Zimbabwe', '', 'ZW'),
(226, 1, 'Nepal', '', 'NP');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `name`) VALUES
(1, 'Asia'),
(2, 'Europe'),
(3, 'North America'),
(4, 'South America'),
(5, 'Africa'),
(6, 'Australia'),
(7, 'Antratic');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
