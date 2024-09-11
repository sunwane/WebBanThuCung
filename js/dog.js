import { pets } from './pets.js';
import { giong } from './species.js';
import { formartMoney, updateQuantity } from "./cart.js";

updateQuantity();

let petsHTML = '';

function display(){
    pets.forEach(function (pet) {
        let species

        giong.forEach((giongItem) => {
            if (pet.magiong === giongItem.magiong) {
                species = giongItem; 
            }
        });

        
        if (species && species.tenloai === 'Chó') {
            petsHTML += `
                <div class="product">
                    <img src="${pet.img}">
                    <div class="info">
                        <div>
                            <p class="name">${pet.name}</p>
                            <p class="popularity">${species.popular}</p>
                        </div>
                        <div>
                            <a href="PetDetails.html" class="js-show-detail" data-pet-id="${pet.id}">
                                <button class="js-link">Xem ngay</button>
                            </a>
                        </div>
                    </div>
                </div>
            `;
        }
    });

    document.getElementById('displayAll').innerHTML = petsHTML;
}

display();

//có 2 thẻ div chứa 2 nội dung khác nhau
//div displayAll chứa tất cả sản phẩm là chó
//div filterDisplay chứa các sản phẩm sau khi lọc
//2 div này chỉ được xuất hiện 1 trong 2 trong 1 thời điểm
document.getElementById('filter-button').addEventListener('click', () => {
    document.getElementById('displayAll').style.display = 'none';
    
    let filter = '';
    
    // Lấy giá trị từ các thẻ <select>
    const kieuLong = document.getElementById('kl-select').value;
    const kichThuoc = document.getElementById('kt-select').value;
    const nhomCho = document.getElementById('nc-select').value;
    const mucDoVanDong = document.getElementById('mdvd-select').value;

    // Lặp qua từng pet và lọc theo các tiêu chí đã chọn
    pets.forEach(function (pet) {
        let species = null; // Đặt species thành null ban đầu

        // Tìm species khớp với pet.magiong
        giong.forEach((giongItem) => { //tìm giống tương ứng với thú cưng
            if (pet.magiong === giongItem.magiong) {
                species = giongItem; // Gán species khi tìm thấy
            }
        });

        // Kiểm tra nếu thú cưng với các điều kiện lọc có tồn tại và thuộc loại "Chó"
        if (species && species.tenloai === 'Chó') {
            // Xác định điều kiện lọc
            let match = true;

            // Kiểm tra từng điều kiện
            //nếu dữ liệu trong thẻ select khác 'Chọn' và không khớp với kích thước của thú cưng hiện tại
            //nên sẽ bỏ qua không hiển thị pet này
            if (kichThuoc !== 'Chọn' && species.kichthuoc_mau !== kichThuoc) { 
                match = false;
            }
            if (kieuLong !== 'Chọn' && species.kieulong !== kieuLong) {
                match = false;
            }
            if (mucDoVanDong !== 'Chọn' && species.dovandong_runglong !== mucDoVanDong) {
                match = false;
            }
            if (nhomCho !== 'Chọn' && species.nhomcho_vengoai !== nhomCho) {
                match = false;
            }

            // Nếu tất cả các điều kiện đều khớp (match vẫn là true), thêm pet vào kết quả lọc
            if (match) {
                filter += `<div class="product">
                                <img src="${pet.img}">
                                <div class="info">
                                    <div>
                                        <p class="name">${pet.name}</p>
                                        <p class="popularity">${species.popular}</p>
                                    </div>
                                    <div>
                                        <a href="PetDetails.html" class="js-show-detail" data-pet-id="${pet.id}">
                                            <button class="js-link">Xem ngay</button>
                                        </a>
                                    </div>
                                </div>
                            </div>`;
            }
        }
    });

    // Nếu không có sản phẩm nào được lọc, hiển thị thông báo
    if (filter === '') {
        filter = 'Không có sản phẩm';
    }

    // Cập nhật kết quả lọc
    document.getElementById('filterDisplay').style.display = 'flex' //hiển thị phần tử div kết quả lọc
    document.getElementById('filterDisplay').innerHTML = filter //thêm đoạn code html để hiển thị
});


document.getElementById('bo-filter-button').addEventListener('click', function(){ 
    document.getElementById('filterDisplay').style.display = 'none' 
    document.getElementById('displayAll').style.display = 'flex'
})

document.querySelectorAll('.js-link').forEach((link) => {
    link.addEventListener('click', function() {
        const petId = this.closest('.js-show-detail').dataset.petId;
        sessionStorage.setItem('id', JSON.stringify(petId));
    });
});

export function search(){
    let petHTML = '';

    let searchInput = document.querySelector('.search');
    let div = document.querySelector('.products');

    searchInput.addEventListener('click', function(e){
        document.getElementById('pet').style.display = 'block';

        pets.forEach(item =>{
        
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
        
        document.getElementById('pet').innerHTML = petHTML;
    })


    document.getElementById('pet').addEventListener('click', function (e) {
        if (e.target.closest('.product')) {
            const petId = e.target.closest('.product').dataset.petId;
            sessionStorage.setItem('id', JSON.stringify(petId));
        }
    });

    searchInput.addEventListener('input', function(result){
        let txtSearch = result.target.value.trim().toLowerCase();
        let listProductDOM = document.querySelectorAll('.product')
        listProductDOM.forEach(item => {
            //console.log(item.innerText);
            if(item.innerText.toLowerCase().includes(txtSearch)){
                item.classList.remove('hide');
            }
            else{
                item.classList.add('hide'); //khong trung voi tu khoa search thi an di
            }
        })
    })


    document.addEventListener('click', (event) => {
        if (!searchInput.contains(event.target) && !div.contains(event.target)) {
            div.style.display = 'none';
        }
    });
}

search();
