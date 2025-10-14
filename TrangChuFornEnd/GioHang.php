<?php
session_start();
ob_start();
include('ketnoi.php');

// Xử lý thanh toán
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['thanhtoan'])) {
    $sql = "SELECT * FROM giohang";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $tongtien = 0;

        // Tính tổng tiền của giỏ hàng
        while ($row = mysqli_fetch_assoc($result)) {
            $tongtien += $row['tonggia'];
        }

        // Thêm thông tin đơn hàng vào bảng `donhang`
        $ngaydat = date('Y-m-d');
        $stmt_dh = $conn->prepare("INSERT INTO donhang (ngaydat, tongtien) VALUES (?, ?)");
        $stmt_dh->bind_param("sd", $ngaydat, $tongtien);
        $stmt_dh->execute();
        $id_donhang = $stmt_dh->insert_id;

        // Thêm từng sản phẩm từ giỏ hàng vào bảng `chitietdonhang`
        $stmt_ctdh = $conn->prepare("INSERT INTO chitietdonhang (id_donhang, masua, tensua, soluong, dongia, tonggia, hinh) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
            $stmt_ctdh->bind_param(
                "issidds", 
                $id_donhang, 
                $row['masua'], 
                $row['tensua'], 
                $row['soluong'], 
                $row['dongia'], 
                $row['tonggia'], 
                $row['hinh']
            );
            $stmt_ctdh->execute();
        }

        // Xóa giỏ hàng sau khi thanh toán thành công
        mysqli_query($conn, "DELETE FROM giohang");

        // Thông báo thành công
        echo "<script>alert('Thanh toán thành công! Đơn hàng đã được lưu.');</script>";
    } else {
        echo "<script>alert('Giỏ hàng trống!');</script>";
    }
}

// Xử lý xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['xoa'])) {
    $id = $_POST['id'];
    $stmt_xoa = $conn->prepare("DELETE FROM giohang WHERE id = ?");
    $stmt_xoa->bind_param("i", $id);
    $stmt_xoa->execute();
    echo "<script>alert('Xóa sản phẩm thành công!'); window.location.href='giohang.php';</script>";
}

// Lấy danh sách sản phẩm trong giỏ hàng
$sql = "SELECT * FROM giohang";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: chocolate;
            color: white;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        .total {
            text-align: right;
            font-size: 18px;
            margin-top: 10px;
        }

        .checkout-btn, .delete-btn {
            display: inline-block;
            margin: 5px;
            padding: 10px 20px;
            background-color: green;
            color: white;
            text-align: center;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .checkout-btn:hover {
            background-color: darkgreen;
        }

        .delete-btn {
            background-color: red;
        }

        .delete-btn:hover {
            background-color: darkred;
        }

        .empty-cart {
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
        <h1>Giỏ hàng</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng giá</th>
                <th>Hành động</th>
            </tr>
            <?php 
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)): 
                $total += $row['tonggia'];
            ?>
            <tr>
                <td><img src="./images/<?php echo $row['hinh']; ?>" alt="<?php echo $row['tensua']; ?>"></td>
                <td><?php echo $row['tensua']; ?></td>
                <td><?php echo $row['soluong']; ?></td>
                <td><?php echo number_format($row['dongia']); ?>đ</td>
                <td style="color: red;font-weight: bold;font-size: 18px"><?php echo number_format($row['tonggia']); ?>đ</td>
                <td>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="xoa" class="delete-btn">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <p class="total"><strong>Tổng cộng:</strong> <?php echo number_format($total); ?>đ</p>
        <form method="post">
            <button type="submit" name="thanhtoan" class="checkout-btn">Thanh toán</button>
        </form>
        <?php else: ?>
        <p class="empty-cart">Giỏ hàng trống.</p>
        <?php endif; ?>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
