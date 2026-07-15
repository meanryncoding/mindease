-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2026 at 11:47 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mindease`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `phq9_score` tinyint DEFAULT '0',
  `gad7_score` tinyint DEFAULT '0',
  `pss4_score` tinyint DEFAULT '0',
  `depression_level` varchar(30) DEFAULT NULL,
  `anxiety_level` varchar(30) DEFAULT NULL,
  `stress_level` varchar(30) DEFAULT NULL,
  `overall_risk` varchar(30) DEFAULT NULL,
  `is_flagged` tinyint DEFAULT '0',
  `crisis_trigger` tinyint DEFAULT '0',
  `status` int DEFAULT '1',
  `submitted_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `user_id`, `phq9_score`, `gad7_score`, `pss4_score`, `depression_level`, `anxiety_level`, `stress_level`, `overall_risk`, `is_flagged`, `crisis_trigger`, `status`, `submitted_at`, `created`) VALUES
(1, 1, 10, 7, 8, 'moderate', 'mild', 'moderate', 'critical', 1, 1, 1, '2026-06-20 20:08:53', '2026-06-20 12:08:53'),
(2, 3, 13, 11, 10, 'moderate', 'moderate', 'high', 'critical', 1, 1, 1, '2026-06-21 22:24:57', '2026-06-21 14:24:57'),
(3, 3, 2, 2, 2, 'minimal', 'minimal', 'low', 'low', 0, 0, 1, '2026-06-22 07:20:04', '2026-06-21 23:20:04'),
(4, 3, 16, 12, 12, 'moderately_severe', 'moderate', 'high', 'high', 1, 0, 1, '2026-06-22 11:15:24', '2026-06-22 03:15:24'),
(5, 3, 9, 7, 3, 'mild', 'mild', 'low', 'mild', 0, 0, 1, '2026-07-11 15:31:03', '2026-07-11 07:31:03'),
(6, 3, 9, 4, 6, 'mild', 'minimal', 'moderate', 'critical', 1, 1, 1, '2026-07-11 22:57:26', '2026-07-11 14:57:26'),
(7, 3, 12, 4, 4, 'moderate', 'minimal', 'low', 'critical', 1, 1, 1, '2026-07-13 13:35:27', '2026-07-13 05:35:27'),
(8, 3, 0, 0, 0, 'minimal', 'minimal', 'low', 'low', 0, 0, 1, '2026-07-14 11:23:32', '2026-07-14 03:23:32'),
(9, 6, 4, 9, 1, 'minimal', 'mild', 'low', 'mild', 0, 0, 1, '2026-07-15 08:30:37', '2026-07-15 00:30:37'),
(10, 3, 5, 3, 2, 'mild', 'minimal', 'low', 'critical', 1, 1, 1, '2026-07-15 11:35:10', '2026-07-15 03:35:10'),
(11, 6, 4, 3, 2, 'minimal', 'minimal', 'low', 'low', 0, 0, 1, '2026-07-15 11:42:07', '2026-07-15 03:42:08'),
(12, 6, 14, 8, 6, 'moderate', 'mild', 'moderate', 'moderate', 1, 0, 1, '2026-07-15 11:43:38', '2026-07-15 03:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int UNSIGNED NOT NULL,
  `transaction` char(36) NOT NULL,
  `type` varchar(7) NOT NULL,
  `primary_key` int UNSIGNED DEFAULT NULL,
  `source` varchar(255) NOT NULL,
  `parent_source` varchar(255) DEFAULT NULL,
  `original` mediumtext,
  `changed` mediumtext,
  `meta` mediumtext,
  `status` int NOT NULL DEFAULT '1',
  `slug` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `transaction`, `type`, `primary_key`, `source`, `parent_source`, `original`, `changed`, `meta`, `status`, `slug`, `created`) VALUES
(1, 'fd46484a-467f-4aff-a038-e31abc9b2974', 'create', 1, 'assessments', NULL, '[]', '{\"id\":1,\"user_id\":1,\"phq9_score\":10,\"gad7_score\":7,\"pss4_score\":8,\"depression_level\":\"moderate\",\"anxiety_level\":\"mild\",\"stress_level\":\"moderate\",\"overall_risk\":\"critical\",\"is_flagged\":1,\"crisis_trigger\":1,\"status\":1,\"submitted_at\":\"2026-06-20T20:08:53+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(2, '8af257ad-b3f9-46c9-bdb6-678dd10dfd47', 'create', 1, 'responses', NULL, '[]', '{\"id\":1,\"assessment_id\":1,\"question_id\":1,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(3, '958e2c5d-596b-4e9f-a0f4-6c92aee39f7b', 'create', 2, 'responses', NULL, '[]', '{\"id\":2,\"assessment_id\":1,\"question_id\":2,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(4, '77c247fa-b8de-41df-9a4a-eeff98114aae', 'create', 3, 'responses', NULL, '[]', '{\"id\":3,\"assessment_id\":1,\"question_id\":3,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(5, 'ff0f29e5-d40e-4b7e-87c5-b38dc6515eca', 'create', 4, 'responses', NULL, '[]', '{\"id\":4,\"assessment_id\":1,\"question_id\":4,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(6, '9ce55447-74de-457e-864c-6734be03cb2c', 'create', 5, 'responses', NULL, '[]', '{\"id\":5,\"assessment_id\":1,\"question_id\":5,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(7, '46ba1056-6c07-4fd3-bfb2-7f3670024f47', 'create', 6, 'responses', NULL, '[]', '{\"id\":6,\"assessment_id\":1,\"question_id\":6,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(8, 'eda4335f-e15c-40b5-9793-115b92803f1d', 'create', 7, 'responses', NULL, '[]', '{\"id\":7,\"assessment_id\":1,\"question_id\":7,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(9, 'ea1281ba-e7b0-454e-97d0-b0a131ed00d4', 'create', 8, 'responses', NULL, '[]', '{\"id\":8,\"assessment_id\":1,\"question_id\":8,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(10, '2adc80d5-3d34-4425-a2e4-cbcaa498d98f', 'create', 9, 'responses', NULL, '[]', '{\"id\":9,\"assessment_id\":1,\"question_id\":9,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(11, '2dbfb450-c7e1-4a3e-8005-c2e4814a1a31', 'create', 10, 'responses', NULL, '[]', '{\"id\":10,\"assessment_id\":1,\"question_id\":10,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(12, '6dd21832-d26a-4393-a927-f2c738b6ac92', 'create', 11, 'responses', NULL, '[]', '{\"id\":11,\"assessment_id\":1,\"question_id\":11,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(13, '04313372-125b-46fe-8e00-890794d13c7c', 'create', 12, 'responses', NULL, '[]', '{\"id\":12,\"assessment_id\":1,\"question_id\":12,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(14, '6d08ef88-d9c1-4e50-ae37-9af699979daa', 'create', 13, 'responses', NULL, '[]', '{\"id\":13,\"assessment_id\":1,\"question_id\":13,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(15, 'b35fd004-bcd7-4bcf-ae05-43d3ab54de0f', 'create', 14, 'responses', NULL, '[]', '{\"id\":14,\"assessment_id\":1,\"question_id\":14,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(16, '0873081a-9b64-4b7d-a97e-4b5a4db33cbf', 'create', 15, 'responses', NULL, '[]', '{\"id\":15,\"assessment_id\":1,\"question_id\":15,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(17, 'a6f2c4d6-ef4b-4b3f-9401-437e2fade824', 'create', 16, 'responses', NULL, '[]', '{\"id\":16,\"assessment_id\":1,\"question_id\":16,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(18, 'e92cbec9-1d25-462a-8aa4-ebbdcc2e6bd1', 'create', 17, 'responses', NULL, '[]', '{\"id\":17,\"assessment_id\":1,\"question_id\":17,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(19, 'c0883338-b5c8-4a70-b08a-1ad5d449dfef', 'create', 18, 'responses', NULL, '[]', '{\"id\":18,\"assessment_id\":1,\"question_id\":18,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(20, 'ae1ea00c-ca5e-424f-97f2-10ac03ad6f52', 'create', 19, 'responses', NULL, '[]', '{\"id\":19,\"assessment_id\":1,\"question_id\":19,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(21, '1f6d25e6-2f40-49b7-a3f1-ca311c92f9f6', 'create', 20, 'responses', NULL, '[]', '{\"id\":20,\"assessment_id\":1,\"question_id\":20,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(22, '17e282ab-17a6-4732-8368-a98c7a0c9a26', 'create', 21, 'responses', NULL, '[]', '{\"id\":21,\"assessment_id\":1,\"question_id\":21,\"response_value\":null,\"response_text\":\"4-6 hours\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(23, 'be81089c-837c-4201-9883-527ac84d3388', 'create', 22, 'responses', NULL, '[]', '{\"id\":22,\"assessment_id\":1,\"question_id\":22,\"response_value\":5,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(24, '9761d1ce-3760-4ce1-9511-2ef80c2efc45', 'create', 23, 'responses', NULL, '[]', '{\"id\":23,\"assessment_id\":1,\"question_id\":23,\"response_value\":null,\"response_text\":\"Sometimes\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(25, '006e6f2e-b3db-4689-90f6-baab62c76458', 'create', 24, 'responses', NULL, '[]', '{\"id\":24,\"assessment_id\":1,\"question_id\":24,\"response_value\":null,\"response_text\":\"Rarely\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(26, '918cfaed-a579-4ee6-975c-fa66462a9da8', 'create', 25, 'responses', NULL, '[]', '{\"id\":25,\"assessment_id\":1,\"question_id\":25,\"response_value\":null,\"response_text\":\"1-2 times\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":1}', 1, NULL, '2026-06-20 20:08:54'),
(27, '44ffbeea-603f-497a-8762-76d3f516b61c', 'create', 2, 'assessments', NULL, '[]', '{\"id\":2,\"user_id\":3,\"phq9_score\":13,\"gad7_score\":11,\"pss4_score\":10,\"depression_level\":\"moderate\",\"anxiety_level\":\"moderate\",\"stress_level\":\"high\",\"overall_risk\":\"critical\",\"is_flagged\":1,\"crisis_trigger\":1,\"status\":1,\"submitted_at\":\"2026-06-21T22:24:57+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:57'),
(28, 'ff9860a4-142d-4a83-9b57-b359e41750da', 'create', 26, 'responses', NULL, '[]', '{\"id\":26,\"assessment_id\":2,\"question_id\":1,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(29, '74adcfc8-793c-4f0d-a3b9-7e29c2bc9cc4', 'create', 27, 'responses', NULL, '[]', '{\"id\":27,\"assessment_id\":2,\"question_id\":2,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(30, '7c91a91e-681e-4d2d-b680-7b4ae66ee3c9', 'create', 28, 'responses', NULL, '[]', '{\"id\":28,\"assessment_id\":2,\"question_id\":3,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(31, '907deaf6-28b2-4829-90fc-25b98a0a17f3', 'create', 29, 'responses', NULL, '[]', '{\"id\":29,\"assessment_id\":2,\"question_id\":4,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(32, '56dd12fc-d694-465a-827f-908511b91964', 'create', 30, 'responses', NULL, '[]', '{\"id\":30,\"assessment_id\":2,\"question_id\":5,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(33, '386181d0-c0c1-46d9-b8ef-49088c535190', 'create', 31, 'responses', NULL, '[]', '{\"id\":31,\"assessment_id\":2,\"question_id\":6,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(34, '50375947-8797-4947-9e55-ed3cae4df3c7', 'create', 32, 'responses', NULL, '[]', '{\"id\":32,\"assessment_id\":2,\"question_id\":7,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(35, '4ffdaefb-0903-4293-b127-acd6f02c5722', 'create', 33, 'responses', NULL, '[]', '{\"id\":33,\"assessment_id\":2,\"question_id\":8,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(36, 'f25dc0bf-0bf4-4fbf-9eb4-aba64450ab5e', 'create', 34, 'responses', NULL, '[]', '{\"id\":34,\"assessment_id\":2,\"question_id\":9,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(37, 'a9ae8233-ced4-4a1b-aec7-3d9e8ae4ad89', 'create', 35, 'responses', NULL, '[]', '{\"id\":35,\"assessment_id\":2,\"question_id\":10,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(38, '59f7243f-f2ba-4f6c-a101-3aee385af2a5', 'create', 36, 'responses', NULL, '[]', '{\"id\":36,\"assessment_id\":2,\"question_id\":11,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(39, '4bba9dc6-7b2d-4dcf-b6e8-1ce968786232', 'create', 37, 'responses', NULL, '[]', '{\"id\":37,\"assessment_id\":2,\"question_id\":12,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(40, 'ae400379-c8c2-44cb-8941-21d3611766c6', 'create', 38, 'responses', NULL, '[]', '{\"id\":38,\"assessment_id\":2,\"question_id\":13,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(41, '6079e176-3bbe-476e-b756-732550f83069', 'create', 39, 'responses', NULL, '[]', '{\"id\":39,\"assessment_id\":2,\"question_id\":14,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(42, '3e3e2fa1-dcdb-4719-9cb8-9f882f5650d4', 'create', 40, 'responses', NULL, '[]', '{\"id\":40,\"assessment_id\":2,\"question_id\":15,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(43, '2713d054-d1ee-49f4-9e20-6aa826b81143', 'create', 41, 'responses', NULL, '[]', '{\"id\":41,\"assessment_id\":2,\"question_id\":16,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(44, '1bc2356a-451d-47af-ac77-dbecaf4310b0', 'create', 42, 'responses', NULL, '[]', '{\"id\":42,\"assessment_id\":2,\"question_id\":17,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(45, 'e2488021-6f12-416c-8125-4137a654e516', 'create', 43, 'responses', NULL, '[]', '{\"id\":43,\"assessment_id\":2,\"question_id\":18,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(46, '3f71cd9f-17b7-4b73-9074-1fb56198c40a', 'create', 44, 'responses', NULL, '[]', '{\"id\":44,\"assessment_id\":2,\"question_id\":19,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(47, '55717c20-b73f-4a8d-bb1f-7f1a93136a02', 'create', 45, 'responses', NULL, '[]', '{\"id\":45,\"assessment_id\":2,\"question_id\":20,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(48, '440627e3-3d89-461a-b8d0-83c08072e2cc', 'create', 46, 'responses', NULL, '[]', '{\"id\":46,\"assessment_id\":2,\"question_id\":21,\"response_value\":null,\"response_text\":\"Less than 4 hours\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(49, '1678f147-1878-4073-81ac-0d154bb96669', 'create', 47, 'responses', NULL, '[]', '{\"id\":47,\"assessment_id\":2,\"question_id\":22,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(50, 'c89230db-b12a-41f1-9961-41954da56aef', 'create', 48, 'responses', NULL, '[]', '{\"id\":48,\"assessment_id\":2,\"question_id\":23,\"response_value\":null,\"response_text\":\"No, I feel alone\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(51, 'f3337448-a026-454c-a02c-8f95c637753f', 'create', 49, 'responses', NULL, '[]', '{\"id\":49,\"assessment_id\":2,\"question_id\":24,\"response_value\":null,\"response_text\":\"Sometimes\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(52, '26774d05-4d70-4879-aa06-8bcc729b505f', 'create', 50, 'responses', NULL, '[]', '{\"id\":50,\"assessment_id\":2,\"question_id\":25,\"response_value\":null,\"response_text\":\"3-4 times\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-21 22:24:58'),
(53, '8fe920f5-1085-4a11-a965-7e6f6bfc6467', 'update', 3, 'users', NULL, '{\"avatar\":null,\"avatar_dir\":null}', '{\"avatar\":\"IMG_6004.HEIC\",\"avatar_dir\":\"webroot\\\\files\\\\Users\\\\avatar\\\\ahmad-student\"}', '[]', 1, NULL, '2026-06-22 01:30:39'),
(54, '653f3a22-fa80-4352-b9c1-245c3a771ef0', 'update', 3, 'users', NULL, '{\"student_id\":null,\"faculty\":null,\"program\":null,\"year_of_study\":null}', '{\"student_id\":\"123456\",\"faculty\":\"Faculty of Information Science\",\"program\":\"Bachelor of Information System Management\",\"year_of_study\":1}', '[]', 1, NULL, '2026-06-22 01:36:59'),
(55, '08604890-ac0f-49e5-a170-19a8d5c2e50b', 'create', 3, 'assessments', NULL, '[]', '{\"id\":3,\"user_id\":3,\"phq9_score\":2,\"gad7_score\":2,\"pss4_score\":2,\"depression_level\":\"minimal\",\"anxiety_level\":\"minimal\",\"stress_level\":\"low\",\"overall_risk\":\"low\",\"is_flagged\":0,\"crisis_trigger\":0,\"status\":1,\"submitted_at\":\"2026-06-22T07:20:04+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(56, '9037b51c-af54-41b7-b12d-2a84e074904b', 'create', 51, 'responses', NULL, '[]', '{\"id\":51,\"assessment_id\":3,\"question_id\":1,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(57, '2f8704e0-c9e8-498c-88da-8035fe9acd6e', 'create', 52, 'responses', NULL, '[]', '{\"id\":52,\"assessment_id\":3,\"question_id\":2,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(58, '5c76e899-b9ea-4e1a-a149-64a5fe801f3c', 'create', 53, 'responses', NULL, '[]', '{\"id\":53,\"assessment_id\":3,\"question_id\":3,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(59, '25da3de0-b476-4fd5-806c-e995e47499fe', 'create', 54, 'responses', NULL, '[]', '{\"id\":54,\"assessment_id\":3,\"question_id\":4,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(60, '10b9512d-8632-4936-a781-c25f7b0f8b84', 'create', 55, 'responses', NULL, '[]', '{\"id\":55,\"assessment_id\":3,\"question_id\":5,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(61, '1b9c900e-9e80-46a8-a699-b8bca8fce8b0', 'create', 56, 'responses', NULL, '[]', '{\"id\":56,\"assessment_id\":3,\"question_id\":6,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(62, '830e63aa-d233-43c3-bb5a-c64cdb085011', 'create', 57, 'responses', NULL, '[]', '{\"id\":57,\"assessment_id\":3,\"question_id\":7,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(63, '8c2d54b0-b212-4c7c-a5ee-90ea6a76913b', 'create', 58, 'responses', NULL, '[]', '{\"id\":58,\"assessment_id\":3,\"question_id\":8,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(64, '665b8c78-8213-4f20-a038-088002460efb', 'create', 59, 'responses', NULL, '[]', '{\"id\":59,\"assessment_id\":3,\"question_id\":9,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(65, '5d5b976a-6644-47c0-a92b-62168978622c', 'create', 60, 'responses', NULL, '[]', '{\"id\":60,\"assessment_id\":3,\"question_id\":10,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(66, '575a2ed5-6ce1-4623-aeef-5d3020b91afe', 'create', 61, 'responses', NULL, '[]', '{\"id\":61,\"assessment_id\":3,\"question_id\":11,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(67, 'c984a89f-084c-4631-aa21-3fcbca035f38', 'create', 62, 'responses', NULL, '[]', '{\"id\":62,\"assessment_id\":3,\"question_id\":12,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(68, 'dd1afaf4-2fe8-43c0-84e1-053e3c6a9ee1', 'create', 63, 'responses', NULL, '[]', '{\"id\":63,\"assessment_id\":3,\"question_id\":13,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(69, '130b4c0f-0c6f-4717-af68-14035a6a31fb', 'create', 64, 'responses', NULL, '[]', '{\"id\":64,\"assessment_id\":3,\"question_id\":14,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(70, '1603f616-b8b6-4885-ad9e-b8c140e55b2a', 'create', 65, 'responses', NULL, '[]', '{\"id\":65,\"assessment_id\":3,\"question_id\":15,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(71, '4a939661-625c-4227-8e7f-bc115c439d11', 'create', 66, 'responses', NULL, '[]', '{\"id\":66,\"assessment_id\":3,\"question_id\":16,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(72, '5110d94f-92a0-42e1-8557-578026a3209c', 'create', 67, 'responses', NULL, '[]', '{\"id\":67,\"assessment_id\":3,\"question_id\":17,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(73, 'e0b4aa61-4cf1-4981-b517-e2c326a24099', 'create', 68, 'responses', NULL, '[]', '{\"id\":68,\"assessment_id\":3,\"question_id\":18,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(74, 'd32d2655-113d-42da-8a99-0a8f47b8a08e', 'create', 69, 'responses', NULL, '[]', '{\"id\":69,\"assessment_id\":3,\"question_id\":19,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(75, '781aafdb-ceea-4298-adb7-93f8579e41a4', 'create', 70, 'responses', NULL, '[]', '{\"id\":70,\"assessment_id\":3,\"question_id\":20,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(76, '053b0943-0697-4b87-8648-5a656da4b678', 'create', 71, 'responses', NULL, '[]', '{\"id\":71,\"assessment_id\":3,\"question_id\":21,\"response_value\":null,\"response_text\":\"6-8 hours\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(77, '04d74e1e-0cc0-442f-b78e-9f142f279923', 'create', 72, 'responses', NULL, '[]', '{\"id\":72,\"assessment_id\":3,\"question_id\":22,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(78, 'ae5b64e7-ad6f-4bc2-9563-7a0ba71cd619', 'create', 73, 'responses', NULL, '[]', '{\"id\":73,\"assessment_id\":3,\"question_id\":23,\"response_value\":null,\"response_text\":\"Yes, always\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(79, '3d4dc86d-ea05-4745-9452-35a4e4689c1a', 'create', 74, 'responses', NULL, '[]', '{\"id\":74,\"assessment_id\":3,\"question_id\":24,\"response_value\":null,\"response_text\":\"Rarely\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(80, '4dc77139-66e5-45c3-b9ad-04b4d5848fed', 'create', 75, 'responses', NULL, '[]', '{\"id\":75,\"assessment_id\":3,\"question_id\":25,\"response_value\":null,\"response_text\":\"3-4 times\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 07:20:04'),
(81, '45caa8f0-4506-4f5c-a4d6-65993aef3ad3', 'create', 1, 'counselor_notes', NULL, '[]', '{\"id\":1,\"assessment_id\":2,\"counselor_id\":2,\"clinical_note\":\" will take action immediately\",\"action_taken\":\"follow_up\",\"follow_up_date\":\"2026-06-22\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/counselor-notes\\/add\",\"slug\":2}', 1, NULL, '2026-06-22 08:22:47'),
(82, '6d9c4a62-0f50-4300-96bd-be877eb67f5f', 'create', 4, 'assessments', NULL, '[]', '{\"id\":4,\"user_id\":3,\"phq9_score\":16,\"gad7_score\":12,\"pss4_score\":12,\"depression_level\":\"moderately_severe\",\"anxiety_level\":\"moderate\",\"stress_level\":\"high\",\"overall_risk\":\"high\",\"is_flagged\":1,\"crisis_trigger\":0,\"status\":1,\"submitted_at\":\"2026-06-22T11:15:24+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(83, 'e28a9a2e-be72-4ebc-9285-0a2c30b3d11d', 'create', 76, 'responses', NULL, '[]', '{\"id\":76,\"assessment_id\":4,\"question_id\":1,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(84, 'dc7ee732-3fb3-488a-afdc-dbe3cd430c79', 'create', 77, 'responses', NULL, '[]', '{\"id\":77,\"assessment_id\":4,\"question_id\":2,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(85, 'd523ea87-02ef-475f-a8cf-391a617c7a2b', 'create', 78, 'responses', NULL, '[]', '{\"id\":78,\"assessment_id\":4,\"question_id\":3,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(86, '02467e94-ee4f-49fc-95e8-24d3eb734e26', 'create', 79, 'responses', NULL, '[]', '{\"id\":79,\"assessment_id\":4,\"question_id\":4,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(87, 'd77cfdcf-4465-4d85-9de5-a2cc06a0e21a', 'create', 80, 'responses', NULL, '[]', '{\"id\":80,\"assessment_id\":4,\"question_id\":5,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(88, '4d949f18-77ba-457d-8455-90fe771a1f03', 'create', 81, 'responses', NULL, '[]', '{\"id\":81,\"assessment_id\":4,\"question_id\":6,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(89, 'f154ffe4-c504-4057-95e9-8459bd332a3e', 'create', 82, 'responses', NULL, '[]', '{\"id\":82,\"assessment_id\":4,\"question_id\":7,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:24'),
(90, 'de80cfa9-4a3f-422c-9f3c-197c6a94e13f', 'create', 83, 'responses', NULL, '[]', '{\"id\":83,\"assessment_id\":4,\"question_id\":8,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(91, '7c6b1755-1e43-4695-95f1-6ee08a198a44', 'create', 84, 'responses', NULL, '[]', '{\"id\":84,\"assessment_id\":4,\"question_id\":9,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(92, 'aa6f61bf-9665-4001-9f34-a6bd803b6246', 'create', 85, 'responses', NULL, '[]', '{\"id\":85,\"assessment_id\":4,\"question_id\":10,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(93, '76b8fae1-df4f-4836-95f3-d31cd077e0fc', 'create', 86, 'responses', NULL, '[]', '{\"id\":86,\"assessment_id\":4,\"question_id\":11,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(94, '14e38c35-380e-47fc-a9d8-9ea3b1d1b338', 'create', 87, 'responses', NULL, '[]', '{\"id\":87,\"assessment_id\":4,\"question_id\":12,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(95, '5849c196-6e07-4311-bdfa-178000be4d97', 'create', 88, 'responses', NULL, '[]', '{\"id\":88,\"assessment_id\":4,\"question_id\":13,\"response_value\":0,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(96, '3cfe515d-9647-4081-aaf3-c534da1eb4a8', 'create', 89, 'responses', NULL, '[]', '{\"id\":89,\"assessment_id\":4,\"question_id\":14,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(97, '02c23623-b842-479f-9d8c-79f35b6814b1', 'create', 90, 'responses', NULL, '[]', '{\"id\":90,\"assessment_id\":4,\"question_id\":15,\"response_value\":3,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(98, 'fe85b617-a168-43fc-ac4b-ea4adbafa257', 'create', 91, 'responses', NULL, '[]', '{\"id\":91,\"assessment_id\":4,\"question_id\":16,\"response_value\":1,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(99, 'a644db34-d023-43e4-97fb-bb3517899c4f', 'create', 92, 'responses', NULL, '[]', '{\"id\":92,\"assessment_id\":4,\"question_id\":17,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(100, '27eac815-84f2-42e1-bdea-62c79600d4db', 'create', 93, 'responses', NULL, '[]', '{\"id\":93,\"assessment_id\":4,\"question_id\":18,\"response_value\":4,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(101, 'c30832b2-8524-47d7-83b5-c8b0f676734f', 'create', 94, 'responses', NULL, '[]', '{\"id\":94,\"assessment_id\":4,\"question_id\":19,\"response_value\":4,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(102, '6da25b73-2858-4a09-ab52-fad5d4210067', 'create', 95, 'responses', NULL, '[]', '{\"id\":95,\"assessment_id\":4,\"question_id\":20,\"response_value\":2,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(103, 'b86e703e-3d03-4b2b-aa58-d293baf18249', 'create', 96, 'responses', NULL, '[]', '{\"id\":96,\"assessment_id\":4,\"question_id\":21,\"response_value\":null,\"response_text\":\"Less than 4 hours\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(104, '7add5033-d1dc-41d1-a811-aaab2d9d58c2', 'create', 97, 'responses', NULL, '[]', '{\"id\":97,\"assessment_id\":4,\"question_id\":22,\"response_value\":5,\"response_text\":null,\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(105, '44095d84-1dd9-4167-afbd-4d14abc58ae0', 'create', 98, 'responses', NULL, '[]', '{\"id\":98,\"assessment_id\":4,\"question_id\":23,\"response_value\":null,\"response_text\":\"No, I feel alone\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(106, 'f3dc00fa-9a6f-4446-b26d-c2d203607bb3', 'create', 99, 'responses', NULL, '[]', '{\"id\":99,\"assessment_id\":4,\"question_id\":24,\"response_value\":null,\"response_text\":\"Almost always\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(107, '034453d5-c4fe-4f73-8e72-f4989a8841cd', 'create', 100, 'responses', NULL, '[]', '{\"id\":100,\"assessment_id\":4,\"question_id\":25,\"response_value\":null,\"response_text\":\"Daily\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-06-22 11:15:25'),
(108, '5f220e7d-9b05-456d-943b-af73ea0d8e2a', 'create', 2, 'counselor_notes', NULL, '[]', '{\"id\":2,\"assessment_id\":4,\"counselor_id\":2,\"clinical_note\":\"yada yada\",\"action_taken\":\"contacted\",\"follow_up_date\":\"2026-06-22\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/counselor-notes\\/add\",\"slug\":2}', 1, NULL, '2026-06-22 11:18:50'),
(109, 'f9169e85-344c-48bd-a380-5aa1fb0edb5b', 'create', 3, 'counselor_notes', NULL, '[]', '{\"id\":3,\"assessment_id\":4,\"counselor_id\":2,\"clinical_note\":\"need to meet counselor\",\"action_taken\":\"follow_up\",\"follow_up_date\":\"2026-06-22\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/counselorNotes\\/add\",\"slug\":2}', 1, NULL, '2026-06-22 11:44:40'),
(110, 'd98aaef8-4dde-4cd0-a26b-6b4a1038e996', 'create', 5, 'assessments', NULL, '[]', '{\"id\":5,\"user_id\":3,\"phq9_score\":9,\"gad7_score\":7,\"pss4_score\":3,\"depression_level\":\"mild\",\"anxiety_level\":\"mild\",\"stress_level\":\"low\",\"overall_risk\":\"mild\",\"is_flagged\":0,\"crisis_trigger\":0,\"status\":1,\"submitted_at\":\"2026-07-11T15:31:03+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:03'),
(111, '78ddf6e8-f2ff-4569-8fe2-0b9afcc9f50a', 'create', 101, 'responses', NULL, '[]', '{\"id\":101,\"assessment_id\":5,\"question_id\":1,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(112, 'f35d928b-e1f0-4365-b4d0-6261d971f6b7', 'create', 102, 'responses', NULL, '[]', '{\"id\":102,\"assessment_id\":5,\"question_id\":2,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(113, '18f7595b-b9eb-451c-9ecf-b4d45c8b13c7', 'create', 103, 'responses', NULL, '[]', '{\"id\":103,\"assessment_id\":5,\"question_id\":3,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(114, 'bd7559bb-b81e-42cd-80c8-983e44cda695', 'create', 104, 'responses', NULL, '[]', '{\"id\":104,\"assessment_id\":5,\"question_id\":4,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(115, '0c17ad5e-e12d-4ce0-90f4-ee13c0f4e58b', 'create', 105, 'responses', NULL, '[]', '{\"id\":105,\"assessment_id\":5,\"question_id\":5,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(116, 'b34b5631-de61-437b-9e87-87359798e59a', 'create', 106, 'responses', NULL, '[]', '{\"id\":106,\"assessment_id\":5,\"question_id\":6,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(117, '2847f743-3159-4682-b11f-41937ab05a1c', 'create', 107, 'responses', NULL, '[]', '{\"id\":107,\"assessment_id\":5,\"question_id\":7,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(118, 'eb837b45-d169-4ee5-872d-37a952a16ef5', 'create', 108, 'responses', NULL, '[]', '{\"id\":108,\"assessment_id\":5,\"question_id\":8,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(119, 'd575c5d1-3387-497f-8be5-3263b26e12de', 'create', 109, 'responses', NULL, '[]', '{\"id\":109,\"assessment_id\":5,\"question_id\":9,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(120, '70c53b64-3ff6-4a77-8ef8-e23fd2f817d9', 'create', 110, 'responses', NULL, '[]', '{\"id\":110,\"assessment_id\":5,\"question_id\":10,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(121, '3ea32dd1-d911-4d8c-bc4d-711fc36088aa', 'create', 111, 'responses', NULL, '[]', '{\"id\":111,\"assessment_id\":5,\"question_id\":11,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(122, '7e433059-7a46-40d4-9ba4-54c05df3a46d', 'create', 112, 'responses', NULL, '[]', '{\"id\":112,\"assessment_id\":5,\"question_id\":12,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(123, '947fff9a-de88-47fa-b0f5-c0308765d033', 'create', 113, 'responses', NULL, '[]', '{\"id\":113,\"assessment_id\":5,\"question_id\":13,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(124, 'f45648ae-a21f-467e-9081-bb7de4143441', 'create', 114, 'responses', NULL, '[]', '{\"id\":114,\"assessment_id\":5,\"question_id\":14,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(125, '22a35b6a-2134-4f5b-9bf3-f3a21a266cb9', 'create', 115, 'responses', NULL, '[]', '{\"id\":115,\"assessment_id\":5,\"question_id\":15,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(126, '9b3c2d99-95e2-4356-b451-f4f65c2ba007', 'create', 116, 'responses', NULL, '[]', '{\"id\":116,\"assessment_id\":5,\"question_id\":16,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(127, '132c6ccc-b417-4e8d-a9b1-96c62525e0fc', 'create', 117, 'responses', NULL, '[]', '{\"id\":117,\"assessment_id\":5,\"question_id\":17,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(128, 'a17aca7f-1df8-4ead-8a31-96a7613dbbf8', 'create', 118, 'responses', NULL, '[]', '{\"id\":118,\"assessment_id\":5,\"question_id\":18,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(129, '7a1cbcab-2705-4723-9c25-2750df9c1aaf', 'create', 119, 'responses', NULL, '[]', '{\"id\":119,\"assessment_id\":5,\"question_id\":19,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(130, '20b7d16e-242a-479a-9ba0-f38d72c5ac37', 'create', 120, 'responses', NULL, '[]', '{\"id\":120,\"assessment_id\":5,\"question_id\":20,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(131, '822c7967-2ceb-49f8-a00a-727d54b28050', 'create', 121, 'responses', NULL, '[]', '{\"id\":121,\"assessment_id\":5,\"question_id\":21,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(132, '7ced09ec-cd82-4a0b-94f5-d74f133b2bf6', 'create', 122, 'responses', NULL, '[]', '{\"id\":122,\"assessment_id\":5,\"question_id\":22,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(133, '7567316b-cadb-41b9-9a14-30d8345e6876', 'create', 123, 'responses', NULL, '[]', '{\"id\":123,\"assessment_id\":5,\"question_id\":23,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(134, '5b5b806a-a017-4935-aa8d-a6e8c55568bf', 'create', 124, 'responses', NULL, '[]', '{\"id\":124,\"assessment_id\":5,\"question_id\":24,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04'),
(135, 'ab55c562-f1d0-4b13-9fec-fa96a0e67caa', 'create', 125, 'responses', NULL, '[]', '{\"id\":125,\"assessment_id\":5,\"question_id\":25,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 15:31:04');
INSERT INTO `audit_logs` (`id`, `transaction`, `type`, `primary_key`, `source`, `parent_source`, `original`, `changed`, `meta`, `status`, `slug`, `created`) VALUES
(136, 'e6a7206f-235f-4804-b460-592aa63fcb3d', 'create', 6, 'assessments', NULL, '[]', '{\"id\":6,\"user_id\":3,\"phq9_score\":9,\"gad7_score\":4,\"pss4_score\":6,\"depression_level\":\"mild\",\"anxiety_level\":\"minimal\",\"stress_level\":\"moderate\",\"overall_risk\":\"critical\",\"is_flagged\":1,\"crisis_trigger\":1,\"status\":1,\"submitted_at\":\"2026-07-11T22:57:26+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:26'),
(137, '2194c46f-7d00-4758-a7f5-b35248e87682', 'create', 126, 'responses', NULL, '[]', '{\"id\":126,\"assessment_id\":6,\"question_id\":1,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(138, 'dd960f14-b3e5-4f31-a42c-a8b67aef6a2d', 'create', 127, 'responses', NULL, '[]', '{\"id\":127,\"assessment_id\":6,\"question_id\":2,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(139, 'b45fe1bc-9185-47ac-bd4c-98ab2b10a06a', 'create', 128, 'responses', NULL, '[]', '{\"id\":128,\"assessment_id\":6,\"question_id\":3,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(140, '77c6aeea-12e6-40d0-91cd-902f4e9695ed', 'create', 129, 'responses', NULL, '[]', '{\"id\":129,\"assessment_id\":6,\"question_id\":4,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(141, 'c665fac5-b561-4e73-980f-3e6d245c6f9e', 'create', 130, 'responses', NULL, '[]', '{\"id\":130,\"assessment_id\":6,\"question_id\":5,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(142, '6287753d-295f-439f-a5f4-c73c0e77525b', 'create', 131, 'responses', NULL, '[]', '{\"id\":131,\"assessment_id\":6,\"question_id\":6,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(143, '259bd2f9-510f-4d5d-bd9f-85c76b14506d', 'create', 132, 'responses', NULL, '[]', '{\"id\":132,\"assessment_id\":6,\"question_id\":7,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(144, '911599d3-77bb-44fc-8f53-9c5df59f9f04', 'create', 133, 'responses', NULL, '[]', '{\"id\":133,\"assessment_id\":6,\"question_id\":8,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(145, 'b0b00bc3-897e-4015-835f-22bfa061b5c4', 'create', 134, 'responses', NULL, '[]', '{\"id\":134,\"assessment_id\":6,\"question_id\":9,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(146, 'bcfea1f6-3d09-4edf-ad04-6804a1247054', 'create', 135, 'responses', NULL, '[]', '{\"id\":135,\"assessment_id\":6,\"question_id\":10,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(147, '895199d0-5381-4f3f-917f-723af990df76', 'create', 136, 'responses', NULL, '[]', '{\"id\":136,\"assessment_id\":6,\"question_id\":11,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(148, '9beacad9-989a-479b-a9c2-cc0ee0d7de38', 'create', 137, 'responses', NULL, '[]', '{\"id\":137,\"assessment_id\":6,\"question_id\":12,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(149, 'da8192f8-0884-44c9-9ea1-ce2a770cda86', 'create', 138, 'responses', NULL, '[]', '{\"id\":138,\"assessment_id\":6,\"question_id\":13,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(150, '7b8ac9e3-b53a-4943-8410-be37d56b3d19', 'create', 139, 'responses', NULL, '[]', '{\"id\":139,\"assessment_id\":6,\"question_id\":14,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(151, 'c81da3ba-6f98-43cf-95a8-9861f06e89d3', 'create', 140, 'responses', NULL, '[]', '{\"id\":140,\"assessment_id\":6,\"question_id\":15,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(152, '1360b3e0-8958-406d-ad8c-834b6d357caf', 'create', 141, 'responses', NULL, '[]', '{\"id\":141,\"assessment_id\":6,\"question_id\":16,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(153, 'cbfb2652-f670-44fb-b96e-cba340d18242', 'create', 142, 'responses', NULL, '[]', '{\"id\":142,\"assessment_id\":6,\"question_id\":17,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(154, 'f0fc06ff-f603-4e0b-8a36-d85934e8d562', 'create', 143, 'responses', NULL, '[]', '{\"id\":143,\"assessment_id\":6,\"question_id\":18,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(155, 'a6543146-56b4-4417-9572-7b190355c734', 'create', 144, 'responses', NULL, '[]', '{\"id\":144,\"assessment_id\":6,\"question_id\":19,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(156, '5368d484-9714-4e21-8956-de827194a5cb', 'create', 145, 'responses', NULL, '[]', '{\"id\":145,\"assessment_id\":6,\"question_id\":20,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(157, 'f24c8268-e70b-4641-97bd-93145a258031', 'create', 146, 'responses', NULL, '[]', '{\"id\":146,\"assessment_id\":6,\"question_id\":21,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(158, 'c1023f61-ddf5-4cb1-860d-2fb986bd17ff', 'create', 147, 'responses', NULL, '[]', '{\"id\":147,\"assessment_id\":6,\"question_id\":22,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(159, '9357ec20-a671-4c5c-945f-2fb34675191d', 'create', 148, 'responses', NULL, '[]', '{\"id\":148,\"assessment_id\":6,\"question_id\":23,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(160, '4063a5f4-c9d7-48c8-864d-f908d49ffb70', 'create', 149, 'responses', NULL, '[]', '{\"id\":149,\"assessment_id\":6,\"question_id\":24,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(161, '12ed1793-67f5-4bb7-aa4a-137f5dd7faf3', 'create', 150, 'responses', NULL, '[]', '{\"id\":150,\"assessment_id\":6,\"question_id\":25,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-11 22:57:27'),
(162, 'a8a68c74-865e-424a-ab7f-3facf46c636d', 'update', 3, 'users', NULL, '{\"avatar\":\"IMG_6004.HEIC\",\"avatar_dir\":\"webroot\\\\files\\\\Users\\\\avatar\\\\ahmad-student\"}', '{\"avatar\":\"\",\"avatar_dir\":\"\"}', '[]', 1, NULL, '2026-07-11 23:54:09'),
(163, '7fab7046-3da1-4f27-a87a-c1d0a9c4fa5e', 'create', 7, 'assessments', NULL, '[]', '{\"id\":7,\"user_id\":3,\"phq9_score\":12,\"gad7_score\":4,\"pss4_score\":4,\"depression_level\":\"moderate\",\"anxiety_level\":\"minimal\",\"stress_level\":\"low\",\"overall_risk\":\"critical\",\"is_flagged\":1,\"crisis_trigger\":1,\"status\":1,\"submitted_at\":\"2026-07-13T13:35:27+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:27'),
(164, '73495713-6924-43a1-9058-31ea4fc3a49f', 'create', 151, 'responses', NULL, '[]', '{\"id\":151,\"assessment_id\":7,\"question_id\":1,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:27'),
(165, '620c211e-ed3a-4c80-9702-b3292af52e26', 'create', 152, 'responses', NULL, '[]', '{\"id\":152,\"assessment_id\":7,\"question_id\":2,\"response_value\":3}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:27'),
(166, '44bf1aa5-40cc-4017-a5a8-e7183b4087dd', 'create', 153, 'responses', NULL, '[]', '{\"id\":153,\"assessment_id\":7,\"question_id\":3,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:27'),
(167, '73c99662-3771-441c-922b-907a7e7628c4', 'create', 154, 'responses', NULL, '[]', '{\"id\":154,\"assessment_id\":7,\"question_id\":4,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:27'),
(168, 'a8d6ace6-8676-419e-82b7-e63eaa4e2077', 'create', 155, 'responses', NULL, '[]', '{\"id\":155,\"assessment_id\":7,\"question_id\":5,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:27'),
(169, 'd13d804d-2f2a-420a-9d94-e9d3806c580d', 'create', 156, 'responses', NULL, '[]', '{\"id\":156,\"assessment_id\":7,\"question_id\":6,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:27'),
(170, '30fa658e-82c6-4f71-b2c2-67189b2c4794', 'create', 157, 'responses', NULL, '[]', '{\"id\":157,\"assessment_id\":7,\"question_id\":7,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(171, 'edaabab4-45fe-4b0f-9174-10cc33484b34', 'create', 158, 'responses', NULL, '[]', '{\"id\":158,\"assessment_id\":7,\"question_id\":8,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(172, '486e5cd3-7e44-46c7-9ed6-e41900c880fc', 'create', 159, 'responses', NULL, '[]', '{\"id\":159,\"assessment_id\":7,\"question_id\":9,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(173, '1fe10d64-88f0-4c59-a69d-caa2dafe9588', 'create', 160, 'responses', NULL, '[]', '{\"id\":160,\"assessment_id\":7,\"question_id\":10,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(174, '9d1c3820-9341-4bbf-8331-3442c77eace6', 'create', 161, 'responses', NULL, '[]', '{\"id\":161,\"assessment_id\":7,\"question_id\":11,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(175, 'ec70842f-0631-4e31-9bbc-141d4521b75a', 'create', 162, 'responses', NULL, '[]', '{\"id\":162,\"assessment_id\":7,\"question_id\":12,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(176, 'c0389fbb-5d45-436c-b99c-2ab39a900cd0', 'create', 163, 'responses', NULL, '[]', '{\"id\":163,\"assessment_id\":7,\"question_id\":13,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(177, '881b088b-208f-427f-a612-465dca26a4ca', 'create', 164, 'responses', NULL, '[]', '{\"id\":164,\"assessment_id\":7,\"question_id\":14,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(178, 'fdfe3e01-5de6-4c69-a8e0-3d2751b323d1', 'create', 165, 'responses', NULL, '[]', '{\"id\":165,\"assessment_id\":7,\"question_id\":15,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(179, 'd7be63e4-d8c0-4332-a97f-f0e0df256123', 'create', 166, 'responses', NULL, '[]', '{\"id\":166,\"assessment_id\":7,\"question_id\":16,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(180, '69baf6d3-5e0a-4e7f-9d8c-50ef44ac8447', 'create', 167, 'responses', NULL, '[]', '{\"id\":167,\"assessment_id\":7,\"question_id\":17,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(181, '499a93ee-ccf6-411c-9f89-30c407d90cf8', 'create', 168, 'responses', NULL, '[]', '{\"id\":168,\"assessment_id\":7,\"question_id\":18,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(182, '8d7ad818-d562-4f54-94a6-e21993c18e0c', 'create', 169, 'responses', NULL, '[]', '{\"id\":169,\"assessment_id\":7,\"question_id\":19,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(183, '71c2a25e-446f-44bb-952d-6b64241a091f', 'create', 170, 'responses', NULL, '[]', '{\"id\":170,\"assessment_id\":7,\"question_id\":20,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(184, '3b698f06-78d8-49f5-b29b-892c79c15668', 'create', 171, 'responses', NULL, '[]', '{\"id\":171,\"assessment_id\":7,\"question_id\":21,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(185, '0caa63c7-7aec-46cc-a9aa-b885e9033838', 'create', 172, 'responses', NULL, '[]', '{\"id\":172,\"assessment_id\":7,\"question_id\":22,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(186, 'be9a0c7f-3bdc-4aab-80b3-adcb91ef2c9c', 'create', 173, 'responses', NULL, '[]', '{\"id\":173,\"assessment_id\":7,\"question_id\":23,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(187, 'ec539822-5ce2-4917-98f6-60e6e1f89385', 'create', 174, 'responses', NULL, '[]', '{\"id\":174,\"assessment_id\":7,\"question_id\":24,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(188, '892be124-063b-455b-8c76-e73387f5dae5', 'create', 175, 'responses', NULL, '[]', '{\"id\":175,\"assessment_id\":7,\"question_id\":25,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"::1\",\"url\":\"http:\\/\\/localhost\\/mindease\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-13 13:35:28'),
(189, 'fb8f6fd0-da2a-4a88-a132-f94dc713217b', 'update', 3, 'users', NULL, '{\"fullname\":\"Ahmad Student\"}', '{\"fullname\":\"Ahmad Raiyan Iman\"}', '[]', 1, NULL, '2026-07-13 13:51:08'),
(190, 'f698f7c3-a3b9-4c1c-bff4-66ced48dd50b', 'update', 3, 'users', NULL, '{\"avatar\":\"\",\"avatar_dir\":\"\"}', '{\"avatar\":\"Screenshot 2026-01-09 121816.png\",\"avatar_dir\":\"webroot\\\\files\\\\Users\\\\avatar\\\\ahmad-student\"}', '[]', 1, NULL, '2026-07-13 14:11:21'),
(191, 'f43b2e8b-e156-4d8e-a826-0a18f2c3ca8a', 'create', 4, 'counselor_notes', NULL, '[]', '{\"id\":4,\"assessment_id\":7,\"counselor_id\":2,\"clinical_note\":\"need to see counselor for further action\",\"action_taken\":\"follow_up\",\"follow_up_date\":\"2026-07-17\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/add?assessment_id=7\",\"slug\":2}', 1, NULL, '2026-07-14 08:15:48'),
(192, '1804f517-7b55-4181-95ad-e4cfb6c9eecb', 'create', 8, 'assessments', NULL, '[]', '{\"id\":8,\"user_id\":3,\"phq9_score\":0,\"gad7_score\":0,\"pss4_score\":0,\"depression_level\":\"minimal\",\"anxiety_level\":\"minimal\",\"stress_level\":\"low\",\"overall_risk\":\"low\",\"is_flagged\":0,\"crisis_trigger\":0,\"status\":1,\"submitted_at\":\"2026-07-14T11:23:32+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(193, '8c40c24f-e67c-49c5-a511-d20058c6cc7e', 'create', 176, 'responses', NULL, '[]', '{\"id\":176,\"assessment_id\":8,\"question_id\":1,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(194, '53f385c6-f9d7-43e3-be90-736b7b8e7f8a', 'create', 177, 'responses', NULL, '[]', '{\"id\":177,\"assessment_id\":8,\"question_id\":2,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(195, '05ed5e3d-797a-4ef5-9652-7d1a02b3645f', 'create', 178, 'responses', NULL, '[]', '{\"id\":178,\"assessment_id\":8,\"question_id\":3,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(196, '78a0e3bd-628d-499e-be9f-761ece3cc94e', 'create', 179, 'responses', NULL, '[]', '{\"id\":179,\"assessment_id\":8,\"question_id\":4,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(197, '66568181-61a2-430d-be3c-ed6c76b894e6', 'create', 180, 'responses', NULL, '[]', '{\"id\":180,\"assessment_id\":8,\"question_id\":5,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(198, '25366a10-d168-42ba-954f-5f31496ab613', 'create', 181, 'responses', NULL, '[]', '{\"id\":181,\"assessment_id\":8,\"question_id\":6,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(199, '01347c95-c217-4c85-ac46-3ac616400a34', 'create', 182, 'responses', NULL, '[]', '{\"id\":182,\"assessment_id\":8,\"question_id\":7,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(200, 'f91ca36f-90cf-4c4e-82c9-362b101233c6', 'create', 183, 'responses', NULL, '[]', '{\"id\":183,\"assessment_id\":8,\"question_id\":8,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(201, 'b6dcf43e-7759-4a7e-b44e-030d5a01716f', 'create', 184, 'responses', NULL, '[]', '{\"id\":184,\"assessment_id\":8,\"question_id\":9,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(202, 'fecb1f73-8f70-493f-90ea-14dacfe0cf12', 'create', 185, 'responses', NULL, '[]', '{\"id\":185,\"assessment_id\":8,\"question_id\":10,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(203, '5ab335c2-ea5e-457d-8882-c14a2586c925', 'create', 186, 'responses', NULL, '[]', '{\"id\":186,\"assessment_id\":8,\"question_id\":11,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(204, '7ce76c20-00a8-4999-8b12-5220510cbfa7', 'create', 187, 'responses', NULL, '[]', '{\"id\":187,\"assessment_id\":8,\"question_id\":12,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(205, '51e91e56-eca8-45c7-8a42-2d41f92454ee', 'create', 188, 'responses', NULL, '[]', '{\"id\":188,\"assessment_id\":8,\"question_id\":13,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(206, '928390db-8293-4708-94b7-a990fbe200d7', 'create', 189, 'responses', NULL, '[]', '{\"id\":189,\"assessment_id\":8,\"question_id\":14,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(207, 'cfa5626a-ac39-4751-af63-357cb777482b', 'create', 190, 'responses', NULL, '[]', '{\"id\":190,\"assessment_id\":8,\"question_id\":15,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(208, '828a1e50-9562-4790-a038-f8583779bf16', 'create', 191, 'responses', NULL, '[]', '{\"id\":191,\"assessment_id\":8,\"question_id\":16,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(209, '9a1fc216-da88-41fa-905c-16411cd596af', 'create', 192, 'responses', NULL, '[]', '{\"id\":192,\"assessment_id\":8,\"question_id\":17,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(210, '3e5be7f9-16ee-4e3b-96b9-5b518f573c81', 'create', 193, 'responses', NULL, '[]', '{\"id\":193,\"assessment_id\":8,\"question_id\":18,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:32'),
(211, '37d6c3fc-96e1-4e7b-ac75-aea0719d7fb8', 'create', 194, 'responses', NULL, '[]', '{\"id\":194,\"assessment_id\":8,\"question_id\":19,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:33'),
(212, 'ece55861-c5af-4f8c-ad7e-2116a94614a2', 'create', 195, 'responses', NULL, '[]', '{\"id\":195,\"assessment_id\":8,\"question_id\":20,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:33'),
(213, 'afd2e829-38ea-4bb4-b6ce-41a9308ff572', 'create', 196, 'responses', NULL, '[]', '{\"id\":196,\"assessment_id\":8,\"question_id\":21,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:33'),
(214, 'f93379b5-aead-420f-9fa9-460b226a9931', 'create', 197, 'responses', NULL, '[]', '{\"id\":197,\"assessment_id\":8,\"question_id\":22,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:33'),
(215, 'd7a29a2b-b6fd-46f1-90b3-a808898ef381', 'create', 198, 'responses', NULL, '[]', '{\"id\":198,\"assessment_id\":8,\"question_id\":23,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:33'),
(216, '13423bd2-9fd0-4726-9198-65df276c977e', 'create', 199, 'responses', NULL, '[]', '{\"id\":199,\"assessment_id\":8,\"question_id\":24,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:33'),
(217, '147607b3-34aa-4244-80de-f77065d42dfc', 'create', 200, 'responses', NULL, '[]', '{\"id\":200,\"assessment_id\":8,\"question_id\":25,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-14 11:23:33'),
(218, '8f0bf47f-b0be-4356-a78c-ff4769381c2f', 'update', 3, 'users', NULL, '{\"avatar\":\"Screenshot 2026-01-09 121816.png\"}', '{\"avatar\":\"ChatGPT Image Jul 14, 2026, 11_32_16 AM.png\"}', '[]', 1, NULL, '2026-07-14 11:34:30'),
(219, 'aeb354c3-fbf9-411a-a5ae-f3f2a2118488', 'update', 2, 'users', NULL, '{\"avatar\":null,\"avatar_dir\":null}', '{\"avatar\":\"ChatGPT Image Jul 14, 2026, 11_43_00 AM.png\",\"avatar_dir\":\"webroot\\\\files\\\\Users\\\\avatar\\\\dr-sarah\"}', '[]', 1, NULL, '2026-07-14 11:45:07'),
(220, 'd728a34b-8d71-4e2c-8f14-51221205bf12', 'update', 1, 'counselor_notes', NULL, '{\"action_taken\":\"\",\"status\":1}', '{\"action_taken\":\"referred\",\"status\":2}', '{\"a_name\":\"Edit\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/edit\\/1\",\"slug\":2}', 1, NULL, '2026-07-14 23:12:02'),
(221, '77253aca-bcf6-42f8-bad0-467d78f09ea3', 'update', 2, 'counselor_notes', NULL, '{\"action_taken\":\"\"}', '{\"action_taken\":\"crisis_intervention\"}', '{\"a_name\":\"Edit\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/edit\\/2\",\"slug\":2}', 1, NULL, '2026-07-14 23:13:43'),
(222, 'd244dc75-dcfb-487c-bbfd-c86988bb9c18', 'update', 6, 'users', NULL, '{\"student_id\":null,\"faculty\":null,\"program\":null,\"year_of_study\":null,\"avatar\":null,\"avatar_dir\":null}', '{\"student_id\":\"2024402302\",\"faculty\":\"Faculty of Information Science\",\"program\":\"Bachelor of Information System Management\",\"year_of_study\":3,\"avatar\":\"Gemini_Generated_Image_vzgoyavzgoyavzgo.png\",\"avatar_dir\":\"webroot\\\\files\\\\Users\\\\avatar\\\\damia-fakhira\"}', '[]', 1, NULL, '2026-07-15 08:26:12'),
(223, '6931748c-7c91-4987-9d5d-74d4535640a4', 'create', 9, 'assessments', NULL, '[]', '{\"id\":9,\"user_id\":6,\"phq9_score\":4,\"gad7_score\":9,\"pss4_score\":1,\"depression_level\":\"minimal\",\"anxiety_level\":\"mild\",\"stress_level\":\"low\",\"overall_risk\":\"mild\",\"is_flagged\":0,\"crisis_trigger\":0,\"status\":1,\"submitted_at\":\"2026-07-15T08:30:37+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(224, '44d12da5-feb4-49fb-9175-d91489243293', 'create', 201, 'responses', NULL, '[]', '{\"id\":201,\"assessment_id\":9,\"question_id\":1,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(225, '076af1b0-91ea-4d9e-8189-37dc721620b3', 'create', 202, 'responses', NULL, '[]', '{\"id\":202,\"assessment_id\":9,\"question_id\":2,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(226, 'a4fed150-f944-47e7-a879-cf1beb04ec06', 'create', 203, 'responses', NULL, '[]', '{\"id\":203,\"assessment_id\":9,\"question_id\":3,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(227, 'da2718c5-ee5d-4dd6-a9f3-de29c97f03d2', 'create', 204, 'responses', NULL, '[]', '{\"id\":204,\"assessment_id\":9,\"question_id\":4,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(228, 'b33c1c13-9b0d-4452-bcc5-9d7b263eaa16', 'create', 205, 'responses', NULL, '[]', '{\"id\":205,\"assessment_id\":9,\"question_id\":5,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(229, '80d7260c-7582-47ab-98bf-ca1c59175f8a', 'create', 206, 'responses', NULL, '[]', '{\"id\":206,\"assessment_id\":9,\"question_id\":6,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(230, '06979d2b-cc0b-487c-8fa4-7e7846123a56', 'create', 207, 'responses', NULL, '[]', '{\"id\":207,\"assessment_id\":9,\"question_id\":7,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(231, '71dbea79-a64f-4141-8ad0-1198948d2f94', 'create', 208, 'responses', NULL, '[]', '{\"id\":208,\"assessment_id\":9,\"question_id\":8,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(232, 'a31845c5-f911-434e-8def-ffca14e6376d', 'create', 209, 'responses', NULL, '[]', '{\"id\":209,\"assessment_id\":9,\"question_id\":9,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(233, 'bec734d1-79e5-4a30-a1a3-5489fe583a53', 'create', 210, 'responses', NULL, '[]', '{\"id\":210,\"assessment_id\":9,\"question_id\":10,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(234, '654a9807-1cf6-4e5f-9583-b93832523b70', 'create', 211, 'responses', NULL, '[]', '{\"id\":211,\"assessment_id\":9,\"question_id\":11,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(235, '8e529eb5-310a-47e6-9891-9ecb27ef6a27', 'create', 212, 'responses', NULL, '[]', '{\"id\":212,\"assessment_id\":9,\"question_id\":12,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(236, 'f0809331-0cb1-4f01-bd21-3892a1bda220', 'create', 213, 'responses', NULL, '[]', '{\"id\":213,\"assessment_id\":9,\"question_id\":13,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(237, '7440aec6-9b17-4f86-b26b-a79676c6f899', 'create', 214, 'responses', NULL, '[]', '{\"id\":214,\"assessment_id\":9,\"question_id\":14,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(238, '5491295c-1b69-4662-a939-6cc47fd32e2b', 'create', 215, 'responses', NULL, '[]', '{\"id\":215,\"assessment_id\":9,\"question_id\":15,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(239, '6607fd8b-7e59-4b73-ba82-5a32b490f24f', 'create', 216, 'responses', NULL, '[]', '{\"id\":216,\"assessment_id\":9,\"question_id\":16,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(240, '8f66d180-1bfb-44dc-92ff-9be8547a8fcd', 'create', 217, 'responses', NULL, '[]', '{\"id\":217,\"assessment_id\":9,\"question_id\":17,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(241, 'efb0243c-8229-4461-8f84-ea475f35608f', 'create', 218, 'responses', NULL, '[]', '{\"id\":218,\"assessment_id\":9,\"question_id\":18,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:37'),
(242, '6ac96338-ee4b-4a57-becc-ed2eef875493', 'create', 219, 'responses', NULL, '[]', '{\"id\":219,\"assessment_id\":9,\"question_id\":19,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:38'),
(243, 'b7188fe5-886a-4202-ae32-0335dc8f2abc', 'create', 220, 'responses', NULL, '[]', '{\"id\":220,\"assessment_id\":9,\"question_id\":20,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:38'),
(244, 'e8e05ac9-2063-4256-a0e4-0632c7957ddc', 'create', 221, 'responses', NULL, '[]', '{\"id\":221,\"assessment_id\":9,\"question_id\":21,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:38'),
(245, 'ab0a56fc-c71d-4c4b-824d-d3479aa8ba51', 'create', 222, 'responses', NULL, '[]', '{\"id\":222,\"assessment_id\":9,\"question_id\":22,\"response_value\":3}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:38'),
(246, '8c0917cd-84e5-46e6-9505-bba5f63c6aae', 'create', 223, 'responses', NULL, '[]', '{\"id\":223,\"assessment_id\":9,\"question_id\":23,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:38'),
(247, '86c4e43a-9394-42be-aa9c-3d24a433f2f8', 'create', 224, 'responses', NULL, '[]', '{\"id\":224,\"assessment_id\":9,\"question_id\":24,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:38'),
(248, '969e9fd0-3a9e-4477-9259-fb9f001bd009', 'create', 225, 'responses', NULL, '[]', '{\"id\":225,\"assessment_id\":9,\"question_id\":25,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 08:30:38'),
(249, '7700ef78-94ea-4862-886c-667f8243c231', 'create', 5, 'counselor_notes', NULL, '[]', '{\"id\":5,\"assessment_id\":9,\"counselor_id\":2,\"clinical_note\":\"Student need to find friend to talk or you may come to share your problem with me. Im free on 21\\/7\\/2026\",\"action_taken\":\"contacted\",\"follow_up_date\":\"2026-07-21\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/add?assessment_id=9\",\"slug\":2}', 1, NULL, '2026-07-15 08:35:13'),
(250, '86754d45-6ec8-435f-b8ec-f5dac7ab8921', 'create', 6, 'counselor_notes', NULL, '[]', '{\"id\":6,\"assessment_id\":9,\"counselor_id\":2,\"clinical_note\":\"test test es\",\"action_taken\":\"referred\",\"follow_up_date\":\"2026-07-23\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/add\",\"slug\":2}', 1, NULL, '2026-07-15 09:25:48'),
(251, 'a3d5a1ed-45d9-4b5e-b975-8242e9a13d2d', 'update', 9, 'questions', NULL, '{\"status\":1}', '{\"status\":0}', '{\"a_name\":\"Edit\",\"c_name\":\"Questions\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/questions\\/edit\\/9\",\"slug\":1}', 1, NULL, '2026-07-15 11:28:25'),
(252, 'e8d5dfdf-3cd7-4e6b-8f80-00fdccdf1aa6', 'update', 9, 'questions', NULL, '{\"status\":0}', '{\"status\":1}', '{\"a_name\":\"Edit\",\"c_name\":\"Questions\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/questions\\/edit\\/9\",\"slug\":1}', 1, NULL, '2026-07-15 11:28:37'),
(253, 'de54a09a-69d9-43ab-8e77-df2ff8261be4', 'update', 9, 'questions', NULL, '{\"status\":1}', '{\"status\":2}', '{\"a_name\":\"Edit\",\"c_name\":\"Questions\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/questions\\/edit\\/9\",\"slug\":1}', 1, NULL, '2026-07-15 11:29:02'),
(254, '74a703df-4dd2-4e4b-9310-b5231dab41f8', 'update', 9, 'questions', NULL, '{\"status\":2}', '{\"status\":0}', '{\"a_name\":\"Edit\",\"c_name\":\"Questions\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/questions\\/edit\\/9\",\"slug\":1}', 1, NULL, '2026-07-15 11:29:27'),
(255, 'e192796f-482e-4486-b515-f848c86d77b9', 'update', 9, 'questions', NULL, '{\"status\":0}', '{\"status\":1}', '{\"a_name\":\"Edit\",\"c_name\":\"Questions\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/questions\\/edit\\/9\",\"slug\":1}', 1, NULL, '2026-07-15 11:29:46'),
(256, '9f7e529b-ff41-477a-802c-49023b75ee1f', 'create', 10, 'assessments', NULL, '[]', '{\"id\":10,\"user_id\":3,\"phq9_score\":5,\"gad7_score\":3,\"pss4_score\":2,\"depression_level\":\"mild\",\"anxiety_level\":\"minimal\",\"stress_level\":\"low\",\"overall_risk\":\"critical\",\"is_flagged\":1,\"crisis_trigger\":1,\"status\":1,\"submitted_at\":\"2026-07-15T11:35:10+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(257, 'd8f9dcdb-687b-455a-91cd-ea43392755ad', 'create', 226, 'responses', NULL, '[]', '{\"id\":226,\"assessment_id\":10,\"question_id\":1,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(258, '4a9d787b-a8a1-4fbb-950d-89ffa55d38d7', 'create', 227, 'responses', NULL, '[]', '{\"id\":227,\"assessment_id\":10,\"question_id\":2,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(259, 'f98c9a08-5890-4bd7-b0c5-165b66dbd246', 'create', 228, 'responses', NULL, '[]', '{\"id\":228,\"assessment_id\":10,\"question_id\":3,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(260, '649ed3bd-d8e5-46af-91db-6fe336adc76b', 'create', 229, 'responses', NULL, '[]', '{\"id\":229,\"assessment_id\":10,\"question_id\":4,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(261, '312bb6ba-70f9-4439-bc5a-2c0138442a89', 'create', 230, 'responses', NULL, '[]', '{\"id\":230,\"assessment_id\":10,\"question_id\":5,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(262, '37a5ba90-5664-4b38-914a-f2b39ff7bc28', 'create', 231, 'responses', NULL, '[]', '{\"id\":231,\"assessment_id\":10,\"question_id\":6,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(263, 'b3d366d4-ab86-4d61-9e51-ac90c5fb84ad', 'create', 232, 'responses', NULL, '[]', '{\"id\":232,\"assessment_id\":10,\"question_id\":7,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(264, '9d6b8e0d-a690-4c25-a531-731b99016bfb', 'create', 233, 'responses', NULL, '[]', '{\"id\":233,\"assessment_id\":10,\"question_id\":8,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(265, '16ba848c-0f73-43d6-b299-692c545a8f1b', 'create', 234, 'responses', NULL, '[]', '{\"id\":234,\"assessment_id\":10,\"question_id\":9,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(266, '16deb198-de8b-4ef8-b74c-12f8eff6b996', 'create', 235, 'responses', NULL, '[]', '{\"id\":235,\"assessment_id\":10,\"question_id\":10,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(267, '1e0f8bc1-7e05-48fa-95c6-2fc1fb384251', 'create', 236, 'responses', NULL, '[]', '{\"id\":236,\"assessment_id\":10,\"question_id\":11,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(268, 'e5272343-1182-4ed6-9c91-7e6d012cbbc9', 'create', 237, 'responses', NULL, '[]', '{\"id\":237,\"assessment_id\":10,\"question_id\":12,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(269, '9faee939-380a-47d6-a79a-120a199e26aa', 'create', 238, 'responses', NULL, '[]', '{\"id\":238,\"assessment_id\":10,\"question_id\":13,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(270, '41f6b6ef-a577-49b0-a8dd-adfa7f2437d4', 'create', 239, 'responses', NULL, '[]', '{\"id\":239,\"assessment_id\":10,\"question_id\":14,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(271, '6df0befb-d804-4b18-89c5-9edc0eda6140', 'create', 240, 'responses', NULL, '[]', '{\"id\":240,\"assessment_id\":10,\"question_id\":15,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(272, '7ee5d5df-4735-4943-ba58-f1f6e185a27a', 'create', 241, 'responses', NULL, '[]', '{\"id\":241,\"assessment_id\":10,\"question_id\":16,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(273, '26023d6d-9aef-4349-ab93-ed2a76871c74', 'create', 242, 'responses', NULL, '[]', '{\"id\":242,\"assessment_id\":10,\"question_id\":17,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(274, 'fb190711-f75f-4bef-b04a-c1dc093ceb4b', 'create', 243, 'responses', NULL, '[]', '{\"id\":243,\"assessment_id\":10,\"question_id\":18,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(275, 'cf092a6b-bd46-4a99-b84e-d6aa91ed92e9', 'create', 244, 'responses', NULL, '[]', '{\"id\":244,\"assessment_id\":10,\"question_id\":19,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(276, '84b5513a-404b-44ae-9563-373e323376a5', 'create', 245, 'responses', NULL, '[]', '{\"id\":245,\"assessment_id\":10,\"question_id\":20,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(277, '3be56dbe-ee21-4bfe-9b90-9cefe082c339', 'create', 246, 'responses', NULL, '[]', '{\"id\":246,\"assessment_id\":10,\"question_id\":21,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(278, '707c60ef-73e3-489c-b2a8-b5e8e1b8596e', 'create', 247, 'responses', NULL, '[]', '{\"id\":247,\"assessment_id\":10,\"question_id\":22,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(279, 'cf79202c-2dd8-482c-83eb-e88205fd8ac8', 'create', 248, 'responses', NULL, '[]', '{\"id\":248,\"assessment_id\":10,\"question_id\":23,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(280, '257a9175-dc2b-454b-8ad6-323d42690cf1', 'create', 249, 'responses', NULL, '[]', '{\"id\":249,\"assessment_id\":10,\"question_id\":24,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10'),
(281, '2160b24b-c546-4292-beff-172f6bed2f59', 'create', 250, 'responses', NULL, '[]', '{\"id\":250,\"assessment_id\":10,\"question_id\":25,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":3}', 1, NULL, '2026-07-15 11:35:10');
INSERT INTO `audit_logs` (`id`, `transaction`, `type`, `primary_key`, `source`, `parent_source`, `original`, `changed`, `meta`, `status`, `slug`, `created`) VALUES
(282, '212976a7-a39a-499d-a8be-f530152285c4', 'create', 11, 'assessments', NULL, '[]', '{\"id\":11,\"user_id\":6,\"phq9_score\":4,\"gad7_score\":3,\"pss4_score\":2,\"depression_level\":\"minimal\",\"anxiety_level\":\"minimal\",\"stress_level\":\"low\",\"overall_risk\":\"low\",\"is_flagged\":0,\"crisis_trigger\":0,\"status\":1,\"submitted_at\":\"2026-07-15T11:42:07+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(283, 'f9fcda4c-acb0-47fa-a9a8-81d2b7165a36', 'create', 251, 'responses', NULL, '[]', '{\"id\":251,\"assessment_id\":11,\"question_id\":1,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(284, 'd11359b7-df12-4b4b-bc41-576dd720dcc1', 'create', 252, 'responses', NULL, '[]', '{\"id\":252,\"assessment_id\":11,\"question_id\":2,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(285, '233cd1f5-2bde-4183-a559-cb8060c2859e', 'create', 253, 'responses', NULL, '[]', '{\"id\":253,\"assessment_id\":11,\"question_id\":3,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(286, 'a4a25e7e-77fe-4029-a0e4-e6edb0cb26d0', 'create', 254, 'responses', NULL, '[]', '{\"id\":254,\"assessment_id\":11,\"question_id\":4,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(287, '1b2a54a3-6f1e-4802-aed4-88db3f89ec25', 'create', 255, 'responses', NULL, '[]', '{\"id\":255,\"assessment_id\":11,\"question_id\":5,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(288, '5c817a89-7415-444d-a9c0-0facabaa2c14', 'create', 256, 'responses', NULL, '[]', '{\"id\":256,\"assessment_id\":11,\"question_id\":6,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(289, '9b077508-84fa-4bf4-976f-1703175ff1d9', 'create', 257, 'responses', NULL, '[]', '{\"id\":257,\"assessment_id\":11,\"question_id\":7,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(290, '8dd3ee9f-af52-4a4e-8b89-2adb71325b5f', 'create', 258, 'responses', NULL, '[]', '{\"id\":258,\"assessment_id\":11,\"question_id\":8,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(291, 'ae73a592-21a5-4726-a3ab-be70f297fa7c', 'create', 259, 'responses', NULL, '[]', '{\"id\":259,\"assessment_id\":11,\"question_id\":9,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(292, 'deed438c-33a9-4bb6-938a-08b7dffce4ec', 'create', 260, 'responses', NULL, '[]', '{\"id\":260,\"assessment_id\":11,\"question_id\":10,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(293, 'c170e5d7-8791-4f7d-b831-14232f67be14', 'create', 261, 'responses', NULL, '[]', '{\"id\":261,\"assessment_id\":11,\"question_id\":11,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(294, '6964093e-824c-44b9-9fbc-8b348aa4e032', 'create', 262, 'responses', NULL, '[]', '{\"id\":262,\"assessment_id\":11,\"question_id\":12,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(295, '24adfd4a-ee56-4fa8-8245-c373c976d9e7', 'create', 263, 'responses', NULL, '[]', '{\"id\":263,\"assessment_id\":11,\"question_id\":13,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(296, '59972f58-56b7-4c87-8839-fa7c994325cf', 'create', 264, 'responses', NULL, '[]', '{\"id\":264,\"assessment_id\":11,\"question_id\":14,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(297, 'd44f574a-4fb9-482e-99fa-ba21bbdd00db', 'create', 265, 'responses', NULL, '[]', '{\"id\":265,\"assessment_id\":11,\"question_id\":15,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(298, 'a77364df-11cb-463a-b86c-c13d70f6d2b0', 'create', 266, 'responses', NULL, '[]', '{\"id\":266,\"assessment_id\":11,\"question_id\":16,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(299, '5ca8ecf9-a8c0-49ca-8e41-022262f63e36', 'create', 267, 'responses', NULL, '[]', '{\"id\":267,\"assessment_id\":11,\"question_id\":17,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(300, '91f75fde-b1c5-4baf-88cc-581f36979805', 'create', 268, 'responses', NULL, '[]', '{\"id\":268,\"assessment_id\":11,\"question_id\":18,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(301, 'ae9fd3f1-6796-41cf-9a59-5d59884a12db', 'create', 269, 'responses', NULL, '[]', '{\"id\":269,\"assessment_id\":11,\"question_id\":19,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(302, '89ea00c3-0593-4abb-a099-28d5eaeec822', 'create', 270, 'responses', NULL, '[]', '{\"id\":270,\"assessment_id\":11,\"question_id\":20,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(303, 'd952af55-de4d-492c-b169-83c406ac4f31', 'create', 271, 'responses', NULL, '[]', '{\"id\":271,\"assessment_id\":11,\"question_id\":21,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(304, 'dd69a77e-6a51-4aff-9966-194cc412fee2', 'create', 272, 'responses', NULL, '[]', '{\"id\":272,\"assessment_id\":11,\"question_id\":22,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(305, 'e3ff72d2-a6f1-49fb-9d00-e911b0b0c5f7', 'create', 273, 'responses', NULL, '[]', '{\"id\":273,\"assessment_id\":11,\"question_id\":23,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(306, '68e73d49-fa00-4855-9226-376ff7858168', 'create', 274, 'responses', NULL, '[]', '{\"id\":274,\"assessment_id\":11,\"question_id\":24,\"response_value\":3}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(307, '340943bd-f2c6-4503-86e4-859681780264', 'create', 275, 'responses', NULL, '[]', '{\"id\":275,\"assessment_id\":11,\"question_id\":25,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:42:08'),
(308, '619e0022-3a6b-4469-a6a0-b786d1453153', 'create', 12, 'assessments', NULL, '[]', '{\"id\":12,\"user_id\":6,\"phq9_score\":14,\"gad7_score\":8,\"pss4_score\":6,\"depression_level\":\"moderate\",\"anxiety_level\":\"mild\",\"stress_level\":\"moderate\",\"overall_risk\":\"moderate\",\"is_flagged\":1,\"crisis_trigger\":0,\"status\":1,\"submitted_at\":\"2026-07-15T11:43:38+08:00\"}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:38'),
(309, '7c4f084e-b56f-47c5-a76f-3c0865095eb0', 'create', 276, 'responses', NULL, '[]', '{\"id\":276,\"assessment_id\":12,\"question_id\":1,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:38'),
(310, '08e000da-7de1-4a5d-975d-b0950705e47c', 'create', 277, 'responses', NULL, '[]', '{\"id\":277,\"assessment_id\":12,\"question_id\":2,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:38'),
(311, 'b7e7abc6-6856-461d-a631-4081678297a4', 'create', 278, 'responses', NULL, '[]', '{\"id\":278,\"assessment_id\":12,\"question_id\":3,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:38'),
(312, 'e7626492-9d95-4913-b84d-80da892aa542', 'create', 279, 'responses', NULL, '[]', '{\"id\":279,\"assessment_id\":12,\"question_id\":4,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(313, 'd48a68e2-a700-4edd-b435-59286a0f5ce9', 'create', 280, 'responses', NULL, '[]', '{\"id\":280,\"assessment_id\":12,\"question_id\":5,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(314, '878ffc90-5c54-4873-bd7a-5baed8f8e41f', 'create', 281, 'responses', NULL, '[]', '{\"id\":281,\"assessment_id\":12,\"question_id\":6,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(315, '24c76b6d-aa0f-4a70-822a-193cc501f10c', 'create', 282, 'responses', NULL, '[]', '{\"id\":282,\"assessment_id\":12,\"question_id\":7,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(316, '9ed03cd5-04ce-4b6d-9c7c-43069d79a74a', 'create', 283, 'responses', NULL, '[]', '{\"id\":283,\"assessment_id\":12,\"question_id\":8,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(317, '292d7eaf-c5b3-4452-b2cf-b3b95889bc08', 'create', 284, 'responses', NULL, '[]', '{\"id\":284,\"assessment_id\":12,\"question_id\":9,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(318, 'b29a8932-ef76-4d8c-9d60-4e3fcb2757e9', 'create', 285, 'responses', NULL, '[]', '{\"id\":285,\"assessment_id\":12,\"question_id\":10,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(319, '03b20980-9922-422d-91f8-5376491344d2', 'create', 286, 'responses', NULL, '[]', '{\"id\":286,\"assessment_id\":12,\"question_id\":11,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(320, '204da88a-a2e1-4c61-82aa-cdbcd1f64ba8', 'create', 287, 'responses', NULL, '[]', '{\"id\":287,\"assessment_id\":12,\"question_id\":12,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(321, '92166167-8533-477c-853f-bcf68683f239', 'create', 288, 'responses', NULL, '[]', '{\"id\":288,\"assessment_id\":12,\"question_id\":13,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(322, '34394f94-feb1-450c-89b3-994875a183c2', 'create', 289, 'responses', NULL, '[]', '{\"id\":289,\"assessment_id\":12,\"question_id\":14,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(323, 'fbd85132-d381-4ab8-819c-ae194a764a34', 'create', 290, 'responses', NULL, '[]', '{\"id\":290,\"assessment_id\":12,\"question_id\":15,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(324, '653cb1fd-937a-48a0-8ce5-2b432bb6eaee', 'create', 291, 'responses', NULL, '[]', '{\"id\":291,\"assessment_id\":12,\"question_id\":16,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(325, 'e6db5663-2193-4c3e-8c89-2249473cc2d8', 'create', 292, 'responses', NULL, '[]', '{\"id\":292,\"assessment_id\":12,\"question_id\":17,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(326, '3a1f2a09-f233-475e-ae7d-b07b4a23ceed', 'create', 293, 'responses', NULL, '[]', '{\"id\":293,\"assessment_id\":12,\"question_id\":18,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(327, '60c72173-1670-4014-802a-6672e7ea1df2', 'create', 294, 'responses', NULL, '[]', '{\"id\":294,\"assessment_id\":12,\"question_id\":19,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(328, 'c5e0098c-7fbd-4bb2-9cb9-d98d9c29d5d7', 'create', 295, 'responses', NULL, '[]', '{\"id\":295,\"assessment_id\":12,\"question_id\":20,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(329, '3f538724-2c30-4066-b3ca-acf1c5094fe6', 'create', 296, 'responses', NULL, '[]', '{\"id\":296,\"assessment_id\":12,\"question_id\":21,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(330, 'ba030f35-8641-461f-bb4b-bf89898f4a4c', 'create', 297, 'responses', NULL, '[]', '{\"id\":297,\"assessment_id\":12,\"question_id\":22,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(331, 'dfcab29b-51a0-411e-a43a-5e0ae5d35dc8', 'create', 298, 'responses', NULL, '[]', '{\"id\":298,\"assessment_id\":12,\"question_id\":23,\"response_value\":0}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(332, 'eafb84af-edd1-49cc-8a0d-16a18c20dafb', 'create', 299, 'responses', NULL, '[]', '{\"id\":299,\"assessment_id\":12,\"question_id\":24,\"response_value\":2}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(333, '08fe9364-30ec-47f0-b564-4f45e7567db9', 'create', 300, 'responses', NULL, '[]', '{\"id\":300,\"assessment_id\":12,\"question_id\":25,\"response_value\":1}', '{\"a_name\":\"Add\",\"c_name\":\"Assessments\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/assessments\\/add\",\"slug\":6}', 1, NULL, '2026-07-15 11:43:39'),
(334, 'e1fa83a0-73bd-4b15-96e8-1b55de0b8236', 'create', 7, 'counselor_notes', NULL, '[]', '{\"id\":7,\"assessment_id\":11,\"counselor_id\":2,\"clinical_note\":\"student are okay, just practice a healthy lifestyle\",\"action_taken\":\"no_action\",\"follow_up_date\":null,\"status\":0}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/add?assessment_id=11\",\"slug\":2}', 1, NULL, '2026-07-15 11:52:45'),
(335, '7b08b867-e665-461a-bf09-b458cf77e7dd', 'delete', 1, 'counselor_notes', NULL, NULL, NULL, '{\"a_name\":\"Delete\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/delete\\/1\",\"slug\":2}', 1, NULL, '2026-07-15 11:56:09'),
(336, '5ddbad28-2573-466e-b9f5-b6348ef940ae', 'create', 8, 'counselor_notes', NULL, '[]', '{\"id\":8,\"assessment_id\":10,\"counselor_id\":2,\"clinical_note\":\"already contact, and need to be prepared for another call\",\"action_taken\":\"contacted\",\"follow_up_date\":\"2026-07-16\",\"status\":1}', '{\"a_name\":\"Add\",\"c_name\":\"CounselorNotes\",\"ip\":\"127.0.0.1\",\"url\":\"http:\\/\\/mindease.test\\/counselor-notes\\/add\",\"slug\":2}', 1, NULL, '2026-07-15 11:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `ticket` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `note_admin` text,
  `ip` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `is_replied` tinyint(1) NOT NULL,
  `respond_date_time` datetime DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counselor_notes`
--

CREATE TABLE `counselor_notes` (
  `id` int NOT NULL,
  `assessment_id` int NOT NULL,
  `counselor_id` int NOT NULL,
  `clinical_note` text,
  `action_taken` varchar(50) DEFAULT 'no_action',
  `follow_up_date` date DEFAULT NULL,
  `status` int DEFAULT '1',
  `created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `counselor_notes`
--

INSERT INTO `counselor_notes` (`id`, `assessment_id`, `counselor_id`, `clinical_note`, `action_taken`, `follow_up_date`, `status`, `created`) VALUES
(2, 4, 2, 'yada yada', 'crisis_intervention', '2026-06-22', 1, '2026-06-22 03:18:50'),
(3, 4, 2, 'need to meet counselor', 'follow_up', '2026-06-22', 1, '2026-06-22 03:44:40'),
(4, 7, 2, 'need to see counselor for further action', 'follow_up', '2026-07-17', 1, '2026-07-14 00:15:47'),
(5, 9, 2, 'Student need to find friend to talk or you may come to share your problem with me. Im free on 21/7/2026', 'contacted', '2026-07-21', 1, '2026-07-15 00:35:13'),
(6, 9, 2, 'test test es', 'referred', '2026-07-23', 1, '2026-07-15 01:25:48'),
(7, 11, 2, 'student are okay, just practice a healthy lifestyle', 'no_action', NULL, 0, '2026-07-15 03:52:45'),
(8, 10, 2, 'already contact, and need to be prepared for another call', 'contacted', '2026-07-16', 1, '2026-07-15 03:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int NOT NULL,
  `category` varchar(100) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `slug`, `status`, `created`, `modified`) VALUES
(7, 'General', 'What is MindEase?', 'MindEase is a UiTM student mental wellness portal that allows students to complete confidential mental health assessments and receive support from qualified counselors.', 'what-is-mindease', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(8, 'General', 'Is my information kept confidential?', 'Yes. All your information and assessment results are strictly confidential and can only be viewed by you and your assigned counselor.', 'is-my-information-confidential', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(9, 'General', 'Who can use MindEase?', 'MindEase is available to all registered UiTM students. Counselors and administrators also have access based on their assigned roles.', 'who-can-use-mindease', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(10, 'Assessment', 'What is PHQ-9?', 'PHQ-9 (Patient Health Questionnaire-9) is a screening tool used to assess depression levels. It consists of 9 questions with a maximum score of 27.', 'what-is-phq9', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(11, 'Assessment', 'What is GAD-7?', 'GAD-7 (Generalized Anxiety Disorder-7) is a screening tool used to assess anxiety levels. It consists of 7 questions with a maximum score of 21.', 'what-is-gad7', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(12, 'Assessment', 'What is PSS-4?', 'PSS-4 (Perceived Stress Scale-4) is a brief questionnaire used to measure perceived stress levels. It consists of 4 questions with a maximum score of 16.', 'what-is-pss4', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(13, 'Assessment', 'What does a CRITICAL or HIGH score mean?', 'A CRITICAL score means you require immediate attention. A HIGH score means you should see a counselor as soon as possible. A counselor will be notified once your assessment is submitted.', 'what-does-critical-high-mean', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(14, 'Assessment', 'How often should I complete an assessment?', 'We recommend completing an assessment at least once a month, or whenever you feel the need to check in on your mental wellbeing.', 'how-often-assessment', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(15, 'Account', 'How do I change my password?', 'Log in to your account, go to Profile, then click the Password tab. Enter your new password and click Submit.', 'how-to-change-password', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(16, 'Account', 'How do I update my profile information?', 'Log in, go to Profile and click the Update tab. You can update your name, faculty, program and year of study.', 'how-to-update-profile', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(17, 'Account', 'I forgot my password. What should I do?', 'Click the Forgot Password link on the login page. Enter your email address and we will send you a link to reset your password.', 'forgot-password', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(18, 'Support', 'Who can I contact in an emergency?', 'In an emergency, please contact Talian Kasih: 15999, Befrienders KL: 03-76272929, or visit your nearest UiTM Counseling Center immediately.', 'emergency-contact', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19'),
(19, 'Support', 'How will a counselor contact me?', 'Your counselor will add notes in the system and may contact you via your university email or directly at the Counseling Center.', 'how-counselor-contacts', 1, '2026-06-28 18:44:19', '2026-06-28 18:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `lft` int DEFAULT NULL,
  `rght` int DEFAULT NULL,
  `level` int DEFAULT '0',
  `icon` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `auth` tinyint(1) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT NULL,
  `divider_before` tinyint(1) DEFAULT '0',
  `parent_separator` tinyint(1) DEFAULT NULL,
  `division` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `lft`, `rght`, `level`, `icon`, `controller`, `action`, `target`, `name`, `url`, `prefix`, `auth`, `admin`, `active`, `disabled`, `divider_before`, `parent_separator`, `division`) VALUES
(1, NULL, 1, 2, 0, '<i class=\"fa-solid fa-code\"></i>', 'Dashboards', 'Index', NULL, 'Dashboard', '', '', 1, 0, 1, 0, 0, 0, 0),
(2, NULL, 3, 4, 0, '<i class=\"fa-regular fa-circle-question\"></i>', 'Faqs', '', NULL, 'FAQs', '', '', 0, 0, 1, 0, 0, NULL, 0),
(3, NULL, 5, 6, 0, '<i class=\"fa-regular fa-message\"></i>', 'Contacts', 'Add', NULL, 'Contact Us', '', '', 0, 0, 1, NULL, 0, NULL, 0),
(4, NULL, 7, 14, 0, '<i class=\"fa-solid fa-circle-info\"></i>', 'Pages', 'manual', NULL, 'Documentation', '', '', 0, 0, 1, 0, 0, 1, 0),
(5, NULL, 15, 16, 0, '', '', '', NULL, 'Administrator', '', NULL, 0, 1, 1, NULL, 0, NULL, 1),
(6, NULL, 17, 18, 0, '<i class=\"fa-solid fa-gear\"></i>', 'Settings', 'Update', 'recrud', 'System Configuration', '', 'Admin', 1, 1, 1, NULL, 0, 0, 0),
(7, NULL, 19, 20, 0, '<i class=\"fa-solid fa-users-viewfinder\"></i>', 'Users', 'Index', NULL, 'User Management', '', 'Admin', 1, 1, 1, NULL, 0, NULL, 0),
(8, NULL, 21, 22, 0, '<i class=\"fa-solid fa-bars\"></i>', 'Menus', 'Index', NULL, 'Menu Management', '', 'Admin', 1, 1, 1, NULL, 0, 0, 0),
(9, NULL, 23, 24, 0, '<i class=\"menu-icon fa-solid fa-list-check\"></i>', 'Todos', 'Index', NULL, 'Todo List', '', 'Admin', 1, 1, 1, NULL, 0, NULL, 0),
(10, NULL, 25, 26, 0, '<i class=\"fa-regular fa-message\"></i>', 'Contacts', 'Index', NULL, 'Contact', '', 'Admin', 1, 1, 1, NULL, 0, NULL, 0),
(11, NULL, 27, 28, 0, '<i class=\"menu-icon fa-solid fa-timeline\"></i>', 'AuditLogs', 'Index', NULL, 'Audit Trail', '', 'Admin', 1, 1, 1, NULL, 0, NULL, 0),
(12, NULL, 29, 30, 0, '<i class=\"menu-icon fa-regular fa-circle-question\"></i>', 'Faqs', 'Index', NULL, 'FAQs', '', 'Admin', 1, 1, 1, NULL, 0, 0, 0),
(13, 4, 10, 11, 1, '<i class=\"fa-solid fa-code\"></i>', '', '', NULL, 'Code The Pixel', 'https://codethepixel.com/', '', 0, 0, 1, NULL, 0, 0, 0),
(14, 4, 8, 9, 1, '<i class=\"fa-regular fa-file-code\"></i>', 'Pages', 'manual', NULL, 'User Manual', '', '', 0, 0, 1, NULL, 0, 0, 0),
(15, 4, 12, 13, 1, '<i class=\"fa-brands fa-github\"></i>', '', '', NULL, 'Re-CRUD Github', 'https://github.com/Asyraf-wa/recrud', '', 0, 0, 1, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20241029053753, 'Initial', '2026-06-20 18:33:38', '2026-06-20 18:33:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `section` varchar(5) NOT NULL,
  `question_code` varchar(5) NOT NULL,
  `question_text` text NOT NULL,
  `response_type` varchar(30) DEFAULT NULL,
  `max_score` tinyint NOT NULL,
  `is_crisis_trigger` tinyint DEFAULT '0',
  `order_num` tinyint NOT NULL,
  `status` int DEFAULT '1',
  `created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `section`, `question_code`, `question_text`, `response_type`, `max_score`, `is_crisis_trigger`, `order_num`, `status`, `created`) VALUES
(1, 'A', 'A1', 'Little interest or pleasure in doing things', 'scale_0_3', 3, 0, 1, 1, '2026-06-20 19:53:01'),
(2, 'A', 'A2', 'Feeling down, depressed, or hopeless', 'scale_0_3', 3, 0, 2, 1, '2026-06-20 19:53:01'),
(3, 'A', 'A3', 'Trouble falling or staying asleep, or sleeping too much', 'scale_0_3', 3, 0, 3, 1, '2026-06-20 19:53:01'),
(4, 'A', 'A4', 'Feeling tired or having little energy', 'scale_0_3', 3, 0, 4, 1, '2026-06-20 19:53:01'),
(5, 'A', 'A5', 'Poor appetite or overeating', 'scale_0_3', 3, 0, 5, 1, '2026-06-20 19:53:01'),
(6, 'A', 'A6', 'Feeling bad about yourself or that you are a failure', 'scale_0_3', 3, 0, 6, 1, '2026-06-20 19:53:01'),
(7, 'A', 'A7', 'Trouble concentrating on things such as studying', 'scale_0_3', 3, 0, 7, 1, '2026-06-20 19:53:01'),
(8, 'A', 'A8', 'Moving or speaking slowly, or being fidgety and restless', 'scale_0_3', 3, 0, 8, 1, '2026-06-20 19:53:01'),
(9, 'A', 'A9', 'Thoughts of hurting yourself or being better off dead', 'scale_0_3', 3, 1, 9, 1, '2026-06-20 19:53:01'),
(10, 'B', 'B1', 'Feeling nervous, anxious, or on edge', 'scale_0_3', 3, 0, 10, 1, '2026-06-20 19:53:01'),
(11, 'B', 'B2', 'Not being able to stop or control worrying', 'scale_0_3', 3, 0, 11, 1, '2026-06-20 19:53:01'),
(12, 'B', 'B3', 'Worrying too much about different things', 'scale_0_3', 3, 0, 12, 1, '2026-06-20 19:53:01'),
(13, 'B', 'B4', 'Trouble relaxing', 'scale_0_3', 3, 0, 13, 1, '2026-06-20 19:53:01'),
(14, 'B', 'B5', 'Being so restless that it is hard to sit still', 'scale_0_3', 3, 0, 14, 1, '2026-06-20 19:53:01'),
(15, 'B', 'B6', 'Becoming easily annoyed or irritable', 'scale_0_3', 3, 0, 15, 1, '2026-06-20 19:53:01'),
(16, 'B', 'B7', 'Feeling afraid as if something awful might happen', 'scale_0_3', 3, 0, 16, 1, '2026-06-20 19:53:01'),
(17, 'C', 'C1', 'Been upset because of something that happened unexpectedly', 'scale_0_4', 4, 0, 17, 1, '2026-06-20 19:53:01'),
(18, 'C', 'C2', 'Felt unable to control the important things in your life', 'scale_0_4', 4, 0, 18, 1, '2026-06-20 19:53:01'),
(19, 'C', 'C3', 'Felt nervous and stressed', 'scale_0_4', 4, 0, 19, 1, '2026-06-20 19:53:01'),
(20, 'C', 'C4', 'Felt difficulties were piling up so high you could not overcome them', 'scale_0_4', 4, 0, 20, 1, '2026-06-20 19:53:01'),
(21, 'D', 'D1', 'How many hours of sleep do you usually get per night this week', 'dropdown', 0, 0, 21, 1, '2026-06-20 19:53:01'),
(22, 'D', 'D2', 'How would you rate your academic pressure level this week', 'scale_1_5', 5, 0, 22, 1, '2026-06-20 19:53:01'),
(23, 'D', 'D3', 'Do you have someone you can talk to when feeling down', 'dropdown', 0, 0, 23, 1, '2026-06-20 19:53:01'),
(24, 'D', 'D4', 'How often have you felt lonely or isolated on campus this week', 'dropdown', 0, 0, 24, 1, '2026-06-20 19:53:01'),
(25, 'D', 'D5', 'Have you engaged in any physical activity or exercise this week', 'dropdown', 0, 0, 25, 1, '2026-06-20 19:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int NOT NULL,
  `assessment_id` int NOT NULL,
  `question_id` int NOT NULL,
  `response_value` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `assessment_id`, `question_id`, `response_value`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 1),
(3, 1, 3, 2),
(4, 1, 4, 2),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 1),
(17, 1, 17, 2),
(18, 1, 18, 2),
(19, 1, 19, 2),
(20, 1, 20, 2),
(21, 1, 21, NULL),
(22, 1, 22, 5),
(23, 1, 23, NULL),
(24, 1, 24, NULL),
(25, 1, 25, NULL),
(26, 2, 1, 1),
(27, 2, 2, 2),
(28, 2, 3, 1),
(29, 2, 4, 2),
(30, 2, 5, 1),
(31, 2, 6, 2),
(32, 2, 7, 1),
(33, 2, 8, 2),
(34, 2, 9, 1),
(35, 2, 10, 2),
(36, 2, 11, 1),
(37, 2, 12, 2),
(38, 2, 13, 1),
(39, 2, 14, 2),
(40, 2, 15, 1),
(41, 2, 16, 2),
(42, 2, 17, 2),
(43, 2, 18, 3),
(44, 2, 19, 2),
(45, 2, 20, 3),
(46, 2, 21, NULL),
(47, 2, 22, 3),
(48, 2, 23, NULL),
(49, 2, 24, NULL),
(50, 2, 25, NULL),
(51, 3, 1, 0),
(52, 3, 2, 0),
(53, 3, 3, 1),
(54, 3, 4, 0),
(55, 3, 5, 1),
(56, 3, 6, 0),
(57, 3, 7, 0),
(58, 3, 8, 0),
(59, 3, 9, 0),
(60, 3, 10, 0),
(61, 3, 11, 1),
(62, 3, 12, 0),
(63, 3, 13, 0),
(64, 3, 14, 1),
(65, 3, 15, 0),
(66, 3, 16, 0),
(67, 3, 17, 0),
(68, 3, 18, 1),
(69, 3, 19, 0),
(70, 3, 20, 1),
(71, 3, 21, NULL),
(72, 3, 22, 1),
(73, 3, 23, NULL),
(74, 3, 24, NULL),
(75, 3, 25, NULL),
(76, 4, 1, 2),
(77, 4, 2, 1),
(78, 4, 3, 2),
(79, 4, 4, 3),
(80, 4, 5, 1),
(81, 4, 6, 3),
(82, 4, 7, 3),
(83, 4, 8, 1),
(84, 4, 9, 0),
(85, 4, 10, 0),
(86, 4, 11, 2),
(87, 4, 12, 3),
(88, 4, 13, 0),
(89, 4, 14, 3),
(90, 4, 15, 3),
(91, 4, 16, 1),
(92, 4, 17, 2),
(93, 4, 18, 4),
(94, 4, 19, 4),
(95, 4, 20, 2),
(96, 4, 21, NULL),
(97, 4, 22, 5),
(98, 4, 23, NULL),
(99, 4, 24, NULL),
(100, 4, 25, NULL),
(101, 5, 1, 2),
(102, 5, 2, 0),
(103, 5, 3, 1),
(104, 5, 4, 2),
(105, 5, 5, 1),
(106, 5, 6, 2),
(107, 5, 7, 1),
(108, 5, 8, 0),
(109, 5, 9, 0),
(110, 5, 10, 1),
(111, 5, 11, 1),
(112, 5, 12, 1),
(113, 5, 13, 2),
(114, 5, 14, 1),
(115, 5, 15, 1),
(116, 5, 16, 0),
(117, 5, 17, 1),
(118, 5, 18, 1),
(119, 5, 19, 0),
(120, 5, 20, 1),
(121, 5, 21, 0),
(122, 5, 22, 2),
(123, 5, 23, 0),
(124, 5, 24, 0),
(125, 5, 25, 0),
(126, 6, 1, 0),
(127, 6, 2, 1),
(128, 6, 3, 1),
(129, 6, 4, 2),
(130, 6, 5, 1),
(131, 6, 6, 2),
(132, 6, 7, 1),
(133, 6, 8, 0),
(134, 6, 9, 1),
(135, 6, 10, 1),
(136, 6, 11, 0),
(137, 6, 12, 1),
(138, 6, 13, 0),
(139, 6, 14, 1),
(140, 6, 15, 0),
(141, 6, 16, 1),
(142, 6, 17, 1),
(143, 6, 18, 1),
(144, 6, 19, 2),
(145, 6, 20, 2),
(146, 6, 21, 0),
(147, 6, 22, 2),
(148, 6, 23, 0),
(149, 6, 24, 0),
(150, 6, 25, 0),
(151, 7, 1, 2),
(152, 7, 2, 3),
(153, 7, 3, 1),
(154, 7, 4, 2),
(155, 7, 5, 0),
(156, 7, 6, 1),
(157, 7, 7, 1),
(158, 7, 8, 1),
(159, 7, 9, 1),
(160, 7, 10, 1),
(161, 7, 11, 0),
(162, 7, 12, 1),
(163, 7, 13, 0),
(164, 7, 14, 1),
(165, 7, 15, 0),
(166, 7, 16, 1),
(167, 7, 17, 1),
(168, 7, 18, 1),
(169, 7, 19, 1),
(170, 7, 20, 1),
(171, 7, 21, 1),
(172, 7, 22, 2),
(173, 7, 23, 1),
(174, 7, 24, 1),
(175, 7, 25, 0),
(176, 8, 1, 0),
(177, 8, 2, 0),
(178, 8, 3, 0),
(179, 8, 4, 0),
(180, 8, 5, 0),
(181, 8, 6, 0),
(182, 8, 7, 0),
(183, 8, 8, 0),
(184, 8, 9, 0),
(185, 8, 10, 0),
(186, 8, 11, 0),
(187, 8, 12, 0),
(188, 8, 13, 0),
(189, 8, 14, 0),
(190, 8, 15, 0),
(191, 8, 16, 0),
(192, 8, 17, 0),
(193, 8, 18, 0),
(194, 8, 19, 0),
(195, 8, 20, 0),
(196, 8, 21, 0),
(197, 8, 22, 1),
(198, 8, 23, 0),
(199, 8, 24, 1),
(200, 8, 25, 0),
(201, 9, 1, 1),
(202, 9, 2, 0),
(203, 9, 3, 1),
(204, 9, 4, 0),
(205, 9, 5, 0),
(206, 9, 6, 1),
(207, 9, 7, 0),
(208, 9, 8, 1),
(209, 9, 9, 0),
(210, 9, 10, 1),
(211, 9, 11, 1),
(212, 9, 12, 2),
(213, 9, 13, 2),
(214, 9, 14, 1),
(215, 9, 15, 1),
(216, 9, 16, 1),
(217, 9, 17, 0),
(218, 9, 18, 0),
(219, 9, 19, 1),
(220, 9, 20, 0),
(221, 9, 21, 0),
(222, 9, 22, 3),
(223, 9, 23, 0),
(224, 9, 24, 1),
(225, 9, 25, 1),
(226, 10, 1, 1),
(227, 10, 2, 0),
(228, 10, 3, 1),
(229, 10, 4, 0),
(230, 10, 5, 1),
(231, 10, 6, 0),
(232, 10, 7, 1),
(233, 10, 8, 0),
(234, 10, 9, 1),
(235, 10, 10, 0),
(236, 10, 11, 1),
(237, 10, 12, 0),
(238, 10, 13, 1),
(239, 10, 14, 0),
(240, 10, 15, 1),
(241, 10, 16, 0),
(242, 10, 17, 0),
(243, 10, 18, 1),
(244, 10, 19, 0),
(245, 10, 20, 1),
(246, 10, 21, 2),
(247, 10, 22, 1),
(248, 10, 23, 1),
(249, 10, 24, 1),
(250, 10, 25, 1),
(251, 11, 1, 0),
(252, 11, 2, 1),
(253, 11, 3, 0),
(254, 11, 4, 1),
(255, 11, 5, 0),
(256, 11, 6, 1),
(257, 11, 7, 0),
(258, 11, 8, 1),
(259, 11, 9, 0),
(260, 11, 10, 0),
(261, 11, 11, 1),
(262, 11, 12, 0),
(263, 11, 13, 1),
(264, 11, 14, 0),
(265, 11, 15, 0),
(266, 11, 16, 1),
(267, 11, 17, 0),
(268, 11, 18, 1),
(269, 11, 19, 0),
(270, 11, 20, 1),
(271, 11, 21, 1),
(272, 11, 22, 1),
(273, 11, 23, 1),
(274, 11, 24, 3),
(275, 11, 25, 0),
(276, 12, 1, 2),
(277, 12, 2, 1),
(278, 12, 3, 2),
(279, 12, 4, 2),
(280, 12, 5, 2),
(281, 12, 6, 2),
(282, 12, 7, 1),
(283, 12, 8, 2),
(284, 12, 9, 0),
(285, 12, 10, 1),
(286, 12, 11, 2),
(287, 12, 12, 1),
(288, 12, 13, 2),
(289, 12, 14, 1),
(290, 12, 15, 0),
(291, 12, 16, 1),
(292, 12, 17, 2),
(293, 12, 18, 1),
(294, 12, 19, 2),
(295, 12, 20, 1),
(296, 12, 21, 0),
(297, 12, 22, 2),
(298, 12, 23, 0),
(299, 12, 24, 2),
(300, 12, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` char(36) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `system_abbr` varchar(255) NOT NULL,
  `system_slogan` varchar(255) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notification_email` varchar(50) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_subject` varchar(255) NOT NULL,
  `meta_copyright` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `author` varchar(255) NOT NULL,
  `site_status` tinyint(1) NOT NULL,
  `user_reg` tinyint(1) NOT NULL,
  `config_2` tinyint(1) NOT NULL,
  `config_3` tinyint(1) NOT NULL,
  `version` varchar(255) NOT NULL,
  `private_key_from_recaptcha` varchar(255) DEFAULT NULL,
  `public_key_from_recaptcha` varchar(255) DEFAULT NULL,
  `banned_username` text,
  `telegram_bot_token` varchar(255) DEFAULT NULL,
  `telegram_chatid` varchar(255) DEFAULT NULL,
  `hcaptcha_sitekey` varchar(255) DEFAULT NULL,
  `hcaptcha_secretkey` varchar(255) DEFAULT NULL,
  `notification` text NOT NULL,
  `notification_status` tinyint(1) NOT NULL,
  `notification_date` date DEFAULT NULL,
  `ribbon_title` varchar(20) NOT NULL,
  `ribbon_link` varchar(255) NOT NULL,
  `ribbon_status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `system_abbr`, `system_slogan`, `organization_name`, `domain_name`, `email`, `notification_email`, `meta_title`, `meta_keyword`, `meta_subject`, `meta_copyright`, `meta_desc`, `timezone`, `author`, `site_status`, `user_reg`, `config_2`, `config_3`, `version`, `private_key_from_recaptcha`, `public_key_from_recaptcha`, `banned_username`, `telegram_bot_token`, `telegram_chatid`, `hcaptcha_sitekey`, `hcaptcha_secretkey`, `notification`, `notification_status`, `notification_date`, `ribbon_title`, `ribbon_link`, `ribbon_status`, `created`, `modified`) VALUES
('recrud', 'MindEase', 'MindEase', 'UiTM Student Mental Wellness Portal', 'Universiti Teknologi MARA (UiTM)', 'mindease.test', 'mindease@uitm.edu.my', 'noreply@uitm.edu.my', 'Re-CRUD', 'Re-CRUD, CakePHP, Learning, CRUD', 'Re-CRUD', 'Re-CRUD', 'Re-CRUD', 'Asia/Kuala_Lumpur', 'Group 1 ST1', 0, 0, 0, 0, '1.1', '', '', NULL, '', '', '', '', '<p><strong>Server maintenance</strong> is scheduled to be executed on Jan 1, 2023, from 1.00 am to 4.00 am. An intermittent connection is expected during the server maintenance period.</p>', 0, '2022-11-07', 'Code The Pixel', 'https://codethepixel.com', 0, '2020-04-08 20:56:04', '2026-06-20 21:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `urgency` varchar(255) NOT NULL COMMENT 'high, medium, low',
  `task` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `note` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending' COMMENT 'Pending, In Progress, Completed, Canceled',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `urgency`, `task`, `description`, `note`, `status`, `created`, `modified`) VALUES
('a02daac9-27e3-49ea-8090-927e60f9e255', '1', 'High', 'task 4 desc', '<p>task 4 desc</p>', '<p>task 4 desc</p>', 'In Progress', '2024-05-31 13:48:26', '2024-05-31 13:48:31'),
('a8618f9e-a3f7-4e7a-8a3f-05a5323cd5af', '1', 'High', 'task 1', '<p>task 1 desc</p>', '<p>task 1 desc</p>', 'Completed', '2024-05-31 13:45:22', '2024-05-31 13:45:40'),
('c892f026-c6f8-4353-82c2-75f49c0f5d6b', '1', 'Medium', 'Task 3 - Develop the To Do Task and render in Dashboard', '<p>task 3 desc</p>', '<p>task 3 desc</p>', 'Pending', '2024-05-31 13:48:06', '2024-05-31 13:48:06'),
('eda46e51-555a-4309-a28b-d0835bf4f4b2', '1', 'Low', 'task 2', '<p>task 2 desc</p>', '<p>task 2 desc</p>', 'Canceled', '2024-05-31 13:46:12', '2024-05-31 13:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user_group_id` int DEFAULT '3',
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `faculty` varchar(100) DEFAULT NULL,
  `program` varchar(100) DEFAULT NULL,
  `year_of_study` tinyint DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `avatar_dir` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_created_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '	is_active',
  `is_email_verified` int NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int DEFAULT NULL COMMENT 'user_id',
  `modified_by` int DEFAULT NULL COMMENT 'user_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `fullname`, `password`, `email`, `student_id`, `faculty`, `program`, `year_of_study`, `avatar`, `avatar_dir`, `token`, `token_created_at`, `status`, `is_email_verified`, `last_login`, `ip_address`, `slug`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 1, 'Administrator', '$2y$10$OrUKHzNQUic6dFqSuG9QBeDzMbbwPz1BQXKgBKPcQyMTNdv3Z22xe', 'admin@mindease.com', NULL, NULL, NULL, NULL, '', '', NULL, '2024-07-10 20:30:04', '1', 1, '2026-07-15 18:27:44', '127.0.0.1', 'Administrator', '2022-10-26 02:54:19', '2024-07-08 21:08:15', NULL, NULL),
(2, 2, 'Dr Sarah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'counselor@mindease.com', NULL, NULL, NULL, NULL, 'ChatGPT Image Jul 14, 2026, 11_43_00 AM.png', 'webroot\\files\\Users\\avatar\\dr-sarah', NULL, '0000-00-00 00:00:00', '1', 1, '2026-07-15 18:51:13', '127.0.0.1', 'dr-sarah', '2026-06-20 21:05:15', '2026-07-14 11:45:07', NULL, NULL),
(3, 3, 'Ahmad Raiyan Iman', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student@mindease.com', '123456', 'Faculty of Information Science', 'Bachelor of Information System Management', 1, 'ChatGPT Image Jul 14, 2026, 11_32_16 AM.png', 'webroot\\files\\Users\\avatar\\ahmad-student', NULL, '0000-00-00 00:00:00', '1', 1, '2026-07-15 18:36:17', '127.0.0.1', 'ahmad-student', '2026-06-20 21:05:15', '2026-07-14 11:34:28', NULL, NULL),
(4, 2, 'Dr Sarah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'counselor@mindease.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '1', 1, NULL, NULL, 'dr-sarah', '2026-06-20 21:07:39', '2026-06-20 21:07:39', NULL, NULL),
(5, 3, 'Ahmad Student', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student@mindease.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '1', 1, NULL, NULL, 'ahmad-student', '2026-06-20 21:07:39', '2026-06-20 21:07:39', NULL, NULL),
(6, 3, 'Damia Fakhira', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student2@mindease.com', '2024402302', 'Faculty of Information Science', 'Bachelor of Information System Management', 3, 'Gemini_Generated_Image_vzgoyavzgoyavzgo.png', 'webroot\\files\\Users\\avatar\\damia-fakhira', NULL, '0000-00-00 00:00:00', '1', 1, '2026-07-15 18:47:20', '127.0.0.1', 'damia-fakhira', '2026-07-15 08:24:20', '2026-07-15 08:26:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Admin', 'Admninistrator', '2021-01-23 13:21:29', '2021-01-23 13:21:29'),
(2, 'Counselor', 'Counselor - Review student assessments', '2021-01-23 13:21:29', '2021-01-23 13:21:29'),
(3, 'Student', 'Student - Submit wellness assessments', '2021-01-23 13:21:29', '2021-01-23 13:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `useragent` varchar(256) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `status` int DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `action`, `useragent`, `os`, `ip`, `host`, `referrer`, `status`, `created`, `modified`) VALUES
(1, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-20 18:40:57', '2026-06-20 18:40:57'),
(2, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-20 19:44:15', '2026-06-20 19:44:15'),
(3, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/', 1, '2026-06-20 21:08:18', '2026-06-20 21:08:18'),
(4, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-20 21:08:55', '2026-06-20 21:08:55'),
(5, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-20 21:08:57', '2026-06-20 21:08:57'),
(6, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-06-20 21:42:28', '2026-06-20 21:42:28'),
(7, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-20 21:42:38', '2026-06-20 21:42:38'),
(8, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-06-20 21:46:53', '2026-06-20 21:46:53'),
(9, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-20 21:47:02', '2026-06-20 21:47:02'),
(10, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-06-20 23:56:59', '2026-06-20 23:56:59'),
(11, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-20 23:59:26', '2026-06-20 23:59:26'),
(12, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/counselor-notes', 1, '2026-06-21 00:46:08', '2026-06-21 00:46:08'),
(13, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-21 21:05:30', '2026-06-21 21:05:30'),
(14, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-21 22:54:56', '2026-06-21 22:54:56'),
(15, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments/add', 1, '2026-06-22 02:01:04', '2026-06-22 02:01:04'),
(16, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-22 02:01:51', '2026-06-22 02:01:51'),
(17, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-06-22 02:04:53', '2026-06-22 02:04:53'),
(18, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-22 02:09:12', '2026-06-22 02:09:12'),
(19, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-06-22 02:10:40', '2026-06-22 02:10:40'),
(20, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-22 07:17:17', '2026-06-22 07:17:17'),
(21, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-22 07:25:42', '2026-06-22 07:25:42'),
(22, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-06-22 07:44:01', '2026-06-22 07:44:01'),
(23, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-22 07:48:42', '2026-06-22 07:48:42'),
(24, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-28 20:46:44', '2026-06-28 20:46:44'),
(25, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-28 20:47:31', '2026-06-28 20:47:31'),
(26, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', 'http://localhost/mindease/dashboard', 1, '2026-06-28 22:08:12', '2026-06-28 22:08:12'),
(27, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-28 22:08:37', '2026-06-28 22:08:37'),
(28, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-28 22:09:37', '2026-06-28 22:09:37'),
(29, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/', 1, '2026-06-28 22:11:26', '2026-06-28 22:11:26'),
(30, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-06-28 22:11:47', '2026-06-28 22:11:47'),
(31, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-11 15:16:11', '2026-07-11 15:16:11'),
(32, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', 'http://localhost/mindease/', 1, '2026-07-11 15:22:20', '2026-07-11 15:22:20'),
(33, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-11 15:23:10', '2026-07-11 15:23:10'),
(34, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', 'http://localhost/mindease/assessments', 1, '2026-07-11 15:29:22', '2026-07-11 15:29:22'),
(35, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-11 15:29:43', '2026-07-11 15:29:43'),
(36, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-13 13:30:19', '2026-07-13 13:30:19'),
(37, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', 'http://localhost/mindease/users/profile/ahmad-student', 1, '2026-07-13 13:56:40', '2026-07-13 13:56:40'),
(38, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-13 13:56:57', '2026-07-13 13:56:57'),
(39, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', 'http://localhost/mindease/faqs', 1, '2026-07-13 14:11:59', '2026-07-13 14:11:59'),
(40, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-13 14:33:20', '2026-07-13 14:33:20'),
(41, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-14 07:52:58', '2026-07-14 07:52:58'),
(42, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-14 10:08:53', '2026-07-14 10:08:53'),
(43, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-14 10:20:28', '2026-07-14 10:20:28'),
(44, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-14 10:24:14', '2026-07-14 10:24:14'),
(45, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-14 10:26:35', '2026-07-14 10:26:35'),
(46, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-14 10:29:15', '2026-07-14 10:29:15'),
(47, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/contact', 1, '2026-07-14 11:37:18', '2026-07-14 11:37:18'),
(48, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-14 11:44:14', '2026-07-14 11:44:14'),
(49, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-15 08:03:31', '2026-07-15 08:03:31'),
(50, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 08:03:57', '2026-07-15 08:03:57'),
(51, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/', 1, '2026-07-15 08:24:39', '2026-07-15 08:24:39'),
(52, 6, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 08:25:09', '2026-07-15 08:25:09'),
(53, 6, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments/view/9', 1, '2026-07-15 08:31:08', '2026-07-15 08:31:08'),
(54, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 08:31:26', '2026-07-15 08:31:26'),
(55, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-07-15 09:29:05', '2026-07-15 09:29:05'),
(56, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 09:33:11', '2026-07-15 09:33:11'),
(57, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/counselor-notes', 1, '2026-07-15 09:38:50', '2026-07-15 09:38:50'),
(58, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 09:39:26', '2026-07-15 09:39:26'),
(59, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 09:48:44', '2026-07-15 09:48:44'),
(60, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 11:08:55', '2026-07-15 11:08:55'),
(61, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '::1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 11:14:24', '2026-07-15 11:14:24'),
(62, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/', 1, '2026-07-15 11:14:42', '2026-07-15 11:14:42'),
(63, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 11:15:10', '2026-07-15 11:15:10'),
(64, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-15 11:32:00', '2026-07-15 11:32:00'),
(65, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 11:32:49', '2026-07-15 11:32:49'),
(66, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-07-15 11:40:37', '2026-07-15 11:40:37'),
(67, 6, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 11:40:53', '2026-07-15 11:40:53'),
(68, 6, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-15 11:44:38', '2026-07-15 11:44:38'),
(69, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 11:45:55', '2026-07-15 11:45:55'),
(70, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-15 12:00:56', '2026-07-15 12:00:56'),
(71, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 15:04:37', '2026-07-15 15:04:37'),
(72, 2, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/counselor-notes', 1, '2026-07-15 15:47:44', '2026-07-15 15:47:44'),
(73, 1, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 18:27:44', '2026-07-15 18:27:44'),
(74, 1, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-15 18:32:25', '2026-07-15 18:32:25'),
(75, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 18:32:42', '2026-07-15 18:32:42'),
(76, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/users/profile/ahmad-student', 1, '2026-07-15 18:34:02', '2026-07-15 18:34:02'),
(77, 6, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 18:34:24', '2026-07-15 18:34:24'),
(78, 6, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-07-15 18:36:00', '2026-07-15 18:36:00'),
(79, 3, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 18:36:17', '2026-07-15 18:36:17'),
(80, 3, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/assessments', 1, '2026-07-15 18:47:02', '2026-07-15 18:47:02'),
(81, 6, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 18:47:20', '2026-07-15 18:47:20'),
(82, 6, 'Logout', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', 'http://mindease.test/dashboard', 1, '2026-07-15 18:50:54', '2026-07-15 18:50:54'),
(83, 2, 'Login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'build 26200 (Windows 11)', '127.0.0.1', 'DESKTOP-K8ICM58', NULL, 1, '2026-07-15 18:51:13', '2026-07-15 18:51:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction` (`transaction`),
  ADD KEY `type` (`type`),
  ADD KEY `primary_key` (`primary_key`),
  ADD KEY `source` (`source`),
  ADD KEY `parent_source` (`parent_source`),
  ADD KEY `created` (`created`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counselor_notes`
--
ALTER TABLE `counselor_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lft` (`lft`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counselor_notes`
--
ALTER TABLE `counselor_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
