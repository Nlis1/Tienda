<?php 
  session_start();
  $usuario_activo = isset($_SESSION['nombre']) ? 'true' : 'false';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="./Public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../Public/js/jquery-3.1.1.min.js"></script>
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
            <a href="./Views/login.php" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true"><i class="bi bi-person-circle fs-3"></i></i></a>
            <?php if(isset($_SESSION['nombre'])){ ?>
             <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?> 
            <ul class="dropdown-menu text-small shadow ">
              <li><a href="./Views/orders.php" class="dropdown-item"> <i class="bi bi-box"></i> Pedidos</a></li>
              <li><a href="./Views/myProfile.php" class="dropdown-item"><i class="bi bi-person"></i> Perfil</a></li>
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
     require_once '../Models/UserModel.php';
    $insUser = new UserModel();
    $dato = $insUser->get();

?>
  <div class="container mt-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Actualizar Perfil</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="../Api/Api.php/user" >
              <input type="hidden" name="id" value="<?php echo $dato['id'] ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" value="<?php echo $dato['name'] ?>" id="name" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="last_name" class="form-label">Apellido</label>
                    <input type="text" name="last_name" value="<?php echo $dato['last_name'] ?>" id="last_name" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="email" id="email" value="<?php echo $dato['email'] ?>"class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $dato['phone'] ?>" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña <small class="text-muted">(opcional)</small></label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" name="address" id="address" value="<?php echo $dato['address'] ?>"class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../Public/js/main.js"></script>
    <script src="../Public/js/localStorage.js"></script>
	  <script src="../Public/js/index.js"></script>
</body>
</html>