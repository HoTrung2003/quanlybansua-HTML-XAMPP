<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu

if (!isset($_GET['Masua'])) {
    die("Không tìm thấy sản phẩm.");
}

$masua = $_GET['Masua'];

$sql = "SELECT sua.*, hangsua.Tenhang, loaisua.Tenloai 
        FROM sua 
        INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
        INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai
        WHERE sua.Masua = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $masua);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Sản phẩm không tồn tại.");
}

// Xử lý thêm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $soluong = intval($_POST['soluong']);
    if ($soluong < 1) {
        echo "<script>alert('Số lượng phải lớn hơn 0');</script>";
    } else {
        $dongia = $product['Dongia'];
        $tonggia = $soluong * $dongia;
        $hinh = $product['Hinh'];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $stmt = $conn->prepare("SELECT * FROM giohang WHERE masua = ?");
        $stmt->bind_param("s", $product['Masua']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Nếu đã tồn tại, cập nhật số lượng và tổng giá
            $stmt = $conn->prepare("UPDATE giohang SET soluong = soluong + ?, tonggia = tonggia + ? WHERE masua = ?");
            $stmt->bind_param("ids", $soluong, $tonggia, $product['Masua']);
        } else {
            // Nếu chưa tồn tại, thêm mới
            $stmt = $conn->prepare("INSERT INTO giohang (masua, tensua, soluong, dongia, tonggia, hinh) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssidds", $product['Masua'], $product['Tensua'], $soluong, $dongia, $tonggia, $hinh);
        }

        if ($stmt->execute()) {
            echo "<script>alert('Thêm vào giỏ hàng thành công');</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm vào giỏ hàng');</script>";
        }
    }
}
?>
<?php
if ($_SESSION["lgadmin"] == null || $_SESSION["lgadmin"] == "") {
    header("location: Dangnhap_admin.php");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
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

        .product-detail {
            display: flex;
            gap: 20px;
        }

        .product-detail img {
            max-width: 300px;
            height: auto;
            object-fit: contain;
        }

        .product-info {
            flex: 1;
        }

        .product-info h1 {
            font-size: 24px;
            color: chocolate;
        }

        .product-info p {
            font-size: 16px;
            margin: 10px 0;
        }

        .product-info p span {
            font-weight: bold;
            color: #333;
        }

        .add-to-cart-form {
            margin-top: 20px;
        }

        .add-to-cart-form input[type="number"] {
            width: 50px;
            padding: 5px;
            margin-right: 10px;
        }

        .add-to-cart-form input[type="submit"] {
            padding: 10px 15px;
            background-color: chocolate;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .add-to-cart-form input[type="submit"]:hover {
            background-color: darkorange;
        }

        .product-description {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .product-description h2 {
            font-size: 20px;
            color: chocolate;
        }

        .product-description p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        .product-info .price {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuKhachNgang.php");?>
        <div class="product-detail">
            <img src="./images/<?php echo $product['Hinh']; ?>" alt="<?php echo $product['Tensua']; ?>" />
            <div class="product-info">
                <h1><?php echo $product['Tensua']; ?></h1>
                <p><span>Nhà sản xuất:</span> <?php echo $product['Tenhang']; ?></p>
                <p><span>Loại:</span> <?php echo $product['Tenloai']; ?></p>
                <p><span>Trọng lượng:</span> <?php echo $product['Trongluong']; ?>gr</p>
                <h3 class="price"><span>Giá:</span> <?php echo number_format($product['Dongia']); ?>đ</h3>
                <form method="post" class="add-to-cart-form">
                    <label for="soluong">Số lượng:</label>
                    <input type="number" name="soluong" id="soluong" value="1" min="1" />
                    <input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng" />
                </form>
            </div>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="product-description">
            <h2>Mô tả sản phẩm</h2>
            <p><strong>Danh Mục:</strong> <?php echo $product['Tenloai']; ?></p>
            <p><strong>Số Lượng Hàng:</strong> 408823</p>
            <p><strong>Tổ chức chịu trách nhiệm sản xuất:</strong> </span> <?php echo $product['Tenhang']; ?></p>
            <p><strong>Gửi Từ:</strong> Hà Nội</p>
            <p><strong>Thành phần dinh dưỡng:</strong><br> <?php echo nl2br($product['TP_dinh_duong']); ?></p>
            <p><strong>Lợi ích:</strong><br> <?php echo nl2br($product['Loi_ich']); ?></p>
        </div>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
