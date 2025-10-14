<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối cơ sở dữ liệu

// Kiểm tra quyền truy cập
if (!isset($_SESSION["lgadmin"]) || empty($_SESSION["lgadmin"])) {
    header("Location: Dangnhap_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách loại sữa</title>
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

        .category-list {
            margin-top: 20px;
        }

        .category-item {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .category-logo {
            flex: 0 0 100px;
            height: 100px;
            margin-right: 20px;
        }

        .category-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
        }

        .category-info {
            flex: 1;
        }

        .category-info h2 {
            font-size: 20px;
            color: chocolate;
            margin: 0;
        }

        .category-info p {
            font-size: 14px;
            color: #333;
            margin: 10px 0;
            line-height: 1.6;
        }

        .category-actions {
            text-align: right;
        }

        .category-actions a {
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

        .category-actions a:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include('header.php'); ?>
        <?php include('menuKhachNgang.php'); ?>

        <h1>Danh Sách Loại Sữa</h1>

        <div class="category-list">
            <?php
            // Lấy danh sách các loại sữa từ bảng loaisua
            $sql = "SELECT * FROM loaisua";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="category-item">
                    <div class="category-logo">
                        <img src="images/<?php echo $row['Hinh']; ?>" alt="<?php echo $row['Tenloai']; ?>">
                    </div>
                    <div class="category-info">
                        <h2><?php echo $row['Tenloai']; ?></h2>
                        <p><?php echo nl2br($row['GioiThieu']); ?></p>
                    </div>
                    <div class="category-actions">
                        <a href="TrangLoaiSua.php?Maloai=<?php echo $row['Maloai']; ?>">Khám Phá Ngay</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
