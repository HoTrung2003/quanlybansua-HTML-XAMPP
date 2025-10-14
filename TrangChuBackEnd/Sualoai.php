<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra quyền truy cập
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Lấy thông tin loại sữa từ bảng loaisua
if (isset($_GET['Maloai'])) {
    $maloai = $_GET['Maloai'];
    
    // Lấy thông tin loại sữa cần sửa
    $query = "SELECT * FROM loaisua WHERE Maloai = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $maloai);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // Kiểm tra xem có dữ liệu hay không
    if (!$row) {
        echo "<script>alert('Loại sữa không tồn tại.'); window.location.href = 'Danhsachloai.php';</script>";
        exit();
    }

    // Gán dữ liệu ban đầu
    $tenloai = $row['Tenloai'];
    $gioithieu = $row['GioiThieu'];
    $hinh = $row['Hinh'];

    // Xử lý cập nhật thông tin loại sữa
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $maloai_moi = $_POST['Maloai'];  // Lấy mã loại sữa từ form
        $tenloai_moi = $_POST['Tenloai']; // Lấy tên loại sữa từ form
        $gioithieu_moi = $_POST['GioiThieu'] ?? ''; // Lấy giới thiệu mới
        $tenfile_moi = $hinh; // Giữ nguyên hình ảnh cũ mặc định

        // Kiểm tra nếu có file ảnh mới được upload
        if (!empty($_FILES['Hinh']['name'])) {
            $tenfile_moi = basename($_FILES['Hinh']['name']); // Lấy tên file ảnh
        }

        // Kiểm tra nếu người dùng sửa mã loại sữa
        if ($maloai != $maloai_moi) {
            // Kiểm tra mã loại sữa mới có tồn tại không
            $check_query = "SELECT * FROM loaisua WHERE Maloai = ?";
            $check_stmt = mysqli_prepare($conn, $check_query);
            mysqli_stmt_bind_param($check_stmt, 's', $maloai_moi);
            mysqli_stmt_execute($check_stmt);
            $check_result = mysqli_stmt_get_result($check_stmt);
            if (mysqli_num_rows($check_result) > 0) {
                echo "<script>alert('Mã loại sữa mới đã tồn tại.');</script>";
                exit();
            }
            mysqli_stmt_close($check_stmt);
        }

        // Cập nhật thông tin loại sữa
        $update_query = "UPDATE loaisua SET Maloai = ?, Tenloai = ?, GioiThieu = ?, Hinh = ? WHERE Maloai = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'sssss', $maloai_moi, $tenloai_moi, $gioithieu_moi, $tenfile_moi, $maloai);
        
        if (mysqli_stmt_execute($update_stmt)) {
            echo "<script>alert('Cập nhật loại sữa thành công!'); window.location.href = 'Danhsachloai.php';</script>";
        } else {
            echo "<script>alert('Cập nhật thất bại.');</script>";
        }

        mysqli_stmt_close($update_stmt);
    }
} else {
    echo "<script>alert('Không tìm thấy mã loại sữa.'); window.location.href = 'Danhsachloai.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sửa Loại Sữa</title>
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
        input[type="text"], textarea {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="file"] {
            margin-bottom: 10px;
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
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        <article style="margin-bottom: 30px;">
            <form method="post" enctype="multipart/form-data">
                <h2 style="text-align: center;">Sửa Loại Sữa</h2>
                <label for="Maloai">Mã Loại Sữa:</label>
                <input type="text" name="Maloai" id="Maloai" value="<?php echo htmlspecialchars($maloai); ?>" required>
                
                <label for="Tenloai">Tên Loại Sữa:</label>
                <input type="text" name="Tenloai" id="Tenloai" value="<?php echo htmlspecialchars($tenloai); ?>" required>
                
                <label for="GioiThieu">Giới Thiệu:</label>
                <textarea name="GioiThieu" id="GioiThieu" rows="4"><?php echo htmlspecialchars($gioithieu); ?></textarea>
                
                <label for="Hinh">Hình Ảnh:</label>
                <input type="file" name="Hinh" id="Hinh" accept="image/*">
                <p>Ảnh hiện tại: <?php echo htmlspecialchars($hinh); ?></p>
                
                <button type="submit">Cập nhật Loại Sữa</button>
            </form>
        </article>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
