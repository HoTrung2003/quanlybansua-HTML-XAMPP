<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối cơ sở dữ liệu

if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách Loại Sữa</title>
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
        td img {
            width: 80px;
            height: auto;
            object-fit: contain;
            border-radius: 5px;
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
        .description {
            text-align: left;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php
      if ($_SESSION["lgadmin"] == "admin") {
          include("menuNgang.php");
      } else {
          include("menuKhachNgang.php");
      }
      ?>
      <article style="margin-bottom: 30px;">
        <h1>Danh sách Loại Sữa</h1>
        <?php if ($_SESSION["lgadmin"] == "admin") { ?>
            <a href="Themloai.php" class="add-btn">Thêm mới Loại Sữa</a>
        <?php } ?>

        <table>
            <tr>
                <th>STT</th>
                <th>Mã Loại Sữa</th>
                <th>Tên Loại Sữa</th>
                <th>Hình Ảnh</th>
                <th>Giới Thiệu</th>
                <?php if ($_SESSION["lgadmin"] == "admin") { ?>
                    <th>Sửa</th>
                    <th>Xóa</th>
                <?php } ?>
            </tr>
            <?php
            $query = "SELECT * FROM loaisua"; // Truy vấn danh sách loại sữa
            $result = mysqli_query($conn, $query);
            $stt = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$stt}</td>
                    <td>{$row['Maloai']}</td>
                    <td>{$row['Tenloai']}</td>
                    <td><img src='images/{$row['Hinh']}' alt='{$row['Tenloai']}'></td>
                    <td class='description'>".nl2br($row['GioiThieu'])."</td>";
                
                // Hiển thị nút Sửa và Xóa nếu là admin
                if ($_SESSION["lgadmin"] == "admin") {
                    echo "
                    <td><a href='Sualoai.php?Maloai={$row['Maloai']}'>Sửa</a></td>
                    <td><a href='Xoaloai.php?Maloai={$row['Maloai']}' onclick='return confirm(\"Bạn có chắc muốn xóa không?\");'>Xóa</a></td>";
                }
                echo "</tr>";
                $stt++;
            }
            ?>
        </table>
      </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
