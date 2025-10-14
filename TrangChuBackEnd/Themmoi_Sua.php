<?php
  session_start();
  ob_start();
  include('ketnoi.php');
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Thêm mới sữa</title>
    <link rel="stylesheet" href="style/giaodientrangchu.css">
    <link rel="stylesheet" href="style/style2.css">
    <style type="text/css">
      img {
        max-width: 100%;
        height: auto;
        margin-top: 0px;
      }

      .khung-anh {
        width: 60px;
        height: 60px;
        margin-left: 5px;
        position: absolute;
        top: 5px;
        right: 50px;
      }
    </style>
    <?php
      if (($_SESSION["lgadmin"] == null) || ($_SESSION["lgadmin"] == "")) {
        header("location: Dangnhap_admin.php");
      }
    ?>
    <script language="javascript">
      function HienThi() {
        var duongdan = window.document.myForm.filHinh.value;
        if (duongdan != "") {
          window.document.myForm.anh.src = "hinh/" + duongdan;
        }
      }

      function kiemtrasua() {
        var masua = document.getElementById("txtMasua");
        var tensua = document.getElementById("txtTensua");
        var hangsua = document.getElementById("selHangsua");
        var loaisua = document.getElementById("selLoaisua");
        var dongia = document.getElementById("txtDongia");
        var tpdd = document.getElementById("txtTpdd");
        var loiIch = document.getElementById("txtLoiIch");
        var hinh = document.getElementById("filHinh");

        if (masua.value == "") {
          alert("Bạn phải nhập Mã sữa, Nhập lại");
          masua.focus();
          return false;
        } else {
          if (tensua.value == "") {
            alert("Bạn không được để trống ô tên sữa, nhập lại");
            tensua.focus();
            return false;
          } else {
            if (hangsua.value == "") {
              alert("Bạn chưa chọn hãng sữa, chọn lại");
              hangsua.focus();
              return false;
            } else {
              if (loaisua.value == "") {
                alert("Bạn chưa chọn loại sữa, chọn lại");
                loaisua.focus();
                return false;
              } else {
                if (trongluong.value == "") {
                  alert("Trọng lượng không được để trống, nhập lại");
                  trongluong.focus();
                  return false;
                } else {
                  if (dongia.value == "") {
                    alert("Đơn giá không được để trống, nhập lại");
                    dongia.focus();
                    return false;
                  } else if (tpdd.value == "") {
                    alert("Thành phần dinh dưỡng không được để trống, nhập lại");
                    tpdd.focus();
                    return false;
                  } else {
                    if (loiIch.value == "") {
                      alert("Lợi ích không được để trống, nhập lại");
                      loiIch.focus();
                      return false;
                    } else {
                      if (hinh.value == "") {
                        alert("Bạn chưa chọn Hình ảnh, chọn lại");
                        loiIch.focus();
                        return false;
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    </script>

  </head>
  <body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php include("menuNgang.php"); ?>

      <article>
        <div class="khung" style="  height: 80vh;border-radius: 5px;">
          <div class="form-group" style="margin-bottom: 40px;">
            <h2>THÊM MỚI SẢN PHẨM SỮA</h2>
            <div id="imgContainer" class="khung-anh"></div>
          </div>

          <form name="ThempmoiSua" action="xuly_Themmoisua.php" method="post" onsubmit="return kiemtrasua()">
            <div class="form-group">
              <label class="label">Mã Sữa</label>
              <input type="text" id="txtMasua" name="txtMasua" class="form-control" />
            </div>

            <div class="form-group">
              <label class="label">Tên Sữa</label>
              <input type="text" id="txtTensua" name="txtTensua" class="form-control" />
            </div>

            <div class="form-group">

              <?php
                $db = "SELECT * FROM hangsua";
                $query = mysqli_query($conn, $db);
                if (mysqli_num_rows($query) > 0) {
              ?>
              <div class="form-group">
                <label class="label">Tên Hãng Sữa</label>
                <select id="selHangsua" name="selHangsua" style="font-size: 16px" class="form-control">
                  <option value="">-- Chọn nhà cung cấp --</option>
                  <?php while ($row = mysqli_fetch_array($query)) { ?>
                  <option value="<?php echo $row['Mahangsua']; ?>"><?php echo $row['Tenhang']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <?php } ?>

              <div class="form-group">
                <label class="label">Loại sữa</label>
                <?php
                  // Truy vấn lấy danh sách loại sữa
                  $sql = "SELECT * FROM loaisua";
                  $loai = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($loai) > 0) {
                ?>
                <select id="selLoaisua" name="selLoaisua" style="font-size: 16px" class="form-control">
                  <option value="">-- Chọn Loại sữa --</option>
                  <?php while ($hang = mysqli_fetch_array($loai)) { ?>
                  <option value="<?php echo $hang['Maloai']; ?>"><?php echo $hang['Tenloai']; ?></option>
                  <?php } ?>
                </select>
                <?php } ?>
              </div>

              <div class="form-group">
                <label class="label">Trọng lượng</label>
                <input type="number" id="txtTrongluong" name="txtTrongluong" class="form-control" />
              </div>

              <div class="form-group">
                <label class="label">Đơn giá</label>
                <input type="number" id="txtDongia" name="txtDongia" class="form-control" />
              </div>

              <div class="form-group">
                <label class="label">TP. Dinh dưỡng</label>
                <textarea id="txtTpdd" name="txtTpdd" rows="3" cols="20" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <label class="label"><br>Lợi ích</label>
                <textarea id="txtLoiIch" name="txtLoiIch" rows="3" cols="20" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <label class="label"><br><br>Hình</label>
                <input type="file" id="filHinh" name="filHinh" class="form-control" />
              </div>

              <div class="form-group" style="text-align: center;">
                <button type="submit" class="button">Nhập sữa</button>
                <button type="reset" class="button">Reset</button>
              </div>
          </form>

          <!-- Code đoạn này để hiện hình ảnh -->
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
              
              reader.readAsDataURL(file);
            });
          </script>

        </div>
      </article>

      <?php include("footer.php"); ?>
    </div>
  </body>
</html>
