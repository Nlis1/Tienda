<?php 
    session_start(); // Iniciar o reanudar la sesión

    var_dump($_SESSION['admin']);
    if ($_SESSION['rol']!="2") { // Si no hay un usuario en sesión
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
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px; height:100%">
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
        <a href="./orderAdmin.php" class="nav-link text-white">
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
		
<div class="container">
    <br/>
    <div class="row">

        <div class="action-menu-content">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Crear
          </button>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Producto</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="POST" action="../Api/Api.php/product" class="FormularioAjax Insertar">

                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" name="name_product" value="" id="txtNombre" placeholder="Nombre">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label><br />
                    <img class="img-thumbnail rounded" src="../../img/" width="50" alt="" srcset="">
                    <input type="text" required class="form-control" name="photo_product" value="" id="txtNombre" placeholder="Foto">
                </div>

                <div class="form-group">
                    <label for="txtDescripcion">Descripcion:</label>
                    <textarea type="text" required class="form-control" name="description_product" value="" id="txtDescripcion" placeholder="Descripcion"></textarea>
                </div>

                <div class="form-group">
                    <label for="txtDescuento">Stock:</label>
                    <input type="number" required class="form-control" name="stock_product" value="" id="txtDescuento" placeholder="Stock">
                </div>
          
                <div class="form-group">
                    <label for="activo">Precio:</label>
                    <input type="text" required class="form-control" name="precio_product" value="" id="txtNombre" placeholder="Precio">
                </div><br>

                <div class="form-group">
                    <label for="activo">Iva:</label>
                    <input type="text" required class="form-control" name="iva_product" value="" id="txtNombre" placeholder="Iva">
                </div><br>

                                
                <div class="form-check"> 
                  <?php
                      require_once "../Models/CategoryModel.php";

                      $insCategories = new CategoryModel();
                      $results = $insCategories->get();

                      echo '<h4>Selecciona las categorías:</h4>';

                      foreach ($results as $row) {
                          $categoryName = htmlspecialchars($row['name']);
                          $categoryId = htmlspecialchars($row['id']);
                          echo '
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="categories[]" value="' . $categoryId . '" id="cat_' . $categoryId . '">
                              <label class="form-check-label" for="cat_' . $categoryId . '">' . $categoryName . '</label>
                          </div>';
                      }
                  ?>

                </div><br>

                <div class="btn-group" role="group" aria-label="">
					      <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar</button>
                </div>

            </form>
               
            </div>
          </div>
        </div>
      </div>

      <div class="p-3">
          <div id="totalProduct"></div>
      </div>
 
<div class="col-md-12 p-3">
    <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripcion</th>
                        <th>Stock</th>
                        <th>Codigo</th>
                        <th>Precio</th>
                        <th>Iva</th>
                        <th>Categoria</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
        <tbody id="tabla_product">

        </tbody>
        </table>
</div>

    <div class="menu-content d-flex">
      <button id="btn-atras"  onclick="Atras()"  class="btn btn-success btn-raised btn-sm mx-2"><i class="bi bi-arrow-left"></i></button>
     <div id="menu">
      
    </div>
      <button id="btn-siguiente"  onclick="Siguiente()"  class="btn btn-success btn-raised btn-sm mx-2"><i class="bi bi-arrow-right"></i></button>

    </div>
</div>

</div>

  <!-- Editar Modal -->

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editModalLabel">Editar Producto</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="POST" action="../Api/Api.php/product" class="FormularioAjax Editar">
                 <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id_up" id="input-id-up">
              
                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" name="name_up" value="" id="input-name-up" placeholder="Nombre">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label><br />
                    <img class="img-thumbnail rounded" src="../../img/" width="50" alt="" srcset="">
                    <input type="text" required class="form-control" name="photo_up" value="" id="input-photo-up" placeholder="Foto">
                </div>

                <div class="form-group">
                    <label for="txtDescripcion">Descripcion:</label>
                    <textarea type="text" required class="form-control" name="description_up" value="" id="input-description-up" placeholder="Descripcion"></textarea>
                </div>

                <div class="form-group">
                    <label for="txtDescuento">Stock:</label>
                    <input type="number" required class="form-control" name="stock_up" value="" id="input-stock-up" placeholder="Descuento">
                </div>

                  <div class="form-group">
                    <label for="activo">Precio:</label>
                    <input type="text" required class="form-control" name="price_up" value="" id="input-price-up" placeholder="Precio">
                </div><br>

                 <div class="form-group">
                    <label for="activo">Iva:</label>
                    <input type="text" required class="form-control" name="iva_up" value="" id="input-iva-up" placeholder="Iva">
                </div><br>

                  <div class="form-check">
                 <?php
                      require_once "../Models/CategoryModel.php";

                      $insCategories = new CategoryModel();
                      $results = $insCategories->get();

                      echo '<h4>Selecciona las categorías:</h4>';

                      foreach ($results as $row) {
                          $categoryName = htmlspecialchars($row['name']);
                          $categoryId = htmlspecialchars($row['id']); // suponiendo que hay un id
                          echo '
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="categories[]" value="' . $categoryId . '" id="cat_' . $categoryId . '">
                              <label class="form-check-label" for="cat_' . $categoryId . '">' . $categoryName . '</label>
                          </div>';
                      }
                  ?>
                </div><br>


                <div class="btn-group" role="group" aria-label="">
					      <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar</button>
                </div>
            </form>
    
            </div>
          </div>
        </div>
      </div>
        <script>
            $(document).ready(function() {
              // Verifica si los botones con la clase .btn-editar están presentes y se asignan correctamente
              $(document).on('click', '.btn-editar', function() {
                  const id = $(this).data('id');
                  const name = $(this).data('name');
                  const photo = $(this).data('photo');
                  const description = $(this).data('description');
                  const stock = $(this).data('stock');
                  const code = $(this).data('code');
                  const price = $(this).data('price');
                  const iva = $(this).data('iva');


                    $('#input-id-up').val(id);
                    $('#input-name-up').val(name);
                    $('#input-photo-up').val(photo);
                    $('#input-description-up').val(description);
                    $('#input-stock-up').val(stock);
                    $('#input-code-up').val(code);
                    $('#input-price-up').val(price);
                    $('#input-iva-up').val(iva);
                });
            });
          </script>

		</div>
	</section>

    <script src="../Public/js/localStorage.js"></script>
	  <script src="../Public/js/index.js"></script>
	  <script src="../Public/js/main.js"></script>
     
</body>
</html>
