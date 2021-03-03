-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 07:18 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jms`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `award` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward` float DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `award`, `description`, `reward`, `active`, `created_date`, `last_change`) VALUES
(1, 'Excellent-1', 'Hoàn thành Xuất sắc - Nhóm 1', 1.2, 1, '2021-03-03 13:10:00', NULL),
(2, 'Excellent-2', 'Hoàn thành Xuất sắc - Nhóm 2', 1.15, 1, '2021-03-03 13:11:00', NULL),
(3, 'Good-1', 'Hoàn thành Tốt - Nhóm 1', 1.1, 1, '2021-03-03 13:12:00', NULL),
(4, 'Good-1', 'Hoàn thành Tốt - Nhóm 1', 1.05, 1, '2021-03-03 13:11:00', NULL),
(5, 'Acceptable-1', 'Hoàn thành - Nhóm 1', 1, 1, '2021-03-03 13:14:00', NULL),
(6, 'Acceptable-1', 'Hoàn thành - Nhóm 2', 0.95, 1, '2021-03-03 13:14:00', NULL),
(7, 'Not completed', 'Không hoàn thành', 0.7, 1, '2021-03-03 13:16:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `images` text COLLATE utf8_unicode_ci,
  `job_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `permission` text COLLATE utf8_unicode_ci,
  `created_date` datetime DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logging`
--

CREATE TABLE `logging` (
  `id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_in` int(11) DEFAULT NULL,
  `log_out` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `men_of_the_month`
--

CREATE TABLE `men_of_the_month` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slot` int(11) DEFAULT NULL,
  `award_id` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `proves` text COLLATE utf8_unicode_ci,
  `acive` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `event` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `images` text COLLATE utf8_unicode_ci,
  `expiry_date` date DEFAULT NULL,
  `action` text COLLATE utf8_unicode_ci,
  `frequency` int(11) DEFAULT NULL,
  `isHeadline` tinyint(1) DEFAULT NULL,
  `isEvent` tinyint(1) DEFAULT NULL,
  `isMessage` tinyint(1) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `function` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  `navigation` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `isRead` int(11) NOT NULL,
  `cleared_date` int(11) NOT NULL,
  `created_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regulation`
--

CREATE TABLE `regulation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score1` int(11) DEFAULT NULL,
  `score2` int(11) DEFAULT NULL,
  `score3` int(11) DEFAULT NULL,
  `score4` int(11) DEFAULT NULL,
  `score5` int(11) DEFAULT NULL,
  `overall` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `completed` int(11) DEFAULT NULL,
  `pending` int(11) DEFAULT NULL,
  `overdue` int(11) DEFAULT NULL,
  `regulation` int(11) DEFAULT NULL,
  `overall` int(11) DEFAULT NULL,
  `award_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `squads`
--

CREATE TABLE `squads` (
  `id` int(11) NOT NULL,
  `squad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_target_id` int(11) DEFAULT NULL,
  `deadline` date NOT NULL,
  `plan_start` date DEFAULT NULL,
  `plan_complete` date DEFAULT NULL,
  `actual_start` date DEFAULT NULL,
  `actual_complete` date DEFAULT NULL,
  `priority` int(3) DEFAULT NULL,
  `weight` int(3) NOT NULL,
  `status` int(3) DEFAULT NULL,
  `leader_score` int(3) DEFAULT NULL,
  `efficiency` int(3) DEFAULT NULL,
  `productivity` int(3) DEFAULT NULL,
  `overall_score` int(3) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `isAssigned` tinyint(1) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_targets`
--

CREATE TABLE `team_targets` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `seq_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `task` text COLLATE utf8_unicode_ci NOT NULL,
  `pic` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8_unicode_ci,
  `deadline` date DEFAULT NULL,
  `plan_start` date DEFAULT NULL,
  `plan_complete` date DEFAULT NULL,
  `actual_start` date DEFAULT NULL,
  `actual_complete` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `template_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `template_file` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `template_name`, `template_file`, `active`, `created_by`, `created_date`, `changed_by`, `last_change`) VALUES
(1, 'BM02', '/templates/BM02.xlsx', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `theme_color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body_color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreground_color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `popup_color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_html` text COLLATE utf8_unicode_ci NOT NULL,
  `body_html` text COLLATE utf8_unicode_ci NOT NULL,
  `footer_html` text COLLATE utf8_unicode_ci NOT NULL,
  `popup_html` text COLLATE utf8_unicode_ci NOT NULL,
  `mouse_cursor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `squad_id` int(11) DEFAULT NULL,
  `position` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `gender` int(2) DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `projects` text COLLATE utf8_unicode_ci,
  `first_working_day` date DEFAULT NULL,
  `project_leader` text COLLATE utf8_unicode_ci,
  `direct_leader` text COLLATE utf8_unicode_ci,
  `images` text COLLATE utf8_unicode_ci,
  `avatar` text COLLATE utf8_unicode_ci,
  `motto` text COLLATE utf8_unicode_ci,
  `skype` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` text COLLATE utf8_unicode_ci NOT NULL,
  `social` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `last_change` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logging`
--
ALTER TABLE `logging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `men_of_the_month`
--
ALTER TABLE `men_of_the_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regulation`
--
ALTER TABLE `regulation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squads`
--
ALTER TABLE `squads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_targets`
--
ALTER TABLE `team_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logging`
--
ALTER TABLE `logging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `men_of_the_month`
--
ALTER TABLE `men_of_the_month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regulation`
--
ALTER TABLE `regulation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `squads`
--
ALTER TABLE `squads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_targets`
--
ALTER TABLE `team_targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
