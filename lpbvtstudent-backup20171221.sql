-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2017 at 01:45 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpbvtstudent`
--
DROP DATABASE IF EXISTS `lpbvtstudent`;
CREATE DATABASE IF NOT EXISTS `lpbvtstudent` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lpbvtstudent`;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

DROP TABLE IF EXISTS `degree`;
CREATE TABLE IF NOT EXISTS `degree` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `degree` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `degree`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

DROP TABLE IF EXISTS `majors`;
CREATE TABLE IF NOT EXISTS `majors` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ma_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `majors_dept_id_foreign` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_08_07_041326_create_department_table', 1),
(2, '2017_08_07_061518_create_subjects_table', 1),
(3, '2017_08_07_070508_create_teachers_table', 1),
(4, '2017_08_07_093010_create_majors_table', 1),
(5, '2017_08_07_112319_create_degree_table', 1),
(6, '2017_08_07_112320_create_students_table', 1),
(7, '2017_08_07_201523_create_sub_teach_table', 1),
(8, '2017_08_23_013753_create_major_subject_table', 1),
(9, '2017_08_23_023534_create_register_table', 1),
(10, '2017_08_23_023824_create_upgrade_table', 1),
(11, '2017_08_29_043534_create_tech_score_table', 1),
(12, '2017_08_31_214805_create_users_table', 1),
(13, '2017_08_31_214806_entrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'ເບິ່ງຂໍ້ມູນສິດທິຜູ້ໃຊ້ລະບົບ', 'Show Role', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(2, 'role-create', 'ເພີ່ມສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ', 'Add Role', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(3, 'role-edit', 'ແກ້ໄຂສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ', 'Edit Role', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(4, 'role-delete', 'ລົບສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ', 'Delete Role', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(5, 'user-list', 'ເບິ່ງຂໍ້ມູນຜູ້ໃຊ້ລະບົບທັງໝົດ', 'Show User', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(6, 'user-create', 'ເພີ່ມຂໍ້ມູນຜູ້ເຂົ້າໃຊ້ລະບົບ', 'Add User', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(7, 'user-edit', 'ແກ້ໄຂຂໍ້ມູນຜູ້ເຂົ້າໃຊ້ລະບົບ', 'Edit User', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(8, 'user-delete', 'ລົບຂໍ້ມູນຜູ້ເຂົ້າໃຊ້ລະບົບ', 'Delete User', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(9, 'student-list', 'ເບິ່ງຂໍ້ມູນນັກສຶກສາ', 'Show Student', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(10, 'student-create', 'ເພີ່ມຂໍ້ມູນນັກສຶກສາ', 'Add Student', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(11, 'student-edit', 'ແກ້ໄຂຂໍ້ມູນນັກສຶກສາ', 'Edit Student', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(12, 'student-delete', 'ລົບຂໍ້ມູນນັກສຶກສາ', 'Delete Student', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(13, 'teacher-list', 'ເບິ່ງຂໍ້ມູນອາຈານ', 'Show Teacher', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(14, 'teacher-create', 'ເພີ່ມຂໍ້ມູນອາຈານ', 'Add Teacher', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(15, 'teacher-edit', 'ແກ້ໄຂຂໍ້ມູນອາຈານ', 'Edit Teacher', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(16, 'teacher-delete', 'ລົບຂໍ້ມູນອາຈານ', 'Delete Teacher', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(17, 'dept-list', 'ເບິ່ງຂໍ້ມູນພາກວິຊາ', 'Show Department', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(18, 'dept-create', 'ເພີ່ມຂໍ້ມູນພາກວິຊາ', 'Add Department', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(19, 'dept-edit', 'ແກ້ໄຂຂໍ້ມູນພາກວິຊາ', 'Edit Department', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(20, 'dept-delete', 'ລົບຂໍ້ມູນພາກວິຊາ', 'Delete Department', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(21, 'major-list', 'ເບິ່ງຂໍ້ມູນສາຂາວິຊາ', 'Show Major', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(22, 'major-create', 'ເພີ່ມຂໍ້ມູນສາຂາວິຊາ', 'Add Major', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(23, 'major-edit', 'ແກ້ໄຂຂໍ້ມູນສາຂາວິຊາ', 'Edit Major', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(24, 'major-delete', 'ລົບຂໍ້ມູນສາຂາວິຊາ', 'Delete Major', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(25, 'subject-list', 'ເບິ່ງຂໍ້ມູນລາຍວິຊາ', 'Show Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(26, 'subject-create', 'ເພີ່ມຂໍ້ມູນລາຍວິຊາ', 'Add Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(27, 'subject-edit', 'ແກ້ໄຂຂໍ້ມູນລາຍວິຊາ', 'Edit Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(28, 'subject-delete', 'ລົບຂໍ້ມູນລາຍວິຊາ', 'Delete Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(29, 'degree-list', 'ເບິ່ງຂໍ້ມູນລະບົບການຮຽນ', 'Show Degree', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(30, 'degree-create', 'ເພີ່ມຂໍ້ມູນລະບົບການຮຽນ', 'Add Degree', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(31, 'degree-edit', 'ແກ້ໄຂຂໍ້ມູນລະບົບການຮຽນ', 'Edit Degree', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(32, 'degree-delete', 'ລົບຂໍ້ມູນລະບົບການຮຽນ', 'Delete Degree', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(33, 'course-list', 'ເບິ່ງຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ', 'Show Course', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(34, 'course-create', 'ເພີ່ມຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ', 'Add Course', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(35, 'course-edit', 'ແກ້ໄຂຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ', 'Edit Course', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(36, 'course-delete', 'ລົບຂໍ້ມູນຫລັກສູດການຮຽນ-ການສອນ', 'Delete Course', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(37, 'teacher-subject-list', 'ເບິ່ງຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ', 'Show Teacher With Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(38, 'teacher-subject-create', 'ເພີ່ມຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ', 'Add Teacher With Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(39, 'teacher-subject-edit', 'ແກ້ໄຂຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ', 'Edit Teacher With Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(40, 'teacher-subject-delete', 'ລົບຂໍ້ມູນອາຈານສອນ - ວິຊາສອນ', 'Delete Teacher With Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(41, 'register-list', 'ເບິ່ງຂໍ້ມູນລົງທະບຽນຮຽນ', 'Show Register', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(42, 'register-create', 'ເພີ່ມຂໍ້ມູນລົງທະບຽນຮຽນ', 'Add Register', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(43, 'register-edit', 'ແກ້ໄຂຂໍ້ມູນລົງທະບຽນຮຽນ', 'Edit Register', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(44, 'register-delete', 'ລົບຂໍ້ມູນລົງທະບຽນຮຽນ', 'Delete Register', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(45, 'upgrade-list', 'ເບິ່ງຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ', 'Show Register Upgrade', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(46, 'upgrade-create', 'ເພີ່ມຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ', 'Add Register Upgrade', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(47, 'upgrade-edit', 'ແກ້ໄຂຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ', 'Edit Register Upgrade', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(48, 'upgrade-delete', 'ລົບຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ', 'Delete Register Upgrade', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(49, 'manage-teacher-subject', 'ຈັດການວິຊາສອນໃຫ້ອາຈານ', 'Show Manage Teacher To Subject', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(50, 'real-score', 'ຈັດການຂໍ້ມູນຄະແນນ', 'Show Score', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(51, 'upgrade-score', 'ຈັດການຂໍ້ມູນຄະແນນແກ້ເກຣດ', 'Show Upgrade Score', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(52, 'report-student', 'ລາຍງານຂໍ້ມູນນັກສຶກສາ', 'Report Student', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(53, 'report-register', 'ລາຍງານຂໍ້ມູນລົງທະບຽນຮຽນ', 'Report Register', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(54, 'report-upgrade', 'ລາຍງານການລົງທະບຽນແກ້ເກຣດ', 'Report Register Upgrade', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(55, 'report-grade', 'ລາຍງານຂໍ້ມູນຜົນການຮຽນ', 'Report Grade', '2017-11-04 14:41:30', '2017-11-04 14:41:30'),
(56, 'report-score', 'ລາຍງານໃບຄະແນນ', 'Report Score', '2017-11-04 14:41:30', '2017-11-04 14:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(4) UNSIGNED NOT NULL,
  `role_id` int(4) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `rg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rg_date` datetime NOT NULL,
  `rg_studyyear` int(11) NOT NULL,
  `rg_classno` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rg_paiddate` date DEFAULT NULL,
  `rg_recieptno` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rg_academicyear` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rg_id`),
  KEY `register_st_id_foreign` (`st_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Administrator', 'Can access to all policy', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(4) UNSIGNED NOT NULL,
  `role_id` int(4) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `st_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_fname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_gender` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_bdate` date NOT NULL,
  `st_bvillage` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_bdistrict` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_bprovince` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_nationality` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_region` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_pvillage` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_pdistrict` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_pprovince` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gr_fname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gr_lname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gr_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gr_gender` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_id` int(10) UNSIGNED NOT NULL,
  `de_id` int(10) UNSIGNED NOT NULL,
  `st_registerdate` year(4) NOT NULL,
  `st_status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`st_id`),
  KEY `students_ma_id_foreign` (`ma_id`),
  KEY `students_de_id_foreign` (`de_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sub_id` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_credit` int(11) NOT NULL,
  `sub_unit1` int(11) NULL DEFAULT NULL,
  `sub_unit2` int(11) NULL DEFAULT NULL,
  `sub_unit3` int(11) NULL DEFAULT NULL,
  `sub_hour` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

-- --------------------------------------------------------

--
-- Table structure for table `sub_major`
--

DROP TABLE IF EXISTS `sub_major`;
CREATE TABLE IF NOT EXISTS `sub_major` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `term` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_id` int(10) UNSIGNED NOT NULL,
  `subb_id` int(10) UNSIGNED NOT NULL,
  `de_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_major_ma_id_foreign` (`ma_id`),
  KEY `sub_major_subb_id_foreign` (`subb_id`),
  KEY `sub_major_de_id_foreign` (`de_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_major`
--

-- --------------------------------------------------------

--
-- Table structure for table `sub_teach`
--

DROP TABLE IF EXISTS `sub_teach`;
CREATE TABLE IF NOT EXISTS `sub_teach` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `te_id` int(10) UNSIGNED DEFAULT NULL,
  `subb_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_teach_te_id_foreign` (`te_id`),
  KEY `sub_teach_subb_id_foreign` (`subb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_teach`
--

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `te_firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `te_lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `te_gender` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `te_nationality` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `te_Region` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `te_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `te_major` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `te_degree` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teachers_dept_id_foreign` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

-- --------------------------------------------------------

--
-- Table structure for table `teach_score`
--

DROP TABLE IF EXISTS `teach_score`;
CREATE TABLE IF NOT EXISTS `teach_score` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `score_real` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_upgrade` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_id` int(10) UNSIGNED DEFAULT NULL,
  `upg_id` int(10) UNSIGNED DEFAULT NULL,
  `te_id` int(10) UNSIGNED DEFAULT NULL,
  `subb_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teach_score_reg_id_foreign` (`reg_id`),
  KEY `teach_score_upg_id_foreign` (`upg_id`),
  KEY `teach_score_te_id_foreign` (`te_id`),
  KEY `teach_score_subb_id_foreign` (`subb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teach_score`
--

-- --------------------------------------------------------

--
-- Table structure for table `upgrade`
--

DROP TABLE IF EXISTS `upgrade`;
CREATE TABLE IF NOT EXISTS `upgrade` (
  `ug_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ug_paiddate` date NOT NULL,
  `ug_recieptno` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnt` int(3) NOT NULL,
  `st_id` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ug_id`),
  KEY `upgrade_st_id_foreign` (`st_id`),
  KEY `upgrade_subj_id_foreign` (`subj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upgrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `te_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_te_id_foreign` (`te_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `last_login`, `te_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$rEKRdDzY2HL7DC7.f0PguOlH0LtFakaXcNUyrzdCFnmwuVy9Y7oJ.', '2017-12-21 07:15:12', NULL, 'ITxFb1nKE8gC7fSkfye9e4KWqBwQTELnMI0AsxmtAgwvkHKyjufb8W093n82', NULL, '2017-12-21 00:15:12');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `majors_dept_id_foreign` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_st_id_foreign` FOREIGN KEY (`st_id`) REFERENCES `students` (`st_id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_de_id_foreign` FOREIGN KEY (`de_id`) REFERENCES `degree` (`id`),
  ADD CONSTRAINT `students_ma_id_foreign` FOREIGN KEY (`ma_id`) REFERENCES `majors` (`id`);

--
-- Constraints for table `sub_major`
--
ALTER TABLE `sub_major`
  ADD CONSTRAINT `sub_major_de_id_foreign` FOREIGN KEY (`de_id`) REFERENCES `degree` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_major_ma_id_foreign` FOREIGN KEY (`ma_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_major_subb_id_foreign` FOREIGN KEY (`subb_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_teach`
--
ALTER TABLE `sub_teach`
  ADD CONSTRAINT `sub_teach_subb_id_foreign` FOREIGN KEY (`subb_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_teach_te_id_foreign` FOREIGN KEY (`te_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_dept_id_foreign` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `teach_score`
--
ALTER TABLE `teach_score`
  ADD CONSTRAINT `teach_score_reg_id_foreign` FOREIGN KEY (`reg_id`) REFERENCES `register` (`rg_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teach_score_subb_id_foreign` FOREIGN KEY (`subb_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teach_score_te_id_foreign` FOREIGN KEY (`te_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teach_score_upg_id_foreign` FOREIGN KEY (`upg_id`) REFERENCES `upgrade` (`ug_id`) ON DELETE CASCADE;

--
-- Constraints for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD CONSTRAINT `upgrade_st_id_foreign` FOREIGN KEY (`st_id`) REFERENCES `students` (`st_id`),
  ADD CONSTRAINT `upgrade_subj_id_foreign` FOREIGN KEY (`subj_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_te_id_foreign` FOREIGN KEY (`te_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
