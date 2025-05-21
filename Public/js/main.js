$(document).on("submit", ".FormularioAjax", function (e) {
  e.preventDefault();

  const form = $(this)[0]; // DOM puro
  const action = $(this).attr('action');
  const method = $(this).attr('method') || "POST";
  const formData = new FormData(form); // captura todo correctamente
  
  $.ajax({
    method: method,
    url: action,
    data: formData,
    processData: false,
    contentType: false,
    success: function (respuesta) {
      console.log("Respuesta del servidor:", respuesta);

      const $form = $(form); // para poder usar jQuery más abajo

      if ($form.hasClass("Editar")) {
        alert("Editado correctamente");
        listar(`${url}?page=1`);
        let modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        modal.hide();
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
