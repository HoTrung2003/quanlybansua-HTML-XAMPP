<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng về trang đăng nhập
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Lấy thông tin quản trị viên cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM admin WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

// Xử lý cập nhật quản trị viên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cập nhật username và password (nếu có thay đổi)
    $query = "UPDATE admin SET username = '$username', password = '$password' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        

        // Chuyển hướng về danh sách quản trị viên sau khi sửa thành công
        echo "<script>alert('Cập nhật thành công!'); window.location.href = 'Danhsachthanhvien.php';</script>";
    } else {
        echo "<script>alert('Cập nhật không thành công, vui lòng thử lại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Quản Trị</title>
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

        <h1>Sửa Quản Trị</h1>

        <article style="margin-bottom: 30px;">
            <form method="POST">
                <h2 style="text-align: center;">Cập Nhật Thông Tin Quản Trị</h2>

                <label for="username">Tên Đăng Nhập:</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>

                <label for="password">Mật Khẩu:</label>
                <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>

                <div class="button-container">
                    <button type="submit">Cập Nhật Quản Trị</button>
                </div>
            </form>
        </article>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
