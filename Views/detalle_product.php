
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
    <script src="./Public/js/jquery-3.1.1.min.js"></script>
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
          <li><a href="#" class="nav-link px-2 text-dark">Categories</a></li>
          <li><a href="#" class="nav-link px-2 text-dark">About</a></li>
        </ul>

        <form class="col-12 col-lg-4 mb-3 mb-lg-0 me-lg-2" role="search">
          <input type="search" class="form-control form-control-dark text-bg-" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <a href="./Views/login.php"> <i class="bi bi-person fs-3"></i></a>
          <?php if(isset($_SESSION['nombre'])){ ?>
          <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?> 
                <a> <i class="bi bi-heart fs-3"></i></a>
                <a href="./Login/logout.php"><i class="bi bi-box-arrow-left fs-3"></i></a>
          <?php } ?>
          <a href="#" id="carritoBtn"><i class="bi bi-cart fs-3"></i>
          <span id="numero_carrito">0</span>
         </a>

        </div>
      </div>
    </div>
  </header>

<?php
    $id= isset($_GET['id']) ? $_GET['id'] : '';

    require_once '../Models/ProductModel.php';
    $insProduct = new ProductModel();
    $dato = $insProduct->get($id);

?>


<div class="container">
    <div class="row">
        <div class="col-md-6 orde-md-1">
            <img src="<?php echo $dato['photo'] ?>" style="width: 80%;" alt="">
        </div>

        <div class="col-md-6 orde-md-1">
            <h2><?php echo $dato['name'] ?></h2>
            <h4><strong>$<?php echo $dato['price'] ?></strong></h4>
            <p class="lead">
                <?php echo $dato['description']?>
            </p>

            <div class="col-3 my-3">
                Cantidad: <input class="form-control"  type="number" name="cantidad" id="cantidad" min="1" max="10" value="1">
            </div>

        <div class="d-grip gap-3 col-10 mx-auto" >
        <button class="btn btn-primary" type="button">Comprar ahora</button>
        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id;?>, cantidad.value, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
        </div>
        </div>
    </div>
</div>
