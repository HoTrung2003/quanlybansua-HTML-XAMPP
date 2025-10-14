<?php
  session_start();
  ob_start();
  include('ketnoi.php');
?>

<!doctype html>
<html><!-- InstanceBegin template="/Templates/TrangmauAdmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta charset="utf-8">
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Trang Thống Kê</title>
  <?php
    if (($_SESSION["lgadmin"] == null) || ($_SESSION["lgadmin"] == "")) {
      header("location: Dangnhap_admin.php");
    }
  ?>
  <!-- InstanceEndEditable -->
  <link rel="stylesheet" href="style/giaodientrangchu.css" />
  <!-- InstanceBeginEditable name="head" -->
  <!-- InstanceEndEditable -->
</head>
<body>
  <div class="container">
    <?php include("header.php"); ?>
    <?php include("menuNgang.php"); ?>
    <article><!-- InstanceBeginEditable name="EditRegion3" -->
    <?php
      $i = 0;
      $db = "SELECT * FROM sua";
      $result = mysqli_query($conn, $db);

      if(mysqli_num_rows($result) == 0) {
        echo "Chưa có sản phẩm sữa nào";
      } else {
    ?>
    <table cellspacing="0" cellpadding="5px" border="1" style="width:100%;">
      <caption><H2 style="font-weight: bold; color: #0000FF; font-size: 30px;">THỐNG KÊ SỮA</H2></caption>
      <thead>
        <tr style="background-color: #ccc; font-size: 20px; color: #FF00FF;">
          <th>TT</th>
          <th>Mã sữa</th>
          <th>Tên sữa</th>
          <th>Hãng sữa</th>
          <th>Loại sữa</th>
          <th>Trọng lượng</th>
          <th>Đơn giá</th>
          <th>TP Dinh dưỡng</th>
          <th>Lợi ích</th>
          <th>Ảnh</th>
          <th>Xem</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($row = mysqli_fetch_array($result)) {
        ?>
        <tr style="text-align:center; font-size: 20px;">
          <td><?php echo ++$i; ?></td>
          <td><?php echo $row['Masua']; ?></td>
          <td><?php echo $row['Tensua']; ?></td>
          <td><?php echo $row['Mahangsua']; ?></td>
          <td><?php echo $row['Maloai']; ?></td>
          <td><?php echo $row['Trongluong']; ?></td>
          <td><?php echo $row['Dongia']; ?></td>
          <td><?php echo $row['TP_dinh_duong']; ?></td>
          <td><?php echo $row['Loi_ich']; ?></td>
          <td><img src="./images/<?php echo $row['Hinh']; ?>" alt="Image" width="50" height="50"></td>
          <td>
            <a style="text-decoration: none;" href="Xemsua.php?Masua=<?php echo $row['Masua']; ?>">View</a>
          </td>
          <td>
            <a style="text-decoration: none;" href="Suasua.php?Masua=<?php echo $row['Masua']; ?>">Edit</a>
          </td>
          <td>
            <a style="text-decoration: none;" href="Xoasua.php?Masua=<?php echo $row['Masua']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Delete</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <!-- InstanceEndEditable -->
    </article>
    <?php include("footer.php"); ?>
  </div>
</body>
</html>
