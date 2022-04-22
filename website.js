let plusBtn = document.getElementById('plus');
let minusBtn = document.getElementById('minus');
let inputValue = document.getElementById('qtt');

function increaseQtt(){
    return inputValue.value++;
}

function decreaseQtt(){
    if (inputValue.value > 0){
        return inputValue.value--;
    }else{
        return inputValue.value = 0;
    }
}

plusBtn.addEventListener("click", increaseQtt);
minusBtn.addEventListener("click", decreaseQtt);