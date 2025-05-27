let numeroCarrito = document.getElementById("numero_carrito");

let productosCarrito = getItemCarritoLocalStorage();
actualizarNumeroCarrito(getItemCarritoLocalStorage().length)

function estaEnElCarrito(id){
       return productosCarrito.some((produc)=> produc.id === id)
  }

  function agregarCarrito(index){
    let botonCarrito = Array.from(document.getElementsByClassName(`btn-carrito-${index}`))

    if(estaEnElCarrito(allProducts[index].id)){
        boton.innerHTML= "Agregado"
    }else{
        let obj ={...allProducts[index]}
        obj.cantidad = 1
        productosCarrito.push(obj)
        setItemCarritoLocalStorage(productosCarrito)
        actualizarNumeroCarrito(productosCarrito.length)
        
        botonCarrito.forEach(boton => {
            boton.innerHTML = "Agregar al carrito"
        });
    }
  } 

  function actualizarNumeroCarrito(cantidades){
    console.log(productosCarrito)

    numeroCarrito.innerHTML = cantidades
  }