import {cart, addToCart, removeFromCart, formartMoney} from './cart.js'

let cartHTML ='';


function updateSum(){
    let sum = 0;
    if(cart){
        cart.forEach((pet) => {
            if(pet.id != ''){
                sum += parseInt(pet.price);
            }
        });
    }
    
    document.getElementById('sum').innerHTML = "Tổng cộng: " + formartMoney(sum) + " VND";
}

updateSum();

if(cart){ //neu co san pham trong gio hang
    cart.forEach((cartItem) => {
        if(cartItem.id != ''){
            cartHTML += `<div class="content1-${cartItem.id}" style="box-shadow: 0 1px 5px rgba(0,0,0,0.15);padding: 0 30px 20px 30px;margin-bottom: 20px;">
                    <div class="part1">
                        <div class="left">
                            <p>${cartItem.name}</p>
                        </div>
                        <div></div>
                        <div></div>
                        <button class="js-delete-link" data-pet-id="${cartItem.id}">Xóa</button>
                    </div>
                    <hr>
                    <div class="part2">
                        <div style="flex:2">
                            <img src="${cartItem.img}">
                        </div>
                        <p style="flex:1;">${cartItem.species}</p>
                        <p style="flex:1;">${formartMoney(Number(cartItem.price))}</p>
                        <div style="flex:1;"></div>
                    </div>
                </div>`;

        }
    });
}

document.querySelector('.cartItem').innerHTML = cartHTML;

document.querySelectorAll('.js-delete-link').forEach((link) => { //mã hóa nút delete. 
    //document.querySelectorAll('.js-delete-link'): trả về 1 danh sách (nodelist) các phần tử trong đoạn mã html có class js-delete-link
    //forEach((link): lặp qua tất cả các phần tử trong danh sách và thực hiện hoạt động với mỗi phần tử.
                                                                                    
    link.addEventListener('click', () => { //gán 1 sự kiện lắng nghe cho mỗi button. khi click vào sẽ thực hiện hàm.
        const petId = link.dataset.petId; // lấy id trong nút mới click vào gán cho biến productId.
        removeFromCart(petId);

        const container = document.querySelector(`.content1-${petId}`);
        container.remove();

        updateSum();
        
    });
});


function deleteAll(){
    //const petId = link.dataset.petId; // lấy id trong nút mới click vào gán cho biến productId.
    if(cart){
        cart.forEach(item =>{
            removeFromCart(item.id);

            const container = document.querySelector(`.content1-${item.id}`);
            container.remove();
        });

    }
}

document.getElementById('orderLink').addEventListener('click', function(event) {
    if (cart.length <= 1) {
        event.preventDefault(); // Ngăn chặn việc chuyển trang
        alert('Hãy chọn thú cưng vào giỏ trước khi đặt hàng nhé !');
    }
});
