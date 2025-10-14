<?php
session_start();
ob_start();
include('ketnoi.php'); // Kết nối tới cơ sở dữ liệu
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Danh sách sữa</title>
    <?php
    if (empty($_SESSION["lgadmin"])) {
        header("location: Dangnhap_admin.php");
    }
    ?>
    <link rel="stylesheet" href="style/style2.css" />
    <style>
      /* Container của danh sách sản phẩm */
      .khungsp-container {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Các cột tự động điều chỉnh */
          gap: 20px; /* Khoảng cách giữa các sản phẩm */
          width: 90%; /* Độ rộng của container */
          margin: 20px auto; /* Căn giữa container */
      }

      /* Từng sản phẩm */
      .khungsp {
          border: 1px solid #A1A1A1;
          border-radius: 8px;
          padding: 10px;
          background-color: #f9f9f9;
          text-align: center; /* Căn giữa nội dung */
          transition: transform 0.2s, box-shadow 0.2s; /* Hiệu ứng hover */
      }

      .khungsp:hover {
          transform: translateY(-5px);
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      }

      /* Hình ảnh sản phẩm */
      .khungsp img {
          width: 100%; /* Chiều rộng 100% khung */
          height: 150px; /* Chiều cao cố định */
          object-fit: contain; /* Đảm bảo giữ tỷ lệ ảnh */
          margin-bottom: 10px;
      }

      /* Tiêu đề sản phẩm */
      .khungsp h2 {
          font-size: 18px;
          color: #333;
          margin: 10px 0;
      }

      /* Thông tin sản phẩm */
      .khungsp p {
          font-size: 14px;
          margin: 5px 0;
          color: #555;
      }

      /* Các nút sửa/xóa/mua */
      .khungsp .actions {
          margin-top: 10px;
          display: flex;
          justify-content: center;
          gap: 10px; /* Khoảng cách giữa các nút */
      }

      .khungsp .actions a {
          text-decoration: none;
          padding: 5px 10px;
          border-radius: 4px;
          color: white;
          font-size: 14px;
      }

      .khungsp .actions a.sua {
          background-color: #007bff;
      }

      .khungsp .actions a.sua:hover {
          background-color: #0056b3;
      }

      .khungsp .actions a.xoa {
          background-color: #dc3545;
      }

      .khungsp .actions a.xoa:hover {
          background-color: #a71d2a;
      }

      .khungsp .actions a.mua {
          background-color: #28a745;
      }

      .khungsp .actions a.mua:hover {
          background-color: #1e7e34;
      }

      .timkiem {
          margin: 20px 0;
          text-align: center;
      }

      .timkiem input[type="text"] {
          padding: 8px;
          width: 300px;
          font-size: 16px;
          border: 1px solid #ccc;
          border-radius: 4px;
      }

      .timkiem input[type="submit"] {
          padding: 8px 15px;
          font-size: 16px;
          border: none;
          border-radius: 4px;
          background-color: #007bff;
          color: white;
          cursor: pointer;
      }

      .timkiem input[type="submit"]:hover {
          background-color: #0056b3;
      }

      .themmoiSua {
          margin: 20px 0;
          text-align: left;
      }

      .themmoiSua a {
          text-decoration: none;
          padding: 10px 20px;
          background-color: #28a745;
          color: white;
          border-radius: 4px;
          font-size: 16px;
      }

      .themmoiSua a:hover {
          background-color: #1e7e34;
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
        <h1 style="text-align: center;">THÔNG TIN CÁC SẢN PHẨM</h1>

        <?php if ($_SESSION["lgadmin"] == "admin") { ?>
          <div class="themmoiSua">
              <a href="Themmoi_Sua.php">Thêm mới Sữa</a>
          </div>
        <?php } ?>

        <div class="timkiem">
          <form action="xuly_TimkiemSua.php" method="get">
              <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." />
              <input type="submit" value="Tìm kiếm" />
          </form>
        </div>

        <div class="khungsp-container">
          <?php
          $db = "SELECT sua.Masua as masua, sua.Hinh as hinh, sua.Tensua as Tensua, sua.Trongluong as trongluong, sua.Dongia as dongia, 
                  hangsua.Tenhang as TenHang, loaisua.Tenloai as tenloai 
                  FROM sua 
                  INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
                  INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai";
          $result = mysqli_query($conn, $db);
          if (mysqli_num_rows($result) == 0) {
              echo "<p style='text-align: center;'>Chưa có sản phẩm sữa nào.</p>";
          } else {
              while ($row = mysqli_fetch_array($result)) { ?>
                  <div class="khungsp">
                      <img src="./images/<?php echo htmlspecialchars($row['hinh']); ?>" alt="<?php echo htmlspecialchars($row['Tensua']); ?>">
                      <h2><?php echo htmlspecialchars($row['Tensua']); ?></h2>
                      <p>Nhà sản xuất: <?php echo htmlspecialchars($row['TenHang']); ?></p>
                      <p><?php echo htmlspecialchars($row['tenloai']); ?> - <?php echo htmlspecialchars($row['trongluong']); ?>gr - <?php echo htmlspecialchars($row['dongia']); ?>đ</p>
                      <div class="actions">
                          <?php if ($_SESSION["lgadmin"] == "admin") { ?>
                              <a href="Suasua.php?Masua=<?php echo htmlspecialchars($row['masua']); ?>" class="sua">Sửa</a>
                              <a href="Xoasua.php?Masua=<?php echo htmlspecialchars($row['masua']); ?>" class="xoa" onclick="return confirm('Bạn có chắc chắn muốn xóa sữa này không?');">Xóa</a>
                          <?php } else { ?>
                              <a href="Muasua.php?Masua=<?php echo htmlspecialchars($row['masua']); ?>" class="mua">Mua</a>
                          <?php } ?>
                      </div>
                  </div>
              <?php }
          } ?>
        </div>
      </article>
      <?php include("footer.php"); ?>
    </div>
  </body>
</html>
