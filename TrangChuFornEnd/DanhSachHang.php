<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách hãng sữa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            background-color: peachpuff;
            padding: 10px 0;
            font-size: 24px;
            color: chocolate;
        }

        .brand-list {
            margin-top: 20px;
        }

        .brand-item {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .brand-logo {
            flex: 0 0 100px;
            height: 100px;
            margin-right: 20px;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
        }

        .brand-info {
            flex: 1;
        }

        .brand-info h2 {
            font-size: 20px;
            color: chocolate;
            margin: 0;
        }

        .brand-info p {
            font-size: 14px;
            color: #333;
            margin: 10px 0;
            line-height: 1.6;
        }

        .brand-actions {
            text-align: right;
        }

        .brand-actions a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: chocolate;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .brand-actions a:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include('header.php'); ?>
        <?php include('menuKhachNgang.php'); ?>

        <h1>Danh Sách Hãng Sữa</h1>

        <div class="brand-list">
            <?php
            // Lấy danh sách các hãng sữa
            $sql = "SELECT * FROM hangsua";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="brand-item">
                    <div class="brand-logo">
                        <img src="images/<?php echo $row['Logo']; ?>" alt="<?php echo $row['Tenhang']; ?>">
                    </div>
                    <div class="brand-info">
                        <h2><?php echo $row['Tenhang']; ?></h2>
                        <p><?php echo nl2br($row['GioiThieu']); ?></p>
                    </div>
                    <div class="brand-actions">
                        <a href="TrangHangSua.php?Mahangsua=<?php echo $row['Mahangsua']; ?>">Ghé Thăm Chúng Tôi</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
