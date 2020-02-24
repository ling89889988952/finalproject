-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2020 at 03:24 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hiv`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_conInfo`
--

CREATE TABLE `tbl_conInfo` (
  `contact_id` int(11) NOT NULL,
  `contact_title` text NOT NULL,
  `contact_address` text NOT NULL,
  `contact_phone` varchar(250) NOT NULL,
  `contact_email` varchar(250) NOT NULL,
  `contact_website` varchar(250) NOT NULL,
  `contact_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_conInfo`
--

INSERT INTO `tbl_conInfo` (`contact_id`, `contact_title`, `contact_address`, `contact_phone`, `contact_email`, `contact_website`, `contact_note`) VALUES
(1, 'Contact Information', '#30-186 King Street London, ON N6A 1C7', '519-434-1601', 'info@hivaidsconnection.ca', 'http://hivaidsconnection.ca/', 'Hey! Don’t worry! WE will keep our secret safe!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `content_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `intro` text NOT NULL,
  `explain` text NOT NULL,
  `link` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`content_id`, `title`, `sub_title`, `intro`, `explain`, `link`) VALUES
(1, 'zero aids?', 'First zero discrimination', '“HIV is not something that “guilty” people get. It is not a punishment for cheating, lying, using drugs or alcohol, having more than one partner, or not asking the right questions. It is a virus whose transmission is fuelled by poverty, ignorance, racism, sexism, homophobia, fear, violence, and many other factors – not by people with HIV.”', '-POSITIVE WOMEN\'S NETWORK OF THE UNITED STATES OF AMERICAt', ''),
(2, 'What is HIV/AIDS?', 'What is different?', 'HIV is a virus that damages the immune system. ', 'To develop AIDS, a person has to have contracted HIV. But having HIV doesn’t necessarily mean that someone will develop AIDS.', ''),
(3, 'Ending HIV stigma and discrimination', '', 'Discrimination is more scary than a virus', 'There are three ways to spread AIDS: blood, mother and child, and sex. Then in addition to these three ways, general hugs, handshake, and courtesy kissing will not be transmitted, so close contact with AIDS patients will not cause HIV infection.', ''),
(4, 'HIV prevention', '', 'Safer sex, Avoid sharing needles or other drug paraphernalia.', 'Although many researchers are working to develop one, there’s currently no vaccine available to prevent the transmission of HIV. However, taking certain steps can help prevent the spread of HIV.', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_intro`
--

CREATE TABLE `tbl_intro` (
  `intro_id` int(11) NOT NULL,
  `intro_text` text NOT NULL,
  `intro_cover` varchar(250) NOT NULL,
  `intro_title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_intro`
--

INSERT INTO `tbl_intro` (`intro_id`, `intro_text`, `intro_cover`, `intro_title`) VALUES
(1, 'HIV (human immunodeficiency virus) is a virus that attacks cells that help the body fight infection, making a person more vulnerable to other infections and diseases.', 'germ.svg', 'Hiv Germ'),
(2, 'AIDS is the late stage of HIV infection that occurs when the body’s immune system is badly damaged because of the virus.', 'aid_germ.svg', 'Aids Germ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_age` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_message` text NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_gender`, `user_age`, `user_email`, `user_message`, `user_date`) VALUES
(1, 'aling', 'prefer not to say', 'prefer not to say', 'zouling707@gmail.com', 'thanks a lot', '2020-02-13 19:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_conInfo`
--
ALTER TABLE `tbl_conInfo`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `tbl_intro`
--
ALTER TABLE `tbl_intro`
  ADD PRIMARY KEY (`intro_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_conInfo`
--
ALTER TABLE `tbl_conInfo`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_intro`
--
ALTER TABLE `tbl_intro`
  MODIFY `intro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
