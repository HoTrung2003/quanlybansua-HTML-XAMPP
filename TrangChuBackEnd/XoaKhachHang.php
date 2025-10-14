<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Kiểm tra xem `Makhachhang` có được gửi qua URL không
if (isset($_GET['Makhachhang'])) {
    $makhachhang = $_GET['Makhachhang'];

    // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
    $conn->begin_transaction();

    try {
        // 1. Lấy danh sách `SoHieuHD` từ bảng `hoadon` liên quan đến `Makhachhang`
        $stmt = $conn->prepare("SELECT SoHieuHD FROM hoadon WHERE Makhachhang = ?");
        $stmt->bind_param("s", $makhachhang);
        $stmt->execute();
        $result = $stmt->get_result();

        $soHieuHDs = [];
        while ($row = $result->fetch_assoc()) {
            $soHieuHDs[] = $row['SoHieuHD'];
        }

        // 2. Xóa các bản ghi trong bảng `chitiethoadon` liên quan đến `SoHieuHD`
        if (!empty($soHieuHDs)) {
            $placeholders = implode(',', array_fill(0, count($soHieuHDs), '?'));
            $stmt = $conn->prepare("DELETE FROM chitiethoadon WHERE SoHieuHD IN ($placeholders)");
            $stmt->bind_param(str_repeat('i', count($soHieuHDs)), ...$soHieuHDs);
            $stmt->execute();
        }

        // 3. Xóa các bản ghi trong bảng `hoadon` liên quan đến `Makhachhang`
        $stmt = $conn->prepare("DELETE FROM hoadon WHERE Makhachhang = ?");
        $stmt->bind_param("s", $makhachhang);
        $stmt->execute();

        // 4. Xóa khách hàng từ bảng `khachhang`
        $stmt = $conn->prepare("DELETE FROM khachhang WHERE Makhachhang = ?");
        $stmt->bind_param("s", $makhachhang);
        $stmt->execute();

        // Commit transaction nếu không có lỗi
        $conn->commit();

        echo "<script>alert('Xóa khách hàng và các dữ liệu liên quan thành công!'); window.location.href = 'Danhsachkhachhang.php';</script>";
    } catch (Exception $e) {
        // Rollback nếu có lỗi
        $conn->rollback();
        echo "<script>alert('Xóa khách hàng không thành công: " . $e->getMessage() . "'); window.location.href = 'Danhsachkhachhang.php';</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy mã khách hàng!'); window.location.href = 'Danhsachkhachhang.php';</script>";
}

$conn->close();
