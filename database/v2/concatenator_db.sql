-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 02:05 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concatenator_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `manager` text NOT NULL,
  `student` text NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `faculty` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `name`, `manager`, `student`, `date`, `time`, `faculty`) VALUES
(1, 'Engineering', '', '23', '2021-10-04', '2021-10-18', ''),
(2, 'Engineering', '', '23', '2021-10-06', '2021-10-04', ''),
(3, 'Faculty of Information communication and Technology', '', '23', '2021-10-05', '2021-09-29', ''),
(4, 'Engineering', '', 'Kasita', '2021-10-14', '2021-10-18', ''),
(6, 'Faculty of Information communication and Technology', '', 'Kasita', '2021-10-19', '2021-10-20', ''),
(7, 'Faculty of Information communication and Technology', '', 'Kasita', '2021-10-20', '2021-10-01', ''),
(8, 'Malibu', 'Angola', 'Kasita', '2021-10-26', '2021-11-01', ''),
(9, 'Faculty of Information communication and Technology', 'a@a.com', 'kasita@gmail.com', '2021-09-29', '2021-10-11', ''),
(10, 'Faculty of Information communication and Technology', 'a@a.com', 'Bank Angola', '2021-10-04', '2021-10-14', ''),
(11, 'Faculty of Information communication and Technology', 'a@a.com', 'kasita@gmail.com', '2021-10-04', '2021-10-14', ''),
(12, 'Faculty of Information communication and Technology', 'a@a.com', 'kasita@gmail.com', '2021-10-19', '2021-10-04', 'Jessica Jessica');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_list`
--

CREATE TABLE `faculty_list` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `dean` text NOT NULL,
  `hod` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_list`
--

INSERT INTO `faculty_list` (`id`, `name`, `dean`, `hod`, `date_created`) VALUES
(5, 'Jessica Jessica', 'ADean Angola', 'Claire Blake', '2021-10-16 07:10:05'),
(9, 'Bank Angola', 'ADean Angola', 'Claire Blake', '2021-10-16 07:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `id` int(30) NOT NULL,
  `project_name` varchar(200) NOT NULL,
  `faculty` text NOT NULL,
  `status` text NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `supervisor` text NOT NULL,
  `student` text NOT NULL,
  `date_created` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `project_name`, `faculty`, `status`, `start_date`, `end_date`, `supervisor`, `student`, `date_created`) VALUES
(4, 'Engineering', 'Jessica Jessica', 'Pending', '2021-09-28', '2021-10-12', 'a@a.com', 'kasita@gmail.com', '2021-10-16 22:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `std_number` text NOT NULL,
  `study_year` text NOT NULL,
  `faculty` text NOT NULL,
  `course` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Workload Management System', 'ium@ium.edu.na', '061 248 112', '21 - 31 Hercules Street, Windhoek, Khomas Region', '');

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `task`, `description`, `status`, `date_created`) VALUES
(1, 1, 'Sample Task 1', '								&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Fusce ullamcorper mattis semper. Nunc vel risus ipsum. Sed maximus dapibus nisl non laoreet. Pellentesque quis mauris odio. Donec fermentum facilisis odio, sit amet aliquet purus scelerisque eget.&amp;nbsp;&lt;/span&gt;													', 3, '2020-12-03 11:08:58'),
(2, 1, 'Sample Task 2', 'Sample Task 2							', 1, '2020-12-03 13:50:15'),
(3, 2, 'Task Test', 'Sample', 1, '2020-12-03 13:52:25'),
(4, 2, 'test 23', 'Sample test 23', 1, '2020-12-03 13:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`) VALUES
(1, 'Administrator', '', 'admin@admin.com', '61646d696e313233', 1, 'no-image-available.png', '2020-11-26 10:57:04'),
(2, 'John', 'Smith', 'jsmith@sample.com', '1254737c076cf867dc53d60a0364f38e', 2, '1606978560_avatar.jpg', '2020-12-03 09:26:03'),
(3, 'Claire', 'Blake', 'cblake@sample.com', '4744ddea876b11dcb1d169fadf494418', 3, '1606958760_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg', '2020-12-03 09:26:42'),
(4, 'George', 'Wilson', 'gwilson@sample.com', 'd40242fb23c45206fadee4e2418f274f', 3, '1606963560_avatar.jpg', '2020-12-03 10:46:41'),
(5, 'Mike', 'Williams', 'mwilliams@sample.com', '3cc93e9a6741d8b40460457139cf8ced', 3, '1606963620_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg', '2020-12-03 10:47:06'),
(6, 'Bank', 'Angola', 'isabella@bellaross.com', 'e10adc3949ba59abbe56e057f20f883e', 3, 'no-image-available.png', '2021-10-16 03:52:28'),
(7, 'Jessica', 'Angola', 'pppp@bellaross.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 'no-image-available.png', '2021-10-16 03:56:13'),
(8, 'Theron', 'Kasita', 'kasita@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'no-image-available.png', '2021-10-16 03:57:24'),
(9, 'Bank', 'Angola', 'isabellna@bellaross.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'no-image-available.png', '2021-10-16 03:59:37'),
(10, 'Bank', 'Angola', 'isabellall@bellaross.com', 'c5fe25896e49ddfe996db7508cf00534', 1, 'no-image-available.png', '2021-10-16 04:16:04'),
(11, 'Bank', 'Angola', 'l@bellaross.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2021-10-16 04:17:43'),
(12, 'Bank', 'Angola', 'isabella@bellaross.com', '123', 1, 'Products/p20211016111129am.jpg', '2021-10-16 11:10:29'),
(13, 'Bank', 'Angola', 'isabella@bellaross.com', '35303530', 1, 'Products/p20211016111530am.jpg', '2021-10-16 11:10:30'),
(14, 'Andre', 'Angola', 'isabella@bellaross.com', '32303230', 0, 'Products/p20211016111616am.jpg', '2021-10-16 11:10:16'),
(15, 'Iyaloo', 'Angola', 'isabella@bellaross.com', '3232323232', 1, 'Products/p20211016111748am.jpg', '2021-10-16 11:10:48'),
(16, 'Money', 'Angola', 'isabella@bellaross.com', '323232', 1, 'Products/p20211016112018am.jpg', '2021-10-16 11:10:18'),
(17, 'Money', 'Angola', 'isabella@bellaross.com', '323232', 1, 'Products/p20211016112031am.jpg', '2021-10-16 11:10:31'),
(18, 'Money', 'Kasita', 'theronkasita@gmail.com', '313233', 0, 'Products/p20211016112200am.jpg', '2021-10-16 11:10:00'),
(19, 'AAAA', 'Angola', 'isabella@bellaross.com', '313233', 1, 'Products/p20211016112245am.jpg', '2021-10-16 11:10:45'),
(20, 'bbbb', 'Angola', 'isabella@bellaross.com', '313233', 2, 'Products/p20211016112318am.jpg', '2021-10-16 11:10:18'),
(21, 'AAABank', 'Angola', 'isabellal@bellaross.com', '30303030', 2, 'Products/p20211016114157am.jpg', '2021-10-16 11:10:57'),
(22, 'ADean', 'Angola', 'isabella@bellaross.com', '333333', 2, 'Products/p20211016114403am.jpg', '2021-10-16 11:10:03'),
(23, 'Theron', 'Kasita', 'kasita@gmail.com', '3132333435', 5, 'Products/p20211016100811pm.jpg', '2021-10-16 10:10:11'),
(24, 'Bank', 'Angola', 'a@a.com', '3132333435', 4, 'Products/p20211016100910pm.jpg', '2021-10-16 10:10:10'),
(25, 'Theron', 'Natangwe', 'theron@nust.com', '3132333435', 4, 'Products/p20211017045216am.jpg', '2021-10-17 04:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_productivity`
--

CREATE TABLE `user_productivity` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_productivity`
--

INSERT INTO `user_productivity` (`id`, `project_id`, `task_id`, `comment`, `subject`, `date`, `start_time`, `end_time`, `user_id`, `time_rendered`, `date_created`) VALUES
(1, 1, 1, '							&lt;p&gt;Sample Progress&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Test 1&lt;/li&gt;&lt;li&gt;Test 2&lt;/li&gt;&lt;li&gt;Test 3&lt;/li&gt;&lt;/ul&gt;																			', 'Sample Progress', '2020-12-03', '08:00:00', '10:00:00', 1, 2, '2020-12-03 12:13:28'),
(2, 1, 1, '							Sample Progress						', 'Sample Progress 2', '2020-12-03', '13:00:00', '14:00:00', 1, 1, '2020-12-03 13:48:28'),
(3, 1, 2, '							Sample						', 'Test', '2020-12-03', '08:00:00', '09:00:00', 5, 1, '2020-12-03 13:57:22'),
(4, 1, 2, 'asdasdasd', 'Sample Progress', '2020-12-02', '08:00:00', '10:00:00', 2, 2, '2020-12-03 14:36:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_list`
--
ALTER TABLE `faculty_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_productivity`
--
ALTER TABLE `user_productivity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faculty_list`
--
ALTER TABLE `faculty_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_productivity`
--
ALTER TABLE `user_productivity`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
