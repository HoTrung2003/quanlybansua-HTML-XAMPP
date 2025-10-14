<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Xử lý thêm loại sữa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maloai = $_POST['Maloai'];  // Lấy mã loại sữa từ form
    $tenloai = $_POST['Tenloai']; // Lấy tên loại sữa từ form
    $gioithieu = $_POST['GioiThieu'] ?? ''; // Lấy phần giới thiệu (nếu có, mặc định là rỗng)
    $tenfile = '';

    // Kiểm tra nếu người dùng đã chọn file
    if (!empty($_FILES['Hinh']['name'])) {
        $tenfile = basename($_FILES['Hinh']['name']); // Lấy tên file ảnh
    }

    // Kiểm tra nếu người dùng nhập đầy đủ thông tin
    if (!empty($maloai) && !empty($tenloai) && !empty($tenfile)) {
        // Thêm loại sữa mới vào cơ sở dữ liệu
        $query = "INSERT INTO loaisua (Maloai, Tenloai, GioiThieu, Hinh) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $maloai, $tenloai, $gioithieu, $tenfile);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('Thêm loại sữa thành công!');
                window.location.href = 'Danhsachloai.php';
            </script>";
        } else {
            echo "<script>alert('Thêm loại sữa không thành công, hãy thử lại!');</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin và chọn ảnh!');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thêm Loại Sữa</title>
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
        input[type="text"] {
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
        }
        button:hover {
            background-color: #218838;
        }
        .button-container {
            text-align: center; /* Căn giữa nội dung trong div */
            margin-top: 20px; /* Khoảng cách phía trên */
        }
        button {
            display: inline-block; /* Hiển thị nút dưới dạng khối nội tuyến */
            width: auto; /* Tự động điều chỉnh kích thước */
        }
        input[type="text"], textarea {
            width: 80%; 
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
            resize: vertical; 
        }

    </style>
</head>
<body>
    <div class="container">
       <?php include("header.php"); ?>
       <?php include("menuNgang.php"); ?>
        <article style="margin-bottom: 30px;">
            <form method="post" enctype="multipart/form-data">
                <h2 style="text-align: center;">Thêm Loại Sữa Mới</h2>
                <label for="Maloai">Mã Loại Sữa:</label>
                <input type="text" name="Maloai" id="Maloai" required>
                
                <label for="Tenloai">Tên Loại Sữa:</label>
                <input type="text" name="Tenloai" id="Tenloai" required>
                
                <label for="GioiThieu">Giới Thiệu:</label>
                <textarea name="GioiThieu" id="GioiThieu" rows="5"></textarea>
                
                <label for="Hinh">Hình Ảnh:</label>
                <input type="file" name="Hinh" id="Hinh" accept="image/*" required>
                
                <div class="button-container">
                    <button type="submit">Thêm Loại Sữa</button>
                </div>
            </form>

        </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
