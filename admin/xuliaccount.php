<?php
include 'connect.php';
session_start(); 

$action = isset($_GET['action']) ? $_GET['action'] : '';

if($action == 'email' && $_SERVER["REQUEST_METHOD"] == "POST"){
    $mail = $_POST['mail'];
    $sql = "UPDATE tkquantri SET Email = '$mail' WHERE MaTaiKhoan = '". $_SESSION['idUser']."'";
    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật email thành công.<br>";
        $_SESSION['mail'] = $mail;
        header('Location: account.php');
    } else {
        echo "Lỗi khi cập nhật email mới: " . $conn->error . "<br>";
    }
} else if ($action == 'name' && $_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $sql = "UPDATE tkquantri SET TenTaiKhoan = '$name' WHERE MaTaiKhoan = '". $_SESSION['idUser']."'";
    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật tên thành công.<br>";
        $_SESSION['username'] = $name;
        header('Location: account.php');
    } else {
        echo "Lỗi khi cập nhật tên mới: " . $conn->error . "<br>";
    }
} else if ($action == 'pass' && $_SERVER["REQUEST_METHOD"] == "POST"){
    $pass = $_POST['pass'];
    $sql = "UPDATE tkquantri SET MatKhau = '$pass' WHERE MaTaiKhoan = '". $_SESSION['idUser']."'";
    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật mật khẩu thành công.<br>";
        $_SESSION['password'] = $pass;
        header('Location: account.php');
    } else {
        echo "Lỗi khi cập nhật mật khẩu mới: " . $conn->error . "<br>";
    }
} else {
    echo "unknown action";
}
?>