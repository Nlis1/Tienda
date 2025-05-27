<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../Public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
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

                <div class="text-end">
                <a href="./login.php"> <i class="bi bi-person fs-3"></i></a>
                <a> <i class="bi bi-heart fs-3"></i></a>
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
                    <button class="btn btn-success w-100 mt-3">Pagar ahora</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="../Public/js/localStorage.js"></script>
    <script src="../Public/js/cart.js"></script>
   
</body>
</html>