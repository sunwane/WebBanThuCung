export let cart = JSON.parse(localStorage.getItem('cart'));
export let quantity = JSON.parse(localStorage.getItem('quantity'));



if(!cart){
    cart = [
        {
            img: '',
            id: '',
            name: '',
            species: '',
            price: ''
        }
    ];
    quantity = 0;
}


export function updateQuantity(){
    document.getElementById('quantity_cart').innerHTML = quantity;
};

export function formartMoney(money){
    let format = money.toLocaleString('vi-VN');
    return format;
}

function saveToStorage(){
    localStorage.setItem('cart', JSON.stringify(cart));
    localStorage.setItem('quantity', JSON.stringify(quantity));
}


export function addToCart(pet, tengiong){
    cart.push({ 
        img: pet.img,
        id: pet.id,
        name: pet.name,
        species: tengiong,
        price: pet.price
    });
    quantity++;
    saveToStorage();
}

export function removeFromCart(petId){
    const newCart = [];

    cart.forEach((cartItem) => {  //đoạn code này lưu tất cả các sản phẩm khác với sản phẩm vừa được chọn vào nút Delete.
        if(cartItem.id !== petId){
            newCart.push(cartItem);
        }
    });

    cart = newCart; // gán mảng cart = mảng mới // thì mảng cart đã mất đi sản phẩm vừa chọn xóa.
    quantity--;
    saveToStorage();
}