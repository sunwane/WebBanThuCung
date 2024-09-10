<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/admin.js"></script>
    <?php
        include "connect.php";
        include "xulitable.php";
    ?>
</head>
<body>
    <div class="box1">
        <h2>Thông tin mới</h2>
        <div class="new">
            <a href="donhang.php?tab=dadat" class="donhangmoi">
                <div class="tieude">ĐƠN HÀNG MỚI</div>
                <div class="soluong"><?php echo CountData($conn,'DonHang'," WHERE TrangThai='Đã đặt hàng'")?> đơn hàng</div>
                <br>
                <hr>
                <div class="lastupdate">Cập nhật lần cuối: <span id="up">12/07/2024 2:30</span></div>
            </a>
            <a href="donhang.php?tab=daxacnhan" class="daxuli">
                <div class="tieude">ĐƠN ĐÃ XÁC NHẬN</div>
                <div class="soluong"><?php echo CountData($conn,'DonHang'," WHERE TrangThai='Đã xác nhận'")?> đơn hàng</div>
                <br>
                <hr>
                <div class="lastupdate">Cập nhật lần cuối: <span id="up">12/07/2024 2:30</span></div>
            </a>
            <a href="donhang.php?tab=danggiao" class="danggiao">
                <div class="tieude">ĐƠN ĐANG GIAO</div>
                <div class="soluong"><?php echo CountData($conn,'DonHang'," WHERE TrangThai='Đang giao'")?> đơn hàng</div>
                <br>
                <hr>
                <div class="lastupdate">Cập nhật lần cuối: <span id="up">12/07/2024 2:30</span></div>
            </a>
            <a href="khachhang.php" class="khachhang">
                <div class="tieude">KHÁCH HÀNG</div>
                <div class="soluong"><?php echo CountData($conn,'KhachHang')?> khách hàng</div>
                <br>
                <hr>
                <div class="lastupdate">Cập nhật lần cuối: <span id="up">12/07/2024 2:30</span></div>
            </a>
        </div>
    </div>
</div>
</body>
</html>