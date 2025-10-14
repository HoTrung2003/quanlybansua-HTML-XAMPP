<?php
session_start();
ob_start();
include('ketnoi.php');

if (!isset($_SESSION["lgadmin"]) || $_SESSION["lgadmin"] == "") {
    header("location: Dangnhap_admin.php");
    exit();
}

// Nhận từ khóa từ form
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($conn, $_GET['keyword']) : '';

// Truy vấn tìm kiếm
$sql = "SELECT sua.Masua AS masua, sua.Hinh AS hinh, sua.Tensua AS Tensua, sua.Trongluong AS trongluong, sua.Dongia AS dongia, 
               hangsua.Tenhang AS TenHang, loaisua.Tenloai AS tenloai 
        FROM sua 
        INNER JOIN hangsua ON sua.Mahangsua = hangsua.Mahangsua 
        INNER JOIN loaisua ON sua.Maloai = loaisua.Maloai 
        WHERE sua.Tensua LIKE '%$keyword%' 
           OR hangsua.Tenhang LIKE '%$keyword%' 
           OR loaisua.Tenloai LIKE '%$keyword%'";

$result = mysqli_query($conn, $sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die('Lỗi truy vấn: ' . mysqli_error($conn));
}
?>
<!doctype html>
<html>
<?php include("header.php"); ?>
    <?php include("menuNgang.php"); ?>
<head>
    <meta charset="utf-8">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="style/stylel.css">
    <style>
      table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
      }

      th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
      }

      th {
        background-color: peachpuff;
        color: chocolate;
        font-weight: bold;
      }

      tr:nth-child(even) {
        background-color: #f9f9f9;
      }

      tr:hover {
        background-color: #f1f1f1;
      }

      img {
        max-width: 60px;
        height: auto;
      }

      a {
        text-decoration: none;
        color: #007bff;
      }

      a:hover {
        text-decoration: underline;
      }
    </style>
</head>
<body>
    
    <h1 style="text-align:center;">KẾT QUẢ TÌM KIẾM</h1>
    <div style="text-align:center;">
        <a href="DanhsachSua.php">Quay lại</a>
    </div>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình</th>
                    <th>Tên Sữa</th>
                    <th>Hãng</th>
                    <th>Loại</th>
                    <th>Trọng lượng (gr)</th>
                    <th>Giá (đ)</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 0;
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo ++$stt; ?></td>
                        <td>
                            <img src="./images/<?php echo $row['hinh'] ?>" />
                        </td>
                        <td><?php echo $row['Tensua']; ?></td>
                        <td><?php echo $row['TenHang']; ?></td>
                        <td><?php echo $row['tenloai']; ?></td>
                        <td><?php echo $row['trongluong']; ?></td>
                        <td><?php echo number_format($row['dongia'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="Suasua.php?Masua=<?php echo $row['masua']; ?>">Sửa</a>
                        </td>
                        <td>
                            <a href="Xoasua.php?Masua=<?php echo $row['masua']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div style="text-align:center; color:red; margin-top:20px;">
            Không tìm thấy sản phẩm nào phù hợp với từ khóa "<?php echo htmlspecialchars($keyword); ?>".
        </div>
    <?php endif; ?>
    <?php include("footer.php"); ?>
</body>
</html>
