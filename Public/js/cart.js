let listarProductsCarrito= document.getElementById("product-cart");
let precioFinal= document.getElementById("precio-final");
let totalProduct= document.getElementById("total-product");
let subtotalProduct= document.getElementById("subtotal-product");
let ivaProduct= document.getElementById("iva-product");
let numeroCarrito = document.getElementById("numero_carrito")

let productosCarrito = getItemCarritoLocalStorage();

function mostrarCarrito(){
    numeroCarrito.textContent = productosCarrito.length
    if(productosCarrito.length === 0){
      listarProductsCarrito.innerHTML = `
        <h1>El carrito esta vacio</h1>
        <a class="btn btn-primary" role="button" href="../index.php">Ir a comprar</a>
      `
    }else{
    const productoCarritoRender = productosCarrito.map((product, index) => `
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-2 d-flex align-items-center">
              <img src="${product.photo}" class="producto-img" width="120" alt="Producto">
            </div>
            <div class="col-md-7">
              <div class="card-body pb-5">
                <h5 class="card-title">${product.name}</h5>
              </div>
               <div class="d-flex align-items-center p-3">
                  <label class="me-2">Qty:</label>
                   <input type="number" class="form-control form-control-sm w-25" id="input-cantidad-${index}" onchange="actualizarCantidad(${index})" value="${product.cantidad}" min="1">
                </div>
            </div>
            <div class="col-md-3 d-flex flex-column justify-content-between align-items-center p-3">
              <p class="precio-final">${product.price_with_iva}</p>
              <div class="acciones">
                <button type="submit" onclick="eliminarDelCarrito(${product.id})" class="btn"><i class="bi bi-trash" title="Eliminar"></i></button>
                <button type="submit" class="btn"> <i class="bi bi-heart" title="Guardar en favoritos"></i></button>
                <a href="../Views/detalle_product.php?id=${product.id}" type="submit" class="btn"> <i  class="bi bi-eye" title="Ver detalles"></i></a>
              </div>
            </div>
          </div>
        </div>
    `).join("")
    listarProductsCarrito.innerHTML = productoCarritoRender
    }
    sumaTotal()

}

function eliminarDelCarrito(id){
   productosCarrito = productosCarrito.filter((product) => parseInt(product.id) !== id);
    setItemCarritoLocalStorage(productosCarrito)
    console.log(productosCarrito)
    mostrarCarrito()
}

function actualizarCantidad(index){
   input = document.getElementById(`input-cantidad-${index}`)
    productosCarrito[index].cantidad = parseInt(input.value);
    setItemCarritoLocalStorage(productosCarrito)
    sumaTotal();
}

function sumaTotal(){
    let subTotal= 0
    let iva= 0

    productosCarrito.forEach(product => {
        subTotal += product.price*product.cantidad
        iva += subTotal*(product.iva/100)
    })
    
    let total =  subTotal + iva
    let totalProductos = getItemCarritoLocalStorage().length

    ivaProduct.innerHTML = iva
    subtotalProduct.innerHTML= subTotal
    totalProduct.innerHTML = totalProductos
    precioFinal.innerHTML = total
  }


mostrarCarrito();