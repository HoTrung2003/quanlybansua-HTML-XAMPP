<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu ngang</title>
    <link rel="stylesheet" href="style/menuMecon.css" />
  </head>
  <body>
    <nav>
      <ul style="padding-left: 50px;">
        <li><a href="#">Quản Lý</a>

          <ul class="vmenu">
            <li><a href="#">Quản Lý Hãng sữa</a>
            <ul>
              <li><a href="Danhsachhang.php">Danh Sách Hãng sữa</a></li>
              <li><a href="Themhang.php">Thêm Hãng</a></li>
            </ul>
            </li>
            <li><a href="#">Quản Lý Loại Sữa</a>
              <ul>
                <li><a href="Danhsachloai.php">Danh Sách Loại Sữa</a></li>
                <li><a href="Themloai.php">Thêm Loại Sữa</a></li>
              </ul>
            </li>
            <li><a href="#">Quản Lý Sữa</a>
              <ul>
                <li><a href="Danhsachsua.php">Danh Sách Sữa</a></li>
                <li><a href="Themmoi_Sua.php">Thêm Sản Phẩm Sữa</a></li>
              </ul>
            </li>
            <li><a href="#">Quản Lý Tin Tức</a>
              <ul>
                <li><a href="Danhsachtintuc.php">Danh Sách Tin Tức</a></li>
                <li><a href="Themtintuc.php">Thêm Tin Tức</a></li>
              </ul>
            </li>
            <li><a href="#">Quản Lý Khách Hàng</a>
              <ul>
                <li><a href="Danhsachkhachhang.php">Danh Sách Khách hàng</a></li>
                <li><a href="Themkhachhang.php">Thêm Thành Viên</a></li>
              </ul>
            </li>
            <li><a href="#">Ban Quản Trị</a>
              <ul>
                <li><a href="Danhsachthanhvien.php">Danh Sách Quản Trị</a></li>
                <li><a href="Dangkythanhvien.php">Thêm Quản Trị</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li><a href="Trangchu.php">Trang Chủ User</a></li>
        <li><a href="danhSachDonHang.php">Đơn hàng</a></li>
        <li><a href="thongke.php">Thống kê</a></li>
        <li><a href="lienhe.php">Liên hệ</a></li>
      </ul>

    <div class="chao">
      <span style="color: #FFFFFF; padding-left:7px;">Chào bạn:</span>
      <span class="tim"><?php echo isset($_SESSION["lgadmin"]) ? $_SESSION["lgadmin"] : "Khách"; ?></span> 
      <a href="Dangnhap_admin.php" style="text-decoration: none; color: white">Đăng xuất</a>
    </div>
  </nav>
  <br>
  </body>
</html>
