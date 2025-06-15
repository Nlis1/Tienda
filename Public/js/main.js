$(document).on("submit", ".FormularioAjax", function (e) {
  console.log('picha')
  e.preventDefault();

  const form = $(this)[0]; // DOM puro
  const action = $(this).attr('action');
  const method = $(this).attr('method') || "POST";
  const formData = new FormData(form); // captura todo correctamente
  const subtotal = $('#subtotal-product').text().trim();
  const iva = $('#iva-product').text().trim();
  const total = $('#precio-final').text().trim();

  formData.append('carrito', JSON.stringify(productosCarrito));
  formData.append('subtotal', subtotal);
  formData.append('iva_total', iva); // 
  formData.append('total', total);
  
  $.ajax({
    method: method,
    url: action,
    data: formData,
    processData: false,
    contentType: false,
    success: function (respuesta) {
      console.log("Respuesta del servidor:", respuesta);
      const $form = $(form); // para poder usar jQuery más abajo

      if($form.hasClass("InsertarPedido")){
        $form.trigger("reset");
        let modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        modal.hide();

        localStorage.removeItem('carrito'); 
        window.location.href = '../index.php'; 
      }

      if ($form.hasClass("Editar")) {
        alert("Editado correctamente");
        listar(`${url}?page=1`);
        let modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        modal.hide();
      }

       if ($form.hasClass("EditarUser")) {
        alert("Editado correctamente");
        $form.trigger("reset");
       }

      if ($form.hasClass("ProductEliminar")) {
        alert("Se ha eliminado correctamente.");
        listar(`${url}?page=1`);

      } else if ($form.hasClass("Insertar")) {
        alert("Se agregó correctamente al sistema.");
        listar(`${url}?page=1`);
        let modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        modal.hide();
        $form.trigger("reset");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error en la petición:", error);
    }
  });

  return false;
});
