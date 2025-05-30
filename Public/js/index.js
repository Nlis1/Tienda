let menu = document.getElementById("menu");
let botonSiguiente = document.getElementById("btn-siguiente");
let botonAtras = document.getElementById("btn-atras");
let listarProducts = document.getElementById("tabla_product");
let totalProduct = document.getElementById("totalProduct");
let productsList = document.getElementById("products_list");
let PedidosList = document.getElementById("body-pedidos");
let listaCategorias = document.getElementById("list-categorias");
let inputText = document.getElementById("texto");

let categorias= [];
let productos= [];
let allProducts = []
let orders = []

let paginaNext= null;
let paginaPrev= null;


let url = "http://localhost/tienda/api/api.php/product";

    function ListarCategories(){
        fetch("http://localhost/tienda/api/api.php/category")
            .then(resolve => resolve.json())
            .then(data => {
                categorias = data
                renderCategorias()
            })
    }
    
    function listarPedidos(){
        fetch("http://localhost/tienda/api/api.php/order")
            .then(resolve => resolve.json())
            .then(data => {
                orders = data
                console.log(orders)
                renderPedidos();
            })
    }

    function renderPedidos(){
        const pedidosRender = orders.map((order) =>`
        <tr>
            <td>${order.code_order}</td>
            <td>${order.user_id}</td>
            <td>${order.order_date}</td>
            <td><span class="badge bg-warning text-dark">Pendiente</span></td>
            <td>1444</td>
            <td>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#verPedidoModal">Ver</button>
            </td>
        </tr> `).join("");
        PedidosList.innerHTML = pedidosRender
    }

    function renderCategorias(){
        const renderCategoria = `
        <option value="" disabled selected>Categoria</option>
        ${categorias.map(category => `<option value="${category.id}">${category.name}</option>`).join('')}`;
        listaCategorias.innerHTML = renderCategoria
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
            productos = data.products
            console.log(productos)
            render();
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
                    <td>${producto.price_with_iva}</td>
                    <td>${producto.iva}</td>
                    <td>${producto.categories.map(category => category.name)}</td>
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
                                data-price="${producto.price}"
                                data-iva="${producto.iva}">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </td>
                </tr>
            `).join("");
            listarProducts.innerHTML = Usuariosrender;
  }

    function listarTodosLosProductos(url) {
    fetch(url)
            .then(resolve => resolve.json())
            .then(data => {
                allProducts = data
                if(inputText.value != allProducts){
                    productsList.innerHTML = `<h3>No se encontro el producto</h3>`
                }  
                
                console.log(allProducts) 
                renderProducts()
            })
    }


  function renderProducts(){
        const Usuariosrender = allProducts.map((producto, index) =>`
                <div class="col-md-3">
                    <div class="card" >
                        <a href="./Views/detalle_product.php?id=${producto.id}"
                        role="button"><img class="card-img-top" src="${producto.photo}" alt=""> </a>
                        <div class="card-body">
                            <h4 class="card-title">${producto.name}</h4>
                            <h6 class="card-title">${producto.price_with_iva}</h6>
                            <button class="btn btn-outline-primary btn-carrito-${index}" type="button" onclick="agregarCarrito(${index})">${estaEnElCarrito(producto.id) ? 'Agregado' : 'Agregar al carrito'}</button>
                        </div>
                    </div>
                </div>
            `).join("");
            productsList.innerHTML = Usuariosrender;
  }

  function Buscador(e){
    e.preventDefault();
    console.log("texto", inputText.value)
    if(!inputText.value){
        listarTodosLosProductos(url);
    }else{
        urlSearch=`${url}?search=${inputText.value}`
        listarTodosLosProductos(urlSearch);
    }
  }

  function clickOption(e){
    e.preventDefault();
    console.log("Opción seleccionada:", e.target.value);
    urlCategory= `${url}?category_id=${e.target.value}`
    listarTodosLosProductos(urlCategory);
  }

  function clickBoton(i){
        obtenerDatos(`${url}?page=${i}&limit=5`)
        .then(data =>{
            productos = data.products
            paginaNext = data.next
            paginaPrev = data.prev
            render()
        })

        botones = document.getElementsByClassName('btn-num');
        Array.from(botones).forEach(element => {
          element.classList.remove('active')
        });

        boton =document.getElementById(`btn-${i}`);
        boton.classList.add('active');
  }

  function Siguiente(){
      obtenerDatos(`${url}?page=${paginaNext}&limit=5`)
      .then(data =>{
           productos = data.products
            render()
        })
  }
  
  function Atras(){
      obtenerDatos(`${url}?page=${paginaPrev}&limit=5`)
      .then(data =>{
            productos = data.products
            render()
        })
  }

listar(`${url}?page=1&limit=5`);    
ListarCategories();
listarPedidos();
listarTodosLosProductos(url) 
