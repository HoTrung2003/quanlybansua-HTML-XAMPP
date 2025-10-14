<?php
  session_start();
  ob_start();
  include('ketnoi.php');
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Danh sach sua</title>
    <?php
      if(($_SESSION["lgadmin"] == null) || ($_SESSION["lgadmin"] == "")) {
        header("location: Dangnhap_admin.php");
      }
    ?>
    <link rel="stylesheet" href="style/style2.css" />
    <style type="text/css">
      .khungsp {
        clear: both;
        width: 80%;
        height: 100px;
        margin: 0 auto;
        border: 1px solid #A1A1A1;
        padding: 5px 6;
      }

      h1 {
        width: 80%;
        margin: 20px auto 0;
        height: 40px;
        line-height: 40px;
        background-color: peachpuff;
        color: chocolate;
        font-weight: bolder;
        text-align: center;
        border: 1px solid #A1A1A1;
      }

      .tt {
        width: 5%;
        text-align: center;
        height: 100%;
        float: left;
        line-height: 100px;
      }

      .khungsp > img {
        width: 20%;
        height: 90%;
        float: left;
        padding: 5px;
        border-left: 1px solid #A1A1A1;
      }

      .khungsp > .thongtin {
        width: 58%;
        padding-top: 0;
        float: left;
        height: 100%;
        padding-left: 10px;
        border-left: 1px solid #A1A1A1;
      }

      .sua {
        width: 7%;
        text-align: center;
        height: 100%;
        float: left;
        border-left: 1px solid #A1A1A1;
        line-height: 100px;
      }

      .xoa {
        width: 7%;
        text-align: center;
        height: 100%;
        float: right;
        border-left: 1px solid #A1A1A1;
        line-height: 100px;
      }

      h2 {
        text-align: center;
        margin: 0px;
        padding: 3px;
      }

      p {
        margin: 5px;
        padding: 3px;
      }

      .themmoiSua {
        width: 150px;
        height: 30px;
        border-radius: 10px;
        box-shadow: inset 0 0 10px red;
        font-size: 20px;
        margin: 20px 0 10px 120px;
        padding: 5px;
        text-align: center;
        float: left;
        line-height: 30px;
      }

      .themmoiSua > a {
        text-decoration: none;
      }

      .timkiem {
        float: right;
        width: 250px;
        height: 30px;
        border-radius: 10px;
        box-shadow: inset 0 0 10px red;
        font-size: 20px;
        margin: 20px 120px 10px 0px;
        padding: 5px;
        text-align: center;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="style/giaodientrangchu.css">
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
      <article style="margin-bottom: 30px;margin-top:50px ;">
        <div class="content" style="text-align:center;">
          <h2>Liên hệ</h2>
          <h3>Thành Viên Nhóm</h3>
          <p>Mạc Thành Trung: MacTrung@gmail.com</p>
          <p>Hồ Viết Trung: VietTrung@gmail.com</p>
          <p>Phạm Thành Quang: ThanhQuang@gmail.com</p>
          <p>Nguyễn Khánh Toàn: KhanhToan@gmail.com </p>
        </div>
      </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
