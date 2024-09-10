import {updateQuantity, formartMoney} from './cart.js'
import {pets} from './pets.js'

//localStorage.removeItem('quantity');
//localStorage.removeItem('cart');

updateQuantity();

let petHTML = '';

let searchInput = document.querySelector('.search input');
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