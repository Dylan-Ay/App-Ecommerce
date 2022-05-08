// Gestion des messages à afficher lors de l'ajout au panier

let form = document.getElementById('add-cart-form');
let alertDiv = document.querySelector('.alert');
let main = document.querySelector('.modal-test');
let cartInfo = document.getElementById('cart-info');
let closeBtn = document.getElementById('close-btn');


function showCartModal(){
    cartInfo.classList.add('show');
    main.classList.add('show');
}
showCartModal();

function closeCartModal(){
    cartInfo.classList.remove('show');
    main.classList.remove('show');
}

closeBtn.addEventListener("click", closeCartModal);

console.log(underModal);