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
    <meta charset="utf-8">
    <title>Danh sách Quản Trị</title>
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
        .edit-btn, .delete-btn {
            color: #007bff;
            text-decoration: none;
        }
        .delete-btn {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuNgang.php"); ?>
        <article style="margin-bottom: 30px;">
            <h1>Danh sách Quản Trị</h1>
            <a href="Dangkythanhvien.php" class="add-btn">Đăng Ký Thành Viên</a>
            <table>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Mật khẩu</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                <?php
                $query = "SELECT * FROM admin";
                $result = mysqli_query($conn, $query);
                $stt = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    // Luôn hiển thị mật khẩu dưới dạng dấu sao
                    $passwordDisplay = '**********';

                    echo "<tr>
                        <td>{$stt}</td>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$passwordDisplay}</td>
                        <td><a href='Suaquantri.php?id={$row['id']}' class='edit-btn'>Sửa</a></td>
                        <td><a href='Xoaquantrivien.php?id={$row['id']}' class='delete-btn' onclick='return confirm(\"Bạn có chắc muốn xóa không?\");'>Xóa</a></td>
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
