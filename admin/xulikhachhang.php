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
    $id = NextID($conn,'khachhang','K','MaKhachHang');
    $name = $_POST['name'];
    $number = $_POST['number'];
    $addr = $_POST['addr'];
    $mail = $_POST['mail'];

    // Tạo câu lệnh SQL để thêm dữ liệu
    $sql = "INSERT INTO khachhang VALUES ('$id','$name', '$number', '$addr', '$mail')";

    if ($conn->query($sql)) {
        echo "Thành công";
        header("Location: khachhang.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }   
} elseif ($action === 'delete' && isset($id)){
    $stmt = $conn->query("SELECT COUNT(*) AS count FROM DonHang WHERE MaKhachHang = '".$id."'");
    $row = $stmt->fetch_assoc();
    if($row['count'] == 0){
        $sql = "DELETE FROM khachhang WHERE MaKhachHang = '$id'";
        if ($stmt = $conn->query($sql)) {
            echo "Bản ghi đã được xóa thành công!";
            header("Location: khachhang.php");
        } else {
            echo "Lỗi khi xóa bản ghi: " . mysqli_error($conn);
        }
    } else {
        echo "<div class='alert'>
                <div class='message'>
                    Không thể xóa khách hàng này vì các thông tin của khách phải được lưu lại để truy vấn các đơn hàng đã mua!
                </div>
                <button onclick='turnBack()'>Đã hiểu!</button>
            </div>";
    }
} elseif ($action === 'edit' && $_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $addr = $_POST['addr'];
    $mail = $_POST['mail'];

    $sql = "UPDATE khachhang SET TenKhachHang='$name', SoDienThoai='$number', DiaChi='$addr', Email='$mail' WHERE MaKhachHang='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
        header("Location: khachhang.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);

?>