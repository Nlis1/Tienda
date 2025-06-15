<?php 
  session_start();

    if ($_SESSION['rol']!="1") { // Si no hay un usuario en sesión
        header("Location: views/login.php"); // Redirigir al login
        exit(); // Detener la ejecución del script
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	  <script src="../Public/js/jquery-3.1.1.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .pedido-card {
      transition: 0.3s ease-in-out;
    }
    .pedido-card:hover {
      transform: scale(1.01);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .estado-entregado {
      color: green;
    }
    .estado-pendiente {
      color: orange;
    }
    .estado-cancelado {
      color: red;
    }
  </style>
</head>
<body>

 <header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="./logo.png" alt="">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="./index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li >
            <select class="form-select"  id="list-categorias" onchange="clickOption(event)">

            </select></li>
          <li><a href="#" class="nav-link px-2 text-dark">About</a></li>
        </ul>

        <form class="input-group w-25 mx-2" role="search">
          <input type="search" class="form-control form-control-dark text-bg-" id="texto" placeholder="Buscar...">
          <button type="button" onclick="Buscador(event)" class="btn btn-primary" data-mdb-ripple-init><i class="bi bi-search"></i></button>
        </form>

        <div class="text-end d-flex">
          <div class="dropdown">
            <a href="./Views/login.php" class="dropdown-toggle"   data-bs-toggle="dropdown" aria-expanded="true"><i class="bi bi-person fs-3"></i></a>
            <?php if(isset($_SESSION['nombre'])){ ?>
             <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?> 
            <ul class="dropdown-menu text-small shadow ">
              <li><a href="./Views/pedidos.php" class="dropdown-item"> <i class="bi bi-box"></i> Pedidos</a></li>
              <li><a class="dropdown-item"> <i class="bi bi-heart"></i> Favoritos</a></li>
               <li><a class="dropdown-item" href="./Login/logout.php"><i class="bi bi-box-arrow-left"></i> Cerrar Sesion</a></li>
            </ul>
                <a> <i class="bi bi-heart fs-3"></i></a>
             <?php } ?>
          </div>
          
          <a href="#" id="carritoBtn"><i class="bi bi-cart fs-3"></i>
          <span id="numero_carrito"></span>
         </a>

        </div>
      </div>
    </div>
  </header>

      <?php
      require_once '../Controllers/OrderController.php';
      $insOrder = new OrderController();
      $data = $insOrder->consultar();
      ?> 

    <div class="container mt-5">
    <h2 class="mb-4">Lista de Pedidos</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>Pedido ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="body-pedidos">
        
        </tbody>
    </table>
    </div>

    <div class="modal fade" id="verPedidoModal" tabindex="-1" aria-labelledby="verPedidoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verPedidoModalLabel">Detalles del Pedido #12345</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p id="nameClient"> </p>
        <p id="emailClient"></p>
        <p id="addressClient"></p>
        <p id="phoneClient"></p>
        <p id="countryClient"></p>

        <h6>Productos:</h6>
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Id</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Iva</th>
              <th>Precio</th>
              <th>Subtotal</th>
            </tr>
          </thead>
           <tbody  id="detallePedido">

            
           </tbody>
           <tr>
              <td colspan="4" class="text-end" id="totalProducts"> </td>
              <td><strong></strong></td>
            </tr>
        </table>
      </div>
    </div>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Public/js/index.js"></script>


</body>
</html>
