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
                <a><i class="bi bi-cart fs-3"></i></a>
                <span id="numero_carrito">0</span>
                </div>
            </div>
            </div>
        </header>

    <main>
        <div class="container-cart">
            <section class="section-product">
                <div>
                    <h4 class="text-center mb-5" >Productos</h4>
                    <div class="card mb-5 p-3" id="body-carrito">
                        <div class="card-body-cart">
                            <div>
                                <img class="img-produc" src="https://http2.mlstatic.com/D_Q_NP_2X_974191-MLU76103352428_052024-AB.webp" alt="">
                            </div>
                            <div class="">
                                <h5>Proyector mini CHOWA Proyectores B2 300lm blanco 110V</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <span>Precio</span>
                            <p class="card-text" id="x&quot;total-53071&quot;">$53071</p>
                            <div>
                                <button class="btn-disminuir" onclick="botonDisminuir(0)">-</button>
                                <input type="number" id="cantidad-product">
                                <button class="btn-incrementar" onclick="botonIncrementar(0)">+</button>
                            </div>
                            <div>
                                <a><i class="bi bi-trash fs-3"></i></a>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="card mb-5" id="body-carrito">
                        <div class="card-body-cart">
                            <div>
                                <img class="img-produc" src="https://http2.mlstatic.com/D_Q_NP_2X_832268-MLU72931771705_112023-AB.webp" alt="">
                            </div>
                            <div class="">
                                <h5>Audífonos inalámbricos Bluetooth Sleve Evo 2da Gen Black Color Negro</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <span>Precio</span>
                            <p class="card-text" id="x&quot;total-53071&quot;">$53071</p>
                            <div>
                                <button class="btn-disminuir" onclick="botonDisminuir(0)">-</button>
                                <input type="number" id="cantidad-product">
                                <button class="btn-incrementar" onclick="botonIncrementar(0)">+</button>
                            </div>
                            <div>
                                <a><i class="bi bi-trash fs-3"></i></a>
                            </div>
                        </div>
                    </div> 
                </div>
            </section>

            <section class="section-pago">
                <div>
                    <h4>Total</h4>
                    <span id="total-productos">0</span><br>
                    <button class="btn-compra">Realizar compra</button>
                </div>
            </section>
        </div>
    </main>
   
</body>
</html>