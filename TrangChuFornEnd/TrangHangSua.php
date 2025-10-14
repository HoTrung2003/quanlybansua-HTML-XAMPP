<?php
session_start();
ob_start();

// Kiểm tra nếu `Mahangsua` không được truyền
if (!isset($_GET['Mahangsua']) || empty($_GET['Mahangsua'])) {
    die("Mã hãng sữa không hợp lệ.");
}

// Lấy mã hãng sữa từ URL
$mahangsua = $_GET['Mahangsua'];

// Tạo mảng ánh xạ mã hãng sữa với trang tương ứng
$pages = [
    'VNM' => 'DanhsachVinamilk.php',
    'TH_TRUE' => 'DanhsachTH.php',
    'ABT' => 'DanhsachAbbott.php',
    'GHL' => 'DanhSachCoGaiHL.php'
];

// Kiểm tra mã hãng sữa và chuyển hướng
if (array_key_exists($mahangsua, $pages)) {
    header("Location: " . $pages[$mahangsua]);
    exit();
} else {
    die("Trang này chưa được tạo hoặc không tồn tại vui lòng về trang chủ");
}
?>
