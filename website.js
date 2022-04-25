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