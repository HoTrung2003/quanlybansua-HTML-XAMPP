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
    $tieude = $_POST['Tieude'];
    $noidung = $_POST['Noidung'];
    $trangthai = isset($_POST['Trangthai']) ? 1 : 0; // Trạng thái mặc định là Ẩn (0)

    if (!empty($tieude) && !empty($noidung)) {
        // Thực hiện thêm tin tức vào cơ sở dữ liệu
        $insertQuery = "INSERT INTO tintuc (Tieude, Noidung, Trangthai) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, 'ssi', $tieude, $noidung, $trangthai);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Thêm tin tức thành công!'); window.location.href='Danhsachtintuc.php';</script>";
        } else {
            echo "<script>alert('Thêm tin tức thất bại. Vui lòng thử lại.');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thêm tin tức</title>
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
        input[type="text"], textarea {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #A1A1A1;
            border-radius: 5px;
        }
        textarea {
            height: 150px;
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
        button {
            display: inline-block; /* Hiển thị nút dưới dạng khối nội tuyến */
            width: auto; /* Tự động điều chỉnh kích thước */
        }
    </style>
</head>
<body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php include("menuNgang.php"); ?>
      <article style="margin-bottom: 30px;">
        <h1 style="text-align: center;">Thêm tin tức mới</h1>
        <form method="POST" action="">
            <label for="Tieude">Tiêu đề tin tức</label>
            <input type="text" id="Tieude" name="Tieude" required>

            <label for="Noidung">Nội dung tin tức</label>
            <textarea id="Noidung" name="Noidung" required></textarea>
            
            <label for="Trangthai">Trạng thái</label>
            <input type="checkbox" id="Trangthai" name="Trangthai"> Hiển thị

            <div class="button-container">
                <input type="submit" value="Thêm">
            </div>
        </form>
    </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
