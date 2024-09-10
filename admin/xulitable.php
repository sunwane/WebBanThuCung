<script src="../js/table.js"></script>
<?php
function displayCount($conn, $searchQuery, $tableName, $object) {
    $result = $conn->query("SELECT COUNT(*) AS count FROM $tableName $searchQuery");
    //num_rows trả về số dòng từ $result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Hiện có " . $row['count'] . " " . $object;
    } else {
        echo "Không có ". $object . " nào.";
    }
}

function displayCount2($conn, $searchQuery, $searchType, $searchText) {
    if ($searchType=='TenSanPham' && isset($searchText)){
        $sql = "SELECT COUNT(*) as count FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            WHERE 
            DonHang.MaDon IN (
                SELECT DISTINCT MaDon
                FROM ChiTietDonHang
                WHERE TenSanPham LIKE '%".$searchText."%'
            )";
    } else {
        $sql = "SELECT COUNT(*) AS count FROM DonHang $searchQuery";
    }
    $result = $conn->query($sql);
    //num_rows trả về số dòng từ $result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Hiện có " . $row['count'] . " đơn hàng";
    } else {
        echo "Không có đơn hàng nào.";
    }
}

function displayCount3($conn, $tabName, $searchType, $searchText) {
    if ($searchType=='TenSanPham'){
        $sql = "SELECT COUNT(*) as count FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            WHERE DonHang.TrangThai= '$tabName' AND DonHang.MaDon IN (
                SELECT DISTINCT MaDon
                FROM ChiTietDonHang
                WHERE TenSanPham LIKE '%".$searchText."%'
            )";
    } else if (!empty($searchType) && !empty(($searchText))){
        $sql = "SELECT COUNT(*) AS count FROM DonHang 
                WHERE DonHang.TrangThai='$tabName' 
                AND $searchType LIKE '%$searchText%' ";
    } else {
        $sql = "SELECT COUNT(*) AS count FROM DonHang WHERE DonHang.TrangThai='$tabName'";
    }
    $result = $conn->query($sql);
    //num_rows trả về số dòng từ $result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Hiện có " . $row['count'] . " đơn hàng";
    } else {
        echo "Không có đơn hàng nào.";
    }
}

function CountData($conn,$tableName,$searchQuery = "") {
    $result = $conn->query("SELECT COUNT(*) AS count FROM $tableName $searchQuery");
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return "Error: " . mysqli_error($conn);
    }
}
//table không action
function displayTable($conn, $tableName, $columns, $searchQuery = '') {
    $columnNames = implode(", ", $columns);
    $sql = "SELECT $columnNames FROM $tableName $searchQuery";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='" . count($columns)+1 . "'>Không tìm thấy kết quả phù hợp</td></tr>";
    }
}
//table có action
function displayTable2($conn, $tableName, $columns, $searchQuery = '',$file_xuli) {
    $columnNames = implode(", ", $columns);
    $sql = "SELECT $columnNames FROM $tableName $searchQuery";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<td>" . $row[$column] . "</td>";
            }
            echo "<td class='action'>
                <a id='editbtn' onclick=\"openPopup(this,'".$tableName."')\" href='#'>Sửa</a>
                <a id='deletebtn' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\" href='".$file_xuli."?action=delete&id=" . $row[$columns[0]] . "'>Xóa</a>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='" . count($columns) . "'>Không tìm thấy kết quả phù hợp</td></tr>";
    }
}
//table có ảnh
function displayTable3($conn, $tableName, $columns, $searchQuery = '',$file_xuli) {
    $columnNames = implode(", ", $columns);
    $sql = "SELECT $columnNames FROM $tableName $searchQuery";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row[$columns[0]] . "</td>";
            echo "<td>" . $row[$columns[1]] . "</td>";
            echo "<td>" . $row[$columns[2]] . "</td>";
            echo "<td><img src='../" . $row[$columns[3]] . "' alt='".$row[$columns[0]]."' style='width:100px;'></td>";
            echo "<td style='text-align: center;'>" . $row[$columns[4]] . "</td>";
            echo "<td style='text-align: center;'>" . $row[$columns[5]] . "</td>";
            echo "<td style='text-align: center;'>" . $row[$columns[6]] . "</td>";
            echo "<td style='text-align: center;'>" . $row[$columns[7]] . "</td>";
            echo "<td style='text-align: center;'>" . $row[$columns[8]] . "</td>";
            echo "<td style='text-align: center;'>" . $row[$columns[9]] . "</td>";
            echo "<td style='text-align: center;'>" . $row[$columns[10]] . "</td>";
            echo "<td class='action'>
                <a id='editbtn' onclick=\"openPopup(this,'".$tableName."')\" href='#'>Sửa</a>
                <a id='deletebtn' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\" href='".$file_xuli."?action=delete&id=" . $row[$columns[0]] . "'>Xóa</a>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='" . count($columns) . "'>Không tìm thấy kết quả phù hợp</td></tr>";
    }
}
//hàm dành riêng cho các đơn hàng
function displayTable4($conn, $searchQuery = '', $searchType = '', $searchText = '') {
    
    if ($searchType=='TenSanPham' && isset($searchText)){
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            WHERE 
            DonHang.MaDon IN (
                SELECT DISTINCT MaDon
                FROM ChiTietDonHang
                WHERE TenSanPham LIKE '%".$searchText."%'
            )";
    } else {
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang ".$searchQuery;
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['MaDon']."</td>";
            echo "<td>".$row['MaKhachHang']."</td>";
            echo "<td>".$row['TenKhachHang']."</td>";
            echo "<td style='text-align: center;'>".$row['SoDienThoai']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['DiaChi']."</td>";
            echo "<td style='text-align: right;'>".$row['TongGiaTriDonHang']."</td>";
            echo "<td>".$row['GhiChu']."</td>";
            echo "<td>".$row['PhuongThucThanhToan']."</td>";
            echo "<td>".$row['NgayDatHang']."</td>";
            echo "<td>".$row['NgayGiao']."</td>";
            echo "<td>".$row['TrangThai']."</td>";
            echo "<td class='action'>
                <a id='detailsbtn' onclick=\"showDetails(this)\" href='#'>Chi tiết</a>
                <a id='editbtn' onclick=\"openPopup(this,'DonHang');\" href='#'>Sửa</a>
                <a id='deletebtn' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\" href='xulidonhang.php?action=delete&id=" . $row['MaDon'] . "'>Xóa</a>
                </td>";
            echo "</tr>";
            $sql_details = "SELECT ChiTietDonHang.* FROM ChiTietDonHang WHERE MaDon = '".$row['MaDon']."'";

            $result_details = $conn->query($sql_details);

            if($result_details->num_rows>0){
                echo "<tr class='child-row' style='display: none;'>
                    <td colspan='13'>
                    <table class='details'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th width='10%'>Mã Đơn</th>";
                echo "<th width='20%'>Tên Sản Phẩm</th>";
                echo "<th width='70%'>Giá Sản Phẩm</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody class='child'>";
                while ($row_details = $result_details->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$row_details['MaDon']."</td>";
                    echo "<td>".$row_details['TenSanPham']."</td>";
                    echo "<td>".$row_details['GiaSanPham']."</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='".$result->field_count."'>Không tìm thấy kết quả phù hợp</td></tr>";
    }
}

function displayTable5($conn, $tableName, $searchType = '', $searchText = '') {
    if ($searchType=='TenSanPham' && isset($searchText)){
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            WHERE TrangThai = '$tableName' AND
            DonHang.MaDon IN (
                SELECT DISTINCT MaDon
                FROM ChiTietDonHang
                WHERE TenSanPham LIKE '%".$searchText."%'
            )";
    } else if (!empty($searchType) && !empty($searchText)){
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            Where TrangThai = '$tableName' AND $searchType = '$searchText'";
    } else {
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            Where TrangThai = '$tableName'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['MaDon']."</td>";
            echo "<td>".$row['MaKhachHang']."</td>";
            echo "<td>".$row['TenKhachHang']."</td>";
            echo "<td style='text-align: center;'>".$row['SoDienThoai']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['DiaChi']."</td>";
            echo "<td style='text-align: right;'>".$row['TongGiaTriDonHang']."</td>";
            echo "<td>".$row['GhiChu']."</td>";
            echo "<td>".$row['PhuongThucThanhToan']."</td>";
            echo "<td>".$row['NgayDatHang']."</td>";
            echo "<td>".$row['NgayGiao']."</td>";
            echo "<td>".$row['TrangThai']."</td>";
            echo "<td class='action'>
                <a id='nextbtn' href='xulidonhang.php?action=next&id=" . $row['MaDon'] . "&tt=". $row['TrangThai']."'>Tiếp tục</a>
                <a id='detailsbtn' onclick=\"showDetails(this)\" href='#'>Chi tiết</a>
                <a id='editbtn' onclick=\"openPopup(this,'DonHang')\" href='#'>Sửa</a>
                <a id='deletebtn' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\" href='xulidonhang.php?action=delete&id=" . $row['MaDon'] . "'>Xóa</a>
                </td>";
            echo "</tr>";
            $sql_details = "SELECT ChiTietDonHang.* FROM ChiTietDonHang WHERE MaDon = '".$row['MaDon']."'";

            $result_details = $conn->query($sql_details);

            if($result_details->num_rows>0){
                echo "<tr class='child-row' style='display: none;'>
                    <td colspan='12'>
                    <table class='details'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th width='10%'>Mã Đơn</th>";
                echo "<th width='20%'>Tên Sản Phẩm</th>";
                echo "<th width='70%'>Giá Sản Phẩm</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody class='child'>";
                while ($row_details = $result_details->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$row_details['MaDon']."</td>";
                    echo "<td>".$row_details['TenSanPham']."</td>";
                    echo "<td>".$row_details['GiaSanPham']."</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='".$result->field_count."'>Không tìm thấy kết quả phù hợp</td></tr>";
    }
}

function displayTable6($conn, $tableName, $searchType = '', $searchText = '') {
    
    if ($searchType=='TenSanPham' && isset($searchText)){
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            WHERE TrangThai = '$tableName' AND
            DonHang.MaDon IN (
                SELECT DISTINCT MaDon
                FROM ChiTietDonHang
                WHERE TenSanPham LIKE '%".$searchText."%'
            )";
    } else if (!empty($searchType) && !empty($searchText)){
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            Where TrangThai = '$tableName' AND $searchType = '$searchText'";
    } else {
        $sql = "SELECT DonHang.*, KhachHang.* FROM DonHang
            JOIN KhachHang ON DonHang.MaKhachHang = KhachHang.MaKhachHang 
            Where TrangThai = '$tableName'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['MaDon']."</td>";
            echo "<td>".$row['MaKhachHang']."</td>";
            echo "<td>".$row['TenKhachHang']."</td>";
            echo "<td style='text-align: center;'>".$row['SoDienThoai']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['DiaChi']."</td>";
            echo "<td style='text-align: right;'>".$row['TongGiaTriDonHang']."</td>";
            echo "<td>".$row['GhiChu']."</td>";
            echo "<td>".$row['PhuongThucThanhToan']."</td>";
            echo "<td>".$row['NgayDatHang']."</td>";
            echo "<td>".$row['NgayGiao']."</td>";
            echo "<td>".$row['TrangThai']."</td>";
            echo "<td class='action'>
                <a id='detailsbtn' onclick=\"showDetails(this)\" href='#'>Chi tiết</a>
                <a id='editbtn' onclick=\"openPopup(this,'DonHang')\" href='#'>Sửa</a>
                </td>";
            echo "</tr>";
            $sql_details = "SELECT ChiTietDonHang.* FROM ChiTietDonHang WHERE MaDon = '".$row['MaDon']."'";

            $result_details = $conn->query($sql_details);

            if($result_details->num_rows>0){
                echo "<tr class='child-row' style='display: none;'>
                    <td colspan='12'>
                    <table class='details'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th width='10%'>Mã Đơn</th>";
                echo "<th width='20%'>Tên Sản Phẩm</th>";
                echo "<th width='70%'>Giá Sản Phẩm</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody class='child'>";
                while ($row_details = $result_details->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$row_details['MaDon']."</td>";
                    echo "<td>".$row_details['TenSanPham']."</td>";
                    echo "<td>".$row_details['GiaSanPham']."</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='".$result->field_count."'>Không tìm thấy kết quả phù hợp</td></tr>";
    }
}


function NextID($conn, $tableName, $prefix, $idcolumn) {
    // Truy vấn để lấy ID lớn nhất hiện có
    $query = "SELECT MAX($idcolumn) AS max_id FROM $tableName";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];
        if (!$max_id) {
            return $prefix.'001';
        }
        $number = intval(substr($max_id, 1)); //trừ prefix
        $number++;
        //str_pad giúp thêm tới khi đủ 3 số
        $new_id = $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
        return $new_id;
    } else {
        // Xử lý lỗi nếu truy vấn không thành công
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

function layTatCaDuLieu($conn, $columns, $tableName, $where=''){
    $columnNames = implode(", ", $columns);
    if(!empty($where)){
        $where = 'WHERE ' . $where;
    }
    $sql = "SELECT $columnNames FROM $tableName $where";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $array = array();
        while($row = $result->fetch_assoc()) {
            $rowArray = array();
            foreach ($columns as $column) {
                // Thêm dữ liệu của từng cột vào mảng dòng
                $rowArray[$column] = $row[$column];
            }
            // Thêm mảng dòng vào mảng chính
            $array[] = $rowArray;
        }
        return $array;
    } else {
        return array();
    }
}

?>