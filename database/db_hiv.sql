-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2020 at 04:32 AM
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
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `login_count` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`, `email`, `login_count`, `login_time`) VALUES
(1, 'admin', '$2y$10$R9jZLVmOHQELv4gypzN15OW/rOHN/uCiTqn5qhWc48.uyrPNwfVNm', '1@qq.com', 1, '2020-03-21 04:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'home'),
(2, 'hiv/aids'),
(3, '0 discrimination'),
(4, 'prevention'),
(5, 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `contact_id` int(11) NOT NULL,
  `contact_title` text NOT NULL,
  `contact_address` text NOT NULL,
  `contact_phone` varchar(250) NOT NULL,
  `contact_email` varchar(250) NOT NULL,
  `contact_website` varchar(250) NOT NULL,
  `contact_picture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_id`, `contact_title`, `contact_address`, `contact_phone`, `contact_email`, `contact_website`, `contact_picture`) VALUES
(1, 'Contact Information', '#30-186 King Street London, ON N6A 1C7', '519-434-1601', 'info@hivaidsconnection.ca', 'http://hivaidsconnection.ca/', 'tip');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `content_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `intro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`content_id`, `title`, `intro`) VALUES
(1, 'zero aids? <br>\r\nFirst zero discrimination', '“HIV is not something that “guilty” people get. It is not a punishment for cheating, lying, using drugs or alcohol, having more than one partner, or not asking the right questions. \r\n<br><br><br>\r\n-POSITIVE WOMEN\'S NETWORK OF THE UNITED STATES OF AMERICA\r\n'),
(2, 'What is HIV/AIDS?<br>\r\nWhat is different?', 'HIV is a virus that damages the immune system. \r\n<br>\r\nTo develop AIDS, a person has to have contracted HIV. But having HIV doesn’t necessarily mean that someone will develop AIDS.\r\n'),
(3, 'Ending HIV stigma and discrimination', 'Discrimination is more scary than a virus. \r\n<br>\r\nThere are three ways to spread AIDS: blood, mother and child, and sex. Then in addition to these three ways, general hugs, handshake, and courtesy kissing will not be transmitted, so close contact with AIDS patients will not cause HIV infection.'),
(4, 'HIV prevention', 'Safer sex, Avoid sharing needles or other drug paraphernalia.\r\n<br>\r\nAlthough many researchers are working to develop one, there’s currently no vaccine available to prevent the transmission of HIV. However, taking certain steps can help prevent the spread of HIV.\r\n'),
(5, 'Want get more knowledge about HIV?', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail`
--

CREATE TABLE `tbl_detail` (
  `id` int(11) NOT NULL,
  `page` text NOT NULL,
  `header_image` varchar(250) NOT NULL,
  `header` text NOT NULL,
  `intro` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `sub_image` varchar(250) NOT NULL,
  `sub_intro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_detail`
--

INSERT INTO `tbl_detail` (`id`, `page`, `header_image`, `header`, `intro`, `image`, `sub_image`, `sub_intro`) VALUES
(1, 'hiv', 'search', 'What is HIV/AIDS?\r\n<br>\r\nWhat is Connection?', '<span> HIV(human immunodeficiency virus) is a virus that damages the immune system.</span> <br><br> \r\n<span> AIDS is the late stage of HIV infection that occurs when the body’s immune system isbadly damaged because of the virus.</span> <br><br>\r\nHIV stands for the human immunodeficiency virus. HIV is an infection that, with daily HIV treatment, is a long-term \r\nchronic condition.<br>\r\nAIDS stands for acquired immunodeficiency syndrome, which means that an infection with HIV has developed to a late stage. The immune system has been weakened to the point where the person with HIV is more likely to get infections or other illnesses that can be life-threatening. \r\n', 'virus', 'system', '<span>To develop AIDS, a person has to have contracted HIV. But having HIV doesn’t necessarily mean that someone will develop AIDS.</span><br><br>\r\n\r\nCases of HIV progress through three stages:<br><br>\r\n\r\nstage 1: acute stage, the first few weeks after transmission<br>\r\nstage 2: clinical latency, or chronic stage<br>\r\nstage 3: AIDS<br>\r\nAs HIV lowers the CD4 cell count, the immune system weakens. A typical adult’s CD4 count is 500 to 1,500 per cubic millimeter. A person with a count below 200 is considered to have AIDS.<br><br>\r\n\r\nHow quickly a case of HIV progresses through the chronic stage varies significantly from person to person. Without \r\ntreatment, it can last up to a decade before advancing to AIDS. With treatment, it can last indefinitely.'),
(2, 'zero', 'zero', 'Ending HIV stigma<br>\r\nand discrimination', '<span>No AIDS, no discrimination, ending HIV stigma and discrimination</span><br><br>\r\n\r\nHIV and AIDS-related stigma can lead to discrimination, for example, when people living with HIV are prohibited from travelling, using healthcare facilities or seeking employment.<br><br>\r\n\r\nAdopting a human rights approach to HIV and AIDS is in the public’s interest. Stigma blocks access to HIV testing and treatment services, making onwards transmission more likely. The removal of barriers to these services is key to ending the global HIV epidemic.\r\n', 'hug', 'sign', '<span>It is ok to give them a hug</span><br><br>\r\n\r\nHIV does NOT spread through:<br>\r\n	•	skin-to-skin contact<br>\r\n	•	hugging, shaking hands, or kissing<br>\r\n	•	air or water<br>\r\n	•	sharing food or drinks, including drinking fountains<br>\r\n	•	saliva, tears, or sweat (unless mixed with the blood of a person with HIV)<br>\r\n	•	sharing a toilet, towels, or bedding<br>\r\n	•	mosquitoes or other insects<br><br>\r\n\r\nIt’s important to note that if a person with HIV is being treated and has a persistently undetectable viral load, it’s virtually impossible to transmit the virus to another person.'),
(3, 'prevention', 'shield', 'HIV prevention', '<span>Safer sex</span><br><br>\r\n\r\nThe most common way for HIV to spread is through anal or vaginal sex without a condom. This risk can’t be completely eliminated unless sex is avoided entirely, but the risk can be \r\nlowered considerably by taking a few \r\nprecautions. <br><br>\r\n\r\nUse condoms. People should learn the correct way to use condoms and use them every time they have sex, whether it’s through vaginal or anal intercourse. It’s important to keep in mind that pre-seminal fluids (which come out before male ejaculation) can contain HIV.\r\n   ', 'condom', 'drug', '<span>Other prevention methods</span><br><br>\r\nAvoid sharing needles or other drug paraphernalia. HIV is transmitted through blood and can be contracted by using contaminated materials.<br>\r\nConsider PEP. A person who has been exposed to HIV should contact their healthcare provider about obtaining post-exposure prophylaxis (PEP). PEP can reduce the risk of contracting HIV. It consists of three antiretroviral \r\nmedications given for 28 days. PEP should be started as soon as possible after exposure, but before 36 to 72 hours have passed.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_age` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_message` text NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`user_id`, `user_name`, `user_gender`, `user_age`, `user_email`, `user_message`, `user_date`) VALUES
(1, 'aling', 'prefer not to say', 'prefer not to say', 'zouling707@gmail.com', 'thanks a lot', '2020-02-13 19:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `video_id` int(11) NOT NULL,
  `video_title` varchar(250) NOT NULL,
  `video_source` varchar(250) NOT NULL,
  `video_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`video_id`, `video_title`, `video_source`, `video_type`) VALUES
(1, 'Hiv Introduce', 'hiv_video', 'video/mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `tbl_detail`
--
ALTER TABLE `tbl_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_detail`
--
ALTER TABLE `tbl_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
