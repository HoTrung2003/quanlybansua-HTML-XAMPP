<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối cơ sở dữ liệu
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách sản phẩm Sữa Bột</title>
    <?php
    // Kiểm tra quyền truy cập
    if (!isset($_SESSION["lgadmin"])) {
        header("location: Dangnhap_admin.php");
        exit();
    }
    ?>
    <link rel="stylesheet" href="style/style2.css" />
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            background-color: peachpuff;
            padding: 10px 0;
            margin-bottom: 20px;
            font-size: 24px;
            color: chocolate;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 0 auto;
            width: 80%;
        }

        .product-item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            background-color: #f9f9f9;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .product-item img {
            max-width: 100%;
            height: 150px;
            object-fit: contain;
        }

        .product-item h2 {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .product-item p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .product-item a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: chocolate;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .product-item a:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuKhachNgang.php"); ?>
        <div>
            <img style="width: 1200px;height: 400px;" src="images/bannerSuaTuoi.png" alt="Banner 1">
        </div>
        <h1>Danh Sách Sản Phẩm Sữa Tươi</h1>

        <div class="product-grid">
            <?php
            $db = "SELECT sua.Masua as masua, sua.Hinh as hinh, sua.Tensua as Tensua, sua.Trongluong as trongluong, sua.Dongia as dongia, 
                    hangsua.Tenhang as TenHang, loaisua.Tenloai as tenloai 
                    FROM sua 
                    INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
                    INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai 
                    WHERE loaisua.Tenloai = 'Sữa tươi'";

            $result = mysqli_query($conn, $db);

            if (mysqli_num_rows($result) == 0) {
                echo "<p style='text-align: center;'>Không có sản phẩm sữa tươi nào</p>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="product-item">
                        <img src="./images/<?php echo $row['hinh'] ?>" alt="<?php echo $row['Tensua'] ?>" />
                        <h2><?php echo $row['Tensua'] ?></h2>
                        <p>Nhà sản xuất: <?php echo $row['TenHang'] ?></p>
                        <p><?php echo $row['tenloai']; ?> - <?php echo $row['trongluong']; ?>gr</p>
                        <p style="color: red;">Giá: <?php echo number_format($row['dongia']); ?>đ</p>
                        <a href="ChiTietSua.php?Masua=<?php echo $row['masua']; ?>">Xem chi tiết</a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
