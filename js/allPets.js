import {pets} from './pets.js'
import { giong } from './species.js'
import {updateQuantity, formartMoney} from './cart.js'

updateQuantity();

let petsHTML = '';


pets.forEach(function(pet){
    let species =[];
    giong.forEach((giong) => {
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

document.querySelector('.body0').innerHTML = petsHTML;

document.querySelectorAll('.js-link').forEach((link) => {
    link.addEventListener('click', function() {
        const petId = this.closest('.js-show-detail').dataset.petId;
        //console.log(petId); // In ra giá trị của petId
        
        //localStorage.setItem('id', JSON.stringify(petId));
        sessionStorage.setItem('id', JSON.stringify(petId));
    });
});

console.log(JSON.parse(sessionStorage.getItem('id')));

//search--------------------------------------------------

//let products = document.querySelector('.products');

let petDisplayHTML = '';

let searchInput = document.querySelector('.search input');
let div = document.querySelector('.products');

searchInput.addEventListener('click', function(e){
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
