<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Kiểm tra nếu có mã hóa đơn trong URL
if (isset($_GET['SoHieuHD'])) {
    $soHieuHD = $_GET['SoHieuHD'];
} else {
    echo "Không tìm thấy mã hóa đơn.";
    exit();
}

// Kiểm tra xem có dữ liệu chi tiết hóa đơn trong bảng `chitiethoadon` hay không
$query = "SELECT * FROM chitiethoadon WHERE SoHieuHD = '$soHieuHD'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    $message = "Không có thông tin chi tiết đơn hàng này. Vui lòng thêm thông tin.";
} else {
    $message = "Thông tin chi tiết đơn hàng. Bạn có thể sửa các thông tin bên dưới.";
}

// Truy vấn để lấy dữ liệu Mã Sản Phẩm từ bảng `sua`
$productsQuery = "SELECT Masua, TenSua FROM sua";
$productsResult = mysqli_query($conn, $productsQuery);

// Xử lý dữ liệu từ form nếu có
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Lấy thông tin từ form
    $masp = mysqli_real_escape_string($conn, $_POST['Masua']);
    $soluong = (int)$_POST['SoLuong'];
    $dongia = (float)$_POST['Dongia'];

    // Kiểm tra xem có phải sửa hay thêm
    if (mysqli_num_rows($result) > 0) {
        // Cập nhật thông tin chi tiết đơn hàng
        $updateQuery = "UPDATE chitiethoadon SET Masua = '$masp', SoLuong = $soluong, Dongia = $dongia WHERE SoHieuHD = '$soHieuHD'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Cập nhật thành công!'); window.location = 'chitietDonHang.php?SoHieuHD=$soHieuHD';</script>";
        } else {
            echo "Lỗi khi cập nhật: " . mysqli_error($conn);
        }
    } else {
        // Thêm mới thông tin chi tiết đơn hàng
        $insertQuery = "INSERT INTO chitiethoadon (SoHieuHD, Masua, SoLuong, Dongia) VALUES ('$soHieuHD', '$masp', $soluong, $dongia)";
        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Thêm thành công!'); window.location = 'chitietDonHang.php?SoHieuHD=$soHieuHD';</script>";
        } else {
            echo "Lỗi khi thêm: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="style/style2.css">
    <style type="text/css">
        /* Chỉnh sửa style cho bảng */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table th, table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 14px;
}

table th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #333;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

table td input, table td select {
    width: 80%;
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

button.add-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.add-btn:hover {
    background-color: #45a049;
}

/* Style cho thông báo và các thành phần khác */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.back-btn {
    background-color: #ccc;
    color: #000;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
}

.back-btn:hover {
    background-color: #999;
}

    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        <article style="margin-bottom: 30px;">
            <h1>Chi Tiết Đơn Hàng - <?php echo $soHieuHD; ?></h1>
            <a href="danhSachDonHang.php" class="back-btn">Quay lại danh sách đơn hàng</a>
            
            <p><?php echo $message; ?></p>

            <form action="chitietDonHang.php?SoHieuHD=<?php echo $soHieuHD; ?>" method="POST">
                <table>
                    <tr>
                        <th>Mã Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Đơn Giá</th>
                    </tr>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        // Hiển thị các chi tiết đã có trong bảng `chitiethoadon`
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>
                                    <select name='Masua' required>
                                        <option value=''>Chọn sản phẩm</option>";
                                        // Hiển thị các mã sản phẩm từ bảng `sua`
                                        while ($product = mysqli_fetch_assoc($productsResult)) {
                                            $selected = ($row['Masua'] == $product['Masua']) ? 'selected' : '';
                                            echo "<option value='{$product['Masua']}' $selected>{$product['Masua']} - {$product['TenSua']}</option>";
                                        }
                            echo "</select>
                                </td>
                                <td><input type='number' name='SoLuong' value='{$row['SoLuong']}' required></td>
                                <td><input type='text' name='Dongia' value='{$row['Dongia']}' required></td>
                            </tr>";
                        }
                    } else {
                        // Nếu không có dữ liệu, hiển thị form trống để thêm dữ liệu
                        echo "<tr>
                            <td>
                                <select name='Masua' required>
                                    <option value=''>Chọn sản phẩm</option>";
                                    // Hiển thị các mã sản phẩm từ bảng `sua`
                                    while ($product = mysqli_fetch_assoc($productsResult)) {
                                        echo "<option value='{$product['Masua']}'>{$product['Masua']} - {$product['TenSua']}</option>";
                                    }
                            echo "</select>
                            </td>
                            <td><input type='number' name='SoLuong' placeholder='Nhập số lượng' required></td>
                            <td><input type='text' name='Dongia' placeholder='Nhập đơn giá' required></td>
                        </tr>";
                    }
                    ?>
                </table>
                <button type="submit" name="submit" class="add-btn">Lưu thông tin</button>
            </form>
        </article>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
