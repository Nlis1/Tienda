const milocalStorage = window.localStorage;

function setItemCarritoLocalStorage(productosCarrito){
    if(productosCarrito != undefined){
    localStorage.setItem("carrito", JSON.stringify(productosCarrito))
    console.log(productosCarrito)
    }
}

function getItemCarritoLocalStorage(){
    console.log(JSON.parse(localStorage.getItem("carrito")) || [])
    return JSON.parse(localStorage.getItem("carrito")) || [];
}