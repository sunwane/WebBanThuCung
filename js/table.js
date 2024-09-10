function closePopup() {
    var overlays = document.querySelectorAll('#overlay')
    overlays.forEach(function(overlay){
        overlay.style.display = 'none';
    })
    var popups = document.querySelectorAll('.popup');
    popups.forEach(function(popup) {
        popup.style.display = 'none';
    });
    var edits = document.querySelector('.edit')
    edits.forEach(function(edit){
        edit.style.display = 'none';
    });
    // var table = document.querySelector('#productTable');
    // table.style.display = 'none';
    // var rows = table.querySelectorAll('tbody tr');
    // for (var i = 0; i < rows.length; i++) {
    //     rows[i].remove();
    // }
    var adds = document.querySelector('.add')
    adds.forEach(function(add){
        add.style.display = 'none';
    })
    var inputs = document.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.value = '';
    })
    var selects = document.querySelectorAll('select');
    selects.forEach(function(select) {
        select.selectedIndex = 0;
    })
}
function openPopup(button, table, id='') {
    document.getElementById('overlay').style.display = '';
    document.querySelector('.popup').style.display = '';
    var type = button.innerText;
    if(type === "+ THÊM MỚI"){
        document.getElementById('popup-type').textContent = 'Thêm mới';
        document.querySelector('.add').style.display = '';
        document.querySelector('.edit').style.display = 'none';

    } else if (type === "Sửa" && table == 'khachhang'){
        document.getElementById('popup-type').textContent = 'Chỉnh sửa';

        document.querySelector('.edit').style.display = '';
        document.querySelector('.add').style.display = 'none';

        var tr = button.parentElement.parentElement;
        var cells = tr.querySelectorAll('td');

        var form = document.querySelectorAll('form');
        var editform = form[2];

        editform.querySelector('input[name="id"]').value = cells[0].textContent;
        editform.querySelector('input[name="name"]').value = cells[1].textContent;
        editform.querySelector('input[name="number"]').value = cells[2].textContent;
        editform.querySelector('input[name="addr"]').value = cells[3].textContent;
        editform.querySelector('input[name="mail"]').value = cells[4].textContent;
    } else if (type === "Sửa" && table == 'Giong'){
        document.getElementById('popup-type').textContent = 'Chỉnh sửa';

        document.querySelector('.edit').style.display = '';
        document.querySelector('.add').style.display = 'none';

        var tr = button.parentElement.parentElement;
        var cells = tr.querySelectorAll('td');

        var form = document.querySelectorAll('form');
        var editform = form[2];

        editform.querySelector('input[name="id"]').value = cells[0].textContent;
        editform.querySelector('input[name="name"]').value = cells[1].textContent;
        editform.querySelector('select[name="loai"]').value = cells[2].textContent;
        editform.querySelector('select[name="kieulong"]').value = cells[3].textContent;
        if(editform.querySelector('select[name="loai"]').value == "Chó"){
            editform.querySelector('#kichthuoc').style.display = '';
            editform.querySelector('#vandong').style.display = '';
            editform.querySelector('#nhomcho').style.display = '';
            editform.querySelector('#mau').style.display = 'none';
            editform.querySelector('#runglong').style.display = 'none';
            editform.querySelector('#vengoai').style.display = 'none';
            editform.querySelector('select[name="kichthuoc"]').value = cells[4].textContent;
            editform.querySelector('select[name="vandong"]').value = cells[5].textContent;
            editform.querySelector('select[name="nhomcho"]').value = cells[6].textContent;
        } else {
            editform.querySelector('#mau').style.display = '';
            editform.querySelector('#runglong').style.display = '';
            editform.querySelector('#vengoai').style.display = '';
            editform.querySelector('#kichthuoc').style.display = 'none';
            editform.querySelector('#vandong').style.display = 'none';
            editform.querySelector('#nhomcho').style.display = 'none';
            editform.querySelector('select[name="mau"]').value = cells[4].textContent;
            editform.querySelector('select[name="runglong"]').value = cells[5].textContent;
            editform.querySelector('select[name="vengoai"]').value = cells[6].textContent;
        }
        editform.querySelector('select[name="phobien"]').value = cells[7].textContent;
        editform.querySelector('select[name="tinhtrang"]').value = cells[8].textContent;
    } else if (type === "Sửa" && table == 'ThuCung'){
        document.getElementById('popup-type').textContent = 'Chỉnh sửa';

        document.querySelector('.edit').style.display = '';
        document.querySelector('.add').style.display = 'none';

        var tr = button.parentElement.parentElement;
        var cells = tr.querySelectorAll('td');

        var form = document.querySelectorAll('form');
        var editform = form[2];

        editform.querySelector('input[name="id"]').value = cells[0].textContent;
        editform.querySelector('input[name="idgiong"]').value = cells[1].textContent;

        var name = cells[2].textContent.split(" ");
        var originname = name.slice(0,-1).join(" ");
        editform.querySelector('input[name="name"]').value = originname;
        editform.querySelector('select[name="gioitinh"]').value = cells[4].textContent;
        editform.querySelector('input[name="tuoi"]').value = cells[5].textContent;
        editform.querySelector('input[name="mau"]').value = cells[6].textContent;
        editform.querySelector('input[name="tiemphong"]').value = cells[7].textContent;
        editform.querySelector('input[name="taygiun"]').value = cells[8].textContent;
        editform.querySelector('select[name="tinhtrang"]').value = cells[9].textContent;
        editform.querySelector('input[name="gia"]').value = cells[10].textContent;
    } else if (type === "Sửa" && table == 'DonHang') {
        document.getElementById('popup-type').textContent = 'Chỉnh sửa';

        document.querySelector('.edit').style.display = '';
        document.querySelector('.add').style.display = 'none';

        var tr = button.parentElement.parentElement;
        var cells = tr.querySelectorAll('td');

        var table2 = tr.nextElementSibling.querySelector('tbody'); //xác định phần thân của bảng con chứa sản phẩm
        var allproduct = table2.querySelectorAll('tr'); //lấy tất cả các hàng

        var form = document.querySelectorAll('form');
        var editform = form[2];

        var table = editform.querySelector('#productTable'); //table chứa giỏ hàng
        table.style.display = '';
        var tbody = table.querySelector('tbody');
        while (tbody.firstChild) { //xóa hết tất cả con của tbody trong giỏ hàng
            tbody.removeChild(tbody.firstChild);
        }

        allproduct.forEach(function (product) {
            var pcells = product.querySelectorAll('td');

            var productName = pcells[1].textContent; // Tên Sản Phẩm
            var productPrice = parseInt(pcells[2].textContent); // Giá Sản Phẩm

            // Tạo hàng mới cho bảng sản phẩm động trong popup
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" name="name[]" value="${productName}" hidden>${productName}</td>
                <td style="text-align:right;"><input type="number" name="price[]" value="${productPrice}" hidden>${productPrice}</td>
                <td style="text-align:center;"><button id="deletebutton" type="button" onclick="removeProduct(this)">Xóa</button></td>
            `;

            tbody.appendChild(newRow);

        });
        
        editform.querySelector('input[name="id"]').value = cells[0].textContent;
        editform.querySelector('select[name="optionKH"]').value = 'Khách hàng cũ';
        editform.querySelector('input[name="idKHmoi"]').value = '';
        editform.querySelector('input[name="nameKHmoi"]').value = '';
        editform.querySelector('input[name="addrKHmoi"]').value = '';
        editform.querySelector('input[name="mailKHmoi"]').value = '';
        editform.querySelector('input[name="numberKHmoi"]').value = '';
        editform.querySelector('input[name="idKH"]').value = cells[1].textContent;
        editform.querySelector('.khachhangcu').style.display = '';

        editform.querySelector('#tong').style.display = '';
        editform.querySelector('#tongdonhangtext').innerText = cells[6].textContent;
        editform.querySelector('input[name="tongdonhang"]').value = cells[6].textContent;

        editform.querySelector('textarea[name="gchu"]').value = cells[7].textContent;
        editform.querySelector('select[name="pthuc"]').value = cells[8].textContent;
        editform.querySelector('select[name="trangthai"]').value = cells[11].textContent;

        var tt = cells[11].textContent;
        if(tt == 'Đã giao thành công'){
            editform.querySelector('input[name="id"]').parentElement.style.display = 'none';
            editform.querySelector('select[name="optionKH"]').parentElement.style.display = 'none';
            editform.querySelector('input[name="idKHmoi"]').parentElement.style.display = 'none';
            editform.querySelector('input[name="nameKHmoi"]').parentElement.style.display = 'none';
            editform.querySelector('input[name="addrKHmoi"]').parentElement.style.display = 'none';
            editform.querySelector('input[name="mailKHmoi"]').parentElement.style.display = 'none';
            editform.querySelector('input[name="numberKHmoi"]').parentElement.style.display = 'none';
            editform.querySelector('input[name="idKH"]').parentElement.style.display = 'none';
            editform.querySelector('.khachhangcu').parentElement.style.display = 'none';
            editform.querySelector('.khachhangmoi').parentElement.style.display = 'none';
            editform.querySelector('#productSearch').parentElement.style.display = 'none';
            table.style.display = 'none';
            editform.querySelector('#tong').style.display = 'none';
            editform.querySelector('textarea[name="gchu"]').parentElement.style.display = 'none';
            editform.querySelector('select[name="pthuc"]').parentElement.style.display = 'none';
        } else {
            editform.querySelector('input[name="id"]').parentElement.style.display = '';
            editform.querySelector('select[name="optionKH"]').parentElement.style.display = '';
            editform.querySelector('input[name="idKHmoi"]').parentElement.style.display = '';
            editform.querySelector('input[name="nameKHmoi"]').parentElement.style.display = '';
            editform.querySelector('input[name="addrKHmoi"]').parentElement.style.display = '';
            editform.querySelector('input[name="mailKHmoi"]').parentElement.style.display = '';
            editform.querySelector('input[name="numberKHmoi"]').parentElement.style.display = '';
            editform.querySelector('input[name="idKH"]').parentElement.style.display = '';
            editform.querySelector('.khachhangcu').parentElement.style.display = '';
            editform.querySelector('.khachhangmoi').parentElement.style.display = '';
            editform.querySelector('#productSearch').parentElement.style.display = '';
            table.style.display = '';
            editform.querySelector('#tong').style.display = '';
            editform.querySelector('textarea[name="gchu"]').parentElement.style.display = '';
            editform.querySelector('select[name="pthuc"]').parentElement.style.display = '';
        }
    }
}
function openTab(button, tabName) {

    var i, tabcontent, tablinks;

    //ẩn hết các tab
    tabcontent = document.querySelectorAll(".tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    //xóa class active của tất cả
    tablinks = document.querySelectorAll(".tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("active");
    }

    document.getElementById(tabName).style.display = "";
    
    //thêm class active
    button.classList.add("active");

    //.location trả về 1 nhóm hash, href, search, pathname...
    //.href trả về link đây đủ
    //.search trả về sau ?
    //pathname trả về sau / cuối cùng ko trả về sau ?

    var url = new URL(window.location.href);
    url.searchParams.set('tab', tabName); // Thêm hoặc cập nhật tham số 'tab'
    sessionStorage.setItem('iframeURL',url);
    history.pushState({}, '', url); // Thay đổi URL mà không làm mới trang
}

function checkActiveTab() {
    const urlParams = new URLSearchParams(window.location.search); //dùng để thao tác trên url hiện tại
    if (urlParams.has('tab')) {
        const currentTab = urlParams.get('tab'); // Lấy giá trị của tham số 'tab' trong URL
        var tablinks = document.querySelectorAll(".tablink"); //duyệt qua các nút, nút nào có giá trị tab tương ứng thì thêm active
        tablinks.forEach(function (button) {
            if (button.getAttribute('data-tab') === currentTab) {
                button.classList.add("active");
                openTab(button, currentTab);
            } else {
                button.classList.remove("active");
            }
        });
    }
}

window.onload = function() {
    checkActiveTab();
};

document.addEventListener('DOMContentLoaded', function() {
    var loaiSelects = document.querySelectorAll('#loai');
    
    loaiSelects.forEach(function(loai) {
        loai.addEventListener('change', function() {
            var form = this.closest('form');
            updateFormFields(form, this.value);
        });
    });

    function updateFormFields(form, loaiValue) {
        if (loaiValue == "Chó") {
            form.querySelector('#kichthuoc').style.display = '';
            form.querySelector('#vandong').style.display = '';
            form.querySelector('#nhomcho').style.display = '';
            form.querySelector('#mau').style.display = 'none';
            form.querySelector('#runglong').style.display = 'none';
            form.querySelector('#vengoai').style.display = 'none';
        } else if (loaiValue == 'Mèo') {
            form.querySelector('#kichthuoc').style.display = 'none';
            form.querySelector('#vandong').style.display = 'none';
            form.querySelector('#nhomcho').style.display = 'none';
            form.querySelector('#mau').style.display = '';
            form.querySelector('#runglong').style.display = '';
            form.querySelector('#vengoai').style.display = '';
        } else {
            form.querySelector('#kichthuoc').style.display = 'none';
            form.querySelector('#vandong').style.display = 'none';
            form.querySelector('#nhomcho').style.display = 'none';
            form.querySelector('#mau').style.display = 'none';
            form.querySelector('#runglong').style.display = 'none';
            form.querySelector('#vengoai').style.display = 'none';
        }
    }
});


document.addEventListener('DOMContentLoaded', function() {
    var options = document.querySelectorAll('#optionKH');
    
    options.forEach(function(option){
        option.addEventListener('change', function() {
            var form = this.closest('form'); //tìm cha là form của optionKH
            updateFormFields(form, this.value);
        });  
    });

    function updateFormFields(form, optionvalue) {
        if (optionvalue == "Khách hàng mới") {
            form.querySelector('.khachhangmoi').style.display = '';
            form.querySelector('.khachhangcu').style.display = 'none';
        } else if (optionvalue == 'Khách hàng cũ') {
            form.querySelector('.khachhangmoi').style.display = 'none';
            form.querySelector('.khachhangcu').style.display = '';
        } else {
            form.querySelector('.khachhangmoi').style.display = 'none';
            form.querySelector('.khachhangcu').style.display = 'none';
        }
    }
});

function turnBack(){
    history.replaceState(null, '', document.referrer); // Đặt URL hiện tại trong lịch sử thành URL trước đó
    history.go(-1); // Quay lại trang trước đó
}

function showDetails(button){
    var parentRow = button.parentElement.parentElement;
    var childRow = parentRow.nextElementSibling;

    if (childRow) {
        if (childRow.style.display === 'none' || childRow.style.display === '') {
            childRow.style.display = 'table-row';
            button.innerText = 'Ẩn';
        } else {
            childRow.style.display = 'none';
            button.innerText = 'Chi tiết';
        }
    }
}