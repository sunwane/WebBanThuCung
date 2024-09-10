<?php
    include "connect.php";
    session_start();

    $logout = isset($_GET['logout']) ? true : '';

    if($logout == true){
        $_SESSION['loggedin'] = false;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST['mail']) ? $_POST['mail'] : '';
        $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Vui lòng nhập đầy đủ email và mật khẩu.";
        } else {
            $sql = "SELECT * FROM TKQuanTri WHERE Email='$email' AND MatKhau='$password' LIMIT 1";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['mail'] = $email;
                $_SESSION['username'] = $row['TenTaiKhoan'];
                $_SESSION['idUser'] = $row['MaTaiKhoan'];
                $_SESSION['password'] = $password;
                unset($_SESSION['error']);
                $_SESSION['loggedin'] = true;
    
                // Chuyển hướng tới trang main.php
                header('Location: main.php');
                exit();
            } else {
                // Sai email hoặc mật khẩu
                $_SESSION['error'] = "Sai email hoặc mật khẩu.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/login.js"></script>
</head>
<body>
    <form method="POST" action="">
        <img src="../images/logo-xoaphong.png" alt="logo"> <br>
        <div class="input">
            <input type="text" placeholder="Email" name='mail' autocomplete="off"> <br>
            <input type="password" placeholder="Mật khẩu" name='pass'> <br>
            <div class="error">
            <?php
                // Hiển thị thông báo lỗi (nếu có)
                if (!empty($_SESSION['error'])) {
                    echo $_SESSION['error'];
                }
                ?>
            </div>
            <button class="submit" type="submit">Đăng nhập</button> <br>
        </div>
    </form>
    
</body>
</html>