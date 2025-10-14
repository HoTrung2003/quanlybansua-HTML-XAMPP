<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

if (isset($_GET['Makhachhang'])) {
    $makhachhang = $_GET['Makhachhang'];
    $query = "SELECT * FROM khachhang WHERE Makhachhang = '$makhachhang'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tenkhachhang = $_POST['Tenkhachhang'];
        $diachi = $_POST['Diachi'];
        $dienthoai = $_POST['Dienthoai'];
        $email = $_POST['Email'];

        $query = "UPDATE khachhang SET Tenkhachhang = '$tenkhachhang', Diachi = '$diachi', Dienthoai = '$dienthoai', Email = '$email' WHERE Makhachhang = '$makhachhang'";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Cập nhật khách hàng thành công!'); window.location.href = 'Danhsachkhachhang.php';</script>";
        } else {
            echo "<script>alert('Cập nhật không thành công, vui lòng thử lại!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Sửa Khách Hàng</title>
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
            text-align: center;
            margin-top: 20px;
        }
        button {
            display: inline-block;
            width: auto;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        
        <article style="margin-bottom: 30px;">
            <h1 style="text-align: center;">Sửa Khách Hàng</h1>
            <form method="POST">
                <label for="Makhachhang">Mã Khách Hàng:</label>
                <input type="text" name="Makhachhang" id="Makhachhang" value="<?php echo $row['Makhachhang']; ?>" readonly>
                
                <label for="Tenkhachhang">Tên Khách Hàng:</label>
                <input type="text" name="Tenkhachhang" id="Tenkhachhang" value="<?php echo $row['Tenkhachhang']; ?>" required>
                
                <label for="Diachi">Địa Chỉ:</label>
                <input type="text" name="Diachi" id="Diachi" value="<?php echo $row['Diachi']; ?>" required>
                
                <label for="Dienthoai">Điện Thoại:</label>
                <input type="tel" name="Dienthoai" id="Dienthoai" value="<?php echo $row['Dienthoai']; ?>" required>
                
                <label for="Email">Email:</label>
                <input type="email" name="Email" id="Email" value="<?php echo $row['Email']; ?>" required>
                
                <div class="button-container">
                    <button type="submit">Cập Nhật</button>
                </div>
            </form>
        </article>

        <div class="button-container">
            <a href="Danhsachkhachhang.php" style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Trở lại danh sách khách hàng</a>
        </div>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
