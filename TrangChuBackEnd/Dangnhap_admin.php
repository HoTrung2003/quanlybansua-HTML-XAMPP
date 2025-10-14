<?php
session_start();
include("ketnoi.php"); // Kết nối với cơ sở dữ liệu

// Kiểm tra khi người dùng gửi biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Lấy thông tin tài khoản admin từ cơ sở dữ liệu
    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    // Kiểm tra tên đăng nhập
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        if ( $password === $row['password']) {
            $_SESSION['lgadmin'] = $username; // Đặt biến session
            header("Location: DanhsachSua.php"); // Chuyển hướng đến trang quản lý
            exit();
        } else {
            $error = "Sai mật khẩu.";
        }
    } else {
        $error = "Tên đăng nhập không tồn tại.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body style="background-color: #d9d9d9;">
    <div class="header" style="text-align:center;padding-bottom:50px ;">
        <div class="logo">
          <img src="images/header.jpg" alt="Logo" style="width:1200px; height:auto;">
        </div>
    </div>
    <div class="khung" style="background-color:#ffffff ;border-radius: 10px;">
        <h2>Đăng nhập Admin</h2>
        <form method="post" action="Dangnhap_admin.php">
            <div class="form-group">
               <label class="label" for="username">Tên đăng nhập:</label>
               <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label class="label" for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button">Đăng nhập</button>
                <button type="Reset" class="button">Reset</button>
            </div>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        </form>
    </div>   
</body>
</html>