<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Lấy thông tin tin tức từ Matintuc (ID của tin tức)
if (isset($_GET['ID'])) {
    $id = $_GET['ID']; // Lấy ID từ URL
    $query = "SELECT * FROM tintuc WHERE Matintuc = ?"; // Sử dụng Matintuc thay vì ID
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id); // Bind tham số
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $tinTuc = mysqli_fetch_assoc($result);

    // Kiểm tra xem tin tức có tồn tại
    if (!$tinTuc) {
        echo "Tin tức không tồn tại!";
        exit();
    }
}

// Cập nhật tin tức nếu có form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tieude = $_POST['Tieude'];
    $noidung = $_POST['Noidung'];
    $trangthai = isset($_POST['Trangthai']) ? 1 : 0; // Trạng thái mặc định là Ẩn (0)

    if (!empty($tieude) && !empty($noidung)) {
        // Cập nhật tin tức vào cơ sở dữ liệu
        $updateQuery = "UPDATE tintuc SET Tieude = ?, Noidung = ?, Trangthai = ? WHERE Matintuc = ?"; // Cập nhật theo Matintuc
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'ssii', $tieude, $noidung, $trangthai, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Cập nhật tin tức thành công!'); window.location.href='Danhsachtintuc.php';</script>";
        } else {
            echo "<script>alert('Cập nhật tin tức thất bại. Vui lòng thử lại.');</script>";
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
    <title>Sửa tin tức</title>
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
    </style>
</head>
<body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php include("menuNgang.php"); ?>
      <article style="margin-bottom: 30px;">
        <h1 style="text-align: center;">Sửa tin tức</h1>
        <form method="POST" action="">
            <label for="Tieude">Tiêu đề tin tức</label>
            <input type="text" id="Tieude" name="Tieude" value="<?php echo $tinTuc['Tieude']; ?>" required>

            <label for="Noidung">Nội dung tin tức</label>
            <textarea id="Noidung" name="Noidung" required><?php echo $tinTuc['Noidung']; ?></textarea>
            
            <label for="Trangthai">Trạng thái</label>
            <input type="checkbox" id="Trangthai" name="Trangthai" <?php echo $tinTuc['Trangthai'] == 1 ? 'checked' : ''; ?>> Hiển thị

            <div class="button-container">
                <input type="submit" value="Cập nhật">
            </div>
        </form>
    </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
