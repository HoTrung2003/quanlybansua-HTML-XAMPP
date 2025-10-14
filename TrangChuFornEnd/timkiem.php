<?php
include('ketnoi.php');

// Lấy từ khóa tìm kiếm từ GET hoặc POST
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Tạo truy vấn SQL
$sql = "SELECT sua.Masua as masua, sua.Hinh as hinh, sua.Tensua as Tensua, sua.Trongluong as trongluong, sua.Dongia as dongia, 
            hangsua.Tenhang as TenHang, loaisua.Tenloai as tenloai 
        FROM sua 
        INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
        INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai";

// Nếu có từ khóa, thêm điều kiện tìm kiếm
if (!empty($keyword)) {
    $sql .= " WHERE sua.Tensua LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'OR hangsua.Tenhang LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%' ";
}

$result = mysqli_query($conn, $sql);
