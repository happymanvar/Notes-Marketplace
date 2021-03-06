-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 01:51 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes-marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CountryCode` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `Name`, `CountryCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Australia', 'AU', '2021-03-04 17:57:25', 1, '2021-03-04 17:57:25', 1, b'1'),
(2, 'Bangladesh', 'BD', '2021-03-04 17:57:25', 1, '2021-03-04 17:57:25', 1, b'1'),
(3, 'Canada', 'CA', '2021-03-04 17:58:07', 1, '2021-03-04 17:58:07', 1, b'1'),
(4, 'China', 'CN', '2021-03-04 17:58:07', 1, '2021-03-04 17:58:07', 1, b'1'),
(5, 'Denmark', 'DK', '2021-03-04 17:58:47', 1, '2021-03-04 17:58:47', 1, b'1'),
(6, 'Egypt', 'EG', '2021-03-04 17:58:47', 1, '2021-03-04 17:58:47', 1, b'1'),
(7, 'France', 'FR', '2021-03-04 17:59:22', 1, '2021-03-04 17:59:22', 1, b'1'),
(8, 'Germany', 'DE', '2021-03-04 17:59:22', 1, '2021-03-04 17:59:22', 1, b'1'),
(9, 'India', 'IN', '2021-03-04 17:59:59', 1, '2021-03-04 17:59:59', 1, b'1'),
(10, 'Japan', 'JP', '2021-03-04 17:59:59', 1, '2021-03-04 17:59:59', 1, b'1'),
(11, 'United Kingdom', 'GB', '2021-03-04 18:00:45', 1, '2021-03-04 18:00:45', 1, b'1'),
(12, 'United States', 'US', '2021-03-04 18:00:45', 1, '2021-03-04 18:00:45', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `Seller` int(11) NOT NULL,
  `Downloader` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL,
  `AtachmentPath` varchar(255) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` bit(64) NOT NULL,
  `PurchasedPrice` decimal(10,2) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notecategories`
--

CREATE TABLE `notecategories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notecategories`
--

INSERT INTO `notecategories` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Computer science', 'It gives knowledge about computer science.', '2021-03-04 18:04:22', 1, '2021-03-04 18:04:22', 1, b'1'),
(2, 'IT', 'It gives knowledge about IT.', '2021-03-04 18:04:22', 1, '2021-03-04 18:04:22', 1, b'1'),
(3, 'Politics', 'It gives knowledge about politics.', '2021-03-04 18:05:06', 1, '2021-03-04 18:05:06', 1, b'1'),
(4, 'Sports', 'It gives knowledge about sports.', '2021-03-04 18:05:06', 1, '2021-03-04 18:05:06', 1, b'1'),
(5, 'Cooking', 'It gives knowledge about cooking.', '2021-03-04 18:07:04', 1, '2021-03-04 18:07:04', 1, b'1'),
(6, 'History', 'It gives knowledge about history.', '2021-03-04 18:07:04', 1, '2021-03-04 18:07:04', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notetypes`
--

CREATE TABLE `notetypes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notetypes`
--

INSERT INTO `notetypes` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Handwritten notes', 'handwritten note by seller', '2021-03-04 18:13:58', 1, '2021-03-04 18:13:58', 1, b'1'),
(2, 'University notes', 'seller\'s university notes', '2021-03-04 18:13:58', 1, '2021-03-04 18:13:58', 1, b'1'),
(3, 'Novels', 'great novels', '2021-03-04 18:15:42', 1, '2021-03-04 18:15:42', 1, b'1'),
(4, 'Story books', 'interesting story books.', '2021-03-04 18:15:42', 1, '2021-03-04 18:15:42', 1, b'1'),
(5, 'Biography', 'Biographies of legends.', '2021-03-04 18:17:19', 1, '2021-03-04 18:17:19', 1, b'1'),
(6, 'Poetry books', 'awesome books of poetry', '2021-03-04 18:17:19', 1, '2021-03-04 18:17:19', 1, b'1'),
(7, 'Books in a series', 'Books in series are wonderfull.', '2021-03-04 18:18:09', 1, '2021-03-04 18:18:09', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `ID` int(11) NOT NULL,
  `Value` varchar(100) NOT NULL,
  `Datavalue` varchar(100) NOT NULL,
  `RefCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referencedata`
--

INSERT INTO `referencedata` (`ID`, `Value`, `Datavalue`, `RefCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Male', 'M', 'Gender', '2021-03-04 18:20:13', 1, '2021-03-04 18:20:13', 1, b'1'),
(2, 'Female', 'Fe', 'Gender', '2021-03-04 18:20:13', 1, '2021-03-04 18:20:13', 1, b'1'),
(3, 'Unknown', 'U', 'Gender', '2021-03-04 18:21:02', 1, '2021-03-04 18:21:02', 1, b'0'),
(4, 'Paid', 'P', 'Selling Mode', '2021-03-04 18:21:02', 1, '2021-03-04 18:21:02', 1, b'1'),
(5, 'Free', 'F', 'Selling Mode', '2021-03-04 18:22:03', 1, '2021-03-04 18:22:03', 1, b'1'),
(6, 'Draft', 'Draft', 'Notes Status', '2021-03-04 18:22:03', 1, '2021-03-04 18:22:03', 1, b'1'),
(7, 'Submit For Review', 'Submit For Review', 'Notes Status', '2021-03-04 18:22:50', 1, '2021-03-04 18:22:50', 1, b'1'),
(8, 'In Review', 'In Review', 'Notes Status', '2021-03-04 18:22:50', 1, '2021-03-04 18:22:50', 1, b'1'),
(9, 'Published', 'Approved', 'Notes Status', '2021-03-04 18:23:38', 1, '2021-03-04 18:23:38', 1, b'1'),
(10, 'Rejected', 'Rejected', 'Notes Status', '2021-03-04 18:23:38', 1, '2021-03-04 18:23:38', 1, b'1'),
(11, 'Removed', 'Removed', 'Notes Status', '2021-03-04 18:23:58', 1, '2021-03-04 18:23:58', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotes`
--

CREATE TABLE `sellernotes` (
  `ID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `ActionedBy` int(11) DEFAULT NULL,
  `AdminRemarks` varchar(255) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `Category` int(11) NOT NULL,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `NoteType` int(11) DEFAULT NULL,
  `NumberofPages` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `Country` int(11) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL,
  `SellingPrice` decimal(10,0) DEFAULT NULL,
  `NotesPreview` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotes`
--

INSERT INTO `sellernotes` (`ID`, `SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `NoteType`, `NumberofPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(6, 5, 7, 5, 'best', '2021-03-04 20:56:46', 'programing', 1, 'computer-science.png', 3, 456, 'this is best book', 'GECR', 3, 'cricket', '12', 'jack', b'0', '0', 'Final.pdf', '2021-03-04 20:56:46', 1, '2021-03-04 20:56:46', 1, b'1'),
(7, 5, 7, 5, 'best', '2021-03-04 20:59:27', 'programing in c', 1, 'banner.png', 1, 45, 'this is best book for c', 'GEC-gandhinagar', 5, 'programing language', '123', 'kevin', b'1', '12', 'Final.pdf', '2021-03-04 20:59:27', 1, '2021-03-04 20:59:27', 1, b'1'),
(8, 5, 6, 5, 'best', '2021-03-04 21:01:09', 'the cooking', 5, 'search6.png', 2, 85, 'best tips for cooking', 'vvp', 7, 'cooking with master', '55', 'piter', b'0', '0', 'Final.pdf', '2021-03-04 21:01:09', 1, '2021-03-04 21:01:09', 1, b'1'),
(9, 5, 9, 5, 'best', '2021-03-04 21:03:54', 'cricket lover', 4, 'search6.png', 3, 850, 'cricket master', 'vvg', 9, 'cricket', '99', 'potter', b'1', '65', 'Final.pdf', '2021-03-04 21:03:54', 1, '2021-03-04 21:03:54', 1, b'1'),
(10, 5, 9, 5, 'best', '2021-03-04 21:06:00', 'helloworld program', 2, 'computer-science.png', 7, 650, 'programing series', 'GECR', 9, 'grow up', '9', 'happy', b'1', '80', 'Final.pdf', '2021-03-04 21:06:00', 1, '2021-03-04 21:06:00', 1, b'1'),
(11, 5, 6, 5, 'best', '2021-03-04 21:07:12', 'java programing', 1, 'computer-science.png', 7, 650, 'programing series', 'GECR', 9, 'java', '9', 'happy', b'0', '0', 'Final.pdf', '2021-03-04 21:07:12', 1, '2021-03-04 21:07:12', 1, b'1'),
(12, 5, 6, 5, 'best', '2021-03-04 21:49:13', 'the shivaji', 6, 'computer-science.png', 3, 789, 'life of shivaji.', 'the books', 9, 'arts', '88', 'johny weak', b'0', '0', '', '2021-03-04 21:49:13', 1, '2021-03-04 21:49:13', 1, b'1'),
(13, 5, 6, 5, 'best', '2021-03-04 21:53:09', 'history of india', 6, 'computer-science.png', 4, 78, 'india history', 'the books', 9, 'arts', '88', 'johny weak', b'1', '33', 'Final.pdf', '2021-03-04 21:53:09', 1, '2021-03-04 21:53:09', 1, b'1'),
(14, 5, 9, 5, 'best', '2021-03-04 22:00:56', 'wings of fire', 6, '', 5, 44, 'the best book', 'gp publlication', 9, 'social', '12', 'johny weak', b'1', '33', 'Final.pdf', '2021-03-04 22:00:56', 1, '2021-03-04 22:00:56', 1, b'1'),
(15, 5, 7, 5, 'best', '2021-03-04 22:04:10', 'the maths master', 2, 'banner.png', 2, 444, 'the best book', 'gp publlication', 11, 'maths', '14', 'harsh', b'0', '0', 'Final.pdf', '2021-03-04 22:04:10', 1, '2021-03-04 22:04:10', 1, b'1'),
(16, 5, 7, 5, 'best', '2021-03-04 22:07:02', 'the quize', 3, 'banner.png', 1, 63, 'good book', 'akta prakashan', 11, 'quize', '78', 'mahesh', b'0', '0', 'Final.pdf', '2021-03-04 22:07:02', 1, '2021-03-04 22:07:02', 1, b'1'),
(17, 5, 7, 5, 'best', '2021-03-04 22:08:31', 'the quize2', 3, 'banner.png', 7, 100, 'this is part two', 'akta prakashan', 5, 'quize', '78', 'bhavik', b'1', '456', 'Final.pdf', '2021-03-04 22:08:31', 1, '2021-03-04 22:08:31', 1, b'1'),
(18, 5, 6, 5, 'best', '2021-03-04 22:11:57', 'tha jangal book', 6, 'search6.png', 4, 100, 'this is best book', 'pk college', 12, 'story', '30', 'bravo', b'1', '70', 'Final.pdf', '2021-03-04 22:11:57', 1, '2021-03-04 22:11:57', 1, b'1'),
(19, 5, 9, 5, 'best', '2021-03-04 22:13:01', 'the lion', 4, 'search6.png', 3, 1000, 'this is best book', 'jk college', 1, 'social', '33', 'bravo', b'1', '70', 'Final.pdf', '2021-03-04 22:13:01', 1, '2021-03-04 22:13:01', 1, b'1'),
(20, 5, 6, 5, 'best', '2021-03-04 22:15:50', 'computer hardware edit', 3, 'search6.png', 3, 3, 'this is best book', '3}', 3, 'computer', '44', 'bravo', b'1', '60', 'Final.pdf', '2021-03-04 22:15:50', 1, '2021-03-04 22:15:50', 1, b'1'),
(21, 5, 9, 5, 'best', '2021-03-04 22:17:11', 'mobile system', 2, 'search6.png', 2, 845, 'this is best book', 'hogwards', 10, 'computer', '397', 'piter', b'0', '0', 'Final.pdf', '2021-03-04 22:17:11', 1, '2021-03-04 22:17:11', 1, b'1'),
(22, 5, 9, 5, 'best', '2021-03-04 22:19:03', 'machine instuments', 2, 'search6.png', 7, 84, 'this is best .', 'hawards', 4, 'mechenical', '11', 'potter', b'1', '89', 'Final.pdf', '2021-03-04 22:19:03', 1, '2021-03-04 22:19:03', 1, b'1'),
(23, 5, 9, 5, 'best', '2021-03-04 22:22:45', 'network logic', 2, 'search6.png', 1, 78, 'this good book', 'ford college.', 8, 'E.C.', '80', 'lalu', b'1', '789', 'Final.pdf', '2021-03-04 22:22:45', 1, '2021-03-04 22:22:45', 1, b'1'),
(24, 5, 9, 5, 'best', '2021-03-04 22:23:26', 'network logic2', 2, 'search6.png', 1, 780, 'this good book', 'ford college.', 12, 'E.C.', '80', 'lalu', b'1', '78', 'Final.pdf', '2021-03-04 22:23:26', 1, '2021-03-04 22:23:26', 1, b'1'),
(25, 5, 9, 5, 'best', '2021-03-04 22:24:51', 'history of US', 6, 'search6.png', 5, 65, 'this good book.', 'kp Publication', 12, 'history', '97', 'hobs', b'0', '0', 'Final.pdf', '2021-03-04 22:24:51', 1, '2021-03-04 22:24:51', 1, b'1'),
(26, 5, 9, 5, 'best', '2021-03-04 22:26:46', 'land of egypt', 3, 'search6.png', 4, 445, 'wonderfull', 'EG wherehouse.', 6, 'geometry', '22', 'mummy', b'0', '0', 'Final.pdf', '2021-03-04 22:26:46', 1, '2021-03-04 22:26:46', 1, b'1'),
(27, 5, 9, 5, 'best', '0000-00-00 00:00:00', 'the avengers', 4, 'search6.png', 3, 698, 'best.', 'the avenger group.', 3, 'magazin', '44', 'caption', b'1', '13', 'Final.pdf', '2021-03-04 22:28:42', 1, '2021-03-04 22:28:42', 1, b'1'),
(28, 5, 9, 5, 'best', '2021-03-04 22:29:32', 'the avengers part 2', 3, 'search6.png', 5, 852, 'best.', 'the avenger group.', 10, 'magazin', '44', 'caption', b'1', '130', 'Final.pdf', '2021-03-04 22:29:32', 1, '2021-03-04 22:29:32', 1, b'1'),
(29, 5, 7, 5, 'best', '2021-03-04 22:31:15', 'the bhagvat gita', 6, 'search6.png', 7, 400, 'best.', 'krishna publication', 9, 'life', '1600', 'madhav', b'1', '45', 'Final.pdf', '2021-03-04 22:31:15', 1, '2021-03-04 22:31:15', 1, b'1'),
(30, 5, 7, 5, 'best', '2021-03-04 22:33:08', 'space secrate', 1, 'search6.png', 7, 1500, 'good.', 'jp publication', 9, 'space', '357', 'akshay', b'1', '1300', 'Final.pdf', '2021-03-04 22:33:08', 1, '2021-03-04 22:33:08', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesattachements`
--

CREATE TABLE `sellernotesattachements` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesattachements`
--

INSERT INTO `sellernotesattachements` (`ID`, `NoteID`, `FileName`, `FilePath`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(9, 6, 'Attachement_0_040321042646.pdf', '../Members/5/6/Attachements/Attachement_0_040321042646.pdf', '2021-03-04 20:56:46', 1, '2021-03-04 20:56:46', 1, b'1'),
(10, 7, 'Attachement_0_040321042927.pdf', '../Members/5/7/Attachements/Attachement_0_040321042927.pdf', '2021-03-04 20:59:27', 1, '2021-03-04 20:59:27', 1, b'1'),
(11, 8, 'Attachement_0_040321043109.pdf', '../Members/5/8/Attachements/Attachement_0_040321043109.pdf', '2021-03-04 21:01:09', 1, '2021-03-04 21:01:09', 1, b'1'),
(12, 9, 'Attachement_0_040321043355.pdf', '../Members/5/9/Attachements/Attachement_0_040321043355.pdf', '2021-03-04 21:03:55', 1, '2021-03-04 21:03:55', 1, b'1'),
(13, 9, 'Attachement_1_040321090355.pdf', '../Members/5/9/Attachements/Attachement_1_040321090355.pdf', '2021-03-04 21:03:55', 1, '2021-03-04 21:03:55', 1, b'1'),
(14, 10, 'Attachement_0_040321043600.pdf', '../Members/5/10/Attachements/Attachement_0_040321043600.pdf', '2021-03-04 21:06:00', 1, '2021-03-04 21:06:00', 1, b'1'),
(15, 10, 'Attachement_1_040321090601.pdf', '../Members/5/10/Attachements/Attachement_1_040321090601.pdf', '2021-03-04 21:06:01', 1, '2021-03-04 21:06:01', 1, b'1'),
(16, 10, 'Attachement_2_040321090601.pdf', '../Members/5/10/Attachements/Attachement_2_040321090601.pdf', '2021-03-04 21:06:01', 1, '2021-03-04 21:06:01', 1, b'1'),
(17, 11, 'Attachement_0_040321043712.pdf', '../Members/5/11/Attachements/Attachement_0_040321043712.pdf', '2021-03-04 21:07:12', 1, '2021-03-04 21:07:12', 1, b'1'),
(18, 11, 'Attachement_1_040321090712.pdf', '../Members/5/11/Attachements/Attachement_1_040321090712.pdf', '2021-03-04 21:07:12', 1, '2021-03-04 21:07:12', 1, b'1'),
(19, 11, 'Attachement_2_040321090713.pdf', '../Members/5/11/Attachements/Attachement_2_040321090713.pdf', '2021-03-04 21:07:13', 1, '2021-03-04 21:07:13', 1, b'1'),
(20, 12, 'Attachement_0_040321051913.pdf', '../Members/5/12/Attachements/Attachement_0_040321051913.pdf', '2021-03-04 21:49:13', 1, '2021-03-04 21:49:13', 1, b'1'),
(21, 13, 'Attachement_0_040321052309.pdf', '../Members/5/13/Attachements/Attachement_0_040321052309.pdf', '2021-03-04 21:53:09', 1, '2021-03-04 21:53:09', 1, b'1'),
(22, 13, 'Attachement_1_040321095309.pdf', '../Members/5/13/Attachements/Attachement_1_040321095309.pdf', '2021-03-04 21:53:09', 1, '2021-03-04 21:53:09', 1, b'1'),
(23, 14, 'Attachement_0_040321053057.pdf', '../Members/5/14/Attachements/Attachement_0_040321053057.pdf', '2021-03-04 22:00:57', 1, '2021-03-04 22:00:57', 1, b'1'),
(24, 15, 'Attachement_0_040321053410.pdf', '../Members/5/15/Attachements/Attachement_0_040321053410.pdf', '2021-03-04 22:04:10', 1, '2021-03-04 22:04:10', 1, b'1'),
(25, 16, 'Attachement_0_040321053702.pdf', '../Members/5/16/Attachements/Attachement_0_040321053702.pdf', '2021-03-04 22:07:02', 1, '2021-03-04 22:07:02', 1, b'1'),
(26, 17, 'Attachement_0_040321053831.pdf', '../Members/5/17/Attachements/Attachement_0_040321053831.pdf', '2021-03-04 22:08:31', 1, '2021-03-04 22:08:31', 1, b'1'),
(27, 17, 'Attachement_1_040321100831.pdf', '../Members/5/17/Attachements/Attachement_1_040321100831.pdf', '2021-03-04 22:08:31', 1, '2021-03-04 22:08:31', 1, b'1'),
(28, 18, 'Attachement_0_040321054157.pdf', '../Members/5/18/Attachements/Attachement_0_040321054157.pdf', '2021-03-04 22:11:57', 1, '2021-03-04 22:11:57', 1, b'1'),
(29, 18, 'Attachement_1_040321101157.pdf', '../Members/5/18/Attachements/Attachement_1_040321101157.pdf', '2021-03-04 22:11:57', 1, '2021-03-04 22:11:57', 1, b'1'),
(30, 19, 'Attachement_0_040321054301.pdf', '../Members/5/19/Attachements/Attachement_0_040321054301.pdf', '2021-03-04 22:13:01', 1, '2021-03-04 22:13:01', 1, b'1'),
(31, 19, 'Attachement_1_040321101301.pdf', '../Members/5/19/Attachements/Attachement_1_040321101301.pdf', '2021-03-04 22:13:01', 1, '2021-03-04 22:13:01', 1, b'1'),
(32, 20, 'Attachement_0_040321054550.pdf', '../Members/5/20/Attachements/Attachement_0_040321054550.pdf', '2021-03-04 22:15:50', 1, '2021-03-04 22:15:50', 1, b'1'),
(33, 20, 'Attachement_1_040321101550.pdf', '../Members/5/20/Attachements/Attachement_1_040321101550.pdf', '2021-03-04 22:15:50', 1, '2021-03-04 22:15:50', 1, b'1'),
(34, 21, 'Attachement_0_040321054711.pdf', '../Members/5/21/Attachements/Attachement_0_040321054711.pdf', '2021-03-04 22:17:11', 1, '2021-03-04 22:17:11', 1, b'1'),
(35, 21, 'Attachement_1_040321101711.pdf', '../Members/5/21/Attachements/Attachement_1_040321101711.pdf', '2021-03-04 22:17:11', 1, '2021-03-04 22:17:11', 1, b'1'),
(36, 22, 'Attachement_0_040321054904.pdf', '../Members/5/22/Attachements/Attachement_0_040321054904.pdf', '2021-03-04 22:19:04', 1, '2021-03-04 22:19:04', 1, b'1'),
(37, 23, 'Attachement_0_040321055245.pdf', '../Members/5/23/Attachements/Attachement_0_040321055245.pdf', '2021-03-04 22:22:45', 1, '2021-03-04 22:22:45', 1, b'1'),
(38, 24, 'Attachement_0_040321055326.pdf', '../Members/5/24/Attachements/Attachement_0_040321055326.pdf', '2021-03-04 22:23:26', 1, '2021-03-04 22:23:26', 1, b'1'),
(39, 25, 'Attachement_0_040321055451.pdf', '../Members/5/25/Attachements/Attachement_0_040321055451.pdf', '2021-03-04 22:24:51', 1, '2021-03-04 22:24:51', 1, b'1'),
(40, 25, 'Attachement_1_040321102451.pdf', '../Members/5/25/Attachements/Attachement_1_040321102451.pdf', '2021-03-04 22:24:51', 1, '2021-03-04 22:24:51', 1, b'1'),
(41, 26, 'Attachement_0_040321055646.pdf', '../Members/5/26/Attachements/Attachement_0_040321055646.pdf', '2021-03-04 22:26:46', 1, '2021-03-04 22:26:46', 1, b'1'),
(42, 26, 'Attachement_1_040321102646.pdf', '../Members/5/26/Attachements/Attachement_1_040321102646.pdf', '2021-03-04 22:26:46', 1, '2021-03-04 22:26:46', 1, b'1'),
(43, 27, 'Attachement_0_040321055842.pdf', '../Members/5/27/Attachements/Attachement_0_040321055842.pdf', '2021-03-04 22:28:42', 1, '2021-03-04 22:28:42', 1, b'1'),
(44, 27, 'Attachement_1_040321102842.pdf', '../Members/5/27/Attachements/Attachement_1_040321102842.pdf', '2021-03-04 22:28:42', 1, '2021-03-04 22:28:42', 1, b'1'),
(45, 27, 'Attachement_2_040321102842.pdf', '../Members/5/27/Attachements/Attachement_2_040321102842.pdf', '2021-03-04 22:28:42', 1, '2021-03-04 22:28:42', 1, b'1'),
(46, 28, 'Attachement_0_040321055932.pdf', '../Members/5/28/Attachements/Attachement_0_040321055932.pdf', '2021-03-04 22:29:32', 1, '2021-03-04 22:29:32', 1, b'1'),
(47, 28, 'Attachement_1_040321102932.pdf', '../Members/5/28/Attachements/Attachement_1_040321102932.pdf', '2021-03-04 22:29:32', 1, '2021-03-04 22:29:32', 1, b'1'),
(48, 28, 'Attachement_2_040321102932.pdf', '../Members/5/28/Attachements/Attachement_2_040321102932.pdf', '2021-03-04 22:29:32', 1, '2021-03-04 22:29:32', 1, b'1'),
(49, 29, 'Attachement_0_040321060115.pdf', '../Members/5/29/Attachements/Attachement_0_040321060115.pdf', '2021-03-04 22:31:15', 1, '2021-03-04 22:31:15', 1, b'1'),
(50, 30, 'Attachement_0_040321060308.pdf', '../Members/5/30/Attachements/Attachement_0_040321060308.pdf', '2021-03-04 22:33:08', 1, '2021-03-04 22:33:08', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreportedissues`
--

CREATE TABLE `sellernotesreportedissues` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReportedByID` int(11) NOT NULL,
  `AgainstDownloadID` int(11) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreviews`
--

CREATE TABLE `sellernotesreviews` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `AgainstDownloadsID` int(11) NOT NULL,
  `Ratings` decimal(10,2) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `systemconfigurations`
--

CREATE TABLE `systemconfigurations` (
  `ID` int(11) NOT NULL,
  `Key` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(80) NOT NULL,
  `token` varchar(255) NOT NULL,
  `IsEmailVarified` bit(1) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `token`, `IsEmailVarified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(5, 3, 'happy', 'manvar', 'happymanvar13@gmail.com', '$2y$10$gmess4zCUVqkdy7GbogvcuTc.5RO2wTOQiqVBvFKNgFHs63x4Z.bO', 'd4b6d1cf748ec725f6dca248dda6e6', b'1', '2021-03-04 16:58:16', NULL, '2021-03-04 16:58:16', NULL, b'1'),
(6, 3, 'harry', 'potter', '170200107066@gecrajkot.ac.in', '$2y$10$vfwOHX381w/OHwra6CZyS.veUtH28YdHmvU.xptru6Bxb1nTkotpi', '1692693bbe8bbe9d909d66b8a88538', b'1', '2021-03-04 16:59:05', NULL, '2021-03-04 16:59:05', NULL, b'1'),
(7, 3, 'abc', 'xyz', 'abc@gmail.com', '$2y$10$zYzTYBDZiUKdzaCCf2zVVerlFWaDAaW.bGWLFkw99lWQ8NRisDyiO', '80cc0e73687442b6153ba9f4c4330c', b'0', '2021-03-05 08:12:21', NULL, '2021-03-05 08:12:21', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` datetime DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) DEFAULT NULL,
  `Phone number - Country Code` varchar(5) NOT NULL,
  `Phone number` varchar(20) NOT NULL,
  `Profile Picture` varchar(500) DEFAULT NULL,
  `Address Line 1` varchar(100) NOT NULL,
  `Address Line 2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Zip Code` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Super Admin', 'super admin can insert admins', '2021-03-04 16:31:22', 1, '2021-03-04 16:31:22', 1, b'1'),
(2, 'Admin', 'Admin can manage all things.', '2021-03-04 16:33:06', 1, '2021-03-04 16:33:06', 1, b'1'),
(3, 'Member', 'user of notes market place', '2021-03-04 16:33:06', 1, '2021-03-04 16:33:06', 1, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `Seller` (`Seller`),
  ADD KEY `Downloader` (`Downloader`);

--
-- Indexes for table `notecategories`
--
ALTER TABLE `notecategories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notetypes`
--
ALTER TABLE `notetypes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `Status` (`Status`),
  ADD KEY `ActionedBy` (`ActionedBy`),
  ADD KEY `Category` (`Category`),
  ADD KEY `NoteType` (`NoteType`),
  ADD KEY `Country` (`Country`);

--
-- Indexes for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReportedByID` (`ReportedByID`),
  ADD KEY `AgainstDownloadID` (`AgainstDownloadID`);

--
-- Indexes for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `AgainstDownloadsID` (`AgainstDownloadsID`);

--
-- Indexes for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Gender` (`Gender`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellernotes`
--
ALTER TABLE `sellernotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`Seller`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`Downloader`) REFERENCES `users` (`ID`);

--
-- Constraints for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD CONSTRAINT `sellernotes_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `referencedata` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_3` FOREIGN KEY (`ActionedBy`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_4` FOREIGN KEY (`Category`) REFERENCES `notecategories` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_5` FOREIGN KEY (`NoteType`) REFERENCES `notetypes` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_6` FOREIGN KEY (`Country`) REFERENCES `countries` (`ID`);

--
-- Constraints for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  ADD CONSTRAINT `sellernotesattachements_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`);

--
-- Constraints for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_2` FOREIGN KEY (`ReportedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD CONSTRAINT `sellernotesreviews_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `user_roles` (`ID`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_profile_ibfk_2` FOREIGN KEY (`Gender`) REFERENCES `referencedata` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
