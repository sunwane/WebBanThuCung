<?php
    $host = 'localhost:3307';
    $username = 'root';
    $password = '';
    $dbname = 'csdl';

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
    }
?>
