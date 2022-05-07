// Fonctionalités du btn de la gestion de la quantité du panier
let plusBtn = document.getElementById('plus');
let minusBtn = document.getElementById('minus');
let inputValue = document.getElementById('qtt');

function increaseQtt(){
    return inputValue.value++;
}

function decreaseQtt(){
    if (inputValue.value <= 1){
        return inputValue.value = 1;
    }else{
        inputValue.value--;
    }
}

plusBtn.addEventListener("click", increaseQtt);
minusBtn.addEventListener("click", decreaseQtt);

// Gestion des messages à afficher lors de l'ajout au panier

let addCartBtn = document.getElementById('add-cart-btn');
let alertDiv = document.querySelector('.alert');

// function notAllowed(){
//     addCartBtn.style.cursor = "all-scroll";
// }
if (alertDiv.classList.contains("alert-danger")){
    
}else{
    console.log('marche pas');
}