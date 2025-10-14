<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

// Lấy danh sách sản phẩm từ bảng `sua`, `hangsua`, `loaisua`
$sql = "SELECT sua.Masua, sua.Tensua, sua.Hinh, sua.Dongia, sua.Trongluong, hangsua.Tenhang, loaisua.Tenloai 
        FROM sua 
        INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
        INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai 
        LIMIT 10"; // Lấy 10 sản phẩm
$result = mysqli_query($conn, $sql);

// Lưu dữ liệu sản phẩm và tạo lượt bán tháng ngẫu nhiên
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['sales_month'] = rand(10, 100); // Lượt bán tháng ngẫu nhiên
    $row['sales_total'] = rand(100, 1000); // Tổng lượt bán ngẫu nhiên
    $products[] = $row;
}

// Sắp xếp sản phẩm theo lượt bán tháng giảm dần
usort($products, function ($a, $b) {
    return $b['sales_month'] - $a['sales_month']; // Sắp xếp giảm dần
});
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xu Hướng Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            background-color: peachpuff;
            padding: 10px 0;
            font-size: 24px;
            color: chocolate;
        }

        .product-list {
            margin-top: 20px;
        }

        .product-item {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            display: flex;
            gap: 20px;
            position: relative;
        }

        .product-rank {
            position: absolute;
            top: -10px;
            left: -10px;
            background-color: orangered;
            color: white;
            font-weight: bold;
            font-size: 18px;
            padding: 5px 10px;
            border-radius: 50%;
        }

        .product-item img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            border-radius: 5px;
        }

        .product-info {
            flex: 1;
        }

        .product-info h2 {
            font-size: 18px;
            color: chocolate;
            margin: 0;
        }

        .product-info p {
            font-size: 14px;
            color: #333;
            margin: 5px 0;
        }

        .product-info .price {
            color: green;
            font-weight: bold;
        }

        .product-actions {
            text-align: right;
        }

        .product-actions a {
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

        .product-actions a:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuKhachNgang.php"); ?>

        <h1>Xu Hướng Sản Phẩm Theo Tháng</h1>

        <div class="product-list">
            <?php
            $rank = 1; // Bắt đầu từ Top 1
            foreach ($products as $product) {
            ?>
                <div class="product-item">
                    <div class="product-rank">Top <?php echo $rank++; ?></div>
                    <img src="./images/<?php echo $product['Hinh']; ?>" alt="<?php echo $product['Tensua']; ?>">
                    <div class="product-info">
                        <h2><?php echo $product['Tensua']; ?></h2>
                        <p><strong>Nhà sản xuất:</strong> <?php echo $product['Tenhang']; ?></p>
                        <p><strong>Loại sản phẩm:</strong> <?php echo $product['Tenloai']; ?></p>
                        <p><strong>Trọng lượng:</strong> <?php echo $product['Trongluong']; ?>gr</p>
                        <h3 class="price"><strong>Giá:</strong> <?php echo number_format($product['Dongia']); ?>đ</h3>
                        <p><strong>Lượt bán tháng:</strong> <?php echo $product['sales_month']; ?></p>
                        <p><strong>Đã bán:</strong> <?php echo $product['sales_total']; ?></p>
                        
                    </div>
                    <div class="product-actions">
                        <a href="ChiTietSua.php?Masua=<?php echo $product['Masua']; ?>">Chi tiết</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
