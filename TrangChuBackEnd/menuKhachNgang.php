<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Menu ngang</title>
    <link rel="stylesheet" href="style/menuMecon2.css" />
  </head>
  <body>
    <nav>
      <ul style="padding-left: 50px;">
        <li><a href="#">Quản Lý</a>

          <ul class="vmenu">
            <li><a href="Danhsachhang.php">Danh Sách Hãng sữa</a></li>
            
            <li><a href="Danhsachloai.php">Danh Sách Loại Sữa</a></li>

            <li><a href="Danhsachsua.php">Danh Sách Sữa</a></li>

          </ul>
        </li>

        <li><a href="Trangchu.php">Trang Chủ User</a></li>
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
