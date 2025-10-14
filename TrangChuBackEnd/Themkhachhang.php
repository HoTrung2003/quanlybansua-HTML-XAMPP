<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Xử lý form khi người dùng gửi POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maKhachHang = $_POST['Makhachhang'];
    $tenKhachHang = $_POST['Tenkhachhang'];
    $diaChi = $_POST['Diachi'];
    $dienThoai = $_POST['Dienthoai'];
    $email = $_POST['Email'];

    if (!empty($maKhachHang) && !empty($tenKhachHang) && !empty($diaChi) && !empty($dienThoai) && !empty($email)) {
        // Kiểm tra xem mã khách hàng đã tồn tại trong cơ sở dữ liệu chưa
        $checkQuery = "SELECT * FROM khachhang WHERE Makhachhang = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, 's', $maKhachHang);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Mã khách hàng đã tồn tại. Vui lòng chọn mã khác.');</script>";
        } else {
            // Thực hiện thêm khách hàng nếu mã chưa tồn tại
            $insertQuery = "INSERT INTO khachhang (Makhachhang, Tenkhachhang, Diachi, Dienthoai, Email) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, 'sssss', $maKhachHang, $tenKhachHang, $diaChi, $dienThoai, $email);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Thêm khách hàng thành công!'); window.location.href='Danhsachkhachhang.php';</script>";
            } else {
                echo "<script>alert('Thêm khách hàng thất bại. Vui lòng thử lại.');</script>";
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" href="style/style2.css">
    <style>
        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #A1A1A1;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #A1A1A1;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container {
            text-align: center; /* Căn giữa nội dung trong div */
            margin-top: 20px; /* Khoảng cách phía trên */
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        
        <article style="margin-bottom: 30px;">
            <h1 style="text-align: center;">Thêm Khách Hàng Mới</h1>
            <form method="POST" action="">
                <label for="Makhachhang">Mã Khách Hàng</label>
                <input type="text" id="Makhachhang" name="Makhachhang" required>

                <label for="Tenkhachhang">Tên Khách Hàng</label>
                <input type="text" id="Tenkhachhang" name="Tenkhachhang" required>

                <label for="Diachi">Địa Chỉ</label>
                <input type="text" id="Diachi" name="Diachi" required>

                <label for="Dienthoai">Điện Thoại</label>
                <input type="tel" id="Dienthoai" name="Dienthoai" required>

                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" required>

                <div class="button-container">
                    <input type="submit" value="Thêm Khách Hàng">
                </div>
            </form>

            <div class="button-container">
                <a href="Danhsachkhachhang.php" style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Trở lại danh sách khách hàng</a>
            </div>
        </article>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
