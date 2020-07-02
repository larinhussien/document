-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2020 at 05:57 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asd`
--

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id_college` int(11) NOT NULL,
  `name_college` varchar(50) NOT NULL,
  `description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id_college`, `name_college`, `description`) VALUES
(1, 'كلية الامام الكاظم', 'احد كليات الوقف الشيعي ');

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `id_degree` int(11) NOT NULL,
  `degree` int(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`id_degree`, `degree`, `student_id`, `stage_id`, `subject_id`) VALUES
(1, 56, 1, 1, 1),
(2, 67, 2, 1, 1),
(3, 45, 3, 1, 1),
(4, 90, 4, 1, 1),
(5, 100, 5, 1, 1),
(6, 56, 1, 1, 2),
(7, 67, 2, 1, 2),
(8, 45, 3, 1, 2),
(9, 90, 4, 1, 2),
(10, 100, 5, 1, 2),
(11, 56, 1, 1, 3),
(12, 67, 2, 1, 3),
(13, 45, 3, 1, 3),
(14, 90, 4, 1, 3),
(15, 100, 5, 1, 3),
(16, 56, 1, 1, 4),
(17, 67, 2, 1, 4),
(18, 45, 3, 1, 4),
(19, 90, 4, 1, 4),
(20, 100, 5, 1, 4),
(21, 56, 1, 1, 5),
(22, 67, 2, 1, 5),
(23, 45, 3, 1, 5),
(24, 90, 4, 1, 5),
(25, 100, 5, 1, 5),
(26, 56, 1, 2, 6),
(27, 67, 2, 2, 6),
(28, 45, 3, 2, 6),
(29, 90, 4, 2, 6),
(30, 100, 5, 2, 6),
(31, 56, 1, 2, 7),
(32, 67, 2, 2, 7),
(33, 45, 3, 2, 7),
(34, 90, 4, 2, 7),
(35, 100, 5, 2, 7),
(36, 56, 1, 2, 8),
(37, 67, 2, 2, 8),
(38, 45, 3, 2, 8),
(39, 90, 4, 2, 8),
(40, 100, 5, 2, 8),
(41, 56, 1, 2, 9),
(42, 67, 2, 2, 9),
(43, 45, 3, 2, 9),
(44, 90, 4, 2, 9),
(45, 100, 5, 2, 9),
(46, 56, 1, 3, 10),
(47, 67, 2, 3, 10),
(48, 45, 3, 3, 10),
(49, 90, 4, 3, 10),
(50, 100, 5, 3, 10),
(51, 56, 1, 3, 11),
(52, 67, 2, 3, 11),
(53, 45, 3, 3, 11),
(54, 90, 4, 3, 11),
(55, 100, 5, 3, 11),
(56, 56, 1, 3, 12),
(57, 67, 2, 3, 12),
(58, 45, 3, 3, 12),
(59, 90, 4, 3, 12),
(60, 100, 5, 3, 12),
(61, 56, 1, 3, 13),
(62, 67, 2, 3, 13),
(63, 45, 3, 3, 13),
(64, 90, 4, 3, 13),
(65, 100, 5, 3, 13),
(66, 56, 1, 4, 14),
(67, 67, 2, 4, 14),
(68, 45, 3, 4, 14),
(69, 90, 4, 4, 14),
(70, 100, 5, 4, 14),
(71, 56, 1, 4, 15),
(72, 67, 2, 4, 15),
(73, 45, 3, 4, 15),
(74, 90, 4, 4, 15),
(75, 100, 5, 4, 15),
(76, 56, 1, 4, 16),
(77, 67, 2, 4, 16),
(78, 45, 3, 4, 16),
(79, 90, 4, 4, 16),
(80, 100, 5, 4, 16),
(81, 56, 1, 4, 17),
(82, 67, 2, 4, 17),
(83, 45, 3, 4, 17),
(84, 90, 4, 4, 17),
(85, 100, 5, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id_department` int(11) NOT NULL,
  `name_department` varchar(100) NOT NULL,
  `description` varchar(225) NOT NULL,
  `id_college` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id_department`, `name_department`, `description`, `id_college`) VALUES
(1, 'قسم علم النفس ', '	احد اقسام العلوم الانسانيه						', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `name_employee` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(300) NOT NULL,
  `level` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `id_college` int(11) NOT NULL,
  `groub_id` int(11) NOT NULL DEFAULT '0',
  `dep` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `name_employee`, `email`, `password`, `level`, `task_id`, `id_college`, `groub_id`, `dep`) VALUES
(1, '', 'ahmed@gmail.com', '$2y$10$3JFFRPBWQBvWpBRIVMXpeu.zTVc1R6hLbbDutqxZHlXlzSiVMVwFW', 0, 1, 1, 1, 0),
(2, 'ali muhammed jasame', 'ali89@gmail.com', '$2y$10$otPccX0ePFaSzItBHHCVfO5CnVjb1TI5g5N9c944eD.SaDakmS/A.', 0, 1, 1, 0, 0),
(3, 'ahmed ', 'ahmed78@gmail.com', '$2y$10$qo40oGzroLgX/IWthIBXjucF2/YNFneYRPTCRF41T7CbTRBccxJT6', 0, 3, 1, 0, 1),
(4, 'hasam', 'hasam89@gmail.com', '$2y$10$wv5VLAELBfie7pYv.AhGsev3aUvUbdpE0V1WZPr3vYtnwwH2kfiBG', 0, 4, 1, 0, 1),
(5, 'khalad', 'khald78@gmail.com', '$2y$10$piHzg9NS4SeCDxbF5fNq8uJ.QPHtYSiIy6pSsusdKryoMYo8hcpDW', 0, 5, 1, 0, 1),
(6, 'wsam', 'wasam89@gmail.com', '$2y$10$yV6nKeWwlFIO9dtiQm/8w.uw1mdyln0zYHrhqNAyxaHZDO3fA39GS', 0, 6, 1, 0, 1),
(7, 'hussien', 'hussien94@gmail.com', '$2y$10$Zz8n2TVrGRpSfpTNhRYpHuRiuu1CDIbUSPJy..mDxcZk6R.Q/Zs9O', 0, 7, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `stage_id` int(11) NOT NULL,
  `name_stage` varchar(50) NOT NULL,
  `id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`stage_id`, `name_stage`, `id_department`) VALUES
(1, 'frist', 1),
(2, 'second', 1),
(3, 'three', 1),
(4, 'fourth', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `total` int(100) NOT NULL,
  `avarage` int(11) NOT NULL,
  `year` date NOT NULL,
  `id_college` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `full_name`, `total`, `avarage`, `year`, `id_college`, `id_departement`) VALUES
(1, 'احمد حميد ', 390, 56, '0000-00-00', 1, 1),
(2, 'اكرم فرحان', 670, 67, '0000-00-00', 1, 1),
(3, 'حسين سالم', 680, 45, '0000-00-00', 1, 1),
(4, 'حسين عقيل', 487, 90, '0000-00-00', 1, 1),
(5, 'حسين مراد', 467, 100, '0000-00-00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id_subject` int(11) NOT NULL,
  `name_subject` varchar(50) NOT NULL,
  `year` date NOT NULL,
  `stage_id` int(11) NOT NULL,
  `dep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id_subject`, `name_subject`, `year`, `stage_id`, `dep`) VALUES
(1, 'اسس السلوك', '0000-00-00', 1, 1),
(2, 'تطور وراثه السلوك', '0000-00-00', 1, 1),
(3, 'الدوافع', '0000-00-00', 1, 1),
(4, 'الذكاء وقياسيه', '0000-00-00', 1, 1),
(5, 'النسيان', '0000-00-00', 1, 1),
(6, 'علم نفس في النمو', '0000-00-00', 2, 1),
(7, 'العلاقات الاجتماعيه للفرد', '0000-00-00', 2, 1),
(8, 'العلاقات الاجتماعيه للمراهق', '0000-00-00', 2, 1),
(9, 'علم النفس الجنائي', '0000-00-00', 2, 1),
(10, 'العمل والنمو المهني', '0000-00-00', 3, 1),
(11, 'الحياة الاسريه', '0000-00-00', 3, 1),
(12, 'التغير العقلي لدى الفرد', '0000-00-00', 3, 1),
(13, 'التغير العقلي لدى المراهق', '0000-00-00', 3, 1),
(14, 'نظريات تفسير الشيخوخه', '0000-00-00', 4, 1),
(15, 'اضطربات ومعوقات الاتصال', '0000-00-00', 4, 1),
(16, 'النمو العقلي لدى المراهق', '0000-00-00', 4, 1),
(17, 'الادراك الحسي لدى الفرد', '0000-00-00', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `name_task` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id_task`, `name_task`) VALUES
(1, 'all'),
(2, 'nono'),
(3, 'stage_frist'),
(4, 'stage_seconed'),
(5, 'stage_three'),
(6, 'stage_four'),
(7, 'document');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id_college`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id_degree`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `stage_id` (`stage_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_department`),
  ADD KEY `college_id` (`id_college`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `id_college` (`id_college`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`stage_id`),
  ADD KEY `department` (`id_department`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `id_college` (`id_college`),
  ADD KEY `id_departement` (`id_departement`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id_subject`),
  ADD KEY `stage` (`stage_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id_college` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id_degree` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `stage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `degrees`
--
ALTER TABLE `degrees`
  ADD CONSTRAINT `degrees_ibfk_2` FOREIGN KEY (`stage_id`) REFERENCES `stage` (`stage_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `degrees_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id_subject`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student-degree` FOREIGN KEY (`student_id`) REFERENCES `student` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `college_id` FOREIGN KEY (`id_college`) REFERENCES `college` (`id_college`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `id_college` FOREIGN KEY (`id_college`) REFERENCES `college` (`id_college`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id_task`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `department` FOREIGN KEY (`id_department`) REFERENCES `department` (`id_department`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_college`) REFERENCES `college` (`id_college`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`id_departement`) REFERENCES `department` (`id_department`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `stage` FOREIGN KEY (`stage_id`) REFERENCES `stage` (`stage_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
