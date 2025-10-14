-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 14, 2025 lúc 05:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `milkshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'KH001', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id` int(11) NOT NULL,
  `id_donhang` int(11) NOT NULL,
  `masua` varchar(12) NOT NULL,
  `tensua` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` decimal(10,2) NOT NULL,
  `tonggia` decimal(10,2) NOT NULL,
  `hinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id`, `id_donhang`, `masua`, `tensua`, `soluong`, `dongia`, `tonggia`, `hinh`) VALUES
(3, 3, 'S004', 'Sữa Tươi Cô Gái Hà Lan', 5, 25000.00, 125000.00, 'SuaTuoiCoGaiHL.png'),
(4, 4, 'S009', 'Sữa Chua Hương Dâu', 4, 17000.00, 68000.00, 'SuaChuaVinamilkDau.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `SoHieuHD` int(11) NOT NULL,
  `Masua` varchar(12) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Dongia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id_donhang` int(11) NOT NULL,
  `ngaydat` date NOT NULL,
  `tongtien` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id_donhang`, `ngaydat`, `tongtien`, `status`) VALUES
(2, '2024-11-28', 200000.00, 'Pending'),
(3, '2024-11-29', 125000.00, 'Pending'),
(4, '2024-11-30', 68000.00, 'Pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `masua` varchar(10) NOT NULL,
  `tensua` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` decimal(10,2) NOT NULL,
  `tonggia` decimal(10,2) NOT NULL,
  `hinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangsua`
--

CREATE TABLE `hangsua` (
  `Mahangsua` varchar(20) NOT NULL,
  `Tenhang` varchar(100) NOT NULL,
  `GioiThieu` text DEFAULT NULL,
  `Logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hangsua`
--

INSERT INTO `hangsua` (`Mahangsua`, `Tenhang`, `GioiThieu`, `Logo`) VALUES
('ABT', 'Abbott', 'Abbott luôn đặt sức khỏe và chất lượng cuộc sống của người tiêu dùng lên hàng đầu. Công ty cam kết:\r\n\r\n-Nghiên cứu và phát triển: Không ngừng nghiên cứu và phát triển các sản phẩm mới, cải tiến công thức để mang đến những sản phẩm tốt nhất cho người tiêu dùng.\r\n-Chất lượng: Đảm bảo chất lượng sản phẩm ở mọi khâu, từ nguyên liệu đầu vào đến sản phẩm cuối cùng.\r\n-An toàn: Đảm bảo an toàn cho người sử dụng sản phẩm.\r\n-Đạo đức: Tôn trọng đạo đức kinh doanh và trách nhiệm xã hội.', 'logoAB.png'),
('GHL', 'Cô Gái Hà Lan', 'Cô Gái Hà Lan luôn đặt chất lượng sản phẩm lên hàng đầu và không ngừng cải tiến để mang đến những sản phẩm tốt nhất cho người tiêu dùng. Thương hiệu luôn hướng tới mục tiêu xây dựng một cộng đồng khỏe mạnh và hạnh phúc.\r\n\r\nCô Gái Hà Lan là một thương hiệu sữa uy tín, được người tiêu dùng Việt Nam tin tưởng. Với chất lượng sản phẩm tốt, hương vị thơm ngon và đa dạng sản phẩm, Cô Gái Hà Lan xứng đáng là lựa chọn hàng đầu cho gia đình bạn.', 'logoGHL.png'),
('TH_TRUE', 'Th_True_Milk', 'TH true MILK luôn đặt chất lượng sản phẩm và sức khỏe người tiêu dùng lên hàng đầu. Thương hiệu cam kết:\r\n\r\n-Sữa tươi nguyên chất 100%: Không pha trộn, không chất bảo quản, đảm bảo nguồn sữa tươi sạch từ trang trại.\r\n-Chuỗi cung ứng khép kín: Kiểm soát chặt chẽ từ khâu nuôi bò, trồng cỏ, vắt sữa đến chế biến và phân phối.\r\n-Công nghệ hiện đại: Áp dụng công nghệ sản xuất tiên tiến, đạt tiêu chuẩn quốc tế.\r\n-Phát triển bền vững: Bảo vệ môi trường, sử dụng năng lượng tái tạo, giảm thiểu chất thải.\r\n-Cộng đồng: Góp phần vào sự phát triển của nông nghiệp Việt Nam, tạo việc làm và nâng cao đời sống nông dân.\r\n-Sức khỏe: Cung cấp sản phẩm dinh dưỡng tốt cho sức khỏe cộng đồng, đặc biệt là trẻ em.', 'logoTH.png'),
('VNM', 'Vinamilk', 'Chất lượng: Vinamilk luôn đặt chất lượng sản phẩm lên hàng đầu, đảm bảo sản phẩm an toàn, sạch và dinh dưỡng.\r\nNguồn sữa tươi sạch: Vinamilk sở hữu hệ thống trang trại bò sữa hiện đại, đảm bảo nguồn sữa tươi sạch, chất lượng cao.\r\nCông nghệ hiện đại: Áp dụng công nghệ sản xuất tiên tiến, đảm bảo các tiêu chuẩn quốc tế.\r\nPhát triển bền vững: Vinamilk cam kết bảo vệ môi trường, phát triển cộng đồng và đảm bảo phúc lợi cho người lao động.\r\nĐổi mới: Vinamilk không ngừng nghiên cứu và phát triển sản phẩm mới để đáp ứng nhu cầu của người tiêu dùng.', 'logoVNM.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `SoHieuHD` int(11) NOT NULL,
  `Makhachhang` varchar(20) NOT NULL,
  `Ngaylap` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `Makhachhang` varchar(20) NOT NULL,
  `Tenkhachhang` varchar(100) NOT NULL,
  `Diachi` varchar(255) NOT NULL,
  `Dienthoai` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`Makhachhang`, `Tenkhachhang`, `Diachi`, `Dienthoai`, `Email`) VALUES
('KH001', 'Nguyễn Văn A', 'Hà Nội', '0123456789', 'nguyenvana@gmail.com'),
('KH002', 'Trần Thị B', 'Hồ Chí Minh', '0987654321', 'tranthib@gmail.com'),
('KH003', 'Lê Minh C', 'Đà Nẵng', '0912345678', 'leminhc@gmail.com'),
('KH004', 'Phạm Quỳnh D', 'Cần Thơ', '0932123456', 'phamquynhd@gmail.com'),
('KH005', 'Vũ Đức E', 'Bắc Ninh', '0981234567', 'vuduce@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisua`
--

CREATE TABLE `loaisua` (
  `Maloai` varchar(10) NOT NULL,
  `Tenloai` varchar(50) NOT NULL,
  `GioiThieu` text DEFAULT NULL,
  `Hinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisua`
--

INSERT INTO `loaisua` (`Maloai`, `Tenloai`, `GioiThieu`, `Hinh`) VALUES
('S1', 'Sữa tươi', 'Sữa tươi, nguồn dưỡng chất tự nhiên từ những chú bò sữa khỏe mạnh. Với hương vị thơm ngon, béo ngậy, sữa tươi là thức uống bổ dưỡng hàng ngày, cung cấp canxi giúp xương chắc khỏe, protein hỗ trợ tăng trưởng và nhiều vitamin tốt cho cơ thể. Hãy bắt đầu ngày mới với một ly sữa tươi để tràn đầy năng lượng!', 'SuaTuoi.png'),
('S2', 'Sữa bột', 'Sữa bột - dinh dưỡng vàng cho mọi lứa tuổi. Dành cho người già, sữa bột giúp xương chắc khỏe, tăng cường sức đề kháng. Dành cho trẻ nhỏ, sữa bột hỗ trợ phát triển toàn diện cả về thể chất và trí tuệ. Với hương vị thơm ngon, dễ uống, sữa bột là lựa chọn hoàn hảo cho cả gia đình.', 'SuaBot.png'),
('S3', 'Sữa đặc', 'Sữa đặc, hương vị ngọt ngào, sánh mịn, là người bạn đồng hành không thể thiếu trong căn bếp của mọi gia đình. Với vị ngọt tự nhiên và độ đặc vừa phải, sữa đặc không chỉ dùng để pha chế cà phê, sinh tố mà còn là nguyên liệu tuyệt vời cho các món bánh, chè, kem. Sự tiện lợi trong bảo quản và đa dạng trong cách sử dụng khiến sữa đặc trở thành sản phẩm được yêu thích hàng đầu.', 'SuaDac.png'),
('S4', 'Sữa Chua', 'Sữa chua - món ăn vặt giàu dinh dưỡng, là người bạn đồng hành tuyệt vời cho sức khỏe của bạn. Với hàm lượng canxi cao, các loại vitamin và lợi khuẩn, sữa chua giúp tăng cường hệ tiêu hóa, hỗ trợ hệ miễn dịch và làm đẹp da. Hãy thưởng thức sữa chua mỗi ngày để cảm nhận sự khác biệt!', 'SuaChua.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sua`
--

CREATE TABLE `sua` (
  `Masua` varchar(12) NOT NULL,
  `Tensua` varchar(50) NOT NULL,
  `Mahangsua` varchar(20) NOT NULL,
  `Maloai` varchar(10) NOT NULL,
  `Trongluong` int(11) DEFAULT NULL,
  `Dongia` decimal(10,2) NOT NULL,
  `TP_dinh_duong` text DEFAULT NULL,
  `Loi_ich` text DEFAULT NULL,
  `Hinh` varchar(255) DEFAULT NULL,
  `Ngaynhap` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sua`
--

INSERT INTO `sua` (`Masua`, `Tensua`, `Mahangsua`, `Maloai`, `Trongluong`, `Dongia`, `TP_dinh_duong`, `Loi_ich`, `Hinh`, `Ngaynhap`) VALUES
('S001', 'Sữa Vinamilk vị Dâu', 'VNM', 'S1', 180, 22000.00, 'Sữa tươi: Cung cấp protein, canxi và các vitamin thiết yếu giúp xương chắc khỏe, tăng cường hệ miễn dịch.\r\nĐường: Cung cấp năng lượng cho cơ thể.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu.\r\nVitamin: Đặc biệt là vitamin A và D3, rất tốt cho mắt và xương.\r\nHương dâu: Tạo nên hương vị thơm ngon, hấp dẫn.', 'Cung cấp dinh dưỡng: Sữa Vinamilk vị dâu cung cấp đầy đủ các dưỡng chất cần thiết cho cơ thể, đặc biệt là canxi giúp xương chắc khỏe.\r\nHỗ trợ tiêu hóa: Chất xơ có trong sữa giúp hệ tiêu hóa hoạt động tốt hơn.\r\nTăng cường sức đề kháng: Vitamin và khoáng chất trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nCung cấp năng lượng: Đường và chất béo trong sữa cung cấp năng lượng cần thiết cho các hoạt động hàng ngày.\r\nVị ngon: Hương dâu thơm ngon, dễ uống, đặc biệt hấp dẫn trẻ em.', 'SuaDauVinamilk.png', '2024-11-28'),
('S002', 'Sữa Vinamilk vị Socola', 'VNM', 'S1', 180, 28000.00, 'Sữa tươi: Cung cấp protein, canxi và các vitamin thiết yếu giúp xương chắc khỏe, tăng cường hệ miễn dịch.\r\nĐường: Cung cấp năng lượng cho cơ thể.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu.\r\nVitamin: Đặc biệt là vitamin A và D3, rất tốt cho mắt và xương.\r\nHương Socola: Tạo nên hương vị thơm ngon, hấp dẫn.', 'Cung cấp dinh dưỡng: Sữa Vinamilk vị dâu cung cấp đầy đủ các dưỡng chất cần thiết cho cơ thể, đặc biệt là canxi giúp xương chắc khỏe.\r\nHỗ trợ tiêu hóa: Chất xơ có trong sữa giúp hệ tiêu hóa hoạt động tốt hơn.\r\nTăng cường sức đề kháng: Vitamin và khoáng chất trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nCung cấp năng lượng: Đường và chất béo trong sữa cung cấp năng lượng cần thiết cho các hoạt động hàng ngày.\r\nVị ngon: Hương socola thơm ngon, dễ uống, đặc biệt hấp dẫn trẻ em.', 'VinamilkSocola.png', '2024-11-28'),
('S003', 'Sữa Tươi Vinamilk (ít đường)', 'VNM', 'S1', 190, 20000.00, 'Sữa tươi: Cung cấp protein, canxi và các vitamin thiết yếu giúp xương chắc khỏe, tăng cường hệ miễn dịch.\r\nĐường: Lượng đường được giảm đi so với các loại sữa thông thường, giúp kiểm soát lượng đường trong máu.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu.\r\nVitamin: Đặc biệt là vitamin A, D3 và Selen, rất tốt cho mắt, xương và tăng cường sức đề kháng.', 'Cung cấp dinh dưỡng: Sữa tươi Vinamilk ít đường cung cấp đầy đủ các dưỡng chất cần thiết cho cơ thể, đặc biệt là canxi giúp xương chắc khỏe.\r\nHỗ trợ tiêu hóa: Chất xơ có trong sữa giúp hệ tiêu hóa hoạt động tốt hơn.\r\nTăng cường sức đề kháng: Vitamin và khoáng chất trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nKiểm soát đường huyết: Lượng đường thấp giúp người mắc bệnh tiểu đường hoặc muốn kiểm soát cân nặng dễ dàng hơn.\r\nVị thơm ngon: Sữa có vị thơm béo tự nhiên, dễ uống.', 'SuaTuoiVinamilk.png', '2024-11-28'),
('S004', 'Sữa Tươi Cô Gái Hà Lan', 'GHL', 'S1', 159, 25000.00, 'Protein: Giúp xây dựng và sửa chữa các tế bào, tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nVitamin D: Giúp cơ thể hấp thu canxi tốt hơn.\r\nCác vitamin và khoáng chất khác: Như vitamin A, B2, B12, kali...', 'Cung cấp năng lượng: Sữa tươi là nguồn cung cấp năng lượng quan trọng cho cơ thể, đặc biệt là trẻ em và người già.\r\nTốt cho xương: Canxi và vitamin D trong sữa giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nTăng cường hệ miễn dịch: Protein và các vitamin trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nHỗ trợ tiêu hóa: Sữa tươi dễ tiêu hóa, cung cấp các lợi khuẩn tốt cho hệ tiêu hóa.', 'SuaTuoiCoGaiHL.png', '2024-11-28'),
('S005', 'Sữa Tươi Abbott', 'GHL', 'S1', 180, 30000.00, 'Sữa tươi Abbott chứa nhiều protein, canxi, vitamin và khoáng chất cần thiết cho sự phát triển toàn diện của cơ thể.', 'Cung cấp năng lượng: Sữa tươi là nguồn cung cấp năng lượng quan trọng cho cơ thể, giúp bạn hoạt động cả ngày.\r\nTốt cho xương: Canxi trong sữa giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nTăng cường hệ miễn dịch: Protein và các vitamin trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nHỗ trợ tiêu hóa: Sữa tươi dễ tiêu hóa, cung cấp các lợi khuẩn tốt cho hệ tiêu hóa.', 'AbbottSimilac.png', '2024-11-28'),
('S006', 'Sữa Cô Gái Hà Lan Hương Dâu', 'TH_TRUE', 'S1', 120, 23000.00, 'Canxi: Giúp xương chắc khỏe.\r\nProtein: Tăng cường sức đề kháng.\r\nVitamin và khoáng chất: Hỗ trợ quá trình trao đổi chất.', 'Cung cấp năng lượng: Sữa là nguồn cung cấp năng lượng quan trọng cho cơ thể, giúp bạn hoạt động cả ngày.\r\nTốt cho xương: Canxi trong sữa giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nTăng cường hệ miễn dịch: Protein và các vitamin trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nCải thiện tiêu hóa: Sữa dễ tiêu hóa, cung cấp các lợi khuẩn tốt cho hệ tiêu hóa', 'SuaChuaVinamilkDau.png', '2024-11-28'),
('S007', 'Sữa Ông Thọ', 'VNM', 'S3', 200, 25000.00, 'Sữa: Cung cấp protein, canxi và các vitamin cần thiết cho cơ thể.\r\nĐường: Cung cấp năng lượng.\r\nChất béo: Làm cho sữa có vị béo ngậy.', 'Cung cấp năng lượng: Sữa Ông Thọ là nguồn cung cấp năng lượng nhanh chóng và tiện lợi.\r\nLàm phong phú hương vị: Sữa Ông Thọ giúp làm tăng hương vị thơm ngon của các món ăn và đồ uống.\r\nHỗ trợ tiêu hóa: Sữa Ông Thọ dễ tiêu hóa, cung cấp năng lượng cho cơ thể.', 'SuaDacVinamilk.png', '2024-11-28'),
('S008', 'Sữa Đặc Cô Gái Hà Lan', 'GHL', 'S3', 210, 28000.00, 'Sữa: Cung cấp protein, canxi và các vitamin cần thiết cho cơ thể.\r\nĐường: Cung cấp năng lượng.\r\nChất béo: Làm cho sữa có vị béo ngậy.', 'Cung cấp năng lượng: Sữa Ông Thọ là nguồn cung cấp năng lượng nhanh chóng và tiện lợi.\r\nLàm phong phú hương vị: Sữa Ông Thọ giúp làm tăng hương vị thơm ngon của các món ăn và đồ uống.\r\nHỗ trợ tiêu hóa: Sữa Ông Thọ dễ tiêu hóa, cung cấp năng lượng cho cơ thể.', 'SuaDac_CoGaiHaLan.png', '2024-11-28'),
('S009', 'Sữa Chua Hương Dâu', 'VNM', 'S4', 150, 17000.00, 'Canxi: Cần thiết cho sự phát triển của xương và răng.\r\nProtein: Giúp xây dựng và sửa chữa các tế bào.\r\nVitamin B12: Cần thiết cho quá trình tạo máu.\r\nLợi khuẩn: Giúp cân bằng hệ vi sinh vật đường ruột, hỗ trợ tiêu hóa.', 'Hỗ trợ tiêu hóa: Lợi khuẩn trong sữa chua giúp cải thiện hệ tiêu hóa, giảm tình trạng táo bón và tiêu chảy.\r\nTăng cường hệ miễn dịch: Sữa chua giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nGiảm nguy cơ mắc bệnh: Sữa chua có thể giúp giảm nguy cơ mắc một số bệnh như tim mạch, tiểu đường và một số loại ung thư.\r\nCải thiện sức khỏe xương: Canxi trong sữa chua giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nGiảm cân: Một số nghiên cứu cho thấy sữa chua có thể giúp giảm cân và kiểm soát cân nặng.', 'SuaChuaVinamilkDau.png', '2024-11-28'),
('S010', 'Sữa Chua Cô Gái Hà Lan', 'GHL', 'S4', 170, 20000.00, 'Canxi: Cần thiết cho sự phát triển của xương và răng.\r\nProtein: Giúp xây dựng và sửa chữa các tế bào.\r\nVitamin B12: Cần thiết cho quá trình tạo máu.\r\nLợi khuẩn: Giúp cân bằng hệ vi sinh vật đường ruột, hỗ trợ tiêu hóa.', 'Hỗ trợ tiêu hóa: Lợi khuẩn trong sữa chua giúp cải thiện hệ tiêu hóa, giảm tình trạng táo bón và tiêu chảy.\r\nTăng cường hệ miễn dịch: Sữa chua giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nGiảm nguy cơ mắc bệnh: Sữa chua có thể giúp giảm nguy cơ mắc một số bệnh như tim mạch, tiểu đường và một số loại ung thư.\r\nCải thiện sức khỏe xương: Canxi trong sữa chua giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nGiảm cân: Một số nghiên cứu cho thấy sữa chua có thể giúp giảm cân và kiểm soát cân nặng.', 'SuaChuaCoGaiHL.png', '2024-11-28'),
('S011', 'Sữa Bột Vinamilk', 'VNM', 'S2', 800, 800000.00, 'Protein: Là thành phần chính để xây dựng và sửa chữa các tế bào trong cơ thể, giúp trẻ phát triển cơ bắp và tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng, giúp xương chắc khỏe.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nCác vitamin và khoáng chất: Như vitamin A, D, E, K, các vitamin nhóm B, sắt, kẽm,... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch, thúc đẩy quá trình trao đổi chất.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu như A, D, E, K.', 'Hỗ trợ tăng trưởng: Cung cấp đầy đủ các dưỡng chất cần thiết cho sự phát triển chiều cao, cân nặng và trí não của trẻ.\r\nTăng cường hệ miễn dịch: Giúp trẻ khỏe mạnh, ít ốm vặt.\r\nCải thiện tiêu hóa: Hỗ trợ hệ tiêu hóa khỏe mạnh, giúp trẻ hấp thu tốt các dưỡng chất.', 'SuaBotVinamilk.png', '2024-11-28'),
('S012', 'Sữa Bột Cô Gái Hà Lan', 'GHL', 'S2', 900, 1220000.00, 'Protein: Là thành phần chính để xây dựng và sửa chữa các tế bào trong cơ thể, giúp trẻ phát triển cơ bắp và tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng, giúp xương chắc khỏe.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nCác vitamin và khoáng chất: Như vitamin A, D, E, K, các vitamin nhóm B, sắt, kẽm,... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch, thúc đẩy quá trình trao đổi chất.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu như A, D, E, K.', 'Hỗ trợ tăng trưởng: Cung cấp đầy đủ các dưỡng chất cần thiết cho sự phát triển chiều cao, cân nặng và trí não của trẻ.\r\nTăng cường hệ miễn dịch: Giúp trẻ khỏe mạnh, ít ốm vặt.\r\nCải thiện tiêu hóa: Hỗ trợ hệ tiêu hóa khỏe mạnh, giúp trẻ hấp thu tốt các dưỡng chất.', 'banner_main.jpg', '2024-11-28'),
('S013', 'Sữa Abbott Grow', 'ABT', 'S2', 900, 1500000.00, 'Protein: Là thành phần chính để xây dựng và sửa chữa các tế bào trong cơ thể, giúp trẻ phát triển cơ bắp và tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng, giúp xương chắc khỏe.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nCác vitamin và khoáng chất: Như vitamin A, D, E, K, các vitamin nhóm B, sắt, kẽm,... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch, thúc đẩy quá trình trao đổi chất.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu như A, D, E, K.', 'Hỗ trợ tăng trưởng: Cung cấp đầy đủ các dưỡng chất cần thiết cho sự phát triển chiều cao, cân nặng và trí não của trẻ.\r\nTăng cường hệ miễn dịch: Giúp trẻ khỏe mạnh, ít ốm vặt.\r\nCải thiện tiêu hóa: Hỗ trợ hệ tiêu hóa khỏe mạnh, giúp trẻ hấp thu tốt các dưỡng chất.', 'SuaBotAbbottGrow.png', '2024-11-28'),
('S014', 'Sữa Bột Abbott Similac', 'ABT', 'S2', 700, 1110000.00, 'Protein: Là thành phần chính để xây dựng và sửa chữa các tế bào trong cơ thể, giúp trẻ phát triển cơ bắp và tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng, giúp xương chắc khỏe.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nCác vitamin và khoáng chất: Như vitamin A, D, E, K, các vitamin nhóm B, sắt, kẽm,... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch, thúc đẩy quá trình trao đổi chất.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu như A, D, E, K.', 'Hỗ trợ tăng trưởng: Cung cấp đầy đủ các dưỡng chất cần thiết cho sự phát triển chiều cao, cân nặng và trí não của trẻ.\r\nTăng cường hệ miễn dịch: Giúp trẻ khỏe mạnh, ít ốm vặt.\r\nCải thiện tiêu hóa: Hỗ trợ hệ tiêu hóa khỏe mạnh, giúp trẻ hấp thu tốt các dưỡng chất.', 'AbbottSimilac.png', '2024-11-28'),
('S015', 'Sữa Abbott Pedia Sure', 'ABT', 'S2', 800, 896000.00, 'Protein: Là thành phần chính để xây dựng và sửa chữa các tế bào trong cơ thể, giúp trẻ phát triển cơ bắp và tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng, giúp xương chắc khỏe.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nCác vitamin và khoáng chất: Như vitamin A, D, E, K, các vitamin nhóm B, sắt, kẽm,... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch, thúc đẩy quá trình trao đổi chất.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu như A, D, E, K.', 'Hỗ trợ tăng trưởng: Cung cấp đầy đủ các dưỡng chất cần thiết cho sự phát triển chiều cao, cân nặng và trí não của trẻ.\r\nTăng cường hệ miễn dịch: Giúp trẻ khỏe mạnh, ít ốm vặt.\r\nCải thiện tiêu hóa: Hỗ trợ hệ tiêu hóa khỏe mạnh, giúp trẻ hấp thu tốt các dưỡng chất.', 'AbbottPediaSure.png', '2024-11-28'),
('S016', 'Sữa Abbott Ensure', 'ABT', 'S2', 900, 1500000.00, 'Protein: Là thành phần chính để xây dựng và sửa chữa các tế bào trong cơ thể, giúp trẻ phát triển cơ bắp và tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng, giúp xương chắc khỏe.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nCác vitamin và khoáng chất: Như vitamin A, D, E, K, các vitamin nhóm B, sắt, kẽm,... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch, thúc đẩy quá trình trao đổi chất.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu như A, D, E, K.', 'Hỗ trợ tăng trưởng: Cung cấp đầy đủ các dưỡng chất cần thiết cho sự phát triển chiều cao, cân nặng và trí não của trẻ.\r\nTăng cường hệ miễn dịch: Giúp trẻ khỏe mạnh, ít ốm vặt.\r\nCải thiện tiêu hóa: Hỗ trợ hệ tiêu hóa khỏe mạnh, giúp trẻ hấp thu tốt các dưỡng chất.', 'AbbottEnsure.png', '2024-11-28'),
('S017', 'Sữa Việt Quất TH-True-Milk', 'TH_TRUE', 'S4', 90, 17000.00, 'Canxi: Cần thiết cho sự phát triển của xương và răng.\r\nProtein: Giúp xây dựng và sửa chữa các tế bào.\r\nVitamin B12: Cần thiết cho quá trình tạo máu.\r\nLợi khuẩn: Giúp cân bằng hệ vi sinh vật đường ruột, hỗ trợ tiêu hóa.', 'Hỗ trợ tiêu hóa: Lợi khuẩn trong sữa chua giúp cải thiện hệ tiêu hóa, giảm tình trạng táo bón và tiêu chảy.\r\nTăng cường hệ miễn dịch: Sữa chua giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nGiảm nguy cơ mắc bệnh: Sữa chua có thể giúp giảm nguy cơ mắc một số bệnh như tim mạch, tiểu đường và một số loại ung thư.\r\nCải thiện sức khỏe xương: Canxi trong sữa chua giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nGiảm cân: Một số nghiên cứu cho thấy sữa chua có thể giúp giảm cân và kiểm soát cân nặng.', 'SuaVietQuatTH.png', '2024-11-28'),
('S018', 'Sữa tiệt trùng TH-True-Milk', 'TH_TRUE', 'S1', 150, 24000.00, 'Sữa tươi: Cung cấp protein, canxi và các vitamin thiết yếu giúp xương chắc khỏe, tăng cường hệ miễn dịch.\r\nĐường: Lượng đường được giảm đi so với các loại sữa thông thường, giúp kiểm soát lượng đường trong máu.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu.\r\nVitamin: Đặc biệt là vitamin A, D3 và Selen, rất tốt cho mắt, xương và tăng cường sức đề kháng.', 'Cung cấp dinh dưỡng: Sữa tươi Vinamilk ít đường cung cấp đầy đủ các dưỡng chất cần thiết cho cơ thể, đặc biệt là canxi giúp xương chắc khỏe.\r\nHỗ trợ tiêu hóa: Chất xơ có trong sữa giúp hệ tiêu hóa hoạt động tốt hơn.\r\nTăng cường sức đề kháng: Vitamin và khoáng chất trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nKiểm soát đường huyết: Lượng đường thấp giúp người mắc bệnh tiểu đường hoặc muốn kiểm soát cân nặng dễ dàng hơn.\r\nVị thơm ngon: Sữa có vị thơm béo tự nhiên, dễ uống.', 'SuaTuoiTH.png', '2024-11-28'),
('S019', 'Sữa tươi vị Dâu TH-True-Milk', 'TH_TRUE', 'S1', 160, 21000.00, 'Sữa tươi: Cung cấp protein, canxi và các vitamin thiết yếu giúp xương chắc khỏe, tăng cường hệ miễn dịch.\r\nĐường: Lượng đường được giảm đi so với các loại sữa thông thường, giúp kiểm soát lượng đường trong máu.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu.\r\nVitamin: Đặc biệt là vitamin A, D3 và Selen, rất tốt cho mắt, xương và tăng cường sức đề kháng.', 'Cung cấp dinh dưỡng: Sữa tươi cung cấp đầy đủ các dưỡng chất cần thiết cho cơ thể, đặc biệt là canxi giúp xương chắc khỏe.\r\nHỗ trợ tiêu hóa: Chất xơ có trong sữa giúp hệ tiêu hóa hoạt động tốt hơn.\r\nTăng cường sức đề kháng: Vitamin và khoáng chất trong sữa giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nKiểm soát đường huyết: Lượng đường thấp giúp người mắc bệnh tiểu đường hoặc muốn kiểm soát cân nặng dễ dàng hơn.\r\nVị thơm ngon: Sữa có vị thơm dâu tây và béo tự nhiên, dễ uống.', 'SuaDauTH.png', '2024-11-28'),
('S020', 'Sữa Chua Tiệt Trung TH-True-Milk', 'TH_TRUE', 'S4', 100, 19000.00, 'Canxi: Cần thiết cho sự phát triển của xương và răng.\r\nProtein: Giúp xây dựng và sửa chữa các tế bào.\r\nVitamin B12: Cần thiết cho quá trình tạo máu.\r\nLợi khuẩn: Giúp cân bằng hệ vi sinh vật đường ruột, hỗ trợ tiêu hóa.', 'Hỗ trợ tiêu hóa: Lợi khuẩn trong sữa chua giúp cải thiện hệ tiêu hóa, giảm tình trạng táo bón và tiêu chảy.\r\nTăng cường hệ miễn dịch: Sữa chua giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nGiảm nguy cơ mắc bệnh: Sữa chua có thể giúp giảm nguy cơ mắc một số bệnh như tim mạch, tiểu đường và một số loại ung thư.\r\nCải thiện sức khỏe xương: Canxi trong sữa chua giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nGiảm cân: Một số nghiên cứu cho thấy sữa chua có thể giúp giảm cân và kiểm soát cân nặng.', 'SuaChuaThgTH.jpg', '2024-11-28'),
('S021', 'Sữa Chua Hoa Quả TH-True-Milk', 'TH_TRUE', 'S4', 110, 22000.00, 'Canxi: Cần thiết cho sự phát triển của xương và răng.\r\nProtein: Giúp xây dựng và sửa chữa các tế bào.\r\nVitamin B12: Cần thiết cho quá trình tạo máu.\r\nLợi khuẩn: Giúp cân bằng hệ vi sinh vật đường ruột, hỗ trợ tiêu hóa.', 'Hỗ trợ tiêu hóa: Lợi khuẩn trong sữa chua giúp cải thiện hệ tiêu hóa, giảm tình trạng táo bón và tiêu chảy.\r\nTăng cường hệ miễn dịch: Sữa chua giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nGiảm nguy cơ mắc bệnh: Sữa chua có thể giúp giảm nguy cơ mắc một số bệnh như tim mạch, tiểu đường và một số loại ung thư.\r\nCải thiện sức khỏe xương: Canxi trong sữa chua giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nGiảm cân: Một số nghiên cứu cho thấy sữa chua có thể giúp giảm cân và kiểm soát cân nặng.', 'SuaChuaTH.png', '2024-11-28'),
('S022', 'Sữa Bột TH-True-Milk', 'TH_TRUE', 'S2', 900, 1900000.00, 'Protein: Là thành phần chính để xây dựng và sửa chữa các tế bào trong cơ thể, giúp trẻ phát triển cơ bắp và tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho sự phát triển của xương và răng, giúp xương chắc khỏe.\r\nPhốt pho: Làm việc cùng với canxi để giúp xương chắc khỏe.\r\nCác vitamin và khoáng chất: Như vitamin A, D, E, K, các vitamin nhóm B, sắt, kẽm,... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch, thúc đẩy quá trình trao đổi chất.\r\nChất béo: Cung cấp năng lượng và giúp cơ thể hấp thu các vitamin tan trong dầu như A, D, E, K.', 'Hỗ trợ tăng trưởng: Cung cấp đầy đủ các dưỡng chất cần thiết cho sự phát triển chiều cao, cân nặng và trí não của trẻ.\r\nTăng cường hệ miễn dịch: Giúp trẻ khỏe mạnh, ít ốm vặt.\r\nCải thiện tiêu hóa: Hỗ trợ hệ tiêu hóa khỏe mạnh, giúp trẻ hấp thu tốt các dưỡng chất.', 'SuaBotTH.jpg', '2024-11-28'),
('S023', 'Sữa Chua Sầu Riêng TH-True-Milk', 'TH_TRUE', 'S4', 100, 30000.00, 'Sữa hoàn toàn từ sữa bò tươi: Cung cấp protein, canxi, vitamin D giúp xây dựng xương chắc khỏe, tăng cường hệ miễn dịch.\r\nĐường tinh luyện: Cung cấp năng lượng cho cơ thể.\r\nChất ổn định: Giúp sản phẩm có kết cấu sánh mịn.\r\nBột sầu riêng: Tạo hương vị đặc trưng, bổ sung thêm một số vitamin và khoáng chất.\r\nMen vi sinh: Chứa các lợi khuẩn như Streptococcus thermophilus và Lactobacillus bulgaricus, hỗ trợ tiêu hóa, tăng cường hệ miễn dịch.', 'Tốt cho hệ tiêu hóa:\r\nCác lợi khuẩn trong sữa chua giúp cân bằng hệ vi sinh đường ruột, hỗ trợ tiêu hóa, giảm tình trạng táo bón, đầy hơi.\r\nGiảm nguy cơ mắc các bệnh về đường tiêu hóa như viêm loét dạ dày, hội chứng ruột kích thích.\r\nTăng cường hệ miễn dịch:\r\nCác lợi khuẩn và các vitamin, khoáng chất trong sữa chua giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi các tác nhân gây bệnh.\r\nCung cấp canxi:\r\nSữa chua là nguồn cung cấp canxi dồi dào, giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nĐặc biệt tốt cho trẻ em trong giai đoạn phát triển và người cao tuổi.\r\nCung cấp năng lượng:\r\nĐường trong sữa chua cung cấp năng lượng nhanh chóng cho cơ thể, giúp bạn hoạt động năng động hơn.\r\nCải thiện làn da:\r\nCác vitamin và khoáng chất trong sữa chua giúp nuôi dưỡng làn da từ sâu bên trong, làm chậm quá trình lão hóa, giúp da sáng mịn.\r\nHương vị thơm ngon:\r\nSự kết hợp giữa vị chua nhẹ của sữa chua và vị béo ngậy của sầu riêng tạo nên hương vị độc đáo, dễ uống, phù hợp với nhiều người.', 'SuaChuaTHSauRieng.png', '2024-11-29'),
('S024', 'Sữa Tươi Thanh Trùng 500ml', 'TH_TRUE', 'S1', 500, 25000.00, 'Sữa bò tươi: Là thành phần chính, cung cấp protein, canxi, vitamin D và các chất béo cần thiết cho cơ thể.\r\nNước: Là dung môi hòa tan các chất dinh dưỡng.\r\nĐường: Cung cấp năng lượng, tạo vị ngọt cho sữa (nếu có).\r\nChất béo: Cung cấp năng lượng, giúp hấp thu các vitamin tan trong dầu.\r\nProtein: Vật liệu xây dựng cơ thể, tăng cường hệ miễn dịch.\r\nCanxi: Cần thiết cho xương và răng chắc khỏe.\r\nVitamin: Như vitamin A, D, B12... giúp tăng cường thị lực, hỗ trợ hệ miễn dịch và trao đổi chất.\r\nKhoáng chất: Như kali, photpho... giúp duy trì cân bằng điện giải trong cơ thể.', 'Tốt cho hệ xương: Canxi trong sữa giúp xương chắc khỏe, phòng ngừa loãng xương.\r\nTăng cường sức đề kháng: Protein và các vitamin giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi bệnh tật.\r\nCung cấp năng lượng: Đường trong sữa cung cấp năng lượng cần thiết cho các hoạt động hàng ngày.\r\nHỗ trợ tiêu hóa: Các lợi khuẩn có trong sữa giúp cải thiện hệ tiêu hóa.', 'SuaTuoiThanhTrungTH.png', '2024-11-29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `Matintuc` int(11) NOT NULL,
  `Tieude` varchar(255) NOT NULL,
  `Noidung` text NOT NULL,
  `Trangthai` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masua` (`masua`),
  ADD KEY `fk_donhang_chitietdonhang` (`id_donhang`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`SoHieuHD`,`Masua`),
  ADD KEY `Masua` (`Masua`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_donhang`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hangsua`
--
ALTER TABLE `hangsua`
  ADD PRIMARY KEY (`Mahangsua`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`SoHieuHD`),
  ADD KEY `fk_khachhang_hoadon` (`Makhachhang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`Makhachhang`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `loaisua`
--
ALTER TABLE `loaisua`
  ADD PRIMARY KEY (`Maloai`);

--
-- Chỉ mục cho bảng `sua`
--
ALTER TABLE `sua`
  ADD PRIMARY KEY (`Masua`),
  ADD KEY `fk_hangsua_sua` (`Mahangsua`),
  ADD KEY `fk_loaisua_sua` (`Maloai`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`Matintuc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_donhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `SoHieuHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `Matintuc` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`id_donhang`) REFERENCES `donhang` (`id_donhang`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`masua`) REFERENCES `sua` (`Masua`),
  ADD CONSTRAINT `fk_donhang_chitietdonhang` FOREIGN KEY (`id_donhang`) REFERENCES `donhang` (`id_donhang`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`SoHieuHD`) REFERENCES `hoadon` (`SoHieuHD`),
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`Masua`) REFERENCES `sua` (`Masua`),
  ADD CONSTRAINT `fk_hoadon_chitiethoadon` FOREIGN KEY (`SoHieuHD`) REFERENCES `hoadon` (`SoHieuHD`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_khachhang_hoadon` FOREIGN KEY (`Makhachhang`) REFERENCES `khachhang` (`Makhachhang`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`Makhachhang`) REFERENCES `khachhang` (`Makhachhang`);

--
-- Các ràng buộc cho bảng `sua`
--
ALTER TABLE `sua`
  ADD CONSTRAINT `fk_hangsua_sua` FOREIGN KEY (`Mahangsua`) REFERENCES `hangsua` (`Mahangsua`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_loaisua_sua` FOREIGN KEY (`Maloai`) REFERENCES `loaisua` (`Maloai`) ON DELETE CASCADE,
  ADD CONSTRAINT `sua_ibfk_1` FOREIGN KEY (`Mahangsua`) REFERENCES `hangsua` (`Mahangsua`),
  ADD CONSTRAINT `sua_ibfk_2` FOREIGN KEY (`Maloai`) REFERENCES `loaisua` (`Maloai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
