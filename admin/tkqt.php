<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách quản trị</title>
    <link rel="stylesheet" href="../css/table.css">
</head>

<body>
    <div class="main" id="mainA">
        <form class="search" method="GET" action="">
            <div class="tags">
                <?php
                    include 'connect.php';
                    include 'timkiem.php';
                    include "xulitable.php";
                ?>
                <label>Tìm theo:</label>
                <select class="search-type" name="searchType">
                    <option value="MaTaiKhoan" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'MaTaiKhoan' ? 'selected' : ''; ?>>Mã tài khoản</option>
                    <option value="TenTaiKhoan" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'TenTaiKhoan' ? 'selected' : ''; ?>>Tên tài khoản</option>
                    <option value="Email" <?php echo isset($_GET['searchType']) && $_GET['searchType'] == 'Email' ? 'selected' : ''; ?>>Email</option>
                </select>
                <div class="hienthi">
                    <?php
                    displayCount($conn,$searchQuery,"tkquantri","tài khoản quản trị")
                    ?>
                </div>
            </div>
            <div class="timkiem">
                <div class="row1">
                    <input type="text" placeholder="Nhập nội dung tìm kiếm..." name="searchtext" id="searchtext">
                    <button id="searchbtn">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <div class="tble">
            <table class="tkqt">
                <thead>
                    <tr>
                        <th width="15%">Mã TK</th>
                        <th>Tên tài khoản</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $columns = ['MaTaiKhoan','TenTaiKhoan','Email'];
                        displayTable($conn,"tkquantri",$columns,$searchQuery);
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tfoot">
            <button id="resetbtn"><a href="?">Reset</a></button>
            <button id="addbtn" disabled> + Thêm mới</button>
        </div>
    </div>
</body>

</html>