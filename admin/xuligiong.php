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
    $id = NextID($conn,'Giong','G','MaGiong');
    $name = $_POST['name'];
    $loai = $_POST['loai'];
    $kieulong = $_POST['kieulong'];
    $kichthuoc_mau = $_POST['loai']=="Chó" ? $_POST['kichthuoc'] : $_POST['mau'];
    $vandong_runglong = $_POST['loai']=="Chó" ? $_POST['vandong'] : $_POST['runglong'];
    $nhomcho_vengoai = $_POST['loai']=="Chó" ? $_POST['nhomcho'] : $_POST['vengoai'];
    $phobien = $_POST['phobien'];
    $tinhtrang = 'Đang bán';

    // Tạo câu lệnh SQL để thêm dữ liệu
    $sql = "INSERT INTO Giong VALUES ('$id','$name', '$loai', '$kieulong', '$kichthuoc_mau','$vandong_runglong','$nhomcho_vengoai','$phobien','$tinhtrang')";

    if ($conn->query($sql)) {
        echo "Thành công";
        header("Location: giong.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }   
} elseif ($action === 'delete' && isset($id)){
    $stmt = $conn->query("SELECT COUNT(*) AS count FROM ThuCung WHERE MaGiong = '".$id."'");
    $row = $stmt->fetch_assoc();
    if($row['count'] == 0){
        $sql = "DELETE FROM Giong WHERE MaGiong = '$id'";
        if ($result = $conn->query($sql)) {
        echo "Bản ghi đã được xóa thành công!";
        header("Location: giong.php");
        } else {
            echo "Lỗi khi xóa bản ghi: " . mysqli_error($conn);
        }
    } else {
        echo "<div class='alert'>
                <div class='message'>
                    Không thể xóa giống vì hiện đang có ".$row['count']." sản phẩm thuộc giống này trong dữ liệu,
                    nếu muốn tiếp tục vui lòng quay lại xóa các sản phẩm thuộc mã giống ".$id." để tiếp tục xóa giống.
                </div>
                <button onclick='turnBack()'>Đã hiểu!</button>
            </div>";
    }
    
} elseif ($action === 'edit' && $_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $loai = $_POST['loai'];
    $kieulong = $_POST['kieulong'];
    $kichthuoc_mau = $_POST['loai']=="Chó" ? $_POST['kichthuoc'] : $_POST['mau'];
    $vandong_runglong = $_POST['loai']=="Chó" ? $_POST['vandong'] : $_POST['runglong'];
    $nhomcho_vengoai = $_POST['loai']=="Chó" ? $_POST['nhomcho'] : $_POST['vengoai'];
    $phobien = $_POST['phobien'];
    $tinhtrang = $_POST['tinhtrang'];

    $sql = "UPDATE Giong SET TenGiong='$name', TenLoai='$loai', KieuLong='$kieulong', KichThuoc_Mau='$kichthuoc_mau', 
            MucDoVanDong_RungLong='$vandong_runglong', NhomCho_VeNgoai='$nhomcho_vengoai', DoPhoBien='$phobien', TinhTrang='$tinhtrang' WHERE MaGiong='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
        header("Location: giong.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "unknown action";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);

?>