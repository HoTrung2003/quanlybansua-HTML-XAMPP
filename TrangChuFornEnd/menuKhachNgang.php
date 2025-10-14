<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu ngang</title>
    <link rel="stylesheet" href="style/menuMecon3.css" />
  </head>
  <body>
    <nav>
      <ul style="padding-left: 50px;">
        <li><a href="Trangchu.php">Trang Chủ</a></li>
        <li><a href="DanhSachLoai.php">Phân Loại</a>

          <ul class="vmenu">
            <li><a href="DanhSachSuaBot.php">Sữa Bột</a></li>
            
            <li><a href="DanhSachSuaChua.php">Sữa Chua</a></li>

            <li><a href="DanhSachSuaTuoi.php">Sữa Tươi</a></li>

            <li><a href="DanhSachSuaDac.php">Sữa Đặc</a></li>
          </ul>
        </li>
        <li><a href="DanhSachHang.php">Hãng</a>

          <ul class="vmenu">
            <li><a href="DanhsachVinamilk.php">Vinamilk</a></li>

            <li><a href="DanhsachTH.php">TH-True</a></li>

            <li><a href="DanhsachAbbott.php">Abbott</a></li>

            <li><a href="DanhSachCoGaiHL.php">Cô Gái Hà Lan</a></li>
          </ul>
        </li>

        <li><a href="XuHuong.php">Xu Hướng</a></li>
        <li><a href="GioHang.php">Giỏ Hàng</a></li>
        <li><a href="DonHang.php">Đơn Hàng</a></li>
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
