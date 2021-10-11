-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 06:33 AM
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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `permission` text COLLATE utf8_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `company_id`, `active`, `permission`, `created_by`, `created_date`, `changed_by`, `last_change`) VALUES
(1, 'Creator', 'Creator rights', 1, 1, 'a:27:{i:0;s:13:\"viewUserGroup\";i:1;s:13:\"editUserGroup\";i:2;s:16:\"viewOrganization\";i:3;s:16:\"editOrganization\";i:4;s:15:\"viewMemberTasks\";i:5;s:15:\"editMemberTasks\";i:6;s:18:\"approveMemberTasks\";i:7;s:18:\"commentMemberTasks\";i:8;s:13:\"viewTeamTasks\";i:9;s:13:\"editTeamTasks\";i:10;s:16:\"approveTeamTasks\";i:11;s:16:\"commentTeamTasks\";i:12;s:14:\"viewSquadTasks\";i:13;s:14:\"editSquadTasks\";i:14;s:17:\"approveSquadTasks\";i:15;s:17:\"commentSquadTasks\";i:16;s:19:\"viewDepartmentTasks\";i:17;s:19:\"editDepartmentTasks\";i:18;s:22:\"approveDepartmentTasks\";i:19;s:22:\"commentDepartmentTasks\";i:20;s:13:\"viewTeamGoals\";i:21;s:13:\"editTeamGoals\";i:22;s:16:\"approveTeamGoals\";i:23;s:16:\"commentTeamGoals\";i:24;s:12:\"viewTimeline\";i:25;s:12:\"editTimeline\";i:26;s:15:\"commentTimeline\";}', 1, '2021-03-09 09:10:11', 2, '2021-04-14 11:13:57'),
(2, 'Admin', 'Administrator', 1, 1, 'a:16:{i:0;s:13:\"viewUserGroup\";i:1;s:13:\"editUserGroup\";i:2;s:16:\"viewOrganization\";i:3;s:16:\"editOrganization\";i:4;s:15:\"viewMemberTasks\";i:5;s:15:\"editMemberTasks\";i:6;s:13:\"viewTeamTasks\";i:7;s:13:\"editTeamTasks\";i:8;s:14:\"viewSquadTasks\";i:9;s:14:\"editSquadTasks\";i:10;s:19:\"viewDepartmentTasks\";i:11;s:19:\"editDepartmentTasks\";i:12;s:13:\"viewTeamGoals\";i:13;s:13:\"editTeamGoals\";i:14;s:12:\"viewTimeline\";i:15;s:12:\"editTimeline\";}', 1, NULL, 2, '2021-04-11 21:19:36'),
(3, 'Moderator', 'Moderator', 1, 1, 'a:14:{i:0;s:13:\"viewUserGroup\";i:1;s:13:\"editUserGroup\";i:2;s:16:\"viewOrganization\";i:3;s:16:\"editOrganization\";i:4;s:15:\"viewMemberTasks\";i:5;s:15:\"editMemberTasks\";i:6;s:13:\"viewTeamTasks\";i:7;s:13:\"editTeamTasks\";i:8;s:14:\"viewSquadTasks\";i:9;s:14:\"editSquadTasks\";i:10;s:19:\"viewDepartmentTasks\";i:11;s:19:\"editDepartmentTasks\";i:12;s:13:\"viewTeamGoals\";i:13;s:12:\"viewTimeline\";}', 1, NULL, 2, '2021-04-11 21:19:25'),
(4, 'Director', 'Director', 1, 1, 'a:23:{i:0;s:13:\"viewUserGroup\";i:1;s:16:\"viewOrganization\";i:2;s:15:\"viewMemberTasks\";i:3;s:15:\"editMemberTasks\";i:4;s:18:\"approveMemberTasks\";i:5;s:18:\"commentMemberTasks\";i:6;s:13:\"viewTeamTasks\";i:7;s:13:\"editTeamTasks\";i:8;s:16:\"approveTeamTasks\";i:9;s:16:\"commentTeamTasks\";i:10;s:14:\"viewSquadTasks\";i:11;s:14:\"editSquadTasks\";i:12;s:17:\"approveSquadTasks\";i:13;s:17:\"commentSquadTasks\";i:14;s:19:\"viewDepartmentTasks\";i:15;s:19:\"editDepartmentTasks\";i:16;s:22:\"approveDepartmentTasks\";i:17;s:22:\"commentDepartmentTasks\";i:18;s:13:\"viewTeamGoals\";i:19;s:16:\"approveTeamGoals\";i:20;s:16:\"commentTeamGoals\";i:21;s:12:\"viewTimeline\";i:22;s:15:\"commentTimeline\";}', 1, NULL, 2, '2021-04-11 21:19:01'),
(5, 'Vice Director', 'Vice Director', 1, 1, NULL, 1, NULL, NULL, NULL),
(6, 'Manager', 'Manager', 1, 1, 'a:23:{i:0;s:13:\"viewUserGroup\";i:1;s:16:\"viewOrganization\";i:2;s:15:\"viewMemberTasks\";i:3;s:15:\"editMemberTasks\";i:4;s:18:\"approveMemberTasks\";i:5;s:18:\"commentMemberTasks\";i:6;s:13:\"viewTeamTasks\";i:7;s:13:\"editTeamTasks\";i:8;s:16:\"approveTeamTasks\";i:9;s:16:\"commentTeamTasks\";i:10;s:14:\"viewSquadTasks\";i:11;s:14:\"editSquadTasks\";i:12;s:17:\"approveSquadTasks\";i:13;s:17:\"commentSquadTasks\";i:14;s:19:\"viewDepartmentTasks\";i:15;s:19:\"editDepartmentTasks\";i:16;s:22:\"approveDepartmentTasks\";i:17;s:22:\"commentDepartmentTasks\";i:18;s:13:\"viewTeamGoals\";i:19;s:16:\"approveTeamGoals\";i:20;s:16:\"commentTeamGoals\";i:21;s:12:\"viewTimeline\";i:22;s:15:\"commentTimeline\";}', 1, '2021-03-16 09:21:13', 2, '2021-04-11 21:18:53'),
(7, 'Deputy Manager', 'Deputy Manager', 1, 1, 'a:22:{i:0;s:13:\"viewUserGroup\";i:1;s:16:\"viewOrganization\";i:2;s:15:\"viewMemberTasks\";i:3;s:15:\"editMemberTasks\";i:4;s:18:\"approveMemberTasks\";i:5;s:18:\"commentMemberTasks\";i:6;s:13:\"viewTeamTasks\";i:7;s:13:\"editTeamTasks\";i:8;s:16:\"approveTeamTasks\";i:9;s:16:\"commentTeamTasks\";i:10;s:14:\"viewSquadTasks\";i:11;s:14:\"editSquadTasks\";i:12;s:17:\"approveSquadTasks\";i:13;s:17:\"commentSquadTasks\";i:14;s:19:\"viewDepartmentTasks\";i:15;s:19:\"editDepartmentTasks\";i:16;s:22:\"approveDepartmentTasks\";i:17;s:22:\"commentDepartmentTasks\";i:18;s:13:\"viewTeamGoals\";i:19;s:16:\"commentTeamGoals\";i:20;s:12:\"viewTimeline\";i:21;s:15:\"commentTimeline\";}', 1, '2021-03-16 09:39:13', 2, '2021-04-11 21:18:37'),
(8, 'Team Leader', 'Team Leader', 1, 1, 'a:17:{i:0;s:13:\"viewUserGroup\";i:1;s:16:\"viewOrganization\";i:2;s:15:\"viewMemberTasks\";i:3;s:15:\"editMemberTasks\";i:4;s:18:\"approveMemberTasks\";i:5;s:18:\"commentMemberTasks\";i:6;s:13:\"viewTeamTasks\";i:7;s:13:\"editTeamTasks\";i:8;s:16:\"approveTeamTasks\";i:9;s:16:\"commentTeamTasks\";i:10;s:14:\"viewSquadTasks\";i:11;s:14:\"editSquadTasks\";i:12;s:17:\"commentSquadTasks\";i:13;s:19:\"viewDepartmentTasks\";i:14;s:13:\"viewTeamGoals\";i:15;s:12:\"viewTimeline\";i:16;s:15:\"commentTimeline\";}', 1, '2021-03-16 09:53:23', 2, '2021-04-11 21:17:54'),
(9, 'Deputy Team Leader', 'Deputy Team Leader', 1, 1, 'a:13:{i:0;s:13:\"viewUserGroup\";i:1;s:16:\"viewOrganization\";i:2;s:15:\"viewMemberTasks\";i:3;s:15:\"editMemberTasks\";i:4;s:18:\"commentMemberTasks\";i:5;s:13:\"viewTeamTasks\";i:6;s:16:\"commentTeamTasks\";i:7;s:14:\"viewSquadTasks\";i:8;s:14:\"editSquadTasks\";i:9;s:17:\"commentSquadTasks\";i:10;s:13:\"viewTeamGoals\";i:11;s:12:\"viewTimeline\";i:12;s:15:\"commentTimeline\";}', 1, '2021-03-16 10:09:29', 2, '2021-04-11 21:17:27'),
(10, 'Member', 'Member', 1, 1, 'a:13:{i:0;s:13:\"viewUserGroup\";i:1;s:16:\"viewOrganization\";i:2;s:15:\"viewMemberTasks\";i:3;s:15:\"editMemberTasks\";i:4;s:18:\"commentMemberTasks\";i:5;s:14:\"viewSquadTasks\";i:6;s:14:\"editSquadTasks\";i:7;s:17:\"commentSquadTasks\";i:8;s:22:\"commentDepartmentTasks\";i:9;s:13:\"viewTeamGoals\";i:10;s:16:\"commentTeamGoals\";i:11;s:12:\"viewTimeline\";i:12;s:15:\"commentTimeline\";}', 1, '2021-03-16 10:15:53', 2, '2021-04-14 14:45:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
