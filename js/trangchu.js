import {updateQuantity, formartMoney} from './cart.js'
import {pets} from './pets.js'

//localStorage.removeItem('quantity');
//localStorage.removeItem('cart');

updateQuantity();

let petHTML = ''; //biến lưu đoạn code html của kết quả tìm kiếm

let searchInput = document.querySelector('.search input'); //truy xuất đến thẻ input nơi nhập thông tin tìm
let div = document.querySelector('.products'); //truy xuất đến thẻ div nơi in ra kết quả tìm kiếm



searchInput.addEventListener('click', function(e){ //sự kiện khi nhấn vào thẻ input
    document.getElementById('pet').style.display = 'block'; // Hiển thị div chứa danh sách thú cưng.

    pets.forEach(item =>{ //duyệt qua từng sản phẩm và thêm vào đoạn code html hiển thị danh sách thú cưng
                            // mỗi thú cưng được hiển thị dưới thẻ <a>
        petHTML += `<a href="PetDetails.html" class='product' data-pet-id = ${item.id}> 
                        <div class='product1'>
                        <p id='idP' style="display: none">${item.id}</p>
                            <img src="${item.img}">
                            <div class="info">
                                <div class="name">${item.name}</div>
                                <div class="price">${formartMoney(Number(item.price))}</div>
                            </div>
                        </div>
                    </a>`

    
    })
    
    document.getElementById('pet').innerHTML = petHTML; //thêm đoạn code html vào thẻ div hiển thị danh sách thú cưng
})


document.getElementById('pet').addEventListener('click', function (e) {  //khi click vào bất cứ 1 thẻ <a> nào thì thực thi
    if (e.target.closest('.product')) {
        const petId = e.target.closest('.product').dataset.petId; // lấy id từ thuộc tính data- của thẻ <a> 
        //e.target.closest('.product') : lấy phần tử gần nhất có class product khi ckicl vào
        //dataset.petId: lấy giá trị của thuộc tính data-id-pet
        sessionStorage.setItem('id', JSON.stringify(petId)); //lưu id vừa lấy vào session
    }
});

searchInput.addEventListener('input', function(result){ //khi click vào input
    let Search = xoa_dau(result.target.value.trim().toLowerCase()); //Lấy giá trị từ khóa được nhập
    //trim bỏ khoảng cách trắng; xoa_dau bỏ dấu; toLowerCase chuyển về chữ thường
    let listProduct = document.querySelectorAll('.product') //truy xuất đến tất cả sản phẩm 
    listProduct.forEach(item => { //với mỗi thú cưng
        let product = xoa_dau(item.innerText.toLowerCase())//lấy tất cả nội dung của từng sản phẩm gồm tên giá bỏ dấu chuyển về chữ thường
        if(product.includes(Search)){ //kiểm tra chuỗi con (chuỗi tìm kiếm) có nằm trong chuỗi lớn (nội dung của sản phẩm)
            item.classList.remove('hide'); //nếu true sản phẩm đc bỏ lớp hide 
        }
        else{
            item.classList.add('hide'); //khong trung voi tu khoa search thi an di bằng cách thêm lớp hide
        }
    })
})


document.addEventListener('click', (event) => {
    if (!searchInput.contains(event.target) && !div.contains(event.target)) { //nếu người dùng không nhấn chuột vào input và sản phẩm nào
        //event.target là nơi người dùng click vào.
        //contains được sử dụng để kiểm tra xem một phần tử cụ thể có chứa một phần tử khác hay không
        //kiểm tra xem nơi mà người dùng click có nằm trong searchInput hoặc trong danh sách sản phẩm (div) hay không
        div.style.display = 'none'; //nếu không thì ẩn div đi
    }
});

function xoa_dau(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a')
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e')
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, 'i')
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o')
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u')
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y')
    str = str.replace(/đ/g, 'd')
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, 'A')
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, 'E')
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, 'I')
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, 'O')
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, 'U')
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, 'Y')
    str = str.replace(/Đ/g, 'D')
    return str
  }
  