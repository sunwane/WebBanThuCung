<?php
    include "getData.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <div class="header">
        <div class="left">
            <a class="logo-button" href="index.php">
                <img src="images/icon/5.png">
            </a>
            <a class="nameshop-button" href="index.php">Happy Tails</a>
        </div>

        <div class="right">
            <a class="intro-button" href="Introduce.html">Giới thiệu</a>
            <a class="news" href="news.html">Chuyên mục về chó mèo</a>
            <!--<select>
                <option value="" disabled selected hidden>Chuyên mục về chó mèo</option>
                <option value="us">Chuyên mục về chó</option>
                <option value="vn">Chuyên mục về mèo</option>
            </select> -->  
            <!--<div class="new">
                <button>Chuyên mục về chó mèo</button>
                <ul>
                    <li>Chuyên mục về chó</li>
                    <li>Chuyên mục về mèo</li>
                </ul>
            </div>-->
            <div class="cart">
                <a class="cart-button" href="Cart.html">
                    <img src="images/icon/shopping-cart.png">
                </a>
                <p id="quantity_cart">0</p>
            </div>        
        </div>
    </div>

    <div class="body0">
        <img src="images/design/Picture20.png">
        <div class="body0-part1">
            <div>
                <div class="content">
                    <h1>Cùng chúng tôi</h1>
                    <h1>tìm người bạn lông xù hoàn hảo.</h1>
                    <p>Chúng tôi mang đến những chú chó mèo khỏe mạnh.</p>
                    <div class="search">
                        <input class="find" type="text" placeholder="Tìm kiếm">
                        <button class="search-button">
                            <img src="images/icon/search.png">
                        </button>
                    </div>
                    <div class="products" id='pet'></div>
                </div>
            </div>
        </div>
    </div>


    <div class="body1">
        <div class="dog">
            <img src="images/design/21.png">
            <!--<a class="danh-muc-cho" href="danh-muc-cho.html">Chó</a>-->
            <a>Chó</a>
        </div>
        <div class="dog">
            <img src="images/design/23.png">
            <a>Mèo</a>
        </div>
        <div class="dog">
            <img src="images/design/22.png">
            <a>Hot</a>
        </div>
        <div class="dog">
            <img src="images/design/24.png">
            <a>Mới</a>
        </div>
    </div>

    <div class="showAll">
        <a href="AllPets.php">
            <button class="show-button">Xem tất cả</button>
        </a>
    </div>

    <div class="footer">
        <div class="info-contact">
            <p class="title-contact">Thông tin liên hệ</p>
            <hr>
            <div class="shop-address">
                <img src="images/icon/placeholder.png">
                <p>Cửa hàng: 1045 Kha Vạn Cân, Linh Trung, Thủ Đức, TP.HCM</p>
            </div>
            <div class="farm-address">
                <img src="images/icon/placeholder.png">
                <p>Trại nhân giống Happy Tails: Huỳnh Văn Lũy, Thủ Dầu 1, BD</p>
            </div>
        </div>

        <div class="policy">
            <p class="title-policy"> Chính sách mua bán</p>
            <hr>
            <button class="security">
                <a href="">Chính sách bảo mật</a>
            </button>
            <button class="ship">
                <a href="">Chính sách vận chuyển và thanh toán</a>
            </button>
            <p class="hotline">Hot line: 0954865324</p>
        </div>

        <div class="info-social">
            <p class="title-social">Happy Tails trên MXH</p>
            <hr>
            <div class="icon">
                <a href="#">
                    <img src="images/icon/facebook (1).png">
                </a>
                <a href="#">
                    <img src="images/icon/youtube (2).png">
                </a>
                <a href="#">
                    <img src="images/icon/tiktok.png">
                </a>
                <a href="#">
                    <img src="images/icon/instagram.png">
                </a>
            </div>
        </div>
    </div>

    <script type="module" src="js/trangchu.js"></script>
</body>
</html>