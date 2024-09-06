import { pets } from "./pets.js";
import { giong } from "./species.js";
import { addToCart, cart , formartMoney, updateQuantity } from "./cart.js";


updateQuantity();

const petId = JSON.parse(sessionStorage.getItem('id'));
let matchingPet = [] ;

pets.forEach((pet) => {
    if(petId === pet.id){
        matchingPet = pet;
    }
});
    

let detailsHTML = '';
export let spec = [];
let tableHTML = '';

giong.forEach((giong) => {
    if(matchingPet.magiong === giong.magiong){
        spec = giong;
    }
});

detailsHTML += `<div class="left-body0">
        <img class="img0" src="${matchingPet.img}">
    </div>
    <div class="right-body0">
        <div class="top">
            <p class="name">${matchingPet.name}</p>
            <p class="species">Giống ${spec.ten}</p>
            <p class="price">${formartMoney(Number(matchingPet.price))} VND</p>
        </div>
        <div class="bottom1">
            <div class="bottom">
                <div class="left-bottom">
                    <p class="status">Trạng thái:</p>
                    <p class="content-status">${matchingPet.status}</p>
                </div>
                <button class="add-button" id="addButton">Thêm vào giỏ hàng</button>
            </div>
            <div>
                <p id="result" class="result"></p>
            </div>
        </div>
    </div>`

tableHTML += `<caption align="top">Thông tin</caption>
            <tr>
                <td>Tuổi: ${matchingPet.tuoi}</td>
                <td>Giới tính: ${matchingPet.gioitinh}</td>
            </tr>
            <tr>
                <td>Màu: ${matchingPet.mau}</td>
                <td>Đặc điểm: ${spec.dovandong_runglong}</td>
            </tr>
            <tr>
                <td>Tiêm chủng: ${matchingPet.tiemphong}</td>
            <td>Tẩy giun: ${matchingPet.taygiun}</td>
            </tr>`

document.querySelector('.body0').innerHTML = detailsHTML;
document.querySelector('.table-info').innerHTML = tableHTML;

document.querySelectorAll('.add-button').forEach((button) => {
    button.addEventListener('click', () => {
        let check = true;
        if(cart){
            cart.forEach(cartItem => {
                if(cartItem.id === matchingPet.id){
                    check = false;
                }
            });
        }
    
        if(check){
            addToCart(matchingPet, spec.ten);
            updateQuantity();
            document.getElementById('result').innerHTML = 'Thêm thành công';
        }
        else document.getElementById('result').innerHTML = 'Thú cưng đã có trong giỏ hàng';
    });
});

//search------------------------

let petDisplayHTML = '';

let searchInput = document.querySelector('.search');
let div = document.querySelector('.products');

searchInput.addEventListener('click', function(){
    document.getElementById('pet').style.display = 'block';

    pets.forEach(item =>{
        /*let newProduct = document.createElement('div');
        newProduct.classList.add('product');
        newProduct.value = `${item.id}`
        newProduct.innerHTML = `<img src="${item.img}">
                                <div class="info">
                                    <div class="name">${item.name}</div>
                                    <div class="price">${item.price}</div>
                                </div>`;
        
        products.appendChild(newProduct);*/
    
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

/*document.querySelectorAll('.productSearch').forEach(link => {
    link.addEventListener('click', function(e){
        const petId = this.dataset.petId;
        //console.log(petId);

        sessionStorage.setItem('id', JSON.stringify(petId));
    })
})*/

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
