<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Kiểm tra mã loại sữa
if (isset($_GET['Maloai'])) {
    $maloai = $_GET['Maloai'];

    try {
        // Xóa loại sữa
        $stmt = $conn->prepare("DELETE FROM loaisua WHERE Maloai = ?");
        $stmt->bind_param("s", $maloai);

        if ($stmt->execute()) {
            echo "<script>
                alert('Xóa loại sữa và các thành phần liên quan thành công!');
                window.location.href = 'Danhsachloai.php';
            </script>";
        } else {
            throw new Exception("Không thể xóa loại sữa này.");
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "<script>
            alert('Xóa không thành công: {$e->getMessage()}');
            window.location.href = 'Danhsachloai.php';
        </script>";
    }
} else {
    echo "<script>alert('Không có mã loại sữa để xóa!'); window.location.href = 'Danhsachloai.php';</script>";
}

$conn->close();
