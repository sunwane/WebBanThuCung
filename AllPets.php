<?php
    include "getData.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="css/displayAllPets.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <!--Header-->
    <div class="header">
        <img class="back" src="images/design/Picture13.png">
        <div class="flex-box">
            <div class="left">
                <a class="logo-button" href="index.php">
                    <img src="images/icon/5.png">
                </a>
                <a class="nameshop-button" href="index.php">Happy Tails</a>
            </div>
    
            <div class="middle">
                <div class="search">
                    <input class="search" type="text" placeholder="Tìm kiếm">
                    <!--<button class="search-button">
                        <img src="images/icon/search.png">
                    </button>-->
                </div>
                <div class="products" id='pet'></div>
            </div>
            
    
            <div class="right">
                <a class="cart-button" href="Cart.html">
                    <img src="images/icon/shopping-cart (1).png">
                </a>
                <p id="quantity_cart">0</p>
            </div>
        </div>
    </div>

    <div class="tags">
        <div class="dog">
            <img src="images/icon/dog (2).png">
            <button>Chó</button>   
        </div>
        <div class="cat">
            <img src="images/icon/black-cat.png">
            <button>Mèo</button>
        </div>

        <div class="hot">
            <img src="images/icon/hot-sale.png">
            <button>Hot</button>
        </div>
        <div class="new">
            <img src="images/icon/icons8-new-96.png">
            <button>Mới</button>
        </div>
    </div>

    <!--body-->
    <div class="main-body">
        <div style="flex:1"></div>
        <div style="flex:4">
            <div class="body0"></div>
        </div>
        <div style="flex:1"></div>
    </div>

    <!--footer-->
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

    <script type="module" src="js/allPets.js"></script>
</body>
</html>