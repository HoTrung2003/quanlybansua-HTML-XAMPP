<?php
include('ketnoi.php');


if (isset($_GET['id'])) {
    $id_donhang = intval($_GET['id']); // Lấy id và ép kiểu để tránh SQL Injection

    // Xóa chi tiết đơn hàng trước
    $sql_delete_chitiet = "DELETE FROM chitietdonhang WHERE id_donhang = $id_donhang";
    mysqli_query($conn, $sql_delete_chitiet);

    // Xóa đơn hàng
    $sql_delete_donhang = "DELETE FROM donhang WHERE id_donhang = $id_donhang";
    $result = mysqli_query($conn, $sql_delete_donhang);

    // Kiểm tra và thông báo
    if ($result) {
        echo "<script>alert('Đơn hàng đã được xóa thành công.'); window.location.href='DonHang.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa đơn hàng.'); window.location.href='DonHang.php';</script>";
    }
}
?>
