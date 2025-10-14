<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Đơn Hàng</title>
    <link rel="stylesheet" href="style/style2.css">
    <style>
        body {
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            background-color: #ffcc99;
            padding: 10px;
            color: #333;
            border-bottom: 2px solid #ccc;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #3e8e41;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .add-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }
        .add-btn:hover {
            background-color: #218838;
        }
        .action-links a {
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #f0f0f0;
        }
        .action-links a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        <article style="margin-bottom: 30px;">
            <h1>Danh sách Đơn Hàng</h1>
            <a href="themDonHang.php" class="add-btn">Thêm mới đơn hàng</a>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Số Hóa Đơn</th>
                    <th>Mã Khách Hàng</th>
                    <th>Ngày Mua</th>
                    <th>Chi Tiết</th>
                    <th>Hành Động</th>
                </tr>
                <?php
                // Lấy thông tin hóa đơn
                $query = "SELECT * FROM hoadon";
                $result = mysqli_query($conn, $query);
                $stt = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$stt}</td>
                        <td>{$row['SoHieuHD']}</td>
                        <td>{$row['Makhachhang']}</td>
                        <td>{$row['Ngaylap']}</td>
                        <td><a href='chitietDonHang.php?SoHieuHD={$row['SoHieuHD']}'>Xem Chi Tiết</a></td>
                        <td class='action-links'>
                            <a href='suaDonHang.php?SoHieuHD={$row['SoHieuHD']}'>Sửa</a> |
                            <a href='xoaDonHang.php?SoHieuHD={$row['SoHieuHD']}' onclick='return confirm(\"Bạn có chắc muốn xóa không?\");'>Xóa</a>
                        </td>
                    </tr>";
                    $stt++;
                }
                ?>
            </table>
        </article>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
