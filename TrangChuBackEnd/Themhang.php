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
    $maHang = $_POST['Mahangsua'];
    $tenHang = $_POST['Tenhang'];
    $gioiThieu = $_POST['GioiThieu'];
    $logo = $_FILES['Logo'];

    if (!empty($maHang) && !empty($tenHang) && !empty($logo['name'])) {
        // Kiểm tra xem mã hãng sữa đã tồn tại trong cơ sở dữ liệu chưa
        $checkQuery = "SELECT * FROM hangsua WHERE Mahangsua = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, 's', $maHang);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Mã hãng sữa đã tồn tại. Vui lòng chọn mã khác.');</script>";
        } else {
            // Xử lý upload logo
            $targetDir = "images/";
            $targetFile = $targetDir . basename($logo['name']);
            if (move_uploaded_file($logo['tmp_name'], $targetFile)) {
                // Thực hiện thêm hãng sữa nếu mã chưa tồn tại
                $insertQuery = "INSERT INTO hangsua (Mahangsua, Tenhang, GioiThieu, Logo) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insertQuery);
                mysqli_stmt_bind_param($stmt, 'ssss', $maHang, $tenHang, $gioiThieu, $logo['name']);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Thêm hãng sữa thành công!'); window.location.href='Danhsachhang.php';</script>";
                } else {
                    echo "<script>alert('Thêm hãng sữa thất bại. Vui lòng thử lại.');</script>";
                }
            } else {
                echo "<script>alert('Không thể upload logo. Vui lòng thử lại.');</script>";
            }
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
    <title>Thêm hãng sữa</title>
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
        input[type="text"], textarea, input[type="file"] {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #A1A1A1;
            border-radius: 5px;
        }
        textarea {
            resize: none;
            height: 100px;
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
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        <article style="margin-bottom: 30px;">
            <h1 style="text-align: center;">Thêm hãng sữa mới</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label for="Mahangsua">Mã hãng sữa</label>
                <input type="text" id="Mahangsua" name="Mahangsua" required>

                <label for="Tenhang">Tên hãng sữa</label>
                <input type="text" id="Tenhang" name="Tenhang" required>

                <label for="GioiThieu">Giới thiệu</label>
                <textarea id="GioiThieu" name="GioiThieu" required></textarea>

                <label for="Logo">Logo</label>
                <input type="file" id="Logo" name="Logo" accept="image/*" required>

                <div class="button-container">
                    <input type="submit" value="Thêm">
                </div>
            </form>
        </article>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
