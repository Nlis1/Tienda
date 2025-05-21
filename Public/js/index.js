let menu = document.getElementById("menu");
let botonSiguiente = document.getElementById("btn-siguiente");
let botonAtras = document.getElementById("btn-atras");
let listarProducts = document.getElementById("tabla_product");
let totalProduct = document.getElementById("totalProduct");
let productsList = document.getElementById("products_list");
let productos= [];
let allProducts = []
let paginaNext= null;
let paginaPrev= null;


let url = "http://localhost/tienda/api/api.php/product";

function listarTodosLosProductos() {
    return new Promise((resolve, reject) => {
      fetch("http://localhost/tienda/api/api.php/product")
        .then(response => response.json())
        .then(data => {
          resolve(data)
        })
        .catch(error => {
          reject(error)
        })
    })
}

function obtenerDatos(url){
    return new Promise((resolve, reject) => {
      fetch(`${url}`)
        .then(response => response.json())
        .then(data => {
          resolve(data)
        })
        .catch(error => {
          reject(error)
        })
    })
  }

  function listar(url){
        obtenerDatos(url).then(data => {
            console.log(data)
            dataValidate(data);

            totalProduct.innerHTML = `<h5>Total Productos: ${data.total}</h5>`;
            
            menu.innerHTML="";

            for (let i = 1; i <= data.num_pages; i++) {
                menu.innerHTML += `<button onclick="clickBoton(${i})" id="btn-${i}" class="btn btn-success btn-raised btn-sm mx-1 btn-num">${i}</button>`;
            }
    })
  }
  

  function render(){
        const Usuariosrender = productos.map((producto) =>`
                <tr>
                    <td>${producto.id}</td>
                    <td>${producto.name}</td>
                    <td>
                        <img class="img-thumbnail rounded" src="${producto.photo}" width="50" alt="">
                    </td>
                    <td>${producto.description}</td>
                    <td>${producto.stock}</td>
                    <td>${producto.product_code}</td>
                    <td>${producto.price}</td>
                    <td></td>
                    <td>
                        <form action="../Api/Api.php/product/${producto.id}" method="POST" class="FormularioAjax ProductEliminar">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-raised btn-xs">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <button type="button"
                                class="btn btn-info btn-raised btn-xs btn-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="${producto.id}"
                                data-name="${producto.name}"
                                data-photo="${producto.photo}"
                                data-description="${producto.description}"
                                data-stock="${producto.stock}"
                                data-code="${producto.product_code}"
                                data-price="${producto.price}">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </td>
                </tr>
            `).join("");
            listarProducts.innerHTML = Usuariosrender;
  }


  function renderProducts(){
        const Usuariosrender = allProducts.map((producto) =>`
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="${producto.photo}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">${producto.name}</h4>
                            <h6 class="card-title">${producto.price}</h6>
                            <div class="btn btn-group">
                                <a href="./Views/detalle_product.php?id=${producto.id}" class="btn btn-primary" role="button">Detalles</a>
                            </div>
                            <button class="btn btn-outline-succes" type="button" onclick="addProducto(${producto.id})">Agregar al carrito</button>
                        </div>

                    </div>
                </div>
            `).join("");
            productsList.innerHTML = Usuariosrender;
  }


 function dataValidate(data){
      productos = data.products
      paginaNext = data.next
      paginaPrev = data.prev
      
        listarTodosLosProductos().then(datos => {
        allProducts = datos
        console.log(allProducts)
        renderProducts();

    })

      render();
 }

  function clickBoton(i){
        obtenerDatos(`${url}?page=${i}`)
        .then(data =>{
            dataValidate(data);
        })

        botones = document.getElementsByClassName('btn-num');
        Array.from(botones).forEach(element => {
          element.classList.remove('active')
        });

        boton =document.getElementById(`btn-${i}`);
        boton.classList.add('active');

  }

  function Siguiente(){
      obtenerDatos(`${url}?page=${paginaNext}`)
      .then(data =>{
            dataValidate(data)
        })
  }
  
  function Atras(){
      obtenerDatos(`${url}?page=${paginaPrev}`)
      .then(data =>{
            dataValidate(data)
        })
  }

listar(`${url}?page=1`);    