function checkloi_khachhang_edit(){
    var KHname = document.edit.name.value;
    var KHnumber = document.edit.number.value;
    var KHaddr = document.edit.addr.value;
    var KHmail = document.edit.mail.value;
    var flag = true;

    if (KHname.length === 0){
        var parent = document.edit.name.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập họ và tên';
        flag = false;
    } else if (containNumber(KHname)){
        var parent = document.edit.name.parentElement;
        parent.querySelector('.error').textContent = 'Họ và tên không bao gồm số';
        flag = false;
    } else {
        var parent = document.edit.name.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (KHnumber.length === 0){
        var parent = document.edit.number.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập số điện thoại';
        flag = false;
    } else if (KHnumber.length !== 10 || isNaN(KHnumber)){ 
        var parent = document.edit.number.parentElement;
        parent.querySelector('.error').textContent = 'Số điện thoại hợp lệ phải dài 10 chữ số, không bao gồm chữ cái';
        flag = false;
    } else {
        var parent = document.edit.number.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (KHaddr.length === 0){
        var parent = document.edit.addr.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập địa chỉ';
        flag = false;
    } else {
        var parent = document.edit.addr.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (KHmail.length === 0){
        var parent = document.edit.mail.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập email';
        flag = false;
    } else if (!isValidEmail(KHmail)){
        var parent = document.edit.mail.parentElement;
        parent.querySelector('.error').textContent = 'Email không hợp lệ';
        flag = false;
    } else {
        var parent = document.edit.mail.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    return flag;
}

function checkloi_khachhang(){
    var KHname = document.add.name.value;
    var KHnumber = document.add.number.value;
    var KHaddr = document.add.addr.value;
    var KHmail = document.add.mail.value;
    var flag = true;

    if (KHname.length === 0){
        var parent = document.add.name.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập họ và tên';
        flag = false;
    } else if (containNumber(KHname)){
        var parent = document.add.name.parentElement;
        parent.querySelector('.error').textContent = 'Họ và tên không bao gồm số';
        flag = false;
    } else {
        var parent = document.add.name.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (KHnumber.length === 0){
        var parent = document.add.number.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập số điện thoại';
        flag = false;
    } else if (KHnumber.length != 10 || isNaN(KHnumber)){
        var parent = document.add.number.parentElement;
        parent.querySelector('.error').textContent = 'Số điện thoại hợp lệ phải dài 10 chữ số, không bao gồm chữ cái';
        flag = false;
    } else {
        var parent = document.add.number.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (KHaddr.length === 0){
        var parent = document.add.addr.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập địa chỉ';
        flag = false;
    } else {
        var parent = document.add.addr.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (KHmail.length === 0){
        var parent = document.add.mail.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập email';
        flag = false;
    } else if (!isValidEmail(KHmail)){
        var parent = document.add.mail.parentElement;
        parent.querySelector('.error').textContent = 'Email không hợp lệ';
        flag = false;
    } else {
        var parent = document.add.mail.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    return flag;
}

function checkloi_giong() {
    var name = document.giong.name.value;
    var loai = document.giong.loai.value;
    var kieulong = document.giong.kieulong.value;
    var kichthuoc = document.giong.kichthuoc ? document.giong.kichthuoc.value : '';
    var mau = document.giong.mau ? document.giong.mau.value : '';
    var vandong = document.giong.vandong ? document.giong.vandong.value : '';
    var runglong = document.giong.runglong ? document.giong.runglong.value : '';
    var nhomcho = document.giong.nhomcho ? document.giong.nhomcho.value : '';
    var vengoai = document.giong.vengoai ? document.giong.vengoai.value : '';
    var phobien = document.giong.phobien.value;

    var flag = true;

    // Kiểm tra tên giống
    if (name.length == 0) {
        var parent = document.giong.name.parentElement;
        parent.querySelector(".error").textContent = "Tên giống không được để trống.";
        flag = false;
    } else {
        var parent = document.giong.name.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    // Kiểm tra tên loài
    if (loai === "Chọn loài") {
        var parent = document.giong.loai.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn loài.";
        flag = false;
    } else {
        var parent = document.giong.loai.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    // Kiểm tra kiểu lông
    if (kieulong === "Chọn kiểu lông") {
        var parent = document.giong.kieulong.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn kiểu lông.";
        flag = false;
    } else {
        var parent = document.giong.kieulong.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (kichthuoc === "Chọn kích thước" && mau === "Chọn màu") {
        var parent = document.giong.kichthuoc.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn kích thước";
        var parent = document.giong.mau.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn màu";
        flag = false;
    } else {
        var parent = document.giong.kichthuoc.parentElement;
        parent.querySelector(".error").textContent = "";
        var parent = document.giong.mau.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (vandong === "Chọn mức độ" && runglong === "Chọn mức độ") {
        var parent = document.giong.vandong.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn mức độ vận động.";
        var parent = document.giong.runglong.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn mức độ rụng lông.";
        flag = false;
    } else {
        var parent = document.giong.vandong.parentElement;
        parent.querySelector(".error").textContent = "";
        var parent = document.giong.runglong.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (nhomcho === "Chọn nhóm chó" && vengoai === "Chọn vẻ ngoài") {
        var parent = document.giong.nhomcho.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn nhóm chó hoặc vẻ ngoài.";
        var parent = document.giong.vengoai.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn nhóm chó hoặc vẻ ngoài.";
        flag = false;
    } else {
        var parent = document.giong.nhomcho.parentElement;
        parent.querySelector(".error").textContent = "";
        var parent = document.giong.vengoai.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (phobien === "Chọn độ phổ biến") {
        var parent = document.giong.phobien.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn độ phổ biến.";
        flag = false;
    } else {
        var parent = document.giong.phobien.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    return flag;
}

function checkloi_giong_edit(){
    var name = document.giongedit.name.value;
    var loai = document.giongedit.loai.value;
    var kieulong = document.giongedit.kieulong.value;
    var kichthuoc = document.giongedit.kichthuoc ? document.giongedit.kichthuoc.value : '';
    var mau = document.giongedit.mau ? document.giongedit.mau.value : '';
    var vandong = document.giongedit.vandong ? document.giongedit.vandong.value : '';
    var runglong = document.giongedit.runglong ? document.giongedit.runglong.value : '';
    var nhomcho = document.giongedit.nhomcho ? document.giongedit.nhomcho.value : '';
    var vengoai = document.giongedit.vengoai ? document.giongedit.vengoai.value : '';
    var phobien = document.giongedit.phobien.value;

    var flag = true;

    // Kiểm tra tên giống
    if (name.length == 0) {
        var parent = document.giongedit.name.parentElement;
        parent.querySelector(".error").textContent = "Tên giống không được để trống.";
        flag = false;
    } else {
        var parent = document.giongedit.name.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    // Kiểm tra tên loài
    if (loai === "Chọn loài") {
        var parent = document.giongedit.loai.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn loài.";
        flag = false;
    } else {
        var parent = document.giongedit.loai.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    // Kiểm tra kiểu lông
    if (kieulong === "Chọn kiểu lông") {
        var parent = document.giongedit.kieulong.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn kiểu lông.";
        flag = false;
    } else {
        var parent = document.giongedit.kieulong.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (kichthuoc === "Chọn kích thước" && mau === "Chọn màu") {
        var parent = document.giongedit.kichthuoc.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn kích thước";
        var parent = document.giongedit.mau.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn màu";
        flag = false;
    } else {
        var parent = document.giongedit.kichthuoc.parentElement;
        parent.querySelector(".error").textContent = "";
        var parent = document.giongedit.mau.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (vandong === "Chọn mức độ" && runglong === "Chọn mức độ") {
        var parent = document.giongedit.vandong.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn mức độ vận động.";
        var parent = document.giongedit.runglong.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn mức độ rụng lông.";
        flag = false;
    } else {
        var parent = document.giongedit.vandong.parentElement;
        parent.querySelector(".error").textContent = "";
        var parent = document.giongedit.runglong.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (nhomcho === "Chọn nhóm chó" && vengoai === "Chọn vẻ ngoài") {
        var parent = document.giongedit.nhomcho.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn nhóm chó hoặc vẻ ngoài.";
        var parent = document.giongedit.vengoai.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn nhóm chó hoặc vẻ ngoài.";
        flag = false;
    } else {
        var parent = document.giongedit.nhomcho.parentElement;
        parent.querySelector(".error").textContent = "";
        var parent = document.giongedit.vengoai.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    if (phobien === "Chọn độ phổ biến") {
        var parent = document.giongedit.phobien.parentElement;
        parent.querySelector(".error").textContent = "Bạn phải chọn độ phổ biến.";
        flag = false;
    } else {
        var parent = document.giongedit.phobien.parentElement;
        parent.querySelector(".error").textContent = "";
    }

    return flag;
}

function checkloi_thucung(){
    var name = document.thucung.name.value;
    var anh = document.thucung.anh.files.length;
    var gioitinh = document.thucung.gioitinh.value;
    var tuoi = document.thucung.tuoi.value;
    var mau = document.thucung.mau.value;
    var tiemphong = document.thucung.tiemphong.value;
    var taygiun = document.thucung.taygiun.value;
    var gia = document.thucung.gia.value;
    var flag = true;

    if(!checkValidOption(document.thucung.idgiong,'#giong-list')) {
        var parent = document.thucung.idgiong.parentElement;
        parent.querySelector('.error').textContent = 'Bạn phải chọn mã giống từ danh sách';
        flag = false;
    } else {
        var parent = document.thucung.idgiong.parentElement;
        parent.querySelector('.error').textContent = '';
    }
    if (name.length == 0) {
        var parent = document.thucung.name.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập tên sản phẩm';
        flag = false;
    } else {
        var parent = document.thucung.name.parentElement;
        parent.querySelector('.error').textContent = '';
    }
    
    if (anh == 0) {
        var parent = document.thucung.anh.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn ảnh';
        flag = false;
    } else {
        var parent = document.thucung.anh.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (gioitinh == 'Chọn giới tính') {
        var parent = document.thucung.gioitinh.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn giới tính';
        flag = false;
    } else {
        var parent = document.thucung.gioitinh.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (tuoi.length == 0) {
        var parent = document.thucung.tuoi.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập tuổi';
        flag = false;
    } else if (containsNonAlphanumeric('tuoi')) {
        var parent = document.thucung.tuoi.parentElement;
        parent.querySelector('.error').textContent = 'Tuổi phải là số dương, không chứa các kí tự nào ngoài số và chữ cái';
        flag = false;
    } else {
        var parent = document.thucung.tuoi.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (mau.length == 0) {
        var parent = document.thucung.mau.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập màu';
        flag = false;
    } else {
        var parent = document.thucung.mau.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (tiemphong.length == 0) {
        var parent = document.thucung.tiemphong.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập số lần tiêm phòng';
        flag = false;
    } else {
        var parent = document.thucung.tiemphong.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (taygiun.length == 0) {
        var parent = document.thucung.taygiun.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập số lần tẩy giun';
        flag = false;
    } else {
        var parent = document.thucung.taygiun.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (gia.length == 0 || gia == 0) {
        var parent = document.thucung.gia.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập giá sản phẩm';
        flag = false;
    } else {
        var parent = document.thucung.gia.parentElement;
        parent.querySelector('.error').textContent = '';
    }
    return flag;
}

function checkloi_thucung_edit(){
    var name = document.thucungedit.name.value;
    var gioitinh = document.thucungedit.gioitinh.value;
    var tuoi = document.thucungedit.tuoi.value;
    var mau = document.thucungedit.mau.value;
    var tiemphong = document.thucungedit.tiemphong.value;
    var taygiun = document.thucungedit.taygiun.value;
    var gia = document.thucungedit.gia.value;
    var flag = true;

    if(!checkValidOption(document.thucungedit.idgiong,'#giong-list')) {
        var parent = document.thucungedit.idgiong.parentElement;
        parent.querySelector('.error').textContent = 'Bạn phải chọn mã giống từ danh sách';
        flag = false;
    } else {
        var parent = document.thucungedit.idgiong.parentElement;
        parent.querySelector('.error').textContent = '';
    }
    if (name.length == 0) {
        var parent = document.thucungedit.name.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập tên sản phẩm';
        flag = false;
    } else {
        var parent = document.thucungedit.name.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (gioitinh == 'Chọn giới tính') {
        var parent = document.thucungedit.gioitinh.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn giới tính';
        flag = false;
    } else {
        var parent = document.thucungedit.gioitinh.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (tuoi.length == 0) {
        var parent = document.thucungedit.tuoi.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập tuổi';
        flag = false;
    } else if (containsNonAlphanumeric('tuoi')) {
        var parent = document.thucungedit.tuoi.parentElement;
        parent.querySelector('.error').textContent = 'Tuổi phải là số dương, không chứa các kí tự nào ngoài số và chữ cái';
        flag = false;
    } else {
        var parent = document.thucungedit.tuoi.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (mau.length == 0) {
        var parent = document.thucungedit.mau.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập màu';
        flag = false;
    } else {
        var parent = document.thucungedit.mau.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (tiemphong.length == 0) {
        var parent = document.thucungedit.tiemphong.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập số lần tiêm phòng';
        flag = false;
    } else {
        var parent = document.thucungedit.tiemphong.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (taygiun.length == 0) {
        var parent = document.thucungedit.taygiun.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập số lần tẩy giun';
        flag = false;
    } else {
        var parent = document.thucungedit.taygiun.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (gia.length == 0) {
        var parent = document.thucungedit.gia.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng nhập giá sản phẩm';
        flag = false;
    } else {
        var parent = document.thucungedit.gia.parentElement;
        parent.querySelector('.error').textContent = '';
    }
    return flag;
}

function checkloi_donhang(){
    var optionKH = document.donhang.optionKH.value;
    var tongdonhang = document.donhang.tongdonhang.value;
    var pthuc = document.donhang.pthuc.value;
    var flag = true;

    if (optionKH == "Chọn loại khách hàng"){
        var parent = document.donhang.optionKH.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn loại khách hàng';
        flag = false;
    } else {
        var parent = document.donhang.optionKH.parentElement;
        parent.querySelector('.error').textContent = '';
        if (optionKH == "Khách hàng mới"){
            var KHname = document.donhang.nameKHmoi.value;
            var KHnumber = document.donhang.numberKHmoi.value;
            var KHmail = document.donhang.mailKHmoi.value;
            var KHaddr = document.donhang.addrKHmoi.value;
            if (KHname.length === 0){
                var parent = document.donhang.nameKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập họ và tên';
                flag = false;
            } else if (containNumber(KHname)){
                var parent = document.donhang.nameKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Họ và tên không bao gồm số';
                flag = false;
            } else {
                var parent = document.donhang.nameKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        
            if (KHnumber.length === 0){
                var parent = document.donhang.numberKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập số điện thoại';
                flag = false;
            } else if (KHnumber.length !== 10 || isNaN(KHnumber)){ 
                var parent = document.donhang.numberKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Số điện thoại hợp lệ phải dài 10 chữ số, không bao gồm chữ cái';
                flag = false;
            } else {
                var parent = document.donhang.numberKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        
            if (KHaddr.length === 0){
                var parent = document.donhang.addrKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập địa chỉ';
                flag = false;
            } else {
                var parent = document.donhang.addrKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        
            if (KHmail.length === 0){
                var parent = document.donhang.mailKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập email';
                flag = false;
            } else if (!isValidEmail(KHmail)){
                var parent = document.donhang.mailKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Email không hợp lệ';
                flag = false;
            } else {
                var parent = document.donhang.mailKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        } else if (optionKH == "Khách hàng cũ") {
            if (!checkValidOption(document.donhang.idKH,'#listKH')){
                var parent = document.donhang.idKH.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng chọn 1 khách hàng từ datalist!';
                flag = false;
            } else {
                var parent = document.donhang.idKH.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        }
    }

    if (tongdonhang == 0 || tongdonhang == ''){
        var parent = document.donhang.tongdonhang.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn ít nhất 1 sản phẩm từ datalist!';
        flag = false;
    } else {
        var parent = document.donhang.tongdonhang.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (pthuc == 'Chọn phương thức'){
        var parent = document.donhang.pthuc.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn phương thức thanh toán';
    } else {
        var parent = document.donhang.pthuc.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    return flag;
}

function checkloi_donhang_edit(){
    var optionKH = document.donhangedit.optionKH.value;
    var tongdonhang = document.donhangedit.tongdonhang.value;
    var pthuc = document.donhangedit.pthuc.value;
    var flag = true;

    if (optionKH == "Chọn loại khách hàng"){
        var parent = document.donhangedit.optionKH.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn loại khách hàng';
        flag = false;
    } else {
        var parent = document.donhangedit.optionKH.parentElement;
        parent.querySelector('.error').textContent = '';
        if (optionKH == "Khách hàng mới"){
            var KHname = document.donhangedit.nameKHmoi.value;
            var KHnumber = document.donhangedit.numberKHmoi.value;
            var KHmail = document.donhangedit.mailKHmoi.value;
            var KHaddr = document.donhangedit.addrKHmoi.value;
            if (KHname.length === 0){
                var parent = document.donhangedit.nameKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập họ và tên';
                flag = false;
            } else if (containNumber(KHname)){
                var parent = document.donhangedit.nameKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Họ và tên không bao gồm số';
                flag = false;
            } else {
                var parent = document.donhangedit.nameKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        
            if (KHnumber.length === 0){
                var parent = document.donhangedit.numberKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập số điện thoại';
                flag = false;
            } else if (KHnumber.length !== 10 || isNaN(KHnumber)){ 
                var parent = document.donhangedit.numberKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Số điện thoại hợp lệ phải dài 10 chữ số, không bao gồm chữ cái';
                flag = false;
            } else {
                var parent = document.donhangedit.numberKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        
            if (KHaddr.length === 0){
                var parent = document.donhangedit.addrKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập địa chỉ';
                flag = false;
            } else {
                var parent = document.donhangedit.addrKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        
            if (KHmail.length === 0){
                var parent = document.donhangedit.mailKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng nhập email';
                flag = false;
            } else if (!isValidEmail(KHmail)){
                var parent = document.donhangedit.mailKHmoi.parentElement;
                parent.querySelector('.error').textContent = 'Email không hợp lệ';
                flag = false;
            } else {
                var parent = document.donhangedit.mailKHmoi.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        } else if (optionKH == "Khách hàng cũ") {
            if (!checkValidOption(document.donhangedit.idKH,'#listKH')){
                var parent = document.donhangedit.idKH.parentElement;
                parent.querySelector('.error').textContent = 'Vui lòng chọn 1 khách hàng từ datalist!';
                flag = false;
            } else {
                var parent = document.donhangedit.idKH.parentElement;
                parent.querySelector('.error').textContent = '';
            }
        }
    }

    if (tongdonhang == 0 || tongdonhang == ''){
        var parent = document.donhangedit.tongdonhang.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn ít nhất 1 sản phẩm từ datalist!';
        flag = false;
    } else {
        var parent = document.donhangedit.tongdonhang.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    if (pthuc == 'Chọn phương thức'){
        var parent = document.donhangedit.pthuc.parentElement;
        parent.querySelector('.error').textContent = 'Vui lòng chọn phương thức thanh toán';
    } else {
        var parent = document.donhangedit.pthuc.parentElement;
        parent.querySelector('.error').textContent = '';
    }

    return flag;
}

function checkValidOption(input,datalistid) {
    var parent = input.parentElement;
    var inputValue = input.value;
    var datalist = parent.querySelector(datalistid);
    var options = datalist.options;
    var isValueInDatalist = false;

    for (var i = 0; i < options.length; i++) {
        if (options[i].value == inputValue) {
            isValueInDatalist = true;
            break;
        }
    }

    return isValueInDatalist;
}

function containsNonAlphanumeric(str) {
    for (var i = 0; i < str.length; i++) {
        var char = str[i];
        if (!(
            (char >= 'a' && char <= 'z') || 
            (char >= 'A' && char <= 'Z') ||
            (char >= '0' && char <= '9') ||
            char == ' '
        )) {
            return true;  
        }
    }
    return false; 
}

function containNumber(str) {
    for (var i = 0; i < str.length; i++) {
        if (!isNaN(str[i]) && str[i] !== ' ') {
            return true;
        }
    }
    return false;
}
function containWhiteSpace(str) {
    for (var i = 0; i < str.length; i++) {
        if (str[i] == ' ') {
            return true;
        }
    }
    return false;
}

function isValidEmail(str) {
    var acong = str.indexOf("@");
    var cham = str.lastIndexOf(".");

    if(acong < 1 || cham <= acong + 1 || cham === str.length - 1 || containWhiteSpace(str)){
        return false;
    }
    return true;
}

function checkValidEmail() {
    var mail = document.email.mail.value;
    var error = document.email.nextElementSibling;
    if (!isValidEmail(mail)){
        error.innerText = 'Vui lòng nhập email hợp lệ';
        return false;
    } else {
        error.innerText = '';
        return confirm('Bạn muốn có chắc chắn muốn sửa email này?');
    }
}

function checkValidName() {
    var name = document.username.name.value;
    var error = document.username.nextElementSibling;
    if (containNumber(name)){
        error.innerText = 'Tên hợp lệ không bao gồm số';
        return false;
    } else {
        error.innerText = '';
        return confirm('Bạn muốn có chắc chắn muốn sửa tên này?');
    }
}

function checkValidName() {
    var name = document.username.name.value;
    var error = document.username.nextElementSibling;
    if (containNumber(name)){
        error.innerText = 'Tên hợp lệ không bao gồm số';
        return false;
    } else {
        error.innerText = '';
        return confirm('Bạn muốn có chắc chắn muốn sửa tên này?');
    }
}

function checkValidPass() {
    var pass = document.password.pass.value;
    var error = document.password.nextElementSibling;
    if (pass.length < 6){
        error.innerText = 'Mật khẩu phải có độ dài ít nhất là 6 kí tự';
        return false;
    } else {
        error.innerText = '';
        return confirm('Bạn muốn có chắc chắn muốn sửa mật khẩu?');
    }
}

function addProduct(button) {
    var parent = button.parentElement;
    var productInput = parent.querySelector('#productSearch');
    var product = productInput.value;
    // if(sessionStorage.getItem('idarray') != ''){
    //     var idarray = sessionStorage.getItem('idarray').split(' ');
    //     var pdarray = sessionStorage.getItem('pdarray').split(',');
    //     if (!checkValidOption(productInput,'#productList') && !idarray.includes(product)) {
    //         button.parentElement.querySelector('.error').innerText = 'Vui lòng chọn 1 sản phẩm từ datalist';
    //         return;
    //     }
    // } else {
        if (!checkValidOption(productInput,'#productList')) {
            button.parentElement.querySelector('.error').innerText = 'Vui lòng chọn 1 sản phẩm từ datalist';
            return;
        }
    // }

    // Tìm option tương ứng để tách giá trị tên và giá
    var datalist = parent.querySelector('#productList');
    var options = datalist.querySelectorAll('option');
    var productName = '';
    var productPrice = '';

    //Thêm các tùy chọn vào datalist
    // var count = 0;
    // if (idarray.length != 0) {
    //     idarray.forEach(function(id) {
    //         var newOption = document.createElement('option');
    //         newOption.value = id;
    //         newOption.textContent = pdarray[count]; // Tên sản phẩm và giá
    //         newOption.style.display = 'none';

    //         datalist.appendChild(newOption);
    //         count++;
    //     });
    // }

    // Kiểm tra các tùy chọn
    
    for (var i = 0; i < options.length; i++) {
        var option = options[i];
        if (option.value === product) {
            var optionText = option.innerText;
            var stringValue = optionText.split('_');
            productName = stringValue[0];
            productPrice = parseInt(stringValue[1]);
            break;
        }
    }


    if (isDuplicate(parent, productName)){
        button.parentElement.querySelector('.error').innerText = 'Sản phẩm này đã được chọn!';
        return;
    }

    // Tạo hàng mới cho bảng
    var table = parent.querySelector('#productTable');
    var tbody = table.querySelector('tbody');
    var row = document.createElement('tr');
    row.innerHTML = `
        <td><input type="text" name="name[]" value="${productName}" hidden>${productName}</td>
        <td style="text-align:right;"><input type="number" name="price[]" value="${productPrice}" hidden>${productPrice}</td>
        <td style="text-align:center;"><button id="deletebutton" type="button" onclick="removeProduct(this)">Xóa</button></td>
    `;

    tbody.appendChild(row);

    var tong = table.nextElementSibling;
    var sum = tong.querySelector('#tongdonhangtext');
    var currentSum = parseInt(sum.innerText);
    var newSum = currentSum + productPrice;
    sum.innerText = newSum;
    parent.querySelector('#tongdonhang').value = newSum;

    table.style.display = '';
    tong.style.display = '';

    // Xóa nội dung ô nhập liệu
    productInput.value = '';
}

function isDuplicate(parent, value) {
    var table = parent.querySelector('#productTable');
    var rows = table.querySelectorAll('tbody tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td'); //xét từng ô của từng dòng
        if (cells[0].innerText.trim() == value.trim()) {
            return true;
        }
    }

    return false; // Giá trị không tồn tại
}

function removeProduct(button) {
    var row = button.closest('tr');

    var table = button.closest('table');
    var tong = table.nextElementSibling;
    var sum = tong.querySelector('#tongdonhangtext'); // tìm thẻ b

    var cells = row.querySelectorAll('td');
    var productPrice = parseInt(cells[1].innerText);

    var currentSum = parseInt(sum.innerText);
    var newSum = currentSum - productPrice;

    sum.innerText = newSum;
    tong.nextElementSibling.value = newSum;

    row.remove();
}