<link rel="stylesheet" href="../css/table.css">
<script src="../js/table.js"></script>
<?php
// Kết nối tới cơ sở dữ liệu
include 'connect.php'; 
include 'xulitable.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Kiểm tra nếu form đã được submit
if ($action === 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "images\cat-dog\\";

    $id = NextID($conn,'ThuCung','S','MaSanPham');
    $id_giong = $_POST['idgiong'];
    $name = $_POST['name'].' '.$id;
    $imgpath = $target_dir . basename($_FILES['anh']['name']);
    $gioitinh = $_POST['gioitinh'];
    $tuoi = $_POST['tuoi'];
    $mau = $_POST['mau'];
    $tiemphong = intval($_POST['tiemphong']);
    $taygiun = intval($_POST['taygiun']);
    $tinhtrang = 'Còn';
    $gia = intval($_POST['gia']);

    move_uploaded_file($_FILES['anh']['tmp_name'],__DIR__.'\..\\'.$imgpath);
    $imgpath = str_replace('\\', '\\\\', $imgpath); //cứu img khỏi lỗi csdl =))
    // Tạo câu lệnh SQL để thêm dữ liệu
    $sql = "INSERT INTO ThuCung VALUES ('$id','$id_giong','$name', '$imgpath', '$gioitinh', '$tuoi','$mau','$tiemphong','$taygiun','$tinhtrang','$gia')";

    if ($conn->query($sql)) {
        echo "Thành công";
        header("Location: thucung.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }   
} elseif ($action === 'delete' && isset($id)){
    $check = "SELECT DonHang.TrangThai, ThuCung.TenSanPham FROM DonHang 
    JOIN ChiTietDonHang on DonHang.MaDon = ChiTietDonHang.MaDon
    JOIN ThuCung on ChiTietDonHang.TenSanPham = ThuCung.TenSanPham
    WHERE ThuCung.MaSanPham = '$id'";

    $result = $conn->query($check);
    $daGiaoHang = true;
    if($result->num_rows > 0){ 
        $row = $result->fetch_assoc();
        $trangthai = $row['TrangThai'];
        if ($trangthai != 'Đã giao hàng thành công'){
            $daGiaoHang = false;
        }
    }
    if($daGiaoHang){
        $sql = "DELETE FROM ThuCung WHERE MaSanPham = '$id'";
        if ($stmt = $conn->query($sql)) {
            echo "Bản ghi đã được xóa thành công!";
            header("Location: thucung.php");
        } else {
            echo "Lỗi khi xóa bản ghi: " . mysqli_error($conn);
        }
    } else {
        echo "<div class='alert'>
                <div class='message'>
                    Không thể xóa thú cưng này vì hiện có 1 đơn hàng mua thú cưng này nhưng chưa được giao thành công,
                    nếu muốn tiếp tục xóa vui lòng chờ đợi đơn hàng có mua thú cưng tên ".$row['TenSanPham']." được giao hàng hoàn tất để tiếp tục xóa thú cưng.
                </div>
                <button onclick='turnBack()'>Đã hiểu!</button>
            </div>";
    }
   
} elseif ($action === 'edit' && $_SERVER["REQUEST_METHOD"] == "POST"){
    $target_dir = "images/cat-dog/";

    $id = $_POST['id'];
    $id_giong = $_POST['idgiong'];
    $name = $_POST['name'].' '.$id;
    $gioitinh = $_POST['gioitinh'];
    $tuoi = $_POST['tuoi'];
    $mau = $_POST['mau'];
    $tiemphong = intval($_POST['tiemphong']);
    $taygiun = intval($_POST['taygiun']);
    $tinhtrang = $_POST['tinhtrang'];
    $gia = intval($_POST['gia']);

    if (isset($_FILES['anh']) && $_FILES['anh']['error']=== UPLOAD_ERR_OK) {
        $imgpath = $target_dir . basename($_FILES['anh']['name']);
        move_uploaded_file($_FILES['anh']['tmp_name'], __DIR__ . '/../' . $imgpath);
        $imgpath = str_replace('\\', '\\\\', $imgpath);

        $sql = "UPDATE ThuCung SET MaGiong='$id_giong', TenSanPham='$name', Anh='$imgpath', Tuoi='$tuoi', GioiTinh='$gioitinh', Mau='$mau', 
            TiemPhong='$tiemphong', TayGiun='$taygiun', TinhTrang='$tinhtrang', GiaSanPham='$gia' WHERE MaSanPham='$id'";
    } else {
        $sql = "UPDATE ThuCung SET MaGiong='$id_giong', TenSanPham='$name', Tuoi='$tuoi', GioiTinh='$gioitinh', Mau='$mau', 
            TiemPhong='$tiemphong', TayGiun='$taygiun', TinhTrang='$tinhtrang', GiaSanPham='$gia' WHERE MaSanPham='$id'";
    }
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thành công!";
            header("Location: thucung.php");
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "unknown action";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);

?>