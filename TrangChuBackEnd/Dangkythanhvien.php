<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng có phải là admin hay không
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Kiểm tra dữ liệu đầu vào
    if (empty($username) || empty($password)) {
        echo "<script>alert('Tên đăng nhập và mật khẩu không được để trống!');</script>";
    } else {
        // Thêm dữ liệu vào cơ sở dữ liệu mà không mã hóa mật khẩu
        $query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Đăng ký thành viên thành công!'); window.location.href = 'Danhsachthanhvien.php';</script>";
        } else {
            echo "<script>alert('Đăng ký không thành công, vui lòng thử lại!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Thành Viên</title>
    <link rel="stylesheet" href="style/style2.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            background-color: peachpuff;
            padding: 10px;
            color: chocolate;
            border: 1px solid #A1A1A1;
        }
        form {
            width: 50%;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: block;
            width: 200px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #218838;
        }
        .button-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>

        <h1>Đăng Ký Thành Viên</h1>

        <article style="margin-bottom: 30px;">
            <form method="POST">
                <h2 style="text-align: center;">Đăng Ký Thành Viên Mới</h2>

                <label for="username">Tên Đăng Nhập:</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Mật Khẩu:</label>
                <input type="password" name="password" id="password" required>

                <div class="button-container">
                    <button type="submit">Đăng Ký</button>
                </div>
            </form>
        </article>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
