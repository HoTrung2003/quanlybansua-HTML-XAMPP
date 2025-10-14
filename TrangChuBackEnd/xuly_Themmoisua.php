<?php
// Kết nối cơ sở dữ liệu
include("ketnoi.php");

// Khai báo các biến để nhận dữ liệu từ form
$masua = $tensua = $hangsua = $loaisua = "";
$trongluong = $dongia = 0;
$tpdd = $loiIch = $hinhanh = "";
$ngay = date('Y-m-d'); // Ngày hiện tại theo định dạng MySQL

// Nhận dữ liệu từ form
if (isset($_POST["txtMasua"])) {
    $masua = $_POST["txtMasua"];
}
if (isset($_POST["txtTensua"])) {
    $tensua = $_POST["txtTensua"];
}
if (isset($_POST["selHangsua"])) {
    $hangsua = $_POST["selHangsua"];
}
if (isset($_POST["selLoaisua"])) {
    $loaisua = $_POST["selLoaisua"];
}
if (isset($_POST["txtTrongluong"])) {
    $trongluong = (int)$_POST["txtTrongluong"];
}
if (isset($_POST["txtDongia"])) {
    $dongia = (int)$_POST["txtDongia"];
}
if (isset($_POST["txtTpdd"])) {
    $tpdd = $_POST["txtTpdd"];
}
if (isset($_POST["txtLoiIch"])) {
    $loiIch =$_POST["txtLoiIch"];
}

if (isset($_POST["filHinh"])) 
    $hinh=$_POST["filHinh"];
    $hinhanh = $hinh;


// Kiểm tra mã sữa đã tồn tại
$sql = "SELECT * FROM sua WHERE Masua = '$masua'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<script language="javascript">
            alert("Mã sữa này đã có. Nhập lại");
            window.location="Themmoi_Sua.php";
          </script>';
    die();
} else {
    // Tạo câu truy vấn INSERT để thêm sữa
    $query = "INSERT INTO sua (Masua, Tensua, Mahangsua, Maloai, Trongluong, Dongia, TP_dinh_duong, Loi_ich, Hinh, Ngaynhap) 
              VALUES ('$masua', '$tensua', '$hangsua', '$loaisua', '$trongluong', '$dongia', '$tpdd', '$loiIch', '$hinhanh', '$ngay')";

    // Thực hiện truy vấn
    if (mysqli_query($conn, $query)) {
        echo '<script language="javascript">
                alert("Nhập mới sữa thành công");
                window.location="Danhsachsua.php";
              </script>';
    } else {
        echo '<script language="javascript">
                alert("Có lỗi trong quá trình xử lý: ' . mysqli_error($conn) . '");
                window.location="Themmoi_Sua.php";
              </script>';
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
