<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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

    <div class="container py-5">
    <h2 class="mb-4"><i class="bi bi-box-seam-fill"></i> Mis Pedidos</h2>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
        <div class="card pedido-card">
            <div class="card-body">
            <h5 class="card-title">Pedido #12345</h5>
            <p class="card-text">
                <strong>Fecha:</strong> 2025-05-20<br>
                <strong>Total:</strong> $49.99<br>
                <strong>Estado:</strong> <span class="text-success">Entregado</span>
            </p>
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detallePedidoModal">
                Ver Detalles
            </button>
            </div>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="detallePedidoModal" tabindex="-1" aria-labelledby="detallePedidoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="detallePedidoModalLabel"><i class="bi bi-receipt"></i> Detalles del Pedido #12345</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <p><strong>Fecha del pedido:</strong> 20 de mayo de 2025</p>
            <p><strong>Estado:</strong> <span class="text-success">Entregado</span></p>
            <p><strong>Dirección de entrega:</strong> Calle Falsa 123, Ciudad Ejemplo</p>

            <hr>

            <h5>Artículos del pedido</h5>
            <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Camiseta Blanca (Talla M)
                <span>$19.99</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Pantalón Jeans Azul (Talla 32)
                <span>$30.00</span>
            </li>
            </ul>

            <div class="d-flex justify-content-between">
            <strong>Total:</strong>
            <strong>$49.99</strong>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
