<?php
    include "connect.php";
    include "order.php";
    if(isset($_POST['button-order']) && $_POST['button-order']){
        $idKH = NextID($conn, "khachhang", "K", "MaKhachHang");
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        if($city == 'hcm'){
            $city = 'Hồ Chí Minh';
        }
        else if($city == 'dn'){
            $city = 'Đà Nẵng';
        }
        else if($city == 'hn'){
            $city = 'Hà Nội';
        }
        else {
            $city = 'Hải Phòng';
        }
        $address1 = $address . ", " . $district . ", " . $city;

        $date = strtotime('+2 weeks');

        $idDH = NextID($conn, "donhang", "D", "MaDon");
        $pttt = "Tiền mặt";
        $ngayDat = date("Y") . "-" . date("m") . "-" . date("d");
        //$ngayGiao = date('Y', $date) ."-" . date('m', $date) . "-" . date('d', $date);
        //$ngayGiao = NULL;
        $note = $_POST['note'];
        $sum = $_POST['sum'];
        $trangthai = "Đã đặt hàng";
        $dlBang = json_decode($_POST['table'], true);

        $check = checkPhoneExist($phone, $conn);
        if(!empty($name) && !empty($address1) && !empty($phone) && !empty($email) && !empty($idKH) && !empty($idDH)  && !empty($sum)){
            if($check == true){
                infoCus($idKH, $name, $phone, $address1, $email, $conn);
                inforOrder($idDH, $idKH, $pttt, $ngayDat, $note, $sum, $trangthai, $conn);
                
                foreach ($dlBang as $item) {
                    $petName = $item['product'];
                    $price = $item['price'];

                    
                    orderDetail($idDH, $petName, $price, $conn);
                }
            }
            else{
                //echo "<script>console.log('std nay da duoc dung de mua 1 lan')</script>";
                $idCus = getIDCus($conn, $phone);
                updateCus($idCus, $name, $phone, $address1, $email, $conn);
                inforOrder($idDH, $idCus, $pttt, $ngayDat, $note, $sum, $trangthai, $conn);
                
                foreach ($dlBang as $item) {
                    $petName = $item['product'];
                    $price = $item['price'];

                    orderDetail($idDH, $petName, $price, $conn);
                }
            }
        }
        else echo "<script>console.log('du lieu chua duoc gui')</script>";

        $checkData;
        foreach ($dlBang as $item) {
            $petName = $item['product'];
            $price = $item['price'];

            $checkData = checkSendData($petName, $conn);
            if($checkData){
                changStatus($petName, $conn);
                echo "<script>localStorage.removeItem('cart');</script>";
                echo "<script>localStorage.removeItem('quantity');</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="css/displayCBI.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <div class="header">
        <div class="flex-box">
            <div class="left-header">
                <a class="logo-button" href="index.php">
                    <img src="images/icon/5.png">
                </a>
                <a class="nameshop-button" href="index.php">Happy Tails</a>
                <hr>
                <p>Thanh toán</p>
            </div>
        </div>
    </div>

    <form action="CheckoutAndBillInfo.php" method="post" >
        <div class="order-details">
            <div class="info-customer">
                <p class="title-info-customer">Thông tin khách hàng</p>
                <p class="name-info-customer">Họ tên</p>
                <input name="name" class="input-name" type="text" placeholder="Nguyễn Văn A" id="ten">
                <p class="name-p" id="name-p"></p>
                <p class="address">Địa chỉ</p>
                <select name="city" class="address-city" id="city">
                        <option value="hcm">Hồ Chí Minh</option>
                        <option value="hn">Hà Nội</option>
                        <option value="dn">Đà Nẵng</option>
                        <option value="hp">Hải Phòng</option>
                </select>
                <select name="district" class="address-district" id="district">
                        <option>Quận 1</option>
                        <option>Quận 2</option>
                        <option>Quận 3</option>
                        <option>Quận 4</option>
                </select>
                <br>
                <input name="address" class="input-address" type="text" placeholder="Số 73, đường Hoàng Diệu 2" id="address">
                <p class="name-p" id="address-p"></p>
                <div class="contact">
                    <div class="part1">
                        <p>Số điện thoại</p>
                        <input name="phone" type="text" placeholder="0911111111" id="sdt">
                        <p class="name-p" id="phone-p"></p>
                    </div>
                    <div class="part2">
                        <p>Email</p>
                        <input name="email" type="text" placeholder="nguyenvana@gmail.com" id="email">
                        <p class="name-p" id="email-p"></p>
                    </div>
                </div>
                <p class="note">Ghi chú</p>
                <textarea name="note" class="note-input" type="text" id="note"></textarea>
            </div>
            
            <div class="info-order">
                <p class="order">Đơn hàng của bạn</p>
                <div class="title">
                    <p>Sản phẩm</p>
                    <p>Tạm tính</p>
                </div>
                <table id="table"></table>
                <div class="ship">
                    <p>Phí vận chuyển</p>
                    <p>0 VND</p>
                </div>

                <div class="price">
                    <p>Tổng</p>
                    <p id="sum">20.000.000 VND</p>
                </div>

                <div class="way">
                    <p>Phương thức thanh toán</p>
                    <p>Tiền mặt</p>
                </div>

                <input type="hidden" name="sum" id="sumData">
                <input type ="hidden" name="table" id="tableData">

                <div class="order-button">
                    <!--<button id="dat-hang-button" name="button-order" type="submit">Đặt hàng</button>-->
                    <input type="submit" name="button-order" value="Đặt hàng" id="dat-hang-button">
                </div>
            </div>
        </div>
    </form>

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
            <button class="ship-pay">
                <a href="">Chính sách vận chuyển và thanh toán</a>
            </button>
            <p class="hotline">Hotline: 0954865324</p>
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

    <script type="module" src="js/payment.js"></script>
    
    
</body>
</html>