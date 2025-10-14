<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Kiểm tra mã hãng sữa
if (isset($_GET['Mahangsua'])) {
    $mahangsua = $_GET['Mahangsua'];

    // Lấy thông tin hãng sữa
    $query = "SELECT * FROM hangsua WHERE Mahangsua = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $mahangsua);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $hangsua = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$hangsua) {
        echo "<script>
            alert('Không tìm thấy hãng sữa!');
            window.location.href = 'Danhsachhang.php';
        </script>";
        exit();
    }
}

// Xử lý khi cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mahangsua_moi = $_POST['Mahangsua']; // Mã hãng sữa mới
    $tenhang = $_POST['Tenhang'];
    $gioiThieu = $_POST['GioiThieu'];
    $logo = $_FILES['Logo'];

    // Kiểm tra xem có thay đổi logo không
    if (!empty($logo['name'])) {
        $targetDir = "images/";
        $targetFile = $targetDir . basename($logo['name']);
        if (move_uploaded_file($logo['tmp_name'], $targetFile)) {
            $newLogo = $logo['name'];
        } else {
            echo "<script>alert('Không thể cập nhật logo. Vui lòng thử lại.');</script>";
            $newLogo = $hangsua['Logo']; // Giữ logo cũ nếu không upload được
        }
    } else {
        $newLogo = $hangsua['Logo']; // Giữ logo cũ nếu không upload file mới
    }

    // Cập nhật thông tin hãng sữa
    $query = "UPDATE hangsua SET Mahangsua = ?, Tenhang = ?, GioiThieu = ?, Logo = ? WHERE Mahangsua = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $mahangsua_moi, $tenhang, $gioiThieu, $newLogo, $mahangsua);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Cập nhật hãng sữa thành công!');
            window.location.href = 'Danhsachhang.php';
        </script>";
    } else {
        echo "<script>alert('Cập nhật không thành công, hãy thử lại!');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sửa Hãng Sữa</title>
    <link rel="stylesheet" href="style/style2.css">
    <style>
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
        input[type="text"], textarea, input[type="file"] {
            width: 97%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: none;
            height: 100px;
        }
        button {
            display: inline-block;
            width: 200px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
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
            <form method="post" enctype="multipart/form-data">
                <h2 style="text-align: center;">Sửa Thông Tin Hãng Sữa</h2>

                <label for="Mahangsua">Mã Hãng Sữa:</label>
                <input type="text" name="Mahangsua" id="Mahangsua" value="<?php echo htmlspecialchars($hangsua['Mahangsua']); ?>" required>

                <label for="Tenhang">Tên Hãng Sữa:</label>
                <input type="text" name="Tenhang" id="Tenhang" value="<?php echo htmlspecialchars($hangsua['Tenhang']); ?>" required>

                <label for="GioiThieu">Giới Thiệu:</label>
                <textarea name="GioiThieu" id="GioiThieu" required><?php echo htmlspecialchars($hangsua['GioiThieu']); ?></textarea>

                <label for="Logo">Logo (Nếu cần thay đổi):</label>
                <input type="file" name="Logo" id="Logo" accept="image/*">

                <div class="button-container">
                    <button type="submit">Lưu Thay Đổi</button>
                </div>
            </form>
        </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
