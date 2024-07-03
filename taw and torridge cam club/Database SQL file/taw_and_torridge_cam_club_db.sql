-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2023 at 08:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taw_and_torridge_cam_club_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_competitions`
--

CREATE TABLE `tbl_competitions` (
  `fld_competition_id` int(10) NOT NULL,
  `fld_date` varchar(11) NOT NULL,
  `fld_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_competitions`
--

INSERT INTO `tbl_competitions` (`fld_competition_id`, `fld_date`, `fld_category`) VALUES
(2, '01/01/2023', 'Sea Scape'),
(3, '01/01/2023', 'Night Sky'),
(4, '01/01/2023', 'Wildlife'),
(5, '03/05/2023', 'Landscape');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_competition_results`
--

CREATE TABLE `tbl_competition_results` (
  `fld_result_id` int(10) NOT NULL,
  `fld_place` varchar(3) NOT NULL,
  `fld_image_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_competition_results`
--

INSERT INTO `tbl_competition_results` (`fld_result_id`, `fld_place`, `fld_image_id`) VALUES
(26, '1st', 118),
(27, '2nd', 114),
(28, '3rd', 122),
(29, '1st', 131),
(30, '2nd', 132),
(31, '3rd', 124);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `fld_event_id` int(10) NOT NULL,
  `fld_date` varchar(10) NOT NULL,
  `fld_location` varchar(50) NOT NULL,
  `fld_season` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`fld_event_id`, `fld_date`, `fld_location`, `fld_season`) VALUES
(2, '28/11/87', 'Barnstaple', 'Winter'),
(3, '01/01/2023', 'Petroc', 'Winter');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_attendance`
--

CREATE TABLE `tbl_event_attendance` (
  `fld_attendance_id` int(10) NOT NULL,
  `fld_attended` varchar(3) NOT NULL,
  `fld_member_id` int(10) NOT NULL,
  `fld_event_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_attendance`
--

INSERT INTO `tbl_event_attendance` (`fld_attendance_id`, `fld_attended`, `fld_member_id`, `fld_event_id`) VALUES
(3, 'yes', 63, 2),
(4, 'yes', 64, 2),
(5, 'yes', 65, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `fld_image_id` int(10) NOT NULL,
  `fld_image_title` varchar(50) NOT NULL,
  `fld_image_path` varchar(250) NOT NULL,
  `fld_image_votes` int(3) NOT NULL,
  `fld_image_points` int(2) NOT NULL,
  `fld_entry_id` int(10) NOT NULL,
  `fld_member_id` int(10) NOT NULL,
  `fld_competition_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`fld_image_id`, `fld_image_title`, `fld_image_path`, `fld_image_votes`, `fld_image_points`, `fld_entry_id`, `fld_member_id`, `fld_competition_id`) VALUES
(114, 'Moody Sky', 'images/sea_scape_1.jpg', 2, 15, 1349847, 63, 2),
(115, 'Rough Seas', 'images/sea_scape_2.jpg', 0, 5, 4975489, 63, 2),
(116, 'Tranquill Water', 'images/sea_scape_3.jpg', 0, 5, 3539251, 63, 2),
(117, 'Sunset Bay', 'images/sea_scape_4.jpg', 0, 5, 3583602, 64, 2),
(118, 'Ghostly Pier', 'images/sea_scape_5.jpg', 3, 20, 8599836, 64, 2),
(119, 'Clear Water', 'images/sea_scape_6.jpg', 0, 5, 4911281, 64, 2),
(120, 'Clear Sky', 'images/sea_scape_7.jpg', 0, 5, 7146108, 65, 2),
(121, 'Open Sea', 'images/sea_scape_8.jpg', 0, 5, 6268984, 65, 2),
(122, 'Sunset Cove', 'images/sea_scape_9.jpg', 1, 10, 9300748, 65, 2),
(124, 'Galaxy', 'images/night_sky_1.jpg', 1, 10, 5687611, 63, 3),
(125, 'The Stars Above', 'images/night_sky_2.jpg', 0, 5, 41218, 63, 3),
(126, 'Shooting Star', 'images/night_sky_3.jpg', 0, 5, 2522069, 63, 3),
(127, 'The Starry Night', 'images/night_sky_4.jpg', 0, 5, 4804972, 64, 3),
(128, 'Starlight Cluster', 'images/night_sky_5.jpg', 0, 5, 4589381, 64, 3),
(129, 'Dawn Shooting Star', 'images/night_sky_6.jpg', 0, 5, 5054653, 64, 3),
(130, 'Abstract Moon', 'images/night_sky_7.jpg', 0, 5, 2827912, 65, 3),
(131, 'Swirl', 'images/night_sky_8.jpg', 3, 20, 4601854, 65, 3),
(132, 'Frozen View', 'images/night_sky_9.jpg', 2, 15, 4075234, 65, 3),
(133, 'Squirrel', 'images/wildlife_1.jpg', 0, 5, 7299103, 63, 4),
(134, 'Hedgehog', 'images/wildlife_2.jpg', 0, 5, 1123260, 63, 4),
(135, 'Peaking Bird', 'images/wildlife_3.jpg', 0, 5, 9679111, 63, 4),
(136, 'Badger', 'images/wildlife_4.jpg', 0, 5, 9605514, 64, 4),
(137, 'Fox', 'images/wildlife_5.jpg', 0, 5, 8824807, 64, 4),
(138, 'Mouse', 'images/wildlife_6.jpg', 0, 5, 5759556, 64, 4),
(139, 'Hidden Mouse', 'images/wildlife_7.jpg', 0, 5, 8054593, 65, 4),
(140, 'Rabbit', 'images/wildlife_8.jpg', 0, 5, 5459607, 65, 4),
(141, 'Doe', 'images/wildlife_9.jpg', 0, 5, 6434210, 65, 4),
(142, 'Towering Hill', 'images/landscape_1.jpg', 0, 5, 2285657, 63, 5),
(143, 'Distant Mountain', 'images/landscape_2.jpg', 0, 5, 1504981, 63, 5),
(144, 'Blue Lagoon', 'images/landscape_3.jpg', 0, 5, 8308176, 63, 5),
(145, 'Frozen Mountains', 'images/landscape_4.jpg', 0, 5, 1149904, 64, 5),
(146, 'Green Paradise', 'images/landscape_5.jpg', 0, 5, 4999455, 64, 5),
(147, 'Bloom', 'images/landscape_6.jpg', 0, 5, 3229574, 64, 5),
(148, 'Reflection', 'images/landscape_7.jpg', 0, 5, 6518541, 65, 5),
(149, 'The Plains', 'images/landscape_8.jpg', 0, 5, 3126125, 65, 5),
(151, 'Mountain Stream', 'images/landscape_9.jpg', 0, 5, 4720801, 65, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `fld_member_id` int(10) NOT NULL,
  `fld_first_name` varchar(30) NOT NULL,
  `fld_last_name` varchar(50) NOT NULL,
  `fld_phone_number` varchar(11) NOT NULL,
  `fld_address` varchar(250) NOT NULL,
  `fld_email` varchar(100) NOT NULL,
  `fld_password` varchar(250) NOT NULL,
  `fld_rank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`fld_member_id`, `fld_first_name`, `fld_last_name`, `fld_phone_number`, `fld_address`, `fld_email`, `fld_password`, `fld_rank`) VALUES
(48, 'Secretary', '1', '0', '01271889310', 'secretary@rank.com', '202cb962ac59075b964b07152d234b70', 'secretary'),
(49, 'Admin', '1', '0', '123456789', 'admin@rank.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(63, 'Alan', 'Alderson', '01271883910', 'Alderson Street', 'alan@alderson.com', '202cb962ac59075b964b07152d234b70', 'user'),
(64, 'Bruce', 'Banner', '07536489657', 'Banner Street', 'bruce@banner.com', '202cb962ac59075b964b07152d234b70', 'user'),
(65, 'Charlie', 'Chaplin', '01271333555', 'Chaplin Street', 'charlie@chaplin.com', '202cb962ac59075b964b07152d234b70', 'user'),
(68, 'Daniel', 'Dyson', '07536419732', 'Dyson Street', 'dan@dyson.com', '202cb962ac59075b964b07152d234b70', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote_record`
--

CREATE TABLE `tbl_vote_record` (
  `fld_vote_rec_id` int(10) NOT NULL,
  `fld_voted` varchar(3) NOT NULL,
  `fld_member_id` int(10) NOT NULL,
  `fld_competition_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vote_record`
--

INSERT INTO `tbl_vote_record` (`fld_vote_rec_id`, `fld_voted`, `fld_member_id`, `fld_competition_id`) VALUES
(36, 'Yes', 63, 2),
(37, 'Yes', 64, 2),
(38, 'Yes', 65, 2),
(39, 'Yes', 49, 2),
(40, 'Yes', 48, 2),
(41, 'Yes', 68, 2),
(42, 'Yes', 63, 3),
(43, 'Yes', 64, 3),
(44, 'Yes', 65, 3),
(45, 'Yes', 68, 3),
(46, 'Yes', 49, 3),
(47, 'Yes', 48, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_competitions`
--
ALTER TABLE `tbl_competitions`
  ADD PRIMARY KEY (`fld_competition_id`);

--
-- Indexes for table `tbl_competition_results`
--
ALTER TABLE `tbl_competition_results`
  ADD PRIMARY KEY (`fld_result_id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`fld_event_id`);

--
-- Indexes for table `tbl_event_attendance`
--
ALTER TABLE `tbl_event_attendance`
  ADD PRIMARY KEY (`fld_attendance_id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`fld_image_id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`fld_member_id`);

--
-- Indexes for table `tbl_vote_record`
--
ALTER TABLE `tbl_vote_record`
  ADD PRIMARY KEY (`fld_vote_rec_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_competitions`
--
ALTER TABLE `tbl_competitions`
  MODIFY `fld_competition_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_competition_results`
--
ALTER TABLE `tbl_competition_results`
  MODIFY `fld_result_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `fld_event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_event_attendance`
--
ALTER TABLE `tbl_event_attendance`
  MODIFY `fld_attendance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `fld_image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `fld_member_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_vote_record`
--
ALTER TABLE `tbl_vote_record`
  MODIFY `fld_vote_rec_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
