<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Lấy mã hóa đơn từ URL
$soHieuHD = $_GET['SoHieuHD'];

// Lấy dữ liệu của hóa đơn cần sửa
$query = "SELECT * FROM hoadon WHERE SoHieuHD = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $soHieuHD);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $Makhachhang = $_POST['Makhachhang'];
    $ngayMua = $_POST['Ngaylap'];

    // Cập nhật dữ liệu hóa đơn
    $updateQuery = "UPDATE hoadon SET Makhachhang = ?, Ngaylap = ? WHERE SoHieuHD = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'ssi', $Makhachhang, $ngayMua, $soHieuHD);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Sửa đơn hàng thành công!'); window.location.href='danhSachDonHang.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi sửa đơn hàng!');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đơn Hàng</title>
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
        input[type="text"], input[type="date"] {
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
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        <article>
            <h1 style="text-align:center;">Sửa Đơn Hàng</h1>
            <form method="POST" action="">
                <div>
                    <label for="Makhachhang">Mã Khách Hàng:</label>
                    <input type="text" name="Makhachhang" value="<?php echo htmlspecialchars($row['Makhachhang']); ?>" required>
                </div>
                <div>
                    <label for="Ngaylap">Ngày Mua:</label>
                    <input type="date" name="Ngaylap" value="<?php echo htmlspecialchars($row['Ngaylap']); ?>" required>
                </div>
                <button type="submit">Cập Nhật Đơn Hàng</button>
            </form>
        </article>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
