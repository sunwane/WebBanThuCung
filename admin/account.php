<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
    <link rel="stylesheet" href="../css/account.css">
    <script src="../js/admin.js"></script>
    <script src="../js/checkloi.js"></script>
</head>
<body>
    <div class="box1">
        <div class="name">
            <img src="../images/icons8-user-100.png" alt="avatar">
            <div class="nametext">
                <div>Nhân viên</div>
                <div class="uname">
                    <?php
                    if(!empty($_SESSION['username'])){
                        echo $_SESSION['username'];
                    } else {
                        echo 'UserName';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class='form'>
            <form class="form-group" onsubmit="return checkValidEmail()" method='POST' action='xuliaccount.php?action=email' name='email'>
                <label>Email:</label>
                <input type="text" value="<?php echo isset($_SESSION['mail']) ? $_SESSION['mail'] : 'username@gmail.com'; ?>" id="mail" name='mail' readonly>
                <button id="edit" onclick="return enableEdit('#mail')">Sửa</button>
                <button id="save" class="save" style="display: none">Lưu</button>
            </form>
            <div class='error'></div>
            <form class="form-group" onsubmit="return checkValidName()" method='POST' action='xuliaccount.php?action=name' name='username'>
                <label>Tên đăng nhập:</label>
                <input type="text" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'UserName'; ?>" id="ten" name='name' readonly>
                <button id="edit" onclick="return enableEdit('#ten')">Sửa</button>
                <button id="save" type="submit" style="display: none">Lưu</button>
            </form>
            <div class='error'></div>
            <form class="form-group" id="password" onsubmit="return checkValidPass()" method='POST' action='xuliaccount.php?action=pass' name='password'>
                <label>Password:</label>
                <input type="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : 'username@gmail.com'; ?>" id="pass" name='pass' readonly>
                <button onclick="return showpass()" class="show">Hiển thị</button>
                <button id="edit" onclick="return enableEdit('#pass')">Sửa</button>
                <button id="save" type="submit" style="display: none">Lưu</button>
            </form>
            <div class='error'></div>
        </div>
    </div>
    <div class="bottom">
        <div class="box2">
            Mọi thắc mắc về lỗi hệ thống xin hãy liên hệ với kỹ thuật viên để được giải quyết
        </div>
        <a class="box3" href="index.php?logout=true" target="_top" onclick="logout()">
            <img src="../images/icons8-power-off-button-24.png" alt="đăng xuất">
            <div>Đăng xuất</div>
        </a>
    </div>
</body>
</html>