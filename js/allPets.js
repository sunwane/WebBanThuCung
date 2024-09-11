import {pets} from './pets.js'
import {giong} from './species.js'
import {updateQuantity, formartMoney} from './cart.js'

updateQuantity();

let petsHTML = '';


pets.forEach(function(pet){
    let species =[];
    giong.forEach((giong) => { //tìm giống đúng cho mỗi thú cưng
        if(pet.magiong === giong.magiong){
            species = giong;
        }
    })

    petsHTML += `
        <div class="product">
            <img src="${pet.img}">
            <div class="info">
                <div>
                    <p class="name">${pet.name}</p>
                    <p class="popularity">${species.popular}</p>
                </div>
                <div>
                    <a href="PetDetails.html"  class="js-show-detail" data-pet-id="${pet.id}">
                        <button class="js-link" >Xem ngay</button>
                    </a>
                </div>
                
            </div>
        </div>
    `;
});

document.querySelector('.body0').innerHTML = petsHTML; //truy xuất đến div body0 và thêm đoạn code html hiển thị tất cả thú cưng

document.querySelectorAll('.js-link').forEach((link) => { //chọn tất cả các nút xem ngay của từng sản phẩm với giá trị id khác nhau
    //querySelectorAll trả về Nodelist
    link.addEventListener('click', function() { //thêm sự kiện click cho tất cả nút xem ngay
        const petId = this.closest('.js-show-detail').dataset.petId; // lấy dữ liệu từ thuộc tính data-pet-id
        sessionStorage.setItem('id', JSON.stringify(petId));
    });
});


//search--------------------------------------------------

let petDisplayHTML = '';

let searchInput = document.querySelector('.search input');
let div = document.querySelector('.products');

searchInput.addEventListener('click', function(e){
    document.getElementById('pet').style.display = 'block';

    pets.forEach(item =>{
        petDisplayHTML += `<a href="PetDetails.html" class='productSearch' data-pet-id = ${item.id}>
                        <div class='product1'>
                            <img src="${item.img}">
                            <div class="info">
                                <div class="name">${item.name}</div>
                                <div class="price">${formartMoney(Number(item.price))}</div>
                            </div>
                        </div>
                    </a>`
    
    })
    
    document.getElementById('pet').innerHTML = petDisplayHTML;
})

searchInput.addEventListener('input', function(result){
    let txtSearch = result.target.value.trim().toLowerCase();
    let listProductDOM = document.querySelectorAll('.productSearch')
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

document.getElementById('pet').addEventListener('click', function (e) {
    if (e.target.closest('.productSearch')) {
        const petId = e.target.closest('.productSearch').dataset.petId;
        sessionStorage.setItem('id', JSON.stringify(petId));
    }
});

document.addEventListener('click', (event) => {
    if (!searchInput.contains(event.target) && !div.contains(event.target)) {
        div.style.display = 'none';
    }
});
