<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Kiểm tra mã hãng sữa
if (isset($_GET['Mahangsua'])) {
    $mahangsua = $_GET['Mahangsua'];

    try {
        // Xóa hãng sữa
        $stmt = $conn->prepare("DELETE FROM hangsua WHERE Mahangsua = ?");
        $stmt->bind_param("s", $mahangsua);

        if ($stmt->execute()) {
            echo "<script>
                alert('Xóa hãng sữa và các thành phần liên quan thành công!');
                window.location.href = 'Danhsachhang.php';
            </script>";
        } else {
            throw new Exception("Không thể xóa hãng sữa này.");
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "<script>
            alert('Xóa không thành công: {$e->getMessage()}');
            window.location.href = 'Danhsachhang.php';
        </script>";
    }
} else {
    echo "<script>alert('Không có mã hãng sữa để xóa!'); window.location.href = 'Danhsachhang.php';</script>";
}

$conn->close();
