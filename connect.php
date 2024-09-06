<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "csdl";
    $port = 3307;
    
    $conn = new mysqLi($host, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Kết nối không thành công". $conn->connect_error);
    }
    //else echo "<script>console.log('Kết nối thành công')</script>";
    return $conn;
?>