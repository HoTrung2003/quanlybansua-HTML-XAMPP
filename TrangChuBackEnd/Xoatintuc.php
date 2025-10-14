<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Xóa tin tức khi người dùng xác nhận
if (isset($_GET['ID'])) {
    $id = $_GET['ID']; // Lấy ID từ URL
    $deleteQuery = "DELETE FROM tintuc WHERE Matintuc = ?"; // Sử dụng Matintuc thay vì ID
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $id); // Bind tham số

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Xóa tin tức thành công!'); window.location.href='Danhsachtintuc.php';</script>";
    } else {
        echo "<script>alert('Xóa tin tức thất bại. Vui lòng thử lại.');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>
