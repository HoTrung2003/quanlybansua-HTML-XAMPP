<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $Makhachhang = $_POST['Makhachhang'];
    $Ngaylap = $_POST['Ngaylap'];

    // Chèn dữ liệu vào bảng hoadon
    $query = "INSERT INTO hoadon (Makhachhang, Ngaylap) VALUES ('$Makhachhang', '$Ngaylap')";
    
    if (mysqli_query($conn, $query)) {
        // Nếu chèn thành công, chuyển về trang danh sách đơn hàng
        header("Location: danhSachDonHang.php");
        exit();
    } else {
        $error = "Đã xảy ra lỗi khi thêm đơn hàng.";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Đơn Hàng</title>
    <link rel="stylesheet" href="style/style2.css">
    <style>
        /* CSS tùy chỉnh cho form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
                        margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            background-color: #ffcc99;
            padding: 10px;
            color: #333;
            border-bottom: 2px solid #ccc;
        }
        .form-container {
            width: 60%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }
        .success {
            color: green;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        <article style="margin-bottom: 30px;">
            <h1>Thêm Đơn Hàng Mới</h1>
            
            <!-- Hiển thị lỗi hoặc thông báo thành công -->
            <?php 
            if (isset($error)) { 
                echo "<p class='error'>$error</p>"; 
            } elseif (isset($success)) {
                echo "<p class='success'>$success</p>";
            }
            ?>

            <div class="form-container">
                <form action="themDonHang.php" method="POST">
                    <div class="form-group">
                        <label for="Makhachhang">Mã Khách Hàng:</label>
                        <select name="Makhachhang" id="Makhachhang" required>
                            <option value="">Chọn mã khách hàng</option>
                            <?php
                            // Lấy danh sách mã khách hàng từ bảng khachhang
                            $query = "SELECT Makhachhang, Tenkhachhang FROM khachhang";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['Makhachhang']}'>{$row['Makhachhang']} - {$row['Tenkhachhang']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Ngaylap">Ngày Lập:</label>
                        <input type="date" id="Ngaylap" name="Ngaylap" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <input type="submit" value="Thêm Đơn Hàng">
                    </div>
                </form>
            </div>
        </article>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
