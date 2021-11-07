-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 08:54 AM
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
-- Database: `madrassa`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `GR_no` int(10) NOT NULL,
  `date_` date NOT NULL,
  `attendance` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `GR_no`, `date_`, `attendance`) VALUES
(16, 1, '2021-01-27', 'حاضر'),
(17, 2, '2021-01-27', 'چھٹی پر'),
(18, 3, '2021-01-27', 'غیر حاضر'),
(19, 1, '2021-01-26', 'حاضر'),
(20, 2, '2021-01-26', 'چھٹی پر'),
(21, 3, '2021-01-26', 'غیر حاضر'),
(22, 1, '2021-01-25', 'حاضر'),
(23, 2, '2021-01-25', 'حاضر'),
(24, 3, '2021-01-25', 'حاضر'),
(25, 1, '2021-02-09', 'چھٹی پر'),
(26, 2, '2021-02-09', 'حاضر'),
(27, 3, '2021-02-09', 'غیر حاضر'),
(28, 4, '2021-02-09', 'حاضر'),
(29, 5, '2021-02-09', 'حاضر');

-- --------------------------------------------------------

--
-- Table structure for table `current_month`
--

CREATE TABLE `current_month` (
  `ID` int(11) DEFAULT NULL,
  `month_` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_month`
--

INSERT INTO `current_month` (`ID`, `month_`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `examination`
--

CREATE TABLE `examination` (
  `id` int(11) NOT NULL,
  `GR_no` int(11) NOT NULL,
  `exam_number` int(11) DEFAULT NULL,
  `date_of_exam` date DEFAULT NULL,
  `teacher_name` varchar(50) DEFAULT NULL,
  `performance` varchar(50) DEFAULT NULL,
  `quran_total` int(11) DEFAULT NULL,
  `quran_get` int(11) DEFAULT NULL,
  `emaniat_total` int(11) DEFAULT NULL,
  `emaniat_get` int(11) DEFAULT NULL,
  `hadees_total` int(11) DEFAULT NULL,
  `hadees_get` int(11) DEFAULT NULL,
  `ikhlaq_total` int(11) DEFAULT NULL,
  `ikhlaq_get` int(11) DEFAULT NULL,
  `lang_total` int(11) DEFAULT NULL,
  `lang_get` int(11) DEFAULT NULL,
  `namaz_total` int(11) DEFAULT NULL,
  `namaz_get` int(11) DEFAULT NULL,
  `attend_total` int(11) DEFAULT NULL,
  `attend_get` int(11) DEFAULT NULL,
  `total_class` int(11) DEFAULT NULL,
  `student_percent` int(11) DEFAULT NULL,
  `student_absent` int(11) DEFAULT NULL,
  `percent` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examination`
--

INSERT INTO `examination` (`id`, `GR_no`, `exam_number`, `date_of_exam`, `teacher_name`, `performance`, `quran_total`, `quran_get`, `emaniat_total`, `emaniat_get`, `hadees_total`, `hadees_get`, `ikhlaq_total`, `ikhlaq_get`, `lang_total`, `lang_get`, `namaz_total`, `namaz_get`, `attend_total`, `attend_get`, `total_class`, `student_percent`, `student_absent`, `percent`) VALUES
(38, 1, 3, '2021-01-27', 'محمد ارسلان', 'بہتر', 100, 90, 20, 15, 20, 18, 20, 10, 20, 16, 10, 5, 10, 10, 3, 3, 0, 0),
(39, 3, 3, '2021-01-27', 'محمد ارسلان', 'بہتر', 100, 90, 20, 10, 20, 18, 20, 16, 20, 12, 10, 10, 10, 0, 3, 1, 2, 78);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fee_id` int(10) NOT NULL,
  `GR_no` int(10) NOT NULL,
  `date_of_submit` date NOT NULL,
  `fee_month` int(11) NOT NULL,
  `fee_year` int(11) NOT NULL,
  `monthly_fees` int(11) NOT NULL,
  `yearly_fees` int(11) DEFAULT NULL,
  `remianing` int(11) DEFAULT NULL,
  `challan` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `recieved` int(11) DEFAULT NULL,
  `status_` varchar(10) DEFAULT NULL,
  `transaction_id` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`fee_id`, `GR_no`, `date_of_submit`, `fee_month`, `fee_year`, `monthly_fees`, `yearly_fees`, `remianing`, `challan`, `total`, `discount`, `recieved`, `status_`, `transaction_id`) VALUES
(2, 2, '0000-00-00', 1, 2021, 300, 0, 0, 0, 300, 0, 300, 'paid', NULL),
(5, 2, '2021-02-01', 2, 2021, 0, 0, 0, 0, 0, 0, 0, 'unpaid', NULL),
(6, 3, '2021-02-02', 2, 2021, 300, 0, 0, 0, 300, 0, 300, 'paid', '5'),
(7, 4, '2021-02-09', 2, 2021, 300, 0, 0, 0, 0, 0, 0, 'unpaid', NULL),
(8, 5, '2021-02-09', 2, 2021, 300, 0, 0, 0, 0, 0, 0, 'unpaid', NULL),
(9, 4, '2021-02-09', 1, 2020, 300, 0, 0, 0, 200, 100, 100, 'paid', '8');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(20) NOT NULL,
  `datetime_` datetime NOT NULL,
  `type` varchar(10) NOT NULL,
  `details` varchar(100) NOT NULL,
  `DR` float NOT NULL,
  `CR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `datetime_`, `type`, `details`, `DR`, `CR`) VALUES
(1, '2021-01-31 09:29:20', 'S', 'نتخواہ کی ادائیگی', 0, 5000),
(2, '2021-02-02 00:15:00', 'D', 'ھکجھکج', 0, 0),
(3, '2021-02-02 00:15:00', 'D', 'ھکجھکج', 5000, 0),
(4, '2021-02-02 00:17:00', 'D', 'kjbhkj', 0, 2000),
(6, '2021-02-09 11:17:00', 'D', 'kharcha', 0, 1000),
(7, '2021-02-09 11:18:00', 'F', 'fees', 300, 0),
(8, '2021-02-09 07:58:08', 'FF', 'فیس کی وصولی', 100, 0),
(9, '2021-02-09 12:02:00', 'F', 'مسرور', 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `remaining`
--

CREATE TABLE `remaining` (
  `ID` int(11) NOT NULL,
  `GR_no` int(11) NOT NULL,
  `remaning_balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remaining`
--

INSERT INTO `remaining` (`ID`, `GR_no`, `remaning_balance`) VALUES
(9, 1, 0),
(10, 2, 0),
(11, 3, 0),
(12, 4, 100),
(13, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `remaining_salary`
--

CREATE TABLE `remaining_salary` (
  `ID` int(11) NOT NULL,
  `GR_no` int(11) NOT NULL,
  `remaining_balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remaining_salary`
--

INSERT INTO `remaining_salary` (`ID`, `GR_no`, `remaining_balance`) VALUES
(1, 1, -5000),
(2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `fee_id` int(10) NOT NULL,
  `GR_no` int(10) NOT NULL,
  `date_of_submit` date NOT NULL,
  `fee_month` int(11) NOT NULL,
  `fee_year` int(11) NOT NULL,
  `monthly_salary` int(11) NOT NULL,
  `previous_remaining` int(11) DEFAULT NULL,
  `bonus` int(11) DEFAULT NULL,
  `already_recieved` int(11) DEFAULT NULL,
  `present` int(11) DEFAULT NULL,
  `cut` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `recieved` int(11) DEFAULT NULL,
  `status_` varchar(10) DEFAULT NULL,
  `transaction_id` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`fee_id`, `GR_no`, `date_of_submit`, `fee_month`, `fee_year`, `monthly_salary`, `previous_remaining`, `bonus`, `already_recieved`, `present`, `cut`, `total`, `recieved`, `status_`, `transaction_id`) VALUES
(1, 1, '0000-00-00', 12, 2020, 5000, 0, 0, 1000, 31, 0, 4000, 3000, 'paid', NULL),
(2, 1, '0000-00-00', 1, 2021, 300, 0, 0, 0, 0, 0, 0, 5000, 'paid', NULL),
(4, 2, '2021-02-01', 3, 2021, 5000, 950, 0, 0, 0, 0, 5950, 5000, 'paid', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `GR_no` int(10) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `gender_g` varchar(10) NOT NULL,
  `disability` varchar(50) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `sir_name` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_admission` date NOT NULL,
  `monthly_fees` int(11) NOT NULL,
  `complete_address` varchar(50) NOT NULL,
  `CNIC` varchar(13) NOT NULL,
  `contact_office` varchar(11) NOT NULL,
  `contact_home` varchar(11) DEFAULT NULL,
  `qualification` varchar(50) DEFAULT NULL,
  `last_school_name` varchar(50) DEFAULT NULL,
  `last_school_address` varchar(50) DEFAULT NULL,
  `reason_for_leave_school` varchar(50) DEFAULT NULL,
  `class` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `time_for_study` varchar(30) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`GR_no`, `student_name`, `gender_g`, `disability`, `father_name`, `sir_name`, `date_of_birth`, `date_of_admission`, `monthly_fees`, `complete_address`, `CNIC`, `contact_office`, `contact_home`, `qualification`, `last_school_name`, `last_school_address`, `reason_for_leave_school`, `class`, `department`, `occupation`, `time_for_study`, `image_name`, `discount`) VALUES
(1, 'محمد اویس', 'لڑکا', 'کوئی نہیں', 'محمد رفیق', 'رحمانی', '2021-01-26', '2021-01-26', 300, 'تاج مسجد گولیمار نوابشاہ', '4540266207031', '03058214945', '0', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'اول', 'حافظ', 'کاروبار', 'بعد از فجر', '1.jpeg', 50),
(2, 'محمد ارسلان', 'لڑکا', 'کوئی نہیں', 'محمد افضل', 'آرائیں', '2021-01-26', '2021-01-26', 300, 'تاج مسجد گولیمار نوابشاہ', '4540266207031', '03058214945', '0', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'اول', 'حافظ', 'کاروبار', 'بعد از فجر', '2.jpg', 0),
(3, 'محمد ارسلان', 'لڑکا', 'کوئی نہیں', 'محمد افضل', 'رحمانی', '2021-01-27', '2021-01-27', 300, 'تاج مسجد گولیمار نوابشاہ', '4540266207031', '03009808899', '0', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'اول', 'حافظ', 'کاروبار', 'بعد از فجر', '3.jpg', 0),
(4, 'زین العابدین فیض', 'لڑکا', 'کوئی نہیں', 'قاری عبداللہ فیض', 'مغل', '2015-02-25', '2021-02-09', 300, 'نزد ختم نبوت چوک تاج اعظم کالونی نواب شاہ', '4540208881247', '03009808899', '03219808899', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'اول', 'ناظرہ بنین', 'درس و تدریس', 'بعد از مغرب', '4.jpg', 100),
(5, 'عائشہ', 'لڑکی', 'کوئی نہیں', 'قاری حفیظ اللہ', 'عباسی', '2016-12-30', '2021-02-09', 300, 'نزد تاج مسجد کمالہ کالونی نواب شاہ', '4540266207031', '03335486998', '03153738899', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'کوئی نہیں', 'اول', 'ناظرہ بنات', 'درس و تدریس', 'بعد از فجر', '5.jpg', 200);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `GR_no` int(10) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `gender_g` varchar(10) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `sir_name` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_admission` date NOT NULL,
  `monthly_salary` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `complete_address` varchar(50) NOT NULL,
  `CNIC` varchar(15) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `image_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`GR_no`, `teacher_name`, `gender_g`, `father_name`, `sir_name`, `date_of_birth`, `date_of_admission`, `monthly_salary`, `designation`, `complete_address`, `CNIC`, `contact`, `qualification`, `image_name`) VALUES
(1, 'محمد ارسلان', 'مرد', 'محمد افضل', 'آرائیں', '2020-12-20', '2020-12-20', 5000, 'کمپیوٹر آپریٹر', 'تاج مسجد گولیمار نوابشاہ', '2147483647', '2147483647', 'ائ ٹی پروفیشنل', '1.jpg'),
(2, 'محمد ارسلان', 'مرد', 'محمد افضل', 'آرائیں', '2021-01-12', '2021-01-13', 5000, 'کمپیوٹر آپریٹر', 'نوابشاہ', '4540266207031', '03059265478', '', '2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `GR_no` (`GR_no`);

--
-- Indexes for table `examination`
--
ALTER TABLE `examination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `GR_no` (`GR_no`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `GR_no` (`GR_no`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remaining`
--
ALTER TABLE `remaining`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GR_no` (`GR_no`);

--
-- Indexes for table `remaining_salary`
--
ALTER TABLE `remaining_salary`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GR_no` (`GR_no`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `GR_no` (`GR_no`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`GR_no`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`GR_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `examination`
--
ALTER TABLE `examination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `remaining`
--
ALTER TABLE `remaining`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `remaining_salary`
--
ALTER TABLE `remaining_salary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `fee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `GR_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `GR_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`GR_no`) REFERENCES `students` (`GR_no`);

--
-- Constraints for table `examination`
--
ALTER TABLE `examination`
  ADD CONSTRAINT `examination_ibfk_1` FOREIGN KEY (`GR_no`) REFERENCES `students` (`GR_no`);

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`GR_no`) REFERENCES `students` (`GR_no`);

--
-- Constraints for table `remaining`
--
ALTER TABLE `remaining`
  ADD CONSTRAINT `remaining_ibfk_1` FOREIGN KEY (`GR_no`) REFERENCES `students` (`GR_no`);

--
-- Constraints for table `remaining_salary`
--
ALTER TABLE `remaining_salary`
  ADD CONSTRAINT `remaining_salary_ibfk_1` FOREIGN KEY (`GR_no`) REFERENCES `teachers` (`GR_no`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`GR_no`) REFERENCES `teachers` (`GR_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
