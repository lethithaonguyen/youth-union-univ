-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 19, 2019 lúc 02:07 PM
-- Phiên bản máy phục vụ: 10.1.37-MariaDB
-- Phiên bản PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doanvudoantruong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chidoan`
--

CREATE TABLE `chidoan` (
  `ID` int(11) NOT NULL,
  `DOANKHOA_ID` int(11) NOT NULL,
  `KHOA_ID` int(11) NOT NULL,
  `TEN_CD` varchar(50) DEFAULT NULL,
  `NGAY_THANHLAP` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DUYET_CD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chidoan`
--

INSERT INTO `chidoan` (`ID`, `DOANKHOA_ID`, `KHOA_ID`, `TEN_CD`, `NGAY_THANHLAP`, `TAOMOI`, `CAPNHAT`, `DUYET_CD`) VALUES
(1, 1, 1, 'HTTT-A1', '2015-08-03', '2019-10-24 00:26:21', '2019-11-18 23:12:08', NULL),
(2, 1, 1, 'HTTT-A2', '2015-08-03', '2019-10-24 00:27:24', NULL, NULL),
(3, 3, 1, 'SHUD-A1', '2015-09-05', '2019-10-24 00:28:04', NULL, NULL),
(4, 3, 1, 'SHUD-A2', '2015-09-05', '2019-10-24 00:28:28', '2019-10-24 00:30:32', NULL),
(5, 2, 1, 'QLTS-A2', '2019-10-04', '2019-10-28 21:05:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_bau_ut`
--

CREATE TABLE `chitiet_bau_ut` (
  `ID` int(11) NOT NULL,
  `PHIEUDANHGIA_DOANVIEN_ID` int(11) NOT NULL,
  `PHIEUBAU_UUTU_ID` int(11) NOT NULL,
  `SOPHIEU_DONGY` int(11) DEFAULT NULL,
  `DUYET_BAU` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_ktkl`
--

CREATE TABLE `chitiet_ktkl` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `KHENTHUONG_KYLUAT_ID` int(11) NOT NULL,
  `NOIDUNG_KTKL` varchar(200) DEFAULT NULL,
  `NGAYBATDAU` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DUYET_KTKL` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitiet_ktkl`
--

INSERT INTO `chitiet_ktkl` (`ID`, `DOANVIEN_THANHNIEN_ID`, `KHENTHUONG_KYLUAT_ID`, `NOIDUNG_KTKL`, `NGAYBATDAU`, `TAOMOI`, `CAPNHAT`, `DUYET_KTKL`) VALUES
(1, 1, 1, 'thưởng thành tích học tập', '2019-04-01', '2019-11-04 22:37:03', '2019-11-05 03:33:15', NULL),
(2, 5, 2, 'Tuyên dương lòng dũng cảm, thương người', '2019-09-12', '2019-11-04 23:03:16', '2019-11-05 03:21:43', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_mauphieu`
--

CREATE TABLE `chitiet_mauphieu` (
  `ID` int(11) NOT NULL,
  `MAUPHIEU_ID` int(11) NOT NULL,
  `NOIDUNG_PDG_ID` int(11) NOT NULL,
  `THUTU_NOIDUNG` int(11) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitiet_mauphieu`
--

INSERT INTO `chitiet_mauphieu` (`ID`, `MAUPHIEU_ID`, `NOIDUNG_PDG_ID`, `THUTU_NOIDUNG`, `TAOMOI`, `CAPNHAT`) VALUES
(14, 1, 1, 1, '2019-11-05 00:00:54', '2019-11-05 00:00:54'),
(15, 1, 2, 2, '2019-11-05 00:00:54', '2019-11-05 00:00:54'),
(16, 1, 3, 3, '2019-11-05 00:00:54', '2019-11-05 00:00:54'),
(18, 1, 4, 4, '2019-11-05 00:01:08', '2019-11-05 00:01:08'),
(29, 2, 5, 1, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(30, 2, 6, 2, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(31, 2, 7, 3, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(32, 2, 8, 4, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(33, 2, 9, 5, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(34, 2, 10, 6, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(35, 2, 11, 7, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(36, 2, 12, 8, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(37, 2, 13, 9, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(38, 2, 14, 10, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(39, 2, 15, 11, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(40, 2, 16, 12, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(41, 2, 17, 13, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(42, 2, 18, 14, '2019-11-17 20:59:36', '2019-11-17 20:59:36'),
(43, 2, 19, 15, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(44, 2, 20, 16, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(45, 2, 21, 17, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(46, 2, 22, 18, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(47, 2, 23, 19, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(48, 2, 24, 20, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(49, 2, 25, 21, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(50, 2, 26, 22, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(51, 2, 27, 23, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(52, 2, 28, 24, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(53, 2, 29, 25, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(54, 2, 30, 26, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(55, 2, 31, 27, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(56, 2, 32, 28, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(57, 2, 33, 29, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(58, 2, 34, 30, '2019-11-17 20:59:37', '2019-11-17 20:59:37'),
(59, 2, 35, 31, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(60, 2, 36, 32, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(61, 2, 37, 33, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(62, 2, 38, 34, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(63, 2, 39, 35, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(64, 2, 40, 36, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(65, 2, 41, 37, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(66, 2, 42, 38, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(67, 2, 43, 39, '2019-11-17 21:01:12', '2019-11-17 21:01:12'),
(68, 2, 44, 40, '2019-11-17 21:01:12', '2019-11-17 21:01:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_pdg_cd`
--

CREATE TABLE `chitiet_pdg_cd` (
  `ID` int(11) NOT NULL,
  `PHIEUDANHGIA_CHIDOAN_ID` int(11) NOT NULL,
  `NOIDUNG_PDG_ID` int(11) NOT NULL,
  `DIEM_DUYET_PDGCD` int(11) DEFAULT NULL,
  `DIEM_CD_TUDANHGIA` int(11) DEFAULT NULL,
  `GHICHU_PDG_CD` varchar(200) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DUYET_PDGCD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_pdg_dk`
--

CREATE TABLE `chitiet_pdg_dk` (
  `ID` int(11) NOT NULL,
  `PHIEUDANHGIA_DOANKHOA_ID` int(11) NOT NULL,
  `NOIDUNG_PDG_ID` int(11) NOT NULL,
  `DIEM_DUYET_PDGDK` int(11) DEFAULT NULL,
  `DIEM_DK_TUDANHGIA` int(11) DEFAULT NULL,
  `GHICHU_PDGDK` varchar(200) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DUYET_PDG_DK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_pdg_dv`
--

CREATE TABLE `chitiet_pdg_dv` (
  `ID` int(11) NOT NULL,
  `PHIEUDANHGIA_DOANVIEN_ID` int(11) NOT NULL,
  `NOIDUNG_PDG_ID` int(11) NOT NULL,
  `NOIDUNG_TU_DANHGIA` varchar(1000) DEFAULT NULL,
  `GHICHU_PDGDV` varchar(200) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DUYET_PDG_DV` int(11) DEFAULT NULL COMMENT 'Null: Chưa duyệt, 1: Đã duyệt, 2:Không duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitiet_pdg_dv`
--

INSERT INTO `chitiet_pdg_dv` (`ID`, `PHIEUDANHGIA_DOANVIEN_ID`, `NOIDUNG_PDG_ID`, `NOIDUNG_TU_DANHGIA`, `GHICHU_PDGDV`, `TAOMOI`, `CAPNHAT`, `DUYET_PDG_DV`) VALUES
(9, 3, 1, 'tham me viet nam anh hung', NULL, '2019-11-13 03:59:44', '2019-11-17 02:31:33', 1),
(10, 3, 2, 'tham me viet nam anh hung', NULL, '2019-11-13 03:59:44', '2019-11-17 02:31:33', 1),
(11, 3, 3, 'tham me viet nam anh hung', NULL, '2019-11-13 03:59:44', '2019-11-17 02:32:25', 1),
(12, 3, 4, 'tham me viet nam anh hung', 'không hoàn thành', '2019-11-13 03:59:44', '2019-11-17 02:32:26', 2),
(13, 4, 1, 'tham me viet nam anh hung', 'sw', '2019-11-13 04:01:08', '2019-11-13 19:46:18', 1),
(14, 4, 2, 'tham me viet nam anh hung', 'sw', '2019-11-13 04:01:08', '2019-11-13 19:46:18', 1),
(15, 4, 3, 'tham me viet nam anh hung', 'sw', '2019-11-13 04:01:08', '2019-11-13 19:46:18', 1),
(16, 4, 4, 'tham me viet nam anh hung', 'sw', '2019-11-13 04:01:08', '2019-11-13 19:46:18', 1),
(17, 5, 1, 'tham me viet nam anh hung', NULL, '2019-11-13 07:02:47', '2019-11-17 04:03:19', 1),
(18, 5, 2, 'tham me viet nam anh hung', 'chitiet_pdg_dv', '2019-11-13 07:02:47', '2019-11-17 04:03:19', 1),
(19, 5, 3, 'tham me viet nam anh hung', 'chưa', '2019-11-13 07:02:47', '2019-11-17 04:03:20', 2),
(20, 5, 4, 'tham me viet nam anh hung', 'chitiet_pdg_dv', '2019-11-13 07:02:47', '2019-11-17 04:03:20', 1),
(23, 8, 1, 'dlkabf', NULL, '2019-11-17 05:41:51', '2019-11-17 05:41:51', NULL),
(24, 8, 2, 'dlkabf', NULL, '2019-11-17 05:41:51', '2019-11-17 05:41:51', NULL),
(25, 8, 3, 'dlkabf', NULL, '2019-11-17 05:41:51', '2019-11-17 05:41:51', NULL),
(26, 8, 4, 'dlkabf', NULL, '2019-11-17 05:41:52', '2019-11-17 05:41:52', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu_dv`
--

CREATE TABLE `chucvu_dv` (
  `ID` int(11) NOT NULL,
  `TEN_CHUCVU` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chucvu_dv`
--

INSERT INTO `chucvu_dv` (`ID`, `TEN_CHUCVU`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Bí thư', '2019-10-30 03:52:16', '2019-10-30 03:52:16'),
(2, 'Phó bí thư', '2019-10-30 03:52:16', '2019-10-30 03:52:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `co_vaitro`
--

CREATE TABLE `co_vaitro` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `VAITRO_ID` int(11) NOT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_chucvu_dv`
--

CREATE TABLE `ct_chucvu_dv` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `CHUCVU_DV_ID` int(11) NOT NULL,
  `NGAYBD_CV` date DEFAULT NULL,
  `NGAYKT_CV` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ct_chucvu_dv`
--

INSERT INTO `ct_chucvu_dv` (`ID`, `DOANVIEN_THANHNIEN_ID`, `CHUCVU_DV_ID`, `NGAYBD_CV`, `NGAYKT_CV`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 1, '2019-11-12', '2019-11-30', '2019-11-04 03:04:41', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dantoc`
--

CREATE TABLE `dantoc` (
  `ID` int(11) NOT NULL,
  `TEN_DT` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dantoc`
--

INSERT INTO `dantoc` (`ID`, `TEN_DT`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Kinh', '2019-10-30 03:52:49', '2019-10-30 03:52:49'),
(3, 'Mường', '2019-11-04 21:30:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doankhoa`
--

CREATE TABLE `doankhoa` (
  `ID` int(11) NOT NULL,
  `TEN_DK` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `doankhoa`
--

INSERT INTO `doankhoa` (`ID`, `TEN_DK`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'CNTT & TT', '2019-10-24 00:24:17', NULL),
(2, 'Thủy sản', '2019-10-24 00:24:29', NULL),
(3, 'Nông nghiệp', '2019-10-24 00:24:36', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanphi_thu_cd`
--

CREATE TABLE `doanphi_thu_cd` (
  `ID` int(11) NOT NULL,
  `CHIDOAN_ID` int(11) NOT NULL,
  `THANGNAM_ID` int(11) NOT NULL,
  `NGAY_DONG_CD` date NOT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DADONG` int(11) DEFAULT NULL,
  `namhoc_dp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `doanphi_thu_cd`
--

INSERT INTO `doanphi_thu_cd` (`ID`, `CHIDOAN_ID`, `THANGNAM_ID`, `NGAY_DONG_CD`, `TAOMOI`, `CAPNHAT`, `DADONG`, `namhoc_dp`) VALUES
(109, 1, 37, '2019-11-18', NULL, '2019-11-17 18:32:10', 1, 2),
(110, 1, 38, '2019-11-18', NULL, '2019-11-17 18:32:10', 1, 2),
(111, 1, 39, '2019-11-18', NULL, '2019-11-17 18:32:10', 1, 2),
(112, 1, 40, '2019-11-18', NULL, '2019-11-17 18:32:11', 1, 2),
(113, 2, 37, '2019-11-18', NULL, '2019-11-17 18:32:11', 1, 2),
(114, 2, 38, '2019-11-18', NULL, '2019-11-17 18:32:11', 1, 2),
(115, 2, 39, '2019-11-18', NULL, '2019-11-17 18:32:11', 1, 2),
(116, 1, 25, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(117, 1, 26, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(118, 1, 27, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(119, 1, 28, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(120, 1, 29, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(121, 1, 30, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(122, 1, 31, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(123, 1, 32, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(124, 1, 33, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(125, 2, 25, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(126, 2, 26, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(127, 2, 27, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(128, 2, 28, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(129, 2, 29, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(130, 2, 30, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(131, 2, 31, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(132, 2, 32, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(133, 2, 33, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(134, 2, 34, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(135, 2, 35, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1),
(136, 2, 36, '2019-11-18', NULL, '2019-11-18 01:40:54', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanphi_thu_dk`
--

CREATE TABLE `doanphi_thu_dk` (
  `ID` int(11) NOT NULL,
  `DOANKHOA_ID` int(11) NOT NULL,
  `THANGNAM_ID` int(11) NOT NULL,
  `NGAY_DONG_DK` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DADONG` int(11) DEFAULT NULL,
  `namhoc_dp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `doanphi_thu_dk`
--

INSERT INTO `doanphi_thu_dk` (`ID`, `DOANKHOA_ID`, `THANGNAM_ID`, `NGAY_DONG_DK`, `TAOMOI`, `CAPNHAT`, `DADONG`, `namhoc_dp`) VALUES
(13, 1, 39, '2019-11-16', NULL, '2019-11-15 21:10:52', 1, 2),
(14, 2, 38, '2019-11-16', NULL, '2019-11-15 21:10:52', 1, 2),
(15, 2, 39, '2019-11-16', NULL, '2019-11-15 21:10:52', 1, 2),
(16, 3, 38, '2019-11-16', NULL, '2019-11-15 21:10:52', 1, 2),
(17, 3, 39, '2019-11-16', NULL, '2019-11-15 21:10:52', 1, 2),
(18, 3, 40, '2019-11-16', NULL, '2019-11-15 21:10:52', 1, 2),
(67, 1, 25, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(68, 1, 26, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(69, 1, 27, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(70, 1, 28, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(71, 1, 29, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(72, 1, 30, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(73, 1, 34, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(74, 1, 35, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(75, 1, 36, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(76, 2, 26, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1),
(77, 3, 25, '2019-11-18', NULL, '2019-11-17 19:48:38', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanphi_thu_dv`
--

CREATE TABLE `doanphi_thu_dv` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `THANGNAM_ID` int(11) NOT NULL,
  `NGAY_DONG_DP_DV` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `namhoc_dp` int(11) DEFAULT NULL,
  `DADONG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `doanphi_thu_dv`
--

INSERT INTO `doanphi_thu_dv` (`ID`, `DOANVIEN_THANHNIEN_ID`, `THANGNAM_ID`, `NGAY_DONG_DP_DV`, `TAOMOI`, `CAPNHAT`, `namhoc_dp`, `DADONG`) VALUES
(90, 2, 37, '2019-11-16', NULL, '2019-11-16 01:10:20', 2, 1),
(91, 2, 38, '2019-11-16', NULL, '2019-11-16 01:10:20', 2, 1),
(92, 4, 37, '2019-11-16', NULL, '2019-11-16 01:10:20', 2, 1),
(93, 4, 38, '2019-11-16', NULL, '2019-11-16 01:10:21', 2, 1),
(94, 4, 39, '2019-11-16', NULL, '2019-11-16 01:10:21', 2, 1),
(95, 7, 37, '2019-11-16', NULL, '2019-11-16 01:10:21', 2, 1),
(96, 7, 38, '2019-11-16', NULL, '2019-11-16 01:10:21', 2, 1),
(97, 7, 39, '2019-11-16', NULL, '2019-11-16 01:10:21', 2, 1),
(117, 2, 25, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(118, 2, 26, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(119, 2, 27, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(120, 2, 28, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(121, 4, 25, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(122, 4, 26, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(123, 4, 27, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(124, 7, 25, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(125, 7, 26, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(126, 7, 27, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1),
(127, 7, 28, '2019-11-19', NULL, '2019-11-19 03:27:11', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanvien_thanhnien`
--

CREATE TABLE `doanvien_thanhnien` (
  `ID` int(11) NOT NULL,
  `PHUONG_XA_ID_QQ` int(11) NOT NULL,
  `CHIDOAN_ID` int(11) NOT NULL,
  `TONGIAO_ID` int(11) DEFAULT NULL,
  `PHUONG_XA_ID_NS` int(11) NOT NULL,
  `DANTOC_ID` int(11) NOT NULL,
  `MSSV` varchar(12) NOT NULL,
  `TEN_SV` varchar(50) DEFAULT NULL,
  `NGAYSINH_SV` date DEFAULT NULL,
  `DIACHI_SV` varchar(50) DEFAULT NULL,
  `PHAI_SV` varchar(5) DEFAULT NULL,
  `SDT_SV` char(10) DEFAULT NULL,
  `EMAIL_SV` varchar(20) DEFAULT NULL,
  `NGAYVAODOAN_SV` date DEFAULT NULL,
  `NOIVAODOAN_SV` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `doanvien_thanhnien`
--

INSERT INTO `doanvien_thanhnien` (`ID`, `PHUONG_XA_ID_QQ`, `CHIDOAN_ID`, `TONGIAO_ID`, `PHUONG_XA_ID_NS`, `DANTOC_ID`, `MSSV`, `TEN_SV`, `NGAYSINH_SV`, `DIACHI_SV`, `PHAI_SV`, `SDT_SV`, `EMAIL_SV`, `NGAYVAODOAN_SV`, `NOIVAODOAN_SV`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 2, 2, 1, 1, 1, 'B1505790', 'Le Thi Thao Nguyen', '1998-04-03', 'Vinh Long', 'Nam', '016570589', 'nguyenle@gmail.com', '0000-00-00', 'Vĩnh Long', '2019-11-03 02:42:17', NULL),
(2, 2, 1, 1, 1, 1, 'B1505789', 'Le Thi Thao', '1998-12-19', 'Can Tho', 'Nữ', '09876554', 'thaole@gmail.com', '2019-11-05', 'Vĩnh Long', '2019-11-03 02:43:45', NULL),
(4, 1, 1, 2, 1, 1, 'B1505790', 'Le Tuyet Man', '1997-12-31', 'Vinh Long', 'Nữ', '098643267', 'tuyetman@gmail.com', '2019-11-05', 'Vĩnh Long', '2019-11-04 22:05:17', NULL),
(5, 2, 2, 2, 2, 1, 'B1505798', 'Le Man Thao Nghi', '1997-07-05', 'Can Tho', 'Nữ', '0165705187', 'thaonghi@gmail.com', '2019-11-05', 'Vĩnh Long', '2019-11-04 22:06:31', NULL),
(6, 1, 5, 1, 2, 1, 'B1505776', 'Le Tuyet Nghi Man', '1997-04-04', 'Vinh Long', 'Nam', '016570597', 'nghiman@gmail.com', '2019-11-05', 'Vĩnh Long', '2019-11-04 22:09:10', NULL),
(7, 1, 1, 1, 2, 1, 'B1505789', 'Le Tuyet Nghi Linh', '1997-11-19', 'Vinh Long', 'Nữ', '01657051', 'linhle@gmail.com', '2019-11-05', 'Vĩnh Long', '2019-11-14 02:09:01', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dv_ketnap`
--

CREATE TABLE `dv_ketnap` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `NGAYKETNAP` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dv_ketnap`
--

INSERT INTO `dv_ketnap` (`ID`, `DOANVIEN_THANHNIEN_ID`, `NGAYKETNAP`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 2, '2019-11-05', '2019-11-03 03:16:04', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dv_tt_doan`
--

CREATE TABLE `dv_tt_doan` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `NGAYTTDOAN` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dv_tt_doan`
--

INSERT INTO `dv_tt_doan` (`ID`, `DOANVIEN_THANHNIEN_ID`, `NGAYTTDOAN`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, '2019-11-15', '2019-11-07 08:56:03', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhthuc_ktkl`
--

CREATE TABLE `hinhthuc_ktkl` (
  `ID` int(11) NOT NULL,
  `TEN_HT` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hinhthuc_ktkl`
--

INSERT INTO `hinhthuc_ktkl` (`ID`, `TEN_HT`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'bằng khen', '2019-11-04 22:16:02', NULL),
(2, 'tiền mặt', '2019-11-04 22:16:10', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

CREATE TABLE `hocky` (
  `ID` int(11) NOT NULL,
  `NAMHOC_ID` int(11) NOT NULL,
  `TEN_HK` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`ID`, `NAMHOC_ID`, `TEN_HK`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 'HK1', '2019-11-18 04:44:48', NULL),
(2, 1, 'HK2', '2019-11-18 04:44:58', NULL),
(3, 1, 'HK hè', '2019-11-18 04:46:42', '2019-11-18 04:47:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khenthuong_kyluat`
--

CREATE TABLE `khenthuong_kyluat` (
  `ID` int(11) NOT NULL,
  `LOAI_KTKL_ID` int(11) NOT NULL,
  `HINHTHUC_KTKL_ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `TEN_KTKL` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khenthuong_kyluat`
--

INSERT INTO `khenthuong_kyluat` (`ID`, `LOAI_KTKL_ID`, `HINHTHUC_KTKL_ID`, `DOANVIEN_THANHNIEN_ID`, `TEN_KTKL`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 2, 4, 'Học bỗng mỗi học kỳ', '2019-11-04 22:25:30', NULL),
(2, 2, 1, 4, 'Tình nguyện hiến máu', '2019-11-04 22:26:21', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

CREATE TABLE `khoa` (
  `ID` int(11) NOT NULL,
  `TEN_KHOA` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`ID`, `TEN_KHOA`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'K41', '2019-10-24 00:25:21', NULL),
(2, 'K42', '2019-10-24 00:25:27', NULL),
(3, 'k43', '2019-10-24 00:25:34', NULL),
(4, 'k44', '2019-10-24 00:25:41', NULL),
(5, 'K45', '2019-10-24 00:25:49', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kieu_dulieu`
--

CREATE TABLE `kieu_dulieu` (
  `ID` int(11) NOT NULL,
  `TEN_KIEU_DULIEU` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `kieu_dulieu`
--

INSERT INTO `kieu_dulieu` (`ID`, `TEN_KIEU_DULIEU`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'text', '2019-11-04 01:06:54', NULL),
(2, 'number', '2019-11-04 01:07:03', NULL),
(3, 'date', '2019-11-04 01:07:16', NULL),
(4, 'datetime', '2019-11-04 01:07:25', NULL),
(5, 'checkbox', '2019-11-17 14:01:56', '2019-11-17 14:01:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_ktkl`
--

CREATE TABLE `loai_ktkl` (
  `ID` int(11) NOT NULL,
  `TEN_LOAIKTKL` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_ktkl`
--

INSERT INTO `loai_ktkl` (`ID`, `TEN_LOAIKTKL`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'học tập', '2019-11-04 22:14:25', NULL),
(2, 'hoạt động tình nguyện', '2019-11-04 22:14:39', NULL),
(3, 'đoàn viên ưu tú', '2019-11-04 22:14:55', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_noidung_chi`
--

CREATE TABLE `loai_noidung_chi` (
  `ID` int(11) NOT NULL,
  `TEN_LOAI_DP` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_noidung_chi`
--

INSERT INTO `loai_noidung_chi` (`ID`, `TEN_LOAI_DP`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Phiếu chi cho văn nghệ', '2019-11-18 04:31:19', NULL),
(2, 'Phiếu chi cho tình nguyện', '2019-11-18 04:31:37', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_noidung_pdg`
--

CREATE TABLE `loai_noidung_pdg` (
  `ID` int(11) NOT NULL,
  `TEN_LOAI_NDPDG` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_noidung_pdg`
--

INSERT INTO `loai_noidung_pdg` (`ID`, `TEN_LOAI_NDPDG`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Thành tích', '2019-11-04 06:38:07', NULL),
(2, 'Kỷ luật', '2019-11-04 06:38:31', NULL),
(3, 'Tiêu chuẩn chi đoàn', '2019-11-17 13:40:43', '2019-11-17 13:40:43'),
(4, 'Tiêu chuẩn đoàn khoa', '2019-11-17 13:40:43', '2019-11-17 13:40:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_pt`
--

CREATE TABLE `loai_pt` (
  `ID` int(11) NOT NULL,
  `TEN_LOAI_PT` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_pt`
--

INSERT INTO `loai_pt` (`ID`, `TEN_LOAI_PT`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Văn nghệ', '2019-11-18 04:42:53', NULL),
(2, 'Thể thao', '2019-11-18 04:43:00', NULL),
(3, 'Tình nguyện', '2019-11-18 04:43:07', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mauphieu`
--

CREATE TABLE `mauphieu` (
  `ID` int(11) NOT NULL,
  `TEN_MP` varchar(100) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `mauphieu`
--

INSERT INTO `mauphieu` (`ID`, `TEN_MP`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Phiếu đánh giá cá nhân', '2019-11-04 01:01:58', '2019-11-04 01:03:55'),
(2, 'Phiếu đánh giá tập thể', '2019-11-04 01:02:33', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `namhoc`
--

CREATE TABLE `namhoc` (
  `ID` int(11) NOT NULL,
  `TEN_NH` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `namhoc`
--

INSERT INTO `namhoc` (`ID`, `TEN_NH`, `TAOMOI`, `CAPNHAT`) VALUES
(1, '2015-2016', '2019-10-23 20:34:01', '2019-11-18 04:43:53'),
(2, '2016-2017', '2019-10-23 20:34:08', '2019-11-18 04:44:08'),
(3, '2017-2018', '2019-10-23 20:34:16', '2019-11-18 04:44:17'),
(4, '2018-2019', '2019-10-23 20:34:45', '2019-11-18 04:44:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `noidung_pdg`
--

CREATE TABLE `noidung_pdg` (
  `ID` int(11) NOT NULL,
  `NOIDUNG_PDG_ID_CHA` int(11) DEFAULT NULL,
  `KIEU_DULIEU_ID` int(11) NOT NULL,
  `LOAI_NOIDUNG_PDG_ID` int(11) NOT NULL,
  `TEN_NDPDG` varchar(50) DEFAULT NULL,
  `NOIDUNG_PDG` varchar(2000) DEFAULT NULL,
  `DIEMTOIDA_NDPDG` int(11) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `noidung_pdg`
--

INSERT INTO `noidung_pdg` (`ID`, `NOIDUNG_PDG_ID_CHA`, `KIEU_DULIEU_ID`, `LOAI_NOIDUNG_PDG_ID`, `TEN_NDPDG`, `NOIDUNG_PDG`, `DIEMTOIDA_NDPDG`, `TAOMOI`, `CAPNHAT`) VALUES
(1, NULL, 1, 1, 'Cấp đoàn trường', 'Cấp đoàn trường', 10, '2019-11-04 06:40:43', '2019-11-04 06:53:09'),
(2, NULL, 1, 1, 'Hội sinh viên trường', 'Hội sinh viên trường', 12, '2019-11-04 06:49:19', NULL),
(3, NULL, 1, 1, 'Đoàn khoa, khối trực, trực thuộc', 'Đoàn khoa, khối trực, trực thuộc', 15, '2019-11-04 06:59:14', NULL),
(4, NULL, 1, 1, 'Các hoạt động khác', 'Các hoạt động khác', 20, '2019-11-04 07:00:05', NULL),
(5, NULL, 5, 3, 'Tiêu chuẩn chi đoàn vững mạnh', '- Đạt các tiêu chuẩn Chi đoàn khá.', NULL, '2019-11-17 16:02:40', '2019-11-17 16:02:40'),
(6, NULL, 5, 3, ' Tiêu chuẩn chi đoàn vững mạnh', '        - Tổ chức sinh hoạt, hoạt động chi đoàn ít nhất 12 lần/năm; sáng tạo, tích cực, chủ động thực hiện xuất sắc các nhiệm vụ do cấp bộ Đoàn cấp trên giao.', NULL, '2019-11-17 16:02:40', '2019-11-17 16:02:40'),
(7, NULL, 5, 3, 'Tiêu chuẩn chi đoàn vững mạnh', '        - Thực hiện đầy đủ và nghiêm túc các qui định của Đoàn khoa, Đoàn trường về công tác quản lý sổ sách, chế độ báo cáo định kỳ.', NULL, '2019-11-17 16:03:51', '2019-11-17 16:03:51'),
(8, NULL, 5, 3, 'Tiêu chuẩn chi đoàn vững mạnh', '- Thu, nộp đoàn phí đúng quy định.', NULL, '2019-11-17 16:03:51', '2019-11-17 16:03:51'),
(9, NULL, 5, 3, 'Tiêu chuẩn chi đoàn vững mạnh', '- 100% đoàn viên trong chi đoàn đăng ký và thực hiện Chương trình rèn luyện đoàn viên.', NULL, '2019-11-17 16:05:07', '2019-11-17 16:05:07'),
(10, NULL, 5, 3, 'Tiêu chuẩn chi đoàn vững mạnh', '- Kết nạp được đoàn viên mới (nếu đơn vị còn nguồn để bồi dưỡng kết nạp); giới thiệu được đoàn viên ưu tú cho Đảng xem xét kết nạp.', NULL, '2019-11-17 16:05:07', '2019-11-17 16:05:07'),
(11, NULL, 5, 3, 'Tiêu chuẩn chi đoàn vững mạnh', '- Ít nhất 80% đoàn viên trong chi đoàn xếp loại khá trở lên, không có đoàn viên xếp loại yếu.', NULL, '2019-11-17 16:06:30', '2019-11-17 16:06:30'),
(12, NULL, 5, 3, ' Tiêu chuẩn chi đoàn vững mạnh', '- Tổ chức được ít nhất 1 buổi/ học kỳ nội dung sinh hoạt truyền thống Đoàn thanh niên cộng sản Hồ Chí Minh cho Chi đoàn. ', NULL, '2019-11-17 16:06:30', '2019-11-17 16:06:30'),
(13, NULL, 5, 3, 'Tiêu chuẩn chi đoàn khá', '- Có từ 80% đến dưới 100% đoàn viên trong Chi đoàn đăng ký và thực hiện Chương trình rèn luyện đoàn viên.', NULL, '2019-11-17 16:08:26', '2019-11-17 16:08:26'),
(14, NULL, 5, 3, 'Tiêu chuẩn chi đoàn khá', '- Kết nạp được đoàn viên mới (nếu đơn vị còn nguồn để bồi dưỡng kết nạp); giới thiệu được đoàn viên ưu tú cho Đảng xem xét kết nạp, nhưng kết quả nội dung công tác này chưa thực sự xuất sắc (kết nạp đoàn viên mới chưa được nhiều, trong khi nguồn thanh niên còn nhiều; việc bồi dưỡng đoàn viên ưu tú giới thiệu cho Đảng còn hình thức, chất lượng chưa cao…)', NULL, '2019-11-17 16:08:26', '2019-11-17 16:08:26'),
(15, NULL, 5, 3, 'Tiêu chuẩn chi đoàn khá', '- Từ 60% đến dưới 80% đoàn viên trong Chi đoàn xếp loại khá trở lên, không có đoàn viên xếp loại yếu.', NULL, '2019-11-17 16:09:38', '2019-11-17 16:09:38'),
(16, NULL, 5, 3, 'Tiêu chuẩn chi đoàn khá', '- Chủ động đề ra ít nhất 1 hoạt động/học kỳ và tổ chức các hoạt động của chi đoàn, đáp ứng nhu cầu, nguyện vọng chung của đoàn viên, thanh niên. ', NULL, '2019-11-17 16:09:38', '2019-11-17 16:09:38'),
(17, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Tổ chức sinh hoạt, hoạt động Chi đoàn ít nhất 10 lần/năm; chưa chủ động thực hiện các nhiệm vụ do cấp bộ Đoàn cấp trên giao.', NULL, '2019-11-17 16:11:38', '2019-11-17 16:11:38'),
(18, NULL, 5, 3, 'Tiêu chuẩn chi trung bình', '- Thu, nộp đoàn phí đầy đủ nhưng không đúng thời gian quy định hoặc thu, nộp chưa đầy đủ, Đoàn cấp trên có nhắc nhở.', NULL, '2019-11-17 16:11:38', '2019-11-17 16:11:38'),
(19, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Có từ 50% đến dưới 80% đoàn viên trong Chi đoàn đăng ký và thực hiện Chương trình rèn luyện đoàn viên.', NULL, '2019-11-17 16:12:36', '2019-11-17 16:12:36'),
(20, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Không kết nạp được đoàn viên mới (nếu đơn vị còn nguồn để bồi dưỡng kết nạp); không giới thiệu được đoàn viên ưu tú cho Đảng xem xét kết nạp .', NULL, '2019-11-17 16:12:36', '2019-11-17 16:12:36'),
(21, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Từ 50% đến dưới 60% đoàn viên trong chi đoàn xếp loại khá trở lên, tỉ lệ đoàn viên yếu không quá 20%. ', NULL, '2019-11-17 16:13:43', '2019-11-17 16:13:43'),
(22, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Không duy trì tốt sinh hoạt lệ Chi đoàn (bỏ họp lệ 1 lần trong một học kỳ).', NULL, '2019-11-17 16:13:43', '2019-11-17 16:13:43'),
(23, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Không tổ chức được các hoạt động của chi đoàn, không phát huy được vai trò trong việc thực hiện nhiệm vụ chính trị và đáp ứng nhu cầu nguyện của đoàn viên, thanh niên.', NULL, '2019-11-17 16:14:38', '2019-11-17 16:14:38'),
(24, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Có đoàn viên bị kỷ luật từ mức độ cảnh cáo trở lên (nhưng không quá 3% tổng số đoàn viên).', NULL, '2019-11-17 16:14:38', '2019-11-17 16:14:38'),
(25, NULL, 5, 3, 'Tiêu chuẩn chi đoàn trung bình', '- Tập thể mất đoàn kết, để xảy ra những vấn đề gây ảnh hưởng không tốt đến uy tín của tổ chức Đoàn. ', NULL, '2019-11-17 16:16:55', '2019-11-17 16:16:55'),
(26, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Không có Sổ chi đoàn hoặc có Sổ chi đoàn, nhưng không ghi chép đầy đủ các nội dung theo yêu cầu.', NULL, '2019-11-17 16:16:55', '2019-11-17 16:16:55'),
(27, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Không thu, nộp đoàn phí hoặc có thu, nộp đoàn phí nhưng không đúng quy định.', NULL, '2019-11-17 16:17:51', '2019-11-17 16:17:51'),
(28, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Trên 50% đoàn viên trong Chi đoàn không đăng ký và thực hiện Chương trình rèn luyện đoàn viên.', NULL, '2019-11-17 16:17:51', '2019-11-17 16:17:51'),
(29, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Không kết nạp được đoàn viên mới (nếu đơn vị còn nguồn để bồi dưỡng kết nạp); không giới thiệu được đoàn viên ưu tú cho Đảng xem xét kết nạp .', NULL, '2019-11-17 16:19:32', '2019-11-17 16:19:32'),
(30, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Trên 20% đoàn viên trong chi đoàn xếp loại yếu', NULL, '2019-11-17 16:19:32', '2019-11-17 16:19:32'),
(31, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Không duy trì tốt sinh hoạt lệ Chi đoàn (bỏ họp lệ từ 2 lần trở lên trong một học kỳ).', NULL, '2019-11-17 16:20:17', '2019-11-17 16:20:17'),
(32, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Không tổ chức được các hoạt động của chi đoàn, không phát huy được vai trò trong việc thực hiện nhiệm vụ chính trị và đáp ứng nhu cầu nguyện của đoàn viên, thanh niên.', NULL, '2019-11-17 16:20:17', '2019-11-17 16:20:17'),
(33, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Có hơn 5% tổng số đoàn viên bị kỷ luật từ mức cảnh cáo trở lên.', NULL, '2019-11-17 16:21:02', '2019-11-17 16:21:02'),
(34, NULL, 5, 3, 'Tiêu chuẩn chi đoàn yếu kém', '- Tập thể mất đoàn kết, để xảy ra những vấn đề gây ảnh hưởng đặc biệt xấu đến uy tín của tổ chức Đoàn.', NULL, '2019-11-17 16:21:02', '2019-11-17 16:21:02'),
(35, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở  xuất sắc', '- Chủ động công tác; chủ động xây dựng kế hoạch, chương trình công tác và thực hiện tốt các chủ trương của cấp uỷ Đảng và Đoàn cấp trên; chủ động phát triển Đoàn viên mới và giới thiệu Đoàn viên ưu tú cho Đảng, phát triển các hình thức tập hợp thanh niên; chủ động củng cố, xây dựng, phát triển tổ chức cơ sở Đoàn và tham mưu đề xuất với cấp uỷ Đảng, phối hợp với các đơn vị có liên quan trong công tác thanh niên.', NULL, '2019-11-17 16:22:28', '2019-11-17 16:22:28'),
(36, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở  xuất sắc', '- Có tối thiểu 2/3 số Chi đoàn được xếp loại tốt trở lên, không có Chi đoàn trung bình.', NULL, '2019-11-17 16:22:28', '2019-11-17 16:22:28'),
(37, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở  xuất sắc', '- Có đội ngũ Ban chấp hành đoàn kết, nhiệt tình, gương mẫu và có năng lực công tác.', NULL, '2019-11-17 16:23:22', '2019-11-17 16:23:22'),
(38, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở  xuất sắc', '- Được cấp uỷ, Thủ trưởng đơn vị đánh giá vững mạnh.', NULL, '2019-11-17 16:23:22', '2019-11-17 16:23:22'),
(39, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở khá', '- Là cơ sở Đoàn cơ bản đạt các tiêu chuẩn nêu trên. Có từ 1/2 số Chi đoàn xếp loại khá trở lên.', NULL, '2019-11-17 16:24:50', '2019-11-17 16:24:50'),
(40, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở trung bình', '- Ban chấp hành đoàn thiếu chủ động công tác, có dưới 1/2 số Chi đoàn xếp loại khá trở lên.', NULL, '2019-11-17 16:24:50', '2019-11-17 16:24:50'),
(41, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở trung bình', '- Ban chấp hành đoàn thiếu chủ động công tác, có dưới 1/2 số Chi đoàn xếp loại khá trở lên.', NULL, '2019-11-17 16:26:01', '2019-11-17 16:26:01'),
(42, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở trung bình', '- Vai trò của Tổ chức đoàn tại đơn vị chưa rõ.', NULL, '2019-11-17 16:26:01', '2019-11-17 16:26:01'),
(43, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở yếu kém', '- Có bộ máy Ban chấp hành đoàn song không duy trì được sinh hoạt và hoạt động.', NULL, '2019-11-17 16:27:02', '2019-11-17 16:27:02'),
(44, NULL, 5, 4, 'Tiêu chuẩn đoàn cơ sở yếu kém', '- Có nhiều Chi đoàn trung bình và yếu kém, chưa phát huy vai trò của Đoàn thanh niên trong việc thực hiện nhiệm vụ chính trị của đơn vị và trong công tác đoàn kết tập hợp thanh niên.', NULL, '2019-11-17 16:27:02', '2019-11-17 16:27:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieubau_uutu`
--

CREATE TABLE `phieubau_uutu` (
  `ID` int(11) NOT NULL,
  `CHIDOAN_ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `SOPHIEU_TONG` int(11) DEFAULT NULL,
  `NGAY_BAU` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieuchi_chi_cd`
--

CREATE TABLE `phieuchi_chi_cd` (
  `ID` int(11) NOT NULL,
  `CHIDOAN_ID` int(11) NOT NULL,
  `LOAI_NOIDUNG_CHI_ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID_NHAN` int(11) DEFAULT NULL,
  `DOANVIEN_THANHNIEN_ID_TAO` int(11) DEFAULT NULL,
  `PT_CHIDOAN_ID` int(11) DEFAULT NULL,
  `NOIDUNG_PC_CD` varchar(1000) DEFAULT NULL,
  `SOTIEN_CHI_CD` float DEFAULT NULL,
  `NGAY_CHI_CD` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DUYET_PCCD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieuchi_dk`
--

CREATE TABLE `phieuchi_dk` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID_NHAN` int(11) DEFAULT NULL,
  `DOANVIEN_THANHNIEN_ID_TAO` int(11) DEFAULT NULL,
  `LOAI_NOIDUNG_CHI_ID` int(11) NOT NULL,
  `DOANKHOA_ID` int(11) NOT NULL,
  `PT_DOANKHOA_ID` int(11) DEFAULT NULL,
  `NOIDUNG_PC_DK` varchar(1000) DEFAULT NULL,
  `SOTIEN_CHI_DK` float DEFAULT NULL,
  `NGAY_CHI_DK` date DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DUYET_PCDK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudanhgia_chidoan`
--

CREATE TABLE `phieudanhgia_chidoan` (
  `ID` int(11) NOT NULL,
  `CHIDOAN_ID` int(11) NOT NULL,
  `NAMHOC_ID` int(11) NOT NULL,
  `XEPLOAI_CD_ID` int(11) NOT NULL,
  `MAUPHIEU_ID` int(11) NOT NULL,
  `CB_XEPLOAI_CD_ID` int(11) DEFAULT NULL,
  `TEN_PDGCD` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `TRANGTHAI_DUYET` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phieudanhgia_chidoan`
--

INSERT INTO `phieudanhgia_chidoan` (`ID`, `CHIDOAN_ID`, `NAMHOC_ID`, `XEPLOAI_CD_ID`, `MAUPHIEU_ID`, `CB_XEPLOAI_CD_ID`, `TEN_PDGCD`, `TAOMOI`, `CAPNHAT`, `TRANGTHAI_DUYET`) VALUES
(1, 1, 1, 2, 1, NULL, 'Phiếu đánh giá chi đoàn httta1 nam 2015-2016', '2019-11-19 03:12:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudanhgia_doankhoa`
--

CREATE TABLE `phieudanhgia_doankhoa` (
  `ID` int(11) NOT NULL,
  `DOANKHOA_ID` int(11) NOT NULL,
  `XEPLOAI_DK_ID` int(11) NOT NULL,
  `MAUPHIEU_ID` int(11) NOT NULL,
  `NAMHOC_ID` int(11) NOT NULL,
  `CB_XEPLOAI_DK_ID` int(11) DEFAULT NULL,
  `TEN_PDGDK` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `TRANGTHAI_DUYET` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudanhgia_doanvien`
--

CREATE TABLE `phieudanhgia_doanvien` (
  `ID` int(11) NOT NULL,
  `MAUPHIEU_ID` int(11) DEFAULT NULL,
  `NAMHOC_ID` int(11) DEFAULT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `XEPLOAI_DV_ID` int(11) DEFAULT NULL,
  `CD_XEPLOAI_DV_ID` int(11) DEFAULT NULL,
  `TEN_PDGDV` varchar(50) DEFAULT NULL,
  `DIEMRENLUYEN_HK1` int(11) DEFAULT NULL,
  `DIEMRENLUYEN_HK2` int(11) DEFAULT NULL,
  `DIEMTRUNGBINH_HK1` float DEFAULT NULL,
  `DIEMTRUNGBINH_HK2` float DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `NGUOI_DUYET_PDGDV_ID` int(11) DEFAULT NULL,
  `TRANGTHAI_DUYET` int(11) DEFAULT NULL COMMENT 'Null: Chưa duyệt , 1: Đã duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phieudanhgia_doanvien`
--

INSERT INTO `phieudanhgia_doanvien` (`ID`, `MAUPHIEU_ID`, `NAMHOC_ID`, `DOANVIEN_THANHNIEN_ID`, `XEPLOAI_DV_ID`, `CD_XEPLOAI_DV_ID`, `TEN_PDGDV`, `DIEMRENLUYEN_HK1`, `DIEMRENLUYEN_HK2`, `DIEMTRUNGBINH_HK1`, `DIEMTRUNGBINH_HK2`, `TAOMOI`, `CAPNHAT`, `NGUOI_DUYET_PDGDV_ID`, `TRANGTHAI_DUYET`) VALUES
(3, 1, 1, 2, 1, 1, 'Phiếu đánh giá đoàn viên', 90, 98, 3.5, 4, '2019-11-13 03:58:31', '2019-11-17 02:32:25', 4, NULL),
(4, 1, 2, 2, 1, 2, 'Phiếu đánh giá đoàn viên', 90, 98, 3.5, 4, '2019-11-13 04:00:28', '2019-11-17 04:12:13', 4, 1),
(5, 1, 3, 2, 2, 1, 'Phiếu đánh giá đoàn viên', 90, 98, 3.5, 4, '2019-11-13 07:02:12', '2019-11-17 04:03:19', 4, 1),
(8, 1, 4, 2, 4, NULL, 'Phiếu đánh giá đoàn viên', 80, 70, 2.3, 2, '2019-11-17 05:38:39', NULL, NULL, NULL),
(11, 1, 2, 1, 1, NULL, 'Phiếu đánh giá đoàn viên', 90, 98, 3.5, 4, '2019-11-19 00:19:55', NULL, NULL, NULL),
(12, 1, 1, 1, 1, NULL, 'Phiếu đánh giá đoàn viên', 90, 98, 3.5, 4, '2019-11-19 00:21:38', NULL, NULL, NULL),
(15, 1, 3, 1, 1, NULL, 'Phiếu đánh giá đoàn viên', 90, 98, 3.5, 4, '2019-11-19 01:28:04', NULL, NULL, NULL),
(16, 1, 4, 1, 1, NULL, 'Phiếu đánh giá đoàn viên', 90, 98, 3.5, 4, '2019-11-19 01:53:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_xa`
--

CREATE TABLE `phuong_xa` (
  `ID` int(11) NOT NULL,
  `QUAN_HUYEN_ID` int(11) NOT NULL,
  `TEN_PX` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phuong_xa`
--

INSERT INTO `phuong_xa` (`ID`, `QUAN_HUYEN_ID`, `TEN_PX`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 'Hưng Thạnh', '2019-10-23 21:12:51', NULL),
(2, 2, 'Hưng Thạnh', '2019-10-23 21:13:17', NULL),
(3, 3, 'Phường Xuân Khánh', '2019-11-15 12:59:08', '2019-11-15 12:59:08'),
(4, 3, 'Phường An Cư', '2019-11-15 12:59:08', '2019-11-15 12:59:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pt_chidoan`
--

CREATE TABLE `pt_chidoan` (
  `ID` int(11) NOT NULL,
  `HOCKY_ID` int(11) NOT NULL,
  `LOAI_PT_ID` int(11) NOT NULL,
  `CHIDOAN_ID` int(11) NOT NULL,
  `TEN_PT_CD` varchar(50) DEFAULT NULL,
  `NGAY_BD_PT_CD` date DEFAULT NULL,
  `NGAY_KT_PT_CD` date DEFAULT NULL,
  `GHICHU_PT_CD` varchar(200) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pt_doankhoa`
--

CREATE TABLE `pt_doankhoa` (
  `ID` int(11) NOT NULL,
  `LOAI_PT_ID` int(11) NOT NULL,
  `DOANKHOA_ID` int(11) NOT NULL,
  `HOCKY_ID` int(11) NOT NULL,
  `TEN_PT_DK` varchar(50) DEFAULT NULL,
  `NGAY_BD_PT_DK` date DEFAULT NULL,
  `NGAY_KT_PT_DK` date DEFAULT NULL,
  `GHICHU_PT_DK` varchar(200) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qd_dv_ketnap`
--

CREATE TABLE `qd_dv_ketnap` (
  `ID` int(11) NOT NULL,
  `DV_KETNAP_ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `DUYET_KN` varchar(50) DEFAULT NULL COMMENT 'Null: Chưa duyệt, 1: Đã duyệt',
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `qd_dv_ketnap`
--

INSERT INTO `qd_dv_ketnap` (`ID`, `DV_KETNAP_ID`, `DOANVIEN_THANHNIEN_ID`, `DUYET_KN`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 1, NULL, '2019-11-04 21:52:29', '2019-11-10 07:28:57'),
(2, 1, 4, NULL, '2019-11-04 22:10:32', NULL),
(3, 1, 2, NULL, '2019-11-04 22:10:40', NULL),
(4, 1, 5, NULL, '2019-11-04 22:10:48', NULL),
(5, 1, 6, NULL, '2019-11-04 22:10:55', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qd_dv_ttdoan`
--

CREATE TABLE `qd_dv_ttdoan` (
  `ID` int(11) NOT NULL,
  `DV_TT_DOAN_ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `DUYET_TTD` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `qd_dv_ttdoan`
--

INSERT INTO `qd_dv_ttdoan` (`ID`, `DV_TT_DOAN_ID`, `DOANVIEN_THANHNIEN_ID`, `DUYET_TTD`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 1, '1', '2019-11-07 08:56:44', '2019-11-07 08:58:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quan_huyen`
--

CREATE TABLE `quan_huyen` (
  `ID` int(11) NOT NULL,
  `TINH_THANHPHO_ID` int(11) NOT NULL,
  `TEN_QH` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quan_huyen`
--

INSERT INTO `quan_huyen` (`ID`, `TINH_THANHPHO_ID`, `TEN_QH`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 'Long Hồ', '2019-10-23 20:54:47', NULL),
(2, 2, 'Long Hồ', '2019-10-23 20:54:59', NULL),
(3, 2, 'Quận Ninh Kiều', '2019-11-15 07:41:30', '2019-11-15 07:41:30'),
(4, 2, 'Quận Bình Thủy', '2019-11-15 07:41:30', '2019-11-15 07:41:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thangnam`
--

CREATE TABLE `thangnam` (
  `ID` int(11) NOT NULL,
  `NAMHOC_ID` int(11) NOT NULL,
  `THANGNAM` varchar(30) DEFAULT NULL,
  `SOTIEN_DOANPHI` float DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thangnam`
--

INSERT INTO `thangnam` (`ID`, `NAMHOC_ID`, `THANGNAM`, `SOTIEN_DOANPHI`, `TAOMOI`, `CAPNHAT`) VALUES
(25, 1, 'tháng 1', 30000, '2019-10-23 22:01:43', '2019-10-23 22:01:43'),
(26, 1, 'tháng 2', 30000, '2019-10-23 22:01:43', '2019-10-23 22:01:43'),
(27, 1, 'tháng 3', 30000, '2019-10-23 22:01:43', '2019-10-23 22:01:43'),
(28, 1, 'tháng 4', 30000, '2019-10-23 22:01:43', '2019-10-23 22:01:43'),
(29, 1, 'tháng 5', 30000, '2019-10-23 22:01:43', '2019-10-23 22:01:43'),
(30, 1, 'tháng 6', 30000, '2019-10-23 22:01:44', '2019-10-23 22:01:44'),
(31, 1, 'tháng 7', 30000, '2019-10-23 22:01:44', '2019-10-23 22:01:44'),
(32, 1, 'tháng 8', 30000, '2019-10-23 22:01:44', '2019-10-23 22:01:44'),
(33, 1, 'tháng 9', 30000, '2019-10-23 22:01:44', '2019-10-23 22:01:44'),
(34, 1, 'tháng 10', 30000, '2019-10-23 22:01:44', '2019-10-23 22:01:44'),
(35, 1, 'tháng 11', 30000, '2019-10-23 22:01:44', '2019-10-23 22:01:44'),
(36, 1, 'tháng 12', 30000, '2019-10-23 22:01:44', '2019-10-23 22:01:44'),
(37, 2, 'tháng 1', 40000, '2019-10-24 21:57:16', '2019-10-24 21:57:16'),
(38, 2, 'tháng 2', 40000, '2019-10-24 21:57:16', '2019-10-24 21:57:16'),
(39, 2, 'tháng 3', 40000, '2019-10-24 21:57:16', '2019-10-24 21:57:16'),
(40, 2, 'tháng 4', 40000, '2019-10-24 21:57:16', '2019-10-24 21:57:16'),
(41, 2, 'tháng 5', 40000, '2019-10-24 21:57:16', '2019-10-24 21:57:16'),
(42, 2, 'tháng 6', 40000, '2019-10-24 21:57:16', '2019-10-24 21:57:16'),
(43, 2, 'tháng 7', 40000, '2019-10-24 21:57:16', '2019-10-24 21:57:16'),
(44, 2, 'tháng 8', 40000, '2019-10-24 21:57:17', '2019-10-24 21:57:17'),
(45, 2, 'tháng 9', 40000, '2019-10-24 21:57:17', '2019-10-24 21:57:17'),
(46, 2, 'tháng 10', 40000, '2019-10-24 21:57:17', '2019-10-24 21:57:17'),
(47, 2, 'tháng 11', 40000, '2019-10-24 21:57:17', '2019-10-24 21:57:17'),
(48, 2, 'tháng 12', 40000, '2019-10-24 21:57:17', '2019-10-24 21:57:17'),
(49, 3, 'tháng 1', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(50, 3, 'tháng 2', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(51, 3, 'tháng 3', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(52, 3, 'tháng 4', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(53, 3, 'tháng 5', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(54, 3, 'tháng 6', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(55, 3, 'tháng 7', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(56, 3, 'tháng 8', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(57, 3, 'tháng 9', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(58, 3, 'tháng 10', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(59, 3, 'tháng 11', 40000, '2019-10-31 20:08:11', '2019-10-31 20:08:11'),
(60, 3, 'tháng 12', 40000, '2019-10-31 20:08:12', '2019-10-31 20:08:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtich`
--

CREATE TABLE `thanhtich` (
  `ID` int(11) NOT NULL,
  `TEN_TT` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtich_thamgia`
--

CREATE TABLE `thanhtich_thamgia` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `PT_DOANKHOA_ID` int(11) NOT NULL,
  `THANHTICH_ID` int(11) NOT NULL,
  `DIENGIAI` varchar(200) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh_thanhpho`
--

CREATE TABLE `tinh_thanhpho` (
  `ID` int(11) NOT NULL,
  `TEN_TP` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tinh_thanhpho`
--

INSERT INTO `tinh_thanhpho` (`ID`, `TEN_TP`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Vĩnh Long', '2019-10-23 20:54:14', NULL),
(2, 'Cần Thơ', '2019-10-23 20:54:28', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tongiao`
--

CREATE TABLE `tongiao` (
  `ID` int(11) NOT NULL,
  `TEN_TG` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tongiao`
--

INSERT INTO `tongiao` (`ID`, `TEN_TG`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Phật', '2019-10-30 03:50:48', '2019-10-30 03:50:48'),
(2, 'Thiên chúa', '2019-10-30 03:50:48', '2019-10-30 03:50:48'),
(3, 'Hồi giáo', '2019-10-30 03:51:16', '2019-10-30 03:51:16'),
(4, 'Hòa hảo', '2019-10-30 03:51:16', '2019-10-30 03:51:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `DOANVIEN_THANHNIEN_ID` int(11) NOT NULL,
  `VAITRO_ID` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `REMEMBER_TOKEN` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `DOANVIEN_THANHNIEN_ID`, `VAITRO_ID`, `email`, `password`, `REMEMBER_TOKEN`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 1, 1, 'admin@gmail.com', '$2y$10$S2eaLnycrj0g9VYiuEhB5esq/Zy6rODE2yyccdfyFk6aA6QyF2YhW', NULL, '2019-11-09 08:16:16', '2019-11-09 08:16:16'),
(2, 2, 2, 'admindk_cntt@gmail.com', '$2y$10$ldY6Y3hcwDnQAKWBMGpy7u3ifOpX.ap.snxbEzlcSIwADMaDkta2W', NULL, '2019-11-08 17:00:00', '2019-11-09 10:26:49'),
(3, 4, 3, 'admincd_httta1@gmail.com', '$2y$10$ldY6Y3hcwDnQAKWBMGpy7u3ifOpX.ap.snxbEzlcSIwADMaDkta2W', NULL, '2019-11-18 17:00:00', '2019-11-11 14:37:37'),
(4, 5, 4, 'lemanthaonghi@gmail.com', '$2y$10$ldY6Y3hcwDnQAKWBMGpy7u3ifOpX.ap.snxbEzlcSIwADMaDkta2W', NULL, '2019-11-11 02:00:00', '2019-11-11 14:38:58'),
(5, 1, 4, 'nguyenle@gmail.com', '$2y$10$ldY6Y3hcwDnQAKWBMGpy7u3ifOpX.ap.snxbEzlcSIwADMaDkta2W', NULL, '2019-11-12 23:00:00', '2019-11-13 10:55:42'),
(6, 2, 4, 'thaonguyen@gmail.com', '$2y$10$ldY6Y3hcwDnQAKWBMGpy7u3ifOpX.ap.snxbEzlcSIwADMaDkta2W', NULL, '2019-11-13 01:00:00', '2019-11-13 10:57:00'),
(8, 5, 3, 'admincd_httta2@gmail.com', '$2y$10$ldY6Y3hcwDnQAKWBMGpy7u3ifOpX.ap.snxbEzlcSIwADMaDkta2W', NULL, '2019-11-24 17:00:00', '2019-11-16 14:12:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaitro`
--

CREATE TABLE `vaitro` (
  `ID` int(11) NOT NULL,
  `TEN_VT` varchar(50) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`ID`, `TEN_VT`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Admin doan truong', '2019-11-09 08:16:16', '2019-11-09 08:16:16'),
(2, 'Admin doan khoa', '2019-11-09 08:16:16', '2019-11-09 08:16:16'),
(3, 'Admin chi doan', '2019-11-09 08:16:20', '2019-11-09 08:16:20'),
(4, 'Doan vien', '2019-11-09 08:16:20', '2019-11-09 08:16:20');

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_ns`
-- (See below for the actual view)
--
CREATE TABLE `v_ns` (
`ID` int(11)
,`TEN_SV` varchar(50)
,`ns_phuong` varchar(50)
,`ns_quan` varchar(50)
,`ns_tp` varchar(50)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_phuongxa`
-- (See below for the actual view)
--
CREATE TABLE `v_phuongxa` (
`ID` int(11)
,`QUAN_HUYEN_ID` int(11)
,`TEN_PX` varchar(50)
,`TAOMOI` timestamp
,`CAPNHAT` timestamp
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_qq`
-- (See below for the actual view)
--
CREATE TABLE `v_qq` (
`ID` int(11)
,`TEN_SV` varchar(50)
,`qq_phuong` varchar(50)
,`qq_quan` varchar(50)
,`qq_tp` varchar(50)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_qq_ns`
-- (See below for the actual view)
--
CREATE TABLE `v_qq_ns` (
`ID` int(11)
,`TEN_SV` varchar(50)
,`qq_phuong` varchar(50)
,`qq_quan` varchar(50)
,`qq_tp` varchar(50)
,`ns_phuong` varchar(50)
,`ns_quan` varchar(50)
,`ns_tp` varchar(50)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_quanhuyen`
-- (See below for the actual view)
--
CREATE TABLE `v_quanhuyen` (
`ID` int(11)
,`TEN_QH` varchar(50)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_soluong_cd`
-- (See below for the actual view)
--
CREATE TABLE `v_soluong_cd` (
`ID` int(11)
,`TEN_DK` varchar(50)
,`soluong_cd` bigint(21)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_soluong_dv`
-- (See below for the actual view)
--
CREATE TABLE `v_soluong_dv` (
`ID` int(11)
,`soluong_dv` bigint(21)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_sotien_cd_dong_1_nam`
-- (See below for the actual view)
--
CREATE TABLE `v_sotien_cd_dong_1_nam` (
`ID` int(11)
,`NAMHOC_ID` int(11)
,`TEN_CD` varchar(50)
,`TEN_NH` varchar(50)
,`sotien_cd_phai_dong` double
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_sotien_cd_dong_1_thang`
-- (See below for the actual view)
--
CREATE TABLE `v_sotien_cd_dong_1_thang` (
`ID` int(11)
,`NAMHOC_ID` int(11)
,`TEN_NH` varchar(50)
,`TEN_CD` varchar(50)
,`sotien_cd_dong_1_thang` double
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xeploai_cd`
--

CREATE TABLE `xeploai_cd` (
  `ID` int(11) NOT NULL,
  `TEN_XLCD` varchar(50) DEFAULT NULL,
  `DIEMDAT_CD` int(11) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `xeploai_cd`
--

INSERT INTO `xeploai_cd` (`ID`, `TEN_XLCD`, `DIEMDAT_CD`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Chi đoàn vững mạnh', NULL, '2019-11-17 13:36:44', '2019-11-17 13:36:44'),
(2, 'Chi đoàn khá', NULL, '2019-11-17 13:36:44', '2019-11-17 13:36:44'),
(3, 'Chi đoàn trung bình', NULL, '2019-11-17 13:37:15', '2019-11-17 13:37:15'),
(4, 'Chi đoàn yếu - kém', NULL, '2019-11-17 13:37:15', '2019-11-17 13:37:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xeploai_dk`
--

CREATE TABLE `xeploai_dk` (
  `ID` int(11) NOT NULL,
  `TEN_XLDK` varchar(50) DEFAULT NULL,
  `DIEMDAT_DK` int(11) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `xeploai_dk`
--

INSERT INTO `xeploai_dk` (`ID`, `TEN_XLDK`, `DIEMDAT_DK`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Đoàn cơ sở  xuất sắc', NULL, '2019-11-17 13:38:05', '2019-11-17 13:38:05'),
(2, 'Đoàn cơ sở khá', NULL, '2019-11-17 13:38:05', '2019-11-17 13:38:05'),
(3, 'Đoàn cơ sở trung bình', NULL, '2019-11-17 13:38:33', '2019-11-17 13:38:33'),
(4, 'Đoàn cơ sở yếu kém', NULL, '2019-11-17 13:38:33', '2019-11-18 04:54:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xeploai_dv`
--

CREATE TABLE `xeploai_dv` (
  `ID` int(11) NOT NULL,
  `TEN_XLDV` varchar(50) DEFAULT NULL,
  `DIEMDAT_DV` varchar(100) DEFAULT NULL,
  `TAOMOI` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CAPNHAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `xeploai_dv`
--

INSERT INTO `xeploai_dv` (`ID`, `TEN_XLDV`, `DIEMDAT_DV`, `TAOMOI`, `CAPNHAT`) VALUES
(1, 'Xuất sắc', '90-100', '2019-11-06 07:03:44', NULL),
(2, 'Giỏi', '80-89', '2019-11-06 07:04:06', NULL),
(3, 'Khá', '70-79', '2019-11-06 07:04:24', NULL),
(4, 'Trung bình', '0-40', '2019-11-17 08:30:14', '2019-11-17 08:30:14');

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_ns`
--
DROP TABLE IF EXISTS `v_ns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ns`  AS  select `doanvien_thanhnien`.`ID` AS `ID`,`doanvien_thanhnien`.`TEN_SV` AS `TEN_SV`,`phuong_xa`.`TEN_PX` AS `ns_phuong`,`quan_huyen`.`TEN_QH` AS `ns_quan`,`tinh_thanhpho`.`TEN_TP` AS `ns_tp` from (((`doanvien_thanhnien` join `phuong_xa`) join `tinh_thanhpho`) join `quan_huyen`) where ((`doanvien_thanhnien`.`PHUONG_XA_ID_NS` = `phuong_xa`.`ID`) and (`quan_huyen`.`ID` = `phuong_xa`.`QUAN_HUYEN_ID`) and (`quan_huyen`.`TINH_THANHPHO_ID` = `tinh_thanhpho`.`ID`)) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_phuongxa`
--
DROP TABLE IF EXISTS `v_phuongxa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_phuongxa`  AS  select `phuong_xa`.`ID` AS `ID`,`phuong_xa`.`QUAN_HUYEN_ID` AS `QUAN_HUYEN_ID`,`phuong_xa`.`TEN_PX` AS `TEN_PX`,`phuong_xa`.`TAOMOI` AS `TAOMOI`,`phuong_xa`.`CAPNHAT` AS `CAPNHAT` from `phuong_xa` ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_qq`
--
DROP TABLE IF EXISTS `v_qq`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_qq`  AS  select `doanvien_thanhnien`.`ID` AS `ID`,`doanvien_thanhnien`.`TEN_SV` AS `TEN_SV`,`phuong_xa`.`TEN_PX` AS `qq_phuong`,`quan_huyen`.`TEN_QH` AS `qq_quan`,`tinh_thanhpho`.`TEN_TP` AS `qq_tp` from (((`doanvien_thanhnien` join `phuong_xa`) join `tinh_thanhpho`) join `quan_huyen`) where ((`doanvien_thanhnien`.`PHUONG_XA_ID_QQ` = `phuong_xa`.`ID`) and (`quan_huyen`.`ID` = `phuong_xa`.`QUAN_HUYEN_ID`) and (`quan_huyen`.`TINH_THANHPHO_ID` = `tinh_thanhpho`.`ID`)) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_qq_ns`
--
DROP TABLE IF EXISTS `v_qq_ns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_qq_ns`  AS  select `a`.`ID` AS `ID`,`a`.`TEN_SV` AS `TEN_SV`,`a`.`qq_phuong` AS `qq_phuong`,`a`.`qq_quan` AS `qq_quan`,`a`.`qq_tp` AS `qq_tp`,`b`.`ns_phuong` AS `ns_phuong`,`b`.`ns_quan` AS `ns_quan`,`b`.`ns_tp` AS `ns_tp` from (`v_qq` `a` join `v_ns` `b`) where (`a`.`ID` = `b`.`ID`) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_quanhuyen`
--
DROP TABLE IF EXISTS `v_quanhuyen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_quanhuyen`  AS  select `quan_huyen`.`ID` AS `ID`,`quan_huyen`.`TEN_QH` AS `TEN_QH` from `quan_huyen` ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_soluong_cd`
--
DROP TABLE IF EXISTS `v_soluong_cd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_soluong_cd`  AS  select `doankhoa`.`ID` AS `ID`,`doankhoa`.`TEN_DK` AS `TEN_DK`,count(`chidoan`.`ID`) AS `soluong_cd` from (`doankhoa` join `chidoan`) where (`doankhoa`.`ID` = `chidoan`.`DOANKHOA_ID`) group by `doankhoa`.`ID`,`doankhoa`.`TEN_DK` ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_soluong_dv`
--
DROP TABLE IF EXISTS `v_soluong_dv`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_soluong_dv`  AS  select `chidoan`.`ID` AS `ID`,count(`doanvien_thanhnien`.`ID`) AS `soluong_dv` from (`doanvien_thanhnien` join `chidoan`) where (`doanvien_thanhnien`.`CHIDOAN_ID` = `chidoan`.`ID`) group by `chidoan`.`ID` ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_sotien_cd_dong_1_nam`
--
DROP TABLE IF EXISTS `v_sotien_cd_dong_1_nam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sotien_cd_dong_1_nam`  AS  select `chidoan`.`ID` AS `ID`,`thangnam`.`NAMHOC_ID` AS `NAMHOC_ID`,`chidoan`.`TEN_CD` AS `TEN_CD`,`namhoc`.`TEN_NH` AS `TEN_NH`,(`v_sotien_cd_dong_1_thang`.`sotien_cd_dong_1_thang` * 12) AS `sotien_cd_phai_dong` from (((`v_sotien_cd_dong_1_thang` join `chidoan`) join `namhoc`) join `thangnam`) where ((`v_sotien_cd_dong_1_thang`.`NAMHOC_ID` = `namhoc`.`ID`) and (`v_sotien_cd_dong_1_thang`.`ID` = `chidoan`.`ID`) and (`namhoc`.`ID` = `thangnam`.`NAMHOC_ID`)) group by `chidoan`.`TEN_CD`,`namhoc`.`TEN_NH`,`chidoan`.`ID`,`thangnam`.`NAMHOC_ID` ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_sotien_cd_dong_1_thang`
--
DROP TABLE IF EXISTS `v_sotien_cd_dong_1_thang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sotien_cd_dong_1_thang`  AS  select `chidoan`.`ID` AS `ID`,`thangnam`.`NAMHOC_ID` AS `NAMHOC_ID`,`namhoc`.`TEN_NH` AS `TEN_NH`,`chidoan`.`TEN_CD` AS `TEN_CD`,(((`v_soluong_dv`.`soluong_dv` * `thangnam`.`SOTIEN_DOANPHI`) * 1) / 3) AS `sotien_cd_dong_1_thang` from ((((`v_soluong_dv` join `chidoan`) join `doankhoa`) join `thangnam`) join `namhoc`) where ((`v_soluong_dv`.`ID` = `chidoan`.`ID`) and (`doankhoa`.`ID` = `chidoan`.`DOANKHOA_ID`) and (`namhoc`.`ID` = `thangnam`.`NAMHOC_ID`)) group by `thangnam`.`SOTIEN_DOANPHI`,`thangnam`.`NAMHOC_ID`,`chidoan`.`ID`,`chidoan`.`TEN_CD`,`namhoc`.`TEN_NH` ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chidoan`
--
ALTER TABLE `chidoan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_THUOC_KHOA` (`KHOA_ID`),
  ADD KEY `FK_TRUC_THUOC_DK` (`DOANKHOA_ID`);

--
-- Chỉ mục cho bảng `chitiet_bau_ut`
--
ALTER TABLE `chitiet_bau_ut`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_CHITIET_BAU_UT` (`PHIEUDANHGIA_DOANVIEN_ID`),
  ADD KEY `FK_CUA_BAU_UT` (`PHIEUBAU_UUTU_ID`);

--
-- Chỉ mục cho bảng `chitiet_ktkl`
--
ALTER TABLE `chitiet_ktkl`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_CT_KT_KL` (`DOANVIEN_THANHNIEN_ID`),
  ADD KEY `FK_CUA_KT_KL` (`KHENTHUONG_KYLUAT_ID`);

--
-- Chỉ mục cho bảng `chitiet_mauphieu`
--
ALTER TABLE `chitiet_mauphieu`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MAUPHIEU_ID` (`MAUPHIEU_ID`,`THUTU_NOIDUNG`),
  ADD KEY `FK_CO_CHIETIET_MP` (`NOIDUNG_PDG_ID`);

--
-- Chỉ mục cho bảng `chitiet_pdg_cd`
--
ALTER TABLE `chitiet_pdg_cd`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_ND_PDG` (`NOIDUNG_PDG_ID`),
  ADD KEY `FK_CUA_PDG_CD` (`PHIEUDANHGIA_CHIDOAN_ID`);

--
-- Chỉ mục cho bảng `chitiet_pdg_dk`
--
ALTER TABLE `chitiet_pdg_dk`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_CHITIET_PDG_DK` (`PHIEUDANHGIA_DOANKHOA_ID`),
  ADD KEY `FK_CUA_NOIDUNG_PDG` (`NOIDUNG_PDG_ID`);

--
-- Chỉ mục cho bảng `chitiet_pdg_dv`
--
ALTER TABLE `chitiet_pdg_dv`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_PDG_DV` (`PHIEUDANHGIA_DOANVIEN_ID`),
  ADD KEY `FK_THUOC_ND_PDG` (`NOIDUNG_PDG_ID`);

--
-- Chỉ mục cho bảng `chucvu_dv`
--
ALTER TABLE `chucvu_dv`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `co_vaitro`
--
ALTER TABLE `co_vaitro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_VAITRO` (`DOANVIEN_THANHNIEN_ID`),
  ADD KEY `FK_CO_VAITRO2` (`VAITRO_ID`);

--
-- Chỉ mục cho bảng `ct_chucvu_dv`
--
ALTER TABLE `ct_chucvu_dv`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_CV_DV` (`CHUCVU_DV_ID`),
  ADD KEY `FK_CUA_DV` (`DOANVIEN_THANHNIEN_ID`);

--
-- Chỉ mục cho bảng `dantoc`
--
ALTER TABLE `dantoc`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `doankhoa`
--
ALTER TABLE `doankhoa`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `doanphi_thu_cd`
--
ALTER TABLE `doanphi_thu_cd`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_CD` (`CHIDOAN_ID`),
  ADD KEY `FK_TAI_THANGNAM` (`THANGNAM_ID`),
  ADD KEY `FK_CD_CO_NAMHOC_DP` (`namhoc_dp`);

--
-- Chỉ mục cho bảng `doanphi_thu_dk`
--
ALTER TABLE `doanphi_thu_dk`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_DK` (`DOANKHOA_ID`),
  ADD KEY `FK_VAO_THANGNAM` (`THANGNAM_ID`),
  ADD KEY `FK_CO_NAMHOC_DP` (`namhoc_dp`);

--
-- Chỉ mục cho bảng `doanphi_thu_dv`
--
ALTER TABLE `doanphi_thu_dv`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_THANGNAM` (`THANGNAM_ID`),
  ADD KEY `FK_DONG_DP` (`DOANVIEN_THANHNIEN_ID`),
  ADD KEY `FK_DV_CO_NAMHOC_DP` (`namhoc_dp`);

--
-- Chỉ mục cho bảng `doanvien_thanhnien`
--
ALTER TABLE `doanvien_thanhnien`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_NOISINH` (`PHUONG_XA_ID_NS`),
  ADD KEY `FK_CO_QUEQUAN` (`PHUONG_XA_ID_QQ`),
  ADD KEY `FK_CO_TONGIAO` (`TONGIAO_ID`),
  ADD KEY `FK_GOM_SV` (`CHIDOAN_ID`),
  ADD KEY `FK_LA_DANTOC` (`DANTOC_ID`);

--
-- Chỉ mục cho bảng `dv_ketnap`
--
ALTER TABLE `dv_ketnap`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_NGUOI_LAP_DV_KETNAP` (`DOANVIEN_THANHNIEN_ID`);

--
-- Chỉ mục cho bảng `dv_tt_doan`
--
ALTER TABLE `dv_tt_doan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_NGUOI_LAP_DV_TT_DOAN` (`DOANVIEN_THANHNIEN_ID`);

--
-- Chỉ mục cho bảng `hinhthuc_ktkl`
--
ALTER TABLE `hinhthuc_ktkl`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_HOCKY` (`NAMHOC_ID`);

--
-- Chỉ mục cho bảng `khenthuong_kyluat`
--
ALTER TABLE `khenthuong_kyluat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_HT_KTKL` (`HINHTHUC_KTKL_ID`),
  ADD KEY `FK_CO_LOAI_KTKL` (`LOAI_KTKL_ID`),
  ADD KEY `FK_NGUOI_LAP_DS_KHENTHUONG` (`DOANVIEN_THANHNIEN_ID`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `kieu_dulieu`
--
ALTER TABLE `kieu_dulieu`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `loai_ktkl`
--
ALTER TABLE `loai_ktkl`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `loai_noidung_chi`
--
ALTER TABLE `loai_noidung_chi`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `loai_noidung_pdg`
--
ALTER TABLE `loai_noidung_pdg`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `loai_pt`
--
ALTER TABLE `loai_pt`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `mauphieu`
--
ALTER TABLE `mauphieu`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `namhoc`
--
ALTER TABLE `namhoc`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `noidung_pdg`
--
ALTER TABLE `noidung_pdg`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_NOIDUNGCHA` (`NOIDUNG_PDG_ID_CHA`),
  ADD KEY `FK_CO_KIEU_DULIEU` (`KIEU_DULIEU_ID`),
  ADD KEY `FK_CO_LOAI_ND_PDG` (`LOAI_NOIDUNG_PDG_ID`);

--
-- Chỉ mục cho bảng `phieubau_uutu`
--
ALTER TABLE `phieubau_uutu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CT_BAU_CD` (`CHIDOAN_ID`),
  ADD KEY `FK_NGUOI_LAP_PHIEUBAU_UUTU` (`DOANVIEN_THANHNIEN_ID`);

--
-- Chỉ mục cho bảng `phieuchi_chi_cd`
--
ALTER TABLE `phieuchi_chi_cd`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CHI_PT_CD` (`PT_CHIDOAN_ID`),
  ADD KEY `FK_CO_DP_CD` (`CHIDOAN_ID`),
  ADD KEY `FK_CUA_DP_CHI_CD` (`LOAI_NOIDUNG_CHI_ID`),
  ADD KEY `FK_LAP_PC_CD` (`DOANVIEN_THANHNIEN_ID_TAO`),
  ADD KEY `FK_NHAN_PC_CD` (`DOANVIEN_THANHNIEN_ID_NHAN`);

--
-- Chỉ mục cho bảng `phieuchi_dk`
--
ALTER TABLE `phieuchi_dk`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CHI_PT_DK` (`PT_DOANKHOA_ID`),
  ADD KEY `FK_CO_DP_DK` (`DOANKHOA_ID`),
  ADD KEY `FK_LAP_PC_DK` (`DOANVIEN_THANHNIEN_ID_NHAN`),
  ADD KEY `FK_NHAN_PC_DK` (`DOANVIEN_THANHNIEN_ID_TAO`),
  ADD KEY `FK_THUOC_DP_CHI_DK` (`LOAI_NOIDUNG_CHI_ID`);

--
-- Chỉ mục cho bảng `phieudanhgia_chidoan`
--
ALTER TABLE `phieudanhgia_chidoan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_MAUPHIEU_CD` (`MAUPHIEU_ID`),
  ADD KEY `FK_CO_PDG_CD` (`CHIDOAN_ID`),
  ADD KEY `FK_CO_XLCD` (`XEPLOAI_CD_ID`),
  ADD KEY `FK_TAI_NAMHOC` (`NAMHOC_ID`),
  ADD KEY `FK_CB_XEPLOAI_CD` (`CB_XEPLOAI_CD_ID`);

--
-- Chỉ mục cho bảng `phieudanhgia_doankhoa`
--
ALTER TABLE `phieudanhgia_doankhoa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_MAUPHIEU_DK` (`MAUPHIEU_ID`),
  ADD KEY `FK_CO_PDG_DOANKHOA` (`DOANKHOA_ID`),
  ADD KEY `FK_O_NAMHOC` (`NAMHOC_ID`),
  ADD KEY `FK_CO_XLDK` (`XEPLOAI_DK_ID`),
  ADD KEY `FK_CB_XEPLOAI_DK` (`CB_XEPLOAI_DK_ID`);

--
-- Chỉ mục cho bảng `phieudanhgia_doanvien`
--
ALTER TABLE `phieudanhgia_doanvien`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_MAUPHIEU_DV` (`MAUPHIEU_ID`),
  ADD KEY `FK_CO_XL_DV` (`XEPLOAI_DV_ID`),
  ADD KEY `FK_CUA_NAMHOC` (`NAMHOC_ID`),
  ADD KEY `DOANVIEN_THANHNIEN_ID` (`DOANVIEN_THANHNIEN_ID`) USING BTREE,
  ADD KEY `FK_CD_XEPLOAI_DV_ID` (`CD_XEPLOAI_DV_ID`),
  ADD KEY `FK_NGUOI_DUYET_PDGDV_ID` (`NGUOI_DUYET_PDGDV_ID`);

--
-- Chỉ mục cho bảng `phuong_xa`
--
ALTER TABLE `phuong_xa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_QUAN_HUYEN` (`QUAN_HUYEN_ID`);

--
-- Chỉ mục cho bảng `pt_chidoan`
--
ALTER TABLE `pt_chidoan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_PT_CD` (`LOAI_PT_ID`),
  ADD KEY `FK_TAI_HOCKY` (`HOCKY_ID`),
  ADD KEY `FK_THUOC_CD` (`CHIDOAN_ID`);

--
-- Chỉ mục cho bảng `pt_doankhoa`
--
ALTER TABLE `pt_doankhoa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_PT_DK` (`DOANKHOA_ID`),
  ADD KEY `FK_CUA_PT_DK` (`LOAI_PT_ID`),
  ADD KEY `FK_THUOC_VAITRO` (`HOCKY_ID`);

--
-- Chỉ mục cho bảng `qd_dv_ketnap`
--
ALTER TABLE `qd_dv_ketnap`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_QD_DV_KN` (`DOANVIEN_THANHNIEN_ID`),
  ADD KEY `FK_CUA_DV_KN` (`DV_KETNAP_ID`);

--
-- Chỉ mục cho bảng `qd_dv_ttdoan`
--
ALTER TABLE `qd_dv_ttdoan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CO_QD_DV_TTD` (`DOANVIEN_THANHNIEN_ID`),
  ADD KEY `FK_CUA_DV_TTD` (`DV_TT_DOAN_ID`);

--
-- Chỉ mục cho bảng `quan_huyen`
--
ALTER TABLE `quan_huyen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_TAI_TINH_TP` (`TINH_THANHPHO_ID`);

--
-- Chỉ mục cho bảng `thangnam`
--
ALTER TABLE `thangnam`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_THUOC_NAMHOC` (`NAMHOC_ID`);

--
-- Chỉ mục cho bảng `thanhtich`
--
ALTER TABLE `thanhtich`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `thanhtich_thamgia`
--
ALTER TABLE `thanhtich_thamgia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CUA_THANHTICH` (`THANHTICH_ID`),
  ADD KEY `FK_THUOC_DK` (`PT_DOANKHOA_ID`),
  ADD KEY `FK_THUOC_DV` (`DOANVIEN_THANHNIEN_ID`);

--
-- Chỉ mục cho bảng `tinh_thanhpho`
--
ALTER TABLE `tinh_thanhpho`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tongiao`
--
ALTER TABLE `tongiao`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USER_LA_DV_TN` (`DOANVIEN_THANHNIEN_ID`),
  ADD KEY `FK_USER_CO_VAITRO` (`VAITRO_ID`);

--
-- Chỉ mục cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `xeploai_cd`
--
ALTER TABLE `xeploai_cd`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `xeploai_dk`
--
ALTER TABLE `xeploai_dk`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `xeploai_dv`
--
ALTER TABLE `xeploai_dv`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chidoan`
--
ALTER TABLE `chidoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `chitiet_bau_ut`
--
ALTER TABLE `chitiet_bau_ut`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chitiet_ktkl`
--
ALTER TABLE `chitiet_ktkl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `chitiet_mauphieu`
--
ALTER TABLE `chitiet_mauphieu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `chitiet_pdg_cd`
--
ALTER TABLE `chitiet_pdg_cd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chitiet_pdg_dk`
--
ALTER TABLE `chitiet_pdg_dk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chitiet_pdg_dv`
--
ALTER TABLE `chitiet_pdg_dv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `chucvu_dv`
--
ALTER TABLE `chucvu_dv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `co_vaitro`
--
ALTER TABLE `co_vaitro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ct_chucvu_dv`
--
ALTER TABLE `ct_chucvu_dv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `dantoc`
--
ALTER TABLE `dantoc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `doankhoa`
--
ALTER TABLE `doankhoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `doanphi_thu_cd`
--
ALTER TABLE `doanphi_thu_cd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT cho bảng `doanphi_thu_dk`
--
ALTER TABLE `doanphi_thu_dk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `doanphi_thu_dv`
--
ALTER TABLE `doanphi_thu_dv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT cho bảng `doanvien_thanhnien`
--
ALTER TABLE `doanvien_thanhnien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `dv_ketnap`
--
ALTER TABLE `dv_ketnap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `dv_tt_doan`
--
ALTER TABLE `dv_tt_doan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hinhthuc_ktkl`
--
ALTER TABLE `hinhthuc_ktkl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `hocky`
--
ALTER TABLE `hocky`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khenthuong_kyluat`
--
ALTER TABLE `khenthuong_kyluat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `khoa`
--
ALTER TABLE `khoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `kieu_dulieu`
--
ALTER TABLE `kieu_dulieu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `loai_ktkl`
--
ALTER TABLE `loai_ktkl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loai_noidung_chi`
--
ALTER TABLE `loai_noidung_chi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `loai_noidung_pdg`
--
ALTER TABLE `loai_noidung_pdg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `loai_pt`
--
ALTER TABLE `loai_pt`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `mauphieu`
--
ALTER TABLE `mauphieu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `namhoc`
--
ALTER TABLE `namhoc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `noidung_pdg`
--
ALTER TABLE `noidung_pdg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `phieubau_uutu`
--
ALTER TABLE `phieubau_uutu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phieuchi_chi_cd`
--
ALTER TABLE `phieuchi_chi_cd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phieuchi_dk`
--
ALTER TABLE `phieuchi_dk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phieudanhgia_chidoan`
--
ALTER TABLE `phieudanhgia_chidoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `phieudanhgia_doankhoa`
--
ALTER TABLE `phieudanhgia_doankhoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phieudanhgia_doanvien`
--
ALTER TABLE `phieudanhgia_doanvien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `phuong_xa`
--
ALTER TABLE `phuong_xa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `pt_chidoan`
--
ALTER TABLE `pt_chidoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pt_doankhoa`
--
ALTER TABLE `pt_doankhoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `qd_dv_ketnap`
--
ALTER TABLE `qd_dv_ketnap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `qd_dv_ttdoan`
--
ALTER TABLE `qd_dv_ttdoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `quan_huyen`
--
ALTER TABLE `quan_huyen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thangnam`
--
ALTER TABLE `thangnam`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `thanhtich`
--
ALTER TABLE `thanhtich`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thanhtich_thamgia`
--
ALTER TABLE `thanhtich_thamgia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tinh_thanhpho`
--
ALTER TABLE `tinh_thanhpho`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tongiao`
--
ALTER TABLE `tongiao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `xeploai_cd`
--
ALTER TABLE `xeploai_cd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `xeploai_dk`
--
ALTER TABLE `xeploai_dk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `xeploai_dv`
--
ALTER TABLE `xeploai_dv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chidoan`
--
ALTER TABLE `chidoan`
  ADD CONSTRAINT `FK_THUOC_KHOA` FOREIGN KEY (`KHOA_ID`) REFERENCES `khoa` (`ID`),
  ADD CONSTRAINT `FK_TRUC_THUOC_DK` FOREIGN KEY (`DOANKHOA_ID`) REFERENCES `doankhoa` (`ID`);

--
-- Các ràng buộc cho bảng `chitiet_bau_ut`
--
ALTER TABLE `chitiet_bau_ut`
  ADD CONSTRAINT `FK_CO_CHITIET_BAU_UT` FOREIGN KEY (`PHIEUDANHGIA_DOANVIEN_ID`) REFERENCES `phieudanhgia_doanvien` (`ID`),
  ADD CONSTRAINT `FK_CUA_BAU_UT` FOREIGN KEY (`PHIEUBAU_UUTU_ID`) REFERENCES `phieubau_uutu` (`ID`);

--
-- Các ràng buộc cho bảng `chitiet_ktkl`
--
ALTER TABLE `chitiet_ktkl`
  ADD CONSTRAINT `FK_CO_CT_KT_KL` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_CUA_KT_KL` FOREIGN KEY (`KHENTHUONG_KYLUAT_ID`) REFERENCES `khenthuong_kyluat` (`ID`);

--
-- Các ràng buộc cho bảng `chitiet_mauphieu`
--
ALTER TABLE `chitiet_mauphieu`
  ADD CONSTRAINT `FK_CO_CHIETIET_MP` FOREIGN KEY (`NOIDUNG_PDG_ID`) REFERENCES `noidung_pdg` (`ID`),
  ADD CONSTRAINT `FK_CUA_MP` FOREIGN KEY (`MAUPHIEU_ID`) REFERENCES `mauphieu` (`ID`);

--
-- Các ràng buộc cho bảng `chitiet_pdg_cd`
--
ALTER TABLE `chitiet_pdg_cd`
  ADD CONSTRAINT `FK_CUA_ND_PDG` FOREIGN KEY (`NOIDUNG_PDG_ID`) REFERENCES `noidung_pdg` (`ID`),
  ADD CONSTRAINT `FK_CUA_PDG_CD` FOREIGN KEY (`PHIEUDANHGIA_CHIDOAN_ID`) REFERENCES `phieudanhgia_chidoan` (`ID`);

--
-- Các ràng buộc cho bảng `chitiet_pdg_dk`
--
ALTER TABLE `chitiet_pdg_dk`
  ADD CONSTRAINT `FK_CO_CHITIET_PDG_DK` FOREIGN KEY (`PHIEUDANHGIA_DOANKHOA_ID`) REFERENCES `phieudanhgia_doankhoa` (`ID`),
  ADD CONSTRAINT `FK_CUA_NOIDUNG_PDG` FOREIGN KEY (`NOIDUNG_PDG_ID`) REFERENCES `noidung_pdg` (`ID`);

--
-- Các ràng buộc cho bảng `chitiet_pdg_dv`
--
ALTER TABLE `chitiet_pdg_dv`
  ADD CONSTRAINT `FK_CUA_PDG_DV` FOREIGN KEY (`PHIEUDANHGIA_DOANVIEN_ID`) REFERENCES `phieudanhgia_doanvien` (`ID`),
  ADD CONSTRAINT `FK_THUOC_ND_PDG` FOREIGN KEY (`NOIDUNG_PDG_ID`) REFERENCES `noidung_pdg` (`ID`);

--
-- Các ràng buộc cho bảng `co_vaitro`
--
ALTER TABLE `co_vaitro`
  ADD CONSTRAINT `FK_CO_VAITRO` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_CO_VAITRO2` FOREIGN KEY (`VAITRO_ID`) REFERENCES `vaitro` (`ID`);

--
-- Các ràng buộc cho bảng `ct_chucvu_dv`
--
ALTER TABLE `ct_chucvu_dv`
  ADD CONSTRAINT `FK_CUA_CV_DV` FOREIGN KEY (`CHUCVU_DV_ID`) REFERENCES `chucvu_dv` (`ID`),
  ADD CONSTRAINT `FK_CUA_DV` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `doanphi_thu_cd`
--
ALTER TABLE `doanphi_thu_cd`
  ADD CONSTRAINT `FK_CD_CO_NAMHOC_DP` FOREIGN KEY (`namhoc_dp`) REFERENCES `namhoc` (`ID`),
  ADD CONSTRAINT `FK_CUA_CD` FOREIGN KEY (`CHIDOAN_ID`) REFERENCES `chidoan` (`ID`),
  ADD CONSTRAINT `FK_TAI_THANGNAM` FOREIGN KEY (`THANGNAM_ID`) REFERENCES `thangnam` (`ID`);

--
-- Các ràng buộc cho bảng `doanphi_thu_dk`
--
ALTER TABLE `doanphi_thu_dk`
  ADD CONSTRAINT `FK_CO_NAMHOC_DP` FOREIGN KEY (`namhoc_dp`) REFERENCES `namhoc` (`ID`),
  ADD CONSTRAINT `FK_CUA_DK` FOREIGN KEY (`DOANKHOA_ID`) REFERENCES `doankhoa` (`ID`),
  ADD CONSTRAINT `FK_VAO_THANGNAM` FOREIGN KEY (`THANGNAM_ID`) REFERENCES `thangnam` (`ID`);

--
-- Các ràng buộc cho bảng `doanphi_thu_dv`
--
ALTER TABLE `doanphi_thu_dv`
  ADD CONSTRAINT `FK_CUA_THANGNAM` FOREIGN KEY (`THANGNAM_ID`) REFERENCES `thangnam` (`ID`),
  ADD CONSTRAINT `FK_DONG_DP` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_DV_CO_NAMHOC_DP` FOREIGN KEY (`namhoc_dp`) REFERENCES `namhoc` (`ID`);

--
-- Các ràng buộc cho bảng `doanvien_thanhnien`
--
ALTER TABLE `doanvien_thanhnien`
  ADD CONSTRAINT `FK_CO_NOISINH` FOREIGN KEY (`PHUONG_XA_ID_NS`) REFERENCES `phuong_xa` (`ID`),
  ADD CONSTRAINT `FK_CO_QUEQUAN` FOREIGN KEY (`PHUONG_XA_ID_QQ`) REFERENCES `phuong_xa` (`ID`),
  ADD CONSTRAINT `FK_CO_TONGIAO` FOREIGN KEY (`TONGIAO_ID`) REFERENCES `tongiao` (`ID`),
  ADD CONSTRAINT `FK_GOM_SV` FOREIGN KEY (`CHIDOAN_ID`) REFERENCES `chidoan` (`ID`),
  ADD CONSTRAINT `FK_LA_DANTOC` FOREIGN KEY (`DANTOC_ID`) REFERENCES `dantoc` (`ID`);

--
-- Các ràng buộc cho bảng `dv_ketnap`
--
ALTER TABLE `dv_ketnap`
  ADD CONSTRAINT `FK_NGUOI_LAP_DV_KETNAP` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `dv_tt_doan`
--
ALTER TABLE `dv_tt_doan`
  ADD CONSTRAINT `FK_NGUOI_LAP_DV_TT_DOAN` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `hocky`
--
ALTER TABLE `hocky`
  ADD CONSTRAINT `FK_CUA_HOCKY` FOREIGN KEY (`NAMHOC_ID`) REFERENCES `namhoc` (`ID`);

--
-- Các ràng buộc cho bảng `khenthuong_kyluat`
--
ALTER TABLE `khenthuong_kyluat`
  ADD CONSTRAINT `FK_CO_HT_KTKL` FOREIGN KEY (`HINHTHUC_KTKL_ID`) REFERENCES `hinhthuc_ktkl` (`ID`),
  ADD CONSTRAINT `FK_CO_LOAI_KTKL` FOREIGN KEY (`LOAI_KTKL_ID`) REFERENCES `loai_ktkl` (`ID`),
  ADD CONSTRAINT `FK_NGUOI_LAP_DS_KHENTHUONG` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `noidung_pdg`
--
ALTER TABLE `noidung_pdg`
  ADD CONSTRAINT `FK_CO_KIEU_DULIEU` FOREIGN KEY (`KIEU_DULIEU_ID`) REFERENCES `kieu_dulieu` (`ID`),
  ADD CONSTRAINT `FK_CO_LOAI_ND_PDG` FOREIGN KEY (`LOAI_NOIDUNG_PDG_ID`) REFERENCES `loai_noidung_pdg` (`ID`),
  ADD CONSTRAINT `FK_CO_NOIDUNGCHA` FOREIGN KEY (`NOIDUNG_PDG_ID_CHA`) REFERENCES `noidung_pdg` (`ID`);

--
-- Các ràng buộc cho bảng `phieubau_uutu`
--
ALTER TABLE `phieubau_uutu`
  ADD CONSTRAINT `FK_CT_BAU_CD` FOREIGN KEY (`CHIDOAN_ID`) REFERENCES `chidoan` (`ID`),
  ADD CONSTRAINT `FK_NGUOI_LAP_PHIEUBAU_UUTU` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `phieuchi_chi_cd`
--
ALTER TABLE `phieuchi_chi_cd`
  ADD CONSTRAINT `FK_CHI_PT_CD` FOREIGN KEY (`PT_CHIDOAN_ID`) REFERENCES `pt_chidoan` (`ID`),
  ADD CONSTRAINT `FK_CO_DP_CD` FOREIGN KEY (`CHIDOAN_ID`) REFERENCES `chidoan` (`ID`),
  ADD CONSTRAINT `FK_CUA_DP_CHI_CD` FOREIGN KEY (`LOAI_NOIDUNG_CHI_ID`) REFERENCES `loai_noidung_chi` (`ID`),
  ADD CONSTRAINT `FK_LAP_PC_CD` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID_TAO`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_NHAN_PC_CD` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID_NHAN`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `phieuchi_dk`
--
ALTER TABLE `phieuchi_dk`
  ADD CONSTRAINT `FK_CHI_PT_DK` FOREIGN KEY (`PT_DOANKHOA_ID`) REFERENCES `pt_doankhoa` (`ID`),
  ADD CONSTRAINT `FK_CO_DP_DK` FOREIGN KEY (`DOANKHOA_ID`) REFERENCES `doankhoa` (`ID`),
  ADD CONSTRAINT `FK_LAP_PC_DK` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID_NHAN`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_NHAN_PC_DK` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID_TAO`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_THUOC_DP_CHI_DK` FOREIGN KEY (`LOAI_NOIDUNG_CHI_ID`) REFERENCES `loai_noidung_chi` (`ID`);

--
-- Các ràng buộc cho bảng `phieudanhgia_chidoan`
--
ALTER TABLE `phieudanhgia_chidoan`
  ADD CONSTRAINT `FK_CB_XEPLOAI_CD` FOREIGN KEY (`CB_XEPLOAI_CD_ID`) REFERENCES `xeploai_cd` (`ID`),
  ADD CONSTRAINT `FK_CO_MAUPHIEU_CD` FOREIGN KEY (`MAUPHIEU_ID`) REFERENCES `mauphieu` (`ID`),
  ADD CONSTRAINT `FK_CO_PDG_CD` FOREIGN KEY (`CHIDOAN_ID`) REFERENCES `chidoan` (`ID`),
  ADD CONSTRAINT `FK_CO_XLCD` FOREIGN KEY (`XEPLOAI_CD_ID`) REFERENCES `xeploai_cd` (`ID`),
  ADD CONSTRAINT `FK_TAI_NAMHOC` FOREIGN KEY (`NAMHOC_ID`) REFERENCES `namhoc` (`ID`);

--
-- Các ràng buộc cho bảng `phieudanhgia_doankhoa`
--
ALTER TABLE `phieudanhgia_doankhoa`
  ADD CONSTRAINT `FK_CB_XEPLOAI_DK` FOREIGN KEY (`CB_XEPLOAI_DK_ID`) REFERENCES `xeploai_dk` (`ID`),
  ADD CONSTRAINT `FK_CO_MAUPHIEU_DK` FOREIGN KEY (`MAUPHIEU_ID`) REFERENCES `mauphieu` (`ID`),
  ADD CONSTRAINT `FK_CO_PDG_DOANKHOA` FOREIGN KEY (`DOANKHOA_ID`) REFERENCES `doankhoa` (`ID`),
  ADD CONSTRAINT `FK_CO_XLDK` FOREIGN KEY (`XEPLOAI_DK_ID`) REFERENCES `xeploai_dk` (`ID`),
  ADD CONSTRAINT `FK_O_NAMHOC` FOREIGN KEY (`NAMHOC_ID`) REFERENCES `namhoc` (`ID`);

--
-- Các ràng buộc cho bảng `phieudanhgia_doanvien`
--
ALTER TABLE `phieudanhgia_doanvien`
  ADD CONSTRAINT `FK_CD_XEPLOAI_DV_ID` FOREIGN KEY (`CD_XEPLOAI_DV_ID`) REFERENCES `xeploai_dv` (`ID`),
  ADD CONSTRAINT `FK_CO_MAUPHIEU_DV` FOREIGN KEY (`MAUPHIEU_ID`) REFERENCES `mauphieu` (`ID`),
  ADD CONSTRAINT `FK_CO_PDG` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_CO_XL_DV` FOREIGN KEY (`XEPLOAI_DV_ID`) REFERENCES `xeploai_dv` (`ID`),
  ADD CONSTRAINT `FK_CUA_NAMHOC` FOREIGN KEY (`NAMHOC_ID`) REFERENCES `namhoc` (`ID`),
  ADD CONSTRAINT `FK_NGUOI_DUYET_PDGDV_ID` FOREIGN KEY (`NGUOI_DUYET_PDGDV_ID`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `phuong_xa`
--
ALTER TABLE `phuong_xa`
  ADD CONSTRAINT `FK_CUA_QUAN_HUYEN` FOREIGN KEY (`QUAN_HUYEN_ID`) REFERENCES `quan_huyen` (`ID`);

--
-- Các ràng buộc cho bảng `pt_chidoan`
--
ALTER TABLE `pt_chidoan`
  ADD CONSTRAINT `FK_CUA_PT_CD` FOREIGN KEY (`LOAI_PT_ID`) REFERENCES `loai_pt` (`ID`),
  ADD CONSTRAINT `FK_TAI_HOCKY` FOREIGN KEY (`HOCKY_ID`) REFERENCES `hocky` (`ID`),
  ADD CONSTRAINT `FK_THUOC_CD` FOREIGN KEY (`CHIDOAN_ID`) REFERENCES `chidoan` (`ID`);

--
-- Các ràng buộc cho bảng `pt_doankhoa`
--
ALTER TABLE `pt_doankhoa`
  ADD CONSTRAINT `FK_CO_PT_DK` FOREIGN KEY (`DOANKHOA_ID`) REFERENCES `doankhoa` (`ID`),
  ADD CONSTRAINT `FK_CUA_PT_DK` FOREIGN KEY (`LOAI_PT_ID`) REFERENCES `loai_pt` (`ID`),
  ADD CONSTRAINT `FK_THUOC_VAITRO` FOREIGN KEY (`HOCKY_ID`) REFERENCES `hocky` (`ID`);

--
-- Các ràng buộc cho bảng `qd_dv_ketnap`
--
ALTER TABLE `qd_dv_ketnap`
  ADD CONSTRAINT `FK_CO_QD_DV_KN` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_CUA_DV_KN` FOREIGN KEY (`DV_KETNAP_ID`) REFERENCES `dv_ketnap` (`ID`);

--
-- Các ràng buộc cho bảng `qd_dv_ttdoan`
--
ALTER TABLE `qd_dv_ttdoan`
  ADD CONSTRAINT `FK_CO_QD_DV_TTD` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`),
  ADD CONSTRAINT `FK_CUA_DV_TTD` FOREIGN KEY (`DV_TT_DOAN_ID`) REFERENCES `dv_tt_doan` (`ID`);

--
-- Các ràng buộc cho bảng `quan_huyen`
--
ALTER TABLE `quan_huyen`
  ADD CONSTRAINT `FK_TAI_TINH_TP` FOREIGN KEY (`TINH_THANHPHO_ID`) REFERENCES `tinh_thanhpho` (`ID`);

--
-- Các ràng buộc cho bảng `thangnam`
--
ALTER TABLE `thangnam`
  ADD CONSTRAINT `FK_THUOC_NAMHOC` FOREIGN KEY (`NAMHOC_ID`) REFERENCES `namhoc` (`ID`);

--
-- Các ràng buộc cho bảng `thanhtich_thamgia`
--
ALTER TABLE `thanhtich_thamgia`
  ADD CONSTRAINT `FK_CUA_THANHTICH` FOREIGN KEY (`THANHTICH_ID`) REFERENCES `thanhtich` (`ID`),
  ADD CONSTRAINT `FK_THUOC_DK` FOREIGN KEY (`PT_DOANKHOA_ID`) REFERENCES `pt_doankhoa` (`ID`),
  ADD CONSTRAINT `FK_THUOC_DV` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_USER_CO_VAITRO` FOREIGN KEY (`VAITRO_ID`) REFERENCES `vaitro` (`ID`),
  ADD CONSTRAINT `FK_USER_LA_DV_TN` FOREIGN KEY (`DOANVIEN_THANHNIEN_ID`) REFERENCES `doanvien_thanhnien` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
