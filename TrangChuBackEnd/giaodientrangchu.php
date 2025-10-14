<?php
  session_start();
  ob_start();
  include('ketnoi.php');
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- TemplateBeginEditable name="doctitle" -->
    <title>Trang mẫu</title>
    <!-- TemplateEndEditable -->
    <link rel="stylesheet" href="style/giaodientrangchu.css" />
    <!-- TemplateBeginEditable name="head" -->
    <!-- TemplateEndEditable -->
  </head>
  <body>
    <div class="container">
      <?php include("header.php"); ?>
      <?php include("menuNgang.php"); ?>

      <article>
        Code các chương trình ở đây
      </article>

      <?php include("footer.php"); ?>
    </div>
  </body>
</html>
