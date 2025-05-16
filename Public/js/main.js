$(document).on("submit", ".FormularioAjax", function (e) {
  e.preventDefault();
  const form = $(this);
  const action = form.attr('action');
  let method = form.attr('method') || "POST";
  method = method.toUpperCase();

  console.log("Método detectado:", method);

  let data = {};
  form.serializeArray().forEach(item => {
    if (item.name !== '_method') {
      data[item.name] = item.value;
    }
  });

  if (form.find('input[name="_method"]').val()) {
    data._method = form.find('input[name="_method"]').val();
  }

  console.log(data);

  $.ajax({
    method: method,
    url: action,
    data: data,
    success: function (respuesta) {
      console.log("Respuesta del servidor:", respuesta);

      if (form.hasClass("Editar")) {
        alert("Editado correctamente");
        listar(`${url}?page=1`);
        let modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        modal.hide();
      }
      if (form.hasClass("ProductEliminar")) {
        alert("Se ha eliminado correctamente.");
        listar(`${url}?page=1`);
        
      } else if (form.hasClass("Insertar")) {
        alert("Se agregó correctamente al sistema.");
        listar(`${url}?page=1`);
        let modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        modal.hide();
        form.trigger("reset");
      }
    }
  });
    return false;
});
