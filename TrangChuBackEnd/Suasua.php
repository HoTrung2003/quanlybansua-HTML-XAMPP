<?php
  session_start();
  ob_start();
  include('ketnoi.php');
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/TrangmauAdmin.dwt.php" -->
  <head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Sua sua</title>
    <?php
      if(($_SESSION["lgadmin"] == null) || ($_SESSION["lgadmin"] == "")) {
        header("location: Dangnhap_admin.php");
      }
    ?>
    <link rel="stylesheet" href="style/style2.css">
    <style type="text/css">
      img {
        max-width: 100%;
        height: auto;
        margin-top: 0px;
      }

      .khung-anh {
        margin: 0 auto;
        width: 170px;

      }
    </style>
    <link rel="stylesheet" href="style/giaodientrangchu.css" />
  </head>
  <body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php include("menungang.php"); ?>

      <article><!-- InstanceBeginEditable name="EditRegion3" -->
        <?php
          $Masua = isset($_GET['Masua']) ? $_GET['Masua'] : 0;
          $db = "SELECT * FROM sua WHERE Masua = '$Masua'";
          $query = mysqli_query($conn, $db);
          
          if(mysqli_num_rows($query) == 0) {
            echo "Chưa có Mặt hàng sữa cần sửa";
          } else {
            $result = mysqli_fetch_array($query);
        ?>
        <div class="khung" style="  height: 100vh; border-radius: 5px;">
          <div class="form-group" style="margin-bottom: 40px;">
            <h2>SỬA SẢN PHẨM SỮA</h2>
            <div id="imgContainer" class="khung-anh">
              <img src="./images/<?php echo $result['Hinh']; ?>" />
            </div>

            <form name="suakhachhang" action="xuly_Suasua.php?Masua=<?php echo $result['Masua']; ?>" method="post">
              <div class="BTN_Form">
                <label class="label">Mã Sữa</label>
                <input type="text" id="txtMasua" name="txtMasua" class="form-control" readonly value="<?php echo $result['Masua']; ?>" />
              </div>

              <div class="BTN_Form">
                <label class="label">Tên Sữa</label>
                <input type="text" id="txtTensua" name="txtTensua" class="form-control" value="<?php echo $result['Tensua']; ?>" />
              </div>

              <div class="BTN_Form">
                <label class="label">Tên hàng sữa</label>
                <select name="selHangsua" class="form-control">
                  <?php
                    $hangQuery = "SELECT * FROM hangsua";
                    $hangResult = mysqli_query($conn, $hangQuery);
                    while ($hang = mysqli_fetch_assoc($hangResult)) {
                      $selected = $result['Mahangsua'] == $hang['Mahangsua'] ? "selected" : "";
                      echo "<option value='{$hang['Mahangsua']}' $selected>{$hang['Tenhang']}</option>";
                    }
                  ?>
                </select> 
              </div>

              <div class="BTN_Form">
                <label class="label">Loại sữa</label>
                <select name="selLoaisua" class="form-control">
              <?php
                $loaiQuery = "SELECT * FROM loaisua";
                $loaiResult = mysqli_query($conn, $loaiQuery);
                while ($loai = mysqli_fetch_assoc($loaiResult)) {
                  $selected = $result['Maloai'] == $loai['Maloai'] ? "selected" : "";
                  echo "<option value='{$loai['Maloai']}' $selected>{$loai['Tenloai']}</option>";
                }
              ?>
            </select>
              </div>

              <div class="BTN_Form">
                <label class="label">Trọng lượng</label>
                <input type="number" id="txtTrongluong" name="txtTrongluong" class="form-control" value="<?php echo $result['Trongluong']; ?>" />
              </div>

              <div class="BTN_Form">
                <label class="label">Đơn giá</label>
                <input type="number" id="txtDongia" name="txtDongia" class="form-control" value="<?php echo $result['Dongia']; ?>" />
              </div>

              <div class="BTN_Form">
                <label class="label">TP. Dinh dưỡng</label>
                <textarea id="txtTpdd" name="txtTpdd" rows="3" cols="20" class="form-control"><?php echo $result['TP_dinh_duong']; ?></textarea>
              </div>

              <div class="BTN_Form">
                <label class="label"><br>Lợi ích</label>
                <textarea id="txtLoiIch" name="txtLoiIch" rows="3" cols="20" class="form-control"><?php echo $result['Loi_ich']; ?></textarea>
              </div>

              <div class="BTN_Form">
                <label class="label"><br><br>Hình</label>
                <input type="text" id="txtHinh" name="txtHinh" class="form-control" readonly value="<?php echo $result['Hinh']; ?>" />
                <input type="file" id="filHinh" name="filHinh" class="form-control" />
              </div>



              <div class="BTN_Form" style="text-align: center;">
                <button type="submit" class="button">Sửa sản phẩm</button>
                <button type="reset" class="button">Reset</button>
              </div>
            </form>

            <script>
              const fileInput = document.getElementById('filHinh');
              const imgContainer = document.getElementById('imgContainer');
              
              fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                  const imgUrl = e.target.result;
                  imgContainer.innerHTML = `<img src="${imgUrl}" alt="Product Image">`;
                };

                if (file) {
                  reader.readAsDataURL(file);
                }
              });
            </script>
          </div>
        </div>
        <?php } ?>
      </article>
       <?php include("footer.php"); ?>
    </div>
  </body>
</html>
