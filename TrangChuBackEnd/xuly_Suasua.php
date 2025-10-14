<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Untitled Document</title>
</head>

<body>
  <?php
include("ketnoi.php");

// Lấy thông tin từ form
$masua = $_POST["txtMasua"];
$tensua = $_POST["txtTensua"];
$hangsua = $_POST["selHangsua"];
$loaisua = $_POST["selLoaisua"];
$trongluong = (int)$_POST["txtTrongluong"];
$dongia = (int)$_POST["txtDongia"];
$tpdd = $_POST["txtTpdd"];
$loiIch = $_POST["txtLoiIch"];
$hinh = $_POST["txtHinh"]; // Lấy tên ảnh hiện tại từ textbox

// Kiểm tra nếu có file mới được upload
if (isset($_FILES["filHinh"]) && $_FILES["filHinh"]["name"] != "") {
    $hinh = $_FILES["filHinh"]["name"]; // Lấy tên file mới
    move_uploaded_file($_FILES['filHinh']['tmp_name'], "./images/" . $hinh); // Upload file mới
}

// Cập nhật dữ liệu vào cơ sở dữ liệu
$chen1 = "UPDATE sua SET 
            Tensua = '{$tensua}', 
            Mahangsua = '{$hangsua}', 
            Maloai = '{$loaisua}', 
            Trongluong = '{$trongluong}', 
            Dongia = '{$dongia}', 
            TP_dinh_duong = '{$tpdd}', 
            Loi_ich = '{$loiIch}', 
            Hinh = '{$hinh}' 
          WHERE Masua = '{$masua}'";

$chen = mysqli_query($conn, $chen1);

// Kiểm tra kết quả
if ($chen) {
    echo '<script language="javascript">alert("Sửa bản ghi sữa thành công"); window.location="Danhsachsua.php";</script>';
} else {
    echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="Suasua.php";</script>';
}
?>

</body>
</html>
