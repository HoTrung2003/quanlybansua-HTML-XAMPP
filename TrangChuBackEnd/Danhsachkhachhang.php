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
<html>
<head>
    <meta charset="utf-8">
    <title>Danh Sách Khách Hàng</title>
    <link rel="stylesheet" href="style/style2.css">
    <style>
        h1 {
            text-align: center;
            background-color: peachpuff;
            padding: 10px;
            color: chocolate;
            border: 1px solid #A1A1A1;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #A1A1A1;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: lightblue;
        }
        .add-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php include("menuNgang.php"); ?>
      <article style="margin-bottom: 30px;">
        <h1>Danh Sách Khách Hàng</h1>
        <a href="Themkhachhang.php" class="add-btn">Thêm mới Khách Hàng</a>
        <table>
            <tr>
                <th>STT</th>
                <th>Mã Khách Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th>Email</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            <?php
            $query = "SELECT * FROM khachhang"; // Truy vấn lấy danh sách khách hàng
            $result = mysqli_query($conn, $query);
            $stt = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$stt}</td>
                    <td>{$row['Makhachhang']}</td>
                    <td>{$row['Tenkhachhang']}</td>
                    <td>{$row['Diachi']}</td>
                    <td>{$row['Dienthoai']}</td>
                    <td>{$row['Email']}</td>
                    <td><a href='Suakhachhang.php?Makhachhang={$row['Makhachhang']}'>Sửa</a></td>
                    <td><a href='Xoakhachhang.php?Makhachhang={$row['Makhachhang']}' onclick='return confirm(\"Bạn có chắc muốn xóa không?\");'>Xóa</a></td>
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
