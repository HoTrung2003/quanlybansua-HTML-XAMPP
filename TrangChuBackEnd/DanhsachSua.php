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

/*      .khungsp > img {
        width: 20%;
        height: 90%;
        float: left;
        padding: 5px;
        border-left: 1px solid #A1A1A1;
      }*/
      .khungsp > img {
          width: 20%;
          height: 90%;
          float: left;
          padding: 5px;
          border-left: 1px solid #A1A1A1;
          object-fit: contain; /* Đảm bảo ảnh hiển thị đầy đủ và giữ tỷ lệ */
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
      <article style="margin-bottom: 30px;">
        <h1>THÔNG TIN CÁC SẢN PHẨM</h1>

        <?php
        if (isset($_SESSION["lgadmin"]) && $_SESSION["lgadmin"] == "admin") {
            echo '
            <div>
                <div class="themmoiSua">
                    <a href="Themmoi_Sua.php">Thêm mới Sữa</a>
                </div>
            </div>';
        }
        ?>


          <div>
            <form action="xuly_TimkiemSua.php" method="get" class="timkiem">
              <input type="text" name="keyword" />
              <input type="submit" value="Tìm kiếm" name="" />
            </form>
          </div>
        </div>
      <!-- </article> -->

      <?php
        $stt = 1;
        $db = "SELECT sua.Masua as masua, sua.Hinh as hinh, sua.Tensua as Tensua, sua.Trongluong as trongluong, sua.Dongia as dongia, 
                hangsua.Tenhang as TenHang, loaisua.Tenloai as tenloai 
                FROM sua 
                INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
                INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai";
        $result = mysqli_query($conn, $db);
        if(mysqli_num_rows($result) == 0) {
            echo "Chưa có sản phẩm sữa nào";
        } else {
          while($row = mysqli_fetch_array($result)) { 
      ?>
            <div class="khungsp">
              <div class="tt"><?php echo $stt++; ?></div>
              <img src="./images/<?php echo $row['hinh'] ?>" />
              <div class="thongtin">
                <h2><?php echo $row['Tensua'] ?></h2>
                <p>Nhà sản xuất: <?php echo $row['TenHang'] ?></p>
                <p>
                  <?php echo $row['tenloai']; ?>
                  &nbsp; &nbsp; Trong lượng: <?php echo $row['trongluong']; ?>gr
                  &nbsp; &nbsp; Giá: <?php echo $row['dongia']; ?>d
                </p>
              </div>

              <?php
              if (isset($_SESSION["lgadmin"]) && $_SESSION["lgadmin"] == "admin") {
              ?>
                <div class="sua">
                  <a style="text-decoration: none;" href="Suasua.php?Masua=<?php echo $row['masua']; ?>">Sửa</a>
                </div>
                <div class="xoa">
                  <a style="text-decoration: none;" href="Xoasua.php?Masua=<?php echo $row['masua']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sữa này không?');">Xóa</a>
                </div>
              <?php
              }else{
              ?>
                <div class="sua">
                  <a style="text-decoration: none;" href="Muasua.php?Masua=<?php echo $row['masua']; ?>">Mua</a>
                </div>
              <?php
              }
              ?>
              


            </div>
      <?php }
      }
       ?>
    </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
