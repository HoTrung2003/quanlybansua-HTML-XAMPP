<?php
session_start();
ob_start();
include('ketnoi.php');
?>
<!doctype html>

<html>
    <title>Chi tiet san pham</title>
        <style type="text/css">
        .khungchitiet {
            margin-top: 5px;
            width: 100%;
            min-height: 300px;
            border: 2px double orangered;
        }
        .tensp {
            width: 100%;
            height: 40px;
            background-color: aquamarine;
            color: orangered;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 40px;
            border-bottom: 1px solid orangered;
        }
        .khungchitiet>img {
            width: 25%;
            height: 220px;
            padding: 5px;
            border-radius: 10px;
            float: left;
        }
        .khungchitiet>.noidung {
            width: 72%;
            height: 220px;
            padding: 5px;
            float: right;
            border-left: 1px solid orangered;
        }
        .khungchitiet>.quaylai {
            clear: both;
            width: 100%;
            line-height: 20px;
            height: 20px;
            border-top: 1px solid orangered;
            padding: 10px;
        }
        </style>
    <body>
        <?php
        $Masua = isset($_GET['Masua']) ? $_GET['Masua'] : 0;
        $db = "SELECT * FROM sua WHERE Masua='$Masua'";
        $result = mysqli_query($conn, $db);

        if (mysqli_num_rows($result) == 0) {
            echo "Chưa có mặt hàng sữa nào";
        } else {
            while ($row = mysqli_fetch_array($result)) {
        ?>

            <div class="khungchitiet">
                <div class="tensp"><?php echo $row['tensua']; ?></div>
                <img src="<?php echo $row['Hinh']; ?>">
                <div class="noidung">
                    <h2>Thành phần dinh dưỡng</h2>
                    <?php echo $row['TP_dinh_duong']; ?>
                    <h2>Lợi ích</h2>
                    <?php echo $row['Loi_ich']; ?>
                    <br />
                    <div style="text-align: right; padding: 0 20px;">
                        Trọng lượng: <?php echo $row['Trongluong']; ?> gr &nbsp;
                        Giá: <?php echo $row['Dongia']; ?>
                    </div>
                </div>
                <div class="quaylai"><a href="Trangchu.php">Quay lại</a></div>
            </div>
        <?php 
            } 
        } 
        ?>
    </body>
</html>