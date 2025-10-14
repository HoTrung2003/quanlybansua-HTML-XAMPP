<?php
  $conn = mysqli_connect("localhost", "root", "") 
          or die("Không kết nối được với cơ sở dữ liệu");

  mysqli_select_db($conn, "milkshop");
?>
