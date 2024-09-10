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
    <title>Quản lí khách hàng</title>
    <link rel="stylesheet" href="../css/table.css">
    <script src="../js/checkloi.js"></script>
    <script src="../js/table.js"></script>
</head>
<body>
    <div class="main" id="mainA">
        <form class="search" method="GET">
            <div class="tags">
                <label>Tìm theo:</label>
                <select class="search-type" name="searchType">
                    <option value="MaKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'MaKhachHang' ? 'selected' : ''; ?>>Mã khách hàng</option>
                    <option value="TenKhachHang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'TenKhachHang' ? 'selected' : ''; ?>>Họ tên</option>
                    <option value="SoDienThoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'SoDienThoai' ? 'selected' : ''; ?>>Số điện thoại</option>
                    <option value="Email" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'Email' ? 'selected' : ''; ?>>Email</option>
                    <option value="DiaChi" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'DiaChi' ? 'selected' : ''; ?>>Địa chỉ</option>
                </select>
                <div class="hienthi">
                    <?php
                    include 'connect.php';
                    include 'timkiem.php';
                    include "xulitable.php";
                    displayCount($conn,$searchQuery,"khachhang","khách hàng");
                    ?>
                </div>
            </div>
            <div class="timkiem">
                <div class="row1">
                    <input type="text" placeholder="Nhập nội dung tìm kiếm..." id="searchtext" name="searchtext" value="<?php echo $searchText?>">
                    <button id="searchbtn">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <div class="tble">
            <table class="khachhang">
                <thead>
                    <tr>
                        <th width="8%" style="min-width: 80px;">Mã KH</th>
                        <th width="15%" style="min-width: 150px;">Họ và tên</th>
                        <th width="10%" style="min-width: 150px;">Số Điện Thoại</th>
                        <th width="38%" style="min-width: 200px;">Địa chỉ</th>
                        <th width="15%" style="min-width: 100px;">Email</th>
                        <th width="15%" style="min-width: 120px;" class="action">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $columns = ['MaKhachHang','TenKhachHang','SoDienThoai','DiaChi','Email'];
                        displayTable2($conn,"khachhang",$columns,$searchQuery,'xulikhachhang.php');
                        $id = NextID($conn,"khachhang","K","MaKhachHang");
                        $columnsString = implode(',',$columns); //Thêm , để nối columns thành 1 chuỗi
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tfoot">
            <button id="resetbtn"><a href="?">Reset</a></button>
            <button id="addbtn" onclick="openPopup(this,'khachhang')"> + Thêm mới</button>
        </div>
    </div>
    <div id="overlay" style="display: none;"></div>
    <div class="popup" style="display: none;">
        <div class="popup-head">
            <span id='popup-type'></span>
            <button onclick="closePopup()" id="close">x</button>
        </div>
        <div class="popup-content">
            <form onsubmit="return checkloi_khachhang()" class="add" name="add" method="POST" 
            action="xulikhachhang.php?action=add" style="display: none;">
                <div class="form-group">
                    <label>Mã khách hàng:</label>
                    <input name="id" type="text" disabled value="<?php echo $id?>">
                </div>
                <div class="form-group">
                    <label>Tên khách hàng:</label>
                    <input name="name" type="text" value="">
                    <div class="error"></div>
                </div>
                
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input name="number" type="text" value="">
                    <div class="error"></div>
                </div>
                
                <div class="form-group">
                    <label>Địa chỉ:</label>
                    <input name="addr" type="text" value="">
                    <div class="error"></div>
                </div>
                
                <div class="form-group">
                    <label>Email:</label>
                    <input name="mail" type="text" value="">
                    <div class="error"></div>
                </div>                   
                <button id="submit" type="submit">Thêm mới</button>
            </form>

            <form onsubmit="return checkloi_khachhang_edit()" class="edit" name="edit" method="POST" 
            action="xulikhachhang.php?action=edit" style="display: none;">
                <div class="form-group">
                    <label>Mã khách hàng:</label>
                    <input name="id" type="text" readonly value="">
                </div>
                <div class="form-group">
                    <label>Tên khách hàng:</label>
                    <input name="name" type="text" value="">
                    <div class="error"></div>
                </div>
                
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input name="number" type="text" value="">
                    <div class="error"></div>
                </div>
                
                <div class="form-group">
                    <label>Địa chỉ:</label>
                    <input name="addr" type="text" value="">
                    <div class="error"></div>
                </div>
                
                <div class="form-group">
                    <label>Email:</label>
                    <input name="mail" type="text" value="">
                    <div class="error"></div>
                </div>
                
                <button id="submit" type="submit">Sửa</button>
            </form>
        </div>
    </div>
</body>
</html>