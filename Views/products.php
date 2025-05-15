
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
                    <label for="activo">Codigo:</label>
                    <input type="text" required class="form-control" name="product_code" value="" id="txtNombre" placeholder="Codigo">
                </div><br>

                <div class="form-group">
                    <label for="activo">Precio:</label>
                    <input type="text" required class="form-control" name="precio_product" value="" id="txtNombre" placeholder="Precio">
                </div><br>

                <div class="btn-group" role="group" aria-label="">
					<button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar</button>
                </div>

            </form>
               
            </div>
          </div>
        </div>
      </div>


<?php 
    require_once '../Models/ProductModel.php';

    $insProduct = new ProductModel();
    $datos= $insProduct->get($id=null);
?>


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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla_product">
                <tr>
                    <?php foreach($datos as $row){ ?>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['name']?></td>
                    <td>
                        <img class="img-thumbnail rounded" src="<?php echo $row['photo'] ?>" width="50" alt="" srcset="">
                    </td>
                    <td><?php echo $row['description']?></td>
                    <td><?php echo $row['stock'] ?></td>
                    <td><?php echo $row['product_code']?></td>
                    <td><?php echo $row['price']?></td>


                    <td>
                        <form class="FormularioAjax ProductEliminar" method="POST"  action="../Api/Api.php/product/<?php echo $row['id']?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-raised btn-xs">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>
                    </td>
                    <td>    
                           <button type="button"
                                class="btn btn-info btn-raised btn-xs btn-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="<?php echo $row['id']?>"
                                data-name="<?php echo htmlspecialchars($row['name']) ?>"
                                data-photo="<?php echo htmlspecialchars($row['photo']) ?>"
                                data-description="<?php echo htmlspecialchars($row['description']) ?>"
                                data-stock="<?php echo $row['stock'] ?>"
                                data-code="<?php echo htmlspecialchars($row['product_code']) ?>"
                                data-price="<?php echo $row['price']?>">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </td>
                </tr>
           <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>

    <?php 
    
    
    ?>

  <!-- Editar Modal -->

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
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
                    <label for="activo">Codigo:</label>
                    <input type="text" required class="form-control" name="code_up" value="" id="input-code-up" placeholder="Codigo">
                </div><br>

                  <div class="form-group">
                    <label for="activo">Precio:</label>
                    <input type="text" required class="form-control" name="price_up" value="" id="input-price-up" placeholder="Precio">
                </div><br>

                <div class="btn-group" role="group" aria-label="">
					<button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar</button>
                </div>
            </form>

            <script>
            $(document).ready(function(){
                $('.btn-editar').on('click', function(){
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const photo = $(this).data('photo');
                    const description = $(this).data('description');
                    const stock = $(this).data('stock');
                    const code = $(this).data('code');
                    const price = $(this).data('price');

                    $('#input-id-up').val(id);
                    $('#input-name-up').val(name);
                    $('#input-photo-up').val(photo);
                    $('#input-description-up').val(description);
                    $('#input-stock-up').val(stock);
                    $('#input-code-up').val(code);
                    $('#input-price-up').val(price);
                });
            });
            </script>
               
            </div>
          </div>
        </div>
      </div>


  </body>
</html>