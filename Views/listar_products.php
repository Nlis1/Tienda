<?php
require_once '../Models/ProductModel.php';

$insProduct = new ProductModel();
$datos= $insProduct->get();

foreach($datos as $row) {
?>

<tr>
    <td><?php echo $row['id']?></td>
    <td><?php echo $row['name']?></td>
    <td>
        <img class="img-thumbnail rounded" src="<?php echo $row['photo'] ?>" width="50" alt="">
    </td>
    <td><?php echo $row['description']?></td>
    <td><?php echo $row['stock'] ?></td>
    <td><?php echo $row['product_code']?></td>
    <td><?php echo $row['price']?></td>
    <td>
        <form action="../Api/Api.php/product/<?php echo $row['id']?>" method="POST" class="FormularioAjax ProductEliminar">
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
