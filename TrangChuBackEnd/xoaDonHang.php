<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra quyền truy cập
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Kiểm tra mã đơn hàng
if (isset($_GET['SoHieuHD'])) {
    $soHieuHD = $_GET['SoHieuHD'];

    // Xóa bản ghi liên quan trong bảng con
    $query_chitiethoadon = "DELETE FROM chitiethoadon WHERE SoHieuHD = '$soHieuHD'";
    mysqli_query($conn, $query_chitiethoadon);

    // Sau đó xóa đơn hàng trong bảng `hoadon`
    $query_hoadon = "DELETE FROM hoadon WHERE SoHieuHD = '$soHieuHD'";
    if (mysqli_query($conn, $query_hoadon)) {
        echo "<script>alert('Xóa đơn hàng thành công!'); window.location.href='danhSachDonHang.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa đơn hàng! Kiểm tra các liên kết dữ liệu.'); window.location.href='danhSachDonHang.php';</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy mã đơn hàng!'); window.location.href='danhSachDonHang.php';</script>";
}

// Đóng kết nối
mysqli_close($conn);
?>
