//file gồm các hàm liên quan đến chuyển hướng trên index và các vấn đề về tài khoản admin cá nhân

// Hàm cập nhật tiêu đề dựa trên trang hiển thị trong iframe
function updateTitle() {
    var iframe = document.querySelector('.main-content');
    var titleElement = document.querySelector('.title');
    
    var pageTitleList = {
        'home.php': 'Trang chủ',
        'thucung.php': 'Quản lí thú cưng',
        'khachhang.php': 'Quản lí khách hàng',
        'donhang.php': 'Quản lí đơn hàng',
        'tkqt.php': 'Danh sách quản trị',
        'account.php': 'Tài khoản',
    };

    var currentPage = iframe.contentWindow.location.pathname.split('/').pop(); //lấy tên file html
    var newTitle = pageTitleList[currentPage] || 'Trang khác';
    
    titleElement.textContent = newTitle;
}

// Hàm lưu trữ URL hiện tại của iframe vào sessionStorage
function saveIframeURL(url) {
    sessionStorage.setItem('iframeURL', url);
}

// Hàm tải lại URL từ sessionStorage khi trang được tải
function loadIframeURL() {
    var savedURL = sessionStorage.getItem('iframeURL');
    if (savedURL) {
        var iframe = document.querySelector('.main-content');
        iframe.src = savedURL;
    }
}

//Hàm bắt sự kiện load lại trang
document.addEventListener('DOMContentLoaded', function() {
    loadIframeURL(); // Tải lại URL từ sessionStorage khi trang được tải

    var iframe = document.querySelector('.main-content');
    
    // Gán sự kiện onload cho iframe để cập nhật tiêu đề và lưu URL
    iframe.onload = function() {
        var currentURL = iframe.contentWindow.location.href; // Lấy URL sau khi iframe đã tải
        updateTitle(); // Cập nhật tiêu đề
        saveIframeURL(currentURL); // Lưu lại URL vào sessionStorage
    };
});

//các function xử lí khi trang vừa được load
window.onload = function() {
    showtime();
}

//hàm đồng hồ của home.php
function showtime(){
    var now = new Date();
    var formattedDate = now.toLocaleDateString('vi-VN') + ' ' + now.toLocaleTimeString('vi-VN');
    upElements = document.querySelectorAll('#up');

    upElements.forEach(function(upElement) {
        upElement.textContent = formattedDate;
    });
}

function logout() {
    //dùng đối đối tượng url để tách link
    var link = new URL(sessionStorage.getItem('iframeURL'));
    //lấy ra mấy cái tên tệp
    var path = link.pathname.split('/');
    //bỏ cái sau / cuối ra
    path.pop();
    //link.origin là trả về link của hostname, path.join('/') là nối mấy phần tử vừa tách bằng /
    var resetURL = link.origin + path.join('/') + '/home.php';
    sessionStorage.setItem('iframeURL',resetURL);
}

//hàm ẩn mật khẩu của account
function showpass(){
    var passwordField = document.getElementById("pass");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordField.nextElementSibling.innerText = "Ẩn"
    } else {
        passwordField.type = "password";
        passwordField.nextElementSibling.innerText = "Hiển thị"
    }
    return false;
}

//hàm cho phép edit trên file account.html
function enableEdit(id){
    var input = document.querySelector(id);
    input.readOnly = false;
    input.select();

    var savebtn = input.parentElement.querySelector('#save');
    savebtn.style.display = '';
    savebtn.previousElementSibling.style.display = 'none';
    return false;
}