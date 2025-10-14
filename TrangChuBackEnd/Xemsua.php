<?php
  session_start();
  ob_start();
  include('ketnoi.php'); // Kết nối cơ sở dữ liệu

  // Kiểm tra xem có mã sữa được truyền qua URL không
  $Masua = isset($_GET['Masua']) ? $_GET['Masua'] : '';
  if ($Masua == '') {
    echo "Không tìm thấy sản phẩm!";
    exit;
  }

  // Truy vấn chi tiết sản phẩm từ database
  $sql = "SELECT sua.*, hangsua.Tenhang, loaisua.Tenloai 
          FROM sua 
          INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
          INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai 
          WHERE sua.Masua = '$Masua'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 0) {
    echo "Sản phẩm không tồn tại!";
    exit;
  }

  $sua = mysqli_fetch_assoc($result); // Lấy thông tin chi tiết sản phẩm
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Tiết Sản Phẩm</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 80%;
      max-width: 800px;
      margin: 20px auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .product {
      display: flex;
      flex-direction: row;
      gap: 20px;
    }

    .product img {
      max-width: 200px;
      max-height: 200px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .product-details {
      flex-grow: 1;
    }

    .product-details h2 {
      color: #555;
    }

    .product-details p {
      margin: 10px 0;
      font-size: 16px;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      text-decoration: none;
      color: #4CAF50;
      font-weight: bold;
      font-size: 16px;
    }

    .back-link a:hover {
      color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Chi Tiết Sản Phẩm</h1>
    <div class="product">
      <!-- Hình ảnh sản phẩm -->
      <div>
        <img src="./images/<?php echo $sua['Hinh']; ?>" alt="Hình ảnh sản phẩm">
      </div>

      <!-- Thông tin sản phẩm -->
      <div class="product-details">
        <h2><?php echo $sua['Tensua']; ?></h2>
        <p><strong>Nhà sản xuất:</strong> <?php echo $sua['Tenhang']; ?></p>
        <p><strong>Loại sữa:</strong> <?php echo $sua['Tenloai']; ?></p>
        <p><strong>Trọng lượng:</strong> <?php echo $sua['Trongluong']; ?> gr</p>
        <p><strong>Đơn giá:</strong> <?php echo number_format($sua['Dongia']); ?> VND</p>
        <p><strong>Thành phần dinh dưỡng:</strong> <?php echo $sua['TP_dinh_duong']; ?></p>
        <p><strong>Lợi ích:</strong> <?php echo $sua['Loi_ich']; ?></p>
      </div>
    </div>

    <!-- Link quay lại -->
    <div class="back-link">
      <a href="DanhSachSua.php">← Quay lại danh sách</a>
    </div>
  </div>
</body>
</html>
