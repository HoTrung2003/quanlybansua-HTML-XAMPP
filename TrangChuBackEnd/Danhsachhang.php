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
    <title>Danh sách hãng sữa</title>
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
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #A1A1A1;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: lightblue;
        }
        img {
            max-width: 80px;
            height: auto;
            display: block;
            margin: 0 auto;
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
        .intro {
            text-align: left;
            font-size: 14px;
            color: #555;
            line-height: 1.5;
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
            <h1>Danh sách hãng sữa</h1>
            <?php
            if (isset($_SESSION["lgadmin"]) && $_SESSION["lgadmin"] == "admin") {
            ?>
                <a href="Themhang.php" class="add-btn">Thêm mới hãng sữa</a>
            <?php
            }
            ?>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Logo</th>
                    <th>Mã hãng sữa</th>
                    <th>Tên hãng sữa</th>
                    <th>Giới thiệu</th>
                    <?php
                    if (isset($_SESSION["lgadmin"]) && $_SESSION["lgadmin"] == "admin") {
                    ?>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    <?php
                    }
                    ?>
                </tr>
                <?php
                $query = "SELECT * FROM hangsua";
                $result = mysqli_query($conn, $query);
                $stt = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$stt}</td>
                        <td><img src='./images/{$row['Logo']}' alt='Logo {$row['Tenhang']}'></td>
                        <td>{$row['Mahangsua']}</td>
                        <td>{$row['Tenhang']}</td>
                        <td class='intro'>" . nl2br($row['GioiThieu']) . "</td>";
                        
                    if (isset($_SESSION["lgadmin"]) && $_SESSION["lgadmin"] == "admin") {
                        echo "
                        <td><a href='Suahang.php?Mahangsua={$row['Mahangsua']}'>Sửa</a></td>
                        <td><a href='Xoahang.php?Mahangsua={$row['Mahangsua']}' onclick='return confirm(\"Bạn có chắc muốn xóa không?\");'>Xóa</a></td>";
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
