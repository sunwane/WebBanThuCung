<?php
    include 'connect.php';
    include 'timkiem.php';
    include "xulitable.php";
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
    <title>Thú cưng</title>
    <link rel="stylesheet" href="../css/table.css">
    <script src="../js/checkloi.js"></script>
    <script src="../js/table.js"></script>
</head>

<body>
    <div class="tab">
        <button class="tablink active" data-tab="all" onclick="openTab(this, 'all')">Tất cả</button>
        <button class="tablink" data-tab="dadat" onclick="openTab(this, 'dadat')">Đã đặt hàng</button>
        <button class="tablink" data-tab="daxacnhan" onclick="openTab(this, 'daxacnhan')">Đã xác nhận</button>
        <button class="tablink" data-tab="danggiao" onclick="openTab(this, 'danggiao')">Đang giao</button>
        <button class="tablink" data-tab="dagiao" onclick="openTab(this, 'dagiao')">Đã giao hàng thành công</button>
    </div>
    <div class="main">
        <div id="all" class="tabcontent">
            <form class="search" method="GET">
                <div class="tags">
                    <label>Tìm theo:</label>
                    <select class="search-type" name="searchType">
                        <option value="MaDon" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaDon' ? 'selected' : ''; ?>>Mã đơn</option>
                        <option value="MaKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaKhachHang' ? 'selected' : ''; ?>>Mã khách hàng</option>
                        <option value="TenKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenKhachHang' ? 'selected' : ''; ?>>Tên khách hàng</option>
                        <option value="SoDienThoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'SoDienThoai' ? 'selected' : ''; ?>>Số điện thoại</option>
                        <option value="Email" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'Email' ? 'selected' : ''; ?>>Email</option>
                        <option value="DiaChi" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'DiaChi' ? 'selected' : ''; ?>>Địa chỉ</option>
                        <option value="PhuongThucThanhToan" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'PhuongThucThanhToan' ? 'selected' : ''; ?>>Phương thức thanh toán</option>
                        <option value="NgayDatHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayDatHang' ? 'selected' : ''; ?>>Ngày đặt hàng</option>
                        <option value="NgayGiaoHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayGiaoHang' ? 'selected' : ''; ?>>Ngày giao hàng</option>
                        <option value="TrangThai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TrangThai' ? 'selected' : ''; ?>>Trạng thái</option>
                        <option value="TenSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenSanPham' ? 'selected' : ''; ?>>Tên sản phẩm</option>
                    </select>
                    <div class="hienthi">
                        <?php
                        displayCount2($conn, $searchQuery, $searchType, $searchText);
                        ?>
                    </div>
                </div>
                <div class="timkiem">
                    <div class="row1">
                        <input type="text" placeholder="Nhập nội dung tìm kiếm..." id="searchtext" name="searchtext" value="<?php echo $searchText ?>">
                        <button id="searchbtn">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="tble">
                <table class="donhang">
                    <thead>
                        <tr>
                            <th width="5%" style="min-width: 80px;">Mã đơn</th>
                            <th width="10%" style="min-width: 70px;">Mã KH</th>
                            <th width="10%" style="min-width: 180px;">Tên khách hàng</th>
                            <th width="10%" style="min-width: 140px; text-align:center">Số điện thoại</th>
                            <th width="10%" style="min-width: 160px; text-align:center">Email</th>
                            <th width="10%" style="min-width: 220px; text-align:center">Địa chỉ</th>
                            <th width="10%" style="min-width: 150px; text-align:center">Tổng giá trị</th>
                            <th width="10%" style="min-width: 150px; text-align: center">Ghi chú</th>
                            <th width="10%" style="min-width: 170px;">Pthức thanh toán</th>
                            <th width="10%" style="min-width: 150px;">Ngày đặt hàng</th>
                            <th width="10%" style="min-width: 150px;">Ngày giao hàng</th>
                            <th width="10%" style="min-width: 180px;">Trạng thái</th>
                            <th width="15%" style="min-width: 180px;" class="action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        displayTable4($conn, $searchQuery, $searchType, $searchText);
                        $id = NextID($conn, "DonHang", "D", "MaDon");
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tfoot">
                <button id="resetbtn"><a href="?">Reset</a></button>
                <button id="addbtn" onclick="openPopup(this)"> + Thêm mới</button>
            </div>
        </div>

        <div id="overlay" style="display: none;"></div>
        <div class="popup" style="display: none;">
            <div class="popup-head">
                <span id='popup-type'></span>
                <button onclick="closePopup()" id="close">x</button>
            </div>
            <div class="popup-content">
                <form onsubmit="return checkloi_donhang()" class="add" name="donhang" method="POST"
                    action="xulidonhang.php?action=add" style="display: none;">
                    <div class="form-group">
                        <label>Mã đơn</label>
                        <input name="id" type="text" disabled value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                        <label>Khách hàng:</label>
                        <select name="optionKH" id="optionKH">
                            <option>Chọn loại khách hàng</option>
                            <option value="Khách hàng mới">Khách hàng mới</option>
                            <option value="Khách hàng cũ">Khách hàng cũ</option>
                        </select>
                        <div class="error"></div>

                        <div class="khachhangmoi" style="display: none;">
                            <?php
                            $id_KH = NextID($conn, "KhachHang", "K", "MaKhachHang");
                            ?>
                            <div class='form-group'>
                                <label>Mã khách hàng:</label>
                                <input name="idKHmoi" id="idKHmoi" type="text" value="<?php echo $id_KH ?>" readonly>
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Tên khách hàng:</label>
                                <input name="nameKHmoi" id="nameKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Số điện thoại</label>
                                <input name="numberKHmoi" id="numberKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Email</label>
                                <input name="mailKHmoi" id="mailKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Địa chỉ</label>
                                <input name="addrKHmoi" id="addrKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="khachhangcu" style="display: none;">
                            <div class='form-group'>
                                <label>Mã khách hàng: </label>
                                <input list="listKH" id='searchKH' name="idKH" type="text" value="" placeholder="Tìm khách hàng bằng sđt">
                                <datalist id="listKH">
                                    <?php
                                    $columns3 = ['MaKhachHang', 'SoDienThoai', 'TenKhachHang', 'DiaChi'];
                                    $all_KH = layTatCaDuLieu($conn, $columns3, 'KhachHang');
                                    foreach ($all_KH as $KH) {
                                        echo "<option value='" . $KH['MaKhachHang'] . "'>" . $KH['SoDienThoai'] . " _ " . $KH['TenKhachHang'] . " _ " . $KH['DiaChi'] . "</option>";
                                    }
                                    ?>
                                </datalist>
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Thêm sản phẩm: </label>
                        <input list="productList" id="productSearch" type="text" value="" placeholder="Tìm sản phẩm" autocomplete="off">
                        <datalist id="productList">
                            <?php
                            $columns4 = ['MaSanPham', 'TenSanPham', 'GiaSanPham'];
                            $all_pet = layTatCaDuLieu($conn, $columns4, 'ThuCung', 'TinhTrang=\'Còn\'');
                            foreach ($all_pet as $pet) {
                                echo "<option value='" . $pet['MaSanPham'] . "'>" . $pet['TenSanPham'] . " _ " . $pet['GiaSanPham'] . "</option>";
                            }
                            ?>
                        </datalist>
                        <button id="addproduct" type="button" onclick="addProduct(this)">+ Thêm sản phẩm</button>
                        <div class="error"></div>

                        <table id="productTable" style="width: 100%; display: none;">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th width='120px' style="text-align:center;">Giá</th>
                                    <th width='90px' style="text-align:center;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div id='tong' style="display: none;">Tổng giá trị đơn hàng: <b id='tongdonhangtext'>0</b> vnđ</div>

                        <input type="number" name="tongdonhang" id='tongdonhang' hidden value="0">
                    </div>

                    <div class="form-group">
                        <label>Ghi chú: </label>
                        <textarea name="gchu"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Phương thức thanh toán: </label>
                        <select name="pthuc">
                            <option>Chọn phương thức</option>
                            <option value="Tiền mặt">Tiền mặt</option>
                            <option value="Chuyển khoản">Chuyển khoản</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <button id="submit" type="submit">Thêm mới</button>
                </form>

                <form onsubmit="return checkloi_donhang_edit()" class="edit" name="donhangedit" method="POST"
                    action="xulidonhang.php?action=edit" style="display: none;">
                    <div class="form-group">
                        <label>Mã đơn</label>
                        <input name="id" type="text" readonly value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                        <label>Khách hàng:</label>
                        <select name="optionKH" id="optionKH">
                            <option>Chọn loại khách hàng</option>
                            <option value="Khách hàng mới">Khách hàng mới</option>
                            <option value="Khách hàng cũ">Khách hàng cũ</option>
                        </select>
                        <div class="error"></div>

                        <div class="khachhangmoi" style="display: none;">
                            <?php
                            $id_KH = NextID($conn, "KhachHang", "K", "MaKhachHang");
                            ?>
                            <div class='form-group'>
                                <label>Mã khách hàng:</label>
                                <input name="idKHmoi" id="idKHmoi" type="text" value="<?php echo $id_KH ?>" readonly>
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Tên khách hàng:</label>
                                <input name="nameKHmoi" id="nameKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Số điện thoại</label>
                                <input name="numberKHmoi" id="numberKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Email</label>
                                <input name="mailKHmoi" id="mailKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>

                            <div class='form-group'>
                                <label>Địa chỉ</label>
                                <input name="addrKHmoi" id="addrKHmoi" type="text" value="">
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="khachhangcu" style="display: none;">
                            <div class='form-group'>
                                <label>Mã khách hàng: </label>
                                <input list="listKH" id='searchKH' name="idKH" type="text" value="" placeholder="Tìm khách hàng bằng sđt">
                                <datalist id="listKH">
                                    <?php
                                    $columns3 = ['MaKhachHang', 'SoDienThoai', 'TenKhachHang', 'DiaChi'];
                                    $all_KH = layTatCaDuLieu($conn, $columns3, 'KhachHang');
                                    foreach ($all_KH as $KH) {
                                        echo "<option value='" . $KH['MaKhachHang'] . "'>" . $KH['SoDienThoai'] . " _ " . $KH['TenKhachHang'] . " _ " . $KH['DiaChi'] . "</option>";
                                    }
                                    ?>
                                </datalist>
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Thêm sản phẩm: </label>
                        <input list="productList" id="productSearch" type="text" value="" placeholder="Tìm sản phẩm" autocomplete="off">
                        <datalist id="productList">
                            <?php
                            $columns4 = ['MaSanPham', 'TenSanPham', 'GiaSanPham'];
                            $all_pet = layTatCaDuLieu($conn, $columns4, 'ThuCung', 'TinhTrang=\'Còn\'');
                            foreach ($all_pet as $pet) {
                                echo "<option value='" . $pet['MaSanPham'] . "'>" . $pet['TenSanPham'] . " _ " . $pet['GiaSanPham'] . "</option>";
                            }
                            ?>
                        </datalist>
                        <button id="addproduct" type="button" onclick="addProduct(this)">+ Thêm sản phẩm</button>
                        <div class="error"></div>

                        <table id="productTable" style="width: 100%; display: none;">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th width='120px' style="text-align:center;">Giá</th>
                                    <th width='90px' style="text-align:center;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div id='tong' style="display: none;">Tổng giá trị đơn hàng: <b id='tongdonhangtext'>0</b> vnđ</div>

                        <input type="number" name="tongdonhang" id='tongdonhang' hidden value="0">
                    </div>

                    <div class="form-group">
                        <label>Ghi chú: </label>
                        <textarea name="gchu"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Phương thức thanh toán: </label>
                        <select name="pthuc">
                            <option>Chọn phương thức</option>
                            <option value="Tiền mặt">Tiền mặt</option>
                            <option value="Chuyển khoản">Chuyển khoản</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái: </label>
                        <select name="trangthai">
                            <option value="Đã đặt hàng">Đã đặt hàng</option>
                            <option value="Đã xác nhận">Đã xác nhận</option>
                            <option value="Đang giao">Đang giao hàng</option>
                            <option value="Đã giao thành công">Đã giao hàng thành công</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <button id="submit" type="submit">Sửa</button>
                </form>
            </div>
        </div>

        <div id="dadat" class="tabcontent" style="display: none;">
            <form class="search" method="GET">
                <div class="tags">
                    <label>Tìm theo:</label>
                    <select class="search-type" name="searchType">
                        <option value="MaDon" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaDon' ? 'selected' : ''; ?>>Mã đơn</option>
                        <option value="MaKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaKhachHang' ? 'selected' : ''; ?>>Mã khách hàng</option>
                        <option value="TenKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenKhachHang' ? 'selected' : ''; ?>>Tên khách hàng</option>
                        <option value="SoDienThoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'SoDienThoai' ? 'selected' : ''; ?>>Số điện thoại</option>
                        <option value="Email" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'Email' ? 'selected' : ''; ?>>Email</option>
                        <option value="DiaChi" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'DiaChi' ? 'selected' : ''; ?>>Địa chỉ</option>
                        <option value="PhuongThucThanhToan" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'PhuongThucThanhToan' ? 'selected' : ''; ?>>Phương thức thanh toán</option>
                        <option value="NgayDatHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayDatHang' ? 'selected' : ''; ?>>Ngày đặt hàng</option>
                        <option value="NgayGiaoHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayGiaoHang' ? 'selected' : ''; ?>>Ngày giao hàng</option>
                        <option value="TrangThai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TrangThai' ? 'selected' : ''; ?>>Trạng thái</option>
                        <option value="TenSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenSanPham' ? 'selected' : ''; ?>>Tên sản phẩm</option>
                    </select>
                    <div class="hienthi">
                        <?php
                        displayCount3($conn, 'Đã đặt hàng', $searchType, $searchText);
                        ?>
                    </div>
                </div>
                <div class="timkiem">
                    <div class="row1">
                        <input type="text" placeholder="Nhập nội dung tìm kiếm..." id="searchtext" name="searchtext" value="<?php echo $searchText ?>">
                        <button id="searchbtn">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="tble">
                <table class="donhang">
                    <thead>
                        <tr>
                            <th width="5%" style="min-width: 80px;">Mã đơn</th>
                            <th width="10%" style="min-width: 70px;">Mã KH</th>
                            <th width="10%" style="min-width: 180px;">Tên khách hàng</th>
                            <th width="10%" style="min-width: 140px; text-align:center">Số điện thoại</th>
                            <th width="10%" style="min-width: 160px; text-align:center">Email</th>
                            <th width="10%" style="min-width: 220px; text-align:center">Địa chỉ</th>
                            <th width="10%" style="min-width: 150px; text-align:center">Tổng giá trị</th>
                            <th width="10%" style="min-width: 150px; text-align: center">Ghi chú</th>
                            <th width="10%" style="min-width: 170px;">Pthức thanh toán</th>
                            <th width="10%" style="min-width: 150px;">Ngày đặt hàng</th>
                            <th width="10%" style="min-width: 150px;">Ngày giao hàng</th>
                            <th width="10%" style="min-width: 180px;">Trạng thái</th>
                            <th width="15%" style="min-width: 260px;" class="action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        displayTable5($conn, 'Đã đặt hàng', $searchType, $searchText);
                        $id = NextID($conn, "DonHang", "D", "MaDon");
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tfoot">
                <button id="resetbtn"><a href="?">Reset</a></button>
                <button id="addbtn" onclick="openPopup(this)"> + Thêm mới</button>
            </div>
        </div>


        <div id="daxacnhan" class="tabcontent" style="display: none;">
            <form class="search" method="GET">
                <div class="tags">
                    <label>Tìm theo:</label>
                    <select class="search-type" name="searchType">
                        <option value="MaDon" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaDon' ? 'selected' : ''; ?>>Mã đơn</option>
                        <option value="MaKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaKhachHang' ? 'selected' : ''; ?>>Mã khách hàng</option>
                        <option value="TenKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenKhachHang' ? 'selected' : ''; ?>>Tên khách hàng</option>
                        <option value="SoDienThoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'SoDienThoai' ? 'selected' : ''; ?>>Số điện thoại</option>
                        <option value="Email" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'Email' ? 'selected' : ''; ?>>Email</option>
                        <option value="DiaChi" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'DiaChi' ? 'selected' : ''; ?>>Địa chỉ</option>
                        <option value="PhuongThucThanhToan" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'PhuongThucThanhToan' ? 'selected' : ''; ?>>Phương thức thanh toán</option>
                        <option value="NgayDatHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayDatHang' ? 'selected' : ''; ?>>Ngày đặt hàng</option>
                        <option value="NgayGiaoHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayGiaoHang' ? 'selected' : ''; ?>>Ngày giao hàng</option>
                        <option value="TrangThai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TrangThai' ? 'selected' : ''; ?>>Trạng thái</option>
                        <option value="TenSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenSanPham' ? 'selected' : ''; ?>>Tên sản phẩm</option>
                    </select>
                    <div class="hienthi">
                        <?php
                        displayCount3($conn, 'Đã xác nhận', $searchType, $searchText);
                        ?>
                    </div>
                </div>
                <div class="timkiem">
                    <div class="row1">
                        <input type="text" placeholder="Nhập nội dung tìm kiếm..." id="searchtext" name="searchtext" value="<?php echo $searchText ?>">
                        <button id="searchbtn">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="tble">
                <table class="donhang">
                    <thead>
                        <tr>
                            <th width="5%" style="min-width: 80px;">Mã đơn</th>
                            <th width="10%" style="min-width: 70px;">Mã KH</th>
                            <th width="10%" style="min-width: 180px;">Tên khách hàng</th>
                            <th width="10%" style="min-width: 140px; text-align:center">Số điện thoại</th>
                            <th width="10%" style="min-width: 160px; text-align:center">Email</th>
                            <th width="10%" style="min-width: 220px; text-align:center">Địa chỉ</th>
                            <th width="10%" style="min-width: 150px; text-align:center">Tổng giá trị</th>
                            <th width="10%" style="min-width: 150px; text-align: center">Ghi chú</th>
                            <th width="10%" style="min-width: 170px;">Pthức thanh toán</th>
                            <th width="10%" style="min-width: 150px;">Ngày đặt hàng</th>
                            <th width="10%" style="min-width: 150px;">Ngày giao hàng</th>
                            <th width="10%" style="min-width: 180px;">Trạng thái</th>
                            <th width="15%" style="min-width: 260px;" class="action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        displayTable5($conn, 'Đã xác nhận', $searchType, $searchText);
                        $id = NextID($conn, "DonHang", "D", "MaDon");
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tfoot">
                <button id="resetbtn" style="margin: 0 20px;"><a href="?">Reset</a></button>
            </div>
        </div>


        <div id="danggiao" class="tabcontent" style="display: none;">
            <form class="search" method="GET">
                <div class="tags">
                    <label>Tìm theo:</label>
                    <select class="search-type" name="searchType">
                        <option value="MaDon" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaDon' ? 'selected' : ''; ?>>Mã đơn</option>
                        <option value="MaKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaKhachHang' ? 'selected' : ''; ?>>Mã khách hàng</option>
                        <option value="TenKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenKhachHang' ? 'selected' : ''; ?>>Tên khách hàng</option>
                        <option value="SoDienThoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'SoDienThoai' ? 'selected' : ''; ?>>Số điện thoại</option>
                        <option value="Email" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'Email' ? 'selected' : ''; ?>>Email</option>
                        <option value="DiaChi" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'DiaChi' ? 'selected' : ''; ?>>Địa chỉ</option>
                        <option value="PhuongThucThanhToan" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'PhuongThucThanhToan' ? 'selected' : ''; ?>>Phương thức thanh toán</option>
                        <option value="NgayDatHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayDatHang' ? 'selected' : ''; ?>>Ngày đặt hàng</option>
                        <option value="NgayGiaoHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayGiaoHang' ? 'selected' : ''; ?>>Ngày giao hàng</option>
                        <option value="TrangThai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TrangThai' ? 'selected' : ''; ?>>Trạng thái</option>
                        <option value="TenSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenSanPham' ? 'selected' : ''; ?>>Tên sản phẩm</option>
                    </select>
                    <div class="hienthi">
                        <?php
                        displayCount3($conn, "Đang giao", $searchType, $searchText);
                        ?>
                    </div>
                </div>
                <div class="timkiem">
                    <div class="row1">
                        <input type="text" placeholder="Nhập nội dung tìm kiếm..." id="searchtext" name="searchtext" value="<?php echo $searchText ?>">
                        <button id="searchbtn">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="tble">
                <table class="donhang">
                    <thead>
                        <tr>
                            <th width="5%" style="min-width: 80px;">Mã đơn</th>
                            <th width="10%" style="min-width: 70px;">Mã KH</th>
                            <th width="10%" style="min-width: 180px;">Tên khách hàng</th>
                            <th width="10%" style="min-width: 140px; text-align:center">Số điện thoại</th>
                            <th width="10%" style="min-width: 160px; text-align:center">Email</th>
                            <th width="10%" style="min-width: 220px; text-align:center">Địa chỉ</th>
                            <th width="10%" style="min-width: 150px; text-align:center">Tổng giá trị</th>
                            <th width="10%" style="min-width: 150px; text-align: center">Ghi chú</th>
                            <th width="10%" style="min-width: 170px;">Pthức thanh toán</th>
                            <th width="10%" style="min-width: 150px;">Ngày đặt hàng</th>
                            <th width="10%" style="min-width: 150px;">Ngày giao hàng</th>
                            <th width="10%" style="min-width: 180px;">Trạng thái</th>
                            <th width="15%" style="min-width: 260px;" class="action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        displayTable5($conn, "Đang giao", $searchType, $searchText);
                        $id = NextID($conn, "DonHang", "D", "MaDon");
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tfoot">
                <button id="resetbtn" style="margin: 0 20px;"><a href="?">Reset</a></button>
            </div>
        </div>


        <div id="dagiao" class="tabcontent" style="display: none;">
            <form class="search" method="GET">
                <div class="tags">
                    <label>Tìm theo:</label>
                    <select class="search-type" name="searchType">
                        <option value="MaDon" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaDon' ? 'selected' : ''; ?>>Mã đơn</option>
                        <option value="MaKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaKhachHang' ? 'selected' : ''; ?>>Mã khách hàng</option>
                        <option value="TenKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenKhachHang' ? 'selected' : ''; ?>>Tên khách hàng</option>
                        <option value="SoDienThoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'SoDienThoai' ? 'selected' : ''; ?>>Số điện thoại</option>
                        <option value="Email" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'Email' ? 'selected' : ''; ?>>Email</option>
                        <option value="DiaChi" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'DiaChi' ? 'selected' : ''; ?>>Địa chỉ</option>
                        <option value="PhuongThucThanhToan" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'PhuongThucThanhToan' ? 'selected' : ''; ?>>Phương thức thanh toán</option>
                        <option value="NgayDatHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayDatHang' ? 'selected' : ''; ?>>Ngày đặt hàng</option>
                        <option value="NgayGiaoHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NgayGiaoHang' ? 'selected' : ''; ?>>Ngày giao hàng</option>
                        <option value="TrangThai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TrangThai' ? 'selected' : ''; ?>>Trạng thái</option>
                        <option value="TenSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenSanPham' ? 'selected' : ''; ?>>Tên sản phẩm</option>
                    </select>
                    <div class="hienthi">
                        <?php
                        displayCount3($conn, "Đã giao thành công", $searchType, $searchText);
                        ?>
                    </div>
                </div>
                <div class="timkiem">
                    <div class="row1">
                        <input type="text" placeholder="Nhập nội dung tìm kiếm..." id="searchtext" name="searchtext" value="<?php echo $searchText ?>">
                        <button id="searchbtn">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="tble">
                <table class="donhang">
                    <thead>
                        <tr>
                            <th width="5%" style="min-width: 80px;">Mã đơn</th>
                            <th width="10%" style="min-width: 70px;">Mã KH</th>
                            <th width="10%" style="min-width: 180px;">Tên khách hàng</th>
                            <th width="10%" style="min-width: 140px; text-align:center">Số điện thoại</th>
                            <th width="10%" style="min-width: 160px; text-align:center">Email</th>
                            <th width="10%" style="min-width: 220px; text-align:center">Địa chỉ</th>
                            <th width="10%" style="min-width: 150px; text-align:center">Tổng giá trị</th>
                            <th width="10%" style="min-width: 150px; text-align: center">Ghi chú</th>
                            <th width="10%" style="min-width: 170px;">Pthức thanh toán</th>
                            <th width="10%" style="min-width: 150px;">Ngày đặt hàng</th>
                            <th width="10%" style="min-width: 150px;">Ngày giao hàng</th>
                            <th width="10%" style="min-width: 180px;">Trạng thái</th>
                            <th width="15%" style="min-width: 140px;" class="action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        displayTable6($conn, "Đã giao thành công", $searchType, $searchText);
                        $id = NextID($conn, "DonHang", "D", "MaDon");
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tfoot">
                <button id="resetbtn" style="margin: 0 20px;"><a href="?">Reset</a></button>
            </div>
        </div>

    </div>
</body>

</html>