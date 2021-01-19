-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2013 at 07:59 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `task_pad`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_modules`
--

DROP TABLE IF EXISTS `application_modules`;
CREATE TABLE IF NOT EXISTS `application_modules` (
  `App_Module_ID` int(11) NOT NULL AUTO_INCREMENT,
  `App_Module_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Comments` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Allow_Everyone` int(11) NOT NULL COMMENT '0=No, 1=Yes',
  PRIMARY KEY (`App_Module_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Zorkif Siama CMS Software Module Names used for Group Based ' AUTO_INCREMENT=27 ;

--
-- Dumping data for table `application_modules`
--

INSERT INTO `application_modules` (`App_Module_ID`, `App_Module_Name`, `Comments`, `Allow_Everyone`) VALUES
(1, 'User Management', 'This section of the Application has all user accou', 0),
(2, 'Web Management', 'This section of the Application deals with web page creation and menu builder for CMS based web site', 0),
(3, 'News and Testimonials', 'To manage dynamic addtion of news and testimonials to the web site', 0),
(4, 'Tickets System Administration', 'this section of the application helps the administrators to reply the tickes submitted by the users', 0),
(5, 'Tickets System User''s Panel', 'This section of the Application has ticket submission system for the web site user.', 1),
(6, 'Financial Management', 'This section of the Application deals with dynamic financial record management', 0),
(7, 'File Sharing', 'This section deals with users file shairing', 0),
(8, 'Extra Tools', 'This section of the application provides acces to extra tools that can enhance the web services on the web site. usually used by the administrator only', 0),
(9, 'Hotel Management System', 'Hotel or Places Management System', 0),
(10, 'ERP Configuration Setup', 'The Main Configuration Area for Setting Up ERP Application such as Defineing Capital Account, Cutomser''s List, Supilers list etc.', 0),
(11, 'Purchase Order and Proforma Invoices', 'Define Purchase Orders , supplier details, proforma Invoices etc.', 0),
(12, 'Salesman Order', 'Salesman Order for Customers, Adding his own customers, etc.', 0),
(13, 'Sales Order Processing', 'This unit of the business will process the orders put by sales man, and will prepare invoices, deliver order etc.', 0),
(14, 'Inventory System', 'This unit of the software will maintain the Stock Levels of the products produced in the factory and avalaible for sale.', 0),
(15, 'Accounting System', 'This unit of the software will perform all the basic accountings for the business owners.', 0),
(16, ' Delivery Order Form', 'This unit of the software will handle the delivery order and wearhouse etc.', 0),
(17, 'Production Unit', 'This Module of the software will keep track of the productions related records.', 0),
(18, 'Wearhouse (Delivery Order Form)', 'This Module of the software will keep track of the delivery of inventory stock items to the customers.', 0),
(19, 'Reports', 'This section will have access to the Reports of the Zorkif ERP', 0),
(20, 'Enterprise Messaging System', 'This modules will send and recieve message between different uses/groups of the enterprises.', 1),
(21, 'Task Management', 'User can Manage Different Task and notes on them', 1),
(22, 'Shipment Tracking', 'This module is used to track the ship of Orders', 0),
(23, 'Employee MIS', 'Employee Biodata and sallary', 0),
(24, 'Job Employer Panel', 'This module will be used by the Employers to announce their jobs', 0),
(25, 'Job Seeker Panel', 'This module will be used by the Job Seekers to search for jobs', 0),
(26, 'Membership Registrations', 'Users Getting Registered on the Web Site', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_informaiton`
--

DROP TABLE IF EXISTS `company_informaiton`;
CREATE TABLE IF NOT EXISTS `company_informaiton` (
  `CompanyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `AddressLine1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `AddressLine2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `City` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `WebSite` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ContactPerson` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CompanyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_informaiton`
--

INSERT INTO `company_informaiton` (`CompanyID`, `CompanyName`, `AddressLine1`, `AddressLine2`, `City`, `Country`, `Phone`, `Email`, `WebSite`, `ContactPerson`) VALUES
(1, 'Zorkif Technology Center', 'Office 104 Rafay''s Heights Plaza', 'Abdara Road, University Town', 'Peshawar', 'Pakistan', '+92 333 92 85 904', 'kifayat@zorkif.com', 'http://www.zorkif.com', 'Kifayat Ullah');

-- --------------------------------------------------------

--
-- Table structure for table `country_names`
--

DROP TABLE IF EXISTS `country_names`;
CREATE TABLE IF NOT EXISTS `country_names` (
  `CountryID` int(11) NOT NULL AUTO_INCREMENT,
  `CountryName` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CountryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=248 ;

--
-- Dumping data for table `country_names`
--

INSERT INTO `country_names` (`CountryID`, `CountryName`) VALUES
(1, 'Pakistan'),
(2, 'Afghanistan (افغانستان)'),
(3, 'Aland Islands'),
(4, 'Albania (Shqipëria)'),
(5, 'Algeria (الجزائر)'),
(6, 'American Samoa'),
(7, 'Andorra'),
(8, 'Angola'),
(9, 'Anguilla'),
(10, 'Antarctica'),
(11, 'Antigua and Barbuda'),
(12, 'Argentina'),
(13, 'Armenia (Հայաստան)'),
(14, 'Aruba'),
(15, 'Australia'),
(16, 'Austria (Österreich)'),
(17, 'Azerbaijan (Azərbaycan)'),
(18, 'Bahamas'),
(19, 'Bahrain (البحرين)'),
(20, 'Bangladesh (বাংলাদেশ)'),
(21, 'Barbados'),
(22, 'Belarus (Белару́сь)'),
(23, 'Belgium (België)'),
(24, 'Belize'),
(25, 'Benin (Bénin)'),
(26, 'Bermuda'),
(27, 'Bhutan (འབྲུག་ཡུལ)'),
(28, 'Bolivia'),
(29, 'Bosnia and Herzegovina (Bosna i Hercegovina)'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil (Brasil)'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei (Brunei Darussalam)'),
(35, 'Bulgaria (България)'),
(36, 'Burkina Faso'),
(37, 'Burundi (Uburundi)'),
(38, 'Cambodia (Kampuchea)'),
(39, 'Cameroon (Cameroun)'),
(40, 'Canada'),
(41, 'Cape Verde (Cabo Verde)'),
(42, 'Cayman Islands'),
(43, 'Central African Republic (République Centrafricaine)'),
(44, 'Chad (Tchad)'),
(45, 'Chile'),
(46, 'China (中国)'),
(47, 'Christmas Island'),
(48, 'Cocos Islands'),
(49, 'Colombia'),
(50, 'Comoros (Comores)'),
(51, 'Congo'),
(52, 'Congo, Democratic Republic of the'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Côte d&#39;Ivoire'),
(56, 'Croatia (Hrvatska)'),
(57, 'Cuba'),
(58, 'Cyprus (Κυπρος)'),
(59, 'Czech Republic (Česko)'),
(60, 'Denmark (Danmark)'),
(61, 'Djibouti'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(64, 'Ecuador'),
(65, 'Egypt (مصر)'),
(66, 'El Salvador'),
(67, 'Equatorial Guinea (Guinea Ecuatorial)'),
(68, 'Eritrea (Ertra)'),
(69, 'Estonia (Eesti)'),
(70, 'Ethiopia (Ityop&#39;iya)'),
(71, 'Falkland Islands'),
(72, 'Faroe Islands'),
(73, 'Fiji'),
(74, 'Finland (Suomi)'),
(75, 'France'),
(76, 'French Guiana'),
(77, 'French Polynesia'),
(78, 'French Southern Territories'),
(79, 'Gabon'),
(80, 'Gambia'),
(81, 'Georgia (საქართველო)'),
(82, 'Germany (Deutschland)'),
(83, 'Ghana'),
(84, 'Gibraltar'),
(85, 'Greece (Ελλάς)'),
(86, 'Greenland'),
(87, 'Grenada'),
(88, 'Guadeloupe'),
(89, 'Guam'),
(90, 'Guatemala'),
(91, 'Guernsey'),
(92, 'Guinea (Guinée)'),
(93, 'Guinea-Bissau (Guiné-Bissau)'),
(94, 'Guyana'),
(95, 'Haiti (Haïti)'),
(96, 'Heard Island and McDonald Islands'),
(97, 'Honduras'),
(98, 'Hong Kong'),
(99, 'Hungary (Magyarország)'),
(100, 'Iceland (Ísland)'),
(101, 'India'),
(102, 'Indonesia'),
(103, 'Iran (ایران)'),
(104, 'Iraq (العراق)'),
(105, 'Ireland'),
(106, 'Isle of Man'),
(107, 'Israel (ישראל)'),
(108, 'Italy (Italia)'),
(109, 'Jamaica'),
(110, 'Japan (日本)'),
(111, 'Jersey'),
(112, 'Jordan (الاردن)'),
(113, 'Kazakhstan (Қазақстан)'),
(114, 'Kenya'),
(115, 'Kiribati'),
(116, 'Kuwait (الكويت)'),
(117, 'Kyrgyzstan (Кыргызстан)'),
(118, 'Laos (ນລາວ)'),
(119, 'Latvia (Latvija)'),
(120, 'Lebanon (لبنان)'),
(121, 'Lesotho'),
(122, 'Liberia'),
(123, 'Libya (ليبيا)'),
(124, 'Liechtenstein'),
(125, 'Lithuania (Lietuva)'),
(126, 'Luxembourg (Lëtzebuerg)'),
(127, 'Macao'),
(128, 'Macedonia (Македонија)'),
(129, 'Madagascar (Madagasikara)'),
(130, 'Malawi'),
(131, 'Malaysia'),
(132, 'Maldives (ގުޖޭއްރާ ޔާއްރިހޫމްޖ)'),
(133, 'Mali'),
(134, 'Malta'),
(135, 'Marshall Islands'),
(136, 'Martinique'),
(137, 'Mauritania (موريتانيا)'),
(138, 'Mauritius'),
(139, 'Mayotte'),
(140, 'Mexico (México)'),
(141, 'Micronesia'),
(142, 'Moldova'),
(143, 'Monaco'),
(144, 'Mongolia (Монгол Улс)'),
(145, 'Montenegro (Црна Гора)'),
(146, 'Montserrat'),
(147, 'Morocco (المغرب)'),
(148, 'Mozambique (Moçambique)'),
(149, 'Myanmar (Burma)'),
(150, 'Namibia'),
(151, 'Nauru (Naoero)'),
(152, 'Nepal (नेपाल)'),
(153, 'Netherlands (Nederland)'),
(154, 'Netherlands Antilles'),
(155, 'New Caledonia'),
(156, 'New Zealand'),
(157, 'Nicaragua'),
(158, 'Niger'),
(159, 'Nigeria'),
(160, 'Niue'),
(161, 'Norfolk Island'),
(162, 'Northern Mariana Islands'),
(163, 'North Korea (조선)'),
(164, 'Norway (Norge)'),
(165, 'Oman (عمان)'),
(166, 'Pakistan (پاکستان)'),
(167, 'Palau (Belau)'),
(168, 'Palestinian Territories'),
(169, 'Panama (Panamá)'),
(170, 'Papua New Guinea'),
(171, 'Paraguay'),
(172, 'Peru (Perú)'),
(173, 'Philippines (Pilipinas)'),
(174, 'Pitcairn'),
(175, 'Poland (Polska)'),
(176, 'Portugal'),
(177, 'Puerto Rico'),
(178, 'Qatar (قطر)'),
(179, 'Reunion'),
(180, 'Romania (România)'),
(181, 'Russia (Россия)'),
(182, 'Rwanda'),
(183, 'Saint Helena'),
(184, 'Saint Kitts and Nevis'),
(185, 'Saint Lucia'),
(186, 'Saint Pierre and Miquelon'),
(187, 'Saint Vincent and the Grenadines'),
(188, 'Samoa'),
(189, 'San Marino'),
(190, 'São Tomé and Príncipe'),
(191, 'Saudi Arabia (المملكة العربية السعودية)'),
(192, 'Senegal (Sénégal)'),
(193, 'Serbia (Србија)'),
(194, 'Serbia and Montenegro (Србија и Црна Гора)'),
(195, 'Seychelles'),
(196, 'Sierra Leone'),
(197, 'Singapore (Singapura)'),
(198, 'Slovakia (Slovensko)'),
(199, 'Slovenia (Slovenija)'),
(200, 'Solomon Islands'),
(201, 'Somalia (Soomaaliya)'),
(202, 'South Africa'),
(203, 'South Georgia and the South Sandwich Islands'),
(204, 'South Korea (한국)'),
(205, 'Spain (España)'),
(206, 'Sri Lanka'),
(207, 'Sudan (السودان)'),
(208, 'Suriname'),
(209, 'Svalbard and Jan Mayen'),
(210, 'Swaziland'),
(211, 'Sweden (Sverige)'),
(212, 'Switzerland (Schweiz)'),
(213, 'Syria (سوريا)'),
(214, 'Taiwan (台灣)'),
(215, 'Tajikistan (Тоҷикистон)'),
(216, 'Tanzania'),
(217, 'Thailand (ราชอาณาจักรไทย)'),
(218, 'Timor-Leste'),
(219, 'Togo'),
(220, 'Tokelau'),
(221, 'Tonga'),
(222, 'Trinidad and Tobago'),
(223, 'Tunisia (تونس)'),
(224, 'Turkey (Türkiye)'),
(225, 'Turkmenistan (Türkmenistan)'),
(226, 'Turks and Caicos Islands'),
(227, 'Tuvalu'),
(228, 'Uganda'),
(229, 'Ukraine (Україна)'),
(230, 'United Arab Emirates (الإمارات العربيّة المتّحدة)'),
(231, 'United Kingdom'),
(232, 'United States'),
(233, 'United States minor outlying islands'),
(234, 'Uruguay'),
(235, 'Uzbekistan (O&#39;zbekiston)'),
(236, 'Vanuatu'),
(237, 'Vatican City (Città del Vaticano)'),
(238, 'Venezuela'),
(239, 'Vietnam (Việt Nam)'),
(240, 'Virgin Islands, British'),
(241, 'Virgin Islands, U.S.'),
(242, 'Wallis and Futuna'),
(243, 'Western Sahara (الصحراء الغربية)'),
(244, 'Yemen (اليمن)'),
(245, 'Zambia'),
(246, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `erp_taskmanagement`
--

DROP TABLE IF EXISTS `erp_taskmanagement`;
CREATE TABLE IF NOT EXISTS `erp_taskmanagement` (
  `Task_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Task_Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Task_Title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Task_Periority` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Task_Status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Task_Completion` int(11) NOT NULL COMMENT 'Task Completion Percentage',
  `Task_Description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Task_Start_Date` date NOT NULL,
  `Task_Due_Date` date NOT NULL DEFAULT '0000-00-00',
  `Task_Complete_Date` date DEFAULT '0000-00-00',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`Task_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `erp_taskmanagement`
--

INSERT INTO `erp_taskmanagement` (`Task_ID`, `Task_Username`, `Task_Title`, `Task_Periority`, `Task_Status`, `Task_Completion`, `Task_Description`, `Task_Start_Date`, `Task_Due_Date`, `Task_Complete_Date`, `CreatedAt`, `UpdatedAt`) VALUES
(10, 'Agent A', 'Prepare Data Entry Form1', 'Normal', 'Not Started', 7, 'We need to finisih this job as soon as possible.', '2012-12-26', '2012-12-26', '0000-00-00', '2012-12-26 10:03:32', NULL),
(12, 'administrator', 'sadfsada', 'High', 'Waiting on someone else', 0, 'asdasdsd', '2012-12-26', '2012-12-26', NULL, '2012-12-26 10:07:50', NULL),
(13, 'administrator', 'Welcome to ترحيب', 'High', 'Completed', 100, 'ترحيب', '2012-12-26', '2012-12-26', '2012-12-30', '2012-12-26 10:51:18', NULL),
(14, 'Agent A', 'مرحبا بكم في نظام إدارة المهام', 'High', 'Not Started', 0, 'مرحبا بكم في نظام إدارة المهام', '2012-12-26', '2012-12-26', '0000-00-00', '2012-12-26 10:56:00', NULL),
(15, 'administrator', 'مرحبا بكم في نظام إدارة المهام', 'High', 'Deferred', 94, 'مرحبا بكم في نظام إدارة المهام', '2012-12-26', '2012-12-26', '2012-12-30', '2012-12-26 10:56:09', NULL),
(17, 'Agent A', 'This is Gnagam style', ' High', 'In Progress', 0, 'zdx', '2012-12-29', '2012-12-29', NULL, '2012-12-29 06:31:29', NULL),
(18, 'Agent A', 'This is Gnagam style', 'High', 'Not Started', 0, 'zdx', '2012-12-29', '2012-12-29', '0000-00-00', '2012-12-29 07:28:31', NULL),
(19, 'Agent A', 'rfrefrfrfr', 'High', 'Not Started', 0, 'ddddd', '2012-12-29', '2012-12-29', '0000-00-00', '2012-12-29 07:35:38', NULL),
(20, 'Agent B', 'test', 'Low', 'Not Started', 0, 'please do this', '2012-12-30', '2012-12-30', '0000-00-00', '2012-12-30 09:31:18', NULL),
(21, 'administrator', 'ggf', 'Normal', 'Completed', 100, 'wedweedwewdedewdwe', '2012-12-30', '2012-12-30', '2012-12-30', '2012-12-30 09:51:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `erp_taskmanagement_notes`
--

DROP TABLE IF EXISTS `erp_taskmanagement_notes`;
CREATE TABLE IF NOT EXISTS `erp_taskmanagement_notes` (
  `TNID` int(11) NOT NULL AUTO_INCREMENT,
  `Task_ID` int(11) NOT NULL,
  `Task_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Task_Notice` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`TNID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Notes on the Tasks' AUTO_INCREMENT=16 ;

--
-- Dumping data for table `erp_taskmanagement_notes`
--

INSERT INTO `erp_taskmanagement_notes` (`TNID`, `Task_ID`, `Task_Date`, `Task_Notice`) VALUES
(6, 8, '2011-08-07 07:00:00', 'test'),
(5, 8, '2011-08-07 20:25:09', '  Nice work...      \r\n            '),
(8, 8, '2011-08-07 07:00:00', 'Approximately my work is completed...'),
(9, 15, '2012-12-25 21:00:00', '  werwer      \r\n            '),
(10, 15, '2012-12-25 21:00:00', 'werwerwer'),
(11, 15, '2012-12-25 21:00:00', '  werwerewr    fsdfdsdfsdsfsd  \r\n            '),
(12, 14, '2012-12-25 21:00:00', 'we'),
(13, 14, '2012-12-25 21:00:00', 'awersdfbgsdfnfshdfsdfsfs'),
(14, 15, '2012-12-29 21:00:00', 'tesedfsd'),
(15, 15, '2012-12-29 21:00:00', 'sdfsdfds');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `NewsID` bigint(20) NOT NULL AUTO_INCREMENT,
  `NewsTitle` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `NewsText` text COLLATE utf8_unicode_ci NOT NULL,
  `Dated` date NOT NULL,
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Language` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  PRIMARY KEY (`NewsID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NewsID`, `NewsTitle`, `NewsText`, `Dated`, `Username`, `Language`) VALUES
(21, 'Welcome to Zorkif Taskpad', 'Zorkif Taskpad is a simple to use application to keep tack of who is doing what in your organization.', '2012-05-29', 'administrator', 'en'),
(22, 'Welcome to Zorkif Taskpad', 'Zorkif Taskpad is a simple to use application to keep tack of who is doing what in your organization.', '2012-12-26', 'administrator', 'ar');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

DROP TABLE IF EXISTS `user_accounts`;
CREATE TABLE IF NOT EXISTS `user_accounts` (
  `UserID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `FullName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AddressLine1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddressLine2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ContactNo` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User''s Contact Phone or Mobile Numbers',
  `Others` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Picture` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Path of the Picture Upladed by User to his Profile',
  `GroupID` int(10) unsigned DEFAULT NULL,
  `AccountStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1= Enable  0=Disable',
  `LastLoginIP` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Users, Last Login IP',
  PRIMARY KEY (`Username`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='UserAccounts' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`UserID`, `Username`, `Password`, `FullName`, `AddressLine1`, `AddressLine2`, `City`, `Country`, `Phone`, `Email`, `ContactNo`, `Others`, `Picture`, `GroupID`, `AccountStatus`, `LastLoginIP`) VALUES
(1, 'administrator', '123', 'Administrator', 'System', 'System', 'System', 'System', 'System', 'kifayat@zorkif.com', '+966545883076', 'Zorkif Technology Center', 'none.jpg', 1, 1, NULL),
(2, 'Agent A', '123', 'Agent A', 'Agent A', 'Agent A', 'Agent A', 'Agent A', 'Agent A', 'Agent A', 'Agent A', 'Agent A', 'Agent A', 2, 1, NULL),
(3, 'Agent B', '123', 'Agent B', 'Agent B', 'Agent B', 'Riyadh', 'Saudi Arabia', 'Agent B', 'Agent B', 'Agent B', 'N/A', NULL, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `GroupID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GroupDescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Groups' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`GroupID`, `GroupName`, `GroupDescription`) VALUES
(1, 'Administrators', 'The is a super group in this application.\r\n'),
(2, 'Employees', 'Employees of the Company');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups_accessrights`
--

DROP TABLE IF EXISTS `user_groups_accessrights`;
CREATE TABLE IF NOT EXISTS `user_groups_accessrights` (
  `user_groups_accessrights_ID` int(11) NOT NULL AUTO_INCREMENT,
  `App_Module_ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  PRIMARY KEY (`user_groups_accessrights_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `user_groups_accessrights`
--

INSERT INTO `user_groups_accessrights` (`user_groups_accessrights_ID`, `App_Module_ID`, `GroupID`) VALUES
(76, 21, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
