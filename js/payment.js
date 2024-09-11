import {cart, formartMoney} from './cart.js'


let tableHTML ='', sum = 0;

cart.forEach((cartItem) => { //thêm các sản phẩm trong giỏ hàng vào hóa đơn
    if(cartItem.id){ //neu id khong trong
        tableHTML += `<tr>
                    <td>${cartItem.name}</td>
                    <td class='price-table'>${formartMoney(Number(cartItem.price))}</td>
                </tr>`
        sum+=Number(cartItem.price);
    }
})

document.getElementById('table').innerHTML = tableHTML;
document.getElementById('sum').innerHTML = formartMoney(sum) + " VND"; //tính và hiển thị tổng hóa đơn

let district = {
    hcm: ['Quận 1', 'Quận 2', 'Quận 3', 'Quận 4'],
    hn: ['Hoàn Kiếm', 'Cầu Giấy', 'Đống Đa', 'Tây Hồ'],
    dn: ['Hải Châu', 'Thanh Khê', 'Ngũ Hành Sơn', 'Sơn Trà'],
    hp: ['Hồng Bàng', 'Ngô Quyền', 'Lê Chân', 'Kiến An']
};

let districtHTML = '';

function districtDisplay(){ //hiển thị quận tương ứng với tỉnh/tp được chọn 
    districtHTML = '';
    const cityChange = document.getElementById('city').value; //lấy giá trị của tp được chọn
    const districtOption = district[cityChange]; //tạo mảng với danh sách quận 

    districtOption.forEach(option => { //duyệt qua từng quận và thêm đoạn mã html
        districtHTML += `<option>${option}</option>`
    });

    document.getElementById('district').innerHTML = districtHTML; //thêm các option và select
}

document.getElementById('city').addEventListener('change', districtDisplay); //thêm sự kiện change cho thẻ select city

const table = document.getElementById('table'); //truy xuất bảng
document.getElementById('sumData').value = sum; 
const rows = table.getElementsByTagName("tr");
var tableData = [];
cart.forEach(pet => { //thêm các sản phẩm vào mảng tableData
    if(pet.id != ''){
        var product = pet.name;
        var price = Number(pet.price);
        tableData.push({ product: product, price: price });
    }
});
document.getElementById('tableData').value = JSON.stringify(tableData); //chuyển mảng thành chuỗi json


document.addEventListener("DOMContentLoaded", function() { 
    //Đoạn mã này đảm bảo rằng hàm bên trong sẽ được thực thi khi tài liệu HTML đã được tải xong
    const buttonOrder = document.getElementById("dat-hang-button");
    //const form = document.querySelector("form");

    buttonOrder.addEventListener("click", function(event) { //thêm sự kiện cho nút đặt hàng
        
        //event.preventDefault(); // Ngăn chặn việc gửi form và tải lại trang mặc định
        
        if (check() ) { //nếu check tất cả lỗi đều không có thì 
            alert("Đặt hàng thành công");
        } else { //nếu có lỗi thì
            event.preventDefault(); // Ngăn chặn việc gửi form và tải lại trang mặc định
            console.log('Chua dien dung hoac du thong');
            //alert("Đặt hàng không thành công");
        }
    });
});

function check(){ //kiểm tra lỗi khi khách hàng nhập vaò thông tin khách hàng
    let check = true;
    const name = document.getElementById("ten").value;
    const address = document.getElementById("address").value;
    const phone = document.getElementById("sdt").value;
    const email = document.getElementById("email").value; 

    let loiphone = '';
    let loiemail = '';
    let loiname = '';
    let loiaddress = '';

    if(name.length < 5){
        loiname += "Hãy nhập đủ họ tên";
        check = false;
    }

    document.getElementById("name-p").innerHTML = loiname;
    
    if(address.length < 1){
        loiaddress += "Hãy nhập số nhà, tên đường, phường";
        check = false;
    }

    document.getElementById("address-p").innerHTML = loiaddress;

    if(phone.length < 1 || phone.length > 10){
        loiphone +=  "Hãy nhập đúng 10 chữ số";
        check = false;
    }

    if(isNaN(phone)){
        loiphone +=  "Hãy nhập số";
        check = false;
    }

    document.getElementById('phone-p').innerHTML = loiphone;


    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)){
        loiemail += "Hãy nhập email đúng";
        check = false;
    }

    document.getElementById("email-p").innerHTML = loiemail;
    return check;
}

function checkDataInfo(){
    const name = document.getElementById("ten").value;
    const address = document.getElementById("address").value;
    const phone = document.getElementById("sdt").value;
    const email = document.getElementById("email").value; 
    let check = true; //da co du lieu
    if(isEmpty(name) && isEmpty(address) && isEmpty(phone) && isEmpty(email)){
        check = false; //chua co du lieu
    }
    return check;
}