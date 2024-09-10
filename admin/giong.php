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
    <title>Quản lí giống</title>
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
                    <option value="MaGiong" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaGiong' ? 'selected' : ''; ?>>Mã giống</option>
                    <option value="TenGiong" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenGiong' ? 'selected' : ''; ?>>Tên giống</option>
                    <option value="TenLoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenLoai' ? 'selected' : ''; ?>>Tên Loài</option>
                    <option value="KieuLong" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'KieuLong' ? 'selected' : ''; ?>>Kiểu lông</option>
                    <option value="KichThuoc_Mau" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'KichThuoc_Mau' ? 'selected' : ''; ?>>Kích thước/ Màu</option>
                    <option value="MucDoVanDong_RungLong" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MucDoVanDong_RungLong' ? 'selected' : ''; ?>>Mức độ vận động/ Rụng lông</option>
                    <option value="NhomCho_VeNgoai" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'NhomCho_VeNgoai' ? 'selected' : ''; ?>>Nhóm chó/ Vẻ ngoài</option>
                    <option value="DoPhoBien" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'DoPhoBien' ? 'selected' : ''; ?>>Độ phổ biến</option>
                    <option value="TinhTrang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TinhTrang' ? 'selected' : ''; ?>>Tình trạng</option>
                </select>
                <div class="hienthi">
                    <?php
                    include 'connect.php';
                    include 'timkiem.php';
                    include "xulitable.php";
                    displayCount($conn, $searchQuery, "Giong", "giống");
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
            <table class="giong">
                <thead>
                    <tr>
                        <th width="5%" style="min-width: 80px;">Mã Giống</th>
                        <th width="10%" style="min-width: 180px;">Tên giống</th>
                        <th width="10%" style="min-width: 100px;">Tên loài</th>
                        <th width="10%" style="min-width: 100px;">Kiểu lông</th>
                        <th width="10%" style="min-width: 120px;">Kích thước/ Màu</th>
                        <th width="10%" style="min-width: 180px;">Mức độ vận động/ Rụng lông</th>
                        <th width="10%" style="min-width: 120px;">Nhóm chó/ Vẻ ngoài</th>
                        <th width="10%" style="min-width: 120px;">Độ phổ biến</th>
                        <th width="10%" style="min-width: 120px;">Tình trạng</th>
                        <th width="15%" style="min-width: 120px;" class="action">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $columns = ['MaGiong', 'TenGiong', 'TenLoai', 'KieuLong', 'KichThuoc_Mau', 'MucDoVanDong_RungLong', 'NhomCho_VeNgoai', 'DoPhoBien', 'TinhTrang'];
                    displayTable2($conn, "Giong", $columns, $searchQuery, 'xuligiong.php');
                    $id = NextID($conn, "Giong", "G", "MaGiong");
                    $columnsString = implode(',', $columns); //Thêm , để nối columns thành 1 chuỗi
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tfoot">
            <button id="resetbtn"><a href="?">Reset</a></button>
            <button id="addbtn" onclick="openPopup(this,'Giong')"> + Thêm mới</button>
        </div>
        <div id="overlay" style="display: none;"></div>
        <div class="popup" style="display: none;">
            <div class="popup-head">
                <span id='popup-type'></span>
                <button onclick="closePopup()" id="close">x</button>
            </div>
            <div class="popup-content">
                <form onsubmit="return checkloi_giong()" class="add" name="giong" method="POST"
                    action="xuligiong.php?action=add" style="display: none;">
                    <div class="form-group">
                        <label>Mã giống:</label>
                        <input name="id" type="text" disabled value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                        <label>Tên giống:</label>
                        <input name="name" type="text" value="">
                        <div class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Tên loài:</label>
                        <select name="loai" id="loai">
                            <option>Chọn loài</option>
                            <option value="Chó">Chó</option>
                            <option value="Mèo">Mèo</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Kiểu lông:</label>
                        <select name="kieulong">
                            <option>Chọn kiểu lông</option>
                            <option value="Dài">Dài</option>
                            <option value="Trung bình">Trung bình</option>
                            <option value="Ngắn">Ngắn</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="kichthuoc" style="display: none;">
                        <label>Kích thước:</label>
                        <select name="kichthuoc">
                            <option>Chọn kích thước</option>
                            <option value="Lớn">Lớn</option>
                            <option value="Nhỏ">Nhỏ</option>
                            <option value="Trung">Trung</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="mau" style="display: none;">
                        <label>Màu:</label>
                        <select name="mau">
                            <option>Chọn màu</option>
                            <option value="Một màu">Một màu</option>
                            <option value="Nhiều màu">Nhiều màu</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="vandong" style="display: none;">
                        <label>Mức độ vận động:</label>
                        <select name="vandong">
                            <option>Chọn mức độ</option>
                            <option value="Năng động">Năng động</option>
                            <option value="Hoạt bát">Hoạt bát</option>
                            <option value="Trầm lặng">Trầm lặng</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="runglong" style="display: none;">
                        <label>Mức độ rụng lông</label>
                        <select name="runglong">
                            <option>Chọn mức độ</option>
                            <option value="Ít">Ít</option>
                            <option value="Nhiều">Nhiều</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="nhomcho" style="display: none;">
                        <label>Nhóm chó:</label>
                        <select name="nhomcho">
                            <option>Chọn nhóm chó</option>
                            <option value="Chó kéo xe">Chó kéo xe</option>
                            <option value="Chó cảnh">Chó cảnh</option>
                            <option value="Chó mặt xệ">Chó mặt xệ</option>
                            <option value="Chó săn">Chó săn</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="vengoai" style="display: none;">
                        <label>Vẻ ngoài:</label>
                        <select name="vengoai">
                            <option>Chọn vẻ ngoài</option>
                            <option value="Đáng yêu">Đáng yêu</option>
                            <option value="Quý tộc">Quý tộc</option>
                            <option value="Độc lạ">Độc lạ</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Độ phổ biến:</label>
                        <select name="phobien">
                            <option>Chọn độ phổ biến</option>
                            <option value="Hot">Hot</option>
                            <option value="Trung bình">Trung bình</option>
                            <option value="Độc hiếm">Độc hiếm</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <button id="submit" type="submit">Thêm mới</button>
                </form>

                <form onsubmit="return checkloi_giong_edit()" class="edit" name="giongedit" method="POST"
                    action="xuligiong.php?action=edit" style="display: none;">
                    <div class="form-group">
                        <label>Mã giống:</label>
                        <input name="id" type="text" readonly value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                        <label>Tên giống:</label>
                        <input name="name" type="text" value="">
                        <div class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Tên loài:</label>
                        <select name="loai" id="loai">
                            <option>Chọn loài</option>
                            <option value="Chó">Chó</option>
                            <option value="Mèo">Mèo</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group">
                        <label>Kiểu lông:</label>
                        <select name="kieulong">
                            <option>Chọn kiểu lông</option>
                            <option value="Dài">Dài</option>
                            <option value="Trung bình">Trung bình</option>
                            <option value="Ngắn">Ngắn</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="kichthuoc" style="display: none;">
                        <label>Kích thước:</label>
                        <select name="kichthuoc">
                            <option>Chọn kích thước</option>
                            <option value="Lớn">Lớn</option>
                            <option value="Nhỏ">Nhỏ</option>
                            <option value="Trung">Trung</option>
                        </select>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="mau" style="display: none;">
                        <label>Màu:</label>
                        <select name="mau">
                            <option>Chọn màu</option>
                            <option value="Một màu">Một màu</option>
                            <option value="Nhiều màu">Nhiều màu</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="vandong" style="display: none;">
                        <label>Mức độ vận động:</label>
                        <select name="vandong">
                            <option>Chọn mức độ</option>
                            <option value="Năng động">Năng động</option>
                            <option value="Hoạt bát">Hoạt bát</option>
                            <option value="Trầm lặng">Trầm lặng</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="runglong" style="display: none;">
                        <label>Mức độ rụng lông</label>
                        <select name="runglong">
                            <option>Chọn mức độ</option>
                            <option value="Ít">Ít</option>
                            <option value="Nhiều">Nhiều</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="nhomcho" style="display: none;">
                        <label>Nhóm chó:</label>
                        <select name="nhomcho">
                            <option>Chọn nhóm chó</option>
                            <option value="Chó kéo xe">Chó kéo xe</option>
                            <option value="Chó cảnh">Chó cảnh</option>
                            <option value="Chó mặt xệ">Chó mặt xệ</option>
                            <option value="Chó săn">Chó săn</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="vengoai" style="display: none;">
                        <label>Vẻ ngoài:</label>
                        <select name="vengoai">
                            <option>Chọn vẻ ngoài</option>
                            <option value="Đáng yêu">Đáng yêu</option>
                            <option value="Quý tộc">Quý tộc</option>
                            <option value="Độc lạ">Độc lạ</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="phobien">
                        <label>Độ phổ biến:</label>
                        <select name="phobien">
                            <option>Chọn độ phổ biến</option>
                            <option value="Hot">Hot</option>
                            <option value="Trung bình">Trung bình</option>
                            <option value="Độc hiếm">Độc hiếm</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="form-group" id="tinhtrang">
                        <label>Tình trạng:</label>
                        <select name="tinhtrang">
                            <option value="Đang bán">Đang bán</option>
                            <option value="Dừng bán">Dừng bán</option>
                        </select>
                    </div>

                    <button id="submit" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>