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
    <link rel="stylesheet" href="../css/admenu.css">
    <title>HappyTails Shop</title>
    <script src="../js/admin.js"></script>
</head>
<body>
    <header>
        <a href="main.php"><img src="../images/logo-ngang.png" alt="logo" class="logo"></a>
        <p class="title">
            Trang chủ
        </p>
        <a href="account.php" target="content" class="user">
            <h3>
                <?php
                if(!empty($_SESSION['username'])){
                    echo $_SESSION['username'];
                } else {
                    echo 'UserName';
                }
                ?>
            </h3>
            <img src="../images/icons8-user-50.png" alt="avatar" class="avatar">
        </a>
    </header>
    <div class="main">
        <aside class="tab-hide">
            <nav>
                <a href="home.php" target="content">
                    <img class="icon" id="home" src="../images/icons8-home-26.png" alt="home">
                    Trang chủ
                </a>
                <a href="giong.php" target="content">
                    <img class="icon" src="../images/icons8-pet-bone-60.png" alt="pets">
                    Quản lí giống
                </a>
                <a href="thucung.php" target="content">
                    <img class="icon" src="../images/icons8-pet-50.png" alt="pet">
                    Quản lí thú cưng
                </a>
                <a href="khachhang.php" target="content">
                    <img class="icon" src="../images/icons8-customer-50.png" alt="customer">
                    Quản lí khách hàng
                </a>
                <a href="donhang.php" target="content">
                    <img class="icon" src="../images/icons8-order-30.png" alt="order">
                    Quản lí đơn hàng
                </a>
                <a href="tkqt.php" target="content">
                    <img class="icon" src="../images/icons8-database-administrator-30.png" alt="account">
                    Danh sách quản trị
                </a>
            </nav>
        </aside>
        <iframe src="home.php" frameborder="0" class="main-content" name="content"></iframe>
    </div>
</body>
</html>