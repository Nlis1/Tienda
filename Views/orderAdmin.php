
<?php 
    session_start(); // Iniciar o reanudar la sesión

    if ($_SESSION['admin']!="2") { // Si no hay un usuario en sesión
        header("Location: login.php"); // Redirigir al login
        exit(); // Detener la ejecución del script
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	  <script src="../Public/js/jquery-3.1.1.min.js"></script>

</head>
<body>
    
<div class="d-flex">
<section class="full-box cover dashboard-sideBar">
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px; height:650px">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Administrador</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="./products.php" class="nav-link " aria-current="page">
        <i class="bi bi-house"></i>
          Productos
        </a>
      </li>
      <li>
        <a href="./pedidosAdmin.php" class="nav-link text-white active">
        <i class="bi bi-calendar"></i>
          Pedidos
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
        <i class="bi bi-grid"></i>
          Process
        </a>
      </li>
    </ul>
    <hr>
    <div>
      <a href="#" class="d-flex align-items-center text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></strong>
        <a href="../Login/logout.php"  class="btn btn-dark"><i class="bi bi-box-arrow-left"></i></a>
      </a>
    </div>
  </div>
  </section>

  <section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>
					<a href="search.html" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
			</ul>
		</nav>

    <?php 
        require_once '../Models/OrderModel.php';

        $instOrder =  new OrderModel();
        $data = $instOrder->get();
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

    <?php 
        require_once '../Models/OrderModel.php';

        $instOrder =  new OrderModel();
        $data = $instOrder->getDetailOrder();
    ?>
<!-- Modal -->
<div class="modal fade" id="verPedidoModal" tabindex="-1" aria-labelledby="verPedidoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verPedidoModalLabel">Detalles del Pedido #12345</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p><strong>Cliente:</strong> Juan Pérez</p>
        <p><strong>Correo:</strong> juanperez@gmail.com</p>
        <p><strong>Dirección:</strong> Calle 123, Bogotá, Colombia</p>
        <p><strong>Teléfono:</strong> +57 300 123 4567</p>

        <h6>Productos:</h6>
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
             <?php foreach ($data as $row) {?>
            <tr>
              <td> <?php echo $row['product_id']?></td>
              <td><?php echo $row['quantity']?></td>
              <td><?php echo $row['unit_price']?></td>
              <td>$40.000</td>
            </tr>
             <?php } ?>
               <tr>
              <td colspan="3" class="text-end"><strong>Envío</strong></td>
              <td>$5.000</td>
            </tr>
            <tr>
              <td colspan="3" class="text-end"><strong>Total</strong></td>
              <td><strong><?php echo $row['unit_price']?></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../Public/js/index.js"></script>
</body>
</html>
