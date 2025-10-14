<?php
session_start();
include('ketnoi.php');

$sql = "
    SELECT dh.id_donhang, dh.ngaydat, dh.tongtien, ct.masua, ct.tensua, ct.soluong, ct.dongia, ct.hinh
    FROM donhang AS dh
    INNER JOIN chitietdonhang AS ct ON dh.id_donhang = ct.id_donhang
    ORDER BY dh.ngaydat DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn Hàng</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: chocolate;
            color: white;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        .empty {
            text-align: center;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include("header.php"); ?>
        <?php include("menuKhachNgang.php");?>
        <?php if (mysqli_num_rows($result) > 0): ?>
        <h1>Danh sách đơn hàng</h1>
        <table>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Ảnh</th>
                <th>Hành động</th> 
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id_donhang']; ?></td>
                <td><?php echo $row['ngaydat']; ?></td>
                <td><?php echo number_format($row['tongtien']); ?>đ</td>
                <td><?php echo $row['tensua']; ?></td>
                <td><?php echo $row['soluong']; ?></td>
                <td style="color: red;font-weight: bold;font-size: 18px"><?php echo number_format($row['dongia']); ?>đ</td>
                <td><img src="./images/<?php echo $row['hinh']; ?>" alt="<?php echo $row['tensua']; ?>"></td>
                <td>
                <a href="xoa_donhang.php?id=<?php echo $row['id_donhang']; ?>" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?');">Xóa
                </a>
            </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
        <p class="empty">Không có đơn hàng nào.</p>
        <?php endif; ?>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
