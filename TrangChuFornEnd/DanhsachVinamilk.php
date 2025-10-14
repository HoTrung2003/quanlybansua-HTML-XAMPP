<?php
session_start();
ob_start();
include('ketnoi.php');
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Danh sách sản phẩm Vinamilk</title>
    <?php
    // Kiểm tra người dùng đã đăng nhập chưa
    if (!isset($_SESSION["lgadmin"])) {
        header("location: Dangnhap_admin.php");
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



      .banner-slideshow {
        position: relative;
        width: 1200px; /* Đặt chiều rộng bằng chiều rộng 1 ảnh */
        height: 400px; /* Đặt chiều cao khung chứa */
        overflow: hidden; /* Ẩn phần ảnh tràn ra ngoài */
        margin: 0 auto; /* Căn giữa slideshow */
        background-color: white; /* Đảm bảo khoảng trắng hai bên */
      }

      .slides {
        display: flex;
        width: 4800px; /* Tổng chiều rộng = chiều rộng 1 ảnh x số ảnh */
        animation: slide 16s linear infinite;
      }

      .slides img {
          width: 1200px; /* Chiều rộng mỗi ảnh */
          height: 400px; /* Chiều cao mỗi ảnh */
          object-fit: cover; /* Đảm bảo ảnh không méo */
      }

      /* Animation chuyển đổi ảnh */
      @keyframes slide {
          0% { transform: translateX(0); }             /* Ảnh đầu tiên */
          25% { transform: translateX(0); }           /* Dừng ảnh đầu tiên */
          33% { transform: translateX(-1200px); }     /* Chuyển sang ảnh thứ 2 */
          58% { transform: translateX(-1200px); }     /* Dừng ảnh thứ 2 */
          66% { transform: translateX(-2400px); }     /* Chuyển sang ảnh thứ 3 */
          91% { transform: translateX(-2400px); }     /* Dừng ảnh thứ 3 */
          100% { transform: translateX(-3600px); }    /* Chuyển sang ảnh thứ 4 */
      }

      /* Animation chuyển đổi ảnh */
      @keyframes slide {
          0% { transform: translateX(0); }             /* Ảnh đầu tiên */
          25% { transform: translateX(0); }           /* Dừng ảnh đầu tiên */
          33% { transform: translateX(-1200px); }     /* Chuyển sang ảnh thứ 2 */
          58% { transform: translateX(-1200px); }     /* Dừng ảnh thứ 2 */
          66% { transform: translateX(-2400px); }     /* Chuyển sang ảnh thứ 3 */
          91% { transform: translateX(-2400px); }     /* Dừng ảnh thứ 3 */
          100% { transform: translateX(-3600px); }    /* Chuyển sang ảnh thứ 4 */
      }


    </style>
  </head>
  <body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php include("menuKhachNgang.php");?>

      <div class="banner-slideshow">
        <div class="slides">
            <img src="images/banner2VNM.jpg" alt="Banner 2">
            <img src="images/banner1VNM.jpg" alt="Banner 1">
            <img src="images/banner3VNM.jpg" alt="Banner 3">
            <img src="images/banner4VNM.jpg" alt="Banner 4">
        </div>
      </div>
      
      <h1>Danh Sách Sản Phẩm Hãng Vinamilk</h1>

      <div class="product-grid">
        <?php
        $db = "SELECT sua.Masua as masua, sua.Hinh as hinh, sua.Tensua as Tensua, sua.Trongluong as trongluong, sua.Dongia as dongia, 
                hangsua.Tenhang as TenHang, loaisua.Tenloai as tenloai 
                FROM sua 
                INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
                INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai 
                WHERE hangsua.Tenhang = 'Vinamilk'"; // Điều kiện lọc sản phẩm của Vinamilk

        $result = mysqli_query($conn, $db);

        if (mysqli_num_rows($result) == 0) {
            echo "<p style='text-align: center;'>Không có sản phẩm nào của hãng Vinamilk</p>";
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
        <?php }
        }
        ?>
      </div>
    </div>
    <?php include("footer.php"); ?>
  </body>
</html>
