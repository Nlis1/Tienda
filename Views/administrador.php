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
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px; height:740px">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Administrador</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
        <i class="bi bi-house"></i>
          Productos
        </a>
      </li>
      <li>
        <a href="./pedidos.php" class="nav-link text-white">
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
		
		<!-- Content page -->
        <?php require_once 'products.php'; ?>
	
		</div>
	</section>

	  <script src="../Public/js/index.js"></script>
	  <script src="../Public/js/main.js"></script>
</body>
</html>