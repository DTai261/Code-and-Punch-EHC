-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2021 lúc 11:10 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `game`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `challenge`
--

CREATE TABLE `challenge` (
  `chalId` int(20) NOT NULL,
  `challenge` varchar(250) DEFAULT NULL,
  `hints` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `challenge`
--

INSERT INTO `challenge` (`chalId`, `challenge`, `hints`) VALUES
(19, 'question.txt', 'abcd'),
(20, '', 'abc'),
(21, 'question.txt', 'abc'),
(22, 'question.txt', 'abc'),
(23, 'question.txt', 'abc'),
(24, '', 'abc'),
(25, '', 'abc'),
(26, '', ''),
(27, 'question.txt', 'abcde'),
(28, 'IAA292.txt', 'IAA292'),
(29, 'question.txt', 'question'),
(30, 'question.txt', 'question'),
(31, 'question.txt', 'question'),
(32, 'question.txt', 'question'),
(33, 'question.txt', 'question'),
(34, 'question.txt', 'question'),
(35, 'question.txt', 'question'),
(36, 'question.txt', 'question'),
(37, 'question.txt', 'question'),
(38, 'question.txt', 'question'),
(39, 'question.txt', 'question'),
(40, 'question.txt', 'question'),
(41, 'question.txt', 'question'),
(42, 'IAA292.txt', 'adđfffff');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`chalId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `challenge`
--
ALTER TABLE `challenge`
  MODIFY `chalId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
