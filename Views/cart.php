<?php 
  session_start();

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../Public/css/style.css">
   <link rel="stylesheet" href="./Public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../Public/js/jquery-3.1.1.min.js"></script>
    <script src="../Public/js/main.js"></script>
     <style>
      .dropdown-toggle::after {
        display: none !important;
      }
  </style>
</head>
<body>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="../logo.png" alt="">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../index.php" class="nav-link px-2 text-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2 text-dark">Categories</a></li>
                </ul>

                <form class="col-12 col-lg-4 mb-3 mb-lg-0 me-lg-2" role="search">
                <input type="search" class="form-control form-control-dark text-bg-" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end d-flex">
                 <div class="dropdown">
                <?php if (isset($_SESSION['nombre'])) { ?>
                    <a class="dropdown-toggle activo" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person fs-3"></i>
                    <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
                    </a>

                    <ul class="dropdown-menu text-small shadow">
                    <li><a href="./Views/pedidos.php" class="dropdown-item"><i class="bi bi-box"></i> Pedidos</a></li>
                    <li><a class="dropdown-item"><i class="bi bi-heart"></i> Favoritos</a></li>
                    <li><a class="dropdown-item" href="./Login/logout.php"><i class="bi bi-box-arrow-left"></i> Cerrar Sesión</a></li>
                    </ul>
                <?php } else { ?>
                    <!-- Si no hay sesión, simplemente redirige al login -->
                    <a href="./Views/login.php" class="btn"><i class="bi bi-person fs-3"></i> Iniciar sesión</a>
                <?php } ?>
                </div>


                <a href="#" id="carritoBtn"><i class="bi bi-cart fs-3"></i>
                <span id="numero_carrito">0</span>
                </a>
                </div>
            </div>
            </div>
        </header>

    <main>
        <div class="container mt-4">
        <h2 class="pb-3">Productos</h2>
        <div class="row">

        <!-- Lista de productos -->
        <div class="col-md-8 overflow-y-scroll" style="height: 500px;" id="product-cart">
    
        </div>
                <div class="col-md-4">
                    <div class="resumen">
                    <h5>Resumen del Pedido</h5>
                    <p>Total productos: <strong id="total-product" ></strong></p>
                    <p>Subtotal: <strong id="subtotal-product">$17.352</strong></p>
                    <p>Iva: <strong id="iva-product" >200</strong></p>
                    <p>Total a pagar: <strong id="precio-final"></strong></p>
                    <button class="btn btn-success w-100 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" >Pagar ahora</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Producto</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="POST" action="../Api/Api.php/order" class="FormularioAjax InsertarPedido">
                    <div class="form-group">
                        <label for="txtPais">Pais:</label>
                        <input type="text" required class="form-control" name="pais" placeholder="pais">
                    </div>

                    <div class="form-group">
                        <label for="txtDireccion">Direccion:</label><br />
                        <input type="text" required class="form-control" name="direccion" placeholder="direccion">
                    </div>

                    <div class="form-group">
                        <label for="txtCiudad">Ciudad:</label>
                        <input type="text" required class="form-control" name="ciudad" placeholder="ciudad">
                    </div><br>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar</button>
                    </div>
                </form> 
            </div>
          </div>
        </div>
      </div>

    <script src="../Public/js/localStorage.js"></script>
    <script src="../Public/js/cart.js"></script>
   
</body>
</html>