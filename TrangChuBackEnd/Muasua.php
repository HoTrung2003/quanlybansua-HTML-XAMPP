<?php
session_start();
ob_start();
include('ketnoi.php');

if (!isset($_GET['Masua'])) {
    echo '<script>alert("Không tìm thấy sản phẩm!"); window.location="Trangchu.php";</script>';
    exit;
}

$masua = $_GET['Masua'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$query = "SELECT sua.Tensua, sua.Hinh, sua.Trongluong, sua.Dongia, hangsua.Tenhang 
          FROM sua 
          INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
          WHERE sua.Masua = '$masua'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    echo '<script>alert("Không tìm thấy sản phẩm!"); window.location="Trangchu.php";</script>';
    exit;
}
$row = mysqli_fetch_assoc($result);

// Xử lý đặt mua sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $soluong = (int)$_POST['soluong'];
    $tongtien = $soluong * $row['Dongia'];

    // Giả sử thêm đơn hàng vào giỏ hàng (hoặc xử lý theo yêu cầu cụ thể)
    echo '<script>
            alert("Bạn đã mua ' . $soluong . ' sản phẩm với tổng số tiền là ' . number_format($tongtien) . 'đ.");
            window.location="Trangchu.php";
          </script>';
    exit;
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mua Sản Phẩm</title>
    <link rel="stylesheet" href="style/style2.css" />
    <style>
        .product-container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .product-container img {
            max-width: 200px;
            margin-right: 20px;
            float: left;
        }
        .product-details {
            overflow: hidden;
        }
        .product-details h2 {
            margin: 0;
            color: darkgreen;
        }
        .product-details p {
            margin: 5px 0;
        }
        .purchase-form {
            margin-top: 20px;
        }
        .product-container img {
            max-width: 100%;
            height: auto;
            display: block;
            max-height: 160px;
            object-fit: cover; 
        }

    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php
          if(($_SESSION["lgadmin"] == "admin")) {
            include("menuNgang.php");
          }else{
            include("menuKhachNgang.php");
          }
        ?>

        <article>
            <div class="product-container">
                <img src="./images/<?php echo $row['Hinh']; ?>" alt="<?php echo $row['Tensua']; ?>" />
                <div class="product-details">
                    <h2><?php echo $row['Tensua']; ?></h2>
                    <p><strong>Hãng sản xuất:</strong> <?php echo $row['Tenhang']; ?></p>
                    <p><strong>Trọng lượng:</strong> <?php echo $row['Trongluong']; ?>gr</p>
                    <p><strong>Giá:</strong> <?php echo number_format($row['Dongia']); ?>đ</p>
                </div>
                <div class="purchase-form">
                    <form method="post" action="">
                        <label for="soluong">Nhập số lượng muốn mua:</label>
                        <input type="number" id="soluong" name="soluong" min="1" value="1" required />
                        <button type="submit">Đặt mua</button>
                    </form>
                </div>
            </div>
        </article>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
