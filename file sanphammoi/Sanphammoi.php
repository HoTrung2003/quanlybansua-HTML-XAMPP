<?php
include ("ketnoi.php");
$db="SELECT * FROM sua order by Ngaynhap DESC limit 0,4";

$result = mysqli_query($conn, $db);
if(mysqli_num_rows($result) == "") {
    echo "Chưa có mặt hàng sữa nào";
} else {
    while($row = mysqli_fetch_array($result)) {
?>
        <link rel="stylesheet" href="style/giaodientrangchu.css">
        <div class="box">
            <h3 style="text-align: center;">
                <a href="Chitietsanpham.php?Masua=<?php echo $row['Masua']; ?>"><?php echo $row['Tensua']; ?></a>
                <br />
                <?php echo $row['Trongluong']; ?>gr &nbsp;
                <?php echo $row['Dongia']; ?>đ
                <br />
                <img src="./images/<?php echo $row['Hinh'] ?>" />
                <button>Đặt mua</button>
            </h3>
        </div>
<?php 
    } 
} 
?>
