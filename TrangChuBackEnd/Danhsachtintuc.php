<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Kiểm tra xem người dùng có phải là admin không
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}

// Lấy danh sách tin tức từ cơ sở dữ liệu
$query = "SELECT * FROM tintuc";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách tin tức</title>
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
        <h1>Danh sách tin tức</h1>
        <a href="Themtintuc.php" class="add-btn">Thêm mới tin tức</a>
        <table>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            <?php
            $stt = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$stt}</td>
                    <td>{$row['Tieude']}</td>
                    <td>" . substr($row['Noidung'], 0, 50) . "...</td>
                    <td>" . ($row['Trangthai'] == 1 ? 'Hiển thị' : 'Ẩn') . "</td>
                    <td><a href='Suatintuc.php?ID={$row['Matintuc']}'>Sửa</a></td>
                    <td><a href='Xoatintuc.php?ID={$row['Matintuc']}' onclick='return confirm(\"Bạn có chắc muốn xóa không?\");'>Xóa</a></td>
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
