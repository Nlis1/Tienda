let menu = document.getElementById("menu");
let botonSiguiente = document.getElementById("btn-siguiente");
let botonAtras = document.getElementById("btn-atras");
let listarProducts = document.getElementById("tabla_product");
let totalProduct = document.getElementById("totalProduct");
let productos= [];

let url = "http://localhost/tienda/api/api.php/product";

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
            productos = data.products
            totalProduct.innerHTML = `<h5>Total Productos: ${data.total}</h5>`;
            render();

            for (let i = 1; i <= data.num_pages; i++) {
                menu.innerHTML += `<button onclick="clickBoton(${i})" id="btn-${i}" class="btn btn-success btn-raised btn-sm mx-1 btn-num">${i}</button>`;
            }
    })
  }

  function render(){
        const Usuariosrender = productos.map((producto) => `
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
                                data-code="${producto.code}"
                                data-price="${producto.price}">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </td>
                </tr>
            `).join("");
            listarProducts.innerHTML = Usuariosrender;
  }

  function clickBoton(i){
        obtenerDatos(`${url}?page=${i}`)
        .then(data =>{
            productos = data.products;
            render();
        })

        botones = document.getElementsByClassName('btn-num');
        Array.from(botones).forEach(element => {
          element.classList.remove('active')
        });

        boton =document.getElementById(`btn-${i}`);
        boton.classList.add('active');

  }

listar(`${url}?page=1`);
