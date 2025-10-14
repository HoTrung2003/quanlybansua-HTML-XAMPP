<?php
session_start();
ob_start();

// Kiểm tra nếu `Maloai` không được truyền
if (!isset($_GET['Maloai']) || empty($_GET['Maloai'])) {
    die("Mã loại sữa không hợp lệ.");
}

// Lấy mã loại sữa từ URL
$maloai = $_GET['Maloai'];

// Tạo mảng ánh xạ mã loại sữa với trang tương ứng
$pages = [
    'S1' => 'DanhSachSuaTuoi.php',
    'S2' => 'DanhSachSuaBot.php',
    'S3' => 'DanhSachSuaDac.php',
    'S4' => 'DanhSachSuaChua.php'
];

// Kiểm tra mã loại sữa và chuyển hướng
if (array_key_exists($maloai, $pages)) {
    header("Location: " . $pages[$maloai]);
    exit();
} else {
    die("Trang này chưa được tạo hoặc không tồn tại vui lòng về trang chủ");
}
?>
