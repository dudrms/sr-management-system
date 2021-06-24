<!doctype html>
<html lang="en">
  <head>
    <?php include 'common-lib.php';?>    
    <title>SR Management</title>
  </head>
  <body>
    <div class="container mt-1">
      <?php include 'navbar.php';?>
  </br>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">사용된 소프트웨어</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">
    Codeigniter v4.*
    APM ( Apache, PHP 7, Maria DB ) Autoset 프로그램 사용
    </textarea>
    <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">사용한 JS/CSS</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="15">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- jquery -->

    <!-- jquery ui -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jquery ui -->

    <!-- bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    -->
    <!-- bootstrap CSS -->
    
    <!-- datatbles -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" type="text/javascript"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- datatbles -->

    <!-- chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    <!-- chartjs -->

    <!-- ckeditor 4.0 -->
    <script src="/sr/public/js/ckeditor_4.14.1_standard/ckeditor/ckeditor.js"></script>
    <!-- ckeditor 4.0 -->
    </textarea>
    <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">DB 설계</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="15">
-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 21-06-24 15:13
-- 서버 버전: 10.3.8-MariaDB
-- PHP 버전: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `srdb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `codes`
--

CREATE TABLE `codes` (
  `code` varchar(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `record_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `sr`
--

CREATE TABLE `sr` (
  `sr_id` varchar(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `type1` varchar(10) DEFAULT NULL,
  `type2` varchar(10) DEFAULT NULL,
  `type3` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `client_dept` varchar(100) DEFAULT NULL,
  `client` varchar(100) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `occur_date` varchar(10) DEFAULT NULL,
  `require_date` varchar(10) DEFAULT NULL,
  `complete_date` varchar(10) DEFAULT NULL,
  `work_hour` float DEFAULT NULL,
  `amt_new` int(5) DEFAULT NULL,
  `amt_modify` int(5) DEFAULT NULL,
  `end_yn` char(1) DEFAULT NULL,
  `create_date` varchar(10) DEFAULT NULL,
  `update_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `sr_v`
-- (See below for the actual view)
--
CREATE TABLE `sr_v` (
`sr_id` varchar(11)
,`title` varchar(255)
,`content` text
,`type1` varchar(10)
,`type2` varchar(10)
,`type3` varchar(10)
,`type1_desc` varchar(255)
,`type2_desc` varchar(255)
,`type3_desc` varchar(255)
,`status` varchar(10)
,`status_desc` varchar(255)
,`client_dept` varchar(100)
,`client` varchar(100)
,`manager` varchar(100)
,`occur_date` varchar(10)
,`require_date` varchar(10)
,`complete_date` varchar(10)
,`work_hour` float
,`amt_new` int(5)
,`amt_modify` int(5)
);

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `email` varchar(255) NOT NULL COMMENT 'Email Address',
  `contact_no` varchar(50) NOT NULL COMMENT 'Contact No',
  `created_at` varchar(20) NOT NULL COMMENT 'Created date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='datatable demo table';

-- --------------------------------------------------------

--
-- 뷰 구조 `sr_v`
--
DROP TABLE IF EXISTS `sr_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sr_v`  AS  select `sr`.`sr_id` AS `sr_id`,`sr`.`title` AS `title`,`sr`.`content` AS `content`,`sr`.`type1` AS `type1`,`sr`.`type2` AS `type2`,`sr`.`type3` AS `type3`,(select `codes`.`description` from `codes` where `codes`.`code` = `sr`.`type1`) AS `type1_desc`,(select `codes`.`description` from `codes` where `codes`.`code` = `sr`.`type2`) AS `type2_desc`,(select `codes`.`description` from `codes` where `codes`.`code` = `sr`.`type3`) AS `type3_desc`,`sr`.`status` AS `status`,(select `codes`.`description` from `codes` where `codes`.`code` = `sr`.`status`) AS `status_desc`,`sr`.`client_dept` AS `client_dept`,`sr`.`client` AS `client`,`sr`.`manager` AS `manager`,`sr`.`occur_date` AS `occur_date`,`sr`.`require_date` AS `require_date`,`sr`.`complete_date` AS `complete_date`,`sr`.`work_hour` AS `work_hour`,`sr`.`amt_new` AS `amt_new`,`sr`.`amt_modify` AS `amt_modify` from `sr` ;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`code`);

--
-- 테이블의 인덱스 `record`
--
ALTER TABLE `record`
  ADD UNIQUE KEY `id` (`id`);

--
-- 테이블의 인덱스 `sr`
--
ALTER TABLE `sr`
  ADD PRIMARY KEY (`sr_id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

    
    </textarea>
  </div>
</div>
</body>
<html>