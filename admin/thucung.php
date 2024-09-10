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
    <div class="main" id="mainA">
        <form class="search" method="GET" name="form1">
            <div class="tags">
                <label>Tìm theo:</label>
                <select class="search-type" name="searchType">
                    <option value="MaSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaSanPham' ? 'selected' : ''; ?>>Mã sản phẩm</option>
                    <option value="TenSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TenSanPham' ? 'selected' : ''; ?>>Tên sản phẩm</option>
                    <option value="MaGiong" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'MaGiong' ? 'selected' : ''; ?>>Mã giống</option>
                    <option value="GioiTinh" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'GioiTinh' ? 'selected' : ''; ?>>Giới tính</option>
                    <option value="Tuoi" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'Tuoi' ? 'selected' : ''; ?>>Tuổi</option>
                    <option value="Mau" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'Mau' ? 'selected' : ''; ?>>Màu</option>
                    <option value="TiemPhong" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TiemPhong' ? 'selected' : ''; ?>>Tiêm phòng</option>
                    <option value="TayGiun" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TayGiun' ? 'selected' : ''; ?>>Tẩy Giun</option>
                    <option value="TinhTrang" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'TinhTrang' ? 'selected' : ''; ?>>Tình trạng</option>
                    <option value="GiaSanPham" <?php echo isset($_GET['searchType']) && $_GET['searchType'] === 'GiaSanPham' ? 'selected' : ''; ?>>Giá sản phẩm</option>
                </select>
                <div class="hienthi">
                    <?php
                    include 'connect.php';
                    include 'timkiem.php';
                    include "xulitable.php";
                    displayCount($conn, $searchQuery, "ThuCung", "thú cưng");
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
            <table class="pets">
                <thead>
                    <tr>
                        <th width="5%" style="min-width: 90px;">Mã SP</th>
                        <th width="10%" style="min-width: 110px;">Mã giống</th>
                        <th width="10%" style="min-width: 200px;">Tên sản phẩm</th>
                        <th width="10%" style="min-width: 120px;">Ảnh</th>
                        <th width="10%" style="min-width: 100px; text-align:center;">Giới tính</th>
                        <th width="4%" style="min-width: 120px; text-align:center;">Tuổi</th>
                        <th width="6%" style="min-width: 120px; text-align:center;">Màu</th>
                        <th width="10%" style="min-width: 100px; text-align:center;">Tiêm phòng</th>
                        <th width="10%" style="min-width: 100px; text-align:center;">Tẩy giun</th>
                        <th width="10%" style="min-width: 100px; text-align:center;">Tình trạng</th>
                        <th width="10%" style="min-width: 150px; text-align:center;">Giá sản phẩm</th>
                        <th width="15%" style="min-width: 120px;" class="action">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $columns2 = ['MaSanPham', 'MaGiong', 'TenSanPham', 'Anh', 'GioiTinh', 'Tuoi', 'Mau', 'TiemPhong', 'TayGiun', 'TinhTrang', 'GiaSanPham'];
                    displayTable3($conn, "ThuCung", $columns2, $searchQuery, 'xulithucung.php');
                    $id = NextID($conn, "ThuCung", "S", "MaSanPham");
                    $columnsString = implode(',', $columns2); //Thêm , để nối columns thành 1 chuỗi
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tfoot">
            <button id="resetbtn"><a href="?">Reset</a></button>
            <button id="addbtn" onclick="openPopup(this,'ThuCung')"> + Thêm mới</button>
        </div>
        <div id="overlay" style="display: none;"></div>
        <div class="popup" style="display: none;">
            <div class="popup-head">
                <span id='popup-type'>Thêm mới</span>
                <button onclick="closePopup()" id="close">x</button>
            </div>
            <div class="popup-content">
                <form onsubmit="return checkloi_thucung()" class="add" name="thucung" method="POST" enctype="multipart/form-data"
                    action="xulithucung.php?action=add" style="display: none;">

                    <div class="phpsrc" style="display:none"></div>

                    <div class="form-group">
                        <label>Mã sản phẩm:</label>
                        <input name="id" type="text" disabled value="<?php echo $id ?>">
                    </div>

                    <div class="form-group">
                        <label>Mã giống:</label>
                        <input list="giong-list" type="text" id="filter" autocomplete="off" name="idgiong" placeholder="Tìm giống...">
                        <datalist id="giong-list">
                            <?php
                            $columns3 = ['MaGiong', 'TenGiong'];
                            $all_giong = layTatCaDuLieu($conn, $columns3, 'Giong', "TinhTrang = 'Đang bán'");
                            foreach ($all_giong as $giong) {
                                echo "<option value='" . $giong['MaGiong'] . "'>" . $giong['TenGiong'] . "</option>";
                            }
                            ?>
                        </datalist>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input name="name" type="text" value="">
                        <div class="error"></div>
                    </div>

                    <div class="form-group" id="upload">
                        <label>Ảnh:</label>
                        <input name="anh" type="file" value="" id="anh" accept="image/*">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Giới tính</label>
                        <select name="gioitinh">
                            <option>Chọn giới tính</option>
                            <option value="Đực">Đực</option>
                            <option value="Cái">Cái</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tuổi:</label>
                        <input name="tuoi" type="text" value="">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Màu:</label>
                        <input name="mau" type="text" value="">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tiêm phòng:</label>
                        <input name="tiemphong" type="number" value="" min="1" placeholder="Nhập số lần">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tẩy giun:</label>
                        <input name="taygiun" type="number" value="" min="1" placeholder="Nhập số lần">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Giá sản phẩm:</label>
                        <input name="gia" type="number" value="" min="100000">
                        <div class="error"></div>
                    </div>

                    <button id="submit" type="submit">Thêm mới</button>
                </form>

                <form onsubmit="return checkloi_thucung_edit()" class="edit" name="thucungedit" method="POST" enctype="multipart/form-data"
                    action="xulithucung.php?action=edit" style="display: none;">
                    <div class="phpsrc" style="display:none"></div>

                    <div class="form-group">
                        <label>Mã sản phẩm:</label>
                        <input name="id" type="text" readonly value="">
                    </div>

                    <div class="form-group">
                        <label>Mã giống:</label>
                        <input list="giong-list" type="text" id="filter" autocomplete="off" name="idgiong" placeholder="Tìm giống...">
                        <datalist id="giong-list">
                            <?php
                            $columns3 = ['MaGiong', 'TenGiong'];
                            $all_giong = layTatCaDuLieu($conn, $columns3, 'Giong', "TinhTrang = 'Đang bán'");
                            foreach ($all_giong as $giong) {
                                echo "<option value='" . $giong['MaGiong'] . "'>" . $giong['TenGiong'] . "</option>";
                            }
                            ?>
                        </datalist>
                    </div>

                    <div class="form-group">
                        <label>Tên sản phẩm:</label>
                        <input name="name" type="text" value="">
                        <div class="error"></div>
                    </div>

                    <div class="form-group" id="upload">
                        <label>Ảnh(thêm nếu muốn thay đổi ảnh):</label>
                        <input name="anh" type="file" value="" id="anh" accept="image/*">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Giới tính</label>
                        <select name="gioitinh">
                            <option>Chọn giới tính</option>
                            <option value="Đực">Đực</option>
                            <option value="Cái">Cái</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tuổi:</label>
                        <input name="tuoi" type="text" value="">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Màu:</label>
                        <input name="mau" type="text" value="">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tiêm phòng:</label>
                        <input name="tiemphong" type="number" value="" min="1" placeholder="Nhập số lần">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tẩy giun:</label>
                        <input name="taygiun" type="number" value="" min="1" placeholder="Nhập số lần">
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Tình trạng:</label>
                        <select name="tinhtrang">
                            <option value="Còn">Còn hàng</option>
                            <option value="Hết">Hết hàng</option>
                        </select>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label>Giá sản phẩm:</label>
                        <input name="gia" type="number" value="" min="100000">
                        <div class="error"></div>
                    </div>

                    <button id="submit" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>