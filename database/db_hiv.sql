-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2020 at 05:58 AM
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
  `password_count` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`, `email`, `login_count`, `password_count`, `login_time`) VALUES
(1, 'admin', '$2y$10$R9jZLVmOHQELv4gypzN15OW/rOHN/uCiTqn5qhWc48.uyrPNwfVNm', '1@qq.com', 1, 0, '2020-04-12 03:09:37'),
(2, 'zou', '$2y$10$AWPP8Qz8VNKHi8/83uD9ZucXc5qCmWB40En4EnICMzuNFYWiKdiyq', '002@qq.com', 3, 0, '2020-04-08 16:18:45'),
(3, 'ling', '$2y$10$XSv7ZNtmapYEtvWR02HzQu3v3Iwd0QUP151H49rGoVNMoEM.WIB36', 'zgdbs123@sina.com', 1, 0, '2020-04-08 19:05:06'),
(4, 'aling', '$2y$10$RbPp38GcD.yh8wBvAgFzEugXyljHMilaj9gTivbK.q9TyDv.6J2ai', '002@qq.com', 1, 0, '2020-04-08 19:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'hiv'),
(2, 'discrimination'),
(3, 'prevention');

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
  `content_header` text NOT NULL,
  `content_intro` text NOT NULL,
  `content_picture` varchar(250) NOT NULL,
  `video_source` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`content_id`, `content_header`, `content_intro`, `content_picture`, `video_source`) VALUES
(1, 'Ending HIV stigma<br>and discrimination<br>', '<br>Discrimination is more scary than a virus<br><br>\r\n                    There are three ways to spread AIDS: blood, mother and child, and sex. Then in addition to these three ways, general hugs, handshake, and courtesy kissing will not be transmitted, so close contact with AIDS patients will not cause HIV infection.', 'hug.png', 'care.mp4'),
(2, 'HIV prevention<br>', '<br>Safer sex, Avoid sharing needles or other drug paraphernalia.<br><br><br>\r\n                    Although many researchers are working to develop one, there’s currently no vaccine available to prevent the transmission of HIV. However, taking certain steps can help prevent the spread of HIV.\r\n                    <br>', 'condom.png', 'sex.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content_category`
--

CREATE TABLE `tbl_content_category` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_content_category`
--

INSERT INTO `tbl_content_category` (`id`, `video_id`, `category_id`) VALUES
(1, 1, 2),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail`
--

CREATE TABLE `tbl_detail` (
  `detail_id` int(11) NOT NULL,
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

INSERT INTO `tbl_detail` (`detail_id`, `header_image`, `header`, `intro`, `image`, `sub_image`, `sub_intro`) VALUES
(1, 'search.png', 'What is HIV/AIDS?\r\n<br>\r\nWhat is Connection?', '<span> HIV(human immunodeficiency virus) is a virus that damages the immune system.</span> <br><br> \r\n<span> AIDS is the late stage of HIV infection that occurs when the body’s immune system isbadly damaged because of the virus.</span> <br><br>\r\nHIV stands for the human immunodeficiency virus. HIV is an infection that, with daily HIV treatment, is a long-term \r\nchronic condition.<br>\r\nAIDS stands for acquired immunodeficiency syndrome, which means that an infection with HIV has developed to a late stage. The immune system has been weakened to the point where the person with HIV is more likely to get infections or other illnesses that can be life-threatening. \r\n', 'virus.png', 'system.png', '<span>To develop AIDS, a person has to have contracted HIV. But having HIV doesn’t necessarily mean that someone will develop AIDS.</span><br><br>\r\n\r\nCases of HIV progress through three stages:<br><br>\r\n\r\nstage 1: acute stage, the first few weeks after transmission<br>\r\nstage 2: clinical latency, or chronic stage<br>\r\nstage 3: AIDS<br>\r\nAs HIV lowers the CD4 cell count, the immune system weakens. A typical adult’s CD4 count is 500 to 1,500 per cubic millimeter. A person with a count below 200 is considered to have AIDS.<br><br>\r\n\r\nHow quickly a case of HIV progresses through the chronic stage varies significantly from person to person. Without \r\ntreatment, it can last up to a decade before advancing to AIDS. With treatment, it can last indefinitely.'),
(2, 'zero.png', 'Ending HIV stigma<br>\r\nand discrimination', '<span>No AIDS, no discrimination, ending HIV stigma and discrimination</span><br><br>\r\n\r\nHIV and AIDS-related stigma can lead to discrimination, for example, when people living with HIV are prohibited from travelling, using healthcare facilities or seeking employment.<br><br>\r\n\r\nAdopting a human rights approach to HIV and AIDS is in the public’s interest. Stigma blocks access to HIV testing and treatment services, making onwards transmission more likely. The removal of barriers to these services is key to ending the global HIV epidemic.\r\n', 'hug.png', 'sign.png', '<span>It is ok to give them a hug</span><br><br>\r\n\r\nHIV does NOT spread through:<br>\r\n	•	skin-to-skin contact<br>\r\n	•	hugging, shaking hands, or kissing<br>\r\n	•	air or water<br>\r\n	•	sharing food or drinks, including drinking fountains<br>\r\n	•	saliva, tears, or sweat (unless mixed with the blood of a person with HIV)<br>\r\n	•	sharing a toilet, towels, or bedding<br>\r\n	•	mosquitoes or other insects<br><br>\r\n\r\nIt’s important to note that if a person with HIV is being treated and has a persistently undetectable viral load, it’s virtually impossible to transmit the virus to another person.'),
(3, 'shield.png', 'HIV prevention', '<span>Safer sex</span><br><br>\r\n\r\nThe most common way for HIV to spread is through anal or vaginal sex without a condom. This risk can’t be completely eliminated unless sex is avoided entirely, but the risk can be \r\nlowered considerably by taking a few \r\nprecautions. <br><br>\r\n\r\nUse condoms. People should learn the correct way to use condoms and use them every time they have sex, whether it’s through vaginal or anal intercourse. It’s important to keep in mind that pre-seminal fluids (which come out before male ejaculation) can contain HIV.\r\n   ', 'condom.png', 'drug.png', '<span>Other prevention methods</span><br><br>\r\nAvoid sharing needles or other drug paraphernalia. HIV is transmitted through blood and can be contracted by using contaminated materials.<br>\r\nConsider PEP. A person who has been exposed to HIV should contact their healthcare provider about obtaining post-exposure prophylaxis (PEP). PEP can reduce the risk of contracting HIV. It consists of three antiretroviral \r\nmedications given for 28 days. PEP should be started as soon as possible after exposure, but before 36 to 72 hours have passed.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_category`
--

CREATE TABLE `tbl_detail_category` (
  `id_detail` int(11) NOT NULL,
  `detail_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_detail_category`
--

INSERT INTO `tbl_detail_category` (`id_detail`, `detail_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hiv`
--

CREATE TABLE `tbl_hiv` (
  `id` int(11) NOT NULL,
  `hiv_header` text NOT NULL,
  `hiv_detail` text NOT NULL,
  `hiv_intro` text NOT NULL,
  `hiv_picture` varchar(250) NOT NULL,
  `hiv_video` varchar(250) NOT NULL,
  `aid_intro` text NOT NULL,
  `aid_picture` varchar(250) NOT NULL,
  `aid_video` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_hiv`
--

INSERT INTO `tbl_hiv` (`id`, `hiv_header`, `hiv_detail`, `hiv_intro`, `hiv_picture`, `hiv_video`, `aid_intro`, `aid_picture`, `aid_video`) VALUES
(1, 'What is HIV/AIDS?<br>What is different?<br>', '<br>HIV is a virus that damages the immune system.<br><br><br>\r\n                    To develop AIDS, a person has to have contracted HIV. But having HIV doesn’t necessarily mean that someone will develop AIDS.\r\n                    <br>', 'HIV (human immunodeficiency virus) is a virus that attacks cells that help the body fight infection, making a person more vulnerable to other \r\ninfections and diseases.', 'virus.png', 'hiv.mp4', 'AIDS is the late stage of HIV \r\ninfection that occurs when the body’s immune system is badly \r\ndamaged because of the virus.', 'system.png', 'prevent.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home`
--

CREATE TABLE `tbl_home` (
  `id` int(11) NOT NULL,
  `home_header` text NOT NULL,
  `home_subheader` text NOT NULL,
  `home_introduce` text NOT NULL,
  `home_video` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_home`
--

INSERT INTO `tbl_home` (`id`, `home_header`, `home_subheader`, `home_introduce`, `home_video`) VALUES
(1, 'zero aids?', 'First zero discrimination', '“HIV is not something that “guilty” people get. It is not a punishment for cheating, lying, using drugs or alcohol, having more than one partner, or not asking the right questions. \r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n-POSITIVE WOMEN\'S NETWORK OF THE UNITED STATES OF AMERICA', 'topvideo.mp4');

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
-- Indexes for table `tbl_content_category`
--
ALTER TABLE `tbl_content_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_detail`
--
ALTER TABLE `tbl_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `tbl_detail_category`
--
ALTER TABLE `tbl_detail_category`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbl_hiv`
--
ALTER TABLE `tbl_hiv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_home`
--
ALTER TABLE `tbl_home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_content_category`
--
ALTER TABLE `tbl_content_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_detail`
--
ALTER TABLE `tbl_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_detail_category`
--
ALTER TABLE `tbl_detail_category`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_hiv`
--
ALTER TABLE `tbl_hiv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_home`
--
ALTER TABLE `tbl_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
