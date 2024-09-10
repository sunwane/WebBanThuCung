<link rel="stylesheet" href="../css/table.css">
<script src="../js/table.js"></script>
<?php
// Kết nối tới cơ sở dữ liệu
include 'connect.php'; 
include 'xulitable.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$tt = isset($_GET['tt']) ? $_GET['tt'] : '';

// Kiểm tra nếu form đã được submit
if ($action === 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "images\cat-dog\\";

    $id = NextID($conn,'DonHang','D','MaDon');

    $type_kh = $_POST['optionKH'];
    if ($type_kh == 'Khách hàng cũ'){
        $idKH = $_POST['idKH'];
    } else {
        $idKH = $_POST['idKHmoi'];
        $nameKH = $_POST['nameKHmoi'];
        $addrKH = $_POST['addrKHmoi'];
        $numberKH = $_POST['numberKHmoi'];
        $mailKH = $_POST['mailKHmoi'];
        $sql1 = "INSERT INTO KhachHang VALUES ('$idKH','$nameKH','$numberKH', '$addrKH', '$mailKH')";
        if ($conn->query($sql1)) {
            echo "Thêm khách hàng thành công";
        } else {
            echo "Lỗi: " . $sql1 . "<br>" . mysqli_error($conn);
        }  
    }
    $gchu = $_POST['gchu'];
    $tong = $_POST['tongdonhang'];
    $pthuc = $_POST['pthuc'];
    $ngaydat = date("Y-m-d");
    $ngaygiao = null;
    $trangthai = 'Đã đặt hàng';

    $sql2 = "INSERT INTO DonHang VALUES ('$id','$idKH','$pthuc', '$ngaydat', NULL, '$gchu','$tong','$trangthai')";
    if ($conn->query($sql2)) {
        echo "Thêm đơn hàng thành công";
    } else {
        echo "Lỗi: " . $sql2 . "<br>" . mysqli_error($conn);
    }

    $pname = $_POST['name'];
    $pprice = $_POST['price'];
    $flag = true;
    
    for ($i = 0; $i < count($pname); $i++) {
        $name = $pname[$i];
        $price = $pprice[$i];

        $sql3 = "UPDATE ThuCung SET TinhTrang='Hết' WHERE TenSanPham='$name'";
        if ($conn->query($sql3)) {
            echo "Sửa trạng thái '$name' thành công!<br>";
        } else {
            echo "Lỗi: " . $sql3 . "<br>" . mysqli_error($conn);
            $flag = false;
        }

        $sql = "INSERT INTO ChiTietDonHang VALUES ('$id', '$name', '$price')";

        if ($conn->query($sql)) {
            echo "Thêm sản phẩm '$name' thành công!<br>";
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            $flag = false;
        }
    }
    
    if($flag){
        header("Location: donhang.php");
    }
    
} elseif ($action === 'delete' && isset($id)){
    $check = "SELECT TrangThai From DonHang Where MaDon = '$id' Limit 1";
    $result_check = $conn->query($check);
    $tthai = $result_check->fetch_assoc();
    if($tthai['TrangThai'] == 'Đã giao thành công'){
        echo "<div class='alert'>
                <div class='message'>
                    Không thể xóa một đơn hàng đang ở trạng thái đã giao thành công!
                </div>
                    <button onclick='turnBack()'>Đã hiểu!</button>
            </div>";
    } else {
        $flag = true;
        $sql = "UPDATE ThuCung 
            SET TinhTrang = 'Còn' 
            WHERE TenSanPham IN (
                SELECT TenSanPham 
                FROM ChiTietDonHang
                WHERE MaDon='$id'
            )";
        if ($stmt = $conn->query($sql)) {
            echo "Bản ghi đã được cập nhật thành công!";
        } else {
            echo "Lỗi khi xóa bản ghi: " . mysqli_error($conn);
            $flag = false;
        }

        $sql1 = "DELETE FROM ChiTietDonHang WHERE MaDon = '$id'";
        if ($stmt = $conn->query($sql1)) {
            echo "Chi tiết đơn hàng đã được xóa thành công!";
        } else {
            echo "Lỗi khi xóa bản ghi: " . mysqli_error($conn);
            $flag = false;
        }

        $sql2 = "DELETE FROM DonHang WHERE MaDon = '$id'";
        if ($stmt = $conn->query($sql2)) {
            echo "Đơn hàng đã được xóa thành công!";
        } else {
            echo "Lỗi khi xóa bản ghi: " . mysqli_error($conn);
            $flag = false;
        }

        if($flag){
            header("Location: donhang.php");
        }
    }
} elseif ($action === 'edit' && $_SERVER["REQUEST_METHOD"] == "POST"){

    $id = $_POST['id'];

    //xóa hết các sản phẩm trong đơn hàng trước và cập nhật lại tình trạng thú cưng
    $allproduct = "SELECT TenSanPham FROM ChiTietDonHang WHERE MaDon = '$id'";
    $result = $conn->query($allproduct);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tenSanPham = $row['TenSanPham'];
            $sqlUpdateProduct = "UPDATE ThuCung 
                                 SET TinhTrang = 'Còn' 
                                 WHERE TenSanPham = '$tenSanPham'";
    
            if ($conn->query($sqlUpdateProduct) === TRUE) {
                echo "Cập nhật trạng thái của $tenSanPham thành công.<br>";
            } else {
                echo "Lỗi khi cập nhật trạng thái của $tenSanPham: " . $conn->error . "<br>";
            }
        }   
        // xóa các chi tiết đơn hàng
        $sqlDeleteDetails = "DELETE FROM ChiTietDonHang 
                             WHERE MaDon = '$id'";
    
        if ($conn->query($sqlDeleteDetails) === TRUE) {
            echo "Đã xóa tất cả các chi tiết đơn hàng liên quan đến mã đơn hàng $id.<br>";
        } else {
            echo "Lỗi khi xóa chi tiết đơn hàng: " . $conn->error . "<br>";
        }
    } else {
        echo "Không tìm thấy chi tiết đơn hàng nào cho mã đơn hàng $id.";
    }

    $type_kh = $_POST['optionKH'];
    if ($type_kh == 'Khách hàng cũ'){
        $idKH = $_POST['idKH'];
    } else {
        $idKH = $_POST['idKHmoi'];
        $nameKH = $_POST['nameKHmoi'];
        $addrKH = $_POST['addrKHmoi'];
        $numberKH = $_POST['numberKHmoi'];
        $mailKH = $_POST['mailKHmoi'];
        $sql1 = "INSERT INTO KhachHang VALUES ('$idKH','$nameKH','$numberKH', '$addrKH', '$mailKH')";
        if ($conn->query($sql1)) {
            echo "Sửa khách hàng thành công";
        } else {
            echo "Lỗi: " . $sql1 . "<br>" . mysqli_error($conn);
        }  
    }
    $gchu = isset($_POST['gchu']) ? $_POST['gchu'] : NULL ;
    $tong = $_POST['tongdonhang'];
    $pthuc = $_POST['pthuc'];
    $trangthai = $_POST['trangthai'];
    if ($trangthai == 'Đã giao thành công'){
        $ngaygiao =  date("Y-m-d");
    } else {
        $ngaygiao =  NULL;
    }

    $sql2 = "UPDATE DonHang SET MaKhachHang ='$idKH',PhuongThucThanhToan='$pthuc', GhiChu=".($gchu === NULL ? "NULL" : "'$gchu'")." ,NgayGiao=".($ngaygiao === NULL ? "NULL" : "'$ngaygiao'").", TongGiaTriDonHang='$tong', TrangThai='$trangthai'
            WHERE MaDon='$id'";
    if ($conn->query($sql2)) {
        echo "Chỉnh sửa đơn hàng thành công";
    } else {
        echo "Lỗi: " . $sql2 . "<br>" . mysqli_error($conn);
    }

    //thêm lại thú cưng mới
    $pname = $_POST['name'];
    $pprice = $_POST['price'];
    $flag = true;
    
    for ($i = 0; $i < count($pname); $i++) {
        $name = $pname[$i];
        $price = $pprice[$i];

        $sql3 = "UPDATE ThuCung SET TinhTrang='Hết' WHERE TenSanPham='$name'";
        if ($conn->query($sql3)) {
            echo "Sửa trạng thái '$name' thành công!<br>";
        } else {
            echo "Lỗi: " . $sql3 . "<br>" . mysqli_error($conn);
            $flag = false;
        }

        $sql = "INSERT INTO ChiTietDonHang VALUES ('$id', '$name', '$price')";

        if ($conn->query($sql)) {
            echo "Thêm sản phẩm '$name' thành công!<br>";
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            $flag = false;
        }
    }
    
    if($flag){
        header("Location: donhang.php");
    }
} else if ($action=='next' && isset($tt)){
    $newtt = $tt;
    $ngaygiao = NULL;
    if ($tt == 'Đã đặt hàng'){
        $newtt = 'Đã xác nhận';
    } else if ($tt == 'Đã xác nhận'){
        $newtt = 'Đang giao';
    } else if ($tt == 'Đang giao'){
        $newtt = 'Đã giao thành công';
        $ngaygiao = date("Y-m-d");
    } else {
        header("Location: donhang.php");
    }

    $sql = "UPDATE DonHang SET TrangThai='$newtt', NgayGiao=".($ngaygiao === NULL ? "NULL" : "'$ngaygiao'")." WHERE MaDon='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật trạng thái thành công.<br>";
        header('Location: donhang.php');
    } else {
        echo "Lỗi khi cập nhật trạng thái đơn hàng: " . $conn->error . "<br>";
    }
    
} else {
    echo "unknown action";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);

?>