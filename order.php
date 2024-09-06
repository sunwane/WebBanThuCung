<?php

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

    function checkPhoneExist($phone,$conn){
        $check = true;
        $sql1 = "Select * from khachhang";
        $result = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['SoDienThoai'] == $phone){
                    $check = false; //khach hang su dung sdt nay da tung mua hang
                    $idCus = $row['MaKhachHang'];
                }
            }
        }
        return $check;
    }

    function getIDCus($conn, $phone){
        $sql1 = "Select * from khachhang";
        $result = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['SoDienThoai'] == $phone){
                    $idCus = $row['MaKhachHang'];
                }
            }
        }
        return $idCus;
    }

    function checkSendData($petName, $conn){
        $check = false; //du lieu chua vao
        $sql = "select * from chitietdonhang";
        $result1 = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result1) > 0){
            while($row = mysqli_fetch_array($result1)){
                if($row['TenSanPham'] == $petName){
                    $check = true; //du lieu da duoc luu
                }
            }
        }
        return $check;
    }

    function infoCus($id, $name, $phone, $address, $email, $conn){
        $sql = "Insert into khachhang value('$id', '$name', '$phone', '$address', '$email')";
        mysqli_query($conn, $sql);
    }

    function inforOrder($idDH, $idKH, $pttt, $ngayDat, $ngayGiao, $note, $sum, $trangthai, $conn){
        $sql = "Insert into donhang value('$idDH', '$idKH', '$pttt', '$ngayDat', '$ngayGiao', '$note', '$sum', '$trangthai')";
        mysqli_query($conn, $sql);
    }

    function orderDetail($idDH, $petName, $price, $conn){
        $sql = "Insert into chitietdonhang value('$idDH', '$petName', '$price')";
        mysqli_query($conn, $sql);
    }

    function changStatus($petName, $conn){
        $sql = "update thucung set TinhTrang = 'Hết' where TenSanPham = '$petName'";
        mysqli_query($conn, $sql);
    }

    function updateCus($id, $name, $phone, $address1, $email, $conn) {
        $sql = "UPDATE khachhang 
                SET 
                    TenKhachHang = '$name',
                    SoDienThoai = '$phone',
                    DiaChi = '$address1',
                    Email = '$email'
                WHERE MaKhachHang = '$id'";
        mysqli_query($conn, $sql);
    }
    
?>