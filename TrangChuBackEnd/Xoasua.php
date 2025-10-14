<?php
session_start();
ob_start();
include('ketnoi.php');

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION["lgadmin"]) || $_SESSION["lgadmin"] == "") {
    header("location: Dangnhap_admin.php");
    exit();
}

// Lấy mã sữa từ URL
$Masua = isset($_GET['Masua']) ? $_GET['Masua'] : null;

if ($Masua) {
    // Xóa các bản ghi liên quan trong bảng con
    $sql_xoa_chitiethoadon = "DELETE FROM chitiethoadon WHERE Masua = '$Masua'";
    $sql_xoa_chitietdonhang = "DELETE FROM chitietdonhang WHERE masua = '$Masua'";

    mysqli_query($conn, $sql_xoa_chitiethoadon);
    mysqli_query($conn, $sql_xoa_chitietdonhang);

    // Sau khi xóa liên kết, xóa sản phẩm trong bảng `sua`
    $sql_xoa_sua = "DELETE FROM sua WHERE Masua = '$Masua'";
    $xoa = mysqli_query($conn, $sql_xoa_sua);

    if ($xoa) {
        echo '<script>alert("Mặt hàng sữa đã được xóa."); window.location="DanhsachSua.php";</script>';
    } else {
        echo '<script>alert("Có lỗi trong quá trình xóa."); window.location="DanhsachSua.php";</script>';
    }
} else {
    echo '<script>alert("Mã sữa không hợp lệ."); window.location="DanhsachSua.php";</script>';
}

// Đóng kết nối
mysqli_close($conn);
?>
