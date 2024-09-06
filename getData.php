<?php
    include "connect.php";

    $sql = "select * from thucung";
    $result = mysqli_query($conn, $sql);
    $array = [];

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            if($row['TinhTrang'] == "Còn"){
                $tempArray = [
                    "img" => $row['Anh'],
                    "id" => $row['MaSanPham'],
                    "name" => $row['TenSanPham'],
                    "price" => $row['GiaSanPham'],
                    "gioitinh" => $row['GioiTinh'],
                    "tuoi" => $row['Tuoi'],
                    "mau" => $row['Mau'],
                    "tiemphong" => $row['TiemPhong'],
                    "taygiun" => $row['TayGiun'],
                    "status" => $row['TinhTrang'],
                    "magiong" => $row['MaGiong']
                ];
                array_push($array, $tempArray);
            }
        }
    }

    $jsonArray = json_encode($array);
    echo "
    <script>
        let arrayNew = $jsonArray;
        sessionStorage.setItem('pet', JSON.stringify(arrayNew));
    </script>
    ";

    $sql1 = "select * from giong";
    $result = mysqli_query($conn, $sql1);
    $array1 = [];

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $tempArray = [
                "magiong" => $row['MaGiong'],
                "ten" => $row['TenGiong'],
                "tenloai" => $row['TenLoai'],
                "kieulong" => $row['KieuLong'],
                "kichthuoc_mau" => $row['KichThuoc_Mau'],
                "dovandong_runglong" => $row['MucDoVanDong_RungLong'],
                "nhomcho_vengoai" => $row['NhomCho_VeNgoai'],
                "popular" => $row['DoPhoBien'],
                "tinhtrang" => $row['TinhTrang']
            ];
            array_push($array1, $tempArray);
        }
    }

    $jsonArray = json_encode($array1);
    echo "
    <script>
        let arrayNew1 = $jsonArray;
        sessionStorage.setItem('species', JSON.stringify(arrayNew1));
    </script>
    ";
?>